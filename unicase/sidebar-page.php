<?php
/**
 * The sidebar containing the page sidebar widget area
 *
 * @package Unicase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<aside class="sidebar sidebar-page">
	<?php
	if ( ! is_active_sidebar( 'page-sidebar-1' ) ) {
		if ( function_exists( 'unicase_default_homepage_widgets' ) ) {
			unicase_default_homepage_widgets();
		}
	} else {
		dynamic_sidebar( 'page-sidebar-1' );
	}
	?>
</aside><!-- /.sidebar -->