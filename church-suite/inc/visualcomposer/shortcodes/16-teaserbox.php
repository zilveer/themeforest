<?php vc_map( array(
	'name' =>'Teaser Box',
	'base' => 'teaserbox',
	'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
	"description" => "Image and icon with text article",
	"icon" => "webnus_teaserbox",
	'params'=>array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Type", 'webnus_framework' ),
			"param_name" => "type",
			"value" => array(
				"Type 1"=>"1",
				"Type 2"=>"2",
				"Type 3"=>"3",
				"Type 4"=>"4",
				"Type 5"=>"5",
				"Type 6"=>"6",
				"Type 7"=>"7",
			),
			"description" => esc_html__( "TeaserBox Type", 'webnus_framework')
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'webnus_framework' ),
			'param_name' => 'img',
			'value'=>'',
			'description' => esc_html__( 'TeaserBox Image', 'webnus_framework')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'webnus_framework' ),
			'param_name' => 'title',
			'value'=>'',
			'description' => esc_html__( 'Enter the Title', 'webnus_framework')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Subtitle', 'webnus_framework' ),
			'param_name' => 'subtitle',
			'value'=>'',
			'description' => esc_html__( 'Enter the Subtitle', 'webnus_framework')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Link URL', 'webnus_framework' ),
			'param_name' => 'link_url',
			'value'=>'#',
			'description' => esc_html__( 'Enter the link url. Example: http://yourdomain.com', 'webnus_framework')
		),		
		array(
			'param_name' => 'target',
			'value' => array( esc_html__( 'Open link in a new window/tab.', 'webnus_framework' ) => 'blank'),
			'type' => 'checkbox',
			'std' => '',
		) ,							
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image alt', 'webnus_framework' ),
			'param_name' => 'img_alt',
			'value'=>'',
			'description' => esc_html__( 'Enter the image alt Text', 'webnus_framework')
		),		
	),
)); ?>