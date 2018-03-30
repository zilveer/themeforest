<?php
$categories = array();
$categories = get_categories();
$category_slug_array = array('');
foreach($categories as $category)
{
	$category_slug_array[] = $category->slug;
}
vc_map( array(
        'name' =>'Latest News',
        'base' => 'latestnews',
        "icon" => "latestnews",
		"description" => "Latest News",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        'params' => array(
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Type", 'webnus_framework' ),
				"param_name" => "type",
				"value" => array(
					"Cover"=>"1",
					"List"=>"2",
				),

				"description" => esc_html__( "Select style type", 'webnus_framework')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Category', 'webnus_framework' ),
				'param_name' => 'category',
				'value'=>$category_slug_array,
				'description' => esc_html__( 'Select specific category, leave blank to show all categories.', 'webnus_framework')
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Auhtor name', 'webnus_framework' ),
				'param_name' => 'author',
				'value'=>'',
				'description' => esc_html__( 'Type Author name. When you type nothing it puts latest post as default to show.', 'webnus_framework'),
			), 

			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Post Count', 'webnus_framework' ),
				'param_name' => 'scount',
				'value' => '',
				'description' => esc_html__( 'Number of post(s) to show', 'webnus_framework')
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Count in row', 'webnus_framework' ),
				'param_name' => 'rcount',
				'value' => '',
				'description' => esc_html__( 'Number of post(s) in a row', 'webnus_framework'),
				"dependency" => array('element'=>'type','value'=>array('1')),
			),
			array(
				'heading' => esc_html__('Page Navigation', 'webnus_framework') ,
				'description' => wp_kses( __('Enable page navigation.<br/><br/>', 'webnus_framework'), array( 'br' => array() ) ),
				'param_name' => 'page',
				'value' => array( esc_html__( 'Enable', 'webnus_framework' ) => 'enable'),
				'type' => 'checkbox',
				'std' => '',
			) ,
		),    


	) );
?>