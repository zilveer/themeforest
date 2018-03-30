<?php

/**
 * Build the custom settings & update OptionTree.
 */
if(!function_exists('uxbarn_custom_theme_options')) {
    
    function uxbarn_custom_theme_options() {
      /**
       * Get a copy of the saved settings array. 
       */
      $saved_settings = get_option( 'option_tree_settings', array() );
      
      /**
       * Custom settings array that will eventually be 
       * passes to the OptionTree Settings API Class.
       */
      $custom_settings = array( 
        'contextual_help' => array(
          
          'sidebar'       => ''
        ),
        
        // Sections
        
        'sections'        => array( 
          array(
            'id'          => 'uxbarn_to_general_section',
            'title'       => __('General', 'uxbarn')
          ),
          array(
            'id'          => 'uxbarn_to_header_section',
            'title'       => __('Header Image', 'uxbarn')
          ),
          array(
            'id'          => 'uxbarn_to_sidebar_section',
            'title'       => __('Custom Sidebar', 'uxbarn')
          ),
          array(
            'id'          => 'uxbarn_to_home_slider_section',
            'title'       => __('Home Slider', 'uxbarn')
          ),
          array(
            'id'          => 'uxbarn_to_portfolio_section',
            'title'       => __('Portfolio Single Page', 'uxbarn')
          ),
          array(
            'id'          => 'uxbarn_to_blog_section',
            'title'       => __('Blog', 'uxbarn')
          ),
          array(
            'id'          => 'uxbarn_to_footer_section',
            'title'       => __('Footer', 'uxbarn')
          ),
          array(
            'id'          => 'uxbarn_to_social_network_section',
            'title'       => __('Social Network', 'uxbarn')
          ),
          array(
            'id'          => 'uxbarn_to_google_fonts_section',
            'title'       => __('Google Fonts', 'uxbarn')
          ),
          array(
            'id'          => 'uxbarn_to_google_maps_section',
            'title'       => __('Google Maps', 'uxbarn')
          ),
          array(
            'id'          => 'uxbarn_to_plugins_section',
            'title'       => __('Plugins', 'uxbarn')
          ),
        ),
        'settings'        => array( 
            
              // General Tab
            
              array(
                'id'          => 'uxbarn_to_setting_upload_favicon',
                'label'       => __('Upload Favicon', 'uxbarn'),
                'desc'        => __('Favicon will be displayed on the address bar and tab of the browser. Click at the icon to upload the image or if you already know the URL of the image, just paste it to the box.', 'uxbarn'),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_use_fixed_header',
                'label'       => __('Use Fixed Header?', 'uxbarn'),
                'desc'        => __('Whether to always fix the header (logo and menu) at the top even when scrolling down the page.', 'uxbarn'),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
			  array(
                'id'          => 'uxbarn_to_setting_header_style',
                'label'       => __('Header Style', 'uxbarn'),
                'desc'        => __('Select the style for the header. "Center Alignment" style will make the logo and menu center aligned.', 'uxbarn'),
                'std'         => '',
                'type'        => 'select',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => 'default',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'default',
                    'label'       => __('Default', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'center',
                    'label'       => __('Center Alignment', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_auto_flipping_submenu',
                'label'       => __('Auto Flipping Submenu?', 'uxbarn'),
                'desc'        => __('Whether to flip the submenu display for the last two menu items.', 'uxbarn'),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_display_breadcrumb',
                'label'       => __('Display Breadcrumb Navigation?', 'uxbarn'),
                'desc'        => __('Whether to display the breadcrumb bar on all pages (except front page).', 'uxbarn'),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_slider_header_style',
                'label'       => __('Home Slider, Header Image and Footer Style', 'uxbarn'),
                'desc'        => __('Select the style for home slider, header image and footer widgets area. Note that "Fixed-Width" style is 1020px width.', 'uxbarn'),
                'std'         => 'full-width',
                'type'        => 'select',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'full-width',
                    'label'       => __('Full-Width', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'fixed-width',
                    'label'       => __('Fixed-Width', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_enable_lightbox_wp_gallery',
                'label'       => __('Enable Lightbox for WordPress Gallery?', 'uxbarn'),
                'desc'        => __('Whether to enable lightbox feature for WordPress gallery shortcode. <p><strong>Note:</strong> Also make sure that you already set the "Link To" option to "Media File" in your gallery shortcode.</p>', 'uxbarn'),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_enable_page_comment',
                'label'       => __('Enable Page Comment?', 'uxbarn'),
                'desc'        => __('<p>Whether to enable the comment function for all Page by default.</p><p>When you have enabled it, please make sure that each Page is also marked as "Allow Comments". You can find that mark from the Quick Edit menu of the Page.</p>', 'uxbarn'),
                'std'         => 'false',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_display_scroll_to_top_button',
                'label'       => __('Display Scroll-To-Top Button?', 'uxbarn'),
                'desc'        => __('Whether to display the button for scrolling to the top of the page.', 'uxbarn'),
                'std'         => 'false',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              
              
              // Header Tab
              
              array(
                'id'          => 'uxbarn_to_setting_upload_search_header_image',
                'label'       => __('Upload Search Page\'s Header Image', 'uxbarn'),
                'desc'        => __('Click at the icon to upload the image or if you already know the URL of the image, just paste it to the box.', 'uxbarn'),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_header_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_upload_404_header_image',
                'label'       => __('Upload 404 Page\'s Header Image', 'uxbarn'),
                'desc'        => __('Click at the icon to upload the image or if you already know the URL of the image, just paste it to the box.', 'uxbarn'),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_header_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
              
              
              // Sidebar Tab
              
              array(
                'id'          => 'uxbarn_to_setting_custom_sidebars',
                'label'       => __('Custom Sidebars', 'uxbarn'),
                'desc'        => __('<p>With this option, you can create your own custom sidebars as many as you want. After that, go to <strong>Appearance &gt; Widgets</strong> to manage widgets for them.</p><p>You can then assign a custom sidebar to a page by going to Add New or Edit Page menu and look for the meta box named Sidebar Setting.</p>', 'uxbarn'),
                'std'         => '',
                'type'        => 'list-item',
                'section'     => 'uxbarn_to_sidebar_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'settings'    => array( 
                  array(
                    'id'          => 'uxbarn_to_setting_custom_sidebars_item_description',
                    'label'       => __('Description', 'uxbarn'),
                    'desc'        => '',
                    'std'         => '',
                    'type'        => 'text',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                  )
                )
              ),
              
              
              
              // Home Slider Tab
              
              array(
                'id'          => 'uxbarn_to_setting_select_slider',
                'label'       => __('Slider Type', 'uxbarn'),
                'desc'        => __('<p>Select which slider type you would like to use on homepage:</p><p><strong>Basic Slider:</strong> This is the default one. You can use "Home Slider" menu on your admin panel to manage slides for this type.</p><p><strong>LayerSlider:</strong> You can manage sliders using "LayerSlider WP" menu on your admin panel. After you have created some sliders there, select this option as "LayerSlider" then you can use the option below to select which slider to be used on homepage.</p>', 'uxbarn'),
                'std'         => 'basic-slider',
                'type'        => 'select',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'basic-slider',
                    'label'       => __('Basic Slider', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'layerslider',
                    'label'       => __('LayerSlider', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_basic_slider_transition',
                'label'       => __("Home Slider's Transition Effect", 'uxbarn'),
                'desc'        => __('Select the transition for basic slider.', 'uxbarn'),
                'std'         => 'directscroll',
                'type'        => 'select',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'directscroll',
                    'label'       => __('Slide', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'crossfade',
                    'label'       => __('Fade', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'cover-fade',
                    'label'       => __('Cover', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'uncover-fade',
                    'label'       => __('Uncover', 'uxbarn'),
                    'src'         => ''
                  ),
                ),
                'condition'   => 'uxbarn_to_setting_select_slider:is(basic-slider)',
				'operator'    => 'and'
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_basic_slider_transition_speed',
                'label'       => __("Home Slider's Transition Speed", 'uxbarn'),
                'desc'        => __('Enter a number of how fast you want the transition to animate, in milliseconds.', 'uxbarn'),
                'std'         => '1000',
                'type'        => 'text',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'condition'   => 'uxbarn_to_setting_select_slider:is(basic-slider)',
				'operator'    => 'and'
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_basic_slider_auto_rotation',
                'label'       => __("Enable Home Slider's Auto Rotation?", 'uxbarn'),
                'desc'        => __('Whether to enable the auto rotation mode for the slider.', 'uxbarn'),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
                'condition'   => 'uxbarn_to_setting_select_slider:is(basic-slider)',
				'operator'    => 'and'
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_basic_slider_rotation_duration',
                'label'       => __("Home Slider's Rotation Duration", 'uxbarn'),
                'desc'        => __('Enter a number of how long to stay on the current slide before rotating to the next one, in milliseconds.', 'uxbarn'),
                'std'         => '8000',
                'type'        => 'text',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'condition'   => 'uxbarn_to_setting_select_slider:is(basic-slider),uxbarn_to_setting_basic_slider_auto_rotation:is(true)',
				'operator'    => 'and'
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_select_layerslider',
                'label'       => __('LayerSlider for Homepage', 'uxbarn'),
                'desc'        => __('Enter the shortcode of the slider you want to display.<p>You can find the slider shortcode by going to "LayerSlider WP" menu on your admin panel.</p>', 'uxbarn'),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'condition'   => 'uxbarn_to_setting_select_slider:is(layerslider)',
				'operator'    => 'and'
              ),
              
              /*array(
                'id'          => 'uxbarn_to_setting_wpml_layerslider',
                'label'       => __('[WPML] LayerSlider for Other Languages', 'uxbarn'),
                'desc'        => __('You can duplicate the LayerSlider in "LayerSlider WP" menu, then translate each of those duplicated ones, and use this option to select which slider to be used with any specific languages of WPML.', 'uxbarn'),
                'std'         => '',
                'type'        => 'ux-wpml-layerslider-select',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'settings'    => array( 
                      array(
                        'id'          => 'uxbarn_to_setting_wpml_language_code',
                        'label'       => __('Language Code', 'uxbarn'),
                        'desc'        => '',
                        'std'         => '',
                        'type'        => 'text',
                        'rows'        => '',
                        'post_type'   => '',
                        'taxonomy'    => '',
                        'class'       => ''
                      ),
                      array(
                        'id'          => 'uxbarn_to_setting_layerslider_id',
                        'label'       => __('LayerSlider for This Language', 'uxbarn'),
                        'desc'        => '',
                        'std'         => '',
                        'type'        => 'ux-layerslider-select',
                        'rows'        => '',
                        'post_type'   => '',
                        'taxonomy'    => '',
                        'class'       => ''
                      ),
                  ),
              ),
              */
              
              
              // Portfolio Tab
              
              array(
                'id'          => 'uxbarn_to_setting_display_related_items_section',
                'label'       => __('Display Related Items?', 'uxbarn'),
                'desc'        => __('Whether to display the Related Items section on the single page.', 'uxbarn'),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_portfolio_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_related_items_scope',
                'label'       => __('Related Items: Optional Scopes', 'uxbarn'),
                'desc'        => __('By default, theme uses only portfolio category for displaying related items. This option lets you choose any optional scopes (from custom fields) to be used with the portfolio category. The operators are applied as:<p><strong>category AND (client OR website OR date)</strong></p><p>Also note that all scopes here use the exact match (=) to compare the values.</p>', 'uxbarn'),
                'std'         => '',
                'type'        => 'checkbox',
                'section'     => 'uxbarn_to_portfolio_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array(
                  array(
                    'value'       => 'client',
                    'label'       => __('Client', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'website',
                    'label'       => __('Website', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'date',
                    'label'       => __('Date', 'uxbarn'),
                    'src'         => ''
                  ),
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_portfolio_slider_transition',
                'label'       => __('Portfolio Slider\'s Transition Effect', 'uxbarn'),
                'desc'        => __('Select the transition for portfolio slider on the single page.', 'uxbarn'),
                'std'         => 'directscroll',
                'type'        => 'select',
                'section'     => 'uxbarn_to_portfolio_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'directscroll',
                    'label'       => __('Slide', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'crossfade',
                    'label'       => __('Fade', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'cover-fade',
                    'label'       => __('Cover', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'uncover-fade',
                    'label'       => __('Uncover', 'uxbarn'),
                    'src'         => ''
                  ),
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_portfolio_slider_transition_speed',
                'label'       => __("Portfolio Slider's Transition Speed", 'uxbarn'),
                'desc'        => __('Enter a number of how fast you want the transition to animate, in milliseconds.', 'uxbarn'),
                'std'         => '1000',
                'type'        => 'text',
                'section'     => 'uxbarn_to_portfolio_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_portfolio_slider_auto_rotation',
                'label'       => __("Enable Portfolio Slider's Auto Rotation?", 'uxbarn'),
                'desc'        => __('Whether to enable the auto rotation mode for the slider.', 'uxbarn'),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_portfolio_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_portfolio_slider_rotation_duration',
                'label'       => __("Portfolio Slider's Rotation Duration", 'uxbarn'),
                'desc'        => __('Enter a number of how long to stay on the current slide before rotating to the next one, in milliseconds.', 'uxbarn'),
                'std'         => '5000',
                'type'        => 'text',
                'section'     => 'uxbarn_to_portfolio_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'condition'   => 'uxbarn_to_setting_portfolio_slider_auto_rotation:is(true)',
				'operator'    => 'and'
              ),
              
              
              
              // Blog Tab
              
              array(
                'id'          => 'uxbarn_to_setting_blog_sidebar',
                'label'       => __('Blog Sidebar', 'uxbarn'),
                'desc'        => __('Select how the blog sidebar displayed on the blog page (Posts page).', 'uxbarn'),
                'std'         => 'right',
                'type'        => 'select',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => '',
                    'label'       => __('No Sidebar', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'right',
                    'label'       => __('Right Side', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'left',
                    'label'       => __('Left Side', 'uxbarn'),
                    'src'         => ''
                  ),
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_post_thumbnail_location',
                'label'       => __('Post Thumbnail Location', 'uxbarn'),
                'desc'        => __('Select where to display the post thumbnail. This will be applied to the blog page (Posts page).', 'uxbarn'),
                'std'         => 'below-title',
                'type'        => 'select',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array(
                  array(
                    'value'       => 'below-title',
                    'label'       => __('Below Post Title', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'above-title',
                    'label'       => __('Above Post Title', 'uxbarn'),
                    'src'         => ''
                  ),
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_override_post_meta_info',
                'label'       => __('Override Post Meta Info?', 'uxbarn'),
                'desc'        => __('Whether to override some custom fields of all individual posts with this global setting.', 'uxbarn'),
                'std'         => 'false',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_post_meta_info_display',
                'label'       => __('Meta Info Display', 'uxbarn'),
                'desc'        => __('Use this option if you want to show or hide meta information. This will affect both blot-posts page and single page.', 'uxbarn'),
                'std'         => '',
                'type'        => 'checkbox',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'date',
                    'label'       => __('Show date?', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'author_name',
                    'label'       => __('Show author name?', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'comment',
                    'label'       => __('Show comment count?', 'uxbarn'),
                    'src'         => ''
                  )
                ),
                'condition'   => 'uxbarn_to_setting_override_post_meta_info:is(true)',
				'operator'    => 'and'
              ),
              
              array(
                'id'          => 'uxbarn_to_post_single_post_element_display',
                'label'       => __('Single Post Element Display', 'uxbarn'),
                'desc'        => __('These elements are in the single post page. You can use this option whether to display them or not.', 'uxbarn'),
                'std'         => '',
                'type'        => 'checkbox',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'author',
                    'label'       => __('Show author box?', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'tags',
                    'label'       => __('Show tags?', 'uxbarn'),
                    'src'         => ''
                  ),
                ),
                'condition'   => 'uxbarn_to_setting_override_post_meta_info:is(true)',
				'operator'    => 'and'
              ),
              
              
              
              // Footer Tab
              
              array(
                'id'          => 'uxbarn_to_setting_display_footer_widget_area',
                'label'       => __('Display Footer Widget Area?', 'uxbarn'),
                'desc'        => __('Whether to display the widget area on footer.', 'uxbarn'),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_footer_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_footer_widget_area_columns',
                'label'       => __('Footer Widget Area Columns', 'uxbarn'),
                'desc'        => __('Select a number of columns for the footer widget area.', 'uxbarn'),
                'std'         => '3',
                'type'        => 'select',
                'section'     => 'uxbarn_to_footer_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => '1',
                    'label'       => __('1 Column', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => '2',
                    'label'       => __('2 Columns', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => '3',
                    'label'       => __('3 Columns', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => '4',
                    'label'       => __('4 Columns', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_copyright_text',
                'label'       => __('Copyright Text', 'uxbarn'),
                'desc'        => __('<p>This copyright text will be displayed on the footer below the widget area.</p><p><strong>Important: </strong>If you are using some HTML tag like an anchor tag for a link, make sure to have the opening and closing tags properly.</p>', 'uxbarn'),
                'std'         => __( '&copy; Archtek. Premium Theme by <a href="http://themeforest.net/user/UXbarn?ref=UXbarn">UXBARN</a>.', 'uxbarn' ),
                'type'        => 'text',
                'section'     => 'uxbarn_to_footer_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
    		  
    		  
    		  // Social Network Tab
              array(
                'id'          => 'uxbarn_to_setting_social_type',
                'label'       => esc_html__( 'Social Icon Type', 'uxbarn' ),
                'desc'        => esc_html__( 'You can choose to use either image or icon font from Font Awesome for the social network icons.', 'uxbarn' ),
                'std'         => 'default',
                'type'        => 'select',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'image',
                    'label'       => esc_html__( 'Image Icon', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'font',
                    'label'       => esc_html__( 'Font Awesome Icon', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),

              array(
                'id'          => 'uxbarn_to_setting_social_font_awesome',
                'label'       => esc_html__( 'Font Awesome Icons', 'uxbarn' ),
                'desc'        => esc_html__( 'You can use this option to create your own list of social network icon from Font Awesome. Just click "Add New", enter the title, URL and select the icon. You can also rearrange the positions using drag-and-drop feature here.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'list-item',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'min_max_step'=> '',
                'class'       => 'social-custom-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(font)',
                'operator'    => 'and',
                'settings'    => array( 
                  array(
                    'id'          => 'uxbarn_to_setting_social_font_awesome_url',
                    'label'       => esc_html__( 'URL', 'uxbarn' ),
                    'desc'        => esc_html__( 'Enter the URL of your social network for this icon', 'uxbarn' ),
                    'std'         => '',
                    'type'        => 'text',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'min_max_step'=> '',
                    'class'       => '',
                    'condition'   => '',
                    'operator'    => 'and'
                  ),
                  array(
                    'id'          => 'uxbarn_to_setting_social_font_awesome_icon',
                    'label'       => esc_html__( 'Select Icon', 'uxbarn' ),
                    'desc'        => esc_html__( 'Select an icon from the list or select "Custom" to manually enter the icon class name.' ),
                    'std'         => '',
                    'type'        => 'select',
                    'section'     => 'uxbarn_to_social_network_section',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'condition'   => '',
                    'operator'    => '',
                    'choices'     => array( 
                      array(
                        'value'       => 'facebook',
                        'label'       => 'facebook',
                      ),
                      array(
                        'value'       => 'facebook-official',
                        'label'       => 'facebook-official',
                      ),
                      array(
                        'value'       => 'facebook-square',
                        'label'       => 'facebook-square',
                      ),
                      array(
                        'value'       => 'twitter',
                        'label'       => 'twitter',
                      ),
                      array(
                        'value'       => 'twitter-square',
                        'label'       => 'twitter-square',
                      ),
                      array(
                        'value'       => 'google-plus',
                        'label'       => 'google-plus',
                      ),
                      array(
                        'value'       => 'instagram',
                        'label'       => 'instagram',
                      ),
                      array(
                        'value'       => 'flickr',
                        'label'       => 'flickr',
                      ),
                      array(
                        'value'       => 'dribbble',
                        'label'       => 'dribbble',
                      ),
                      array(
                        'value'       => 'behance',
                        'label'       => 'behance',
                      ),
                      array(
                        'value'       => 'behance-square',
                        'label'       => 'behance-square',
                      ),
                      array(
                        'value'       => 'linkedin',
                        'label'       => 'linkedin',
                      ),
                      array(
                        'value'       => 'linkedin-square',
                        'label'       => 'linkedin-square',
                      ),
                      array(
                        'value'       => 'vimeo',
                        'label'       => 'vimeo',
                      ),
                      array(
                        'value'       => 'vimeo-square',
                        'label'       => 'vimeo-square',
                      ),
                      array(
                        'value'       => 'youtube',
                        'label'       => 'youtube',
                      ),
                      array(
                        'value'       => 'youtube-play',
                        'label'       => 'youtube-play',
                      ),
                      array(
                        'value'       => 'youtube-square',
                        'label'       => 'youtube-square',
                      ),
                      array(
                        'value'       => 'rss',
                        'label'       => 'rss',
                      ),
                      array(
                        'value'       => 'rss-square',
                        'label'       => 'rss-square',
                      ),
                      array(
                        'value'       => 'custom',
                        'label'       => esc_html__( 'Custom', 'uxbarn' ),
                      ),
                    ),
                  ),
                  
                  
                  array(
                    'id'          => 'uxbarn_to_setting_social_font_awesome_custom_icon',
                    'label'       => esc_html__( "Custom Icon's Class Name", 'uxbarn' ),
                    'desc'        => sprintf( esc_html__( 'Enter the class name. You can view the full list of the class names here: %s', 'uxbarn' ), '<strong><a href="http://fontawesome.io/icons/#brand" target="_blank">See the list</a></strong>. You can enter it here as "paypal", for example.' ),
                    'std'         => '',
                    'type'        => 'text',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'min_max_step'=> '',
                    'class'       => '',
                    'condition'   => 'uxbarn_to_setting_social_font_awesome_icon:is(custom)',
                    'operator'    => 'and'
                  ),
                  
                ),
              ),

              array(
                'id'          => 'uxbarn_to_setting_social_set',
                'label'       => esc_html__( 'Image Icon Set', 'uxbarn' ),
                'desc'        => esc_html__( 'Select whether to use the default built-in set or define your own set for social icons.', 'uxbarn' ),
                'std'         => 'default',
                'type'        => 'select',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'condition'   => 'uxbarn_to_setting_social_type:is(image)',
                'operator'    => 'and',
                'choices'     => array( 
                  array(
                    'value'       => 'default',
                    'label'       => esc_html__( 'Default Set', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'custom',
                    'label'       => esc_html__( 'Custom Set', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),
              
        array(
            'id'          => 'uxbarn_to_setting_social_custom_set',
            'label'       => esc_html__( 'Custom Image Icons', 'uxbarn' ),
            'desc'        => esc_html__( 'You can use this option to add your own list of social network icon. Just click "Add New", enter the title, URL and upload the icon image. You can also rearrange the positions using drag-and-drop feature here.', 'uxbarn' ),
            'std'         => '',
            'type'        => 'list-item',
            'section'     => 'uxbarn_to_social_network_section',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => 'social-custom-set',
            'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(custom)',
            'operator'    => 'and',
            'settings'    => array( 
              array(
                'id'          => 'uxbarn_to_setting_social_custom_set_url',
                'label'       => esc_html__( 'URL', 'uxbarn' ),
                'desc'        => esc_html__( 'Enter the URL of your social network for this icon', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'min_max_step'=> '',
                'class'       => '',
                'condition'   => '',
                'operator'    => 'and'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_custom_set_icon',
                'label'       => esc_html__( 'Icon', 'uxbarn' ),
                'desc'        => esc_html__( 'Upload an image for this social icon.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'min_max_step'=> '',
                'class'       => '',
                'condition'   => '',
                'operator'    => 'and'
              )
            )
          ),

              array(
                'id'          => 'uxbarn_to_setting_social_facebook',
                'label'       => __('Facebook URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_facebook_upload',
                'label'       => esc_html__( 'Facebook Icon', 'uxbarn' ),
                'desc'        => esc_html__( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_twitter',
                'label'       => __('Twitter URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_twitter_upload',
                'label'       => esc_html__( 'Twitter Icon', 'uxbarn' ),
                'desc'        => esc_html__( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_google_plus',
                'label'       => __('Google+ URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_google_plus_upload',
                'label'       => esc_html__( 'Google+ Icon', 'uxbarn' ),
                'desc'        => esc_html__( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_linkedin',
                'label'       => __('LinkedIn URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_linkedin_upload',
                'label'       => esc_html__( 'LinkedIn Icon', 'uxbarn' ),
                'desc'        => esc_html__( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_flickr',
                'label'       => __('Flickr URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_flickr_upload',
                'label'       => esc_html__( 'Flickr Icon', 'uxbarn' ),
                'desc'        => esc_html__( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_vimeo',
                'label'       => __('Vimeo URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_vimeo_upload',
                'label'       => esc_html__( 'Vimeo Icon', 'uxbarn' ),
                'desc'        => esc_html__( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_youtube',
                'label'       => __('YouTube URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_youtube_upload',
                'label'       => esc_html__( 'YouTube Icon', 'uxbarn' ),
                'desc'        => esc_html__( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_forrst',
                'label'       => __('Forrst URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_forrst_upload',
                'label'       => esc_html__( 'Forrst Icon', 'uxbarn' ),
                'desc'        => esc_html__( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_dribbble',
                'label'       => __('Dribbble URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_dribbble_upload',
                'label'       => esc_html__( 'Dribbble Icon', 'uxbarn' ),
                'desc'        => esc_html__( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_rss',
                'label'       => __('RSS URL', 'uxbarn'),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_rss_upload',
                'label'       => esc_html__( 'RSS Icon', 'uxbarn' ),
                'desc'        => esc_html__( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set',
                'condition'   => 'uxbarn_to_setting_social_type:is(image),uxbarn_to_setting_social_set:is(default)',
                'operator'    => 'and',
              ),
              
              
              
              // Google Fonts Tab
              
              array(
                'id'          => 'uxbarn_to_setting_google_fonts_loader',
                'label'       => __('Google Fonts Loader', 'uxbarn'),
                'desc'        => '<p>To enable Google Fonts selection, please go to <a href="http://www.google.com/webfonts#" target="_blank">Google Web Fonts website</a>, select the fonts you like, copy the family list then paste them to this textbox. After that simply press "Save Changes" button and the fonts will be loaded to all font select lists in Style Customizer.</p><p>Please read more detail about this in the provided documentation under the section of "Getting Started > Google Fonts".</p>',
                'std'         => DEFAULT_GOOGLE_FONTS,
                'type'        => 'textarea-simple',
                'section'     => 'uxbarn_to_google_fonts_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_google_fonts_character_sets',
                'label'       => esc_html__( 'Character Sets', 'uxbarn'),
                'desc'        => esc_html__( 'Choose the character sets you want. If you are not sure what is this, just leave them unchecked.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'checkbox',
                'section'     => 'uxbarn_to_google_fonts_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array(
                  array(
                    'value'       => 'latin',
                    'label'       => esc_html__( 'Latin (latin)', 'uxbarn' ),
                    'src'         => ''
                  ), 
                  array(
                    'value'       => 'latin-ext',
                    'label'       => esc_html__( 'Latin Extended (latin-ext)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'cyrillic',
                    'label'       => esc_html__( 'Cyrillic (cyrillic)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'cyrillic-ext',
                    'label'       => esc_html__( 'Cyrillic Extended (cyrillic-ext)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'greek',
                    'label'       => esc_html__( 'Greek (greek)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'greek-ext',
                    'label'       => esc_html__( 'Greek Extended (greek-ext)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'vietnamese',
                    'label'       => esc_html__( 'Vietnamese (vietnamese)', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),
              
			  // Google Maps Tab

        array(
          'id'          => 'uxbarn_to_setting_google_maps_api_key',
          'label'       => __( 'API Key', 'uxbarn' ),
          'desc'        => sprintf( __( 'If the Google Maps element does not work on your domain as it generates an error, it means that an additional API key is required. <a href="%s" target="_blank">Click here to get your API key from Google</a>. After that, put the key into this text box and save.', 'uxbarn' ), 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ),
          'std'         => '',
          'type'        => 'text',
          'section'     => 'uxbarn_to_google_maps_section',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => ''
        ),
			  
			  // Plugins Tab
              
              array(
                'id'          => 'uxbarn_to_setting_display_theme_wpml_lang_selector',
                'label'       => __('Display WPML Language Selector?', 'uxbarn'),
                'desc'        => __('If WPML is activated, use this option to display the WPML language selector in the header location defined by theme. <p><strong>Note: </strong>Theme will use the configuration that you set in "WPML > Languages > Language switcher options".</p>', 'uxbarn'),
                'std'         => 'false',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_plugins_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
        )
      );
       
      /* settings are not the same update the DB */
      if ( $saved_settings !== $custom_settings ) {
        update_option( 'option_tree_settings', $custom_settings ); 
      }
      
    }

}