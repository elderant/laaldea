<?php 
  $recent_tools = $laaldea_args['recent_tools'];
  $recent_news = $laaldea_args['recent_news'];
  $recent_replies = $laaldea_args['recent_replies'];
  $current_courses = $laaldea_args['current_courses'];
  $recommended_courses = $laaldea_args['recommended_courses'];
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
            <div class="col-12 carousel-column">
              <div class="slick-prev arrow">
                <img src="/wp-content/uploads/learning-arrow-left.png" alt="<?php _e('Arrow left','laaldea')?>">
              </div>
              <div class="slick-next arrow">
                <img src="/wp-content/uploads/learning-arrow-right.png" alt="<?php _e('Arrow right','laaldea')?>">
              </div>
              <div class="tools-carousel">
                <?php if( $recent_tools -> have_posts() ) : ?>
                  <?php while ($recent_tools -> have_posts()) : ?>
                    <?php 
                      $recent_tools -> the_post(); 
                      $type = get_field( "type" );
                    ?>
                    <div class="tool-container">
                      <div class="row">
                        <div class="thumbnail-container col-4 d-flex align-items-center justify-content-center">
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
                        <div class="col-7 d-flex align-items-start description-container flex-column">
                          <h4 class="font-titan"><?php the_title();?></h4>
                          <?php if(!empty(get_the_content())) :?>
                            <?php the_content(); ?>
                          <?php else :?>
                            <p><?php _e('Sin Descripción','laaldea')?></p>
                          <?php endif;?>
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
                <?php $i = 0;?>
                <?php if( $recent_news -> have_posts() ) : ?>
                  <?php while ($recent_news -> have_posts()) : ?>
                    <?php $recent_news -> the_post(); 
                      $i++;
                      $class = $i == 1? ' active': '';
                    ?>
                    <div class="new-section <?php echo $class?>">
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
                    </div>
                    
                  <?php endwhile; 
                    $i = 0;
                  ?>
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
            <div class="col-9 offset-3">
              <div class="forums-container d-flex">
                <?php bbpress()->reply_query = $recent_replies; ?>
                <?php if( $recent_replies -> have_posts() ) : ?>
                  <?php while (bbp_replies()) : ?>
                    <?php 
                      bbp_the_reply(); 
                      $reply_id = bbp_get_reply_id();
                      $topic_id = bbp_get_reply_topic_id( $reply_id );

                      $i++;
                      $class = 1 === $i? 'active': '';
                    ?>
                    <div class="reply-section <?php echo $class;?>">
                      <div class="reply-container d-flex flex-wrap align-items-center">
                        <div class="topic-link-container pb-3">
                          <span><?php _e('Ir al tema ','laaldea')?></span>
                          <a class="bbp-topic-permalink font-titan" href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title($topic_id);?></a>
                        </div>
                        <div class="bbp-reply-author">
                          <div class="author-container d-flex align-items-center">
                            <div class="avatar-container">
                              <?php 
                                $reply_author_id = bbp_get_reply_author_id();
                                $avatar_url = get_user_meta( $reply_author_id, 'user_avatar', true);
                              ?>
                              <img src="<?php echo $avatar_url;?>" alt="<?php _e('User avatar image','laaldea');?>">
                            </div>
                          </div>
                        </div>
                        <div class="bbp-reply-content px-3">
                          <?php bbp_reply_content(); ?>
                        </div>
                        <div class="bbp-reply-meta pr-3">
                          <span><?php _e('Publicado el ','laaldea')?></span>
                          <span class="bbp-reply-post-date"><?php bbp_reply_post_date(); ?></span>
                        </div>
                      </div>
                    </div>
                    
                  <?php endwhile; 
                    $i = 0;
                  ?>
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-3 right-column">
        <div class="area-container current-area">
          <div class="row title-row">
            <div class="col-10">
              <h4 class="font-titan color-cyan d-flex align-items-center">
                <div class="icon-container current">
                  <img class="area-icon current" src="/wp-content/uploads/learning-home-pending-icon.png" alt="<?php _e('Icono en curso','laaldea');?>">
                </div>
                <span class="text-container"><?php _e('En curso','laaldea');?></span>
              </h4>
            </div>
            <div class="col-2">
              Awards Placeholder
            </div>
          </div>
          <div class="row current-row">
            <div class="col-12">
              <div class="current-container">
                <?php if( $current_courses -> have_posts() ) : ?>
                  <?php $i = 0;?>
                  <?php while ($current_courses -> have_posts()) : ?>
                    <?php 
                      $current_courses -> the_post(); 
                      $title_html = get_field( 'title_html' );
                      $title = empty($title_html) ? get_the_title() : $title_html;
                      $html_title = empty($title_html) ? '' : ' html-title';
                      $current_lesson_name = laaldea_get_current_lesson_name();
                      $completed_percent = tutor_utils()->get_course_completed_percent();

                      $i = ($i < 3)? $i + 1: 1;
                      
                      $class = 'course-container py-3 row-' . $i; 
                      if ($i > 2) {
                        $class .= ' hidden';
                      } 
                    ?>

                    <div class="<?php echo $class?>">
                      <div class="tutor-panel-course-segment tutor-course-completion-percent">
                        <div class="percent-container font-titan">
                          <?php echo sprintf("%s%%", $completed_percent )?>
                        </div>
                      </div>
                      <a class="course-button d-flex align-items-center justify-content-center flex-column" href="<?php echo get_the_permalink()?>">
                        <div class="title-container<?php echo $html_title?>">
                          <?php echo $title; ?>
                        </div>
                        <div class="current-lesson">
                          <?php echo $current_lesson_name; ?>
                        </div>
                      </a>
                    </div>

                  <?php endwhile; 
                    $i = 0;
                  ?>
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
              </div>
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
            <div class="recommended-container">
                <?php if( $recommended_courses -> have_posts() ) : ?>
                  <?php $i = 0;?>
                  <?php while ($recommended_courses -> have_posts()) : ?>
                    <?php 
                      $recommended_courses -> the_post(); 
                      $title_html = get_field( 'title_html' );
                      $title = empty($title_html) ? get_the_title() : $title_html;
                      $html_title = empty($title_html) ? '' : ' html-title';
                      
                      $i = ($i < 3)? $i + 1: 1;
                      $class = 'course-container py-3 row-' . $i; 
                    ?>

                    <div class="<?php echo $class?>">
                      <a class="course-button d-flex align-items-center justify-content-center" href="<?php echo get_the_permalink()?>">
                        <div class="title-container<?php echo $html_title?>">
                          <?php echo $title; ?>
                        </div>
                      </a>
                    </div>

                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
