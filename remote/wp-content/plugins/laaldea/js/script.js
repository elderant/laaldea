( function( $ ) {
  var laadea_validate_promo_form_jquery = function() {
    let $form = $('.page-id-35 .covid-form-section .laaldea-form');
    let $inputs = $form.find('input:not([type="submit"]), select');

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
        form_name: "Este campo es requerido.",
        form_organization: "Este campo es requerido.",
        form_location: "Este campo es requerido.",
        form_use: "Este campo es requerido.",
        form_email: {
          required: "Este campo es requerido.",
          email: "Ingrese un correo electrónico valido",
        },
      },
      submitHandler: function(form) {
        form.submit();
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
  });
} (jQuery) );