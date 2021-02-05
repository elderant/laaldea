<?php

/**
 * Single Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>

<div id="bbpress-forums" class="bbpress-wrapper">

  <?php bbp_get_template_part( 'form', 'search' ); ?>

	<?php bbp_breadcrumb(array('include_home' => false, 'before' => '<div class="bbp-breadcrumb"><p class="h6">')); ?>

	<?php do_action( 'bbp_template_before_single_forum' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>

		<?php if ( bbp_has_forums() ) : ?>

			<?php bbp_get_template_part( 'loop', 'forums' ); ?>

		<?php endif; ?>

		<?php if ( ! bbp_is_forum_category() && bbp_has_topics() ) : ?>

			<?php bbp_get_template_part( 'loop',       'topics'    ); ?>

			<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>

		<?php elseif ( ! bbp_is_forum_category() ) : ?>

			<?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>

		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_single_forum' ); ?>

  <div class="new-topic-button-container h2">
    <button class="new-topic-button">
      <i class="fas fa-plus"></i>
    </button>
  </div>

  <div class="new-topic-form-container modal-root out">
    <div class="modal-overlay"></div>
    <div class="modal-helper"></div>
    <div class="modal-dialog">
      <?php bbp_get_template_part( 'form',       'topic'     );?>
    </div>
  </div>

</div>
