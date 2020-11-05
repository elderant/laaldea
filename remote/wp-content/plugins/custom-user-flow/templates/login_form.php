<div class="login-form-container">
  <?php if ( $attributes['show_title'] ) : ?>
    <h2><?php _e( 'Sign In', 'user-flow' ); ?></h2>
  <?php endif; ?>
  
  <!-- Show errors if there are any -->
  <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
    <?php foreach ( $attributes['errors'] as $error ) : ?>
      <div class="error login-error">
        <p><?php echo $error; ?></p>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <!-- Show registration sucessful message if user registered -->
  <?php if ( $attributes['registered'] ) : ?>
    <div class="notice login-info">
      <p><?php
        printf(
          __( 'You have successfully registered to <strong>%s</strong>. We have emailed your password to the email address you entered.', 'user-flow' ),
          get_bloginfo( 'name' )
        );
      ?></p>
    </div>
  <?php endif; ?>

  <!-- Show logged out message if user just logged out -->
  <?php if ( $attributes['logged_out'] ) : ?>
    <div class="notice login-info">
      <p><?php _e( 'You have signed out. Would you like to sign in again?', 'user-flow' ); ?></p>
    </div>
  <?php endif; ?>

  <!-- Show password reset request message -->
  <?php if ( $attributes['password_reset_sent'] ) : ?>
    <div class="notice login-info">
      <p><?php _e( 'Check your email for a link to reset your password.', 'user-flow' ); ?></p>
    </div>
  <?php endif; ?>

  <!-- Show password update message -->
  <?php if ( $attributes['password_updated'] ) : ?>
    <div class="notice login-info">
      <p><?php _e( 'Your password has been changed. You can sign in now.', 'personalize-login' ); ?></p>
    </div>
  <?php endif; ?>

  <?php
    wp_login_form(
      array(
        'label_username' => __( 'Email', 'user-flow' ),
        'label_log_in' => __( 'Log In', 'user-flow' ),
        'redirect' => $attributes['redirect'],
      )
    );
  ?>
    
  <a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>">
    <?php _e( 'Forgot your password?', 'user-flow' ); ?>
  </a>
  <a class="forgot-password" href="../register">
    <?php _e( 'Sign In', 'user-flow' ); ?>
  </a>
</div>