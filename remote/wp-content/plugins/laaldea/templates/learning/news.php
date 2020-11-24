<?php 
  $recent_news = $laaldea_args['recent_news'];
  $offset = $laaldea_args['offset'];
  $load_more = $laaldea_args['load_more'];

  // error_log('offset : ' . print_r($offset,1));
  // error_log('load_more : ' . print_r($load_more,1));
?>

<section id="news" class="d-flex align-items-center justify-content-center" data-menu="news">
  <div class="container-fluid">
    <div class="row title-row hidden">
      <h2><?php _e('Noticias','laaldea');?></h2>
    </div>
    <div class="row news-row">
      <div class="col-7 offset-1 main-container">

        <div class="news-container">
          <?php if( $recent_news -> have_posts() ) : ?>
              <?php $recent_news -> the_post(); 
                $post_id = get_the_ID();
                $author = get_the_author();
                ?>
              
              <div class="new-container post-id-<?php echo $post_id;?> p-3 my-3">
                <div class="image-container">
                  <?php the_post_thumbnail( 'large' );?>
                </div>
                <div class="title-container h4 color-cyan font-titan">
                  <span><?php the_title();?></span>
                  <span class="tags font-sassoon h6 color-gray"><?php echo __('En ', 'laaldea') . get_the_tag_list( '', ', ', ''); ?></span>
                </div>
                <div class="post-author h6 color-cyan font-sassoon pl-2 mb-2">
                  <span><?php _e('Escrito por: ','laaldea'); the_author();?></span>
                </div>
                <div class="author-location h6 font-sassoon pl-2 mb-2">
                  <span><?php echo get_user_meta( $author -> ID, 'user_location', true); ?></span>
                </div>
                <div class="post-date h6 color-cyan font-sassoon capitalized pl-2 mb-4">
                  <span><?php echo get_the_date();?></span>
                </div>
                <div class="post-content h5 font-sassoon color-gray p-0">
                  <?php the_content();?>
                </div>
                <div class="post-actions d-flex align-items-center justify-content-center font-titan">
                  <?php $post = get_adjacent_post(); ?>
                  <?php if(!empty($post)) : ?>
                    <?php $post_id = $post -> ID; ?>
                    <button class="load-more-link" data-postId="<?php echo $post_id?>">
                      <div class="text-container h6">
                        <span><?php echo get_the_title($post_id); ?></span>
                      </div>
                      <div class="image-container">
                        <img src="/wp-content/uploads/learning-arrow-down.png" alt="<?php _e('Arrow down image','laaldea'); ?>">
                      </div>
                    </button>
                  <?php endif;?>
                </div>
              </div>

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
                <div class="title-author h6 color-cyan font-sassoon pl-2 mb-2">
                  <?php _e('Escrito por: ','laaldea') . the_author();?>
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