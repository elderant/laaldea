<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>
	<li class="bbp-forum-info">

		<?php if ( bbp_is_user_home() && bbp_is_subscriptions() ) : ?>

			<span class="bbp-row-actions">

				<?php do_action( 'bbp_theme_before_forum_subscription_action' ); ?>

				<?php bbp_forum_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

				<?php do_action( 'bbp_theme_after_forum_subscription_action' ); ?>

			</span>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

    <span class="font-titan before-forum-title h2"><?php _e('Foro: ', 'wpb_child')?></span>

		<a class="bbp-forum-title h3 font-sassoon" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

		<?php do_action( 'bbp_theme_before_forum_description' ); ?>

		<div class="bbp-forum-content"><?php bbp_forum_content(); ?></div>

		<?php do_action( 'bbp_theme_after_forum_description' ); ?>

		<?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>

		<?php bbp_list_forums(); ?>

		<?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>

		<?php bbp_forum_row_actions(); ?>
	</li>
</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->
