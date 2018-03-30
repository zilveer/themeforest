<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

/**
 * Description of TF_SLIDER_MODEL
 *
 */
class TF_SIDEBARS_MODEL extends TF_TFUSE {

    public $_the_class_name = 'SIDEBARS_MODEL';
    public $_ext_name = 'SIDEBARS';
    public $_standalone = TRUE;
    public $sidebars = NULL;
    public $settings = NULL;
    public $wp_option;
    private $db;

    function __construct() {
        parent::__construct();
        $this->wp_option = TF_THEME_PREFIX . '_tfuse_sidebars';
    }

    public function save_new_sidebar($name) {
        $db = $this->get_db();
        $db['sidebars'][$this->generate_id($name)] = array('name' => $name);
        update_option($this->wp_option, array_filter($db));
        $this->cache_reset();
    }

    public function save_sidebar_settings($data, $type) {
        $db = $this->get_db();
        $value = array('position' => $data['position'], 'sidebars' => $data['sidebars']);
        if ($type == 'default_post' || $type == 'default_page' || $type == 'default_category' || strpos($type, 'default_') !== FALSE) {
            $db['settings'][$type] = $value;
        } else if ($type == 'by_id_post') {
            $ids = sort_sdb(explode(',', $data['opt_val']));
            $key = implode(',', $ids);
            $db['settings']['by_id_post'][$key] = $value;
        } else if ($type == 'by_category_post') {
            $ids = sort_sdb(explode(',', $data['opt_val']));
            $key = implode(',', $ids);
            $db['settings']['by_category_post'][$key] = $value;
        } else if ($type == 'by_id_page') {
            $ids = sort_sdb(explode(',', $data['opt_val']));
            $key = implode(',', $ids);
            $db['settings']['by_id_page'][$key] = $value;
        } else if ($type == 'by_template_page') {
            $db['settings']['by_template_page'][$data['opt_val']] = $value;
        } else if ($type == 'by_id_category') {
            $ids = sort_sdb(explode(',', $data['opt_val']));
            $key = implode(',', $ids);
            $db['settings']['by_id_category'][$key] = $value;
        } else if (strpos($type, 'by_id_') !== FALSE || strpos($type, 'by_category_') !== FALSE) {
            $ids = sort_sdb(explode(',', $data['opt_val']));
            $key = implode(',', $ids);
            $db['settings'][$type][$key] = $value;
        }
        update_option($this->wp_option, $db);
    }

    public function tf_get_settings() {
        if ($this->settings === NULL) {
            $this->settings = $this->get_db();
            $this->settings = isset($this->settings['settings']) ? $this->settings['settings'] : array();
        }
        return $this->settings;
    }

    public function get_db() {
        $db = (array) get_option($this->wp_option);
        return array_filter($db);
    }

    public function get_sidebars() {
        if ($this->sidebars === NULL) {
            $this->sidebars = $this->get_db();
            $this->sidebars = isset($this->sidebars['sidebars']) ? $this->sidebars['sidebars'] : array();
        }
        return $this->sidebars;
    }

    public function get_sidebar($id) {
        $sidebars = $this->get_sidebars();
        if (array_key_exists($id, $sidebars))
            return $sidebars[$id];
        else
            return FALSE;
    }

    public function get_sidebar_names() {
        global $wp_registered_sidebars;
        $out = array();
        foreach ($wp_registered_sidebars as $id => $opts)
            $out[$id] = $opts['name'];
        return $out;
    }

    public function generate_id($name) {
        $id = sanitize_title($name);
        $k = 0;
        do {
            $new_id = $id . ($k++ == 0 ? '' : ('_' . ($k - 1)));
            if ($this->get_sidebar($new_id) === FALSE && $new_id != 'sidebar-1') {
                $id = $new_id;
                break;
            }
        } while (1);
        return $id;
    }

    public function delete_sidebar($id) {
        $sidebars = $this->get_sidebars();
        if (isset($sidebars[$id])) {
            $db = (array) get_option($this->wp_option);
            if (isset($db['settings']))
                foreach ($db['settings'] as $type => $val) {
                    if (substr($type, 0, 8) == 'default_') {
                        foreach ($val['sidebars'] as $key1 => $sdbs) {
                            foreach ($sdbs as $key2 => $sidebar_id) {
                                if ($sidebar_id == $id) {
                                    unset($db['settings'][$type]['sidebars'][$key1][$key2]);
                                }
                            }
                            $db['settings'][$type]['sidebars'][$key1] = array_values($db['settings'][$type]['sidebars'][$key1]);
                        }
                    } else {
                        foreach ($val as $type_id => $type_val) {
                            foreach ($type_val['sidebars'] as $key1 => $sdbs) {
                                foreach ($sdbs as $key2 => $sidebar_id) {
                                    if ($sidebar_id == $id) {
                                        unset($db['settings'][$type][$type_id]['sidebars'][$key1][$key2]);
                                    }
                                }
                                $db['settings'][$type][$type_id]['sidebars'][$key1] = array_values($db['settings'][$type][$type_id]['sidebars'][$key1]);
                            }
                        }
                    }
                }
            unset($sidebars[$id]);
            $db['sidebars'] = array_filter($sidebars);
            update_option($this->wp_option, $db);
        }
        return TRUE;
    }

    public function delete_settings($vars = array()) {
        extract($vars);
        $db = $this->get_db();
        if (!isset($db['settings']))
            return;
        if (isset($subtype) && isset($db['settings'][$subtype])) {
            if (isset($id)) {
                if (isset($db['settings'][$subtype][$id])) {
                    unset($db['settings'][$subtype][$id]);
                }
            } else {
                unset($db['settings'][$subtype]);
            }
        }
        foreach ($db['settings'] as $key => $val)
            if (is_array($val) && count($val) == 0)
                unset($db['settings'][$key]);
        update_option($this->wp_option, array_filter($db));
        return true;
    }

    protected function cache_reset() {
        $this->sidebars = NULL;
    }

}