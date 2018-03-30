<?php
/**
 * Theme Sidebar
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

wp_reset_query();
?>
<!--right-col-->

	<div class="sd-right-col">
		<?php if( function_exists( 'smk_sidebar' ) ) {
			
			if ( !is_category() && !is_tag() && !is_search() && !is_404() && !is_day() && !is_year() && !is_archive() && !is_tax() && !is_date() && !is_author() ) {
				
				$smk_sidebar = rwmb_meta( 'sd_smk_sidebar' );
				
				if ( !empty( $smk_sidebar ) ) {
					smk_sidebar( $smk_sidebar );
				} else {
					if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'main-sidebar' ) );
				}
				
			} else {
				
				if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'main-sidebar' ) );
			}
			
		} else {
			if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('main-sidebar') );	
		}
		?>
	</div>
<!-- sd-right-col --> 