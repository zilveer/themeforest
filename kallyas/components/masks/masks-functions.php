<?php if(! defined('ABSPATH')) { return; }

/**
 * Display the custom bottom mask markup
 *
 * @param  [type] $mask The mask ID
 *
 * @return [type]     HTML Markup to be used as mask
 */
if(!function_exists('zn_bottommask_markup')) {
	function zn_bottommask_markup( $mask, $bgcolor = false, $pos = 'bottom' )
    {

        if ( $mask == 'none' ) {

            echo '<div class="zn_header_'.$pos.'_style"></div>';

        }
        else {

            $classes[] = 'kl-mask';
            $classes[] = 'kl-' . $pos . 'mask';
            $classes[] = 'kl-mask--' . $mask;
            $classes[] = 'kl-mask--' . zget_option( 'zn_main_style', 'color_options', false, 'light' );

            echo '<div class="'. implode(' ', $classes) .'">';

            if ( strpos($mask, 'mask3') !== false ) {
                include(locate_template('components/masks/mask3.php'));
            }
            else if ( strpos($mask, 'mask4') !== false ) {
                include(locate_template('components/masks/mask4.php'));
            }
            else if ( strpos($mask, 'mask5') !== false ) {
                include(locate_template('components/masks/mask5.php'));
            }
            else if ( strpos($mask, 'mask6') !== false ) {
                include(locate_template('components/masks/mask6.php'));
            }
            else if ( strpos($mask, 'mask7') !== false ) {
                include(locate_template('components/masks/mask7.php'));
            }

            echo '</div>';

        }
    }
}


/**
 * Return Bottom masks for options list
 */
if( !function_exists('zn_get_bottom_masks') ){
    function zn_get_bottom_masks(){
        // TODO: to be prepared for future mask plugins
        return array (
            'none' => __( 'None.', 'zn_framework' ),
            'shadow_simple' => __( 'Shadow Up', 'zn_framework' ),
            'shadow_simple_down' => __( 'Shadow Down', 'zn_framework' ),
            'shadow' => __( 'Shadow Up (with border and small arrow)', 'zn_framework' ),
            'shadow_ud' => __( 'Shadow Up and down', 'zn_framework' ),
            'mask3' => __( 'Vector Mask 3 CENTER', 'zn_framework' ),
            'mask3 mask3l' => __( 'Vector Mask 3 LEFT', 'zn_framework' ),
            'mask3 mask3r' => __( 'Vector Mask 3 RIGHT', 'zn_framework' ),
            'mask4' => __( 'Vector Mask 4 CENTER', 'zn_framework' ),
            'mask4 mask4l' => __( 'Vector Mask 4 LEFT', 'zn_framework' ),
            'mask4 mask4r' => __( 'Vector Mask 4 RIGHT', 'zn_framework' ),
            'mask5' => __( 'Vector Mask 5', 'zn_framework' ),
            'mask6' => __( 'Vector Mask 6', 'zn_framework' ),
            'mask7 mask7l' => __( 'Mask 7 - Skew Left', 'zn_framework' ),
            'mask7 mask7r' => __( 'Mask 7 - Skew Right', 'zn_framework' ),
            'mask7 mask7big mask7l' => __( 'Mask 7 Bigger - Skew Left', 'zn_framework' ),
            'mask7 mask7big mask7r' => __( 'Mask 7 Bigger - Skew Right', 'zn_framework' ),
        );
    }
}

if( !function_exists('zn_get_top_masks') ){
    function zn_get_top_masks(){
        // TODO: to be prepared for future TOP masks plugins
        // automatically filled by plugin
         return array (
            'none' => __( 'None.', 'zn_framework' ),
            'shadow_simple' => __( 'Shadow Up', 'zn_framework' ),
            'shadow_simple_down' => __( 'Shadow Down', 'zn_framework' ),
            'shadow' => __( 'Shadow Up (with border and small arrow)', 'zn_framework' ),
            'shadow_ud' => __( 'Shadow Up and down', 'zn_framework' ),
            'mask3' => __( 'Vector Mask 3 CENTER', 'zn_framework' ),
            'mask3 mask3l' => __( 'Vector Mask 3 LEFT', 'zn_framework' ),
            'mask3 mask3r' => __( 'Vector Mask 3 RIGHT', 'zn_framework' ),
            'mask4' => __( 'Vector Mask 4 CENTER', 'zn_framework' ),
            'mask4 mask4l' => __( 'Vector Mask 4 LEFT', 'zn_framework' ),
            'mask4 mask4r' => __( 'Vector Mask 4 RIGHT', 'zn_framework' ),
            'mask5' => __( 'Vector Mask 5', 'zn_framework' ),
            'mask6' => __( 'Vector Mask 6', 'zn_framework' ),
            'mask7 mask7l' => __( 'Mask 7 - Skew Left', 'zn_framework' ),
            'mask7 mask7r' => __( 'Mask 7 - Skew Right', 'zn_framework' ),
            'mask7 mask7big mask7l' => __( 'Mask 7 Bigger - Skew Left', 'zn_framework' ),
            'mask7 mask7big mask7r' => __( 'Mask 7 Bigger - Skew Right', 'zn_framework' ),
        );
    }
}