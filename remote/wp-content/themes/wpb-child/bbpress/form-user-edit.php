<?php

/**
 * bbPress User Profile Edit Part
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>

<form id="bbp-your-profile-mod" method="post" enctype="multipart/form-data">

	<h2 class="entry-title"><?php esc_html_e( 'Informacion de usuario', 'wpb_child' ) ?></h2>

	<?php do_action( 'bbp_user_edit_before' ); ?>

	<fieldset class="bbp-form user-info-section">
		<!-- <legend><?php esc_html_e( 'Name', 'bbpress' ) ?></legend> -->

		<?php do_action( 'bbp_user_edit_before_name' ); ?>

		<div class="form-row half-width">
			<!-- <label for="first_name"><?php esc_html_e( 'First Name', 'bbpress' ) ?></label> -->
			<input type="text" class="regular-text learning-input" name="first_name" id="first_name" 
        placeholder="<?php esc_html_e( 'First Name', 'bbpress' ) ?>" 
        value="<?php bbp_displayed_user_field( 'first_name', 'edit' ); ?>"/>
		</div>

		<div class="form-row half-width">
			<!-- <label for="last_name"><?php esc_html_e( 'Last Name', 'bbpress' ) ?></label> -->
			<input type="text" class="regular-text learning-input" name="last_name" id="last_name" 
        placeholder="<?php esc_html_e( 'Last Name', 'bbpress' ) ?>"
        value="<?php bbp_displayed_user_field( 'last_name', 'edit' ); ?>"/>
		</div>

		<div class="form-row half-width">
			<!-- <label for="nickname"><?php esc_html_e( 'Nickname', 'bbpress' ); ?></label> -->
			<input type="text" class="regular-text learning-input" name="nickname" id="nickname" 
        placeholder="<?php esc_html_e( 'Nickname', 'bbpress' ) ?>"
        value="<?php bbp_displayed_user_field( 'nickname', 'edit' ); ?>"/>
		</div>

		<div class="form-row half-width">
			<!-- <label for="display_name"><?php esc_html_e( 'Display Name', 'bbpress' ) ?></label> -->

			<?php laaldea_bbp_edit_user_display_name(); ?>

		</div>

		<?php do_action( 'bbp_user_edit_after_name' ); ?>

	</fieldset>

	<h2 class="entry-title"><?php esc_html_e( 'Contact Info', 'bbpress' ) ?></h2>

	<fieldset class="bbp-form contact-info-section">
		<!-- <legend><?php esc_html_e( 'Contact Info', 'bbpress' ) ?></legend> -->

		<?php do_action( 'bbp_user_edit_before_contact' ); ?>

		<div class="form-row half-width">
			<!-- <label for="url"><?php esc_html_e( 'Website', 'bbpress' ) ?></label> -->
			<input type="text" class="regular-text code learning-input" name="url" id="url" 
        placeholder="<?php esc_html_e( 'Website', 'bbpress' ) ?>"
        value="<?php bbp_displayed_user_field( 'user_url', 'edit' ); ?>" maxlength="200"/>
		</div>

		<?php foreach ( bbp_edit_user_contact_methods() as $name => $desc ) : ?>

			<div class="form-row half-width">
				<label for="<?php echo esc_attr( $name ); ?>"><?php echo apply_filters( 'user_' . $name . '_label', $desc ); ?></label>
				<input type="text" class="learning-input" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="<?php bbp_displayed_user_field( $name, 'edit' ); ?>" class="regular-text" />
			</div>

		<?php endforeach; ?>

		<?php do_action( 'bbp_user_edit_after_contact' ); ?>

	</fieldset>

	<h2 class="entry-title"><?php bbp_is_user_home_edit()
		? esc_html_e( 'About Yourself', 'bbpress' )
		: esc_html_e( 'About the user', 'bbpress' );
	?></h2>

	<fieldset class="bbp-form about-you-section">
		<!-- <legend><?php bbp_is_user_home_edit()
			? esc_html_e( 'About Yourself', 'bbpress' )
			: esc_html_e( 'About the user', 'bbpress' );
		?></legend> -->

		<?php do_action( 'bbp_user_edit_before_about' ); ?>

		<div class="form-row half-width">
			<!-- <label for="description"><?php esc_html_e( 'Biographical Info', 'bbpress' ); ?></label> -->
			<textarea class="learning-input" name="description" id="description" rows="5" cols="30"
        placeholder="<?php bbp_is_user_home_edit() ? esc_html_e( 'About Yourself', 'bbpress' ): esc_html_e( 'About the user', 'bbpress' );?>"
      ><?php bbp_displayed_user_field( 'description', 'edit' ); ?></textarea>
		</div>

		<?php do_action( 'bbp_user_edit_after_about' ); ?>

	</fieldset>

	<h2 class="entry-title"><?php esc_html_e( 'Account', 'bbpress' ) ?></h2>

	<fieldset class="bbp-form account-section">
		<!-- <legend><?php esc_html_e( 'Account', 'bbpress' ) ?></legend> -->

		<?php do_action( 'bbp_user_edit_before_account' ); ?>

		<div class="form-row half-width">
			<!-- <label for="user_login"><?php esc_html_e( 'Username', 'bbpress' ); ?></label> -->
			<input type="text" class="regular-text learning-input" name="user_login" id="user_login" 
        placeholder="<?php esc_html_e( 'Username', 'bbpress' ) ?>" 
        value="<?php bbp_displayed_user_field( 'user_login', 'edit' ); ?>" 
        maxlength="100" disabled="disabled"/>
		</div>

		<div class="form-row half-width">
			<!-- <label for="email"><?php esc_html_e( 'Email', 'bbpress' ); ?></label> -->
			<input type="text" class="learning-input" name="email" id="email" 
        placeholder="<?php esc_html_e( 'Email', 'bbpress' ) ?>" 
        value="<?php bbp_displayed_user_field( 'user_email', 'edit' ); ?>" 
        maxlength="100" class="regular-text" autocomplete="off" />
		</div>

		<div class="form-row half-width">
			<!-- <label for="url"><?php esc_html_e( 'Language', 'bbpress' ) ?></label> -->

			<?php bbp_edit_user_language(); ?>

		</div>

		<?php do_action( 'bbp_user_edit_after_account' ); ?>

	</fieldset>

	<?php if ( ! bbp_is_user_home_edit() && current_user_can( 'promote_user', bbp_get_displayed_user_id() ) ) : ?>

		<h2 class="entry-title"><?php esc_html_e( 'User Role', 'bbpress' ) ?></h2>

		<fieldset class="bbp-form user-role-section">
			<!-- <legend><?php esc_html_e( 'User Role', 'bbpress' ); ?></legend> -->

			<?php do_action( 'bbp_user_edit_before_role' ); ?>

			<?php if ( is_multisite() && is_super_admin() && current_user_can( 'manage_network_options' ) ) : ?>

				<div>
					<label for="super_admin"><?php esc_html_e( 'Network Role', 'bbpress' ); ?></label>
					<label>
						<input class="checkbox" type="checkbox" id="super_admin" name="super_admin"<?php checked( is_super_admin( bbp_get_displayed_user_id() ) ); ?> />
						<?php esc_html_e( 'Grant this user super admin privileges for the Network.', 'bbpress' ); ?>
					</label>
				</div>

			<?php endif; ?>

			<?php bbp_get_template_part( 'form', 'user-roles' ); ?>

			<?php do_action( 'bbp_user_edit_after_role' ); ?>

		</fieldset>

	<?php endif; ?>

  <div class="d-none">
    <?php do_action( 'bbp_user_edit_after' ); ?>
  </div>

	<fieldset class="submit submit-section">
		<!-- <legend><?php esc_html_e( 'Save Changes', 'bbpress' ); ?></legend> -->
		<div class="form-row half-width">

			<?php bbp_edit_user_form_fields(); ?>

			<button type="submit" id="bbp_user_edit_submit" name="bbp_user_edit_submit" class="button submit user-submit learning-button h6"><?php bbp_is_user_home_edit()
				? esc_html_e( 'Update Profile', 'bbpress' )
				: esc_html_e( 'Update User',    'bbpress' );
			?></button>
		</div>
	</fieldset>
</form>
