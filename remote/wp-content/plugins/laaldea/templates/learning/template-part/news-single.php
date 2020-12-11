<?php 
  $post_id = $laaldea_args['post_id'];
  $has_thumbnail = $laaldea_args['has_thumbnail'];
  $thumbnail = $laaldea_args['thumbnail'];
  $title = $laaldea_args['title'];
  $tag_list = $laaldea_args['tag_list'];
  $place_text = $laaldea_args['place_text'];
  $date = $laaldea_args['date'];
  $content = $laaldea_args['content'];
  $adjacent_post = $laaldea_args['adjacent_post'];
?>

<div class="new-container post-id-<?php echo $post_id;?> p-3 my-3">
  <div class="image-container">
    <?php if($has_thumbnail) :?>
      <?php echo $thumbnail; ?>
    <?php endif;?>
  </div>
  <div class="post-title h4 color-cyan font-titan">
    <span><?php echo $title;?></span>
    <span class="tags font-sassoon h6 color-gray"><?php echo $tag_list;?></span>
  </div>
  <div class="post-place h6 color-cyan font-sassoon pl-2 mb-2">
    <?php echo $place_text;?>
  </div>
  <div class="post-date h6 color-cyan font-sassoon capitalized pl-2 mb-4">
    <span><?php echo $date; ?></span>
  </div>
  <div class="post-content h5 font-sassoon color-gray p-0">
    <p><?php echo $content;?></p>
  </div>
  <div class="post-actions d-flex align-items-center justify-content-center font-titan">
    <?php if(!empty($adjacent_post)) : ?>
      <?php $adjacent_post_id = $adjacent_post -> ID;?>
      <button class="load-more-link" data-postId="<?php echo $adjacent_post_id?>">
        <div class="text-container h6">
          <span><?php echo get_the_title($adjacent_post_id); ?></span>
        </div>
        <div class="image-container">
          <img src="/wp-content/uploads/learning-arrow-down.png" alt="<?php _e('Arrow down image','laaldea'); ?>">
        </div>
      </button>
    <?php endif;?>
  </div>
</div>