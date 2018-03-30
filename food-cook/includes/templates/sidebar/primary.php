<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Sidebar Template
 *
 * If a `primary` widget area is active and has widgets, display the sidebar.
 *
 * @package WooFramework
 * @subpackage Template
 */
	global $woo_options;
	
	
	if ( isset( $woo_options['woo_layout'] ) && ( $woo_options['woo_layout'] != 'one-col' ) ) {

		
		if( class_exists('sidebar_generator') && is_page() ){
	
			woo_sidebar_before();
		?>

				<div id="sidebar">
					<?php
						woo_sidebar_inside_before();

		                generated_dynamic_sidebar();
						
						woo_sidebar_inside_after();
					?>
				</div><!-- /#sidebar -->

			<?php

			woo_sidebar_after();
		} else {// End IF Statement 
			
			if ( woo_active_sidebar( 'primary' ) ) {

				woo_sidebar_before();	
		?>

				<div id="sidebar">

					<?php 
						woo_sidebar_inside_before();

						woo_sidebar('primary');

						woo_sidebar_inside_after(); 

					?>

				</div><!-- /#sidebar -->

				<?php woo_sidebar_after();
			}

		}
	} // End IF Statement
?>