<?php

/**
 * BuddyPress - Users Header
 */

?>

<?php do_action( 'bp_before_member_header' ); ?>

<div class="dd-bp-wrapper-secondary" id="dd-bp-member-header">

	<div id="item-header-avatar" class="dd-bp-avatar">
		
		<a href="<?php bp_displayed_user_link(); ?>">

			<?php bp_displayed_user_avatar( 'type=full' ); ?>

		</a>

	</div><!-- #item-header-avatar -->

	<div id="item-header-content">

		<div class="item-title" id="dd-bp-member-header-name">
			<a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_fullname(); ?></a>
		</div>

		<span class="user-nicename">@<?php bp_displayed_user_username(); ?></span>
		<span class="activity dd-bp-comment-time-since"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>

		<div class="clear"></div>

		<?php do_action( 'bp_before_member_header_meta' ); ?>

		<div id="item-meta">

			<?php if ( bp_is_active( 'activity' ) ) : ?>

				<div id="latest-update" class="dd-bp-content"><?php bp_activity_latest_update( bp_displayed_user_id() ); ?></div>

			<?php endif; ?>

			<?php
			/***
			 * If you'd like to show specific profile fields here use:
			 * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
			 */
			 do_action( 'bp_profile_header_meta' );

			 ?>

		</div><!-- #item-meta -->

		<div id="item-buttons">

			<?php do_action( 'bp_member_header_actions' ); ?>

		</div><!-- #item-buttons -->

		<div class="clear"></div>

	</div><!-- #item-header-content -->

</div>

<?php do_action( 'bp_after_member_header' ); ?>

<?php do_action( 'template_notices' ); ?>