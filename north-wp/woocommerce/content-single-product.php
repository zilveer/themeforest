<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 //do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<?php
	$shop_product_style = ot_get_option('shop_product_style', 'style1');
	
	/* Product Page - Move Rating */
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11 );
	
	/* Product Page - Remove Sale Flash */
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' , 10);
	
	/* Product Page - Remove Related Products */
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );
	
	/* Product Page - Remove Sidebar */
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	
	/* Product Page - Move Upsells */
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 70 );
	
	/* Product Page - Wishlist */
	add_action( 'woocommerce_single_product_summary', 'thb_wishlist_button', 4 );
	
	if ( $shop_product_style === 'style1') {
		$class = 'custom_scroll';
		if ( wp_is_mobile() ) {
			$class .= ' thb-mobile';	
		}
		/* Product Page - Move breadcrumbs */
		add_action( 'woocommerce_before_single_product', 'woocommerce_breadcrumb', 4 );
		
		/* Product Page - Remove Excerpt on Style1 */
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		 
		/* Product Page - Remove breadcrumbs */
		remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
		
		/* Product Page - Move Tabs */
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs' , 10);
		add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 31 );

		
		/* Product Page - Move Sharing to top */
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 35 );
		
		/* Product Page - Add Sizing Guide */
		add_action( 'woocommerce_after_add_to_cart_button', 'thb_sizing_guide', 30 );
		
		/* Product Page - Add Content Below */
		add_action( 'woocommerce_after_single_product', 'the_content', 10 );
		
	} else {
		$class = '';
		/* Product Page - Move tabs */
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		add_action( 'woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10 );
		
		/* Product Page - Move breadcrumbs */
		add_action( 'woocommerce_before_single_product_summary', 'woocommerce_breadcrumb', 4 );
	}
	 
?>
<?php if ( $shop_product_style === 'style2') { ?>
<div class="page-padding no-bottom-padding">
<?php } ?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('post product-page '.$shop_product_style); ?>>
	<?php if ( $shop_product_style === 'style2') { ?>
		<div class="row max_width align-center">
			<div class="small-12 large-10 xlarge-9 columns style2-container">
	<?php } ?>
    <?php
        /**
         * woocommerce_show_product_images hook
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         * 
         */
        do_action( 'woocommerce_before_single_product_summary' );
    ?>
	  <div class="product-information">
	  	<div class="<?php echo esc_attr($class); ?>" id="product-information">
		  	<div>
			  	<?php
			  		/**
			  		 * woocommerce_before_single_product hook
			  		 *
			  		 * @hooked wc_print_notices - 10
			  		 */
			  		 do_action( 'woocommerce_before_single_product' );
			  	?>
			    <?php
		    			/**
		    			 * woocommerce_single_product_summary hook
		    			 *
		    			 * @hooked woocommerce_template_single_title - 5
		    			 * @hooked woocommerce_template_single_rating - 10
		    			 * @hooked woocommerce_template_single_price - 10
		    			 * @hooked woocommerce_template_single_excerpt - 20
		    			 * @hooked woocommerce_template_single_add_to_cart - 30
		    			 * @hooked woocommerce_template_single_meta - 40
		    			 * @hooked woocommerce_template_single_sharing - 50
		    			 */
		    			do_action( 'woocommerce_single_product_summary' );
		    		?>
			    <?php
			        /**
			         * woocommerce_after_single_product_summary hook
			         *
			         * @hooked woocommerce_output_related_products - 20
			         */
			        do_action( 'woocommerce_after_single_product_summary' );
			    ?>
		    </div>
	    </div>
	  </div>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
	<?php if ( $shop_product_style === 'style2') { ?>
			</div>
		</div>
	<?php } ?>
</div><!-- #product-<?php the_ID(); ?> -->
<?php if ( $shop_product_style === 'style2') { ?>
</div>
<?php } ?>
<?php do_action( 'woocommerce_after_single_product' ); ?>   