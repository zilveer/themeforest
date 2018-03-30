<?php

// Meta Fields
function porto_block_meta_fields() {

    return array(
        // Layout
        'container' => array(
            'name' => 'container',
            'title' => __('Wrap as Container', 'porto'),
            'desc' => '',
            'type' => 'radio',
            'default' => 'no',
            'options' => array(
                'yes' => __('Yes', 'porto'),
                'no' => __('No', 'porto')
            )
        ),
        'custom_css' => array(
            'name' => 'custom_css',
            'title' => __('Custom CSS', 'porto'),
            'type' => 'textarea'
        ),
        'custom_js_body', array(
            'name' => 'custom_js_body',
            'title' => __('JS Code', 'porto'),
            'type' => 'textarea'
        )
    );
}

// Show Meta Boxes
add_action('add_meta_boxes', 'porto_add_block_meta_boxes');
function porto_add_block_meta_boxes() {
    if (!function_exists('get_current_screen')) return;
    $screen = get_current_screen();
    if ( function_exists('add_meta_box') && $screen && $screen->base == 'post' && $screen->id == 'block' ) {
        add_meta_box( 'block-meta-box', __('Block Options', 'porto'), 'porto_block_meta_box', 'block', 'normal', 'high' );
    }
}

function porto_block_meta_box() {
    $meta_fields = porto_block_meta_fields();
    porto_show_meta_box($meta_fields);
}

// Save Meta Values
add_action('save_post', 'porto_save_block_meta_values');
function porto_save_block_meta_values( $post_id ) {
    if (!function_exists('get_current_screen')) return;
    $screen = get_current_screen();
    if ($screen && $screen->base == 'post' && $screen->id == 'block') {
        porto_save_meta_value( $post_id, porto_block_meta_fields() );
    }
}

// Remove in default custom field meta box
add_filter('is_protected_meta', 'porto_block_protected_meta', 10, 3);
function porto_block_protected_meta($protected, $meta_key, $meta_type) {
    if (!function_exists('get_current_screen')) return $protected;
    $screen = get_current_screen();
    if (!$protected && $screen && $screen->base == 'post' && $screen->id == 'block') {
        if (array_key_exists($meta_key, porto_block_meta_fields()))
            $protected = true;
    }
    return $protected;
}