function onYouTubeIframeAPIReady() {
  let i = 0;
  let container =  document.querySelectorAll('#stories')[0];
  container.classList.remove('waiting-yt');
}

( function( $ ) {
  $.fn.hasAnyClass = function() {
    for (var i = 0; i < arguments.length; i++) {
        var classes = arguments[i].split(" ");
        for (var j = 0; j < classes.length; j++) {
            if (this.hasClass(classes[j])) {
                return true;
            }
        }
    }
    return false;
  }

  /* youtube video events */
  var onPlayerStateChange = function(event) {
    if(event.data == YT.PlayerState.PAUSED || YT.PlayerState.ENDED) {
      let $thumbnailContainer = $(event.target.h).parents('.thumbnail-column').find('.thumbnail-container');
      $thumbnailContainer.toggleClass('remove');
    }
  }
  var onPlayerReady = function(event) {
    event.target.playVideo();
  }


  /* General events */
  var getUrlVars = function() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
  }

  /* Download pdf form events */
  var laadea_validate_promo_form_jquery = function() {
    let $form = $('.page-id-35 .covid-form-section .laaldea-form');
    let $inputs = $form.find('input:not([type="submit"]), select');
    let lang = $('html').attr('lang').substring(0,2);
    lang = lang == undefined ? 'es' : lang

    var message_array = {
      'form_name' : {
        'es' : 'Este campo es requerido',
        'en' : 'This field is required',
      },
      'form_organization' : {
        'es' : 'Este campo es requerido',
        'en' : 'This field is required',
      },
      'form_location' : {
        'es' : 'Este campo es requerido',
        'en' : 'This field is required',
      },
      'form_use' : {
        'es' : 'Este campo es requerido',
        'en' : 'This field is required',
      },
      'form_email' : {
        'required' : {
          'es' : 'Este campo es requerido',
          'en' : 'This field is required',
        },
        'email' : {
          'es' : 'Ingrese un correo electrónico valido',
          'en' : 'Enter a valid email',
        }
      },
    }

    $form.validate({
      rules: {
        form_name: "required",
        form_organization: "required",
        form_location: "required",
        form_use: "required",
        form_email: {
          required: true,
          email: true,
        },
      },
      messages: {
        form_name: message_array.form_name[lang],
        form_organization: message_array.form_organization[lang],
        form_location: message_array.form_location[lang],
        form_use: message_array.form_use[lang],
        form_email: {
          required: message_array.form_email.required[lang],
          email: message_array.form_email.email[lang],
        },
      },
      submitHandler: function(form) {
        form.submit();
      },
    });
  }
  
  /* Crea Forum events */
  var laaldea_handle_show_add_topic_modal = function(event, currentTarget) {
    let $modal = $(currentTarget).parent('.new-topic-button-container').siblings('.new-topic-form-container');
    
    $modal.toggleClass('out');
    setTimeout(function(){
      $modal.toggleClass('in');
    },10);
    $video.toggleClass('active');
  }

  var laaldea_handle_hide_add_topic_modal = function(event, currentTarget) {
    let $modal = $(currentTarget).parents('.modal-root');
    $modal.toggleClass('transition');
    $modal.toggleClass('in');
    setTimeout(function(){
      $modal.toggleClass('transition');
      $modal.toggleClass('out');
    },500);
  }

  var laaldea_handle_topic_load_more = function(event) {
    let $button = $(event.currentTarget);
    let $buttonContainer = $button.parents('.load-more-link-container');

    let offset = $button.attr('data-offset');
    let total = $button.attr('data-total');
    let topicId = $button.attr('data-topicId');

    $.ajax({
      url : ajax_params.ajax_url,
      type : 'post',
      data : {
        action : 'laaldea_load_more_replies',
        offset : offset,
        topicId : topicId,
      },
      success : function( response ) {
        let data = JSON.parse(response);
        if(data.html !== undefined) {
          let $repliesMainContainer = $button.parents('.topic-replies');
          let currentHeight = $repliesMainContainer.height();

          $buttonContainer.before(data.html);
          $repliesMainContainer.css('height', 'auto');
          let autoHeight = $repliesMainContainer.height();

          if(true === data.last) {
            autoHeight -= $button.height();
          }

          $repliesMainContainer.height(currentHeight).animate({height: autoHeight}, 1000);
        }

        $button.attr('data-offset',data.count);
        if(true === data.last) {
          $button.fadeTo(500, 0, function() {
            $button.toggleClass('end-list');
            $button.css('opacity','');
          });
        }

        webStateWaiting(false);
      },
      beforeSend: function() {
        webStateWaiting(true);
        return true;
      },
    });
  }

  var laaldea_handle_display_reply_box = function(event, currentTarget) {
    let $form = $(currentTarget).parents('.reply-container').find('.bbp-reply-form');
    let $cancelButton = $form.find('.bbp-submit-wrapper #bbp-cancel-reply-to-link');

    if(!$cancelButton.hasClass('button')) {
      $cancelButton.toggleClass('button').toggleClass('learning-button').toggleClass('h5');
    }

    let currentHeight = $form.height();

    $form.css('height', currentHeight + 'px');
    
    $form.animate({height: $form.get(0).scrollHeight}, 1000, function(){
      $(this).height('auto');
    });

    $form.find('#bbp-cancel-reply-to-link').on('click', function(event) {
      $form.css('height','');
    });
  }

  /* Crea News events */
  var laaldea_handle_news_load_next = function(event) {
    let $button = $(event.currentTarget);

    let postId = $button.attr('data-postId');

    let urlVars = getUrlVars();
    let tagId = '';
    if(urlVars.indexOf('tagId') != -1) {
      tagId = parseInt(urlVars['tagId']);
    }

    $.ajax({
      url : ajax_params.ajax_url,
      type : 'post',
      data : {
        action : 'laaldea_load_next_new_main',
        postId : postId,
        tagId : tagId,
      },
      success : function( response ) {
        let data = JSON.parse(response);
        if(data.html !== undefined) {
          let $mainContainer = $button.parents('.news-container');
          let currentHeight = $mainContainer.height();

          $mainContainer.css('height', currentHeight + 'px');
          $mainContainer.append(data.html);
         
          $mainContainer.animate({height: $mainContainer.get(0).scrollHeight}, 1000, function(){
            $(this).height('auto');
          });

          $mainContainer.find('.new-container').last().find('.load-more-link').on('click', function(event) {
            event.preventDefault();
            laaldea_handle_news_load_next(event);
          });

          let $lastNew = $mainContainer.find('.new-container').last();
          let newStart = $lastNew.offset().top - 150;
          $('html').stop().animate({ scrollTop: newStart }, 500);
        }

        $button.attr('data-offset', data.count);
        $button.fadeTo(500, 0, function() {
          $button.toggleClass('end-list');
          $button.css('opacity','');
        });

        webStateWaiting(false);
      },
      beforeSend: function() {
        webStateWaiting(true);
        return true;
      },
    });
  }

  var laaldea_handle_news_load_more_sidebar = function(event) {
    let $button = $(event.currentTarget);
    let offset = $button.attr('data-offset');

    $.ajax({
      url : ajax_params.ajax_url,
      type : 'post',
      data : {
        action : 'laaldea_load_next_new_sidebar',
        offset : offset,
      },
      success : function( response ) {
        let data = JSON.parse(response);
        if(data.html !== undefined) {
          let $mainContainer = $button.parents('.sidebar').find('.news-container');
          let currentHeight = $mainContainer.height();

          $mainContainer.css('height', currentHeight + 'px');
          $mainContainer.append(data.html);
         
          $mainContainer.animate({height: $mainContainer.get(0).scrollHeight}, 1000, function(){
            $(this).height('auto');
          });
        }

        $button.attr('data-offset',data.count);
        $button.fadeTo(500, 0, function() {
          $button.toggleClass('end-list');
          $button.css('opacity','');
        });

        // TODO add event for each read more button
        $('#news .sidebar .actions .load-more-link').on('click', function(event){
          event.preventDefault();
          laaldea_handle_news_load_more_sidebar(event);
        });

        webStateWaiting(false);
      },
      beforeSend: function() {
        webStateWaiting(true);
        return true;
      },
    });
  }

  var laaldea_handle_add_new_to_main_container = function(event) {
    let $button = $(event.currentTarget);

    let postId = $button.attr('data-postid');

    $.ajax({
      url : ajax_params.ajax_url,
      type : 'post',
      data : {
        action : 'laaldea_load_next_new_main',
        postId : postId,
      },
      success : function( response ) {
        let data = JSON.parse(response);
        if(data.html !== undefined) {
          let $mainContainer = $('#news .main-container .news-container');
          let currentHeight = $mainContainer.height();

          $mainContainer.css('height', currentHeight + 'px');
          $mainContainer.prepend(data.html);
         
          $mainContainer.animate({height: $mainContainer.get(0).scrollHeight}, 300, function(){
            $(this).height('auto');

            let $lastNew = $mainContainer.find('.new-container').first();
            let newStart = $lastNew.offset().top - 150;
  
            $('html').stop().animate({ scrollTop: newStart }, 500);

            $lastNew.find('.load-more-link').on('click', function(event) {
              event.preventDefault();
              laaldea_handle_news_load_next(event);
            });
          });
        }

        webStateWaiting(false);
      },
      beforeSend: function() {
        webStateWaiting(true);
        return true;
      },
    });
  }

  /* Crea Tools events */
  var laaldea_handle_filter_tools = function(filterValue, filterType) {
    // updating filter array
    if(window.aldea.tools.container.hasClass(filterValue) ) {
      let index = window.aldea.tools.filters.indexOf(filterValue);
      window.aldea.tools.filters.splice(index, 1);
      window.aldea.tools.loadMoreButton.removeClass('end-list');
    }
    else {
      window.aldea.tools.filters.push(filterValue);
    }
    // adding new filter
    window.aldea.tools.container.toggleClass(filterValue);

    // calculating active elements.
    let shownElements = 0;
    let i = 0;
    
    let filter;
    if(window.aldea.tools.filters.length > 0) {
      window.aldea.tools.filterStr = '';
      for(i=0; i <= window.aldea.tools.filters.length - 1; i++) {
        filter = window.aldea.tools.filters[i];
  
        window.aldea.tools.filterStr += filter + ' ';
        shownElements += window.aldea.tools.container.find('.tool-container.' + filter).length;
      }
    }
    else {
      window.aldea.tools.filterStr = '';
      shownElements = window.aldea.tools.container.find('.tool-container').length;
    }

    // showing/hiding elements
    window.aldea.tools.filterStr = $.trim(window.aldea.tools.filterStr)
    let elements = window.aldea.tools.container.find('.tool-container');
    elements.each(function() {
      if(window.aldea.tools.filters.length == 0) {
        $(this).removeClass('show');
        $(this).removeClass('remove');

        $(this).addClass('show');
      }
      else if( $(this).hasAnyClass(window.aldea.tools.filterStr) ){
        $(this).removeClass('show');
        $(this).removeClass('remove');

        $(this).addClass('show');
      }
      else {
        $(this).removeClass('show');
        $(this).removeClass('remove');

        $(this).addClass('remove');
      }
    });

    if(shownElements < window.aldea.tools.limit) {
      laaldea_handle_tools_load_more(window.aldea.tools.loadMoreButton)
    }
  }
  
  var laaldea_handle_filter_control = function($button) {
    let $filterContainer = $button.parents('.filters-container')
    
    if($button.hasClass('active')) {
      let $hiddenFilters = $filterContainer.find('.term-container.hidden');
      let currentHeight = $filterContainer.outerHeight();
      $filterContainer.css('height', currentHeight + 'px');
      $filterContainer.attr('data-initial-height', currentHeight);
  
      $hiddenFilters.each(function() {
        $(this).toggleClass('hidden');
      });
  
      $filterContainer.animate({height: $filterContainer.get(0).scrollHeight}, 1000, function(){
        $(this).height('auto');
      });
    }
    else {
      let targetHeight = $filterContainer.attr('data-initial-height');;
      $filterContainer.animate({height: targetHeight}, 1000);

      let $filters = $filterContainer.find('.term-container:not(.hidden)');
      $filters.each(function() {
        $(this).toggleClass('hidden');
      });
    }

    let $FilterIcons = $filterContainer.find('.filter-icon .icon');
    $FilterIcons.each(function(){
      $(this).toggleClass('hidden');
    })
  }

  var laaldea_handle_tools_load_more = function($button) {
    let offset = 0;
    let filter;
    let tagId;
    let query;

    if(window.aldea.tools.filters.length > 0) {
      offset = window.aldea.tools.container.find('.tool-container.show').length;
      filter = JSON.stringify(window.aldea.tools.filters);
    }
    else {
      offset = $button.attr('data-offset');
    }
    
    let urlVars = getUrlVars();
    if(urlVars.indexOf('tagId') != -1) {
      tagId = parseInt(urlVars['tagId']);
    }
    if(urlVars.indexOf('query') != -1) {
      query = urlVars['query'];
    }

    $.ajax({
      url : ajax_params.ajax_url,
      type : 'post',
      data : {
        action : 'laaldea_tools_load_more',
        offset : offset,
        filter : filter,
        tagId : tagId,
        query : query
      },
      success : function( response ) {
        let data = JSON.parse(response);
        if(data.html !== undefined) {
          let $mainContainer = window.aldea.tools.container;
          let currentHeight = $mainContainer.height();

          $mainContainer.css('height', currentHeight + 'px');
          $mainContainer.append(data.html);
         
          $mainContainer.animate({height: $mainContainer.get(0).scrollHeight}, 1000, function(){
            $(this).height('auto');
          });
        }

        $button.attr('data-offset', data.count);
        $button.attr('data-limit', data.limit);
        if(true === data.last) {
          $button.fadeTo(500, 0, function() {
            $(this).toggleClass('end-list');
            $(this).css('opacity','');
          });
        }

        // events for the new tools loaded
        $('.main-container .tool-container.loaded .follow-section button').each(function (){
          $(this).on('click', function(event) {
            event.preventDefault();
            laaldea_handle_add_follow(event);
          });
        });
        $('.main-container .tool-container.loaded .thumbnail-container .view-link.type-video').each(function (){
          $(this).on('click', function(event) {
            event.preventDefault();
            laaldea_handle_tools_preview_click(event, this)
          });
        })
        $('.main-container .tool-container.loaded .related-tool-container .view-link-rel.type-video').each(function() {
          $(this).on('click', function(event) {
            event.preventDefault();
            laaldea_handle_tools_preview_click(event, this)
          });
        });
        $('.main-container .tool-container.loaded .resourse-container button').each(function() {
          $(this).on('click', function(event) {
            event.preventDefault();
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = $(this).html();
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
          });
        });
        

        $('.main-container .tool-container.loaded').each(function(){
          $(this).toggleClass('loaded');
        });

        webStateWaiting(false);
      },
      beforeSend: function() {
        webStateWaiting(true);
        return true;
      },
    });

  }

  var laaldea_handle_add_follow = function(event) {
    let $button = $(event.currentTarget);
    let postId = $button.attr('data-postid');
    let add = $button.attr('data-add');
    
    $.ajax({
      url : ajax_params.ajax_url,
      type : 'post',
      data : {
        action : 'laaldea_add_to_follow',
        postId : postId,
        add : add,
      },
      success : function( response ) {
        let data = JSON.parse(response);

        if(false === data.result) {
          //$button.find('.follow-text').html(data.text);
          $button.attr('data-add', '0');
          $button.parents('.tool-container').toggleClass('type-follow');
        }
        else {
          //$button.find('.follow-text').html(data.text);
          $button.attr('data-add', '1');
          $button.parents('.tool-container').toggleClass('type-follow');
        }

        webStateWaiting(false);
      },
      beforeSend: function() {
        webStateWaiting(true);
        return true;
      },
    });
  }

  var laaldea_handle_tools_preview_click = function(event, currentTarget) {
    // hide any active players
    $('body #page > div.modal-root .modal-dialog iframe.active').each(function(){
      $(this).toggleClass('active');
    });

    let currentId = $(currentTarget).attr('data-postId');
    let type = $(currentTarget).attr('data-type');
    let link = $(currentTarget).attr('data-link');
    
    window.aldea.tools.currentPlayer.id = currentId;
    let $modal = $('body #page > div.modal-root');
    let $video = $modal.find('.modal-dialog .type-' + type + '.post-' + currentId);
    
    if($video.length == 0) {
      if($modal.length == 0) {
        let $htmlObject = $('<div></div>')
          .addClass('modal-root')
          .addClass('out')
          .append(
            $('<div></div>')
              .addClass('modal-overlay')
          )
          .append(
            $('<div></div>')
              .addClass('modal-helpler')
          )
          .append(
            $('<div></div>')
              .addClass('modal-dialog')
          );
        $('body #page').append($htmlObject);
        $modal = $('body #page > div.modal-root');

        $('body #page > div.modal-root .modal-overlay').on('click', function(event){
          laaldea_handle_tools_overlay_click(event);
        });
      }

      let $htmlObject;

      $htmlObject = $('<iframe />', {
        class: 'post-' + currentId + ' type-' + type,
        src: link, 
        frameborder : "0",
        allowfullscreen: true,
      });
      
      $modal.find('.modal-dialog').append($htmlObject);
      $video = $('body #page > div.modal-root .modal-dialog .type-' + type + '.post-' + currentId);
    }

    $modal.toggleClass('out');
    setTimeout(function(){
      $modal.toggleClass('in');
    },10);
    $video.toggleClass('active');

  }

  var laaldea_handle_tools_overlay_click = function(event) {
    let $modal = $(event.currentTarget).parents('.modal-root');
    $modal.toggleClass('transition');
    $modal.toggleClass('in');
    setTimeout(function(){
      $modal.toggleClass('transition');
      $modal.toggleClass('out');
    },500);
  }

  /* Crea Courses events */
  var laaldea_handle_filter_courses = function(filterValue) {
    // updating filter array
    if(window.aldea.courses.container.hasClass(filterValue) ) {
      let index = window.aldea.courses.filters.indexOf(filterValue);

      window.aldea.courses.filters.splice(index, 1);
    }
    else {
      window.aldea.courses.filters.push(filterValue);
      //window.aldea.courses.loadMoreButton.removeClass('end-list');
    }
    // adding new filter
    window.aldea.courses.container.toggleClass(filterValue);

    // calculating active elements.
    let shownElements = 0;
    let i = 0;
    
    let filter;
    if(window.aldea.courses.filters.length > 0) {
      window.aldea.courses.filterStr = '';
      for(i=0; i <= window.aldea.courses.filters.length - 1; i++) {
        filter = window.aldea.courses.filters[i];
  
        window.aldea.courses.filterStr += filter + ' ';
        shownElements += window.aldea.courses.container.find('.tutor-course-container.' + filter).length;
      }
    }
    else {
      window.aldea.courses.filterStr = '';
      shownElements = window.aldea.courses.container.find('.tutor-course-container').length;
    }

    // showing/hiding elements
    window.aldea.courses.filterStr = $.trim(window.aldea.courses.filterStr)
    let elements = window.aldea.courses.container.find('.tutor-course-container');
    elements.each(function() {
      if(window.aldea.courses.filters.length == 0) {
        $(this).removeClass('show');
        $(this).removeClass('remove');

        $(this).addClass('show');
      }
      else if( $(this).hasAnyClass(window.aldea.courses.filterStr) ){
        $(this).removeClass('show');
        $(this).removeClass('remove');

        $(this).addClass('show');
      }
      else {
        $(this).removeClass('show');
        $(this).removeClass('remove');

        $(this).addClass('remove');
      }
    });

    // if(shownElements < window.aldea.tools.limit) {
    //   laaldea_handle_tools_load_more(window.aldea.tools.loadMoreButton)
    // }
  }

  var laaldea_handle_filter_control_courses = function($button) {
    let $filterContainer = $button.parents('.filters-container');

    if($button.hasClass('active')) {
      let currentHeight = $filterContainer.height();
      $filterContainer.css('height', currentHeight + 'px');

      $filterContainer.animate({height: $filterContainer.get(0).scrollHeight}, 1000, function(){
        $(this).height('auto');
      });
    }
    else {
      let targetHeight = $filterContainer.attr('data-initial-height');;
      $filterContainer.animate({height: targetHeight}, 1000);
    }

    let $FilterIcons = $filterContainer.find('.filter-icon .icon');
    $FilterIcons.each(function(){
      $(this).toggleClass('hidden');
    })
  }

  /* laaldea home scroll events */
  var laaldea_modify_mousewheel_event = function(event) {
    let scrollPostion = $('#home-intro .slider-container').scrollLeft();
    let delta = event.originalEvent.deltaY;
    let finalPosition = scrollPostion + 3*delta/4;      
    $('#home-intro .slider-container').scrollLeft(finalPosition);
  }
  var laaldea_disable_site_scroll = function(event, ) {
    if (event.type === "mouseenter") {
      $('html').addClass('overflow-hidden-custom');
    }
    else if(event.type === "mouseleave") {
      $('html').removeClass('overflow-hidden-custom');
    }
    else {$('html').removeClass('overflow-hidden-custom');console.log('I should not be triggered')}
  }

  /* Home events */
  var laaldea_handle_intro_slider = function($button) {
    let $container = $button.parents('.arrow-container');
    let direction = $container.hasClass('prev')?0:1;
    let $slider = $('#home-intro .slider-container');
    let windowWidth = window.innerWidth;
  
    if(direction) {
      let movement = Math.floor(($slider.scrollLeft()+1)/windowWidth) + 1;
      $slider.animate({scrollLeft: movement*windowWidth}, 500);

      if($container.siblings('.arrow-container').hasClass('disabled')) {
        $container.siblings('.arrow-container').removeClass('disabled');
      }
      if(movement == 2) {
        $container.toggleClass('disabled');
      }

    }
    else {
      let movement = Math.ceil(($slider.scrollLeft()-1)/windowWidth) - 1;
      $slider.animate({scrollLeft: movement*windowWidth}, 500);

      if($container.siblings('.arrow-container').hasClass('disabled')) {
        $container.siblings('.arrow-container').removeClass('disabled');
      }
      if(movement == 0) {
        $container.toggleClass('disabled');
      }
    }
  }

  var laaldea_check_offset_arrow_left = function (className) {
    var leftPosition = $('#home-intro .slider-container').scrollLeft();
    
    return function () {
      var $this = $(this);
      $this.toggleClass(className, (leftPosition <= 0));
    };
  }
  var laaldea_check_offset_arrow_right = function(className) {
    var leftPosition = $('#home-intro .slider-container').scrollLeft();

    return function () {
      var $this = $(this);
      var windowWidth = window.innerWidth;
      $this.toggleClass(className, (leftPosition >= windowWidth*2));
    };
  }
  var laaldea_handle_slider_scroll = function(event) {
    $('#home-intro .arrow-container.prev').each(laaldea_check_offset_arrow_left('disabled'));
    $('#home-intro .arrow-container.next').each(laaldea_check_offset_arrow_right('disabled'));
  }

  /* laaldea tools events */
  var laaldea_handle_tool_aldea_video_click = function(event, currentTarget) {
    let id = $(currentTarget).attr('data-postId');
    let $toolContainer = $(currentTarget).parents('.tool-container');
    let $iframe = $toolContainer.find('.iframe-container div');
    let youtubeId = $toolContainer.attr('data-youtubeid');
    
    if(!window.aldea.videos[id]) {
      var player = new YT.Player(
        'player-' + id, {
          videoId: youtubeId,
          events: {
            'onStateChange': onPlayerStateChange,
            'onReady': onPlayerReady,
          }
      });
      window.aldea.videos[id]={};
      window.aldea.videos[id].iframe = $iframe;
      window.aldea.videos[id].player = player;
    }

    $(currentTarget).toggleClass('remove');
  }

  var laaldea_handle_filter_tools_aldea = function(filterValue, filterType) {
    // updating filter array
    if(window.aldea.tools.container.hasClass(filterValue) ) {
      let index = window.aldea.tools.filters.indexOf(filterValue);
      window.aldea.tools.filters.splice(index, 1);
      //window.aldea.tools.loadMoreButton.removeClass('end-list');
    }
    else {
      window.aldea.tools.filters.push(filterValue);
    }
    // adding new filter
    window.aldea.tools.container.toggleClass(filterValue);

    // calculating active elements.
    let shownElements = 0;
    let i = 0;

    let filter;
    if(window.aldea.tools.filters.length > 0) {
      window.aldea.tools.filterStr = '';
      for(i=0; i <= window.aldea.tools.filters.length - 1; i++) {
        filter = window.aldea.tools.filters[i];

        window.aldea.tools.filterStr += filter + ' ';
        shownElements += window.aldea.tools.container.find('.tool-container.' + filter).length;
      }
    }
    else {
      window.aldea.tools.filterStr = '';
      shownElements = window.aldea.tools.container.find('.tool-container').length;
    }

    // showing/hiding elements
    window.aldea.tools.filterStr = $.trim(window.aldea.tools.filterStr)
    let elements = window.aldea.tools.container.find('.tool-container');
    elements.each(function() {
      if(window.aldea.tools.filters.length == 0) {
        $(this).removeClass('show remove hide');
        $(this).addClass('show');
      }
      else if( $(this).hasAnyClass(window.aldea.tools.filterStr) ){
        $(this).removeClass('show remove hide');
        $(this).addClass('show');
      }
      else {
        $(this).removeClass('show remove hide');
        $(this).addClass('remove');
      }
    });

    setTimeout(function(){
      let elements = window.aldea.tools.container.find('.tool-container.remove');
      elements.each(function(){
        $(this).addClass('hide');
      });
    },500);

    // if(shownElements < window.aldea.tools.limit) {
    //   laaldea_handle_tools_load_more(window.aldea.tools.loadMoreButton)
    // }
  }

  var laaldea_handle_filter_video_tools_aldea = function(filterValue, filterType) {
    // updating filter array
    if(window.aldea.tools.container.hasClass(filterValue) ) {
      let index = window.aldea.tools.filters.indexOf(filterValue);
      window.aldea.tools.filters.splice(index, 1);
      //window.aldea.tools.loadMoreButton.removeClass('end-list');
    }
    else {
      window.aldea.tools.filters.push(filterValue);
    }
    // adding new filter
    window.aldea.tools.container.toggleClass(filterValue);

    // calculating active elements.
    let shownElements = 0;
    let i = 0;

    let filter;
    if(window.aldea.tools.filters.length > 0) {
      window.aldea.tools.filterStr = '';
      for(i=0; i <= window.aldea.tools.filters.length - 1; i++) {
        filter = window.aldea.tools.filters[i];

        window.aldea.tools.filterStr += filter + ' ';
        shownElements += window.aldea.tools.container.find('.term-container.' + filter).length;
      }
    }
    else {
      window.aldea.tools.filterStr = '';
      shownElements = window.aldea.tools.container.find('.term-container').length;
    }

    // showing/hiding elements
    window.aldea.tools.filterStr = $.trim(window.aldea.tools.filterStr)
    let elements = window.aldea.tools.container.find('.term-container');
    elements.each(function() {
      if(window.aldea.tools.filters.length == 0) {
        $(this).removeClass('remove');        
        $(this).addClass('show');
      }
      else if( $(this).hasAnyClass(window.aldea.tools.filterStr) ){
        $(this).removeClass('remove');
        $(this).addClass('show');
      }
      else {
        $(this).removeClass('show');
        $(this).addClass('remove');
      }
    });

    setTimeout(function(){
      let elements = window.aldea.tools.container.find('.term-container.remove');
      elements.each(function(){
        $(this).addClass('hide');
      });
    },500);

    setTimeout(function() {
      let elements = window.aldea.tools.container.find('.term-container.show.hide');
      elements.each(function(){
        $(this).removeClass('hide');
      });
    }, 10);

    // if(shownElements < window.aldea.tools.limit) {
    //   laaldea_handle_tools_load_more(window.aldea.tools.loadMoreButton)
    // }
  }

  var laaldea_handle_tools_aldea_load_more = function(event, $button) {
    let offset = 0;
    let filter;
    let tagId;
    let query;
    let toolsTemplate;

    if(window.aldea.tools.filters.length > 0) {
      offset = window.aldea.tools.container.find('.tool-container.show').length;
      filter = JSON.stringify(window.aldea.tools.filters);
    }
    else {
      offset = $button.attr('data-offset');
    }
    toolsTemplate = $button.attr('data-toolstemplate');
    
    // let urlVars = getUrlVars();
    // if(urlVars.indexOf('tagId') != -1) {
    //   tagId = parseInt(urlVars['tagId']);
    // }
    // if(urlVars.indexOf('query') != -1) {
    //   query = urlVars['query'];
    // }

    $.ajax({
      url : ajax_params.ajax_url,
      type : 'post',
      data : {
        action : 'laaldea_tools_aldea_load_more',
        offset : offset,
        filter : filter,
        tagId : tagId,
        query : query,
        toolsTemplate : toolsTemplate,
      },
      success : function( response ) {
        let data = JSON.parse(response);
        if(data.html !== undefined) {
          let $mainContainer = window.aldea.tools.container;
          let currentHeight = $mainContainer.height();

          $mainContainer.css('height', currentHeight + 'px');
          $mainContainer.append(data.html);
          $mainContainer.append('<div class="flex-break"></div>');
         
          $mainContainer.animate({height: $mainContainer.get(0).scrollHeight}, 1000, function(){
            $(this).height('auto');
          });
        }

        $button.attr('data-offset', data.count);
        $button.attr('data-limit', data.limit);
        if(true === data.last) {
          $button.fadeTo(500, 0, function() {
            $(this).toggleClass('end-list');
            $(this).css('opacity','');
          });
        }

        // events for the new tools loaded
        // Copy resourse link
        $('#stories .content-column .tool-container.loaded .resource-section button').each(function(){
          $(this).on('click', function(event) {
            event.preventDefault();
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = $(this).attr('data-url');
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            $button = $(this);
            $button.toggleClass('active');
            setTimeout(function(){
              $button.toggleClass('active');
            },2000)
          });
        });

        // Preview event
        $('#stories.libro .tool-container.loaded .thumbnail-container button').each(function() {
          $(this).on('click', function(event) {
            if($(this).attr('data-link')) {
              event.preventDefault();
              laaldea_handle_tools_aldea_preview_click(event, this);
            }
          });
        });
        

        $('.main-container .tool-container.loaded').each(function(){
          $(this).toggleClass('loaded');
        });

        webStateWaiting(false);
      },
      beforeSend: function() {
        webStateWaiting(true);
        return true;
      },
    });
  }

  var laaldea_handle_tools_aldea_video_load_more = function(slider) {
    slider.on('afterChange', function(event, slick, currentSlide) {
      var slideCount = slick.$slides.length
      var slidesToScroll = slick.options.slidesToScroll;
      //var slidesToShow = slick.options.slidesToShow;
      let page = $(this).attr('data-page');
      let maxPages = $(this).attr('data-max_num_pages');
      let postPerPage = $(this).attr('data-post_per_page');
      let toolsTemplate = $(this).attr('data-toolstemplate');
      let termId = $(this).attr('data-term_id');
      let $slider = $(this);

      if(slideCount <= currentSlide + slidesToScroll && maxPages > page) {
        $slider.parents('.term-container').find('.slick-arrow').toggleClass('loading-more');

        $.ajax({
          url : ajax_params.ajax_url,
          type : 'post',
          data : {
            action : 'laaldea_tools_aldea_video_load_more',
            page : page,
            postPerPage : postPerPage,
            toolsTemplate : toolsTemplate,
            termId : termId,
          },
          success : function( response ) {
            //
            //debugger
            let data = JSON.parse(response);
            if(data.html !== undefined) {
              console.log(data.html);
              
              for(let i = 0; i<=data.html.length - 1; i++) {
                $slider.slick('slickAdd', data.html[i]);
              }
              // let $mainContainer = window.aldea.tools.container;
            }
            
            $slider.attr('data-page', data.page);
            $slider.parents('.term-container').find('.slick-arrow').toggleClass('loading-more');
            
            // events for the new tools loaded
            // add click events to loaded videos
            // debugger;
            $slider.find('.tool-container.loaded .thumbnail-container').each(function(){
              $(this).on('click', function(event) {
                laaldea_handle_tool_aldea_video_click(event, this);
              });
            });
            
    
            $slider.find('.tool-container.loaded').each(function(){
              $(this).toggleClass('loaded');
            });
    
            webStateWaiting(false);
          },
          beforeSend: function() {
            webStateWaiting(true);
            return true;
          },
        });

      }
    });
  }

  var laaldea_handle_tools_aldea_preview_click = function(event, currentTarget) {
    // hide any active players
    $('body #page > div.modal-root .modal-dialog iframe.active').each(function(){
      $(this).toggleClass('active');
    });

    let currentId = $(currentTarget).attr('data-postId');
    let type = $(currentTarget).attr('data-type');
    let link = $(currentTarget).attr('data-link');
    
    let $modal = $('body #page > div.modal-root');
    let $video = $modal.find('.modal-dialog .type-' + type + '.post-' + currentId);
    
    if($video.length == 0) {
      if($modal.length == 0) {
        let $htmlObject = $('<div></div>')
          .addClass('modal-root')
          .addClass('out')
          .append(
            $('<div></div>')
              .addClass('modal-overlay')
          )
          .append(
            $('<div></div>')
              .addClass('modal-helpler')
          )
          .append(
            $('<div></div>')
              .addClass('modal-dialog')
          );
        $('body #page').append($htmlObject);
        $modal = $('body #page > div.modal-root');

        $('body #page > div.modal-root .modal-overlay').on('click', function(event){
          laaldea_handle_tools_aldea_overlay_click(event);
        });
      }

      let $htmlObject;

      $htmlObject = $('<iframe />', {
        class: 'post-' + currentId + ' type-' + type,
        src: link, 
        frameborder : "0",
        allowfullscreen: true,
      });
      
      $modal.find('.modal-dialog').append($htmlObject);
      $video = $('body #page > div.modal-root .modal-dialog .type-' + type + '.post-' + currentId);
    }

    $modal.toggleClass('out');
    setTimeout(function(){
      $modal.toggleClass('in');
    },10);
    $video.toggleClass('active');

  }

  var laaldea_handle_tools_aldea_overlay_click = function(event) {
    let $modal = $(event.currentTarget).parents('.modal-root');
    $modal.toggleClass('transition');
    $modal.toggleClass('in');
    setTimeout(function(){
      $modal.toggleClass('transition');
      $modal.toggleClass('out');
    },500);
  }

  /* laaaldea community events */
  var laaldea_handle_community_load_more = function(event, $button) {
    let page = $button.attr('data-page');
    let maxPages = $button.attr('data-max_num_pages');
    let postPerPage = $button.attr('data-post_per_page');
    let termId = $button.attr('data-term_id');
    let $postsContainer = $button.parents('.load-more-container').siblings('.posts-container');

    $.ajax({
      url : ajax_params.ajax_url,
      type : 'post',
      data : {
        action : 'laaldea_community_load_more',
        page : page,
        postPerPage : postPerPage,
        termId : termId,
        maxPages : maxPages,
      },
      success : function( response ) {
        let data = JSON.parse(response);
        if(data.html !== undefined) {
          let currentHeight = $postsContainer.height();

          $postsContainer.css('height', currentHeight + 'px');
          $postsContainer.append(data.html);
         
          $postsContainer.animate({height: $postsContainer.get(0).scrollHeight}, 1000, function() {
            $(this).height('auto');
          });
        }
        
        // $postsContainer.find('.post-container.loaded').each(function(){
        //   $(this).toggleClass('loaded');
        // });

        $button.attr('data-page', data.page);
        if(false === data.load_more) {
          $button.fadeTo(500, 0, function() {
            $(this).toggleClass('end-list');
            $(this).css('opacity','');
          });
        }

        webStateWaiting(false);
      },
      beforeSend: function() {
        webStateWaiting(true);
        return true;
      },
    });
  }

  /**
  * Disables all links and changes cursor for the website, used in ajax calls.
  */
  var webStateWaiting = function(waiting){
    if(waiting) {
      $('body').css('cursor', 'progress');
    }
    else {
      $('body').css('cursor', 'default');
    }
    
    $('.site-content a').each(function() {
      if(!$(this).hasClass('disabled') && waiting && !$(this).hasClass('language-option') && !$(this).hasClass('menu-end-post-denominacion-a')) {
        $(this).addClass('disabled');	
      }
      else if ($(this).hasClass('disabled') && !waiting && !$(this).hasClass('language-option') && !$(this).hasClass('menu-end-post-denominacion-a')) {
        $(this).removeClass('disabled');
      }
    });
  }

  var isMobile = function(){
    return $(window).width() <= 768;
  };
  var isDesktop = function(){
    return $(window).width() > 768;
  };

  $(window).on('resize', function(){
    if($(window).width() < 992) {
      $('#stories .header-row .slider-container').slick({
        infinite: true,
        autoplay: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: false,
        prevArrow: '#stories .header-row .slick-prev',
        nextArrow: '#stories .header-row .slick-next',
      });
    }
    else {
      if($('#stories .header-row .slider-container').hasClass('slick-slider')) {
        $('#stories .header-row .slider-container').slick('unslick');
      }
    }
  });

  $(document).ready(function () {
    if($('body.home-new').length > 0) {
      $('#home-intro').on('mouseenter', function(event){
        laaldea_disable_site_scroll(event);
        $('#home-intro .slider-container').on('scroll', laaldea_handle_slider_scroll);
        $(document).on('mousewheel', laaldea_modify_mousewheel_event);
      });    
      $('#home-intro').on('mouseleave', function(event) {
        laaldea_disable_site_scroll(event);
        $('#home-intro .slider-container').off('scroll', laaldea_handle_slider_scroll);
        $(document).off('mousewheel', laaldea_modify_mousewheel_event);
      });
      
      $('#home-intro .arrow-container button').each(function() {
        $(this).on('click', function(event) {
          event.preventDefault();
          let $button = $(event.currentTarget);
          $button.toggleClass('active');
  
          laaldea_handle_intro_slider($button);
        });
      });

      if(!isMobile()) {

        var rellax = new Rellax('.rellax', {
          center: true
        });
  
        TweenLite.defaultEase = Linear.easeNone;
        var controller = new ScrollMagic.Controller();
        var tl = new TimelineMax();
  
        tl.from('.home-section#home-radio .background-character', 150, {
          top: "140%",rotationX: 0,rotationY: 0,rotationZ: 0,ease: "power1.out",
        });
        tl.to('.home-section#home-radio .background-character', 100,{
          top: "240px",rotationX: 5,rotationY: -5,rotationZ: 15,ease: "power1.out",
        });
        tl.to('.home-section#home-radio .background-character', 100,{
          top: "240px",rotationX: -5,rotationY: 5,rotationZ: 0,ease: "power1.out",
        });
        tl.to('.home-section#home-radio .background-character', 100,{
          top: "240px",rotationX: 5,rotationY: -5,rotationZ: -15,ease: "power1.out",
        });
        tl.to('.home-section#home-radio .background-character', 100,{
          top: "240px",rotationX: 5,rotationY: -5,rotationZ: 15,ease: "power1.out",
        });
        tl.to('.home-section#home-radio .background-character', 100,{
          top: "240px",rotationX: -5,rotationY: 5,rotationZ: 0,ease: "power1.out",
        });
        tl.to('.home-section#home-radio .background-character', 100,{
          top: "240px",rotationX: 5,rotationY: -5,rotationZ: -15,ease: "power1.out",
        });
        tl.to('.home-section#home-radio .background-character', 150,{
          top: "140%",rotationX: 0,rotationY: 0,rotationZ: 0,ease: "power1.out",
        });
        
        var tlPlant2 = new TimelineMax();
        tlPlant2.from('.home-section#home-radio .background-plant', 180, {
          rotationX: 0,rotationY: 0,rotationZ: 0,ease: "power1.out",
        });
        tlPlant2.to('.home-section#home-radio .background-plant', 180,{
          rotationX: -5,rotationY: 5,rotationZ: 5,ease: "power1.out",
        });
        tlPlant2.to('.home-section#home-radio .background-plant', 180,{
          rotationX: -15,rotationY: 15,rotationZ: 8,ease: "power1.out",
        });
        tlPlant2.to('.home-section#home-radio .background-plant', 180,{
          rotationX: -5,rotationY: 5,rotationZ: 5,ease: "power1.out",
        });
        tlPlant2.to('.home-section#home-radio .background-plant', 180,{
          rotationX: 5,rotationY: -5,rotationZ: 0,ease: "power1.out",
        });
        tl.add(tlPlant2, "0");
  
        var scene = new ScrollMagic.Scene({
          triggerElement: "#home-story",
          duration: "900",
          offset: "238"
        }).setTween(tl).addTo(controller);
          // .addIndicators({
          //   name: "Box Timeline",
          //   colorTrigger: "white",
          //   colorStart: "white",
          //   colorEnd: "white"
          // })          
      }

      $('.team-carousel').slick({
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 2,
        prevArrow: '.home-section#home-team .slick-prev',
        nextArrow: '.home-section#home-team .slick-next',
        responsive: [
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          },
          {
            breakpoint: 769,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          },

        ],
      });
    }
    if($('body.stories').length > 0) {
      window.aldea = {};
      window.aldea.tools = {
        container : $('#stories .content-column .main-container'), 
        filters : new Array(),
        // limit : $('#stories .main-row .content-column').attr('data-limit'),
        filterStr : '',
        loadMoreButton : $('#stories .main-row .load-more-container button'),
        // currentPlayer: {},
        // videos: {},
      };
      window.aldea.videos = {};

      // header character text event
      $('#stories .header-row .character-container .char').each(function() {
        $(this).on('mouseenter', function(){
          $('#stories .header-row .text-container.show').each(function(){
            $(this).toggleClass('show');
          });
          dataClass = $(this).attr('data-text');
          $('#stories .header-row .text-container.' + dataClass).toggleClass('show');
        })
      });

      if($(window).width() < 992) {
        $('#stories .header-row .slider-container').slick({
          infinite: true,
          autoplay: false,
          speed: 300,
          slidesToShow: 1,
          slidesToScroll: 1,
          variableWidth: false,
          prevArrow: '#stories .header-row .slick-prev',
          nextArrow: '#stories .header-row .slick-next',
        });
      }

      // Filter control event
      $('#stories .filters-column .filters-container .filter-control').each(function(){
        $(this).on('click', function(event) {
          event.preventDefault();
          let $button = $(event.currentTarget);
          $button.toggleClass('active');
  
          laaldea_handle_filter_control($button);
        });
      });

      // customize page selects (filter type select)
      $('#stories .content-column .type-filters-section select').select2({minimumResultsForSearch: -1,});

      // Copy resourse link
      $('#stories .content-column .resource-section button').each(function(){
        $(this).on('click', function(event) {
          event.preventDefault();
          var tempInput = document.createElement("input");
          tempInput.style = "position: absolute; left: -1000px; top: -1000px";
          tempInput.value = $(this).attr('data-url');
          document.body.appendChild(tempInput);
          tempInput.select();
          document.execCommand("copy");
          document.body.removeChild(tempInput);

          $button = $(this);
          $button.toggleClass('active');
          setTimeout(function(){
            $button.toggleClass('active');
          },2000)
        });
      });

      // type filter (libro - video -audio)
      $('#stories .type-filter-container .type-select').on('change', function() {
        let tool_template = $(this).val();
        $.ajax({
          url : ajax_params.ajax_url,
          type : 'post',
          data : {
            action : 'laaldea_tools_aldea_template_change',
            tool_template : tool_template,
          },
          success : function( response ) {
            let data = JSON.parse(response);
            if(data.html !== undefined) {
              let $mainContainer = $('#stories .content-column');
              
              $mainContainer.find('.main-container').remove();
              $mainContainer.find('.load-more-container').remove();
              // $mainContainer.empty();
              $mainContainer.append(data.html);

              $("#stories").removeClass();
              $("#stories").addClass(data.tool_class);

              if(data.tool_template == 'video' || data.tool_template == 'audio') {
                $('#stories .content-column .load-more-button').addClass('end-list');

                // initialize any sliders that where loaded.
                $('#stories .content-column .term-container .carousel-container').each(function (){
                  let $prevArrow = $(this).parent('.term-container').children('.slick-prev');
                  let $nextArrow = $(this).parent('.term-container').children('.slick-next');
                  $(this).slick({
                    infinite: false,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    prevArrow: $prevArrow,
                    nextArrow: $nextArrow,
                    variableWidth: false,
                    responsive: [
                      {
                        breakpoint: 700,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          infinite: false,
                          variableWidth: true,
                        }
                      },
                    ],
                  });
                });

                $('#stories.video .tool-container .thumbnail-container').on('click', function(event) {
                  laaldea_handle_tool_aldea_video_click(event, this);
                });

                $('#stories.video .term-container .carousel-container').each(function() {
                  laaldea_handle_tools_aldea_video_load_more($(this));
                });
              }
              else {
                let $button = $('#stories .content-column .load-more-button')
                $offset = $button.attr('data-offset');
                $postCount = $button.attr('data-post_count');

                if($postCount > $offset) {
                  $button.removeClass('end-list');
                }
              }
              
            }
    
            webStateWaiting(false);
          },
          beforeSend: function() {
            webStateWaiting(true);
            return true;
          },
        });
      });
      // term filter (libro o recurso) (libro 1 - libro 2, audiolibros, canciones, etc).
      $('#stories .filters-column .term-container button').each(function() {
        $(this).on('click', function(event) {
          event.preventDefault();
          let $button = $(event.currentTarget);
          $button.toggleClass('active');
  
          if($('#stories').hasClass('video')) {
            laaldea_handle_filter_video_tools_aldea('term-' + $button.attr('data-termid'), 'category');
          }
          else {
            laaldea_handle_filter_tools_aldea('term-' + $button.attr('data-termid'), 'category');
          }
        });
      });

      // preview link book
      $('#stories.libro .tool-container .thumbnail-container button').each(function() {
        $(this).on('click', function(event) {
          if($(this).attr('data-link')) {
            event.preventDefault();
            laaldea_handle_tools_aldea_preview_click(event, this);
          }
        });
      });

      // Load more books
      $('#stories .content-column .load-more-button').on('click', function(event) {
        event.preventDefault();
        let $button = $(event.currentTarget);
        laaldea_handle_tools_aldea_load_more(event, $button);
      });

      // Add youtube frame API
      var tag = document.createElement('script');
      tag.id = 'youtube-iframe-api';
      tag.src = 'https://www.youtube.com/iframe_api';
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      
      // video/audio sliders
      $('#stories.video .content-column .term-container .carousel-container').each(function (){
        let $prevArrow = $(this).parent('.term-container').children('.slick-prev');
        let $nextArrow = $(this).parent('.term-container').children('.slick-next');
        $(this).slick({
          infinite: false,
          slidesToShow: 2,
          slidesToScroll: 2,
          prevArrow: $prevArrow,
          nextArrow: $nextArrow,
          variableWidth: false,
          responsive: [
            {
              breakpoint: 650,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                variableWidth: true,
              }
            },
          ],
        });
      });

      $('#stories.video .tool-container .thumbnail-container').on('click', function(event) {
        laaldea_handle_tool_aldea_video_click(event, this);
      });

      // Load more video/audio
      $('#stories.video .term-container .carousel-container').each(function() {
        laaldea_handle_tools_aldea_video_load_more($(this));
      });
    }
    if($('body.radio').length > 0) {
      $('.coming-carousel').slick({
        infinite: true,
        autoplay: true,
        vertical: true,
        verticalSwiping: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: false,
        prevArrow: '#radio .slider-column .slick-prev',
        nextArrow: '#radio .slider-column .slick-next',
      });
    }
    if($('body.aldea-community').length > 0) {
      // Load more posts
      // Load more books
      $('#community .content-column .load-more-button').on('click', function(event) {
        event.preventDefault();
        let $button = $(event.currentTarget);
        laaldea_handle_community_load_more(event, $button);
      });
    }
    if($('body.aldea-info').length > 0) {
      TweenLite.defaultEase = Linear.easeNone;
      var controller = new ScrollMagic.Controller();
      var tl = new TimelineMax();

      tl.to('.intro-row div.intro-text:first-child', 50, {
        opacity: 1, scale: 1,ease: "power1.out",
      });
      tl.to('.intro-row div.intro-text:first-child', 300, {
        opacity: 1, scale: 1.1,ease: "power1.out",
      });
      tl.to('.intro-row div.intro-text:first-child', 300, {
        opacity: 1, scale: 1,ease: "power1.out",
      });
      
      var tl2 = new TimelineMax();
      tl2.to('.intro-row div.intro-text:nth-child(2)', 50, {
        opacity: 1, scale: 1,ease: "power1.out",
      });
      tl2.to('.intro-row div.intro-text:nth-child(2)', 300, {
        opacity: 1, scale: 1.1,ease: "power1.out",
      });
      tl2.to('.intro-row div.intro-text:nth-child(2)', 300, {
        opacity: 1, scale: 1,ease: "power1.out",
      });
      tl.add(tl2, "50");

      var tl3 = new TimelineMax();
      tl3.to('.intro-row div.intro-text:nth-child(3)', 50, {
        opacity: 1, scale: 1,ease: "power1.out",
      });
      tl3.to('.intro-row div.intro-text:nth-child(3)', 300, {
        opacity: 1, scale: 1.1,ease: "power1.out",
      });
      tl3.to('.intro-row div.intro-text:nth-child(3)', 300, {
        opacity: 1, scale: 1,ease: "power1.out",
      });
      tl.add(tl3, "100");

      var scene = new ScrollMagic.Scene({
        triggerElement: ".aldea-info .header-row",
        duration: "80%",
        offset: "350%"
      }).setTween(tl).addTo(controller);
        // .addIndicators({
        //   name: "Box Timeline",
        //   colorTrigger: "black",
        //   colorStart: "black",
        //   colorEnd: "black"
        // })

      $('.allies-carousel').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        prevArrow: '#aldea .allies-row .slick-prev',
        nextArrow: '#aldea .allies-row .slick-next',
        variableWidth: true,
        responsive: [
          {
            breakpoint: 650,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          },
        ],
      });
      $('.gallery-row .carousel-container').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 2,
        prevArrow: '.gallery-row .slick-prev',
        nextArrow: '.gallery-row .slick-next',
        responsive: [
          {
            breakpoint: 650,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          },
        ],
      });
      $('.media-row .media-carousel').slick({
        infinite: false,
        pauseOnHover: true,
        autoplay: false,
        autoplaySpeed: 100000,
        slidesToShow: 3,
        slidesToScroll: 3,
        prevArrow: '#aldea .media-row .slick-prev',
        nextArrow: '#aldea .media-row .slick-next',
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          },
          {
            breakpoint: 400,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          },

        ],
      });

      $('#aldea .history-row .load-more-button').on('click', function(event){
        $sectionContent = $(this).parents('.history-row').find('.section-content');
        $sectionContent.toggleClass('full');

        $(this).toggleClass('end-list')
      });
    }

    if($('.page-id-35').length > 0) {
      laadea_validate_promo_form_jquery();
    }

    if($('.learning-home').length > 0) {
      $('.tools-row .tools-carousel').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        variableWidth: false,
        dots: true,
        arrows: false,
      });

      $('.news-row .news-carousel').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        variableWidth: false,
        dots: true,
        arrows: false,
      });

      $('.forum-row .forum-carousel').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        variableWidth: false,
        dots: true,
        arrows: false,
      });
    }

    if($('.bbpress').length > 0) {
      $('.bbp-breadcrumb .bbp-breadcrumb-home').attr('href','https://laaldea.co/learning-home/');

      $('.topic-section .new-topic-button-container button').each(function() {
        $(this).on('click', function(event) {
          event.preventDefault();
          laaldea_handle_show_add_topic_modal(event, this);
        });
      });
      
      $('.topic-section .new-topic-form-container .modal-overlay').each(function() {
        $(this).on('click', function(event) {
          event.preventDefault();
          laaldea_handle_hide_add_topic_modal(event, this);
        });
      }); 

      $('.replies-section .bbp-admin-links .bbp-reply-to-link, .replies-section .bbp-admin-links .bbp-topic-reply-link').each(function() {
        $(this).on('click', function(event) {
          event.preventDefault();
          laaldea_handle_display_reply_box(event, this);
        });
      });
    }

    if($('.bbpress.single-forum').length > 0) {
      $('.topic-section .topic-replies .load-more-link-container button').on('click', function(event) {
        event.preventDefault();
        laaldea_handle_topic_load_more(event);
      });
    }

    if($('#news').length > 0) {
      $('#news .main-container .load-more-link').on('click', function(event){
        event.preventDefault();
        laaldea_handle_news_load_next(event);
      });

      $('#news .sidebar .actions .load-more-link').on('click', function(event){
        event.preventDefault();
        laaldea_handle_news_load_more_sidebar(event);
      });

      $('#news .sidebar .new-container .load-new-button').on('click', function(event){
        event.preventDefault();
        laaldea_handle_add_new_to_main_container(event);
      });
    }
       
    if($('#tools').length > 0) {
      window.aldea = {};
      window.aldea.tools = {
        container : $('#tools .main-container .tools-container'), 
        filters : new Array(),
        limit : $('#tools .main-container .tools-container').attr('data-limit'),
        filterStr : '',
        loadMoreButton : $('.main-container .load-more-container button'),
        currentPlayer: {},
        videos: {},
      };
      $('.main-container .target-filter-container').attr('data-top', $('.main-container .target-filter-container').offset().top);

      // Filter events
      $('.sidebar .follow button').on('click', function(event) {
        event.preventDefault();
        let $button = $(event.currentTarget);
        $button.toggleClass('active');

        laaldea_handle_filter_tools('type-' + $button.attr('data-filter'), 'category');
      });
      $('.sidebar .term-container button').each(function() {
        $(this).on('click', function(event) {
          event.preventDefault();
          let $button = $(event.currentTarget);
          $button.toggleClass('active');
  
          laaldea_handle_filter_tools('term-' + $button.attr('data-termid'), 'category');
        });
      });
      
      $('.main-container .target-filter-container button').each(function(){
        $(this).on('click', function(event) {
          event.preventDefault();
          let $currentTarget = $('.main-container .target-filter-container button.active');
          if($currentTarget.length > 0) {
            $currentTarget.toggleClass('active');
            laaldea_handle_filter_tools('target-' + $currentTarget.attr('data-filter'), 'category');
          }

          let $button = $(event.currentTarget);
          $button.toggleClass('active');

          laaldea_handle_filter_tools('target-' + $button.attr('data-filter'), 'category');
        });
      });

      // Filter control event
      $('.sidebar .filters-container .filter-control').each(function(){
        $(this).on('click', function(event) {
          event.preventDefault();
          let $button = $(event.currentTarget);
          $button.toggleClass('active');
  
          laaldea_handle_filter_control($button);
        });
      });

      // Follow link event
      $('.main-container .tool-container .follow-section button').each(function() {
        $(this).on('click', function(event) {
          event.preventDefault();
          laaldea_handle_add_follow(event);
        });
      });

      // Copy resourse link
      $('.main-container .tool-container .resource-section button').each(function(){
        $(this).on('click', function(event) {
          event.preventDefault();
          var tempInput = document.createElement("input");
          tempInput.style = "position: absolute; left: -1000px; top: -1000px";
          tempInput.value = $(this).attr('data-url');
          document.body.appendChild(tempInput);
          tempInput.select();
          document.execCommand("copy");
          document.body.removeChild(tempInput);

          $button = $(this);
          $button.toggleClass('active');
          setTimeout(function(){
            $button.toggleClass('active');
          },2000)
        });
      });

      // View video
      $('.main-container .tool-container .thumbnail-container .view-link').each(function() {
        $(this).on('click', function(event) {
          if($(this).attr('data-link')) {
            event.preventDefault();
            laaldea_handle_tools_preview_click(event, this);
          }
        });
      });
      $('.main-container .tool-container .related-tool-container .view-link-rel').each(function(){
        $(this).on('click', function(event) {
          if($(this).attr('data-link')) {
            event.preventDefault();
            laaldea_handle_tools_preview_click(event, this);
          }
        });
      });

      $('.main-container .load-more-container button').on('click', function(event) {
        event.preventDefault();
        let $button = $(event.currentTarget);
        laaldea_handle_tools_load_more($button);
      });
    }

    if($('.post-type-archive-courses').length > 0) {
      window.aldea = {};
      window.aldea.courses = {
        container : $('.courses-section .tutor-courses'), 
        filters : new Array(),
        filterStr : '',
      };

      // Filter control event
      $('.courses-sidebar .filters-container .filter-control').each(function(){
        let $buttonContainer = $(this).parents('.filter-title');
        let $filterContainer = $(this).parents('.filters-container');
        let collapsedHeight = $buttonContainer.outerHeight();
        $filterContainer.attr('data-initial-height', collapsedHeight);

        $(this).on('click', function(event) {
          event.preventDefault();
          let $button = $(event.currentTarget);
          $button.toggleClass('active');
  
          laaldea_handle_filter_control_courses($button);
        });
      });

      // State filters
      $('.courses-sidebar .status-filter button').each(function() {
        $(this).on('click', function(event) {
          event.preventDefault();
          let $button = $(event.currentTarget);
          $button.toggleClass('active');
  
          laaldea_handle_filter_courses($button.attr('data-filter'));
        });
      });
    }

  });

  $(window).scroll(function () {
		"use strict";
		var topOfWindow = $(window).scrollTop();

		function _checkOffset_menu(className) {
			return function () {
				var $this = $(this),
          imagePos = $this.attr('data-top');

        if(topOfWindow + 118 >= imagePos && !$this.hasClass(className)) {
          $this.toggleClass(className);
        }
        else if(topOfWindow + 118 < imagePos && $this.hasClass(className)) {
          $this.toggleClass(className);
        }
			};
		}
    
    if($('#tools').length > 0) {
      $('.main-container .target-filter-container').each(_checkOffset_menu('fixed'));
      $('.sidebar .tools-sidebar-container').each(_checkOffset_menu('fixed'));
    }
		
  });
  
} (jQuery) );