( function( $ ) {
  window.debounce_timer = 0;

  function getUrlVars() {
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

    if($('#footer-widget .go-to-top').length > 0) {
      let $goToTop = $('#footer-widget .go-to-top');
      $goToTop.on('click', function(event) {
        $('html, body').animate({scrollTop:0}, '1000');
      });
    }
    
  });
} (jQuery) );