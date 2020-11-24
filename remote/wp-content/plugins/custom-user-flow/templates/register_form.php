<div id="register-form" class="widecolumn">
  <?php if ( $attributes['show_title'] ) : ?>
    <h3><?php _e( 'Register', 'user-flow' ); ?></h3>
  <?php endif; ?>

  <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
    <?php foreach ( $attributes['errors'] as $error ) : ?>
      <div class="error resgistration-error">
        <p><?php echo $error; ?></p>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <form id="signupform" action="<?php echo wp_registration_url(); ?>" method="post">
    <div class="form-row">
      <label for="email"><?php _e( 'Email', 'user-flow' ); ?> <strong>*</strong></label>
      <input type="text" name="email" id="email">
    </div>
    <div class="form-row">
      <label for="first_name"><?php _e( 'First name', 'user-flow' ); ?></label>
      <input type="text" name="first_name" id="first-name">
    </div>
    <div class="form-row">
      <label for="last_name"><?php _e( 'Last name', 'user-flow' ); ?></label>
      <input type="text" name="last_name" id="last-name">
    </div>
    <div class="form-row">
      <label for="user_phone"><?php _e( 'Phone', 'user-flow' ); ?></label>
      <input type="text" name="user_phone" id="user-phone">
    </div>
    <div class="form-row">
      <label for="user_area"><?php _e( 'Teaching Area', 'user-flow' ); ?></label>
      <input type="text" name="user_area" id="user-area">
    </div>
    <div class="form-row">
      <label for="user_institution"><?php _e( 'Teaching Institution', 'user-flow' ); ?></label>
      <input type="text" name="user_institution" id="user-institution">
    </div>
    <div class="form-row">
      <label><?php _e('Avatar', 'user-flow'); ?></label>
      <div class="radio-buttons">
        <div class="avatar1-container">
          <input type="radio" id="avatar1" name="user_avatar" value="/wp-content/uploads/user-avatar1.png">
          <label for="avatar1"><img src="/wp-content/uploads/user-avatar1.png" alt="<?php _e('Avatar 1 image','laaldea');?>"></label>
        </div>
        <div class="avatar2-container">
          <input type="radio" id="avatar2" name="user_avatar" value="/wp-content/uploads/user-avatar2.png">
          <label for="avatar2"><img src="/wp-content/uploads/user-avatar2.png" alt="<?php _e('Avatar 2 image','laaldea');?>"></label>
        </div>
        <div class="avatar3-container">
          <input type="radio" id="avatar3" name="user_avatar" value="/wp-content/uploads/user-avatar3.png">
          <label for="avatar3"><img src="/wp-content/uploads/user-avatar3.png" alt="<?php _e('Avatar 3 image','laaldea');?>"></label>
        </div>
        <div class="avatar4-container">
          <input type="radio" id="avatar4" name="user_avatar" value="/wp-content/uploads/user-avatar4.png">
          <label for="avatar4"><img src="/wp-content/uploads/user-avatar4.png" alt="<?php _e('Avatar 4 image','laaldea');?>"></label>
        </div>
      </div>
    </div>
    <div class="form-row">
      <?php _e( 'Note: Your password will be generated automatically and sent to your email address.', 'user-flow' ); ?>
    </div>
    <?php if ( $attributes['recaptcha_site_key'] ) : ?>
      <div class="recaptcha-container">
        <div class="g-recaptcha" data-sitekey="<?php echo $attributes['recaptcha_site_key']; ?>"></div>
      </div>
    <?php endif; ?>
    <div class="signup-submit">
      <input type="submit" 
        name="submit" 
        class="register-button" 
        value="<?php _e( 'Register', 'user-flow' ); ?>"/>
    </div>
  </form>
</div>