<?php
/**
 * Created by JetBrains PhpStorm.
 * User: duongle
 * Date: 2/7/14
 * Time: 3:41 PM
 * To change this template use File | Settings | File Templates.
 */


Class AWEShortcodes extends AweFramework
{

    public $shortcodes_options = array();

    public function __construct()
    {

        add_action('admin_menu', array($this,'register_shortcodes_menu' ));


        add_action('admin_notices',array(&$this,'display_global_messages'),9999);

        add_filter('mce_external_plugins', array($this, 'wo_add_jquery'));
        add_filter('mce_buttons', array($this, 'wo_add_buttons'));

        add_action('admin_enqueue_scripts', array($this, 'wo_enqueue_scripts'));
        add_action('wp_ajax_awe-load-shortcode', array($this, 'wo_table_shortcodes'));
        add_action('wp_ajax_include-file', array($this, 'wo_shortcode_detail'));
    }

    public function wo_enqueue_scripts()
    {
//        /*
//         * check the scripts is exist
//         */
//        if ( !wp_script_is('jquery.blank.js', 'enqueued') )
//        {
//            wp_register_script('awe-blank-js', AWE_JS_URL . 'jquery.blank.js');
//            wp_enqueue_script('awe-blank-js');
//        }
//
//        $file = get_template_directory() . '/Framework/modules/shortcodes/list-shortcodes.php';
//
//        if ( !file_exists($file) )
//        {
//            var_dump('This file does not exists!' . __FILE__ . __LINE__);
//        }else{
//            include ($file);
//
//            wp_localize_script('awe-blank-js', 'AWE_SC_DETAILS', $aShortcodesDetails);
//        }
    }


    public function register_shortcodes_menu(){
        add_submenu_page( 'AWE-Framework', 'Security Settings', 'ShortCodes', 'manage_options', 'AWE-Shortcodes', array($this,'shortcodes_settings') );

    }


    public function wo_shortcode_detail()
    {
        if (!isset($_POST['fileName']))
        {
            echo 'Not File';
            die();
        }

        $file = ltrim($_POST['fileName']);

        $dirFile = get_template_directory() . '/Framework/modules/shortcodes/list-shortcodes/' . $file;

        if (!file_exists($dirFile))
        {
            die('File does not exist');
        }

        include ($dirFile);

        die();
    }

    public function wo_table_shortcodes()
    {
        $file = get_template_directory() . '/Framework/modules/shortcodes/shortcodes-popup.php';

        if (!file_exists($file))
        {
            var_dump('File Does not exist' . __FILE__ . __LINE__);
        }else{
            include($file);
        }

        die();
    }


    public function shortcodes_settings()
    {

    }


    /*
     * Shortcodes building
     * wiloke
     */
    public function  wo_add_jquery($plugins_array)
    {
        $plugins_array['woShortcodesBuilding'] = get_template_directory_uri() . '/Framework/asset/js/jquery.tinymce.js';

        return $plugins_array;
    }

    public function wo_add_buttons($buttons)
    {
        $buttons[] = 'wo_shortcodes';
        return $buttons;
    }

}