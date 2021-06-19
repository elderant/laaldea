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
          <div class="row filter-row mb-5">
            <div class="col-12 offset-0 col-lg-12 offset-lg-0 col-xl1-12 offset-xl1-0 col-xl-10 offset-xl-1">
              <div class="filter-container d-flex align-items-center">
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
            <div class="col-12 offset-0 order-1 col-lg-9 offset-lg-0 order-lg-1 col-xl1-9 offset-xl1-0 col-xl-8 offset-xl-1 content-column">
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
          <div class="col-12 offset-0 order-2 col-lg-3 offset-lg-0 order-lg-2 col-xl1-3 offset-xl1-0 col-xl-2 filters-column">
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
get_sidebar();
get_footer();
