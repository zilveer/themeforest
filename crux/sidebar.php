<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package StagFramework
 */

$layout = stag_sidebar_layout();

if ( empty($layout) || $layout == 'no-sidebar' )
	return;

$custom_sidebar = 'sidebar-1';

if ( is_singular() ) {
	$custom_sidebar = get_post_meta( get_the_ID(), '_stag_page_sidebar', true );
}

global $wp_query;
if ( $wp_query->is_posts_page ) {
	$custom_sidebar = get_post_meta( get_option('page_for_posts'), '_stag_page_sidebar', true );
}

if ( is_post_type_archive( 'product' ) ) {
	$custom_sidebar = stag_get_option('shop_page_sidebar');
}

if ( function_exists('is_product_category') && is_product_category() ) {
	$custom_sidebar = stag_get_option('shop_page_sidebar');
}


if ( empty($custom_sidebar) ) {
	$sidebar = 'sidebar-1';
} else {
	$sidebar = $custom_sidebar;
}

?>
	<div id="secondary" class="widget-area"<?php stag_markup_helper( array( 'context' => 'sidebar' ) ); ?>>
		<?php if ( is_active_sidebar( $sidebar ) ) : ?>

			<div id="tertiary" class="sidebar-container">
				<?php dynamic_sidebar( $sidebar ); ?>
			</div><!-- #tertiary -->

		<?php endif; ?>
	</div><!-- #secondary -->
