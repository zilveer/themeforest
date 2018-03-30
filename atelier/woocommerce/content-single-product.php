<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	global $post, $product, $sf_catalog_mode, $sidebar_config, $sf_options;

	$product_layout = sf_get_post_meta($post->ID, 'sf_product_layout', true);
	$fw_split_bg_color = sf_get_post_meta($post->ID, 'sf_fw_split_bg_color', true);

	$pb_active = sf_get_post_meta($post->ID, '_spb_js_status', true);
	if ($pb_active != "true") {
	$pb_active = false;
	}
	
	$product_reviews_pos = "default";
	if ( isset( $sf_options['product_reviews_pos'] ) ) {
	$product_reviews_pos = $sf_options['product_reviews_pos'];
	}
	
	$extra_class = "";
	
	if ( class_exists( 'Woocommerce_German_Market' ) ) {
		$extra_class .= "german-market-enabled ";
	}
	
	// Product page builder content
	if ( $pb_active ) {
		
		$product_pbcontent_pos = "above";		
		if ( isset( $sf_options['product_pbcontent_pos'] ) ) {
			$product_pbcontent_pos = $sf_options['product_pbcontent_pos'];
		}
				
		if ( $product_pbcontent_pos == "above" ) {
			add_action( 'sf_product_before_tabs', 'sf_woo_product_page_builder_content', 10);
		} else {
			add_action( 'sf_product_after_tabs', 'sf_woo_product_page_builder_content', 10);
		}
	}
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class($extra_class); ?>>

	<div class="entry-title" itemprop="name"><?php the_title(); ?></div>

	<?php if ($sidebar_config == "no-sidebars" && $product_layout != "fw-split") { ?>
	<div class="container product-main">
	<?php } else if ( $product_layout == "fw-split") { ?>
	<div class="product-main clearfix" style="background-color: <?php echo $fw_split_bg_color; ?>;">
	<?php } ?>

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
	?>

	<?php
			/**
			 * woocommerce_show_product_images hook
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>

		<div class="summary entry-summary">

			<div class="summary-top clearfix">

				<?php
					// WooCommerce Breadcrumb
					$breadcrumb_args = array('wrap_before' => '<nav class="woocommerce-breadcrumb">');
					woocommerce_breadcrumb($breadcrumb_args);
				?>
				
				<?php 
					// WooCommerce Title
					woocommerce_template_single_title();
				?>
				
				<?php
					// Navigation
					$has_cat = get_the_terms( $post->ID, 'product_cat' );
					if ($has_cat != 0) { ?>
						<div class="product-navigation">
							<div class="nav-previous"><?php previous_post_link( '%link', '<i class="fa-chevron-right"></i>', true, '', 'product_cat' ); ?></div>
							<div class="nav-next"><?php next_post_link( '%link', '<i class="fa-chevron-left"></i>', true, '', 'product_cat' ); ?></div>
						</div>
				<?php } ?>

			</div>

			<?php
				/**
				* woocommerce_single_product_summary hook
				*
				* @hooked sf_product_price_rating - 10
				* @hooked sf_product_short - 20
				* @hooked woocommerce_template_single_add_to_cart - 30
				* @hooked woocommerce_template_single_meta - 40
				* @hooked sf_product_share - 45
				* @hooked woocommerce_template_single_sharing - 50
				*/

				do_action( 'woocommerce_single_product_summary' );
			?>


		</div><!-- .summary -->

	<?php if (($sidebar_config == "no-sidebars" && $product_layout != "fw-split") || ($product_layout == "fw-split")) { ?>
	</div>
	<?php } ?>

	<?php do_action( 'sf_product_before_tabs'); ?>
	
	<?php
	/**
	 * Product Tabs
	 */
	if ($sidebar_config == "no-sidebars") { ?>
		<div class="container product-after-summary">
	<?php } ?>

		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 *
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>

	<?php if ($sidebar_config == "no-sidebars") { ?>
		</div>
	<?php } ?>
	
	<?php do_action( 'sf_product_after_tabs'); ?>

	<?php
	/**
	 * Product Reviews
	 */
	if ( comments_open() && $product_reviews_pos == "default" ) { ?>
	<div id="product-reviews-wrap">
		<div class="container">
			<?php echo comments_template(); ?>
		</div>
	</div>
	<?php } ?>


	<?php
	/**
	 * Product Related
	 */
	if ($sidebar_config == "no-sidebars") { ?>
	<div class="container product-related-wrap">
	<?php } ?>

		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'sf_after_single_product_reviews' );
		?>

	<?php if ($sidebar_config == "no-sidebars") { ?>
	</div>
	<?php } ?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>