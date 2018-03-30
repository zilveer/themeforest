<?php

// =============================================================================
// FUNCTIONS/GLOBAL/STACK-DATA.PHP
// -----------------------------------------------------------------------------
// Get stack information.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Get Option
//   02. Get Stack
//   03. Get Site Layout
//   04. Get Content Layout
//   05. Define Constants
//   06. Customizer Settings Keys / Defaults
// =============================================================================

// Get Option
// =============================================================================

if ( ! function_exists( 'x_get_option' ) ) :
  function x_get_option( $option, $default = false ) {

    GLOBAL $customizer_settings_data;

    $default = ( $default === false && isset( $customizer_settings_data[$option] ) ) ? $customizer_settings_data[$option] : $default;

    $output = get_option( $option, $default );

    return apply_filters( 'x_option_' . $option, $output );

  }
endif;



// Get Stack
// =============================================================================

if ( ! function_exists( 'x_get_stack' ) ) :
  function x_get_stack() {

    return x_get_option( 'x_stack' );

  }
endif;



// Get Site Layout
// =============================================================================

if ( ! function_exists( 'x_get_site_layout' ) ) :
  function x_get_site_layout() {

    return x_get_option( 'x_layout_site' );

  }
endif;



// Get Content Layout
// =============================================================================

//
// First checks if the global content layout is "full-width." If the global
// content layout is not "full-width," (i.e. displays a sidebar) then it runs
// through all possible pages to determine the correct layout for that template.
//

if ( ! function_exists( 'x_get_content_layout' ) ) :
  function x_get_content_layout() {

    $content_layout = x_get_option( 'x_layout_content' );

    if ( $content_layout != 'full-width' ) {
      if ( is_home() ) {
        $opt    = x_get_option( 'x_blog_layout' );
        $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
      } elseif ( is_singular( 'post' ) ) {
        $meta   = get_post_meta( get_the_ID(), '_x_post_layout', true );
        $layout = ( $meta == 'on' ) ? 'full-width' : $content_layout;
      } elseif ( x_is_portfolio_item() ) {
        $layout = 'full-width';
      } elseif ( x_is_portfolio() ) {
        $meta   = get_post_meta( get_the_ID(), '_x_portfolio_layout', true );
        $layout = ( $meta == 'sidebar' ) ? $content_layout : $meta;
      } elseif ( is_page_template( 'template-layout-content-sidebar.php' ) ) {
        $layout = 'content-sidebar';
      } elseif ( is_page_template( 'template-layout-sidebar-content.php' ) ) {
        $layout = 'sidebar-content';
      } elseif ( is_page_template( 'template-layout-full-width.php' ) ) {
        $layout = 'full-width';
      } elseif ( is_archive() ) {
        if ( x_is_shop() || x_is_product_category() || x_is_product_tag() ) {
          $opt    = x_get_option( 'x_woocommerce_shop_layout_content' );
          $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
        } else {
          $opt    = x_get_option( 'x_archive_layout' );
          $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
        }
      } elseif ( x_is_product() ) {
        $layout = 'full-width';
      } elseif ( x_is_bbpress() ) {
        $opt    = x_get_option( 'x_bbpress_layout_content' );
        $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
      } elseif ( x_is_buddypress() ) {
        $opt    = x_get_option( 'x_buddypress_layout_content' );
        $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
      } elseif ( is_404() ) {
        $layout = 'full-width';
      } else {
        $layout = $content_layout;
      }
    } else {
      $layout = $content_layout;
    }

    return $layout;

  }
endif;



// Define Constants
// =============================================================================

define( 'X_VERSION', '4.6.4' );
define( 'X_TEMPLATE_PATH', get_template_directory() );
define( 'X_TEMPLATE_URL', get_template_directory_uri() );
define( 'X_BBPRESS_IS_ACTIVE', class_exists( 'bbPress' ) );
define( 'X_BUDDYPRESS_IS_ACTIVE', class_exists( 'BuddyPress' ) );
define( 'X_CONTACT_FORM_7_IS_ACTIVE', class_exists( 'WPCF7_ContactForm' ) );
define( 'X_CONVERTPLUG_IS_ACTIVE', class_exists( 'Convert_Plug' ) );
define( 'X_ENVIRA_GALLERY_IS_ACTIVE', class_exists( 'Envira_Gallery' ) );
define( 'X_ESSENTIAL_GRID_IS_ACTIVE', class_exists( 'Essential_Grid' ) );
define( 'X_GRAVITY_FORMS_IS_ACTIVE', class_exists( 'GFForms' ) );
define( 'X_LAYERSLIDER_IS_ACTIVE', class_exists( 'LS_Sliders' ) );
define( 'X_REVOLUTION_SLIDER_IS_ACTIVE', class_exists( 'RevSlider' ) );
define( 'X_SOLILOQUY_IS_ACTIVE', class_exists( 'Soliloquy' ) );
define( 'X_VISUAL_COMOPSER_IS_ACTIVE', defined( 'WPB_VC_VERSION' ) );
define( 'X_WOOCOMMERCE_IS_ACTIVE', class_exists( 'WC_API' ) );
define( 'X_WPML_IS_ACTIVE', defined( 'ICL_SITEPRESS_VERSION' ) );
define( 'X_UBERMENU_IS_ACTIVE', class_exists( 'UberMenu' ) );
define( 'X_THE_GRID_IS_ACTIVE', class_exists( 'The_Grid_Plugin' ) );
define( 'X_EP_PAYMENT_FORM_IS_ACTIVE', class_exists( 'LFB_Core' ) );



// Customizer Settings Keys / Defaults
// =============================================================================

//
// Master list of Customizer option keys and default values used for creating
// backup files, resetting options, and for utilizing defaults if nothing is
// brought through from the Customizer (i.e. a user doesn't change an option).
//

$customizer_settings_data = array(
  'x_stack'                                             => 'integrity',
  'x_integrity_design'                                  => 'light',
  'x_integrity_topbar_transparency_enable'              => '',
  'x_integrity_navbar_transparency_enable'              => '',
  'x_integrity_footer_transparency_enable'              => '',
  'x_integrity_blog_header_enable'                      => '1',
  'x_integrity_blog_title'                              => __( 'The Blog', '__x__' ),
  'x_integrity_blog_subtitle'                           => __( 'Welcome to our little corner of the Internet. Kick your feet up and stay a while.', '__x__' ),
  'x_integrity_portfolio_archive_sort_button_text'      => __( 'Sort Portfolio', '__x__' ),
  'x_integrity_portfolio_archive_post_sharing_enable'   => '',
  'x_integrity_shop_header_enable'                      => '1',
  'x_integrity_shop_title'                              => __( 'The Shop', '__x__' ),
  'x_integrity_shop_subtitle'                           => __( 'Welcome to our online store. Take some time to browse through our items.', '__x__' ),
  'x_renew_topbar_background'                           => '#1f2c39',
  'x_renew_logobar_background'                          => '#2c3e50',
  'x_renew_navbar_background'                           => '#2c3e50',
  'x_renew_navbar_button_color'                         => '#ffffff',
  'x_renew_navbar_button_background'                    => '#3e5771',
  'x_renew_navbar_button_background_hover'              => '#476481',
  'x_renew_footer_background'                           => '#2c3e50',
  'x_renew_topbar_text_color'                           => '#ffffff',
  'x_renew_topbar_link_color_hover'                     => '#959baf',
  'x_renew_footer_text_color'                           => '#ffffff',
  'x_renew_blog_title'                                  => __( 'The Blog', '__x__' ),
  'x_renew_entry_icon_color'                            => '#dddddd',
  'x_renew_entry_icon_position'                         => 'standard',
  'x_renew_entry_icon_position_horizontal'              => '18',
  'x_renew_entry_icon_position_vertical'                => '25',
  'x_renew_shop_title'                                  => __( 'The Shop', '__x__' ),
  'x_icon_post_title_icon_enable'                       => '1',
  'x_icon_post_standard_colors_enable'                  => '',
  'x_icon_post_standard_color'                          => '#d1f2eb',
  'x_icon_post_standard_background'                     => '#16a085',
  'x_icon_post_image_colors_enable'                     => '',
  'x_icon_post_image_color'                             => '#d1eedd',
  'x_icon_post_image_background'                        => '#27ae60',
  'x_icon_post_gallery_colors_enable'                   => '',
  'x_icon_post_gallery_color'                           => '#d1eedd',
  'x_icon_post_gallery_background'                      => '#27ae60',
  'x_icon_post_video_colors_enable'                     => '',
  'x_icon_post_video_color'                             => '#e9daef',
  'x_icon_post_video_background'                        => '#8e44ad',
  'x_icon_post_audio_colors_enable'                     => '',
  'x_icon_post_audio_color'                             => '#cfd4d9',
  'x_icon_post_audio_background'                        => '#2c3e50',
  'x_icon_post_quote_colors_enable'                     => '',
  'x_icon_post_quote_color'                             => '#fcf2c8',
  'x_icon_post_quote_background'                        => '#f1c40f',
  'x_icon_post_link_colors_enable'                      => '',
  'x_icon_post_link_color'                              => '#f9d0cc',
  'x_icon_post_link_background'                         => '#c0392b',
  'x_icon_shop_title'                                   => __( 'The Shop', '__x__' ),
  'x_ethos_topbar_background'                           => '#222222',
  'x_ethos_navbar_background'                           => '#333333',
  'x_ethos_sidebar_widget_headings_color'               => '#333333',
  'x_ethos_sidebar_color'                               => '#333333',
  'x_ethos_post_carousel_enable'                        => '',
  'x_ethos_post_carousel_count'                         => '6',
  'x_ethos_post_carousel_display'                       => 'most-commented',
  'x_ethos_post_carousel_display_count_extra_large'     => '5',
  'x_ethos_post_carousel_display_count_large'           => '4',
  'x_ethos_post_carousel_display_count_medium'          => '3',
  'x_ethos_post_carousel_display_count_small'           => '2',
  'x_ethos_post_carousel_display_count_extra_small'     => '1',
  'x_ethos_post_slider_blog_enable'                     => '',
  'x_ethos_post_slider_blog_height'                     => '425',
  'x_ethos_post_slider_blog_count'                      => '5',
  'x_ethos_post_slider_blog_display'                    => 'most-commented',
  'x_ethos_post_slider_archive_enable'                  => '',
  'x_ethos_post_slider_archive_height'                  => '425',
  'x_ethos_post_slider_archive_count'                   => '5',
  'x_ethos_post_slider_archive_display'                 => 'most-commented',
  'x_ethos_filterable_index_enable'                     => '',
  'x_ethos_filterable_index_categories'                 => '',
  'x_ethos_shop_title'                                  => __( 'The Shop', '__x__' ),
  'x_layout_site'                                       => 'full-width',
  'x_layout_site_max_width'                             => '1200',
  'x_layout_site_width'                                 => '88',
  'x_layout_content'                                    => 'content-sidebar',
  'x_layout_content_width'                              => '72',
  'x_layout_sidebar_width'                              => '250',
  'x_design_bg_color'                                   => '#f3f3f3',
  'x_design_bg_image_pattern'                           => '',
  'x_design_bg_image_full'                              => '',
  'x_design_bg_image_full_fade'                         => '750',
  'x_google_fonts_subsets'                              => '',
  'x_google_fonts_subset_cyrillic'                      => '',
  'x_google_fonts_subset_greek'                         => '',
  'x_google_fonts_subset_vietnamese'                    => '',
  'x_body_font_family'                                  => 'Lato',
  'x_body_font_color'                                   => '#999999',
  'x_body_font_size'                                    => '14',
  'x_content_font_size'                                 => '14',
  'x_body_font_weight'                                  => '400',
  'x_headings_font_family'                              => 'Lato',
  'x_headings_font_color'                               => '#272727',
  'x_headings_font_weight'                              => '700',
  'x_h1_letter_spacing'                                 => '-0.035',
  'x_h2_letter_spacing'                                 => '-0.035',
  'x_h3_letter_spacing'                                 => '-0.035',
  'x_h4_letter_spacing'                                 => '-0.035',
  'x_h5_letter_spacing'                                 => '-0.035',
  'x_h6_letter_spacing'                                 => '-0.035',
  'x_headings_uppercase_enable'                         => '',
  'x_headings_widget_icons_enable'                      => '',
  'x_site_link_color'                                   => '#ff2a13',
  'x_site_link_color_hover'                             => '#d80f0f',
  'x_button_style'                                      => 'real',
  'x_button_shape'                                      => 'rounded',
  'x_button_size'                                       => 'regular',
  'x_button_color'                                      => '#ffffff',
  'x_button_background_color'                           => '#ff2a13',
  'x_button_border_color'                               => '#ac1100',
  'x_button_bottom_color'                               => '#a71000',
  'x_button_color_hover'                                => '#ffffff',
  'x_button_background_color_hover'                     => '#ef2201',
  'x_button_border_color_hover'                         => '#600900',
  'x_button_bottom_color_hover'                         => '#a71000',
  'x_navbar_positioning'                                => 'static-top',
  'x_logo_navigation_layout'                            => 'inline',
  'x_logobar_adjust_spacing_top'                        => '15',
  'x_logobar_adjust_spacing_bottom'                     => '15',
  'x_navbar_height'                                     => '90',
  'x_navbar_width'                                      => '235',
  'x_logo_font_family'                                  => 'Lato',
  'x_logo_font_color'                                   => '#272727',
  'x_logo_font_size'                                    => '42',
  'x_logo_font_weight'                                  => '700',
  'x_logo_letter_spacing'                               => '-0.035',
  'x_logo_uppercase_enable'                             => '',
  'x_logo'                                              => '',
  'x_logo_width'                                        => '',
  'x_logo_adjust_navbar_top'                            => '22',
  'x_logo_adjust_navbar_side'                           => '30',
  'x_navbar_font_family'                                => 'Lato',
  'x_navbar_link_color'                                 => '#999999',
  'x_navbar_link_color_hover'                           => '#272727',
  'x_navbar_font_size'                                  => '13',
  'x_navbar_font_weight'                                => '700',
  'x_navbar_letter_spacing'                             => '0.085',
  'x_navbar_uppercase_enable'                           => '1',
  'x_navbar_adjust_links_top'                           => '37',
  'x_navbar_adjust_links_top_spacing'                   => '20',
  'x_navbar_adjust_links_side'                          => '50',
  'x_header_search_enable'                              => '',
  'x_navbar_adjust_button_size'                         => '24',
  'x_navbar_adjust_button'                              => '20',
  'x_header_widget_areas'                               => '2',
  'x_widgetbar_button_background'                       => '#000000',
  'x_widgetbar_button_background_hover'                 => '#444444',
  'x_topbar_display'                                    => '',
  'x_topbar_content'                                    => '',
  'x_breadcrumb_display'                                => '1',
  'x_footer_widget_areas'                               => '3',
  'x_footer_bottom_display'                             => '1',
  'x_footer_menu_display'                               => '1',
  'x_footer_social_display'                             => '1',
  'x_footer_content_display'                            => '1',
  'x_footer_content'                                    => '<p>POWERED BY THE <a href="//theme.co/x/" title="X &ndash; The Ultimate WordPress Theme">X THEME</a></p>',
  'x_footer_scroll_top_display'                         => '',
  'x_footer_scroll_top_position'                        => 'right',
  'x_footer_scroll_top_display_unit'                    => '75',
  'x_blog_style'                                        => 'standard',
  'x_blog_layout'                                       => 'sidebar',
  'x_blog_masonry_columns'                              => '2',
  'x_archive_style'                                     => 'standard',
  'x_archive_layout'                                    => 'sidebar',
  'x_archive_masonry_columns'                           => '2',
  'x_blog_enable_post_meta'                             => '',
  'x_blog_enable_full_post_content'                     => '',
  'x_blog_excerpt_length'                               => '60',
  'x_custom_portfolio_slug'                             => 'portfolio-item',
  'x_portfolio_enable_cropped_thumbs'                   => '',
  'x_portfolio_enable_post_meta'                        => '1',
  'x_portfolio_tag_title'                               => __( 'Skills', '__x__' ),
  'x_portfolio_launch_project_title'                    => __( 'Launch Project', '__x__' ),
  'x_portfolio_launch_project_button_text'              => __( 'See it Live!', '__x__' ),
  'x_portfolio_share_project_title'                     => __( 'Share this Project', '__x__' ),
  'x_portfolio_enable_facebook_sharing'                 => '1',
  'x_portfolio_enable_twitter_sharing'                  => '1',
  'x_portfolio_enable_google_plus_sharing'              => '',
  'x_portfolio_enable_linkedin_sharing'                 => '',
  'x_portfolio_enable_pinterest_sharing'                => '',
  'x_portfolio_enable_reddit_sharing'                   => '',
  'x_portfolio_enable_email_sharing'                    => '',
  'x_bbpress_layout_content'                            => 'sidebar',
  'x_bbpress_enable_quicktags'                          => '',
  'x_bbpress_header_menu_enable'                        => '',
  'x_buddypress_layout_content'                         => 'sidebar',
  'x_buddypress_header_menu_enable'                     => '',
  'x_buddypress_activity_title'                         => __( 'Activity', '__x__' ),
  'x_buddypress_groups_title'                           => __( 'Groups', '__x__' ),
  'x_buddypress_blogs_title'                            => __( 'Sites', '__x__' ),
  'x_buddypress_members_title'                          => __( 'Members', '__x__' ),
  'x_buddypress_register_title'                         => __( 'Create An Account', '__x__' ),
  'x_buddypress_activate_title'                         => __( 'Activate Your Account', '__x__' ),
  'x_buddypress_activity_subtitle'                      => __( 'Meet new people, get involved, and stay connected.', '__x__' ),
  'x_buddypress_groups_subtitle'                        => __( 'Find others with similar interests and get plugged in.', '__x__' ),
  'x_buddypress_blogs_subtitle'                         => __( 'See what others are writing about. Learn something new and exciting today!', '__x__' ),
  'x_buddypress_members_subtitle'                       => __( 'Meet your new online community. Kick up your feet and stay awhile.', '__x__' ),
  'x_buddypress_register_subtitle'                      => __( 'Just fill in the fields below and we\'ll get a new account set up for you in no time!', '__x__' ),
  'x_buddypress_activate_subtitle'                      => __( 'You\'re almost there! Simply enter your activation code below and we\'ll take care of the rest.', '__x__' ),
  'x_woocommerce_header_menu_enable'                    => '',
  'x_woocommerce_header_cart_info'                      => 'outer-inner',
  'x_woocommerce_header_cart_style'                     => 'square',
  'x_woocommerce_header_cart_layout'                    => 'inline',
  'x_woocommerce_header_cart_adjust'                    => '30',
  'x_woocommerce_header_cart_content_inner'             => 'count',
  'x_woocommerce_header_cart_content_outer'             => 'total',
  'x_woocommerce_header_cart_content_inner_color'       => '#ffffff',
  'x_woocommerce_header_cart_content_inner_color_hover' => '#ffffff',
  'x_woocommerce_header_cart_content_outer_color'       => '#b7b7b7',
  'x_woocommerce_header_cart_content_outer_color_hover' => '#272727',
  'x_woocommerce_shop_layout_content'                   => 'sidebar',
  'x_woocommerce_shop_columns'                          => '3',
  'x_woocommerce_shop_count'                            => '12',
  'x_woocommerce_product_tabs_enable'                   => '1',
  'x_woocommerce_product_tab_description_enable'        => '1',
  'x_woocommerce_product_tab_additional_info_enable'    => '1',
  'x_woocommerce_product_tab_reviews_enable'            => '1',
  'x_woocommerce_product_related_enable'                => '1',
  'x_woocommerce_product_related_columns'               => '4',
  'x_woocommerce_product_related_count'                 => '4',
  'x_woocommerce_product_upsells_enable'                => '1',
  'x_woocommerce_product_upsell_columns'                => '4',
  'x_woocommerce_product_upsell_count'                  => '4',
  'x_woocommerce_cart_cross_sells_enable'               => '1',
  'x_woocommerce_cart_cross_sells_columns'              => '4',
  'x_woocommerce_cart_cross_sells_count'                => '4',
  'x_woocommerce_ajax_add_to_cart_color'                => '#545454',
  'x_woocommerce_ajax_add_to_cart_bg_color'             => '#000000',
  'x_woocommerce_ajax_add_to_cart_color_hover'          => '#ffffff',
  'x_woocommerce_ajax_add_to_cart_bg_color_hover'       => '#46a546',
  'x_woocommerce_widgets_image_alignment'               => 'left',
  'x_social_facebook'                                   => '',
  'x_social_twitter'                                    => '',
  'x_social_googleplus'                                 => '',
  'x_social_linkedin'                                   => '',
  'x_social_xing'                                       => '',
  'x_social_foursquare'                                 => '',
  'x_social_youtube'                                    => '',
  'x_social_vimeo'                                      => '',
  'x_social_instagram'                                  => '',
  'x_social_pinterest'                                  => '',
  'x_social_dribbble'                                   => '',
  'x_social_flickr'                                     => '',
  'x_social_github'                                     => '',
  'x_social_behance'                                    => '',
  'x_social_tumblr'                                     => '',
  'x_social_whatsapp'                                   => '',
  'x_social_soundcloud'                                 => '',
  'x_social_rss'                                        => '',
  'x_social_open_graph'                                 => '',
  'x_social_fallback_image'                             => '',
  'x_icon_favicon'                                      => '',
  'x_icon_touch'                                        => '',
  'x_icon_tile'                                         => '',
  'x_icon_tile_bg_color'                                => '#ffffff',
  'x_custom_styles'                                     => '',
  'x_custom_scripts'                                    => '',
  'x_fixed_menu_scroll'                                 => 'overflow-visible'
);
