<?php
/*ICONS LISTS*/
add_shortcode('oi_icons_list', 'oi_icons_list_f');
function oi_icons_list_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'oi_list_item_contetn' => '',
			'oi_align' => 'left'
		), $atts)
	);
	$output ='<ul class="oi_icon_list oi_icon_list_align_'.$oi_align.'">'.do_shortcode($content).'</ul>';
	return $output;
}

/*ICON LISTS*/

vc_map( array(
    "name" => __("Icons List", "my-text-domain"),
    "base" => "oi_icons_list",
	"category" => __('BUILDER','orangeidea'),
    "as_parent" => array('only' => 'oi_list_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => true,
    "params" => array(
		array(
			'type' => 'dropdown',
			'heading' => "List Align",
			'param_name' => 'oi_align',
			'value' => array( "left", "right","center" ),
		),
		
    ),
    "js_view" => 'VcColumnView'
) );





/*List Item*/
add_shortcode('oi_list_item', 'oi_list_item_f');
function oi_list_item_f( $atts, $content = null)
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
			'oi_title' => 'List Item Title',
			'oi_item_margin' => '10px',
			'oi_title_color'=>'#000',
			'oi_title_size'=>'p',
			'oi_title_style'=>'normal',
			'oi_icon_bg' => '',
			'oi_icon_w' => '20px',
			'oi_icon_c' => '#999',
			'oi_icon_space' => '14px',
			'oi_icon_p' => '',
			'oi_icon_r' => '',
			'oi_sub_title' => '',
			'oi_sub_title_color'=>'#666',
			'oi_sub_title_size'=>'p',
			'oi_sub_title_style'=>'normal',
			'icon_fontawesome' => '',
			'icon_openiconic'  => '',
			'icon_typicons'    => '',
			'icon_entypo'      => '',
			'icon_linecons'    => '',
			
		), $atts)
	);
	$oi_icon_output ='<i class="'.$icon.'" style="font-size:'.$oi_icon_w.'; line-height:'.$oi_icon_w.'; color:'.$oi_icon_c.'"></i>';
	$output ='<li class="oi_list_item" style="margin-bottom:'.$oi_item_margin.'">';
				if($icon_type !='None'){
					$output .='<div class="oi_list_item_icon_holder oi_icon_left">
									<div class="oi_icon_inner_holder" style="margin-right:'.$oi_icon_space.'; padding:'.$oi_icon_p.'; border-radius:'.$oi_icon_r.'; background-color:'.$oi_icon_bg.';">
										'.$oi_icon_output.'
									</div>
								</div>';
				};
				if($icon_type !='None'){
					$output .='<div class="oi_list_item_icon_holder oi_icon_center">
									<div class="oi_icon_inner_holder" style="margin-bottom:'.$oi_icon_space.'; padding:'.$oi_icon_p.'; border-radius:'.$oi_icon_r.'; background-color:'.$oi_icon_bg.';">
										'.$oi_icon_output.'
									</div>
								</div>';
				}
				
				$output .='<div class="oi_list_item_content_holder">
							<'.$oi_title_size.' style="color:'.$oi_title_color.'; font-style:'.$oi_title_style.';" class="oi_item_title">'.$oi_title.'</'.$oi_title_size.'>';
							if(!in_array($oi_sub_title,array('-',''))){
								$output .='<'.$oi_sub_title_size.' style="color:'.$oi_sub_title_color.'; font-style:'.$oi_sub_title_style.';" class="oi_item_sub_title">'.$oi_sub_title.'</'.$oi_sub_title_size.'>';
							};
						$output .='</div>';
				if($icon_type !='None'){
					$output .='<div class="oi_list_item_icon_holder oi_icon_right">
									<div class="oi_icon_inner_holder" style="margin-left:'.$oi_icon_space.'; padding:'.$oi_icon_p.'; border-radius:'.$oi_icon_r.'; background-color:'.$oi_icon_bg.';">
										'.$oi_icon_output.'
									</div>
								</div>';
				};
			$output .='</li>';
	return $output;
};



vc_map( array(
    "name" => __("List Item", "my-text-domain"),
    "base" => "oi_list_item",
	"category" => __('BUILDER','orangeidea'),
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
    "content_element" => true,
    "as_child" => array('only' => 'oi_icons_list'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
        array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_item_margin",
			"heading" => __("Item bottom Margin", "orangeidea"),
			"value" => '10px',
			"group" => "General"
		),
		array(
            "type" => "textfield",
            "heading" => __("Title", "orangeidea"),
            "param_name" => "oi_title",
            "group" => "Title",
			"value" => 'List Item Title',
        ),
		array(
			'type' => 'dropdown',
			'heading' => "Title Size",
			'param_name' => 'oi_title_size',
			'value' => array( "h1", "h2", "h3", "h4", "h5", "h6", "p" ),
			'std' => 'p',
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
			"value" => '20px',
			"group" => "Icon"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_c",
			"heading" => __("Icon Color", "orangeidea"),
			"value" => '#999',
			"group" => "Icon"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_bg",
			"heading" => __("Icon background", "orangeidea"),
			"value" => '',
			"group" => "Icon"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_p",
			"heading" => __("Icon paddings", "orangeidea"),
			"value" => '',
			"group" => "Icon"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_r",
			"heading" => __("Icon border radius", "orangeidea"),
			"value" => '',
			"group" => "Icon"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_icon_space",
			"heading" => __("Space between icon and text", "orangeidea"),
			"value" => '14px',
			"group" => "Icon"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_sub_title",
			"heading" => __("Sub Title", "orangeidea"),
			"value" => '',
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
    )
) );
