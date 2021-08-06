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
      $reply_author_id = bbp_get_reply_author_id();
      $avatar_url = get_user_meta( $reply_author_id, 'user_avatar', true);
    ?>

    <div class="reply-container bbp-list-reply d-flex flex-column align-items-center justify-content-between flex-lg-row">
      <div class="author-container text-center">
        <div class="avatar-container">
          <img src="<?php echo $avatar_url;?>" alt="<?php _e('User avatar image','laaldea');?>">
        </div>
        <div class="author-text-container">
          <div class="text-container text-center p"><?php echo $reply_author; ?></div>
        </div>
      </div>
      <div class="content-container">
        <img class="reply-background-image" src="/wp-content/uploads/tools-single-background.png" alt="<?php _e('Tool item background','laaldea')?>">
        <?php echo $reply_content; ?>
        <div class="date text-right color-cyan"><?php echo $reply_date; ?></div>
      </div>
    </div>
  <?php endwhile;?>
  <?php if($total_replies > $offset) : ?>
    <div class="load-more-link-container">
      <button class="load-more-link" data-offset="<?php echo $offset?>" data-total="<?php echo $total_replies?>" data-topicId="<?php echo $topic_id?>">
        <div class="text-container h6 uppercase">
          <span><?php _e('Ver más','laaldea');?></span>
        </div>
      </button>
    </div>
  <?php endif; ?>
</div>