<?php 
  $recent_tools = $laaldea_args['recent_tools'];
  $limit = $laaldea_args['limit'];
  $offset = $laaldea_args['offset'];
  $post_count = $laaldea_args['post_count'];
  $requested_tool_id = $laaldea_args['requested_tool_id'];

  $limit = $post_count < $limit? $post_count: $limit;
?>

<section id="tools" class="d-flex align-items-center justify-content-center">
  <div class="container-fluid">
    <div class="row title-row hidden">
      <h2><?php _e('Contenidos','laaldea');?></h2>
    </div>
    <div class="row tools-row">
      <div class="col-10 offset-1 col-sm-2 offset-sm-1 col-xl1-10 offset-xl1-1 col-xl-2 offset-xl-1 sidebar">
        <div class="tools-sidebar-container" data-top="240">
          <div class="title-container d-flex align-items-center">
            <div class="icon-container">
              <?php include ABSPATH . 'wp-content/uploads/learning-home-tools-icon.svg';?>
            </div>
            <h4><?php _e('Contenidos','laaldea');?></h4>
          </div>
          <div class="filters-container book d-flex flex-column justify-content-between align-items-start pb-3">
            <div class="filter-title pt-3 pb-1">
              <button class="filter-control d-flex align-items-center justify-content-start">
                <div class="filter-text d-flex align-items-center">
                  <span class="h5 m-0 uppercase color-cyan"><?php _e('Por libro','laaldea');?></span>
                </div>
                <div class="filter-icon h5 m-0 px-3 color-cyan">
                  <span class="icon">+</span>
                  <span class="icon hidden">-</span>
                </div>
              </button>
            </div>
            <?php foreach($laaldea_args['book_terms'] as $book_term) : ?>
              <div class="term-container hidden pb-1 term-<?php echo $book_term -> term_id; ?>">
                <button class="" data-termId="<?php echo $book_term -> term_id?>">
                  <span class="h6 font-titan"><?php echo $book_term -> name?></span>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="filters-container topic d-flex flex-column justify-content-between align-items-start pb-3">
            <div class="filter-title pt-3 pb-1 d-flex align-items-center">
              <button class="filter-control d-flex align-items-center justify-content-start">
                <div class="filter-text d-flex align-items-center">
                  <span class="h5 m-0 uppercase color-cyan"><?php _e('Por tema','laaldea');?></span>
                </div>
                <div class="filter-icon h5 m-0 px-3 color-cyan">
                  <span class="icon">+</span>
                  <span class="icon hidden">-</span>
                </div>
              </button>
            </div>
            <?php foreach($laaldea_args['topic_terms'] as $topic_terms) : ?>
              <div class="term-container hidden pb-1 term-<?php echo $topic_terms -> term_id?>">
                <button class="" data-termId="<?php echo $topic_terms -> term_id?>">
                  <span class="h6 font-titan"><?php echo $topic_terms -> name?></span>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="filters-container activities d-flex flex-column justify-content-between align-items-start pb-3">
            <div class="filter-title pt-3 pb-1 d-flex align-items-center">
              <button class="filter-control d-flex align-items-center justify-content-start">
                <div class="filter-text d-flex align-items-center">
                  <span class="h5 m-0 uppercase color-cyan"><?php _e('Por actividad','laaldea');?></span>
                </div>
                <div class="filter-icon h5 m-0 px-3 color-cyan">
                  <span class="icon">+</span>
                  <span class="icon hidden">-</span>
                </div>
              </button>
            </div>
            <?php foreach($laaldea_args['action_terms'] as $action_terms) : ?>
              <div class="term-container hidden pb-1 term-<?php echo $action_terms -> term_id?>">
                <button class="" data-termId="<?php echo $action_terms -> term_id?>">
                  <span class="h6 font-titan"><?php echo $action_terms -> name?></span>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="filters-container follow d-flex flex-column justify-content-between align-items-start pt-3 pb-3">
            <button class="follow-type-filter-button" data-filter="follow">
              <div class="icon-container">
                <?php include ABSPATH . 'wp-content/uploads/tools-filter-follow.svg';?>
              </div>
              <span class="text-container h4 uppercase"><?php _e('Mis Favoritos','laaldea');?></span>
            </button>
          </div>
          <div class="filters-container tags tag-cloud-container py-3">
            <div class="filter-title pt-3 pb-1 d-flex align-items-center">
              <button class="filter-control d-flex align-items-center justify-content-start">
                <div class="filter-text d-flex align-items-center">
                  <span class="h5 m-0 uppercase color-cyan"><?php _e('Etiquetas','laaldea');?></span>
                </div>
                <div class="filter-icon h5 m-0 px-3 color-cyan">
                  <span class="icon">+</span>
                  <span class="icon hidden">-</span>
                </div>
              </button>
            </div>
            <div class="tag-container term-container hidden">
              <?php 
                $args = array('taxonomy' => array( 'tool_tag' )); 
                wp_tag_cloud( $args );
              ?>
            </div>
          </div>
        </div>
      </div>

      <div class="col-10 offset-1 col-sm-8 offset-sm-0 col-xl1-10 offset-xl1-1 col-xl-8 main-container">
        <div class="target-filter-container d-flex align-items-center">
          <div class="filter-label h5 uppercase font-sassoon color-cyan"><?php _e('Filtro: ', 'laaldea');?></div>
          <button class="docente-target-filter-button d-flex align-items-center filter-button inverted" data-filter="docente">
            <div class="text-container h6 m-0 font-sassoon uppercase"><?php _e('Docentes','laaldea');?></div>
          </button>
          <button class="estudiante-target-filter-button d-flex align-items-center filter-button" data-filter="estudiante">
            <div class="text-container h6 m-0 font-sassoon uppercase"><?php _e('Estudiantes','laaldea');?></div>
          </button>
        </div>

        <div class="tools-container" data-limit="<?php echo $limit;?>">
          <?php if(!empty($requested_tool_id)) : ?>
            <?php laaldea_get_tool_html($requested_tool_id, '', true); ?>
          <?php endif;?>

          <?php if( $recent_tools -> have_posts() ) : ?>
            <?php while ($recent_tools -> have_posts()) : ?>
              <?php 
                $recent_tools -> the_post();
                $post_id = get_the_ID();
                laaldea_get_tool_html($post_id, '', true);
              ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
        </div>
          
        <div class="load-more-container">
          <?php if($post_count > $offset) : ?>
            <button class="load-more-link" data-offset="<?php echo $offset;?>">
              <div class="text-container h6 uppercase">
                <span><?php _e('Ver más','laaldea');?></span>
              </div>
              <div class="image-container">
                <!-- <img src="/wp-content/uploads/learning-arrow-down.png" alt="<?php _e('Arrow down image','laaldea'); ?>"> -->
              </div>
            </button>
          <?php endif;?>
        </div>
      </div> <!-- col end -->

    </div> <!-- news-row END -->
  </div>
</section>