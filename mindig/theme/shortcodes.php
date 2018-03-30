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
 * Return the list of shortcodes and their settings
 *
 * @package Yithemes
 * @author  Francesco Licandro  <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


$config          = YIT_Plugin_Common::load();
$awesome_icons   = YIT_Plugin_Common::get_awesome_icons();
$animate         = $config['animate'];
$shop_shortcodes = array();

$theme_shortcodes = array(

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

    /* ====== ONE PAGE ANCHOR ======== */
    'onepage_anchor' => array(
        'title' => __( 'OnePage Anchor', 'yit' ),
        'description' => __( 'Add the anchor for your OnePage', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'name' => array(
                'title' => __('Name anchor (the name of anchor you define in the menu with #)', 'yit'),
                'type' => 'text',
                'std'  => ''
            )
        )

    ),

    /* === MODAL === */
    'modal'        => array(
        'title'              => __( 'Modal Window', 'yit' ),
        'description'        => __( 'Create a modal window', 'yit' ),
        'tab'                => 'shortcodes',
        'in_visual_composer' => true,
        'has_content'        => true,
        'attributes'         => array(
            'title'              => array(
                'title' => __( 'Modal Title', 'yit' ),
                'type'  => 'text',
                'std'   => __( 'Your title here', 'yit' )
            ),
            'opener'             => array(
                'title'   => __( 'Type of modal opener', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'button' => __( 'Button', 'yit' ),
                    'text'   => __( 'Textual Link', 'yit' ),
                    'image'  => __( 'Image', 'yit' )
                ),
                'std'     => 'button'
            ),
            'button_text_opener' => array(
                'title' => __( 'Text of the button', 'yit' ),
                'type'  => 'text',
                'std'   => __( 'Open Modal', 'yit' ),
                'deps'  => array(
                    'ids'    => 'opener',
                    'values' => 'button'
                )
            ),
            'button_style'       => array(
                'title'   => __( 'Style of the button', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'normal'      => __( 'Normal', 'yit' ),
                    'alternative' => __( 'Alternative', 'yit' )
                ),
                'std'     => 'normal',
                'deps'    => array(
                    'ids'    => 'opener',
                    'values' => 'button'
                )
            ),
            'link_text_opener'   => array(
                'title' => __( 'Text of the link', 'yit' ),
                'type'  => 'text',
                'std'   => __( 'Open Modal', 'yit' ),
                'deps'  => array(
                    'ids'    => 'opener',
                    'values' => 'text'
                )
            ),
            'link_icon_type'     => array(
                'title'   => __( 'Icon type', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'none'       => __( 'None', 'yit' ),
                    'theme-icon' => __( 'Theme Icon', 'yit' ),
                    'custom'     => __( 'Custom Icon', 'yit' )
                ),
                'std'     => 'none',
                'deps'    => array(
                    'ids'    => 'opener',
                    'values' => 'text'
                )
            ),
            'link_icon_theme'    => array(
                'title'   => __( 'Icon', 'yit' ),
                'type'    => 'select-icon', // home|file|time|ecc
                'options' => $awesome_icons,
                'std'     => '',
                'deps'    => array(
                    'ids'    => 'link_icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'link_icon_url'      => array(
                'title' => __( 'Icon URL', 'yit' ),
                'type'  => 'text',
                'std'   => '',
                'deps'  => array(
                    'ids'    => 'link_icon_type',
                    'values' => 'custom'
                )
            ),
            'link_text_size'     => array(
                'title' => __( 'Font size of the link', 'yit' ),
                'type'  => 'number',
                'std'   => 17,
                'min'   => 1,
                'max'   => 99,
                'deps'  => array(
                    'ids'    => 'opener',
                    'values' => 'text'
                )
            ),
            'image_opener'       => array(
                'title' => __( 'Url of the image', 'yit' ),
                'type'  => 'text',
                'std'   => '',
                'deps'  => array(
                    'ids'    => 'opener',
                    'values' => 'image'
                )
            ),
        )
    ),

    /*================= FEATURED COLUMNS ================*/
    'featured_column' =>  array(
        'title' => __( 'Featured Columns', 'yit' ),
        'description' => __( 'Print a column with image, description and button', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'create' => true,
        'attributes' => array(
            'title' => array(
                'title' => __( 'Title', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'subtitle' => array(
                'title' => __( 'Subtitle', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'show_button' => array(
                'title' => __( 'Show Button', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),

            'label_button' => array(
                'title' => __( 'Label Button', 'yit' ),
                'type' => 'text',
                'std' => '',
                'deps' => array(
                    'ids' => 'show_button',
                    'values' => '1'
                )
            ),
            'url_button' => array(
                'title' => __( 'Url Button', 'yit' ),
                'type' => 'text',
                'std' => '',
                'deps' => array(
                    'ids' => 'show_button',
                    'values' => '1'
                )
            ),

            'background_image' => array(
                'title' => __( 'Background image URL', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'first' => array(
                'title' => __( 'First column?', 'yit' ),
                'type' => 'checkbox',
                'std' => 'no'
            ),
            'last' => array(
                'title' => __( 'Last Columns?', 'yit' ),
                'type' => 'checkbox',
                'std' => 'no'
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

    /*================= PARALLAX ================*/
    'parallax'     => array(
        'title'              => __( 'Parallax effect', 'yit' ),
        'description'        => __( 'Create a fancy full-width parallax effect', 'yit' ),
        'tab'                => 'shortcodes',
        'has_content'        => true,
        'in_visual_composer' => true,
        'create'             => true,
        'attributes'         => array(
            'height'             => array(
                'title' => __( 'Container height', 'yit' ),
                'type'  => 'number',
                'std'   => 300
            ),
            'image'              => array(
                'title' => __( 'Background Image URL', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'valign'             => array(
                'title'   => __( 'Vertical Align', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'top'    => __( 'Top', 'yit' ),
                    'center' => __( 'Center', 'yit' ),
                    'bottom' => __( 'Bottom', 'yit' ),
                ),
                'std'     => 'center'
            ),
            'halign'             => array(
                'title'   => __( 'Horizontal Align', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'left'   => __( 'Left', 'yit' ),
                    'center' => __( 'Center', 'yit' ),
                    'right'  => __( 'Right', 'yit' ),
                ),
                'std'     => 'center'
            ),
            'font_p'             => array(
                'title' => __( 'Paragraph Font Size', 'yit' ),
                'type'  => 'number',
                'std'   => 24
            ),
            'color'              => array(
                'title' => __( 'Content Text Color', 'yit' ),
                'type'  => 'colorpicker',
                'std'   => '#ffffff'
            ),
            'overlay_opacity'    => array(
                'title'       => __( 'Overlay', 'yit' ),
                'description' => __( 'Set an opacity of overlay (0-100)', 'yit' ),
                'type'        => 'number',
                'std'         => '0'
            ),
            'border_bottom'      => array(
                'title'       => __( 'Border Bottom', 'yit' ),
                'description' => __( 'Set a size for border bottom (0-10)', 'yit' ),
                'type'        => 'number',
                'min'         => 0,
                'max'         => 10,
                'std'         => '0'
            ),
            'effect'             => array(
                'title'   => __( 'Effect', 'yit' ),
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
                'std'     => 'fadeIn'
            ),

            'video_upload_mp4'   => array(
                'title' => __( 'Video Mp4', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'video_upload_ogg'   => array(
                'title' => __( 'Video Ogg', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'video_upload_webm'  => array(
                'title' => __( 'Video Webm', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'video_button'       => array(
                'title'       => __( 'Add a button', 'yit' ),
                'description' => __( 'Add a button to see a video in a lightbox', 'yit' ),
                'type'        => 'checkbox',
                'std'         => 'no'
            ),
            'video_button_style' => array(
                'title'       => __( 'Video button style', 'yit' ),
                'description' => __( 'Choose a style for video button', 'yit' ),
                'type'        => 'select',
                'options'     => yit_button_style(),
                'std'         => 'ghost'
            ),
            'video_url'          => array(
                'title'       => __( 'Video URL', 'yit' ),
                'description' => __( 'Paste the url of the video that will be opened in the lightbox', 'yit' ),
                'type'        => 'text',
                'std'         => ''
            ),
            'label_button_video' => array(
                'title'       => __( 'Button Label', 'yit' ),
                'description' => __( 'Add the label of the button', 'yit' ),
                'type'        => 'text',
                'std'         => ''
            )
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
            'address_title' => array(
                'title' => __('Address Title', 'yit'),
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
                'type' => 'text',
                'std'  => ''
            ),

            'phone_title' => array(
                'title' => __('Phone Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),

            'phone' => array(
                'title' => __('Phone', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),

            'phone_icon' => array(
                'title' => __('Phone icon', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'mobile_title' => array(
                'title' => __('Mobile Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'mobile' => array(
                'title' => __('Mobile', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'mobile_icon' => array(
                'title' => __('Mobile icon', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'fax_title' => array(
                'title' => __('Fax Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'fax' => array(
                'title' => __('Fax', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'fax_icon' => array(
                'title' => __('Fax icon', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'email_title' => array(
                'title' => __('E-mail Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'email' => array(
                'title' => __('E-mail text', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'email_icon' => array(
                'title' => __('E-mail icon', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'email_link' => array(
                'title' => __('E-mail link', 'yit'),
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


    /* === GOOGLE MAPS === */
    'googlemap'    => array(
        'title'              => __( 'Google Maps', 'yit' ),
        'description'        => __( 'Print the google map box', 'yit' ),
        'tab'                => 'shortcodes',
        'in_visual_composer' => true,
        'has_content'        => false,
        'attributes'         => array(
            'full_width'      => array(
                'title' => __( 'Full Width', 'yit' ),
                'type'  => "checkbox",
                'std'   => 'yes'
            ),
            'width'           => array(
                'title' => __( 'Width', 'yit' ),
                'type'  => 'number',
                'std'   => '',
                'deps'  => array(
                    'ids'    => 'full_width',
                    'values' => '0'
                )
            ),
            'height'          => array(
                'title' => __( 'Height', 'yit' ),
                'type'  => 'number',
                'std'   => ''
            ),
            'src'             => array(
                'title' => __( 'URL', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'logo'            => array(
                'title' => __( 'Logo', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'address'         => array(
                'title' => __( 'Address', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'info'            => array(
                'title' => __( 'Info', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'animate'         => array(
                'title'   => __( 'Animation', 'yit' ),
                'type'    => 'select',
                'options' => $animate,
                'std'     => ''
            ),
            'animation_delay' => array(
                'title' => __( 'Animation Delay', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                'std'   => '0'
            )
        )
    ),

    /*================= BLOG SECTION =================*/
    'blog_section' => array(
        'title'              => __( 'Blog', 'yit' ),
        'description'        => __( 'Print a blog section', 'yit' ),
        'tab'                => 'section',
        'has_content'        => false,
        'in_visual_composer' => true,
        'create'             => true,
        'attributes'         => array(
            'nitems'            => array(
                'title'       => __( 'Number of items', 'yit' ),
                'description' => __( '-1 to show all elements', 'yit' ),
                'type'        => 'number',
                'min'         => - 1,
                'max'         => 99,
                'std'         => - 1
            ),
            'ncolumns'          => array(
                'title'       => __( 'Number of columns', 'yit' ),
                'description' => __( 'Select number of columns to show', 'yit' ),
                'type'        => 'select',
                'options'     => array(
                    1 => 'One Column',
                    2 => 'Two Columns',
                    3 => 'Three Columns'
                ),
                'std'         => 1
            ),
            'enable_thumbnails' => array(
                'title' => __( 'Show Thumbnails', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            ),
            'enable_date'       => array(
                'title' => __( 'Show Date', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            ),
            'enable_title'      => array(
                'title' => __( 'Show Title', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            ),
            'enable_author'     => array(
                'title' => __( 'Show Author', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            ),
            'enable_comments'   => array(
                'title' => __( 'Show Comments', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            )
        )
    ),
    /* === TEASER === */
    'teaser'       => array(
        'title'              => __( 'Teaser', 'yit' ),
        'description'        => __( 'Create a banner with an image, a link and text.', 'yit' ),
        'tab'                => 'shortcode',
        'has_content'        => false,
        'multiple'           => false,
        'unlimited'          => false,
        'in_visual_composer' => false,
        'hide'               => true,
        'attributes'         => array(
            'title'           => array(
                'title' => __( 'Title', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'subtitle'        => array(
                'title' => __( 'Subtitle', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'image'           => array(
                'title' => __( 'Image URL', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'link'            => array(
                'title' => __( 'Link', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'button'          => array(
                'title' => __( 'Label button', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'slogan_position' => array(
                'title'   => __( 'Slogan Position', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'top'    => __( 'Top', 'yit' ),
                    'center' => __( 'Center', 'yit' ),
                    'bottom' => __( 'Bottom', 'yit' ),
                ),
                'std'     => ''
            ),
            'animate'         => array(
                'title'   => __( 'Animation', 'yit' ),
                'type'    => 'select',
                'options' => $animate,
                'std'     => ''
            ),
            'animation_delay' => array(
                'title' => __( 'Animation Delay', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                'std'   => '0'
            )
        )
    ),


    /* === RECENT POST === */
    'recentpost'   => array(
        'title'              => __( 'Recent post box', 'yit' ),
        'description'        => __( 'Shows last post of a specific category', 'yit' ),
        'tab'                => 'shortcodes',
        'has_content'        => false,
        'in_visual_composer' => true,
        'attributes'         => array(
            'items'           => array(
                'title' => __( 'N. of items', 'yit' ),
                'type'  => 'number',
                'std'   => '3'
            ),
            'cat_name'        => array(
                'title'    => __( 'Category', 'yit' ),
                'type'     => 'select', // list of all categories
                'multiple' => true,
                'options'  => $categories,
                'std'      => serialize( array() )
            ),
            'excerpt'         => array(
                'title' => __( 'Show Excerpt', 'yit' ),
                'type'  => 'checkbox', // yes|no
                'std'   => 'no'
            ),
            'excerpt_length'  => array(
                'title' => __( 'Limit words', 'yit' ),
                'type'  => 'number',
                'std'   => '20',
                'deps'  => array(
                    'ids'    => 'excerpt',
                    'values' => '1'
                )
            ),
            'readmore'        => array(
                'title' => __( 'More text', 'yit' ),
                'type'  => 'text',
                'std'   => '',
                'deps'  => array(
                    'ids'    => 'excerpt',
                    'values' => '1'
                )
            ),
            'showthumb'       => array(
                'title' => __( 'Show Thumbnail', 'yit' ),
                'type'  => 'checkbox', // yes|no
                'std'   => 'no'
            ),
            'date'            => array(
                'title' => __( 'Show Date', 'yit' ),
                'type'  => 'checkbox', // yes|no
                'std'   => 'true',
                'deps'  => array(
                    'ids' => 'showthumb',
                    'values' => '1'
                )
            ),
            'show_categories' => array(
                'title' => __( 'Show Categories', 'yit' ),
                'type'  => 'checkbox', // yes|no
                'std'   => 'true'
            ),
            'show_tags'       => array(
                'title' => __( 'Show Tags', 'yit' ),
                'type'  => 'checkbox', // yes|no
                'std'   => 'true'
            ),
            'author'          => array(
                'title' => __( 'Show Author', 'yit' ),
                'type'  => 'checkbox', // yes|no
                'std'   => 'no'
            ),
            'comments'        => array(
                'title' => __( 'Show Comments', 'yit' ),
                'type'  => 'checkbox', // yes|no
                'std'   => 'no'
            ),
            'animate'         => array(
                'title'   => __( 'Animation', 'yit' ),
                'type'    => 'select',
                'options' => $animate,
                'std'     => ''
            ),
            'animation_delay' => array(
                'title' => __( 'Animation Delay', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                'std'   => '0'
            ),
            'popular' => array(
                'title' => '',
                'type' => 'checkbox',
                'std' => '0',
                'hide' => true
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
                'std'  => 'no',
                'deps' => array(
                    'ids' => 'showthumb',
                    'values' => '1'
                )
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

    /*================= SEPARATOR ================*/
    'separator'    => array(
        'title'              => __( 'Separator', 'yit' ),
        'description'        => __( 'Print a separator line', 'yit' ),
        'tab'                => 'shortcodes',
        'has_content'        => false,
        'create'             => true,
        'in_visual_composer' => true,
        'attributes'         => array(
            'style'         => array(
                'title'   => __( 'Separator style', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'single' => __( 'Single line', 'yit' ),
                    'double' => __( 'Double line', 'yit' ),
                    'dotted' => __( 'Dotted line', 'yit' ),
                    'dashed' => __( 'Dashed line', 'yit' )
                ),
                'std'     => 'single'
            ),
            'color'         => array(
                'title' => __( 'Separator color', 'yit' ),
                'type'  => 'colorpicker',
                'std'   => '#cdcdcd'
            ),
            'margin_top'    => array(
                'title' => __( 'Margin top', 'yit' ),
                'type'  => 'number',
                'min'   => 0,
                'max'   => 999,
                'std'   => 40
            ),
            'margin_bottom' => array(
                'title' => __( 'Margin bottom', 'yit' ),
                'type'  => 'number',
                'min'   => 0,
                'max'   => 999,
                'std'   => 40
            )
        )
    ),

    /* === SHARE === */
    'share'               => array(
        'title'              => __( 'Share', 'yit' ),
        'description'        => __( 'Print share buttons', 'yit' ),
        'has_content'        => false,
        'in_visual_composer' => true,
        'tab'                => 'shortcodes',
        'attributes'         => array(
            'icon_source' => array(
                'title'   => __( 'Icon type', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'theme-icon' => __( 'Theme Icon', 'yit' ),
                    'custom'     => __( 'Custom Icon', 'yit' )
                ),
                'std'     => 'theme-icon'
            ),
            'icon_theme'  => array(
                'title'   => __( 'Icon', 'yit' ),
                'type'    => 'select-icon', // home|file|time|ecc
                'options' => $awesome_icons,
                'std'     => '',
                'deps'    => array(
                    'ids'    => 'icon_source',
                    'values' => 'theme-icon'
                )
            ),
            'icon_url'    => array(
                'title' => __( 'Icon URL', 'yit' ),
                'type'  => 'text',
                'std'   => '',
                'deps'  => array(
                    'ids'    => 'icon_source',
                    'values' => 'custom'
                )
            ),
            'title'       => array(
                'title' => __( 'Title', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'socials'     => array(
                'title'    => __( 'Socials', 'yit' ),
                'type'     => 'select',
                'multiple' => true,
                'options'  => array(
                    'facebook'  => __( 'Facebook', 'yit' ),
                    'twitter'   => __( 'Twitter', 'yit' ),
                    'google'    => __( 'Google+', 'yit' ),
                    'pinterest' => __( 'Pinterest', 'yit' ),
                    'linkedin' => __( 'Linkedin', 'yit' ),

                ),
                'std'      => serialize( array() )
                //'std' => 'facebook, twitter, google, pinterest, bookmark'
            ),
            'class'       => array(
                'title' => __( 'CSS Class', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            ),
            'size'        => array(
                'title'   => __( 'Size', 'yit' ),
                'type'    => 'select', // small|
                'options' => array(
                    'small' => __( 'Small', 'yit' ),
                    ''      => __( 'Normal', 'yit' )
                ),
                'std'     => ''
            ),
            'icon_type'   => array(
                'title'   => __( 'Icon Type', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    'icon' => __( 'Icon', 'yit' ),
                    'text' => __( 'Text', 'yit' )
                ),
                'std'     => 'icon',
            ),
            'show_in'     => array(
                'title'   => __( 'Show socials in cloud', 'yit' ),
                'type'    => 'select', // yes|no
                'options' => array(
                    'modal'    => __( 'Modal box', 'yit' ),
                    'dropdown' => __( 'Dropdown List', 'yit' ),
                    'inline'   => __( 'Inline List', 'yit' ),
                ),
                'std'     => 'inline'
            )
        )
    ),

    /* === BUTTON === */
    'button'              => array(
        'title'              => __( 'Button', 'yit' ),
        'description'        => __( 'Show a simple custom button', 'yit' ),
        'tab'                => 'shortcodes',
        'has_content'        => true,
        'in_visual_composer' => true,
        'attributes'         => array(
            'href'            => array(
                'title' => __( 'URL', 'yit' ),
                'type'  => 'text',
                'std'   => '#'
            ),
            'target'          => array(
                'title'   => __( 'Target', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    ''        => __( 'Default', 'yit' ),
                    '_blank'  => __( 'Blank', 'yit' ),
                    '_parent' => __( 'Parent', 'yit' ),
                    '_top'    => __( 'Top', 'yit' )
                ),
                'std'     => ''
            ),
            'color'           => array(
                'title'       => __( 'Color', 'yit' ),
                'description' => __( 'You can find the buttons list', 'yit' ),
                'type'        => 'select', // btn-view-over-the-town-1|btn-the-bizzniss-1|btn-french-1|ecc
                'options'     => apply_filters( 'yit_button_style', '' ), //apply_filters( 'yit_button_style' , $button_style ),
                'std'         => 'flat'
            ),
            'dimension'       => array(
                'title'   => __( 'Width', 'yit' ),
                'type'    => 'select', // extra large!large|medium|small
                'options' => array(
                    'extra-large'   => __( 'Extra Large', 'yit' ),
                    'large'         => __( 'Large', 'yit' ),
                    'normal'        => __( 'Medium', 'yit' ),
                    'small'         => __( 'Small', 'yit' )
                ),
                'std'     => 'normal',
            ),
            'icon'            => array(
                'title'   => __( 'Icon', 'yit' ),
                'type'    => 'select-icon', // home|file|time|ecc
                'options' => $awesome_icons_with_null,
                'std'     => ''
            ),
            'icon_size'       => array(
                'title' => __( 'Icon size', 'yit' ),
                'type'  => 'number',
                'std'   => '12'
            ),
            'animation'       => array(
                'title'   => __( 'Icon Animation', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    ''    => __( 'None', 'yit' ),
                    'RtL' => __( 'Right to Left', 'yit' ),
                    'LtR' => __( 'Left to Right', 'yit' ),
                    'CtL' => __( 'Center to Left', 'yit' ),
                    'CtR' => __( 'Center to Right', 'yit' ),
                    'UtC' => __( 'Up to Center', 'yit' ),
                    'LtC' => __( 'Left to Center', 'yit' ),
                    'RtC' => __( 'Right to Center', 'yit' ),
                ),
                'std'     => ''
            ),
            'animate'         => array(
                'title'   => __( 'Animation', 'yit' ),
                'type'    => 'select',
                'options' => $animate,
                'std'     => ''
            ),
            'animation_delay' => array(
                'title' => __( 'Animation Delay', 'yit' ),
                'type'  => 'text',
                'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                'std'   => '0'
            ),
            'class'           => array(
                'title' => __( 'CSS class', 'yit' ),
                'type'  => 'text',
                'std'   => ''
            )
        ),
    )
);

if ( function_exists( 'YIT_Team' ) ) {
    $theme_shortcodes['team_section'] = array(
        'title'              => __( 'Team', 'yit' ),
        'description'        => __( 'Adds team members', 'yit' ),
        'tab'                => 'section',
        'create'             => false,
        'has_content'        => false,
        'in_visual_composer' => true,
        'attributes'         => array(
            'team'          => array(
                'title'   => __( 'Team', 'yit' ),
                'type'    => 'select',
                'options' => YIT_Team()->get_teams(),
                'std'     => ''
            ),
            'nitems'        => array(
                'title' => __( 'Number of member', 'yit' ),
                'type'  => 'number',
                'min'   => - 1,
                'max'   => 99,
                'std'   => - 1
            ),
            'items_per_row' => array(
                'title'   => __( 'Members per row', 'yit' ),
                'type'    => 'select',
                'options' => array(
                    '3' => __( '3 items', 'yit' ),
                    '4' => __( '4 items', 'yit' ),
                ),
                'std'     => '4'
            ),
            'show_role'     => array(
                'title' => __( 'Show role', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            ),
            'show_social'   => array(
                'title' => __( 'Show social', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'yes'
            )
        )
    );


}
if ( function_exists( 'WC' ) ) {
    $shop_shortcodes = array(

        /* === PRODUCTS CATEGORY === */
        'products_categories' => array(
            'title'              => __( 'Product Categories', 'yit' ),
            'description'        => __( 'List all (or limited) product categories', 'yit' ),
            'tab'                => 'shop',
            'has_content'        => false,
            'in_visual_composer' => true,
            'attributes'         => array(
                'category'     => array(
                    'title'   => __( 'Category', 'yit' ),
                    'type'    => 'checklist',
                    'options' => yit_get_shop_categories( true ),
                    'std'     => ''
                ),
                'product_in_a_row' => array(
                    'title' => __('Visible Items', 'yit'),
                    'type' => 'select',
                    'options' => array(
                        '2' => __('2', 'yit' ),
                        '3' => __('3', 'yit' ),
                        '4' => __('4', 'yit' ),
                        '6' => __('6', 'yit' )
                    ),
                    'std'  => '4'
                ),
                'hide_empty'   => array(
                    'title' => __( 'Hide empty', 'yit' ),
                    'type'  => 'checkbox',
                    'std'   => 'yes'
                ),
                'show_counter' => array(
                    'title' => __( 'Show Counter', 'yit' ),
                    'type'  => 'checkbox',
                    'std'   => 'yes'
                ),
                'orderby'      => array(
                    'title'   => __( 'Order by', 'yit' ),
                    'type'    => 'select',
                    'options' => apply_filters( 'woocommerce_catalog_orderby', array(
                        'menu_order' => __( 'Default sorting', 'yit' ),
                        'title'      => __( 'Sort alphabetically', 'yit' ),
                        'date'       => __( 'Sort by most recent', 'yit' ),
                        'price'      => __( 'Sort by price', 'yit' )
                    ) ),
                    'std'     => 'menu_order'
                ),
                'order'        => array(
                    'title'   => __( 'Sorting', 'yit' ),
                    'type'    => 'select',
                    'options' => array(
                        'desc' => __( 'Descending', 'yit' ),
                        'asc'  => __( 'Crescent', 'yit' )
                    ),
                    'std'     => 'desc'
                ),
                'animate'         => array(
                    'title'   => __( 'Animation', 'yit' ),
                    'type'    => 'select',
                    'options' => $animate,
                    'std'     => ''
                ),
                'animation_delay' => array(
                    'title' => __( 'Animation Delay', 'yit' ),
                    'type'  => 'text',
                    'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                    'std'   => '0'
                )
            )
        ),

        /* === PRODUCTS SLIDER === */
        'products_slider'     => array(
            'title'              => __( 'Products slider', 'yit' ),
            'description'        => __( 'Add a products slider', 'yit' ),
            'tab'                => 'shop',
            'has_content'        => false,
            'in_visual_composer' => true,
            'attributes'         => array(
                'title'           => array(
                    'title' => __( 'Title', 'yit' ),
                    'type'  => 'text',
                    'std'   => ''
                ),
                'per_page'        => array(
                    'title' => __( 'Items', 'yit' ),
                    'type'  => 'number',
                    'std'   => '12'
                ),
                'product_in_a_row' => array(
                    'title' => __('Visible Items', 'yit'),
                    'type' => 'select',
                    'options' => array(
                        '2' => __('2', 'yit' ),
                        '3' => __('3', 'yit' ),
                        '4' => __('4', 'yit' ),
                        '6' => __('6', 'yit' )
                    ),
                    'std'  => '4'
                ),
                'category'        => array(
                    'title'    => __( 'Category', 'yit' ),
                    'type'     => 'select',
                    'options'  => yit_get_shop_categories( false ),
                    'std'      => serialize( array() ),
                    'multiple' => true
                ),
                'layout'          => array(
                    'title'   => __( 'Layout', 'yit' ),
                    'type'    => 'select',
                    'options' => array(
                        'default' => __( 'Default Layout', 'yit' ),
                        'zoom' => __( 'Zoom Layout', 'yit' ),
                        'flip' => __( 'Flip Layout', 'yit' )
                    ),
                    'std'     => 'default'
                ),
                'product_type'    => array(
                    'title'   => __( 'Product Type', 'yit' ),
                    'type'    => 'select',
                    'options' => array(
                        'all'      => __( 'All products', 'yit' ),
                        'featured' => __( 'Featured Products', 'yit' ),
                        'on_sale'  => __( 'On Sale Products', 'yit' )
                    ),
                    'std'     => 'all'
                ),
                'orderby'         => array(
                    'title'   => __( 'Order by', 'yit' ),
                    'type'    => 'select',
                    'options' => apply_filters( 'woocommerce_catalog_orderby', array(
                        'rand'  => __( 'Random', 'yit' ),
                        'title' => __( 'Sort alphabetically', 'yit' ),
                        'date'  => __( 'Sort by most recent', 'yit' ),
                        'price' => __( 'Sort by price', 'yit' ),
                        'sales' => __( 'Sort by sales', 'yit' )
                    ) ),
                    'std'     => 'rand'
                ),
                'order'           => array(
                    'title'   => __( 'Sorting', 'yit' ),
                    'type'    => 'select',
                    'options' => array(
                        'desc' => __( 'Descending', 'yit' ),
                        'asc'  => __( 'Crescent', 'yit' )
                    ),
                    'std'     => 'desc'
                ),
                'hide_free'       => array(
                    'title' => __( 'Hide free products', 'yit' ),
                    'type'  => 'checkbox',
                    'std'   => 'no'
                ),
                'show_hidden'     => array(
                    'title' => __( 'Show hidden products', 'yit' ),
                    'type'  => 'checkbox',
                    'std'   => 'no'
                ),
                'autoplay'        => array(
                    'title'   => __( 'Autoplay', 'yit' ),
                    'type'    => 'select',
                    'options' => array(
                        'true'  => __( 'True', 'yit' ),
                        'false' => __( 'False', 'yit' ),
                    ),
                    'std'     => 'true'
                ),
                'animate'         => array(
                    'title'   => __( 'Animation', 'yit' ),
                    'type'    => 'select',
                    'options' => $animate,
                    'std'     => ''
                ),
                'animation_delay' => array(
                    'title' => __( 'Animation Delay', 'yit' ),
                    'type'  => 'text',
                    'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                    'std'   => '0'
                ),
                'z_index' => array(
                    'title' => __( 'Z-Index', 'yit' ),
                    'type'  => 'text',
                    'desc'  => __( 'This value determines the style z-index value of the slider container', 'yit' ),
                    'std'   => ''
                )
            )
        ),

        /* === SHOW PRODUCTS === */
        'show_products'       => ( ! function_exists( 'WC' ) ) ? false : array(
            'title'              => __( 'Show the products', 'yit' ),
            'description'        => __( 'Show the products', 'yit' ),
            'tab'                => 'shop',
            'has_content'        => false,
            'in_visual_composer' => true,
            'attributes'         => array(
                'layout'          => array(
                    'title'   => __( 'Layout', 'yit' ),
                    'type'    => 'select',
                    'options' => array(
                        'default' => __( 'Default Layout', 'yit' ),
                        'zoom' => __( 'Zoom Layout', 'yit' ),
                        'flip' => __( 'Flip Layout', 'yit' )
                    ),
                    'std'     => 'default'
                ),
                'masonry'         => array(
                    'title' => __( 'Enable Masonry', 'yit' ),
                    'desc'  => __( 'Enable masonry style.', 'yit' ),
                    'type'  => 'checkbox',
                    'std'   => 'no'
                ),'filter_type' => array(
                    'title' => __( 'Filter by', 'yit' ),
                    'type' => 'select',
                    'options' => array(
                        'category' => __( 'Category', 'yit' ),
                        'ids' => __( 'Products ID', 'yit' ),
                    ) ,
                    'std' => 'category'
                ),
                'ids' => array(
                    'title' => __('Products ID es: 15,20,25', 'yit'),
                    'type' => 'text',
                    'desc' => __('insert a comma separated list of ids', 'yit'),
                    'std' => '' ,
                    'deps'  => array(
                        'ids'    => 'filter_type',
                        'values' => 'ids'
                    ),

                ),
                'per_page' => array(
                    'title' => __('N. of items', 'yit'),
                    'description' => __('Show all with -1', 'yit'),
                    'type' => 'number',
                    'std'  => '8',
                    'deps'  => array(
                        'ids'    => 'filter_type',
                        'values' => 'category'
                    ),
                ),
                'product_in_a_row' => array(
                    'title' => __('Visible Items', 'yit'),
                    'type' => 'select',
                    'options' => array(
                        '2' => __('2', 'yit' ),
                        '3' => __('3', 'yit' ),
                        '4' => __('4', 'yit' ),
                        '6' => __('6', 'yit' )
                    ),
                    'std'  => '4'
                ),
                'category'        => array(
                    'title'    => __( 'Category', 'yit' ),
                    'type'     => 'select',
                    'multiple' => true,
                    'options'  => yit_get_shop_categories( false ),
                    'std'      => serialize( array() ),
                    'deps'  => array(
                        'ids'    => 'filter_type',
                        'values' => 'category'
                    ),
                ),
                'show'            => array(
                    'title'   => __( 'Show', 'yit' ),
                    'type'    => 'select',
                    'options' => array(
                        'all'      => __( 'All Products', 'yit' ),
                        'featured' => __( 'Featured Products', 'yit' ),
                        'on_sale'  => __( 'On Sale Products', 'yit' ),

                    ),
                    'std'     => 'all',
                    'deps'  => array(
                        'ids'    => 'filter_type',
                        'values' => 'category'
                    ),
                ),
                'hide_free'       => array(
                    'title' => __( 'Hide free products', 'yit' ),
                    'type'  => 'checkbox',
                    'std'   => 'no',
                    'deps'  => array(
                        'ids'    => 'filter_type',
                        'values' => 'category'
                    ),
                ),
                'show_hidden'     => array(
                    'title' => __( 'Show hidden products', 'yit' ),
                    'type'  => 'checkbox',
                    'std'   => 'no',
                    'deps'  => array(
                        'ids'    => 'filter_type',
                        'values' => 'category'
                    ),
                ),
                'orderby'         => array(
                    'title'   => __( 'Order by', 'yit' ),
                    'type'    => 'select',
                    'options' => apply_filters( 'woocommerce_catalog_orderby', array(
                        'rand'  => __( 'Random', 'yit' ),
                        'title' => __( 'Sort alphabetically', 'yit' ),
                        'date'  => __( 'Sort by most recent', 'yit' ),
                        'price' => __( 'Sort by price', 'yit' ),
                        'sales' => __( 'Sort by sales', 'yit' )
                    ) ),
                    'std'     => 'rand'
                ),
                'order'           => array(
                    'title'   => __( 'Sorting', 'yit' ),
                    'type'    => 'select',
                    'options' => array(
                        'desc' => __( 'Descending', 'yit' ),
                        'asc'  => __( 'Crescent', 'yit' )
                    ),
                    'std'     => 'desc'
                ),
                'animate'         => array(
                    'title'   => __( 'Animation', 'yit' ),
                    'type'    => 'select',
                    'options' => $animate,
                    'std'     => ''
                ),
                'animation_delay' => array(
                    'title' => __( 'Animation Delay', 'yit' ),
                    'type'  => 'text',
                    'desc'  => __( 'This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit' ),
                    'std'   => '0'
                )
            )
        ),

        /* === PRODUCTS CATEGORY SLIDER === */
        'products_categories_slider' => array(
            'title' => __('Categories slider', 'yit'),
            'description' => __('List all (or limited) product categories', 'yit'),
            'tab' => 'shop',
            'has_content' => false,
            'in_visual_composer' => true,
            'attributes' => array(
                'title' => array(
                    'title' => __( 'Title', 'yit' ),
                    'type' => 'text',
                    'std' => ''
                ),
                'category' => array(
                    'title' => __('Category', 'yit'),
                    'type' => 'checklist',
                    'options' => $shop_categories_id,
                    'std'  => ''
                ),
                'product_in_a_row' => array(
                    'title' => __('Visible Items', 'yit'),
                    'type' => 'select',
                    'options' => array(
                        '2' => __('2', 'yit' ),
                        '3' => __('3', 'yit' ),
                        '4' => __('4', 'yit' ),
                        '6' => __('6', 'yit' )
                    ),
                    'std'  => '4'
                ),
                'show_counter' => array(
                    'title' => __('Show Counter', 'yit'),
                    'type' => 'checkbox',
                    'std'  => 'yes'
                ),
                'hide_empty' => array(
                    'title' => __('Hide empty', 'yit'),
                    'type' => 'checkbox',
                    'std'  => 'yes'
                ),
                'orderby' => array(
                    'title' => __( 'Order by', 'yit' ),
                    'type' => 'select',
                    'options' => apply_filters( 'woocommerce_catalog_orderby', array(
                        'menu_order' => __( 'Default sorting', 'yit' ),
                        'title' => __( 'Sort alphabetically', 'yit' ),
                        'count' => __( 'Sort by products count', 'yit' )
                    ) ),
                    'std' => 'menu_order'
                ),
                'order' => array(
                    'title' => __('Sorting', 'yit'),
                    'type' => 'select',
                    'options' => array(
                        'desc' => __('Descending', 'yit'),
                        'asc' => __('Crescent', 'yit')
                    ),
                    'std'  => 'desc'
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
                'autoplay' => array(
                    'title' => __('Autoplay', 'yit'),
                    'type' => 'select',
                    'options' => array(
                        'true' => __('True', 'yit'),
                        'false' => __('False', 'yit'),
                    ),
                    'std'  => 'true'
                )
            )
        ),
    );
}

return ! empty( $shop_shortcodes ) ? array_merge( $theme_shortcodes, $shop_shortcodes ) : $theme_shortcodes;