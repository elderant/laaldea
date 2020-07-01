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

	$template_url = laaldea_load_template('click.php', 'home');
	load_template($template_url, true);

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