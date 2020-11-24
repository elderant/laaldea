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
            <span class="text-container h6 font-titan"><?php _e('Favoritos','laaldea');?></span>
          </button>
        </div>
        <div class="filters-container book d-flex flex-column justify-content-between align-items-start">
          <div class="filter-title pb-4 d-flex align-items-center">
            <img src="/wp-content/uploads/learning-arrow-right.png" alt="<?php _e('arrow right','laaldea')?>">
            <span class="h5 font-titan pl-4 color-gray"><?php _e('Por libro','laaldea');?></span>
          </div>
          <?php foreach($laaldea_args['book_terms'] as $book_term) : ?>
            <div class="term-container pb-3 term-<?php echo $book_term -> term_id; ?>">
              <button data-termId="<?php echo $book_term -> term_id?>">
                <img src="<?php echo get_field( "category_image", 'category_' . $book_term -> term_id );?>" alt="<?php _e('Term image','laaldea');?>">
                <span class="h6 font-titan"><?php echo $book_term -> name?></span>
              </button>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="filters-container topic d-flex flex-column justify-content-between align-items-start">
          <div class="filter-title pb-4 d-flex align-items-center">
            <img src="/wp-content/uploads/learning-arrow-right.png" alt="<?php _e('arrow right','laaldea')?>">
            <span class="h5 font-titan pl-4 color-gray"><?php _e('Por tema','laaldea');?></span>
          </div>
          <?php foreach($laaldea_args['topic_terms'] as $topic_terms) : ?>
            <div class="term-container pb-3 term-<?php echo $topic_terms -> term_id?>">
              <button data-termId="<?php echo $topic_terms -> term_id?>">
                <img src="<?php echo get_field( "category_image", 'category_' . $topic_terms -> term_id );?>" alt="<?php _e('Term image','laaldea');?>">
                <span class="h6 font-titan"><?php echo $topic_terms -> name?></span>
              </button>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="filters-container activities d-flex flex-column justify-content-between align-items-start">
          <div class="filter-title pb-4 d-flex align-items-center">
            <img src="/wp-content/uploads/learning-arrow-right.png" alt="<?php _e('arrow right','laaldea')?>">
            <span class="h5 font-titan pl-4 color-gray"><?php _e('Por actividad','laaldea');?></span>
          </div>
          <?php foreach($laaldea_args['action_terms'] as $action_terms) : ?>
            <div class="term-container pb-3 term-<?php echo $action_terms -> term_id?>">
              <button data-termId="<?php echo $action_terms -> term_id?>">
                <img src="<?php echo get_field( "category_image", 'category_' . $action_terms -> term_id );?>" alt="<?php _e('Term image','laaldea');?>">
                <span class="h6 font-titan"><?php echo $action_terms -> name?></span>
              </button>
            </div>
          <?php endforeach; ?>
        </div>

      </div>

      <div class="col-6 offset-1 main-container">
        <div class="type-filter-container mb-3">
          <button class="video-type-filter-button" data-filter="video">
            <img class="filter-image video" src="/wp-content/uploads/tools-filter-video.png" alt="<?php _e('Imagen filtrar por video','laaldea')?>">
            <div class="text-container h6 font-titan"><?php _e('Video','laaldea');?></div>
          </button>
          <button class="pdf-type-filter-button" data-filter="pdf">
            <img class="filter-image pdf" src="/wp-content/uploads/tools-filter-pdf.png" alt="<?php _e('Imagen filtrar por pdf','laaldea')?>">
            <div class="text-container h6 font-titan"><?php _e('PDF','laaldea');?></div>
          </button>
        </div>

        <div class="tools-container pt-5" data-limit="<?php echo $limit;?>">
          <?php if( $recent_tools -> have_posts() ) : ?>
            <?php while ($recent_tools -> have_posts()) : ?>
              <?php $recent_tools -> the_post(); 
                $post_id = get_the_ID();
                $tool = get_field( "herramienta" );
                $type = get_field( "type" );
                $preview = get_field( "preview" );
                $categories_class = laaldea_get_tools_category_class($post_id);
                $add = laaldea_post_id_in_followed($post_id);
              ?>
              
              <div class="tool-container flex-wrap align-items-end show post-id-<?php echo $post_id;?> type-<?php echo strtolower($type);?> <?php echo $categories_class;?><?php echo $add>0?' type-follow ':'';?>">
                <img class="tool-background-image" src="/wp-content/uploads/tools-single-background.png" alt="<?php _e('Tool item background','laaldea')?>">
                <div class="title title-row pb-3">
                  <h4 class="font-titan"><?php the_title();?></h4>
                </div>
                <div class="left-column description-column pr-5 pb-4">
                  <div class="preview-container d-flex align-items-center pb-4">
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
                    <div class="description-container pl-5">
                      <?php if(!empty(get_the_content())) :?>
                        <?php the_content(); ?>
                      <?php else :?>
                        <p><?php _e('Sin Descripción','laaldea')?></p>
                      <?php endif;?>
                    </div>
                  </div>
                  <div class="follow-container">
                    <button data-postId="<?php echo $post_id;?>" data-add="<?php echo $add; ?>"<?php echo $add==-1?' disabled':'';?>>
                      <img src="/wp-content/uploads/tools-button-follow.png" alt="<?php _e('Imagen añadir a favoritos','laaldea');?>">
                      <span class="follow-text pl-3">
                        <?php 
                          if($add == 0) {
                            _e('Añadir a favoritos','laaldea');
                          }
                          elseif($add > 0) {
                            _e('Remover de favoritos','laaldea');
                          }
                          elseif($add == -1) {
                            _e('Ingresar para agregar a favoritos','laaldea');
                          }
                        ?>
                      </span>
                    </button>
                  </div>
                  <div class="resourse-container pt-2">
                    <button class="link-container color-cyan"><?php echo $tool?></button>
                  </div>
                </div>
                <div class="right-column download-link-column d-flex flex-column pb-4">
                  <a href="<?php echo $tool?>" class="view-link pb-4 type-<?php echo strtolower($type);?>" target="_blank" data-postId="<?php echo $post_id;?>">
                    <?php if($type == 'PDF') : ?>
                      <img src="/wp-content/uploads/tools-filter-pdf.png" title="<?php _e('Ver archivo','laaldea')?>" alt="<?php _e('Imagen descarga pdf', 'laaldea')?>">
                    <?php elseif($type == 'Video') : ?>
                      <img src="/wp-content/uploads/tools-filter-video.png" title="<?php _e('Ver archivo','laaldea')?>" alt="<?php _e('Imagen descarga video', 'laaldea')?>">
                    <?php else : ?>
                      <img src="/wp-content/uploads/tools-filter-pdf.png" title="<?php _e('Ver archivo','laaldea')?>" alt="<?php _e('Imagen descarga general', 'laaldea')?>">
                    <?php endif; ?>
                  </a>
                  <a href="<?php echo $tool?>" download>
                    <?php if($type == 'PDF') : ?>
                      <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga pdf', 'laaldea')?>">
                    <?php elseif($type == 'Video') : ?>
                      <img src="/wp-content/uploads/tools-button-download-video.png" alt="<?php _e('Imagen descarga video', 'laaldea')?>">
                    <?php else : ?>
                      <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga general', 'laaldea')?>">
                    <?php endif; ?>
                  </a>
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