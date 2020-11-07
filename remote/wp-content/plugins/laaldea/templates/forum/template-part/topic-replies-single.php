<?php
  $reply_date = $laaldea_args['reply_date'];
  $reply_content = $laaldea_args['reply_content'];
  $reply_author = $laaldea_args['reply_author'];
?>

<div class="reply-container bbp-list-reply d-flex align-items-center">
  <div class="author-container">
    <div class="text-container text-center"><?php echo $reply_author; ?></div>
  </div>
  <div class="content-container">
    <?php echo $reply_content; ?>
    <div class="date text-right color-cyan"><?php echo $reply_date; ?></div>
  </div>
</div>