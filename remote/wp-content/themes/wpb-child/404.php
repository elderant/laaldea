<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WP_Bootstrap_Starter
 */

get_header('learning'); ?>

	<section id="primary" class="content-area col-10 offset-1">
		<div id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="page-content">
          <img src="/wp-content/uploads/404-image.jpg" alt="<?php _e('Pagina no encontrada', 'wpb_child')?>">
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</div><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
