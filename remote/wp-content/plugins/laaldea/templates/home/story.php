<?php
  $page_url = $laaldea_args['page_url'];
  $book_url = add_query_arg( array('template' => 'libro',), $page_url );
  $video_url = add_query_arg( array('template' => 'video',), $page_url );
  $audio_url = add_query_arg( array('template' => 'audio',), $page_url );
  $song_url = add_query_arg( array('template' => 'cancion',), $page_url );
?>

<div id="home-story" class="home-section">
  <section class="container-fluid">
    <div class="row">
      <div class="col-12 position-relative p-0 slider-container">
        <div class="background-container position-absolute">
          <img class="rellax background-part background-main" src="/wp-content/uploads/story-background.jpg" alt="<?php _e('Story and resources background', 'laaldea');?>" data-rellax-speed="1">
          <img class="rellax background-part background-character" src="/wp-content/uploads/story-char-1.png" alt="<?php _e('Ernest image in story section', 'laaldea');?>" data-rellax-speed="-2">
          <img class="rellax background-part background-plant" src="/wp-content/uploads/story-plant-1.png" alt="<?php _e('Plant image in story section', 'laaldea');?>" data-rellax-speed="-1">
        </div>
        <div class="rellax content-container text-left color-gray" data-rellax-speed="2">
          <h2 class="title">
            <?php _e('Historias y recursos','laaldea');?>
          </h2>
          <div class="p">
            <?php _e('¿Qué andará haciendo Arnulfo? ¿Cómo se sentirá Enrique? Encuentra historias, actividades, aventuras y canciones. Diviértete con el universo de La Aldea, sus personajes y ocurrencias.','laaldea');?>
          </div>
          <div class="button-container text-right p d-flex">
            <a href="<?php echo $book_url;?>" class="home-button text-center"><?php _e('Leer', 'laaldea');?></a>
            <a href="<?php echo $video_url;?>" class="home-button text-center"><?php _e('Ver', 'laaldea');?></a>
            <a href="<?php echo $audio_url;?>" class="home-button text-center"><?php _e('Escuchar', 'laaldea');?></a>
            <a href="<?php echo $song_url;?>" class="home-button text-center"><?php _e('Cantar', 'laaldea');?></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>