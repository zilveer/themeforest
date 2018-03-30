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

function yit_tab_blog_typography( $array ) {
    unset( $array[30], $array[40] );
	
	$array[12] = array(
        'id'   => 'blog-title-font-hover',
        'type' => 'colorpicker',
        'name' => __( 'Title hover', 'yit' ),
        'desc' => __( 'Choose the font color for the title when the status is "hover".', 'yit' ),
        'std'  => apply_filters( 'yit_blog-title-font-hover_std', '#B77A2B' ),
        'style' => apply_filters( 'yit_blog-title-font-hover_style', array(
			'selectors' => '.blog-big .meta .post-title:hover, .blog-big .meta .post-title a:hover, .blog-elegant .post-title:hover, .blog-elegant .post-title a:hover',
			'properties' => 'color'
		) )
    );
    return $array;
}
add_filter( 'yit_submenu_tabs_theme_option_blog_typography', 'yit_tab_blog_typography' );

function yit_blog_title_std( $array ) {
    $array['family'] = 'Muli';
    
    return $array;    
}
add_filter( 'yit_blog-title-font_std', 'yit_blog_title_std' );

function yit_blog_meta_font_std( $array ) {
    $array['family'] = 'Muli';
    $array['color'] = '#5f5e5e';
	$array['size'] = '13';
    
    return $array;
}
add_filter( 'yit_blog-meta-font_std', 'yit_blog_meta_font_std' );

add_filter( 'yit_blog-meta-font-hover_std', create_function( '', 'return "#000";' ) );

function yit_blog_meta_font_style( $array ) {
    $array['selectors'] = '.blog-big .meta div p, .blog-big .meta div p a';
    
    return $array;
}
add_filter( 'yit_blog-meta-font_style', 'yit_blog_meta_font_style' );

function yit_blog_meta_font_hover_style( $array ) {
    $array['selectors'] = '.blog-big .meta div p a:hover';    
    return $array;
}
add_filter( 'yit_blog-meta-font-hover_style', 'yit_blog_meta_font_hover_style' );
