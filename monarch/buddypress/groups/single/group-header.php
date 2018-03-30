<?php
/**
 * BuddyPress - Groups Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of a group's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_group_header' );

?>

<div id="item-actions">

	<?php if ( bp_group_is_visible() ) : ?>

		<h3><?php _e( 'Group Admins', 'buddypress' ); ?></h3>

		<?php bp_group_list_admins();

		/**
		 * Fires after the display of the group's administrators.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_after_group_menu_admins' );

		if ( bp_group_has_moderators() ) :

			/**
			 * Fires before the display of the group's moderators, if there are any.
			 *
			 * @since 1.1.0
			 */
			do_action( 'bp_before_group_menu_mods' ); ?>

			<h3><?php _e( 'Group Mods' , 'buddypress' ); ?></h3>

			<?php bp_group_list_mods();

			/**
			 * Fires after the display of the group's moderators, if there are any.
			 *
			 * @since 1.1.0
			 */
			do_action( 'bp_after_group_menu_mods' );

		endif;

	endif; ?>

</div><!-- #item-actions -->

<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
	<div id="item-header-avatar">
		<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">

			<?php bp_group_avatar(); ?>

		</a>
	</div><!-- #item-header-avatar -->
<?php endif; ?>

		<div id="item-header-content">

			<div class="name">
				<?php the_title( '<h2>', '</h2>' ); ?>

				<span class="activity"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span>
				
				<span><?php do_action( 'bp_before_group_header_meta' ); ?></span>
			</div>

			<div id="item-meta">

				<div id="latest-update">
					<?php bp_group_type(); ?> <div class="popover-overlay"><a class="groupdescr" href="#" title="<?php _e( 'Description', 'buddypress' ); ?>"><i class="ion-clipboard"></i></a>

						<div class="popover fade top in" role="tooltip" id="popover-groupdescr">
						<div class="arrow"></div>
							<div class="popover-content">
								<?php bp_group_description(); ?>
							</div>
						</div>

					</div>
				</div>

				<?php do_action( 'bp_group_header_meta' ); ?>

			</div>

			<div id="item-buttons"><?php do_action( 'bp_group_header_actions' ); ?></div> 
			<!-- #item-buttons -->
				
		</div><!-- #item-header-content -->

<?php

/**
 * Fires after the display of a group's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_group_header' );

/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
do_action( 'template_notices' );
?>
