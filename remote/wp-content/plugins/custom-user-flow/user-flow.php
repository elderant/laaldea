<?php
/**
 * Plugin Name:       Custom User Flow
 * Description:       A plugin that replaces the WordPress login flow with a custom page.
 * Version:           1.0.0
 * Text Domain:       user-flow
 */
 
class CustomUserFlow {
  /**
   * Initializes the plugin.
   *
   * To keep the initialization fast, only add filter and action
   * hooks in the constructor.
   */
  public function __construct() {   
    // Login page shortcode
    add_shortcode( 'cuf-login-form', array( $this, 'build_login_form_html' ) );

    // Account page shortcode
    add_shortcode( 'cuf-account-info', array( $this, 'build_edit_form_html' ) );
    
    // Custom registration page
    add_shortcode( 'cuf-register-form', array( $this, 'build_register_form' ) );

    // Custom password reset page
    add_shortcode( 'cuf-password-reset-form', array( $this, 'build_password_reset_form' ) );
    
    // Custom password change page
    add_shortcode( 'cuf-password-change-form', array( $this, 'build_password_change_form' ) );

    // Custom update user
    add_shortcode( 'cuf-account-update', array( $this, 'build_update_user_form' ) );

    // CUstom logged user change password
    add_shortcode( 'cuf-user-password-change', array( $this, 'build_user_password_change_form' ) );

    // Redirect to custom Login page
    add_action( 'login_form_login', array( $this, 'redirect_to_custom_login' ) );
    
    // Redirect to custom Register page
    add_filter( 'login_form_register', array( $this, 'redirect_to_custom_register' ), 10, 3 );

    // Redirect to custom Edit page
    add_action( 'load-profile.php', array( $this, 'redirect_to_custom_edit' ), 10, 3 );

    // Redirect to custom Reset password page
    add_filter( 'login_form_lostpassword', array( $this, 'redirect_to_custom_password_reset' ), 10, 3 );

    // Authentication redirection
    add_filter( 'authenticate', array( $this, 'redirect_at_authenticate' ), 101, 3 );

    // Logout redirection
    add_action( 'wp_logout', array( $this, 'redirect_after_logout' ) );

    // On login redirection
    add_filter( 'login_redirect', array( $this, 'redirect_after_login' ), 10, 3 );

    // Handle user registration
    add_action( 'login_form_register', array( $this, 'do_register_user' ) );

    // Handle user edit
    add_action( 'load-profile.php', array( $this, 'do_edit_user' ) );

    // Display custom user fields
    add_action( 'show_user_profile', array( $this, 'show_custom_user_fields' ) );
    add_action( 'edit_user_profile', array( $this, 'show_custom_user_fields' ) );

    // save changes to custom user fields
    add_action( 'personal_options_update', array( $this, 'update_custom_user_fields' ) );
    add_action( 'edit_user_profile_update', array( $this, 'update_custom_user_fields' )  );

    // Capcha Authentication fields
    //add_filter( 'admin_init' , array( $this, 'register_settings_fields' ) );
    // Add Captcha js to register page
    add_action( 'wp_print_footer_scripts', array( $this, 'add_captcha_js_to_footer' ) );

    // Handle user password reset
    add_action( 'login_form_lostpassword', array( $this, 'do_password_reset' ) );

    // Customize password reset email
    add_filter( 'retrieve_password_message', array( $this, 'replace_retrieve_password_message' ), 10, 4 );

    // Handle password change request
    add_action( 'login_form_rp', array( $this, 'redirect_to_custom_password_change' ) );
    add_action( 'login_form_resetpass', array( $this, 'redirect_to_custom_password_change' ) );

    // Handle password change post
    add_action( 'login_form_rp', array( $this, 'do_password_change' ) );
    add_action( 'login_form_resetpass', array( $this, 'do_password_change' ) );

    add_filter('show_admin_bar', array( $this, 'hide_adminbar_for_subscribers' ));

    // Handle user update post
    add_action( 'admin_post_nopriv_cuf_update_user', array( $this, 'do_update_user' ) );
    add_action( 'admin_post_cuf_update_user', array( $this, 'do_update_user' ) );

    // Handle lgged in user change password
    add_action( 'admin_post_nopriv_cuf_user_password_change', array( $this, 'do_user_password_change' ) );
    add_action( 'admin_post_cuf_user_password_change', array( $this, 'do_user_password_change' ) );
  }
  
  /**
   * Plugin activation hook.
   *
   * Creates all WordPress pages needed by the plugin.
   */
  public static function plugin_activated() {
    // Information needed for creating the plugin's pages
    $page_definitions = array(
      'login' => array(
        'title' => __( 'Login', 'user-flow' ),
        'content' => '[cuf-login-form]',
      ),
      'account' => array(
        'title' => __( 'Your Account', 'user-flow' ),
        'content' => '[cuf-account-info]',
      ),
      'register' => array(
        'title' => __( 'Register', 'user-flow' ),
        'content' => '[cuf-register-form]',
      ),
      'password-reset' => array(
        'title' => __( 'Password Reset', 'user-flow' ),
        'content' => '[cuf-password-reset-form]',
      ),
      'password-change' => array(
          'title' => __( 'Change Password', 'user-flow' ),
          'content' => '[cuf-password-change-form]',
      ),
    );

    foreach ( $page_definitions as $slug => $page ) {
      // Check that the page doesn't exist already
      $query = new WP_Query( 'pagename=' . $slug );
      if ( ! $query->have_posts() ) {
        // Add the page using the data from the array above
        wp_insert_post(
          array(
            'post_content'   => $page['content'],
            'post_name'      => $slug,
            'post_title'     => $page['title'],
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'ping_status'    => 'closed',
            'comment_status' => 'closed',
          )
        );
      }
    }
  }

  /**
   * Renders the contents of the given template to a string and returns it.
   *
   * @param string $template_name The name of the template to render (without .php)
   * @param array  $attributes    The PHP variables for the template
   *
   * @return string               The contents of the template.
   */
  private function get_template_html( $template_name, $attributes = null ) {
    if ( ! $attributes ) {
        $attributes = array();
    }

    ob_start();
    do_action( 'cuf_personalize_login_before_' . $template_name );
    require( 'templates/' . $template_name . '.php');
    do_action( 'cuf_personalize_login_after_' . $template_name );

    $html = ob_get_contents();
    ob_end_clean();

    return $html;
  }

  /**
   * A shortcode for rendering the login form.
   *
   * @param  array   $attributes  Shortcode attributes.
   * @param  string  $content     The text content for shortcode. Not used.
   *
   * @return string  The shortcode output
   */
  public function build_login_form_html( $attributes, $content = null ) {
    // Parse shortcode attributes
    $default_attributes = array( 'show_title' => false );
    $attributes = shortcode_atts( $default_attributes, $attributes );
    $show_title = $attributes['show_title'];

    if ( is_user_logged_in() ) {
      $html = '<div class="logged-in description">' . __( 'You are already signed in.', 'user-flow' ) . '</div>';
      return $html;
    }
    
    // Pass the redirect parameter to the WordPress login functionality: by default,
    // don't specify a redirect, but if a valid redirect URL has been passed as
    // request parameter, use it.
    $attributes['redirect'] = '';
    if ( isset( $_REQUEST['redirect_to'] ) ) {
        $attributes['redirect'] = wp_validate_redirect( $_REQUEST['redirect_to'], $attributes['redirect'] );
    }
    
    // Check if user just logged out
    $attributes['logged_out'] = isset( $_REQUEST['logged_out'] ) && $_REQUEST['logged_out'] == true;

    // Check if the user just registered
    $attributes['registered'] = isset( $_REQUEST['registered'] );
    $attributes['register_url'] = $this -> get_register_url();

    // Check if the user just requested a new password 
    $attributes['password_reset_sent'] = isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] == 'confirm';

    // Check if user just updated password
    $attributes['password_updated'] = isset( $_REQUEST['password'] ) && $_REQUEST['password'] == 'changed';

    // Error messages
    $errors = array();
    if ( isset( $_REQUEST['login'] ) ) {
      $error_codes = explode( ',', $_REQUEST['login'] );
  
      foreach ( $error_codes as $code ) {
        $errors[] = $this->get_error_message( $code );
      }
    }
    $attributes['errors'] = $errors;

    // Render the login form using an external template
    return $this -> get_template_html( 'login_form', $attributes );
  }

  /**
   * Redirect the user to the custom login page instead of wp-login.php.
   */
  function redirect_to_custom_login() {
    if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
      $redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : null;
  
      if ( is_user_logged_in() ) {
        $this -> redirect_logged_in_user( $redirect_to );
        exit;
      }

      // The rest are redirected to the login page
      $login_url = home_url( $this -> get_login_url() );
      if ( ! empty( $redirect_to ) ) {
        $login_url = add_query_arg( 'redirect_to', $redirect_to, $login_url );
      }

      wp_redirect( $login_url );
      exit;
    }
  }

  /**
   * Redirects the user to the correct page depending on whether he / she
   * is an admin or not.
   *
   * @param string $redirect_to  An optional redirect_to URL for admin users
   */
  private function redirect_logged_in_user( $redirect_to = null ) {
    $user = wp_get_current_user();
    if ( user_can( $user, 'manage_options' ) ) {
      if ( $redirect_to ) {
        wp_safe_redirect( $redirect_to );
      } else {
        wp_redirect( admin_url() );
      }
    } else {
      wp_redirect( home_url( 'learning-home' ) );
    }
  }

  public function hide_adminbar_for_subscribers() {
    $user = wp_get_current_user();
    if ( user_can( $user, 'manage_options' ) ) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Redirect the user after authentication if there were any errors.
   *
   * @param Wp_User|Wp_Error  $user       The signed in user, or the errors that have occurred during login.
   * @param string            $username   The user name used to log in.
   * @param string            $password   The password used to log in.
   *
   * @return Wp_User|Wp_Error The logged in user, or error information if there were errors.
   */
  function redirect_at_authenticate( $user, $username, $password ) {
    // Check if the earlier authenticate filter (most likely, 
    // the default WordPress authentication) functions have found errors
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
      if ( is_wp_error( $user ) ) {
        $error_codes = join( ',', $user->get_error_codes() );

        $login_url = home_url( $this -> get_login_url() );
        $login_url = add_query_arg( 'login', $error_codes, $login_url );

        wp_redirect( $login_url );
        exit;
      }
    }

    return $user;
  }

  /**
   * Finds and returns a matching error message for the given error code.
   *
   * @param string $error_code    The error code to look up.
   *
   * @return string               An error message.
   */
  private function get_error_message( $error_code ) {
    switch ( $error_code ) {
      case 'empty_username':
        return __( 'You do have an email address, right?', 'user-flow' );

      case 'empty_password':
        return __( 'You need to enter a password to login.', 'user-flow' );

      case 'invalid_username':
        return __(
          "We don't have any users with that email address. Maybe you used a different one when signing up?",
          'user-flow'
        );

      case 'incorrect_password':
        $err = __(
          "The password you entered wasn't quite right. <a href='%s'>Did you forget your password</a>?",
          'user-flow'
        );
        return sprintf( $err, wp_lostpassword_url() );

      case 'email':
        return __( 'The email address you entered is not valid.', 'user-flow' );
       
      case 'email_exists':
          return __( 'An account exists with this email address.', 'user-flow' );
       
      case 'closed':
          return __( 'Registering new users is currently not allowed.', 'user-flow' );

      case 'captcha':
        return __( 'The Google reCAPTCHA check failed. Are you a robot?', 'user-flow' );

      // Lost password
 
      case 'empty_username':
        return __( 'You need to enter your email address to continue.', 'user-flow' );

      case 'invalid_email':
      case 'invalidcombo':
        return __( 'There are no users registered with this email address.', 'user-flow' );
        
      // Reset password
 
      case 'expiredkey':
      case 'invalidkey':
          return __( 'The password reset link you used is not valid anymore.', 'user-flow' );
      
      case 'password_reset_mismatch':
          return __( "The two passwords you entered don't match.", 'user-flow' );
        
      case 'current_password_mismatch' :
          return __( "The current password entered is not correct", 'user-flow' );

      case 'password_reset_empty':
          return __( "Sorry, we don't accept empty passwords.", 'user-flow' );

      default:
        break;
    }
    
    return __( 'An unknown error occurred. Please try again later.', 'user-flow' );
  }

  /**
   * Redirect to custom login page after the user has been logged out.
   */
  public function redirect_after_logout() {
    $redirect_url = home_url( $this -> get_login_url() . '?logged_out=true' );
    wp_safe_redirect( $redirect_url );
    exit;
  }

  /**
   * Returns the URL to which the user should be redirected after the (successful) login.
   *
   * @param string           $redirect_to           The redirect destination URL.
   * @param string           $requested_redirect_to The requested redirect destination URL passed as a parameter.
   * @param WP_User|WP_Error $user                  WP_User object if login was successful, WP_Error object otherwise.
   *
   * @return string Redirect URL
   */
  public function redirect_after_login( $redirect_to, $requested_redirect_to, $user ) {
    $redirect_url = home_url();

    if ( ! isset( $user->ID ) ) {
      return $redirect_url;
    }

    if ( user_can( $user, 'manage_options' ) ) {
      // Use the redirect_to parameter if one is set, otherwise redirect to admin dashboard.
      if ( $requested_redirect_to == '' ) {
        $redirect_url = admin_url();
      } else {
        $redirect_url = $requested_redirect_to;
      }
    } else {
      // Non-admin users always go to their account page after login
      $redirect_url = home_url( '/learning-home' );
    }

    return wp_validate_redirect( $redirect_url, home_url() );
  }

  public function build_edit_form_html( $attributes, $content = null ) {
    // Parse shortcode attributes
    $default_attributes = array( 'show_title' => false );
    $attributes = shortcode_atts( $default_attributes, $attributes );

    // Retrieve possible errors from request parameters
    $attributes['errors'] = array();
    if ( isset( $_REQUEST['update-errors'] ) ) {
      $error_codes = explode( ',', $_REQUEST['update-errors'] );
    
      foreach ( $error_codes as $error_code ) {
        $attributes['errors'] []= $this->get_error_message( $error_code );
      }
    }

    if ( !is_user_logged_in() ) {
      $html = '<div class="not-logged-in description">' . __( 'You are not logged in.', 'user-flow' ) . '</div>';
      return $html;
    } else {
        return $this->get_template_html( 'edit_form', $attributes );
    }
  }

  /**
   * Redirects the user to the custom registration page instead
   * of wp-login.php?action=register.
   */
  public function redirect_to_custom_edit() {
    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
      if ( !is_user_logged_in() ) {
        $this -> redirect_logged_in_user();
      } elseif( ! current_user_can( 'manage_options' ) ) {
        wp_redirect( home_url( '/account' ) );  
        exit;
      } 
    }
  }

  private function edit_user( $email, $first_name, $last_name, $display_name, $user_phone, $user_area, $user_institution, $user_avatar, $user_ip, $user_location ) {
    $errors = new WP_Error();

    // Email address is used as both username and email. It is also the only
    // parameter we need to validate
    if ( ! is_email( $email ) ) {
      $errors->add( 'email', $this->get_error_message( 'email' ) );
      return $errors;
    }

    if ( username_exists( $email ) || email_exists( $email ) ) {
      $errors->add( 'email_exists', $this->get_error_message( 'email_exists') );
      return $errors;
    }

    $user_data = array(
      'user_email'    => $email,
      'display_name'  => $display_name
    );

    $user_id = wp_update_user( $user_data );

    //add first and last name
    update_user_meta( $user_id, 'first_name', $first_name );
    update_user_meta( $user_id, 'last_name', $last_name );
    update_user_meta( $user_id, 'user_phone', $user_phone );
    update_user_meta( $user_id, 'user_area', $user_area );
    update_user_meta( $user_id, 'user_institution', $user_institution );
    update_user_meta( $user_id, 'user_avatar', $user_avatar );
    update_user_meta( $user_id, 'user_ip', $user_ip );
    update_user_meta( $user_id, 'user_location', $user_location );

    return $user_id;
  }

  public function do_edit_user() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
      if(current_user_can( 'manage_options' )) {
        return;
      }
      $redirect_url = home_url( $this->get_update_user_url() );

      $email = $_POST['email'];
      $first_name = sanitize_text_field( $_POST['first_name'] );
      $last_name = sanitize_text_field( $_POST['last_name'] );
      $display_name = sanitize_text_field( $_POST['first_name'] );'theDisplayName';
      $user_phone = sanitize_text_field( $_POST['user_phone'] );
      $user_area = sanitize_text_field( $_POST['user_area'] );
      $user_institution = sanitize_text_field( $_POST['user_institution'] );
      $user_avatar = esc_url_raw( $_POST['user_avatar'] );
      
      $user_ip = $this -> getUserIpAddr();
      $user_location = wpb_child_get_location_from_ip($user_ip);

      $result = $this->edit_user( 
        $email, 
        $first_name, 
        $last_name, 
        $display_name,
        $user_phone, 
        $user_area, 
        $user_institution, 
        $user_avatar,
        $user_ip,
        $user_location['region'] . ", " . $user_location['city']
      );

      if ( is_wp_error( $result ) ) {
        // Parse errors into a string and append as parameter to redirect
        $errors = join( ',', $result->get_error_codes() );
        $redirect_url = add_query_arg( 'edit-errors', $errors, $redirect_url );
      } else {
        // Success, redirect to login page.
        $redirect_url = home_url( '/learning-home/' );
      }

      wp_redirect( $redirect_url );
      exit;
    }
  }

  /**
   * A shortcode for rendering the new user registration form.
   *
   * @param  array   $attributes  Shortcode attributes.
   * @param  string  $content     The text content for shortcode. Not used.
   *
   * @return string  The shortcode output
   */
  public function build_register_form( $attributes, $content = null ) {
    // Parse shortcode attributes
    $default_attributes = array( 'show_title' => false );
    $attributes = shortcode_atts( $default_attributes, $attributes );

    // Retrieve possible errors from request parameters
    $attributes['errors'] = array();
    if ( isset( $_REQUEST['register-errors'] ) ) {
      $error_codes = explode( ',', $_REQUEST['register-errors'] );
    
      foreach ( $error_codes as $error_code ) {
        $attributes['errors'] []= $this->get_error_message( $error_code );
      }
    }

    // Retrieve recaptcha key
    // $attributes['recaptcha_site_key'] = get_option( 'cuf-recaptcha-site-key', null );

    if ( is_user_logged_in() ) {
      $html = '<div class="logged-in description">' . __( 'You are already signed in.', 'user-flow' ) . '</div>';
      return $html;
    } elseif ( ! get_option( 'users_can_register' ) ) {
      $html = '<div class="registering-disabled description">' . __( 'Registering new users is currently not allowed.', 'user-flow' ) . '</div>';
      return $html ;
    } else {
        return $this->get_template_html( 'register_form', $attributes );
    }
  }

  /**
   * Redirects the user to the custom registration page instead
   * of wp-login.php?action=register.
   */
  public function redirect_to_custom_register() {
    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
        if ( is_user_logged_in() ) {
            $this -> redirect_logged_in_user();
        } else {
            
            wp_redirect( home_url( $this -> get_register_url() ) );
        }
        exit;
    }
  }

  /**
   * Validates and then completes the new user signup process if all went well.
   *
   * @param string $email         The new user's email address
   * @param string $first_name    The new user's first name
   * @param string $last_name     The new user's last name
   *
   * @return int|WP_Error         The id of the user that was created, or error if failed.
   */
  private function register_user( $email, $first_name, $last_name, $user_phone, $user_area, $user_institution, $user_avatar, $user_ip, $user_location ) {
    $errors = new WP_Error();

    // Email address is used as both username and email. It is also the only
    // parameter we need to validate
    if ( ! is_email( $email ) ) {
      $errors->add( 'email', $this->get_error_message( 'email' ) );
      return $errors;
    }

    if ( username_exists( $email ) || email_exists( $email ) ) {
      $errors->add( 'email_exists', $this->get_error_message( 'email_exists') );
      return $errors;
    }

    // Generate the password so that the subscriber will have to check email...
    $password = wp_generate_password( 12, false );

    $user_data = array(
      'user_login'    => $email,
      'user_email'    => $email,
      'user_pass'     => $password,
      'first_name'    => $first_name,
      'last_name'     => $last_name,
      'nickname'      => $first_name,
    );

    $user_id = wp_insert_user( $user_data );
    wp_new_user_notification( $user_id, $password );

    update_user_meta( $user_id, 'user_phone', $user_phone );
    update_user_meta( $user_id, 'user_area', $user_area );
    update_user_meta( $user_id, 'user_institution', $user_institution );
    update_user_meta( $user_id, 'user_avatar', $user_avatar );
    update_user_meta( $user_id, 'user_ip', $user_ip );
    update_user_meta( $user_id, 'user_location', $user_location );

    return $user_id;
  }

  private function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

  /**
   * Handles the registration of a new user.
   *
   * Used through the action hook "login_form_register" activated on wp-login.php
   * when accessed through the registration action.
   */
  public function do_register_user() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
      $redirect_url = home_url( $this->get_register_url() );

      if ( ! get_option( 'users_can_register' ) ) {
        // Registration closed, display error
        $redirect_url = add_query_arg( 'register-errors', 'closed', $redirect_url );
        // } elseif ( ! $this->verify_recaptcha() ) {
        //   // Recaptcha check failed, display error
        //   $redirect_url = add_query_arg( 'register-errors', 'captcha', $redirect_url );
      } else {
        $email = $_POST['email'];
        $first_name = sanitize_text_field( $_POST['first_name'] );
        $last_name = sanitize_text_field( $_POST['last_name'] );
        $user_phone = sanitize_text_field( $_POST['user_phone'] );
        $user_area = sanitize_text_field( $_POST['user_area'] );
        $user_institution = sanitize_text_field( $_POST['user_institution'] );
        $user_avatar = esc_url_raw( $_POST['user_avatar'] );
        
        $user_ip = $this -> getUserIpAddr();
        $user_location = wpb_child_get_location_from_ip($user_ip);

        $result = $this->register_user( 
          $email, 
          $first_name, 
          $last_name, 
          $user_phone, 
          $user_area, 
          $user_institution, 
          $user_avatar,
          $user_ip,
          $user_location['region'] . ", " . $user_location['city']
        );

        if ( is_wp_error( $result ) ) {
          // Parse errors into a string and append as parameter to redirect
          $errors = join( ',', $result->get_error_codes() );
          $redirect_url = add_query_arg( 'register-errors', $errors, $redirect_url );
        } else {
          // Success, redirect to login page.
          
          $redirect_url = home_url( $this->get_login_url() );
          $redirect_url = add_query_arg( 'registered', $email, $redirect_url );
        }
      }

      wp_redirect( $redirect_url );
      exit;
    }
  }

  function show_custom_user_fields( $user ) {
    $args = array(
      'user_phone' => get_user_meta( $user -> ID, 'user_phone', true),
      'user_area' => get_user_meta( $user -> ID, 'user_area', true),
      'user_institution' => get_user_meta( $user -> ID, 'user_institution', true),
      'user_avatar' => get_user_meta( $user -> ID, 'user_avatar', true),
      'user_ip' => get_user_meta( $user -> ID, 'user_ip', true),
      'user_location' => get_user_meta( $user -> ID, 'user_location', true),
    );
  
    $attributes['fields'] = $args;
  
    echo $this->get_template_html( 'custom_user_fields', $attributes );
  }
  
  function update_custom_user_fields( $user_id ) {
    $user_phone = sanitize_text_field( $_POST['user_phone'] );
    $user_area = sanitize_text_field( $_POST['user_area'] );
    $user_institution = sanitize_text_field( $_POST['user_institution'] );
    $user_avatar = esc_url_raw( $_POST['user_avatar'] );

    update_user_meta( $user_id, 'user_phone', isset($_POST['user_phone']) ? $user_phone : '' );
    update_user_meta( $user_id, 'user_area', isset($_POST['user_area']) ? $user_area : '' );
    update_user_meta( $user_id, 'user_institution', isset($_POST['user_institution'] ) ? $user_institution : '' );
    update_user_meta( $user_id, 'user_avatar', isset($_POST['user_avatar'] ) ? $user_avatar : '' );
  }
  
  /**
   * Registers the settings fields needed by the plugin.
   */
  public function register_settings_fields() {
    // Create settings fields for the two keys used by reCAPTCHA
    register_setting( 'general', 'cuf-recaptcha-site-key' );
    register_setting( 'general', 'cuf-recaptcha-secret-key' );

    add_settings_field(
      'cuf-recaptcha-site-key',
      '<label for="cuf-recaptcha-site-key">' . __( 'reCAPTCHA site key' , 'user-flow' ) . '</label>',
      array( $this, 'render_recaptcha_site_key_field' ),
      'general'
    );

    add_settings_field(
      'cuf-recaptcha-secret-key',
      '<label for="cuf-recaptcha-secret-key">' . __( 'reCAPTCHA secret key' , 'user-flow' ) . '</label>',
      array( $this, 'render_recaptcha_secret_key_field' ),
      'general'
    );
  }

  public function render_recaptcha_site_key_field() {
    $value = get_option( 'cuf-recaptcha-site-key', '' );
    echo '<input type="text" id="cuf-recaptcha-site-key" name="cuf-recaptcha-site-key" value="' . esc_attr( $value ) . '" />';
  }

  public function render_recaptcha_secret_key_field() {
    $value = get_option( 'cuf-recaptcha-secret-key', '' );
    echo '<input type="text" id="cuf-recaptcha-secret-key" name="cuf-recaptcha-secret-key" value="' . esc_attr( $value ) . '" />';
  }

  /**
   * An action function used to include the reCAPTCHA JavaScript file
   * at the end of the page.
   */
  public function add_captcha_js_to_footer() {
    echo "<script src='https://www.google.com/recaptcha/api.js'></script>";
  }

  /**
   * Checks that the reCAPTCHA parameter sent with the registration
   * request is valid.
   *
   * @return bool True if the CAPTCHA is OK, otherwise false.
   */
  private function verify_recaptcha() {
    // This field is set by the recaptcha widget if check is successful
    if ( isset ( $_POST['g-recaptcha-response'] ) ) {
        $captcha_response = $_POST['g-recaptcha-response'];
    } else {
        return false;
    }

    // Verify the captcha response from Google
    $response = wp_remote_post(
        'https://www.google.com/recaptcha/api/siteverify',
        array(
            'body' => array(
                'secret' => get_option( 'cuf-recaptcha-secret-key' ),
                'response' => $captcha_response
            )
        )
    );

    $success = false;
    if ( $response && is_array( $response ) ) {
        $decoded_response = json_decode( $response['body'] );
        $success = $decoded_response->success;
    }

    return $success;
  }

  /**
   * Redirects the user to the custom "Forgot your password?" page instead of
   * wp-login.php?action=lostpassword.
   */
  public function redirect_to_custom_password_reset() {
    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
      if ( is_user_logged_in() ) {
        $this -> redirect_logged_in_user();
        exit;
      }

      wp_redirect( home_url( $this -> get_password_reset_url_with_referer() ) );
      exit;
    }
  }

  /**
   * A shortcode for rendering the form used to initiate the password reset.
   *
   * @param  array   $attributes  Shortcode attributes.
   * @param  string  $content     The text content for shortcode. Not used.
   *
   * @return string  The shortcode output
   */
  public function build_password_reset_form( $attributes, $content = null ) {
    // Parse shortcode attributes
    $default_attributes = array( 'show_title' => false );
    $attributes = shortcode_atts( $default_attributes, $attributes );

    // Retrieve possible errors from request parameters
    $attributes['errors'] = array();
    if ( isset( $_REQUEST['errors'] ) ) {
      $error_codes = explode( ',', $_REQUEST['errors'] );
  
      foreach ( $error_codes as $error_code ) {
        $attributes['errors'] []= $this->get_error_message( $error_code );
      }
    }

    if ( is_user_logged_in() ) {
      $html = '<div class="logged-in description">' . __( 'You are already signed in.', 'user-flow' ) . '</div>';
      return $html;
    } else {
      return $this->get_template_html( 'password_reset_form', $attributes );
    }
  }
  
  /**
   * Initiates password reset.
   */
  public function do_password_reset() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
      $errors = retrieve_password();
      if ( is_wp_error( $errors ) ) {
        // Errors found
        $redirect_url = home_url( $this -> get_password_reset_url() );
        $redirect_url = add_query_arg( 'errors', join( ',', $errors->get_error_codes() ), $redirect_url );
      } else {
        // Email sent
        $login_url = home_url( $this -> get_login_url() );
        $redirect_url = add_query_arg( 'checkemail', 'confirm', $login_url );
      }

      wp_redirect( $redirect_url );
      exit;
    }
  }

  /**
   * Returns the message body for the password reset mail.
   * Called through the retrieve_password_message filter.
   *
   * @param string  $message    Default mail message.
   * @param string  $key        The activation key.
   * @param string  $user_login The username for the user.
   * @param WP_User $user_data  WP_User object.
   *
   * @return string   The mail message to send.
   */
  public function replace_retrieve_password_message( $message, $key, $user_login, $user_data ) {
    // Create new message
    $msg  = __( 'Hello!', 'user-flow' ) . "\r\n\r\n";
    $msg .= sprintf( __( 'You asked us to reset your password for your account using the email address %s.', 'user-flow' ), $user_login ) . "\r\n\r\n";
    $msg .= __( "If this was a mistake, or you didn't ask for a password reset, just ignore this email and nothing will happen.", 'user-flow' ) . "\r\n\r\n";
    $msg .= __( 'To reset your password, visit the following address:', 'user-flow' ) . "\r\n\r\n";
    $msg .= site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . "\r\n\r\n";
    $msg .= __( 'Thanks!', 'user-flow' ) . "\r\n";

    return $msg;
  }

  /**
   * Redirects to the custom password reset page, or the login page
   * if there are errors.
   */
  public function redirect_to_custom_password_change() {
    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
      // Verify key / login combo
      $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );
      if ( ! $user || is_wp_error( $user ) ) {
        if ( $user && $user->get_error_code() === 'expired_key' ) {
          wp_redirect( home_url( $this->get_login_url() . '?login=expiredkey' ) );
        } else {
          wp_redirect( home_url( $this->get_login_url() . '?login=invalidkey' ) );
        }
        exit;
      }

      $redirect_url = home_url( $this -> get_password_change_url() );
      $redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
      $redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );
      
      wp_redirect( $redirect_url );
      exit;
    }
  }

  /**
   * A shortcode for rendering the form used to reset a user's password.
   *
   * @param  array   $attributes  Shortcode attributes.
   * @param  string  $content     The text content for shortcode. Not used.
   *
   * @return string  The shortcode output
   */
  public function build_password_change_form( $attributes, $content = null ) {
    // Parse shortcode attributes
    $default_attributes = array( 'show_title' => false );
    $attributes = shortcode_atts( $default_attributes, $attributes );

    if ( is_user_logged_in() ) {
      $html = '<div class="logged-in description">' . __( 'You are already signed in.', 'user-flow' ) . '</div>';
      return $html;
    } else {
      if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) {
        $attributes['login'] = $_REQUEST['login'];
        $attributes['key'] = $_REQUEST['key'];

        // Error messages
        $errors = array();
        if ( isset( $_REQUEST['error'] ) ) {
          $error_codes = explode( ',', $_REQUEST['error'] );

          foreach ( $error_codes as $code ) {
            $errors []= $this->get_error_message( $code );
          }
        }
        $attributes['errors'] = $errors;

        return $this->get_template_html( 'password_change_form', $attributes );
      } else {
        $html = '<div class="invalid-link description">' . __( 'Invalid password reset link.', 'user-flow' ) . '</div>';
        return $html;
      }
    }
  }

  /**
   * Resets the user's password if the password reset form was submitted.
   */
  public function do_password_change() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
      $rp_key = $_REQUEST['rp_key'];
      $rp_login = $_REQUEST['rp_login'];

      $user = check_password_reset_key( $rp_key, $rp_login );

      if ( ! $user || is_wp_error( $user ) ) {
        if ( $user && $user->get_error_code() === 'expired_key' ) {
          wp_redirect( home_url( $this->get_login_url() . '?login=expiredkey' ) );
        } else {
          wp_redirect( home_url( $this->get_login_url() . '?login=invalidkey' ) );
        }
        exit;
      }

      if ( isset( $_POST['pass1'] ) ) {
        if ( $_POST['pass1'] != $_POST['pass2'] ) {
          // Passwords don't match
          
          $redirect_url = home_url( $this->get_password_change_url() );

          $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
          $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
          $redirect_url = add_query_arg( 'error', 'password_reset_mismatch', $redirect_url );

          wp_redirect( $redirect_url );
          exit;
        }

        if ( empty( $_POST['pass1'] ) ) {
          // Password is empty
          $redirect_url = home_url( $this->get_password_change_url() );

          $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
          $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
          $redirect_url = add_query_arg( 'error', 'password_reset_empty', $redirect_url );

          wp_redirect( $redirect_url );
          exit;
        }

        // Parameter checks OK, reset password
        reset_password( $user, $_POST['pass1'] );
        wp_redirect( home_url( $this->get_login_url() . '?password=changed' ) );
      } else {
          echo "Invalid request.";
      }

      exit;
    }
  }

  public function build_update_user_form($attributes, $content = null) {
    // Parse shortcode attributes
    $default_attributes = array( 'show_title' => false );
    $attributes = shortcode_atts( $default_attributes, $attributes );

    if ( !is_user_logged_in() ) {
      return __( 'You are not signed in.', 'user-flow' );
    } else {
      // Retrieve possible errors from request parameters
      $attributes['errors'] = array();
      if ( isset( $_REQUEST['update-user-errors'] ) ) {
        $error_codes = explode( ',', $_REQUEST['update-user-errors'] );
      
        foreach ( $error_codes as $error_code ) {
          $attributes['errors'] []= $this->get_error_message( $error_code );
        }
      }

      // Check if the user was updated
      $attributes['updated'] = isset( $_REQUEST['updated'] );

      // Current values
      //$attributes['current-values'] = wp_get_current_user();
      $data = array();
      $user = wp_get_current_user();
      $user_id = $user -> ID;
      $data['email'] = $user -> data -> user_email;
      
      $meta = get_user_meta( $user_id );
      //error_log(print_r($meta,1));
      $data['first_name'] = $meta['first_name'][0];
      $data['last_name'] = $meta['last_name'][0];
      $data['user_phone'] = $meta['user_phone'][0];
      $data['user_area'] = $meta['user_area'][0];
      $data['user_institution'] = $meta['user_institution'][0];
      $data['user_avatar'] = $meta['user_avatar'][0];
      $attributes['data'] = $data;

      if ( !is_user_logged_in() ) {
          return __( 'You are not signed in.', 'user-flow' );
      } else {
          return $this->get_template_html( 'update_user_form', $attributes );
      }
    }
  }

  /**
   * Validates and then completes the user update process if all went well.
   *
   * @param string $fields        array with the user fields
   *
   * @return int|WP_Error         The id of the user that was created, or error if failed.
   */
  private function update_user( $fields ) {
    $email = $fields['email'];
    $first_name = $fields['first_name'];
    $last_name = $fields['last_name'];
    $user_phone = $fields['user_phone'];
    $user_area = $fields['user_area'];
    $user_institution = $fields['user_institution'];
    $user_avatar = $fields['user_avatar'];
    $user_ip = $fields['user_ip'];
    $user_location = $fields['user_location'];

    $errors = new WP_Error();

    if ( !username_exists( $email ) || !email_exists( $email ) ) {
      $errors->add( 'invalid_username', $this->get_error_message( 'invalid_username') );
      return $errors;
    }

    $user_id = get_current_user_id();

    //add first and last name
    update_user_meta( $user_id, 'first_name', $first_name );
    update_user_meta( $user_id, 'last_name', $last_name );
    update_user_meta( $user_id, 'user_phone', $user_phone );
    update_user_meta( $user_id, 'user_area', $user_area );
    update_user_meta( $user_id, 'user_institution', $user_institution );
    update_user_meta( $user_id, 'user_avatar', $user_avatar );
    update_user_meta( $user_id, 'user_ip', $user_ip );
    update_user_meta( $user_id, 'user_location', $user_location );

    return $user_id;
  }

  /**
   * Handles the update of a user.
   *
   * Used through a menu action activated on wp-login.php
   */
  public function do_update_user() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['action'] ) && strcasecmp($_POST['action'], 'cuf_update_user') == 0 ) {
      $redirect_url = home_url( $this->get_update_user_url() );

      $user = wp_get_current_user();
      $email = $user -> data -> user_email;
      error_log(print_r($email,1));

      $first_name = sanitize_text_field( $_POST['first_name'] );
      $last_name = sanitize_text_field( $_POST['last_name'] );
      $user_phone = sanitize_text_field( $_POST['user_phone'] );
      $user_area = sanitize_text_field( $_POST['user_area'] );
      $user_institution = sanitize_text_field( $_POST['user_institution'] );
      $user_avatar = esc_url_raw( $_POST['user_avatar'] );
      
      $user_ip = $this -> getUserIpAddr();
      $user_location = wpb_child_get_location_from_ip($user_ip);

      $result = $this->update_user( array(
        'email' => $email, 
        'first_name' => $first_name, 
        'last_name' => $last_name, 
        'user_phone' => $user_phone, 
        'user_area' => $user_area, 
        'user_institution' => $user_institution, 
        'user_avatar' => $user_avatar,
        'user_ip' => $user_ip,
        'user_location' => $user_location['region'] . ", " . $user_location['city']
      ));

      if ( is_wp_error( $result ) ) {
        // Parse errors into a string and append as parameter to redirect
        $errors = join( ',', $result->get_error_codes() );
        $redirect_url = add_query_arg( 'update-user-errors', $errors, $redirect_url );
      } else {
        // Success, redirect to update page.
        $redirect_url = home_url( $this->get_update_user_url() );
        $redirect_url = add_query_arg( 'updated', 'true', $redirect_url );
      }

      wp_redirect( $redirect_url );
      exit;
    }
  }

  /**
   * A shortcode for rendering the form used to reset a user's password.
   *
   * @param  array   $attributes  Shortcode attributes.
   * @param  string  $content     The text content for shortcode. Not used.
   *
   * @return string  The shortcode output
   */
  public function build_user_password_change_form( $attributes, $content = null ) {
    // Parse shortcode attributes
    $default_attributes = array( 'show_title' => false );
    $attributes = shortcode_atts( $default_attributes, $attributes );

    if ( !is_user_logged_in() ) {
      return __( 'You are not signed in.', 'user-flow' );
    } else {
      // Error messages
      $errors = array();
      if ( isset( $_REQUEST['error'] ) ) {
        $error_codes = explode( ',', $_REQUEST['error'] );

        foreach ( $error_codes as $code ) {
          $errors []= $this->get_error_message( $code );
        }
      }
      $attributes['errors'] = $errors;

      // Check if the user was updated
      $attributes['updated'] = isset( $_REQUEST['updated'] );

      return $this->get_template_html( 'user_password_change_form', $attributes );
    }
  }

  /**
   * Resets the user's password if the password reset form was submitted.
   */
  public function do_user_password_change() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['action'] ) && strcasecmp($_POST['action'], 'cuf_user_password_change') == 0 ) {

      if ( isset( $_POST['pass1'] ) && isset( $_POST['passc'] ) ) {
        $current_user = wp_get_current_user();
        $user_name = $current_user -> data -> user_login;
        $valid_login = wp_authenticate_username_password(null, $user_name, $_POST['passc']);
        if(is_wp_error( $valid_login )) {
          $redirect_url = home_url( $this->get_update_user_password_url() );          
          $redirect_url = add_query_arg( 'error', 'current_password_mismatch', $redirect_url );
          wp_redirect( $redirect_url );
          exit;
        }

        if ( $_POST['pass1'] != $_POST['pass2'] ) {
          // Passwords don't match
          $redirect_url = home_url( $this->get_update_user_password_url() );
          $redirect_url = add_query_arg( 'error', 'password_reset_mismatch', $redirect_url );
          wp_redirect( $redirect_url );
          exit;
        }

        if ( empty( $_POST['pass1'] ) ) {
          // Password is empty
          $redirect_url = home_url( $this->get_update_user_password_url() );
          $redirect_url = add_query_arg( 'error', 'password_reset_empty', $redirect_url );
          wp_redirect( $redirect_url );
          exit;
        }

        // Parameter checks OK, reset password
        reset_password( $current_user, $_POST['pass1'] );
        
        wp_redirect( home_url( 'login?password=changed' ) );
        exit;
      } else {
        echo "Invalid request.";
        exit;
      }
    }
  }

  public function get_login_url() {
    $en = substr_compare($_SERVER['REQUEST_URI'], '/en/', 0, strlen('/en/')) === 0;
    if(TRUE === $en) {
      // $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
      // $acceptLang = ['fr', 'it', 'en']; 
      // $lang = in_array($lang, $acceptLang) ? $lang : 'en';
      // require_once "index_{$lang}.php";
      return '/login';
    }
    else {
      return '/ingreso';
    }
  }

  public function get_register_url() {
    $en = substr_compare($_SERVER['REQUEST_URI'], '/en/', 0, strlen('/en/')) === 0;
    if(TRUE === $en) {
      return '/register';
    }
    else {
      return '/registro';
    }
  }

  public function get_password_reset_url () {
    $en = substr_compare($_SERVER['REQUEST_URI'], '/en/', 0, strlen('/en/')) === 0;
    if(TRUE === $en) {
      return '/password-reset';
    }
    else {
      return '/reinicio-contrasena';
    }
  }

  public function get_password_reset_url_with_referer () {
    $en = FALSE !== strpos($_SERVER['HTTP_REFERER'], '/en/');
    if(TRUE === $en) {
      return '/password-reset';
    }
    else {
      return '/reinicio-contrasena';
    }
  }

  public function get_password_change_url () {
    $en = substr_compare($_SERVER['REQUEST_URI'], '/en/', 0, strlen('/en/')) === 0;
    if(TRUE === $en) {
      return '/change-password';
    }
    else {
      return '/cambio-contrasena';
    }
  }

  public function get_update_user_url () {
    $en = substr_compare($_SERVER['REQUEST_URI'], '/en/', 0, strlen('/en/')) === 0;
    if(TRUE === $en) {
      return '/editar-usuario-en';
    }
    else {
      return '/editar-usuario';
    }
  }

  public function get_update_user_password_url () {
    $en = substr_compare($_SERVER['REQUEST_URI'], '/en/', 0, strlen('/en/')) === 0;
    if(TRUE === $en) {
      return '/password-change-user';
    }
    else {
      return '/cambio-contrasena-usuario';
    }
  }

}
 
// Initialize the plugin
$custom_user_flow = new CustomUserFlow();

// Create the custom pages at plugin activation
register_activation_hook( __FILE__, array( 'CustomUserFlow', 'plugin_activated' ) );