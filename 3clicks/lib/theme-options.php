<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Theme
 * @since G1_Theme 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php
add_filter( get_redux_opts_sections_filter_name(), 'g1_theme_options_register' );

function g1_redux_field_background_image ( $field_name_prefix, $field_id_prefix, $start_priority, $defaults = array() ) {
    return array(
        array(
            'id'        => $field_id_prefix.'_switch',
            'class'     => 'g1-background-image-fieldset',
            'priority'  => $start_priority,
            'type'      => 'select',
            'title'     => sprintf( __( 'Use %s Image', Redux_TEXT_DOMAIN ), $field_name_prefix ),
            'options'   => array(
                'standard'  => __('on', Redux_TEXT_DOMAIN),
                'none'      => __('off', Redux_TEXT_DOMAIN),
            ),
            'switch'    => true,
            'std'       => !empty($defaults['switch']) ? $defaults['switch'] : 'none',
        ),
        array(
            'id'        => $field_id_prefix.'_image',
            'priority'  => $start_priority + 1,
            'type'      => 'upload',
            'title'     => sprintf( __( '%s Image', Redux_TEXT_DOMAIN ), $field_name_prefix ),
            'std'       => !empty($defaults['image']) ? $defaults['image'] : ''
        ),
        array(
            'id'        => $field_id_prefix.'_image_hdpi',
            'priority'  => $start_priority + 2,
            'type'      => 'upload',
            'title'     => sprintf( __( '%s Image (High DPI)', Redux_TEXT_DOMAIN ), $field_name_prefix ),
            'sub_desc'  => __( 'An image for High DPI screen (like Retina) should be twice as big.', Redux_TEXT_DOMAIN ),
            'std'       => !empty($defaults['image_hdpi']) ? $defaults['image_hdpi'] : ''
        ),
        array(
            'id'        => $field_id_prefix.'_repeat',
            'priority'  => $start_priority + 3,
            'type'      => 'select',
            'title'     => sprintf( __( '%s Repeat', Redux_TEXT_DOMAIN ), $field_name_prefix ),
            'options'   => array(
                'no-repeat' => __('No Repeat', Redux_TEXT_DOMAIN),
                'repeat'    => __('Tile', Redux_TEXT_DOMAIN),
                'repeat-x'  => __('Tile Horizontally', Redux_TEXT_DOMAIN),
                'repeat-y'  => __('Tile Vertically', Redux_TEXT_DOMAIN),
            ),
            'std'       => !empty($defaults['repeat']) ? $defaults['repeat'] : 'no-repeat',
        ),
        array(
            'id'        => $field_id_prefix.'_position',
            'priority'  => $start_priority + 4,
            'type'      => 'select',
            'title'     => sprintf( __( '%s Position', Redux_TEXT_DOMAIN ), $field_name_prefix ),
            'options'   => array(
                // left
                'left top'      => __('Left Top', Redux_TEXT_DOMAIN),
                'left center'   => __('Left Center', Redux_TEXT_DOMAIN),
                'left bottom'   => __('Left Bottom', Redux_TEXT_DOMAIN),
                // right
                'right top'     => __('Right Top', Redux_TEXT_DOMAIN),
                'right center'  => __('Right Center', Redux_TEXT_DOMAIN),
                'right bottom'  => __('Right Bottom', Redux_TEXT_DOMAIN),
                // center
                'center top'    => __('Center Top', Redux_TEXT_DOMAIN),
                'center center' => __('Center Center', Redux_TEXT_DOMAIN),
                'center bottom' => __('Center Bottom', Redux_TEXT_DOMAIN),
            ),
            'std'       => !empty($defaults['position']) ? $defaults['position'] : 'no-repeat',
        ),
        array(
            'id'        => $field_id_prefix.'_attachment',
            'priority'  => $start_priority + 5,
            'type'      => 'select',
            'title'     => sprintf( __( '%s Attachment', Redux_TEXT_DOMAIN ), $field_name_prefix ),
            'sub_desc' =>
                '<p>' . __( 'Whether a background image is fixed or scrolls with the rest of the page.', Redux_TEXT_DOMAIN ) . '</p>',
            'options'   => array(
                'fixed'     => __('Fixed', Redux_TEXT_DOMAIN),
                'scroll'    => __('Scroll', Redux_TEXT_DOMAIN),
            ),
            'std'       => !empty($defaults['attachment']) ? $defaults['attachment'] : 'scroll',
        )
    );
}

function g1_redux_field_theme_area_divider ( $field_name_prefix, $field_id_prefix, $start_priority, $defaults = array() ) {
    return array(
        array(
            'id'        => $field_id_prefix.'_switch',
            'class'     => 'g1-divider-fieldset',
            'priority'  => $start_priority,
            'type'      => 'select',
            'title'     => sprintf( __( '%s Divider', Redux_TEXT_DOMAIN ), $field_name_prefix ),
            'options'   => array(
                'standard'  => __('on', Redux_TEXT_DOMAIN),
                'none'      => __('off', Redux_TEXT_DOMAIN),
            ),
            'switch'    => true,
            'std'       => !empty($defaults['switch']) ? $defaults['switch'] : 'none',
        ),
        array(
            'id'        => $field_id_prefix.'_color',
            'priority'  => $start_priority + 1,
            'type'      => 'color',
            'title'     => sprintf( __( '%s Divider Color', Redux_TEXT_DOMAIN ), $field_name_prefix ),
            'std'       => !empty($defaults['color']) ? $defaults['color'] : ''
        ),
        array(
            'id'        => $field_id_prefix.'_width',
            'priority'  => $start_priority + 2,
            'type'      => 'text',
            'title'     => sprintf( __( '%s Divider Height', Redux_TEXT_DOMAIN ), $field_name_prefix ),
            'desc'      => __( 'px', Redux_TEXT_DOMAIN ),
            'validate'  => 'numeric',
            'std'       => !empty($defaults['width']) ? $defaults['width'] : '',
        )
    );
}

function g1_theme_options_register ( $sections ) {
    $image_uri = trailingslashit( get_template_directory_uri() ) . 'images/admin-assets/';

    // General
    $sections['general'] = array(
        'priority'   => 20,
        'icon'       => 'cog',
        'icon_class' => 'icon-large',
        'title'      => __( 'General', Redux_TEXT_DOMAIN ),
        'fields'     => array(),
    );

    $sections['general_main'] = array(
        'priority'   => 24,
        'icon'       => 'cog',
        'icon_class' => 'icon-large',
        'title'      => __( 'Main', Redux_TEXT_DOMAIN ),
        'fields'     => array(
            array(
                'id'        => 'general_footer_text',
                'priority'  => 10,
                'type'      => 'text',
                'title'     => __( 'Footer Text', Redux_TEXT_DOMAIN ),
                'desc'  => __( 'eg. Copyright @ 2013 YourCompany', Redux_TEXT_DOMAIN ),
                'validate'  => 'html',
                'std'       => '© 2013 by some company. Remember to change this'
            ),
            array(
                'id'        => 'general_responsive_design',
                'priority'  => 15,
                'type'      => 'select',
                'title'     => __( 'Responsive Design', Redux_TEXT_DOMAIN ),
                'options'   => array(
                    'standard'  => 'on',
                    'none'      => 'off',

                ),
                'switch'    => true,
                'std'       => 'standard'
            ),
            array(
                'id'        => 'general_helpmode',
                'priority'  => 20,
                'type'      => 'select',
                'title'     => __( 'HelpMode', Redux_TEXT_DOMAIN ),
                'sub_desc'  =>
                    '<p>' . __( 'Enable the HelpMode to get some useful tips throughout the site.', Redux_TEXT_DOMAIN ) . '</p>' .
                    '<p>' . __( 'The HelpMode is visible only to users who have been assigned the administrator role, so regular site visitors don\'t see it.', Redux_TEXT_DOMAIN ) . '</p>',
                'options'   => array(
                    'standard'  => 'on',
                    'none'      => 'off',

                ),
                'switch'    => true,
                'std'       => 'standard'
            ),
            array(
                'id'        => 'general_scroll_to_top',
                'priority'  => 30,
                'type'      => 'select',
                'title'     => __( 'Scroll To Top', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'Enable button allowing quick page scroll to the top.', Redux_TEXT_DOMAIN ),
                'options'   => array(
                    'standard'  => 'on',
                    'none'      => 'off',
                ),
                'switch'    => true,
                'std'       => 'standard'
            )
        )
    );

    $sections['general_branding'] = array(
        'priority'   => 26,
        'icon'       => 'briefcase',
        'icon_class' => 'icon-large',
        'title'      => __( 'Branding', Redux_TEXT_DOMAIN ),
        'fields'     => array(
            array(
                'id'        => 'branding_logo',
                'priority'  => 110,
                'type'      => 'upload',
                'title'     => __( 'Desktop Logo', Redux_TEXT_DOMAIN ),
                'sub_desc'  => sprintf( __( 'Leave it blank to display the site title from <a href="%s">WP General Settings</a> instead.', Redux_TEXT_DOMAIN ), network_admin_url( 'options-general.php' ) ),
            ),
            array(
                'id'        => 'branding_logo_width',
                'priority'  => 112,
                'type'      => 'text',
                'title'     => __( 'Desktop Logo Width', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'in pixels', Redux_TEXT_DOMAIN ),
            ),
            array(
                'id'        => 'branding_logo_height',
                'priority'  => 114,
                'type'      => 'text',
                'title'     => __( 'Desktop Logo Height', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'in pixels', Redux_TEXT_DOMAIN ),
            ),
            array(
                'id'        => 'branding_logo_hdpi',
                'priority'  => 120,
                'type'      => 'upload',
                'title'     => __( 'Desktop Logo (High DPI)', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'An image for High DPI screen (like Retina) should be twice as big.', Redux_TEXT_DOMAIN ),
            ),
            array(
                'id'        => 'branding_logo_mobile',
                'priority'  => 130,
                'type'      => 'upload',
                'title'     => __( 'Mobile Logo', Redux_TEXT_DOMAIN ),
            ),
            array(
                'id'        => 'branding_logo_mobile_width',
                'priority'  => 132,
                'type'      => 'text',
                'title'     => __( 'Mobile Logo Width', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'in pixels', Redux_TEXT_DOMAIN ),
            ),
            array(
                'id'        => 'branding_logo_mobile_height',
                'priority'  => 134,
                'type'      => 'text',
                'title'     => __( 'Mobile Logo Height', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'in pixels', Redux_TEXT_DOMAIN ),
            ),
            array(
                'id'        => 'branding_logo_mobile_hdpi',
                'priority'  => 140,
                'type'      => 'upload',
                'title'     => __( 'Mobile Logo (High DPI)', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'An image for High DPI screen (like Retina) should be twice as big.', Redux_TEXT_DOMAIN ),
            ),
            array(
                'id'        => 'branding_favicon',
                'priority'  => 150,
                'type'      => 'upload',
                'title'     => __( 'Favicon', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'The recommended size is 16x16 pixels.', Redux_TEXT_DOMAIN ),
            ),
            array(
                'id'        => 'branding_apple_touch_icon',
                'priority'  => 160,
                'type'      => 'upload',
                'title'     => __( 'Apple Touch Icon', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'The recommended size is 114x114 pixels.', Redux_TEXT_DOMAIN ),
            ),
        )
    );

    // Style
    $sections['style'] = array(
        'priority'   => 30,
        'icon'       => 'tint',
        'icon_class' => 'icon-large',
        'title'      => __( 'Style', Redux_TEXT_DOMAIN ),
        'fields'     => array(),
    );


    $sections['style_main'] = array(
        'priority'   => 40,
        'icon'       => 'adjust',
        'icon_class' => 'icon-large',
        'title'      => __( 'Main', Redux_TEXT_DOMAIN ),
        'fields'     => array(
            array(
                'id'        => 'style_ui_corners',
                'priority'  => 10,
                'type'      => 'g1_border_radius',
                'title'     => __( 'UI Corners', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'This will be applied to buttons, boxes, tabs, etc', Redux_TEXT_DOMAIN ),
                'std'       => array(
                    'tl' => 'squircle',
                    'tr' => 'squircle',
                    'br' => 'squircle',
                    'bl' => 'squircle'
                )
            ),
            array(
                'id'        => 'style_background_info',
                'priority'  => 100,
                'type'      => 'info',
                'desc'      =>  '<h4>' .
                                    __( 'Body Background', Redux_TEXT_DOMAIN ) .
                                '</h4>',
            ),
            array(
                'id'        => 'style_background',
                'priority'  => 200,
                'type'      => 'color',
                'title'     => __( 'Background Color', Redux_TEXT_DOMAIN ),
                'std'       => '#ffffff',
            ),
            array(
                'id'        => 'style_background_scroll',
                'priority'  => 290,
                'type'      => 'select',
                'title'     => __( 'Background Scroll', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'Parallax scrolling effect', Redux_TEXT_DOMAIN ),
                'options'   => array(
                    'standard'  => __('on', Redux_TEXT_DOMAIN),
                    'none'      => __('off', Redux_TEXT_DOMAIN),
                ),
                'switch'    => true,
                'std'       => 'none',
            ),
            array(
                'id'        => 'style_background_info',
                'priority'  => 299,
                'type'      => 'info',
                'desc'      =>  '<h4>' .
                                    __( 'Top Background (preheader + header + precontent)', Redux_TEXT_DOMAIN ) .
                                '</h3>',
            ),
            array(
                'id'        => 'style_top_background',
                'priority'  => 300,
                'type'      => 'color',
                'title'     => __( 'Background Color', Redux_TEXT_DOMAIN ),
            ),
            array(
                'id'        => 'style_top_background_scroll',
                'priority'  => 390,
                'type'      => 'select',
                'title'     => __( 'Background Scroll', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'Parallax scrolling effect', Redux_TEXT_DOMAIN ),
                'options'   => array(
                    'standard'  => __('on', Redux_TEXT_DOMAIN),
                    'none'      => __('off', Redux_TEXT_DOMAIN),
                ),
                'switch'    => true,
                'std'       => 'none',
            ),
        ),
    );

    $sections['style_main']['fields'] = array_merge($sections['style_main']['fields'], g1_redux_field_background_image( 'Background', 'style_background', 210 ) );
    $sections['style_main']['fields'] = array_merge($sections['style_main']['fields'], g1_redux_field_background_image( 'Background', 'style_top_background', 310 ) );

    $theme_areas_fields = array();

    /* Preheader */
    $theme_areas_fields['preheader'][] = array(
        'id'        => 'ta_preheader_open_type',
        'priority'  => 100,
        'type'      => 'select',
        'title'     => __( 'How To Open?', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'expand'    => 'expand',
            'overlay'   => 'overlay'
        ),
        'switch'    => true,
        'std'       => 'overlay',
    );

    $theme_areas_fields['preheader'][] = array(
        'id'        => 'ta_preheader_open_on_startup',
        'priority'  => 102,
        'type'      => 'select',
        'title'     => __( 'Initial State', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'standard'  => 'opened',
            'none'      => 'closed',
        ),
        'switch'    => true,
        'std'       => 'none',
    );

    $theme_areas_fields['preheader'][] = array(
        'id'        => 'ta_preheader_space',
        'priority'  => 105,
        'type'      => 'select',
        'title'     => __( 'Space Before and After', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'none'    => 'off',
            'before'  => 'before',
            'after'  => 'after',
            'before_after'  => 'before and after',
        ),
        'switch'    => true,
        'std'       => 'none',
    );

    $theme_areas_fields['preheader'] =
        array_merge($theme_areas_fields['preheader'], g1_redux_field_theme_area_divider(
            'Top',
            'ta_preheader_top_divider',
            106,
            array('switch' => 'standard', 'color' => '#fb4400', 'width' => 3)));

    $theme_areas_fields['preheader'] =
        array_merge($theme_areas_fields['preheader'], g1_redux_field_theme_area_divider(
            'Bottom',
            'ta_preheader_bottom_divider',
            110,
            array('switch' => 'standard', 'color' => '#e6e6e6', 'width' => 1)));

    $theme_areas_fields['preheader'][] = array(
        'id'        => 'ta_preheader_layout',
        'priority'  => 115,
        'type'      => 'radio_img',
        'title'     => __( 'Layout', Redux_TEXT_DOMAIN ),
        'sub_desc'     => __( 'Set the width of outer and inner boxes.', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'wide-wide'         => array(
                'title' => 'wide-wide',
                'img'   => $image_uri . 'layout-wide-wide.png',
            ),
            'wide-semi'         => array(
                'title' => 'wide-semi',
                'img'   => $image_uri . 'layout-wide-semi.png',
            ),
            'wide-standard'     => array(
                'title' => 'wide-standard',
                'img'   => $image_uri . 'layout-wide-standard.png',
            ),
            'wide-narrow'       => array(
                'title' => 'wide-narrow',
                'img'   => $image_uri . 'layout-wide-narrow.png',
            ),
            'semi-standard'     => array(
                'title' => 'semi-standard',
                'img'   => $image_uri . 'layout-semi-standard.png',
            ),
            'semi-narrow'       => array(
                'title' => 'semi-narrow',
                'img'   => $image_uri . 'layout-semi-narrow.png',
            ),
            'standard-narrow'   => array(
                'title' => 'standard-narrow',
                'img'   => $image_uri . 'layout-standard-narrow.png',
            ),
        ),
        'std' => 'wide-narrow',
    );

    $theme_areas_fields['preheader'][] = array(
        'id'        => 'ta_preheader_composition',
        'priority'  => 120,
        'type'      => 'radio_img',
        'title'     => __( 'Composition', Redux_TEXT_DOMAIN ),
        'sub_desc'     => __( 'Choose arrangement of elements in the layout inner box.', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'none'      => array(
                'title' => 'none',
                'img'   => $image_uri . 'none.png',
            ),
            '1/1'		=> array(
                'title' => '1-column',
                'img'   => $image_uri . 'widgets-1-column.png',
            ),
            '1/2+1/2'   => array(
                'title' => '2-equal-columns',
                'img'   => $image_uri . 'widgets-2-equal-columns.png',
            ),
            '1/1_1/3+1/3+1/3'   => array(
                'title' => 'full + 3-equal-columns',
                'img'   => $image_uri . 'widgets-full-3-equal-columns.png',
            ),
            '1/3+1/3+1/3'       => array(
                'title' => '3-equal-columns',
                'img'   => $image_uri . 'widgets-3-equal-columns.png',
            ),
            '1/4+1/4+1/4+1/4'   => array(
                'title' => '4-equal-columns',
                'img'   => $image_uri . 'widgets-4-equal-columns.png',
            ),
            '1/2+1/4+1/4'		 => array(
                'title' => '1/2 + 1/4 + 1/4',
                'img'   => $image_uri . 'widgets-1_2-1_4-1_4.png',
            ),
            '1/4+1/2+1/4'		 => array(
                'title' => '1/4 + 1/2 + 1/4',
                'img'   => $image_uri . 'widgets-1_4-1_2-1_4.png',
            ),
            '1/4+1/4+1/2'		 => array(
                'title' => '1/4 + 1/4 + 1/2',
                'img'   => $image_uri . 'widgets-1_4-1_4-1_2.png',
            ),
            '1/4+3/4'			 => array(
                'title' => '1/4 + 3/4',
                'img'   => $image_uri . 'widgets-1_4-3_4.png',
            ),
            '3/4+1/4'			 => array(
                'title' => '3/4 + 1/4',
                'img'   => $image_uri . 'widgets-3_4-1_4.png',
            ),
        ),
        'std'       => '1/4+1/4+1/4+1/4'
    );

    $theme_areas_fields['preheader'][] = array(
        'id'        => 'ta_preheader_layout_corners',
        'priority'  => 130,
        'type'      => 'g1_border_radius',
        'title'     => __( 'Layout Corners', Redux_TEXT_DOMAIN ),
        'sub_desc'  =>
            '<p>' . __('Change the roundness of the corners applied to the whole area' ,Redux_TEXT_DOMAIN ) . '</p>',
    );

    if ( is_plugin_active('g1-social-icons/g1-social-icons.php') ) {
        $theme_areas_fields['preheader'][] = array(
            'id'        => 'ta_preheader_g1_social_icons',
            'priority'  => 150,
            'type'      => 'select',
            'title'     => __( 'Social Icons', Redux_TEXT_DOMAIN ),
            'sub_desc'  =>
                '<p>' . sprintf( __( 'You can edit social icons from the <a href="%s">G1 Social Icons Plugin Settings</a>', Redux_TEXT_DOMAIN ), network_admin_url( 'options-general.php?page=g1_social_icons_options' ) ) . '</p>',
            'options'   => array(
		'none'      => 'off',
                '24'        => 'on',
            ),
            'switch'    => true,
            'std'       => '24',
        );
    }
    $theme_areas_fields['preheader'][] = array(
        'id'        => 'ta_preheader_searchform',
        'priority'  => 160,
        'type'      => 'select',
        'title'     => __( 'Search Form', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'standard'  => 'big',
            'small'     => 'small',
            'none'      => 'off',
        ),
        'switch'    => true,
        'std'       => 'none',
    );


    /* Header */
    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_position',
        'priority'  => 200,
        'type'      => 'select',
        'title'     => __( 'Sticky Position', Redux_TEXT_DOMAIN ),
        'sub_desc'  =>
            '<p>' . __( 'Sticky header stays at the top as you scroll down', Redux_TEXT_DOMAIN ) . '</p>',
        'options'   => array(
            'static'    => 'off',
            'fixed'     => 'on',
        ),
        'switch'    => true,
        'std'       => 'fixed',
    );

    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_space',
        'priority'  => 205,
        'type'      => 'select',
        'title'     => __( 'Space Before and After', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'none'    => 'off',
            'before'  => 'before',
            'after'  => 'after',
            'before_after'  => 'before and after',
        ),
        'switch'    => true,
        'std'       => 'none',
    );

    $theme_areas_fields['header'] =
        array_merge($theme_areas_fields['header'], g1_redux_field_theme_area_divider(
            'Top',
            'ta_header_top_divider',
            206,
            array('switch' => 'none')
        ));

    $theme_areas_fields['header'] =
        array_merge($theme_areas_fields['header'], g1_redux_field_theme_area_divider(
            'Bottom',
            'ta_header_bottom_divider',
            210,
            array(
                'switch' => 'standard',
                'color' => '#e6e6e6',
                'width' => 1
            )
        ));

    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_layout',
        'priority'  => 215,
        'type'      => 'radio_img',
        'title'     => __( 'Layout', Redux_TEXT_DOMAIN ),
        'sub_desc'     => __( 'Set the width of outer and inner boxes.', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'wide-wide'         => array(
                'title' => 'wide-wide',
                'img'   => $image_uri . 'layout-wide-wide.png',
            ),
            'wide-semi'         => array(
                'title' => 'wide-semi',
                'img'   => $image_uri . 'layout-wide-semi.png',
            ),
            'wide-standard'     => array(
                'title' => 'wide-standard',
                'img'   => $image_uri . 'layout-wide-standard.png',
            ),
            'wide-narrow'       => array(
                'title' => 'wide-narrow',
                'img'   => $image_uri . 'layout-wide-narrow.png',
            ),
            'semi-standard'     => array(
                'title' => 'semi-standard',
                'img'   => $image_uri . 'layout-semi-standard.png',
            ),
            'semi-narrow'       => array(
                'title' => 'semi-narrow',
                'img'   => $image_uri . 'layout-semi-narrow.png',
            ),
            'standard-narrow'   => array(
                'title' => 'standard-narrow',
                'img'   => $image_uri . 'layout-standard-narrow.png',
            ),
        ),
        'std' => 'wide-narrow',
    );
    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_composition',
        'priority'  => 220,
        'type'      => 'radio_img',
        'title'     => __( 'Composition', Redux_TEXT_DOMAIN ),
        'sub_desc'     => __( 'Choose arrangement of elements in the layout inner box.', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'left-right'        => array(
                'title'     => 'left-right',
                'img'       => $image_uri . 'header-composition-01.png'
            ),
            'right-left'        => array(
                'title'     => 'right-left',
                'img'       => $image_uri . 'header-composition-03.png'
            ),
            'left-bottom'        => array(
                'title'     => 'left-bottom',
                'img'       => $image_uri . 'header-composition-04.png'
            ),
            'center-bottom'        => array(
                'title'     => 'center-bottom',
                'img'       => $image_uri . 'header-composition-05.png'
            ),
            'right-bottom'        => array(
                'title'     => 'right-bottom',
                'img'       => $image_uri . 'header-composition-06.png'
            ),
            'left-top'        => array(
                'title'     => 'left-top',
                'img'       => $image_uri . 'header-composition-07.png'
            ),
            'center-top'        => array(
                'title'     => 'center-top',
                'img'       => $image_uri . 'header-composition-08.png'
            ),
            'right-top'        => array(
                'title'     => 'right-top',
                'img'       => $image_uri . 'header-composition-09.png'
            ),
        ),
        'std'       => 'left-right'
    );
    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_layout_corners',
        'priority'  => 230,
        'type'      => 'g1_border_radius',
        'title'     => __( 'Layout Corners', Redux_TEXT_DOMAIN ),
        'sub_desc'  =>
        '<p>' . __('Change the roundness of the corners applied to the whole area' ,Redux_TEXT_DOMAIN ) . '</p>',
    );
    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_id_margin_top',
        'priority'  => 250,
        'type'      => 'g1_range',
        'title'     => __( 'Logo Margin Top', Redux_TEXT_DOMAIN ),
        'min'       => 0,
        'max'       => 100,
        'step'      => 1,
        'std'       => 30
    );
    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_id_margin_bottom',
        'priority'  => 260,
        'type'      => 'g1_range',
        'title'     => __( 'Logo Margin Bottom', Redux_TEXT_DOMAIN ),
        'min'       => 0,
        'max'       => 100,
        'step'      => 1,
        'std'       => 30,
    );
    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_primary_nav_margin_top',
        'priority'  => 270,
        'type'      => 'g1_range',
        'title'     => __( 'Primary Nav Margin Top', Redux_TEXT_DOMAIN ),
        'min'       => 0,
        'max'       => 100,
        'step'      => 1,
        'std'       => 30,
    );
    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_primary_nav_margin_bottom',
        'priority'  => 272,
        'type'      => 'g1_range',
        'title'     => __( 'Primary Nav Margin Bottom', Redux_TEXT_DOMAIN ),
        'min'       => 0,
        'max'       => 100,
        'step'      => 1,
        'std'       => 30,
    );
    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_tagline',
        'priority'  => 275,
        'type'      => 'select',
        'title'     => __( 'Tagline', Redux_TEXT_DOMAIN ),
        'sub_desc'  =>
            '<p>' .
                __( 'Whether or not to display the site tagline below the logo.', Redux_TEXT_DOMAIN ) .
                '<br />' .
                sprintf( __( 'Go to <a href="%s">WP General Settings</a> to set your tagline.', Redux_TEXT_DOMAIN ), network_admin_url( 'options-general.php' ) ) .
            '</p>',
        'options'   => array(
            'standard'  => 'on',
            'none'      => 'off',
        ),
        'switch'    => true,
        'std'       => 'none',
    );
    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_searchform',
        'priority'  => 280,
        'type'      => 'select',
        'title'     => __( 'Search Form', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'standard'  => 'big',
            'small'     => 'small',
            'none'      => 'off',
        ),
        'switch'    => true,
        'std'       => 'standard',
    );

    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_primary_nav_info',
        'priority'  => 290,
        'type'      => 'info',
        'desc'      =>
        '<h4>' .
            __( 'Primary Nav', Redux_TEXT_DOMAIN ),
    );

    $theme_areas_fields['header'][] = array(
        'id'        => 'ta_header_primary_nav_style',
        'priority'  => 295,
        'type'      => 'select',
        'title'     => __( 'Style', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'unstyled'   => __( 'unstyled', Redux_TEXT_DOMAIN ),
            'simple' => __( 'simple', Redux_TEXT_DOMAIN ),
            'solid'  => __( 'solid', Redux_TEXT_DOMAIN )
        ),
        'std'       => 'unstyled'
    );

    /* Precontent */
    $theme_areas_fields['precontent'][] = array(
        'id'        => 'ta_precontent_space',
        'priority'  => 305,
        'type'      => 'select',
        'title'     => __( 'Space Before and After', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'none'    => 'off',
            'before'  => 'before',
            'after'  => 'after',
            'before_after'  => 'before and after',
        ),
        'switch'    => true,
        'std'       => 'none',
    );

    $theme_areas_fields['precontent'] =
        array_merge($theme_areas_fields['precontent'], g1_redux_field_theme_area_divider(
            'Top',
            'ta_precontent_top_divider',
            306,
            array('switch' => 'none')
        ));

    $theme_areas_fields['precontent'] =
        array_merge($theme_areas_fields['precontent'], g1_redux_field_theme_area_divider(
            'Bottom',
            'ta_precontent_bottom_divider',
            310,
            array('switch' => 'none')
        ));

    $theme_areas_fields['precontent'][] = array(
        'id'        => 'ta_precontent_layout',
        'priority'  => 315,
        'type'      => 'radio_img',
        'title'     => __( 'Layout', Redux_TEXT_DOMAIN ),
        'sub_desc'  => __( 'Set the width of outer and inner boxes.', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'wide-narrow'       => array(
                'title' => 'wide-narrow',
                'img'   => $image_uri . 'layout-wide-narrow.png',
            ),
            'semi-narrow'       => array(
                'title' => 'semi-narrow',
                'img'   => $image_uri . 'layout-semi-narrow.png',
            ),
            'standard-narrow'   => array(
                'title' => 'standard-narrow',
                'img'   => $image_uri . 'layout-standard-narrow.png',
            ),
        ),
        'std' => 'wide-narrow',
    );
    $theme_areas_fields['precontent'][] = array(
        'id'        => 'ta_precontent_layout_corners',
        'priority'  => 330,
        'type'      => 'g1_border_radius',
        'title'     => __( 'Layout Corners', Redux_TEXT_DOMAIN ),
        'sub_desc'  =>
            '<p>' . __('Change the roundness of the corners applied to the whole area' ,Redux_TEXT_DOMAIN ) . '</p>',
    );


    /* Content */
    $theme_areas_fields['content'][] = array(
        'id'        => 'ta_content_space',
        'priority'  => 405,
        'type'      => 'select',
        'title'     => __( 'Space Before and After', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'none'    => 'off',
            'before'  => 'before',
            'after'  => 'after',
            'before_after'  => 'before and after',
        ),
        'switch'    => true,
        'std'       => 'none',
    );

    $theme_areas_fields['content'] =
        array_merge($theme_areas_fields['content'], g1_redux_field_theme_area_divider(
            'Top',
            'ta_content_top_divider',
            406,
            array('switch' => 'none')
        ));

    $theme_areas_fields['content'] =
        array_merge($theme_areas_fields['content'], g1_redux_field_theme_area_divider(
            'Bottom',
            'ta_content_bottom_divider',
            410,
            array('switch' => 'none')
        ));

    $theme_areas_fields['content'][] = array(
        'id'        => 'ta_content_layout',
        'priority'  => 415,
        'type'      => 'radio_img',
        'title'     => __( 'Layout', Redux_TEXT_DOMAIN ),
        'sub_desc'  => __( 'Set the width of outer and inner boxes.', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'wide-narrow'       => array(
                'title' => 'wide-narrow',
                'img'   => $image_uri . 'layout-wide-narrow.png',
            ),
            'semi-narrow'       => array(
                'title' => 'semi-narrow',
                'img'   => $image_uri . 'layout-semi-narrow.png',
            ),
            'standard-narrow'   => array(
                'title' => 'standard-narrow',
                'img'   => $image_uri . 'layout-standard-narrow.png',
            ),
        ),
        'std' => 'wide-narrow',
    );
    $theme_areas_fields['content'][] = array(
        'id'        => 'ta_content_layout_corners',
        'priority'  => 430,
        'type'      => 'g1_border_radius',
        'title'     => __( 'Layout Corners', Redux_TEXT_DOMAIN ),
        'sub_desc'  =>
            '<p>' . __('Change the roundness of the corners applied to the whole area' ,Redux_TEXT_DOMAIN ) . '</p>',
    );

    /* Prefooter */
    $theme_areas_fields['prefooter'][] = array(
        'id'        => 'ta_prefooter_space',
        'priority'  => 505,
        'type'      => 'select',
        'title'     => __( 'Space Before and After', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'none'    => 'off',
            'before'  => 'before',
            'after'  => 'after',
            'before_after'  => 'before and after',
        ),
        'switch'    => true,
        'std'       => 'none',
    );

    $theme_areas_fields['prefooter'] =
        array_merge($theme_areas_fields['prefooter'], g1_redux_field_theme_area_divider(
            'Top',
            'ta_prefooter_top_divider',
            506,
            array('switch' => 'none')
        ));

    $theme_areas_fields['prefooter'] =
        array_merge($theme_areas_fields['prefooter'], g1_redux_field_theme_area_divider(
            'Bottom',
            'ta_prefooter_bottom_divider',
            510,
            array('switch' => 'none')
        ));

    $theme_areas_fields['prefooter'][] = array(
        'id'        => 'ta_prefooter_layout',
        'priority'  => 515,
        'type'      => 'radio_img',
        'title'     => __( 'Layout', Redux_TEXT_DOMAIN ),
        'sub_desc'  => __( 'Set the width of outer and inner boxes.', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'wide-narrow'       => array(
                'title' => 'wide-narrow',
                'img'   => $image_uri . 'layout-wide-narrow.png',
            ),
            'semi-narrow'       => array(
                'title' => 'semi-narrow',
                'img'   => $image_uri . 'layout-semi-narrow.png',
            ),
            'standard-narrow'   => array(
                'title' => 'standard-narrow',
                'img'   => $image_uri . 'layout-standard-narrow.png',
            ),
        ),
        'std' => 'wide-narrow',
    );
    $theme_areas_fields['prefooter'][] = array(
        'id'        => 'ta_prefooter_composition',
        'priority'  => 520,
        'type'      => 'radio_img',
        'title'     => __( 'Composition', Redux_TEXT_DOMAIN ),
        'sub_desc'  => __( 'Choose arrangement of elements in the layout inner box.', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'none'      => array(
                'title' => 'none',
                'img'   => $image_uri . 'none.png',
            ),
            '1/1'		=> array(
                'title' => '1-column',
                'img'   => $image_uri . 'widgets-1-column.png',
            ),
            '1/2+1/2'   => array(
                'title' => '2-equal-columns',
                'img'   => $image_uri . 'widgets-2-equal-columns.png',
            ),
            '1/1_1/3+1/3+1/3'   => array(
                'title' => 'full + 3-equal-columns',
                'img'   => $image_uri . 'widgets-full-3-equal-columns.png',
            ),
            '1/3+1/3+1/3'       => array(
                'title' => '3-equal-columns',
                'img'   => $image_uri . 'widgets-3-equal-columns.png',
            ),
            '1/4+1/4+1/4+1/4'   => array(
                'title' => '4-equal-columns',
                'img'   => $image_uri . 'widgets-4-equal-columns.png',
            ),
            '1/2+1/4+1/4'		 => array(
                'title' => '1/2 + 1/4 + 1/4',
                'img'   => $image_uri . 'widgets-1_2-1_4-1_4.png',
            ),
            '1/4+1/2+1/4'		 => array(
                'title' => '1/4 + 1/2 + 1/4',
                'img'   => $image_uri . 'widgets-1_4-1_2-1_4.png',
            ),
            '1/4+1/4+1/2'		 => array(
                'title' => '1/4 + 1/4 + 1/2',
                'img'   => $image_uri . 'widgets-1_4-1_4-1_2.png',
            ),
            '1/4+3/4'			 => array(
                'title' => '1/4 + 3/4',
                'img'   => $image_uri . 'widgets-1_4-3_4.png',
            ),
            '3/4+1/4'			 => array(
                'title' => '3/4 + 1/4',
                'img'   => $image_uri . 'widgets-3_4-1_4.png',
            ),
        ),
        'std'       => '1/4+1/4+1/4+1/4'
    );
    $theme_areas_fields['prefooter'][] = array(
        'id'        => 'ta_prefooter_layout_corners',
        'priority'  => 530,
        'type'      => 'g1_border_radius',
        'title'     => __( 'Layout Corners', Redux_TEXT_DOMAIN ),
        'sub_desc'  =>
            '<p>' . __('Change the roundness of the corners applied to the whole area' ,Redux_TEXT_DOMAIN ) . '</p>',
    );

    $theme_areas_fields['prefooter'][] = array(
        'id'        => 'ta_prefooter_twitter_toolbar',
        'priority'  => 910,
        'type'      => 'select',
        'title'     => __( 'Twitter Toolbar', Redux_TEXT_DOMAIN ),
        'sub_desc'      => sprintf( '<a id="g1-twitter-configuration-link" href="#">%s</a>', __( 'Twitter configuration' , Redux_TEXT_DOMAIN )),
        'options'   => array(
            'standard'  => 'on',
            'none'      => 'off',
        ),
        'switch'    => true,
        'std'       => 'none',
    );

	$migrated_map_id = false;

	if ( is_admin() && class_exists('G1_GMaps') ) {
		$migrated_map_id = G1_Theme_Admin()->get_g1_gmaps_migrated_map_id();
	}

	if ( $migrated_map_id !== false ) {
		$prefooter_gmap_options = array(
			'none'      => 'none',
		);

		$map_list = G1_GMaps()->get_map_list();

		foreach ($map_list['list'] as $map_id => $map_label) {
			$prefooter_gmap_options[$map_id] = $map_label;
		}

		$prefooter_gmap_std = $migrated_map_id;
	} else {
		$prefooter_gmap_options = array(
			'standard'  => 'on',
			'none'      => 'off',
		);

		$prefooter_gmap_std = 'standard';
	}



	$theme_areas_fields['prefooter'][] = array(
        'id'        => 'ta_prefooter_gmap',
        'priority'  => 960,
        'type'      => 'select',
        'title'     => __( 'Map', Redux_TEXT_DOMAIN ),
        'sub_desc'      => sprintf( '<a id="g1-map-configuration-link" href="#">%s</a>', __( 'Map configuration' , Redux_TEXT_DOMAIN )),
        'options'   => $prefooter_gmap_options,
        'switch'    => true,
        'std'       => $prefooter_gmap_std,
    );

    /* Footer */
    $theme_areas_fields['footer'][] = array(
        'id'        => 'ta_footer_space',
        'priority'  => 605,
        'type'      => 'select',
        'title'     => __( 'Space Before and After', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'none'    => 'off',
            'before'  => 'before',
            'after'  => 'after',
            'before_after'  => 'before and after',
        ),
        'switch'    => true,
        'std'       => 'none',
    );

    $theme_areas_fields['footer'] =
        array_merge($theme_areas_fields['footer'], g1_redux_field_theme_area_divider(
            'Top',
            'ta_footer_top_divider',
            606,
            array('switch' => 'none')
        ));

    $theme_areas_fields['footer'] =
        array_merge($theme_areas_fields['footer'], g1_redux_field_theme_area_divider(
            'Bottom',
            'ta_footer_bottom_divider',
            610,
            array('switch' => 'none')
        ));

    $theme_areas_fields['footer'][] = array(
        'id'        => 'ta_footer_layout',
        'priority'  => 615,
        'type'      => 'radio_img',
        'title'     => __( 'Layout', Redux_TEXT_DOMAIN ),
        'sub_desc'  => __( 'Set the width of outer and inner boxes.', Redux_TEXT_DOMAIN ),
        'options'   => array(
            'wide-wide'         => array(
                'title' => 'wide-wide',
                'img'   => $image_uri . 'layout-wide-wide.png',
            ),
            'wide-semi'         => array(
                'title' => 'wide-semi',
                'img'   => $image_uri . 'layout-wide-semi.png',
            ),
            'wide-standard'     => array(
                'title' => 'wide-standard',
                'img'   => $image_uri . 'layout-wide-standard.png',
            ),
            'wide-narrow'       => array(
                'title' => 'wide-narrow',
                'img'   => $image_uri . 'layout-wide-narrow.png',
            ),

            'semi-standard'     => array(
                'title' => 'semi-standard',
                'img'   => $image_uri . 'layout-semi-standard.png',
            ),
            'semi-narrow'       => array(
                'title' => 'semi-narrow',
                'img'   => $image_uri . 'layout-semi-narrow.png',
            ),
            'standard-narrow'   => array(
                'title' => 'standard-narrow',
                'img'   => $image_uri . 'layout-standard-narrow.png',
            ),
        ),
        'std' => 'wide-narrow',
    );
    $theme_areas_fields['footer'][] = array(
        'id'        => 'ta_footer_composition',
        'priority'  => 620,
        'type'      => 'radio_img',
        'title'     => __( 'Composition', Redux_TEXT_DOMAIN ),
        'sub_desc'  => __( 'Choose arrangement of elements in the layout inner box.', Redux_TEXT_DOMAIN ),
        'options'   => array(
            '01'        => array(
                'title'     => 'version 1',
                'img'       => $image_uri . 'footer-composition-01.png'
            ),
            '02'        => array(
                'title'     => 'version 2',
                'img'       => $image_uri . 'footer-composition-02.png'
            ),
            '03'        => array(
                'title'     => 'version 3',
                'img'       => $image_uri . 'footer-composition-03.png'
            ),
        ),
        'std'       => '01'
    );
    $theme_areas_fields['footer'][] = array(
        'id'        => 'ta_footer_layout_corners',
        'priority'  => 630,
        'type'      => 'g1_border_radius',
        'title'     => __( 'Layout Corners', Redux_TEXT_DOMAIN ),
        'sub_desc'  =>
            '<p>' . __('Change the roundness of the corners applied to the whole area' ,Redux_TEXT_DOMAIN ) . '</p>',
    );

    $sections['style_fonts'] = array(
        'priority'   => 50,
        'icon'       => 'font',
        'icon_class' => 'icon-large',
        'title'      => __( 'Fonts', Redux_TEXT_DOMAIN ),
        'fields'     => array(
            // Body Text
            array(
                'id'        => 'style_fonts_regular_info',
                'priority'  => 10,
                'type'      => 'info',
                'desc'      =>  '<h4>' .
                                    __( 'Regular Text', Redux_TEXT_DOMAIN ) .
                                '</h4>' .
                                '<p>' .
                                    __( 'Customize the typography that is intended to use in body text', Redux_TEXT_DOMAIN ) .
                                '</p>',
            ),
            array(
                'id'        => 'style_fonts_regular_type',
                'priority'  => 20,
                'type'      => 'select',
                'title'     => __( 'Font Type', Redux_TEXT_DOMAIN ),
                'options'   => array(
                    'system'  => __('System', Redux_TEXT_DOMAIN),
                    'font-face'  => __('Font-Face', Redux_TEXT_DOMAIN),
                    'google'    => __('Google WebFonts', Redux_TEXT_DOMAIN)
                ),
                'switch' => true,
                'std' => 'google'
            ),
            array(
                'id'        => 'style_fonts_regular_system_font',
                'priority'  => 30,
                'type'      => 'select',
                'title'     => __( 'System Font', Redux_TEXT_DOMAIN ),
                'options'   => array_merge( array('' => ''),  G1_Font_Manager()->get_system_font_choices() ),
            ),
            array(
                'id'        => 'style_fonts_regular_fontface_font',
                'priority'  => 40,
                'type'      => 'select',
                'title'     => __( 'Font-Face Font', Redux_TEXT_DOMAIN ),
                'options'   => array_merge( array('' => ''),  G1_Font_Manager()->get_fontface_font_choices() ),
            ),
            array(
                'id'        => 'style_fonts_regular_google_font',
                'priority'  => 50,
                'type'      => 'google_webfonts',
                'title'     => __( 'Google Font', Redux_TEXT_DOMAIN ),
                'std'       => 'Open+Sans'
            ),
            array(
                'id'        => 'style_fonts_regular_size',
                'priority'  => 60,
                'type'      => 'select',
                'title'     => __( 'Font size', Redux_TEXT_DOMAIN ),
                'options'   => array(
                    'xs'    => __('x-small', Redux_TEXT_DOMAIN),
                    's'     => __('small', Redux_TEXT_DOMAIN),
                    'm'     => __('medium', Redux_TEXT_DOMAIN),
                    'l'     => __('large', Redux_TEXT_DOMAIN),
                    'xl'    => __('x-large', Redux_TEXT_DOMAIN),
                ),
                'std' => 's'
            ),
            // Meta Text
            array(
                'id'        => 'style_fonts_meta_info',
                'priority'  => 110,
                'type'      => 'info',
                'desc'      =>  '<h4>' .
                                    __( 'Meta Text', Redux_TEXT_DOMAIN ) .
                                '</h4>' .
                                '<p>' .
                                    __( 'Customize the typography that is intended to use in meta text (post bylines, comment dates, or similar meta information).', Redux_TEXT_DOMAIN ) .
                                '</p>',
            ),
            array(
                'id'        => 'style_fonts_meta_type',
                'priority'  => 120,
                'type'      => 'select',
                'title'     => __( 'Font Type', Redux_TEXT_DOMAIN ),
                'options'   => array(
                    'system'  => __('System', Redux_TEXT_DOMAIN),
                    'font-face'  => __('Font-Face', Redux_TEXT_DOMAIN),
                    'google'    => __('Google WebFonts', Redux_TEXT_DOMAIN)
                ),
                'switch' => true,
                'std' => 'google'
            ),
            array(
                'id'        => 'style_fonts_meta_system_font',
                'priority'  => 130,
                'type'      => 'select',
                'title'     => __( 'System Font', Redux_TEXT_DOMAIN ),
                'options'   => array_merge( array('' => ''),  G1_Font_Manager()->get_system_font_choices() ),
            ),
            array(
                'id'        => 'style_fonts_meta_fontface_font',
                'priority'  => 140,
                'type'      => 'select',
                'title'     => __( 'Font-Face Font', Redux_TEXT_DOMAIN ),
                'options'   => array_merge( array('' => ''),  G1_Font_Manager()->get_fontface_font_choices() ),
            ),
            array(
                'id'        => 'style_fonts_meta_google_font',
                'priority'  => 150,
                'type'      => 'google_webfonts',
                'title'     => __( 'Google Font', Redux_TEXT_DOMAIN ),
                'std'       => 'Open+Sans'
            ),
            // Important Text
            array(
                'id'        => 'style_fonts_important_info',
                'priority'  => 210,
                'type'      => 'info',
                'desc'      =>  '<h4>' .
                                    __( 'Important Text', Redux_TEXT_DOMAIN ) .
                                '</h4>' .
                                '<p>' .
                                    __( 'Customize the typography that is intended to use in bigger text (headings with small exceptions, large buttons, etc).', Redux_TEXT_DOMAIN ) .
                                '</p>',
            ),
            array(
                'id'        => 'style_fonts_important_type',
                'priority'  => 220,
                'type'      => 'select',
                'title'     => __( 'Font Type', Redux_TEXT_DOMAIN ),
                'options'   => array(
                    'system'  => __('System', Redux_TEXT_DOMAIN),
                    'font-face'  => __('Font-Face', Redux_TEXT_DOMAIN),
                    'google'    => __('Google WebFonts', Redux_TEXT_DOMAIN)
                ),
                'switch' => true,
                'std' => 'google'
            ),
            array(
                'id'        => 'style_fonts_important_system_font',
                'priority'  => 230,
                'type'      => 'select',
                'title'     => __( 'System Font', Redux_TEXT_DOMAIN ),
                'options'   => array_merge( array('' => ''),  G1_Font_Manager()->get_system_font_choices() ),
            ),
            array(
                'id'        => 'style_fonts_important_fontface_font',
                'priority'  => 240,
                'type'      => 'select',
                'title'     => __( 'Font-Face Font', Redux_TEXT_DOMAIN ),
                'options'   => array_merge( array('' => ''),  G1_Font_Manager()->get_fontface_font_choices() ),
            ),
            array(
                'id'        => 'style_fonts_important_google_font',
                'priority'  => 250,
                'type'      => 'google_webfonts',
                'title'     => __( 'Google Font', Redux_TEXT_DOMAIN ),
                'std'       => 'Open+Sans:300'
            ),
            array(
                'id'        => 'style_fonts_important_size',
                'priority'  => 260,
                'type'      => 'select',
                'title'     => __( 'Font size', Redux_TEXT_DOMAIN ),
                'options'   => array(
                    'xs'    => __('x-small', Redux_TEXT_DOMAIN),
                    's'     => __('small', Redux_TEXT_DOMAIN),
                    'm'     => __('medium', Redux_TEXT_DOMAIN),
                    'l'     => __('large', Redux_TEXT_DOMAIN),
                    'xl'    => __('x-large', Redux_TEXT_DOMAIN),
                ),
                'std' => 'm'
            ),
            // Primary Navigation
            array(
                'id'        => 'style_fonts_primary_nav_info',
                'priority'  => 310,
                'type'      => 'info',
                'desc'      =>  '<h4>' .
                                    __( 'Primary Navigation', Redux_TEXT_DOMAIN ) .
                                '</h4>',
            ),
            array(
                'id'        => 'style_fonts_primary_nav_type',
                'priority'  => 320,
                'type'      => 'select',
                'title'     => __( 'Font Type', Redux_TEXT_DOMAIN ),
                'options'   => array(
                    'system'  => __('System', Redux_TEXT_DOMAIN),
                    'font-face'  => __('Font-Face', Redux_TEXT_DOMAIN),
                    'google'    => __('Google WebFonts', Redux_TEXT_DOMAIN)
                ),
                'switch' => true,
                'std' => 'google'
            ),
            array(
                'id'        => 'style_fonts_primary_nav_system_font',
                'priority'  => 330,
                'type'      => 'select',
                'title'     => __( 'System Font', Redux_TEXT_DOMAIN ),
                'options'   => array_merge( array('' => ''),  G1_Font_Manager()->get_system_font_choices() ),
            ),
            array(
                'id'        => 'style_fonts_primary_nav_fontface_font',
                'priority'  => 340,
                'type'      => 'select',
                'title'     => __( 'Font-Face Font', Redux_TEXT_DOMAIN ),
                'options'   => array_merge( array('' => ''),  G1_Font_Manager()->get_fontface_font_choices() ),
            ),
            array(
                'id'        => 'style_fonts_primary_nav_google_font',
                'priority'  => 350,
                'type'      => 'google_webfonts',
                'title'     => __( 'Google Font', Redux_TEXT_DOMAIN ),
                'std'       => 'Open+Sans'
            ),
            array(
                'id'        => 'style_fonts_primary_nav_size',
                'priority'  => 360,
                'type'      => 'g1_range',
                'title'     => __( 'Font size', Redux_TEXT_DOMAIN ),
                'desc'      => __( 'px', Redux_TEXT_DOMAIN ),
                'min'       => 12,
                'max'       => 30,
                'step'      => 1,
                'std'       => 14
            ),
            array(
                'id'        => 'style_fonts_primary_nav_padding_top',
                'priority'  => 370,
                'type'      => 'g1_range',
                'title'     => __( 'Padding Top', Redux_TEXT_DOMAIN ),
                'desc'      => __( 'px', Redux_TEXT_DOMAIN ),
                'min'       => 0,
                'max'       => 100,
                'step'      => 1,
                'std'       => 10
            ),
            array(
                'id'        => 'style_fonts_primary_nav_padding_bottom',
                'priority'  => 380,
                'type'      => 'g1_range',
                'title'     => __( 'Padding Bottom', Redux_TEXT_DOMAIN ),
                'desc'      => __( 'px', Redux_TEXT_DOMAIN ),
                'min'       => 0,
                'max'       => 100,
                'step'      => 1,
                'std'       => 20
            ),
        )
    );

    $theme_areas = array(
        'preheader'     => __( 'Preheader', 'g1_theme' ),
        'header'        => __( 'Header', 'g1_theme' ),
        'precontent'    => __( 'Precontent', 'g1_theme' ),
        'content'       => __( 'Content', 'g1_theme' ),
        'prefooter'     => __( 'Prefooter', 'g1_theme' ),
        'footer'        => __( 'Footer', 'g1_theme' ),
    );

    $section_priority = 60;

    // theme areas "Basic & Distinctive Color Schema" defaults
    $ta_color_schemas_defaults = array(
        'preheader' => array(
            // basic
            'cs_1_background'           => '#ffffff',
            'cs_1_background_image'     => array(
                'switch' => 'none',
            ),
            'cs_1_background_opacity'   => '100',
            'cs_1_text1'                => '#000000',
            'cs_1_text2'                => '#666666',
            'cs_1_text3'                => '#999999',
            'cs_1_link'                 => '#fb4400',
            'cs_1_link_hover'           => '#000000',
            // distinctive
            'cs_2_background'           => '#fb4400',
            'cs_2_text1'                => '#ffffff',
        ),
        'header' => array(
            // basic
            'cs_1_background'           => '#ffffff',
            'cs_1_background_image'     => array(
                'switch' => 'none',
            ),
            'cs_1_background_opacity'   => '100',
            'cs_1_text1'                => '#000000',
            'cs_1_text2'                => '#666666',
            'cs_1_text3'                => '#999999',
            'cs_1_link'                 => '#fb4400',
            'cs_1_link_hover'           => '#000000',
            // distinctive
            'cs_2_background'           => '#94949c',
            'cs_2_text1'                => '#ffffff',
        ),
        'precontent' => array(
            // basic
            'cs_1_background'           => '#fb4400',
            'cs_1_background_image'     => array(
                'switch' => 'none',
            ),
            'cs_1_background_opacity'   => '100',
            'cs_1_text1'                => '#ffffff',
            'cs_1_text2'                => '#fedad4',
            'cs_1_text3'                => '#fdb2a3',
            'cs_1_link'                 => '#000000',
            'cs_1_link_hover'           => '#ffffff',
            // distinctive
            'cs_2_background'           => '#000000',
            'cs_2_text1'                => '#ffffff',
        ),
        'content' => array(
            // basic
            'cs_1_background'           => '#ffffff',
            'cs_1_background_image'     => array(
                'switch' => 'none',
            ),
            'cs_1_background_opacity'   => '100',
            'cs_1_text1'                => '#000000',
            'cs_1_text2'                => '#666666',
            'cs_1_text3'                => '#999999',
            'cs_1_link'                 => '#fb4400',
            'cs_1_link_hover'           => '#000000',
            // distinctive
            'cs_2_background'           => '#fb4400',
            'cs_2_text1'                => '#ffffff',
        ),
        'prefooter' => array(
            // basic
            'cs_1_background'           => '#333333',
            'cs_1_background_image'     => array(
                'switch'    => 'none'
            ),
            'cs_1_background_opacity'   => '100',
            'cs_1_text1'                => '#ffffff',
            'cs_1_text2'                => '#999999',
            'cs_1_text3'                => '#666666',
            'cs_1_link'                 => '#fb4400',
            'cs_1_link_hover'           => '#ffffff',
            // distinctive
            'cs_2_background'           => '#fb4400',
            'cs_2_text1'                => '#ffffff',
        ),
        'footer' => array(
            // basic
            'cs_1_background'           => '#262626',
            'cs_1_background_image'     => array(
                'switch'    => 'none'
            ),
            'cs_1_background_opacity'   => '100',
            'cs_1_text1'                => '#ffffff',
            'cs_1_text2'                => '#999999',
            'cs_1_text3'                => '#666666',
            'cs_1_link'                 => '#fb4400',
            'cs_1_link_hover'           => '#ffffff',
            // distinctive
            'cs_2_background'           => '#fb4400',
            'cs_2_text1'                => '#ffffff',
        )
    );

    foreach ( $theme_areas as $slug => $label) {
        $id_prefix = 'ta_' . $slug . '_';

        $defaults = $ta_color_schemas_defaults[$slug];

        // Theme Area Type Section
        $sections['style_'.$slug] = array(
            'priority'   => $section_priority,
            'icon'       => 'tint',
            'icon_class' => 'icon-large',
            'title'      => $label,
            'fields'     => array(
                // Style Theme Area > Basic Color Schema
                array(
                    'id'        => $id_prefix . 'cs_1_info',
                    'priority'  => 1002,
                    'type'      => 'info',
                    'desc'      =>
                                    '<h4>' .
                                        __( 'Basic Color Schema', Redux_TEXT_DOMAIN ) .
                                    '</h4>' .
                                    '<p>' .
                                        __( 'This will be applied to texts, links etc.', Redux_TEXT_DOMAIN ) .
                                    '</p>',
                ),
                array(
                    'id'        => $id_prefix . 'cs_1_background',
                    'priority'  => 1010,
                    'type'      => 'color',
                    'title'     => __( 'Background Color', Redux_TEXT_DOMAIN ),
                    'std'       => $defaults['cs_1_background']
                ),
                array(
                    'id'        => $id_prefix . 'cs_1_background_opacity',
                    'priority'  => 1012,
                    'type'      => 'select',
                    'title'     => __( 'Background Opacity', Redux_TEXT_DOMAIN ),
                    'options'   => array(
                        '0'     => __( '0%', Redux_TEXT_DOMAIN ),
                        '100'   => __( '100%', Redux_TEXT_DOMAIN ),
                    ),
                    'std'       => $defaults['cs_1_background_opacity']
                ),
                array(
                    'id'        => $id_prefix . 'cs_1_text1',
                    'priority'  => 1060,
                    'type'      => 'color',
                    'title'     => __( 'Important Text Color', Redux_TEXT_DOMAIN ),
                    'sub_desc'  => __( 'Headings (with small exceptions).', Redux_TEXT_DOMAIN ),
                    'std'       => $defaults['cs_1_text1']
                ),
                array(
                    'id'        => $id_prefix . 'cs_1_text2',
                    'priority'  => 1070,
                    'type'      => 'color',
                    'title'     => __( 'Regular Text Color', Redux_TEXT_DOMAIN ),
                    'sub_desc'  =>
                        __( 'Body text', Redux_TEXT_DOMAIN ),
                    'std'       => $defaults['cs_1_text2']
                ),
                array(
                    'id'        => $id_prefix . 'cs_1_text3',
                    'priority'  => 1080,
                    'type'      => 'color',
                    'title'     => __( 'Meta Text Color', Redux_TEXT_DOMAIN ),
                    'sub_desc'  =>
                        __( 'Post bylines, comment dates, meta information', Redux_TEXT_DOMAIN ),
                    'std'       => $defaults['cs_1_text3']
                ),
                array(
                    'id'        => $id_prefix . 'cs_1_link',
                    'priority'  => 1090,
                    'type'      => 'color',
                    'title'     => __( 'Link Color', Redux_TEXT_DOMAIN ),
                    'std'       => $defaults['cs_1_link']
                ),
                array(
                    'id'        => $id_prefix . 'cs_1_link_hover',
                    'priority'  => 1100,
                    'type'      => 'color',
                    'title'     => __( 'Link Color on Hover', Redux_TEXT_DOMAIN ),
                    'std'       => $defaults['cs_1_link_hover']
                ),
                // Style Theme Area > Distinctive Color Schema
                array(
                    'id'        => $id_prefix . 'cs_2_info',
                    'priority'  => 1111,
                    'type'      => 'info',
                    'desc'     =>   '<h4>' .
                                        __( 'Distinctive Color Schema', Redux_TEXT_DOMAIN ) .
                                    '</h4>' .
                                    '<p>' .
                                        __( 'This will be applied to buttons, dropcaps etc.', Redux_TEXT_DOMAIN ) .
                                    '</p>',
                ),
                array(
                    'id'        => $id_prefix . 'cs_2_background',
                    'priority'  => 1120,
                    'type'      => 'color',
                    'title'     => __( 'Background Color', Redux_TEXT_DOMAIN ),
                    'std'       => $defaults['cs_2_background']
                ),
                array(
                    'id'        => $id_prefix . 'cs_2_text1',
                    'priority'  => 1130,
                    'type'      => 'color',
                    'title'     => __( 'Text Color', Redux_TEXT_DOMAIN ),
                    'std'       => $defaults['cs_2_text1']
                ),
            )
        );

        $sections['style_'.$slug]['fields'] = array_merge($sections['style_'.$slug]['fields'], g1_redux_field_background_image( 'Background', $id_prefix.'cs_1_background', 1020, $defaults['cs_1_background_image'] ));

        if ( !empty($theme_areas_fields[$slug]) ) {
            $sections['style_'.$slug]['fields'] = array_merge($sections['style_'.$slug]['fields'], $theme_areas_fields[$slug]);

        }



        $section_priority += 10;
    }

    $sections['sidebars'] = array(
        'priority'   => 1000,
        'icon'       => 'columns',
        'icon_class' => 'icon-large',
        'title'      => __( 'Sidebars', Redux_TEXT_DOMAIN ),
        'fields'     => array(
            array(
                'id'        => 'sidebars',
                'priority'  => 10,
                'type'      => 'multi_text',
                'title'     => __( 'Custom Sidebars', Redux_TEXT_DOMAIN ),
                'sub_desc'  => __( 'Sidebar name can only consist of: lowercase letters, digits, underscores and hyphens', Redux_TEXT_DOMAIN ),
            )
        )
    );

    $log_html = '';
    $log = get_transient('g1_dynamic_style_cache_log');

    if ($log !== false && is_array($log)) {
        $log_html .= '<br /><br />';
        $log_html .= '<h4>'. __( 'Last action status', 'g1_theme' ) .':</h4>';

        $log_html .= '<div class="g1-log g1-log-'. $log['type'] .'">' . $log['message'] . ' ('. $log['date'] .')</div>';
    }

    $sections['advanced'] = array(
        'priority'   => 2000,
        'icon'       => 'wrench',
        'icon_class' => 'icon-large',
        'title'      => __( 'Advanced', Redux_TEXT_DOMAIN ),
        'fields'     => array(
            array(
                'id'        => 'advanced_dynamic_style_cache',
                'priority'  => 10,
                'type'      => 'select',
                'title'     => __( 'Dynamic style cache', Redux_TEXT_DOMAIN ),
                'desc'  =>  (G1_Theme()->can_use_static_dynamic_style() ? '' : '<span class="redux-option-disabled">' . __( 'Option disabled. Uploads directory is not writable.', Redux_TEXT_DOMAIN ) . '</span>') . $log_html,
                'options'   => array(
                    'none'      => __('off', Redux_TEXT_DOMAIN),
                    'standard'  => __('on', Redux_TEXT_DOMAIN),
                ),
                'switch'    => true,
                'std'       => 'standard',
            )
        )
    );

    return $sections;
}


