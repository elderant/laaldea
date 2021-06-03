<?php 
  $recent_tools = $laaldea_args['recent_tools'];
  $limit = $laaldea_args['limit'];
  $offset = $laaldea_args['offset'];
  $post_count = $laaldea_args['post_count'];
  $requested_tool_id = $laaldea_args['requested_tool_id'];
  $tools_tempate = $laaldea_args['tools_tempate'];
  $tools_class = $laaldea_args['tools_class'];

  $limit = $post_count < $limit? $post_count: $limit;
?>

<div class="main-container mt-5 mb-3" data-limit="<?php echo $limit;?>">
  <?php $tool_index = 0;?>
  <?php if( $recent_tools -> have_posts() ) : ?>
    <?php while ($recent_tools -> have_posts()) : ?>
      <?php 
        $recent_tools -> the_post();
        $post_id = get_the_ID();
        $type = get_field( "aldea_tool_type", $post_id );
        laaldea_get_aldea_tool_html($post_id, $type, '', true);
      ?>
      <?php $tool_index = $tool_index + 1;?>
      <?php if($tool_index == 3):?>
        <div class="flex-break"></div>
        <?php $tool_index = 0;?>
      <?php endif;?>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
    <div class="load-more h6 uppercase color-green">
      <?php _e('Ver más?','laaldea')?>
    </div>
  <?php endif; ?>
</div>