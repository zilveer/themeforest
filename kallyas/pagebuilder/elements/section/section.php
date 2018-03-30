<?php if(! defined('ABSPATH')){ return; }
/*
	Name: Section
	Description: This element will generate a section in which you can add elements
	Class: ZnSection
	Category: Layout, Fullwidth
	Keywords: row, container, block
	Level: 1
	Style: true
*/

class ZnSection extends ZnElements {

	function options() {

		$uid = $this->data['uid'];
		$colorzilla_url = 'http://www.colorzilla.com/gradient-editor/';

		// backwards compatibility for top and bottom padding
		$sct_padding_std = array('top' => '35px', 'bottom'=> '35px');
		if(isset($this->data['options']['top_padding']) && $this->data['options']['top_padding'] != '' ){
			$sct_padding_std['top'] = $this->data['options']['top_padding'].'px';
		}
		if(isset($this->data['options']['bottom_padding']) && $this->data['options']['bottom_padding'] != '' ){
			$sct_padding_std['bottom'] = $this->data['options']['bottom_padding'].'px';
		}

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						'id'          => 'size',
						'name'        => 'Section Width',
						'description' => 'Select the desired size for this section.',
						'type'        => 'select',
						'std'        => 'container',
						'options'	  => array(
							'container' => 'Fixed width',
							'full_width' => 'Full width',
							'container custom_width' => 'Custom width (px)',
							'container custom_width_perc' => 'Custom width Percentage (%)'
						),
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.'.$uid.' .zn_section_size'
						)
					),

					array(
						'id'          => 'custom_width',
						'name'        => __( 'Section Container Width (on Large breakpoints, 1200px)', 'zn_framework'),
						'description' => __( 'Choose the desired width for the section\'s container.', 'zn_framework' ),
						'type'        => 'slider',
						'std'        => '1170',
						'helpers'     => array(
							'min' => '1170',
							'max' => '1900'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid. ' > .custom_width.container',
							'css_rule'  => 'width',
							'unit'      => 'px'
						),
						'dependency' => array( 'element' => 'size' , 'value'=> array('container custom_width') )
					),

					array(
						'id'          => 'custom_width_percent',
						'name'        => __( 'Section Container Width ( in Percentage %)', 'zn_framework'),
						'description' => __( 'Choose the desired width for the section\'s container.', 'zn_framework' ),
						'type'        => 'slider',
						'std'        => '100',
						'helpers'     => array(
							'min' => '20',
							'max' => '100'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid. ' > .custom_width_perc.container',
							'css_rule'  => 'width',
							'unit'      => '%'
						),
						'dependency' => array( 'element' => 'size' , 'value'=> array('container custom_width_perc') )
					),

					array (
						'id'          => 'sec_height',
						'name'        => 'Section Height',
						'description' => 'Select the desired height for this section.',
						'type'        => 'select',
						'std'        => 'auto',
						'options'     => array(
							'auto' => 'Auto',
							'custom_height' => 'Custom Fixed Height'
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$uid.' .zn_section_size',
							'val_prepend'  => 'zn-section-height--',
						)
					),

					array(
						'id'          => 'custom_height',
						'name'        => __( 'Section Custom Height', 'zn_framework'),
						'description' => __( 'Choose the desired height for this section. You can choose either height or min-height as a property. Height will force a fixed size rather than just a minimum. <br>*TIP: Use 100vh to have a full-height element.', 'zn_framework' ),
						'type'        => 'smart_slider',
						'std'        => '100',
						'helpers'     => array(
							'min' => '0',
							'max' => '1400'
						),
						'supports' => array('breakpoints'),
						'units' => array('px', '%', 'vh'),
						'properties' => array('min-height','height'),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid. ' > .zn-section-height--custom_height',
							'css_rule'  => 'min-height',
							'unit'      => 'px'
						),
						'dependency' => array( 'element' => 'sec_height' , 'value'=> array('custom_height') )
					),

					array(
						'id'          => 'valign',
						'name'        => __( 'Section Vertical Align', 'zn_framework'),
						'description' => __( 'Choose how to vertically align content.', 'zn_framework' ),
						'type'        => 'select',
						'std'        => 'top',
						'options'     => array(
							'top' => 'Top',
							'middle' => 'Middle',
							'bottom' => 'Bottom',
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$uid.' .zn_section_size',
							'val_prepend'  => 'zn-section-content_algn--',
						),
						'dependency' => array( 'element' => 'sec_height' , 'value'=> array('custom_height') )
					),

					/**
					 * Margins and padding
					 */
					array (
						"name"        => __( "Edit padding & margins for each device breakpoint", 'zn_framework' ),
						"description" => __( "This will enable you to have more control over the padding of the container on each device. Click to see <a href='http://hogash.d.pr/1f0nW' target='_blank'>how box-model works</a>.", 'zn_framework' ),
						"id"          => "cc_spacing_breakpoints",
						"std"         => "lg",
						"tabs"        => true,
						"type"        => "zn_radio",
						"options"     => array (
							"lg"        => __( "LARGE", 'zn_framework' ),
							"md"        => __( "MEDIUM", 'zn_framework' ),
							"sm"        => __( "SMALL", 'zn_framework' ),
							"xs"        => __( "EXTRA SMALL", 'zn_framework' ),
						),
						"class"       => "zn_full zn_breakpoints"
					),
					// MARGINS
					array(
						'id'          => 'cc_margin_lg',
						'name'        => 'Margin (Large Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container. Accepts negative margin.',
						'type'        => 'boxmodel',
						'std'	  => 	array('left'=> 'auto', 'right'=> 'auto' ),
						'disable'	=> array('left', 'right'),
						'placeholder' => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('lg') ),
						'live' => array(
							'type'		=> 'boxmodel',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'margin',
						),
					),
					array(
						'id'          => 'cc_margin_md',
						'name'        => 'Margin (Medium Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'std'	  => 	array('left'=> 'auto', 'right'=> 'auto' ),
						'disable'	=> array('left', 'right'),
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('md') ),
					),
					array(
						'id'          => 'cc_margin_sm',
						'name'        => 'Margin (Small Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'std'	  => 	array('left'=> 'auto', 'right'=> 'auto' ),
						'disable'	=> array('left', 'right'),
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('sm') ),
					),
					array(
						'id'          => 'cc_margin_xs',
						'name'        => 'Margin (Extra Small Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'std'	  => 	array('left'=> 'auto', 'right'=> 'auto' ),
						'disable'	=> array('left', 'right'),
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('xs') ),
					),
					// PADDINGS
					array(
						'id'          => 'cc_padding_lg',
						'name'        => 'Padding (Large Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => $sct_padding_std,
						'placeholder' => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('lg') ),
						'live' => array(
							'type'		=> 'boxmodel',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'padding',
						),
					),
					array(
						'id'          => 'cc_padding_md',
						'name'        => 'Padding (Medium Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('md') ),
					),
					array(
						'id'          => 'cc_padding_sm',
						'name'        => 'Padding (Small Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('sm') ),
					),
					array(
						'id'          => 'cc_padding_xs',
						'name'        => 'Padding (Extra Small Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('xs') ),
					),


				)
			),

			'background' => array(
				'title' => 'Styles Options',
				'options' => array(

					array(
						'id'          => 'title1',
						'name'        => 'Background & Color Options',
						'description' => 'These are options to customize the background and colors for this section.',
						'type'        => 'zn_title',
						'class'        => 'zn_full zn-custom-title-large',
					),

					array(
						'id'          => 'background_color',
						'name'        => 'Background color',
						'description' => 'Here you can override the background color for this section.',
						'type'        => 'colorpicker',
						'std'         => '',
						'live'        => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'background-color',
							'unit'		=> ''
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
							''  => __( "None (Will just rely on the background color (if any) )", 'zn_framework' ),
							'image'  => __( "Image", 'zn_framework' ),
							'video_self' => __( "Self Hosted Video", 'zn_framework' ),
							'video_youtube' => __( "Youtube Video", 'zn_framework' ),
							'video_vimeo' => __( "Vimeo Video", 'zn_framework' ),
							'embed_iframe' => __( "Embed Iframe (Vimeo etc.)", 'zn_framework' )
						)
					),

					array(
						'id'          => 'background_image',
						'name'        => 'Background image',
						'description' => 'Please choose a background image for this section.',
						'type'        => 'background',
						'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
						'class'		  => 'zn_full',
						'dependency' => array( 'element' => 'source_type' , 'value'=> array('image') )
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
					array (
						"name"        => __( "Skewed Shaped background?", 'zn_framework' ),
						"description" => __( "Please select wether you want the background image or background OVERLAY color to be skewed. Will not work with Parallax enabled or background color.", 'zn_framework' ),
						"id"          => "skewed_bg",
						"std"         => "no",
						"type"        => "select",
						"options"     => array (
							'no'  => __( "No", 'zn_framework' ),
							'skewed'  => __( "Skewed", 'zn_framework' ),
							'skewed-flipped' => __( "Skewed Flipped", 'zn_framework' )
						),
						'live' => array(
						   'type'        => 'class',
						   'css_class' => '.'.$this->data['uid'],
						   'val_prepend'   => 'section--',
						),
						'dependency' => array( 'element' => 'source_type' , 'value'=> array('image', '') )
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
						'description' => 'Using this option you can add your desired video poster that will be shown on unsuported devices (mobiles, tablets). ',
						'type'        => 'media',
						'std'         => '',
						'class'       => 'zn_full',
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube', 'embed_iframe') )
					),
					array(
						'id'          => 'mobile_play',
						'name'        => 'Display Play button on Mobiles?',
						'description' => 'By default videos are not displayed in the background on mobile devices. It\'s too problematic and instead, we added a button trigger which will open the video into a modal.',
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
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube','embed_iframe') ),
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
						"dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube','embed_iframe') ),
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
						'description' => 'Enable video controls? Please know that for some captions it might not be reachable.',
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
						'id'          => 'source_overlay',
						'name'        => 'Background colored overlay',
						'description' => 'Add slide color overlay over the image or video to darken or enlight?',
						'type'        => 'select',
						'std'         => '0',
						"options"     => array (
							"1" => __( "Yes (Normal color)", 'zn_framework' ),
							"2" => __( "Yes (Horizontal gradient)", 'zn_framework' ),
							"3" => __( "Yes (Vertical gradient)", 'zn_framework' ),
							"4" => __( "Yes (Custom CSS generated gradient)", 'zn_framework' ),
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

					array(
						'id'          => 'source_overlay_custom_css',
						'name'        => 'Custom CSS Gradient Overlay',
						'description' => 'You can use a tool such as <a href="'.$colorzilla_url.'" target="_blank">http://www.colorzilla.com/gradient-editor/</a> to generate a unique custom gradient. Here\'s a quick video explainer <a href="http://hogash.d.pr/8Dze" title="">http://hogash.d.pr/8Dze</a> how to generate and paste the video here.',
						'type'        => 'textarea',
						'std'         => '',
						"dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('4') ),
					),

					array(
						'id'            => 'source_overlay_gloss',
						'name'          => 'Enable Gloss Overlay',
						'description'   => 'Display a gloss over the background',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => '1'
					),

					array(
						'id'          => 'section_scheme',
						'name'        => 'Text color scheme',
						'description' => 'Select the color scheme of this section. For example for using a light backgorund, use Dark scheme. You will most likely need to customize the elements within this section, as the text color is applied global, but not specific.',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Global (Color options)',
							'light' => 'Light',
							'dark' => 'Dark'
						),
						'live'        => array(
							'type'      => 'class',
							'css_class' => '.'.$uid,
							'val_prepend'  => 'element-scheme--',
							'unit'      => ''
						)
					),

					array(
						'id'          => 'title1',
						'name'        => 'Other Options',
						'description' => 'These are options to customize the background and colors for this section.',
						'type'        => 'zn_title',
						'class'        => 'zn_full zn-custom-title-large',
					),

					// Top masks
					array (
						"name"        => __( "Top Mask", 'zn_framework' ),
						"description" => __( "Style the top of this section with a custom shaped mask.", 'zn_framework' ),
						"id"          => "section_topmasks",
						"std"         => "none",
						"type"        => "select",
						"options"     => zn_get_top_masks(),
					),
					array(
						'id'          => 'topmasks_bg',
						'name'        => 'Top Mask Background Color',
						'description' => 'If you need the mask to have a different color than the main site background, please choose the color. Usually this color is needed when the next section, under this one has a different background color.',
						'type'        => 'colorpicker',
						'std'         => '',
						"dependency"  => array( 'element' => 'section_topmasks' , 'value'=> array('mask3', 'mask3 mask3l', 'mask3 mask3r', 'mask4', 'mask4 mask4l', 'mask4 mask4r', 'mask5', 'mask6', 'mask7 mask7l', 'mask7 mask7r', 'mask7 mask7big mask7l', 'mask7 mask7big mask7r') ),
					),

					// Bottom masks
					array (
						"name"        => __( "Bottom Mask", 'zn_framework' ),
						"description" => __( "Style the bottom of this section with a custom shaped mask.", 'zn_framework' ),
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
						"dependency"  => array( 'element' => 'hm_header_bmasks' , 'value'=> array('mask3', 'mask3 mask3l', 'mask3 mask3r', 'mask4', 'mask4 mask4l', 'mask4 mask4r', 'mask5', 'mask6', 'mask7 mask7l', 'mask7 mask7r', 'mask7 mask7big mask7l', 'mask7 mask7big mask7r') ),
					),

					array(
						'id'            => 'enable_ov_hidden',
						'name'          => 'Enable Overflow Hidden',
						'description'   => 'Select if you want to set overflow hidden for this section',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes'
					),

					array(
						'id'            => 'dsb_sidemargins',
						'name'          => 'Disable side margins on mobiles',
						'description'   => 'This option will turn off the left and right margins for this section, on mobiles and tablets. This option is usually used when having a background placed that stretches fully',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes'
					),

					array (
						"name"        => __( "Image-Box Shadow", 'zn_framework' ),
						"description" => __( "Please select a shadow style.", 'zn_framework' ),
						"id"          => "image_box_shadow",
						"std"         => "",
						"options"     => array(
							''  => __( 'No shadow', 'zn_framework' ),
							'1'  => __( 'Shadow 1x', 'zn_framework' ),
							'2'  => __( 'Shadow 2x', 'zn_framework' ),
							'3'  => __( 'Shadow 3x', 'zn_framework' ),
							'4'  => __( 'Shadow 4x', 'zn_framework' ),
							'5'  => __( 'Shadow 5x', 'zn_framework' ),
							'6'  => __( 'Shadow 6x', 'zn_framework' ),
						),
						"type"        => "select",
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.'.$uid,
							'val_prepend'	=> 'znBoxShadow-',
						),
					),

					array (
						"name"        => __( "Image-Box Shadow Hover", 'zn_framework' ),
						"description" => __( "Please select a shadow style for hover state.", 'zn_framework' ),
						"id"          => "image_box_shadow_hover",
						"std"         => "",
						"options"     => array(
							''  => __( 'No shadow', 'zn_framework' ),
							'1'  => __( 'Shadow 1x', 'zn_framework' ),
							'2'  => __( 'Shadow 2x', 'zn_framework' ),
							'3'  => __( 'Shadow 3x', 'zn_framework' ),
							'4'  => __( 'Shadow 4x', 'zn_framework' ),
							'5'  => __( 'Shadow 5x', 'zn_framework' ),
							'6'  => __( 'Shadow 6x', 'zn_framework' ),
						),
						"type"        => "select",
					),

					array (
						"name"        => __( "Z-Index Layering", 'zn_framework' ),
						"description" => __( "Please select a z-index order in layer.", 'zn_framework' ),
						"id"          => "zIndex",
						"std"         => "",
						"options"     => array(
							''  => __( 'No zIndex', 'zn_framework' ),
							'1'  => __( 'Z-index 1', 'zn_framework' ),
							'2'  => __( 'Z-index 2', 'zn_framework' ),
							'3'  => __( 'Z-index 3', 'zn_framework' ),
							'4'  => __( 'Z-index 4', 'zn_framework' ),
							'5'  => __( 'Z-index 5', 'zn_framework' ),
							'10'  => __( 'Z-index 10', 'zn_framework' ),
						),
						"type"        => "select",
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.'.$uid,
							'val_prepend'	=> 'u-zindex-',
						),
					),

				),
			),

			'advanced' => array(
				'title' => 'Advanced',
				'options' => array(

					array(
						'id'          => 'gutter_size',
						'name'        => 'Gutter Size',
						'description' => 'Select the gutter distance between columns',
						"std"         => "",
						"type"        => "select",
						"options"     => array (
							'' => __( 'Default (15px)', 'zn_framework' ),
							'gutter-xs' => __( 'Extra Small (5px)', 'zn_framework' ),
							'gutter-sm' => __( 'Small (10px)', 'zn_framework' ),
							'gutter-md' => __( 'Medium (25px)', 'zn_framework' ),
							'gutter-lg' => __( 'Large (40px)', 'zn_framework' ),
							'gutter-0' => __( 'No distance - 0px', 'zn_framework' ),
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$uid.' > .zn_section_size > .row.zn_columns_container'
						)
					),

					array(
						'id'            => 'enable_inlinemodal',
						'name'          => 'Enable INLINE Modal Window',
						'description'   => 'If you enable this, this section <strong>will be hidden in View mode (non-pagebuilder)</strong> and will contain any elements you want that will be displayed as a <em>modal window</em>, linked by an url from the page. <br><br> In order to properly link to this modal, copy the unique ID and paste it into the button link field, with a hash in front, for example <em>"#this_unique_id"</em> . ',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes'
					),

					array(
						'id'          => 'window_size',
						'name'        => 'Window Size (inline modal)',
						'description' => 'Select the modal window width size in px. Default 1200px',
						"std"         => "1200",
						"type"        => "text",
						'dependency' => array( 'element' => 'enable_inlinemodal' , 'value'=> array('yes') )
					),

					array(
						'id'          => 'window_autopopup',
						'name'        => 'Auto-Popup window?',
						'description' => 'Select wether you want to autopopup this modal window',
						"std"         => "0",
						"type"        => "select",
						"options"     => array (
							'' => __( 'No', 'zn_framework' ),
							'immediately' => __( 'Immediately ', 'zn_framework' ),
							'delay' => __( 'After a delay of "x" seconds', 'zn_framework' ),
							'scroll' => __( 'When user scrolls halfway down the page', 'zn_framework' ),
						),
						'dependency' => array( 'element' => 'enable_inlinemodal' , 'value'=> array('yes') )
					),

					array(
						'id'          => 'autopopup_delay',
						'name'        => 'Auto-Popup delay',
						'description' => 'Select the autopopup delay in seconds. This option is used only if <em>"After a delay of "x" seconds"</em> option is selected in the <strong>"Auto-Popup window?"</strong> option above.',
						"std"         => "5",
						"type"        => "text",
						'dependency' => array(
							array( 'element' => 'enable_inlinemodal' , 'value'=> array('yes') ),
							array( 'element' => 'window_autopopup' , 'value'=> array('delay') )
						),
					),

					array(
						'id'          => 'autopopup_cookie',
						'name'        => 'Prevent re-opening Auto-popup',
						'description' => 'Enable this if you want the autopopup to appear only once (assigning a cookie), rather than opening each time the page is refreshed. The cookie expires after one hour.',
						"std"         => "no",
						"type"        => "select",
						"options"     => array (
							'no' => __( 'No - Always open', 'zn_framework' ),
							'halfhour' => __( 'Yes - Set cookie for 30 min', 'zn_framework' ),
							'hour' => __( 'Yes - Set cookie for 1 hour', 'zn_framework' ),
							'day' => __( 'Yes - Set cookie for 1 day', 'zn_framework' ),
							'week' => __( 'Yes - Set cookie for 1 week', 'zn_framework' ),
						),
						'dependency' => array(
							array( 'element' => 'enable_inlinemodal' , 'value'=> array('yes') ),
							array( 'element' => 'window_autopopup' , 'value'=> array('immediately','delay','scroll') )
						),
					),
				)
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#vcux4GW2ctg',
				'docs'    => 'http://support.hogash.com/documentation/section-and-columns/',
				'copy'    => $uid,
				'general' => true,
				'custom_id' => true,
			)),
		);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {

		$uid = $this->data['uid'];
		$element_id = $this->opt('custom_id') ? $this->opt('custom_id') : $uid;

		$options = $this->data['options'];

		$section_classes = array();

		$section_classes[] = $uid;
		$section_classes[] = $this->opt('ustyle') ? $this->opt('ustyle') : '';
		$section_classes[] = zn_get_element_classes($options);
		$section_classes[] = $this->opt('enable_parallax') === 'yes' && $this->opt('source_type','') == 'image' ? 'zn_parallax' : '';
		$section_classes[] = $this->opt('enable_ov_hidden') === 'yes' ? 'zn_ovhidden' : '';
		$section_classes[] = $this->opt('dsb_sidemargins','') === 'yes' ? '' : 'section-sidemargins';
		$section_classes[] = $this->opt('zIndex','') ? 'u-zindex-'.$this->opt('zIndex','') : '';

		$section_classes[] = $this->opt('image_box_shadow','') ? 'znBoxShadow-'.$this->opt('image_box_shadow','') : '';
		$section_classes[] = $this->opt('image_box_shadow_hover','') ? 'znBoxShadow--hov-'.$this->opt('image_box_shadow_hover',''). ' znBoxShadow--hover' : '';

		$attributes = zn_get_element_attributes($options);

		if ( empty( $this->data['content'] ) ) {
			$this->data['content'] = array ( ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' ) );
		}

		$bottom_mask = $this->opt('hm_header_bmasks','none');
		if($bottom_mask != 'none'){
			$section_classes[] = 'zn_section--masked';
		}

		if( $this->opt('source_type', '') != '' || $this->opt('source_overlay', '0') != 0 || $this->opt('hm_header_bmasks','none') != 'none'  || $this->opt('source_overlay_gloss', '') == 1){
			$section_classes[] = 'zn_section--relative';
		}

		$other_attrs = array();
		if($this->opt('enable_inlinemodal','') == 'yes'){
			$section_classes[] = 'zn_section--inlinemodal mfp-hide';
			$section_classes[] = $this->opt('window_size', '1200') < 1200 ? 'zn_section--stretch-container' : '';
			$section_classes[] = $this->opt('window_autopopup','') != '' ? 'zn_section--auto-'.$this->opt('window_autopopup','') : '';
			// Add delay
			if( $this->opt('window_autopopup','') == 'delay' ){
				$del = $this->opt('autopopup_delay','5');
				$other_attrs[] = 'data-auto-delay="'.esc_attr($del).'"';
			}
		}

		if($this->opt('autopopup_cookie','no') != 'no'){
			$acook = $this->opt('autopopup_cookie','no');
			$other_attrs[] = 'data-autoprevent="'.esc_attr($acook).'"';
		}

		$section_classes[] = 'section--'.$this->opt('skewed_bg','no');
		$section_classes[] = $this->opt('section_scheme','') != '' ? 'element-scheme--'.$this->opt('section_scheme','') : '';

		?>
		<section class="zn_section <?php echo implode(' ', $section_classes); ?>" id="<?php echo esc_attr( $element_id ); ?>" <?php echo implode(' ', $other_attrs); ?> <?php echo $attributes; ?>>

			<?php
				WpkPageHelper::zn_background_source( array(
					'source_type' => $this->opt('source_type'),
					'source_background_image' => $this->opt('background_image'),
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
					'source_overlay_gloss' => $this->opt('source_overlay_gloss',''),
					'enable_parallax' => $this->opt('enable_parallax'),
					'source_overlay_custom_css' => $this->opt('source_overlay_custom_css',''),
					'mobile_play' => $this->opt('mobile_play', 'no'),
				) );
			?>

			<div class="zn_section_size <?php echo $this->opt('size','container');?> zn-section-height--<?php echo $this->opt('sec_height','auto');?> zn-section-content_algn--<?php echo $this->opt('valign','top');?> ">
				<div class="row zn_columns_container zn_content <?php echo $this->opt('gutter_size','') ?>" data-droplevel="1">

					<?php
						ZN()->pagebuilder->zn_render_content( $this->data['content'] );
					?>

				</div>
			</div>

			<?php
			// top mask
			if( $this->opt('section_topmasks','none') != 'none' ){
				zn_bottommask_markup($this->opt('section_topmasks','none') , $this->opt('topmasks_bg',''), 'top');
			}
			// bottom mask
			if($bottom_mask != 'none'){
				zn_bottommask_markup($bottom_mask, $this->opt('hm_header_bmasks_bg',''));
			}
		?>
		</section>


		<?php
		// Modal Overlay
		if( ZN()->pagebuilder->is_active_editor && $this->opt('enable_inlinemodal','') == 'yes'){
			?>
			<div class="zn_section-modalInfo">
				<span class="zn_section-modalInfo-title">MODAL WINDOW</span>
				<span class="zn_section-modalInfo-tip">
					<a href="http://support.hogash.com/documentation/section-as-modal-window/" target="_blank"><span class="dashicons dashicons-info"></span></a>
					<span class="zn_section-modalInfo-bubble"><?php echo __('This section is a Modal Window. It will appear only in Page Builder mode and visible upon being triggered by a modal window target link.','zn_framework'); ?></span>
				</span>
				<a href="#" class="zn_section-modalInfo-toggleVisible js-toggle-class" data-target=".<?php echo $uid; ?>" data-target-class="modal-overlay-hidden">
					<span class="dashicons dashicons-visibility"></span>
				</a>
			</div>
			<div class="zn_section-modalOverlay"></div>
			<?php
		}

	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		//print_z($this);
		$uid = $this->data['uid'];
		$css = '';
		$s_css = '';

		// backwards compatibility for top and bottom padding
		$sct_padding_std = array('top' => '35px', 'bottom'=> '35px');
		if(isset($this->data['options']['top_padding']) && $this->data['options']['top_padding'] != '' ){
			$sct_padding_std['top'] = $this->data['options']['top_padding'].'px';
		}
		if(isset($this->data['options']['bottom_padding']) && $this->data['options']['bottom_padding'] != '' ){
			$sct_padding_std['bottom'] = $this->data['options']['bottom_padding'].'px';
		}

		// Margin
		if( $this->opt('cc_margin_lg', '' ) || $this->opt('cc_margin_md', '' ) || $this->opt('cc_margin_sm', '' ) || $this->opt('cc_margin_xs', '' ) ){
			$css .= zn_push_boxmodel_styles(array(
					'selector' => '.'.$uid,
					'type' => 'margin',
					'lg' =>  $this->opt('cc_margin_lg', '' ),
					'md' =>  $this->opt('cc_margin_md', '' ),
					'sm' =>  $this->opt('cc_margin_sm', '' ),
					'xs' =>  $this->opt('cc_margin_xs', '' ),
				)
			);
		}
		// Padding
		if( $this->opt('cc_padding_lg', $sct_padding_std ) || $this->opt('cc_padding_md', '' ) || $this->opt('cc_padding_sm', '' ) || $this->opt('cc_padding_xs', '' ) ){
			$css .= zn_push_boxmodel_styles(array(
					'selector' => '.'.$uid,
					'type' => 'padding',
					'lg' =>  $this->opt('cc_padding_lg', $sct_padding_std ),
					'md' =>  $this->opt('cc_padding_md', '' ),
					'sm' =>  $this->opt('cc_padding_sm', '' ),
					'xs' =>  $this->opt('cc_padding_xs', '' ),
				)
			);
		}

		$s_css .= $this->opt('background_color') ? 'background-color:'.$this->opt('background_color').';' : '';

		if ( !empty($s_css) )
		{
			$css .= '.zn_section.'.$uid.'{'.$s_css.'}';
		}

		$width = $this->opt('enable_inlinemodal','') == 'yes' ? 'width:'.$this->opt('window_size', '1200').'px' : '';
		if ( !empty($width) )
		{
			$css .= '@media screen and (min-width:'.$this->opt('window_size', '1200').'px) {';
			$css .= '.zn_section--inlinemodal.'.$uid.' {'.$width.'}';
			$css .= '}';
		}

		// Container Width
		$container_size = $this->opt('size','container');

		if( $container_size == 'container custom_width' ) {

			$custom_width = (int)$this->opt( 'custom_width', '1170' );
			$zn_custom_width = (int)zget_option( 'custom_width' , 'layout_options', false, '1170' );
			if( !empty($custom_width) && ( $custom_width != $zn_custom_width.'px' || $custom_width != $zn_custom_width ) ){
				$custom_width_extra = $custom_width+30;
				$css .= '@media (min-width: '.$custom_width_extra.'px) {.'.$uid.' .container.custom_width {width:'.$custom_width.'px;} }';
				$css .= '@media (min-width:1200px) and (max-width: '.($custom_width_extra-1).'px) {.'.$uid.' .container.custom_width{width:100%;} }';
			}
		}
		else if($container_size == 'container custom_width_perc'){
			$css .= zn_smart_slider_css($this->opt( 'custom_width_percent', 100 ), '.'.$uid.' .container.custom_width_perc', 'width', '%');
		}

		if( $this->opt('sec_height','auto') == 'custom_height' ) {

			$selector = '.'.$uid.' .zn-section-height--custom_height';
			$css .= zn_smart_slider_css( $this->opt( 'custom_height' ), $selector );

		}

		return $css;
	}


}

?>
