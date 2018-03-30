<?php

// [custom_add_to_cart]

function add_to_cart_product_field($settings, $value) {   
    $attr = array("post_type"=>"product", "orderby"=>"name", "order"=>"asc", 'posts_per_page'   => -1);
    $products = get_posts($attr); 
    $dependency = vc_generate_dependencies_attributes($settings);
    $data = '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'">';
    foreach($products as $product) {
        $selected = '';
        if ($value!='' && $product->ID == $value) {
             $selected = ' selected="selected"';
        }
        $data .= '<option class="'.$product->ID.'" value="'.$product->ID.'"'.$selected.'>'.$product->post_title.'</option>';
    }
    $data .= '</select>';
    return $data;
}
add_shortcode_param('product_id' , 'add_to_cart_product_field');

vc_map(array(
   "name"			=> "Add to Cart Button",
   "category"		=> 'WooCommerce',
   "description"	=> "",
   "base"			=> "custom_add_to_cart",
   "class"			=> "",
   "icon"			=> "custom_add_to_cart",
   
   "params" 	=> array(
      
		array(
			"type"			=> "product_id",
			"holder"		=> "div",
			"class"			=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "ID",
			"param_name"	=> "id",
			"value"			=> "",
		),
		
		/*array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "SKU",
			"param_name"	=> "sku",
			"value"			=> "",
		),*/
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Show Price",
			"param_name"	=> "show_price",
			"value"			=> array(
				"Yes"			=> "true",
				"No"			=> "false"
			),
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Size",
			"param_name"	=> "size",
			"value"			=> array(
				"Mini"			=> "vc_btn_xs",
				"Small"			=> "vc_btn_sm",
				"Normal"		=> "vc_btn_md",
				"Large"			=> "vc_btn_lg"
			),
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Style",
			"param_name"	=> "style",
			"value"			=> array(
				"Square"			=> "vc_btn_square",
				"Square Outlined"	=> "vc_btn_square_outlined",
				"Rounded"			=> "vc_btn_rounded",
				"Rounded Outlined"	=> "vc_btn_rounded_outlined",
				"Link"				=> "vc_btn_link",
			),
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Align",
			"param_name"	=> "align",
			"value"			=> array(
				"Left"			=> "left",
				"Center"		=> "center",
				"Right"			=> "right",
			),
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Text Color",
			"param_name"	=> "text_color",
			"value"			=> "",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Background Color",
			"param_name"	=> "bg_color",
			"value"			=> "",
		),
   )
   
));