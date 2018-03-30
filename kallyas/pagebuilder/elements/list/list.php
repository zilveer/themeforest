<?php if(! defined('ABSPATH')){ return; }
/*
 Name: List
 Description: Create a vertical list
 Class: ZnList
 Category: content
 Level: 3
 Keywords: ul, li, icon
*/

class ZnList extends ZnElements
{
	public static function getName(){
		return __( "List", 'zn_framework' );
	}


	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$uid = $this->data['uid'];
		$css = '';

		// Text Styles
		$text_styles = '';
		$list_typo = $this->opt('list_typo');
		if( is_array($list_typo) && !empty($list_typo) ){
			foreach ($list_typo as $key => $value) {
				if($value != '') {
					if( $key == 'font-family' ){
						$text_styles .= $key .':'. zn_convert_font($value).';';
					} else {
						$text_styles .= $key .':'. $value.';';
					}
				}
			}
			if(!empty($text_styles)){
				$css .= '.'.$uid.' .znListItems-text{'.$text_styles.'}';
			}
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

		// icon_distance Vertical
		$litem_distance_vert = $this->opt('litem_distance_vert','3');
		if( $litem_distance_vert != '3' ){
			$css .= '.'.$uid.' .znListItems>li{margin-top: '.$litem_distance_vert.'px;margin-bottom:'.$litem_distance_vert.'px}';
		}

		$icon_css = '';

		// Icon sizes
		$icon_size = $this->opt('litem_icon_size','14');
		if( $icon_size != '14'){
			$icon_css .= 'font-size:'.$icon_size.'px;';
		}
		// Icon color
		$icon_color = $this->opt('litems_textcolor','#333333');
		if( $icon_color != '#333333'){
			$icon_css .= 'color:'.$icon_color.';';
		}

		if(!empty($icon_css)){
			$css .= '.'.$uid.' .znListItems-icon {'.$icon_css.'}';
		}

		// Individual icon's colors
		$list_items = $this->opt('single_item','');
		if( is_array($list_items) && !empty( $list_items ) ){
			foreach ( $list_items as $k => $icon ) {
				$icon_tcolor = $icon['litem_textcolor'];
				if( $icon_tcolor != ''){
					$css .= '.'.$uid.' .znListItems-icon.znListItems-icon-'.$k.'{color:'.$icon_tcolor.'}';
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
		$classes[] = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);
		$classes[] = 'text-'.$this->opt('el_alignment','left');
		$classes[] = 'znList-icon--'.$this->opt('el_alignment','left');

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$classes[] = 'elm-znlist--'.$color_scheme;
		$classes[] = 'element-scheme--'.$color_scheme;

		$attributes = zn_get_element_attributes($options);

		echo '<div class="znList '.implode(' ', $classes).'" '.$attributes.'>';

			$list_items = $this->opt('single_item','');

			// Set some defaults for list
			if( empty( $list_items ) ){
				$list_items = array(
					array(
						'litem_text' => 'List item',
						'litem_icon' => array(
							'family' => 'glyphicons_halflingsregular',
							'unicode' => 'ue013'
						),
					),
					array(
						'litem_text' => 'List item',
						'litem_icon' => array(
							'family' => 'glyphicons_halflingsregular',
							'unicode' => 'ue013'
						),
					),
					array(
						'litem_text' => 'List item',
						'litem_link' => array(
							'url' => '#',
							'target' => '_self',
							'title' => 'Press me',
						),
						'litem_icon' => array(
							'family' => 'glyphicons_halflingsregular',
							'unicode' => 'ue013'
						),
					),
				);
			}

			if( is_array($list_items) && !empty( $list_items ) ){

				echo '<ul class="znListItems clearfix">';

					foreach ( $list_items as $k => $icon ) {

						echo '<li class="znListItems-item clearfix">';

							$litem_link = array();
							$litem_link['start'] = '';
							$litem_link['end'] = '';

							if(isset( $icon['litem_link'] ) && !empty($icon['litem_link'])){
								$litem_link = zn_extract_link( $icon['litem_link'], 'znListItems-link' );
							}

							echo $litem_link['start'];
							if( !empty( $icon['litem_icon'] ) ) {
								echo '<span class="znListItems-icon znListItems-icon-'.$k.'" '.zn_generate_icon( $icon['litem_icon'] ).'></span>';
							}
							if( !empty( $icon['litem_text'] ) ) {
								echo '<span class="znListItems-text">'.$icon['litem_text'].'</span>';
							}
							echo $litem_link['end'];

						echo '</li>';
					}
				echo '</ul>';
			}
		echo '</div>';

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
						"name"        => __( "Icons Size", 'zn_framework' ),
						"description" => __( "Select the size of the icons.", 'zn_framework' ),
						"id"          => "litem_icon_size",
						"std"         => "14",
						"type"         => "slider",
						'helpers'     => array(
							'min' => '10',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid.' .znListItems-icon',
							'css_rule'  => 'font-size',
							'unit'      => 'px'
						),
					),

					array (
						"name"        => __( "Icons color", 'zn_framework' ),
						"description" => __( "Select a color for the icons", 'zn_framework' ),
						"id"          => "litems_textcolor",
						"std"         => "#333333",
						"type"        => "colorpicker",
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid.' .znListItems-icon',
							'css_rule'  => 'color',
							'unit'      => ''
						),
					),

					array (
						"name"        => __( "List items distance vertically", 'zn_framework' ),
						"description" => __( "Select the distance between the list items vertically.", 'zn_framework' ),
						"id"          => "litem_distance_vert",
						"std"         => "3",
						"type"         => "slider",
						'helpers'     => array(
							'min' => '0',
							'max' => '300',
							'step' => '1'
						),
						'live' => array(
							'multiple' => array(
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .znListItems>li',
									'css_rule'  => 'margin-top',
									'unit'      => 'px'
								),
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .znListItems>li',
									'css_rule'  => 'margin-bottom',
									'unit'      => 'px'
								),
							)
						),
					),

					array (
						"name"        => __( "List items typography", 'zn_framework' ),
						"description" => __( "Specify the typography properties for the list items.", 'zn_framework' ),
						"id"          => "list_typo",
						"std"         => '',
						'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight', 'spacing', 'case' ),
						"type"        => "font",
						'live' => array(
							'type'      => 'font',
							'css_class' => '.'.$uid. ' .znListItems-text',
						),
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
									'val_prepend'  => 'elm-znlist--',
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
						"name"        => __( "Element Alignment", 'zn_framework' ),
						"description" => __( "Please select the alignment of the list items.", 'zn_framework' ),
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


					/**
					 * Margins and padding
					 */
					array (
						"name"        => __( "Edit element padding & margins for each device breakpoint. ", 'zn_framework' ),
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
				),
			),

			'items' => array(
				'title' => 'List Items',
				'options' => array(
					array(
						"name"           => __( "List Items", 'zn_framework' ),
						"description"    => __( "Add List Items.", 'zn_framework' ),
						"id"             => "single_item",
						"std"            => "",
						"type"           => "group",
						"add_text"       => __( "List Item", 'zn_framework' ),
						"remove_text"    => __( "List Item", 'zn_framework' ),
						"group_sortable" => true,
						"element_title" => "litem_text",
						"subelements"    => array (

							array (
								"name"        => __( "List item text", 'zn_framework' ),
								"description" => __( "Here you can add text. Please know it also accepts HTML code.", 'zn_framework' ),
								"id"          => "litem_text",
								"std"         => "",
								"type"        => "textarea"
							),
							array (
								"name"        => __( "List item link", 'zn_framework' ),
								"description" => __( "Wrap the list item into a custom link. If this field is left blank, the item will not be linked.", 'zn_framework' ),
								"id"          => "litem_link",
								"std"         => "",
								"type"        => "link",
								"options"     => zn_get_link_targets(),
							),

							array (
								"name"        => __( "Select icon", 'zn_framework' ),
								"description" => __( "Select your desired icon.", 'zn_framework' ),
								"id"          => "litem_icon",
								"std"         => "",
								"type"        => "icon_list",
								'class'       => 'zn_icon_list',
								'compact'       => true,
							),
							array (
								"name"        => __( "Override Icon Color", 'zn_framework' ),
								"description" => __( "Select a color for the icon", 'zn_framework' ),
								"id"          => "litem_textcolor",
								"std"         => "",
								"type"        => "colorpicker"
							),
						),
					),
				),
			),
		);
		return $options;
	}
}
