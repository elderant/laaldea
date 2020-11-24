<?php $post_id = get_the_ID();?>
<div class="new-container post-id-<?php echo $post_id;?> p-3 my-3">
  <div class="image-container">
    <?php the_post_thumbnail( 'large' );?>
  </div>
  <div class="post-title h4 color-cyan font-titan">
    <span><?php the_title();?></span>
    <span class="tags font-sassoon h6 color-gray"><?php echo __('En ', 'laaldea') . get_the_tag_list( '', ', ', ''); ?></span>
  </div>
  <div class="post-author h6 color-cyan font-sassoon pl-2 mb-2">
    <?php _e('Escrito por: ','laaldea') . the_author();?>
  </div>
  <div class="author-location h6 font-sassoon pl-2 mb-2">
    <span><?php echo get_user_meta( $author -> ID, 'user_location', true); ?></span>
  </div>
  <div class="post-date h6 color-cyan font-sassoon capitalized pl-2 mb-4">
    <span><?php echo get_the_date(); ?></span>
  </div>
  <div class="post-content h5 font-sassoon color-gray p-0">
    <?php the_content();?>
  </div>
</div>