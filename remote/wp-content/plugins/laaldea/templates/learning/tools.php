<?php 
  $recent_tools = $laaldea_args['recent_tools'];
  $limit = $laaldea_args['limit'];
  $offset = $laaldea_args['offset'];
  $post_count = $laaldea_args['post_count'];

  $limit = $post_count < $limit? $post_count: $limit;
?>

<section id="tools" class="d-flex align-items-center justify-content-center">
  <div class="container-fluid">
    <div class="row title-row hidden">
      <h2><?php _e('Herramientas','laaldea');?></h2>
    </div>
    <div class="row tools-row">
      <div class="col-3 offset-1 sidebar">
        <div class="title-container d-flex align-items-center pb-5">
          <img src="/wp-content/uploads/tools-icon.png" alt="<?php _e('Herramientas icon', 'laaldea'); ?>">
          <h4><?php _e('Mis recursos','laaldea');?></h4>
        </div>
        <div class="filters-container follow d-flex flex-column justify-content-between align-items-start pb-5">
          <button class="follow-type-filter-button" data-filter="follow">
            <img class="filter-image follow" src="/wp-content/uploads/tools-filter-follow.png" alt="<?php _e('Imagen filtrar por favoritos','laaldea')?>">
            <span class="text-container h6 font-titan"><?php _e('Mis Favoritos','laaldea');?></span>
          </button>
        </div>
        <div class="filters-container book d-flex flex-column justify-content-between align-items-start">
          <div class="filter-title py-4">
            <button class="filter-contol d-flex align-items-center justify-content-between">
              <div class="filter-text d-flex align-items-center">
                <img src="/wp-content/uploads/learning-arrow-right.png" alt="<?php _e('arrow right','laaldea')?>">
                <span class="h5 font-titan pl-4 color-gray"><?php _e('Por libro','laaldea');?></span>
              </div>
              <div class="filter-icon h5">
                <span class="icon font-titan">+</span>
                <span class="icon hidden font-titan">-</span>
              </div>
            </button>
          </div>
          <?php foreach($laaldea_args['book_terms'] as $book_term) : ?>
            <div class="term-container hidden pb-3 term-<?php echo $book_term -> term_id; ?>">
              <button data-termId="<?php echo $book_term -> term_id?>">
                <img src="<?php echo get_field( "category_image", 'category_' . $book_term -> term_id );?>" alt="<?php _e('Term image','laaldea');?>">
                <span class="h6 font-titan"><?php echo $book_term -> name?></span>
              </button>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="filters-container topic d-flex flex-column justify-content-between align-items-start">
          <div class="filter-title py-4 d-flex align-items-center">
            <button class="filter-contol d-flex align-items-center justify-content-between">
              <div class="filter-text d-flex align-items-center">
                <img src="/wp-content/uploads/learning-arrow-right.png" alt="<?php _e('arrow right','laaldea')?>">
                <span class="h5 font-titan pl-4 color-gray"><?php _e('Por tema','laaldea');?></span>
              </div>
              <div class="filter-icon h5">
                <span class="icon font-titan">+</span>
                <span class="icon hidden font-titan">-</span>
              </div>
            </button>
          </div>
          <?php foreach($laaldea_args['topic_terms'] as $topic_terms) : ?>
            <div class="term-container hidden pb-3 term-<?php echo $topic_terms -> term_id?>">
              <button data-termId="<?php echo $topic_terms -> term_id?>">
                <img src="<?php echo get_field( "category_image", 'category_' . $topic_terms -> term_id );?>" alt="<?php _e('Term image','laaldea');?>">
                <span class="h6 font-titan"><?php echo $topic_terms -> name?></span>
              </button>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="filters-container activities d-flex flex-column justify-content-between align-items-start">
          <div class="filter-title py-4 d-flex align-items-center">
            <button class="filter-contol d-flex align-items-center justify-content-between">
              <div class="filter-text d-flex align-items-center">
                <img src="/wp-content/uploads/learning-arrow-right.png" alt="<?php _e('arrow right','laaldea')?>">
                <span class="h5 font-titan pl-4 color-gray"><?php _e('Por actividad','laaldea');?></span>
              </div>
              <div class="filter-icon h5">
                <span class="icon font-titan">+</span>
                <span class="icon hidden font-titan">-</span>
              </div>
            </button>
          </div>
          <?php foreach($laaldea_args['action_terms'] as $action_terms) : ?>
            <div class="term-container hidden pb-3 term-<?php echo $action_terms -> term_id?>">
              <button data-termId="<?php echo $action_terms -> term_id?>">
                <img src="<?php echo get_field( "category_image", 'category_' . $action_terms -> term_id );?>" alt="<?php _e('Term image','laaldea');?>">
                <span class="h6 font-titan"><?php echo $action_terms -> name?></span>
              </button>
            </div>
          <?php endforeach; ?>
        </div>

      </div>

      <div class="col-7 main-container">
        <div class="type-filter-container pb-4 d-flex align-items-center">
          <button class="video-type-filter-button d-flex align-items-center" data-filter="video">
            <img class="filter-image video" src="/wp-content/uploads/tools-filter-video.png" alt="<?php _e('Imagen filtrar por video','laaldea')?>">
            <div class="text-container h6 font-titan"><?php _e('Video','laaldea');?></div>
          </button>
          <button class="pdf-type-filter-button d-flex align-items-center" data-filter="pdf">
            <img class="filter-image pdf" src="/wp-content/uploads/tools-filter-pdf.png" alt="<?php _e('Imagen filtrar por pdf','laaldea')?>">
            <div class="text-container h6 font-titan"><?php _e('PDF','laaldea');?></div>
          </button>
        </div>

        <div class="tools-container" data-limit="<?php echo $limit;?>">
          <?php if( $recent_tools -> have_posts() ) : ?>
            <?php while ($recent_tools -> have_posts()) : ?>
              <?php $recent_tools -> the_post(); 
                $post_id = get_the_ID();
                $tool = get_field( "herramienta" );
                $type = get_field( "type" );
                $link = $type == 'Video'? get_field( "link_youtube" ):'';
                $related = get_field( "related_tools" );
                $categories_class = laaldea_get_tools_category_class($post_id);
                $add = laaldea_post_id_in_followed($post_id);
              ?>
              
              <div class="tool-container flex-wrap align-items-end show post-id-<?php echo $post_id;?> type-<?php echo strtolower($type);?> <?php echo $categories_class;?><?php echo $add>0?' type-follow ':'';?>">
                <img class="tool-background-image" src="/wp-content/uploads/tools-single-background.png" alt="<?php _e('Tool item background','laaldea')?>">
                <div class="row top-row py-3">
                  <div class="col-8 title-column">
                    <h4 class="font-titan"><?php the_title();?></h4>
                  </div>
                  <div class="col-3 follow-column text-right">
                    <button data-postId="<?php echo $post_id;?>" data-add="<?php echo $add; ?>"<?php echo $add==-1?' disabled':'';?>>
                      <img src="/wp-content/uploads/tools-button-follow.png" alt="<?php _e('Imagen añadir a favoritos','laaldea');?>">
                    </button>
                  </div>
                </div>
                <div class="row middle-row pb-3">
                  <div class="col-4 thumbnail-container d-flex align-items-center justify-content-center">
                    <a href="<?php echo $tool?>" class="view-link type-<?php echo strtolower($type);?>" target="_blank" data-postId="<?php echo $post_id;?>" data-type="<?php echo strtolower($type);?>" data-link="<?php echo $link;?>">
                      <?php if(has_post_thumbnail()) :?>
                        <?php the_post_thumbnail( 'small' ); ?>
                      <?php else :?>
                        <img src="/wp-content/uploads/tools-default-thumb-background.jpg" alt="<?php _e('Default Thumbnail pdf', 'laaldea')?>">
                        <span class="default-text d-flex align-items-center justify-content-center">
                          <?php if($type == 'PDF') : ?>
                            <?php _e('PDF', 'laaldea')?>
                          <?php elseif($type == 'Video') : ?>
                            <?php _e('Video', 'laaldea')?>
                          <?php elseif($type == 'Audio') : ?>
                            <?php _e('Audio', 'laaldea')?>
                          <?php else : ?>
                            <?php _e('Herramienta', 'laaldea')?>
                          <?php endif; ?>
                        </span>
                      <?php endif;?>
                    </a>
                  </div>
                  <div class="col-7 d-flex align-items-center description-container">
                    <?php if(!empty(get_the_content())) :?>
                      <?php the_content(); ?>
                    <?php else :?>
                      <p><?php _e('Sin Descripción','laaldea')?></p>
                    <?php endif;?>
                  </div>
                </div>
                <div class="row bottom-row pb-3">
                  <div class="col-8 resource-column d-flex align-items-center justify-content-start">
                    <button class="link-container d-flex align-items-center">
                      <div class="copy-icon-container text-center pr-3">
                        <i class="fa fa-copy"></i>
                        <div><?php _e('Copiar vinculo','laaldea')?></div>
                      </div>
                      <div><?php echo $tool?></div>
                      <span class="tooltiptext"><?php _e('Texto Copiado','laaldea');?></span>
                    </button>
                  </div>
                  <div class="col-3 download-link-column d-flex align-items-center justify-content-end">
                    <a class="text-center" href="<?php echo $tool?>" download>
                      <?php if($type == 'PDF') : ?>
                        <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga pdf', 'laaldea')?>">
                      <?php elseif($type == 'Video') : ?>
                        <img src="/wp-content/uploads/tools-button-download-video.png" alt="<?php _e('Imagen descarga video', 'laaldea')?>">
                      <?php elseif($type == 'Audio') : ?>
                        <img src="/wp-content/uploads/tools-button-download-video.png" alt="<?php _e('Imagen descarga audio', 'laaldea')?>">
                      <?php else : ?>
                        <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga general', 'laaldea')?>">
                      <?php endif; ?>
                      <div class="download-text">
                        <?php _e('Descarga aquí','laaldea');?>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="row related-row pb-3">
                  <div class="col-12">
                    <?php if(sizeOf($related) > 0) : ?>
                      <h6><?php _e('Herramientas relacionadas','laaldea');?></h6>
                    <?php endif; ?>
                  </div>
                  <?php for ($i = 0; $i <= sizeOf($related) - 1; $i++ ) : ?>
                    <?php  
                      $related_post_id = $related[$i];
                      $related_tool = get_field( "herramienta", $related_post_id );
                      $related_type = get_field( "type", $related_post_id );
                      $related_link = $related_type == 'Video'? get_field( "link_youtube", $related_post_id ):'';
                      $related_title = get_the_title( $related_post_id );
                    ?>
                    <div class="related-tool-container col-11">
                      <a href="<?php echo $related_tool?>" class="view-link-rel type-<?php echo strtolower($related_type);?>" target="_blank" data-postId="<?php echo $related_post_id;?>" data-link="<?php echo $link;?>">
                        <?php echo $related_title;?>
                      </a>
                      <a class="text-center down-link-rel" href="<?php echo $related_tool?>" download>
                        <?php if($related_type == 'PDF') : ?>
                          <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga pdf', 'laaldea')?>">
                        <?php elseif($related_type == 'Video') : ?>
                          <img src="/wp-content/uploads/tools-button-download-video.png" alt="<?php _e('Imagen descarga video', 'laaldea')?>">
                        <?php elseif($related_type == 'Audio') : ?>
                          <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga audio', 'laaldea')?>">
                        <?php else : ?>
                          <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga general', 'laaldea')?>">
                        <?php endif; ?>
                      </a>
                    </div>
                  <?php endfor; ?>
                </div>
              </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
        </div>
          
        <div class="load-more-container">
          <?php if($post_count > $offset) : ?>
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
      </div> <!-- col end -->

    </div> <!-- news-row END -->
  </div>
</section>