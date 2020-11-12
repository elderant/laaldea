( function( $ ) {
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
       
  });
} (jQuery) );