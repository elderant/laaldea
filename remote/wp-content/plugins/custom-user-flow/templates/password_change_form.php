<div id="password-change-form" class="widecolumn">
  <?php if ( $attributes['show_title'] ) : ?>
      <h3><?php _e( 'Pick a New Password', 'user-flow' ); ?></h3>
  <?php endif; ?>

  <form name="changepassform" id="changepassform" action="<?php echo site_url( 'wp-login.php?action=resetpass' ); ?>" method="post" autocomplete="off">
    <input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( $attributes['login'] ); ?>" autocomplete="off" />
    <input type="hidden" name="rp_key" value="<?php echo esc_attr( $attributes['key'] ); ?>" />
      
    <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
      <?php foreach ( $attributes['errors'] as $error ) : ?>
        <div class="error password-change-error">
          <p><?php echo $error; ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <div class="form-row">
      <label for="pass1" class="user-flow-label"><?php _e( 'New password', 'user-flow' ) ?></label>
      <input type="password" name="pass1" id="pass1" class="input user-flow-input" size="20" value="" autocomplete="off" />
    </div>
    <div class="form-row">
      <label for="pass2" class="user-flow-label"><?php _e( 'Repeat new password', 'user-flow' ) ?></label>
      <input type="password" name="pass2" id="pass2" class="input user-flow-input" size="20" value="" autocomplete="off" />
    </div>
      
    <div class="description"><p><?php echo wp_get_password_hint(); ?></p></div>
      
    <div class="resetpass-submit">
      <input 
        type="submit" 
        name="submit" 
        id="resetpass-button"
        class="button user-flow-button" 
        value="<?php _e( 'Reset Password', 'user-flow' ); ?>" />
    </div>
  </form>
</div>