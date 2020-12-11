<?php 
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
      <div class="col-7 offset-1 main-container">

        <div class="news-container">
          <?php if(!empty($requested_new_id)) : ?>
            <?php laaldea_get_new_html($requested_new_id, '', true); ?>
          <?php endif;?>
          
          <?php if( $recent_news -> have_posts() ) : ?>
            <?php 
              $recent_news -> the_post();
              $post_id = get_the_ID();
              laaldea_get_new_html($post_id, '', true);
            ?>
          <?php endif; ?>
        </div>
          
      </div> <!-- col end -->
      
      <div class="col-3 sidebar">

        <div class="news-container d-flex flex-column justify-content-between align-items-start">
          <?php if( $recent_news -> have_posts() ) : ?>
            <?php while ($recent_news -> have_posts()) : ?>
              <?php $recent_news -> the_post(); 
                $post_id = get_the_ID();?>
              
              <div class="new-container p-3 my-3">
                <div class="image-container">
                  <?php the_post_thumbnail( 'thumbnail' );?>
                </div>
                <div class="title-container h6 color-cyan font-titan">
                  <?php the_title();?>
                </div>
                <div class="post-place h6 color-cyan font-sassoon pl-2 mb-2">
                  <?php echo !empty(get_field( "place" )) ? __('Lugar: ','laaldea') . get_field( "place"):'';?>
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
    </div> <!-- news-row END -->
  </div>
</section>