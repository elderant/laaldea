<?php
/* 
Plugin Name: La aldea
Description: Functions and modifications to match site requirements
Version:     1.0
Author:      Sebastian Guerrero
*/

// Script hooks.
add_action( 'wp_enqueue_scripts', 'laaldea_scripts' );

 
function laaldea_scripts () {
	wp_enqueue_script ( 'laaldea-js', plugins_url('/js/script.js', __FILE__), array('jquery'),  rand(111,9999), 'all' );
	wp_enqueue_style ( 'laaldea',  plugins_url('/css/main.css', __FILE__), array(),  rand(111,9999), 'all' );

	wp_localize_script( 'laaldea-js', 'ajax_params', array('ajax_url' => admin_url( 'admin-ajax.php' )));

	if(is_page(35)) {
		wp_enqueue_script('jquery-validate', 'https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js', array('jquery'), '1.10.0',	true);
	}
}

/************************************************************/
/********************* Helper functions *********************/
/************************************************************/

function laaldea_load_template($template, $folder = '') {
	// first check if this is the page where you want to render your own template
	// if ( !is_page($the_page_you_want)) {
		// return $template;
	// }

	// get the actual file name, like single.php or page.php
	$filename = basename($template);
	if(!empty($folder) && strpos($folder, '/') !== 0) {
		$folder = '/' . $folder;
	}
	
	// build a path for the filename in a folder named for our plugin "fisherman" in the theme folder
	$custom_template = sprintf('%s/%s%s/%s', get_stylesheet_directory(), 'linapulecio', $folder, $filename);

	// if the template is found, awesome! return it. that's what we'll use.
	if ( is_file($custom_template) ) {
		return $custom_template;
	}

	// otherwise, build a path for the filename in a folder named "templates" in our plugin folder
	$custom_template = laaldea_file_build_path(plugin_dir_path( __FILE__ ), 'templates', $folder, $filename);
	//$custom_template = sprintf('%stemplates%s/%s', plugin_dir_path( __FILE__ ), $folder, $filename);

	// found? return our plugin's default template
	if ( is_file($custom_template) ) {
		return $custom_template;
	}
	
	// otherwise, build a path for the filename in a folder named "templates" in our plugin folder
	$custom_template = sprintf('%stemplates/%s', plugin_dir_path( __FILE__ ), $filename);

	// found? return our plugin's default template
	if ( is_file($custom_template) ) {
		return $custom_template;
	}
	
	return $template;
}

function laaldea_file_build_path(...$segments) {
	return join(DIRECTORY_SEPARATOR, $segments);
}


/************************************************************/
/********************** Home functions **********************/
/************************************************************/

function laaldea_build_home_html ($lang) {
	$template_url = laaldea_load_template('intro.php', 'home');
	load_template($template_url, true);

	$template_url = laaldea_load_template('intro-separator.php', 'home');
	load_template($template_url, true);

	if($lang == 'es') {
		$template_url = laaldea_load_template('covid.php', 'home');
	}
	else if ($lang == 'en') {
		$template_url = laaldea_load_template('covid-en.php', 'home');
	}
	load_template($template_url, true);

	$template_url = laaldea_load_template('covid-separator.php', 'home');
	load_template($template_url, true);

	if($lang == 'es') {
		$template_url = laaldea_load_template('aldea.php', 'home');
	}
	else if ($lang == 'en') {
		$template_url = laaldea_load_template('aldea-en.php', 'home');
	}
	load_template($template_url, true);

	$template_url = laaldea_load_template('aldea-separator.php', 'home');
	load_template($template_url, true);

	$template_url = laaldea_load_template('curriculo.php', 'home');
	load_template($template_url, true);

	$template_url = laaldea_load_template('curriculo-separator.php', 'home');
	load_template($template_url, true);

	$template_url = laaldea_load_template('numeros.php', 'home');
	load_template($template_url, true);

	$template_url = laaldea_load_template('numeros-separator.php', 'home');
	load_template($template_url, true);

	$template_url = laaldea_load_template('contiene.php', 'home');
	load_template($template_url, true);

	$template_url = laaldea_load_template('contiene-separator.php', 'home');
	load_template($template_url, true);

	$template_url = laaldea_load_template('personajes.php', 'home');
	load_template($template_url, true);

	$template_url = laaldea_load_template('personajes-separator.php', 'home');
	load_template($template_url, true);

	$template_url = laaldea_load_template('click-team.php', 'home');
	load_template($template_url, true);
	
	$template_url = laaldea_load_template('click-team-separator.php', 'home');
	load_template($template_url, true);

	if($lang == 'es') {
		$template_url = laaldea_load_template('click-es.php', 'home');
		load_template($template_url, true);
	}
	else if ($lang == 'en') {
		$template_url = laaldea_load_template('click-en.php', 'home');
		load_template($template_url, true);
	}

	$template_url = laaldea_load_template('click-separator.php', 'home');
	load_template($template_url, true);

	if($lang == 'es') {
		$template_url = laaldea_load_template('contact-es.php', 'home');
		
	}
	else if ($lang == 'en') {
		$template_url = laaldea_load_template('contact-en.php', 'home');
	}
	load_template($template_url, true);
}

function laaldea_build_home_html_en () {
	laaldea_build_home_html('en');
}
add_shortcode( 'laaldea_home_en', 'laaldea_build_home_html_en' );

function laaldea_build_home_html_es () {
	laaldea_build_home_html('es');
}
add_shortcode( 'laaldea_home_es', 'laaldea_build_home_html_es' );

/************************************************************/
/******************* Promo form functions *******************/
/************************************************************/

function laaldea_build_form_html () {
	$template_url = laaldea_load_template('form.php', 'promo-form');
	load_template($template_url, true);
}
add_shortcode( 'laaldea_esecial_covid_form', 'laaldea_build_form_html' );

// Define activation handlers
add_action( 'admin_post_nopriv_laaldea_promo', 'laaldea_promo_handler' );
add_action( 'admin_post_laaldea_promo', 'laaldea_promo_handler' );

function laaldea_promo_handler() {
	if ( isset( $_POST['action'] ) && strcasecmp($_POST['action'], 'laaldea_promo') == 0 ) {
		$laaldea_activation_error = array();
		$error = false;

		// retreive post values.
		$name = $_POST['form_name'];
		$organization = $_POST['form_organization'];
		$location = $_POST['form_location'];
		$email = $_POST['form_email'];
		$use = $_POST['form_use'];
		$download = $_POST['form_download'];

		// validate values.
		if(empty($name)) {
			$laaldea_activation_error['form_name'] = __('Este campo es requerido.', 'laaldea');
			$error = true;
		}
		if(empty($organization)) {
			$laaldea_activation_error['form_organization'] = __('Este campo es requerido.', 'laaldea');
			$error = true;
		}
		if(empty($location)) {
			$laaldea_activation_error['form_location'] = __('Este campo es requerido.', 'laaldea');
			$error = true;
		}
		if(empty($email)) {
			$laaldea_activation_error['form_email'] = __('Este campo es requerido.', 'laaldea');
			$error = true;
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$laaldea_activation_error['form_email'] = __('Ingrese un correo electrónico válido.', 'laaldea');
			$error = true;
		}
		if(empty($use)) {
			$laaldea_activation_error['form_use'] = __('Este campo es requerido.', 'laaldea');
			$error = true;
		}
	
		if(!empty($error) && $error) {
			set_transient( 'laaldea_activation_error', $laaldea_activation_error, MINUTE_IN_SECONDS );
			//error_log(print_r($laaldea_activation_error,1));
			wp_redirect('/especial-covid/');
			return;
		}

		//sanitize values to add to database
		$name = $_POST['form_name'];
		$organization = $_POST['form_organization'];
		$location = $_POST['form_location'];
		$email = $_POST['form_email'];
		$use = $_POST['form_use'];
		if(strcasecmp($download, "1") == 0) {
			$download_str = "1 - Tiempos Contagiosos";
		}
		else if(strcasecmp($download, "2") == 0) {
			$download_str = "2 - Una Pausa Necesaria";
		}

		$name = sanitize_text_field($_POST['form_name']);
		$organization = sanitize_text_field($_POST['form_organization']);
		$location = sanitize_text_field($_POST['form_location']);
		$email = sanitize_email($_POST['form_email']);
		$use = sanitize_text_field($_POST['form_use']);

		//add row to custom table
		global $wpdb;
		$table_name = "{$wpdb->prefix}aldea_promo";
		$data = array(
			"email" => $email,
			"name" => $name,
			"organization" => $organization,
			"location" => $location,
			"use" => $use,
			"download" => $download_str,
		);
			
		// $data = array(
		// 	"email" => $email,
		// 	"name_first" => $name,
		// );

		$wpdb->insert( $table_name, $data);

		//Trigger download
		if(strcasecmp($download, "1") == 0) {
			$file = "https://laaldea.co/wp-content/uploads/EspecialCovid.zip";
		}
		else if(strcasecmp($download, "2") == 0) {
			$file = "https://laaldea.co/wp-content/uploads/UnaPausaNecesaria.zip";
		}
		
		
		header('Content-Type: application/pdf');
		header('Content-Disposition: attachment; filename="' . $file . '"');
		readfile($file);
	}

	return;
}

/*****************************************************************/
/******************* E-Learning home functions *******************/
/*****************************************************************/
function laaldea_build_learning_home () {
	$template_url = laaldea_load_template('home.php', 'learning');
	load_template($template_url, true);
}
add_shortcode( 'laaldea_learing_home', 'laaldea_build_learning_home' );

function laaldea_build_learning_news () {
  global $wp_query;
  $posts_per_page = 6;

  $query_args  = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'modified',
    'post_status' => 'publish',
  );
  $recent_news = new WP_Query( $query_args );
  $post_count = $recent_news -> found_posts;
  
  $wp_query -> query_vars['laaldea_args']['recent_news'] = $recent_news;
  $wp_query -> query_vars['laaldea_args']['offset'] = $posts_per_page;
  $wp_query -> query_vars['laaldea_args']['load_more'] = $posts_per_page < $post_count;

	$template_url = laaldea_load_template('news.php', 'learning');
	load_template($template_url, true);
}
add_shortcode( 'laaldea_learing_news', 'laaldea_build_learning_news' );

/******************* Forum functions *******************/
function laaldea_before_forum_title() {
  echo '<span class="font-titan before-forum-title">Foro: </span>';
}
add_action( 'bbp_theme_before_forum_title', 'laaldea_before_forum_title' );

function laaldea_before_topic_title() {
  echo '<span class="font-titan before-forum-title">Tema: </span>';
}

add_action( 'bbp_theme_before_topic_title', 'laaldea_before_topic_title' );


function laaldea_add_last_replies() { 
  global $wp_query;
  $posts_per_page = 3;

  $topic_id = bbp_get_topic_id();
  $new_args = array(
    'post_parent' => $topic_id,
    'posts_per_page' => $posts_per_page,
  );
  
  if( bbp_has_replies($new_args) ) {
    $bbp = bbpress();

    $total_replies = $bbp->reply_query->found_posts;
    $offset = $posts_per_page;

    $wp_query -> query_vars['laaldea_args']['total_replies'] = $total_replies;
    $wp_query -> query_vars['laaldea_args']['offset'] = $offset;
    $wp_query -> query_vars['laaldea_args']['topic_id'] = $topic_id;

    $template_url = laaldea_load_template('topic-replies.php', 'forum/template-part');
    load_template($template_url, false);
  }
}
// Hook into action
add_action('wpb_child_bbp_after_single_topic','laaldea_add_last_replies');

function laaldea_build_topic_sidebar () {
  ob_start();
  bbp_get_template_part( 'form',       'topic'     );
  $html = ob_get_clean();
  
  return $html;
}
add_shortcode( 'laaldea_topic_sidebar', 'laaldea_build_topic_sidebar' );

function laaldea_build_replies_sidebar () {
  ob_start();
  bbp_get_template_part( 'form', 'reply' );
  $html = ob_get_clean();
  
  return $html;
}
add_shortcode( 'laaldea_replies_sidebar', 'laaldea_build_replies_sidebar' );

// Add aditional replies
add_action( 'wp_ajax_nopriv_laaldea_load_more_replies', 'laaldea_load_more_replies' );
add_action( 'wp_ajax_laaldea_load_more_replies', 'laaldea_load_more_replies' );

function laaldea_load_more_replies() {
  $offset = $_POST['offset'];
  $topic_id = $_POST['topicId'];

  global $wp_query;
  $posts_per_page = 6;

  $new_args = array(
    'post_parent' => $topic_id,
    'posts_per_page' => $posts_per_page,
    'offset' => $offset,
  );
  
  if( bbp_has_replies($new_args) ) {
    $bbp = bbpress();

    $total_replies = $bbp -> reply_query-> found_posts;

    ob_start();
    while(bbp_replies()) {
      bbp_the_reply();

      $reply_id = bbp_get_reply_id();
      $reply_date = bbp_get_reply_post_date();
      $reply_content = bbp_get_reply_content(); 
      $reply_author = bbp_get_reply_author_display_name();

      $wp_query -> query_vars['laaldea_args']['reply_date'] = $reply_date;
      $wp_query -> query_vars['laaldea_args']['reply_content'] = $reply_content;
      $wp_query -> query_vars['laaldea_args']['reply_author'] = $reply_author;

      $template_url = laaldea_load_template('topic-replies-single.php', 'forum/template-part');
      load_template($template_url, false);
    }
    $html = ob_get_clean();
  }

  //error_log('html to add : ' . print_r($html,1));
  $return_array = array(
    'last' => $total_replies <= $posts_per_page,
    'count' => $offset + $posts_per_page,
    'html' => $html,
  );

  echo json_encode($return_array);
  die();
}

/******************* News functions *******************/
// Add next new
add_action( 'wp_ajax_nopriv_laaldea_load_next_new_main', 'laaldea_load_next_new_main' );
add_action( 'wp_ajax_laaldea_load_next_new_main', 'laaldea_load_next_new_main' );

function laaldea_load_next_new_main() {
  $post_id = $_POST['postId'];

  global $wp_query;

  $query_args = array(
    'p' => $post_id,
  );
  
  $next_new = new WP_Query( $query_args );
	
  $wp_query -> query_vars['laaldea_args']['next_new'] = $next_new;

  ob_start();
  $template_url = laaldea_load_template('news-single-main.php', 'learning/template-part');
  load_template($template_url, false);
  $html = ob_get_clean();
  
  //error_log('html to add : ' . print_r($html,1));
  $return_array = array(
    'html' => $html,
  );

  echo json_encode($return_array);
  die();
}

// Add more news sidebar
add_action( 'wp_ajax_nopriv_laaldea_load_next_new_sidebar', 'laaldea_load_next_new_sidebar' );
add_action( 'wp_ajax_laaldea_load_next_new_sidebar', 'laaldea_load_next_new_sidebar' );

function laaldea_load_next_new_sidebar() {
  $offset = $_POST['offset'];

  global $wp_query;
  $posts_per_page = 6;

  $query_args  = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'modified',
    'post_status' => 'publish',
    'offset' => $offset,
  );
  $recent_news = new WP_Query( $query_args );
  $post_count = $recent_news -> found_posts;
  
  if( $recent_news -> have_posts() ) {
    $post_count = $recent_news -> found_posts;

    ob_start();
    $added = 0;
    while ($recent_news -> have_posts()) {
      $recent_news -> the_post(); 
      $added += 1;
      
      $post_id = get_the_ID();
      $post_thumb = get_the_post_thumbnail( $post_id, 'thumbnail' );
      $post_title = get_the_title();
      $post_author = get_the_author(); 

      $wp_query -> query_vars['laaldea_args']['post_id'] = $post_id;
      $wp_query -> query_vars['laaldea_args']['post_thumb'] = $post_thumb;
      $wp_query -> query_vars['laaldea_args']['post_title'] = $post_title;
      $wp_query -> query_vars['laaldea_args']['post_author'] = $post_author;

      $template_url = laaldea_load_template('news-single-sidebar.php', 'learning/template-part');
      load_template($template_url, false);
    }
    $html = ob_get_clean();
  }

  //error_log('html to add : ' . print_r($html,1));
  $return_array = array(
    'last' => $post_count <= $posts_per_page,
    'added' => $added,
    'count' => $offset + $posts_per_page,
    'html' => $html,
  );

  echo json_encode($return_array);
  die();
}

// Add new to end of main container handler
// add_action( 'wp_ajax_nopriv_laaldea_get_main_new_html', 'laaldea_get_main_new_html' );
// add_action( 'wp_ajax_laaldea_get_main_new_html', 'laaldea_get_main_new_html' );

function laaldea_get_main_new_html() {
  $post_id = $_POST['postId'];

  global $wp_query;
  $posts_per_page = 1;

  $query_args  = array(
    'p' => $post_id,
  );
  
  $next_new = new WP_Query( $query_args );
	
  $wp_query -> query_vars['laaldea_args']['next_new'] = $next_new;

  ob_start();
  $template_url = laaldea_load_template('news-single-main.php', 'learning/template-part');
  load_template($template_url, false);
  $html = ob_get_clean();

  
  ob_start();

  $html = ob_get_clean();

  //error_log('html to add : ' . print_r($html,1));
  $return_array = array(
    'last' => $post_count <= $posts_per_page,
    'added' => $added,
    'count' => $offset + $posts_per_page,
    'html' => $html,
  );

  echo json_encode($return_array);
  die();
}
