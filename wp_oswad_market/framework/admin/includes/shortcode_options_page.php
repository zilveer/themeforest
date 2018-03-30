<?php
function sort_shortcode_array( $_var1,$_var2 ){
	return strcmp($_var1['name'],$_var2['name']);
}

function get_shortcode_options(){
    $shortcode_array =  array(
		array(
            'name'      =>  'Heading',
            'value'     =>  'heading',
            'options'   =>  array(
					array(
                        'name'  =>  'heading_size',
                        'type'  =>  'select',
                        'id'    =>  'heading_size',
                        'label' =>  'Size',
						'values'=> array(
							array(
								'value'	=>	'1',
								'label'	=>	'1'
							)
							,array(
								'value'	=>	'2',
								'label'	=>	'2'
							)
							,array(
								'value'	=>	'3',
								'label'	=>	'3'
							)	
							,array(
								'value'	=>	'4',
								'label'	=>	'4'
							)
							,array(
								'value'	=>	'5',
								'label'	=>	'5'
							)
							,array(
								'value'	=>	'6',
								'label'	=>	'6'
							)						
						)
                    )
					,array(
                        'name'  =>  'heading_content',
                        'type'  =>  'textarea',
                        'id'    =>  'heading_content',
                        'label' =>  'Content'
                    )					
            )
        )
		,array(
            'name'      =>  'Google Map',
            'value'     =>  'google_map',
            'options'   =>  array(
					array(
                        'name'  =>  'google_map_type'
                        ,'type'  =>  'select'
                        ,'id'    =>  'google_map_type'
                        ,'label' =>  'Map type'
						,'values'=> array(
							array(
								'value'	=>	'roadmap',
								'label'	=>	'Roadmap '
							)
							,array(
								'value'	=>	'satellite',
								'label'	=>	'Satellite '
							)
							,array(
								'value'	=>	'hybrid',
								'label'	=>	'Hybrid '
							)	
							,array(
								'value'	=>	'terrain',
								'label'	=>	'Terrain'
							)
						
						)
                    )
					,array(
                        'name'  	=>  'google_map_address'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'google_map_address'
                        ,'label' 	=>  'Address'
						,'default' 	=> 	'London'
                    )		
					,array(
                        'name'  	=>  'google_map_address_title'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'google_map_address_title'
                        ,'label' 	=>  'Address Title'
						,'default' 	=> 	'Head Office'
                    )
					,array(
                        'name'  	=>  'google_map_height'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'google_map_height'
                        ,'label' 	=>  'Map Height'
						,'default' 	=> 	'360'
                    )
					,array(
                        'name'  	=>  'google_map_zoom'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'google_map_zoom'
                        ,'label' 	=>  'Zoom value'
						,'default' 	=> 	'16'
                    )		
					,array(
                        'name'  	=>  'google_map_color'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'google_map_color'
                        ,'label' 	=>  'Map Color'
						,'default' 	=> 	''
						,'class'	=>	'colorpicker_control'
                    )
					,array(
                        'name'  	=>  'google_map_road_color'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'google_map_road_color'
                        ,'label' 	=>  'Road Color'
						,'default' 	=> 	''
						,'class'	=>	'colorpicker_control'
                    )
					,array(
                        'name'  	=>  'google_map_water_color'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'google_map_water_color'
                        ,'label' 	=>  'Water Color'
						,'default' 	=> 	''
						,'class'	=>	'colorpicker_control'
                    )					
            )
        )		
        ,array(
            'name'      =>  'Add Line',
            'value'     =>  'add_line',
            'options'   =>  array(
                    array(
                        'name'  =>  'height_line',
                        'type'  =>  'text',
                        'id'    =>  'height_line_add_line',
                        'label' =>  'Height Line',
                        'default'=> '1'
                    )
                    ,array(
                        'name'  =>  'add_line_class'
                        ,'type'  =>  'text'
                        ,'id'    =>  'add_line_class'
                        ,'label' =>  'Class'
                    )					
                    ,array(
                        'name'  =>  'color_add_line',
                        'type'  =>  'text',
                        'id'    =>  'color_add_line',
                        'label' =>  'Color',
                        'default'=> 'black',
						'class'	=>'colorpicker_control'
                    )
            )
        ),
        array(
            'name'      =>  'Dropcap',
            'value'     =>  'dropcap',
            'options'   =>  array(
                    array(
                        'name'  =>  'dropcap_color',
                        'type'  =>  'text',
                        'id'    =>  'dropcap_color',
                        'label' =>  'Color',
                        'default'=> 'black',
						'class'	=>'colorpicker_control'
                    )
					,array(
                        'name'  =>  'dropcap_content',
                        'type'  =>  'textarea',
                        'id'    =>  'dropcap_content',
                        'label' =>  'Content'
                    )					
            )
        ),
        array(
            'name'      =>  'Icon',
            'value'     =>  'icon',
            'options'   =>  array(
                    // array(
                        // 'name'  =>  'size_icon',
                        // 'type'  =>  'text',
                        // 'id'    =>  'size_icon',
                        // 'label' =>  'Icon',
                        // 'default'=> 'none',
						// 'class'	=>'icon_picker'
                    // )
            )
        ),		
        array(
            'name'      =>  'Align Box',
            'value'     =>  'align',
            'options'   =>  array(
					array(
                        'name'  =>  'align_style',
                        'type'  =>  'select',
                        'id'    =>  'align_style',
                        'label' =>  'Style',
						'values'=> array(
							array(
								'value'	=>	'left',
								'label'	=>	'Left'
							)
							,array(
								'value'	=>	'right',
								'label'	=>	'Right'
							)
							,array(
								'value'	=>	'center',
								'label'	=>	'Center'
							)							
						)
                    )
					,array(
                        'name'  =>  'align_content',
                        'type'  =>  'textarea',
                        'id'    =>  'align_content',
                        'label' =>  'Content'
                    )
            )
        ),		
		array(
            'name'      =>  'Quote',
            'value'     =>  'quote',
            'options'   =>  array(
                    array(
                        'name'  =>  'content_quote',
                        'type'  =>  'textarea',
                        'id'    =>  'content_quote',
                        'label' =>  'The content of quote'
                    ),
					array(
                        'name'  =>  'custom_class_quote',
                        'type'  =>  'text',
                        'id'    =>  'custom_class_quote',
                        'label' =>  'The custom class'
                    )
            )
        ),
		array(
            'name'      =>  'Button Group',
            'value'     =>  'button_group',
            'options'   =>  array(
                    array(
                        'name'  =>  'content_button_group',
                        'type'  =>  'textarea',
                        'id'    =>  'content_button_group',
                        'label' =>  'The content of button group'
                    ),
					array(
                        'name'  =>  'vertical_button_group',
                        'type'  =>  'select',
                        'id'    =>  'vertical_button_group',
                        'label' =>  'Vertical Group',
						'values'=> array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							),
							array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)
                    )
            )
        ),			
		array(
            'name'      =>  'Button',
            'value'     =>  'button',
            'options'   =>  array(
                    array(
                        'name'  =>  'size_button',
                        'type'  =>  'select',
                        'id'    =>  'size_button',
                        'label' =>  'The size of button',
						'values'=> array(
							array(
								'value'	=>	'default',
								'label'	=>	'Default'
							),							
							array(
								'value'	=>	'mini',
								'label'	=>	'Mini'
							),
							array(
								'value'	=>	'small',
								'label'	=>	'Small'
							),
							array(
								'value'	=>	'large',
								'label'	=>	'Large'
							),
							array(
								'value'	=>	'largest',
								'label'	=>	'Largest'
							)
						)
                    ),
					/*array(
                        'name'  =>  'type_button',
                        'type'  =>  'select',
                        'id'    =>  'type_button',
                        'label' =>  'Type of button',
						'values'=> array(
							array(
								'value'	=>	'button',
								'label'	=>	htmlspecialchars('Tag <a>')
							),
							array(
								'value'	=>	'submit',
								'label'	=>	'Button'
							)
						)
                    ),*/
					array(
                        'name'  =>  'link_button',
                        'type'  =>  'text',
                        'id'    =>  'link_button',
                        'label' =>  'The link of button'
                    ),
					/*array(
                        'name'  =>  'type_button',
                        'type'  =>  'select',
                        'id'    =>  'type_button',
                        'label' =>  'Button Type',
						'values'=> array(
							array(
								'value'	=>	'default',
								'label'	=>	'Default'
							),						
							array(
								'value'	=>	'primary',
								'label'	=>	'Primary'
							),
							array(
								'value'	=>	'danger',
								'label'	=>	'Danger'
							),
							array(
								'value'	=>	'warning',
								'label'	=>	'Warning'
							),
							array(
								'value'	=>	'success',
								'label'	=>	'Success'
							),
							array(
								'value'	=>	'info',
								'label'	=>	'Info'
							),
							array(
								'value'	=>	'inverse',
								'label'	=>	'Inverse'
							)
						)
                    ),*/
					/*array(
                        'name'  =>  'color_text_button',
                        'type'  =>  'text',
                        'id'    =>  'color_text_button',
                        'label' =>  'Color of text',
						'class'	=>	'colorpicker_control'
                    ),*/
					array(
                        'name'  =>  'background_button',
                        'type'  =>  'select',
                        'id'    =>  'background_button',
                        'label' =>  'Button BackGround',
						'values'=> array(
							array(
								'value'	=>	'yes',
								'label'	=>	'Yes'
							),						
							array(
								'value'	=>	'no',
								'label'	=>	'No'
							),
						)
                    ),
					array(
                        'name'  =>  'opacity_button',
                        'type'  =>  'select',
                        'id'    =>  'opacity_button',
                        'label' =>  'Button Opacity',
						'values'=> array(
							array(
								'value'	=>	'boldest',
								'label'	=>	'Most Bold'
							),						
							array(
								'value'	=>	'bold',
								'label'	=>	'Bold'
							),
							array(
								'value'	=>	'faint',
								'label'	=>	'Faint'
							),
							array(
								'value'	=>	'faintest',
								'label'	=>	'Fainest'
							)
						)
                    ),
					array(
                        'name'  =>  'color_button',
                        'type'  =>  'select',
                        'id'    =>  'color_button',
                        'label' =>  'The color of button',
						'values'=> array(
							/*array(
								'value'	=>	'btn-over-grey',
								'label'	=>	'Grey'
							),*/
							array(
								'value'	=>	'btn-over-black',
								'label'	=>	'Black'
							),
							array(
								'value'	=>	'btn-over-orange',
								'label'	=>	'Orange'
							),
							array(
								'value'	=>	'btn-over-blue',
								'label'	=>	'Blue'
							),
							array(
								'value'	=>	'btn-over-green',
								'label'	=>	'Green'
							),
							array(
								'value'	=>	'btn-over-red',
								'label'	=>	'Red'
							),
							/*array(
								'value'	=>	'btn-over-pink',
								'label'	=>	'Pink'
							),
							array(
								'value'	=>	'btn-over-scarlet',
								'label'	=>	'Scarlet'
							),*/
							array(
								'value'	=>	'btn-over-magenta',
								'label'	=>	'Magenta'
							),
							array(
								'value'	=>	'btn-over-cardinal',
								'label'	=>	'Cardinal'
							),
							array(
								'value'	=>	'btn-over-azure',
								'label'	=>	'Azure'
							),
							array(
								'value'	=>	'btn-over-olive',
								'label'	=>	'Olive'
							)
						)
                    ),
					/*
					array(
                        'name'  =>  'shadow_button',
                        'type'  =>  'select',
                        'id'    =>  'shadow_button',
                        'label' =>  'Enable or disable shadow effect for button',
						'values'=> array(
							array(
								'value'	=>	'',
								'label'	=>	'No shadow'
							),
							array(
								'value'	=>	'btn-shadow',
								'label'	=>	'Shadow'
							)
						)
                    ),*/
					array(
                        'name'  =>  'custom_class_button',
                        'type'  =>  'text',
                        'id'    =>  'custom_class_button',
                        'label' =>  'The custom class of button'
                    ),
                    array(
                        'name'  =>  'content_button',
                        'type'  =>  'textarea',
                        'id'    =>  'content_button',
                        'label' =>  'The content of button'
                    )
            )
        ),
        array(
            'name'      =>  'Checklist',
            'value'     =>  'checklist',
            'options'   =>  array(
                    array(
                        'name'  =>  'checklist_icon',
                        'type'  =>  'text',
                        'id'    =>  'checklist_icon',
                        'label' =>  'Icon',
                        'default'=> 'none'
                    )
            )
        ),		
		array(
            'name'      =>  'Label',
            'value'     =>  'label',
            'options'   =>  array(
					array(
                        'name'  =>  'type_label',
                        'type'  =>  'select',
                        'id'    =>  'type_label',
                        'label' =>  'Label Type',
						'values'=> array(
							array(
								'value'	=>	'default',
								'label'	=>	'Default'
							),	
							array(
								'value'	=>	'success',
								'label'	=>	'Success'
							),		
							array(
								'value'	=>	'warning',
								'label'	=>	'Warning'
							),							
							array(
								'value'	=>	'important',
								'label'	=>	'Important'
							),
							array(
								'value'	=>	'info',
								'label'	=>	'Info'
							),
							array(
								'value'	=>	'inverse',
								'label'	=>	'Inverse'
							)
						)
                    ),
                    array(
                        'name'  =>  'content_label',
                        'type'  =>  'textarea',
                        'id'    =>  'content_label',
                        'label' =>  'The content of label'
                    )
            )
        ),	
		array(
            'name'      =>  'Alert Box',
            'name'      =>  'Alert Box',
            'value'     =>  'alert',
            'options'   =>  array(
					array(
                        'name'  =>  'style_alert',
                        'type'  =>  'select',
                        'id'    =>  'style_alert',
                        'label' =>  'Alert Style',
						'values'=> array(
							array(
								'value'	=>	'block',
								'label'	=>	'Default'
							),	
							array(
								'value'	=>	'notice',
								'label'	=>	'Notice'
							),							
							array(
								'value'	=>	'success',
								'label'	=>	'Success'
							),		
							array(
								'value'	=>	'error',
								'label'	=>	'Error'
							),							
							array(
								'value'	=>	'info',
								'label'	=>	'Info'
							)
						)
                    ),
					array(
                        'name'  =>  'close_alert',
                        'type'  =>  'select',
                        'id'    =>  'close_alert',
                        'label' =>  'Show close button',
						'values'=> array(
							array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							),	
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
						)
                    ),					
                    array(
                        'name'  =>  'content_alert',
                        'type'  =>  'textarea',
                        'id'    =>  'content_alert',
                        'label' =>  'The content of Alert'
                    )
            )
        ),	
		array(
            'name'      =>  'Progress Bars',
            'value'     =>  'progress',
            'options'   =>  array(
					array(
                        'name'  =>  'striped_bars',
                        'type'  =>  'select',
                        'id'    =>  'striped_bars',
                        'label' =>  'Striped Progress Bars',
						'values'=> array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							),	
							array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)
                    ),		
					array(
                        'name'  =>  'animated_bars',
                        'type'  =>  'select',
                        'id'    =>  'animated_bars',
                        'label' =>  'Animated Progress Bars',
						'values'=> array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							),	
							array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)
                    ),			
					array(
                        'name'  =>  'style_bar',
                        'type'  =>  'select',
                        'id'    =>  'style_bar',
                        'label' =>  'Bar Style',
						'values'=> array(
							array(
								'value'	=>	'default',
								'label'	=>	'Default'
							),	
							array(
								'value'	=>	'info',
								'label'	=>	'Info'
							),							
							array(
								'value'	=>	'success',
								'label'	=>	'Success'
							),		
							array(
								'value'	=>	'warning',
								'label'	=>	'Warning'
							),							
							array(
								'value'	=>	'danger',
								'label'	=>	'Danger'
							)
						)
                    ),
					array(
                        'name'  =>  'percent_bars',
                        'type'  =>  'text',
                        'id'    =>  'percent_bars',
                        'label' =>  'Bar Percent',
						'default'=>	'10'
                    ),						
                    array(
                        'name'  =>  'content_bars',
                        'type'  =>  'textarea',
                        'id'    =>  'content_bars',
                        'label' =>  'Bar Content'
                    )
            )
        ),			
		array(
            'name'      =>  'Badge',
            'value'     =>  'badge',
            'options'   =>  array(
					array(
                        'name'  =>  'type_badge',
                        'type'  =>  'select',
                        'id'    =>  'type_badge',
                        'label' =>  'Badge Type',
						'values'=> array(
							array(
								'value'	=>	'default',
								'label'	=>	'Default'
							),	
							array(
								'value'	=>	'success',
								'label'	=>	'Success'
							),		
							array(
								'value'	=>	'warning',
								'label'	=>	'Warning'
							),							
							array(
								'value'	=>	'important',
								'label'	=>	'Important'
							),
							array(
								'value'	=>	'info',
								'label'	=>	'Info'
							),
							array(
								'value'	=>	'inverse',
								'label'	=>	'Inverse'
							)
						)
                    ),
                    array(
                        'name'  =>  'content_badge',
                        'type'  =>  'textarea',
                        'id'    =>  'content_badge',
                        'label' =>  'The content of badge'
                    )
            )
        ),				
		/*array(
            'name'      =>  'Hight Light Text',
            'value'     =>  'hightlight_text',
            'options'   =>  array(
                    array(
                        'name'  =>  'background_hightlight_text',
                        'type'  =>  'text',
                        'id'    =>  'background_hightlight_text',
                        'label' =>  'The background for hightlight text',
						'class'	=>	'colorpicker_control'
                    ),
                    array(
                        'name'  =>  'content_hightlight_text',
                        'type'  =>  'textarea',
                        'id'    =>  'content_hightlight_text',
                        'label' =>  'The content of hightlight text'
                    )
            )
        ),
		/*array(
            'name'      =>  'Embbed Video',
            'value'     =>  'ew_embbed_video',
            'options'   =>  array(
					array(
                        'name'  =>  'src_ew_embbed_video',
                        'type'  =>  'text',
                        'id'    =>  'src_ew_embbed_video',
                        'label' =>  'Enter a source of file'
                    ),
					array(
                        'name'  =>  'width_ew_embbed_video',
                        'type'  =>  'text',
                        'id'    =>  'width_ew_embbed_video',
                        'label' =>  'Enter width of embed tag'
                    ),
					array(
                        'name'  =>  'height_ew_embbed_video',
                        'type'  =>  'text',
                        'id'    =>  'height_ew_embbed_video',
                        'label' =>  'Enter height of embed tag'
                    ),
					array(
                        'name'  =>  'custom_class_ew_embbed_video',
                        'type'  =>  'text',
                        'id'    =>  'custom_class_ew_embbed_video',
                        'label' =>  'Custom class'
                    )
            )
        ),*/
		array(
            'name'      =>  'Code',
            'value'     =>  'code',
            'options'   =>  array(
				array(
                        'name'  =>  'content_ew_code',
                        'type'  =>  'textarea',
                        'id'    =>  'content_ew_code',
                        'label' =>  'The content of code'
                    )
            )
        ),
		array(
            'name'      =>  'Slide Show',
            'value'     =>  'slideshow',
            'options'   =>  array(
				// array(
						// 'name'	=>	'slideshow_auto',
						// 'type'	=> 	'select',
						// 'id'	=>	'slideshow_auto',
						// 'label'	=>	'Auto Run',
						// 'values'=>	array(
							// array(
								// 'value'	=>	'0',
								// 'label'	=>	'No'
							// ),
							// array(
								// 'value'	=>	'1',
								// 'label'	=>	'Yes'
							// )
						// )
				// ),
				array(
                        'name'  =>  'insert_slide',
                        'type'  =>  'insert_slide',
                        'id'    =>  'insert_slide',
                        'label' =>  'Insert Slide',
						'default'=>	''
                ),				
				array(
                        'name'  =>  'slideshow_width',
                        'type'  =>  'text',
                        'id'    =>  'slideshow_width',
                        'label' =>  'Slideshow Width',
						'default'=>	'400'
                ),
				array(
                        'name'  =>  'slideshow_height',
                        'type'  =>  'text',
                        'id'    =>  'slideshow_height',
                        'label' =>  'Slideshow Height',
						'default'=>	'400'
                ),				
				array(
                        'name'  =>  'slideshow_content',
                        'type'  =>  'textarea',
                        'id'    =>  'slideshow_content',
                        'label' =>  'Slideshow code'
                )				
			)
		),		
					
		// array(
            // 'name'      =>  'Style Box',
            // 'value'     =>  'ew_style_box',
            // 'options'   =>  array(
				// array(
						// 'name'	=>	'type_ew_style_box',
						// 'type'	=> 	'select',
						// 'id'	=>	'type_ew_style_box',
						// 'label'	=>	'Type',
						// 'values'=>	array(
							// array(
								// 'value'	=>	'info',
								// 'label'	=>	'Info Message'
							// ),
							// array(
								// 'value'	=>	'success',
								// 'label'	=>	'Success Message'
							// ),
							// array(
								// 'value'	=>	'error',
								// 'label'	=>	'Error Message'
							// ),
							// array(
								// 'value'	=>	'notice',
								// 'label'	=>	'Notice Message'
							// ),
							// array(
								// 'value'	=>	'note',
								// 'label'	=>	'Note Message'
							// )
						// )
				// ),
				// array(
                        // 'name'  =>  'stylebox_border_color',
                        // 'type'  =>  'text',
                        // 'id'    =>  'stylebox_border_color',
                        // 'label' =>  'Bordor color',
						// 'class'	=>	'colorpicker_control',
						// 'default'=>	'#000000'
                // ),
				// // array(
                        // // 'name'  =>  'stylebox_background_color',
                        // // 'type'  =>  'text',
                        // // 'id'    =>  'stylebox_background_color',
                        // // 'label' =>  'Background color',
						// // 'class'	=>	'colorpicker_control'
                // // ),
				// // array(
                        // // 'name'  =>  'stylebox_text_color',
                        // // 'type'  =>  'text',
                        // // 'id'    =>  'stylebox_text_color',
                        // // 'label' =>  'Text color',
						// // 'class'	=>	'colorpicker_control'
                // // ),
				// array(
                        // 'name'  =>  'content_style_box',
                        // 'type'  =>  'textarea',
                        // 'id'    =>  'content_style_box',
                        // 'label' =>  'The content of info message'
                // )
            // )
        // ),
		array(
            'name'      =>  'Columns',
            'value'     =>  'ew_columns',
            'options'   =>  array(
				array(
					'name'  =>  'type_ew_columns',
					'type'  =>  'select',
					'id'    =>  'type_ew_columns',
					'label' =>  'Type',
					'values'=>	array(
						array(
							'value'	=> 'one_half',
							'label'	=> 'One Half'
						),
						array(
							'value'	=> 'one_third',
							'label'	=> 'One Third'
						),
						array(
							'value'	=> 'one_fourth',
							'label'	=> 'One Fourth'
						),
						array(
							'value'	=> 'one_fifth',
							'label'	=> 'One Fifth'
						),
						array(
							'value'	=> 'one_sixth',
							'label'	=> 'One Sixth'
						),
						array(
							'value'	=> 'two_third',
							'label'	=> 'Two Third'
						),
						array(
							'value'	=> 'three_fourth',
							'label'	=> 'Three Fourth'
						),
						array(
							'value'	=> 'two_fifth',
							'label'	=> 'Two Fifth'
						),
						array(
							'value'	=> 'three_fifth',
							'label'	=> 'Three Fifth'
						),
						array(
							'value'	=> 'four_fifth',
							'label'	=> 'Four Fifth'
						),
						array(
							'value'	=> 'five_sixth',
							'label'	=> 'Five Sixth'
						),
						array(
							'value'	=> 'one_half_last',
							'label'	=> 'One Half Last'
						),
						array(
							'value'	=> 'one_third_last',
							'label'	=> 'One Third Last'
						),
						array(
							'value'	=> 'one_fourth_last',
							'label'	=> 'One Fourth Last'
						),
						array(
							'value'	=> 'one_fifth_last',
							'label'	=> 'One Fifth Last'
						),
						array(
							'value'	=> 'one_sixth_last',
							'label'	=> 'One Sixth Last'
						),
						array(
							'value'	=> 'two_third_last',
							'label'	=> 'Two Third Last'
						),
						array(
							'value'	=> 'three_fourth_last',
							'label'	=> 'Three Fourth Last'
						),
						array(
							'value'	=> 'two_fifth_last',
							'label'	=> 'Two Fifth Last'
						),
						array(
							'value'	=> 'three_fifth_last',
							'label'	=> 'Three Fifth Last'
						),
						array(
							'value'	=> 'four_fifth_last',
							'label'	=> 'Four Fifth Last'
						),
						array(
							'value'	=> 'five_sixth_last',
							'label'	=> 'Five Sixth Last'
						)
					)
				),
				array(
					'name'  =>  'content_ew_columns',
					'type'  =>  'textarea',
					'id'    =>  'content_ew_columns',
					'label' =>  'Content'
				)
            )
        ),
		array(
            'name'      =>  'Accordions',
            'value'     =>  'accordions',
            'options'   =>  array(
					array(
                        'name'  =>  'content_accordions',
                        'type'  =>  'textarea',
                        'id'    =>  'content_accordions',
                        'label' =>  'The content of accordions'
                    )				
            )
        ),
		array(
            'name'      =>  'Accordion Item',
            'value'     =>  'accordion_item',
            'options'   =>  array(
                    array(
                        'name'  =>  'title_accordion_item',
                        'type'  =>  'text',
                        'id'    =>  'title_accordion_item',
                        'label' =>  'the title for accordion item'
                    ),
					array(
                        'name'  =>  'content_accordion_item',
                        'type'  =>  'textarea',
                        'id'    =>  'content_accordion_item',
                        'label' =>  'The content of accordion item'
                    )
            )
        )

/*
[banner link_url="#" 
title="Have Question ?" 
title_color="#000" 
subtitle="... we are here to answer your questions 7days / week ..." 
subtitle_color="#000" 
bg_color="rgba(255,255,255,0.8)"
bg_image="http://demo.wpdance.com/imgs/woocommerce/shortcode-banner-01.jpg" 
border_color="#000" 
top_padding="30px" 
left_padding="20px" 
inner_stroke="1px" 
inner_stroke_color="#D1D1D1" 

sep_padding="15px" 
sep_color="#000" 
label="1" 
label_bg_color="#BA0057" 
label_text_color="#fff" 
label_text="SPECIAL
OFFERS"]
*/	
		,array(
            'name'      =>  'Banner'
            ,'value'     =>  'banner'
            ,'options'   =>  array(
                    array(
                        'name'  			=>  'banner_link_url'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_link_url'
                        ,'label' 			=>  'Banner URI'
						,'default'			=>	'#'
                    )
					,array(
                        'name'  			=>  'banner_bg_image'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_bg_image'
                        ,'label' 			=>  'Background Image'
						,'class' 			=>  'custom_upload_image_text'
						,'default'			=> 	'Double click to choose images'
                    )
					,array(
                        'name'  			=>  'banner_bg_color'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_bg_color'
                        ,'label' 			=>  'Background Color'
						,'class' 			=>  'colorpicker_control_rgba'
						,'default'			=> 	'Click to choose color'
                    )		
					,array(
                        'name'  			=>  'banner_title'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_title'
                        ,'label' 			=>  'Title'
						,'default'			=> 	'Your title'
                    )	
					,array(
                        'name'  			=>  'banner_title_color'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_title_color'
                        ,'label' 			=>  'Title Color'
						,'class' 			=>  'colorpicker_control'
						,'default'			=> 	'Click to choose color'
                    )	
					,array(
                        'name'  			=>  'font_size_title'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'font_size_title'
                        ,'label' 			=>  'Fontsize Title'
						,'default'			=> 	'44'
                    )
					,array(
                        'name'  			=>  'banner_sub_title'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_sub_title'
                        ,'label' 			=>  'Sub Title'
						,'default'			=> 	'Your sub title'
                    )	
					,array(
                        'name'  			=>  'banner_sub_title_color'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_sub_title_color'
                        ,'label' 			=>  'Sub Title Color'
						,'class' 			=>  'colorpicker_control'
						,'default'			=> 	'Click to choose color'
                    )	
					,array(
                        'name'  			=>  'font_size_sub_title'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'font_size_sub_title'
                        ,'label' 			=>  'Fontsize Sub Title'
						,'default'			=> 	'18'
                    )					
					,array(
                        'name'  			=>  'banner_border_color'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_border_color'
                        ,'label' 			=>  'Border Color'
						,'class' 			=>  'colorpicker_control'
						,'default'			=> 	'Click to choose color'
                    )	
					,array(
                        'name'  			=>  'banner_top_padding'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_top_padding'
                        ,'label' 			=>  'Top Padding'
						,'default'			=> 	'40px'
                    )
					,array(
                        'name'  			=>  'banner_left_padding'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_left_padding'
                        ,'label' 			=>  'Left Padding'
						,'default'			=> 	'20px'
                    )	
					,array(
                        'name'  			=>  'banner_bottom_padding'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_bottom_padding'
                        ,'label' 			=>  'Bottom Padding'
						,'default'			=> 	'20px'
                    )
					,array(
                        'name'  			=>  'banner_right_padding'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_right_padding'
                        ,'label' 			=>  'Right Padding'
						,'default'			=> 	'20px'
                    )
					,array(
                        'name'  			=>  'banner_inner_stroke'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_inner_stroke'
                        ,'label' 			=>  'Inner Stroke'
						,'default'			=> 	'1px'
                    )
					,array(
                        'name'  			=>  'banner_inner_stroke_color'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_inner_stroke_color'
						,'class' 			=>  'colorpicker_control'
                        ,'label' 			=>  'Inner Stroke Color'
						,'default'			=> 	'Click to choose color'
                    )
					,array(
                        'name'  			=>  'banner_sep_padding'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_sep_padding'
                        ,'label' 			=>  'Sep Padding'
						,'default'			=> 	'15px'
                    )	
					,array(
                        'name'  			=>  'banner_sep_color'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_sep_color'
						,'class' 			=>  'colorpicker_control'
                        ,'label' 			=>  'Sep Color'
						,'default'			=> 	'Click to choose color'
                    )				
					,array(
                        'name'  			=>  'banner_label'
                        ,'type'  			=>  'select'
                        ,'id'    			=>  'banner_label'
                        ,'label' 			=>  'Using Label'
						,'default'			=> 	'no'
						,'values'=> array(
							array(
								'value'	=>	'no',
								'label'	=>	'No '
							)
							,array(
								'value'	=>	'yes',
								'label'	=>	'Yes '
							)
						)						
                    )	
					/*,array(
                        'name'  			=>  'banner_label_bg_color'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_label_bg_color'
						,'class' 			=>  'colorpicker_control'
                        ,'label' 			=>  'Label Backgroud Color'
						,'default'			=> 	'Click to choose color'
                    )*/	
					,array(
                        'name'  			=>  'banner_label_text'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_label_text'
                        ,'label' 			=>  'Label Text'
						,'default'			=> 	'Labal Text'
                    )	
					,array(
                        'name'  			=>  'banner_label_text_color'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_label_text_color'
						,'class' 			=>  'colorpicker_control'
                        ,'label' 			=>  'Label Text Color'
						,'default'			=> 	'Click to choose color'
                    )
					,array(
                        'name'  			=>  'banner_label_top'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_label_top'
                        ,'label' 			=>  'Label Top'
						,'default'			=> 	'10px'
                    )	
					,array(
                        'name'  			=>  'banner_label_right'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_label_right'
                        ,'label' 			=>  'Label Right'
						,'default'			=> 	'10px'
                    )
					,array(
                        'name'  			=>  'banner_box_shadow_color'
                        ,'type'  			=>  'text'
                        ,'id'    			=>  'banner_box_shadow_color'
                        ,'label' 			=>  'Box Shadow Color'
						,'class' 			=>  'colorpicker_control_rgba'
						,'default'			=> 	'Click to choose color'
                    )	
            )
        )		
		/*array(
            'name'      =>  'Site Map',
            'value'     =>  'sitemap',
            /*'options'   =>  array(
				array(
                        'name'  =>  'home_page_id_sitemap',
                        'type'  =>  'select',
                        'id'    =>  'home_page_id_sitemap',
                        'label' =>  'Select home page without sidebar',
						'default'=>75,
						'values'=>	get_pages_value()
                ),
				array(
                        'name'  =>  'home_page_sidebar_id_sitemap',
                        'type'  =>  'select',
                        'id'    =>  'home_page_sidebar_id_sitemap',
                        'label' =>  'Select home page with sidebar',
						'default'=>182,
						'values'=>	get_pages_value()
                ),
				array(
                        'name'  =>  'shortcode_page_id_sitemap',
                        'type'  =>  'select',
                        'id'    =>  'shortcode_page_id_sitemap',
                        'label' =>  'Select parent shortcode page',
						'default'=>34,
						'values'=>	get_pages_value()
                ),
				array(
                        'name'  =>  'portfolio_page_id_sitemap',
                        'type'  =>  'select',
                        'id'    =>  'portfolio_page_id_sitemap',
                        'label' =>  'Select parent portfolio page',
						'default'=>332,
						'values'=>	get_pages_value()
                ),
				array(
                        'name'  =>  'blog_page_id_sitemap',
                        'type'  =>  'select',
                        'id'    =>  'blog_page_id_sitemap',
                        'label' =>  'Select parent blog page',
						'default'=>573,
						'values'=>	get_pages_value()
                )
            )*/
        //),*/
		/*array(
            'name'      =>  'Service',
            'value'     =>  'service_item',
            'options'   =>  array(
					 array(
                        'name'  =>  'service_style',
                        'type'  =>  'select',
                        'id'    =>  'service_style',
                        'label' =>  'Style display',
						'default'=>	'service-style1',
						'values'=>	array(
							array(
								'value'	=>	'service-style1',
								'label'	=>	'Details list with thumbnail'
							),
							array(
								'value'	=>	'service-style2',
								'label'	=>	'Number Icon style'
							),
							array(
								'value'	=>	'service-style3',
								'label'	=>	'Icon style'
							),
							array(
								'value'	=>	'service-style4',
								'label'	=>	'Icon style 2'
							)
						)
                    ),
                   array(
                        'name'  =>  'service_id',
                        'type'  =>  'select',
                        'id'    =>  'service_id',
                        'label' =>  'Choose service item',
						//'default'=>	'service-style1',
						'values'=>	getServices()
						)
            )
        ),
		array(
            'name'      =>  'About Us',
            'value'     =>  'about',
            'options'   =>  array(
                   array(
                        'name'  =>  'about_id',
                        'type'  =>  'select',
                        'id'    =>  'about_id',
                        'label' =>  'Choose about item',
						'values'=>	getAbout()
						)
            )
        ),*/
		,array(
            'name'      =>  'Feature',
            'value'     =>  'feature',
            'options'   =>  array(
                    array(
                        'name'  =>  'feature_id',
                        'type'  =>  'text',
                        'id'    =>  'feature_id',
                        'label' =>  'ID(priority)',
                        'default'=> ''
                    )
                    ,array(
                        'name'  =>  'feature_slug'
                        ,'type'  =>  'text'
                        ,'id'    =>  'feature_slug'
                        ,'label' =>  'or Slug'
                    )
					,array(
                        'name'  =>  'feature_title'
                        ,'type'  =>  'select'
                        ,'id'    =>  'feature_title'
                        ,'label' =>  'Title'
						,'values'=>	array(
							array(
								'value'	=> 'yes',
								'label'	=> 'Yes'
							),
							array(
								'value'	=> 'no',
								'label'	=> 'No'
							)
						)	
                    )	
					,array(
                        'name'  =>  'feature_thumbnail'
                        ,'type'  =>  'select'
                        ,'id'    =>  'feature_thumbnail'
                        ,'label' =>  'Thumbnail'
						,'values'=>	array(
							array(
								'value'	=> 'yes',
								'label'	=> 'Yes'
							),
							array(
								'value'	=> 'no',
								'label'	=> 'No'
							)
						)	
                    )
					,array(
                        'name'  =>  'feature_excerpt'
                        ,'type'  =>  'select'
                        ,'id'    =>  'feature_excerpt'
                        ,'label' =>  'Excerpt'
						,'values'=>	array(
							array(
								'value'	=> 'yes',
								'label'	=> 'Yes'
							),
							array(
								'value'	=> 'no',
								'label'	=> 'No'
							)
						)	
                    )
					,array(
                        'name'  =>  'feature_content'
                        ,'type'  =>  'select'
                        ,'id'    =>  'feature_content'
                        ,'label' =>  'Content'
						,'values'=>	array(
							array(
								'value'	=> 'yes',
								'label'	=> 'Yes'
							),
							array(
								'value'	=> 'no',
								'label'	=> 'No'
							)
						)	
                    )	
            )
        )
		,array(
            'name'      =>  'Testimonials',
            'value'     =>  'testimonials',
            'options'   =>  array(
                    array(
                        'name'  =>  'testimonial_id',
                        'type'  =>  'text',
                        'id'    =>  'testimonial_id',
                        'label' =>  'ID(priority)',
                        'default'=> ''
                    )
                    ,array(
                        'name'  =>  'testimonial_slug'
                        ,'type'  =>  'text'
                        ,'id'    =>  'testimonial_slug'
                        ,'label' =>  'or Slug'
                    )					
            )
        ),
		array(
            'name'      =>  'Recent Blogs',
            'value'     =>  'recent_blogs',
            'options'   =>  array(
                   array(
                        'name'  =>  'recent_blogs_category',
                        'type'  =>  'select',
                        'id'    =>  'recent_blogs_category',
                        'label' =>  'Choose Category',
						'values'=>	getCategories()
						),
                   array(
                        'name'  =>  'recent_blogs_column',
                        'type'  =>  'radio',
                        'id'    =>  'recent_blogs_column',
                        'label' =>  'Columns',
						'default'=>	1,
						'values'=>	array(
										array(
											'value'=>'1',
											'label'=>'1 Column',											
										),array(
											'value'=>'2',
											'label'=>'2 Columns',											
										),array(
											'value'=>'3',
											'label'=>'3 Columns',											
										),array(
											'value'=>'4',
											'label'=>'4 Columns',											
										)
									)					
						),
                   array(
                        'name'  =>  'recent_blogs_count',
                        'type'  =>  'select',
                        'id'    =>  'recent_blogs_count',
                        'label' =>  'Number Items Show',
						'default'=>	'4',
						'values'=>	array(
										array(
											'value'=>'3',
											'label'=>'3',											
										),array(
											'value'=>'4',
											'label'=>'4',											
										)						
							)
						),						
                   array(
                        'name'  =>  'recent_blogs_show_title',
                        'type'  =>  'radio',
                        'id'    =>  'recent_blogs_show_title',
                        'label' =>  'Show Title',
						'default'=>	'yes',
						'values'=>	array(
										array(
											'value'=>'yes',
											'label'=>'Yes',											
										),array(
											'value'=>'no',
											'label'=>'No',											
										)
									)					
						),
                   array(
                        'name'  =>  'recent_blogs_show_thumb',
                        'type'  =>  'radio',
                        'id'    =>  'recent_blogs_show_thumb',
                        'label' =>  'Show Thumbnail',
						'default'=>	'yes',
						'values'=>	array(
										array(
											'value'=>'yes',
											'label'=>'Yes',											
										),array(
											'value'=>'no',
											'label'=>'No',											
										)
									)					
						),
                   array(
                        'name'  =>  'recent_blogs_show_meta',
                        'type'  =>  'radio',
                        'id'    =>  'recent_blogs_show_meta',
                        'label' =>  'Show Meta Datas',
						'default'=>	'yes',
						'values'=>	array(
										array(
											'value'=>'yes',
											'label'=>'Yes',											
										),array(
											'value'=>'no',
											'label'=>'No',											
										)
									)					
						),						
                   array(
                        'name'  =>  'recent_blogs_show_excerpt',
                        'type'  =>  'radio',
                        'id'    =>  'recent_blogs_show_excerpt',
                        'label' =>  'Show Excerpt',
						'default'=>	'yes',
						'values'=>	array(
										array(
											'value'=>'yes',
											'label'=>'Yes',											
										),array(
											'value'=>'no',
											'label'=>'No',											
										)
									)						
						),						
                   array(
                        'name'  =>  'recent_blogs_excerpt_words',
                        'type'  =>  'text',
                        'id'    =>  'recent_blogs_excerpt_words',
                        'label' =>  'Excerpt Words',
						'default'=>	'30'
						)						
            )
        ),			
		// array(
            // 'name'      =>  'Recent Works Sliders',
            // 'value'     =>  'recent_works',
            // 'options'   =>  array(
                   // array(
                        // 'name'  =>  'gallery_id',
                        // 'type'  =>  'select',
                        // 'id'    =>  'gallery_id',
                        // 'label' =>  'Choose Gallery item',
						// 'values'=>	getGalleries()
						// ),
                   // array(
                        // 'name'  =>  'count_items',
                        // 'type'  =>  'text',
                        // 'id'    =>  'count_items',
                        // 'label' =>  'Number items loaded',
						// 'default'=>	'10'
						// ),						
                   // array(
                        // 'name'  =>  'show_items',
                        // 'type'  =>  'text',
                        // 'id'    =>  'show_items',
                        // 'label' =>  'Number Items show',
						// 'default'=>	'4'
						// )
            // )
        // ),	
		array(
            'name'      =>  'Tabs',
            'value'     =>  'tabs',
            'options'   =>  array(
					array(
                        'name'  =>  'style_class_tabs',
                        'type'  =>  'select',
                        'id'    =>  'style_class_tabs',
                        'label' =>  'Style',
						'default'=>	'default',
						'values'=>	array(
							array(
								'value'	=>	'default',
								'label'	=>	'Default'
							),
							array(
								'value'	=>	'left',
								'label'	=>	'Align Left'
							),
							array(
								'value'	=>	'right',
								'label'	=>	'Align Right'
							)
						)
                    ),
					array(
                        'name'  =>  'content_tabs',
                        'type'  =>  'textarea',
                        'id'    =>  'content_tabs',
                        'label' =>  'Content'
                    )
            )
        ),array(
            'name'      =>  'Tab Item',
            'value'     =>  'tab_item',
            'options'   =>  array(
					array(
                        'name'  =>  'title_tab_item',
                        'type'  =>  'text',
                        'id'    =>  'title_tab_item',
                        'label' =>  'Title'
                    ),
					array(
                        'name'  =>  'content_tab_item',
                        'type'  =>  'textarea',
                        'id'    =>  'content_tab_item',
                        'label' =>  'Content'
                    )
            )
        )	
		,array(
            'name'      =>  'HR',
            'value'     =>  'hr',
            'options'   =>  array(
                   array(
                        'name'  =>  'hr_style',
                        'type'  =>  'textarea',
                        'id'    =>  'hr_style',
                        'label' =>  'Enter Style',
						'values'=>	''
						)
            )
        )
		,array(
            'name'      =>  'Hidden Phone Block',
            'value'     =>  'hidden_phone',
            'options'   =>  array(
                   array(
                        'name'  =>  'hidden_phone_content',
                        'type'  =>  'textarea',
                        'id'    =>  'hidden_phone_content',
                        'label' =>  'Enter your blocks',
						'values'=>	''
						)
            )
        )		
		,array(
            'name'      =>  'Shop - Custom Product',
            'value'     =>  'custom_product',
            'options'   =>  array(
					array(
                        'name'  	=>  'custom_product_id'
                        ,'type' 	=>  'text'
                        ,'id'   	=>  'custom_product_id'
                        ,'label'	=>  'Product Id'
                    )
					,array(
                        'name'  	=>  'custom_product_sku'
						,'type'  	=>  'text'
                        ,'id'   	=>  'custom_product_sku'
                        ,'label' 	=>  'Product Sku'
                    )
					,array(
                        'name'  	=>  'custom_product_title'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'custom_product_title'
                        ,'label' 	=>  'Title'
						,'default' 	=> 	"Enter your title"
                    )					

            )
        )
		,array(
            'name'      =>  'Shop - Custom Category',
            'value'     =>  'custom_products_category',
            'options'   =>  array(
					array(
                        'name'  	=>  'custom_products_category_category'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'custom_products_category_category'
                        ,'label'	=>  'Category'
						,'values'	=>	get_prod_cats()					
                    )
					,array(
                        'name'  	=>  'custom_products_category_orderby'
						,'type'  	=>  'select'
                        ,'id'   	=>  'custom_products_category_orderby'
                        ,'label' 	=>  'Orderby'
						,'default'	=>	'date'
						,'values'	=>	array(
							array(
								'value'	=>	'date',
								'label'	=>	'Date'
							),
							array(
								'value'	=>	'title',
								'label'	=>	'Title'
							),
							array(
								'value'	=>	'id',
								'label'	=>	'ID'
							)
						)
                    )
					,array(
                        'name'  	=>  'custom_products_category_order'
                        ,'type'  	=>  'select'
                        ,'id'    	=>  'custom_products_category_order'
                        ,'label' 	=>  'Order'
						,'default'	=>	'desc'
						,'values'	=>	array(
							array(
								'value'	=>	'desc',
								'label'	=>	'Desc'
							)
							,array(
								'value'	=>	'asc',
								'label'	=>	'Asc'
							)
						)						
                    )					

            )
        )	
		,array(
            'name'      =>  'Shop - Featured Products Slider',
            'value'     =>  'featured_product_slider',
            'options'   =>  array(
					array(
                        'name'  	=>  'featured_product_slider_columns'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_columns'
                        ,'label'	=>  'Columns'
						,'values'	=>	array(
							array(
								'value'	=>	'2',
								'label'	=>	'2 Columns'
							)						
							,array(
								'value'	=>	'3',
								'label'	=>	'3 Columns'
							)
							,array(
								'value'	=>	'4',
								'label'	=>	'4 Columns'
							)
							,array(
								'value'	=>	'6',
								'label'	=>	'6 Columns'
							)							
						)					
                    )
					,array(
                        'name'  	=>  'featured_product_slider_layout'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_layout'
                        ,'label'	=>  'Layout'
						,'values'	=>	array(
							array(
								'value'	=>	'small',
								'label'	=>	'Small'
							)
							,array(
								'value'	=>	'big',
								'label'	=>	'Big'
							)
						)					
                    )					
					,array(
                        'name'  	=>  'featured_product_slider_per_page'
                        ,'type' 	=>  'text'
                        ,'id'   	=>  'featured_product_slider_per_page'
                        ,'label'	=>  'Products Number'
						,'default' 	=> 	"8"
                    )
					,array(
                        'name'  	=>  'featured_product_slider_title'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'featured_product_slider_title'
                        ,'label' 	=>  'Title'
						,'default' 	=> 	"Enter your title"
                    )
					,array(
                        'name'  	=>  'featured_product_slider_description'
                        ,'type'  	=>  'textarea'
                        ,'id'    	=>  'featured_product_slider_description'
                        ,'label' 	=>  'Slider description'
                    )		
					,array(
                        'name'  	=>  'featured_product_slider_show_nav'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_show_nav'
                        ,'label'	=>  'Show Nav'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'featured_product_slider_show_icon_nav'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_show_icon_nav'
                        ,'label'	=>  'Show Pagging Nav'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )					
					,array(
                        'name'  	=>  'featured_product_slider_show_image'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_show_image'
                        ,'label'	=>  'Show Image'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'featured_product_slider_show_title'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_show_title'
                        ,'label'	=>  'Show Title'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'featured_product_slider_show_sku'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_show_sku'
                        ,'label'	=>  'Show Sku'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'featured_product_slider_show_price'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_show_price'
                        ,'label'	=>  'Show Price'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'featured_product_slider_show_label'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_show_label'
                        ,'label'	=>  'Show Product Label'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'featured_product_slider_show_rating'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_show_rating'
                        ,'label'	=>  'Show Product rating'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'featured_product_slider_show_categories'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_show_categories'
                        ,'label'	=>  'Show Product Categories'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'featured_product_slider_show_short_content'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'featured_product_slider_show_short_content'
                        ,'label'	=>  'Show Product Short Content'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )	
            )
        )			
		,array(
            'name'      =>  'Shop - Best Selling Products Slider',
            'value'     =>  'best_selling_product_slider',
            'options'   =>  array(
					array(
                        'name'  	=>  'best_selling_product_slider_columns'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_columns'
                        ,'label'	=>  'Columns'
						,'values'	=>	array(
							array(
								'value'	=>	'2',
								'label'	=>	'2 Columns'
							)						
							,array(
								'value'	=>	'3',
								'label'	=>	'3 Columns'
							)
							,array(
								'value'	=>	'4',
								'label'	=>	'4 Columns'
							)
							,array(
								'value'	=>	'6',
								'label'	=>	'6 Columns'
							)							
						)					
                    )
					,array(
                        'name'  	=>  'best_selling_product_slider_layout'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_layout'
                        ,'label'	=>  'Layout'
						,'values'	=>	array(
							array(
								'value'	=>	'small',
								'label'	=>	'Small'
							)
							,array(
								'value'	=>	'big',
								'label'	=>	'Big'
							)
						)					
                    )					
					,array(
                        'name'  	=>  'best_selling_product_slider_per_page'
                        ,'type' 	=>  'text'
                        ,'id'   	=>  'best_selling_product_slider_per_page'
                        ,'label'	=>  'Products Number'
						,'default' 	=> 	"8"
                    )
					,array(
                        'name'  	=>  'best_selling_product_slider_title'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'best_selling_product_slider_title'
                        ,'label' 	=>  'Title'
						,'default' 	=> 	"Enter your title"
                    )
					,array(
                        'name'  	=>  'best_selling_product_slider_description'
                        ,'type'  	=>  'textarea'
                        ,'id'    	=>  'best_selling_product_slider_description'
                        ,'label' 	=>  'Slider description'
                    )		
					,array(
                        'name'  	=>  'best_selling_product_slider_show_nav'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_show_nav'
                        ,'label'	=>  'Show Nav'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'best_selling_product_slider_show_icon_nav'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_show_icon_nav'
                        ,'label'	=>  'Show Pagging Icon'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )						
					,array(
                        'name'  	=>  'best_selling_product_slider_show_image'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_show_image'
                        ,'label'	=>  'Show Image'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'best_selling_product_slider_show_title'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_show_title'
                        ,'label'	=>  'Show Title'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'best_selling_product_slider_show_sku'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_show_sku'
                        ,'label'	=>  'Show Sku'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'best_selling_product_slider_show_price'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_show_price'
                        ,'label'	=>  'Show Price'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'best_selling_product_slider_show_label'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_show_label'
                        ,'label'	=>  'Show Product Label'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'best_selling_product_slider_show_rating'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_show_rating'
                        ,'label'	=>  'Show Product rating'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'best_selling_product_slider_show_categories'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_show_categories'
                        ,'label'	=>  'Show Product Categories'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'best_selling_product_slider_show_short_content'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'best_selling_product_slider_show_short_content'
                        ,'label'	=>  'Show Product Short Content'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )	
            )
        )
		,array(
            'name'      =>  'Shop - Recent Products Slider',
            'value'     =>  'recent_product_slider',
            'options'   =>  array(
					array(
                        'name'  	=>  'recent_product_slider_columns'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_columns'
                        ,'label'	=>  'Columns'
						,'values'	=>	array(
							array(
								'value'	=>	'2',
								'label'	=>	'2 Columns'
							)						
							,array(
								'value'	=>	'3',
								'label'	=>	'3 Columns'
							)
							,array(
								'value'	=>	'4',
								'label'	=>	'4 Columns'
							)
							,array(
								'value'	=>	'6',
								'label'	=>	'6 Columns'
							)							
						)					
                    )
					,array(
                        'name'  	=>  'recent_product_slider_layout'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_layout'
                        ,'label'	=>  'Layout'
						,'values'	=>	array(
							array(
								'value'	=>	'small',
								'label'	=>	'Small'
							)
							,array(
								'value'	=>	'big',
								'label'	=>	'Big'
							)
						)					
                    )					
					,array(
                        'name'  	=>  'recent_product_slider_per_page'
                        ,'type' 	=>  'text'
                        ,'id'   	=>  'recent_product_slider_per_page'
                        ,'label'	=>  'Products Number'
						,'default' 	=> 	"8"
                    )
					,array(
                        'name'  	=>  'recent_product_slider_title'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'recent_product_slider_title'
                        ,'label' 	=>  'Title'
						,'default' 	=> 	"Enter your title"
                    )
					,array(
                        'name'  	=>  'recent_product_slider_description'
                        ,'type'  	=>  'textarea'
                        ,'id'    	=>  'recent_product_slider_description'
                        ,'label' 	=>  'Slider description'
                    )		
					,array(
                        'name'  	=>  'recent_product_slider_show_nav'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_show_nav'
                        ,'label'	=>  'Show Nav'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_slider_show_icon_nav'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_show_icon_nav'
                        ,'label'	=>  'Show Pagging Nav'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )					
					,array(
                        'name'  	=>  'recent_product_slider_show_image'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_show_image'
                        ,'label'	=>  'Show Image'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_slider_show_title'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_show_title'
                        ,'label'	=>  'Show Title'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_slider_show_sku'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_show_sku'
                        ,'label'	=>  'Show Sku'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_slider_show_price'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_show_price'
                        ,'label'	=>  'Show Price'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_slider_show_label'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_show_label'
                        ,'label'	=>  'Show Product Label'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_slider_show_rating'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_show_rating'
                        ,'label'	=>  'Show Product rating'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_slider_show_categories'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_show_categories'
                        ,'label'	=>  'Show Product Categories'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_slider_show_short_content'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_slider_show_short_content'
                        ,'label'	=>  'Show Product Short Content'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )					
            )
        )
		,array(
            'name'      =>  'Shop - Popular Products Slider',
            'value'     =>  'popular_product_slider',
            'options'   =>  array(
					array(
                        'name'  	=>  'popular_product_slider_columns'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_columns'
                        ,'label'	=>  'Columns'
						,'values'	=>	array(
							array(
								'value'	=>	'2',
								'label'	=>	'2 Columns'
							)						
							,array(
								'value'	=>	'3',
								'label'	=>	'3 Columns'
							)
							,array(
								'value'	=>	'4',
								'label'	=>	'4 Columns'
							)
							,array(
								'value'	=>	'6',
								'label'	=>	'6 Columns'
							)							
						)					
                    )
					,array(
                        'name'  	=>  'popular_product_slider_layout'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_layout'
                        ,'label'	=>  'Layout'
						,'values'	=>	array(
							array(
								'value'	=>	'small',
								'label'	=>	'Small'
							)
							,array(
								'value'	=>	'big',
								'label'	=>	'Big'
							)
						)					
                    )					
					,array(
                        'name'  	=>  'popular_product_slider_per_page'
                        ,'type' 	=>  'text'
                        ,'id'   	=>  'popular_product_slider_per_page'
                        ,'label'	=>  'Products Number'
						,'default' 	=> 	"8"
                    )
					,array(
                        'name'  	=>  'popular_product_slider_title'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'popular_product_slider_title'
                        ,'label' 	=>  'Title'
						,'default' 	=> 	"Enter your title"
                    )
					,array(
                        'name'  	=>  'popular_product_slider_description'
                        ,'type'  	=>  'textarea'
                        ,'id'    	=>  'popular_product_slider_description'
                        ,'label' 	=>  'Slider description'
                    )		
					,array(
                        'name'  	=>  'popular_product_slider_show_nav'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_show_nav'
                        ,'label'	=>  'Show Nav'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'popular_product_slider_show_icon_nav'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_show_icon_nav'
                        ,'label'	=>  'Show Pagging Nav'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )						
					,array(
                        'name'  	=>  'popular_product_slider_show_image'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_show_image'
                        ,'label'	=>  'Show Image'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'popular_product_slider_show_title'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_show_title'
                        ,'label'	=>  'Show Title'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'popular_product_slider_show_sku'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_show_sku'
                        ,'label'	=>  'Show Sku'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'popular_product_slider_show_price'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_show_price'
                        ,'label'	=>  'Show Price'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'popular_product_slider_show_label'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_show_label'
                        ,'label'	=>  'Show Product Label'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'popular_product_slider_show_rating'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_show_rating'
                        ,'label'	=>  'Show Product rating'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'popular_product_slider_show_categories'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_show_categories'
                        ,'label'	=>  'Show Product Categories'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'popular_product_slider_show_short_content'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'popular_product_slider_show_short_content'
                        ,'label'	=>  'Show Product Short Content'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )		
            )
        )
		,array(
            'name'      =>  'Shop - Recent Products By Categories Slider',
            'value'     =>  'recent_product_by_categories_slider',
            'options'   =>  array(
					array(
                        'name'  	=>  'recent_product_by_categories_slider_columns'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_columns'
                        ,'label'	=>  'Columns'
						,'values'	=>	array(
							array(
								'value'	=>	'2',
								'label'	=>	'2 Columns'
							)						
							,array(
								'value'	=>	'3',
								'label'	=>	'3 Columns'
							)
							,array(
								'value'	=>	'4',
								'label'	=>	'4 Columns'
							)
							,array(
								'value'	=>	'6',
								'label'	=>	'6 Columns'
							)							
						)					
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_layout'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_layout'
                        ,'label'	=>  'Layout'
						,'values'	=>	array(
							array(
								'value'	=>	'small',
								'label'	=>	'Small'
							)
							,array(
								'value'	=>	'big',
								'label'	=>	'Big'
							)
						)					
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_cat_slug'
                        ,'type' 	=>  'text'
                        ,'id'   	=>  'recent_product_by_categories_slider_cat_slug'
                        ,'label'	=>  'Categories Slug'
						,'default' 	=> 	""
                    )	
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_per_page'
                        ,'type' 	=>  'text'
                        ,'id'   	=>  'recent_product_by_categories_slider_per_page'
                        ,'label'	=>  'Products Number'
						,'default' 	=> 	"8"
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_title'
                        ,'type'  	=>  'text'
                        ,'id'    	=>  'recent_product_by_categories_slider_title'
                        ,'label' 	=>  'Title'
						,'default' 	=> 	"Enter your title"
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_description'
                        ,'type'  	=>  'textarea'
                        ,'id'    	=>  'recent_product_by_categories_slider_description'
                        ,'label' 	=>  'Slider description'
                    )		
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_show_nav'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_show_nav'
                        ,'label'	=>  'Show Nav'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_show_icon_nav'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_show_icon_nav'
                        ,'label'	=>  'Show Pagging Nav'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )					
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_show_image'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_show_image'
                        ,'label'	=>  'Show Image'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_show_title'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_show_title'
                        ,'label'	=>  'Show Title'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_show_sku'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_show_sku'
                        ,'label'	=>  'Show Sku'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_show_price'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_show_price'
                        ,'label'	=>  'Show Price'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_show_label'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_show_label'
                        ,'label'	=>  'Show Product Label'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_show_rating'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_show_rating'
                        ,'label'	=>  'Show Product rating'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_show_categories'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_show_categories'
                        ,'label'	=>  'Show Product Categories'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
					,array(
                        'name'  	=>  'recent_product_by_categories_slider_show_short_content'
                        ,'type' 	=>  'select'
                        ,'id'   	=>  'recent_product_by_categories_slider_show_short_content'
                        ,'label'	=>  'Show Product Short Content'
						,'default'	=>	1
						,'values'	=>	array(
							array(
								'value'	=>	'0',
								'label'	=>	'No'
							)
							,array(
								'value'	=>	'1',
								'label'	=>	'Yes'
							)
						)				
                    )
							
            )
        )
		,array(
            'name'      =>  'Portfolio',
            'value'     =>  'portfolio',
            'options'   =>  array(
                    array(
                        'name'  =>  'portfolio_id',
                        'type'  =>  'text',
                        'id'    =>  'portfolio_id',
                        'label' =>  'ID(priority)',
                        'default'=> ''
                    )
                    ,array(
                        'name'  =>  'portfolio_slug'
                        ,'type'  =>  'text'
                        ,'id'    =>  'portfolio_slug'
                        ,'label' =>  'or Slug'
                    )					
            )
        ),	
    );
	
	uasort($shortcode_array, 'sort_shortcode_array');
	return $shortcode_array;
}

function get_areas_array(){
	$area_string = get_option(THEME_SLUG.'areas');
	$result = array();
	if($area_string){
		$area_array = json_decode($area_string);
		foreach($area_array as $area){
			$option = array();
			$option['value'] = friendlyURL($area);
			$option['label'] = $area;
			$result[] = $option;
		}
	}
	return $result;
}

function get_pages_value(){
	$pages = get_pages(array('parent'=>0));
	$result = array();
	if(count($pages)){
		foreach($pages as $page){
			$option = array();
			$option['value'] = $page->ID;
			$option['label'] = get_the_title($page->ID);
			$result[] = $option;
		}
	}
	return $result;
}
function getCategories(){
	$data = array(
		array(
			'value'	=>	'',
			'label'	=>	'All Categories'
		)
	);
	$categoris = get_categories();
	foreach($categoris as $category){
		$data[] = array(
			//'value'	=>	$category->term_id,
			'value'	=>	$category->slug,
			'label'	=>	$category->name
		);
	}
	return $data;
}

function getGalleries(){
	$data = array(
		array(
			'value'	=>	'',
			'label'	=>	'All Galleries'
		)
	);
	$terms = get_terms('gallery');
	foreach($terms as $term){
		$data[] = array(
			'value'	=>	$term->slug,
			'label'	=>	$term->name
		);
	}
	return $data;
}
function get_prod_cats(){
	$data = array();
	$terms = get_terms('product_cat');
	foreach($terms as $term){
		$data[] = array(
			'value'	=>	$term->slug,
			'label'	=>	$term->name
		);
	}
	return $data;
}

function getServices(){

	$items = get_posts( array (
		'post_type'	=> 'service',
		'posts_per_page' => -1
	));
	
	$data = array(
		array(
			'value'	=>	'',
			'label'	=>	'Choose one item'
		)
	);
	foreach($items as $item){
		$data[] = array(
			'value'	=>	$item->ID,
			'label'	=>	$item->post_title
		);
	}
	return $data;
}
function getAbout(){

	$items = get_posts( array (
		'post_type'	=> 'aboutus',
		'posts_per_page' => -1
	));
	
	$data = array(
		array(
			'value'	=>	'',
			'label'	=>	'Choose one item'
		)
	);
	foreach($items as $item){
		$data[] = array(
			'value'	=>	$item->ID,
			'label'	=>	$item->post_title
		);
	}
	return $data;
}
function gettestimonial(){

	$items = get_posts( array (
		'post_type'	=> 'testimonials',
		'posts_per_page' => -1
	));
	
	$data = array(
		array(
			'value'	=>	'',
			'label'	=>	'Choose one item'
		)
	);
	foreach($items as $item){
		$data[] = array(
			'value'	=>	$item->ID,
			'label'	=>	$item->post_title
		);
	}
	return $data;
}

?>