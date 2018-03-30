<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce;

$product_layout = etheme_get_option('product_layout');
$cloud_zoom = etheme_get_option('cloud_zoom');
$mainHeight = 400;
$imgId = get_post_thumbnail_id();
$crop = (get_option('woocommerce_single_image_crop') == 1) ? true : false;
if($product_layout == 'horizontal') { 
    $mainWidth = 460;
}else if ($product_layout == 'vertical' || $product_layout == 'universal'){
    $mainWidth = 330;
}else{
    $mainWidth = 400;
}

if($cloud_zoom == 1){
    wp_enqueue_style("cloud-zoom",get_template_directory_uri().'/css/cloud-zoom.css');
    wp_enqueue_script('cloud-zoom', get_template_directory_uri().'/js/cloud-zoom.1.0.2.js');
}

?>
<h1 class="mobile-title"><?php the_title(); ?></h1>
<div class="product-images images <?php if($cloud_zoom == 1){ echo "zoom-enabled"; } ?>">
	<?php etheme_print_stars(); ?>
	<?php if ( has_post_thumbnail() ) : ?>
        <div class="main-image" style="position:relative;">
            <a itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" id="zoom1" class="woocommerce-main-image zoom cloud-zoom main-zoom-image" <?php if($cloud_zoom == 1){ ?> cloud-zoom-data="adjustX: 10, adjustY:-4" <?php }else{ ?> rel="lightbox[gallery]" <?php } ?> title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>">
                <img class="attachment-shop_single wp-post-image" src="<?php echo etheme_get_image( $imgId, $mainWidth, $mainHeight, $crop ) ?>" alt="<?php echo get_post_meta($imgId, '_wp_attachment_image_alt', true)?>" />
            </a>
        </div>
	<?php else : ?>
	
		<img width="<?= $mainWidth ?>" height="<?= $mainHeight ?>" src="<?php echo woocommerce_placeholder_img_src(); ?>" alt="Placeholder" />
	
	<?php endif; ?>

	<?php do_action('woocommerce_product_thumbnails'); ?>

</div>