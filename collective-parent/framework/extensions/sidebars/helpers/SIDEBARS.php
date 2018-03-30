<?php

//Functions needed for extension SIDEBARS

function change_option_id($option, $val) {
    $option['id'] = $val;
    return $option;
}

function change_option_id_custom($type, $option, $val) {
    $option['id'] = $val;
    $option['subtype'] = $type;
    return $option;
}

function tf_custom_post_category($post_type) {
    $taxonomy = get_taxonomies(
            array(
                'hierarchical' => TRUE,
                'public' => TRUE,
                'show_ui' => TRUE,
                'object_type' => array($post_type)
            )
    );
    return reset($taxonomy);
}

function tf_page_template($id) {
    return get_post_meta($id, '_wp_page_template', true);
}

function get_placeholders_number($type) {
    $TF = get_instance();
    $cfg = $TF->get->ext_config('SIDEBARS', 'base');
    if (isset($cfg['post_types']))
        if (isset($cfg['post_types'][$type]))
            return $cfg['post_types'][$type];
    if (isset($cfg['taxonomies']))
        if (isset($cfg['taxonomies'][$type]))
            return $cfg['taxonomies'][$type];
    foreach ($cfg['select_options'] as $key => $val) {
        if (isset($val[$type]))
            return $val[$type]['default_number'];
    }
    return $cfg['max_placeholders'];
}

function tf_get_templates() {
    $tmp = get_page_templates();
    $templates = array('none' => __('Select template', 'tfuse'));
    foreach ($tmp as $key => $val)
        $templates[$val] = $key;
    return $templates;
}

function tf_get_post_types() {
    $post_types = get_post_types(array('public' => TRUE, 'show_ui' => TRUE));
    if (isset($post_types['post']))
        unset($post_types['post']);
    if (isset($post_types['page']))
        unset($post_types['page']);
    return $post_types;
}

function tf_get_taxonomies() {

    $args =  array(
        'hierarchical' => TRUE,
        'public' => TRUE,
        'show_ui' => TRUE,
        '_builtin' => FALSE
    );
    $args = apply_filters('tf_get_taxonomies', $args);
    $taxonomies = get_taxonomies($args);
    return $taxonomies;
}

function tf_show_icon($bool) {
    if ($bool === true) {
        return '<img class="sidebar_is_set" src="' . TFUSE_EXT_URI . '/sidebars/static/images/sidebar_set.png"/>';
    }
    return '<img class="sidebar_not_set" src="' . TFUSE_EXT_URI . '/sidebars/static/images/sidebar_not_set.png"/>';
}

function sort_sdb($array) {
    $array = array_filter($array);
    sort($array);
    return $array;
}

function tf_do_placeholder($placeholder_id) {
    global $TFUSE;
    $sidebars = $TFUSE->ext->sidebars->current_sidebars;
    if (count($sidebars) > 0) {
        $cfg = $TFUSE->get->ext_config('SIDEBARS', 'base');
        $colors = $cfg['sidebars_colors'];
        $colors_flipped = array_flip($colors);
        if (is_string($placeholder_id)) {
            if (isset($sidebars[$colors_flipped[$placeholder_id] - 1])) {
                $i = $k = 0;
                foreach ($sidebars[$colors_flipped[$placeholder_id] - 1] as $key => $val) {
                    $i++;
                    if (!is_active_sidebar($val)) {
                        $k++;
                    }
                    else
                        dynamic_sidebar($val);
                }
                if ($i == $k) {
                    $TFUSE->load->ext_view('SIDEBARS', 'no_widgets_message');
                }
            }
        }
    }
}
