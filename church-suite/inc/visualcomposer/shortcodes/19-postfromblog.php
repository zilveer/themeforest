<?php
vc_map( array(
        'name' =>'Post From Blog',
        'base' => 'postblog',
        "icon" => "webnus_postfromblog",
		"description" => "Single Post",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Post ID', 'webnus_framework' ),
							'param_name' => 'post',
							'value'=>'',
							'description' => esc_html__( 'Pick up the ID & follow this instruction: admin panel > posts > ID column.', 'webnus_framework')
						), 
					),    
		) );
?>