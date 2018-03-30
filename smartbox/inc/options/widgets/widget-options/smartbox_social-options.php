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

$options = array(
    'sections'   => array(
        'social-section' => array(
            'fields' => array()
        )
    )
);

$options['sections']['social-section']['fields'][] =  array(
        'name' => __('Open links in new window', THEME_ADMIN_TD),
        'id' => 'social_window',
        'type' => 'checkbox',
        'default' => 'on'
    );

for( $i = 0 ; $i < 10 ; $i++ ) {
    $options['sections']['social-section']['fields'][] = array(
        'name'    => sprintf( __('Social %s Icon', THEME_ADMIN_TD), $i+1 ),
        'id'      => 'social' . $i . '_icon',
        'type'    => 'select',
        'options' => 'social_icons',
        'default' => '',
        'blank'   => __('Choose a social network icon', THEME_ADMIN_TD),
        'attr'    =>  array(
            'class'    => 'widefat',
        ),
    );
    $options['sections']['social-section']['fields'][] = array(
        'name'    => sprintf( __('Social %s URL ', THEME_ADMIN_TD), $i+1 ),
        'id'      => 'social' . $i . '_url',
        'type'    => 'text',
        'default' => '',
        'attr'    =>  array(
            'class'    => 'widefat',
        ),
    );
}

return $options;