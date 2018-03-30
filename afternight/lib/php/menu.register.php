<?php
	if ( function_exists('register_nav_menu') ) {
		register_nav_menus(
			array(
				'top_menu' => 'Top menu',
				'header_menu' => 'Main menu',
				'footer_menu' => 'Footer menu'
            )
		);
	}
?>