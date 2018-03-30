<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

$image_count = 0;

if ( has_post_thumbnail() ) {
    $image_count++;
}

foreach ( $attachment_ids as $attachment_id ) {
    $image_link = wp_get_attachment_url( $attachment_id );
    if ( ! $image_link )
        continue;
    $image_count++;
}

if ( $image_count ) {
    
    $lightbox = ' data-lightbox="lightboxgroup-' . $product->id . '"';
    
	?>
	<div class="thumbnails"><div>
        <ul id="thumbnails-slider-<?php echo $product->id ?>"<?php if ($image_count > 4) echo ' class="elastislide-images"'; else echo ' class="normal-images"'; ?>>
    
            <?php

            if ( has_post_thumbnail() ) {

                $image_link = wp_get_attachment_url( get_post_thumbnail_id() );

                if ( $image_link ) {
                    $classes = array();
                    $classes[] = 'elevatezoom-gallery';

                    $image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
                    $image = preg_replace('/ srcset="(.+?)"(.+?)/i', "$2", $image);
                    $image_class = esc_attr( implode( ' ', $classes ) );
                    $image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );

                    echo '<li>';

                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html',
                        sprintf( '<a href="#" class="%s" data-image="%s" data-zoom-image="%s" title="%s">%s</a>',
                            $image_class, $image_link, $image_link, $image_title, $image ),
                        get_post_thumbnail_id(), $post->ID, $image_class );

                    echo '</li>';
                }

            }
            
		    foreach ( $attachment_ids as $attachment_id ) {

			    $image_link = wp_get_attachment_url( $attachment_id );
                
			    if ( ! $image_link )
				    continue;
                
                $classes = array();
                $classes[] = 'elevatezoom-gallery';    
                
			    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
                $image = preg_replace('/ srcset="(.+?)"(.+?)/i', "$2", $image);
			    $image_class = esc_attr( implode( ' ', $classes ) );
			    $image_title = esc_attr( get_the_title( $attachment_id ) );
                                
                echo '<li>';
                
                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="#" class="%s" data-image="%s" data-zoom-image="%s" title="%s">%s</a>', $image_class, $image_link, $image_link, $image_title, $image ), $attachment_id, $post->ID, $image_class );
                
                echo '</li>';
		    }

	        ?>
            
        </ul>
    </div></div>
	<?php
}

?>
<?php
global $venedor_quickview;

if (!isset($venedor_quickview)) :
?>

<script type="text/javascript">
jQuery(function($) {
    var image_es;
    var zoom_timer;
    var win_width = 0;
        
    function resize_venedor_thumbs() {
        if (win_width != $(window).width()) {
        <?php if ($image_count > 4) : ?>
            if (image_es) {
                image_es.destroy();
            }
            image_es = $('#thumbnails-slider-<?php echo $product->id ?>').elastislide({
                orientation : 'vertical',
                minItems: 4
            });
        <?php endif; ?>
            win_width = $(window).width();
        }
        if (zoom_timer) clearTimeout(zoom_timer);
    }
    $(window).load(resize_venedor_thumbs);
    $(window).resize(function() {
        clearTimeout(zoom_timer);
        zoom_timer = setTimeout(resize_venedor_thumbs, 400);
    });
});
</script>
<?php endif; ?>