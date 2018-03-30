<?php

$categories = array();

$categories = get_categories();

$category_slug_array = array();
foreach($categories as $category)
{
	$category_slug_array[] = $category->slug;
}

vc_map( array(
        'name' =>'Webnus Categorybox',
        'base' => 'categorybox',
		"description" => "Show Categorybox, By category filter",
        "icon" => "webnus_categorybox",
        'params'=>array(
					
					
				array(
						'type' => 'dropdown',
						'heading' => __( 'Category', 'WEBNUS_TEXT_DOMAIN' ),
						'param_name' => 'category',
						'value'=>$category_slug_array,
						'description' => __( 'Select specific category', 'WEBNUS_TEXT_DOMAIN')
				),
				array(
						'type' => 'textfield',
						'heading' => __( 'Title', 'WEBNUS_TEXT_DOMAIN' ),
						'param_name' => 'title',
						'value'=>__( 'Categorybox', 'WEBNUS_TEXT_DOMAIN' ),
						'description' => __( 'Set title', 'WEBNUS_TEXT_DOMAIN')
				),
				array(
						'type' => 'dropdown',
						'heading' => __( 'Show title', 'WEBNUS_TEXT_DOMAIN' ),
						'param_name' => 'show_title',
						'value'=>array('Show'=>'true','Hide'=>'false'),
						'description' => __( 'Show/Hide title', 'WEBNUS_TEXT_DOMAIN')
				),
				array(
						'type' => 'textfield',
						'heading' => __( 'Posts count', 'WEBNUS_TEXT_DOMAIN' ),
						'param_name' => 'post_count',
						'value'=>'5',
						'description' => __( 'How many posts to dispaly?', 'WEBNUS_TEXT_DOMAIN')
				),
				array(
						'type' => 'dropdown',
						'heading' => __( 'Show date', 'WEBNUS_TEXT_DOMAIN' ),
						'param_name' => 'show_date',
						'value'=>array('Show'=>'true','Hide'=>'false'),
						'description' => __( 'Show/Hide date', 'WEBNUS_TEXT_DOMAIN')
				),
					
				array(
						'type' => 'dropdown',
						'heading' => __( 'Show category', 'WEBNUS_TEXT_DOMAIN' ),
						'param_name' => 'show_category',
						'value'=>array('Show'=>'true','Hide'=>'false'),
						'description' => __( 'Show/Hide category', 'WEBNUS_TEXT_DOMAIN')
				),
				array(
						'type' => 'dropdown',
						'heading' => __( 'Show author', 'WEBNUS_TEXT_DOMAIN' ),
						'param_name' => 'show_author',
						'value'=>array('Show'=>'true','Hide'=>'false'),
						'description' => __( 'Show/Hide author', 'WEBNUS_TEXT_DOMAIN')
				),
					

					
		),
		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        
    ) );
?>