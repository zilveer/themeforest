<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
?>
<div class="small_images_wrapper">
    <div class="small_image">
        <div class="image_wrapper">
            <div class="imgwrp"><?php the_post_thumbnail('products-500', array('class' => 'attachment-products-500 content_image')); ?></div><!-- imgwrp -->
            <div class="image_more_info small">
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/home/more.png" class="customColorBg" alt="" /></a>
            </div><!-- image_more_info -->
            </div><!-- image_wrapper -->
        </div><!-- small_image -->
	<?php if ( isset($attachment_ids[0]) ) : ?>
    <div class="small_image last">
        <div class="image_wrapper">
            <div class="imgwrp">
			<?php $large_image_url = wp_get_attachment_image_src( $attachment_ids[0], 'products-500'); ?>
			<a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto[gallery-product]"><?php
            echo wp_get_attachment_image( $attachment_ids[0], 'products-500');
            ?></a></div><!-- imgwrp -->
            <div class="image_more_info small">
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/home/more.png" class="customColorBg" alt="" /></a>
            </div><!-- image_more_info -->
            </div><!-- image_wrapper -->
        </div><!-- small_image -->
	<?php endif; ?>
	<?php if ( isset($attachment_ids[1]) ) : ?>
    <div class="small_image">
        <div class="image_wrapper">
            <div class="imgwrp">
			<?php $large_image_url = wp_get_attachment_image_src( $attachment_ids[1], 'products-500'); ?>
			<a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto[gallery-product]"><?php
            echo wp_get_attachment_image( $attachment_ids[1], 'products-500');
            ?></a></div><!-- imgwrp -->
            <div class="image_more_info small">
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/home/more.png" class="customColorBg" alt="" /></a>
            </div><!-- image_more_info -->
            </div><!-- image_wrapper -->
        </div><!-- small_image -->
	<?php endif; ?>
	<?php if ( isset($attachment_ids[2]) ) : ?>
    <div class="small_image last last2">
        <div class="image_wrapper">
            <div class="imgwrp">
			<?php $large_image_url = wp_get_attachment_image_src( $attachment_ids[2], 'products-500'); ?>
			<a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto[gallery-product]"><?php
            echo wp_get_attachment_image( $attachment_ids[2], 'products-500');
            ?></a></div><!-- imgwrp -->
            <div class="image_more_info small">
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/home/more.png" class="customColorBg" alt="" /></a>
            </div><!-- image_more_info -->
            </div><!-- image_wrapper -->
        </div><!-- small_image -->
	<?php endif; ?>
    <div class="clear"></div><!-- clear -->
    </div><!-- small_images_wrapper -->
	<?php
}
