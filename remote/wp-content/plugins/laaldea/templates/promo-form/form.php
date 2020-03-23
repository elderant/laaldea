<div class="promo-form-section">
  <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" class="laaldea-form">
    <div class="first-name-container input-container full-width">
      <label for="first_name">
        <!-- <span class="asterisk">*</span> -->
        <?php _e('Nombre','laaldea'); ?>
      </label>
      <input type="text" name="promo_first_name" value="" id="promo-first-name" tabindex="10" />
      <?php if ( isset($error['promo_first_name'] ) ) : ?>
        <label id="promo-first-name-error-server" class="error" for="promo_first_name">
          <?php echo $error['promo_first_name'];?>
        </label>
      <?php endif;?>
    </div>
    <div class="last-name-container input-container full-width">
      <label for="last_name">
        <!-- <span class="asterisk">*</span> -->
        <?php _e('Apellido','nco'); ?>
      </label>
      <input type="text" name="promo_last_name" value="" id="promo-last-name" tabindex="20" />
      <?php if ( isset($error['promo_last_name'] ) ) : ?>
        <label id="promo-last-name-error-server" class="error" for="promo_last_name">
          <?php echo $error['promo_last_name'];?>
        </label>
      <?php endif;?>
    </div>
    <div class="email-container input-container full-width">
      <label for="email">
        <!-- <span class="asterisk">*</span> -->
        <?php _e('Email', 'nco'); ?>
      </label>
      <input type="email" name="promo_email" value="" id="promo-email" tabindex="30" />
      <?php if ( isset($error['promo_email'] ) ) : ?>
        <label id="promo-email-error-server" class="error" for="promo_email">
          <?php echo $error['promo_email'];?>
        </label>
      <?php endif;?>
    </div>
    <div style="display: none;">
      <input type="hidden" name="action" value="laaldea_promo">
    </div>
    <div class="form-actions">
      <input type="submit" name="wp-submit" value="<?php _e('Enviar'); ?>" class="promo-submit" tabindex="100" />
    </div>
  </form>
</div>

