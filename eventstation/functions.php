<?php
	define( 'eventstation_VERSION', '1.1.1' );
	include (get_template_directory() . '/include/functions/core.php');
	include (get_template_directory() . '/include/functions/tgm.php');
	include (get_template_directory() . '/include/functions/pagination.php');
	include (get_template_directory() . '/include/functions/widget.php');
	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_show_new_layout', '__return_false' );
	add_filter( 'ot_theme_mode', '__return_true' );
	require get_template_directory() .'/include/optiontree/ot-fonts.php';
	require get_template_directory() .'/include/optiontree/ot-radioimages.php';
	require get_template_directory() .'/include/optiontree/ot-metaboxes.php';
	require get_template_directory() .'/include/optiontree/ot-themeoptions.php';
	require get_template_directory() .'/include/optiontree/ot-functions.php';
	require get_template_directory() .'/include/optiontree/ot-category.php';
	require get_template_directory() .'/include/optiontree/selection.php';
	if ( ! class_exists( 'OT_Loader' ) ) {
		require get_template_directory() .'/admin/ot-loader.php';
	}
