<?php
/**
 * Register Theme Menus
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

// Theme support adding changed from 'nav-menus' to just 'menus'
add_theme_support( 'menus' );
 
// Function for registering wp_nav_menu()
if ( !function_exists( 'sd_register_navmenus' ) ) {
	function sd_register_navmenus() {
		
		register_nav_menus( array(
			'top-bar-menu' => __( 'Top Bar Menu', 'sd-framework' )
			)
		);
		
		register_nav_menus( array(
			'main-header-menu' => __( 'Main Header Menu', 'sd-framework' )
			)
		);
		
		register_nav_menus( array(
			'footer-menu' => __( 'Footer Menu', 'sd-framework' )
			)
		);
	}
	add_action( 'init', 'sd_register_navmenus' );
}

//get top bar menu slug

if ( !function_exists( 'sd_get_menu_slug' ) ) {
	function sd_get_menu_slug( $theme_location ) {
	
		if ( ! $theme_location ) return false;
	 
		$theme_locations = get_nav_menu_locations();
		
		if ( ! isset( $theme_locations[$theme_location] ) ) return false;
	 
		$menu_obj = get_term( $theme_locations[$theme_location], 'nav_menu' );
		if ( ! $menu_obj ) $menu_obj = false;
		if ( ! isset( $menu_obj->name ) ) return false;
		
		// Make a slug out of the menu name now we know it exists
		$menu_name = strtolower( $menu_obj->name );
		$menu_name = str_replace( " ", "-", $menu_name ); 
	 
		return $menu_name;
	}
	$top_bar_menu_slug = sd_get_menu_slug( 'top-bar-menu' );
}


//top bar menu
if ( !function_exists( 'sd_menu_top_addons' ) ) {
	function sd_menu_top_addons( $items, $args ) {
		if( ! ( $args->theme_location == 'top-bar-menu' ) )
			return $items;
			
		global $woocommerce, $sd_data;
		
		$top_bar_menu_icon = $sd_data['sd_top_bar_search_icon'];
		$minicart_top      = ( isset( $sd_data['sd_minicart_top'] ) ? $sd_data['sd_minicart_top'] : NULL );

		if ( sd_is_woo() && $minicart_top == '1' ) { 
			
			if ( sizeof( $woocommerce->cart->cart_contents ) > 0 ) {
				$count = $woocommerce->cart->cart_contents_count;
				$nr = '<span class="sd-nr sd-items-count sidr-class-sd-nr">' . $count . '</span>';
			} else {
				$nr = '<span class="sd-nr sidr-class-sd-nr"></span>';	
			}
		
			$items .= '<li class="sd-minicart-icon mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page"><a class="sd-minicart-link" href="#" title="' . __( 'View cart content', 'sd-framework' ) . '"><i class="fa fa-shopping-cart"></i>' . $nr . '</a></li>';
		}
		
		if ( $top_bar_menu_icon == '1' ) {
			$items .= '<li class="sd-menu-search">' . get_search_form( false ) . '</li>';
		}
		
		return $items;
	}
	
	add_filter( 'wp_nav_menu_' . $top_bar_menu_slug . '_items', 'sd_menu_top_addons', 10, 2 );
}

//main menu
if ( !function_exists( 'sd_main_menu_addons' ) ) {
	function sd_main_menu_addons( $items, $args ) {
		if( ! ( $args->theme_location == 'main-header-menu' ) )
			return $items;
		
		global $woocommerce, $sd_data;
		
		$search_main    = $sd_data['sd_main_menu_search_icon'];
		$minicart_main  = ( isset( $sd_data['sd_minicart_main'] ) ? $sd_data['sd_minicart_main'] : NULL ) ;
		
		if ( sd_is_woo() && $minicart_main == '1' ) { 
			
			if ( sizeof( $woocommerce->cart->cart_contents ) > 0 ) {
				$count = $woocommerce->cart->cart_contents_count;
				$nr = '<span class="sd-nr sd-items-count sidr-class-sd-nr">' . $count . '</span>';
			} else {
				$nr = '<span class="sd-nr sidr-class-sd-nr"></span>';	
			}
		
			$items .= '<li class="sd-minicart-icon mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page"><a class="sd-minicart-link" href="#" title="' . __( 'View cart content', 'sd-framework' ) . '"><i class="fa fa-shopping-cart"></i>' . $nr . '</a></li>';
		}
		
		if ( $search_main == '1' ) {
			$items .= '<li class="sd-menu-search">' . get_search_form( false ) . '</li>';
		}
		
		return $items;	
	}
	add_filter( 'wp_nav_menu_items', 'sd_main_menu_addons', 10, 2 );
}
