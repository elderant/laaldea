<div class="filters-container status-filter d-flex flex-column justify-content-between align-items-start">
  <button class="pending-status-filter-button py-3" data-filter="state-started">
    <img class="filter-image pending" src="/wp-content/uploads/courses-filter-pending.png" alt="<?php _e('Imagen filtrar por cursos pendientes','laaldea')?>">
    <span class="text-container h6 font-titan"><?php _e('En proceso','laaldea');?></span>
  </button>
  <button class="completed-status-filter-button pb-3" data-filter="state-completed">
    <img class="filter-image completed" src="/wp-content/uploads/courses-filter-completed.png" alt="<?php _e('Imagen filtrar por cursos competados','laaldea')?>">
    <span class="text-container h6 font-titan"><?php _e('Finalizados','laaldea');?></span>
  </button>
</div>

<?php 
  $course_query = $laaldea_args['course_query'];
?>

<div class="filters-container other-courses d-flex flex-column justify-content-between align-items-start">
  <div class="filter-title py-4">
    <button class="filter-contol d-flex align-items-center justify-content-between active">
      <div class="filter-text d-flex align-items-center">
        <span class="h5 font-titan color-gray"><?php _e('Otros Cursos','laaldea');?></span>
      </div>
      <div class="filter-icon h5">
        <span class="icon hidden font-titan">+</span>
        <span class="icon font-titan">-</span>
      </div>
    </button>
  </div>
  <div class="other-courses-container">
    <?php if( $course_query -> have_posts() ) : ?>
      <?php $i = 0;?>
      <?php while ($course_query -> have_posts()) : ?>
        <?php 
          $course_query -> the_post(); 
          $topic_id = get_the_id();
          $title_html = get_field( 'title_html' );
          $title = empty($title_html) ? get_the_title() : $title_html;
          $html_title = empty($title_html) ? '' : ' html-title';

          $i = ($i < 3)? $i + 1: 1;
          $class = 'course-container row-' . $i;  
        ?>

        <div class="<?php echo $class?>">
          <a class="course-button d-flex align-items-center justify-content-center" href="<?php echo bbp_topic_permalink($topic_id);?>">
            <div class="title-container<?php echo $html_title?>">
              <?php echo $title; ?>
            </div>
          </a>
        </div>

      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
</div>