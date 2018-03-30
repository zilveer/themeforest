<?php
/**
 * @var $this WPBakeryShortCode_VC_images_carousel
 */
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
$pretty_rand = $onclick == 'link_image' ? ' rel="prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']"' : '';

wp_enqueue_script( 'vc_carousel_js' );
wp_enqueue_style( 'vc_carousel_css' );
if ( $onclick == 'link_image' ) {
	wp_enqueue_script( 'prettyphoto' );
	wp_enqueue_style( 'prettyphoto' );
}

$el_class = $this->getExtraClass( $el_class );

if ( $images == '' ) {
	$images = '-1,-2,-3';
}

if ( $onclick == 'custom_link' ) {
	$custom_links = explode( ',', $custom_links );
}

$images = explode( ',', $images );
$i = - 1;
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_images_carousel wpb_content_element' . $el_class . ' vc_clearfix', $this->settings['base'], $atts );
$carousel_id = 'vc_images-carousel-' . WPBakeryShortCode_VC_images_carousel::getCarouselIndex();
$slider_width = $this->getSliderWidth( $img_size );
?>



<style type="text/css">
	.wpb_images_carousel .vc_images_carousel .vc_carousel-control span{
		display:none;
	}
	.wpb_images_carousel .vc_images_carousel .vc_carousel-control:hover{
	  opacity: 1;
	  filter: alpha(opacity=100);	
	}
	.wpb_images_carousel .vc_images_carousel .vc_carousel-control:before {
	  font-family: "fontello";
	  font-style: normal;
	  font-weight: normal;
	  speak: none;
	  display: inline-block;
	  text-decoration: inherit;
	  margin-right: .2em;
	  text-align: center;
	  font-variant: normal;
	  text-transform: none;
	  line-height: 1em;
	  margin-left: .2em;
	  color: #fff;
	  font-size: 24px;
	  position: absolute;
	  left: 50%;
	}
	.wpb_images_carousel .vc_images_carousel .vc_left.vc_carousel-control:before {
	  content: '\e890';
	  margin-left: -6px;
	}
	.wpb_images_carousel .vc_images_carousel .vc_right.vc_carousel-control:before {
	  content: '\e891';
	  margin-left: -3px;
	}
	.wpb_images_carousel .vc_images_carousel .vc_carousel-control {
	  position: absolute;
	  vertical-align: middle;
      padding-top: 12px;
	  top: 50%;
	  bottom: 0;
	  margin-top: -23px;
	  width: 45px;
	  height: 45px;
	  z-index: 10;
	  opacity: 0;
	  filter: alpha(opacity=0);
	  font-size: 30px;
	  text-align: center;
	  text-shadow: none;
	  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	  color: rgba(0,0,0,0.8);
	  background: #000;
	  background: rgba(0,0,0,0.6);
	-webkit-transition: all .3s ease;
	-moz-transition: all .3s ease;
	transition: all .3s ease;
	border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
	}
	.wpb_images_carousel .vc_images_carousel .vc_left.vc_carousel-control{
	left: 0;
	display:block !important;	
	}
	.wpb_images_carousel .vc_images_carousel:hover .vc_left.vc_carousel-control{
	left: 20px;
	opacity: 1;
	filter: alpha(opacity=100);	
	}
	.wpb_images_carousel .vc_images_carousel .vc_right.vc_carousel-control{
	right: 0;	
	}
	.wpb_images_carousel .vc_images_carousel:hover .vc_right.vc_carousel-control{
	right: 20px;
	opacity: 1;
	filter: alpha(opacity=100);	
	}
	
</style>




<div
	class="<?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $atts ) ?>">
	<div class="wpb_wrapper">
<?php echo wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_gallery_heading' ) ) ?>
	<div id="<?php echo $carousel_id ?>" data-ride="vc_carousel"
	     data-wrap="<?php echo $wrap === 'yes' ? 'true' : 'false' ?>" style="width: <?php echo $slider_width ?>;"
	     data-interval="<?php echo $autoplay == 'yes' ? $speed : 0 ?>" data-auto-height="yes"
	     data-mode="<?php echo $mode ?>" data-partial="<?php echo $partial_view === 'yes' ? 'true' : 'false' ?>"
	     data-per-view="<?php echo $slides_per_view ?>"
	     data-hide-on-end="<?php echo $autoplay == 'yes' ? 'false' : 'true' ?>" class="vc_slide vc_images_carousel">
		<?php if ( $hide_pagination_control !== 'yes' ): ?>
			<!-- Indicators -->
			<ol class="vc_carousel-indicators">
				<?php for ( $z = 0; $z < count( $images ); $z ++ ): ?>
					<li data-target="#<?php echo $carousel_id ?>" data-slide-to="<?php echo $z ?>"></li>
				<?php endfor; ?>
			</ol>
		<?php endif; ?>
		<!-- Wrapper for slides -->
		<div class="vc_carousel-inner">
			<div class="vc_carousel-slideline">
				<div class="vc_carousel-slideline-inner">
					<?php foreach ( $images as $attach_id ): ?>
						<?php
						$i ++;
						if ( $attach_id > 0 ) {
							$post_thumbnail = wpb_getImageBySize( array(
								'attach_id' => $attach_id,
								'thumb_size' => $img_size
							) );
						} else {
							$post_thumbnail = array();
							$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
							$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
						}
						$thumbnail = $post_thumbnail['thumbnail'];
						?>
						<div class="vc_item">
							<div class="vc_inner">
								<?php if ( $onclick == 'link_image' ): ?>
									<?php $p_img_large = $post_thumbnail['p_img_large']; ?>
									<a class="prettyphoto"
									   href="<?php echo $p_img_large[0] ?>" <?php echo $pretty_rand; ?>>
										<?php echo $thumbnail ?>
									</a>
								<?php elseif ( $onclick == 'custom_link' && isset( $custom_links[ $i ] ) && $custom_links[ $i ] != '' ): ?>
									<a
										href="<?php echo $custom_links[ $i ] ?>"<?php echo( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) ?>>
										<?php echo $thumbnail ?>
									</a>
								<?php else: ?>
									<?php echo $thumbnail ?>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php if ( $hide_prev_next_buttons !== 'yes' ): ?>
			<!-- Controls -->
			<a class="vc_left vc_carousel-control" href="#<?php echo $carousel_id ?>" data-slide="prev">
				<span class="icon-prev"></span>
			</a>
			<a class="vc_right vc_carousel-control" href="#<?php echo $carousel_id ?>" data-slide="next">
				<span class="icon-next"></span>
			</a>
		<?php endif; ?>
	</div>
	</div><?php echo $this->endBlockComment( '.wpb_wrapper' ) ?>
	</div><?php echo $this->endBlockComment( '.wpb_images_carousel' ) ?>