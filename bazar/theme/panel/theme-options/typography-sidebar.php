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
    $array['size'] = 18;
    $array['family'] = 'Oswald';
    $array['color'] = '#373736';
    $array['style'] = 'regular';
    
    return $array;
}
add_filter( 'yit_sidebar-title-font_std', 'yit_sidebar_title_font_std' );

function yit_sidebar_title_font_style( $array ) {
    $array['selectors'] .= ',.sidebar .yit_quick_contact h3, .widget.widget_onsale h3, .widget.widget_best_sellers h3, .widget.widget_recent_reviews h3, .widget.widget_recent_products h3, .widget.widget_random_products h3, .widget.widget_featured_products h3, .widget.widget_top_rated_products h3, .widget.widget_recently_viewed_products h3';
    return $array;
}
add_filter( 'yit_sidebar-title-font_style', 'yit_sidebar_title_font_style' );

function yit_sidebar_content_font_std( $array ) {
    $array['size'] = 12;
    $array['family'] = 'Play';
    $array['color'] = '#4f4d4d';
    
    return $array;
}
add_filter( 'yit_sidebar-content-font_std', 'yit_sidebar_content_font_std' );

function yit_sidebar_content_font_selector( $selectors ) {
    $selectors .= ',div.textwidget p,.yit_toggle_menu ul.menu ul li a,.widget_categories ul > li a,.widget.faq-filters .border ul li a,.last-tweets p a,.recent-comments .the-post .author a,.widget.widget_onsale li a, .widget.widget_best_sellers li a, .widget.widget_recent_reviews li a, .widget.widget_recent_products li a, .widget.widget_random_products li a, .widget.widget_featured_products li a, .widget.widget_top_rated_products li a, .widget.widget_recently_viewed_products li a';
    return $selectors;
}
add_filter( 'yit_sidebar-content-font_selectors', 'yit_sidebar_content_font_selector' );

function yit_sidebar_links_font_selector( $selectors ) {
    $selectors .= ',.yit_toggle_menu ul.menu ul li a,.widget_categories ul > li a,.widget.faq-filters .border ul li a,.last-tweets p a,.recent-comments .the-post .author a, .widget.widget_onsale li a, .widget.widget_best_sellers li a, .widget.widget_recent_reviews li a, .widget.widget_recent_products li a, .widget.widget_random_products li a, .widget.widget_featured_products li a, .widget.widget_top_rated_products li a, .widget.widget_recently_viewed_products li a';
    return $selectors;
}
add_filter( 'yit_sidebar-links-font_selectors', 'yit_sidebar_links_font_selector' );

function yit_sidebar_links_hover_font_selectors( $selectors ) {
    $selectors .= ',.yit_toggle_menu ul.menu ul li a:hover,.widget.faq-filters .border ul li a.active,.widget.faq-filters .border ul li a:hover,.widget_categories ul > li a:hover,.widget_layered_nav ul li.chosen a, .widget_product_categories .product-categories li.current-cat a,.recent-comments .the-post .author a:hover,.sidebar .recent-post .text > a:hover,.widget.widget_layered_nav li a:hover,.widget_product_categories .product-categories li a:hover,.widget.widget_onsale li a:hover,.widget.widget_best_sellers li a:hover,.widget.widget_recent_reviews li a:hover,.widget.widget_recent_products li a:hover,.widget.widget_random_products li a:hover,.widget.widget_featured_products li a:hover,.widget.widget_top_rated_products li a:hover,.widget.widget_recently_viewed_products li a:hover';
    return $selectors;
}
add_filter( 'yit_sidebar-links-hover-font_selectors', 'yit_sidebar_links_hover_font_selectors' );

add_filter( 'yit_sidebar-links-font_std', create_function( '', 'return "#995d08";' ) );
add_filter( 'yit_sidebar-links-hover-font_std', create_function( '', 'return "#aa620d";' ) );

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
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#4f4d4d' 
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
            'size'   => 14,
            'unit'   => 'px',
            'family' => 'Oswald',
            'style'  => 'regular',
            'color'  => '#909091' 
        ) ),
        'style' => array(
			'selectors' => '.testimonial-widget li .name-testimonial',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    );

    $array[] = array(
        'id' => 'widget-cta-quick-contact-title-font',
        'type' => 'typography',
        'name' => __( 'Call to action &amp; Quick contact title', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min'  => 1,
        'max'  => 30,
        'std'  => apply_filters( 'yit_widget-cta-quick-contact-title-font_std', array(
            'size'   => 18,
            'unit'   => 'px',
            'family' => 'Oswald',
            'style'  => 'regular',
            'color'  => '#be8a0c'
        ) ),
        'style' => array(
            'selectors' => '.sidebar .cta .border h3, #footer .cta .border h3, .yit_quick_contact h3',
            'properties' => 'font-size, font-family, color, font-style, font-weight'
        )
    );
    
    return $array;
}
add_filter( 'yit_submenu_tabs_theme_option_typography_sidebar', 'yit_sidebar_add_options' );