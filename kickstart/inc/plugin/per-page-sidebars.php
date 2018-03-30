<?php
/*
Plugin Name: Per Page Sidebars
Plugin URI: http://TheCodeCave.com/plugins/per-page-sidebars
Description: Allows the creation and display of custom sidebars for each page on your site.
Version: 2.0.0 / Edited by MNKY Studio
Author: Brian Layman
Author URI: http://eHermitsInc.com
License: GPLv2
Requires: 3.1.0
Original Design Notes: 
	In an Edit Page screen display a radio of all registered sidebars, save the choice it to postmeta. 
	When a page is loaded/displayed, if the postmeta value exists overwrite the replaced sidebar's 
	widgets with those setup for the custom sidebar. The sidebar settings MUST remain those created by 
	the theme.
	On the Widget page, all custom sidebars are listed and displayed for customization.
	The post meta should start with an _ so it is hidden.
	If you can't change widgets you shouldn't be able to create a custom sidebar.
*/

/*	Copyright 2012 Brian Layman ( email : plugins@ehermitsinc.com )

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as 
		published by the Free Software Foundation.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA	02110-1301	USA
*/


if ( !function_exists( 'get_pps_post_ids' ) ) {

	// ************************************************************
	// Constants
	// ************************************************************
	define( 'PPS_KEY_REPLACED', '_tcc-pps-replace' );
	define( 'SIDEBAR_PREFIX', 'CUSTOM-' );

	// ************************************************************
	// Helper Functions
	// ************************************************************
	// ************************************************************
	//  get_pps_post_ids
	//  Retrieves the IDs of all posts with a replaced sidebar.
	// ************************************************************
	function get_pps_post_ids() {
		global $wpdb;
		$posts_w_sidebars = $wpdb->get_col( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = %s", PPS_KEY_REPLACED ) );
		return $posts_w_sidebars;
	}

	// ************************************************************
	//  tcc_pps_add_checked
	//
	//  Used to mark a selection as checked in HTML.
	// ************************************************************
	function tcc_pps_add_checked( $testvalue, $value ) {
		if ( $testvalue == $value ) 
			return ' checked="checked" ';
	}

	// ************************************************************
	// Methods
	// ************************************************************

	// ************************************************************
	//  pps_add_custom_box
	//
	//  This adds the sidebar replacement selection box to the 
	//  Edit->Page screens.
	// ************************************************************
	function pps_add_custom_box() {
		// This security check is also verified upon save.
		if ( current_user_can( 'edit_theme_options' ) ) {
			add_meta_box( 'pps_sectionid', __( 'Custom Sidebar', 'tcc_pps_domain' ), 'pps_inner_custom_box', 'post', 'advanced', 'high' );
			add_meta_box( 'pps_sectionid', __( 'Custom Sidebar', 'tcc_pps_domain' ), 'pps_inner_custom_box', 'page', 'advanced', 'high' );
		}
	}

	// ************************************************************
	//  pps_inner_custom_box
	//
	//  This displays the sidebar replacement selection box
	// ************************************************************
	function pps_inner_custom_box( $post ) {
		global $wp_registered_sidebars;
		$replaced_sidebar=get_post_meta( $post->ID, PPS_KEY_REPLACED, true );
		$pps_active_on_post = ( isset( $wp_registered_sidebars[ $replaced_sidebar ] ) );

		if (function_exists('wp_nonce_field')) {
			wp_nonce_field('pps_nonce_action','pps_nonce_field');
		}
		echo '<input type="checkbox" value="1" id="tcc-pps-active" name="tcc-pps-active" class="tcc-pps-checkbox" ' .
			tcc_pps_add_checked( $pps_active_on_post, true ) . '/> <label for="tcc-pps-active">' . __( 'Activate Custom Sidebar?', 'tcc_pps_domain' ) . 
			'</label><br/><br/>';
		echo '<div class="tcc-pps-radio-replace-buttons">';
		echo '	<label for="tcc-pps-replace">' . __( 'Select a sidebar to replace:', 'tcc_pps_domain' ) . '</label><br/>';
		// Print the list of sidebars in the drop down
		foreach ( $wp_registered_sidebars as $id => $sidebar ) {
			$description = $sidebar[ 'description' ];
			if ( isset( $sidebar[ 'name' ] ) ) {
				$name = $sidebar[ 'name' ];
			} else {
				$name = $id;
			}

			// Eliminate any self created sidebars or this could get messy.
			if ( substr( $name, 0, strlen( SIDEBAR_PREFIX ) ) != SIDEBAR_PREFIX ) {
				echo '			<span class="tcc-pps-radio-option"><input type="radio" name="tcc-pps-replace" value="' . $id . 
				'" class="tcc-pps-radio" ' . tcc_pps_add_checked( $replaced_sidebar, $id ) . '/> ' . $name . ' - ' . $description . '</span><br/>';
			}
		}
		echo '		</div>';
	}

	// ************************************************************
	//  pps_save_postdata
	//
	//  Recieves the sidebar replacement data when a page is saved.
	// ************************************************************
	function pps_save_postdata( $post_id ) {
		global $wp_registered_sidebars;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;

		// This will eventualy need to be adjusted to deal 'edit_CUSTOMPOSTTYPE' permissions as the core does.
		// Assuming, of course, I extend the plugin to handle more than pages.
		if (('page' == isset($_POST['post_type']) && $_POST['post_type'] ) and current_user_can('edit_theme_options')) {
			if(!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			return $post_id;
		}

		// Return with no errors if the NONCE fails. This both blocks hack attacks AND prevents a save from removing
		// the data if plugin modification adds security checks on meta box display that aren't duplicated here.
		if( !isset( $_POST['pps_nonce_field'] ) || !wp_verify_nonce( $_POST['pps_nonce_field'], 'pps_nonce_action' ) ) return $post_id;
		
		if (isset($_POST['tcc-pps-active'])){
			$replaced_sidebar = $_POST['tcc-pps-replace'];
			$pps_active_on_post =  ($_POST['tcc-pps-active'] == 1) && (isset($wp_registered_sidebars[$replaced_sidebar]));
			
			if ($pps_active_on_post) {
				update_post_meta($post_id, PPS_KEY_REPLACED, $replaced_sidebar);
			} 
			return $post_id;
		} else {
			delete_post_meta($post_id, PPS_KEY_REPLACED);
		}
		
	}

	// ************************************************************
	//  pps_save_postdata
	//
	//  Adds the custom sidebar to the sidebar array as a page is
	//  loaded.
	// ************************************************************
	function pps_reg_custom_sidebar() {
		global $wp_query, $wp_registered_sidebars;
		if ( is_page() || is_post() ) {
			$post = $wp_query->get_queried_object();
			$post_id = $post->ID;
			$post_name = $post->post_name;
			$post_title = $post->post_title;
			$replaced_sidebar=get_post_meta( $post->ID, PPS_KEY_REPLACED, true );

			$pps_active_on_post = ( isset( $wp_registered_sidebars[ $replaced_sidebar ] ) );
			if ( $pps_active_on_post ) {
				register_sidebar( array( 
					'name' => SIDEBAR_PREFIX . $post_name,
					'id' => SIDEBAR_PREFIX . $post_name,
					'description' => 'A custom sidebar for the post "' . $post_title . '"' ) );
			}
		}
	}

	// ************************************************************
	//  pps_reg_all_custom_sidebars
	//
	//  Registers the custom sidebars for the admin pages.
	// ************************************************************
	function pps_reg_all_custom_sidebars() {
		global $wp_registered_sidebars;
		$posts = get_pps_post_ids();

		foreach ( $posts as $post_id ) {
			$post = get_post( $post_id );
			register_sidebar( array( 
				'name' => SIDEBAR_PREFIX . $post->post_name,
				'id' => SIDEBAR_PREFIX . $post->post_name,
				'description' => 'A custom sidebar for the post "' . $post->post_title . '"' ) );
		}
	}

	// ************************************************************
	//  pps_hijack_sidebars
	//
	//  Replaces the content but not the design of sidebars during
	//  the page display.
	// ************************************************************
	function pps_hijack_sidebars( $query ) {
		global $post, $wp_registered_sidebars, $_wp_sidebars_widgets, $wp_query;
		
		if ( $wp_query->is_posts_page )	{
			$hostpost = get_post( $wp_query->get_queried_object_id() );
		} else {
			$hostpost = $post;
		}
		if(!empty($hostpost)){
			$post_id = $hostpost->ID;	
			$post_name = $hostpost->post_name;
			$host_sidebar = get_post_meta( $hostpost->ID, PPS_KEY_REPLACED, true );
			
			while ( ( $host_sidebar == '' ) and  ( $hostpost->post_parent > 0 ) ) {
				$hostpost = get_post( $hostpost->post_parent );
				$host_sidebar = get_post_meta( $hostpost->ID, PPS_KEY_REPLACED, true );
				$post_id = $hostpost->ID;	 
				$post_name = $hostpost->post_name;		
			} 
			
			$parasite_sidebar = SIDEBAR_PREFIX . $post_name;
			if ( isset( $_wp_sidebars_widgets[ $parasite_sidebar ] ) ) {
				$_wp_sidebars_widgets[ $host_sidebar ] = $_wp_sidebars_widgets[ $parasite_sidebar ];
			}
		}
	}

	// ************************************************************
	// Executable Code
	// ************************************************************
	// Add the edit field to the Page Edit screens
	add_action( 'admin_menu', 'pps_add_custom_box' ); 

	// Process the custom PPS values submitted when saving pages.
	add_action( 'save_post', 'pps_save_postdata' );

	// Register the custom sidebars that have been created for the pages.
	add_action( 'admin_init', 'pps_reg_all_custom_sidebars' );

	// When a page is dipslayed, check for a custom sidebar and if it exists hijack the standard sidebar
	add_filter( 'wp', 'pps_hijack_sidebars' );	
}