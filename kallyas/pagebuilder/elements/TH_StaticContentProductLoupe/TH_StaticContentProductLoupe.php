<?php if(! defined('ABSPATH')){ return; }
/*
Name: STATIC CONTENT - Product Loupe
Description: Create and display a STATIC CONTENT - Product Loupe element
Class: TH_StaticContentProductLoupe
Category: headers, Fullwidth
Level: 1
Scripts: true
Keywords: zoom
*/

/**
 * Class TH_StaticContentProductLoupe
 *
 * Create and display a STATIC CONTENT - Product Loupe element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StaticContentProductLoupe extends ZnElements
{
	public static function getName(){
		return __( "STATIC CONTENT - Product Loupe", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_style( 'static_content', THEME_BASE_URI . '/css/sliders/static_content_styles.css', '', ZN_FW_VERSION );
		wp_enqueue_script('kallyas-jquery-loupe-js', THEME_BASE_URI.'/addons/jquery_loupe/jquery.loupe.js', array('jquery'), ZN_FW_VERSION, true);
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
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];
		$uid = $this->data['uid'];

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

<div class="kl-slideshow static-content__slideshow <?php echo $style; ?> <?php echo $uid; ?> <?php echo $bm_class ?> <?php echo zn_get_element_classes($this->data['options']); ?>">

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
			<div class="th-sparkles"></div>
		</div><!-- /.static-content__source -->
		<?php } ?>

		<div class="static-content__inner container">

			<div class="kl-slideshow-safepadding sc__container <?php echo $obj_parallax_class; ?>" <?php echo $capt_obj_parallax_attribs; ?>>

				<div class="static-content productzoom-style">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-md-5 col-md-offset-0">
							<?php
							// TITLE
							if ( ! empty ( $options['sc_title'] ) ) {
								echo '<h3 class="static-content__subtitle" '.WpkPageHelper::zn_schema_markup('subtitle').'>' . do_shortcode( $options['sc_title'] ) . '</h3>';
							}

							// FEATURES LIST
							if ( ! empty ( $options['sc_lp_features'] ) ) {

								echo '<ul class="sc__features">';

								$textAr = explode( "\n", $options['sc_lp_features'] );
								foreach ( $textAr as $index => $line ) {
									echo '<li><span class="glyphicon glyphicon-ok kl-icon-white"></span> ' . $line . '</li>';
								}

								echo '</ul>';
							}

							// First Button
							$sc_lp_button1 = $this->opt('sc_lp_button1', '');
							$sc_lp_button1_link = zn_extract_link( $this->opt('sc_lp_button1_link', ''), $this->opt('sc_lp_button1_style', '') );

							if ( ! empty ( $sc_lp_button1 ) ) {

								$iconHolder = $this->opt('sc_lp_button1_icon','');
								$bicon = !empty( $iconHolder['family'] )  ? '<span class="button-icon kl-' . $this->opt('sc_lp_button1_icon_style','') . '" '.zn_generate_icon( $this->opt('sc_lp_button1_icon','') ).'></span>' : '';

								echo $sc_lp_button1_link['start'] . $bicon  . '<span>' . $sc_lp_button1 . '</span>' . $sc_lp_button1_link['end'];
							}

							// Second Button
							$sc_2p_button1 = $this->opt('sc_2p_button1', '');
							$sc_lp_button2_link = zn_extract_link( $this->opt('sc_lp_button2_link', ''), $this->opt('sc_lp_button2_style', '') );

							$btText = $this->opt('sc_bt_text','');
							if ( ! empty ( $sc_lp_button1 ) && ! empty ( $sc_2p_button1 ) && ! empty ( $btText ) ) {
								echo '<span class="or">' . $this->opt('sc_bt_text','') . '</span> ';
							}

							// Second Button
							if ( ! empty ( $sc_2p_button1 ) ) {

								$iconHolder = $this->opt('sc_lp_button2_icon','');
								$bicon2 = !empty( $iconHolder['family'] )  ? '<span class="button-icon kl-' . $this->opt('sc_lp_button2_icon_style','') . '" '.zn_generate_icon( $this->opt('sc_lp_button2_icon','') ).'></span>' : '';

								echo $sc_lp_button2_link['start'] . $bicon2  . '<span>' . $sc_2p_button1 . '</span>' . $sc_lp_button2_link['end'];
							}
							?>
						</div>

						<?php
							// IMAGE
							if ( isset ( $options['sc_lp_image'] ) && ! empty ( $options['sc_lp_image'] ) )
							{
								echo '<div class="col-sm-10 col-sm-offset-1 col-md-7 col-md-offset-0">';
									echo '<div id="screenshot" class="sc__screenshot">';
										$image = vt_resize( '', $options['sc_lp_image'], '620', '390', true );
										$image_big = vt_resize( '', $options['sc_lp_image'], '1000', '630', true );
										echo '<div class="image">';
											echo '<a class="kjq-loupe" data-lightbox="image" href="'.$image_big['url'].'">';
												echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="'. ZngetImageAltFromUrl( $options['sc_lp_image'] ) .'" title="'.ZngetImageTitleFromUrl( $options['sc_lp_image'] ).'" class="img-responsive" />';
											echo '</a>';
											echo '<div class="sc__loupe"></div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
							?>

					</div><!-- end row -->
				</div><!-- /.productzoom-style -->

			</div><!-- /.sc__container -->

		</div><!-- /.static-content__inner -->

	</div><!-- /.static-content__wrapper -->

	<?php
		zn_bottommask_markup($bottom_mask, $this->opt('hm_header_bmasks_bg',''));
	?>

</div>
		<!-- end kl-slideshow -->
	<?php
	}

	// Loads the required JS
	function js() {
		$uid = $this->data['uid'];
		$loupe = array ( 'loupe'.$uid =>  "
			if( typeof jQuery.fn.loupe != 'undefined' ){
				jQuery('.$uid .kjq-loupe').loupe({
					'default_zoom': 150,
					'default_size' : 160,
					'apply_overlay' : false,
					'drop_shadow' : false
				});
			}
		" );
		return $loupe;
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{

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
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter a title.", 'zn_framework' ),
						"id"          => "sc_title",
						"std"         => "",
						"type"        => "textarea"
					),
					array (
						"name"        => __( "Featured image", 'zn_framework' ),
						"description" => __( "Select an image that will appear on the right side. Recommended size 1000px x 630px .", 'zn_framework' ),
						"id"          => "sc_lp_image",
						"std"         => "",
						"type"        => "media"
					),
					array (
						"name"        => __( "Features list", 'zn_framework' ),
						"description" => __( "Please enter a title.", 'zn_framework' ),
						"id"          => "sc_lp_features",
						"std"         => "",
						"type"        => "textarea"
					),
					array (
						"name"        => __( "Button 1 Text", 'zn_framework' ),
						"description" => __( "Please enter a text for the first button.", 'zn_framework' ),
						"id"          => "sc_lp_button1",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Button 1 link", 'zn_framework' ),
						"description" => __( "Here you can add a link to the first button", 'zn_framework' ),
						"id"          => "sc_lp_button1_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
					array (
						"name"        => __( "Button 1 icon", 'zn_framework' ),
						"description" => __( "Select your desired icon that will appear on the
											left side of the button text.", 'zn_framework' ),
						"id"          => "sc_lp_button1_icon",
						"std"         => "",
						"type"        => "icon_list",
						'class'       => 'zn_full',
					),
					array (
						"name"        => __( "Button 1 style", 'zn_framework' ),
						"description" => __( "Select the desired style for your button.", 'zn_framework' ),
						"id"          => "sc_lp_button1_style",
						"std"         => false,
						"type"        => "select",
						"options"     => array (
							"btn btn-fullcolor"  => "Full Color Button",
							"btn btn-lined"  => "Lined Button",
							"btn btn-lined lined-dark"  => "Lined Button Dark",
							"btn btn-default"    => "Default",
							"btn btn-primary" => __( "Primary", 'zn_framework' ),
							"btn btn-info"    => __( "Info", 'zn_framework' ),
							"btn btn-success" => __( "Success", 'zn_framework' ),
							"btn btn-warning" => __( "Warning", 'zn_framework' ),
							"btn btn-danger"  => __( "Danger", 'zn_framework' ),
							"btn btn-link"    => __( "Link", 'zn_framework' )
						),
						"class"       => ""
					),
					array (
						"name"        => __( "Button 1 icon style", 'zn_framework' ),
						"description" => __( "Select the desired style for your icon.", 'zn_framework' ),
						"id"          => "sc_lp_button1_icon_style",
						"std"         => false,
						"type"        => "select",
						"options"     => array (
							false        => __( "Normal icons", 'zn_framework' ),
							"icon-white" => __( "White icons", 'zn_framework' )
						),
						"class"       => ""
					),
					array (
						"name"        => __( "Text between buttons", 'zn_framework' ),
						"description" => __( "Here you can add a text that will appear between
											your buttons", 'zn_framework' ),
						"id"          => "sc_bt_text",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Button 2 Text", 'zn_framework' ),
						"description" => __( "Please enter a text for the second button.", 'zn_framework' ),
						"id"          => "sc_2p_button1",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Button 2 link", 'zn_framework' ),
						"description" => __( "Here you can add a link to the second button", 'zn_framework' ),
						"id"          => "sc_lp_button2_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
					array (
						"name"        => __( "Button 2 icon", 'zn_framework' ),
						"description" => __( "Select your desired icon that will appear on the
											left side of the button text.", 'zn_framework' ),
						"id"          => "sc_lp_button2_icon",
						"std"         => "",
						"type"        => "icon_list",
						'class'       => 'zn_full',
					),
					array (
						"name"        => __( "Button 2 style", 'zn_framework' ),
						"description" => __( "Select the desired style for your button.", 'zn_framework' ),
						"id"          => "sc_lp_button2_style",
						"std"         => false,
						"type"        => "select",
						"options"     => array (
							"btn btn-fullcolor"  => "Full Color Button",
							"btn btn-lined"  => "Lined Button",
							"btn btn-lined lined-dark"  => "Lined Button Dark",
							"btn btn-default"    => "Default",
							"btn btn-primary" => __( "Primary", 'zn_framework' ),
							"btn btn-info"    => __( "Info", 'zn_framework' ),
							"btn btn-success" => __( "Success", 'zn_framework' ),
							"btn btn-warning" => __( "Warning", 'zn_framework' ),
							"btn btn-danger"  => __( "Danger", 'zn_framework' ),
							"btn btn-link"    => __( "Link", 'zn_framework' )
						),
						"class"       => ""
					),
					array (
						"name"        => __( "Button 2 icon style", 'zn_framework' ),
						"description" => __( "Select the desired style for your icon.", 'zn_framework' ),
						"id"          => "sc_lp_button2_icon_style",
						"std"         => false,
						"type"        => "select",
						"options"     => array (
							false        => __( "Normal icons", 'zn_framework' ),
							"icon-white" => __( "White icons", 'zn_framework' )
						),
						"class"       => ""
					),

				)
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#Vh_jEQp5RTY',
				'docs'    => 'http://support.hogash.com/documentation/static-content-product-loupe-2/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;

	}
}
