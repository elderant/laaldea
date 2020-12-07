<?php 
  $post_id = $laaldea_args['post_id'];
  $title = $laaldea_args['title'];
  $has_thumbnail = $laaldea_args['has_thumbnail'];
  $thumbnail = $laaldea_args['thumbnail'];
  $type = $laaldea_args['type'];
  $link = $laaldea_args['link'];
  $content = $laaldea_args['content'];
  $container_class = $laaldea_args['container_class'];
  $follow_status = $laaldea_args['follow_status'];
  $tool = $laaldea_args['tool'];
?>

<div class="<?php echo $container_class; ?>">
  <img class="tool-background-image" src="/wp-content/uploads/tools-single-background.png" alt="<?php _e('Tool item background','laaldea')?>">
  <div class="row top-row py-3">
    <div class="col-8 title-column">
      <h4 class="font-titan"><?php echo $title;?></h4>
    </div>
    <div class="col-3 follow-column text-right">
      <button data-postId="<?php echo $post_id;?>" data-add="<?php echo $add; ?>"<?php echo $add==-1?' disabled':'';?>>
        <img src="/wp-content/uploads/tools-button-follow.png" alt="<?php _e('Imagen añadir a favoritos','laaldea');?>">
      </button>
    </div>
  </div>
  <div class="row middle-row pb-3">
    <div class="col-4 thumbnail-container d-flex align-items-center justify-content-center">
      <a href="<?php echo $tool?>" class="view-link type-<?php echo strtolower($type);?>" target="_blank" data-postId="<?php echo $post_id;?>" data-type="<?php echo strtolower($type);?>" data-link="<?php echo $link;?>">
        <?php if($has_thumbnail) :?>
          <?php echo $thumbnail; ?>
        <?php else :?>
          <img src="/wp-content/uploads/tools-default-thumb-background.jpg" alt="<?php _e('Default Thumbnail pdf', 'laaldea')?>">
          <span class="default-text d-flex align-items-center justify-content-center">
            <?php if($type == 'PDF') : ?>
              <?php _e('PDF', 'laaldea')?>
            <?php elseif($type == 'Video') : ?>
              <?php _e('Video', 'laaldea')?>
            <?php elseif($type == 'Audio') : ?>
              <?php _e('Audio', 'laaldea')?>
            <?php else : ?>
              <?php _e('Herramienta', 'laaldea')?>
            <?php endif; ?>
          </span>
        <?php endif;?>
      </a>
    </div>
    <div class="col-7 d-flex align-items-center description-container">
      <?php if(!empty($content)) :?>
        <?php echo $content; ?>
      <?php else :?>
        <p><?php _e('Sin Descripción','laaldea')?></p>
      <?php endif;?>
    </div>
  </div>
  <div class="row bottom-row pb-3">
    <div class="col-8 resource-column d-flex align-items-center justify-content-start">
      <button class="link-container color-cyan"><?php echo $tool?></button>
    </div>
    <div class="col-3 download-link-column d-flex align-items-center justify-content-end">
      <a class="text-center" href="<?php echo $tool?>" download>
        <?php if($type == 'PDF') : ?>
          <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga pdf', 'laaldea')?>">
        <?php elseif($type == 'Video') : ?>
          <img src="/wp-content/uploads/tools-button-download-video.png" alt="<?php _e('Imagen descarga video', 'laaldea')?>">
        <?php elseif($type == 'Audio') : ?>
          <img src="/wp-content/uploads/tools-button-download-video.png" alt="<?php _e('Imagen descarga audio', 'laaldea')?>">
        <?php else : ?>
          <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga general', 'laaldea')?>">
        <?php endif; ?>
        <div class="download-text">
          <?php _e('Descarga aquí','laaldea');?>
        </div>
      </a>
    </div>
  </div>
  <div class="row related-row pb-3">
  <div class="col-12">
    <?php if(sizeOf($related) > 0) : ?>
      <h6><?php _e('Herramientas relacionadas','laaldea');?></h6>
    <?php endif; ?>
  </div>
  <?php for ($i = 0; $i <= sizeOf($related) - 1; $i++ ) : ?>
    <?php  
      $related_post_id = $related[$i];
      $related_tool = get_field( "herramienta", $related_post_id );
      $related_type = get_field( "type", $related_post_id );
      $related_link = $related_type == 'Video'? get_field( "link_youtube", $related_post_id ):'';
      $related_title = get_the_title( $related_post_id );
    ?>
    <div class="related-tool-container col-11">
      <a href="<?php echo $related_tool?>" class="view-link-rel type-<?php echo strtolower($related_type);?>" target="_blank" data-postId="<?php echo $related_post_id;?>" data-link="<?php echo $link;?>">
        <?php echo $related_title;?>
      </a>
      <a class="text-center down-link-rel" href="<?php echo $related_tool?>" download>
        <?php if($related_type == 'PDF') : ?>
          <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga pdf', 'laaldea')?>">
        <?php elseif($related_type == 'Video') : ?>
          <img src="/wp-content/uploads/tools-button-download-video.png" alt="<?php _e('Imagen descarga video', 'laaldea')?>">
        <?php elseif($related_type == 'Audio') : ?>
          <img src="/wp-content/uploads/tools-button-download-video.png" alt="<?php _e('Imagen descarga audio', 'laaldea')?>">
        <?php else : ?>
          <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga general', 'laaldea')?>">
        <?php endif; ?>
      </a>
    </div>
  <?php endfor; ?>
</div>
</div>