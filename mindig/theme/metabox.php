<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}

function yit_add_theme_metaboxes() {
    if ( ! function_exists( 'YIT_Metabox' ) ) {
        return;
    }
    //Add Metabox to pages
    $args1 = array( 'id'       => 'yit-page-setting',
                'label'    => __( 'Page settings', 'yit' ),
                'pages'    => 'page',
                'context'  => 'normal', //('normal', 'advanced', or 'side')
                'priority' => 'high',
                'tabs'     => array(
                    'settings'        => array( //tab
                        'label'  => __( 'Settings', 'yit' ),
                        'fields' => array(
                            'active_page_options' => array(
                                'label' => __( 'Active Page Options', 'yit' ),
                                'desc'    => '',
                                'type'  => 'checkbox',
                                'std'   => '0'
                            ),
                            'show_title'          => array(
                                'label' => __( 'Show Title', 'yit' ),
                                'desc'  => __( 'Show or not the title of the page', 'yit' ),
                                'type'  => 'checkbox',
                                'std'   => ''
                            ),
                            'sep'                 => array(
                                'type' => 'sep'
                            ),
                            'show_breadcrumb'     => array(
                                'label' => __( 'Show Breadcrumb', 'yit' ),
                                'desc'  => __( 'Show or not the breadcumb', 'yit' ),
                                'type'  => 'checkbox',
                                'std'   => ''
                            ),
                            'sep1'                => array(
                                'type' => 'sep'
                            ),
                            'show_slogan' => array(
                                'label' => __( 'Show Slogan', 'yit' ),
                                'desc'  => __( 'Enable Slogan in the header', 'yit' ),
                                'type'  => 'onoff',
                                'std'   => 'no'
                            ),
                            'slogan'              => array(
                                'label' => __( 'Slogan', 'yit' ),
                                'desc'  => __( 'Show a slogan before the page content', 'yit' ),
                                'type'  => 'text',
                                'std'   => '',
                                'deps'  => array(
                                    'ids'    => '_show_slogan',
                                    'values' => 'yes'
                                )
                            ),
                            'slogan_color'       => array(
                                'label' => __( 'Slogan color', 'yit' ),
                                'desc'  => __( 'Select a color for the slogan', 'yit' ),
                                'type'  => 'colorpicker',
                                'std'   => '#313131',
                                'deps'  => array(
                                    'ids'    => '_show_slogan',
                                    'values' => 'yes'
                                )
                            ),

                            'sub_slogan' => array(
                                'label' => __( 'Sub Slogan', 'yit' ),
                                'desc'  => __( 'Show a sub slogan before the page content', 'yit' ),
                                'type'  => 'text',
                                'std'   => '',
                                'deps'  => array(
                                    'ids'    => '_show_slogan',
                                    'values' => 'yes'
                                )
                            ),

                            'subslogan_color'       => array(
                                'label' => __( 'Subslogan color', 'yit' ),
                                'desc'  => __( 'Select a color for the sublogan', 'yit' ),
                                'type'  => 'colorpicker',
                                'std'   => '#dda213',
                                'deps'  => array(
                                    'ids'    => '_show_slogan',
                                    'values' => 'yes'
                                )
                            ),

                            'slogan_image_background'      => array(
                                'label' => __( 'Enable slogan background', 'yit' ),
                                'desc'  => __( 'Set YES if you want to customize the background of slogan', 'yit' ),
                                'type'  => 'onoff',
                                'std'   => 'no',
                                'deps'  => array(
                                    'ids'    => '_show_slogan',
                                    'values' => 'yes'
                                )
                            ),
                            'slogan_image_height'         => array(
                                'label' => __( 'Slogan height', 'yit' ),
                                'desc'  =>__( 'Set 0 for auto height', 'yit' ),
                                'type'  => 'number',
                                'std'   => '0',
                                'min'   => '0',
                                'max'   => '1000',
                                'deps'  => array(
                                    'ids'    => '_show_slogan',
                                    'values' => 'yes'
                                )
                            ),
                            'slogan_bg_color'       => array(
                                'label' => __( 'Slogan background color', 'yit' ),
                                'desc'  => __( 'Select a background color for the slogan', 'yit' ),
                                'type'  => 'colorpicker',
                                'std'   => '#ffffff',
                                'deps'  => array(
                                    'ids'    => '_show_slogan',
                                    'values' => 'yes'
                                )
                            ),
                            'slogan_bg_image'       => array(
                                'label' => __( 'Slogan background image', 'yit' ),
                                'desc'  => __( 'Select a background image for the slogan.', 'yit' ),
                                'type'  => 'upload',
                                'std'   => '',
                                'deps'  => array(
                                    'ids'    => '_show_slogan',
                                    'values' => 'yes'
                                )
                            ),
                            'slogan_bg_repeat'                 => array(
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
                                'deps'  => array(
                                    'ids'    => '_show_slogan',
                                    'values' => 'yes'
                                )
                            ),
                            'slogan_bg_position'               => array(
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
                                'deps'  => array(
                                    'ids'    => '_show_slogan',
                                    'values' => 'yes'
                                )
                            ),
                            'slogan_bg_attachment' => array(
                                'label'   => __( 'Background attachment', 'yit' ),
                                'desc'    => __( 'Select the attachment for the background image.', 'yit' ),
                                'type'    => 'select',
                                'options' => array(
                                    'default' => __( 'Default', 'yit' ),
                                    'scroll'  => __( 'Scroll', 'yit' ),
                                    'fixed'   => __( 'Fixed', 'yit' ),
                                ),
                                'std'     => 'default',
                                'deps'  => array(
                                    'ids'    => '_show_slogan',
                                    'values' => 'yes'
                                )
                            ),


                            'sep3'                => array(
                                'type' => 'sep'
                            ),
                            'sidebars'             => array(
                                'label' => __( 'Sidebar', 'yit' ),
                                'type'  => 'sidebars',
                                'std'   => array( 'layout' => 'sidebar-no')
                            ),
                        ),
                    ),
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
                                    'ids'    => '_static_image',
                                    'values' => 'yes'
                                )
                            ),
                            'image_link'             => array(
                                'label' => __( 'Static image link', 'yit' ),
                                'desc'  => __( 'The URL where the fixed image will link.', 'yit' ),
                                'type'  => 'text',
                                'std'   => '',
                                'deps'  => array(
                                    'ids'    => '_static_image',
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
                                    'ids'    => '_static_image',
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
                                    'ids'    => '_parallax',
                                    'values' => 'yes'
                                )
                            ),
                            'parallax_content'                => array(
                                'label' => __( 'Content', 'yit' ),
                                'desc'  => '',
                                'type'  => 'textarea',
                                'std'   => '',
                                'deps'  => array(
                                    'ids'    => '_parallax',
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
                                    'ids'    => '_parallax',
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
                                    'ids'    => '_parallax',
                                    'values' => 'yes'
                                )
                            ),
                            'parallax_text_color'             => array(
                                'label' => __( 'Content text color', 'yit' ),
                                'desc'  => '',
                                'type'  => 'colorpicker',
                                'std'   => '#ffffff',
                                'deps'  => array(
                                    'ids'    => '_parallax',
                                    'values' => 'yes'
                                )
                            ),

                            'parallax_effect'                 => array(
                                'label'   => __( 'Effect', 'yit' ),
                                'desc'    => '',
                                'type'    => 'select',
                                'options' => array(
                                    'fadeIn'            => __( 'fadeIn', 'yit' ),
                                    'fadeInUp'          => __( 'fadeInUp', 'yit' ),
                                    'fadeInDown'        => __( 'fadeInDown', 'yit' ),
                                    'fadeInLeft'        => __( 'fadeInLeft', 'yit' ),
                                    'fadeInRight'       => __( 'fadeInRight', 'yit' ),
                                    'fadeInUpBig'       => __( 'fadeInUpBig', 'yit' ),
                                    'fadeInDownBig'     => __( 'fadeInDownBig', 'yit' ),
                                    'fadeInLeftBig'     => __( 'fadeInLeftBig', 'yit' ),
                                    'fadeInRightBig'    => __( 'fadeInRightBig', 'yit' ),
                                    'bounceIn'          => __( 'bounceIn', 'yit' ),
                                    'bounceInDown'      => __( 'bounceInDown', 'yit' ),
                                    'bounceInUp'        => __( 'bounceInUp', 'yit' ),
                                    'bounceInLeft'      => __( 'bounceInLeft', 'yit' ),
                                    'bounceInRight'     => __( 'bounceInRight', 'yit' ),
                                    'rotateIn'          => __( 'rotateIn', 'yit' ),
                                    'rotateInDownLeft'  => __( 'rotateInDownLeft', 'yit' ),
                                    'rotateInDownRight' => __( 'rotateInDownRight', 'yit' ),
                                    'rotateInUpLeft'    => __( 'rotateInUpLeft', 'yit' ),
                                    'rotateInUpRight'   => __( 'rotateInUpRight', 'yit' ),
                                    'lightSpeedIn'      => __( 'lightSpeedIn', 'yit' ),
                                    'hinge'             => __( 'hinge', 'yit' ),
                                    'rollIn'            => __( 'rollIn', 'yit' ),
                                ),
                                'std'     => 'fadeIn',
                                'deps'    => array(
                                    'ids'    => '_parallax',
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
                                    'ids'    => '_parallax',
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
                                    'ids'    => '_custom_background',
                                    'values' => 'yes'
                                )
                            ),
                            'header_bg_image'       => array(
                                'label' => __( 'Header background image', 'yit' ),
                                'desc'  => __( 'Select a background image for the header.', 'yit' ),
                                'type'  => 'upload',
                                'std'   => '',
                                'deps'  => array(
                                    'ids'    => '_custom_background',
                                    'values' => 'yes'
                                )
                            ),
                            'header_bg_repeat'                 => array(
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
                                    'ids'    => '_custom_background',
                                    'values' => 'yes'
                                )
                            ),
                            'header_bg_position'               => array(
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
                                    'ids'    => '_custom_background',
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
                                    'ids'    => '_custom_background',
                                    'values' => 'yes'
                                )
                            )
                        ),
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
                            'sep1'                  => array(
                                'type' => 'sep'
                            ),
                            'wrapper_bg_color'      => array(
                                'label' => __( 'Container background color for boxed layout', 'yit' ),
                                'desc'  => __( 'Select the background color of the container for boxed layout (leave empty to use default, defined in Theme Options -> Colors -> General).', 'yit' ),
                                'type'  => 'colorpicker',
                                'std'   => '',
                            ),
                        )
                    ),
                    'google_map'      => array(
                        'label'  => __( 'Google Map', 'yit' ),
                        'fields' => array(
                            'url' => array(
                                'label' => __( 'URL', 'yit' ),
                                'desc'  => __( 'Google map url', 'yit' ),
                                'type'  => 'text',
                                'std'   => ''
                            ),
                            'sep' => array(
                            'type' => 'sep'
                            ),
                            'google_map_show_overlay_box' => array(
                                'label' => __( 'Show Overlay Info Box', 'yit' ),
                                'desc'  => __( 'set the adress for the info box', 'yit' ),
                                'type'  => 'onoff',
                                'std'   => 'no'
                            ),
                            'google_map_overlay_logo'  => array(
                                'label' => __( 'Logo', 'yit' ),
                                'desc'  => __( 'upload a image for the logo', 'yit' ),
                                'type'  => 'upload',
                                'std'   => '',
                                'deps'  => array(
                                    'ids'    => '_google_map_show_overlay_box',
                                    'values' => 'yes'
                                )
                            ),
                            'google_map_overlay_address'  => array(
                                'label' => __( 'Address', 'yit' ),
                                'desc'  => __( 'set the adress for the info box', 'yit' ),
                                'type'  => 'text',
                                'std'   => '',
                                'deps'  => array(
                                    'ids'    => '_google_map_show_overlay_box',
                                    'values' => 'yes'
                                )
                            ),
                            'google_map_overlay_info'  => array(
                                'label' => __( 'Info', 'yit' ),
                                'desc'  => __( 'set info for the box', 'yit' ),
                                'type'  => 'textarea',
                                'std'   => '',
                                'deps'  => array(
                                    'ids'    => '_google_map_show_overlay_box',
                                    'values' => 'yes'
                                )
                            )
                        )
                    )
                )
);

$metabox1 = YIT_Metabox( 'yit-page-setting' );
$metabox1->init( $args1 );

//Add Metabox to post
$args2 = array( 'id'       => 'yit-post-setting',
                'label'    => __( 'Post settings', 'yit' ),
                'pages'    => 'post',
                'context'  => 'normal', //('normal', 'advanced', or 'side')
                'priority' => 'high',
                'tabs'     => array(
                    'settings' => array( //tab
                        'label'  => __( 'Settings', 'yit' ),
                        'fields' => array(
                            'active_page_options' => array(
                                'label' => __( 'Active Page Options', 'yit' ),
                                'desc'  => '',
                                'type'  => 'checkbox',
                                'std'   => '0'
                            ),
                            'sidebars' => array(
                                'label' => __( 'Sidebar', 'yit' ),
                                'type'  => 'sidebars',
                                'std'   => ''
                            )
                        )
                    ),
                    'post-formats' => array(
                        'label' => __( 'Post Formats', 'yit' ),
                        'fields' => array(
                            'audio-url' => array(
                                'label' => __( 'Audio URL', 'yit' ),
                                'desc'  => __( 'Insert the <a target="_blank" href="http://soundcloud.com/">SoundCloud.com</a> song URL.', 'yit' ),
                                'type'  => 'text',
                                'std'   => ''
                            ),
                            'audio-iframe' => array(
                                'label' => __( 'Use iFrame', 'yit' ),
                                'desc'  => __( 'Use iFrame instead of Flash.', 'yit' ),
                                'type'  => 'onoff',
                                'std'   => 'no'
                            ),
                            'audio-comments' => array(
                                'label' => __( 'Show Comments', 'yit' ),
                                'desc'  => __( 'Show comments of the song.', 'yit' ),
                                'type'  => 'onoff',
                                'std'   => 'no',
                                'deps'  => array(
                                    'ids'       => '_audio-iframe',
                                    'values'    => 'yes'
                                )
                            ),
                            'audio-color' => array(
                                'label' => __( 'Color', 'yit' ),
                                'desc' => __( 'Template color.', 'yit' ),
                                'type' => 'colorpicker',
                                'std' => '#fab000',
                                'deps'  => array(
                                    'ids'       => '_audio-iframe',
                                    'values'    => 'no'
                                )
                            ),
                            'sep1' => array(
                                'type' => 'sep'
                            ),
                            'video-id' => array(
                                'label' => __( 'Video ID', 'yit' ),
                                'desc' => __( 'Insert the video ID.', 'yit' ),
                                'type' => 'text',
                                'std' => ''
                            ),
                            'video-host' => array(
                                'label' => __( 'Video host', 'yit' ),
                                'desc' => __( 'Select where is the video hosted.', 'yit' ),
                                'type' => 'select',
                                'options' => array(
                                    'youtube' => __( 'Youtube', 'yit' ),
                                    'vimeo' => __( 'Vimeo', 'yit' )
                                ),
                                'std' => ''
                            )
                        )
                    ),

                )
);

$metabox2 = YIT_Metabox( 'yit-post-setting' );
$metabox2->init( $args2 );


$args3 = array( 'id'       => 'yit-product-setting',
                'label'    => __( 'Product Page Settings', 'yit' ),
                'pages'    => 'product',
                'context'  => 'normal', //('normal', 'advanced', or 'side')
                'priority' => 'high',
                'tabs'     => array(
                    'settings' => array( //tab
                        'label'  => __( 'Tabs', 'yit' ),
                        'fields' => array(
                            'modal_window' => array(
                                'label' => __( 'Show modal window', 'yit' ),
                                'desc' => __( 'Set YES if you want a modal window link in your product', 'yit' ),
                                'type' => 'onoff',
                                'std' => 'no'
                            ),
                            'modal_window_text' => array(
                                'label' => __( 'Modal window link text', 'yit' ),
                                'desc' => __( 'Set the modal window link text', 'yit' ),
                                'type' => 'text',
                                'std' => __( 'VIEW MODAL WINDOW', 'yit' ),
                                'deps' => array(
                                    'ids' => '_modal_window',
                                    'values' => 'yes'
                                )
                            ),
                            'modal_window_icon' => array(
                                'label'    => __( 'Modal window link icon', 'yit' ),
                                'desc'    => __( 'Select the icon for modal window. Note: Custom icon size will be scaled to 25x25', 'yit' ),
                                'type'    => 'select-icon',
                                'options' => array(
                                    'select' => array(
                                        'icon'   => __( 'Theme Icon', 'yit' ),
                                        'custom' => __( 'Custom Icon', 'yit' ),
                                        'none'   => __( 'None', 'yit' )
                                    ),
                                    'icon'   => YIT_Plugin_Common::get_awesome_icons(),
                                ),
                                'std'     => array(
                                    'select' => 'icon',
                                    'icon'   => '',
                                    'custom' => ''
                                ),
                                'deps' => array(
                                    'ids' => '_modal_window',
                                    'values' => 'yes'
                                )
                            ),
                            'modal_window_title' => array(
                                'label' => __( 'Modal window title', 'yit' ),
                                'desc' => __( 'Set title for modal window', 'yit' ),
                                'type' => 'text',
                                'std' => __( 'Modal Window', 'yit' ),
                                'deps' => array(
                                    'ids' => '_modal_window',
                                    'values' => 'yes'
                                )
                            ),
                            'modal_window_img' => array(
                                'label' => __( 'Modal window image', 'yit' ),
                                'desc' => __( 'Select the image content of modal window', 'yit' ),
                                'type' => 'upload',
                                'std' => '',
                                'deps' => array(
                                    'ids' => '_modal_window',
                                    'values' => 'yes'
                                )
                            ),
                            'custom_tab'=>array(
                                'label' => __( 'Tabs', 'yit' ),
                                'desc' => __( 'Insert a custom tab.', 'yit' ),
                                'type' => 'customtabs'
                            )
                        )
                    )
                )
);

$metabox3 = YIT_Metabox( 'yit-product-setting' );
$metabox3->init( $args3 );
}


add_action( 'after_setup_theme', 'yit_add_theme_metaboxes' );



