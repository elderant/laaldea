( function( $ ) {
  window.debounce_timer = 0;

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

  // var wpb_child_tutor_handle_sidebar_hide = function() {
  //   if($('.single-lesson').length > 0) {
  //     $('.tutor-lesson-sidebar-hide-bar').on('click', function(event){
  //       let $container = $(this).parents('#tutor-single-entry-content');
  //       // let $sidebar = $content.siblings('.tutor-lesson-sidebar');

  //       $container.toggleClass('col-sm-7');
  //       $container.toggleClass('col-sm-12');
  //     }); 
  //   }

  //   if($('.single-tutor_quiz').length > 0) {
  //     $('.tutor-lesson-sidebar-hide-bar').on('click', function(event){
  //       let $container = $(this).parents('#tutor-single-entry-content');
  //       // let $sidebar = $content.siblings('.tutor-lesson-sidebar');

  //       $container.toggleClass('col-sm-7');
  //       $container.toggleClass('col-sm-12');
  //     }); 
  //   }
  // }

  var wpb_child_tutor_complete_lesson_and_next = function(event) {
    let $complete_form = $('.tutor-topbar-mark-to-done').find('form');
    let nounce = $complete_form.find('input[name="_wpnonce"]').attr('value');
    let referer = $complete_form.find('input[name="_wp_http_referer"]').attr('value');
    let lesson_id = $complete_form.find('input[name="lesson_id"]').attr('value');
    let tutor_action = $complete_form.find('input[name="tutor_action"]').attr('value');
    let next_lesson_url = $(event.currentTarget).attr('href');

    $.ajax({
      url : ajax_params.ajax_url,
      type : 'post',
      data : {
        action : 'wpb_child_complete_and_next_lesson',
        _wpnonce : nounce,
        _wp_http_referer : referer,
        lesson_id : lesson_id,
        tutor_action : tutor_action,
      },
      success : function( response ) {
        let data = JSON.parse(response);
        if(data.success === 'true') {
          window.location = next_lesson_url;
        }
        else {
          alert('Lesson not marked as completed');
        }

        webStateWaiting(false);
      },
      beforeSend: function() {
        webStateWaiting(true);
        return true;
      },
    });
  }

  var wpb_child_tutor_complete_course_and_next = function(event) {
    let $complete_form = $('.tutor-topbar-mark-course-to-done').find('form');
    let nounce = $complete_form.find('input[name="_wpnonce"]').attr('value');
    let referer = $complete_form.find('input[name="_wp_http_referer"]').attr('value');
    let course_id = $complete_form.find('input[name="course_id"]').attr('value');
    let tutor_action = $complete_form.find('input[name="tutor_action"]').attr('value');
    let next_lesson_url = $(event.currentTarget).attr('href');

    $.ajax({
      url : ajax_params.ajax_url,
      type : 'post',
      data : {
        action : 'wpb_child_complete_course_and_next',
        _wpnonce : nounce,
        _wp_http_referer : referer,
        course_id : course_id,
        tutor_action : tutor_action,
      },
      success : function( response ) {
        console.log(response);
        let data = JSON.parse(response);
        if(data.success === 'true') {
          window.location = next_lesson_url;
        }
        else {
          alert('course not marked as completed');
        }

        webStateWaiting(false);
      },
      beforeSend: function() {
        webStateWaiting(true);
        return true;
      },
    });
  }
  
  //************** Window Scroll ************************//
	var goToTopDebouncer = function(event) {
		if(window.debounce_timer) {
			window.clearTimeout(debounce_timer);
		}
		
		debounce_timer = window.setTimeout(function() {
      if(window.scrollY > 500){
        let $goToTop = $('#footer-widget .go-to-top');
        if(!$goToTop.hasClass('display')) {
          $goToTop.toggleClass('display');
        }
      }
      else {
        let $goToTop = $('#footer-widget .go-to-top');
        if($goToTop.hasClass('display')) {
          $goToTop.toggleClass('display');
        }
      }
      //let $secondaryMenu = $('header .navbar.secondary');
      //$secondaryMenu.toggleClass('sticky', window.scrollY > 120);
      //console.log(window.scrollY);
		}, 100);
	}
	
	$(window).on( 'scroll', goToTopDebouncer );

  //************** Document Ready ************************//
  $(document).ready(function () {
    if($('header#masthead').length > 0) {
      $('header .navbar-toggler').on('click', function(event) {
        let $toggler = $(event.currentTarget);
        $toggler.parent(".navbar").toggleClass('show');
      });
    }

    if($('#covid').length > 0) {
      $('#covid .navigation-container .change-book').on('click', function(event) {
        $('#covid .book-slider .book-container').each(function(){
          $(this).toggleClass('active');
          $('html, body').stop().animate({ scrollTop: $('#covid').offset().top}, 2000);
        });
      });
    }

    if($('.page-especial-covid').length > 0) {
      let params = getUrlVars();
      let download = 1;
      console.log(params);
      if(params.hasOwnProperty('download')) {
        download = params.download;
        $('.download-container #form-download option').each(function(){
          let optionValue = $(this).attr("value");
          if(optionValue == download) {
            $(this).attr("selected", "selected")
          }
        });
      }
    }

    if($('.woocommerce.archive').length > 0) {
      let params = getUrlVars();
      if($.inArray('id', params) != -1) {
        $id = params['id'];

        if($('.products #' + $id).length > 0) {
          $("html, body").animate({ scrollTop: $('.products #' + $id).offset().top - 128}, 500);
        }
        else if($('#' + $id + '.featured').length > 0) {
          $("html, body").animate({ scrollTop: $('#' + $id + '.featured').offset().top - 128}, 500);
        }
      } 
    }

    // Tutor
    if($('.single-lesson').length > 0 || $('.single-tutor_quiz').length > 0) {
      // wpb_child_tutor_handle_sidebar_hide();
      // $(document).ajaxStop(function() {
      //   let $wrap = $('#tutor-single-entry-content');
      //   if( !$wrap.hasClass('loading-lesson') ) {
      //     wpb_child_tutor_handle_sidebar_hide();
      //   }
      // });

      $('.tutor-next-previous-pagination-wrap .tutor-next-link').on('click', function(event){
        if( $('.tutor-topbar-mark-to-done').children().length == 0 ){
          return;
        }
        event.preventDefault();
        wpb_child_tutor_complete_lesson_and_next(event);
      });

      $('.tutor-next-previous-pagination-wrap .tutor-next-link').on('click', function(event){
        if( $('.tutor-topbar-mark-course-to-done').children('.tutor-course-compelte-form-wrap').length == 0 ){
          return;
        }
        event.preventDefault();
        wpb_child_tutor_complete_course_and_next(event);
      });
    }
    

    // Go to top
    if($('#footer-widget .go-to-top').length > 0) {
      let $goToTop = $('#footer-widget .go-to-top');
      $goToTop.on('click', function(event) {
        $('html, body').animate({scrollTop:0}, '1000');
      });
    }
    
  });
} (jQuery) );