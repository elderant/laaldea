<div id="password-change-form" class="widecolumn">
  <?php if ( $attributes['show_title'] ) : ?>
      <h3><?php _e( 'Pick a New Password', 'user-flow' ); ?></h3>
  <?php endif; ?>

  <form name="changepassform" id="changepassform" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" autocomplete="off">
    <?php if ( $attributes['updated'] ) : ?>
      <div class="notice user-password-change-info">
        <p><?php
          printf(__( 'Your password was changed successfully.', 'user-flow' ) );
        ?></p>
      </div>
    <?php endif; ?>
    <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
      <div class="error password-change-error">
        <?php foreach ( $attributes['errors'] as $error ) : ?>
          <p><?php echo $error; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    
    <div class="form-row">
      <label for="passc" class="user-flow-label h5 hidden"><?php _e( 'Current password', 'user-flow' ) ?></label>
      <input placeholder="<?php echo mb_strtoupper(__( 'Current password', 'user-flow' ), "UTF-8"); ?>" type="password" name="passc" id="passc" class="input user-flow-input" size="20" value="" autocomplete="off" />
    </div>
    <div class="form-row">
      <label for="pass1" class="user-flow-label h5 hidden"><?php _e( 'New password', 'user-flow' ) ?></label>
      <input placeholder="<?php echo mb_strtoupper(__( 'New password', 'user-flow' ), "UTF-8"); ?>" type="password" name="pass1" id="pass1" class="input user-flow-input" size="20" value="" autocomplete="off" />
    </div>
    <div class="form-row">
      <label for="pass2" class="user-flow-label h5 hidden"><?php _e( 'Repeat new password', 'user-flow' ) ?></label>
      <input placeholder="<?php echo mb_strtoupper(__( 'Repeat new password', 'user-flow' ), "UTF-8"); ?>" type="password" name="pass2" id="pass2" class="input user-flow-input" size="20" value="" autocomplete="off" />
    </div>
    
    <div class="form-row description">
      <p><?php echo wp_get_password_hint(); ?></p>
    </div>

    <div class="form-action" style="display: none;">
      <input type="hidden" name="action" value="cuf_user_password_change">
    </div>
      
    <div class="form-row resetpass-submit-container text-center">
      <input 
        type="submit" 
        name="submit" 
        id="resetpass-button"
        class="button user-flow-button h5" 
        value="<?php _e( 'Reset Password', 'user-flow' ); ?>" />
    </div>
  </form>
</div>