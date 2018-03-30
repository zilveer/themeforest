<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_SHORTCODES extends TF_TFUSE {

    public $_standalone = TRUE;
    public $_the_class_name = 'SHORTCODES';
    public $_shortcodes = array();
    public $_aliases = array();

    function __construct() {
        parent::__construct();
    }

    function __init()
    {
        // Do not load extension if no folder exists in theme_config/
        if (!$this->load->ext_file_exists($this->_the_class_name, '')) return;

        $this->load->ext_helper($this->_the_class_name, 'SHORTCODES');
        if (is_admin())
            $this->add_static();
        $this->add_ajax();
        $this->load_shortcode_files();
        add_action('admin_menu', array($this, 'add_hidden_pages'));
        add_filter('mce_buttons', array($this, 'add_shortcode_button'));
        add_filter('mce_external_plugins', array($this, 'add_shortcode_plugin'));
    }

    function add_hidden_pages() {
        global $_registered_pages;
        $menu_slug = 'tf_shortcodes_preview';
        $hookname = get_plugin_page_hookname($menu_slug, '');
        if (!empty($hookname)) {
            add_action($hookname, array($this, 'preview_shortcode'));
        }
        $_registered_pages[$hookname] = true;
    }

    public function meta_box_row_shortcodes($row = array()) {
        $out = '';

        if (method_exists($this->optigen, $row['type'])) {
            $img = ( 'upload' == $row['type'] && !empty($row['value']) ) ? ' rel="' . $row['value'] . '"' : '';

            $divider = ( array_key_exists('divider', $row) && $row['divider'] === TRUE ) ? ' divider' : '';

            $out .= '<div option="' . $row['id'] . '" class="option option-' . $row['type'] . ' ' . $row['id'] . '">';
            $out .= '<div class="option-inner">';
            $out .= '<label class="titledesc">' . $row['name'] . '</label>';
            $out .= '<div class="formcontainer">';
            $out .= $this->optigen->$row['type']($row);
            if (!empty($row['desc']))
                $out .= '<div class="desc">' . $row['desc'] . '</div>';
            $out .= '</div>';
            if ('upload' == $row['type'])
                $out .= '<div class="uploaded_thumb"' . $img . '></div>';
            $out .= '<div class="tfclear"></div>';
            $out .= '</div></div>';
            $out .= '<div class="tfclear' . $divider . '"></div>' . "\n";
        }

        // Filtru pentru schimbarea unei optinui specifice dupa id, tip sau toate
        if (has_filter("tfuse_meta_box_row_template_{$row['id']}")) {
            return apply_filters("tfuse_meta_box_row_template_{$row['id']}", $out, $row);
        } else if (has_filter("tfuse_meta_box_row_template_{$row['type']}")) {
            return apply_filters("tfuse_meta_box_row_template_{$row['type']}", $out, $row);
        }
        return apply_filters('tfuse_meta_box_row_template', $out, $row);
    }

    function add_static()
    {
        $this->include->register_type('ext_shortcodes_css', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/css');
        $this->include->register_type('ext_shortcodes_js', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/js');
        $this->include->register_type('ext_config_shortcodes_js', TFUSE_EXT_CONFIG . '/' . strtolower($this->_the_class_name) . '/static/js');
        $this->include->register_type('framework_css', TFUSE . '/static/css');
        $this->include->register_type('framework_js', TFUSE . '/static/javascript');
        $this->include->css('shortcodes', 'ext_shortcodes_css', 'tf_head', '1.1');

        if (is_admin()) {
            $this->include->js('shortcodes', 'ext_shortcodes_js', 'tf_footer', 10, '1.2');
            $this->include->js('shortcodes_custom_generators', 'ext_config_shortcodes_js', 'tf_footer');
            $this->include->css('lionbars', 'framework_css', 'tf_head', '1.0');
            $this->include->js('jquery.lionbars.0.3', 'framework_js', 'tf_footer');
        }

        $this->include->js_enq('shortcode_button_icon', tf_extimage($this->_the_class_name, 'framework-icon.png'));
    }

    function add_shortcode_button($val) {
        $val[] = '|';
        $val[] = 'tf_shortcodes_button';
        return $val;
    }

    function load_shortcode_files($force = FALSE) {
        if (!is_admin() || $force === TRUE) {
            foreach ($this->load->ext_glob($this->_the_class_name , '/shortcodes/*.php', true) as $filepath) {
                load_template( $filepath );
            }
        }
    }

    function add_shortcode_plugin($plugins) {
        $plugins['TFUSE_Shortcodes'] = TFUSE_EXT_URI . '/' . strtolower($this->_the_class_name) . '/static/js/shortcodes_tinymce.js';
        return $plugins;
    }

#end static part

    function add_ajax() {
        $this->ajax->_add_action('tfuse_ajax_shortcodes', $this);
    }

    function common_html() {
        echo '<div id="tfuse_fields" class="wrap">';
        $this->interface->page_header_info();
    }

    function end_footer() {
        echo '</div>';
    }

    function add_shortcode($type, $function, $atts) {
        $IDs = array();
        foreach ($atts['options'] as $option)
            $IDs[] = $option['id'];
        $this->_shortcodes[$type] = array('function' => $function, 'atts' => $atts, 'IDs' => $IDs);
        add_shortcode($type, $function);
    }

    function add_alias($alias, $alias_to, $values = array()) {
        $this->_aliases[$alias] = array('alias_to' => $alias_to, 'values' => $values);
        add_shortcode($alias, 'tf_alias_do');
    }

    function get_shortcodes() {
        return $this->_shortcodes;
    }

    function get_aliases() {
        return $this->_aliases;
    }

    function get_categories() {
        $base_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        return $base_cfg['categories'];
    }

    function get_category_name($category_id) {
        $categories = $this->get_categories();
        $categories = array_flip($categories);
        return $categories[$category_id];
    }

    /**
     * @ajax
     */
    function tfuse_ajax_add_shortcode_page() {
        if (!tf_current_user_can(array('edit_posts'), false))
            die(__('Access denied', 'tfuse'));

        $data = array();
        $this->load_shortcode_files(TRUE);
        $data['shortcodes'] = $this->get_shortcodes();
        $shc_ids = array();
        foreach ($data['shortcodes'] as $type => $atts)
            $shc_ids[$type] = $atts['IDs'];
        $data['categories'] = $this->get_categories();
        $flipped = array_flip($data['categories']);
        $categories = array('all' => __('Show all', 'tfuse'));
        foreach ($flipped as $key => $val)
            $categories[$key] = $val;
        $data['category_option'] = array(
            'name' => __('Shortcode Categories', 'tfuse'),
            'desc' => __('Shortcode Categories', 'tfuse'),
            'id' => 'tf_shortcode_categories',
            'value' => 'all',
            'options' => $categories,
            'type' => 'select'
        );
        $data['filter_option'] = array(
            'name' => __('Shortcode Text Fitler', 'tfuse'),
            'desc' => __('Shortcode Text Filter', 'tfuse'),
            'id' => 'tf_shortcode_text_filter',
            'value' => '',
            'type' => 'text'
        );
        $data['ext_name'] = $this->_the_class_name;
        $out = $this->load->ext_view($this->_the_class_name, 'all_shortcodes', $data, TRUE);
        tfjecho(array('status' => 1, 'content' => utf8_encode($out), 'shc_ids' => $shc_ids));
    }

}
