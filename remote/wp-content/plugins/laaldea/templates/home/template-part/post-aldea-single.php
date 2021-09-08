<?php 
  $title = $laaldea_args['title'];
  $content = $laaldea_args['content'];
  $url = $laaldea_args['url'];
  $link_text = $laaldea_args['link_text'];
  $post_id = $laaldea_args['post_id'];
  $position = $laaldea_args['position'];
?>

<div class="rellax slide-container color-gray<?php echo ' post-' . $post_id . ' position-' . $position;?>" data-rellax-speed="2">
  <div class="content-container text-left">
    <h2 class="title"><?php echo $title;?></h2>
    <div class="p">
      <?php echo $content;?>
    </div>
    <?php if(!empty($url)) : ?>
    <div class="button-container text-right p d-flex">
      <a href="<?php echo $url?>" class="home-button right"><?php echo $link_text;?></a>
    </div>
    <?php endif; ?>
  </div>
</div>