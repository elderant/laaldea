<?php
  $recent_post = $laaldea_args['recent_post'];
?>

<div id="home-intro" class="home-section">
  <section class="container-fluid">
    <div class="row">
      <div class="arrow-container prev disabled">
        <button class="laaldea-arrow arrow">
          <i class="fas fa-caret-left"></i>
        </button>
      </div>
      <div class="arrow-container next">
        <button class="laaldea-arrow arrow">
          <i class="fas fa-caret-right"></i>
        </button>
      </div>
      <div class="col-12 position-relative p-0 slider-container d-flex flex-row justify-content-start">
        <div class="background-container position-absolute">
          <img class="rellax background-part background-main" src="/wp-content/uploads/news-background.jpg" alt="<?php _e('News background', 'laaldea');?>" data-rellax-speed="1">
          <img class="rellax background-part background-plant" src="/wp-content/uploads/news-plant-1.png" alt="<?php _e('News a plant image', 'laaldea');?>" data-rellax-speed="-1">
          <img class="rellax background-part background-character" src="/wp-content/uploads/news-char-1.png" alt="<?php _e('Lucy image in news section', 'laaldea');?>" data-rellax-speed="-4">
          <img class="rellax background-part background-character-2" src="/wp-content/uploads/news-char-2.png" alt="<?php _e('A Macaw image in news section', 'laaldea');?>" data-rellax-speed="-4">
          <img class="rellax background-part background-character-3" src="/wp-content/uploads/news-char-3.png" alt="<?php _e('A Moorhen image in news section', 'laaldea');?>" data-rellax-speed="-4">
          <img class="rellax background-part background-plant-2" src="/wp-content/uploads/news-plant-2.png" alt="<?php _e('News a plant image', 'laaldea');?>" data-rellax-speed="-1">
        </div>
        <?php if( $recent_post -> have_posts() ) : ?>
          <?php while ($recent_post -> have_posts()) : ?>
            <?php 
              $recent_post -> the_post();
              $post_id = get_the_ID();
              error_log('adding new, post template : ' . print_r($post_id,1));
              laaldea_get_aldea_post_html($post_id);
            ?>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>