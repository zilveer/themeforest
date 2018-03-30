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
            'fields' => array(
                array(
                    'name' => __('Show language as', THEME_ADMIN_TD),
                    'id' => 'display',
                    'type' => 'select',
                    'default' => 'name',
                    'options' => array(
                        'name'     => __('Name', THEME_ADMIN_TD),
                        'flag'     => __('Flag', THEME_ADMIN_TD),
                        'nameflag' => __('Name & Flag', THEME_ADMIN_TD)
                    )
                ),
                array(
                    'name' => __('Order languages by', THEME_ADMIN_TD),
                    'id' => 'order',
                    'type' => 'select',
                    'default' => 'id',
                    'options' => array(
                        'id'   => __('ID', THEME_ADMIN_TD),
                        'code' => __('Code', THEME_ADMIN_TD),
                        'name' => __('Name', THEME_ADMIN_TD)
                    ),
                ),
                array(
                    'name' => __('Order direction', THEME_ADMIN_TD),
                    'id' => 'orderby',
                    'type' => 'select',
                    'default' => 'id',
                    'options' => array(
                        'asc'   => __('Ascending', THEME_ADMIN_TD),
                        'desc' => __('Decending', THEME_ADMIN_TD),
                    ),
                ),
                array(
                    'name' => __('Skip Missing Languages', THEME_ADMIN_TD),
                    'id' => 'skip_missing',
                    'type' => 'select',
                    'default' => '1',
                    'options' => array(
                        '1' => __('Skip', THEME_ADMIN_TD),
                        '0' => __('Dont Skip', THEME_ADMIN_TD),
                    ),
                    'desc' => __('Skip languages with no translations.', THEME_ADMIN_TD)
                ),
            )//fields
        )//section
    )//sections
);//array

