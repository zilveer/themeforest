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

function yit_header_background_images( $bgs ) {       
    return array_merge( $bgs, array( 
        YIT_THEME_IMG_URL . '/backgrounds/032.jpg' => __( 'Background 01', 'yit' ),
        YIT_THEME_IMG_URL . '/backgrounds/045.jpg' => __( 'Background 02', 'yit' ),
        'custom' => __( 'Custom background', 'yit' )
    ) );
}
add_filter( 'yit_header_backgrounds', 'yit_header_background_images' );

function yit_body_background_images( $bgs ) {       
    return array_merge( $bgs, array(                                             
        YIT_THEME_IMG_URL . '/backgrounds/032.jpg' => __( 'Background 01', 'yit' ),
        YIT_THEME_IMG_URL . '/backgrounds/045.jpg' => __( 'Background 02', 'yit' ),
        'custom' => __( 'Custom background', 'yit' ),
    ) );
}
add_filter( 'yit_body_backgrounds', 'yit_body_background_images' );

function yit_admin_menu_theme_options( $array ) {       
    return array_merge( $array, array(
    	'shop' => __( 'Shop', 'yit' )            
    ) );
}
add_filter( 'yit_admin_menu_theme_options', 'yit_admin_menu_theme_options' );

function yit_admin_submenu_theme_options( $array ) {       
    return array_merge( $array, array(
    	'general' => array(
            'settings' => __( 'Settings', 'yit' ),
            'footer' => __( 'Footer', 'yit' ),
            'cachefonts' => __( 'Google Fonts Subset', 'yit'),
            'newsletter' => __( 'Newsletter', 'yit' ),
            'sitemap' => __('Sitemap', 'yit'),
            'responsive' => __('Responsive', 'yit'),
            'integration' => __( 'Integration', 'yit' )
		),
    	'shop' => array(
            'general_settings' => __( 'General settings', 'yit' ),
            'products_page' => __( 'Products page', 'yit' ),
            'products_details_page' => __( 'Products details page', 'yit' ),
            'category_page' => __( 'Category page', 'yit' ),
            'typography' => __( 'Typography', 'yit' ),
            'colors' => __( 'Colors', 'yit' )
        )
    ) );
}
add_filter( 'yit_admin_submenu_theme_options', 'yit_admin_submenu_theme_options' );