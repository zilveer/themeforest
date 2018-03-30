<?php

/*-----------------------------------------------------------------------------------*/
/*	VC Icon VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map( array(
				'name' => __( 'Icon', 'js_composer' ),
				'base' => 'vc_icon',
				'icon' => 'icon-wpb-vc_icon',
				'category' => __( 'Content', 'js_composer' ),
				'description' => __( 'Icon from icon library', 'js_composer' ),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => __('Display style', 'vivaco'),
						'param_name' => 'display_style',
						'weight' => 1,
						'value' => array(
							__('Block','vivaco') => '',
							__('Inline','vivaco') => 'icon_inline',
						),
						"description" => __( "Set how the icon is displayed: <b>Block</b> - places icon on a new line <b>Inline</b> - renders icon next to other elements", "vivaco" ),
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Icon library', 'js_composer' ),
						'value' => array(
							__( 'Startuply Line Icons', 'vivaco' ) => 'startuplyli',
							__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
							__( 'Open Iconic', 'js_composer' ) => 'openiconic',
							__( 'Typicons', 'js_composer' ) => 'typicons',
							__( 'Entypo', 'js_composer' ) => 'entypo',
							__( 'Linecons', 'js_composer' ) => 'linecons',
						),
						'admin_label' => true,
						'param_name' => 'type',
						'description' => __( 'Select icon library.', 'js_composer' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_startuplyli',
						'value' => 'icon icon-graphic-design-13', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'startuplyli',
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'startuplyli',
						),
						'description' => __( 'Select icon from library.', 'js_composer' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_fontawesome',
						'value' => 'fa fa-adjust', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'fontawesome',
						),
						'description' => __( 'Select icon from library.', 'js_composer' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_openiconic',
						'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'openiconic',
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'openiconic',
						),
						'description' => __( 'Select icon from library.', 'js_composer' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_typicons',
						'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'typicons',
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'typicons',
						),
						'description' => __( 'Select icon from library.', 'js_composer' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_entypo',
						'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'entypo',
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'entypo',
						),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_linecons',
						'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'linecons',
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'linecons',
						),
						'description' => __( 'Select icon from library.', 'js_composer' ),
					),

					array(
						'type' => 'colorpicker',
						'heading' => __( 'Custom Icon Color', 'js_composer' ),
						'param_name' => 'custom_color',
						'description' => __( 'Select custom icon color.', 'js_composer' ),
						"group" => __("Change color", "vivaco"),
					),
					array(
						'type' => 'colorpicker',
						'heading' => __( 'Custom Icon Background Color', 'js_composer' ),
						'param_name' => 'custom_background_color',
						'description' => __( 'Select custom icon background color.', 'js_composer' ),
						"group" => __("Change color", "vivaco"),
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Background Style', 'js_composer' ),
						'param_name' => 'background_style',
						'value' => array(
							__( 'None', 'js_composer' ) => '',
							__( 'Circle', 'js_composer' ) => 'rounded',
							__( 'Square', 'js_composer' ) => 'boxed',
							__( 'Rounded', 'js_composer' ) => 'rounded-less',
							__( 'Outline Circle', 'js_composer' ) => 'rounded-outline',
							__( 'Outline Square', 'js_composer' ) => 'boxed-outline',
							__( 'Outline Rounded', 'js_composer' ) => 'rounded-less-outline',
						),
						'description' => __( 'Background style for icon.', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Size', 'js_composer' ),
						'param_name' => 'size',
						'value' => '',
						'std' => '',
						'description' => __( 'Icon size.', 'js_composer' )
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Icon alignment', 'js_composer' ),
						'param_name' => 'align',
						'value' => array(
							__( 'Align left', 'js_composer' ) => 'left',
							__( 'Align right', 'js_composer' ) => 'right',
							__( 'Align center', 'js_composer' ) => 'center',
						),
						'description' => __( 'Select icon alignment.', 'js_composer' ),
					),
					array(
						'type' => 'vc_link',
						'heading' => __( 'URL (Link)', 'js_composer' ),
						'param_name' => 'link',
						'description' => __( 'Add link to icon.', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					),

				),
				'js_view' => 'VcIconElementView_Backend',
			) );





/*-----------------------------------------------------------------------------------*/
/*	VC Icon VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_icon ($atts, $content = null) {
$icon = $color = $size = $align = $el_class = $custom_color = $link = $background_style = $background_color =
$type = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypoicons = $icon_linecons = $css = $style1 = $style2 = $css_class = $custom_styles = '';

$defaults = array(
	'type' => 'startuplyli',
	'icon_startuplyli' => 'icon icon-graphic-design-13',
	'icon_fontawesome' => 'fa fa-adjust',
	'icon_openiconic' => 'vc-oi vc-oi-dial',
	'icon_typicons' => 'typcn typcn-adjust-brightness',
	'icon_entypoicons' => 'entypo-icon entypo-icon-note',
	'icon_linecons' => 'vc_li vc_li-heart',
	'icon_entypo' => 'entypo-icon entypo-icon-note',
	'css' => '',
	'color' => '',
	'custom_color' => '',
	'background_style' => '',
	'background_color' => '',
	'size' => '',
	'align' => 'left',
	'el_class' => '',
	'link' => '',
	'css_animation' => '',
	'display_style' => '',
);

/** @var array $atts - shortcode attributes */
if(empty($atts)) { // without this have a Fatal Error Unsupported operand types in vc_shortcode_attribute_parse
	$atts = array();
}

$atts = vc_shortcode_attribute_parse( $defaults, $atts );
extract( $atts );

/*
echo "<pre>";
echo "-----";
var_dump($atts);
echo "</pre>";
*/

$class = $el_class ;
//$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );
$css_class .= $css_animation;
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );

$url = vc_build_link( $link );
$has_style = false;
if ( strlen( $background_style ) > 0 ) {
	$has_style = true;
	if ( strpos( $background_style, 'outline' ) !== false ) {
		$background_style .= ' vc_icon_element-outline'; // if we use outline style it is border in css
	} else {
		$background_style .= ' vc_icon_element-background';
	}
}

if( $has_style ) {
	$style1 = 'vc_icon_element-have-style';
	$style2 = 'vc_icon_element-have-style-inner';
}

if ($custom_color != '') {$custom_styles = 'color:' . esc_attr( $custom_color ) .';';};
if ($size != '') {$custom_styles .= 'font-size:' . esc_attr( $size ) .'px;';};
if ($display_style != '') {$d_style = esc_attr( $display_style );} else {$d_style = '';};

$output = '<div class="vc_icon_element vc_icon_element-outer'.esc_attr( $css_class ).' vc_icon_element-align-'.esc_attr( $align ) .' '. $style1 .' '.$d_style.' ' . $class .'"><div class="vc_icon_element-inner '. $style2 .'" '.esc_attr( $background_style ).' '.esc_attr( $background_color ).'"><span class="vc_icon_element-icon '.esc_attr( ${"icon_" . $type} ).'"' . ' style="' . $custom_styles .'"></span>';

		if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {

			$output .= '<a class="vc_icon_element-link" href="' . esc_attr( $url['url'] ) . '" title="' . esc_attr( $url['title'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '"></a>';

		}

		//$output .= '</div></div>'.$this->endBlockComment( ".vc_icon_element" ); //old one
		$output .= '</div></div>';


	return $output;

}
add_shortcode('vc_icon', 'vsc_icon');
