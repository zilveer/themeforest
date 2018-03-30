<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$zoom     = etheme_get_option('zoom_effect');
$lightbox = etheme_get_option('gallery_lightbox');

$attachment_ids = $product->get_gallery_attachment_ids();

$has_video = false;

$video_attachments = array();
$videos = et_get_attach_video($product->id); 
//$videos = explode(',', $videos[0]);
if(isset($videos[0]) && $videos[0] != '') {
	$video_attachments = get_posts( array(
		'post_type' => 'attachment',
		'include' => $videos[0]
	) ); 
}

if(count($video_attachments)>0 || et_get_external_video($product->id) != '') {
	$has_video = true;
}

if ((has_post_thumbnail() && ( $has_video || $attachment_ids)) || ( $has_video && $attachment_ids)  ) {
	?>
	<div id="product-pager" class="product-thumbnails images-popups-gallery"><?php

		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
        
        $data_rel = '';
		$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
		$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
		$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), array(
			'title' => $image_title
			) );
            
                
                
        if ( has_post_thumbnail() ) {
        	echo sprintf( '<a href="%s" title="%s" class="active-thumbnail" %s ">%s</a>', $image_link, $image_title, $data_rel, $image );
        } else {
	    	echo sprintf( '<a href="%s" class="active-thumbnail" ><img src="%s" /></a>', wc_placeholder_img_src(), wc_placeholder_img_src() );    
        }
        
		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array(); //  'zoom' 

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" %s>%s</a>', $image_link, $image_class, $image_title, $data_rel, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}

	?>
	<?php if(et_get_external_video($product->id)): ?>
		<li class="video-thumbnail">
			<span><?php _e('Video', ETHEME_DOMAIN); ?></span>
		</li>
	<?php endif; ?>
	
	<?php if(count($video_attachments)>0): ?>
		<li class="video-thumbnail">
			<span><?php _e('Video', ETHEME_DOMAIN); ?></span>
		</li>
	<?php endif; ?>
	</div>
        <script type="text/javascript">
		    jQuery('.product-thumbnails').owlCarousel({
		        items : 3,
		        transitionStyle:"fade",
		        navigation: true,
		        navigationText: ["",""],
		        addClassActive: true,
		        itemsCustom: [[0, 2], [479,2], [619,3], [768,3], [1200, 3], [1600, 3]],
		    }); 
		    
		    jQuery('.product-thumbnails .owl-item').click(function(e) {
	            var owlMain = jQuery(".main-images").data('owlCarousel');
	            var owlThumbs = jQuery(".product-thumbnails").data('owlCarousel');
	            owlMain.goTo(jQuery(e.currentTarget).index());
		    });
		    
		    jQuery('.product-thumbnails a').click(function(e) {
			    e.preventDefault();
		    });

        </script>
        	
	<?php
}