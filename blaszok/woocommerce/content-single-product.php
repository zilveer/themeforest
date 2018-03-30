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
global $woocommerce, $product;
global $mpcth_options;
global $jckWooThumbs;

$share = isset( $mpcth_options[ 'mpcth_disable_share' ] ) ? $mpcth_options[ 'mpcth_disable_share' ] : false;

$attachment_ids = $product->get_gallery_attachment_ids();

$format = '';
if ( $attachment_ids )
	$format = ' format-gallery';

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	echo '<div class="mpcth-single-notices">';
		do_action( 'woocommerce_before_single_product' );
	echo '</div>';

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('mpcth-post' . $format . (class_exists('JckWooThumbs') && $jckWooThumbs['sliderPosition'] != 'right' ? ' mpcth-thumbs-sale-swap' : '')); ?>>

	<div class="mpcth-product-header">
		<?php
			/**
			 * woocommerce_before_single_product_summary hook
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );

			//if (class_exists('JckWooThumbs'))
//				woocommerce_show_product_sale_flash();


			// woocommerce_show_product_images();
		?>

		<div class="summary entry-summary">
			<div class="mpcth-post-pagination">
				<?php
					if (! is_rtl()) {
						previous_post_link('%link', '<i class="fa fa-angle-left"></i>', true, '', 'product_cat');
						next_post_link('%link', '<i class="fa fa-angle-right"></i>', true, '', 'product_cat');
					} else {
						next_post_link('%link', '<i class="fa fa-angle-right"></i>', true, '', 'product_cat');
						previous_post_link('%link', '<i class="fa fa-angle-left"></i>', true, '', 'product_cat');
					}
				?>
			</div>
			<h1 itemprop="name" class="mpcth-post-title mpcth-deco-header">
				<span class="mpcth-color-main-border">
					<?php the_title(); ?>
				</span>
			</h1>
			<?php
				if (get_option('woocommerce_enable_review_rating') == 'yes') {
					$count = $product->get_rating_count();

					if ($count > 0)
						$average = $product->get_average_rating();
					else
						$average = 0;
					?>

					<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
						<a href="#reviews" class="woocommerce-review-link mpcth-color-main-color-hover" rel="nofollow"><?php printf( _n( '%s review', '%s reviews', $count, 'mpcth' ), '<span itemprop="ratingCount" class="count">' . $count . '</span>' ); ?></a>
						<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'woocommerce' ), $average ); ?>">
							<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
								<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?>
							</span>
						</div>
					</div>

					<?php
				}
			?>
			<?php woocommerce_breadcrumb(); ?>
			<div class="product-price">
				<?php woocommerce_template_single_price(); ?>
			</div>
			<?php //woocommerce_template_single_add_to_cart(); ?>
			<?php
				/**
				 * woocommerce_single_product_summary hook
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 */
				do_action( 'woocommerce_single_product_summary' );
			?>
			<?php
				$enable_custom_size_quide = get_field('mpc_enable_custom_size_guide');

				if ($enable_custom_size_quide) {
					$custom_size_quide = get_field('mpc_custom_size_guide');

					if ($custom_size_quide)
						echo '<a href="' . $custom_size_quide . '" class="mpcth-size-guide mpcth-alt-lightbox"><i class="fa fa-scissors"></i>' . __('Size Guide', 'mpcth') . '</a>';
				} else {
					$enable_size_quide = isset($mpcth_options['mpcth_enable_size_guide']) && $mpcth_options['mpcth_enable_size_guide'];
					$size_quide = '';
					if (isset($mpcth_options['mpcth_size_quide']) && $mpcth_options['mpcth_size_quide'])
						$size_quide = $mpcth_options['mpcth_size_quide'];

					if ($enable_size_quide && $size_quide)
						echo '<a href="' . $size_quide . '" class="mpcth-size-guide mpcth-alt-lightbox"><i class="fa fa-scissors"></i>' . __('Size Guide', 'mpcth') . '</a>';
				}
			?>

	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

		<div class="info entry-info">
			<?php woocommerce_output_product_data_tabs(); ?>

			<?php woocommerce_template_single_meta(); ?>

			<?php if( !$share ): ?>
				<div class="product_share">
					<?php echo do_shortcode('[mpc_vc_share_list title="' . __('Share', 'mpcth') . ':" facebook="1" twitter="1" google_plus="1" pinterest="1"]'); ?>
				</div><!-- .product_share -->
			<?php endif; ?>
		</div><!-- .info -->
	</div><!-- .mpcth-product-header -->

	<div class="mpcth-product-content">
		<?php the_content(); ?>

		<?php
		if( isset( $mpcth_options[ 'mpcth_enable_auto_related_products' ] ) && $mpcth_options[ 'mpcth_enable_auto_related_products' ] ) {
			$columns = isset( $mpcth_options[ 'mpcth_related_columns' ] ) ? $mpcth_options[ 'mpcth_related_columns' ] : 4;

			woocommerce_related_products( array( 'columns' => $columns, 'posts_per_page' => $columns ) );
		}
		?>
	</div>

	<?php
		global $sidebar_position;

		if ($sidebar_position != 'none')
			$args = array('posts_per_page' => 3, 'columns' => 1);
		else
			$args = array('posts_per_page' => 4, 'columns' => 1);

		woocommerce_upsell_display($args['posts_per_page'], 1);
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
