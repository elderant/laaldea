<?php 
  $recent_tools = $laaldea_args['recent_tools'];
  $recent_news = $laaldea_args['recent_news'];
  $recent_replies = $laaldea_args['recent_replies'];
?>

<section id="learning-home" class="d-flex align-items-center justify-content-center">
  <div class="container-fluid">
    <div class="row learning-home-row">
      <div class="col-7 offset-1 left-column">
        <div class="area-container tools-area">
          <div class="row title-row">
            <div class="col-12">
              <h4 class="font-titan color-cyan d-flex align-items-center">
                <div class="icon-container tools">
                  <img class="area-icon" src="/wp-content/uploads/learning-home-tools-icon.png" alt="<?php _e('Icono herramientas','laaldea');?>">
                </div>
                <span class="text-container"><?php _e('Herramientas para ti','laaldea');?></span>
              </h4>
            </div>
          </div>
          <div class="row tools-row">
            <div class="col-12">
              <div class="slick-prev arrow">
                <img src="/wp-content/uploads/learning-arrow-left.png" alt="<?php _e('Arrow left','laaldea')?>">
              </div>
              <div class="slick-next arrow">
                <img src="/wp-content/uploads/learning-arrow-right.png" alt="<?php _e('Arrow right','laaldea')?>">
              </div>
              <div class="tools-carousel">
                <?php if( $recent_tools -> have_posts() ) : ?>
                  <?php while ($recent_tools -> have_posts()) : ?>
                    <?php $recent_tools -> the_post(); ?>
                    <div class="tool-container d-flex">
                      <div class="thumbnail-container">
                        <?php if(has_post_thumbnail()) :?>
                          <?php the_post_thumbnail( 'thumbnail' ); ?>
                        <?php else :?>
                          <img src="/wp-content/uploads/tools-default-thumb-background.jpg" alt="<?php _e('Default Thumbnail pdf', 'laaldea')?>">
                          <span class="default-text">
                            <?php if($type == 'PDF') : ?>
                              <?php _e('PDF', 'laaldea')?>
                            <?php elseif($type == 'Video') : ?>
                              <?php _e('Video', 'laaldea')?>
                            <?php else : ?>
                              <?php _e('Herramienta', 'laaldea')?>
                            <?php endif; ?>
                          </span>
                        <?php endif;?>
                      </div>
                    </div>

                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="area-container news-area">
          <div class="row title-row">
            <div class="col-12">
              <h4 class="font-titan color-cyan d-flex align-items-center">
                <div class="icon-container news">
                  <img class="area-icon news" src="/wp-content/uploads/learning-home-news-icon.png" alt="<?php _e('Icono noticias','laaldea');?>">
                </div>
                <span class="text-container"><?php _e('Últimas noticias','laaldea');?></span>
              </h4>
            </div>
          </div>
          <div class="row news-row">
            <div class="col-9 offset-3">
              <div class="news-container">
                <?php if( $recent_news -> have_posts() ) : ?>
                  <?php while ($recent_news -> have_posts()) : ?>
                    <?php $recent_news -> the_post(); ?>
                    <div class="new-container d-flex align-items-center">
                      <div class="image-container">
                        <?php the_post_thumbnail( 'thumbnail' );?>
                      </div>
                      <div class="info-container">
                        <div class="title-container h6 color-cyan font-titan">
                          <?php the_title();?>
                        </div>
                        <div class="title-author h6 color-cyan font-sassoon pl-2 mb-2">
                          <?php _e('Escrito por: ','laaldea') . the_author();?>
                        </div>
                        <div class="post-excerpt h6 color-cyan font-sassoon capitalized pl-2 mb-2">
                          <span><?php echo the_excerpt(); ?></span>
                        </div>
                      </div>
                    </div>
                    
                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="area-container forum-area">
          <div class="row title-row">
            <div class="col-12">
              <h4 class="font-titan color-cyan d-flex align-items-center">
                <div class="icon-container forum">
                  <img class="area-icon forum" src="/wp-content/uploads/learning-home-forums-icon.png" alt="<?php _e('Icono foro','laaldea');?>">
                </div>
                <span class="text-container"><?php _e('Foro','laaldea');?></span>
              </h4>
            </div>
          </div>
          <div class="row forum-row">
            <div class="col-12">
              <div class="forums-container">
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-3 right-column">
        <div class="area-container pending-area">
          <div class="row title-row">
            <div class="col-10">
              <h4 class="font-titan color-cyan d-flex align-items-center">
                <div class="icon-container pending">
                  <img class="area-icon pending" src="/wp-content/uploads/learning-home-pending-icon.png" alt="<?php _e('Icono en curso','laaldea');?>">
                </div>
                <span class="text-container"><?php _e('En curso','laaldea');?></span>
              </h4>
            </div>
            <div class="col-2">
              Awards Placeholder
            </div>
          </div>
          <div class="row pending-row">
            <div class="col-12">
              Pending Placeholder
            </div>
          </div>

        </div>
        <div class="area-container courses-area">
          <div class="row title-row">
            <h4 class="font-titan color-cyan d-flex align-items-center">
              <div class="icon-container courses">
                <img class="area-icon courses" src="/wp-content/uploads/learning-home-courses-icon.png" alt="<?php _e('Icono courses','laaldea');?>">
              </div>
              <span class="text-container"><?php _e('Recomendaciones para ti','laaldea');?></span>
            </h4>
          </div>
          <div class="row course-row">
            <div class="col-12">
              Courses Placeholder
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
