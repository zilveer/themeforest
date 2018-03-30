<?php

add_action( 'admin_init', 'ut_metabox_hero_settings' );

function ut_metabox_hero_settings() {
  
    $globaL_defaults = ( UT_THEME_VERSION >= '4.0.3' ) ? 'on' : 'off';
  
    $ut_metabox_hero_settings = array(
        'id'          => 'ut_metabox_hero_settings',
        'title'       => 'Hero Settings',
        'desc'        => '',
        'pages'       => array( 'page' , 'portfolio' , 'product' ),
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
        
    	/*
	    |--------------------------------------------------------------------------
	    | Hero Type
	    |--------------------------------------------------------------------------
	    */
        
        array(
            'id'          	=> 'ut-hero-settings',
            'metapanel'     => 'ut-hero-type',
            'label'       	=> 'Hero Type',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Hero Settings</h2>',
            'section_class'	=> 'ut-settings-heading',        
            'class'       	=> ''
        ),
        
        array(
            'id'          => 'ut_page_type',
            'label'       => '',
            'desc'		  => '',
            'type'        => 'radio_group_button',
            'choices'     => array(
              
              array(
                'label'       => 'Use Page as Regular Page',
                'for'         => array(''),
                'value'       => 'page'
              ),
              array(
                'label'       => 'Use Page as Section',
                'for'         => array(''),
                'value'       => 'section'
              ),
                            
            ),
            'std'         	=> 'page',
            'rows'        	=> '',
            'class'       	=> '',
            'section_class' => ''
        ),
        
        array(
            'id'          => 'ut_activate_page_hero',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Activate Hero',
            'type'        => 'radio_group_button',
            'desc'        => '',
            'choices'     => array(
              array(
                'label'       => 'On',
                'for'         => array(),
                'value'       => 'on',
                'class'       => 'ut-on'
              ),
              array(
                'label'       => 'Off',
                'for'         => array(),
                'value'       => 'off',
                'class'       => 'ut-off'
              )
            ),
            'std'         	=> 'off',
            'rows'        	=> '',
            'class'       	=> '',
            'section_class' => ''
        ),
        
        array(
            'id'          => 'ut_page_hero_type',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Choose Hero Type',
            'type'        => 'select_group',
            'std'         => ot_get_option('ut_global_hero_header_type'),
            'toplevel'    => true,
            'desc'		  => 'Choose between 9 different types.',
            'choices'     => array( 
              
                array(
                    'value'       => 'image',
                    'for'         => array( 
                        'ut_page_hero_image',
                        'ut_page_hero_parallax',
                        'ut_page_hero_rain_effect',
                        'ut_page_hero_rain_sound',
                        'ut_page_hero_style',
                        'ut_portfolio_hero_style',
                        'ut_page_hero_font_style',
                        'ut_page_hero_font_size',
                        'ut_page_hero_align',
                        'ut_portfolio_caption_align',
                        'ut_page_hero_overlay',
                        'ut_page_hero_overlay_color',
                        'ut_page_hero_overlay_color_opacity',
                        'ut_page_hero_overlay_pattern',
                        'ut_page_hero_overlay_pattern_style',
                        'ut_page_main_hero_button_style',
                        'ut_page_second_button_style'
                    ),
                    'label'       => 'Single Background Image',
                    'alt_label'   => 'Single Image'
                ),
                
                array(
                    'value'       => 'animatedimage',
                    'for'         => array(
                        'ut_page_hero_animated_image',
                        'ut_page_hero_style',
                        'ut_portfolio_hero_style',
                        'ut_page_hero_font_style',
                        'ut_page_hero_font_size',
                        'ut_page_hero_align',
                        'ut_portfolio_caption_align',
                        'ut_page_hero_overlay',
                        'ut_page_hero_overlay_color',
                        'ut_page_hero_overlay_color_opacity',
                        'ut_page_hero_overlay_pattern',
                        'ut_page_hero_overlay_pattern_style',
                        'ut_page_main_hero_button_style',
                        'ut_page_second_button_style'                                    
                    ),
                    'label'       => 'Animated Single Background Image'
                ),
                
                array(
                    'value'       => 'splithero',
                    'for'         => array( 
                        'ut_page_hero_image',
                        'ut_page_hero_parallax',
                        'ut_page_hero_rain_effect',
                        'ut_page_hero_rain_sound',
                        'ut_page_hero_split_content_type',
                        'ut_page_hero_split_image',
                        'ut_page_hero_split_image_max_width',
                        'ut_page_hero_split_image_effect',
                        'ut_page_hero_split_video',
                        'ut_page_hero_split_video_box',
                        'ut_page_hero_split_video_box_style',
                        'ut_page_hero_split_video_box_padding',
                        'ut_page_hero_style',
                        'ut_portfolio_hero_style',
                        'ut_page_hero_font_style',
                        'ut_page_hero_font_size',
                        'ut_page_hero_align',
                        'ut_portfolio_caption_align',
                        'ut_page_hero_overlay',
                        'ut_page_hero_overlay_color',
                        'ut_page_hero_overlay_color_opacity',
                        'ut_page_hero_overlay_pattern',
                        'ut_page_hero_overlay_pattern_style',
                        'ut_page_main_hero_button_style',
                        'ut_page_second_button_style'                                    
                    ),
                    'label'       => 'Split Hero'
                ),
                
                array(
                    'value'       => 'slider',
                    'for'         => array( 
                        'ut_page_hero_slider',
                        'ut_page_hero_slider_animation_speed',
                        'ut_page_hero_slider_slideshow_speed',
                        'ut_page_hero_font_size',
                        'ut_page_hero_overlay',
                        'ut_page_hero_overlay_color',
                        'ut_page_hero_overlay_color_opacity',
                        'ut_page_hero_overlay_pattern',
                        'ut_page_hero_overlay_pattern_style',
                        'ut_page_hero_slider_color_settings_headline',
                        'ut_page_hero_slider_arrow_background_color',
                        'ut_page_hero_slider_arrow_background_color_hover',
                        'ut_page_hero_slider_arrow_color',
                        'ut_page_hero_slider_arrow_color_hover',
                        'ut_page_main_hero_button_style'
                    ),
                    'label'       => 'Background Image Slider',
                    'alt_label'   => 'Gallery'
                ),
              
                array(
                    'value'       => 'transition',
                    'for'         => array(
                        'ut_page_hero_fancy_slider',
                        'ut_page_hero_fancy_slider_effect',
                        'ut_page_hero_fancy_slider_height',
                        'ut_page_main_hero_button_style'
                    ),
                    'label'       => 'Fancy Image Slider'
                ),
                
                array(
                    'value'       => 'tabs',
                    'for'         => array(
                        'ut_page_hero_image',
                        'ut_page_hero_parallax',
                        'ut_page_hero_tabs_headline',
                        'ut_page_hero_tabs_headline_style',
                        'ut_page_hero_tabs',
                        'ut_page_hero_tabs_tablet_color',
                        'ut_page_hero_tabs_tablet_shadow',
                        'ut_page_hero_style',
                        'ut_portfolio_hero_style',
                        'ut_page_hero_font_style',
                        'ut_page_hero_font_size',
                        'ut_page_hero_align',
                        'ut_portfolio_caption_align',
                        'ut_page_hero_overlay',
                        'ut_page_hero_overlay_color',
                        'ut_page_hero_overlay_color_opacity',
                        'ut_page_hero_overlay_pattern',
                        'ut_page_hero_overlay_pattern_style',
                        'ut_page_main_hero_button_style',
                        'ut_page_second_button_style'                                    
                    ),
                    'label'       => 'Tablet Slider'
                ),
                
                array(
                    'value'       => 'video',
                    'for'         => array(
                        'ut_page_hero_style',
                        'ut_page_video_volume',
                        'ut_page_video_mute_button',
                        'ut_page_video_sound',
                        'ut_page_video_poster',
                        'ut_page_video_webm',
                        'ut_page_video_ogg',
                        'ut_page_video_mp4',
                        'ut_page_video',
                        'ut_page_video_custom',
                        'ut_page_video_source',
                        'ut_page_hero_style',
                        'ut_portfolio_hero_style',
                        'ut_page_hero_font_style',
                        'ut_page_hero_font_size',
                        'ut_page_hero_align',
                        'ut_portfolio_caption_align',
                        'ut_page_hero_overlay',
                        'ut_page_hero_overlay_color',
                        'ut_page_hero_overlay_color_opacity',
                        'ut_page_hero_overlay_pattern',
                        'ut_page_hero_overlay_pattern_style',
                        'ut_page_main_hero_button_style',
                        'ut_page_second_button_style'                                    
                    ),
                    'label'       => 'Video',
                    'alt_label'   => 'Video'
                ),
                
                array(
                    'value'       => 'custom',
                    'for'         => array('ut_page_hero_custom_shortcode'),
                    'label'       => 'Custom Shortcode (e.g. Slider Shortcode)'
                ),
                
                array(
                    'value'       => 'dynamic',
                    'for'         => array(
                        'ut_page_hero_image',
                        'ut_page_hero_parallax',
                        'ut_page_hero_style',
                        'ut_portfolio_hero_style',
                        'ut_page_hero_font_style',
                        'ut_page_hero_font_size',
                        'ut_page_hero_align',
                        'ut_portfolio_caption_align',
                        'ut_page_hero_overlay',
                        'ut_page_hero_overlay_color',
                        'ut_page_hero_overlay_color_opacity',
                        'ut_page_hero_overlay_pattern',
                        'ut_page_hero_overlay_pattern_style',
                        'ut_page_main_hero_button_style',
                        'ut_page_second_button_style',
                        'ut_page_hero_dynamic_height',
                        'ut_page_hero_dynamic_content_v_align',
                        'ut_page_hero_dynamic_content_margin_bottom'
                    ),
                    'label'       => 'Dynamic Hero (dynamic height)'
                )
                
            ), /* end choices */
            
        ),
        
        /*
        | Image Tab Slider
        */
        
        array(
          'id'          => 'ut_page_hero_tabs_headline',
          'metapanel'   => 'ut-hero-type',
          'label'       => 'Tablet Headline',
          'desc'        => 'This headline will be displayed above the tablet navigation.',
          'type'        => 'text',
        ),
        
        array(
          'id'          => 'ut_page_hero_tabs_headline_style',
          'metapanel'   => 'ut-hero-type',
          'label'       => 'Tablet Headline Font Style',
          'desc'		=> 'Choose a font style for Tablet Headline. Choose "Default" if you like to use the global styling from the Theme Options Panel.',
          'type'        => 'select',
          'std'		    => 'global',
          'choices'     => array( 
            array(
              'value'       => 'global',
              'label'       => 'Default'
            ),
            array(
              'value'       => 'extralight',
              'label'       => 'Extra Light'
            ),
            array(
              'value'       => 'light',
              'label'       => 'Light'
            ),
            array(
              'value'       => 'regular',
              'label'       => 'Regular'
            ),
            array(
              'value'       => 'medium',
              'label'       => 'Medium'
            ),
            array(
              'value'       => 'semibold',
              'label'       => 'Semi Bold'
            ),
            array(
              'value'       => 'bold',
              'label'       => 'Bold'
            )
          ),
        ),	  
        
        
        array(
            'id'          => 'ut_page_hero_tabs_tablet_color',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Tablet Color',
            'desc'        => '',
            'type'        => 'select',
            'std'         => 'black',
            'choices'     => array( 
              array(
                'value'       => 'black',
                'label'       => 'Black'
              ),
              array(
                'value'       => 'white',
                'label'       => 'White'
              ),
            ),
        ), 
          
        array(
            'id'          => 'ut_page_hero_tabs_tablet_shadow',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Tablet Shadow',
            'desc'        => '',
            'type'        => 'select',
            'std'         => 'off',
            'choices'     => array( 
              array(
                'value'       => 'on',
                'label'       => 'On'
              ),
              array(
                'value'       => 'off',
                'label'       => 'Off'
              ),
            ),
        ),     
               
        
        array(
            'id'          => 'ut_page_hero_tabs',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Manage Tablet Images',
            'type'        => 'list-item',
            'settings'    => array( 
              
              array(
                'id'          => 'image',
                'label'       => 'Image',
                'type'        => 'upload',
              ),
                     
              array(
                'id'          => 'description',
                'label'       => 'Image Description',
                'type'        => 'textarea-simple',
                'rows'        => '3'
              ),
              
              array(
                'id'          => 'link_one_url',
                'label'       => 'Left Button URL',
                'type'        => 'text'
              ),
              
              array(
                'id'          => 'link_one_text',
                'label'       => 'Left Button Text',
                'type'        => 'text'
              ),
              
                array(
                'id'          => 'link_two_url',
                'label'       => 'Right Button URL',
                'type'        => 'text'
              ),
              
              array(
                'id'          => 'link_two_text',
                'label'       => 'Right Button Text',
                'type'        => 'text'
              )
              
            )
          ),
        
        /*
	    | Image Type
	    */
        
        array(
            'id'          => 'ut_page_hero_image',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Background Image',
            'desc'        => 'For best image results, we recommend to upload an image with minimum size of 1600x900 pixel or maximum size of 1920x1080 (optimal size) pixel. Also try to avoid uploading images with more than 200-300Kb size. Keep in mind, that you are not able to set a background position or attachment if the parallax option has been set to "on".',
            'type'        => 'background',
        ),
        
        array(
            'id'          => 'ut_page_hero_parallax',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Activate Parallax',
            'desc'        => 'Keep in mind, activating this option can reduce your website performance.',
            'type'        => 'select',
            'choices'     => array( 
              array(
                'value'       => 'on',
                'label'       => 'On'
              ),
              array(
                'value'       => 'off',
                'label'       => 'Off'
              )
            ),
        ),
        
        array(
          'id'          => 'ut_page_hero_rain_effect',
          'metapanel'   => 'ut-hero-type',
          'label'       => 'Activate Rain Effect',
          'type'        => 'select_group',
          'std'		    => 'off',
          'desc'        => 'Keep in mind, activating this option can reduce your website performance.',
          'choices'     => array( 
            array(
              'value'       => 'on',
              'for'         => array('ut_page_hero_rain_sound'),
              'label'       => 'On'
            ),
            array(
              'value'       => 'off',
              'for'         => array(),
              'label'       => 'Off'
            )
          ),
        ),
          
        array(
          'id'          => 'ut_page_hero_rain_sound',
          'metapanel'   => 'ut-hero-type',
          'label'       => 'Activate Rain Sound',
          'type'        => 'select',
          'std'		  => 'off',
          'choices'     => array( 
            array(
              'value'       => 'on',
              'label'       => 'On'
            ),
            array(
              'value'       => 'off',
              'label'       => 'Off'
            )
          ),
        ),
        
        array(
            'id'          => 'ut_page_hero_split_content_type',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Hero Split Content Type',
            'desc'        => '',
            'type'        => 'select_group',
            'choices'     => array( 
              array(
                'value'       => 'image',
                'for'         => array('ut_page_hero_split_image','ut_page_hero_split_image_max_width','ut_page_hero_split_image_effect'),
                'label'       => 'Image'
              ),
              array(
                'value'       => 'video',
                'for'         => array('ut_page_hero_split_video','ut_page_hero_split_video_box','ut_page_hero_split_video_box_style','ut_page_hero_split_video_box_padding'),
                'label'       => 'Video'
              )
            ),
        ),
          
        array(
            'id'          => 'ut_page_hero_split_video',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Hero Split Video',
            'desc'        => 'This video will display on the right side of the hero caption. It will not display on mobile devices! Please use the only embed codes from youtube or vimeo.',
            'type'        => 'textarea_simple',
        ),
        
        array(
            'id'          => 'ut_page_hero_split_video_box',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Activate Hero Split Video Box',
            'desc'        => 'Display a shadowed box around the video.',
            'type'        => 'select_group',
            'choices'     => array( 
              array(
                'value'       => 'on',
                'for'         => array('ut_page_hero_split_video_box_style','ut_page_hero_split_video_box_padding'),
                'label'       => 'yes, please!'
              ),
              array(
                'value'       => 'off',
                'for'         => array(),
                'label'       => 'no, thanks!'
              )
            ),
            
        ),
        
        array(
            'id'          => 'ut_page_hero_split_video_box_style',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Hero Split Video Box Style',
            'desc'        => '',
            'type'        => 'select',
            'choices'     => array( 
              array(
                'value'       => 'light',
                'label'       => 'Light'
              ),
              array(
                'value'       => 'dark',
                'label'       => 'Dark'
              )
            ),
        ),
        
        array(
            'id'          => 'ut_page_hero_split_video_box_padding',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Hero Split Video Box Padding',
            'desc'        => 'Set padding of the box in pixel e.g. 20px. default: 20px',
            'type'        => 'text',
        ),
        
        array(
          'id'          => 'ut_page_hero_split_image',
          'metapanel'   => 'ut-hero-type',
          'label'       => 'Hero Split Image',
          'desc'        => 'This image will display on the right side of the Hero Caption. It will not display on mobile devices!',
          'type'        => 'upload',
        ),
        
        array(
          'id'          => 'ut_page_hero_split_image_effect',
          'metapanel'   => 'ut-hero-type',
          'label'       => 'Hero Split Image Animation Effect',
          'desc'		=> 'Choose animation effect for Hero Split Image.',
          'type'        => 'select',
          'std'		    => 'none',
          'choices'     => array( 
            array(
              'value'       => 'none',
              'label'       => 'No effect'
            ),
            array(
              'value'       => 'fadeIn',
              'label'       => 'Fade In'
            ),
            array(
              'value'       => 'slideInRight',
              'label'       => 'Slide in Right'
            ),
            array(
              'value'       => 'slideInLeft',
              'label'       => 'Slide in Left'
            ),
           
            
          ),
        ),	
          
        array(
          'id'          => 'ut_page_hero_split_image_max_width',
          'metapanel'   => 'ut-hero-type',
          'label'       => 'Hero Split Image Max Width',
          'desc'        => 'Adjust this value until the Hero Split Image fits inside the Hero. Default "60".',
          'type'        => 'numeric-slider',
          'std'         => '60',
          'min_max_step'=> '0,100,1'
        ),  
          
        /*
        | Animated Image Type
        */
        array(
          'id'          => 'ut_page_hero_animated_image',
          'metapanel'   => 'ut-hero-type',
          'label'       => 'Animated Background Image',
          'desc'        => 'For best image results, we recommend to upload an image with minimum size of 1600x900 pixel or maximum size of 1920x1080(optimal) pixel. Also try to avoid uploading images with more than 200-300Kb size.',
          'type'        => 'upload',
        ),
          
        /*
        | Slider Type
        */
        array(
            'id'          => 'ut_page_hero_slider_animation_speed',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Animation Speed',
            'desc'        => 'Set speed of animations, in milliseconds.',
            'type'        => 'text',
        ),
        array(
            'id'          => 'ut_page_hero_slider_slideshow_speed',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Slideshow Speed',
            'desc'        => 'Set speed of the slideshow cycling, in milliseconds.',
            'type'        => 'text',
        ),
        array(
            'id'          => 'ut_page_hero_slider',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Slider',
            'type'        => 'list-item',
            'settings'    => array( 
              array(
                'id'          => 'image',
                'label'       => 'Image',
                'desc'        => 'For best image results, we recommend to upload an image with minimum size of 1600x900 pixel or maximum size of 1920x1080(optimal) pixel. Also try to avoid uploading images with more than 200-300Kb size.',
                'type'        => 'upload',
              ),
              array(
                'id'          => 'style',
                'label'       => 'Hero Caption Style',
                'type'        => 'select',
                'choices'     => array( 
                    array(
                      'value'       => 'ut-hero-style-1',
                      'label'       => 'Style One'
                    ),
                    array(
                      'value'       => 'ut-hero-style-2',
                      'label'       => 'Style Two'
                    ),
                    array(
                      'value'       => 'ut-hero-style-3',
                      'label'       => 'Style Three'
                    ),
                    array(
                      'value'       => 'ut-hero-style-4',
                      'label'       => 'Style Four'
                    ),
                    array(
                      'value'       => 'ut-hero-style-5',
                      'label'       => 'Style Five'
                    ),
                    array(
                      'value'       => 'ut-hero-style-6',
                      'label'       => 'Style Six'
                    ),
                    array(
                      'value'       => 'ut-hero-style-7',
                      'label'       => 'Style Seven'
                    ),
                    array(
                      'value'       => 'ut-hero-style-8',
                      'label'       => 'Style Eight'
                    ),
                    array(
                      'value'       => 'ut-hero-style-9',
                      'label'       => 'Style Nine'
                    ),
                    array(
                      'value'       => 'ut-hero-style-10',
                      'label'       => 'Style Ten'
                    ),
                    array(
                      'value'       => 'ut-hero-style-11',
                      'label'       => 'Style Eleven'
                    )
                ),
              ),
              
              array(
                'id'          => 'font_style',
                'label'       => 'Hero Caption Font Style',
                'desc'		  => 'Setting this option to default will load the hero font style ( which has been set under Front Page Settings -> Hero Settings).',
                'type'        => 'select',
                'std'		  => 'global',
                'choices'     => array( 
                  array(
                    'value'       => 'global',
                    'label'       => 'Default'
                  ),
                  array(
                    'value'       => 'extralight',
                    'label'       => 'Extra Light'
                  ),
                  array(
                    'value'       => 'light',
                    'label'       => 'Light'
                  ),
                  array(
                    'value'       => 'regular',
                    'label'       => 'Regular'
                  ),
                  array(
                    'value'       => 'medium',
                    'label'       => 'Medium'
                  ),
                  array(
                    'value'       => 'semibold',
                    'label'       => 'Semi Bold'
                  ),
                  array(
                    'value'       => 'bold',
                    'label'       => 'Bold'
                  )
                ),
              ),
              
              array(
                'id'          => 'align',
                'label'       => 'Caption Alignment',
                'type'        => 'select',
                'desc'		  => '',
                'std'		  => 'center',
                'choices'     => array(     
                  array(
                    'value'       => 'center',
                    'label'       => 'Center'
                  ),
                  array(
                    'value'       => 'left',
                    'label'       => 'Left'
                  ),
                  array(
                    'value'       => 'right',
                    'label'       => 'Right'
                  )
                ),
              ),
              array(
                'id'          => 'direction',
                'label'       => 'Caption Animation Direction',
                'std'		  => 'top',
                'type'        => 'select',
                'choices'     => array( 
                      
                      array(
                        'value'       => 'top',
                        'label'       => 'Top'
                      ),
                      array(
                        'value'       => 'left',
                        'label'       => 'Left'
                      ),
                      array(
                        'value'       => 'right',
                        'label'       => 'Right'
                      ),
                      array(
                        'value'       => 'bottom',
                        'label'       => 'Bottom'
                      )
                     
                ),
              ),
              array(
                'id'          => 'expertise',
                'label'       => 'Hero Caption Slogan',
                'type'        => 'textarea-simple',
                'rows'        => '3'
              ),
              array(
                'id'          => 'description',
                'label'       => 'Hero Caption',
                'type'        => 'textarea-simple',
                'rows'        => '3'
              ),
              array(
                'id'          => 'catchphrase',
                'label'       => 'Hero Caption Description',
                'type'        => 'textarea-simple',
                'rows'        => '3'
              ),
              array(
                'id'          => 'link',
                'label'       => 'Link',
                'type'        => 'text',
                'rows'        => '3'
              ),
              array(
                'id'          => 'link_description',
                'label'       => 'Link Button Text',
                'type'        => 'text'
              )
            )
        ),	
        
        
        array(
            'id'          	=> 'ut_page_hero_slider_color_settings_headline',
            'metapanel'     => 'ut-hero-type',
            'label'       	=> 'Slider Navigation Color Settings',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Slider Navigation Color Settings</h2>',
            'section_class' => 'ut-settings-heading alt'
        ),
        array(
            'id'            => 'ut_page_hero_slider_arrow_background_color',
            'metapanel'     => 'ut-hero-type',        
            'label'         => 'Arrow Background Color',
            'type'          => 'colorpicker',
            'mode'          => 'rgb',
        ),
        array(
            'id'            => 'ut_page_hero_slider_arrow_background_color_hover',
            'metapanel'     => 'ut-hero-type',        
            'label'         => 'Arrow Background Color Hover',
            'type'          => 'colorpicker',
            'mode'          => 'rgb',
        ),
        array(
            'id'            => 'ut_page_hero_slider_arrow_color',
            'metapanel'     => 'ut-hero-type',        
            'label'         => 'Arrow Color',
            'type'          => 'colorpicker',
            'mode'          => 'rgb',
        ),
        array(
            'id'            => 'ut_page_hero_slider_arrow_color_hover',
            'metapanel'     => 'ut-hero-type',        
            'label'         => 'Arrow Color Hover',
            'type'          => 'colorpicker',
            'mode'          => 'rgb',
        ),
          
          
        /*
        | Fancy Slider
        */
          
        array(
            'id'          => 'ut_page_hero_fancy_slider_height',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Slider Height',
            'desc'        => 'Set height of the slideshow in pixel e.g. 600px.',
            'type'        => 'text',
        ),
          
          array(
            'id'          => 'ut_page_hero_fancy_slider_effect',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Slide Effect',
            'desc'		  => 'Choose an effect for your slider, this effect will affect all slides.',
            'type'        => 'select',
            'std'		  => 'fxSoftScale',
            'choices'     => array( 
              array(
                'value'       => 'fxSoftScale',
                'label'       => 'Soft scale'
              ),
              array(
                'value'       => 'fxPressAway',
                'label'       => 'Press away'
              ),
              array(
                'value'       => 'fxSideSwing',
                'label'       => 'Side Swing'
              ),
              array(
                'value'       => 'fxFortuneWheel',
                'label'       => 'Fortune wheel'
              ),
              array(
                'value'       => 'fxSwipe',
                'label'       => 'Swipe'
              ),
              array(
                'value'       => 'fxPushReveal',
                'label'       => 'Push reveal'
              ),
              array(
                'value'       => 'fxSnapIn',
                'label'       => 'Snap in'
              ),
              array(
                'value'       => 'fxLetMeIn',
                'label'       => 'Let me in'
              ),
              array(
                'value'       => 'fxStickIt',
                'label'       => 'Stick it'
              ),
              array(
                'value'       => 'fxArchiveMe',
                'label'       => 'Archive me'
              ),
              array(
                'value'       => 'fxVGrowth',
                'label'       => 'Vertical growth'
              ),
              array(
                'value'       => 'fxSlideBehind',
                'label'       => 'Slide Behind'
              ),
              array(
                'value'       => 'fxSoftPulse',
                'label'       => 'Soft Pulse'
              ),
              array(
                'value'       => 'fxEarthquake',
                'label'       => 'Earthquake'
              ),
              array(
                'value'       => 'fxCliffDiving',
                'label'       => 'Cliff diving'
              )
              
            ),
          ),	
          
          array(
            'id'          => 'ut_page_hero_fancy_slider',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Fancy Slider',
            'type'        => 'list-item',
            'settings'    => array( 
              array(
                'id'          => 'image',
                'label'       => 'Image',
                'desc'        => 'For best image results, we recommend to upload an image with minimum size of 1600 x (set height) pixel or maximum size of 1920x (set height) (optimal) pixel. Also try to avoid uploading images with more than 200-300Kb size.',
                'type'        => 'upload',
              ),
              array(
                'id'          => 'style',
                'label'       => 'Hero Caption Style',
                'type'        => 'select',
                'choices'     => array( 
                       array(
                        'value'       => 'ut-hero-style-1',
                        'label'       => 'Style One'
                      ),
                      array(
                        'value'       => 'ut-hero-style-2',
                        'label'       => 'Style Two'
                      ),
                      array(
                        'value'       => 'ut-hero-style-3',
                        'label'       => 'Style Three'
                      ),
                      array(
                        'value'       => 'ut-hero-style-4',
                        'label'       => 'Style Four'
                      ),
                      array(
                        'value'       => 'ut-hero-style-5',
                        'label'       => 'Style Five'
                      ),
                      array(
                        'value'       => 'ut-hero-style-6',
                        'label'       => 'Style Six'
                      ),
                      array(
                        'value'       => 'ut-hero-style-7',
                        'label'       => 'Style Seven'
                      ),
                      array(
                        'value'       => 'ut-hero-style-8',
                        'label'       => 'Style Eight'
                      ),
                      array(
                        'value'       => 'ut-hero-style-9',
                        'label'       => 'Style Nine'
                      ),
                      array(
                        'value'       => 'ut-hero-style-10',
                        'label'       => 'Style Ten'
                      ),
                      array(
                        'value'       => 'ut-hero-style-11',
                        'label'       => 'Style Eleven'
                      )
                ),
              ),
              array(
                'id'          => 'font_style',
                'label'       => 'Hero Caption Font Style',
                'desc'		  => 'Setting this option to default will load the hero font style ( which has been set under Front Page Settings -> Hero Settings ).',
                'type'        => 'select',
                'std'		  => 'global',
                'choices'     => array( 
                  array(
                    'value'       => 'global',
                    'label'       => 'Default'
                  ),
                  array(
                    'value'       => 'extralight',
                    'label'       => 'Extra Light'
                  ),
                  array(
                    'value'       => 'light',
                    'label'       => 'Light'
                  ),
                  array(
                    'value'       => 'regular',
                    'label'       => 'Regular'
                  ),
                  array(
                    'value'       => 'medium',
                    'label'       => 'Medium'
                  ),
                  array(
                    'value'       => 'semibold',
                    'label'       => 'Semi Bold'
                  ),
                  array(
                    'value'       => 'bold',
                    'label'       => 'Bold'
                  )
                ),
              ),
               array(
                'id'          => 'align',
                'label'       => 'Choose Caption Alignment',
                'type'        => 'select',
                'std'		  => 'left',
                'choices'     => array( 
                  array(
                    'value'       => 'center',
                    'label'       => 'Center'
                  ),
                  array(
                    'value'       => 'left',
                    'label'       => 'Left'
                  ),
                  array(
                    'value'       => 'right',
                    'label'       => 'Right'
                  )
                ),
              ),
              array(
                'id'          => 'expertise',
                'label'       => 'Hero Caption Slogan',
                'type'        => 'textarea-simple',
                'rows'        => '3'
              ),
              array(
                'id'          => 'description',
                'label'       => 'Hero Caption',
                'type'        => 'textarea-simple',
                'rows'        => '3'
              ),
              array(
                'id'          => 'catchphrase',
                'label'       => 'Hero Caption Description',
                'type'        => 'textarea-simple',
                'rows'        => '3'
              ),
              array(
                'id'          => 'link',
                'label'       => 'Link',
                'type'        => 'text',
                'rows'        => '3'
              ),              
              array(
                'id'          => 'link_description',
                'label'       => 'Link Button Text',
                'type'        => 'text'
              )
            )
          ),
          
          
          /*
	      | Video Type
	      */
           array(
            'id'          => 'ut_page_video_source',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Video Source',
            'desc'        => '',
            'type'        => 'select_group',
            'std'		  => 'youtube',
            'choices'     => array( 
              array(
                'value'       => 'youtube',
                'for'         => array('ut_page_video'),
                'label'       => 'Youtube'
              ),
              array(
                'value'       => 'selfhosted',
                'for'         => array('ut_page_video_mp4','ut_page_video_ogg','ut_page_video_webm','ut_page_video_loop','ut_page_video_preload'),
                'label'       => 'Selfthosted'
              ),
              array(
                'value'       => 'custom',
                'for'         => array('ut_page_video_custom'),
                'label'       => 'Custom'
              )
            ),
          ),
          
          array(
            'id'          => 'ut_page_video',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Video URL',
            'desc'        => 'Please insert the url only e.g. http://youtu.be/gvt_YFuZ8LA . Please do not insert the complete embedded code!',
            'type'        => 'text',
          ),
          
          array(
            'id'          => 'ut_page_video_custom',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Video Embedded Code',
            'desc'        => 'Please insert the complete embedded code of your favorite video hoster!',
            'type'        => 'textarea-simple',
          ),
          
          array(
            'id'          => 'ut_page_video_mp4',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'MP4',
            'desc'        => '',
            'type'        => 'upload',    
          ),
          
           array(
            'id'          => 'ut_page_video_ogg',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'OGG',
            'desc'        => '',
            'type'        => 'upload',    
          ),
          
           array(
            'id'          => 'ut_page_video_webm',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'WEBM',
            'desc'        => '',
            'type'        => 'upload',   
          ),
          
          array(
            'id'          	=> 'ut_page_video_loop',
            'metapanel'     => 'ut-hero-type',
            'label'       	=> 'Loop Video',
            'desc'        	=> '',
            'type'        	=> 'select',
            'choices'     	=> array(
              
              array(
                'label'       => 'yes, please!',
                'value'       => 'on'
              ),
              array(
                'label'       => 'no, thanks!',
                'value'       => 'off'
              )
              
            ),
            'std'         	=> 'on'
          ),
          
          array(
            'id'          	=> 'ut_page_video_preload',
            'metapanel'     => 'ut-hero-type',
            'label'       	=> 'Preload Video',
            'desc'        	=> '',
            'type'        	=> 'select',
            'choices'     	=> array(
              
              array(
                'label'       => 'yes, please!',
                'value'       => 'on'
              ),
              array(
                'label'       => 'no, thanks!',
                'value'       => 'off'
              )
              
            ),
            'std'         	=> 'on'
          ),
          
          array(
            'id'          => 'ut_page_video_sound',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Activate video sound after page is loaded?',
            'desc'        => '<strong>(optional)</strong>. Play sound directly when page is loaded.',
            'std'         => 'off',
            'type'        => 'select',
            'choices'     => array( 
              array(
                'value'       => 'on',
                'label'       => 'yes, please!'
              ),
              array(
                'value'       => 'off',
                'label'       => 'no, thanks!'
              )
            ),
          ),
          
          array(
            'id'          => 'ut_page_video_volume',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Video Volume',
            'desc'        => '1-100 - default 5',
            'std'         => '5',
            'type'        => 'numeric-slider',
            'min_max_step'=> '0,100,1'
          ),
          
          array(
            'id'          	=> 'ut_page_video_mute_button',
            'metapanel'     => 'ut-hero-type',
            'label'       	=> 'Show Mute Button?',
            'desc'        	=> '',
            'type'        	=> 'select',
            'choices'     	=> array(
              
              array(
                'label'       => 'yes, please!',
                'value'       => 'show'
              ),
              array(
                'label'       => 'no, thanks!',
                'value'       => 'hide'
              )
              
            ),
            'std'         	=> 'hide'
          ),
          
          array(
            'id'          => 'ut_page_video_poster',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Poster Image',
            'desc'        => 'This image will be displayed instead of the video on mobile devices.',
            'type'        => 'upload',    
          ),
          
          /*
          | Custom Shortcode
          */
          
          array(
            'id'          => 'ut_page_hero_custom_shortcode',
            'metapanel'   => 'ut-hero-type',
            'label'       => 'Custom Shortcode',
            'desc'        => 'Ideal for plugin shortcodes from Revolution Slider or Layer Slider.',
            'type'        => 'text',
          ),
          
          /*
          | Dynamic
          */
          
          array(
            'id'          => 'ut_page_hero_dynamic_height',
            'label'       => 'Custom Hero Height',
            'metapanel'   => 'ut-hero-type',
            'type'        => 'numeric_slider',
            'std'         => '60',
          ),
          
          array(
            'id'          => 'ut_page_hero_dynamic_content_v_align',
            'label'       => 'Hero Content Vertical Align',
            'metapanel'   => 'ut-hero-type',
            'type'        => 'select',
            'std'         => 'middle',
            'choices'     => array( 
                 array(
                'value'       => 'middle',
                'label'       => 'middle'
              ),
              array(
                'value'       => 'bottom',
                'label'       => 'bottom'
              ),
            ),
          ),
          
          array(
            'id'          => 'ut_page_hero_dynamic_content_margin_bottom',
            'label'       => 'Content Margin Bottom',
            'desc'        => 'value in pixel e.g. 50px.',
            'metapanel'   => 'ut-hero-type',
            'type'        => 'text',
          ),  
          
          /*
          |--------------------------------------------------------------------------
          | Hero Styling
          |--------------------------------------------------------------------------
          */
          
          array(
            'id'            => 'ut_page_hero_global_style',
            'metapanel'     => 'ut-hero-styling',
            'label'       	=> 'Use Global Hero Styling Settings?',
            'toplevel'      => true,
            'std'           => $globaL_defaults,
            'type'          => 'select_group',
            'choices'       => array( 
                array(
                    'value'       => 'on',
                    'for'         => array(
                    ),
                    'label'       => 'yes, please!'
                ),
                array(
                    'value'       => 'off',
                    'for'         => array(
                        'ut_hero_styling',
                        'ut_page_hero_style',
                        'ut_page_hero_font_style',
                        'ut_page_hero_align',
                        'ut_page_hero_overlay_headline',
                        'ut_page_hero_overlay',
                        'ut_page_hero_overlay_color',
                        'ut_page_hero_overlay_color_opacity',
                        'ut_page_hero_overlay_pattern',
                        'ut_page_hero_overlay_pattern_style',
                        'ut_page_hero_overlay_effect_headline',
                        'ut_page_hero_overlay_effect',
                        'ut_page_hero_overlay_effect_style',
                        'ut_page_hero_overlay_effect_color',
                        'ut_page_hero_border_headline',
                        'ut_page_hero_border_bottom',
                        'ut_page_hero_border_bottom_color',
                        'ut_page_hero_border_bottom_width',
                        'ut_page_hero_border_bottom_style',
                        'ut_page_hero_fancy_border',
                        'ut_page_fancy_border_color',
                        'ut_page_fancy_border_background_color',
                        'ut_page_fancy_border_size'
                    ),
                    'label'       => 'no, thanks!'
                )
                
            ) /* end choices */
               
          ),
          
          array(
            'id'          	=> 'ut_hero_styling',
            'metapanel'     => 'ut-hero-styling',
            'label'       	=> 'Hero Caption Style',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Hero Caption Style</h2>',
            'section_class'	=> 'ut-settings-heading',        
          ),
          
          array(
            'id'          => 'ut_page_hero_style',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Hero Caption Style',
            'desc'        => 'Choose between 11 different Hero Caption styles. If you are using a slider as your desired header type, you can define an individual style for each slide. <a href="#" class="ut-hero-preview">Preview Hero Styles</a>',
            'type'        => 'select',
            'choices'     => array( 
              array(
                'value'       => 'ut-hero-style-1',
                'label'       => 'Style One',
                'src'         => ''
              ),
              array(
                'value'       => 'ut-hero-style-2',
                'label'       => 'Style Two'
              ),
              array(
                'value'       => 'ut-hero-style-3',
                'label'       => 'Style Three'
              ),
              array(
                'value'       => 'ut-hero-style-4',
                'label'       => 'Style Four'
              ),
              array(
                'value'       => 'ut-hero-style-5',
                'label'       => 'Style Five'
              ),
              array(
                'value'       => 'ut-hero-style-6',
                'label'       => 'Style Six'
              ),
              array(
                'value'       => 'ut-hero-style-7',
                'label'       => 'Style Seven'
              ),
              array(
                'value'       => 'ut-hero-style-8',
                'label'       => 'Style Eight'
              ),
              array(
                'value'       => 'ut-hero-style-9',
                'label'       => 'Style Nine'
              ),
              array(
                'value'       => 'ut-hero-style-10',
                'label'       => 'Style Ten'
              ),
              array(
                'value'       => 'ut-hero-style-11',
                'label'       => 'Style Eleven'
              )
            ),
          ),
          
          array(
            'id'          => 'ut_page_hero_font_style',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Hero Caption Font Style',
            'desc'        => '<a href="#" class="ut-font-preview">Preview Font Styles</a>',
            'type'        => 'select',
            'choices'     => array(               
              array(
                'value'       => 'extralight',
                'label'       => 'Extra Light'
              ),
              array(
                'value'       => 'light',
                'label'       => 'Light'
              ),
              array(
                'value'       => 'regular',
                'label'       => 'Regular'
              ),
              array(
                'value'       => 'medium',
                'label'       => 'Medium'
              ),
              array(
                'value'       => 'semibold',
                'label'       => 'Semi Bold'
              ),
              array(
                'value'       => 'bold',
                'label'       => 'Bold'
              )
            ),
          ),
          
          array(
            'id'          => 'ut_page_hero_align',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Choose Hero Caption Alignment',
            'type'        => 'select',
            'desc'		  => '',
            'std'		  => 'center',
            'choices'     => array(     
              array(
                'value'       => 'center',
                'label'       => 'Center'
              ),
              array(
                'value'       => 'left',
                'label'       => 'Left'
              ),
              array(
                'value'       => 'right',
                'label'       => 'Right'
              )
            ),
          ),
          
          array(
            'id'          	=> 'ut_page_hero_overlay_headline',
            'metapanel'     => 'ut-hero-styling',
            'label'       	=> 'Hero Overlay Settings',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Hero Overlay Settings</h2>',
            'section_class'	=> 'ut-settings-heading alt',        
          ),
          
          array(
            'id'          => 'ut_page_hero_overlay',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Activate Hero Overlay?',
            'desc'        => '<strong>(optional)</strong>',
            'std'         => 'off',
            'type'        => 'select_group',
            'choices'     => array( 
              array(
                'value'       => 'on',
                'for'         => array(
                    'ut_page_hero_overlay_effect_headline',
                    'ut_page_hero_overlay_effect',
                    'ut_page_hero_overlay_effect_style',
                    'ut_page_hero_overlay_effect_color',
                    'ut_page_hero_overlay_color',
                    'ut_page_hero_overlay_color_opacity',
                    'ut_page_hero_overlay_pattern',
                    'ut_page_hero_overlay_pattern_style'
                ),
                'label'       => 'On'
              ),
              array(
                'value'       => 'off',
                'for'         => array(),
                'label'       => 'Off'
              )
            ),
          ),
          
          array(
            'id'          => 'ut_page_hero_overlay_color',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Hero Overlay Color',
            'desc'        => '<strong>(optional)</strong>',
            'type'        => 'colorpicker',
          ),
          
          array(
            'id'          => 'ut_page_hero_overlay_color_opacity',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Hero Overlay Color Opacity',
            'desc'        => '<strong>(optional)</strong>',
            'type'        => 'numeric-slider',
            'min_max_step'=> '0,1,0.1'
          ),
          
          array(
            'id'          => 'ut_page_hero_overlay_pattern',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Activate Hero Overlay Pattern',
            'desc'        => '<strong>(optional)</strong>',
            'std'         => 'off',
            'type'        => 'select',
            'choices'     => array( 
              array(
                'value'       => 'on',
                'label'       => 'On'
              ),
              array(
                'value'       => 'off',
                'label'       => 'Off'
              )
            ),
          ),
          
          array(
            'id'          => 'ut_page_hero_overlay_pattern_style',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Hero Overlay Pattern Style',
            'desc'        => '<strong>(optional)</strong>',
            'std'         => 'style_one',
            'type'        => 'select',
            'choices'     => array( 
              array(
                'value'       => 'style_one',
                'label'       => 'Style One'
              ),
              array(
                'value'       => 'style_two',
                'label'       => 'Style Two'
              )
            ),
          ),          
          
          array(
            'id'          	=> 'ut_page_hero_overlay_effect_headline',
            'metapanel'     => 'ut-hero-styling',
            'label'       	=> 'Hero Overlay Settings',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Hero Overlay Effect Settings</h2>',
            'section_class'	=> 'ut-settings-heading alt',        
          ),
          
          array(
            'id'          => 'ut_page_hero_overlay_effect',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Activate Overlay Animation Effect?',
            'desc'        => '<strong>(optional)</strong>',
            'std'         => 'off',
            'type'        => 'select',
            'choices'     => array( 
                  array(
                    'value'       => 'on',
                    'label'       => 'On'
                  ),
                  array(
                    'value'       => 'off',
                    'label'       => 'Off'
                  )
            ),
          ),
          
          array(
            'id'          => 'ut_page_hero_overlay_effect_style',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Choose Overlay Animation Effect',
            'desc'        => '<strong>(optional)</strong>',
            'std'         => 'off',
            'type'        => 'select',
            'choices'     => array( 
                  array(
                    'value'       => 'dots',
                    'label'       => 'Connecting Dots'
                  ),
                  array(
                    'value'       => 'bubbles',
                    'label'       => 'Rising Bubbles'
                  )
            ),
          ),
          
          array(
            'id'          => 'ut_page_hero_overlay_effect_color',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Overlay Effect Color',
            'desc'        => '<strong>(optional)</strong>. Leave this field empty if you like to keep the theme accentcolor as effect color.',
            'type'        => 'colorpicker',
          ),
          
          array(
            'id'          	=> 'ut_page_hero_border_headline',
            'metapanel'     => 'ut-hero-styling',
            'label'       	=> 'Hero Border Settings',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Hero Border Settings</h2>',
            'section_class'	=> 'ut-settings-heading alt',        
          ),          
             
          array(
            'id'          => 'ut_page_hero_border_bottom',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Activate Border At Hero Bottom?',
            'desc'        => '',
            'type'        => 'select_group',
            'toplevel'    => false,
            'choices'     => array(              
              array(
                'label'       => 'yes, please!',
                'for'         => array(
                                'ut_page_hero_border_bottom_color',
                                'ut_page_hero_border_bottom_width',
                                'ut_page_hero_border_bottom_style'
                ),
                'value'       => 'on'
              ),
              array(
                'label'       => 'no, thanks!',
                'for'         => array(''),
                'value'       => 'off'
              )              
            ),
            'std'         	=> 'off',
          ),
          
          array(
            'id'          	=> 'ut_page_hero_border_bottom_color',
            'metapanel'     => 'ut-hero-styling',
            'label'       	=> 'Border Bottom Color',
            'type'        	=> 'colorpicker',
            'desc'       	=> '(optional)',
          ),
          
          array(
            'id'          => 'ut_page_hero_border_bottom_width',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Border Bottom Width',
            'desc'        => '<strong>(optional)</strong>',
            'type'        => 'numeric-slider',
            'min_max_step'=> '1,100',
          ),
          
          array(
            'id'          => 'ut_page_hero_border_bottom_style',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Border Bottom Style',
            'type'        => 'select',
            'desc'        => 'Creates a border at the bottom of the hero.',
            'choices'     => array(
              array(
                'label'     => 'dashed',
                'value'     => 'dashed'
              ),
              array(
                'label'     => 'dotted',
                'value'     => 'dotted'
              ),
              array(
                'label'     => 'solid',
                'value'     => 'solid'
              ),
              array(
                'label'     => 'double',
                'value'     => 'double'
              )
            ),
            'std'         	=> 'solid',
          ),
          
          array(
            'id'          => 'ut_page_hero_fancy_border',
            'metapanel'   => 'ut-hero-styling',
            'label'       => 'Activate Fancy Border?',
            'desc'        => '',
            'type'        => 'select_group',
            'toplevel'    => false,
            'choices'     => array(              
              array(
                'label'       => 'yes, please!',
                'for'         => array(
                                'ut_page_fancy_border_color',
                                'ut_page_fancy_border_background_color',
                                'ut_page_fancy_border_size'
                ),
                'value'       => 'on'
              ),
              array(
                'label'       => 'no, thanks!',
                'for'         => array(''),
                'value'       => 'off'
              )              
            ),
            'std'         	=> 'off',
          ),          
          array(
            'id'          	=> 'ut_page_fancy_border_color',
            'metapanel'     => 'ut-hero-styling',
            'label'       	=> 'Color',
            'type'        	=> 'colorpicker',
            'desc'       	=> '(optional)',
          ),          
          array(
            'id'          	=> 'ut_page_fancy_border_background_color',
            'metapanel'     => 'ut-hero-styling',
            'label'       	=> 'Background Color',
            'type'        	=> 'colorpicker',
            'desc'       	=> '(optional)',
          ),
          array(
            'id'            => 'ut_page_fancy_border_size',
            'metapanel'     => 'ut-hero-styling',
            'label'         => 'Size',
            'desc'          => '(optional) - default 10px',
            'type'          => 'text',
          ), 
          
          
          /*
          |--------------------------------------------------------------------------
          | Hero Settings
          |--------------------------------------------------------------------------
          */
          
          array(
            'id'          	=> 'ut_hero_color_settings',
            'metapanel'     => 'ut-hero-content-color-settings',
            'label'       	=> 'Hero Content Colors',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Hero Content Colors</h2>',
            'section_class'	=> 'ut-settings-heading',        
          ),
          
          array(
            'id'          => 'ut_page_hero_global_content_style',
            'metapanel'   => 'ut-hero-content-color-settings',
            'label'       => 'Use Global Hero Content Color Settings?',
            'desc'        => '<strong>(optional)</strong>',
            'std'         => $globaL_defaults,
            'type'        => 'select_group',
            'choices'     => array( 
                array(
                    'value'       => 'on',
                    'for'         => array(),
                    'label'       => 'yes, please!'
                ),
                array(
                    'value'       => 'off',
                    'for'         => array(
                        'ut_page_caption_slogan_color',
                        'ut_page_caption_slogan_background_color',
                        'ut_page_caption_title_color',
                        'ut_page_caption_description_color',
                    ),
                    'label'       => 'no, thanks!'
                )
                
            ) /* end choices */
          ),
          
          array(
            'id'          => 'ut_page_caption_slogan_color',
            'metapanel'   => 'ut-hero-content-color-settings',
            'label'       => 'Hero Caption Slogan Color',
            'desc'        => '<strong>(optional)</strong> - choose an alternative color for <strong>Hero Caption Slogan</strong>.',
            'type'        => 'colorpicker',
          ),
          
          array(
            'id'          => 'ut_page_caption_slogan_background_color',
            'metapanel'   => 'ut-hero-content-color-settings',
            'label'       => 'Hero Caption Slogan Background Color',
            'desc'        => '<strong>(optional)</strong> - choose an alternative background color for <strong>Hero Caption Slogan</strong>.',
            'type'        => 'colorpicker',
          ),
          
          array(
            'id'          => 'ut_page_caption_title_color',
            'metapanel'   => 'ut-hero-content-color-settings',
            'label'       => 'Hero Caption Title Color',
            'desc'        => '<strong>(optional)</strong> - choose an alternative for <strong>Hero Caption Title</strong>.',
            'type'        => 'colorpicker',
          ),
          
          array(
            'id'          => 'ut_page_caption_description_color',
            'metapanel'   => 'ut-hero-content-color-settings',
            'label'       => 'Hero Caption Description Color',
            'desc'        => '<strong>(optional)</strong> - choose an alternative for <strong>Hero Caption Description</strong>.',
            'type'        => 'colorpicker',
          ),
          
          /* custom html */
          array(
            'id'          	=> 'ut_hero_settings',
            'metapanel'     => 'ut-hero-content-custom-html-settings',
            'label'       	=> 'Custom HTML',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Custom HTML</h2>',
            'section_class'	=> 'ut-settings-heading',        
            'class'       	=> ''
          ),
          
          array(
            'id'          => 'ut_page_custom_hero_html',
            'metapanel'   => 'ut-hero-content-custom-html-settings',
            'label'       => 'Custom Hero HTML',
            'desc'        => 'This element appears above the Hero Caption Slogan.',
            'type'        => 'textarea',
            'rows'        => '10'
          ),
          
          /* caption slogan */
          array(
            'id'          	=> 'ut_hero_caption_slogan_headline',
            'metapanel'     => 'ut-hero-content-caption-slogan-settings',
            'label'       	=> '',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Hero Caption Slogan Settings</h2>',
            'section_class'	=> 'ut-settings-heading',
            'class'       	=> ''
          ),
          
          array(
            'id'          => 'ut_page_caption_slogan',
            'metapanel'   => 'ut-hero-content-caption-slogan-settings',
            'label'       => 'Hero Caption Slogan',
            'desc'        => 'This element appears above the Hero Caption.',
            'type'        => 'textarea-simple',
            'rows'        => '5'
          ),
          
          array(
            'id'           	=> 'ut_page_caption_slogan_margin',
            'metapanel'     => 'ut-hero-content-caption-slogan-settings',
            'label'        	=> 'Hero Caption Slogan Margin Bottom',
            'desc'         	=> '<strong>(optional)</strong> -  include "px" in your string. e.g. 30px (default: 0px)',
            'type'        	=> 'text',
            'class'       	=> '',
          ),
          
          /* caption title */
          array(
            'id'          	=> 'ut_hero_caption_title_headline',
            'metapanel'     => 'ut-hero-content-caption-title-settings',
            'label'       	=> '',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Hero Caption Title Settings</h2>',
            'section_class'	=> 'ut-settings-heading',
            'class'       	=> ''
          ),
          
          array(
            'id'          => 'ut_page_caption_title',
            'metapanel'   => 'ut-hero-content-caption-title-settings',
            'label'       => 'Hero Caption Title',
            'desc'        => 'This field also accepts HTML tags and shortcodes such as word rotator for example.',
            'htmldesc'    => '&lt;span&gt; word &lt;/span&gt; = highlight word in themecolor',
            'type'        => 'textarea-simple',
            'rows'        => '5'
          ),
          
          array(
            'id'          => 'ut_page_hero_font_size',
            'metapanel'   => 'ut-hero-content-caption-title-settings',
            'label'       => 'Hero Caption Title Font Size',
            'desc'		  => 'This option only affects Desktop devices, Mobile and Tablet devices are not affected. include "em" in your string. e.g. 3em (default: 6em)',
            'type'        => 'text'
          ),
          
          array(
            'id'          => 'ut_page_caption_slogan_uppercase',
            'metapanel'   => 'ut-hero-content-caption-title-settings',
            'label'       => 'Hero Caption Title Text Transform',
            'desc'        => 'Display the Hero Caption Title in uppercase letters?',
            'type'        => 'select',
            'std'		  => 'off',
            'choices'     => array( 
              array(
                'value'       => 'on',
                'label'       => 'yes please!'
              ),
              array(
                'value'       => 'off',
                'label'       => 'no thanks!'
              ),
            )
          ),
                    
          array(
            'id'          => 'ut_page_caption_slogan_glow',
            'metapanel'   => 'ut-hero-content-caption-title-settings',
            'label'       => 'Hero Caption Title Gloweffect',
            'desc'        => 'Activate Glow Effect for <strong>Hero Caption Title</strong>?',
            'type'        => 'select',
            'std'		  => 'off',
            'choices'     => array( 
              array(
                'value'       => 'on',
                'label'       => 'yes please!'
              ),
              array(
                'value'       => 'off',
                'label'       => 'no thanks!'
              ),
            )
          ),
          
          /* caption description */
          array(
            'id'          	=> 'ut_page_caption_description_headline',
            'metapanel'     => 'ut-hero-content-caption-description-settings',
            'label'       	=> '',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Hero Caption Description Settings</h2>',
            'section_class'	=> 'ut-settings-heading',
            'class'       	=> ''
          ),
          
          array(
            'id'            => 'ut_page_caption_description',
            'metapanel'     => 'ut-hero-content-caption-description-settings',
            'label'         => 'Hero Caption Description',
            'desc'          => 'This field appears beneath the Hero Caption.',
            'type'          => 'textarea-simple',
            'rows'          => '5'
          ),
          
          array(
            'id'            => 'ut_page_caption_description_websafe_font_style',
            'metapanel'     => 'ut-hero-content-caption-description-settings',
            'label'         => 'Hero Caption Description Font Setting',
            'type'          => 'typography',
          ),
                    
          /* buttons */           
          array(
            'id'          	=> 'ut-hero-button-settings',
            'metapanel'     => 'ut-hero-content-button-settings',
            'label'       	=> 'Hero Button Settings',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2>Hero Button Settings</h2>',
            'section_class'	=> 'ut-settings-heading',        
            'class'       	=> ''
          ),
          
          array(
            'id'          => 'ut_page_main_hero_button',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Need a Hero Button?',
            'desc'        => '',
            'type'        => 'radio_group',
            'toplevel'    => true,
            'std'		  => 'off',
            'choices'     => array( 
              array(
                'value'       => 'off',
                'for'         =>  array(''),
                'label'       => 'no thanks!'
              ),
              array(
                'value'       => 'on',
                'for'         => array(
                    'ut_page_main_hero_button_text',
                    'ut_page_main_hero_button_url_type',
                    'ut_page_main_hero_button_url',
                    'ut_page_main_hero_button_target'
                 ),
                'label'       => 'yes please!'
              ),          
            )
          ),
          
          array(
            'id'          => 'ut_page_main_hero_button_text',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Main Hero Button Text',
            'desc'        => 'Enter your desired text for this button.',
            'type'        => 'text',
          ),
          
          array(
            'id'          => 'ut_page_main_hero_button_url_type',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Main Hero Button Link Type',
            'desc'        => 'Do you like to link to the content or an external URL?',
            'type'        => 'radio_group',
            'std'		  => 'content',
            'choices'     => array( 
              array(
                'value'       => 'content',
                'for'         => array(),
                'label'       => 'link to the main content of this page!'
              ),
              array(
                'value'       => 'external',
                'for'         => array('ut_page_main_hero_button_url' , 'ut_page_main_hero_button_target'),
                'label'       => 'link to an external url!'
              ),          
            )
          ),
          
          array(
            'id'          => 'ut_page_main_hero_button_url',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Main Hero Button URL',
            'desc'        => 'Enter your desired URL. Do not forget to place "http://" in front of your link.',
            'type'        => 'text',
          ),
          
          array(
            'id'          => 'ut_page_main_hero_button_target',
            'metapanel'   => 'ut-hero-settings',
            'label'       => 'Main Hero Button Target',
            'type'        => 'select',
            'std'		  => '_blank',
            'choices'     => array( 
              array(
                'value'       => '_blank',
                'label'       => 'blank'
              ),
              array(
                'value'       => '_self',
                'label'       => 'self'
              ),          
            )
          ),
          
          array(
            'id'          => 'ut_page_main_hero_button_style',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Choose Main Hero Button Style',            
            'desc'        => '',
            'type'        => 'select_group',
            'std'		  => 'default',
            'choices'     => array( 
              array(
                'value'       => 'default',
                'for'         => array(''),
                'label'       => 'Default'
              ),
              array(
                'value'       => 'custom',
                'for'         => array('ut_page_main_hrbtn'),
                'label'       => 'Custom'
              ),	  
            ),
          ),
          
          array(
            'id'          => 'ut_page_main_hrbtn',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Custom Button Styling',
            'desc'        => '',
            'type'        => 'button_builder',
          ),
          
          array(
            'id'          => 'ut_page_second_button',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Need a second button?',
            'desc'        => '',
            'type'        => 'radio_group',
            'toplevel'    => true,
            'std'		  => 'off',
            'choices'     => array( 
              array(
                'value'       => 'off',
                'for'         =>  array(''),
                'label'       => 'no thanks!'
              ),
              array(
                'value'       => 'on',
                'for'         => array('ut_page_second_button_text','ut_page_second_button_url_type','ut_page_second_button_url','ut_page_second_button_target'),
                'label'       => 'yes please!'
              ),          
            )
          ),
          
          array(
            'id'          => 'ut_page_second_button_text',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Second Button Text',
            'desc'        => 'Enter your desired buttontext',
            'type'        => 'text',
          ),
          
          array(
            'id'          => 'ut_page_second_button_url_type',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Second Button Link Type',
            'desc'        => 'Do you like to link to a section or external URL?',
            'type'        => 'radio_group',
            'std'		  => 'content',
            'choices'     => array( 
              array(
                'value'       => 'content',
                'for'         =>  array(),
                'label'       => 'link to the main content of this page!'
              ),
              array(
                'value'       => 'external',
                'for'         =>  array('ut_page_second_button_target','ut_page_second_button_url'),
                'label'       => 'link to an external url!'
              ),          
            )
          ),
          
          array(
            'id'          => 'ut_page_second_button_url',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Second Button URL',
            'desc'        => 'Enter your desired URL. Do not forget to place "http://" in front of your link.',
            'type'        => 'text',
          ),
          
          array(
            'id'          => 'ut_page_second_button_target',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Second Button Target',
            'type'        => 'select',
            'std'		  => '_blank',
            'choices'     => array( 
              array(
                'value'       => '_blank',
                'label'       => 'blank'
              ),
              array(
                'value'       => '_self',
                'label'       => 'self'
              ),          
            )
          ),  
          
          array(
            'id'          => 'ut_page_second_button_style',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Choose Second Button Style',
            'desc'        => '',
            'type'        => 'select_group',
            'std'		  => 'default',
            'choices'     => array( 
              array(
                'value'       => 'default',
                'for'         => array(),
                'label'       => 'Default'
              ),
              array(
                'value'       => 'custom',
                'for'         => array('ut_page_second_hrbtn'),
                'label'       => 'Custom'
              ),	  
            ),
          ),
          
          array(
            'id'          => 'ut_page_second_hrbtn',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Custom Button Styling',
            'desc'        => '',
            'type'        => 'button_builder',
          ),
          
          array(
            'id'          => 'ut_page_hero_buttons_margin',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Buttons Margin Top',
            'desc'        => 'Increase the space between Hero Caption Title and Hero Buttons. (optional) - default 0px',
            'type'        => 'text',
          ),   
          
          array(
            'id'          => 'ut_page_hero_down_arrow',
            'label'       => 'Activate Scroll Down Arrow?',
            'desc'        => 'A large double lined down arrow.',
            'metapanel'   => 'ut-hero-content-button-settings',
            'type'        => 'radio_group',
            'std'         => 'off',
            'choices'     => array( 
              array(
                'value'       => 'off',
                'for'         =>  array(''),
                'label'       => 'no thanks!'
              ),
              array(
                'value'       => 'on',
                'for'         => array(
                    'ut_page_scroll_down_arrow_color',
                    'ut_page_scroll_down_arrow_position',
                    'ut_page_scroll_down_arrow_position_vertical'
                ),
                'label'       => 'yes please!'
              ),          
            )
          ),
                         
          array(
            'id'          => 'ut_page_scroll_down_arrow_color',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Scroll Down Arrow Color',
            'desc'        => '<strong>(optional)</strong> - choose an alternative for <strong>Scroll Down Arrow</strong>.',
            'type'        => 'colorpicker',
          ),   
          
          array(
            'id'          => 'ut_page_scroll_down_arrow_position',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Scroll Down Arrow Horizontal Position',
            'type'        => 'numeric_slider',
            'std'         => '50',
          ),
          
          array(
            'id'          => 'ut_page_scroll_down_arrow_position_vertical',
            'metapanel'   => 'ut-hero-content-button-settings',
            'label'       => 'Scroll Down Arrow Vertical Position',
            'type'        => 'numeric_slider',
            'std'         => '80',
          ),
          
          
          
          
              
    
    
    )
  
  );
  
  ot_register_meta_box( $ut_metabox_hero_settings );

}

?>