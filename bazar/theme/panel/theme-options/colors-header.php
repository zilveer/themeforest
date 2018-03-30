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

/**
 * Add specific fields to the tab General -> Settings
 * 
 * @param array $fields
 * @return array
 */ 
function yit_tab_colors_header( $fields ) {
	unset ($fields[10]);
	unset ($fields[20]);
	
    return array_merge( $fields, array(
        25 => array(
            'id' => 'topbar-header',
            'type' => 'colorpicker',
            'name' => __( 'Topbar background', 'yit' ),
            'desc' => __( 'Select a background for the topbar.', 'yit' ),
            'std' => apply_filters( 'yit_background-topbar_std', '#ffffff' ),
            'style' => apply_filters( 'yit_background-topbar_selectors', array(
                'selectors' => '#topbar, #topbar .last-tweets li',
                'properties' => 'background-color'
            ) )
        ),
        30 => array(
            'id' => 'background-header',
            'type' => 'colorpicker',
            'name' => __( 'Header background', 'yit' ),
            'desc' => __( 'Select a background for the header of all pages.', 'yit' ),
            'std' => apply_filters( 'yit_background-header_std', '#ffffff' ),
            'style' => apply_filters( 'yit_background-header_selectors', array(
                'selectors' => '#header',
                'properties' => 'background-color'
            ) )
        ),
        35 => array(
            'id' => 'background-header-image',
            'type' => 'upload',
            'name' => __( 'Header background image', 'yit' ),
            'desc' => __( 'Select a background image for the header of all pages.', 'yit' ),
            'style' => apply_filters( 'yit_background-header-image_selectors', array(
                'selectors' => '#header',
                'properties' => 'background-image'
            ) ),
            'std' => ''
        ),
        40 => array(
            'id' => 'background-header-repeat', // per farlo conincidere con i metabox
            'type' => 'select',
            'name' => __( 'Background repeat', 'yit' ),
            'desc' => __( 'Select the repeat mode for the background image.', 'yit' ),
            'options' => array(
                'repeat' => __( 'Repeat', 'yit' ),
                'repeat-x' => __( 'Repeat Horizontally', 'yit' ),
                'repeat-y' => __( 'Repeat Vertically', 'yit' ),
                'no-repeat' => __( 'No Repeat', 'yit' ),
            ),
            'std' => 'repeat',
            'style' => apply_filters( 'yit_background-header-repeat_selectors', array(
                'selectors' => '#header',
                'properties' => 'background-repeat'
			) ),
        ),
                    	
        50 => array(
            'id' => 'background-header-position', // per farlo conincidere con i metabox
            'type' => 'select',
            'name' => __( 'Background position', 'yit' ),
            'desc' => __( 'Select the position for the background image.', 'yit' ),
            'options' => array(
                'center' => __( 'Center', 'yit' ),
                'top left' => __( 'Top left', 'yit' ),
                'top center' => __( 'Top center', 'yit' ),
                'top right' => __( 'Top right', 'yit' ),
                'bottom left' => __( 'Bottom left', 'yit' ),
                'bottom center' => __( 'Bottom center', 'yit' ),
                'bottom right' => __( 'Bottom right', 'yit' ),
             ),
            'std' => 'top left',
            'style' => apply_filters( 'yit_background-header-position_selectors', array(
                'selectors' => '#header',
                'properties' => 'background-position'
			) )
        ),
                    	
        60 => array(
            'id' => 'background-header-attachment', // per farlo conincidere con i metabox
            'type' => 'select',
            'name' => __( 'Background attachment', 'yit' ),
            'desc' => __( 'Select the attachment for the background image.', 'yit' ),
            'options' => array( 
                'scroll' => __( 'Scroll', 'yit' ),
                'fixed' => __( 'Fixed', 'yit' ),
            ),
            'std' => 'scroll',
            'style' => apply_filters( 'yit_background-header-attachment_selectors', array(
                'selectors' => '#header',
                'properties' => 'background-attachment'
			) )
        )
    ) );
}
add_filter( 'yit_submenu_tabs_theme_option_colors_header', 'yit_tab_colors_header' );