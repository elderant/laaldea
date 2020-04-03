/*
 * Sequence.js
 *
 * The responsive CSS animation framework for creating unique sliders,
 * presentations, banners, and other step-based applications.
 *
 * @link https://github.com/IanLunn/Sequence
 * @author IanLunn
 * @version 2.1.0
 * @license http://sequencejs.com/licenses/
 * @copyright Ian Lunn Design Limited 2015
 */

function defineSequence(imagesLoaded, Hammer) {

  'use strict';

  var instances = [],
      instance = 0;

  /**
   * Sequence function
   *
   * @param {Object} element - the element Sequence is bound to
   * @param {Object} options - this instance's options
   * @returns {Object} self - Properties and methods available to this instance
   */
  var Sequence = (function (element, options) {

    var instanceId = element.getAttribute("data-seq-enabled");

    // Prevent multiple instances on the same element. Return the object instead
    if (instanceId !== null) {
      return instances[instanceId];
    }

    // The element now has Sequence attached to it
    element.setAttribute("data-seq-enabled", instance);
    instance++;

    /* --- PRIVATE VARIABLES/FUNCTIONS --- */

    // Default Sequence settings
    var defaults = {

      /* --- General --- */

      // The first step to show
      startingStepId: 1,

      // Should the starting step animate in to begin with?
      startingStepAnimatesIn: false,

      // When the last step is reached, should Sequence cycle back to the start?
      cycle: true,

      // How long to wait between the current phase animating out, and the next
      // animating in.
      phaseThreshold: true,

      // Should transitions be reversed when navigating backwards?
      reverseWhenNavigatingBackwards: false,

      // Should transition-timing-function be reversed when navigating backwards?
      reverseTimingFunctionWhenNavigatingBackwards: false,

      // Should the active step be given a higher z-index?
      moveActiveStepToTop: true,


      /* --- Canvas Animation --- */

      // Should the canvas automatically animate between steps?
      animateCanvas: true,

      // Time it should take to animate between steps
      animateCanvasDuration: 250,


      /* --- autoPlay --- */

      // Cause Sequence to automatically navigate between steps
      // Specify a number in milliseconds or true (for a default of 5000ms) to
      // define the period Sequence should wait between each step before
      // navigating to the next step
      autoPlay: false,

      // How long to wait between each step before navigation occurs again
      autoPlayInterval: 5000,

      // Amount of time to wait until autoPlay starts again after being stopped
      autoPlayDelay: null,

      // Direction of navigation when autoPlay is enabled
      autoPlayDirection: 1,

      // Use an autoPlay button? You can also specify a CSS selector to
      // change what element acts as the button. If true, the element uses the
      // class of "seq-autoplay"
      autoPlayButton: true,

      // Pause autoPlay when the Sequence element is hovered over
      autoPlayPauseOnHover: true,


      /* --- Navigation Skipping --- */

      // Allow the user to navigate between steps even if they haven't
      // finished animating
      navigationSkip: true,

      // How long to wait before the user is allowed to skip to another step
      navigationSkipThreshold: 250,

      // Fade a step when it has been skipped
      fadeStepWhenSkipped: true,

      // How long the fade should take
      fadeStepTime: 500,

      // When a step is skipped, the next step will immediately animate-in
      // regardless of the phaseThreshold option
      ignorePhaseThresholdWhenSkipped: false,

      // Don't allow the user to go to a previous step when the current one is
      // still active
      preventReverseSkipping: false,


      /* --- Next/Prev Button --- */

      // Use next and previous buttons? You can also specify a CSS selector to
      // change what element acts as the button. If true, the element uses
      // classes of "seq-next" and "seq-prev"
      nextButton: true,
      prevButton: true,


      /* --- Pagination --- */

      // Use pagination? You can also specify a CSS selector to
      // change what element acts as pagination. If true, the element uses the
      // class of "seq-pagination"
      pagination: true,


      /* --- Preloader --- */

      // You can also specify a CSS selector to
      // change what element acts as the preloader. If true, the element uses
      // the class of "seq-preloader"
      preloader: false,

      // Preload all images from specific steps
      preloadTheseSteps: [1],

      // Preload specified images
      preloadTheseImages: [
        /**
         * Example usage
         * "images/catEatingSalad.jpg",
         * "images/grandmaDressedAsBatman.png"
         */
      ],

      // Hide Sequence's steps until it has preloaded
      hideStepsUntilPreloaded: false,

      // (Debugging only) Prevent the preloader from hiding so you can
      // test it's styles
      pausePreloader: false,


      /* --- Keyboard --- */

      // Can the user navigate between steps by pressing keyboard buttons?
      keyNavigation: false,

      // When numeric keys 1 - 9 are pressed, Sequence will navigate to the
      // corresponding step
      numericKeysGoToSteps: false,

      // Events to run when the user presses the left/right keys
      keyEvents: {
        left: function(sequence) {sequence.prev();},
        right: function(sequence) {sequence.next();}
      },


      /* --- Touch Swipe --- */

      // Can the user navigate between steps by swiping on a touch enabled device?
      swipeNavigation: true,

      // Events to run when the user swipes in a particular direction
      swipeEvents: {
        left: function(sequence) {sequence.next();},
        right: function(sequence) {sequence.prev();},
        up: undefined,
        down: undefined
      },

      // Options to supply the third-party Hammer library See: http://hammerjs.github.io/recognizer-swipe/
      swipeHammerOptions: {},


      /* --- hashTags --- */

      // Should the URL update to include a hashTag that relates to the current
      // step being shown?
      hashTags: false,

      // Get the hashTag from an ID or data-seq-hashtag attribute?
      hashDataAttribute: false,

      // Should the hash change on the first step?
      hashChangesOnFirstStep: false,


      /* --- Fallback Theme --- */

      // Settings to use when the browser doesn't support CSS transitions
      fallback: {

        // The speed to transition between steps
        speed: 500
      }
    };

    // Default value for autoPlay in milliseconds
    var autoPlayDefault = 5000;

    // See sequence.animation.domDelay() for an explanation of this
    var domThreshold = 50;

    // Throttle the window resize event
    // see self.manageEvents.add.resizeThrottle()
    var resizeThreshold = 100;

    // Convert browser fixes to CSS strings
    var prefixTranslations = {

      animation: {
        "WebkitAnimation": "-webkit-",
        "animation": ""
      }
    };

    /**
     *
     * This version of Modernizr is for use with Sequence.js and is included
     * internally to prevent conflicts with other Modernizr builds.
     *
     * Modernizr 2.8.3 (Custom Build) | MIT & BSD
     * Build: http://modernizr.com/download/#-cssanimations-csstransforms-csstransitions-svg-touch-prefixed-teststyles-testprop-testallprops-prefixes-domprefixes
     */

    /* jshint ignore:start */
    var Modernizr=function(a,b,c){function z(a){i.cssText=a}function A(a,b){return z(l.join(a+";")+(b||""))}function B(a,b){return typeof a===b}function C(a,b){return!!~(""+a).indexOf(b)}function D(a,b){for(var d in a){var e=a[d];if(!C(e,"-")&&i[e]!==c)return b=="pfx"?e:!0}return!1}function E(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:B(f,"function")?f.bind(d||b):f}return!1}function F(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+n.join(d+" ")+d).split(" ");return B(b,"string")||B(b,"undefined")?D(e,b):(e=(a+" "+o.join(d+" ")+d).split(" "),E(e,b,c))}var d="2.8.3",e={},f=b.documentElement,g="modernizr",h=b.createElement(g),i=h.style,j,k={}.toString,l=" -webkit- -moz- -o- -ms- ".split(" "),m="Webkit Moz O ms",n=m.split(" "),o=m.toLowerCase().split(" "),p={svg:"http://www.w3.org/2000/svg"},q={},r={},s={},t=[],u=t.slice,v,w=function(a,c,d,e){var h,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:g+(d+1),l.appendChild(j);return h=["&#173;",'<style id="s',g,'">',a,"</style>"].join(""),l.id=g,(m?l:n).innerHTML+=h,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=f.style.overflow,f.style.overflow="hidden",f.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),f.style.overflow=k),!!i},x={}.hasOwnProperty,y;!B(x,"undefined")&&!B(x.call,"undefined")?y=function(a,b){return x.call(a,b)}:y=function(a,b){return b in a&&B(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=u.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(u.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(u.call(arguments)))};return e}),q.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:w(["@media (",l.join("touch-enabled),("),g,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c},q.cssanimations=function(){return F("animationName")},q.csstransforms=function(){return!!F("transform")},q.csstransitions=function(){return F("transition")},q.svg=function(){return!!b.createElementNS&&!!b.createElementNS(p.svg,"svg").createSVGRect};for(var G in q)y(q,G)&&(v=G.toLowerCase(),e[v]=q[G](),t.push((e[v]?"":"no-")+v));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)y(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof enableClasses!="undefined"&&enableClasses&&(f.className+=" "+(b?"":"no-")+a),e[a]=b}return e},z(""),h=j=null,e._version=d,e._prefixes=l,e._domPrefixes=o,e._cssomPrefixes=n,e.testProp=function(a){return D([a])},e.testAllProps=F,e.testStyles=w,e.prefixed=function(a,b,c){return b?F(a,b,c):F(a,"pfx")},e}(window,window.document);
    /* jshint ignore:end */

    // Add indexOf() support to arrays for Internet Explorer 8
    if (!Array.prototype.indexOf) {
      Array.prototype.indexOf = function (searchElement, fromIndex) {
        if ( this === undefined || this === null ) {
          throw new TypeError( '"this" is null or not defined' );
        }

        // Hack to convert object.length to a UInt32
        var length = this.length >>> 0;

        fromIndex = +fromIndex || 0;

        if (Math.abs(fromIndex) === Infinity) {
          fromIndex = 0;
        }

        if (fromIndex < 0) {
          fromIndex += length;
          if (fromIndex < 0) {
            fromIndex = 0;
          }
        }

        for (;fromIndex < length; fromIndex++) {
          if (this[fromIndex] === searchElement) {
            return fromIndex;
          }
        }

        return -1;
      };
    }

    /**
     * Determine the prefix to use for the pageVisibility API
     */
    var hidden,
        visibilityChange;

    if (typeof document.hidden !== "undefined") {

      // Opera 12.10 and Firefox 18 and later support
      hidden = "hidden";
      visibilityChange = "visibilitychange";
    } else if (typeof document.mozHidden !== "undefined") {

      hidden = "mozHidden";
      visibilityChange = "mozvisibilitychange";
    } else if (typeof document.msHidden !== "undefined") {

      hidden = "msHidden";
      visibilityChange = "msvisibilitychange";
    } else if (typeof document.webkitHidden !== "undefined") {

      hidden = "webkitHidden";
      visibilityChange = "webkitvisibilitychange";
    }

    /**
     * Is an object an array?
     *
     * @param {Object} object - The object we want to test
     * @api private
     */
    function isArray(object) {

      if (Object.prototype.toString.call(object) === '[object Array]') {
        return true;
      }else {
        return false;
      }
    }

    /**
     * Extend object a with the properties of object b.
     * If there's a conflict, object b takes precedence.
     *
     * @param {Object} a - The first object to merge
     * @param {Object} b - The second object to merge (takes precedence)
     * @api private
     */
    function extend(a, b) {

      for (var i in b) {
        a[i] = b[i];
      }

      return a;
    }

    /**
     * Get the values of an element's CSS property
     *
     * @param {HTMLObject} element - The element to get the value from
     * @param {String} property - The CSS property to get the value of
     * @returns {String} value - The value from the element's CSS property
     */
    function getStyle(element, property) {

      var value;

      // IE
      if (element.currentStyle) {
        value = element.currentStyle[property];
      }

      else if (document.defaultView && document.defaultView.getComputedStyle) {
        value = document.defaultView.getComputedStyle(element, "")[property];
      }

      return value;
    }

    /**
     * Cross Browser helper for addEventListener
     *
     * @param {HTMLObject} element - The element to attach the event to
     * @param {String} eventName - The name of the event; "click" for example
     * @param {Function} handler - The function to execute when the event occurs
     * @returns {Function} handler - Returns the handler so it can be removed
     */
    function addEvent(element, eventName, handler) {

      if (element.addEventListener) {
        element.addEventListener(eventName, handler, false);

        return handler;
      }

      else if (element.attachEvent) {

        // Allows IE to return this keyword
        var handlerr = function() {
          handler.call(element);
        };

        element.attachEvent("on" + eventName, handlerr);

        return handlerr;
      }

    }

    /**
     * Cross Browser helper for removeEventListener
     *
     * @param {HTMLObject} element - The element to attach the event to
     * @param {String} eventName - The name of the event; "click" for example
     * @param {Function} handler - The function to execute when the event occurs
     */
    function removeEvent(element, eventName, handler) {

      if (element.addEventListener) {
        element.removeEventListener(eventName, handler, false);
      }

      else if (element.detachEvent) {
        element.detachEvent("on" + eventName, handler);
      }
    }

    /**
     * Converts a time value taken from a CSS property, such as "0.5s"
     * and converts it to a number in milliseconds, such as 500
     *
     * @param {String} time - the time in a string
     * @returns {Number} convertedTime - the time as a number
     * @api private
     */
    function convertTimeToMs(time) {

      var convertedTime,
          fraction;

      // Deal with milliseconds and seconds
      if (time.indexOf("ms") > -1) {
        fraction = 1;
      }else {
        fraction = 1000;
      }

      if (time == "0s") {
        convertedTime = 0;
      }else {
        convertedTime = parseFloat(time.replace("s", "")) * fraction;
      }

      return convertedTime;
    }

    /**
     * Does an element have a particular class?
     *
     * @param {HTMLElement} element - The element to check
     * @param {String} name - The name of the class to check for
     * @returns {Boolean}
     * @api private
     */
    function hasClass(element, name) {

      if (element === undefined) {
        return;
      }

      return new RegExp('(\\s|^)' + name + '(\\s|$)').test(element.className);
    }

    /**
     * Add a class to an element
     *
     * @param {Object} elements - The element(s) to add a class to
     * @param {String} name - The class to add
     * @api private
     */
    function addClass(elements, name) {

      var element,
          elementsLength,
          i;

      // If only one element is defined, turn it into a nodelist so it'll pass
      // through the for loop
      if (isArray(elements) === false) {
        elementsLength = 1;
        elements = [elements];
      }

      elementsLength = elements.length;

      for (i = 0; i < elementsLength; i++) {

        element = elements[i];

        if (hasClass(element, name) === false) {
          element.className += (element.className ? ' ': '') + name;
        }
      }
    }

    /**
     * Remove a class from an element
     *
     * @param {Object} elements - The element to remove a class from
     * @param {String} name - The class to remove
     * @api private
     */
    function removeClass(elements, name) {

      var element,
          elementsLength,
          i;

      // If only one element is defined, turn it into a nodelist so it'll pass
      // through the for loop
      if (isArray(elements) === false) {
        elementsLength = 1;
        elements = [elements];
      }

      else {
        elementsLength = elements.length;
      }

      for (i = 0; i < elementsLength; i++) {

        element = elements[i];

        if (hasClass(element, name) === true) {
          element.className = element.className.replace(new RegExp('(\\s|^)' + name + '(\\s|$)'),' ').replace(/^\s+|\s+$/g, '');
        }
      }
    }

    /**
     * Determine if the cursor is inside the boundaries of an
     * element.
     *
     * @param {Object} element - The element to test
     * @param {Object} cursor - The event holding cursor properties
     */
    function insideElement(element, cursor) {

      // Get the elements boundaries
      var rect = element.getBoundingClientRect(),
          inside = false;

      // Return true if inside the boundaries of the Sequence element
      if (cursor.clientX >= rect.left && cursor.clientX <= rect.right && cursor.clientY >= rect.top && cursor.clientY <= rect.bottom) {
        inside = true;
      }

      return inside;
    }

    /**
     * Determine if an element has a specified parent, and if so, return the
     * index number for the element.
     *
     * The index is taken from the top level elements witint a pagination
     * element. This function will iterate through each parent until it
     * reaches the top level, then get all top level elements and determine
     * the index of the chosen top level.
     *
     * @param {Object} parents - The parent element(s) that the child should be
     * within
     * @param {Object} target - The child element to test if it has the parent
     * @param {Object} previousTarget - The element that was previously checked
     * to determine if it was top level
     * @api private
     */
    function hasParent(parent, target, previousTarget) {

      if (target.nodeName === "BODY") {
        return false;
      }

      // We're at the pagination parent
      if (parent === target) {

        if (previousTarget !== undefined) {

          // Get the top level element clicked and all top level elements
          var topLevel = previousTarget;
          var allTopLevel = parent.getElementsByTagName(topLevel.nodeName);

          // Count the number of top level elements
          var i = allTopLevel.length;

          // Which top level element was clicked?
          while (i--) {
            if (topLevel === allTopLevel[i]) {

              // One-base the index and return it
              return i + 1;
            }
          }
        }
      }

      // Not yet at the pagination parent element, iterate again
      else {
        previousTarget = target;
        return hasParent(parent, target.parentNode, previousTarget);
      }
    }

    /**
     * Determine the Hammer direction required based on the swipe directions
     * being used
     * hammerjs.github.io/api/#directions
     *
     * @param {Object} swipeEvents - An object holding each swipe direction and
     * the handler to execute
     * @api private
     */
    function getHammerDirection(swipeEvents) {

      var swipeDirections = 0,
          hammerDirection = Hammer.DIRECTION_NONE;

      if (swipeEvents.left !== undefined || swipeEvents.right !== undefined) {
        swipeDirections += 1;
      }

      if (swipeEvents.up !== undefined || swipeEvents.down !== undefined) {
        swipeDirections += 2;
      }

      if (swipeDirections === 1) {
        hammerDirection = Hammer.DIRECTION_HORIZONTAL;
      } else if (swipeDirections === 2) {
        hammerDirection = Hammer.DIRECTION_VERTICAL;
      } else if (swipeDirections === 3) {
        hammerDirection = Hammer.DIRECTION_ALL;
      }

      return hammerDirection;
    }

    /**
     * Add classes to the Sequence container that allow for styling based on
     * feature support.
     *
     * @param {HTMLObject} $el - The element to add the classes to
     * @param {Object} Modernizr - Sequence's instance of Modernizr
     * @api private
     */
    function addFeatureSupportClasses($el, Modernizr) {

      // TODO: Add support for all features used by Sequence and only manipulate
      // the DOM once. Currently this function just adds a class for the touch
      // feature. Probably best just to copy how Modernizr does it to implement
      // full list of features

      var prefix = "seq-",
          support = "no-touch";

      if (Modernizr.touch === true) {
        support = "touch";
      }

      addClass($el, prefix + support);
    }

    /* --- PUBLIC PROPERTIES/METHODS --- */

    // Expose some of Sequence's private properties
    var self = {
      modernizr: Modernizr
    };

    /**
     * Manage UI elements such as nextButton, prevButton, and pagination
     */
    self.ui = {

      // Default UI elements
      defaultElements: {
        "nextButton": "seq-next",
        "prevButton": "seq-prev",
        "autoPlayButton": "seq-autoplay",
        "pagination": "seq-pagination",
        "preloader": "seq-preloader"
      },

      /**
       * Get an UI element
       *
       * @param {String} type - The type of UI element (nextButton for example)
       * @returns {Boolean | HTMLElement} option - True if using the default
       * element, else an HTMLElement
       */
      getElements: function(type, option) {

        var element,
            elements,
            elementsLength,
            relatedElements = [],
            rel,
            i;

        // Get the element being used
        if (option === true) {

          // Default elements
          elements = document.querySelectorAll("." + this.defaultElements[type]);
        } else {

          // Custom elements
          elements = document.querySelectorAll(option);
        }

        elementsLength = elements.length;

        // Does the element control this instance of Sequence? We're looking
        // for either a global element or one with a rel attribute the same
        // as this instances ID
        for (i = 0; i < elementsLength; i++) {

          element = elements[i];
          rel = element.getAttribute("rel");

          if (rel === null || rel === self.$container.getAttribute("id")) {
            relatedElements.push(element);
          }
        }

        return relatedElements;
      },

      /**
       * Fade an element in using transitions if they're supported, else use JS
       *
       * @param {HTMLElement} element - The element to show
       * @param {Number} duration - The duration to show the element over
       */
      show: function(element, duration) {

        if (self.propertySupport.transitions === true) {

          element.style[Modernizr.prefixed("transitionDuration")] = duration + "ms";
          element.style[Modernizr.prefixed("transitionProperty")] = "opacity, " + Modernizr.prefixed("transform");
          element.style.opacity = 1;
        }

        else {

          self.animationFallback.animate(element, "opacity", "", 0, 1, duration);
        }
      },

      /**
       * Fade an element out using transitions if they're supported, else use JS
       *
       * @param {HTMLElement} element - The element to hide
       * @param {Number} duration - The duration to hide the element over
       * @param {Function} callback - Function to execute when the element is
       * hidden
       */
      hide: function(element, duration, callback) {

        if (self.propertySupport.transitions === true) {

          element.style[Modernizr.prefixed("transitionDuration")] = duration + "ms";
          element.style[Modernizr.prefixed("transitionProperty")] = "opacity, " + Modernizr.prefixed("transform");
          element.style.opacity = 0;
        }

        else {

          self.animationFallback.animate(element, "opacity", "", 1, 0, duration);
        }

        if (callback !== undefined) {
          self.hideTimer = setTimeout(function() {
            callback();
          }, duration);
        }
      }
    };

    /**
     * Methods relating to autoPlay
     */
    self.autoPlay = {

      /**
       * Initiate autoPlay
       */
      init: function() {

        self.isAutoPlayPaused = false;
        self.isAutoPlaying = false;
      },

      /**
       * Determine the delay that should be applied before starting autoPlay. A
       * custom delay should take precedence. If delay is true then the delay
       * should use options.autoPlayDelay where specified. If not
       * specified, use the same time as defined in options.autoPlayInterval
       *
       * @param {Boolean/Number} delay - Whether a delay should be applied before
       * starting autoPlay (true = same amount as options.autoPlayInterval,
       * false = no interval, number = custom interval period). Applied to
       * autoPlay.start()
       * @param {Number} startDelay - The delay applied via options.autoPlayDelay
       * @param {Number} autoPlayInterval - The delay applied via options.autoPlayInterval
       */
      getDelay: function(delay, startDelay, autoPlayInterval) {

        switch (delay) {

          case true:

            delay = (startDelay === null) ? autoPlayInterval: startDelay;
            break;

          case false:
          case undefined:
            delay = 0;
            break;
        }

        return delay;
      },

      /**
       * Start autoPlay
       *
       * @param {Boolean/Number} delay - Whether a delay should be applied before
       * starting autoPlay (true = same amount as options.autoPlayInterval,
       * false = no delay, number = custom delay period)
       * @param {Boolean} continuing - If autoPlay is continuing from a
       * previous cycle, the started() callback won't be triggered
       * @returns false - When autoPlay is already active and can't be started
       * again
       */
      start: function(delay, continuing) {

        // Only start once
        if (self.isAutoPlaying === true || self.isReady === false) {
          return false;
        }

        var options = self.options;

        // Which delay should we use?
        delay = this.getDelay(delay, options.autoPlayDelay, options.autoPlayInterval);

        // Callback (only to be triggered when autoPlay is continuing from a
        // previous cycle)
        if (continuing === undefined) {
          self.started(self);
        }

        addClass(self.$container, "seq-autoplaying");
        addClass(self.$autoPlay, "seq-autoplaying");

        // autoPlay is now enabled and active
        options.autoPlay = true;
        self.isAutoPlaying = true;

        // Only start a new autoPlay timer if Sequence isn't already animating.
        // If it is, a new one will be started at the end of the animation.
        if (self.isAnimating === false) {

          // Choose the direction and start autoPlay
          self.autoPlayTimer = setTimeout(function() {

            if (options.autoPlayDirection === 1) {
              self.next();
            }else {
              self.prev();
            }
          }, delay);
        }

        return true;
      },

      /**
       * Stop autoPlay
       */
      stop: function() {

        if (self.options.autoPlay === true && self.isAutoPlaying === true) {
          self.options.autoPlay = false;
          self.isAutoPlaying = false;
          clearTimeout(self.autoPlayTimer);

          removeClass(self.$container, "seq-autoplaying");
          removeClass(self.$autoPlay, "seq-autoplaying");

          // Callback
          self.stopped(self);
        } else {
          return false;
        }

        return true;
      },

      /**
       * Unpause autoPlay
       *
       * autoPlay.pause() and autoPlay.unpause() are used internally to
       * temporarily stop autoPlay when hovered over.
       */
      unpause: function() {

        if (self.isAutoPlayPaused === true) {

          self.isAutoPlayPaused = false;
          this.start(true);
        } else {
          return false;
        }

        return true;
      },

      /**
       * Pause autoPlay
       *
       * autoPlay.pause() and autoPlay.unpause() are used internally to
       * temporarily stop autoPlay when hovered over.
       */
      pause: function() {

        if (self.options.autoPlay === true) {

          self.isAutoPlayPaused = true;
          this.stop();

        } else {
          return false;
        }

        return true;
      }
    };

    /**
     * Controls Sequence's canvas
     */
    self.canvas = {

      /**
       * Setup the canvas, screen, and steps ready to be animated
       */
      init: function(id) {

        if (self.$screen !== undefined) {
          self.$screen.style.height = "100%";
          self.$screen.style.width = "100%";
        }

        // Determine the position of each step and the transform properties
        // required for the canvas so it can move to each step
        self.canvas.getTransformProperties();
      },

      /**
       * Get Sequence's steps
       *
       * @param {HTMLElement} canvas - The canvas element
       * @returns {Array} steps - The elements that make up Sequence's steps
       * @api private
       */
      getSteps: function(canvas) {

        var steps = [],
            stepId,
            step,
            stepElements = canvas.children,
            stepsLength = stepElements.length,
            i;

        // Where we'll save info about the animation
        self.stepProperties = {};

        // Get the steps that have a parent with a class of "seq-canvas"
        for (i = 0; i < stepsLength; i++) {

          step = stepElements[i];
          stepId = i + 1;

          steps.push(step);

          // Add each step to the animation map, where we'll save its transform
          // properties
          self.stepProperties[stepId] = {};
          self.stepProperties[stepId].isActive = false;
        }

        return steps;
      },

      /**
       * Determine the position of each step and the transform properties
       * required for the canvas so it can move to each step
       *
       */
      getTransformProperties: function() {

        var i,
            step,
            stepId,
            canvasTransform;

        for (i = 0; i < self.noOfSteps; i++) {

          step = self.$steps[i];
          stepId = i + 1;

          canvasTransform = {
            "seqX": 0,
            "seqY": 0,
            "seqZ": 0
          };

          // Invert the steps offsetLeft and offsetTop to the canvas will always
          // move to show the step
          canvasTransform.seqX += step.offsetLeft * -1;
          canvasTransform.seqY += step.offsetTop * -1;

          self.stepProperties[stepId].canvasTransform = canvasTransform;
        }
      },

      /**
       * Move the canvas to show a specific step
       *
       * @param {Number} id - The ID of the step to move to
       * @param {Boolean} animate - Should the canvas animate or snap?
       */
      move: function(id, animate) {

        if (self.options.animateCanvas === true) {

          // Get the canvas element and step element to animate to
          var duration = 0,
              transforms;

          // Should the canvas animate?
          if (animate === true && self.firstRun === false) {
            duration = self.options.animateCanvasDuration;
          }

          // Animate the canvas using CSS transitions
          if (self.isFallbackMode === false) {

            transforms = self.stepProperties[id].canvasTransform;

            // Apply the transform CSS to the canvas
            self.$canvas.style[Modernizr.prefixed("transitionDuration")] = duration + "ms";
            self.$canvas.style[Modernizr.prefixed("transform")] = "translateX(" + transforms.seqX + "px) " + "translateY(" + transforms.seqY + "px) " + "translateZ(" + transforms.seqZ + "px) ";
          }

          return true;
        }

        return false;
      },

      /**
       * Remove the no-JS "seq-in" class from a step
       *
       * @param {Object} self - Properties and methods available to this instance
       * @api private
       */
      removeNoJsClass: function() {

        if (self.isFallbackMode === true) {
          return;
        }

        // Look for the step with the "seq-in" class and remove the class
        for (var i = 0; i < self.$steps.length; i++) {
          var element = self.$steps[i];

          if (hasClass(element, "seq-in") === true) {
            var step = i + 1;

            self.animation.resetInheritedSpeed(step);
            removeClass(element, "seq-in");
          }
        }
      }
    };

    /**
     * Controls Sequence's step animations
     */
    self.animation = {

      /**
       * Get the properties of a phase
       *
       * @param {Number} stepId - The ID of the step
       * @returns {Object} ID and element of the step the phase belongs to,
       * array of all child elements that belong to step, array of animated
       * elements, timings object containing maxDuration, maxDelay, and
       * maxLength
       */
      getPhaseProperties: function(stepId) {

        var stepElement = self.$steps[stepId - 1],
            stepAnimatedChildren = stepElement.querySelectorAll("*[data-seq]"),
            stepChildren = stepElement.querySelectorAll("*"),
            stepChildrenLength = stepChildren.length,
            el,
            i,
            watchedDurations = [],
            watchedDelays = [],
            watchedLengths = [],
            durations = [],
            delays = [],
            lengths = [],
            duration,
            delay;

        // Get the animation length of each element (duration + delay) and save
        // for comparisson
        for (i = 0; i < stepChildrenLength; i++) {
          el = stepChildren[i];

          duration = convertTimeToMs(getStyle(el, Modernizr.prefixed("transitionDuration")));
          delay = convertTimeToMs(getStyle(el, Modernizr.prefixed("transitionDelay")));

          // Save this elements animation length for all elements
          durations.push(duration);
          delays.push(delay);
          lengths.push(duration + delay);

          // Also save animation lengths but only for watched elements
          if (el.getAttribute("data-seq") !== null) {
            watchedDurations.push(duration);
            watchedDelays.push(delay);
            watchedLengths.push(duration + delay);
          }
        }

        // Which were the longest durations and delays?
        var maxDuration = Math.max.apply(Math, durations),
            maxDelay = Math.max.apply(Math, delays),
            maxTotal = Math.max.apply(Math, lengths);

        // Which were the longest watched durations and delays?
        var watchedMaxDuration = Math.max.apply(Math, watchedDurations),
            watchedMaxDelay = Math.max.apply(Math, watchedDelays),
            watchedMaxTotal = Math.max.apply(Math, watchedLengths);

        return {
          stepId: stepId,
          stepElement: stepElement,
          children: stepChildren,
          animatedChildren: stepAnimatedChildren,
          watchedTimings: {
            maxDuration: watchedMaxDuration,
            maxDelay: watchedMaxDelay,
            maxTotal: watchedMaxTotal
          },
          timings: {
            maxDuration: maxDuration,
            maxDelay: maxDelay,
            maxTotal: maxTotal
          }
        };
      },

      /**
       * How long before the next phase should start?
       * Ignore the phaseThreshold (on first run for example)
       */
      getPhaseThreshold: function(ignorePhaseThreshold, phaseThresholdOption, isAnimating, currentPhaseDuration) {

        var phaseThresholdTime = 0;

        // Ignore the phaseThreshold if the developer wishes for this to happen
        // if Sequence.js is animating
        if (isAnimating === true && self.options.ignorePhaseThresholdWhenSkipped === true) {
          ignorePhaseThreshold = true;
        }

        if (ignorePhaseThreshold === undefined) {

          if (phaseThresholdOption === true) {
            // The phaseThreshold should be the length of the current phase
            // so the next starts immediately after
            phaseThresholdTime = currentPhaseDuration;
          } else if (phaseThresholdOption !== false) {
            // Use the developer defined phaseThreshold
            phaseThresholdTime = phaseThresholdOption;
          }
        }

        return phaseThresholdTime;
      },

      /**
       * Do we need to add a delay to account for one phase finishing
       * before another?
       *
       * @param {Number} currentPhaseTotal - Amount of time in milliseconds the
       * current phase will animate for
       * @param {Number} nextPhaseTotal - Amount of time in milliseconds the
       * next phase will animate for
       * @param {Boolean} ignorePhaseThresholdWhenSkippedOption - if true,
       * don't use a reversePhaseDelay
       * @param {Boolean} isAnimating - Whether Sequence is animating
       * @returns {Object} - Contains times that should delay the next or
       * current phase accordingly
       */
       getReversePhaseDelay: function(currentPhaseTotal, nextPhaseTotal, phaseThresholdOption, ignorePhaseThresholdWhenSkippedOption, isAnimating) {

        var phaseDifference = 0,
            current = 0,
            next = 0;

        // Only use a reversePhaseDelay if the phaseThreshold option is true or
        // a custom time, and Sequence is not animating with the
        // ignorePhaseThreshold option on
        if (phaseThresholdOption !== true && (ignorePhaseThresholdWhenSkippedOption === false || isAnimating === false)) {
            phaseDifference = currentPhaseTotal - nextPhaseTotal;

          if (phaseDifference > 0) {
            next = phaseDifference;
          } else if (phaseDifference < 0) {
            current = Math.abs(phaseDifference);
          }
        }

        return {
          next: next,
          current: current
        };
      },

      /**
       * If the moveActiveStepToTop option is being used, move the next step
       * to the top and the current step to the bottom via z-index
       *
       * @param {HTMLElement} currentElement - The current step to be moved off
       * the top
       * @param {HTMLElement} nextElement - The next step to be moved to the top
       */
      moveActiveStepToTop: function(currentElement, nextElement) {

        if (self.options.moveActiveStepToTop === true) {

          var prevStepElement = self.$steps[self.prevStepId - 1],
              lastStepId = self.noOfSteps - 1;

          prevStepElement.style.zIndex = 1;
          currentElement.style.zIndex = lastStepId;
          nextElement.style.zIndex = self.noOfSteps;
        }

        return null;
      },

      /**
       * If the navigationSkipThreshold option is being used, prevent the use
       * of goTo() during the threshold period
       *
       * @param {Number} id - The ID of the step Sequence is trying to go to
       * @param {HTMLObject} nextStepElement - The element for the next step
       */
      manageNavigationSkip: function(id, nextStepElement) {

        if (self.isFallbackMode === true) {
          return;
        }

        var i,
            stepProperties,
            stepElement,
            stepId,
            phaseSkipped;

        // Show the next step again
        self.ui.show(nextStepElement, 0);

        if (self.options.navigationSkip === true) {

          // Start the navigation skip threshold
          self.navigationSkipThresholdActive = true;

          // Are there steps currently animating that need to be faded out?
          if (self.phasesAnimating !== 0) {

            // If a step is waiting to animate in based on the phaseThreshold,
            // cancel it
            clearTimeout(self.phaseThresholdTimer);
            clearTimeout(self.nextPhaseStartedTimer);

            // Fade a step if the user navigates to another prior to its
            // animation finishing
            if (self.options.fadeStepWhenSkipped === true) {

              // Fade all elements that are animating
              // (not including the current one)
              for (i = 1; i <= self.noOfSteps; i++) {

                stepProperties = self.stepProperties[i];

                // Deal with the steps that were skipped whilst still animating
                if (stepProperties.isActive === true && i !== id) {
                  stepElement = self.$steps[i - 1];
                  stepId = i;

                  phaseSkipped = {};
                  phaseSkipped.id = stepId;
                  phaseSkipped.element = stepElement;

                  // Save the ID of the skipped step so we can deal with it when it has faded out
                  self.phasesSkipped.push(phaseSkipped);

                  // Deal with the skipped step
                  self.animation.stepSkipped(stepElement);
                }
              }
            }
          }

          // Start the navigationSkipThreshold timer to prevent being able to
          // navigate too quickly
          self.navigationSkipThresholdTimer = setTimeout(function() {
            self.navigationSkipThresholdActive = false;
          }, self.options.navigationSkipThreshold);
        }
      },

      /**
       * Deal with a step when it has been skipped
       *
       * @param {HTMLElement} stepElement - The step element that was skipped
       */
      stepSkipped: function(stepElement) {

        // TODO: Add resetWhenStepSkipped option -
        // https://github.com/IanLunn/Sequence/issues/257
        // Reset the skipped steps current and next phase ended timers and trigger
        // them as soon as the steps have faded out

        // Fade the step out
        self.ui.hide(stepElement, self.options.fadeStepTime, function() {

        });

      },

      /**
       * Change a step's class. Example: go from step1 to step2
       *
       * @param {Number} id - The ID of the step to change
       */
      changeStep: function(id) {

        // Get the step to add
        var stepToAdd = "seq-step" + id;

        // Add the new step and remove the previous
        if (self.currentStepId !== undefined) {

          var stepToRemove = "seq-step" + self.currentStepId;

          addClass(self.$container, stepToAdd);
          removeClass(self.$container, stepToRemove);
        }else {
          addClass(self.$container, stepToAdd);
        }
      },

      /**
       * Apply the reversed properties to all animatable elements within a phase
       *
       * @param {Object} phaseProperties - Properties relating to the active phases
       * (seq-in and seq-out)
       * @param {Number} phaseDelay - A delay that is added when one phase
       * animates longer than the other
       * @param {Number} phaseThresholdTime - The amount of time in milliseconds
       * before the next step should start animating in
       * @param {Boolean} ignorePhaseThreshold - if true, ignore the threshold
       * between phases (breaks reversal of animations but may be used when
       * skipping navigation etc)
       * @returns {Number} maxWatchedTotal - The new total length
       * (duration + delay) for watched elements when reversed
       */
      reverseProperties: function(phaseProperties, phaseDelay, phaseThresholdTime, ignorePhaseThreshold, options) {

        var animation = this,
            phaseElements = phaseProperties.children,
            noOfPhaseElements = phaseElements.length,
            stepDurations = phaseProperties.timings,
            el,
            i,
            timingFunction = '',
            timingFunctionReversed = '',
            duration,
            delay,
            total,
            maxTotal,
            maxWatchedTotal,
            totals = [],
            watchedTotals = [];

        for (i = 0; i < noOfPhaseElements; i++) {
          el = phaseElements[i];

          // Get each element's duration and delay
          duration = convertTimeToMs(getStyle(el, Modernizr.prefixed("transitionDuration")));
          delay = convertTimeToMs(getStyle(el, Modernizr.prefixed("transitionDelay")));

          // Save the total
          total = duration + delay;

          // Delay elements in relation to the length of other elements in the
          // phase eg. If one element A transitions for 1s and element B 2s
          // element A should be delayed by 1s (element B length - element A length).
          delay = stepDurations.maxTotal - total;

          // Delay this phase's elements so they animate in relation to the
          // other phase
          if (ignorePhaseThreshold !== true) {
            delay += phaseDelay;
          }

          // Update the total with the new delay
          total = duration + delay;

          // Save the total of the reversed animation
          totals.push(total);

          // Save the total of the reversed animation for watched elements only
          if (el.getAttribute("data-seq") !== null) {
            watchedTotals.push(total);
          }

          // Get the timing-function and reverse it
          if (options.reverseTimingFunctionWhenNavigatingBackwards === true) {
            timingFunction = getStyle(el, Modernizr.prefixed("transitionTimingFunction"));
            timingFunctionReversed = animation.reverseTimingFunction(timingFunction);
          }

          // Apply the reversed transition properties to each element
          el.style[Modernizr.prefixed("transition")] = duration + "ms " + delay + "ms " + timingFunctionReversed;
        }

        // Get the longest total and delay of the reversed animations
        maxTotal = Math.max.apply(Math, totals);

        // Get the longest total and delay of the reversed animations (for
        // watched elements only)
        maxWatchedTotal = Math.max.apply(Math, watchedTotals);

        // Remove the reversed transition properties from each element once it
        // has finished animating; allowing for the inherited styles to take
        // effect again.
        setTimeout(function() {
          animation.domDelay(function() {
            for (i = 0; i < noOfPhaseElements; i++) {
              el = phaseElements[i];

              el.style[Modernizr.prefixed("transition")] = "";
            }
          });
        }, maxTotal + phaseThresholdTime);

        return maxWatchedTotal;
      },

      /**
       * Go forward to the next step
       *
       * @param {Number} id - The ID of the next step
       * @param {HTMLObject} currentStepElement - The element for the current step
       * @param {HTMLObject} nextStepElement - The element for the next step
       * @param {Boolean} ignorePhaseThreshold - if true, ignore the
       * transitionThreshold setting and immediately go to the specified step
       * @param {Boolean} hashTagNav - If navigation is triggered by the hashTag
       */
      forward: function(id, currentStepElement, nextStepElement, ignorePhaseThreshold, hashTagNav) {

        var animation = this,
            currentPhaseProperties,
            currentPhaseTotal,
            phaseThresholdTime;

        if (self.firstRun === false) {

          // Callback
          animation.currentPhaseStarted(self.currentStepId);
        }

        // Snap the step to the "animate-start" phase
        removeClass(nextStepElement, "seq-out");

        animation.domDelay(function() {

          // Make the current step transition to "seq-out"
          currentPhaseProperties = animation.startAnimateOut(self.currentStepId, currentStepElement, 1);

          // Total duration of the current phase (duration + delay)
          currentPhaseTotal = currentPhaseProperties.watchedTimings.maxTotal;

          // How long before the next phase should start?
          phaseThresholdTime = animation.getPhaseThreshold(ignorePhaseThreshold, self.options.phaseThreshold, self.isAnimating, currentPhaseTotal);

          // Sequence is now animating
          self.isAnimating = true;

          // Make the next step transition to "seq-in"
          animation.startAnimateIn(id, currentPhaseTotal, nextStepElement, phaseThresholdTime, hashTagNav);
        });
      },

      /**
       * Navigate in reverse to the next step
       *
       * @param {Number} id - The ID of the next step
       * @param {HTMLObject} currentStepElement - The element for the current step
       * @param {HTMLObject} nextStepElement - The element for the next step
       * @param {Boolean} ignorePhaseThreshold - if true, ignore the
       * transitionThreshold setting and immediately go to the specified step
       * @param {Boolean} hashTagNav - If navigation is triggered by the hashTag
       */
      reverse: function(id, currentStepElement, nextStepElement, ignorePhaseThreshold, hashTagNav) {

        var animation = this,
            currentId,
            reversePhaseDelay,
            phaseThresholdTime = 0,
            currentPhaseProperties,
            nextPhaseProperties,
            currentPhaseTotal,
            nextPhaseTotal;

        // Snap the next phase to "animate-out"
        addClass(nextStepElement, "seq-out");

        animation.domDelay(function() {

          // Get the step number, element, its animated elements (child nodes),
          // and max timings
          currentPhaseProperties = animation.getPhaseProperties(self.currentStepId, "current");
          nextPhaseProperties = animation.getPhaseProperties(id, "next");

          // Determine the gap between phases based on the phaseThreshold option
          phaseThresholdTime = animation.getPhaseThreshold(ignorePhaseThreshold, self.options.phaseThreshold, self.isAnimating, currentPhaseProperties.timings.maxTotal);

          // Determine if there should be a delay to account for one phase
          // finishing before the other.
          // Example: Navigating forward, the next element transitions in over
          // 1s (A) and the current element over 2s (B). When reversed, the next
          // element (previouly the current element) should wait 1s (B - A)
          // before animating back in
          reversePhaseDelay = animation.getReversePhaseDelay(currentPhaseProperties.timings.maxTotal, nextPhaseProperties.timings.maxTotal, self.options.phaseThreshold, self.options.ignorePhaseThresholdWhenSkipped, self.isAnimating);

          // Reverse properties for all elements in the current and next step
          // and add the reversePhaseDelay as a transition-delay where necessary
          currentPhaseTotal = animation.reverseProperties(currentPhaseProperties, reversePhaseDelay.current, 0, ignorePhaseThreshold, self.options);
          nextPhaseTotal = animation.reverseProperties(nextPhaseProperties, reversePhaseDelay.next, phaseThresholdTime, ignorePhaseThreshold, self.options);

          // Make the current step transition to "animate-start"
          animation.startAnimateOut(self.currentStepId, currentStepElement, -1, currentPhaseTotal);

          // Sequence is now animating
          self.isAnimating = true;

          if (self.firstRun === false) {

            // Callbacks
            animation.currentPhaseStarted(self.currentStepId);
          }

          // Make the next step transition to "seq-in"
          animation.startAnimateIn(id, currentPhaseTotal, nextStepElement, phaseThresholdTime, hashTagNav, nextPhaseTotal);
        });
      },

      /**
       * Start the next step's "seq-in" phase
       *
       * @param {Number} id - The ID of the next step
       * @param {Number} currentPhaseTotal - Amount of time in milliseconds the
       * current phase will animate for
       * @param {HTMLObject} nextStepElement - The element for the next step
       * @param {Number} phaseThresholdTime - The amount of time in milliseconds
       * before the next step should start animating in
       * @param {Boolean} hashTagNav - If navigation is triggered by the hashTag
       * @param {Number} nextPhaseTotal - Amount of time in milliseconds the
       * next phase will animate for
       */
      startAnimateIn: function(id, currentPhaseTotal, nextStepElement, phaseThresholdTime, hashTagNav, nextPhaseTotal) {

        var animation = this,
            nextPhaseProperties,
            stepDuration;

        // The next ID is now the current ID
        self.prevStepId = self.currentStepId;
        self.currentStepId = id;

        if (self.firstRun === true) {
          // Update pagination
          self.pagination.update();
        }

        // When should the "seq-in" phase start and how long until the step
        // completely finishes animating?
        if (self.firstRun === false || self.options.startingStepAnimatesIn === true) {

          self.stepProperties[id].isActive = true;

          // Callback
          self.nextPhaseStartedTimer = setTimeout(function() {
            animation.nextPhaseStarted(id, hashTagNav);
          }, phaseThresholdTime);

          // Start the "seq-in" phase
          self.phaseThresholdTimer = setTimeout(function() {

            // TODO: Change multiple classes via one function
            addClass(nextStepElement, "seq-in");
            removeClass(nextStepElement, "seq-out");

            // When animate-in is reversed, this will have already been passed
            // in as an argument so it's only needed for forward animation
            if (nextPhaseTotal === undefined) {
              nextPhaseProperties = self.animation.getPhaseProperties(id, "next");
              nextPhaseTotal = nextPhaseProperties.watchedTimings.maxTotal;
            }

            // Wait for the next phase to end
            animation.phaseEnded(id, "next", nextPhaseTotal, animation.nextPhaseEnded);

            // How long will it take for the step to end?
            stepDuration = animation.getStepDuration(currentPhaseTotal, nextPhaseTotal, self.options.phaseThreshold);

            self.stepEndedTimer = setTimeout(function() {

              self.animation.stepEnded(id);
            }, stepDuration);

          }, phaseThresholdTime);
        }

        // This is the first run. Snap the first step into place without animation
        else {

          // Set the first step's speed to 0 to have it immediately snap into place
          animation.resetInheritedSpeed(id);

          self.phasesAnimating = 0;
          self.isAnimating = false;

          if (self.options.autoPlay === true) {
            self.autoPlay.start(true);
          }

          addClass(nextStepElement, "seq-in");
          removeClass(nextStepElement, "seq-out");
        }

        self.firstRun = false;
      },

      /**
       * Start the next step's "seq-out" phase
       *
       * @param {Number} id - The ID of the next step
       * @param {HTMLObject} currentStepElement - The element for the current step
       * @param {Number} direction - The direction of navigation
       * @param {Number} currentPhaseTotal - Amount of time in milliseconds the
       * current phase will animate for
       */
      startAnimateOut: function(id, currentStepElement, direction, currentPhaseTotal) {

        var animation = this,
        currentPhaseProperties;

        if (direction === 1) {

          // TODO: Change multiple classes via one function
          // Make the current step transition to "animate-out"
          removeClass(currentStepElement, "seq-in");
          addClass(currentStepElement, "seq-out");

          // Get the step number, element, its animated elements (child nodes), and
          // max timings
          currentPhaseProperties = animation.getPhaseProperties(id, "current");

          currentPhaseTotal = currentPhaseProperties.watchedTimings.maxTotal;

        } else {

          // Make the current step transition to "animate-start"
          removeClass(currentStepElement, "seq-in");
        }

        if (self.firstRun === false) {

          // Add the steps to the list of active steps
          self.stepProperties[id].isActive = true;

          // Wait for the current phase to end
          animation.phaseEnded(id, "current", currentPhaseTotal, animation.currentPhaseEnded);
        }

        return currentPhaseProperties;
      },

      /**
       * Determine how long a step will animate for
       *
       * @param {Number} currentPhaseTotal - Amount of time in milliseconds the
       * current phase will animate for
       * @param {Number} nextPhaseTotal - Amount of time in milliseconds the
       * next phase will animate for
       * @param {Number|Boolean} phaseThresholdOption - Amount of time between
       * phases as defined via the phaseThreshold option
       * @returns {Number} stepDuration - Which ever is longest, current or next
       * phase duration
       */
      getStepDuration: function(currentPhaseTotal, nextPhaseTotal, phaseThresholdOption) {

        var stepDuration;

        switch (phaseThresholdOption) {
          case true:
            stepDuration = nextPhaseTotal;
          break;

          case false:
            // The stepDuration is whichever phase is longest
            stepDuration = (currentPhaseTotal >= nextPhaseTotal) ? currentPhaseTotal : nextPhaseTotal;
          break;

          default:
            stepDuration = (currentPhaseTotal >= nextPhaseTotal + phaseThresholdOption) ? (currentPhaseTotal) - phaseThresholdOption : nextPhaseTotal;
        }

        return stepDuration;
      },

      /**
       * When the current phase starts animating
       */
      currentPhaseStarted: function(id) {

        self.phasesAnimating++;

        // Callback
        self.currentPhaseStarted(id, self);
      },

      /**
       * When the current phase finishes animating
       */
      currentPhaseEnded: function(id) {

        // Callback
        self.currentPhaseEnded(id, self);
      },

      /**
       * When the next phase starts animating
       *
       * @param {Boolean} hashTagNav - If navigation is triggered by the hashTag
       */
      nextPhaseStarted: function(id, hashTagNav) {

        self.phasesAnimating++;

        // Update the hashTag if being used
        if (hashTagNav === undefined) {
          self.hashTags.update();
        }

        // Update pagination
        self.pagination.update();

        // Callback
        self.nextPhaseStarted(id, self);
      },

      /**
       * When the next phase finishes animating
       */
      nextPhaseEnded: function(id) {

        // Callback
        self.nextPhaseEnded(id, self);

      },

      /**
       * Wait for a phases (seq-in or seq-out) animations to finish
       *
       * @param {Number} id - The id of the step the phase belongs to
       * @param {Number} phaseDuration - The amount of time before the phase
       * ends (in milliseconds)
       * @param {Function} callback - A function to execute when the phase ends
       */
      phaseEnded: function(id, phase, phaseDuration, callback) {

        var animation = this,
            phaseEnded;

        phaseEnded = function(id) {
          self.stepProperties[id].isActive = false;
          self.phasesAnimating--;

          // Phase callback
          callback(id);
        };

        if (phase === "current") {

          self.currentPhaseEndedTimer = setTimeout(function() {

            phaseEnded(id);
          }, phaseDuration);
        } else {

          self.nextPhaseEndedTimer = setTimeout(function() {

            phaseEnded(id);
          }, phaseDuration);
        }
      },

      /**
       * When a step's animations have completely finished
       *
       * @param {Number} id - The ID of the step that ended
       * @param {Number} stepDuration - The amount of time before the step
       * finishes animating
       */
      stepEnded: function(id) {

          self.isAnimating = false;
          self.isAutoPlaying = false;

          // Continue with autoPlay if enabled
          if (self.options.autoPlay === true) {
            self.autoPlay.start(true, true);
          }

          // Callback
          self.animationEnded(id, self);
      },

      /**
       * Change "seq-out" to "seq-in" and vice-versa.
       *
       * @param {String} phase - The phase to reverse
       * @returns {String} - The reversed phase
       */
      reversePhase: function(phase) {

        var reversePhase = {
            "seq-out": "seq-in",
            "seq-in": "seq-out"
        };

        return reversePhase[phase];
      },

      /**
       * Apply a short delay to a function that manipulates the DOM. Allows for
       * sequential DOM manipulations.
       *
       * Why is this needed?
       *
       * When sequentially manipulating a DOM element (ie, removing a class then
       * immediately applying another on the same element), the first manipulation
       * appears not to apply. This function puts a small gap between sequential
       * manipulations to give the browser a chance visually apply each manipulation.
       *
       * Some browsers can apply a succession of classes quicker than
       * this but 50ms is enough to capture even the slowest of browsers.
       *
       * @param {Function} callback - a function to run after the delay
       */
      domDelay: function(callback) {

        setTimeout(function() {
          callback();
        }, domThreshold);
      },

      /**
       * Reverse a CSS timing function
       *
       * @param {String} timingFunction - The timing function to reverse
       * @returns {String} timingFunction - The reverse timing function
       */
      reverseTimingFunction: function(timingFunction) {

        if (timingFunction === '' || timingFunction === undefined) {
          return timingFunction;
        }

        // Convert timingFunction keywords to a cubic-bezier function
        // This is needed because some browsers return a keyword, others a function
        var timingFunctionToCubicBezier = {
          "linear"     : "cubic-bezier(0.0,0.0,1.0,1.0)",
          "ease"       : "cubic-bezier(0.25, 0.1, 0.25, 1.0)",
          "ease-in"    : "cubic-bezier(0.42, 0.0, 1.0, 1.0)",
          "ease-in-out": "cubic-bezier(0.42, 0.0, 0.58, 1.0)",
          "ease-out"   : "cubic-bezier(0.0, 0.0, 0.58, 1.0)"
        };

        var cubicBezier,
            cubicBezierLength,
            reversedCubicBezier,
            i;

        // Convert the timing function to a cubic-bezier if it is a keyword
        if (timingFunction.indexOf("cubic-bezier") < 0) {

          // TODO: Support multiple timing-functions
          // If the timing-function is made up of multiple functions, reduce it
          // to one only
          timingFunction = timingFunction.split(",")[0];

          // Convert
          timingFunction = timingFunctionToCubicBezier[timingFunction];
        }

        // Remove the CSS function and just get the array of points
        cubicBezier = timingFunction.replace("cubic-bezier(", "").replace(")", "").split(",");
        cubicBezierLength = cubicBezier.length;

        // Convert each point into a number (rather than a string)
        for (i = 0; i < cubicBezierLength; i++) {
          cubicBezier[i] = parseFloat(cubicBezier[i]);
        }

        // Reverse the cubic bezier
        reversedCubicBezier = [
          1 - cubicBezier[2],
          1 - cubicBezier[3],
          1 - cubicBezier[0],
          1 - cubicBezier[1]
        ];

        // Add the reversed cubic bezier back into a CSS function
        timingFunction = "cubic-bezier(" + reversedCubicBezier + ")";

        return timingFunction;
      },

      /**
       * Apply a transition-duration and transition-delay to each element
       * then remove these temporary values once the phase is reset.
       *
       * Can be used to apply 0 to both duration and delay so animates reset
       * back into their original places for example.
       *
       * @param {String} step - The step that the elements we'll reset belong to
       */
      resetInheritedSpeed: function(step) {

        if (self.isFallbackMode === true) {
          return;
        }

        var animation = this,
            el,
            i;

        // Get the step's elements and count them
        var stepElements = self.$steps[step - 1].querySelectorAll("*"),
            numberOfStepElements = stepElements.len