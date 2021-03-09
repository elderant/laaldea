<?php
/**
* Template Name: user Flow
 */

get_header('user-flow');?>

	<section id="primary" class="content-area col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
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
