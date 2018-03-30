<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $post, $product;

$item_preview_type  = get_data('shop_item_preview_type');
$product_images     = $product->get_gallery_attachment_ids();

// Link open <a>
woocommerce_template_loop_product_link_open();

# Primary Thumbnail
echo woocommerce_get_product_thumbnail(apply_filters('laborator_wc_product_loop_thumb_size', 'shop-thumb'));

# Remove Duplicate Images
if(has_post_thumbnail())
{
	$post_thumb_id = get_post_thumbnail_id();

	foreach($product_images as $i => $attachment_id)
	{
		if($post_thumb_id == $attachment_id  || ! wp_get_attachment_url($attachment_id))
		{
			unset($product_images[$i]);
		}
	}
}

# Other Thumbnails
if(count($product_images) && $item_preview_type != 'none'):

	if(in_array($item_preview_type, array('fade', 'slide'))):

		$attachment_id = reset($product_images);

		if($attachment = wp_get_attachment_image($attachment_id, apply_filters('laborator_wc_product_loop_thumb_size', 'shop-thumb')))
		{
			$image = str_replace( array( ' src="', ' class="' ), array( ' data-src="', ' class="shop-image lazy-load-shop-image ' ), $attachment );
			echo $image;
			
			/*
			?>
			<img class="shop-image lazy-load-shop-image" data-src="<?php echo $image_url; ?>" />
			<?php
			*/
		}

	endif;


	if($item_preview_type == 'gallery'):

		foreach($product_images as $attachment_id)
		{
			if($attachment = wp_get_attachment_image($attachment_id, apply_filters('laborator_wc_product_loop_thumb_size', 'shop-thumb')))
			{
				$image = str_replace( array( ' src="', ' class="' ), array( ' data-src="', ' class="shop-image lazy-load-shop-image ' ), $attachment );
				echo $image;

				/*
				?>
				<img class="shop-image lazy-load-shop-image" data-src="<?php echo $image_url; ?>" alt="attachment-<?php echo $attachment_id; ?>" />
				<?php
				*/
			}
		}

	endif;

endif;

// Link close </a>
woocommerce_template_loop_product_link_close();

if(get_data('shop_wishlist_catalog_show') && is_yith_wishlist_supported())
{
	laborator_yith_wcwl_add_to_wishlist();
}