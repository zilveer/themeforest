<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_SIDEBARS extends TF_TFUSE {

    public $_standalone = TRUE;
    public $_the_class_name = 'SIDEBARS';
    public $model;
    public $current_sidebars = array();
    public $current_position;

    function __construct() {
        parent::__construct();
        $this->wp_option = TF_THEME_PREFIX . '_tfuse_slider';
        include_once(ABSPATH . 'wp-admin/includes/theme.php');
    }

    function __init()
    {
        // Do not load extension if no folder exists in theme_config/
        if (!$this->load->ext_file_exists($this->_the_class_name, '')) return;

        $this->load->ext_helper($this->_the_class_name, 'SIDEBARS');
        $this->sidebars_init();
        $this->dynamic_sidebars_init();
        $this->add_ajax();
        if (stripos($_SERVER['REQUEST_URI'], 'widgets.php')) {
            if (is_admin())
                $this->add_static();
            add_action('sidebar_admin_page', array($this, 'expand_sidebars'));
            add_action('add_meta_boxes', array($this, 'add_meta_box'));
            $this->include->js_enq('tf_nonce_sidebars', wp_create_nonce('tf_nonce_sidebars'));
            $this->add_delete_buttons();
            $this->include->js_enq('sidebar_names', $this->model->get_sidebar_names());
            if ($this->request->isset_GET('tab_switch'))
                $this->include->js_enq('tab_switch', $this->request->GET('tab_switch'));
            $this->include->js_enq('widgets_url', get_admin_url() . 'widgets.php');
            $this->include->js_enq('current_page', 'widgets');
        }
        add_action('get_header', array($this, 'placeholders_workout'));
    }

    protected function sidebars_init() {
        $this->load->ext_file($this->_the_class_name, '/includes/sidebars_init.php', NULL, TRUE);
    }

    public function placeholders_workout() {
        global $is_tf_blog_page,$is_tf_front_page;
        if( is_front_page() ) $is_tf_front_page=true;

        $settings = $this->model->tf_get_settings();

        if ($is_tf_blog_page) {
            $is_tf_front_page=false;
            if (isset($settings['default_is_blogpage'])) {
                $this->current_sidebars = $settings['default_is_blogpage']['sidebars'];
                $this->current_position = $settings['default_is_blogpage']['position'];
                return;
            }
        }

        if ($is_tf_front_page) {
            if (isset($settings['default_is_front_page'])) {
                $this->current_sidebars = $settings['default_is_front_page']['sidebars'];
                $this->current_position = $settings['default_is_front_page']['position'];
                return;
            }
        }
        if (is_singular()) {
            $the_id = get_the_ID();
            $the_type = get_post_type();
            if (isset($settings['by_id_' . $the_type][$the_id])) {
                $this->current_sidebars = $settings['by_id_' . $the_type][$the_id]['sidebars'];
                $this->current_position = $settings['by_id_' . $the_type][$the_id]['position'];
                return;
            } else {
                if (isset($settings['by_id_' . $the_type]))
                    foreach ($settings['by_id_' . $the_type] as $key => $val) {
                        $split_ids = explode(',', $key);
                        if (in_array($the_id, $split_ids)) {
                            $this->current_sidebars = $settings['by_id_' . $the_type][$key]['sidebars'];
                            $this->current_position = $settings['by_id_' . $the_type][$key]['position'];
                            return;
                        }
                    }
            }
            if (is_single()) {
                $terms = wp_get_post_terms($the_id, tf_custom_post_category($the_type));
                foreach ($terms as $term) {
                    if (isset($term->term_id)){
                        $is_in_multi = (isset($settings['by_category_' . $the_type])) ? $this->is_in_multi_terms($settings['by_category_' . $the_type], $term->term_id) : false;
                        if (isset($settings['by_category_' . $the_type][$term->term_id])) {
                            $this->current_sidebars = $settings['by_category_' . $the_type][$term->term_id]['sidebars'];
                            $this->current_position = $settings['by_category_' . $the_type][$term->term_id]['position'];
                            return;
                        }elseif($is_in_multi){
                            $this->current_sidebars = $settings['by_category_' . $the_type][$is_in_multi]['sidebars'];
                            $this->current_position = $settings['by_category_' . $the_type][$is_in_multi]['position'];
                            return;
                        } else {
                            if (isset($settings['by_category_' . $the_type]))
                                foreach ($settings['by_category_' . $the_type] as $key => $val) {
                                    $split_ids = explode(',', $key);
                                    if (in_array($the_id, $split_ids)) {
                                        $this->current_sidebars = $settings['by_category_' . $the_type][$key]['sidebars'];
                                        $this->current_position = $settings['by_category_' . $the_type][$key]['position'];
                                        return;
                                    }
                                }
                        }
                    }
                }
            }           
//            if (is_page()) {
//                $template_in_use = tf_page_template($the_id);
//                if (isset($settings['by_template_page'][$template_in_use])) {
//                    $this->current_sidebars = $settings['by_template_page'][$template_in_use]['sidebars'];
//                    $this->current_position = $settings['by_template_page'][$template_in_use]['position'];
//                    return;
//                }
//            }
            if (isset($settings['default_' . $the_type])) {
                $this->current_sidebars = $settings['default_' . $the_type]['sidebars'];
                $this->current_position = $settings['default_' . $the_type]['position'];
                return;
            }
        }
        if (is_category()) {
            global $cat;
            if (isset($settings['by_id_category'][$cat])) {
                $this->current_sidebars = $settings['by_id_category'][$cat]['sidebars'];
                $this->current_position = $settings['by_id_category'][$cat]['position'];
                return;
            }else{
                    if (isset($settings['by_id_category']))
                        foreach ($settings['by_id_category'] as $key => $val) {
                            $split_ids = explode(',', $key);
                            if (in_array($cat, $split_ids)) {
                                $this->current_sidebars = $settings['by_id_category'][$key]['sidebars'];
                                $this->current_position = $settings['by_id_category'][$key]['position'];
                                return;
                            }
                        }
            }
            if (isset($settings['default_category'])) {
                $this->current_sidebars = $settings['default_category']['sidebars'];
                $this->current_position = $settings['default_category']['position'];
                return;
            }
        }
        if (is_tax()) {

            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            if($term && (!is_wp_error($term))){
                $is_in_multi = (isset($settings['by_id_' . $term->taxonomy])) ? $this->is_in_multi_terms($settings['by_id_' . $term->taxonomy], $term->term_id) : false;
                if (isset($settings['by_id_' . $term->taxonomy][$term->term_id])) {
                    $this->current_sidebars = $settings['by_id_' . $term->taxonomy][$term->term_id]['sidebars'];
                    $this->current_position = $settings['by_id_' . $term->taxonomy][$term->term_id]['position'];
                    return;
                }
                elseif($is_in_multi){
                    $this->current_sidebars = $settings['by_id_' . $term->taxonomy][$is_in_multi]['sidebars'];
                    $this->current_position = $settings['by_id_' . $term->taxonomy][$is_in_multi]['position'];
                    return;
                }
                if (isset($settings['default_' . $term->taxonomy])) {
                    $this->current_sidebars = $settings['default_' . $term->taxonomy]['sidebars'];
                    $this->current_position = $settings['default_' . $term->taxonomy]['position'];
                    return;
                }
            }
        }
        if (is_archive()) {
            if (isset($settings['default_is_archive'])) {
                $this->current_sidebars = $settings['default_is_archive']['sidebars'];
                $this->current_position = $settings['default_is_archive']['position'];
                return;
            }
        }
        if (is_search()) {
            if (isset($settings['default_is_search'])) {
                $this->current_sidebars = $settings['default_is_search']['sidebars'];
                $this->current_position = $settings['default_is_search']['position'];
                return;
            }
        }
        if (is_404()) {
            if (isset($settings['default_is_404'])) {
                $this->current_sidebars = $settings['default_is_404']['sidebars'];
                $this->current_position = $settings['default_is_404']['position'];
                return;
            }
        }
        if (isset($settings['default_is_default'])) {
            $this->current_sidebars = $settings['default_is_default']['sidebars'];
            $this->current_position = $settings['default_is_default']['position'];
            return;
        } else {
            $sidebar_cfg = $this->get->ext_config($this->_the_class_name, 'base');
            for ($i = 0; $i < $sidebar_cfg['max_placeholders']; $i++) {
                $this->current_sidebars[$i] = array();
                $this->current_position = NULL;
            }
        }
    }

    public function expand_sidebars() {
        $data = array();
        $sidebar_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        $sdb_opts = $this->get->ext_include($this->_the_class_name, 'base');
        $data['max_placeholders'] = $sidebar_cfg['max_placeholders'];
        $data['sidebars_positions'] = $sidebar_cfg['sidebar_positions_options'];
        $data['_inc_'] = $sdb_opts;
        $this->load->ext_view($this->_the_class_name, 'main_box', $data);
        $this->load->ext_view($this->_the_class_name, 'interactive_elements', $data);
    }

    public function add_meta_box() {
        add_meta_box('tf_sidebar_meta_box_container', __('Sidebar Settings', 'tfuse'), array($this, 'add_the_meta_box'), '', 'normal', 'high');
    }

    public function add_delete_buttons() {
        $sidebars = $this->model->get_sidebars();
        $this->include->js_enq('dynamic_sidebar_ids', array_keys($sidebars));
    }

    protected function add_static() {
        $this->include->register_type('framework_js', TFUSE . '/static/javascript');
        $this->include->js('jui-effects', 'framework_js', 'tf_footer');
        $this->include->register_type('ext_sidebar_js', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/js');
        $this->include->register_type('ext_sidebar_css', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/css');
        $this->include->css('sidebar', 'ext_sidebar_css', 'tf_head', '1.1');
        $this->include->js('sidebar', 'ext_sidebar_js', 'tf_footer', 10, '1.2');
    }

    protected function add_ajax() {
        $this->ajax->_add_action('tfuse_ajax_sidebars', $this);
    }

    /**
     * @ajax
     */
    public function tfuse_ajax_sidebar_save_new() {
        tf_can_ajax();
        if (trim($this->request->POST('sidebar_name')) == '')
            die(json_encode(array('status' => -1, 'message' => __('No sidebar name specified.', 'tfuse'))));
        $this->model->save_new_sidebar($this->request->POST('sidebar_name'));
        echo json_encode(array('status' => 1));
        die();
    }

    /**
     * @ajax
     */
    public function tfuse_ajax_sidebar_delete() {
        tf_can_ajax();
        $this->model->delete_sidebar($this->request->POST('sidebar_id'));
        echo json_encode(array('status' => 1));
        die();
    }

    public function dynamic_sidebars_init() {
        $sidebars = $this->model->get_sidebars();
        extract(tf_sidebar_cfg());
        foreach ($sidebars as $id => $sidebar) {
            register_sidebar(
                    array(
                        'name' => stripslashes($sidebar['name']),
                        'id' => $id,
                        'before_widget' => $beforeWidget,
                        'after_widget' => $afterWidget,
                        'before_title' => $beforeTitle,
                        'after_title' => $afterTitle
                    )
            );
        }
    }

    public function build_select_options() {
        $sidebar_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        $select_options = $sidebar_cfg['select_options'];

        $out = array();
        #add inbuilt post types to select menu
        foreach ($select_options['post_types'] as $key => $opts)
            $out[$key] = $opts;
        #now add the custom post types
        $custom_post_types = tf_get_post_types();

        if (count($custom_post_types) > 0) {
            $tmp_post_opts = $sidebar_cfg['select_options']['post_types']['post'];
            foreach ($custom_post_types as $key => $name) {
                if (isset($sidebar_cfg['post_types'][$key])) {
                    $tmp = $tmp_post_opts;
                    $tmp['default_number'] = $sidebar_cfg['post_types'][$key];
                    $tmp['name'] = ucfirst($name);
                    $out[$key] = $tmp;
                } else {
                    $out[$key] = $tmp_post_opts;
                }
            }
        }
        #add inbuilt categories to select menu
        foreach ($select_options['categories'] as $key => $opts)
            $out[$key] = $opts;
        #add the custom taxonomies
        $custom_taxonomies = tf_get_taxonomies();
        if (count($custom_taxonomies) > 0) {
            $tmp_taxonomy_opts = $sidebar_cfg['select_options']['categories']['category'];
            foreach ($custom_taxonomies as $key => $name) {
                if (isset($sidebar_cfg['taxonomies'][$key])) {
                    $tmp = $tmp_taxonomy_opts;
                    $tmp['default_number'] = $sidebar_cfg['taxonomies'][$key];
                    $tmp['name'] = ucfirst($name);
                    $out[$key] = $tmp;
                } else {
                    $out[$key] = $tmp_taxonomy_opts;
                }
            }
        }
        #add other options to select menu
        foreach ($select_options['other'] as $key => $opts)
            $out[$key] = $opts;
        $out2 = array();
        foreach ($out as $key => $val) {
            if (!in_array($key, $sidebar_cfg['sidebar_disabled_types']))
                $out2[$key] = $val;
        }
        return $out2;
    }

    #ajax functions

    /**
     * @ajax
     */
    public function tfuse_ajax_sidebars_save() {
        tf_can_ajax();
        $data = json_decode(stripslashes($this->request->POST('data')), TRUE);
        if (isset($data['last_ids']) && $data['last_ids'] != '') {
            $this->model->delete_settings(array('subtype' => $this->request->POST('type'), 'id' => $data['last_ids']));
        }
        $this->model->save_sidebar_settings($data, $this->request->POST('type'));
        die();
    }

    /**
     * @ajax
     */
    public function tfuse_ajax_sidebars_get() {
        $settings = $this->model->tf_get_settings();
        $type = $this->request->POST('type');
        if (!isset($settings[$type]))
            tfjecho(array());
        if (strpos($type, 'default_') !== FALSE) {
            $out = $settings[$type];
        } else {
            $out = isset($settings[$type][$this->request->POST('data.id')]) ? $settings[$type][implode(',', sort_sdb(explode(',', $this->request->POST('data.id'))))] : array();
        }
        tfjecho($out);
        die();
    }

    /**
     * @ajax
     */
    public function tfuse_ajax_sidebars_delete_settings() {
        tf_can_ajax();
        $data = explode('+', $this->request->POST('data'));
        $vars = array();
        if (isset($data[0])) {
            if (isset($data[1])) {
                $vars['subtype'] = $data[1];
                if (isset($data[2]))
                    $vars['id'] = $data[2];
            }
        }
        if ($this->model->delete_settings($vars))
            tfjecho(array('status' => 1));
        die();
    }

    #end ajax functions
    #callbacks

    function sidebars_choose_type_cb() {
        $opts = func_get_arg(0);
        $opts['contents'] = $this->load->ext_view($this->_the_class_name, 'sidebars_choose_type', array('select_options' => $this->build_select_options()), TRUE);
        return $this->interface->meta_box_row_custom($opts);
    }

    function sidebars_choose_subtype_cb() {
        $sdb_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        $sdb_opts = $this->get->ext_include($this->_the_class_name, 'base');
        $opts = func_get_arg(0);
        $opts['contents'] = $this->load->ext_view($this->_the_class_name, 'sidebars_choose_subtype', array('multi_options' => $sdb_opts['multi_options'], 'max_placeholders' => $sdb_cfg['max_placeholders']), TRUE);
        return $this->interface->meta_box_row_custom($opts);
    }

    function sidebars_choose_multi_cb() {
        $sdb_opts = $this->get->ext_include($this->_the_class_name, 'base');
        $opts = func_get_arg(0);
        $opts['contents'] = $this->load->ext_view($this->_the_class_name, 'sidebars_choose_multi', array('multi_options' => $sdb_opts['multi_options']), TRUE);
        return $this->interface->meta_box_row_custom($opts);
    }

    function sidebars_positions_cb() {
        $opts = func_get_arg(0);
        return $this->interface->meta_box_row_custom($opts);
    }

    function sidebars_placeholders_cb() {
        $sdb_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        $opts = func_get_arg(0);
        $opts['contents'] = $this->load->ext_view(
                $this->_the_class_name, 'sidebars_placeholders', array(
            'ext_name' => $this->_the_class_name,
            'placeholders' => $opts['placeholders'],
            'colors' => $sdb_cfg['sidebars_colors']), TRUE
        );
        return $this->interface->meta_box_row_custom($opts);
    }

    function is_in_multi_terms($settings,$term){
        foreach(array_keys($settings) as $value)
            if(in_array($term,explode(',',$value))) return $value;
        return false;
    }
}