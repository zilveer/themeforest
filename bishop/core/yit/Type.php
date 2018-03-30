<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}

/**
 * Print the options used in Panel, Metabox, etc.
 *
 * @class YIT_Type
 * @package    Yithemes
 * @since      1.0.0
 * @author     Your Inspiration Themes
 */
class YIT_Type {

    /**
     * Render the HTML of the option
     *
     * @since  Version 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function render( $option ) {
        if ( isset( $option['type'] ) && $option['type'] ) {

			// set properly the default value for this option
			if ( isset( $option['std'] ) && isset( $option['id'] ) ) {
				$defaults = YIT_Registry::get_instance()->options->get_default_options();

                if( isset( $defaults[ $option['id'] ] ) ) {
                    $option['std'] = $defaults[ $option['id'] ];
                }else{
                    $option['std'] = '';
                }
			}

			// alter option array by plugin
			$option = apply_filters( 'yit_admin_option_args', $option );
            $path = 'admin/type/' . $option['type'] . '.php';
            yit_get_template( $path, $option );
        }
    }

}

if ( ! function_exists( 'yit_field_name' ) ) {
    /**
     * Format the name of the field
     *
     * @param string $id
     * @param bool   $echo
     *
     * @return void
     * @since  Version 1.0.0
     * @author Simone D'Amico
     */
    function yit_field_name( $id, $echo = true ) {
        if( $echo == true ) {
            echo esc_attr( 'yit_panel_option[' . $id . ']' );
        }

        return esc_attr( 'yit_panel_option[' . $id . ']' );
    }
}