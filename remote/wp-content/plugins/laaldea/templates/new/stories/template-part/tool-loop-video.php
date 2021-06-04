<?php 
  $tools_template = $laaldea_args['tools_template'];
  $posts_per_page = $laaldea_args['posts_per_page'];
  $featured_terms = $laaldea_args['featured_terms'];

  $posts_per_page = 4; 
?>

<div class="main-container mt-5 mb-3">
  <?php ?>
  <?php if(count($featured_terms) > 0):?>
    <?php for( $term_index = 0; $term_index <= count($featured_terms) - 1; $term_index++):?>
      <?php 
        $term_id = $featured_terms[$term_index]->term_id;
        $tools_array = laaldea_get_tool_query_for_category($term_id, $posts_per_page, $tools_template);
        $category_tools = $tools_array['tools'];
        $page = $tools_array['page'];
        $max_num_pages = $tools_array['max_num_pages'];
      ?>
      <?php if($category_tools): ?>
        <div class="term-container show my-3 term-<?php echo $featured_terms[$term_index]->term_id;?>">
          <div class="term-tile font-titan color-green h5"><?php echo $featured_terms[$term_index] -> name;?></div>
          <div class="slick-prev arrow">
            <i class="fas fa-angle-left"></i>
          </div>
          <div class="slick-next arrow">
            <i class="fas fa-angle-right"></i>
          </div>
          <div class="carousel-container" data-term_id="<?php echo $term_id?>" data-toolstemplate="<?php echo $tools_template;?>" data-post_per_page="<?php echo $posts_per_page;?>" data-page="<?php echo $page?>" data-max_num_pages="<?php echo $max_num_pages?>">
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