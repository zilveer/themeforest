<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Text Box
 Description: Create and display a Text Box element
 Class: TH_TextBox
 Category: content
 Level: 3
 Keywords: shortcode
*/

/**
 * Class TH_TextBox
 *
 * Create and display a Text Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_TextBox extends ZnElements
{
	public static function getName(){
		return __( "Text Box", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		//print_z($this);
		$uid = $this->data['uid'];
		$css = '';

		// backwards compatibility for top and bottom padding
		$txt_padding_std = array('top' => '0', 'bottom'=> '20px');
		if(isset($this->data['options']['top_padding']) && $this->data['options']['top_padding'] != '' ){
			$txt_padding_std['top'] = $this->data['options']['top_padding'].'px';
		}
		if(isset($this->data['options']['bottom_padding']) && $this->data['options']['bottom_padding'] != '' ){
			$txt_padding_std['bottom'] = $this->data['options']['bottom_padding'].'px';
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
		if( $this->opt('cc_padding_lg', $txt_padding_std ) || $this->opt('cc_padding_md', '' ) || $this->opt('cc_padding_sm', '' ) || $this->opt('cc_padding_xs', '' ) ){
			$css .= zn_push_boxmodel_styles(array(
					'selector' => '.'.$uid,
					'type' => 'padding',
					'lg' =>  $this->opt('cc_padding_lg', $txt_padding_std ),
					'md' =>  $this->opt('cc_padding_md', '' ),
					'sm' =>  $this->opt('cc_padding_sm', '' ),
					'xs' =>  $this->opt('cc_padding_xs', '' ),
				)
			);
		}


		if($parent_hover_anim = $this->opt('parent_hover_anim','')){

			if($parent_id = $this->opt('parent_hover_id','')){

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
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];
		$stb_title_heading = $this->opt( 'stb_title_heading', 'h3' );

		if( empty( $options ) ) { return; }

		$elm_classes=array();
		$elm_classes[] = $uid = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'zn_text_box-'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		// Parent Hover block
		$parent_hover_anim = $this->opt('parent_hover_anim','');

		echo $parent_hover_anim != '' ? '<div class="prt-hover-'.$parent_hover_anim.' ph-'.$uid.'">' : '';

		echo '<div class="zn_text_box '.implode(' ', $elm_classes).'" '.$attributes.'>';

		$style = !empty( $options['stb_style'] ) ? $options['stb_style'] : '';
		if ( ! empty( $options['stb_title'] )  ) {
			$text_custom = $style == 'style1' ? 'text-custom' : '';
			echo '<'.$stb_title_heading.' class="zn_text_box-title zn_text_box-title--'.$style.' '.$text_custom.'">' . $options['stb_title'] . '</'.$stb_title_heading.'>';
		}

		$stb_content = $this->opt('stb_content','');

		global $wp_embed;
		if ( is_object( $wp_embed ) ) {
			$content = $wp_embed->autoembed( $stb_content );
		}
		$content = wpautop( $content );
		if ( ! empty ( $stb_content ) ) {
			echo ZNPB()->make_text_editable( $content, 'stb_content' );
			// echo $content;
		}
		echo '</div>';

		echo $parent_hover_anim != '' ? '</div>' : '';

		// echo ZNPB()->wraper_end('div');
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		// backwards compatibility for top and bottom padding
		$txt_padding_std = array('top' => '0', 'bottom'=> '2px');
		if(isset($this->data['options']['top_padding']) && $this->data['options']['top_padding'] != '' ){
			$txt_padding_std['top'] = $this->data['options']['top_padding'].'px';
		}
		if(isset($this->data['options']['bottom_padding']) && $this->data['options']['bottom_padding'] != '' ){
			$txt_padding_std['bottom'] = $this->data['options']['bottom_padding'].'px';
		}

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'Content',
				'options' => array(
					array (
						"name"        => __( "Content", 'zn_framework' ),
						"description" => __( "Please enter the box content.<br> ** If you plan on <strong style='color:black'>pasting a shortcode</strong>, please make sure to add it in <strong style='color:black'><em>Text Mode</em></strong> of the editor.", 'zn_framework' ),
						"id"          => "stb_content",
						"std"         => "",
						"type"        => "visual_editor",
						"class"        => "zn_full",
					),
					array(
						'id'          => 'element_scheme',
						'name'        => 'Element Color Scheme',
						'description' => 'Select the color scheme of this element',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
							'light' => 'Light (default)',
							'dark' => 'Dark'
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'zn_text_box-',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
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
				)
			),

			'title' => array(
				'title' => 'Title settings',
				'options' => array(
					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter the title for this box", 'zn_framework' ),
						"id"          => "stb_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Title heading", 'zn_framework' ),
						"description" => __( "Select the desired heading type you want to use for the title", 'zn_framework' ),
						"id"          => "stb_title_heading",
						"std"         => "h3",
						"type"        => "select",
						"options"     => array(
							'h1' => 'H1',
							'h2' => 'H2',
							'h3' => 'H3',
							'h4' => 'H4',
							'h5' => 'H5',
							'h6' => 'H6',
						),
					),
					array (
						"name"        => __( "Title style", 'zn_framework' ),
						"description" => __( "Select the desired style for the title of this
											box", 'zn_framework' ),
						"id"          => "stb_style",
						"type"        => "select",
						"std"         => "style1",
						"options"     => array (
							'style1' => __( 'Style 1', 'zn_framework' ),
							'style2' => __( 'Style 2', 'zn_framework' )
						)
					),
				)
			),
			'padding' => array(
				'title' => 'Spacing options',
				'options' => array(

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
						'std'	  => $txt_padding_std,
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

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#_ModlDp5ghI',
				'docs'    => 'http://support.hogash.com/documentation/text-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
