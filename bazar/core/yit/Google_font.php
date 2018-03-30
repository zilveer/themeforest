<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * This class manage the google font in the system.
 * 
 * You need simply add the google font by using the call yit_add_google_font( 'fontname' );
 * The class will include the google fonts in the system, by using the google fonts api.      
 * 
 * @since 1.0.0
 */
class YIT_Google_font {
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
     * Init of class
     * 
     * @since 1.0.0
     */
    public function init() {
        if ( apply_filters( 'yit_use_webfont_loader', $this->_webfont_loader ) ) {
            add_action( 'wp_print_scripts', array( &$this, 'webfont_loader' ), 1 );
        } else {
		    add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue' ), 1 );
		    add_action( 'login_head', array( &$this, 'enqueue' ), 1 );
		}
    }
    
    /**
     * Save the file with all css
     * 
     * @return bool
     * @since 1.0.0
     */
    public function add_google_font( $font ) {
        if ( in_array( $font, $this->fonts ) )
            { return; }
           
        $this->fonts[] = $font;
    }
    
    /**
	 * Enqueue stylesheets with wp_enqueue_style
	 * 
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueue() {
		$subsets = yit_get_option('google_fonts_subsets');
		$subsets = $subsets ? 'subset=' . implode(',', $subsets) . '&' : '';
		
        $base_url = '//fonts.googleapis.com/css?'. $subsets . 'family=';
        $i = 0;
        $srcs = array( $base_url );
        
        if( yit_ie_version() > 8 || yit_ie_version() == -1 ) {
            foreach ( $this->fonts as $font ) {
                if ( strlen( $srcs[$i] . $font ) > 1024 ) {
                    $i++;
                    $srcs[$i] = $base_url;
                }        
                $srcs[$i] .= $font . '|';       
            }    
            
            foreach ( $srcs as $k => $src ) {
                $index = count( $srcs ) > 1 ? '-' . ($k+1) : '';
                wp_enqueue_style( 'google-fonts' . $index, rtrim( str_replace( ' ', '+', $src ), '|' ) );    
            }
        } else {
            foreach ( $this->fonts as $font ) {
                wp_enqueue_style( $font . '-font', $base_url . str_replace( ' ', '+', $font ) );      
            }  
        }                                               
        
	}
	
	/**
	 * Webfont Loader
	 * 
	 * @since 1.0.0
	 */
    public function webfont_loader() {
        ?>
        <script type="text/javascript">
          WebFontConfig = {
            google: { families: <?php echo json_encode( $this->fonts ); ?> }
          };
          (function() {
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

if ( ! function_exists( 'yit_add_google_font' ) ) {
    /**
     * Save the file with all css
     * 
     * @return bool
     * @since 1.0.0
     */
    function yit_add_google_font( $font ) {
        yit_get_model('google_font')->add_google_font( $font );
    }
}