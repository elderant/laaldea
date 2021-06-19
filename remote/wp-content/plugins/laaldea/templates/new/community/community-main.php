<?php 
  $main_terms = $laaldea_args['main_terms'];
  $sub_terms = $laaldea_args['sub_terms'];
  $recent_posts = $laaldea_args['recent_posts'];

  $page = $laaldea_args['page'];
  $max_num_pages = $laaldea_args['max_num_pages'];
  $posts_per_page = $laaldea_args['posts_per_page'];
  $load_more = $laaldea_args['load_more'];
  $term_id = $laaldea_args['term_id'];
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
            <a href="?cat_id=<?php echo $term -> term_id;?>" class="filter-button" data-termId="<?php echo $term -> term_id;?>">
              <div class="filter-title">
                <?php echo $term -> name;?>
              </div>
            </a>
          <?php endforeach;?>
        </div>
      </div>
    </div>

    <div class="row content-row mb-5">
      <div class="col-12 offset-0 order-1 col-lg-9 offset-lg-0 order-lg-1 col-xl1-9 offset-xl1-0 col-xl-8 offset-xl-1 content-column">
        <div class="posts-container">
          <?php if( $recent_posts -> have_posts() ) : ?>
            <?php while ($recent_posts -> have_posts()) : ?>
              <?php 
                $recent_posts -> the_post();
                $post_id = get_the_ID();
                laaldea_get_community_single_html($post_id);
              ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
        </div>
        <div class="load-more-container text-center">
          <?php if($load_more) : ?>
            <button class="load-more-button uppercase medium" data-term_id="<?php echo $term_id?>" data-post_per_page="<?php echo $posts_per_page;?>" data-page="<?php echo $page?>" data-max_num_pages="<?php echo $max_num_pages?>">
              <div><?php _e('Ver más')?></div>
              <div><i class="fas fa-chevron-down"></i></div>
            </button>
          <?php endif;?>
        </div> 
      </div>
      <div class="col-12 offset-0 order-2 col-lg-3 offset-lg-0 order-lg-2 col-xl1-3 offset-xl1-0 col-xl-2 filters-column">
        <?php dynamic_sidebar( 'community-sidebar' ); ?>
        <?php foreach($sub_terms as $term):?>
          <a href="?term_id=<?php echo $term->term_id;?>" class="filter-button" data-termId="<?php echo $term -> term_id;?>">
            <div class="topic-block position-relative mb-3<?php echo $term -> background_class;?>">
              <div class="filter-name font-titan h6">
                <?php echo $term -> name;?>
              </div>
              <div class="filter-description position-absolute block-content text-left">
                <?php echo $term -> description;?>
              </div>
            </div>
          </a>
        <?php endforeach; ?> 
      </div>
    </div>
  </div>
</div>

