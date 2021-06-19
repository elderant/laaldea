<?php 
  $container_class = $laaldea_args['container_class'];
  $title = $laaldea_args['title'];
  $has_thumbnail = $laaldea_args['has_thumbnail'];
  $thumbnail = $laaldea_args['thumbnail'];
  $url = $laaldea_args['url'];
?>

<div class="<?php echo $container_class; ?>">
  <div class="publication-title font-titan h6 uppercase mb-3">
    <a href="<?php echo $url;?>" 
      target="_blank" 
      rel="noopener noreferrer"><?php echo $title;?></a>
  </div>
  <div class="image-container mb-3">
    <a href="<?php echo $url;?>" target="_blank" rel="noopener noreferrer">
      <?php if($has_thumbnail) :?>
        <?php echo $thumbnail; ?>
      <?php endif;?>
    </a>
  </div>
</div>