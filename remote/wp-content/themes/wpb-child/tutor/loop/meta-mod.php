<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

global $post, $authordata;

// $profile_url = tutor_utils()->profile_url($authordata->ID);
$course_duration = get_tutor_course_duration_context();
$course_modules = "MODULOS?";
?>



<div class="tutor-course-loop-meta">
  <div class="row">
    <?php if(!empty($course_duration)) : ?>
      <div class="col-6 duration-container">
        <div class="tutor-single-loop-meta">
          <img src="/wp-content/uploads/courses-duration-image.png" alt="<?php _e('Imagen indicador duración','laaldea')?>"><span><?php echo $course_duration;?></span>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <div class="col-6 modulos-container">
    <div class="tutor-single-loop-meta">
      <img src="/wp-content/uploads/courses-modules-image.png" alt="<?php _e('Imagen indicador modulos','laaldea')?>"><span><?php echo $course_modules; ?></span>
    </div>
  </div>  
</div>