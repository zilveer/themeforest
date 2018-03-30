<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	?>

		<div class="container">

		<?php
	 	echo get_the_password_form();
	 	?>
		</div>

	 	<?php
	 	return;
	 }
?>
<?php
$classes = get_post_class("row");
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs');
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>"  <?php post_class($classes); ?>  id="product-<?php the_ID(); ?>">
	<div class="product-gallery menu-item">

		<?php
			//add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 5 );
			add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 10);
			do_action('woocommerce_before_single_product_summary');
		?>

		<div class="product item-description">
			<div class="">
				<div class="">
					<?php 
						if(YSettings::g('woocommerce_show_rating_on_single') == 1) {
							add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );
						}
						add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 10 );
						add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );
						add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
						add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 30 );
						//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40 );
						add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
						do_action( 'woocommerce_single_product_summary' );
					?>
				</div>
			</div>
		</div>
	</div>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div>
<div class="row">
	<?php
	global $post, $woocommerce, $product;

	$gallery_attachment_ids = $product->get_gallery_attachment_ids();

	?>

	<div class="product-description">
		<div class="purchase">
			<h3 class="h4"><?php _e('Purchase options', 'BERG'); ?></h3>
			<?php
			add_action('berg_woocommerce_single_product_cart', 'woocommerce_template_single_add_to_cart', 5);
			do_action('berg_woocommerce_single_product_cart');
			?>
		</div>
		
		<?php if(!empty($post->post_content) && $post->post_content != '[vc_row el_class="hidden"][vc_column width="1/1"][/vc_column][/vc_row]') : ?> 
		<div class="description">
			<?php
			$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'woocommerce' ) ) );
			?>

			<?php if ( $heading ): ?>
			<h3 class="h4"><?php echo $heading; ?></h3>
			<?php endif; ?>

			<?php the_content(); ?>
		</div>
		<?php endif;?>

		<?php
		add_action( 's_woocommerce_output_product_data_tabs', 'comments_template', 1);
		do_action( 's_woocommerce_output_product_data_tabs' );
		
		?>

	</div>
	<div class="product-photos ">
	<div class="swiper-container gallery-thumbs">

		<div class="swiper-wrapper berg-product-carousel2" id="product-carousel2">
			<?php 

			// if (count($gallery_attachment_ids) > 1) {
				if (has_post_thumbnail()) {
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'menu_thumb');
					echo '<div class="swiper-slide"><figure><img src="'.$large_image_url[0].'" alt=""/></figure></div>';
				}
				/* Gallery Thumb Images */
				$loop = 0;
				$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

				foreach ($gallery_attachment_ids as $attachment_id) {
					$classes = array( 'zoom' );

					if ( $loop == 0 || $loop % $columns == 0 ) {
						$classes[] = 'first';
					}

					if ( ( $loop + 1 ) % $columns == 0 ) {
						$classes[] = 'last';
					}

					$image_link = wp_get_attachment_url( $attachment_id );

					if ( ! $image_link ) {
						continue;
					}

					$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'menu_thumb' ) );
					$image_class = esc_attr( implode( ' ', $classes ) );
					$image_title = esc_attr( get_the_title( $attachment_id ) );

					echo apply_filters('woocommerce_single_product_image_html', sprintf( '<div class="swiper-slide"><figure>%s</figure></div>', $image), $post->ID);
					$loop++;
				}
			// }
			?>
		</div>
		<div class="swiper-next"><i class="arrow-right-open"></i></div>
		<div class="swiper-prev"><i class="arrow-left-open"></i></div>
		
		
		
	</div>
	<?php woocommerce_upsell_display(); ?>
		<?php woocommerce_output_related_products(); ?>	
	</div>
		


</div>


<?php //do_action( 'woocommerce_after_single_product' ); ?>
