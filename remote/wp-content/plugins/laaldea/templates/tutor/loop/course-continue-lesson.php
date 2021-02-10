<div class="tutor-single-course-segment tutor-course-single-button">
  <?php do_action('tutor_course/single/actions_btn_group/before'); ?>
  <?php
  if ($wp_query->query['post_type'] !== 'lesson') :
    $lesson_url = tutor_utils()->get_course_first_lesson();
    if ($lesson_url) : ?>
      <a href="<?php echo $lesson_url; ?>" class="tutor-button tutor-success h3 m-0">
        <?php _e('Continuar', 'wpb_child'); ?>
      </a>
    <?php endif;
  endif;?>
</div>