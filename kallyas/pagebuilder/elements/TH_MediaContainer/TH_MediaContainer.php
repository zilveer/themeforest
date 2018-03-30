<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Media Container
 Description: Create and display a Media Container element
 Class: TH_MediaContainer
 Category: content, media
 Level: 3
 Keywords: video, background
*/
/**
 * Class TH_MediaContainer
 *
 * Create and display a Media Container element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_MediaContainer extends ZnElements
{

	public static function getName(){
		return __( "Media Container", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];
		$link_type = $this->opt('mc_link_type','');
		$link_style = $this->opt('mc_link_style', 'lined');

		$height_old_vals = array(
			'breakpoints' => '1',
			'lg' =>  $this->opt('mc_height_lg')  ? $this->opt('mc_height_lg') : '',
			'unit_lg' => 'px',
			'md' =>  $this->opt('mc_height_md')  ? $this->opt('mc_height_md') : '',
			'unit_md' => 'px',
			'sm' =>  $this->opt('mc_height_sm')  ? $this->opt('mc_height_sm') : '',
			'unit_sm' => 'px',
			'xs' =>  $this->opt('mc_height_xs')  ? $this->opt('mc_height_xs') : '',
			'unit_xs' => 'px',
		);
		$css .= zn_smart_slider_css( $this->opt( 'mc_height', $height_old_vals ), '.'.$uid , 'height' );

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
		if( $this->opt('cc_padding_lg', '' ) || $this->opt('cc_padding_md', '' ) || $this->opt('cc_padding_sm', '' ) || $this->opt('cc_padding_xs', '' ) ){
			$css .= zn_push_boxmodel_styles(array(
					'selector' => '.'.$uid,
					'type' => 'padding',
					'lg' =>  $this->opt('cc_padding_lg', '' ),
					'md' =>  $this->opt('cc_padding_md', '' ),
					'sm' =>  $this->opt('cc_padding_sm', '' ),
					'xs' =>  $this->opt('cc_padding_xs', '' ),
				)
			);
		}


		if( $link_type == 'btn' ) {
			if($mc_btn_color = $this->opt('mc_btn_color','')){
				$css .= '.'.$uid.' .media-container__link {color:'.$mc_btn_color.';}';
			}
			if($mc_btn_color_hover = $this->opt('mc_btn_color_hover','')){
				$css .= '.'.$uid.' .media-container__link:hover {color:'.$mc_btn_color_hover.';}';
			}
		}

		if( $link_type == 'btn' && $link_style == 'borderanim2' ) {

			$borderWidth = 100; // Starting width of the bottom border
			$boxWidth = $this->opt('mc_borderanim2_width','400');    // Box width
			$boxHeight = 70;    // Box height

			$css .= ' .'.$uid.' .borderanim2-svg {width: '.$boxWidth.'px; }
				.'.$uid.' .borderanim2-svg .media-container__text {line-height: '.$boxHeight.'px; }
				.'.$uid.' .borderanim2-svg__shape {stroke-dasharray: '.$borderWidth.' 1000; stroke-dashoffset: -'.( $boxWidth + $boxHeight + (( $boxWidth - $borderWidth ) / 2) ).'; }
				.'.$uid.':hover .borderanim2-svg__shape {stroke-dasharray: '.( ($boxWidth*2)+($boxHeight*2) ).'; }
			';
		}

		if($this->opt('source_overlay','0') != '0'){
			if( $this->opt('overlay_hover_animation','none') == 'fadeto' ){
				$css .= '.'.$uid.'.media-container.kl-overlay-fadeto:hover .kl-bg-source__overlay {opacity:'.($this->opt('overlay_hover_opacity','0')/100).';}';
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

		if( empty( $options ) ) { return; }

		$link_style = $this->opt('mc_link_style', 'lined');

		$link_class= '';
		$content_type = $this->opt('mc_link_type','');
		$btn_text = $this->opt('mc_btn_text');

		$elm_classes=array();
		$elm_classes[] = $uid = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$elm_classes[] = 'media-container--type-'.$content_type;
		$elm_classes[] = 'kl-overlay-'.$this->opt('overlay_hover_animation','none');

		$elm_classes[] = $this->opt('image_box_shadow','') ? 'znBoxShadow-'.$this->opt('image_box_shadow','') : '';
		$elm_classes[] = $this->opt('image_box_shadow_hover','') ? 'znBoxShadow--hov-'.$this->opt('image_box_shadow_hover',''). ' znBoxShadow--hover' : '';

		$attributes = zn_get_element_attributes($options);

		// Object Parallax
		if( $this->opt('obj_parallax_enable','') == 'yes' ){
			$elm_classes[] = 'znParallax-object';
			$obj_distance = $this->opt('obj_parallax_distance','100')/2;
			$parallaxObject = array(
				"scene" => array(
					'triggerHook' => 'onEnter',
					'triggerElement' => '.'.$uid,
					'duration' => 'force_full',
				),
				"tween" => array(
					'speed' => $this->opt('obj_parallax_speed','800')/1000,
					'reverse' => $this->opt('obj_parallax_reverse','') == 'yes' ? 'true':'false',
					'css' => array(
						"y" => array( "from" => -$obj_distance, "to" => $obj_distance )
					),
					'easing' => $this->opt('obj_parallax_easing', 'Power1.easeOut')
				),
			);
			$attributes .= ' data-zn-parallax-obj=\''.json_encode($parallaxObject).'\'';
		}
?>
	<div class="media-container <?php echo implode(' ', $elm_classes); ?>" <?php echo $attributes; ?>>

		<?php

		WpkPageHelper::zn_background_source( array(
			'uid' => $uid,
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
			'source_overlay_color' => $this->opt('source_overlay_color_v2', $this->opt('source_overlay_color','rgba(53,53,53,0.65)') ),
			'source_overlay_opacity' => $this->opt('source_overlay_opacity','100'), // bkw. compatibility
			'source_overlay_color_gradient' => $this->opt('source_overlay_color_gradient_v2', $this->opt('source_overlay_color_gradient','rgba(53,53,53,0.65)') ),
			'source_overlay_color_gradient_opac' => $this->opt('source_overlay_color_gradient_opac','100'), // bkw. compatibility
			'source_overlay_gloss' => $this->opt('source_overlay_gloss',''),
			'source_overlay_custom_css' => $this->opt('source_overlay_custom_css',''),
			'mobile_play' => $this->opt('mobile_play', 'no'),
			'enable_parallax' => $this->opt('enable_parallax', ''),
		) );


		// Target
		$target = '';
		$mc_link_target = $this->opt('mc_link_target','self');
		if($mc_link_target == 'self') $target = 'target="_self"';
		elseif($mc_link_target == 'blank') $target = 'target="_blank"';
		elseif($mc_link_target == 'img') $target = 'data-lightbox="image"';
		elseif($mc_link_target == 'iframe') $target = 'data-lightbox="iframe"';

		$mc_btn_link = $this->opt('mc_btn_link');
		// Override link if modal image selected
		if($mc_link_target == 'img'){
			$mc_btn_link = $this->opt('mc_btn_modalimg');
		}

		if($content_type == 'btn' && ($link_style == 'lined' || $link_style == 'linedplay' ) && !empty($btn_text) ){
			$link_class .= 'btn btn-lined';
		}

		$mct_link=array();
		$mct_link[] = 'media-container__link--'.$content_type;
		$mct_link[] = 'media-container__link--style-'.$link_style;
		$mct_link[] = $link_class;

		if($link_style == 'borderanim1' || $link_style == 'borderanim2'){
			$mct_link[] = 'kl-font-alt';
		}

		if( !empty($mc_btn_link) && $content_type != 'pb'){
		?>
		<a class="media-container__link <?php echo implode(' ', $mct_link); ?>" href="<?php echo $mc_btn_link; ?>" <?php echo $target; ?> >
			<?php
			// Show the text
			$text = '';
			if( $link_style != 'circle' && !empty($btn_text) ){
				$text = '<span class="media-container__text">'.$btn_text.'</span>';
			}

			// Show icon if circle or linedplay style
			if( $content_type == 'btn' && $link_style == 'lined' ) {
				// Show text
				echo $text;
			}

			// Show icon if circle or linedplay style
			if( $content_type == 'btn' && $link_style == 'linedplay' ) {
				echo '<i class="kl-icon glyphicon glyphicon-play"></i>';
				// Show text
				echo $text;
			}

			// Show icon if circle or circle style
			if( $content_type == 'btn' && $link_style == 'circle' ) {
				echo '
				<div class="circleanim-svg">
					<svg height="108" width="108" xmlns="http://www.w3.org/2000/svg" >
						<circle stroke-opacity="0.1" fill="#FFFFFF" stroke-width="5" cx="54" cy="54" r="48" class="circleanim-svg__circle-back"></circle>
						<circle stroke-width="5" fill="#FFFFFF" cx="54" cy="54" r="48" class="circleanim-svg__circle-front" transform="rotate(50 54 54) "></circle>
						<path d="M62.1556183,56.1947505 L52,62.859375 C50.6192881,63.7654672 49.5,63.1544098 49.5,61.491212 L49.5,46.508788 C49.5,44.8470803 50.6250889,44.2383396 52,45.140625 L62.1556183,51.8052495 C64.0026693,53.0173767 63.9947588,54.9878145 62.1556183,56.1947505 Z"  fill="#FFFFFF"></path>
					</svg>
				  '.$text.'
				</div>';
			}

			// Show border animation Style 1 (part 1)
			if( $content_type == 'btn' && $link_style == 'borderanim1' ) {
				// part 1
				echo '<i class="media-container__border-tt"></i><i class="media-container__border-tl"></i>';
				// Show text
				echo $text;
				// part 2
				echo '<i class="media-container__border-bb"></i><i class="media-container__border-br"></i>';
			}


			// Show border animation Style 1 (part 1)
			if( $content_type == 'btn' && $link_style == 'borderanim2' ) {

				// There's a math behind the stroke animation,
				$boxWidth = $this->opt('mc_borderanim2_width','400');    // Box width
				$boxHeight = 70;    // Box height

				echo '

				<div class="borderanim2-svg">
				  <svg height="'.$boxHeight.'" width="'.$boxWidth.'" xmlns="http://www.w3.org/2000/svg">
					<rect class="borderanim2-svg__shape" height="'.$boxHeight.'" width="'.$boxWidth.'" />
				  </svg>
				  '.$text.'
				</div>';
			}


			?>
		</a>
		<?php }

		elseif($content_type == 'pb'){

			echo '<div class="media-container-pb media-container-pb--alg-'.$this->opt('mc_pb_vertal','top').'">';
				echo '<div class="row zn_columns_container zn_content zn_col_container-media_container" data-droplevel="1">';

					if ( empty( $this->data['content'] ) ) {
						$this->data['content'] = array ( ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' ) );
					}
					ZN()->pagebuilder->zn_render_content( $this->data['content'] );

				echo '</div>';
			echo '</div>';

		}


		?>

	</div>
<?php

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$data_options = isset($this->data['options']) ? $this->data['options'] : array();
		$colorzilla_url = 'http://www.colorzilla.com/gradient-editor/';
		$height_std = array(
			'breakpoints' => '1',
			'lg' => ( isset($this->data['options']['mc_height_lg']) && !empty($this->data['options']['mc_height_lg']) ? $this->data['options']['mc_height_lg'] : '300' ),
			'unit_lg' => 'px',
			'md' => ( isset($this->data['options']['mc_height_md']) && !empty($this->data['options']['mc_height_md']) ? $this->data['options']['mc_height_md'] : '' ),
			'unit_md' => 'px',
			'sm' => ( isset($this->data['options']['mc_height_sm']) && !empty($this->data['options']['mc_height_sm']) ? $this->data['options']['mc_height_sm'] : '' ),
			'unit_sm' => 'px',
			'xs' => ( isset($this->data['options']['mc_height_xs']) && !empty($this->data['options']['mc_height_xs']) ? $this->data['options']['mc_height_xs'] : '' ),
			'unit_xs' => 'px',
		);

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Content Type", 'zn_framework' ),
						"description" => __( "Select the type of content inside the media container.", 'zn_framework' ),
						"id"          => "mc_link_type",
						"std"         => "",
						"options"     => array(
								array(
									'value' => '',
									'name'  => __( 'Just media - Unlinked', 'zn_framework' ),
									'desc'  => __( 'This will display the element using the background media applied, without any link applied to it. ** Don\'t confuse with video player! Use VideoBox element instead.', 'zn_framework' ),
									'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_MediaContainer/img/just_media.png'
								),
								array(
									'value' => 'pb',
									'name'  => __( 'Page builder Content *NEW!', 'zn_framework' ),
									'desc'  => __( 'Using this option you can freely use included page builder elements inside.', 'zn_framework' ),
									'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_MediaContainer/img/page_builder.png'
								),
								array(
									'value' => 'btn',
									'name'  => __( 'Centered Button', 'zn_framework' ),
									'desc'  => __( 'Will simply display a button with various styles in the exact center of the container.', 'zn_framework' ),
									'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_MediaContainer/img/centered_button.png'
								),
								array(
									'value' => 'wrap',
									'name'  => __( 'Link the container', 'zn_framework' ),
									'desc'  => __( 'Unline "Just media", this option will link somewhere and that\'s it. No hidden gems.', 'zn_framework' ),
									'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_MediaContainer/img/wrap_link.png'
								),
							),
							"type"        => "smart_select",
							"class"        => "zn-smartselect--xl"
					),

					array (
						"name"        => __( "Button Style", 'zn_framework' ),
						"description" => __( "Select a button style", 'zn_framework' ),
						"id"          => "mc_link_style",
						"std"         => "lined",
						"type"        => "select",
						"options"     => array (
							'lined'  => __( "Lined button. Requires text!", 'zn_framework' ),
							'circle'  => __( "Circle Play", 'zn_framework' ),
							'linedplay'  => __( "Lined with play icon. Requires text!", 'zn_framework' ),
							'borderanim1'  => __( "Border animation. Requires text!", 'zn_framework' ),
							'borderanim2'  => __( "Alternative border animation. Requires text!", 'zn_framework' ),
						),
						"dependency"  => array( 'element' => 'mc_link_type' , 'value'=> array('btn') ),
					),

					array (
						"name"        => __( "Button Text", 'zn_framework' ),
						"description" => __( "Add a text inside the button. If no text is added, an icon will be displayed.", 'zn_framework' ),
						"id"          => "mc_btn_text",
						"std"         => "",
						"type"        => "text",
						"dependency"  => array( 'element' => 'mc_link_type' , 'value'=> array('btn') ),
					),

					array (
						"name"        => __( "Button Text Color", 'zn_framework' ),
						"description" => __( "Select the color you want.", 'zn_framework' ),
						"id"          => "mc_btn_color",
						"std"         => "",
						"type"        => "colorpicker",
						"alpha"        => "true",
						"dependency"  => array(
							array( 'element' => 'mc_link_type' , 'value'=> array('btn') ),
							array( 'element' => 'mc_link_style' , 'value'=> array('lined','linedplay','borderanim1','borderanim2') ),
						),
					),
					array (
						"name"        => __( "Button Text Hover Color", 'zn_framework' ),
						"description" => __( "Select the color you want.", 'zn_framework' ),
						"id"          => "mc_btn_color_hover",
						"std"         => "",
						"type"        => "colorpicker",
						"alpha"        => "true",
						"dependency"  => array(
							array( 'element' => 'mc_link_type' , 'value'=> array('btn') ),
							array( 'element' => 'mc_link_style' , 'value'=> array('lined','linedplay','borderanim1','borderanim2') ),
						),
					),

					array (
						"name"        => __( "Alternative border animation - box width", 'zn_framework' ),
						"description" => __( "set a width for the alternative border animation.", 'zn_framework' ),
						"id"          => "mc_borderanim2_width",
						"std"         => "400",
						"type"        => "text",
						"placeholder" => "",
						"dependency"  => array(
							array( 'element' => 'mc_link_type' , 'value'=> array('btn') ),
							array( 'element' => 'mc_link_style' , 'value'=> array('borderanim2') ),
						),
					),

					array (
						"name"        => __( "Link Target", 'zn_framework' ),
						"description" => __( "Add a center button?", 'zn_framework' ),
						"id"          => "mc_link_target",
						"std"         => "self",
						"type"        => "select",
						"options"     => array (
							'self'  => __( "Link to another page in site", 'zn_framework' ),
							'blank' => __( "Link to a new window", 'zn_framework' ),
							'img' => __( "Link to modal image", 'zn_framework' ),
							'iframe' => __( "Link to modal iframe (Youtube, Vimeo, Gmaps etc.)", 'zn_framework' )
						),
						"dependency"  => array( 'element' => 'mc_link_type' , 'value'=> array('btn','wrap') ),
					),

					array (
						"name"        => __( "Link URL", 'zn_framework' ),
						"description" => __( "Add a link for the link.", 'zn_framework' ),
						"id"          => "mc_btn_link",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "http:// ...",
						"dependency"  => array( 'element' => 'mc_link_type' , 'value'=> array('btn','wrap') ),
					),

					array (
						"name"        => __( "Modal image link", 'zn_framework' ),
						"description" => __( "Add an image for the modal.", 'zn_framework' ),
						"id"          => "mc_btn_modalimg",
						"std"         => "",
						"type"        => "media",
						"dependency"  => array( 'element' => 'mc_link_target' , 'value'=> array('img') ),
					),

					// Page builder content
					array (
						"name"        => __( "Content Vertical Align", 'zn_framework' ),
						"description" => __( "Vertically align the page builder content you add inside the media container.", 'zn_framework' ),
						"id"          => "mc_pb_vertal",
						"std"         => "top",
						"type"        => "select",
						"options"     => array (
							'top'  => __( "Top", 'zn_framework' ),
							'center' => __( "Center", 'zn_framework' ),
							'bottom' => __( "Bottom", 'zn_framework' ),
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$uid.'.media-container--type-pb .media-container-pb',
							'val_prepend'  => 'media-container-pb--alg-',
						),
						"dependency"  => array( 'element' => 'mc_link_type' , 'value'=> array('pb') ),
					),

				)
			),

			'height' => array(
				'title' => 'Spacing',
				"options" => array(

					array(
						'id'          => 'mc_height',
						'name'        => __( 'Height', 'zn_framework'),
						'description' => __( 'Choose the desired height for element.  <br>*TIP: Use 100vh to have a full-height element.', 'zn_framework' ),
						'type'        => 'smart_slider',
						'std'        => $height_std,
						'helpers'     => array(
							'min' => '0',
							'max' => '1400'
						),
						'supports' => array('breakpoints'),
						'units' => array('px', '%', 'vh'),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid. '',
							'css_rule'  => 'height',
							'unit'      => 'px'
						),
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
						'std'	  => '',
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
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('md') ),
					),
					array(
						'id'          => 'cc_margin_sm',
						'name'        => 'Margin (Small Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('sm') ),
					),
					array(
						'id'          => 'cc_margin_xs',
						'name'        => 'Margin (Extra Small Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'std'	  => 	'',
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
						'std'	  => '',
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
				'title' => 'Background & Styles',
				'options' => array(

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
						"name"        => __( "Embed Iframe link", 'zn_framework' ),
						"description" => __( "Add a link", 'zn_framework' ),
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
						'description' => 'Using this option you can add your desired video poster that will be shown on unsuported devices.',
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
						'description' => 'Enable autoplay for video?',
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
						'description' => 'Enable looping the video?',
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
							"4" => __( "Yes (Custom CSS generated gradient)", 'zn_framework' ),
							"0"  => __( "No", 'zn_framework' )
						)
					),

					array(
						'id'          => 'source_overlay_color_v2',
						'name'        => 'Overlay Background color',
						'description' => 'Here you can choose a custom background color for this container.',
						'type'        => 'colorpicker',
						'alpha'        => true,
						'std'         => zn_convert_bgcolor_overlay( $data_options, 'source_overlay_color', 'source_overlay_opacity', 'rgba(53,53,53,0.65)' ),
						"dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('1', '2', '3') ),
					),

					array(
						'id'          => 'source_overlay_color_gradient_v2',
						'name'        => 'Overlay Gradient 2nd Bg. Color',
						'description' => 'Here you can choose a custom background color for this container.',
						'type'        => 'colorpicker',
						'alpha'        => true,
						'std'         => zn_convert_bgcolor_overlay( $data_options, 'source_overlay_color_gradient', 'source_overlay_color_gradient_opac', 'rgba(53,53,53,0.65)' ),
						"dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('2', '3') ),
					),

					array(
						'id'          => 'source_overlay_custom_css',
						'name'        => 'Custom CSS Gradient Overlay',
						'description' => 'You can use a tool such as <a href="'.$colorzilla_url.'" target="_blank">http://www.colorzilla.com/gradient-editor/</a> to generate a unique custom gradient. Here\'s a quick video explainer <a href="http://hogash.d.pr/8Dze" title="">http://hogash.d.pr/8Dze</a> how to generate and paste the video here.',
						'type'        => 'textarea',
						// 'type'        => 'custom_code',
	  //                   'class'       => 'zn_full',
	  //                   'editor_type' => 'css',
						'std'         => '',
						"dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('4') ),
					),

					array(
						'id'          => 'overlay_hover_animation',
						'name'        => 'Overlay hover animation type',
						'description' => 'Select the type of hover animation type to apply on the overlay.',
						'type'        => 'select',
						'std'         => 'none',
						"options"     => array (
							"none" => "None",
							"fadeout" => "Fade Out",
							"fadeto" => "Fade To specified Opacity",
						),
						"dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('1','2','3','4') ),
					),

					array(
						'id'          => 'overlay_hover_opacity',
						'name'        => 'Fade to specified opacity',
						'description' => 'Specify the opacity level should the overlay fade to.',
						'type'        => 'slider',
						'std'         => '0',
						"helpers"     => array (
							"step" => "1",
							"min" => "0",
							"max" => "100"
						),
						"dependency"  => array(
							array( 'element' => 'source_overlay' , 'value'=> array('1','2','3','4') ),
							array( 'element' => 'overlay_hover_animation' , 'value'=> array('fadeto') ),
						),
					),

					array(
						'id'            => 'source_overlay_gloss',
						'name'          => 'Enable Gloss Overlay',
						'description'   => 'Display a gloss over the background',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => '1'
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
				),
			),

			'advanced' => array(
				'title' => 'Advanced',
				'options' => array(
					array (
						"name"        => __( "Enable Object Scrolling", 'zn_framework' ),
						"description" => __( "This will add a very nice slide up or down effect to this element, upon scrolling.", 'zn_framework' ),
						"id"          => "obj_parallax_enable",
						"std"         => "",
						"type"        => "toggle2",
						"value"        => "yes",
					),

					array (
						"name"        => __( "Distance", 'zn_framework' ),
						"description" => __( "Select the Y axis distance to run the effect. The effect will run on the entire screen, from entering the viewport until leaving it.", 'zn_framework' ),
						"id"          => "obj_parallax_distance",
						"std"         => "100",
						"type"        => "select",
						"options"     => array(
								"50" => "Slide for 50px",
								"100" => "Slide for 100px",
								"200" => "Slide for 200px",
								"300" => "Slide for 300px",
						),
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

					array(
						"name"        => __( "Speed", 'zn_framework' ),
						"description" => __( "How long should the animation take, or better said, how slow or fast should it be. Value is in miliseconds (1s = 1000ms).", 'zn_framework' ),
						'id'          => 'obj_parallax_speed',
						'type'        => 'slider',
						'std'         => '800',
						'helpers'     => array(
							'min' => '0',
							'max' => '5000',
							'step' => '100'
						),
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

					array (
						"name"        => __( "Easing", 'zn_framework' ),
						"description" => __( "Select the effect's easing. You can play with the easing effects <a href=\"http://greensock.com/ease-visualizer\" target=\"_blank\">here</a>.", 'zn_framework' ),
						"id"          => "obj_parallax_easing",
						"std"         => "Power1.easeOut",
						"type"        => "select",
						"options"     => array(
							"Power0.easeOut" => "Power0.easeOut (Linear)",
							"Power1.easeOut" => "Power1.easeOut (Quad)",
							"Power2.easeOut" => "Power2.easeOut (Cubic)",
							"Power3.easeOut" => "Power3.easeOut (Quart)",
							"Power4.easeOut" => "Power4.easeOut (Quint)",
						),
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

					array (
						"name"        => __( "Tween in reverse?", 'zn_framework' ),
						"description" => __( "This will make the tween effect to run in opposite direction of the scroll.", 'zn_framework' ),
						"id"          => "obj_parallax_reverse",
						"std"         => "",
						"type"        => "toggle2",
						"value"        => "yes",
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#n7OFxV7XIkc',
				'docs'    => 'http://support.hogash.com/documentation/media-container/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;

	}

}
