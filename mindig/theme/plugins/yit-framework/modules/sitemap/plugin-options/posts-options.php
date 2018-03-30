<?php

return array(
    'posts' => array(

        /* =================== HOME =================== */
        'home'    => array(
            array( 'name' => __( 'Post Settings', 'yit' ),
                   'type' => 'title' ),


            array( 'type' => 'close' )
        ),
        /* =================== END SKIN =================== */

        /* =================== GENERAL =================== */
        'posts' => array(

            array( 'type' => 'open' ),

            array(
                'name'    => __( 'Title', 'yit' ),
                'desc'    => __( 'Title for post\'s sitemap section', 'yit' ),
                'id'      => 'sitemap-post-title',
                'type'    => 'text',
                'std'     => 'Posts'
            ),

            array(
                'name'    => __( 'Order by', 'yit' ),
                'desc'    => __( 'Select the attribute you want to use to order the posts', 'yit' ),
                'id'      => 'sitemap-post-order-by',
                'type'    => 'select',
                'options' => array(
                    'post_date'	=> __('Sort by post date', 'yit'),
                    'author'	=> __('Sort by the numeric author IDs', 'yit'),
                    'category'	=> __('Sort by the numeric category IDs', 'yit'),
                    'content'	=> __('Sort by content', 'yit'),
                    'date'		=> __('Sort by creation date', 'yit'),
                    'ID'		=> __('Sort by numeric Post ID', 'yit'),
                    'modified'	=> __('Sort by last modified date', 'yit'),
                    'name'		=> __('Sort by stub', 'yit'),
                    'parent'	=> __('Sort by parent ID', 'yit'),
                    'password'	=> __('Sort by password', 'yit'),
                    'rand'		=> __('Randomly sort results', 'yit'),
                    'status'	=> __('Sort by status', 'yit'),
                    'title'		=> __('Sort by title', 'yit'),
                    'type'		=> __('Sort by type', 'yit'),
                ),
                'std'     => 'post_date'
            ),

            array(
                'name'    => __( 'Order', 'yit' ),
                'desc'    => __( 'Select the order you want to use for posts in sitemap', 'yit' ),
                'id'      => 'sitemap-post-order',
                'type'    => 'select',
                'options' => array(
                    'ASC'   => __('Sort from lowest to highest', 'yit'),
                    'DESC'  => __('Sort from highest to lowest', 'yit')
                ),
                'std'     => 'ASC'
            ),

            array(
                'name'   => __( 'Show date', 'yit' ),
                'desc'   => __( 'Check if you want to show post date in sitemap', 'yit' ),
                'id'     => 'sitemap-post-show-date',
                'type'   => 'on-off',
                'std'    => 'no'
            ),

            array(
                'name'    => __( 'Number of Items', 'yit' ),
                'desc'    => __( 'Number of items to show in each category. (-1 means no limit)', 'yit' ),
                'id'      => 'sitemap-post-items',
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