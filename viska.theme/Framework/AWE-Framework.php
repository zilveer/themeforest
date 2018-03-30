<?php
/**
 * User: duongle
 * Date: 2/7/14
 * Time: 3:39 PM
 */

define('AWE_ROOT_DIR',dirname( __FILE__ ));
define('AWE_ROOT_URL', get_template_directory_uri().'/Framework/');
define('AWE_JS_URL',AWE_ROOT_URL.'asset/js/');
define('AWE_CSS_URL',AWE_ROOT_URL.'asset/css/');
define('AWE_THEMENAME', 'AWE ');
define('AWE_FE_JS',get_bloginfo('template_url').'/assets/js/');
if(!function_exists('wp_get_current_user')) {
    include("pluggable.min.php");
}

class AweFramework
{

    const LANG = LANGUAGE;
    const MAIN_OPTIONS = "AWE-main-options";
    public $messages;
    public $global_messages;
    protected $user_current_role;
    public $awe_main_option = array(
            'seo'                   =>  0,
            'security'              =>  0,
            'shortcodes'            =>  0,
            'user'                  =>  0,
            'widgets'               =>  0,
            'portfolio'             =>  0,
            'service'               =>  0,
            'team'                  =>  0,
            'testimonial'           =>  0,
            'aboutus'               =>  0,
            'pricing_table'         =>  0,
            );


    public function __construct($default_config){

        #load language
        add_action('init', array($this,'load_language'));
        #refresh AWE main options
        if(isset($default_config['frame_options']))
            $this->awe_main_option = $this->parse_configs($this->awe_main_option,$default_config['frame_options']);
        $this->refresh_awe_main_option();

        # Active Theme Settings
        include_once("modules/theme/settings.php");
        $this->theme = new AWEThemeSettings($default_config);


        # AWE Frame Loading #
        if(is_admin()){
            #loading js
            add_action('admin_enqueue_scripts', array($this, 'loading_scripts'));
            #loading css
            add_action('admin_enqueue_scripts',array($this,'loading_css'));
            #loading font
            add_action('admin_head',array($this,'loading_font'));

            ######### AJAX SAVE DATA ############
            add_action('wp_ajax_awe_frame_save', array( $this , 'frame_ajax_save_data' ) );

            #init menu
            add_action('admin_menu', array($this,'menu' ));

        }

        ###### Active Plugins ######
        include_once(AWE_ROOT_DIR."/modules/activation/activation.php");
        $this->active_plugins = new AWEActivation($default_config);

        # Active SEO Module
        if($this->awe_main_option['seo']==1) {
            include("modules/seo/seo.php");
            $this->seo = new AWESeo();
        }

        # Active Security Module
        if($this->awe_main_option['security']==1){
            include_once("modules/security/security.php");
            $this->security = new AWESecurity();
        }

        # Active ShortCodes Module
        if($this->awe_main_option['shortcodes']==1){
//            include_once("modules/shortcodes/shortcodes.php");
//            $this->shortcodes = new AWEShortcodes();
        }

        # Active Widgets
        if($this->awe_main_option['widgets']==1){
            include_once("modules/widgets/widgets.php");
            $this->widgets = new AWEWidgets();
        }

        # Active User
        if($this->awe_main_option['user']==1){
            include_once("modules/user/user.php");
            $this->user = new AWEUserPro();
        }


        ########### Active Update ###########
        include_once(AWE_ROOT_DIR."/modules/update/update.php");
        $this->auto_update = new AWEUpdate($default_config);

        ####### Active Import Demo Data #####
        include_once(AWE_ROOT_DIR."/modules/importer/importer.php");
        $this->import_data = new AWEImporter($default_config);

        # Active Portfolio
        if($this->awe_main_option['portfolio']==1)
        {
            include_once("modules/others/portfolio.php");
            $this->portfolio = new AWEPortfolio();
        }

        # Active About us
        if($this->awe_main_option['aboutus']==1)
        {
            include_once("modules/others/aboutus.php");
            $this->about_us = new AWEAboutus();
        }
        # Active Service
        if($this->awe_main_option['service']==1)
        {
            include_once("modules/others/service.php");
            $this->service = new AWEService();
        }
        # Active Pricing Table
        if($this->awe_main_option['pricing_table']==1)
        {
            include_once("modules/others/pricing.php");
            $this->pricing_table = new AWEPricingTable();
        }
        # Acvtive Team
        if($this->awe_main_option['team']==1)
        {
            include_once("modules/others/team.php");
            $this->service = new AWETeam();
        }

        #Active Testimonial
        if($this->awe_main_option['testimonial']==1)
        {
            include_once("modules/others/testimonial.php");
            $this->testimonial = new AWETestimonial();
        }

        #Active Metabox
        include_once("modules/others/metabox.php");
        $this->metabox = new AWEMetabox();

        add_action('admin_notices',array(&$this,'display_global_messages'),9999);
    }



    /**
     * Add a message to Global Message queue
     * @param string $type  type of message (ex error, success, warning)
     * @param string $text  content of message
     */
    public function add_global_messages($type,$text){
        $class = "";
        switch($type){
            case 'updated':
                $class ="updated";
                break;
            case 'error':
                $class = "error";
                break;
            case 'update-nag':
                $class = "update-nag";
                break;
        }
        $result = "<div class=\"{$class}\">";
        $result .= "<p>{$text}</p>";
        $result .= "</div>\n";
        $this->global_messages .= $result;
    }

    public function display_global_messages(){
        echo $this->global_messages;
    }

    /**
     * Add message to header of frame
     * @param string $type  type of notice
     * @param string $text  content of message
     */
    public function add_message($type,$text){
        $result = "";
        switch ($type){
            case 'error':
                $result ="<div class=\"alert-box alert-error\">";
                $result .="<strong>Error! </strong>".$text;
                $result .="</div>\n";
                break;

            case 'success':
                $result ="<div class=\"alert-box alert-success\">";
                $result .="<strong>Success! </strong>".$text;
                $result .="</div>\n";
                break;

            default:
                $result ="<div class=\"alert-box alert-warning\">";
                $result .="<strong>Warning! </strong>".$text;
                $result .="</div>\n";


        $this->messages .= $result;

        }



        $this->messages .= $result;
    }

    /**
     * Ajax save data
     */

    public function frame_ajax_save_data()
    {
        if(check_ajax_referer('awe-generate-save','_wpnonce') && isset($_REQUEST['_wp_http_referer']) && preg_match("/AWE-Modules/i",$_REQUEST['_wp_http_referer']))
        {
            parse_str(json_decode(stripslashes($_POST['data']),true), $data_sent);
            $data_sent = $this->stripslashes_deep($data_sent);
            $data_sent = filter_var($data_sent, FILTER_CALLBACK, array("options"=>array($this,"convert_int"),'flags' => FILTER_REQUIRE_ARRAY));

            if($data_sent)
            {
                $options = $this->frame_save_options($data_sent);

                echo json_encode(array("type"=>"success","msg"=>"Save Ok! (^_^)"));
            }else
                echo json_encode(array("type"=>"error","msg"=>"Something wrong please check again (@_@)"));
        }else
            echo json_encode(array("type"=>"error","msg"=>"Something wrong please check again (@_@)"));
        exit();
    }

    public function frame_save_options($data_sent)
    {
        $options = $this->parse_configs($this->awe_main_option,$data_sent['modules']);
        update_option(self::MAIN_OPTIONS,$options);
        $this->add_message('success','Save successfully');
        return $options;
    }
    /**
     * Refresh adn update options
     */
    public function refresh_awe_main_option()
    {
        if(isset($_POST['reset-generate'])) delete_option(self::MAIN_OPTIONS);
        if(isset($_POST['save-generate'])){
            if(check_admin_referer('awe-generate-save','_wpnonce'))
                $options = $this->frame_save_options($_POST);
        }else $options = get_option(self::MAIN_OPTIONS);
        if(is_array($options))
            $this->awe_main_option = array_merge($this->awe_main_option,$options);
    }

    /**
     * Load and active multi-languages
     */
    public function load_language()
    {
        $path = AWE_ROOT_DIR . '/languages/';
        load_theme_textdomain( self::LANG, $path);

    }

    /**
     * Loading global scripts
     */
    public function loading_scripts()
    {
        global $pagenow;
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-widget');
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery-ui-slider');
        wp_enqueue_script('jquery-ui-mouse');
        wp_enqueue_script('wp-color-picker');
//        wp_dequeue_script('jquery');
        wp_enqueue_script('mousewheel-js');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('mCustomScrollbar-js');
        wp_enqueue_script('jquery-ui-accordion');

        if ( $pagenow == 'admin.php')
        {
            wp_enqueue_script('ma-scripts', AWE_JS_URL. 'script'.$min.'.js', array("jquery"), null, false);
            wp_enqueue_script("jquery-cookie", AWE_JS_URL."lib/jquery.cookie.min.js", array(), '0');
        }
        if ( $pagenow == 'admin.php' && (in_array('AWE-Modules',$_REQUEST) )){
            wp_enqueue_script('ma-frame', AWE_JS_URL. 'frame'.$min.'.js', array("jquery"), null, false);
        }

    }

    /**
     * Loading global Css
     */
    public function loading_css()
    {
        global $pagenow;
        if($pagenow=='admin.php'){
            wp_enqueue_style('style-frame', AWE_CSS_URL . 'style-frame.css', false, '1.0');

        }
        wp_enqueue_style('jquery-ui', AWE_CSS_URL . 'jquery-ui-1.10.4.min.css', false, '1.10.4');
        if($pagenow!='admin.php'){
            wp_enqueue_style('style-awe-settings', AWE_CSS_URL . 'awe-settings.css', false, '1.0');
        }

        // CSS Popup FONT ICON
        wp_enqueue_style('style-fa', AWE_CSS_URL . 'style.fa.css', false, '1.0');
//        wp_enqueue_style('style-shortcodepop', AWE_CSS_URL . 'shortcode-popup.css', false, '1.0');
        wp_enqueue_style( 'wp-color-picker' );
        /* Remove Open Sans loading */
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
        /* Loading Font Awesome */
        wp_enqueue_style('awew-fontawesome', AWE_CSS_URL.'font-awesome.css', array(), '4.0.3' );
    }

    /**
     * Loading Google Font
     */
    public function loading_font()
    {
        echo '<link id="font-frame-css" href="'. ( is_ssl() ? 'https' : 'http' ) .'://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" type="text/css">'."\n";
    }

    /**
     * Register Framework Main Menu
     */
    public function menu()
    {
//        add_menu_page( THEME_NAME, THEME_NAME, 'manage_options', 'AWE-Framework',array(__CLASS__,'theme_settings'), '', 3);
//        add_submenu_page( 'AWE-Framework', 'Tutorial & Support', 'Tutorial & Support', 'manage_options', 'AWE-Support', array($this,'support_options') );
        add_submenu_page( 'AWE-Framework', 'Modules', 'Modules', 'manage_options', 'AWE-Modules', array($this,'modules_options') );
    }

    /**
     * Modules Settings HTML
     */
    public function modules_options()
    {
        include('module_html.php');
    }

    /**
     * Support Settings HTML
     */
    public function support_options()
    {
        include('support_html.php');
    }


    /**
     * Get a list user role
     * @return array
     */
    public function get_user_role() {
        if ( !function_exists('get_editable_roles') ) {
            require_once( ABSPATH . '/wp-admin/includes/user.php' );
        }
        $editable_roles = get_editable_roles();
        foreach ( $editable_roles as $role => $details ) {
            $editable_roles[$role]["label"] = translate_user_role( $details['name'] );
        }

        return $editable_roles;
    }

    /*****
     * Utilities Function
     */

    /**
     * Find a string in a string
     *
     * @param string $string   The Source string
     * @param string $find     The Finding string
     *
     * @return bool
     */
    public function find_contains($string,$find)
    {
        if (empty($string) || empty($find))
            return false;

        $pos = strpos($string, $find);

        if ($pos === false)
            return false;
        else
            return true;
    }

    /**
     * Find a string in a head of string
     *
     * @param string $string    The Source string
     * @param string $find      The Finding string
     *
     * @return bool
     */
    public function find_str_start($string,$find)
    {

        return strpos($string, $find) === 0 ;
    }

    /**
     * Find a string in a head of string
     *
     * @param string $string   The Source string
     * @param string $find The Finding string
     *
     * @return bool
     */
    public function find_str_end($string,$find)
    {
        $position = strlen($string) - strlen($find);
        return strrpos($string, $find, 0) === $position;

    }

    /**
     * Get value of custom post field
     * @param string $field name of field
     * @param array $default default settings input
     * @return mixed|string
     */
    public function get_custom_fields($field,$default=false)
    {
        if ( null === get_the_ID() ){
            if($default)
                return $default[$field];
            else
                return '';
        }
        $custom_field = get_post_meta( get_the_ID(), $field, true );
        if ( ! $custom_field )
            if($default)
                return $default[$field];
            else
                return '';

        return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );

    }

    /**
     * Save custom post fieds
     * @param array $data   data input
     * @param       $nonce_action
     * @param       $nonce_name
     * @param       $post
     * @param null  $deprecated
     */
    public function save_custom_fields(array $data, $nonce_action, $nonce_name, $post, $deprecated = null)
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
            return;
        if ( defined( 'DOING_CRON' ) && DOING_CRON )
            return;

        if ( ! isset( $_POST[ $nonce_name ] ) || ! wp_verify_nonce( $_POST[ $nonce_name ], $nonce_action ) )
            return;
        if ( ! is_null( $deprecated ) )
            $post = get_post( $deprecated );
        else
            $post = get_post( $post );
        if ( 'revision' === $post->post_type )
            return;
        if ( ! current_user_can( 'edit_post', $post->ID ) )
            return;
        foreach ( (array) $data as $field => $value ) {
            if ( $value )
                update_post_meta( $post->ID, $field, $value );
            else
                delete_post_meta( $post->ID, $field );
        }
    }

    /**
     * Check post support
     * @param $type
     *
     * @return bool
     */
    public function is_support($type)
    {

        if(!is_admin())
            return false;
        if(function_exists('get_current_screen'))
        {
            $screen = get_current_screen();
            if(isset($screen->post_type) && !post_type_supports($screen->post_type,$type))
                return false;
        }else{
            global $post;
            if(isset($post->post_type) && !post_type_supports($post->post_type,$type))
                return false;
        }

        return true;
    }

    ################## OPTIONS UTILITIES #######################
    /**
     * Merge New Array Configs to Current Config
     * @param $array current configs
     * @param $array1 new configs
     *
     * @return mixed
     */
    public function parse_configs($current, $new)
    {
        $current = $this->recurse($current,$new);

        // handle the arguments, merge one by one
        $args = func_get_args();
        $current = $args[0];
        if (!is_array($current))
        {
            return $current;
        }
        for ($i = 1; $i < count($args); $i++)
        {
            if (is_array($args[$i]))
            {
                $current = $this->recurse($current, $args[$i]);
            }
        }
        return $current;
    }

    public function recurse($current, $new)
    {
        foreach ($new as $key => $value)
        {
            // create new key in $current, if it is empty or not an array
            if (!isset($current[$key]) || (isset($current[$key]) && !is_array($current[$key])))
            {
                $current[$key] = array();
            }

            // overwrite the value in the base array
            if (is_array($value))
            {
                $value = $this->recurse($current[$key], $value);
            }
            $current[$key] = $value;
        }
        return $current;
    }

    /**
     * Remove stripslashes for array
     * @param $value
     *
     * @return array|string
     */
    public function stripslashes_deep($value)
    {
        $value = is_array($value) ?
            array_map(array($this,'stripslashes_deep'), $value) :
            wp_unslash($value);
        return $value;
    }

    /**
     * Convert data input
     *
     */

    public function convert_int($string)
    {
        if(in_array($string, array("1","true")))
            return 1;
        if(in_array($string, array("0","false")))
            return 0;
        return $string;
    }
    ################## FUNCTIONS GENERATE HTML TEMPLATE #################
    /**
     * Generate textarea
     * @param $args
     *
     * @return string
     *
     */

    public function generate_textarea($args)
    {

        $id = isset($args['id']) ? 'id="'.$args['id'].'"' : '';

        $class = isset($args['class']) ? 'class="'.$args['class'].'"' : '';

        $group_class = isset($args['group_class']) ? $args['group_class'] : '';

        $label_class = isset($args['label_class']) ? 'class="'.$args['label_class'].'"' : '';

        $label = isset($args['label']) ? "<label {$label_class} for=\"{$args['id']}\">{$args['label']}</label>\n" : '';

        $desc = isset($args['desc']) ? "<p class=\"description-element\">{$args['desc']}</p>" : '';

        $is_group = isset($args['is_group']) ? $args['is_group'] : false;

        $name = isset($args['name']) ? "name=\"{$args['name']}\"" : '';

        $value = isset($args['value']) ? $args['value'] : '';

        $html = "<textarea {$name} {$id} {$class}>".esc_textarea($value)."</textarea>\n";

        $html= (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;

        $html = (isset($args['label_position']) && $args['label_position']=='before') ? $label.$html : $html.$label;

        if($is_group) $html = "<!--begin input -->\n"."<div class=\"form-group {$group_class}\">\n".$html."</div><!--end input -->\n";
        return $html;
    }

    /**
     * Generate input with social icon
     * @param $args
     *
     * @return string
     */
    public function generate_input_social($args)
    {
        $id = isset($args['id']) ? 'id="'.$args['id'].'"' : '';

        $class = isset($args['class']) ? 'class="'.$args['class'].'"' : '';

        $group_class = isset($args['group_class']) ? $args['group_class'] : '';

        $label_class = isset($args['label_class']) ? 'class="'.$args['label_class'].'"' : '';

        $label = isset($args['label']) ? "<label {$label_class} for=\"{$args['id']}\">{$args['label']}</label>\n" : '';

        $desc = isset($args['desc']) ? "<p class=\"description-element\">{$args['desc']}</p>" : '';

        $is_group = isset($args['is_group']) ? $args['is_group']:false;

        $name = isset($args['name']) ? "name=\"{$args['name']}\"" : '';

        $value =  isset($args['value']) ? sprintf("value='%s'",esc_attr($args['value'])) : '';

        $placeholder = isset($args['placeholder']) ? "placeholder=\"{$args['placeholder']}\"" : '';

        $position = isset($args['position']) ? $args['position'] : 'left';

        $icon = isset($args['icon']) ? $args['icon'] : '';

        $html = "<div class=\"input-social {$position}\"><input type=\"text\" {$id} {$class} {$name} {$value} {$placeholder}><span class=\"available-panel\"><i class=\"mdicon {$icon}\"></i></span></div>\n";

        $html= (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;

        $html = (isset($args['label_position']) && $args['label_position']=='before') ? $label.$html : $html.$label;

        if($is_group) $html = "<!--begin input -->\n"."<div class=\"form-group {$group_class}\">\n".$html."</div><!--end input -->\n";

        return $html;
    }

    /**
     * Generate standard input
     * @param $args
     *
     * @return string
     */
    public function generate_input($args)
    {
        $id = isset($args['id'])?'id="'.$args['id'].'"':'';

        $data_name = isset($args['dataname'])?'dataname="'.$args['dataname'].'"':'';

        $class = isset($args['class'])?'class="'.$args['class'].'"':'';

        $label_class = isset($args['label_class'])?'class="'.$args['label_class'].'"':'';

        $group_class = isset($args['group_class']) ? $args['group_class'] : '';

        $label = isset($args['label'])?"<label {$label_class} for=\"{$args['id']}\">{$args['label']}</label>\n":'';

        $desc = isset($args['desc'])?"<p class=\"description-element\">{$args['desc']}</p>":'';

        $is_group = isset($args['is_group'])?$args['is_group']:false;

        $name = isset($args['name'])?"name=\"{$args['name']}\"":'';

        $value =  isset($args['value'])?"value=\"".esc_attr($args['value'])."\"":'';

        $placeholder = isset($args['placeholder'])?"placeholder=\"{$args['placeholder']}\"":'';

        $text_before = isset($args['text_before']) ? $args['text_before'] : '';

        $html = $text_before;

        $html .= "<input type=\"text\" {$id} {$class} {$data_name} {$name} {$value} {$placeholder}>\n";

        $html= (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;

        $html = (isset($args['label_position']) && $args['label_position']=='before') ? $label.$html : $html.$label;

        if($is_group) $html = "<!--begin input -->\n"."<div class=\"form-group {$group_class}\">\n".$html."</div><!--end input -->\n";
        return $html;
    }

    /**
     * Generate checkbox with enable on-off switch style
     * @param $args
     *
     * @return string
     */
    public function generate_switch_on($args)
    {
        $id = isset($args['id']) ? 'id="'.$args['id'].'"' : '';

        $have_extra = isset($args['have_extra']) ? 'have-extra' : '';

        $extra_class = isset($args['extra_class']) ? $args['extra_class'] : '';

        $class = isset($args['class']) ? 'class="'.$args['class'].'"' : '';

        $desc = isset($args['desc']) ? "<p class=\"description-element\">{$args['desc']}</p>":'';

        $name = isset($args['name']) ? "name=\"{$args['name']}\"":'';

        $value =  isset($args['value']) ? $args['value']:0;

        $disabled = ($value=='1') ? "" : 'disabled';

        $checked = ($value=='1') ? "checked=\"checked\"" : '';

        $html ="<label class=\"click-enable\" data-id=\"switch-off\">
					<span>ON</span>
				</label>
				<label class=\"click-disable\" data-id=\"switch-on\">
					<span>OFF</span>
				</label>
				<input {$name} {$id} {$class} type=\"checkbox\" value=1 {$checked}>";

        $html = "<div class=\"md-switch-option on-off {$extra_class} {$have_extra} {$disabled}\">{$html}</div>";

        $html= (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;
        return $html;
    }

    /**
     * Generate checkbox with enable enable/disable switch style
     * @param $args
     *
     * @return string
     */
    public function generate_switch_enable($args)
    {
        $id = isset($args['id']) ? 'id="'.$args['id'].'"' : '';

        $have_extra = isset($args['have_extra']) ? 'have-extra' : '';

        $extra_class = isset($args['extra_class']) ? $args['extra_class'] : '';

        $class = isset($args['class']) ? 'class="'.$args['class'].'"' : '';

        $desc = isset($args['desc']) ? "<p class=\"description-element\">{$args['desc']}</p>" : '';

        $name = isset($args['name']) ? "name=\"{$args['name']}\"" : '';

        $value =  isset($args['value']) ? $args['value'] : 0;

        $disabled = ($value=='1') ? "" : 'disabled';

        $checked = ($value=='1') ? "checked=\"checked\"" : '';

        $html ="<label class=\"click-enable\" data-id=\"switch-custom\">
					<span>Enable</span>
				</label>
				<label class=\"click-disable\" data-id=\"switch-custom\">
					<span>Disable</span>
				</label>
				<input {$name} {$id} {$class} type=\"checkbox\" value=1 {$checked}>";

        $html ="<div class=\"md-switch-option {$extra_class} {$have_extra} {$disabled}\">{$html}</div>";

        $html= (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;
        return $html;
    }

    /**
     * Generate buton
     * @param $args
     *
     * @return string
     */
    public function generate_button($args)
    {
        $type = isset($args['type']) ? $args['type'] : 'button';

        $name = isset($args['name']) ? "name=\"{$args['name']}\" " : '';

        $id = isset($args['id']) ? 'id="'.$args['id'].'" ' : '';

        $class = isset($args['class']) ? 'class="'.$args['class'].'" ' : '';

        $group_class = isset($args['group_class']) ? $args['group_class'] : '';

        $label = isset($args['label']) ? $args['label'] : '';

        $desc = isset($args['desc']) ? "<p class=\"description-element\">{$args['desc']}</p>" : '';

        $is_group = isset($args['is_group'])?$args['is_group'] : false;
        switch($type)
        {
            case 'button':
                $html ="<button {$id}{$class}{$name}>{$label}</button>";
                break;
            case 'input':
                $html ="<input type=\"submit\" value=\"{$label}\" {$id}{$class}{$name}>";
                break;
            case 'a':
                $html ="<a href=\"#\" {$id}{$class}{$name}>{$label}</a>";
                break;
        }

        $html = (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;
        $html = ($is_group)?"<div class=\"form-group {$group_class}\">{$html}</div><!-- button tags <button> -->" : $html;
        return $html;
    }

    /**
     * Generate select
     * @param $args
     *
     * @return string
     */
    public function generate_select($args)
    {
        $id = isset($args['id']) ? 'id="'.$args['id'].'" ' : '';

        $class = isset($args['class']) ? 'class="'.$args['class'].'"' : '';

        $name = isset($args['name']) ? "name=\"{$args['name']}\"" : '';

        $label_class = isset($args['label_class']) ? 'class="'.$args['label_class'].'"' : '';

        $label = isset($args['label']) ? "<label {$label_class} for=\"".$args['id']."\">{$args['label']}</label>\n" : '';

        $desc = isset($args['desc']) ? "<p class=\"description-element\">{$args['desc']}</p>" : '';

        $is_group = isset($args['is_group']) ? $args['is_group'] : false;

        $group_class = isset($args['group_class']) ? $args['group_class'] : '';

        $value =  isset($args['value']) ? $args['value'] : 0;

        $choices = isset($args['options']) ? $args['options'] : array();

        $style = isset($args['style']) ? $args['style'] : '';

        $select_class = isset($args['select_class']) ? $args['select_class'] : '';

        $html ='';

        foreach($choices as $key=>$v)
        {
            if(is_array($v)){
                $option = '';
                foreach($v as $vv){
                    $select = ($vv==$value) ? "selected=\"selected\"" : '';
                    $option .= "<option {$select} value=\"{$vv}\">{$vv}</option>\n";

                }
                $html .= "<optgroup label=\"{$key}\">{$option}</optgroup>";

            }else{
                $select = ($key==$value) ? "selected=\"selected\"" : '';

                $html .= "<option {$select} value=\"{$key}\">{$v}</option>\n";
            }

        }
        if($html)
            $html = "<div {$class} {$style}>\n<select {$id} class=\"select $select_class\" {$name}>\n".$html."</select>\n</div><!-- select default -->\n";

        $html= (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;

        $html = (isset($args['label_position']) && $args['label_position']=='before') ? $label.$html : $html.$label;

        $html = ($is_group) ? "<div class=\"form-group {$group_class}\">\n".$html."</div>\n" : $html;

        return $html;
    }

    /**
     * Generate standard checkbox
     * @param $args
     *
     * @return string
     */
    public function generate_checkbox($args)
    {
        $label_class = isset($args['label_class']) ? 'class="'.$args['label_class'].'"' : '';

        $label = isset($args['label']) ? "<label {$label_class} for=\"{$args['id']}\">{$args['label']}</label>\n" : '';

        $disabled = isset($args['disabled']) ? "disabled" : '';

        $data_name = isset($args['dataname']) ? 'dataname="'.$args['dataname'].'"' : '';

        $name = isset($args['name']) ? "name=\"{$args['name']}\"" : '';

        $value =  isset($args['value']) ? $args['value'] : 0;

        $id = isset($args['id']) ? 'id="'.$args['id'].'" ' : '';

        $class = isset($args['class']) ? 'class="'.$args['class'].'"' : '';

        $checked = ($value=='1') ? "checked=\"checked\"" : '';

        $desc = isset($args['desc']) ? "<p class=\"description-element\">{$args['desc']}</p>" : '';

        $is_group = isset($args['is_group']) ? $args['is_group'] : false;

        $group_class = isset($args['group_class']) ? $args['group_class'] : '';

        $value =  isset($args['value']) ? 'value="'.$args['value'].'"' : '';

        $html ="<input {$id} {$class} {$data_name} type=\"checkbox\" {$name} {$checked} value=1 {$disabled}>";

        $html= (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;

        $html = (isset($args['label_position']) && $args['label_position']=='before') ? $label.$html : $html.$label;

        $html = ($is_group) ? "<div class=\"form-elements {$group_class}\">\n".$html."</div>\n" : $html;

        return $html;
    }

    /**
     * Generate standard checkbox with value input is array
     * @param $args
     *
     * @return string
     */
    public function generate_checkbox_array($args)
    {
        $label_class = isset($args['label_class']) ? 'class="'.$args['label_class'].'"' : '';

        $label = isset($args['label']) ? "<label {$label_class} for=\"{$args['id']}\">{$args['label']}</label>\n" : '';

        $disabled = isset($args['disabled']) ? "disabled" : '';

        $data_name = isset($args['dataname']) ? 'dataname="'.$args['dataname'].'"' : '';

        $name = isset($args['name']) ? "name=\"{$args['name']}\"" : '';

        $value =  isset($args['value']) ? $args['value'] : 0;

        $id = isset($args['id']) ? 'id="'.$args['id'].'" ' : '';

        $in_array = isset($args['in_array']) ? $args['in_array'] : '';

        $class = isset($args['class']) ? 'class="'.$args['class'].'"' : '';
        
        $checked = (in_array($in_array, $value)) ? "checked=\"checked\"" : '';

        $desc = isset($args['desc']) ? "<p class=\"description-element\">{$args['desc']}</p>" : '';

        $is_group = isset($args['is_group']) ? $args['is_group'] : false;

        $group_class = isset($args['group_class']) ? $args['group_class'] : '';

        $html ="<input {$id} {$class} {$data_name} type=\"checkbox\" {$name} {$checked} value=1 {$disabled}>";

        $html= (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;

        $html = (isset($args['label_position']) && $args['label_position']=='before') ? $label.$html : $html.$label;

        $html = ($is_group) ? "<div class=\"form-elements {$group_class}\">\n".$html."</div>\n" : $html;

        return $html;
    }


    /**
     * Generate Radio
     * @param $args
     *
     * @return string
     */
    public function generate_radio($args)
    {
        $disabled = isset($args['disabled']) ? "disabled" : '';

        $name = isset($args['name']) ? "name=\"{$args['name']}\"" : '';

        $default = isset($args['default']) ? "value=\"{$args['default']}\"" : 0;

        $checked = ($args['value']==$args['default']) ? "checked=\"checked\"" : '';

        $id = isset($args['id']) ? 'id="'.$args['id'].'" ' : '';

        $class = isset($args['class']) ? 'class="'.$args['class'].'"' : '';

        $label_class = isset($args['label_class']) ? 'class="'.$args['label_class'].'"' : '';

        $label = isset($args['label']) ? "<label {$label_class} for=\"{$args['id']}\">{$args['label']}</label>\n" : '';

        $desc = isset($args['desc']) ? "<p class=\"description-element\">{$args['desc']}</p>" : '';

        $is_group = isset($args['is_group']) ? $args['is_group'] : false;

        $group_class = isset($args['group_class']) ? $args['group_class'] : '';

        $html ="<input {$id} {$class} type=\"radio\" {$name} {$default} {$checked} {$disabled}>";

        $html= (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;

        $html = (isset($args['label_position']) && $args['label_position']=='before') ? $label.$html : $html.$label;

        $html = ($is_group) ? "<div class=\"form-elements {$group_class}\">\n".$html."</div>\n" : $html;

        return $html;
    }

    public function generate_upload_image($args)
    {
        $id = isset($args['id']) ? 'id="'.$args['id'].'"' : '';

        $class = isset($args['class']) ? 'class="'.$args['class'].' image-url"' : 'class="image-url"';

        $label_class = isset($args['label_class']) ? 'class="'.$args['label_class'].'"' : '';

        $label = isset($args['label']) ? "<label {$label_class} for=\"{$args['id']}\">{$args['label']}</label>\n" : '';

        $button_upload_class = isset($args['button_upload_class']) ? $args['button_upload_class'] : 'upload-img';

        $button_remove_class = isset($args['button_remove_class']) ? $args['button_remove_class'] : 'remove-img';

        $desc = isset($args['desc']) ? "<p class=\"description-element\">{$args['desc']}</p>" : '';

        $is_group = isset($args['is_group']) ? $args['is_group'] : false;

        $group_class = isset($args['group_class']) ? $args['group_class'] : '';

        $name = isset($args['name']) ? "name=\"{$args['name']}\"" : '';

        $value =  isset($args['value']) ? sprintf("value='%s'",stripslashes($args['value'])) : '';

        $placeholder = isset($args['placeholder']) ? "placeholder=\"{$args['placeholder']}\"" : '';

        $img = ($args['value']!='') ? "<img src=\"{$args['value']}\">" : "";

        $html = "<input type=\"hidden\" {$id} {$class} {$name} {$value} {$placeholder}>\n";

        $html .= "<button class=\"md-button {$button_upload_class}\">Upload</button>";

        $html .= "<button class=\"md-button gray {$button_remove_class}\">Remove</button>";

        $html = "<div class=\"upload-image\"><div class=\"img-preview\">{$img}</div>{$html}</div>";

        $html= (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;

        $html = (isset($args['label_position']) && $args['label_position']=='before') ? $label.$html : $html.$label;

        if($is_group) $html = "<!--begin input -->\n"."<div class=\"form-group {$group_class}\">\n".$html."</div><!--end input -->\n";

        return $html;
    }

    public function generate_upload_multi_image($args)
    {
        $id = isset($args['id']) ? 'id="'.$args['id'].'"' : '';

        $class = isset($args['class']) ? 'class="'.$args['class'].' multi-image-url"' : 'class="multi-image-url"';

        $label_class = isset($args['label_class']) ? 'class="'.$args['label_class'].'"' : '';

        $label = isset($args['label']) ? "<label {$label_class} for=\"{$args['id']}\">{$args['label']}</label>\n" : '';

        $desc = isset($args['desc']) ? "<p class=\"description-element\">{$args['desc']}</p>" : '';

        $is_group = isset($args['is_group']) ? $args['is_group'] : false;

        $group_class = isset($args['group_class']) ? $args['group_class'] : '';

        $button_upload_class = isset($args['button_upload_class']) ? $args['button_upload_class'] : 'upload-multi-img';

        $button_remove_class = isset($args['button_remove_class']) ? $args['button_remove_class'] : 'remove-multi-img';

        $name = isset($args['name']) ? "name=\"{$args['name']}\"" : '';

        $value =  isset($args['value']) ? "value=\"".htmlentities($args['value'])."\"" : '';

        $placeholder = isset($args['placeholder']) ? "placeholder=\"{$args['placeholder']}\"" : '';

        $html_img="";

        if($args['value']!=''){

            $imgs = json_decode(stripslashes($args['value']),true);

            if(is_array($imgs))
                foreach($imgs as $img)
                    $html_img .="<div class=\"img-thumbail\"><img src=\"{$img}\"><span class=\"js-del fa fa-times\"></span></div>";
        }


        $html = "<input type=\"hidden\" {$id} {$class} {$name} {$value}>\n";

        $html .= "<button class=\"md-button {$button_upload_class}\">Add Images</button>";

        // $html .= "<button class=\"md-button gray {$button_remove_class}\">Remove</button>";

        $html = "<div class=\"upload-image\"><div class=\"img-previews slider-sortable\">{$html_img}</div>{$html}</div>";

        $html= (isset($args['desc_position']) && $args['desc_position']=='before') ? $desc.$html : $html.$desc;

        $html = (isset($args['label_position']) && $args['label_position']=='before') ? $label.$html : $html.$label;

        if($is_group) $html = "<!--begin input -->\n"."<div class=\"form-group {$group_class}\">\n".$html."</div><!--end input -->\n";

        return $html;
    }
    /**
     * Generate select font style
     * @param        $title
     * @param string $desc
     * @param        $option_name
     */
    public function generate_select_font($title='',$desc='',$option_name,$show_color=false)
    {

        ?>
        <div class="md-tabcontent-row">
            <?php if($title!='' || $desc!=''):?>
                <div class="md-row-description">
                    <?php if($title!=''):?><h4 class="md-row-title"><?php echo $title;?></h4><?php endif;?>
                    <?php if($desc!=''):?>
                        <p class="description-element"><?php echo $desc;?></p>
                    <?php endif;?>
                </div><!-- /.md-row-description -->
            <?php endif;?>

            <?php
                $enable = $this->generate_checkbox(array("id"=>"enable-".$option_name,"class"=>"input-checkbox","name"=>"theme[typography][$option_name][enable]","value"=>$this->theme_options['typography'][$option_name]['enable'],'label'=>"Enable Custom ".ucwords($option_name)." Font?",'label_position'=>"after","label_class"=>"label-checkbox"));
                $enable = $this->wrap_group($enable);
                $enable = $this->wrap_elements($enable);
                $enable = $this->wrap_row_element($enable);
                echo $enable;
            ?>

            <div class="md-row-element" <?php if($this->theme_options['typography'][$option_name]['enable']==0):?>style="display: none"<?php endif;?>>
                <div class="form-inline">
                    <div class="form-group">
                        <label for="ty-font"><?php _e('Font Family',self::LANG);?></label>
                        <div class="md-selection medium">
                            <select class="select choose-font" id="ty-font" name="theme[typography][<?php echo $option_name;?>][font]">
                                <?php $list_fonts = $this->get_fonts();?>
                                <?php foreach($list_fonts as $font => $style): ?>
                                    <option <?php selected($font,$this->theme_options['typography'][$option_name]['font']);?> value="<?php echo $font;?>" data-style="<?php echo $style;?>"><?php echo urldecode($font);?></option>
                                <?php endforeach;?>
                            </select>
                        </div><!-- select default -->
                    </div>
                    <div class="form-group">
                        <label for="ty-font-weight">Weight</label>
                        <div class="md-selection small">
                            <select class="select choose-weight" id="ty-font-weight" name="theme[typography][<?php echo $option_name;?>][weight]">
                                <?php $weights = isset($list_fonts[$this->theme_options['typography'][$option_name]['font']])?$list_fonts[$this->theme_options['typography'][$option_name]['font']]:"n4";?>
                                <?php $weights = explode(",",$weights);?>
                                <?php foreach($weights as $w):?>
                                    <option <?php selected($w,$this->theme_options['typography'][$option_name]['weight'])?> value="<?php echo $w;?>"><?php echo $this->get_font_weight_name($w);?></option>
                                <?php endforeach;?>
                            </select>
                            <input type="hidden" class="font-weight" name="theme[typography][<?php echo $option_name;?>][weight]" value="<?php echo $this->theme_options['typography'][$option_name]['weight'];?>">
                        </div><!-- select default -->
                    </div>
                    <div class="form-group">
                        <label for="ty-font-size">Size</label>
                        <input id="ty-font-size" type="text" class="input-bgcolor small choose-size" value="<?php echo $this->theme_options['typography'][$option_name]['size'];?>" name="theme[typography][<?php echo $option_name;?>][size]">
                    </div>
                    <div class="form-group">
                        <label for="ty-font-style">Text transform</label>
                        <div class="md-selection small">
                            <select class="select choose-transform" id="ty-font-style" name="theme[typography][<?php echo $option_name;?>][transform]">
                                <option <?php selected($this->theme_options['typography'][$option_name]['transform'],"");?> value="">None</option>
                                <option <?php selected($this->theme_options['typography'][$option_name]['transform'],"capitalize");?> value="capitalize">Capitalize</option>
                                <option <?php selected($this->theme_options['typography'][$option_name]['transform'],"uppercase");?> value="uppercase">UpperCase</option>
                                <option <?php selected($this->theme_options['typography'][$option_name]['transform'],"lowercase");?> value="lowercase">LowerCase</option>
                            </select>
                        </div><!-- select default -->
                    </div>
                    <div class="form-group">
                        <label for="ty-font-style">Line Height</label>
                        <div class="md-selection small">
                            <select class="select choose-lineheight" id="ty-font-style" name="theme[typography][<?php echo $option_name;?>][lineheight]">
                                <option <?php selected($this->theme_options['typography'][$option_name]['lineheight'],"");?> value="">None</option>
                                <?php for($j=10;$j<=50;$j++):?>
                                    <option <?php selected($this->theme_options['typography'][$option_name]['lineheight'],$j);?> value="<?php echo $j;?>"><?php echo $j;?> px</option>
                                <?php endfor;?>
                            </select>
                        </div><!-- select default -->
                    </div>
                    <?php if(!$show_color):?><div style="display:none"><?php endif;?>
                    <div class="form-group">
                        <label for="ty-font-color">Font Color</label>
                        <input id="ty-font-color" type="text" name="theme[typography][<?php echo $option_name;?>][color]" class="small choose-color" value="<?php echo $this->theme_options['typography'][$option_name]['color'];?>">
                    </div>
                    <?php if(!$show_color):?></div><?php endif;?>
                </div>
            </div>
            <div class="demo-font" <?php if($this->theme_options['typography'][$option_name]['enable']==0):?>style="display: none"<?php endif;?>>
                <?php
                $style ='';
                if($this->theme_options['typography'][$option_name]['font']!='') $style .="font-family:".$this->theme_options['typography'][$option_name]['font'].";";
                if($this->theme_options['typography'][$option_name]['size']!='')
                    $style .="font-size:".$this->theme_options['typography'][$option_name]['size']."px;";
                else
                    $style .="font-size: 14px;";
                if($this->theme_options['typography'][$option_name]['weight']!='')$style .="font-style:".$this->get_font_style($this->theme_options['typography'][$option_name]['weight']).";";
                if($this->theme_options['typography'][$option_name]['transform']!='')$style .="text-transform:".$this->theme_options['typography'][$option_name]['transform'].";";
                if($this->theme_options['typography'][$option_name]['color']!='')$style .="color:".$this->theme_options['typography'][$option_name]['color'].";";
                if($this->theme_options['typography'][$option_name]['weight']!='')$style .="font-weight:".$this->get_font_weight($this->theme_options['typography'][$option_name]['weight']).";";
                ?>
                <p <?php if($style!='') echo "style=\"".$style."\"";?>>Grumpy wizards make toxic brew for the evil Queen and Jack.</p>
            </div>
        </div>

    <?php

    }

    /**
     * Generate header
     * @param string $title
     * @param string $desc
     * @param string $class
     */
    public function generate_header($title='',$desc='',$class='')
    {
        $title = ($title)?'<h3 class="md-tabcontent-title">'.$title.'</h3>':'';
        $desc =($desc)?'<p class="md-tabcontent-description">'.$desc.'</p>':'';
        $class = ($class)?'class="'.$class.'"':'';

        echo "<div class=\"md-tabcontent-header {$class}\">{$title}{$desc}</div><!-- /.md-tabcontent-header -->";
    }

    public function generate_label($title,$id='')
    {
        if($id)
            $id = 'for="{$id}"';
        return "<label {$id}>{$title}</label>";
    }
    /**
     * Generate description
     * @param $html
     *
     * @return string
     */
    public function generate_desc($html)
    {
        return "<p class=\"description-element\">{$html}</p>";
    }

    public function wrap_div($html,$class='',$style='')
    {
        if($class)
            return "<div class=\"{$class}\" {$style}>{$html}</div>";
        else
            return "<div>{$html}</div>";
    }
    /**
     * Generate wrap form-group
     * @param $input
     *
     * @return string
     */
    public function wrap_group($input,$class='',$style='')
    {
        return "<div class=\"form-group {$class}\" {$style}>\n".$input."</div>\n";
    }

    /**
     * Generate wrap form-elements
     * @param        $input
     * @param string $class
     * @param string $style
     *
     * @return string
     */
    public function wrap_elements($input,$class='',$style='')
    {

        return "<div class=\"form-elements {$class}\" {$style}>\n".$input."</div>\n";
    }

    /**
     * Generate wrap md-row-element
     * @param        $input
     * @param string $inline
     *
     * @return string
     */
    public function wrap_row_element($input,$inline='')
    {
        return "<div class=\"md-row-element {$inline}\">\n".$input."</div>\n";
    }

    /**
     * Add filter
     * @param $filter_name
     * @param $html
     *
     * @return string
     */
    public function add_filter($filter_name,$html)
    {
        if($filter_name && !empty($filter_name)){
            $display = apply_filters($filter_name,true);
            if($display==false)
                $html = "<div style=\"display:none\">{$html}</div>\n";
        }
        return $html;
    }

    /**
     * Generate section html
     * @param        $filter_name
     * @param        $title
     * @param        $subtile
     * @param        $content
     * @param string $class
     */
    public function generate_section_html($filter_name,$title,$subtile,$content,$class='')
    {
        $header = '';
        $html ='';
        if($title || $subtile)
        {
            if($title)
                $header = "<h4 class=\"md-row-title\">{$title}</h4>\n";
            if($subtile)
                $header .= "<p class=\"description-element\">{$subtile}</p>\n";
            $header = "<div class=\"md-row-description\">\n".$header."</div><!-- /.md-tabcontent-row -->\n";
        }
        $row = "<div class=\"md-row-element\">{$content}</div>\n";
        $html = "<div class=\"md-tabcontent-row {$class}\">{$header}{$row}</div>\n";

        if($filter_name && !empty($filter_name)){
            $display = apply_filters($filter_name,true);
            if($display==false)
                $html = "<div style=\"display:none\">{$html}</div>\n";
        }

        echo $html;
    }




}

?>