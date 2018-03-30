<?php

vc_map( array(
        'name' =>'Webnus List',
        'base' => 'ul',
		"description" => "List + custom style",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_list",
        'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => __( 'List Type', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'type',
							'value' => array(
											'Plus'=>'plus',
											'Minus'=>'minus',
											'Star'=>'star',
											'Arrow'=>'arrow',
											'Arrow 2'=>'arrow2',
											'Square'=>'square',
											'Circle'=>'circle',
											'Cross'=>'cross',
											'Check'=>'check',
											'Check 2'=>'check2'
																
										),
							'description' => __( 'Select the List Items type', 'WEBNUS_TEXT_DOMAIN')
						),
						
						array(
							'type' => 'textarea_html',
							'heading' => __( 'Items', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'content',
							'value' => '[li]First Item[/li][li]Second Item[/li]',
							'description' => __( 'Enter list items, you can use [li]SomeText[/li]', 'WEBNUS_TEXT_DOMAIN')
						),
						
           
        ),
		
        
    ) );


?>