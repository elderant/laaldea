<?php
  $total_replies = $laaldea_args['total_replies'];
  $offset = $laaldea_args['offset'];
  $topic_id = $laaldea_args['topic_id'];
?>

<div class="topic-replies">
  <?php while(bbp_replies()) :?>
    
    <?php 
      bbp_the_reply();

      $reply_id = bbp_get_reply_id();
      $reply_date = bbp_get_reply_post_date();
      $reply_content = bbp_get_reply_content(); 
      $reply_author = bbp_get_reply_author_display_name();
    ?>

    <?php if ( bbp_is_topic( $reply_id ) ) : ?>
      <div class="topic-container bbp-list-reply d-flex align-items-center">
    <?php else:?>
      <div class="reply-container bbp-list-reply d-flex align-items-center">
    <?php endif;?>
        <div class="author-container">
          <div class="text-container text-center"><?php echo $reply_author; ?></div>
        </div>
        <div class="content-container">
          <?php echo $reply_content; ?>
          <div class="date text-right color-cyan"><?php echo $reply_date; ?></div>
        </div>
      </div>
  <?php endwhile;?>
  <?php if($total_replies > $offset) : ?>
    <div class="load-more-link-container">
      <button class="load-more-link" data-offset="<?php echo $offset?>" data-total="<?php echo $total_replies?>" data-topicId="<?php echo $topic_id?>">
        <div class="text-container h5">
          <span><?php _e('Ver más','laaldea');?></span>
        </div>
        <div class="image-container">
          <img src="/wp-content/uploads/learning-arrow-down.png" alt="<?php _e('Arrow down image','laaldea'); ?>">
        </div>
      </button>
    </div>
  <?php endif; ?>
</div>