<?php

return array(
    'pages' => array(

        /* =================== HOME =================== */
        'home'    => array(
            array( 'name' => __( 'Page Settings', 'yit' ),
                   'type' => 'title' ),


            array( 'type' => 'close' )
        ),
        /* =================== END SKIN =================== */

        /* =================== GENERAL =================== */
        'pages' => array(

            array( 'type' => 'open' ),

            array(
                'name'    => __( 'Title', 'yit' ),
                'desc'    => __( 'Title for page\'s sitemap section', 'yit' ),
                'id'      => 'sitemap-page-title',
                'type'    => 'text',
                'std'     => 'Pages'
            ),

            array(
                'name'    => __( 'Order by', 'yit' ),
                'desc'    => __( 'Select the attribute you want to use to order the pages', 'yit' ),
                'id'      => 'sitemap-page-order-by',
                'type'    => 'select',
                'options' => array(
                    'post_title' => __( 'Pages alphabetically (by title)', 'yit' ),
                    'menu_order' => __( 'Pages by Page Order', 'yit' ),
                    'post_date' => __( 'Creation time', 'yit' ),
                    'post_modified' => __( 'Time last modified', 'yit' ),
                    'ID' => __( 'Numeric Page ID', 'yit' ),
                    'post_author' => __( 'Page author\'s numeric ID', 'yit' ),
                    'post_name' => __( 'post_name', 'yit' )
                ),
                'std'     => 'post_title'
            ),

            array(
                'name'    => __( 'Order', 'yit' ),
                'desc'    => __( 'Select the order you want to use for pages in sitemap', 'yit' ),
                'id'      => 'sitemap-page-order',
                'type'    => 'select',
                'options' => array(
                    'ASC'   => __('Sort from lowest to highest', 'yit'),
                    'DESC'  => __('Sort from highest to lowest', 'yit')
                ),
                'std'     => 'ASC',
            ),

            array(
                'name'    => __( 'Depth', 'yit' ),
                'desc'    => __( 'This parameter controls how many levels in the hierarchy of pages have to be included in the list generated. The default value is 0 (display all pages, including all sub-pages)', 'yit' ),
                'id'      => 'sitemap-page-depth',
                'type'    => 'slider',
                'std'     => 0,
                'min'     => 0,
                'max'     => 10,
                'step'    => 1
            ),

            array( 'type' => 'close' ),
        ),
    )
);