<div class="tutor-single-course-segment tutor-course-single-button">
  <?php do_action('tutor_course/single/actions_btn_group/before'); ?>
  <?php
    if ( $wp_query->query['post_type'] !== 'lesson') :
      $lesson_url = tutor_utils()->get_course_first_lesson();
      $completed_lessons = tutor_utils()->get_completed_lesson_count_by_course();
      if ( $lesson_url ) : ?>
        <a href="<?php echo $lesson_url; ?>" class="tutor-button tutor-success h3 m-0">
          <?php
            if($completed_lessons){
              _e( 'Continuar', 'wpb_child' );
            }else {
              _e( 'Comenzar', 'wpb_child' );
            }
          ?>
        </a>
      <?php endif;
    endif;?>
  <?php do_action('tutor_course/single/actions_btn_group/after'); ?>
</div>