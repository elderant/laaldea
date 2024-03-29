<?php $page_url = $laaldea_args['page_url'];?>
<div id="home-community" class="home-section">
  <section class="container-fluid">
    <div class="row">
      <div class="col-12 position-relative p-0 slider-container">
        <div class="background-container position-absolute">
          <img class="rellax background-part background-main" src="/wp-content/uploads/community-background.jpg" alt="<?php _e('Community background', 'laaldea');?>" data-rellax-speed="1">
          <img class="rellax background-part background-character" src="/wp-content/uploads/community-char-1.png" alt="<?php _e('Arnold image in story section', 'laaldea');?>" data-rellax-speed="-0.5">
          <img class="rellax background-part background-plant" src="/wp-content/uploads/community-plant-1.png" alt="<?php _e('Community a plant image', 'laaldea');?>" data-rellax-speed="-1">
        </div>
        <div class="rellax content-container text-left color-white" data-rellax-speed="2">
          <h2 class="title">
            <div><?php _e('Comunidad','laaldea');?></div>
          </h2>
          <div class="p">
            <?php _e('La Aldea ha llegado a más de 100.000 familias y más de 5.000 docentes en la Guajira, Barranquilla, Cúcuta, Nariño, e incluso, ya descargó sus maletas en México y Venezuela. Nuestra comunidad es cada vez más grande y queremos que estés enterado de todo lo que ocurre.','laaldea');?>
          </div>
          <div class="button-container text-right p d-flex">
            <a href="<?php echo $page_url;?>" class="home-button right"><?php _e('Entérate', 'laaldea');?></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>