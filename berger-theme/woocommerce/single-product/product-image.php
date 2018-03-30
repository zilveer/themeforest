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

global $post, $woocommerce, $product;

?>
<!-- Product Slider -->
<div class="one_half">

	<?php
	
		$gallery = $product->get_gallery_attachment_ids();
		$attachment_count = count( $gallery );
		
		if ( $attachment_count ) {

			echo '<!-- Classic Slider -->';
            echo '<div class="classic-slider flexslider">';
            echo '<ul class="slides">';
            
			foreach( $gallery as $image_id ){
				
				$image_title = esc_attr( get_the_title( $image_id ) );
				$image_link  = wp_get_attachment_url( $image_id );
					
				echo '<li>';
                echo '<a class="gallery" href="' . esc_url( $image_link ) . '"><img alt="' . $image_title . '" src="' . esc_url( $image_link ) . '"></a>';                                    
                echo '</li>';

			}
			
			echo '</ul>';
			echo '<!-- /Classic Slider -->';
            echo '</div>';
            

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

		}
	?>

	<?php //do_action( 'woocommerce_product_thumbnails' ); ?>

<!-- /Product Slider -->
</div>
