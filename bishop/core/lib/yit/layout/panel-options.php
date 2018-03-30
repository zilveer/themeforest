<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


return array(

    'header'          => array(
        'label'  => __( 'Header', 'yit' ),
        'fields' => array(
            'static_image'           => array(
                'label' => __( 'Use static image', 'yit' ),
                'desc'  => __( 'Set YES if you want a static header, instead of the slider.', 'yit' ),
                'type'  => 'onoff',
                'std'   => 'no'
            ),
            'image_upload'           => array(
                'label' => __( 'Static image', 'yit' ),
                'desc'  => __( 'Upload here the image to use for the static header, only if you have set to YES the option above.', 'yit' ),
                'type'  => 'upload',
                'std'   => '',
                'deps'  => array(
                    'ids'    => 'static_image',
                    'values' => 'yes'
                )
            ),
            'image_link'             => array(
                'label' => __( 'Static image link', 'yit' ),
                'desc'  => __( 'The URL where the fixed image will link.', 'yit' ),
                'type'  => 'text',
                'std'   => '',
                'deps'  => array(
                    'ids'    => 'static_image',
                    'values' => 'yes'
                )
            ),
            'image_target'           => array(
                'label'   => __( 'Static image target', 'yit' ),
                'desc'    => __( 'How to open the link of the static image.', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'default'  => __( 'Default', 'yit' ),
                    'frameset' => __( 'Parent frameset', 'yit' ),
                    'full'     => __( 'Full body of the window', 'yit' ),
                    'new'      => __( 'In a new window', 'yit' )
                ),
                'std'     => 'default',
                'deps'    => array(
                    'ids'    => 'static_image',
                    'values' => 'yes'
                )
            ),
            'sep'                    => array(
                'type' => 'sep'
            ),
            'parallax'               => array(
                'label' => __( 'Enable parallax effect', 'yit' ),
                'desc'  => __( 'Enable Parallax Effect in the header image.', 'yit' ),
                'type'  => 'onoff',
                'std'   => 'no'
            ),
            'parallax_height'                 => array(
                'label' => __( 'Container height', 'yit' ),
                'desc'  => '',
                'type'  => 'number',
                'std'   => '300',
                'min'   => '0',
                'max'   => '1000',
                'deps'  => array(
                    'ids'    => 'parallax',
                    'values' => 'yes'
                )
            ),
            'parallax_content'  => array(
                'label' => __( 'Content', 'yit' ),
                'desc'  => '',
                'type'  => 'textarea',
                'std'   => '',
                'deps'  => array(
                    'ids'    => 'parallax',
                    'values' => 'yes'
                )
            ),
            'parallax_vertical_align'         => array(
                'label'   => __( 'Vertical align', 'yit' ),
                'desc'    => '',
                'type'    => 'select',
                'options' => array(
                    'center' => __( 'Center', 'yit' ),
                    'top'    => __( 'Top', 'yit' ),
                    'bottom' => __( 'Bottom', 'yit' )
                ),
                'std'     => 'center',
                'deps'    => array(
                    'ids'    => 'parallax',
                    'values' => 'yes'
                )
            ),
            'parallax_horizontal_align'       => array(
                'label'   => __( 'Horizontal align', 'yit' ),
                'desc'    => '',
                'type'    => 'select',
                'options' => array(
                    'center' => __( 'Center', 'yit' ),
                    'left'   => __( 'Left', 'yit' ),
                    'right'  => __( 'Right', 'yit' )
                ),
                'std'     => 'center',
                'deps'    => array(
                    'ids'    => 'parallax',
                    'values' => 'yes'
                )
            ),
            'parallax_text_color'             => array(
                'label' => __( 'Content text color', 'yit' ),
                'desc'  => '',
                'type'  => 'colorpicker',
                'std'   => '#ffffff',
                'deps'  => array(
                    'ids'    => 'parallax',
                    'values' => 'yes'
                )
            ),
            'parallax_effect'                 => array(
                'label'   => __( 'Effect', 'yit' ),
                'desc'    => '',
                'type'    => 'select',
                'options' => array(
                    'fadeIn'            => 'fadeIn',
                    'fadeInUp'          => 'fadeInUp',
                    'fadeInDown'        => 'fadeInDown',
                    'fadeInLeft'        => 'fadeInLeft',
                    'fadeInRight'       => 'fadeInRight',
                    'fadeInUpBig'       => 'fadeInUpBig',
                    'fadeInDownBig'     => 'fadeInDownBig',
                    'fadeInLeftBig'     => 'fadeInLeftBig',
                    'fadeInRightBig'    => 'fadeInRightBig',
                    'bounceIn'          => 'bounceIn',
                    'bounceInDown'      => 'bounceInDown',
                    'bounceInUp'        => 'bounceInUp',
                    'bounceInLeft'      => 'bounceInLeft',
                    'bounceInRight'     => 'bounceInRight',
                    'rotateIn'          => 'rotateIn',
                    'rotateInDownLeft'  => 'rotateInDownLeft',
                    'rotateInDownRight' => 'rotateInDownRight',
                    'rotateInUpLeft'    => 'rotateInUpLeft',
                    'rotateInUpRight'   => 'rotateInUpRight',
                    'lightSpeedIn'      => 'lightSpeedIn',
                    'hinge'             => 'hinge',
                    'rollIn'            => 'rollIn',
                ),
                'std'     => 'fadeIn',
                'deps'    => array(
                    'ids'    => 'parallax',
                    'values' => 'yes'
                )
            ),
            'parallax_overlay_opacity' => array(
                'label'       => __( 'Overlay', 'yit' ),
                'desc' => __( 'Set an opacity of overlay (0-100)', 'yit' ),
                'type'        => 'number',
                'std'   => '20',
                'min'   => '0',
                'max'   => '100',
                'deps'    => array(
                    'ids'    => 'parallax',
                    'values' => 'yes'
                )
            ),
            'sep1'                   => array(
                'type' => 'sep'
            ),
            'custom_background'      => array(
                'label' => __( 'Enable custom header background', 'yit' ),
                'desc'  => __( 'Set YES if you want to customize the header background.', 'yit' ),
                'type'  => 'onoff',
                'std'   => 'no'
            ),
            'header_bg_color'       => array(
                'label' => __( 'Header background color', 'yit' ),
                'desc'  => __( 'Select a background color for the header', 'yit' ),
                'type'  => 'colorpicker',
                'std'   => '#ffffff',
                'deps'  => array(
                    'ids'    => 'custom_background',
                    'values' => 'yes'
                )
            ),
            'header_bg_image'       => array(
                'label' => __( 'Header background image', 'yit' ),
                'desc'  => __( 'Select a background image for the header.', 'yit' ),
                'type'  => 'upload',
                'std'   => '',
                'deps'  => array(
                    'ids'    => 'custom_background',
                    'values' => 'yes'
                )
            ),
            'header_bg_repeat'  => array(
                'label'   => __( 'Background repeat', 'yit' ),
                'desc'    => __( 'Select the repeat mode for the background image.', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'default'   => __( 'Default', 'yit' ),
                    'repeat'    => __( 'Repeat', 'yit' ),
                    'repeat-x'  => __( 'Repeat Horizontally', 'yit' ),
                    'repeat-y'  => __( 'Repeat Vertically', 'yit' ),
                    'no-repeat' => __( 'No Repeat', 'yit' ),
                ),
                'std'     => 'default',
                'deps'    => array(
                    'ids'    => 'custom_background',
                    'values' => 'yes'
                )
            ),
            'header_bg_position'   => array(
                'label'   => __( 'Background position', 'yit' ),
                'desc'    => __( 'Select the position for the background image.', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'default'       => __( 'Default', 'yit' ),
                    'center'        => __( 'Center', 'yit' ),
                    'top left'      => __( 'Top left', 'yit' ),
                    'top center'    => __( 'Top center', 'yit' ),
                    'top right'     => __( 'Top right', 'yit' ),
                    'bottom left'   => __( 'Bottom left', 'yit' ),
                    'bottom center' => __( 'Bottom center', 'yit' ),
                    'bottom right'  => __( 'Bottom right', 'yit' ),
                ),
                'std'     => 'default',
                'deps'    => array(
                    'ids'    => 'custom_background',
                    'values' => 'yes'
                )
            ),
            'header_bg_attachament' => array(
                'label'   => __( 'Background attachment', 'yit' ),
                'desc'    => __( 'Select the attachment for the background image.', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'default' => __( 'Default', 'yit' ),
                    'scroll'  => __( 'Scroll', 'yit' ),
                    'fixed'   => __( 'Fixed', 'yit' ),
                ),
                'std'     => 'default',
                'deps'    => array(
                    'ids'    => 'custom_background',
                    'values' => 'yes'
                )
            ),

        ),
    ),

    'setting'         => array(
        'label'  => __( 'Page Settings', 'yit' ),
        'fields' => array(

            'show_title'      => array(
                'label' => __( 'Show Title', 'yit' ),
                'desc'  => __( 'Show or not the title of the page', 'yit' ),
                'type'  => 'checkbox',
                'post_types' => array( 'page' ),
                'std'   => '1'
            ),
            'sep'             => array(
                'type' => 'sep'
            ),
            'show_breadcrumb' => array(
                'label' => __( 'Show Breadcrumb', 'yit' ),
                'desc'  => __( 'Show or not the breadcumb', 'yit' ),
                'type'  => 'checkbox',
                'std'   => ''
            ),
            'sep1'            => array(
                'type' => 'sep'
            ),
            'show_slogan'               => array(
                'label' => __( 'Show Slogan', 'yit' ),
                'desc'  => __( 'Enable Slogan in the header', 'yit' ),
                'type'  => 'onoff',
                'std'   => 'no'
            ),
            'slogan'          => array(
                'label' => __( 'Slogan', 'yit' ),
                'desc'  => __( 'Show a slogan before the page content', 'yit' ),
                'type'  => 'text',
                'std'   => '',
                'deps'    => array(
                    'ids'    => 'show_slogan',
                    'values' => 'yes'
                )
            ),

            'sub_slogan'      => array(
                'label' => __( 'Sub Slogan', 'yit' ),
                'desc'  => __( 'Show a sub slogan before the page content', 'yit' ),
                'type'  => 'text',
                'std'   => '',
                'deps'    => array(
                    'ids'    => 'show_slogan',
                    'values' => 'yes'
                )
            ),
            'sep3'            => array(
                'type' => 'sep'
            )

        )
    ),

    'body_background' => array(
        'label'  => __( 'Body Background', 'yit' ),
        'fields' => array(
            'body_bg_color'      => array(
                'label' => __( 'Background color', 'yit' ),
                'desc'  => __( 'Select the background color of the body (leave empty to use default, defined in Theme Options -> Colors -> General).', 'yit' ),
                'type'  => 'colorpicker',
                'std'   => '',
            ),
            'sep'                   => array(
                'type' => 'sep'
            ),
            'body_bg_image'      => array(
                'label' => __( 'Background image', 'yit' ),
                'desc'  => __( 'Select the background image (leave empty to use default, defined in Theme Options -> Colors -> General).', 'yit' ),
                'type'  => 'upload',
                'std'   => '',
            ),
            'body_bg_repeat'     => array(
                'label'   => __( 'Background repeat', 'yit' ),
                'desc'    => __( 'Select the repeat mode for the background image (default is defined in Theme Options -> Colors -> General).', 'yit' ),
                'type'    => 'select',
                'std'     => 'default',
                'options' => array(
                    'default'   => __( 'Default', 'yit' ),
                    'repeat'    => __( 'Repeat', 'yit' ),
                    'repeat-x'  => __( 'Repeat Horizontally', 'yit' ),
                    'repeat-y'  => __( 'Repeat Vertically', 'yit' ),
                    'no-repeat' => __( 'No Repeat', 'yit' ),
                )
            ),
            'body_bg_attachment' => array(
                'label'   => __( 'Background attachment', 'yit' ),
                'desc'    => __( 'Select the attachment for the background image (default is defined in Theme Options -> Colors -> General).', 'yit' ),
                'type'    => 'select',
                'std'     => 'default',
                'options' => array(
                    'default' => __( 'Default', 'yit' ),
                    'scroll'  => __( 'Scroll', 'yit' ),
                    'fixed'   => __( 'Fixed', 'yit' ),
                )
            ),
            'body_bg_position'   => array(
                'label'   => __( 'Background position', 'yit' ),
                'desc'    => __( 'Select the position for the background image (default is defined in Theme Options -> Colors -> General).', 'yit' ),
                'type'    => 'select',
                'std'     => 'default',
                'options' => array(
                    'default'       => __( 'Default', 'yit' ),
                    'center'        => __( 'Center', 'yit' ),
                    'top left'      => __( 'Top left', 'yit' ),
                    'top center'    => __( 'Top center', 'yit' ),
                    'top right'     => __( 'Top right', 'yit' ),
                    'bottom left'   => __( 'Bottom left', 'yit' ),
                    'bottom center' => __( 'Bottom center', 'yit' ),
                    'bottom right'  => __( 'Bottom right', 'yit' ),
                )
            ),
            'sep1'               => array(
                'type' => 'sep'
            ),
            'wrapper_bg_color'   => array(
                'label' => __( 'Container background color for boxed layout', 'yit' ),
                'desc'  => __( 'Select the background color of the container for boxed layout (leave empty to use default, defined in Theme Options -> Colors -> General).', 'yit' ),
                'type'  => 'colorpicker',
                'std'   => '',
            ),
        )

    ),

    'layout'          => array(
        'label'  => __( 'Layout', 'yit' ),
        'fields' => array(
            'sidebars' => array(
                'label' => __( 'Sidebars', 'yit' ),
                'desc'  => 'Select the slider that you want to use in the page.',
                'type'  => 'sidebars',
                'std'   => null
            )
        )

    ),

    'google_map'      => array(
        'label'  => __( 'Google Map', 'yit' ),
        'fields' => array(
            'gmap_url' => array(
                'label' => __( 'URL', 'yit' ),
                'desc'  => __( 'Google map url', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            )
        )
    )

);