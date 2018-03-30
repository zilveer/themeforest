<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 * 
 * @cmsms_package 	Agriculture
 * @cmsms_version 	1.6
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

$attachment_ids = $product->get_gallery_attachment_ids();

$image_thumb = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'));

$image_link_thumb = wp_get_attachment_url(get_post_thumbnail_id());


if (sizeof($attachment_ids) > 0) { ?>
	<script type="text/javascript">
		jQuery(document).ready(function () { 
			jQuery('#cmsms_hover_slider_<?php $post->ID; ?>').cmsmsHoverSlider( { 
				sliderBlock : '.cmsms_hover_slider', 
				sliderItems : '.cmsms_hover_slider_items', 
				thumbWidth : '142', 
				thumbHeight : '95'
			} );
		} );
	</script>
	<div class="cmsms_hover_slider" id="cmsms_hover_slider_<?php $post->ID; ?>">
		<ul class="cmsms_hover_slider_items">
			<?php 
				if (has_post_thumbnail()) {
					echo "\t\t\t\t\t\t" . 
					'<li>' . "\n\t\t\t\t\t\t\t" . 
						'<figure class="cmsms_hover_slider_full_img">' . "\n\t\t\t\t\t\t\t\t" . 
							'<a href="' . $image_link_thumb . '" data-group="img_' . $post->ID . '" class="jackbox">' . 
								$image_thumb . 
							'</a>' . 
						'</figure>' . "\r\t\t\t\t\t\t" . 
					'</li>' . "\r";
				}
			
				foreach ($attachment_ids as $attachment_id) {
					$image = wp_get_attachment_image($attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single'));
					$image_link = wp_get_attachment_url($attachment_id);
					
					echo "\t\t\t\t\t\t" . 
					'<li>' . "\n\t\t\t\t\t\t\t" . 
						'<figure class="cmsms_hover_slider_full_img">' . "\n\t\t\t\t\t\t\t\t" . 
							'<a href="' . $image_link . '" data-group="img_' . $post->ID . '" class="jackbox">' .
								$image . 
							'</a>' . 
						'</figure>' . "\r\t\t\t\t\t\t" . 
					'</li>' . "\r";
				}
			?>
		</ul>
	</div>
<?php 
} elseif(has_post_thumbnail()) {
	echo '<figure>' . 
		'<a href="' . $image_link_thumb . '" data-group="img_' . $post->ID . '" class="preloader jackbox">' . 
			$image_thumb . 
		'</a>' . 
	'</figure>';
} else {
	echo '<figure>' . 
		'<img src="' . woocommerce_placeholder_img_src() . '" class="max_width" alt="Placeholder" />' . 
	'</figure>';
}

