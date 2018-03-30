<?php
/*PRICING TABLE*/
add_shortcode('oi_price_table', 'oi_price_table_f');
function oi_price_table_f( $atts, $content = null)
{
	extract(shortcode_atts(
        array(
			'oi_featured' => 'standard',
			'oi_pt_b' => '5px',
			'oi_pt_r' => '5px',
			'oi_pt_b_c' => '#f1f1f1',
			'oi_pt_bg' => '#fff',
			'oi_pt_sep' => '#eaeaea',
			
			'oi_pt_title' => 'Title',
			'oi_pt_title_c' => '#000',
			
			'oi_pt_desc' => 'This is description',
			'oi_pt_desc_c' => '#888',
			
			'oi_pt_cur' => '$',
			'oi_pt_cur_c' => '#888',
			
			'oi_pt_per' => '/mo',
			'oi_pt_per_c' => '#888',
			
			'oi_pt_price' => '9.99',
			'oi_pt_price_c' => '#000',
			
    ), $atts));
	$output= '';
	$output .= '
	<div class="oi_pt_holder oi_pt_'.$oi_featured.'" style=" background-color:'.$oi_pt_bg.'; border-width:'.$oi_pt_b.'; border-color:'.$oi_pt_b_c.'; border-radius:'.$oi_pt_r.';">
		<div class="oi_pt_header">
			<h4 class="oi_pt_title"><span style="color:'.$oi_pt_title_c.'">'.$oi_pt_title.'</span></h4>
			<p class="oi_pt_desc" style="border-bottom-color:'.$oi_pt_sep.'; color:'.$oi_pt_desc_c.'">'.$oi_pt_desc.'</p>
			<span class="oi_pt_price"  style="color:'.$oi_pt_price_c.'"><span class="oi_pr_cur" style="color:'.$oi_pt_cur_c.'">'.$oi_pt_cur.'</span>'.$oi_pt_price.'<span class="oi_pr_period" style="color:'.$oi_pt_per_c.'">'.$oi_pt_per.'</span></span>
		</div>
		<div class="clearfix"></div>
		<div>
			<ul class="oi_pt_list" style="border-top-color:'.$oi_pt_sep.'">'.do_shortcode($content).'</ul>
		</div>
	</div>';
	return $output;

};

/*PRICE TABLE*/
vc_map( array(
    "name" => __("Pricing Table", "orangeidea"),
    "base" => "oi_price_table",
	"category" => __('BUILDER','orangeidea'),
    "as_parent" => array('only' => 'oi_list_item, oi_vc_button'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => true,
    "params" => array(
		
		array(
			'type' => 'dropdown',
			'heading' => "Table Style",
			'param_name' => 'oi_featured',
			'value' => array( "standard", "featured"),
			'std' => 'standard',
			"group" => "Design"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_b",
			"heading" => __("Border Width", "orangeidea"),
			"value" => '5px',
			"group" => "Design"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_r",
			"heading" => __("Border Radius", "orangeidea"),
			"value" => '5px',
			"group" => "Design"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_b_c",
			"heading" => __("Table Border Color", "orangeidea"),
			"value" => '#f1f1f1',
			"group" => "Design"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_bg",
			"heading" => __("Table Background", "orangeidea"),
			"value" => '#fff',
			"group" => "Design"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_sep",
			"heading" => __("Separators Color", "orangeidea"),
			"value" => '#eaeaea',
			"group" => "Design"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_title",
			"heading" => __("Title", "orangeidea"),
			"value" => 'Title',
			"group" => "Content"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_title_c",
			"heading" => __("Title Color", "orangeidea"),
			"value" => '#000',
			"group" => "Content"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_desc",
			"heading" => __("Description", "orangeidea"),
			"value" => 'This is description',
			"group" => "Content"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_desc_c",
			"heading" => __("Description Color", "orangeidea"),
			"value" => '#888',
			"group" => "Content"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_cur",
			"heading" => __("Curency", "orangeidea"),
			"value" => '$',
			"group" => "Content"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_cur_c",
			"heading" => __("Curency Color", "orangeidea"),
			"value" => '#888',
			"group" => "Content"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_price",
			"heading" => __("Price Value", "orangeidea"),
			"value" => '9.99',
			"group" => "Content"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_price_c",
			"heading" => __("Price Color", "orangeidea"),
			"value" => '#000',
			"group" => "Content"
		),
		
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_per",
			"heading" => __("Period Value", "orangeidea"),
			"value" => '/mo',
			"group" => "Content"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"param_name" => "oi_pt_per_c",
			"heading" => __("Period Color", "orangeidea"),
			"value" => '#888',
			"group" => "Content"
		),
		
		
		
    ),
    "js_view" => 'VcColumnView'
) );

