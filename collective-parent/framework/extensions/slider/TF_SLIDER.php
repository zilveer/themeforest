<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_SLIDER extends TF_TFUSE {

    public $_standalone = TRUE;
    public $_the_class_name = 'SLIDER';
    public $design = '';
    public $type = '';
    private $general_options;
    private $valid_designs = array();
    public $valid_types = array();
    public $id = '';

    function __construct() {
        parent::__construct();
        $this->wp_option = TF_THEME_PREFIX . '_tfuse_slider';
    }

    function __init()
    {
        // Do not load extension if no folder exists in theme_config/
        if (!$this->load->ext_file_exists($this->_the_class_name, '')) return;

        if ($this->request->isset_GET('page') && $this->request->GET('page') == 'tf_slider' && $this->request->isset_GET('id')) {
            $this->redirect_if_id_invalid($this->request->GET('id'));
        }
        if ($this->request->isset_GET('page') && ($this->request->GET('page') == 'tf_slider' || $this->request->GET('page') == 'tf_slider_list')) {
            $this->include->js_enq('disable_wpbodycontent_overflow', TRUE);
            $this->include->js_enq('current_page', 'slider');
        }
        $this->valid_types = array('custom', 'categories', 'tags', 'posts');
        $sliders_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        if (isset($sliders_cfg['valid_types']) && count($sliders_cfg['valid_types']) > 0) {
            $tmp = array_intersect($this->valid_types, $sliders_cfg['valid_types']);
            if (count($tmp) > 0)
                $this->valid_types = $tmp;
        }
        if (is_admin() && $this->request->isset_GET('page') && stripos($this->request->GET('page'), 'tf_slider') === 0) {
            $this->add_static();
            $this->include->js_enq('tf_slider_save', wp_create_nonce('tf_slider_save'));
        }
        $this->add_ajax();
        $this->include->js_enq('TFUSE_THEME_URL', TFUSE_THEME_URI);
        $this->general_options = $sliders_cfg['setup'];
        foreach ($this->general_options as $opts)
            $this->valid_designs[] = $opts['design'];
        $this->decide_design();
        $this->decide_type();
        wp_create_nonce('tfuse_ajax_delete_sliders');
        add_action('admin_menu', array($this, 'add_menu'));
        $this->framework_extra();
        if ($this->design != '')
            $this->add_saveable_options();
    }

    protected function framework_extra() {
        add_filter('options_filter', array($this, 'options_extra_filter'), 10, 2);
        add_filter('tfuse_options_filter', array($this, 'options_extra_filter'), 10, 2); // trebuie doar una din ele .. dar nustiu care :)
    }

    public function options_extra_filter($val, $type) {
        if ($type == 'post') {
            $extra_options = $this->get_extra_fields();
            if (count($extra_options) == 0)
                return $val;
            $val[] = array('name' => apply_filters('tf_ext_slider_options_extra_filter_name', __('Post Fetched For Slider', 'tfuse')),
                'id' => TF_THEME_PREFIX . '_slider_options',
                'type' => 'metabox',
                'context' => 'normal'
            );
            foreach ($extra_options as $iter) {
                $val[] = $iter;
            }
        }
        return $val;
    }

    public function redirect_if_id_invalid($id) {
        if ($this->model->get_slider($id) === FALSE)
            wp_redirect(get_admin_url() . '/admin.php?page=tf_slider_list');
    }

    protected function decide_design() {
        if ($this->request->isset_GET('id')) {
            $slider = $this->model->get_slider($this->request->GET('id'));
            $this->design = $slider['design'];
            $this->id = $this->request->GET('id');
            return;
        }
        if (!($this->request->isset_GET('page') && $this->request->GET('page') == 'tf_slider') || !($this->request->isset_REQUEST('slider_design') && in_array($this->request->REQUEST('slider_design'), $this->valid_designs)))
            return;
        $this->design = strtolower($this->request->REQUEST('slider_design'));
    }

    public function get_extra_fields() {
        $extra_options = array();
        foreach ($this->general_options as $val) {
            $tmp = $this->get->ext_options($this->_the_class_name, $val['design'], 'designs/' . $val['design']);
            $tmp = $this->add_default_config($tmp);
            if (isset($tmp['extra_options']) && count($tmp['extra_options']))
                foreach ($tmp['extra_options'] as $val2)
                    $extra_options[] = $val2;
        }
        $tmp = array();
        for ($i = 0; $i < count($extra_options); $i++) {
            if (in_array($extra_options[$i]['id'], $tmp)) {
                unset($extra_options[$i]);
            } else {
                $tmp[] = $extra_options[$i]['id'];
            }
        }
        return array_values($extra_options);
    }

    protected function decide_type() {
        if ($this->request->isset_GET('id')) {
            $slider = $this->model->get_slider($this->request->GET('id'));
            $this->type = $slider['type'];
            $this->id = $this->request->GET('id');
        } elseif (($this->request->isset_GET('page') && $this->request->GET('page') == 'tf_slider') && ($this->request->isset_REQUEST('slider_type') && in_array($this->request->REQUEST('slider_type'), $this->valid_types))) {
            $this->type = $this->request->REQUEST('slider_type');
        }
        if (!empty($this->type))
            $this->include->js_enq('slider_type', $this->type);
    }

    function add_menu() {
        if (count($this->general_options) <= 0)
            return;
        add_object_page(apply_filters('tf_ext_slider_menu_label_page_title', __('Sliders', 'tfuse')), apply_filters('tf_ext_slider_menu_label_menu_title', __('Sliders', 'tfuse')), 'publish_pages', 'tf_slider_list', array($this, 'list_sliders'), '', 10);
        add_submenu_page('tf_slider_list', apply_filters('tf_ext_slider_submenu_label_page_title', __('All sliders', 'tfuse')), apply_filters('tf_ext_slider_submenu_label_menu_title', __('All Sliders', 'tfuse')), 'publish_pages', 'tf_slider_list', array($this, 'list_sliders'));
        $design_from_page = str_replace('tf_slider_', '', $this->request->GET('page'));
        add_submenu_page('tf_slider_list', apply_filters('tf_ext_slider_submenu_add_label_page_title', __('Add New Slider', 'tfuse')), apply_filters('tf_ext_slider_submenu_add_label_menu_title', __('Add New', 'tfuse')), 'publish_pages', 'tf_slider', array($this, 'add_new'));
        if (in_array($design_from_page, $this->valid_designs))
            foreach ($this->general_options as $opts) {
                if ($opts['design'] == $design_from_page) {
                    add_submenu_page('tf_slider_list', $this->$opts['name'], $opts['name'], 'read', 'tf_slider_' . $opts['design'], array($this, 'add_slider'));
                    break;
                }
                else
                    continue;
            }
    }

#static part

    function add_static() {
        $this->include->register_type('ext_slider_css', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/css');
        $this->include->register_type('ext_slider_js', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/js');
        $this->include->css('slider', 'ext_slider_css');
        $this->include->js('slider', 'ext_slider_js', 'tf_footer', 10, '1.2');
        $this->include->js_enq('media_image', tf_extimage($this->_the_class_name, 'media.jpg'));
    }

#end static part

    function add_ajax() {
        $this->ajax->_add_action('tfuse_ajax_slider', $this);
    }

    /**
     * @ajax
     */
    function tfuse_ajax_delete_sliders() {
        tf_can_ajax();
        $this->ajax->_verify_nonce('tfuse_ajax_delete_sliders');
        $items = array();
        $items = json_decode(($this->request->isset_POST('items') ? $this->request->POST('items') : ''), TRUE);
        $this->model->delete($items);
        tfjecho(array('status' => 1, 'message' => __('Sucessfuly deleted.', 'tfuse')));
        die();
    }

    /**
     * @ajax
     */
    function tfuse_ajax_slider_save() {
        tf_can_ajax();
        $this->ajax->_verify_nonce('tf_slider_save');
        $slider_id = $this->request->isset_POST('slider_uniqid') ? $this->request->POST('slider_uniqid') : '';
        $saved_options = json_decode($this->request->isset_POST('options') ? $this->request->POST('options') : '', TRUE);
        if ($this->model->title_exists($saved_options['general']['slider_title'], $slider_id))
            tfjecho(array('status' => -1, 'message' => apply_filters('tf_ext_slider_ajax_slider_save_message', __('The title you have specified is already in use with another slider. Please choose a different slider title.', 'tfuse'))));
        $id = $this->model->save_slides($slider_id, $saved_options, array('design' => $this->request->POST('slider_design'), 'type' => $this->request->POST('slider_type'))); //save_slides() returns ID of inserted row
        echo json_encode(array('status' => 1, 'id' => $id));
        die();
    }

    /**
     * @ajax
     */
    function tfuse_ajax_slider_title_exists() {
        tf_can_ajax();
        if ($this->request->isset_POST('slider_title')) {
            if ($this->model->title_exists($this->request->POST('slider_title')))
                tfjecho(array('status' => -1, 'message' => apply_filters('tf_ext_slider_ajax_slider_title_exists_1', __('A slider with the title you have provided, already exists. Please give a different title for your slider.', 'tfuse'))));
            else
                tfjecho(array('status' => 1, 'message' => __('OK', 'tfuse')));
        }
        else
            tfjecho(array('status' => -1, 'message' => apply_filters('tf_ext_slider_ajax_slider_title_exists_2', __('You have not provided a title for your slider. Please, do so.', 'tfuse'))));
        die();
    }

    function get_slider_options() {
        $admin_meta_boxes = array();
        $tfuse_options = (array) (isset($this->id) && $this->id != '') ? $this->model->get_slider_options($this->id) : array();
        $options = $this->get->ext_options($this->_the_class_name, $this->design, 'designs/' . $this->design);
        $options = $this->add_default_config($options);
        $base_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        $this->include->js_enq('slider_settings', $base_cfg['settings']);
        $all_ids = $slide_ids = array();
        foreach ($options['tabs'] as $tab) {
            $admin_meta_boxes['tabs'][] = $tab;
            $headings = $tab['headings'];
            unset($tab['headings']);
            foreach ($headings as $heading) {
                $admin_meta_boxes[$tab['id']][$heading['name']] = '';
                foreach ($heading['options'] as $option) {
                    #setting some parameters for javascript
                    $slide_prefix = &$base_cfg['settings']['extra']['custom']['slide_prefix'];
                    if (stripos($option['id'], $slide_prefix) !== FALSE || stripos($option['id'], $slide_prefix) !== FALSE)
                        $all_ids[] = $option['id'];
                    if (stripos($option['id'], $slide_prefix) !== FALSE)
                        $slide_ids[] = $option['id'];
                    if (stripos($option['id'], $base_cfg['settings']['extra']['custom']['slide_title']) !== FALSE)
                        $this->include->js_enq('title', $option['id']);
                    #end setting
                    if (isset($tfuse_options[$option['id']]))
                        $option['value'] = $tfuse_options[$option['id']];
                    if ($option['type'] == 'boxes' && method_exists($this->optigen, 'boxes')) {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->boxes($option);
                    } elseif ($option['type'] == 'callback') {
                        $admin_meta_boxes[$tab['id']][$heading['name']].=$this->optigen->callback($option);
                    } else {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->meta_box_row_template($option);
                    }
                }
            }
        }
        $this->include->js_enq('all_ids', $all_ids);
        $this->include->js_enq('slide_ids', $slide_ids);
        unset($all_ids, $slide_ids);
        return $admin_meta_boxes;
    }

    function get_add_new_options() {
        $admin_meta_boxes = array();
        $base_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        $options = &$base_cfg['add_new_slider'];
        foreach ($options['tabs'] as $tab) {
            $admin_meta_boxes['tabs'][] = $tab;
            $headings = $tab['headings'];
            unset($tab['headings']);
            foreach ($headings as $heading) {
                $admin_meta_boxes[$tab['id']][$heading['name']] = '';
                foreach ($heading['options'] as $option) {
                    if ($option['type'] == 'boxes' && method_exists($this->optigen, 'boxes')) {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->boxes($option);
                    } elseif ($option['type'] == 'callback') {
                        $admin_meta_boxes[$tab['id']][$heading['name']].=$this->optigen->callback($option);
                    } else {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->meta_box_row_template($option);
                    }
                }
            }
        }
        return $admin_meta_boxes;
    }

    public function get_saveable_options() {
        $saveable_options = array();
        $options = $this->get->ext_options($this->_the_class_name, $this->design, 'designs/' . $this->design);
        $options = $this->add_default_config($options);
        $base_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        foreach ($options['tabs'] as $tab) {
            if (in_array($tab['id'], $base_cfg['settings']['tab_includes']['common'])) {
                foreach ($this->valid_types as $type) {
                    if (!isset($saveable_options[$type]))
                        $saveable_options[$type] = array();
                    foreach ($tab['headings'] as $heading) {
                        foreach ($heading['options'] as $option) {
                            $saveable_options[$type][] = $option['id'];
                        }
                    }
                }
            }
            foreach ($this->valid_types as $type) {
                if (!isset($base_cfg['settings']['tab_includes'][$type]))
                    continue;
                if (!isset($saveable_options[$type]))
                    $saveable_options[$type] = array();
                if (in_array($tab['id'], $base_cfg['settings']['tab_includes'][$type]))
                    foreach ($tab['headings'] as $heading) {
                        foreach ($heading['options'] as $option) {
                            $saveable_options[$type][] = $option['id'];
                        }
                    }
            }
        }
        return $saveable_options;
    }

    public function add_saveable_options() {
        $saveable_options = $this->get_saveable_options();
        $this->include->js_enq('saveable_options', $saveable_options);
    }

    public function get_tab_includes() {
        $base_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        $tab_includes = $base_cfg['settings']['tab_includes']['common'];
        $tab_includes = array_merge($tab_includes, $base_cfg['settings']['tab_includes'][$this->type]);
        return $tab_includes;
    }

    public function create_slider_meta_box($options, $accepted_tab_ids = array()) {
        $admin_meta_boxes = &$options;
        $tabs_header = '<ul>';
        foreach ($admin_meta_boxes['tabs'] as $tab) {
            if (count($accepted_tab_ids) > 0 && !in_array($tab['id'], $accepted_tab_ids))
                continue;
            $tabs_header .= '<li id="tfusetabheader-' . $tab['id'] . '"><a href="#tfusetab-' . $tab['id'] . '">' . $tab['name'] . '</a></li>';
        }
        $tabs_header .= '</ul>';

        foreach ($admin_meta_boxes as $tab => $box) {
            if ($tab == 'tabs')
                continue;
            foreach ($box as $heading => $rows) {
                $boxid = sanitize_title($heading);
                add_meta_box($boxid, $heading, array($this, 'custom_admin_box_content'), $tab, 'normal', 'core', $rows);
            }
        }

        echo '<div class="tf_meta_tabs">';
        echo $tabs_header;
        foreach ($admin_meta_boxes['tabs'] as $tab) {
            if (count($accepted_tab_ids) > 0 && !in_array($tab['id'], $accepted_tab_ids))
                continue;
            echo '<div id="tfusetab-' . $tab['id'] . '">';
            do_meta_boxes($tab['id'], 'normal', null);
            echo '</div>';
        }
        echo'</div>';
    }

    function custom_admin_box_content($post, $args) {

        /* Filtru pentru a putea modifica in totalitate continutul pentru metabox cu ID concret */
        echo apply_filters("{$args['id']}_custom_admin_box_content", $args['args'], $post, $args);

//wp_nonce_field( "{$args['id']}_tfuse_admin_meta_box", "{$args['id']}_tfuse_noncename" );
    }

    function common_html() {
        echo '<div id="tfuse_fields" class="wrap metabox-holder">';
        $this->interface->page_header_info();
        echo '<div style="clear:both;height:20px;">&nbsp</div>';
    }

    function end_footer() {
        echo '</div>';
    }

    function list_sliders() {
        $this->common_html();
        $sliders = $this->model->get_sliders();
        $this->load->ext_view($this->_the_class_name, 'list_sliders', array('sliders' => $sliders, 'ext_name' => $this->_the_class_name));
        $this->end_footer();
    }

    function add_new() {
        if (!$this->request->empty_GET('id') && $this->model->get_slider($this->request->GET('id')) !== FALSE) {
            $this->add_slider();
            if (!$this->request->empty_GET('tab') && $this->request->GET('tab') == 2)
                $this->include->js_enq('switch_to_tab', 1);
            return;
        }
        if (($this->request->isset_POST('slider_design') && in_array($this->request->POST('slider_design'), $this->valid_designs)) && ($this->request->isset_POST('slider_type') && in_array($this->request->POST('slider_type'), $this->valid_types)) && !$this->request->empty_POST('slider_title')) {
            $this->add_slider();
            $this->include->js_enq('slider_title_tmp', $this->request->POST('slider_title'));
            $this->include->js_enq('switch_to_tab', 1);
        } else {
            $this->include->js('add_new', 'ext_slider_js', 'tf_footer');
            $this->common_html();
            $this->create_slider_meta_box($this->get_add_new_options());
            $this->load->ext_view($this->_the_class_name, 'add_new');
            $this->end_footer();
        }
    }

    function add_slider() {
        $this->common_html();
        if ($this->request->isset_GET('id')) {
            $slider = $this->model->get_slider($this->request->GET('id'));
            $this->include->js_enq('slider', $slider['general']);
            $tmp = array();
            foreach ($slider['general'] as $name => $val) {
                if (stripos($name, '_slide_') === false)
                    $tmp[$name] = $val;
            }
            $this->include->js_enq('general', $tmp);
            unset($tmp);
            $this->include->js_enq('slides', $slider['slides']);
        }
        if ($this->request->isset_GET('delete') && $this->request->isset_GET('id') && $this->request->GET('delete') == 1) {
            $this->ext->slider->delete();
        }
        $this->create_slider_meta_box($this->get_slider_options(), $this->get_tab_includes());
        $this->include->js_enq('slider_design', $this->design);
        $this->load->ext_view($this->_the_class_name, 'slider_footer', isset($slider) ? array('slider' => $slider) : array());
        $this->end_footer();
    }

    public function get_sliders_dropdown( $types = array() ) {
        $sliders    = $this->model->get_sliders();
        $tmp        = array(-1 => apply_filters('tf_ext_slider_get_sliders_dropdown', __('Select Slider:', 'tfuse')));

        if( gettype($types) != 'array' ){
            $types = array( (string)$types );
        }
        $no_filter = !sizeof($types);

        foreach ($sliders as $id => $settings) {

            if ($no_filter)
            {
                $tmp[$id] = $settings['general']['slider_title'];
            }
            else
            {
                if( in_array($settings['design'], $types) )  $tmp[$id] = $settings['general']['slider_title'];
            }
        }
        unset($sliders);

        return $tmp;
    }

    public function add_default_config($options) {
        $base_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        foreach ($options['tabs'] as $tab_id => $tab) {
            if ($tab['id'] == 'slider_setup') {
                array_unshift($options['tabs'][$tab_id]['headings'], $base_cfg['slider_framebox']);
            }
            if ($tab['id'] == 'slider_settings') {
                array_unshift($options['tabs'][$tab_id]['headings'][0]['options'], $base_cfg['slider_design_and_type'][0], $base_cfg['slider_design_and_type'][1]);
            }
        }
        return $options;
    }

    public function get_slide_prefix() {
        $base_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        return $base_cfg['settings']['extra']['custom']['slide_prefix'];
    }

    public function get_design_name($slug_name) {
        $base_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        foreach ($base_cfg['setup'] as $val) {
            if ($val['design'] == $slug_name)
                return $val['name'];
        }
        return '';
    }

    #callback

    function slider_design_callback() {
        $opts = func_get_arg(0);
        $opts['contents'] = $this->load->ext_view($this->_the_class_name, 'slider_designs', array('slider_types' => $this->general_options, 'ext_name' => $this->_the_class_name), TRUE);
        return $this->interface->meta_box_row_custom($opts);
    }

    function slider_design_chosen_callback() {
        $opts = func_get_arg(0);
        $opts['contents'] = $this->load->ext_view($this->_the_class_name, 'slider_design_chosen', array('slider_design' => $this->design, 'ext_name' => $this->_the_class_name), TRUE);
        return $this->interface->meta_box_row_custom($opts);
    }

    function slider_type_chosen_callback() {
        $base_cfg = $this->get->ext_config($this->_the_class_name, 'base');
        $opts = func_get_arg(0);
        $opts['contents'] = $base_cfg['slider_type_names'][$this->type];
        return $this->interface->meta_box_row_custom($opts);
    }

}
