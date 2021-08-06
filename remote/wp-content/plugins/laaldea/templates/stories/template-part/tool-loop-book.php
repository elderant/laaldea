<?php 
  $recent_tools = $laaldea_args['recent_tools'];
  $limit = $laaldea_args['limit'];
  $post_count = $laaldea_args['post_count'];
  $requested_tool_id = $laaldea_args['requested_tool_id'];
  $tools_template = $laaldea_args['tools_template'];
  $tools_template_str = laaldea_tools_get_tools_template_str($tools_template);

  $limit = $post_count < $limit? $post_count: $limit;
?>

<div class="main-container mt-5 mb-3" data-limit="<?php echo $limit;?>">
  <?php if( $recent_tools -> have_posts() ) : ?>
    <?php while ($recent_tools -> have_posts()) : ?>
      <?php 
        $recent_tools -> the_post();
        $post_id = get_the_ID();
        $type = get_field( "aldea_tool_type", $post_id );
        laaldea_get_aldea_tool_html($post_id, $type, '', true);
      ?>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
  <?php else:?>
    <div class="tool-notice">
      <?php 
        printf( wp_kses( 
          __( 'No tenemos <span class="color-green medium uppercase">%s</span>', 'laaldea' ), 
          array( 'span' => array( 'class' => array() ) ) ), 
          $tools_template_str);
      ?>
    </div>
  <?php endif; ?>
</div>
