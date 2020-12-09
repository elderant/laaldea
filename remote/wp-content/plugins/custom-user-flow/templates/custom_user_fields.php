<?php 
  $user_phone = $attributes['fields']['user_phone'];
  $user_area = $attributes['fields']['user_area'];
  $user_institution = $attributes['fields']['user_institution'];
  $user_avatar = $attributes['fields']['user_avatar'];
  $user_ip = $attributes['fields']['user_ip'];
  $user_location = $attributes['fields']['user_location'];

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
    case '/wp-content/uploads/user-avatar-ant.png':
      $current_avatar = 8;
      break;
    case '/wp-content/uploads/user-avatar-bee.png':
      $current_avatar = 9;
      break;
    case '/wp-content/uploads/user-avatar-moorhen.png':
      $current_avatar = 10;
      break;
    case '/wp-content/uploads/user-avatar-owl.png':
      $current_avatar = 11;
      break;
    default:
      $current_avatar = 1;
      break;
  }

  $user_avatars = array(
    'arnulfo' => array (
      'container-class' => 'avatar-container arnulfo',
      'input-id' => 'avatar-arnulfo',
      'input-value' => '/wp-content/uploads/user-avatar-arnold.png',
      'avatar_checked' => $current_avatar == 1? 'checked':'',
      'label-img' => '/wp-content/uploads/user-avatar-arnold.png',
      'label-alt' => __('Imagen Avatar Arnulfo','user-flow'),
    ),
    'lucy' => array (
      'container-class' => 'avatar-container lucy',
      'input-id' => 'avatar-lucy',
      'input-value' => '/wp-content/uploads/user-avatar-lucy.png',
      'avatar_checked' => $current_avatar == 2? 'checked':'',
      'label-img' => '/wp-content/uploads/user-avatar-lucy.png',
      'label-alt' => __('Imagen Avatar Lorena','user-flow'),
    ),
    'enrique' => array (
      'container-class' => 'avatar-container harry',
      'input-id' => 'avatar-harry',
      'input-value' => '/wp-content/uploads/user-avatar-harry.png',
      'avatar_checked' => $current_avatar == 3? 'checked':'',
      'label-img' => '/wp-content/uploads/user-avatar-harry.png',
      'label-alt' => __('Imagen Avatar Enrique','user-flow'),
    ),
    'efren' => array (
      'container-class' => 'avatar-container ernest',
      'input-id' => 'avatar-ernest',
      'input-value' => '/wp-content/uploads/user-avatar-ernest.png',
      'avatar_checked' => $current_avatar == 4? 'checked':'',
      'label-img' => '/wp-content/uploads/user-avatar-ernest.png',
      'label-alt' => __('Imagen Avatar Efrén','user-flow'),
    ),
    'macaw' => array (
      'container-class' => 'avatar-container macaw',
      'input-id' => 'avatar-macaw',
      'input-value' => '/wp-content/uploads/user-avatar-macaw.png',
      'avatar_checked' => $current_avatar == 5? 'checked':'',
      'label-img' => '/wp-content/uploads/user-avatar-macaw.png',
      'label-alt' => __('Imagen Avatar guacamaya','user-flow'),
    ),
    'carmen' => array (
      'container-class' => 'avatar-container carol',
      'input-id' => 'avatar-carol',
      'input-value' => '/wp-content/uploads/user-avatar-carol.png',
      'avatar_checked' => $current_avatar == 6? 'checked':'',
      'label-img' => '/wp-content/uploads/user-avatar-carol.png',
      'label-alt' => __('Imagen Avatar Carmen','user-flow'),
    ),
    'paco' => array (
      'container-class' => 'avatar-container peter',
      'input-id' => 'avatar-peter',
      'input-value' => '/wp-content/uploads/user-avatar-peter.png',
      'avatar_checked' => $current_avatar == 7? 'checked':'',
      'label-img' => '/wp-content/uploads/user-avatar-peter.png',
      'label-alt' => __('Imagen Avatar Paco','user-flow'),
    ),
    'ant' => array (
      'container-class' => 'avatar-container ant',
      'input-id' => 'avatar-ant',
      'input-value' => '/wp-content/uploads/user-avatar-ant.png',
      'avatar_checked' => $current_avatar == 8? 'checked':'',
      'label-img' => '/wp-content/uploads/user-avatar-ant.png',
      'label-alt' => __('Imagen Avatar hormiga','user-flow'),
    ),
    'bee' => array (
      'container-class' => 'avatar-container bee',
      'input-id' => 'avatar-bee',
      'input-value' => '/wp-content/uploads/user-avatar-bee.png',
      'avatar_checked' => $current_avatar == 9? 'checked':'',
      'label-img' => '/wp-content/uploads/user-avatar-bee.png',
      'label-alt' => __('Imagen Avatar Abeja','user-flow'),
    ),
    'gallineta' => array (
      'container-class' => 'avatar-container moorhen',
      'input-id' => 'avatar-moorhen',
      'input-value' => '/wp-content/uploads/user-avatar-moorhen.png',
      'avatar_checked' => $current_avatar == 10? 'checked':'',
      'label-img' => '/wp-content/uploads/user-avatar-moorhen.png',
      'label-alt' => __('Imagen Avatar gallineta','user-flow'),
    ),
    'owl' => array (
      'container-class' => 'avatar-container owl',
      'input-id' => 'avatar-owl',
      'input-value' => '/wp-content/uploads/user-avatar-owl.png',
      'avatar_checked' => $current_avatar == 11? 'checked':'',
      'label-img' => '/wp-content/uploads/user-avatar-owl.png',
      'label-alt' => __('Imagen Avatar búho','user-flow'),
    ),
  );
?>

<h3 class="heading"><?php _e('Custom fields', 'user-flow');?></h3>
<table class="form-table">
  <tr>
    <th>
      <label for="user_phone"><?php _e('Phone', 'user-flow'); ?></label>
    </th>
    <td>
      <input type="text" 
            class="input-text cuf-custom-field" 
            name="user_phone" 
            id="user-phone" 
            value="<?php echo $user_phone;?>"/>
    </td>
  </tr>
  <tr>
    <th>
      <label for="user_area"><?php _e('Teaching Area', 'user-flow'); ?></label>
    </th>
    <td>
      <input type="text" 
            class="input-text cuf-custom-field" 
            name="user_area" 
            id="user-area" 
            value="<?php echo $user_area;?>"/>
    </td>
  </tr>
  <tr>
    <th>
      <label for="user_institution"><?php _e('Teaching Institution', 'user-flow'); ?></label>
    </th>
    <td>
      <input type="text" 
            class="input-text cuf-custom-field" 
            name="user_institution" 
            id="user-institution" 
            value="<?php echo $user_institution;?>"/>
    </td>
  </tr>
  <tr>
    <th>
      <label><?php _e('Avatar', 'user-flow'); ?></label>
    </th>
    <td>
      <div class="radio-buttons">
        <?php foreach($user_avatars as $avatar) :?>
          <div class="<?php echo $avatar['container-class'];?>">
            <input 
              type="radio" name="user_avatar"
              value="<?php echo $avatar['input-value'];?>"
              id="<?php echo $avatar['input-id'];?>"
              <?php echo $avatar['avatar_checked']?' checked="checked"':'';?>>
            <label for="<?php echo $avatar['input-id'];?>">
              <img 
                src="<?php echo $avatar['label-img'];?>" 
                alt="<?php echo $avatar['label-alt'];?>">
            </label>
          </div>
        <?php endforeach;?>
      </div>
    </td>
  </tr>
  <tr>
    <th>
      <label for="user_ip"><?php _e('User Ip', 'user-flow'); ?></label>
    </th>
    <td>
      <span><?php echo $user_ip; ?></span>
    </td>
  </tr>
  <tr>
    <th>
      <label for="user_location"><?php _e('User loaction', 'user-flow'); ?></label>
    </th>
    <td>
      <span><?php echo $user_location; ?></span>
    </td>
  </tr>
</table>