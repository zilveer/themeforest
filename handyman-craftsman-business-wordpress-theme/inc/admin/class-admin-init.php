<?php
namespace Handyman\Admin;

use Handyman\Admin\Metabox;
use Handyman\Extras as E;
use Handyman\Core\Assets;
use Handyman;

/**
 * Class Admin_Init
 * @package Handyman
 */
class Admin_Init
{

    /**
     * [$_instance description]
     * @var [type]
     */
    static public $_instance;


    /**
     * @var
     */
    protected static $_color_shemes;


    public function __construct()
    {
        self::$_instance =& $this;

        // Hook required actions & filters

        // Add customizer to the admin panel (lvl. 1)
        add_action('admin_menu'         , array($this, 'addCustomizerMenu'));

        // Enqueue all scripts required by administration panel
        add_action('admin_init'         , array($this, 'enqueueAdminScripts'));

        add_action( 'after_switch_theme', array($this,'flushRewriteRules'));

        add_filter('admin_footer_text'  , array($this, 'removeDashboardFooter'));

        if(\Handyman\Init::isCustomizing())
        {
            $this->_setupColorSchemes();
        }

        // Load metaboxes for pages
        $this->_initMetaboxes();
    }


    public function flushRewriteRules()
    {
        flush_rewrite_rules();
    }


    /**
     * @todo finish it! :D
     *
     * @param $post_id
     */
    public function cleanInactiveLayersWidgets($post_id)
    {
        global $wp_registered_sidebars, $sidebars_widgets, $wp_registered_widgets;

        if(get_post_type($post_id) != 'page' || !E\is_layers_builder_template($post_id) )
            return;
    }


    /**
     *
     */
    protected function _setupColorSchemes()
    {
        self::$_color_shemes = \Handyman\Core\Colors::$_color_shemes;
    }


    /**
     * @return mixed
     */
    public static function getColorSchemes()
    {
        return self::$_color_shemes;
    }

    public function removeDashboardFooter($s){
        return '';
    }

    /**
     * Add customizer link into the admin menu
     */
    public function addCustomizerMenu()
    {
        add_menu_page('Customizer', 'Customize', 'edit_theme_options', 'customize.php', null, null, 59.37);
    }


    /**
     *
     */
    public function enqueueAdminScripts()
    {
        global $wp_customize;
        if($wp_customize){
            wp_dequeue_script(LAYERS_THEME_SLUG . "-map-trigger");
        }

        wp_enqueue_style('theme-flaticons', Assets::assetPath('css/themify-icons.css'), array(), TL_THEME_VER);
        wp_enqueue_style(TL_THEME_SLUG . '-admincss', Assets::assetPath('css/admin-main.css'), array(), TL_THEME_VER);
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script(TL_THEME_SLUG . '-admin', Assets::assetPath('js/admin-main.js'), array('wp-color-picker', TL_THEME_SLUG . '-admin-ajax'), TL_THEME_VER, true);
    }




    /**
     * Loads metaboxes for posts, pages
     */
    protected function _initMetaboxes()
    {
        // Regular page Metabox
        $page_options_metabox = Metabox\Page_Options_Metabox::single('page_options', array(
            'title' => 'Page Options',
            'description' => 'Advanced page options. Sidebars & header image',
            'priority' => 'core',
            'screens' => array('page'),
            'context' => 'advanced',
            'map' => array(
                array(
                    'label' => 'HEADER TITLE',
                    'name' => '_tl_item_title',
                    'type' => 'text',
                    'desc' => 'Page/Post header title',
                    'default' => '',
                    'attrs' => array('class'=>'layers-text')
                ),
                array(
                    'label' => 'HEADER SUBTITLE',
                    'name' => '_tl_item_subtitle',
                    'type' => 'text',
                    'desc' => 'Page/Post header subtitle',
                    'default' => '',
                    'attrs' => array('class'=>'layers-text')
                ),
                array(
                    'label' => 'HEADER BACKGROUND COLOR',
                    'name' => '_tl_item_header_color',
                    'type' => 'colorpicker',
                    'desc' => 'Set header\'s background color.',
                    'default' => '#191e23',
                    'attrs' => array('class' => ''),
                ),
                array(
                    'label' => 'TEASER TEXT SIZE',
                    'name' => '_tl_teaser_size',
                    'id' => '_tl_teaser_size_id',
                    'type' => 'select',
                    'choices' => array(
                        'small'  => 'Small',
                        'medium' => 'Medium',
                        'large'  => 'Large',
                    ),
                    'default' => 'medium',
                    'attrs' => array('class' => 'layers-text large'),
                ),
                array(
                    'label' => 'HEADER IMAGE',
                    'name' => '_tl_item_header_image',
                    'id' => 'tl_item_header_image_id',
                    'type' => 'image',
                    'desc' => 'Header section background image',
                    'attrs' => array('class'=>'large')
                ),
                array(
                    'label' => 'DARKEN BACKGROUND IMAGE',
                    'name' => '_tl_darken_cb',
                    'id' => 'tl_darken_cb_id',
                    'type' => 'checkbox',
                    'desc' => 'Make background image darker.',
                    'default' => 1,
                    'attrs' => array('class' => 'large'),
                ),
                array(
                    'label'   => 'HEADER HEIGHT',
                    'name'    => '_tl_header_height',
                    'type'    => 'text',
                    'desc'    => 'Leave field empty to Auto Height',
                    'default' => '400',
                    'attrs'   => array('class' => 'large')
                ),
            ),
        ));
        $page_options_metabox->addClass('tl-page-option-metabox');

        // Team Metabox
        $team_options_metabox = Metabox\Page_Options_Metabox::single('team_options', array(
            'title' => 'Additional info about Team Member',
            'description' => 'Additional team member options.',
            'priority' => 'core',
            'screens' => array('tl_team'),
            'context' => 'advanced',
            'map' => array(
                array(
                    'label' => 'Position in the team',
                    'name' => '_tl_member_position',
                    'type' => 'text',
                    'desc' => 'Member\'s position',
                    'default' => '',
                    'attrs' => array('class'=>'layers-text')
                ),
                array(
                    'label' => 'Social Links',
                    'type' => 'heading',
                    'name' => 'soc_title',
                    'desc' => 'Maximum 4 links will be used in Layers Widget'
                ),
                array(
                    'label' => 'Facebook profile',
                    'name' => '_tl_member_fb',
                    'type' => 'text',
                    'desc' => 'Full Link to the member\'s Facebook profile',
                    'default' => '',
                    'placeholder' => 'http://',
                    'attrs' => array('class'=>'layers-text')
                ),
                array(
                    'label' => 'Google+ profile',
                    'name' => '_tl_member_gp',
                    'type' => 'text',
                    'desc' => 'Full Link to the member\'s Google Plus profile',
                    'default' => '',
                    'placeholder' => 'http://',
                    'attrs' => array('class'=>'layers-text')
                ),
                array(
                    'label' => 'LinkedIn profile',
                    'name' => '_tl_member_ld',
                    'type' => 'text',
                    'desc' => 'Full Link to the member\'s LinkedIn profile',
                    'default' => '',
                    'placeholder' => 'http://',
                    'attrs' => array('class'=>'layers-text')
                ),
                array(
                    'label' => 'Youtube Channel',
                    'name' => '_tl_member_yt',
                    'type' => 'text',
                    'desc' => 'Full Link to the member\'s Youtube Channel',
                    'default' => '',
                    'placeholder' => 'http://',
                    'attrs' => array('class'=>'layers-text')
                ),
                array(
                    'label' => 'Twitter profile',
                    'name' => '_tl_member_tw',
                    'type' => 'text',
                    'desc' => 'Full Link to the member\'s Twitter profile',
                    'default' => '',
                    'placeholder' => 'http://',
                    'attrs' => array('class'=>'layers-text')
                ),
                array(
                    'label' => 'Pinterest profile',
                    'name' => '_tl_member_pin',
                    'type' => 'text',
                    'desc' => 'Full Link to the member\'s Pinterest profile',
                    'default' => '',
                    'placeholder' => 'http://',
                    'attrs' => array('class'=>'layers-text')
                ),
                array(
                    'label' => 'Custom link',
                    'name' => '_tl_member_cl',
                    'type' => 'text',
                    'desc' => 'Custom link',
                    'default' => '',
                    'placeholder' => 'http://',
                    'attrs' => array('class'=>'layers-text')
                ),
            ),
        ));
        $team_options_metabox->addClass('tl-page-option-metabox');
    }


    /**
     * Singleton
     *
     * @return Object
     */
    public static function single()
    {
        return self::$_instance;
    }
}