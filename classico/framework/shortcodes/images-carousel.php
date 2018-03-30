<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Images Carousel
// **********************************************************************// 

function vc_theme_vc_images_carousel($atts, $content) {
	$output = $title = $onclick = $custom_links = $img_size = $custom_links_target = $images = $el_class = $partial_view = '';
	$mode = $slides_per_view = $wrap = $autoplay = $hide_pagination_control = $hide_prev_next_buttons = $speed = '';
	extract( shortcode_atts( array(
		'title' => '',
		'onclick' => 'link_image',
		'custom_links' => '',
		'custom_links_target' => '',
		'img_size' => 'thumbnail',
		'images' => '',
		'el_class' => '',
		'mode' => 'horizontal',
		'slides_per_view' => '1',
		'wrap' => '',
		'autoplay' => '',
		'hide_pagination_control' => '',
		'hide_prev_next_buttons' => '',
		'speed' => '5000',
		'partial_view' => ''
	), $atts ) );
	$gal_images = '';
	$link_start = '';
	$link_end = '';
	$el_start = '';
	$el_end = '';
	$slides_wrap_start = '';
	$slides_wrap_end = '';
	$pretty_rand = $onclick == 'link_image' ? rand() : '';
	
	if ( $images == '' ) $images = '-1,-2,-3';
	
	if ( $onclick == 'custom_link' ) {
		$custom_links = explode( ',', $custom_links );
	}
	
	$images = explode( ',', $images );
	$i = - 1;
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_images_carousel wpb_content_element' . $el_class . ' vc_clearfix', 'vc_images_carousel', $atts );
	$carousel_id = rand(1000,9999);
	?>
	<div class="<?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, 'vc_images_carousel', $atts ) ?>">
		<div id="carousel-<?php echo $carousel_id ?>">
			<!-- Wrapper for slides -->
			<div class="owl-images-carousel">
				<?php foreach ( $images as $attach_id ): ?>
					<?php
					$i ++;
					if ( $attach_id > 0 ) {
						$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ) );
					} else {
						$post_thumbnail = array();
						$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
						$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
					}
					$thumbnail = $post_thumbnail['thumbnail'];
					?>
					<div class="image-item">
						<?php if ( $onclick == 'link_image' ): ?>
						<?php $p_img_large = $post_thumbnail['p_img_large']; ?>
							<a class="magnific"
							   href="<?php echo $p_img_large[0] ?>" <?php echo ' rel="magnific[rel-' . $pretty_rand . ']"' ?>>
								<?php echo $thumbnail ?>
							</a>
						<?php elseif ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ): ?>
							<a
							  href="<?php echo $custom_links[$i] ?>"<?php echo ( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) ?>>
								<?php echo $thumbnail ?>
							</a>
						<?php else: ?>
							<?php echo $thumbnail ?>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
			
		</div>
	</div>
    <script type="text/javascript">
        jQuery("#carousel-<?php echo $carousel_id ?> .owl-images-carousel").owlCarousel({
            items:<?php echo $slides_per_view ?>, 
            lazyLoad : true,
            autoPlay: <?php echo $autoplay == 'yes' ? $speed : 'false'; ?>,
            navigation: <?php echo ( $hide_prev_next_buttons !== 'yes' ) ? 'true' : 'false' ; ?>,
            pagination: <?php echo ( $hide_pagination_control !== 'yes' ) ? 'true' : 'false' ; ?>,
            navigationText:false,
            rewindNav: <?php echo ( $autoplay == 'yes' ) ? 'true' : 'false' ; ?>,
            itemsCustom: [[0, 1], [479,1], [619,<?php echo $slides_per_view ?>], [768,<?php echo $slides_per_view ?>],  [1200, <?php echo $slides_per_view ?>], [1600, <?php echo $slides_per_view ?>]]
        });
		jQuery(document).ready(function() {
			jQuery("#carousel-<?php echo $carousel_id ?> a.magnific").magnificPopup({
		        type:"image",
		        gallery:{
		            enabled:true
		        }
		    });
		});
	</script>
<?php
}

// **********************************************************************// 
// ! Chane Element: Images Carousel
// **********************************************************************//
add_action( 'init', 'et_register_vc_images_carousel');
if(!function_exists('et_register_vc_images_carousel')) {
	function et_register_vc_images_carousel() {
		if(!function_exists('vc_map')) return;
		vc_remove_param( 'vc_images_carousel', 'mode' );
		vc_remove_param( 'vc_images_carousel', 'partial_view' );
	}
}
