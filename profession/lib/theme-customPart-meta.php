<?php

include_once('post-meta.php');

class CustomPartPostMeta extends PostMeta
{
    public function __construct()
    {
        parent::__construct('custom-part');
    }

    function GetMetaKeys()
    {
        return array('custom_part_paddig','custom_part_color','custom_part_title_show');
    }

    function px_register_scripts()
    {
        wp_enqueue_script('metabox', THEME_ADMIN_URI  .'/scripts/metabox.js', array('jquery'), '1');

        wp_enqueue_script('jquery-easing', THEME_JS_URI  .'/jquery.easing.1.3.js', array('jquery'), '1.3.0');

        wp_enqueue_style( 'nouislider', THEME_ADMIN_URI . '/css/nouislider.css', false, '2.1.4', 'screen' );
        wp_enqueue_script('nouislider', THEME_ADMIN_URI  .'/scripts/jquery.nouislider.min.js', array('jquery'), '2.1.4');

        wp_enqueue_style( 'colorpicker0', THEME_ADMIN_URI . '/css/colorpicker.css', false, '1.0.0', 'screen' );
        wp_enqueue_script('colorpicker0', THEME_ADMIN_URI  .'/scripts/colorpicker.js', array('jquery'), '1.0.0');

        wp_enqueue_style( 'chosen', THEME_ADMIN_URI . '/css/chosen.css', false, '1.0.0', 'screen' );
        wp_enqueue_script('chosen', THEME_ADMIN_URI  .'/scripts/chosen.jquery.min.js', array('jquery'), '1.0.0');

        wp_enqueue_style( 'theme-admin', THEME_ADMIN_URI . '/css/style.css', false, '1.0.0', 'screen' );
        wp_enqueue_script('theme-admin', THEME_ADMIN_URI  .'/scripts/admin.js', array('jquery'), '1.0.0');
    }


    // Add the Meta Box
    function AddMetabox() {
        add_meta_box(
            'custom-part_meta_box', // $id
            __('CustomPart Options', TEXTDOMAIN), // $title
            array(&$this, 'ShowMetabox'), // $callback
            'custom-part', // $page
            'normal', // $context
            'high'); // $priority
    }
}

new CustomPartPostMeta();