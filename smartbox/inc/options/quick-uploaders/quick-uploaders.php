<?php
/**
 * Stores options for themes quick uploaders
 *
 * @package Smartbox
 * @subpackage Admin
 * @since 0.1
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

return array(
    // slideshoe quick upload
    'oxy_slideshow_image' => array(
        'menu_title' => __('Quick Slideshow', THEME_ADMIN_TD),
        'page_title' => __('Quick Slideshow Creator', THEME_ADMIN_TD),
        'item_singular'  => __('Slideshow Image', THEME_ADMIN_TD),
        'item_plural'  => __('Slideshow Images', THEME_ADMIN_TD),
        'taxonomies' => array(
            'oxy_slideshow_categories'
        )
    ),
    // services quick upload
    'oxy_service' => array(
        'menu_title' => __('Quick Services', THEME_ADMIN_TD),
        'page_title' => __('Quick Services Creator', THEME_ADMIN_TD),
        'item_singular'  => __('Services', THEME_ADMIN_TD),
        'item_plural'  => __('Service', THEME_ADMIN_TD),
        'show_editor' => true,
    ),
    // portfolio quick upload
    'oxy_portfolio_image' => array(
        'menu_title' => __('Quick Portfolio', THEME_ADMIN_TD),
        'page_title' => __('Quick Portfolio Creator', THEME_ADMIN_TD),
        'item_singular'  => __('Portfolio Image', THEME_ADMIN_TD),
        'item_plural'  => __('Portfolio Images', THEME_ADMIN_TD),
        'show_editor' => true,
        'taxonomies' => array(
            'oxy_portfolio_categories'
        )
    ),
    // staff quick upload
    'oxy_staff' => array(
        'menu_title' => __('Quick Staff', THEME_ADMIN_TD),
        'page_title' => __('Quick Staff Creator', THEME_ADMIN_TD),
        'item_singular'  => __('Staff Member', THEME_ADMIN_TD),
        'item_plural'  => __('Staff', THEME_ADMIN_TD),
        'show_editor' => true,
        'taxonomies' => array(
            'oxy_staff_skills'
        )
    )
);