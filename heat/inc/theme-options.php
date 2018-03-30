<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
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
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'General'
      ),
      array(
        'id'          => 'style',
        'title'       => 'Style'
      ),
      array(
        'id'          => 'portfolio_settings',
        'title'       => 'Portfolio Settings'
      ),
      array(
        'id'          => 'gallery_settings',
        'title'       => 'Gallery Settings'
      ),
      array(
        'id'          => 'blog_settings',
        'title'       => 'Blog Settings'
      ),
      array(
        'id'          => 'home_slider',
        'title'       => 'Home Slider'
      ),
      array(
        'id'          => 'slider_settings',
        'title'       => 'Slider Settings'
      ),
      array(
        'id'          => 'iosslider_settings',
        'title'       => 'iosSlider Settings'
      ),
      array(
        'id'          => 'social',
        'title'       => 'Social Accounts'
      ),
      array(
        'id'          => 'contact_settings',
        'title'       => 'Contact Infos'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'logo',
        'label'       => 'Logo',
        'desc'        => 'Upload a logo for your site.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'favicon',
        'label'       => 'Favicon',
        'desc'        => 'Upload a favicon for your site.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_info',
        'label'       => 'Footer Info',
        'desc'        => 'Enter the info you would like to display in the footer of your site.',
        'std'         => 'Copyright © 2012. All Rights Reserved.',
        'type'        => 'textarea',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'tracking_code',
        'label'       => 'Tracking Code',
        'desc'        => 'Paste your Google Analytics (or other) tracking code here.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'primary_typography',
        'label'       => 'Primary Typography',
        'desc'        => 'The Primary Typography option type is for adding typographic styles to your site. The most important one though is Google Fonts to create custom font stacks. Default color is #111111.',
        'std'         => 'a:1:{s:10:"font-color";s:7:"#111111";}',
        'type'        => 'typography',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'google_font_family',
        'label'       => 'Google Web Font Primary Typography',
        'desc'        => '<p class="warning">Paste Google Web Font link to your website.</p><p><b>Read more:</b> <a href="http://www.google.com/webfonts" target="_blank"><code>http://www.google.com/webfonts</code></a></p>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'google_font_name',
        'label'       => 'Google Web Font Name for Primary Typography',
        'desc'        => 'Enter the Google Web Font name for primary typography.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'menu_typography',
        'label'       => 'Menu Typography',
        'desc'        => 'The Menu Typography option type is for adding typographic styles for menu to your site. The most important one though is Google Fonts to create custom font stacks.',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'menu_google_font_family',
        'label'       => 'Google Web Font Menu Typography',
        'desc'        => '<p class="warning">Paste Google Web Font link for menu to your website.</p><p><b>Read more:</b> <a href="http://www.google.com/webfonts" target="_blank"><code>http://www.google.com/webfonts</code></a></p>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'menu_google_font_name',
        'label'       => 'Google Web Font Name for Menu Typography',
        'desc'        => 'Enter the Google Web Font name for menu typography.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_typography',
        'label'       => 'Header Typography',
        'desc'        => 'The Header Typography option type is for adding typographic styles for headers to your site. The most important one though is Google Fonts to create custom font stacks.',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_google_font_family',
        'label'       => 'Google Web Font Header Typography',
        'desc'        => '<p class="warning">Paste Google Web Font link for headings to your website.</p><p><b>Read more:</b> <a href="http://www.google.com/webfonts" target="_blank"><code>http://www.google.com/webfonts</code></a></p>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_google_font_name',
        'label'       => 'Google Web Font Name for Header Typography',
        'desc'        => 'Enter the Google Web Font name for header typography.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'primary_link_color',
        'label'       => 'Primary Link Color',
        'desc'        => 'Choose a color for primary link color. Default value is #ababab.',
        'std'         => '#ababab',
        'type'        => 'colorpicker',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'secondary_link_color',
        'label'       => 'Secondary Link Color',
        'desc'        => 'Choose a value for secondary link color. Default value is #666666.',
        'std'         => '#666666',
        'type'        => 'colorpicker',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'navigation_link_color',
        'label'       => 'Navigation Link Color — Hover/Active',
        'desc'        => 'Choose a value for navigation link color — hover/active. Default value is #ff7260.',
        'std'         => '#ff7260',
        'type'        => 'colorpicker',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'secondary_text_color',
        'label'       => 'Secondary Text Color',
        'desc'        => 'Choose a value for secondary text color. Default value is #cfcfcf.',
        'std'         => '#cfcfcf',
        'type'        => 'colorpicker',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'body_background_color',
        'label'       => 'Body Background Color',
        'desc'        => 'Choose a value for body background color. Default value is #f5f5f5.',
        'std'         => '#f5f5f5',
        'type'        => 'colorpicker',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_css',
        'label'       => 'Custom CSS',
        'desc'        => 'Quickly add some CSS to your theme by adding it to this block.',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'style',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'portfolios_per_page',
        'label'       => 'Portfolio pages show at most',
        'desc'        => 'Enter the number of Portfolios to show.',
        'std'         => '12',
        'type'        => 'text',
        'section'     => 'portfolio_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'portfolio_filtering',
        'label'       => 'Portfolio Filtering',
        'desc'        => 'Display portfolio filtering or not?',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'portfolio_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Portfolio Filtering',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'portfolio_meta',
        'label'       => 'Portfolio Meta',
        'desc'        => 'Select what information to display for each portfolio item on the portfolio page just under their title.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'portfolio_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'categories',
            'label'       => 'Categories',
            'src'         => ''
          ),
          array(
            'value'       => 'excerpt',
            'label'       => 'Excerpt',
            'src'         => ''
          ),
          array(
            'value'       => 'both',
            'label'       => 'Both',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'portfolio_page',
        'label'       => 'Portfolio Page',
        'desc'        => 'Select the portfolio page. Used for the "Back to portfolio" link.',
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'portfolio_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'galleries_per_page',
        'label'       => 'Gallery pages show at most',
        'desc'        => 'Enter the number of galleries to show per page/loading.',
        'std'         => '12',
        'type'        => 'text',
        'section'     => 'gallery_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'gallery_filtering',
        'label'       => 'Gallery Filtering',
        'desc'        => 'Display gallery filtering or not?',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'gallery_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Gallery Filtering',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'gallery_meta',
        'label'       => 'Gallery Meta',
        'desc'        => 'Select what information to display for each gallery item on the Galleries List page just under their title.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'gallery_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'categories',
            'label'       => 'Categories',
            'src'         => ''
          ),
          array(
            'value'       => 'excerpt',
            'label'       => 'Excerpt',
            'src'         => ''
          ),
          array(
            'value'       => 'both',
            'label'       => 'Both',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_infinite_scroll',
        'label'       => 'Blog Pagination',
        'desc'        => '<p>Choose if you wish to use a <strong>‘Load More’</strong> button.</p>',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'load_more',
            'label'       => 'Load more',
            'src'         => ''
          ),
          array(
            'value'       => 'default',
            'label'       => 'Default',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'home_slide_align',
        'label'       => 'Slide Align',
        'desc'        => 'Aligns image to center of slide.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'home_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'home_slide_scale_mode',
        'label'       => 'Image Scale Mode',
        'desc'        => 'Fit enlarges image if it\'s smaller then viewport. Fill scales image to completely fill slider viewport.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'home_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'fill',
            'label'       => 'Fill',
            'src'         => ''
          ),
          array(
            'value'       => 'fit',
            'label'       => 'Fit',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'home_slider_list',
        'label'       => 'Home Slider',
        'desc'        => '<p>You can create as many slides as your project requires and use them how you see fit.</p><p>All of the slides can be sorted and rearranged to your liking with Drag &amp; Drop. Don\'t worry about the order in which you create your slides, you can always reorder them.</p>',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'home_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'royal_autoplay',
        'label'       => 'Autoplay',
        'desc'        => '<p>Enable autoplay or not?</p>',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'slider_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Autoplay',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'pause_on_hover',
        'label'       => 'Pause on Hover',
        'desc'        => '<p>Pause autoplay on hover?</p>',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'slider_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Pause on Hover',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'delay',
        'label'       => 'Delay between slides in ms',
        'desc'        => '<p>Delay between items in ms.</p>',
        'std'         => '5500',
        'type'        => 'text',
        'section'     => 'slider_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'control_navigation',
        'label'       => 'Control Navigation',
        'desc'        => '<p>Enable control navigation or not?</p>',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'slider_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Control Navigation',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'fullscreen_function',
        'label'       => 'Fullscreen Function',
        'desc'        => '<p>Enable fullscreen function or not?</p>',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'slider_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Fullscreen Function',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'iosslider_scrollbar',
        'label'       => 'Scrollbar',
        'desc'        => '<p>Enable scrollbar or not?</p>',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'iosslider_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Scrollbar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'social_accounts',
        'label'       => 'Social Accounts',
        'desc'        => '<p>Which links would you like to display?</p>',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'facebook',
            'label'       => 'Facebook',
            'src'         => ''
          ),
          array(
            'value'       => 'twitter',
            'label'       => 'Twitter',
            'src'         => ''
          ),
          array(
            'value'       => 'gplus',
            'label'       => 'Google Plus',
            'src'         => ''
          ),
          array(
            'value'       => 'linkedin',
            'label'       => 'LinkedIn',
            'src'         => ''
          ),
          array(
            'value'       => 'dribbble',
            'label'       => 'Dribbble',
            'src'         => ''
          ),
          array(
            'value'       => 'pinterest',
            'label'       => 'Pinterest',
            'src'         => ''
          ),
          array(
            'value'       => 'foursquare',
            'label'       => 'Foursquare',
            'src'         => ''
          ),
          array(
            'value'       => 'instagram',
            'label'       => 'Instagram',
            'src'         => ''
          ),
          array(
            'value'       => 'vimeo',
            'label'       => 'Vimeo',
            'src'         => ''
          ),
          array(
            'value'       => 'flickr',
            'label'       => 'Flickr',
            'src'         => ''
          ),
          array(
            'value'       => 'github',
            'label'       => 'GitHub',
            'src'         => ''
          ),
          array(
            'value'       => 'tumblr',
            'label'       => 'Tumblr',
            'src'         => ''
          ),
          array(
            'value'       => 'forrst',
            'label'       => 'Forrst',
            'src'         => ''
          ),
          array(
            'value'       => 'lastfm',
            'label'       => 'Last.fm',
            'src'         => ''
          ),
          array(
            'value'       => 'stumbleupon',
            'label'       => 'StumbleUpon',
            'src'         => ''
          ),
          array(
            'value'       => 'px',
            'label'       => '500px',
            'src'         => ''
          ),
          array(
            'value'       => 'feed',
            'label'       => 'RSS',
            'src'         => ''
          ),
          array(
            'value'       => 'youtube',
            'label'       => 'YouTube',
            'src'         => ''
          ),
          array(
            'value'       => 'behance',
            'label'       => 'Behance',
            'src'         => ''
          ),
          array(
            'value'       => 'vk',
            'label'       => 'VK',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'facebook_url',
        'label'       => 'Facebook Address (URL)',
        'desc'        => '',
        'std'         => 'http://www.facebook.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter_url',
        'label'       => 'Twitter Address (URL)',
        'desc'        => '',
        'std'         => 'https://twitter.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'gplus_url',
        'label'       => 'Google Plus Address (URL)',
        'desc'        => '',
        'std'         => 'https://plus.google.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'linkedin_url',
        'label'       => 'LinkedIn Address (URL)',
        'desc'        => '',
        'std'         => 'http://www.linkedin.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'dribbble_url',
        'label'       => 'Dribbble Address (URL)',
        'desc'        => '',
        'std'         => 'http://dribbble.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'pinterest_url',
        'label'       => 'Pinterest Address (URL)',
        'desc'        => '',
        'std'         => 'http://pinterest.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'foursquare_url',
        'label'       => 'Foursquare Address (URL)',
        'desc'        => '',
        'std'         => 'https://foursquare.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'instagram_url',
        'label'       => 'Instagram Address (URL)',
        'desc'        => '',
        'std'         => 'http://instagram.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'vimeo_url',
        'label'       => 'Vimeo Address (URL)',
        'desc'        => '',
        'std'         => 'https://vimeo.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'flickr_url',
        'label'       => 'Flickr Address (URL)',
        'desc'        => '',
        'std'         => 'http://www.flickr.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'github_url',
        'label'       => 'GitHub Address (URL)',
        'desc'        => '',
        'std'         => 'https://github.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'tumblr_url',
        'label'       => 'Tumblr Address (URL)',
        'desc'        => '',
        'std'         => 'https://www.tumblr.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'forrst_url',
        'label'       => 'Forrst Address (URL)',
        'desc'        => '',
        'std'         => 'http://forrst.com',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'lastfm_url',
        'label'       => 'Last.fm Address (URL)',
        'desc'        => '',
        'std'         => 'http://www.lastfm.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'stumbleupon_url',
        'label'       => 'StumbleUpon Address (URL)',
        'desc'        => '',
        'std'         => 'http://www.stumbleupon.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'px_url',
        'label'       => '500px Address (URL)',
        'desc'        => '',
        'std'         => 'http://500px.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'feed_url',
        'label'       => 'RSS Address (URL)',
        'desc'        => '',
        'std'         => 'javascript:void(null);',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'youtube_url',
        'label'       => 'YouTube Address (URL)',
        'desc'        => '',
        'std'         => 'http://www.youtube.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'behance_url',
        'label'       => 'Behance Address (URL)',
        'desc'        => '',
        'std'         => 'http://www.behance.net/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'vk_url',
        'label'       => 'VK Address (URL)',
        'desc'        => '',
        'std'         => 'http://vk.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'map_address',
        'label'       => 'Adress',
        'desc'        => '<p>Insert your Address here. Example:</p><p>13/2 Elizabeth Street, Melbourne VIC 3000</p>',
        'std'         => '3/2 Elizabeth Street, Melbourne VIC 3000',
        'type'        => 'text',
        'section'     => 'contact_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'map_height',
        'label'       => 'Map Height',
        'desc'        => 'Insert map height.',
        'std'         => '401',
        'type'        => 'text',
        'section'     => 'contact_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'map_content',
        'label'       => 'Map Info Content',
        'desc'        => '<p>Insert Map Info Content here. Example: <br />Envato (FlashDen Pty Ltd) 13/2 Elizabeth Street, Melbourne VIC 3000 (03) 9023 0074 · envato.com</p>',
        'std'         => 'Envato (FlashDen Pty Ltd) 13/2 Elizabeth Street, Melbourne VIC 3000 (03) 9023 0074 · envato.com',
        'type'        => 'textarea-simple',
        'section'     => 'contact_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'map_grayscale',
        'label'       => 'Grayscale',
        'desc'        => '<p>Enable grayscale or not?</p>',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'contact_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Grayscale',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'map_custom_marker',
        'label'       => 'Custom Marker',
        'desc'        => 'Upload a custom marker for your address.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'contact_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}