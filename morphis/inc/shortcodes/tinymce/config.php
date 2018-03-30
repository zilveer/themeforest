<?php

/*-----------------------------------------------------------------------------------*/
/*	LayerSlider Config
/*-----------------------------------------------------------------------------------*/
if( get_option('morphis_layerslider_activated', '0') == '1' ) {
$pulp_shortcodes['layerslider'] = array(
	'no_preview' => false,
	'params' => array(
		'id' => array(
			'type' => 'select',
			'label' => __('Layer Slider Slide Name', 'morphis'),
			'desc' => __('Select Slider Name', 'morphis'),
			'options' => get_layerslider_list(),			
		),		
	),
	'shortcode' => '[layerslider id="{{id}}"]',
	'popup_title' => __('Insert LayerSlider Shortcode', 'morphis')
);
}

/*-----------------------------------------------------------------------------------*/
/*	Google Map Static Image
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['gmap'] = array(
	'no_preview' => false,
	'params' => array(
		'center' => array(
			'std' => 'Marilao, Bulacan',
			'type' => 'text',
			'label' => __('Center (required)', 'morphis'),
			'desc' => __("The location of the map center as either text or as a latitude, longitude pair, example: 'chicago, illinois' or '41.88,-87.63'", 'morphis')
		),
		'zoom' => array(
			'std' => '14',
			'type' => 'text',
			'label' => __('Zoom (required)', 'morphis'),
			'desc' => __('The zoom (magnification) level, 0 (the whole world) to 21 (most detailed)', 'morphis')
		),		
		'scale' => array(
			'std' => '1',
			'type' => 'text',
			'label' => __('Scale', 'morphis'),
			'desc' => __('scaling for desktop or mobile usage , <a href="http://code.google.com/apis/maps/documentation/staticmaps/#scale_values" target="_blank">see scale parameter explanation</a>', 'morphis')
		),
		'map_height' => array(
			'std' => '500',
			'type' => 'text',
			'label' => __('Map Height', 'morphis'),
			'desc' => __('Enter the map height. The map\'s width will expand automatically to fit it\'s container.', 'morphis')
		),
		'sensor' => array(
			'std' => 'true',
			'type' => 'text',
			'label' => __('Sensor', 'morphis'),
			'desc' => __('True or false, see <a href="http://code.google.com/apis/maps/documentation/staticmaps/#Sensor" target="_blank">sensor parameter explanation</a>', 'morphis')
		),
		'maptype' => array(
			'std' => 'roadmap',
			'type' => 'text',
			'label' => __('Map Type', 'morphis'),
			'desc' => __('The type of map: roadmap, satellite, terrain, hybrid, <a href="http://code.google.com/apis/maps/documentation/staticmaps/#MapTypes" target="_blank">see maptypes parameter explanation</a>', 'morphis')
		),
		'format' => array(
			'std' => 'png',
			'type' => 'text',
			'label' => __('Format', 'morphis'),
			'desc' => __('Required image format, png, jpg, gif and others, <a href="http://code.google.com/apis/maps/documentation/staticmaps/#ImageFormats" target="_blank"></a>see format parameter explanation', 'morphis')
		),
		'caption' => array(
			'std' => __('Place your caption here.','morphis'),
			'type' => 'text',
			'label' => __('Add Caption', 'morphis'),
			'desc' => __('Add caption for the Map', 'morphis')
		)
	),
	'shortcode' => '[gsm_google_static_map center="{{center}}" zoom="{{zoom}}" scale="{{scale}}" map_height="{{map_height}}" sensor="{{sensor}}" maptype="{{maptype}}" format="{{format}}" caption="{{caption}}"]',
	'popup_title' => __('Insert Google Map', 'morphis')
);



/*-----------------------------------------------------------------------------------*/
/*	YouTube Embed
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['youtube'] = array(
	'no_preview' => true,
	'params' => array(
		'youtube_id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Youtube ID', 'morphis'),
			'desc' => __('Add the YouTube video\'s ID', 'morphis')
		),
		'youtube_caption' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add Caption', 'morphis'),
			'desc' => __('Add caption for the video', 'morphis')
		),
	),
	'shortcode' => '[youtube id="{{youtube_id}}" caption="{{youtube_caption}}"]',
	'popup_title' => __('Insert YouTube Video', 'morphis')
);

/*-----------------------------------------------------------------------------------*/
/*	Columns Config
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['columns'] = array(
	'params' => array(),
	'shortcode' => ' [section_clear]{{child_shortcode}}[section_clear] ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Columns Shortcode', 'morphis'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Type', 'morphis'),
				'desc' => __('Select the type, ie width of the column.', 'morphis'),
				'options' => array(
					'two_columns_alpha' => __('Two Columns First','morphis'),
					'two_columns' => __('Two Columns','morphis'),
					'two_columns_omega' => __('Two Columns Last','morphis'),
					'three_columns_alpha' => __('Three Columns First','morphis'),
					'three_columns' => __('Three Columns','morphis'),
					'three_columns_omega' => __('Three Columns Last','morphis'),
					'four_columns_alpha' => __('Four Columns First','morphis'),
					'four_columns' => __('Four Columns','morphis'),					
					'four_columns_omega' => __('Four Columns Last','morphis'),	
					'five_columns_alpha' => __('Five Columns First','morphis'),	
					'five_columns' => __('Five Columns','morphis'),	
					'five_columns_omega' => __('Five Columns Last','morphis'),	
					'six_columns_alpha' => __('Six Columns First','morphis'),
					'six_columns' => __('Six Columns','morphis'),					
					'six_columns_omega' => __('Six Columns Last','morphis'),	
					'seven_columns_alpha' => __('Seven Columns First','morphis'),
					'seven_columns' => __('Seven Columns','morphis'),					
					'seven_columns_omega' => __('Seven Columns Last','morphis'),	
					'eight_columns_alpha' => __('Eight Columns First','morphis'),
					'eight_columns' => __('Eight Columns','morphis'),					
					'eight_columns_omega' => __('Eight Columns Last','morphis'),
					'nine_columns_alpha' => __('Nine Columns First','morphis'),
					'nine_columns' => __('Nine Columns','morphis'),					
					'nine_columns_omega' => __('Nine Columns Last','morphis'),									
					'ten_columns_alpha' => __('Ten Columns First','morphis'),
					'ten_columns' => __('Ten Columns','morphis'),					
					'ten_columns_omega' => __('Ten Columns Last','morphis'),	
					'eleven_columns_alpha' => __('Eleven Columns First','morphis'),
					'eleven_columns' => __('Eleven Columns','morphis'),					
					'eleven_columns_omega' => __('Eleven Columns Last','morphis'),									
					'twelve_columns_alpha' => __('Twelve Columns First','morphis'),
					'twelve_columns' => __('Twelve Columns','morphis'),					
					'twelve_columns_omega' => __('Twelve Columns Last','morphis'),
					'thirteen_columns_alpha' => __('Thirteen Columns First','morphis'),
					'thirteen_columns' => __('Thirteen Columns','morphis'),					
					'thirteen_columns_omega' => __('Thirteen Columns Last','morphis'),
					'fourteen_columns_alpha' => __('Fourteen Columns First','morphis'),
					'fourteen_columns' => __('Fourteen Columns','morphis'),					
					'fourteen_columns_omega' => __('Fourteen Columns Last','morphis'),
					'fifteen_columns_alpha' => __('Fifteen Columns First','morphis'),
					'fifteen_columns' => __('Fifteen Columns','morphis'),					
					'fifteen_columns_omega' => __('Fifteen Columns Last','morphis'),
					'sixteen_columns_alpha' => __('Sixteen Columns First','morphis'),
					'sixteen_columns' => __('Sixteen Columns','morphis'),					
					'sixteen_columns_omega' => __('Sixteen Columns Last','morphis'),
					'one_third_column_alpha' => __('One Third Column First','morphis'),
					'one_third_column' => __('One Third Column','morphis'),					
					'one_third_column_omega' => __('One Third Column Last','morphis'),		
					'two_thirds_column_alpha' => __('Two Third Columns First','morphis'),
					'two_thirds_column' => __('Two Third Columns','morphis'),					
					'two_thirds_column_omega' => __('Two Third Columns Last','morphis'),						
					'one_column_alpha' => __('One Column First','morphis'),
					'one_column' => __('One Column','morphis'),					
					'one_column_omega' => __('One Column Last','morphis'),	
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Column Content', 'morphis'),
				'desc' => __('Add the column content.', 'morphis'),
			)
		),
		'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
		'clone_button' => __('Add Another Column', 'morphis')
	)
);
/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'morphis'),
			'desc' => __('Add the button\'s url eg http://example.com', 'morphis')
		),
		'color' => array(
			'type' => 'select',
			'label' => __('Button Color', 'morphis'),
			'desc' => __('Select the button\'s color', 'morphis'),
			'options' => array(
				'yellow' => __('Yellow', 'morphis'),
				'black' => __('Black', 'morphis'),
				'green' => __('Green', 'morphis'),
				'white' => __('White', 'morphis'),
				'blue' => __('Blue', 'morphis'),
				'red' => __('Red', 'morphis'),
				'orange' => __('Orange', 'morphis'),
				'purple' => __('Purple', 'morphis')
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __('Button Size', 'morphis'),
			'desc' => __('Select the button\'s size', 'morphis'),
			'options' => array(
				'' => __( 'Normal', 'morphis' ),
				'small' => __('Small', 'morphis' ),
				'medium' => __( 'Medium', 'morphis' ),
				'big' => __( 'Big', 'morphis' )
			)
		),
		'target' => array(
			'type' => 'select',
			'label' => __('Button Target', 'morphis'),
			'desc' => __('_self = open in same window. _blank = open in new window', 'morphis'),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => __('Button\'s Text', 'morphis'),
			'desc' => __('Add the button\'s text', 'morphis'),
		)
	),
	'shortcode' => '[button url="{{url}}" color="{{color}}" size="{{size}}" target="{{target}}"]{{content}}[/button]',
	'popup_title' => __('Insert Button Shortcode', 'morphis')
);




/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['tabs'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[tabs] {{child_shortcode}}  [/tabs]',
    'popup_title' => __('Insert Tab Shortcode', 'morphis'),
    
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => __('Tab Title', 'morphis'),
                'desc' => __('Title of the tab', 'morphis'),
            ),
            'content' => array(
                'std' => 'Tab Content',
                'type' => 'textarea',
                'label' => __('Tab Content', 'morphis'),
                'desc' => __('Add the tabs content', 'morphis')
            )
        ),
        'shortcode' => '[tab title="{{title}}"] {{content}} [/tab]',
        'clone_button' => __('Add Another Tab', 'morphis')
    )
);


/*-----------------------------------------------------------------------------------*/
/*	Accordion Config
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['accordions'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[accordions] {{child_shortcode}}  [/accordions]',
    'popup_title' => __('Insert Accordion Shortcode', 'morphis'),
    
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => __('Accordion Title', 'morphis'),
                'desc' => __('Title of the accordion', 'morphis'),
            ),
            'content' => array(
                'std' => 'Accordion Content',
                'type' => 'textarea',
                'label' => __('Accordion Content', 'morphis'),
                'desc' => __('Add the accordion content', 'morphis')
            )
        ),
        'shortcode' => '[accordion title="{{title}}"] {{content}} [/accordion]',
        'clone_button' => __('Add Another Accordion', 'morphis')
    )
);


/*-----------------------------------------------------------------------------------*/
/*	Price Boxes
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['price_boxes'] = array(
	'params' => array(),
	'shortcode' => '[price_boxes]{{child_shortcode}}[/price_boxes] ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Price Boxes Shortcode', 'morphis'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(				
				'type' => 'select',
				'label' => __('Column Type', 'morphis'),
				'desc' => __('Select the column type for the price box, ie width of the column.', 'morphis'),
				'options' => array(
					'two_columns_alpha' => __('Two Columns First','morphis'),
					'two_columns' => __('Two Columns','morphis'),
					'two_columns_omega' => __('Two Columns Last','morphis'),
					'three_columns_alpha' => __('Three Columns First','morphis'),
					'three_columns' => __('Three Columns','morphis'),
					'three_columns_omega' => __('Three Columns Last','morphis'),
					'four_columns_alpha' => __('Four Columns First','morphis'),
					'four_columns' => __('Four Columns','morphis'),					
					'four_columns_omega' => __('Four Columns Last','morphis'),	
					'five_columns_alpha' => __('Five Columns First','morphis'),	
					'five_columns' => __('Five Columns','morphis'),	
					'five_columns_omega' => __('Five Columns Last','morphis'),	
					'six_columns_alpha' => __('Six Columns First','morphis'),
					'six_columns' => __('Six Columns','morphis'),					
					'six_columns_omega' => __('Six Columns Last','morphis'),	
					'seven_columns_alpha' => __('Seven Columns First','morphis'),
					'seven_columns' => __('Seven Columns','morphis'),					
					'seven_columns_omega' => __('Seven Columns Last','morphis'),	
					'eight_columns_alpha' => __('Eight Columns First','morphis'),
					'eight_columns' => __('Eight Columns','morphis'),					
					'eight_columns_omega' => __('Eight Columns Last','morphis'),
					'nine_columns_alpha' => __('Nine Columns First','morphis'),
					'nine_columns' => __('Nine Columns','morphis'),					
					'nine_columns_omega' => __('Nine Columns Last','morphis'),									
					'ten_columns_alpha' => __('Ten Columns First','morphis'),
					'ten_columns' => __('Ten Columns','morphis'),					
					'ten_columns_omega' => __('Ten Columns Last','morphis'),	
					'eleven_columns_alpha' => __('Eleven Columns First','morphis'),
					'eleven_columns' => __('Eleven Columns','morphis'),					
					'eleven_columns_omega' => __('Eleven Columns Last','morphis'),									
					'twelve_columns_alpha' => __('Twelve Columns First','morphis'),
					'twelve_columns' => __('Twelve Columns','morphis'),					
					'twelve_columns_omega' => __('Twelve Columns Last','morphis'),
					'thirteen_columns_alpha' => __('Thirteen Columns First','morphis'),
					'thirteen_columns' => __('Thirteen Columns','morphis'),					
					'thirteen_columns_omega' => __('Thirteen Columns Last','morphis'),
					'fourteen_columns_alpha' => __('Fourteen Columns First','morphis'),
					'fourteen_columns' => __('Fourteen Columns','morphis'),					
					'fourteen_columns_omega' => __('Fourteen Columns Last','morphis'),
					'fifteen_columns_alpha' => __('Fifteen Columns First','morphis'),
					'fifteen_columns' => __('Fifteen Columns','morphis'),					
					'fifteen_columns_omega' => __('Fifteen Columns Last','morphis'),
					'sixteen_columns_alpha' => __('Sixteen Columns First','morphis'),
					'sixteen_columns' => __('Sixteen Columns','morphis'),					
					'sixteen_columns_omega' => __('Sixteen Columns Last','morphis'),
					'one_third_column_alpha' => __('One Third Column First','morphis'),
					'one_third_column' => __('One Third Column','morphis'),					
					'one_third_column_omega' => __('One Third Column Last','morphis'),		
					'two_thirds_column_alpha' => __('Two Third Columns First','morphis'),
					'two_thirds_column' => __('Two Third Columns','morphis'),					
					'two_thirds_column_omega' => __('Two Third Columns Last','morphis'),						
					'one_column_alpha' => __('One Column First','morphis'),
					'one_column' => __('One Column','morphis'),					
					'one_column_omega' => __('One Column Last','morphis'),							
				)				
			),
			'title' => array(
				'std' => __( 'Basic', 'morphis' ),
				'type' => 'text',
				'label' => __('Plan Title', 'morphis'),
				'desc' => __('Enter price box title.', 'morphis')				
			),
			'price' => array(
				'std' => '$12',
				'type' => 'text',
				'label' => __('Plan Price', 'morphis'),
				'desc' => __('Enter price box price. (Include currency)', 'morphis')				
			),
			'period' => array(
				'std' => __( 'month', 'morphis' ),
				'type' => 'text',
				'label' => __('Plan Per period', 'morphis'),
				'desc' => __('Enter the price\'s period. Example: month, year, week, bi-annual, quarterly, etc.', 'morphis')				
			),
			'periodic_detail' => array(
				'std' => __( 'Billed Annually', 'morphis' ),
				'type' => 'text',
				'label' => __('Periodic Bill Info', 'morphis'),
				'desc' => __('Enter the plan\'s periodic bill info.', 'morphis')				
			),
			'plan_info' => array(
				'std' => __( 'Perfect match for starting up a small business.', 'morphis' ),
				'type' => 'text',
				'label' => __('Plan Info', 'morphis'),
				'desc' => __('Enter small info about this plan.', 'morphis')				
			),
			'plan_list_items' => array(
				'std' => __( 'Unlimited Users,Support, Web Design, Unlimited Bandwidth, 10GB Disk Usage', 'morphis' ),
				'type' => 'textarea',
				'label' => __('Plan List Items', 'morphis'),
				'desc' => __('Enter the list items about this plan. Items should be separated by a comma.', 'morphis')				
			),
			'plan_url_link_name' => array(
				'std' => __( 'Sign Up', 'morphis' ),
				'type' => 'text',
				'label' => __('Plan URL Link Name', 'morphis'),
				'desc' => __('Enter the name for the plan link.', 'morphis')				
			),
			'plan_url_link' => array(
				'std' => 'http://google.com',
				'type' => 'text',
				'label' => __('Plan URL Link', 'morphis'),
				'desc' => __('Enter the plan URL link.', 'morphis')				
			),
			'plan_featured' => array(
				'std' => '',
				'type' => 'select',
				'label' => __('Plan Featured', 'morphis'),
				'desc' => __('Choose if you should feature this plan.', 'morphis'),
				'options' => array(
					'' => __('Not Featured','morphis'),
					'featured' => __('Featured', 'morphis')
				)
			)
		),
		'shortcode' => '[price_box column="{{column}}" title="{{title}}" price="{{price}}" period="{{period}}" periodic_detail="{{periodic_detail}}" plan_info="{{plan_info}}" plan_url_link_name="{{plan_url_link_name}}" plan_url_link="{{plan_url_link}}" plan_featured="{{plan_featured}}"]{{plan_list_items}}[/price_box] ',
		'clone_button' => __('Add Another Price Box Plan', 'morphis')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Team Member
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['team_members'] = array(
	'params' => array(),
	'shortcode' => '[team_members]{{child_shortcode}}[/team_members] ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Team Members Shortcode', 'morphis'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(				
				'type' => 'select',
				'label' => __('Column Type', 'morphis'),
				'desc' => __('Select the column type for the price box, ie width of the column.', 'morphis'),
				'options' => array(
					'two_columns_alpha' => __('Two Columns First','morphis'),
					'two_columns' => __('Two Columns','morphis'),
					'two_columns_omega' => __('Two Columns Last','morphis'),
					'three_columns_alpha' => __('Three Columns First','morphis'),
					'three_columns' => __('Three Columns','morphis'),
					'three_columns_omega' => __('Three Columns Last','morphis'),
					'four_columns_alpha' => __('Four Columns First','morphis'),
					'four_columns' => __('Four Columns','morphis'),					
					'four_columns_omega' => __('Four Columns Last','morphis'),	
					'five_columns_alpha' => __('Five Columns First','morphis'),	
					'five_columns' => __('Five Columns','morphis'),	
					'five_columns_omega' => __('Five Columns Last','morphis'),	
					'six_columns_alpha' => __('Six Columns First','morphis'),
					'six_columns' => __('Six Columns','morphis'),					
					'six_columns_omega' => __('Six Columns Last','morphis'),	
					'seven_columns_alpha' => __('Seven Columns First','morphis'),
					'seven_columns' => __('Seven Columns','morphis'),					
					'seven_columns_omega' => __('Seven Columns Last','morphis'),	
					'eight_columns_alpha' => __('Eight Columns First','morphis'),
					'eight_columns' => __('Eight Columns','morphis'),					
					'eight_columns_omega' => __('Eight Columns Last','morphis'),
					'nine_columns_alpha' => __('Nine Columns First','morphis'),
					'nine_columns' => __('Nine Columns','morphis'),					
					'nine_columns_omega' => __('Nine Columns Last','morphis'),									
					'ten_columns_alpha' => __('Ten Columns First','morphis'),
					'ten_columns' => __('Ten Columns','morphis'),					
					'ten_columns_omega' => __('Ten Columns Last','morphis'),	
					'eleven_columns_alpha' => __('Eleven Columns First','morphis'),
					'eleven_columns' => __('Eleven Columns','morphis'),					
					'eleven_columns_omega' => __('Eleven Columns Last','morphis'),									
					'twelve_columns_alpha' => __('Twelve Columns First','morphis'),
					'twelve_columns' => __('Twelve Columns','morphis'),					
					'twelve_columns_omega' => __('Twelve Columns Last','morphis'),
					'thirteen_columns_alpha' => __('Thirteen Columns First','morphis'),
					'thirteen_columns' => __('Thirteen Columns','morphis'),					
					'thirteen_columns_omega' => __('Thirteen Columns Last','morphis'),
					'fourteen_columns_alpha' => __('Fourteen Columns First','morphis'),
					'fourteen_columns' => __('Fourteen Columns','morphis'),					
					'fourteen_columns_omega' => __('Fourteen Columns Last','morphis'),
					'fifteen_columns_alpha' => __('Fifteen Columns First','morphis'),
					'fifteen_columns' => __('Fifteen Columns','morphis'),					
					'fifteen_columns_omega' => __('Fifteen Columns Last','morphis'),
					'sixteen_columns_alpha' => __('Sixteen Columns First','morphis'),
					'sixteen_columns' => __('Sixteen Columns','morphis'),					
					'sixteen_columns_omega' => __('Sixteen Columns Last','morphis'),
					'one_third_column_alpha' => __('One Third Column First','morphis'),
					'one_third_column' => __('One Third Column','morphis'),					
					'one_third_column_omega' => __('One Third Column Last','morphis'),		
					'two_thirds_column_alpha' => __('Two Third Columns First','morphis'),
					'two_thirds_column' => __('Two Third Columns','morphis'),					
					'two_thirds_column_omega' => __('Two Third Columns Last','morphis'),						
					'one_column_alpha' => __('One Column First','morphis'),
					'one_column' => __('One Column','morphis'),					
					'one_column_omega' => __('One Column Last','morphis'),	
				)				
			),
			'img' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Member Image/Picture URL', 'morphis'),
				'desc' => __('Enter member image/picture URL.', 'morphis')				
			),
			'name' => array(
				'std' => 'Sheldon Cooper',
				'type' => 'text',
				'label' => __('Team Member Name', 'morphis'),
				'desc' => __('Enter Team Member Name', 'morphis')				
			),
			'job_desc' => array(
				'std' => 'Visual Designer',
				'type' => 'text',
				'label' => __('Job Title', 'morphis'),
				'desc' => __('Enter the team member name\'s job description.', 'morphis')				
			),
			'desc' => array(
				'std' => 'Porta rhoncus massa, pellentesque. Porta platea! Sociis lorem.',
				'type' => 'text',
				'label' => __('Team Member Info', 'morphis'),
				'desc' => __('Enter the team member\'s information.', 'morphis')				
			),			
			'specialties' => array(
				'std' => 'Web Design, PHP, jQuery',
				'type' => 'textarea',
				'label' => __('Specialties', 'morphis'),
				'desc' => __('Enter the list items about the team member\'s specialty. Items should be separated by a comma.', 'morphis')				
			)			
		),
		'shortcode' => '[team_member column="{{column}}" img="{{img}}" name="{{name}}" job_desc="{{job_desc}}" desc="{{desc}}" specialties="{{specialties}}"][/team_member]',
		'clone_button' => __('Add Another Team Member', 'morphis')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Centered Heading
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['centered_heading'] = array(
	'no_preview' => true,
	'params' => array(
		'header' => array(
			'type' => 'select',
			'label' => __('Header Tag', 'morphis'),
			'desc' => __('Select the header tag for the heading.', 'morphis'),
			'options' => array(
				'h1' => 'H1',
				'h2' => 'H2',
				'h3' => 'H3',
				'h4' => 'H4',
				'h5' => 'H5',
				'h6' => 'H6'
			)
		),		
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Heading Text', 'morphis'),
			'desc' => __('Type the Heading text.', 'morphis')
		),
		'sub_header' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Sub-Heading Text', 'morphis'),
			'desc' => __('Type the Sub-Heading text.', 'morphis')			
		),		
		'sub_header_url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Sub-Heading URL', 'morphis'),
			'desc' => __('Type the Sub-Heading URL.', 'morphis')			
		),
		'sub_header_target' => array(
					'type' => 'select',
					'label' => __('Sub-Heading Target', 'morphis'),
					'desc' => __('Select the target for the Sub-Heading URL.', 'morphis'),
					'options' => array(
						'_self' => '_self',
						'_target' => '_blank'
					)
				),				
	),
	'shortcode' => '[centered_heading header="{{header}}" sub_header="{{sub_header}}" sub_header_url="{{sub_header_url}}" sub_header_target="{{sub_header_target}}"]{{content}}[/centered_heading]',
	'popup_title' => __('Insert Centered Header Shortcode', 'morphis')
);


/*-----------------------------------------------------------------------------------*/
/*	DropCap Shortcode
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['dropcap'] = array(
	'no_preview' => true,
	'params' => array(		
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __('Dropcap Content ', 'morphis'),
			'desc' => __('Add content with dropcap.', 'morphis')
		)
	),
	'shortcode' => '[dropcap]{{content}}[/dropcap]',
	'popup_title' => __('Insert Dropcap Shortcode', 'morphis')
);


/*-----------------------------------------------------------------------------------*/
/*	Blockquote Shortcode
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['blockquote'] = array(
	'no_preview' => true,
	'params' => array(		
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __('Blockquote Content ', 'morphis'),
			'desc' => __('Add content for the blockquote.', 'morphis')
		),
		'cite' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Blockquote Cite', 'morphis'),
			'desc' => __('Add optional blockquote cite.', 'morphis')
		)
	),
	'shortcode' => '[blockquote cite="{{cite}}" ]{{content}}[/blockquote]',
	'popup_title' => __('Insert Blockquote Shortcode', 'morphis')
);


/*-----------------------------------------------------------------------------------*/
/*	Highlights
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['highlight'] = array(
	'no_preview' => true,
	'params' => array(
		'color' => array(
			'std' => '',
			'type' => 'select',
			'label' => __('Highlight Color', 'morphis'),
			'desc' => __('Pick highlight color.', 'morphis'),
			'options' => array(
				'red' => __('Red', 'morphis'),
				'white' => __('White', 'morphis'),
				'black' => __('Black', 'morphis'),
				'blue' => __('Blue', 'morphis'),
				'green' => __('Green', 'morphis'),
				'pink' => __('Pink', 'morphis'),
				'yellow' => __('Yellow', 'morphis'),
				'purple' => __('Purple', 'morphis'),
				'orange' => __('Orange', 'morphis')
			)
		),
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Text', 'morphis'),
			'desc' => __('Add the content text for the highlight', 'morphis')
		),
	),
	'shortcode' => '[highlight color="{{color}}"]{{content}}[/highlight]',
	'popup_title' => __('Insert Highlighted Text', 'morphis')
);


/*-----------------------------------------------------------------------------------*/
/*	Styled Horizontal Lines
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['hr_line'] = array(
	'no_preview' => true,
	'params' => array(
		'style' => array(
			'std' => '',
			'type' => 'select',
			'label' => __('Select Horizontal Line', 'morphis'),
			'desc' => __('Choose a normal or styled horizontal lines.', 'morphis'),
			'options' => array(
				'' => 'Normal',
				'vintage-1' => __('Vintage Style','morphis') . ' 1',
				'vintage-2' => __('Vintage Style','morphis') . ' 2',
				'vintage-3' => __('Vintage Style','morphis') . ' 3',
				'vintage-4' => __('Vintage Style','morphis') . ' 4',
				'vintage-5' => __('Vintage Style','morphis') . ' 5',
				'vintage-6' => __('Vintage Style','morphis') . ' 6',
				'vintage-7' => __('Vintage Style','morphis') . ' 7',
				'vintage-8' => __('Vintage Style','morphis') . ' 8'
			)
		)
	),
	'shortcode' => '[hr_line style="{{style}}"]',
	'popup_title' => __('Insert Horizontal Line', 'morphis')
);

/*-----------------------------------------------------------------------------------*/
/*	Lists
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['lists'] = array(
	'params' => array(
		'list_type' => array(
			'std' => 'ul',
			'type' => 'select',
			'label' => __('Select List Type', 'morphis'),
			'desc' => __('Choose which type of list you want.', 'morphis'),
			'options' => array(
				'ul' => __( 'Unordered List', 'morphis' ),
				'ol' => __( 'Ordered List', 'morphis' )								
			)
		),
		'style' => array(
			'std' => '',
			'type' => 'select',
			'label' => __('Select List Style', 'morphis'),
			'desc' => __('Choose a normal or styled lists.', 'morphis'),
			'options' => array(
				'' => __('Normal', 'morphis'),
				'list-bullets' => __('Bullets', 'morphis'),				
				'circle' => __('Circles', 'morphis'),
				'disc' => __('Discs', 'morphis'),
				'square' => __('Squares', 'morphis'),				
				'list-check' => __('Check Marks', 'morphis')				
			)
		)
	),
	'shortcode' => ' [lists list_type="{{list_type}}" style="{{style}}"]{{child_shortcode}}[/lists] ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Lists Shortcode', 'morphis'),
	'no_preview' => true,
	
	'child_shortcode' => array(
		'params' => array(			
			'content' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('List Content', 'morphis'),
				'desc' => __('Enter list item here.', 'morphis'),
			)
		),
		'shortcode' => '[list_item]{{content}}[/list_item] ',
		'clone_button' => __('Add Another List Item', 'morphis')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Information Boxes
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['info_boxes'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(			
			'type' => 'select',
			'label' => __('Notification Type', 'morphis'),
			'desc' => __('Choose a notification type.', 'morphis'),
			'options' => array(				
				'tip' => __('Tip', 'morphis'),
				'error' => __('Error', 'morphis'),
				'note' => __('Note', 'morphis'),
				'setting' => __('Setting', 'morphis'),
				'inform' => __('Inform', 'morphis')
			)
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __('Info Box Content', 'morphis'),
			'desc' => __('Type the content for the Info Box.', 'morphis'),
		)
	),
	'shortcode' => '[info_boxes type="{{type}}"]{{content}}[/info_boxes]',
	'popup_title' => __('Insert Notification/Info Box Shortcode', 'morphis')
);



/*-----------------------------------------------------------------------------------*/
/*	Image Floats
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['image_floats'] = array(
	'no_preview' => true,
	'params' => array(
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Image URL', 'morphis'),
			'desc' => __('Enter the image url.', 'morphis')
		),
		'allow_lightbox' => array(
			'std' => '',
			'type' => 'checkbox',
			'label' => __('Allow Lightbox', 'morphis'),
			'desc' => __('Check if you want the image to load prettyPhoto lightbox on click.', 'morphis')
		),
		'img_link_url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Image Link URL', 'morphis'),
			'desc' => __('Enter the image link url. If you have checked the lightbox option from above, you should leave this field blank.', 'morphis')
		),
		'img_link_target' => array(			
			'type' => 'select',
			'label' => __('Image Link Target', 'morphis'),
			'desc' => __('Choose the image link target.', 'morphis'),
			'options' => array(				
				'_self' => '_self',
				'_blank' => '_blank'	
			)
		),
		'img_width' => array(
			'std' => '300',
			'type' => 'text',
			'label' => __('Image Width', 'morphis'),
			'desc' => __('Enter image width. Leave this blank if you want the image to be responsive (this will display the image in it\'s full width). ', 'morphis')
		),
		'float' => array(			
			'type' => 'select',
			'label' => __('Image Float Alignment', 'morphis'),
			'desc' => __('Choose a float alignment.', 'morphis'),
			'options' => array(				
				'left-align-image' => __('Left', 'morphis'),
				'right-align-image' => __('Right', 'morphis'),
				'center-align-image' => __('Center', 'morphis'),
				'no-align-image' => __('No Alignment', 'morphis'),
			)
		),
		'caption' => array(
			'std' => __( 'Your image caption here.', 'morphis' ),
			'type' => 'text',
			'label' => __('Image Caption', 'morphis'),
			'desc' => __('Enter image caption.', 'morphis')
		)
	),
	'shortcode' => '[image_floats img_link_url="{{img_link_url}}" img_link_target="{{img_link_target}}" img_width="{{img_width}}" float="{{float}}" caption="{{caption}}" allow_lightbox="{{allow_lightbox}}"]{{content}}[/image_floats]',
	'popup_title' => __('Insert Image Floats Shortcode', 'morphis')
);


/*-----------------------------------------------------------------------------------*/
/*	Vimeo Video
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['vimeo'] = array(
	'no_preview' => true,
	'params' => array(
		'color' => array(
			'std' => '00adef',
			'type' => 'color',
			'label' => __('Video Controls Color', 'morphis'),
			'desc' => __('Set your Vimeo video controls color here.', 'morphis'),			
		),
		'vimeo_id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Vimeo Video ID', 'morphis'),
			'desc' => __('Enter your Vimeo video ID here.', 'morphis'),			
		),		
		'vimeo_caption' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add Vimeo Caption', 'morphis'),
			'desc' => __('Enter your caption for the video.', 'morphis'),			
		)		
	),
	'shortcode' => '[vimeo vimeo_id="{{vimeo_id}}" color="{{color}} " vimeo_caption="{{vimeo_caption}}"]',
	'popup_title' => __('Insert Vimeo Video Shortcode', 'morphis')
);


/*-----------------------------------------------------------------------------------*/
/*	Custom Typography
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['typography'] = array(
	'no_preview' => true,
	'params' => array(
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Text Content', 'morphis'),
			'desc' => __('Enter the text content to be styled.', 'morphis')	
		),
		'font_color' => array(
			'std' => 'ffffff',
			'type' => 'color',
			'label' => __('Font Color', 'morphis'),
			'desc' => __('Click on the field above and choose your font color.', 'morphis')	
		),	
		'font' => array(
			'std' => '',
			'type' => 'select',
			'label' => __('Font Style', 'morphis'),
			'desc' => __('Enter the text content to be styled.', 'morphis'),			
			'options' => array(
					'AftaserifRegular' => 'Afta Serif',
					'Aldo' => 'Aldo',			
					'Amaranth' => 'Amaranth',			
					'Arial' => 'Arial',										
					'ArimoRegular' => 'Arimo',
					'Archive' => 'Archive',
					'BebasNeue' => 'BebasNeue',
					'Blanch' => 'Blanch',
					'BrawlerRegular' => 'Brawler',
					'BreeSerif' => 'Bree Serif',
					'CabinRegular' => 'Cabin',										
					'CantarellRegular' => 'Cantarell',
					'CaviarDreamsRegular' => 'Caviar Dreams',
					'Copse-Regular' => 'Copse Regular',
					'Cuprum' => 'Cuprum',
					'DancingScriptOTRegular' => 'Dancing Script',
					'DevroyeRegular' => 'Devroye',
					'DroidSansRegular' => 'Droid Sans',	
					'DroidSerifRegular' => 'Droid Serif',
					'EnriquetaRegular' => 'Enriqueta',
					'Georgia' => 'Georgia',
					'Hill_House' => 'Hill House',
					'JennaSue' => 'Jenna Sue',
					'JosefinSlab' => 'Josefin Slab',
					'JustOldFashion' => 'Just Old Fashion',
					'Kristi' => 'Kristi',
					'Laconic_Light' => 'Laconic Light',
					'LatinModernMono' => 'Latin Modern Mono',
					'LeagueGothic' => 'League Gothic',
					'Leander' => 'Leander',
					'Lekton' => 'Lekton',
					'LiberationSerifRegular' => 'Liberation Serif',
					'Lobster' => 'Lobster',
					'MaidenOrange' => 'Maiden Orange',
					'Matchbook' => 'Matchbook',
					'MerriweatherRegular' => 'Merriweather',										
					'MuseoSlab' => 'Museo Slab',		
					'Myndraine' => 'Myndraine',		
					'New_Cicle_Semi' => 'New Cicle Semi',												
					'OpenBaskerville0053Normal' => 'Open Baskerville',
					'OpenSansLight' => 'Open Sans Light',										
					'Ostrich' => 'Ostrich',										
					'Qlassik_TB' => 'Qlassik',										
					'OpenSans' => 'OpenSans',										
					'PlayFairDisplay' => 'PlayFair Display',
					'Podkova' => 'Podkova',
					'PTMono' => 'PT Mono',
					'Santana' => 'Santana',
					'StMarie' => 'StMarie',
					'TerminalDosis' => 'Terminal Dosis',
					'TheanoDidot' => 'TheanoDidot',
					'Tienne' => 'Tienne',
					'Titillium' => 'Titillium',
					'Trocchi' => 'Trocchi',
					'Verily' => 'Verily',
					'Wellfleet' => 'Wellfleet',
					'YanoneKaffeesatzLight' => 'Yanone Kaffeesatz Light'	
				)
		),		
		'font_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Font Size', 'morphis'),
			'desc' => __('Enter font size in pixels.', 'morphis')	
		),	
		'line_height' => array(
			'std' => '20',
			'type' => 'text',
			'label' => __('Line Height', 'morphis'),
			'desc' => __('Enter line height in pixels. Default is 20.', 'morphis')	
		),		
	),
	'shortcode' => '[typography font="{{font}}" font_size="{{font_size}}" font_color="{{font_color}}" line_height="{{line_height}}"]{{content}}[/typography]',
	'popup_title' => __('Insert Custom Typography Shortcode', 'morphis')
);


/*-----------------------------------------------------------------------------------*/
/*	Call Out Box Shortcode
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['call_out'] = array(
	'no_preview' => true,
	'params' => array(		
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __('Call Out Box Content ', 'morphis'),
			'desc' => __('Add content for the call out box.', 'morphis')
		),
		'align' => array(
			'std' => 'left',
			'type' => 'select',
			'label' => __('Alignment', 'morphis'),
			'desc' => __('Choose floating alignment for the call out box.', 'morphis'),
			'options' => array(
				'left' => __('Left', 'morphis'),
				'right' => __('Right', 'morphis'),
			)
		)
	),
	'shortcode' => '[call_out align="{{align}}" ]{{content}}[/call_out]',
	'popup_title' => __('Insert Call Out Box Shortcode', 'morphis')
);


/*-----------------------------------------------------------------------------------*/
/*	Clear Floats
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['clear'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '[clear]',
	'popup_title' => __('Insert Clearing Float Shortcode', 'morphis')	
);


/*-----------------------------------------------------------------------------------*/
/*	Twitter Share Button
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['twitter_share'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '[twitter_share]',
	'popup_title' => __('Insert Twitter Share Button Shortcode', 'morphis')
);


/*-----------------------------------------------------------------------------------*/
/*	Faceook Share Button
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['facebook_like'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '[facebook_like]',
	'popup_title' => __('Insert Facebook Like Button Shortcode', 'morphis')
);


/*-----------------------------------------------------------------------------------*/
/*	Pinterest Pin It Button
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['pin_it_button'] = array(
	'no_preview' => true,
	'params' => array(
		'pin_url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Image URL', 'morphis'),
			'desc' => __('Enter the image URL you want to pin.', 'morphis')	
		)	
	),
	'shortcode' => '[pin_it_button pin_url="{{pin_url}}"]',
	'popup_title' => __('Insert Pinterest Pin It Button Shortcode', 'morphis')
);


/*-----------------------------------------------------------------------------------*/
/*	Google +1 Button
/*-----------------------------------------------------------------------------------*/

$pulp_shortcodes['plus_one'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '[plus_one]',
	'popup_title' => __('Insert Google +1 Button Shortcode', 'morphis')
);


?>