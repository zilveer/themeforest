<?php if(! defined('ABSPATH')){ return; }
/**
 * This file contains helper functions for Geo Directory plugin by https://wpgeodirectory.com
 */

add_action( 'geodir_wrapper_open', 'zn_geod_before_main_content', 90 );
add_action( 'geodir_wrapper_close', 'zn_geod_after_main_content', 90 );
function zn_geod_before_main_content()
{
	$args = array();
	if( ! is_single() ){

		// SHOW THE HEADER
		if( empty( $args['title'] ) ){
			//** Put the header with title and breadcrumb
			$args['title'] = __( 'Locations', 'zn_framework' );
		}

		if( is_tax() ) {
			$args['title'] = get_the_archive_title();
			$args['subtitle'] = ''; // Reset the subtitle for categories and tags
		}
	}

	WpkPageHelper::zn_get_subheader( $args );

	?>
	<section id="content" class="site-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
	<?php
}

function zn_geod_after_main_content(){
	?>
				</div>
			</div>
		</div>
	</section>
	<?php
}
