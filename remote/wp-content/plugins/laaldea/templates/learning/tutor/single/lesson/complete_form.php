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
$user_id = tutor_utils()->get_user_id();
$course_id = get_post_meta(get_the_ID(), '_tutor_course_id_for_lesson', true);

$is_completed_course = tutor_utils()->is_completed_course($course_id, $user_id);
if ( ! $is_completed_course) {
	?>
    <div class="tutor-course-compelte-form-wrap">

        <form method="post">
			<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>

            <input type="hidden" value="<?php echo $course_id; ?>" name="course_id"/>
            <input type="hidden" value="tutor_complete_course" name="tutor_action"/>

            <button type="submit" class="course-complete-button" name="complete_course_btn" value="complete_course"><?php _e( 'Complete Course', 'tutor' ); ?></button>
        </form>
    </div>
	<?php
}
do_action('tutor_course/single/after/complete_form'); ?>