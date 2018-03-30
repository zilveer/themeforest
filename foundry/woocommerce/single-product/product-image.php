<?php
	/**
	 * @package Foundry
	 * @author TommusRhodus
	 * @version 3.0.0
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
	
	global $post, $woocommerce, $product;
	
	if(!( $product->is_type( 'variable' ) )) :
	
	$thumbnail = has_post_thumbnail();
?>

<div class="image-slider slider-thumb-controls controls-inside">

    <?php  
    	if ( $product->is_on_sale() )
    		echo apply_filters( 'woocommerce_sale_flash', '<span class="label">' . __( 'Sale!', 'foundry' ) . '</span>', $post, $product );
    ?>
    
    <ul class="slides">
    
    	<?php if ( $thumbnail ) : ?>
    		<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>
    		<li>
    			<a href="<?php echo esc_url($url[0]); ?>" data-lightbox="true" data-title="<?php the_title(); ?>">
    				<?php the_post_thumbnail('large'); ?>
    			</a>
    		</li>
    	<?php endif; ?>
    	
    	<?php
    		$attachment_ids = $product->get_gallery_attachment_ids();
    		
    		if ( $attachment_ids ) {
    			foreach ( $attachment_ids as $attachment_id ){
    				
    				$url = wp_get_attachment_image_src( $attachment_id, 'full');
    				
    				echo '<li><a href="'. esc_url($url[0]) .'" data-lightbox="true" data-title="'. get_the_title() .'">'. wp_get_attachment_image( $attachment_id, 'large' ) . '</a></li>';
    				
    			}
    		}
    	?>

    </ul>
    
</div>

<?php else : ?>

<div class="images">

	<?php
		if ( has_post_thumbnail() ) {

			$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	=> $image_title,
				'alt'	=> $image_title
				) );

			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-lightbox="true">%s</a>', $image_link, $image_caption, $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>

<?php endif; ?>