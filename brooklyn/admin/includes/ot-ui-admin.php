<?php if ( ! defined( 'OT_VERSION') ) exit( 'No direct script access allowed' );
/**
 * Builds the Setting & Documentation UI.
 *
 * @uses      ot_register_settings()
 *
 * @package   OptionTree
 * @author    Derek Herman <derek@valendesigns.com>
 * @copyright Copyright (c) 2012, Derek Herman
 */
if ( function_exists( 'ot_register_settings' ) ) {

  ot_register_settings( array(
      array(
        'id'                  => 'option_tree_settings',
        'pages'               => apply_filters( 'ot_register_pages_array', array( 
          array( 
            'id'              => 'ot',
            'page_title'      => __( 'OptionTree', 'unitedthemes' ),
            'menu_title'      => __( 'OptionTree', 'unitedthemes' ),
            'capability'      => 'manage_options',
            'menu_slug'       => 'ot-settings',
            'icon_url'        => OT_URL . '/assets/images/ot-logo-mini.png',
            'position'        => 61,
            'hidden_page'     => true
          ),
          array(
            'id'              => 'settings',
            'parent_slug'     => 'ot-settings',
            'page_title'      => __( 'Settings', 'unitedthemes' ),
            'menu_title'      => __( 'Settings', 'unitedthemes' ),
            'capability'      => 'edit_theme_options',
            'menu_slug'       => 'ot-settings',
            'icon_url'        => null,
            'position'        => null,
            'updated_message' => __( 'Theme Options updated.', 'unitedthemes' ),
            'reset_message'   => __( 'Theme Options reset.', 'unitedthemes' ),
            'button_text'     => __( 'Save Settings', 'unitedthemes' ),
            'show_buttons'    => false,
            'screen_icon'     => 'themes',
            'sections'        => array(
              array(
                'id'          => 'import',
                'title'       => __( 'Import', 'unitedthemes' )
              ),
              array(
                'id'          => 'export',
                'title'       => __( 'Export', 'unitedthemes' )
              )
            ),
            'settings'        => array(
              array(
                'id'          => 'import_settings_text',
                'label'       => __( 'Settings', 'unitedthemes' ),
                'type'        => 'import-settings',
                'section'     => 'import'
              ),
              array(
                'id'          => 'import_data_text',
                'label'       => __( 'Theme Options', 'unitedthemes' ),
                'type'        => 'import-data',
                'section'     => 'import'
              ),             
              array(
                'id'          => 'export_settings_file_text',
                'label'       => __( 'Settings PHP File', 'unitedthemes' ),
                'type'        => 'export-settings-file',
                'section'     => 'export'
              ),
              array(
                'id'          => 'export_settings_text',
                'label'       => __( 'Settings', 'unitedthemes' ),
                'type'        => 'export-settings',
                'section'     => 'export'
              ),
              array(
                'id'          => 'export_data_text',
                'label'       => __( 'Theme Options', 'unitedthemes' ),
                'type'        => 'export-data',
                'section'     => 'export'
              ),
              
           )
          ),          
         ) 
        )
       )
      )
  );

}

/* End of file ot-ui-admin.php */
/* Location: ./option-tree/ot-ui-admin.php */