<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */

get_header('fullwidth-new'); ?>

	<section id="primary" class="content-area col-sm-12">
		<div id="main" class="site-main" role="main">
      <?php 
        $main_terms = laaldea_get_community_main_terms();
        $sub_terms = laaldea_get_community_sub_terms($main_terms);
      ?>

      <div id="community" class="single">
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
            <div class="col-12 offset-0 col-md-10 offset-md-1 col-lg-12 offset-lg-0 col-xl-10 offset-xl-1">
              <div class="filter-container d-flex flex-wrap align-items-center">
                <?php foreach($main_terms as $term):?>
                  <a href="/comunidad/?cat_id=<?php echo $term -> term_id;?>" class="filter-button" data-termId="<?php echo $term -> term_id;?>">
                    <div class="filter-title">
                      <?php echo $term -> name;?>
                    </div>
                  </a>
                <?php endforeach;?>
              </div>
            </div>
          </div>
          <div class="row content-row mb-5">
            <div class="col-12 offset-0 px-5 order-1 col-sm-10 offset-sm-1 px-sm-3 col-md-9 offset-md-0 order-lg-1 col-xl1-8 offset-xl1-1 col-xl-8 offset-xl-1 content-column">
              <?php
                while ( have_posts() ) : the_post();
                  get_template_part( 'template-parts/content-community', get_post_format() );
                  the_post_navigation();
                  // If comments are open or we have at least one comment, load up the comment template.
                  if ( comments_open() || get_comments_number() ) :
                    comments_template();
                  endif;
                endwhile; // End of the loop.
              ?>
            </div>
          <div class="col-12 offset-0 px-5 pt-3 mt-3 order-2 col-sm-10 offset-sm-1 px-sm-3 col-md-3 offset-md-0 mt-md-0 pt-md-0 order-lg-2 col-xl1-2 offset-xl1-0 col-xl-2 d-flex d-md-block flex-wrap justify-content-center filters-column">
            <?php dynamic_sidebar( 'community-sidebar' ); ?>
            <?php foreach($sub_terms as $term):?>
              <a href="/comunidad/?term_id=<?php echo $term->term_id;?>" class="filter-button" data-termId="<?php echo $term -> term_id;?>">
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
		</div><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer('new');
