<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Buttons
 Description: Create and display as many buttons as you want
 Class: TH_Buttons
 Category: content
 Level: 3
 Keywords: call, action, anchor, link
*/
/**
 * Class TH_Buttons
 *
 * Create and display as many buttons as you want
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_Buttons extends ZnElements
{
	public static function getName(){
		return __( "Buttons", 'zn_framework' );
	}


	function bkw_compat_margin($btn_margin){

		$button_margin_std = array();
		$css_parts = explode(' ', $btn_margin);

		if(!empty($css_parts)){

			$count_parts = count($css_parts);

			// it means it's a general one, eg: 10px
			if($count_parts == 1 && !empty($css_parts)){
				$button_margin_std['top'] = $button_margin_std['right'] = $button_margin_std['bottom'] = $button_margin_std['left'] = $css_parts[0];
			}
			// it means it's a short one, eg: 10px 20px
			elseif($count_parts == 2){
				$button_margin_std['top'] = $button_margin_std['bottom'] = $css_parts[0];
				$button_margin_std['right'] = $button_margin_std['left'] = $css_parts[1];
			}
			// it means it's a short one, eg: 10px 20px 30px
			elseif($count_parts == 3){
				$button_margin_std['top'] = $css_parts[0];
				$button_margin_std['right'] = $button_margin_std['left'] = $css_parts[1];
				$button_margin_std['bottom'] = $css_parts[2];
			}
			// it means it's a short one, eg: 10px 20px 30px 40px
			elseif($count_parts == 4){
				$button_margin_std['top'] = $css_parts[0];
				$button_margin_std['right'] = $css_parts[1];
				$button_margin_std['bottom'] = $css_parts[2];
				$button_margin_std['left'] = $css_parts[3];
			}
		}
		return $button_margin_std;
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		$uid = $this->data['uid'];
		$css = '';


		$buttons = $this->opt('single_btn');

		if( is_array($buttons) && !empty( $buttons ) ){
			foreach( $buttons as $i => $b ){

				$button_style = $b['button_style'];
				$button_selector = '.'.$uid.' .btn-custom-color.btn-element-'.$i;
				$button_simple_selector = '.'.$uid.' .btn-element-'.$i;

				$button_color = isset($b['btn_custom_color']) && !empty($b['btn_custom_color']) ? $b['btn_custom_color'] : '';
				$button_color_hover = isset($b['cta_custom_color_hov']) && !empty($b['cta_custom_color_hov']) ? $b['cta_custom_color_hov'] : adjustBrightness($button_color, 20);

				// Button Fullcolor
				if($button_style == 'btn-fullcolor btn-custom-color' && $button_color ){
					$css .= $button_selector.'{background-color:'.$button_color.'}';
					$css .= $button_selector.':hover{background-color:'.$button_color_hover.'}';
				}
				// Button lined
				elseif($button_style == 'btn-lined btn-custom-color' && $button_color ){
					$css .= $button_selector.'{color:'.$button_color.'; border-color:'.$button_color.';}';
					$css .= $button_selector.':hover{color:'.$button_color_hover.'; border-color:'.$button_color_hover.';}';
				}
				// Button Skewed
				elseif($button_style == 'btn-fullcolor btn-skewed btn-custom-color' && $button_color ){
					$css .= $button_selector.':before{background-color:'.$button_color.'}';
					$css .= $button_selector.':hover:before{background-color:'.$button_color_hover.';}';
				}
				// Button Text
				elseif($button_style == 'btn-text btn-custom-color' && $button_color ){
					$css .= $button_selector.'{color:'.$button_color.'}';
					$css .= $button_selector.':hover{color:'.adjustBrightness($button_color, 7).';}';
				}

				// typography styles
				$btn_font_styles = '';
				if( isset($b['button_typo']) && !empty($b['button_typo']) ){
					foreach ($b['button_typo'] as $key => $value) {
						if($value != '') {
							if( $key == 'font-family' ){
								$btn_font_styles .= $key.':'. zn_convert_font($value) .';';
							} else {
								$important = $key == 'color' ? ' !important;':'';
								$btn_font_styles .= $key.':'. $value.$important.';';
							}
						}
					}
					if(!empty($btn_font_styles)){
						$css .= $button_simple_selector.'{'.$btn_font_styles.'}';
					}
				}

				$btn_icon_margin = '';
				$btn_icon_size = '';

				$button_icon_size = isset($b['button_icon_size']) ? $b['button_icon_size'] : '14';
				$button_icon_pos = isset($b['button_icon_pos']) ? $b['button_icon_pos'] : 'before';
				$button_icon_distance = isset($b['button_icon_distance']) ? $b['button_icon_distance'] : '0';

				if($button_icon_size != '14'){
					$btn_icon_size = 'font-size:'.$button_icon_size.'px;';
				}

				if($button_icon_distance != 0){
					if($button_icon_pos == 'before'){
						$btn_icon_margin = 'margin-right:'.$button_icon_distance.'px;';
					} elseif($button_icon_pos == 'after'){
						$btn_icon_margin = 'margin-left:'.$button_icon_distance.'px;';
					}
				}
				if($btn_icon_size || $btn_icon_margin){
					$css .= $button_simple_selector.' .btn-element-icon{'.$btn_icon_size.$btn_icon_margin.'}';
				}

				// Margin and paddings

				// backwards compatibility
				$button_margin_std = array();
				// TODO: Remove in future versions
				if( isset($b['button_margin']) && $b['button_margin'] != '' ){
					$b['cc_margin_lg'] = $this->bkw_compat_margin( $b['button_margin'] );
				}

				// Margins
				$margins = array();
				if(isset($b['cc_margin_lg'])) $margins['lg'] = $b['cc_margin_lg'];
				if(isset($b['cc_margin_md'])) $margins['md'] = $b['cc_margin_md'];
				if(isset($b['cc_margin_sm'])) $margins['sm'] = $b['cc_margin_sm'];
				if(isset($b['cc_margin_xs'])) $margins['xs'] = $b['cc_margin_xs'];
				if( !empty($margins) ){
					$margins['selector'] = $button_simple_selector;
					$margins['type'] = 'margin';
					$css .= zn_push_boxmodel_styles( $margins );
				}

				// Paddings
				$paddings = array();
				if(isset($b['cc_padding_lg'])) $paddings['lg'] = $b['cc_padding_lg'];
				if(isset($b['cc_padding_md'])) $paddings['md'] = $b['cc_padding_md'];
				if(isset($b['cc_padding_sm'])) $paddings['sm'] = $b['cc_padding_sm'];
				if(isset($b['cc_padding_xs'])) $paddings['xs'] = $b['cc_padding_xs'];
				if( !empty($paddings) ){
					$paddings['selector'] = $button_simple_selector;
					$paddings['type'] = 'padding';
					$css .= zn_push_boxmodel_styles( $paddings );
				}

			}
		}


		$parent_hover_anim = $this->opt('parent_hover_anim','');

		if($parent_hover_anim != ''){

			$parent_id = $this->opt('parent_hover_id','');
			if($parent_id != ''){

				if($parent_hover_anim == 'fadeout'){
					$css .= '.'.$parent_id.':hover .ph-'.$uid.'.prt-hover-fadeout {opacity:0;}';
				}
				elseif($parent_hover_anim == 'fadein'){
					$css .= '.'.$parent_id.':hover .ph-'.$uid.'.prt-hover-fadein {opacity:1;}';
				}
				elseif($parent_hover_anim == 'slideout'){
					$css .= '.'.$parent_id.':hover .ph-'.$uid.'.prt-hover-slideout {opacity:0; max-height:0;}';
				}
				elseif($parent_hover_anim == 'slidein'){
					$css .= '.'.$parent_id.':hover .ph-'.$uid.'.prt-hover-slidein {opacity:1; max-height:200px;}';
				}

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

		$classes=array();
		$classes[] = $uid = $this->data['uid'];
		$classes[] = 'text-'.$this->opt('el_alignment','left');
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		// Parent Hover block
		$parent_hover_anim = $this->opt('parent_hover_anim','');
		$parent_id = $this->opt('parent_hover_id','');
		$parent_hov_block_start = '';
		$parent_hov_block_end = '';
		if($parent_hover_anim != '' && $parent_id != ''){
			$parent_hov_block_start = '<div class="prt-hover-'.$parent_hover_anim.' ph-'.$uid.'">';
			$parent_hov_block_end = '</div>';
		}

		echo $parent_hov_block_start;

		echo '<div class="zn_buttons_element '.implode(' ', $classes).'" '.$attributes.'>';

			$buttons = $this->opt('single_btn');

			// Set some defaults for buttons
			if( empty( $buttons ) ){
				$buttons = array(
					array(
						'button_text' => 'Press me',
						'button_link' => array(
							'url' => '#',
							'target' => '_self',
							'title' => 'Press me',
						) ,
						'button_style' => 'btn-fullcolor',
					),
				);
			}

			if( is_array($buttons) && !empty( $buttons ) ){
				foreach( $buttons as $i => $b )
				{
					$buttonStyle = (isset($b['button_style']) && ! empty($b['button_style']) ? trim($b['button_style']) : '');
					$buttonSize = (isset($b['button_size']) && ! empty($b['button_size']) ? trim($b['button_size']) : '');
					$buttonWidth = (isset($b['button_width']) && ! empty($b['button_width']) ? trim($b['button_width']) : '');
					$buttonBlock = (isset($b['button_block']) ? trim($b['button_block']) : '');
					$buttonIconPos = (isset($b['button_icon_pos']) && !empty($b['button_icon_pos']) ? trim($b['button_icon_pos']) : '');
					$buttonCorners = (isset($b['button_corners']) && !empty($b['button_corners']) ? $b['button_corners'] : 'btn--rounded');
					// $buttonMargin = (isset($b['button_margin']) && !empty($b['button_margin']) ? trim($b['button_margin']) : '');
					$buttonIconEnable = (isset($b['button_icon_enable']) ? intval($b['button_icon_enable']) : 0);
					$buttonIcon = (isset($b['button_icon']) && !empty($b['button_icon']) ? $b['button_icon'] : '');
					$buttonText = (isset($b['button_text']) && !empty($b['button_text']) ? trim($b['button_text']) : '');
					$buttonLink = (isset($b['button_link']) && !empty($b['button_link']) ? $b['button_link'] : '');

					//Class
					$classes = array();
					$classes[] = $uid.$i. ' btn-element btn-element-'.$i.' btn ';
					$classes[] = $buttonStyle;
					$classes[] = $buttonSize;
					$classes[] = $buttonWidth;
					$classes[] = $buttonBlock;
					$classes[] = 'btn-icon--'.$buttonIconPos;
					$classes[] = $buttonCorners;

					$attr = '';
					// Styles
					// $attr = (!empty($buttonMargin) ? ' style="margin:'.$buttonMargin.';"' : '');
					$attr = 'id="'.$uid.$i.'"';

					// Icon
					$icon = ($buttonIconEnable == 1 ? '<span class="btn-element-icon" '.zn_generate_icon( $buttonIcon ).'></span>':'');

					if( !empty($buttonText) ){

						$text = '<span>'.$buttonText.'</span>';

						// Icon position
						if( $buttonIconPos == 'before' ){
							$text = $icon.$text;
						} else{
							$text = $text.$icon;
						}

						// extract link and add attributes and classes
						if(! empty($buttonLink)) {
							$link = zn_extract_link( $buttonLink, implode( ' ', $classes ), $attr );
							echo $link['start'] . $text . $link['end'];
						}
					}
				}
			}

		echo '</div>';

		echo $parent_hov_block_end;
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];


		// backwards compatibility
		// TODO: Remove in future versions
		$single_std = array();
		if(isset( $this->data['options']['single_btn'] ) && !empty($this->data['options']['single_btn'])){
			$single_std = $this->data['options']['single_btn'];
			foreach ( $this->data['options']['single_btn'] as $key => &$value ) {
				if( isset($value['button_margin']) && $value['button_margin'] != '' ){
					$value['cc_margin_lg'] = $this->bkw_compat_margin( $value['button_margin'] );
				}
			}
		}

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Element Alignment", 'zn_framework' ),
						"description" => __( "Please select the alignment of the button/s.", 'zn_framework' ),
						"id"          => "el_alignment",
						"std"         => "left",
						"options"     => array (
							'left' => __( 'Left (default)', 'zn_framework' ),
							'right'          => __( 'Right', 'zn_framework' ),
							'center'          => __( 'Center', 'zn_framework' )
						),
						"type"        => "select",
						'live' => array(
						   'type'           => 'class',
						   'css_class'      => '.'.$uid,
						   'val_prepend'   => 'text-',
						),
					),

					array(
						"name"           => __( "Button", 'zn_framework' ),
						"description"    => __( "Add Button.", 'zn_framework' ),
						"id"             => "single_btn",
						"element_title" => "button_text",
						"std"            => $single_std,
						"type"           => "group",
						"add_text"       => __( "Button", 'zn_framework' ),
						"remove_text"    => __( "Button", 'zn_framework' ),
						"group_sortable" => true,
						"subelements"    => array (

							'has_tabs'  => true,
							'general' => array(
								'title' => 'General options',
								'options' => array(

									array (
										"name"        => __( "Text", 'zn_framework' ),
										"description" => __( "Text inside the button", 'zn_framework' ),
										"id"          => "button_text",
										"std"         => "",
										"type"        => "text",
									),

									array (
										"name"        => __( "Link", 'zn_framework' ),
										"description" => __( "Attach a link to the button", 'zn_framework' ),
										"id"          => "button_link",
										"std"         => "",
										"type"        => "link",
										"options"     => zn_get_link_targets(),
									),

									array (
										"name"        => __( "Style", 'zn_framework' ),
										"description" => __( "Select a style for the button", 'zn_framework' ),
										"id"          => "button_style",
										"std"         => "btn-fullcolor",
										"type"        => "select",
										"options"     => zn_get_button_styles(),
										'live' => array(
										   'type'           => 'class',
										   'css_class'      => '.'.$uid.' .btn-element',
										),
									),
									array (
										"name"        => __( "Button Custom Color", 'zn_framework' ),
										"description" => __( "Select buton custom color.", 'zn_framework' ),
										"id"          => "btn_custom_color",
										"std"         => "#cd2122",
										"alpha"     => true,
										"type"        => "colorpicker",
										"dependency"  => array( 'element' => 'button_style' , 'value'=> array('btn-fullcolor btn-custom-color', 'btn-lined btn-custom-color', 'btn-fullcolor btn-skewed btn-custom-color', 'btn-fullcolor btn-bordered btn-custom-color', 'btn-text btn-custom-color') )
									),

									array (
										"name"        => __( "Button Custom Color HOVER", 'zn_framework' ),
										"description" => __( "Select button custom color on hover. If not specified, the normal state color will be used with a 20% color adjustment in brightness.", 'zn_framework' ),
										"id"          => "cta_custom_color_hov",
										"std"         => "",
										"alpha"     => true,
										"type"        => "colorpicker",
										"dependency"  => array( 'element' => 'button_style' , 'value'=> array('btn-fullcolor btn-custom-color', 'btn-lined btn-custom-color', 'btn-fullcolor btn-skewed btn-custom-color', 'btn-fullcolor btn-bordered btn-custom-color', 'btn-text btn-custom-color') )
									),

									array (
										"name"        => __( "Size", 'zn_framework' ),
										"description" => __( "Select a size for the button", 'zn_framework' ),
										"id"          => "button_size",
										"std"         => "",
										"type"        => "select",
										"options"     => array (
											''          => __( "Default", 'zn_framework' ),
											'btn-lg'    => __( "Large", 'zn_framework' ),
											'btn-md'    => __( "Medium", 'zn_framework' ),
											'btn-sm'    => __( "Small", 'zn_framework' ),
											'btn-xs'    => __( "Extra small", 'zn_framework' ),
										),
										'live' => array(
										   'type'           => 'class',
										   'css_class'      => '.'.$uid.' .btn-element',
										),
									),

									array (
										"name"        => __( "Button Corners", 'zn_framework' ),
										"description" => __( "Select the button corners type for this button", 'zn_framework' ),
										"id"          => "button_corners",
										"std"         => "btn--rounded",
										"type"        => "select",
										"options"     => array (
											'btn--rounded'  => __( "Smooth rounded corner", 'zn_framework' ),
											'btn--round'    => __( "Round corners", 'zn_framework' ),
											'btn--square'   => __( "Square corners", 'zn_framework' ),
										),
										'live' => array(
										   'type'           => 'class',
										   'css_class'      => '.'.$uid.' .btn-element',
										),
									),

									array (
										"name"        => __( "Width", 'zn_framework' ),
										"description" => __( "Select a size for the button", 'zn_framework' ),
										"id"          => "button_width",
										"std"         => "",
										"type"        => "select",
										"options"     => array (
											''                          => __( "Default", 'zn_framework' ),
											'btn-block btn-fullwidth'   => __( "Full width (100%)", 'zn_framework' ),
											'btn-halfwidth'             => __( "Half width (50%)", 'zn_framework' ),
											'btn-third'                 => __( "One-Third width (33%)", 'zn_framework' ),
											'btn-forth'                 => __( "One-forth width (25%)", 'zn_framework' ),
										),
										'live' => array(
										   'type'           => 'class',
										   'css_class'      => '.'.$uid.' .btn-element',
										),
									),

									array (
										"name"        => __( "Button text Options", 'zn_framework' ),
										"description" => __( "Specify the typography properties for the sub-title.", 'zn_framework' ),
										"id"          => "button_typo",
										"std"         => '',
										'supports'   => array( 'size', 'font', 'style', 'line', 'weight', 'color', 'spacing', 'case' ),
										"type"        => "font",
									),

									array (
										"name"        => __( "Make button as block?", 'zn_framework' ),
										"description" => __( "Transform the button and make it a block?", 'zn_framework' ),
										"id"          => "button_block",
										"std"         => "",
										"value"       => "btn-block",
										"type"        => "toggle2",
										'live' => array(
										   'type'           => 'class',
										   'css_class'      => '.'.$uid.' .btn-element',
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
											'css_class' => '.'.$uid.' .btn-element',
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
											'css_class' => '.'.$uid.'  .btn-element',
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


								),
							),

							'icon' => array(
								'title' => 'Icon options',
								'options' => array(

									array (
										"name"        => __( "Add icon?", 'zn_framework' ),
										"description" => __( "Add an icon to the button?", 'zn_framework' ),
										"id"          => "button_icon_enable",
										"std"         => "0",
										"value"       => "1",
										"type"        => "toggle2",
									),

									array (
										"name"        => __( "Icon position", 'zn_framework' ),
										"description" => __( "Select the position of the icon", 'zn_framework' ),
										"id"          => "button_icon_pos",
										"std"         => "before",
										"type"        => "select",
										"options"     => array (
											'before'  => __( "Before text", 'zn_framework' ),
											'after'   => __( "After text", 'zn_framework' ),
										),
										"dependency"  => array( 'element' => 'button_icon_enable' , 'value'=> array('1') ),
									),

									array (
										"name"        => __( "Select icon", 'zn_framework' ),
										"description" => __( "Select an icon to add to the button", 'zn_framework' ),
										"id"          => "button_icon",
										"std"         => "0",
										"type"        => "icon_list",
										'class'       => 'zn_full',
										"dependency"  => array( 'element' => 'button_icon_enable' , 'value'=> array('1') ),
									),

									array(
										'id'          => 'button_icon_size',
										'name'        => 'Icon size.',
										'description' => 'Change the icon\'s size.',
										'type'        => 'slider',
										'std'         => '14',
										"helpers"     => array (
											"step" => "1",
											"min" => "8",
											"max" => "80"
										),
										"dependency"  => array( 'element' => 'button_icon_enable' , 'value'=> array('1') ),
									),

									array(
										'id'          => 'button_icon_distance',
										'name'        => 'Button icon distance.',
										'description' => 'Change the default distance from the icon vs text.',
										'type'        => 'slider',
										'std'         => '0',
										"helpers"     => array (
											"step" => "1",
											"min" => "0",
											"max" => "80"
										),
										"dependency"  => array( 'element' => 'button_icon_enable' , 'value'=> array('1') ),
									),

								)
							)

						)
					),

					array (
						"name"        => __( "Parent Hover Animation", 'zn_framework' ),
						"description" => __( "Animate element on parent hover", 'zn_framework' ),
						"id"          => "parent_hover_anim",
						"std"         => "",
						"type"        => "select",
						"options"     => array(
							"" => "None",
							"fadeout" => "Fade Out",
							"fadein" => "Fade In",
							"slideout" => "Slide Out",
							"slidein" => "Slide In",
							// "color" => "Color Swap",
						),
					),

					array(
						'id'          => 'parent_hover_id',
						'name'        => __( "Parent ID", 'zn_framework' ),
						'description' => __( "You need to copy the parent element's unique ID. To find it, open the parent element's options and in the HELP tab you can find the ID. Just click to copy it and paste it here.", 'zn_framework' ),
						'type'        => 'text',
						'std'         => '',
						"dependency"  => array( 'element' => 'parent_hover_anim' , 'value'=> array('fadeout', 'fadein', 'slideout', 'slidein') )
					),

					// animation type
					// fade out/ fade in / slide in / slide-out / color
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#ZZa-J_ls8WY',
				'docs'    => 'http://support.hogash.com/documentation/buttons/',
				'copy'    => $uid,
				'general' => true,
			)),
		);
		return $options;
	}
}
