<?php
  $user_avatars = array(
    'arnulfo' => array (
      'container-class' => 'avatar-container arnulfo',
      'input-id' => 'avatar-arnulfo',
      'input-value' => '/wp-content/uploads/user-avatar-arnold.png',
      'avatar_index' => 1,
      'label-img' => '/wp-content/uploads/user-avatar-arnold.png',
      'label-alt' => __('Imagen Avatar Arnulfo','user-flow'),
    ),
    'lucy' => array (
      'container-class' => 'avatar-container lucy',
      'input-id' => 'avatar-lucy',
      'input-value' => '/wp-content/uploads/user-avatar-lucy.png',
      'avatar_index' => 2,
      'label-img' => '/wp-content/uploads/user-avatar-lucy.png',
      'label-alt' => __('Imagen Avatar Lorena','user-flow'),
    ),
    'enrique' => array (
      'container-class' => 'avatar-container harry',
      'input-id' => 'avatar-harry',
      'input-value' => '/wp-content/uploads/user-avatar-harry.png',
      'avatar_index' => 3,
      'label-img' => '/wp-content/uploads/user-avatar-harry.png',
      'label-alt' => __('Imagen Avatar Enrique','user-flow'),
    ),
    'efren' => array (
      'container-class' => 'avatar-container ernest',
      'input-id' => 'avatar-ernest',
      'input-value' => '/wp-content/uploads/user-avatar-ernest.png',
      'avatar_index' => 4,
      'label-img' => '/wp-content/uploads/user-avatar-ernest.png',
      'label-alt' => __('Imagen Avatar Efrén','user-flow'),
    ),
    'macaw' => array (
      'container-class' => 'avatar-container macaw',
      'input-id' => 'avatar-macaw',
      'input-value' => '/wp-content/uploads/user-avatar-macaw.png',
      'avatar_index' => 5,
      'label-img' => '/wp-content/uploads/user-avatar-macaw.png',
      'label-alt' => __('Imagen Avatar guacamaya','user-flow'),
    ),
    'carmen' => array (
      'container-class' => 'avatar-container carol',
      'input-id' => 'avatar-carol',
      'input-value' => '/wp-content/uploads/user-avatar-carol.png',
      'avatar_index' => 6,
      'label-img' => '/wp-content/uploads/user-avatar-carol.png',
      'label-alt' => __('Imagen Avatar Carmen','user-flow'),
    ),
    'paco' => array (
      'container-class' => 'avatar-container peter',
      'input-id' => 'avatar-peter',
      'input-value' => '/wp-content/uploads/user-avatar-peter.png',
      'avatar_index' => 7,
      'label-img' => '/wp-content/uploads/user-avatar-peter.png',
      'label-alt' => __('Imagen Avatar Paco','user-flow'),
    ),
    'ant' => array (
      'container-class' => 'avatar-container ant',
      'input-id' => 'avatar-ant',
      'input-value' => '/wp-content/uploads/user-avatar-ant.png',
      'avatar_index' => 8,
      'label-img' => '/wp-content/uploads/user-avatar-ant.png',
      'label-alt' => __('Imagen Avatar hormiga','user-flow'),
    ),
    'bee' => array (
      'container-class' => 'avatar-container bee',
      'input-id' => 'avatar-bee',
      'input-value' => '/wp-content/uploads/user-avatar-bee.png',
      'avatar_index' => 9,
      'label-img' => '/wp-content/uploads/user-avatar-bee.png',
      'label-alt' => __('Imagen Avatar Abeja','user-flow'),
    ),
    'gallineta' => array (
      'container-class' => 'avatar-container moorhen',
      'input-id' => 'avatar-moorhen',
      'input-value' => '/wp-content/uploads/user-avatar-moorhen.png',
      'avatar_index' => 10,
      'label-img' => '/wp-content/uploads/user-avatar-moorhen.png',
      'label-alt' => __('Imagen Avatar gallineta','user-flow'),
    ),
    'owl' => array (
      'container-class' => 'avatar-container owl',
      'input-id' => 'avatar-owl',
      'input-value' => '/wp-content/uploads/user-avatar-owl.png',
      'avatar_index' => 11,
      'label-img' => '/wp-content/uploads/user-avatar-owl.png',
      'label-alt' => __('Imagen Avatar búho','user-flow'),
    ),
  );

  $user = get_userdata( get_current_user_id() );
  $user_meta = get_user_meta(  get_current_user_id() );
?>

<div id="edit-form" class="widecolumn">
  <?php if ( $attributes['show_title'] ) : ?>
    <h3><?php _e( 'Edit User', 'user-flow' ); ?></h3>
  <?php endif; ?>

  <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
    <?php foreach ( $attributes['errors'] as $error ) : ?>
      <div class="error edit-error">
        <p><?php echo $error; ?></p>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>


  <form id="edit-user-form" action="<?php echo 'https://laaldea.co/account/'; ?>" method="post">
    <div class="form-row">
      <label for="email" class="user-flow-label"><?php _e( 'Email', 'user-flow' ); ?> <strong>*</strong></label>
      <input type="email" name="email" id="email" class="user-flow-input" value="<?php echo $user->data->user_email; ?>">
    </div>
    <div class="form-row">
      <label for="first_name" class="user-flow-label"><?php _e( 'First name', 'user-flow' ); ?></label>
      <input type="text" name="first_name" id="first-name" class="user-flow-input" value="<?php echo $user_meta['first_name']['0']; ?>">
    </div>
    <div class="form-row">
      <label for="last_name" class="user-flow-label"><?php _e( 'Last name', 'user-flow' ); ?></label>
      <input type="text" name="last_name" id="last-name" class="user-flow-input" value="<?php echo $user_meta['last_name']['0']; ?>">
    </div>
    <div class="form-row">
      <label for="display_name" class="user-flow-label"><?php _e( 'Display name', 'user-flow' ); ?></label>
      <input type="text" name="display_name" id="display-name" class="user-flow-input" value="<?php echo $user->data->display_name; ?>">
    </div>
    <div class="form-row">
      <label for="user_phone" class="user-flow-label"><?php _e( 'Phone', 'user-flow' ); ?></label>
      <input type="text" name="user_phone" id="user-phone" class="user-flow-input" value="<?php echo $user_meta['user_phone']['0']; ?>">
    </div>
    <div class="form-row">
      <label for="user_area" class="user-flow-label"><?php _e( 'Teaching Area', 'user-flow' ); ?></label>
      <input type="text" name="user_area" id="user-area" class="user-flow-input" value="<?php echo $user_meta['user_area']['0']; ?>">
    </div>
    <div class="form-row">
      <label for="user_institution" class="user-flow-label"><?php _e( 'Teaching Institution', 'user-flow' ); ?></label>
      <input type="text" name="user_institution" id="user-institution" class="user-flow-input" value="<?php echo $user_meta['user_institution']['0']; ?>">
    </div>
    <div class="form-row">
      <label class="user-flow-label"><?php _e('Avatar', 'user-flow'); ?></label>
      <div class="radio-buttons">
        <?php foreach($user_avatars as $avatar) :?>
          <div class="<?php echo $avatar['container-class'];?>">
            <input 
              type="radio" name="user_avatar"
              value="<?php echo $avatar['input-value'];?>"
              id="<?php echo $avatar['input-id'];?>"<?php echo $avatar['input-value'] === $user_meta['user_avatar']['0']?' checked="checked"':'';?>>
            <label for="<?php echo $avatar['input-id'];?>">
              <img 
                src="<?php echo $avatar['label-img'];?>" 
                alt="<?php echo $avatar['label-alt'];?>">
            </label>
          </div>
        <?php endforeach;?>
      </div>
    </div>
    <div class="form-row edit-user-submit">
      <input type="submit" 
        name="submit" 
        class="edit-button user-flow-button" 
        value="<?php _e( 'Update Profile', 'user-flow' ); ?>"/>
    </div>
  </form>


</div>