<?php

return array(
    'products' => array(

        /* =================== HOME =================== */
        'home'    => array(
            array( 'name' => __( 'Product Settings', 'yit' ),
                   'desc' => __( 'This settings will applied only if Woocommerce is enabled.', 'yit' ),
                   'type' => 'title' ),


            array( 'type' => 'close' )
        ),
        /* =================== END SKIN =================== */

        /* =================== GENERAL =================== */
        'products' => array(

            array( 'type' => 'open' ),

            array(
                'name'    => __( 'Title', 'yit' ),
                'desc'    => __( 'Title for product\'s sitemap section', 'yit' ),
                'id'      => 'sitemap-product-title',
                'type'    => 'text',
                'std'     => 'Products'
            ),
            array(
                'name'    => __( 'Number of Products', 'yit' ),
                'desc'    => __( 'Number of products to show. (-1 means no limit)', 'yit' ),
                'id'      => 'sitemap-product-items',
                'type'    => 'slider',
                'std'     => -1,
                'min'     => -1,
                'max'     => 99,
                'step'    => 1
            ),
            array( 'type' => 'close' ),
        ),
    )
);