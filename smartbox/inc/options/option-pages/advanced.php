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
    'page_title' => THEME_NAME . ' - ' . __('Advanced Theme Options', THEME_ADMIN_TD),
    'menu_title' => __('Advanced', THEME_ADMIN_TD),
    'slug'       => THEME_SHORT . '-advanced',
    'main_menu'  => false,
    'menu_icon'  => ADMIN_ASSETS_URI . 'images/theme.png',
    'sections'   => array(
        'portfolio-section' => array(
            'title'   => __('CSS', THEME_ADMIN_TD),
            'fields' => array(
                 array(
                    'name'    => __('Extra CSS', THEME_ADMIN_TD),
                    'desc'    => __('Add extra CSS rules to be included in all pages', THEME_ADMIN_TD),
                    'id'      => 'extra_css',
                    'type'    => 'textarea',
                    'attr'    => array( 'rows' => '10', 'style' => 'width:100%' ),
                    'default' => '',
                )
            )
        ),
        'favicon-section' => array(
            'title'   => __('Site Fav Icon', THEME_ADMIN_TD),
            'header'  => __('Set your favicon icons here', THEME_ADMIN_TD),
            'fields' => array(
                array(
                  'name' => __('Fav Icon', THEME_ADMIN_TD),
                  'id'   => 'favicon',
                  'type' => 'upload',
                  'store' => 'url',
                  'desc' => __('Upload a Fav Icon for your site here', THEME_ADMIN_TD),
                  'default' => IMAGES_URI . 'bundled/favicon.ico',
                ),
            )
        ),
        'apple-section' => array(
            'title'   => __('Apple Icons', THEME_ADMIN_TD),
            'header'  => __('Set your apple device icons here', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name' => __('iPhone Icon', THEME_ADMIN_TD),
                    'id'   => 'iphone_icon',
                    'type' => 'upload',
                    'store' => 'url',
                    'desc' => __('Upload an icon to be used by iPhone as a bookmark (57 x 57 pixels)', THEME_ADMIN_TD),
                    'default' => IMAGES_URI . 'bundled/apple-touch-icon-57x57-precomposed.png',
                ),
                array(
                    'name'    => __('iPhone -  Apply Apple style', THEME_ADMIN_TD),
                    'desc'    => __('Allow device to apply styling to the icon?', THEME_ADMIN_TD),
                    'id'      => 'iphone_icon_pre',
                    'type'    => 'radio',
                    'default' => 'apple-touch-icon',
                    'options' => array(
                        'apple-touch-icon'             => __('Allow Styling', THEME_ADMIN_TD),
                        'apple-touch-icon-precomposed' => __('Leave It Alone', THEME_ADMIN_TD),
                    ),
                ),
                array(
                  'name' => __('iPhone Retina Icon', THEME_ADMIN_TD),
                  'id'   => 'iphone_retina_icon',
                  'type' => 'upload',
                  'store' => 'url',
                  'desc' => __('Upload an icon to be used by iPhone Retina as a bookmark (114 x 114 pixels)', THEME_ADMIN_TD),
                  'default' => IMAGES_URI . 'bundled/apple-touch-icon-114x114-precomposed.png',
                ),
                array(
                    'name'    => __('iPhone Retina -  Apply Apple style', THEME_ADMIN_TD),
                    'desc'    => __('Allow device to apply styling to the icon?', THEME_ADMIN_TD),
                    'id'      => 'iphone_retina_icon_pre',
                    'type'    => 'radio',
                    'default' => 'apple-touch-icon',
                    'options' => array(
                        'apple-touch-icon'             => __('Allow Styling', THEME_ADMIN_TD),
                        'apple-touch-icon-precomposed' => __('Leave It Alone', THEME_ADMIN_TD),
                    ),
                ),
                array(
                  'name' => __('iPad Icon', THEME_ADMIN_TD),
                  'id'   => 'ipad_icon',
                  'type' => 'upload',
                  'store' => 'url',
                  'desc' => __('Upload an icon to be used by iPad as a bookmark (72 x 72 pixels)', THEME_ADMIN_TD),
                  'default' => IMAGES_URI . 'bundled/apple-touch-icon-72x72-precomposed.png',
                ),
                array(
                    'name'    => __('iPad -  Apply Apple style', THEME_ADMIN_TD),
                    'desc'    => __('Allow device to apply styling to the icon?', THEME_ADMIN_TD),
                    'id'      => 'ipad_icon_pre',
                    'type'    => 'radio',
                    'default' => 'apple-touch-icon',
                    'options' => array(
                        'apple-touch-icon'             => __('Allow Styling', THEME_ADMIN_TD),
                        'apple-touch-icon-precomposed' => __('Leave It Alone', THEME_ADMIN_TD),
                    ),
                ),
                array(
                  'name' => __('iPad Retina Icon', THEME_ADMIN_TD),
                  'id'   => 'ipad_icon_retina',
                  'type' => 'upload',
                  'store' => 'url',
                  'desc' => __('Upload an icon to be used by iPad Retina as a bookmark (144 x 144 pixels)', THEME_ADMIN_TD),
                  'default' => IMAGES_URI . 'bundled/apple-touch-icon-144x144-precomposed.png',
                ),
                array(
                    'name'    => __('iPad -  Apply Apple style', THEME_ADMIN_TD),
                    'desc'    => __('Allow device to apply styling to the icon?', THEME_ADMIN_TD),
                    'id'      => 'ipad_icon_retina_pre',
                    'type'    => 'radio',
                    'default' => 'apple-touch-icon',
                    'options' => array(
                        'apple-touch-icon'             => __('Allow Styling', THEME_ADMIN_TD),
                        'apple-touch-icon-precomposed' => __('Leave It Alone', THEME_ADMIN_TD),
                    ),
                ),
            )
        ),
        'google-section' => array(
            'title'   => __('Google', THEME_ADMIN_TD),
            'header'  => __('Set your google options here', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name' => __('Google Analytics', THEME_ADMIN_TD),
                    'desc' => __('Paste your google analytics code here', THEME_ADMIN_TD),
                    'id' => 'google_anal',
                    'type' => 'text',
                    'default' => 'UA-XXXXX-X',
                ),
                array(
                    'name' => __('Google Webmaster Tools', THEME_ADMIN_TD),
                    'desc' => __('Add the code to place inside your google-site-verification meta tag', THEME_ADMIN_TD),
                    'id' => 'google_webmaster',
                    'type' => 'text',
                    'default' => '',
                ),
            )
        )
    )
);