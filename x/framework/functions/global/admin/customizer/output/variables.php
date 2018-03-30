<?php
 
// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/OUTPUT/VARIABLES.PHP
// -----------------------------------------------------------------------------
// Variables to be used across all Stacks for global CSS output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Layout and Design
//   01. Typography
//   02. Header
//   03. Buttons
// =============================================================================

// Layout and Design
// =============================================================================

$x_stack                               = x_get_stack();
$x_layout_site                         = x_get_option( 'x_layout_site' );
$x_layout_site_max_width               = x_get_option( 'x_layout_site_max_width' );
$x_layout_site_width                   = x_get_option( 'x_layout_site_width' );
$x_layout_content                      = x_get_option( 'x_layout_content' );
$x_layout_content_width                = x_get_option( 'x_layout_content_width' );
$x_layout_sidebar_width                = x_get_option( 'x_layout_sidebar_width' );
$x_design_bg_color                     = x_get_option( 'x_design_bg_color' );
$x_design_bg_image_pattern             = x_get_option( 'x_design_bg_image_pattern' );
$x_design_bg_image_full                = x_get_option( 'x_design_bg_image_full' );
$x_design_bg_image_full_fade           = x_get_option( 'x_design_bg_image_full_fade' );



// Typography
// =============================================================================

$x_body_font_family                    = x_get_option( 'x_body_font_family' );
$x_body_font_size                      = x_get_option( 'x_body_font_size' );
$x_body_font_weight_and_style          = x_get_option( 'x_body_font_weight' );
$x_body_font_color                     = x_get_option( 'x_body_font_color' );
$x_content_font_size                   = x_get_option( 'x_content_font_size' );
$x_headings_font_family                = x_get_option( 'x_headings_font_family' );
$x_headings_font_weight_and_style      = x_get_option( 'x_headings_font_weight' );
$x_headings_font_color                 = x_get_option( 'x_headings_font_color' );
$x_h1_letter_spacing                   = x_get_option( 'x_h1_letter_spacing' );
$x_h2_letter_spacing                   = x_get_option( 'x_h2_letter_spacing' );
$x_h3_letter_spacing                   = x_get_option( 'x_h3_letter_spacing' );
$x_h4_letter_spacing                   = x_get_option( 'x_h4_letter_spacing' );
$x_h5_letter_spacing                   = x_get_option( 'x_h5_letter_spacing' );
$x_h6_letter_spacing                   = x_get_option( 'x_h6_letter_spacing' );
$x_headings_uppercase_enable           = x_get_option( 'x_headings_uppercase_enable');
$x_headings_widget_icons_enable        = x_get_option( 'x_headings_widget_icons_enable');
$x_site_link_color                     = x_get_option( 'x_site_link_color' );
$x_site_link_color_hover               = x_get_option( 'x_site_link_color_hover' );
$x_logo_width                          = x_get_option( 'x_logo_width' );
$x_logo_font_family                    = x_get_option( 'x_logo_font_family' );
$x_logo_font_size                      = x_get_option( 'x_logo_font_size' );
$x_logo_font_weight_and_style          = x_get_option( 'x_logo_font_weight' );
$x_logo_font_color                     = x_get_option( 'x_logo_font_color' );
$x_logo_letter_spacing                 = x_get_option( 'x_logo_letter_spacing' );
$x_logo_uppercase_enable               = x_get_option( 'x_logo_uppercase_enable');
$x_navbar_font_family                  = x_get_option( 'x_navbar_font_family' );
$x_navbar_font_size                    = x_get_option( 'x_navbar_font_size' );
$x_navbar_font_weight_and_style        = x_get_option( 'x_navbar_font_weight' );
$x_navbar_link_color                   = x_get_option( 'x_navbar_link_color' );
$x_navbar_link_color_hover             = x_get_option( 'x_navbar_link_color_hover' );
$x_navbar_letter_spacing               = x_get_option( 'x_navbar_letter_spacing' );


//
// 1. Check if fonts are italic.
// 2. Remove 'italic' from setting output if it exists to provide us with just
//    the weight to work with.
// 3. Get the font stack.
//

$x_body_font_is_italic                 = x_is_font_italic( $x_body_font_weight_and_style );
$x_headings_font_is_italic             = x_is_font_italic( $x_headings_font_weight_and_style );
$x_logo_font_is_italic                 = x_is_font_italic( $x_logo_font_weight_and_style );
$x_navbar_font_is_italic               = x_is_font_italic( $x_navbar_font_weight_and_style );

$x_body_font_weight                    = x_get_font_weight( $x_body_font_weight_and_style );
$x_headings_font_weight                = x_get_font_weight( $x_headings_font_weight_and_style );
$x_logo_font_weight                    = x_get_font_weight( $x_logo_font_weight_and_style );
$x_navbar_font_weight                  = x_get_font_weight( $x_navbar_font_weight_and_style );

$x_body_font_stack                     = x_get_font_data( $x_body_font_family, 'stack' );
$x_headings_font_stack                 = x_get_font_data( $x_headings_font_family, 'stack' );
$x_logo_font_stack                     = x_get_font_data( $x_logo_font_family, 'stack' );
$x_navbar_font_stack                   = x_get_font_data( $x_navbar_font_family, 'stack' );



// Header
// =============================================================================

$x_navbar_positioning                  = x_get_navbar_positioning();
$x_fixed_menu_scroll                   = x_get_option( 'x_fixed_menu_scroll' );
$x_logo_adjust_navbar_top              = x_get_option( 'x_logo_adjust_navbar_top' );
$x_logo_adjust_navbar_side             = x_get_option( 'x_logo_adjust_navbar_side' );
$x_logo_navigation_layout              = x_get_option( 'x_logo_navigation_layout' );
$x_logobar_adjust_spacing_top          = x_get_option( 'x_logobar_adjust_spacing_top' );
$x_logobar_adjust_spacing_bottom       = x_get_option( 'x_logobar_adjust_spacing_bottom' );
$x_navbar_width                        = x_get_option( 'x_navbar_width' );
$x_navbar_height                       = x_get_option( 'x_navbar_height' );
$x_navbar_adjust_links_top             = x_get_option( 'x_navbar_adjust_links_top' );
$x_navbar_adjust_links_top_spacing     = x_get_option( 'x_navbar_adjust_links_top_spacing' );
$x_navbar_adjust_links_side            = x_get_option( 'x_navbar_adjust_links_side' );
$x_navbar_adjust_button                = x_get_option( 'x_navbar_adjust_button' );
$x_navbar_adjust_button_size           = x_get_option( 'x_navbar_adjust_button_size' );
$x_header_widget_areas                 = x_header_widget_areas_count();
$x_widgetbar_button_background         = x_get_option( 'x_widgetbar_button_background' );
$x_widgetbar_button_background_hover   = x_get_option( 'x_widgetbar_button_background_hover' );



// Buttons
// =============================================================================

$x_button_style                        = x_get_option( 'x_button_style' );
$x_button_shape                        = x_get_option( 'x_button_shape' );
$x_button_size                         = x_get_option( 'x_button_size' );
$x_button_color                        = x_get_option( 'x_button_color' );
$x_button_background_color             = x_get_option( 'x_button_background_color' );
$x_button_border_color                 = x_get_option( 'x_button_border_color' );
$x_button_bottom_color                 = x_get_option( 'x_button_bottom_color' );
$x_button_color_hover                  = x_get_option( 'x_button_color_hover' );
$x_button_background_color_hover       = x_get_option( 'x_button_background_color_hover' );
$x_button_border_color_hover           = x_get_option( 'x_button_border_color_hover' );
$x_button_bottom_color_hover           = x_get_option( 'x_button_bottom_color_hover' );

?>