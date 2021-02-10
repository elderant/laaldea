<?php

/**
 * Single next previous pagination
 *
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.7
 */

global $post;

$extra_class = $post->post_type === 'tutor_quiz'? ' bottom': '';
?>

<div class="tutor-next-previous-pagination-wrap<?php echo $extra_class;?>">
	<?php if ($previous_id) : ?>
      <a class="tutor-previous-link tutor-previous-link-<?php echo $previous_id; ?>" href="<?php echo get_the_permalink($previous_id);?>">
        <i class="fas fa-chevron-left"></i>
        <span class="link-text"><?php _e('Anterior lección', 'wpb_child')?></span>
      </a>
  <?php else : ?>
    <div></div>
  <?php endif;?>

	<?php if ($next_id) : ?>
    <a class="tutor-next-link tutor-next-link-<?php echo $next_id; ?>" href="<?php echo get_the_permalink($next_id); ?>">
      <span class="link-text"><?php _e('Siguiente lección', 'wpb_child')?></span>
      <i class="fas fa-chevron-right"></i>
		</a>
  <?php else : ?>
    <div></div>
	<?php endif;?>
</div>
