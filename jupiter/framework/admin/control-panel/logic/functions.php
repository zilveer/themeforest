<?php
class mk_artbees_products
{

    public function __construct()
    {

        $this->store_theme_current_version();

        $this->api_url = 'https://artbees.net/api/v1/';

        add_action('wp_ajax_abb_get_templates_action', array(&$this,
            'abb_get_templates_action',
        ));
        add_action('wp_ajax_abb_install_template_action', array(&$this,
            'abb_install_template_action',
        ));
        if (mk_is_control_panel())
        {
            add_action('admin_enqueue_scripts', array(&$this,
                'enqueue',
            ));
        }

        add_action('wp_ajax_abb_import_demo_action', array(&$this,
            'abb_import_demo_action',
        ));
        add_action('wp_ajax_abb_delete_template', array(&$this,
            'abb_delete_template',
        ));

        add_filter('upload_mimes', array(&$this,
            'mime_types',
        ));
    }

    /**
     *
     * Enqueue styles and scripts
     *
     */
    public function enqueue()
    {
        $theme_version = get_option('mk_jupiter_theme_current_version');
        wp_enqueue_style('theme-style', THEME_ADMIN_ASSETS_URI . '/stylesheet/css/min/theme-backend-styles.css');
        wp_enqueue_style('control-panel-styles', THEME_CONTROL_PANEL_ASSETS . '/css/style.css', false, $theme_version, 'all');
        wp_enqueue_script('artbees-uploader', THEME_CONTROL_PANEL_ASSETS . '/js/uploader.min.js', false, $theme_version, 'all');
        wp_enqueue_script('control-panel-scripts', THEME_CONTROL_PANEL_ASSETS . '/js/script.js', false, $theme_version, 'all');
    }

    /**
     * This hook will allow wordpress to accept .zip formats in media library
     *
     * @author      Bob Ulusoy
     */
    public function mime_types($mimes)
    {
        $mimes['zip'] = 'application/zip';
        return $mimes;
    }

    /**
     *
     * Artbees API Key Verifier
     */
    public function verify_artbees_apikey($apikey)
    {

        $data = array(
            'timeout'     => 10,
            'httpversion' => '1.1',
            'body'        => array(
                'apikey' => $apikey,
                'domain' => $_SERVER['SERVER_NAME'],
            ),
        );

        $query = wp_remote_post($this->api_url . 'verify', $data);
        if (!is_wp_error($query))
        {
            $result = json_decode($query['body'], true);
            return $result;
        }
        else
        {
            return array(
                "message" => $query->get_error_message() . ' Please contact Artbees Support',
            );
        }

        return $result;
    }

    /**
     * Stores theme current version into options table to be used in multiple instances
     *
     */
    public function store_theme_current_version()
    {

        if (function_exists('wp_get_theme'))
        {
            $theme_data    = wp_get_theme(get_option('template'));
            $theme_version = $theme_data->Version;
        }
        else
        {
            $theme_data    = get_theme_data(TEMPLATEPATH . '/style.css');
            $theme_version = $theme_data['Version'];
        }

        if (get_option('mk_jupiter_theme_current_version') != $theme_version)
        {

            update_option('mk_jupiter_theme_current_version', $theme_version);
        }
    }

    /**
     *
     *
     * Check if Current Customer is verified
     *
     *
     */
    public function is_verified_artbees_customer($localhost = true)
    {

        $result = $this->verify_artbees_apikey(get_option('artbees_api_key'));

        if (defined('MK_DEV'))
        {
            return true;
        }

        if (self::isLocalHost() && $localhost == true)
        {
            return true;
        }

        return ($result['status'] == 202 ? true : false);
    }

    public function is_api_key_exists($localhost = true)
    {

        $api_key = get_option('artbees_api_key');

        if (!empty($api_key))
        {
            return true;
        }

        if (defined('MK_DEV'))
        {
            return true;
        }

        if (self::isLocalHost() && $localhost == true)
        {
            return true;
        }

        return false;

    }

    public function register_product_url()
    {
        return admin_url('admin.php?page=register-product');
    }

    /**
     *
     *
     * Delete macos hidden folder from tempaltes directory
     *
     */
    public function abb_delete_directory($dir)
    {
        if (!file_exists($dir))
        {
            return true;
        }

        if (!is_dir($dir))
        {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item)
        {
            if ($item == '.' || $item == '..')
            {
                continue;
            }

            if (!$this->abb_delete_directory($dir . DIRECTORY_SEPARATOR . $item))
            {
                return false;
            }

        }
        return rmdir($dir);
    }

    /**
     *
     *
     * Artbees Template Installer
     *
     *
     */
    public function abb_install_template_action()
    {

        check_ajax_referer('abb_install_template_nonce', 'abb_install_template_security');

        $uploadedfile     = $_FILES['file'];
        $upload_overrides = array(
            'test_form' => false,
        );

        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

        if ($movefile && !isset($movefile['error']))
        {

            // echo "File is valid, and was successfully uploaded.\n";
            // var_dump( $movefile);

        }
        else
        {

            /**
             * Error generated by _wp_handle_upload()
             * @see _wp_handle_upload() in wp-admin/includes/file.php
             */
            echo $movefile['error'];
        }

        $upload_dir = wp_upload_dir();
        $file_path  = $movefile['file'];

        WP_Filesystem();
        $destination      = $upload_dir['basedir'];
        $destination_path = $destination . '/mk_templates';
        $this->createPath($destination_path);

        $unzipfile = unzip_file($file_path, $destination_path);

        if ($unzipfile)
        {
            echo json_encode('ok');
        }
        else
        {
            echo json_encode('Failed');
        }

        wp_die();
    }

    public function abb_delete_template()
    {

        check_ajax_referer('abb_install_template_nonce', 'abb_install_template_security');

        $upload_dir       = wp_upload_dir();
        $destination      = $upload_dir['basedir'];
        $destination_path = $destination . '/mk_templates/';
        $this->abb_delete_directory($destination_path . DIRECTORY_SEPARATOR . $_POST['template']);

        echo $this->get_list_of_templates();

        wp_die();
    }

    public function createPath($path)
    {
        if (is_dir($path))
        {
            return true;
        }

        $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1);
        $return    = $this->createPath($prev_path);
        return ($return && is_writable($prev_path)) ? mkdir($path) : false;
    }

    /**
     *
     *
     * Get list of the imported templates from uploads/templates directory
     *
     *
     */
    public function get_list_of_templates()
    {
        $upload_dir             = wp_upload_dir();
        $base_template_dir_scan = $upload_dir['basedir'] . '/mk_templates/*';
        $base_template_dir      = $upload_dir['basedir'] . '/mk_templates/';
        $base_template_url      = $upload_dir['baseurl'] . '/mk_templates/';

        $this->createPath($base_template_dir);

        $templates = glob($base_template_dir_scan);

        if ($templates)
        {
            foreach ($templates as $template)
            {
                echo '
                    <div class="template-item"><div class="item-holder">
                    <form method="post">
                        <input type="hidden" name="template" value="' . basename($template) . '">
                        <div class="template-image">
                            <img src="' . $base_template_url . basename($template) . '/preview.jpg" alt="' . basename($template) . '">
                        </div>
                        <div class="template-meta">
                            <h6>' . basename($template) . '</h6>
                            <div class="checkbox-holder">
                                <label for="contents-checkbox-' . basename($template) . '">
                                    <input type="checkbox" checked="checked" value="contents" id="contents-checkbox-' . basename($template) . '" name="contents">
                                    Contents
                                </label>
                                <label for="widgets-checkbox-' . basename($template) . '">
                                    <input type="checkbox" checked="checked" value="widgets" id="widgets-checkbox-' . basename($template) . '" name="widgets">
                                    Widgets
                                </label>
                                <label for="options-checkbox-' . basename($template) . '">
                                    <input type="checkbox" checked="checked" value="options" id="options-checkbox-' . basename($template) . '" name="options">
                                    Settings
                                </label>
                            </div>
                            <div class="button-holder">
                                <button id="import" type="submit" class="cp-button green small mk-import-content-btn">' . __('Activate', 'mk_framework') . '</button>
                                <a href="http://demos.artbees.net/jupiter5/' . basename($template) . '" target="_blank" class="cp-button gray small">' . __('Preview', 'mk_framework') . '</a>
                                <a id="delete" class="cp-button red small mk-delete-template-btn">' . __('Delete', 'mk_framework') . '</a>
                            </div>
                        </div>
                        </form>
                    </div></div>';
            }
        }
        else
        {
            echo '
                <p>' . __('No templates installed yet!', 'mk_framework') . '</p>';
        }
    }

    /**
     *
     *
     *
     *
     *
     */
    public function abb_get_templates_action()
    {

        $this->get_list_of_templates();
        wp_die();
    }

    public function abb_import_demo_action()
    {
        include_once THEME_CONTROL_PANEL . '/logic/template-importer.php';
        parse_str($_POST["options"], $options);
        if (!empty($options['template']))
        {

            $content_importer = new MkContentImporter($_POST["options"]);
            $content_importer->import();

            $options['template'] = '';

            wp_die();
        }
    }

    /**
     * Fetch Announcements from artbees themes API, store them in transients. So they get updated once a day
     *
     * @copyright   ArtbeesLTD (c)
     * @link        http://artbees.net
     * @since       Version 5.1
     * @last_update Version 5.1
     * @package     artbees
     * @author      Bob Ulusoy
     */
    public function get_announcements()
    {

        //set_transient('mk_artbees_themes_announcements', null);

        if (false == get_transient('mk_artbees_themes_announcements'))
        {
            global $wp_version;

            $data = array(
                'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url'),
            );

            $raw_response = wp_remote_get($this->api_url . 'announcements', $data);

            if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
            {
                $response = $raw_response['body'];
            }
            else
            {
                $response = is_wp_error($raw_response);
            }
            // Transient will be cleared after 1 day.
            set_transient('mk_artbees_themes_announcements', $response, 86400);
        }

        return unserialize(get_transient('mk_artbees_themes_announcements'));

    }

    /**
     * Warns the customer for incorrect environment settings.
     *
     * @copyright    ArtbeesLTD (c)
     * @link        http://artbees.net
     * @since        Version 5.0
     * @last_update Version 5.0.8
     * @package        artbees
     * @author        Bob Ulusoy & Ugur Mirza Zeyrek
     */
    public function install_template_warnings()
    {

        $max_execution_time            = ini_get("max_execution_time");
        $max_input_time                = ini_get("max_input_time");
        $upload_max_filesize           = ini_get("upload_max_filesize");
        $max_input_vars                = ini_get("max_input_vars");
        $suhosin_post_maxvars          = ini_get( 'suhosin.post.max_vars' );
        $suhosin_request_maxvars       = ini_get( 'suhosin.request.max_vars' );

        $incorrect_max_execution_time  = ($max_execution_time < 60 && $max_execution_time > 0);
        $incorrect_max_input_time      = ($max_input_time < 60 && $max_input_time > 0);
        $incorrect_memory_limit        = (self::let_to_num(WP_MEMORY_LIMIT) < 100663296);
        $incorrect_upload_max_filesize = (self::let_to_num($upload_max_filesize) < 10485760);

        $incorrect_max_input_vars      = ($max_input_vars < 4000);
        $incorrect_suhosin_maxvars = (( $suhosin_post_maxvars != '' && $suhosin_request_maxvars < 4000 ) ||
            ( $suhosin_post_maxvars != '' && $suhosin_request_maxvars < 4000 ));


        if ($incorrect_max_execution_time || $incorrect_max_input_time || $incorrect_memory_limit || $incorrect_upload_max_filesize)
        {

            echo '<div class="error settings-error cp-messages">';

            echo '<br><strong>Please resolve these issues before installing any template.</strong>';
            echo '<ol>';
            if ($incorrect_max_execution_time)
            {
                echo '<li><strong>Maximum Execution Time (max_execution_time) : </strong>' . $max_execution_time . ' seconds. <span style="color:red"> Recommended max_execution_time should be at least 60 Seconds.</span></li>';
            }
            if ($incorrect_max_input_time)
            {
                echo '<li><strong>Maximum Input Time (max_input_time) : </strong>' . $max_input_time . ' seconds. <span style="color:red"> Recommended max_input_time should be at least 60 Seconds.</span></li>';
            }
            if ($incorrect_memory_limit)
            {
                sprintf(_e('<li><strong>WordPress Memory Limit (WP_MEMORY_LIMIT) : </strong>%s<span style="color:red"> Recommended memory limit should be at least 96MB. <a target="_blank" href="%s">Increasing memory allocated to PHP</a></span></li>', 'mk_framework'), WP_MEMORY_LIMIT, 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP');
            }
            if ($incorrect_upload_max_filesize)
            {
                echo '<li><strong>Maximum Upload File Size (upload_max_filesize) : </strong>' . $upload_max_filesize . ' <span style="color:red"> Recommended Maximum Upload Filesize should be at least 10MB.</li>';
            }
            if ($incorrect_max_input_vars)
            {
                echo '<li><strong>Maximum Input Vars (max_input_vars) : </strong>' . $max_input_vars . ' <span style="color:red"> Recommended Maximum Input Vars should be at least 4000.</li>';
            }
            if ($incorrect_suhosin_maxvars)
            {
                echo '<li><strong>Maximum Suhosin Vars (suhosin.post.max_vars) : </strong>' . $suhosin_post_maxvars . ' <strong>(suhosin.request.max_vars) : </strong>' . $suhosin_request_maxvars . '  <span style="color:red"> Maximum Suhosin Vars (suhosin.post.max_vars) and (suhosin.request.max_vars) should be at least 4000.</li>';
            }


            echo '</ol>';

            echo '</div>';
        }

        echo '<div class="import_message"></div>';
    }

    private static function let_to_num($size)
    {
        $l   = substr($size, -1);
        $ret = substr($size, 0, -1);

        switch (strtoupper($l))
        {
            case 'P':
                $ret *= 1024;
            case 'T':
                $ret *= 1024;
            case 'G':
                $ret *= 1024;
            case 'M':
                $ret *= 1024;
            case 'K':
                $ret *= 1024;
        }

        return $ret;
    }

    public static function makeBoolStr($var)
    {
        if ($var == false || $var == 'false' || $var == 0 || $var == '0' || $var == '' || empty($var))
        {
            return 'false';
        }
        else
        {
            return 'true';
        }
    }
    public static function isLocalHost()
    {
        return ($_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === 'localhost' || $_SERVER['REMOTE_ADDR'] === '::1') ? 1 : 0;
    }

    public static function isWpDebug()
    {
        return (defined('WP_DEBUG') && WP_DEBUG == true);
    }

    public static function compileSystemStatus($json_output = false, $remote_checks = false)
    {
        global $wpdb;

        $sysinfo = array();

        $sysinfo['home_url'] = esc_url( home_url('/') );
        $sysinfo['site_url'] = esc_url( site_url('/') );

        // Only is a file-write check
        $sysinfo['wp_content_url']      = WP_CONTENT_URL;
        $sysinfo['wp_ver']              = get_bloginfo('version');
        $sysinfo['wp_multisite']        = is_multisite();
        $sysinfo['permalink_structure'] = get_option('permalink_structure') ? get_option('permalink_structure') : 'Default';
        $sysinfo['front_page_display']  = get_option('show_on_front');
        if ($sysinfo['front_page_display'] == 'page')
        {
            $front_page_id = get_option('page_on_front');
            $blog_page_id  = get_option('page_for_posts');

            $sysinfo['front_page'] = $front_page_id != 0 ? get_the_title($front_page_id) . ' (#' . $front_page_id . ')' : 'Unset';
            $sysinfo['posts_page'] = $blog_page_id != 0 ? get_the_title($blog_page_id) . ' (#' . $blog_page_id . ')' : 'Unset';
        }

        $sysinfo['wp_mem_limit']['raw']  = self::let_to_num(WP_MEMORY_LIMIT);
        $sysinfo['wp_mem_limit']['size'] = size_format($sysinfo['wp_mem_limit']['raw']);

        $sysinfo['db_table_prefix'] = 'Length: ' . strlen($wpdb->prefix) . ' - Status: ' . (strlen($wpdb->prefix) > 16 ? 'ERROR: Too long' : 'Acceptable');

        $sysinfo['wp_debug'] = 'false';
        if (defined('WP_DEBUG') && WP_DEBUG)
        {
            $sysinfo['wp_debug'] = 'true';
        }

        $sysinfo['wp_lang'] = get_locale();

        if (!class_exists('Browser'))
        {
            $file_path = pathinfo(__FILE__);
            require_once $file_path['dirname'] . '/browser.php';
        }

        $browser = new Browser();

        $sysinfo['browser'] = array(
            'agent'    => $browser->getUserAgent(),
            'browser'  => $browser->getBrowser(),
            'version'  => $browser->getVersion(),
            'platform' => $browser->getPlatform(),

            //'mobile'   => $browser->isMobile() ? 'true' : 'false',

        );

        $sysinfo['server_info'] = esc_html($_SERVER['SERVER_SOFTWARE']);
        $sysinfo['localhost']   = self::makeBoolStr(self::isLocalHost());
        $sysinfo['php_ver']     = function_exists('phpversion') ? esc_html(phpversion()) : 'phpversion() function does not exist.';
        $sysinfo['abspath']     = ABSPATH;

        if (function_exists('ini_get'))
        {
            $sysinfo['php_mem_limit']      = size_format(self::let_to_num(ini_get('memory_limit')));
            $sysinfo['php_post_max_size']  = size_format(self::let_to_num(ini_get('post_max_size')));
            $sysinfo['php_time_limit']     = ini_get('max_execution_time');
            $sysinfo['php_max_input_var']  = ini_get('max_input_vars');
            $sysinfo['suhosin_request_max_vars']  = ini_get( 'suhosin.request.max_vars' );
            $sysinfo['suhosin_post_max_vars'] = ini_get( 'suhosin.post.max_vars' );
            $sysinfo['php_display_errors'] = self::makeBoolStr(ini_get('display_errors'));
        }

        $sysinfo['suhosin_installed'] = extension_loaded('suhosin');
        $sysinfo['mysql_ver']         = $wpdb->db_version();
        $sysinfo['max_upload_size']   = size_format(wp_max_upload_size());

        $sysinfo['def_tz_is_utc'] = 'true';
        if (date_default_timezone_get() !== 'UTC')
        {
            $sysinfo['def_tz_is_utc'] = 'false';
        }

        $sysinfo['fsockopen_curl'] = 'false';
        if (function_exists('fsockopen') || function_exists('curl_init'))
        {
            $sysinfo['fsockopen_curl'] = 'true';
        }

        $sysinfo['soap_client'] = 'false';
        if (class_exists('SoapClient'))
        {
            $sysinfo['soap_client'] = 'true';
        }

        $sysinfo['dom_document'] = 'false';
        if (class_exists('DOMDocument'))
        {
            $sysinfo['dom_document'] = 'true';
        }

        $sysinfo['gzip'] = 'false';
        if (is_callable('gzopen'))
        {
            $sysinfo['gzip'] = 'true';
        }
        
        $sysinfo['mbstring'] = 'false';

        if (extension_loaded('mbstring') && function_exists ('mb_eregi') && function_exists ('mb_ereg_match') )
        {
            $sysinfo['mbstring'] = 'true';
        }

        $sysinfo['simplexml'] = 'false';

        if (class_exists('SimpleXMLElement') && function_exists('simplexml_load_string') )
        {
            $sysinfo['simplexml'] = 'true';
        }

        $sysinfo['phpxml'] = 'false';

        if (function_exists('xml_parse') )
        {
            $sysinfo['phpxml'] = 'true';
        }
        
        if ($remote_checks == true)
        {
            $response = wp_remote_post('https://www.paypal.com/cgi-bin/webscr', array(
                'sslverify'  => false,
                'timeout'    => 60,
                'user-agent' => 'MkFramework/',
                'body'       => array(
                    'cmd' => '_notify-validate',
                ),
            ));

            if (!is_wp_error($response) && $response['response']['code'] >= 200 && $response['response']['code'] < 300)
            {
                $sysinfo['wp_remote_post']       = 'true';
                $sysinfo['wp_remote_post_error'] = '';
            }
            else
            {
                $sysinfo['wp_remote_post'] = 'false';

                try {
                    if (is_wp_error($response))
                    {
                        $sysinfo['wp_remote_post_error'] = $response->get_error_message();
                    }

                }
                catch (Exception $e)
                {

                    $sysinfo['wp_remote_post_error'] = $e->getMessage();
                }
            }

            $response = wp_remote_get('http://reduxframework.com/wp-admin/admin-ajax.php?action=get_redux_extensions');

            if (!is_wp_error($response) && $response['response']['code'] >= 200 && $response['response']['code'] < 300)
            {
                $sysinfo['wp_remote_get']       = 'true';
                $sysinfo['wp_remote_get_error'] = '';
            }
            else
            {
                $sysinfo['wp_remote_get'] = 'false';

                try {
                    if (is_wp_error($response))
                    {
                        $sysinfo['wp_remote_get_error'] = $response->get_error_message();
                    }

                }
                catch (Exception $e)
                {

                    $sysinfo['wp_remote_get_error'] = $e->getMessage();
                }

            }
        }

        $active_plugins = (array) get_option('active_plugins', array());

        if (is_multisite())
        {
            $active_plugins = array_merge($active_plugins, get_site_option('active_sitewide_plugins', array()));
        }

        $sysinfo['plugins'] = array();

        foreach ($active_plugins as $plugin)
        {
            $plugin_data = @get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
            $plugin_name = esc_html($plugin_data['Name']);

            $sysinfo['plugins'][$plugin_name] = $plugin_data;
        }

        $active_theme = wp_get_theme();

        $sysinfo['theme']['name']       = $active_theme->Name;
        $sysinfo['theme']['version']    = $active_theme->Version;
        $sysinfo['theme']['author_uri'] = $active_theme->{'Author URI'};
        $sysinfo['theme']['is_child']   = self::makeBoolStr(is_child_theme());

        if (is_child_theme())
        {
            $parent_theme = wp_get_theme($active_theme->Template);

            $sysinfo['theme']['parent_name']       = $parent_theme->Name;
            $sysinfo['theme']['parent_version']    = $parent_theme->Version;
            $sysinfo['theme']['parent_author_uri'] = $parent_theme->{'Author URI'};
        }

        return $sysinfo;
    }
}

new mk_artbees_products();
