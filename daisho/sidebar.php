<?php
/**
 * The sidebar containing 'sidebar-1' widget area, displays on selected posts and pages.
 * 
 * If you need a sidebar in archive.php or search.php you can't enable that in admin panel
 * because these templates don't have placeholder pages. You'll need to add one of the
 * following body classes in /core/body-class.php in your Child Theme:
 * 1. no-sidebar - does nothing,
 * 2. sidebar-left - inserts the sidebar to the left,
 * 3. sidebar-right - inserts the sidebar to the right,
 * 4. no-boundaries - regardless of sidebar settings, makes this page 100% wide.
 *
 * You will also need to add is_search() and/or is_archive() below because the
 * sidebar is not outputted at all on these templates.
 */
global $wp_query;
$page_layout = get_post_meta( $wp_query->queried_object_id, 'flow_post_layout', true );

if ( $page_layout == 'sidebar-right' || $page_layout == 'sidebar-left' || ( function_exists( 'is_woocommerce' ) && is_woocommerce() && ( is_shop() || is_product_category() || is_product_tag() ) ) ) { ?>
	<div id="sidebar" class="site-sidebar" role="complementary">
		<div class="sidebar-shadow"></div>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
<?php } ?>