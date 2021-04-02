<?php
/**
* Base forum template
 */

get_header('learning');?>

  <?php if( bbp_is_forum_archive() ) : ?>
    <div id="sidebar-main" class="sidebar col-12 order-2 col-sm-10 offset-sm-1 col-lg-2 offset-lg-1 order-lg-1 col-xl1-3 offset-xl1-0 col-xl-2 offset-xl-1 line-height-12">
      <?php dynamic_sidebar( 'forum-sidebar' ); ?>
    </div>
	  <section id="primary" class="content-area col-12 order-1 col-sm-10 offset-sm-1 col-lg-8 offset-lg-0 order-lg-2 col-xl1-9 col-xl-8 forum-section">
  <?php elseif( bbp_is_single_forum() ) : ?>
    <div id="sidebar-main" class="sidebar col-12 order-2 col-sm-10 offset-sm-1 col-lg-2 offset-lg-1 order-lg-1 col-xl1-3 offset-xl1-0 col-xl-2 offset-xl-1 line-height-12">
      <?php dynamic_sidebar( 'topic-sidebar' ); ?>
    </div>
	  <section id="primary" class="content-area col-12 order-1 col-sm-10 offset-sm-1 col-lg-8 offset-lg-0 order-lg-2 col-xl1-9 col-xl-8 topic-section">
  <?php elseif( bbp_is_single_topic() ) : ?>
    <div id="sidebar-main" class="sidebar col-12 order-2 col-sm-10 offset-sm-1 col-lg-2 offset-lg-1 order-lg-1 col-xl1-3 offset-xl1-0 col-xl-2 offset-xl-1 line-height-12">
      <?php dynamic_sidebar( 'replies-sidebar' ); ?>
    </div>
	  <section id="primary" class="content-area col-12 order-1 col-sm-10 offset-sm-1 col-lg-8 offset-lg-0 order-lg-2 col-xl1-9 col-xl-8 replies-section">
  <?php elseif( bbp_is_reply_edit() ) : ?>
    <div id="sidebar-main" class="sidebar col-12 order-2 col-sm-10 offset-sm-1 col-lg-2 offset-lg-1 order-lg-1 col-xl1-3 offset-xl1-0 col-xl-2 offset-xl-1 line-height-12">
      <?php dynamic_sidebar( 'replies-sidebar' ); ?>
    </div>
	  <section id="primary" class="content-area col-12 order-1 col-sm-10 offset-sm-1 col-lg-8 offset-lg-0 order-lg-2 col-xl1-9 col-xl-8 reply-edit-section">
  <?php elseif( bbp_is_single_user() ) : ?>
	  <section id="primary" class="content-area col-sm-12 user">
  <?php else: ?>
    <section id="primary" class="content-area offset-1 col-sm-10 general-section">
  <?php endif; ?>
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->
<?php get_footer('learning'); ?>
<?php
