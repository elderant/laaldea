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
      <div class="col-3 offset-1 sidebar">
        <div class="title-container d-flex align-items-center pb-5">
          <img src="/wp-content/uploads/tools-icon.png" alt="<?php _e('Herramientas icon', 'laaldea'); ?>">
          <h4><?php _e('Contenidos','laaldea');?></h4>
        </div>
        <div class="filters-container follow d-flex flex-column justify-content-between align-items-start pb-5">
          <button class="follow-type-filter-button pl-5" data-filter="follow">
            <img class="filter-image follow" src="/wp-content/uploads/tools-filter-follow.png" alt="<?php _e('Imagen filtrar por favoritos','laaldea')?>">
            <span class="text-container h6 font-titan"><?php _e('Mis Favoritos','laaldea');?></span>
          </button>
        </div>
        <div class="filters-container book d-flex flex-column justify-content-between align-items-start">
          <div class="filter-title py-4">
            <button class="filter-contol d-flex align-items-center justify-content-between">
              <div class="filter-text d-flex align-items-center">
                <span class="h5 font-titan color-gray"><?php _e('Por libro','laaldea');?></span>
              </div>
              <div class="filter-icon h5">
                <span class="icon font-titan">+</span>
                <span class="icon hidden font-titan">-</span>
              </div>
            </button>
          </div>
          <?php foreach($laaldea_args['book_terms'] as $book_term) : ?>
            <div class="term-container hidden pb-3 term-<?php echo $book_term -> term_id; ?>">
              <button class="pl-5" data-termId="<?php echo $book_term -> term_id?>">
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
                <span class="h5 font-titan color-gray"><?php _e('Por tema','laaldea');?></span>
              </div>
              <div class="filter-icon h5">
                <span class="icon font-titan">+</span>
                <span class="icon hidden font-titan">-</span>
              </div>
            </button>
          </div>
          <?php foreach($laaldea_args['topic_terms'] as $topic_terms) : ?>
            <div class="term-container hidden pb-3 term-<?php echo $topic_terms -> term_id?>">
              <button class="pl-5" data-termId="<?php echo $topic_terms -> term_id?>">
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
                <span class="h5 font-titan color-gray"><?php _e('Por actividad','laaldea');?></span>
              </div>
              <div class="filter-icon h5">
                <span class="icon font-titan">+</span>
                <span class="icon hidden font-titan">-</span>
              </div>
            </button>
          </div>
          <?php foreach($laaldea_args['action_terms'] as $action_terms) : ?>
            <div class="term-container hidden pb-3 term-<?php echo $action_terms -> term_id?>">
              <button class="pl-5" data-termId="<?php echo $action_terms -> term_id?>">
                <img src="<?php echo get_field( "category_image", 'category_' . $action_terms -> term_id );?>" alt="<?php _e('Term image','laaldea');?>">
                <span class="h6 font-titan"><?php echo $action_terms -> name?></span>
              </button>
            </div>
          <?php endforeach; ?>
        </div>

      </div>

      <div class="col-7 main-container">
        <div class="target-filter-container pb-4 d-flex align-items-center">
          <button class="docente-target-filter-button d-flex align-items-center" data-filter="docente">
            <img class="filter-image docente" src="/wp-content/uploads/tools-filter-video.png" alt="<?php _e('Imagen filtrar para docentes','laaldea')?>">
            <div class="text-container h6 font-titan"><?php _e('Para docentes','laaldea');?></div>
          </button>
          <button class="estudiante-target-filter-button d-flex align-items-center" data-filter="estudiante">
            <img class="filter-image estudiante" src="/wp-content/uploads/tools-filter-pdf.png" alt="<?php _e('Imagen filtrar para estudiantes','laaldea')?>">
            <div class="text-container h6 font-titan"><?php _e('Para Estudiantes','laaldea');?></div>
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