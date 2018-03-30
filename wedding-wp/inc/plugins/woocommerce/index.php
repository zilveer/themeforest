<?php
/*	
*	---------------------------------------------------------------------
*	Woocommerce functions
*	--------------------------------------------------------------------- 
*/


if ( class_exists( 'Woocommerce' ) ) {

	// Add Support
	
	
	add_action( 'wp_enqueue_scripts', 'webnus_script_loader2' );

	function webnus_script_loader2() {
	wp_enqueue_style(
				'woocommerce-css', get_template_directory_uri() . '/inc/plugins/woocommerce/woocommerce.css', null, null
		);
	}
	
	
	add_theme_support( 'woocommerce' );
	
	// Disable WooCommerce styles 
	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	} else {
		define( 'WOOCOMMERCE_USE_CSS', false );
	}
	
	// Define Wrapper
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

	function my_theme_wrapper_start() {
		 GLOBAL $webnus_options;	
		 echo '<section id="content_left" class="woo-template '.($webnus_options->webnus_woo_sidebar_enable()?'col-md-8':'col-md-12').' ">';}
	
	function my_theme_wrapper_end() {
	  echo '</section>';
	}

	// Remove Breadcrumbs
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

	// Products per row
	add_filter('loop_shop_columns', 'loop_columns');
	
	if (!function_exists('loop_columns')) {
		function loop_columns() {
			return 3; //ot_get_option('woo_columns', '3');
		}
	}
	
	// Redefine woocommerce_output_related_products()
	function woocommerce_output_related_products() {
		woocommerce_related_products(array('posts_per_page'=>3,'columns'=>3)); // Display 3 products in rows of 3
	}
	
	// Products per page
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '. 9 /*ot_get_option('woo_product_count', '9')*/ .';' ), 20 );
	

	// Add image wrap
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_product_thumbnail_wrap_open', 9, 2);
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_product_thumbnail_wrap_close', 14, 2);

	if (!function_exists('woocommerce_product_thumbnail_wrap_open')) {
		function woocommerce_product_thumbnail_wrap_open() {
			echo '<div class="img-wrap">';
		}
	}

	if (!function_exists('woocommerce_product_thumbnail_wrap_close')) {
		function woocommerce_product_thumbnail_wrap_close() {
			echo '</div>';
		}
	}

	// Add secondary image
	if ( ! class_exists( 'WC_webnus' ) ) {

		class WC_webnus {

			public function __construct() {
				add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_second_product_thumbnail' ), 11 );
				add_filter( 'post_class', array( $this, 'product_has_gallery' ) );
			}


	        /*-----------------------------------------------------------------------------------*/
			/* Class Functions */
			/*-----------------------------------------------------------------------------------*/

			// Add webnus-has-gallery class to products that have a gallery
			function product_has_gallery( $classes ) {
				global $product;

				$post_type = get_post_type( get_the_ID() );

				if ( ! is_admin() ) {

					if ( $post_type == 'product' ) {

						$attachment_ids = $product->get_gallery_attachment_ids();

						if ( $attachment_ids ) {
							$classes[] = 'webnus-has-gallery';
						}
					}

				}

				return $classes;
			}


			/*-----------------------------------------------------------------------------------*/
			/* Frontend Functions */
			/*-----------------------------------------------------------------------------------*/

			// Display the second thumbnails
			function woocommerce_template_loop_second_product_thumbnail() {
				global $product, $woocommerce;

				$attachment_ids = $product->get_gallery_attachment_ids();

				if ( $attachment_ids ) {
					$secondary_image_id = $attachment_ids['0'];
					echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
				}
			}

		}


		$WC_webnus = new WC_webnus();
	}
	


	// Add the inner div in product loop
	add_action( 'woocommerce_before_shop_loop_item_title', 'artificer_product_inner_open', 14, 2);
	add_action( 'woocommerce_after_shop_loop_item_title', 'artificer_product_inner_close', 12, 2);

	function artificer_product_inner_open() {
		echo '<div class="product-inner">';
	}
	function artificer_product_inner_close() {
		echo '</div>';
	}
	
	// Change rating position
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 11 );
	
	// Change linked product count in a row
	function woocommerce_upsell_display( $posts_per_page = 3, $columns = 3, $orderby = 'rand' ) {
	woocommerce_get_template( 'single-product/up-sells.php', array(
	'posts_per_page' => $posts_per_page,
	'orderby' => $orderby,
	'columns' => $columns
	) );
	}
	
	

	// Show sidebar in selected pages
if ( ! function_exists( 'woocommerce_get_sidebar' ) ) {
		function woocommerce_get_sidebar() {
			GLOBAL $webnus_options;		
			if( $webnus_options->webnus_woo_sidebar_enable() )
			get_sidebar('shop');
			echo '<div class="clear"></div>';
		}
	}
	
} ?>