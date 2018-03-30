<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

$index = 0;
$attachment_ids = $product->get_gallery_attachment_ids();
if ($product->product_type == 'variable') {
    $available_variations = $product->get_available_variations();
    $selected_attributes = $product->get_variation_default_attributes();
}

$attachment_count = count($attachment_ids);
if ( $attachment_count > 0 ) {
    $gallery = '[product-gallery]';
} else {
    $gallery = '';
}
?>

<div class="single-product-image-wrapper">
    <div id="sync1" class="owl-carousel manual">
       <?php
           if (has_post_thumbnail()) {
               $image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
               $image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
               $image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
               $image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                   'title'	=> $image_title,
                   'alt'	=> $image_title
               ) );


               echo '<div>';
               echo  apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '" data-index="%s">%s</a>', $image_link, $image_caption,$index, $image ), $post->ID );
               echo '</div>';
               $index++;
           }

           if (isset($available_variations)){
               foreach ($available_variations as $available_variation){
                   $variation_id = $available_variation['variation_id'];
                   if (has_post_thumbnail($variation_id)) {
                       $image_title 	= esc_attr( get_the_title( $variation_id ) );
                       $image_caption 	= get_post( $variation_id )->post_excerpt;
                       $image_link  	= wp_get_attachment_url(get_post_thumbnail_id($variation_id));
                       $image       	= get_the_post_thumbnail( $variation_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                           'title'	=> $image_title,
                           'alt'	=> $image_title
                       ) );

                       echo '<div>';
                       echo  apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '" data-variation_id="%s" data-index="%s">%s</a>', $image_link, $image_caption,$variation_id,$index, $image ), $post->ID );
                       echo '</div>';
                       $index++;
                   }
               }
           }

           if($attachment_ids) {
               foreach ( $attachment_ids as $attachment_id ) {
                   $image_link = wp_get_attachment_url( $attachment_id );
                   if ( ! $image_link ) {
                       continue;
                   }

                   $image_title 	= esc_attr( get_the_title( $attachment_id ) );
                   $image_caption 	= get_post( $attachment_id )->post_excerpt;

                   $image       	= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                       'title'	=> $image_title,
                       'alt'	=> $image_title
                   ) );

                   echo '<div>';
                   echo  apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '" data-index="%s">%s</a>', $image_link, $image_caption,$index, $image ), $post->ID );
                   echo '</div>';
                   $index++;

               }
           }
       ?>
    </div>
    <div class="single-product-thumb-wrap product-image-total-<?php echo esc_attr($index);?>">
        <?php do_action( 'woocommerce_product_thumbnails' ); ?>
    </div>
</div>

<script type="text/javascript">
    (function($) {
        "use strict";
        $(document).ready(function() {

            var sync1 = $("#sync1",".single-product-image-wrapper");
            var sync2 = $("#sync2",".single-product-image-wrapper");

            sync1.owlCarousel({
                singleItem : true,
                slideSpeed : 100,
                navigation: false,
                navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                pagination:false,
                afterAction : syncPosition,
                responsiveRefreshRate : 200
            });

            sync2.owlCarousel({
                items : 6,
                itemsDesktop: [1199, 6],
                itemsDesktopSmall: [980, 6],
                itemsTablet: [768, 4],
                itemsTabletSmall: false,
                itemsMobile: [479, 1],
                pagination:false,
                responsiveRefreshRate : 100,
                navigation: false,
                navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                afterInit : function(el){
                    el.find(".owl-item").eq(0).addClass("synced");
                }
            });

            function syncPosition(el){
                var current = this.currentItem;
                $("#sync2")
                    .find(".owl-item")
                    .removeClass("synced")
                    .eq(current)
                    .addClass("synced")
                if($("#sync2").data("owlCarousel") !== undefined){
                    center(current);
                }
            }

            $("#sync2").on("click", ".owl-item", function(e){
                e.preventDefault();
                var number = $(this).data("owlItem");
                sync1.trigger("owl.goTo",number);
            });

            function center(number){
                var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
                var num = number;
                var found = false;
                for(var i in sync2visible){
                    if(num === sync2visible[i]){
                        var found = true;
                    }
                }

                if(found===false){
                    if(num>sync2visible[sync2visible.length-1]){
                        sync2.trigger("owl.goTo", num - sync2visible.length+2)
                    }else{
                        if(num - 1 === -1){
                            num = 0;
                        }
                        sync2.trigger("owl.goTo", num);
                    }
                } else if(num === sync2visible[sync2visible.length-1]){
                    sync2.trigger("owl.goTo", sync2visible[1])
                } else if(num === sync2visible[0]){
                    sync2.trigger("owl.goTo", num-1)
                }
            }

            $(document).on('change','.variations_form .variations select,.variations_form .variation_form_section select,div.select',function(){
                var variation_form = $(this).closest( '.variations_form' );
                var current_settings = {},
                    reset_variations = variation_form.find( '.reset_variations' );
                variation_form.find('.variations select,.variation_form_section select' ).each( function() {
                    // Encode entities
                    var value = $(this ).val();

                    // Add to settings array
                    current_settings[ $( this ).attr( 'name' ) ] = jQuery(this ).val();
                });

                variation_form.find('.variation_form_section div.select input[type="hidden"]' ).each( function() {
                    // Encode entities
                    var value = $(this ).val();

                    // Add to settings array
                    current_settings[ $( this ).attr( 'name' ) ] = jQuery(this ).val();
                });

                var all_variations = variation_form.data( 'product_variations' );

                var variation_id = 0;
                var match = true;

                for (var i = 0; i < all_variations.length; i++)
                {
                    match = true;
                    var variations_attributes = all_variations[i]['attributes'];
                    for(var attr_name in variations_attributes) {
                        var val1 = variations_attributes[attr_name];
                        var val2 = current_settings[attr_name];
                        if (val1 == undefined || val2 == undefined ) {
                            match = false;
                            break;
                        }
                        if (val1.length == 0) {
                            continue;
                        }

                        if (val1 != val2) {
                            match = false;
                            break;
                        }
                    }
                    if (match) {
                        variation_id = all_variations[i]['variation_id'];
                        break;
                    }
                }

                if (variation_id > 0) {
                    var index = parseInt($('a[data-variation_id="'+variation_id+'"]','#sync1').data('index'),10) ;
                    if (!isNaN(index) ) {
                        sync1.trigger("owl.goTo",index);
                    }
                }
            });
        });
    })(jQuery);
</script>