<?php 
  $main_terms = $laaldea_args['main_terms'];
  $recent_posts = $laaldea_args['recent_posts'];
  $sidebar_posts = $laaldea_args['sidebar_posts'];

  $page = $laaldea_args['page'];
  $max_num_pages = $laaldea_args['max_num_pages'];
  $posts_per_page = $laaldea_args['posts_per_page'];
  $load_more = $laaldea_args['load_more'];
  $term_id = $laaldea_args['term_id'];

  $today = $laaldea_args['today'];
?>

<div id="community">
  <div class="container-fluid">
    
    <div class="row header-row mb-5">
      <div class="col-12 position-relative p-0 header-container">
        <img class="main-background" src="/wp-content/uploads/community-header-background.jpg" alt="<?php _e('Que es La Aldea header background image','laaldea')?>">
        <div class="content-container">
          <h1 class="title color-green"><?php _e('Comunidad de La Aldea','laaldea')?></h1>
          <p class="font-sassoon color-gray uppercase">
            <?php printf(  __( 'Colombia / NO. 1 / %s.', 'laaldea' ), $today);?>
          </p>
        </div>
      </div>
    </div>
    <div class="row filter-row mb-5">
      <div class="col-12 offset-0 col-md-10 offset-md-1 col-lg-12 offset-lg-0 col-xl-10 offset-xl-1">
        <div class="filter-container d-flex flex-wrap align-items-center">
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

    <div class="row content-row">
      <div class="col-12 offset-0 px-5 order-1 col-sm-10 offset-sm-1 px-sm-3 col-md-9 offset-md-0 order-lg-1 col-xl1-8 offset-xl1-1 col-xl-8 offset-xl-1 content-column">
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
      <div class="col-12 offset-0 px-5 pt-3 mt-3 order-2 col-sm-10 offset-sm-1 px-sm-3 col-md-3 offset-md-0 mt-md-0 pt-md-0 order-lg-2 col-xl1-2 offset-xl1-0 col-xl-2 d-flex d-md-block flex-wrap justify-content-center filters-column">
        <?php dynamic_sidebar( 'community-sidebar' ); ?>
        <?php if( $sidebar_posts -> have_posts() ) : ?>
          <?php while ($sidebar_posts -> have_posts()) : ?>
            <?php 
              $sidebar_posts -> the_post();
              $post_id = get_the_ID();
              laaldea_get_community_sidebar_single_html($post_id);
            ?>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php else : ?>
          <div class="post-container">
            <?php _e('Ninguna otra noticia que mostrar','laaldea')?>
          </div>
        <?php endif; ?> 

      </div>
    </div>
  </div>
</div>

