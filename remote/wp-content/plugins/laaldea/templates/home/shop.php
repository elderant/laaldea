<?php $page_url = $laaldea_args['page_url'];?>
<div id="home-shop" class="home-section">
  <section class="container-fluid">
    <div class="row">
      <div class="col-12 position-relative p-0 slider-container">
        <div class="background-container position-absolute">
          <img class="rellax background-part background-main" src="/wp-content/uploads/shop-background.jpg" alt="<?php _e('Shop background', 'laaldea');?>" data-rellax-speed="1">
          <img class="rellax background-part background-character" src="/wp-content/uploads/shop-char-1.png" alt="<?php _e('Owl image in story section', 'laaldea');?>" data-rellax-speed="-0.5">
          <img class="rellax background-part background-plant" src="/wp-content/uploads/shop-plant-1.png" alt="<?php _e('Community a plant image', 'laaldea');?>" data-rellax-speed="-1">
        </div>
        <div class="rellax content-container text-right color-white" data-rellax-speed="2">
          <h2 class="title">
            <?php _e('Tienda','laaldea');?>
          </h2>
          <div class="p">
            <?php _e('¿Quieres tener las últimas historias de La Aldea en tus manos? Puedes encontrar todos los libros, títeres y recursos pedagógicos en nuestra tienda virtual.','laaldea');?>
          </div>
          <div class="button-container text-right p d-flex">
            <a href="<?php echo $page_url;?>" class="home-button right"><?php _e('Compra los libros', 'laaldea');?></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>