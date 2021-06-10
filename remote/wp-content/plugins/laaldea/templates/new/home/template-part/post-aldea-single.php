<?php 
  $title = $laaldea_args['title'];
  $content = $laaldea_args['content'];
  $url = $laaldea_args['url'];
?>

<div class="rellax slide-container color-gray" data-rellax-speed="2">
  <div class="content-container text-left">
    <h2 class="title"><?php echo $title;?></h2>
    <div class="p">
      <?php echo $content;?>
    </div>
    <div class="button-container text-right p d-flex">
      <a href="<?php echo $url?>" class="home-button right"><?php _e('Lee más', 'laaldea');?></a>
    </div>
  </div>
</div>