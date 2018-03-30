<?php 
/*CUSTOM HEADING*/
add_shortcode('oi_vc_heading', 'oi_vc_heading_f');
function oi_vc_heading_f( $atts, $content = null)
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
		
	}
	// Enqueue the icon font that we're using.
	vc_icon_element_fonts_enqueue( $icon_type );
	extract(shortcode_atts(
		array(
			'icon_type' => 'None',
			'oi_title' => 'This is Title',
			'oi_sub_title' => 'Asesome subtitle goes here',
			'oi_title_color'=>'#0000',
			'oi_heading_p'=>'0px',
			'oi_heading_bg'=>'#fff',
			'oi_title_size'=>'h3',
			'oi_title_style'=>'normal',
			'oi_sub_title_color'=>'#666',
			'oi_sub_title_size'=>'p',
			'oi_sub_title_style'=>'normal',
			'oi_align'=>'left',
			'oi_border' => 'none',
			'oi_border_w' => '100px',
			'oi_border_h' => '1px',
			'oi_border_s' => 'solid',
			'oi_border_c' => 'eaeaea',
			'oi_icon_c' => '#000',
			'oi_icon_w' => '24px',
			'oi_icon_p' => '0px',
			'oi_heading_mb' => '20px',
			'icon_fontawesome' => '',
			'icon_openiconic'  => '',
			'icon_typicons'    => '',
			'icon_entypo'      => '',
			'icon_linecons'    => '',
		), $atts)
	);
	$content = '';
	$oi_border_otput = '';
	$oi_icon_output ='';
	if($oi_border == 'left'){
		$oi_border_otput ='border-left: '.$oi_border_h.' '.$oi_border_s.' '.$oi_border_c.';';
	}elseif($oi_border == 'right'){
		$oi_border_otput ='border-right: '.$oi_border_h.' '.$oi_border_s.' '.$oi_border_c.';';
	};
	$content .='<div class="oi_custom_heading_holder" style="margin-bottom:'.$oi_heading_mb.'; padding:'.$oi_heading_p.'; background:'.$oi_heading_bg.'">';
		$oi_icon_output .='<i class="'.$icon.'" style="font-size:'.$oi_icon_w.'; line-height:'.$oi_icon_w.'; color:'.$oi_icon_c.'"></i>';
		if($oi_border == 'top'){
			$content .='<div class="oi_heading_border oi_border_position_'.$oi_border.'" style="text-align:'.$oi_align.'; height:'.$oi_border_h.'"><span style="text-align:'.$oi_align.'; width:'.$oi_border_w.'; border-top:'.$oi_border_h.' '.$oi_border_s.' '.$oi_border_c.';"></span></div>';
		};
			if($icon_type !='None'){
				if ($oi_align == 'left'){
					$content .='<div class="oi_heading_icon oi_heading_icon_'.$oi_align.'">'.$oi_icon_output.'</div>';
				};
				if ($oi_align== 'right'){
					$content .='<div class="oi_heading_icon oi_heading_icon_'.$oi_align.'">'.$oi_icon_output.'</div>';
				};	
			};
			$content .='<div class="oi_vc_heading oi_border_position_'.$oi_border.'" style="text-align:'.$oi_align.'; '.$oi_border_otput.'">';
				if($icon_type !='None'){
					if ($oi_align == 'center'){
						$content .='<div class="oi_heading_icon oi_heading_icon_'.$oi_align.'">'.$oi_icon_output.'</div>';
					};
				};
				$content .='<'.$oi_title_size.' style="color:'.$oi_title_color.'; font-style:'.$oi_title_style.';" class="oi_icon_titile">'.$oi_title.'</'.$oi_title_size.'>';
				if($oi_border == 'center'){
					$content .='<div class="oi_heading_border oi_border_position_'.$oi_border.'" style="text-align:'.$oi_align.';"><span style="text-align:'.$oi_align.'; width:'.$oi_border_w.'; border-top:'.$oi_border_h.' '.$oi_border_s.' '.$oi_border_c.';"></span></div>';
				};
				if($oi_sub_title != '') {
					$content .='<'.$oi_sub_title_size.' style="color:'.$oi_sub_title_color.'; font-style:'.$oi_sub_title_style.';" class="oi_icon_sub_titile">'.$oi_sub_title.'</'.$oi_sub_title_size.'>';
				};
				if($oi_border == 'bottom'){
					$content .='<div class="oi_heading_border oi_border_position_'.$oi_border.'" style="text-align:'.$oi_align.';"><span style="text-align:'.$oi_align.'; width:'.$oi_border_w.'; border-top:'.$oi_border_h.' '.$oi_border_s.' '.$oi_border_c.';"></span></div>';
				};
	   		$content .='</div>';
			
		
	$content .='</div>';
	return $content;
};


/*VC_MAP*/
vc_map( array(
	"name" => __("Custom heading",'orangeidea'),
	"base" => "oi_vc_heading",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"icon" => "oi_icon_heading",
	"category" => __('BUILDER','orangeidea'),
	"params" => array(
		
		
		

		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title",
			"heading" => __("Title", "orangeidea"),
			"value" => 'This is Title',
			"group" => "Title"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Title Size",
			'param_name' => 'oi_title_size',
			'value' => array( "h1", "h2", "h3", "h4", "h5", "h6", "p" ),
			'std' => 'h3',
			"group" => "Title"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Title Style",
			'param_name' => 'oi_title_style',
			'value' => array( "normal", "italic" ),
			"group" => "Title"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_title_color",
			"heading" => __("Title Color", "orangeidea"),
			"value" => '#000',
			"group" => "Title"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_sub_title",
			"heading" => __("Sub Title", "orangeidea"),
			"value" => 'Asesome subtitle goes here',
			"group" => "Sub Title"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Sub Title Style",
			'param_name' => 'oi_sub_title_size',
			'value' => array( "p", "h6", "h5", "h4", "h3", "h2", "h1", ),
			'std' => 'p',
			"group" => "Sub Title"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Sub Title Size",
			'param_name' => 'oi_sub_title_style',
			'value' => array( "normal", "italic" ),
			"group" => "Sub Title"
		),
		
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_sub_title_color",
			"heading" => __("Sub Title Color", "orangeidea"),
			"value" => '#666',
			"group" => "Sub Title"
		),
		array(
			'type' => 'dropdown',
			'heading' => "Heading align",
			'param_name' => 'oi_align',
			'value' => array( "left", "center", "right" ),
			"group" => "Title"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_heading_mb",
			"heading" => __("Heading margin bottom", "orangeidea"),
			"value" => '20px',
			"group" => "Title"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_heading_p",
			"heading" => __("Heading paddings", "orangeidea"),
			"value" => '0px',
			"group" => "Title"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_heading_bg",
			"heading" => __("Heading background", "orangeidea"),
			"value" => '#fff',
			"group" => "Title"
		),
		
		
		array(
			'type' => 'dropdown',
			'heading' => "Heading border",
			'param_name' => 'oi_border',
			'value' => array("none", "bottom", "center", "top", "left", "right" ),
			"group" => "Border"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_w",
			"heading" => __("Border Width", "orangeidea"),
			"value" => '100px',
			"group" => "Border"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_h",
			"heading" => __("Border height", "orangeidea"),
			"value" => '1px',
			"group" => "Border"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_border_c",
			"heading" => __("Border Color", "orangeidea"),
			"value" => '#eaeaea',
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
			"param_name" => "oi_icon_w",
			"heading" => __("Icon Size", "orangeidea"),
			"value" => '24px',
			"group" => "Icon"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_c",
			"heading" => __("Icon Color", "orangeidea"),
			"value" => '#000',
			"group" => "Icon"
		),
		
		
		
	)
) );


