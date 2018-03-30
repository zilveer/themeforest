<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return the list of shortcode and their settings
 *
 * @package Yithemes
 * @author Francesco Licandro  <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include( $this->plugin_path.'/functions.php');

$button_style = get_button_style();
$awesome_icons = YIT_Plugin_Common::get_awesome_icons();
$awesome_icons_socials = YIT_Plugin_Common::get_awesome_icons_socials();
$null = array( '' =>__('None', 'yit') );
$awesome_icons_with_null = array_merge($null, $awesome_icons);
$categories = is_admin() ? yit_get_categories( true ) : array();
$set_icons = get_set_icons();
$animate = yit_get_animate_effects();

$icon_list = array (
    'theme-icon' => __('Theme Icon', 'yit'),
    'custom' => __('Custom Icon', 'yit')
);

return array(

    /* === BOX SECTION === */
    'box_section' => array(
        'title' => __('Icon box', 'yit' ),
        'description' =>  __('Shows a box, with Title and icons on left and a text of section (you can use HTML tags)', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => true,
        'attributes' => array(
            'layout' => array(
                'title' => __( 'Layout', 'yit' ),
                'type'  => 'select',
                'options' => array(
                    'horizontal' => __('Horizontal', 'yit'),
                    'vertical' => __('Vertical', 'yit')
                ),
                'std' => 'horizontal'
            ),
            'icon_type' => array(
                'title' => __('Icon type', 'yit'),
                'type'  => 'select',
                'options' => array(
                    'theme-icon' => __('Theme Icon', 'yit'),
                    'custom' => __('Custom Icon', 'yit')
                ),
                'std' => 'theme-icon'
            ),
            'icon_theme' => array(
                'title' => __('Icon', 'yit'),
                'type' => 'select-icon',  // home|file|time|ecc
                'options' => $awesome_icons,
                'std'  => '',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),

            'icon_url' =>  array(
                'title' => __('Icon URL', 'yit'),
                'type' => 'text',
                'std'  => '',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'custom'
                )
            ),

            'icon_size' => array(
                'title' => __('Icon size', 'yit'),
                'type' => 'number',
                'min' => '9',
                'max' => '90',
                'std'  => '14',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'color' => array(
                'title' => __('Icon Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#797979',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'circle_size' => array(
                'title' => __('Circle Size', 'yit'),
                'type' => 'number',
                'std'  => '70',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'color_circle' => array(
                'title' => __('Border Color Icon', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#797979',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'title_size' => array(
                'title' => __('Title tag', 'yit'),
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'yit'),
                    'h2' => __('h2', 'yit'),
                    'h3' => __('h3', 'yit'),
                    'h4' => __('h4', 'yit'),
                    'h5' => __('h5', 'yit'),
                    'h6' => __('h6', 'yit')
                ),
                'std'  => ''
            ),
            'class' => array(
                'title' => __('CSS class', 'yit'),
                'type' => 'text',
                'std'  => 'box-sections'
            ),
            'link' => array(
                'title' => __('Link', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'link_title' => array(
                'title' => __('Link title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === ICON === */
    'icon' => array(
        'title' => __('Icon', 'yit' ),
        'description' =>  __('Shows an icon', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(

            'icon_type' => array(
                'title' => __('Icon type', 'yit'),
                'type'  => 'select',
                'options' => array(
                    'theme-icon' => __('Theme Icon', 'yit'),
                    'custom' => __('Custom Icon', 'yit')
                ),
                'std' => 'theme-icon'
            ),

            'icon_theme' => array(
                'title' => __('Icon', 'yit'),
                'type' => 'icon-list',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                ),
                'std' => ''
            ),

            'icon_url' =>  array(
                'title' => __('Icon URL', 'yit'),
                'type' => 'text',
                'std'  => '',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'custom'
                )
            ),
            'icon_size' => array(
                'title' => __('Icon size', 'yit'),
                'type' => 'number',
                'min' => '9',
                'max' => '90',
                'std'  => '14',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'color' => array(
                'title' => __('Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#797979',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'circle' => array(
                'title' => __('Circle', 'yit'),
                'type'  => 'select',
                'options' => array(
                    'yes' => __('Yes', 'yit'),
                    'no' => __('No', 'yit')
                ),
                'std' => 'no',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),

            'circle_size' => array(
                'title' => __('Circle Size', 'yit'),
                'type'  => 'number',
                'std' => '35',
                'deps' => array(
                    'ids' => 'circle',
                    'values' => 'yes'
                )

            ),


        )
    ),

    /* === CALL TO ACTION BUTTON === */
    'call_two' => array(
        'title' => __('Call to action with button', 'yit' ),
        'description' =>  __('Shows a box with an incipit and a number phone', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => true,
        'attributes' => array(
            'href' => array(
                'title' => __('URL', 'yit'),
                'type' => 'text',
                'std'  => '#'
            ),

            'colortext' => array(
                'title' => __('Color of text', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#000000'
            ),
            'background_color' => array(
                'title' => __('Background Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#ffffff'
            ),
            'font_size' => array(
                'title' => __('Font size', 'yit'),
                'type' => 'number',
                'std'  => '32'
            ),
            'label_button' => array(
                'title' => __('Label button', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'label_size' => array(
                'title' => __('Label size', 'yit'),
                'type' => 'number',
                'std'  => '30'
            ),
            'class' => array(
                'title' => __('CSS class', 'yit'),
                'type' => 'text',
                'std'  => 'call-to-action-two'
            ),

            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === IMAGE BANNER === */
    'image_banner' => array(
        'title' => __('Banner with image and button', 'yit' ),
        'description' =>  __('Shows a box with an banner, text and button', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'slogan' => array(
                'title' => __('Slogan', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'slogan_font_size' => array(
                'title' => __('Slogan font size', 'yit'),
                'type' => 'number',
                'min' => '9',
                'max' => '90',
                'std'  => '32'
            ),
            'slogan_color' => array(
                'title' => __('Slogan Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#000000'
            ),
            'subslogan' => array(
                'title' => __('Subslogan', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'subslogan_font_size' => array(
                'title' => __('Subslogan font size', 'yit'),
                'type' => 'number',
                'min' => '9',
                'max' => '90',
                'std'  => '24'
            ),
            'subslogan_color' => array(
                'title' => __('Subslogan Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#000000'
            ),
            'subslogan_color_hover' => array(
                'title' => __('Subslogan Color Hover', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#000000'
            ),
            'button' => array(
                'title' => __( 'Show button', 'yit' ),
                'type' => 'checkbox',
                'std' => 'no'
            ),
            'button_color' => array(
                'title' => __( 'Button Color', 'yit' ),
                'description' => __('Set border color, text color and background color hover of button','yit'),
                'type' => 'colorpicker',
                'std' => '#000000'
            ),
            'button_text_hover' => array(
                'title' => __( 'Button Text Color Hover', 'yit' ),
                'type' => 'colorpicker',
                'std' => '#ffffff'
            ),
            'label_button' => array(
                'title' => __('Label button', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'box_horizontal_alignment' => array(
                'title' => __('Horizontal Alignment Info', 'yit'),
                'type' => 'select',
                'options' => array(
                    'left' => __('Left', 'yit'),
                    'right' => __('Right', 'yit'),
                    'center' => __('Center', 'yit'),
                ),
                'std'  => 'center'
            ),
            'box_vertical_alignment' => array(
                'title' => __('Vertical Alignment Info', 'yit'),
                'type' => 'select',
                'options' => array(
                    'top' => __('Top', 'yit'),
                    'middle' => __('Middle', 'yit'),
                    'bottom' => __('Bottom', 'yit'),
                ),
                'std'  => 'middle'
            ),
            'banner_height' => array(
                'title' => __('Banner Height', 'yit'),
                'type' => 'number',
                'std'  => '150'
            ),
            'background_image_url' => array(
                'title' => __('Background image URL', 'yit'),
                'type' => 'text',
                'std'  => '#'
            ),
            'overlay_color' => array(
                'title' => __('Color Overlay', 'yit'),
                'type' => 'select',
                'options' => array(
                    'black' => __('Black', 'yit'),
                    'white' => __('White', 'yit'),
                ),
                'std'  => 'black'
            ),
            'href' => array(
                'title' => __('URL', 'yit'),
                'type' => 'text',
                'std'  => '#'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )

        )
    ),

    /* === TICK === */
    'x' => array(
        'title' => __('Tick', 'yit' ),
        'description' =>  __('Insert a tick on the content', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'size' => array(
                'title' => __('Size', 'yit'),
                'type' => 'number',
                'std'  => '18'
            ),
            'color' => array(
                'title' => __('Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#23b10b'
            )
        )
    ),

    /* === FLEXSLIDER === */
    'images_slider' => array(
        'title' => __( 'Images slider', 'yit' ),
        'description' => __( 'Create an image slider', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => true,
        'attributes' => array(
            'effect' => array(
                'title' => __( 'Effect', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'fade' => __( 'Fade', 'yit' ),
                    'slide' => __( 'Slide', 'yit' )
                ),
                'std' => 'fade'
            ),
            'width' => array(
                'title' => __( 'Width', 'yit' ),
                'type' => 'number',
                'std' => '0',
                'description' => __( 'px (0 = 100%)', 'yit' )
            ),
            'height' => array(
                'title' => __( 'Height ( In px )', 'yit' ),
                'type' => 'number',
                'std' => '200',
                'description' => __( 'px (0 = 100%)', 'yit' )
            ),
            'speed' => array(
                'title' => __( 'Speed', 'yit' ),
                'type' => 'number',
                'std' => '8000'
            ),
            'direction' => array(
                'title' => __( 'Direction', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'horizontal' => __( 'Horizontal', 'yit' ),
                    'vertical' => __( 'Vertical', 'yit' )
                ),
                'std' => 'horizontal'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )

        )
    ),

    /* === IMAGE* === */
    'img' => array(
        'title' => __('Image', 'yit' ),
        'description' =>  __('Insert an image', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => false,
        'attributes' => array(
            'src' => array(
                'title' => __('URL', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'alt' => array(
                'title' => __('Alternate text', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'width' => array(
                'title' => __('Width', 'yit'),
                'type' => 'number',
                'std'  => ''
            ),
            'height' => array(
                'title' => __('Height', 'yit'),
                'type' => 'number',
                'std'  => ''
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            )
        )
    ),

    /* === IMAGE LIGHTBOX === */
    'image' => array(
        'title' => __('Image Lightbox', 'yit' ),
        'description' =>  __('Insert an image', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'url' => array(
                'title' => __('URL', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'link' => array(
                'title' => __('Link', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'size' => array(
                'title' => __('Size', 'yit'),
                'type' => 'select', // small|medium|large|fullwidth
                'options' => array(
                    'small' => __('Small', 'yit'),
                    'medium' => __('Medium', 'yit'),
                    'large' => __('Large', 'yit'),
                    'fullwidth' => __('Full width', 'yit')
                ),
                'std'  => 'medium'
            ),
            'target' => array(
                'title' => __('Target', 'yit'),
                'type' => 'select', // _blank|_parent|_self|_top
                'options' => array(
                    '_blank' => __('New window', 'yit'),
                    '_parent' => __('Principal window', 'yit'),
                    '_self' => __('Same window', 'yit'),
                    '_top' => __('New full window', 'yit')
                ),
                'std'  => ''
            ),
            'lightbox' => array(
                'title' => __('Lightbox', 'yit'),
                'type' => 'select', // true|false
                'options' => array(
                    'true' => __('Yes', 'yit'),
                    'false' => __('No', 'yit')
                ),
                'std'  => 'true'
            ),
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'align' => array(
                'title' => __('Alignment', 'yit'),
                'type' => 'select', // left|right|center
                'options' => array(
                    'left' => __('Left', 'yit'),
                    'right' => __('Right', 'yit'),
                    'center' => __('Center', 'yit')
                ),
                'std'  => 'left'
            ),
            'autoheight' => array(
                'title' => __('Auto height', 'yit'),
                'type' => 'select',
                'options' => array (
                    'false' => __('No', 'yit'),
                    'true' => __('Yes', 'yit')
                ),
                'std'  => 'false'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === PRINT BORDER === */
    'border' => array(
        'title' => __('Print border line', 'yit' ),
        'description' =>  __('Print a border', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === TEASER === */
    'teaser' => array(
        'title' => __('Teaser', 'yit' ),
        'description' =>  __('Create a banner with an image, a link and text.', 'yit' ),
        'tab' => 'shortcode',
        'has_content' => false,
        'multiple' => false,
        'unlimited'   => false,
        'in_visual_composer' => false,
        'hide' => true,
        'attributes' => array(
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'subtitle' => array(
                'title' => __('Subtitle', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'image' => array(
                'title' => __('Image URL', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'link' => array(
                'title' => __('Link', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'slogan_position' => array(
                'title' => __('Slogan Position', 'yit'),
                'type' => 'select',
                'options'  => array(
                    'top' => __('Top', 'yit'),
                    'center' => __('Center', 'yit'),
                    'bottom' => __('Bottom', 'yit'),
                ),
                'std' => ''
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === TABS* === */
    'tabs' => array(
        'title' => __('Tabs', 'yit' ),
        'description' =>  __('Create a content with tabs.', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => false,
        'has_content' => true,
        'unlimited'   => true,
        'code'        => '[tabs tab1="Tab 1" tab2="Tab 2" tab3="Tab 3"]
            						[tab id="tab1"]Your content 1[/tab]
            						[tab id="tab2"]Your content 2[/tab]
            						[tab id="tab3"]Your content 3[/tab]
            					  [/tabs]',

    ),
    /* === TAB === */
    'tab' => array(
        'title' => __('Tab', 'yit' ),
        'description' =>  __('Create a content tab in shortcode tabs.', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'attributes' => array(
            'id' => array(
                'title' => __('ID', 'yit'),
                'type' => 'text',
                'std'  => ''
            )
        ),
        'hide' => true
    ),
    /* === PRICE TABLE === */
    'price_table' => array(
        'title' => __('Price table', 'yit' ),
        'description' =>  __('Create a table box of prices', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'attributes' => array(
            'type' => array(
                'title' => __('Type', 'yit'),
                'type' => 'select', // large|small
                'options' => array(
                    'large' => __('Large', 'yit'),
                    'small' => __('Small', 'yit')
                ),
                'std'  => ''
            ),
            'show_header' => array(
                'title' => __('Show Header', 'yit'),
                'type' => 'checkbox',
                'std'  => 'yes'
            ),
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => 'title'
            ),
            'price' => array(
                'title' => __('Price', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'href' => array(
                'title' => __('URL', 'yit'),
                'type' => 'text',
                'std'  => '#'
            ),
            'show_footer' => array(
                'title' => __('Show Footer', 'yit'),
                'type' => 'checkbox',
                'std'  => 'yes'
            ),
            'buttontext' => array(
                'title' => __('Text of button', 'yit'),
                'type' => 'text',
                'std'  => 'Show'
            ),
            'color' => array(
                'title' => __('Color of header', 'yit'),
                'type' => 'colorpicker',
                'std'  => ''
            ),
            'price_table_position' => array(
                'title' => __('Postion', 'yit'),
                'type' => 'select',
                'options'  => array(
                    'left' => __('Left', 'yit'),
                    'right' => __('Right', 'yit'),
                    'center' =>__('Center', 'yit'),
                ),
                'std' => 'center'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        ),
        'hide' => true
    ),
    /* === PRICING TABLE TICK === */
    'tick' => array(
        'title' => __('Pricing Table Tick', 'yit' ),
        'description' =>  __('Insert a tick on the price-table row', 'yit' ),
        'has_content' => false,
        'in_visual_composer' => true,
        'tab' => 'shortcodes',
        'attributes' => array(),
        'hide' => true
    ),
    /* === PRICE TABLE THREE COLUMNS === */
    'price_table_three' => array(
        'title' => __('Price table 3 columns', 'yit' ),
        'description' =>  __('Create a table box of prices', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        ),
        'code' => '[price_table_three]
    [price_table title="JUNIOR PLAN" price="$120/mo" href="#" buttontext="SIGNUP NOW" show_header="yes" show_footer="yes" price_table_position="left"][/price_table]
    [price_table type="larg e" title="HIGLIGHT PLAN" price="$170/mo" href="#" buttontext="SIGNUP NOW" show_header="yes" show_footer="yes" ][/price_table]
    [price_table title="ADVANCED PLAN" price="$250/mo" href="#" buttontext="SIGNUP NOW" show_header="yes" show_footer="yes" price_table_position="right"][/price_table]
    [/price_table_three]'
    ),

    /* === PRICE TABLE FOUR COLUMNS === */
    'price_table_four' => array(
        'title' => __('Price table 4 columns', 'yit' ),
        'description' =>  __('Create a table box of prices', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        ),
        'code' => '[price_table_four]
    [price_table title="FREE PLAN" price="for free" href="#" buttontext="SIGNUP NOW" show_header="yes" show_footer="yes"][/price_table]
    [price_table title="JUNIOR PLAN" price="$120/mo" href="#" buttontext="SIGNUP NOW" show_header="yes" show_footer="yes" price_table_position="left"][/price_table]
    [price_table type="large" title="HIGLIGHT PLAN" price="$170/mo href="#" buttontext="SIGNUP NOW" show_header="yes" show_footer="yes"][/price_table]
    [price_table title="ADVANCED PLAN" price="$250/mo" href="#" buttontext="SIGNUP NOW" show_header="yes" show_footer="yes" price_table_position="right"][/price_table]
[/price_table_four]'
    ),

    /* === YOUTUBE* === */
    'youtube' => array(
        'title' => __('Youtube video', 'yit'),
        'description' => __('Embed the player youtube video', 'yit'),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'video_id' => array(
                'title' => __('Video ID', 'yit'),
                'type' => 'text',
                'std' => ''
            ),
            'placeholder' => array(
                'title' => __('Placehold image url', 'yit'),
                'type' => 'checkbox',
                'std' => 'no'
            ),
            'placeholder_img' => array(
                'title' => __('Placehold image url', 'yit'),
                'type' => 'text',
                'std' => '',
                'deps' => array(
                    'ids' => 'placeholder',
                    'values' => '1'
                )
            ),
            'width' => array(
                'title' => __('Width', 'yit'),
                'type' => 'number',
                'std' => '640',
                'deps' => array(
                    'ids' => 'placeholder',
                    'values' => '0'
                )
            ),
            'height' => array(
                'title' => __('Height', 'yit'),
                'type' => 'number',
                'std' => '360',
                'deps' => array(
                    'ids' => 'placeholder',
                    'values' => '0'
                )
            ),
        )
    ),

    /* === VIMEO* === */
    'vimeo' => array(
        'title' => __('Vimeo video', 'yit' ),
        'description' =>  __('Embed the player vimeo video', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => false,
        'attributes' => array(
            'video_id' => array(
                'title' => __('Video ID', 'yit'),
                'type' => 'text',
                'std' => ''
            ),
            'placeholder' => array(
                'title' => __('Placehold image url', 'yit'),
                'type' => 'checkbox',
                'std' => 'no'
            ),
            'placeholder_img' => array(
                'title' => __('Placehold image url', 'yit'),
                'type' => 'text',
                'std' => '',
                'deps' => array(
                    'ids' => 'placeholder',
                    'values' => '1'
                )
            ),
            'width' => array(
                'title' => __('Width', 'yit'),
                'type' => 'number',
                'std' => '640',
                'deps' => array(
                    'ids' => 'placeholder',
                    'values' => '0'
                )
            ),
            'height' => array(
                'title' => __('Height', 'yit'),
                'type' => 'number',
                'std' => '360',
                'deps' => array(
                    'ids' => 'placeholder',
                    'values' => '0'
                )
            ),
        )
    ),

    /* === TWITTER === */
    'twitter' => array(
        'title' => __('Twitter', 'yit' ),
        'description' =>  __('Print a list of last tweets', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'username' => array(
                'title' => __('Username', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'consumer_key' => array(
                'title' => __('Consumer Key', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'consumer_secret' => array(
                'title' => __('Consumer Secret', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'access_token' => array(
                'title' => __('Access Token', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'access_token_secret' => array(
                'title' => __('Access Token Secret', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'items' => array(
                'title' => __('N. of items', 'yit'),
                'type' => 'number',
                'std'  => '5'
            ),
            'class' => array(
                'title' => __('CSS class', 'yit'),
                'type' => 'text',
                'std'  => 'last-tweets-widget'
            ),
            'time' => array(
                'title' => __('Time', 'yit'),
                'type' => 'checkbox',
                'std'  => 'yes'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === Accordion === */
    'accordion' => array(
        'title' => __('Accordion', 'yit' ),
        'description' =>  __('Create a accordion content', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => 'your_title'
            ),
            'opened' => array(
                'title' => __('Opened', 'yit'),
                'type' => 'checkbox',
                'std'  => 'no'
            ),
            'class_icon_closed' => array(
                'title' => __('Class Icon Closed', 'yit'),
                'type' => 'select-icon',
                'options' => $awesome_icons,
                'std'  => 'plus'
            ),
            'class_icon_opened' => array(
                'title' => __('Class Icon Opened', 'yit'),
                'type' => 'select-icon',
                'options' => $awesome_icons,
                'std'  => 'minus'
            ),
            'border' => array(
                'title' => __( 'Border', 'yit' ),
                'type' => 'select', // true|false
                'options' => array(
                    'true' => __('Yes', 'yit'),
                    'false' => __('No', 'yit')
                ),
                'std'  => 'true'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )

        )
    ),

    /* === TABLE === */
   /* 'table' => array(
        'title' => __('Table', 'yit' ),
        'description' =>  __('Create a table content', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'color' => array(
                'title' => __('Border Color', 'yit'),
                'type' => 'select', // white|red|grey|blue
                'options' => array(
                    'white' => __('White', 'yit'),
                    'red' => __('Red', 'yit'),
                    'grey' => __('Grey', 'yit'),
                    'blue' => __('Blue', 'yit'),
                ),
                'std'  => 'white'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),*/

    /* === SUCCESS BOX* === */
    'success' => array(
        'title' => __('Success box', 'yit' ),
        'description' =>  __('Show an example of success box alert', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === STYLE* === */
    'style' => array(
        'title' => __('Style text', 'yit' ),
        'description' =>  __('Style a text', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'attributes' => array(
            'color' => array (
                'title' => __('Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => ''
            )
        )
    ),

    /* === SPECIAL FONT* === */
    'special_font' => array(
        'title' => __('Special font', 'yit' ),
        'description' =>  __('Select a special font of text', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'attributes' => array(
            'size' => array(
                'title' => __('Size', 'yit'),
                'type' => 'number',
                'std'  => '12'
            ),
            'unit' => array(
                'title' => __('Unit', 'yit'),
                'type' => 'select', // px|%|em
                'options' => array(
                    'px' => __('px', 'yit'),
                    '%' => __('%', 'yit'),
                    'em' => __('em', 'yit')
                ),
                'std'  => 'px'
            )
        )
    ),

    /* === SOUNDCLOUD === */
    'soundcloud' => array(
        'title' => __( 'SoundCloud player', 'yit' ),
        'description' => __( 'Show the audio player of SoundCloud', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'iframe' => array(
                'title' => __( 'Use iFrame', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'url' => array(
                'title' => __( 'URL', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'auto_play' => array(
                'title' => __( 'Auto play', 'yit' ),
                'type' => 'checkbox',
                'std' => 'no'
            ),
            'show_comments' => array(
                'title' => __( 'Show comments (only for iFrame embed)', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'color' => array(
                'title' => __( 'Color (only for non iFrame embed)', 'yit' ),
                'type' => 'colorpicker',
                'std' => '#ff7700'
            ),
            'width' => array(
                'title' => __( 'Width', 'yit' ),
                'type' => 'width',
                'std' => 0,
                'has_content' => false,
            ),
        )
    ),

    /* === SIZE OF TEXT* === */
    'size' => array(
        'title' => __('Size of text', 'yit' ),
        'description' =>  __('Select a size of text', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'attributes' => array(
            'px' => array (
                'title' => __('Pixel', 'yit'),
                'type' => 'number',
                'std'  => ''
            ),
            'perc' => array (
                'title' => __('Percent', 'yit'),
                'type' => 'number',
                'std'  => ''
            ),
            'em' => array (
                'title' => __('Em', 'yit'),
                'type' => 'number',
                'std'  => ''
            )
        )
    ),

    /* === SHOW CODE === */
    'pre' => array(
        'title' => __('Show code', 'yit' ),
        'description' =>  __('Show code without execute it', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(

        ),
        'hide' => true
    ),

    /* === SHARE === */
    'share' => array(
        'title' => __( 'Share', 'yit' ),
        'description' => __( 'Print share buttons', 'yit' ),
        'has_content' => false,
        'in_visual_composer' => true,
        'tab' => 'shortcodes',
        'attributes' => array(
            'icon_share' => array(
                'title' => __('Icon', 'yit'),
                'type' => 'select-icon',
                'options' => $awesome_icons,
                'std'  => ''
            ),
            'title' => array(
                'title' => __( 'Title', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'socials' => array(
                'title' => __( 'Socials', 'yit' ),
                'type' => 'select',
                'multiple' => true,
                'options' => array(
                    'facebook' => __( 'Facebook', 'yit' ),
                    'twitter' => __( 'Twitter', 'yit' ),
                    'google' => __( 'Google+', 'yit' ),
                    'pinterest' => __( 'Pinterest', 'yit' )
                ),
                //'std' => serialize(array())
                'std' => 'facebook, twitter, google, pinterest, linkedin'
            ),
            'class' => array(
                'title' => __( 'CSS Class', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'size' => array(
                'title' => __('Size', 'yit'),
                'type' => 'select', // small|
                'options' => array(
                    'small' => __('Small', 'yit'),
                    '' => __('Normal', 'yit')
                ),
                'std'  => ''
            ),
            'icon_type' => array(
                'title' => __('Icon Type', 'yit'),
                'type'  => 'select',
                'options' => array(
                    'icon' => __('Icon', 'yit'),
                    'text' => __('Text', 'yit')
                ),
                'std' => 'icon',
            ) ,
            'show_in_cloud' => array(
                'title' => __('Show socials in cloud', 'yit'),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            )
        )
    ),

    /* === RECENT POST === */
    'recentpost' => array(
        'title' => __('Recent post box', 'yit' ),
        'description' =>  __('Shows last post of a specific category', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'items' => array(
                'title' => __('N. of items', 'yit'),
                'type' => 'number',
                'std'  => '3'
            ),
            'cat_name' => array(
                'title' => __('Category', 'yit'),
                'type' => 'select', // list of all categories
                'multiple' => true,
                'options' => $categories,
                'std'  => serialize( array() )
            ),
            'excerpt' => array(
                'title' => __( 'Show Excerpt', 'yit' ),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            ),
            'excerpt_length' => array(
                'title' => __('Limit words', 'yit'),
                'type' => 'number',
                'std'  => '20',
                'deps' => array(
                    'ids' => 'excerpt',
                    'values' => '1'
                )
            ),
            'readmore' => array(
                'title' => __('More text', 'yit'),
                'type' => 'text',
                'std'  => 'Read more...',
                'deps' => array(
                    'ids' => 'excerpt',
                    'values' => '1'
                )
            ),
            'showthumb' => array(
                'title' => __('Show Thumbnail', 'yit'),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            ),
            'date' => array(
                'title' => __( 'Show Date', 'yit' ),
                'type' => 'checkbox', // yes|no
                'std'  => 'true'
            ),
            'author' => array(
                'title' => __( 'Show Author', 'yit' ),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            ),
            'comments' => array(
                'title' => __( 'Show Comments', 'yit' ),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            ),
            'popular' => array(
                'title' => '',
                'type' => 'checkbox',
                'std' => 0,
                'hide' => true
            )
        )
    ),

    /* === RANDOM NUMBERS === */
    'random_numbers' => array(
        'title' => __('Random numbers', 'yit' ),
        'description' =>  __('Show a icon with a block text', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'icon_type' => array(
                'title' => __('Icon type', 'yit'),
                'type'  => 'select',
                'options' => array(
                    'theme-icon' => __('Theme Icon', 'yit'),
                    'custom' => __('Custom Icon', 'yit')
                ),
                'std' => 'theme-icon'
            ),
            'icon_theme' => array(
                'title' => __('Icon', 'yit'),
                'type' => 'select-icon',  // home|file|time|ecc
                'options' => $awesome_icons,
                'std'  => '',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),

            'icon_url' =>  array(
                'title' => __('Icon URL', 'yit'),
                'type' => 'text',
                'std'  => '',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'custom'
                )
            ),
            'icon_size' => array(
                'title' => __('Icon size', 'yit'),
                'type' => 'number',
                'min' => '9',
                'max' => '90',
                'std'  => '14',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'color' => array(
                'title' => __('Icon Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#797979',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'circle_size' => array(
                'title' => __('Circle Size', 'yit'),
                'type'  => 'number',
                'std' => '35',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )

            ),
            'text' => array(
                'title' => __('Text', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'number' => array(
                'title' => __('Number', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'last' => array(
                'title' => __('Last element', 'yit'),
                'type' => 'checkbox',
                'std'  => 'no'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === COUNTER === */
    'counter' => array(
        'title' => __('Counter', 'yit' ),
        'description' =>  __('Show ', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'text' => array(
                'title' => __('Text', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'text_color' => array(
                'title' => __('Text Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#000000',
            ),
            'text_size' => array(
                'title' => __('Text size', 'yit'),
                'type' => 'number',
                'std'  => '20'
            ),
            'number' => array(
                'title' => __('Number', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'number_size' => array(
                'title' => __('Number size', 'yit'),
                'type' => 'text',
                'std'  => '100'
            ),
            'number_color' => array(
                'title' => __('Number Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#f7c104'
            ),
            'percent' => array(
                'title' => __('Percent', 'yit'),
                'type' => 'checkbox',
                'std' => '1'
            ),
            'percent_color' => array(
                'title' => __('Percent Color', 'yit'),
                'type' => 'colorpicker',
                'std' => '#000000'
            ),
            'icon_type' => array(
                'title' => __('Icon type', 'yit'),
                'type'  => 'select',
                'options' => array(
                    'none' => __('None', 'yit'),
                    'theme-icon' => __('Theme Icon', 'yit'),
                    'custom' => __('Custom Icon', 'yit')
                ),
                'std' => 'none'
            ),
            'icon_theme' => array(
                'title' => __('Icon', 'yit'),
                'type' => 'select-icon',  // home|file|time|ecc
                'options' => $awesome_icons,
                'std'  => '',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),

            'icon_url' =>  array(
                'title' => __('Icon URL', 'yit'),
                'type' => 'text',
                'std'  => '',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'custom'
                )
            ),
            'icon_size' => array(
                'title' => __('Icon size', 'yit'),
                'type' => 'number',
                'min' => '9',
                'max' => '90',
                'std'  => '14',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'icon_color' => array(
                'title' => __('Icon Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#797979',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'animate' => array(
                'title' => __( 'Animate numbers', 'yit' ),
                'type' => 'checkbox',
                'std' => '1'
            ),

            'animation_start_number' => array(
                'title' => __( 'Start number', 'yit'),
                'type' => 'text',
                'std' => 0,
                'deps' => array(
                    'ids' => 'animate',
                    'values' => '1'
                )
            ),
            'animation_duration' => array(
                'title' => __( 'Animation duration (ms)', 'yit' ),
                'type' => 'text',
                'std' => 2000,
                'deps' => array(
                    'ids' => 'animate',
                    'values' => '1'
                )
            ),
            'animation_step' =>array(
                'title' => __( 'Animation step', 'yit' ),
                'type' => 'text',
                'std' => 10,
                'deps' => array(
                    'ids' => 'animate',
                    'values' => '1'
                )
            )
        )
    ),

    /* === PRINT SHORTCODE* === */
    'print_sc' => array(
        'title' => __('Print shortcode', 'yit' ),
        'description' =>  __('Show code without execute it', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'attributes' => array(

        ),
        'hide' => true
    ),

    /* === QUOTE === */
    'quote' => array(
        'title' => __('Quote', 'yit' ),
        'description' =>  __('Adds the content into a box quote', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'author' => array(
                'title' => __('Author', 'yit'),
                'type' => 'text',
                'std' => ''
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* == PRINT CLEAR === */
    'clear' => array(
        'title' => __('Print clear', 'yit' ),
        'description' =>  __('Print a clear, to undo the floating', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => false,
        'attributes' => array(
        )
    ),

    /* === PRICE === */
    'price' => array(
        'title' => __('Price box', 'yit' ),
        'description' =>  __('Create a box of prices', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => 'title'
            ),
            'price' => array(
                'title' => __('Price', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'price_separator' => array(
                'title' => __('Price Separator', 'yit'),
                'type' => 'select',
                'options' => array(
                    '.' => __('.', 'yit'),
                    ',' => __(',', 'yit')
                ),
                'std'  => '.'
            ),
            'price_prefix' => array(
                'title' => __('Price Prefix', 'yit'),
                'type' => 'text',
                'std'  => '$'
            ),
            'price_suffix' => array(
                'title' => __('Price Suffix', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'href' => array(
                'title' => __('URL', 'yit'),
                'type' => 'text',
                'std'  => '#'
            ),
            'buttontext' => array(
                'title' => __('Text of button', 'yit'),
                'type' => 'text',
                'std'  => 'Show'
            ),
            'textcolor' => array(
                'title' => __('Text Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#000000'
            ),
            'color' => array(
                'title' => __('Box Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#ffffff'
            ),
            'last' => array(
                'title' => __('Last element', 'yit'),
                'type' => 'checkbox',
                'std'  => 'no'
            ),
            'centered' => array(
                'title' => __('Centered', 'yit'),
                'type' => 'checkbox',
                'std'  => 'no'
            )
        )
    ),

    /* === POSTS LIST === */
    'posts' => array(
        'title' => __('Posts list', 'yit' ),
        'description' =>  __('Print list of posts', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'cat' => array(
                'title' => __('Category', 'yit'),
                'type' => 'select', // list of all category
                'multiple' => true,
                'options' => $categories,
                'std'  => serialize( array() )
            ),
            'show_description' => array(
                'title' => __('Show description', 'yit'),
                'type' => 'checkbox',
                'std'  => 'yes'
            ),
            'items' => array(
                'title' => __('N. of items', 'yit'),
                'type' => 'number',
                'std'  => '3'
            ),
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            )
        )
    ),

    /* === POPULAR POST === */
    'popularpost' => array(
        'title' => __('Popular post box', 'yit' ),
        'description' =>  __('Shows popular posts', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'items' => array(
                'title' => __('N. of items', 'yit'),
                'type' => 'number',
                'std'  => '3'
            ),
            'cat_name' => array(
                'title' => __('Category', 'yit'),
                'type' => 'select', // list of all categories
                'multiple' => true,
                'options' => $categories,
                'std'  => serialize( array() )
            ),
            'excerpt' => array(
                'title' => __( 'Show Excerpt', 'yit' ),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            ),
            'excerpt_length' => array(
                'title' => __('Limit words', 'yit'),
                'type' => 'number',
                'std'  => '20',
                'deps' => array(
                    'ids' => 'excerpt',
                    'values' => '1'
                )
            ),
            'readmore' => array(
                'title' => __('More text', 'yit'),
                'type' => 'text',
                'std'  => 'Read more...',
                'deps' => array(
                    'ids' => 'excerpt',
                    'values' => '1'
                )
            ),
            'showthumb' => array(
                'title' => __('Thumbnail', 'yit'),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            ),
            'date' => array(
                'title' => __( 'Show Date', 'yit' ),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            ),
            'author' => array(
                'title' => __( 'Show Author', 'yit' ),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            ),
            'comments' => array(
                'title' => __( 'Show Comments', 'yit' ),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === NUMBERS SECTION === */
    'numbers_sections' => array(
        'title' => __('Numbers sections', 'yit' ),
        'description' =>  __('Show a number background with a title and text', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'number' => array(
                'title' => __('Number', 'yit'),
                'type' => 'number',
                'std'  => '1'
            ),
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === INFO BOX* === */
    'info' => array(
        'title' => __('Info box', 'yit' ),
        'description' =>  __('Show an info box', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === LAST POST BOX === */
    'lastpost' => array(
        'title' => __('Last post box', 'yit' ),
        'description' =>  __('Shows last post of a specific category', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'icon' => array(
                'title' => __('Icon', 'yit'),
                'type' => 'select-icon', // box|calendars|ecc
                'options' => $awesome_icons,
                'std'  => ''
            ),
            'size' => array(
                'title' => __('Icon size', 'yit'),
                'type' => 'number', // 32|48
                'min' => 1,
                'max' => 99,
                'std'  => 32
            ),
            'color' => array(
                'title' => __( 'Icon color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '#b4b4b4'
            ),
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'class' => array(
                'title' => __('CSS class', 'yit'),
                'type' => 'text',
                'std'  => 'box-sections'
            ),
            'cat_name' => array(
                'title' => __('Category', 'yit'),
                'type' => 'select', // list of all categories
                'multiple' => true,
                'options' => $categories,
                'std'  => serialize( array() )
            ),
            'more_text' => array(
                'title' => __('More text', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'excerpt_lenght' => array(
                'title' => __('Excerpt lenght', 'yit'),
                'type' => 'number',
                'std' => 20,
                'min' => 1,
                'max' => 99
            ),
            'showdate' => array(
                'title' => __('Show date', 'yit'),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            ),
            'showtitle' => array(
                'title' => __('Show title', 'yit'),
                'type' => 'checkbox', // yes|no
                'std'  => 'no'
            ),
            'last' => array(
                'title' => __('Last element', 'yit'),
                'type' => 'checkbox',
                'std'  => 'no'
            )
        )
    ),

    /* === LOGGED USER === */
    'logged_user' => array(
        'title' => __( 'Logged user', 'yit' ),
        'description' => __( 'Show the username of the logged user with some option text before or after.', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'before' => array(
                'title' => __( 'Text before username', 'yit' ),
                'description' => __( 'HTML allowed.', 'yit' ),
                'type' => 'text',
                'std' => 'Hello '
            ),
            'after' => array(
                'title' => __( 'Text after username', 'yit' ),
                'description' => __( 'HTML allowed.', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'display' => array(
                'title' => __( 'Display', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'user_login' => __( 'Login', 'yit' ),
                    'user_email' => __( 'Email', 'yit' ),
                    'user_firstname' => __( 'First name', 'yit' ),
                    'user_lastname' => __( 'Last name', 'yit' ),
                    'first_last' => __( 'First and Last name', 'yit' ),
                    'last_first' => __( 'Last and First name', 'yit' ),
                    'display_name' => __( 'Display name', 'yit' ),
                    'ID' => __( 'ID', 'yit' )
                ),
                'std' => 'display_name'
            )
        )
    ),

    /* === LIST BULLET === */
    'list_bullet' => array(
        'title' => __('List bullet', 'yit' ),
        'description' =>  __('Show a list with bullet', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'icon' => array(
                'title' => __('Type of bullet', 'yit'),
                'type' => 'select-icon', // star|arrow|check|add|info
                'options' => $awesome_icons_with_null,
                'std'  => 'star'
            ),
            'icon_color' => array(
                'title' => __('Icon color', 'yit'),
                'type' => 'colorpicker',
                'std' => '#B4B4B4'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === NOTICE BOX* === */
    'notice' => array(
        'title' => __('Notice box', 'yit' ),
        'description' =>  __('Show a notice box', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === ERROR BOX* === */
    'error' => array(
        'title' => __('Error box', 'yit' ),
        'description' =>  __('Show an error box', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === CREDIT CARD === */
    'credit_card' => array(
        'title' => __('Credit card', 'yit' ),
        'description' =>  __('Show an images of credit cards', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'type' => array(
                'title' => __('Type', 'yit'),
                'type' => 'checklist',
                'options'  => array(
                    'amazon' => 'Amazon',
                    'amex' => 'American Express',
                    'amex_gold' => 'American Express Gold',
                    'amex_green' => 'American Express Green',
                    'amex_silver' => 'American Express Silver',
                    'apple' => 'Apple',
                    'bank' => 'Bank',
                    'cash' => 'Cash',
                    'chase' => 'Chase',
                    'coupon' => 'Coupon',
                    'credit' => 'Credit',
                    'debit' => 'Debit',
                    'discover' => 'Discover',
                    'discover_novus' => 'Discover Novus',
                    'echeck' => 'eCheck',
                    'generic_1' => 'Generic 1',
                    'generic_2' => 'Generic 2',
                    'generic_3' => 'Generic 3',
                    'gift' => 'Gift',
                    'gold' => 'Gold',
                    'googleckout' => 'Google Checkout',
                    'itunes' => 'iTunes (red)',
                    'itunes_2' => 'iTunes (blue)',
                    'itunes_3' => 'iTunes (green)',
                    'mastercard' => 'Mastercard',
                    'mileage' => 'Mileage',
                    'paypal' => 'PayPal',
                    'sapphire' => 'Sapphire',
                    'solo' => 'Solo',
                    'visa' => 'Visa'
                ),
                'std' => 'generic_1'
            ),
        )
    ),

    /* === HIGHLIGHT === */
    'highlight' => array(
        'title' => __('Highlight', 'yit' ),
        'description' =>  __('Text highlight', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => false,
        'attributes' => array(
            'text_color' => array(
                'title' => __('Text color', 'yit'),
                'type' => 'colorpicker',
                'std' => '#000'
            ),
            'background_color' => array(
                'title' => __('Text color', 'yit'),
                'type' => 'colorpicker',
                'std' => '#f7c104'
            )
        )
    ),

    /* === DROPCAP === */
    'dropcap' => array(
        'title' => __('Dropcap', 'yit' ),
        'description' =>  __('Format content, with big first letter', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => false,
        'attributes' => array(
        )
    ),

    /* === CONTACT INFO === */
    'contact_info' => array(
        'title' => __('Contact info', 'yit' ),
        'description' =>  __('Show a contact info', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => false,
        'attributes' => array(
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'subtitle' => array(
                'title' => __('Subtitle', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'address' => array(
                'title' => __('Address', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'address_icon' => array(
                'title' => __('Address icon', 'yit'),
                'type' => 'select-icon',
                'options' => $awesome_icons_with_null,
                'std'  => ''
            ),
            'phone' => array(
                'title' => __('Phone', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'phone_icon' => array(
                'title' => __('Phone icon', 'yit'),
                'type' => 'select-icon',
                'options' => $awesome_icons_with_null,
                'std'  => ''
            ),
            'mobile' => array(
                'title' => __('Mobile', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'mobile_icon' => array(
                'title' => __('Mobile icon', 'yit'),
                'type' => 'select-icon',
                'options' => $awesome_icons_with_null,
                'std'  => ''
            ),
            'fax' => array(
                'title' => __('Fax', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'fax_icon' => array(
                'title' => __('Fax icon', 'yit'),
                'type' => 'select-icon',
                'options' => $awesome_icons_with_null,
                'std'  => ''
            ),
            'email' => array(
                'title' => __('E-mail', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'email_icon' => array(
                'title' => __('E-mail icon', 'yit'),
                'type' => 'select-icon',
                'options' => $awesome_icons_with_null,
                'std'  => ''
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === BOX TITLE === */
    'box_title' => array(
        'title' => __('Box title', 'yit' ),
        'description' =>  __('Show a title centered with line', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => true,
        'attributes' => array(
            'class' => array(
                'title' => __('Class', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'subtitle' => array(
                'title' => __( 'Subtitle', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),

            'subtitle_font_size' => array(
                'title' => __( 'Subtitle Font size (px)', 'yit' ),
                'type' => 'text',
                'min' => 1,
                'max' => 99,
                'std' => 15
            ),
            'font_size' => array(
                'title' => __( 'Title Font size (px)', 'yit' ),
                'type' => 'number',
                'min' => 1,
                'max' => 99,
                'std' => 15
            ),
            'font_alignment' => array(
                'title' => __( 'Font alignment', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'left' => __( 'Left', 'yit' ),
                    'right' => __( 'Right', 'yit' ),
                    'center' => __( 'Center', 'yit' )
                ),
                'std' => 'center'
            ),
            'border' => array(
                'title' => __('Border', 'yit'),
                'type' => 'select',
                'options' => array(
                    'bottom' => __('Bottom', 'yit'),
                    'middle' => __('Middle', 'yit'),
                    'around' => __('Around', 'yit'),
                    'none' => __('none', 'yit')
                ),
                'std'  => 'middle'
            ),
            'border_color' => array(
                'title' => __('Border Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#CDCDCD'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )        )
    ),


    /* === BUTTON === */
    'button' => array(
        'title' => __('Button', 'yit' ),
        'description' =>  __('Show a simple custom button', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(

            'href' => array(
                'title' => __('URL', 'yit'),
                'type' => 'text',
                'std'  => '#'
            ),
            'target' => array(
                'title' => __('Target', 'yit'),
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'yit'),
                    '_blank' => __('Blank', 'yit'),
                    '_parent' => __('Parent', 'yit'),
                    '_top' => __('Top', 'yit')
                ),
                'std'  => ''
            ),
            'color' => array(
                'title' => __('Color', 'yit'),
                'description' => __( 'You can find the buttons list', 'yit' ),
                'type' => 'select', // btn-view-over-the-town-1|btn-the-bizzniss-1|btn-french-1|ecc
                'options' => apply_filters( 'yit_button_style' , '' ),//apply_filters( 'yit_button_style' , $button_style ),
                'std'  => 'flat'
            ),
            'dimension' => array(
                'title' => __('Width', 'yit'),
                'type' => 'select',  // large|normal|small|mini
                'options' => array(
                    'large' => __('Large', 'yit'),
                    'normal' => __('Normal', 'yit'),
                    'small' => __('Small', 'yit'),
                    'mini' => __('Mini', 'yit')
                ),
                'std'  => 'normal',
            ),

            'icon' => array(

                'title' => __('Icon', 'yit'),
                'type' => 'select-icon',  // home|file|time|ecc
                'options' => $awesome_icons_with_null,
                'std'  => ''
            ),
            'icon_size' => array(
                'title' => __('Icon size', 'yit'),
                'type' => 'number',
                'std'  => '12'
            ),
            'animation' => array(
                'title' => __('Icon Animation', 'yit'),
                'type' => 'select',
                'options' => array(
                    '' => __('None', 'yit'),
                    'RtL' => __('Right to Left', 'yit'),
                    'LtR' => __('Left to Right', 'yit'),
                    'CtL' => __('Center to Left', 'yit'),
                    'CtR' => __('Center to Right', 'yit'),
                    'UtC' => __('Up to Center', 'yit'),
                    'LtC' => __('Left to Center', 'yit'),
                    'RtC' => __('Right to Center', 'yit'),
                ),
                'std'  => ''
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            ),
            'class' => array(
                'title' => __('CSS class', 'yit'),
                'type' => 'text',
                'std'  => ''
            )
        ),
    ),
    /* === EASY PIE CHART === */
    'pie_chart' => array(
        'title' => __('Pie Chart', 'yit' ),
        'description' =>  __('Animated Pie Chart', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'percent' => array(
                'title' => __('Percent', 'yit'),
                'type' => 'number',
                'min'  => 0,
                'max'  => 100,
                'std'  => '75',
            ),
            'barcolor' => array(
                'title' => __('Bar color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#ef1e25',
            ),
            'trackcolor' => array(
                'title' => __('Track Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#f2f2f2',
            ),
            'line_width' => array(
                'title' => __('Line Width', 'yit'),
                'type'  => 'number',
                'std'   => '3',
                'min'  => 0,
                'max'  => 10,
            ),
            'size' => array(
                'title' => __('Size', 'yit'),
                'type'  => 'number',
                'std'   => '150',
            ),
            'font_size' => array(
                'title' => __('Font Size (px)', 'yit'),
                'type' => 'number',
                'std'  => '12'
            ),
            'bar_animate' => array(
                'title' => __('Bar animate', 'yit'),
                'type'  => 'text',
                'std'   => '2000'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            ),

        )
    ),

    /* === PROGRESS BAR === */
    'progress_bar' => array(
        'title' => __('Progress Bar', 'yit' ),
        'description' =>  __('Animated Bar', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => false,
        'attributes' => array(
            'title' => array(
                'title' => __('Bar Name', 'yit'),
                'type' => 'text',
                'std'  => '',
            ),
            'percent' => array(
                'title' => __('Percent', 'yit'),
                'type' => 'number',
                'min'  => 0,
                'max'  => 100,
                'std'  => '75',
            ),
            'barcolor' => array(
                'title' => __('Bar color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#ef1e25',
            ),
            'trackcolor' => array(
                'title' => __('Track Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#f2f2f2',
            ),
            'line_height' => array(
                'title' => __('Line Height', 'yit'),
                'type'  => 'number',
                'std'   => '20',
                'min'  => 0,
                'max'  => 10,
            ),
            'font_size' => array(
                'title' => __('Font Size (px)', 'yit'),
                'type' => 'number',
                'std'  => '12'
            ),
            'font_color' => array(
                'title' => __('Font Color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '#000000'
            ),
            'text_position' => array(
                'title' => __('Text Position', 'yit'),
                'type' => 'select',
                'options' => array(
                    'before' => __('Before', 'yit'),
                    'inside' => __('Inside', 'yit'),
                    'after' => __('After', 'yit'),
                ),
                'std'  => 'before'
            ),
            'speed' => array(
                'title' => __('Speed', 'yit'),
                'type' => 'select',
                'options' => array(
                    'fast' => __('Fast (1s)', 'yit'),
                    'normal' => __('Normal (2s)', 'yit'),
                    'slow' => __('Slow (3s)', 'yit'),
                ),
                'std'  => 'normal'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === BANNER === */
    'banner' => array(
        'title' => __( 'Animated Banner', 'yit' ),
        'description' => __( 'Print a banner', 'yit' ),
        'has_content' => false,
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'attributes' => array(
            'type' => array(
                'title' => __( 'Type', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'switch-text' => __( 'Switch texts', 'yit' ),
                    'zoom-left' => __( 'Zoom from left', 'yit' ),
                    'zoom-icon' => __( 'Zoom icon', 'yit' ),
                    'top-entry' => __( 'Top entry', 'yit' ),
                    'left-entry-zoom' => __( 'Left entry and zoom', 'yit' ),
                    'rotate-zoom' => __( 'Rotate and zoom', 'yit' ),
                    'zoom-box' => __( 'Zoom box', 'yit' ),
                    'small-to-big' => __( 'Small to big icon', 'yit' )
                ),
                'std' => 'switch-text'
            ),
            'width' => array(
                'title' => __( 'Width (in px. 0 = 100%)', 'yit' ),
                'type' => 'number',
                'std' => '0'
            ),
            'height' => array(
                'title' => __( 'Height (in px)', 'yit' ),
                'type' => 'number',
                'std' => '100'
            ),
            'url' => array(
                'title' => __( 'Link URL', 'yit' ),
                'type' => 'text',
                'std' => '#'
            ),
            'target' => array(
                'title' => __( 'Open in a new window', 'yit' ),
                'type' => 'checkbox',
                'std' => 'no'
            ),
            'title' => array(
                'title' => __( 'Title', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'subtitle' => array(
                'title' => __( 'Sub title', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'icon' => array(
                'title' => __( 'Icon', 'yit' ),
                'type' => 'select-icon',
                'options' => $awesome_icons_with_null,
                'std' => ''
            ),
            'style' => array(
                'title' => __( 'Predefinied style', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'no' => __( 'Custom style', 'yit' ),
                    'grey' => __( 'Grey', 'yit' ),
                    'orange' => __( 'Orange', 'yit' )
                ),
                'std' => 'no'
            ),
            'title_size' => array(
                'title' => __( 'Title size (in px)', 'yit' ),
                'type' => 'number',
                'std' => '14',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'title_size_hover' => array(
                'title' => __( 'Title hover size (in px)', 'yit' ),
                'type' => 'number',
                'std' => '11',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'subtitle_size' => array(
                'title' => __( 'Subtitle size (in px)', 'yit' ),
                'type' => 'number',
                'std' => '11',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'subtitle_size_hover' => array(
                'title' => __( 'Subtitle hover size (in px)', 'yit' ),
                'type' => 'number',
                'std' => '14',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'icon_size' => array(
                'title' => __( 'Icon size (in px)', 'yit' ),
                'type' => 'number',
                'std' => '35',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'icon_size_hover' => array(
                'title' => __( 'Icon hover size (in px)', 'yit' ),
                'type' => 'number',
                'std' => '50',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'background' => array(
                'title' => __( 'Background color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'background_image' => array(
                'title' => __( 'Background image URL', 'yit' ),
                'type' => 'text',
                'std' => '',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'border' => array(
                'title' => __( 'Border color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'color_icon' => array(
                'title' => __( 'Icon color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'color_title' => array(
                'title' => __( 'Title color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'color_subtitle' => array(
                'title' => __( 'Subtitle color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'background_hover' => array(
                'title' => __( 'Background hover color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'border_hover' => array(
                'title' => __( 'Border hover color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'color_icon_hover' => array(
                'title' => __( 'Icon hover color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'color_title_hover' => array(
                'title' => __( 'Title hover color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'color_subtitle_hover' => array(
                'title' => __( 'Subtitle hover color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '',
                'deps' => array(
                    'ids' => 'style',
                    'values' => 'no'
                )
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === ALERT BOX* === */
    'alert' => array(
        'title' => __('Alert box', 'yit' ),
        'description' =>  __('Show an alert box', 'yit' ),

        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),

    /* === ADD SPACE* === */
    'space' => array(
        'title' => __('Add space', 'yit' ),
        'description' =>  __('Print a space', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'height' => array(
                'title' => 'Height of space box in px',
                'type' => 'number',
                'min' => 0,
                'max' => 999,
                'std' => 30
            )
        )
    ),

    /* === THREE / FOURTH* === */
    'three_fourth' => array(
        'title' => __('3/4 Column', 'yit' ),
        'description' =>  __('Create three column of a quarter', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'attributes' => array(
            'class' => array(
                'title' => __('CSS class', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'last' => array(
                'title' => __('Last element', 'yit'),
                'type' => 'checkbox',
                'std'  => 'no'
            )
        )
    ),

    /* === TWO / FOURTH* === */
    'two_fourth' => array(
        'title' => __('2/4 Column', 'yit' ),
        'description' =>  __('Create a content in two column of a quarter', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'attributes' => array(
            'class' => array(
                'title' => __('CSS class', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'last' => array(
                'title' => __('Last element', 'yit'),
                'type' => 'checkbox',
                'std'  => 'no'
            )
        )
    ),

    /* === TWO / THIRD* === */
    'two_third' => array(
        'title' => __('2/3 Column', 'yit' ),
        'description' =>  __('Create a content in two column of a third', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'attributes' => array(
            'class' => array(
                'title' => __('CSS class', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'last' => array(
                'title' => __('Last element', 'yit'),
                'type' => 'checkbox',
                'std'  => 'no'
            )
        )
    ),

    /* === ONE FOURTH* === */
    'one_fourth' => array(
        'title' => __('1/4 Column', 'yit' ),
        'description' =>  __('Create one column of a quarter', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'attributes' => array(
            'class' => array(
                'title' => __('CSS class', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'last' => array(
                'title' => __('Last element', 'yit'),
                'type' => 'checkbox',
                'std'  => 'no'
            )
        )
    ),

    /* === ONE THIRD* === */
    'one_third' => array(
        'title' => __('1/3 Column', 'yit' ),
        'description' =>  __('Create one column of a third', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'attributes' => array(
            'class' => array(
                'title' => __('CSS class', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'last' => array(
                'title' => __('Last element', 'yit'),
                'type' => 'checkbox',
                'std'  => 'no'
            )
        )
    ),

    /* === SOCIAL === */
    'social' => array(
        'title' => __('Social', 'yit' ),
        'description' =>  __('Print a simple icon link for social', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'icon_type' => array(
                'title' => __('Icon Type', 'yit'),
                'type'  => 'select',
                'options' => array(
                    'icon' => __('Icon', 'yit'),
                    'text' => __('Text', 'yit')
                ),
                'std' => 'icon',
            ),
            'icon_social' => array(
                'title' => __('Icon', 'yit'),
                'type' => 'select-icon',
                'options' => $awesome_icons_socials,
                'std'  => 'f09a',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'icon'
                )
            ),
            'icon_size' => array(
                'title' => __('Icon size', 'yit'),
                'type' => 'number',
                'min' => '9',
                'max' => '90',
                'std'  => '14',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'icon'
                )
            ),
            'color' => array(
                'title' => __('Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#b1b1b1',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'icon'
                )
            ),
            'color_hover' => array(
                'title' => __('Color on Hover', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#000000',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'icon'
                )
            ),
            'circle' => array(
                'title' => __('Circle', 'yit'),
                'type'  => 'select',
                'options' => array(
                    'yes' => __('Yes', 'yit'),
                    'no' => __('No', 'yit')
                ),
                'std' => 'no',
                'deps' => array(
                    'ids' => 'icon_type',
                    'values' => 'icon'
                )
            ),
            'circle_size' => array(
                'title' => __('Circle Size', 'yit'),
                'type'  => 'number',
                'std' => '35',
                'deps' => array(
                    'ids' => 'circle',
                    'values' => 'yes'
                )

            ),
            'circle_border_size' => array(
                'title' => __('Circle Border Width', 'yit'),
                'type'  => 'number',
                'std' => '2',
                'deps' => array(
                    'ids' => 'circle',
                    'values' => 'yes'
                )

            ),
            'href' => array(
                'title' => __('URL', 'yit'),
                'type' => 'text',
                'std'  => '#'
            ),
            'target' => array(
                'title' => __('Target', 'yit'),
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'yit'),
                    '_blank' => __('Blank', 'yit'),
                    '_parent' => __('Parent', 'yit'),
                    '_top' => __('Top', 'yit')
                ),
                'std'  => ''
            ),
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'class' => array(
                'title' => __('Class', 'yit'),
                'type' => 'text',
                'std'  => ''
            )
        )
    ) ,
    /* === GOOGLE MAPS === */
    'googlemap' => array(
        'title' => __('Google Maps', 'yit' ),
        'description' =>  __('Print the google map box', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'width' => array(
                'title' => __('Width', 'yit'),
                'type' => 'number',
                'std'  => ''
            ),
            'height' => array(
                'title' => __('Height', 'yit'),
                'type' => 'number',
                'std'  => ''
            ),
            'src' => array(
                'title' => __('URL', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ) ,

    /* === CODE === */

    'code' => array(
        'title' => __('Code', 'yit' ),
        'description' =>  __('Shows a formatted code text', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => true,
        'attributes' => array()
    ),
    /* === SECTION BACKGROUND === */
    'section_background' => array(
        'title' => __('Section with background', 'yit' ),
        'description' =>  __('Create section with a custom background', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'background_type' => array(
                'title' => __('Background Type', 'yit'),
                'type' => 'select',
                'options' => array(
                    'color' => __('Color', 'yit'),
                    'image' => __('Image', 'yit'),
                ),
                'std'  => 'color'
            ),
            'background_color' => array(
                'title' => __('Background Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#ffffff',
                'deps' => array(
                    'ids' => 'background_type',
                    'values' => 'color'
                )
            ),
            'background_image' => array(
                'title' => __('Background Image Url', 'yit'),
                'type' => 'text',
                'std'  => '',
                'deps' => array(
                    'ids' => 'background_type',
                    'values' => 'image'
                )
            ),
            'height' => array(
                'title' => __('Height', 'yit'),
                'type' => 'number',
                'std'  => ''
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
			'animation_delay' => array(
				'title' => __('Animation Delay', 'yit'),
				'type' => 'text',
				'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
				'std'  => '0'
			),
			'with_content' => array(
				'title' => __('With content', 'yit'),
				'type' => 'checkbox',
				'desc' => __('Define if you want set the content within this section, by adding a new row in your page.', 'yit'),
				'std'  => 'yes'
			)
        )
    )

);