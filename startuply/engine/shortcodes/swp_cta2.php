<?php

/*-----------------------------------------------------------------------------------*/
/*	Call to Action 2 VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				'name' => __('Call to Action', 'vivaco') . ' 2',
				'base' => 'vc_cta_button2',
				"weight" => 12,
				'icon' => 'icon-wpb-call-to-action',
				"category" => __("Content", "vivaco"),
				'description' => __('Catch visitors attention with CTA block', 'vivaco'),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __('Heading first line', 'vivaco'),
						'holder' => 'h2',
						'param_name' => 'h2',
						'value' => __('Hey! I am first heading line feel free to change me', 'vivaco'),
						'description' => __('Text for the first heading line.', 'vivaco')
					),
					array(
						'type' => 'textfield',
						'heading' => __('Heading second line', 'vivaco'),
						'holder' => 'h4',
						'param_name' => 'h4',
						'value' => '',
						'description' => __('Optional text for the second heading line.', 'vivaco')
					),
					array(
						'type' => 'dropdown',
						'heading' => __('CTA style', 'vivaco'),
						'param_name' => 'style',
						'value' => getVcShared('cta styles'),
						'description' => __('Call to action style.', 'vivaco')
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Element width', 'vivaco'),
						'param_name' => 'el_width',
						'value' => getVcShared('cta widths'),
						'description' => __('Call to action element width in percents.', 'vivaco')
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Text align', 'vivaco'),
						'param_name' => 'txt_align',
						'value' => getVcShared('text align'),
						'description' => __('Text align in call to action block.', 'vivaco')
					),
					array(
						'type' => 'colorpicker',
						'heading' => __('Custom Background Color', 'wpb'),
						'param_name' => 'accent_color',
						'description' => __('Select background color for your element.', 'wpb')
					),
					array(
						'type' => 'textarea_html',
						'holder' => 'div',
						'heading' => __('Promotional text', 'vivaco'),
						'param_name' => 'content',
						'value' => __('<p>I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'vivaco')
					),
					array(
						'type' => 'vc_link',
						'heading' => __('URL (Link)', 'vivaco'),
						'param_name' => 'link',
						'description' => __('Button link.', 'vivaco')
					),
					array(
						'type' => 'textfield',
						'heading' => __('Text on the button', 'vivaco'),
						//'holder' => 'button',
						//'class' => 'wpb_button',
						'param_name' => 'title',
						'value' => __('Text on the button', 'vivaco'),
						'description' => __('Text on the button.', 'vivaco')
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Button style', 'vivaco'),
						'param_name' => 'btn_style',
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
						'type' => 'dropdown',
						'heading' => __('Button position', 'vivaco'),
						'param_name' => 'position',
						'value' => array(
							__('Align right', 'vivaco') => 'right',
							__('Align left', 'vivaco') => 'left',
							__('Align bottom', 'vivaco') => 'bottom'
						),
						'description' => __('Select button alignment.', 'vivaco')
					),
					array(
						'type' => 'textfield',
						'heading' => __('Extra class name', 'vivaco'),
						'param_name' => 'el_class',
						'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'vivaco')
					)
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Call to action 2 VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
