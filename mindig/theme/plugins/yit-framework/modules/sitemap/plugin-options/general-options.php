<?php

return array(
    'general' => array(

        /* =================== HOME =================== */
        'home'    => array(
            array( 'name' => __( 'Product Settings', 'yit' ),
                   'desc' => __( 'Choose the order in which elements will be displayed', 'yit' ),
                   'type' => 'title' ),


            array( 'type' => 'close' )
        ),
        /* =================== END SKIN =================== */

        /* =================== GENERAL =================== */
        'general' => array(

            array( 'type' => 'open' ),

            array(
                'id'   => 'sitemap-general-order',
                'type' => 'connected-list',
                'name' => __( 'Sitemap Order', 'yit' ),
                'desc' => __('Drag and drop elements to determine the order.', 'yit'),
                'heads' => array(
                    'include' => __('Show', 'yit')
                ),
                'lists' => array(
                    'include' => array(
                        'pages' => __('Pages', 'yit'),
                        'posts' => __('Posts', 'yit'),
                        'archives' => __('Archives', 'yit'),
                        'products' => __('Products', 'yit')
                    )
                ),
                'std' => json_encode(array(
                    'include' => array(
                        'pages' => __('Pages', 'yit'),
                        'posts' => __('Posts', 'yit'),
                        'archives' => __('Archives', 'yit'),
                        'products' => __('Products', 'yit')
                    )
                )),
            ),

            array( 'type' => 'close' ),
        ),
    )
);