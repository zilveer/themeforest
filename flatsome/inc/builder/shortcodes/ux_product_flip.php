<?php

// Shortcode to display a single product
$options = array(

'post_options' => require( __DIR__ . '/commons/repeater-posts.php' ),

'filter_posts' => array(
    'type' => 'group',
    'heading' => __( 'Filter Posts' ),
    'conditions' => 'ids === ""',
    'options' => array(
         'orderby' => array(
            'type' => 'select',
            'heading' => __( 'Order By' ),
            'default' => 'normal',
            'options' => array(
                'normal' => 'Normal',
                'sales' => 'Sales',
                'rand' => 'Random',
                'date' => 'Date'
            )
        ),
        'order' => array(
            'type' => 'select',
            'heading' => __( 'Order' ),
            'default' => 'asc',
            'options' => array(
                'asc' => 'ASC',
                'desc' => 'DESC',
            )
        ),
        'show' => array(
            'type' => 'select',
            'heading' => __( 'Order' ),
            'default' => '',
            'options' => array(
                '' => 'All',
                'featured' => 'Featured',
                'onsale' => 'On Sale', 
            )
        )
    )
)
);

add_ux_builder_shortcode( 'ux_product_flip', array(
    'name' => 'Flip Book',
    'category' => __( 'Shop' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'product_flipbook' ),
    'wrap' => false,
   'presets' => array(
        array(
            'name' => __( 'Normal' ),
            'content' => '[ux_product_flip]'
        ),
    ),

    'options' => $options
) );
