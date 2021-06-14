<?php $post_id = get_the_ID();?>
<div class="new-container post-id-<?php echo $post_id;?> p-3 my-3">
  <div class="post-title h1 color-gray font-titan">
    <span><?php the_title();?></span>
  </div>
  <div class="post-date h6 color-cyan font-sassoon capitalized pl-2 mb-4">
    <span><?php echo get_the_date(); ?></span>
  </div>
  <div class="post-content font-sassoon color-gray p-0">
    <?php the_content();?>
  </div>
</div>