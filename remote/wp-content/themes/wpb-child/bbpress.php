<?php
/**
* Base forum template
 */

get_header('learning');?>

  <?php if( bbp_is_forum_archive() ) : ?>
    <div id="sidebar-main" class="sidebar offset-1 col-2">
      <?php dynamic_sidebar( 'forum-sidebar' ); ?>
    </div>
	  <section id="primary" class="content-area col-sm-8 forum">
  <?php else: ?>
    <section id="primary" class="content-area offset-1 col-sm-10 forum">
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
<?php get_footer(); ?>
<?php
