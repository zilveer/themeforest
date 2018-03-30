<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/REGISTER.PHP
// -----------------------------------------------------------------------------
// Sets up the options to be used in the Customizer.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Register Options
//       a. Lists
//       b. Sections
//       c. Options - Stack
//       d. Options - Integrity
//       e. Options - Renew
//       f. Options - Icon
//       g. Options - Ethos
//       h. Options - Layout and Design
//       i. Options - Typography
//       j. Options - Buttons
//       k. Options - Header
//       l. Options - Footer
//       m. Options - Blog
//       n. Options - Portfolio
//       o. Options - bbPress
//       p. Options - BuddyPress
//       q. Options - WooCommerce
//       r. Options - Social
//       s. Options - Site Icons
//       t. Options - Custom
//       u. Output - Sections
//       v. Output - Settings
//       w. Output - Controls
// =============================================================================

// Register Options
// =============================================================================

function x_customizer_options_register( $wp_customize ) {

  //
  // Defaults.
  //

  GLOBAL $customizer_settings_data;


  //
  // Lists.
  //

  $list_on_off = array(
    '1' => 'On',
    ''  => 'Off'
  );
  
  $list_overflow_options = array(
	  'overflow-scroll' => __( 'On (no submenu support)', '__x__' ),
	  'overflow-visible' => __( 'Off', '__x__' )
  );


  $list_stacks = array(
    'integrity' => __( 'Integrity', '__x__' ),
    'renew'     => __( 'Renew', '__x__' ),
    'icon'      => __( 'Icon', '__x__' ),
    'ethos'     => __( 'Ethos', '__x__' )
  );

  $list_site_layouts = array(
    'full-width' => __( 'Fullwidth', '__x__' ),
    'boxed'      => __( 'Boxed', '__x__' )
  );

  $list_content_layouts = array(
    'content-sidebar' => __( 'Content Left, Sidebar Right', '__x__' ),
    'sidebar-content' => __( 'Sidebar Left, Content Right', '__x__' ),
    'full-width'      => __( 'Fullwidth', '__x__' )
  );

  $list_section_layouts = array(
    'sidebar'    => __( 'Use Global Content Layout', '__x__' ),
    'full-width' => __( 'Fullwidth', '__x__' )
  );

  $list_integrity_designs = array(
    'light' => __( 'Light', '__x__' ),
    'dark'  => __( 'Dark', '__x__' )
  );

  $list_renew_entry_icon_positions = array(
    'standard' => __( 'Standard', '__x__' ),
    'creative' => __( 'Creative', '__x__' )
  );

  $list_ethos_post_carousel_and_slider_display = array(
    'most-commented' => __( 'Most Commented', '__x__' ),
    'random'         => __( 'Random', '__x__' ),
    'featured'       => __( 'Featured', '__x__' )
  );

  $list_button_styles = array(
    'real'        => __( '3D', '__x__' ),
    'flat'        => __( 'Flat', '__x__' ),
    'transparent' => __( 'Transparent', '__x__' )
  );

  $list_button_shapes = array(
    'square'  => __( 'Square', '__x__' ),
    'rounded' => __( 'Rounded', '__x__' ),
    'pill'    => __( 'Pill', '__x__' )
  );

  $list_button_sizes = array(
    'mini'    => __( 'Mini', '__x__' ),
    'small'   => __( 'Small', '__x__' ),
    'regular' => __( 'Regular', '__x__' ),
    'large'   => __( 'Large', '__x__' ),
    'x-large' => __( 'Extra Large', '__x__' ),
    'jumbo'   => __( 'Jumbo', '__x__' )
  );

  $list_navbar_positions = array(
    'static-top'  => __( 'Static Top', '__x__' ),
    'fixed-top'   => __( 'Fixed Top', '__x__' ),
    'fixed-left'  => __( 'Fixed Left', '__x__' ),
    'fixed-right' => __( 'Fixed Right', '__x__' )
  );

  $list_logo_navigation_layouts = array(
    'inline'  => __( 'Inline', '__x__' ),
    'stacked' => __( 'Stacked', '__x__' )
  );

  $list_widget_areas = array(
    0 => __( 'None (Disabled)', '__x__' ),
    1 => __( 'One', '__x__' ),
    2 => __( 'Two', '__x__' ),
    3 => __( 'Three', '__x__' ),
    4 => __( 'Four', '__x__' )
  );

  $list_left_right_positioning = array(
    'left'  => __( 'Left', '__x__' ),
    'right' => __( 'Right', '__x__' )
  );

  $list_blog_styles = array(
    'standard' => __( 'Standard', '__x__' ),
    'masonry'  => __( 'Masonry', '__x__' )
  );

  $list_masonry_columns = array(
    2 => __( 'Two', '__x__' ),
    3 => __( 'Three', '__x__' )
  );

  $list_shop_columns = array(
    1 => __( 'One', '__x__' ),
    2 => __( 'Two', '__x__' ),
    3 => __( 'Three', '__x__' ),
    4 => __( 'Four', '__x__' )
  );

  $list_sizing_site_max_width = array(
    'min'  => '500',
    'max'  => '1500',
    'step' => '10'
  );

  $list_sizing_site_width = array(
    'min'  => '72',
    'max'  => '90',
    'step' => '1'
  );

  $list_sizing_content_width = array(
    'min'  => '60',
    'max'  => '74',
    'step' => '1'
  );

  $list_sizing_sidebar_width = array(
    'min'  => '150',
    'max'  => '350',
    'step' => '10'
  );

  $list_woocommerce_navbar_cart_info = array(
    'inner'       => __( 'Single (Inner)', '__x__' ),
    'outer'       => __( 'Single (Outer)', '__x__' ),
    'inner-outer' => __( 'Double (Inner / Outer)', '__x__' ),
    'outer-inner' => __( 'Double (Outer / Inner)', '__x__' )
  );

  $list_woocommerce_navbar_cart_layout = array(
    'inline'  => __( 'Inline', '__x__' ),
    'stacked' => __( 'Stacked', '__x__' )
  );

  $list_woocommerce_navbar_cart_style = array(
    'square'  => __( 'Square', '__x__' ),
    'rounded' => __( 'Rounded', '__x__' )
  );

  $list_woocommerce_navbar_cart_content = array(
    'icon'  => __( 'Icon', '__x__' ),
    'total' => __( 'Cart Total', '__x__' ),
    'count' => __( 'Item Count', '__x__' )
  );

  $list_all_font_families = x_font_control_values_all_families();
  $list_all_font_weights  = x_font_control_values_all_weights();

  $list_letter_spacing = array(
    'min'  => '-0.15',
    'max'  => '0.5',
    'step' => '0.001'
  );


  //
  // Sections.
  //

  $x['sec'][] = array( 'x_customizer_section_stack',             __( 'Stack', '__x__' ),             1  );
  $x['sec'][] = array( 'x_customizer_section_integrity',         __( 'Integrity', '__x__' ),         2  );
  $x['sec'][] = array( 'x_customizer_section_renew',             __( 'Renew', '__x__' ),             3  );
  $x['sec'][] = array( 'x_customizer_section_icon',              __( 'Icon', '__x__' ),              4  );
  $x['sec'][] = array( 'x_customizer_section_ethos',             __( 'Ethos', '__x__' ),             5  );
  $x['sec'][] = array( 'x_customizer_section_layout_and_design', __( 'Layout and Design', '__x__' ), 6  );
  $x['sec'][] = array( 'x_customizer_section_typography',        __( 'Typography', '__x__' ),        7  );
  $x['sec'][] = array( 'x_customizer_section_buttons',           __( 'Buttons', '__x__' ),           8  );
  $x['sec'][] = array( 'x_customizer_section_header',            __( 'Header', '__x__' ),            9  );
  $x['sec'][] = array( 'x_customizer_section_footer',            __( 'Footer', '__x__' ),            10 );
  $x['sec'][] = array( 'x_customizer_section_blog',              __( 'Blog', '__x__' ),              11 );
  $x['sec'][] = array( 'x_customizer_section_portfolio',         __( 'Portfolio', '__x__' ),         12 );
  $x['sec'][] = array( 'x_customizer_section_social',            __( 'Social', '__x__' ),            16 );
  $x['sec'][] = array( 'x_customizer_section_site_icons',        __( 'Site Icons', '__x__' ),        17 );
  $x['sec'][] = array( 'x_customizer_section_custom',            __( 'Custom', '__x__' ),            18 );

  if ( X_BBPRESS_IS_ACTIVE ) {
    $x['sec'][] = array( 'x_customizer_section_bbpress', __( 'bbPress', '__x__' ), 13 );
  }

  if ( X_BUDDYPRESS_IS_ACTIVE ) {
    $x['sec'][] = array( 'x_customizer_section_buddypress', __( 'BuddyPress', '__x__' ), 14 );
  }

  if ( X_WOOCOMMERCE_IS_ACTIVE ) {
    $x['sec'][] = array( 'x_customizer_section_woocommerce', __( 'WooCommerce', '__x__' ), 15 );
  }


  //
  // Options - Stack.
  //

      $x['set'][] = array( 'x_stack', 'refresh' );
      $x['con'][] = array( 'x_stack', 'radio', __( 'Select', '__x__' ), $list_stacks, 'x_customizer_section_stack' );


  //
  // Options - Integrity.
  //

      $x['set'][] = array( 'x_integrity_design', 'refresh' );
      $x['con'][] = array( 'x_integrity_design', 'radio', __( 'Design', '__x__' ), $list_integrity_designs, 'x_customizer_section_integrity' );

      $x['set'][] = array( 'x_integrity_topbar_transparency_enable', 'refresh' );
      $x['con'][] = array( 'x_integrity_topbar_transparency_enable', 'radio', __( 'Topbar Transparency', '__x__' ), $list_on_off, 'x_customizer_section_integrity' );

      $x['set'][] = array( 'x_integrity_navbar_transparency_enable', 'refresh' );
      $x['con'][] = array( 'x_integrity_navbar_transparency_enable', 'radio', __( 'Navbar Transparency', '__x__' ), $list_on_off, 'x_customizer_section_integrity' );

      $x['set'][] = array( 'x_integrity_footer_transparency_enable', 'refresh' );
      $x['con'][] = array( 'x_integrity_footer_transparency_enable', 'radio', __( 'Footer Transparency', '__x__' ), $list_on_off, 'x_customizer_section_integrity' );


      //
      // Blog options.
      //

      $x['set'][] = array( 'x_integrity_blog_header_enable', 'refresh' );
      $x['con'][] = array( 'x_integrity_blog_header_enable', 'radio', __( 'Blog Header', '__x__' ), $list_on_off, 'x_customizer_section_integrity' );

      $x['set'][] = array( 'x_integrity_blog_title', 'postMessage' );
      $x['con'][] = array( 'x_integrity_blog_title', 'text', __( 'Blog Title', '__x__' ), 'x_customizer_section_integrity' );

      $x['set'][] = array( 'x_integrity_blog_subtitle', 'postMessage' );
      $x['con'][] = array( 'x_integrity_blog_subtitle', 'text', __( 'Blog Subtitle', '__x__' ), 'x_customizer_section_integrity' );


      //
      // Portfolio options.
      //

      $x['set'][] = array( 'x_integrity_portfolio_archive_sort_button_text', 'postMessage' );
      $x['con'][] = array( 'x_integrity_portfolio_archive_sort_button_text', 'text', __( 'Sort Button Text', '__x__' ), 'x_customizer_section_integrity' );

      $x['set'][] = array( 'x_integrity_portfolio_archive_post_sharing_enable', 'refresh' );
      $x['con'][] = array( 'x_integrity_portfolio_archive_post_sharing_enable', 'radio', __( 'Portfolio Index Sharing', '__x__' ), $list_on_off, 'x_customizer_section_integrity' );


      //
      // Shop options.
      //

      if ( X_WOOCOMMERCE_IS_ACTIVE ) {

          $x['set'][] = array( 'x_integrity_shop_header_enable', 'refresh' );
          $x['con'][] = array( 'x_integrity_shop_header_enable', 'radio', __( 'Shop Header', '__x__' ), $list_on_off, 'x_customizer_section_integrity' );

          $x['set'][] = array( 'x_integrity_shop_title', 'postMessage' );
          $x['con'][] = array( 'x_integrity_shop_title', 'text', __( 'Shop Title', '__x__' ), 'x_customizer_section_integrity' );

          $x['set'][] = array( 'x_integrity_shop_subtitle', 'postMessage' );
          $x['con'][] = array( 'x_integrity_shop_subtitle', 'text', __( 'Shop Subtitle', '__x__' ), 'x_customizer_section_integrity' );

      }


  //
  // Options - Renew.
  //

      $x['set'][] = array( 'x_renew_topbar_background', 'refresh' );
      $x['con'][] = array( 'x_renew_topbar_background', 'color', __( 'Topbar Background', '__x__' ), 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_logobar_background', 'refresh' );
      $x['con'][] = array( 'x_renew_logobar_background', 'color', __( 'Logobar Background', '__x__' ), 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_navbar_background', 'refresh' );
      $x['con'][] = array( 'x_renew_navbar_background', 'color', __( 'Navbar Background', '__x__' ), 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_navbar_button_color', 'refresh' );
      $x['con'][] = array( 'x_renew_navbar_button_color', 'color', __( 'Mobile Button Color', '__x__' ), 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_navbar_button_background', 'refresh' );
      $x['con'][] = array( 'x_renew_navbar_button_background', 'color', __( 'Mobile Button Background', '__x__' ), 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_navbar_button_background_hover', 'refresh' );
      $x['con'][] = array( 'x_renew_navbar_button_background_hover', 'color', __( 'Mobile Button Background Hover', '__x__' ), 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_footer_background', 'refresh' );
      $x['con'][] = array( 'x_renew_footer_background', 'color', __( 'Footer Background', '__x__' ), 'x_customizer_section_renew' );


      //
      // Typography options.
      //

      $x['set'][] = array( 'x_renew_topbar_text_color', 'refresh' );
      $x['con'][] = array( 'x_renew_topbar_text_color', 'color', __( 'Topbar Links and Text', '__x__' ), 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_topbar_link_color_hover', 'refresh' );
      $x['con'][] = array( 'x_renew_topbar_link_color_hover', 'color', __( 'Topbar Links Hover', '__x__' ), 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_footer_text_color', 'refresh' );
      $x['con'][] = array( 'x_renew_footer_text_color', 'color', __( 'Footer Links and Text', '__x__' ), 'x_customizer_section_renew' );


      //
      // Blog options.
      //

      $x['set'][] = array( 'x_renew_blog_title', 'postMessage' );
      $x['con'][] = array( 'x_renew_blog_title', 'text', __( 'Blog Title', '__x__' ), 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_entry_icon_color', 'refresh' );
      $x['con'][] = array( 'x_renew_entry_icon_color', 'color', __( 'Entry Icons', '__x__' ), 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_entry_icon_position', 'refresh' );
      $x['con'][] = array( 'x_renew_entry_icon_position', 'radio', __( 'Entry Icon Position', '__x__' ), $list_renew_entry_icon_positions, 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_entry_icon_position_horizontal', 'refresh' );
      $x['con'][] = array( 'x_renew_entry_icon_position_horizontal', 'text', __( 'Entry Icon Horizontal Alignment (%)', '__x__' ), 'x_customizer_section_renew' );

      $x['set'][] = array( 'x_renew_entry_icon_position_vertical', 'refresh' );
      $x['con'][] = array( 'x_renew_entry_icon_position_vertical', 'text', __( 'Entry Icon Vertical Alignment (px)', '__x__' ), 'x_customizer_section_renew' );


      //
      // Shop options.
      //

      if ( X_WOOCOMMERCE_IS_ACTIVE ) {

          $x['set'][] = array( 'x_renew_shop_title', 'postMessage' );
          $x['con'][] = array( 'x_renew_shop_title', 'text', __( 'Shop Title', '__x__' ), 'x_customizer_section_renew' );

      }


  //
  // Options - Icon.
  //

      $x['set'][] = array( 'x_icon_post_title_icon_enable', 'refresh' );
      $x['con'][] = array( 'x_icon_post_title_icon_enable', 'radio', __( 'Post Title Icon', '__x__' ), $list_on_off, 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_standard_colors_enable', 'refresh' );
      $x['con'][] = array( 'x_icon_post_standard_colors_enable', 'radio', __( 'Standard Post Custom Colors', '__x__' ), $list_on_off, 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_standard_color', 'refresh' );
      $x['con'][] = array( 'x_icon_post_standard_color', 'color', __( 'Standard Post Text', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_standard_background', 'refresh' );
      $x['con'][] = array( 'x_icon_post_standard_background', 'color', __( 'Standard Post Background', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_image_colors_enable', 'refresh' );
      $x['con'][] = array( 'x_icon_post_image_colors_enable', 'radio', __( 'Image Post Custom Colors', '__x__' ), $list_on_off, 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_image_color', 'refresh' );
      $x['con'][] = array( 'x_icon_post_image_color', 'color', __( 'Image Post Text', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_image_background', 'refresh' );
      $x['con'][] = array( 'x_icon_post_image_background', 'color', __( 'Image Post Background', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_gallery_colors_enable', 'refresh' );
      $x['con'][] = array( 'x_icon_post_gallery_colors_enable', 'radio', __( 'Gallery Post Custom Colors', '__x__' ), $list_on_off, 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_gallery_color', 'refresh' );
      $x['con'][] = array( 'x_icon_post_gallery_color', 'color', __( 'Gallery Post Text', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_gallery_background', 'refresh' );
      $x['con'][] = array( 'x_icon_post_gallery_background', 'color', __( 'Gallery Post Background', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_video_colors_enable', 'refresh' );
      $x['con'][] = array( 'x_icon_post_video_colors_enable', 'radio', __( 'Video Post Custom Colors', '__x__' ), $list_on_off, 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_video_color', 'refresh' );
      $x['con'][] = array( 'x_icon_post_video_color', 'color', __( 'Video Post Text', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_video_background', 'refresh' );
      $x['con'][] = array( 'x_icon_post_video_background', 'color', __( 'Video Post Background', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_audio_colors_enable', 'refresh' );
      $x['con'][] = array( 'x_icon_post_audio_colors_enable', 'radio', __( 'Audio Post Custom Colors', '__x__' ), $list_on_off, 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_audio_color', 'refresh' );
      $x['con'][] = array( 'x_icon_post_audio_color', 'color', __( 'Audio Post Text', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_audio_background', 'refresh' );
      $x['con'][] = array( 'x_icon_post_audio_background', 'color', __( 'Audio Post Background', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_quote_colors_enable', 'refresh' );
      $x['con'][] = array( 'x_icon_post_quote_colors_enable', 'radio', __( 'Quote Post Custom Colors', '__x__' ), $list_on_off, 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_quote_color', 'refresh' );
      $x['con'][] = array( 'x_icon_post_quote_color', 'color', __( 'Quote Post Text', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_quote_background', 'refresh' );
      $x['con'][] = array( 'x_icon_post_quote_background', 'color', __( 'Quote Post Background', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_link_colors_enable', 'refresh' );
      $x['con'][] = array( 'x_icon_post_link_colors_enable', 'radio', __( 'Link Post Custom Colors', '__x__' ), $list_on_off, 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_link_color', 'refresh' );
      $x['con'][] = array( 'x_icon_post_link_color', 'color', __( 'Link Post Text', '__x__' ), 'x_customizer_section_icon' );

      $x['set'][] = array( 'x_icon_post_link_background', 'refresh' );
      $x['con'][] = array( 'x_icon_post_link_background', 'color', __( 'Link Post Background', '__x__' ), 'x_customizer_section_icon' );


      //
      // Shop options.
      //

      if ( X_WOOCOMMERCE_IS_ACTIVE ) {

          $x['set'][] = array( 'x_icon_shop_title', 'postMessage' );
          $x['con'][] = array( 'x_icon_shop_title', 'text', __( 'Shop Title', '__x__' ), 'x_customizer_section_icon' );

      }


  //
  // Options - Ethos.
  //


      $x['set'][] = array( 'x_ethos_topbar_background', 'refresh' );
      $x['con'][] = array( 'x_ethos_topbar_background', 'color', __( 'Topbar Background Color', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_navbar_background', 'refresh' );
      $x['con'][] = array( 'x_ethos_navbar_background', 'color', __( 'Navbar Background Color', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_sidebar_widget_headings_color', 'refresh' );
      $x['con'][] = array( 'x_ethos_sidebar_widget_headings_color', 'color', __( 'Sidebar Widget Headings Color', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_sidebar_color', 'refresh' );
      $x['con'][] = array( 'x_ethos_sidebar_color', 'color', __( 'Sidebar Text Color', '__x__' ), 'x_customizer_section_ethos' );


      //
      // Post carousel.
      //

      $x['set'][] = array( 'x_ethos_post_carousel_enable', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_carousel_enable', 'radio', __( 'Post Carousel', '__x__' ), $list_on_off, 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_carousel_count', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_carousel_count', 'text', __( 'Posts Per Page', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_carousel_display', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_carousel_display', 'radio', __( 'Display', '__x__' ), $list_ethos_post_carousel_and_slider_display, 'x_customizer_section_ethos' );


      //
      // Post carousel - screen display.
      //

      $x['set'][] = array( 'x_ethos_post_carousel_display_count_extra_large', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_carousel_display_count_extra_large', 'text', __( 'Over 1500 Pixels', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_carousel_display_count_large', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_carousel_display_count_large', 'text', __( '1200 &ndash; 1499 Pixels', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_carousel_display_count_medium', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_carousel_display_count_medium', 'text', __( '979 &ndash; 1199 Pixels', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_carousel_display_count_small', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_carousel_display_count_small', 'text', __( '550 &ndash; 978 Pixels', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_carousel_display_count_extra_small', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_carousel_display_count_extra_small', 'text', __( 'Below 549 Pixels', '__x__' ), 'x_customizer_section_ethos' );


      //
      // Post slider - blog.
      //

      $x['set'][] = array( 'x_ethos_post_slider_blog_enable', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_slider_blog_enable', 'radio', __( 'Post Slider for Blog', '__x__' ), $list_on_off, 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_slider_blog_height', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_slider_blog_height', 'text', __( 'Slider Height (px)', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_slider_blog_count', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_slider_blog_count', 'text', __( 'Posts Per Page', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_slider_blog_display', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_slider_blog_display', 'radio', __( 'Display', '__x__' ), $list_ethos_post_carousel_and_slider_display, 'x_customizer_section_ethos' );


      //
      // Post slider - archives.
      //

      $x['set'][] = array( 'x_ethos_post_slider_archive_enable', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_slider_archive_enable', 'radio', __( 'Post Slider for Archives', '__x__' ), $list_on_off, 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_slider_archive_height', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_slider_archive_height', 'text', __( 'Slider Height (px)', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_slider_archive_count', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_slider_archive_count', 'text', __( 'Posts Per Page', '__x__' ), 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_post_slider_archive_display', 'refresh' );
      $x['con'][] = array( 'x_ethos_post_slider_archive_display', 'radio', __( 'Display', '__x__' ), $list_ethos_post_carousel_and_slider_display, 'x_customizer_section_ethos' );


      //
      // Blog options.
      //

      $x['set'][] = array( 'x_ethos_filterable_index_enable', 'refresh' );
      $x['con'][] = array( 'x_ethos_filterable_index_enable', 'radio', __( 'Filterable Index', '__x__' ), $list_on_off, 'x_customizer_section_ethos' );

      $x['set'][] = array( 'x_ethos_filterable_index_categories', 'refresh' );
      $x['con'][] = array( 'x_ethos_filterable_index_categories', 'text', __( 'Category IDs', '__x__' ), 'x_customizer_section_ethos' );


      //
      // Shop options.
      //

      if ( X_WOOCOMMERCE_IS_ACTIVE ) {

          $x['set'][] = array( 'x_ethos_shop_title', 'postMessage' );
          $x['con'][] = array( 'x_ethos_shop_title', 'text', __( 'Shop Title', '__x__' ), 'x_customizer_section_ethos' );

      }


  //
  // Options - Layout and Design.
  //

      $x['set'][] = array( 'x_layout_site', 'refresh' );
      $x['con'][] = array( 'x_layout_site', 'radio', __( 'Site Layout', '__x__' ), $list_site_layouts, 'x_customizer_section_layout_and_design' );

      $x['set'][] = array( 'x_layout_site_max_width', 'postMessage' );
      $x['con'][] = array( 'x_layout_site_max_width', 'slider', __( 'Site Max Width (px)', '__x__' ), $list_sizing_site_max_width, 'x_customizer_section_layout_and_design' );

      $x['set'][] = array( 'x_layout_site_width', 'postMessage' );
      $x['con'][] = array( 'x_layout_site_width', 'slider', __( 'Site Width (%)', '__x__' ), $list_sizing_site_width, 'x_customizer_section_layout_and_design' );

      $x['set'][] = array( 'x_layout_content', 'refresh' );
      $x['con'][] = array( 'x_layout_content', 'radio', __( 'Content Layout', '__x__' ), $list_content_layouts, 'x_customizer_section_layout_and_design' );

      $x['set'][] = array( 'x_layout_content_width', 'postMessage' );
      $x['con'][] = array( 'x_layout_content_width', 'slider', __( 'Content Width (%)', '__x__' ), $list_sizing_content_width, 'x_customizer_section_layout_and_design' );

      $x['set'][] = array( 'x_layout_sidebar_width', 'refresh' );
      $x['con'][] = array( 'x_layout_sidebar_width', 'text', __( 'Sidebar Width (px)', '__x__' ), 'x_customizer_section_layout_and_design' );


      //
      // Background options.
      //
      // integrity_light / integrity_dark
      // renew
      // icon
      // ethos
      //

      $x['set'][] = array( 'x_design_bg_color', 'postMessage' );
      $x['con'][] = array( 'x_design_bg_color', 'color', __( 'Background Color', '__x__' ), 'x_customizer_section_layout_and_design' );

      $x['set'][] = array( 'x_design_bg_image_pattern', 'refresh' );
      $x['con'][] = array( 'x_design_bg_image_pattern', 'image', __( 'Background Pattern', '__x__' ), 'x_customizer_section_layout_and_design' );

      $x['set'][] = array( 'x_design_bg_image_full', 'refresh' );
      $x['con'][] = array( 'x_design_bg_image_full', 'image', __( 'Background Image', '__x__' ), 'x_customizer_section_layout_and_design' );

      $x['set'][] = array( 'x_design_bg_image_full_fade', 'refresh' );
      $x['con'][] = array( 'x_design_bg_image_full_fade', 'text', __( 'Background Image Fade (ms)', '__x__' ), 'x_customizer_section_layout_and_design' );


  //
  // Options - Typography.
  //

      $x['set'][] = array( 'x_google_fonts_subsets', 'refresh' );
      $x['con'][] = array( 'x_google_fonts_subsets', 'radio', __( 'Google Fonts Subsets', '__x__' ), $list_on_off, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_google_fonts_subset_cyrillic', 'refresh' );
      $x['con'][] = array( 'x_google_fonts_subset_cyrillic', 'radio', __( 'Cyrillic', '__x__' ), $list_on_off, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_google_fonts_subset_greek', 'refresh' );
      $x['con'][] = array( 'x_google_fonts_subset_greek', 'radio', __( 'Greek', '__x__' ), $list_on_off, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_google_fonts_subset_vietnamese', 'refresh' );
      $x['con'][] = array( 'x_google_fonts_subset_vietnamese', 'radio', __( 'Vietnamese', '__x__' ), $list_on_off, 'x_customizer_section_typography' );


      //
      // Body and content.
      //

      $x['set'][] = array( 'x_body_font_family', 'refresh' );
      $x['con'][] = array( 'x_body_font_family', 'select', __( 'Body Font', '__x__' ), $list_all_font_families, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_body_font_color', 'refresh' );
      $x['con'][] = array( 'x_body_font_color', 'color', __( 'Body Font Color', '__x__' ), 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_body_font_size', 'refresh' );
      $x['con'][] = array( 'x_body_font_size', 'text', __( 'Body Font Size (px)', '__x__' ), 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_content_font_size', 'refresh' );
      $x['con'][] = array( 'x_content_font_size', 'text', __( 'Content Font Size (px)', '__x__' ), 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_body_font_weight', 'refresh' );
      $x['con'][] = array( 'x_body_font_weight', 'radio', __( 'Body Font Weight', '__x__' ), $list_all_font_weights, 'x_customizer_section_typography' );


      //
      // Headings.
      //

      $x['set'][] = array( 'x_headings_font_family', 'refresh' );
      $x['con'][] = array( 'x_headings_font_family', 'select', __( 'Headings Font', '__x__' ), $list_all_font_families, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_headings_font_color', 'refresh' );
      $x['con'][] = array( 'x_headings_font_color', 'color', __( 'Headings Font Color', '__x__' ), 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_headings_font_weight', 'refresh' );
      $x['con'][] = array( 'x_headings_font_weight', 'radio', __( 'Headings Font Weight', '__x__' ), $list_all_font_weights, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_h1_letter_spacing', 'postMessage' );
      $x['con'][] = array( 'x_h1_letter_spacing', 'slider', __( 'h1 Letter Spacing (em)', '__x__' ), $list_letter_spacing, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_h2_letter_spacing', 'postMessage' );
      $x['con'][] = array( 'x_h2_letter_spacing', 'slider', __( 'h2 Letter Spacing (em)', '__x__' ), $list_letter_spacing, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_h3_letter_spacing', 'postMessage' );
      $x['con'][] = array( 'x_h3_letter_spacing', 'slider', __( 'h3 Letter Spacing (em)', '__x__' ), $list_letter_spacing, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_h4_letter_spacing', 'postMessage' );
      $x['con'][] = array( 'x_h4_letter_spacing', 'slider', __( 'h4 Letter Spacing (em)', '__x__' ), $list_letter_spacing, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_h5_letter_spacing', 'postMessage' );
      $x['con'][] = array( 'x_h5_letter_spacing', 'slider', __( 'h5 Letter Spacing (em)', '__x__' ), $list_letter_spacing, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_h6_letter_spacing', 'postMessage' );
      $x['con'][] = array( 'x_h6_letter_spacing', 'slider', __( 'h6 Letter Spacing (em)', '__x__' ), $list_letter_spacing, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_headings_uppercase_enable', 'refresh' );
      $x['con'][] = array( 'x_headings_uppercase_enable', 'radio', __( 'Uppercase', '__x__' ), $list_on_off, 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_headings_widget_icons_enable', 'refresh' );
      $x['con'][] = array( 'x_headings_widget_icons_enable', 'radio', __( 'Widget Icons', '__x__' ), $list_on_off, 'x_customizer_section_typography' );


      //
      // Site links.
      //

      $x['set'][] = array( 'x_site_link_color', 'refresh' );
      $x['con'][] = array( 'x_site_link_color', 'color', __( 'Site Links', '__x__' ), 'x_customizer_section_typography' );

      $x['set'][] = array( 'x_site_link_color_hover', 'refresh' );
      $x['con'][] = array( 'x_site_link_color_hover', 'color', __( 'Site Links Hover', '__x__' ), 'x_customizer_section_typography' );


  //
  // Options - Buttons.
  //

      $x['set'][] = array( 'x_button_style', 'refresh' );
      $x['con'][] = array( 'x_button_style', 'radio', __( 'Button Style', '__x__' ), $list_button_styles, 'x_customizer_section_buttons' );

      $x['set'][] = array( 'x_button_shape', 'refresh' );
      $x['con'][] = array( 'x_button_shape', 'radio', __( 'Button Shape', '__x__' ), $list_button_shapes, 'x_customizer_section_buttons' );

      $x['set'][] = array( 'x_button_size', 'refresh' );
      $x['con'][] = array( 'x_button_size', 'radio', __( 'Button Size', '__x__' ), $list_button_sizes, 'x_customizer_section_buttons' );



      //
      // Colors.
      //

      $x['set'][] = array( 'x_button_color', 'refresh' );
      $x['con'][] = array( 'x_button_color', 'color', __( 'Button Text', '__x__' ), 'x_customizer_section_buttons' );

      $x['set'][] = array( 'x_button_background_color', 'refresh' );
      $x['con'][] = array( 'x_button_background_color', 'color', __( 'Button Background', '__x__' ), 'x_customizer_section_buttons' );

      $x['set'][] = array( 'x_button_border_color', 'refresh' );
      $x['con'][] = array( 'x_button_border_color', 'color', __( 'Button Border', '__x__' ), 'x_customizer_section_buttons' );

      $x['set'][] = array( 'x_button_bottom_color', 'refresh' );
      $x['con'][] = array( 'x_button_bottom_color', 'color', __( 'Button Bottom', '__x__' ), 'x_customizer_section_buttons' );


      //
      // Hover colors.
      //

      $x['set'][] = array( 'x_button_color_hover', 'refresh' );
      $x['con'][] = array( 'x_button_color_hover', 'color', __( 'Button Text', '__x__' ), 'x_customizer_section_buttons' );

      $x['set'][] = array( 'x_button_background_color_hover', 'refresh' );
      $x['con'][] = array( 'x_button_background_color_hover', 'color', __( 'Button Background', '__x__' ), 'x_customizer_section_buttons' );

      $x['set'][] = array( 'x_button_border_color_hover', 'refresh' );
      $x['con'][] = array( 'x_button_border_color_hover', 'color', __( 'Button Border', '__x__' ), 'x_customizer_section_buttons' );

      $x['set'][] = array( 'x_button_bottom_color_hover', 'refresh' );
      $x['con'][] = array( 'x_button_bottom_color_hover', 'color', __( 'Button Bottom', '__x__' ), 'x_customizer_section_buttons' );


  //
  // Options - Header.
  //

      $x['set'][] = array( 'x_navbar_positioning', 'refresh' );
      $x['con'][] = array( 'x_navbar_positioning', 'radio', __( 'Navbar Position', '__x__' ), $list_navbar_positions, 'x_customizer_section_header' );
      
      $x['set'][] = array( 'x_fixed_menu_scroll', 'refresh' );
      $x['con'][] = array( 'x_fixed_menu_scroll', 'radio', __('Navbar Scrolling', '__x__'),$list_overflow_options, 'x_customizer_section_header' );


      //
      // Logo and navigation.
      //

      $x['set'][] = array( 'x_logo_navigation_layout', 'refresh' );
      $x['con'][] = array( 'x_logo_navigation_layout', 'radio', __( 'Layout', '__x__' ), $list_logo_navigation_layouts, 'x_customizer_section_header' );

      $x['set'][] = array( 'x_logobar_adjust_spacing_top', 'refresh' );
      $x['con'][] = array( 'x_logobar_adjust_spacing_top', 'text', __( 'Logobar Top Spacing (px)', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_logobar_adjust_spacing_bottom', 'refresh' );
      $x['con'][] = array( 'x_logobar_adjust_spacing_bottom', 'text', __( 'Logobar Bottom Spacing (px)', '__x__' ), 'x_customizer_section_header' );


      //
      // Navbar.
      //

      $x['set'][] = array( 'x_navbar_height', 'refresh' );
      $x['con'][] = array( 'x_navbar_height', 'text', __( 'Navbar Top Height (px)', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_navbar_width', 'refresh' );
      $x['con'][] = array( 'x_navbar_width', 'text', __( 'Navbar Side Width (px)', '__x__' ), 'x_customizer_section_header' );


      //
      // Logo - text.
      //

      $x['set'][] = array( 'x_logo_font_family', 'refresh' );
      $x['con'][] = array( 'x_logo_font_family', 'select', __( 'Logo Font', '__x__' ), $list_all_font_families, 'x_customizer_section_header' );

      $x['set'][] = array( 'x_logo_font_color', 'refresh' );
      $x['con'][] = array( 'x_logo_font_color', 'color', __( 'Logo Font Color', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_logo_font_size', 'refresh' );
      $x['con'][] = array( 'x_logo_font_size', 'text', __( 'Logo Font Size (px)', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_logo_font_weight', 'refresh' );
      $x['con'][] = array( 'x_logo_font_weight', 'radio', __( 'Logo Font Weight', '__x__' ), $list_all_font_weights, 'x_customizer_section_header' );

      $x['set'][] = array( 'x_logo_letter_spacing', 'postMessage' );
      $x['con'][] = array( 'x_logo_letter_spacing', 'slider', __( 'Logo Letter Spacing (em)', '__x__' ), $list_letter_spacing, 'x_customizer_section_header' );

      $x['set'][] = array( 'x_logo_uppercase_enable', 'refresh' );
      $x['con'][] = array( 'x_logo_uppercase_enable', 'radio', __( 'Uppercase', '__x__' ), $list_on_off, 'x_customizer_section_header' );


      //
      // Logo - image.
      //

      $x['set'][] = array( 'x_logo', 'refresh' );
      $x['con'][] = array( 'x_logo', 'image', __( 'Logo Upload', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_logo_width', 'refresh' );
      $x['con'][] = array( 'x_logo_width', 'text', __( 'Logo Width (px)', '__x__' ), 'x_customizer_section_header' );


      //
      // Logo - alignment.
      //

      $x['set'][] = array( 'x_logo_adjust_navbar_top', 'refresh' );
      $x['con'][] = array( 'x_logo_adjust_navbar_top', 'text', __( 'Navbar Top Logo Alignment (px)', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_logo_adjust_navbar_side', 'refresh' );
      $x['con'][] = array( 'x_logo_adjust_navbar_side', 'text', __( 'Navbar Side Logo Alignment (px)', '__x__' ), 'x_customizer_section_header' );


      //
      // Links - text.
      //

      $x['set'][] = array( 'x_navbar_font_family', 'refresh' );
      $x['con'][] = array( 'x_navbar_font_family', 'select', __( 'Navbar Font', '__x__' ), $list_all_font_families, 'x_customizer_section_header' );

      $x['set'][] = array( 'x_navbar_link_color', 'refresh' );
      $x['con'][] = array( 'x_navbar_link_color', 'color', __( 'Navbar Links', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_navbar_link_color_hover', 'refresh' );
      $x['con'][] = array( 'x_navbar_link_color_hover', 'color', __( 'Navbar Links Hover', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_navbar_font_size', 'refresh' );
      $x['con'][] = array( 'x_navbar_font_size', 'text', __( 'Navbar Font Size (px)', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_navbar_font_weight', 'refresh' );
      $x['con'][] = array( 'x_navbar_font_weight', 'radio', __( 'Navbar Font Weight', '__x__' ), $list_all_font_weights, 'x_customizer_section_header' );

      $x['set'][] = array( 'x_navbar_letter_spacing', 'postMessage' );
      $x['con'][] = array( 'x_navbar_letter_spacing', 'slider', __( 'Navbar Letter Spacing (em)', '__x__' ), $list_letter_spacing, 'x_customizer_section_header' );

      $x['set'][] = array( 'x_navbar_uppercase_enable', 'refresh' );
      $x['con'][] = array( 'x_navbar_uppercase_enable', 'radio', __( 'Uppercase', '__x__' ), $list_on_off, 'x_customizer_section_header' );


      //
      // Links - alignment.
      //

      $x['set'][] = array( 'x_navbar_adjust_links_top', 'refresh' );
      $x['con'][] = array( 'x_navbar_adjust_links_top', 'text', __( 'Navbar Top Link Alignment (px)', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_navbar_adjust_links_top_spacing', 'refresh' );
      $x['con'][] = array( 'x_navbar_adjust_links_top_spacing', 'text', __( 'Navbar Top Link Spacing (px)', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_navbar_adjust_links_side', 'refresh' );
      $x['con'][] = array( 'x_navbar_adjust_links_side', 'text', __( 'Navbar Side Link Alignment (px)', '__x__' ), 'x_customizer_section_header' );


      //
      // Search.
      //

      $x['set'][] = array( 'x_header_search_enable', 'refresh' );
      $x['con'][] = array( 'x_header_search_enable', 'radio', __( 'Navbar Search', '__x__' ), $list_on_off, 'x_customizer_section_header' );


      //
      // Mobile button.
      //

      $x['set'][] = array( 'x_navbar_adjust_button_size', 'refresh' );
      $x['con'][] = array( 'x_navbar_adjust_button_size', 'text', __( 'Mobile Navbar Button Size (px)', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_navbar_adjust_button', 'refresh' );
      $x['con'][] = array( 'x_navbar_adjust_button', 'text', __( 'Mobile Navbar Button Alignment (px)', '__x__' ), 'x_customizer_section_header' );


      //
      // Widgetbar.
      //

      $x['set'][] = array( 'x_header_widget_areas', 'refresh' );
      $x['con'][] = array( 'x_header_widget_areas', 'radio', __( 'Header Widget Areas', '__x__' ), $list_widget_areas, 'x_customizer_section_header' );

      $x['set'][] = array( 'x_widgetbar_button_background', 'refresh' );
      $x['con'][] = array( 'x_widgetbar_button_background', 'color', __( 'Widgetbar Button Background', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_widgetbar_button_background_hover', 'refresh' );
      $x['con'][] = array( 'x_widgetbar_button_background_hover', 'color', __( 'Widgetbar Button Background Hover', '__x__' ), 'x_customizer_section_header' );


      //
      // Miscellaneous.
      //

      $x['set'][] = array( 'x_topbar_display', 'refresh' );
      $x['con'][] = array( 'x_topbar_display', 'radio', __( 'Topbar', '__x__' ), $list_on_off, 'x_customizer_section_header' );

      $x['set'][] = array( 'x_topbar_content', 'refresh' );
      $x['con'][] = array( 'x_topbar_content', 'textarea', __( 'Topbar Content', '__x__' ), 'x_customizer_section_header' );

      $x['set'][] = array( 'x_breadcrumb_display', 'refresh' );
      $x['con'][] = array( 'x_breadcrumb_display', 'radio', __( 'Breadcrumbs', '__x__' ), $list_on_off, 'x_customizer_section_header' );


  //
  // Options - Footer.
  //

      $x['set'][] = array( 'x_footer_widget_areas', 'refresh' );
      $x['con'][] = array( 'x_footer_widget_areas', 'radio', __( 'Footer Widget Areas', '__x__' ), $list_widget_areas, 'x_customizer_section_footer' );

      $x['set'][] = array( 'x_footer_bottom_display', 'refresh' );
      $x['con'][] = array( 'x_footer_bottom_display', 'radio', __( 'Bottom Footer', '__x__' ), $list_on_off, 'x_customizer_section_footer' );

      $x['set'][] = array( 'x_footer_menu_display', 'refresh' );
      $x['con'][] = array( 'x_footer_menu_display', 'radio', __( 'Footer Menu', '__x__' ), $list_on_off, 'x_customizer_section_footer' );

      $x['set'][] = array( 'x_footer_social_display', 'refresh' );
      $x['con'][] = array( 'x_footer_social_display', 'radio', __( 'Footer Social', '__x__' ), $list_on_off, 'x_customizer_section_footer' );

      $x['set'][] = array( 'x_footer_content_display', 'refresh' );
      $x['con'][] = array( 'x_footer_content_display', 'radio', __( 'Footer Content', '__x__' ), $list_on_off, 'x_customizer_section_footer' );

      $x['set'][] = array( 'x_footer_content', 'refresh' );
      $x['con'][] = array( 'x_footer_content', 'textarea', __( 'Footer Content', '__x__' ), 'x_customizer_section_footer' );


      //
      // Scroll top anchor.
      //

      $x['set'][] = array( 'x_footer_scroll_top_display', 'refresh' );
      $x['con'][] = array( 'x_footer_scroll_top_display', 'radio', __( 'Scroll Top Anchor', '__x__' ), $list_on_off, 'x_customizer_section_footer' );

      $x['set'][] = array( 'x_footer_scroll_top_position', 'refresh' );
      $x['con'][] = array( 'x_footer_scroll_top_position', 'radio', __( 'Scroll Top Anchor Position', '__x__' ), $list_left_right_positioning, 'x_customizer_section_footer' );

      $x['set'][] = array( 'x_footer_scroll_top_display_unit', 'refresh' );
      $x['con'][] = array( 'x_footer_scroll_top_display_unit', 'text', __( 'When to Display the Scroll Top Anchor (%)', '__x__' ), 'x_customizer_section_footer' );


  //
  // Options - Blog.
  //

      $x['set'][] = array( 'x_blog_style', 'refresh' );
      $x['con'][] = array( 'x_blog_style', 'radio', __( 'Style', '__x__' ), $list_blog_styles, 'x_customizer_section_blog' );

      $x['set'][] = array( 'x_blog_layout', 'refresh' );
      $x['con'][] = array( 'x_blog_layout', 'radio', __( 'Layout', '__x__' ), $list_section_layouts, 'x_customizer_section_blog' );

      $x['set'][] = array( 'x_blog_masonry_columns', 'refresh' );
      $x['con'][] = array( 'x_blog_masonry_columns', 'radio', __( 'Columns', '__x__' ), $list_masonry_columns, 'x_customizer_section_blog' );


      //
      // Archives.
      //

      $x['set'][] = array( 'x_archive_style', 'refresh' );
      $x['con'][] = array( 'x_archive_style', 'radio', __( 'Style', '__x__' ), $list_blog_styles, 'x_customizer_section_blog' );

      $x['set'][] = array( 'x_archive_layout', 'refresh' );
      $x['con'][] = array( 'x_archive_layout', 'radio', __( 'Layout', '__x__' ), $list_section_layouts, 'x_customizer_section_blog' );

      $x['set'][] = array( 'x_archive_masonry_columns', 'refresh' );
      $x['con'][] = array( 'x_archive_masonry_columns', 'radio', __( 'Columns', '__x__' ), $list_masonry_columns, 'x_customizer_section_blog' );


      //
      // Content.
      //

      $x['set'][] = array( 'x_blog_enable_post_meta', 'refresh' );
      $x['con'][] = array( 'x_blog_enable_post_meta', 'radio', __( 'Post Meta', '__x__' ), $list_on_off, 'x_customizer_section_blog' );

      $x['set'][] = array( 'x_blog_enable_full_post_content', 'refresh' );
      $x['con'][] = array( 'x_blog_enable_full_post_content', 'radio', __( 'Full Post Content on Index', '__x__' ), $list_on_off, 'x_customizer_section_blog' );

      $x['set'][] = array( 'x_blog_excerpt_length', 'refresh' );
      $x['con'][] = array( 'x_blog_excerpt_length', 'text', __( 'Excerpt Length', '__x__' ), 'x_customizer_section_blog' );


  //
  // Options - Portfolio.
  //

      $x['set'][] = array( 'x_custom_portfolio_slug', 'refresh' );
      $x['con'][] = array( 'x_custom_portfolio_slug', 'text', __( 'Custom URL Slug', '__x__' ), 'x_customizer_section_portfolio' );


      //
      // Content.
      //

      $x['set'][] = array( 'x_portfolio_enable_cropped_thumbs', 'refresh' );
      $x['con'][] = array( 'x_portfolio_enable_cropped_thumbs', 'radio', __( 'Cropped Featured Images', '__x__' ), $list_on_off, 'x_customizer_section_portfolio' );

      $x['set'][] = array( 'x_portfolio_enable_post_meta', 'refresh' );
      $x['con'][] = array( 'x_portfolio_enable_post_meta', 'radio', __( 'Post Meta', '__x__' ), $list_on_off, 'x_customizer_section_portfolio' );


      //
      // Labels.
      //

      $x['set'][] = array( 'x_portfolio_tag_title', 'refresh' );
      $x['con'][] = array( 'x_portfolio_tag_title', 'text', __( 'Tag List Title', '__x__' ), 'x_customizer_section_portfolio' );

      $x['set'][] = array( 'x_portfolio_launch_project_title', 'refresh' );
      $x['con'][] = array( 'x_portfolio_launch_project_title', 'text', __( 'Launch Project Title', '__x__' ), 'x_customizer_section_portfolio' );

      $x['set'][] = array( 'x_portfolio_launch_project_button_text', 'refresh' );
      $x['con'][] = array( 'x_portfolio_launch_project_button_text', 'text', __( 'Launch Project Button Text', '__x__' ), 'x_customizer_section_portfolio' );

      $x['set'][] = array( 'x_portfolio_share_project_title', 'refresh' );
      $x['con'][] = array( 'x_portfolio_share_project_title', 'text', __( 'Share Project Title', '__x__' ), 'x_customizer_section_portfolio' );


      //
      // Sharing.
      //

      $x['set'][] = array( 'x_portfolio_enable_facebook_sharing', 'refresh' );
      $x['con'][] = array( 'x_portfolio_enable_facebook_sharing', 'radio', __( 'Facebook Sharing Link', '__x__' ), $list_on_off, 'x_customizer_section_portfolio' );

      $x['set'][] = array( 'x_portfolio_enable_twitter_sharing', 'refresh' );
      $x['con'][] = array( 'x_portfolio_enable_twitter_sharing', 'radio', __( 'Twitter Sharing Link', '__x__' ), $list_on_off, 'x_customizer_section_portfolio' );

      $x['set'][] = array( 'x_portfolio_enable_google_plus_sharing', 'refresh' );
      $x['con'][] = array( 'x_portfolio_enable_google_plus_sharing', 'radio', __( 'Google+ Sharing Link', '__x__' ), $list_on_off, 'x_customizer_section_portfolio' );

      $x['set'][] = array( 'x_portfolio_enable_linkedin_sharing', 'refresh' );
      $x['con'][] = array( 'x_portfolio_enable_linkedin_sharing', 'radio', __( 'LinkedIn Sharing Link', '__x__' ), $list_on_off, 'x_customizer_section_portfolio' );

      $x['set'][] = array( 'x_portfolio_enable_pinterest_sharing', 'refresh' );
      $x['con'][] = array( 'x_portfolio_enable_pinterest_sharing', 'radio', __( 'Pinterest Sharing Link', '__x__' ), $list_on_off, 'x_customizer_section_portfolio' );

      $x['set'][] = array( 'x_portfolio_enable_reddit_sharing', 'refresh' );
      $x['con'][] = array( 'x_portfolio_enable_reddit_sharing', 'radio', __( 'Reddit Sharing Link', '__x__' ), $list_on_off, 'x_customizer_section_portfolio' );

      $x['set'][] = array( 'x_portfolio_enable_email_sharing', 'refresh' );
      $x['con'][] = array( 'x_portfolio_enable_email_sharing', 'radio', __( 'Email Sharing Link', '__x__' ), $list_on_off, 'x_customizer_section_portfolio' );


  //
  // Options - bbPress.
  //

  if ( X_BBPRESS_IS_ACTIVE ) {

      $x['set'][] = array( 'x_bbpress_layout_content', 'refresh' );
      $x['con'][] = array( 'x_bbpress_layout_content', 'radio', __( 'Layout', '__x__' ), $list_section_layouts, 'x_customizer_section_bbpress' );

      $x['set'][] = array( 'x_bbpress_enable_quicktags', 'refresh' );
      $x['con'][] = array( 'x_bbpress_enable_quicktags', 'radio', __( 'Topic/Reply Quicktags', '__x__' ), $list_on_off, 'x_customizer_section_bbpress' );


      //
      // Header links.
      //

      $x['set'][] = array( 'x_bbpress_header_menu_enable', 'refresh' );
      $x['con'][] = array( 'x_bbpress_header_menu_enable', 'radio', __( 'Navbar Menu', '__x__' ), $list_on_off, 'x_customizer_section_bbpress' );

  }


  //
  // Options - BuddyPress.
  //

  if ( X_BUDDYPRESS_IS_ACTIVE ) {

      $x['set'][] = array( 'x_buddypress_layout_content', 'refresh' );
      $x['con'][] = array( 'x_buddypress_layout_content', 'radio', __( 'Layout', '__x__' ), $list_section_layouts, 'x_customizer_section_buddypress' );


      //
      // Header links.
      //

      $x['set'][] = array( 'x_buddypress_header_menu_enable', 'refresh' );
      $x['con'][] = array( 'x_buddypress_header_menu_enable', 'radio', __( 'Navbar Menu', '__x__' ), $list_on_off, 'x_customizer_section_buddypress' );


      //
      // Component titles.
      //

      $x['set'][] = array( 'x_buddypress_activity_title', 'refresh' );
      $x['con'][] = array( 'x_buddypress_activity_title', 'text', __( 'Activity Title', '__x__' ), 'x_customizer_section_buddypress' );

      $x['set'][] = array( 'x_buddypress_groups_title', 'refresh' );
      $x['con'][] = array( 'x_buddypress_groups_title', 'text', __( 'Groups Title', '__x__' ), 'x_customizer_section_buddypress' );

      $x['set'][] = array( 'x_buddypress_blogs_title', 'refresh' );
      $x['con'][] = array( 'x_buddypress_blogs_title', 'text', __( 'Sites Title', '__x__' ), 'x_customizer_section_buddypress' );

      $x['set'][] = array( 'x_buddypress_members_title', 'refresh' );
      $x['con'][] = array( 'x_buddypress_members_title', 'text', __( 'Members Title', '__x__' ), 'x_customizer_section_buddypress' );

      $x['set'][] = array( 'x_buddypress_register_title', 'refresh' );
      $x['con'][] = array( 'x_buddypress_register_title', 'text', __( 'Register Title', '__x__' ), 'x_customizer_section_buddypress' );

      $x['set'][] = array( 'x_buddypress_activate_title', 'refresh' );
      $x['con'][] = array( 'x_buddypress_activate_title', 'text', __( 'Activate Title', '__x__' ), 'x_customizer_section_buddypress' );


      //
      // Component subtitles.
      //

      $x['set'][] = array( 'x_buddypress_activity_subtitle', 'refresh' );
      $x['con'][] = array( 'x_buddypress_activity_subtitle', 'text', __( 'Activity Subtitle', '__x__' ), 'x_customizer_section_buddypress' );

      $x['set'][] = array( 'x_buddypress_groups_subtitle', 'refresh' );
      $x['con'][] = array( 'x_buddypress_groups_subtitle', 'text', __( 'Groups Subtitle', '__x__' ), 'x_customizer_section_buddypress' );

      $x['set'][] = array( 'x_buddypress_blogs_subtitle', 'refresh' );
      $x['con'][] = array( 'x_buddypress_blogs_subtitle', 'text', __( 'Sites Subtitle', '__x__' ), 'x_customizer_section_buddypress' );

      $x['set'][] = array( 'x_buddypress_members_subtitle', 'refresh' );
      $x['con'][] = array( 'x_buddypress_members_subtitle', 'text', __( 'Members Subtitle', '__x__' ), 'x_customizer_section_buddypress' );

      $x['set'][] = array( 'x_buddypress_register_subtitle', 'refresh' );
      $x['con'][] = array( 'x_buddypress_register_subtitle', 'text', __( 'Register Subtitle', '__x__' ), 'x_customizer_section_buddypress' );

      $x['set'][] = array( 'x_buddypress_activate_subtitle', 'refresh' );
      $x['con'][] = array( 'x_buddypress_activate_subtitle', 'text', __( 'Activate Subtitle', '__x__' ), 'x_customizer_section_buddypress' );

  }


  //
  // Options - WooCommerce.
  //

  if ( X_WOOCOMMERCE_IS_ACTIVE ) {

      $x['set'][] = array( 'x_woocommerce_header_menu_enable', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_header_menu_enable', 'radio', __( 'Navbar Menu', '__x__' ), $list_on_off, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_header_cart_info', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_header_cart_info', 'radio', __( 'Cart Information', '__x__' ), $list_woocommerce_navbar_cart_info, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_header_cart_style', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_header_cart_style', 'radio', __( 'Cart Style', '__x__' ), $list_woocommerce_navbar_cart_style, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_header_cart_layout', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_header_cart_layout', 'radio', __( 'Cart Layout', '__x__' ), $list_woocommerce_navbar_cart_layout, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_header_cart_adjust', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_header_cart_adjust', 'text', __( 'Cart Alignment (px)', '__x__' ), 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_header_cart_content_inner', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_header_cart_content_inner', 'radio', __( 'Cart Content &ndash; Inner', '__x__' ), $list_woocommerce_navbar_cart_content, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_header_cart_content_outer', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_header_cart_content_outer', 'radio', __( 'Cart Content &ndash; Outer', '__x__' ), $list_woocommerce_navbar_cart_content, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_header_cart_content_inner_color', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_header_cart_content_inner_color', 'color', __( 'Cart Content &ndash; Inner Color', '__x__' ), 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_header_cart_content_inner_color_hover', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_header_cart_content_inner_color_hover', 'color', __( 'Cart Content &ndash; Inner Color Hover', '__x__' ), 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_header_cart_content_outer_color', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_header_cart_content_outer_color', 'color', __( 'Cart Content &ndash; Outer Color', '__x__' ), 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_header_cart_content_outer_color_hover', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_header_cart_content_outer_color_hover', 'color', __( 'Cart Content &ndash; Outer Color Hover', '__x__' ), 'x_customizer_section_woocommerce' );


      //
      // Shop.
      //

      $x['set'][] = array( 'x_woocommerce_shop_layout_content', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_shop_layout_content', 'radio', __( 'Shop Layout', '__x__' ), $list_section_layouts, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_shop_columns', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_shop_columns', 'radio', __( 'Shop Columns', '__x__' ), $list_shop_columns, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_shop_count', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_shop_count', 'text', __( 'Posts Per Page', '__x__' ), 'x_customizer_section_woocommerce' );


      //
      // Single product.
      //

      $x['set'][] = array( 'x_woocommerce_product_tabs_enable', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_product_tabs_enable', 'radio', __( 'Product Tabs', '__x__' ), $list_on_off, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_product_tab_description_enable', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_product_tab_description_enable', 'radio', __( 'Description Tab', '__x__' ), $list_on_off, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_product_tab_additional_info_enable', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_product_tab_additional_info_enable', 'radio', __( 'Additional Information Tab', '__x__' ), $list_on_off, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_product_tab_reviews_enable', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_product_tab_reviews_enable', 'radio', __( 'Reviews Tab', '__x__' ), $list_on_off, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_product_related_enable', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_product_related_enable', 'radio', __( 'Related Products', '__x__' ), $list_on_off, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_product_related_columns', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_product_related_columns', 'radio', __( 'Related Product Columns', '__x__' ), $list_shop_columns, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_product_related_count', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_product_related_count', 'text', __( 'Related Product Post Count', '__x__' ), 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_product_upsells_enable', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_product_upsells_enable', 'radio', __( 'Upsells', '__x__' ), $list_on_off, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_product_upsell_columns', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_product_upsell_columns', 'radio', __( 'Upsell Columns', '__x__' ), $list_shop_columns, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_product_upsell_count', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_product_upsell_count', 'text', __( 'Upsell Post Count', '__x__' ), 'x_customizer_section_woocommerce' );


      //
      // Cart.
      //

      $x['set'][] = array( 'x_woocommerce_cart_cross_sells_enable', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_cart_cross_sells_enable', 'radio', __( 'Cross Sells', '__x__' ), $list_on_off, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_cart_cross_sells_columns', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_cart_cross_sells_columns', 'radio', __( 'Cross Sell Columns', '__x__' ), $list_shop_columns, 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_cart_cross_sells_count', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_cart_cross_sells_count', 'text', __( 'Cross Sell Post Count', '__x__' ), 'x_customizer_section_woocommerce' );


      //
      // AJAX add to cart.
      //

      $x['set'][] = array( 'x_woocommerce_ajax_add_to_cart_color', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_ajax_add_to_cart_color', 'color', __( 'Icon Color', '__x__' ), 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_ajax_add_to_cart_bg_color', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_ajax_add_to_cart_bg_color', 'color', __( 'Background Color', '__x__' ), 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_ajax_add_to_cart_color_hover', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_ajax_add_to_cart_color_hover', 'color', __( 'Icon Color Hover', '__x__' ), 'x_customizer_section_woocommerce' );

      $x['set'][] = array( 'x_woocommerce_ajax_add_to_cart_bg_color_hover', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_ajax_add_to_cart_bg_color_hover', 'color', __( 'Background Color Hover', '__x__' ), 'x_customizer_section_woocommerce' );


      //
      // Widgets.
      //

      $x['set'][] = array( 'x_woocommerce_widgets_image_alignment', 'refresh' );
      $x['con'][] = array( 'x_woocommerce_widgets_image_alignment', 'radio', __( 'Image Alignment', '__x__' ), $list_left_right_positioning, 'x_customizer_section_woocommerce' );

  }


  //
  // Options - Social.
  //

      $x['set'][] = array( 'x_social_facebook', 'refresh' );
      $x['con'][] = array( 'x_social_facebook', 'text', __( 'Facebook Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_twitter', 'refresh' );
      $x['con'][] = array( 'x_social_twitter', 'text', __( 'Twitter Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_googleplus', 'refresh' );
      $x['con'][] = array( 'x_social_googleplus', 'text', __( 'Google+ Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_linkedin', 'refresh' );
      $x['con'][] = array( 'x_social_linkedin', 'text', __( 'LinkedIn Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_xing', 'refresh' );
      $x['con'][] = array( 'x_social_xing', 'text', __( 'XING Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_foursquare', 'refresh' );
      $x['con'][] = array( 'x_social_foursquare', 'text', __( 'Foursquare Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_youtube', 'refresh' );
      $x['con'][] = array( 'x_social_youtube', 'text', __( 'YouTube Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_vimeo', 'refresh' );
      $x['con'][] = array( 'x_social_vimeo', 'text', __( 'Vimeo Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_instagram', 'refresh' );
      $x['con'][] = array( 'x_social_instagram', 'text', __( 'Instagram Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_pinterest', 'refresh' );
      $x['con'][] = array( 'x_social_pinterest', 'text', __( 'Pinterest Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_dribbble', 'refresh' );
      $x['con'][] = array( 'x_social_dribbble', 'text', __( 'Dribbble Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_flickr', 'refresh' );
      $x['con'][] = array( 'x_social_flickr', 'text', __( 'Flickr Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_github', 'refresh' );
      $x['con'][] = array( 'x_social_github', 'text', __( 'GitHub Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_behance', 'refresh' );
      $x['con'][] = array( 'x_social_behance', 'text', __( 'Behance Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_tumblr', 'refresh' );
      $x['con'][] = array( 'x_social_tumblr', 'text', __( 'Tumblr Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_whatsapp', 'refresh' );
      $x['con'][] = array( 'x_social_whatsapp', 'text', __( 'Whatsapp Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_soundcloud', 'refresh' );
      $x['con'][] = array( 'x_social_soundcloud', 'text', __( 'SoundCloud Profile URL', '__x__' ), 'x_customizer_section_social' );

      $x['set'][] = array( 'x_social_rss', 'refresh' );
      $x['con'][] = array( 'x_social_rss', 'text', __( 'RSS Feed URL', '__x__' ), 'x_customizer_section_social' );


      //
      // Open Graph.
      //

      $x['set'][] = array( 'x_social_open_graph', 'refresh' );
      $x['con'][] = array( 'x_social_open_graph', 'radio', __( 'Enable Open Graph', '__x__' ), $list_on_off, 'x_customizer_section_social' );


      //
      // Social Fallback Image.
      //

      $x['set'][] = array( 'x_social_fallback_image', 'refresh' );
      $x['con'][] = array( 'x_social_fallback_image', 'image', __( 'Social Fallback Image', '__x__' ), 'x_customizer_section_social' );


  //
  // Options - Site Icons.
  //

      $x['set'][] = array( 'x_icon_favicon', 'refresh' );
      $x['con'][] = array( 'x_icon_favicon', 'text', __( 'Favicon (Set Path to Image Below)', '__x__' ), 'x_customizer_section_site_icons' );

      $x['set'][] = array( 'x_icon_touch', 'refresh' );
      $x['con'][] = array( 'x_icon_touch', 'image', __( 'Touch Icon (iOS and Android)', '__x__' ), 'x_customizer_section_site_icons' );

      $x['set'][] = array( 'x_icon_tile', 'refresh' );
      $x['con'][] = array( 'x_icon_tile', 'image', __( 'Tile Icon (Microsoft)', '__x__' ), 'x_customizer_section_site_icons' );

      $x['set'][] = array( 'x_icon_tile_bg_color', 'refresh' );
      $x['con'][] = array( 'x_icon_tile_bg_color', 'color', __( 'Tile Icon Background Color', '__x__' ), 'x_customizer_section_site_icons' );


  //
  // Options - Custom.
  //

      $x['set'][] = array( 'x_custom_styles', 'refresh' );
      $x['con'][] = array( 'x_custom_styles', 'cscodeeditor', __( 'Custom Code', '__x__' ), array( 'buttonText' => __( 'Edit Global CSS', '__x__' ), 'mode' => 'css' ), 'x_customizer_section_custom' );

      $x['set'][] = array( 'x_custom_scripts', 'refresh' );
      $x['con'][] = array( 'x_custom_scripts', 'cscodeeditor', __( 'Custom Code', '__x__' ), array( 'buttonText' => __( 'Edit Global JavaScript', '__x__' ), 'mode' => 'javascript', 'lint' => true ), 'x_customizer_section_custom' );


  //
  // Output - Sections.
  //

  foreach ( $x['sec'] as $section ) {

    $wp_customize->add_section( $section[0], array(
      'title'    => $section[1],
      'priority' => $section[2],
    ) );

  }


  //
  // Output - Settings.
  //

  foreach ( $x['set'] as $setting ) {

    $wp_customize->add_setting( $setting[0], array(
      'type'      => 'option',
      'default'   => $customizer_settings_data[$setting[0]],
      'transport' => $setting[1]
    ));

  }


  //
  // Output - Controls.
  //

  foreach ( $x['con'] as $control ) {

    static $i = 1;

    if ( $control[1] == 'radio' ) {

      $wp_customize->add_control( $control[0], array(
        'type'     => $control[1],
        'label'    => $control[2],
        'section'  => $control[4],
        'priority' => $i,
        'choices'  => $control[3]
      ));

    } elseif ( $control[1] == 'select' ) {

      $wp_customize->add_control( $control[0], array(
        'type'     => $control[1],
        'label'    => $control[2],
        'section'  => $control[4],
        'priority' => $i,
        'choices'  => $control[3]
      ));

    } elseif ( $control[1] == 'slider' ) {

      $wp_customize->add_control(
        new X_Customize_Control_Slider( $wp_customize, $control[0], array(
          'label'    => $control[2],
          'section'  => $control[4],
          'settings' => $control[0],
          'priority' => $i,
          'choices'  => $control[3]
        ))
      );

    } elseif ( $control[1] == 'text' ) {

      $wp_customize->add_control( $control[0], array(
        'type'     => $control[1],
        'label'    => $control[2],
        'section'  => $control[3],
        'priority' => $i
      ));

    } elseif ( $control[1] == 'textarea' ) {

      $wp_customize->add_control(
        new X_Customize_Control_Textarea( $wp_customize, $control[0], array(
          'label'    => $control[2],
          'section'  => $control[3],
          'settings' => $control[0],
          'priority' => $i
        ))
      );

    } elseif ( $control[1] == 'checkbox' ) {

      $wp_customize->add_control( $control[0], array(
        'type'     => $control[1],
        'label'    => $control[2],
        'section'  => $control[3],
        'priority' => $i
      ));

    } elseif ( $control[1] == 'color' ) {

      if ( class_exists( 'Cornerstone_Customize_Control_Huebert' ) ) {
        $class = 'Cornerstone_Customize_Control_Huebert';
      } else {
        $class = 'WP_Customize_Color_Control';
      }

      $wp_customize->add_control(
        new $class( $wp_customize, $control[0], array(
          'label'    => $control[2],
          'section'  => $control[3],
          'settings' => $control[0],
          'priority' => $i
        ))
      );
    } elseif ( $control[1] == 'cscodeeditor' ) {

      if ( class_exists( 'Cornerstone_Customize_Control_Code_Editor' ) ) {

        $wp_customize->add_control(
          new Cornerstone_Customize_Control_Code_Editor( $wp_customize, $control[0], array(
            'label'    => $control[2],
            'section'  => $control[4],
            'settings' => $control[0],
            'options'  => $control[3],
            'priority' => $i
          ))
        );

      } else {

        $wp_customize->add_control(
          new X_Customize_Control_Textarea( $wp_customize, $control[0], array(
            'label'    => $control[2],
            'section'  => $control[4],
            'settings' => $control[0],
            'priority' => $i
          ))
        );

      }

    } elseif ( $control[1] == 'image' ) {

      $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize, $control[0], array(
          'label'    => $control[2],
          'section'  => $control[3],
          'settings' => $control[0],
          'priority' => $i
        ))
      );

    }

    $i++;

  }

}

add_action( 'customize_register', 'x_customizer_options_register' );