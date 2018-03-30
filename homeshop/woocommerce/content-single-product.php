<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
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
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
	 
	global $post;  
	$sidebar_position = get_post_meta($post->ID,'mm_sidebar_position_meta_box',true); 

?>



<!-- Product -->
<div class="product-single">
	<div class="row">					

		<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
		<!-- Product Images Carousel -->
		
		
		<?php 
		if( $sidebar_position == 'full' ) { ?>
		<div class="col-lg-4 col-md-4 col-sm-4 product-single-image">
		<?php } else { ?>
		<div class="col-lg-5 col-md-5 col-sm-5 product-single-image">
		<?php } ?>
		
			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				
			?>
		</div>
		<!-- /Product Images Carousel -->
		


		
	<?php if( $sidebar_position == 'full' ) { ?>		
	<div class="col-lg-8 col-md-8 col-sm-8 product-single-info full-size">
	<?php } else { ?>
	<div class="col-lg-7 col-md-7 col-sm-7 product-single-info ">
	<?php } ?>
	
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
			 
			 
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
			 
			 
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 20);
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 30);
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40);
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50); 
			 
			 
			do_action( 'woocommerce_single_product_summary' );
			
			
			// woocommerce_template_single_title();
			// woocommerce_template_single_rating();
			// woocommerce_template_single_meta();
			// woocommerce_template_single_price();
			// woocommerce_template_single_add_to_cart();
			// woocommerce_template_single_sharing();
			?>
			
			
			
			<div class="product-actions ">
				<?php
				if( class_exists( 'YITH_WCWL_Shortcode' ) ) {
				echo do_shortcode('[yith_wcwl_add_to_wishlist]');
				}
				?>
				
				<?php if ( function_exists('woo_add_compare_button' ) && woo_add_compare_button() != '' ) { ?>
				<span class="add-to-compare">
					<span class="action-wrapper">
						<i class="icons icon-docs"></i>
						<span class="action-name"><?php if ( function_exists('woo_add_compare_button' ) ) echo woo_add_compare_button(); ?></span>
					</span>
				</span>
				<?php } ?>	
				
				
				
				<?php if(get_option('sense_product_reviews')  && get_option('sense_product_reviews') != 'hide' ) { ?>	
				<span class="green product-action">
					<span class="action-wrapper">
						<a href="#products_tabs"><i class="icons icon-info"></i></a>
						<span class="action-name"><a href="#products_tabs"><?php _e( 'Add Review', 'homeshop' ); ?></a></span>
					</span>
				</span>
				<?php } ?>	
				
				
				
				
			</div>
			
										
	</div><!-- .summary -->

	
	<meta itemprop="url" content="<?php the_permalink(); ?>" />

		</div>
	</div>
</div>

	<?php
		
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );

	?>
	

<?php do_action( 'woocommerce_after_single_product' ); ?>
