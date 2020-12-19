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

?>

<div class="tutor-next-previous-pagination-wrap">
	<?php if ($previous_id) : ?>
      <a class="tutor-previous-link tutor-previous-link-<?php echo $previous_id; ?>" href="<?php echo get_the_permalink($previous_id);?>">
        <i class="fas fa-chevron-left"></i>
      </a>
  <?php else : ?>
    <div></div>
  <?php endif;?>

	<?php if ($next_id) : ?>
    <a class="tutor-next-link tutor-next-link-<?php echo $next_id; ?>" href="<?php echo get_the_permalink($next_id); ?>">
      <i class="fas fa-chevron-right"></i>
		</a>
  <?php else : ?>
    <div></div>
	<?php endif;?>
</div>
