<?php 
  $recent_tools = $laaldea_args['recent_tools'];
  $limit = $laaldea_args['limit'];
  $offset = $laaldea_args['offset'];
  $post_count = $laaldea_args['post_count'];
  $requested_tool_id = $laaldea_args['requested_tool_id'];
  $tools_template = $laaldea_args['tools_template'];

  $limit = $post_count < $limit? $post_count: $limit;
?>

<div class="main-container mt-5 mb-3">
  <?php $featured_terms = $laaldea_args['featured_terms'];?>
  <?php if(count($featured_terms) > 0):?>
    <?php for( $term_index = 0; $term_index <= count($featured_terms) - 1; $term_index++):?>
      <?php $category_tools = laaldea_get_tool_query_for_category($featured_terms[$term_index] -> term_id, $tools_template);?>
      <?php if($category_tools): ?>
        <div class="term-container show my-3 term-<?php echo $featured_terms[$term_index]->term_id;?>">
          <div class="term-tile font-titan color-green h5"><?php echo $featured_terms[$term_index] -> name;?></div>
          <div class="slick-prev arrow">
            <i class="fas fa-angle-left"></i>
          </div>
          <div class="slick-next arrow">
            <i class="fas fa-angle-right"></i>
          </div>
          <div class="carousel-container">
            <?php if( $category_tools -> have_posts() ) : ?>
              <?php while ($category_tools -> have_posts()) : ?>
                <?php 
                  $category_tools -> the_post();
                  $post_id = get_the_ID();
                  $type = get_field( "aldea_tool_type", $post_id );
                  laaldea_get_aldea_tool_html($post_id, $type, '', true);
                ?>
              <?php endwhile; ?>
              <?php wp_reset_postdata(); ?>
            <?php endif; ?>
          </div>
        </div>
      <?php endif;?>
    <?php endfor;?>
  <?php endif;?>
</div>