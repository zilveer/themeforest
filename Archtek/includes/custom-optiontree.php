<?php

/***** OptionTree *****/
// Hide the "Settings" menu of OptionTree 
if ( ! function_exists( 'uxbarn_hide_ot_admin_menu' ) ) {
	
	function uxbarn_hide_ot_admin_menu() {
	    echo '<style type="text/css">#toplevel_page_ot-settings{display:none;}</style>';
	}
	
}



// To register OptionTree's "Theme Options" menu at the root of admin panel.
function ot_register_theme_options_page() {
  
    /* get the settings array */
    $get_settings = get_option( 'option_tree_settings' );
    
    /* sections array */
    $sections = isset( $get_settings['sections'] ) ? $get_settings['sections'] : array();
    
    /* settings array */
    $settings = isset( $get_settings['settings'] ) ? $get_settings['settings'] : array();
    
    /* contexual_help array */
    $contextual_help = isset( $get_settings['contextual_help'] ) ? $get_settings['contextual_help'] : array();
    
    /* build the Theme Options */
    if ( function_exists( 'ot_register_settings' ) && OT_USE_THEME_OPTIONS ) {
      
      ot_register_settings( array(
          array(
            'id'                  => 'option_tree',
            'pages'               => array( 
              array(
                'id'              => 'ot_theme_options',
                'parent_slug'     => '',
                'page_title'      => apply_filters( 'ot_theme_options_page_title', __( 'Theme Options', 'uxbarn' ) ),
                'menu_title'      => apply_filters( 'ot_theme_options_menu_title', __( 'Theme Options', 'uxbarn' ) ),
                'capability'      => $caps = apply_filters( 'ot_theme_options_capability', 'edit_theme_options' ),
                'menu_slug'       => apply_filters( 'ot_theme_options_menu_slug', 'ot-theme-options' ),
                'icon_url'        => apply_filters( 'ot_theme_options_icon_url', IMAGE_PATH . '/admin/uxbarn-admin-s.jpg' ),
                'position'        => apply_filters( 'ot_theme_options_position', null ),
                'updated_message' => apply_filters( 'ot_theme_options_updated_message', __( 'Theme Options updated.', 'uxbarn' ) ),
                'reset_message'   => apply_filters( 'ot_theme_options_reset_message', __( 'Theme Options reset.', 'uxbarn' ) ),
                'button_text'     => apply_filters( 'ot_theme_options_button_text', __( 'Save Changes', 'uxbarn' ) ),
                'screen_icon'     => 'themes',
                'contextual_help' => $contextual_help,
                'sections'        => $sections,
                'settings'        => $settings
              )
            )
          )
        ) 
      );
      
      // Filters the options.php to add the minimum user capabilities.
      add_filter( 'option_page_capability_option_tree', create_function( '$caps', "return '$caps';" ), 999 );
    
    }
  
}