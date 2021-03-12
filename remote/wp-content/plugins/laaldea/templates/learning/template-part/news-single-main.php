<?php $next_new = $laaldea_args['next_new'];?>

<?php if( $next_new -> have_posts() ) : ?>
  <?php $next_new -> the_post(); 
    $post_id = get_the_ID();
  ?>
  <div class="new-container post-id-<?php echo $post_id;?> p-3 my-3">
    <div class="image-container">
      <?php the_post_thumbnail( 'large' );?>
    </div>
    <div class="post-title h4 color-cyan font-titan">
      <span><?php the_title();?></span>
      <span class="tags font-sassoon h6 color-gray"><?php echo get_the_tag_list( __('En ', 'laaldea'), ', ', ''); ?></span>
    </div>
    <div class="post-place h6 color-cyan font-sassoon pl-2 mb-2">
      <?php echo !empty(get_field( "place" )) ? __('Lugar: ','laaldea') . get_field( "place"):'';?>
    </div>
    <div class="post-date h6 color-cyan font-sassoon capitalized pl-2 mb-4">
      <span><?php echo get_the_date(); ?></span>
    </div>
    <div class="post-content h5 font-sassoon color-gray p-0">
      <?php the_content();?>
    </div>
    <div class="post-actions d-flex align-items-center justify-content-center font-titan">
      <?php $post = get_adjacent_post();?>
      <?php if(!empty($post)) : ?>
        <?php $post_id = $post -> ID;?>
        <button class="load-more-link" data-postId="<?php echo $post_id?>">
          <div class="text-container h6 uppercase">
            <span><?php _e('Ver más','laaldea');?></span>
          </div>
        </button>
      <?php endif;?>
    </div>
  </div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>