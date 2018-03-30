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
    'page_title' => THEME_NAME . ' - ' . __('404 Page Options', THEME_ADMIN_TD),
    'menu_title' => __('404', THEME_ADMIN_TD),
    'slug'       => THEME_SHORT . '-404',
    'main_menu'  => false,
    'menu_icon'  => ADMIN_ASSETS_URI . 'images/theme.png',
    'sections'   => array(
        '404-header-section' => array(
            'title'   => __('Header', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Header image', THEME_ADMIN_TD),
                    'desc'    => __('Upload an image to show on your 404 page', THEME_ADMIN_TD),
                    'id'      => '404_header_image',
                    'type'    => 'upload',
                    'store'   => 'url',
                    'default' => IMAGES_URI . 'bundled/landscape-3-1250x600.jpg',
                ),
                array(
                    'name'    => __('Header title', THEME_ADMIN_TD),
                    'desc'    => __('The title that appears at inside the header in front of the header image', THEME_ADMIN_TD),
                    'id'      => '404_header_title',
                    'type'    => 'text',
                    'default' => __('Whoops...', THEME_ADMIN_TD)
                )
            )
        ),
        '404-page-section' => array(
            'title'  => __('404 Page', THEME_ADMIN_TD),
            'header' => __('Change the 404 page here', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Page Title', THEME_ADMIN_TD),
                    'desc'    => __('The title that appears on your 404 page', THEME_ADMIN_TD),
                    'id'      => '404_title',
                    'type'    => 'text',
                    'default' => __('Page Not Found', THEME_ADMIN_TD)
                ),
                array(
                    'name'    => __('Page Text', THEME_ADMIN_TD),
                    'desc'    => __('The content of your 404 page', THEME_ADMIN_TD),
                    'id'      => '404_content',
                    'type'    => 'editor',
                    'settings' => array( 'media_buttons' => false ),
                    'default' => __('The page you requested could not be found.', THEME_ADMIN_TD)
                )
            )
        ),
    )
);