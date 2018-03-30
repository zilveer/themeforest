<?php
/**************************************************************
 *                                                            *
 *   Provide Theme Basic Settings                             *
 *   A Project of Mega Art Studio                             *
 *   Copyright @ MegaDrupal.com                               *
 *   Author: Duong Le                                         *
 *   Profile: http://themeforest.net/user/megadrupal          *
 *   Follow me: http://twitter.com/duongle87                  *
 *                                                            *
 **************************************************************/

Class AWEThemeSettings extends AweFramework
{

    const THEME_OPTIONS = 'AWE-Theme-Options';
    private $animation_options =array(
                                    'Attention Seekers'     =>  array(
                                        'bounce','flash','pulse','rubberBand','shake','swing','tada','wobble'
                                    ),
                                    'Bouncing Entrances'    =>  array(
                                        'bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp'
                                    ),

                                    'Fading Entrances'      =>  array(
                                        'fadeIn','fadeInDown','fadeInDownBig','fadeInLeft','fadeInLeftBig','fadeInRight','fadeInRightBig','fadeInUp','fadeInUpBig','fadeInhalf-text','fadeInhalf-symbolBig'
                                    ),

                                    'Flippers'              =>  array(
                                        'flip','flipInX','flipInY'
                                    ),
                                    'Lightspeed'            =>  array(
                                        'lightSpeedIn'
                                    ),
                                    'Rotating Entrances'    =>  array(
                                        'rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight'
                                    ),
                                    'Sliders'               =>  array(
                                        'slideInDown','slideInLeft','slideInRight'
                                    ),
                                    'Specials'              =>  array(
                                        'rollIn'
                                    ),
                                );
    protected $theme_options = array(
        'basic'             =>  array(
            'post-nav'         =>  'pre_nex',
            'favicon'           =>  '',
            'analytic'          =>'',
            ),
        'breadcrumbs'       =>  array(
                    'homepage'      =>  0,
                    'posts'         =>  0,
                    'pages'         =>  0,
                    'archives'      =>  0,
                    '404page'       =>  0,
                    'attachment'    =>  0,
            ),
        'comment'           =>  array(
                    'posts'         =>  1,
                    'pages'         =>  1
            ),
        'trackback'         =>  array(
                    'posts'         =>  1,
                    'pages'         =>  1,
            ),

        'logo'              =>  array(
            'text'              =>  'AweTheme Studio',
            'slogan'            =>  'Touching in the moment',
            'enable_slogan'     =>  1,
            'enable_image'      =>  1,
            'image'             =>  '',
            'image_height'      =>  '',
            'image_width'       =>  '',
        ),
        'logo_stickey'              =>  array(
            'text'              =>  'AweTheme Studio',
            'slogan'            =>  'Touching in the moment',
            'enable_slogan'     =>  1,
            'enable_image'      =>  1,
            'image'             =>  '',
            'image_height'      =>  '',
            'image_width'       =>  '',
        ),
        'logo_preload_1'              =>  array(
            'text'              =>  'AweTheme Studio',
            'slogan'            =>  'Touching in the moment',
            'enable_slogan'     =>  1,
            'enable_image'      =>  1,
            'image'             =>  '',
            'image_height'      =>  '',
            'image_width'       =>  '',
        ),
        'logo_preload_2'              =>  array(
            'text'              =>  'AweTheme Studio',
            'slogan'            =>  'Touching in the moment',
            'enable_slogan'     =>  1,
            'enable_image'      =>  1,
            'image'             =>  '',
            'image_height'      =>  '',
            'image_width'       =>  '',
        ),
        'header'            =>  array(
            'image'             =>  0,
            'logo-url'          =>  '',
            'script'            =>  ''
            ),
        'content'           =>  array(
            'archives'          =>  'content',
            'add-lead'          =>  0,
            'limit'             =>  250,
            'feature-image'     =>  0,
            'image-size'        =>  'thumbnail',
            'meta-box'          =>  0,
            'author-box'        =>  0,
            'share-box'         =>  0,
            'related-box'       =>  0,
            'show-cm'           =>  0,
            ),
        'layout'            =>  'MR',
        'footer'            =>  array(
            'content'           =>  0,
            'layout'            =>  1,
            'column'            =>  0,
            'widget'            =>  1,
            'menu'              =>  0,
            'remove'            =>  0,
            'copyright'         =>  'Copyright &#9400; by AweThemes.Com.',
            'script'            =>  ''
            ),
        'feed'              =>  array(
            'feed-url'          =>  '',
            'feed-redirect'     =>  0,
            'cm-feed-url'       =>  '',
            'cm-feed-redirect'  =>  0
            ),
        'twitter'           =>  array(
            'enable'            =>  0,
            'username'                  =>  '',
            'consumer_key'              =>  '',
            'consumer_secret'           =>  '',
            'access_token'              =>  '',
            'access_token_secret'       =>  '',
            'limit'             =>  5,
        ),

        'site-very'         =>  array(
            'google'            =>  '',
            'bing'              =>  ''
        ),
        'social'            =>  array(
            'enable'    =>  1,
            'facebook'  =>  array(
                'enable'      =>  1,
                'url'         =>  'https://www.facebook.com/awethemes',
            ),
            'twitter'  =>  array(
                'enable'      =>  1,
                'url'         =>  'https://twitter.com/awethemes',
            ),
            'google'  =>  array(
                'enable'      =>  0,
                'url'         =>  '',
            ),
            'github'  =>  array(
                'enable'      =>  0,
                'url'         =>  '',
            ),
            'instagram'  =>  array(
                'enable'      =>  0,
                'url'         =>  '',
            ),
            'pinterest'  =>  array(
                'enable'      =>  0,
                'url'         =>  '',
            ),
            'linkedin'  =>  array(
                'enable'      =>  0,
                'url'         =>  '',
            ),
            'skype'  =>  array(
                'enable'      =>  0,
                'url'         =>  '',
            ),
            'tumblr'  =>  array(
                'enable'      =>  0,
                'url'         =>  '',
            ),
            'vimeo'  =>  array(
                'enable'      =>  0,
                'url'         =>  '',
            ),
            'dribbble'  =>  array(
                'enable'      =>  0,
                'url'         =>  '',
            ),
            'flickr'  =>  array(
                'enable'      =>  0,
                'url'         =>  '',
            ),
            'youtube'  =>  array(
                'enable'      =>  0,
                'url'         =>  '',
            ),
        ),
        'font'              => array(
            'google'    =>  '',
            'typekit'   =>  '',
        ),
        'typography'        =>  array(
            'logo'       =>  array(
                'enable'    =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'slogan'       =>  array(
                'enable'    =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'navbar'       =>  array(
                'enable'    =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'h1'       =>  array(
                'enable'    =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'h2'       =>  array(
                'enable'    =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'h3'       =>  array(
                'enable'    =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'h4'       =>  array(
                'enable'    =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'h5'       =>  array(
                'enable'    =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'h6'       =>  array(
                'enable'    =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'p'       =>  array(
                'enable'    =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'body'       =>  array(
                'enable'    =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'content'       =>  array(
                'enable'        =>  0,
                'font'      =>  '',
                'size'      =>  '',
                'weight'    =>  '',
                'lineheight'     =>  '',
                'transform' =>  '',
                'color'     =>  '',
            ),
            'site-link'     => array(
                'color'         =>  '',
                'color-hover'   =>  '',
            ),

        ),
        'extra'             =>  array(

        ),

    );
    public $theme_extra_options = false;
    public $choose404 = 'post';
    public $theme_layout_options;
    protected $theme_options_name;
    public $default_config;
    public function __construct($default_config)
    {
        $this->default_config = $default_config;
        $this->theme_options_name = ($default_config) ? $default_config['theme_options_name']: self::THEME_OPTIONS;

        ##### LOADING DEFAULT SETTING ######
        $this->theme_refresh_option();
        if(is_admin()){

            #loading js
            add_action( 'admin_enqueue_scripts',            array($this, 'theme_loading_scripts'),20);
            add_action( 'admin_enqueue_scripts',               array($this, 'theme_loading_css'),20);
            add_action( 'admin_enqueue_scripts',              array($this, 'theme_print_css'));

            //register Theme Setting menu
            add_action( 'admin_menu',                        array($this,'register_theme_settings_menu' ));

            ######### AJAX SAVE DATA ############
            add_action('wp_ajax_awe_save', array( $this , 'ajax_save_data' ) );
            add_action('wp_ajax_awe_new_section_content',array($this, 'awe_new_section_content'));
            add_action('wp_ajax_awe_delete_section', array($this,'awe_delete_section'));
            add_action('wp_ajax_awe_add_new_section',       array($this,'awe_add_new_section'));
            add_action('wp_ajax_export_theme_settings', array( $this , 'export_theme_settings_callback' ) );
            add_action('wp_ajax_import_theme_settings', array( $this , 'import_theme_settings_callback' ) );
        }

        //Add filter theme options name
        add_filter( 'awe_theme_options_name',           array($this,'add_fitler_theme_option_name'));

        //Apply filter layout option
        $this->theme_layout_options = apply_filters('awe_layout_options',array('LM','MR','LMR','MRR','None'));



        ######### Active Customize ##########
        global $wp_version;

        if ( version_compare( $wp_version, '4.1', '>=' ) ) {
            include_once( "awecustomize4.x.php");
        }else{
            include_once( "awecustomize.php");
        }
        $this->customize = new AWECustomize($default_config);

        //$this->customize = new AWECustomize();
        ############# BASIC #################
        // add type post support
        add_action( 'init',                             array($this,'add_post_type_support'));
        // add custom layout for post/page
        add_action( 'admin_menu',                       array($this,'add_layout_box'),                          10);
        // save layout metabox
        add_action( 'save_post',                        array($this,'awe_layout_save'),                         1,2);
        //Add post custom body class
        add_filter( 'body_class',                       array($this,'custom_singular_body_class') );
        add_filter( 'post_class',                       array($this,'custom_singular_post_class') );

        add_action( 'wp_head',                          array($this,'custom_singular_script'),101);
        //favicon
        add_action( 'wp_head',                          array($this,'load_favicon') );


        ############# HEADER #################
        add_action( 'wp_head',                            array($this, 'theme_print_css'));
        //insert title into <title> tag
        add_filter( 'wp_title',                         array($this,'doctitle_wrap'),                           20 );
        //Set default title value
        add_filter( 'wp_title',                         array($this,'default_title'),                           9, 3 );
        //set default keywords meta
        add_filter( 'awe_keywords_meta',                array($this,'default_display_keywords'),                        1);
        //set default description meta
        add_action( 'awe_description_meta',             array($this,'default_display_description'),                     1);
        //display header
        add_filter( 'default_intro',                    array($this,'default_display_intro'));
        //Image logo
        add_filter( 'awe_logo',                         array($this, 'awe_logo'));
        // Image Stickey Logo
        add_filter( 'awe_logo_stickey',                  array($this, 'awe_logo_stickey'));
        //add pingback meta
        add_action( 'wp_head',                          array($this,'add_meta_pingback'),                       9);
        //html5 IE fix
        add_action( 'wp_head',                          array($this,'html5_ie_fix'),                            8);
        //insert google analytic
        add_action( 'wp_head',                          array($this,'gg_analytic'),                             20);
        //add custom script to wp_head()
        if(!empty($this->theme_options['header']['script']))
            add_action('wp_head',                                   array($this,'custom_header_script'),        100);

        ############# CONTENT #################
        add_action( 'widgets_init',                     array($this, 'register_content_sidebar'));
        add_action( 'awe_post_content',                 array($this,'post_feature_image'),                      100);
        add_action( 'awe_post_content',                 array($this,'post_content'),                            101);
        add_action( 'awe_lasted_post_content', array($this,'lastedpost_content'));
        /* Run Shortcode and Auto Embed */
        global $wp_embed;
        add_filter('awe_the_content_limit',             'do_shortcode');
        add_filter('awe_the_content_limit',             array( $wp_embed, 'run_shortcode'), 8);
        add_filter('awe_the_content_limit',             array( $wp_embed, 'autoembed'), 8);

        if($this->theme_options['content']['add-lead']==1)
            add_filter( 'the_content',                  array($this,'add_lead_first_paragraph'));

        //Theme Default layout
        add_filter( 'default_layout',                   array($this,'default_layout'));

        //save taxonomy meta data
        add_action( 'edit_term',                        array($this,'save_meta_data_taxonomy'),                  10, 2 );
        //delete taxonomy meta data
        add_action( 'delete_term',                      array($this,'delete_meta_data_taxonomy'),                10, 2 );
        //loading meta data
        add_filter( 'get_term',                         array($this,'loading_term_meta_data'), 10, 2 );
        add_filter( 'get_terms',                        array($this,'loading_terms_meta_data'), 10, 2 );
        //add taxonomy layout
        add_action( 'admin_init',                       array($this,'add_layout_taxonomy_options') );

        //posts navigation
        add_filter( 'post_navigation_type',             array($this,'post_navigation_type'));

        ############# COMMENT #################
        if(is_single() && $this->theme_options['comment']['posts']==0)
            remove_action('wp_head', 'feed_links_extra', 3);
        if(is_page() &&$this->theme_options['comment']['pages']==0)
            remove_action('wp_head', 'feed_links_extra', 3);

        add_action( 'wp_loaded',                        array( $this, 'comment_setup' ) );
        add_action( 'wp_loaded',                        array( $this, 'trackback_setup' ) );

        ############# BREADCRUMB #################
        add_filter( 'default_breadcrumbs',              array( $this, 'default_breadcrumbs'));
        //Share box
        add_filter( 'display_share_box',                array( $this, 'display_share_box'));
        add_filter( 'display_author_box',               array( $this, 'display_author_box'));
        add_filter( 'display_meta_box',                 array( $this, 'display_meta_box'));
        add_filter( 'display_comment_box',              array( $this, 'display_comment_box'));
        add_filter( 'display_related_box',              array( $this, 'display_related_box'));

        ############# FOOTER #################
        if($this->theme_options['footer']['widget']==1)
            add_action('widgets_init',                              array($this, 'register_footer_sidebar'));
        if($this->theme_options['footer']['menu']==1)
            add_action('init',                                      array($this, 'register_footer_menu'));
        
        add_filter('awe_remove_copyright',                                   array($this, 'copyright'),                          10, 1);
        if(!empty($this->theme_options['footer']['script']))
            add_action('wp_footer',                                 array($this, 'custom_footer_script'));
        if(!empty($this->theme_options['footer']['copyright']))
            add_filter('awe_copyright',                             array($this, 'awe_copyright'), 1);
        //filter footer column settings
        add_filter('footer_layout',                                 array($this, 'filter_footer_layout'));
        //display footer content with layout
        add_filter('display_footer_content',                        array($this, 'filter_footer_content'));
        //filter social footer
        add_filter('awe_social',                                    array($this, 'filter_social_footer'));


        ############# TWITTER ##############
        if($this->theme_options['twitter']['enable']==1)
        {
            add_filter( 'twitter_feeds',                            array($this, 'filter_twitter_feeds'),10,2);
        }
        ############# FEED #################
        if(!empty($this->theme_options['feed']['feed-url']) || !empty($this->theme_options['feed']['cm-feed-url']))
        {
            add_filter( 'feed_link',                                array($this,'feed_url'),                            10, 2 );

            if($this->theme_options['feed']['feed-redirect']==1 || $this->theme_options['feed']['cm-feed-redirect']==1)
                add_action( 'template_redirect',                        array($this,'feed_redirect') );
        }

        ############# TYPOGRAPHY ############
        add_filter('generate_css_typography',                       array($this,'css_typography'),10,1);
        add_action('awe_render_custom_section',                      array($this, 'awe_render_section'),10,1);
    }


    public function add_fitler_theme_option_name()
    {
        return $this->theme_options_name;
    }

    /**
     * Register Theme menu
     */
    public function register_theme_settings_menu()
    {
        add_menu_page( THEME_NAME, THEME_NAME, 'manage_options', 'AWE-Framework',array($this,'theme_settings'), '', 3);
        add_submenu_page( 'AWE-Framework', 'Theme Settings', 'Theme Settings', 'manage_options', 'AWE-Framework', array($this,'theme_settings') );
    }

    /**
     * Loading Wp admin default scripts
     */
    public function theme_loading_scripts()
    {
        global $pagenow;
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";
        wp_enqueue_script('media-upload');
        wp_enqueue_media();
        wp_enqueue_script('jquery-ui-resizable');
        if ( $pagenow == 'admin.php' && in_array('AWE-Framework',$_REQUEST)){
            wp_enqueue_script('awe-theme', AWE_JS_URL. 'theme'.$min.'.js', array("jquery"), null, false);
            wp_enqueue_script( 'spectrum-color', AWE_JS_URL . 'spectrum'.$min.'.js', array("jquery"),null,false );
            if(isset($this->default_config['extra_js']))
            {
                wp_enqueue_script('awe-extra-js', $this->default_config['extra_js'],null,false);
            }
        }


    }

    public function theme_print_css(){
        if($this->theme_options['font']['google']!='')
            echo stripslashes($this->theme_options['font']['google']);

    }

    public function theme_loading_css()
    {
        global $pagenow;
        if ( $pagenow == 'admin.php' && in_array('AWE-Framework',$_REQUEST))

           { wp_enqueue_style('awe-spectrum', AWE_CSS_URL.'spectrum.css',null,false);
                       if(isset($this->default_config['extra_css']))
                       {
                           wp_enqueue_style('awe-extra', $this->default_config['extra_css'],null,false);
                       }}
    }
    /**
     * Reload theme options
     */
    public function theme_refresh_option()
    {
        $this->theme_options['extra'] = ($this->default_config)? $this->default_config['extra_options']:array();

        $new_configs = isset($this->default_config['theme_new_configs'])?$this->default_config['theme_new_configs']:array();

        $this->theme_options = $this->parse_configs($this->theme_options,$new_configs);

        if(isset($_POST['reset-theme'])) {

            delete_option($this->theme_options_name);

            $this->add_message('success','Reset OK!');

        }

        if(isset($_POST['save-theme']))
        {
            $data_sent = $this->stripslashes_deep($_POST);

            $data_sent = filter_var($data_sent, FILTER_CALLBACK, array("options"=>array($this,"convert_int"),'flags' => FILTER_REQUIRE_ARRAY));

            $options = $this->theme_save_options($data_sent);
        }else
            $options = get_option($this->theme_options_name);

        if(!isset($options) || empty($options))
            update_option($this->theme_options_name,$this->theme_options);

        if(is_array($options)){
            $this->theme_options = array_merge($this->theme_options,$options);
            if($this->theme_options!==$options){
                update_option($this->theme_options_name,$this->theme_options);
            }
        }

    }

    /**
     * Ajax save data
     */




    public function ajax_save_data()
    {
        if(check_ajax_referer('awe-theme-settings-save','_wpnonce') && isset($_REQUEST['_wp_http_referer']) && preg_match("/AWE-Framework/i",$_REQUEST['_wp_http_referer']))
        {
            parse_str(json_decode(utf8_decode(stripslashes($_POST['data'])),true), $data_sent);
            $data_sent = $this->stripslashes_deep($data_sent);
            $data_sent = filter_var($data_sent, FILTER_CALLBACK, array("options"=>array($this,"convert_int"),'flags' => FILTER_REQUIRE_ARRAY));
            if($data_sent)
            {
                $options = $this->theme_save_options($data_sent);
                echo json_encode(array("type"=>"success","msg"=>"Save Ok! (^_^)"));
            }else
                echo json_encode(array("type"=>"error","msg"=>"Something wrong please check again (@_@)"));
        }
         else echo json_encode(array("type"=>"error","msg"=>"Something wrong please check again (@_@)"));
        exit();
    }
    /**
     * Save submit data
     */
    public function theme_save_options($data_sent)
    {
        //breadcrumbs
        $settings['breadcrumbs'] = (isset($data_sent['theme']['breadcrumbs']))? $data_sent['theme']['breadcrumbs'] :array();
        $noncheckbox = array_diff_key($this->theme_options['breadcrumbs'], $settings['breadcrumbs']);
        foreach ($noncheckbox as $i => $v) {
            $noncheckbox[$i] = 0;
        }
        $settings['breadcrumbs'] = array_merge($settings['breadcrumbs'], $noncheckbox);

        //comment
        $settings['comment'] = (isset($data_sent['theme']['comment']))? $data_sent['theme']['comment'] :array();
        $noncheckbox = array_diff_key($this->theme_options['comment'], $settings['comment']);
        foreach ($noncheckbox as $i => $v) {
            $noncheckbox[$i] = 0;
        }
        $settings['comment'] = array_merge($settings['comment'], $noncheckbox);
        //trackback
        $settings['trackback'] = (isset($data_sent['theme']['trackback']))? $data_sent['theme']['trackback'] :array();
        $noncheckbox = array_diff_key($this->theme_options['trackback'], $settings['trackback']);
        foreach ($noncheckbox as $i => $v) {
            $noncheckbox[$i] = 0;
        }
        $settings['trackback'] = array_merge($settings['trackback'], $noncheckbox);

        //basic

        $settings['basic'] = (isset($data_sent['theme']['basic']))? $data_sent['theme']['basic'] :array();
        $noncheckbox = array_diff_key($this->theme_options['basic'], $settings['basic']);
        $not_checkbox = array('frontpage');
        foreach ($noncheckbox as $i => $v) {
            if(in_array($i,$not_checkbox)) $noncheckbox[$i]=1;
            else $noncheckbox[$i] = '';
        }

        $settings['basic'] =  array_merge($settings['basic'], $noncheckbox);

        //content
        $settings['content'] = (isset($data_sent['theme']['content']))? $data_sent['theme']['content'] :array();
        $noncheckbox = array_diff_key($this->theme_options['content'], $settings['content']);
        $not_checkbox = array('archives');
        foreach ($noncheckbox as $i => $v) {
            if(in_array($i,$not_checkbox)) $noncheckbox[$i]='content';
            else $noncheckbox[$i] = 0;
            if($i=='image-size') $noncheckbox[$i]='thumbnail';
        }
        $settings['content'] =  array_merge($settings['content'], $noncheckbox);

        //footer
        $settings['footer'] = (isset($data_sent['theme']['footer']))? $data_sent['theme']['footer'] :array();
        $noncheckbox = array_diff_key($this->theme_options['footer'], $settings['footer']);
        $not_checkbox = array('copyright');
        foreach ($noncheckbox as $i => $v) {
            if(in_array($i,$not_checkbox)) $noncheckbox[$i]='';
            else $noncheckbox[$i] = 0;
            if($i=='layout') $noncheckbox[$i]='1';
        }
        $settings['footer'] =  array_merge($settings['footer'], $noncheckbox);

        //layout
        $settings['layout'] = (isset($data_sent['theme']['layout']))? $data_sent['theme']['layout'] :'MR';

        //feed
        $settings['feed'] = (isset($data_sent['theme']['feed']))? $data_sent['theme']['feed'] :array();
        $noncheckbox = array_diff_key($this->theme_options['feed'], $settings['feed']);
        $not_checkbox = array('feed-url','cm-feed-url');
        foreach ($noncheckbox as $i => $v) {
            if(in_array($i,$not_checkbox)) $noncheckbox[$i]='';
            else $noncheckbox[$i] = 0;
        }
        $settings['feed'] =  array_merge($settings['feed'], $noncheckbox);


        $settings['font'] = (isset($data_sent['theme']['font']))? $data_sent['theme']['font'] :array();
        $noncheckbox = array_diff_key($this->theme_options['font'], $settings['font']);
        foreach ($noncheckbox as $i => $v) {
            $noncheckbox[$i] = '';
        }
        $settings['font'] =  array_merge($settings['font'], $noncheckbox);


        $settings['typography'] = (isset($data_sent['theme']['typography']))? $data_sent['theme']['typography'] :array();
        $settings['typography'] = $this->parse_configs($this->theme_options['typography'],$settings['typography']);

        /* Get options */
        $options = get_option($this->theme_options_name);

        //logo
        $settings['logo'] = (isset($options) && !empty($options))?$options['logo']:$this->theme_options['logo'];
        $settings['logo'] =  $this->parse_configs($settings['logo'],$data_sent['theme']['logo']);

        //logo
        $settings['logo_stickey'] = (isset($options) && !empty($options))?$options['logo_stickey']:$this->theme_options['logo_stickey'];
        $settings['logo_stickey'] =  $this->parse_configs($settings['logo_stickey'],$data_sent['theme']['logo_stickey']);

        //logo
        $settings['logo_preload_1'] = (isset($options) && !empty($options))?$options['logo_preload_1']:$this->theme_options['logo_preload_1'];
        $settings['logo_preload_1'] =  $this->parse_configs($settings['logo_preload_1'],$data_sent['theme']['logo_preload_1']);

        //logo
        $settings['logo_preload_2'] = (isset($options) && !empty($options))?$options['logo_preload_2']:$this->theme_options['logo_preload_2'];
        $settings['logo_preload_2'] =  $this->parse_configs($settings['logo_preload_2'],$data_sent['theme']['logo_preload_2']);

        //header
        $settings['header'] = (isset($options) && !empty($options))?$options['header']:$this->theme_options['header'];
        $settings['header'] =  $this->parse_configs($settings['header'],$data_sent['theme']['header']);


        /* Twitter */
        $settings['twitter'] = (isset($options) && !empty($options))?$options['twitter']:$this->theme_options['twitter'];
        $settings['twitter'] =  $this->parse_configs($settings['twitter'],$data_sent['theme']['twitter']);

        /* Social */
        $settings['social'] = (isset($options) && !empty($options))?$options['social']:$this->theme_options['social'];
        $settings['social'] =  $this->parse_configs($settings['social'],$data_sent['theme']['social']);

        /* Extra config */

        $extra = (isset($options) && !empty($options))?$options['extra']:$this->theme_options['extra'];
        if(isset($data_sent['theme']['extra']))
        {
            $settings['extra'] = $this->parse_configs($extra,$data_sent['theme']['extra']);
        }else
            $settings['extra'] = $extra;
        if(isset($settings['extra']['style_color']) && $settings['extra']['style_color']=='custom')
        {
            $custom_color_config = $this->default_config['generate_custom_color'];
            $this->generate_custom_color_css($settings['extra']['style_color_custom'],$custom_color_config);
        }
        update_option($this->theme_options_name,$settings);
        $this->add_message('success','Save Ok');
        return $settings;
    }


    /**
     * Generate Theme Settings
     */
    public function theme_settings()
    {

        include('settings_tpl.php');
    }

    /**
     * Add post type support
     */
    public function add_post_type_support()
    {
        add_post_type_support( 'post', array( 'awe-seo', 'awe-layouts', 'awe-rel-author' ) );

        add_post_type_support( 'page', array( 'awe-seo', 'awe-layouts' ) );
    }

    /**
     * Generate Custom Color CSS file
     */

    public function hex2rgb($hex,$opacity=false) {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }

        if($opacity){
            $rgb = array($r, $g, $b,$opacity);
            return "rgba(".implode(",", $rgb).")";
        }
        else{
            $rgb = array($r, $g, $b);
            return "rgb(".implode(",", $rgb).")";
        }


    }
    public function generate_custom_color_css($color_input,$config) {
        $color_default=$config['color_default'];


        $file_source = $config['file_source'];
        $file_name=$config['file_name'];

        if(!is_admin())
            return;
        $enable = apply_filters('enable_custom_color_css',false);
        if(!$enable || !$color_input)
            return;
        $current_color = get_options($this->theme_options_name.'custom_color');
        if(empty($current_color) || $current_color!=$color_input);{

            update_option($this->theme_options_name.'custom_color',$color_input);
            /** Define some vars **/
            $uploads = wp_upload_dir();
            $css_dir = get_template_directory() . '/assets/css/'; // Shorten code, save 1 call

            /** Save on different directory if on multisite **/
            if(is_multisite()) {
                $aq_uploads_dir = trailingslashit($uploads['basedir']);
            } else {
                $aq_uploads_dir = $css_dir;
            }

            /** Capture CSS output **/
            ob_start();
            require($css_dir . $file_source);
            $css = ob_get_clean();
            $css = str_replace($color_default,$color_input,$css);
            $rgba_color = (isset($config['rgba_default'])) ? $config['rgba_default'] : false;
            if($rgba_color)
            {
                $opacity = str_replace(array("rgba(",")"),array("",""),$rgba_color);
                $opacity = explode(",",$opacity);
                $css = str_replace($rgba_color,$this->hex2rgb($color_input,$opacity[3]),$css);
            }
            /** Write to options.css file **/
            global $wp_filesystem;

            if (empty($wp_filesystem)) {
                require_once (ABSPATH . '/wp-admin/includes/file.php');
                WP_Filesystem();
            }
            if ( ! $wp_filesystem->put_contents( $aq_uploads_dir . $file_name, $css, 0644) ) {
                return true;
            }
        }
    }

    /**
     * BASIC
     */

    /**
     * Add Favicon
     */
    public function load_favicon()
    {

        $favicon = (!empty($this->theme_options['basic']['favicon']))?$this->theme_options['basic']['favicon']:false;
        if($favicon)
            echo '<link rel="Shortcut Icon" href="' . esc_url( $favicon ) . '" type="image/x-icon" />' . "\n";
    }

    /**
     * POSTS NAVIGATION
     */
    public function post_navigation_type()
    {
        $type = ($this->theme_options['basic']['post-nav'])?$this->theme_options['basic']['post-nav']:'pre_nex';
        return $type;
    }


    /**
     * Remove comment to each posts/pages
     */
    public function comment_setup()
    {
        //remove support comment
        if( post_type_supports( 'post', 'comments' ) && $this->theme_options['comment']['posts']==0)
            remove_post_type_support( 'post', 'comments' );
        if( post_type_supports( 'page', 'comments')  && $this->theme_options['comment']['pages']==0)
            remove_post_type_support( 'page', 'comments' );

        add_filter( 'comments_open',                    array( $this, 'filter_disable_comment_status' ), 20, 2 );
    }

    /**
     * Remove trackback to each posts/pages
     */
    public function trackback_setup()
    {
        if( post_type_supports( 'post', 'trackbacks' ) && $this->theme_options['trackback']['posts']==0)
            remove_post_type_support( 'post', 'trackbacks' );
        if( post_type_supports( 'page', 'trackbacks')  && $this->theme_options['trackback']['pages']==0)
            remove_post_type_support( 'page', 'trackbacks' );
        add_filter( 'pings_open',                       array( $this, 'filter_disable_ping_status' ), 20, 2 );
    }

    /**
     * Filter disable comment status
     * @param $open
     * @param $post_id
     *
     * @return bool
     */
    public function filter_disable_comment_status( $open, $post_id ) {
        $post = get_post( $post_id );
        if(($this->theme_options['comment']['posts']==0 && $post->post_type=='post')||($this->theme_options['comment']['pages']==0 && $post->post_type=='page'))
            return false;
        return $open;
    }

    /**
     * Filter disable trackback status
     * @param $open
     * @param $post_id
     *
     * @return bool
     */
    public function filter_disable_ping_status( $open, $post_id ) {
        $post = get_post( $post_id );
        if(($this->theme_options['trackback']['posts']==0 && $post->post_type=='post')||($this->theme_options['trackback']['pages']==0 && $post->post_type=='page'))
            return false;
        return $open;
    }

    /**
     * CONTENT
     */

    /**
     * Register sidebar
     */
    public function register_content_sidebar()
    {
        //register home sidebar
        if(in_array("MRR",$this->theme_layout_options))
            $ids = array("Left","Right1","Right2");
        else
            $ids = array("sidebar",);

        foreach($ids as $id){
            $args = array(
                'name'          => sprintf(__('Sidebar %s',self::LANG), $id ),
                'id'            => $id,
                'description'   => '',
                'before_widget' => '<aside id="%1$s" class="widget %2$s sidebar-module-inset">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h2 class="title-right-blog">',
                'after_title'   => '</h2>' );
            register_sidebar( $args );
        }
    }

    /**
     * if is not single post -> add feature image into post
     */
    public function post_feature_image()
    {
        if ( ! is_singular() && $this->theme_options['content']['feature-image'] ) {

            $img = (has_post_thumbnail())? get_the_post_thumbnail(null,$this->theme_options['content']['image-size']):false;
            if ( $img )
                printf( '<p><a href="%1$s" title="%2$s">%3$s</a></p>', get_the_permalink(), get_the_title(), $img );
        }
    }

    /**
     * if display is content
     * if limit 0 return full content
     * if limit>0 return content limited
     * if display is excerpt return excerpt
     */
    public function post_content() {
        global $post;

        if ( is_singular() ) {
            the_content();
            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', self::LANG ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ));
            if ( is_single() && 'open' === get_option( 'default_ping_status' ) && post_type_supports( $post->post_type, 'trackbacks' ) ) {
                echo '<!--';
                trackback_rdf();
                echo '-->' . "\n";
            }

        }
        elseif ( 'excerpt' == $this->theme_options['content']['archives'] ) {
            the_excerpt();
        }
        else {

            $read_more_text = apply_filters('awe_read_more_label', __( '[Read more...]', self::LANG ));
            if ( is_numeric($this->theme_options['content']['limit']) &&  $this->theme_options['content']['limit']!=0){
                $this->the_content_limit( (int) $this->theme_options['content']['limit'], $read_more_text);
            }
            else{
                global $more;
                $more=0;
                the_content( $read_more_text );
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', self::LANG ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ));
            }
        }

    }

    public function lastedpost_content(){
        global $post;
        if(is_numeric($this->theme_options['content']['limit']) && $this->theme_options['content']['limit'] != 0 )
        {
            echo $this->the_content_limit((int) $this->theme_options['content']['limit'],'...');
        }else{
            the_content('...');
        }
    }

    /**
     * Put first paragraph of content into <p class="lead"> tag to highlight this
     * @param string $content content input
     *
     * @return string mixed the content after add lead tag into first paragraph
     */
    public function add_lead_first_paragraph( $content ){
        global $post;

        // if we're on the homepage, don't add the lead class to the first paragraph of text
        if( is_page_template( 'page-homepage.php' ) )
            return $content;
        else
            return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1);
    }

    /**
     * Return content stripped down and limited content.
     *
     * @param integer $max_characters The maximum number of characters to return.
     * @param string  $more_link_text Optional. Text of the more link. Default is "(more...)".
     * @param bool    $stripteaser    Optional. Strip teaser content before the more text. Default is false.
     *
     * @return string Limited content.
     */
    function the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {
        global $more;
        $more=0;
        $content = get_the_content( '', $stripteaser );

//        $content = strip_tags( strip_shortcodes( $content ), '<script>,<style>' );
        $content = strip_tags( $content, '<script>,<style>,<--more-->' );

        $content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );
//
        //* Truncate $content to $max_char
        $content = $this->truncate_pharse( $content, $max_characters );
        $content = apply_filters('awe_the_content_limit',$content);
        //* More link?
        if ( $more_link_text ) {
            $more_link_class = apply_filters('awe_more_link_class','more-link');
            $link   = sprintf( '<a href="%1$s" class="%2$s">%3$s</a>', get_permalink(),$more_link_class, $more_link_text );
//            $output = sprintf( '%s &#x02026;', $content);
            $desc_class = apply_filters("post_content_class","");
            if(!empty($desc_class))
                $desc_class = "class=\"{$desc_class}\"";
            $output = sprintf( '<p %1$s>%2$s</p>', $desc_class, $content);
            $more_wrap = apply_filters('awe_read_more_wrap',true);
            if($more_wrap)
                $output .= sprintf( '<div class="post-control">%s</div>',$link );
            else
                $output .= sprintf( '%s',$link );
        } else {
            $output =$content;
        }
        echo $output;

    }

    /**
     * Return a phrase shortened in length to a maximum number of characters.
     *
     * @param string $text            A string to be shortened.
     * @param integer $max_characters The maximum number of characters to return.
     *
     * @return string Truncated string
     */
    public function truncate_pharse($text, $max_characters)
    {
        $text = trim( $text );
        if(function_exists('mb_strlen'))
            if ( mb_strlen( $text ) > $max_characters ) {
                $text = mb_substr( $text, 0, $max_characters + 1 );
                $text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
            }
        else
            if ( strlen( $text ) > $max_characters ) {
                $text = substr( $text, 0, $max_characters + 1 );
                $text = trim( substr( $text, 0, strrpos( $text, ' ' ) ) );
            }
        return $text;
    }

    /**
     * Display share box
     */
    public function display_share_box()
    {
        if($this->theme_options['content']['share-box']==0)
            return false;
        else return true;
    }

    /**
     * Display author box
     */
    public function display_author_box()
    {
        if($this->theme_options['content']['author-box']==0)
            return false;
        return true;
    }

    /**
     * Display meta box
     */
    public function display_meta_box()
    {
        if($this->theme_options['content']['meta-box']==0)
            return false;
        return true;
    }

    /**
     * Display related box
     * @return bool
     */
    public function display_related_box()
    {
        if($this->theme_options['content']['related-box']==0)
            return false;
        return true;
    }
    /**
     * COMMENT
     */
    public function display_comment_box()
    {
        if($this->theme_options['content']['show-cm']==0)
            return false;
        return true;

    }

    /**
     * HEADER
     */

    /**
     * Insert google analytic code
     */
    public function gg_analytic()
    {
        if(!empty($this->theme_options['basic']['analytic']))
            echo $this->theme_options['basic']['analytic']."\n";
    }

    /**
     * Insert title into <title> tag
     * @param $title
     *
     * @return string with wrap title tag
     */
    public function doctitle_wrap( $title ) {

        return is_feed() || is_admin() ? $title : sprintf( "<title>%s</title>\n", $title );

    }

    public function default_title( $title, $sep ) {
        global $paged, $page;

        if ( is_feed() ) {
            return $title;
        }

        // Add the site name.
        $title .= get_bloginfo( 'name', 'display' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) {
            $title = "$title $sep $site_description";
        }

        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 ) {
            $title = "$title $sep " . sprintf( __( 'Page %s', self::LANG ), max( $paged, $page ) );
        }

        return $title;
    }
    /**
     * Setup Keywords Meta
     */
    public function default_display_keywords()
    {
        global $wp_query;

        $keywords = '';
        if ( is_category() ) {
            $term     = $wp_query->get_queried_object();
            $keys = (!empty($term->keywords))?$term->keywords:'';
            $keywords = ! empty( $term->meta_data['keywords'] ) ? $term->meta_data['keywords'] : $keys;
        }

        if ( is_tag() ) {
            $term     = $wp_query->get_queried_object();
            $keys = (!empty($term->keywords))?$term->keywords:'';
            $keywords = ! empty( $term->meta_data['keywords'] ) ? $term->meta_data['keywords'] : $keys;
        }

        if ( is_tax() ) {
            $term     = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $keys = (!empty($term->keywords))?wp_kses_stripslashes( wp_kses_decode_entities( $term->keywords ) ):'';
            $keywords = ! empty( $term->meta_data['keywords'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta_data['keywords'] ) ) : $keys;
        }

        if ( is_author() ) {
            $user_keywords = get_the_author_meta( 'meta_keywords', (int) get_query_var( 'author' ) );
            $keywords = $user_keywords ? $user_keywords : '';
        }
        if ( $keywords ){
            $text = sprintf("<meta name=\"keywords\" content=\"%s\" />", $keywords) . "\n";
            $output = apply_filters('default_keywords',$text);
        }

        else
            $output = apply_filters('default_keywords','');
        echo $output;
    }

    /**
     * Setup Description Meta
     */
    public function default_display_description()
    {
        global $wp_query;

        $description = '';
        if ( is_front_page() )
            $description = get_bloginfo( 'description' );
        if ( is_category() ) {
            //$term = get_term( get_query_var('cat'), 'category' );

            $term = $wp_query->get_queried_object();
            $desc = (!empty($term->description))?$term->description:'';
            $description = ! empty( $term->meta_data['description'] ) ? $term->meta_data['description'] : $desc;
        }

        if ( is_tag() ) {
            //$term = get_term( get_query_var('tag_id'), 'post_tag' );
            $term = $wp_query->get_queried_object();
            $desc = (!empty($term->description))?$term->description:'';
            $description = ! empty( $term->meta_data['description'] ) ? $term->meta_data['description'] : $desc;
        }

        if ( is_tax() ) {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $desc = (!empty($term->description))?$term->description:'';
            $description = ! empty( $term->meta_data['description'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta_data['description'] ) ) : $desc;
        }

        if ( is_author() ) {
            $user_description = get_the_author_meta( 'meta_description', (int) get_query_var( 'author' ) );
            $description = $user_description ? $user_description : '';
        }
        if ( $description )
            $output = apply_filters('default_description','<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n");
        else
            $output = apply_filters('default_description','');
        echo $output;
    }


    /**
     * Display header
     * @param bool $args
     */
    public function default_display_intro($header)
    {


        $headline='';
        $intro = '';
        if(is_category())
        {
            $headline = "<span>".__("Posts Categorized:", self::LANG)."</span> ".single_cat_title('',false);
        }
        if(is_tag())
        {
            $headline = "<span>".__("Posts Tagged:", self::LANG)."</span> ".single_tag_title('',false);
        }
        if(is_author())
        {
            // If google profile field is filled out on author profile, link the author's page to their google+ profile page
            $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
            $google_profile = get_the_author_meta( 'googleplus', $curauth->ID );
            $author = get_the_author_meta('display_name');
            if ( $google_profile )
                $author = '<a href="' . esc_url( $google_profile ) . '" rel="me">' . $author . '</a>';
            $headline = "<span>".__("Posts By:", self::LANG)."</span> ".$author;
        }
        if(is_day())
        {
            $headline = "<span>".__("Daily Archives:", self::LANG)."</span> ".the_time('l, F j, Y');

        }
        if(is_month())
        {
            $headline = "<span>".__("Monthly Archives:", self::LANG)."</span> ".the_time('F Y');

        }
        if(is_year())
        {
            $headline = "<span>".__("Yearly Archives:", self::LANG)."</span> ".the_time('Y');

        }
        if(is_post_type_archive())
        {
            $headline = "<span>".__("Posts Archives:", self::LANG)."</span> ".post_type_archive_title('',false);

        }
        $header = array(
            'headline'  =>  $headline,
            'intro'     =>  $intro,
        );
        return $header;
    }

    /**
     * Add the pingback meta tag
     */
    public function add_meta_pingback()
    {
        if(get_option('default_ping_status')=='open')
            echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />' . "\n";
    }

    /**
     * Image logo
     */
    public function awe_logo()
    {
            return $this->theme_options['logo'];
    }

    public function awe_logo_stickey(){
            return $this->theme_options['logo_stickey'];
    }

    /**
     * Fix HTML5 for IE
     */
    public function html5_ie_fix()
    {
        if(!current_theme_supports( 'html5' ))
            return;
        echo '<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->' . "\n";
    }

    /**
     * Add custom script to wp_head()
     */
    public function custom_header_script()
    {
        echo stripslashes($this->theme_options['header']['script'])."\n";
    }



    /**
     * LAYOUT
     */

    /**
     * if isest(post/page) layout return singular layout
     * else return generate layout
     */

    public function default_layout()
    {
        global $wp_query;
        $layout = "MR";
        if($this->theme_options['layout'] && $this->theme_options['layout']!='')
            $layout = $this->theme_options['layout'];
        if ( is_singular() ) {
            if ( $this->get_custom_fields( 'singular-layout' ) && $this->get_custom_fields( 'singular-layout' )!='default' )
                $layout = $this->get_custom_fields( 'singular-layout' );
        }

        if(is_category())
        {
            $term  = $wp_query->get_queried_object();
            $layout = (! empty( $term->meta_data['layout'] ) && $term->meta_data['layout']!='default') ? $term->meta_data['layout'] : $layout;
        }
        if(is_tag())
        {
            $term  = $wp_query->get_queried_object();
            $layout = (! empty( $term->meta_data['layout'] ) && $term->meta_data['layout']!='default') ? $term->meta_data['layout'] : $layout;
        }
        if ( is_tax() ) {
            $term  = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $layout = (! empty( $term->meta_data['layout'] ) && $term->meta_data['layout']!='default') ? $term->meta_data['layout'] : $layout;
        }

        if ( is_author() ) {
            $user_title = get_the_author_meta( 'layout', (int) get_query_var( 'author' ) );
            $layout      = ($user_title && $user_title!='' && $user_title!='default') ? $user_title : $layout;
        }
        if ( is_post_type_archive() ) {
            global $wp_query;
            $name =get_post_type().'archive_settings';
            $option = get_option($name,true);

            if(isset($option) && $option['layout']!='default' && !empty($option['layout']) ){
                $layout = $option['layout'];
            }
        }
       return $layout;
    }

    /**
     * Add custom layout meta box for post/page
     */
    public function add_layout_box()
    {
        foreach((array) get_post_types(array('public'=>true)) as $type){
            if(post_type_supports($type,'awe-layouts')){
                add_meta_box('awe_layout_box',__('Layout Settings',self::LANG),array($this,'awe_layout_box_html'),$type,'normal','high');
                add_filter( "postbox_classes_{$type}_awe_layout_box", array($this,'add_my_meta_box_classes') );
            }

        }
    }

    function add_my_meta_box_classes( $classes=array() ) {
        /* In order to ensure we don't duplicate classes, we should
            check to make sure it's not already in the array */
        if( !in_array( 'awe-settings', $classes ) )
            $classes[] = 'awe-settings';

        return $classes;
    }

    /**
     * Generate post/page layout box
     */
    public function awe_layout_box_html()
    {
        wp_nonce_field( 'awe_layout_save', 'awe_layout_nonce' );
        $layout = ($this->get_custom_fields('singular-layout'))?$this->get_custom_fields('singular-layout'):'default'
        ?>
        <p><input type="radio" <?php checked($layout,"default");?> value="default" id="default-layout" class="default-layout">
            <label for="default-layout" class="default"><?php _e('Default Layout set in Theme Settings',self::LANG);?></label></p>
        <p>
        <div class="md-layout-choose">
            <ul class="clearfix">
                <?php foreach($this->theme_layout_options as $l):;?>
                    <li data-name="<?php echo $l;?>" <?php if($l==$layout):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/layout/<?php echo $l;?>.png" alt=""></a></li>

                <?php endforeach;?>

                <input type="hidden" value="<?php echo $layout;?>" name="awe_layout[singular-layout]" >
            </ul>
        </div>
        </p>
        <p><label for="awe_body_class"><b><?php _e('Custom Body Class',self::LANG);?></b></label></p>
        <p><input type="text" value="<?php echo $this->get_custom_fields('singular-body-class');?>" id="awe_body_class" name="awe_layout[singular-body-class]" class="large-text"></p>
        <p><label for="awe_layout_class"><b><?php _e('Custom Post Class',self::LANG);?></b></label></p>
        <p><input type="text" value="<?php echo $this->get_custom_fields('singular-post-class');?>" id="awe_layout_class" name="awe_layout[singular-post-class]" class="large-text"></p>
        <p><label for="awe_script"><b><?php _e('Custom Script/Style',self::LANG);?></b></label></p>
        <p><textarea cols="4" rows="4" id="awe_script" name="awe_seo[singular-script]" class="widefat"><?php echo $this->get_custom_fields('singular-script');?></textarea></p>
        <script>
        (function($){
                $(window).load(function(){
                    $(".md-layout-choose li").on("click",function(e){
                       // e.preventDefault();
                        $(".md-layout-choose li.chosen").removeClass('chosen');
                        $(".default-layout").removeAttr('checked');
                        $(this).addClass('chosen');

                        $(this).parent().find("input[name='awe_layout[singular-layout]']").val($(this).attr("data-name"));
                        return false;
                    });
                    $(".default-layout").on("click",function(e){
                       $(".md-layout-choose li.chosen").removeClass('chosen');
                       $("input[name='awe_layout[singular-layout]']").val("default");
                    });
                });
        })(jQuery);
        </script>
        <?php

    }


    /**
     * Save post/page layout value
     * @param $post_id
     * @param $post
     */
    public function awe_layout_save($post_id, $post)
    {
        if(!isset($_POST['awe_layout']))
            return;
        $data = wp_parse_args( $_POST['awe_layout'], array(
            'singular-layout'       => 'default',
            'singular-body-class'   => '',
            'singular-post-class'   => '',
            'singular-script'       =>  '',
        ) );
        foreach ( (array) $data as $key => $value ) {
            if ( in_array( $key, array( 'singular-body-class', 'singular-post-class') ) )
                $data[ $key ] = strip_tags( $value );
        }

        $this->save_custom_fields( $data, 'awe_layout_save', 'awe_layout_nonce', $post );
    }

    /**
     * Add custom body class to post/page
     * @param array $classes
     *
     * @return array
     */
    public function custom_singular_body_class(array $classes)
    {
        $class = is_singular()? $this->get_custom_fields('singular-body-class'):false;
        if($class)
            $classes[] = esc_attr($class);
        return $classes;

    }

    /**
     * Add custom post class to post/page
     * @param array $classes
     *
     * @return array
     */
    public function custom_singular_post_class(array $classes)
    {
        $class = is_singular()? $this->get_custom_fields('singular-post-class'):false;
        if($class)
            $classes[] = esc_attr($class);
        return $classes;

    }

    /**
     * Add custom script to header
     */
    public function custom_singular_script()
    {
        $script =  is_singular()? $this->get_custom_fields('singular-script'):false;
        if($script)
            echo $script."\n";
    }

    /**
     * Add layout options to each custom taxonomy edit screen
     */
    public function add_layout_taxonomy_options()
    {
        foreach ( get_taxonomies( array( 'show_ui' => true ) ) as $tax_name )
            add_action( $tax_name . '_edit_form', array($this,'layout_options_taxonomy_html'), 100, 2 );
    }

    /**
     * Generate layout options html to each custom taxonomy
     * @param Object $tag   term object
     * @param string $taxonomy name of taxonomy
     */
    public function layout_options_taxonomy_html($tag, $taxonomy)
    {
        $tax = get_taxonomy( $taxonomy );
        ?>
        <div id="layout_taxonomy" class="awe-settings">
        <h2><?php echo esc_html( $tax->labels->singular_name ) . ' ' . __( 'Layout Settings', self::LANG ); ?></h2>
        <table class="form-table">
            <tr class="form-field">
                <th scope="row"><?php _e('Choose Layout',self::LANG);?></th>
                <td>
                    <p>
                        <input type="radio" <?php checked($tag->meta_data['layout'],"default");?> value="default" id="awe-meta-default-layout" class="awe-meta-default-layout">
                        <label for="awe-meta-default-layout" class="default"><?php _e('Default Layout set in Theme Settings',self::LANG);?></label>
                    <p>
                    <div class="md-layout-choose">
                        <ul class="clearfix">
                            <?php foreach($this->theme_layout_options as $layout):;?>
                                <li data-name="<?php echo $layout;?>" <?php if($tag->meta_data['layout']==$layout):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/layout/<?php echo $layout;?>.png" alt=""></a></li>

                            <?php endforeach;?>

                            <input type="hidden" value="<?php echo $tag->meta_data['layout'];?>" name="awe-meta-data[layout]" >
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
        </div>
        <script>
            (function($){
                $(window).load(function(){
                    $(".md-layout-choose li").on("click",function(e){
                        // e.preventDefault();
                        $(".md-layout-choose li.chosen").removeClass('chosen');
                        $(".awe-meta-default-layout").removeAttr('checked');
                        $(this).addClass('chosen');

                        $(this).parent().find("input[name='awe-meta-data[layout]']").val($(this).attr("data-name"));
                        return false;
                    });
                    $(".awe-meta-default-layout").on("click",function(e){
                        $(".md-layout-choose li.chosen").removeClass('chosen');
                        $("input[name='awe-meta-data[layout]']").val("default");
                    });
                });
            })(jQuery);
        </script>
        <?php
    }

    /**
     * Save data meta to each taxonomy
     * @param int $term_id  term id
     * @param int $tt_id    taxonomy id
     */
    public function save_meta_data_taxonomy($term_id, $tt_id )
    {
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
            return;

        $data = (array) get_option( 'awe-meta-data' );

        $data[$term_id] = isset( $_POST['awe-meta-data'] ) ? (array) $_POST['awe-meta-data'] : array();

        if ( ! current_user_can( 'unfiltered_html' ) && isset( $data[$term_id]['archive_description'] ) )
            $data[$term_id]['archive_description'] = genesis_formatting_kses( $data[$term_id]['archive_description'] );

        update_option( 'awe-meta-data', $data );
    }


    /**
     * Delete data meta to each taxonomy when a user deletes a term
     * @param int $term_id  term id
     * @param int $tt_id    taxonomy id
     */
    public function delete_meta_data_taxonomy($term_id, $tt_id )
    {
        $data = (array) get_option( 'awe-meta-data' );

        unset( $data[$term_id] );

        update_option( 'awe-meta-data', (array) $data );
    }

    /**
     * Add meta-data to term
     * @param $term
     * @param $taxonomy
     *
     * @return mixed
     */
    public function loading_term_meta_data($term,$taxonomy)
    {

        if ( ! is_object( $term ) )
            return $term;

        $data = get_option( 'awe-meta-data' );
        $term_meta_data = isset( $data[$term->term_id] ) ? $data[$term->term_id] : array();
        $term->meta_data = wp_parse_args( $term_meta_data, apply_filters( 'awe_meta_data_defaults', array(
            'headline'            => '',
            'intro-text'          => '',
            'title'               => '',
            'description'         => '',
            'keywords'            => '',
            'noindex'             => 0,
            'nofollow'            => 0,
            'noarchive'           => 0,
            'layout'              => 'default',
        ) ) );

        foreach ( $term->meta_data as $field => $value )
            $term->meta_data[$field] = apply_filters( 'awe_term_meta_data' . $field, stripslashes( wp_kses_decode_entities( $value ) ), $term, $taxonomy );

        $term->meta_data = apply_filters( 'awe_term_meta_data', $term->meta_data, $term, $taxonomy );

        return $term;
    }

    /**
     * Add meta-data to all terms
     * @param array $terms
     * @param       $taxonomy
     *
     * @return array
     */
    public function  loading_terms_meta_data( array $terms, $taxonomy ) {

        foreach( $terms as $term )
            $term = $this->loading_term_meta_data( $term, $taxonomy );
        return $terms;

    }


    ################ FOOTER ##############

    /**
     * Enable Display Footer content
     * @param $content current status display footer content
     *
     * @return int setting display footer content
     */
    public function filter_footer_content($content)
    {
        $footer_content = $this->theme_options['footer']['content']?$this->theme_options['footer']['content']:0;
        return $footer_content;
    }

    /**
     * Return Column sidebar footer
     * @param $col
     *
     * @return int
     */

    public function filter_footer_layout($col)
    {
        $cols = $this->theme_options['footer']['layout']?$this->theme_options['footer']['layout']:1;
        return $cols;
    }


    /**
     * Register Footer sidebar
     */
    public function register_footer_sidebar()
    {

        //register footer sidebar
        $footer_content = $this->theme_options['footer']['content'];
        if($footer_content==1){
            $layout = $this->theme_options['footer']['layout'];
            if($layout==1) $cols =1;
            if(in_array($layout,array("2","321","312",'413','431'))) $cols =2;
            if(in_array($layout,array("3111","4112","4211",'4121'))) $cols=3;
            if(in_array($layout,array("41111"))) $cols=4;
            if(is_numeric($cols))
                for($i=1;$i<=$cols;$i++)
                {
                    $args = array(
                        'name'          => sprintf(__('Footer Column %d',self::LANG), $i ),
                        'id'            => 'footer-'.$i,
                        'description'   => '',
                        'before_widget' => '<div id="%1$s" class="widget %2$s ">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h4 class="widgettitle">',
                        'after_title'   => '</h4>' );
                    register_sidebar( $args );
                }
        }



    }

    /**
     * Register Footer Menu
     */
    public function register_footer_menu()
    {
        $cols = $this->theme_options['footer']['column'];
        if(is_numeric($cols))
            for($i=1;$i<=$cols;$i++)
            {
                $id = 'footer-menu-'.$i;
                $title = "Footer Menu ".$i;
                register_nav_menu($id, __($title));
            }
    }

    /**
     * Remove Wp Copyright
     * @param $translation
     * @param string $text copyright text
     * @param $domain
     *
     * @return string
     */
    public function copyright($true)
    {
        if($this->theme_options['footer']['remove']==1)
        {
            return true;
        }else
        {
            return false;
        }
    }

    /**
     * Display copyright in footer
     */
    public function awe_copyright($s)
    {
        return stripslashes($this->theme_options['footer']['copyright']);
    }

    /**
     * Show custome script in footer
     */
    public function custom_footer_script()
    {
        echo stripslashes($this->theme_options['footer']['script'])."\n";
    }

    public function filter_social_footer()
    {
        return $this->theme_options['social'];
    }

    ############ TWITTER ##############

    public function filter_twitter_feeds($tweets,$timeago=false)
    {
        if(empty($this->theme_options['twitter']['consumer_key']) || empty($this->theme_options['twitter']['consumer_secret']) || empty($this->theme_options['twitter']['access_token']) || empty($this->theme_options['twitter']['access_token_secret']) || empty($this->theme_options['twitter']['username']))
            return false;
        require_once(AWE_ROOT_DIR.'/lib/twitteroauth/twitteroauth.php');
        # Create the connection
        $twitter = new TwitterOAuth($this->theme_options['twitter']['consumer_key'], $this->theme_options['twitter']['consumer_secret'], $this->theme_options['twitter']['access_token'], $this->theme_options['twitter']['access_token_secret']);

        # Migrate over to SSL/TLS
        $twitter->ssl_verifypeer = true;

        # Load the Tweets
        $limit = ($this->theme_options['twitter']['limit'])?$this->theme_options['twitter']['consumer_key']:5;
        $tweets = $twitter->get('statuses/user_timeline', array('screen_name' => $this->theme_options['twitter']['username'], 'exclude_replies' => 'true', 'include_rts' => 'false', 'count' => $limit));
        if(is_array($tweets) && $timeago==true)
            for($i=0;$i<count($tweets);$i++)
                $tweets[$i]->created_at= $this->twitter_time($tweets[$i]->created_at);
        return $tweets;
    }

    public function twitter_time($a)
    {
        //get current timestampt
        $b = strtotime("now");
        //get timestamp when tweet created
        $c = strtotime($a);
        //get difference
        $d = $b - $c;
        //calculate different time values
        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;

        if(is_numeric($d) && $d > 0) {
            //if less then 3 seconds
            if($d < 3) return "right now";
            //if less then minute
            if($d < $minute) return floor($d) . " seconds ago";
            //if less then 2 minutes
            if($d < $minute * 2) return "about 1 minute ago";
            //if less then hour
            if($d < $hour) return floor($d / $minute) . " minutes ago";
            //if less then 2 hours
            if($d < $hour * 2) return "about 1 hour ago";
            //if less then day
            if($d < $day) return floor($d / $hour) . " hours ago";
            //if more then day, but less then 2 days
            if($d > $day && $d < $day * 2) return "yesterday";
            //if less then year
            if($d < $day * 365) return floor($d / $day) . " days ago";
            //else return more than a year
            return "over a year ago";
        }
    }

    ################ FEED ##############

    /**
     * Change Feed Url to custom feed url
     * @param string $return get link feed from get_feed_link() of WP function
     * @param string $feed  Feed type (Optional)
     *
     * @return string new feed url
     */
    public function feed_url($return,$feed)
    {
        $feed_url = $this->theme_options['feed']['feed-url'];
        $cm_feed_url = $this->theme_options['feed']['cm-feed-url'];
        if ( $feed_url && ! $this->find_contains( $return, 'comments' ) && in_array( $feed, array( '', 'rss2', 'rss', 'rdf', 'atom' ) ) ) {
            $return = esc_url( $feed_url );
        }

        if ( !empty($cm_feed_url) && $this->find_contains( $return, 'comments' ) ) {
            $return = esc_url( $cm_feed_url );
        }
        return $return;
    }

    /**
     * Redirect to custom feed URL
     */
    public function feed_redirect()
    {

        if ( ! is_feed() || preg_match( '/feedburner|feedvalidator/i', $_SERVER['HTTP_USER_AGENT'] ) )
            return;

        if ( is_archive() || is_search() || is_singular() )
            return;

        $is_feed_redirect = $this->theme_options['feed']['feed-redirect'];
        $is_cm_feed_redirect = $this->theme_options['feed']['cm-feed-redirect'];
        $feed_url = $this->theme_options['feed']['feed-url'];
        $cm_feed_url = $this->theme_options['feed']['cm-feed-url'];
        if ( $feed_url && ! is_comment_feed() && $is_feed_redirect==1 ) {
            wp_redirect( $feed_url, 302 );
            exit;
        }

        if ( $cm_feed_url && is_comment_feed() && $is_cm_feed_redirect==1 ) {
            wp_redirect( $cm_feed_url, 302 );
            exit;
        }

    }


    ################ IMAGE ##############

    /**
     * Get all image sizes
     * @return array image sizes
     */
    public function get_image_sizes() {
        global $_wp_additional_image_sizes;
        $sizes = array(
            'large'		=> array(
                'width'  => get_option( 'large_size_w' ),
                'height' => get_option( 'large_size_h' ),
            ),
            'medium'	=> array(
                'width'  => get_option( 'medium_size_w' ),
                'height' => get_option( 'medium_size_h' ),
            ),
            'thumbnail'	=> array(
                'width'  => get_option( 'thumbnail_size_w' ),
                'height' => get_option( 'thumbnail_size_h' ),
                'crop'   => get_option( 'thumbnail_crop' ),
            ),
        );

        $additional = ($_wp_additional_image_sizes)?$_wp_additional_image_sizes:array();

        return array_merge( $sizes, $additional );

    }


    ###### GENERATE CSS FOR CUSTOM TYPOGRAPHY #######
    public function generate_typography_item($name)
    {
        if($this->theme_options['typography'][$name]['enable']){
            //$return = ($this->theme_options['typography'][$name]['font']!='')?"font-family:".$this->theme_options['typography'][$name]['font'].";":"";
            if($this->theme_options['typography'][$name]['font']!='') $return ="font-family:".$this->theme_options['typography'][$name]['font'].";";
            if($this->theme_options['typography'][$name]['size']!='') $return .="font-size:".$this->theme_options['typography'][$name]['size']."px;";

            if($this->theme_options['typography'][$name]['transform']!='')$return .="text-transform:".$this->theme_options['typography'][$name]['transform'].";";
            if(isset($this->theme_options['typography'][$name]['color'])) {
                if($this->theme_options['typography'][$name]['color']!='')$return .="color:".$this->theme_options['typography'][$name]['color'].";";
            }
            if($this->theme_options['typography'][$name]['lineheight']!='')$return .="line-height:".$this->theme_options['typography'][$name]['lineheight']."px;";
            if($this->theme_options['typography'][$name]['weight']!=''){
                $return .="font-style:".$this->get_font_style($this->theme_options['typography'][$name]['weight']).";";
                $return .="font-weight:".$this->get_font_weight($this->theme_options['typography'][$name]['weight']).";";
            }
        }else $return='';
        return $return;
    }
    public function css_typography()
    {
        $style = '';
        //body
        $body = $this->generate_typography_item('body');
        if($body!='') $body = "body{".$body."}\n";
        //content
        $content = $this->generate_typography_item('content');
        if($content!='') $content = ".content{".$content."}\n";
        //Logo
        $logo = $this->generate_typography_item('logo');
        if($logo!='') $logo = ".logo{".$logo."}\n";
        //Slogan
        $slogan = $this->generate_typography_item('slogan');
        if($slogan!='') $slogan = ".slogan{".$slogan."}\n";
        //Navbar
        $navbar = $this->generate_typography_item('navbar');
        if($navbar!='') $navbar = "#main-menu li a,#menu-top li a,#nav-left ul li a{".$navbar."}\n";
        //heading
        $headlines = array("h1",'h2','h3','h4','h5','h6','p');
        $headlines_css='';
        foreach($headlines as $hl){
            $headline = $this->generate_typography_item($hl);

            if($headline!='') {
                if($hl == 'p') 
                {
                    $headlines_css .= "p{".$headline."} \n";
                }
                else
                {
                    $headlines_css .= $hl."{".$headline."} \n";
                }
            }
        }

        $sitelink = ($this->theme_options['typography']['site-link']['color']!='')? "a{color:".$this->theme_options['typography']['site-link']['color'].";}\n":"";
        $sitelink_hover = ($this->theme_options['typography']['site-link']['color-hover']!='')? "a:hover{color:".$this->theme_options['typography']['site-link']['color-hover'].";}\n":"";
        $style .=$body.$headlines_css.$slogan.$navbar.$sitelink.$sitelink_hover;
        //return $logo;
        if($style!='')
             return "<style type=\"text/css\" rel=\"typography\">".$style."</style>";
    }


    #################### FONT ####################
    /**
     * Parser Font from Google Font
     */
    public function parser_google_font()
    {
        if($this->theme_options['font']['google'] && !empty($this->theme_options['font']['google']))
        {
            if(preg_match("#\\?family=(.*)' rel#",stripslashes($this->theme_options['font']['google']),$list)){
                $list = explode("&",$list[1]);
                $list = $list[0];
                if($fonts = explode("|",$list)){
                    $return = false;
                    foreach($fonts as $f)
                    {
                        $type = explode(":",$f);
                        $return[$type[0]]=isset($type[1])?$type[1]:"400";
                    }
                    return $return;
                }
            }


        }
        return false;
    }

    public function parser_typekit()
    {

    }

    public function get_fonts()
    {
        $default = array(
            ""      => "",
            "Arial"     => "n4,n7,i4,i7",
            "Verdana"   => "n4,n7,i4,i7",
            "Trebuchet MS" => "n4,n7,i4,i7",
            "Georgia"   => "n4,n7,i4,i7",
            "Times New Roman" => "n4,n7,i4,i7",
            "Tahoma"    =>  "n4,n7,i4,i7",
            "Quando"    =>  "n4",
            "Kameron"   =>  "n4,n7",
            "Droid Sans"    =>  "n4,n7"
        );
        $google = $this->parser_google_font();
        if(is_array($google)) $default = array_merge($default,$google);
        return $default;
    }

    public function get_font_weight_name($fw)
    {
        $fontExpands = array(
            "n1" => "Thin",
            "i1" => "Thin Italic",
            "n2" => "Extra Light",
            "i2" => "Extra Light Italic",
            "n3" => "Light",
            "i3" => "Light Italic",
            "n4" => "Normal",
            "i4" => "Italic",
            "n5" => "Medium",
            "i5" => "Medium Italic",
            "n6" => "Semi Bold",
            "i6" => "Semi Bold Italic",
            "n7" => "Bold",
            "i7" => "Bold Italic",
            "n8" => "Extra Bold",
            "i8" => "Extra Bold Italic",
            "n9" => "Heavy",
            "i9" => "Heavy Italic",
            "100" => "Thin",
            "100italic" => "Thin Italic",
            "200" => "Extra Light",
            "200italic" => "Extra-Light Italic",
            "300" => "Light",
            "300italic" => "Light Italic",
            "400" => "Normal",
            "400italic" => "Italic",
            "500" => "Medium",
            "500italic" => "Medium Italic",
            "600" => "Semi Bold",
            "600italic" => "Semi-Bold Italic",
            "700" => "Bold",
            "700italic" => "Bold Italic",
            "800" => "Extra Bold",
            "800italic" => "Extra-Bold Italic",
            "900" => "Ultra Bold",
            "900italic" => "Ultra-Bold Italic",
            "" => ""
        );
        return isset($fontExpands[$fw])?$fontExpands[$fw]:"Normal";
    }

    public function get_font_style($fw){
        $fontExpands = array("i1","i2","i3","i4","i5","i6","i7","i8","i9","100italic","200italic","300italic","400italic","500italic","600italic","700italic","800italic","900italic");
        return (in_array($fw,$fontExpands))? "italic":"normal";
    }

    public function get_font_weight($fw){
        $fontExpands = array(
            "n1" => "100",
            "i1" => "100",
            "n2" => "200",
            "i2" => "200",
            "n3" => "300",
            "i3" => "300",
            "n4" => "400",
            "i4" => "400",
            "n5" => "500",
            "i5" => "500",
            "n6" => "600",
            "i6" => "600",
            "n7" => "700",
            "i7" => "700",
            "n8" => "800",
            "i8" => "800",
            "n9" => "900",
            "i9" => "900",
            "100" => "100",
            "100italic" => "100",
            "200" => "200",
            "200italic" => "200",
            "300" => "300",
            "300italic" => "300",
            "400" => "400",
            "400italic" => "400",
            "500" => "500",
            "500italic" => "500",
            "600" => "600",
            "600italic" => "600",
            "700" => "700",
            "700italic" => "700",
            "800" => "800",
            "800italic" => "800",
            "900" => "900",
            "900italic" => "900",
        );
        return ($fontExpands[$fw])?$fontExpands[$fw]:"400";
    }

    function awe_remove_unicode_from_string($string){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd'=>'đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i'=>'í|ì|ỉ|ĩ|ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D'=>'Đ',

            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '_'=>'\s+',
        );
        foreach($unicode as $nonUnicode=>$uni){
            $string = preg_replace("/($uni)/i", $nonUnicode, $string);
          }

        return $string;
    }
    /**
     * Import Data Backup
     */
    public function import_theme_settings_callback(){
        if(isset($_POST['data']))
        {
            $data  = $_POST['data'];
            $data = stripslashes($data);
            $data = unserialize($data);
            if(is_array($data))
            {
                update_option($this->theme_options_name,$data);
                echo json_encode(array("type"=>"success","msg"=>"Import Done! (^_^)"));
            }else{
                echo json_encode(array("type"=>"error","msg"=>"Something wrong please check again (@_@)"));
            }
        }else{
            echo json_encode(array("type"=>"error","msg"=>"Something wrong please check again (@_@)"));
        }
        exit();
    }
    /**
     * Export Theme Settings to file
     */
    public function export_theme_settings_callback(){
        $Option = $this->theme_options;
        $content = serialize($Option);
        header("HTTP/1.1 200 OK");
        $file_name = "theme_settings_export.txt";
        header('Content-Type: text/csv');
        $fsize = strlen($content);
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header("Content-Disposition: attachment; filename=" . $file_name);
        header("Content-Length: ".$fsize);
        header("Expires: 0");
        header("Pragma: public");
        echo $content;
    }

    /* Add new section
    ** function add new section
    */
    public function awe_add_new_section(){
        $action = $_POST['method'];
        $section_id = $_POST['section_key'];
        $option = '';
        $text_header='Create New Section';
        if($action=='edit' && $section_id != '')
        {
            $option = $this->theme_options['extra'][$section_id];
        }
        $name = '';$content='';$header='';$subtitle='';$enable_bg=1;$selected = '';
        $image = get_template_directory_uri() .'/Framework/asset/images/image-none.png';
        $color = '#fff';
        $enable_overlay = 1;
        $selected_overlay='';
        $pattern = get_template_directory_uri() .'/assets/images/bg-pattern.png';
        $overlay_color = 'rgba(0, 0, 0, 0)';
        $enable_parallax = 1;
        $header_animation = 'fadeIn';
        $header_style = 'normal';
        if($option!=''){
            $content = $option['content'];
            $name = $option['name'];
            $header = $option['header']['title'];
            $subtitle = $option['header']['subtitle']['text'];
            $enable_bg = $option['background']['enable'];
            $selected = $option['background']['type'];
            $image = $option['background']['background_image'];
            $color = $option['background']['color'];
            $enable_overlay = $option['overlay']['enable'];
            $selected_overlay = $option['overlay']['type'];
            $pattern = $option['overlay']['pattern_image'];
            $overlay_color = $option['overlay']['color'];
            $enable_parallax = $option['background']['enable_parallax'];
            $text_header = 'Edit '.$name.' Section';
            $header_animation = $option['header']['animation'];
            $header_style = $option['header']['style'];
        }
            ?>
            <div class="popup-wp-editor md-popup popup-medium">
                <div class="md-popup-inner">
                    <div class="md-popup-inner-header">
                        <h3 class="md-popup-title"><?php echo $text_header; ?></h3>
                        <a href="#close" class="md-popup-close">X</a>
                    </div>
                    <form id="popup-new-section" action="" method="POST">
                        <div class="md-popup-inner-content">
                            <?php if($action=='add_new') : ?>
                            <div class="md-row-item">
                                <div class="form-group">
                                    <label>Section Name</label>
                                    <input type="text" name="new_section_name" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($action=='edit') : ?>
                                <input type="hidden" name="new_section_name" value="<?php echo $name; ?>">
                            <?php endif; ?>
                            <div class="md-row-item">
                                <div class="form-group">
                                    <label>Section Title</label>
                                    <input type="text" name="new_section_header" value="<?php echo $header; ?>">
                                </div>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <label>Title style</label>
                                        <div class="md-selection medium">
                                            <select name="header_style" class="select">
                                                <option value="normal" <?php selected($header_style,'normal',true) ?>>style 1</option>
                                                <option value="line-bottom" <?php selected($header_style,'line-bottom',true) ?>>style 2</option>
                                                <option value="line-top" <?php selected($header_style,'line-top',true) ?>>style 3</option>
                                                <option value="border-title" <?php selected($header_style,'border-title',true) ?>>style 4</option>
                                                <option value="line-through" <?php selected($header_style,'line-through',true) ?>>style 5</option>
                                                <option value="title-big" <?php selected($header_style,'title-big',true) ?>>style 6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $this->generate_select(array("class"=>"md-selection medium","select_class"=>"section-header-animation","id"=>"header-animation","name"=>"header_animation","value"=>$header_animation,"options"=>$this->animation_options,'label'=>__('Animation',self::LANG),'label_position'=>'before',"is_group"=>false)); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="md-row-item">
                                <div class="form-group">
                                    <label>Section Subtitle</label>
                                    <input type="text" name="new_subtitle" value="<?php echo $subtitle; ?>">
                                </div>
                            </div>
                            <div class="md-row-item">
                                <div class="form-group">
                                    <label>Section Content </label>
                                    <?php wp_editor( $content, 'add_new_textarea', $settings=array('textarea_name'=>'new_section_content','wpautop'=>false,'textarea_rows'=>35)); 
                                        wp_enqueue_script('jquery-ui-tabs');
                                        wp_enqueue_script('jquery-ui-accordion');
                                        wp_enqueue_script('jquery-ui-dialog');
                                        wp_enqueue_style('wp-color-picker');
                                        wp_enqueue_script('wp-color-picker');
                                        wp_enqueue_script('awe-theme-spectrum', AWE_JS_URL. 'spectrum.min.js', array("jquery"), null, true);
                                        _WP_Editors::enqueue_scripts();
                                        print_footer_scripts();
                                        _WP_Editors::editor_js();
                                        
                                    ?> </div>
                            </div>
                            <div class="md-row-item">
                                <div class="form-group">
                                    <div class="checkbox-input">
                                        <input id="background-enable" type="checkbox" name="background_enable" class="background_enable input-checkbox" <?php checked($enable_bg,1,true); ?>>
                                        <label class="label-checkbox" for="background-enable">Enable Background</label>
                                        <select name="background_type" class="new-section-background-select" style="margin-top: -10px;">
                                            <option value="parallax" <?php selected($selected,'parallax',true); ?>>Image</option>
                                            <option value="color" <?php selected($selected,'color',true); ?>>Color</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="enable-background-parallax" <?php if($enable_bg==0) echo 'style="display:none;"'; ?>>
                                    <div class="select-parallax" style="<?php if($selected!='' && $selected != 'parallax') echo "display:none"; ?>">
                                        <div class="checkbox-input">
                                            <input type="checkbox" id="enable-parallax" name="enable_parallax" class="input-checkbox" <?php checked($enable_parallax,1,true); ?> >
                                            <label class="label-checkbox" for="enable-parallax">Enable Parallax </label>
                                        </div>
                                        <?php
                                        
                                        echo $this->generate_upload_image(array(
                                            "id"=>"new-section-overlay",
                                            "class"=>"big",
                                            "name"=>"background_image",
                                            "value"=> $image,
                                            // "label"=>__("Change Your Background Image",self::LANG),
                                            "label_position"=>"before","is_group"=>true,
                                        ));
                                        ?>
                                        
                                    </div>
                                    <div class="select-color" style="<?php if($selected!='color' || $selected=='') echo "display:none"; ?>">
                                        <?php 
                                        echo $color = $this->generate_input(array(
                                            "class"=>"medium style-color-custom-picker",
                                            "id"=>"custom-new-section-background-color",
                                            "name"=>"background_color",
                                            "value"=>$color,
                                            "is_group"=>true
                                        ));
                                        ?>
                                    </div>
                                </div><!--End Setting background Parallax -->
                                
                                <div class="form-group">
                                    <div class="checkbox-input">
                                        <input id="overlay-enable" type="checkbox" name="overlay_enable" class="overlay_enable input-checkbox" <?php checked($enable_overlay,1,true); ?>>
                                        <label class="label-checkbox" for="overlay-enable">Enable Section Overlay:</label>
                                        <select name="overlay_type" class="new-section-overlay-select" style="margin-top: -10px;">
                                            <option value="pattern" <?php selected($selected_overlay,'pattern',true); ?>>Pattern</option>
                                            <option value="color" <?php selected($selected_overlay,'color',true); ?>>Color</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="enable-section-overlay" <?php if($enable_overlay==0) echo 'style="display:none"'; ?>>
                                    
                                    <div class="select-overlay-pattern" style="<?php if($selected_overlay!='' && $selected_overlay != 'pattern') echo "display:none"; ?>">
                                        <?php
                                        echo $this->generate_upload_image(array(
                                            "id"=>"new-section-overlay-upload",
                                            "class"=>"big",
                                            "name"=>"overlay_pattern",
                                            "value"=> $pattern,
                                            // "label"=>__("Change Your Overlay Pattern",self::LANG),
                                            "label_position"=>"before","is_group"=>true,
                                        ));
                                        ?>
                                    </div>
                                    <div class="select-overlay-color" style="<?php if($selected_overlay!='color' || $selected_overlay=='') echo "display:none"; ?>">
                                        <?php 
                                        
                                        echo $color = $this->generate_input(array(
                                            "class"=>"medium style-color-custom-picker",
                                            "id"=>"custom-new-section-overlay-color",
                                            "name"=>"overlay_color",
                                            "value"=>$overlay_color,
                                            "is_group"=>true
                                        ));
                                        ?>
                                    </div>
                                </div><!-- End Setting Overlay -->
                            </div>
                        </div>  
                        <div class="md-popup-inner-footer">
                            <span class="message-error"></span>
                            <button type="submit" class="md-popup-save button button-primary button-large new-section-save" data-method="<?php if($option!='') echo 'edit';else echo 'add'; ?>">Save</button>
                        </div>
                    </form> 
                </div>
            </div>
            <div class="md-popup-backdrop"></div>
            <?php
        die();
    }

    public function awe_new_section_content(){
        $data = $_POST['data_send'];
        $action = $_POST['method'];
        $error = '';
        $sort_section = $this->theme_options['extra']['sort_section'];
        if($action=='add'|| $action == 'edit'){
            $data = parse_str($data,$data_array);
            if( isset($data_array['new_section_name']) && !empty($data_array['new_section_name']) )
            {
                $name_section = $this->awe_remove_unicode_from_string($data_array['new_section_name']);

                if(isset($this->theme_options['extra'][$name_section]) && $action=='add'){
                    echo 'Your name section is already exisits';
                    die();
                }else{

                    $array = array(
                        'name' => $data_array['new_section_name'],
                        'header' => array(
                            'enable' => (isset($data_array['new_section_header']) && !empty($data_array['new_section_header'])) ? 1:0,
                            'title'=>sanitize_text_field( $data_array['new_section_header'] ),
                            'subtitle' => array(
                                'enable' => (isset($data_array['new_subtitle']) && !empty($data_array['new_subtitle'])) ? 1 : 0,
                                'text'=>sanitize_text_field($data_array['new_subtitle'])
                            ),
                            'style' => $data_array['header_style'],
                            'animation' => $data_array['header_animation'],
                        ),
                        'content'  => apply_filters('content_save_pre', $data_array['new_section_content']),
                        'background' => array(
                            'enable' => (isset($data_array['background_enable'])) ? 1: 0,
                            'type'=>$data_array['background_type'],
                            'background_image'=> $data_array['background_image'],
                            'color' => $data_array['background_color'],
                            'enable_parallax' => (isset($data_array['enable_parallax'])) ? 1: 0,
                        ),
                        'overlay' => array(
                            'enable' => (isset($data_array['overlay_enable'])) ? 1: 0,
                            'type' => $data_array['overlay_type'],
                            'pattern_image' => $data_array['overlay_pattern'],
                            'color' => $data_array['overlay_color'],
                        ),
                        'show' => 1,
                    );
                    $this->theme_options['extra'][$name_section] = $array;
                    if($action=='add')
                    {
                        $this->theme_options['extra']['sort_section'] = $sort_section.','.$name_section;
                    }
                    
                    // var_dump($this->theme_options);
                    update_option($this->theme_options_name,$this->theme_options);
                    die();
                }
            }else{
                echo "Section Name can not be empty";
                die();
            }
        }else{
            echo "Can not Save!Please try agian";
            die();
        }
        
    }

    public function awe_delete_section(){
        $section_key = $_POST['section_key'];
        
        $error = '';
        if(isset($section_key) && !empty($section_key)){

            if(array_key_exists($section_key,$this->theme_options['extra']) ){
                unset($this->theme_options['extra'][$section_key]);
                $sort_section = explode(',', $this->theme_options['extra']['sort_section']);
                $delete_sort_section = '';
                $i=1;
                foreach ($sort_section as $value) {
                    if($value!=$section_key){
                        if($i==1)
                        {
                            $delete_sort_section .= $value;
                        }else{
                            $delete_sort_section .= ','.$value;    
                        }
                        $i++;
                    }
                }
                $this->theme_options['extra']['sort_section'] = $delete_sort_section;
                update_option($this->theme_options_name,$this->theme_options);
            }
            else
            {
                $error = "This section is not exisits";
            }

        }else{
            $error = "Can not delete this section!";
        }
        echo $error;
        die();
    }
    public function awe_render_section($section){
        if(isset($this->theme_options['extra'][$section]) && !empty($this->theme_options['extra'][$section]))
        {
            $section_data = $this->theme_options['extra'][$section];
            $style = '';

            if(isset($section_data['background']['enable']) && $section_data['background']['enable'] === 1) 
            {
                if($section_data['background']['type'] == 'parallax' && $section_data['background']['background_image']!='')
                {
                    $style = 'style="background-image: url('.$section_data['background']['background_image'].')"';
                }
                if($section_data['background']['type'] == 'color')
                {
                    $style = 'style="background-color: '.$section_data['background']['color'].'"';
                }
            }
            
            $style_overlay = '';
            // var_dump($section_data['overlay']);
            if(isset($section_data['overlay']['type']) && $section_data['overlay']['type'] == 'pattern')
            {
                $style_overlay = 'style="background-image:url('.$section_data['overlay']['pattern_image'].')"';
            }
            if(isset($section_data['overlay']['type']) && $section_data['overlay']['type'] == 'color')
            {
                $style_overlay = 'style="background-color: '.$section_data['overlay']['color'].'"';
            }
            $enable_parallax = '';
            if($section_data['background']['enable_parallax']==1 && $section_data['background']['type'] == 'parallax'){
                $enable_parallax = 'awe-parallax';
            }
            ?>
            <section id="<?php echo $section; ?>" class="awe-section <?php echo $enable_parallax; ?>" <?php echo $style; ?>>
                <div class="container">
                    <div class="row">
                    <?php if($section_data['header']['enable']) : ?>
                        <div class="col-xs-12">
                            <div class="awe-header wow <?php echo $section_data['header']['animation']; ?> js-header" data-wow-duration="0.6s" data-wow-delay="0.6s" data-animate="<?php echo $section_data['header']['animation']; ?>">
                                <h2 class="js-title <?php echo $section_data['header']['style']; ?>"><?php echo $section_data['header']['title']; ?></h2>
                                <?php if($section_data['header']['subtitle']['enable']) : ?>
                                    <p class="js-desc" ><?php echo $section_data['header']['subtitle']['text'] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                        <div class="awe-content">
                            <?php echo apply_filters('the_content',$section_data['content']); ?>
                        </div>
                    </div>
                </div>
                <?php if(isset($section_data['overlay']['enable'])) : ?>
                <div class="awe-overlay-bg" <?php echo $style_overlay; ?>></div>
                <?php endif; ?>
            </section>
            <?php
        }
    }
}