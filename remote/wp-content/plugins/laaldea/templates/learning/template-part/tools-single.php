<?php 
  $post_id = $laaldea_args['post_id'];
  $title = $laaldea_args['title'];
  $has_thumbnail = $laaldea_args['has_thumbnail'];
  $thumbnail = $laaldea_args['thumbnail'];
  $type = $laaldea_args['type'];
  $content = $laaldea_args['content'];
  $container_class = $laaldea_args['container_class'];
  $follow_status = $laaldea_args['follow_status'];
  $tool = $laaldea_args['tool'];
?>

<div class="<?php echo $container_class; ?>">
  <img class="tool-background-image" src="/wp-content/uploads/tools-single-background.png" alt="<?php _e('Tool item background','laaldea')?>">
  <div class="title title-row pb-3">
    <h4 class="font-titan"><?php echo $title; ?></h4>
  </div>
  <div class="left-column description-column pr-5 pb-4">
    <div class="preview-container d-flex align-items-center pb-4">
      <div class="thumbnail-container">
        <?php if($has_thumbnail) :?>
          <?php echo $thumbnail; ?>
        <?php else :?>
          <img src="/wp-content/uploads/tools-default-thumb-background.jpg" alt="<?php _e('Default Thumbnail pdf', 'laaldea')?>">
          <span class="default-text">
            <?php if($type == 'PDF') : ?>
              <?php _e('PDF', 'laaldea')?>
            <?php elseif($type == 'Video') : ?>
              <?php _e('Video', 'laaldea')?>
            <?php else : ?>
              <?php _e('Herramienta', 'laaldea')?>
            <?php endif; ?>
          </span>
        <?php endif;?>
      </div>
      <div class="description-container pl-5">
        <?php if(!empty($content)) :?>
          <?php echo $content; ?>
        <?php else :?>
          <p><?php _e('Sin Descripción','laaldea')?></p>
        <?php endif;?>
      </div>
    </div>
    <div class="follow-container">
      <button data-postId="<?php echo $post_id;?>" data-add="<?php echo $follow_status; ?>"<?php echo $follow_status==-1?' disabled':'';?>>
        <img src="/wp-content/uploads/tools-button-follow.png" alt="<?php _e('Imagen añadir a favoritos','laaldea');?>">
        <span class="follow-text pl-3">
          <?php 
            if($follow_status == 0) {
              _e('Añadir a favoritos','laaldea');
            }
            elseif($follow_status > 0) {
              _e('Remover de favoritos','laaldea');
            }
            elseif($follow_status == -1) {
              _e('Ingresar para agregar a favoritos','laaldea');
            }
          ?>
        </span>
      </button>
    </div>
  </div>
  <div class="right-column download-link-column d-flex flex-column pb-4">
    <a href="<?php echo $tool?>" class="view-link pb-4 type-<?php echo strtolower($type);?>" target="_blank" data-postId="<?php echo $post_id;?>">
      <?php if($type == 'PDF') : ?>
        <img src="/wp-content/uploads/tools-filter-pdf.png" title="<?php _e('Ver archivo','laaldea')?>" alt="<?php _e('Imagen descarga pdf', 'laaldea')?>">
      <?php elseif($type == 'Video') : ?>
        <img src="/wp-content/uploads/tools-filter-video.png" title="<?php _e('Ver archivo','laaldea')?>" alt="<?php _e('Imagen descarga video', 'laaldea')?>">
      <?php else : ?>
        <img src="/wp-content/uploads/tools-filter-pdf.png" title="<?php _e('Ver archivo','laaldea')?>" alt="<?php _e('Imagen descarga general', 'laaldea')?>">
      <?php endif; ?>
    </a>
    <a href="<?php echo $tool?>" download>
      <?php if($type == 'PDF') : ?>
        <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga pdf', 'laaldea')?>">
      <?php elseif($type == 'Video') : ?>
        <img src="/wp-content/uploads/tools-button-download-video.png" alt="<?php _e('Imagen descarga video', 'laaldea')?>">
      <?php else : ?>
        <img src="/wp-content/uploads/tools-button-download-pdf.png" alt="<?php _e('Imagen descarga general', 'laaldea')?>">
      <?php endif; ?>
    </a>
  </div>
</div>