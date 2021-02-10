<?php 
  $args = $wpb_args['args'];
  $login_form_top = $wpb_args['login_form_top'];
  $login_form_middle = $wpb_args['login_form_middle'];
  $login_form_bottom = $wpb_args['login_form_bottom'];
?>
<form name="<?php echo $args['form_id']?>" id="<?php echo $args['form_id']?>" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) )?>" method="post">
    <?php echo $login_form_top;?>
    <div class="form-row login-username">
      <label for="<?php echo esc_attr( $args['id_username'] )?>" class="user-flow-label h5 hidden"><?php echo esc_html( $args['label_username'] )?></label>
      <input placeholder="<?php echo esc_html( $args['label_username'] )?>"type="text" name="log" id="<?php echo esc_attr( $args['id_username'] )?>" class="input user-flow-input" value="<?php echo esc_attr( $args['value_username'] )?>" size="20"/>
    </div>
    <div class="form-row login-password">
      <label for="<?php echo esc_attr( $args['id_password'] )?>" class="user-flow-label h5 hidden"><?php echo esc_html( $args['label_password'] )?></label>
      <input placeholder="<?php echo esc_html( $args['label_password'] )?>" type="password" name="pwd" id="<?php echo esc_attr( $args['id_password'] )?>" class="input user-flow-input" value="" size="20"/>
    </div>
    <?php echo $login_form_middle;?>
    <?php if($args['remember']) : ?>
      <div class="form-row login-remember">
        <label class="user-flow-label h5">
          <input name="rememberme" type="checkbox" id="<?php echo esc_attr( $args['id_remember'] )?>" value="forever"<?php ( $args['value_remember'] ? ' checked="checked"' : '' )?>/>
          <span><?php echo esc_html( $args['label_remember'] )?></span>
        </label>
      </div>
    <?php endif; ?>
    <div class="form-row login-submit">
      <input type="submit" name="wp-submit" id="<?php echo esc_attr( $args['id_submit'] )?>" class="button button-primary user-flow-button h5" value="<?php echo esc_attr( $args['label_log_in'] )?>" />
      <input type="hidden" name="redirect_to" value="<?php echo esc_url( $args['redirect'] )?>"/>
    </div>
    <?php echo $login_form_bottom;?>
</form>