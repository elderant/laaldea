<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- Hotjar Tracking Code for https://laaldea.co/ -->
    <script>
        (function(h,o,t,j,a,r){h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};h._hjSettings={hjid:1753396,hjsv:6};a=o.getElementsByTagName('head')[0];r=o.createElement('script');r.async=1;r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;a.appendChild(r);})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-65852727-21"></script>
    <script>
        window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-65852727-21');
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);    })(window,document,'script','dataLayer','GTM-P2DXKCN');
    </script>
    <!-- End Google Tag Manager -->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P2DXKCN"height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="page" class="site learning">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); ?></a>
    <?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
    <header id="masthead" class="site-header navbar-static-top <?php echo wp_bootstrap_starter_bg_class(); ?>" role="banner">
        <div class="container-fluid d-flex d-lg-block justify-content-center align-items-center py-3 py-sm-5 py-lg-0">
          <?php 
            $user_id = get_current_user_id();
            $user = wp_get_current_user();
            $avatar_url = get_user_meta( $user_id, 'user_avatar', true);
          ?>
          <nav class="navbar primary navbar-expand-sm d-none d-lg-flex">  
            <?php
              wp_nav_menu(array(
              'theme_location'  => 'learning-menu',
              'container'       => 'div',
              'container_id'    => 'learning-nav',
              'container_class' => 'justify-content-end',
              'menu_id'         => false,
              'menu_class'      => 'navbar-nav',
              'depth'           => 3,
              'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
              'walker'          => new wp_bootstrap_navwalker()
              ));
            ?>
          </nav>

          <button class="mobile navbar-toggler collapsed d-block d-lg-none" type="button" data-toggle="collapse" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-brand d-block d-lg-none">
            <a href="<?php echo get_home_url();?>" class="home-link font-titan">La Aldea</a>
          </div>
          <div class="user-link-container d-block d-lg-none">
            <?php if($user_id != 0) : ?>
              <button class="menu-button collapsed" type="button" data-toggle="collapse" data-target="#user-navbar">
                <img src="<?php echo $avatar_url?>" alt="<?php _e('User avatar','wpb_child');?>">
              </button>
            <?php endif;?>
          </div>

          <nav class="navbar mobile-navbar align-items-start navbar-collapse collapse" id="learning-mobile-container" aria-expanded="false" aria-label="Toggle navigation">
            <?php
              wp_nav_menu(array(
              'theme_location'  => 'learning-mobile',
              'container'       => 'div',
              'container_id'    => 'learning-mobile',
              'container_class' => 'justify-content-end',
              'menu_id'         => false,
              'menu_class'      => 'navbar-nav',
              'depth'           => 3,
              'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
              'walker'          => new wp_bootstrap_navwalker()
              ));
            ?>
          </nav>
          <?php if($user_id != 0) : ?>
            <nav class="navbar user-navbar flex-column flex-nowrap" id="user-navbar">
              <div class="container-fluid user-navbar-container">
                <div class="row menu-header">
                  <div class="col-12 text-center">
                    <div class="user-avatar pb-3">
                      <img src="<?php echo $avatar_url;?>" alt="<?php _e('User avatar','wpb_child');?>">
                    </div>
                    <div class="user-name">
                      <?php echo $user -> data -> display_name; ?>
                    </div>
                    <div class="user-email pb-3">
                      <?php echo $user -> data -> user_email; ?>
                    </div>
                    <div class="user-edit-link-container font-titan">
                      <a class="user-edit" href="<?php echo 'https://laaldea.co/editar-usuario/'?>"><?php _e('Editar Usuario','laaldea')?></a>
                    </div>
                    <div class="user-edit-link-container font-titan">
                      <a class="forgot-password" href="<?php echo esc_url( get_permalink(879) ); ?>"><?php _e('Cambio Contraseña','laaldea')?></a>
                    </div>
                  </div>
                </div>

                <?php
                  wp_nav_menu(array(
                  'theme_location'  => 'learning-user',
                  'container'       => 'div',
                  'container_id'    => 'learning-user-nav',
                  'container_class' => 'user-menu-list row',
                  'menu_id'         => false,
                  'menu_class'      => 'navbar-nav col-12 text-center',
                  'depth'           => 3,
                  'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                  'walker'          => new wp_bootstrap_navwalker()
                  ));
                ?>
              </div>
            </nav>
          <?php endif;?>
        </div>
	</header><!-- #masthead -->
    <?php if(is_front_page() && !get_theme_mod( 'header_banner_visibility' )): ?>
        <div id="page-sub-header" <?php if(has_header_image()) { ?>style="background-image: url('<?php header_image(); ?>');" <?php } ?>>
            <div class="container">
                <h1>
                    <?php
                    if(get_theme_mod( 'header_banner_title_setting' )){
                        echo get_theme_mod( 'header_banner_title_setting' );
                    }else{
                        echo 'WordPress + Bootstrap';
                    }
                    ?>
                </h1>
                <p>
                    <?php
                    if(get_theme_mod( 'header_banner_tagline_setting' )){
                        echo get_theme_mod( 'header_banner_tagline_setting' );
                }else{
                        echo esc_html__('To customize the contents of this header banner and other elements of your site, go to Dashboard > Appearance > Customize','wp-bootstrap-starter');
                    }
                    ?>
                </p>
                <a href="#content" class="page-scroller"><i class="fa fa-fw fa-angle-down"></i></a>
            </div>
        </div>
    <?php endif; ?>
	<div id="content" class="site-content">
		<div class="container-fluid">
			<div class="row">
                <?php endif; ?>