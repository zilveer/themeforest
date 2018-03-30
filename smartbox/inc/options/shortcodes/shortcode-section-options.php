<?php
/**
 * Themes shortcode options go here
 *
 * @package Smartbox
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

  return array(
    'title' => __('Section options', THEME_ADMIN_TD),
    'fields' => array(
         array(
            'name'    => __('Section title', THEME_ADMIN_TD),
            'id'      => 'title',
            'type'    => 'text',
            'default' => '',
            'desc'    => __('Add a title to the section', THEME_ADMIN_TD),
        ),
        array(
            'name'    => __('Section style', THEME_ADMIN_TD),
            'desc'    => __('Choose a color for the section background', THEME_ADMIN_TD),
            'id'      => 'style',
            'type'    => 'radio',
            'default' => '',
            'options' => array(
                ''     => __('White', THEME_ADMIN_TD),
                'gray' => __('Gray', THEME_ADMIN_TD),
                'dark' => __('Dark', THEME_ADMIN_TD),
            ),
        ),
         array(
            'name'    => '',
            'id'      => 'content',
            'type'    => 'hiddentext',
            'default' => '',
            'desc'    => ''
        ),
         array(
            'name'    => __('Optional class', THEME_ADMIN_TD),
            'id'      => 'class',
            'type'    => 'text',
            'default' => '',
            'desc'    => __('Add an optional class to the section', THEME_ADMIN_TD),
        ),
        array(
            'name'    => __('Header Size', THEME_ADMIN_TD),
            'desc'    => __('Choose between h1 and h2 tags for your section header', THEME_ADMIN_TD),
            'id'      => 'header_size',
            'type'    => 'radio',
            'options' => array(
                'h1'    => __('H1', THEME_ADMIN_TD),
                'h2' => __('H2', THEME_ADMIN_TD),
                'h3' => __('H3', THEME_ADMIN_TD),
                'h4' => __('H4', THEME_ADMIN_TD),
            ),
            'default' => 'h1',
        ),
    )
);