<div id="radio">
  <section class="container-fluid">
    <div class="row header-row mb-5">
      <div class="col-12 position-relative p-0 characters-container">
        <img class="main-background" src="/wp-content/uploads/radio-header-banner.png" alt="<?php _e('Radio header background image','laaldea')?>">
        <div class="content-container h4">
          <h1 class="title capitalized color-green">
            <?php _e('Al aire con Enrique','laaldea');?>
          </h1>
          <div class="allies-icons-container d-flex align-items-center justify-content-between">
            <img class="ally-icon rescue" src="/wp-content/uploads/radio-header-logo-rescue.png" alt="<?php _e('International Rescue Committee Logo','laaldea')?>">
            <div class="vertical-inner-container d-flex flex-column align-items-center justify-content-between">
              <img class="ally-icon lego" src="/wp-content/uploads/radio-header-logo-lego.png" alt="<?php _e('The Lego Foundation Logo','laaldea')?>">  
              <img class="ally-icon aldea" src="/wp-content/uploads/radio-header-logo-aldea.png" alt="<?php _e('La Aldea Logo','laaldea')?>">  
            </div>
            <img class="ally-icon enrique" src="/wp-content/uploads/radio-header-logo-enrique.png" alt="<?php _e('Al Aire con Enrique Logo','laaldea')?>">
            <img class="ally-icon click" src="/wp-content/uploads/radio-header-logo-click.png" alt="<?php _e('Clickarte Logo','laaldea')?>">
            <img class="ally-icon rcn" src="/wp-content/uploads/radio-header-logo-rcn.png" alt="<?php _e('RCN Radio Logo','laaldea')?>">
          </div>
          <div class="subtitle uppercase color-white">
            <?php $subtitle = sprintf( 
              wp_kses( 
                __( 'Sintoniza todos los sábados <span class="medium">en rcn radio</span>.', 'laaldea' ), 
                array(  
                  'span' => array('class' => array())
                ) 
              ) 
            );?>
            <?php echo $subtitle; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row intro-row  mb-5 d-none">
      <div class="col-8 offset-2">
        <p class="text-center color-green medium uppercase">
          <?php _e('Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit accusantium vel sunt blanditiis aspernatur cum voluptatum, doloremque consequatur itaque natus iste facere, quam ratione modi rem nesciunt obcaecati facilis sint?. sit amet consectetur adipisicing elit. Impedit accusantium vel sunt blanditiis aspernatur cum voluptatum. sit amet consectetur adipisicing elit. Impedit accusantium vel sunt blanditiis aspernatur cum voluptatum. sit amet consectetur adipisicing elit. Impedit accusantium vel sunt blanditiis aspernatur cum voluptatum.', 'laaldea'); ?>
        </p>
      </div>
    </div>
    <div class="row featured-row mb-5">
      <div class="col-10 offset-1">
        <?php $featured = $laaldea_args['featured'];?>
        <?php if( $featured -> have_posts() ) : ?>
          <?php while ($featured -> have_posts()) : ?>
            <?php 
              $featured -> the_post();
              $post_id = get_the_ID();
              laaldea_get_radio_featured_track_html($post_id);
            ?>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="row main-row">
      <div class="col-5 offset-1">
        <div class="h4 section-title recent-title color-green font-sassoon medium mb-3 uppercase">
          <?php _e('Recientes', 'laaldea');?>
        </div>
        <?php $recent = $laaldea_args['recent_tracks'];?>
        <?php if( $recent -> have_posts() ) : ?>
          <?php while ($recent -> have_posts()) : ?>
            <div class="track-container mb-3">
              <?php 
                $recent -> the_post();
                $post_id = get_the_ID();
                laaldea_get_radio_track_html($post_id);
              ?>
            </div>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>
      <div class="col-5 slider-column">
        <div class="h4 section-title coming-title color-green font-sassoon medium mb-3 uppercase">
          <?php _e('Póximamente', 'laaldea');?>
        </div>
        <div class="carousel-container d-flex align-items-center justify-content-between">
          <div class="slick-prev arrow">
            <i class="fas fa-angle-left"></i>
          </div>
          <div class="slick-next arrow">
            <i class="fas fa-angle-right"></i>
          </div>
          <div class="coming-carousel">
            <div class="slide-container">
              <img src="/wp-content/uploads/radio-slider-slide1.jpg" alt="<?php _e('Slider image 1','laaldea')?>">
            </div> 
            <div class="slide-container">
              <img src="/wp-content/uploads/radio-slider-slide1.jpg" alt="<?php _e('Slider image 2','laaldea')?>">
            </div> 
          </div>
        </div>
      </div>
    </div>
  </section>
</div>