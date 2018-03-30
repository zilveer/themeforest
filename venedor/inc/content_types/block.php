<?php

// Register Static Block Content Type
add_action('init', 'venedor_static_block_init');

function venedor_static_block_init() {
    
    register_post_type(         
        'block',
        array(
            'labels' => venedor_labels('Block', 'Blocks'),
            'exclude_from_search' => true,
            'has_archive' => false,
            'public' => true,
            'rewrite' => array('slug' => 'static-block-items'),
            'supports' => array('title', 'editor'),
            'can_export' => true
        )
    );
}

?>
