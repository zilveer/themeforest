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

function yit_tab_typography_header( $items ) {
    return array_merge( $items, array(
        12 => array(
            'id'   => 'logo-tagline-highlight-font',
            'type' => 'typography',
            'name' => __( 'Tagline font highlight', 'yit' ),
            'desc' => __( 'Select the type to use for the tagline highlight.', 'yit' ),
            'min'  => 1,
            'max'  => 18,
            'std'  => apply_filters( 'yit_logo-tagline-highlight-font_std', array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Muli',
                    'style'  => 'regular',
                    'color'  => '#b26706' 
            ) ),
            'style' => array(
				'selectors' => '#header #logo #tagline span',
				'properties' => 'font-size, font-family, color, font-style, font-weight'
			)
        ),
    ) );
}
add_filter( 'yit_submenu_tabs_theme_option_typography_header', 'yit_tab_typography_header' );

add_filter( 'yit_logo-font_std', create_function( '', "return array(
                    'size'   => 60,
                    'unit'   => 'px',
                    'family' => 'Montez',
                    'style'  => 'regular',
                    'color'  => '#212223' 
                );" ) );

function yit_logo_font_style( $array ) {
	$array['selectors'] = '#header #logo #textual, span.logo';    
    return $array;
}                
add_filter( 'yit_logo-font_style', 'yit_logo_font_style' );

add_filter( 'yit_logo-tagline-font_std', create_function( '', "return array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Muli',
                    'style'  => 'regular',
                    'color'  => '#212223' 
                );" ) );
add_filter( 'yit_logo-tagline-highlight-font_std', create_function( '', "return array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Muli',
                    'style'  => 'regular',
                    'color'  => '#b26706' 
                );" ) );				           