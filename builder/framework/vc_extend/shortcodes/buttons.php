<?php 
/*BUTTONS*/
add_shortcode('oi_vc_button', 'oi_vc_button_f');
function oi_vc_button_f( $atts, $content = null)
{
	
	$icon_type = $atts['icon_type'];
	switch ( $icon_type ) {
		case 'fontawesome':
			$icon = $atts['icon_fontawesome'];
			break;
		case 'openiconic':
			$icon = $atts['icon_openiconic'];
			break;
		case 'typicons':
			$icon = $atts['icon_typicons'];
			break;
		case 'entypo':
			$icon = $atts['icon_entypo'];
			break;
		case 'linecons':
			$icon = $atts['icon_linecons'];
			break;
		
	};
	// Enqueue the icon font that we're using.
	vc_icon_element_fonts_enqueue( $icon_type );
	extract(shortcode_atts(
		array(
			'icon_type' => 'None',
			'oi_title' => 'Button',
			'oi_title_size'=>'16px',
			'oi_title_color'=>'#fff',
			'oi_bg_color'=>'#000',
			'oi_url' => '#',
			'oi_icon_color'=>'#000',
			'oi_icon_color_hover'=>'#000',
			'oi_display' => 'block',
			'oi_target'=>'_self',
			'oi_padding'=>'10px 20px',
			'oi_border_w' => '1px',
			'oi_border_s' => 'solid',
			'oi_border_c' => '#000',
			'oi_border_r' => '3px',
			'oi_title_color_hover'=>'#fff',
			'oi_bg_color_hover'=>'#00f6ff',
			'oi_border_c_hover' => '#00f6ff',
			'oi_icon_s' => '16px',
			'oi_align' => 'left',
			'icon_fontawesome' => '',
			'icon_openiconic'  => '',
			'icon_typicons'    => '',
			'icon_entypo'      => '',
			'icon_linecons'    => '',

		), $atts)
	);
	$content = '';
	$oi_icon_output ='<i class="'.$icon.' oi_button_icon oi_button_icon_'.$oi_align.'" style="font-size:'.$oi_icon_s.'; color:'.$oi_icon_color.';"></i>';

	$content .='<a class="oi_vc_button" data-icon-color-hover="'.$oi_icon_color_hover.'" data-title-color-hover="'.$oi_title_color_hover.'" data-bg-color-hover="'.$oi_bg_color_hover.'" data-border-c-hover="'.$oi_border_c_hover.'"  href="'.$oi_url.'" target="'.$oi_target.'" style="display:'.$oi_display.'; font-size:'.$oi_title_size.'; line-heigth:'.$oi_title_size.'; color:'.$oi_title_color.'; background-color:'.$oi_bg_color.'; padding:'.$oi_padding.'; border-width:'.$oi_border_w.'; border-style:'.$oi_border_s.'; border-color:'.$oi_border_c.'; border-radius:'.$oi_border_r.'">';
		if($icon_type !='None'){
			if ($oi_align == 'center'){
				$content .= '<span class="oi_vc_button_icon_holder">'.$oi_icon_output.'</span>';
			};
		};
		if($icon_type !='None'){
			if ($oi_align == 'left'){
				$content .= $oi_icon_output;
			};
		};
		$content .= $oi_title;
		if($icon_type !='None'){
			if ($oi_align == 'right'){
				$content .= $oi_icon_output;
			};
		};
	
	$content .='</a>';
	return $content;
};


/*BUTTONS*/
vc_map( array(
	"name" => __("BUTTON",'orangeidea'),
	"base" => "oi_vc_button",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"icon" => "oi_icon_button",
	"category" => __('BUILDER','orangeidea'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_url",
			"heading" => __("URL", "orangeidea"),
			"value" => '#',
			"group" => "General"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Target",
			'param_name' => 'oi_target',
			'value' => array( "_blank", "_self" ),
			'std' => '_self',
			"group" => "General"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Display",
			'param_name' => 'oi_display',
			'value' => array( "block", "inline-block" ),
			'std' => 'block',
			"group" => "General"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title",
			"heading" => __("Title", "orangeidea"),
			"value" => 'Button',
			"group" => "Title"
		),
		
		
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title_size",
			"heading" => __("Font Size", "orangeidea"),
			"value" => '16px',
			"group" => "Title"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title_color",
			"heading" => __("Title Color", "orangeidea"),
			"value" => '#fff',
			"group" => "Title"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title_color_hover",
			"heading" => __("HOVER Title Color", "orangeidea"),
			"value" => '#fff',
			"group" => "Title"
		),
		
		array(
				'type' => 'dropdown',
				'heading' => __( 'Icon library', 'orangeidea' ),
				'value' => array(
					__( 'None', 'orangeidea' ) => 'None',
					__( 'Font Awesome', 'orangeidea' ) => 'fontawesome',
					__( 'Open Iconic', 'orangeidea' ) => 'openiconic',
					__( 'Typicons', 'orangeidea' ) => 'typicons',
					__( 'Entypo', 'orangeidea' ) => 'entypo',
					__( 'Linecons', 'orangeidea' ) => 'linecons',
				),
				
				'param_name' => 'icon_type',
				'description' => __( 'Select icon library.', 'orangeidea' ),
				"group" => "Icon"
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'orangeidea' ),
				'param_name' => 'icon_fontawesome',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'fontawesome',
				),
				'description' => __( 'Select icon from library.', 'orangeidea' ),
				"group" => "Icon"
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'orangeidea' ),
				'param_name' => 'icon_openiconic',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'openiconic',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'openiconic',
				),
				'description' => __( 'Select icon from library.', 'orangeidea' ),
				"group" => "Icon"
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'orangeidea' ),
				'param_name' => 'icon_typicons',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'typicons',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'typicons',
				),
				'description' => __( 'Select icon from library.', 'orangeidea' ),
				"group" => "Icon"
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'orangeidea' ),
				'param_name' => 'icon_entypo',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'entypo',
					'iconsPerPage' => 300, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'entypo',
				),
				"group" => "Icon"
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'orangeidea' ),
				'param_name' => 'icon_linecons',
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'linecons',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'linecons',
				),
				'description' => __( 'Select icon from library.', 'orangeidea' ),
				"group" => "Icon"
			),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_s",
			"heading" => __("Icon Size", "orangeidea"),
			"value" => '16px',
			"group" => "Icon"
		),
		
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_color",
			"heading" => __("Icon Color", "orangeidea"),
			"value" => '#000',
			"group" => "Icon"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_color_hover",
			"heading" => __("Icon Color on Hover", "orangeidea"),
			"value" => '#000',
			"group" => "Icon"
		),
		

		array(
			'type' => 'dropdown',
			'heading' => "Icon align",
			'param_name' => 'oi_align',
			'value' => array( "left", "right", "center"),
			'std' => 'left',
			"group" => "Icon"
		),
		
		
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_bg_color",
			"heading" => __("Background Color", "orangeidea"),
			"value" => '#000',
			"group" => "Background"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_bg_color_hover",
			"heading" => __("HOVER Background Color", "orangeidea"),
			"value" => '#00f6ff',
			"group" => "Background"
		),
		
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_padding",
			"heading" => __("Padding", "orangeidea"),
			"value" => '10px 20px',
			"group" => "General"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_w",
			"heading" => __("Border Width", "orangeidea"),
			"value" => '1px',
			"group" => "Border"
		),

		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_c",
			"heading" => __("Border Color", "orangeidea"),
			"value" => '#000',
			"group" => "Border"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_c_hover",
			"heading" => __("HOVER Border Color", "orangeidea"),
			"value" => '#00f6ff',
			"group" => "Border"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Border Style",
			'param_name' => 'oi_border_s',
			'value' => array( "solid", "dotted", "dashed"),
			"group" => "Border"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_r",
			"heading" => __("Border radius", "orangeidea"),
			"value" => '3px',
			"group" => "Border"
		),
		
		
		
		
	)
) );


