<div id="password-lost-form" class="widecolumn">
  <?php if ( $attributes['show_title'] ) : ?>
    <h3><?php _e( 'Forgot Your Password?', 'user-flow' ); ?></h3>
  <?php endif; ?>

  <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
    <?php foreach ( $attributes['errors'] as $error ) : ?>
      <div class="error password-reset-error">
        <p><?php echo $error; ?></p>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <div class="description">
    <?php
      _e(
        "Enter your email address and we'll send you a link you can use to pick a new password.",
        'user-flow'
      );
    ?>
  </div>

  <form id="lostpasswordform" action="<?php echo 'https://laaldea.co/wp-login.php?action=lostpassword' ?>" method="post">
    <div class="form-row">
      <label for="user_login" class="user-flow-label h5"><?php _e( 'Email', 'user-flow' ); ?></label>
      <input type="text" name="user_login" id="user_login" class="input user-flow-input">
    </div>

    <div class="lostpassword-submit">
      <input 
        type="submit" 
        name="submit" 
        class="lostpassword-button button user-flow-button h5" 
        value="<?php _e( 'Reset Password', 'user-flow' ); ?>"/>
    </div>
  </form>
</div>