<?php 
// Product Filters Widget Area
if ( is_active_sidebar( 'product-filters-widget-area' ) ) {
	ob_start();
	dynamic_sidebar( 'product-filters-widget-area' );
	$product_filters_widgets = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $product_filters_widgets ) ){
		echo '<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12"><div class="product-filters">';
		echo '<h3>' . __( 'Product Filters' , 'mediacenter' ) . '</h3>';
		echo '<div class="widgets">';
		echo $product_filters_widgets;
		echo '</div>';
		echo '</div></div>';
	}
}

// Catalog Widget Area
if ( is_active_sidebar( 'catalog-widget-area' ) ) {
	
	dynamic_sidebar( 'catalog-widget-area' );

} else {

	$catalog_widget_args = array(
		'before_widget' => '<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12"><aside class="widget clearfix">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		'widget_id'     => '',
	);

	$catalog_widget_args['widget_id'] = 'product-categories';
	the_widget( 'WC_Widget_Product_Categories', array( 'title' => __('Categories', 'mediacenter' ), 'orderby' => 'name', 'hierarchical' => 1 ), $catalog_widget_args );

	$catalog_widget_args['widget_id'] = 'special-offers';
	the_widget( 'WC_Widget_Products', array( 'title' => __( 'Special Offers', 'mediacenter' ), 'show' => 'onsale', 'number' => '5', 'orderby' => 'DESC', 'order' => 'date', 'id' => 'onsale-products' ), $catalog_widget_args );

	the_widget( 'WP_Widget_Text', array( 'text' => '<img src="' . get_template_directory_uri() . '/assets/images/banners/banner-simple.jpg" width="250" height="114" alt="Ad Widget" class="img-responsive" />' ), $catalog_widget_args );
	
	$catalog_widget_args['widget_id'] = 'featured-products';
	the_widget( 'WC_Widget_Products', array( 'title' => __( 'Featured Products', 'mediacenter' ), 'show' => 'featured', 'number' => '5', 'orderby' => 'DESC', 'order' => 'date', 'id' => 'featured-products' ), $catalog_widget_args );
}