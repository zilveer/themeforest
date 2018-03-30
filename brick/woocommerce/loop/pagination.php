<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;
global $qode_options;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

$prev_text = '<i class="fa fa-angle-left"></i>';
if (isset($qode_options['pagination_arrows_type']) && $qode_options['pagination_arrows_type'] != '') {
	$icon_navigation_class = $qode_options['pagination_arrows_type'];
	$direction_nav_classes = qode_horizontal_slider_icon_classes($icon_navigation_class);
	$prev_text = '<span class="pagination_arrow ' . $direction_nav_classes['left_icon_class']. '"></span>';
}

$next_text = '<i class="fa fa-angle-right"></i>';
if (isset($qode_options['pagination_arrows_type']) && $qode_options['pagination_arrows_type'] != '') {
	$icon_navigation_class = $qode_options['pagination_arrows_type'];
	$direction_nav_classes = qode_horizontal_slider_icon_classes($icon_navigation_class);
	$next_text = '<span class="pagination_arrow ' . $direction_nav_classes['right_icon_class']. '"></span>';
}

$pagination_classes = '';
if( isset($qode_options['pagination_type']) && $qode_options['pagination_type'] == 'standard' ) {
	if( isset($qode_options['pagination_standard_position']) && $qode_options['pagination_standard_position'] !== '' ) {
		$pagination_classes .= "standard_".esc_attr($qode_options['pagination_standard_position']);
	}
}
elseif ( isset($qode_options['pagination_type']) && $qode_options['pagination_type'] == 'arrows_on_sides' ) {
	$pagination_classes .= "arrows_on_sides";
}
?>

<nav class="woocommerce-pagination  <?php echo esc_attr($pagination_classes);?>">
	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => '',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_text'    => $prev_text,
			'next_text'    => $next_text,
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );
	?>
</nav>