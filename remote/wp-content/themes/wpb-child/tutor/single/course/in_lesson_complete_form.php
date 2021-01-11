<?php
/**
 * Display attachments
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) )
	exit;


do_action('tutor_course/single/before/complete_form');

$course_id = tutor_utils()->get_course_id_by_lesson(get_the_ID());

$is_completed_course = tutor_utils()->is_completed_course($course_id);
if ( ! $is_completed_course) {
	?>
    <div class="tutor-course-compelte-form-wrap">

        <form method="post">
          <?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>
          <input type="hidden" name="course_id" value="<?php echo $course_id; ?>"/>
          <input type="hidden" name="tutor_action" value="tutor_complete_course_custom"/>

          <button type="submit" class="course-complete-button tutor-btn" name="complete_course_btn" value="complete_course">
            <span></span>
            <span><?php _e( 'Complete Course', 'tutor' ); ?></span>
            <i class="fas fa-chevron-right"></i>
          </button>
        </form>
    </div>
	<?php
}
do_action('tutor_course/single/after/complete_form'); ?>