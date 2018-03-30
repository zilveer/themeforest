<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

$zoom = etheme_get_option('zoom_effect');

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


if ( (has_post_thumbnail() && ( $has_video || $attachment_ids)) || ( $has_video && $attachment_ids) ) {
	?>
	<div class="thumbnails"><?php

		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

		$thumbImageWidth = etheme_get_option('single_product_thumb_width');
		$thumbImageHeight = etheme_get_option('single_product_thumb_height');
		$thumbImageCrop = false;

		$image = etheme_get_image(false, $thumbImageWidth, $thumbImageHeight, $thumbImageCrop);
	?>
	
	<div class="product-thumbnails-slider">
			
		<ul class="slides">
			<?php if(has_post_thumbnail() ): ?>
				<li><a href="#" class="main-image"><img src="<?php echo $image; ?>"></a></li>
				<?php if ($attachment_ids): ?>
					<?php foreach ($attachment_ids as $key => $value): ?>
						<li><a href="#" class="main-image"><img src="<?php echo etheme_get_image($value, $thumbImageWidth, $thumbImageHeight, $thumbImageCrop); ?>" ></a></li>
					<?php endforeach ?>						
				<?php endif ?>
			<?php endif; ?>
			
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
			
			
			<?php if(!has_post_thumbnail() ): ?>
				<?php if ($attachment_ids): ?>
					<?php foreach ($attachment_ids as $key => $value): ?>
						<li><a href="#" class="main-image"><img src="<?php echo etheme_get_image($value, $thumbImageWidth, $thumbImageHeight, $thumbImageCrop); ?>" ></a></li>
					<?php endforeach ?>						
				<?php endif ?>				
			<?php endif ?>
			

		</ul>
	</div>

			
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery('.product-thumbnails-slider').flexslider({
				animation: "slide",
				slideshow: false,
				animationLoop: false,
				controlNav: true,
				directionNav:true,
				itemWidth:120,
				itemMargin:30,
				asNavFor: '.main-image-slider'
			});
		});
	</script>
</div>
	<?php
}