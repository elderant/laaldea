<?php

/**
 * Search Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>

<div class="bbp-reply-header">
	<div class="bbp-reply-title">
		<h3><?php esc_html_e( 'In reply to: ', 'bbpress' ); ?>
		<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a></h3>
	</div><!-- .bbp-reply-title -->
</div><!-- .bbp-reply-header -->

<div id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(); ?>>
	<div class="bbp-reply-author">

    <?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

    <div class="author-container text-center">
      <div class="avatar-container">
        <?php 
          $reply_author_id = bbp_get_reply_author_id();
          $avatar_url = get_user_meta( $reply_author_id, 'user_avatar', true);
          $teaching_institution = get_user_meta( $reply_author_id, 'user_institution', true);
        ?>
        <img src="<?php echo $avatar_url;?>" alt="<?php _e('User avatar image','laaldea');?>">
      </div>
      <div class="author-text-container">
        <div class="text-container text-center">
          <?php bbp_reply_author_link( array( 'show_role' => true ) ); ?>
        </div>
      </div>

      <div class="author-teaching-institution">
        <div class="text-container text-center">
          <?php echo $teaching_institution; ?>
        </div>
      </div>

      <?php if(true) : ?>

        <?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>

        <?php if ( current_user_can( 'moderate', bbp_get_reply_id() ) ) : ?>
          <div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>
        <?php endif;?>

        <div class="bbp-reply-location"><?php 
          $args = array( 
            'post_id' => bbp_get_reply_id(), 
            'before' => '', 
            'after' => '' 
          );
          wpb_child_the_location_from_ip( bbp_get_author_ip( $args ) ); ?>
        </div>

        <?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>

      <?php endif; ?>
    </div>


    <?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

  </div><!-- .bbp-reply-author -->

	<div class="bbp-reply-content">
    <img class="reply-background-image" src="/wp-content/uploads/tools-single-background.png" alt="<?php _e('Tool item background','laaldea')?>">

		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>

		<?php do_action( 'bbp_theme_after_reply_content' ); ?>

	</div><!-- .bbp-reply-content -->
</div><!-- #post-<?php bbp_reply_id(); ?> -->

