<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! function_exists( 'yit_get_meta_tags' ) ) {
    /**
     * Retrieve current page keywords and description and return them.
     *
     * @return string
     * @since 1.0.0
     */
    function yit_get_meta_tags() {
        global $post;

        ob_start() ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <?php if ( yit_get_option( 'responsive-enabled' ) ) : ?>
            <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php endif ?>


        <?php return ob_get_clean();
    }
}



if( !function_exists( 'yit_get_favicon' ) ) {
    /**
     * Retrieve the URL of the favicon.
     *
     * @return string
     * @since 1.0.0
     */
    function yit_get_favicon() {
        $url = yit_get_option( 'general-favicon' );

        if( empty( $url ) )
        { $url = get_template_directory_uri() . '/favicon.ico'; }

        if( is_ssl() )
        { $url = str_replace( 'http://', 'https://', $url ); }

        return $url;
    }
}

if( !function_exists( 'yit_print_mobile_favicons' ) ) {
    /**
     * Print the html for mobile devices favicons.
     *
     * @return string
     * @author Andrea Frascaspata    <andrea.frascaspata@yithems.com>
     * @since 1.0.0
     */
    function yit_print_mobile_favicons() {

        // 144: For iPad3 with retina display:
        // 114: for first- and second-generation iPad
        //  72: For first- and second-generation iPad
        //  57: For non-Retina iPhone, iPod Touch, and Android 2.1+ devices

        $size_list = array(144,114,72,57);

        $favicon_base_url =  yit_get_option( 'general-favicon-touch' );

        //yit default favicons
        if ( $favicon_base_url===false || empty( $favicon_base_url ) || $favicon_base_url == get_template_directory_uri() . '/apple-touch-icon-144x.png' ) {

            foreach ( $size_list as $size ) {
                $favicon_url = get_template_directory_uri() . '/apple-touch-icon-'.$size.'x.png';
                if ( is_ssl() ) {
                    $favicon_url = str_replace( 'http://', 'https://', $favicon_url );
                }
                echo '<link rel="apple-touch-icon-precomposed" sizes="' . $size . 'x' . $size . '" href="' . $favicon_url . '" />';
            }

        }
        //custom favicon
        else {

            foreach ( $size_list as $size ) {

                $size_name = 'favicon_' . $size;

                add_image_size( $size_name, $size, $size, true );

                $args['src']  = $favicon_base_url;
                $args['output'] = 'url';
                $args['size'] = $size_name;

                $url = yit_image( $args, false );

                echo '<link rel="apple-touch-icon-precomposed" sizes="' . $size . 'x' . $size . '" href="' . $url . '" />';
            }

        }

    }
}