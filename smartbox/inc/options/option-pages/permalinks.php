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
    'page_title' => THEME_NAME . ' - ' . __('Post Types', THEME_ADMIN_TD),
    'menu_title' => __('Post Types', THEME_ADMIN_TD),
    'slug'       => THEME_SHORT . '-permalinks',
    'main_menu'  => false,
    'menu_icon'  => ADMIN_ASSETS_URI . 'images/theme.png',
    'sections'   => array(
        'permalinks-section' => array(
            'title'   => __('Configure your permalinks here', THEME_ADMIN_TD),
            'fields' => array(
                 array(
                    'prefix'  => '<code>' . get_site_url() . '/</code>',
                    'postfix' => '<code>/my-portfolio-item</code>',
                    'name'    => __('Portfolio URL slug', THEME_ADMIN_TD),
                    'desc'    => __('Choose the url you would like your portfolios to be shown on', THEME_ADMIN_TD),
                    'id'      => 'portfolio_slug',
                    'type'    => 'text',
                    'default' => 'portfolio',
                ),
                 array(
                    'prefix'  => '<code>' . get_site_url() . '/</code>',
                    'postfix' => '<code>/my-timeline</code>',
                    'name'    => __('Timeline URL slug', THEME_ADMIN_TD),
                    'desc'    => __('Choose the url you would like your timelines to use', THEME_ADMIN_TD),
                    'id'      => 'timeline_slug',
                    'type'    => 'text',
                    'default' => 'timelines',
                ),
                 array(
                    'prefix'  => '<code>' . get_site_url() . '/</code>',
                    'postfix' => '<code>/my-service</code>',
                    'name'    => __('Service URL slug', THEME_ADMIN_TD),
                    'desc'    => __('Choose the url you would like your services to use', THEME_ADMIN_TD),
                    'id'      => 'services_slug',
                    'type'    => 'text',
                    'default' => 'our-services',
                ),
            )
        ),
        'posttypes-archives-section' => array(
            'title'   => __('Post Types Archive Pages', '**THEME_ADMIN_TD**'),
            'header'  => __('Set your post types archives pages here', '**THEME_ADMIN_TD**'),
            'fields' => array(
                array(
                    'name'      => __('Portfolio Archive Page', '**THEME_ADMIN_TD**'),
                    'desc'      => __('Set the archive page for the portfolio post type', '**THEME_ADMIN_TD**'),
                    'id'        => 'portfolio_archive_page',
                    'type'      => 'select',
                    'options'  => 'taxonomy',
                    'taxonomy' => 'pages',
                    'default' =>  '',
                    'blank' => __('None', '**THEME_ADMIN_TD**'),
                ),
                array(
                    'name'      => __('Timeline Archive Page', '**THEME_ADMIN_TD**'),
                    'desc'      => __('Set the archive page for the timeline post type', '**THEME_ADMIN_TD**'),
                    'id'        => 'timeline_archive_page',
                    'type'      => 'select',
                    'options'  => 'taxonomy',
                    'taxonomy' => 'pages',
                    'default' =>  '',
                    'blank' => __('None', '**THEME_ADMIN_TD**'),
                ),
                array(
                    'name'      => __('Services Archive Page', '**THEME_ADMIN_TD**'),
                    'desc'      => __('Set the archive page for the services post type', '**THEME_ADMIN_TD**'),
                    'id'        => 'services_archive_page',
                    'type'      => 'select',
                    'options'  => 'taxonomy',
                    'taxonomy' => 'pages',
                    'default' =>  '',
                    'blank' => __('None', '**THEME_ADMIN_TD**'),
                ),
            )
        )
    )
);