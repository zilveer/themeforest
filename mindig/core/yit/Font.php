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
 * Fonts handler.
 *
 * It can handle Google Fonts and Web fonts
 *
 * @class YIT_Font
 * @package    Yithemes
 * @since      1.0.0
 * @author     Your Inspiration Themes
 *
 */

class YIT_Font extends YIT_Object {

    /**
     * @var string The URL of Google Font Jsonp file
     */
    protected $_google_font_url = 'http://niubbys.altervista.org/google_fonts_v2.0.php';


    /**
     * @var string The name of Google Font Json file
     */
    protected $_google_font_file_name = 'google_font.json';

    /**
     * @var array Save the array with all google fonts
     */
    public $google_fonts = array();

    /**
     * @var array web fonts
     */
    public $web_fonts = array(
        'default'             => 'Default Theme Font',
        'Arial'               => 'Arial, Helvetica',
        'Arial Black'         => '"Arial Black", Gadget',
        'Comic Sans MS'       => '"Comic Sans MS", cursive',
        'Courier New'         => '"Courier New", Courier, monospace',
        'Georgia'             => 'Georgia',
        'Impact'              => 'Impact, Charcoal',
        'Lucida Console'      => '"Lucida Console", Monaco, monospace',
        'Lucida Sans Unicode' => '"Lucida Sans Unicode", "Lucida Grande"',
        'Tahoma'              => 'Tahoma, Geneva',
        'Trebuchet MS'        => '"Trebuchet MS", Helvetica',
        'Verdana'             => 'Verdana, Geneva'
    );



    /**
     * @var array Font awesome
     */
    public $font_awesome = array(
        'adjust', 'adn', 'align-center', 'align-justify', 'align-left', 'align-right', 'ambulance', 'anchor', 'android', 'angle-down', 'angle-left', 'angle-right', 'angle-up', 'apple', 'archive', 'arrow-down', 'arrow-left', 'arrow-right', 'arrow-up', 'asterisk', 'backward', 'ban-circle', 'bar-chart', 'barcode', 'beaker', 'beer', 'bell', 'bell-alt', 'bitbucket', 'bitbucket-sign', 'bitcoin', 'bold', 'bolt', 'book', 'bookmark', 'bookmark-empty', 'briefcase', 'bug', 'building', 'bullhorn', 'bullseye', 'calendar', 'calendar-empty', 'camera', 'camera-retro', 'caret-down', 'caret-left', 'caret-right', 'caret-up', 'certificate', 'check', 'check-minus', 'check-sign', 'chevron-down', 'chevron-left', 'chevron-right', 'chevron-sign-down', 'chevron-sign-left', 'chevron-sign-right', 'chevron-sign-up', 'chevron-up', 'circle', 'circle-arrow-down', 'circle-arrow-left', 'circle-arrow-right', 'circle-arrow-up', 'circle-blank', 'cloud', 'cloud-download', 'cloud-upload', 'code', 'code-fork', 'coffee', 'collapse', 'collapse-alt', 'collapse-top', 'columns', 'comment', 'comment-alt', 'comments', 'comments-alt', 'compass', 'copy', 'credit-card', 'crop', 'css3', 'cut', 'dashboard', 'desktop', 'dollar', 'double-angle-down', 'double-angle-left', 'double-angle-right', 'double-angle-up', 'download', 'download-alt', 'dribbble', 'dropbox', 'edit', 'edit-sign', 'eject', 'ellipsis-horizontal', 'ellipsis-vertical', 'envelope', 'envelope-alt', 'eraser', 'euro', 'exchange', 'exclamation', 'exclamation-sign', 'expand', 'expand-alt', 'external-link', 'external-link-sign', 'eye-close', 'eye-open', 'facebook', 'facebook-sign', 'facetime-video', 'fast-backward', 'fast-forward', 'female', 'fighter-jet', 'file', 'file-alt', 'file-text', 'file-text-alt', 'film', 'filter', 'fire', 'fire-extinguisher', 'flag', 'flag-alt', 'flag-checkered', 'flickr', 'folder-close', 'folder-close-alt', 'folder-open', 'folder-open-alt', 'font', 'food', 'forward', 'foursquare', 'frown', 'fullscreen', 'gamepad', 'gbp', 'gear', 'gears', 'gift', 'github', 'github-alt', 'github-sign', 'gittip', 'glass', 'globe', 'google-plus', 'google-plus-sign', 'group', 'h-sign', 'hand-down', 'hand-left', 'hand-right', 'hand-up', 'hdd', 'headphones', 'heart', 'heart-empty', 'home', 'hospital', 'html5', 'inbox', 'indent-left', 'indent-right', 'info', 'info-sign', 'instagram', 'italic', 'key', 'keyboard', 'laptop', 'leaf', 'legal', 'lemon', 'level-down', 'level-up', 'lightbulb', 'link', 'linkedin', 'linkedin-sign', 'linux', 'list', 'list-alt', 'list-ol', 'list-ul', 'location-arrow', 'lock', 'long-arrow-down', 'long-arrow-left', 'long-arrow-right', 'long-arrow-up', 'magic', 'magnet', 'mail-forward', 'mail-reply', 'mail-reply-all', 'male', 'map-marker', 'maxcdn', 'medkit', 'meh', 'microphone', 'microphone-off', 'minus', 'minus-sign', 'minus-sign-alt', 'mobile-phone', 'money', 'moon', 'move', 'music', 'ok', 'ok-circle', 'ok-sign', 'paperclip', 'paste', 'pause', 'pencil', 'phone', 'phone-sign', 'picture', 'pinterest', 'pinterest-sign', 'plane', 'play', 'play-circle', 'play-sign', 'plus', 'plus-sign', 'plus-sign-alt', 'power-off', 'print', 'pushpin', 'puzzle-piece', 'qrcode', 'question', 'question-sign', 'quote-left', 'quote-right', 'random', 'refresh', 'remove', 'remove-circle', 'remove-sign', 'renminbi', 'renren', 'reorder', 'reply-all', 'resize-full', 'resize-horizontal', 'resize-small', 'resize-vertical', 'retweet', 'road', 'rocket', 'rotate-left', 'rotate-right', 'rss', 'rss-sign', 'rupee', 'save', 'screenshot', 'search', 'share', 'share-sign', 'shield', 'shopping-cart', 'sign-blank', 'signal', 'signin', 'signout', 'sitemap', 'skype', 'smile', 'sort', 'sort-by-alphabet', 'sort-by-alphabet-alt', 'sort-by-attributes', 'sort-by-attributes-alt', 'sort-by-order', 'sort-by-order-alt', 'sort-down', 'sort-up', 'spinner', 'stackexchange', 'star', 'star-empty', 'star-half', 'star-half-full', 'step-backward', 'step-forward', 'stethoscope', 'stop', 'strikethrough', 'subscript', 'suitcase', 'sun', 'superscript', 'table', 'tablet', 'tag', 'tags', 'tasks', 'terminal', 'text-height', 'text-width', 'th', 'th-large', 'th-list', 'thumbs-down', 'thumbs-down-alt', 'thumbs-up', 'thumbs-up-alt', 'ticket', 'time', 'tint', 'trash', 'trello', 'trophy', 'truck', 'tumblr', 'tumblr-sign', 'twitter', 'twitter-sign', 'umbrella', 'unchecked', 'underline', 'unlink', 'unlock', 'unlock-alt', 'upload', 'upload-alt', 'user', 'user-md', 'vk', 'volume-down', 'volume-off', 'volume-up', 'warning-sign', 'weibo', 'windows', 'won', 'wrench', 'xing', 'xing-sign', 'yen', 'youtube', 'youtube-play', 'youtube-sign', 'zoom-in', 'zoom-out',
    );

    /**
     * Constructor
     * @since  1.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function __construct() {

        //if file doesn' t exist it wuill be downloade(just one time)
        if( ! $this->getModel( 'cache' )->read( $this->_google_font_file_name ) ) {
            add_action( 'admin_init', array( $this, 'get_google_font_json_file' ), 20 );
        }

    }

    /**
     * Get Google Fonts
     *
     * @return array|mixed
     */
    public function get_google_fonts() {
        if ( empty( $this->google_fonts ) ) {
            $this->google_fonts = json_decode( $this->getModel( 'cache' )->read( $this->_google_font_file_name ) );
        }
        return $this->google_fonts;
    }

    /**
     * Send a request to Google and retrive a list of fonts. Then send it to an internal method
     * which will cache json datas.
     *
     * @return void
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function get_google_font_json_file() {
        $cache = $this->getModel( 'cache' );
        if ( $cache->is_expired( $this->_google_font_file_name ) ) {

            $jsonp_file = wp_remote_get( $this->_google_font_url );

            if ( ! is_wp_error( $jsonp_file ) ) {

                //Convert a Jsonp to Json
                $jsonp            = wp_remote_retrieve_body( $jsonp_file );
                $google_font_json = preg_replace( '/.+?({.+}).+/', '$1', $jsonp );

                $this->save_google_fonts_json( $google_font_json );
            }
        }
    }

    /**
     * Save json Google Fonts in the cache
     *
     * @param string $google_font_json A Google Font Json String
     *
     * @internal param \YIT_Cache $cache A YIT_Cache Object to save the Json file into a cache dir
     * @return void
     * @since    2.0.0
     * @author   Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function save_google_fonts_json( $google_font_json ) {
        $cache = $this->getModel( 'cache' );

        $font_to_array = json_decode( $google_font_json, true );

        if ( $google_font_json != null && $google_font_json != '' && count( $font_to_array['items'] ) != 0 ) {

            $this->google_fonts = json_encode( $font_to_array['items'] );
            $cache->save( $this->_google_font_file_name, $this->google_fonts );
        }
    }

    /**
     * Return an array with a List of Google Fonts (include variations)
     *
     *
     * @return array
     * @since    2.0.0
     * @author   Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function get_google_fonts_to_array() {
        $google_fonts_array = $this->get_google_fonts();
        $google_fonts       = array();

        foreach ( $google_fonts_array as $font => $variations ) {
            foreach ( $variations as $key => $variation ) {
                $google_fonts[] = $font . ':' . $variation;
            }
        }
        return $google_fonts;
    }

    /**
     * Return an array with a List of Google Fonts that i need to load on frontend (include variations)
     *
     * @return array
     * @since    1.0.0
     * @author   Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function load_options_font() {
        $google_fonts_to_load = array();
        $theme_options_fonts  = $this->getModel( 'panel' )->get_option_by( 'type', 'typography' );

        foreach ( $theme_options_fonts as $option ) {
            $option_value = yit_get_option( $option['id'] );

            if ( isset( $option_value['family'] ) && $option_value['family'] == 'default' ) {
                $default_font = yit_get_option( $option['default_font_id'] );
                $option_value['family'] = $default_font['family'];
            }

            if ( isset( $option_value['family'] ) && ! array_key_exists( $option_value['family'], $this->web_fonts ) ) {

                if ( isset( $option_value['style'] ) ) {
                    $option_value['style'] = str_replace('bold-italic', 'bolditalic', $option_value['style']);
                    $option_value['style'] = str_replace('bold', '700', $option_value['style']);
                    $google_font = array( $option_value['family'] => $option_value['style'] );
                }
                else {
                    $google_font = array( $option_value['family'] => 'regular' );
                }
                if ( ! array_key_exists( $option_value['family'], $google_fonts_to_load ) ) {
                    $google_fonts_to_load = array_merge( $google_fonts_to_load, array( $option_value['family'] => array( $google_font[$option_value['family']] ) ) );
                }
                elseif ( ! in_array( $google_font[ $option_value['family'] ], $google_fonts_to_load[ $option_value['family'] ] ) ) {
                    $google_fonts_to_load[$option_value['family']] = array_merge( $google_fonts_to_load[$option_value['family']], array( $google_font[$option_value['family']] ) );
                }
            }


        }
        return $google_fonts_to_load;
    }
}

if ( ! function_exists( 'yit_get_json_web_fonts' ) ) {
    /**
     * Return a json item with a List of web fonts (used for theme options)
     *
     * @see core\templates\admin\type\typography.php
     * @return array
     * @since    1.0.0
     * @author   Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function yit_get_json_web_fonts() {
        $font       = YIT_Registry::get_instance()->font;
        $web_fonts  = apply_filters( 'yit_web_fonts', $font->web_fonts );

        return json_encode( array( 'items' => array_keys( $web_fonts ) ) );
    }
}

if ( ! function_exists( 'yit_get_json_google_fonts' ) ) {
     /**
     * Return a json item with a List of Google Fonts (used for theme options)
     *
     * @see core\templates\admin\type\typography.php
     * @return array
     * @since    1.0.0
     * @author   Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function yit_get_json_google_fonts() {
        $font = YIT_Registry::get_instance()->font;

        return json_encode( array( 'items' => ( $font->get_google_fonts() ) ) );
    }
}
