<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- #content -->
    <?php get_template_part( 'footer-widget' ); ?>
	<footer id="colophon" class="learning site-footer <?php echo wp_bootstrap_starter_bg_class(); ?>" role="contentinfo">
		<div class="container py-3">
      <div class="row site-info">
        <div class="col-12 d-flex justify-content-center align-items-center">
          <a href="https://clickarte.co/" target="_blank" rel="external nofollow">
            <img src="/wp-content/uploads/page-click-icon-white.png" alt="<?php __('Icono de click', 'laaldea')?>">
          </a>
          <span class="h6 font-sassoon">&copy; 2020 ClickArte</span>
          <a href="https://mincultura.gov.co/areas/comunicaciones/cultura-digital/creadigital" target="_blank" rel="external nofollow">
            <img src="/wp-content/uploads/page-crea-icon.png" alt="<?php __('Icono de crea', 'laaldea')?>">
          </a>
        </div>
      </div><!-- close .site-info -->
		</div>
	</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>