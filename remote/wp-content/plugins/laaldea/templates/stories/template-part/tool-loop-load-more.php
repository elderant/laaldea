<?php 
  $page = $laaldea_args['page'];
  $max_num_pages = $laaldea_args['max_num_pages'];
  $posts_per_page = $laaldea_args['posts_per_page'];
  $tools_template = $laaldea_args['tools_template'];
?>

<div class="load-more-container text-center">
  <?php if($page < $max_num_pages) : ?>
    <button class="load-more-button uppercase medium" data-toolsTemplate="<?php echo $tools_template;?>" data-post_per_page="<?php echo $posts_per_page;?>" data-page="<?php echo $page?>" data-max_num_pages="<?php echo $max_num_pages?>">
        <div><?php _e('Ver más')?></div>
        <div><i class="fas fa-chevron-down"></i></div>
    </button>
  <?php endif;?>
</div>