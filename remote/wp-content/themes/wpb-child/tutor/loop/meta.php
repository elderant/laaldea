<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

global $post, $authordata;

// $profile_url = tutor_utils()->profile_url($authordata->ID);
$course_duration = get_tutor_course_duration_context();
$count = laaldea_tutor_get_topic_count();
$course_modules = sprintf( _n( '%s Modulo', '%s Modulos', $count, 'laaldea' ), number_format_i18n( $count ) );
?>



<div class="tutor-course-loop-meta">
  <div class="row">
    <?php if(!empty($course_duration)) : ?>
      <div class="col-6 meta-container duration-container">
        <div class="tutor-single-loop-meta font-titan">
          <img src="/wp-content/uploads/courses-duration-image.png" alt="<?php _e('Imagen indicador duración','laaldea')?>"><span><?php echo $course_duration;?></span>
        </div>
      </div>
    <?php endif; ?>
    <div class="col-6 meta-container modulos-container">
      <div class="tutor-single-loop-meta font-titan">
        <img src="/wp-content/uploads/courses-modules-image.png" alt="<?php _e('Imagen indicador modulos','laaldea')?>"><span><?php echo $course_modules; ?></span>
      </div>
    </div>  
  </div>
</div>