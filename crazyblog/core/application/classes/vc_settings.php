<?php

function crazyblo_custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
	if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
		$class_string = str_replace( 'vc_row-fluid', 'my_row-fluid', $class_string ); // This will replace "vc_row-fluid" with "my_row-fluid"
	}
	if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
		$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'col-md-$1', $class_string ); // This will replace "vc_col-sm-%" with "my_col-sm-%"
	}
	return $class_string;
}

add_filter( 'vc_shortcodes_css_class', 'crazyblo_custom_css_classes_for_vc_row_and_vc_column', 10, 2 );

function vc_theme_vc_row( $atts, $content = null ) {
	$el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = '';
	extract( shortcode_atts(
					array(
		'css' => '',
		'el_class' => '',
		'bg_image' => '',
		'bg_color' => '',
		'bg_image_repeat' => '',
		'border_color' => '',
		'font_color' => '',
		'padding' => '',
		'margin_bottom' => '',
		// start my param
		'show_title' => '',
		'col_title' => '',
		'col_sub_title' => '',
		'title_style' => '',
		'show_parallax' => '',
		'parallax_layer' => '',
		'parallax_bg' => '',
		'miscellaneous' => '',
		'top_space' => '',
		'bottom_space' => '',
		'add_top_space_padding' => '',
		'add_bottom_space_padding' => '',
		'gray_section' => '',
		'container' => '',
					), $atts )
	);

	$atts['base'] = '';
	wp_enqueue_style( 'js_composer_front' );
	wp_enqueue_script( 'wpb_composer_front_js' );
	wp_enqueue_style( 'js_composer_custom_css' );
	$vc_row = new WPBakeryShortCode_VC_Row( $atts );
	$el_class = $vc_row->getExtraClass( $el_class );
	$output = '';
	$css_class = $el_class;
	$css_class = ($css) ? apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts['base'], $atts ) . ' ' . $css_class : $css_class;
	$style = customBuildStyle( $bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom );

	$my_class = '';
	if ( $miscellaneous == 'on' && $top_space == 'off' ) {
		$my_class .= 'remove-gap' . ' ';
	}

	if ( $miscellaneous == 'on' && $bottom_space == 'off' ) {
		$my_class .= 'remove-bottom' . ' ';
	}

	if ( $miscellaneous == 'on' && $gray_section == 'on' ) {
		$my_class .= 'gray';
	}

	$custom_style = '';
	if ( $miscellaneous != 'off' && $top_space == 'off' && $add_top_space_padding != '' ) {
		$custom_style .= 'padding-top:' . $add_top_space_padding . 'px;';
	}

	if ( $miscellaneous != 'off' && $bottom_space == 'off' && $add_bottom_space_padding != '' ) {
		$custom_style .= 'padding-bottom:' . $add_bottom_space_padding . 'px;';
	}

	$custom_style = ($custom_style) ? 'style="' . $custom_style . '"' : '';

	$my_parallax = '';
	if ( $show_parallax == 'on' && !empty( $parallax_bg ) ) {
		if ( $parallax_bg ):
			$img = wp_get_attachment_url( $parallax_bg, 'full' );
		else:
			$img = '';
		endif;
		$my_parallax .= ($img) ? '<div class="parallax scrolly-invisible" style="background:url(' . $img . ') no-repeat scroll 0 0 rgba(0, 0, 0, 0)"></div>' : '';
	}

	$parallax_layer_style = '';
	if ( $show_parallax == 'on' && $parallax_layer != '' ) {
		$parallax_layer_style .= $parallax_layer . ' ';
	}

	$titles = '';
	if ( $show_title == 'on' && !empty( $col_title ) ):
		$titles .= '<div class="container">' . crazyblog_heading_style( $col_title, $col_sub_title, $title_style ) . '</div>';
	endif;

	$output = '';
	$output .= '<section ' . $custom_style . ' class="block ' . $my_class . ' ' . $css_class . '"' . $style . '>';
	$output .= ($parallax_layer_style != '' && $my_parallax != '') ? '<div class="layer ' . $parallax_layer_style . '">' : '';
	$output .= $my_parallax;
	$output .= ($container == 'on' ) ? '<div class="container">' : '';
	$output .= $titles;
	$output .= '<div class="row">';
	$output .= wpb_js_remove_wpautop( $content );
	$output .= '</div>';
	$output .= ($container == 'on' ) ? '</div>' : '';
	$output .= ($parallax_layer_style != '' && $my_parallax != '') ? '</div>' : '';
	$output .= '</section>';
	return $output;
}

function vc_theme_vc_row_inner( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'el_class' => '',
		'container' => '',
		'row' => '',
					), $atts ) );
	$atts['base'] = '';
	wp_enqueue_style( 'js_composer_front' );
	wp_enqueue_script( 'wpb_composer_front_js' );
	wp_enqueue_style( 'js_composer_custom_css' );

	$output = '';
	$css_class = $el_class;

	if ( $container )
		return

				'<section class="block ' . $css_class . '" ' . $custom_style . ' >
		<div class="container">
				' . wpb_js_remove_wpautop( $content ) . '
		</div>
	</section>' . "\n";

	return
			'<section class=" block' . $css_class . ' ' . $custom_style . '" >
		' . wpb_js_remove_wpautop( $content ) . '
	</section>' . "\n";
}

function vc_theme_vc_column_inner( $atts, $content = null ) {
	extract( shortcode_atts( array( 'width' => '1/1', 'el_class' => '' ), $atts ) );

	$width = wpb_translateColumnWidthToSpan( $width );
	$width = str_replace( 'vc_span', 'col-md-', $width );
	$el_class = ($el_class) ? ' ' . $el_class : '';
	return
			'<div class="wpb_column ' . $width . $el_class . '">
		' . do_shortcode( $content ) . '
	</div>' . "\n";
}

function vc_theme_vc_column( $atts, $content = null ) {
	extract( shortcode_atts(
					array(
		'width' => '1/1',
		'el_class' => '',
		'show_title' => '',
		'col_title' => '',
		'col_sub_title' => '',
		'title_style' => ''
					), $atts )
	);

	$titles = '';

	if ( !empty( $col_title ) && $show_title == 'true' ):
		$titles .= crazyblog_heading_style( $col_title, $col_sub_title, $title_style );
	endif;

	$width = wpb_translateColumnWidthToSpan( $width );
	$width = str_replace( 'vc_col-sm-', 'col-md-', $width . ' column' );

	$el_class = ( $el_class ) ? ' ' . $el_class : '';
	$output = '<div class="' . $width . ' ' . $el_class . '">';
	$output .= $titles;
	$output .= do_shortcode( $content );
	$output .= '</div>';
	return $output;
}

// start vc row and column customized
$miscellaneous = array(
	"type" => "toggle",
	"class" => "",
	'group' => esc_html__( 'Miscellaneous', 'crazyblog' ),
	"heading" => esc_html__( "Miscellaneous Settings", 'crazyblog' ),
	"param_name" => "miscellaneous",
	'value' => '',
	'default_set' => false,
	'options' => array(
		'on' => array(
			'on' => esc_html__( 'Yes', 'crazyblog' ),
			'off' => esc_html__( 'No', 'crazyblog' ),
		),
	),
	"description" => esc_html__( "Show miscellaneous settings for this section.", 'crazyblog' ),
	'group' => esc_html__( 'Miscellaneous', 'crazyblog' ),
);

$top_space = array(
	"type" => "toggle",
	"class" => "",
	'group' => esc_html__( 'Miscellaneous', 'crazyblog' ),
	"heading" => esc_html__( "Top Space", 'crazyblog' ),
	"param_name" => "top_space",
	'value' => '',
	'default_set' => false,
	'options' => array(
		'off' => array(
			'label' => esc_html__( 'Enable Default', 'crazyblog' ),
			'on' => esc_html__( 'Yes', 'crazyblog' ),
			'off' => esc_html__( 'No', 'crazyblog' ),
		),
	),
	"description" => esc_html__( "Remove space in the top of section", 'crazyblog' ),
	'dependency' => array(
		'element' => 'miscellaneous',
		'value' => array( 'on' )
	),
);

$bottom_space = array(
	"type" => "toggle",
	"class" => "",
	'group' => esc_html__( 'Miscellaneous', 'crazyblog' ),
	"heading" => esc_html__( "Bottom Space", 'crazyblog' ),
	"param_name" => "bottom_space",
	'value' => '',
	'default_set' => false,
	'options' => array(
		'off' => array(
			'label' => esc_html__( 'Enable Default', 'crazyblog' ),
			'on' => esc_html__( 'Yes', 'crazyblog' ),
			'off' => esc_html__( 'No', 'crazyblog' ),
		),
	),
	"description" => esc_html__( "Remove space in the bottom of section", 'crazyblog' ),
	'dependency' => array(
		'element' => 'miscellaneous',
		'value' => array( 'on' )
	),
);
$add_top_space_padding = array(
	"type" => "textfield",
	"class" => "",
	'group' => esc_html__( 'Miscellaneous', 'crazyblog' ),
	"heading" => esc_html__( "Custom Top Space", 'crazyblog' ),
	"param_name" => "add_top_space_padding",
	"description" => esc_html__( "Enter the value for section space from top. e.g 50", 'crazyblog' ),
	'dependency' => array(
		'element' => 'top_space',
		'value' => array( 'off' )
	),
);

$add_bottom_space_padding = array(
	"type" => "textfield",
	"class" => "",
	'group' => esc_html__( 'Miscellaneous', 'crazyblog' ),
	"heading" => esc_html__( "Custom Bottom Space", 'crazyblog' ),
	"param_name" => "add_bottom_space_padding",
	"description" => esc_html__( "Enter the value for section space from bottom", 'crazyblog' ),
	'dependency' => array(
		'element' => 'bottom_space',
		'value' => array( 'off' )
	),
);

$gray_section = array(
	"type" => "toggle",
	"class" => "",
	'group' => esc_html__( 'Miscellaneous', 'crazyblog' ),
	"heading" => esc_html__( "Gray Section", 'crazyblog' ),
	"param_name" => "gray_section",
	'value' => 'off',
	'default_set' => false,
	'options' => array(
		'on' => array(
			'on' => esc_html__( 'Yes', 'crazyblog' ),
			'off' => esc_html__( 'No', 'crazyblog' ),
		),
	),
	"description" => esc_html__( "Make this section background gray", 'crazyblog' ),
	'dependency' => array(
		'element' => 'miscellaneous',
		'value' => array( 'on' )
	),
);
// end vc row and column customized

$container = array(
	"type" => "toggle",
	"class" => "",
	'group' => esc_html__( 'Other', 'crazyblog' ),
	"heading" => esc_html__( "Container", 'crazyblog' ),
	"param_name" => "container",
	'value' => 'off',
	'default_set' => false,
	'options' => array(
		'on' => array(
			'on' => esc_html__( 'Yes', 'crazyblog' ),
			'off' => esc_html__( 'No', 'crazyblog' ),
		),
	),
	"description" => esc_html__( "Enable container for this section", 'crazyblog' ),
);

// start parallax section			
$show_parallax = array(
	"type" => "toggle",
	"class" => "",
	'group' => esc_html__( 'Parallax', 'crazyblog' ),
	"heading" => esc_html__( "Show Parallax", 'crazyblog' ),
	"param_name" => "show_parallax",
	'value' => 'off',
	'default_set' => false,
	'options' => array(
		'on' => array(
			'on' => esc_html__( 'Yes', 'crazyblog' ),
			'off' => esc_html__( 'No', 'crazyblog' ),
		),
	),
	"description" => esc_html__( "Make this section parallax then true.", 'crazyblog' )
);

$parallax_layer = array(
	"type" => "dropdown",
	"class" => "",
	'group' => esc_html__( 'Parallax', 'crazyblog' ),
	"heading" => esc_html__( "Parallax Layer", 'crazyblog' ),
	"param_name" => "parallax_layer",
	"value" => array(
		esc_html__( 'No Layer', 'crazyblog' ) => 'no-layer',
		esc_html__( 'Whitish', 'crazyblog' ) => 'whitish',
		esc_html__( 'Blackish', 'crazyblog' ) => 'blackish',
		esc_html__( 'Light Blackish', 'crazyblog' ) => 'blackish2',
	),
	"description" => esc_html__( "Choose Style for Parallax.", 'crazyblog' ),
	'dependency' => array(
		'element' => 'show_parallax',
		'value' => array( 'on' )
	),
);

$parallax_img = array(
	"type" => "attach_image",
	"class" => "",
	'group' => esc_html__( 'Parallax', 'crazyblog' ),
	"heading" => esc_html__( "Parallax Background", 'crazyblog' ),
	"param_name" => "parallax_bg",
	"description" => esc_html__( "Make this section as parallax.", 'crazyblog' ),
	'dependency' => array(
		'element' => 'show_parallax',
		'value' => array( 'on' )
	),
);

//start title settings
$show_heading = array(
	"type" => "toggle",
	"class" => "",
	'group' => esc_html__( 'Title Setting', 'crazyblog' ),
	"heading" => esc_html__( "Show Title", 'crazyblog' ),
	"param_name" => "show_title",
	'value' => 'off',
	'default_set' => false,
	'options' => array(
		'on' => array(
			'on' => esc_html__( 'Yes', 'crazyblog' ),
			'off' => esc_html__( 'No', 'crazyblog' ),
		),
	),
	"description" => esc_html__( "Make this section with title.", 'crazyblog' )
);

$title = array(
	"type" => "textfield",
	"class" => "",
	'group' => esc_html__( 'Title Setting', 'crazyblog' ),
	"heading" => esc_html__( "Enter the Title", 'crazyblog' ),
	"param_name" => "col_title",
	"description" => esc_html__( "Enter the title of this section.", 'crazyblog' ),
	'dependency' => array(
		'element' => 'show_title',
		'value' => array( 'on' )
	),
);
$sub_title = array(
	"type" => "textfield",
	"class" => "",
	'group' => esc_html__( 'Title Setting', 'crazyblog' ),
	"heading" => esc_html__( "Enter the Sub Title", 'crazyblog' ),
	"param_name" => "col_sub_title",
	"description" => esc_html__( "Enter the sub title of this section.", 'crazyblog' ),
	'dependency' => array(
		'element' => 'show_title',
		'value' => array( 'on' )
	),
);

$title_style = array(
	"type" => "dropdown",
	"class" => "",
	'group' => esc_html__( 'Title Setting', 'crazyblog' ),
	"heading" => esc_html__( "Title Style", 'crazyblog' ),
	"param_name" => "title_style",
	"value" => array(
		esc_html__( 'No Style', 'crazyblog' ) => '',
		esc_html__( 'Simple Title', 'crazyblog' ) => '1',
		esc_html__( 'Side Title', 'crazyblog' ) => '2',
		esc_html__( 'Fancy Title', 'crazyblog' ) => '3',
		esc_html__( 'Center Title', 'crazyblog' ) => '4'
	),
	"description" => esc_html__( "Select the title style for this section", 'crazyblog' ),
	'dependency' => array(
		'element' => 'show_title',
		'value' => array( 'on' )
	),
);

if ( function_exists( 'vc_map' ) ) {

//vc column settings
	vc_add_param( 'vc_column', $show_heading );
	vc_add_param( 'vc_column', $title );
	vc_add_param( 'vc_column', $sub_title );
	vc_add_param( 'vc_column', $title_style );

//vc row settings
	vc_add_param( 'vc_row', $show_heading );
	vc_add_param( 'vc_row', $title );
	vc_add_param( 'vc_row', $sub_title );
	vc_add_param( 'vc_row', $title_style );

	vc_add_param( 'vc_row', $miscellaneous );
	vc_add_param( 'vc_row', $top_space );
	vc_add_param( 'vc_row', $add_top_space_padding );
	vc_add_param( 'vc_row', $bottom_space );
	vc_add_param( 'vc_row', $add_bottom_space_padding );
	vc_add_param( 'vc_row', $gray_section );
	vc_add_param( 'vc_row', $container );

	vc_add_param( 'vc_row', $show_parallax );
	vc_add_param( 'vc_row', $parallax_layer );
	vc_add_param( 'vc_row', $parallax_img );

	$remove_param = array( 'parallax', 'video_bg', 'parallax_image', 'parallax_speed_video', 'video_bg_url', 'video_bg_parallax', 'parallax_speed_bg' );
	foreach ( $remove_param as $rparam ) {
		vc_remove_param( "vc_row", $rparam );
	}


	vc_add_shortcode_param( 'multiselect', 'crazyblog_multiselect_settings_field' );

	function crazyblog_multiselect_settings_field( $settings, $value ) {
		if ( !is_array( $value ) ) {
			$checkVal = explode( ',', $value );
		} else {
			$checkVal = $value;
		}
		ob_start();
		?>
		<select multiple name="<?php echo esc_attr( $settings['param_name'] ) ?>" 
				class="wpb_vc_param_value wpb-ultiselect 
				<?php
				echo esc_attr( $settings['param_name'] );
				echo ' ';
				echo esc_attr( $settings['type'] );
				?>_field">
			<?php
			$val = crazyblog_set( $settings, 'value' );
			if ( !empty( $val ) ) {
				foreach ( $val as $k => $v ) {
					$selected = (in_array( $k, $checkVal )) ? 'selected' : '';
					echo '<option ' . $selected . ' value="' . $k . '">' . $v . '</option>';
				}
			}
			?>
		</select>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	if ( function_exists( 'crazyblog_vcToggle' ) ) {
		crazyblog_vcToggle();
	}

	function customBuildStyle( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '' ) {
		$has_image = false;
		$style = '';
		if ( (int) $bg_image > 0 && ($image_url = wp_get_attachment_url( $bg_image, 'large' )) !== false ) {
			$has_image = true;
			$style.= "background-image: url(" . $image_url . ");";
		}
		if ( !empty( $bg_color ) ) {
			$style.= 'background-color: ' . $bg_color . ';';
		}
		if ( !empty( $bg_image_repeat ) && $has_image ) {
			if ( $bg_image_repeat === 'cover' ) {
				$style.= "background-repeat:no-repeat;background-size: cover;";
			} elseif ( $bg_image_repeat === 'contain' ) {
				$style.= "background-repeat:no-repeat;background-size: contain;";
			} elseif ( $bg_image_repeat === 'no-repeat' ) {
				$style.= 'background-repeat: no-repeat;';
			}
		}
		if ( !empty( $font_color ) ) {
			$style.= 'color: ' . $font_color . ';';
		}
		if ( $padding != '' ) {
			$style.= 'padding: ' . (preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px') . ';';
		}
		if ( $margin_bottom != '' ) {
			$style.= 'margin-bottom: ' . (preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px') . ';';
		}
		return empty( $style ) ? $style : ' style="' . $style . '"';
	}

}
