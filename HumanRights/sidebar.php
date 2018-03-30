<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package WPCharming
 */
?>
<div id="secondary" class="widget-area sidebar" role="complementary">
	<?php
		global $post;
		global $woocommerce;
		$post_type = get_post_type($post);

		if ( is_page() || is_front_page() ) {

			if ( is_active_sidebar( 'sidebar-2' ) ) {
				dynamic_sidebar('sidebar-2');
			} else {
				dynamic_sidebar('sidebar-1');
			}
			
		} elseif ( ( is_single() || is_archive() ) && ( $post_type == 'post' )  ) {
			dynamic_sidebar('sidebar-1');
		} elseif ( is_search() ) {
			dynamic_sidebar('sidebar-1');
		} elseif ( $woocommerce && is_shop() || $woocommerce && is_product() || $woocommerce && is_product_category() || $woocommerce && is_product_tag() ) {
			dynamic_sidebar('sidebar-woo');
		} else {
			dynamic_sidebar('sidebar-1');
		}
	?>
</div><!-- #secondary -->
