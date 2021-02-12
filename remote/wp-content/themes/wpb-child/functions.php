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
  
  if(is_page(312)) {
    wp_enqueue_style('wpb-child-home-slick', get_stylesheet_directory_uri() . '/inc/assets/css/home/slick.css', array(), false );
    wp_enqueue_script('wpb-child-home-slick', get_stylesheet_directory_uri() . '/inc/assets/js/home/slick.min.js', array('jquery'), false, true );
  }
} 

add_action( 'wp_enqueue_scripts', 'wpb_child_enqueue_mobile_styles', 99 );
function wpb_child_enqueue_mobile_styles() {
	if(is_home() || is_front_page() || is_page(304) || is_page(308)) {
		wp_enqueue_style('wpb-child-home-mobile', get_stylesheet_directory_uri() . '/inc/assets/css/home/mobile.css', array(), false );
  }
  else {
    wp_enqueue_style('wpb-child-learning-mobile', get_stylesheet_directory_uri() . '/inc/assets/css/learning-mobile.css', array(), false );
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

function wpb_child_enqueue_bootstrap_extended_styles() {
  wp_enqueue_style('wpb-child-bootstrap-ext', get_stylesheet_directory_uri() . '/inc/assets/css/bootstrap.ext.css', array(), false );
}
add_action( 'wp_enqueue_scripts', 'wpb_child_enqueue_bootstrap_extended_styles', 99 );

// include select2 js/css
function wpb_child_enqueue_select2_files() {
  if(is_page(330)) {
    wp_enqueue_script( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery') );
    wp_enqueue_style( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' );
  }
}
add_action( 'wp_enqueue_scripts', 'wpb_child_enqueue_select2_files' );
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

//redirect user to login 
function wpb_child_admin_redirect() {
  global $wp_query;
  $page_id = get_the_ID();
  $home_ids = array(2,259,304,308, 58);
  $user_ids = array(332, 544, 328, 547, 550, 553, 330, 331);

  $is_home = in_array($page_id,$home_ids);
  $is_user_flow = in_array($page_id,$user_ids);

  if(is_user_logged_in()) {
    return;
  }
  if($is_home) {
    return;
  }
  if($is_user_flow) {
    return;
  }
  if(is_404()) {
    return;
  }
  auth_redirect();
  exit;
}
add_action('get_header', 'wpb_child_admin_redirect');

function laaldea_register_secondary_menu() {
  register_nav_menu('secondary-menu', __( 'Secondary menu', 'wpb-child' ));
  register_nav_menu('learning-menu', __( 'E-Learning menu', 'wpb-child' ));

  register_nav_menu('learning-user', __( 'E-Learning user menu', 'wpb-child' ));
  register_nav_menu('learning-mobile', __( 'E-Learning mobile menu', 'wpb-child' ));
}
add_action( 'init', 'laaldea_register_secondary_menu' );

function wpb_child_add_acf_custom_body_class($classes) {
	if(get_field("custom_body_class") <> "") {
		$classes[] = get_field("custom_body_class");
	}
	return $classes;
}
	
add_filter('body_class','wpb_child_add_acf_custom_body_class');

add_filter( 'walker_nav_menu_start_el', 'wpb_child_add_user_menu_html', 10, 4 );
function wpb_child_add_user_menu_html($item_output, $item, $depth, $args) {
  if(in_array('user-link',$item -> classes) ) {
    if(!is_user_logged_in()) {
      return;
    }
    
    $user_id = get_current_user_id();
    $user = wp_get_current_user();
    $user_data = get_userdata( $user_id );
    $user_name = $user_data->data->display_name;
    $avatar_url = get_user_meta( $user_id, 'user_avatar', true);
    $greet_string = sprintf( wp_kses( __( '<span class="%s">¡Hola, </span><span>%s!</span>', 'wpb_child' ), array( 'span' => array('class' => array())) ), 'color-cyan', $user_name );
    
    $html = '<button class="menu-button collapsed" type="button" data-toggle="collapse" data-target="#user-navbar">' .
        '<img src="' . $avatar_url . '" alt="' . __('User avatar','wpb_child') . '">' .
        '<span class="user-greet">' . $greet_string . '</span>' .
      '</button>';
    
    $item_output = $html;
  }

  if(in_array('logout-link',$item -> classes) ) {
    if(!is_user_logged_in()) {
      return;
    }
     
    $html = '<a title="Cerrar Sesión" href="' . wp_logout_url( ) . '" class="nav-link">Cerrar Sesión</a>';
    $item_output = $html;
  }

  if(in_array('image-link',$item -> classes) ) {
    $image_url;$alt_text;
    if(in_array('crea-link',$item -> classes) ) {
      $image_url = '/wp-content/uploads/page-crea-icon.png';
      $alt_text = __('Icono de crea', 'laaldea');
    }
    elseif(in_array('click-link',$item -> classes) ) {
      $image_url = '/wp-content/uploads/page-click-icon.png';
      $alt_text = __('Icono de click', 'laaldea');
    }
    else {
      $image_url = '/wp-content/uploads/tools-filter-canciones.png';
      $alt_text = __('Placeholder image', 'laaldea');
    }

    $target = (isset($item -> target) && !empty($item -> target )) ? ' target="' . $item -> target . '"':'';

    //error_log(print_r($target,1));

    $html = '<a class="image-link"' . $target . ' href="' . $item -> url . '">' .
        '<img src="' . $image_url . '" alt="' . $alt_text . '">' .
      '</a>';

    //error_log(print_r($html,1));
    $item_output = $html;
  }

  if(in_array('forum-dashboard-link',$item -> classes)) {
    // error_log(print_r($item_output,1));
    // error_log(print_r($item,1));
    $profile_url = bbp_get_user_profile_url( get_current_user_id() );

    $html = '<a title="' . $item -> title . '" href="' . $profile_url . '" class="nav-link">' . $item -> title . '</a>';
    $item_output = $html;
  }
  return $item_output;
}

function wpb_child_wp_login_form( $args = array() ) {
  global $wp_query;

  $defaults = array(
      'echo'           => true,
      // Default 'redirect' value takes the user back to the request URI.
      'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
      'form_id'        => 'loginform',
      'label_username' => __( 'Username or Email Address' ),
      'label_password' => __( 'Password' ),
      'label_remember' => __( 'Remember Me' ),
      'label_log_in'   => __( 'Log In' ),
      'id_username'    => 'user_login',
      'id_password'    => 'user_pass',
      'id_remember'    => 'rememberme',
      'id_submit'      => 'wp-submit',
      'remember'       => true,
      'value_username' => '',
      // Set 'value_remember' to true to default the "Remember me" checkbox to checked.
      'value_remember' => false,
  );

  /**
   * Filters the default login form output arguments.
   *
   * @since 3.0.0
   *
   * @see wp_login_form()
   *
   * @param array $defaults An array of default login form arguments.
   */
  $args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );

  /**
   * Filters content to display at the top of the login form.
   *
   * The filter evaluates just following the opening form tag element.
   *
   * @since 3.0.0
   *
   * @param string $content Content to display. Default empty.
   * @param array  $args    Array of login form arguments.
   */
  $login_form_top = apply_filters( 'login_form_top', '', $args );

  /**
   * Filters content to display in the middle of the login form.
   *
   * The filter evaluates just following the location where the 'login-password'
   * field is displayed.
   *
   * @since 3.0.0
   *
   * @param string $content Content to display. Default empty.
   * @param array  $args    Array of login form arguments.
   */
  $login_form_middle = apply_filters( 'login_form_middle', '', $args );

  /**
   * Filters content to display at the bottom of the login form.
   *
   * The filter evaluates just preceding the closing form tag element.
   *
   * @since 3.0.0
   *
   * @param string $content Content to display. Default empty.
   * @param array  $args    Array of login form arguments.
   */
  $login_form_bottom = apply_filters( 'login_form_bottom', '', $args );

  $wp_query -> query_vars['wpb_args']['args'] = $args;
  $wp_query -> query_vars['wpb_args']['login_form_top'] = $login_form_top;
  $wp_query -> query_vars['wpb_args']['login_form_middle'] = $login_form_middle;
  $wp_query -> query_vars['wpb_args']['login_form_bottom'] = $login_form_bottom;

  ob_start();
  get_template_part( 'template-parts/form', 'login' );
  $html = ob_get_clean();
  if ( $args['echo'] ) {
      echo $html;
  } else {
      return $html;
  }
}
/******************** Blog ********************/
// define the the_content_more_link callback 
function filter_the_content_more_link( $link, $link_text ) { 
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
  if($item -> ID == 317) {
    $identifier = '/courses/';
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
  $json     = file_get_contents("http://ipinfo.io/" . $reply_ip . "/geo");
  $json     = json_decode($json, true);
  // $country  = $json['country'];
  // $region   = $json['region'];
  // $city     = $json['city'];

  return $json;
}

function wpb_child_the_location_from_ip( $reply_ip ) {
  $array = wpb_child_get_location_from_ip($reply_ip);

  echo $array['region'] . ", " . $array['city'];
}

function wpb_child_bbp_reverse_reply_order( $query = array() ) {
  $query['order']='DESC';
  return $query;
}
//add_filter('bbp_has_replies_query','wpb_child_bbp_reverse_reply_order');

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


/******************** Tutor ********************/
add_action('template_redirect', 'wpb_child_custom_form_handler');
function wpb_child_custom_form_handler() {
  // handle complete lesson button action.
  if ( isset($_POST['tutor_action'])  &&  $_POST['tutor_action'] !== 'tutor_complete_lesson_custom' ) {
    wpb_child_mark_lesson_complete();
  }

  if ( isset($_POST['tutor_action'])  &&  $_POST['tutor_action'] !== 'tutor_complete_course_custom' ) {
    wpb_child_mark_course_complete();
  }

  return;
}

/* handle complete lesson button action. */
function wpb_child_mark_lesson_complete() {
  //Checking nonce
  tutor_utils() -> checking_nonce();

  $user_id = get_current_user_id();

  //TODO: need to show view if not signed_in
  if ( ! $user_id){
    die(__('Please Sign-In', 'tutor'));
  }

  $lesson_id = (int) sanitize_text_field($_POST['lesson_id']);

  do_action('tutor_lesson_completed_before', $lesson_id);
  /**
   * Marking lesson at user meta, meta format, _tutor_completed_lesson_id_{id} and value = tutor_time();
   */
  tutor_utils() -> mark_lesson_complete($lesson_id);

  // for last lesson : check if the course should be marked as completed.
  
  // UNCOMMENT THE FUNCTION TO MARK THE COURSE AS COMPLETE
  $course_id = tutor_utils()->get_course_id_by_lesson($lesson_id);
  $status = wpb_child_tutor_course_complete_status($course_id);
  if($status == 1) {
    $_POST['course_id'] = $course_id;
    $_POST['tutor_action'] = 'tutor_complete_course_custom';
    wpb_child_mark_course_complete();
  }
}

function wpb_child_tutor_course_complete_status($course_id) {
  $completion_mode = tutils()->get_option('course_completion_process');

  if ($completion_mode !== 'strict'){
    return 0;
  }

  $completed_lesson = tutils()->get_completed_lesson_count_by_course($course_id);
  $lesson_count = tutils()->get_lesson_count_by_course($course_id);

  if ($completed_lesson < $lesson_count){
    return 2;
  }

  $quizzes = array();

  $course_contents = tutils()->get_course_contents_by_id($course_id);
  if (tutils()->count($course_contents)){
    foreach ($course_contents as $content){
      if ($content->post_type === 'tutor_quiz'){
        $quizzes[] = $content;
      }
    }
  }

  $is_pass = true;
  $required_quiz_pass = 0;

  if (tutils()->count($quizzes)){
    foreach ($quizzes as $quiz){

      $attempt = tutils()->get_quiz_attempt($quiz->ID);
      if ($attempt) {
        $passing_grade = tutor_utils()->get_quiz_option($quiz->ID, 'passing_grade', 0);
        $earned_percentage = $attempt->earned_marks > 0 ? (number_format(($attempt->earned_marks * 100) / $attempt->total_marks)) : 0;

        if ($earned_percentage < $passing_grade) {
          $required_quiz_pass++;
          $is_pass = false;
        }
      }else{
        $required_quiz_pass++;
        $is_pass = false;
      }
    }
  }

  if ( ! $is_pass){
    return 3;
  }

  return 1;
}

add_action( 'wp_ajax_nopriv_wpb_child_complete_and_next_lesson', 'wpb_child_mark_lesson_complete_ajax' );
add_action( 'wp_ajax_wpb_child_complete_and_next_lesson', 'wpb_child_mark_lesson_complete_ajax' );
function wpb_child_mark_lesson_complete_ajax() {
  wpb_child_mark_lesson_complete();

  $return_array = array(
    'success' => 'true',
  );

  echo json_encode($return_array);
  die();
}

/* Complete course */
// Add course in lesson complete button.
if ( ! function_exists('wpb_child_tutor_in_lesson_course_mark_complete_html')) {
  function wpb_child_tutor_in_lesson_course_mark_complete_html( $course_id, $echo = true ) {
    ob_start();
    tutor_load_template( 'single.course.in_lesson_complete_form' );
    $output = apply_filters( 'tutor_course/single/in_lesson_complete_form', ob_get_clean(), $course_id );

    if ( $echo ) {
        echo $output;
    }

    return $output;
  }
}

// Add course completion percent on lesson.
if ( ! function_exists('wpb_child_tutor_lesson_completing_progress_bar')) {
  function wpb_child_tutor_lesson_completing_progress_bar( $echo = true ) {
      ob_start();
      tutor_load_template( 'single.lesson.completing-progress' );
      $output = apply_filters( 'tutor_lesson/single/completing-progress-bar', ob_get_clean() );

      if ( $echo ) {
          echo $output;
      }

      return $output;
  }
}

//Hide course complete button in lesson.
add_filter('tutor_course/single/in_lesson_complete_form', 'wpb_child_tutor_lms_hide_course_complete_btn_in_lesson', 10, 2);
function wpb_child_tutor_lms_hide_course_complete_btn_in_lesson($html, $course_id) {
  $status = wpb_child_tutor_course_complete_status($course_id);

  if($status == 0) {
    return $html;
  }
  else if($status == 2) {
    return '<p class="suggestion-before-course-complete">'.__('complete all lessons to mark this course as complete', 'tutor').'</p>';
  }
  else if($status == 3) {
    return '<p class="suggestion-before-course-complete">'.sprintf(__('You have to pass %s quizzes to complete this course.', 'tutor'), $required_quiz_pass).'</p>';
  }
  else {
    return $html;
  }
}

/* handle in lesson complete course button action. */
function wpb_child_mark_course_complete(){
  //Checking nonce
  tutor_utils()->checking_nonce();

  $user_id = get_current_user_id();

  //TODO: need to show view if not signed_in
  if ( ! $user_id){
    die(__('Please Sign-In', 'tutor'));
  }

  $course_id = (int) sanitize_text_field($_POST['course_id']);

  do_action('tutor_course_complete_before', $course_id);
  /**
   * Marking course completed at Comment
   */

  global $wpdb;

  $date = date("Y-m-d H:i:s", tutor_time());

  //Making sure that, hash is unique
  do{
    $hash = substr(md5(wp_generate_password(32).$date.$course_id.$user_id), 0, 16);
    $hasHash = (int) $wpdb->get_var("SELECT COUNT(comment_ID) from {$wpdb->comments} WHERE comment_agent = 'TutorLMSPlugin' AND comment_type = 'course_completed' AND comment_content = '{$hash}' ");
  }while($hasHash > 0);

  $data = array(
    'comment_post_ID'   => $course_id,
    'comment_author'    => $user_id,
    'comment_date'      => $date,
    'comment_date_gmt'  => get_gmt_from_date($date),
    'comment_content'   => $hash, //Identification Hash
    'comment_approved'  => 'approved',
    'comment_agent'     => 'TutorLMSPlugin',
    'comment_type'      => 'course_completed',
    'user_id'           => $user_id,
  );

  $wpdb->insert($wpdb->comments, $data);

  do_action('tutor_course_complete_after', $course_id, $user_id);
}

add_action( 'wp_ajax_nopriv_wpb_child_complete_course_and_next', 'wpb_child_mark_course_complete_ajax' );
add_action( 'wp_ajax_wpb_child_complete_course_and_next', 'wpb_child_mark_course_complete_ajax' );
function wpb_child_mark_course_complete_ajax() {
  wpb_child_mark_course_complete();

  $return_array = array(
    'success' => 'true',
  );

  echo json_encode($return_array);
  die();
}
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
