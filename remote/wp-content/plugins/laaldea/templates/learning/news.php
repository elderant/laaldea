<?php $recent_news = $laaldea_args['recent_news'];?>

<section id="news" class="d-flex align-items-center justify-content-center" data-menu="news">
  <div class="container-fluid">
    <div class="row title-row hidden">
      <h2><?php _e('Noticias','laaldea');?></h2>
    </div>
    <div class="row news-row">
      <div class="col-10 offset-1">

        <div class="news-container d-flex justify-content-between align-items-start flex-wrap column-3">
          <?php if( $recent_news -> have_posts() ) : ?>
            <?php while ($recent_news -> have_posts()) : ?>
              <?php $recent_news -> the_post(); 
                $post_id = get_the_ID();?>
              
              <div class="new-container p-3 my-3">
                <div class="image-container">
                  <?php the_post_thumbnail( 'medium' );?>
                </div>
                <div class="title-container h4 color-cyan font-titan">
                  <?php the_title();?>
                </div>
                <div class="title-author h6 color-cyan font-sassoon pl-2 mb-4">
                  <?php _e('Escrito por: ','laaldea') . the_author();?>
                </div>
                <div class="post-excerpt h5 font-sassoon color-gray p-0 mb-4">
                  <div class="p-header"><?php _e('Sinopsis: ','laaldea'); ?></div>
                  <?php echo the_excerpt();?>
                </div>
                <div class="post-actions d-flex align-items-center justify-content-center font-titan">
                  <div class="open-container">
                    <div class="text-container">
                      <a class="h6" href="<?php the_permalink(); ?>"><?php _e('Leer más', 'laaldea'); ?></a>
                    </div>
                  </div>
                </div>
              </div>
              
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
        </div>
          
      </div> <!-- col end -->
    </div> <!-- news-row END -->
  </div>
</section>