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
    'page_title' => THEME_NAME . ' - ' . __('Portfolio Page Options', THEME_ADMIN_TD),
    'menu_title' => __('Portfolio', THEME_ADMIN_TD),
    'slug'       => THEME_SHORT . '-portfolio',
    'main_menu'  => false,
    'menu_icon'  => ADMIN_ASSETS_URI . 'images/theme.png',
    'sections'   => array(
        'portfolio-section' => array(
            'title'   => __('Portfolio section', THEME_ADMIN_TD),
            'fields' => array(
                 array(
                    'name'    => __('Portfolio image style', THEME_ADMIN_TD),
                    'desc'    => __('Choose a style for the portfolio images', THEME_ADMIN_TD),
                    'id'      => 'portfolio_img_style',
                    'type'    => 'radio',
                    'options' => array(
                        'rounded' => __('Rounded', THEME_ADMIN_TD),
                        'squared' => __('Squared', THEME_ADMIN_TD)
                    ),
                    'default' => 'rounded',
                ),
                 array(
                    'name'    => __('Excerpt word count', THEME_ADMIN_TD),
                    'desc'    => __('Number of words to limit each portfolio item on the list', THEME_ADMIN_TD),
                    'id'      => 'portfolio_excerpt_words',
                    'type'    => 'spinner',
                    'default' => 10,
                ),
                 array(
                    'name'    => __('Related items title', THEME_ADMIN_TD),
                    'desc'    => __('Title that is shown on single portfolio page, above releated items', THEME_ADMIN_TD),
                    'id'      => 'portfolio_related_title',
                    'type'    => 'text',
                    'default' => 'Related _Work_',
                ),
            )
        ),
    )
);