<?php

do_action( 'bp_before_group_header' );

?>

<div class="dd-bp-wrapper-primary">

	<div id="item-header-avatar" class="dd-bp-avatar">
		<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">

			<?php bp_group_avatar(); ?>

		</a>
	</div><!-- #item-header-avatar -->

	<div id="item-header-content">
		<h2><a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>"><?php bp_group_name(); ?></a></h2>
		
		<span class="dd-bp-activity"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span>
		<span class="dd-bp-group-type"><?php bp_group_type(); ?></span>

		<?php do_action( 'bp_before_group_header_meta' ); ?>

		<div id="item-meta" class="dd-bp-content">

			<?php bp_group_description(); ?>

			<?php do_action( 'bp_group_header_meta' ); ?>

		</div>

		<div id="item-buttons">

			<?php do_action( 'bp_group_header_actions' ); ?>

		</div><!-- #item-buttons -->

		<div class="clear"></div>

	</div><!-- #item-header-content -->

	<div id="item-actions" class="dd-bp-group-admins">

		<?php if ( bp_group_is_visible() ) : ?>

			<h3><?php _e( 'Group Admins', 'buddypress' ); ?></h3>

			<?php bp_group_list_admins();

			do_action( 'bp_after_group_menu_admins' );

			if ( bp_group_has_moderators() ) :
				do_action( 'bp_before_group_menu_mods' ); ?>

				<h3><?php _e( 'Group Mods' , 'buddypress' ); ?></h3>

				<?php bp_group_list_mods();

				do_action( 'bp_after_group_menu_mods' );

			endif;

		endif; ?>

	</div><!-- #item-actions -->

	<div class="clear"></div>

</div>

<?php
do_action( 'bp_after_group_header' );
do_action( 'template_notices' );
?>