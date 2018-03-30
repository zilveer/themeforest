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
 * @author Francesco Licandro  <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$config = YIT_Plugin_Common::load();
$awesome_icons = YIT_Plugin_Common::get_awesome_icons();
$animate = $config['animate'];

if ( ! function_exists( 'WC' ) ) {
    $shop_categories_id = array();
    $shop_categories = array();
}


return array(

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

    /* ====== TEXT WITH IMAGE ======== */
    'text-image' => array(
        'title' => __( 'Text with Image', 'yit' ),
        'description' => __( 'Insert text with an image and button', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => false,
        'hide' => 'true',
        'has_content' => true,
        'attributes' => array(
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'subtitle' => array(
                'title' => __( 'Subtitle', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'image' => array(
                'title' => __('Image URL', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'button' => array(
                'title' => __('Button', 'yit'),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'button_text' => array(
                'title' => __( 'Button text', 'yit' ),
                'type' => 'text',
                'std' => '',
                'deps' => array(
                    'ids' => 'button',
                    'values' => '1'
                )
            ),
            'link' => array(
                'title' => __('Link', 'yit'),
                'type' => 'text',
                'std'  => '',
                'deps' => array(
                    'ids' => 'button',
                    'values' => '1'
                )
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

    /*================= TESTIMONIAL ================*/
    'testimonial'        => array(
        'title'       => __( 'Testimonials', 'yit' ),
        'description' => __( 'Show all post on testimonials post types', 'yit' ),
        'tab'         => 'cpt',
        'in_visual_composer' => true,
        'has_content' => false,
        'create'      => false,
        'attributes'  => array(
            'items' => array(
                'title'       => __( 'N. of items', 'yit' ),
                'description' => __( 'Show all with -1', 'yit' ),
                'type'        => 'number',
                'std'         => '-1'
            ),
            'cat'   => array(
                'title'       => __( 'Categories', 'yit' ),
                'description' => __( 'Select the categories of posts to show', 'yit' ),
                'type'        => 'select',
                'options'     => apply_filters( 'yit_get_testimonial_categories', '' ),
                'std'         => ''
            ),
            'style' => array(
                'title' => __('Style', 'yit'),
                'description' => __('Select the style of testimonials', 'yit'),
                'type' => 'select',
                'options' => array('square'=>'square', 'comic'=>'comic'),
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

    /*================= PARALLAX ================*/
    'parallax' => array(
        'title'       => __('Parallax effect', 'yit' ),
        'description' => __('Create a fancy full-width parallax effect', 'yit' ),
        'tab'         => 'shortcodes',
        'has_content' => true,
        'in_visual_composer' => true,
        'create'      => true,
        'attributes'  => array(
            'height' => array(
                'title' => __('Container height', 'yit'),
                'type' => 'number',
                'std'  => 300
            ),
            'image' => array(
                'title' => __('Background Image URL', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'valign' => array(
                'title' => __('Vertical Align', 'yit'),
                'type' => 'select',
                'options'  => array(
                    'top' => __('Top', 'yit'),
                    'center' => __('Center', 'yit'),
                    'bottom' => __('Bottom', 'yit'),
                ),
                'std' => 'center'
            ),
            'halign' => array(
                'title' => __('Horizontal Align', 'yit'),
                'type' => 'select',
                'options'  => array(
                    'left' => __('Left', 'yit'),
                    'center' => __('Center', 'yit'),
                    'right' => __('Right', 'yit'),
                ),
                'std' => 'center'
            ),
            'font_p' => array(
                'title' => __('Paragraph Font Size', 'yit'),
                'type' => 'number',
                'std' => 24
            ),
            'color' => array(
                'title' => __('Content Text Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#ffffff'
            ),
            'overlay_opacity' => array(
                'title'       => __( 'Overlay', 'yit' ),
                'description' => __( 'Set an opacity of overlay (0-100)', 'yit' ),
                'type'        => 'number',
                'std'         => '0'
            ),
            'border_bottom' => array(
                'title'       => __( 'Border Bottom', 'yit' ),
                'description' => __( 'Set a size for border bottom (0-10)', 'yit' ),
                'type'        => 'number',
                'min'         => 0,
                'max'         => 0,
                'std'         => '0'
            ),
            'effect' => array(
                'title' => __('Effect', 'yit'),
                'type' => 'select',
                'options'  => array(
                    'fadeIn' => __('fadeIn', 'yit'),
                    'fadeInUp' => __('fadeInUp', 'yit'),
                    'fadeInDown' => __('fadeInDown', 'yit'),
                    'fadeInLeft' => __('fadeInLeft', 'yit'),
                    'fadeInRight' => __('fadeInRight', 'yit'),
                    'fadeInUpBig' => __('fadeInUpBig', 'yit'),
                    'fadeInDownBig' => __('fadeInDownBig', 'yit'),
                    'fadeInLeftBig' => __('fadeInLeftBig', 'yit'),
                    'fadeInRightBig' => __('fadeInRightBig', 'yit'),
                    'bounceIn' => __('bounceIn', 'yit'),
                    'bounceInDown' => __('bounceInDown', 'yit'),
                    'bounceInUp' => __('bounceInUp', 'yit'),
                    'bounceInLeft' => __('bounceInLeft', 'yit'),
                    'bounceInRight' => __('bounceInRight', 'yit'),
                    'rotateIn' => __('rotateIn', 'yit'),
                    'rotateInDownLeft' => __('rotateInDownLeft', 'yit'),
                    'rotateInDownRight' => __('rotateInDownRight', 'yit'),
                    'rotateInUpLeft' => __('rotateInUpLeft', 'yit'),
                    'rotateInUpRight' => __('rotateInUpRight', 'yit'),
                    'lightSpeedIn' => __('lightSpeedIn', 'yit'),
                    'hinge' => __('hinge', 'yit'),
                    'rollIn' => __('rollIn', 'yit'),
                ),
                'std' => 'fadeIn'
            ),

            'video_upload_mp4' => array(
                'title' => __('Video Mp4', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'video_upload_ogg' => array(
                'title' => __('Video Ogg', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'video_upload_webm' => array(
                'title' => __('Video Webm', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'video_button' => array(
                'title' => __('Add a button', 'yit'),
                'description' => __('Add a button to see a video in a lightbox', 'yit'),
                'type' => 'checkbox',
                'std' => 'no'
            ),
            'video_button_style' => array(
                'title' => __('Video button style', 'yit'),
                'description' => __('Choose a style for video button', 'yit'),
                'type' => 'select',
                'options' => yit_button_style(),
                'std' => 'white'
            ),
            'video_url' => array(
                'title' => __('Video URL', 'yit'),
                'description' => __('Paste the url of the video that will be opened in the lightbox', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'label_button_video' => array(
                'title' => __('Button Label', 'yit'),
                'description' => __('Add the label of the button', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),

        )
    ),

    /*================= PORTFOLIO SECTION =================*/
    'portfolio_section' => ! function_exists('YIT_Portfolio') ? false : array(
        'title' => __( 'Portfolio', 'yit' ),
        'description' => __( 'Print a portfolio slider', 'yit' ),
        'tab' => 'section',
        'has_content' => false,
        'in_visual_composer' => true,
        'create' => true,
        'attributes' => array(
            'nitems' => array(
                'title' => __( 'Number of items', 'yit' ),
                'description' => __( '-1 to show all elements', 'yit' ),
                'type' => 'number',
                'min' => -1,
                'max' => 99,
                'std' => -1
            ),
            'portfolios' => array(
                'title' => __( 'Portfolio', 'yit' ),
                'type' => 'select',
                'options' => apply_filters( 'yit_get_portfolios', array() ),
                'std' => ''
            ),
            'enable_hover' => array(
                'title' => __( 'Enable Hover', 'yit' ),
                'type' => 'checkbox',
                'std' => true
            ),
            'enable_title'=> array(
                'title' => __( 'Enable Title on hover', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes',
            ),
            'enable_categories'=> array(
                'title' => __( 'Enable Categories on hover', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes',
            ),
            'excluded_ids' => array(
                'title' => __( 'A comma separated list of ids to exclude', 'yit' ),
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

    /*================= BLOG SECTION =================*/
    'blog_section' =>  array(
        'title' => __( 'Blog', 'yit' ),
        'description' => __( 'Print a blog slider', 'yit' ),
        'tab' => 'section',
        'has_content' => false,
        'in_visual_composer' => true,
        'create' => true,
        'attributes' => array(
            'nitems' => array(
                'title' => __( 'Number of items', 'yit' ),
                'description' => __( '-1 to show all elements', 'yit' ),
                'type' => 'number',
                'min' => -1,
                'max' => 99,
                'std' => -1
            ),
            'enable_slider' => array(
                'title' => __( 'Enable Slider', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'enable_thumbnails' => array(
                'title' => __( 'Show Thumbnails', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'enable_date' => array(
                'title' => __( 'Show Date', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'enable_title' => array(
                'title' => __( 'Show Title', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'enable_author' => array(
                'title' => __( 'Show Author', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'enable_comments' => array(
                'title' => __( 'Show Comments', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
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


    /*================= SEPARATOR ================*/
    'separator' => array(
        'title' => __( 'Separator', 'yit' ),
        'description' => __( 'Print a separator line', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'create' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'style' => array(
                'title' => __( 'Separator style', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'single' => __( 'Single line', 'yit' ),
                    'double' => __( 'Double line', 'yit' ),
                    'dotted' => __( 'Dotted line', 'yit' ),
                    'dashed' => __( 'Dashed line', 'yit' )
                ),
                'std' => 'single'
            ),
            'color' => array(
                'title' => __( 'Separator color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '#cdcdcd'
            ),
            'margin_top' => array(
                'title' => __( 'Margin top', 'yit' ),
                'type' => 'number',
                'min' => 0,
                'max' => 999,
                'std' => 40
            ),
            'margin_bottom' => array(
                'title' => __( 'Margin bottom', 'yit' ),
                'type' => 'number',
                'min' => 0,
                'max' => 999,
                'std' => 40
            )
        )
    ),

    /* === GOOGLE MAPS === */
    'googlemap' => array(
        'title' => __('Google Maps', 'yit' ),
        'description' =>  __('Print the google map box', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => false,
        'attributes' => array(
            'full_width' => array(
                'title' => __('Full Width', 'yit'),
                'type' => "checkbox",
                'std' => 'yes'
            ),
            'width' => array(
                'title' => __('Width', 'yit'),
                'type' => 'number',
                'std'  => '',
                'deps' => array(
                    'ids' => 'full_width',
                    'values' => '0'
                )
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
            'address' => array(
                'title' => __( 'Address', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'info' => array(
                'title' => __( 'Info', 'yit' ),
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
    ) ,

    /* === MODAL === */
    'modal' => array(
        'title' => __('Modal Window', 'yit' ),
        'description' =>  __('Create a modal window', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => true,
        'attributes' => array(
            'title' => array(
                'title' => __( 'Modal Title', 'yit' ),
                'type' => 'text',
                'std' => __( 'Your title here', 'yit' )
            ),
            'opener' => array(
                'title' => __( 'Type of modal opener', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'button' => __( 'Button', 'yit' ),
                    'text' => __( 'Textual Link', 'yit' ),
                    'image' => __( 'Image', 'yit' )
                ),
                'std' => 'button'
            ),
            'button_text_opener' => array(
                'title' => __( 'Text of the button', 'yit' ),
                'type' => 'text',
                'std' => __( 'Open Modal', 'yit' ),
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'button'
                )
            ),
            'button_style' => array(
                'title' => __( 'Style of the button', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'normal' => __( 'Normal', 'yit' ),
                    'alternative' => __( 'Alternative', 'yit' )
                ),
                'std' => 'normal',
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'button'
                )
            ),
            'link_text_opener' => array(
                'title' => __( 'Text of the link', 'yit' ),
                'type' => 'text',
                'std' => __( 'Open Modal', 'yit' ),
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'text'
                )
            ),
            'link_icon_type' => array(
                'title' => __('Icon type', 'yit'),
                'type'  => 'select',
                'options' => array(
                    'none' => __( 'None', 'yit' ),
                    'theme-icon' => __('Theme Icon', 'yit'),
                    'custom' => __('Custom Icon', 'yit')
                ),
                'std' => 'none',
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'text'
                )
            ),
            'link_icon_theme' => array(
                'title' => __('Icon', 'yit'),
                'type' => 'select-icon',  // home|file|time|ecc
                'options' => $awesome_icons,
                'std'  => '',
                'deps' => array(
                    'ids' => 'link_icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'link_icon_url' =>  array(
                'title' => __('Icon URL', 'yit'),
                'type' => 'text',
                'std'  => '',
                'deps' => array(
                    'ids' => 'link_icon_type',
                    'values' => 'custom'
                )
            ),
            'link_text_size' => array(
                'title' => __( 'Font size of the link', 'yit' ),
                'type' => 'number',
                'std' => 17,
                'min' => 1,
                'max' => 99,
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'text'
                )
            ),
            'image_opener' => array(
                'title' => __( 'Url of the image', 'yit' ),
                'type' => 'text',
                'std' => '',
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'image'
                )
            ),
        )
    ),

    /* === SWIPER PRODUCTS SLIDER ===*/
    'swiper_products_slider' => ( ! function_exists( 'WC' ) ) ? false : array(
        'title' => __('Swiper Products slider', 'yit'),
        'description' => __('Add a swiper products slider', 'yit'),
        'tab' => 'shop',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'title' => array(
                'title' => __( 'Title', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'per_page' => array(
                'title' => __( 'Items', 'yit' ),
                'type' => 'number',
                'std' => '12'
            ),
            'category' => array(
                'title' => __('Category', 'yit'),
                'type' => 'select',
                'options' => yit_get_shop_categories(false),
                'std'  => serialize( array() ),
                'multiple' => true
            ),
            'product_type' => array(
                'title' => __('Product Type', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'all' => __('All products', 'yit' ),
                    'featured' => __('Featured Products', 'yit' ),
                    'on_sale' => __( 'On Sale Products', 'yit' )
                ),
                'std'  => 'all'
            ),
            'orderby' => array(
                'title' => __( 'Order by', 'yit' ),
                'type' => 'select',
                'options' => apply_filters( 'woocommerce_catalog_orderby', array(
                    'rand' => __( 'Random', 'yit' ),
                    'title' => __( 'Sort alphabetically', 'yit' ),
                    'date' => __( 'Sort by most recent', 'yit' ),
                    'price' => __( 'Sort by price', 'yit' ),
                    'sales' => __( 'Sort by sales', 'yit')
                ) ),
                'std' => 'rand'
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
            'hide_free' => array(
                'title' => __( 'Hide free products', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'no'
            ),
            'show_hidden' => array(
                'title' => __( 'Show hidden products', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'no'
            ),
            'columns' => array(
                'title' => __('Columns Number', 'yit'),
                'type' => 'select',
                'options' => array(
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ),
                'std'  => '3'
            ),
            'button' => array(
                'title' => __('Button Style', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'btn-flat' => 'Style Flat',
                    'btn-alternative' => 'Style Alternative'
                ),
                'std' => 'btn-flat'
            ),
            'height' => array(
                'title' => __('Image Height', 'yit'),
                'description' => __( 'Leave this field empty to full size height', 'yit' ),
                'type' => 'text',
                'std'  => ''
            ),
            'autoplay' => array(
                'title' => __('Enable Autoplay', 'yit'),
                'type' => 'checkbox',
                'std'  => 'off'
            ),
            'play_speed' => array(
                'title' => __('Animation Speed', 'yit'),
                'description' => __( 'In milliseconds', 'yit' ),
                'type' => 'text',
                'std'  => '3000'
            ),
        )
    ),

    /* === SHOW PRODUCTS === */
    'show_products' => ( ! function_exists( 'WC' ) ) ? false :array(
        'title' => __('Show the products', 'yit'),
        'description' => __('Show the products', 'yit'),
        'tab' => 'shop',
        'has_content' => false,
        'in_visual_composer' => true,
        'attributes' => array(
            'layout' => array(
                'title' => __('Layout', 'yit'),
                'type' => 'select',
                'options' => array(
                    'default' => __('Default', 'yit'),
                    'slideup' => __('Slide-Up', 'yit'),
                    'classic' => __('Classic', 'yit')
                ),
                'std'  => 'default'
            ),
            'masonry' => array(
                'title' => __( 'Enable Masonry', 'yit' ),
                'desc' => __( 'Enable masonry style.', 'yit' ),
                'type' => 'checkbox',
                'std' => 'no'
            ),
            'filter_type' => array(
                'title' => __( 'Filter by', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'category' => __( 'Category', 'yit' ),
                    'ids' => __( 'Products ID', 'yit' ),
                ),
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
            'category' => array(
                'title' => __('Category', 'yit'),
                'type' => 'select',
                'multiple' => true,
                'options' => yit_get_shop_categories(false),
                'std'  => serialize( array() ),
                'deps'  => array(
                    'ids'    => 'filter_type',
                    'values' => 'category'
                )
            ),
            'show' => array(
                'title' => __('Show', 'yit'),
                'type' => 'select',
                'options' => array(
                    'all' => __('All Products', 'yit'),
                    'featured' => __('Featured Products', 'yit'),
                    'on_sale' => __('On Sale Products', 'yit'),

                ),
                'std' => 'all',
                'deps'  => array(
                    'ids'    => 'filter_type',
                    'values' => 'category'
                )
            ),
            'hide_free' => array(
                'title' => __( 'Hide free products', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'no',
                'deps'  => array(
                    'ids'    => 'filter_type',
                    'values' => 'category'
                )
            ),
            'show_hidden' => array(
                'title' => __( 'Show hidden products', 'yit' ),
                'type'  => 'checkbox',
                'std'   => 'no',
                'deps'  => array(
                    'ids'    => 'filter_type',
                    'values' => 'category'
                )
            ),
            'orderby' => array(
                'title' => __( 'Order by', 'yit' ),
                'type' => 'select',
                'options' => apply_filters( 'woocommerce_catalog_orderby', array(
                    'rand' => __( 'Random', 'yit' ),
                    'title' => __( 'Sort alphabetically', 'yit' ),
                    'date' => __( 'Sort by most recent', 'yit' ),
                    'price' => __( 'Sort by price', 'yit' ),
                    'sales' => __( 'Sort by sales', 'yit' )
                ) ),
                'std' => 'rand'
            ),
            'order' => array(
                'title' => __('Sorting', 'yit'),
                'type' => 'select',
                'options' => array(
                    'desc' => __( 'Descending', 'yit'),
                    'asc' => __( 'Crescent', 'yit')
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
            'per_page' => array(
                'title' => __( 'Items', 'yit' ),
                'type' => 'number',
                'std' => '-1'
            ),
            'category' => array(
                'title' => __('Category', 'yit'),
                'type' => 'checklist',
                'options' => $shop_categories_id,
                'std'  => ''
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
            'style' => array(
                'title' => __('Style', 'yit'),
                'type' => 'select',
                'options' => array(
                    'white' => __('White', 'yit'),
                    'black' => __('Black', 'yit')
                ),
                'std'  => 'black'
            ),
            'discovery_text' => array(
                'title' => __('Discovery text', 'yit'),
                'type' => 'text',
                'std'  => 'DISCOVERY NOW'
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

    /* === PRODUCT TABS === */
    'products_tabs' => array(
        'title' => __('Products Tabs', 'yit'),
        'description' => __('List products in tabs', 'yit'),
        'tab' => 'shop',
        'multiple' => true,
        'unlimited'   => true,
        'has_content' => false,
        'in_visual_composer' => false,
        'attributes' => array(
            'title_1' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => '',
                'multiple' => true
            ),
            'per_page_1' => array(
                'title' => __('N. of items', 'yit'),
                'description' => __('Show all with -1', 'yit'),
                'type' => 'number',
                'std'  => '10',
                'multiple' => true
            ),
            'category_1' => array(
                'title' => __('Category', 'yit'),
                'type' => 'select',
                'options' => $shop_categories,
                'std'  => serialize( array() ),
                'multiple' => true
            ),
            'show_1' => array(
                'title' => __('Show', 'yit'),
                'type' => 'select',
                'options' => array(
                    'all' => __('All', 'yit'),
                    'featured' => __('Featured', 'yit'),
                    'on_sale' => __('On sale', 'yit'),
                ),
                'std' => serialize ( array( 'all' ) ),
                'multiple' => true
            ),
            'orderby_1' => array(
                'title' => __( 'Order by', 'yit' ),
                'type' => 'select',
                'options' => apply_filters( 'woocommerce_catalog_orderby', array(
                    'rand' => __( 'Random', 'yit'),
                    'title' => __( 'Sort alphabetically', 'yit' ),
                    'date' => __( 'Sort by most recent', 'yit' ),
                    'price' => __( 'Sort by price', 'yit' ),
                    'sales' => __( 'Sort by sales', 'yit')
                ) ),
                'std' => serialize( array( 'rand' ) ),
                'multiple' => true
            ),
            'order_1' => array(
                'title' => __('Sorting', 'yit'),
                'type' => 'select',
                'options' => array(
                    'desc' => __('Descending', 'yit'),
                    'asc' => __('Crescent', 'yit')
                ),
                'std'  => serialize( array( 'desc' ) ),
                'multiple' => true
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
);
