<?php
/**
 * Template for displaying single lesson
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

global $post;
$currentPost = $post;

$enable_spotlight_mode = tutor_utils()->get_option('enable_spotlight_mode');
?>

<div id="sidebar-main" class="col-12 offset-0 order-2 col-sm-10 offset-sm-1 col-lg-4 offset-lg-0 order-lg-1 col-xl1-4 offset-xl1-0 col-xl-3 offset-xl-1 lesson-sidebar">
  <div class="tutor-lesson-sidebar">
    <?php tutor_lessons_sidebar(); ?>
  </div>
</div>

<?php do_action('tutor_lesson/single/before/wrap'); ?>
  <div class="col-12 offset-0 order-1 col-sm-10 offset-sm-1 col-lg-8 offset-lg-0 order-lg-2 col-xl1-8 offset-xl1-0 col-xl-7 tutor-single-lesson-wrap lesson-section <?php echo $enable_spotlight_mode ? "tutor-spotlight-mode" : ""; ?>">
    <div id="tutor-single-entry-content" class="tutor-lesson-content tutor-single-entry-content tutor-single-entry-content-<?php the_ID(); ?>">
      <?php tutor_lesson_content(); ?>
    </div>
  </div>
<?php do_action('tutor_lesson/single/after/wrap');

laaldea_get_tutor_footer(false, 'learning');