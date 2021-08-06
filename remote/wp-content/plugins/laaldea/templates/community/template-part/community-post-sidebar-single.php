<?php 
  $post_id = $laaldea_args['post_id'];
  $term_list = $laaldea_args['term_list'];
  $permalink = $laaldea_args['permalink'];
  $title = $laaldea_args['title'];
  $excerpt = $laaldea_args['excerpt'];
  $has_thumbnail = $laaldea_args['has_thumbnail'];
  $thumbnail = $laaldea_args['thumbnail'];
  $post_date = $laaldea_args['post_date'];
  $container_class = $laaldea_args['container_class'];
?>

<div class="<?php echo $container_class?>">
  <div class="post-taxonomy mb-2 text-right">
    <?php echo $term_list;?>
  </div>
  <div class="post-thumbnail-container mb-2 text-center">
    <?php if($has_thumbnail) :?>
      <a href="<?php echo $permalink;?>">
        <?php echo $thumbnail; ?>
      </a>
    <?php endif;?>
  </div>
  <div class="content-container">
    <div class="post-title-container color-green">
      <a href="<?php echo $permalink;?>">
        <h6 class="font-sassoon bold"><?php echo $title?></h6>
      </a>
    </div>
  </div>
  <div class="date-container">
    <?php echo $post_date; ?>
  </div>
</div>