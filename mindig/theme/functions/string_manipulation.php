<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if( !function_exists( 'yit_convert_tags' ) ) {
    /**
     * Convert specific tags with their value.
     *
     * Given a $key => $value array, this function will search for all $key in the string and replace them with the
     * corresponding $value.
     *
     * It is possible to pass custom tags using the filter 'yit_convertable_tags'.
     *
     * Default tags:
     *
     *   - '%site_url%' => site_url(),
     *   - '%home_url%' => home_url(),
     *   - '%site_name%' => get_bloginfo( 'name' ),
     *   - '%admin_email%' => get_bloginfo( 'admin_email' ),
     *   - '%ip%' => $_SERVER['REMOTE_ADDR']
     *
     * Example:
     *
     * "My site: %site_url%" -> "My site: http:example.com"
     *
     * @param string $string String containing tags to be replaced
     * @return string The same string with tags replaced
     * @since 1.0.0
     */
    function yit_convert_tags( $string ) {
        $tags = apply_filters( 'yit_convertable_tags', array(
            '%site_url%' => site_url(),
            '%home_url%' => home_url(),
            '%site_name%' => get_bloginfo( 'name' ),
            '%admin_email%' => get_bloginfo( 'admin_email' ),
            '%ip%' => $_SERVER['REMOTE_ADDR']
        ) );

        foreach( $tags as $tag => $placeholder ) {
            $string = str_replace( $tag, $placeholder, $string );
        }

        return $string;
    }
}

if( !function_exists( 'yit_addp' ) ) {
    /**
     * Add paragraph tags to a given string, without damaging the shortcodes.
     *
     * @param string $str The string to convert
     * @return string The string converted
     *
     * @since 1.0
     */
    function yit_addp($str) {
        $sc_pattern = '[a-zA-Z0-9_-]+';
        $str = wpautop( $str );
        $str = preg_replace( '/<\/?p>(\[(.*)\])<\/?p>/', '$1', $str );    // <p>[sc]</p>
        $str = preg_replace( '/(\['.$sc_pattern.'\])[ ]*<\/?p>/', '$1', $str );       // [/sc]</p>
        $str = preg_replace( '/(\[(.*)\])<br \/>/', '$1', $str );         // [/sc]<br />
        $str = preg_replace( '/<\/?p>(\['.$sc_pattern.')/', '$1', $str );           // <p>[sc
        $str = preg_replace( '/(=")<br \/>\n/', '$1', $str );           // ="<br />
        $str = preg_replace( '/\n<\/?p>(")/', '$1', $str );           // <p>"
        $str = do_shortcode( $str );

        return apply_filters( 'yit_addp', $str );
    }
}

if ( ! function_exists( 'yit_string' ) ) {
    /**
     * Simple echo a string, with a before and after string, only if the main string is not empty.
     *
     * @param string $before What there is before the main string
     * @param string $string The main string. If it is empty or null, the functions return null.
     * @param string $after  What there is after the main string
     * @param bool   $echo   If echo or only return it
     *
     * @return string The complete string, if the main string is not empty or null
     * @since 1.0.0
     */
    function yit_string( $before = '', $string = '', $after = '', $echo = true ) {
        $html = '';

        if ( $string != '' AND ! is_null( $string ) ) {
            $html = $before . $string . $after;
        }

        if ( $echo ) {
            echo $html;
        }

        return $html;
    }
}