<?php

return array(
    'archives' => array(

        /* =================== HOME =================== */
        'home'    => array(
            array( 'name' => __( 'Archive Settings', 'yit' ),
                   'type' => 'title' ),


            array( 'type' => 'close' )
        ),
        /* =================== END SKIN =================== */

        /* =================== GENERAL =================== */
        'archives' => array(

            array( 'type' => 'open' ),

            array(
                'name'    => __( 'Title', 'yit' ),
                'desc'    => __( 'Title for archive\'s sitemap section', 'yit' ),
                'id'      => 'sitemap-archive-title',
                'type'    => 'text',
                'std'     => 'Archive'
            ),

            array(
                'name'    => __( 'Type', 'yit' ),
                'desc'    => __( 'The type of archive list to display.', 'yit' ),
                'id'      => 'sitemap-archive-type',
                'type'    => 'select',
                'options' => array(
                    'yearly'	=> __('Yearly', 'yit'),
                    'monthly'	=> __('Monthly', 'yit'),
                    'daily'		=> __('Daily', 'yit'),
                    'weekly'	=> __('Weekly', 'yit'),
                ),
                'std'     => 'monthly'
            ),

            array(
                'name'    => __( 'Limit', 'yit' ),
                'desc'    => __( 'Number of archives to get. (-1 means no limit)', 'yit' ),
                'id'      => 'sitemap-archive-limit',
                'type'    => 'slider',
                'min'     => -1,
                'max'     => 99,
                'step'    => 1,
                'std'     => -1
            ),

            array(
                'name'   => __( 'Show post count', 'yit' ),
                'desc'   => __( 'Display number of posts in an archive or do not.', 'yit' ),
                'id'     => 'sitemap-archive-show-count',
                'type'   => 'on-off',
                'std'    => 'no'
            ),

            array(
                'name'   => __( 'Order', 'yit' ),
                'desc'   => __( 'Select the order you want to use for archives in sitemap', 'yit' ),
                'id'     => 'sitemap-archive-order',
                'type'   => 'select',
                'options' => array(
                    'ASC' => __('Ascending order (A-Z)', 'yit'),
                    'DESC' => __('Descending order (Z-A)', 'yit')
                ),
                'std' => 'ASC'
            ),

            array( 'type' => 'close' ),
        ),
    )
);