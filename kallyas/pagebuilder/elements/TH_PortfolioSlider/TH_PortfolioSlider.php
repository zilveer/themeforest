<?php if(! defined('ABSPATH')){ return; }
/*
Name: Portfolio Slider
Description: Create and display a Portfolio Slider element
Class: TH_PortfolioSlider
Category: header, Fullwidth
Level: 1
Scripts: true
Keywords: project
*/
/**
 * Class TH_PortfolioSlider
 *
 * Create and display a Portfolio Slider element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_PortfolioSlider extends ZnElements
{
	public static function getName(){
		return __( "Portfolio Slider", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$scheight = (int)$this->opt('ww_height','');
		$fullscreen = $this->opt('psl_fullscreen',0);

		if($fullscreen != 1){
			if(!empty($scheight) && $scheight != 600){
				$css = '@media only screen and (min-width : 1200px){ .'.$this->data['uid'].' .psl--height { height:'.$scheight.'px;} } ';
			}
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

		$title = '';

		$style = $this->opt('ps_header_style', '');
		if ( ! empty ( $style ) ) {
			$style = 'uh_' . $style;
		}

		$hclass = 'psl--'.strtolower( $this->opt('ps_sliding_direction', 'Vertical') );

		$bottom_mask = $this->opt('hm_header_bmasks','none');
		$bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

		?>

		<div class="kl-slideshow portfolio-slider__sideshow gradient <?php echo $style; ?> <?php echo $bm_class ?> <?php echo $this->data['uid']; ?> <?php echo zn_get_element_classes($this->data['options']); ?>">

			<div class="fake-loading loading-1s"></div>

			<div class="bgback"></div>

			<div class="kl-slideshow-inner portfolio-slider-frames psl__wrapper <?php echo $hclass;?> <?php echo ( $this->opt('psl_fullscreen', '0') == 1 ? 'psl--fullscreen' : '' ); ?> <?php echo ( (int)$this->opt('ww_height') ? 'psl--height':'' ) ?>">

				<?php
					WpkPageHelper::zn_background_source( array(
						'source_type' => $this->opt('source_type'),
						'source_background_image' => $this->opt('background_image'),
						'source_vd_yt' => $this->opt('source_vd_yt'),
						'source_vd_vm' => $this->opt('source_vd_vm'),
						'source_vd_self_mp4' => $this->opt('source_vd_self_mp4'),
						'source_vd_self_ogg' => $this->opt('source_vd_self_ogg'),
						'source_vd_self_webm' => $this->opt('source_vd_self_webm'),
						'source_vd_vp' => $this->opt('source_vd_vp'),
						'source_vd_autoplay' => $this->opt('source_vd_autoplay'),
						'source_vd_loop' => $this->opt('source_vd_loop'),
						'source_vd_muted' => $this->opt('source_vd_muted'),
						'source_vd_controls' => $this->opt('source_vd_controls'),
						'source_vd_controls_pos' => $this->opt('source_vd_controls_pos'),
						'source_overlay' => $this->opt('source_overlay'),
						'source_overlay_color' => $this->opt('source_overlay_color'),
						'source_overlay_opacity' => $this->opt('source_overlay_opacity'),
						'source_overlay_color_gradient' => $this->opt('source_overlay_color_gradient'),
						'source_overlay_color_gradient_opac' => $this->opt('source_overlay_color_gradient_opac'),
						'mobile_play' => $this->opt('mobile_play', 'no'),
						'enable_parallax' => $this->opt('ps_scrolling_effect',0 ) == 1 ? 'yes':'',
					) );
				?>
				<div class="th-sparkles"></div>

				<div class="psl__inner">

					<div class="kl-slideshow-safepadding psl__container">

						<?php

						if( $this->opt('ps_slider_title') || $this->opt('ps_slider_desc') ) {
							echo '<div class="container">';
							if($this->opt('ps_slider_title')) echo '<h3 class="psl__main-title" '.WpkPageHelper::zn_schema_markup('title').'>'.$this->opt('ps_slider_title').'</h3>';
							if($this->opt('ps_slider_desc')) echo '<h4 class="psl__main-desc">'.$this->opt('ps_slider_desc').'</h4>';
							echo '</div>';
						}
						?>

						<div class="psl-carousel__wrapper">
							<div class="psl-carousel__container">
								<?php
								if ( isset ( $options['single_pslides'] ) && is_array( $options['single_pslides'] ) ) {
									foreach ( $options['single_pslides'] as $k => $slide ) {

										echo '<div class="psl-carousel__item psl--item-'.$k.' '.($k == 0 ? 'psl--active-item':'').'" '.WpkPageHelper::zn_schema_markup('creative_work').'>';

										if ( isset ( $slide['ps_slide_title'] ) && ! empty ( $slide['ps_slide_title'] ) ) {
											$title = '<span class="psl__project_title">' . $slide['ps_slide_title'] . '</span>';
										}

										$ps_slide_link = zn_extract_link( $slide['ps_slide_link'], 'psl__project_url');

										// Right Image
										if ( isset ( $slide['ps_slide_image3'] ) && ! empty ( $slide['ps_slide_image3'] ) ) {
											echo '<div class="psl__img psl-img--right">';
											if( isset($slide['ps_slide_image3']) && !empty($slide['ps_slide_image3']) ){
												$sl_img3 = $slide['ps_slide_image3'];
												echo '<img class="psl__img-bg cover-fit-img" src="' . $sl_img3 . '" '.ZngetImageSizesFromUrl($sl_img3, true).' '.ZngetImageAltFromUrl($sl_img3, true).' '.ZngetImageTitleFromUrl($sl_img3, true).'>';
											}
											echo '</div>';
										}

										// Left Image
										if ( isset ( $slide['ps_slide_image2'] ) && ! empty ( $slide['ps_slide_image2'] ) ) {
											echo '<div class="psl__img psl-img--left">';
											if( isset($slide['ps_slide_image2']) && !empty($slide['ps_slide_image2']) ){
												$sl_img2 = $slide['ps_slide_image2'];
												echo '<img class="psl__img-bg cover-fit-img" src="' . $sl_img2 . '" '.ZngetImageSizesFromUrl($sl_img2, true).' '.ZngetImageAltFromUrl($sl_img2, true).' '.ZngetImageTitleFromUrl($sl_img2, true).'>';
											}
											echo '</div>';
										}

										// Front Image
										if ( isset ( $slide['ps_slide_image1'] ) && ! empty ( $slide['ps_slide_image1'] ) ) {
											echo '<div class="psl__img psl-img--front">';
												echo $title;
												echo $ps_slide_link['start'] . $ps_slide_link['end'];
											if( isset($slide['ps_slide_image1']) && !empty($slide['ps_slide_image1']) ){
												$sl_img1 = $slide['ps_slide_image1'];
												echo '<img class="psl__img-bg cover-fit-img" src="' . $sl_img1 . '" '.ZngetImageSizesFromUrl($sl_img1, true).' '.ZngetImageAltFromUrl($sl_img1, true).' '.ZngetImageTitleFromUrl($sl_img1, true).'>';
											}
											echo '</div>';
										}

										echo '<div class="clearfix"></div>';
										echo '</div>';
									}
								}
								?>
							</div>
							<a class="psl__prev" href="#"><span class="glyphicon glyphicon-chevron-left kl-icon-white"></span></a>
							<a class="psl__next" href="#"><span class="glyphicon glyphicon-chevron-right kl-icon-white"></span></a>
						</div>
						<!-- end Carousel wrapper -->

					</div><!-- /.psl__container -->
				</div><!-- /.psl__inner -->
			</div><!-- /.psl__wrapper -->

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
		$extra_options = array (
			"name"           => __( "Slides", 'zn_framework' ),
			"description"    => __( "Here you can create your Portfolio Slider Slides.", 'zn_framework' ),
			"id"             => "single_pslides",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Slide", 'zn_framework' ),
			"remove_text"    => __( "Slide", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "ps_slide_title",
			"subelements"    => array (
				array (
					"name"        => __( "Slide title", 'zn_framework' ),
					"description" => __( "This title will appear as browser title", 'zn_framework' ),
					"id"          => "ps_slide_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Slide link", 'zn_framework' ),
					"description" => __( "Here you can add a link to your slide", 'zn_framework' ),
					"id"          => "ps_slide_link",
					"std"         => "",
					"type"        => "link",
					"options"     => zn_get_link_targets(),
				),
				array (
					"name"        => __( "Front Image", 'zn_framework' ),
					"description" => __( "Select an image that will appear on front. Recommended size 500px x 360px", 'zn_framework' ),
					"id"          => "ps_slide_image1",
					"std"         => "",
					"type"        => "media"
				),
				array (
					"name"        => __( "Left Image", 'zn_framework' ),
					"description" => __( "Select an image that will appear on left. Recommended size 430px x 306px", 'zn_framework' ),
					"id"          => "ps_slide_image2",
					"std"         => "",
					"type"        => "media"
				),
				array (
					"name"        => __( "Right Image", 'zn_framework' ),
					"description" => __( "Select an image that will appear on right. Recommended size 430px x 306px", 'zn_framework' ),
					"id"          => "ps_slide_image3",
					"std"         => "",
					"type"        => "media"
				),
			)
		);

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Enable fullscreen?", 'zn_framework' ),
						"description" => __( "Do you want to display the static content as fullscreen?", 'zn_framework' ),
						"id"          => "psl_fullscreen",
						"std"         => "0",
						"type"        => "zn_radio",
						"options"     => array (
							'1'  => __( "Yes", 'zn_framework' ),
							'0' => __( "No", 'zn_framework' )
						),
						"class"        => "zn_radio--yesno",
					),

					array (
						"name"        => __( "Element Height", 'zn_framework' ),
						"description" => __( "<strong><em>Please read!</em></strong><br>Enter a numeric value for the slider height. This option works if Fullscreen is disabled. If you don't add any height, the height will be automatically rely on the content inside the element. ", 'zn_framework' ),
						"id"          => "ww_height",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "ex: 600px",
						"class"       => "zn_input_xs",
						'dependency' => array( 'element' => 'psl_fullscreen' , 'value'=> array('0') )
					),

					array (
						"name"        => __( "Slider Main Title", 'zn_framework' ),
						"description" => __( "Here you can enter a description that will appear above the slider.", 'zn_framework' ),
						"id"          => "ps_slider_title",
						"std"         => "",
						"type"        => "text",
						"class"       => ''
					),
					array (
						"name"        => __( "Slider Description", 'zn_framework' ),
						"description" => __( "Here you can enter a description that will appear above the slider.", 'zn_framework' ),
						"id"          => "ps_slider_desc",
						"std"         => "",
						"type"        => "textarea",
						"class"       => ''
					),
					array (
						"name"        => __( "Sliding Direction", 'zn_framework' ),
						"description" => __( "Select the desired sliding direction.", 'zn_framework' ),
						"id"          => "ps_sliding_direction",
						"std"         => "Vertical",
						"type"        => "select",
						"options"     => array (
							"Horizontal" => __( "Horizontal from right", 'zn_framework' ),
							"horizontal psl--left" => __( "Horizontal from left", 'zn_framework' ),
							"Vertical"   => __( "Vertical", 'zn_framework' )
						),
						"class"       => ""
					),

					array (
						"name"        => __( "Parallax scrolling effect?", 'zn_framework' ),
						"description" => __( "Choose if you want the slider to have a scrolling effect on the slider.<br> <strong style=' color: #9B4F4F;'>This options works only if the slider is positioned at the very top opf the page!!</strong>", 'zn_framework' ),
						"id"          => "ps_scrolling_effect",
						"std"         => "0",
						"type"        => "select",
						"options"     => array ( "1" => __( "Yes", 'zn_framework' ), "0" => __( "No", 'zn_framework' ) ),
						"class"       => "zn_input_xs"
					),

				)
			),

			'items' => array(
				'title' => 'Add Items',
				'options' => array(
					$extra_options,
				),
			),

			'background' => array(
				'title' => 'Background & Styles Options',
				'options' => array(

					array (
						"name"        => __( "Slider Background Style", 'zn_framework' ),
						"description" => __( "Select the background style you want to use for this slider. Please note that styles
							can be created from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
						"id"          => "ps_header_style",
						"std"         => "",
						"type"        => "select",
						"options"     => WpkZn::getThemeHeaders(true),
						"class"       => ""
					),

					// Background image/video or youtube
					array (
						"name"        => __( "Background Source Type", 'zn_framework' ),
						"description" => __( "Please select the source type of the background.", 'zn_framework' ),
						"id"          => "source_type",
						"std"         => "",
						"type"        => "select",
						"options"     => array (
							''  => __( "None (Will just rely on the background color (if any) )", 'zn_framework' ),
							'image'  => __( "Image", 'zn_framework' ),
							'video_self' => __( "Self Hosted Video", 'zn_framework' ),
							'video_youtube' => __( "Youtube Video", 'zn_framework' ),
							'video_vimeo' => __( "Vimeo Video", 'zn_framework' ),
						)
					),

					array(
						'id'          => 'background_image',
						'name'        => 'Background image',
						'description' => 'Please choose a background image for this section.',
						'type'        => 'background',
						'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
						'class'       => 'zn_full',
						'dependency' => array( 'element' => 'source_type' , 'value'=> array('image') )
					),

					// array(
					//  'id'            => 'enable_parallax',
					//  'name'          => 'Enable parallax',
					//  'description'   => 'Select if you want to enable parallax effect on background image',
					//  'type'          => 'toggle2',
					//  'std'           => '',
					//  'value'         => 'yes'
					// ),



					// Youtube video
					array (
						"name"        => __( "Youtube ID", 'zn_framework' ),
						"description" => __( "Add an Youtube ID", 'zn_framework' ),
						"id"          => "source_vd_yt",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "ex: tR-5AZF9zPI",
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_youtube') )
					),
					// Vimeo video
					array (
						"name"        => __( "Vimeo ID", 'zn_framework' ),
						"description" => __( "Add an Vimeo ID", 'zn_framework' ),
						"id"          => "source_vd_vm",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "ex: 2353562345",
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_vimeo') )
					),
					/* LOCAL VIDEO */
					array(
						'id'          => 'source_vd_self_mp4',
						'name'        => 'Mp4 video source',
						'description' => 'Add the MP4 video source for your local video',
						'type'        => 'media_upload',
						'std'         => '',
						'data'  => array(
							'type' => 'video/mp4',
							'button_title' => 'Add / Change mp4 video',
						),
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
					),
					array(
						'id'          => 'source_vd_self_ogg',
						'name'        => 'Ogg/Ogv video source',
						'description' => 'Add the OGG video source for your local video',
						'type'        => 'media_upload',
						'std'         => '',
						'data'  => array(
							'type' => 'video/ogg',
							'button_title' => 'Add / Change ogg video',
						),
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
					),
					array(
						'id'          => 'source_vd_self_webm',
						'name'        => 'Webm video source',
						'description' => 'Add the WEBM video source for your local video',
						'type'        => 'media_upload',
						'std'         => '',
						'data'  => array(
							'type' => 'video/webm',
							'button_title' => 'Add / Change webm video',
						),
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
					),
					array(
						'id'          => 'source_vd_vp',
						'name'        => 'Video poster',
						'description' => 'Using this option you can add your desired video poster that will be shown on unsuported devices.',
						'type'        => 'media',
						'std'         => '',
						'class'       => 'zn_full',
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') )
					),

					array(
						'id'          => 'mobile_play',
						'name'        => 'Display Play Video button on Mobiles?',
						'description' => 'By default videos are not displayed in the background on mobile devices. It\'s too problematic and instead, we added a button trigger aligned to the top, which will open the video into a modal.',
						'type'        => 'zn_radio',
						'std'         => 'no',
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_youtube','embed_iframe') ),
						"options"     => array (
							"yes" => __( "Yes", 'zn_framework' ),
							"no"  => __( "No", 'zn_framework' )
						),
						"class"       => "zn_radio--yesno"
					),

					array(
						'id'          => 'source_vd_autoplay',
						'name'        => 'Autoplay video?',
						'description' => 'Enable autoplay for video?',
						'type'        => 'select',
						'std'         => 'yes',
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
						"options"     => array (
							"yes" => __( "Yes", 'zn_framework' ),
							"no"  => __( "No", 'zn_framework' )
						),
						"class"       => "zn_input_xs"
					),
					array(
						'id'          => 'source_vd_loop',
						'name'        => 'Loop video?',
						'description' => 'Enable looping the video?',
						'type'        => 'select',
						'std'         => 'yes',
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
						"options"     => array (
							"yes" => __( "Yes", 'zn_framework' ),
							"no"  => __( "No", 'zn_framework' )
						),
						"class"       => "zn_input_xs"
					),
					array(
						'id'          => 'source_vd_muted',
						'name'        => 'Start mute?',
						'description' => 'Start the video with muted audio?',
						'type'        => 'select',
						'std'         => 'yes',
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
						"options"     => array (
							"yes" => __( "Yes", 'zn_framework' ),
							"no"  => __( "No", 'zn_framework' )
						),
						"class"       => "zn_input_xs"
					),
					array(
						'id'          => 'source_vd_controls',
						'name'        => 'Video controls',
						'description' => 'Enable video controls?',
						'type'        => 'select',
						'std'         => 'yes',
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
						"options"     => array (
							"yes" => __( "Yes", 'zn_framework' ),
							"no"  => __( "No", 'zn_framework' )
						),
						"class"       => "zn_input_xs"
					),
					array(
						'id'          => 'source_vd_controls_pos',
						'name'        => 'Video controls position',
						'description' => 'Video controls position in the slide',
						'type'        => 'select',
						'std'         => 'bottom-right',
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
						"options"     => array (
							"top-right" => __( "top-right", 'zn_framework' ),
							"top-left" => __( "top-left", 'zn_framework' ),
							"top-center"  => __( "top-center", 'zn_framework' ),
							"bottom-right"  => __( "bottom-right", 'zn_framework' ),
							"bottom-left"  => __( "bottom-left", 'zn_framework' ),
							"bottom-center"  => __( "bottom-center", 'zn_framework' ),
							"middle-right"  => __( "middle-right", 'zn_framework' ),
							"middle-left"  => __( "middle-left", 'zn_framework' ),
							"middle-center"  => __( "middle-center", 'zn_framework' )
						),
						"class"       => "zn_input_sm"
					),

					array(
						'id'          => 'source_overlay',
						'name'        => 'Background colored overlay',
						'description' => 'Add slide color overlay over the image or video to darken or enlight?',
						'type'        => 'select',
						'std'         => '0',
						"options"     => array (
							"1" => __( "Yes (Normal color)", 'zn_framework' ),
							"2" => __( "Yes (Horizontal gradient)", 'zn_framework' ),
							"3" => __( "Yes (Vertical gradient)", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						)
					),

					array(
						'id'          => 'source_overlay_color',
						'name'        => 'Overlay background color',
						'description' => 'Pick a color',
						'type'        => 'colorpicker',
						'std'         => '#353535',
						"dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('1', '2', '3') ),
					),
					array(
						'id'          => 'source_overlay_opacity',
						'name'        => 'Overlay\'s opacity.',
						'description' => 'Overlay background colors opacity level.',
						'type'        => 'slider',
						'std'         => '30',
						"helpers"     => array (
							"step" => "5",
							"min" => "0",
							"max" => "100"
						),
						"dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('1', '2', '3') ),
					),

					array(
						'id'          => 'source_overlay_color_gradient',
						'name'        => 'Overlay Gradient 2nd Bg. Color',
						'description' => 'Pick a color',
						'type'        => 'colorpicker',
						'std'         => '#353535',
						"dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('2', '3') ),
					),
					array(
						'id'          => 'source_overlay_color_gradient_opac',
						'name'        => 'Gradient Overlay\'s 2nd Opacity.',
						'description' => 'Overlay gradient 2nd background color opacity level.',
						'type'        => 'slider',
						'std'         => '30',
						"helpers"     => array (
							"step" => "5",
							"min" => "0",
							"max" => "100"
						),
						"dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('2', '3') ),
					),

					// Bottom masks
					array (
						"name"        => __( "Bottom masks override", 'zn_framework' ),
						"description" => __( "The new masks are svg based, vectorial and color adapted. <br> <strong>Disclaimer:</strong> may now work perfectly for all elements!", 'zn_framework' ),
						"id"          => "hm_header_bmasks",
						"std"         => "none",
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
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#1P0fu6T1GrU',
				'docs'    => 'http://support.hogash.com/documentation/portfolio-slider/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
