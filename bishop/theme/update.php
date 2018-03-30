<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Update scripts
 */

if ( function_exists('cx_api') ) {
	add_action( 'yit_theme_updated', 'cx_api' );
}

/**
 * 1.3.0
 */
function yit_update_1_3_0() {

	/* ====== Update CPTU ====== */

	global $wpdb;

	$temp = array();
	$prefixes = array( 'sliders' => 'sl_', 'portfolios' => 'po_', 'feature-tabs' => 'ft_', 'teams' => 'team_' );

	foreach ( $prefixes as $post_type => $prefix ) {
		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => -1,
			'post_status' => 'publish'
		);
		$post_types = get_posts( $args );

        foreach ( $post_types as $the ) {

            $from = substr( $prefix . $the->post_name, 0, 20 );
            $to   = yit_avoid_duplicate( str_replace( '-', '_', substr( $prefix . $the->post_name, 0, 16) ), $temp );

            $temp[]     = $to;
            $to_parent  = substr( $to, 3 );

            /* Update Child Post Type*/
            $wpdb->update( $wpdb->posts, array( 'post_type' => $to ), array( 'post_type' => $from ) );

            /* Update Parent Post Name */
            $wpdb->update( $wpdb->posts, array( 'post_name' => $to_parent ), array( 'post_name' =>  $the->post_name ) );

            /* Update Slider Name in Post Meta */
            if( 'sliders' == $post_type ) {

                $where = array(
                    'meta_key'      => '_slider_name',
                    'meta_value'    => $the->post_name
                );

                $wpdb->update( $wpdb->postmeta, array( 'meta_value' => $to_parent ), $where );
            }
		}
	}

    set_transient( 'cptu_1_3_0_update', true );
}

function yit_update_1_3_0_after_import(){
    delete_transient( 'cptu_1_3_0_update' );
}

if(  ! get_transient( 'cptu_1_3_0_update' )  ){
    add_action( 'yit_theme_updated_to_1_3_0', 'yit_update_1_3_0' );
}

add_action( 'yit_backup_reset_after_import', 'yit_update_1_3_0_after_import' );

