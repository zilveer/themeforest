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
    'page_title' => THEME_NAME . ' - ' . __('General', THEME_ADMIN_TD),
    'menu_title' => __('General', THEME_ADMIN_TD),
    'slug'       => THEME_SHORT . '-general',
    'main_menu'  => true,
    'icon'       => 'tools',
    'menu_icon'  => ADMIN_ASSETS_URI . 'images/theme.png',
    'sections'   => array(
        'general-section' => array(
            'title'   => __('Site Style', THEME_ADMIN_TD),
            'header'  => __('Set the style of your site', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Style', THEME_ADMIN_TD),
                    'desc'    => __('Choose a style to use for your page', THEME_ADMIN_TD),
                    'id'      => 'style',
                    'type'    => 'radio',
                    'options' => array(
                        ''            => __('Blue', THEME_ADMIN_TD),
                        'theme-brown' => __('Brown', THEME_ADMIN_TD),
                        'theme-red'   => __('Red', THEME_ADMIN_TD),
                    ),
                    'default' => '',
                ),
                array(
                    'name'    => __('Width Style', THEME_ADMIN_TD),
                    'desc'    => __('Choose a width for the site', THEME_ADMIN_TD),
                    'id'      => 'width',
                    'type'    => 'radio',
                    'options' => array(
                        '' => __('Box Model', THEME_ADMIN_TD),
                        'fullwidth'   => __('Full Width', THEME_ADMIN_TD),
                    ),
                    'default' => '',
                ),
                array(
                    'name'    => __('Site Font', THEME_ADMIN_TD),
                    'desc'    => __('Choose a font for the site (Open Sans supports more charsets for translations than Lato)', THEME_ADMIN_TD),
                    'id'      => 'main_site_font',
                    'type'    => 'radio',
                    'options' => array(
                        'fonts.css'     => __('Lato', THEME_ADMIN_TD),
                        'fonts-alt.css' => __('Open Sans', THEME_ADMIN_TD),
                    ),
                    'default' => 'fonts.css',
                ),
                array(
                    'name'    => __('Background Text Colour', THEME_ADMIN_TD),
                    'desc'    => __('Text colour in header and footer sections where the background is shown (choose light when using dark backgrounds)', THEME_ADMIN_TD),
                    'id'      => 'skin',
                    'type'    => 'radio',
                    'options' => array(
                        ''             => __('Dark Text', THEME_ADMIN_TD),
                        'theme-dark'   => __('Light Text', THEME_ADMIN_TD),
                    ),
                    'default' => '',
                ),
            )
        ),
        'logo-section' => array(
            'title'   => __('Logo', THEME_ADMIN_TD),
            'header'  => __('Upload and configure your site logo here', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Logo Type', THEME_ADMIN_TD),
                    'desc'    => __('Select which kind of logo you would like', THEME_ADMIN_TD),
                    'id'      => 'logo_type',
                    'type'    => 'radio',
                    'options' => array(
                        'text'  => __('Use Text', THEME_ADMIN_TD),
                        'image' => __('Use Image', THEME_ADMIN_TD),
                    ),
                    'default' => 'text',
                ),
                array(
                    'name'    => __('Logo Text', THEME_ADMIN_TD),
                    'desc'    => __('Add your logo text here ( to use light font wrap in underscores like _title_ )', THEME_ADMIN_TD),
                    'id'      => 'logo_text',
                    'type'    => 'text',
                    'default' => 'SMART_BOX_',
                ),
                array(
                    'name'    => __('Logo', THEME_ADMIN_TD),
                    'desc'    => __('Upload a logo for your site', THEME_ADMIN_TD),
                    'id'      => 'logo_image',
                    'store'   => 'id',
                    'type'    => 'upload',
                    'default' => '',
                ),
                array(
                    'name'    => __('Retina Logo', THEME_ADMIN_TD),
                    'desc'    => __('Use retina logo (NOTE - you will need to upload a logo that is twice the size intended to display)', THEME_ADMIN_TD),
                    'id'      => 'logo_retina',
                    'type'    => 'radio',
                    'options' => array(
                        'on'  => __('Retina Logo', THEME_ADMIN_TD),
                        'off' => __('Normal Logo', THEME_ADMIN_TD),
                    ),
                    'default' => 'off',
                ),
            )
        ),
        'header-section' => array(
            'title'   => __('Header Options', THEME_ADMIN_TD),
            'header'  => __('Set the header options here', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Menu', THEME_ADMIN_TD),
                    'desc'    => __('Choose between standard bootstrap menu and hover menu', THEME_ADMIN_TD),
                    'id'      => 'menu',
                    'type'    => 'radio',
                    'options' => array(
                        'standard'  => __('Standard', THEME_ADMIN_TD),
                        'hover'     => __('Hover', THEME_ADMIN_TD),
                    ),
                    'default' => 'standard',
                ),
                array(
                    'name'    => __('Compact Menu', THEME_ADMIN_TD),
                    'desc'    => __('Choose compact menu style if you have a lot of menu items', THEME_ADMIN_TD),
                    'id'      => 'menu_compact',
                    'type'    => 'radio',
                    'options' => array(
                        ''  => __('Standard', THEME_ADMIN_TD),
                        'compact-nav'     => __('Compact', THEME_ADMIN_TD),
                    ),
                    'default' => '',
                ),
                array(
                    'name'      => __('Header Height', THEME_ADMIN_TD),
                    'desc'      => __('Set the height of the header in case you use a custom logo image', THEME_ADMIN_TD),
                    'id'        => 'header_height',
                    'type'      => 'slider',
                    'default'   => 85,
                    'attr'      => array(
                        'max'       => 300,
                        'min'       => 85,
                        'step'      => 1
                    )
                ),
                array(
                    'name'    => __('Header Style', THEME_ADMIN_TD),
                    'desc'    => __('Choose standard light theme or darker inverse theme', THEME_ADMIN_TD),
                    'id'      => 'header_style',
                    'type'    => 'radio',
                    'options' => array(
                        ''  => __('Standard', THEME_ADMIN_TD),
                        'navbar-inverse'     => __('Inverse', THEME_ADMIN_TD),
                    ),
                    'default' => '',
                ),
            )
        ),
        'footer-section' => array(
            'title'   => __('Footer', THEME_ADMIN_TD),
            'header'  => __('Configure the footer options here', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Footer Columns', THEME_ADMIN_TD),
                    'desc'    => __('Select how many columns will the footer consist of.', THEME_ADMIN_TD),
                    'id'      => 'footer_columns',
                    'type'    => 'radio',
                    'options' => array(
                        1  => __('1', THEME_ADMIN_TD),
                        2  => __('2', THEME_ADMIN_TD),
                        3  => __('3', THEME_ADMIN_TD),
                        4  => __('4', THEME_ADMIN_TD),
                    ),
                    'default' => 2,
                ),
            )
        ),
    )
);