<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_SEEK_MODEL extends TF_TFUSE {

    public $_the_class_name = 'SEEK_MODEL';
    public $_ext_name       = 'SEEK';
    public $_standalone     = TRUE;
    public $wp_option;

    function __construct() {
        parent::__construct();
        $this->wp_option = TF_THEME_PREFIX . '_tfuse_framework_options';
    }

    function get_options() {
        $db = get_option($this->wp_option);
        if($db){
            return (array)$db;
        }
        return array();
    }

    function get_option($option_id, $default = NULL) {
        static $cache = NULL;

        if($cache === NULL){
            $db = $cache = (array) get_option($this->wp_option);
        } else {
            $db = $cache;
        }

        if (isset($db[$option_id]))
            return $db[$option_id];

        return $default;
    }

    function get_post_option($option_name, $default = NULL, $post_id = NULL) {
        global $post, $tfuse_options;

        if (!isset($post_id) && isset($post))
            $post_id = $post->ID;
        if (!isset($post_id))
            return;

        $option_name = strtolower($this->_ext_name) . '_' . $option_name;

        if (isset($tfuse_options['post'][$post_id][$option_name]))
            $value = $tfuse_options['post'][$post_id][$option_name];
        else {
            $_options = get_post_meta($post_id, TF_THEME_PREFIX . '_tfuse_post_options', true);
            $tfuse_options['post'][$post_id] = decode_tfuse_options($_options);
            if (isset($tfuse_options['post'][$post_id][$option_name]))
                $value = $tfuse_options['post'][$post_id][$option_name];
        }

        if (isset($value) && $value !== '')
            return $value;
        else
            return $default;
    }
}
