<?php
/**
 * Sign up options
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
    'page_title' => THEME_NAME . ' - ' . __('Flexslider Options', THEME_ADMIN_TD),
    'menu_title' => __('Flexslider', THEME_ADMIN_TD),
    'slug'       => THEME_SHORT . '-flexslider',
    'main_menu'  => false,
    'menu_icon'  => ADMIN_ASSETS_URI . 'images/theme.png',
    'sections'      => array(
        'slider-section' => array(
            'title' => __('Slideshow', THEME_ADMIN_TD),
            'header'  => __('Setup your global default flexslider options.', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'      =>  __('Animation style', THEME_ADMIN_TD),
                    'desc'      =>  __('Select how your slider animates', THEME_ADMIN_TD),
                    'id'        => 'animation',
                    'type'      => 'select',
                    'options'   =>  array(
                        'slide' => __('Slide', THEME_ADMIN_TD),
                        'fade'  => __('Fade', THEME_ADMIN_TD),
                    ),
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                    'default'   => 'slide',
                ),
                array(
                    'name'      => __('Speed', THEME_ADMIN_TD),
                    'desc'      => __('Set the speed of the slideshow cycling, in milliseconds', THEME_ADMIN_TD),
                    'id'        => 'speed',
                    'type'      => 'slider',
                    'default'   => 7000,
                    'attr'      => array(
                        'max'       => 15000,
                        'min'       => 2000,
                        'step'      => 1000
                    )
                ),
                array(
                    'name'      => __('Duration', THEME_ADMIN_TD),
                    'desc'      => __('Set the speed of animations', THEME_ADMIN_TD),
                    'id'        => 'duration',
                    'type'      => 'slider',
                    'default'   => 600,
                    'attr'      => array(
                        'max'       => 1500,
                        'min'       => 200,
                        'step'      => 100
                    )
                ),
                array(
                    'name'      => __('Auto start', THEME_ADMIN_TD),
                    'id'        => 'autostart',
                    'type'      => 'radio',
                    'default'   =>  'true',
                    'desc'    => __('Start slideshow automatically', THEME_ADMIN_TD),
                    'options' => array(
                        'true'  => __('On', THEME_ADMIN_TD),
                        'false' => __('Off', THEME_ADMIN_TD),
                    ),
                ),
                array(
                    'name'      => __('Show navigation arrows', THEME_ADMIN_TD),
                    'id'        => 'directionnav',
                    'type'      => 'radio',
                    'desc'    => __('If you choose hide ,the option below will be ignored', THEME_ADMIN_TD),
                    'default'   =>  'hide',
                    'options' => array(
                        'hide' => __('Hide', THEME_ADMIN_TD),
                        'show' => __('Show', THEME_ADMIN_TD),
                    ),
                ),
                array(
                    'name'      => __('Navigation arrows position', THEME_ADMIN_TD),
                    'id'        => 'directionnavpos',
                    'type'      => 'radio',
                    'default'   =>  'outside',
                    'desc'    => __('Choose the position of the navigation arrows', THEME_ADMIN_TD),
                    'options' => array(
                        'inside'  => __('Inside', THEME_ADMIN_TD),
                        'outside' => __('Outside', THEME_ADMIN_TD),
                    ),
                ),
                array(
                    'name'      => __('Show controls', THEME_ADMIN_TD),
                    'id'        => 'showcontrols',
                    'type'      => 'radio',
                    'default'   =>  'show',
                    'desc'    => __('If you choose hide the option below will be ignored', THEME_ADMIN_TD),
                    'options' => array(
                        'hide' => __('Hide', THEME_ADMIN_TD),
                        'show' => __('Show', THEME_ADMIN_TD),
                    ),
                ),
                array(
                    'name'      => __('Choose the place of the controls', THEME_ADMIN_TD),
                    'id'        => 'controlsposition',
                    'type'      => 'radio',
                    'default'   =>  'inside',
                    'desc'    => __('Choose the position of the navigation controls', THEME_ADMIN_TD),
                    'options' => array(
                        'inside'    => __('Inside', THEME_ADMIN_TD),
                        'outside'   => __('Outside', THEME_ADMIN_TD),
                    ),
                ),
            )
        ),
        'captions-section' => array(
            'title' => __('Captions', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'      => __('Show Captions', THEME_ADMIN_TD),
                    'id'        => 'captions',
                    'type'      => 'radio',
                    'default'   =>  'show',
                    'desc'    => __('If you choose hide the options below will be ignored', THEME_ADMIN_TD),
                    'options' => array(
                        'hide' => __('Hide', THEME_ADMIN_TD),
                        'show' => __('Show', THEME_ADMIN_TD),
                        ),
                ),
                array(
                    'name'      => __('Captions Size', THEME_ADMIN_TD),
                    'id'        => 'captionsize',
                    'type'      => 'radio',
                    'default'   =>  'super',
                    'desc'    => __('Set the caption size', THEME_ADMIN_TD),
                    'options' => array(
                        'super' => __('Big', THEME_ADMIN_TD),
                        'small' => __('Small', THEME_ADMIN_TD),
                        ),
                ),
                array(
                    'name'      => __('Captions Animation', THEME_ADMIN_TD),
                    'id'        => 'captionanimation',
                    'type'      => 'radio',
                    'default'   =>  'animated',
                    'desc'    => __('Choose if the captions will be animated', THEME_ADMIN_TD),
                    'options' => array(
                        'animated' => __('Animated', THEME_ADMIN_TD),
                        'static' => __('Static', THEME_ADMIN_TD),
                        ),
                ),
            )
        ),
    )
);