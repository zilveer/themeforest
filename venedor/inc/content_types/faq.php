<?php

// Register FAQ Content Type
add_action('init', 'venedor_faq_init');

function venedor_faq_init() {
    global $venedor_settings;

    $slug_name = (isset($venedor_settings) && isset($venedor_settings['faq-slug-name']) && $venedor_settings['faq-slug-name']) ? esc_attr($venedor_settings['faq-slug-name']) : 'faq-items';
    $name = (isset($venedor_settings) && isset($venedor_settings['faq-name']) && $venedor_settings['faq-name']) ? $venedor_settings['faq-name'] : __('FAQs', 'venedor');
    $singular_name = (isset($venedor_settings) && isset($venedor_settings['faq-singular-name']) && $venedor_settings['faq-singular-name']) ? $venedor_settings['faq-singular-name'] : __('FAQ', 'venedor');
    $cat_name = (isset($venedor_settings) && isset($venedor_settings['faq-singular-name']) && $venedor_settings['faq-singular-name']) ? $venedor_settings['faq-singular-name'] . ' ' . __('Category', 'venedor') : __('FAQ Category', 'venedor');
    $cats_name = (isset($venedor_settings) && isset($venedor_settings['faq-singular-name']) && $venedor_settings['faq-singular-name']) ? $venedor_settings['faq-singular-name'] . ' ' . __('Categories', 'venedor') : __('FAQ Categories', 'venedor');
    $cat_slug_name = (isset($venedor_settings) && isset($venedor_settings['faq-cat-slug-name']) && $venedor_settings['faq-cat-slug-name']) ? esc_attr($venedor_settings['faq-cat-slug-name']) : 'faq_cat';
    
    register_post_type(         
        'faq',
        array(
            'labels' => venedor_labels($singular_name, $name),
            'exclude_from_search' => true,
            'has_archive' => false,
            'public' => true,
            'rewrite' => array('slug' => $slug_name),
            'supports' => array('title', 'editor'),
            'can_export' => true
        )
    );

    register_taxonomy(
        'faq_cat', 
        'faq', 
        array(
            'hierarchical' => true, 
            'labels' => venedor_labels_tax($cat_name, $cats_name),
            'query_var' => true, 
            'rewrite' => array('slug' => $cat_slug_name)
        )
    );
}

?>
