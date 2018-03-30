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

global $post, $woocommerce, $product,$g5plus_options;
$single_product_show_image_thumb = isset($g5plus_options['single_product_show_image_thumb']) ? $g5plus_options['single_product_show_image_thumb'] : 0;

$index = 0;
$product_images = array();
$image_ids = array();

if (has_post_thumbnail()) {
	$product_images[$index] = array(
		'image_id' => get_post_thumbnail_id()
	);
	$image_ids[$index] = get_post_thumbnail_id();
	$index++;
}


// Additional Images
$attachment_ids = $product->get_gallery_attachment_ids();
if ($attachment_ids) {
	foreach ( $attachment_ids as $attachment_id ) {
		if (in_array($attachment_id,$image_ids)) continue;
		$product_images[$index] = array(
			'image_id' => $attachment_id
		);
		$image_ids[$index] = $attachment_id;
		$index++;
	}
}


if ($product->product_type == 'variable') {
	$available_variations = $product->get_available_variations();
	if (isset($available_variations)){
		foreach ($available_variations as $available_variation){
			$variation_id = $available_variation['variation_id'];
			if (has_post_thumbnail($variation_id)) {
				$variation_image_id = get_post_thumbnail_id($variation_id);

				if (in_array($variation_image_id,$image_ids)) {
					$index_of = array_search($variation_image_id, $image_ids);
					if (isset($product_images[$index_of]['variation_id'])) {
						$product_images[$index_of]['variation_id'] .= $variation_id . '|';
					} else {
						$product_images[$index_of]['variation_id'] = '|' . $variation_id . '|';
					}
					continue;
				}

				$product_images[$index] = array(
					'image_id' => $variation_image_id,
					'variation_id' => '|' . $variation_id . '|'
				);
				$image_ids[$index] = $variation_image_id;
				$index++;
			}
		}
	}
}
$attachment_count = count($attachment_ids);
if ( $attachment_count > 0 ) {
    $gallery = '[product-gallery]';
} else {
    $gallery = '';
}

$product_images_thumb = array('product-thumb-wrap');
$product_images_thumb[] = 'product-image-total-' . $index;
if ($single_product_show_image_thumb == 0) {
	$product_images_thumb[] = 'product-thumb-disable';
}
?>

<div class="single-product-image-inner">
    <div id="sync1" class="owl-carousel manual">

	    <?php
	    foreach($product_images as $key => $value) {
		    $index = $key;
		    $image_id = $value['image_id'];
		    $variation_id = isset($value['variation_id']) ? $value['variation_id'] : '' ;
		    $image_title 	= esc_attr( get_the_title( $image_id ) );
		    $image_caption = '';
		    $image_obj = get_post( $image_id );
		    if (isset($image_obj) && isset($image_obj->post_excerpt)) {
			    $image_caption 	= $image_obj->post_excerpt;
		    }
		    $image_link  	= wp_get_attachment_url( $image_id );
		    $image       	= wp_get_attachment_image( $image_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
			    'title'	=> $image_title,
			    'alt'	=> $image_title
		    ) );
		    echo '<div>';
		    if (!empty($variation_id)) {
			    echo  apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image" title="%s" data-rel="prettyPhoto' . $gallery . '" data-variation_id="%s" data-index="%s">%s</a>', $image_link, $image_caption,$variation_id,$index, $image ), $post->ID );
		    } else {
			    echo  apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image" title="%s" data-rel="prettyPhoto' . $gallery . '" data-index="%s">%s</a>', $image_link, $image_caption,$index, $image ), $post->ID );
		    }
		    echo '</div>';
	    }

	    ?>

    </div>
	<div class="<?php echo join(' ',$product_images_thumb); ?>">
		<div id="sync2" class="owl-carousel manual">
			<?php
			foreach($product_images as $key => $value) {
				$index = $key;
				$image_id = $value['image_id'];
				$variation_id = isset($value['variation_id']) ? $value['variation_id'] : '' ;
				$image_title 	= esc_attr( get_the_title( $image_id ) );
				$image_caption = '';
				$image_obj = get_post( $image_id );
				if (isset($image_obj) && isset($image_obj->post_excerpt)) {
					$image_caption 	= $image_obj->post_excerpt;
				}


				$image_link  	= wp_get_attachment_url( $image_id );
				$image       	= wp_get_attachment_image( $image_id,  apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), array(
					'title'	=> $image_title,
					'alt'	=> $image_title
				) );
				echo '<div class="thumbnail-image">';
				if (!empty($variation_id)) {
					echo  apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-thumbnail-image" title="%s" data-variation_id="%s" data-index="%s">%s</a>', $image_link, $image_caption,$variation_id,$index,  $image ), $post->ID );
				} else {
					echo  apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-thumbnail-image" title="%s" data-index="%s">%s</a>', $image_link, $image_caption,$index , $image), $post->ID );
				}
				echo '</div>';
			}

			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	(function($) {
		"use strict";
		$(document).ready(function() {

			var sync1 = $("#sync1",".single-product-image-inner");
			var sync2 = $("#sync2",".single-product-image-inner");
			sync1.owlCarousel({
				singleItem : true,
				slideSpeed : 100,
				navigation: true,
				pagination:false,
				navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
				afterAction : syncPosition,
				responsiveRefreshRate : 200
			});

			sync2.owlCarousel({
				items : 4,
				itemsDesktop: [1199, 4],
				itemsDesktopSmall: [980, 3],
				itemsTablet: [768, 3],
				itemsTabletSmall: false,
				itemsMobile: [479, 2],
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
					.addClass("synced");
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
				console.log(sync2.data("owlCarousel"));
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
					var index = parseInt($('a[data-variation_id*="|'+variation_id+'|"]','#sync1').data('index'),10) ;
					if (!isNaN(index) ) {
						sync1.trigger("owl.goTo",index);
					}
				}
			});

		});
	})(jQuery);
</script>
