<?php
	/*	
	*	Goodlayers Menu Management File
	*	---------------------------------------------------------------------
	*	This file use to include a necessary script / function for the 
	* 	navigation area
	*	---------------------------------------------------------------------
	*/
	
	// add action to enqueue superfish menu
	add_filter('gdlr_enqueue_scripts', 'gdlr_register_dlmenu');
	if( !function_exists('gdlr_register_dlmenu') ){
		function gdlr_register_dlmenu($array){	
			$array['style']['dlmenu'] = GDLR_PATH . '/plugins/dl-menu/component.css';
			
			$array['script']['modernizr'] = GDLR_PATH . '/plugins/dl-menu/modernizr.custom.js';
			$array['script']['dlmenu'] = GDLR_PATH . '/plugins/dl-menu/jquery.dlmenu.js';

			return $array;
		}
	}
	
	// creating the class for outputing the custom navigation menu
	if( !class_exists('gdlr_dlmenu_walker') ){
		
		// from wp-includes/nav-menu-template.php file
		class gdlr_dlmenu_walker extends Walker_Nav_Menu{		

			function start_lvl( &$output, $depth = 0, $args = array() ) {
				$indent = str_repeat("\t", $depth);
				$output .= "\n$indent<ul class=\"dl-submenu\">\n";
			}

		}
		
	}

?>