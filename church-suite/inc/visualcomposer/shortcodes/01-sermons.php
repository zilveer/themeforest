<?php
$categories = array();
$categories = get_categories();
$category_slug_array = array('');
foreach($categories as $category)
{
	$category_slug_array[] = $category->slug;
}

vc_map( array(
        'name' =>'Webnus Sermons',
        'base' => 'sermons',
        "icon" => "sermons",
		"description" => "Show Latest Or Popular Sermons",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        'params' => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'webnus_framework' ),
							"param_name" => "type",
							"value" => array(
								"Toggle"=>"toggle",
								"Minimal"=>"minimal",
								"Grid"=>"grid",
								"Clean"=>"clean",
								"Simple"=>"simple"
							),
							"description" => esc_html__( "You can choose among these pre-designed types.", 'webnus_framework')
						),
						
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Order by", 'webnus_framework' ),
							"param_name" => "sort",
							"value" => array(
								"Most Recent"=>"",
								"Most Popular"=>"view",
							),
							"description" => esc_html__( "Recent Or Popular?", 'webnus_framework')
						),
					
						array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Post Count', 'webnus_framework' ),
						'param_name' => 'count',
						'value' => '',
						'description' => esc_html__( 'Type nothing to default (6) and type 0 to show all.', 'webnus_framework')
						),
						
						array(
							'heading' => esc_html__('Page Navigation', 'webnus_framework') ,
							'description' => wp_kses( __('Enable page navigation.<br/><br/>', 'webnus_framework'), array( 'br' => array() ) ),
							'param_name' => 'page',
							'value' => array( esc_html__( 'Enable', 'webnus_framework' ) => 'enable'),
							'type' => 'checkbox',
							'std' => '',
						) ,
			
						array(
							"type" => "iconfonts",
							"heading" => esc_html__( "Icon", 'webnus_framework' ),
							"param_name" => "icon",
							'value'=>'',
							"description" => esc_html__( "Show an icon on the left side of the sermon title.", 'webnus_framework'),
							"dependency" => array('element'=>'type','value'=>array('minimal')),
						),			
					
						
					),      
		) );
?>