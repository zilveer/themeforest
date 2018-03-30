<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( has_post_thumbnail() ) {
	?>
		<?php if($attachment_ids): ?>		
			<div class="product-img-box">

			<?php
				$preview_audio_id = get_post_meta(get_the_ID(),THEMENAME.'_preview_audio',true);
				if(!empty($preview_audio_id)){
					$song = wp_get_attachment_url($preview_audio_id);
					echo '<div class="audio-post-sticker">'.do_shortcode('[audio_button src="'.$song.'"]').'</div>';
				}
			?>

			<?php $image_link = wp_get_attachment_url( $attachment_ids[0] ); ?>
			<img id="product-img-zoom"  src="<?php echo $image_link; ?>" data-zoom-image="<?php echo $image_link; ?>">
		</div>
		<div  class='product-img-gal flexslider'>
		<ul class="slides">
		<?php
		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
		foreach ( $attachment_ids as $attachment_id ) {
			$classes = array( 'zoom' );

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
?>
			<li><a href="#" data-image="<?php echo $image_link; ?>" data-zoom-image="<?php echo $image_link; ?>" class="elevatezoom-gallery">
			<?php echo $image; ?>
  </a></li>

<?php			$loop++;
		}

	?></ul></div>	
			<?php else : 
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			?>
			<div class="product-img-box">
				<?php
					$preview_audio_id = get_post_meta(get_the_ID(),THEMENAME.'_preview_audio',true);
					if(!empty($preview_audio_id)){
						$song = wp_get_attachment_url($preview_audio_id);
						echo '<div class="audio-post-sticker">'.do_shortcode('[audio_button src="'.$song.'"]').'</div>';
					}
				?>
				<img id="product-img-zoom"  src="<?php echo $image_link; ?>" data-zoom-image="<?php echo $image_link; ?>">
		</div>
			<?php endif; ?>	

	<?php
}
else{ 
?>
	<div class="img-box">
			<?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID ); ?>
		</div>
<?php }
?>