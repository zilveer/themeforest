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
	exit;
}
	
	global $post, $product, $mr_tailor_theme_options;

    $modal_class = "";
	$zoom_class = "";
	$plus_button = "";
	
	if (get_option('woocommerce_enable_lightbox') == "yes") {
        $modal_class = "fresco";
		$zoom_class = "";
		$plus_button = '<span class="product_image_zoom_button show-for-medium-up"><i class="fa fa-plus"></i></span>';
    }
	
	if ( (isset($mr_tailor_theme_options['product_gallery_zoom'])) && ($mr_tailor_theme_options['product_gallery_zoom'] == "1" ) ) {
		$modal_class = "zoom";
		$zoom_class = "easyzoom el_zoom";
		$plus_button = "";
	}	
	

?>

<?php
    
//Featured

$image_title 				= esc_attr( get_the_title( get_post_thumbnail_id() ) );
$image_src 					= wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_thumbnail' );
$image_data_src				= wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_single' );
$image_data_src_original 	= wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
$image_link  				= wp_get_attachment_url( get_post_thumbnail_id() );
$image       				= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
$image_original				= get_the_post_thumbnail( $post->ID, 'full' );
$attachment_count   		= count( $product->get_gallery_attachment_ids() );

echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="featured_img_temp">%s</div>', $image ), $post->ID );

?>

<div class="images">

	<?php if ( has_post_thumbnail() ) { ?>
    
    <div class="product_images">
        
        <div id="product-images-carousel" class="owl-carousel">
    
			<?php

            //Featured
			
			?>
			
			<div class="<?php echo $zoom_class; ?>">
                
            	<a data-fresco-group="product-gallery" data-fresco-options="fit: 'width'" class="<?php echo $modal_class; ?>" href="<?php echo esc_url($image_link); ?>">
                
					<?php echo $image; ?>
                    <?php echo $plus_button; ?>

            	</a>
           
            </div>
            
			
			<?php
            
			//Thumbs
            
            $attachment_ids = $product->get_gallery_attachment_ids();
            
            if ( $attachment_ids ) {
                
                foreach ( $attachment_ids as $attachment_id ) {
        
                    $image_link = wp_get_attachment_url( $attachment_id );
        
                    if (!$image_link) continue;
        
                    $image_title       			= esc_attr( get_the_title( $attachment_id ) );
                    $image_src         			= wp_get_attachment_image_src( $attachment_id, 'shop_single_small_thumbnail' );
					$image_data_src    			= wp_get_attachment_image_src( $attachment_id, 'shop_single' );
					$image_data_src_original 	= wp_get_attachment_image_src( $attachment_id, 'full' );
					$image_link        			= wp_get_attachment_url( $attachment_id );
				    $image		      			= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
					
					?>                    
								
					<div class="<?php echo $zoom_class; ?>">
                        
                        <a data-fresco-group="product-gallery" data-fresco-options="fit: 'width'" class="<?php echo $modal_class; ?>" href="<?php echo esc_url($image_link); ?>">
                    
                            <img src="<?php echo esc_url($image_src[0]); ?>" data-src="<?php echo esc_url($image_data_src[0]); ?>" class="lazyOwl" alt="<?php echo esc_html($image_title); ?>">
                            <?php echo $plus_button; ?>

                        </a>
                        
                    </div>
                    
                	<?php
				
                }
                
            }
            
            ?>
                
    	</div>
        
    </div><!-- /.product_images -->

	<?php

    } else {
	echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
    }
	
    ?>

</div>
