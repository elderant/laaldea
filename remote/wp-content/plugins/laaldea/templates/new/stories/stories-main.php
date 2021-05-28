<?php 
  $recent_tools = $laaldea_args['recent_tools'];
  $limit = $laaldea_args['limit'];
  $offset = $laaldea_args['offset'];
  $post_count = $laaldea_args['post_count'];
  $requested_tool_id = $laaldea_args['requested_tool_id'];
  $tools_tempate = $laaldea_args['tools_tempate'];
  $tools_class = $laaldea_args['tools_class'];

  $limit = $post_count < $limit? $post_count: $limit;
?>

<div id="stories" class="<?php echo $tools_class;?>">
  <section class="container-fluid">
    <div class="row header-row">
      <div class="col-12 position-relative p-0 characters-container">
        <img class="main-background" src="/wp-content/uploads/stories-header-background.png" alt="<?php _e('Background image','laaldea')?>">
        <div class="content-container color-white">
          <h2 class="title">
            <?php _e('¿Quiénes son los habitantes de La Aldea?','laaldea');?>
          </h2>
          <div class="subtitle uppercase">
            <?php _e('Pasa el cursor sobre cada personaje para averiguarlo','laaldea');?>
          </div>
        </div>
        <div class="character-images">
          <img class="story-header-image plant plant1" src="/wp-content/uploads/stories-header-plant1.png" alt="<?php _e('Plant 4 image','laaldea')?>">
          <img class="story-header-image plant plant2" src="/wp-content/uploads/stories-header-plant2.png" alt="<?php _e('Plant 3 image','laaldea')?>">
          <img class="story-header-image plant plant3" src="/wp-content/uploads/stories-header-plant3.png" alt="<?php _e('Plant 4 image','laaldea')?>">
          <img class="story-header-image plant plant4" src="/wp-content/uploads/stories-header-plant4.png" alt="<?php _e('Plant 3 image','laaldea')?>">
          <img class="story-header-image char opossum" src="/wp-content/uploads/stories-header-opossum.png" alt="<?php _e('Blue opossum image','laaldea')?>">
          <img class="story-header-image char owl" src="/wp-content/uploads/stories-header-owl.png" alt="<?php _e('The owls image','laaldea')?>">
          <img class="story-header-image char ant" src="/wp-content/uploads/stories-header-ant.png" alt="<?php _e('The ants image','laaldea')?>">
          <img class="story-header-image char lucy" src="/wp-content/uploads/stories-header-lucy.png" alt="<?php _e('Lucy image','laaldea')?>">
          <img class="story-header-image char ernest" src="/wp-content/uploads/stories-header-ernest.png" alt="<?php _e('Ernest image','laaldea')?>">
          <img class="story-header-image char arnold" src="/wp-content/uploads/stories-header-arnold.png" alt="<?php _e('Arnold image','laaldea')?>">
          <img class="story-header-image char bee" src="/wp-content/uploads/stories-header-bee.png" alt="<?php _e('The bees image','laaldea')?>">
          <img class="story-header-image char lia" src="/wp-content/uploads/stories-header-lia.png" alt="<?php _e('Lia image','laaldea')?>">
          <img class="story-header-image char harry" src="/wp-content/uploads/stories-header-harry.png" alt="<?php _e('Harry image','laaldea')?>">
          <img class="story-header-image char moorhens" src="/wp-content/uploads/stories-header-moorhen.png" alt="<?php _e('The moorhens image','laaldea')?>">
          <img class="story-header-image char carol" src="/wp-content/uploads/stories-header-carol.png" alt="<?php _e('Carol image','laaldea')?>">
          <img class="story-header-image char peter" src="/wp-content/uploads/stories-header-peter.png" alt="<?php _e('Peter image','laaldea')?>">
          <img class="story-header-image char macaw" src="/wp-content/uploads/stories-header-macaw.png" alt="<?php _e('The Macaws image','laaldea')?>">
          <img class="story-header-image char mouse" src="/wp-content/uploads/stories-header-mouse.png" alt="<?php _e('The mouse image','laaldea')?>">            
        </div>
      </div>
    </div>
 
    <div class="row main-row">
      <div class="col-12 offset-0 order-2 col-lg-3 offset-lg-0 order-lg-1 col-xl1-3 offset-xl1-0 col-xl-2 offset-xl-1 filters-column">
        <div class="tools-sidebar-container" data-top="240">
          <div class="title-container d-flex align-items-center color-green mb-3">
            <h4><?php _e('Recursos','laaldea');?></h4>
          </div>
          <div class="filters-container book d-flex flex-column justify-content-between align-items-start py-3">
            <div class="filter-title">
              <button class="filter-control d-flex align-items-center justify-content-start color-green">
                <div class="filter-text d-flex align-items-center">
                  <span class="h6 m-0 uppercase color-cyan font-sassoon filter-control-name"><?php _e('Por libro','laaldea');?></span>
                </div>
                <div class="filter-icon h6 m-0 color-cyan font-sassoon">
                  <span class="icon">+</span>
                  <span class="icon hidden">-</span>
                </div>
              </button>
            </div>
            <?php foreach($laaldea_args['book_terms'] as $book_term) : ?>
              <div class="term-container hidden pb-1 term-<?php echo $book_term -> term_id; ?>">
                <button class="" data-termId="<?php echo $book_term -> term_id?>">
                  <span class="term-name font-sassoon"><?php echo $book_term -> name?></span>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="filters-container topic d-flex flex-column justify-content-between align-items-start py-3">
            <div class="filter-title d-flex align-items-center">
              <button class="filter-control d-flex align-items-center justify-content-start color-green">
                <div class="filter-text d-flex align-items-center">
                  <span class="h6 m-0 uppercase color-cyan font-sassoon filter-control-name"><?php _e('Por recurso','laaldea');?></span>
                </div>
                <div class="filter-icon h6 m-0 color-cyan font-sassoon">
                  <span class="icon">+</span>
                  <span class="icon hidden">-</span>
                </div>
              </button>
            </div>
            <?php foreach($laaldea_args['topic_terms'] as $topic_terms) : ?>
              <div class="term-container hidden pb-1 term-<?php echo $topic_terms -> term_id?>">
                <button class="" data-termId="<?php echo $topic_terms -> term_id?>">
                  <span class="term-name"><?php echo $topic_terms -> name?></span>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="filters-container tags tag-cloud-container py-3">
            <div class="filter-title d-flex align-items-center">
              <button class="filter-control d-flex align-items-center justify-content-start color-green mb-3">
                <div class="filter-text d-flex align-items-center">
                  <span class="h4 m-0 uppercase color-cyan filter-control-name"><?php _e('Etiquetas','laaldea');?></span>
                </div>
              </button>
            </div>
            <div class="tag-container term-container pt-3">
              <?php 
                $args = array('taxonomy' => array( 'aldea_tool_tag' )); 
                wp_tag_cloud( $args );
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 offset-0 order-1 col-lg-9 offset-lg-0 order-lg-2 col-xl1-9 offset-xl1-0 col-xl-8 content-column">
        <div class="type-filter-container">
          <div class="type-filters-section d-flex align-items-center justify-content-start">
            <div class="filter-label h5 uppercase font-titan color-green m-0"><?php _e('¿Qué quieres ', 'laaldea');?></div>
            <select class="type-select color-green uppercase m-0">
              <option class="uppercase" value="leer">Leer</option>
              <option class="uppercase" value="ver">Ver</option>
              <option class="uppercase" value="escuchar">Escuchar</option>
            </select>
            <div class="filter-label h5 uppercase font-titan color-green m-0"><?php _e(' ?', 'laaldea');?></div>
          </div>
        </div>
        
        <div class="main-container mt-5">
          <?php if($tools_tempate == 'libro') :?>
            <?php $tool_index = 0;?>
            <?php if( $recent_tools -> have_posts() ) : ?>
              <?php while ($recent_tools -> have_posts()) : ?>
                <?php 
                  $recent_tools -> the_post();
                  $post_id = get_the_ID();
                  $type = get_field( "aldea_tool_type", $post_id );
                  laaldea_get_aldea_tool_html($post_id, $type, '', true);
                ?>
                <?php $tool_index = $tool_index + 1;?>
                <?php if($tool_index == 3):?>
                  <div class="flex-break"></div>
                  <?php $tool_index = 0;?>
                <?php endif;?>
              <?php endwhile; ?>
              <?php wp_reset_postdata(); ?>
            <?php endif; ?>
          <?php else:?>
            <?php $featured_terms = $laaldea_args['featured_terms'];?>
            <?php if(count($featured_terms) > 0):?>
              <?php for( $term_index = 0; $term_index <= count($featured_terms) - 1; $term_index++):?>
                <?php $category_tools = laaldea_get_tool_query_for_category($featured_terms[$term_index] -> term_id, $tools_tempate);?>
                <?php if($category_tools): ?>
                  <div class="term-container my-3 term-<?php echo $featured_terms[$term_index]->term_id;?>">
                    <div class="term-tile font-titan color-green h5"><?php echo $featured_terms[$term_index] -> name;?></div>
                    <div class="slick-prev arrow">
                      <i class="fas fa-angle-left"></i>
                    </div>
                    <div class="slick-next arrow">
                      <i class="fas fa-angle-right"></i>
                    </div>
                    <div class="carousel-container">
                      <?php if( $category_tools -> have_posts() ) : ?>
                        <?php while ($category_tools -> have_posts()) : ?>
                          <?php 
                            $category_tools -> the_post();
                            $post_id = get_the_ID();
                            $type = get_field( "aldea_tool_type", $post_id );
                            laaldea_get_aldea_tool_html($post_id, $type, '', true);
                          ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif;?>

              <?php endfor;?>
            <?php endif;?>
          <?php endif;?>
        </div>
      </div>
    </div>
  </section>
</div>