<?php
$categories = array();
$categories = get_categories();
$category_slug_array = array('');
foreach($categories as $category)
{
	$category_slug_array[] = $category->slug;
}


vc_map( array(
        'name' =>'Webnus Latest From Blog',
        'base' => 'latestblog',
        "icon" => "webnus_latestfromblog",
		"description" => "Recent posts",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        'params' => array(
						array(
							"type" => "dropdown",
							"heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "type",
							"value" => array(
								"Rose"=>"rose",
								"Jasmine"=>"jasmine",
								"Violet"=>"violet",
								"Orchid"=>"orchid",										
							),
							"description" => __( "Type", 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							'type' => 'dropdown',
							'heading' => __( 'Category', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'category',
							'value'=>$category_slug_array,
							'description' => __( 'Select specific category, leave blank to show all categories.', 'WEBNUS_TEXT_DOMAIN')
						),
					),    
		) );
?>