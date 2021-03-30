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
      <div class="col-12 offset-0 order-2 col-lg-3 offset-lg-0 order-lg-1 col-xl1-3 offset-xl1-0 col-xl-2 offset-xl-1 sidebar">
        <div class="tools-sidebar-container" data-top="240">
          <div class="title-container d-flex align-items-center mb-3">
            <div class="icon-container">
              <?php include ABSPATH . 'wp-content/uploads/learning-home-tools-icon.svg';?>
            </div>
            <h4><?php _e('Contenidos','laaldea');?></h4>
          </div>
          <div class="filters-container book d-flex flex-column justify-content-between align-items-start py-3">
            <div class="filter-title">
              <button class="filter-control d-flex align-items-center justify-content-start">
                <div class="filter-text d-flex align-items-center">
                  <span class="h5 m-0 uppercase color-cyan"><?php _e('Por libro','laaldea');?></span>
                </div>
                <div class="filter-icon h5 m-0 color-cyan">
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
          <div class="filters-container topic d-flex flex-column justify-content-between align-items-start py-3">
            <div class="filter-title d-flex align-items-center">
              <button class="filter-control d-flex align-items-center justify-content-start">
                <div class="filter-text d-flex align-items-center">
                  <span class="h5 m-0 uppercase color-cyan"><?php _e('Por recurso','laaldea');?></span>
                </div>
                <div class="filter-icon h5 m-0 color-cyan">
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
          <div class="filters-container follow d-flex flex-column justify-content-between align-items-start py-3">
            <button class="follow-type-filter-button" data-filter="follow">
              <div class="icon-container">
                <?php include ABSPATH . 'wp-content/uploads/tools-filter-follow.svg';?>
              </div>
              <span class="text-container h4 uppercase"><?php _e('Mis Favoritos','laaldea');?></span>
            </button>
          </div>
          <div class="filters-container tags tag-cloud-container py-3">
            <div class="filter-title d-flex align-items-center">
              <button class="filter-control d-flex align-items-center justify-content-start mb-3">
                <div class="icon-container">
                  <?php include ABSPATH . 'wp-content/uploads/tools-filter-follow.svg';?>
                </div>
                <div class="filter-text d-flex align-items-center">
                  <span class="h4 m-0 uppercase color-cyan"><?php _e('Etiquetas','laaldea');?></span>
                </div>
              </button>
            </div>
            <div class="tag-container term-container pt-3">
              <?php 
                $args = array('taxonomy' => array( 'tool_tag' )); 
                wp_tag_cloud( $args );
              ?>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 offset-0 order-1 col-lg-9 offset-lg-0 order-lg-2 col-xl1-9 offset-xl1-0 col-xl-8 main-container">
        <div class="target-filter-container d-flex align-items-center justify-content-between flex-column flex-md-row">
          <div class="target-filters-section d-flex align-items-center flex-column flex-sm-row">
            <div class="filter-label h5 uppercase font-sassoon color-cyan"><?php _e('Filtro: ', 'laaldea');?></div>
            <button class="docente-target-filter-button d-flex align-items-center filter-button" data-filter="docente">
              <div class="text-container h6 m-0 font-sassoon uppercase"><?php _e('Docentes','laaldea');?></div>
            </button>
            <button class="estudiante-target-filter-button d-flex align-items-center filter-button" data-filter="estudiante">
              <div class="text-container h6 m-0 font-sassoon uppercase"><?php _e('Estudiantes','laaldea');?></div>
            </button>
          </div>
          <div class="search-section">
            <?php $error = get_transient( 'laaldea_activation_error' ); ?>
            <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" class="learning-form d-flex justify-content-end">
              <div class="search-container input-container">
                <?php $class=""; ?>
                <?php if ( isset($error['tool_search'] ) ) : ?>
                  <?php $class=" error"; ?>
                <?php endif;?>
                <input type="text" name="tool_search" value="" id="tool-search" class="<?php echo $class?>"/>
              </div>
              <div class="form-actions input-container">
                <input type="submit" value="<?php _e('Buscar', 'laaldea'); ?>" class="button h5" />
              </div>
              <div style="display: none;">
                <input type="hidden" name="action" value="laaldea_tools_seach">
              </div>
            </form>
          </div>
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
            </button>
          <?php endif;?>
        </div>
      </div> <!-- col end -->

    </div> <!-- news-row END -->
  </div>
</section>