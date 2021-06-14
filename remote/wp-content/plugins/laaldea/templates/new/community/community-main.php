<?php 
  $main_terms = $laaldea_args['main_terms'];
  $sub_terms = $laaldea_args['sub_terms'];
  $recent_posts = $laaldea_args['recent_posts'];
?>

<div id="community">
  <div class="container-fluid">
    
    <div class="row header-row mb-5">
      <div class="col-12 position-relative p-0 header-container">
        <img class="main-background" src="/wp-content/uploads/community-header-background.jpg" alt="<?php _e('Que es La Aldea header background image','laaldea')?>">
        <div class="content-container">
          <h1 class="title color-green"><?php _e('Comunidad de La Aldea','laaldea')?></h1>
          <p class="font-sassoon color-gray uppercase"><?php _e('Colombia / NO. 1 / 24 de Diciembre del 2020.', 'laaldea')?></p>
        </div>
      </div>
    </div>
    <div class="row filter-row mb-5">
      <div class="col-12 offset-0 col-lg-12 offset-lg-0 col-xl1-12 offset-xl1-0 col-xl-10 offset-xl-1">
        <div class="filter-container d-flex align-items-center">
          <?php foreach($main_terms as $term):?>
            <button class="filter-button" data-termId="<?php echo $term -> term_id;?>">
              <div class="filter-title">
                <?php echo $term -> name;?>
              </div>
            </button>
          <?php endforeach;?>
        </div>
      </div>
    </div>

    <div class="row content-row mb-5">
      <div class="col-12 offset-0 order-1 col-lg-9 offset-lg-0 order-lg-1 col-xl1-9 offset-xl1-0 col-xl-8 offset-xl-1 content-column">
        <?php if( $recent_posts -> have_posts() ) : ?>
          <?php while ($recent_posts -> have_posts()) : ?>
            <?php 
              $recent_posts -> the_post();
              $post_id = get_the_ID();
              //$type = get_field( "aldea_tool_type", $post_id );
              //laaldea_get_aldea_tool_html($post_id, $type, '', true);
            ?>
            
            <div class="post-container pb-5">
              <div class="post-thumbnail-container mb-3 text-center">
                <a href="<?php get_permalink($post_id);?>">
                  <?php echo get_the_post_thumbnail($post_id, 'large');?>
                </a>
              </div>
              <div class="post-title-container mb-3">
                <a href="<?php get_permalink($post_id);?>">
                  <h2><?php echo get_the_title($post_id);?></h2>
                </a>
              </div>
              <div class="post-excerpt-container">
                <?php echo get_the_excerpt($post_id);?>
              </div>
            </div>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>   
      </div>
      <div class="col-12 offset-0 order-2 col-lg-3 offset-lg-0 order-lg-2 col-xl1-3 offset-xl1-0 col-xl-2 filters-column">
        <?php dynamic_sidebar( 'community-sidebar' ); ?>
        <?php foreach($sub_terms as $term):?>
          <button class="filter-button" data-termId="<?php echo $term -> term_id;?>">
            <div class="topic-block position-relative mb-3<?php echo $term -> background_class;?>">
              <div class="filter-name font-titan h6">
                <?php echo $term -> name;?>
              </div>
              <div class="filter-description position-absolute block-content text-left">
                <?php echo $term -> description;?>
              </div>
            </div>
          </button>
        <?php endforeach; ?>
        
      </div>
    </div>
  </div>
</div>

