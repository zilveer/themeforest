<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;
$g5plus_woocommerce_loop = G5Plus_Global::get_woocommerce_loop();

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;



// Extra post classes
$classes = array();
$classes[] = 'product-item-wrap';

global $product;
$thumb_url = '';
$attachment_ids  = $product->get_gallery_attachment_ids();
if(is_array($attachment_ids) && count($attachment_ids) >0){
	$thumb_url = matthewruddy_image_resize_id($attachment_ids[0],80,80);
}
$post_id = get_the_ID();
$duration = get_post_meta($post_id, 'duration', true );
$level = get_post_meta($post_id, 'level', true );
$teacher_meta = get_post_meta($post_id, 'teacher', true );
if(isset($teacher_meta) && $teacher_meta!=''){
	$teacher_meta = explode(",",$teacher_meta);
	if(count($teacher_meta)>0){
		$teacher = get_the_title($teacher_meta[0]);
	}
}
?>
<div class="course-item-wrap">
	<div class="course-thumb">
		<img src="<?php echo esc_url($thumb_url)?>" />
	</div>
	<div class="course-info fs-12">
		<a class="fs-12 course-title p-color-hover" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<?php if(isset($duration) && $duration!=''){ ?>
			<span><i class="fa fa-calendar p-color pd-right-10"></i><?php echo esc_html($duration) ?></span>
		<?php } ?>

		<?php if(isset($teacher) && $teacher!=''){ ?>
			<span><i class="fa fa-user p-color pd-right-10"></i><?php echo esc_html($teacher) ?></span>
		<?php } ?>
		<?php if ( $price_html = $product->get_price_html() ) : ?>
			<span><i class="fa fa-money s-color pd-right-5"></i><?php echo $price_html; ?></span>
		<?php else: ?>
			<span><i class="fa fa-money s-color pd-right-5"></i><?php esc_html_e('Free','g5plus-academia') ?></span>
		<?php endif; ?>
	</div>
</div>

