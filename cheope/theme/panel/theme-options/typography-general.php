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

function yit_tab_typography_general( $fields ) {
    $fields[90] = array(
        'id'   => 'back-top-font',
        'type' => 'typography',
        'name' => __( 'Back to Top font', 'yit' ),
        'desc' => __( 'Select the font for "Back to top" button. ', 'yit' ),
        'min'  => 1,
        'max'  => 18,
        'std'  => apply_filters( 'yit_back-top-font_std', array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Muli',
            'style'  => 'regular',
            'color'  => '#030303'
        ) ),
        'style' => apply_filters( 'yit_back-top-font_style', array(
            'selectors' => '#back-top a, #back-top a:hover',
            'properties' => 'font-size, font-family, color, font-style, font-weight'
        ) )
    );
    $fields[100] = array(
        'id'   => 'sitemap-h3',
        'type' => 'typography',
        'name' => __( 'Sitemap headings', 'yit' ),
        'desc' => __( 'Select the type to use for the sitemap headings. ', 'yit' ),
        'min'  => 1,
        'max'  => 30,
        'std'  => apply_filters( 'yit_sitemap-h3_std', array(
            'size'   => 17,
            'unit'   => 'px',
            'family' => 'Muli',
            'style'  => 'regular',
            'color'  => '#848484'
        ) ),
        'style' => array(
            'selectors' => apply_filters( 'yit_sitemap-h3_selectors', '.sitemap h3' ),
            'properties' => 'font-size, font-family, color, font-style, font-weight'
        )
    );

    return $fields;
}
add_filter( 'yit_submenu_tabs_theme_option_typography_general', 'yit_tab_typography_general' );

function yit_general_font_style( $array ) {
    $array['selectors'] = 'a, p, li, address, dd, blockquote, td, th, .paragraph-links a, a.text-color, ul.filters li a, .menu-select select, .testimonial-widget li a, .testimonial-widget li p, #search_mini, .newsletter-input input, .newsletter-submit input, .features-tab-container .features-tab-labels li, .features-tab-content';    
    return $array;
}
add_filter( 'yit_general-font_style', 'yit_general_font_style' );

function yit_links_font_style( $array ) {
    $array['selectors'] = 'a, a.text-color:hover, ul.filters li a:hover, ul.filters li a.active';    
    return $array;
}
add_filter( 'yit_links-font_style', 'yit_links_font_style' );

function yit_links_font_hover_style( $array ) {
    $array['selectors'] = 'a:hover, body .login_register a:hover, #multistep_step1 .step1_login_form form.login_checkout .lost_password:hover, #breadcrumb a:hover';    
    return $array;
}
add_filter( 'yit_links-font-hover_style', 'yit_links_font_hover_style' );

function yit_breadcrumb_font_current_style( $array ) {
    $array['selectors'] = '#page-meta #yit-breadcrumb a.current, #breadcrumb';    
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
    $array['size'] = 12;
    $array['family'] = 'Muli';
    $array['color'] = '#666767';
    
    return $array;
}
add_filter( 'yit_general-font_std', 'yit_general_font_std' );

add_filter( 'yit_links-font_std', create_function( '', 'return "#b77a2b";' ) );
add_filter( 'yit_links-font-hover_std', create_function( '', 'return "#030303";' ) );
function yit_breadcrumb_font_std( $array ) {
    $array['size']  = 10;
    $array['color'] = '#8f9090';   
    $array['family'] = 'Muli';
    
    return $array;
}
add_filter( 'yit_breadcrumb-font_std', 'yit_breadcrumb_font_std' );

function yit_breadcrumb_font_style( $array ) {
    $array['selectors']  = '#yit-breadcrumb a, #breadcrumb a, #breadcrumb';
    return $array;
}
add_filter( 'yit_breadcrumb-font_style', 'yit_breadcrumb_font_style' );

add_filter( 'yit_breadcrumb-font-hover_std', create_function( '', 'return "#535353";' ) );

function yit_breadcrumb_font_hover_style( $array ) {
    $array['selectors']  = '#yit-breadcrumb a:hover, #breadcrumb a:hover';
    return $array;
}
add_filter( 'yit_breadcrumb-font-hover_style', 'yit_breadcrumb_font_hover_style' );

function yit_heading_font_std( $array ) {
    $array['color'] = '#030303';
    $array['family'] = 'Muli'; 
    
    return $array;
}
add_filter( 'yit_h1-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h2-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h3-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h4-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h5-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h6-font_std', 'yit_heading_font_std' );

function yit_slogan_font_std( $array ) {
    $array['size'] = 26;
    $array['color'] = '#030303';
    $array['family'] = 'Muli'; 

    return $array;
}
add_filter( 'yit_slogan-font_std', 'yit_slogan_font_std' );

function yit_subslogan_font_std( $array ) {
    $array['size'] = 18;
    $array['color'] = '#848484';
    $array['family'] = 'Muli'; 
    
    return $array;
}
add_filter( 'yit_sub-slogan-font_std', 'yit_subslogan_font_std' );

function yit_highlight_color_std() {
    return '#030303';
}
add_filter( 'yit_highlight-color_std', 'yit_highlight_color_std' );  