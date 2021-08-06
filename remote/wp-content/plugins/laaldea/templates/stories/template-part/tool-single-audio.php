<?php 
  $post_id = $laaldea_args['post_id'];
  $has_thumbnail = $laaldea_args['has_thumbnail'];
  $thumbnail = $laaldea_args['thumbnail'];
  $title = $laaldea_args['title'];
  $content = $laaldea_args['content'];
  $container_class = $laaldea_args['container_class'];
  $tool = $laaldea_args['tool'];
  $tool_youtube_id = $laaldea_args['tool_youtube_id'];
  $term_id = $laaldea_args['term_id'];
?>

<div class="<?php echo $container_class; ?>" data-postId="<?php echo $post_id?>" data-termId="<?php echo $term_id;?>" data-youtubeId="<?php echo $tool_youtube_id;?>">
  <div class="row py-1 mb-2">
    <div class="col-12 thumbnail-column">
      <div class="thumbnail-container d-flex align-items-center justify-content-center" data-postId="<?php echo $post_id?>" data-termId="<?php echo $term_id;?>">
        <?php if($has_thumbnail) :?>
          <?php echo $thumbnail; ?>
        <?php else :?>
          <img src="/wp-content/uploads/tools-default-thumb-background.jpg" alt="<?php _e('Default Thumbnail pdf', 'laaldea')?>">
          <span class="default-text d-flex align-items-center justify-content-center h5">
            <?php _e('Audio', 'laaldea')?>
          </span>
        <?php endif;?>
      </div>
      <div class="iframe-container">
        <div id="player-<?php echo $term_id;?>-<?php echo $post_id;?>"></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 content-column">
      <div class="entry-header mb-2 uppercase color-green">
        <h6 class="font-titan"><?php echo $title;?></h6>
      </div>
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