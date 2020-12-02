<?php

/**
 * Display global login
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
*/


if ( ! defined( 'ABSPATH' ) )
	exit;
?>

<div class="tutor-login-form-wrap">
	<?php do_action("tutor_before_login_form");?>

    <?php
    $current_url = tutils()->get_current_url();
    $register_page = '/register';
	$register_url = add_query_arg ('redirect_to', $current_url, $register_page);

	//redirect_to
    $args = array(
	    'echo'                      => true,
	    // Default 'redirect' value takes the user back to the request URI.
	    'redirect'                  => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
	    'form_id'                   => 'loginform',
	    'label_username'            => __( 'Email', 'user-flow' ),
	    'label_password'            => __( 'Password' ),
	    'label_remember'            => __( 'Remember Me' ),
	    'label_log_in'              => __( 'Ingresa', 'user-flow' ),
	    'label_create_new_account'  => __( 'Registrate', 'user-flow' ),
	    'id_username'               => 'user_login',
	    'id_password'               => 'user_pass',
	    'id_remember'               => 'rememberme',
	    'id_submit'                 => 'wp-submit',
	    'remember'                  => true,
	    'value_username'            => tutils()->input_old('log'),
	    // Set 'value_remember' to true to default the "Remember me" checkbox to checked.
	    'value_remember'            => false,
	    'wp_lostpassword_url'       => '/password-reset',
	    'wp_lostpassword_label'     => __( '¿Olvido su contraseña?', 'user-flow' ),
    );

    //action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '"

	tutor_alert(null, 'warning');

	ob_start();
	tutor_nonce_field();
	$nonce_field = ob_get_clean();
	?>

	<form name="<?= $args['form_id']?>" id="<?= $args['form_id']?>" method="post">

	<?php do_action("tutor_login_form_start");?>

	<?php echo $nonce_field;?>
	
	<input type="hidden" name="tutor_action" value="tutor_user_login" />
		<div class="login-username">
      <label class="user-flow-label" for="log">
        <?php echo esc_html( $args['label_username'] )?>
      </label>
			<input type="text" name="log" id="<?= esc_attr( $args['id_username'] )?>" class="input user-flow-input" value="<?= esc_attr( $args['value_username'] )?>" size="20" />
    </div>

		<div class="login-password">
      <label class="user-flow-label" for="pwd">
        <?php echo esc_html( $args['label_password'] )?>
      </label>
			<input type="password" name="" id="<?= esc_attr( $args['id_password'] )?>" class="input user-flow-input" value="" size="20"/>
    </div>
		
		<?php 
			do_action("tutor_login_form_middle");
			do_action("login_form");
			apply_filters("login_form_middle",'','');
    ?>
    
		<div class="tutor-login-rememeber-wrap">
			<?php  if($args['remember']):?>
			<div class="login-remember">
				<label>
					<input name="rememberme" type="checkbox" id="<?= esc_attr( $args['id_remember'] )?>" value="forever" 
					 <?php $args['value_remember'] ? 'checked' : '';?>
					>
					<?= esc_html($args['label_remember']);?>
				</label>
      </div>
			<?php endif;?>
		</div>
		
		<?php do_action("tutor_login_form_end");?>

		<div class="login-submit user-flow-button">
			<input type="submit" name="wp-submit" id="<?= esc_attr( $args['id_submit'] )?>" class="button button-primary user-flow-button" value="<?= esc_attr( $args['label_log_in'] )?>" />
			<input type="hidden" name="redirect_to" value="<?= esc_url( $args['redirect'] )?>" />
		</div>
		
		<div class="tutor-form-register-wrap">
      <a class="user-flow-link" href="<?php esc_url($args['wp_lostpassword_url'])?>">
        <?php echo esc_html($args['wp_lostpassword_label']);?>
      </a>
      <a class="user-flow-link" href="<?php esc_url($register_url)?>">
        <?php echo esc_html($args['label_create_new_account']);?>
      </a>
    </div>
	</form>

    <?php
    	//#@TODO: student_register_url() return false, it must be an valid url.
     	do_action("tutor_after_login_form");
    ?>
</div>
