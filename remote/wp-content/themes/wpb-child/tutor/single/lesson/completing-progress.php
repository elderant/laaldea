<?php
/**
 * Progress bar
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

global $post;
$currentPost = $post;

$course_id = 0;
if ($post->post_type === 'tutor_quiz'){
	$course = tutor_utils()->get_course_by_quiz(get_the_ID());
	$course_id = $course->ID;
} elseif ($post->post_type === 'tutor_assignments'){
	$course_id = get_post_meta($post->ID, '_tutor_course_id_for_assignments', true);
} elseif ($post->post_type === 'tutor_zoom_meeting'){
	$course_id = get_post_meta($post->ID, '_tutor_zm_for_course', true);
} else {
	$course_id = get_post_meta($post->ID, '_tutor_course_id_for_lesson', true);
}

$completed_count = tutor_utils()->get_course_completed_percent($course_id);

do_action('tutor_course/single/enrolled/before/lead_info/progress_bar');
?>

<div class="tutor-course-status">
    <h4 class="tutor-segment-title"><?php _e('Course Status', 'tutor'); ?></h4>
    <div class="tutor-progress-bar-wrap">
        <div class="tutor-progress-bar">
            <div class="tutor-progress-filled" style="--tutor-progress-left: <?php echo $completed_count.'%;'; ?>"></div>
        </div>
        <span class="tutor-progress-percent"><?php echo $completed_count; ?>% <?php _e(' Complete', 'tutor')?></span>
    </div>
</div>

<?php
    do_action('tutor_course/single/enrolled/after/lead_info/progress_bar');
?>

