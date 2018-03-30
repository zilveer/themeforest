<?php if(! defined('ABSPATH')){ return; }
/*
Name: Nivo slider
Description:
Class: TH_NivoSlider
Category: headers, Fullwidth
Level: 1
Scripts: true
*/
/**
 * Class TH_NivoSlider
 *
 * Create and display a Nivo Slider element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_NivoSlider extends ZnElements
{
	public static function getName(){
		return __( "Nivo Slider", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'nivo_slider', THEME_BASE_URI . '/pagebuilder/elements/TH_NivoSlider/assets/jquery.nivo.slider.pack.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];


		if( empty(  $options['single_nivo'] ) ){
			return;
		}

		$style = $this->opt('nv_header_style', '');
		if ( ! empty ( $style ) ) {
			$style = 'uh_' . $style;
		}

		$nv_auto_slide = $this->opt('nv_auto_slide', '1');
		$nv_pause_time = $this->opt('nv_pause_time', '5000');

		// Shadow style
		$nv_shadow = '';
		if( isset($options['nv_shadow']) && $options['nv_shadow'] != '' ) {
			$nv_shadow = 'zn-shadow-lifted';
		}

		$sl_height = $this->opt('nv_sl_height','470');

		$bottom_mask = $this->opt('hm_header_bmasks','none');
		$bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

		?>
		<div class="kl-slideshow kl-nivoslider <?php echo $style; ?> <?php echo $bm_class ?> <?php echo $this->data['uid']; ?> <?php echo zn_get_element_classes($this->data['options']); ?>">

			<div class="fake-loading loading-2s"></div>

			<div class="bgback"></div>
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
				) );
			?>
			<div class="th-sparkles"></div>

			<div class="kl-slideshow-inner container kl-slideshow-safepadding">

				<div class="nivoslider nivoContainer">
					<div class="nivoSlider <?php echo $nv_shadow;?>" data-transition="<?php echo $options['nv_transition'];?>" data-autoslide="<?php echo $nv_auto_slide; ?>" data-pausetime="<?php echo $nv_pause_time; ?>">
						<?php
						if ( isset ( $options['single_nivo'] ) && is_array( $options['single_nivo'] ) )
						{
							foreach ( $options['single_nivo'] as $slide )
							{

								$title      = '';

								$nv_slide_link = zn_extract_link($slide['nv_slide_link'], 'link');

								if ( isset ( $slide['nv_slide_title'] ) && ! empty ( $slide['nv_slide_title'] ) ) {
									$title = $slide['nv_slide_title'];
								}

								echo $nv_slide_link['start'];

								if ( isset ( $slide['nv_slide_image'] ) && ! empty ( $slide['nv_slide_image'] ) ) {

									$image = vt_resize( '', $slide['nv_slide_image'], '1140', $sl_height, true );
									echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . ZngetImageAltFromUrl( $slide['nv_slide_image'] ) . '" title="' . $title . '"  />';
								}
								echo $nv_slide_link['end'];
							}
						}
						?>
					</div>
				</div>
				<!-- end #nivoslider -->
			</div>
			<?php
				zn_bottommask_markup($bottom_mask, $this->opt('hm_header_bmasks_bg',''));
			?>
			<!-- header bottom style -->
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
			"description"    => __( "Here you can create your Nivo Slider Slides.", 'zn_framework' ),
			"id"             => "single_nivo",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Slide", 'zn_framework' ),
			"remove_text"    => __( "Slide", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "nv_slide_title",
			"subelements"    => array (
				array (
					"name"        => __( "Slide image", 'zn_framework' ),
					"description" => __( "Select an image for this Slide. Recommended size 1170px x 470px", 'zn_framework' ),
					"id"          => "nv_slide_image",
					"std"         => "",
					"type"        => "media"
				),
				array (
					"name"        => __( "Slide title", 'zn_framework' ),
					"description" => __( "This title will appear over the image", 'zn_framework' ),
					"id"          => "nv_slide_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Slide link", 'zn_framework' ),
					"description" => __( "Here you can add a link to your slide", 'zn_framework' ),
					"id"          => "nv_slide_link",
					"std"         => "",
					"type"        => "link",
					"options"     => zn_get_link_targets(),
				)
			)
		);

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Slides Height", 'zn_framework' ),
						"description" => __( "Select a slider height. Removing the height will add an auto flag which will keep the default images heights.", 'zn_framework' ),
						"id"          => "nv_sl_height",
						"std"         => "470",
						"type"        => "text"
					),

					array (
						"name"        => __( "Slider Transition", 'zn_framework' ),
						"description" => __( "Select the desired transition that you want to use for this slider.", 'zn_framework' ),
						"id"          => "nv_transition",
						"std"         => "random",
						"type"        => "select",
						"options"     => array (
							'random'             => __( 'Random', 'zn_framework' ),
							'sliceDown'          => __( 'sliceDown', 'zn_framework' ),
							'sliceDownLeft'      => __( 'sliceDownLeft', 'zn_framework' ),
							'sliceUp'            => __( 'sliceUp', 'zn_framework' ),
							'sliceUpLeft'        => __( 'sliceUpLeft', 'zn_framework' ),
							'sliceUpDown'        => __( 'sliceUpDown', 'zn_framework' ),
							'sliceUpDownLeft'    => __( 'sliceUpDownLeft', 'zn_framework' ),
							'fold'               => __( 'fold', 'zn_framework' ),
							'fade'               => __( 'fade', 'zn_framework' ),
							'slideInRight'       => __( 'slideInRight', 'zn_framework' ),
							'slideInLeft'        => __( 'slideInLeft', 'zn_framework' ),
							'boxRandom'          => __( 'boxRandom', 'zn_framework' ),
							'boxRain'            => __( 'boxRain', 'zn_framework' ),
							'boxRainReverse'     => __( 'boxRainReverse', 'zn_framework' ),
							'boxRainGrow'        => __( 'boxRainGrow', 'zn_framework' ),
							'boxRainGrowReverse' => __( 'boxRainGrowReverse', 'zn_framework' )
						),
						"class"       => ""
					),
					array (
						"name"        => __( "Automatic Transition", 'zn_framework' ),
						"description" => __( "Select yes if you want the slider to auto advance to each slide, or no, in order to
									manually change the slide.", 'zn_framework' ),
						"id"          => "nv_auto_slide",
						"std"         => "1",
						"type"        => "zn_radio",
						"options"     => array ( '1' => __( 'No', 'zn_framework' ), '0' => __( 'Yes', 'zn_framework' ) ),
					    "class"        => "zn_radio--yesno",
					),
					array (
						"name"        => __( "Slider Pause Time", 'zn_framework' ),
						"description" => __( "How long each slide will show ( default is 5000 ).", 'zn_framework' ),
						"id"          => "nv_pause_time",
						"std"         => "5000",
						"type"        => "text"
					),

				)
			),

			'items' => array(
				'title' => 'Add slides',
				'options' => array(
					$extra_options,
				),
			),

			'background' => array(
				'title' => 'Background & Styles Options',
				'options' => array(

					array (
						"name"        => __( "Shadow style", 'zn_framework' ),
						"description" => __( "Select the desired shadow that you want to use for this slider.", 'zn_framework' ),
						"id"          => "nv_shadow",
						"std"         => "lifted",
						"type"        => "select",
						"options"     => array (
							''             => __( 'No Shadow', 'zn_framework' ),
							'lifted'             => __( 'Lifted', 'zn_framework' )
						),
						"class"       => ""
					),

					array (
						"name"        => __( "Element Background Style", 'zn_framework' ),
						"description" => __( "Select the background style you want to use for this slider. Please note that styles can be created from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
						"id"          => "nv_header_style",
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#smLKhSaiXHE',
				'docs'    => 'http://support.hogash.com/documentation/nivo-slider/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;

	}
}
