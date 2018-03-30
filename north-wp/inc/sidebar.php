<?php
function thb_register_sidebars() {
	register_sidebar(array('name' => 'Shop Sidebar', 'id' => 'shop', 'description' => 'The sidebar visible in the shop page, if its enabled in theme options', 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));
	
	register_sidebar(array('name' => 'Shop Sidebar', 'id' => 'shop', 'description' => 'The sidebar visible in the shop page, if its enabled in theme options', 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));
	
	register_sidebar(array('name' => 'Footer Column 1', 'id' => 'footer1', 'description' => 'Footer - First column - Used when widget option is selected in Theme Options -> Footer -> Footer Product Selection', 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));

	register_sidebar(array('name' => 'Footer Column 2', 'id' => 'footer2', 'description' => 'Footer - Second column - Used when widget option is selected in Theme Options -> Footer -> Footer Product Selection', 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));

	register_sidebar(array('name' => 'Footer Column 3', 'id' => 'footer3', 'description' => 'Footer - Third column - Used when widget option is selected in Theme Options -> Footer -> Footer Product Selection', 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));

	register_sidebar(array('name' => 'Footer Column 4', 'id' => 'footer4', 'description' => 'Footer - Forth column - Used when widget option is selected in Theme Options -> Footer -> Footer Product Selection', 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));
	
	register_sidebar(array('name' => 'Footer Column 5', 'id' => 'footer5', 'description' => 'Footer - Fifth column - Used when widget option is selected in Theme Options -> Footer -> Footer Product Selection', 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));
	
	register_sidebar(array('name' => 'Footer Column 6', 'id' => 'footer6', 'description' => 'Footer - Sixth column - Used when widget option is selected in Theme Options -> Footer -> Footer Product Selection', 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));
}
add_action( 'widgets_init', 'thb_register_sidebars' );

function thb_sidebar_setup() {
	$sidebars = ot_get_option('sidebars');
	if(!empty($sidebars)) {
		foreach($sidebars as $sidebar) {
			register_sidebar( array(
				'name' => $sidebar['title'],
				'id' => $sidebar['id'],
				'description' => '',
				'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h6>',
				'after_title' => '</h6>',
			));
		}
	}
	if ( class_exists('WCML_WC_MultiCurrency')) {
		global $WCML_WC_MultiCurrency;
		remove_action('woocommerce_product_meta_start', array($WCML_WC_MultiCurrency, 'currency_switcher'));
	}
}
add_action( 'after_setup_theme', 'thb_sidebar_setup' );