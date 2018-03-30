<?php
/**
 * Shortcode attributes
 * @var $cats
 * @var $per_page
 * @var $orderby
 * @var $order
 * @var $display
 * @var $txt_show_all
 * @var $el_class
 */
 
global $majesty_options;
wp_enqueue_script('isotope');
 
$output = $filter_html = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
if( empty( $cats ) ) {
	return;
}

if( empty ( $display ) ) {
	$display = 'grid';
}
$cats = explode( ",", $cats );
$categories_link  = array();
$categories_name  = array();
$filter_html 	 .= '<div class="menu-bar dark text-center"><ul class="menu-fillter clearfix">';
if( ! empty( $txt_show_all ) ) {
	$filter_html .= '<li><a rel="nofollow" href="#" data-filter="*">'.esc_attr( $txt_show_all ) .'</a></li>';
}
$i = 1;
foreach( $cats as $cat ) {
	$category = get_term_by('slug', $cat, 'product_cat', 'ARRAY_A');
	$filter_html .= '<li><a rel="nofollow" href="#" data-filter=".product_cat-'. esc_attr( $cat ) .'">'. esc_attr( $category['name'] ) .'</a></li>';
}
$filter_html .= '</ul></div>';
$cats = implode( ",", $cats );
$majesty_options['shortcode_products_query'] = esc_attr( $display );
$majesty_options['vc_woo_filter'] = 'true';
$atts_shortcode = '[product_category category="'. $cats .'" per_page="'. absint( $per_page ) .'" orderby="'. esc_attr( $orderby ) .'" order="'. esc_attr($order) .'" columns="'. esc_attr( $display ) .'"]';
$products_filter_container = do_shortcode($atts_shortcode);
$majesty_options['shortcode_products_query'] = '';
$majesty_options['vc_woo_filter'] = '';

$css = 'menu_grid our-menu padding-b-70';
if( $display == 'grid4col' ) {
	$css .= ' menu-grid-4-col';
}
if( $display == 'grid' || $display == 'grid4col' ) {
	$css_menu_item = 'menu-items masonry-content menu-type dark clearfix';
} elseif( $display == 'list' ) {
	$css_menu_item = 'text-left woocommerce-menu-list';
} elseif( $display == 'list2' ) {
	$css_menu_item = 'text-left woocommerce-menu-list woocommerce-menu-list2';
} elseif( $display == 'gridfullwidth' ) {
	$css_menu_item = 'masonry-content menu-type dark clearfix';
} elseif( $display == 'masonry' ) {
	$css_menu_item = 'masonry-content dark clearfix';
	$css = 'text-center masonry_menu masonry_columm';
} elseif( $display == 'masonryfullwidth' ) {
	$css_menu_item = 'masonry-content dark clearfix';
	$css = 'text-center masonry_menu masonry_columm_full';
}
$css_container = 'container mt60';
if( $display == 'gridfullwidth' || $display == 'masonryfullwidth' ) {
	$css_container = 'container-fluid mt60';
}
if( $display == 'list' || $display == 'list2' ) {
	$css_container = 'container mt100';
}

$el_class = $css .' '. trim($el_class);
$id = 'theme-menu-filter-'. rand(1,9999);
$output  = '<div id="'. esc_attr($id) .'" class="woocommerce theme-menu-filters '.esc_attr($el_class).'">';
$output	.= $filter_html;
$output .= '<div class="'. esc_attr( $css_container ) .'"><div class="'. esc_attr( $css_menu_item ) .'">';
$output .= $products_filter_container;
$output .= '</div></div>';
$output .= '</div>';
echo $output;