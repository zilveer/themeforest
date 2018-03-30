<?php

/*-----------------------------------------------------------------------------------*/
/*	Button 2 VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				'name' => __('Button', 'vivaco') . " 2",
				'base' => 'vc_button2',
				'icon' => 'icon-wpb-ui-button',
				'category' => __("Content", "vivaco"),
				'description' => __('Eye catching button', 'vivaco'),
				'params' => array(
					array(
						'type' => 'vc_link',
						'heading' => __('URL (Link)', 'vivaco'),
						'param_name' => 'link',
						'description' => __('Button link.', 'vivaco')
					),
					array(
						'type' => 'textfield',
						'heading' => __('Text on the button', 'vivaco'),
						'holder' => 'button',
						'class' => 'wpb_button',
						'param_name' => 'title',
						'value' => __('Text on the button', 'vivaco'),
						'description' => __('Text on the button.', 'vivaco')
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Style', 'vivaco'),
						'param_name' => 'style',
						'value' => getVcShared('button styles'),
						'description' => __('Button style.', 'vivaco')
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Color', 'vivaco'),
						'param_name' => 'color',
						'value' => getVcShared('colors'),
						'description' => __('Button color.', 'vivaco'),
						'param_holder_class' => 'vc-colored-dropdown'
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Size', 'vivaco'),
						'param_name' => 'size',
						'value' => getVcShared('sizes'),
						'std' => 'md',
						'description' => __('Button size.', 'vivaco')
					),
					array(
						'type' => 'textfield',
						'heading' => __('Extra class name', 'vivaco'),
						'param_name' => 'el_class',
						'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'vivaco')
					)
				)
			));

