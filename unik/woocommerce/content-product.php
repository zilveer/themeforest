<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<li <?php post_class( $classes ); ?>>
<div class="product-wrap">	
<div class="product-thumb">
	
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<?php
		$preview_audio_url = get_post_meta(get_the_ID(),THEMENAME.'_preview_audio_url',true);
		$preview_audio_title = get_post_meta(get_the_ID(),THEMENAME.'_preview_audio_title',true);
		$preview_audio_artist = get_post_meta(get_the_ID(),THEMENAME.'_preview_audio_artist',true);
		$preview_audio_thumb = get_post_meta(get_the_ID(),THEMENAME.'_preview_audio_thumb',true);
		if(!empty($preview_audio_url)){
			$song = wp_get_attachment_url($preview_audio_id);
			echo '<div class="audio-post-sticker">' .do_shortcode('[audio_button src="'.$preview_audio_url.'" artist="'.$preview_audio_artist.'" title="'.$preview_audio_title.'" cover="'.wp_get_attachment_url($preview_audio_thumb).'"]').'</div>';
		}
	?>
<a href="<?php the_permalink(); ?>">
	<div class="product-img">

		<?php
			
			

			
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
	</div>
	<?php $gallery_images = $product->get_gallery_attachment_ids(); ?>
	
	
	<?php if(count($gallery_images)): ?>
<div class="product-slides flexslider">
<ul class="slides">
<?php 

	foreach ($gallery_images as $gallery_image){
	
		echo '<li style="background-image:url('.wp_get_attachment_url( $gallery_image ).')"> </li>';
		
	}
 ?>
 </ul>
</div> 
<?php endif; ?>
</a>
</div>	
<div class="product-info-box clearfix">
	
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	
	<div class="product-btn-box clearfix"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div>
</div>
</div>
</li>