<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Your Inspiration Themes
 *
 * @package Yithemes
 * @author  Your Inspiration Themes <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}

// HOOKS
add_action('wp_footer', 'add_custom_script'); //add custom script to footer

// FUNCTIONS
if( ! function_exists( 'add_custom_script' ) ){
    /**
     * Append a script tag to site footer, with the user-define custom script
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    function add_custom_script(){
        $script = stripslashes_deep(get_option( 'yit-custom-script_'.get_template() ) );
        if( $script !== FALSE && strcmp( $script, '' ) != 0 ):
        ?>
        <script>
            <?php echo  $script?>
        </script>
        <?php
        endif;
    }
}

if( !function_exists( 'yit_ie_version' ) ) {
    /**
     * Retrieve IE version.
     *
     * @return int|float
     * @since 1.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function yit_ie_version() {

        if ( ! isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
            return - 1;
        }
        preg_match( '/MSIE ([0-9]+\.[0-9])/', $_SERVER['HTTP_USER_AGENT'], $reg );

        if ( ! isset( $reg[1] ) ) // IE 11 FIX
        {
            preg_match( '/rv:([0-9]+\.[0-9])/', $_SERVER['HTTP_USER_AGENT'], $reg );
            if ( ! isset( $reg[1] ) ) {
                return - 1;
            }
            else {
                return floatval( $reg[1] );
            }
        }
        else {
            return floatval( $reg[1] );
        }
    }
}

if( !function_exists( 'yit_is_old_ie' ) ) {
    /**
     * Retrieve true if is IE9 or IE8, false otherwise.
     *
     * @return bool
     * @since 2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function yit_is_old_ie() {
        global $is_IE;

        $browser_detect = yit_detect_browser_body_class();
        return  ( $is_IE && ( in_array( 'ie8', $browser_detect ) || in_array( 'ie9', $browser_detect ) ) ) ? true : false;
    }
}

if( !function_exists( 'yit_remove_unused_template' ) ) {

    /**
     * @param $dir
     * @param $option
     * @param $files
     * @authot Andrea Frascaspata
     */
    function yit_remove_unused_template($dir, $option, $files)
    {

        if (get_option($option) === false) {

            $error_removed = false;

            $path = get_template_directory();

            foreach ($files as $file) {

                $file = $path . '/' . $dir . '/' . $file;

                if ( file_exists( $file ) ) {
                    if ( ! unlink($file ) ) {
                        $error_removed = true;
                        break;
                    }
                }

            }

            if (!$error_removed) {
                add_option($option, 'yes');
            }

        }

    }

}