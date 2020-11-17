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

          $('.bbpress .topic #bbpress-forums .load-more-link-container').before(data.html);
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
    console.log('filterValue : ' + filterValue);

    // updating filter array
    if(window.aldea.tools.container.hasClass(filterValue) ) {
      console.log('removing filter');
      let index = window.aldea.tools.filters.indexOf(filterValue);

      window.aldea.tools.filters.splice(index, 1);
    }
    else {
      window.aldea.tools.filters.push(filterValue);
    }
    // adding new filter
    window.aldea.tools.container.toggleClass(filterValue);

    console.log('filters');
    console.log(window.aldea.tools.filters);
    
    // calculating active elements.
    let shownElements = 0;
    let i = 0;
    
    let filter;
    if(window.aldea.tools.filters.length > 0) {
      window.aldea.tools.filterStr = '';
      for(i=0; i<=window.aldea.tools.filters.length; i++) {
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
    $.trim(window.aldea.tools.filterStr)
    let elements = window.aldea.tools.container.find('.tool-container');
    elements.each(function() {
      console.log(window.aldea.tools.filters.length);
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

    console.log('shownElements : ' + shownElements);
    if(shownElements < window.aldea.tools.limit) {
      console.log('Load more tools with ajax');
    }
  }

  var laaldea_handle_add_follow = function(event) {
    let $button = $(event.currentTarget);
    let postId = $button.attr('data-postid');
    let add = $button.attr('data-add');

    console.log('adding to favorites');
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
      $('.topic #bbpress-forums .load-more-link-container button').on('click', function(event){
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
      window.aldea.tools = {container : $('#tools .main-container .tools-container'), filters : new Array()};
      window.aldea.tools.limit = window.aldea.tools.container.attr('data-limit');
      window.aldea.tools.filterStr = '';

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

      $('.main-container .tool-container .follow-container button').on('click', function(event) {
        event.preventDefault();
        laaldea_handle_add_follow(event);
      });


    }
  });
} (jQuery) );