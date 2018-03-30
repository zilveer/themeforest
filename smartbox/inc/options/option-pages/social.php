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
    'page_title' => THEME_NAME . ' - ' . __('Social Options', THEME_ADMIN_TD),
    'menu_title' => __('Social', THEME_ADMIN_TD),
    'slug'       => THEME_SHORT . '-social',
    'main_menu'  => false,
    'icon'       => 'tools',
    'menu_icon'  => ADMIN_ASSETS_URI . 'images/theme.png',
    'sections'   => array(
        'facebook-section' => array(
            'title'   => __('Facebook Like', THEME_ADMIN_TD),
            'header'  => __('Set the style of facebook like button', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Show Like Button', THEME_ADMIN_TD),
                    'desc'    => __('Show facebook like button on your single blog pages', THEME_ADMIN_TD),
                    'id'      => 'fb_show',
                    'type'    => 'radio',
                    'options' => array(
                        'show' => __('Show', THEME_ADMIN_TD),
                        'hide' => __('Hide', THEME_ADMIN_TD),
                    ),
                    'default' => 'show',
                ),
                array(
                    'name'    => __('Show Send Button', THEME_ADMIN_TD),
                    'desc'    => __('Choose a layout for your like button.', THEME_ADMIN_TD),
                    'id'      => 'fb_show_send',
                    'type'    => 'radio',
                    'options' => array(
                        'true'  => __('Show', THEME_ADMIN_TD),
                        'false' => __('Hide', THEME_ADMIN_TD),
                    ),
                    'default' => 'false',
                ),
                array(
                    'name'    => __('Layout', THEME_ADMIN_TD),
                    'desc'    => __('Include a Send button with the Like button.', THEME_ADMIN_TD),
                    'id'      => 'fb_layout',
                    'type'    => 'select',
                    'options' => array(
                        'standard'     => __('Standard', THEME_ADMIN_TD),
                        'button_count' => __('Button Count', THEME_ADMIN_TD),
                        'box_count'    => __('Box Count', THEME_ADMIN_TD)
                    ),
                    'default' => 'button_count',
                ),
                array(
                    'name'    => __('Show Faces', THEME_ADMIN_TD),
                    'desc'    => __('Display profile photos below the button (standard layout only)', THEME_ADMIN_TD),
                    'id'      => 'fb_show_faces',
                    'type'    => 'radio',
                    'options' => array(
                        'true'  => __('Show', THEME_ADMIN_TD),
                        'false' => __('Hide', THEME_ADMIN_TD),
                    ),
                    'default' => 'false',
                ),
                array(
                    'name'      => __('Width', THEME_ADMIN_TD),
                    'desc'      => __('Width of the Like button.', THEME_ADMIN_TD),
                    'id'        => 'fb_width',
                    'type'      => 'slider',
                    'default'   => 50,
                    'attr'      => array(
                        'max'       => 450,
                        'min'       => 50,
                        'step'      => 1
                    )
                ),
                array(
                    'name'    => __('Button Text', THEME_ADMIN_TD),
                    'desc'    => __('Verb to display on the button', THEME_ADMIN_TD),
                    'id'      => 'fb_action',
                    'type'    => 'radio',
                    'options' => array(
                        'like'  => __('Like', THEME_ADMIN_TD),
                        'recommend' => __('Recommend', THEME_ADMIN_TD),
                    ),
                    'default' => 'like',
                ),
                array(
                    'name'    => __('Button Font', THEME_ADMIN_TD),
                    'desc'    => __('Font to display in the button', THEME_ADMIN_TD),
                    'id'      => 'fb_font',
                    'type'    => 'select',
                    'options' => array(
                        'arial'         => __('Arial', THEME_ADMIN_TD),
                        'lucida grande' => __('Lucida Grande', THEME_ADMIN_TD),
                        'segoe ui'      => __('Segoe ui', THEME_ADMIN_TD),
                        'tahoma'        => __('Tahoma', THEME_ADMIN_TD),
                        'trebuchet ms'  => __('Trebuchet ms', THEME_ADMIN_TD),
                        'verdana'       => __('Verdana', THEME_ADMIN_TD),
                    ),
                    'default' => 'verdana',
                ),
                array(
                    'name'    => __('Button Colour', THEME_ADMIN_TD),
                    'desc'    => __('Color scheme for the like button.', THEME_ADMIN_TD),
                    'id'      => 'fb_colour',
                    'type'    => 'radio',
                    'options' => array(
                        'light'  => __('Light', THEME_ADMIN_TD),
                        'dark' => __('Dark', THEME_ADMIN_TD),
                    ),
                    'default' => 'light',
                ),
            )
        ),
        'twitter-section' => array(
            'title'   => __('Twitter', THEME_ADMIN_TD),
            'header'  => __('Set the style of twitter tweet button', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Show Tweet Button', THEME_ADMIN_TD),
                    'desc'    => __('Show tweet like button on your single blog pages', THEME_ADMIN_TD),
                    'id'      => 'twitter_show',
                    'type'    => 'radio',
                    'options' => array(
                        'show' => __('Show', THEME_ADMIN_TD),
                        'hide' => __('Hide', THEME_ADMIN_TD),
                    ),
                    'default' => 'show',
                ),
                array(
                    'name'    => __('Tweet Text', THEME_ADMIN_TD),
                    'desc'    => __('Default Tweet text. Leave blank to use page title.', THEME_ADMIN_TD),
                    'id'      => 'twitter_text',
                    'type'    => 'text',
                    'default' => __('Check out this great post', THEME_ADMIN_TD)
                ),
                array(
                    'name'    => __('Tweet Hashtags', THEME_ADMIN_TD),
                    'desc'    => __('Hashtags to include in tweet. (comma separated without the # symbol)', THEME_ADMIN_TD),
                    'id'      => 'twitter_hashtags',
                    'type'    => 'text',
                    'default' => ''
                ),
                array(
                    'name'    => __('Count Box Position', THEME_ADMIN_TD),
                    'desc'    => __('Choose where to show the tweet count box', THEME_ADMIN_TD),
                    'id'      => 'twitter_count_box',
                    'type'    => 'radio',
                    'options' => array(
                        'none'       => __('No Count Box', THEME_ADMIN_TD),
                        'horizontal' => __('Horizontal', THEME_ADMIN_TD),
                        'vertical'   => __('Vertical', THEME_ADMIN_TD)
                    ),
                    'default' => 'horizontal'
                ),
                array(
                    'name'    => __('Button Size', THEME_ADMIN_TD),
                    'desc'    => __('Choose a size for your tweet button', THEME_ADMIN_TD),
                    'id'      => 'twitter_size',
                    'type'    => 'radio',
                    'options' => array(
                        'medium'       => __('Medium', THEME_ADMIN_TD),
                        'large' => __('Large', THEME_ADMIN_TD)
                    ),
                    'default' => 'medium'
                ),
            )
        ),
        'google-section' => array(
            'title'   => __('Google +', THEME_ADMIN_TD),
            'header'  => __('Set the style of your google plus button', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Show Google+ Button', THEME_ADMIN_TD),
                    'desc'    => __('Show G+ button on your single blog pages', THEME_ADMIN_TD),
                    'id'      => 'google_show',
                    'type'    => 'radio',
                    'options' => array(
                        'show' => __('Show', THEME_ADMIN_TD),
                        'hide' => __('Hide', THEME_ADMIN_TD),
                    ),
                    'default' => 'show',
                ),
                array(
                    'name'    => __('Button Size', THEME_ADMIN_TD),
                    'desc'    => __('Size of google plus button', THEME_ADMIN_TD),
                    'id'      => 'google_size',
                    'type'    => 'select',
                    'options' => array(
                        'small'    => __('Small', THEME_ADMIN_TD),
                        'medium'   => __('Medium', THEME_ADMIN_TD),
                        'standard' => __('Standard', THEME_ADMIN_TD),
                        'tall'     => __('Tall', THEME_ADMIN_TD),
                    ),
                    'default' => 'medium',
                ),
                array(
                    'name'    => __('Button Bubble', THEME_ADMIN_TD),
                    'desc'    => __('Sets the annotation to display next to the button.', THEME_ADMIN_TD),
                    'id'      => 'google_annotation',
                    'type'    => 'radio',
                    'options' => array(
                        'none' => __('None', THEME_ADMIN_TD),
                        'bubble' => __('Bubble', THEME_ADMIN_TD),
                        'inline' => __('Inline', THEME_ADMIN_TD),
                    ),
                    'default' => 'bubble',
                ),
                array(
                    'name'    => __('Expand To', THEME_ADMIN_TD),
                    'desc'    => __('Sets the preferred positions to display hover and confirmation bubbles', THEME_ADMIN_TD),
                    'id'      => 'google_expand_to',
                    'type'    => 'select',
                    'options' => array(
                        'top'    => __('Top', THEME_ADMIN_TD),
                        'right'  => __('Right', THEME_ADMIN_TD),
                        'bottom' => __('Bottom', THEME_ADMIN_TD),
                        'left'   => __('Left', THEME_ADMIN_TD)
                    ),
                    'default' => 'bottom',
                ),
            )
        )
    )
);