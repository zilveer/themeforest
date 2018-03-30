<?php if(! defined('ABSPATH')){ return; }
/*
Name: Fancy Slider
Description: Create and display a Fancy Slider element
Class: TH_FancySlider
Category: header, Fullwidth
Level: 1
Scripts: true
*/
/**
 * Class TH_FancySlider
 *
 * Create and display a Fancy Slider element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_FancySlider extends ZnElements
{
	public static function getName(){
		return __( "Fancy Slider", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js',  array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];

		$top_padding = $this->opt('top_padding');
		if($top_padding != '0'){
			$css .= '.'.$uid.' .kl-slideshow-inner{padding-top : '.$top_padding.'px;}';
		}

		$bottom_padding = $this->opt('bottom_padding');
		if($bottom_padding != '0'){
			$css .= '.'.$uid.' .kl-slideshow-inner{padding-bottom:'.$bottom_padding.'px;}';
		}

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];
		if( empty( $options ) ) { return; }

		$bottom_mask = $this->opt('hm_header_bmasks','shadow_ud');
		$bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

		$navpos = $this->opt('ww_slider_controlpos','controls-inside');
		?>
		<div class="kl-slideshow fancyslider__slideshow <?php echo $this->data['uid']; ?> <?php echo $bm_class; ?> <?php echo zn_get_element_classes($this->data['options']); ?>">

			<div class="fake-loading loading-2s"></div>

			<div class="container kl-slideshow-inner">
				<div class="row">
					<div class="col-sm-12">
						<div class="zn_fancy_slider_container <?php echo (!empty($navpos) ? 'controls-inside':''); ?>">
							<ul class="zn_general_carousel cfs--default" data-fancy="true" data-transition="slide" data-autoplay="<?php echo $this->opt('ww_slider_autoplay') == 1 ? 1:0 ; ?>" data-timout="<?php echo $this->opt('ww_slider_timeout', 9000) ?>" data-easing="easeOutExpo">
								<?php
									if ( isset ( $options['single_fancy'] ) && is_array( $options['single_fancy'] ) ) {
										foreach ( $options['single_fancy'] as $slide ) {

											$ww_slide_link = zn_extract_link( $slide['ww_slide_link'], 'zn_fancy_slider-link' );

											echo '<li class="zn_fancy_slider-item cfs--item" data-color="' . $slide['ww_slide_color'] . '">';

											echo $ww_slide_link['start'];

											if ( isset ( $slide['ww_slide_image'] ) && ! empty ( $slide['ww_slide_image'] ) ) {
												echo '<img class="zn_fancy_slider-itemimg cover-fit-img img-responsive" src="'.$slide['ww_slide_image'].'" '.ZngetImageSizesFromUrl($slide['ww_slide_image'], true).' alt="'. ZngetImageAltFromUrl( $slide['ww_slide_image'] ) .'" title="'.ZngetImageTitleFromUrl( $slide['ww_slide_image'] ).'"/>';
											}
											echo $ww_slide_link['end'];

											echo '</li>';
										}
									}
								?>
							</ul>

							<?php
							$navtype =  $this->opt('ww_slider_nav', 'nav');
							if( $navtype == 'nav' ){ ?>
							<div class="zn_fancy_carousel-nav ">
								<span class="zn_fancy_carousel-prev cfs--prev">
									<span class="glyphicon glyphicon-chevron-down"></span>
								</span>
								<span class="zn_fancy_carousel-next cfs--next">
									<span class="glyphicon glyphicon-chevron-up"></span>
								</span>
							</div>
							<?php
							}
							elseif( $navtype == 'bullets' ) { ?>
							<div class="zn_fancy_carousel-pagi cfs--pagination"></div>
							<?php } ?>

						</div><!-- /.zn_fancy_slider_container -->
					</div>
				</div>
			</div>
			<?php
				zn_bottommask_markup($bottom_mask, $this->opt('hm_header_bmasks_bg',''));
			?>
		</div><!-- end kl-slideshow -->
		<?php
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$extra_options = array (
			"name"           => __( "Slides", 'zn_framework' ),
			"description"    => __( "Here you can create your Fancy Slider Slides.", 'zn_framework' ),
			"id"             => "single_fancy",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Slide", 'zn_framework' ),
			"remove_text"    => __( "Slide", 'zn_framework' ),
			"group_sortable" => true,
			"subelements"    => array (
				array (
					"name"        => __( "Slide image", 'zn_framework' ),
					"description" => __( "Select an image for this Slide", 'zn_framework' ),
					"id"          => "ww_slide_image",
					"std"         => "",
					"type"        => "media",
					'class'		  => 'zn_full'
				),
				array (
					"name"        => __( "Slide link", 'zn_framework' ),
					"description" => __( "Here you can add a link to your slide", 'zn_framework' ),
					"id"          => "ww_slide_link",
					"std"         => "",
					"type"        => "link",
					"options"     => zn_get_link_targets(),
				),
				array (
					"name"        => __( "Slide Color", 'zn_framework' ),
					"description" => __( "Here you can choose a color for this slide.", 'zn_framework' ),
					"id"          => "ww_slide_color",
					"std"         => '#699100',
					"type"        => "colorpicker"
				)
			)
		);
		return array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					// array (
					// 	"name"        => __( "Slides Height", 'zn_framework' ),
					// 	"description" => __( "Add a general height for the slides in px.", 'zn_framework' ),
					// 	"id"          => "ww_slide_height",
					// 	"std"         => '600',
					// 	"type"        => "text"
					// ),

					array (
						"name"        => __( "Autoplay carousel?", 'zn_framework' ),
						"description" => __( "Does the carousel autoplay itself?", 'zn_framework' ),
						"id"          => "ww_slider_autoplay",
						"std"         => "1",
						"value"         => "1",
						"type"        => "toggle2"
					),
					array (
						"name"        => __( "Timout duration", 'zn_framework' ),
						"description" => __( "The amount of milliseconds the carousel will pause", 'zn_framework' ),
						"id"          => "ww_slider_timeout",
						"std"         => "9000",
						"type"        => "text"
					),

					array (
						"name"        => __( "Choose Navigation type", 'zn_framework' ),
						"description" => __( "Choose either arrows or bullets", 'zn_framework' ),
						"id"          => "ww_slider_nav",
						"std"         => "nav",
						"type"         => "select",
						"options"     => array (
							'none' => __( 'None', 'zn_framework' ),
							'nav' => __( 'Arrows navigation', 'zn_framework' ),
							'bullets' => __( 'Bullets', 'zn_framework' ),
						),
					),

					array (
						"name"        => __( "Move the controls inside?", 'zn_framework' ),
						"description" => __( "The option will reposition the controls (arrows or bullets) inside or outside the slider.", 'zn_framework' ),
						"id"          => "ww_slider_controlpos",
						"std"         => "controls-inside",
						"value"         => "controls-inside",
						"type"        => "toggle2",
						'live' => array(
						   'type'           => 'class',
						   'css_class'      => '.'.$this->data['uid'].' .zn_fancy_slider_container',
						),
					),

					// Bottom masks overrides
					array (
						"name"        => __( "Bottom masks override", 'zn_framework' ),
						"description" => __( "The new masks are svg based, vectorial and color adapted.", 'zn_framework' ),
						"id"          => "hm_header_bmasks",
						"std"         => "shadow_ud",
						"type"        => "select",
						"options"     => zn_get_bottom_masks(),
					),

					array(
						'id'          => 'hm_header_bmasks_bg',
						'name'        => 'Bottom Mask Background Color',
						'description' => 'If you need the mask to have a different color than the main site background, please choose the color. Usually this color is needed when the next section, under this one has a different background color.',
						'type'        => 'colorpicker',
						'std'         => '',
						"dependency"  => array( 'element' => 'hm_header_bmasks' , 'value'=> array('mask3', 'mask3 mask3l', 'mask3 mask3r', 'mask4', 'mask4 mask4l', 'mask4 mask4r', 'mask5', 'mask6') ),
					),

					array(
						'id'          => 'top_padding',
						'name'        => 'Top padding',
						'description' => 'Select the top padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'].' .kl-slideshow-inner',
							'css_rule'	=> 'padding-top',
							'unit'		=> 'px'
						)
					),
					array(
						'id'          => 'bottom_padding',
						'name'        => 'Bottom padding',
						'description' => 'Select the bottom padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'].' .kl-slideshow-inner',
							'css_rule'	=> 'padding-bottom',
							'unit'		=> 'px'
						)
					),
				)
			),

			'slides' => array(
				'title' => 'Add slides',
				'options' => array(
					$extra_options
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#IGvmfvu5K-0',
				'docs'    => 'http://support.hogash.com/documentation/fancy-slider/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
	}
}
