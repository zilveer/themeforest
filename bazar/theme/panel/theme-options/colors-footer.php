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
 
function yit_submenu_tabs_theme_option_colors_footer( $items ) {
    $items[60] = $items[30];
    unset( $items[10], $items[20], $items[30] );
    
    
        $items[10] = array(
            'id' => 'background-footer',
            'type' => 'colorpicker',
            'name' => __( 'Footer background', 'yit' ),
            'desc' => __( 'Select a background for the footer of all pages.', 'yit' ),
            'std' => apply_filters( 'yit_background-footer_std', '#ffffff' ),
            'style' => apply_filters( 'yit_background-footer_selectors', array(
                'selectors' => '#footer',
                'properties' => 'background-color'
            ) )
        );
        $items[20] = array(
            'id' => 'background-footer-image',
            'type' => 'upload',
            'name' => __( 'Footer background image', 'yit' ),
            'desc' => __( 'Select a background image for the footer of all pages.', 'yit' ),
            'style' => apply_filters( 'yit_background-footer-image_selectors', array(
                'selectors' => '#footer',
                'properties' => 'background-image'
            ) ),
            'std' => ''
        );
        $items[30] = array(
            'id' => 'background-footer-repeat', // per farlo conincidere con i metabox
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
            'style' => apply_filters( 'yit_background-footer-repeat_selectors', array(
                'selectors' => '#footer',
                'properties' => 'background-repeat'
			) ),
        );          	
        $items[40] = array(
            'id' => 'background-footer-position', // per farlo conincidere con i metabox
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
            'style' => apply_filters( 'yit_background-footer-position_selectors', array(
                'selectors' => '#footer',
                'properties' => 'background-position'
			) )
        );          	
        $items[50] = array(
            'id' => 'background-footer-attachment', // per farlo conincidere con i metabox
            'type' => 'select',
            'name' => __( 'Background attachment', 'yit' ),
            'desc' => __( 'Select the attachment for the background image.', 'yit' ),
            'options' => array( 
                'scroll' => __( 'Scroll', 'yit' ),
                'fixed' => __( 'Fixed', 'yit' ),
            ),
            'std' => 'scroll',
            'style' => apply_filters( 'yit_background-footer-attachment_selectors', array(
                'selectors' => '#footer',
                'properties' => 'background-attachment'
			) )
        );
        $items[70] = array(
            'id' => 'background-copyright-image',
            'type' => 'upload',
            'name' => __( 'Copyright background image', 'yit' ),
            'desc' => __( 'Select a background image for the copyright of all pages.', 'yit' ),
            'style' => apply_filters( 'yit_background-copyright-image_selectors', array(
                'selectors' => '#copyright',
                'properties' => 'background-image'
            ) ),
            'std' => ''
        );
        $items[80] = array(
            'id' => 'background-copyright-repeat', // per farlo conincidere con i metabox
            'type' => 'select',
            'name' => __( 'Background repeat', 'yit' ),
            'desc' => __( 'Select the repeat mode for the copyright image.', 'yit' ),
            'options' => array(
                'repeat' => __( 'Repeat', 'yit' ),
                'repeat-x' => __( 'Repeat Horizontally', 'yit' ),
                'repeat-y' => __( 'Repeat Vertically', 'yit' ),
                'no-repeat' => __( 'No Repeat', 'yit' ),
            ),
            'std' => 'repeat',
            'style' => apply_filters( 'yit_background-copyright-repeat_selectors', array(
                'selectors' => '#copyright',
                'properties' => 'background-repeat'
            ) ),
        );
        $items[90] = array(
            'id' => 'background-copyright-position', // per farlo conincidere con i metabox
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
            'style' => apply_filters( 'yit_background-copyright-position_selectors', array(
                'selectors' => '#copyright',
                'properties' => 'background-position'
            ) )
        );
        $items[100] = array(
            'id' => 'background-copyright-attachment', // per farlo conincidere con i metabox
            'type' => 'select',
            'name' => __( 'Background attachment', 'yit' ),
            'desc' => __( 'Select the attachment for the background image.', 'yit' ),
            'options' => array(
                'scroll' => __( 'Scroll', 'yit' ),
                'fixed' => __( 'Fixed', 'yit' ),
            ),
            'std' => 'scroll',
            'style' => apply_filters( 'yit_background-copyright-attachment_selectors', array(
                'selectors' => '#copyright',
                'properties' => 'background-attachment'
            ) )
        );
        
        return $items;
}
add_filter( 'yit_submenu_tabs_theme_option_colors_footer', 'yit_submenu_tabs_theme_option_colors_footer' );

add_filter( 'yit_footer-background_std', create_function( '', 'return "#ecebeb";' ) );
add_filter( 'yit_copyright-background_std', create_function( '', 'return "#ffffff";' ) );