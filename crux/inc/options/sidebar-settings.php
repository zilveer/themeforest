<?php

add_action( 'admin_init', 'stag_sidebar_settings' );

function stag_sidebar_settings(){
	$settings['description'] = __( 'Configure how Sidebars appear on your site. You can change the setting of each individual page, post when editing that page', 'stag' );

	$sidebar_options = array(
		'right-sidebar' => __( 'Right Sidebar', 'stag' ),
		'left-sidebar'  => __( 'Left Sidebar', 'stag' ),
		'no-sidebar'    => __( 'No Sidebar', 'stag' )
	);

	$settings[] = array(
		'title'   => __( 'Sidebar on Single Post Pages', 'stag' ),
		'desc'    => __( 'Choose the default sidebar position for Single Posts Pages.', 'stag' ),
		'type'    => 'select',
		'val'	  => 'right-sidebar',
		'id'      => 'sidebar_single_page_layout',
		'options' => $sidebar_options
	);

	$settings[] = array(
		'title'   => __( 'Sidebar on Pages', 'stag' ),
		'desc'    => __( 'Choose the default sidebar position for Pages.', 'stag' ),
		'type'    => 'select',
		'val'	  => 'right-sidebar',
		'id'      => 'sidebar_page_layout',
		'options' => $sidebar_options
	);

	$settings[] = array(
		'title'   => __( 'Sidebar on Shop Page', 'stag' ),
		'desc'    => __( 'Choose the sidebar position for Shop Page.', 'stag' ),
		'type'    => 'select',
		'val'	  => 'no-sidebar',
		'id'      => 'sidebar_shop_page',
		'options' => $sidebar_options
	);

	$settings[] = array(
		'title'   => __( 'Sidebar on Archive Pages', 'stag' ),
		'desc'    => __( 'Choose the sidebar position for Archive Pages, this settings applies to all archive pages and product categories pages.', 'stag' ),
		'type'    => 'select',
		'val'	  => 'right-sidebar',
		'id'      => 'sidebar_archive_page_layout',
		'options' => $sidebar_options
	);

	$settings[] = array(
		'title'   => __( 'Sidebar on Blog Page', 'stag' ),
		'desc'    => __( 'Choose the sidebar position for Blog Page, this settings applies to all blog pages.', 'stag' ),
		'type'    => 'select',
		'val'	  => 'right-sidebar',
		'id'      => 'sidebar_blog_page_layout',
		'options' => $sidebar_options
	);

	if ( is_plugin_active( 'stag-custom-sidebars/stag-custom-sidebars.php' ) ) {
		$settings[] = array(
		    'title' => __( 'Create new Sidebar Areas', 'stag' ),
		    'desc'  => sprintf( __( 'You can also create custom sidebar areas. Simply open <a href="%s">Widgets page</a> and add a new Custom Widget Area. Afterwards you can choose to display widget area on edit page screen.', 'stag' ), admin_url('widgets.php') ),
		    'type'  => 'html',
		    'html'  => false,
		    'id'    => 'sidebar_info'
		);
	}

	stag_add_framework_page( __( 'Sidebar Settings', 'stag' ), $settings, 16 );
}
