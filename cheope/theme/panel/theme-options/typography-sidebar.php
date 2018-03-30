<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

function yit_sidebar_title_font_std( $array ) {
    $array['size'] = 16;
    $array['family'] = 'Muli';
    
    return $array;
}
add_filter( 'yit_sidebar-title-font_std', 'yit_sidebar_title_font_std' );

function yit_sidebar_content_font_std( $array ) {
    $array['size'] = 12;
    $array['family'] = 'Muli';
    
    return $array;
}
add_filter( 'yit_sidebar-content-font_std', 'yit_sidebar_content_font_std' );

add_filter( 'yit_sidebar-links-font_std', create_function( '', 'return "#8a8989";' ) );
add_filter( 'yit_sidebar-links-hover-font_std', create_function( '', 'return "#030303";' ) );

function yit_sidebar_add_options( $array ) {
    $array[] = array(
        'id' => 'widget-testimonials-font',
        'type' => 'typography',
        'name' => __( 'Testimonials slider excerpt font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min'  => 1,
        'max'  => 30,
        'std'  => apply_filters( 'yit_widget-testimonials-font_std', array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Muli',
            'style'  => 'regular',
            'color'  => '#585555' 
        ) ),
        'style' => array(
			'selectors' => '.testimonial-widget li blockquote p, .testimonial-widget li blockquote p:first-child',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    );
    
    $array[] = array(
        'id' => 'widget-testimonials-name-font',
        'type' => 'typography',
        'name' => __( 'Testimonials slider name font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min'  => 1,
        'max'  => 30,
        'std'  => apply_filters( 'yit_widget-testimonials-name-font_std', array(
            'size'   => 11,
            'unit'   => 'px',
            'family' => 'Muli',
            'style'  => 'regular',
            'color'  => '#000000' 
        ) ),
        'style' => array(
			'selectors' => '.testimonial-widget li .name-testimonial',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    );
    
    $array[] = array(
        'id' => 'widget-testimonials-website-font',
        'type' => 'typography',
        'name' => __( 'Testimonials slider website font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min'  => 1,
        'max'  => 30,
        'std'  => apply_filters( 'yit_widget-testimonials-website-font_std', array(
            'size'   => 11,
            'unit'   => 'px',
            'family' => 'Muli',
            'style'  => 'regular',
            'color'  => '#585555' 
        ) ),
        'style' => array(
			'selectors' => '.testimonial-widget li .url-testimonial',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    );

    $array[] = array(
        'id' => 'widget-toggle-font',
        'type' => 'colorpicker',
        'name' => __( 'Toggle menu font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'std'  => apply_filters( 'yit_widget-toggle-font_std', '#010101' ),
        'style' => array(
            'selectors' => '.yit_toggle_menu ul.menu > li > a',
            'properties' => 'color'
        )
    );

    $array[] = array(
        'id' => 'widget-toggle-sub-font',
        'type' => 'colorpicker',
        'name' => __( 'Toggle submenu and not active items font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'std'  => apply_filters( 'yit_widget-toggle-sub-font_std', '#666767' ),
        'style' => array(
            'selectors' => '.yit_toggle_menu ul.menu ul li a',
            'properties' => 'color'
        )
    );

    $array[] = array(
        'id' => 'widget-toggle-sub-hover-font',
        'type' => 'colorpicker',
        'name' => __( 'Toggle submenu and not active items font on hover', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'std'  => apply_filters( 'yit_widget-toggle-sub-hover-font_std', '#000000' ),
        'style' => array(
            'selectors' => '.yit_toggle_menu ul.menu ul li a:hover',
            'properties' => 'color'
        )
    );
    
    return $array;
}
add_filter( 'yit_submenu_tabs_theme_option_typography_sidebar', 'yit_sidebar_add_options' );