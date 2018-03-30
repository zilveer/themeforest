<?php if(! defined('ABSPATH')){ return; }
/*
Name: STATIC CONTENT - Reservation Form
Description: Create and display a STATIC CONTENT - Reservation Form element
Class: TH_StaticContentReservationForm
Category: headers, Fullwidth
Level: 1
*/
/**
 * Class TH_StaticContentReservationForm
 *
 * Create and display a STATIC CONTENT - Reservation Form element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StaticContentReservationForm extends ZnElements
{
	public static function getName(){
		return __( "STATIC CONTENT - Reservation Form", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_style( 'static_content', THEME_BASE_URI . '/css/sliders/static_content_styles.css', '', ZN_FW_VERSION );
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
		<div class="kl-slideshow static-content__slideshow sc--reservation-form <?php echo $style; ?> <?php echo $uid; ?> <?php echo $bm_class ?> <?php echo zn_get_element_classes($this->data['options']); ?>">

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

						<div class="static-content sc--resform-style">
							<?php
							// TITLE
							if ( isset ( $options['ww_slide_title'] ) && ! empty ( $options['ww_slide_title'] ) ) {
								echo '<h2 class="static-content__title sc-title--centered text-center" '.WpkPageHelper::zn_schema_markup('title').'>' . do_shortcode( $options['ww_slide_title'] ) . '</h2>';
							}

							// SUBTITLE
							if ( isset ( $options['ww_slide_subtitle'] ) && ! empty ( $options['ww_slide_subtitle'] ) ) {
								echo '<h3 class="static-content__subtitle sc-subtitle--centered text-center" '.WpkPageHelper::zn_schema_markup('subtitle').'>' . do_shortcode( $options['ww_slide_subtitle'] ) . '</h3>';
							}

							// BUTTON
							if ( isset($options['ww_slide_m_button']) || !empty($options['ww_slide_l_text']) ) {
								echo '<div class="sc__actionarea">';

								$ww_slide_link = zn_extract_link($this->opt('ww_slide_link', ''), 'btn btn-lined btn-lg btn-third');

								echo $ww_slide_link['start'] . $this->opt('ww_slide_l_text', '') . $ww_slide_link['end'];

								// BUTTON LEFT TEXT
								if ( isset ( $options['ww_slide_m_button'] ) && ! empty ( $options['ww_slide_m_button'] ) ) {
									echo '<h5 class="sc-infopop__text kl-font-alt">' . $options['ww_slide_m_button'] . '</h5>';
								}

								echo '<div class="clear"></div>';
								echo '</div>';
							}
							?>
<?php
// Check if current year is leap year
$crtYear = date('Y');
$isLeapYear = (date('L', strtotime("$crtYear-01-01")));
$months = array(
	__('JAN', 'zn_framework'),__('FEB', 'zn_framework'),__('MAR', 'zn_framework'),__('APR', 'zn_framework'),    __('MAY', 'zn_framework'),
	__('JUN', 'zn_framework'),__('JUL', 'zn_framework'),__('AUG', 'zn_framework'),__('SEP', 'zn_framework'),__('OCT', 'zn_framework'),
	__('NOV', 'zn_framework'),__('DEC', 'zn_framework'),);

$days = array(
/* JAN */    0 => 31,
/* FEB */    1 => $isLeapYear ? 29 : 28,
/* MAR */    2 => 31,
/* APR */    3 => 30,
/* MAY */    4 => 31,
/* JUN */    5 => 30,
/* JUL */    6 => 31,
/* AUG */    7 => 31,
/* SEP */    8 => 30,
/* OCT */    9 => 31,
/* NOV */    10 => 30,
/* DEC */    11 => 31,
);
?>
							<div class="sc__res-form clearfix">
								<form name="sc__form-reservation " action="#" class="sc__form-reservation">

									<div class="rf__block rfblock--fields clearfix">
										<div class="rf__field rffield--bigger clearfix">
											<label class="rf__label"><?php _e('CHECK IN', 'zn_framework');?></label>
											<select name="checkin_month" class="rf__select  rf__checkinmonth">
												<?php
													foreach($months as $i => $month){
														echo '<option value="'.$i.'">'.$month.'</option>';
													}
												?>
											</select>
											<select name="checkin_day" class="rf__select rf__checkinday"></select>
										</div><!-- /.rf__field -->
<script type="text/javascript">
	jQuery(function($){
		"use strict";
		// Holds the days of each month
		var months = {
			'm_0': [<?php  echo implode(',', range(1,$days[0]));?>],
			'm_1': [<?php  echo implode(',', range(1,$days[1]));?>],
			'm_2': [<?php  echo implode(',', range(1,$days[2]));?>],
			'm_3': [<?php  echo implode(',', range(1,$days[3]));?>],
			'm_4': [<?php  echo implode(',', range(1,$days[4]));?>],
			'm_5': [<?php  echo implode(',', range(1,$days[5]));?>],
			'm_6': [<?php  echo implode(',', range(1,$days[6]));?>],
			'm_7': [<?php  echo implode(',', range(1,$days[7]));?>],
			'm_8': [<?php  echo implode(',', range(1,$days[8]));?>],
			'm_9': [<?php  echo implode(',', range(1,$days[9]));?>],
			'm_10': [<?php echo implode(',', range(1,$days[10]));?>],
			'm_11': [<?php echo implode(',', range(1,$days[11]));?>]
		};
		// Helper method - set days accordingly to the month provided
		var setDays = function(months, selectedMonth){
			var days = months[selectedMonth];
			if(days){
				$('.rf__checkinday').empty();
				$.each(days, function(i,v){
					$('.rf__checkinday').append('<option value="'+v+'">'+v+'</option>');
				});
			}
		};
		// On change month
		$('.rf__checkinmonth').each(function(){
			$(this).on('change', function(){
				var selectedMonth = $(this).val();
				if(selectedMonth >= 0 && selectedMonth <= 11){
					selectedMonth = 'm_'+selectedMonth;
					setDays(months, selectedMonth);
				}
			});
		});
		// On Load
		setDays(months, 'm_'+0);

		/*
		 * Build search query for endpoint
		 */
		var endpointUrl = "<?php echo $options['ww_endpoint_url']['url'];?>",
			monthUrlField = "<?php echo (isset($options['ww_month_field'])&&!empty($options['ww_month_field']) ?
								esc_attr($options['ww_month_field']) : 'm');?>",
			dayUrlField = "<?php echo (isset($options['ww_day_field'])&&!empty($options['ww_day_field']) ?
								esc_attr($options['ww_day_field']) : 'd');?>",
			nightsUrlField = "<?php echo (isset($options['ww_nights_field'])&&!empty($options['ww_nights_field']) ?
								esc_attr($options['ww_nights_field']) : 'n');?>",
			guestsUrlField = "<?php echo (isset($options['ww_guests_field'])&&!empty($options['ww_guests_field']) ?
								esc_attr($options['ww_guests_field']) : 'g');?>",
			sepFirst = '<?php echo (false === ($pos = strpos($options['ww_endpoint_url']['url'], '?')) ? '?' : '&');?>',
			sepNext = '&';

			$('.rf__submit').on('click', function(ev){
				ev.preventDefault();
				ev.stopPropagation();
				var _mv = $('.rf__checkinmonth').val(),
					_dv = $('.rf__checkinday').val(),
					_nv = $('.rf__checkin_nights').val(),
					_gv = $('.rf__checkinguests').val(),

					_month = monthUrlField + '=' + _mv + sepNext,
					_day = dayUrlField + '=' + _dv + sepNext,
					_nights = nightsUrlField + '=' + _nv + sepNext,
					_guests = guestsUrlField + '=' + _gv + sepNext;

				endpointUrl += sepFirst + _month + _day + _nights + _guests;

				<?php if($options['ww_endpoint_url']['target'] == '_self') { ?>
					window.location.href = endpointUrl;
				<?php } else { ?>
					$('<form target="_blank" action="'+endpointUrl+'" style="display:none;">')
						.appendTo('body')
						.append('<input type="text" name="'+monthUrlField+'" value="'+_mv+'"/>')
						.append('<input type="text" name="'+dayUrlField+'" value="'+_dv+'"/>')
						.append('<input type="text" name="'+nightsUrlField+'" value="'+_nv+'"/>')
						.append('<input type="text" name="'+guestsUrlField+'" value="'+_gv+'"/>')
						.submit();
				<?php } ?>
			});
	});
</script>
										<div class="rf__field">
											<label class="rf__label"><?php _e('NIGHTS','zn_framework');?></label>
											<select name="checkin_nights" class="rf__select rf__checkin_nights">
												<?php for($i = 1; $i < 31; $i++){
														echo '<option value="'.$i.'">'.$i.'</option>';
													}
												?>
											</select>
										</div><!-- /.rf__field -->
										<div class="rf__field">
											<label class="rf__label"><?php _e('GUESTS','zn_framework');?></label>
											<select name="checkin_guests" class="rf__select rf__checkinguests">
												<?php for($i = 1; $i < 11; $i++){
													echo '<option value="'.$i.'">'.$i.'</option>';
												}
												?>
											</select>
										</div><!-- /.rf__field -->
									</div><!-- /.rf__block -->

									<div class="rf__block rfblock--submit">
										<button class="rf__submit">
											<span><?php _e('CHECK <br/> AVAILABILITY','zn_framework');?></span>
										</button>
									</div><!-- /.rf__block -->

								</form>
							</div><!-- /.sc__res-form -->

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
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs' => true,
			'general' => array(
				'title' => __('General options', 'zn_framework'),
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
						"name"        => __( "Main title", 'zn_framework' ),
						"description" => __( "Please enter a main title.", 'zn_framework' ),
						"id"          => "ww_slide_title",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Subtitle", 'zn_framework' ),
						"description" => __( "Please enter a subtitle", 'zn_framework' ),
						"id"          => "ww_slide_subtitle",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Button Main Text", 'zn_framework' ),
						"description" => __( "Please enter a main text for this button", 'zn_framework' ),
						"id"          => "ww_slide_m_button",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Button Link Text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear on the right side of the button", 'zn_framework' ),
						"id"          => "ww_slide_l_text",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Button link", 'zn_framework' ),
						"description" => __( "Please enter a link that will appear on the right side of the button", 'zn_framework' ),
						"id"          => "ww_slide_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),

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

			'tab_advanced' => array(
				'title' => __('Advanced', 'zn_framework'),
				'options' => array(
					array (
						"name"        => __( "Month field", 'zn_framework' ),
						"description" => __( "Please enter the name for the month field that holds the month when the
						 url to the endpoint is generated.", 'zn_framework' ),
						"id"          => "ww_month_field",
						"std"         => "",
						"type"        => "text",
						'placeholder' => 'm',
					),
					array (
						"name"        => __( "Day field", 'zn_framework' ),
						"description" => __( "Please enter the name for the day field that holds the day when the
						 url to the endpoint is generated.", 'zn_framework' ),
						"id"          => "ww_day_field",
						"std"         => "",
						"type"        => "text",
						'placeholder' => 'd',
					),
					array (
						"name"        => __( "Nights field", 'zn_framework' ),
						"description" => __( "Please enter the name for the nights field that holds the nights when the
						 url to the endpoint is generated.", 'zn_framework' ),
						"id"          => "ww_nights_field",
						"std"         => "",
						"type"        => "text",
						'placeholder' => 'n',
					),
					array (
						"name"        => __( "Guests field", 'zn_framework' ),
						"description" => __( "Please enter the name for the guests field that holds the guests when the
						 url to the endpoint is generated.", 'zn_framework' ),
						"id"          => "ww_guests_field",
						"std"         => "",
						"type"        => "text",
						'placeholder' => 'g',
					),
					array (
						"name"        => __( "Endpoint URL", 'zn_framework' ),
						"description" => __( "Please enter the link to the endpoint which will display the search
						results based on the retrieved values. Ex: http://your.endpoint.url/", 'zn_framework' ),
						"id"          => "ww_endpoint_url",
						"std"         => "",
						"type"        => "link",
						"options"     => array (
							'_self'     => __( "Same window", 'zn_framework' ),
							'_blank'    => __( "New window", 'zn_framework' ),
						),
					),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#Hv9y1Qa_5Tw',
				'docs'    => 'http://support.hogash.com/documentation/static-content-reservation-form/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
