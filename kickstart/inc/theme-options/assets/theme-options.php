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
        'id'          => 'general_default',
        'title'       => 'General options'
      ),
      array(
        'id'          => 'header_area_heading',
        'title'       => 'Header options'
      ),
      array(
        'id'          => 'background_options',
        'title'       => 'Background options'
      ),
      array(
        'id'          => 'styling_options',
        'title'       => 'Styling options'
      ),
      array(
        'id'          => 'typography_heading',
        'title'       => 'Typography'
      ),
      array(
        'id'          => 'footer_slidingsidebar',
        'title'       => 'Footer options'
      ),
      array(
        'id'          => 'sliders',
        'title'       => 'Orbit slider'
      ),
      array(
        'id'          => 'blog_general_options',
        'title'       => 'Blog options'
      ),
      array(
        'id'          => 'woocommerce',
        'title'       => 'WooCommerce'
      ),
      array(
        'id'          => 'css',
        'title'       => 'Custom CSS'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'theme_layout',
        'label'       => 'Layout',
        'desc'        => 'This setting will apply selected layout to your website. Click on image and Save Changes.',
        'std'         => 'full-width',
        'type'        => 'radio-image',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'general_color',
        'label'       => 'Primary theme color',
        'desc'        => 'This will be general color scheme for your website. Click input field for colorpicker.',
        'std'         => '#F86B35',
        'type'        => 'colorpicker',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'page_comments',
        'label'       => 'Allow comments on pages',
        'desc'        => 'This settings will allow comments on pages. By default comments are allowed in posts only.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enable_commnets_on_regular_pages',
            'label'       => 'Enable comments on regular pages',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'responsive_layout',
        'label'       => 'Responsive layout',
        'desc'        => 'Choose responsiveness mode for your website.',
        'std'         => 'responsive_all',
        'type'        => 'radio',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'responsive_mobile',
            'label'       => 'Responsive layout only for smartphones',
            'src'         => ''
          ),
          array(
            'value'       => 'responsive_all',
            'label'       => 'Responsive layout for smartphones and tablets',
            'src'         => ''
          ),
          array(
            'value'       => 'responsive_none',
            'label'       => 'Don\'t use responsive layout',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'mobile-menu-simple',
        'label'       => 'Responsive layout menu style',
        'desc'        => 'Check if you want to use drop-down list instead of default mobile menu',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'drop-down-menu',
            'label'       => 'Use drop-down list menu for responsive layout',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'analytics_code',
        'label'       => 'Analytics code',
        'desc'        => 'Paste your Google Analytics or other tracking code in text area.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general_default',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'favicon',
        'label'       => 'Custom favicon',
        'desc'        => 'Add custom favicon (16px x 16px)',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'iphone_icon',
        'label'       => 'Apple iPhone icon',
        'desc'        => 'Icon for Apple iPhone (57px x 57px). This icon is used for Bookmark on Home screen.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'iphone_retina_icon',
        'label'       => 'Apple iPhone retina icon',
        'desc'        => 'Icon for Apple iPhone retina (114px x114px). This icon is used for Bookmark on Home screen.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'ipad_icon',
        'label'       => 'Apple iPad icon',
        'desc'        => 'Icon for Apple iPad (72px x 72px). This icon is used for Bookmark on Home screen.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'ipad_retina_icon',
        'label'       => 'Apple iPad retina icon',
        'desc'        => 'Icon for Apple iPad retina (144px x 144px). This icon is used for Bookmark on Home screen.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'login_logo',
        'label'       => 'Custom WP admin login logo',
        'desc'        => 'Upload a custom logo for Wordpress login page.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'horizontal_menu_height',
        'label'       => 'Header height',
        'desc'        => 'Height of the header area (before menu). Example: 70px',
        'std'         => '70px',
        'type'        => 'text',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'menu_margin_bottom',
        'label'       => 'Menu margin from bottom',
        'desc'        => 'Move your menu vertically with this option. Remember to add px value after the number. For example: 25px',
        'std'         => '25px',
        'type'        => 'text',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_widget_area_top',
        'label'       => '"Header sidebar" margin from top',
        'desc'        => 'Move your sidebar vertically with this option. Remember to add px value after the number. For example: 25px',
        'std'         => '10px',
        'type'        => 'text',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_shadow',
        'label'       => 'Header shadow',
        'desc'        => 'Disables header shadow for whole website.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'disable_header_shadow',
            'label'       => 'Disable header shadow',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'header_search',
        'label'       => 'Header search (after menu)',
        'desc'        => 'Disables search from menu.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'disable_header_search',
            'label'       => 'Disable header search',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'disable_breadcrumbs',
        'label'       => 'Breadcrumbs',
        'desc'        => 'Disables breadcrumbs from page title area.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'disable breadcrumbs',
            'label'       => 'Disable breadcrumbs',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'top_bar_title',
        'label'       => 'Top bar',
        'desc'        => '<h1>Top bar</h1>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'top_bar',
        'label'       => 'Show top bar?',
        'desc'        => 'This option enables top bar above the menu header. If it is activated, new widget areas appear in Appearance/Widgets - \'Top Bar Sidebar Left\' and \'Top Bar Sidebar Right\'.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enable_top_bar',
            'label'       => 'Enable top bar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'top_bar_background_color',
        'label'       => 'Top bar background color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#E9E9E9',
        'type'        => 'colorpicker',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'top_bar_text_color',
        'label'       => 'Top bar text color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#8B8B8B',
        'type'        => 'colorpicker',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'logo_options_title',
        'label'       => 'Logo options title',
        'desc'        => '<h1>Logo options</h1>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'logo_upload',
        'label'       => 'Logo upload',
        'desc'        => 'Click Upload button to insert the image. Make sure to press File URL in link field before pressing Send to OptionTree. You may also directly paste background image url into the input field.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'retina_logo_upload',
        'label'       => 'Retina logo upload',
        'desc'        => 'Retina logo should be 2x the size of default logo keeping the aspect ratio!',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'retina_logo_width',
        'label'       => 'Standart logo width (fill only, if retina logo is present)',
        'desc'        => 'Enter your standard (NOT RETINA) logo width.<br /> Remember to add px value in the end. Example: 100px',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'retina_logo_height',
        'label'       => 'Standart logo height (fill only, if retina logo is present)',
        'desc'        => 'Enter your standard (NOT RETINA) logo height.<br /> Remember to add px value in the end. Example: 30px',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'logo_margin_left',
        'label'       => 'Logo margin left',
        'desc'        => 'Logo margin from left. Remember to add px value after the number. Example: 10px or -10px',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'logo_margin_bottom',
        'label'       => 'Logo margin bottom',
        'desc'        => 'Logo margin from bottom. Remember to add px value after the number. Example: 10px or -10px',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header_area_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_background',
        'label'       => 'Header background',
        'desc'        => 'This option is for header area background. You can either use color or upload a background image. Leave blank for default setting.',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'title_background',
        'label'       => 'Title area background',
        'desc'        => 'This option is for title area background. You can either use color or upload a background image. Leave blank for default setting.',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'title_area_background_size',
        'label'       => 'Title area background type',
        'desc'        => 'Scale image option keeps fixed image width at 100%. Use it for single non-repeated images with fixed position. (Image aspect ratio should be 3:2 or wider &amp; image should be at least 250px in height.)',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'auto',
            'label'       => 'Default',
            'src'         => ''
          ),
          array(
            'value'       => 'contain',
            'label'       => 'Scale image',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'page_title_background',
        'label'       => 'Page title text background',
        'desc'        => 'Enable or disable background for page title.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => 'No',
            'src'         => ''
          ),
          array(
            'value'       => 'rgba(0,0,0,0.3)',
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'page_title_shadow',
        'label'       => 'Page title text shadow',
        'desc'        => 'Enable or disable text shadow for page title.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => 'No',
            'src'         => ''
          ),
          array(
            'value'       => '0px 2px 5px rgba(0, 0, 0, 0.2)',
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'title_area_border',
        'label'       => 'Title area border color',
        'desc'        => 'Title area bottom border color
<br />
Click input field for colorpicker or enter your custom value',
        'std'         => '#EBEBEB',
        'type'        => 'colorpicker',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'title_1000',
        'label'       => 'Options below only work in boxed layouts',
        'desc'        => '<h1>Options below only work in boxed layouts (Change in general options)</h1>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'body_background',
        'label'       => 'Body background',
        'desc'        => 'Choose custom background color or image for your theme here. Leave blank for default setting.

If you want image background to cover the screen - upload your image and enable full screen option below.',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'cover_background',
        'label'       => 'Full Page Background Image',
        'desc'        => 'Scale background width &amp; height according to the browser size to covers the entire browser window at all times.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'set_cover_background',
            'label'       => 'Enable 100% background cover',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'use_background_pattern',
        'label'       => 'Background pattern?',
        'desc'        => 'This option must be enabled to use one of the patterns below.  Make sure Full Screen option above is disabled.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'use_predefined_background_pattern',
            'label'       => 'Use predefined background pattern',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'background_pattern',
        'label'       => 'Select a background pattern',
        'desc'        => 'To use predefined pattern select "Use background pattern" option above!To use predefined pattern select',
        'std'         => 'pattern_26',
        'type'        => 'radio-image',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'page_title_color',
        'label'       => 'Page title text color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#333333',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'heading_color',
        'label'       => 'Heading text color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#444444',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_text_color',
        'label'       => 'Body text color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#727272',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'link_color',
        'label'       => 'Link color',
        'desc'        => 'Link color for inline content links and sidebars.
<br />
Click input field for colorpicker or enter your custom value',
        'std'         => '#343434',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'breadcrumb_color',
        'label'       => 'Breadcrumb text color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_title_color',
        'label'       => 'Footer heading color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#EAEAEA',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_content_text_color',
        'label'       => 'Footer text color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#9C9C9C',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_link_color',
        'label'       => 'Footer link color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#BCBCBC',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_bg_color',
        'label'       => 'Footer background color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#373839',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'copyright_bg_color',
        'label'       => 'Copyright area background color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#282A2B',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'menu_color_text_block',
        'label'       => 'Menu colors',
        'desc'        => '<h1>Menu colors</h1>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'menu_opt_link_color',
        'label'       => 'Menu link color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#292929',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'menu_bottom_border',
        'label'       => 'Menu bottom border color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#e7e7e7',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'submenu_bg_color',
        'label'       => 'Submenu background color (Sub-levels)',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#313131',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'submenu_link_color',
        'label'       => 'Submenu link color',
        'desc'        => 'Click input field for colorpicker or enter your custom value',
        'std'         => '#bfbfbf',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'google_menu_font',
        'label'       => 'Menu font',
        'desc'        => 'Font used in theme preview: Source Sans Pro',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => 'hide-color-field'
      ),
      array(
        'id'          => 'font_preview_1',
        'label'       => 'Menu font preview',
        'desc'        => 'Only font-family preview! (font-weight, letter-spacing, text-transform doesn\'t affect this preview)',
        'std'         => 'Grumpy wizards make toxic brew for the evil Queen and Jack.',
        'type'        => 'textarea-simple',
        'section'     => 'typography_heading',
        'rows'        => '1',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => 'menu_font_preview'
      ),
      array(
        'id'          => 'google_page_font',
        'label'       => 'Page title font',
        'desc'        => 'Font used in theme preview: Open Sans',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'page_title_font_preview',
        'label'       => 'Page title font preview',
        'desc'        => 'Only font-family preview! (font-weight, letter-spacing, text-transform doesn\'t affect this preview)',
        'std'         => 'Grumpy wizards make toxic brew for the evil Queen and Jack.',
        'type'        => 'textarea-simple',
        'section'     => 'typography_heading',
        'rows'        => '1',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => 'title_preview'
      ),
      array(
        'id'          => 'google_fonts_headings',
        'label'       => 'Content heading font',
        'desc'        => 'Font used in theme preview: Open Sans',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_heading_font_preview',
        'label'       => 'Content heading font preview',
        'desc'        => 'Only font-family preview! (font-weight, letter-spacing, text-transform doesn\'t affect this preview)',
        'std'         => 'Grumpy wizards make toxic brew for the evil Queen and Jack.',
        'type'        => 'textarea-simple',
        'section'     => 'typography_heading',
        'rows'        => '1',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => 'heading_preview'
      ),
      array(
        'id'          => 'widget_font_family',
        'label'       => 'Widget title font',
        'desc'        => 'Font used in theme preview: Open Sans',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'widget_title_font_preview',
        'label'       => 'Widget title font preview',
        'desc'        => 'Only font-family preview! (font-weight, letter-spacing, text-transform doesn\'t affect this preview)',
        'std'         => 'Grumpy wizards make toxic brew for the evil Queen and Jack.',
        'type'        => 'textarea-simple',
        'section'     => 'typography_heading',
        'rows'        => '1',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => 'widget_preview'
      ),
      array(
        'id'          => 'google_body_font',
        'label'       => 'Content font',
        'desc'        => 'Font used in theme preview: PT Sans',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'body_font_preview',
        'label'       => 'Content font preview',
        'desc'        => 'Only font-family preview! (font-weight, letter-spacing, text-transform doesn\'t affect this preview)',
        'std'         => 'Grumpy wizards make toxic brew for the evil Queen and Jack.',
        'type'        => 'textarea-simple',
        'section'     => 'typography_heading',
        'rows'        => '1',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => 'content_preview'
      ),
      array(
        'id'          => 'google_custom_font',
        'label'       => 'Custom font for element',
        'desc'        => 'Font used in theme preview: Montserrat <br />
To use custom font add CSS class - "custom-font" ( class="custom-font" ) to an element.',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_font_preview',
        'label'       => 'Custom font for element preview',
        'desc'        => 'Only font-family preview! (font-weight, letter-spacing, text-transform doesn\'t affect this preview)',
        'std'         => 'Grumpy wizards make toxic brew for the evil Queen and Jack.',
        'type'        => 'textarea-simple',
        'section'     => 'typography_heading',
        'rows'        => '1',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => 'custom_font_preview'
      ),
      array(
        'id'          => 'font_sizes',
        'label'       => 'Font sizes',
        'desc'        => '<h1>Change font sizes</h1>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'menu_font_size',
        'label'       => 'Menu font size',
        'desc'        => 'Remember to add "px" at the end. Example: 15px 
<br /> Leave blank for default value.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_text_font_size',
        'label'       => 'Body font size',
        'desc'        => 'Remember to add "px" at the end. Example: 15px 
<br /> Leave blank for default value.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h1_size',
        'label'       => 'H1 font size',
        'desc'        => 'Remember to add "px" at the end. Example: 15px 
<br /> Leave blank for default value. Defaut value: 30px',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h2_size',
        'label'       => 'H2 font size',
        'desc'        => 'Remember to add "px" at the end. Example: 15px 
<br /> Leave blank for default value. Defaut value: 24px',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h3_size',
        'label'       => 'H3 font size',
        'desc'        => 'Remember to add "px" at the end. Example: 15px 
<br /> Leave blank for default value. Defaut value: 20px',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h4_size',
        'label'       => 'H4 font size',
        'desc'        => 'Remember to add "px" at the end. Example: 15px 
<br /> Leave blank for default value. Defaut value: 18px',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h5_size',
        'label'       => 'H5 font size',
        'desc'        => 'Remember to add "px" at the end. Example: 15px 
<br /> Leave blank for default value. Defaut value: 16px',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h6_size',
        'label'       => 'H6 font size',
        'desc'        => 'Remember to add "px" at the end. Example: 15px 
<br /> Leave blank for default value. Defaut value: 14px',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography_heading',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'copyright_bar',
        'label'       => 'Copyright bar',
        'desc'        => 'This will disable copyright bar below the footer.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'footer_slidingsidebar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'disable_copyright_bar',
            'label'       => 'Disable copyright bar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'copyright_area_text',
        'label'       => 'Copyright area text',
        'desc'        => 'This text will appear on the bottom left of your website.',
        'std'         => '© 2013 All Rights Reserved. Theme by <a href="http://themeforest.net/user/MNKY"> MNKY Studio.</a>',
        'type'        => 'textarea-simple',
        'section'     => 'footer_slidingsidebar',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_widgets',
        'label'       => 'Footer widgets',
        'desc'        => 'This setting will disable footer.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'footer_slidingsidebar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'disable_footer_widgets',
            'label'       => 'Disable  footer widgets',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'footer_columns',
        'label'       => 'Number of footer columns',
        'desc'        => 'Choose footer column count.',
        'std'         => '4',
        'type'        => 'select',
        'section'     => 'footer_slidingsidebar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '4',
            'label'       => '4',
            'src'         => ''
          ),
          array(
            'value'       => '3',
            'label'       => '3',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => '2',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => '1',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'orbit_slides',
        'label'       => 'Add slides',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'sliders',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'orbit_image',
            'label'       => 'Image',
            'desc'        => 'Upload image for the slide here.',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'orbit_link',
            'label'       => 'Link',
            'desc'        => 'This is optional. Add URL, where you want slide to lead to on click event.',
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
        'id'          => 'orbit_slider_opt',
        'label'       => 'Orbit slider options',
        'desc'        => '<h1>Slider options</h1>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'sliders',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'orbit_height',
        'label'       => 'Height',
        'desc'        => 'Note: add "px" at the end. Example: 300px',
        'std'         => '390px',
        'type'        => 'text',
        'section'     => 'sliders',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'animation',
        'label'       => 'Animation',
        'desc'        => 'Choose slide transition style.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'sliders',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'fade',
            'label'       => 'fade',
            'src'         => ''
          ),
          array(
            'value'       => 'horizontal-slide',
            'label'       => 'horizontal-slide',
            'src'         => ''
          ),
          array(
            'value'       => 'vertical-slide',
            'label'       => 'vertical-slide',
            'src'         => ''
          ),
          array(
            'value'       => 'horizontal-push',
            'label'       => 'horizontal-push',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'advancespeed',
        'label'       => 'Slide delay',
        'desc'        => 'Delay between slides (milliseconds). Default value: 4000',
        'std'         => '4000',
        'type'        => 'text',
        'section'     => 'sliders',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'animationspeed',
        'label'       => 'Animation speed',
        'desc'        => 'Choose how fast will transitions happen. (milliseconds). Default value is applied: 600',
        'std'         => '600',
        'type'        => 'text',
        'section'     => 'sliders',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'pauseonhover',
        'label'       => 'Pause on hover',
        'desc'        => 'If this option is enabled slider will pause on mouse over. Default value:false',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'sliders',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'true',
            'src'         => ''
          ),
          array(
            'value'       => 'false',
            'label'       => 'false',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'directionalnav',
        'label'       => 'Navigation arrows',
        'desc'        => 'Enable or disable navigation arrows.
Default value: True',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'sliders',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'true',
            'src'         => ''
          ),
          array(
            'value'       => 'false',
            'label'       => 'false',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'bullets',
        'label'       => 'Bullets',
        'desc'        => 'Enable or disable bullet navigation. 
Default: True',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'sliders',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'true',
            'src'         => ''
          ),
          array(
            'value'       => 'false',
            'label'       => 'false',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'select_blog_header',
        'label'       => 'Select Blog Header Element',
        'desc'        => 'Choose header element for your blog page.',
        'std'         => 'none',
        'type'        => 'radio',
        'section'     => 'blog_general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'orbit-slider',
            'label'       => 'Orbit slider',
            'src'         => ''
          ),
          array(
            'value'       => 'custom-element',
            'label'       => 'Custom Header Element',
            'src'         => ''
          ),
          array(
            'value'       => 'custom-element-full',
            'label'       => 'Custom Header Element (Full width)',
            'src'         => ''
          ),
          array(
            'value'       => 'none',
            'label'       => 'None',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_header_html',
        'label'       => 'Custom header element HTML',
        'desc'        => 'Enter the content you want to display when Custom Header Element is selected (HTML is allowed).',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'blog_general_options',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'exclude_categories_from_blog',
        'label'       => 'Exclude categories from blog page',
        'desc'        => 'Select categories you want to exclude from blog page',
        'std'         => '',
        'type'        => 'category-checkbox',
        'section'     => 'blog_general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'blog_full_width',
        'label'       => 'Full width blog',
        'desc'        => 'Disables sidebar fot the blog page.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'blog_general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'full_width_blog',
            'label'       => 'Enable full width for blog',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_layout_style',
        'label'       => 'Blog layout style',
        'desc'        => 'Choose your blog layout style. Medium - for small left aligned featured image. Large - for full image.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog_general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'large_blog',
            'label'       => 'Large',
            'src'         => ''
          ),
          array(
            'value'       => 'medium_blog',
            'label'       => 'Medium',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_sidebar_position',
        'label'       => 'Blog sidebar position',
        'desc'        => 'Choose between left and right sidebars.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog_general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => 'Right',
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => 'Left',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_content_type',
        'label'       => 'Full content or excerpt',
        'desc'        => 'Show excerpt or full post content on blog pages.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog_general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'excerpt',
            'label'       => 'Excerpt',
            'src'         => ''
          ),
          array(
            'value'       => 'full_content',
            'label'       => 'Full content',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_excerpt_lenght',
        'label'       => 'Excerpt lenght',
        'desc'        => 'Input the number of words you want to take from content to make excerpt.',
        'std'         => '82',
        'type'        => 'text',
        'section'     => 'blog_general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hide_author_box',
        'label'       => 'Author info',
        'desc'        => 'Show or hide auhor information under the single post.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'blog_general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'hide_author_info',
            'label'       => 'Hide author info box',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hide_meta',
        'label'       => 'Check items you to hide from meta',
        'desc'        => 'Check items you want to hide from blog/post meta field.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'blog_general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'date',
            'label'       => 'date',
            'src'         => ''
          ),
          array(
            'value'       => 'author',
            'label'       => 'author',
            'src'         => ''
          ),
          array(
            'value'       => 'category',
            'label'       => 'category',
            'src'         => ''
          ),
          array(
            'value'       => 'comments',
            'label'       => 'comments',
            'src'         => ''
          ),
          array(
            'value'       => 'tags',
            'label'       => 'tags',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'woo_layout',
        'label'       => 'Layout style',
        'desc'        => 'Choose layout style for main product catalog page.',
        'std'         => 'content_left',
        'type'        => 'select',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'content_left',
            'label'       => 'Right sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'content_right',
            'label'       => 'Left sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'content_full',
            'label'       => 'Full width',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'woo_columns',
        'label'       => 'Product column count',
        'desc'        => 'Choose column count for main product catalog page.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '3',
            'label'       => '3 columns',
            'src'         => ''
          ),
          array(
            'value'       => '4',
            'label'       => '4 columns',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'woo_product_count',
        'label'       => 'Products per page',
        'desc'        => 'Choose how many products to display on product catalog page.',
        'std'         => '9',
        'type'        => 'text',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_css',
        'label'       => 'Custom CSS',
        'desc'        => 'Add any of your custom CSS here.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'css',
        'rows'        => '20',
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