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

function yit_tab_testimonials_typography( $fields ) {
	unset ($fields[30]);	
	return array_merge( $fields, array(			
        30 => array(
            'id'   => 'testimonials-website-font',
            'type' => 'typography',
            'name' => __( 'Testimonial website or label font', 'yit' ),
            'desc' => __( 'Choose the font type, size and color.', 'yit' ),
            'min'  => 7,
            'max'  => 18,
            'std'  => apply_filters( 'yit_testimonials-website-font_std', array(
                'size'   => 12,
                'unit'   => 'px',
                'family' => 'Oswald',
                'style'  => 'regular',
                'color'  => '#1C1C1C' 
            ) ),
            'style' => apply_filters( 'yit_testimonials-website-font_style', array(
				'selectors' => '.testimonial .testimonial-name a.website, .testimonial-page .testimonial-name a.website',
				'properties' => 'font-size, font-family, color, font-style, font-weight'
			) )
        ),
        31 => array(
            'id'   => 'testimonials-smallquote-font',
            'type' => 'typography',
            'name' => __( 'Text Testimonials small quote font', 'yit' ),
            'desc' => __( 'Choose the font type, size and color.', 'yit' ),
            'min'  => 7,
            'max'  => 18,
            'std'  => apply_filters( 'yit_testimonials-smallquote-font_std', array(
                'size'   => 14,
                'unit'   => 'px',
                'family' => 'Arial',
                'style'  => 'regular',
                'color'  => '#2e2d2d' 
            ) ),
            'style' => apply_filters( 'yit_testimonials-smallquote-font_style', array(
				'selectors' => '.testimonial blockquote',
				'properties' => 'font-size, font-family, color, font-style, font-weight'
			) )
        ),
        51 => array(
            'id'   => 'testimonials-slider-author-hover-font',
            'type' => 'colorpicker',
            'name' => __( 'Testimonials slider author hover font', 'yit' ),
            'desc' => __( 'Choose the font type, size and color.', 'yit' ),
            'std'  => apply_filters( 'yit_testimonials-slider-author-hover-font_std', '#3e3d3d' ),
            'style' => apply_filters( 'yit_testimonials-slider-author-hover-font_style', array(
				'selectors' => '.testimonials-slider ul.testimonials li p.meta a:hover, .testimonials-flexslider ul li p.meta a:hover',
				'properties' => 'color'
			) )
        )
    ) );
}
add_filter( 'yit_submenu_tabs_theme_option_testimonials_typography', 'yit_tab_testimonials_typography' );

function yit_testimonials_text_font_std( $array ) {
    $array['size'] = 12;
    $array['family'] = 'Play';
    $array['color'] = '#585555';
    return $array;
}
add_filter( 'yit_testimonials-text-font_std', 'yit_testimonials_text_font_std' );

function yit_testimonials_name_font_std( $array ) {
    $array['size'] = 22;
    $array['family'] = 'Play';
    $array['color'] = '#ab5705';
    return $array;
}
add_filter( 'yit_testimonials-name-font_std', 'yit_testimonials_name_font_std' );


function yit_testimonials_website_font_std( $array ) {
    $array['size'] = 12;
    $array['family'] = 'Play';
	$array['color'] = '#1c1c1c';
    
    return $array;
}
add_filter( 'yit_testimonials-website-font_std', 'yit_testimonials_website_font_std' );

function yit_testimonials_website_font_style( $array ) {
    $array['selectors'] = '.testimonial .testimonial-name a.website, .testimonial .testimonial-name span.website, .testimonial-page .testimonial-name a.website, .testimonial-page .testimonial-name span.website';
    return $array;
}
add_filter( 'yit_testimonials-website-font_style', 'yit_testimonials_website_font_style' );

function yit_testimonials_name_font_style( $array ) {
    $array['selectors'] .= ', .testimonial-square-style .testimonial-name p.name, .testimonial-square-style .testimonial-name a.name';
    return $array;
}
add_filter( 'yit_testimonials-name-font_style', 'yit_testimonials_website_font_style' );

function yit_testimonials_text_font_style( $array ) {
    $array['selectors'] .= ', .testimonial-square-style .testimonial-text p';
    return $array;
}
add_filter( 'yit_testimonials-text-font_style', 'yit_testimonials_text_font_style' );

function yit_testimonials_slider_font_std( $array ) {
    $array['family'] = 'Play';
    $array['color'] = '#747373';
    $array['size'] = '24';
    
    return $array;
}
add_filter( 'yit_testimonials-slider-font_std', 'yit_testimonials_slider_font_std' );
function yit_testimonials_slider_author_font_std( $array ) {
    $array['family'] = 'Play';
    $array['color'] = '#aa620d';
    $array['size'] = '13';
    $array['style'] = 'regular';
    return $array;
}
add_filter( 'yit_testimonials-slider-author-font_std', 'yit_testimonials_slider_author_font_std' );

add_filter( 'yit_testimonials-slider-font_std', 'yit_testimonials_slider_font_std' );

function yit_testimonials_slider_font_style( $array ) {
    $array['selectors'] = '.testimonials-slider ul.testimonials li blockquote p a, .testimonials-flexslider ul li blockquote p a';    
    return $array;
}
add_filter( 'yit_testimonials-slider-font_style', 'yit_testimonials_slider_font_style' );

function yit_testimonials_slider_author_font_style( $array ) {
    $array['selectors'] = '.testimonials-slider ul.testimonials li p.meta, .testimonials-slider ul.testimonials li p.meta a, .testimonials-flexslider ul li p.meta a';    
    return $array;
}
add_filter( 'yit_testimonials-slider-author-font_style', 'yit_testimonials_slider_author_font_style' );