<?php
/**
 * Template for displaying single quiz
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

laaldea_get_tutor_header(false, 'learning');

$course = tutor_utils()->get_course_by_quiz(get_the_ID());

$enable_spotlight_mode = tutor_utils()->get_option('enable_spotlight_mode');

$course_id = $course->ID;
$title_html = get_field( 'title_html', $course_id );
$title = empty($title_html) ? get_the_title($course_id) : $title_html;
$topic = laaldea_get_topic_from_lesson(get_post());
$topic_name = get_the_title( $topic -> ID );
?>

<div id="sidebar-main" class="col-12 offset-0 order-2 col-sm-10 offset-sm-1 col-lg-4 offset-lg-0 order-lg-1 col-xl1-4 offset-xl1-0 col-xl-3 offset-xl-1 lesson-sidebar quiz-sidebar">
  <div class="tutor-lesson-sidebar">
    <?php tutor_lessons_sidebar(); ?>
  </div>
</div>

  <?php do_action('tutor_quiz/single/before/wrap'); ?>
  <div class="col-12 offset-0 order-1 col-sm-10 offset-sm-1 col-lg-8 offset-lg-0 order-lg-2 col-xl1-8 offset-xl1-0 col-xl-7 tutor-single-lesson-wrap lesson-section quiz-section <?php echo $enable_spotlight_mode ? "tutor-spotlight-mode" : ""; ?>">
    <div id="tutor-single-entry-content" class="tutor-quiz-single-entry-wrap tutor-single-entry-content">
      <input type="hidden" name="tutor_quiz_id" id="tutor_quiz_id" value="<?php the_ID(); ?>">
      
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

      <div class="tutor-quiz-single-wrap">
        <input type="hidden" name="tutor_quiz_id" id="tutor_quiz_id" value="<?php the_ID(); ?>">

        <?php
          if ($course){
            //tutor_single_quiz_top();
            tutor_single_quiz_content();
            tutor_single_quiz_body();
          }else{
            tutor_single_quiz_no_course_belongs();
          }
        ?>
      </div>
    </div>

  </div><!-- .wrap -->

<?php
laaldea_get_tutor_footer(false, 'learning');