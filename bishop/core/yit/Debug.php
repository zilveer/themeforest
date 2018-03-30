<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */


if (!defined('YIT')) exit('Direct access forbidden.');

/**
 * Debug helper class
 *
 * @class YIT_Debug
 * @package	Yithemes
 * @since 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Debug extends YIT_Object {

    /**
     * Debug helper function.
     *
     * This is a wrapper for var_dump() that adds
     * the pre tags, cleans up newlines and indents, and runs
     * htmlentities() before output.
     *
     * @param  array $args The args passed to yit_debug function
     * @since 1.0.0
     * @return string
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public static function vardump( $args = array() ) {
        //$args = func_get_args();
        if( !empty( $args ) ) {
            foreach( $args as $k=>$arg ) {
                // var_dump the variable into a buffer and keep the output
                ob_start();
                var_dump($arg);
                $output = ob_get_clean();

                // neaten the newlines and indents
                $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);

                if(!extension_loaded('xdebug')) {
                    $output = htmlspecialchars($output, ENT_QUOTES);
                }

                $output = '<pre class="yit-debug">'
                    . '<strong>$param_' . ($k+1) . ": </strong>"
                    . $output
                    . '</pre>';
                echo $output;
            }
        } else {
            trigger_error("yit_debug() expects at least 1 parameter, 0 given.", E_USER_WARNING);
        }

        return $args;
    }

}
