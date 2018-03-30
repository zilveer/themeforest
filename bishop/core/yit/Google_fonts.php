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
 * Save the theme option in a CSS file
 *
 * @class YIT_Google_Fonts
 * @package    Yithemes
 * @since      1.0.0
 * @author     Andrea Grillo <andrea.grillo@yithemes.com>
 * @author     Antonino Scarfi <antonino.scarfi@yithemes.com>
 *
 */

class YIT_Google_fonts extends YIT_Object {
    /**
     * All google fonts added in the framework
     *
     * @var array
     * @access public
     * @since 1.0.0
     */
    public $fonts = array();

    /**
     * Define here if you want the webfont loader
     *
     * @var array
     * @access protected
     * @since 1.0.0
     */
    protected $_webfont_loader = false;

    /**
     *
     * Class Init -> Select the fonts load method (Webfont Loader or Javascript)
     *
     * @since  1.0.0
     * @return \YIT_Google_Fonts
     * @access public
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @author Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    public function __construct() {

		if ( class_exists( 'googlefonts' ) ) {
			return;
		}

        if ( apply_filters( 'yit_use_webfont_loader', $this->_webfont_loader ) ) {
            add_action( 'wp_print_scripts', array( $this, 'webfont_loader' ), 1 );
        }
        else {
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 1 );
            add_action( 'login_head', array( $this, 'enqueue' ), 1 );
        }
    }

    /**
     * Save the file with all css
     *
     * @param $font string
     *
     * @return mixed
     * @access public
     * @since  1.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @author Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    public function add_google_font( $font ) {
        if ( in_array( $font, $this->fonts ) ) {
            return;
        }

        $this->fonts[] = $font;
    }

    /**
     * Enqueue stylesheets with wp_enqueue_style
     *
     * @return void
     * @access public
     * @since  1.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @author Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    public function enqueue() {

        $base_url        = '//fonts.googleapis.com/css';
        $query_args      = array(
            'family' => ''
        );

        $subsets = yit_get_option( 'google_fonts_subsets', '' );
        if ( ! empty( $subsets ) ) {
            $query_args['subset'] = urlencode( implode( ',', array_shift( $subsets ) ) );
        }

        $i               = 0;
        $srcs            = array();
        $this->fonts     = $this->getModel( 'font' )->load_options_font();

        if ( yit_ie_version() > 8 || yit_ie_version() == - 1 ) { //IE9 or greater and other browser
            foreach ( $this->fonts as $font => $style ) {
                $variations = implode( ',', array_values( $style ) );
                $family = urlencode( $font . ':' . $variations );
                $query_args['family'] = ! empty( $query_args['family'] ) ? implode( '|', array( $query_args['family'], $family ) ) : $family;

                if ( strlen( add_query_arg( $query_args, $base_url ) ) > 1024 ) {
                    $i++;
                    $srcs[$i] = '';
                    $query_args['family'] = '';
                }

                if( ! empty( $font ) && ! empty( $variations ) ) {
                    $srcs[$i] = add_query_arg( $query_args, $base_url );
                }
            }

            foreach ( $srcs as $k => $src ) {

	            if ( $src == $base_url ) {
		            continue;
	            }

                $index = count( $srcs ) > 1 ? '-' . ( $k + 1 ) : '';
                $args = array(
                    'src'       => rtrim( str_replace( ' ', '+', $src ), '|' ),
                    'enqueue'   => true
                );

                YIT_Asset()->set( 'style', 'google-fonts' . $index, $args );
            }
        }
        else { //IE8 Support
            foreach ( $this->fonts as $font => $style ) {
                $variations = implode( ',', array_values( $style ) );
                $query_args['family'] = urlencode( $font . ':' . $variations );

                $args = array(
                    'src'       => add_query_arg( $query_args, $base_url ),
                    'enqueue'   => true
                );
                YIT_Asset()->set( 'style', sanitize_title( $font ), $args );
            }
        }
    }

    /**
     * This method add the Webfont Loader powered by Google
     *
     * @return void
     * @access public
     * @since  1.0.0
     * @see    https://developers.google.com/fonts/docs/webfont_loader
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @author Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
public function webfont_loader() {
    ?>
    <script type="text/javascript">
        WebFontConfig = {
            google: { families: <?php echo json_encode( $this->fonts ); ?> }
        };
        (function () {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
<?php
}
}