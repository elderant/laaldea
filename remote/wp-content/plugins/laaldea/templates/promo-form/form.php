<?php $error = get_transient( 'laaldea_activation_error' ); ?>
<div id="covid">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="area-title"><h3 class="title-tag"><?php _e('Especial COVID-19' , 'laalde'); ?></h3></div>
      </div>
    </div>
    <div class="row subtitle-row">
      <div class="col-xl-8 offset-lg-2 col-md-10 offset-md-1 col-xs-12">
        <h4><?php _e('¡Es muy importante para nosotros saber quién aprovechará este material pedagógico! Te pediremos algunos datos:', 'laaldea'); ?></h4>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-8 offset-xl-2 col-md-10 offset-md-1 col-xs-12">
        <div class="covid-form-section">
          <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" class="laaldea-form">
            <div class="name-container input-container half-width">
              <input type="text" name="form_name" value="" id="form-name" tabindex="10" placeholder="<?php _e('Nombre', 'laaldea');?>" />
              <?php if ( isset($error['form_name'] ) ) : ?>
                <label id="form-name-error-server" class="error" for="form_name">
                  <?php echo $error['form_name'];?>
                </label>
              <?php endif;?>
            </div>
            <div class="organization-container input-container half-width">
              <input type="text" name="form_organization" value="" id="form-organization-name" tabindex="20" placeholder="<?php _e('Organización', 'laaldea'); ?>"/>
              <?php if ( isset($error['form_organization'] ) ) : ?>
                <label id="promo-last-name-error-server" class="error" for="form_organization">
                  <?php echo $error['form_organization'];?>
                </label>
              <?php endif;?>
            </div>
            <div class="location-container input-container half-width">
              <input type="text" name="form_location" value="" id="form'location-name" tabindex="30" placeholder="<?php _e('¿En qué parte del mundo estás?', 'laaldea'); ?>"/>
              <?php if ( isset($error['form_location'] ) ) : ?>
                <label id="promo-organization-error-server" class="error" for="form_location">
                  <?php echo $error['form_location'];?>
                </label>
              <?php endif;?>
            </div>
            <div class="email-container input-container full-width">
              <input type="email" name="form_email" value="" id="form-email" tabindex="40" placeholder="<?php _e('Email', 'laaldea'); ?>"/>
              <?php if ( isset($error['form_email'] ) ) : ?>
                <label id="promo-email-error-server" class="error" for="form_email">
                  <?php echo $error['form_email'];?>
                </label>
              <?php endif;?>
            </div>
            <div class="use-container input-container full-width">
              <label for="form_use">
                <?php _e('¿Cómo vas a usar este material?', 'laaldea'); ?>
              </label>
              <textarea name="form_use" value="" id="form-use" tabindex="50" placeholder="<?php _e('Ej: Lo voy a usar con mis hijos en homeschooling...', 'laaldea')?>"></textarea>
              <?php if ( isset($error['form_use'] ) ) : ?>
                <label id="promo-use-error-server" class="error" for="form_use">
                  <?php echo $error['form_use'];?>
                </label>
              <?php endif;?>
            </div>
            <div style="display: none;">
              <input type="hidden" name="action" value="laaldea_promo">
            </div>
            <div class="form-actions">
              <input type="submit" name="wp-submit" value="<?php _e('Descarga Aquí', 'laaldea'); ?>" class="promo-submit" tabindex="100" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>