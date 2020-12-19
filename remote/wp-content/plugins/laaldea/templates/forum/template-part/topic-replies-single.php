<?php
  $reply_date = $laaldea_args['reply_date'];
  $reply_content = $laaldea_args['reply_content'];
  $reply_author = $laaldea_args['reply_author'];
  $reply_avatar = $laaldea_args['reply_avatar'];
  $reply_id = $laaldea_args['reply_id'];
?>

<div class="reply-container bbp-list-reply d-flex align-items-center justify-content-between reply-id-<?php echo $reply_id?>">
  <div class="author-container text-center">
    <div class="avatar-container">
      <img src="<?php echo $reply_avatar;?>" alt="<?php _e('User avatar image','laaldea');?>">
    </div>
    <div class="author-text-container">
      <div class="text-container text-center"><?php echo $reply_author; ?></div>
    </div>
  </div>
  <div class="content-container">
    <img class="reply-background-image" src="/wp-content/uploads/tools-single-background.png" alt="<?php _e('Tool item background','laaldea')?>">
    <?php echo $reply_content; ?>
    <div class="date text-right color-cyan"><?php echo $reply_date; ?></div>
  </div>
</div>