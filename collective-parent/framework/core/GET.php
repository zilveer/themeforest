<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

class TF_GET extends TF_TFUSE {

    public $_the_class_name = 'GET';
    public $options_cache = array();
    public $ext_options_cache = array();
    public $db_options_cache = array();

    public function __construct() {
        parent::__construct();
    }

    function options($type) {
        global $tfuse_options, $TFUSE;

        // admin options se acceseaza mai devreme (nu tin minte unde, mi se pare ca undeva tare devreme inainte de init action)
        // // inainte ca sa fie incarcat si este nevoie si a doua oara sa treaca prin filtru
        static $admin_options_filtered = false;

        #required in options file
        $url = TFUSE_ADMIN_IMAGES . '/';
        $url = apply_filters('tfuse_theme_image_options_url', $url, $type);
        #end required

        if (isset($this->options_cache[$type])) {
            if ($type == 'admin' && !$admin_options_filtered) {
                $admin_options_filtered = true;

                return apply_filters('tfuse_options_filter', $this->options_cache[$type], $type);
            } else {
                return $this->options_cache[$type];
            }
        }

        $options = array();

        $path_main = TFUSE_CONFIG . '/options/' . $type . '_options.php';
        $path_child = TFUSE_CHILD_CONFIG . '/options/' . $type . '_options.php';
        if (file_exists($path_child)){
            // include option file
            require($path_child);
        } elseif (file_exists($path_main)) {
            require($path_main);
        }

        $options = apply_filters('tfuse_options_filter', $options, $type);

        if(sizeof($options)){
            $this->options_cache[$type] = $options;
        }
        return $options;
    }

    function option($type, $option) {
        $options = $this->options($type);
        if (isset($options[$type]['tabs'])) {
            $tmp = tf_only_options($options[$type]);
        }
        $db_options = get_option(TF_THEME_PREFIX . '_tfuse_framework_options');
        if (isset($db_options[$option]))
            return $db_options[$option];
        else if (isset($options[$type][$option]) || isset($tmp[$option])) {
            if (!isset($tmp))
                return $options[$type][$option];
            else
                return $tmp[$option];
        }
        else
            return NULL;
    }

    function ext_option($ext_name, $type, $option, $directory = '') {
        if (!isset($this->ext_options_cache[$ext_name]) && !isset($this->ext_options_cache[$ext_name][$type])) {
            $this->ext_options_cache[$ext_name][$type] = $this->ext_options($ext_name, $type, $directory);
            if (isset($this->ext_options_cache[$ext_name][$type]['tabs'])) {
                $tmp = tf_only_options($this->ext_options_cache[$ext_name][$type]);
            }
        }
        $db_options = get_option(TF_THEME_PREFIX . '_tfuse_' . $type . '_options');
        if (isset($db_options[$option]))
            return $db_options[$option];
        else if (isset($this->options_cache[$ext_name][$type][$option]) || isset($tmp[$option])) {
            if (!isset($tmp))
                return $this->options_cache[$ext_name][$type][$option];
            else
                return $tmp[$option];
        }
        else
            return NULL;
    }

    function ext_options($ext_name, $type, $directory = '',$suffix=false) {
        global $tfuse_options, $TFUSE;
        $ext_name = strtolower($ext_name);
        #required in options file
        $url = TFUSE_ADMIN_IMAGES . '/';
        #end required
        $appendix= !$suffix ?  trim($directory, "/\\") . ($directory != '' ? '/' : '') . 'options/' : 'options/'.trim($directory, "/\\") . ($directory != '' ? '/' : '');
        // $path_main = TFUSE_CONFIG . '/extensions/' . strtolower($ext_name) . '/' . trim($directory, "/\\") . ($directory != '' ? '/' : '') . 'options/' . $type . '_options.php';
        // $path_child = TFUSE_CHILD_CONFIG . '/extensions/' . strtolower($ext_name) . '/' . trim($directory, "/\\") . ($directory != '' ? '/' : '') . 'options/' . $type . '_options.php';

        $path_main = TFUSE_CONFIG . '/extensions/' . strtolower($ext_name) . '/' . $appendix . $type . '_options.php';
        $path_child = TFUSE_CHILD_CONFIG . '/extensions/' . strtolower($ext_name) . '/' . $appendix . $type . '_options.php';
        if (file_exists($path_child))
            $path = $path_child;
        elseif (file_exists($path_main))
            $path = $path_main;
        else
            exit('Extension options not found: ' . $type . '_options.php (' . $path_main . ')');
        #If all good, include option file and return options
        require($path);
        return $options;
    }

    function ext_config($ext_name, $file_name, $directory = '') {
        $ext_name = strtolower($ext_name);
        $path_main = TFUSE_CONFIG . '/extensions/' . strtolower($ext_name) . '/' . trim($directory, "/\\") . ($directory != '' ? '/' : '') . 'configurations/' . $file_name . '_cfg.php';
        $path_child = TFUSE_CHILD_CONFIG . '/extensions/' . strtolower($ext_name) . '/' . trim($directory, "/\\") . ($directory != '' ? '/' : '') . 'configurations/' . $file_name . '_cfg.php';
        if (file_exists($path_child))
            $path = $path_child;
        elseif (file_exists($path_main))
            $path = $path_main;
        else
            exit('Configuration file not found: ' . $file_name . '_cfg.php (' . $ext_name . ')');
        #If all good, include option file and return options
        require($path);
        if (!isset($cfg))
            return array();
        return $cfg;
    }

    function ext_include($ext_name, $file_name, $directory = '') {
        $ext_name = strtolower($ext_name);
        $path_main = TFUSE . '/extensions/' . strtolower($ext_name) . '/' . ($directory == '' ? 'includes' : $directory) . '/' . $file_name . '.php';
        if (file_exists($path_main))
            $path = $path_main;
        else
            exit('Include file not found: ' . $file_name . '.php (' . $ext_name . ')');
        #If all good, include option file and return options
        require($path);
        if (!isset($_inc_))
            return array();
        return $_inc_;
    }

    public function massive() {
        $options = array();
        $options['framework'] = get_option(TF_THEME_PREFIX . '_tfuse_framework_options');
        $options['taxonomy'] = get_option(TF_THEME_PREFIX . '_tfuse_taxonomy_options');
        $options = decode_tfuse_options($options);
        return $options;
    }

}
