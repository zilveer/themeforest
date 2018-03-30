<?php
/*
    Extension Name: Breadcrumbs
    Version: 1.0
    Description: Generate breadcrumb trails from areas of your site.
*/

require('breadcrumb_navxt_admin.php');



// [breadcrumbs] shortcode
//................................................................
if ( ! function_exists( 'breadcrumbs_shortcode' ) ) :
	function breadcrumbs_shortcode($args = null, $content = null) {

		if(function_exists('breadcrumbs_display')) {
			return breadcrumbs_display( true ); // true = return, false = echo;
		}
	}
	
	add_shortcode('breadcrumbs', 'breadcrumbs_shortcode');
endif;

