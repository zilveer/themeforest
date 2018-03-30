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

if ( ! function_exists( 'yit_is_writable' ) ) {

    /**
     * Check if a file/folder is writable. If not, the function
     * tries to make it writable.
     *
     * @param string $file
     * @param mixed $mode 'auto' or chmod value
     * @since 1.0.0
     * @return bool
     * @author Simone D'Amico
     */
    function yit_is_writable( $file, $mode = 'auto' ) {
        if( is_writable( $file ) ) {
            return true;
        } else {
            if( $mode == 'auto' ) {
                if( is_dir($file) ) {
                    $mode = 0755;
                } else {
                    $mode = 0644;
                }
            }

            return @chmod($file, $mode);
        }
    }
}

if ( ! function_exists( 'yit_file_put_contents' ) ) {
    /**
     * Write a content into a file
     *
     * @param string $file
     * @param mixed $content
     * @return mixed
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    function yit_file_put_contents( $file, $content ) {

        if( yit_is_writable( dirname( $file ) ) ) {
            return file_put_contents( $file, $content );
        } else {
            return false;
        }
    }
}


if( !function_exists( 'yit_locate_template' ) ) {
    /**
     * Locate the templates and return the path of the file found
     *
     * @param string $path The file path, relative to the theme or core templates folder.
     * @param array $var
     * @return string The path of the found file
     * @since 1.0.0
     */
    function yit_locate_template( $path, $var = NULL ){
        $path = ltrim( $path, '/' );
        $theme_path = str_replace( YIT_PATH . '/', '', YIT_THEME_TEMPLATES_PATH . '/' . $path );
        $core_path  = str_replace( YIT_PATH . '/', '', YIT_CORE_TEMPLATES_PATH  . '/' . $path );

        // use locate_template for the child theme
        $located = locate_template( array(
            // theme/templates/$path
            $theme_path,

            // core/templates/$path
            $core_path
        ) );

        return $located;
    }
}


if( !function_exists( 'yit_get_template' ) ) {
    /**
     * Display html templates
     *
     * @param string $path
     * @param array $var
     * @param bool $return
     * @return mixed
     * @since 1.0.0
     */
    function yit_get_template( $path, $var = NULL, $return = false ) {
        $located = yit_locate_template( $path, $var );

        if ( empty( $located ) ) {
            $external_template_path = apply_filters( 'yit_add_external_template_path', '' );
            if( ! empty( $external_template_path ) ){
                $located = $external_template_path . $path;
            }else{
                return;
            }
        }

        if ( $var && is_array( $var ) )
            extract( $var );

        if( $return )
        { ob_start(); }

        // include file located
        include( $located );

        if( $return )
        { return ob_get_clean(); }
    }
}


if( !function_exists( 'yit_debug' ) ) {

    /**
     * More accurated var_dump call
     *
     * The function prints out the var_dump function result with <pre></pre> tags.
     *
     * @return string
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    function yit_debug() {
        $args = func_get_args();
        return YIT_Debug::vardump($args);
    }
}


if( !function_exists( 'yit_format_tab_name' ) ) {
    /**
     * Format options tabs in a most readable way.
     *
     * This method transform the lowercase name of option tabs in a most readable format.
     * Eg. 'theme_options' => 'Theme Options'
     *
     * @param $value string
     * @return string
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    function yit_format_tab_name( $value ) {
        return ucwords( str_replace( array('_', '-'), array(' ', ' '), $value ) );
    }
}


if( !function_exists( 'yit_get_backgrounds') ) {
    /**
     * Retrieve the list of backgrounds contained within the images/backgrounds folder
     *
     * @return array
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    function yit_get_backgrounds() {
        $images = array();

        foreach ( (array) glob( YIT_IMAGES_PATH . '/backgrounds/*' ) as $image ) {
            $images[ YIT_IMAGES_URL . '/backgrounds/' . basename($image) ] = basename($image);
        }

        $images['custom'] = __('Custom', 'yit');

        return $images;
    }
}

if( !function_exists( 'is_shop_installed' ) ) {
    /**
     * Detect if there is a shop plugin installed
     *
     * @return bool
     * @since 2.0.0
     * @author Antonino Scarf� <antonino.scarfi@yithemes.com
     */
    function is_shop_installed() {
        global $woocommerce;
        if( isset( $woocommerce ) || defined( 'JIGOSHOP_VERSION' ) ) {
            return true;
        } else {
            return false;
        }
    }
}

if( !function_exists( 'yit_get_attachment_id' ) ) {
    /**
     * Return the ID of an attachment.
     *
     * @param string $url
     * @return int
     * @since 1.0.0
     */
    function yit_get_attachment_id( $url ) {
        $dir = trailingslashit( YIT_WPCONTENT_URL );

        if( false === strpos( $url, $dir ) )
            return false;

        //$url    = str_replace( array( 'https:' , 'http:' ), '', $url );
        $file   = str_replace( trailingslashit( $dir ), '', $url );

        $query = array(
            'post_type' => 'attachment',
            'fields' => 'ids',
            'meta_query' => array(
                array(
                    'value' => $file,
                    'compare' => 'LIKE',
                )
            )
        );

        $query['meta_query'][0]['key'] = '_wp_attached_file';
        $ids = get_posts( $query );

        foreach( $ids as $id ){
            $attachment_image = wp_get_attachment_image_src($id, 'full');
            if( sizeof( $attachment_image ) > 0 ){
                return $id;
            }
        }
        $query['meta_query'][0]['key'] = '_wp_attachment_metadata';
        $ids = get_posts( $query );

        foreach( $ids as $id ) {

            $meta = wp_get_attachment_metadata($id);
            if ( ! isset( $meta['sizes'] ) ) continue;

            foreach( (array) $meta['sizes'] as $size => $values )
                if( $values['file'] == $file && $url == str_replace( array ( 'https:', 'http:' ), '', array_shift( wp_get_attachment_image_src($id, $size) ) ) ) {

                    return $id;
                }
        }

        return false;
    }
}

if ( ! function_exists( 'yit_post_id' ) ) {
    /**
     * Retrieve the post or page id
     *
     * @return integer
     * @since 1.0.0
     */
    function yit_post_id() {
        global $post;

        $post_id = 0;
        if ( is_posts_page() ) {
            $post_id = get_option( 'page_for_posts' );
        }
        elseif ( is_shop_installed() && ( is_shop() || is_product_category() || is_product_tag() ) ) {
            if ( function_exists( 'wc_get_page_id' ) ) {
                $post_id = wc_get_page_id( 'shop' );
            }
            else {
                $post_id = woocommerce_get_page_id( 'shop' );
            }
        }
        elseif ( isset( $post->ID ) ) {
            $post_id = $post->ID;
        }

        return $post_id;
    }
}

if( !function_exists('yit_content') ){
    /**
     * Return post content with read more link (if needed)
     *
     * @param string      $what
     * @param int|string  $limit
     * @param string      $more_text
     * @param string      $split
     * @param string $in_paragraph
     *
     * @return string
     * @since 1.0.0
     */
    function yit_content( $what = 'content', $limit = 25, $more_text = '', $split = '[...]', $in_paragraph = 'true' ) {
        if ( $what == 'content' )
        { $content = get_the_content('[...]'); }
        else if ( $what == 'excerpt' )
        { $content = get_the_excerpt(); }
        else
        { $content = $what; }

        if ( $limit == 0 ) {
            if( $what == 'excerpt') {
                $content = apply_filters('the_excerpt', $content );
            }
            else {
                $content = preg_replace( '/<img[^>]+./', '', $content ); //remove images
                $content = apply_filters( 'the_content', $content );
                $content = str_replace( ']]>', ']]&gt;', $content );
            }

            return $content;
        }

        // remove the tag more from the content
        if ( preg_match( "/<(a)[^>]*class\s*=\s*(['\"])more-link\\2[^>]*>(.*?)<\/\\1>/", $content, $matches ) ) {

            if( strpos( $matches[0], '[button' ) )
            { $more_link = str_replace( 'href="#"', 'href="' . get_permalink() . '"', do_shortcode( $matches[3] ) ); }
            else
            { $more_link = $matches[0]; }

            $content = str_replace( $more_link, '', $content );
            $split = '';
        }

        if ( empty( $content ) ) return;
        $content = explode( ' ', $content );

        if ( ! empty( $more_text ) && ! isset( $more_link ) ) {
            //array_pop( $content );
            $more_link = strpos( $more_text, '<a class="btn"' ) ? $more_text : '<a class="read-more' . apply_filters( 'yit_simple_read_more_classes', ' ' ) . '" href="' . get_permalink() . '">' . $more_text . '</a>';
            $split = '';
        } elseif ( ! isset( $more_link ) ) {
            $more_link = '';
        }

        // split
        if ( count( $content ) >= $limit ) {
            $split_content = '';
            for ( $i = 0; $i < $limit; $i++ )
                $split_content .= $content[$i] . ' ';

            $content = $split_content . $split;
        } else {
            $content = implode( " ", $content );
        }

        // TAGS UNCLOSED
        $tags = array();
        // get all tags opened
        preg_match_all("/(<([\w]+)[^>]*>)/", $content, $tags_opened, PREG_SET_ORDER);
        foreach ( $tags_opened as $tag )
            $tags[] = $tag[2];

        // get all tags closed and remove it from the tags opened.. the rest will be closed at the end of the content
        preg_match_all("/(<\/([\w]+)[^>]*>)/", $content, $tags_closed, PREG_SET_ORDER);
        foreach ( $tags_closed as $tag )
            unset( $tags[ array_search( $tag[2], $tags ) ] );

        // close the tags
        if ( ! empty( $tags ) )
            foreach ( $tags as $tag )
                $content .= "</$tag>";

        //$content = preg_replace( '/\[.+\]/', '', $content );
        if ($in_paragraph==true): $content .= $more_link; endif;
        $content = preg_replace( '/<img[^>]+./', '', $content ); //remove images
        $content = apply_filters( 'the_content', $content );
        $content = str_replace( ']]>', ']]&gt;', $content );           // echo str_replace( array( '<', '>' ), array( '&lt;', '&gt;' ), $content );
        if ($in_paragraph==false): $content .= $more_link; endif;

        return $content;
    }
}

if( !function_exists( 'yit_string' ) ) {
    /**
     * Simple echo a string, with a before and after string, only if the main string is not empty.
     *
     * @param string $before What there is before the main string
     * @param string $string The main string. If it is empty or null, the functions return null.
     * @param string $after What there is after the main string
     * @param bool $echo If echo or only return it
     *
     * @return string The complete string, if the main string is not empty or null
     * @since 1.0.0
     */
    function yit_string( $before = '', $string = '', $after = '', $echo = true ) {
        $html = '';

        if( $string != '' AND !is_null( $string ) ) {
            $html = $before . $string . $after;
        }

        if( $echo ) {
            echo $html;
        }

        return $html;
    }
}

if( !function_exists( 'yit_detect_browser_body_class' ) ) {
    /**
     * Add the browser class to the body
     *
     * @param array|string $classes
     *
     * @return array
     * @since  2.0.0
     * @author <andrea.grillo@yithemes.com>
     */
    // Browser detection body_class() output
    function yit_detect_browser_body_class( $classes = '' ) {

        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

        if ( $is_lynx )   $classes[] = 'lynx';
        elseif ( $is_gecko )  $classes[] = 'gecko';
        elseif ( $is_opera )  $classes[] = 'opera';
        elseif ( $is_NS4 )    $classes[] = 'ns4';
        elseif ( $is_safari ) $classes[] = 'safari';
        elseif ( $is_chrome ) $classes[] = 'chrome';
        elseif ( $is_IE  && function_exists( 'YIT_Mobile' ) ) {
            if ( YIT_Mobile()->match('MSIE 8.0') ) {
                $classes[] = 'ie8';
                $classes[] = 'ie';
            }
            elseif ( YIT_Mobile()->match('MSIE 9.0') ) {
                $classes[] = 'ie9';
                $classes[] = 'ie';
            }
            elseif ( YIT_Mobile()->match('MSIE 10.0') ) {
                $classes[] = 'ie10';
                $classes[] = 'ie';
            }
            elseif ( YIT_Mobile()->match('rv:11.0') && YIT_Mobile()->match('Trident/7.0') ) {
                $classes[] = 'ie11';
                $classes[] = 'ie';
            }
            else {
                $classes[] = 'ie';
            }
        } else {
                $classes[] = 'ie';
            }

        if ( function_exists( 'YIT_Mobile' ) && YIT_Mobile()->isMobile() ) {

            $classes[] = 'isMobile';
            if     ( YIT_Mobile()->is('AndroidOS') )       $classes[] = 'isAndroid';
            elseif ( YIT_Mobile()->is('iPhone') )          $classes[] = 'isIphone';
            elseif ( YIT_Mobile()->is('iPad') )            $classes[] = 'isIpad';
            elseif ( YIT_Mobile()->is('WindowsMobileOS') ) $classes[] = 'isWindows';
            elseif ( YIT_Mobile()->is('WindowsPhoneOS') )  $classes[] = 'isWindows-phone';

            elseif ( YIT_Mobile()->is('AndroidOS') || YIT_Mobile()->isTablet() )    $classes[] = 'isAndroid-tablet';
            elseif ( YIT_Mobile()->is('BlackBerryOS') || YIT_Mobile()->isTablet() ) $classes[] = 'isBlackberry-tablet';

            elseif ( YIT_Mobile()->is('GenericPhone') || YIT_Mobile()->is('GenericTablet') ) $classes[] = 'isGeneric';

        }

        return $classes;
    }
}

if( ! function_exists( 'yit_admin_post_id' ) ){
    /**
     * Return the post id in admin area
     *
     * @return int | the post id
     * @since  2.0.0
     * @author <andrea.grillo@yithemes.com>
     */

    function yit_admin_post_id(){

        if ( false != YIT_Request()->get( 'post' ) ){
            $post_id = (int) YIT_Request()->get( 'post' );
        }
        elseif ( false != YIT_Request()->post( 'post' ) ){
            $post_id = (int) YIT_Request()->post( 'post' );
        }elseif ( false != YIT_Request()->get( 'post_ID' ) ){
            $post_id = (int) YIT_Request()->get( 'post_ID' );
        }
        elseif ( false != YIT_Request()->post( 'post_ID' ) ){
            $post_id = (int) YIT_Request()->post( 'post_ID' );
        }
        else{
            $post_id = 0;
        }
        return $post_id;
    }
}

if ( ! function_exists( 'yit_custom_style_filename' ) ) {
    /**
     * Return custom style css file
     *
     * @return string | css file name
     * @since  2.0.0
     * @author <andrea.frascaspata@yithemes.com>
     */

    function yit_custom_style_filename() {
        global $wpdb;
        $index = $wpdb->blogid != 0 ? '-' . $wpdb->blogid : '';
        $file_name = 'custom' . $index . '.css';
        // create if not exist

        $file = get_stylesheet_directory() . '/' . $file_name;
        if( !file_exists( $file ) ) {
            $file_res = fopen( $file, 'w' );
            if ( $file_res ) {
                fclose( $file_res );
            }
        }
        //---------------------
        return $file_name;
    }

}

if ( ! function_exists( 'yit_wpml_register_string' ) ) {
    /**
     * Register a string in wpml trnslation
     *
     * @param string
     * @param string
     * @param string
     *
     * @since  2.0.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    function yit_wpml_register_string( $context , $name , $value  ) {
        // wpml string translation
        do_action( 'wpml_register_single_string', $context, $name, $value );
    }
}

if ( ! function_exists( 'yit_wpml_string_translate' ) ) {
    /**
     * Get a string translation
     *
     * @param string
     * @param string
     * @param string
     *
     * @return string the string translated
     * @since  2.0.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    function yit_wpml_string_translate( $context, $name, $default_value ) {
        return apply_filters( 'wpml_translate_single_string', $default_value, $context, $name );
    }
}


if ( ! function_exists( 'yit_get_sidebars' ) ) {
    /**
     * Detect the right layout
     */
    function yit_get_sidebars() {
        $sidebar = function_exists( 'YIT_Layout' ) ? YIT_Layout()->sidebars : array();

        if ( empty( $sidebar ) ) {
            if ( is_single() || is_home() ) {
                $sidebar = array( 'layout' => 'sidebar-right', 'sidebar-right' => 'Default Sidebar' );
            } else {
                $sidebar = array( 'layout' => 'sidebar-no' );
            }
        } elseif ( ! is_array( $sidebar ) ) {
            $sidebar = array( 'layout' => $sidebar );
        }

        return $sidebar;
    }
}