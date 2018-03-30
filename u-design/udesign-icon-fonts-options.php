<?php 
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
	U-Design: Icon Fonts Options Page
        

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

global $udesign_icon_fonts_options, $udesign_font_awesome_options;
$udesign_icon_fonts_options  = get_option('udesign_icon_fonts_options');
$udesign_font_awesome_options  = get_option('udesign_font_awesome_options');


// 1. Default options

// tab 'fontello'
function udesign_icon_fonts_default_options() {
	$options = array(
                'remove_fontello_folder' => '',
		'fontello_zip_upload_file_id' => '',
		'last_installed_fontello_filename' => '',
	);
	return $options;
}
// tab 'font_awesome'
function udesign_font_awesome_default_options() {
	$options = array(
                'udesign_disable_font_awesome' => '',
	);
	return $options;
}


// 2. Options menu
function udesign_icon_fonts_options_menu() {
	global $submenu;
	$udesign_icon_fonts_admin_page =  add_submenu_page('udesign_options_page', 'Icon Fonts', 'Icon Fonts', who_can_edit_udesign_theme_options(), 'udesign_icon_fonts_options_page', 'icon_fonts_options_page_callback');
        // Modify the default main page ("U-Design") submenu name
        if ( current_user_can( who_can_edit_udesign_theme_options() ) ) {
            $submenu['udesign_options_page'][0][0] = esc_attr__('Settings', 'udesign');
        }
        
        // Load the required styles and scripts conditionally to this page only
        add_action('load-'.$udesign_icon_fonts_admin_page, 'load_udesign_icon_fonts_page_scripts');
                
}
add_action('admin_menu', 'udesign_icon_fonts_options_menu');

function load_udesign_icon_fonts_page_scripts () {
    // Enque scripts and styles
    wp_enqueue_style('udesign-icon-fonts', get_template_directory_uri().'/scripts/admin/icon-fonts/icon-fonts-page-styles.css', false, '1.0', 'screen');
    // Enqueue the WP Media uploader
    wp_enqueue_media();
    wp_register_script('udesign-icon-fonts', get_template_directory_uri().'/scripts/admin/icon-fonts/icon-fonts-scripts.js', array('jquery'), '1.0', true);
    wp_enqueue_script('udesign-icon-fonts');
}


        
// 3. Options page
function icon_fonts_options_page_callback() {
        
	$tab = 'fontello';
	if ( isset( $_GET['tab'] ) ) $tab = $_GET['tab'];

        global $udesign_icon_fonts_options;
   
        /* Messages to display saved and reset */
        if ( isset($_GET['settings-updated']) || isset($_GET['updated']) ) {

            // if a fontello zip file has been uploaded go ahead and process it
            if ( get_attached_file( $udesign_icon_fonts_options['fontello_zip_upload_file_id'] ) ) {
                // first remove any previous installations if exist
                if ( udesign_is_fontello_installed() ) {
                    udesign_remove_fontello_home_directory();
                }
                // go ahead and install the uploaded fonts
                udesign_process_fontello_zip_file();
            }
            echo '<div id="message" class="updated fade"><p><strong>'.esc_html__('Settings saved.', 'udesign').'</strong></p></div>';
            if( isset( $udesign_icon_fonts_options['remove_fontello_folder'] ) && $udesign_icon_fonts_options['remove_fontello_folder'] == 'yes' ) {
                if ( udesign_is_fontello_installed() ) {
                    udesign_remove_fontello_home_directory();
                } else { ?>
                    <div class="error"><p><?php _e( "Nothing to delete! Fontello installation was not found.", 'udesign' ); ?></p></div><?php 
                }
            }
            
        } ?>

	<div class="wrap">
            <h1><?php _e('U-Design Icon Fonts Options', 'udesign'); ?></h1>
            <?php // settings_errors(); ?>

            <h2 class="nav-tab-wrapper">
                    <a href="?page=udesign_icon_fonts_options_page&tab=fontello" class="nav-tab <?php echo $tab == 'fontello' ? 'nav-tab-active' : ''; ?>"><?php echo 'Fontello'; ?></a>
                    <a href="?page=udesign_icon_fonts_options_page&tab=font_awesome" class="nav-tab <?php echo $tab == 'font_awesome' ? 'nav-tab-active' : ''; ?>"><?php echo 'Font Awesome'; ?></a>
            </h2>
		
<?php       if ( $tab == 'fontello' ) : ?>
            
		<form  id="udesign_icon_fonts_submit_form" method="post" action="options.php">
                        <?php settings_fields('udesign_icon_fonts_options'); ?>
                        <?php do_settings_sections('udesign_icon_fonts_options'); ?>
                    
                        <div class="fontello-submit-options-wrapper">
                            
                                <div id="fontello-zip-filename-display"> </div>

<?php                           if ( udesign_is_fontello_installed() ) : ?>
                                    <label for="remove_fontello_folder" class="remove-fontello-folder">
                                        <input name="udesign_icon_fonts_options[remove_fontello_folder]" type="checkbox" id="remove_fontello_folder" value="yes" />
                                        <?php esc_attr_e('Remove the Fontello Icon Fonts', 'udesign'); ?> &nbsp;&nbsp;
                                    </label>
                                    <div class="clear"></div>
                                    <span class="description" style="display:inline-block; margin:2px 0 10px"><?php esc_attr_e('Deleting or replacing the currently installed Fontallo icons would affect those icons used in your content, so don\'t forget to update your content accordingly.', 'udesign'); ?></span>
<?php                           endif; ?>
                                
                                <div class="clear"></div>
                                
                                <div class="fontello-submit">
                                    <input type="submit" name="fontello-submit" id="fontello-submit" 
                                           class="button button-primary udesign-left-submit-btn" 
                                                value="<?php esc_attr_e('Save Changes', 'udesign') ?>"  />
                                </div>
                                
                        </div>
		</form>

                <div class="clear"></div>

<?php           $demo_file_url = udesign_is_fontello_installed( 'demo.html' );
                if ( $demo_file_url ) : ?>
                    <div id="preview-fontello-fonts-section-wrapper">
                        <iframe id="test" src="<?php echo $demo_file_url; ?>" frameborder="0"  width="940" height="500"></iframe>
                        <div id="followingBallsG">
                            <div id="followingBallsG_1" class="followingBallsG"></div>
                            <div id="followingBallsG_2" class="followingBallsG"></div>
                            <div id="followingBallsG_3" class="followingBallsG"></div>
                            <div id="followingBallsG_4" class="followingBallsG"></div>
                        </div>
                    </div>
<?php           endif; ?>
            
<?php       elseif ( $tab == 'font_awesome' ) : ?>
                
                <h3><?php esc_html_e('General Information', 'udesign'); ?></h3>
                <a href="<?php echo get_template_directory_uri(); ?>/scripts/documentation/index.html#icon-fonts" title="Open the documentation" target="_blank"><?php esc_html_e('Icon Fonts Documentation', 'udesign'); ?></a>
                <p>
<?php               esc_html_e('By default the theme comes with Font Awesome icons already preloaded, so you don\'t have to do anything to install the fonts.', 'udesign'); ?>
                </p>
                
                <p style="padding: 10px 0 0 40px;">
<?php               printf( esc_html__('For your reference a full list of all the FA icons can be found at %s', 'udesign'), 
                        '<a title="'.esc_html__('The Icons List', 'udesign').'" href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">http://fortawesome.github.io/Font-Awesome/icons/</a>' ); ?>
                </p>
                <p style="padding: 5px 0 0 140px;">
                    <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/" title="The Icons List"><img src="<?php echo get_template_directory_uri(); ?>/styles/common-images/the-fa-icons-list.png" alt="the icons list" /></a>
                </p>
                
                <p style="padding: 20px 0 0 40px;">
<?php               printf( esc_html__('Here\'s some example uses from the Font Awesome website: %s', 'udesign'), 
                        '<a title="'.esc_html__('Font-Awesome Examples', 'udesign').'" href="http://fortawesome.github.io/Font-Awesome/examples/" target="_blank">http://fortawesome.github.io/Font-Awesome/examples/</a>' ); ?>
                </p>
                <p style="padding: 5px 0 30px 140px;">
                    <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/examples/" title="Font-Awesome Examples"><img src="<?php echo get_template_directory_uri(); ?>/styles/common-images/fa-examples.png" alt="fa examples" /></a>
                </p>
                
                <h3><?php esc_html_e('Usage Instructions within WordPress and the uDesign theme', 'udesign'); ?></h3>
                <p>
<?php               printf( esc_html__('Within WordPress you can place Font Awesome icons just about anywhere with the %s tag.', 'udesign'), '<code>&lt;i&gt;</code>' ); ?>
                </p>
                <p>
<?php               esc_html_e('I have also provided a button in each post/page editor to insert icons in your content directly. This option will allow you to select, style and generate your code:', 'udesign'); ?>
                </p>
                <p style="padding: 10px 0 0 40px;">
                    <img src="<?php echo get_template_directory_uri(); ?>/styles/common-images/add-icon-button.png" alt="select-icon-popup image" />
                </p>
                
                <h3><?php esc_html_e('The Shortcode', 'udesign'); ?></h3>
                <p>
<?php               esc_html_e('Font Awesome as well as Fontello icons can also be inserted in your content with a shortcode which is specific to the uDesign theme, example:', 'udesign'); ?>
                    <span style="display: block; margin:10px 10px 20px 20px;"><code>[udesign_icon_font name="fa fa-refresh"]</code></span>
                </p>
                <p>
<?php               esc_html_e('Specify the color:', 'udesign'); ?><br />
                    <span style="display: block; margin:10px 10px 20px 20px;"><code>[udesign_icon_font name="fa fa-refresh" color="#dd9933"]</code></span>
                </p>
                <p>
<?php               esc_html_e('To add animated spin use "fa-spin" for Font Awesome (and for Fontello icons use "animate-spin" instead):', 'udesign'); ?><br />
                    <span style="display: block; margin:10px 10px 20px 20px;"><code>[udesign_icon_font name="fa fa-refresh fa-spin" color="#dd9933"]</code></span>
                </p>
                <p>
<?php               esc_html_e('With "circle-wrap" added:', 'udesign'); ?><br />
                    <span style="display: block; margin:10px 10px 20px 20px;"><code>[udesign_icon_font name="fa fa-refresh circle-wrap" color="#dd9933"]</code></span>
                </p>
                <p>
<?php               esc_html_e('The size can be specified in the following way:', 'udesign'); ?><br />
                    <span style="display: block; margin:10px 10px 20px 20px;"><code>[udesign_icon_font name="fa fa-refresh" color="#4C4C4C" size="3.2em"]</code></span>
                </p>
                
                <p style="margin: 20px 0;">&nbsp;</p>
                
                <hr />
                
		<form id="udesign_font_awesome_submit_form" method="post" action="options.php">
                        <?php settings_fields('udesign_font_awesome_options'); ?>
                        <?php do_settings_sections('udesign_font_awesome_options'); ?>
                    
                        <div class="clear"></div>

                        <div class="font-awesome-submit">
                            <input type="submit" name="font-awesome-submit" id="font-awesome-submit" 
                                   class="button button-primary udesign-left-submit-btn" 
                                        value="<?php esc_attr_e('Save Changes', 'udesign') ?>"  />
                        </div>
		</form>
                
                <hr />
                
<?php       endif; ?>
            
	</div>
        
<?php 

}



// 4. Register settings

// tab 'fontello'
function udesign_icon_fonts_register_settings() {
	
	if ( false == get_option('udesign_icon_fonts_options') ) {	
		add_option( 'udesign_icon_fonts_options', udesign_icon_fonts_default_options() );
	}
	register_setting('udesign_icon_fonts_options', 'udesign_icon_fonts_options', 'udesign_icon_fonts_validate_options');
	add_settings_section('field_fontello_uploader', __( 'Fontello Icon Fonts Uploader', 'udesign' ), 'field_fontello_uploader_callback', 'udesign_icon_fonts_options');
	
	add_settings_field('icon_fonts_upload', __( 'Import the fonts:', 'udesign' ), 'icon_fonts_upload_button_callback', 'udesign_icon_fonts_options', 'field_fontello_uploader');
        
}
add_action('admin_init', 'udesign_icon_fonts_register_settings');

// tab 'font_awesome'
function udesign_font_awesome_register_settings() {
	
	if (false == get_option('udesign_font_awesome_options')) {	
		add_option('udesign_font_awesome_options', udesign_font_awesome_default_options());
	}
	register_setting('udesign_font_awesome_options', 'udesign_font_awesome_options', 'udesign_icon_fonts_validate_options');
	add_settings_section('field_font_awesome_options', __( 'Font Awesome Options', 'udesign' ), 'udesign_field_font_awesome_options_callback', 'udesign_font_awesome_options');
	
	add_settings_field('disable_font_awesome_checkbox', __( 'Disable Font Awesome', 'udesign' ), 'udesign_disable_font_awesome_checkbox_callback', 'udesign_font_awesome_options', 'field_font_awesome_options');
}
add_action('admin_init', 'udesign_font_awesome_register_settings');


// 5. Section callbacks

// tab 'fontello'
function field_fontello_uploader_callback() {
	echo '<p>'; ?>
        <a href="http://youtu.be/6zOJQBwnuhc" title="Video Tutorial" target="_blank"><?php esc_html_e('Video Tutorial', 'udesign'); ?></a> | 
        <a href="<?php echo get_template_directory_uri(); ?>/scripts/documentation/index.html#icon-fonts" title="Open the documentation" target="_blank"><?php esc_html_e('Icon Fonts Documentation', 'udesign'); ?></a>
        <div class="clear"></div> <?php 
        printf( esc_html__('Before you can use this section you will need to go to %s, choose the icon fonts you would like to include in the theme and then generate your zip file, upload the fontello zip file in the section below.', 'udesign'), 
                '<a title="'.esc_html__('Go to http://fontello.com/', 'udesign').'" href="http://fontello.com/" target="_blank">http://fontello.com/</a>' );
	echo '</p>';
}
// tab 'font_awesome'
function udesign_field_font_awesome_options_callback() {
	echo '<p>' . esc_html__('By default the Font Awesome fonts and styles are loaded within the theme. This means that the icons are available for your choosing in the page, post or anywhere else in your content. If you would like to remove Font Awesome from the available icon fonts, please use the option below to disable them:', 'udesign') . '</p>';
}
	



// 6. Settings callbacks

// tab 'fontello'
function icon_fonts_upload_button_callback() {
	$options = get_option('udesign_icon_fonts_options'); ?>
        
        <input id="icon_fonts_upload_button" type="button" value="<?php esc_attr_e('Upload Fontello "zip" File', 'udesign'); ?>" class="button-secondary" />
        <input type="hidden" name="udesign_icon_fonts_options[fontello_zip_upload_file_id]" id="fontello_zip_upload_file_id" value="<?php // leave blank (assigned from 'icon-fonts-scripts.js') ?>"  />
        <input type="hidden" name="udesign_icon_fonts_options[last_installed_fontello_filename]" id="last_installed_fontello_filename" value="<?php echo esc_attr($options['last_installed_fontello_filename']); ?>"  />
        
        
        <?php 
}

// tab 'font_awesome'
function udesign_disable_font_awesome_checkbox_callback() {
	$options = get_option('udesign_font_awesome_options'); ?>

        <label for="udesign_disable_font_awesome">
            <input name="udesign_font_awesome_options[udesign_disable_font_awesome]" type="checkbox" id="udesign_disable_font_awesome" value="yes" <?php checked('yes', $options['udesign_disable_font_awesome']); ?> />
            <?php esc_html_e("This will remove, unload any styles or files associated with the Font Awesome icons from the theme.", 'udesign'); ?>
        </label>

        <?php 
}


// 7. Validate settings
function udesign_icon_fonts_validate_options($input) {
	
        $input['remove_fontello_folder'] = $input['remove_fontello_folder'];
        if ( isset($input['fontello_zip_upload_file_id']) ) { $input['fontello_zip_upload_file_id'] = wp_filter_nohtml_kses($input['fontello_zip_upload_file_id']); }
        if ( isset($input['last_installed_fontello_filename']) ) { $input['last_installed_fontello_filename'] = wp_filter_nohtml_kses($input['last_installed_fontello_filename']); }
        $input['udesign_disable_font_awesome'] = $input['udesign_disable_font_awesome'];
        
    return $input;
}




// 8. Miscellaneous functions

/**
 * Process a fontello zip file:
 *  - initialize the WP_Filesystem
 *  - for security reasons move the fonts to a safer location outside the media's uploads directory:
 *      - create a folder to hold the fontello fonts under "wp-content/" directory
 *      - unzip the fontello files to the newly created "wp-content/fontello-icon-fonts/" folder 
 *  - delete the fontello zip file from the media library
 * 
 */
function udesign_process_fontello_zip_file() {
    
    global $udesign_icon_fonts_options;

    $access_type = get_filesystem_method();
    if ( $access_type === 'direct' ) {

        $creds = request_filesystem_credentials( site_url() . '/wp-admin/', '', false, false, array() );

        /* initialize the API */
        if ( ! WP_Filesystem( $creds ) ) {
            /* any problems and we exit */
            return false;
        }

        global $wp_filesystem;

        $attachment_id = $udesign_icon_fonts_options['fontello_zip_upload_file_id'];
        $wp_cont_dir = $wp_filesystem->wp_content_dir();

        $fontello_zip_file = get_attached_file( $attachment_id );
        
        if ( $fontello_zip_file ) {
            
            $to = $wp_cont_dir . 'fontello-icon-fonts/';
            
            // check if the folder $to exists if not create it
            if( ! $wp_filesystem->is_dir( $to ) ) {

                /* directory didn't exist, so let's create it */
                if ( ! $wp_filesystem->mkdir( $to ) ) { ?>

                        <div class="error"><p><?php printf( __('uDesign Error: There was an error creating the %s folder', 'udesign'), $to ); ?></p></div>
                        <?php
                }
                
                // Create a .htaccess file in the newly created fontello directory to beef up security
                $filename = trailingslashit( $to ).'.htaccess';
                $file_content = <<<EOF
# Disable Directory Indexes
Options -Indexes

# secure directory by disabling script execution
AddHandler cgi-script .php .php3 .php4 .php5 .pl .py .jsp .js .asp .htm .shtml .sh .cgi
Options -ExecCGI
EOF;
                // create a .htaccess file
                if ( ! $wp_filesystem->put_contents( $filename, $file_content, FS_CHMOD_FILE) ) {
                    echo 'uDesign Error: There was an error saving the .htaccess file!';
                }

            }
            
            // Unzip file
            $result = unzip_file( $fontello_zip_file, $to );
            if( $result !== true ){
                /* unzip failed. Handle Error */ ?>
                <div class="error"><p><?php _e( "uDesign Error: Unzipping the Fontello file failed!", 'udesign' ); ?></p></div>
                <?php
                return false;
            }
            
            // store the fonts in a transient for faster loading
            udesign_get_fontello_fonts_transient();
            
            // Remove the fontello zip from the media library
            wp_delete_attachment( $attachment_id, true );
            
        }

    } else {
        /* don't have direct write access. Prompt user with our notice */
        //add_action('admin_notices', 'icon_fonts_admin_notice_function'); ?>
        <div class="error"><p><?php _e( "uDesign Error: You don't have direct write permissions to the file system.", 'udesign' ); ?></p></div>
        <?php
        return false;
    }
    
}


/**
 * Remove the "wp-content/fontello-icon-fonts/" folder
 * 
 */
function udesign_remove_fontello_home_directory() {
    
    global $udesign_icon_fonts_options;
    
    $access_type = get_filesystem_method();
    if ( $access_type === 'direct' ) {

        $creds = request_filesystem_credentials( site_url() . '/wp-admin/', '', false, false, array() );

        /* initialize the API */
        if ( ! WP_Filesystem( $creds ) ) {
            /* any problems and we exit */
            return false;
        }

        global $wp_filesystem;
        
        $fontello_folder = $wp_filesystem->wp_content_dir() . 'fontello-icon-fonts/';
        
        // check if the folder $to exists if yes delete it
        if( $wp_filesystem->is_dir( $fontello_folder ) ) {

            if ( ! $wp_filesystem->rmdir( $fontello_folder, true ) ) { ?>
                <div class="error"><p><?php printf( __('uDesign Error: Deletion of %s folder failed!', 'udesign'), $fontello_folder ); ?></p></div>
                <?php
                return false;
            }
            // remove the fontello fonts transient
            udesign_delete_fontello_fonts_transient();
            // set the 'remove_fontello_folder' option to unchecked
            $udesign_icon_fonts_options['remove_fontello_folder'] = '';
            update_option( 'udesign_icon_fonts_options', $udesign_icon_fonts_options );
        }

    } else {
        /* don't have direct write access. Prompt user with our notice */
        //add_action('admin_notices', 'icon_fonts_admin_notice_function'); ?>
        <div class="error"><p><?php _e( "uDesign Error: You don't have direct write permissions to the file system.", 'udesign' ); ?></p></div>
        <?php
        return false;
    }
    
}




/**
 * This function to check whether the fontello installation folder exists (example: "wp-content/fontello-icon-fonts/"). 
 * If installed it will return the absolute path to the main install directory (default)
 * if a fonts demo file is passed as parameter it will return URL to it if exists
 * 
 * @param string $demo_file (optional) The demo file name (with extention) to check for, ex. "demo.html"
 * @return mixed false on failure, on success return the URL to the demo file if demo file is specified otherwise return the absolute path to the fontello install directory
 */
function udesign_is_fontello_installed( $demo_file = '' ) {
    global $udesign_icon_fonts_options;
    $fontello_install_directory = WP_CONTENT_DIR . '/fontello-icon-fonts';
    // if a demo file name is not specified then just check for install directory, otherwise check if both directory and file exist
    if ( $demo_file == '' ) {
        if ( is_dir( $fontello_install_directory ) ) {
            return $fontello_install_directory;
        }
    } else {
        if ( is_dir( $fontello_install_directory ) && file_exists( $fontello_install_directory  . '/' . $udesign_icon_fonts_options['last_installed_fontello_filename'] . '/' . $demo_file ) ) {
            return content_url() . '/fontello-icon-fonts/' . $udesign_icon_fonts_options['last_installed_fontello_filename'] . '/' . $demo_file;
        }
    }
    return false;
}

/**
 * Check if the default fontello.css style sheet exists where expected to be found
 * 
 * @param string $css_file (optional) The css file name (with extention) to check for, ex. "fontello.css"
 * @return mixed false on failure, on success return the URL to the requested css file (defaults to "fontello.css")
 */
function udesign_get_fontello_style_sheet( $css_file = 'fontello.css' ) {
    global $udesign_icon_fonts_options;
    $fontello_install_directory = WP_CONTENT_DIR . '/fontello-icon-fonts';
    if ( is_dir( $fontello_install_directory ) && file_exists( $fontello_install_directory  . '/' . $udesign_icon_fonts_options['last_installed_fontello_filename'] . '/css/' . $css_file ) ) {
        return content_url() . '/fontello-icon-fonts/' . $udesign_icon_fonts_options['last_installed_fontello_filename'] . '/css/' . $css_file;
    } ?>
    <div class="error"><p><?php printf( __('uDesign Error: %s file could not be found.', 'udesign'), $css_file ); ?></p></div><?php 
    return false;
}


/**
 * This function will return the currently installed fontello fonts URI (no trailing slash)
 * 
 * @return mixed false on failure, on success return the URI to the folder of the installed fontello fonts
 */
function udesign_get_installed_fontello_folder_uri() {
    global $udesign_icon_fonts_options;
    if ( udesign_is_fontello_installed() ) {
        return content_url() . '/fontello-icon-fonts/' . $udesign_icon_fonts_options['last_installed_fontello_filename'];
    }
    return false;
}

/**
 * Get the Fontello "config.json" file
 * 
 * @return mixed false on failure, on success return json decoded $results array
 */
function udesign_get_fontello_config_file() {
    
    global $udesign_icon_fonts_options;
    $fontello_install_directory = udesign_is_fontello_installed();
    
    if ( ! $fontello_install_directory ) {
        return false;
    }
    
    $fontello_config_file = $fontello_install_directory . '/' . $udesign_icon_fonts_options['last_installed_fontello_filename'] . '/config.json';
    
    if ( ! @is_file( $fontello_config_file ) ) {
        return false;
    }
    // By using output buffering include the config.json file's content into a string
    ob_start();
    include( $fontello_config_file );
    $fontello_config_file_contents = ob_get_clean();

    if ( ! $fontello_config_file_contents ) {
        ?><div class="error"><p><?php _e( "uDesign Error: The Fontello config file has no content.", 'udesign' ); ?></p></div><?php 
        return false;
    }
    
    $results = json_decode( $fontello_config_file_contents, true );

    if ( ! is_array( $results ) ) { ?>
        <div class="error"><p><?php _e( "uDesign Error: There was an issue decoding the Fontello config file.", 'udesign' ); ?></p></div><?php 
        return false;
    }
    
    return $results;
}

/**
 * Get the Fontello icons (sorted by icon name) in an array
 * 
 * @return mixed false on failure, on success return an array of the icons' names
 */
function udesign_fontello_icon_fonts_array() {
    $fontello_config_file = udesign_get_fontello_config_file();
    if( ! $fontello_config_file ) {
        return false;
    }
    $glyphs = $fontello_config_file['glyphs'];
    $fontello_icons = array();
    foreach( $glyphs as $glyph ) {
        $fontello_icons[] = $glyph['css'];
    }
    sort( $fontello_icons );
    return $fontello_icons;
}


/**
 * Get a transient with the installed fontello fonts (an array of the icons' names) 
 * with expiration of 1 year
 * 
 * @param bool $return (optional) If set to false will not return anything, otherwise will return an array of icons' names
 * @return array An array of icons' names (optional)
 */
function udesign_get_fontello_fonts_transient( $return = false ) {
    // Get any existing copy of our transient data
    if ( false === ( $udesign_fontello_icons = get_transient( 'udesign_fa_icons' ) ) ) {
        // It wasn't there, so regenerate the data and save the transient
        $udesign_fontello_icons = udesign_fontello_icon_fonts_array();
        set_transient( 'udesign_fa_icons', $udesign_fontello_icons, 1 * YEAR_IN_SECONDS );
    }
    if ( $return ) {
        return $udesign_fontello_icons;
    }
}

/**
 * Delete any existing copy of 'udesign_fa_icons' transient 
 * 
 */
function udesign_delete_fontello_fonts_transient() {
    
    delete_transient( 'udesign_fa_icons' );
    
}



/**
 * Get the Fontello icons css_prefix_text
 * 
 * @return mixed false on failure, on success return the css_prefix_text
 */
function udesign_fontello_css_prefix_text() {
    $fontello_config_file = udesign_get_fontello_config_file();
    if( ! $fontello_config_file ) {
        return false;
    }
    return $fontello_config_file['css_prefix_text'];
}



// Shortcode: U-Design Icon Fonts
// Usage: [udesign_icon_font_icon name="icon-emo-happy" color="#000000" size="1.2em"]
// To add annimation use: 
// [udesign_icon_font_icon name="icon-emo-happy animate-spin" color="#000000" size="1.2em"]
function udesign_icon_font_func( $atts ) {
    extract(shortcode_atts(array(
	    'name' => esc_html('icon-emo-happy'),
	    'color' => '',
	    'size' => '',
    ), $atts));
    if ( $color ) { $color = "color:{$color};"; }
    if ( $size ) { $size = "font-size:{$size};"; }
    $inline_styles = ( $color || $size ) ?  ' style="'.$color . $size.'"' : '';
    $html = '<i class="'.$name.'"'.$inline_styles.'></i>';
    return $html;
}
add_shortcode('udesign_icon_font', 'udesign_icon_font_func');




// if all icon fonts are disabled or not installed then do not load any icon fonts related scripts
if ( ! $udesign_font_awesome_options['udesign_disable_font_awesome'] || udesign_is_fontello_installed() ) {
    
    /* ONLY LOAD THE BELOW STYLES AND SCRIPTS ON ADMIN PAGES WITH TINYMCE EDITOR 
       'admin-ajax.php' check is for VC editor */
    global $pagenow;
    if ( 'post.php' === $pagenow || 'post-new.php' === $pagenow || 'admin-ajax.php' === $pagenow ) {

            function udesign_load_icon_fonts_wp_admin_scripts() {

                    global $udesign_font_awesome_options;

                    // load font awesome styles if enabled
                    if ( ! $udesign_font_awesome_options['udesign_disable_font_awesome'] ) {
                        wp_enqueue_style('u-design-font-awesome', get_template_directory_uri() . '/styles/common-css/font-awesome/css/font-awesome.min.css', false, UDESIGN_VERSION, 'screen');
                    }

                    // load fontello icon fonts styles
                    if ( udesign_is_fontello_installed() ) {
                        wp_enqueue_style('u-design-fontello', udesign_get_installed_fontello_folder_uri() . '/css/fontello.css', false, UDESIGN_VERSION, 'screen');
                        wp_enqueue_style('u-design-fontello-animation', udesign_get_installed_fontello_folder_uri() . '/css/animation.css', false, UDESIGN_VERSION, 'screen');
                    }

                    // load the select2 script css
                    wp_enqueue_style('u-design-select2', get_template_directory_uri() . '/scripts/admin/select2/css/select2.min.css', false, '4.0.2', 'screen');
                    // load the "select2" scripts
                    wp_enqueue_script('u-design-select2', get_template_directory_uri() . '/scripts/admin/select2/js/select2.min.js', array('jquery'), '4.0.2', true);

                    // load styles for the editor's thickbox popup
                    wp_enqueue_style('u-design-icon-fonts-editor-popup', get_template_directory_uri().'/scripts/admin/icon-fonts/icon-fonts-editor-popup-styles.css', false, UDESIGN_VERSION, 'screen');


            }
            add_action( 'admin_enqueue_scripts', 'udesign_load_icon_fonts_wp_admin_scripts' );

            // load the fontello style sheets in TinyMCE editor so the icons could be displayed in it
            function udesign_add_tmc_editor_styles() {
                    add_editor_style( udesign_get_installed_fontello_folder_uri() . '/css/fontello.css' );
                    add_editor_style( udesign_get_installed_fontello_folder_uri() . '/css/animation.css' );
            }
            add_action( 'after_setup_theme', 'udesign_add_tmc_editor_styles' );


            //============================================================================


            /* Include the TinyMCE Editor Button for the Icon Fonts */
            include( trailingslashit( get_template_directory() ) . 'scripts/admin/icon-fonts/icon-fonts-tc-editor-button.php' );

    }
    
}


