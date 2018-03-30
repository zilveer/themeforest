<?php
/**
 * Test Options Page
 *
 * @package Smartbox
 * @subpackage options-pages
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

return array(
    'sections'   => array(
        'twitter-section' => array(
            'title'   => __('Twitter', THEME_ADMIN_TD),
            'header'  => __('Twitter feed options',THEME_ADMIN_TD),
            'fields' => array(
                'account' => array(
                    'name' => __('Twitter username', THEME_ADMIN_TD),
                    'id' => 'account',
                    'type' => 'text',
                    'default' => "envato",
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                ),

                'show'   => array(
                    'name'       =>  __('Maximum number of tweets to show', THEME_ADMIN_TD),
                    'id'         => 'show',
                    'type'       => 'select',
                    'options'    =>  array(
                              1  => 1,
                              2  => 2,
                              3  => 3,
                              4  => 4,
                              5  => 5,
                              6  => 6,
                              7  => 7,
                              8  => 8,
                              9  => 9,
                              10 => 10
                    ),
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                    'default'   => 5,
                ),


                'hidereplies' => array(
                    'name'      => __('Hide replies', THEME_ADMIN_TD),
                    'id'        => 'hidereplies',
                    'type'      => 'checkbox',
                    'default'   =>  'off',
                ),

                'hidepublicized' => array(
                    'name'      => __('Hide Tweets pushed by Publicize', THEME_ADMIN_TD),
                    'id'        => 'hidepublicized',
                    'type'      => 'checkbox',
                    'default'   =>  'off',
                ),

                'includeretweets' => array(
                    'name'      => __('Include retweets', THEME_ADMIN_TD),
                    'id'        => 'includeretweets',
                    'type'      => 'checkbox',
                    'default'   =>  'off',
                ),

                'followbutton' => array(
                    'name'      => __('Display Follow Button', THEME_ADMIN_TD),
                    'id'        => 'followbutton',
                    'type'      => 'checkbox',
                    'default'   =>  'off',
                ),

                'beforetimesince' => array(
                    'name' => __('Text to display between Tweet and timestamp:', THEME_ADMIN_TD),
                    'id' => 'beforetimesince',
                    'type' => 'text',
                    'default' => "",
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                ),

            )//fields
        )//section
    )//sections
);//array
