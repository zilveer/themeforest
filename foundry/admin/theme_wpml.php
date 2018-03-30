<?php 

if(!( function_exists('ebor_wpml_cleaner') )){
	function ebor_wpml_cleaner($items,$args) {
	      
	    if($args->theme_location == 'primary'){
	          
	        if (function_exists('icl_get_languages')) {
	            $items = str_replace('sub-menu', 'dropdown-menu', $items);
	            $items = str_replace('onclick="return false"', 'class="dropdown-toggle js-activated"', $items);
	            $items = str_replace('menu-item-language', 'menu-item-language dropdown', $items);
	        }
	  
	        return $items;
	    }
	    else
	        return $items;
	}
}
add_filter( 'wp_nav_menu_items', 'ebor_wpml_cleaner', 20,2 );