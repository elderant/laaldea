<?php
add_action( 'wp_enqueue_scripts', 'wpb_child_enqueue_styles' );
function wpb_child_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_script('wpb-child-main', get_stylesheet_directory_uri() . '/inc/assets/js/script.js', array(), '', true );

	if(is_home() || is_front_page()) {
		wp_enqueue_style('wpb-child-home-style', get_stylesheet_directory_uri() . '/inc/assets/css/home/style.css', array(), false );
		wp_enqueue_style('wpb-child-home-mobile', get_stylesheet_directory_uri() . '/inc/assets/css/home/mobile.css', array(), false );
		wp_enqueue_style('wpb-child-home-animate', get_stylesheet_directory_uri() . '/inc/assets/css/home/animate.css', array(), false );
		wp_enqueue_style('wpb-child-home-hover', get_stylesheet_directory_uri() . '/inc/assets/css/home/hover.css', array(), false );
		wp_enqueue_script('wpb-child-modernizr', get_stylesheet_directory_uri() . '/inc/assets/js/home/modernizr.js', array(), false );

		wp_enqueue_script('wpb-child-home-classie', get_stylesheet_directory_uri() . '/inc/assets/js/home/classie.js', array('jquery'), false, true );
		//wp_enqueue_script('wpb-child-home-borderMenu', get_stylesheet_directory_uri() . '/inc/assets/js/home/borderMenu.js', array('wpb-child-home-classie'), false, true );
		wp_enqueue_script('wpb-child-home-sequence', get_stylesheet_directory_uri() . '/inc/assets/js/home/jquery.sequence.js', array('wpb-child-home-classie'), false, true );
		wp_enqueue_script('wpb-child-home-hovers', get_stylesheet_directory_uri() . '/inc/assets/js/home/hovers.js', array('wpb-child-home-sequence'), false, true );
		wp_enqueue_script('wpb-child-home-snap', get_stylesheet_directory_uri() . '/inc/assets/js/home/snap.svg-min.js', array('wpb-child-home-hovers'), false, true );
		wp_enqueue_script('wpb-child-home-main', get_stylesheet_directory_uri() . '/inc/assets/js/home/main.js', array('wpb-child-home-snap'), false, true );
		wp_enqueue_script('wpb-child-home-toucheffects', get_stylesheet_directory_uri() . '/inc/assets/js/home/toucheffects.js', array('wpb-child-home-main'), false, true );
		wp_enqueue_script('wpb-child-home-inine', get_stylesheet_directory_uri() . '/inc/assets/js/home/inline.js', array('wpb-child-home-toucheffects'), false, true );

		wp_enqueue_script('wpb-child-home-googlemaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', array('jquery'), false, true );
		
	}
} 


/******************** Shared ********************/
function laaldea_register_secondary_menu() {
  register_nav_menu('secondary-menu', __( 'Secondary menu', 'laaldea' ));
}
add_action( 'init', 'laaldea_register_secondary_menu' );

/******************** Blog ********************/
// define the the_content_more_link callback 
function filter_the_content_more_link( $link, $link_text ) { 
	// 
	
	$read_more_link = new DOMDocument('1.0', 'utf-8');
	$read_more_link -> loadHTML(utf8_decode($link));
	$link_list = $read_more_link -> getElementsByTagName('a');

	$new_link = $link_list->item(0);

	while ($new_link->hasChildNodes()) {
    $new_link->removeChild($new_link -> firstChild);
  }

	$image = $read_more_link -> createElement('i');
	$image -> setAttribute('class', 'fas fa-chevron-right');
	$new_link->appendChild($image);

	$text = $read_more_link -> createElement('span', __( 'Continue reading' ) );
	$new_link->appendChild($text);
	
	return $new_link->C14N(); 
}; 
			 
// add the filter 
add_filter( 'the_content_more_link', 'filter_the_content_more_link', 10, 2 ); 
