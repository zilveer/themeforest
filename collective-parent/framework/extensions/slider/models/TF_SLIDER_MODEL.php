<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

/**
 * Description of TF_SLIDER_MODEL
 *
 */
class TF_SLIDER_MODEL extends TF_TFUSE {

    public $_the_class_name = 'SLIDER_MODEL';
    public $_ext_name = 'SLIDER';
    public $_standalone = TRUE;
    public $design;
    public $type;
    public $sliders = FALSE;
    public $wp_option;
    public $id = null;

    function __construct() {
        parent::__construct();
        $this->wp_option = TF_THEME_PREFIX . '_tfuse_slider';
    }

    function save_slides($id, $options = '', $additional = array()) {
        if (isset($additional['design']))
            $this->design = $additional['design'];
        if (isset($additional['type']))
            $this->type = $additional['type'];
        if (isset($id))
            $this->id = $id;
        $slider_settings = array('general' => '', 'slides' => '');
        $option_list = $this->get->ext_options($this->_ext_name, $this->design, 'designs/' . $this->design);
        $option_list = $this->__parent->add_default_config($option_list);
        $options_file = array();
        $options_file = tf_only_options($option_list);
        unset($option_list);
        foreach ($options['general'] as $tmp_id => $val) {
            $slide_prefix = $this->__parent->get_slide_prefix();
            if (stripos($tmp_id, $slide_prefix) !== FALSE) {
                unset($options['general'][$tmp_id]);
            }
        }
        foreach ($options['general'] as $opt_name => $opt_val) {
            if ($this->optisave->has_method("admin_{$options_file[$opt_name]['type']}")) {
                $this->optisave->{"admin_{$options_file[$opt_name]['type']}"}($options_file[$opt_name], $options['general'], $slider_settings['general']);
            } else {
                $this->optisave->admin_text($options_file[$opt_name], $options['general'], $slider_settings['general']);
            }
        }
        $i = 0;
        foreach ($options['slides'] as $key=>$slide) {
            foreach ($slide as $slide_opt_name => $slide_opt_val) {
                apply_filters('tfuse_slider_value', $slide_opt_val, $options['general']['slider_title'] .' slide '. $key . ' ' . $slide_opt_name);
                if ($this->optisave->has_method("admin_{$options_file[$slide_opt_name]['type']}")) {
                    $this->optisave->{"admin_{$options_file[$slide_opt_name]['type']}"}($options_file[$slide_opt_name], $slide, $slider_settings['slides'][$i]);
                } else {
                    $this->optisave->admin_text($options_file[$slide_opt_name], $slide, $slider_settings['slides'][$i]);
                }
            }
            $i++;
        }
        $slides = $this->get_sliders(true);
        if (isset($slides[$this->id]))
            $slides[$this->id] = $slider_settings;
        else {
            $uniqid = uniqid();
            while (isset($slides[$uniqid]))
                $uniqid = uniqid();
            $slides[$uniqid] = $slider_settings;
            $this->id = $uniqid;
        }
        $slides[$this->id]['general']['design'] = $this->design;
        $slides[$this->id]['general']['type'] = $this->type;
        $slides[$this->id]['id'] = $this->id;
        $slides[$this->id]['design'] = $this->design;
        $slides[$this->id]['type'] = $this->type;
        if (!isset($slides[$this->id]['created_at']))
            $slides[$this->id]['created_at'] = time();
        foreach ($slides[$this->id]['general'] as $key => $val)
            if (stripos($key, 'slider_title') !== false) {
                $slides[$this->id]['title'] = $slides[$this->id]['general'][$key];
                break;
            }
        update_option($this->wp_option, $slides);
        $this->get_sliders();
        return $this->id;
    }

    function has_sliders() {
        if (count($this->get_sliders()) == 0)
            return FALSE;
        else
            return TRUE;
    }

    function get_sliders($doNotDecode = false) {
        if($doNotDecode){
            $backup = @$this->sliders;
            unset($this->sliders);
        }

        if (!isset($this->sliders) || $this->sliders === FALSE) {
            $db = (array) get_option(TF_THEME_PREFIX . '_tfuse_slider');
            $this->sliders = $db;
        } else {
            return array_reverse($this->sliders);
        }
        if ($db === false)
            return array();
        if ($db) {
            $db_keys = array_keys($db);
            $change = TRUE;
            while ($change) {
                $change = FALSE;
                for ($i = 1; $i < count($db_keys); $i++) {
                    if ($db[$db_keys[$i]]['created_at'] > $db[$db_keys[$i - 1]]['created_at']) {
                        $tmp = $db_keys[$i];
                        $db_keys[$i] = $db_keys[$i - 1];
                        $db_keys[$i - 1] = $tmp;
                        $change = TRUE;
                    }
                }
            }
            $new_db = array();
            foreach ($db_keys as $key => $val)
                $new_db[$val] = $db[$val];
            $db = $new_db;
            unset($new_db);
        }
        $db = array_filter(array_reverse($db));
        if($doNotDecode){ // Do not transform 'true' into true/1
            if($backup)
                $this->sliders = $backup;
            else
                unset($this->sliders);
            unset($backup);
        } else {
            $db = decode_tfuse_options($db); // Transform (string)'true' into (bool)true
            $this->sliders = $db;
        }
        return $db;
    }

    function title_exists($title, $id = '') {
        $db = $this->get_sliders();
        foreach ($db as $slider_id => $slider)
            if ($slider['general']['slider_title'] == $title) {
                if ($slider_id != $id)
                    return TRUE;
            }
        return FALSE;
    }

    function get_slider_options($id = '') {
        if ($id != '')
            $this->id = $id;
        $slider = $this->get_slider($id);
        if (!$slider)
            return array();
        else
            return (array) isset($slider['general']) ? $slider['general'] : array();
    }

    function get_slider($id = '') {
        if ($id != '')
            $this->id = $id;
        $all = $this->get_sliders();
        $out = array();
        if (isset($all[$this->id])) {
            $slider = $all[$this->id];
            $slider['design'] = $slider['general']['design'];
            $slider['type'] = $slider['general']['type'];
            $slider['id'] = $this->id;
            unset($slider['general']['design']);
            unset($slider['general']['type']);
            if(!empty($slider['slides']))
            {
                foreach($slider['slides'] as $key=>$slide)
                {
                    foreach ($slide as $name => $value)
                    {
                        $value = apply_filters( 'tfuse_sldier_value', $value, $slider['title'] .' slide '. $key . ' ' . $name );
                        $slider['slides'][$key][$name] = $value;
                    }
                }
            }
            return $slider;
        } else {
            return FALSE;
        }
    }

    function delete($id = '') {
        $sliders = $this->get_sliders();
        if (!is_array($id)) {
            $id = array($id);
        }
        foreach ($id as $single_id) {
            if (isset($sliders[$single_id]))
                unset($sliders[$single_id]);
        }
        update_option($this->wp_option, $sliders);
    }

}
