<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $etheme_global, $product;
$zoom     = etheme_get_option('zoom_effect');
$lightbox = etheme_get_option('gallery_lightbox');
$slider   = etheme_get_option('images_slider');

if(!empty($etheme_global['zoom'])) {
	$zoom = $etheme_global['zoom'];
}

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

?>
<div class="images">

	<?php
		
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
            	<?php if ( has_post_thumbnail() ) { ?>
	            	<div>
		                <?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image product-image" data-o_href="%s" title="%s">%s</a>', $image_link, $image_link, $image_title, $image ), $post->ID ); ?>
		                <?php if($lightbox): ?>
		                	<a href="<?php echo $image_link; ?>" class="product-lightbox-btn" <?php echo $data_rel; ?>>lightbox</a>
		                <?php endif; ?>
	            	</div>
            	<?php } else { ?>
	            	<div>
		                <?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image product-image" data-o_href="%s"><img src="%s" /></a>', wc_placeholder_img_src(), wc_placeholder_img_src(), wc_placeholder_img_src() ), $post->ID ); ?>
	            	</div>
            	<?php } ?>
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
				<?php if(et_get_external_video($product->id)): ?>
					<div>
						<?php echo et_get_external_video($product->id); ?>
					</div>
				<?php endif; ?>
				
	
				<?php if(count($video_attachments)>0): ?>
						<div>
							<video controls="controls">
								<?php foreach($video_attachments as $video):  ?>
									<?php $video_ogg = $video_mp4 = $video_webm = false; ?>
									<?php if($video->post_mime_type == 'video/mp4' && !$video_mp4): $video_mp4 = true; ?>
										<source src="<?php echo $video->guid; ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
									<?php endif; ?>
									<?php if($video->post_mime_type == 'video/webm' && !$video_webm): $video_webm = true; ?>
										<source src="<?php echo $video->guid; ?>" type='video/webm; codecs="vp8, vorbis"'>
									<?php endif; ?>
									<?php if($video->post_mime_type == 'video/ogg' && !$video_ogg): $video_ogg = true; ?>
										<source src="<?php echo $video->guid; ?>" type='video/ogg; codecs="theora, vorbis"'>
										<?php _e('Video is not supporting by your browser', ETHEME_DOMAIN); ?>
										<a href="<?php echo $video->guid; ?>"><?php _e('Download Video', ETHEME_DOMAIN); ?></a>
									<?php endif; ?>
								<?php endforeach; ?>
							</video>
						</div>
				<?php endif; ?>
            </div>
            
            <script type="text/javascript">
	            <?php if ($slider): ?>
	                jQuery('.main-images').owlCarousel({
				        items:1,
				        navigation: true,
				        lazyLoad: false,
				        rewindNav: false,
				        addClassActive: true,
				        autoHeight : true,
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
				<?php if ($zoom != 'disable') {
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

	<?php if ($slider): ?>
		<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	<?php endif ?>	

</div>
