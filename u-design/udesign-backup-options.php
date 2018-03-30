<?php 
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Backup/Restore the U-Design Theme Options
 * 
 */


class udesign_backup_restore_theme_options {
    
        public $import_error_esponse = '';

	function udesign_backup_restore_theme_options() {
            add_action('admin_menu', array(&$this, 'udesign_backup_options_menu'));
	}
        function udesign_backup_options_menu() {
            $udesign_backups_admin_page =  add_submenu_page( 'udesign_options_page', 'Backup / Import', 'Backup / Import', who_can_edit_udesign_theme_options(), 'udesign_backup_options', array(&$this, 'udesign_backup_options_page_callback') );
            // Load the required styles and scripts conditionally to this page only
            add_action('load-'.$udesign_backups_admin_page, array(&$this, 'load_udesign_import_export'));
        }
	function load_udesign_import_export() {
            // Enque styles
            wp_enqueue_style('udesign-backup', get_template_directory_uri().'/scripts/admin/u-design-backup-page-styles.css', false, '1.0', 'screen');
            
            // Download backup
            if (isset($_POST['download']) && check_admin_referer('udesign_export_options', 'udesign_export_options')) {
                header("Cache-Control: public, must-revalidate");
                header("Pragma: hack");
                header("Content-Type: text/plain");
                header('Content-Disposition: attachment; filename="u-design-theme-options-'.date("Y-m-d_H-i-s").'.dat"');
                
                $include_widgets = isset( $_POST['udesign_backup_widgets'] ) ? 'yes': 'no';
                $the_options =  $this->_get_options( $include_widgets );
                if ( !is_serialized( $the_options ) ) { echo maybe_serialize($the_options); }
                die();
            } // Import backup
            elseif (isset($_POST['upload']) && check_admin_referer('udesign_restore_options', 'udesign_restore_options')) {
                
                $options_updated = '';
                
                if ($_FILES["file"]["error"] > 0) {
                    /* Uploaded file error */ 
                    $this->import_error_esponse = __( "uDesign Error: There was an issue with the uploaded file.", 'udesign' );
                    $this->import_admin_notice__error();
                    return false;
                } else {
                    
                    $access_type = get_filesystem_method();
                    if ( $access_type === 'direct' ) {
                        
                        $creds = request_filesystem_credentials( site_url() . '/wp-admin/', '', false, false, array() );
                        
                        /* initialize the API */
                        if ( ! WP_Filesystem( $creds ) ) {
                            /* any problems and we exit */
                            return false;
                        }

                        global $wp_filesystem;
                        $temp_file = $_FILES["file"]["tmp_name"];
                        
                        if ( $wp_filesystem->is_file( $temp_file ) ) {
                           
                            $uploaded_file = $wp_filesystem->get_contents( $temp_file );
                            
                            if ( $uploaded_file ) {
                                $options = maybe_unserialize( $uploaded_file );
                                if ( $options ) {
                                    foreach ($options as $option) {
                                        $imported_option_name = $option->option_name;
                                        $imported_option_value = maybe_unserialize($option->option_value);
                                        
                                        if ( $imported_option_name === 'udesign_options' ) { // U-Design Settings page options need special care
                                            global $udesign_options;
                                            foreach( $imported_option_value as $name => $value ) {
                                                $udesign_options[$name] = $value;
                                            }
                                            // Update the options
                                            update_option( $imported_option_name, $udesign_options );
                                            // Change the datestamp for custom_style.css so it can be updated with the new styles from the DB
                                            $custom_style_css_file = get_template_directory(). '/styles/custom/custom_style.css';
                                            $wp_filesystem->touch( $custom_style_css_file );
                                            
                                        } else {
                                            // Update other options
                                            update_option( $imported_option_name, $imported_option_value );
                                        }
                                        $options_updated = 'yes';
                                    }
                                } else {
                                    /* No options */
                                    $this->import_error_esponse = __( "uDesign Error: There are no options to import.", 'udesign' );
                                    $this->import_admin_notice__error();
                                    return false;
                                }
                                
                            } 
                        } else {
                            /* Invalid file */
                            $this->import_error_esponse = __( "uDesign Error: The file you uploaded is not a valid file.", 'udesign' );
                            $this->import_admin_notice__error();
                            return false;
                        }
                        
                    } else {
                        /* don't have direct write access. Prompt user with our notice */
                        $this->import_error_esponse = __( "uDesign Error: You don't have 'direct' access or write permissions to the file system.", 'udesign' );
                        $this->import_admin_notice__error();
                        return false;
                    }
                    
                }
                // display admin notice on successful import
                if ( $options_updated === 'yes' ) {
                    function import_admin_notice__success() { ?>
                        <div class="notice notice-success is-dismissible">
                            <p><?php esc_html_e('Settings imported successfully.', 'udesign'); ?></p>
                        </div>
                        <?php
                    }
                    add_action( 'admin_notices', 'import_admin_notice__success' );
                }

                // build the query to redirect to if needed
//                $redirect_url = add_query_arg( 
//                        array( 
//                            'page' => 'udesign_backup_options',
//                            //'options_updated' => $options_updated 
//                        ), 
//                        admin_url( 'admin.php' ) 
//                );
//                wp_safe_redirect( esc_url_raw( $redirect_url ) );
//                exit;
            }
	}
        
        // Import error admin notices
        public function error_notices_fn(){
            $error_message = $this->import_error_esponse;
            $class = 'notice notice-error';
            printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $error_message );
        }
        public function import_admin_notice__error() {
            add_action( 'admin_notices', array($this, 'error_notices_fn'));
        }
        
	function udesign_backup_options_page_callback() { ?>

		<div class="wrap">
                    
			<h2><?php esc_attr_e('U-Design Theme Backup/Restore Options', 'udesign'); ?></h2>
                        
			<form id="udesign_backup_options_submit_form" action="" method="post" enctype="multipart/form-data">
                            <h3 class="u-design-backup-page-headers"><span class="dashicons dashicons-download"></span> <?php esc_attr_e('Backup/Export', 'udesign'); ?></h3>
                            <p><?php esc_attr_e('By default the export function will grab the U-Design theme options, optionally you may also include all widgets in the export file.', 'udesign'); ?></p>

                            <?php 
                            ob_start(); ?>
                                <p><?php esc_attr_e('Here are the stored settings for the U-Design theme:', 'udesign'); ?></p>
                                <?php $the_options =  $this->_get_options( 'no' ); ?>
                                <p><textarea class="widefat code" rows="20" cols="100" onclick="this.select()"><?php if ( !is_serialized( $the_options ) ) { echo maybe_serialize($the_options); } ?></textarea></p>
                            <?php 
                            $stored_settings_textarea = ob_get_clean();
                            //echo $stored_settings_textarea; // comment out this line to disable the textarea showing the stored settings ?>
                            <p>
                                <label for="udesign_backup_widgets" class="udesign-backup-widgets">
                                    <input name="udesign_backup_widgets" type="checkbox" id="udesign_backup_widgets" value="yes" />
                                    <?php esc_attr_e('Back up all widgets as well.', 'udesign'); ?> &nbsp;&nbsp;
                                </label>
                            </p>
                            <p><input type="submit" name="download" id="download" class="button-secondary" value="<?php esc_attr_e('Download as file', 'udesign'); ?>" /></p>
                               <?php if (function_exists('wp_nonce_field')) wp_nonce_field('udesign_export_options', 'udesign_export_options'); ?>
			</form>
                        
			<form id="udesign_restore_options_submit_form" action="" method="post" enctype="multipart/form-data">
                            <h3 class="u-design-backup-page-headers"><span class="dashicons dashicons-upload"></span> <?php esc_attr_e('Restore/Import', 'udesign'); ?></h3>
                            <p><label class="description" for="upload"><?php esc_attr_e('Restore a previous backup.', 'udesign'); ?></label></p>
                            <p><input type="file" name="file" /> <input type="submit" name="upload" id="upload" class="button-primary" value="<?php esc_attr_e('Upload file', 'udesign'); ?>" /></p>
                            <?php if (function_exists('wp_nonce_field')) wp_nonce_field('udesign_restore_options', 'udesign_restore_options'); ?>
			</form>
		</div>

	<?php }
        
        
        
        
	function _display_options() {
		$options = maybe_unserialize($this->_get_options());
	}
	function _get_options( $include_widgets = 'no' ) {
		global $wpdb;
                if ( $include_widgets === 'yes' ) {
                    $sql = $wpdb->get_results(
                            "SELECT option_name, option_value "
                            . "FROM {$wpdb->options} "
                            . "WHERE option_name = 'udesign_options' " // get the 'udesign_options' from the wp_options table
                                    . "OR option_name = 'udesign_font_awesome_options' " // get the font awesome related option
                                    . "OR option_name LIKE 'widget_%' " // get all the widets
                                    . "OR option_name = 'sidebars_widgets'"); // contains information about which widget goes to which widget area
                } else { // exclude widgets
                    $sql = $wpdb->get_results(
                            "SELECT option_name, option_value "
                            . "FROM {$wpdb->options} "
                            . "WHERE option_name = 'udesign_options' " // get the 'udesign_options' from the wp_options table
                                    . "OR option_name = 'udesign_font_awesome_options'" ); // get the font awesome related option
                    
                }
                return $sql;
	}
}

new udesign_backup_restore_theme_options();

