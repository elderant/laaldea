/* ------  SMOOTH SCROLL ----- */
/*global $:false*/
/*jshint unused:vars */
/*jshint unused: true */

( function( $ ) {

	$(document).ready(function () {
		"use strict";
		$('a[href*="https://laaldea.co/#"]').bind('click', function(e) {
		e.preventDefault(); //prevent the "normal" behaviour which would be a "hard" jump
		
		var target = $(this).attr("href"); //Get the target
		var id = target.substring(19);
				
		// perform animated scrolling by getting top-position of target-element and set it as scroll target
		$('html, body').stop().animate({ scrollTop: $(id).offset().top}, 2000, function() 
					{
					location.hash = id;  //attach the hash (#jumptarget) to the pageurl
		});
				
		return false;
		});

	});
} (jQuery) );


