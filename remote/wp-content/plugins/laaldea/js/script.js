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
  
  var laaldea_handle_topic_load_more = function(event) {
    let $button = $(event.currentTarget);

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

          $('.bbpress .topic-section #bbpress-forums .load-more-link-container').before(data.html);
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

  var laaldea_handle_news_load_next = function(event) {
    let $button = $(event.currentTarget);

    let postId = $button.attr('data-postId');

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
          $mainContainer.append(data.html);
         
          $mainContainer.animate({height: $mainContainer.get(0).scrollHeight}, 300, function(){
            $(this).height('auto');

            let $lastNew = $mainContainer.find('.new-container').last();
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

  var laaldea_handle_filter_tools = function(filterValue, filterType) {
    // updating filter array
    if(window.aldea.tools.container.hasClass(filterValue) ) {
      let index = window.aldea.tools.filters.indexOf(filterValue);

      window.aldea.tools.filters.splice(index, 1);
    }
    else {
      window.aldea.tools.filters.push(filterValue);
      window.aldea.tools.loadMoreButton.removeClass('end-list');
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
    let $hiddenFilters = $filterContainer.find('.term-container.hidden');

    if($button.hasClass('active')) {
      let currentHeight = $filterContainer.height();
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
    }

    let $FilterIcons = $filterContainer.find('.filter-icon .icon');
    $FilterIcons.each(function(){
      $(this).toggleClass('hidden');
    })
  }

  var laaldea_handle_tools_load_more = function($button) {
    let offset = 0;
    let filter;

    if(window.aldea.tools.filters.length > 0) {
      offset = window.aldea.tools.container.find('.tool-container.show').length;
      filter = JSON.stringify(window.aldea.tools.filters);
    }
    else {
      offset = $button.attr('data-offset');
    }

    $.ajax({
      url : ajax_params.ajax_url,
      type : 'post',
      data : {
        action : 'laaldea_tools_load_more',
        offset : offset,
        filter : filter,
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
        $('.main-container .tool-container.loaded .follow-container button').on('click', function(event) {
          event.preventDefault();
          laaldea_handle_add_follow(event);
        });
        $('.main-container .tool-container.loaded .thumbnail-container .view-link.type-video').on('click', function(event) {
          event.preventDefault();
          laaldeea_handle_tools_video_click(event, this)
        });
        $('.main-container .tool-container.loaded .related-tool-container .view-link-rel.type-video').on('click', function(event) {
          event.preventDefault();
          laaldeea_handle_tools_video_click(event, this)
        });
        $('.main-container .tool-container.loaded .resourse-container button').on('click', function(event) {
          event.preventDefault();
          var tempInput = document.createElement("input");
          tempInput.style = "position: absolute; left: -1000px; top: -1000px";
          tempInput.value = $(this).html();
          document.body.appendChild(tempInput);
          tempInput.select();
          document.execCommand("copy");
          document.body.removeChild(tempInput);
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

        if(true === data.result) {
          $button.find('.follow-text').html(data.text);
          $button.attr('data-add', '0');

          $button.parents('tool-container').toggleClass('type-follow');
        }

        webStateWaiting(false);
      },
      beforeSend: function() {
        webStateWaiting(true);
        return true;
      },
    });
  }

  var laaldeea_handle_tools_video_click = function(event, currentTarget) {
    // hide any active players
    $('body #page > div.modal-root .modal-dialog video.active').each(function(){
      $(this).toggleClass('active');
    });

    let currentId = $(currentTarget).attr('data-postId');
    let currentUrl = $(currentTarget).attr('href');
    window.aldea.tools.currentPlayer.id = currentId;
    let $modal = $('body #page > div.modal-root');
    let $video = $modal.find('.modal-dialog video.post-' + currentId);
    
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

      let $htmlObject = $('<video />', {
        class: 'post-' + currentId,
        src: currentUrl,
        type: 'video/mp4',
        controls: true
      });
      
      $modal.find('.modal-dialog').append($htmlObject);
      $video = $('body #page > div.modal-root .modal-dialog video.post-' + currentId);
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
    
    $('a').each(function() {
      if(!$(this).hasClass('disabled') && waiting && !$(this).hasClass('language-option') && !$(this).hasClass('menu-end-post-denominacion-a')) {
        $(this).addClass('disabled');	
      }
      else if ($(this).hasClass('disabled') && !waiting && !$(this).hasClass('language-option') && !$(this).hasClass('menu-end-post-denominacion-a')) {
        $(this).removeClass('disabled');
      }
    });
  }

  $(document).ready(function () {
    if($('.page-id-35').length > 0) {
      laadea_validate_promo_form_jquery();
    }

    if($('.bbpress').length > 0) {
      $('.bbp-breadcrumb .bbp-breadcrumb-home').attr('href','https://laaldea.co/learning-home/');
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
      $('.main-container .type-filter-container').attr('data-top', $('.main-container .type-filter-container').offset().top);

      // Filter events
      $('.sidebar .follow button').on('click', function(event) {
        event.preventDefault();
        let $button = $(event.currentTarget);
        $button.toggleClass('active');

        laaldea_handle_filter_tools('type-' + $button.attr('data-filter'), 'category');
      });
      $('.sidebar .term-container button').on('click', function(event) {
        event.preventDefault();
        let $button = $(event.currentTarget);
        $button.toggleClass('active');

        laaldea_handle_filter_tools('term-' + $button.attr('data-termid'), 'category');
      });
      $('.main-container .type-filter-container button').on('click', function(event) {
        event.preventDefault();
        let $button = $(event.currentTarget);
        $button.toggleClass('active');

        laaldea_handle_filter_tools('type-' + $button.attr('data-filter'), 'category');
      });

      // Filter control event
      $('.sidebar .filters-container .filter-contol').on('click', function(event) {
        event.preventDefault();
        let $button = $(event.currentTarget);
        $button.toggleClass('active');

        laaldea_handle_filter_control($button);
      });

      // Follow link event
      $('.main-container .tool-container .follow-container button').on('click', function(event) {
        event.preventDefault();
        laaldea_handle_add_follow(event);
      });

      // Copy resoursse link
      $('.main-container .tool-container .resourse-container button').on('click', function(event) {
        event.preventDefault();
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = $(this).html();
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
      });

      // View video
      $('.main-container .tool-container .thumbnail-container .view-link.type-video').on('click', function(event) {
        event.preventDefault();
        laaldeea_handle_tools_video_click(event, this)
      });
      $('.main-container .tool-container .related-tool-container .view-link-rel.type-video').on('click', function(event) {
        event.preventDefault();
        laaldeea_handle_tools_video_click(event, this)
      });


      $('.main-container .load-more-container button').on('click', function(event) {
        event.preventDefault();
        let $button = $(event.currentTarget);
        laaldea_handle_tools_load_more($button);
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
      $('.main-container .type-filter-container').each(_checkOffset_menu('fixed'));
    }
		
  });
  
} (jQuery) );