<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
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
        'title'       => __( 'General', 'mega' )
      ),
      array(
        'id'          => 'typography',
        'title'       => __( 'Typography', 'mega' )
      ),
      array(
        'id'          => 'header',
        'title'       => __( 'Header', 'mega' )
      ),
      array(
        'id'          => 'footer',
        'title'       => __( 'Footer', 'mega' )
      ),
      array(
        'id'          => 'blog_settings',
        'title'       => __( 'Blog Settings', 'mega' )
      ),
      array(
        'id'          => 'portfolio_settings',
        'title'       => __( 'Portfolio Settings', 'mega' )
      ),
      array(
        'id'          => 'social',
        'title'       => __( 'Social Accounts', 'mega' )
      ),
      array(
        'id'          => 'woocommerce',
        'title'       => __( 'WooCommerce', 'mega' )
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'logo',
        'label'       => __( 'Logo', 'mega' ),
        'desc'        => __( 'Upload a logo for your site.', 'mega' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_light',
        'label'       => __( 'Logo Light', 'mega' ),
        'desc'        => __( 'Upload a light logo for your site.', 'mega' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_retina',
        'label'       => __( 'Logo (Retina Version @2x)', 'mega' ),
        'desc'        => __( 'Upload Retina-Ready (HiDPI) logo for your site.', 'mega' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_retina_light',
        'label'       => __( 'Logo Light (Retina Version @2x)', 'mega' ),
        'desc'        => __( 'Upload Retina-Ready (HiDPI) light logo for your site.', 'mega' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_retina_width',
        'label'       => __( 'Width for Retina-Ready (HiDPI) Logo', 'mega' ),
        'desc'        => __( 'Enter the standard logo (1x) version width, do not enter the Retina-Ready (HiDPI) logo width.', 'mega' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_retina_height',
        'label'       => __( 'Height for Retina-Ready (HiDPI) Logo', 'mega' ),
        'desc'        => __( 'Enter the standard logo (1x) version height, do not enter the Retina-Ready (HiDPI) logo height.', 'mega' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'favicon',
        'label'       => __( 'Favicon', 'mega' ),
        'desc'        => __( 'Upload a favicon for your site.', 'mega' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'primary_color',
        'label'       => __( 'Primary Color', 'mega' ),
        'desc'        => __( 'Choose a primary color for your site. Default value is #96e0e9.', 'mega' ),
        'std'         => '#96e0e9',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'background_overlay_color_for_heading',
        'label'       => __( 'Background Overlay Color for Heading', 'mega' ),
        'desc'        => __( 'Choose a background overlay color for heading for your site. Default value is #ffffff.', 'mega' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'background_overlay_opacity_for_heading',
        'label'       => __( 'Background Overlay Opacity for Heading', 'mega' ),
        'desc'        => __( 'Enter a value from .1 to 1 for background overlay opacity for heading. Default value is .1.', 'mega' ),
        'std'         => '.1',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'color_for_heading',
        'label'       => __( 'Color for Heading', 'mega' ),
        'desc'        => __( 'Choose a color for heading for your site. Default value is #111111.', 'mega' ),
        'std'         => '#111111',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_full_width_for_header_and_footer',
        'label'       => __( 'Enable Full Width for Header and Footer?', 'mega' ),
        'desc'        => __( 'Enable full width for header and footer?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Full Width for Header and Footer?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'disable_right_click',
        'label'       => __( 'Disable Right Click for images?', 'mega' ),
        'desc'        => __( 'Disables right click for images', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Disable Right Click?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'primary_typography',
        'label'       => __( 'Primary Typography', 'mega' ),
        'desc'        => __( 'The Primary Typography option type is for adding typographic styles to your site. The most important one though is Google Fonts to create custom font stacks.', 'mega' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'google_font_family',
        'label'       => __( 'Google Web Font Code for Primary Typography', 'mega' ),
        'desc'        => __( '<p class="warning">Paste Google Web Font link to your website.</p><p><b>Read more:</b> <a href="http://www.google.com/webfonts" target="_blank"><code>http://www.google.com/webfonts</code></a></p>', 'mega' ),
        'std'         => '<link href=\'http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300\' rel=\'stylesheet\' type=\'text/css\'>',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'google_font_name',
        'label'       => __( 'Google Web Font Name for Primary Typography', 'mega' ),
        'desc'        => __( 'Enter the Google Web Font name for primary typography.', 'mega' ),
        'std'         => 'Roboto Condensed',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_typography',
        'label'       => __( 'Menu Typography', 'mega' ),
        'desc'        => __( 'The Menu Typography option type is for adding typographic styles for menu to your site. The most important one though is Google Fonts to create custom font stacks.', 'mega' ),
        'std'         => 'Roboto Condensed',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_google_font_family',
        'label'       => __( 'Google Web Font Code for Menu Typography', 'mega' ),
        'desc'        => __( '<p class="warning">Paste Google Web Font link for menu to your website.</p><p><b>Read more:</b> <a href="http://www.google.com/webfonts" target="_blank"><code>http://www.google.com/webfonts</code></a></p>', 'mega' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_google_font_name',
        'label'       => __( 'Google Web Font Name for Menu Typography', 'mega' ),
        'desc'        => __( 'Enter the Google Web Font name for menu typography.', 'mega' ),
        'std'         => 'Roboto Condensed',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_font_size',
        'label'       => __( 'Menu Font Size', 'mega' ),
        'desc'        => __( 'Choose a value for menu font size in pixels. Default value is 13.', 'mega' ),
        'std'         => '13',
        'type'        => 'numeric-slider',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_typography',
        'label'       => __( 'Header Typography', 'mega' ),
        'desc'        => __( 'The Header Typography option type is for adding typographic styles for headers to your site. The most important one though is Google Fonts to create custom font stacks.', 'mega' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_google_font_family',
        'label'       => __( 'Google Web Font Code for Header Typography', 'mega' ),
        'desc'        => __( '<p class="warning">Paste Google Web Font link for headings to your website.</p><p><b>Read more:</b> <a href="http://www.google.com/webfonts" target="_blank"><code>http://www.google.com/webfonts</code></a></p>', 'mega' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_google_font_name',
        'label'       => __( 'Google Web Font Name for Header Typography', 'mega' ),
        'desc'        => __( 'Enter the Google Web Font name for header typography.', 'mega' ),
        'std'         => 'Roboto Condensed',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'left_menu',
        'label'       => __( 'Enable Left Menu?', 'mega' ),
        'desc'        => __( 'Enable Left Menu?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Left Menu?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'header_style',
        'label'       => __( 'Header Style', 'mega' ),
        'desc'        => __( 'Choose a style for header of your site.', 'mega' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'fixed',
            'label'       => __( 'Fixed', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'non_fixed',
            'label'       => __( 'Non-Fixed', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'remove_header_height_reduction',
        'label'       => __( 'Remove header height reduction on scrolling?', 'mega' ),
        'desc'        => __( 'Remove header height reduction on scrolling? Note: Fixed Header Style must be enabled.', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Remove header height reduction on scrolling?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'search_header_position',
        'label'       => __( 'Search Position', 'mega' ),
        'desc'        => __( 'Choose a search position for header of your site.', 'mega' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => __( 'None', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'top_bar',
            'label'       => __( 'Top Bar', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'header',
            'label'       => __( 'Header', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'search_icon_margin',
        'label'       => __( 'Search Icon and Social Icons Margin', 'mega' ),
        'desc'        => __( 'Choose a value for search icon and social icons margin in pixels. Default margin is 28.', 'mega' ),
        'std'         => '28',
        'type'        => 'numeric-slider',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_margin',
        'label'       => __( 'Logo Margin', 'mega' ),
        'desc'        => __( 'Choose a value for logo margin in pixels. Default width is 23.', 'mega' ),
        'std'         => '23',
        'type'        => 'numeric-slider',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'social_icons_position',
        'label'       => __( 'Social Icons Position', 'mega' ),
        'desc'        => __( 'Choose a social icons position for header of your site.', 'mega' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => __( 'None', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'top_bar',
            'label'       => __( 'Top Bar', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'header',
            'label'       => __( 'Header', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'header_info',
        'label'       => __( 'Header Info', 'mega' ),
        'desc'        => __( 'Enter the info you would like to display in header of your site.', 'mega' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'woocommerce_cart_position',
        'label'       => __( 'WooCommerce Cart Position', 'mega' ),
        'desc'        => __( 'Choose a WooCommerce cart position for header of your site.', 'mega' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => __( 'None', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'top_bar',
            'label'       => __( 'Top Bar', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'header',
            'label'       => __( 'Header', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'enable_wpml_language_switcher',
        'label'       => __( 'Enable WPML Language switcher', 'mega' ),
        'desc'        => __( 'Enable WPML Language switcher. Note: WPML (<a href="http://wpml.org/" target="_blank">http://wpml.org/</a>) plugin must be installed.', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable WPML Language switcher', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'header_background_color',
        'label'       => __( 'Header Background Color', 'mega' ),
        'desc'        => __( 'Choose a value for header background color. Default value is #ffffff.', 'mega' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'navigation_link_color',
        'label'       => __( 'Navigation Link Color', 'mega' ),
        'desc'        => __( 'Choose a value for navigation link color. Default value is #111111.', 'mega' ),
        'std'         => '#111111',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'navigation_link_color_hover',
        'label'       => __( 'Navigation Link Color - Hover/Active', 'mega' ),
        'desc'        => __( 'Choose a value for navigation link color - hover/active. Default value is #96e0e9.', 'mega' ),
        'std'         => '#96e0e9',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_text_color',
        'label'       => __( 'Header Text Color', 'mega' ),
        'desc'        => __( 'Choose a value for header text color. Default value is #777777.', 'mega' ),
        'std'         => '#777777',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'border_between_top_bar_and_header_color',
        'label'       => __( 'Border Between Top Bar and Header Color', 'mega' ),
        'desc'        => __( 'Choose a value for border between Top Bar and header color. Default value is #ffffff.', 'mega' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_top_border_width',
        'label'       => __( 'Header Top Border Width', 'mega' ),
        'desc'        => __( 'Choose a value for header top border width in pixels. Default width is 1.', 'mega' ),
        'std'         => '1',
        'type'        => 'numeric-slider',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_bottom_border_color',
        'label'       => __( 'Header Bottom Border Color', 'mega' ),
        'desc'        => __( 'Choose a value for header bottom border color. Default value is #ffffff.', 'mega' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_position',
        'label'       => __( 'Menu Position', 'mega' ),
        'desc'        => __( 'Choose a menu position for header of your site.', 'mega' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => __( 'Right', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'center',
            'label'       => __( 'Center', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'menu_text_transform',
        'label'       => __( 'Menu Text Transform', 'mega' ),
        'desc'        => __( 'Choose a menu text transform for header of your site.', 'mega' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'uppercase',
            'label'       => __( 'Uppercase', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'none',
            'label'       => __( 'None', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'center_logo_and_menu',
        'label'       => __( 'Center Logo and Menu?', 'mega' ),
        'desc'        => __( 'Center logo and menu?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Center Logo and Menu?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'enable_borders_top_and_bottom_for_menu',
        'label'       => __( 'Enable Borders Top and Bottom for Menu?', 'mega' ),
        'desc'        => __( 'Enable borders top and bottom for menu?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Borders Top and Bottom for Menu?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'borders_top_and_bottom_for_menu_color',
        'label'       => __( 'Borders Top and Bottom for Menu Color', 'mega' ),
        'desc'        => __( 'Choose a value for borders top and bottom for menu color. Default value is #f5f5f5.', 'mega' ),
        'std'         => '#f5f5f5',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_top_bar',
        'label'       => __( 'Enable Top Bar', 'mega' ),
        'desc'        => __( 'Enable top bar or not?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Top Bar', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'top_bar_info',
        'label'       => __( 'Top Bar Info', 'mega' ),
        'desc'        => __( 'Enter the info you would like to display in top bar of your site.', 'mega' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_bar_background_color',
        'label'       => __( 'Top Bar Background Color', 'mega' ),
        'desc'        => __( 'Choose a value for top bar background color. Default value is #ffffff.', 'mega' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_bar_text_color',
        'label'       => __( 'Top Bar Text Color', 'mega' ),
        'desc'        => __( 'Choose a value for top bar text color. Default value is #777777.', 'mega' ),
        'std'         => '#777777',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_bar_link_color',
        'label'       => __( 'Top Bar Link Color', 'mega' ),
        'desc'        => __( 'Choose a value for top bar link color. Default value is #96e0e9.', 'mega' ),
        'std'         => '#96e0e9',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_bar_link_color_hover',
        'label'       => __( 'Top Bar Link Color - Hover/Active', 'mega' ),
        'desc'        => __( 'Choose a value for top bar link color - hover/active. Default value is #111111.', 'mega' ),
        'std'         => '#111111',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_bar_social_icons_color',
        'label'       => __( 'Top Bar Social Icons Color', 'mega' ),
        'desc'        => __( 'Choose a value for social icons color. Default value is #111111.', 'mega' ),
        'std'         => '#111111',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_social_icons',
        'label'       => __( 'Enable Social Icons?', 'mega' ),
        'desc'        => __( 'Enable social icons?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable social icons?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'footer_social_icons_position',
        'label'       => __( 'Footer Social Icons Position', 'mega' ),
        'desc'        => __( 'Choose a social icons position for footer of your site.', 'mega' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => __( 'Right', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => __( 'Left', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'center',
            'label'       => __( 'Center', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'footer_info',
        'label'       => __( 'Footer Info', 'mega' ),
        'desc'        => __( 'Enter the info you would like to display in the footer of your site.', 'mega' ),
        'std'         => '© Skylab Portfolio / Photography WordPress Theme',
        'type'        => 'textarea',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'back_to_top_button',
        'label'       => __( 'Disable Back To Top Button?', 'mega' ),
        'desc'        => __( 'Disable Back To Top Button?', 'mega' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'disable',
            'label'       => __( 'Disable', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'enable',
            'label'       => __( 'Enable', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'back_to_top_button_color',
        'label'       => __( 'Back To Top Button Color', 'mega' ),
        'desc'        => __( 'Choose a value for back to top button color. Default value is #777777.', 'mega' ),
        'std'         => '#777777',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'back_to_top_button_color_hover',
        'label'       => __( 'Back To Top Button Color - Hover/Active', 'mega' ),
        'desc'        => __( 'Choose a value for back to top button color - hover/active. Default value is #96e0e9.', 'mega' ),
        'std'         => '#96e0e9',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_background_color',
        'label'       => __( 'Footer Background Color', 'mega' ),
        'desc'        => __( 'Choose a value for footer background color. Default value is #ffffff.', 'mega' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_top_border_color',
        'label'       => __( 'Footer Top Border Color', 'mega' ),
        'desc'        => __( 'Choose a value for footer top border color. Default value is #ffffff.', 'mega' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_widget_title_color',
        'label'       => __( 'Footer Widget Title Color', 'mega' ),
        'desc'        => __( 'Choose a value for footer widget title color in pixels. Default value is #111111.', 'mega' ),
        'std'         => '#111111',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_text_color',
        'label'       => __( 'Footer Text Color', 'mega' ),
        'desc'        => __( 'Choose a value for footer text color. Default value is #777777.', 'mega' ),
        'std'         => '#777777',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_link_color',
        'label'       => __( 'Footer Link Color', 'mega' ),
        'desc'        => __( 'Choose a value for footer link color. Default value is #96e0e9.', 'mega' ),
        'std'         => '#96e0e9',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_link_color_hover',
        'label'       => __( 'Footer Link Color - Hover/Active', 'mega' ),
        'desc'        => __( 'Choose a value for footer link color - hover/active. Default value is #111111.', 'mega' ),
        'std'         => '#111111',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'border_between_footer_and_footer_bottom_area_color',
        'label'       => __( 'Border Between Footer and Footer Bottom Area Color', 'mega' ),
        'desc'        => __( 'Choose a value for border between footer and footer bottom area color. Default value is #ffffff.', 'mega' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_bottom_area_background_color',
        'label'       => __( 'Footer Bottom Area Background Color', 'mega' ),
        'desc'        => __( 'Choose a value for footer bottom area background color. Default value is #ffffff.', 'mega' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_bottom_area_link_color',
        'label'       => __( 'Footer Bottom Area Link Color', 'mega' ),
        'desc'        => __( 'Choose a value for footer bottom area link color. Default value is #96e0e9.', 'mega' ),
        'std'         => '#96e0e9',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_bottom_area_link_color_hover',
        'label'       => __( 'Footer Bottom Area Link Color - Hover/Active', 'mega' ),
        'desc'        => __( 'Choose a value for footer bottom area link color - hover/active. Default value is #111111.', 'mega' ),
        'std'         => '#111111',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_bottom_area_text_color',
        'label'       => __( 'Footer Bottom Area Text Color', 'mega' ),
        'desc'        => __( 'Choose a value for footer bottom area text color. Default value is #bbbbbb.', 'mega' ),
        'std'         => '#bbbbbb',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'javascript_code',
        'label'       => __( 'JavaScript Code', 'mega' ),
        'desc'        => __( 'Paste your JavaScript code', 'mega' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_background_for_blog',
        'label'       => __( 'Header Background for Blog', 'mega' ),
        'desc'        => __( 'Upload header background for blog.', 'mega' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'blog_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'parallax_header_background_for_blog',
        'label'       => __( 'Enable Parallax for Blog Header Background?', 'mega' ),
        'desc'        => __( 'Enable Parallax for Blog Header Background?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'blog_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Parallax for Blog Header Background?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'enable_transparent_header_background_for_blog',
        'label'       => __( 'Enable Transparent Header Background for Blog?', 'mega' ),
        'desc'        => __( 'Enable transparent header background for blog?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'blog_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Transparent Header Background for Blog?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'blog_header_margin',
        'label'       => __( 'Blog Header Margin', 'mega' ),
        'desc'        => __( 'Choose a value for blog header margin in pixels. Default margin is 130.', 'mega' ),
        'std'         => '130',
        'type'        => 'numeric-slider',
        'section'     => 'blog_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,500,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'blog_title_on_single_blog_post_pages',
        'label'       => __( 'Enter Blog Title on Single Blog Post Pages', 'mega' ),
        'desc'        => __( 'Enter Blog Title on Single Blog Post Pages', 'mega' ),
        'std'         => 'Blog',
        'type'        => 'text',
        'section'     => 'blog_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'remove_sidebar_and_center_posts',
        'label'       => __( 'Remove Sidebar and Center Posts?', 'mega' ),
        'desc'        => __( 'Remove sidebar and center posts?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'blog_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Remove Sidebar and Center Posts?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'remove_single_portfolio_heading',
        'label'       => __( 'Remove Single Portfolio Heading', 'mega' ),
        'desc'        => __( 'Remove single portfolio heading?', 'mega' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'portfolio_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'disable',
            'label'       => __( 'Remove', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'enable',
            'label'       => __( 'Enable', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'enable_transparent_header_background_for_single_portfolio_pages',
        'label'       => __( 'Enable Transparent Header Background for Single Portfolio Pages?', 'mega' ),
        'desc'        => __( 'Enable transparent header background for single portfolio pages?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'portfolio_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable transparent header background for single portfolio pages?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'social_accounts',
        'label'       => __( 'Social Accounts', 'mega' ),
        'desc'        => __( '<p>Which links would you like to display?</p>', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'facebook',
            'label'       => __( 'Facebook', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'twitter',
            'label'       => __( 'Twitter', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'gplus',
            'label'       => __( 'Google Plus', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'linkedin',
            'label'       => __( 'LinkedIn', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'pinterest',
            'label'       => __( 'Pinterest', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'instagram',
            'label'       => __( 'Instagram', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'vimeo',
            'label'       => __( 'Vimeo', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'flickr',
            'label'       => __( 'Flickr', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'tumblr',
            'label'       => __( 'Tumblr', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'feed',
            'label'       => __( 'RSS', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'youtube',
            'label'       => __( 'YouTube', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'behance',
            'label'       => __( 'Behance', 'mega' ),
            'src'         => ''
          ),
          array(
            'value'       => 'dribbble',
            'label'       => __( 'Dribbble', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'facebook_url',
        'label'       => __( 'Facebook Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'http://www.facebook.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'twitter_url',
        'label'       => __( 'Twitter Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'https://twitter.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'gplus_url',
        'label'       => __( 'Google Plus Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'https://plus.google.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'linkedin_url',
        'label'       => __( 'LinkedIn Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'http://www.linkedin.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pinterest_url',
        'label'       => __( 'Pinterest Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'http://pinterest.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'instagram_url',
        'label'       => __( 'Instagram Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'http://instagram.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'vimeo_url',
        'label'       => __( 'Vimeo Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'http://vimeo.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'flickr_url',
        'label'       => __( 'Flickr Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'http://www.flickr.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tumblr_url',
        'label'       => __( 'Tumblr Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'https://www.tumblr.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'feed_url',
        'label'       => __( 'RSS Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'javascript:void(null);',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'youtube_url',
        'label'       => __( 'YouTube Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'http://www.youtube.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'behance_url',
        'label'       => __( 'Behance Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'http://www.behance.net/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'dribbble_url',
        'label'       => __( 'Dribbble Address (URL)', 'mega' ),
        'desc'        => '',
        'std'         => 'http://dribbble.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'shop_layout',
        'label'       => __( 'Shop Layout', 'mega' ),
        'desc'        => __( 'Choose a layout for shop page.', 'mega' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_background_for_shop',
        'label'       => __( 'Hader Background for Shop', 'mega' ),
        'desc'        => __( 'Upload header background for shop.', 'mega' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'parallax_header_background_for_shop',
        'label'       => __( 'Enable Parallax for Shop Header Background?', 'mega' ),
        'desc'        => __( 'Enable Parallax for Shop Header Background?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Parallax for Shop Header Background?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'enable_transparent_header_background_for_shop',
        'label'       => __( 'Enable Transparent Header Background for Shop?', 'mega' ),
        'desc'        => __( 'Enable transparent header background for shop?', 'mega' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Transparent Header Background for Shop?', 'mega' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'shop_header_margin',
        'label'       => __( 'Shop Header Margin', 'mega' ),
        'desc'        => __( 'Choose a value for shop header margin in pixels. Default margin is 130.', 'mega' ),
        'std'         => '130',
        'type'        => 'numeric-slider',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,500,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}