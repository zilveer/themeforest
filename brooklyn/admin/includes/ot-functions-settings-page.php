<?php if ( ! defined( 'OT_VERSION' ) ) exit( 'No direct script access allowed' );
/**
 * OptionTree settings page functions.
 *
 * @package   OptionTree
 * @author    Derek Herman <derek@valendesigns.com>
 * @copyright Copyright (c) 2013, Derek Herman
 * @since     2.0
 */


/**
 * Import Settings option type.
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_import_settings' ) ) {
  
  function ot_type_import_settings() {
    
    echo '<form method="post" id="import-settings-form">';
      
      /* form nonce */
      wp_nonce_field( 'import_settings_form', 'import_settings_nonce' );
      
      /* format setting outer wrapper */
      echo '<div class="format-setting type-textarea has-desc">';
           
        /* description */
        echo '<div class="description">';
          
          echo '<p>' . __( 'To import your Settings copy and paste what appears to be a random string of alpha numeric characters into this textarea and press the "Import Settings" button.', 'option-tree' ) . '</p>';
          
          /* button */
          echo '<button class="option-tree-ui-button blue right hug-right">' . __( 'Import Settings', 'option-tree' ) . '</button>';
          
        echo '</div>';
        
        /* textarea */
        echo '<div class="format-setting-inner">';
          
          echo '<textarea rows="10" cols="40" name="import_settings" id="import_settings" class="textarea"></textarea>';

        echo '</div>';
        
      echo '</div>';
    
    echo '</form>';
    
  }
  
}

/**
 * Import Data option type.
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_import_data' ) ) {
  
  function ot_type_import_data() {
    
    echo '<form method="post" id="import-data-form">';
      
      /* form nonce */
      wp_nonce_field( 'import_data_form', 'import_data_nonce' );
        
      /* format setting outer wrapper */
      echo '<div class="format-setting type-textarea has-desc">';
        
        /* description */
        echo '<div class="description">';
          
          if ( OT_SHOW_SETTINGS_IMPORT ) echo '<p>' . __( 'Only after you\'ve imported the Settings should you try and update your Theme Options.', 'option-tree' ) . '</p>';
          
          echo '<p>' . __( 'To import your Theme Options copy and paste what appears to be a random string of alpha numeric characters into this textarea and press the "Import Theme Options" button.', 'option-tree' ) . '</p>';
          
          /* button */
          echo '<button class="option-tree-ui-button blue right hug-right">' . __( 'Import Theme Options', 'option-tree' ) . '</button>';
          
        echo '</div>';
        
        /* textarea */
        echo '<div class="format-setting-inner">';
          
          echo '<textarea rows="10" cols="40" name="import_data" id="import_data" class="textarea"></textarea>';

        echo '</div>';
        
      echo '</div>';
    
    echo '</form>';
    
  }
  
}

/**
 * Export Settings File option type.
 *
 * @return    string
 *
 * @access    public
 * @since     2.0.8
 */
if ( ! function_exists( 'ot_type_export_settings_file' ) ) {
  
  function ot_type_export_settings_file() {
    global $blog_id;
    
    echo '<form method="post" id="export-settings-file-form">';
    
      /* form nonce */
      wp_nonce_field( 'export_settings_file_form', 'export_settings_file_nonce' );
      
      /* format setting outer wrapper */
      echo '<div class="format-setting type-textarea simple has-desc">';
        
        /* description */
        echo '<div class="description">';
          
          echo '<p>' . sprintf( __( 'Export your Settings into a fully functional <code>theme-options.php</code> file by clicking this button. For more information on how to use this file read the theme mode %s. Remember, you should always check the file for errors before including it in your theme.', 'option-tree' ), '<a href="' . get_admin_url( $blog_id, 'admin.php?page=ot-documentation#section_theme_mode' ) . '"><code>OptionTree->Documentation</code></a>' ) . '</p>';
          
        echo '</div>';
          
        echo '<div class="format-setting-inner">';
            
          /* button */
          echo '<button class="option-tree-ui-button blue hug-left">' . __( 'Export Settings File', 'option-tree' ) . '</button>';
          
        echo '</div>';
        
      echo '</div>';
    
    echo '</form>';
    
  }
  
}

/**
 * Export Settings option type.
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_export_settings' ) ) {
  
  function ot_type_export_settings() {
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textarea simple has-desc">';
      
      /* description */
      echo '<div class="description">';
        
        echo '<p>' . __( 'Export your Settings by highlighting this text and doing a copy/paste into a blank .txt file. Then save the file for importing into another install of WordPress later. Alternatively, you could just paste it into the <code>OptionTree->Settings->Import</code> <strong>Settings</strong> textarea on another web site.', 'option-tree' ) . '</p>';
        
      echo '</div>';
        
      /* get theme options data */
      $settings = get_option( 'option_tree_settings' );
      $settings = ! empty( $settings ) ?  ot_encode( serialize( $settings ) ) : '';
        
      echo '<div class="format-setting-inner">';
        echo '<textarea rows="10" cols="40" name="export_settings" id="export_settings" class="textarea">' . $settings . '</textarea>';
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Export Data option type.
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_export_data' ) ) {
  
  function ot_type_export_data() {
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textarea simple has-desc">';
      
      /* description */
      echo '<div class="description">';
        
        echo '<p>' . __( 'Export your Theme Options data by highlighting this text and doing a copy/paste into a blank .txt file. Then save the file for importing into another install of WordPress later. Alternatively, you could just paste it into the <code>OptionTree->Settings->Import</code> <strong>Theme Options</strong> textarea on another web site.', 'option-tree' ) . '</p>';
        
      echo '</div>';
      
      /* get theme options data */
      $data = get_option( 'option_tree' );
      $data = ! empty( $data ) ? ot_encode( serialize( $data ) ) : '';
        
      echo '<div class="format-setting-inner">';
        echo '<textarea rows="10" cols="40" name="export_data" id="export_data" class="textarea">' . $data . '</textarea>';
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/* End of file ot-functions-settings-page.php */
/* Location: ./includes/ot-functions-settings-page.php */