<?php
  switch ( $user_avatar ) {
    case '/wp-content/uploads/user-avatar-arnold.png':
      $current_avatar = 1;
      break;
    case '/wp-content/uploads/user-avatar-lucy.png':
      $current_avatar = 2;
      break;
    case '/wp-content/uploads/user-avatar-harry.png':
      $current_avatar = 3;
      break;
    case '/wp-content/uploads/user-avatar-ernest.png':
      $current_avatar = 4;
      break;
    case '/wp-content/uploads/user-avatar-macaw.png':
      $current_avatar = 5;
      break;
    case '/wp-content/uploads/user-avatar-carol.png':
      $current_avatar = 6;
      break;
    case '/wp-content/uploads/user-avatar-peter.png':
      $current_avatar = 7;
      break;
    case '/wp-content/uploads/user-avatar-crab.png':
      $current_avatar = 8;
      break;
    case '/wp-content/uploads/user-avatar-mouse.png':
      $current_avatar = 9;
      break;
    case '/wp-content/uploads/user-avatar-moorhen.png':
      $current_avatar = 10;
      break;
    case '/wp-content/uploads/user-avatar-owl.png':
      $current_avatar = 11;
      break;
    default:
      $current_avatar = 0;
      break;
  }

  $user_avatars = array(
    'arnulfo' => array (
      'container-class' => 'avatar-container arnulfo',
      'input-id' => 'avatar-arnulfo',
      'input-value' => '/wp-content/uploads/user-avatar-arnold.png',
      'avatar_index' => 1,
      'label-img' => '/wp-content/uploads/user-avatar-arnold.png',
      'label-alt' => __('Imagen avatar Arnulfo','user-flow'),
      'avatar_checked' => $current_avatar == 1?'selected':'',
    ),
    'lucy' => array (
      'container-class' => 'avatar-container lucy',
      'input-id' => 'avatar-lucy',
      'input-value' => '/wp-content/uploads/user-avatar-lucy.png',
      'avatar_index' => 2,
      'label-img' => '/wp-content/uploads/user-avatar-lucy.png',
      'label-alt' => __('Imagen avatar Lorena','user-flow'),
      'avatar_checked' => $current_avatar == 2?'selected':'',
    ),
    'enrique' => array (
      'container-class' => 'avatar-container harry',
      'input-id' => 'avatar-harry',
      'input-value' => '/wp-content/uploads/user-avatar-harry.png',
      'avatar_index' => 3,
      'label-img' => '/wp-content/uploads/user-avatar-harry.png',
      'label-alt' => __('Imagen avatar Enrique','user-flow'),
      'avatar_checked' => $current_avatar == 3?'selected':'',
    ),
    'efren' => array (
      'container-class' => 'avatar-container ernest',
      'input-id' => 'avatar-ernest',
      'input-value' => '/wp-content/uploads/user-avatar-ernest.png',
      'avatar_index' => 4,
      'label-img' => '/wp-content/uploads/user-avatar-ernest.png',
      'label-alt' => __('Imagen avatar Efrén','user-flow'),
      'avatar_checked' => $current_avatar == 4?'selected':'',
    ),
    'macaw' => array (
      'container-class' => 'avatar-container macaw',
      'input-id' => 'avatar-macaw',
      'input-value' => '/wp-content/uploads/user-avatar-macaw.png',
      'avatar_index' => 5,
      'label-img' => '/wp-content/uploads/user-avatar-macaw.png',
      'label-alt' => __('Imagen avatar guacamaya','user-flow'),
      'avatar_checked' => $current_avatar == 5?'selected':'',
    ),
    'carmen' => array (
      'container-class' => 'avatar-container carol',
      'input-id' => 'avatar-carol',
      'input-value' => '/wp-content/uploads/user-avatar-carol.png',
      'avatar_index' => 6,
      'label-img' => '/wp-content/uploads/user-avatar-carol.png',
      'label-alt' => __('Imagen avatar Carmen','user-flow'),
      'avatar_checked' => $current_avatar == 6?'selected':'',
    ),
    'paco' => array (
      'container-class' => 'avatar-container peter',
      'input-id' => 'avatar-peter',
      'input-value' => '/wp-content/uploads/user-avatar-peter.png',
      'avatar_index' => 7,
      'label-img' => '/wp-content/uploads/user-avatar-peter.png',
      'label-alt' => __('Imagen avatar Paco','user-flow'),
      'avatar_checked' => $current_avatar == 7?'selected':'',
    ),
    'crab' => array (
      'container-class' => 'avatar-container crab',
      'input-id' => 'avatar-crab',
      'input-value' => '/wp-content/uploads/user-avatar-crab.png',
      'avatar_index' => 8,
      'label-img' => '/wp-content/uploads/user-avatar-crab.png',
      'label-alt' => __('Imagen avatar cangrejo','user-flow'),
      'avatar_checked' => $current_avatar == 8?'selected':'',
    ),
    'mouse' => array (
      'container-class' => 'avatar-container mouse',
      'input-id' => 'avatar-mouse',
      'input-value' => '/wp-content/uploads/user-avatar-mouse.png',
      'avatar_index' => 9,
      'label-img' => '/wp-content/uploads/user-avatar-mouse.png',
      'label-alt' => __('Imagen avatar raton','user-flow'),
      'avatar_checked' => $current_avatar == 9?'selected':'',
    ),
    'gallineta' => array (
      'container-class' => 'avatar-container moorhen',
      'input-id' => 'avatar-moorhen',
      'input-value' => '/wp-content/uploads/user-avatar-moorhen.png',
      'avatar_index' => 10,
      'label-img' => '/wp-content/uploads/user-avatar-moorhen.png',
      'label-alt' => __('Imagen avatar gallineta','user-flow'),
      'avatar_checked' => $current_avatar == 10?'selected':'',
    ),
    'owl' => array (
      'container-class' => 'avatar-container owl',
      'input-id' => 'avatar-owl',
      'input-value' => '/wp-content/uploads/user-avatar-owl.png',
      'avatar_index' => 11,
      'label-img' => '/wp-content/uploads/user-avatar-owl.png',
      'label-alt' => __('Imagen avatar búho','user-flow'),
      'avatar_checked' => $current_avatar == 11?'selected':'',
    ),
  );
?>

<div id="update-user-container" class="widecolumn">
  <?php if ( $attributes['show_title'] ) : ?>
    <h3><?php _e( 'Register', 'user-flow' ); ?></h3>
  <?php endif; ?>

  <?php if ( $attributes['updated'] ) : ?>
    <div class="notice update-info">
      <p><?php
        printf(__( 'Your information was changed successfully.', 'user-flow' ) );
      ?></p>
    </div>
  <?php endif; ?>

  <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
    <?php foreach ( $attributes['errors'] as $error ) : ?>
      <div class="error resgistration-error">
        <p><?php echo $error; ?></p>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <form id="user-update-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
    <div class="form-row">
      <label for="email" class="user-flow-label h5 hidden"><?php _e( 'Email', 'user-flow' ); ?> <strong>*</strong></label>
      <input placeholder="<?php echo mb_strtoupper(__( 'Email', 'user-flow' ), "UTF-8") . '*';?>"
        type="email" name="email" id="email" class="user-flow-input" 
        value="<?php echo  $attributes['data']['email']?>" disabled>
    </div>
    <div class="form-row">
      <label for="first_name" class="user-flow-label h5 hidden"><?php _e( 'First name', 'user-flow' ); ?></label>
      <input placeholder="<?php echo mb_strtoupper(__( 'First name', 'user-flow' ), "UTF-8");?>"
        type="text" name="first_name" id="first-name" 
        value="<?php echo  $attributes['data']['first_name']?>" class="user-flow-input">
    </div>
    <div class="form-row">
      <label for="last_name" class="user-flow-label h5 hidden"><?php _e( 'Last name', 'user-flow' ); ?></label>
      <input placeholder="<?php echo mb_strtoupper(__( 'Last name', 'user-flow' ), "UTF-8");?>"
        type="text" name="last_name" id="last-name" 
        value="<?php echo  $attributes['data']['last_name']?>" class="user-flow-input">
    </div>
    <div class="form-row">
      <label for="user_phone" class="user-flow-label h5 hidden"><?php _e( 'Phone', 'user-flow' ); ?></label>
      <input placeholder="<?php echo mb_strtoupper(__( 'Phone', 'user-flow' ), "UTF-8");?>"
        type="text" name="user_phone" id="user-phone" 
        value="<?php echo  $attributes['data']['user_phone']?>" class="user-flow-input">
    </div>
    <div class="form-row">
      <label for="user_area" class="user-flow-label h5 hidden"><?php _e( 'Teaching Area', 'user-flow' ); ?></label>
      <input placeholder="<?php echo mb_strtoupper(__( 'Teaching Area', 'user-flow' ), "UTF-8");?>"
        type="text" name="user_area" id="user-area" 
        value="<?php echo  $attributes['data']['user_area']?>" class="user-flow-input">
    </div>
    <div class="form-row">
      <label for="user_institution" class="user-flow-label h5 hidden"><?php _e( 'Teaching Institution', 'user-flow' ); ?></label>
      <input placeholder="<?php echo mb_strtoupper(__( 'Teaching Institution', 'user-flow' ), "UTF-8");?>"
        type="text" name="user_institution" id="user-institution" 
        value="<?php echo  $attributes['data']['user_institution']?>" class="user-flow-input">
    </div>
    <div class="form-row avatar-row">
      <label class="user-flow-label h5 hidden"><?php _e('Avatar', 'user-flow'); ?></label>
      <select class="avatar-select" name="user_avatar">
        <option value="" disabled<?php echo $current_avatar = 0 ? ' selected':'';?>><?php echo mb_strtoupper(__('Avatar', 'user-flow'), "UTF-8");?></option>
        <?php foreach($user_avatars as $avatar) :?>
          <option 
            value="<?php echo $avatar['input-value'];?>"
            <?php echo $avatar['selected']?>>
            <?php echo $avatar['label-alt'];?>
          </option>
        <?php endforeach;?>
      </select>
    </div>

    <div class="form-action" style="display: none;">
      <input type="hidden" name="action" value="cuf_update_user">
    </div>

    <div class="form-row full-width submit-row update-submit">
      <input type="submit" 
        name="submit" 
        class="update-button user-flow-button h5" 
        value="<?php _e( 'Actualizar', 'user-flow' ); ?>"/>
    </div>
  </form>


</div>