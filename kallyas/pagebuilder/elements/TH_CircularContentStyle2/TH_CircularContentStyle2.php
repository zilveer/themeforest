<?php if(! defined('ABSPATH')){ return; }
/*
Name: Circular Content Style 2
Description: Create and display a Circular Content Style 2 element
Class: TH_CircularContentStyle2
Category: headers, Fullwidth
Level: 1
Scripts: true
*/

	/**
	 * Class TH_CircularContentStyle2
	 *
	 * Create and display a Circular Content Style 2 element
	 *
	 * @package  Kallyas
	 * @category Page Builder
	 * @author Team Hogash
	 * @since 3.8.0
	 */
	class TH_CircularContentStyle2 extends ZnElements
	{
		public static function getName(){
			return __( "Circular Content Style 2", 'zn_framework' );
		}

		/**
		 * Load dependant resources
		 */
		function scripts(){
			wp_enqueue_style( 'circular_carousel', THEME_BASE_URI . '/css/sliders/circular_content_carousel.css', array('kallyas-styles'), ZN_FW_VERSION );
			wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
		}


		/**
		 * Output the inline css to head or after the element in case it is loaded via ajax
		 */
		function css(){
			$css = '';
			$uid = $this->data['uid'];

			$height = $this->opt('ww_slider_height', '450');

			if($height != '450'){
				$css .= '.'.$uid.' .ca-container{height:'.$height.'px}';
			}

	        if( $this->opt('size','container') == 'container custom_width' ) {
	            $custom_width = (int)$this->opt( 'custom_width', '1170' );
	            if( !empty($custom_width) && ( $custom_width != '1170px' || $custom_width != '1170' ) ){
	                $custom_width_extra = $custom_width+30;
	                $css .= '@media (min-width: '.$custom_width_extra.'px) {.'.$uid.' .container.custom_width {width:'.$custom_width.'px;} }';
	                $css .= '@media (min-width:1200px) and (max-width: '.($custom_width_extra-1).'px) {.'.$uid.' .container.custom_width{width:100%;} }';
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

			$GLOBALS['options'] = array(
				'circ_2' => $this->data['options']
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
				"description"    => __( "Here you can create your Circular Content Slides.", 'zn_framework' ),
				"id"             => "single_circ2",
				"std"            => "",
				"type"           => "group",
				"add_text"       => __( "Slide", 'zn_framework' ),
				"remove_text"    => __( "Slide", 'zn_framework' ),
				"group_sortable" => true,
				"element_title" => "ww_slide_title",
				"subelements"    => array (
				 'has_tabs'  => true,
				'general' => array(
					'title' => 'General options',
					'options' => array(
						array (
							"name"        => __( "Slide image", 'zn_framework' ),
							"description" => __( "Select an image for this Slide. Recommended size 370px x 440px .", 'zn_framework' ),
							"id"          => "ww_slide_image",
							"std"         => "",
							"type"        => "media"
						),
						array (
							"name"        => __( "Slide title (bubble)", 'zn_framework' ),
							"description" => __( "This title will appear over the image", 'zn_framework' ),
							"id"          => "ww_slide_title",
							"std"         => "",
							"type"        => "text"
						),
						array (
							"name"        => __( "Bubble (title) - Left Position", 'zn_framework' ),
							"description" => __( "Please enter a value in pixels for the left position of the title", 'zn_framework' ),
							"id"          => "ww_slide_title_left",
							"std"         => "10",
							"type"        => "slider",
							"helpers"     => array (
								"step" => "1",
								"min" => "0",
								"max" => "600"
							),
							'live' => array(
								'type'      => 'css',
								'css_class' => '.'.$this->data['uid'].' .title_circle',
								'css_rule'  => 'left',
								'unit'      => 'px'
							)
						),
						array (
							"name"        => __( "Bubble (title) - Top Position", 'zn_framework' ),
							"description" => __( "Please enter a value in pixels for the top position of the title", 'zn_framework' ),
							"id"          => "ww_slide_title_top",
							"std"         => "200",
							"type"        => "slider",
							"helpers"     => array (
								"step" => "1",
								"min" => "0",
								"max" => "600"
							),
							'live' => array(
								'type'      => 'css',
								'css_class' => '.'.$this->data['uid'].' .title_circle',
								'css_rule'  => 'top',
								'unit'      => 'px'
							)
						),
						array (
							"name"        => __( "Bubble (Title) Size", 'zn_framework' ),
							"description" => __( "Here you can select the size of your title.", 'zn_framework' ),
							"id"          => "ww_slide_title_size",
							"std"         => "",
							"type"        => "select",
							"options"     => array (
								"small"  => __( "Small", 'zn_framework' ),
								"medium" => __( "Medium", 'zn_framework' ),
								"large"  => __( "Large", 'zn_framework' )
							),
							"class"       => ""
						),
						array (
							"name"        => __( "Bubble Arrow Position", 'zn_framework' ),
							"description" => __( "The position of the arrow.", 'zn_framework' ),
							"id"          => "ww_slide_title_arrpos",
							"std"         => "top-left",
							"type"        => "select",
							"options"     => array (
								"top-left"  => __( "Top Left", 'zn_framework' ),
								"top-right"  => __( "Top Right", 'zn_framework' ),
								"bottom-left"  => __( "Bottom Left", 'zn_framework' ),
								"bottom-right"  => __( "Bottom Right", 'zn_framework' ),
								"top"  => __( "Top", 'zn_framework' ),
								"left"  => __( "Left", 'zn_framework' ),
								"right"  => __( "Right", 'zn_framework' ),
								"bottom"  => __( "Bottom", 'zn_framework' ),
							),
							"class"       => ""
						),
						array (
							"name"        => __( "Slide bottom title", 'zn_framework' ),
							"description" => __( "This title will appear on the bottom left of the slide", 'zn_framework' ),
							"id"          => "ww_slide_bottom_title",
							"std"         => "",
							"type"        => "text"
						),
						array (
							"name"        => __( "Slide more text", 'zn_framework' ),
							"description" => __( "Please enter a text that you want to use as read more text", 'zn_framework' ),
							"id"          => "ww_slide_read_text",
							"std"         => "",
							"type"        => "text"
						),
					),
				),
				'content' => array(
					'title' => 'Content panel options',
					'options' => array(
						array (
							"name"        => __( "Slide content title", 'zn_framework' ),
							"description" => __( "This title will appear after someone will press the read more text button, above the content.", 'zn_framework' ),
							"id"          => "ww_slide_content_title",
							"std"         => "",
							"type"        => "text"
						),
						array (
							"name"        => __( "Slide content text", 'zn_framework' ),
							"description" => __( "This text will appear after someone will press the read more button. Please note that
										you can use HTML in this textarea.", 'zn_framework' ),
							"id"          => "ww_slide_desc_full",
							"std"         => "",
							"type"        => "visual_editor",
							'class'       => 'zn_full'
						),
						array (
							"name"        => __( "Slide read more text", 'zn_framework' ),
							"description" => __( "Please enter a text that you want to use as read more text that will appear bellow the content", 'zn_framework' ),
							"id"          => "ww_slide_read_text_content",
							"std"         => "",
							"type"        => "text"
						),
						array (
							"name"        => __( "Content read more link", 'zn_framework' ),
							"description" => __( "Here you can add a link bellow the content of your slide", 'zn_framework' ),
							"id"          => "ww_slide_link",
							"std"         => "",
							"type"        => "link",
							"options"     => zn_get_link_targets(),
						),
					),
				),
				)
			);

			return  array (
				'has_tabs'  => true,
				'general' => array(
					'title' => 'General options',
					'options' => array(

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
							"name"        => __( "Slides Height", 'zn_framework' ),
							"description" => __( "Specify the height of the carousel.", 'zn_framework' ),
							"id"          => "ww_slider_height",
							"std"         => "450",
							"type"        => "text"
						),

						array (
							"name"        => __( "Slides Displayed", 'zn_framework' ),
							"description" => __( "Specify the number of visible slides to be displayed in the carousel.", 'zn_framework' ),
							"id"          => "ww_slider_max",
							"std"         => "3",
							"type"        => "select",
							"options"		=> array(
								'2' => '2 Items',
								'3' => '3 Items',
								'4' => '4 Items',
								'5' => '5 Items',
								'6' => '6 Items',
							)
						),

						array (
							'id'          => 'size',
							'name'        => 'Container Size',
							'description' => 'Select the desired size for the carouse\'s container.',
							'type'        => 'select',
	                        'std'        => 'container',
							'options'	  => array(
	                            'container' => 'Fixed width (1170px)',
	                            'container custom_width' => 'Custom width'
	                        ),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$uid.' .kl-slideshow-inner'
							)
						),

	                    array(
	                        'id'          => 'custom_width',
	                        'name'        => __( 'Section Container Width (on Large breakpoints, 1200px)', 'zn_framework'),
	                        'description' => __( 'Choose the desired width for the section\'s container.', 'zn_framework' ),
	                        'type'        => 'slider',
	                        'std'        => '1170px',
	                        'helpers'     => array(
	                            'min' => '1170px',
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

					)
				),

				'items' => array(
					'title' => 'Carousel Items',
					'options' => array(
						$extra_options,
					),
				),

				'background' => array(
					'title' => 'Background & Styles Options',
					'options' => array(

						array (
							"name"        => __( "Element Background Style", 'zn_framework' ),
							"description" => __( "Select the background style you want to use for this slider. Please note that styles can be created from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
							"id"          => "ww_header_style",
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
					'video'   => 'http://support.hogash.com/kallyas-videos/#Xep8BBnujO0',
					'docs'    => 'http://support.hogash.com/documentation/circular-content-style-2/',
					'copy'    => $uid,
					'general' => true,
				)),

			);
		}
	}