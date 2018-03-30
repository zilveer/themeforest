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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post, $product, $mk_options;

Mk_Static_Files::addAssets('mk_message_box');
Mk_Static_Files::addAssets('mk_swipe_slideshow');

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<div <?php post_class('mk-product style-default'); ?>class="" itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" >
	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
	<div class="mk-product-details">
		<h1 itemprop="name" class="title"><?php the_title(); ?></h1>
		<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<p itemprop="price" class="mk-single-price"><?php echo $product->get_price_html(); ?></p>
			<meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
			<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
			<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
		</div>
		<?php
		if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' ) {

			$rating_count = $product->get_rating_count();
			$review_count = $product->get_review_count();
			$average      = $product->get_average_rating();

		if ( $rating_count > 0 ) : ?>
		<div class="mk-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
			<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'mk_framework' ), $average ); ?>">
					<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
						<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( __( 'out of %s5%s', 'mk_framework' ), '<span itemprop="bestRating">', '</span>' ); ?>
						<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'mk_framework' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
					</span>
				</div>
				<?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'mk_framework' ), '<span itemprop="reviewCount" class="count">' . $review_count . '</span>' ); ?>)</a><?php endif ?>
		</div>
		<?php  endif; } ?>
		<div class="description">
			<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
		</div>
		<div class="selector">
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

			if($mk_options['woocommerce_catalog'] == 'true') {
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			}

			do_action( 'woocommerce_single_product_summary');

			?>
		</div>
		<div class="meta">
			<?php do_action( 'woocommerce_product_meta_start' ); ?>

			<?php
			$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
			$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

			if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

				<span class="sku_wrapper"><?php _e( 'SKU:', 'mk_framework' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'mk_framework' ); ?></span>. </span>
			<?php endif; ?>
			<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'mk_framework' ) . ' ', '.</span>' ); ?>
			<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'mk_framework' ) . ' ', '.</span>' ); ?>

			<?php do_action( 'woocommerce_product_meta_end' ); ?>
		</div>
		<div class="social-share">
			<?php
				if(isset($mk_options['woocommerce_single_social_network']) && $mk_options['woocommerce_single_social_network'] == 'true') :
				$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true ); ?>
				<ul>
					<li>
						<a class="facebook-share" data-title="<?php the_title_attribute();?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#">
							<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-jupiter-icon-simple-facebook'); ?>	
						</a>
					</li>
					<li>
						<a class="twitter-share" data-title="<?php the_title_attribute();?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#">
							<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-moon-twitter'); ?>
						</a>
					</li>

					<li>
						<a class="googleplus-share" data-title="<?php the_title_attribute();?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#">
							<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-jupiter-icon-simple-googleplus'); ?>
						</a>
					</li>

					<li>
					<a class="pinterest-share" data-image="<?php echo $image_src_array[0]; ?>" data-title="<?php the_title_attribute();?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#">
						<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-jupiter-icon-simple-pinterest'); ?>
						</a>
					</li>
					
				</ul>
			<?php endif; ?>
		</div>
	</div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>