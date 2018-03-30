<?php
/**
 * Shortcode attributes
 * @var $date
 * @var $per_page
 * @var $orderby
 * @var $order
 * @var $el_class
 */

wp_enqueue_script('owl-carousel');
 
$output = $slider_html = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
if( empty( $cats ) ) {
	return;
}

$ordering_args = WC()->query->get_catalog_ordering_args( esc_attr($orderby), esc_attr($order) );
$meta_query    = WC()->query->get_meta_query();

$args = array(
	'post_type'				=> 'product',
	'post_status' 			=> 'publish',
	'ignore_sticky_posts'	=> 1,
	'orderby' 				=> esc_attr($orderby),
	'order' 				=> esc_attr($order),
	'posts_per_page' 		=> $per_page,
	'meta_query' 			=> $meta_query,
	'tax_query' 			=> array(
		array(
			'taxonomy' 		=> 'product_cat',
			'terms' 		=> esc_attr( $cats ),
			'field' 		=> 'slug',
			'operator' 		=> 'IN'
		)
	)
);

$products = new WP_Query( $args );
if ( ( $products ) && $products->have_posts() ) {
	while ( $products->have_posts() ) {
		$products->the_post();
		global $product;
		ob_start();
		global $wpdb;
	?>
			<div class="item">
				<div class="overlay_content overlay-menu">
					<div class="overlay_item">
						<?php echo woocommerce_get_product_thumbnail(); ?>
						<div class="overlay">
							<div class="icons">
								<a class="product-title" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>">
									<h3><?php echo esc_attr($product->get_title()); ?></h3>
								</a>
								<span class="price"><?php echo $product->get_price_html(); ?></span>
								<?php echo $product->get_rating_html(); ?>
								<?php echo  woocommerce_template_loop_add_to_cart(); ?>
								<a class="btn btn-gold button" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><i class="fa fa-link"></i></a>
								<a class="close-overlay hidden">x</a>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php
		$slider_html .= ob_get_clean();
	}
}
wp_reset_postdata();	

if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
$id = 'woo-owl-carousel-'. rand(1,9999);
$output  = '<div  class="menu_grid overlay-34 our-menu text-center woocommerce'.esc_attr($el_class).'"><div class="menu-type"><div id="'. esc_attr($id) .'" class="owl-carousel owl-theme woo-owl-carousel">';
$output	.= $slider_html;
$output .= '</div></div></div>';
echo $output;