<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 6/10/14
 * Time: 3:43 PM
 */
/**
 * WP Theme Updater based on the Envato WordPress Toolkit Library and Pixelentity class from ThemeForest forums
 *
 * @package WordPress
 * @link http://themeforest.net/forums/thread/simple-theme-update-class-using-envato-api/73278 Thread on ThemeForest Forums
 * @author Pixelentity
 */
class AWEUpdate extends AweFramework
{
    const LANG = LANGUAGE;
    const UPDATE_OPTIONS = "AWE-update-options";
    public $default_configs;
    public $update_options = array(
        'from'          =>  '',
        'license_key'   =>  '',
        'active'        =>  false,
        'username'      =>  '',
        'api_key'       =>  '',
    );
    public function __construct($default_config)
    {
        $this->default_configs = $default_config;
        $this->refresh_update_options();
        $options = $this->update_options;
        global $pagenow;
        if(is_admin())
        {
            //register import menu
            add_action('admin_menu',                        array( $this, 'register_update_menu'));

            if(in_array("AWE-Update",$_REQUEST)){
                //loading scripts
                add_action( 'admin_enqueue_scripts',            array( $this, 'update_loading_scripts'));

            }
            //register ajax import data
            add_action( 'wp_ajax_awe_update_save',      array( $this , 'ajax_awe_update_save' ) );

        }
        if($options['from']=='evanto' && !empty($options['api_key']) && !empty($options['username']))
        {
            add_filter( "pre_set_site_transient_update_themes", array( &$this, "check" ) );
        }
    }

    /**
     * Register Update Menu
     */
    public function register_update_menu()
    {
        add_submenu_page( 'AWE-Framework', 'Update', 'Update', 'manage_options', 'AWE-Update', array($this,'update_settings') );

    }

    public function update_loading_scripts()
    {
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";
        wp_enqueue_script('ma-update', AWE_JS_URL. 'update'.$min.'.js', array("jquery"), null, false);
    }

    public function update_settings()
    {
        include_once('update_html.php');
    }

    public function refresh_update_options()
    {
        if(isset($_POST['reset-update'])) delete_option(self::UPDATE_OPTIONS);
        if(isset($_POST['save-update'])){
            if(check_admin_referer('awe-update-save','_wpnonce'))
                $options = $this->update_save_options($_POST);
        }else $options = get_option(self::UPDATE_OPTIONS);
        if(is_array($options))
            $this->update_options = array_merge($this->update_options,$options);
    }

    public function update_save_options($data_sent)
    {
        $options = $this->parse_configs($this->update_options,$data_sent['update']);
        update_option(self::UPDATE_OPTIONS,$options);
        $this->add_message('success','Save successfully');
        return $options;
    }

    public function ajax_awe_update_save()
    {
        if(check_ajax_referer('awe-update-save','_wpnonce') && isset($_REQUEST['_wp_http_referer']) && preg_match("/AWE-Update/i",$_REQUEST['_wp_http_referer']))
        {
            parse_str(json_decode(stripslashes($_POST['data']),true), $data_sent);
            $data_sent = $this->stripslashes_deep($data_sent);
            $data_sent = filter_var($data_sent, FILTER_CALLBACK, array("options"=>array($this,"convert_int"),'flags' => FILTER_REQUIRE_ARRAY));
            if($data_sent)
            {
                $options = $this->update_save_options($data_sent);
                echo json_encode(array("type"=>"success","msg"=>"Save Ok! (^_^)"));
            }else
                echo json_encode(array("type"=>"error","msg"=>"Something wrong please check again (@_@)"));
        }
        else echo json_encode(array("type"=>"error","msg"=>"Something wrong please check again (@_@)"));
        exit();
    }

    /**
     * check fro the updates
     */
    public function check($updates)
    {
//        $theme_data = wp_get_theme(get_stylesheet_directory().'/style.css');
        $theme_data = wp_get_theme();
        $authors = array($theme_data->display( 'Author', FALSE ));
        $options = $this->update_options;

        if ( !$options['username'] || !$options['api_key'] || ! isset( $updates->checked ) )
            return $updates;

        if ( ! class_exists( "Envato_Protected_API" ) ) {
            require_once( AWE_ROOT_DIR."/lib/envato-wordpress-toolkit-library/class-envato-protected-api.php" );
        }

        $api = new Envato_Protected_API( $options['username'],$options['api_key'] );
        add_filter( "http_request_args", array( &$this, "http_timeout" ), 10, 1 );
        $purchased = $api->wp_list_themes( true );

        $installed = wp_get_themes();
        $filtered = array();

        foreach ( $installed as $theme ) {
            if ( $authors && ! in_array( $theme->{'Author Name'}, $authors ) )
                continue;
            $filtered[$theme->Name] = $theme;
        }

        foreach ( $purchased as $theme ) {
            if ( isset( $filtered[$theme->theme_name] ) ) {
                // gotcha, compare version now
                $current = $filtered[$theme->theme_name];
                if ( version_compare( $current->Version, $theme->version, '<' ) ) {
                    // bingo, inject the update
                    if ( $url = $api->wp_download( $theme->item_id ) ) {
                        $update = array(
                            "url"         => "http://themeforest.net/item/theme/{$theme->item_id}",
                            "new_version" => $theme->version,
                            "package"     => $url
                        );

                        $updates->response[$current->Stylesheet] = $update;
                    }
                }
            }
        }

        remove_filter( "http_request_args", array( &$this, "http_timeout" ) );

        return $updates;
    }
    /**
     * Increase timeout for api request
     * @param  Array $req
     * @return Array
     */
    public function http_timeout( $req ) {
        $req["timeout"] = 300;
        return $req;
    }
}