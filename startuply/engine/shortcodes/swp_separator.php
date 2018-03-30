<?php

/*-----------------------------------------------------------------------------------*/
/*	Separator VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				'name' => __('Separator', 'vivaco'),
				'base' => 'vc_separator',
				'icon' => 'icon-wpb-ui-separator',
				'show_settings_on_create' => false,
				'category' => __('Content', 'vivaco'),
				//"controls"	=> 'popup_delete',
				'description' => __('Horizontal separator line', 'vivaco'),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => __('Color', 'vivaco'),
						'param_name' => 'color',
						'value' => getVcShared('colors'),
						'std' => 'grey',
						'description' => __('Separator color.', 'vivaco'),
						'param_holder_class' => 'vc-colored-dropdown'
					),
					array(
						'type' => 'colorpicker',
						'heading' => __('Custom Border Color', 'wpb'),
						'param_name' => 'accent_color',
						'description' => __('Select border color for your element.', 'wpb')
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Style', 'vivaco'),
						'param_name' => 'style',
						'value' => getVcShared('separator styles'),
						'description' => __('Separator style.', 'vivaco')
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Element width', 'vivaco'),
						'param_name' => 'el_width',
						'value' => getVcShared('separator widths'),
						'description' => __('Separator element width in percents.', 'vivaco')
					),
					array(
						'type' => 'textfield',
						'heading' => __('Extra class name', 'vivaco'),
						'param_name' => 'el_class',
						'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'vivaco')
					)
				)
			));
