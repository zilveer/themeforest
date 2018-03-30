<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>
<div class="qodef-single-product-images">
	<div class="qodef-single-product-images-holder images">
		<?php do_action('suprema_qodef_woocommerce_out_of_stock_single_action'); ?>
		<?php do_action('suprema_qodef_woocommerce_sale_single_action'); ?>
		<div class="qodef-single-product-slider">

		<?php
        if ( has_post_thumbnail() ) {
            $attachment_count = count( $product->get_gallery_attachment_ids() );
            $gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
            $props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
            $image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                'title'	 => $props['title'],
                'alt'    => $props['alt'],
            ) );
            echo apply_filters(
                'woocommerce_single_product_image_html',
                sprintf(
                    '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a>',
                    esc_url( $props['url'] ),
                    esc_attr( $props['caption'] ),
                    $gallery,
                    $image
                ),
                $post->ID
            );

            //IF there are attached prepare them for slider
            if ( $attachment_count > 0 ) {

                $attachment_ids = $product->get_gallery_attachment_ids();
                foreach ( $attachment_ids as $attachment_id ) {
                    $image_link = wp_get_attachment_image_src($attachment_id, 'full');
                    $props = wc_get_product_attachment_props( $attachment_id, $post );
                    $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_large_thumbnail_size', 'shop_single'));
                    echo apply_filters(
                        'woocommerce_single_product_image_html',
                        sprintf(
                            '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a>',
                            esc_url( $props['url'] ),
                            esc_attr( $props['caption'] ),
                            $gallery,
                            $image
                        ),
                        $post->ID
                    );
                }
            }

        } else {
            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'startit' ) ), $post->ID );
        }

		?>
		</div>
	</div>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
<?php if($product->is_type( 'variable' )){?>
	<div class="qodef-variation-images">
		<?php
		$attachment_id   = get_post_thumbnail_id($post->ID);
		$image_src_thumb = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail' );
		$image_src_original = wp_get_attachment_image_src($attachment_id, 'full' );?>
		<span class="qodef-variation-image"
			  data-original-image = '<?php print esc_attr($image_src_original[0]); ?>'
			  data-thumb-image = '<?php print esc_attr($image_src_thumb[0]); ?>'>
		</span>
		<?php
		$variable_product = new WC_Product_Variable($product);
		$variations = $variable_product->get_available_variations();
		foreach($variations as $variation) {
			if ( has_post_thumbnail($variation['variation_id'])) {
				$attachment_id   = get_post_thumbnail_id($variation['variation_id']);
				$image_src_thumb = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail' );
				$image_src_original = wp_get_attachment_image_src($attachment_id, 'full' );?>
				<span class="qodef-variation-image"
					data-original-image = '<?php print esc_attr($image_src_original[0]); ?>'
					data-thumb-image = '<?php print esc_attr($image_src_thumb[0]); ?>'>
				</span>
		<?php
			}
		}
		?>
	</div>
<?php } ?>