<?php
  $post_id = $laaldea_args['post_id'];
  $post_thumb = $laaldea_args['post_thumb'];
  $post_title = $laaldea_args['post_title'];
  $post_author = $laaldea_args['post_author'];
?>

<div class="new-container pb-5 px-3 mt-5">
  <div class="image-container pt-0 pb-4">
    <?php echo $post_thumb; ?>
  </div>
  <div class="title-container h6 color-cyan font-titan text-center mb-1">
    <?php echo $post_title; ?>
  </div>
  <div class="post-place h6 color-cyan font-sassoon text-center pl-2 mb-1">
    <?php _e('Lugar: ','laaldea') . get_field( "place" ); ?>
  </div>
  <div class="post-date h6 color-cyan font-sassoon text-center capitalized pl-2 mb-2">
    <span><?php echo get_the_date(); ?></span>
  </div>
  <div class="post-excerpt h6 color-cyan font-sassoon text-justify pl-2 mb-3">
    <span><?php echo the_excerpt(); ?></span>
  </div>
  <div class="post-excerpt h6 color-cyan font-sassoon text-justify capitalized pl-2 mb-3">
    <button class="button learning-button load-new-button" data-postId="<?php echo $post_id;?>">
      <?php _e('Leer más', 'laaldea'); ?>
    </button>
  </div>
</div>