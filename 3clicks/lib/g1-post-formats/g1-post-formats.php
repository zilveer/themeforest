<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Post_Formats
 * @since G1_Post_Formats 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') ) {
    die ( 'No direct script access allowed' );
}


class G1_Post_Format {
    protected static function get_content ( $post_id = null ) {
        if ( empty( $post_id ) ) {
            global $post;
        } else {
            $post = get_post( $post_id );
        }

        return $post->post_content;
    }

    protected static function find_url ( $content ) {
        if ( strpos( $content, 'http://' ) === 0 || strpos( $content, 'www.' ) === 0 ) {
            return trim( $content );
        }

        return null;
    }

    public static function find_html_tag ( $tag, $content ) {
        $rules = array(
            '/<'.$tag.'[^>]*>.*<\/'.$tag.'>/ism',
            '/<'.$tag.'[^>]*\/>/ism',
            '/<'.$tag.'[^>]*>/ism'
        );

        foreach ($rules as $rule ) {
            if ( preg_match($rule, $content, $matches) ) {
                return $matches[0];
            }
        }

        return null;
    }

    protected static function extract_attr_from_html_tag ( $attr_name, $html_tag ) {
        if ( preg_match( '/'.$attr_name.'=[\'\"]{1}([^\'\"]+)[\'\"]{1}/', $html_tag, $matches ) ) {
            return $matches[1];
        }

        return null;
    }
}

class G1_Post_Format_Audio extends G1_Post_Format {
    public static $allowed_html_tags = array( 'object', 'embed', 'audio' );

    public static function format ( $args ) {
        $defaults = array (
            'post_id'   => null,
            'width'     => null,
            'height'    => null,
            'size'      => null
        );

        $args = wp_parse_args( $args, $defaults );

        extract( $args, EXTR_SKIP );

        $content = self::get_content( $post_id );

        $url = self::find_url( $content );

        if ( !empty( $url ) ) {
            if ( self::is_mp3( $url ) ) {
                return self::format_mp3( $url );
            } else {
                return self::format_oEmbed( $url, $width, $height, $size );
            }
        } else {
            foreach ( self::$allowed_html_tags as $tag ) {
                $html_tag = self::find_html_tag( $tag, $content );

                if ( !empty( $html_tag ) ) {
                    return $html_tag;
                }
            }
        }

        return null;
    }

    protected static function is_mp3 ( $url ) {
        $url = trim( $url );

        return false !== strpos($url, '.mp3');
    }

    protected static function format_mp3 ( $url ) {
        return '[audio_player mp3="'. $url .'"]';
    }

    protected static function format_oEmbed ( $url, $width, $height, $size ) {
        global $wp_embed;

        if ( !empty( $width ) && !empty( $height ) ) {
            $embed = $wp_embed->run_shortcode( '[embed height="' . $height . '" width="' . $width . '"]' . esc_url( $url ) . '[/embed]') ;
        } else if ( !empty( $size ) ) {

            list ( $width, $height ) = g1_get_image_dimensions( $size );

            $embed = $wp_embed->run_shortcode( '[embed height="' . $height . '" width="' . $width . '"]' . esc_url( $url ) . '[/embed]') ;
        } else {
            $embed = $wp_embed->run_shortcode( '[embed]' . esc_url( $url ) . '[/embed]') ;
        }

        return $embed;
    }
}

class G1_Post_Format_Video extends G1_Post_Format {
    public static $allowed_html_tags = array( 'object', 'embed', 'video' );

    public static function format ( $args ) {
        $defaults = array (
            'post_id'   => null,
            'width'     => null,
            'height'    => null,
            'size'      => null
        );

        $args = wp_parse_args( $args, $defaults );

        extract( $args, EXTR_SKIP );

        $content = self::get_content( $post_id );

        $url = self::find_url( $content );

        if ( !empty( $url ) ) {
            return self::format_oEmbed( $url, $width, $height, $size );
        } else {
            foreach ( self::$allowed_html_tags as $tag ) {
                $html_tag = self::find_html_tag( $tag, $content );

                if ( !empty( $html_tag ) ) {
                    return $html_tag;
                }
            }
        }

        return null;
    }

    protected static function format_oEmbed ( $url, $width, $height, $size ) {
        global $wp_embed;

        if ( !empty( $width ) && !empty( $height ) ) {
            $embed = $wp_embed->run_shortcode( '[embed height="' . $height . '" width="' . $width . '"]' . esc_url( $url ) . '[/embed]') ;
        } else if ( !empty( $size ) ) {
            list ( $width, $height ) = g1_get_image_dimensions( $size );

            $embed = $wp_embed->run_shortcode( '[embed height="' . $height . '" width="' . $width . '"]' . esc_url( $url ) . '[/embed]') ;
        } else {
            $embed = $wp_embed->run_shortcode( '[embed]' . esc_url( $url ) . '[/embed]') ;
        }

        $embed = do_shortcode( $embed );

        return $embed;
    }

    public static function capture_only_video( $args ) {
        $defaults = array (
            'post_id'   => null,
            'width'     => null,
            'height'    => null,
            'size'      => null
        );

        $args = wp_parse_args( $args, $defaults );
        extract( $args, EXTR_SKIP );

        $content = self::get_content( $post_id );

        return self::format_oEmbed( $content, $width, $height, $size );
    }
    public static function render_only_video( $args ) {
        echo self::capture_only_video( $args );
    }



    public static function format_featured_video() {
        return 'yo';
    }
}

class G1_Post_Format_Chat extends G1_Post_Format {
    public static $separator = ':';

    protected static $authors;
    protected static $row_counter;

    protected function init () {
        self::$authors = array();
        self::$row_counter = 0;
    }

    public static function format ( $args ) {
        self::init();

        $defaults = array (
            'content'   => null,
            'post_id'   => null
        );

        $args = wp_parse_args( $args, $defaults );

        extract( $args, EXTR_SKIP );

        if ( null === $content ) {
            $content = self::get_content( $post_id );
        }

        $chat_rows = self::split_into_rows( $content );

        $rows_out = '';
        $post_url = get_permalink( $post_id );

        foreach ( $chat_rows as $index => $chat_row ) {
            $rows_out .= self::format_row( $chat_row, $post_url, $index );
        }

        $container_classes = array( 'g1-chat' );

        switch ( count ( self::$authors ) ) {
            case 0:
                $container_classes[] = 'g1-authors-zero';
                break;
            case 1:
                $container_classes[] = 'g1-authors-one';
                break;
            case 2:
                $container_classes[] = 'g1-authors-two';
                break;
            default:
                $container_classes[] = 'g1-authors-multi';
                break;
        }

        $out = '';

        if ( strlen($rows_out) > 0 ) {
            $out =  '<ol class="'. implode( ' ', $container_classes ) .'" id="g1-chat-'. esc_attr( $post_id ) .'">' .
                $rows_out .
            '</ol>';
        }

        $out = apply_filters( 'g1_post_format_chat', $out);

        return $out;
    }

    protected static function format_row ( $row, $post_url, $index ) {
        $out = '';

        $row = strip_tags( trim($row) );

        if ( self::author_specified( $row ) ) {
            $row_parts = explode( self::$separator, trim( $row ), 2 );

            $author = self::sanitize_author( $row_parts[0] );
            $text = self::sanitize_text( $row_parts[1] );

            $row_id = 'g1-chat-row-' . ($index + 1);
            $row_class = array( 'g1-chat-row', 'g1-chat-author-' . self::get_author_id( $author ) );
            $author_class = array( 'g1-chat-author', strtolower( 'g1-chat-author-' . $author ) );

            $index = ++self::$row_counter;

            $out  = '<li id ="'.esc_attr( $row_id ).'" class="' . sanitize_html_classes( $row_class ) .'">';
            $out .=     '<div class="'. sanitize_html_classes( $author_class ) .'">';
            $out .=         '<a href="'. esc_url( $post_url ) .'#'. esc_attr( $row_id ) .'">#</a>';
            $out .=         '<strong>'. esc_html( $author ) .'</strong>';
            $out .=     '</div>';
            $out .=     '<div class="g1-chat-text">';
            $out .=         esc_html( $text );
            $out .=     '</div>';
            $out .= '</li>';

        } else if ( !empty( $row ) ) {
            $text = self::sanitize_text( $row );

            $out = '<div class="g1-chat-row">';
                $out .= '<div class="g1-chat-text">'. esc_html( $text ) .'</div>';
            $out .= '</div>';
        }

        return $out;
    }

    protected static function sanitize_author ( $author ) {
        return strip_tags( trim( $author ) );
    }

    protected static function sanitize_text ( $text ) {
        return str_replace( array( "\r", "\n", "\t" ), '', trim( $text ));
    }

    protected static function author_specified ( $row ) {
        return strpos( $row, self::$separator ) !== false;
    }

    protected static function get_author_id ( $author ) {
        $author = strtolower( $author );

        if ( !in_array( $author, self::$authors ) ) {
            self::$authors[] = $author;
        }

        $author_id = array_search( $author, self::$authors ) + 1;

        return $author_id;
    }

    protected static function split_into_rows ( $content ) {
        return preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );
    }


    public static function capture_rows( $args ) {
        $defaults = array (
            'content'   => null,
            'post_id'   => null,
            'limit'     => 0,
        );

        $args = wp_parse_args( $args, $defaults );

        extract( $args, EXTR_SKIP );

        return '';
    }
    public static function render_rows( $args ) {
        echo self::capture_rows( $args );
    }
}

class G1_Post_Format_Link extends G1_Post_Format {
    public static $allowed_html_tags = array( 'a' );

    protected static $href;

    protected static function init () {
        self::$href = null;
    }

    /**
     * @param mixed $args array or string (query style eg. 'post_id=1')
     *  post_id - WP Post id (default: global post id)
     *  limit - max characters in anchor text (default: 30)
     *  pad - string used for text complement (default: ...)
     */
    public static function format ( $args ) {
        self::init();

        $defaults = array (
            'content'   => null,
            'post_id'   => null,
            'limit'     => 30,
            'pad'       => '...'
        );

        $args = wp_parse_args( $args, $defaults );

        extract( $args, EXTR_SKIP );

        if ( null === $content ) {
            $content = self::get_content( $post_id );
        }

        $url = self::find_url( $content );

        if ( !empty( $url ) ) {
            self::$href = $url;
            $title = get_the_title( $post_id );

            return self::format_link( $url, $title, $limit, $pad );
        } else {
            foreach ( self::$allowed_html_tags as $tag ) {
                $html_tag = self::find_html_tag( $tag, $content );

                if ( !empty( $html_tag ) ) {
                    self::$href = self::extract_attr_from_html_tag( 'href', $html_tag );

                    return $html_tag;
                }
            }
        }

        return null;
    }

    public static function get_first_url( $args = array() ) {
        $defaults = array (
            'content'   => null,
            'post_id'   => null,
        );

        $args = wp_parse_args( $args, $defaults );

        extract( $args, EXTR_SKIP );

        if ( null === $content ) {
            $content = self::get_content( $post_id );
        }

        $url = self::find_url( $content );

        return $url;
    }

    public static function get_url () {
        return self::$href;
    }

    protected static function format_link ( $url, $title, $limit, $pad ) {
        if ( !empty($title) ) {
            $title = g1_truncate_text( trim( $title ), $limit, $pad );
        } else {
            $title = $url;
        }


        return '<a href="'. esc_url( $url ) .'">'. esc_html( $title ) .'</a>';
    }
}

class G1_Post_Format_Quote extends G1_Post_Format {
    public static function format ( $args ) {
        $defaults = array (
            'content' => null,
            'post_id' => null
        );

        $args = wp_parse_args( $args, $defaults );

        extract( $args, EXTR_SKIP );

        if ( null === $content ) {
            $content = self::get_content( $post_id );
        }

        $html_tag = self::find_html_tag( 'blockquote', $content );

        if ( !empty( $html_tag ) ) {
            return $html_tag;
        } else {
            return self::format_blockquote( $content );
        }
    }

    protected static function format_blockquote ( $content ) {
        $content = trim( $content );

        if ( strlen($content) > 0 ) {
            $content = '<blockquote>'. $content .'</blockquote>';
        }

        return $content;
    }
}

class G1_Post_Format_Image extends G1_Post_Format {
    public static $allowed_html_tags = array( 'img' );

    protected static $href;

    protected static function init () {
        self::$href = null;
    }

    /**
     * @param mixed $args array or string (query style eg. 'post_id=1')
     *  post_id - WP Post id (default: global post id)
     *  size - featured media size, if featured media set (default: thumbnail)
     *  width - featured media width, if featured media set (default: null)
     *  height - featured media height, if featured media set (default: null)
     *  limit - max characters in anchor text (default: 30)
     *  pad - string used for text complement (default: ...)
     */
    public static function format ( $args ) {
        self::init();

        $defaults = array (
            'post_id'   => null,
            'size'      => 'thumbnail',
            'width'     => null,
            'height'    => null,
            'limit'     => 30,
            'pad'       => '...'
        );

        $args = wp_parse_args( $args, $defaults );

        extract( $args, EXTR_SKIP );

        $content = self::get_content( $post_id );

        $featured_media_id = get_post_thumbnail_id( $post_id );

        if ( !empty( $featured_media_id ) ) {
            if ( !empty( $width ) && !empty( $height ) ) {
                $size = array( $width, $height );
            }

            $image_data = wp_get_attachment_image_src( $featured_media_id, $size );

            if ( $image_data !== false ) {
                $url = $image_data[0];
            }
        } else {
            $url = self::find_url( $content );
        }

        if ( !empty( $url ) ) {
            self::$href = $url;
            $title = get_the_title( $post_id );

            return self::format_image( $url, $title, $limit, $pad );
        } else {
            foreach ( self::$allowed_html_tags as $tag ) {
                $html_tag = self::find_html_tag( $tag, $content );

                if ( !empty( $html_tag ) ) {
                    self::$href = self::extract_attr_from_html_tag( 'src', $html_tag );

                    return $html_tag;
                }
            }
        }

        return null;
    }

    public static function get_url () {
        return self::$href;
    }

    protected static function format_image ( $url, $title, $limit, $pad ) {
        if ( !empty($title) ) {
            $title = g1_truncate_text( trim( $title ), $limit, $pad );
        } else {
            $title = $url;
        }

        return '<img src="'. esc_url( $url ) .'" alt="'. esc_attr( $title ) .'" />';
    }
}

class G1_Post_Format_Aside extends G1_Post_Format {
    public static function format ( $args ) {
        $defaults = array (
            'post_id'   => null
        );

        $args = wp_parse_args( $args, $defaults );

        extract( $args, EXTR_SKIP );

        $content = self::get_content( $post_id );

        return $content;
    }
}

class G1_Post_Format_Status extends G1_Post_Format {
    public static function format ( $args ) {
        $defaults = array (
            'post_id'   => null
        );

        $args = wp_parse_args( $args, $defaults );

        extract( $args, EXTR_SKIP );

        $content = self::get_content( $post_id );

        return $content;
    }
}

class G1_Post_Format_Gallery extends G1_Post_Format {
    public static function format ( $args ) {
        $defaults = array (
            'post_id'   => null
        );

        $args = wp_parse_args( $args, $defaults );

        extract( $args, EXTR_SKIP );

        return null;
    }
}

if ( ! function_exists( 'get_the_post_format_url' ) ) :
function get_the_post_format_url( $id = 0 ) {
        $post = empty( $id ) ? get_post() : get_post( $id );
        if ( empty( $post ) )
                return '';

        $format = get_post_format( $post->ID );

        if ( in_array( $format, array( 'image', 'link', 'quote' ) ) ) {
            $meta = get_post_format_meta( $post->ID );
            $meta_link = '';

            switch ( $format ) {
                case 'link':
                    if ( ! empty( $meta['link_url'] ) )
                            $meta_link = $meta['link_url'];
                    break;
                case 'image':
                    if ( ! empty( $meta['url'] ) )
                            $meta_link = $meta['url'];
                    break;
                case 'quote':
                    if ( ! empty( $meta['quote_source_url'] ) )
                            $meta_link = $meta['quote_source_url'];
                    break;
            }

            if ( ! empty( $meta_link ) )
                return apply_filters( 'get_the_post_format_url', esc_url_raw( $meta_link ), $post );
        }

        return apply_filters( 'the_permalink', get_permalink() );
}
endif;

if ( ! function_exists( 'get_post_format_meta' ) ) :
function get_post_format_meta( $post_id = 0 ) {
    $meta = get_post_meta( $post_id );
    $keys = array( 'quote', 'quote_source_name', 'quote_source_url', 'link_url', 'gallery', 'audio_embed', 'video_embed', 'url', 'image' );

    if ( empty( $meta ) )
        return array_fill_keys( $keys, '' );

    $upgrade = array(
        '_wp_format_quote_source' => 'quote_source_name',
        '_wp_format_audio' => 'audio_embed',
        '_wp_format_video' => 'video_embed'
    );

    $format = get_post_format( $post_id );
    if ( ! empty( $format ) ) {
        switch ( $format ) {
            case 'link':
                $upgrade['_wp_format_url'] = 'link_url';
                break;
            case 'quote':
                $upgrade['_wp_format_url'] = 'quote_source_url';
                break;
        }
    }

    $upgrade_keys = array_keys( $upgrade );
    foreach ( $meta as $key => $values ) {
        if ( ! in_array( $key, $upgrade_keys ) )
                continue;
        update_post_meta( $post_id, '_format_' . $upgrade[$key], reset( $values ) );
        delete_post_meta( $post_id, $key );
    }

    $values = array();

    foreach ( $keys as $key ) {
        $value = get_post_meta( $post_id, '_format_' . $key, true );
        $values[$key] = empty( $value ) ? '' : $value;
    }

    return apply_filters( 'post_format_meta', $values );
}
endif;

if ( ! function_exists( 'get_content_url' ) ) :
function get_content_url( &$content, $remove = false ) {
    if ( empty( $content ) )
        return '';

    // the content is a URL
    $trimmed = trim( $content );
    if ( 0 === stripos( $trimmed, 'http' ) && ! preg_match( '#\s#', $trimmed ) ) {
        if ( $remove )
            $content = '';

        return $trimmed;
    // the content is HTML so we grab the first href
    } elseif ( preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', $content, $matches ) ) {
        return esc_url_raw( $matches[1] );
    }

    $lines = explode( "\n", $trimmed );
    $line = trim( array_shift( $lines ) );

    // the content is a URL followed by content
    if ( 0 === stripos( $line, 'http' ) ) {
        if ( $remove )
            $content = trim( join( "\n", $lines ) );

        return esc_url_raw( $line );
    }

    return '';
}
endif;
