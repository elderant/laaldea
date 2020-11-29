<?php
add_action( 'wp_enqueue_scripts', 'wpb_child_enqueue_styles' );
function wpb_child_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_script('wpb-child-main', get_stylesheet_directory_uri() . '/inc/assets/js/script.js', array(), '', true );

	if(is_home() || is_front_page() || is_page(304) || is_page(308)) {
		wp_enqueue_style('wpb-child-home-style', get_stylesheet_directory_uri() . '/inc/assets/css/home/style.css', array(), false );
		wp_enqueue_style('wpb-child-home-animate', get_stylesheet_directory_uri() . '/inc/assets/css/home/animate.css', array(), false );
		wp_enqueue_style('wpb-child-home-hover', get_stylesheet_directory_uri() . '/inc/assets/css/home/hover.css', array(), false );
		wp_enqueue_style('wpb-child-home-slick', get_stylesheet_directory_uri() . '/inc/assets/css/home/slick.css', array(), false );
		wp_enqueue_script('wpb-child-modernizr', get_stylesheet_directory_uri() . '/inc/assets/js/home/modernizr.js', array(), false );

		wp_enqueue_script('wpb-child-home-classie', get_stylesheet_directory_uri() . '/inc/assets/js/home/classie.js', array('jquery'), false, true );
		wp_enqueue_script('wpb-child-home-borderMenu', get_stylesheet_directory_uri() . '/inc/assets/js/home/borderMenu.js', array('wpb-child-home-classie'), false, true );
		//wp_enqueue_script('wpb-child-home-sequence', get_stylesheet_directory_uri() . '/inc/assets/js/home/jquery.sequence.js', array('wpb-child-home-classie'), false, true );
		wp_enqueue_script('wpb-child-home-sequence', get_stylesheet_directory_uri() . '/inc/assets/js/home/sequence.min.js', array('wpb-child-home-borderMenu'), false, true );
		//wp_enqueue_script('wpb-child-home-jsor', get_stylesheet_directory_uri() . '/inc/assets/js/home/jssor.slider.min.js', array('jquery'), false, true );
		wp_enqueue_script('wpb-child-home-slick', get_stylesheet_directory_uri() . '/inc/assets/js/home/slick.min.js', array('jquery'), false, true );
		wp_enqueue_script('wpb-child-home-hovers', get_stylesheet_directory_uri() . '/inc/assets/js/home/hovers.js', array('wpb-child-home-sequence'), false, true );
		wp_enqueue_script('wpb-child-home-snap', get_stylesheet_directory_uri() . '/inc/assets/js/home/snap.svg-min.js', array('wpb-child-home-hovers'), false, true );
		wp_enqueue_script('wpb-child-home-main', get_stylesheet_directory_uri() . '/inc/assets/js/home/main.js', array('wpb-child-home-snap'), false, true );
		wp_enqueue_script('wpb-child-home-toucheffects', get_stylesheet_directory_uri() . '/inc/assets/js/home/toucheffects.js', array('wpb-child-home-main'), false, true );
		wp_enqueue_script('wpb-child-home-inine', get_stylesheet_directory_uri() . '/inc/assets/js/home/inline.js', array('wpb-child-home-toucheffects'), false, true );

		// wp_enqueue_script('wpb-child-home-googlemaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', array('jquery'), false, true );
	}
} 

add_action( 'wp_enqueue_scripts', 'wpb_child_enqueue_mobile_styles', 99 );
function wpb_child_enqueue_mobile_styles() {
	if(is_home() || is_front_page() || is_page(304) || is_page(308)) {
		wp_enqueue_style('wpb-child-home-mobile', get_stylesheet_directory_uri() . '/inc/assets/css/home/mobile.css', array(), false );
	}
}

// include custom jQuery
function wpb_child_include_custom_jquery() {
	// wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'wpb_child_include_custom_jquery');

function wpb_child_enqueue_admin_styles() {
	wp_enqueue_style( 'wpb-child-admin', get_stylesheet_directory_uri() . '/inc/admin/style.css' );
}
add_action( 'admin_enqueue_scripts', 'wpb_child_enqueue_admin_styles' );
/******************** Shared ********************/
//Page Slug Body Class
function laaldea_add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
//add_filter( 'body_class', 'laaldea_add_slug_body_class' );

function laaldea_register_secondary_menu() {
  register_nav_menu('secondary-menu', __( 'Secondary menu', 'wpb-child' ));
  register_nav_menu('learning-menu', __( 'E-Learning menu', 'wpb-child' ));
}
add_action( 'init', 'laaldea_register_secondary_menu' );

function wpb_child_add_acf_custom_body_class($classes) {
	if(get_field("custom_body_class") <> "") {
		// error_log("Adding class");
		$classes[] = get_field("custom_body_class");
	}
	return $classes;
}
	
add_filter('body_class','wpb_child_add_acf_custom_body_class');

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

	// $text = $read_more_link -> createElement('span', __( 'Continue reading' ) );
	// $new_link->appendChild($text);
	
	return $new_link->C14N(); 
}; 
			 
// add the filter 
add_filter( 'the_content_more_link', 'filter_the_content_more_link', 10, 2 ); 

/**
 * Load custom WordPress nav walker.
 */
if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
	require_once(dirname( __FILE__ ) . '/inc/wp_bootstrap_navwalker.php');
}

/******************** Blog ********************/
// The filter callback function.
function wpb_child_learning_forum_menu_args( $classes, $item, $args, $depth ) {
  if($item -> ID == 318) {
    $identifier = '/learning-forums/';
    if(FALSE === strpos($_SERVER['REQUEST_URI'], $identifier)) {
      return $classes;
    }

    array_push($classes, 'current-menu-item');
    array_push($classes, 'active');
  }

  return $classes;
}
add_filter( 'nav_menu_css_class', 'wpb_child_learning_forum_menu_args', 10, 4 );

function wpb_child_get_location_from_ip ( $reply_ip ) {
  // error_log('ip in wpb_child : ' . print_r($reply_ip,1));
  $json     = file_get_contents("http://ipinfo.io/" . $reply_ip . "/geo");
  $json     = json_decode($json, true);
  // $country  = $json['country'];
  // $region   = $json['region'];
  // $city     = $json['city'];

  return $json;
}

function wpb_child_the_location_from_ip( $reply_ip ) {
  $array = wpb_child_get_location_from_ip($reply_ip);

  echo $json['region'] . ", " . $json['city'];
}

function wpb_child_forum_sidebar() {
  $args = array(
    'name'          => 'Main Forum Sidebar',
    'id'            => 'forum-sidebar',
    'description'   => 'Sidebar to use on the forum page',
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widgettitle">',
    'after_title'   => '</h4>' 
  );
  
  register_sidebar( $args );
}
add_action( 'widgets_init', 'wpb_child_forum_sidebar' );

function wpb_child_topic_sidebar() {
  $args = array(
    'name'          => 'Main Topic Sidebar',
    'id'            => 'topic-sidebar',
    'description'   => 'Sidebar to use on the topic page',
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widgettitle">',
    'after_title'   => '</h4>',
  );
  
  register_sidebar( $args );
}
add_action( 'widgets_init', 'wpb_child_topic_sidebar' );

function wpb_child_replies_sidebar() {
  $args = array(
    'name'          => 'Main Replies Sidebar',
    'id'            => 'replies-sidebar',
    'description'   => 'Sidebar to use on the replies page',
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widgettitle">',
    'after_title'   => '</h4>',
  );
  
  register_sidebar( $args );
}
add_action( 'widgets_init', 'wpb_child_replies_sidebar' );

function wpb_child_courses_sidebar() {
  $args = array(
    'name'          => 'Main Courses Sidebar',
    'id'            => 'courses-sidebar',
    'description'   => 'Sidebar to use on the courses archive page',
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widgettitle">',
    'after_title'   => '</h4>',
  );
  
  register_sidebar( $args );
}
add_action( 'widgets_init', 'wpb_child_courses_sidebar' );

/******************** App functinality ********************/ 
/**
 * Reescribe el tamaño maximo de los archivos a subir
 */
// @ini_set( 'upload_max_size' , '64M' );
// @ini_set( 'post_max_size', '64M');
// @ini_set( 'max_execution_time', '300' );


/**
 * Login Route
 */
add_action(
    'rest_api_init',
    function () {
        register_rest_route(
            'api',
            'login',
            array(
                'methods'  => 'POST',
                'callback' => 'login',
            )
        );
    }
);

/**
 * Register Route
 */
add_action(
    'rest_api_init',
    function () {
        register_rest_route(
            'api',
            'register',
            array(
                'methods'  => 'POST',
                'callback' => 'registrer',
            )
        );
    }
);

add_action(
    'rest_api_init',
    function () {
        register_rest_route(
            'api',
            'checkmail',
            array(
                'methods'  => 'POST',
                'callback' => 'checkMail',
            )
        );
    }
);

function login( WP_REST_Request $request ) {
    $arr_request = json_decode( $request->get_body() );
 
    if ( ! empty( $arr_request->username ) && ! empty( $arr_request->password ) ) {
		// Aqui obtenemos los datos del usuario
		$user = get_user_by( 'email', $arr_request->username );

		if ( ! $user ) {
			// if the user name doesn't exist.
			return [
				'status' => 400,
				'message' => 'El usuario no existe',
			];
		}

		// Verificamos la password del usuario
		if ( ! wp_check_password( $arr_request->password, $user->user_pass, $user->ID ) ) {
			// Si la password es incorrecta lo notificamos
			return [
				'status' => 400,
				'message' => 'La contraseña es incorrecta',
			];
		}

		return [
			'status' => 200,
			'message' => 'OK',
			'results' => $user
		];
	} else {
		return [
			'status' => 401,
			'message' => 'Credenciales invalidas favor de verificar',
		];
	}
}

function registrer( WP_REST_Request $request ) {
    $arr_request = json_decode( $request->get_body() );
 
    if ( !empty( $arr_request->username ) && !empty( $arr_request->password )  ) {
        {
            $user = get_user_by( 'email', $arr_request->username );
 
            if ( $user ) {
                // if the user name doesn't exist.
                return [
                    'status' => 400,
                    'message' => 'El email ya se encuentra registrado',
                ];
			}
			
			
			$userData = new stdClass();
			$userData->user_pass  = $arr_request->password;
			$userData->user_login = $arr_request->username;
			$userData->user_email = $arr_request->username;
			$userData->first_name = $arr_request->name;
			$userData->show_admin_bar_front  = false;

			$user_id = wp_insert_user( $userData );
			$user = new WP_User( $user_id );
			
			if($arr_request->userType == 0 ) // el usuario es padre de familia
			{
				add_user_meta( $user_id, "ciudad", $arr_request->ciudad );
				add_user_meta( $user_id, "userType", $arr_request->userType );
				add_user_meta( $user_id, "userTypeName", "Padre de Familia" );
			}else
			{
				add_user_meta( $user_id, "ciudad", $arr_request->ciudad );
				add_user_meta( $user_id, "userType", $arr_request->userType );
				add_user_meta( $user_id, "userTypeName", "Docente" );
				add_user_meta( $user_id, "area_ensenanza", $arr_request->area );
				add_user_meta( $user_id, "grado_ensenanza", $arr_request->grado );
				add_user_meta( $user_id, "institucion", $arr_request->institucion );
				add_user_meta( $user_id, "telefono", $arr_request->telefono );
			}

			return[
				'status' => 200,
				'message' => "OK"
			];
        }
    } else {
        return [
            'status' => 400,
            'message' => 'Credenciales invalidas favor de verificar',
        ];
    }
}

function checkMail( WP_REST_Request $request ) {
    $arr_request = json_decode( $request->get_body() );
 
    if ( !empty( $arr_request->username )  ) {
        {
            $user = get_user_by( 'email', $arr_request->username );
 
            if ( $user ) {
                // if the user name doesn't exist.
                return [
                    'status' => 200,
                    'message' => 'EL email ya se encuentra registrado',
                ];
			}else{
				return[
				'status' => 201,
				'message' => "OK"
			];
			}
        }
    } else {
        return [
            'status' => 400,
            'message' => 'Parametos faltantes',
        ];
    }
}
