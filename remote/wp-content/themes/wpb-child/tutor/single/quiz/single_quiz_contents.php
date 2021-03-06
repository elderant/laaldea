<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

$course = tutor_utils()->get_course_by_quiz(get_the_ID());

$course_id = $course -> ID;
$title_html = get_field( 'title_html', $course_id );
$title = empty($title_html) ? get_the_title() : $title_html;

$topic = laaldea_get_topic_from_lesson(get_post());
$topic_name = get_the_title( $topic -> ID );
?>

<div class="tutor-single-module-title mb-2">
  <h5 class="color-cyan">
    <span class="before-title font-titan color-gray"><?php _e('Módulo: ','laaldea');?></span>
    <?php echo $topic_name; ?>
  </h5>
</div>

<div class="tutor-single-lesson-title mb-4">
  <div class="tutor-top-bar-item tutor-topbar-content-title-wrap">
    <?php do_action('tutor_course/single/title/before'); ?>
    <?php
      the_title('<h2>', '</h2>'); ?>
    <?php do_action('tutor_course/single/title/after'); ?>
  </div>
</div>

<div class="tutor-topbar-item tutor-topbar-mark-course-to-done">
  <?php wpb_child_tutor_in_lesson_course_mark_complete_html($course_id); ?>
</div>

<div class="tutor-quiz-single-wrap ">
    <input type="hidden" name="tutor_quiz_id" id="tutor_quiz_id" value="<?php the_ID(); ?>">

	<?php
	if ($course){
		//tutor_single_quiz_top();
		tutor_single_quiz_body();
	}else{
		tutor_single_quiz_no_course_belongs();
	}
	?>
</div>