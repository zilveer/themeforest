<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

global $post, $woocommerce, $smof_data, $product;

?>
<div class="image">
    <?php 
    
    $attach_id = get_post_thumbnail_id($product->id);
            
    $image_title =  esc_attr( get_the_title( $attach_id ) );
    
    $image_url = wp_get_attachment_image_src($attach_id,'full');
    
    $image_url = $image_url[0];
    
    $attachments = $product->get_gallery_attachment_ids();

    if($smof_data['sellya_en_colorbox'] != '0'):
        
    ?>			
        <a href="<?php echo $image_url; ?>" itemprop="image" title="<?php echo $image_title; ?>" class="colorbox"><img src="<?php echo $image_url; ?>" title="<?php echo $image_title; ?>" alt="<?php echo $image_title; ?>" id="image" /></a>
            
    <?php
    else:
    ?>
       
        <a href="<?php echo $image_url?>" itemprop="image" title="<?php echo $image_title?>" class="cloud-zoom" id='zoom1' rel="adjustX: -1, adjustY:-1, tint:'#ffffff',tintOpacity:0.1, zoomWidth:360"><img id="image" src="<?php echo $image_url?>" alt="<?php echo $image_title?>" /></a>
          
            
    <?php	
    endif;
    ?>	
    
    <?php if(!empty($attach_id)):?>
    
    <div class="zoom-b hidden-phone">
        <a id="zoom-cb" class="colorbox cboxElement" href="<?php echo $image_url?>">Zoom</a>
    </div>
    <?php endif;?>
    
</div>
<div class="image-additional">
	
	<?php do_action('woocommerce_product_thumbnails'); ?>

</div>