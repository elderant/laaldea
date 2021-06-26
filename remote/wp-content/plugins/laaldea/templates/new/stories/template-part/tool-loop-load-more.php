<?php 
  $offset = $laaldea_args['offset'];
  $post_count = $laaldea_args['post_count'];
  $tools_template = $laaldea_args['tools_template'];
?>

<div class="load-more-container text-center">
  <?php if($post_count > $offset) : ?>
    <button class="load-more-button uppercase medium" data-offset="<?php echo $offset;?>" data-toolsTemplate="<?php echo $tools_template;?>" data-post_count="<?php echo $post_count?>">
        <div><?php _e('Ver más')?></div>
        <div><i class="fas fa-chevron-down"></i></div>
    </button>
  <?php endif;?>
</div>