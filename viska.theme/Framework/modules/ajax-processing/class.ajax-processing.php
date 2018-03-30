<?php

/*
 * author: wiloke
 * author uri: wiloke.com
 * date: 04/27/14
 * time: 10:00 AM
 */

class aweAjaxProcessing extends AweFramework
{
    public function __construct()
    {
        add_action('wp_ajax_awe-load-shortcode', array($this, 'awe_shortcode_table_building'));

        add_action('wp_ajax_include-file', array($this, 'awe_include_filename'));
    }

    # Shortcodes Table Building
    public function awe_shortcode_table_building()
    {
        $file = get_template_directory() . '/Framework/modules/pop-up/shortcodes-popup.php';
        if ( !file_exists($file) )
        {
           echo 'File does not exist';
        }else{
            include($file);
        }

        die();
    }


    # include file name
    public function awe_include_filename()
    {
        if (!isset($_POST) || !isset($_POST['fileName']) || empty($_POST['fileName']) ) die('File does not exist!');

        $fileName = ltrim($_POST['fileName']);

        include ( get_template_directory() .
'/Framework/modules/shortcodes/list-shortcodes/' . $fileName  );

        die();
    }
}