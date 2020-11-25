<?php
  $post_id = $laaldea_args['post_id'];
  $post_thumb = $laaldea_args['post_thumb'];
  $post_title = $laaldea_args['post_title'];
  $post_author = $laaldea_args['post_author'];
?>

<div class="new-container p-3 my-3">
  <div class="image-container">
    <?php echo $post_thumb; ?>
  </div>
  <div class="title-container h6 color-cyan font-titan">
    <?php echo $post_title; ?>
  </div>
  <div class="post-place h6 color-cyan font-sassoon pl-2 mb-2">
    <?php _e('Lugar: ','laaldea') . get_field( "place" ); ?>
  </div>
  <div class="post-date h6 color-cyan font-sassoon capitalized pl-2 mb-2">
    <span><?php echo get_the_date(); ?></span>
  </div>
  <div class="post-excerpt h6 color-cyan font-sassoon capitalized pl-2 mb-5">
    <span><?php echo the_excerpt(); ?></span>
  </div>
  <div class="post-actions d-flex align-items-center justify-content-center font-titan">
    <button class="load-new-button" data-postId="<?php echo $post_id;?>">
      <div class="open-container">
        <div class="text-container">
          <?php _e('Leer más', 'laaldea'); ?>
        </div>
      </div>
    </button>
  </div>
</div>