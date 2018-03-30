<?php

do_action( 'bp_before_group_header' );

?>

<div id="item-header-avatar">
	<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">
		<?php bp_group_avatar(); ?>
		<span class="highlight"><?php bp_group_type(); ?></span>
	</a>
	<span class="activity"><?php printf( __( 'active %s', '__x__' ), bp_get_group_last_active() ); ?></span>
</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<h1 class="x-item-header-title"><?php echo x_buddypress_get_the_title(); ?></h1>

	<?php do_action( 'bp_before_group_header_meta' ); ?>

	<div id="item-meta">

		<?php bp_group_description(); ?>

		<div id="item-buttons">

			<?php do_action( 'bp_group_header_actions' ); ?>

		</div><!-- #item-buttons -->

		<div id="item-actions">

			<?php if ( bp_group_is_visible() ) : ?>

				<div class="item-action group-admins cf">
					<h3 class="cfc-b-tx"><?php _e( 'Admins', '__x__' ); ?></h3>
					<?php bp_group_list_admins();
					do_action( 'bp_after_group_menu_admins' ); ?>
				</div>

				<?php if ( bp_group_has_moderators() ) : ?>

					<div class="item-action group-mods cf">
						<?php do_action( 'bp_before_group_menu_mods' ); ?>
						<h3 class="cfc-b-tx"><?php _e( 'Mods' , '__x__' ); ?></h3>
						<?php bp_group_list_mods();
						do_action( 'bp_after_group_menu_mods' ); ?>
					</div>

				<?php endif;

			endif; ?>

		</div><!-- #item-actions -->

		<?php do_action( 'bp_group_header_meta' ); ?>

	</div>

</div><!-- #item-header-content -->

<?php
do_action( 'bp_after_group_header' );
do_action( 'template_notices' );
?>