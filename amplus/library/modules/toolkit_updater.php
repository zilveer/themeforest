<?php
// register an action (can be any suitable action)
add_action('admin_init', 'on_admin_init');

function on_admin_init()
{
    // include the library
    include_once( BFI_LIBRARYPATH . 'includes/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php' );
    
    // use credentials used in toolkit plugin so that we don't have to show our own forms anymore
    $credentials = get_option( 'envato-wordpress-toolkit' );
    if ( empty($credentials['user_name']) || empty($credentials['api_key']) ) {
        return;
    }
    
    // check updates only after a long interval
    $lastCheck = bfi_get_option( 'last-toolkit-check' );
    if ( $lastCheck === false ) {
        bfi_update_option( 'last-toolkit-check', time() );
        return;
    }
    
    // intervl: 3 hours
    if ( ( time() - $lastCheck ) < 10800 ) {
        return;
    }
    
    bfi_update_option( 'last-toolkit-check', time() );
    
    $upgrader = new Envato_WordPress_Theme_Upgrader($credentials['user_name'], $credentials['api_key']);
    
    // check for updates
    $updates = $upgrader->check_for_theme_update();

    // add update alert, to update the theme
    if ( $updates->updated_themes_count ) {
        BFIAdminNotificationController::addNotification(
            sprintf( '<strong>An update to the theme (%s) is available! Head over to <a href="%s">Envato Toolkit</a> to update it now!</strong>',
                     BFI_THEMENAME,
                     admin_url() . 'admin.php?page=envato-wordpress-toolkit'
            ), 'custom');
    }

    /*
     *  Uncomment to update the current theme
     */
    
    // $upgrader->upgrade_theme();
}