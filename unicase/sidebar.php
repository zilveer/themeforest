<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Unicase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="sidebar-blog">
	<?php
	if ( ! is_active_sidebar( 'blog-sidebar-1' ) ) {
		if ( function_exists( 'unicase_default_blog_widgets' ) ) {
			unicase_default_blog_widgets();
		}
	} else {
		dynamic_sidebar( 'blog-sidebar-1' );
	}
	?>
</div><!-- /.sidebar-blog -->