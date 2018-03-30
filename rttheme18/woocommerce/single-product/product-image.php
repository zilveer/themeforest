<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>
<div class="images woo_product_images"><section class="product_images carousel-holder plain_carousel_holder without_heding"><section class="carousel_items"><div class="owl-carousel">

	<?php
		if ( has_post_thumbnail() ) { 
			
			$attachment_ids = array_merge( array( get_post_thumbnail_id() ), $product->get_gallery_attachment_ids() ); 
			$attachment_count = count( $product->get_gallery_attachment_ids() );  

			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array( 'zoom' );

				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';

				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';

				$image_link = wp_get_attachment_url( $attachment_id );

				if ( ! $image_link )
					continue;

				$image =  rt_vt_resize( '', $image_link, 460, 1000, false ); 
				$image_title = esc_attr( get_the_title( $attachment_id ) );
				$image_class = esc_attr( implode( ' ', $classes ) ); 

				printf( 
					'<div class="item"><a href="%1$s" class="%2$s" title="%3$s"  data-rel="prettyPhoto[product-gallery]"><img src="%4$s" alt="%3$s"></a></div>',
					$image_link, $image_class, $image_title, $image["url"] );


				$loop++;
			}

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><img src="%s" alt="Placeholder" /></li>', woocommerce_placeholder_img_src() ), $post->ID );

		} 
	?>
 

</div></section></section></div>
<?php

		//js script to run
		printf('
			<script type="text/javascript">
			 /* <![CDATA[ */ 
				// run carousel
					jQuery(document).ready(function() {
						jQuery("%1$s").rt_start_carousels(%2$s,"rounded_carousel");
					}); 
			/* ]]> */	
			</script>
		',".woo_product_images",1);		
 
?>