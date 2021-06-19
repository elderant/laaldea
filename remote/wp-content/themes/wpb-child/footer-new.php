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
	<footer id="colophon" class="new-home site-footer <?php echo wp_bootstrap_starter_bg_class(); ?>" role="contentinfo">
		<div class="container-fluid pt-4 pb-3">
      <div class="row main-footer">
        <div class="col-5 offset-1 copy-column">
          <p class="copy-text mb-4">
            <?php _e('La Aldea es el proyecto bandera de Click, una agencia de pedagogía ' . 
            'dedicada a imaginar nuevas formas de aprender. Desde 2011, hemos desarrollado ' . 
            'más de 40 proyectos de educación, impactando a más de 1 millón de estudiantes y ' . 
            '5.000 docentes en Colombia, México y Venezuela','laaldea' );?>
          </p>
          <p class="medium mb-0">
            <?php _e('En Click imaginamos, creamos y construimos nuevas formas de aprender.')?>
          </p>
        </div>
        <div class="col-3 socials-column">
          <div class="link-container">
            <a class="uppercase social-link facebook" href="https://www.facebook.com/clickarte.p/" target="_blank" rel="noopener noreferrer">Facebook</a>
          </div>
          <div class="link-container">
            <a class="uppercase social-link instagram" href="https://www.instagram.com/clickarte.p/" target="_blank" rel="noopener noreferrer">Instagram</a>
          </div>
          <div class="link-container">
            <a class="uppercase social-link twitter" href="https://twitter.com/ClickArte_" target="_blank" rel="noopener noreferrer">Twitter</a>
          </div>
          <div class="link-container">
            <a class="uppercase social-link linkedin" href="https://www.linkedin.com/company/click-arte-sas/" target="_blank" rel="noopener noreferrer">Linkedin</a>
          </div>
          <div class="link-container">
            <a class="uppercase social-link flickr" href="#" target="_blank" rel="noopener noreferrer">Flickr</a>
          </div>
        </div>
        <div class="col-3 contact-column">
          <div class="mail mb-3">
            <div class="link-container">
              <a class="uppercase" href="mailto:info@clickarte.co">info@clickarte.co</a>
            </div>
          </div>
          <div class="phone mb-3">
            <div class="link-container">
              <a class="uppercase" href="tel:+573156126756">+57 315 6126756</a>
            </div>
            <div class="link-container">
              <a class="uppercase" href="tel:+5716917191">+57 1 6917191</a>
            </div>
          </div>
          <div class="address">
            <div class="line-1 uppercase">
              <?php _e('Carrera 16 # 85-15 OF 301','laaldea')?>
            </div>
            <div class="line-2 uppercase">
              <?php _e('Bogotá D.C., Colombia','laaldea')?>
            </div>
          </div>
        </div>
      </div>
      <div class="row site-info">
        <div class="col-12 text-center font-titan h6">
          <?php _e('La Aldea &reg;','laaldea');?>
        </div>
      </div><!-- close .site-info -->
		</div>
	</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>