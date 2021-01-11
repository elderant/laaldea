<?php
/**
 * Display the content
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

do_action('tutor_lesson/single/before/content');

$jsonData = array();
$jsonData['post_id'] = get_the_ID();
$jsonData['best_watch_time'] = 0;
$jsonData['autoload_next_course_content'] = (bool) get_tutor_option('autoload_next_course_content');

$best_watch_time = tutor_utils()->get_lesson_reading_info(get_the_ID(), 0, 'video_best_watched_time');
if ($best_watch_time > 0){
	$jsonData['best_watch_time'] = $best_watch_time;
}

$user_id = tutor_utils()->get_user_id();
$course_id = get_post_meta(get_the_ID(), '_tutor_course_id_for_lesson', true);
$title_html = get_field( 'title_html', $course_id );
$title = empty($title_html) ? get_the_title($course_id) : $title_html;

$completed_percent = tutor_utils()->get_course_completed_percent($course_id, $user_id);
$is_completed_lesson = tutor_utils()->is_completed_lesson();
global $post;
$topic = laaldea_get_topic_from_lesson(get_post());
$topic_name = get_the_title( $topic -> ID );
?>


<?php do_action('tutor_lesson/single/before/content'); ?>

<div class="tutor-single-lesson-title mb-2">
  <div class="tutor-top-bar-item tutor-topbar-content-title-wrap">
    <?php do_action('tutor_course/single/title/before'); ?>
    <?php
    // tutor_utils()->get_lesson_type_icon(get_the_ID(), true, true);
    the_title('<h2>', '</h2>'); ?>
    <?php do_action('tutor_course/single/title/after'); ?>
  </div>
  <!-- <div class="tutor-topbar-item tutor-back-to-course">
    <a href="<?php echo get_the_permalink($post); ?>" class="tutor-topbar-home-btn">
      <i class="tutor-icon-home"></i><span><?php echo __('Go to Course Home', 'tutor') ; ?></span>
    </a>
  </div> -->
</div>

<div class="tutor-single-module-title mb-5">
  <!-- <div class="tutor-hide-sidebar-bar">
    <a href="javascript:;" class="tutor-lesson-sidebar-hide-bar"><i class="tutor-icon-angle-left"></i></a>
  </div> -->
  
  <h5 class="color-cyan">
    <span class="before-title font-titan color-gray"><?php _e('Modulo: ','laaldea');?></span>
    <?php echo $topic_name; ?>
  </h5>
</div>

<div class="tutor-topbar-item tutor-topbar-mark-course-to-done">
  <?php wpb_child_tutor_in_lesson_course_mark_complete_html($course_id); ?>
</div>

<div class="tutor-lesson-content-area">

    <input type="hidden" id="tutor_video_tracking_information" value="<?php echo esc_attr(json_encode($jsonData)); ?>">
  <?php the_content(); ?>
	<?php tutor_lesson_video(); ?>
  <?php get_tutor_posts_attachments(); ?>
  <?php if ( ! $is_completed_lesson) : ?>
    <div class="tutor-topbar-item tutor-topbar-mark-to-done">
      <?php tutor_lesson_mark_complete_html(); ?>
    </div>
  <?php endif;?>
  <?php if (100 == $completed_percent) : ?>
    <?php laaldea_tutor_course_mark_complete_html_lesson(); ?>
  <?php endif;?>
	<?php tutor_next_previous_pagination(); ?>
</div>

<?php do_action('tutor_lesson/single/after/content'); ?>