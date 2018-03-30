<?php
/**************************************************************
 *                                                            *
 *   Provides a notification to the user everytime            *
 *   your WordPress theme is updated                          *
 *                                                            *
 *   Author: Joao Araujo                                      *
 *   Profile: http://themeforest.net/user/unisphere           *
 *   Follow me: http://twitter.com/unispheredesign            *
 *                                                            *
 **************************************************************/
 
 

// Constants for the theme name, folder and remote XML url
define( 'NOTIFIER_THEME_NAME', YIW_THEME_NAME ); // The theme name
define( 'NOTIFIER_THEME_FOLDER_NAME', YIW_THEME_FOLDER_NAME ); // The theme folder name
define( 'NOTIFIER_CACHE_INTERVAL', 21600 ); // The time interval for the remote XML cache in the database (21600 seconds = 6 hours)

global $yit_notifier_xml;
$yit_notifier_xml = get_latest_theme_version(NOTIFIER_CACHE_INTERVAL);


// Adds an update notification to the WordPress Dashboard menu
function update_notifier_menu() {  
    $xml = $GLOBALS['yit_notifier_xml']; // Get the latest remote XML file on our server
    
    // get version
    if ( function_exists( 'wp_get_theme' ) ) {
        $theme_data = wp_get_theme( get_template() );
        $version = $theme_data->version;    
    } else {
        $theme_data = get_theme_data(get_template_directory() . '/style.css');
        $version = $theme_data['Version'];
    }
    
    if ( ! is_object( $xml ) )
        return;

    if( version_compare($xml->latest, $version, '>') ) { // Compare current theme version with the remote XML version
            add_dashboard_page( NOTIFIER_THEME_NAME . ' Theme Updates', NOTIFIER_THEME_NAME . ' <span class="update-plugins count-1"><span class="update-count">1 Update</span></span>', 'administrator', 'theme-update-notifier', 'update_notifier');
    }
}
add_action('admin_menu', 'update_notifier_menu');  



// Adds an update notification to the WordPress 3.1+ Admin Bar
function update_notifier_bar_menu() {
    global $wp_admin_bar, $wpdb;

    if ( !is_super_admin() || !is_admin_bar_showing() ) // Don't display notification in admin bar if it's disabled or the current user isn't an administrator
    return;
    
    $xml = $GLOBALS['yit_notifier_xml']; // Get the latest remote XML file on our server
    
    // get version
    if ( function_exists( 'wp_get_theme' ) ) {
        $theme_data = wp_get_theme( get_template() );
        $version = $theme_data->version;    
    } else {
        $theme_data = get_theme_data(get_template_directory() . '/style.css');
        $version = $theme_data['Version'];
    }  
    
    if ( ! is_object( $xml ) )
        return;

    if( version_compare($xml->latest, $version, '>') ) { // Compare current theme version with the remote XML version
        $wp_admin_bar->add_menu( array( 'id' => 'update_notifier', 'title' => '<span>' . NOTIFIER_THEME_NAME . ' <span id="ab-updates">1 Update</span></span>', 'href' => get_admin_url() . 'index.php?page=theme-update-notifier' ) );
    }
}
add_action( 'admin_bar_menu', 'update_notifier_bar_menu', 1000 );



// The notifier page
function update_notifier() { 
    $xml = $GLOBALS['yit_notifier_xml']; // Get the latest remote XML file on our server
        
    // get version
    if ( function_exists( 'wp_get_theme' ) ) {
        $theme_data = wp_get_theme( get_template() );
        $version = $theme_data->version;    
    } else {
        $theme_data = get_theme_data(get_template_directory() . '/style.css');
        $version = $theme_data['Version'];
    } ?>
    
    <style>
        .update-nag { display: none; }
        #instructions {max-width: 670px;}
        h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
    </style>

    <div class="wrap">
    
        <div id="icon-tools" class="icon32"></div>
        <h2><?php echo NOTIFIER_THEME_NAME ?> Theme Updates</h2>
        <div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo NOTIFIER_THEME_NAME; ?> theme available.</strong> You have version <?php echo $version; ?> installed. Update to version <?php echo $xml->latest; ?>.</p></div>

        <img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" />
        
        <div id="instructions">
            <h3>Update Download and Instructions</h3>
            <p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <strong>/wp-content/themes/<?php echo NOTIFIER_THEME_FOLDER_NAME; ?>/</strong>. I also encourage you to make a full backup your site and database before performing an update.</p>
            <p>To get the latest update of the Theme, login to <a href="http://www.themeforest.net/">ThemeForest</a>, head over to your <strong>Downloads</strong> section and re-download the theme like you did when you bought it.</p>
            <p>Extract the contents of the zip file, look for the extracted theme folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/themes/<?php echo NOTIFIER_THEME_FOLDER_NAME; ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the theme files).</p>
            <p>If you didn't make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, slider images, etc.</p>
            <p>Now if you have modified files like CSS or some php files and you haven't kept track of your changes then you can use some 'diff' tools to compare the two versions' files and folders. That way you'd know exactly what files to update and where, line by line. Otherwise you'll loose your customizations.</p>
        </div>

        <h3 class="title">Changelog</h3>
        <?php echo $xml->changelog; ?>

    </div>
    
<?php } 



// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
function get_latest_theme_version($interval) {
    if (!function_exists('simplexml_load_string')) {
        return false;
    }

    $notifier_file_url = NOTIFIER_XML_FILE; 
    $db_cache_field = 'yiw-notifier-cache';
    $db_cache_field_last_updated = 'yiw-notifier-cache-last-updated';
    $last = get_option( $db_cache_field_last_updated );
    $now = time();
    // check the cache
    if ( !$last || (( $now - $last ) > $interval) ) {
        // cache doesn't exist, or is old, so refresh it
        if( function_exists('curl_init') ) { // if cURL is available, use it...
            $ch = curl_init($notifier_file_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $cache = curl_exec($ch);
            curl_close($ch);
        } else {
            $cache = @file_get_contents($notifier_file_url); // ...if not, use the common file_get_contents()
        }
        
        if ($cache) {           
            // we got good results  
            update_option( $db_cache_field, $cache );
            update_option( $db_cache_field_last_updated, time() );
        } 
        // read from the cache file
        $notifier_data = get_option( $db_cache_field );
    }
    else {
        // cache file is fresh enough, so read from it
        $notifier_data = get_option( $db_cache_field );
    }
    
    // Let's see if the $xml data was returned as we expected it to.
    // If it didn't, use the default 1.0.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
    if( strpos((string)$notifier_data, '<notifier>') === false ) {
        $notifier_data = file_get_contents( dirname(__FILE__) . '/default.xml' );
    }
    
    // Load the remote XML data into a variable and return it
    $xml = @simplexml_load_string($notifier_data); 
    
    return $xml;
}


// Remote communications
add_action( 'admin_notices', 'yit_notifier_communications' );
add_action( 'admin_head', 'yit_notifier_dismiss' );
add_action( 'switch_theme', 'yit_notifier_update_dismiss' );
add_action( 'admin_enqueue_scripts', 'yit_notifier_assets' );

/**
 * Show a notice with some communications sent from XML
 *
 * @return void
 * @since 1.0.0
 * @author Antonino Scarf� <antonino.scarfi@yithemes.com>
 */
function yit_notifier_communications() {
    $xml = $GLOBALS['yit_notifier_xml'];

    if ( ! isset( $xml->dashboard ) || get_user_meta( get_current_user_id(), 'yit_communication_dismissed_notice_' . $xml->dashboard['id'], true ) ) {
        return;
    }

    global $current_screen;

    ob_start(); ?>

        <?php echo $xml->dashboard ?>

        <p class="action_links">
            <strong>
                <a class="dismiss-notice" href="<?php echo esc_url( add_query_arg( 'yit-communication-dismiss', (string) $xml->dashboard['id'] ) ) ?>" target="_parent">Dismiss this notice</a>
            </strong>
        </p>

    <?php

    add_settings_error( 'yit-communication', 'yit-communication', ob_get_clean(), 'updated' );

    /** Admin options pages already output settings_errors, so this is to avoid duplication */
    if ( 'options-general' !== $current_screen->parent_base ) {
        settings_errors( 'yit-communication' );
    }
}

/**
 * Add dismissable admin notices.
 *
 * Appends a link to the admin nag messages. If clicked, the admin notice disappears and no longer is visible to users.
 *
 * @return void
 * @since 1.0.0
 * @author Antonino Scarf� <antonino.scarfi@yithemes.com>
 */
function yit_notifier_dismiss() {

    if ( isset( $_GET['yit-communication-dismiss'] ) )
        update_user_meta( get_current_user_id(), 'yit_communication_dismissed_notice_' . $_GET['yit-communication-dismiss'], 1 );

}

/**
 * Delete dismissable nag option when theme is switched.
 *
 * This ensures that the user is again reminded via nag of required
 * and/or recommended plugins if they re-activate the theme.
 *
 * @return void
 * @since 1.0.0
 * @author Antonino Scarf� <antonino.scarfi@yithemes.com>
 */
function yit_notifier_update_dismiss() {

    delete_user_meta( get_current_user_id(), 'yit_communication_dismissed_notice_' . $xml->dashboard['id'] );

}

function yit_notifier_assets() {
	wp_enqueue_style( 'tgm-messages', get_template_directory_uri() . '/core/theme-options/include/tgm-message.css' );
}