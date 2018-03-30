<?php

add_action( 'admin_init', 'ut_theme_options_old' );

function ut_theme_options_old() {

  $saved_settings = get_option( 'option_tree_settings', array() );
  
  $ut_settings = array( 
    
    'contextual_help' => array( 
        'sidebar'       => ''
    ),
    
    'sections'        => array( 
      
      array(
        'id'          => 'ut_general_settings',
        'title'       => 'General',
        'icon'        => 'general-icon.png'
      ),
      
      array(
        'id'          => 'ut_typography_settings',
        'title'       => 'Typography',
        'icon'        => 'typography-icon.png'
      ),
      
      array(
        'id'          => 'ut_global_hero_settings',
        'title'       => 'Hero Settings',
        'icon'        => 'hero-icon.png'
      ),
      
      array(
        'id'          => 'ut_front_page_settings',
        'title'       => 'Front Page',
        'icon'        => 'frontpage-icon.png'
      ),
      
      array(
        'id'          => 'ut_blog_settings',
        'title'       => 'Blog',
        'icon'        => 'blog-icon.png'
      ), 
      
      array(
        'id'          => 'ut_portfolio_settings',
        'title'       => 'Portfolio',
        'icon'        => 'portfolio-icon.png'        
      ),
      
      array(
        'id'          => 'ut_csection_settings',
        'title'       => 'Contact',
        'icon'        => 'contact-icon.png'        
      ),
      
      array(
        'id'          => 'ut_advanced_settings',
        'title'       => 'Advanced',
        'icon'        => 'advanced-icon.png'        
      )      
            
    ),
    
    'settings'        => array(
      
      /*
      |--------------------------------------------------------------------------
      | Sub Section Logo and Themecolor
      |--------------------------------------------------------------------------
      */ 
      array(
        'id'          => 'ut_customize_settings_menu',
        'subid'       => 'ut_customize_settings',
        'label'       => 'Customize',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
      ),
      
      array(
        'id'          => 'ut_customize_setting_headline',
        'label'       => 'Customize',
        'desc'        => '<h2 class="section-headline">Customize Logo & Accentcolor</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_customize_settings'
      ),
      
      array(
        'id'          => 'ut_accentcolor',
        'label'       => 'Themecolor',
        'desc'        => 'Define your desired primary theme accent color. Keep in mind, that you can easily define own colors for each page or section by using the "Color Settings" tab beneath the WordPress Editor. Besides you can also add a custom CSS class to each page or section by using the class field and afterwards simply define your own styles.',
        'type'        => 'colorpicker_customizer',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_customize_settings',
      ),
      
      array(
        'id'          => 'ut_site_logo_max_height',
        'label'       => 'Logo max Height',
        'desc'        => 'Use an alternate Logo max height. Note: This Option affects all logos.',
        'type'        => 'numeric_slider',
        'std'         => '60',
        'min_max_step'=> '0,60,1',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_customize_settings',
      ),  
      
      array(
        'id'          => 'ut_site_logo',
        'label'       => 'Main Logo',
        'desc'        => 'The maximum width of the logo should be 330px and the maximum height of the logo should be 60px. And for retina logo, please double the size of your logo by keeping the aspect ratio. Learn more about the logo setup here: <a class="ut-faq-link" target="_blank" href="http://faq.unitedthemes.com/brooklyn/written-tutorials/upload-your-own-logo/">Logo Setup</a>',
        'type'        => 'upload_customizer',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_customize_settings',
      ),
      
      array(
        'id'          => 'ut_site_logo_alt',
        'label'       => 'Alternate Logo',
        'desc'        => '',
        'type'        => 'upload_customizer',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_customize_settings',
      ),
      
      array(
        'id'          => 'ut_site_logo_retina',
        'label'       => 'Retina Main Logo',
        'desc'        => '',
        'type'        => 'upload_customizer',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_customize_settings',
      ),
      
      array(
        'id'          => 'ut_site_logo_alt_retina',
        'label'       => 'Retina Alternate Logo',
        'desc'        => '',
        'type'        => 'upload_customizer',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_customize_settings',
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Sub Section Touch Icons
      |--------------------------------------------------------------------------
      */ 
      
      array(
        'id'          => 'ut_touch_settings_menu',
        'subid'       => 'ut_touch_settings',
        'label'       => 'Apple Touch Icons',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
      ),
      
      array(
        'id'          => 'ut_touch_setting_headline',
        'label'       => 'Apple Touch Icons',
        'desc'        => '<h2 class="section-headline">Apple Touch Icons</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_touch_settings'
      ),
      
      array(
        'id'          => 'ut_favicon',
        'label'       => 'Favicon',
        'desc'        => 'The dimension for the image must be 16x16 pixels or 32x32 pixels, using either 8-bit or 24-bit colors and the format must be one of PNG (a W3C standard), GIF, or ICO.',
        'type'        => 'upload',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_touch_settings'
      ),
        
      array(
        'id'          => 'ut_apple_touch_icon_iphone',
        'label'       => 'Apple Touch Icon IPhone',
        'desc'        => '57x57 pixel for iPhone and iPod touch. <br /> <strong>Recommended format must be one of PNG, GIF, or JPG</strong>.',
        'type'        => 'upload',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_touch_settings'
      ),
      
      array(
        'id'          => 'ut_apple_touch_icon_ipad',
        'label'       => 'Apple Touch Icon IPad',
        'desc'        => '72 x 72 pixel for IPad. <br /> <strong>Recommended format must be one of PNG, GIF, or JPG</strong>.',
        'type'        => 'upload',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_touch_settings'
      ),
      
      array(
        'id'          => 'ut_apple_touch_icon_iphone_retina',
        'label'       => 'Apple Touch Icon IPhone ( Retina )',
        'desc'        => '114 x 114 pixel for high-resolution iPhone and iPod touch. <br /> <strong>Recommended format must be one of PNG, GIF, or JPG</strong>.',
        'type'        => 'upload',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_touch_settings'
      ),
      
      array(
        'id'          => 'ut_apple_touch_icon_ipad_retina',
        'label'       => 'Apple Touch Icon IPad ( Retina )',
        'desc'        => '144 x 144 pixel for high-resolution iPad. <br /> <strong>Recommended format must be one of PNG, GIF, or JPG</strong>.',
        'type'        => 'upload',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_touch_settings'
      ),
    
      /*
      |--------------------------------------------------------------------------
      | Border Settings
      |--------------------------------------------------------------------------
      */
      array(
        'id'          => 'ut_border_settings_menu',
        'subid'       => 'ut_border_settings',
        'label'       => 'Border',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings'
      ),
      
      array(
        'id'          => 'ut_border_setting_headline',
        'label'       => 'Border',
        'desc'        => '<h2 class="section-headline">Border</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_border_settings',
      ),
      
      array(
        'id'          => 'ut_site_border',
        'label'       => 'Display Page Border?',
        'type'        => 'select_group',
        'toplevel'    => true,
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_border_settings',
        'std'         => 'hide',
        'choices'     => array( 
          array(
            'value'       => 'show',
            'for'         => array(
                'ut_site_border_color',
                'ut_site_navigation_flush'
            ),
            'label'       => 'Show'
          ),
          array(
            'value'       => 'hide',
            'for'         => array(''),
            'label'       => 'Hide'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_site_border_color',
        'label'       => 'Bordercolor',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_border_settings',
        'std'         => '#FFFFFF',
      ),
      
      array(
        'id'          => 'ut_site_border_body_color',
        'label'       => 'Body Background Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_border_settings',
        'std'         => '',
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Top Header Configuration
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_top_header_settings_menu',
        'subid'       => 'ut_top_header_settings',
        'label'       => 'Top Header',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings'
      ),
      
      array(
        'id'          => 'ut_top_header_setting_headline',
        'label'       => 'Top Header',
        'desc'        => '<h2 class="section-headline">Top Header</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings',
      ),
      
      array(
        'id'          => 'ut_top_header',
        'label'       => 'Display Top Header?',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings',
        'std'         => 'hide',
        'choices'     => array( 
          array(
            'value'       => 'show',
            'for'         => array(
                'ut_top_header_social_icons',
                'ut_top_header_email',
                'ut_top_header_phone',
                'ut_top_header_color_setting_headline',
                'ut_top_header_text_color',
                'ut_top_header_icon_color',
                'ut_top_header_link_color',
                'ut_top_header_link_color_hover',
                'ut_top_header_social_icon_color',
                'ut_top_header_social_icon_color_hover'
                          ),
            'label'       => 'Show'
          ),
          array(
            'value'       => 'hide',
            'for'         => array(''),
            'label'       => 'Hide'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_top_header_email',
        'label'       => 'Email',
        'desc'        => 'Please enter your Email.',
        'type'        => 'text',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings'
      ),
      
      array(
        'id'          => 'ut_top_header_phone',
        'label'       => 'Phone',
        'desc'        => 'Please enter your Phonenumber.',
        'type'        => 'text',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings'
      ),      
      
      array(
        'id'          => 'ut_top_header_social_icons',
        'label'       => 'Social Icons',
        'type'        => 'list-item',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings',
        'settings'    => array( 
          array(
            'id'          => 'icon',
            'label'       => 'Icon',
            'type'        => 'select',
            'choices'     => array( 
                  array(
                    'value'       => 'fa-adn',
                    'label'       => 'Alpha'                    
                  ),
                  array(
                    'value'       => 'fa-behance',
                    'label'       => 'Behance'                    
                  ),
                  array(
                    'value'       => 'fa-bitbucket',
                    'label'       => 'Bitbucket'                    
                  ),
                  array(
                    'value'       => 'fa-codepen',
                    'label'       => 'Codepen'                    
                  ),
                  array(
                    'value'       => 'fa-delicious',
                    'label'       => 'Delicious'                    
                  ),
                  array(
                    'value'       => 'fa-deviantart',
                    'label'       => 'Deviantart'                    
                  ),
                  array(
                    'value'       => 'fa-digg',
                    'label'       => 'Digg'                    
                  ),
                  array(
                    'value'       => 'fa-dribbble',
                    'label'       => 'Dribbble'
                  ),
                  array(
                    'value'       => 'fa-dropbox',
                    'label'       => 'Dropbox'
                  ),
                  array(
                    'value'       => 'fa-facebook',
                    'label'       => 'Facebook'
                  ),
                  array(
                    'value'       => 'fa-flickr',
                    'label'       => 'Flickr'
                  ),
                  array(
                    'value'       => 'fa-foursquare',
                    'label'       => 'Foursquare'
                  ),                  
                  array(
                    'value'       => 'fa-github',
                    'label'       => 'Github'
                  ),
                  array(
                    'value'       => 'fa-gittip',
                    'label'       => 'Gittip'
                  ),
                  array(
                    'value'       => 'fa-google-plus',
                    'label'       => 'Google Plus'
                  ),
                  array(
                    'value'       => 'fa-instagram',
                    'label'       => 'Instagram'
                  ),
                  array(
                    'value'       => 'fa-jsfiddle',
                    'label'       => 'JSFiddle'
                  ),
                  array(
                    'value'       => 'fa-linkedin',
                    'label'       => 'LinkedIn'
                  ),
                  array(
                    'value'       => 'fa-reddit',
                    'label'       => 'Reddit'
                  ),
                  array(
                    'value'       => 'fa-pinterest',
                    'label'       => 'Pinterest'
                  ),
                  array(
                    'value'       => 'fa-skype',
                    'label'       => 'Skype'
                  ),
                  array(
                    'value'       => 'fa-soundcloud',
                    'label'       => 'Soundcloud'
                  ),
                  array(
                    'value'       => 'fa-tumblr',
                    'label'       => 'Tumblr'
                  ),
                  array(
                    'value'       => 'fa-twitter',
                    'label'       => 'Twitter'
                  ),
                  array(
                    'value'       => 'fa-vimeo-square',
                    'label'       => 'Vimeo'
                  ),
                  array(
                    'value'       => 'fa-vk',
                    'label'       => 'VK'
                  ),
                  array(
                    'value'       => 'fa-xing',
                    'label'       => 'Xing'
                  ),
                  array(
                    'value'       => 'fa-youtube',
                    'label'       => 'Youtube'
                  ),
                  array(
                    'value' => 'fa-spotify',
                    'label' => 'Spotify'
                  ),

            ),
          ),
          array(
            'id'          => 'link',
            'label'       => 'Link',
            'type'        => 'text',
            'rows'        => '3'
          )
        )
      ),
      
      array(
        'id'          => 'ut_top_header_color_setting_headline',
        'label'       => 'Color Settings',
        'desc'        => '<h2 class="section-headline">Color Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings',
      ),
      
      array(
        'id'          => 'ut_top_header_text_color',
        'label'       => 'Top Header Text Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings',
        'std'         => '#888'
      ),
      
      array(
        'id'          => 'ut_top_header_icon_color',
        'label'       => 'Top Header Icon Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings',
        'std'         => '#888'
      ),
      
      array(
        'id'          => 'ut_top_header_link_color',
        'label'       => 'Top Header Link Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings',
        'std'         => '#888'
      ),
      
      array(
        'id'          => 'ut_top_header_link_color_hover',
        'label'       => 'Top Header Link Color Hover',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings',
        'std'         => get_option('ut_accentcolor' , '#F1C40F')
      ),
      
      array(
        'id'          => 'ut_top_header_social_icon_color',
        'label'       => 'Top Header Social Icon Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings',
        'std'         => '#888'
      ),
      
      array(
        'id'          => 'ut_top_header_social_icon_color_hover',
        'label'       => 'Top Header Social Icon Color Hover',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_top_header_settings',
        'std'         => get_option('ut_accentcolor' , '#F1C40F')
      ),
       
      /*
      |--------------------------------------------------------------------------
      | Header and Navigation Configuration
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_navigation_settings_menu',
        'subid'       => 'ut_navigation_settings',
        'label'       => 'Global Header and Navigation',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings'
      ),
      
      array(
        'id'          => 'ut_navigation_setting_headline',
        'label'       => 'Navigation',
        'desc'        => '<h2 class="section-headline">Header and Navigation</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_setting_Info',
        'label'       => 'Navigation',
        'desc'        => 'These are your global Header and Navigation settings for the entire site. However, in order to give you more freedom while individualizing your Brooklyn powered website. You can overwrite these settings by using the "Header / Navigation" tab inside the Front Page or Blog Section. Means you can differentiate the visual appearance on different parts of your website.',
        'type'        => 'section_headline_info',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_width',
        'label'       => 'Header Width',
        'type'        => 'select_group',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
        'std'         => 'centered',
        'choices'     => array( 
          array(
            'value'       => 'centered',
            'for'         => array(
            
            ),
            'label'       => 'Centered'
          ),
          array(
            'value'       => 'fullwidth',
            'for'         => array(
                'ut_site_navigation_flush'
            ),
            'label'       => 'Fullwidth'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_site_navigation_flush',
        'label'       => 'Activate Navigation Flush?',
        'desc'        => 'only applies of Page Border is active and Header Width has been set to fullwidth.',
        'type'        => 'select',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
        'std'         => 'no',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Yes'
          ),
          array(
            'value'       => 'no',
            'label'       => 'No'
          )
        ),
      ),
       
      array(
        'id'          => 'ut_navigation_skin',
        'label'       => 'Header Color Skin',
        'type'        => 'select_group',
        'toplevel'    => true,
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
        'std'         => 'ut-header-light',
        'choices'     => array( 
          array(
            'value'       => 'ut-header-dark',
            'for'         => array(
                'ut_navigation_darkskin_settings_headline',
                'ut_navigation_skin_dark_bgcolor',
                'ut_navigation_skin_bgcolor_opacity',
                'ut_navigation_level_one_color',
                'ut_navigation_skin_bgcolor_opacity',
                'ut_navigation_shadow',
                'ut_navigation_font_weight',
                'ut_navigation_state',
                'ut_navigation_transparent_border'
            ),
            'label'       => 'Dark'
          ),
          array(
            'value'       => 'ut-header-light',
            'for'         => array(
                'ut_navigation_lightskin_settings_headline',
                'ut_navigation_skin_light_bgcolor',
                'ut_navigation_skin_bgcolor_opacity',
                'ut_navigation_level_one_color',
                'ut_navigation_skin_bgcolor_opacity',
                'ut_navigation_shadow',
                'ut_navigation_font_weight',
                'ut_navigation_state',
                'ut_navigation_transparent_border'
            ),
            'label'       => 'Light'
          ),
          array(
            'value'       => 'ut-header-custom',
            'for'         => array(
                'ut_navigation_customskin_settings_headline',
                'ut_navigation_customskin_state',
                 
                 /* headlines */
                'ut_navigation_customskin_primary_settings_headline',
                'ut_navigation_customskin_secondary_settings_headline',
                
                /* primary nav */
                'ut_header_ps_text_logo_color',
                'ut_header_ps_text_logo_color_hover',
                'ut_subheadline_ps_header_colors',
                'ut_header_ps_background_color',
                'ut_header_ps_shadow_color',
                'ut_header_ps_border_color',
                'ut_subheadline_ps_fl_colors',
                'ut_navigation_ps_fl_color',
                'ut_navigation_ps_fl_color_hover',
                'ut_navigation_ps_fl_dot_color',
                'ut_navigation_ps_fl_active_color',
                'ut_subheadline_ps_sl_colors',
                'ut_navigation_ps_sl_background_color',
                'ut_navigation_ps_sl_color',
                'ut_navigation_ps_sl_color_hover',
                'ut_navigation_ps_sl_shadow_color',
                'ut_navigation_ps_sl_border_color',
                
                /* secondary nav */
                'ut_header_ss_text_logo_color',
                'ut_header_ss_text_logo_color_hover',
                
                /* header colors */
                'ut_subheadline_ss_header_colors',
                'ut_header_ss_background_color',
                'ut_header_ss_shadow_color',
                'ut_header_ss_border_color',
                
                /* first level */
                'ut_subheadline_ss_fl_colors',
                'ut_navigation_ss_fl_color',
                'ut_navigation_ss_fl_color_hover',
                'ut_navigation_ss_fl_dot_color',
                'ut_navigation_ss_fl_active_color',
                
                /* sub menu */
                'ut_subheadline_ss_sl_colors',
                'ut_navigation_ss_sl_background_color',
                'ut_navigation_ss_sl_color',
                'ut_navigation_ss_sl_color_hover',
                'ut_navigation_ss_sl_shadow_color',
                'ut_navigation_ss_sl_border_color'
             ),
            'label'       => 'Custom Skin'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_navigation_darkskin_settings_headline',
        'label'       => 'Dark Skin Settings',
        'desc'        => '<h2 class="section-headline">Dark Skin Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_lightskin_settings_headline',
        'label'       => 'Light Skin Settings',
        'desc'        => '<h2 class="section-headline">Light Skin Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      /* setting for both base skins */
      array(
        'id'          => 'ut_navigation_state',
        'label'       => 'Always show Header and Navigation?',
        'desc'        => 'This option makes header and navigation visible all the time. If you choose "On (transparent)". The navigation will turn into the chosen skin when reaching the main content."',
        'type'        => 'select_group',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
        'std'         => 'off',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'for'         => array(
                'ut_navigation_shadow'
            ),
            'label'       => 'On (with chosen skin)'
          ),
          array(
            'value'       => 'on_transparent',
            'for'         => array(
                'ut_navigation_transparent_border'
            ),
            'label'       => 'On (transparent)'
          ),
          array(
            'value'       => 'off',
            'for'         => array(
                'ut_navigation_shadow'
            ),
            'label'       => 'Off'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_navigation_shadow',
        'label'       => 'Header Shadow',
        'desc'        => 'Activate Header Shadow?',
        'type'        => 'select',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
        'std'         => 'on',
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
        'id'          => 'ut_navigation_transparent_border',
        'label'       => 'Activate Navigation Border Bottom?',
        'type'        => 'select',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
        'std'         => 'off',
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
        'id'          => 'ut_navigation_customskin_settings_headline',
        'label'       => 'Custom Skin Settings',
        'desc'        => '<h2 class="section-headline">Custom Skin Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_customskin_state',
        'label'       => 'Always show Header and Navigation?',
        'desc'        => 'This option makes header and navigation visible all the time. If you choose "Yes, but switch to secondary skin on scroll!". The navigation will turn into the secondary skin when reaching the main content. There secondary skin settings will appear once you select this option."',
        'type'        => 'select_group',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
        'std'         => 'on',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'for'         => array(
                /* headline */
                'ut_navigation_customskin_primary_settings_headline',
                
                /* primary skin */
                'ut_header_ps_text_logo_color',
                'ut_header_ps_text_logo_color_hover',
                
                /* header colors */
                'ut_subheadline_ps_header_colors',
                'ut_header_ps_background_color',
                'ut_header_ps_shadow_color',
                'ut_header_ps_border_color',
                
                /* first level */
                'ut_subheadline_ps_fl_colors',
                'ut_navigation_ps_fl_color',
                'ut_navigation_ps_fl_color_hover',
                'ut_navigation_ps_fl_dot_color',
                'ut_navigation_ps_fl_active_color',
                
                /* sub menu */
                'ut_subheadline_ps_sl_colors',
                'ut_navigation_ps_sl_background_color',
                'ut_navigation_ps_sl_color',
                'ut_navigation_ps_sl_color_hover',
                'ut_navigation_ps_sl_shadow_color',
                'ut_navigation_ps_sl_border_color',
                
            ),
            'label'       => 'Yes, with primary skin!'
          ),
          array(
            'value'       => 'on_switch',
            'for'         => array(
                /* headlines */
                'ut_navigation_customskin_primary_settings_headline',
                'ut_navigation_customskin_secondary_settings_headline',
                
                /* primary nav */
                'ut_header_ps_text_logo_color',
                'ut_header_ps_text_logo_color_hover',
                
                /* header colors */
                'ut_subheadline_ps_header_colors',
                'ut_header_ps_background_color',
                'ut_header_ps_shadow_color',
                'ut_header_ps_border_color',
                
                /* first level */
                'ut_subheadline_ps_fl_colors',
                'ut_navigation_ps_fl_color',
                'ut_navigation_ps_fl_color_hover',
                'ut_navigation_ps_fl_dot_color',
                'ut_navigation_ps_fl_active_color',
                
                /* sub menu */
                'ut_subheadline_ps_sl_colors',
                'ut_navigation_ps_sl_background_color',
                'ut_navigation_ps_sl_color',
                'ut_navigation_ps_sl_color_hover',
                'ut_navigation_ps_sl_shadow_color',
                'ut_navigation_ps_sl_border_color',
                
                /* primary hover state */
                'ut_subheadline_ps_hover_colors',
                'ut_navigation_ps_hover_state',
                'ut_header_ps_background_color_hover',
                'ut_header_ps_border_color_hover',
                'ut_header_ps_shadow_color_hover',
                'ut_navigation_ps_hover_fl_color',
                'ut_navigation_ps_hover_fl_dot_color',
                
                /* secondary nav */
                'ut_header_ss_text_logo_color',
                'ut_header_ss_text_logo_color_hover',
                
                /* header colors */
                'ut_subheadline_ss_header_colors',
                'ut_header_ss_background_color',
                'ut_header_ss_shadow_color',
                'ut_header_ss_border_color',
                
                /* first level */
                'ut_subheadline_ss_fl_colors',
                'ut_navigation_ss_fl_color',
                'ut_navigation_ss_fl_color_hover',
                'ut_navigation_ss_fl_dot_color',
                'ut_navigation_ss_fl_active_color',
                
                /* sub menu */
                'ut_subheadline_ss_sl_colors',
                'ut_navigation_ss_sl_background_color',
                'ut_navigation_ss_sl_color',
                'ut_navigation_ss_sl_color_hover',
                'ut_navigation_ss_sl_shadow_color',
                'ut_navigation_ss_sl_border_color'
                
            ),
            'label'       => 'Yes, but switch to secondary skin on scroll or hover!'
          ),
          array(
            'value'       => 'off',
             'for'         => array(
                /* headline */
                'ut_navigation_customskin_primary_settings_headline',
                
                /* primary skin */
                'ut_header_ps_text_logo_color',
                'ut_header_ps_text_logo_color_hover',
                'ut_subheadline_ps_header_colors',
                'ut_header_ps_background_color',
                'ut_header_ps_shadow_color',
                'ut_header_ps_border_color',
                
                /* first level */
                'ut_subheadline_ps_fl_colors',
                'ut_navigation_ps_fl_color',
                'ut_navigation_ps_fl_color_hover',
                'ut_navigation_ps_fl_dot_color',
                'ut_navigation_ps_fl_active_color',
                
                /* submenu */
                'ut_subheadline_ps_sl_colors',
                'ut_navigation_ps_sl_background_color',
                'ut_navigation_ps_sl_color',
                'ut_navigation_ps_sl_color_hover',
                'ut_navigation_ps_sl_shadow_color',
                'ut_navigation_ps_sl_border_color'

            ),
            'label'       => 'No, but switch to primary skin on scroll!'
          )
        ),
      ),
      
      
      /* Primary Skin */
      array(
        'id'          => 'ut_navigation_customskin_primary_settings_headline',
        'label'       => 'Primary Skin Settings',
        'desc'        => '<h2 class="section-headline">Primary Skin Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_header_ps_text_logo_color',
        'label'       => 'Text Logo Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_header_ps_text_logo_color_hover',
        'label'       => 'Text Logo Color Hover',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_subheadline_ps_header_colors',
        'label'       => 'Header Colors',
        'desc'        => '<h2 class="section-headline">Header Colors</h2>',
        'type'        => 'sub_section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_header_ps_background_color',
        'label'       => 'Header Background Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_header_ps_shadow_color',
        'label'       => 'Header Shadow Color',
        'desc'        => 'You can turn off the shadow by settings its opacity to 0. Simply use the adjustment bar on the right of the colorpicker.',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),      
            
      array(
        'id'          => 'ut_header_ps_border_color',
        'label'       => 'Header Border Bottom Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ), 
      
      array(
        'id'          => 'ut_subheadline_ps_fl_colors',
        'label'       => 'Navigation First Level Colors',
        'desc'        => '<h2 class="section-headline">Navigation First Level Colors</h2>',
        'type'        => 'sub_section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_fl_color',
        'label'       => 'Navigation First Level Link Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_fl_color_hover',
        'label'       => 'Navigation First Level Link Hover Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_fl_dot_color',
        'label'       => 'Navigation First Level Dot Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_fl_active_color',
        'label'       => 'Navigation First Level Active Link Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_subheadline_ps_sl_colors',
        'label'       => 'Navigation Sub Menu Colors',
        'desc'        => '<h2 class="section-headline">Navigation Sub Menu Colors</h2>',
        'type'        => 'sub_section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_sl_background_color',
        'label'       => 'Navigation Sub Menu Background Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_sl_color',
        'label'       => 'Navigation Sub Menu Link Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_sl_color_hover',
        'label'       => 'Navigation Sub Menu Link Hover Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_sl_shadow_color',
        'label'       => 'Navigation Sub Menu Shadow Color',
        'desc'        => 'You can turn off the shadow by settings its opacity to 0. Simply use the adjustment bar on the right of the colorpicker.',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_sl_border_color',
        'label'       => 'Navigation Sub Menu Border Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      /* optional hover state */
      array(
        'id'          => 'ut_subheadline_ps_hover_colors',
        'label'       => 'Hover State Colors',
        'desc'        => '<h2 class="section-headline">Hover State Colors</h2>',
        'type'        => 'sub_section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_hover_state',
        'label'       => 'Add Hover State?',
        'type'        => 'select_group',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
        'std'         => 'off',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'for'         => array(
                'ut_header_ps_background_color_hover',
                'ut_header_ps_shadow_color_hover',
                'ut_header_ps_border_color_hover',
                'ut_navigation_ps_hover_fl_color',
                'ut_navigation_ps_hover_fl_dot_color'
            ),
            'label'       => 'Yes'
          ),
          array(
            'value'       => 'off',
            'for'         => array(
                
            ),
            'label'       => 'No'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_header_ps_background_color_hover',
        'label'       => 'Header Background Color on Hover',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_header_ps_border_color_hover',
        'label'       => 'Header Border Color on Hover',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_header_ps_shadow_color_hover',
        'label'       => 'Header Shadow Color on Hover',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_hover_fl_color',
        'label'       => 'Navigation First Level Link Color on Hover',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ps_hover_fl_dot_color',
        'label'       => 'Navigation First Level Dot Color on Hover',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      /* Secondary Skin */
      array(
        'id'          => 'ut_navigation_customskin_secondary_settings_headline',
        'label'       => 'Secondary Skin Settings',
        'desc'        => '<h2 class="section-headline">Secondary Skin Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_header_ss_text_logo_color',
        'label'       => 'Text Logo Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_header_ss_text_logo_color_hover',
        'label'       => 'Text Logo Color Hover',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_subheadline_ss_header_colors',
        'label'       => 'Header Colors',
        'desc'        => '<h2 class="section-headline">Header Colors</h2>',
        'type'        => 'sub_section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_header_ss_background_color',
        'label'       => 'Header Background Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_header_ss_shadow_color',
        'label'       => 'Header Shadow Color',
        'desc'        => 'You can turn off the shadow by settings its opacity to 0. Simply use the adjustment bar on the right of the colorpicker.',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',        
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ), 
      
      array(
        'id'          => 'ut_header_ss_border_color',
        'label'       => 'Header Border Bottom Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ), 
      
      array(
        'id'          => 'ut_subheadline_ss_fl_colors',
        'label'       => 'Navigation First Level Colors',
        'desc'        => '<h2 class="section-headline">Navigation First Level Colors</h2>',
        'type'        => 'sub_section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),      
      
      array(
        'id'          => 'ut_navigation_ss_fl_color',
        'label'       => 'Navigation First Level Link Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ss_fl_color_hover',
        'label'       => 'Navigation First Level Link Hover Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ss_fl_dot_color',
        'label'       => 'Navigation First Level Dot Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ss_fl_active_color',
        'label'       => 'Navigation First Level Active Link Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_subheadline_ss_sl_colors',
        'label'       => 'Navigation Sub Menu Colors',
        'desc'        => '<h2 class="section-headline">Navigation Sub Menu Colors</h2>',
        'type'        => 'sub_section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
            
      array(
        'id'          => 'ut_navigation_ss_sl_background_color',
        'label'       => 'Navigation Sub Menu Background Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ss_sl_color',
        'label'       => 'Navigation Sub Menu Link Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ss_sl_color_hover',
        'label'       => 'Navigation Sub Menu Link Hover Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_navigation_ss_sl_shadow_color',
        'label'       => 'Navigation Sub Menu Shadow Color',
        'desc'        => 'You can turn off the shadow by settings its opacity to 0. Simply use the adjustment bar on the right of the colorpicker.',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
       array(
        'id'          => 'ut_navigation_ss_sl_border_color',
        'label'       => 'Navigation Sub Menu Border Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_navigation_settings',
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Mobile Navigation Configuration
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_mobile_navigation_settings_menu',
        'subid'       => 'ut_mobile_navigation_settings',
        'label'       => 'Mobile Navigation',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings'
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_setting_headline',
        'label'       => 'Mobile Navigation',
        'desc'        => '<h2 class="section-headline">Mobile Navigation</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_trigger_icon',
        'label'       => 'Mobile Menu Open / Close Icon',
        'type'        => 'iconpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_trigger_color',
        'label'       => 'Mobile Menu Open / Close Button Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_trigger_color_hover',
        'label'       => 'Mobile Menu Open / Close Button Hover and Active Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_background_color',
        'label'       => 'Background Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_link_color',
        'label'       => 'Link Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_link_color_hover',
        'label'       => 'Link Hover Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_dot_color',
        'label'       => 'Dot Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_dot_color_hover',
        'label'       => 'Dot Hover Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_link_background_color',
        'label'       => 'Link Background Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_link_background_color_hover',
        'label'       => 'Link Background Hover Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_mobile_navigation_border_color',
        'label'       => 'Border Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_mobile_navigation_settings',
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Sidebar
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_global_sidebar_settings_menu',
        'subid'       => 'ut_global_sidebar_settings',
        'label'       => 'Sidebar',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings'
      ),
           
      array(
        'id'          => 'ut_global_sidebar_colors_headline',
        'label'       => 'Individual Sidebar Colors',
        'desc'        => '<h2 class="section-headline">Individual Sidebar Colors</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_global_sidebar_settings',
      ),      
      
      array(
        'id'          => 'ut_global_sidebar_widgets_text_color',
        'label'       => 'Sidebar Text Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_global_sidebar_settings',
      ),
      
      array(
        'id'          => 'ut_global_sidebar_widgets_text_font_size',
        'label'       => 'SidebarText Font Size',
        'type'        => 'text',
        'desc'        => 'Value in px: e.g. "14px".',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_global_sidebar_settings',
      ),
      
      array(
        'id'          => 'ut_global_sidebar_widgets_link_color',
        'label'       => 'Sidebar Link Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_global_sidebar_settings',
      ),
      
      array(
        'id'          => 'ut_global_sidebar_widgets_link_color_hover',
        'label'       => 'Sidebar Link Hover Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_global_sidebar_settings',
      ),
      
      array(
        'id'          => 'ut_global_sidebar_widgets_icon_color',
        'label'       => 'Sidebar Icons Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_global_sidebar_settings',
      ),
      
      array(
        'id'          => 'ut_global_sidebar_widgets_icon_color_hover',
        'label'       => 'Sidebar Icons Hover Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_global_sidebar_settings',
      ),
      
      array(
        'id'          => 'ut_global_sidebar_widgets_border_color',
        'label'       => 'Sidebar Border Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_global_sidebar_settings',
      ),
      
      array(
        'id'          => 'ut_global_sidebar_widgets_border_color_hover',
        'label'       => 'Sidebar Border Hover Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_global_sidebar_settings',
      ),
      
      
      /*
      |--------------------------------------------------------------------------
      | Footer
      |--------------------------------------------------------------------------
      */
            
      array(
        'id'          => 'ut_footer_settings_menu',
        'subid'       => 'ut_footer_settings',
        'label'       => 'Footer',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings'
      ),
      
      array(
        'id'          => 'ut_footer_setting_headline',
        'label'       => 'Footer Color Skin',
        'desc'        => '<h2 class="section-headline">Footer Color Skin</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_skin',
        'label'       => 'Footer Color Skin',
        'desc'        => 'This option is deprecated and is only maintained due to compatibility reasons for older Brooklyn Versions. Please use the color options below.',
        'type'        => 'select_group',
        'toplevel'    => true,
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
        'std'         => 'ut-footer-light',
        'choices'     => array(           
          array(
            'value'       => 'ut-footer-dark',
            'for'         => array(
                'ut_footer_skin_dark_bgcolor'
            ),
            'label'       => 'Dark'
          ),
          array(
            'value'       => 'ut-footer-light',
            'for'         => array(
                'ut_footer_skin_light_bgcolor'
            ),
            'label'       => 'Light'
          ),
          array(
            'value'       => 'ut-footer-custom',
            'for'         => array(
                'ut_footer_color_cs_settings_headline',
                'ut_footer_skin_border',
                'ut_footer_widgets_text_color',
                'ut_footer_widgets_text_font_size',
                'ut_footer_widgets_link_color',
                'ut_footer_widgets_link_color_hover',
                'ut_footer_widgets_icon_color',
                'ut_footer_widgets_icon_color_hover',
                'ut_footer_widgets_border_color',
                'ut_footer_widgets_border_color_hover',
                'ut_footer_scroll_up_settings_headline',
                'ut_show_scroll_up_button',
                'ut_scroll_up_button_icon_color',
                'ut_scroll_up_button_icon_color_hover',
                'ut_scroll_up_button_background_color',
                'ut_scroll_up_button_shadow',
                'ut_scroll_up_button_border_radius'
            ),
            'label'       => 'Custom Skin'
          )           
        ),
      ),      
      
      array(
        'id'          => 'ut_footer_skin_dark_bgcolor',
        'label'       => 'Footer Skin Background Color',
        'desc'        => '<strong>(optional)</strong> - set an alternative background color for your footer, since the base skin is dark, we recommend to use a dark color as well.',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_skin_light_bgcolor',
        'label'       => 'Footer Skin Background Color',
        'desc'        => '<strong>(optional)</strong> - set an alternative background color for your footer, since the base skin is light, we recommend to use a bright color as well.',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_color_cs_settings_headline',
        'label'       => 'Individual Footer Colors',
        'desc'        => '<h2 class="section-headline">Custom Skin Footer Colors</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_skin_border',
        'label'       => 'Footer Top Border Color',
        'desc'        => '<strong>(optional)</strong> - once set, a thin border get\' applied to the top of your footer.',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_widgets_text_color',
        'label'       => 'Footer Text Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_widgets_text_font_size',
        'label'       => 'Footer Text Font Size',
        'type'        => 'text',
        'desc'        => 'Value in px: e.g. "14px".',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_widgets_link_color',
        'label'       => 'Footer Link Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_widgets_link_color_hover',
        'label'       => 'Footer Link Hover Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_widgets_icon_color',
        'label'       => 'Footer Icons Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_widgets_icon_color_hover',
        'label'       => 'Footer Icons Hover Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_widgets_border_color',
        'label'       => 'Footer Border Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_footer_widgets_border_color_hover',
        'label'       => 'Footer Border Hover Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),      
      
      array(
        'id'          => 'ut_footer_scroll_up_settings_headline',
        'label'       => 'Scroll Top Button',
        'desc'        => '<h2 class="section-headline">Scroll Top Button</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_show_scroll_up_button',
        'label'       => 'Scroll To Top Button',
        'desc'        => 'Display "Scroll To Top" button? You can change the state of this button individually on each page.', 
        'type'        => 'select_group',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
        'std'         => 'on',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'for'         => array(
                'ut_scroll_up_button_icon_color',
                'ut_scroll_up_button_icon_color_hover',
                'ut_scroll_up_button_background_color',
                'ut_scroll_up_button_shadow',
                'ut_scroll_up_button_border_radius'
            ),
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
        'id'          => 'ut_scroll_up_button_icon_color',
        'label'       => 'Scroll Up Icon Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
       array(
        'id'          => 'ut_scroll_up_button_icon_color_hover',
        'label'       => 'Scroll Up Icon Hover Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_scroll_up_button_background_color',
        'label'       => 'Scroll Up Background Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
      ),
      
      array(
        'id'          => 'ut_scroll_up_button_shadow',
        'label'       => 'Display Scroll Up Button Shadow?',
        'type'        => 'select',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
        'std'         => 'on',
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
        'id'          => 'ut_scroll_up_button_border_radius',
        'label'       => 'Display Scroll Up Button Border Radius?',
        'type'        => 'select',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_footer_settings',
        'std'         => 'on',
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
      
      /*
      |--------------------------------------------------------------------------
      | Sub Footer
      |--------------------------------------------------------------------------
      */
            
      array(
        'id'          => 'ut_subfooter_settings_menu',
        'subid'       => 'ut_subfooter_settings',
        'label'       => 'Subfooter',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings'
      ),
      
      array(
        'id'          => 'ut_subfooter_setting_headline',
        'label'       => 'Subfooter',
        'desc'        => '<h2 class="section-headline">Subfooter</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
      ),
      
      array(
        'id'          => 'ut_subfooter_padding_top',
        'label'       => 'Subfooter Spacing Top',
        'desc'        => '<strong>(optional)</strong> - value in pixel e.g. 10px. Default: 0px. If <strong>Subfooter Background Color</strong> has been set, default is: 20px.',
        'type'        => 'text',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
      ),      
                  
      array(
        'id'          => 'ut_site_copyright',
        'label'       => 'Copyright',
        'desc'        => 'Adds an additional copyright to the footer of this theme.',
        'type'        => 'textarea-simple',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
        'rows'        => '3'
      ),     
      
      array(
        'id'          => 'ut_subfooter_font_weight',
        'label'       => 'Subfooter Copyright Font Weight',
        'desc'        => '',
        'type'        => 'select',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
        'std'          => 'normal',
        'choices'     => array( 
          array(
            'value'       => 'normal',
            'label'       => 'Normal'
          ),
          array(
            'value'       => 'bold',
            'label'       => 'Bold'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_footer_social_icons',
        'label'       => 'Social Icons',
        'type'        => 'list-item',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
        'settings'    => array( 
          array(
            'id'          => 'icon',
            'label'       => 'Icon',
            'type'        => 'select',
            'choices'     => array( 
                  array(
                    'value'       => 'fa-adn',
                    'label'       => 'Alpha'                    
                  ),
                  array(
                    'value'       => 'fa-behance',
                    'label'       => 'Behance'                    
                  ),
                  array(
                    'value'       => 'fa-bitbucket',
                    'label'       => 'Bitbucket'                    
                  ),
                  array(
                    'value'       => 'fa-codepen',
                    'label'       => 'Codepen'                    
                  ),
                  array(
                    'value'       => 'fa-delicious',
                    'label'       => 'Delicious'                    
                  ),
                  array(
                    'value'       => 'fa-deviantart',
                    'label'       => 'Deviantart'                    
                  ),
                  array(
                    'value'       => 'fa-digg',
                    'label'       => 'Digg'                    
                  ),
                  array(
                    'value'       => 'fa-dribbble',
                    'label'       => 'Dribbble'
                  ),
                  array(
                    'value'       => 'fa-dropbox',
                    'label'       => 'Dropbox'
                  ),
                  array(
                    'value'       => 'fa-facebook',
                    'label'       => 'Facebook'
                  ),
                  array(
                    'value'       => 'fa-flickr',
                    'label'       => 'Flickr'
                  ),
                  array(
                    'value'       => 'fa-foursquare',
                    'label'       => 'Foursquare'
                  ),                  
                  array(
                    'value'       => 'fa-github',
                    'label'       => 'Github'
                  ),
                  array(
                    'value'       => 'fa-gittip',
                    'label'       => 'Gittip'
                  ),
                  array(
                    'value'       => 'fa-google-plus',
                    'label'       => 'Google Plus'
                  ),
                  array(
                    'value'       => 'fa-instagram',
                    'label'       => 'Instagram'
                  ),
                  array(
                    'value'       => 'fa-jsfiddle',
                    'label'       => 'JSFiddle'
                  ),
                  array(
                    'value'       => 'fa-linkedin',
                    'label'       => 'LinkedIn'
                  ),
                  array(
                    'value'       => 'fa-reddit',
                    'label'       => 'Reddit'
                  ),
                  array(
                    'value'       => 'fa-pinterest',
                    'label'       => 'Pinterest'
                  ),
                  array(
                    'value'       => 'fa-skype',
                    'label'       => 'Skype'
                  ),
                  array(
                    'value'       => 'fa-soundcloud',
                    'label'       => 'Soundcloud'
                  ),
                  array(
                    'value'       => 'fa-tumblr',
                    'label'       => 'Tumblr'
                  ),
                  array(
                    'value'       => 'fa-twitter',
                    'label'       => 'Twitter'
                  ),
                  array(
                    'value'       => 'fa-vimeo-square',
                    'label'       => 'Vimeo'
                  ),
                  array(
                    'value'       => 'fa-vk',
                    'label'       => 'VK'
                  ),
                  array(
                    'value'       => 'fa-xing',
                    'label'       => 'Xing'
                  ),
                  array(
                    'value'       => 'fa-youtube',
                    'label'       => 'Youtube'
                  ),
                  array(
                    'value' => 'fa-spotify',
                    'label' => 'Spotify'
                  ),
                  

            ),
          ),
          array(
            'id'          => 'link',
            'label'       => 'Link',
            'type'        => 'text',
            'rows'        => '3'
          )
        )
      ),
      
      array(
        'id'          => 'ut_subfooter_color_setting_headline',
        'label'       => 'Subfooter Colors',
        'desc'        => '<h2 class="section-headline">Subfooter Colors</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
      ),
      
      array(
        'id'          => 'ut_subfooter_bgcolor',
        'label'       => 'Subfooter Background Color',
        'desc'        => '<strong>(optional)</strong> - set an alternative background color for your subfooter.',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
      ),
      
      array(
        'id'          => 'ut_subfooter_text_color',
        'label'       => 'Subfooter Text Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
      ),
      
      array(
        'id'          => 'ut_subfooter_link_color',
        'label'       => 'Subfooter Link Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
      ),
      
      array(
        'id'          => 'ut_subfooter_link_color_hover',
        'label'       => 'Subfooter Link Hover Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
      ),
      
      array(
        'id'          => 'ut_subfooter_icon_color',
        'label'       => 'Subfooter Icon Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
      ),
      
      array(
        'id'          => 'ut_subfooter_headline_color',
        'label'       => 'Subfooter Headline Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_general_settings',
        'subsection'  => 'ut_subfooter_settings',
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Typography - Body
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_global_body_menu',
        'subid'       => 'ut_global_body_settings',
        'label'       => 'Body',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings'
      ),
      
      array(
        'id'          => 'ut_global_body_headline',
        'label'       => 'Body Font Face',
        'desc'        => '<h2 class="section-headline">Body Font Face</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_body_settings',
      ),
      
      array(
        'id'          => 'ut_body_font_type',
        'label'       => 'Choose Font Source',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_body_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'         => array('ut_body_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_body_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_google_body_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),    
      
      array(
        'id'          => 'ut_body_font_color',
        'label'       => 'Body Font Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_body_settings'
      ),
         
      array(
        'id'          => 'ut_google_body_font_style',
        'label'       => 'Body Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_body_settings'
      ),
      
      array(
        'id'          => 'ut_body_font_style',
        'label'       => 'Body Font Style',
        'desc'        => '<strong>(optional)</strong> - default regular. <a href="#" class="ut-font-preview">Preview Theme Font Style</a>',
        'std'         => 'regular',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_body_settings',
        'choices'     => array( 
          array(
            'value'       => 'extralight',

            'label'       => 'Extralight'
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
        'id'          => 'ut_body_websafe_font_style',
        'label'       => 'Body Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_body_settings'
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Typography - Navigation
      |--------------------------------------------------------------------------
      */
       
      array(
        'id'          => 'ut_global_navigation_menu',
        'subid'       => 'ut_global_navigation_menu_settings',
        'label'       => 'Header and Navigation',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
      ), 
      
      array(
        'id'          => 'ut_global_header_headline',
        'label'       => 'Header Logo Font',
        'desc'        => '<h2 class="section-headline">Header Text Logo Font</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_navigation_menu_settings',
      ),
      
      array(
        'id'          => 'ut_global_header_text_logo_websafe_font_style',
        'label'       => 'Header Text Logo Font Setting',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_navigation_menu_settings',
      ),
      
      array(
        'id'          => 'ut_global_navigation_headline',
        'label'       => 'Navigation Font',
        'desc'        => '<h2 class="section-headline">Navigation Font</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_navigation_menu_settings',
      ),
      
      array(
        'id'          => 'ut_global_navigation_font_type',
        'label'       => 'Choose Font Source',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_navigation_menu_settings',
        'std'         => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'         => array(
                'ut_global_navigation_font_style'
            ),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array(
                'ut_global_navigation_websafe_font_style'
            ),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'         => array(
                'ut_global_navigation_google_font_style'
            ),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_navigation_google_font_style',
        'label'       => 'Navigation Font Style',
        'desc'        => 'Font Settings will be applied to mobile menu as well.',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_navigation_menu_settings',
      ),
      
      array(
        'id'          => 'ut_global_navigation_websafe_font_style',
        'label'       => 'Navigation Font Style',
        'desc'        => 'Font Settings will be applied to mobile menu as well.',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_navigation_menu_settings',
      ),
      
      array(
        'id'          => 'ut_global_navigation_font_style',
        'label'       => 'Navigation Font Style',
        'desc'        => 'Font Settings will be applied to mobile menu as well. <a href="#" class="ut-font-preview">Blockquote Font Styles</a>',
        'type'        => 'select',
        'std'         => 'semibold',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_navigation_menu_settings',
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
        'id'          => 'ut_global_navigation_submenu_font_style',
        'label'       => 'Navigation Submenu Font Setting',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_navigation_menu_settings',
      ),
      
      array(
        'id'          => 'ut_global_mobile_navigation_font_style',
        'label'       => 'Mobile Navigation Font Setting',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_navigation_menu_settings',
      ),
            
      /*
      |--------------------------------------------------------------------------
      | Hero Front Font Style
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_front_hero_font_style_menu',
        'subid'       => 'ut_front_hero_font_style_settings',
        'label'       => 'Front Page Hero',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings'
      ),
      
      array(
        'id'          => 'ut_front_hero_font_style_headline',
        'label'       => 'Front Page Hero Font Face',
        'desc'        => '<h2 class="section-headline">Front Page Hero Font Face</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_front_hero_font_style_settings',
      ),
      
      array(
        'id'          => 'ut_front_hero_font_type',
        'label'       => 'Choose Font Source',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_front_hero_font_style_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'         => array('ut_front_page_hero_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_front_page_hero_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'         => array('ut_google_front_page_hero_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ), 
      
     array(
        'id'          => 'ut_google_front_page_hero_font_style',
        'label'       => 'Hero Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_front_hero_font_style_settings'
      ),
      
      array(
        'id'          => 'ut_front_page_hero_font_style',
        'label'       => 'Hero Font Style',
        'desc'        => '<a href="#" class="ut-font-preview">Preview Font Styles</a>',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_front_hero_font_style_settings',
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
        'id'          => 'ut_front_page_hero_font_size',
        'label'       => 'Hero Caption Title Font Size',
        'desc'        => 'This option only affects Desktop view, Mobile and Tablet views are not affected. Value in em: e.g. "6em".',
        'type'        => 'text',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_front_hero_font_style_settings',
      ), 
      
      array(
        'id'          => 'ut_front_page_hero_websafe_font_style',
        'label'       => 'Hero Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_front_hero_font_style_settings'
      ),
      
      
      
      /*
      |--------------------------------------------------------------------------
      | Hero Blog Font Style
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_blog_font_style_menu',
        'subid'       => 'ut_blog_font_style_settings',
        'label'       => 'Blog Hero',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings'
      ),
      
      array(
        'id'          => 'ut_blog_font_style_headline',
        'label'       => 'Blog Hero Font Face',
        'desc'        => '<h2 class="section-headline">Blog Hero Font Face</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_blog_font_style_settings',
      ),
       
      array(
        'id'          => 'ut_blog_hero_font_type',
        'label'       => 'Choose Font Source',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_blog_font_style_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'         => array('ut_blog_hero_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_blog_hero_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'         => array('ut_google_blog_hero_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ), 
      
      array(
        'id'          => 'ut_google_blog_hero_font_style',
        'label'       => 'Hero Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_blog_font_style_settings'
      ),
      
      array(
        'id'          => 'ut_blog_hero_font_style',
        'label'       => 'Hero Font Style',
        'desc'        => '<a href="#" class="ut-font-preview">Preview Font Styles</a>',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_blog_font_style_settings',
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
        'id'          => 'ut_blog_hero_font_size',
        'label'       => 'Hero Caption Title Font Size',
        'desc'        => 'This option only affects Desktop view, Mobile and Tablet views are not affected. Value in em: e.g. "6em".',
        'type'        => 'text',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_blog_font_style_settings',
      ),
      
      array(
        'id'          => 'ut_blog_hero_websafe_font_style',
        'label'       => 'Hero Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_blog_font_style_settings',
      ),
      
      
      /*
      |--------------------------------------------------------------------------
      | Global Headline Font Styles
      |--------------------------------------------------------------------------
      */
      array(
        'id'          => 'ut_global_htags_menu',
        'subid'       => 'ut_global_htags_settings',
        'label'       => 'General Headlines',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings'
      ),
      
      array(
        'id'          => 'ut_global_htags_headline_h1',
        'label'       => 'H1',
        'desc'        => '<h2 class="section-headline">H1</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
      ),
      
      array(
        'id'          => 'ut_global_h1_font_type',
        'label'       => 'Choose font source for H1 tags',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array('ut_h1_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_h1_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_h1_google_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_h1_font_color',
        'label'       => 'Content H1 Font Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ),
      
      array(
        'id'          => 'ut_h1_google_font_style',
        'label'       => 'Content H1 Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ), 
      
      array(
        'id'          => 'ut_h1_websafe_font_style',
        'label'       => 'Content H1 Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ), 
      
      array(
        'id'          => 'ut_h1_font_style',
        'label'       => 'Content H1 Font Style',
        'desc'        => '<strong>(optional)</strong> - default semibold. This option will affect content headlines. <a href="#" class="ut-font-preview">Preview Font Style</a>',
        'std'         => 'semibold',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'choices'     => array( 
          array(
            'value'       => 'extralight',
            'label'       => 'Extralight'
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
        'id'          => 'ut_global_htags_headline_h2',
        'label'       => 'H2',
        'desc'        => '<h2 class="section-headline">H2</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
      ),
      
      array(
        'id'          => 'ut_global_h2_font_type',
        'label'       => 'Choose font source for H2 tags',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array('ut_h2_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_h2_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_h2_google_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_h2_font_color',
        'label'       => 'Content H2 Font Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ),
      
      array(
        'id'          => 'ut_h2_google_font_style',
        'label'       => 'Content H2 Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ), 
      
      array(
        'id'          => 'ut_h2_websafe_font_style',
        'label'       => 'Content H2 Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ),
      
      array(
        'id'          => 'ut_h2_font_style',
        'label'       => 'Content H2 Font Style',
        'desc'        => '<strong>(optional)</strong> - default semibold. This option will affect content headlines. <a href="#" class="ut-font-preview">Preview Font Style</a>',
        'std'         => 'semibold',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'choices'     => array( 
          array(
            'value'       => 'extralight',
            'label'       => 'Extralight'
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
        'id'          => 'ut_global_htags_headline_h3',
        'label'       => 'H3',
        'desc'        => '<h2 class="section-headline">H3</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
      ),
            
      array(
        'id'          => 'ut_global_h3_font_type',
        'label'       => 'Choose font source for H3 tags',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array('ut_h3_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_h3_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_h3_google_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_h3_font_color',
        'label'       => 'Content H3 Font Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ),
      
      array(
        'id'          => 'ut_h3_google_font_style',
        'label'       => 'Content H3 Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ), 
      
      array(
        'id'          => 'ut_h3_websafe_font_style',
        'label'       => 'Content H3 Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ), 
      
      array(
        'id'          => 'ut_h3_font_style',
        'label'       => 'Content H3 Font Style',
        'desc'        => '<strong>(optional)</strong> - default semibold. This option will affect content headlines. <a href="#" class="ut-font-preview">Preview Font Style</a>',
        'std'         => 'semibold',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'choices'     => array( 
          array(
            'value'       => 'extralight',
            'label'       => 'Extralight'
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
        'id'          => 'ut_global_htags_headline_h4',
        'label'       => 'H4',
        'desc'        => '<h2 class="section-headline">H4</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
      ),
      
      array(
        'id'          => 'ut_global_h4_font_type',
        'label'       => 'Choose font source for H4 tags',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array('ut_h4_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_h4_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_h4_google_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_h4_font_color',
        'label'       => 'Content H4 Font Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ),
      
      array(
        'id'          => 'ut_h4_google_font_style',
        'label'       => 'Content H4 Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ), 
      
      array(
        'id'          => 'ut_h4_websafe_font_style',
        'label'       => 'Content H4 Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ),
      
      array(
        'id'          => 'ut_h4_font_style',
        'label'       => 'Content H4 Font Style',
        'desc'        => '<strong>(optional)</strong> - default semibold. This option will affect content headlines. <a href="#" class="ut-font-preview">Preview Font Style</a>',
        'std'         => 'semibold',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'choices'     => array( 
          array(
            'value'       => 'extralight',
            'label'       => 'Extralight'
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
        'id'          => 'ut_global_htags_headline_h5',
        'label'       => 'H5',
        'desc'        => '<h2 class="section-headline">H5</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
      ),
            
      array(
        'id'          => 'ut_global_h5_font_type',
        'label'       => 'Choose font source for H5 tags',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array('ut_h5_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_h5_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_h5_google_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_h5_font_color',
        'label'       => 'Content H5 Font Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ),
      
      array(
        'id'          => 'ut_h5_google_font_style',
        'label'       => 'Content H5 Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ), 
      
      array(
        'id'          => 'ut_h5_websafe_font_style',
        'label'       => 'Content H5 Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ),
      
      array(
        'id'          => 'ut_h5_font_style',
        'label'       => 'Content H5 Font Style',
        'desc'        => '<strong>(optional)</strong> - default semibold. This option will affect content headlines. <a href="#" class="ut-font-preview">Preview Font Style</a>',
        'std'         => 'semibold',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'choices'     => array( 
          array(
            'value'       => 'extralight',
            'label'       => 'Extralight'
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
        'id'          => 'ut_global_htags_headline_h6',
        'label'       => 'H6',
        'desc'        => '<h2 class="section-headline">H6</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
      ),
      
      array(
        'id'          => 'ut_global_h6_font_type',
        'label'       => 'Choose font source for H6 tags',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array('ut_h6_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_h6_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_h6_google_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_h6_font_color',
        'label'       => 'Content H6 Font Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ),
      
      array(
        'id'          => 'ut_h6_google_font_style',
        'label'       => 'Content H6 Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ), 
      
      array(
        'id'          => 'ut_h6_websafe_font_style',
        'label'       => 'Content H6 Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings'
      ),
      
      array(
        'id'          => 'ut_h6_font_style',
        'label'       => 'Content H6 Font Style',
        'desc'        => '<strong>(optional)</strong> - default semibold. This option will affect content headlines. <a href="#" class="ut-font-preview">Preview Font Style</a>',
        'std'         => 'semibold',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_htags_settings',
        'choices'     => array( 
          array(
            'value'       => 'extralight',
            'label'       => 'Extralight'
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
      
      /*
      |--------------------------------------------------------------------------
      | Global Header Typography and Styles
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_global_header_menu',
        'subid'       => 'ut_global_header_settings',
        'label'       => 'General Section Headlines',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings'
      ),
      
      array(
        'id'          => 'ut_global_header_styles_headline',
        'label'       => 'General Section Headlines',
        'desc'        => '<h2 class="section-headline">General Section Headlines</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
      ),
      
      array(
        'id'          => 'ut_global_headline_style',
        'label'       => 'General Section Headlines Style',
        'desc'        => '<strong>(optional)</strong> - default "Style One". This option will affect section and single page headers. <br /> <strong>Keep in mind: You can change the header style individually for each page!</strong> <a href="#" class="ut-header-preview">Preview Header Styles</a>',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
        'choices'     => array( 
          
          array(
            'value'       => 'pt-style-1',
            'label'       => 'Style One'
          ),
          
          array(
            'value'       => 'pt-style-2',
            'for'         => array(
                            'ut_global_headline_style_2_color',
                            'ut_global_headline_style_2_height',
                            'ut_global_headline_style_2_width'
                          ),
            'label'       => 'Style Two'
          ),
          
          array(
            'value'       => 'pt-style-3',
            'label'       => 'Style Three'
          ),
          
          array(
            'value'       => 'pt-style-4',
            'label'       => 'Style Four'
          ),
          
          array(
            'value'       => 'pt-style-5',
            'label'       => 'Style Five'
          ),
          
          array(
            'value'       => 'pt-style-6',
            'label'       => 'Style Six'
          ),
          
          array(
            'value'       => 'pt-style-7',
            'label'       => 'Style Seven'
          )
          
        ),
      ),
      
      array(
        'id'          => 'ut_global_headline_style_2_color',
        'label'       => 'Style Two Decoration Line Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
        'std'         => '#222222'
      ),
      
      array(
        'id'          => 'ut_global_headline_style_2_height',
        'label'       => 'Style Two Decoration Line Height',
        'desc'        => '<strong>(optional)</strong> - value in px , default: 1px',
        'type'        => 'text',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
        'std'         => ''
      ),
      
      array(
        'id'          => 'ut_global_headline_style_2_width',
        'label'       => 'Style Two Decoration Line Width',
        'desc'        => '<strong>(optional)</strong> - value in % or px , default: 30px',
        'type'        => 'text',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
        'std'         => ''
      ),
      
      array(
        'id'          => 'ut_global_headline_width',
        'label'       => 'Header Width',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
        'type'        => 'select',
        'choices'     => array(                     
          array(
            'label'       => '7/10 (center)',
            'value'       => 'seven'
          ),
          array(
            'label'       => '10/10 (fullwidth)',
            'value'       => 'ten'
          )
        ),
        'std'         => 'seven'
       ),
      
      array(
        'id'          => 'ut_global_headline_align',
        'label'       => 'Header Text Alignment',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
        'type'        => 'select',
        'choices'     => array(                     
          array(
            'label'       => 'Center',
            'value'       => 'center'
          ),
          array(
            'label'       => 'Left',
            'value'       => 'left'
          ),
        ),
        'std'         => 'center'
      ),
            
      array(
        'id'          => 'ut_global_header_font_headline',
        'label'       => 'General Section Headlines Font Face',
        'desc'        => '<h2 class="section-headline">General Section Headlines Font Face</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
      ),
      
      array(
        'id'          => 'ut_global_headline_font_type',
        'label'       => 'Choose Font Source',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array('ut_global_headline_font_style', 'ut_global_headline_font_style_settings'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_global_headline_websafe_font_style_settings'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_global_google_headline_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_headline_font_color',
        'label'       => 'General Section Headlines Font Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings'
      ),
      
      array(
        'id'          => 'ut_global_google_headline_font_style',
        'label'       => 'General Section Headlines Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings'
      ), 
      
      array(
        'id'          => 'ut_global_headline_font_style',
        'label'       => 'General Section Headlines Font Style',
        'desc'        => '<strong>(optional)</strong> - default semibold. This option will affect section and single page headers. <br /> <strong>Keep in mind: You can change the header font style individually for each page!</strong> <a href="#" class="ut-font-preview">Preview Font Style</a>',
        'std'         => 'semibold',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
        'choices'     => array( 
          array(
            'value'       => 'extralight',
            'label'       => 'Extralight'
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
        'id'          => 'ut_global_headline_font_style_settings',
        'label'       => 'General Section Title Font Settings',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings'
      ),
      
      array(
        'id'          => 'ut_global_headline_websafe_font_style_settings',
        'label'       => 'General Section Title Font Settings',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings'
      ),
      
      
      /*
      |--------------------------------------------------------------------------
      | Global Page Titles Typography and Styles
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_global_page_title_menu',
        'subid'       => 'ut_global_page_title_settings',
        'label'       => 'General Page Title',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings'
      ),
      
      array(
        'id'          => 'ut_global_page_header_styles_headline',
        'label'       => 'General Page Title',
        'desc'        => '<h2 class="section-headline">General Page Title</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
      ),
      
      array(
        'id'          => 'ut_global_page_headline_style',
        'label'       => 'General Page Title Style',
        'desc'        => '<strong>(optional)</strong> - default "Style One". This option will affect single page titles. <br /> <strong>Keep in mind: You can change the header style individually for each page!</strong> <a href="#" class="ut-header-preview">Preview Header Styles</a>',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
        'choices'     => array( 
          
          array(
            'value'       => 'pt-style-1',
            'label'       => 'Style One'
          ),
          
          array(
            'value'       => 'pt-style-2',
            'for'         => array(
                            'ut_global_page_headline_style_2_color',
                            'ut_global_page_headline_style_2_height',
                            'ut_global_page_headline_style_2_width'
                          ),
            'label'       => 'Style Two'
          ),
          
          array(
            'value'       => 'pt-style-3',
            'label'       => 'Style Three'
          ),
          
          array(
            'value'       => 'pt-style-4',
            'label'       => 'Style Four'
          ),
          
          array(
            'value'       => 'pt-style-5',
            'label'       => 'Style Five'
          ),
          
          array(
            'value'       => 'pt-style-6',
            'label'       => 'Style Six'
          ),
          
          array(
            'value'       => 'pt-style-7',
            'label'       => 'Style Seven'
          )
          
        ),
      ),
      
      array(
        'id'          => 'ut_global_page_headline_style_2_color',
        'label'       => 'Style Two Decoration Line Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
        'std'         => '#222222'
      ),
      
      array(
        'id'          => 'ut_global_page_headline_style_2_height',
        'label'       => 'Style Two Decoration Line Height',
        'desc'        => '<strong>(optional)</strong> - value in px , default: 1px',
        'type'        => 'text',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
        'std'         => ''
      ),
      
      array(
        'id'          => 'ut_global_page_headline_style_2_width',
        'label'       => 'Style Two Decoration Line Width',
        'desc'        => '<strong>(optional)</strong> - value in % or px , default: 30px',
        'type'        => 'text',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
        'std'         => ''
      ),
      
      array(
        'id'          => 'ut_global_page_headline_width',
        'label'       => 'Header Width',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
        'type'        => 'select',
        'choices'     => array(                     
          array(
            'label'       => '7/10 (center)',
            'value'       => 'seven'
          ),
          array(
            'label'       => '10/10 (fullwidth)',
            'value'       => 'ten'
          )
        ),
        'std'         => 'seven'
       ),
      
      array(
        'id'          => 'ut_global_page_headline_align',
        'label'       => 'Header Text Alignment',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
        'type'        => 'select',
        'choices'     => array(                     
          array(
            'label'       => 'Center',
            'value'       => 'center'
          ),
          array(
            'label'       => 'Left',
            'value'       => 'left'
          ),
        ),
        'std'         => 'center'
      ),

      array(
        'id'          => 'ut_global_page_header_font_headline',
        'label'       => 'General Page Title Font Face',
        'desc'        => '<h2 class="section-headline">General Section Headlines Font Face</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
      ),
      
      array(
        'id'          => 'ut_global_page_headline_font_type',
        'label'       => 'Choose Font Source',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
        'std'         => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'         => array( 'ut_global_page_headline_font_style', 'ut_global_page_headline_font_style_settings' ),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_global_page_headline_websafe_font_style_settings'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_global_page_google_headline_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_page_headline_font_color',
        'label'       => 'General Page Title Font Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
      ),
      
      array(
        'id'          => 'ut_global_page_google_headline_font_style',
        'label'       => 'General Page Title Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings'
      ), 
      
      array(
        'id'          => 'ut_global_page_headline_font_style',
        'label'       => 'General Page Title Font Style',
        'desc'        => '<strong>(optional)</strong> - default semibold. This option will affect single page titles. <br /> <strong>Keep in mind: You can change the header font style individually for each page!</strong> <a href="#" class="ut-font-preview">Preview Font Style</a>',
        'std'         => 'semibold',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
        'choices'     => array( 
          array(
            'value'       => 'extralight',
            'label'       => 'Extralight'
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
        'id'          => 'ut_global_page_headline_font_style_settings',
        'label'       => 'General Page Title Font Settings',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
      ),
      
      array(
        'id'          => 'ut_global_page_headline_websafe_font_style_settings',
        'label'       => 'General Page Title Font Settings',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_page_title_settings',
      ),      
      
      /*
      |--------------------------------------------------------------------------
      | Global Header Lead  Typography and Styles
      |--------------------------------------------------------------------------
      */
       
      array(
        'id'          => 'ut_global_lead_menu',
        'subid'       => 'ut_global_lead_settings',
        'label'       => 'General Section Leads',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings'
      ),
      
      array(
        'id'          => 'ut_global_lead_headline',
        'label'       => 'General Section Leads',
        'desc'        => '<h2 class="section-headline">General Section Leads</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_lead_settings',
      ),
      
      array(
        'id'          => 'ut_global_lead_font_type',
        'label'       => 'Choose Font Source',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_lead_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array('ut_lead_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_lead_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_google_lead_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_lead_color',
        'label'       => 'Global Section Lead Color',
        'desc'        => 'Can be overwritten by Page and Section Settings.',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_lead_settings'
      ),      
      
      array(
        'id'          => 'ut_google_lead_font_style',
        'label'       => 'General Section Leads Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_lead_settings'
      ),
      
      array(
        'id'          => 'ut_lead_websafe_font_style',
        'label'       => 'General Section Leads Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_lead_settings'
      ),  
      
      array(
        'id'          => 'ut_lead_font_style',
        'label'       => 'General Section Leads Font Style',
        'desc'        => '<a href="#" class="ut-font-preview">General Section Leads Font Style</a>',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_lead_settings',
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
      
      /*
      |--------------------------------------------------------------------------
      | Portolio Hover
      |--------------------------------------------------------------------------
      */
       
      array(
        'id'          => 'ut_global_portfolio_menu',
        'subid'       => 'ut_global_portfolio_settings',
        'label'       => 'Portfolio Showcase',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings'
      ),
      
      array(
        'id'          => 'ut_global_portfolio_title_headline',
        'label'       => 'Portfolio Title',
        'desc'        => '<h2 class="section-headline">Portfolio Hover Title</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_portfolio_settings',
      ),
      
      array(
        'id'          => 'ut_global_portfolio_title_color',
        'label'       => 'Portfolio Title Color',
        'desc'        => 'Can be overwritten by Showcase Settings.',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_portfolio_settings'
      ),       
      
         
      
      array(
        'id'          => 'ut_global_portfolio_title_font_type',
        'label'       => 'Choose Font Source',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_portfolio_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array(''),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_websafe_portfolio_title_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_google_portfolio_title_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_google_portfolio_title_font_style',
        'label'       => 'Portfolio Title Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_portfolio_settings'
      ),
      
      array(
        'id'          => 'ut_websafe_portfolio_title_font_style',
        'label'       => 'Portfolio Title Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_portfolio_settings'
      ),
      
      array(
        'id'          => 'ut_global_portfolio_category_headline',
        'label'       => 'Portfolio Hover Category',
        'desc'        => '<h2 class="section-headline">Portfolio Hover Category</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_portfolio_settings',
      ),      
      
      array(
        'id'          => 'ut_global_portfolio_category_color',
        'label'       => 'Portfolio Hover Category Color',
        'desc'        => 'Can be overwritten by Showcase Settings.',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_portfolio_settings'
      ),
      
      array(
        'id'          => 'ut_global_portfolio_category_font_type',
        'label'       => 'Choose Font Source',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_portfolio_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array(''),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_websafe_portfolio_category_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_google_portfolio_category_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_google_portfolio_category_font_style',
        'label'       => 'Category Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_portfolio_settings'
      ),
      
      array(
        'id'          => 'ut_websafe_portfolio_category_font_style',
        'label'       => 'Category Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_portfolio_settings'
      ), 
      
      
           
      
      /*
      |--------------------------------------------------------------------------
      | Contact Section Header Font Style
      |--------------------------------------------------------------------------
      */
      array(
        'id'          => 'ut_csection_header_font_menu',
        'subid'       => 'ut_csection_header_font_setting',
        'label'       => 'Contact Section Header',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings'
      ),
      
      array(
        'id'          => 'ut_csection_header_font_headline',
        'label'       => 'Contact Section Header',
        'desc'        => '<h2 class="section-headline">Contact Section Header</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_csection_header_font_setting',
      ),
      
      array(
        'id'          => 'ut_csection_header_font_type',
        'label'       => 'Choose font source for Header',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_csection_header_font_setting',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array('ut_csection_header_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_csection_header_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_csection_header_google_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_csection_header_google_font_style',
        'label'       => 'Header Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_csection_header_font_setting'
      ),
      
      array(
        'id'          => 'ut_csection_header_websafe_font_style',
        'label'       => 'Header Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_csection_header_font_setting'
      ),  
      
      array(
        'id'          => 'ut_csection_header_font_style',
        'label'       => 'Header Font Style',
        'desc'        => '<strong>(optional)</strong> - default : Typography -> General Headlines. <a href="#" class="ut-font-preview">Preview Font Styles</a>',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_csection_header_font_setting',
        'choices'     => array( 
          
          array(
            'label'       => 'Default',
            'value'       => 'global'
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
      
      /*
      |--------------------------------------------------------------------------
      | Typography - Blockquote
      |--------------------------------------------------------------------------
      */
       
      array(
        'id'          => 'ut_global_blockquote_menu',
        'subid'       => 'ut_global_blockquote_settings',
        'label'       => 'Blockquotes',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings'
      ),
      
      array(
        'id'          => 'ut_global_blockquote_headline',
        'label'       => 'Blockquotes Font Face',
        'desc'        => '<h2 class="section-headline">Blockquotes Font Face</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blockquote_settings',
      ),
      
      array(
        'id'          => 'ut_blockquote_font_type',
        'label'       => 'Choose Font Source',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blockquote_settings',
        'std'         => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'         => array('ut_blockquote_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_blockquote_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'         => array('ut_google_blockquote_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_blockquote_headline_color',
        'label'       => 'Global Blockquote Font Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blockquote_settings',
      ),
      
      array(
        'id'          => 'ut_google_blockquote_font_style',
        'label'       => 'Blockquote Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blockquote_settings'
      ),
      
      array(
        'id'          => 'ut_blockquote_websafe_font_style',
        'label'       => 'Blockquote Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blockquote_settings'
      ),
      
      array(
        'id'          => 'ut_blockquote_font_style',
        'label'       => 'Blockquote Font Style',
        'desc'        => '<a href="#" class="ut-font-preview">Blockquote Font Styles</a>',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blockquote_settings',
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
      
      /*
      |--------------------------------------------------------------------------
      | Typography - Blog
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_global_blog_menu',
        'subid'       => 'ut_global_blog_menu_settings',
        'label'       => 'Blog',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
      ), 
      
      array(
        'id'          => 'ut_global_blog_settings_headline',
        'label'       => 'Blog',
        'desc'        => '<h2 class="section-headline">Blog</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blog_menu_settings',
      ),
      
      array(
        'id'          => 'ut_global_blog_titles_font_style',
        'label'       => 'Blog Posts Title Font Setting',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blog_menu_settings'
      ),
      
      array(
        'id'          => 'ut_global_blog_single_settings_headline',
        'label'       => 'Single Posts',
        'desc'        => '<h2 class="section-headline">Single Posts</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blog_menu_settings',
      ),
      
      array(
        'id'          => 'ut_global_blog_single_titles_font_style',
        'label'       => 'Single Post Title Font Setting',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blog_menu_settings'
      ),
      
      
      
      
      
      
      
      
      
      
      
      /*
      |--------------------------------------------------------------------------
      | Typography - Blog Sidebar
      |--------------------------------------------------------------------------
      */
       
      array(
        'id'          => 'ut_global_blog_widgets_menu',
        'subid'       => 'ut_global_blog_widgets_settings',
        'label'       => 'Sidebar',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
      ), 
      
      array(
        'id'          => 'ut_global_blog_widgets_headline',
        'label'       => 'Sidebar Widgets',
        'desc'        => '<h2 class="section-headline">Sidebar Widgets</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blog_widgets_settings',
      ),
      
      array(
        'id'          => 'ut_global_sidebar_widgets_headline_color',
        'label'       => 'Sidebar Widgets Headlines Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blog_widgets_settings',
      ),
      
      array(
        'id'          => 'ut_global_blog_widgets_headline_font_type',
        'label'       => 'Choose Font Source',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blog_widgets_settings',
        'std'         => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'         => array('ut_global_blog_widgets_headline_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_global_blog_widgets_headline_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'         => array('ut_global_blog_widgets_headline_google_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_global_blog_widgets_headline_google_font_style',
        'label'       => 'Blog Sidebar Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blog_widgets_settings',
      ),
      
      array(
        'id'          => 'ut_global_blog_widgets_headline_websafe_font_style',
        'label'       => 'Blog Sidebar Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blog_widgets_settings',
      ),
      
      array(
        'id'          => 'ut_global_blog_widgets_headline_font_style',
        'label'       => 'Blog Sidebar Font Style',
        'desc'        => '<a href="#" class="ut-font-preview">Blockquote Font Styles</a>',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_blog_widgets_settings',
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
        
      
      /*
      |--------------------------------------------------------------------------
      | Typography - Footer
      |--------------------------------------------------------------------------
      */
       
      array(
        'id'          => 'ut_global_footer_typo_menu',
        'subid'       => 'ut_global_footer_typo_settings',
        'label'       => 'Footer',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings'
      ),
      
      array(
        'id'          => 'ut_global_footer_widgets_headline',
        'label'       => 'Footer Widgets Settings',
        'desc'        => '<h2 class="section-headline">Footer Widgets</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_footer_typo_settings',
      ),
      
      array(
        'id'          => 'ut_footer_widgets_headline_color',
        'label'       => 'Footer Widgets Headlines Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_footer_typo_settings',
      ),
      
      array(
        'id'          => 'ut_footer_widgets_headline_font_type',
        'label'       => 'Choose font source',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_footer_typo_settings',
        'std'          => 'ut-font',
        'choices'     => array( 
          array(
            'value'       => 'ut-font',
            'for'          => array('ut_footer_widgets_headline_font_style'),
            'label'       => 'Theme Font'
          ),
          array(
            'value'       => 'ut-websafe',
            'for'         => array('ut_footer_widgets_headline_websafe_font_style'),
            'label'       => 'Web Safe Fonts'
          ),
          array(
            'value'       => 'ut-google',
            'for'          => array('ut_footer_widgets_headline_google_font_style'),
            'label'       => 'Google Font'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_footer_widgets_headline_google_font_style',
        'label'       => 'Footer Widgets Headlines Font Style',
        'type'        => 'googlefont',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_footer_typo_settings',
      ),
      
      array(
        'id'          => 'ut_footer_widgets_headline_websafe_font_style',
        'label'       => 'Footer Widgets Headlines Font Style',
        'type'        => 'typography',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_footer_typo_settings',
      ),  
      
      array(
        'id'          => 'ut_footer_widgets_headline_font_style',
        'label'       => 'Footer Widgets Headlines Font Style',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'select',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_footer_typo_settings',
        'choices'     => array( 
          
          array(
            'label'       => 'Default',
            'value'       => 'global'
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
        
      /*
      |--------------------------------------------------------------------------
      | Global Hero Settings 
      |--------------------------------------------------------------------------
      */ 
      array(
        'id'          => 'ut_global_hero_styling_menu',
        'subid'       => 'ut_global_hero_styling_settings',
        'label'       => 'Global Hero Styling',
        'type'        => 'section_headline',
        'section'     => 'ut_global_hero_settings',
      ), 
      
      array(
        'id'          => 'ut_global_hero_styling_headline',
        'label'       => 'Global Hero Styling',
        'desc'        => '<h2 class="section-headline">Global Hero Styling</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_global_hero_setting_Info',
        'label'       => 'Global Hero',
        'desc'        => 'These are your global Hero Styling settings for the entire site. However, in order to give you more freedom while individualizing your Brooklyn powered website. You can overwrite these settings by using the "Hero Styling" tab inside the Front Page or Blog Section as well as on single pages or portfolios. Means you can differentiate the visual appearance on different parts of your website.',
        'type'        => 'section_headline_info',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_global_hero_style',
        'label'       => 'Hero Style',
        'desc'        => 'Choose between 11 different hero header styles. If you are using a slider as your desired hero type, you can define an individual style for each slide. <a href="#" class="ut-hero-preview">Preview Hero Styles</a>',
        'type'        => 'select',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
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
        ) /* end choices */
      ),
      
      array(
        'id'          => 'ut_global_hero_align',
        'label'       => 'Choose Hero Alignment',
        'type'        => 'select',
        'desc'          => '',
        'std'          => 'center',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
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
        ) /* end choices */
      ),
      
      array(
        'id'          => 'ut_global_hero_overlay_settings_headline',
        'label'       => 'Global Hero Overlay Settings',
        'desc'        => '<h2 class="section-headline">Global Hero Overlay Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_global_hero_overlay',
        'label'       => 'Activate Hero Overlay?',
        'desc'        => '<strong>(optional)</strong>',
        'std'         => 'on',
        'toplevel'    => true,        
        'type'        => 'select_group',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
        'choices'     => array( 
            array(
                'value'       => 'on',
                'for'         => array(
                    'ut_global_hero_overlay_color',
                    'ut_global_hero_overlay_color_opacity',
                    'ut_global_hero_overlay_pattern',
                    'ut_global_hero_overlay_pattern_style'
                ),
                'label'       => 'yes, please!',
            ),
            array(
                'value'       => 'off',
                'for'         => array(
                    
                ),
                'label'       => 'no, thanks!'
            )
        ) /* end choices */
      ),
      
      array(
        'id'          => 'ut_global_hero_overlay_color',
        'label'       => 'Hero Overlay Color',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'colorpicker',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_global_hero_overlay_color_opacity',
        'label'       => 'Hero Overlay Color Opacity',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'numeric-slider',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
        'min_max_step'=> '0,1,0.1'
      ),  
      
      array(
        'id'          => 'ut_global_hero_overlay_pattern',
        'label'       => 'Activate Hero Overlay Pattern?',
        'desc'        => '<strong>(optional)</strong>',
        'std'         => 'on',
        'type'        => 'select',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
        'choices'     => array( 
            array(
                'value'       => 'on',
                'label'       => 'yes, please!'
            ),
            array(
                'value'       => 'off',
                'label'       => 'no, thanks!'
            )
        ) /* end choices */
      ),
      
      array(
        'id'          => 'ut_global_hero_overlay_pattern_style',
        'label'       => 'Hero Overlay Pattern Style',
        'desc'        => '<strong>(optional)</strong>',
        'std'         => 'style_one',
        'type'        => 'select',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
        'choices'     => array( 
            array(
                'value'       => 'style_one',
                'label'       => 'Style One'
            ),
            array(
                'value'       => 'style_two',
                'label'       => 'Style Two'
            )
        ) /* end choices */
      ),
      
      array(
        'id'          => 'ut_global_hero_overlay_effect_settings_headline',
        'label'       => 'Global Hero Overlay Effect Settings',
        'desc'        => '<h2 class="section-headline">Global Hero Overlay Effect Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_global_hero_overlay_effect',
        'label'       => 'Activate Overlay Animation Effect?',
        'desc'        => '<strong>(optional) Keep in mind, that this effect uses canvas objects for animation. Old Browsers do not support this feature!</strong>',
        'std'         => 'off',
        'type'        => 'select_group',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
        'choices'     => array( 
            array(
                'value'       => 'on',
                'for'         => array(
                    'ut_global_hero_overlay_effect_style',
                    'ut_global_hero_overlay_effect_color'
                ),
                'label'       => 'yes, please!'
            ),
            array(
                'value'       => 'off',
                'for'         => array(
                
                ),
                'label'       => 'no, thanks!'
            )
        ) /* end choices */
      ),
      
      array(
        'id'          => 'ut_global_hero_overlay_effect_style',
        'label'       => 'Overlay Animation Effect',
        'desc'        => 'choose between 2 awesome animation effects!',
        'std'         => 'dots',
        'type'        => 'select',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
        'choices'     => array( 
            array(
                'value'       => 'dots',
                'label'       => 'Connecting Dots'
            ),
            array(
                'value'       => 'bubbles',
                'label'       => 'Rising Bubbles'
            )
        ) /* end choices */
      ),
      
      array(
        'id'          => 'ut_global_hero_overlay_effect_color',
        'label'       => 'Overlay Effect Color',
        'desc'        => '<strong>(optional)</strong>. Leave this field empty if you like to keep the theme accentcolor as effect color.',
        'type'        => 'colorpicker',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_global_hero_border_setting_headline',
        'label'       => 'Global Border Settings',
        'desc'        => '<h2 class="section-headline">Global Hero Custom Border</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_global_hero_border_bottom',
        'label'       => 'Activate Border at Hero Bottom?',
        'desc'        => '',
        'type'        => 'select_group',
        'toplevel'    => false,
        'choices'     => array(              
          array(
            'label'       => 'yes, please!',
            'for'         => array(
                            'ut_global_hero_border_bottom_color',
                            'ut_global_hero_border_bottom_width',
                            'ut_global_hero_border_bottom_style'
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
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          	=> 'ut_global_hero_border_bottom_color',
        'label'       	=> 'Border Bottom Color',
        'type'        	=> 'colorpicker',
        'desc'       	=> '<strong>(optional)</strong>',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'            => 'ut_global_hero_border_bottom_width',
        'label'         => 'Border Bottom Width',
        'desc'          => '<strong>(optional)</strong>',
        'type'          => 'numeric-slider',
        'min_max_step'  => '1,100',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_global_hero_border_bottom_style',
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
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_global_hero_fancy_border_setting_headline',
        'label'       => 'Global Fancy Border Settings',
        'desc'        => '<h2 class="section-headline">Global Hero Fancy Border</h2>',
        'type'        => 'section_headline',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_global_hero_fancy_border',
        'label'       => 'Activate Fancy Border?',
        'desc'        => '',
        'type'        => 'select_group',
        'toplevel'    => false,
        'choices'     => array(              
          array(
            'label'       => 'yes, please!',
            'for'         => array(
                            'ut_global_hero_fancy_border_color',
                            'ut_global_hero_fancy_border_background_color',
                            'ut_global_hero_fancy_border_size'
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
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          	=> 'ut_global_hero_fancy_border_color',
        'label'       	=> 'Color',
        'type'        	=> 'colorpicker',
        'desc'       	=> '<strong>(optional)</strong>',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_styling_settings',
      ),
      
      array(
        'id'          	=> 'ut_global_hero_fancy_border_background_color',
        'label'       	=> 'Background Color',
        'type'        	=> 'colorpicker',
        'desc'       	=> '<strong>(optional)</strong>',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_styling_settings',
      ),
      
       array(
        'id'            => 'ut_global_hero_fancy_border_size',
        'label'         => 'Size',
        'desc'          => '<strong>(optional)</strong> - default 10px',
        'type'          => 'text',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_styling_settings',
      ), 
      
      
      
      
      /*
      |--------------------------------------------------------------------------
      | Global Hero Content Settings
      |--------------------------------------------------------------------------
      */
      array(
        'id'          => 'ut_global_hero_content_styling_menu',
        'subid'       => 'ut_global_hero_content_styling_settings',
        'label'       => 'Global Hero Content Colors',
        'type'        => 'section_headline',
        'section'     => 'ut_global_hero_settings'
      ),
      
      array(
        'id'            => 'ut_global_hero_expertise_slogan_settings_headline',
        'label'         => 'Hero Caption',
        'desc'          => '<h2 class="section-headline">Global Hero Caption Slogan Settings</h2>',
        'type'          => 'section_headline',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_content_styling_settings',
      ),
      
      array(
        'id'            => 'ut_global_hero_expertise_slogan_color',
        'label'         => 'Hero Caption Slogan Color',
        'desc'          => '<strong>(optional)</strong> - set an alternate color for <strong>Hero Caption Slogan</strong>.',
        'type'          => 'colorpicker',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_content_styling_settings',
      ),
      
      array(
        'id'            => 'ut_global_hero_expertise_slogan_background_color',
        'label'         => 'Hero Caption Slogan Background Color',
        'desc'          => '<strong>(optional)</strong> - set an alternate background color for <strong>Hero Caption Slogan</strong>.',
        'type'          => 'colorpicker',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_content_styling_settings',
      ), 
      
      array(
        'id'            => 'ut_global_hero_company_slogan_color_settings_headline',
        'label'         => 'Hero Caption',
        'desc'          => '<h2 class="section-headline">Global Hero Caption Title Settings</h2>',
        'type'          => 'section_headline',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_content_styling_settings',
      ),
      
      array(
        'id'            => 'ut_global_hero_company_slogan_color',
        'label'         => 'Hero Caption Title Color',
        'desc'          => '<strong>(optional)</strong>',
        'type'          => 'colorpicker',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_content_styling_settings',
      ),
      
      array(
        'id'            => 'ut_global_hero_catchphrase_color',
        'label'         => 'Hero Caption Description Color',
        'desc'          => '<strong>(optional)</strong>',
        'type'          => 'colorpicker',
        'section'       => 'ut_global_hero_settings',
        'subsection'    => 'ut_global_hero_content_styling_settings',
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Global Hero Type
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_global_hero_type_menu',
        'subid'       => 'ut_global_hero_type_settings',
        'label'       => 'Global Hero Type',
        'type'        => 'section_headline',
        'section'     => 'ut_global_hero_settings'
      ),
      
      array(
        'id'          => 'ut_global_hero_type_headline',
        'label'       => 'Global Hero Type',
        'desc'        => '<h2 class="section-headline">Global Hero Type</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_type_settings',
      ),  
      
      
      array(
        'id'          => 'ut_global_hero_header_type',
        'label'       => 'Choose Hero Type',
        'type'        => 'select_group',
        'toplevel'    => true,
        'section'     => 'ut_global_hero_settings',
        'subsection'  => 'ut_global_hero_type_settings',
        'choices'     => array( 
            array(
                'value'       => 'image',
                'label'       => 'Single Background Image'
            ),
            array(
                'value'       => 'animatedimage',
                'label'       => 'Animated Single Background Image'
            ),
            array(
                'value'       => 'splithero',
                'label'       => 'Split Hero'
            ),
            array(
                'value'       => 'slider',
                'label'       => 'Background Image Slider'
            ),
            array(
                'value'       => 'transition',
                'label'       => 'Fancy Image Slider'
            ),
            array(
                'value'       => 'tabs',
                'label'       => 'Tablet Slider'
            ),
            array(
                'value'       => 'video',
                'label'       => 'Video Header'
            ),
            array(
                'value'       => 'custom',
                'for'         => array('front_hero_custom_shortcode'),
                'label'       => 'Custom Shortcode'
            ),
            array(
                'value'       => 'dynamic',
                'label'       => 'Dynamic Hero ( dynamic height )'
            )
        ),
      ),
                  
      /*
      |--------------------------------------------------------------------------
      | Front Page Settings
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_front_hero_styling_menu',
        'subid'       => 'ut_front_hero_styling_settings',
        'label'       => 'Hero Styling',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
      ),
      
      array(
        'id'          => 'ut_front_hero_styling_headline',
        'label'       => 'Hero Styling',
        'desc'        => '<h2 class="section-headline">Hero Styling</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_front_hero_global_styling',
        'label'       => 'Use Global Hero Styling Settings?',
        'desc'        => '<strong>(optional)</strong>',
        'toplevel'    => true,
        'std'         => 'off',
        'type'        => 'select_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
        'choices'     => array( 
            array(
                'value'       => 'on',
                'for'         => array(),
                'label'       => 'yes, please!'
            ),
            array(
                'value'       => 'off',
                'for'         => array(
                    'ut_front_page_hero_style',
                    'ut_front_page_hero_align',
                    'ut_front_page_overlay_settings_headline',
                    'ut_front_page_overlay',
                    'ut_front_page_overlay_color',
                    'ut_front_page_overlay_color_opacity',
                    'ut_front_page_overlay_pattern',
                    'ut_front_page_overlay_pattern_style',
                    'ut_front_page_overlay_effect_settings_headline',
                    'ut_front_page_overlay_effect',
                    'ut_front_page_overlay_effect_style',
                    'ut_front_page_overlay_effect_color',
                    'ut_front_hero_border_setting_headline',
                    'ut_front_hero_border_bottom',
                    'ut_front_hero_border_bottom_color',
                    'ut_front_hero_border_bottom_width',
                    'ut_front_hero_border_bottom_style',
                    'ut_front_hero_fancy_border_setting_headline',
                    'ut_front_hero_fancy_border',
                    'ut_front_fancy_border_color',
                    'ut_front_fancy_border_background_color',
                    'ut_front_fancy_border_size',
                ),
                'label'       => 'no, thanks!'
            )
            
        ) /* end choices */
      ),
      
      array(
        'id'          => 'ut_front_page_hero_style',
        'label'       => 'Hero Style',
        'desc'        => 'Choose between 11 different hero header styles. If you are using a slider as your desired hero type, you can define an individual style for each slide. <a href="#" class="ut-hero-preview">Preview Hero Styles</a>',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
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
        'id'          => 'ut_front_page_hero_align',
        'label'       => 'Choose Hero Alignment',
        'type'        => 'select',
        'desc'          => '',
        'std'          => 'center',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
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
        'id'          => 'ut_front_page_overlay_settings_headline',
        'label'       => 'Hero Overlay Settings',
        'desc'        => '<h2 class="section-headline">Hero Overlay Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_front_page_overlay',
        'label'       => 'Activate Hero Overlay?',
        'desc'        => '<strong>(optional)</strong>',
        'std'         => 'on',
        'toplevel'    => false,
        'type'        => 'select_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'for'         => array(
                'ut_front_page_overlay_color',
                'ut_front_page_overlay_color_opacity',
                'ut_front_page_overlay_pattern',
                'ut_front_page_overlay_pattern_style'    
            ),
            'label'       => 'yes, please!'
          ),
          array(
            'value'       => 'off',
            'label'       => 'no, thanks!'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_front_page_overlay_color',
        'label'       => 'Hero Overlay Color',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'colorpicker',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_front_page_overlay_color_opacity',
        'label'       => 'Hero Overlay Color Opacity',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'numeric-slider',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
        'min_max_step'=> '0,1,0.1'
      ),  
      
      array(
        'id'          => 'ut_front_page_overlay_pattern',
        'label'       => 'Activate Hero Overlay Pattern?',
        'desc'        => '<strong>(optional)</strong>',
        'std'         => 'on',
        'toplevel'    => false,
        'type'        => 'select_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
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
        'id'          => 'ut_front_page_overlay_pattern_style',
        'label'       => 'Hero Overlay Pattern Style',
        'desc'        => '<strong>(optional)</strong>',
        'std'         => 'style_one',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
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
        'id'          => 'ut_front_page_overlay_effect_settings_headline',
        'label'       => 'Hero Overlay Effect Settings',
        'desc'        => '<h2 class="section-headline">Hero Overlay Effect Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_front_page_overlay_effect',
        'label'       => 'Activate Overlay Animation Effect?',
        'desc'        => '<strong>(optional) Keep in mind, that this effect uses canvas objects for animation. Old Browsers do not support this feature!</strong>',
        'std'         => 'off',
        'toplevel'    => false,
        'type'        => 'select_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'for'         => array(
                'ut_front_page_overlay_effect_style',
                'ut_front_page_overlay_effect_color'                   
            ),
            'label'       => 'yes, please!'
          ),
          array(
            'value'       => 'off',
            'for'         => array(
            
            ),
            'label'       => 'no, thanks!'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_front_page_overlay_effect_style',
        'label'       => 'Overlay Animation Effect',
        'desc'        => 'choose between 2 awesome animation effects!',
        'std'         => 'dots',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
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
        'id'          => 'ut_front_page_overlay_effect_color',
        'label'       => 'Overlay Effect Color',
        'desc'        => '<strong>(optional)</strong>. Leave this field empty if you like to keep the theme accentcolor as effect color.',
        'type'        => 'colorpicker',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_front_hero_border_setting_headline',
        'label'       => 'Border Settings',
        'desc'        => '<h2 class="section-headline">Hero Custom Border</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_front_hero_border_bottom',
        'label'       => 'Activate Border at Hero Bottom?',
        'desc'        => '',
        'type'        => 'select_group',
        'toplevel'    => false,
        'choices'     => array(              
          array(
            'label'       => 'yes, please!',
            'for'         => array(
                            'ut_front_hero_border_bottom_color',
                            'ut_front_hero_border_bottom_width',
                            'ut_front_hero_border_bottom_style'
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
        'section'       => 'ut_front_page_settings',
        'subsection'    => 'ut_front_hero_styling_settings'
      ),
      
      array(
        'id'          	=> 'ut_front_hero_border_bottom_color',
        'label'       	=> 'Border Bottom Color',
        'type'        	=> 'colorpicker',
        'desc'       	=> '<strong>(optional)</strong>',
        'section'       => 'ut_front_page_settings',
        'subsection'    => 'ut_front_hero_styling_settings'
      ),
      
      array(
        'id'          => 'ut_front_hero_border_bottom_width',
        'label'       => 'Border Bottom Width',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'numeric-slider',
        'min_max_step'=> '1,100',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings'
      ),
      
      array(
        'id'          => 'ut_front_hero_border_bottom_style',
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
        'section'       => 'ut_front_page_settings',
        'subsection'    => 'ut_front_hero_styling_settings'
      ),
      
      array(
        'id'          => 'ut_front_hero_fancy_border_setting_headline',
        'label'       => 'Fancy Border Settings',
        'desc'        => '<h2 class="section-headline">Hero Fancy Border</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_front_hero_fancy_border',
        'label'       => 'Activate Fancy Border?',
        'desc'        => '',
        'type'        => 'select_group',
        'toplevel'    => false,
        'choices'     => array(              
          array(
            'label'       => 'yes, please!',
            'for'         => array(
                            'ut_front_fancy_border_color',
                            'ut_front_fancy_border_background_color',
                            'ut_front_fancy_border_size'
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
        'section'       => 'ut_front_page_settings',
        'subsection'    => 'ut_front_hero_styling_settings'
      ),
      
      array(
        'id'          	=> 'ut_front_fancy_border_color',
        'label'       	=> 'Color',
        'type'        	=> 'colorpicker',
        'desc'       	=> '<strong>(optional)</strong>',
        'section'       => 'ut_front_page_settings',
        'subsection'    => 'ut_front_hero_styling_settings'
      ),
      
      array(
        'id'          	=> 'ut_front_fancy_border_background_color',
        'label'       	=> 'Background Color',
        'type'        	=> 'colorpicker',
        'desc'       	=> '<strong>(optional)</strong>',
        'section'       => 'ut_front_page_settings',
        'subsection'    => 'ut_front_hero_styling_settings'
      ),
      
       array(
        'id'            => 'ut_front_fancy_border_size',
        'label'         => 'Size',
        'desc'          => '<strong>(optional)</strong> - default 10px',
        'type'          => 'text',
        'section'       => 'ut_front_page_settings',
        'subsection'    => 'ut_front_hero_styling_settings',
      ), 
      
      /*
      |--------------------------------------------------------------------------
      | Hero Type
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_front_hero_background_menu',
        'subid'       => 'ut_front_hero_background_settings',
        'label'       => 'Hero Type',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings'
      ),
      
      array(
        'id'          => 'ut_front_hero_background_headline',
        'label'       => 'Hero Type',
        'desc'        => '<h2 class="section-headline">Hero Type</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_front_page_header_type',
        'label'       => 'Choose Hero Type',
        'type'        => 'select_group',
        'toplevel'    => true,
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
        'choices'     => array( 
          array(
            'value'       => 'image',
            'for'         => array( 
                                'ut_front_header_image',
                                'ut_front_header_parallax',
                                'ut_front_header_rain',
                                'ut_front_header_rain_sound'
            ),
            'label'       => 'Single Background Image'
          ),
          array(
            'value'       => 'animatedimage',
            'for'         => array('ut_front_header_animatedimage'),
            'label'       => 'Animated Single Background Image'
          ),
          array(
            'value'       => 'splithero',
            'for'         => array( 
                                'ut_front_header_image',
                                'ut_front_header_parallax',
                                'ut_front_header_rain',
                                'ut_front_header_rain_sound',
                                'ut_front_split_image',
                                'ut_front_split_image_max_width',
                                'ut_front_split_image_effect',
                                'ut_front_split_content_type',
                                'ut_front_split_video',
                                'ut_front_split_video_box',
                                'ut_front_split_video_box_style',
                                'ut_front_split_video_box_padding'
            ),
            'label'       => 'Split Hero'
          ),
          array(
            'value'       => 'slider',
            'for'         => array( 
                                'ut_front_page_slider',
                                'front_animation_speed',
                                'front_slideshow_speed',
                                'ut_front_page_slider',
                                'front_slideshow_color_settings_headline',
                                'front_slideshow_arrow_background_color',
                                'front_slideshow_arrow_background_color_hover',
                                'front_slideshow_arrow_color',
                                'front_slideshow_arrow_color_hover',

            ),
            'label'       => 'Background Image Slider'
          ),
          array(
            'value'       => 'transition',
            'for'         => array(
                                'ut_front_page_fancy_slider',
                                'front_fancy_slider_effect',
                                'front_fancy_slider_height'
            ),
            'label'       => 'Fancy Image Slider'
          ),
          array(
            'value'       => 'tabs',
            'for'         => array(
                                'ut_front_header_image',
                                'ut_front_header_parallax',
                                'ut_front_page_tabs_headline',
                                'ut_front_page_tabs_headline_style',
                                'ut_front_page_tabs_tablet_color',
                                'ut_front_page_tabs_tablet_shadow',
                                'ut_front_page_tabs'
            ),
            'label'       => 'Tablet Slider'
          ),
          array(
            'value'       => 'video',
            'for'         => array(
                                'ut_front_video_setting_description',
                                'ut_front_video_containment',
                                'ut_front_video_source',
                                'ut_front_video',
                                'ut_front_video_custom',
                                'ut_front_video_mp4',
                                'ut_front_video_ogg',
                                'ut_front_video_webm',
                                'ut_front_video_sound',
                                'ut_front_video_loop',
                                'ut_front_video_preload',
                                'ut_video_mute_button',
                                'ut_front_video_volume',
                                'ut_front_video_poster'
            ),
            'label'       => 'Video Header'
          ),
          array(
            'value'       => 'custom',
            'for'         => array('front_hero_custom_shortcode'),
            'label'       => 'Custom Shortcode'
          ),
          array(
            'value'       => 'dynamic',
            'for'         => array( 
                                'ut_front_header_image',
                                'ut_front_header_parallax',
                                'front_hero_dynamic_height',
                                'front_hero_dynamic_content_v_align',
                                'front_hero_dynamic_content_margin_bottom'
                          ),
            'label'       => 'Dynamic Hero ( dynamic height )'
          )
        ),
      ),
      
      /*
      | Image Tab Slider
      */
      
      array(
        'id'          => 'ut_front_page_tabs_headline',
        'label'       => 'Tablet Headline',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_front_page_tabs_headline_style',
        'label'       => 'Tablet Headline Font Style',
        'desc'          => '',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
        'std'          => 'global',
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
        'id'          => 'ut_front_page_tabs_tablet_color',
        'label'       => 'Tablet Color',
        'desc'        => '',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
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
        'id'          => 'ut_front_page_tabs_tablet_shadow',
        'label'       => 'Tablet Shadow',
        'desc'        => '',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
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
        'id'          => 'ut_front_page_tabs',
        'label'       => 'Manage Tablet Images',
        'type'        => 'list-item',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
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
        'id'          => 'ut_front_header_parallax',
        'label'       => 'Activate Parallax',
        'desc'        => 'Keep in mind, that activating this option can reduce your website performance.',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
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
        'id'          => 'ut_front_header_rain',
        'label'       => 'Activate Rain Effect',
        'desc'        => 'Keep in mind, that activating this option can reduce your website performance.',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'std'         => 'off',
        'subsection'  => 'ut_front_hero_background_settings',
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
        'id'          => 'ut_front_header_rain_sound',
        'label'       => 'Activate Rain Sound',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'std'          => 'off',
        'subsection'  => 'ut_front_hero_background_settings',
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
        'id'          => 'ut_front_header_image',
        'label'       => 'Background Image',
        'desc'        => 'For best image results, we recommend to upload an image with minimum size of 1600x900 pixel or maximum size of 1920x1080(optimal) pixel. Also try to avoid uploading images with more than 200-300Kb size. Keep in mind, that you are not able to set a background position or attachment if the parallax option has been set to "on".',
        'type'        => 'background',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_front_split_content_type',
        'label'       => 'Hero Split Content Type',
        'desc'        => '',
        'type'        => 'select_group',
        'choices'     => array( 
          array(
            'value'       => 'image',
            'for'         => array('ut_front_split_image','ut_front_split_image_max_width','ut_front_split_image_effect'),
            'label'       => 'Image'
          ),
          array(
            'value'       => 'video',
            'for'         => array('ut_front_split_video','ut_front_split_video_box','ut_front_split_video_box_style','ut_front_split_video_box_padding'),
            'label'       => 'Video'
          )
        ),
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_front_split_video',
        'label'       => 'Hero Split Video',
        'desc'        => 'This video will display on the right side of the hero caption. It will not display on mobile devices! Please use the only embed codes from youtube or vimeo.',
        'type'        => 'textarea_simple',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
          'id'          => 'ut_front_split_video_box',
          'label'       => 'Activate Hero Split Video Box',
          'desc'        => 'Display a shadowed box around the video.',
          'type'        => 'select_group',
          'choices'     => array( 
            array(
              'value'       => 'on',
              'for'         => array('ut_front_split_video_box_style','ut_front_split_video_box_padding'),
              'label'       => 'yes, please!'
            ),
            array(
              'value'       => 'off',
              'for'         => array(),
              'label'       => 'no, thanks!'
            )
          ),
          'section'     => 'ut_front_page_settings',
          'subsection'  => 'ut_front_hero_background_settings',
          
      ),
      
      array(
          'id'          => 'ut_front_split_video_box_style',
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
          'section'     => 'ut_front_page_settings',
          'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
          'id'          => 'ut_front_split_video_box_padding',
          'label'       => 'Hero Split Video Box Padding',
          'desc'        => 'Set padding of the box in pixel e.g. 20px. default: 20px',
          'type'        => 'text',
          'section'     => 'ut_front_page_settings',
          'subsection'  => 'ut_front_hero_background_settings',
      ),      
      
      array(
        'id'          => 'ut_front_split_image',
        'label'       => 'Hero Split Image',
        'desc'        => 'This image will display on the right side of the hero caption. It will not display on mobile devices!',
        'type'        => 'upload',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_front_split_image_effect',
        'label'       => 'Hero Split Image Animation Effect',
        'desc'        => 'Choose animation effect for Hero Split Image.',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
        'std'          => 'none',
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
        'id'          => 'ut_front_split_image_max_width',
        'label'       => 'Image Max Width',
        'desc'        => 'Adjust this value until the image fits inside the hero. Default "60".',
        'type'        => 'numeric-slider',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
        'std'         => '60',
        'min_max_step'=> '0,100,1'
      ),
            
      /*
      | Animated Image Type
      */
      array(
        'id'          => 'ut_front_header_animatedimage',
        'label'       => 'Animated Background Image',
        'desc'        => '',
        'type'        => 'upload',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      /*
      | Slider Type
      */
      
      array(
        'id'          => 'front_animation_speed',
        'label'       => 'Animation Speed',
        'desc'        => 'Set speed of animations, in milliseconds.',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
        'id'          => 'front_slideshow_speed',
        'label'       => 'Slideshow Speed',
        'desc'        => 'Set speed of the slideshow cycling, in milliseconds.',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_front_page_slider',
        'label'       => 'Slider',
        'type'        => 'list-item',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
        'settings'    => array( 
          array(
            'id'          => 'image',
            'label'       => 'Image',
            'type'        => 'upload',
          ),
          array(
            'id'          => 'style',
            'label'       => 'Caption / Hero Style',
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
            'label'       => 'Caption / Hero Font Style',
            'desc'          => 'Setting this option to default will load the hero font style ( which has been set under Front Page Settings -> Hero Content).',
            'type'        => 'select',
            'std'          => 'global',
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
            'desc'          => '',
            'std'          => 'center',
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
            'std'          => 'top',
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
            'label'       => 'Caption Slogan',
            'type'        => 'textarea-simple',
            'rows'        => '3'
          ),
          array(
            'id'          => 'description',
            'label'       => 'Caption',
            'type'        => 'textarea-simple',
            'rows'        => '3'
          ),
          array(
            'id'          => 'catchphrase',
            'label'       => 'Caption Description',
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
        'id'          => 'front_slideshow_color_settings_headline',
        'label'       => 'Slider Navigation Color Settings',
        'desc'        => '<h2 class="section-headline">Slider Navigation Color Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      array(
        'id'          => 'front_slideshow_arrow_background_color',
        'label'       => 'Arrow Background Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      array(
        'id'          => 'front_slideshow_arrow_background_color_hover',
        'label'       => 'Arrow Background Color Hover',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      array(
        'id'          => 'front_slideshow_arrow_color',
        'label'       => 'Arrow Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      array(
        'id'          => 'front_slideshow_arrow_color_hover',
        'label'       => 'Arrow Color Hover',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
            
      /*
      | Fancy Slider
      */
      
      array(
        'id'          => 'ut_front_page_fancy_slider',
        'label'       => 'Fancy Slider',
        'type'        => 'list-item',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
        'settings'    => array( 
          array(
            'id'          => 'image',
            'label'       => 'Image',
            'type'        => 'upload',
          ),
          array(
            'id'          => 'style',
            'label'       => 'Caption / Hero Style',
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
            'label'       => 'Caption / Hero Font Style',
            'desc'          => 'Setting this option to default will load the hero font style ( which has been set under Front Page Settings -> Hero Settings ).',
            'type'        => 'select',
            'std'          => 'global',
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
            'std'          => 'left',
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
            'label'       => 'Caption Slogan',
            'type'        => 'textarea-simple',
            'rows'        => '3'
          ),
          array(
            'id'          => 'description',
            'label'       => 'Caption',
            'type'        => 'textarea-simple',
            'rows'        => '3'
          ),
          array(
            'id'          => 'catchphrase',
            'label'       => 'Caption Description',
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
            'id'          => 'scroll_to_target',
            'label'       => 'Scroll to Content Target',
            'desc'        => 'Select the page, section you like to scroll to. Leave empty to scroll to the first section.',
            'type'        => 'section-select',
          ),
          array(
            'id'          => 'link_description',
            'label'       => 'Link Button Text',
            'type'        => 'text'
          )
        )
      ),
      
      array(
        'id'          => 'front_fancy_slider_effect',
        'label'       => 'Slide Effect',
        'desc'        => 'Choose an effect for your slider, this effect will affect all slides.',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
        'std'         => 'fxSoftScale',
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
        'id'          => 'front_fancy_slider_height',
        'label'       => 'Slider Height',
        'desc'        => 'Set height of the slideshow in pixel e.g. 600px.',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      /*
      | Custom Shortcode
      */
      
      array(
        'id'          => 'front_hero_custom_shortcode',
        'label'       => 'Custom Shortcode',
        'desc'        => '',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      /*
      | Dynamic
      */
      
      array(
        'id'          => 'front_hero_dynamic_height',
        'label'       => 'Custom Hero Height',
        'type'        => 'numeric_slider',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings'
      ),
      
      array(
        'id'          => 'front_hero_dynamic_content_v_align',
        'label'       => 'Hero Content Vertical Align',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',        
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
        'id'          => 'front_hero_dynamic_content_margin_bottom',
        'label'       => 'Content Margin Bottom',
        'desc'        => 'value in pixel e.g. 40px.',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings'
      ),
    
      /*
      | Video
      */
      
      array(
        'id'          => 'ut_front_video_setting_description',
        'label'       => 'Video',
        'desc'        => 'At the current stage the theme only supports youtube videos as well as selfhosted videos. Custom Player are possible, but using them will cause many hero options not taking effect. If a mobile or tablet device is visiting the site, the video hero support will be dropped and the theme will display a poster image instead. The main reason for this behavior is, that most mobile and tablet devices do not support the video backgrounds.',
        'type'        => 'textblock',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_front_video_containment',
        'label'       => 'Set this Video as background too?',
        'desc'        => 'This option here places the video "behind" the entire front page instead of only inside the hero. As a result, the video appears "behind" each section which does not have a background color nor background image. While you are able to set a video per section, this option here makes sense if you need to use the same video again and again in several sections, so instead of placing the same video in 5 sections - make the affected section transparent, so that this video here will display inside ( behind ) the section. If you need different videos in different sections, skip this option here and set videos per page /section. This option does only effect on youtube and selfhosted videos. Custom Embedded Videos are not supported.',
        'std'         => 'hero',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
        'choices'     => array( 
          array(
            'value'       => 'body',
            'label'       => 'yes, please!'
          ),
          array(
            'value'       => 'hero',
            'label'       => 'no, thanks!'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_front_video_source',
        'label'       => 'Video Source',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
        'std'          => 'youtube',
        'choices'     => array( 
          array(
            'value'       => 'youtube',
            'for'         => array('ut_front_video','ut_front_video_sound','ut_front_video_loop','ut_video_mute_button','ut_front_video_volume','ut_front_video_poster'),
            'label'       => 'Youtube'
          ),
          array(
            'value'       => 'selfhosted',
            'for'         => array('ut_front_video_mp4','ut_front_video_ogg','ut_front_video_webm','ut_front_video_sound','ut_front_video_loop','ut_front_video_preload','ut_video_mute_button','ut_front_video_volume','ut_front_video_poster'),
            'label'       => 'Selfthosted'
          ),
          array(
            'value'       => 'custom',
            'for'         => array('ut_front_video_custom'),
            'label'       => 'Custom Embedded Code'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_front_video',
        'label'       => 'Video URL for Front Page.',
        'desc'        => 'Please insert the url only e.g. http://youtu.be/gvt_YFuZ8LA . Please do not insert the complete embedded code! This video will be displayed on the front page.',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_front_video_custom',
        'label'       => 'Video embedded code for front page.',
        'desc'        => 'Please insert the complete embedded code of your favorite video hoster! This video will be displayed on the front page. Keep in mind, that hero settings like "Hero Caption" do not display if this type of video source is active.',
        'type'        => 'textarea-simple',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_front_video_mp4',
        'label'       => 'MP4',
        'desc'        => '',
        'type'        => 'upload',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
       array(
        'id'          => 'ut_front_video_ogg',
        'label'       => 'OGG',
        'desc'        => '',
        'type'        => 'upload',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',

      ),
      
       array(
        'id'          => 'ut_front_video_webm',
        'label'       => 'WEBM',
        'desc'        => '',
        'type'        => 'upload',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_front_video_sound',
        'label'       => 'Activate video sound after page is loaded?',
        'desc'        => '<strong>(optional)</strong>. Play sound directly when page is loaded.',
        'std'         => 'off',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
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
        'id'              => 'ut_front_video_loop',
        'label'           => 'Loop Video?',
        'desc'            => '',
        'type'            => 'select',
        'section'         => 'ut_front_page_settings',
        'subsection'      => 'ut_front_hero_background_settings',
        'choices'         => array(
          
          array(
            'label'       => 'yes, please!',
            'value'       => 'on'
          ),
          array(
            'label'       => 'no, thanks!',
            'value'       => 'off'
          )
          
        ),
        'std'             => 'on'
      ),
      
      array(
        'id'              => 'ut_front_video_preload',
        'label'           => 'Preload Video?',
        'desc'            => '',
        'type'            => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
        'choices'         => array(
          
          array(
            'label'       => 'yes, please!',
            'value'       => 'on'
          ),
          array(
            'label'       => 'no, thanks!',
            'value'       => 'off'
          )
          
        ),
        'std'             => 'on'
      ),
            
      array(
        'id'              => 'ut_video_mute_button',
        'label'           => 'Show Mute Button?',
        'desc'            => '',
        'type'            => 'select',
        'section'       => 'ut_front_page_settings',
        'subsection'    => 'ut_front_hero_background_settings',
        'choices'         => array(
          
          array(
            'label'       => 'yes, please!',
            'value'       => 'show'
          ),
          array(
            'label'       => 'no, thanks!',
            'value'       => 'hide'
          )
          
        ),
        'std'             => 'hide'
      ),
      
      array(
        'id'          => 'ut_front_video_volume',
        'label'       => 'Video Volume',
        'desc'        => '1-100 - default 5',
        'std'         => '5',
        'type'        => 'numeric-slider',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
        'min_max_step'=> '0,100,1'
      ),      
                  
      array(
        'id'          => 'ut_front_video_poster',
        'label'       => 'Poster Image',
        'desc'        => 'This image will be displayed instead of the video on mobile devices.',
        'type'        => 'upload',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_background_settings',
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Hero Front Settings
      |--------------------------------------------------------------------------
      */
      array(
        'id'          => 'ut_front_hero_setting_menu',
        'subid'       => 'ut_front_hero_settings',
        'label'       => 'Hero Content',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
      ),
      
      array(
        'id'          => 'ut_front_hero_settings_headline',
        'label'       => 'Hero Content',
        'desc'        => '<h2 class="section-headline">Hero Content</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
      ),
      
      array(
        'id'          => 'ut_front_hero_global_content_styling',
        'label'       => 'Use Global Hero Content Color Settings?',
        'desc'        => '<strong>(optional)</strong>',
        'toplevel'    => true,
        'std'         => 'off',
        'type'        => 'select_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'choices'     => array( 
            array(
                'value'       => 'on',
                'for'         => array(),
                'label'       => 'yes, please!'
            ),
            array(
                'value'       => 'off',
                'for'         => array(
                    'ut_front_expertise_slogan_color', 
                    'ut_front_expertise_slogan_background_color',
                    'ut_front_company_slogan_color',
                    'ut_front_catchphrase_color',
                ),
                'label'       => 'no, thanks!'
            )
            
        ) /* end choices */
      ),
      
      array(
        'id'          => 'ut_front_custom_slogan',
        'label'       => 'Custom Hero HTML',
        'desc'        => 'This field appears above the Hero Caption Slogan.',
        'type'        => 'textarea',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'rows'        => '10'
      ),
      
      array(
        'id'          => 'ut_front_expertise_slogan_settings_headline',
        'label'       => 'Hero Caption',
        'desc'        => '<h2 class="section-headline">Hero Caption Slogan Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
      ),
      
      array(
        'id'          => 'ut_front_expertise_slogan',
        'label'       => 'Hero Caption Slogan',
        'desc'        => 'This element appears above the Hero Caption.',
        'type'        => 'textarea-simple',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'rows'        => '5'
      ),
      array(
        'id'          => 'ut_front_expertise_slogan_color',
        'label'       => 'Hero Caption Slogan Color',
        'desc'        => '<strong>(optional)</strong> - set an alternate color for <strong>Hero Caption Slogan</strong>.',
        'type'        => 'colorpicker',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
      array(
        'id'          => 'ut_front_expertise_slogan_background_color',
        'label'       => 'Hero Caption Slogan Background Color',
        'desc'        => '<strong>(optional)</strong> - set an alternate background color for <strong>Hero Caption Slogan</strong>.',
        'type'        => 'colorpicker',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),   
      
      array(
        'id'          => 'ut_front_company_slogan_settings_headline',
        'label'       => 'Hero Caption',
        'desc'        => '<h2 class="section-headline">Hero Caption Title Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
      ),
      
      array(
        'id'          => 'ut_front_company_slogan',
        'label'       => 'Hero Caption Title',
        'desc'        => 'This field also accepts HTML tags and shortcodes such as word rotator for example.',
        'htmldesc'    => '&lt;span&gt; word &lt;/span&gt; = highlight word in themecolor',
        'type'        => 'textarea-simple',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'rows'        => '5'
      ),
      
      array(
        'id'          => 'ut_front_company_slogan_color',
        'label'       => 'Hero Caption Title Color',
        'desc'        => '<strong>(optional)</strong> - set an alternative for <strong>Hero Caption Title</strong>.',
        'type'        => 'colorpicker',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
      
      array(
        'id'          => 'ut_front_company_slogan_letterspacing',
        'label'       => 'Hero Caption Title Letterspacing',
        'desc'        => '<strong>(optional)</strong> - include "px" in your string. e.g. 2px',
        'htmldesc'    => '',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
           
      array(
        'id'          => 'ut_front_company_slogan_uppercase',
        'label'       => 'Hero Caption Title Text Transform',
        'desc'        => 'Display the Hero Caption Title in uppercase letters?',
        'type'        => 'radio',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'std'          => 'on',
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
        'id'          => 'ut_front_company_slogan_glow',
        'label'       => 'Hero Caption Title Gloweffect',
        'desc'        => 'Activate Glow Effect for Hero Caption Title?',
        'type'        => 'radio',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'std'          => 'off',
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
        'id'          => 'ut_front_catchphrase_settings_headline',
        'label'       => 'Hero Caption Description Settings',
        'desc'        => '<h2 class="section-headline">Hero Caption Description Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
      ),      
       
      array(
        'id'          => 'ut_front_catchphrase',
        'label'       => 'Hero Caption Description',
        'desc'        => 'This field appears beneath the Hero Caption.  ',
        'type'        => 'textarea-simple',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'rows'        => '5'
      ),
      
      array(
        'id'          => 'ut_front_catchphrase_color',
        'label'       => 'Hero Caption Description Color',
        'desc'        => '<strong>(optional)</strong> - set an alternate color for <strong>Hero Caption Description</strong>.',
        'type'        => 'colorpicker',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
      
      array(
        'id'          => 'ut_front_catchphrase_websafe_font_style',
        'label'       => 'Hero Caption Description Font Setting',
        'type'        => 'typography',
       'section'      => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
      ),      
      
      array(
        'id'          => 'ut_front_button_settings_headline',
        'label'       => 'Hero Button Settings',
        'desc'        => '<h2 class="section-headline">Hero Button Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
      ), 
      
      array(
        'id'          => 'ut_front_scroll_to_main',
        'label'       => 'Hero Main Button Text',
        'desc'        => 'Enter your desired text or leave this field empty to hide the button.',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
      
      array(
        'id'          => 'ut_front_scroll_to_main_url_type',
        'label'       => 'Hero Main Button Link Type',
        'desc'        => 'Do you like to link to a section or external URL?',
        'type'        => 'radio_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'std'          => 'section',
        'choices'     => array( 
          array(
            'value'       => 'section',
            'for'         => array('ut_front_scroll_to_main_target'),
            'label'       => 'to a section of the front page!'
          ),
          array(
            'value'       => 'external',
            'for'         => array('ut_front_scroll_to_main_url' , 'ut_front_scroll_to_main_link_target'),
            'label'       => 'to an external url!'
          ),          
        )
      ),
      
      array(
        'id'          => 'ut_front_scroll_to_main_target',
        'label'       => 'Scroll to Section',
        'desc'        => 'Select the section you like to main button. Leave empty ( set to -- Choose One -- ) to scroll to the first section.',
        'type'        => 'section-select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
      
      array(
        'id'          => 'ut_front_scroll_to_main_url',
        'label'       => 'Main Button URL',
        'desc'        => 'Enter your desired URL. Do not forget to place "http://" in front of your link.',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
      
      array(
        'id'          => 'ut_front_scroll_to_main_link_target',
        'label'       => 'Main Button Target',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'std'          => '_blank',
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
        'id'          => 'ut_front_scroll_to_main_style',
        'label'       => 'Choose Main Hero Button Style',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'std'          => 'default',
        'choices'     => array( 
          array(
            'value'       => 'default',
            'for'         => array(''),
            'label'       => 'default'
          ),
          array(
            'value'       => 'custom',
            'for'         => array('ut_front_hrbtn'),
            'label'       => 'custom'
          ),      
        ),
      ),
      
      array(
        'id'          => 'ut_front_hrbtn',
        'label'       => 'Custom Button Styling',
        'desc'        => '',
        'type'        => 'button_builder',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
      ),
      
      array(
        'id'          => 'ut_front_second_button',
        'label'       => 'Need a second button?',
        'desc'        => 'You can optionally style this button inside the "Hero Styling" tab.',
        'type'        => 'radio_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'std'          => 'off',
        'choices'     => array( 
          array(
            'value'       => 'off',
            'for'         =>  array(''),
            'label'       => 'no thanks!'
          ),
          array(
            'value'       => 'on',
            'for'         => array('ut_front_second_button_text','ut_front_second_button_url_type','ut_front_second_button_scroll_target','ut_front_second_button_url','ut_front_second_target'),
            'label'       => 'yes please!'
          ),          
        )
      ),
      
      array(
        'id'          => 'ut_front_second_button_text',
        'label'       => 'Second Button Text',
        'desc'        => 'Enter your desired buttontext.',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
      
      array(
        'id'          => 'ut_front_second_button_url_type',
        'label'       => 'Second Button Link Type',
        'desc'        => 'Would you like to link to a section or external URL?"',
        'type'        => 'radio_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'std'          => 'section',
        'choices'     => array( 
          array(
            'value'       => 'section',
            'for'         =>  array('ut_front_second_button_scroll_target'),
            'label'       => 'to a section of the front page!'
          ),
          array(
            'value'       => 'external',
            'for'         =>  array('ut_front_second_button_url','ut_front_second_button_target'),
            'label'       => 'to an external url!'
          ),          
        )
      ),      
      
      array(
        'id'          => 'ut_front_second_button_scroll_target',
        'label'       => 'Scroll to Section ( for Second Button )',
        'desc'        => 'Select the section you like to scroll to. Leave empty ( set to -- Choose One -- ) to scroll to the first available section.',
        'type'        => 'section-select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
      
      array(
        'id'          => 'ut_front_second_button_url',
        'label'       => 'Second Button URL',
        'desc'        => 'Enter your desired URL. Do not forget to place "http://" in front of your link.',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
      
      array(
        'id'          => 'ut_front_second_button_target',
        'label'       => 'Second Button Target',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'std'          => '_blank',
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
        'id'          => 'ut_front_second_button_style',
        'label'       => 'Choose hero second button style',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'std'          => 'default',
        'choices'     => array( 
          array(
            'value'       => 'default',
            'for'         => array(),
            'label'       => 'default'
          ),
          array(
            'value'       => 'custom',
            'for'         => array('ut_front_second_hrbtn'),
            'label'       => 'custom'
          ),      
        ),
      ),
      
      array(
        'id'          => 'ut_front_second_hrbtn',
        'label'       => 'Custom Button Styling',
        'desc'        => '',
        'type'        => 'button_builder',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
      ),      
      
      array(
        'id'          => 'ut_front_hero_buttons_margin',
        'label'       => 'Buttons Margin Top',
        'desc'        => 'Increase the space between Hero Caption Title and Hero Buttons. (optional) - default 0px',
        'type'        => 'text',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
      ),      
      
      array(
        'id'          => 'ut_front_hero_down_arrow',
        'label'       => 'Activate Scroll Down Arrow?',
        'desc'        => 'A large double lined down arrow.',
        'type'        => 'radio_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings',
        'std'          => 'off',
        'choices'     => array( 
          array(
            'value'       => 'off',
            'for'         =>  array(''),
            'label'       => 'no thanks!'
          ),
          array(
            'value'       => 'on',
            'for'         => array(
                'ut_front_hero_down_arrow_scroll_target',
                'ut_front_hero_down_arrow_scroll_position',
                'ut_front_hero_down_arrow_scroll_position_vertical',
                'ut_front_hero_down_arrow_color',
            ),
            'label'       => 'yes please!'
          ),          
        )
      ),
      
      array(
        'id'          => 'ut_front_hero_down_arrow_scroll_target',
        'label'       => 'Scroll to Section ( for Scroll Down Arrow )',
        'desc'        => 'Select the section you like to scroll to. Leave empty ( set to -- Choose One -- ) to scroll to the first available section.',
        'type'        => 'section-select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
    
      array(
        'id'          => 'ut_front_hero_down_arrow_scroll_position',
        'label'       => 'Scroll Down Arrow Horizontal Position',
        'type'        => 'numeric_slider',
        'std'         => '50',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),
      
      array(
        'id'          => 'ut_front_hero_down_arrow_scroll_position_vertical',
        'label'       => 'Scroll Down Arrow Vertical Position',
        'type'        => 'numeric_slider',
        'std'         => '80',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),      
      
      array(
        'id'          => 'ut_front_hero_down_arrow_color',
        'label'       => 'Scroll Down Arrow Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_hero_settings'
      ),      
      
      /*
      |--------------------------------------------------------------------------
      | Front Header Configuration
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_front_navigation_settings_menu',
        'subid'       => 'ut_front_navigation_settings',
        'label'       => 'Header / Navigation',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
      ),
      
      array(
        'id'          => 'ut_front_navigation_setting_headline',
        'label'       => 'Navigation',
        'desc'        => '<h2 class="section-headline">Header / Navigation</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_navigation_settings',
      ),

      array(
        'id'         	=> 'ut_front_navigation_config',
        'section'       => 'ut_front_page_settings',
        'subsection'    => 'ut_front_navigation_settings',
        'label'       	=> 'Use Global Navigation Settings?',
        'toplevel'      => true,
        'type'        	=> 'select_group',
        'choices'     	=> array(          
          array(
            'label'       => 'yes',
            'for'         => array(''),
            'value'       => 'on'
          ),
          array(
            'label'       => 'no',
            'for'         => array(
                'ut_front_navigation_skin',
                'ut_front_navigation_skin_dark_bgcolor',
                'ut_front_navigation_skin_light_bgcolor',
                'ut_front_navigation_skin_bgcolor_opacity',
                'ut_front_navigation_shadow',
                'ut_front_navigation_width',
                'ut_front_navigation_font_weight',
                'ut_front_navigation_state',
                'ut_front_navigation_transparent_border',
                'ut_front_navigation_level_one_color',
                'ut_front_navigation_level_one_icon_color'
            ),
            'value'       => 'off'
          )	  
        ),
        'std'         	=> 'on'
      ),
             
      array(
        'id'          => 'ut_front_navigation_skin',
        'label'       => 'Header / Navigation Color Skin',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_navigation_settings',
        'std'         => 'ut-header-light',
        'choices'     => array( 
          array(
            'value'       => 'ut-header-dark',
            'for'         => array(
                'ut_front_navigation_skin_dark_bgcolor'
            ),
            'label'       => 'Dark'
          ),
          array(
            'value'       => 'ut-header-light',
            'for'         => array(
                'ut_front_navigation_skin_light_bgcolor'
            ),
            'label'       => 'Light'
          )
        ),
      ),
     
      array(
        'id'          => 'ut_front_navigation_shadow',
        'label'       => 'Header / Navigation Shadow',
        'desc'        => 'Activate Navigation / Header Shadow?',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_navigation_settings',
        'std'         => 'on',
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
        'id'          => 'ut_front_navigation_width',
        'label'       => 'Header / Navigation Width',
        'desc'        => '',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_navigation_settings',
        'std'         => 'centered',
        'choices'     => array( 
          array(
            'value'       => 'centered',
            'label'       => 'Centered'
          ),
          array(
            'value'       => 'fullwidth',
            'label'       => 'Fullwidth'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_front_navigation_state',
        'label'       => 'Always show Header / Navigation?',
        'desc'        => 'This option makes the navigation visible all the time. If you choose "On (transparent)". The navigation will turn into the chosen skin when reaching the main content."',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_navigation_settings',
        'std'         => 'off',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'label'       => 'On (with chosen skin)'
          ),
          array(
            'value'       => 'on_transparent',
            'label'       => 'On (transparent)'
          ),
          array(
            'value'       => 'off',
            'label'       => 'Off'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_front_navigation_transparent_border',
        'label'       => 'Activate Navigation Border Bottom?',
        'desc'        => '',
        'type'        => 'select',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_navigation_settings',
        'std'         => 'off',
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
        'id'          => 'ut_front_navigation_level_one_color',
        'label'       => 'Header / Navigation First Level Color',
        'desc'        => 'Change the font color of the first navigation level.',
        'type'        => 'colorpicker',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_front_navigation_level_one_icon_color',
        'label'       => 'Header / Navigation First Level Dot Color',
        'desc'        => 'Change the dot color of the first navigation level.',
        'type'        => 'colorpicker',
        'section'     => 'ut_front_page_settings',
        'subsection'  => 'ut_front_navigation_settings',
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Hero Blog Styling
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_blog_hero_styling_menu',
        'subid'       => 'ut_blog_hero_styling_settings',
        'label'       => 'Hero Styling',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
      ),
      
      array(
        'id'          => 'ut_blog_hero_styling_headline',
        'label'       => 'Hero Styling',
        'desc'        => '<h2 class="section-headline">Hero Styling</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_blog_hero_global_styling',
        'label'       => 'Use Global Hero Styling Settings?',
        'desc'        => '<strong>(optional)</strong>',
        'toplevel'    => true,
        'std'         => 'off',
        'type'        => 'select_group',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
        'choices'     => array( 
            array(
                'value'       => 'on',
                'for'         => array(),
                'label'       => 'yes, please!'
            ),
            array(
                'value'       => 'off',
                'for'         => array(
                    'ut_blog_hero_style',
                    'ut_blog_hero_align',
                    'ut_blog_hero_overlay_settings_headline',
                    'ut_blog_overlay',
                    'ut_blog_overlay_effect_settings_headline',
                    'ut_blog_overlay_effect',
                    'ut_blog_overlay_effect_style',
                    'ut_blog_overlay_effect_color',
                    'ut_blog_overlay_pattern',
                    'ut_blog_overlay_pattern_style',
                    'ut_blog_overlay_color',
                    'ut_blog_overlay_color_opacity',
                    'ut_blog_scroll_to_main_style',
                    'ut_blog_hero_buttons_margin',
                    'ut_blog_hrbtn',
                    'ut_blog_second_button_style',
                    'ut_blog_second_hrbtn',
                    'ut_blog_hero_fancy_border_setting_headline',
                    'ut_blog_border_setting_headline',
                    'ut_blog_hero_border_bottom',
                    'ut_blog_hero_border_bottom_color',
                    'ut_blog_hero_border_bottom_width',
                    'ut_blog_hero_border_bottom_style',
                    'ut_blog_hero_fancy_border_setting_headline',
                    'ut_blog_hero_fancy_border',
                    'ut_blog_fancy_border_color',
                    'ut_blog_fancy_border_background_color',
                    'ut_blog_fancy_border_size',
                ),
                'label'       => 'no, thanks!'
            )
            
        ) /* end choices */
      ),
      
      array(
        'id'          => 'ut_blog_hero_style',
        'label'       => 'Hero Style',
        'desc'        => 'Choose between 11 different hero header styles. If you are using a slider as your desired hero type, you can define an individual style for each slide.<a href="#" class="ut-hero-preview">Preview Hero Styles</a>',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
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
            'label'       => 'Style Seven',
            'src'         => ''
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
        'id'          => 'ut_blog_hero_align',
        'label'       => 'Choose Hero Alignment',
        'type'        => 'select',
        'desc'          => '',
        'std'          => 'center',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
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
        'id'          => 'ut_blog_hero_overlay_settings_headline',
        'label'       => 'Hero Overlay Settings',
        'desc'        => '<h2 class="section-headline">Hero Overlay Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
      ),
      
      
      array(
        'id'          => 'ut_blog_overlay',
        'label'       => 'Activate Hero Overlay?',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'select_group',
        'toplevel'    => false,
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'for'         => array(
                'ut_blog_overlay_color',
                'ut_blog_overlay_color_opacity',
                'ut_blog_overlay_pattern',
                'ut_blog_overlay_pattern_style'
            ),
            'label'       => 'On'
          ),
          array(
            'value'       => 'off',
            'for'         => array(
            
            ),
            'label'       => 'Off'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_blog_overlay_color',
        'label'       => 'Overlay Color',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'colorpicker',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
      ),
      
      array(
        'id'          => 'ut_blog_overlay_color_opacity',
        'label'       => 'Color Opacity',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'numeric-slider',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
        'min_max_step'=> '0,1,0.1'
      ),
      
      array(
        'id'          => 'ut_blog_overlay_pattern',
        'label'       => 'Activate Overlay Pattern',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
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
        'id'          => 'ut_blog_overlay_pattern_style',
        'label'       => 'Overlay Pattern Style',
        'desc'        => '<strong>(optional)</strong>',
        'std'         => 'style_one',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
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
        'id'          => 'ut_blog_overlay_effect_settings_headline',
        'label'       => 'Hero Overlay Effect Settings',
        'desc'        => '<h2 class="section-headline">Hero Overlay Effect Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
      ),      
      
      array(
        'id'          => 'ut_blog_overlay_effect',
        'label'       => 'Activate Overlay Animation Effect?',
        'desc'        => '<strong>(optional) Keep in mind, that this effect uses canvas objects for animation. Old Browsers do not support this feature!</strong>',
        'std'         => 'off',
        'toplevel'    => false,
        'type'        => 'select_group',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_styling_settings',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'for'         => array(
                'ut_blog_overlay_effect_style',
                'ut_blog_overlay_effect_color'
            ),
            'label'       => 'yes, please!'
          ),
          array(
            'value'       => 'off',
            'for'         => array(
            
            ),
            'label'       => 'no, thanks!'
          )
        ),
      ),
      
        array(
            'id'          => 'ut_blog_overlay_effect_style',
            'label'       => 'Overlay Animation Effect',
            'desc'        => 'choose between 2 awesome animation effects!',
            'std'         => 'dots',
            'type'        => 'select',
            'section'     => 'ut_blog_settings',
            'subsection'  => 'ut_blog_hero_styling_settings',
            'choices'     => array( 
                array(
                    'value'       => 'dots',
                    'label'       => 'Connecting Dots'
                ),
                array(
                    'value'       => 'bubbles',
                    'label'       => 'Rising Bubbles'
                )
            ) /* end choices */
        ),
      
        array(
            'id'          => 'ut_blog_overlay_effect_color',
            'label'       => 'Overlay Effect Color',
            'desc'        => '<strong>(optional)</strong>. Leave this field empty if you like to keep the theme accentcolor as effect color.',
            'type'        => 'colorpicker',
            'section'     => 'ut_blog_settings',
            'subsection'  => 'ut_blog_hero_styling_settings',
        ),

        array(
            'id'          => 'ut_blog_border_setting_headline',
            'label'       => 'Border Settings',
            'desc'        => '<h2 class="section-headline">Hero Custom Border</h2>',
            'type'        => 'section_headline',
            'section'     => 'ut_blog_settings',
            'subsection'  => 'ut_blog_hero_styling_settings',
        ),
      
        array(
            'id'          => 'ut_blog_hero_border_bottom',
            'label'       => 'Activate Border at Hero Bottom?',
            'std'         => 'off',
            'section'     => 'ut_blog_settings',
            'subsection'  => 'ut_blog_hero_styling_settings',                    
            'type'        => 'select_group',
            'toplevel'    => false,
            'choices'     => array(              
                array(
                    'label'       => 'yes, please!',
                    'for'         => array(
                        'ut_blog_hero_border_bottom_color',
                        'ut_blog_hero_border_bottom_width',
                        'ut_blog_hero_border_bottom_style'
                    ),
                    'value'       => 'on'
              ),
              array(
                    'label'       => 'no, thanks!',
                    'for'         => array(''),
                    'value'       => 'off'
              ) 
            )/* ednf choices */

        ),
      
        array(
            'id'          => 'ut_blog_hero_border_bottom_color',
            'label'       => 'Border Bottom Color',
            'type'        => 'colorpicker',
            'desc'        => '<strong>(optional)</strong>',
            'section'     => 'ut_blog_settings',
            'subsection'  => 'ut_blog_hero_styling_settings',
        ),
          
        array(
            'id'          => 'ut_blog_hero_border_bottom_width',
            'label'       => 'Border Bottom Width',
            'desc'        => '<strong>(optional)</strong>',
            'type'        => 'numeric-slider',
            'min_max_step'=> '1,100',
            'section'     => 'ut_blog_settings',
            'subsection'  => 'ut_blog_hero_styling_settings',
        ),
      
        array(
            'id'          => 'ut_blog_hero_border_bottom_style',
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
            'section'       => 'ut_blog_settings',
            'subsection'    => 'ut_blog_hero_styling_settings',
        ),
      
      
        array(
        'id'          => 'ut_blog_hero_fancy_border_setting_headline',
        'label'       => 'Fancy Border Settings',
        'desc'        => '<h2 class="section-headline">Hero Fancy Border</h2>',
        'type'        => 'section_headline',
        'section'       => 'ut_blog_settings',
        'subsection'    => 'ut_blog_hero_styling_settings',
      ),            
      array(
        'id'          => 'ut_blog_hero_fancy_border',
        'label'       => 'Activate Fancy Border?',
        'desc'        => '',
        'type'        => 'select_group',
        'toplevel'    => false,
        'choices'     => array(              
          array(
            'label'       => 'yes, please!',
            'for'         => array(
                            'ut_blog_fancy_border_color',
                            'ut_blog_fancy_border_background_color',
                            'ut_blog_fancy_border_size'
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
        'section'       => 'ut_blog_settings',
        'subsection'    => 'ut_blog_hero_styling_settings',
      ),      
      array(
        'id'          	=> 'ut_blog_fancy_border_color',
        'label'       	=> 'Color',
        'type'        	=> 'colorpicker',
        'desc'       	=> '<strong>(optional)</strong>',
        'section'       => 'ut_blog_settings',
        'subsection'    => 'ut_blog_hero_styling_settings',
      ),      
      array(
        'id'          	=> 'ut_blog_fancy_border_background_color',
        'label'       	=> 'Background Color',
        'type'        	=> 'colorpicker',
        'desc'       	=> '<strong>(optional)</strong>',
        'section'       => 'ut_blog_settings',
        'subsection'    => 'ut_blog_hero_styling_settings',
      ),      
      array(
        'id'            => 'ut_blog_fancy_border_size',
        'label'         => 'Size',
        'desc'          => '<strong>(optional)</strong> - default 10px',
        'type'          => 'text',
        'section'       => 'ut_blog_settings',
        'subsection'    => 'ut_blog_hero_styling_settings',
      ), 
      
      /*
      |--------------------------------------------------------------------------
      | Hero Blog Type
      |--------------------------------------------------------------------------
      */
      array(
        'id'          => 'ut_blog_hero_background_menu',
        'subid'       => 'ut_blog_hero_background_settings',
        'label'       => 'Hero Type',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings'
      ),
      
      array(
        'id'          => 'ut_blog_hero_background_headline',
        'label'       => 'Hero Type',
        'desc'        => '<h2 class="section-headline">Hero Type</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_blog_header_type',
        'label'       => 'Header Type',
        'type'        => 'select_group',
        'toplevel'    => true,
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'choices'     => array( 
          array(
            'value'       => 'image',
            'for'         => array(
                                'ut_blog_header_image',
                                'ut_blog_header_parallax',
                                'ut_blog_header_rain',
                                'ut_blog_header_rain_sound'
            ),
            'label'       => 'Single Background Image'
          ),
          array(
            'value'       => 'animatedimage',
            'for'         => array('ut_blog_header_animatedimage'),
            'label'       => 'Animated Single Background Image'
          ),
          array(
            'value'       => 'splithero',
            'for'         => array(
                                'ut_blog_header_image',
                                'ut_blog_header_parallax',
                                'ut_blog_header_rain',
                                'ut_blog_header_rain_sound',
                                'ut_blog_split_image',
                                'ut_blog_split_image_max_width',
                                'ut_blog_split_image_effect',
                                'ut_blog_split_content_type',
                                'ut_blog_split_video',
                                'ut_blog_split_video_box',
                                'ut_blog_split_video_box_style',
                                'ut_blog_split_video_box_padding'
            ),
            'label'       => 'Split Hero'
          ),
          array(
            'value'       => 'slider',
            'for'         => array(
                                'ut_blog_slider',
                                'blog_animation_speed',
                                'blog_slideshow_speed',
                                'ut_blog_slider_color_settings_headline',
                                'ut_blog_slider_arrow_background_color',
                                'ut_blog_slider_arrow_background_color_hover',
                                'ut_blog_slider_arrow_color',
                                'ut_blog_slider_arrow_color_hover',
            ),
            'label'       => 'Background Image Slider'
          ),
          array(
            'value'       => 'transition',
            'for'         => array(
                                'ut_blog_fancy_slider',
                                'blog_fancy_slider_effect',
                                'blog_fancy_slider_height'                                
            ),
            'label'       => 'Fancy Transition Slider'
          ),
          array(
            'value'       => 'tabs',
            'for'         => array(
                                'ut_blog_header_image',
                                'ut_blog_header_parallax',
                                'ut_blog_tabs_headline',
                                'ut_blog_tabs_headline_style',
                                'ut_blog_tabs_tablet_color',
                                'ut_blog_tabs_tablet_shadow',
                                'ut_blog_tabs'
            ),
            'label'       => 'Tablet Slider'
          ),
          array(
            'value'       => 'video',
            'for'         => array(
                                'ut_blog_video_setting_description',
                                'ut_blog_video_containment',
                                'ut_blog_video_source',
                                'ut_blog_video',
                                'ut_blog_video_custom',
                                'ut_blog_video_mp4',
                                'ut_blog_video_ogg',
                                'ut_blog_video_webm',
                                'ut_blog_video_sound',
                                'ut_blog_video_loop',
                                'ut_blog_video_preload',
                                'ut_video_mute_button_blog',
                                'ut_blog_video_volume',
                                'ut_blog_video_poster'
            ),
            'label'       => 'Video Header'
          ),
          array(
            'value'       => 'custom',
            'for'         => array('blog_hero_custom_shortcode'),
            'label'       => 'Custom Shortcode'
          ),
          array(
            'value'       => 'dynamic',
            'for'         => array(
                                'ut_blog_header_image',
                                'ut_blog_header_parallax',
                                'blog_hero_dynamic_height',
                                'blog_hero_dynamic_content_v_align',
                                'blog_hero_dynamic_content_margin_bottom'
             ),         
            'label'       => 'Dynamic Hero ( dynamic height )'
          )
        ),
      ),
      
      /*
      | Image Tab Slider
      */
      
      array(
        'id'          => 'ut_blog_tabs_headline',
        'label'       => 'Tablet Headline',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
      ),
      
      array(
        'id'          => 'ut_blog_tabs_headline_style',
        'label'       => 'Tablet Headline Font Style',
        'desc'          => '',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'std'          => 'global',
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
        'id'          => 'ut_blog_tabs_tablet_color',
        'label'       => 'Tablet Color',
        'desc'        => '',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
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
        'id'          => 'ut_blog_tabs_tablet_shadow',
        'label'       => 'Tablet Shadow',
        'desc'        => '',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
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
        'id'          => 'ut_blog_tabs',
        'label'       => 'Manage Tablet Images',
        'type'        => 'list-item',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
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
        'id'          => 'ut_blog_header_parallax',
        'label'       => 'Activate Parallax',
        'desc'        => 'Keep in mind, that activating this option can reduce your website performance.',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
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
        'id'          => 'ut_blog_header_rain',
        'label'       => 'Activate Rain Effect',
        'desc'        => 'Keep in mind, that activating this option can reduce your website performance.',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'std'         => 'off',
        'subsection'  => 'ut_blog_hero_background_settings', 
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
        'id'          => 'ut_blog_header_rain_sound',
        'label'       => 'Activate Rain Sound',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'std'          => 'off',
        'subsection'  => 'ut_blog_hero_background_settings',
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
        'id'          => 'ut_blog_header_image',
        'label'       => 'Header Image',
        'desc'        => 'For best image results, we recommend to upload an image with minimum size of 1600x900 pixel or maximum size of 1920x1080(optimal) pixel. Also try to avoid uploading images with more than 200-300Kb size. Keep in mind, that you are not able to set a background position or attachment if the parallax option has been set to "on".',
        'type'        => 'background',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      array(
        'id'          => 'ut_blog_split_content_type',
        'label'       => 'Hero Split Content Type',
        'desc'        => '',
        'type'        => 'select_group',
        'choices'     => array( 
          array(
            'value'       => 'image',
            'for'         => array('ut_blog_split_image','ut_blog_split_image_max_width','ut_blog_split_image_effect'),
            'label'       => 'Image'
          ),
          array(
            'value'       => 'video',
            'for'         => array('ut_blog_split_video','ut_blog_split_video_box','ut_blog_split_video_box_style','ut_blog_split_video_box_padding'),
            'label'       => 'Video'
          )
        ),
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      array(
        'id'          => 'ut_blog_split_video',
        'label'       => 'Hero Split Video',
        'desc'        => 'This video will display on the right side of the hero caption. It will not display on mobile devices! Please use the only embed codes from youtube or vimeo.',
        'type'        => 'textarea_simple',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      array(
          'id'          => 'ut_blog_split_video_box',
          'label'       => 'Activate Hero Split Video Box',
          'desc'        => 'Display a shadowed box around the video.',
          'type'        => 'select_group',
          'choices'     => array( 
            array(
              'value'       => 'on',
              'for'         => array('ut_blog_split_video_box_style','ut_blog_split_video_box_padding'),
              'label'       => 'yes, please!'
            ),
            array(
              'value'       => 'off',
              'for'         => array(),
              'label'       => 'no, thanks!'
            )
          ),
          'section'     => 'ut_blog_settings',
          'subsection'  => 'ut_blog_hero_background_settings'
          
      ),
      
      array(
          'id'          => 'ut_blog_split_video_box_style',
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
          'section'     => 'ut_blog_settings',
          'subsection'  => 'ut_blog_hero_background_settings'
      ),       
      
       array(
          'id'          => 'ut_blog_split_video_box_padding',
          'label'       => 'Hero Split Video Box Padding',
          'desc'        => 'Set padding of the box in pixel e.g. 20px. default: 20px',
          'type'        => 'text',
          'section'     => 'ut_blog_settings',
          'subsection'  => 'ut_blog_hero_background_settings'
      ),
       
      array(
        'id'          => 'ut_blog_split_image',
        'label'       => 'Hero Split Image',
        'desc'        => 'This image will display on the right side of the hero caption. It will not display on mobile devices!',
        'type'        => 'upload',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
       array(
        'id'          => 'ut_blog_split_image_max_width',
        'label'       => 'Image Max Width',
        'desc'        => 'Adjust this value until the image fits inside the hero. Default "60".',
        'type'        => 'numeric-slider',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'std'         => '60',
        'min_max_step'=> '0,100,1'
      ),
      
       array(
        'id'          => 'ut_blog_split_image_effect',
        'label'       => 'Slide Effect',
        'desc'          => '',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'std'          => 'none',
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
      
      
      /*
      | Animated Image Type
      */
      
      array(
        'id'          => 'ut_blog_header_animatedimage',
        'label'       => 'Header Image',
        'desc'        => '',
        'type'        => 'upload',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      /*
      | Slider Type
      */
      
       /*array(
        'id'          => 'blog_animation',
        'label'       => 'Slide Effect',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'choices'     => array( 
          array(
            'value'       => 'fade',
            'label'       => 'Fade'
          ),
          array(
            'value'       => 'slide',
            'label'       => 'Slide'
          )
        ),
      ),*/
      
      array(
        'id'          => 'blog_slideshow_speed',
        'label'       => 'Slideshow Speed',
        'desc'        => 'Set speed of the slideshow cycling, in milliseconds.',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      array(
        'id'          => 'blog_animation_speed',
        'label'       => 'Animation Speed',
        'desc'        => 'Set speed of animations, in milliseconds.',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      array(
        'id'          => 'ut_blog_slider',
        'label'       => 'Blog Slider',
        'type'        => 'list-item',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'settings'    => array( 
          array(
            'id'          => 'image',
            'label'       => 'Image',
            'type'        => 'upload',
          ),
          array(
            'id'          => 'style',
            'label'       => 'Caption Style',
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
            'id'          => 'font_style',
            'label'       => 'Caption Font Style',
            'desc'          => 'Setting this option to default will load the hero font style ( which has been set under Blog Settings -> Hero Settings).',
            'type'        => 'select',
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
            'desc'          => '',
            'std'          => 'center',
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
            'std'          => 'top',
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
            'label'       => 'Caption Slogan',
            'type'        => 'textarea-simple',
            'rows'        => '3'
          ),
          array(
            'id'          => 'description',
            'label'       => 'Caption',
            'type'        => 'textarea-simple',
            'rows'        => '3'
          ),
          array(
            'id'          => 'catchphrase',
            'label'       => 'Caption Description',
            'type'        => 'textarea-simple',
            'rows'        => '3'
          ),
          array(
            'id'          => 'link',
            'label'       => 'Link',
            'type'        => 'text'
          ),
          array(
            'id'          => 'link_description',
            'label'       => 'Link Button Text',
            'type'        => 'text'
          )
        )
      ),    
      
      
      array(
        'id'          => 'ut_blog_slider_color_settings_headline',
        'label'       => 'Slider Navigation Color Settings',
        'desc'        => '<h2 class="section-headline">Slider Navigation Color Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
      ),
      array(
        'id'          => 'ut_blog_slider_arrow_background_color',
        'label'       => 'Arrow Background Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
      ),
      array(
        'id'          => 'ut_blog_slider_arrow_background_color_hover',
        'label'       => 'Arrow Background Color Hover',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
      ),
      array(
        'id'          => 'ut_blog_slider_arrow_color',
        'label'       => 'Arrow Color',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
      ),
      array(
        'id'          => 'ut_blog_slider_arrow_color_hover',
        'label'       => 'Arrow Color Hover',
        'type'        => 'colorpicker',
        'mode'        => 'rgb',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
      ),
      
      /*
      | Fancy Slider
      */
      
      array(
        'id'          => 'ut_blog_fancy_slider',
        'label'       => 'Fancy Slider',
        'type'        => 'list-item',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'settings'    => array( 
          array(
            'id'          => 'image',
            'label'       => 'Image',
            'type'        => 'upload',
          ),
          array(
            'id'          => 'style',
            'label'       => 'Caption / Hero Style',
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
            'label'       => 'Caption / Hero Font Style',
            'desc'          => 'Setting this option to default will load the hero font style ( which has been set under Front Page Settings -> Hero Settings ).',
            'type'        => 'select',
            'std'          => 'global',
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
            'id'          => 'expertise',
            'label'       => 'Caption Slogan',
            'type'        => 'textarea-simple',
            'rows'        => '3'
          ),
          array(
            'id'          => 'description',
            'label'       => 'Caption',
            'type'        => 'textarea-simple',
            'rows'        => '3'
          ),
          array(
            'id'          => 'catchphrase',
            'label'       => 'Caption Description',
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
        'id'          => 'blog_fancy_slider_effect',
        'label'       => 'Slide Effect',
        'desc'        => 'Choose an effect for your slider, this effect will affect all slides.',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'std'          => 'fxSoftScale',
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
        'id'          => 'blog_fancy_slider_height',
        'label'       => 'Slider Height',
        'desc'        => 'Set height of the slideshow in pixel e.g. 600px.',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
      ),
      
      /*
      | Custom Shortcode
      */
      
      array(
        'id'          => 'blog_hero_custom_shortcode',
        'label'       => 'Custom Shortcode',
        'desc'        => '',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      /*
      | Dynamic
      */
      
      array(
        'id'          => 'blog_hero_dynamic_height',
        'label'       => 'Custom Hero Height',
        'type'        => 'numeric_slider',
        'std'         => '60',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      array(
        'id'          => 'blog_hero_dynamic_content_v_align',
        'label'       => 'Hero Content Vertical Align',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',       
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
        'id'          => 'blog_hero_dynamic_content_margin_bottom',
        'label'       => 'Content Margin Bottom',
        'desc'        => 'value in pixel e.g. 40px.',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),  
           
      /*
      | Video
      */
            
      array(
        'id'          => 'ut_blog_video_setting_description',
        'label'       => 'Video',
        'desc'        => 'At the current stage the theme only supports youtube videos as well as selfhosted videos. Custom Player are possible, but using them will cause many hero options not taking effect. If a mobile or tablet device is visiting the site, the video hero support will be dropped and the theme will display a poster image instead. The main reason for this behavior is, that most mobile and tablet devices do not support the video backgrounds.',
        'type'        => 'textblock',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      array(
        'id'          => 'ut_blog_video_source',
        'label'       => 'Video Source',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'std'          => 'youtube',
        'choices'     => array( 
          array(
            'value'       => 'youtube',
            'for'         => array('ut_blog_video','ut_blog_video_sound','ut_blog_video_loop','ut_video_mute_button_blog','ut_blog_video_volume','ut_blog_video_poster'),
            'label'       => 'Youtube'
          ),
          array(
            'value'       => 'selfhosted',
            'for'         => array('ut_blog_video_mp4','ut_blog_video_ogg','ut_blog_video_webm','ut_blog_video_sound','ut_blog_video_loop','ut_blog_video_preload','ut_video_mute_button_blog','ut_blog_video_volume','ut_blog_video_poster'),
            'label'       => 'Selfthosted'
          ),
          array(
            'value'       => 'custom',
            'for'         => array('ut_blog_video_custom'),
            'label'       => 'Custom Embedded Code'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_blog_video_containment',
        'label'       => 'Set this Video as background too?',
        'desc'        => 'This option here places the video "behind" the blog page instead of only inside the hero. As a result, transparent contact section will also contain this video. This option does only effect on youtube and selfhosted videos. Custom Embedded Videos are not supported.',
        'std'         => 'hero',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'choices'     => array( 
          array(
            'value'       => 'body',
            'label'       => 'yes, please!'
          ),
          array(
            'value'       => 'hero',
            'label'       => 'no, thanks!'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_blog_video',
        'label'       => 'Video URL for blog.',
        'desc'        => 'Please insert the url only e.g. http://youtu.be/gvt_YFuZ8LA . Please do not insert the complete embedded code! This video will be displayed on the main blog page.',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
       array(
        'id'          => 'ut_blog_video_custom',
        'label'       => 'Video embedded code for blog.',
        'desc'        => 'Please insert the complete embedded code of your favorite video hoster! This video will be displayed on the main blog page. Keep in mind, that hero settings like "Hero Caption" do not display if this type of video source is active.',
        'type'        => 'textarea-simple',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      array(
        'id'          => 'ut_blog_video_mp4',
        'label'       => 'MP4',
        'desc'        => '',
        'type'        => 'upload',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
       array(
        'id'          => 'ut_blog_video_ogg',
        'label'       => 'OGG',
        'desc'        => '',
        'type'        => 'upload',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
       array(
        'id'          => 'ut_blog_video_webm',
        'label'       => 'WEBM',
        'desc'        => '',
        'type'        => 'upload',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      array(
        'id'          => 'ut_blog_video_sound',
        'label'       => 'Activate video sound after page is loaded?',
        'desc'        => '<strong>(optional)</strong>. Play sound directly when page is loaded.',
        'std'         => 'off',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'choices'     => array( 
          array(
            'label'       => 'yes, please!',
            'value'       => 'on'            
          ),
          array(
            'label'       => 'no, thanks!',
            'value'       => 'off',
          )
        ),
      ),
      
      array(
        'id'              => 'ut_blog_video_loop',
        'label'           => 'Loop Video?',
        'desc'            => '',
        'type'            => 'select',
        'section'       => 'ut_blog_settings',
        'subsection'    => 'ut_blog_hero_background_settings',
        'choices'         => array(
          
          array(
            'label'       => 'yes, please!',
            'value'       => 'on'
          ),
          array(
            'label'       => 'no, thanks!',
            'value'       => 'off'
          )
          
        ),
        'std'             => 'on'
      ),
      
      array(
        'id'              => 'ut_blog_video_preload',
        'label'           => 'Preload Video?',
        'desc'            => '',
        'type'            => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'choices'         => array(
          
          array(
            'label'       => 'yes, please!',
            'value'       => 'on'
          ),
          array(
            'label'       => 'no, thanks!',
            'value'       => 'off'
          )
          
        ),
        'std'             => 'on'
      ),
      
      array(
        'id'              => 'ut_video_mute_button_blog',
        'label'           => 'Show Mute Button?',
        'desc'            => '',
        'type'            => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'choices'         => array(          
          array(
            'label'       => 'yes, please!',
            'value'       => 'show'            
          ),
          array(
            'label'       => 'no, thanks!',
            'value'       => 'hide'            
          )          
        ),
        'std'             => 'hide'
      ),
      
      array(
        'id'          => 'ut_blog_video_volume',
        'label'       => 'Video Volume',
        'desc'        => '1-100 - default 5',
        'std'         => '5',
        'type'        => 'numeric-slider',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings',
        'min_max_step'=> '0,100,1'
      ),
      
      array(
        'id'          => 'ut_blog_video_poster',
        'label'       => 'Poster Image',
        'desc'        => 'This image will be displayed instead of the video on mobile devices.',
        'type'        => 'upload',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_background_settings'
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Hero Blog Setting
      |--------------------------------------------------------------------------
      */ 
      
      array(
        'id'          => 'ut_blog_hero_settings_menu',
        'subid'       => 'ut_blog_hero_settings',
        'label'       => 'Hero Content',
        'desc'        => '<h2 class="section-headline">Hero Content</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings'
      ),
      
      array(
        'id'          => 'ut_blog_hero_settings_headline',
        'label'       => 'Hero Content',
        'desc'        => '<h2 class="section-headline">Hero Content</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_hero_global_content_styling',
        'label'       => 'Use Global Hero Content Color Settings?',
        'desc'        => '<strong>(optional)</strong>',
        'toplevel'    => true,
        'std'         => 'off',
        'type'        => 'select_group',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'choices'     => array( 
            array(
                'value'       => 'on',
                'for'         => array(),
                'label'       => 'yes, please!'
            ),
            array(
                'value'       => 'off',
                'for'         => array(
                    'ut_blog_expertise_slogan_color', 
                    'ut_blog_expertise_slogan_background_color',
                    'ut_blog_company_slogan_color',
                    'ut_blog_catchphrase_color',
                ),
                'label'       => 'no, thanks!'
            )
            
        ) /* end choices */
      ),
      
      array(
        'id'          => 'ut_blog_custom_slogan',
        'label'       => 'Custom Hero HTML',
        'desc'        => 'This field appears above the Hero Caption Slogan.',
        'type'        => 'textarea',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'rows'        => '10'
      ),
      
      array(
        'id'          => 'ut_blog_expertise_slogan_settings_headline',
        'label'       => 'Hero Caption',
        'desc'        => '<h2 class="section-headline">Hero Caption Slogan Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_expertise_slogan',
        'label'       => 'Hero Caption Slogan',
        'desc'        => 'This element appears above the Hero Caption.',
        'type'        => 'textarea-simple',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'rows'        => '5'
      ),
            
      array(
        'id'          => 'ut_blog_expertise_slogan_color',
        'label'       => 'Hero Caption Slogan Color',
        'desc'        => '<strong>(optional)</strong> - set an alternate color for <strong>Hero Caption Slogan</strong>.',
        'type'        => 'colorpicker',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_expertise_slogan_background_color',
        'label'       => 'Hero Caption Slogan Background Color',
        'desc'        => '<strong>(optional)</strong> - set an alternate background color for <strong>Hero Caption Slogan</strong>.',
        'type'        => 'colorpicker',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_expertise_margin',
        'label'       => 'Spacing',
        'desc'        => 'Increase the space between Hero Caption Slogan and Hero Caption. (optional) - default 0px',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_company_slogan_settings_headline',
        'label'       => 'Hero Caption Title Settings',
        'desc'        => '<h2 class="section-headline">Hero Caption Title Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      
      array(
        'id'          => 'ut_blog_company_slogan',
        'label'       => 'Hero Caption Title',
        'desc'        => 'This field also accepts HTML tags and shortcodes such as word rotator for example.',
        'htmldesc'    => '&lt;span&gt; word &lt;/span&gt; = highlight word in themecolor',
        'type'        => 'textarea-simple',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'rows'        => '5'
      ),
      
      array(
        'id'          => 'ut_blog_company_slogan_color',
        'label'       => 'Hero Caption Title Color',
        'desc'        => '<strong>(optional)</strong> - set an alternative for Hero Caption Title.',
        'type'        => 'colorpicker',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_company_slogan_letterspacing',
        'label'       => 'Hero Caption Title Letterspacing',
        'desc'        => '<strong>(optional)</strong> - include "px" in your string. e.g. 2px',
        'htmldesc'    => '',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_company_slogan_uppercase',
        'label'       => 'Hero Caption Title Text Transform',
        'desc'        => 'Display the Hero Caption Title in uppercase letters?',
        'type'        => 'radio',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'std'          => 'on',
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
        'id'          => 'ut_blog_company_slogan_glow',
        'label'       => 'Hero Caption Title Gloweffect',
        'desc'        => 'Activate Glow Effect for Hero Caption Title?',
        'type'        => 'radio',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'std'         => 'off',
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
        'id'          => 'ut_blog_catchphrase_settings_headline',
        'label'       => 'Hero Caption Description Settings',
        'desc'        => '<h2 class="section-headline">Hero Caption Description Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_catchphrase',
        'label'       => 'Hero Caption Description',
        'desc'        => 'This field appears beneath the Hero Caption.',
        'type'        => 'textarea-simple',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'rows'        => '5'
      ),
      
      array(
        'id'          => 'ut_blog_catchphrase_color',
        'label'       => 'Hero Caption Description Color',
        'desc'        => '<strong>(optional)</strong> - set an alternate color for Hero Caption Description.',
        'type'        => 'colorpicker',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_catchphrase_websafe_font_style',
        'label'       => 'Hero Caption Description Font Setting',
        'type'        => 'typography',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_hero_button_settings_headline',
        'label'       => 'Hero Button Settings',
        'desc'        => '<h2 class="section-headline">Hero Button Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_scroll_to_main',
        'label'       => 'Scroll to Blog Text',
        'desc'        => 'Enter your desired text or leave this field empty to hide the button.',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_scroll_to_main_style',
        'label'       => 'Choose Main Hero Button Style',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'std'         => 'default',
        'choices'     => array( 
          array(
            'value'       => 'default',
            'for'         => array(''),
            'label'       => 'default'
          ),
          array(
            'value'       => 'custom',
            'for'         => array('ut_blog_hrbtn'),
            'label'       => 'custom'
          ),      
        ),
      ),
      
      array(
        'id'          => 'ut_blog_hrbtn',
        'label'       => 'Custom Button Styling',
        'desc'        => '',
        'type'        => 'button_builder',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_second_button',
        'label'       => 'Need a second button?',
        'desc'        => 'You can optionally style this button inside the "Hero Styling" tab.',
        'type'        => 'radio_group',
        'toplevel'    => 'true',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'std'          => 'off',
        'choices'     => array( 
          array(
            'value'       => 'off',
            'for'         => array(''),
            'label'       => 'no thanks!'
          ),
          array(
            'value'       => 'on',
            'for'         => array(
                'ut_blog_second_button_text',
                'ut_blog_second_button_url',
                'ut_blog_second_button_target',
                'ut_blog_second_button_style',
            ),
            'label'       => 'yes please!'
          ),          
        )
      ),
      
     array(
        'id'          => 'ut_blog_second_button_text',
        'label'       => 'Second Button Text',
        'desc'        => 'Enter your desired buttontext',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_second_button_url',
        'label'       => 'Second Button URL',
        'desc'        => 'Enter your desired URL. Do not forget to place "http://" in front of your link.',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_second_button_target',
        'label'       => 'Second Button Target',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'std'         => '_blank',
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
        'id'          => 'ut_blog_second_button_style',
        'label'       => 'Second Button Style',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'std'         => 'default',
        'choices'     => array( 
          array(
            'value'       => 'default',
            'for'         => array(''),
            'label'       => 'default'
          ),
          array(
            'value'       => 'custom',
            'for'         => array('ut_blog_second_hrbtn'),
            'label'       => 'custom'
          ),      
        ),
      ),
      
      array(
        'id'          => 'ut_blog_second_hrbtn',
        'label'       => 'Custom Button Styling',
        'desc'        => '',
        'type'        => 'button_builder',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_hero_buttons_margin',
        'label'       => 'Buttons Margin Top',
        'desc'        => 'Increase the space between Hero Caption Title and Hero Buttons. (optional) - default 0px',
        'type'        => 'text',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),  
      
      array(
        'id'          => 'ut_blog_hero_down_arrow',
        'label'       => 'Activate Scroll Down Arrow?',
        'desc'        => 'A large double lined down arrow.',
        'type'        => 'radio_group',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
        'std'          => 'off',
        'choices'     => array( 
          array(
            'value'       => 'off',
            'for'         =>  array(''),
            'label'       => 'no thanks!'
          ),
          array(
            'value'       => 'on',
            'for'         => array(
                'ut_blog_hero_down_arrow_scroll_position',
                'ut_blog_hero_down_arrow_scroll_position_vertical',
                'ut_blog_hero_down_arrow_color'
            ),
            'label'       => 'yes please!'
          ),          
        )
      ),
      
      array(
        'id'          => 'ut_blog_hero_down_arrow_scroll_position',
        'label'       => 'Scroll Down Arrow Horizontal Position',
        'type'        => 'numeric_slider',
        'std'         => '50',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),
      
      array(
        'id'          => 'ut_blog_hero_down_arrow_scroll_position_vertical',
        'label'       => 'Scroll Down Arrow Vertical Position',
        'type'        => 'numeric_slider',
        'std'         => '80',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ),      
      
      array(
        'id'          => 'ut_blog_hero_down_arrow_color',
        'label'       => 'Scroll Down Arrow Color',
        'type'        => 'colorpicker',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_hero_settings',
      ), 
      
      
      /*
      |--------------------------------------------------------------------------
      | Blog Header Configuration
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_blog_navigation_settings_menu',
        'subid'       => 'ut_blog_navigation_settings',
        'label'       => 'Header / Navigation',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
      ),
      
      array(
        'id'          => 'ut_blog_navigation_setting_headline',
        'label'       => 'Navigation',
        'desc'        => '<h2 class="section-headline">Header / Navigation</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_navigation_settings',
      ),

      array(
        'id'         	=> 'ut_blog_navigation_config',
        'section'       => 'ut_blog_settings',
        'subsection'    => 'ut_blog_navigation_settings',
        'label'       	=> 'Use Global Navigation Settings?',
        'toplevel'      => true,
        'desc'          => 'By setting this option to <strong>no</strong> you are able to overwrite the global navigation setting for your blog."',
        'type'        	=> 'select_group',
        'desc'        	=> '',
        'choices'     	=> array(          
          array(
            'label'       => 'yes',
            'for'         => array(''),
            'value'       => 'on'
          ),
          array(
            'label'       => 'no',
            'for'         => array(
                'ut_blog_navigation_skin',
                'ut_blog_navigation_skin_dark_bgcolor',
                'ut_blog_navigation_skin_light_bgcolor',
                'ut_blog_navigation_skin_bgcolor_opacity',
                'ut_blog_navigation_shadow',
                'ut_blog_navigation_width',
                'ut_blog_navigation_font_weight',
                'ut_blog_navigation_state',
                'ut_blog_navigation_transparent_border',
                'ut_blog_navigation_level_one_color',
                'ut_blog_navigation_level_one_icon_color'
            ),
            'value'       => 'off'
          )	  
        ),
        'std'         	=> 'on'
      ),
             
      array(
        'id'          => 'ut_blog_navigation_skin',
        'label'       => 'Header / Navigation Color Skin',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_navigation_settings',
        'std'         => 'ut-header-light',
        'choices'     => array( 
          array(
            'value'       => 'ut-header-dark',
            'for'         => array('ut_blog_navigation_skin_dark_bgcolor'),
            'label'       => 'Dark'
          ),
          array(
            'value'       => 'ut-header-light',
            'for'         => array('ut_blog_navigation_skin_light_bgcolor'),
            'label'       => 'Light'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_blog_navigation_shadow',
        'label'       => 'Header / Navigation Shadow',
        'desc'        => 'Activate Navigation / Header Shadow?',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_navigation_settings',
        'std'         => 'on',
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
        'id'          => 'ut_blog_navigation_width',
        'label'       => 'Header / Navigation Width',
        'desc'        => '',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_navigation_settings',
        'std'         => 'centered',
        'choices'     => array( 
          array(
            'value'       => 'centered',
            'label'       => 'Centered'
          ),
          array(
            'value'       => 'fullwidth',
            'label'       => 'Fullwidth'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_blog_navigation_state',
        'label'       => 'Always show Header / Navigation?',
        'desc'        => 'This option makes the navigation visible all the time. If you choose "On (transparent)". The navigation will turn into the chosen skin when reaching the main content."',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_navigation_settings',
        'std'         => 'off',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'label'       => 'On (with chosen skin)'
          ),
          array(
            'value'       => 'on_transparent',
            'label'       => 'On (transparent)'
          ),
          array(
            'value'       => 'off',
            'label'       => 'Off'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_blog_navigation_transparent_border',
        'label'       => 'Activate Navigation Border Bottom?',
        'desc'        => '',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_navigation_settings',
        'std'         => 'off',
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
        'id'          => 'ut_blog_navigation_level_one_color',
        'label'       => 'Header / Navigation First Level Color',
        'desc'        => 'Change the font color of the first navigation level.',
        'type'        => 'colorpicker',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_navigation_settings',
      ),
      
      array(
        'id'          => 'ut_blog_navigation_level_one_icon_color',
        'label'       => 'Header / Navigation First Level Dot Color',
        'desc'        => 'Change the dot color of the first navigation level.',
        'type'        => 'colorpicker',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_navigation_settings',
      ),
            
      
      
      
      /*
      |--------------------------------------------------------------------------
      | Blog Sidebar
      |--------------------------------------------------------------------------
      */
      array(
        'id'          => 'ut_blog_sidebar_menu',
        'subid'       => 'ut_blog_sidebar_setting',
        'label'       => 'Sidebar Setting',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings'
      ),
      
      array(
        'id'          => 'ut_blog_sidebar_headline',
        'label'       => 'Sidebar Align',
        'desc'        => '<h2 class="section-headline">Sidebar Align</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_sidebar_setting',
      ),
      
      array(
        'id'          => 'ut_sidebar_align',
        'label'       => 'Sidebar Align',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_sidebar_setting',
        'choices'     => array( 
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
      
      /*
      |--------------------------------------------------------------------------
      | Blog Navigation
      |--------------------------------------------------------------------------
      */
      array(
        'id'          => 'ut_blog_pagination_menu',
        'subid'       => 'ut_blog_pagination_setting',
        'label'       => 'Pagination',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings'
      ),
      
      array(
        'id'          => 'ut_blog_pagination_headline',
        'label'       => 'Blog Pagination',
        'desc'        => '<h2 class="section-headline">Blog Pagination</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_pagination_setting',
      ),
      
      array(
        'id'          => 'ut_blog_pagination_height',
        'label'       => 'Blog Pagination Height',
        'desc'        => '1-300 - default 120',
        'std'         => '120',
        'type'        => 'numeric-slider',
        'min_max_step'=> '0,300,10',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_pagination_setting',        
      ),
      array(
        'id'          => 'ut_blog_pagination_background_color',
        'label'       => 'Portfolio Pagination Background Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_pagination_setting',
      ),
      array(
        'id'          => 'ut_blog_pagination_arrow_color',
        'label'       => 'Portfolio Pagination Arrow Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_pagination_setting',
      ),
      array(
        'id'          => 'ut_blog_pagination_arrow_hover_color',
        'label'       => 'Portfolio Pagination Arrow Hover Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_pagination_setting',
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Blog Misc
      |--------------------------------------------------------------------------
      
      array(
        'id'          => 'ut_blog_misc_menu',
        'subid'       => 'ut_blog_misc_setting',
        'label'       => 'Miscellaneous',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings'
      ),
      
      array(
        'id'          => 'ut_blog_misc_headline',
        'label'       => 'Blog Miscellaneous',
        'desc'        => '<h2 class="section-headline">Blog Miscellaneous</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_misc_setting',
      ),
      
      array(
        'id'          => 'ut_author_box',
        'label'       => 'Activate Author Box on Single Posts?',
        'type'        => 'select',
        'section'     => 'ut_blog_settings',
        'subsection'  => 'ut_blog_misc_setting',
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
      */
      
      
      /*
      |--------------------------------------------------------------------------
      | Portfolio Settings
      |--------------------------------------------------------------------------
      */ 
      array(
        'id'          => 'ut_portfolio_single_menu',
        'subid'       => 'ut_portfolio_single_setting',
        'label'       => 'Single Portfolio',
        'type'        => 'section_headline',
        'section'     => 'ut_portfolio_settings'
      ), 
      
      array(
        'id'          => 'ut_portfolio_content_headline',
        'label'       => 'Single Portfolio',
        'desc'        => '<h2 class="section-headline">Single Portfolio</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_single_setting',
      ),
      
      array(
        'id'          => 'ut_single_portfolio_navigation',
        'label'       => 'Activate Portfolio Navigation?',
        'type'        => 'select_group',
        'std'         => 'off',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_single_setting',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'for'         => array(
                'ut_single_portfolio_navigation_height',
                'ut_single_portfolio_navigation_background_color',
                'ut_single_portfolio_navigation_arrow_color',
                'ut_single_portfolio_navigation_arrow_hover_color'                
            ),
            'label'       => 'yes, please!'
          ),
          array(
            'value'       => 'off',
            'for'         => array(
            
            ),
            'label'       => 'no, thanks!'
          )
        ),
      ),
      array(
        'id'          => 'ut_single_portfolio_navigation_height',
        'label'       => 'Portfolio Navigation Height',
        'desc'        => '1-300 - default 120',
        'std'         => '120',
        'type'        => 'numeric-slider',
        'min_max_step'=> '0,300,10',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_single_setting',        
      ),
      array(
        'id'          => 'ut_single_portfolio_navigation_background_color',
        'label'       => 'Portfolio Navigation Background Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_single_setting',
      ),
      array(
        'id'          => 'ut_single_portfolio_navigation_arrow_color',
        'label'       => 'Portfolio Navigation Arrow Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_single_setting',
      ),
      array(
        'id'          => 'ut_single_portfolio_navigation_arrow_hover_color',
        'label'       => 'Portfolio Navigation Arrow Hover Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_single_setting',
      ),
      array(
        'id'          => 'ut_single_portfolio_back_to_main_color',
        'label'       => 'Portfolio Overview Link Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_single_setting',
      ),
      array(
        'id'          => 'ut_single_portfolio_back_to_main_hover_color',
        'label'       => 'Portfolio Overview Link Hover Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_single_setting',
      ),
      array(
        'id'          => 'ut_single_portfolio_navigation_main_portfolio_page',
        'label'       => 'Main Portfolio Page',
        'desc'        => 'Select a page where your main showcase is located.',
        'type'        => 'page_select',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_single_setting',
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Portfolio Settings
      |--------------------------------------------------------------------------
      */ 
      array(
        'id'          => 'ut_portfolio_showcase_menu',
        'subid'       => 'ut_portfolio_showcase_setting',
        'label'       => 'Showcase',
        'type'        => 'section_headline',
        'section'     => 'ut_portfolio_settings'
      ), 
      
      array(
        'id'          => 'ut_portfolio_showcase_headline',
        'label'       => 'Packery Showcase Caption',
        'desc'        => '<h2 class="section-headline">Packery Showcase Caption</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_showcase_setting',
      ),
      
      array(
        'id'          => 'ut_portfolio_showcase_icon_type',
        'label'       => 'Showcase Icon',
        'type'        => 'select_group',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_showcase_setting',
        'std'         => 'custom',
        'choices'     => array( 

          array(
            'value'       => 'font',
            'for'         => array(
                'ut_portfolio_showcase_font_icon'
            ),
            'label'       => 'Font Awesome Icon'
          ),
          
          array(
            'value'       => 'custom',
            'for'         => array(
                'ut_portfolio_showcase_custom_icon'
            ),
            'label'       => 'Custom Icon'
          ),
          
        ),                
    
      ),
    
      array(
        'id'          => 'ut_portfolio_showcase_custom_icon',
        'label'       => 'Custom Icon',
        'type'        => 'upload',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_showcase_setting',
      ),
    
      array(
        'id'          => 'ut_portfolio_showcase_font_icon',
        'label'       => 'Select Fontawesome Icon',
        'type'        => 'iconpicker',
        'section'     => 'ut_portfolio_settings',
        'subsection'  => 'ut_portfolio_showcase_setting',
      ),
      
            
      /*
      |--------------------------------------------------------------------------
      | Contact Section Content
      |--------------------------------------------------------------------------
      */
      array(
        'id'          => 'ut_csection_content_menu',
        'subid'       => 'ut_csection_content_setting',
        'label'       => 'Content',
        'type'        => 'section_headline',
        'section'     => 'ut_csection_settings'
      ),
      
      array(
        'id'          => 'ut_csection_content_headline',
        'label'       => 'Contact Section Content',
        'desc'        => '<h2 class="section-headline">Contact Section Content</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_content_setting',
      ),
      
      array(
        'id'          => 'ut_activate_csection',
        'label'       => 'Activate Contact Section',
        'desc'        => 'You can individually decide if you like to activate or deactivate the contact section per page / portfolio.',
        'type'        => 'checkbox',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_content_setting',
        'choices'     => array( 
          array(
            'value'       => 'is_front_page',
            'label'       => 'Home'
          ),
          array(
            'value'       => 'is_home',
            'label'       => 'Blog'
          ),
           array(
            'value'       => 'is_page',
            'label'       => 'Single Pages'
          ),
          array(
            'value'       => 'is_single',
            'label'       => 'Single Posts'
          ),
          array(
            'value'       => 'is_singular',
            'label'       => 'Single Portfolio Pages'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_csection_header_slogan',
        'label'       => 'Contact Header Slogan',
        'type'        => 'textarea-simple',
        'htmldesc'    => '&lt;span&gt; word &lt;/span&gt; = highlight word in themecolor',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_content_setting',
        'rows'        => '5'
      ),
      
      array(
        'id'          => 'ut_csection_header_expertise_slogan',
        'label'       => 'Contact Header Expertise Slogan',
        'type'        => 'textarea-simple',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_content_setting',
        'rows'        => '5'
      ),
      
      array(
        'id'          => 'ut_left_csection_content_area',
        'label'       => 'Left Content Area',
        'desc'        => '<p> For example : create a contact form with your desired form generator and insert the shortcode in here. We recommend to make use of Contact Form 7. P.S. This field is also a good place to place a Google map shortcode! Leave empty to hide the complete box. </p>',
        'type'        => 'textarea',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_content_setting',
        'rows'        => '25'
      ),
      
      array(
        'id'          => 'ut_right_csection_content_area',
        'label'       => 'Right Content Area',
        'desc'        => '<p> For example : create a contact form with your desired form generator and insert the shortcode in here. We recommend to make use of Contact Form 7. P.S. This field is also a good place to place a Google map shortcode! Leave empty to hide the complete box. </p>',
        'type'        => 'textarea',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_content_setting',
        'rows'        => '25'
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Contact Section Background
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_csection_background_headline',
        'subid'       => 'ut_csection_background_setting',
        'label'       => 'Background',
        'type'        => 'section_headline',
        'section'     => 'ut_csection_settings'
      ),
      
      array(
        'id'          => 'ut_contact_background_setting_headline',
        'label'       => 'Contact Section Background',
        'desc'        => '<h2 class="section-headline">Contact Section Background</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting'
      ),
      
      array(
        'id'          => 'ut_csection_background_type',
        'label'       => 'Choose Background Type',
        'desc'        => '',
        'type'        => 'select_group',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting',
        'std'         => 'image',
        'toplevel'    => true,
        'choices'     => array( 
          array(
            'value'       => 'image',
            'for'         => array('ut_csection_background_image' , 'ut_csection_parallax'),
            'label'       => 'Image'
          ),
          array(
            'value'       => 'map',
            'for'          => array('ut_csection_map'),
            'label'       => 'Google Map'
          ),
          array(
            'value'       => 'video',
            'for'          => array(
                            'ut_csection_video_source',
                            'ut_csection_video',
                            'ut_csection_video_mp4',
                            'ut_csection_video_ogg',
                            'ut_csection_video_webm',
                            'ut_csection_video_loop',
                            'ut_csection_video_preload',
                            'ut_csection_video_sound',
                            'ut_csection_video_volume',
                            'ut_csection_video_mute_button',
                            'ut_csection_video_poster'
            ),
            'label'       => 'Video'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_csection_video_source',
        'label'       => 'Video Source',
        'desc'        => '',
        'type'        => 'select_group',
        'std'		  => 'youtube',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting',
        'choices'     => array( 
          array(
            'value'       => 'youtube',
            'for'         => array('ut_csection_video'),
            'label'       => 'Youtube'
          ),
          array(
            'value'       => 'selfhosted',
            'for'         => array('ut_csection_video_mp4','ut_csection_video_ogg','ut_csection_video_webm','ut_csection_video_preload'),
            'label'       => 'Selfthosted'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_csection_video',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting',        
        'label'       => 'Video URL',
        'desc'        => 'Please insert the url only e.g. http://youtu.be/gvt_YFuZ8LA . Please do not insert the complete embedded code!',
        'type'        => 'text',
      ),
      
      array(
        'id'          => 'ut_csection_video_mp4',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting', 
        'label'       => 'MP4',
        'desc'        => '',
        'type'        => 'upload',    
      ),
      
       array(
        'id'          => 'ut_csection_video_ogg',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting', 
        'label'       => 'OGG',
        'desc'        => '',
        'type'        => 'upload',    
      ),
      
       array(
        'id'          => 'ut_csection_video_webm',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting', 
        'label'       => 'WEBM',
        'desc'        => '',
        'type'        => 'upload',   
      ),
      
      array(
        'id'          	=> 'ut_csection_video_loop',
        'section'       => 'ut_csection_settings',
        'subsection'    => 'ut_csection_background_setting', 
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
        'id'          	=> 'ut_csection_video_preload',
        'section'       => 'ut_csection_settings',
        'subsection'    => 'ut_csection_background_setting', 
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
        'id'          => 'ut_csection_video_sound',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting', 
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
        'id'          => 'ut_csection_video_volume',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting', 
        'label'       => 'Video Volume',
        'desc'        => '1-100 - default 5',
        'std'         => '5',
        'type'        => 'numeric-slider',
        'min_max_step'=> '0,100,1'
      ),
      
      array(
        'id'          	=> 'ut_csection_video_mute_button',
        'section'       => 'ut_csection_settings',
        'subsection'    => 'ut_csection_background_setting', 
        'label'       	=> 'Show Mute Button?',
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
        'std'         	=> 'off'
      ),
      
      array(
        'id'          => 'ut_csection_video_poster',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting', 
        'label'       => 'Poster Image',
        'desc'        => 'This image will be displayed instead of the video on mobile devices.',
        'type'        => 'upload',    
      ),
      
      array(
        'id'          => 'ut_csection_background_image',
        'label'       => 'Contact Section Background Image',
        'desc'        => 'Keep in mind, that you are not able to set a background position or attachment if the parallax option for this section has been set to "on".',
        'type'        => 'background',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting'
      ),
      
      array(
        'id'          => 'ut_csection_map',
        'label'       => 'Google Map Shortcode',
        'desc'        => 'We recommend to use the Maps Marker plugin to display maps! Placing a shortcode will overwrite the background image. Also keep in mind, that activating the parallax effect does not work with maps.',
        'type'        => 'text',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting'
      ),

      array(
        'id'          => 'ut_csection_parallax',
        'label'       => 'Activate Parallax',
        'desc'        => 'Only available for background images.',
        'std'         => 'off',
        'type'        => 'select',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting',
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
        'id'          => 'ut_contact_overlay_setting_headline',
        'label'       => 'Background Overlay',
        'desc'        => '<h2 class="section-headline">Background Overlay</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting'
      ),
      
      array(
        'id'          => 'ut_csection_overlay',
        'label'       => 'Overlay',
        'desc'        => 'Only available if background image has been set.',
        'type'        => 'select',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting',
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
        'id'          => 'ut_csection_overlay_pattern',
        'label'       => 'Overlay Pattern',
        'type'        => 'select',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting',
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
        'id'          => 'ut_csection_overlay_pattern_style',
        'label'       => 'Overlay Pattern Style',
        'type'        => 'select',
        'std'          => 'style_one',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting',
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
        'id'          => 'ut_csection_overlay_color',
        'label'       => 'Overlay Color',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'colorpicker',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting'
      ),
      
      array(
        'id'          => 'ut_csection_overlay_opacity',
        'label'       => 'Overlay Color Opacity',
        'desc'        => '<strong>(optional)</strong> - default 0.8',
        'std'         => '0.8',
        'type'        => 'numeric-slider',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_background_setting',
        'min_max_step'=> '0,1,0.1'
      ),
      
      
      
      /*
      |--------------------------------------------------------------------------
      | Contact Section Styling
      |--------------------------------------------------------------------------
      */
      
      array(
        'id'          => 'ut_csection_styling_headline',
        'subid'       => 'ut_csection_styling_setting',
        'label'       => 'Styling',
        'type'        => 'section_headline',
        'section'     => 'ut_csection_settings'
      ),
      
      array(
        'id'          => 'ut_contact_header_setting_headline',
        'label'       => 'Contact Section Header Style',
        'desc'        => '<h2 class="section-headline">Contact Section Header Style</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting'
      ),
      
      array(
        'id'          => 'ut_csection_header_style',
        'label'       => 'Header Style',
        'desc'        => '<strong>(optional)</strong> - default : Typography -> Global Header Styles. <a href="#" class="ut-header-preview">Preview Header Styles</a>',
        'type'        => 'select_group',
        'std'          => 'global',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting',
        'choices'     => array( 
          
          array(
            'label'       => 'Default',
            'for'         => array(),
            'value'       => 'global'
          ),          
          
          array(
            'value'       => 'pt-style-1',
            'label'       => 'Style One'
          ),
          
          array(
            'value'       => 'pt-style-2',
            'for'         => array(
                        'ut_csection_headline_style_2_color',
                        'ut_csection_headline_style_2_height',
                        'ut_csection_headline_style_2_width'
            ),
            'label'       => 'Style Two'
          ),
          
          array(
            'value'       => 'pt-style-3',
            'for'         => array(),
            'label'       => 'Style Three'
          ),
          
          array(
            'value'       => 'pt-style-4',
            'for'         => array(),
            'label'       => 'Style Four'
          ),
          
          array(
            'value'       => 'pt-style-5',
            'for'         => array(),
            'label'       => 'Style Five'
          ),
          
           array(
            'value'       => 'pt-style-6',
            'for'         => array(),
            'label'       => 'Style Six'
          ),
          
          array(
            'value'       => 'pt-style-7',
            'for'         => array(),
            'label'       => 'Style Seven'
          )
         
        ),
      ),
      
      array(
        'id'          => 'ut_csection_headline_style_2_color',
        'label'       => 'Style Two Decoration Line Color',
        'desc'        => '',
        'type'        => 'colorpicker',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
        'std'         => '#222222'
      ),
      
      array(
        'id'          => 'ut_csection_headline_style_2_height',
        'label'       => 'Style Two Decoration Line Height',
        'desc'        => '<strong>(optional)</strong> - value in px , default: 1px',
        'type'        => 'text',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
        'std'         => ''
      ),
      
      array(
        'id'          => 'ut_csection_headline_style_2_width',
        'label'       => 'Style Two Decoration Line Width',
        'desc'        => '<strong>(optional)</strong> - value in % or px , default: 30px',
        'type'        => 'text',
        'section'     => 'ut_typography_settings',
        'subsection'  => 'ut_global_header_settings',
        'std'         => ''
      ),
      
      array(
        'id'          => 'ut_csection_title_uppercase',
        'label'       => 'Uppercase',
        'desc'        => 'Display the Contact Section Title in uppercase letters?',
        'type'        => 'radio',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting',
        'std'          => 'off',
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
        'id'          => 'ut_csection_header_padding_bottom',
        'label'       => 'Header Padding Bottom',
        'desc'        => '<strong>(optional)</strong> - include "px" in your string. e.g. 150px (default: 30px). This option defines the space between header and the following content.',
        'type'        => 'text',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting'
      ),      
      
      array(
        'id'          => 'ut_csection_hero_fancy_border_setting_headline',
        'label'       => 'Fancy Border Settings',
        'desc'        => '<h2 class="section-headline">Hero Fancy Border</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting'
      ),            
            
      array(
        'id'          => 'ut_csection_fancy_border',
        'label'       => 'Activate Fancy Border?',
        'desc'        => '',
        'type'        => 'select_group',
        'toplevel'    => false,
        'choices'     => array(              
          array(
            'label'       => 'yes, please!',
            'for'         => array(
                            'ut_csection_fancy_border_color',
                            'ut_csection_fancy_border_background_color',
                            'ut_csection_fancy_border_size'
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
        'section'       => 'ut_csection_settings',
        'subsection'    => 'ut_csection_styling_setting'
      ),      
      array(
        'id'          	=> 'ut_csection_fancy_border_color',
        'label'       	=> 'Color',
        'type'        	=> 'colorpicker',
        'desc'       	=> '<strong>(optional)</strong>',
        'section'       => 'ut_csection_settings',
        'subsection'    => 'ut_csection_styling_setting'
      ),      
      array(
        'id'          	=> 'ut_csection_fancy_border_background_color',
        'label'       	=> 'Background Color',
        'type'        	=> 'colorpicker',
        'desc'       	=> '<strong>(optional)</strong>',
        'section'       => 'ut_csection_settings',
        'subsection'    => 'ut_csection_styling_setting'
      ),      
      array(
        'id'            => 'ut_csection_fancy_border_size',
        'label'         => 'Size',
        'desc'          => '<strong>(optional)</strong> - default 10px',
        'type'          => 'text',
        'section'       => 'ut_csection_settings',
        'subsection'    => 'ut_csection_styling_setting'
      ),      
      array(
        'id'          => 'ut_contact_padding_setting_headline',
        'label'       => 'Contact Section Padding',
        'desc'        => '<h2 class="section-headline">Contact Section Padding</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting'
      ),
      
      array(
        'id'          => 'ut_csection_padding_top',
        'label'       => 'Contact Section Padding Top',
        'desc'        => '<strong>(optional)</strong> - default 80px',
        'type'        => 'text',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting'
      ),
      
      array(
        'id'          => 'ut_csection_padding_bottom',
        'label'       => 'Contact Section Padding Bottom',
        'desc'        => '<strong>(optional)</strong> - default 40px',
        'type'        => 'text',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting'
      ),    
        
      array(
        'id'          => 'ut_contact_color_headline',
        'label'       => 'Color Settings',
        'desc'        => '<h2 class="section-headline">Color Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting'
      ),
      
      array(
        'id'          => 'ut_activate_csection_border',
        'label'       => 'Activate Border at Top?',
        'desc'        => '',
        'type'        => 'select_group',
        'toplevel'    => false,
        'choices'     => array(              
          array(
            'label'       => 'yes, please!',
            'for'         => array(
                            'ut_csection_border_color',
                            'ut_csection_border_width',
                            'ut_csection_border_style'
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
        'section'       => 'ut_csection_settings',
        'subsection'    => 'ut_csection_styling_setting',
      ),
      
      array(
        'id'          	=> 'ut_csection_border_color',
        'label'       	=> 'Border Top Color',
        'type'        	=> 'colorpicker',
        'desc'       	=> '<strong>(optional)</strong>',
        'section'       => 'ut_csection_settings',
        'subsection'    => 'ut_csection_styling_setting',
      ),    
      
      array(
        'id'            => 'ut_csection_border_width',
        'label'         => 'Border Top Width',
        'desc'          => '<strong>(optional)</strong>',
        'type'          => 'numeric-slider',
        'min_max_step'  => '1,100',
        'section'       => 'ut_csection_settings',
        'subsection'    => 'ut_csection_styling_setting',
      ),
      
      array(
        'id'            => 'ut_csection_border_style',
        'label'         => 'Border Top Style',
        'type'          => 'select',
        'desc'          => 'Creates a border at the bottom of the hero.',
        'choices'       => array(
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
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting',
      ),      
      
      array(
        'id'          => 'ut_csection_skin',
        'label'       => 'Section Color Skin',
        'type'        => 'select',
        'desc'        => 'If you are planing to use light background images or colors use the dark skin and the other way around. If these skins do not match your requirements, you can define your own colors beneath. The Dark skin has been made fir pure white background in this case.',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting',
        'choices'     => array(
          array(
            'label'     => 'Light',
            'value'     => 'light'
          ),
          array(
            'label'     => 'Dark',
            'value'     => 'dark'
          )
        ),
        'std'             => 'dark',
      ),
      
      array(
        'id'          => 'ut_csection_header_slogan_color',
        'label'       => 'Section Title Color',
        'desc'        => '<strong>(optional)</strong> - will overwrite the default CSS.',
        'type'        => 'colorpicker',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting'
      ),
      
      array(
        'id'          => 'ut_csection_header_expertise_slogan_color',
        'label'       => 'Section Slogan Color',
        'desc'        => '<strong>(optional)</strong> - will overwrite the default CSS.',
        'type'        => 'colorpicker',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting'
      ),
      
      array(
        'id'          => 'ut_csection_background_color',
        'label'       => 'Contact Section Background Color',
        'desc'        => '<strong>(optional)</strong> - will overwrite the default CSS.',
        'type'        => 'colorpicker',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting'
      ),
      
      array(
        'id'          => 'ut_left_csection_content_area_color',
        'label'       => 'Left Content Area Background Color',
        'desc'        => '<strong>(optional)</strong> - will overwrite the default CSS.',
        'type'        => 'colorpicker',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting'
      ),
      
      array(
        'id'          => 'ut_left_csection_content_area_opacity',
        'label'       => 'Color Opacity',
        'desc'        => '<strong>(optional)</strong> - will overwrite the default CSS. Opacity for left content area background color.',
        'std'         => '0.8',
        'type'        => 'numeric-slider',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting',
        'min_max_step'=> '0,1,0.1'
      ),
      
      array(
        'id'          => 'ut_right_csection_content_area_color',
        'label'       => 'Right Content Area Background Color',
        'desc'        => '<strong>(optional)</strong> - will overwrite the default CSS.',
        'type'        => 'colorpicker',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting',
      ),
      
      array(
        'id'          => 'ut_right_csection_content_area_opacity',
        'label'       => 'Color Opacity',
        'desc'        => '<strong>(optional)</strong> - will overwrite the default CSS. Opacity for right content area background color.',
        'std'         => '0.8',
        'type'        => 'numeric-slider',
        'section'     => 'ut_csection_settings',
        'subsection'  => 'ut_csection_styling_setting',
        'min_max_step'=> '0,1,0.1'
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Advanced Settings
      |--------------------------------------------------------------------------
      */
      
      /*
      | Section Animation
      */
      
      array(
        'id'          => 'ut_sanimation_setting_menu',
        'subid'       => 'ut_sanimation_settings',
        'label'       => 'Section Animation',
        'desc'        => '<h2 class="section-headline">Section Animation</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings'
      ),
          
      array(
        'id'          => 'ut_sanimation_setting_headline',
        'label'       => 'Section Animation',
        'desc'        => '<h2 class="section-headline">Section Animation</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_sanimation_settings',
      ),
      
      array(
        'id'          => 'ut_scrollto_effect',
        'label'       => 'Scroll to Section Effect',
        'desc'        => 'This option will activate / deactivate the section fade animation.',
        'type'        => 'easing',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_sanimation_settings',
        'std'          => 'easeInOutExpo'
      ),
      
      array(
        'id'          => 'ut_scrollto_speed',
        'label'       => 'Scroll to Section Effect Speed',
        'desc'        => '<strong>(optional)</strong> - value in ms , default: 650',
        'type'        => 'text',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_sanimation_settings',
      ),
      
      array(
        'id'          => 'ut_smooth_scroll',
        'label'       => 'Activate Smooth Scroll in Chrome',
        'desc'        => 'This option will activate / deactivate smooth scrolling for chrome, other browser are not affected. Smooth scrolling is only available for Chrome.',
        'type'        => 'select',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_sanimation_settings',
        'std'          => 'on',
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
        'id'          => 'ut_animate_sections',
        'label'       => 'Animate Sections',
        'desc'        => 'This option will activate / deactivate the section fade animation.',
        'type'        => 'select',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_sanimation_settings',
        'std'          => 'on',
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
        'id'          => 'ut_animate_sections_timer',
        'label'       => 'Section Animation Timer',
        'desc'        => '<strong>(optional)</strong> - value in ms , default: 1600',
        'type'        => 'text',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_sanimation_settings',
      ),
          
      /*
      | Pre Loader
      */
      
      array(
        'id'          => 'ut_loader_setting_menu',
        'subid'       => 'ut_loader_settings',
        'label'       => 'Manage Preloader',
        'desc'        => '<h2 class="section-headline">Manage Preloader</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings'
      ),
      
      array(
        'id'          => 'ut_loader_setting_headline',
        'label'       => 'Manage Preloader',
        'desc'        => '<h2 class="section-headline">Manage Preloader</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings',
      ),
      
      array(
        'id'          => 'ut_use_image_loader',
        'label'       => 'Use Image Preloader',
        'desc'        => 'This option will activate a JavaScript based preloader.',
        'type'        => 'select',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings',
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
        'id'          => 'ut_use_image_loader_on',
        'label'       => 'Use Image Preloader for',
        'desc'        => '',
        'type'        => 'checkbox',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings',
        'choices'     => array( 
          array(
            'value'       => 'is_front_page',
            'label'       => 'Home'
          ),
          array(
            'value'       => 'is_home',
            'label'       => 'Blog'
          ),
           array(
            'value'       => 'is_page',
            'label'       => 'Single Pages'
          ),
          array(
            'value'       => 'is_single',
            'label'       => 'Single Posts'
          ),
          array(
            'value'       => 'is_singular',
            'label'       => 'Single Portfolio Pages'
          )
        ),
      ),
      
      array(
        'id'          => 'ut_image_loader_style_headline',
        'label'       => 'Choose Preloader Style',
        'desc'        => '<h2 class="section-headline">Choose Preloader Style</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings'
      ),
      
      array(
        'id'          => 'ut_image_loader_style',
        'label'       => 'Preloader Style',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'select_group',
        'std'         => 'style_one',
        'choices'     => array( 
          array(
            'value'       => 'style_one',
            'for'         => array( 'ut_show_loader_bar', 'ut_image_loader_barheight', 'ut_show_loader_percentage', 'ut_image_loader_color','ut_image_loader_percentage_font_headline','ut_image_loader_percentage_font' ),
            'label'       => 'Style One'
          ),
          array(
            'value'       => 'style_two',
            'for'         => array( 'ut_image_loader_font_headline','ut_image_loader_font', 'ut_image_loader_text', 'ut_image_loader_text_color' ),
            'label'       => 'Style Two'
          ),
          array(
            'value'       => 'style_three',
            'for'         => array( 'ut_image_loader_font_headline','ut_image_loader_font', 'ut_image_loader_text', 'ut_image_loader_text_color' ),
            'label'       => 'Style Three'
          ),
          array(
            'value'       => 'style_four',
            'for'         => array( 'ut_image_loader_font_headline','ut_image_loader_font', 'ut_image_loader_text', 'ut_image_loader_text_color' ),
            'label'       => 'Style Four'
          ),
          array(
            'value'       => 'style_five',
            'for'         => array( 'ut_image_loader_font_headline','ut_image_loader_font', 'ut_image_loader_text', 'ut_image_loader_text_color' ),
            'label'       => 'Style Five'
          )
        ),
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings'
      ),
      
      array(
        'id'          => 'ut_show_loader_bar',
        'label'       => 'Display Loader Bar',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'select_group',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'for'         => array(),
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
        'id'          => 'ut_image_loader_barheight',
        'label'       => 'Bar Height',    
        'desc'        => '<strong>(optional)</strong> - default: 3',
        'type'        => 'numeric-slider',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings',
        'min_max_step'=> '1,100,1'
      ),        
      
      array(
        'id'          => 'ut_show_loader_percentage',
        'label'       => 'Display Loader Percentage',
        'std'         => 'on',
        'type'        => 'select_group',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'for'         => array(),
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
        'id'          => 'ut_image_loader_logo_headline',
        'label'       => 'Upload Preloader Logo',
        'desc'        => '<h2 class="section-headline">Upload Preloader Logo</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings'
      ),
      
      array(
        'id'           => 'ut_image_loader_logo',
        'label'        => 'Logo',
        'desc'         => 'Custom Logo for Preloader.',
        'type'         => 'upload',
        'section'      => 'ut_advanced_settings',
        'subsection'   => 'ut_loader_settings'
      ),
            
      array(
        'id'          => 'ut_image_loader_logo_max_width',
        'label'       => 'Custom Logo Max Width',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'numeric-slider',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings',
        'min_max_step'=> '50,720,10'
      ),
      
      array(
        'id'          => 'ut_image_loader_color_headline',
        'label'       => 'Preloader Color Settings',
        'desc'        => '<h2 class="section-headline">Preloader Color Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings'
      ),
      
      array(
        'id'          => 'ut_image_loader_background',
        'label'       => 'Preloader Backgroundcolor',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'colorpicker',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings',
      ),
      
      array(
        'id'          => 'ut_image_loader_bar_color',
        'label'       => 'Preloader Indicator Color',
        'desc'        => '<strong>(optional)</strong> - default: accentcolor. Color for the element which visually indicates the loading. If you leave this field empty, the system will use the accentcolor which has been defined inside the theme customizer.',
        'type'        => 'colorpicker',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings',
      ),
      
      array(
        'id'          => 'ut_image_loader_font_headline',
        'label'       => 'Preloader Loading Text Font Settings',
        'desc'        => '<h2 class="section-headline">Preloader Loading Text Font Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings'
      ),
      
      array(
        'id'          => 'ut_image_loader_text',
        'label'       => 'Preloader Loading Text',
        'desc'        => '<strong>(optional)</strong> - default: "Loading".',
        'type'        => 'text',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings'
      ),
      
      array(
        'id'          => 'ut_image_loader_text_color',
        'label'       => 'Preloader Loading Text Color',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'colorpicker',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings',
      ),
      
      array(
        'id'          => 'ut_image_loader_font',
        'label'       => 'Preloader Loading Text Font',
        'type'        => 'typography',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings'
      ),
      
      array(
        'id'          => 'ut_image_loader_text_margin_top',
        'label'       => 'Preloader Loading Text Spacing Top',    
        'desc'        => '<strong>(optional)</strong> - default: 20',
        'type'        => 'numeric-slider',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings',
        'std'         => 20,
        'min_max_step'=> '1,100,1'
      ),
      
      array(
        'id'          => 'ut_image_loader_percentage_font_headline',
        'label'       => 'Preloader Percentage Font Settings',
        'desc'        => '<h2 class="section-headline">Preloader Percentage Font Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings'
      ),
      
      array(
        'id'          => 'ut_image_loader_color',
        'label'       => 'Preloader Percentage Color',
        'desc'        => '<strong>(optional)</strong>',
        'type'        => 'colorpicker',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings'
      ),
      
      array(
        'id'          => 'ut_image_loader_percentage_font',
        'label'       => 'Preloader Percentage Text Font',
        'type'        => 'typography',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_loader_settings'
      ),
      
      /*
      | Custom CSS
      */
      
      array(
        'id'          => 'ut_custom_css_headline',
        'subid'       => 'ut_custom_css_settings',
        'label'       => 'Custom CSS',
        'desc'        => '<h2 class="section-headline">Custom CSS</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
      ),
      
      array(
        'id'          => 'ut_custom_css_settings_headline',
        'label'       => 'Custom CSS',
        'desc'        => '<h2 class="section-headline">Custom CSS</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_custom_css_settings',
      ),
      
      array(
        'id'          => 'ut_custom_css',
        'label'       => 'Custom CSS',
        'desc'        => 'Insert your custom CSS code right in here if you are not planing to use the delivered child theme. This custom CSS will be directly hooked into the wp head right after all other Stylesheets.',
        'type'        => 'textarea-simple',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_custom_css_settings'
      ),
        
      /*
      | SEO
      */
      
      array(
        'id'          => 'ut_seo_headline',
        'label'       => 'SEO',
        'desc'        => '<h2 class="section-headline">SEO</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subid'       => 'ut_seo_settings',
      ),
      
      array(
        'id'          => 'ut_seo_settings_headline',
        'label'       => 'SEO',
        'desc'        => '<h2 class="section-headline">SEO</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_seo_settings',
      ),
      
      array(
        'id'          => 'ut_google_analytics',
        'label'       => 'Google Analytics ID',
        'desc'        => 'Enter your Google Analytics ID here to track your site with Google Analytics. Please insert ID only! Or the Sky will fall on your head!',
        'type'        => 'text',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_seo_settings'
      ),
      
      
      /*
      |--------------------------------------------------------------------------
      | Cache Options
      |--------------------------------------------------------------------------
      */      
      array(
        'id'          => 'ut_cache_settings_menu',
        'subid'       => 'ut_cache_settings',
        'label'       => 'One Page Cache',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings'
      ),
      
      array(
        'id'          => 'ut_cache_setting_headline',
        'label'       => 'One Page Cache',
        'desc'        => '<h2 class="section-headline">One Page Cache</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_cache_settings',
      ),
      
      array(
        'id'          => 'ut_use_cache',
        'label'       => 'Use Cache',
        'desc'        => 'This option will cache your one page. We recommend to turn this option off when developing the site or adding new content. This cache stores CSS / JS and the main Query for our frontpage. For more and advanced caching options please use a Cache Plugin.',
        'type'        => 'select',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_cache_settings',
        'std'          => 'off',
        'choices'     => array( 
          array(
            'value'       => 'off',
            'label'       => 'off'
          ),
          array(
            'value'       => 'on',
            'label'       => 'on'
          )
        ),
      ),
          
      array(
        'id'          => 'ut_cache_ltime',
        'label'       => 'Cache Lifetime',
        'desc'        => 'In Minutes, for example : 10',
        'type'        => 'text',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_cache_settings',
      ),
      
      
      /*
      |--------------------------------------------------------------------------
      | Lightbox Options
      |--------------------------------------------------------------------------
      */      
      array(
        'id'          => 'ut_lightbox_settings_menu',
        'subid'       => 'ut_lightbox_settings',
        'label'       => 'Lightbox Settings',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings'
      ),
      
      array(
        'id'          => 'ut_lightbox_setting_headline',
        'label'       => 'Lightbox Settings',
        'desc'        => '<h2 class="section-headline">Lightbox Settings</h2>',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_lightbox_settings',
      ),
      
      array(
        'id'          => 'ut_lightbox_script',
        'label'       => 'Lightbox Script',
        'desc'        => 'Choose your desired Lightbox Script. This option will only affect the theme but not used plugins. Our portfolio plugin has an separate option under "Settings" > "Portfolio Settings".',
        'type'        => 'select',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_lightbox_settings',
        'std'          => 'prettyphoto',
        'choices'     => array( 
          array(
            'value'       => 'prettyphoto',
            'label'       => 'Prettyphoto'
          ),
          array(
            'value'       => 'lightgallery',
            'label'       => 'Lightgallery'
          )
        ),
      ),
      
      /*
      |--------------------------------------------------------------------------
      | Visual Composer Options
      |--------------------------------------------------------------------------
            
      array(
        'id'          => 'ut_vc_settings_menu',
        'subid'       => 'ut_vc_settings',
        'label'       => 'Visual Composer Settings',
        'type'        => 'section_headline',
        'section'     => 'ut_advanced_settings'
      ),
      
      array(
        'id'          => 'ut_vc_page_padding',
        'label'       => 'Turn of Page Padding?',
        'desc'        => 'With Integration of Visual Composer <strong>Page Padding</strong> is deprecated. However <strong>Page Padding Top"</strong> and <strong>Page Padding Bottom</strong> are still available. This Option just resets the global values.',
        'type'        => 'select',
        'section'     => 'ut_advanced_settings',
        'subsection'  => 'ut_vc_settings',
        'std'         => 'on',
        'choices'     => array( 
          array(
            'value'       => 'off',
            'label'       => 'yes, please!'
          ),
          array(
            'value'       => 'on',
            'label'       => 'no, thanks!'
          )
        ),
      ),
      */
      
    )
  );
  
  /* allow settings to be filtered before saving */
  $ut_settings = apply_filters( 'option_tree_settings_args', $ut_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $ut_settings ) {
    update_option( 'option_tree_settings', $ut_settings ); 
  }
  
}