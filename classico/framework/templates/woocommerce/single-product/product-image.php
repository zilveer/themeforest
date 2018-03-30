<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $etheme_global, $product;
$zoom     = etheme_get_option('zoom_effect');
$lightbox = etheme_get_option('gallery_lightbox');
$slider   = etheme_get_option('images_slider');

if(!empty($etheme_global['zoom'])) {
	$zoom = $etheme_global['zoom'];
}

if(!empty($etheme_global['slider'])) {
	$slider = $etheme_global['slider'];
}


?>
<div class="images">

	<?php
		if ( has_post_thumbnail() ) {
            $data_rel = '';
			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );
            $attachment_ids = $product->get_gallery_attachment_ids();
			$attachment_count = count( $attachment_ids );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}
            
            if($lightbox) $data_rel = 'data-rel="gallery' . $gallery . '"';
            
            ?>
            
            <div class="<?php if ($slider): ?>product-images-slider<?php else: ?>product-images-gallery<?php endif ?> main-images images-popups-gallery <?php if ($zoom != 'disable') { echo 'zoom-enabled'; } ?>">
            	<div>
	                <?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom product-image" data-o_href="%s" title="%s">%s</a>', $image_link, $image_link, $image_title, $image ), $post->ID ); ?>
	                <?php if($lightbox): ?>
	                	<a href="<?php echo $image_link; ?>" class="product-lightbox-btn" <?php echo $data_rel; ?> title="title here">lightbox</a>
	                <?php endif; ?>
            	</div>
                <?php
                	$_i = 0;
                    if($attachment_count > 0) {
            			foreach($attachment_ids as $id) {
            				$_i++;
            				?>
            				<div>
	            				<?php 
	                            
	                			$image_title = esc_attr( get_the_title( $id ) );
	                			$image_link  = wp_get_attachment_url( $id );
	                            $image = wp_get_attachment_image_src($id, 'shop_single');
	                            
	                            echo sprintf( '<a href="%s" itemprop="image" class="woocommerce-additional-image product-image" title="%s"><img src="%s" class="lazyOwl"/></a>', $image_link, $image_title, $image[0] );  
	                            
	                            if($lightbox):
		                            ?>
		                            	<a href="<?php echo $image_link; ?>" class="product-lightbox-btn" <?php echo $data_rel; ?>>lightbox</a>
		                            <?php
	                            endif;
	            				?>
            				</div>
            				<?php 
                            
            			}
            		
            		}
                ?>
            </div>

            
            
	            <script type="text/javascript">
		            <?php if ($slider): ?>
		                jQuery('.main-images').owlCarousel({
					        items:1,
					        navigation: true,
					        lazyLoad: false,
					        rewindNav: false,
					        addClassActive: true,
					        itemsCustom: [1600, 1],
					        afterMove: function(args) {
					            var owlMain = jQuery(".main-images").data('owlCarousel');
					            var owlThumbs = jQuery(".product-thumbnails").data('owlCarousel');
					            
					            jQuery('.active-thumbnail').removeClass('active-thumbnail')
					            jQuery(".product-thumbnails").find('.owl-item').eq(owlMain.currentItem).addClass('active-thumbnail');
					            if(typeof owlThumbs != 'undefined') {
					            	owlThumbs.goTo(owlMain.currentItem-1);
					            }
					        }
					    });
				    <?php endif ?>	
					<?php if ($zoom != '' && $zoom != 'disable') {
						?>	
							if(jQuery(window).width() > 768){
								jQuery(document).ready(function(){
									jQuery('.main-images .product-image').swinxyzoom({mode:'<?php echo $zoom ?>', controls: false, size: '100%', dock: { position: 'right' } }); // dock window slippy lens
								});
							}
						<?php
					} ?>
					jQuery('.main-images a').click(function(e){
						e.preventDefault();
					});
	            </script>	

            

            <?php

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

		}
	?>

	<?php if ($slider): ?>
		<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	<?php endif ?>	

</div>
