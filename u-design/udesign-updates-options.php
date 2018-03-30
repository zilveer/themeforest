<?php 
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
	U-Design: Updates Options Page
        

        Contents:
	
		1. Default options
		2. Options menu
		3. Options page
		4. Register settings
		5. Section callbacks
		6. Settings callbacks
		7. Validate settings
                8. Miscellaneous functions

*/

global $udesign_theme_update_options;
$udesign_theme_update_options  = get_option('udesign_theme_update_options');


// 1. Default options

function udesign_theme_update_default_options() {
	$options = array(
                'input_theme_forest_username' => '',
                'input_theme_forest_api_key' => '',
	);
	return $options;
}


// 2. Options menu
function udesign_updates_options_menu() {
	global $submenu;
	$udesign_updates_admin_page =  add_submenu_page('udesign_options_page', 'Theme Update', 'Theme Update', who_can_edit_udesign_theme_options(), 'udesign_updates_options_page', 'updates_options_page_callback');
        // Load the required styles and scripts conditionally to this page only
        add_action('load-'.$udesign_updates_admin_page, 'load_udesign_updates_page_scripts');
}
add_action('admin_menu', 'udesign_updates_options_menu');

function load_udesign_updates_page_scripts () {
    // Enque styles
    wp_enqueue_style('udesign-udpates', get_template_directory_uri().'/scripts/admin/u-design-updates-page-styles.css', false, '1.0', 'screen');
}

        
// 3. Options page
function updates_options_page_callback() {
        
        global $udesign_theme_update_options; ?>
   
	<div class="wrap">
            <h1><?php _e('U-Design Theme Update Options', 'udesign'); ?></h1>
            <?php  //settings_errors('udesign_theme_update_options'); ?>

            
<?php       // do error checking and display notices 
            $user_name = $udesign_theme_update_options['input_theme_forest_username'];
            $api_key =  $udesign_theme_update_options['input_theme_forest_api_key'];

            if ( ! class_exists("Envato_Protected_API" )) {
                require_once( trailingslashit( get_template_directory() ) . "lib/updates/class-envato-api.php" );
            }
            $envato_protected_api = new Envato_Protected_API( $user_name, $api_key );
            $envato_protected_api->wp_list_themes( false ); // $allow_cache = false

            /* display API errors */
            $errors = $envato_protected_api->api_errors();
            if ( $errors ) {
                foreach ($errors as $k => $v) {
                    if ($k !== 'http_code' && ( $user_name || $api_key )) {
                        echo '<div class="error"><p>' . $v . '</p></div>';
                    }
                }
            }

            /* Display update messages */
            if ( empty( $errors ) ) {
                if ( isset($_GET['settings-updated']) || isset($_GET['updated']) ) {
                    echo '<div id="message" class="updated fade"><p><strong>'.esc_html__('Settings saved.', 'udesign').'</strong></p></div>';
                }
            }
?>
            
            <form  id="udesign_icon_fonts_submit_form" method="post" action="options.php">
                <h3 class="u-design-updater-page-headers"><span class="dashicons dashicons-update"></span> <?php esc_html_e('UPDATE WITH WORDPRESS UPDATES', 'udesign'); ?></h3>
                <?php settings_fields('udesign_theme_update_options'); ?>
                <?php do_settings_sections('udesign_theme_update_options'); ?>

                <div class="theme-update-submit-options-wrapper">

                    <div class="theme-update-submit">
                        <input type="submit" name="theme-update-submit" id="theme-update-submit" class="button button-primary udesign-left-submit-btn" value="<?php esc_attr_e('Save Changes', 'udesign') ?>"  />
                    </div>

                </div>
            </form>
            <div class="clear"></div>
            <div style="margin:20px 0 40px;">
                <?php printf( esc_html__('When a theme update is made available you will be notified and can update under the %s page.', 'udesign'), 
                    '<a title="'.esc_html__('Go to the Updates page', 'udesign').'" href="update-core.php">'.esc_html__('Dashboard &rarr; Updates', 'udesign').'</a>' );
                ?>
                <span class="description"><?php esc_html_e('Please note: If you have successfully registered the above Username and API Key and no updates are showing up under the "Dashboard &rarr; Updates" page, wait a few minutes and refresh the page. It is because the API connection may be cached in the database.', 'udesign' ); ?></span>
            </div>
            
<?php       u_design_alternative_update_methods_info(); ?>
            
            
	</div>
        
<?php 

}



// 4. Register settings

// tab 'theme_update'
function udesign_theme_update_register_settings() {
	
	if ( false == get_option('udesign_theme_update_options') ) {	
		add_option( 'udesign_theme_update_options', udesign_theme_update_default_options() );
	}
	register_setting('udesign_theme_update_options', 'udesign_theme_update_options', 'udesign_updates_validate_options');
	add_settings_section('field_udesign_theme_update', __( 'ThemeForest Account Information', 'udesign' ), 'field_udesign_theme_update_callback', 'udesign_theme_update_options');
	
	add_settings_field('input_theme_forest_username', __( 'ThemeForest Username:', 'udesign' ), 'input_theme_forest_username_callback', 'udesign_theme_update_options', 'field_udesign_theme_update');
	add_settings_field('input_theme_forest_api_key', __( 'Secret ThemeForest API Key:', 'udesign' ), 'input_theme_forest_api_key_callback', 'udesign_theme_update_options', 'field_udesign_theme_update');
        
}
add_action('admin_init', 'udesign_theme_update_register_settings');


// 5. Section callbacks

// tab 'theme_update'
function field_udesign_theme_update_callback() {
	echo '<p>';
        printf( esc_html__('In order to be able to update the theme you need to provide your ThemeForest Username and API Key for the account that you purchased the theme from. You can obtain an API key by visiting the %s (make sure that you are signed in) then clicking the "My Settings" tab. At the bottom of the page you will find your account\'s API key and a button to regenerate a new one if needed.', 'udesign'), 
                '<a title="'.esc_html__('Go to http://themeforest.net/', 'udesign').'" href="http://themeforest.net/" target="_blank">ThemeForest.net</a>' );
	echo '</p>';
}



// 6. Settings callbacks

// tab 'theme_update'
function input_theme_forest_username_callback() {
	$options = get_option('udesign_theme_update_options'); ?>
        
        <input type="text" name="udesign_theme_update_options[input_theme_forest_username]" id="input_theme_forest_username" value="<?php echo esc_attr($options['input_theme_forest_username']); ?>" size="32" />
        
        <?php 
}
function input_theme_forest_api_key_callback() {
	$options = get_option('udesign_theme_update_options'); ?>
        
        <input type="password" name="udesign_theme_update_options[input_theme_forest_api_key]" id="input_theme_forest_api_key" value="<?php echo esc_attr($options['input_theme_forest_api_key']); ?>" size="32" />
        
        <?php 
}



// 7. Validate settings
function udesign_updates_validate_options( $input ) {
	
        if ( isset( $input['input_theme_forest_username'] ) ) { $input['input_theme_forest_username'] = wp_filter_nohtml_kses( trim( $input['input_theme_forest_username'] ) ); }
        if ( isset( $input['input_theme_forest_api_key'] ) ) { $input['input_theme_forest_api_key'] = wp_filter_nohtml_kses( trim( $input['input_theme_forest_api_key'] ) ); }
        
    return $input;
}



// 8. Miscellaneous functions



// To debug uncomment the following line:
// set_site_transient('update_themes',null);
function udesign_themeforest_themes_update( $updates ) {
    if ( isset( $updates->checked ) ) {
        require_once( trailingslashit( get_template_directory() ) . "lib/updates/class-udesign-themes-updater.php" );
        global $udesign_theme_update_options;
        $username = $udesign_theme_update_options['input_theme_forest_username'];
        $apikey = $udesign_theme_update_options['input_theme_forest_api_key'];

        $envato_username = ( $username ) ? $username : null;
        $envato_api_key = ( $apikey ) ? $apikey : null;

        $updater = new UDesign_Theme_Updater( $envato_username, $envato_api_key );
        $updates = $updater->check( $updates );
    }
    return $updates;
}
add_filter( 'pre_set_site_transient_update_themes', 'udesign_themeforest_themes_update' );
    




function u_design_alternative_update_methods_info() {
    ob_start(); ?>
            <div class="clear"></div>

            <h3 class="u-design-updater-page-headers"><span class="dashicons dashicons-update"></span> <?php esc_html_e('ALTERNATIVE UPDATE METHODS', 'udesign'); ?></h3>

            <h3><?php esc_html_e('Manual update:', 'udesign'); ?></h3>
            <p><strong><?php esc_html_e('Please note:', 'udesign'); ?></strong> <?php printf( esc_html__('It\'s always a great idea to make a backup of the theme\'s folder %s, or better yet, a full backup of your site including the database before proceeding with an update.', 'udesign'),
                    '<strong>/wp-content/themes/u-design/</strong>'); ?></p>
            <p><?php printf( esc_html__('First you need to download the latest version of the %1$sU-Design Theme%2$s, for that log into your %3$s account used to purchase the theme and from your %4$sDownloads%5$s section grab the theme\'s latest zip.', 'udesign'),
                    '<a target="_blank" title="U-Design WordPress Premium Theme" href="http://themeforest.net/item/udesign-responsive-wordpress-theme/253220?ref=AndonDesign">', '</a>', 
                    '<a href="http://www.themeforest.net/" target="_blank">ThemeForest</a>', 
                    '<strong>', '</strong>' ); ?></p>
            <p><?php esc_html_e("Here's a couple of methods we usually recommend for updating the theme manually:", 'udesign'); ?></p>
            <ul>
                <li><span class="dashicons dashicons-admin-tools" style="color:#696969;"></span> <strong><?php esc_html_e('Method 1:', 'udesign'); ?></strong> <?php printf( esc_html__('You may simply drag-and-drop using your favorite FTP client the latest version of the theme (unzipped "u-design" folder) over the existing ones in your web server. This will overwrite the current theme files with the new ones (example: %s). That way if you have uploaded any additional files to the theme\'s folder, they will not be deleted.', 'udesign'),
                    '<a rel="nofollow" target="_blank" href="http://www.screenr.com/F7hs">http://www.screenr.com/F7hs</a>'); ?></li>
                <li><span class="dashicons dashicons-admin-tools" style="color:#696969;"></span> <strong><?php esc_html_e('Method 2:', 'udesign'); ?></strong> <?php printf( esc_html__('Go to %s section, activate another theme temporarily which will de-activate the "U-Design" theme automatically. At this point go ahead and delete the "U-Design" theme (don\'t worry, you will not lose any of your themes\' options since those are saved in the database). Then upload, install and activate the latest version of the "U-Design" theme as if doing it for the first time.', 'udesign'),
                    '<a title="Go to Appearance &rarr; Themes setion" href="' . admin_url() . 'themes.php" target="_blank">'.esc_html__('Appearance &rarr; Themes', 'udesign').'</a>'); ?></li>
            </ul>
            <p><?php printf( esc_html__('If you have any caching plugins active or server side caching or %s don\'t forget to clear the cache.', 'udesign'),
                    '<a href="http://en.wikipedia.org/wiki/Content_delivery_network" title="'.esc_html__('What is CDN?', 'udesign').'" target="_blank">CDN</a>'); ?></p>
            <p><span class="dashicons dashicons-info" style="color:#696969;"></span> <?php printf( esc_html__('Now, %1$sif you have modified any core theme files in the past%2$s (those could be CSS, PHP, JS or ther files) but you haven\'t been keeping track of your changes then you can use some \'diff\' tools to locate exactly what was modified and thus be able to re-apply those changes after the update. For your reference, it\'s always better to use a "child" theme for customizations that way your changes will be safe with future updates of the "parent" theme, we offer a "child" theme for U-Design %3$sHERE%4$s.', 'udesign'),
                    '<strong>', '</strong>',
                    '<a rel="nofollow" target="_blank" href="http://dreamthemedesign.com/u-design-support/discussion/692/who-wants-a-child-theme-for-u-designss">', '</a>' ); ?></p>
            <p><?php esc_html_e('For a full list of affected files in the latest release please refer to the theme\'s "Changelog".', 'udesign'); ?></p>
            <p><?php printf( esc_html__('Should you have any questions regarding theme updates feel free to post in the %1$ssupport forum%2$s.', 'udesign'),
                    '<a target="_blank" title="'.esc_html__('How do I update the theme!', 'udesign').'" href="http://dreamthemedesign.com/u-design-support/discussion/13/how-do-i-update-the-theme/p1">', '</a>'); ?></p>
<?php
    echo ob_get_clean();
}
