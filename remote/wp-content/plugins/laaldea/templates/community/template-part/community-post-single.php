<?php 
  $permalink = $laaldea_args['permalink'];
  $title = $laaldea_args['title'];
  $excerpt = $laaldea_args['excerpt'];
  $has_thumbnail = $laaldea_args['has_thumbnail'];
  $thumbnail = $laaldea_args['thumbnail'];
  $container_class = $laaldea_args['container_class'];
  
?>

<div class="<?php echo $container_class?>">
  <div class="post-thumbnail-container mb-3 text-center">
    <?php if($has_thumbnail) :?>
      <a href="<?php echo $permalink;?>">
        <?php echo $thumbnail; ?>
      </a>
    <?php endif;?>
  </div>
  <div class="content-container">
    <div class="post-title-container color-green mb-3">
      <a href="<?php echo $permalink;?>">
        <h2><?php echo $title?></h2>
      </a>
    </div>
    <div class="post-excerpt-container">
      <?php echo $excerpt?>
    </div>
  </div>
</div>