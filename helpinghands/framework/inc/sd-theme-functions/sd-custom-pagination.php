<?php
/**
 * Theme Custom Pagination
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if ( !function_exists( 'sd_custom_pagination' ) ) {
	function sd_custom_pagination( $pages = '', $range = 3 ) {
		$showitems = ( $range * 2 ) + 1;
		
		global $paged;

		if ( empty( $paged ) ) $paged = 1;
		
		if ( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( !$pages ) {
				$pages = 1;
			}
		}
		
		if ( 1 != $pages ) {
			echo "<div class=\"sd-pagination clearfix\">";
			if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo "<a class=\"sd-first-page\" href='" . get_pagenum_link( 1 ) . "'>&laquo; " . __( 'First', 'sd-framework' ) . "</a>";
			if ( $paged > 1 && $showitems < $pages ) echo "<a class=\"sd-previous-page\" href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo;</a>";
			
			for ( $i = 1; $i <= $pages; $i++ ) {
				if ( 1 != $pages &&( !( $i >= $paged + $range + 1 || $i <= $paged-$range - 1) || $pages <= $showitems ) ) {
					echo ( $paged == $i ) ? "<span class=\"sd-current-page\">" . $i . "</span>" : "<a href='" . get_pagenum_link( $i ) . "' class=\"sd-inactive\">" . $i . "</a>";
				}
			}
		
			if ( $paged < $pages && $showitems < $pages ) echo "<a class=\"sd-next-page\" href=\"" . get_pagenum_link( $paged + 1 ) . "\"> &rsaquo;</a>";
			if ( $paged < $pages - 1 &&  $paged + $range - 1 < $pages && $showitems < $pages ) echo "<a class=\"sd-last-page\" href='" . get_pagenum_link( $pages ) . "'>" . __( 'Last', 'sd-framework' ) . " &raquo;</a>";
			echo "</div>";
		}
			
	}
}