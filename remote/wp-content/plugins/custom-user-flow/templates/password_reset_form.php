<div id="password-lost-form" class="widecolumn">
  <?php if ( $attributes['show_title'] ) : ?>
    <h3><?php _e( 'Forgot Your Password?', 'user-flow' ); ?></h3>
  <?php endif; ?>

  <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
    <?php foreach ( $attributes['errors'] as $error ) : ?>
      <div class="error password-reset-error">
        <?php echo $error; ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <div>
    <?php
      _e(
        "Enter your email address and we'll send you a link you can use to pick a new password.",
        'user-flow'
      );
    ?>
  </div>

  <form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
    <div class="form-row">
      <label for="user_login"><?php _e( 'Email', 'user-flow' ); ?>
      <input type="text" name="user_login" id="user_login">
    </div>

    <div class="lostpassword-submit">
      <input 
        type="submit" 
        name="submit" 
        class="lostpassword-button" 
        value="<?php _e( 'Reset Password', 'user-flow' ); ?>"/>
    </div>
  </form>
</div>