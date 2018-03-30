<?php
/**
 * Woo VC Shortcode
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

// recent products

if ( !function_exists('sd_woo_products' ) ) {
	function sd_woo_products( $atts, $content = NULL ){
		$sd = shortcode_atts( array(
			'products' => 'recent_products',
			'per_page' => '6',
			'orderby'  => '',
			'order'    => '',
			'category' => '',
		), $atts );
		
		$products = $sd['products'];		
		$per_page = $sd['per_page'];
		$orderby  = $sd['orderby'];
		$order    = $sd['order'];
		$category = $sd['category'];
		
		$cats = ( !empty( $category ) ? 'category="' . $category . '"' : ' ' );
			
		$carousel_id = mt_rand( 10, 1000);
		
		ob_start();
			
	?>
	
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('.sd-products-carousel .sd-separate-rows').remove();
					jQuery('.sd-products-carousel-<?php echo esc_attr( $carousel_id ); ?> .sd-shortcode-products').slick({
						dots: true,
						arrows: false,
						infinite: false,
						autoplay: false,
						speed: 300,
						slidesToShow: 4,
						slidesPerRow: 4,
						slidesToScroll: 1,
						responsive: [
						{
						  breakpoint: 1024,
						  settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: false,
							dots: true
						  }
						},
						{
						  breakpoint: 992,
						  settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							infinite: false,
							dots: true
						  }
						},
						{
						  breakpoint: 600,
						  settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						  }
						},
						{
						  breakpoint: 480,
						  settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						  }
						}
						]
					});
				});
			</script>
				
			<div class="sd-products-carousel sd-products-carousel-<?php echo esc_attr( $carousel_id ); ?>">
				<?php echo do_shortcode( '['. $products .' per_page="' . $per_page . '" orderby="' . $orderby . '" order="' . $order . '" ' . $cats . ' columns="4" ]' ); ?>
			</div>
		
	<?php					
			
			return ob_get_clean();
	}
	add_shortcode( 'sd_woo_products','sd_woo_products' );
}

// register shortcode to VC

add_action( 'vc_before_init', 'sd_woo_products_vcmap' );

if ( ! function_exists( 'sd_woo_products_vcmap' ) ) {
	function sd_woo_products_vcmap() {
		vc_map( array(
			'name'					=> __( 'Products', 'sd-framework' ),
			'description'			=> __( 'Products display', 'sd-framework' ),
			'base'					=> "sd_woo_products",
			'class'					=> "sd-woo-products",
			'icon' 					=> "icon-wpb-sd-woo",
			'category'				=> 'WooCommerce',
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'				=> array(
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> __( 'Products', 'sd-framework' ),
					'param_name'	=> 'products',
					'value' => array( 'Recent Products' => 'recent_products', 'Featured Products' => 'featured_products', 'Sale Products' => 'sale_products', 'Best Selling' => 'best_selling_products', 'Top Rated' => 'top_rated_products', 'Product Category' => 'product_category' ),
					'description'	=> __( 'Select the products type', 'sd-famework' )
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> __( 'Categories Slugs', 'sd-framework' ),
					'param_name'	=> 'category',
					'description'	=> __( 'Insert the slugs of your categories separated by comma.', 'sd-framework' ),
					'dependency'	=> array(
						'element'	=> "products",
						'value'		=> array( 'product_category' ),
						),
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> __( 'Number of Products to Show', 'sd-framework' ),
					'param_name'	=> 'per_page',
					'value'			=> '6',
					'description'	=> __( 'Insert the number of products to display in the carousel', 'sd-framework' ),
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> __( 'Order By', 'sd-framework' ),
					'param_name'	=> 'orderby',
					'value' 		=> array( 'none', 'ID', 'title', 'name', 'date', 'random' => 'rand' ),
					'description'	=> __( 'Select the "oderby" parameter', 'sd-famework' ),
					'dependency'	=> array(
						'element'	=> "products",
						'value'		=> array( 'recent_products', 'featured_products', 'sale_products', 'top_rated_products', 'product_category' ),
						),
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> __( 'Order', 'sd-framework' ),
					'param_name'	=> 'order',
					'value' => array( 'descending' => 'DESC', 'ascending' => 'ASC' ),
					'description'	=> __( 'Select the "order" parameter', 'sd-framework' ),
					'dependency'	=> array(
						'element'	=> "products",
						'value'		=> array( 'recent_products', 'featured_products', 'sale_products', 'top_rated_products', 'product_category' ),
						),
					),
				)
			));
	}
}