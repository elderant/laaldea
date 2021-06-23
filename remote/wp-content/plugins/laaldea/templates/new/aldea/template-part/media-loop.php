<?php 
  $recent_media = $laaldea_args['recent_media'];
  $post_count = $laaldea_args['post_count'];
  $slide_count = $laaldea_args['slide_count'];
  $media_posts = $laaldea_args['media_posts'];
?>

<div class="media-carousel carousel-container mb-3">
  <?php foreach($media_posts as $slide_posts) : ?>
    <!-- <div class="slide-container d-flex align-items-start justify-content-around"> -->
      <?php laaldea_build_media_slide_html($slide_posts); ?>
    <!-- </div> -->
  <?php endforeach;?>
</div>
