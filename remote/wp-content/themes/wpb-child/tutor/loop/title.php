<?php
/**
 * Course loop title
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

  $title_html = get_field( 'title_html' );
  $title = empty($title_html) ? get_the_title() : $title_html;
?>

<div class="tutor-course-loop-title">
  <div class="before-title font-titan pb-2"><?php _e('Curso: ','laaladea');?></div>
  <h2 class="color-cyan"><?php echo $title; ?></h2>
</div>

