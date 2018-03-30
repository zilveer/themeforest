<?php

// [product_category]


// product_category_field
function product_category_field($settings, $value) {   
    $categories = get_terms('product_cat'); 
    $dependency = vc_generate_dependencies_attributes($settings);
    $data = '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'">';
    foreach($categories as $category) {
        $selected = '';
        if ($value!=='' && $category->slug === $value) {
             $selected = ' selected="selected"';
        }
        $data .= '<option class="'.$category->slug.'" value="'.$category->slug.'"'.$selected.'>' . $category->name . ' (' . $category->count . ' products)</option>';
    }
    $data .= '</select>';
    return $data;
}
add_shortcode_param('product_category' , 'product_category_field');



vc_map(array(
   "name" 			=> "Products by Category",
   "category" 		=> 'WooCommerce',
   "description"	=> "",
   "base" 			=> "product_category",
   "class" 			=> "",
   "icon" 			=> "product_category",
   
   "params" 	=> array(
		
		array(
			"type" => "product_category",
			"holder" => "div",
			"heading" => "Category",
			"param_name" => "category",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Number of Products",
			"description"	=> "",
			"param_name"	=> "per_page",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Columns",
			"description"	=> "",
			"param_name"	=> "columns",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Order By",
			"description"	=> "",
			"param_name"	=> "orderby",
			"value"			=> array(
				"None"	=> "none",
				"ID"	=> "ID",
				"Title"	=> "title",
				"Date"	=> "date",
				"Rand"	=> "rand"
			),
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Order",
			"description"	=> "",
			"param_name"	=> "order",
			"value"			=> array(
				"Desc"	=> "desc",
				"Asc"	=> "asc"
			),
		),
   )
   
));