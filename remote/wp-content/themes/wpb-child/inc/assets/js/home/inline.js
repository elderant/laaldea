/*global $:false */
/*global google:false*/
/*jshint unused: vars */
/*jshint unused: false */
/* -- SCROLLSPY --*/ 
( function( $ ) {
//$('body').scrollspy({ target: 'nav li' });	
	
	
/* SLIDERS */
$(function(){
	var options = {
		autoPlay: true,
		autoPlayInterval: 3000,
		autoPlayButton: false,
		pagination: true,
		preloader: false,
		autoPlayPauseOnHover: true,
		phaseThreshold: 500,
		reverseWhenNavigatingBackwards: false,
		animateCanvas: false,
		// fallback: {
		// 	speed: 300
		// }
	}

	// Launch Sequence on the element, and with the options we specified above
	var mySequence = sequence($("#intro #sequence")[0], options);

	var options = {
		// autoPlay: true,
		// autoPlayInterval: 3000,
		autoPlayButton: false,
		pagination: true,
		preloader: false,
		autoPlayPauseOnHover: true,
		phaseThreshold: 500,
		reverseWhenNavigatingBackwards: false,
		animateCanvas: false,
		// fallback: {
		// 	speed: 300
		// }
	}

	// Launch Sequence on the element, and with the options we specified above
	var mySequence2 = sequence($("#contiene #sequence")[0], options);
});

/* Carrousel */ 
$(document).ready(function() {
	
	$('.award-carousel').slick({
		infinite: true,
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 2,
		autoplay: true,
		autoplaySpeed: 2000,
		variableWidth: true,
		prevArrow: '#award .slick-prev',
		nextArrow: '#award .slick-next',
	});

	$('.personajes-carousel').slick({
		infinite: false,
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 4,
		prevArrow: '#personajes .slick-prev',
		nextArrow: '#personajes .slick-next',
		variableWidth: true,
		responsive: [
			{
				breakpoint: 1367,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: false,
					variableWidth: true,
				}
			},
			{
				breakpoint: 730,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
					infinite: false,
					variableWidth: true,
				}
			},
			{
				breakpoint: 600,
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


/* TESTIMONIALS */
$(document).ready(function() {
		//Quotes rotator
		var divs = $('.cbp-qtcontent');
			
		function fade() {
			var current = $('.current');
			var currentIndex = divs.index(current),
				nextIndex = currentIndex + 1;
				
			if (nextIndex >= divs.length) {
				nextIndex = 0;
			}
				
			var next = divs.eq(nextIndex);
			
			next.stop().fadeIn(1500, function() {
				$(this).addClass('current');
			});
				
			current.stop().fadeOut(1500, function() {
				$(this).removeClass('current');
				_startProgress();
				setTimeout(fade, 8000);
			});
		}
			
		function _startProgress(){
			$(".cbp-qtprogress").removeAttr('style');
			$(".cbp-qtprogress").animate({
				width:"100px",
			} , 5000);
		}
			
		_startProgress();
		setTimeout(fade, 5000);

	});
	
	
/* ELEMENTS ANIMATION ON SCROLL */
$(window).scroll(function () {
	"use strict";
	var topOfWindow = $(window).scrollTop();

	function _checkOffset(className) {
		return function () {
			var $this = $(this),
				imagePos = $this.offset().top;

			$this.toggleClass(className, (imagePos < topOfWindow + 700));
		};
	}
		
	$('.presentation img').each(_checkOffset('animated fadeInDown'));
	$('.device').each(_checkOffset('animated flipInX'));
	$('.arrow-fast').each(_checkOffset('animated bounceInLeft'));
	$('.fast h3').each(_checkOffset('animated bounceInLeft'));
	$('.arrow-intuitive').each(_checkOffset('animated bounceInLeft'));
	$('.intuitive h3').each(_checkOffset('animated bounceInLeft'));
	$('.arrow-simple').each(_checkOffset('animated bounceInLeft'));
	$('.simple h3').each(_checkOffset('animated bounceInLeft'));
	$('.arrow-secure').each(_checkOffset('animated bounceInRight'));
	$('.secure h3').each(_checkOffset('animated bounceInRight'));
	$('.arrow-awesome').each(_checkOffset('animated bounceInRight'));
	$('.awesome h3').each(_checkOffset('animated bounceInRight'));
	$('.arrow-free').each(_checkOffset('animated bounceInRight'));
	$('.free h3').each(_checkOffset('animated bounceInRight'));
	$('.award h3').each(_checkOffset('animated fadeInDown'));
	$('.cbp-ig-grid li').each(_checkOffset('animated fadeIn'));
	$('.rating').each(_checkOffset('animated fadeInDown'));
	$('.grid figure').each(_checkOffset('animated fadeIn'));
	$('.patches h4').each(_checkOffset('animated fadeInDown'));	
	$('#numeros .first-row-lg').each(_checkOffset('animated fadeInLeft'));
	$('#numeros .second-row-lg').each(_checkOffset('animated fadeInRight'));
	$('.price h4').each(_checkOffset('animated fadeInDown'));	
	$('#contiene #sequence').each(_checkOffset('animated fadeInDown'));
	$('.cd-timeline-icon').each(_checkOffset('animated bounce-in'));
	$('.cd-timeline-content').each(_checkOffset('animated bounce-in'));			
	$('.plans').each(_checkOffset('animated fadeIn'));
	$('.cbp-qtrotator').each(_checkOffset('animated fadeInDown'));
	$('#contiene-separator h4').each(_checkOffset('animated fadeInDown'));	
	$('.view').each(_checkOffset('animated fadeIn'));
	$('.front').each(_checkOffset('animated fadeIn'));
	$('.social').each(_checkOffset('animated fadeInDown'));	
	$('#contact .aldea-form-row').each(_checkOffset('animated bounceIn'));	
	$('#map').each(_checkOffset('animated fadeIn'));		
});
	
	
/* GOOGLE MAP */
window.onload = function () {
	"use strict";
	var styles = [
	{
		featureType: 'water', // set the water color
		elementType: 'geometry.fill', // apply the color only to the fill
		stylers: [
			{ color: '#FFFFFF' }
		]
	},{
		featureType: 'landscape.manmade', // set the natural landscape
		elementType: 'all',
		stylers: [
			{ hue: '#FFFFFF' }
		]
	},{
		featureType: 'poi', // set the point of interest
		elementType: 'all',
		stylers: [
			{ hue: '#E06073' }
		]
	},{
		featureType: 'road', // set the road
		elementType: 'geometry',
		stylers: [
			{ hue: '#E06073' }
		]
	},{
		featureType: 'road.local', // set the local road
		elementType: 'all',
		stylers: [
			{ hue: '#FFFFFF' }
		]
	}];

  var myLatlng = new google.maps.LatLng(46.7697715,23.5896877,17);

  var options = {
    mapTypeControlOptions: {
      mapTypeIds: ['Styled']
    },
    center: myLatlng,
    zoom: 15,
    disableDefaultUI: false,	
    scrollwheel: false,
    mapTypeId: 'Styled'
    
  };

  var div = document.getElementById('location');
  var map = new google.maps.Map(div, options);
  var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
  map.mapTypes.set('Styled', styledMapType);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Coloramma'
  });
  
};
} (jQuery) );