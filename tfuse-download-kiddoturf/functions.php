<?php

define('TFUSE_THEME_URI', get_template_directory_uri());

if (!class_exists('WP_Upgrader'))
    require ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

class TF_THEME_DOWNLOAD extends Theme_Upgrader {

    public  $theme_name             = 'KiddoTurf';
    public  $theme_prefix           = 'kiddoturf';
    public  $new_theme_prefix       = 'kiddo-turf-parent'; // directory name of the new installed theme
    public  $new_theme_prefix_child = 'kiddo-turf-child';
    public  $theme_license          = '0082988b27fe42194cc6d7fdba27337a';
    private $check_url              = 'http://themefuse.com/update-themes/';
    public  $downloader_prefix      = 'tfuse-download-kiddoturf'; // directory name, will be used for autodeletion
    private $disable_autodelete     = false; // Disable installer autodelete after theme is downloaded and installed
    private $updates                = array();

    public function __init() {
        add_action('admin_menu', array(&$this, 'item_menu_page'), 20);
        add_action('init', array(&$this, 'wp_init'));

        $this->updates = array(
            'Templates' => array(
                'title' => 'Theme Templates',
                'custom_destination' => false,
            ),
            'ThemeMods' => array(
                'title' => 'Theme Modules',
                'custom_destination' => false,
            ),
            'Framework' => array(
                'title' => 'ThemeFuse Framework',
                'custom_destination' => false,
            ),
            'ChildTheme'=> array(
                'title' => 'Child Theme',
                'custom_destination' => $this->new_theme_prefix_child // /themes/<custom_destination>
            ),
            'InstallDir'=> array(
                'title' => 'Live Preview Content',
                'custom_destination' => false,
            )
        );

        $this->redirect_after_activation();
        
        $this->tf_skin = new TF_SKIN();
        $this->tf_skin->set_option('title', sprintf('%s Theme Download & Installation', $this->theme_name ) );
    }
    
    public function wp_init(){
        wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', false, false, 'all');
    }

    function upgrade_strings() {
        parent::upgrade_strings();
        $this->strings['skin_before_update_header'] = __('Downloading %1$s (%2$d/%3$d)', 'tfuse');
        $this->strings['up_to_date']                = __('The package is at the latest version.', 'tfuse');
        $this->strings['remove_old']                = __('Removing the old version of the %s&#8230;', 'tfuse');
        $this->strings['remove_old_failed']         = __('Could not remove the old version of the ', 'tfuse');
        $this->strings['process_failed']            = __('Install failed.', 'tfuse');
        $this->strings['process_success']           = __('Package downloaded successfully.', 'tfuse');
        $this->strings['tf_backup']                 = __('Backing up files&#8230;', 'tfuse');
        $this->strings['tf_bk_mkdir_failed']        = __('Could not create backup directory.', 'tfuse');
        $this->strings['downloading_package']       = __('Downloading update...', 'tfuse');
    }

    function fs_connect($directories = array()) {
        global $wp_filesystem;
        if (false === ($credentials = $this->skin->request_filesystem_credentials()))
            return false;
        if (!WP_Filesystem($credentials)) {
            $error = true;
            if (is_object($wp_filesystem) && $wp_filesystem->errors->get_error_code())
                $error = $wp_filesystem->errors;
            $this->skin->request_filesystem_credentials($error); //Failed to connect, Error and request again
            return false;
        }

        if (!is_object($wp_filesystem)){
            return new WP_Error('fs_unavailable', $this->strings['fs_unavailable']);
        }

        if (is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->get_error_code()){
            return new WP_Error('fs_error', $this->strings['fs_error'], $wp_filesystem->errors);
        }

        foreach ((array) $directories as $dir) {
            switch ($dir) {
                case ABSPATH:
                    if (!$wp_filesystem->abspath()){
                        return new WP_Error('fs_no_root_dir', $this->strings['fs_no_root_dir']);
                    }
                    break;
                case WP_CONTENT_DIR:
                    if (!$wp_filesystem->wp_content_dir()){
                        return new WP_Error('fs_no_content_dir', $this->strings['fs_no_content_dir']);
                    }
                    break;
                case WP_PLUGIN_DIR:
                    if (!$wp_filesystem->wp_plugins_dir()){
                        return new WP_Error('fs_no_plugins_dir', $this->strings['fs_no_plugins_dir']);
                    }
                    break;
                case WP_CONTENT_DIR . '/themes':
                    if (!$wp_filesystem->find_folder(WP_CONTENT_DIR . '/themes') || !$wp_filesystem->wp_themes_dir() ){
                        return new WP_Error('fs_no_themes_dir', $this->strings['fs_no_themes_dir']);
                    }
                    break;
                default:
                    //error here
                    if (!$wp_filesystem->find_folder($dir)){
                        if (!$wp_filesystem->mkdir($dir, FS_CHMOD_DIR)){
                            return new WP_Error('fs_no_folder', sprintf($this->strings['fs_no_folder'], $dir));
                        }
                    }
                    break;
            }
        }
        return true;
    }
    
    function install_package($args = array()) {
        global $wp_filesystem;

        $defaults = array(
            'source'            => '', 
            'destination'       => '', //Please always pass these
            'clear_destination' => false, 
            'clear_working'     => false,
            'hook_extra'        => array()
        );

        $args = wp_parse_args($args, $defaults);
        extract($args);

        @set_time_limit(0);

        if (empty($source) || empty($destination))
            return new WP_Error('bad_request', $this->strings['bad_request']);

        $this->skin->feedback('installing_package');

        $res = apply_filters('upgrader_pre_install', true, $hook_extra);
        if (is_wp_error($res))
            return $res;

        //Retain the Original source and destinations
        $remote_source = $source;
        $local_destination = $destination;

        $source_files = array_keys($wp_filesystem->dirlist($remote_source));
        $remote_destination = $wp_filesystem->find_folder($local_destination);

        //Locate which directory to copy to the new folder, This is based on the actual folder holding the files.
        if (1 == count($source_files) && $wp_filesystem->is_dir(trailingslashit($source) . $source_files[0] . '/')) //Only one folder? Then we want its contents.
            $source = trailingslashit($source) . trailingslashit($source_files[0]);
        elseif (count($source_files) == 0)
            return new WP_Error('incompatible_archive', $this->strings['incompatible_archive']); //There are no files?
        //else //Its only a single file, The upgrader will use the foldername of this file as the destination folder. foldername is based on zip filename.
        //Hook ability to change the source file location..
        $source = apply_filters('upgrader_source_selection', $source, $remote_source, $this);
        if (is_wp_error($source))
            return $source;
        //Has the source location changed? If so, we need a new source_files list.
        if ($source !== $remote_source)
            $source_files = array_keys($wp_filesystem->dirlist($source));

        //Protection against deleting files in any important base directories.
        if (in_array($destination, array(ABSPATH, WP_CONTENT_DIR, WP_PLUGIN_DIR, WP_CONTENT_DIR . '/themes'))) {
            $remote_destination = trailingslashit($remote_destination) . trailingslashit(basename($source));
            $destination = trailingslashit($destination) . trailingslashit(basename($source));
        }

        // ThemeFuse Note: permitem stergea folderlelor framework, theme_config ...
        // dar nu permitem stergerea fisiereleor din tema, templaturile le vom scri peste, fara sa le stergem

        $template_location = trailingslashit($wp_filesystem->find_folder(WP_CONTENT_DIR . '/themes/' . get_template()));
        if ($clear_destination && $remote_destination !== $template_location) {
            //We're going to clear the destination if there's something there
            $this->skin->feedback('remove_old', $hook_extra['theme']);
            $removed = true;
            if ($wp_filesystem->exists($remote_destination))
                $removed = $wp_filesystem->delete($remote_destination, true);
            $removed = apply_filters('upgrader_clear_destination', $removed, $local_destination, $remote_destination, $hook_extra);

            if (is_wp_error($removed))
                return $removed;
            else if (!$removed)
                return new WP_Error('remove_old_failed', $this->strings['remove_old_failed']);
        } elseif ($wp_filesystem->exists($remote_destination) && $remote_destination != $template_location) {
            //If we're not clearing the destination folder and something exists there already, Bail.
            //But first check to see if there are actually any files in the folder.
            $_files = $wp_filesystem->dirlist($remote_destination);
            if (!empty($_files)) {
                $wp_filesystem->delete($remote_source, true); //Clear out the source files.
                return new WP_Error('folder_exists', $this->strings['folder_exists'], $remote_destination);
            }
        }
        //Create destination if needed
        if (!$wp_filesystem->exists($remote_destination)) {
            if (!$wp_filesystem->mkdir($remote_destination, FS_CHMOD_DIR) && 'ftpext' != get_filesystem_method(array(),$remote_destination)) {
                return new WP_Error('mkdir_failed', $this->strings['mkdir_failed'], $remote_destination);
            } elseif (!$wp_filesystem->find_folder(untrailingslashit($remote_destination))) {
                return new WP_Error('fs_no_folder', sprintf($this->strings['fs_no_folder'], $remote_destination));
            }
        }

        // Copy new version of item into place.
        $result = copy_dir($source, $remote_destination);
        if (is_wp_error($result)) {
            if ($clear_working)
                $wp_filesystem->delete($remote_source, true);
            return $result;
        }

        //Clear the Working folder?
        if ($clear_working)
            $wp_filesystem->delete($remote_source, true);

        $destination_name = basename(str_replace($local_destination, '', $destination));
        if ('.' == $destination_name)
            $destination_name = '';

        $this->result = compact('local_source', 'source', 'source_name', 'source_files', 'destination', 'destination_name', 'local_destination', 'remote_destination', 'clear_destination', 'delete_source_dir');

        $res = apply_filters('upgrader_post_install', true, $hook_extra, $this->result);
        if (is_wp_error($res)) {
            $this->result = $res;
            return $res;
        }

        //Bombard the calling function will all the info which we've just used.
        return $this->result;
    }

    function bulk_upgrade($updates) {
        
        global $wp_filesystem;

        @set_time_limit(0);

        $this->init();
        $this->bulk = true;
        $this->upgrade_strings();

        add_filter('update_bulk_theme_complete_actions', array(&$this, 'bulk_footer'));

        $this->tf_skin->header();
        // Connect to the Filesystem first.
        $res = $this->fs_connect(array(WP_CONTENT_DIR));
        if (!$res) {
            $this->tf_skin->footer();
            return false;
        }

        echo '<form method="post" id="tfuse-hidden-credentials" >';
        echo '<input type="hidden" name="tf-download" value="true">';
            require('views/ftp_hidden_credentials.php');
            wp_nonce_field('themefuse-bulk-download');
        echo '</form>';
        
        $this->tf_skin->components_header();
        
        if( !( $current = $this->themefuse_update_check() )){
            $this->tf_skin->components_footer();
            
            $this->tf_skin->error( '<br/>'.__('Cannot connect to ThemeFuse server', 'tfuse'), true);
            exit();
        }
        
        foreach ($updates as $update) {
            $this->tf_skin->components_item($update, htmlentities( $this->updates[$update]['title'], ENT_QUOTES, 'UTF-8'));
        }
        $this->tf_skin->components_footer();
        
        if (!current_user_can('update_themes')){
            $this->tf_skin->error( '<br/>'.__('Current user has no permissions for updating themes', 'tfuse'), true );
            return;
        }

        $current_step   = ( ( $current_step = intval( @$_GET['tfuse_download_step'] ) ) < 1 ? 1 : $current_step );
        $skipped        = false; // if step > 1

        $this->update_count     = count($updates);
        $this->update_current   = 0;
        foreach ($updates as $update) {
            $this->update_current++;

            if( $this->update_current < $current_step ) {
                if (!isset($current->response[$this->theme_prefix][$update])) {
                    if(in_array($update, array('InstallDir','ChildTheme')) ){ // Continue instalation if package is not required
                        $this->tf_skin->components_item_set_status($update, 'error' );
                        $skipped = true;
                        continue;
                    } else {
                        $this->tf_skin->error( __('Required package is not available.', 'tfuse'), true);
                        return;
                    }
                } else {
                    $this->tf_skin->components_item_set_status($update, 'done');
                    $skipped = true;
                    continue;
                }
            }

            if ( $skipped ){
            }

            if( ($this->update_current >= $current_step+1) || (!isset( $current->response[$this->theme_prefix][$update] )) ){
                echo('<script type="text/javascript" >
                        jQuery("form#tfuse-hidden-credentials").attr("action","'.self_admin_url('admin.php?page=themefuse_download_theme'.'&tfuse_download_step='.($current_step+1) ) .'").submit();
                     </script>');
                exit();
            }

            $this->tf_skin->components_item_set_status($update, 'loading');
            $this->tf_skin->set_main_status( __('Now downloading', 'tfuse').': <b>'.htmlentities($this->updates[$update]['title'], ENT_QUOTES, 'UTF-8').'</b>' );

            $r = $current->response[$this->theme_prefix][$update];

            $dest = !empty($r['dest']) ? $r['dest'] : '';

            if( isset( $this->updates[$update] ) && false !== $this->updates[$update]['custom_destination'] ){
                // Custom
                $destination    = $wp_filesystem->wp_themes_dir() . $this->updates[$update]['custom_destination'];
            } else {
                // Default
                $destination    = $wp_filesystem->wp_themes_dir() . $this->new_theme_prefix . $dest; 
            }
            $options        = array(
                'package'           => $r['package'],
                'destination'       => $destination,
                'clear_destination' => false,
                'clear_working'     => true,
                'hook_extra'        => array(
                    'theme'         => $this->updates[$update]['title']
                )
            );
            
            $result = $this->run($options);

            unset($this->skin->result);

            if( is_wp_error( $result ) || false === $result ){
                $this->tf_skin->error( __('Error while installing component', 'tfuse'), true );
                return;
            }
        }
        
        if( $this->update_current == $current_step ){ // Last refresh
            if(!isset($result) || $result){
                echo('<script type="text/javascript" >
                        jQuery("form#tfuse-hidden-credentials").attr("action","'.self_admin_url('admin.php?page=themefuse_download_theme'.'&tfuse_download_step='.($current_step+1) ).'").submit();
                    </script>');
            }
            exit();
        } elseif( $this->update_current+1 >= $current_step ) {

            $child_theme_destination = false;
            if( isset($this->updates['ChildTheme']) && $this->updates['ChildTheme']['custom_destination'] ){
                $child_theme_destination    = $wp_filesystem->wp_themes_dir() . $this->updates['ChildTheme']['custom_destination'];
            } elseif( isset( $current->response[$this->theme_prefix]['ChildTheme'] ) ) {
                $child_theme_destination    = $wp_filesystem->wp_themes_dir() . $this->new_theme_prefix . ( !empty($current->response[$this->theme_prefix]['ChildTheme']['dest']) ? $current->response[$this->theme_prefix]['ChildTheme']['dest'] : '' );
            }

            if( $child_theme_destination !== false && $wp_filesystem->exists(untrailingslashit($child_theme_destination)) ){
                switch_theme( $this->new_theme_prefix, $this->new_theme_prefix_child );
            } else {
                switch_theme( $this->new_theme_prefix, $this->new_theme_prefix );
            }

            if( ! $this->disable_autodelete ){
                $wp_filesystem->delete( trailingslashit( $wp_filesystem->wp_themes_dir() . $this->downloader_prefix ), true);
            }
            
            echo('<script type="text/javascript" >document.location="'.self_admin_url('admin.php?page='.(
                    get_option($this->theme_prefix.'_tfuse_framework_options')
                    ? 'themefuse'
                    : 'tf_import' 
                )).'"</script>');
            exit;
        }

        $this->tf_skin->footer();

        return false;
    }

    public function item_menu_page(){
        add_menu_page('ThemeFuse', $this->theme_name, 'manage_options', 'themefuse_download_theme', array(&$this, 'page_download'), TFUSE_THEME_URI . '/images/framework-icon.png');
    }

    public function page_download(){

        if( isset($_POST['tf-download']) ){

            check_admin_referer('themefuse-bulk-download');

            // Output download process page

            $this->bulk_upgrade( array_keys($this->updates) );

        } else {
            // Output download form
            require('views/download_page.php');
        }
    }

    function update_params()
    {
        global $wp_version, $wpdb;
        $params = array(
            'theme_name'        => $this->theme_name,
            'prefix'            => $this->theme_prefix,
            'framework_version' => '0',
            'mods_version'      => '0',
            'theme_version'     => '0',

            'install_dir'       => 'yes',
            'child_theme'       => 'yes',
            'theme_license'     => $this->theme_license,

            'wp_version'        => $wp_version,
            'php_version'       => phpversion(),
            'mysql_version'     => $wpdb->db_version(),
            'uri'               => network_home_url(),
            'locale'            => get_locale(),
            'is_multi'          => is_multisite(),
            'is_child'          => is_child_theme()
        );
        return $params;
    }

    /**
     * This function pings an http://themefuse.com/ asking if a new
     * version of this theme is available. If not, it returns FALSE.
     * If so, the external server passes serialized data back to this
     * function, which gets unserialized and returned for use.
     *
     * @since 2.0
     */
    function themefuse_update_check() {
        if (!current_user_can('update_themes'))
            return false;

        $url            = $this->check_url;
        $update_params  = $this->update_params();
        $options        = array(
            'body'  => $update_params
        );

        $request    = wp_remote_post($url, $options);
        $response   = wp_remote_retrieve_body($request);

        $themefuse_update   = new stdClass();
        $themefuse_update->last_checked = time();

        // If an error occurred, return FALSE, store for 1 hour
        if ($response == 'error' || is_wp_error($response) || !is_serialized($response)) {
            return false;
        }

        // Else, unserialize
        $themefuse_update->response[$this->theme_prefix] = maybe_unserialize($response);

        // Verify if updates for this theme are not suspended from themefuse
        if (!empty($themefuse_update->response[$this->theme_prefix]['suspended']))
            return false;

        //tf_print($themefuse_update);
        return $themefuse_update;
    }

    function redirect_after_activation() {
        global $pagenow;

        if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
            header('Location: ' . admin_url() . 'admin.php?page=themefuse_download_theme');
        }
    }
}

$TF_THEME_DOWNLOAD = new TF_THEME_DOWNLOAD();
$TF_THEME_DOWNLOAD->__init();

class TF_SKIN { // Custom skin elements for this installer
    
    private $done_header = false; // if header was set
    private $done_footer = false;
    private $options     = array();
    
    public function __construct() {
    }
    public function __destruct() {
        if( isset($this->options['components_header_done']) && !isset($this->options['components_footer_done']) ){
            $this->components_footer();
        }
        if( $this->done_header && !$this->done_footer ){
            $this->footer();
        }
    }
    
    public function set_option($id, $value){
        $this->options[$id] = $value;
    }
    
	public function header($title = '', $icon_type = 'tools') {
		if ( $this->done_header )
			return;
		$this->done_header = true;
        
        if( $title ){
            $this->options['title'] = $title;
        } else {
            $title = (string)@$this->options['title'];
        }
        
		echo '<div class="wrap">';
		echo screen_icon($icon_type);
		echo '<h2>' . $title . '</h2>';
	}
	public function footer() {
		if ( !$this->done_header )
			return;
		if ( $this->done_footer )
			return;
		$this->done_footer = true;
		echo '</div>';
	}
    
    public function error($message, $error_title = false) {
		if ( ! $this->done_header )
			$this->header();
        echo '
        <div class="tf-error">
            <span>'.$message.'</span>
        </div>';
        
        if( $error_title ){
            echo '<script type="text/javascript">
                var $ = jQuery;
                $("#tf-install-main-status").html(\'<span class="tf-main-error">Oops, something went wrong. This is most likely because your server is blocking our downloading and installing scripts.<br/>Don’t worry, you can still install the theme but it needs to be done manually. <a href="http://themefuse.com/faq/how-to-install-your-new-original-themefuse-wordpress-theme-2" target="_blank">Please follow this step by step tutorial</a> to learn how to do it.</span>\');
            </script>';
        }
    }
    public function set_main_status($message){
        echo '<script type="text/javascript">
            var $ = jQuery;
            $("#tf-install-main-status").html(\''.$message.'\');
        </script>';
    }
    
    public function components_header(){
		if ( isset($this->options['components_header_done']) )
			return;
        $this->options['components_header_done'] = true;
        echo '
            <div class="tf-components-block" >
                <h4>'.__('Installing Components', 'tfuse').'</h4>
                <ul>';
    }
    public function components_footer(){
		if ( !isset($this->options['components_header_done']) )
			return;
		if ( isset($this->options['components_footer_done']) )
			return;
        $this->options['components_footer_done'] = true;
        echo '</ul>
            </div>
            <div id="tf-install-main-status"></div>';
    }
    
    public function components_item($id, $title, $done = false){
		$this->components_header();
        
        $item_id = 'tf-install-component-'.$id;
        
        $this->set_option('last_active_item_id', $item_id);
        
        echo '<li id="'.$item_id.'" class="'.($done ? 'done' : '').'"><img src="'.( $done ? get_template_directory_uri().'/images/done.png' : get_template_directory_uri().'/images/empty.gif' ).'" border="0" /><span class="in">'.$title.'</span></li>';
    }
    public function components_item_set_status($id, $status){
        
        $img_src    = get_template_directory_uri() . '/images/empty.gif';
        
        switch($status){
            case 'done':
                $img_src    = get_template_directory_uri() . '/images/done.png';
                $class      = 'done';
            break;
            case 'loading':
                $img_src    = get_template_directory_uri() . '/images/loader.gif';
                $class      = '';
            break;
            case 'error':
                $class      = 'error';
            break;
            default:
                $class      = '';                
        }
        $item_id    = 'tf-install-component-'.$id;
        
        echo '<script type="text/javascript">
            var $ = jQuery;
            $("li#'.$item_id.'").attr("class","'.$class.'");
            $("li#'.$item_id.' img").attr("src","'.$img_src.'");
            </script>';
    }
}
