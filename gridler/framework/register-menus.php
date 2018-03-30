<?php

// custom menu support
add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
	  		array(
	  		  'primary-nav' => 'Primary Nav',
	  		)
	  	);
	}
							
?>