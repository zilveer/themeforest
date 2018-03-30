<?php if(! defined('ABSPATH')){ return; }
/*
Name: iOS Slider
Description: Create and display an iOS Slider element
Class: TH_IosSlider
Category: header, Fullwidth
Level: 1
Scripts: true
*/

/**
 * Class TH_IosSlider
 *
 * Create and display an iOS Slider element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_IosSlider extends ZnElements
{
	public static function getName(){
		return __( "iOS Slider", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_script( 'ios_slider_min', THEME_BASE_URI . '/pagebuilder/elements/TH_IosSlider/assets/jquery.iosslider.min.js', array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		$css = '';
		$uid = $this->data['uid'];

		$fullscreen = $this->opt('io_s_s_fullscreen',0);
		$fixed_width = $this->opt('io_s_width',0);
		$fixed_position = $this->opt('io_s_scroll',0);
		$iossheight = (int)$this->opt('io_s_s_height', '39');

		$fixed_pos_class = '';
		if($fixed_position == 1){
			$fixed_pos_class = ', .'.$uid.'+.zn_fixed_slider_fill';
		}

		if($iossheight != '39'){
			if($fullscreen != 1 && $fixed_width != 1){
				$css .= '.'.$uid.$fixed_pos_class.'{padding-bottom:'.$iossheight.'%;}';
				$css .= '@media only screen and (max-width : 1440px) { .'.$uid.$fixed_pos_class.'{padding-bottom:'.($iossheight + 5).'%;} }';
				$css .= '@media only screen and (max-width : 1279px) { .'.$uid.$fixed_pos_class.'{padding-bottom:'.($iossheight + 10).'%;} }';
				$css .= '@media only screen and (max-width : 991px) { .'.$uid.$fixed_pos_class.'{padding-bottom:'.($iossheight + 15).'%;} }';
				$css .= '@media only screen and (max-width : 767px) { .'.$uid.$fixed_pos_class.'{padding-bottom:'.($iossheight + 35).'%;} }';
				$css .= '@media only screen and (max-width : 480px) { .'.$uid.$fixed_pos_class.'{padding-bottom:'.($iossheight + 55).'%;} }';
			}
		}

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$GLOBALS['options'] = array(
			'ios_slider' => $options
		);

		include( 'inc/ui.inc.php' );
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
			"description"    => __( "Here you can create your iOS Slider Slides.", 'zn_framework' ),
			"id"             => "single_iosslider",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Slide", 'zn_framework' ),
			"remove_text"    => __( "Slide", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "io_slide_m_title",
			"subelements"    => array (
				'has_tabs'  => true,
				'media' => array(
					'title' => 'Slide media',
					'options' => array(

						array (
							"name"        => __( "Slide Type", 'zn_framework' ),
							"description" => __( "Please select the slide type", 'zn_framework' ),
							"id"          => "io_slide_type",
							"std"         => "image",
							"type"        => "select",
							"options"     => array (
								'image'  => __( "Image", 'zn_framework' ),
								'video_self' => __( "Self Hosted Video", 'zn_framework' ),
								'video_youtube' => __( "Youtube Video", 'zn_framework' ),
								'video_vimeo' => __( "Vimeo Video", 'zn_framework' ),
								'embed_iframe' => __( "Embed Iframe (Vimeo etc.)", 'zn_framework' )
							)
						),

						array (
							"name"        => __( "Youtube ID", 'zn_framework' ),
							"description" => __( "Add an Youtube ID.", 'zn_framework' ),
							"id"          => "io_slide_vd_yt",
							"std"         => "",
							"type"        => "text",
							"placeholder" => "ex: tR-5AZF9zPI",
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('video_youtube') )
						),

						// Vimeo video
						array (
							"name"        => __( "Vimeo ID", 'zn_framework' ),
							"description" => __( "Add an Vimeo ID", 'zn_framework' ),
							"id"          => "io_slide_vd_vm",
							"std"         => "",
							"type"        => "text",
							"placeholder" => "ex: 2353562345",
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('video_vimeo') )
						),

						// Embed Iframe
						array (
							"name"        => __( "Embed Video Iframe (URL)", 'zn_framework' ),
							"description" => __( "Add the full URL for Youtube, Vimeo or DailyMotion. Please remember these videos will not be autoplayed on mobile devices.", 'zn_framework' ),
							"id"          => "source_vd_embed_iframe",
							"std"         => "",
							"type"        => "text",
							"placeholder" => "ex: https://vimeo.com/17874452",
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('embed_iframe') )
						),

						/** LOCAL VIDEO **/
						array(
							'id'          => 'io_slide_vd_self_mp4',
							'name'        => 'Mp4 video source',
							'description' => 'Add the MP4 video source for your local video',
							'type'        => 'media_upload',
							'std'         => '',
							'data'  => array(
								'type' => 'video/mp4',
								'button_title' => 'Add / Change mp4 video',
							),
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('video_self') )
						),
						array(
							'id'          => 'io_slide_vd_self_ogg',
							'name'        => 'Ogg/Ogv video source',
							'description' => 'Add the OGG video source for your local video',
							'type'        => 'media_upload',
							'std'         => '',
							'data'  => array(
								'type' => 'video/ogg',
								'button_title' => 'Add / Change ogg video',
							),
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('video_self') )
						),
						array(
							'id'          => 'io_slide_vd_self_webm',
							'name'        => 'Webm video source',
							'description' => 'Add the WEBM video source for your local video',
							'type'        => 'media_upload',
							'std'         => '',
							'data'  => array(
								'type' => 'video/webm',
								'button_title' => 'Add / Change webm video',
							),
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('video_self') )
						),
						array(
							'id'          => 'io_slide_vd_vp',
							'name'        => 'Video poster',
							'description' => 'Using this option you can add your desired video poster that will be shown on unsuported devices (mobiles, tablets). ',
							'type'        => 'media',
							'std'         => '',
							'class'       => 'zn_full',
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('video_self','video_youtube','embed_iframe') )
						),
						array(
							'id'          => 'io_slide_vd_autoplay',
							'name'        => 'Autoplay video?',
							'description' => 'Enable autoplay for video? Remember, this option only applies on desktop devices, not mobiles or tablets.',
							'type'        => 'select',
							'std'         => 'yes',
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('video_self','video_youtube','embed_iframe') ),
							"options"     => array (
								"yes" => __( "Yes", 'zn_framework' ),
								"no"  => __( "No", 'zn_framework' )
							),
							"class"       => "zn_input_xs"
						),
						array(
							'id'          => 'io_slide_vd_loop',
							'name'        => 'Loop video?',
							'description' => 'Enable looping the video? Remember, this option only applies on desktop devices, not mobiles or tablets.',
							'type'        => 'select',
							'std'         => 'yes',
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('video_self','video_youtube','embed_iframe') ),
							"options"     => array (
								"yes" => __( "Yes", 'zn_framework' ),
								"no"  => __( "No", 'zn_framework' )
							),
							"class"       => "zn_input_xs"
						),
						array(
							'id'          => 'io_slide_vd_muted',
							'name'        => 'Start mute?',
							'description' => 'Start the video with muted audio?',
							'type'        => 'select',
							'std'         => 'yes',
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('video_self','video_youtube') ),
							"options"     => array (
								"yes" => __( "Yes", 'zn_framework' ),
								"no"  => __( "No", 'zn_framework' )
							),
							"class"       => "zn_input_xs"
						),
						array(
							'id'          => 'io_slide_vd_controls',
							'name'        => 'Video controls',
							'description' => 'Enable video controls? Please know that for some captions it might not be reachable.',
							'type'        => 'select',
							'std'         => 'yes',
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('video_self','video_youtube') ),
							"options"     => array (
								"yes" => __( "Yes", 'zn_framework' ),
								"no"  => __( "No", 'zn_framework' )
							),
							"class"       => "zn_input_xs"
						),
						array(
							'id'          => 'io_slide_vd_controls_pos',
							'name'        => 'Video controls position',
							'description' => 'Video controls position in the slide',
							'type'        => 'select',
							'std'         => 'bottom-right',
							"dependency"  => array(
								array('element' => 'io_slide_type' , 'value'=> array('video_self','video_youtube')),
								array('element' => 'io_slide_vd_controls' , 'value'=> array('yes'))
							 ),
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

						array (
							"name"        => __( "Slide Image", 'zn_framework' ),
							"description" => __( "Select an image for this slide", 'zn_framework' ),
							"id"          => "io_slide_image",
							"std"         => "",
							"type"        => "media",
							"alt"         => "yes",
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('image') )
						),
						array (
							"name"        => __( "Slide Image Vertical Position", 'zn_framework' ),
							"description" => __( "Select the vertical position of the image. Your image might be bigger in height than the actual slider's height so you can select which part should be visible", 'zn_framework' ),
							"id"          => "io_slide_image_vert_pos",
							"std"         => "center",
							"type"        => "select",
							"options"     => array (
								"top" => __( "Top", 'zn_framework' ),
								"center" => __( "Center", 'zn_framework' ),
								"bottom"  => __( "Bottom", 'zn_framework' )
							),
							"dependency"  => array( 'element' => 'io_slide_type' , 'value'=> array('image') )
						),

						array(
							'id'          => 'io_slide_overlay',
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
							'id'          => 'io_slide_overlay_color',
							'name'        => 'Overlay background color',
							'description' => 'Pick a color',
							'type'        => 'colorpicker',
							'std'         => '#353535',
							"dependency"  => array( 'element' => 'io_slide_overlay' , 'value'=> array('1', '2', '3') ),
						),
						array(
							'id'          => 'io_slide_overlay_opacity',
							'name'        => 'Overlay\'s opacity.',
							'description' => 'Overlay background colors opacity level.',
							'type'        => 'slider',
							'std'         => '30',
							"helpers"     => array (
								"step" => "5",
								"min" => "0",
								"max" => "100"
							),
							"dependency"  => array( 'element' => 'io_slide_overlay' , 'value'=> array('1', '2', '3') ),
						),

						array(
							'id'          => 'io_slide_overlay_color_gradient',
							'name'        => 'Overlay Gradient 2nd Bg. Color',
							'description' => 'Pick a color',
							'type'        => 'colorpicker',
							'std'         => '#353535',
							"dependency"  => array( 'element' => 'io_slide_overlay' , 'value'=> array('2', '3') ),
						),
						array(
							'id'          => 'io_slide_overlay_color_gradient_opac',
							'name'        => 'Gradient Overlay\'s 2nd Opacity.',
							'description' => 'Overlay gradient 2nd background color opacity level.',
							'type'        => 'slider',
							'std'         => '30',
							"helpers"     => array (
								"step" => "5",
								"min" => "0",
								"max" => "100"
							),
							"dependency"  => array( 'element' => 'io_slide_overlay' , 'value'=> array('2', '3') ),
						),
					),
				),
				'caption' => array(
					'title' => 'Slide caption',
					'options' => array(

						array(
							"name"        => __( "Slide Caption Options", 'zn_framework' ),
							"id"          => "scapt_title",
							"std"         => "",
							"type"        => "zn_title",
							"class"       => "zn-custom-title-xl"
						),

						array (
							"name"        => __( "Slider Caption Style", 'zn_framework' ),
							"description" => __( "Select the desired style for this slide. !!! STYLE PREVIEW LINK TO ADD !!!", 'zn_framework' ),
							"id"          => "io_slide_caption_style",
							"std"         => "",
							"type"        => "select",
							"options"     => array (
								"style1" => __( "Style 1", 'zn_framework' ),
								"style2" => __( "Style 2", 'zn_framework' ),
								"style3" => __( "Style 3", 'zn_framework' ),
								"style3 s3ext" => __( "Style 3s (since v4.0+)", 'zn_framework' ),
								"style4" => __( "Style 4 (since v4.0+)", 'zn_framework' ),
								"style4 s4ext" => __( "Style 4s (since v4.0+)", 'zn_framework' ),
								"style5" => __( "Style 5 (since v4.0+)", 'zn_framework' ),
								"style6" => __( "Style 6 (since v4.0+)", 'zn_framework' )
							),
							"class"       => ""
						),

						array (
							"name"        => __( "POPUP Video Youtube ID", 'zn_framework' ),
							"description" => __( "Add an Youtube ID to be displayed inside the popup", 'zn_framework' ),
							"id"          => "io_slide_s6_yt",
							"std"         => "",
							"type"        => "text",
							"placeholder" => "ex: tR-5AZF9zPI",
							"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style6') )
						),

						array (
							"name"        => __( "Slide main title", 'zn_framework' ),
							"description" => __( "Enter a main title for this slide. Accepts HTML.", 'zn_framework' ),
							"id"          => "io_slide_m_title",
							"std"         => "",
							"type"        => "text",
							"class"       => "zn_input_xl"
						),
						array (
							"name"        => __( "Add square box?", 'zn_framework' ),
							"description" => __( "Add a dark square box behind the main title?", 'zn_framework' ),
							"id"          => "io_slide_m_title_s5_sqbox",
							"std"         => "0",
							"type"        => "zn_radio",
							"options"     => array (
								"1" => __( "Yes", 'zn_framework' ),
								"0"  => __( "No", 'zn_framework' )
							),
						    "class"        => "zn_radio--yesno zn_input_xs",
							"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style5') )
						),
						array (
							"name"        => __( "Add Separator Line?", 'zn_framework' ),
							"description" => __( "Add a fancy separator line under the main title?", 'zn_framework' ),
							"id"          => "io_slide_sep_line",
							"std"         => "0",
							"type"        => "zn_radio",
							"options"     => array (
								"1" => __( "Yes", 'zn_framework' ),
								"0"  => __( "No", 'zn_framework' )
							),
						    "class"        => "zn_radio--yesno zn_input_xs",
							"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style5') )
						),
						array (
							"name"        => __( "Slide big title", 'zn_framework' ),
							"description" => __( "Enter a title for this slide. Accepts HTML.", 'zn_framework' ),
							"id"          => "io_slide_b_title",
							"std"         => "",
							"type"        => "text",
							"class"       => "zn_input_xl",
							"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style1','style2','style3','style3 s3ext','style4','style4 s4ext','style5') )
						),
						array (
							"name"        => __( "Slide small title", 'zn_framework' ),
							"description" => __( "Enter a small title for this slide. Accepts HTML.", 'zn_framework' ),
							"id"          => "io_slide_s_title",
							"std"         => "",
							"type"        => "text",
							"class"       => "zn_input_xl",
							//"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style1','style2','style3','style3 s3ext','style4','style4 s4ext','style5') )
						),
						array (
							"name"        => __( "Slide small top text", 'zn_framework' ),
							"description" => __( "Enter a text that will be displayed before the main title. Accepts HTML.", 'zn_framework' ),
							"id"          => "io_slide_s_title_top",
							"std"         => "",
							"type"        => "text",
							"class"       => "zn_input_xl",
							"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style5') )
						),
						array (
							"name"        => __( "Slide link", 'zn_framework' ),
							"description" => __( "Here you can add a link to your slide", 'zn_framework' ),
							"id"          => "io_slide_link",
							"std"         => "",
							"type"        => "link",
							"options"     => zn_get_link_targets(),
							"class"       => "zn_link_styled",
							"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style1','style2','style3','style3 s3ext','style4','style4 s4ext','style5') )
						),
						array (
							"name"        => __( "Slide link (secondary link)", 'zn_framework' ),
							"description" => __( "Here you can add link for a second button", 'zn_framework' ),
							"id"          => "io_slide_link2",
							"std"         => "",
							"type"        => "link",
							"options"     => zn_get_link_targets(),
							"class"       => "zn_link_styled",
							"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style5') )
						),
						array (
							"name"        => __( "Buttons sizes", 'zn_framework' ),
							"description" => __( "You can select the sizes of the buttons", 'zn_framework' ),
							"id"          => "io_btn_sizes",
							"std"         => "",
							"type"        => "select",
							"options"     => array (
								''          => __( "Default", 'zn_framework' ),
								'btn-lg'    => __( "Large", 'zn_framework' ),
								'btn-md'    => __( "Medium", 'zn_framework' ),
								'btn-sm'    => __( "Small", 'zn_framework' ),
								'btn-xs'    => __( "Extra small", 'zn_framework' ),
							),
							"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style3','style3 s3ext','style5') )
						),
						array (
							"name"        => __( "Link Image?", 'zn_framework' ),
							"description" => __( "Select yes if you want to also link the slide image. Please note that by enabling this
									option, in Internet Explorer 8 the swipe function won't behave properly.", 'zn_framework' ),
							"id"          => "io_slide_link_image",
							"std"         => "no",
							"type"        => "zn_radio",
							"options"     => array (
								"yes" => __( "Yes", 'zn_framework' ),
								"no"  => __( "No", 'zn_framework' )
							),
						    "class"        => "zn_radio--yesno zn_input_xs",
							"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style1','style2','style3','style3 s3ext','style4','style4 s4ext','style5') )
						),
						array (
							"name"        => __( "Slider Caption Entry Animation/Position", 'zn_framework' ),
							"description" => __( "Select the desired entry Animation/Position for this slide.", 'zn_framework' ),
							"id"          => "io_slide_caption_pos",
							"std"         => "",
							"type"        => "select",
							"options"     => array (
								"zn_def_anim_pos" => __( "Slide from Left", 'zn_framework' ),
								"fromright"       => __( "Slide from Right", 'zn_framework' ),
								"zoomin"       => __( "Zoom In", 'zn_framework' ),
								"sfb"       => __( "Slide from bottom", 'zn_framework' )
							),
							"class"       => "",
							"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style1','style2','style3','style3 s3ext','style4','style4 s4ext','style5') )
						),
						array (
							"name"        => __( "Slider Caption Horizontal Position", 'zn_framework' ),
							"description" => __( "Select the desired horizontal position for this slide. Center only works for Style 5 and 6.", 'zn_framework' ),
							"id"          => "io_slide_caption_pos_horiz",
							"std"         => "left",
							"type"        => "select",
							"options"     => array (
								"aligncenter"     => __( "Center (Only for caption style 5 and 6)", 'zn_framework' ),
								"alignleft"       => __( "Left (default)", 'zn_framework' ),
								"alignright"      => __( "Right", 'zn_framework' )
							),
							"class"       => "",
							// "dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style5') )
						),
						array (
							"name"        => __( "Slider Caption Vertical Position", 'zn_framework' ),
							"description" => __( "Select the desired vertical position for this
													 slide.", 'zn_framework' ),
							"id"          => "io_slide_caption_pos_vert",
							"std"         => "bottom",
							"type"        => "select",
							"options"     => array (
								"top"          => __( "Top", 'zn_framework' ),
								"bottom"       => __( "Bottom (default)", 'zn_framework' ),
								"middle"       => __( "Middle", 'zn_framework' )
							),
							"class"       => ""
						),

						array (
							"name"        => __( "Add image boxes?", 'zn_framework' ),
							"description" => __( "This feature will enable displaying multiple small images/thumbs.", 'zn_framework' ),
							"id"          => "io_slide_imgboxes",
							"std"         => "0",
							"type"        => "zn_radio",
							"options"     => array (
								"1" => __( "Yes", 'zn_framework' ),
								"0"  => __( "No", 'zn_framework' )
							),
						    "class"        => "zn_radio--yesno zn_input_xs",
							"dependency"  => array( 'element' => 'io_slide_caption_style' , 'value'=> array('style1','style2','style3','style3 s3ext','style4','style4 s4ext','style5') )
						),
						array (
							"name"        => __( "Image Box 1", 'zn_framework' ),
							"description" => __( "Select an image for this Image Box", 'zn_framework' ),
							"id"          => "io_slide_imgboxes_i1_src",
							"std"         => "",
							"type"        => "media",
							"alt"         => "yes",
							"dependency"  => array( 'element' => 'io_slide_imgboxes' , 'value'=> array('1') )
						),

						array (
							"name"        => __( "Image Box 1 - URL", 'zn_framework' ),
							"description" => __( "Add an url for this Image Box", 'zn_framework' ),
							"id"          => "io_slide_imgboxes_i1_url",
							"std"         => "",
							"type"        => "link",
							"options"     => zn_get_link_targets(),
							"class"       => "zn_link_styled",
							"dependency"  => array( 'element' => 'io_slide_imgboxes' , 'value'=> array('1') )
						),
						array (
							"name"        => __( "Image Box 2", 'zn_framework' ),
							"description" => __( "Select an image for this Image Box", 'zn_framework' ),
							"id"          => "io_slide_imgboxes_i2_src",
							"std"         => "",
							"type"        => "media",
							"alt"         => "yes",
							"dependency"  => array( 'element' => 'io_slide_imgboxes' , 'value'=> array('1') )
						),
						array (
							"name"        => __( "Image Box 2 - URL", 'zn_framework' ),
							"description" => __( "Add an url for this Image Box", 'zn_framework' ),
							"id"          => "io_slide_imgboxes_i2_url",
							"std"         => "",
							"type"        => "link",
							"options"     => zn_get_link_targets(),
							"class"       => "zn_link_styled",
							"dependency"  => array( 'element' => 'io_slide_imgboxes' , 'value'=> array('1') )
						),
						array (
							"name"        => __( "Image Box 3", 'zn_framework' ),
							"description" => __( "Select an image for this Image Box", 'zn_framework' ),
							"id"          => "io_slide_imgboxes_i3_src",
							"std"         => "",
							"type"        => "media",
							"alt"         => "yes",
							"dependency"  => array( 'element' => 'io_slide_imgboxes' , 'value'=> array('1') )
						),
						array (
							"name"        => __( "Image Box 3 - URL", 'zn_framework' ),
							"description" => __( "Add an url for this Image Box", 'zn_framework' ),
							"id"          => "io_slide_imgboxes_i3_url",
							"std"         => "",
							"type"        => "link",
							"options"     => zn_get_link_targets(),
							"class"       => "zn_link_styled",
							"dependency"  => array( 'element' => 'io_slide_imgboxes' , 'value'=> array('1') )
						),
					)
				)
			)
		);
		return array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Fullscreen", 'zn_framework' ),
						"description" => __( "Chose wether the slider should be fixed height or fullscreen.", 'zn_framework' ),
						"id"          => "io_s_s_fullscreen",
						"std"         => "0",
						"type"        => "zn_radio",
						"options"     => array ( "1" => __( "Yes", 'zn_framework' ), "0" => __( "No", 'zn_framework' ) ),
					    "class"        => "zn_radio--yesno zn_input_xs"
					),
					array (
						"name"        => __( "Slider Height", 'zn_framework' ),
						"description" => __( "Enter a numeric value for the slider height.Please note that the value will be used
									as percentage. The default value is 39%. This option works if Fullscreen is disabled.", 'zn_framework' ),
						"id"          => "io_s_s_height",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "39%",
						"class"       => "zn_input_xs",
						"dependency"  => array( 'element' => 'io_s_s_fullscreen' , 'value'=> array('0') )
					),

					array (
						"name"        => __( "Autoplay?", 'zn_framework' ),
						"description" => __( "Autoplay slider?", 'zn_framework' ),
						"id"          => "io_s_autoplay",
						"std"         => "1",
						"value"       => "1",
						"type"        => "toggle2",
					),

					// array (
					// 	"name"        => __( "Pause slider when playing videos?", 'zn_framework' ),
					// 	"description" => __( "In case there's a video which is playing, do you want to pause the slider?", 'zn_framework' ),
					// 	"id"          => "io_s_pause_vid",
					// 	"std"         => "1",
					// 	"value"       => "1",
					// 	"type"        => "toggle2",
					// ),

					array (
						"name"        => __( "Transition Speed", 'zn_framework' ),
						"description" => __( "Enter a numeric value for the transition speed (default: 5000)", 'zn_framework' ),
						"id"          => "io_s_trans",
						"std"         => "5000",
						"type"        => "text",
						"class"       => "zn_input_xs"
					),
					array (
						"name"        => __( "Slider Navigation", 'zn_framework' ),
						"description" => __( "Choose what type of navigation you want to use for your slide.", 'zn_framework' ),
						"id"          => "io_s_navigation",
						"std"         => "bullets",
						"type"        => "select",
						"options"     => array (
							"bullets" => __( "Bullets", 'zn_framework' ),
							"bullets2" => __( "Bullets Style 2 (since v4.0+)", 'zn_framework' ),
							"thumbs"  => __( "Thumbnails", 'zn_framework' )
						),
					),

					array (
						"name"        => __( "Enable Slide Dragging", 'zn_framework' ),
						"description" => __( "Enable Slides Dragging with your mouse cursor?", 'zn_framework' ),
						"id"          => "io_s_clickdrag",
						"std"         => "1",
						"value"       => "1",
						"type"        => "toggle2",
					),
				)
			),

			'styling' => array(
				'title' => 'Styles Options',
				'options' => array(

					array (
						"name"        => __( "Add Fade Effect?", 'zn_framework' ),
						"description" => __( "Choose if you want to add a bottom fade effect to your slider.", 'zn_framework' ),
						"id"          => "io_s_fade",
						"std"         => "0",
						"type"        => "zn_radio",
						"options"     => array ( "1" => __( "Yes", 'zn_framework' ), "0" => __( "No", 'zn_framework' ) ),
					    "class"        => "zn_radio--yesno zn_input_xs"
					),
					// depends on the above option: 'id' => 'io_s_fade',
					array(
						'id'          => 'io_s_fade_color',
						'name'        => 'Color for the fading background',
						'description' => 'Pick a color',
						'type'        => 'colorpicker',
						'std'         => '#f5f5f5',
						"dependency"  => array( 'element' => 'io_s_fade' , 'value'=> array('1') ),
					),
					array (
						"name"        => __( "Use fixed width slider?", 'zn_framework' ),
						"description" => __( "Choose if you want to use a full width slider or a fixed width one.", 'zn_framework' ),
						"id"          => "io_s_width",
						"std"         => "0",
						"type"        => "select",
						"options"     => array (
							"0" => __( "Full Width", 'zn_framework' ),
							"1" => __( "Fixed Width", 'zn_framework' )
						),
						"class"       => "zn_input_sm"
					),

					array (
						"name"        => __( "Relative Height for Fixed width slider", 'zn_framework' ),
						"description" => __( "In case you select Fixed width, please specify if you want the slider to resize relatively to the width of the screen on smaller screen devices. Basically if you enable this, the slider will shrink itself vertically relative to width of the page.", 'zn_framework' ),
						"id"          => "io_s_fixdwidth_relative",
						"std"         => "",
						"value"         => "ios--fw--relativeresp",
						"type"        => "toggle2",
						"dependency"  => array( 'element' => 'io_s_width' , 'value'=> array('1') ),
					),

					array (
						"name"        => __( "Use fixed position (scroll) slider?", 'zn_framework' ),
						"description" => __( "Choose if you want your slider to be fixed on the page when you scroll down", 'zn_framework' ),
						"id"          => "io_s_scroll",
						"std"         => "0",
						"type"        => "zn_radio",
						"options"     => array ( "1" => __( "Yes", 'zn_framework' ), "0" => __( "No", 'zn_framework' ) ),
					    "class"        => "zn_radio--yesno zn_input_xs"
					),
					array (
						"name"        => __( "Add scrolling effect?", 'zn_framework' ),
						"description" => __( "Choose if you want the slider to have a scrolling effect on the entire slider and captions. The captions will fade while the slider will slowly move downwards upon scrolling.<br> <strong style=' color: #9B4F4F;'>This options works only if the slider is positioned at the very top opf the page!!</strong>", 'zn_framework' ),
						"id"          => "io_s_scrolling_effect",
						"std"         => "0",
						"type"        => "zn_radio",
						"options"     => array ( "1" => __( "Yes", 'zn_framework' ), "0" => __( "No", 'zn_framework' ) ),
					    "class"        => "zn_radio--yesno zn_input_xs"
					),

					array (
						"name"        => __( "Slider Background Style", 'zn_framework' ),
						"description" => __( "Select the background style you want to use for this slider. Please note that styles
							can be created from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
						"id"          => "io_header_style",
						"std"         => "",
						"type"        => "select",
						"options"     => WpkZn::getThemeHeaders(true),
						"class"       => "",
						'live' => array(
						   'type'        => 'class',
						   'css_class' => '.'.$this->data['uid'],
						   'val_prepend'   => 'uh_',
						)
					),

					// Bottom masks overrides
					array (
						"name"        => __( "Bottom masks override", 'zn_framework' ),
						"description" => __( "The new masks are svg based, vectorial and color adapted.", 'zn_framework' ),
						"id"          => "hm_header_bmasks",
						"std"         => "none",
						"type"        => "select",
						"options"     => zn_get_bottom_masks(),
						"dependency"  => array( 'element' => 'io_s_navigation' , 'value'=> array('bullets', 'bullets2') )
					),

                    array(
                        'id'          => 'hm_header_bmasks_bg',
                        'name'        => 'Bottom Mask Background Color',
                        'description' => 'If you need the mask to have a different color than the main site background, please choose the color. Usually this color is needed when the next section, under this one has a different background color.',
                        'type'        => 'colorpicker',
                        'std'         => '',
                        "dependency"  => array(
                        	array(
	                        	'element' => 'hm_header_bmasks' ,
	                        	'value'=> array('mask3', 'mask3 mask3l', 'mask3 mask3r', 'mask4', 'mask4 mask4l', 'mask4 mask4r', 'mask5', 'mask6')
                        	),
                        	array(
                        		'element' => 'io_s_navigation' ,
                        		'value'=> array('bullets', 'bullets2')
                        	)
                    	)
                    ),
				),
			),
			'slides' => array(
				'title' => 'Slides options',
				'options' => array(
					$extra_options,
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#Hgwzjxw7ng4',
				'docs'    => 'http://support.hogash.com/documentation/ios-slider/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
	}
}

