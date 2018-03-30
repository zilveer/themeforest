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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce, $woo_config;;

$id = get_queried_object_id();
	
if(is_product()){
	$layout = theme_get_inherit_option($id, '_layout', 'advanced','woocommerce_product_layout');
}else{
	$layout = theme_get_inherit_option($id, '_layout', 'advanced','woocommerce_layout');
}

if($layout == 'full'){
	$sizes = array($woo_config['full']['shop_thumbnail']['width'], $woo_config['full']['shop_thumbnail']['height']);
}else{
	$sizes = array($woo_config['sidebar']['shop_thumbnail']['width'], $woo_config['sidebar']['shop_thumbnail']['height']);
}

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
	<div class="thumbnails <?php echo 'columns-' . $columns; ?>"><?php

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			if ( $loop === 0 || $loop % $columns === 0 ) {
				$classes[] = 'first';
			}

			if ( ( $loop + 1 ) % $columns === 0 ) {
				$classes[] = 'last';
			}

			$image_class =  esc_attr( implode( ' ', $classes ) );
			$props       = wc_get_product_attachment_props( $attachment_id, $post );

			if ( ! $props['url'] ) {
				continue;
			}
			$image_src = theme_get_image_src(array('type'=>'attachment_id','value'=>$attachment_id), $sizes);
			$image_title 		= esc_attr( $props['title'] );
			$image_caption 	= esc_attr( $props['caption'] );
			if (empty($image_caption)) $image_caption=$image_title;
			$image_alt 		= esc_attr( $props['alt'] );
			if (empty($image_alt)) $image_alt=$image_title;
			
			$image = '<img class="attachment-shop_thumbnail product-thumbnail" width="'.$sizes[0].'" height="'.$sizes[1].'" data-thumbnail="'.$attachment_id.'" src="'.$image_src.'" title="'.$image_title.'" alt="'.$image_alt.'" />';

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" rel="prettyPhoto[product-gallery]">%s</a>', esc_url( $props['url'] ), $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}

	?></div>
	<?php
}
