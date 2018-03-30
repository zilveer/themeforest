<?php
/**
 * General Admin Functions
 *
 * More in other includes such as those for custom post types
 */

/*******************************************
 * AFTER ACTIVATION
 *******************************************/

/**
 * After initial theme activation:
 * - Delete sample post, page and comment
 * - Ask user to import Risen sample content XML file
 * - Create empty header/footer menus and assign to proper locations
 * - Change "Front page displays" to "posts" (it will be hidden from user)
 */

function risen_after_activate() {

	global $wp_rewrite;

	// Theme was just activated
	if ( ! empty( $_GET['activated'] ) ) {

		// Don't do this is if theme (or child) was previously activated
		if ( get_option( 'risen_activated' ) !== '1' ) {
			
			// Delete WordPress sample post, page and comment
			wp_delete_post( 1 ); // move to trash
			wp_delete_post( 2 ); // move to trash
			wp_delete_comment( 1 );
			
			// Show message to user asking to import data
			add_action( 'admin_notices', 'risen_import_notice' );
			
			// Set permalink structure to match that of sample content
			update_option( 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/' ); // "Day and name"
			update_option( 'category_base', '' ); // "Day and name"
			update_option( 'tag_base', '' ); // "Day and name"

			// Change "Front page displays" to "posts" (regular homepage)
			update_option( 'show_on_front', 'posts' );
		
			// Flag this task as done so it is not repeated on reactivation
			update_option( 'risen_activated', '1' );
		  
		}

		// Update .htaccess so rewrite URL's for friendly URL's to work right away
		// Do it on every activate to be safe
		add_action( 'init', 'risen_flush_rewrite_rules', 11 ); // after custom post types, taxonomies registered at 10
		
		// Add 'Header Menu' to Header location if it is not already
		risen_set_header_menu();
		
		// Add 'Footer Menu' to Footer location if it is not already
		risen_set_footer_menu();
		
		// Set _risen_event_latest_date for all events (makes events added earlier than 1.1.0 work)
		risen_events_prepare_data( 'force' );
		
	}
	
}

/**
 * Add 'Header Menu' to Header location if it is not already
 * First menu available is assigned to Header. If none, 'Header Menu' is added first.
 * We always run this because Import XML will create menu fine, but not add it to Header (and it cannot be added to header unless created)
 * This is run on theme activation/reactivation, because parent needs it first time and child theme will also need it on that "second" activation
 */

if ( ! function_exists( 'risen_set_header_menu' ) ) {

	function risen_set_header_menu() { // Note: this must be in admin.php, not menu.php

		// No menu added to Header location yet
		$locations = get_nav_menu_locations();
		if ( empty( $locations['header'] ) || is_wp_error( $locations['header'] ) ) { // this instead of has_nav_menu() because that sometimes returned true because it doesn't consider error object

			// Get existing menus
			$menus = get_terms( 'nav_menu', array(
				'orderby' 		=> 'id', // oldest first
				'order'			=> 'ASC',
				'hide_empty'	=> false, // get menus without items
				'hierarchical'	=> false
			) );

			// Get 'Header Menu' if it exists, otherwise first menu created (unless that is an old "Footer Menu")
			if ( is_nav_menu( 'header-menu' ) ) { // menu exists
				foreach ( $menus as $menu ) {
					if ( 'header-menu' == $menu->slug ) {
						$menu_id = $menu->term_id;
						break;
					}
				}
			} else if ( isset( $menus[0]->term_id ) && 'footer-menu' != $menus[0]->slug ) {
				$menu_id = $menus[0]->term_id;
			}

			// If no menus exist, create Header Menu so we can add it to location
			if ( empty( $menu_id ) ) {
				$menu_id = wp_create_nav_menu( 'Header Menu' );			
			}

			// Add menu to Header location
			if ( ! empty( $menu_id ) ) {
				$locations = (array) $locations;
				set_theme_mod( 'nav_menu_locations', array_merge( $locations, array(
					'header' => $menu_id,
				) ) );		
			}

		}
		
	}
	
}

/**
 * Add 'Footer Menu' to Footer location if it is not already
 * We always run this because Import XML will create menu fine, but not add it to Footer (and it cannot be added to footer unless created)
 * This is run on theme activation/reactivation, because parent needs it first time and child theme will also need it on that "second" activation
 */

if ( ! function_exists( 'risen_set_footer_menu' ) ) {

	function risen_set_footer_menu() { // Note: this must be in admin.php, not menu.php

		// No menu added to Footer location yet
		$locations = get_nav_menu_locations();
		if ( empty( $locations['footer'] ) || is_wp_error( $locations['footer'] ) ) { // this instead of has_nav_menu() because that sometimes returned true because it doesn't consider error object

			// Get existing menus
			$menus = get_terms( 'nav_menu', array(
				'orderby' 		=> 'id', // oldest first
				'order'			=> 'ASC',
				'hide_empty'	=> false, // get menus without items
				'hierarchical'	=> false
			) );

			// Get 'Footer Menu' if it exists
			if ( is_nav_menu( 'footer-menu' ) ) { // menu exists
				foreach ( $menus as $menu ) {
					if ( 'footer-menu' == $menu->slug ) {
						$menu_id = $menu->term_id;
						break;
					}
				}
			}

			// If no footer menu exist, create Footer Menu so we can add it to location
			if ( empty( $menu_id ) ) {
				$menu_id = wp_create_nav_menu( 'Footer Menu' );			
			}

			// Add menu to Footer location
			if ( ! empty( $menu_id ) ) {
				$locations = (array) $locations;
				set_theme_mod( 'nav_menu_locations', array_merge( $locations, array(
					'footer' => $menu_id,
				) ) );		
			}

		}
		
	}
	
}

/**
 * Flush rewrite rules
 *
 * This called on init priority 11 in risen_after_activate() so it's done after custom post types, taxonomies registered.
 */

function risen_flush_rewrite_rules() {

	flush_rewrite_rules();

}

/**
 * Message to show to user after activation
 */

function risen_import_notice() {

	$install_url = 'http://stevengliebe.com/projects/wordpress-themes/risen/docs/#installation';

	printf( __( '<div class="updated"><p>You can <a href="%1$s">Import</a> <b>sample-content.xml</b> for a better starting point (<a href="%2$s" target="_blank">Instructions</a>).</p></div>', 'risen' ), admin_url( 'import.php' ), $install_url );

}

/*******************************************
 * ENQUEUE STYLES
 *******************************************/

// Enqueue admin stylesheets

function risen_admin_css() {

	$screen = get_current_screen();

	// Always enable thickbox on add/edit post for custom meta upload fields
	if ( 'post' == $screen->base ) {
		wp_enqueue_style( 'thickbox' );
	}
	
	// Main admin styles
	wp_enqueue_style( 'risen-admin', risen_locate_template_uri( 'style-admin.css' ), false, RISEN_VERSION );  // bust cache on theme update
	
}

// Add helper classes to admin <body> for easier style tweaks via style-admin.css (hiding "Preview" button per post type)

function risen_admin_body_classes( $classes ) {

	$new_classes = array();
	
	// Add useful get_current_screen() values
	$screen = get_current_screen();
	$screen_keys = array('action', 'base', 'id', 'post_type', 'taxonomy');
	foreach( $screen_keys as $screen_key ) {
		if ( ! empty( $screen->$screen_key ) ) {
			$new_classes[] = 'screen-' . $screen_key . '-' . $screen->$screen_key;
		}
	}

	// Append list
	if ( ! empty( $new_classes ) ) {
		$classes .= implode( ' ', $new_classes );
	}
	
	return $classes;
	
}

/*******************************************
 * ENQUEUE JAVASCRIPT
 *******************************************/
 
function risen_admin_js() {
	
	$screen = get_current_screen();

	// Always enable media-upload and thickbox on add/edit post for custom meta upload fields
	if ( 'post' == $screen->base ) {
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
	}
	
	// Google Web Font Loader (for live preview in Theme Options)
	if ( 'appearance_page_options-framework' == $screen->id ) { // load for options framework only
		wp_enqueue_script( 'google-webfont-loader', risen_current_protocol() . '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js', false, null ); // null - don't mess with Google Web Fonts URL by adding version
	}

	// Main admin JavaScript
	if (
		'post' == $screen->base // add or edit any post type
		|| 'appearance_page_options-framework' == $screen->base // Theme Options
		|| 'options-reading' == $screen->base // Reading Settings
	) { // don't enqueue unless needed (thanks Codestyling Localization plugin for your warning on this!)
	
		wp_enqueue_script( 'risen-admin', risen_locate_template_uri( 'js/admin.js' ), false, RISEN_VERSION ); // bust cache on theme update

		wp_localize_script( 'risen-admin', 'risen_wp_admin', array( // pass WP data into JS from this point on
			'colorable_background_images' => risen_colorable_background_images(), // tell admin.js which Theme Option background image presets should show the color picker
			'options_framework' => 'appearance_page_options-framework' == $screen->id ? true : false, // we are in Options Framework
			'font_preview_text' => __( 'The quick brown fox jumps over the lazy dog', 'risen' ),
			'meta_insert_file_button' => __( 'Use This File', 'risen' )
		)); 
		
	}
	
}

/*******************************************
 * ADMIN MENU
 *******************************************/

/**
 * Remove and rename admin menu items
 */
 
function risen_admin_menu() {

	global $menu;

	// Rename Posts > Blog
	if ( in_array( 'edit_posts', $menu[5] ) ) {
		$menu[5][0] = _x( 'Blog Posts', 'admin menu', 'risen' );
	}
	
	// Rename Media > Media Files
	if ( in_array( 'upload_files', $menu[10] ) ) {
		$menu[10][0] = _x( 'Media Files', 'admin menu', 'risen' ); // making WP's "Media" more distinct to differentiate from our "Multimedia" CPT
	}

}

/**
 * Change admin menu item ordering
 */

// Enable custom menu order
function risen_custom_menu_order() {
	return true;
}

// Modify item order
function risen_menu_order( $menu_ord ) {

	//print_r($menu_ord); exit; // uncomment to see original array and item values
	
	// move Media Library, Blog and Comments after Locations
	$locations_uri = 'edit.php?post_type=risen_location'; // last item in menu section
	risen_move_admin_menu_item( $menu_ord, 'upload.php', $locations_uri ); // Media Library - last
	risen_move_admin_menu_item( $menu_ord, 'edit-comments.php', $locations_uri ); // Comments - second to last
	risen_move_admin_menu_item( $menu_ord, 'edit.php', $locations_uri ); // Blog Posts - third to last

	// move Pages after Home Slider and Home Boxes
	risen_move_admin_menu_item( $menu_ord, 'edit.php?post_type=page', 'edit.php?post_type=risen_home_box' );
	
	// return manipulated menu array
	return $menu_ord;

}

/**
 * Function to move admin menu item before or after another
 *
 * Use this with custom_menu_order and menu_order filters.
 *
 * @param	array		$menu_ord		The original menu from menu_order filter
 * @param	string	$move_item	Value of item in array to move
 * @param	string	$target_item	Value of item in array to move $move_item before or after
 * @param	string	$position		Position 'after' (default) or 'before' in which to place $move_item in relation to $target_item
 */
 
if ( ! function_exists( 'risen_move_admin_menu_item' ) ) {

	function risen_move_admin_menu_item( &$menu_ord, $move_item, $target_item, $position = 'after' ) {
	
		// make sure items given are in array
		if ( in_array( $move_item, $menu_ord ) && in_array( $target_item, $menu_ord ) ) {
		
			// get position of each item
			$move_key = array_search( $move_item, $menu_ord );
			$move_key_after = array_search( $target_item, $menu_ord );

			// move item before instead of after
			if ( 'before' == $position ) {
				$move_key_after = ( $move_key_after - 1 ) >= 0 ? ( $move_key_after - 1 ) : 0; // move after item before item to move after (unless item to move after is at very top)
			}
			
			// move one item directly after the other
			if ( $move_key < $move_key_after ) { // item to move is currently before item to move after
				$menu_ord = array_merge(
					array_slice( $menu_ord, 0, $move_key ), // everything before item being moved
					array_slice( $menu_ord, $move_key + 1, $move_key_after - $move_key ), // everything after item being moved through item to move after
					array( $menu_ord[$move_key] ), // add item to move after item to move after
					array_slice( $menu_ord, $move_key_after + 1 ) // everything after item to move after
				);
			} else if ( $move_key > $move_key_after ) { // item to move is currently after item to move directly after
				$menu_ord = array_merge(
					array_slice( $menu_ord, 0, $move_key_after + 1 ), // everything from item to move after and before
					array( $menu_ord[$move_key] ), // add item to move after item to move after
					array_slice( $menu_ord, $move_key_after + 1, $move_key - $move_key_after - 1 ), // everything after item to move after and before item to move
					array_slice( $menu_ord, $move_key + 1 ) // everything after item to move
				);
			}
			
			// if moving item before very first item, run again but with $move_item and $target_item inverted
			// there was no higher item to move after so we ran as normal and now swap the new two top items
			if ( 'before' == $position && 0 == $move_key_after ) {
				risen_move_admin_menu_item( $menu_ord, $target_item, $move_item ); // run again with item to move and item to move after swapped
			}
			
		}
		
		// return manipulated menu or original menu if no manipulation done
		return $menu_ord;
	
	}

}

/*******************************************
 * EDITOR MODIFICATIONS
 *******************************************/

/**
 * Apply stylesheet to editor to better match actual content output on site
 */
 
function risen_mce_editor_css() {

	add_editor_style( 'style-editor.css' );
	
}

/*******************************************
 * UPDATES
 *******************************************/

/**
 * Prevent automatic updates from wordpress.org
 * by Mark Jaquith (http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/)
 * to avoid this issue: http://wpcandy.com/reports/developers-theme-commune-upgraded-to-different-commune
 * Note: only works for active theme (would need to be in plugin w/hardcoded theme name otherwise)
 */

function risen_prevent_wrong_update( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}
