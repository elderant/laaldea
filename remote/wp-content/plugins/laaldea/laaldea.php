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
  global $wp_query;

  // Tools query
  $posts_per_page = 4;
  $query_args  = array(
    'post_type' => 'tool',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'modified',
    'post_status' => 'publish',
  );
  $recent_tools = new WP_Query( $query_args );
  $wp_query -> query_vars['laaldea_args']['recent_tools'] = $recent_tools;

  // News query
  $query_args  = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'modified',
    'post_status' => 'publish',
  );
  $recent_news = new WP_Query( $query_args );
  $wp_query -> query_vars['laaldea_args']['recent_news'] = $recent_news;

  // forum query
  $query_args = array(
    'posts_per_page' => $posts_per_page,
    'post_type' => bbp_get_reply_post_type(),
    'post_status' => bbp_get_public_reply_statuses(),
    'orderby' => 'date',
    'order' => 'DESC',

    'ignore_sticky_posts'    => true,
    'no_found_rows'          => true,
    'update_post_term_cache' => false,
    'update_post_meta_cache' => false
  );
  
  $recent_replies = new WP_Query( $query_args );
  $wp_query -> query_vars['laaldea_args']['recent_replies'] = $recent_replies;

  // Current courses query
  $user_id = tutor_utils()->get_user_id();
  $course_ids = tutor_utils()->get_enrolled_courses_ids_by_user($user_id);

  if (count($course_ids)){
    $course_post_type = tutor() -> course_post_type;
    $course_args = array(
      'post_type'     => $course_post_type,
      'post_status'   => 'publish',
      'post__in'      => $course_ids,
      'posts_per_page' => $posts_per_page,
    );

    $current_courses = new WP_Query($course_args);
    $wp_query -> query_vars['laaldea_args']['current_courses'] = $current_courses;

    $course_args = array(
      'post_type'       => $course_post_type,
      'post_status'     => 'publish',
      'post__not_in'    => $course_ids,
      'posts_per_page'  => $posts_per_page/2,
    );

    $recommended_courses = new WP_Query($course_args);
    $wp_query -> query_vars['laaldea_args']['recommended_courses'] = $recommended_courses;
  }

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
    'fields' => 'ids',
  );
  if(isset($_GET['id'])) {
    $query_args['post__not_in'] = array($_GET['id']);
  }

  $recent_news = new WP_Query( $query_args );
  $post_count = $recent_news -> found_posts;
  
  $wp_query -> query_vars['laaldea_args']['recent_news'] = $recent_news;
  $wp_query -> query_vars['laaldea_args']['offset'] = $posts_per_page;
  $wp_query -> query_vars['laaldea_args']['load_more'] = $posts_per_page < $post_count;
  $wp_query -> query_vars['laaldea_args']['requested_new_id'] = null;

  // Requested new
  if(isset($_GET['id'])) {
    $wp_query -> query_vars['laaldea_args']['requested_new_id'] = $_GET['id'];
  }
  
	$template_url = laaldea_load_template('news.php', 'learning');
	load_template($template_url, true);
}
add_shortcode( 'laaldea_learing_news', 'laaldea_build_learning_news' );

function laaldea_build_learning_tools () {
  global $wp_query;
  
  // filter queries
  $book_args = array (
    'taxonomy' => 'category',
    'hide_empty' => false,
    'parent'   => 19,
  );

  $book_terms = get_terms( $book_args );
  $wp_query -> query_vars['laaldea_args']['book_terms'] = $book_terms;

  $topic_args = array (
    'taxonomy' => 'category',
    'hide_empty' => false,
    'parent'   => 25,
  );

  $topic_terms = get_terms( $topic_args );
  $wp_query -> query_vars['laaldea_args']['topic_terms'] = $topic_terms;

  $action_args = array (
    'taxonomy' => 'category',
    'hide_empty' => false,
    'parent'   => 35,
  );

  $action_terms = get_terms( $action_args );
  $wp_query -> query_vars['laaldea_args']['action_terms'] = $action_terms;

  // main container query
  $posts_per_page = 3;
  $limit = $posts_per_page;

  $query_args  = array(
    'post_type' => 'tool',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'modified',
    'post_status' => 'publish',
    'fields' => 'ids',
  );
  if(isset($_GET['id'])) {
    $query_args['post__not_in'] = array($_GET['id']);
  }
  $recent_tools = new WP_Query( $query_args );
  $post_count = $recent_tools -> found_posts;
  
  $wp_query -> query_vars['laaldea_args']['recent_tools'] = $recent_tools;
  $wp_query -> query_vars['laaldea_args']['post_count'] = $post_count;
  $wp_query -> query_vars['laaldea_args']['offset'] = $posts_per_page;
  $wp_query -> query_vars['laaldea_args']['limit'] = $limit;
  $wp_query -> query_vars['laaldea_args']['requested_tool_id'] = null;

  // Requested tool
  if(isset($_GET['id'])) {
    $wp_query -> query_vars['laaldea_args']['requested_tool_id'] = $_GET['id'];
  }

	$template_url = laaldea_load_template('tools.php', 'learning');
	load_template($template_url, true);
}
add_shortcode( 'laaldea_learing_tools', 'laaldea_build_learning_tools' );

/******************* Panel functions *******************/
function laaldea_get_current_lesson_name( $course_id = 0 ) {
  $course_id = tutor_utils()->get_post_id($course_id);
  global $wpdb;

  $user_id = get_current_user_id();

  $lessons = $wpdb->get_results("SELECT items.post_title, items.ID FROM {$wpdb->posts} topic
      INNER JOIN {$wpdb->posts} items ON topic.ID = items.post_parent 
      WHERE topic.post_parent = {$course_id} AND items.post_status = 'publish' order by topic.menu_order ASC, items.menu_order ASC;");

  $first_lesson = false;
  if (tutils()->count($lessons)){
    if (! empty($lessons[0])){
      $first_lesson = $lessons[0];
    }

    foreach ($lessons as $lesson){
      $is_complete = get_user_meta($user_id, "_tutor_completed_lesson_id_{$lesson->ID}", true);
      if ( ! $is_complete){
        $first_lesson = $lesson;
        break;
      }
    }

    if (! empty($first_lesson->ID)){
      return $first_lesson -> post_title;
    }
  }
  
  return '';
}

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
    'orderby' => 'date',
    'order' => 'DESC',
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
    'orderby' => 'date',
    'order' => 'DESC',
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
      $reply_author_id = bbp_get_reply_author_id();
      $avatar_url = get_user_meta( $reply_author_id, 'user_avatar', true);

      $wp_query -> query_vars['laaldea_args']['reply_date'] = $reply_date;
      $wp_query -> query_vars['laaldea_args']['reply_content'] = $reply_content;
      $wp_query -> query_vars['laaldea_args']['reply_author'] = $reply_author;
      $wp_query -> query_vars['laaldea_args']['reply_avatar'] = $avatar_url;

      $template_url = laaldea_load_template('topic-replies-single.php', 'forum/template-part');
      load_template($template_url, false);
    }
    $html = ob_get_clean();
  }

  $return_array = array(
    'last' => $total_replies <= $posts_per_page,
    'count' => $offset + $posts_per_page,
    'html' => $html,
  );

  echo json_encode($return_array);
  die();
}

// Add text before freshness
function laaldea_add_freshness_text(){
  echo '<span>' . __('Última entrada: ') . '</span>';
  return;
}
add_action('bbp_theme_before_topic_freshness_link', 'laaldea_add_freshness_text');

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
      $post_thumb = get_the_post_thumbnail( $post_id, 'medium' );
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
    'fields' => 'ids',
  );
  $next_new = new WP_Query( $query_args );
  $wp_query -> query_vars['laaldea_args']['next_new'] = $next_new;

  ob_start();
  if( $next_new -> have_posts() ) {
    while($next_new -> have_posts()) {
      $next_new -> the_post();
      $post_id = get_the_ID();

      laaldea_get_new_html( $post_id );
    }
  }
  $html = ob_get_clean();

  $return_array = array(
    'last' => $post_count <= $posts_per_page,
    'added' => $added,
    'count' => $offset + $posts_per_page,
    'html' => $html,
  );

  echo json_encode($return_array);
  die();
}

function laaldea_get_new_html( $post_id = 0, $additional_class = '', $echo = true ) {
  global $wp_query;
  global $post;

  if ( ! $post_id){
    $post_id = get_the_ID();
    if ( ! $post_id){
      $post_id = -1;
    }
  }

  if($post_id == -1) {
    return '';
  }

  // Check if $tool is a "post" post type
  if(get_post_type( $post_id ) !== 'post') {
    return '';
  }
  
  $tag_list = get_the_tag_list( __('En ', 'laaldea'), ', ', '', $post_id);
  $place = !empty(get_field( "place", $post_id )) ? __('Lugar: ','laaldea') . get_field( "place", $post_id ):'';
  $content = get_the_content(null, false, $post_id);
  $content = apply_filters( 'the_content', $content );
  $content = str_replace( ']]>', ']]&gt;', $content );
  
  // Get adjacent post
  $post_temp = $post;
  setup_postdata($post_id);
  $post = $post_id;
  
  $adjacent_post = get_adjacent_post();

  $post = $post_temp ;
  wp_reset_postdata();

  $wp_query -> query_vars['laaldea_args']['post_id'] = $post_id;
  $wp_query -> query_vars['laaldea_args']['has_thumbnail'] = has_post_thumbnail( $post_id );
  $wp_query -> query_vars['laaldea_args']['thumbnail'] = get_the_post_thumbnail( $post_id, 'large' );
  $wp_query -> query_vars['laaldea_args']['title'] = get_the_title( $post_id );
  $wp_query -> query_vars['laaldea_args']['tag_list'] = $tag_list;
  $wp_query -> query_vars['laaldea_args']['place_text'] = $place;
  $wp_query -> query_vars['laaldea_args']['date'] = get_the_date('', $post_id);
  $wp_query -> query_vars['laaldea_args']['content'] = $content;
  $wp_query -> query_vars['laaldea_args']['adjacent_post'] = $adjacent_post;
  
  ob_start();
  $template_url = laaldea_load_template('news-single.php', 'learning/template-part');
  load_template($template_url, false);
  $html = ob_get_clean();

  if ( $echo ) {
    echo $html;
  }
  return $html;
}

/******************* Tools functions *******************/
function laaldea_get_tools_category_class($post_id) {
  $post_terms = wp_get_post_terms( $post_id, 'category', array('fields' => 'ids') );

  $category_class = '';
  foreach($post_terms as $term_id) {
    $category_class .= 'term-' . $term_id . ' ';
  }

  return $category_class;
}

function laaldea_post_id_in_followed($post_id) {
  $user = wp_get_current_user();
  
  if($user->ID == 0) {
    return -1;
  }

  $follow = get_user_meta( $user->ID, 'followed-tools', true );

  if(empty($follow)) {
    return 0;
  }

  $ids = explode(" ", $follow);
  $index = array_search ( $post_id , $ids );

  return FALSE === $index? 0: 1;
}

// Add to favorite
add_action( 'wp_ajax_nopriv_laaldea_add_to_follow', 'laaldea_add_to_follow' );
add_action( 'wp_ajax_laaldea_add_to_follow', 'laaldea_add_to_follow' );
function laaldea_add_to_follow() {
  $post_id = $_POST['postId'];
  $add = $_POST['add'];

  $user = wp_get_current_user();
  $follow = get_user_meta( $user->ID, 'followed-tools', true );

  if($add == 0) {
    if(empty($follow)) {
      update_user_meta( $user->ID, 'followed-tools', $post_id );
    }
    else {
      update_user_meta( $user->ID, 'followed-tools', trim($follow) . ' ' . $post_id );
    }
  
    $return_array = array(
      'result' => true,
    );
  }
  else {
    $ids = explode(" ", trim($follow));
    $index = array_search ( $post_id , $ids );

    if(false !== $index) {
      array_splice( $ids, $index, 1 );
      $follow = implode(' ', $ids);
      update_user_meta( $user->ID, 'followed-tools', trim($follow) );
    }

    $return_array = array(
      'result' => false,
    );
  }

  echo json_encode($return_array);
  die();
}

function laaldea_get_tool_html( $post_id = 0, $additional_class = '', $echo = true ) {
  global $wp_query;

  if ( ! $post_id){
    $post_id = get_the_ID();
    if ( ! $post_id){
      $post_id = -1;
    }
  }

  if($post_id == -1) {
    return '';
  }

  if(get_post_type( $post_id ) !== 'tool') {
    return '';
  }
  // Check if $tool is a tool post type
  $tool_url = get_field( "herramienta", $post_id );
  $type = strtolower(get_field( "type", $post_id ));
  $tool_name = get_field( "tool_name", $post_id );
  $tool_name = empty($tool_name)?get_the_title( $post_id ):$tool_name;
  $link = $type == 'video'? get_field( "link_youtube", $post_id ):'';
  $categories_class = laaldea_get_tools_category_class($post_id);
  $add = laaldea_post_id_in_followed($post_id);
  $related = get_field( "related_tools", $post_id );

  $container_class = $additional_class . 'tool-container flex-wrap align-items-end show post-id-';
  $container_class .= $post_id;
  $container_class .= ' type-' . $type;
  $container_class .= ' ' . $categories_class;
  $container_class .= $add>0 ?' type-follow ':'';

  $wp_query -> query_vars['laaldea_args']['post_id'] = $post_id;
  $wp_query -> query_vars['laaldea_args']['title'] = get_the_title( $post_id );
  $wp_query -> query_vars['laaldea_args']['has_thumbnail'] = has_post_thumbnail( $post_id );
  $wp_query -> query_vars['laaldea_args']['thumbnail'] = get_the_post_thumbnail( $post_id, 'small' );
  $wp_query -> query_vars['laaldea_args']['type'] = $type;
  $wp_query -> query_vars['laaldea_args']['link'] = $link;
  $wp_query -> query_vars['laaldea_args']['content'] = get_the_content(null, false, $post_id);
  $wp_query -> query_vars['laaldea_args']['container_class'] = $container_class;
  $wp_query -> query_vars['laaldea_args']['follow_status'] = $add;
  $wp_query -> query_vars['laaldea_args']['tool'] = $tool_url;
  $wp_query -> query_vars['laaldea_args']['tool_name'] = $tool_name;
  $wp_query -> query_vars['laaldea_args']['related'] = $related;
  
  ob_start();
  $template_url = laaldea_load_template('tools-single.php', 'learning/template-part');
  load_template($template_url, false);
  $html = ob_get_clean();

  if ( $echo ) {
    echo $html;
  }
  return $html;
}

add_action( 'wp_ajax_nopriv_laaldea_tools_load_more', 'laaldea_tools_load_more' );
add_action( 'wp_ajax_laaldea_tools_load_more', 'laaldea_tools_load_more' );
function laaldea_tools_load_more() {
  $offset = $_POST['offset'];
  $filters = isset($_POST['filter']) ? json_decode(stripslashes($_POST['filter'])) : array();

  global $wp_query;

  $posts_per_page = 6;
  $limit = $posts_per_page + $offset;
  
  // base query
  $query_args  = array(
    'post_type' => 'tool',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'modified',
    'post_status' => 'publish',
    'offset' => $offset,
    'category__in' => array(),
    'meta_key'		=> 'type',
  );

  //filtered query
  if(!empty($filters)) {
    foreach($filters as $filter) {
      if(FALSE !== stripos($filter, 'type-') ) {
        $identifier = 'type-';
        $type = substr( $filter, strlen($identifier) );
        $query_args['meta_value'] = $type;
      }
      else if(FALSE !== stripos($filter, 'term-') ) {
        $identifier = 'term-';
        $term_id = substr( $filter, strlen($identifier) );
        array_push($query_args['category__in'], $term_id);
      }
    }
  }

  // Executing and using query.
  $recent_tools = new WP_Query( $query_args );
  $post_count = $recent_tools -> found_posts;

  ob_start();
  if( $recent_tools -> have_posts() ) {
    while ($recent_tools -> have_posts()) {
      $recent_tools -> the_post();
      $post_id = get_the_ID();
      $tool = get_field( "herramienta" );
      $tool_name = get_field( "tool_name" );
      $tool_name = empty($tool_name)?get_the_title( ):$tool_name;
      $type = strtolower(get_field( "type" ));
      $link = $type == 'video'? get_field( "link_youtube" ):'';
      $categories_class = laaldea_get_tools_category_class($post_id);
      $add = laaldea_post_id_in_followed($post_id);
      $related = get_field( "related_tools" );
      // $preview = get_field( "preview" );

      $container_class = 'loaded tool-container flex-wrap align-items-end show post-id-';
      $container_class .= $post_id;
      $container_class .= ' type-' . $type;
      $container_class .= ' ' . $categories_class;
      $container_class .= $add>0 ?' type-follow ':'';

      $wp_query -> query_vars['laaldea_args']['post_id'] = $post_id;
      $wp_query -> query_vars['laaldea_args']['title'] = get_the_title();
      $wp_query -> query_vars['laaldea_args']['has_thumbnail'] = has_post_thumbnail();
      $wp_query -> query_vars['laaldea_args']['thumbnail'] = get_the_post_thumbnail( $post_id, 'small' );
      $wp_query -> query_vars['laaldea_args']['type'] = $type;
      $wp_query -> query_vars['laaldea_args']['link'] = $link;
      $wp_query -> query_vars['laaldea_args']['content'] = get_the_content();
      $wp_query -> query_vars['laaldea_args']['container_class'] = $container_class;
      $wp_query -> query_vars['laaldea_args']['follow_status'] = $add;
      $wp_query -> query_vars['laaldea_args']['tool'] = $tool;
      $wp_query -> query_vars['laaldea_args']['tool_name'] = $tool_name;
      $wp_query -> query_vars['laaldea_args']['related'] = $related;
      
      $template_url = laaldea_load_template('tools-single.php', 'learning/template-part');
      load_template($template_url, false);
    }
  }
  $html = ob_get_clean();

  $return_array = array(
    'last' => $post_count <= $posts_per_page,
    'count' => $offset + $posts_per_page,
    'limit' => $limit,
    'html' => $html,
  );

  echo json_encode($return_array);
  die();
}

/******************* LMS functions *******************/
add_action('tutor_course/archive/before_loop', 'laaldea_remove_default_content_before_loop', 5);

function laaldea_remove_default_content_before_loop() {
  remove_action('tutor_course/archive/before_loop', 'tutor_course_archive_filter_bar');
}

function laaldea_build_courses_sidebar () {
  global $wp_query;
  
  $course_post_type = tutor() -> course_post_type;
  $args = array(
    'post_type' 	=> $course_post_type,
    'post_status'   => 'publish',

    'id'       		=> '',
    'exclude_ids'   => '',
    'category'     	=> '',

    'orderby'       => 'ID',
    'order'         => 'DESC',
    'count'     	=> 4,
  );

  if (!empty($args['id'])) {
    $ids = (array) explode(',', $args['id']);
    $args['post__in'] = $ids;
  }

  if (!empty($args['exclude_ids'])) {
    $exclude_ids = (array) explode(',', $args['exclude_ids']);
    $args['post__not_in'] = $exclude_ids;
  }
  if (!empty($args['category'])) {
    $category = (array) explode(',', $args['category']);

    $args['tax_query'] = array(
      array(
        'taxonomy' => 'course-category',
        'field'    => 'term_id',
        'terms'    => $category,
        'operator' => 'IN',
      ),
    );
  }
  $args['posts_per_page'] = (int) $args['count'];

  $course_query = new WP_Query( $args );
  $wp_query -> query_vars['laaldea_args']['course_query'] = $course_query;

  ob_start();
  $template_url = laaldea_load_template('courses-sidebar.php', 'learning');
  load_template($template_url, false);
  $html = ob_get_clean();
  
  return $html;
}
add_shortcode( 'laaldea_courses_sidebar', 'laaldea_build_courses_sidebar' );


function laaldea_course_enroll_button( $echo = true ) {
  $enrolled = tutor_utils()->is_enrolled();

  $is_administrator = current_user_can('administrator');
  $is_instructor = tutor_utils()->is_instructor_of_this_course();
  $course_content_access = (bool) get_tutor_option('course_content_access_for_ia');

  ob_start();
  if ( $enrolled ) {
    $template_url = laaldea_load_template('course-enrolled-button.php', 'tutor/loop');
    load_template($template_url, false);
  } 
  else if ( $course_content_access && ($is_administrator || $is_instructor) ) {
    $template_url = laaldea_load_template('course-continue-lesson.php', 'tutor/loop');
    load_template($template_url, false);
  } 
  else {
    $template_url = laaldea_load_template('course-enroll.php', 'tutor/loop');
    load_template($template_url, false);
  }
  $html = ob_get_clean();

  if ( $echo ) {
    echo $html;
  }
  return $html;
}

function laaldea_course_course_button( $echo = true ) {
  global $wp_query;

  $enrolled = tutor_utils()->is_enrolled();

  $is_administrator = current_user_can('administrator');
  $is_instructor = tutor_utils()->is_instructor_of_this_course();
  $course_content_access = (bool) get_tutor_option('course_content_access_for_ia');
  
  $button_text = '';
  if ( $enrolled ) {
    $button_text = __('Continuar','laaldea');
  } 
  else if ( $course_content_access && ($is_administrator || $is_instructor) ) {
    $button_text = __('Continuar','laaldea');
  } 
  else {
    $button_text = __('Comenzar','laaldea');
  }
  $wp_query -> query_vars['laaldea_args']['button_text'] = $button_text;

  ob_start();
  $template_url = laaldea_load_template('course-button-html.php', 'tutor/loop');
  load_template($template_url, false);
  $html = ob_get_clean();

  if ($echo){
      echo $html;
  }
  return $html;
}

function laaldea_course_benefits_html($echo = true) {
  ob_start();
  $template_url = laaldea_load_template('course-benefits-html.php', 'tutor/loop');
  load_template($template_url, false);
  $html = ob_get_clean();

  if ($echo){
      echo $html;
  }
  return $html;
}

function laaldea_tutor_get_topic_count($course_id = 0) {
  global $wpdb;

  if ( ! $course_id){
    $course_id = get_the_ID();
    if ( ! $course_id){
      $course_id = -1;
    }
  }

  $type = 'topics';
  $query = "SELECT post_status, COUNT( * ) AS num_posts FROM {$wpdb -> posts} WHERE post_type = %s AND post_parent = %s";
  $query_text = $wpdb->prepare( $query, $type, $course_id);
  $results = (array) $wpdb->get_results( $wpdb->prepare( $query, $type, $course_id), ARRAY_A );
  $counts  = array_fill_keys( get_post_stati(), 0 );

  foreach ( $results as $row ) {
    $counts[ $row['post_status'] ] = $row['num_posts'];
  }

  $counts = (object) $counts;

  return $counts -> publish;
}

function laaldea_get_tutor_header($fullScreen = false, $header_slug){
  $enable_spotlight_mode = tutor_utils()->get_option('enable_spotlight_mode');

  if ($enable_spotlight_mode || $fullScreen){
    ?>
          <!doctype html>
          <html <?php language_attributes(); ?>>
          <head>
              <meta charset="<?php bloginfo( 'charset' ); ?>" />
              <meta name="viewport" content="width=device-width, initial-scale=1" />
              <link rel="profile" href="https://gmpg.org/xfn/11" />
      <?php wp_head(); ?>
          </head>
          <body <?php body_class(); ?>>
          <div id="tutor-page-wrap" class="tutor-site-wrap site">
    <?php
  }else{
    get_header($header_slug);
  }

}

function laaldea_get_tutor_course_thumbnail($size = 'post-thumbnail', $url = false, $post_id = 0) {
  if ( ! $post_id){
    $post_id = get_the_ID();
    if ( ! $post_id){
      $post_id = -1;
    }
  }
  
  $post_thumbnail_id = (int) get_post_thumbnail_id( $post_id );

  if ( $post_thumbnail_id ) {
      //$size = apply_filters( 'post_thumbnail_size', $size, $post_id );
      $size = apply_filters( 'tutor_course_thumbnail_size', $size, $post_id );
      if ($url){
          return wp_get_attachment_image_url($post_thumbnail_id, $size);
      }

      $html = wp_get_attachment_image( $post_thumbnail_id, $size, false );
  } else {
      $placeHolderUrl = tutor()->url . 'assets/images/placeholder.jpg';
      if ($url){
          return $placeHolderUrl;
      }
      $html = sprintf('<img alt="%s" src="' . $placeHolderUrl . '" />', __('Placeholder', 'tutor'));
  }

  echo $html;
}

function laaldea_add_course_filter_classes($classes) {
  // Current courses query
  $user_id = tutor_utils()->get_user_id();
  $course_id = get_the_id();

  array_push($classes, 'tutor-course-container');
  $completed = tutor_utils() -> is_completed_course($course_id, $user_id);
  if(FALSE !== $completed) {
    array_push($classes, 'state-completed');
    return $classes;
  }
  
  $started = tutor_utils() -> is_enrolled($course_id, $user_id);
  if(FALSE !== $started) {
    array_push($classes, 'state-started');
  }
  
  return $classes;
}
add_filter( 'tutor_course_loop_col_classes', 'laaldea_add_course_filter_classes' );

function laaldea_tutor_course_mark_complete_html_lesson( $echo = true ) {
  ob_start();
  $template_url = laaldea_load_template('complete_form.php', 'tutor/single/lesson');
  load_template($template_url, false);
  $html = ob_get_clean();

  if ( $echo ) {
      echo $html;
  }

  return $html;
}
function laaldea_tutor_course_mark_complete_html_quiz( $echo = true ) {
  ob_start();
  $template_url = laaldea_load_template('complete_form.php', 'tutor/single/quiz');
  load_template($template_url, false);
  $html = ob_get_clean();
  

  if ( $echo ) {
      echo $html;
  }

  return $html;
}