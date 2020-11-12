<?php $next_new = $laaldea_args['next_new'];?>

<?php if( $next_new -> have_posts() ) : ?>
  <?php $next_new -> the_post(); 
    $post_id = get_the_ID();
  ?>
  <div class="new-container post-id-<?php echo $post_id;?> p-3 my-3">
    <div class="image-container">
      <?php the_post_thumbnail( 'large' );?>
    </div>
    <div class="title-container h4 color-cyan font-titan">
      <?php the_title();?>
    </div>
    <div class="title-author h6 color-cyan font-sassoon pl-2 mb-4">
      <?php _e('Escrito por: ','laaldea') . the_author();?>
    </div>
    <div class="post-content h5 font-sassoon color-gray p-0">
      <?php the_content();?>
    </div>
    <div class="post-actions d-flex align-items-center justify-content-center font-titan">
      <?php $post = get_adjacent_post();?>
      <?php if(!empty($post)) : ?>
        <?php $post_id = $post -> ID;?>
        <button class="load-more-link" data-postId="<?php echo $post_id?>">
          <div class="text-container h6">
            <span><?php echo get_the_title($post_id); ?></span>
          </div>
          <div class="image-container">
            <img src="/wp-content/uploads/learning-arrow-down.png" alt="<?php _e('Arrow down image','laaldea'); ?>">
          </div>
        </button>
      <?php endif;?>
    </div>
  </div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>