<?php 
  //$post_id = $laaldea_args['post_id'];
  //$title = $laaldea_args['title'];
  $has_thumbnail = $laaldea_args['has_thumbnail'];
  $thumbnail = $laaldea_args['thumbnail'];
  //$type = strtolower($laaldea_args['type']);
  $content = $laaldea_args['content'];
  $container_class = $laaldea_args['container_class'];
  $tool = $laaldea_args['tool'];
  $tool_playback_url = $laaldea_args['tool_playback_url'];
?>

<div class="<?php echo $container_class; ?>">
  <div class="row py-1">
    <div class="col-12 thumbnail-column">
      <div class="thumbnail-container d-flex align-items-center justify-content-center">
        <?php if($has_thumbnail) :?>
          <?php echo $thumbnail; ?>
        <?php else :?>
          <img src="/wp-content/uploads/tools-default-thumb-background.jpg" alt="<?php _e('Default Thumbnail pdf', 'laaldea')?>">
          <span class="default-text d-flex align-items-center justify-content-center h5">
            <?php _e('PDF', 'laaldea')?>
          </span>
        <?php endif;?>
      </div>
      <div class="iframe-container">
        <?php if(!empty($tool_playback_url)) : ?>
          <iframe src="<?php echo $tool_playback_url; ?>" frameborder="0"></iframe>
        <?php else :?>
          <iframe src="$tool" frameborder="0"></iframe>
        <?php endif;?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 content-column uppercase">
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