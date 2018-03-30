<?php
/**************************************************************
 *                                                            *
 *   Provide a way to improve security                        *
 *   A Project of Mega Art Studio                             *
 *   Copyright @ MegaDrupal.com                               *
 *   Author: DuongLe                                         *
 *   Profile: http://themeforest.net/user/megadrupal          *
 *   Follow me: http://twitter.com/duongle87                  *
 *   Date: 2/7/14                                             *
 *   Time: 3:41 PM                                            *
 *                                                            *
 **************************************************************/

Class AWESecurity extends AweFramework
{

    const SECURITY_OPTIONS = 'AWE-Security-Options';
    const CAPTCHA_OPTIONS = 'AWE-Captcha-Options';
    protected $security_options = array(
        'private'               =>      0,
        'captcha'               =>      0,
        'secret-key'            =>      '1bSc4wQpKrSz0',
        'hide-login'            =>      0,
        'slug-login'            =>      'awe-login',
        'hide-admin'            =>      0,
        'change-register'       =>      1,
        'hide-phpfiles'         =>      0,
        'white-lists'           =>      "index.php, wp-content/repair.php, wp-comments-post.php, wp-includes/js/tinymce/wp-tinymce.php, xmlrpc.php",
        'remove-version'        =>      1,
        'canonical-redirect'    =>      0,
        'remove-generator'      =>      1,
        'remove-wlwmanifest'    =>      1,
        'remove-rsd'            =>      0,
        'remove-feed'           =>      0,
        'remove-index-rel'      =>      1,
        'remove-feed-extra'     =>      0,
        'remove-noindex'        =>      0,
        'remove-shortlink'      =>      1,

    );
    /**
     * Captcha Option
     * @var array
     */
    public $captcha_options = array(
        'settings'              => array(
            'type'                  =>  1,
            'login-form'            =>  0,
            'registration-form'     =>  0,
            'reset-password-form'   =>  0,
            'comments-form'         =>  0,
            'contact-form'          =>  0,

        ),
        'google'                =>  array(
            'public-key'            =>  '',
            'private-key'           =>  '',
            'theme'                 =>  'red'
        ),
        'math'                  =>  array(
            'operations'            =>  array(
                'add'                   =>  1,
                'sub'                   =>  0,
                'mul'                   =>  0,
                'div'                   =>  0,
            ),
            'display'           =>  array(
                'numbers'               =>  1,
                'words'                 =>  0,
            ),
            'title'             =>  'Math Captcha',
            'time'              =>  '300',
        ),
        'human'                 =>  array(
            'public-key'            =>'',
            'private-key'           =>'',

        ),
        'role'                  =>  array()
    );

    /**
     * Construct Class
     */
    public function __construct()
    {

        if(is_admin())
        {
            //Register security menu
            add_action('admin_menu',                array( $this, 'register_security_menu'));

            ######### AJAX SAVE DATA ############
            add_action('wp_ajax_awe_security_save', array( $this, 'ajax_security_save_data'));

            #loading js
            add_action('admin_enqueue_scripts',     array( $this, 'security_loading_scripts'));

            add_action('admin_print_scripts',       array( $this, 'security_print_scripts'));
        }

        $this->security_refresh_options();
        $this->detect_security_plugins();

        // Hide wp-login.php
        if($this->security_options['hide-login']==1)
        {
            add_action( 'login_form',           array($this,'protected_wp_login_form'),             1000 );
            add_action( 'register_form',        array($this,'protected_wp_login_form'),             1000 );
            add_action( 'lostpassword_form',    array($this,'protected_wp_login_form'),             1000 );
            //check secret key + captcha
            add_action( 'authenticate',         array($this,'protected_wp_login_authenticate'),     1000, 1 );

            add_action( 'init',                 array($this,'hide_wp_login'),                       1);
            add_filter( 'login_url',            array($this,'new_login_url'),                       10, 2 );
            add_filter( 'logout_url',           array($this,'new_logout_url'),                      10,2);
            add_filter( 'register_url',         array($this,'new_register_url'),                    10,2);
            add_filter( 'lostpassword_url',     array($this,'new_lostpassword_redirect'),           10,2);
            add_action( 'template_redirect',    array($this,'my_redirect'));

        }

        // Hide .php
        if($this->security_options['hide-phpfiles']==1)
        {
            add_action('init',array($this,'hide_php_files'));
        }

        // remove others attribute at wp header

        if($this->security_options['remove-version']==1)
        {
            add_filter( 'style_loader_src',     array($this,'remove_ver_css_js'),                   9999 );
            add_filter( 'script_loader_src',    array($this,'remove_ver_css_js'),                   9999 );

        }


        //hide wp-admin for guest
        if($this->security_options['hide-admin'])
            add_action('init',array($this,'hide_admin'));

        // Captcha
        if($this->security_options['captcha']==1)
           if(!class_exists("AWECaptcha"))
           {
                include("captcha.php");
                $captcha = new AWECaptcha();
           }
        // Add global messages into queue
        add_action('admin_notices',                 array(&$this,'display_global_messages'),    9999);

        // Register ajax generate key
        add_action('wp_ajax_generate_key',          array( $this , 'generate_key' ) );

        // private site
        if($this->security_options['private']==1)
            add_action( 'template_redirect',            array( $this, 'private_redirect' ) );

        // Links


    }


    /**
     * Loading security script
     */
    public function security_loading_scripts()
    {
        global $pagenow;
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";

        if ( $pagenow == 'admin.php' && in_array('AWE-Security',$_REQUEST))
            wp_enqueue_script('ma-security', AWE_JS_URL. 'security'.$min.'.js', array("jquery"), null, false);
    }

    public function security_print_scripts()
    {
        global $wp_rewrite,$pagenow;
        $is_rewrite = ($wp_rewrite->permalink_structure == '') ? false : true;
        $script='';
        if ( $pagenow == 'admin.php' && in_array('AWE-Security',$_REQUEST)){
            $script = "<script type=\"text/javascript\">var siteUrl = '".home_url()."';\n";
            if($is_rewrite)
                $script .= "var isRewrite='1'; </script>";
            else
                $script .= "var isRewrite='0'; </script>";
        }
        echo $script;
    }
    /**
     * Register sub menu into MA Framework Menu
     */
    public function register_security_menu(){
        add_submenu_page( 'AWE-Framework', 'Security Settings', 'Security', 'manage_options', 'AWE-Security', array($this,'security_settings') );

    }


    /**
     * Ajax save data
     */
    public function ajax_security_save_data()
    {
        parse_str(json_decode(stripslashes($_POST['data']),true), $data_sent);
        $data_sent = $this->stripslashes_deep($data_sent);
        $data_sent = filter_var($data_sent, FILTER_CALLBACK, array("options"=>array($this,"convert_int"),'flags' => FILTER_REQUIRE_ARRAY));

        if($data_sent)
        {
            $soptions = $this->security_save_data($data_sent);
            $coptions = $this->captcha_save_data($data_sent);

            echo json_encode(array("type"=>"success","msg"=>"Save Ok! (^_^)"));
        }else
            echo json_encode(array("error"=>"success","msg"=>"Something wrong please check again (@_@)"));
        exit();
    }

    /**
     *  Save data
     */
    public function security_save_data($data_sent)
    {
        // Save Security Options
        $settings = (isset($data_sent['security']))? $data_sent['security'] :array();
        $noncheckbox = array_diff_key($this->security_options, $settings);
        $not_checkbox = array('secret-key','slug-login','white-lists');
        foreach ($noncheckbox as $i => $v) {
            if(in_array($i,$not_checkbox)) $noncheckbox[$i]='';
            else $noncheckbox[$i] = 0;
        }

        $soptions = array_merge($settings, $noncheckbox);

        update_option(self::SECURITY_OPTIONS,$soptions);

        return $soptions;

    }


    public function captcha_save_data($data_sent)
    {
        // Save captcha Options

        // general captcha
        $captcha['settings'] = (isset($data_sent['captcha']['settings']))? $data_sent['captcha']['settings'] :array();
        $noncheckbox=array();
        $noncheckbox = array_diff_key($this->captcha_options['settings'], $captcha['settings']);
        foreach ($noncheckbox as $i => $v) {
            if($i=='type')  $noncheckbox[$i] = 1;
            else $noncheckbox[$i] = 0;
        }
        $coptions['settings'] = array_merge($captcha['settings'], $noncheckbox);

        // captcha google
        $captcha['google'] = (isset($data_sent['captcha']['google']))? $data_sent['captcha']['google'] :array();
        $noncheckbox = array_diff_key($this->captcha_options['google'], $captcha['google']);
        foreach ($noncheckbox as $i => $v) {
            if($i=='theme')  $noncheckbox[$i] = 'red';
            else $noncheckbox[$i] = '';
        }
        $coptions['google'] = array_merge($captcha['google'], $noncheckbox);

        // captcha match
        $captcha['math'] = (isset($data_sent['captcha']['math']))? $data_sent['captcha']['math'] :array();
        $captcha['math']['operations'] = (isset($data_sent['captcha']['math']['operations']))? $data_sent['captcha']['math']['operations'] :array('add'=>1);
        $noncheckbox = array_diff_key($this->captcha_options['math']['operations'], $captcha['math']['operations']);
        foreach ($noncheckbox as $i => $v) {
            $noncheckbox[$i] = 0;
        }
        $coptions['math']['operations'] = array_merge($captcha['math']['operations'], $noncheckbox);

        $captcha['math']['display'] = (isset($data_sent['captcha']['math']['display']))? $data_sent['captcha']['math']['display'] :array('numbers'=>1);
        $noncheckbox = array_diff_key($this->captcha_options['math']['display'], $captcha['math']['display']);
        foreach ($noncheckbox as $i => $v) {
            $noncheckbox[$i] = 0;
        }
        $coptions['math']['display'] = array_merge($captcha['math']['display'], $noncheckbox);
        $coptions['math']['time'] = (isset($data_sent['captcha']['math']['time']))? $data_sent['captcha']['math']['time'] :300;
        $coptions['math']['title'] = (isset($data_sent['captcha']['math']['title']))? $data_sent['captcha']['math']['title'] :'';

        // catpcha human
        $captcha['human'] = (isset($data_sent['captcha']['human']))? $data_sent['captcha']['human'] :array();
        $noncheckbox = array_diff_key($this->captcha_options['human'], $captcha['human']);
        foreach ($noncheckbox as $i => $v) {
            $noncheckbox[$i] = '';
        }
        $coptions['human'] = array_merge($captcha['human'], $noncheckbox);

        // captcha role
        $captcha['role'] = (isset($data_sent['captcha']['role']))? $data_sent['captcha']['role'] :array();
        $coptions['role'] = $captcha['role'];
        update_option(self::CAPTCHA_OPTIONS,$coptions);
        $this->add_message('success','Save Ok');
        return $coptions;
    }

    /**
     * Refresh Option
     */
    public function security_refresh_options()
    {

        if(isset($_POST['reset-security'])) {
            delete_option(self::SECURITY_OPTIONS);
            delete_option(self::CAPTCHA_OPTIONS);
        }
        if(isset($_POST['save-security'])){
            $data_sent = filter_var($_POST, FILTER_CALLBACK, array("options"=>array($this,"convert_int"),'flags' => FILTER_REQUIRE_ARRAY));
            $soptions = $this->security_save_data($data_sent);
            $coptions = $this->captcha_save_data($data_sent);
        }else {
            $soptions = get_option(self::SECURITY_OPTIONS);
            $coptions = get_option(self::CAPTCHA_OPTIONS);
        }
        if(is_array($soptions))
            $this->security_options = array_merge($this->security_options,$soptions);
        if(is_array($coptions)){
            $this->captcha_options = array_merge($this->captcha_options,$coptions);
        }

    }

    /**
     * Generate HTML template
     */

    public function security_settings()
    {
        include_once('security_tpl.php');
    }


    /**
     * Auto detect the plugin which may conflict
     */
    public function detect_security_plugins()
    {
        # detect captha plguins
        if($this->security_options['captcha']==1){
            $plugins = array(
                'cptch_admin_menu'  => 'Captcha',
                'gglcptch_init'     =>  'Google Captcha',
                'ayah_register_cf7_actions' => 'Are you Human Captcha'
            );
            foreach($plugins as $plugin => $name)
            {

                if(function_exists($plugin) || class_exists($plugin)){
                    $this->add_global_messages('error',"The plugin named {$name} is used. Please disable this plugin {$name} or captcha function of MA Framework to avoid conflict.");
                    $this->add_message('error',"The plugin named {$name} is used. Please disable this plugin {$name} or this function to avoid conflict.");
                }
            }
        }

        # detect security plugins

    }


    /**
     * Block accessing site
     */
    public function block_access()
    {
        global $wp_query,$pagenow;

        $pagenow = "index.php";
        $wp_query->set_404();
        status_header( 404 );
        nocache_headers();
        $response = @wp_remote_get( home_url('/nothing_404_404') );

        if ( ! is_wp_error($response) )
            echo $response['body'];
        else
        {
            header('HTTP/1.0 404 Not Found');
            echo "<h1>Error 404 Not Found</h1>";
            echo "The page that you have requested could not be found.";
            exit();
        }
//            wp_redirect( home_url('/404_Not_Found')) ;
//
//        if ( ! $template = get_404_template() )
//            $template = 'index.php';
//        include( $template );
//        wp_redirect( home_url('/404_Not_Found')) ;
        die;
    }

    /**
     * Generate a random string
     * @return string $string
     */
    public function generate_key()
    {
        $length = 12;
        $vowels = 'abcdefghijklmnopqrstuvwxyz';
        $consonants = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        echo $password;
    }

    /**
     * Return a list user role
     */
    public function get_current_user_roles(){

        global $current_user;
        require_once(ABSPATH . 'wp-includes/pluggable.php');
        if(is_multisite()){
            $this->user_current_role = $current_user->roles;
        }else{
            $user_roles = $current_user->roles;
            $this->user_current_role = array_shift($user_roles);

        }

    }


    /**
     * HIDE WP-LOGIN
     **/


    /**
     * Add secret key into form login
     */
    function protected_wp_login_form() {
        if ( isset( $_REQUEST['awe_key'] )) {
            ?>
           <input type='hidden' name='awe_key' value='<?php echo esc_attr( $_REQUEST['awe_key'] ); ?>' />
        <?php
        }
    }


    /**
     * Proctected Login Form
     * It'll denied Without secret key
     *
     * @param $user
     *
     * @return WP_Error
     */
    function protected_wp_login_authenticate( $user ) {
        if (isset( $_POST['log'] ) && isset( $_POST['pwd'] ) // login form has been submitted
            &&  (!isset( $_POST['awe_key']) || $this->security_options['secret-key'] !== $_POST['awe_key']))
        {
            return new WP_Error( 'authentication_failed', __( 'Are you kidding me!',self::LANG) );
        }
        return $user;
    }

    /**
     * Prevent to access wp-login.php
     */

    public function hide_wp_login()
    {
        global $wp_query, $pagenow;

        $key = (isset($_REQUEST['awe_key']))?$_REQUEST['awe_key']:'1234';
        //$rq = array("checkemail");
        $is_login = true;
       // foreach($rq as $r)
        //    if(isset($_REQUEST[$r])) $is_login = false;
        if ( 'wp-login.php' == $pagenow)
//            if(!isset($_REQUEST['awe_key'])) $this->block_access();
            if ($key!=$this->security_options['secret-key']){//} && $is_login) {
                $this->block_access();
            }
    }


    /**
     * Register new login url
     *
     * @param string $login_url original login url
     * @param string $redirect  redirect url after login successfully
     *
     * @return string   new slug login
     */
    public function new_login_url( $login_url, $redirect ) {
        //return '/wp-login.php?awe_key='.$this->security_options['secret-key'];
        return '/'.$this->security_options['slug-login'].'/';
    }

    public function new_logout_url($force_reauth, $redirect=null){
        $logout_url = wp_nonce_url(home_url('wp-login.php')."?action=logout&awe_key=".$this->security_options['secret-key'], 'log-out' );
        if (empty($redirect)) $redirect=home_url("/wp-login.php?loggedout=true&awe_key=".$this->security_options['secret-key']);
        $logout_url = add_query_arg('redirect_to', urlencode( $redirect ), $logout_url );
        return $logout_url ;
    }

    public function new_register_url($register_url,$redirect=null)
    {
        $register_url = home_url("wp-login.php?action=register&awe_key=".$this->security_options['secret-key']);
        if (empty($redirect) ) $redirect=home_url("/wp-login.php?checkemail=registered&awe_key=".$this->security_options['secret-key']);
        $register_url = add_query_arg( 'redirect_to', urlencode( $redirect ), $register_url );
        return $register_url;

    }

    public function new_lostpassword_redirect( $lostpassword_url, $redirect=null ) {
        $lostpassword_url = home_url('wp-login.php')."?action=lostpassword&awe_key=".$this->security_options['secret-key'];
        if (empty($redirect) ) $redirect=home_url("/wp-login.php?checkemail=confirm&awe_key=".$this->security_options['secret-key']);
        $lostpassword_url = add_query_arg( 'redirect_to', urlencode( $redirect ), $lostpassword_url );
        return $lostpassword_url;
    }

    /**
     * Redirect new login url to secret login url
     **/

    public function my_redirect()
    {
        global $wp_query;
        $name = (isset($wp_query->query['name']))?$wp_query->query['name']:false;
        if(is_multisite()) $name = (isset($wp_query->query['pagename']))?$wp_query->query['pagename']:false;
        if($name==$this->security_options['slug-login']){

            wp_redirect( home_url( '/wp-login.php?awe_key='.$this->security_options['secret-key'] ) );
            exit();
        }

    }

    /**
     * Prevent to access php files excepted white lists
     */
    public function hide_php_files()
    {

        if($this->find_str_end($_SERVER['PHP_SELF'], '.php') && !$this->find_contains($_SERVER['PHP_SELF'], '/wp-admin/'))
        {
            $lists = $this->security_options['white-lists'];
            //remove space
            $lists =  str_replace(" ",'',$lists);
            if($lists!='') $white_list= explode(",",$lists);
            $white_list[]='wp-login.php';
            $white_list[]='index.php';
            $block = true;
            foreach ($white_list as $white_file) {
                if ($this->find_str_end($_SERVER['PHP_SELF'], trim($white_file,', \r\n')))
                    $block= false;
            }
            if($block)
            {
                $this->block_access();
            }
        }

    }


    /**
     * Remove version wp
     **/

    public function remove_ver_css_js($src)
    {
        $parts = explode( '?', $src );
        return $parts[0];
    }


    /**
     * Hide wp-admin for guest
     **/



    public function hide_admin()
    {
        global $current_user;
        if(!$current_user->roles)
        {
            if($this->find_contains($_SERVER['PHP_SELF'], '/wp-admin/') && !$this->find_str_end($_SERVER['PHP_SELF'], '/admin-ajax.php'))
                $this->block_access();
        }
    }



    /**
     * Private site
     * Required member login to view content
     **/

    public function private_redirect()
    {
        global $pagenow;

        if ( 'wp-login.php' !== $pagenow && ! is_user_logged_in() ) {
            auth_redirect();
        }
    }

    /**
     * Check contact form 7 is active
     **/

    public function form_7_is_active()
    {
        if(function_exists('wpcf7')) return true;
        else return false;
    }
}

