<?php 
  $post_id = $laaldea_args['post_id'];
  $title = $laaldea_args['title'];
  $has_thumbnail = $laaldea_args['has_thumbnail'];
  $thumbnail = $laaldea_args['thumbnail'];
  $type = strtolower($laaldea_args['type']);
  $content = $laaldea_args['content'];
  $container_class = $laaldea_args['container_class'];
  $tool = $laaldea_args['tool'];

  $tool_issuu_link = $laaldea_args['tool_issuu_link'];
  $tool_issuu_share = $laaldea_args['tool_issuu_share'];
?>

<div class="<?php echo $container_class; ?>">
  <div class="row py-3">
    <div class="col-12 thumbnail-column">
      <div class="thumbnail-container d-flex align-items-center justify-content-center">
        <button href="<?php echo $tool?>" class="view-link type-<?php echo $type;?>" data-link="<?php echo $tool_issuu_share;?>" data-type="<?php echo $type;?>" data-postId="<?php echo $post_id;?>">
          <?php if($has_thumbnail) :?>
            <?php echo $thumbnail; ?>
          <?php else :?>
            <img src="/wp-content/uploads/tools-default-thumb-background.jpg" alt="<?php _e('Default Thumbnail pdf', 'laaldea')?>">
            <span class="default-text d-flex align-items-center justify-content-center h5">
              <?php _e('PDF', 'laaldea')?>
            </span>
          <?php endif;?>
        </button>
      </div>
    </div>
  </div>
  <div class="row py-3">
    <div class="col-12 content-column">
      <div class="entry-header mb-2 uppercase color-green">
        <h6 class="font-titan"><?php echo $title;?></h6>
      </div>
      <div class="d-flex align-items-start description-container text-justify">
        <?php if(!empty($content)) :
            $content = wp_trim_words($content, 80);
          ?>
          <?php echo $content; ?>
        <?php else :?>
          <p><?php _e('Sin Descripción','laaldea')?></p>
        <?php endif;?>
      </div>
    </div>  
  </div>
  <div class="row pb-3">
    <div class="col-12 links-column">
      <div class="download-link-section link-section pb-3 d-none">
        <a class="download-link action-link d-flex align-items-center justify-content-start" href="<?php echo $tool?>" download>
          <div class="icon-container">
            <?php include ABSPATH . 'wp-content/uploads/tools-button-download.svg';?>
          </div>
          <div class="link-text download-text uppercase line-height-12">
            <?php _e('Descarga aquí','laaldea');?>
          </div>
        </a>
      </div>
      <div class="activities-section link-section pb-3 d-none">
        <button class="action-link d-flex align-items-center justify-content-start" disabled>
          <div class="icon-container">
            <?php include ABSPATH . 'wp-content/uploads/learning-home-courses-icon.svg';?>
          </div>
          <div class="link-text activities-text uppercase line-height-12">
            <?php _e('Actividades','laaldea');?>
          </div>
        </button>
      </div>
      <div class="resource-section link-section pb-3">
        <button class="action-link d-flex align-items-center justify-content-start" data-url="<?php echo $tool_issuu_link;?>">
          <div class="icon-container">
            <?php include ABSPATH . 'wp-content/uploads/tools-button-copy.svg';?>
          </div>
          <div class="link-text copy-text uppercase line-height-12">
            <?php _e('Copiar vínculo','laaldea');?>
          </div>
          <span class="tooltiptext"><?php _e('Vínculo Copiado','laaldea');?></span>
        </button>
      </div>
    </div>
  </div>
</div>