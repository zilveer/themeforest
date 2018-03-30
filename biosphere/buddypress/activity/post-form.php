<?php

/**
 * BuddyPress - Activity Post Form
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

$dd_fake_select = '<li><a href="#" data-group-id="0">'. __( 'My Profile', 'buddypress' ) .'</a></li>';

?>

<form action="<?php bp_activity_post_form_action(); ?>" method="post" id="whats-new-form" name="whats-new-form" role="complementary" class="dd-bp-wrapper-primary">

	<?php do_action( 'bp_before_activity_post_form' ); ?>

	<!-- Avatar -->

	<div id="whats-new-avatar">
		<a href="<?php echo bp_loggedin_user_domain(); ?>">
			<?php bp_loggedin_user_avatar( 'width=' . bp_core_avatar_thumb_width() . '&height=' . bp_core_avatar_thumb_height() ); ?>
		</a>
	</div>

	<!-- Title -->

	<h5><?php if ( bp_is_group() )
			printf( __( "What's new in %s, %s?", 'buddypress' ), bp_get_group_name(), bp_get_user_firstname() );
		else
			printf( __( "What's new, %s?", 'buddypress' ), bp_get_user_firstname() );
	?></h5>

	<!-- Textarea and submit -->

	<div id="whats-new-content">

		<!-- Textarea -->

		<div id="whats-new-textarea">
			<textarea name="whats-new" id="whats-new" placeholder="<?php _e( 'EXPRESS YOURSELF', 'dd_string' ); ?>"><?php if ( isset( $_GET['r'] ) ) : ?>@<?php echo esc_attr( $_GET['r'] ); ?> <?php endif; ?></textarea>
		</div>

		<!-- Submit -->

		<div id="whats-new-options">

			<div id="whats-new-submit">
				<input type="submit" name="aw-whats-new-submit" id="aw-whats-new-submit" class="dd-button fl" value="<?php _e( 'Post Update', 'buddypress' ); ?>" />
			</div>

			<?php if ( bp_is_active( 'groups' ) && !bp_is_my_profile() && !bp_is_group() ) : ?>

				<div id="whats-new-post-in-box">

					<span class="dd-bp-sep">In</span>

					<select id="whats-new-post-in" name="whats-new-post-in">
						<option selected="selected" value="0"><?php _e( 'My Profile', 'buddypress' ); ?></option>

						<?php if ( bp_has_groups( 'user_id=' . bp_loggedin_user_id() . '&type=alphabetical&max=100&per_page=100&populate_extras=0' ) ) :
							while ( bp_groups() ) : bp_the_group(); ?>

								<option value="<?php bp_group_id(); ?>"><?php bp_group_name(); ?></option>

								<?php $dd_fake_select .= '<li><a href="#" data-group-id="' . bp_get_group_id() . '">'. bp_get_group_name() .'</a></li>'; ?>

							<?php endwhile;
						endif; ?>

					</select>

					<div class="dd-button-dropdown dd-bp-post-in-fake">
						<div class="dd-button-dropdown-content">
							<ul>
								<?php echo $dd_fake_select; ?>
							</ul>
						</div><!-- .dd-button-content -->
						<a href="#" class="dd-button orange-light has-icon"><span class="dd-button-txt"><?php _e( 'My Profile', 'buddypress' ); ?></span><span class="dd-button-icon"><span class="icon-chevron-down"></span></span></a>
					</div><!-- .dd-button -->

				</div>

				<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />

			<?php elseif ( bp_is_group_home() ) : ?>

				<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />
				<input type="hidden" id="whats-new-post-in" name="whats-new-post-in" value="<?php bp_group_id(); ?>" />

			<?php endif; ?>

			<?php do_action( 'bp_activity_post_form_options' ); ?>

			<div class="clear"></div>

		</div><!-- #whats-new-options -->

	</div><!-- #whats-new-content -->

	<?php wp_nonce_field( 'post_update', '_wpnonce_post_update' ); ?>
	<?php do_action( 'bp_after_activity_post_form' ); ?>

</form><!-- #whats-new-form -->
