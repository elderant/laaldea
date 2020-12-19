<?php
/**
 * @package TutorLMS/Templates
 * @version 1.5.8
 */

?>

<div class="tutor-course-header">
  <a href="<?php echo get_the_permalink()?>">
    <?php
      tutor_course_loop_thumbnail();
      $course_id = get_the_ID();
    ?>
  </a>
</div>