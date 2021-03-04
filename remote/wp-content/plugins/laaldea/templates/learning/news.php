<?php 
  $last_new = $laaldea_args['last_new'];
  $recent_news = $laaldea_args['recent_news'];
  $offset = $laaldea_args['offset'];
  $load_more = $laaldea_args['load_more'];
  $requested_new_id = $laaldea_args['requested_new_id'];
?>

<section id="news" class="d-flex align-items-center justify-content-center" data-menu="news">
  <div class="container-fluid">
    <div class="row title-row hidden">
      <h2><?php _e('Noticias','laaldea');?></h2>
    </div>
    <div class="row news-row">

      <div class="col-3 offset-1 sidebar">
        <div class="news-container d-flex flex-column justify-content-between align-items-start">
          <?php if( $recent_news -> have_posts() ) : ?>
            <?php while ($recent_news -> have_posts()) : ?>
              <?php $recent_news -> the_post(); 
                $post_id = get_the_ID();?>
              
              <div class="new-container pb-5 px-3 mt-5">
                <div class="image-container pt-0 pb-4">
                  <?php the_post_thumbnail( 'medium' );?>
                </div>
                <div class="title-container h6 color-cyan font-titan text-center mb-1">
                  <?php the_title();?>
                </div>
                <div class="post-place h6 color-cyan font-sassoon text-center pl-2 mb-1">
                  <span><?php echo !empty(get_field( "place" )) ? __('Lugar: ','laaldea') . get_field( "place"):'';?></span>
                </div>
                <div class="post-date h6 color-cyan font-sassoon text-center capitalized pl-2 mb-2">
                  <span><?php echo get_the_date(); ?></span>
                </div>
                <div class="post-excerpt h6 color-cyan font-sassoon text-justify pl-2 mb-3">
                  <span><?php echo the_excerpt(); ?></span>
                </div>
                <div class="post-actions d-flex align-items-center justify-content-center font-titan">
                  <button class="button learning-button load-new-button" data-postId="<?php echo $post_id;?>">
                    <?php _e('Leer más', 'laaldea'); ?>
                  </button>
                </div>
              </div>
              
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
        </div>
        <div class="actions d-flex align-items-center justify-content-center font-titan">
          <?php if(true === $load_more) : ?>
            <button class="load-more-link" data-offset="<?php echo $offset;?>">
              <div class="text-container h6">
                <span><?php _e('Ver más','laaldea');?></span>
              </div>
              <div class="image-container">
                <img src="/wp-content/uploads/learning-arrow-down.png" alt="<?php _e('Arrow down image','laaldea'); ?>">
              </div>
            </button>
          <?php endif;?>
        </div>

      </div>

      <div class="col-7 main-container">
        <div class="news-container">
          <?php if(!empty($requested_new_id)) : ?>
            <?php laaldea_get_new_html($requested_new_id, '', true); ?>
          <?php endif;?>
          
          <?php if( $last_new -> have_posts() ) : ?>
            <?php 
              $last_new -> the_post();
              $post_id = get_the_ID();
              laaldea_get_new_html($post_id, '', true);
            ?>
          <?php endif; ?>
        </div>
          
      </div> <!-- col end -->
    </div> <!-- news-row END -->
  </div>
</section>