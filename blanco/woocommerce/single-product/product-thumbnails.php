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
                        
$product_layout = etheme_get_option('product_layout');
$cloud_zoom = etheme_get_option('cloud_zoom');
$crop = (get_option('woocommerce_single_image_crop') == 1) ? true : false;
$mainHeight = 400;
if($product_layout == 'horizontal') { 
    $mainWidth = 460;
}else if ($product_layout == 'vertical' || $product_layout == 'universal'){
    $mainWidth = 330;
}else{
    $mainWidth = 400;
}
                                    	
$attachment_ids = $product->get_gallery_attachment_ids();
                    
if($attachment_ids){
    ?>
    <div class="views-gallery">
        <ul class="slider <?php if (count($attachment_ids) > 3 && $product_layout == 'universal'){ ?>jcarousel-horizontal<?php } ?>">       
            <?php if (count($attachment_ids) > 0 && $cloud_zoom == 1): ?>
	            <li class="slide">
		            <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="lightbox cloud-zoom-gallery image <?php if($cloud_zoom != 1): ?>zoom<?php endif; ?>" cloud-zoom-data="useZoom: 'zoom1', smallImage: '<?php echo etheme_get_image( $attachment->ID, $mainWidth, $mainHeight, $crop ) ?>'">
		                <?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail'  ) ) ?>
		            </a> 
	            </li>  
            <?php endif ?>  
            <?php       
                $loop = 0;
                
                foreach ( $attachment_ids as $id ) {
                    
                    if ( get_post_meta( $id, '_woocommerce_exclude_image', true ) == 1 ) 
                    continue;
                    ?>
                    <li class="slide">
                        <a href="<?php echo wp_get_attachment_url( $id ) ?>" class="cloud-zoom-gallery image <?php if($cloud_zoom != 1): ?>zoom<?php endif; ?>" <?php if($cloud_zoom == 1){ ?>cloud-zoom-data="useZoom: 'zoom1', smallImage: '<?php echo etheme_get_image( $id, $mainWidth, $mainHeight, $crop ) ?>'"<?php }else{ ?> rel="lightbox[gallery]" <?php } ?>>
                            <?php echo wp_get_attachment_image( $id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ) ?>
                        </a>   
                    </li>               
                        
                    <?php
                }
            ?>
        </ul>
    </div>
    
    <?php if(count($attachment_ids) > 1 && $product_layout != 'universal'){ ?>
        <div class="more-views-arrow prev" style="cursor: pointer; ">&nbsp;</div> 
        <div class="more-views-arrow next" style="cursor: pointer; ">&nbsp;</div> 
    <?php } ?> 
    <?php if(count($attachment_ids) > 1 && $product_layout != 'universal'){ ?>
        <script type="text/javascript">
            jQuery('.views-gallery').iosSlider({
                desktopClickDrag: true,
                snapToChildren: true,
                infiniteSlider: false,
                navNextSelector: '.more-views-arrow.next',
                navPrevSelector: '.more-views-arrow.prev'
            }); 
        </script>  
    <?php } ?>
    <?php if(count($attachment_ids) > 3 && $product_layout == 'universal'){ 
        wp_enqueue_script('jcarousel', get_template_directory_uri().'/js/jcarousel.js');
        wp_enqueue_style("carousel",get_template_directory_uri().'/css/carousel.css');
    ?>
    
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('.jcarousel-horizontal').jcarousel({
                    scroll: 1,
                    vertical:true
                });  
            });
        </script>  
    <?php } ?>   
    <?php
}      
?>