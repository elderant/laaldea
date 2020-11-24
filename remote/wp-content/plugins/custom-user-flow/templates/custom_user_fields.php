<?php 
  $user_phone = $attributes['fields']['user_phone'];
  $user_area = $attributes['fields']['user_area'];
  $user_institution = $attributes['fields']['user_institution'];
  $user_avatar = $attributes['fields']['user_avatar'];
  $user_ip = $attributes['fields']['user_ip'];
  $user_location = $attributes['fields']['user_location'];

  switch ( $user_avatar ) {
    case '/wp-content/uploads/user-avatar1.png':
      $current_avatar = 1;
      break;
    case '/wp-content/uploads/user-avatar2.png':
      $current_avatar = 2;
      break;
    case '/wp-content/uploads/user-avatar3.png':
      $current_avatar = 3;
      break;
    case '/wp-content/uploads/user-avatar4.png':
      $current_avatar = 4;
      break;
    default:
      $current_avatar = 1;
      break;
  }
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
      <label for="user_institution"><?php _e('Teaching institution', 'user-flow'); ?></label>
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
        <div class="avatar1-container">
          <input type="radio" id="avatar1" name="user_avatar" value="/wp-content/uploads/user-avatar1.png"<?php echo $current_avatar === 1?' checked="checked"':''; ?>>
          <label for="avatar1"><img src="/wp-content/uploads/user-avatar1.png" alt="<?php _e('Avatar 1 image','laaldea');?>"></label>
        </div>
        <div class="avatar2-container">
          <input type="radio" id="avatar2" name="user_avatar" value="/wp-content/uploads/user-avatar2.png"<?php echo $current_avatar === 2?' checked="checked"':''; ?>>
          <label for="avatar2"><img src="/wp-content/uploads/user-avatar2.png" alt="<?php _e('Avatar 2 image','laaldea');?>"></label>
        </div>
        <div class="avatar3-container">
          <input type="radio" id="avatar3" name="user_avatar" value="/wp-content/uploads/user-avatar3.png"<?php echo $current_avatar === 3?' checked="checked"':''; ?>>
          <label for="avatar3"><img src="/wp-content/uploads/user-avatar3.png" alt="<?php _e('Avatar 3 image','laaldea');?>"></label>
        </div>
        <div class="avatar4-container">
          <input type="radio" id="avatar4" name="user_avatar" value="/wp-content/uploads/user-avatar4.png"<?php echo $current_avatar === 4?' checked="checked"':''; ?>>
          <label for="avatar4"><img src="/wp-content/uploads/user-avatar4.png" alt="<?php _e('Avatar 4 image','laaldea');?>"></label>
        </div>
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