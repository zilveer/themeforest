<?php

add_action('vc_before_init', 'mpc_vc_wpb_map_on_init', 1);
function mpc_vc_wpb_map_on_init() {
	if( WPB_VC_VERSION >= '4.5' ) {				
		vc_remove_element( "vc_btn" );
		vc_remove_element( "vc_cta" );
		vc_remove_element( "vc_button" );
		vc_remove_element( "vc_button2" );
		vc_remove_element( "vc_cta_button" );
		vc_remove_element( "vc_cta_button2" );
		
		$size_arr = array(
			__( 'Regular', 'js_composer' ) => 'wpb_regularsize',
			__( 'Large', 'js_composer' ) => 'btn-large',
			__( 'Small', 'js_composer' ) => 'btn-small',
			__( 'Mini', 'js_composer' ) => "btn-mini"
		);

		$target_arr = array(
			__( 'Same window', 'js_composer' ) => '_self',
			__( 'New window', 'js_composer' ) => "_blank"
		);
		
		$colors_arr = array(
			__( 'Grey', 'js_composer' ) => 'wpb_button',
			__( 'Blue', 'js_composer' ) => 'btn-primary',
			__( 'Turquoise', 'js_composer' ) => 'btn-info',
			__( 'Green', 'js_composer' ) => 'btn-success',
			__( 'Orange', 'js_composer' ) => 'btn-warning',
			__( 'Red', 'js_composer' ) => 'btn-danger',
			__( 'Black', 'js_composer' ) => "btn-inverse"
		);
		
		$icons_arr = array(
			__( 'None', 'js_composer' ) => 'none',
			__( 'Address book icon', 'js_composer' ) => 'wpb_address_book',
			__( 'Alarm clock icon', 'js_composer' ) => 'wpb_alarm_clock',
			__( 'Anchor icon', 'js_composer' ) => 'wpb_anchor',
			__( 'Application Image icon', 'js_composer' ) => 'wpb_application_image',
			__( 'Arrow icon', 'js_composer' ) => 'wpb_arrow',
			__( 'Asterisk icon', 'js_composer' ) => 'wpb_asterisk',
			__( 'Hammer icon', 'js_composer' ) => 'wpb_hammer',
			__( 'Balloon icon', 'js_composer' ) => 'wpb_balloon',
			__( 'Balloon Buzz icon', 'js_composer' ) => 'wpb_balloon_buzz',
			__( 'Balloon Facebook icon', 'js_composer' ) => 'wpb_balloon_facebook',
			__( 'Balloon Twitter icon', 'js_composer' ) => 'wpb_balloon_twitter',
			__( 'Battery icon', 'js_composer' ) => 'wpb_battery',
			__( 'Binocular icon', 'js_composer' ) => 'wpb_binocular',
			__( 'Document Excel icon', 'js_composer' ) => 'wpb_document_excel',
			__( 'Document Image icon', 'js_composer' ) => 'wpb_document_image',
			__( 'Document Music icon', 'js_composer' ) => 'wpb_document_music',
			__( 'Document Office icon', 'js_composer' ) => 'wpb_document_office',
			__( 'Document PDF icon', 'js_composer' ) => 'wpb_document_pdf',
			__( 'Document Powerpoint icon', 'js_composer' ) => 'wpb_document_powerpoint',
			__( 'Document Word icon', 'js_composer' ) => 'wpb_document_word',
			__( 'Bookmark icon', 'js_composer' ) => 'wpb_bookmark',
			__( 'Camcorder icon', 'js_composer' ) => 'wpb_camcorder',
			__( 'Camera icon', 'js_composer' ) => 'wpb_camera',
			__( 'Chart icon', 'js_composer' ) => 'wpb_chart',
			__( 'Chart pie icon', 'js_composer' ) => 'wpb_chart_pie',
			__( 'Clock icon', 'js_composer' ) => 'wpb_clock',
			__( 'Fire icon', 'js_composer' ) => 'wpb_fire',
			__( 'Heart icon', 'js_composer' ) => 'wpb_heart',
			__( 'Mail icon', 'js_composer' ) => 'wpb_mail',
			__( 'Play icon', 'js_composer' ) => 'wpb_play',
			__( 'Shield icon', 'js_composer' ) => 'wpb_shield',
			__( 'Video icon', 'js_composer' ) => "wpb_video"
		);
		
		$button_styles = array(
			'Rounded' => 'rounded',
			'Square' => 'square',
			'Round' => 'round',
			'Outlined' => 'outlined',
			'3D' => '3d',
			'Square Outlined' => 'square_outlined'
		);
		
		$cta_styles = array(
			'Rounded' => 'rounded',
			'Square' => 'square',
			'Round' => 'round',
			'Outlined' => 'outlined',
			'Square Outlined' => 'square_outlined'
		);

		$txt_align = array(
			'Left' => 'left',
			'Right' => 'right',
			'Center' => 'center',
			'Justify' => 'justify'
		);
		
		$el_widths = array(
			'100%' => '',
			'90%' => '90',
			'80%' => '80',
			'70%' => '70',
			'60%' => '60',
			'50%' => '50'
		);
		
		$vc_add_css_animation = array(
			'type' => 'dropdown',
			'heading' => __( 'CSS Animation', 'js_composer' ),
			'param_name' => 'css_animation',
			'admin_label' => true,
			'value' => array(
				__( 'No', 'js_composer' ) => '',
				__( 'Top to bottom', 'js_composer' ) => 'top-to-bottom',
				__( 'Bottom to top', 'js_composer' ) => 'bottom-to-top',
				__( 'Left to right', 'js_composer' ) => 'left-to-right',
				__( 'Right to left', 'js_composer' ) => 'right-to-left',
				__( 'Appear from center', 'js_composer' ) => "appear"
			),
			'description' => __( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'js_composer' )
		);
		
		vc_map( array(
			'name' => __( 'Button', 'js_composer' ) . " 1",
			'base' => 'vc_button',
			'icon' => 'icon-wpb-ui-button',
			'category' => __( 'Content', 'js_composer' ),
			'description' => __( 'Eye catching button', 'js_composer' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Text', 'js_composer' ),
					'holder' => 'button',
					'class' => 'wpb_button',
					'param_name' => 'title',
					'value' => __( 'Text on the button', 'js_composer' ),
					'description' => __( 'Enter text on the button.', 'js_composer' )
				),
				array(
					'type' => 'href',
					'heading' => __( 'URL (Link)', 'js_composer' ),
					'param_name' => 'href',
					'description' => __( 'Enter button link.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'js_composer' ),
					'param_name' => 'target',
					'value' => $target_arr,
					'dependency' => array(
						'element' => 'href',
						'not_empty' => true,
						'callback' => 'vc_button_param_target_callback'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Color', 'js_composer' ),
					'param_name' => 'color',
					'value' => $colors_arr,
					'description' => __( 'Select button color.', 'js_composer' ),
					'param_holder_class' => 'vc_colored-dropdown'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'js_composer' ),
					'param_name' => 'icon',
					'value' => $icons_arr,
					'description' => __( 'Select icon to display on button.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Size', 'js_composer' ),
					'param_name' => 'size',
					'value' => $size_arr,
					'description' => __( 'Select button size.', 'js_composer' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'js_composer' ),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
				)
			),
			'js_view' => 'VcButtonView'
		) );

		vc_map( array(
			'name' => __( 'Button', 'js_composer' ) . " 2",
			'base' => 'vc_button2',
			'icon' => 'icon-wpb-ui-button',
			'category' => array(
				__( 'Content', 'js_composer' )
			),
			'description' => __( 'Eye catching button', 'js_composer' ),
			'params' => array(
				array(
					'type' => 'vc_link',
					'heading' => __( 'URL (Link)', 'js_composer' ),
					'param_name' => 'link',
					'description' => __( 'Add link to button.', 'js_composer' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Text', 'js_composer' ),
					'holder' => 'button',
					'class' => 'vc_btn',
					'param_name' => 'title',
					'value' => __( 'Text on the button', 'js_composer' ),
					'description' => __( 'Enter text on the button.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Alignment', 'js_composer' ),
					'param_name' => 'align',
					'value' => array(
						__( 'Inline', 'js_composer' ) => "inline",
						__( 'Left', 'js_composer' ) => 'left',
						__( 'Center', 'js_composer' ) => 'center',
						__( 'Right', 'js_composer' ) => "right"
					),
					'description' => __( 'Select button alignment.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Shape', 'js_composer' ),
					'param_name' => 'style',
					'value' => $button_styles,
					'description' => __( 'Select button display style and shape.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Color', 'js_composer' ),
					'param_name' => 'color',
					'value' => $colors_arr,
					'description' => __( 'Select button color.', 'js_composer' ),
					'param_holder_class' => 'vc_colored-dropdown'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Size', 'js_composer' ),
					'param_name' => 'size',
					'value' => $size_arr,
					'std' => 'md',
					'description' => __( 'Select button size.', 'js_composer' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'js_composer' ),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
				)
			),
			'js_view' => 'VcButton2View'
		) );
		
		vc_map( array(
			'name' => __( 'Call to Action', 'js_composer' ),
			'base' => 'vc_cta_button',
			'icon' => 'icon-wpb-call-to-action',
			'category' => __( 'Content', 'js_composer' ),
			'description' => __( 'Catch visitors attention with CTA block', 'js_composer' ),
			'params' => array(
				array(
					'type' => 'textarea',
					'admin_label' => true,
					'heading' => __( 'Text', 'js_composer' ),
					'param_name' => 'call_text',
					'value' => __( 'Click edit button to change this text.', 'js_composer' ),
					'description' => __( 'Enter text content.', 'js_composer' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Text on the button', 'js_composer' ),
					'param_name' => 'title',
					'value' => __( 'Text on the button', 'js_composer' ),
					'description' => __( 'Enter text on the button.', 'js_composer' )
				),
				array(
					'type' => 'href',
					'heading' => __( 'URL (Link)', 'js_composer' ),
					'param_name' => 'href',
					'description' => __( 'Enter button link.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'js_composer' ),
					'param_name' => 'target',
					'value' => $target_arr,
					'dependency' => array(
						'element' => 'href',
						'not_empty' => true,
						'callback' => 'vc_cta_button_param_target_callback'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Color', 'js_composer' ),
					'param_name' => 'color',
					'value' => $colors_arr,
					'description' => __( 'Select button color.', 'js_composer' ),
					'param_holder_class' => 'vc_colored-dropdown'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Button icon', 'js_composer' ),
					'param_name' => 'icon',
					'value' => $icons_arr,
					'description' => __( 'Select icon to display on button.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Size', 'js_composer' ),
					'param_name' => 'size',
					'value' => $size_arr,
					'description' => __( 'Select button size.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Button position', 'js_composer' ),
					'param_name' => 'position',
					'value' => array(
						__( 'Right', 'js_composer' ) => 'cta_align_right',
						__( 'Left', 'js_composer' ) => 'cta_align_left',
						__( 'Bottom', 'js_composer' ) => 'cta_align_bottom'
					),
					'description' => __( 'Select button alignment.', 'js_composer' )
				),
				$vc_add_css_animation,
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'js_composer' ),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
				)
			),
			'js_view' => 'VcCallToActionView'
		) );

		vc_map( array(
			'name' => __( 'Call to Action Button', 'js_composer' ) . ' 2',
			'base' => 'vc_cta_button2',
			'icon' => 'icon-wpb-call-to-action',
			'category' => array( __( 'Content', 'js_composer' ) ),
			'description' => __( 'Catch visitors attention with CTA block', 'js_composer' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Heading', 'js_composer' ),
					'admin_label' => true,
					//'holder' => 'h2',
					'param_name' => 'h2',
					'value' => __( 'Hey! I am first heading line feel free to change me', 'js_composer' ),
					'description' => __( 'Enter text for heading line.', 'js_composer' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Subheading', 'js_composer' ),
					//'holder' => 'h4',
					//'admin_label' => true,
					'param_name' => 'h4',
					'value' => '',
					'description' => __( 'Enter text for subheading line.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Shape', 'js_composer' ),
					'param_name' => 'style',
					'value' => $cta_styles,
					'description' => __( 'Select display shape and style.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Width', 'js_composer' ),
					'param_name' => 'el_width',
					'value' => $el_widths,
					'description' => __( 'Select element width (percentage).', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Text alignment', 'js_composer' ),
					'param_name' => 'txt_align',
					'value' => $txt_align,
					'description' => __( 'Select text alignment in "Call to Action" block.', 'js_composer' )
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Background color', 'js_composer' ),
					'param_name' => 'accent_color',
					'description' => __( 'Select background color.', 'js_composer' )
				),
				array(
					'type' => 'textarea_html',
					//holder' => 'div',
					//'admin_label' => true,
					'heading' => __( 'Text', 'js_composer' ),
					'param_name' => 'content',
					'value' => __( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'js_composer' )
				),
				array(
					'type' => 'vc_link',
					'heading' => __( 'URL (Link)', 'js_composer' ),
					'param_name' => 'link',
					'description' => __( 'Add link to button (Important: adding link automatically adds button).', 'js_composer' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Text on the button', 'js_composer' ),
					//'holder' => 'button',
					//'class' => 'wpb_button',
					'param_name' => 'title',
					'value' => __( 'Text on the button', 'js_composer' ),
					'description' => __( 'Add text on the button.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Shape', 'js_composer' ),
					'param_name' => 'btn_style',
					'value' => $button_styles,
					'description' => __( 'Select button display style and shape.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Color', 'js_composer' ),
					'param_name' => 'color',
					'value' => $colors_arr,
					'description' => __( 'Select button color.', 'js_composer' ),
					'param_holder_class' => 'vc_colored-dropdown'
				),
				/*array(
				'type' => 'dropdown',
				'heading' => __( 'Icon', 'js_composer' ),
				'param_name' => 'icon',
				'value' => getVcShared( 'icons' ),
				'description' => __( 'Button icon.', 'js_composer' )
		  ),*/
				array(
					'type' => 'dropdown',
					'heading' => __( 'Size', 'js_composer' ),
					'param_name' => 'size',
					'value' => $size_arr,
					'std' => 'md',
					'description' => __( 'Select button size.', 'js_composer' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Button position', 'js_composer' ),
					'param_name' => 'position',
					'value' => array(
						__( 'Right', 'js_composer' ) => 'right',
						__( 'Left', 'js_composer' ) => 'left',
						__( 'Bottom', 'js_composer' ) => 'bottom'
					),
					'description' => __( 'Select button alignment.', 'js_composer' )
				),
				$vc_add_css_animation,
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'js_composer' ),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
				)
			)
		) );
		
//		vc_remove_param('vc_row', 'parallax');
//		vc_remove_param('vc_row', 'parallax_image');
	}
	
	
	if( WPB_VC_VERSION >= '4.6' ) {
		vc_remove_param('vc_row', 'full_width');
		vc_remove_param('vc_row', 'full_height');
	}	
	
}