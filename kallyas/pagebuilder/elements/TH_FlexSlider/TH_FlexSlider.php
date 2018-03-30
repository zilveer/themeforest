<?php if(! defined('ABSPATH')){ return; }
/*
Name: Simple Slider (formerly Flex Slider)
Description: Create and display a Simple Slider (formerly Flex Slider) element
Class: TH_FlexSlider
Category: header, Fullwidth
Level: 1
Scripts: true
*/
/**
 * Class TH_FlexSlider
 *
 * Create and display a Simple Slider (formerly Flex Slider) element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_FlexSlider extends ZnElements
{
	public static function getName(){
		return __( "Simple Slider (formerly Flex Slider)", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		// LOAD CSS AND JS
		wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js',  array ( 'jquery' ), ZN_FW_VERSION, true );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];

		$height_old_vals['lg'] = '470';
		if( isset($this->data['options']['fs_height']) && !empty($this->data['options']['fs_height']) ){
			$height_old_vals['lg'] =  $this->data['options']['fs_height'];
		}

		$css .= zn_smart_slider_css(
			$this->opt( 'fs_height_new', $height_old_vals ),
			'.'.$uid.' .zn_simple_slider-itemimg, .'.$uid.' .zn_simple_slider_container'
		);

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		if( empty( $options['single_flex'] ) ){
			return;
		}

		$style = $this->opt('fs_header_style', '');
		if ( ! empty ( $style ) ) {
			$style = 'uh_' . $style;
		}

		$thumbs = '';
		if ( $options['fs_show_thumbs'] ) {
			$thumbs = 'zn_has_thumbs';
		}
		$full_image = '';

		// Shadow style
		$fs_shadow = '';
		if( isset($options['fs_shadow']) && $options['fs_shadow'] != '' ) {
			$fs_shadow = 'zn-shadow-lifted';
		}


		$def_fs_height = '470';
		if( isset($this->data['options']['fs_height']) && !empty($this->data['options']['fs_height']) ){
			$def_fs_height =  $this->data['options']['fs_height'];
		}
		$fs_height =  $this->opt('fs_height_new', $def_fs_height);

		if( is_array($fs_height) && isset($fs_height['lg']) ){
			$fs_height = $fs_height['lg'];
		}

		// Flex slider style
		$sliderStyle = 'classic';
		if( isset($options['fs_style']) && $options['fs_style'] == 'modern' ) {
			$sliderStyle = 'modern';
		}

		$bottom_mask = $this->opt('hm_header_bmasks','none');
		$bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

		?>
		<div class="kl-slideshow simpleslider__slideshow <?php echo $this->data['uid']; ?> <?php echo $style; ?> <?php echo $bm_class ?> <?php echo zn_get_element_classes($this->data['options']); ?>">

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
				<div class="row">
					<div class="col-sm-12">
						<div class="zn_simple_slider_container cfs--showOnMouseover <?php echo $thumbs; ?> <?php echo $fs_shadow;?> kl-flex--<?php echo $sliderStyle; ?>">

							<ul class="zn_general_carousel cfs--default " data-fancy="false" data-transition="<?php echo $this->opt('fs_transition','fade');?>" data-direction="left" data-autoplay="<?php echo $this->opt('ww_slider_autoplay') == 1 ? 1:0 ; ?>" data-timout="<?php echo $this->opt('fs_speed', 9000) ?>" data-easing="easeOutExpo" data-thumbs="<?php echo $thumbs ?>">

								<?php
								if ( isset ( $options['single_flex'] ) && is_array( $options['single_flex'] ) ) {
									foreach ( $options['single_flex'] as $slide ) {

										$fs_slide_link = zn_extract_link( $slide['fs_slide_link'], 'slide__link' );
										$link_title   = zn_extract_link_title( $slide['fs_slide_link'] );

										$thumb      = '';

										if ( isset ( $slide['fs_slide_image'] ) && ! empty ( $slide['fs_slide_image'] ) ) {
											$sl_img = $slide['fs_slide_image'];
											$image      = vt_resize( '', $sl_img, '1170', $fs_height, true );
											$full_image = '<img class="zn_simple_slider-itemimg cover-fit-img" src="'.$image['url'].'" width="' . $image['width'] . '" height="' . $image['height'] . '" '.ZngetImageAltFromUrl($sl_img, true).' '.ZngetImageTitleFromUrl($sl_img, true).'>';

											if ( $options['fs_show_thumbs'] ) {
												$small_thumb = vt_resize( '', $sl_img, '150', '60', true );
												$thumb       = 'data-thumb="' . $small_thumb['url'] . '"';
											}
										}

										echo '<li class="cfs--item" ' . $thumb . '>';

										if($sliderStyle == 'classic'){
											echo $fs_slide_link['start'];
												echo $full_image;
											echo $fs_slide_link['end'];
										} else {
											echo $full_image;
											echo '<div class="flex-gradient-overlay"></div>';
										}

										echo '<div class="flex-caption-wrapper">';

										// Label
										if ( isset ($slide['fs_slide_label']) && ! empty ($slide['fs_slide_label']) && $sliderStyle == 'modern' ) {
											echo '<h5 class="flex-label" style="'.( !empty($slide['fs_slide_label_color']) ? 'background-color:'.$slide['fs_slide_label_color'] : '' ).'">' . $slide['fs_slide_label'] . '</h5>';
										}

										if ( isset ( $slide['fs_slide_title'] ) && ! empty ( $slide['fs_slide_title'] ) ) {
											echo '<h2 class="flex-caption kl-font-alt">' . $slide['fs_slide_title'];
										}
										if($sliderStyle == 'modern'){
											echo $fs_slide_link['start'];
												echo $link_title;
												echo '<span class="flex-arrow"></span>';
											echo $fs_slide_link['end'];
										}
										if ( isset ( $slide['fs_slide_title'] ) && ! empty ( $slide['fs_slide_title'] ) ) {
											echo '</h2>';
										}

										echo '</div>';

										if($sliderStyle == 'modern'){
											echo '<div class="flex-underbar"></div>';
										}

										echo '</li>';
									}
								}
								?>
							</ul>

							<?php if( $this->opt('fs_bullets', 'true') == 'true' || $this->opt('fs_show_thumbs', '0') == 1 ){ ?>
							<div class="zn_simple_carousel-pagi cfs--pagination <?php echo $thumbs ?>"></div>
							<?php } ?>

							<?php if($this->opt('fs_nav', 'true') == 'true'){ ?>
							<div class="zn_simple_carousel-nav cfs-navs">
								<span class="zn_simple_carousel-arr zn_general_carousel-prev cfs--prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
								</span>
								<span class="zn_simple_carousel-arr zn_general_carousel-next cfs--next">
									<span class="glyphicon glyphicon-chevron-right"></span>
								</span>
							</div>
							<?php } ?>

						</div><!-- /.zn_simple_slider_container -->
					</div>
				</div>
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
			"description"    => __( "Here you can create your Flex Slider Slides.", 'zn_framework' ),
			"id"             => "single_flex",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Slide", 'zn_framework' ),
			"remove_text"    => __( "Slide", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "fs_slide_title",
			"subelements"    => array (
				array (
					"name"        => __( "Slide image", 'zn_framework' ),
					"description" => __( "Select an image for this Slide", 'zn_framework' ),
					"id"          => "fs_slide_image",
					"std"         => "",
					"type"        => "media",
					'class'       => 'zn_full'
				),
				array (
					"name"        => __( "Slide title", 'zn_framework' ),
					"description" => __( "This title will appear over the image", 'zn_framework' ),
					"id"          => "fs_slide_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Slide link", 'zn_framework' ),
					"description" => __( "Here you can add a link to your slide", 'zn_framework' ),
					"id"          => "fs_slide_link",
					"std"         => "",
					"type"        => "link",
					"options"     => zn_get_link_targets(),
				),
				array (
					"name"        => __( "Slide label", 'zn_framework' ),
					"description" => __( "This label will appear over the title.<br> <strong>Only for Modern style!</strong>", 'zn_framework' ),
					"id"          => "fs_slide_label",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Slide label color", 'zn_framework' ),
					"description" => __( "The color that the label will have.<br> <strong>Only for Modern style!</strong>", 'zn_framework' ),
					"id"          => "fs_slide_label_color",
					"std"         => "#cd2122",
					"type"        => "colorpicker"
				),
			)
		);

		$uid = $this->data['uid'];

		// Old height
		$std_height = isset($this->data['options']['fs_height']) && !empty($this->data['options']['fs_height']) ? $this->data['options']['fs_height'] : '470';

		return array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						"name"        => __( "Slider height (px)", 'zn_framework' ),
						"description" => __( "Add a height for the slider.", 'zn_framework' ),
						"id"          => "fs_height_new",
						'type'        => 'smart_slider',
						'std'        => $std_height,
						'helpers'     => array(
							'max' => '1200'
						),
						'supports' => array('breakpoints'),
						'units' => array('px'),
					),

					array (
						"name"        => __( "Slider style", 'zn_framework' ),
						"description" => __( "Select a style for the slider.", 'zn_framework' ),
						"id"          => "fs_style",
						"std"         => "classic",
						"type"        => "select",
						"options"     => array (
							'calssic' => __( 'Classic', 'zn_framework' ),
							'modern' => __( 'Modern ( from v4.0+ )', 'zn_framework' )
						),
						"class"       => ""
					),
					array (
						"name"        => __( "Slider Transition", 'zn_framework' ),
						"description" => __( "Select the desired transition that you want to use for this slider.", 'zn_framework' ),
						"id"          => "fs_transition",
						"std"         => "fade",
						"type"        => "select",
						"options"     => array (
							'fade'  => __( 'Fade', 'zn_framework' ),
							'crossfade'  => __( 'Cross Fade', 'zn_framework' ),
							'slide' => __( 'Slide', 'zn_framework' )
						),
						"class"       => ""
					),
					array (
						"name"        => __( "Slider Speed", 'zn_framework' ),
						"description" => __( "Adjust the speed between sliding timeout.", 'zn_framework' ),
						"id"          => "fs_speed",
						"std"         => "5000",
						"type"        => "text"
					),
					array (
						"name"        => __( "Autoplay carousel?", 'zn_framework' ),
						"description" => __( "Does the carousel autoplay itself?", 'zn_framework' ),
						"id"          => "ww_slider_autoplay",
						"std"         => "1",
						"value"         => "1",
						"type"        => "toggle2"
					),
					array (
						"name"        => __( "Slider Navigation", 'zn_framework' ),
						"description" => __( "Display arrows?", 'zn_framework' ),
						"id"          => "fs_nav",
						"std"         => "1",
						"type"        => "zn_radio",
						"options"     => array (
							'true'  => __( 'Yes', 'zn_framework' ),
							'false' => __( 'No', 'zn_framework' )
						),
					    "class"        => "zn_radio--yesno",
					),
					array (
						"name"        => __( "Slider Bullets", 'zn_framework' ),
						"description" => __( "Display navigation bullets?.", 'zn_framework' ),
						"id"          => "fs_bullets",
						"std"         => "true",
						"type"        => "zn_radio",
						"options"     => array (
							'true'  => __( 'Yes', 'zn_framework' ),
							'false' => __( 'No', 'zn_framework' )
						),
					    "class"        => "zn_radio--yesno",
					),
					array (
						"name"        => __( "Show Thumbnails?", 'zn_framework' ),
						"description" => __( "Select if yes if you want to display thumbnails of images on the right side of the slider. Will replace bullets.", 'zn_framework' ),
						"id"          => "fs_show_thumbs",
						"std"         => "0",
						"type"        => "zn_radio",
						"options"     => array ( '1' => __( 'Yes', 'zn_framework' ), '0' => __( 'No', 'zn_framework' ) ),
					    "class"        => "zn_radio--yesno",
					),
					array (
						"name"        => __( "Shadow style", 'zn_framework' ),
						"description" => __( "Select the desired shadow that you want to use for this slider.", 'zn_framework' ),
						"id"          => "fs_shadow",
						"std"         => "lifted",
						"type"        => "zn_radio",
						"options"     => array (
							''             => __( 'No Shadow', 'zn_framework' ),
							'lifted'       => __( 'Lifted', 'zn_framework' )
						),
					    "class"        => "zn_radio--yesno",
					),

				),
			),
			'slides' => array(
				'title' => 'Slides configuration',
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#YeqY8rqbI7Q',
				'docs'    => 'http://support.hogash.com/documentation/simple-slider/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
	}
}
