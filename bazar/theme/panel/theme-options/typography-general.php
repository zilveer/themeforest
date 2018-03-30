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

function yit_submenu_tabs_theme_option_typography_general( $array ) {
    return array_merge( $array, array(
        90 => array(
            'id'   => 'sitemap-h3',
            'type' => 'typography',
            'name' => __( 'Sitemap headings', 'yit' ),
            'desc' => __( 'Select the type to use for the sitemap headings. ', 'yit' ),
            'min'  => 1,
            'max'  => 30,
            'std'  => apply_filters( 'yit_sitemap-h3_std', array(
                'size'   => 17,
                'unit'   => 'px',
                'family' => 'Oswald',
                'style'  => 'regular',
                'color'  => '#b0731f'
            ) ),
            'style' => array(
                'selectors' => apply_filters( 'yit_sitemap-h3_selectors', '.sitemap h3' ),
                'properties' => 'font-size, font-family, color, font-style, font-weight'
            )
        ),
        100 => array(
            'id'   => 'back-top-font',
            'type' => 'typography',
            'name' => __( 'Back to Top font', 'yit' ),
            'desc' => __( 'Select the font for "Back to top" button. ', 'yit' ),
            'min'  => 1,
            'max'  => 18,
            'std'  => apply_filters( 'yit_back-top-font_std', array(
                'size'   => 12,
                'unit'   => 'px',
                'family' => 'Oswald',
                'style'  => 'regular',
                'color'  => '#b0731f'
            ) ),
            'style' => apply_filters( 'yit_back-top-font_style', array(
                'selectors' => '#back-top a, #back-top a:hover',
                'properties' => 'font-size, font-family, color, font-style, font-weight'
            ) )
        ),
    ) );
}
add_filter( 'yit_submenu_tabs_theme_option_typography_general', 'yit_submenu_tabs_theme_option_typography_general' );

function yit_general_font_style( $array ) {
    $array['selectors'] = 'a, p, li, address, dd, blockquote, td, th, .paragraph-links a, a.text-color, ul.filters li a, .menu-select select, .testimonial-widget li a, .testimonial-widget li p, #search_mini, .newsletter-input input, .newsletter-submit input, .features-tab-container .features-tab-labels li, .features-tab-content, .portfolio-libra .work-projects ul.pagination_nav li a, .widget.text-image';
    return $array;
}
add_filter( 'yit_general-font_style', 'yit_general_font_style' );

function yit_links_font_style( $array ) {
    $array['selectors'] = '.error404 .error-404-text p a,.blog-bazar:first-child .blog-bazar-header .meta a,.blog-bazar .the-content p.meta span a,a, a.text-color:hover, ul.filters li a:hover, ul.filters li a.active';
    return $array;
}
add_filter( 'yit_links-font_style', 'yit_links_font_style' );

function yit_links_font_hover_style( $array ) {
    $array['selectors'] = '.error404 .error-404-text p a:hover,.features-tab-container ul.features-tab-labels li.current-feature,.blog-bazar:first-child .blog-bazar-header .meta a:hover,.blog-bazar .the-content p.meta span a:hover,a:hover, body .login_register a:hover, #multistep_step1 .step1_login_form form.login_checkout .lost_password:hover, .portfolio-libra .work-projects ul.pagination_nav li a:hover, a:hover .title-highlight';
    return $array;
}
add_filter( 'yit_links-font-hover_style', 'yit_links_font_hover_style' );

function yit_breadcrumb_font_style( $array ) {
    $array['selectors'] = '#page-meta #yit-breadcrumb, #page-meta #yit-breadcrumb a, .breadcrumbs span, .woocommerce-breadcrumb a, .woocommerce-breadcrumb';
    return $array;
}
add_filter( 'yit_breadcrumb-font_style', 'yit_breadcrumb_font_style' );

function yit_breadcrumb_font_current_style( $array ) {
    $array['selectors'] = '#page-meta #yit-breadcrumb a.current, .woocommerce-breadcrumb';
    return $array;
}
add_filter( 'yit_breadcrumb-font-current_style', 'yit_breadcrumb_font_current_style' );

function yit_slogan_font_style( $array ) {
    $array['selectors'] = '.slogan h2';    
    return $array;
}
add_filter( 'yit_slogan-font_style', 'yit_slogan_font_style' );

function yit_sub_slogan_font_style( $array ) {
    $array['selectors'] = '.slogan h3';    
    return $array;
}
add_filter( 'yit_sub-slogan-font_style', 'yit_sub_slogan_font_style' );

 
function yit_general_font_std( $array ) {
    $array['size'] = 14;
    $array['family'] = 'Play';
    $array['color'] = '#747373';
    
    return $array;
}
add_filter( 'yit_general-font_std', 'yit_general_font_std' );

add_filter( 'yit_links-font_std', create_function( '', 'return "#995d08";' ) );
add_filter( 'yit_links-font-hover_std', create_function( '', 'return "#d98104";' ) );

function yit_breadcrumb_font_std( $array ) {
    $array['size']  = 12;
    $array['color'] = '#8d8d8d';   
    $array['family'] = 'Play';
    
    return $array;
}
add_filter( 'yit_breadcrumb-font_std', 'yit_breadcrumb_font_std' );

function yit_breadcrumb_font_hover_style( $array ) {
    $array['selectors'] = '#page-meta #yit-breadcrumb a:hover, .woocommerce-breadcrumb a:hover';
    return $array;
}
add_filter( 'yit_breadcrumb-font-hover_style', 'yit_breadcrumb_font_hover_style' );
add_filter( 'yit_breadcrumb-font-hover_std', create_function( '', 'return "#535353";' ) );

add_filter( 'yit_breadcrumb-font-current_std', create_function( '', 'return "#363f4a";' ) );

function yit_heading_font_std( $array ) {
    $array['color'] = '#3e3d3d';
    $array['family'] = 'Oswald';
    $array['style'] = 'regular';
    
    return $array;
}
add_filter( 'yit_h1-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h2-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h3-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h4-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h5-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h6-font_std', 'yit_heading_font_std' );

function yit_heading1_font_std( $array ) { $array['size'] = 22; return $array; }
add_filter( 'yit_h1-font_std', 'yit_heading1_font_std' );

function yit_heading2_font_std( $array ) { $array['size'] = 20; return $array; }
add_filter( 'yit_h2-font_std', 'yit_heading2_font_std' );

function yit_heading3_font_std( $array ) { $array['size'] = 17; return $array; }
add_filter( 'yit_h3-font_std', 'yit_heading3_font_std' );

function yit_heading4_font_std( $array ) { $array['size'] = 16; return $array; }
add_filter( 'yit_h4-font_std', 'yit_heading4_font_std' );

function yit_heading5_font_std( $array ) { $array['size'] = 15; return $array; }
add_filter( 'yit_h5-font_std', 'yit_heading5_font_std' );

function yit_heading6_font_std( $array ) { $array['size'] = 14; return $array; }
add_filter( 'yit_h6-font_std', 'yit_heading6_font_std' );

function yit_slogan_font_std( $array ) {
    $array['size'] = 30;
    $array['color'] = '#373736';
    $array['family'] = 'Oswald';
    $array['style'] = 'regular'; 

    return $array;
}
add_filter( 'yit_slogan-font_std', 'yit_slogan_font_std' );

function yit_subslogan_font_std( $array ) {
    $array['size'] = 15;
    $array['color'] = '#666565';
    $array['family'] = 'Oswald';
	$array['style'] = 'regular';
    
    return $array;
}
add_filter( 'yit_sub-slogan-font_std', 'yit_subslogan_font_std' );

function yit_highlight_color_std() {
    return '#cc9833';
}
add_filter( 'yit_highlight-color_std', 'yit_highlight_color_std' );

function yit_highlight_color_style( $array ) {
    $array['selectors'] = 'h1 span.title-highlight, h2 span.title-highlight, h3 span.title-highlight, h4 span.title-highlight, h5 span.title-highlight, h6 span.title-highlight, .box-sections span.title-highlight, .box-sections-border span.title-highlight';    
    return $array;
}
add_filter( 'yit_highlight-color_style', 'yit_highlight_color_style' );