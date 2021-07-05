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
        <div class="col-12 offset-0 mb-5 col-sm-10 offset-sm-1 col-md-3 mb-md-0 text-center text-md-left copy-column">
          <div class="h6"><p class="medium p-0 pb-2 m-0 font-sassoon">Imaginado por</p></div>
          <div class="logo-container">
            <a href="http://clickarte.co/" target="_blank" rel="noopener noreferrer">
              <?php include ABSPATH . '/wp-content/uploads/click-logo.svg';?>
            </a>
          </div>
        </div>
        <div class="col-12 mb-5 col-sm-10 offset-sm-1 col-md-4 offset-md-0 mb-md-0 col-xl-4 text-center text-sm-left d-flex flex-wrap flex-column justify-content-around align-items-center flex-sm-row socials-column">
          <div class="link-container linkedin-container">
              <a class="uppercase social-link linkedin" href="https://www.linkedin.com/company/click-arte-sas/" target="_blank" rel="noopener noreferrer">
                <?php include ABSPATH . '/wp-content/uploads/linkedin-icon.svg';?>
              </a>
          </div>
          <div class="link-container instagram-container">
            <a class="uppercase social-link instagram" href="https://www.instagram.com/clickarte.p/" target="_blank" rel="noopener noreferrer">
              <?php include ABSPATH . '/wp-content/uploads/instagram-icon.svg';?>
            </a>
          </div>  
          <div class="link-container facebook-container">
            <a class="uppercase social-link facebook" href="https://www.facebook.com/clickarte.p/" target="_blank" rel="noopener noreferrer">
              <?php include ABSPATH . '/wp-content/uploads/facebook-icon.svg';?>
            </a>
          </div>
          <div class="link-container twitter-container">
            <a class="uppercase social-link twitter" href="https://twitter.com/ClickArte_" target="_blank" rel="noopener noreferrer">
              <?php include ABSPATH . '/wp-content/uploads/twitter-icon.svg';?>
            </a>
          </div>
          <div class="link-container flickr-container">
            <a class="uppercase social-link flickr" href="#" target="_blank" rel="noopener noreferrer">
              <?php include ABSPATH . '/wp-content/uploads/flickr-icon.svg';?>
            </a>
          </div>
        </div>
        <div class="col-12 mb-3 offset-0 col-sm-10 offset-sm-1 col-md-3 offset-md-0 mb-md-0 col-xl-3 text-center text-sm-left d-flex flex-wrap flex-column justify-content-center align-items-center align-items-md-end contact-column">
          <div class="mail mb-3">
            <div class="link-container">
              <a class="uppercase" href="mailto:info@clickarte.co">info@clickarte.co</a>
            </div>
          </div>
          <div class="bottom-container d-flex flex-wrap flex-column align-items-center align-items-md-end">
            <div class="info-container phone mb-0 mb-md-2">
              <div class="link-container">
                <a class="uppercase" href="tel:+573118068886">+57 311 806 8886</a>
              </div>
              <div class="link-container">
                <a class="uppercase" href="tel:+5716917191">+57 1 691 7191</a>
              </div>
            </div>
            <div class="info-container address">
              <div class="line-1 uppercase">
                <?php _e('Carrera 16 # 85-15 Oficina 301','laaldea')?>
              </div>
              <div class="line-2 uppercase">
                <?php _e('Bogotá D.C., Colombia','laaldea')?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row site-info pt-2">
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