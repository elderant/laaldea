<?php 
  $user_phone = $attributes['fields']['user_phone'];
  $user_area = $attributes['fields']['user_area'];
  $user_institution = $attributes['fields']['user_institution'];
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
</table>