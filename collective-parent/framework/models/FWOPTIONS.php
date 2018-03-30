<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_FWOPTIONS extends TF_TFUSE {

    public $_the_class_name = 'FWOPTIONS';

    public function __construct() {
        parent::__construct();
    }

    public function __init() {
        add_action('tfuse_framework_page', array($this, 'create_admin_meta_box'));
    }

    public function get_admin_options() {
        $admin_meta_boxes = array();
        $tfuse_framework_options = (array) get_option(TF_THEME_PREFIX . '_tfuse_framework_options');
        $options = $this->get->options('admin');

        foreach ($options['tabs'] as $tab) {
            $headings = $tab['headings'];
            unset($tab['headings']);
            $admin_meta_boxes['tabs'][] = $tab;
            foreach ($headings as $heading) {
                $admin_meta_boxes[$tab['id']][$heading['name']] = '';
                foreach ($heading['options'] as $option) {
                     //added code
                     if($option['type']==='multiple_input' && method_exists($this->optigen, 'multiple_input') && isset($tfuse_framework_options[preg_replace('/\[(\d*|\w*)\]/','',$option['id'])]))
                        $option['value']=$tfuse_framework_options[preg_replace('/\[(\d*|\w*)\]/','',$option['id'])];
                    // end added code
                    if (isset($tfuse_framework_options[$option['id']]))
                        $option['value'] = $tfuse_framework_options[$option['id']];
                    if ($option['type'] == 'boxes' && method_exists($this->optigen, 'boxes')) {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->boxes($option);
                    } else {
                        $admin_meta_boxes[$tab['id']][$heading['name']] .= $this->interface->meta_box_row_template($option);
                    }
                }
            }
        }

        return $admin_meta_boxes;
    }

    function save_post_options_init($post_id, $post) {
        // To prevent duplicate entries when using save_post action
        global $save_post_flag;

        $tfuse_post_options = array();

        if ($save_post_flag == 0) {
            // Verify this came from the our screen and with proper authorization,
            // because save_post can be triggered at other times
//            if (!wp_verify_nonce($this->request->POST('_tfuse_noncename'), '_tfuse_meta_box'))
//                return;

            $options = $this->get->options($post->post_type);

            foreach ($options as $option) {
                if ($option['type'] == 'metabox') {
                    
                } elseif ($this->optisave->has_method("post_{$option['type']}")) {
                    $this->optisave->{"post_{$option['type']}"}($option, $tfuse_post_options);
                } else {
                    $this->optisave->post_text($option, $tfuse_post_options);
                }
            }

            do_action('tf_save_post_options_extra_processing', $tfuse_post_options, $post_id, $post->post_type);

            tf_update_post_meta($post_id, TF_THEME_PREFIX . '_tfuse_post_options', $tfuse_post_options);
        }
        $save_post_flag = 1;
    }

    function autosave_post_options()
    {
        if( ( ! isset($_POST['request_owner']) ) || ( $_POST['request_owner'] != 'tfuse' ) )
            wp_die(__('Invalid request', 'tfuse'));

        $post_id = $_POST['post_ID'];

        if( ( ! isset($post_id) ) || ( intval($post_id) == 0 ) )
            wp_die(__('Invalid post ID', 'tfuse'));

        $post = get_post($post_id);

        if( ( $post == null ) || ( is_wp_error($post) ) || ( ! is_object($post) ) )
            wp_die(__('Unable to get post', 'tfuse'));

        if ( 'page' == $post->post_type ) {
            if ( ! current_user_can('edit_page', $post_id) )
                wp_die( __('You are not allowed to edit this page.', 'tfuse') );
        } else {
            if ( ! current_user_can('edit_post', $post_id) )
                wp_die( __('You are not allowed to edit this post.', 'tfuse') );
        }

        $this->save_post_options_init($post_id, $post);
        wp_die();
    }

    function save_taxonomy_options_init($term_id, $tt_id, $taxonomy) {
        $tfuse_taxonomy_options = (array) get_option(TF_THEME_PREFIX . '_tfuse_taxonomy_options');
        $options = $this->get->options($taxonomy);
        if (isset($tfuse_taxonomy_options[$term_id]))
            unset($tfuse_taxonomy_options[$term_id]);
        foreach ($options as $option) {
            if ($this->optisave->has_method("taxonomy_{$option['type']}")) {
                $this->optisave->{"taxonomy_{$option['type']}"}($option, $term_id, $tfuse_taxonomy_options);
            } else {
                $this->optisave->taxonomy_text($option, $term_id, $tfuse_taxonomy_options);
            }
        }
        update_option(TF_THEME_PREFIX . '_tfuse_taxonomy_options', array_filter($tfuse_taxonomy_options));
    }

    /**
     * Add meta boxes into tabs on admin page.
     *
     * @since 2.0
     */
    public function create_admin_meta_box() {
        $admin_meta_boxes = $this->get_admin_options();

        $tabs_header = '<ul>';
        foreach ($admin_meta_boxes['tabs'] as $tab) {
            $tabs_header .= '<li><a href="#tfusetab-' . $tab['id'] . '">' . $tab['name'] . '</a></li>';
        }
        $tabs_header .= '</ul>';

        foreach ($admin_meta_boxes as $tab => $box) {
            if ($tab == 'tabs')
                continue;

            foreach ($box as $heading => $rows) {
                $boxid = 'tf-random-id-'. tf_unique_increment();
                add_meta_box($boxid, $heading, array($this, 'custom_admin_box_content'), $tab, 'normal', 'core', $rows);
            }
        }

        echo '<div class="tf_load_meta_tabs">&nbsp;</div>';
        echo '<div class="tf_meta_tabs">';
        echo $tabs_header;
        foreach ($admin_meta_boxes['tabs'] as $tab) {
            echo '<div id="tfusetab-' . $tab['id'] . '">';
            do_meta_boxes($tab['id'], 'normal', null);
            echo '</div>';
        }
        echo'</div>';
    }

    function custom_admin_box_content($post, $args) {
        /* Filtru pentru a putea modifica in totalitate continutul pentru metabox cu ID concret */
        echo apply_filters("{$args['id']}_custom_admin_box_content", $args['args'], $post, $args);
    }

}