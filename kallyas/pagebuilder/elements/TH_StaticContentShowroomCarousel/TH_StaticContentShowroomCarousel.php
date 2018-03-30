<?php if(! defined('ABSPATH')){ return; }
/*
Name: STATIC CONTENT - Showroom Carousel
Description: Create and display a STATIC CONTENT - Showroom Carousel element
Class: TH_StaticContentShowroomCarousel
Category: headers, Fullwidth
Level: 1
*/
/**
 * Class TH_StaticContentShowroomCarousel
 *
 * Create and display a STATIC CONTENT - Showroom Carousel element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StaticContentShowroomCarousel extends ZnElements
{
	public static function getName(){
		return __( "STATIC CONTENT - Showroom Carousel", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_style( 'static_content', THEME_BASE_URI . '/css/sliders/static_content_styles.css', '', ZN_FW_VERSION );
		wp_enqueue_script('caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array('jquery'), ZN_FW_VERSION, true);
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$scheight = (int)$this->opt('ww_height');
		$uid = $this->data['uid'];

		if(!empty($scheight)){
			if( $this->opt('sc_fullscreen', '0') != 1 ) {
				$css .= '@media only screen and (min-width : 1200px){ .'.$uid.' .static-content--height{height:'.$scheight.'px;} } ';
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
		$uid = $this->data['uid'];
		$options = $this->data['options'];
		if( empty( $options ) ) { return; }

		$style = $this->opt('ww_header_style', '');
		if ( ! empty ( $style ) ) {
			$style = 'uh_' . $style;
		}


		$bottom_mask = $this->opt('hm_header_bmasks','none');
		$bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';


		// Scrolling Effect
		$is_screffect = $this->opt('sc_scrolling',0 ) == 1;
		$scrolling_type = $this->opt('sc_scrolling_type', 'translate_op_scale' );

		$obj_parallax_class = '';
		$main_obj_parallax_attribs = '';
		$capt_obj_parallax_attribs = '';

		$fadeout = array("from" => '1', "to" => '0');
		$fadein = array("from" => '0', "to" => '1');

		if( $is_screffect ){

			$obj_parallax_class = 'znParallax-object';

			// Background
			$mainParallaxObject = array(
				"scene" => array(
					'triggerHook' => 'onLeave',
					'triggerElement' => '.'.$uid,
					'duration' => 'height',
					'is_background' => 'true',
				),
				"tween" => array(
					'speed' => '0.25',
				),
			);

			if($scrolling_type == 'translate_op_scale'){

				$mainParallaxObject['tween']['css'] = array(
					"y" => array( "to" => '300' ),
					"opacity" => $fadeout,
					"scale" => array( "from" => '1', "to" => '1.5' ),
				);
			}
			elseif($scrolling_type == 'translate_op'){

				$mainParallaxObject['tween']['css'] = array(
					"y" => array( "to" => '300' ),
					"opacity" => $fadeout,
				);
			}
			elseif($scrolling_type == 'translate'){

				$mainParallaxObject['tween']['css'] = array(
					"y" => array( "to" => '300' ),
				);
			}
			$main_obj_parallax_attribs = ' data-zn-parallax-obj=\''.json_encode($mainParallaxObject).'\'';

			// Caption
			$captionParallaxObject = array(
				"scene" => array(
					'triggerHook' => 'onLeave',
					'triggerElement' => '.'.$uid,
					'duration' => 'height',
					'is_background' => 'true',
				),
				"tween" => array(
					'speed' => '0.15',
					'css' => array(
						"y" => array( "to" => '140' ),
						"opacity" => $fadeout
					)
				),
			);
			$capt_obj_parallax_attribs = ' data-zn-parallax-obj=\''.json_encode($captionParallaxObject).'\'';
		}
		?>
		<div class="kl-slideshow static-content__slideshow sc--showroom-carousel <?php echo $style; ?> <?php echo $uid; ?> <?php echo $bm_class ?> <?php echo zn_get_element_classes($this->data['options']); ?>">

			<div class="bgback"></div>

			<div class="kl-slideshow-inner static-content__wrapper <?php echo ( $this->opt('sc_fullscreen', '0') ? 'static-content--fullscreen' : '' ); ?> <?php echo ( (int)$this->opt('ww_height') ? 'static-content--height':'' ) ?>">

				<?php if( $this->opt('source_type','') != '' || $this->opt('source_overlay','') != 0  ){ ?>
				<div class="static-content__source <?php echo $obj_parallax_class; ?>" <?php echo $main_obj_parallax_attribs; ?>>

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

					<div class="sc-huge-arrow"></div>
					<div class="th-sparkles"></div>
				</div><!-- /.static-content__source -->
				<?php } ?>

				<div class="static-content__inner container">
					<div class="kl-slideshow-safepadding  sc__container <?php echo $obj_parallax_class; ?>" <?php echo $capt_obj_parallax_attribs; ?>>

						<div class="static-content sc--showroomcrs-style">
							<?php
							// TITLE
							if ( isset ( $options['sc_shcar_textcontent'] ) && ! empty ( $options['sc_shcar_textcontent'] ) ) {
								echo '<div class="sc__textcontent">' . do_shortcode( $options['sc_shcar_textcontent'] ) . '</div>';
							}

							// BUTTON
							$prim_btn = zn_extract_link($this->opt('sc_shcar_prim_btn',''), 'btn btn-fullcolor' );
							$sec_btn = zn_extract_link($this->opt('sc_shcar_sec_btn',''), 'btn sc__secbtn btn-lined' );

							if ( $prim_btn['start'] || $sec_btn['start'] ) {

								echo '<div class="sc__actionarea clearfix">';

								if( !empty($prim_btn['start']) ){
									echo $prim_btn['start'] . zn_extract_link_title( $this->opt('sc_shcar_prim_btn','') ) . $prim_btn['end'];
								}

								if( !empty($sec_btn['start']) ){
									echo $sec_btn['start'] . zn_extract_link_title( $this->opt('sc_shcar_sec_btn','') ) . $sec_btn['end'];
								}

								echo '</div>';
							}
							?>

<?php
// var_dump($options);

if ( isset ( $options['single_shcar'] ) && is_array( $options['single_shcar'] ) ):

	echo '<div class="sc__shcar-wrapper">';
	echo '<div class="sc__showroom-carousel cfs--default" data-speed="'.$this->opt('sc_shcar_speed', 5000).'" '.( $this->opt('sc_shcar_pagi', 1) ? 'data-pag="1"':'' ).'>';

	foreach ( $options['single_shcar'] as $item ):

		echo '<div class="sc__shcar-item cfs--item">';

		if( isset($item['sc_shcar_image']) && !empty($item['sc_shcar_image']) ){
			$linkurl = $item['sc_shcar_image'];
			$datalightbox = 'image';
			if( isset($item['sc_shcar_video']) && !empty($item['sc_shcar_video']) ){
				$linkurl = $item['sc_shcar_video'];
				$datalightbox = 'iframe';
			}
			echo '<a href="'.$linkurl.'" class="shc__item-link" data-lightbox="'.$datalightbox.'">';
				$image = vt_resize( '', $item['sc_shcar_image'], '280', '190', true );
				echo '<img src="'.$image['url'].'" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="'. ZngetImageAltFromUrl( $item['sc_shcar_image'] ) .'" title="'.ZngetImageTitleFromUrl( $item['sc_shcar_image'] ).'" class="img-responsive">';
			echo '</a>';
		}
		if( isset($item['sc_shcar_title']) && !empty($item['sc_shcar_title']) ){
			echo '<h4 class="shc__item-title" '.WpkPageHelper::zn_schema_markup('title').'>'.$item['sc_shcar_title'].'</h4>';
		}

		echo '</div>';

	endforeach;

	echo '</div>';

	?>

	<?php
		$has_nav = $this->opt('sc_shcar_nav',0) == 1;
	?>

	<div class="shcar__nav_pag <?php echo $has_nav ? 'with-nav':''; ?>">
		<?php if($has_nav){ ?>
		<div class="shcar__nav">
		    <span class="shcar__nav-prev"><span class="glyphicon glyphicon-chevron-left"></span></span>
		    <span class="shcar__nav-next"><span class="glyphicon glyphicon-chevron-right"></span></span>
		</div>
		<?php } ?>
	</div>

	<?php
	echo '</div>';
endif;
?>

						</div>
					</div>
				</div><!-- /.kl-slideshow-inner__inner -->

				<?php if ( $this->opt('sc_fullscreen', '0') ): ?>
				<a class="tonext-btn js-tonext-btn" href="#" data-endof=".kl-slideshow-inner">
					<span class="mouse-anim-icon"></span>
				</a>
				<?php endif; ?>

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
			"name"           => __( "Carousel", 'zn_framework' ),
			"description"    => __( "Here you can add your carousel items.", 'zn_framework' ),
			"id"             => "single_shcar",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Item", 'zn_framework' ),
			"remove_text"    => __( "Item", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "sc_shcar_title",
			"element_img"  => 'sc_shcar_image',
			"subelements"    => array (
				array (
					"name"        => __( "Item Image", 'zn_framework' ),
					"description" => __( "Add an image. Recommended size 263px x 178px", 'zn_framework' ),
					"id"          => "sc_shcar_image",
					"std"         => "",
					"type"        => "media"
				),
				array (
					"name"        => __( "Item Title", 'zn_framework' ),
					"description" => __( "Add the title.", 'zn_framework' ),
					"id"          => "sc_shcar_title",
					"std"         => "",
					"type"        => "text",
					"placeholder" => ""
				),

				array (
					"name"        => __( "Video Link", 'zn_framework' ),
					"description" => __( "In case you want to link a video, add the url here. It will opened into a lightbox popup.", 'zn_framework' ),
					"id"          => "sc_shcar_video",
					"std"         => "",
					"type"        => "text",
					"placeholder" => "eg: http://www.youtube.com/watch?v=KZBvoHQTwxQ"
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
						"name"        => __( "Element Height", 'zn_framework' ),
						"description" => __( "<strong><em>Please read!</em></strong><br>Enter a numeric value for the slider height. This option works if Fullscreen is disabled. If you don't add any height, the height will be automatically rely on the content inside the element. ", 'zn_framework' ),
						"id"          => "ww_height",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "ex: 600px",
						"class"       => "zn_input_xs",
						'dependency' => array( 'element' => 'sc_fullscreen' , 'value'=> array('0') )
					),
					array (
						"name"        => __( "Enable fullscreen?", 'zn_framework' ),
						"description" => __( "Do you want to display the static content as fullscreen?", 'zn_framework' ),
						"id"          => "sc_fullscreen",
						"std"         => "0",
						"type"        => "select",
						"options"     => array (
							'1'  => __( "Yes", 'zn_framework' ),
							'0' => __( "No", 'zn_framework' )
						)
					),
					array (
						"name"        => __( "Enable scrolling effect?", 'zn_framework' ),
						"description" => __( "Do you want to enable the scrolling effects? Might cause performance issues.<br> <strong style=' color: #9B4F4F;'>This options works only if the slider is positioned at the very top opf the page!!</strong>", 'zn_framework' ),
						"id"          => "sc_scrolling",
						"std"         => "0",
						"type"        => "select",
						"options"     => array (
							'1'  => __( "Yes", 'zn_framework' ),
							'0' => __( "No", 'zn_framework' )
						)
					),
					array (
						"name"        => __( "Parallax Scrolling effect type?", 'zn_framework' ),
						"description" => __( "Select the effect type", 'zn_framework' ),
						"id"          => "sc_scrolling_type",
						"std"         => "translate_op_scale",
						"type"        => "select",
						"options"     => array (
							'translate_op_scale'  => __( "Translate + Fade + Scale", 'zn_framework' ),
							'translate_op' => __( "Translate + Fade", 'zn_framework' ),
							'translate' => __( "Translate", 'zn_framework' )
						),
						'dependency' => array( 'element' => 'sc_scrolling' , 'value'=> array('1') )
					),

					array (
						"name"        => __( "Text content", 'zn_framework' ),
						"description" => __( "Please enter a content.", 'zn_framework' ),
						"id"          => "sc_shcar_textcontent",
						"std"         => "",
						"type"        => "textarea"
					),

					array (
						"name"        => __( "Primary Button", 'zn_framework' ),
						"description" => __( "Add a link, text and select the target for this link", 'zn_framework' ),
						"id"          => "sc_shcar_prim_btn",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
					array (
						"name"        => __( "Secondary Button", 'zn_framework' ),
						"description" => __( "Add a link, text and select the target for this link", 'zn_framework' ),
						"id"          => "sc_shcar_sec_btn",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
					array (
						"name"        => __( "Carousel Speed", 'zn_framework' ),
						"description" => __( "Set the carousel speed in milliseconds (ms). 1000ms = 1s ", 'zn_framework' ),
						"id"          => "sc_shcar_speed",
						"std"         => "5000",
						"type"        => "text",
						"class"       => "zn_input_xs"
					),
					array (
						"name"        => __( "Enable Pagination?", 'zn_framework' ),
						"description" => __( "Do you want to enable the carousels pagination?", 'zn_framework' ),
						"id"          => "sc_shcar_pagi",
						"std"         => "1",
						"type"        => "select",
						"options"     => array (
							'1'  => __( "Yes", 'zn_framework' ),
							'0' => __( "No", 'zn_framework' )
						)
					),
					array (
						"name"        => __( "Enable Arrow Navigation?", 'zn_framework' ),
						"description" => __( "Do you want to enable the carousels arrow navigation?", 'zn_framework' ),
						"id"          => "sc_shcar_nav",
						"std"         => "0",
						"value"			=> "1",
						"type"        => "toggle2",
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#mHuppIZVSkI',
				'docs'    => 'http://support.hogash.com/documentation/static-content-showroom-carousel/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
