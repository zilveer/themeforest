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
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => '<p>Help content goes here!</p>'
        )
      ),
      'sidebar'       => '<p>Sidebar content goes here!</p>'
    ),
    'sections'        => array( 
      array(
        'id'          => 'analytics',
        'title'       => 'Analytics & Meta'
      ),
      array(
        'id'          => 'css',
        'title'       => 'Custom CSS'
      ),
      array(
        'id'          => 'sidebars',
        'title'       => 'Widget Areas'
      ),

      array(
        'id'          => 'admin',
        'title'       => 'Admin'
      ),
      array(
        'id'          => 'gmaps',
        'title'       => 'Google Maps API'
      ),
      array(
        'id'          => 'updates',
        'title'       => 'Updates'
      ),
      array(
        'id'          => 'log',
        'title'       => '<strong>Changelog</strong>'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'krown_tracking_enable',
        'label'       => 'Enable analytics',
        'desc'        => 'Please select this if you\'ll be using Google Analytics in the theme.',
        'std'         => 'disabled',
        'type'        => 'radio',
        'section'     => 'analytics',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Enabled',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Disabled',
            'src'         => ''
          )
        ),
      ),

      array(
        'id'          => 'krown_gmaps',
        'label'       => 'Google Maps API (v3) key',
        'desc'        => 'Since Google Maps changed their API to version 3, all the embedded maps need an API key in order to run. Maps on old sites will still work, but new ones don\'t. <br><br>If this is the case for you, <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#key" target="_blank">read this article</a> or <a href="https://www.youtube.com/watch?v=OH98za14LNg" target="_blank">watch this video</a> (up until 2:00) to learn how to obtain a proper API key.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'gmaps',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),

      array(
        'id'          => 'krown_changelog',
        'label'       => 'Changelog', 'krown',
        'desc'        => '<ul>
<li><strong>Version 1.7.4: 14 July 2016</strong>
<br>~ Added support for the new Google Maps API
<br>~ Updated the Revolution Slider to 5.2.6<br><br></li>
<li><strong>Version 1.7.3: 16 June 2016</strong>
<br>~ Added support for WooCommerce 2.6
<br>~ Updated the Revolution Slider and Visual Composer plugins to their latest versions
<br>~ Updated Font Awesome library to 4.6.3<br><br></li>
<li><strong>Version 1.7.2: 25 April 2016</strong>
<br>~ Updated the Revolution Slider and Visual Composer plugins to their latest versions<br><br>
<span style="color: red">--- <br><strong>Att: The Visual Composer plugin needs to be updated manually! <br><a href="http://wordpress-support.krownthemes.com/article/121-how-to-update#plugins" target="_blank">Read here how</a></strong><br>---</span><br><br></li>
<li><strong>Version 1.7.1: 13 April 2016</strong>
<br>~ Updated the Revolution Slider and Visual Composer plugins to their latest versions
<br>~ Improved compatibility for WooCommerce 2.5.3<br><br></li>
<li><strong>Version 1.7: 15 February 2016</strong>
<br>~ Added SIDEKICK integration
<br>~ Fixed an issue with WooCommerce product variation images
<br>~ Improved compatibility for WooCommerce 2.5.2<br><br></li>
<li><strong>Version 1.6.7: 30 January 2016</strong>
<br>~ Added compatibility for WooCommerce 2.5.0
<br>~ Updated Font Awesome to 4.5.0
<br>~ Updated the Revolution Slider and Visual Composer plugins to their latest versions<br><br></li>
<li><strong>Version 1.6.6: 12 December 2015</strong>
<br>~ Fixed an issue related to pagination in WP4.4
<br>~ Updated the Revolution Slider and Visual Composer plugins to their latest versions<br><br></li>
<li><strong>Version 1.6.5 : 30 October 2015</strong>
<br>~ Fixed an issue related to WooCommerce cart images
<br>~ Fixed the accordion shortcode
<br>~ Fixed the single image shortcode<br><br></li>
<li><strong>Version 1.6.4 : 9 October 2015</strong>
<br>~ Fixed an issue related to WooCommerce 2.4.7<br><br></li>
<li><strong>Version 1.6.3 : 7 October 2015</strong>
<br>~ Updated the Revolution Slider and Visual Composer plugins to their latest versions
<br>~ Added compatibility for WooCommerce 2.4.7<br><br></li>
<li><strong>Version 1.6.2 : 21 August 2015</strong>
<br>~ Updated the Revolution Slider to v5.0.4.1, which includes support for WordPress 4.3<br><br></li>
<li><strong>Version 1.6.1 : 18 August 2015</strong>
<br>~ Fixed the tabs shortcode issue<br><br></li>
<li><strong>Version 1.6 : 15 August 2015</strong>
<br>~ Added support for WooCommerce 2.4
<br>~ Updated the Revolution Slider to the all new version 5<br><br></li>
<li><strong>Version 1.5.8 : 7 July 2015</strong>
<br>~ Added a fail safe against Envato API issues (fixed admin login problems)<br><br></li>
<li><strong>Version 1.5.7 : 3 July 2015</strong>
<br>~ One more minor fix related to WooCommerce<br><br></li>
<li><strong>Version 1.5.6 : 2 July 2015</strong>
<br>~ Critical fix after last update<br><br></li>
<li><strong>Version 1.5.5 : 2 July 2015</strong>
<br>~ Fixed an error with WooCommerce headers
<br>~ Updated the Revolution Slider and Visual Composer plugins to their latest versions<br><br></li>
<li><strong>Version 1.5.4 : 25 April 2015</strong>
<br>~ Improved theme security
<br>~ Fixed broken cart page in WooCommerce 2.3.8<br><br></li>
<li><strong>Version 1.5.3 : 22 April 2015</strong>
<br>~ Fixed some minor styling issues<br><br></li>
<li><strong>Version 1.5.2 : 11 March 2015</strong>
<br>~ Added categories support in the shop grid
<br>~ Improved portfolio layout handling
<br>~ Fixed a SEO issue within the portfolio
<br>~ Fixed more WooCommerce 2.3 issues<br><br></li>
<li><strong>Version 1.5.1 : 28 February 2015</strong>
<br>~ Fixed an issue with infinite loading on retina devices<br><br></li>
<li><strong>Version 1.5 : 27 February 2015</strong>
<br>~ Added a new blog style
<br>~ Improved WooCommerce 2.3 support
<br>~ Fixed an issue with infinite loading on retina devices<br><br></li>
<li><strong>Version 1.4.1 : 24 February 2015</strong>
<br>~ Fixed an issue with HTML code in page excerpts
<br>~ Fixed an issue with the tabs shortcode
<br>~ Improved WooCommerce 2.3 support<br><br></li>
<li><strong>Version 1.4 : 12 February 2015</strong>
<br>~ Added support for WooCommerce 2.3
<br>~ Removed default grid "checkboard" background
<br>~ Fixed an issue related to the single images shortcode
<br>~ Fixed a style issue in Windows Phones<br><br></li>
<li><strong>Version 1.3.1 : 21 January 2015</strong>
<br>~ Fixed a few styling issues<br><br></li>
<li><strong>Version 1.3 : 10 January 2015</strong>
<br>~ Added social meta tags in the header
<br>~ Added twitter feed shortcode
<br>~ Fixed some other minor bugs<br><br></li>
<li><strong>Version 1.2.3 : 20 December 2014</strong>
<br>~ Added WP 4.1 compatibility
<br>~ Fixed some bugs related to media formatting in blog posts
<br>~ Updated the Revolution Slider and Visual Composer plugins to their latest versions<br><br></li>
<li><strong>Version 1.2.2 : 1 December 2014</strong>
<br>~ Improved image scaling for the single images shortcode
<br>~ Added alt tags for the single images shortcode
<br>~ Fixed navigation styling issues in the Revolution Slider plugin
<br>~ Updated the Revolution Slider plugin to it\'s latest version<br><br></li>
<li><strong>Version 1.2.1 : 25 November 2014</strong>
<br>~ Fixed a bug with the content slider
<br>~ Fixed a bug with the images slider caused by last update
<br>~ Fixed some WooCommerce related errors
<br>~ Fixed image scaling issues
<br>~ Added changelog view in the backend<br><br></li>
<li><strong>Version 1.2 : 19 November 2014</strong>
<br>~ Added a new gallery page template	
<br>~ Added RTL support
<br>~ Added a header widget area
<br>~ Added Google Fonts subsets in the Theme Customizer
<br>~ Improved support for WPML 
<br>~ Improved retina support
<br>~ Updated the Revolution Slider plugin to it\'s latest version
<br>~ Fixed some errors related to variable products in WooCommerce
<br>~ Fixed an issue in the Visual Composer backend<br><br></li>
<li><strong>Version 1.1 : 10 November 2014</strong>
<br>~ Added support for WooCommerce
<br>~ Added a new portfolio masonry style - "simple resizing"
<br>~ Added the ability to post content on the portfolio page<br><br></li>
<li><strong>Version 1.0.4 : 6 November 2014</strong>
<br>~ Fixed a small bug related to SVG colors<br><br></li>
<li><strong>Version 1.0.3 : 5 November 2014</strong>
<br>~ Fixed a bug related to the unlimited portfolios feature
<br>~ Fixed some responsiveness issues
<br>~ Fixed another bug related to the social shortcodes<br><br></li>
<li><strong>Version 1.0.2 : 31 October 2014</strong>
<br>~ Fixed social shortcode issues
<br>~ Fixed header margin issue
<br>~ Improved IE compatibility<br><br></li>
<li><strong>Version 1.0.1 : 24 October 2014</strong>
<br>~ Fixed some minor bugs
<br>~ Added the option to disable unlimited portfolios
<br>~ Added the option for a pure HTML header in pages<br><br></li>
<li><strong>Version 1.0 : 21 October 2014</strong><br>~ First release</li>
</ul>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'log',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

      array(
        'id'          => 'krown_sidebars_text',
        'label'       => 'About the sidebars', 'krown',
        'desc'        => 'All sidebars that you create here will appear both in the Widgets Page(Appearance &gt; Widgets), from where you\'ll have to configure them(put widgets inside them), and in the custom pages(default templates), where you\'ll be able to choose a sidebar for each page', 'krown',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'sidebars',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'krown_sidebars',
        'label'       => 'Create Sidebars', 'krown',
        'desc'       => 'Please choose a unique title for each sidebar!', 'krown',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'sidebars',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'id',
            'label'       => 'ID', 'krown',
            'desc'       => 'Please write a lowercase id, with NO SPACES!!!',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),

      array(
        'id'          => 'krown_tracking',
        'label'       => 'Analytics code',
        'desc'        => 'Put your Analytics code inside here. Make sure you include the entire script, not just your ID.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'analytics',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),

      
      array(
        'id'          => 'krown_meta_enable',
        'label'       => 'Enable social meta tags',
        'desc'        => 'Please select this if you want the theme to output some social meta tags into the header. If you\'re already using a SEO or social plugin which does this, you should disable the function to make sure that you don\'t have any conflicts.',
        'std'         => 'enabled',
        'type'        => 'radio',
        'section'     => 'analytics',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => 'Enabled',
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => 'Disabled',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'krown_custom_css',
        'label'       => 'Custom CSS',
        'desc'        => 'Write any custom css here. Please don\'t change theme files, because you won\'t be able to easily update in the future.',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'css',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'krown_custom_login_logo_uri',
        'label'       => 'Admin logo',
        'desc'        => 'Add a custom <strong>273x63</strong> image for the WordPress login page.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'admin',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'krown_updates_about',
        'label'       => 'About',
        'desc'        => 'These two fields are required for the theme automatic updates. If you want to protect yourself against security attacks and have the latest features available as soon as they appear, you should complete this section, and you\'ll be notified about new theme updates whenever they appear on ThemeForest.',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'updates',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'krown_updates_user',
        'label'       => 'Username',
        'desc'        => 'Please insert your ThemeForest username.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'updates',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'krown_updates_api',
        'label'       => 'API Key',
        'desc'        => 'Please insert your <a target="_blank" href="http://themeforest.net/help/api">ThemeForest API key</a>.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'updates',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
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

?>