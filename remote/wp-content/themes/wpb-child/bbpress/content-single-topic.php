<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>

<div id="bbpress-forums" class="bbpress-wrapper">

	<?php bbp_breadcrumb(array('include_home' => false, 'before' => '<div class="bbp-breadcrumb"><p class="h6">')); ?>

  <div class="actions hidden">

    <?php bbp_topic_subscription_link(array('before' => '', 'after' => '<span class="separator"> |</span>')); ?>

    <?php bbp_topic_favorite_link(); ?>
  
  </div>

	<?php do_action( 'bbp_template_before_single_topic' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>
    <?php if ( bbp_has_replies() ) : ?>
      <div class="bbp-topic-title color-cyan font-titan">
        <span><?php _e('Tema:','wpb_child');?> <?php bbp_topic_title();?></span>
      </div>
    <?php endif; ?>

		<?php if ( bbp_show_lead_topic() ) : ?>

			<?php bbp_get_template_part( 'content', 'single-topic-lead' ); ?>

		<?php endif; ?>

		<?php if ( bbp_has_replies() ) : ?>

			<?php bbp_get_template_part( 'loop',       'replies' ); ?>

			<?php bbp_get_template_part( 'pagination', 'replies' ); ?>

		<?php endif; ?>

	<?php endif; ?>

  <?php 
    $before = '<div class="bbp-topic-tags pt-4"><p>' . esc_html__( 'Tagged:', 'bbpress' ) . '&nbsp;';
    bbp_topic_tag_list(0, array('before' => $before));
  ?>

	<?php bbp_get_template_part( 'alert', 'topic-lock' ); ?>

	<?php do_action( 'bbp_template_after_single_topic' ); ?>

</div>