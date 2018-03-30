<?php if(! defined('ABSPATH')){ return; }
/*
Name: Custom Sub-header
Description: Create and display a Custom Header Layout element
Class: TH_CustomSubHeaderLayout
Category: headers, Fullwidth
Level: 1
*/
/**
 * Class TH_CustomSubHeaderLayout
 *
 * Create and display a Custom Header Layout element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_CustomSubHeaderLayout extends ZnElements
{
	public static function getName(){
		return __( "Custom Sub-Header Layout", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element(){

		$bgsource = array(
			'source_type' => $this->opt('source_type'),
			'source_background_image' => $this->opt('source_background_image'),
			'source_vd_yt' => $this->opt('source_vd_yt'),
            'source_vd_vm' => $this->opt('source_vd_vm'),
            'source_vd_embed_iframe' => $this->opt('source_vd_embed_iframe'),
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
			'enable_parallax' => $this->opt('enable_parallax'),
		);

		$config = array(
			'headerClass' => 'site-subheader-cst uh_'. $this->opt( 'hm_header_style', 'zn_def_header_style' ),
			'extra_css_class' => $this->data['uid'].' '.zn_get_element_classes($this->data['options']),
			'bottommask' => $this->opt( 'hm_header_bmasks', 'none' ),
			'bottommask_bg' => $this->opt( 'hm_header_bmasks_bg', '' ),
			'bg_source' => $bgsource,
			'def_header_title' => $this->opt( 'hm_header_title', '' ),
			'show_subtitle' =>  $this->opt( 'hm_header_subtitle', '' ),
			'def_header_bread' => $this->opt('hm_header_bread', ''),
			'def_header_date' => $this->opt( 'hm_header_date', ''),
			'is_element' => true,
			'inherit_head_pad' => $this->opt('hm_inherit_ulm', 'no') == 'yes' ? true : false,
			'subheader_alignment' => $this->opt('subheader_alignment',''),
			'subheader_textcolor' => $this->opt('subheader_textcolor',''),
		);


		$title = $this->opt('hm_header_ovtitle','');
		$subtitle = $this->opt('hm_header_ovsubtitle','');

		if( !empty( $title ) ){ $config['title'] = $title; }
		if( !empty( $subtitle ) ){ $config['subtitle'] = $subtitle; }

		// display the Subheader
		WpkPageHelper::zn_get_subheader($config, true);
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		return  array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Show Page Title", 'zn_framework' ),
						"description" => __( "Select if you want to show the page title or not.", 'zn_framework' ),
						"id"          => "hm_header_title",
						"std"         => '',
						"type"        => "select",
						"options"     => array (
							'' => __( '- Default - Set from theme options -', 'zn_framework' ),
							'1' => __( 'Show', 'zn_framework' ),
							'0' => __( 'Hide', 'zn_framework' )
						),
					),
					array (
						"name"        => __( "Custom Title? Type here.", 'zn_framework' ),
						"description" => __( "Override the default page title.", 'zn_framework' ),
						"id"          => "hm_header_ovtitle",
						"std"         => "",
						"type"        => "text",
						"dependency"  => array( 'element' => 'hm_header_title' , 'value'=> array('1') )
					),

					array (
						"name"        => __( "Show Page Subtitle", 'zn_framework' ),
						"description" => __( "Select if you want to show the page subtitle or not.", 'zn_framework' ),
						"id"          => "hm_header_subtitle",
						"std"         => '',
						"type"        => "select",
						"options"     => array (
							'' => __( '- Default - Set from theme options -', 'zn_framework' ),
							'1' => __( 'Show', 'zn_framework' ),
							'0' => __( 'Hide', 'zn_framework' )
						),
					),
					array (
						"name"        => __( "Custom SubTitle? Type here.", 'zn_framework' ),
						"description" => __( "Override the default page subtitle.", 'zn_framework' ),
						"id"          => "hm_header_ovsubtitle",
						"std"         => "",
						"type"        => "text",
						"dependency"  => array( 'element' => 'hm_header_subtitle' , 'value'=> array('1') )
					),

					array (
					    "name"        => __( "Title & Subtitle text alignment", 'zn_framework' ),
					    "description" => __( "If you have disabled both Breadcrumbs & Date, you can choose to custom align the title and subtitle in subheader. You can override this setting in the Custom Subheader Element.", 'zn_framework' ),
					    "id"          => "subheader_alignment",
					    "std"         => "",
					    "type"        => "select",
					    "options"     => array (
					        '' => __( '- Default - Set from theme options -', 'zn_framework' ),
					        'left' => __( 'Left', 'zn_framework' ),
					        'center' => __( 'Center', 'zn_framework' ),
					        'right' => __( 'Right', 'zn_framework' ),
					    ),
					    "dependency"  => array(
					        array(
					            'element' => 'hm_header_bread' ,
					            'value'=> array('0')
					        ),
					        array(
					            'element' => 'hm_header_date' ,
					            'value'=> array('0')
					        ),
					    ),
					    'live' => array(
						   'type'        => 'class',
						   'css_class' => '.'.$uid,
						   'val_prepend'   => 'sh-titles--',
						)

					),

					array (
						"name"        => __( "Show Breadcrumbs", 'zn_framework' ),
						"description" => __( 'Select if you want to show the breadcrumbs or not. Selecting "inherit" will rely on the Default Subheader options value.', 'zn_framework' ),
						"id"          => "hm_header_bread",
						"std"         => "",
						"type"        => "select",
						"options"     => array (
							'' => __( '- Default - Set from theme options -', 'zn_framework' ),
							'1' => __( 'Show', 'zn_framework' ),
							'0' => __( 'Hide', 'zn_framework' )
						),
					),

					array (
						"name"        => __( "Show Date", 'zn_framework' ),
						"description" => __( 'Select if you want to show the current date under breadcrumbs or not. Selecting "inherit" will rely on the Default Subheader options value.', 'zn_framework' ),
						"id"          => "hm_header_date",
						"std"         => "",
						"type"        => "select",
						"options"     => array (
							'' => __( '- Default - Set from theme options -', 'zn_framework' ),
							'1' => __( 'Show', 'zn_framework' ),
							'0' => __( 'Hide', 'zn_framework' )
						)
					),

					array (
					    "name"        => __( "Text Color Scheme", 'zn_framework' ),
					    "description" => __( "Select the text color scheme.", 'zn_framework' ),
					    "id"          => "subheader_textcolor",
					    "std"         => "",
					    "type"        => "select",
					    "options"     => array (
							'' => __( '- Default - Set from theme options -', 'zn_framework' ),
					        'light' => __( 'Light', 'zn_framework' ),
					        'dark' => __( 'Dark', 'zn_framework' ),
					    ),
					    'live' => array(
						   'type'        => 'class',
						   'css_class' => '.'.$uid,
						   'val_prepend'   => 'sh-tcolor--',
						)
					),
				)
			),

			'height_pad' => array(
				'title' => 'Height & Padding',
				'options' => array(

					array (
						"name"        => __( 'Use Height & Padding Top from "Unlimited Subheaders" style', 'zn_framework' ),
						"description" => __( "In case you select this element to have a Subheader Style defined in Unlimited Headers, this option will enable the 'height' and 'padding top' defined there, to be applied here too. Please note that this option will NOT override the settings below.", 'zn_framework' ),
						"id"          => "hm_inherit_ulm",
						"std"         => "no",
						"type"        => "zn_radio",
						"options"     => array (
							"yes"        => __( "Yes", 'zn_framework' ),
							"no"        => __( "No", 'zn_framework' )
						),
						"class"       => "zn_full zn_radio--yesno",
					),

					array (
						"name"        => __( "Edit height and padding for each device breakpoint", 'zn_framework' ),
						"description" => __( "Edit the height and padding options for each breakpoint (device). This will enable you to have more control over the subheader on each device. For example you might want the subheader to be shorter on mobiles, but taller on desktops.", 'zn_framework' ),
						"id"          => "hm_br_options",
						"std"         => "lg",
						"type"        => "zn_radio",
						"options"     => array (
							"lg"        => __( "LARGE", 'zn_framework' ),
							"md"        => __( "MEDIUM", 'zn_framework' ),
							"sm"        => __( "SMALL", 'zn_framework' ),
							"xs"        => __( "EXTRA SMALL", 'zn_framework' ),
						),
						"class"       => "zn_full zn_breakpoints",
						"dependency"  => array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
					),

					// LARGE BREAKPOINTS
					array (
						"name"        => __( "Header Height on LARGE DEVICES (Desktops)", 'zn_framework' ),
						"description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
						"id"          => "hm_header_height",
						"std"         => "300",
						"type" => "slider",
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '150',
							'max' => '1280',
							'step' => '1'
						),
						'live' => array(
							'multiple' => array(
								array(
									'type'        => 'css',
									'css_class' => '.'.$this->data['uid'],
									'css_rule'    => 'height',
									'unit'        => 'px'
								),
								array(
									'type'        => 'css',
									'css_class' => '.'.$this->data['uid'],
									'css_rule'    => 'min-height',
									'unit'        => 'px'
								),
							),
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('lg') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),
					array(
						'id'          => 'top_padding',
						'name'        => 'Top Padding on LARGE DEVICES (Desktops)',
						'description' => 'Select the top padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '170',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '50',
							'max' => '350',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'].' .ph-content-wrap',
							'css_rule'  => 'padding-top',
							'unit'      => 'px'
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('lg') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),
					array(
						'id'          => 'bottom_padding',
						'name'        => 'Bottom Padding on LARGE DEVICES (Desktops)',
						'description' => 'Select the bottom padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '0',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '350',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'].' .ph-content-wrap',
							'css_rule'  => 'padding-bottom',
							'unit'      => 'px'
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('lg') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),

					// MEDIUM BREAKPOINTS
					array (
						"name"        => __( "Header Height on MEDIUM DEVICES (Tablets on Landscape mode)", 'zn_framework' ),
						"description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
						"id"          => "hm_header_height_md",
						"std"         => "300",
						"type" => "slider",
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '150',
							'max' => '1280',
							'step' => '1'
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('md') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),
					array(
						'id'          => 'top_padding_md',
						'name'        => 'Top Padding on MEDIUM DEVICES (Tablets on Landscape mode)',
						'description' => 'Select the top padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '170',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '50',
							'max' => '350',
							'step' => '1'
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('md') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),
					array(
						'id'          => 'bottom_padding_md',
						'name'        => 'Bottom Padding on MEDIUM DEVICES (Tablets on Landscape mode)',
						'description' => 'Select the bottom padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '0',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '350',
							'step' => '1'
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('md') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),

					// SMALL BREAKPOINTS
					array (
						"name"        => __( "Header Height on SMALL DEVICES (Tablets on Portrait mode)", 'zn_framework' ),
						"description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
						"id"          => "hm_header_height_sm",
						"std"         => "300",
						"type" => "slider",
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '150',
							'max' => '1280',
							'step' => '1'
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('sm') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),
					array(
						'id'          => 'top_padding_sm',
						'name'        => 'Top Padding on SMALL DEVICES (Tablets on Portrait mode)',
						'description' => 'Select the top padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '170',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '50',
							'max' => '350',
							'step' => '1'
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('sm') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),
					array(
						'id'          => 'bottom_padding_sm',
						'name'        => 'Bottom Padding on SMALL DEVICES (Tablets on Portrait mode)',
						'description' => 'Select the bottom padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '0',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '350',
							'step' => '1'
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('sm') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),

					// EXTRA SMALL BREAKPOINTS
					array (
						"name"        => __( "Header Height on EXTRA SMALL DEVICES (SmartPhones)", 'zn_framework' ),
						"description" => __( "Please enter your desired height in pixels for this header.", 'zn_framework' ),
						"id"          => "hm_header_height_xs",
						"std"         => "300",
						"type" => "slider",
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '150',
							'max' => '1280',
							'step' => '1'
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('xs') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),
					array(
						'id'          => 'top_padding_xs',
						'name'        => 'Top Padding on EXTRA SMALL DEVICES (SmartPhones)',
						'description' => 'Select the top padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '170',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '50',
							'max' => '350',
							'step' => '1'
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('xs') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),
					array(
						'id'          => 'bottom_padding_xs',
						'name'        => 'Bottom Padding on EXTRA SMALL DEVICES (SmartPhones)',
						'description' => 'Select the bottom padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '0',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '350',
							'step' => '1'
						),
						"dependency"  => array(
							array( 'element' => 'hm_br_options' , 'value'=> array('xs') ),
							array( 'element' => 'hm_inherit_ulm' , 'value'=> array('no') )
						)
					),


				)
			),

			'background' => array(
				'title' => 'Background & Styles Options',
				'options' => array(
					array (
						"name"        => __( "Sub-Header Style", 'zn_framework' ),
						"description" => __( "Select the sub-header style you want to use for this page. Please note that header styles can be created from the theme's Unlimited Subheaders page in Kallyas Options.", 'zn_framework' ),
						"id"          => "hm_header_style",
						"std"         => "zn_def_header_style",
						"type"        => "select",
						"options"     => WpkZn::getThemeHeaders(true),
						// Live doesn't work because we need to add extra 'uh_' to the option name
						'live' => array(
						   'type'        => 'class',
						   'css_class' => '.'.$this->data['uid'],
						   'val_prepend'   => 'uh_',
						)
					),

					// Background image/video or youtube
					array (
						"name"        => __( "Background Source Type", 'zn_framework' ),
						"description" => __( "Please select the source type of the background.", 'zn_framework' ),
						"id"          => "source_type",
						"std"         => "",
						"type"        => "select",
						"options"     => array (
							''  => __( "None (Will just rely on the Header style (if any selected) )", 'zn_framework' ),
							'image'  => __( "Image", 'zn_framework' ),
							'video_self' => __( "Self Hosted Video", 'zn_framework' ),
							'video_youtube' => __( "Youtube Video", 'zn_framework' ),
							'video_vimeo' => __( "Vimeo Video", 'zn_framework' ),
                            'embed_iframe' => __( "Embed Iframe (Vimeo etc.)", 'zn_framework' )
						)
					),

					array(
						'id'          => 'source_background_image',
						'name'        => 'Background image',
						'description' => 'Please choose a background image for this section. Recommended size 1920px x 300px (depends on your sub-header height)',
						'type'        => 'background',
						'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
						'class'       => 'zn_full',
						'dependency' => array( 'element' => 'source_type' , 'value'=> array('image') )
					),

					// Embed Iframe
                    array (
                        "name"        => __( "Embed Video Iframe (URL)", 'zn_framework' ),
                        "description" => __( "Add the full URL for Youtube, Vimeo or DailyMotion. Please remember these videos will not be autoplayed on mobile devices.", 'zn_framework' ),
                        "id"          => "source_vd_embed_iframe",
                        "std"         => "",
                        "type"        => "text",
                        "placeholder" => "ex: https://vimeo.com/17874452",
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('embed_iframe') )
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
						'description' => 'Using this option you can add your desired video poster that will be shown on unsuported devices (mobiles, tablets).',
						'type'        => 'media',
						'std'         => '',
						'class'       => 'zn_full',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube', 'embed_iframe') )
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
						'description' => 'Enable autoplay for video? Remember, this option only applies on desktop devices, not mobiles or tablets.',
						'type'        => 'select',
						'std'         => 'yes',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube', 'embed_iframe') ),
						"options"     => array (
							"yes" => __( "Yes", 'zn_framework' ),
							"no"  => __( "No", 'zn_framework' )
						),
						"class"       => "zn_input_xs"
					),
					array(
						'id'          => 'source_vd_loop',
						'name'        => 'Loop video?',
						'description' => 'Enable looping the video? Remember, this option only applies on desktop devices, not mobiles or tablets.',
						'type'        => 'select',
						'std'         => 'yes',
                        "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube', 'embed_iframe') ),
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
						"dependency"  => array(
                            array('element' => 'source_type' , 'value'=> array('video_self','video_youtube')),
                            array('element' => 'source_vd_controls' , 'value'=> array('yes'))
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

					array(
						'id'            => 'enable_parallax',
						'name'          => 'Enable Scrolling Parallax effect',
						'description'   => 'Select if you want to enable parallax scrolling effect on background image.',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes',
						// 'dependency' => array( 'element' => 'source_type' , 'value'=> array('image') )
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

					array (
						"name"        => __( "Bottom masks override", 'zn_framework' ),
						"description" => __( "The new masks are svg based, vectorial and color adapted.", 'zn_framework' ),
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#fENF1bmvkmE',
				'docs'    => 'http://support.hogash.com/documentation/custom-header-layout/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];
		$height = $this->opt('hm_header_height', '300');

		// No need to add the css code if the value is left default which is 300px
		if( $height != '300' ){
			$extraHeightFromMask = $this->opt('hm_header_bmasks','none') != 'none' ? '30' : '0';
			$height = $extraHeightFromMask + $height;
			$css .= '.'.$uid.'.page-subheader { height: '. $height.'px; min-height: '. $height.'px;} ';
		}
		// Top padding
		$tpadding = '';
		$top_padding = $this->opt('top_padding');
		if($top_padding != '170'){
			$tpadding = $top_padding || $top_padding === '0' ? 'padding-top:'.$top_padding.'px;' : '';
		}
		// Bottom padding
		$bpadding = '';
		$bottom_padding = $this->opt('bottom_padding');
		if( $bottom_padding != 0 ){
			$bpadding = $bottom_padding || $bottom_padding === '0' ? 'padding-bottom:'.$bottom_padding.'px;' : '';
		}
		// Top and bottom paddings
		if($tpadding || $bpadding){
			$css .= '.'.$uid.'.page-subheader .ph-content-wrap {'.$tpadding.$bpadding.'}';
		}

		// MEDIUM BREAKPOINT HEIGHT
		$css_md = '';
		$height_md = $this->opt('hm_header_height_md', '300');
		if( $height_md != '300' ){
			$extraHeightFromMask = $this->opt('hm_header_bmasks','none') != 'none' ? '30' : '0';
			$height_md = $extraHeightFromMask + $height_md;
			$css_md .= '.'.$uid.'.page-subheader{height: '. $height_md.'px; min-height: '. $height_md.'px;} ';
		}
		// Top padding
		$tpadding_md = '';
		$top_padding_md = $this->opt('top_padding_md');
		if($top_padding_md != '170'){
			$tpadding_md = $top_padding_md || $top_padding_md === '0' ? 'padding-top:'.$top_padding_md.'px;' : '';
		}
		// Bottom padding
		$bpadding_md = '';
		$bottom_padding_md = $this->opt('bottom_padding_md');
		if( $bottom_padding_md != 0 ){
			$bpadding_md = $bottom_padding_md || $bottom_padding_md === '0' ? 'padding-bottom:'.$bottom_padding_md.'px;' : '';
		}
		// Top and bottom paddings
		if($tpadding_md || $bpadding_md){
			$css_md .= '.'.$uid.'.page-subheader .ph-content-wrap{'.$tpadding_md.$bpadding_md.'}';
		}
		// Subheader height & padding for MEDIUM
		if($css_md != ''){
			$css .= '@media screen and (min-width:992px) and (max-width:1199px) {'.$css_md.'}';
		}


		// SMALL BREAKPOINT HEIGHT
		$css_sm = '';
		$height_sm = $this->opt('hm_header_height_sm', '300');
		if( $height_sm != '300' ){
			$extraHeightFromMask = $this->opt('hm_header_bmasks','none') != 'none' ? '30' : '0';
			$height_sm = $extraHeightFromMask + $height_sm;
			$css_sm .= '.'.$uid.'.page-subheader{height: '. $height_sm.'px; min-height: '. $height_sm.'px;} ';
		}
		// Top padding
		$tpadding_sm = '';
		$top_padding_sm = $this->opt('top_padding_sm');
		if($top_padding_sm != '170'){
			$tpadding_sm = $top_padding_sm || $top_padding_sm === '0' ? 'padding-top:'.$top_padding_sm.'px;' : '';
		}
		// Bottom padding
		$bpadding_sm = '';
		$bottom_padding_sm = $this->opt('bottom_padding_sm');
		if( $bottom_padding_sm != 0 ){
			$bpadding_sm = $bottom_padding_sm || $bottom_padding_sm === '0' ? 'padding-bottom:'.$bottom_padding_sm.'px;' : '';
		}
		// Top and bottom paddings
		if($tpadding_sm || $bpadding_sm){
			$css_sm .= '.'.$uid.'.page-subheader .ph-content-wrap{'.$tpadding_sm.$bpadding_sm.'}';
		}
		// Subheader height & padding for SMALL
		if($css_sm != ''){
			$css .= '@media screen and (min-width:768px) and (max-width:991px) {'.$css_sm.'}';
		}


		// EXTRA SMALL BREAKPOINT HEIGHT
		$css_xs = '';
		$height_xs = $this->opt('hm_header_height_xs', '300');
		if( $height_xs != '300' ){
			$extraHeightFromMask = $this->opt('hm_header_bmasks','none') != 'none' ? '30' : '0';
			$height_xs = $extraHeightFromMask + $height_xs;
			$css_xs .= '.'.$uid.'.page-subheader{height: '. $height_xs.'px; min-height: '. $height_xs.'px;} ';
		}
		// Top padding
		$tpadding_xs = '';
		$top_padding_xs = $this->opt('top_padding_xs');
		if($top_padding_xs != '170'){
			$tpadding_xs = $top_padding_xs || $top_padding_xs === '0' ? 'padding-top:'.$top_padding_xs.'px;' : '';
		}
		// Bottom padding
		$bpadding_xs = '';
		$bottom_padding_xs = $this->opt('bottom_padding_xs');
		if( $bottom_padding_xs != 0 ){
			$bpadding_xs = $bottom_padding_xs || $bottom_padding_xs === '0' ? 'padding-bottom:'.$bottom_padding_xs.'px;' : '';
		}
		// Top and bottom paddings
		if($tpadding_xs || $bpadding_xs){
			$css_xs .= '.'.$uid.'.page-subheader .ph-content-wrap{'.$tpadding_xs.$bpadding_xs.'}';
		}
		// Subheader height & padding for EXTRA SMALL
		if($css_xs != ''){
			$css .= '@media screen and (max-width:767px) {'.$css_xs.'}';
		}


		return $css;
	}

}
