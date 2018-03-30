<?php thb_sidebar_before(); ?>

<?php
	global $sidebars_count;

	$sidebars_count++;
	$id = '';

	if ( ! empty( $sidebar_type ) ) {
		$sidebar_class .= ' ' . 'thb-sidebar-' . $sidebar_type;
		$id = 'thb-sidebar-' . $sidebar_type . '-' . $sidebars_count;
	}
?>

<aside class="sidebar <?php echo esc_attr( $sidebar_class ); ?>" id="<?php echo esc_attr( $id ); ?>">
	<?php thb_sidebar_start(); ?>
	<?php dynamic_sidebar($sidebar); ?>
	<?php thb_sidebar_end(); ?>
</aside>

<?php thb_sidebar_after(); ?>