<?php 
  $post_id = $laaldea_args['post_id'];
  $title = $laaldea_args['title'];
  $has_thumbnail = $laaldea_args['has_thumbnail'];
  $thumbnail = $laaldea_args['thumbnail'];
  $type = strtolower($laaldea_args['type']);
  $link = $laaldea_args['link'];
  $content = $laaldea_args['content'];
  $container_class = $laaldea_args['container_class'];
  $follow_status = $laaldea_args['follow_status'];
  $tool = $laaldea_args['tool'];
  $tool_name = $laaldea_args['tool_name'];
  $related = $laaldea_args['related'];
  $link_download = $laaldea_args['link_download'];
?>

<div class="<?php echo $container_class; ?>">
  <img class="tool-background-image" src="/wp-content/uploads/tools-single-background.png" alt="<?php _e('Tool item background','laaldea')?>">
  <div class="row top-row py-3 px-4">
    <div class="col-4 thumbnail-column">
      <div class="thumbnail-container d-flex align-items-center justify-content-center">
        <a href="<?php echo $tool?>" class="view-link type-<?php echo $type;?>" target="_blank" data-postId="<?php echo $post_id;?>" data-type="<?php echo $type;?>" data-link="<?php echo $link;?>">
          <?php if($has_thumbnail) :?>
            <?php echo $thumbnail; ?>
          <?php else :?>
            <img src="/wp-content/uploads/tools-default-thumb-background.jpg" alt="<?php _e('Default Thumbnail pdf', 'laaldea')?>">
            <span class="default-text d-flex align-items-center justify-content-center h5">
              <?php if($type == 'pdf') : ?>
                <?php _e('PDF', 'laaldea')?>
              <?php elseif($type == 'video') : ?>
                <?php _e('Video', 'laaldea')?>
              <?php elseif($type == 'audio') : ?>
                <?php _e('Audio', 'laaldea')?>
              <?php else : ?>
                <?php _e('Herramienta', 'laaldea')?>
              <?php endif; ?>
            </span>
          <?php endif;?>
        </a>
      </div>
    </div>
    <div class="col-7 content-column">
      <div class="entry-header mb-3">
        <h6 class="font-titan color-cyan"><?php echo $title;?></h6>
      </div>
      <div class="d-flex align-items-center description-container">
        <?php if(!empty($content)) :
            $content = wp_trim_words($content, 60);
          ?>
          <?php echo $content; ?>
        <?php else :?>
          <p><?php _e('Sin Descripción','laaldea')?></p>
        <?php endif;?>
      </div>
    </div>
  </div>
  <div class="row middle-row pb-3 px-4">
    <div class="col-4 related-column">
      <?php if(!empty($related)) : ?>
        <div class="related-title-container">
          <span class="color-cyan font-sassoon uppercase p-0"><?php _e('Contenidos relacionados','laaldea');?></h6>
        </div>
        <?php for ($i = 0; $i <= sizeOf($related) - 1; $i++ ) : ?>
          <?php  
            $related_post_id = $related[$i];
            $related_tool = get_field( "herramienta", $related_post_id );
            $related_type = strtolower(get_field( "type", $related_post_id ));
            $related_title = get_the_title( $related_post_id );

            $related_link_youtube = get_field( "link_youtube", $related_post_id );
            $related_link_issuu = get_field( "link_issuu", $related_post_id );
            $related_link = 'pdf' === $related_type ? $related_link_issuu : $related_link_youtube;
            if(empty($link) && ($type == 'video' || $type == 'audio')) {
              $related_link = $related_tool;
            }
            $related_link_download = get_field( "link_download", $related_post_id );
            $related_link_download = empty($link_download) ? $related_tool : $link_download;
          ?>
          <div class="related-tool-container mb-2">
            <a href="<?php echo $related_tool?>" class="view-link-rel type-<?php echo strtolower($related_type);?>" target="_blank" data-postId="<?php echo $related_post_id;?>" data-type="<?php echo $related_type;?>" data-link="<?php echo $related_link;?>">
              <?php echo $related_title;?>
            </a>
          </div>
        <?php endfor; ?>
      <?php endif; ?>
    </div>
    <div class="col-7 links-column d-flex justify-content-around align-items-center">
      <div class="download-link-section">
        <a class="d-flex align-items-center" href="<?php echo $link_download?>" download>
          <div class="icon-container">
            <?php include ABSPATH . 'wp-content/uploads/tools-button-download.svg';?>
          </div>
          <div class="link-text download-text uppercase">
            <?php _e('Descarga aquí','laaldea');?>
          </div>
        </a>
      </div>
      <div class="resource-section">
        <button class="link-container d-flex align-items-center" data-url="<?php echo $tool;?>">
          <div class="icon-container">
            <?php include ABSPATH . 'wp-content/uploads/tools-button-copy.svg';?>
          </div>
          <div class="link-text copy-text uppercase">
            <?php _e('Copiar vínculo','laaldea');?>
          </div>
          <span class="tooltiptext"><?php _e('Texto Copiado','laaldea');?></span>
        </button>
      </div>
      <div class="follow-section">
        <button class="d-flex align-items-center" data-postId="<?php echo $post_id;?>" data-add="<?php echo $follow_status; ?>"<?php echo $follow_status==-1?' disabled':'';?>>
          <div class="icon-container">
            <?php include ABSPATH . 'wp-content/uploads/tools-filter-follow.svg';?>
          </div>
          <div class="link-text follow-text uppercase">
            <?php _e('Agregar a favoritos','laaldea');?>
          </div>
        </button>
      </div>
    </div>
  </div>
</div>