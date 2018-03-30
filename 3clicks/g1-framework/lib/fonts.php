<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Fonts
 * @since G1_Fonts 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


/**
 * Font Manager
 *
 * @package G1_Framework
 * @subpackage G1_Fonts
 */
class G1_Font_Manager {
    /**
     * All registered fonts
     * @var array
     */
    protected $fonts;

    public function __construct() {
        $this->fonts = array();

        $this->setup_hooks();
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        // Register fonts before WP Customizer is ready
        add_action( 'wp_loaded', array( $this, 'do_register' ), 8 );

        // Process fonts after WP Customizer is ready
        add_action( 'wp_loaded', array( $this, 'process'), 12 );
    }


    /**
     * Checks whether a font is registered
     *
     * @param string $id
     * @return bool
     */
    public function has_font( $id ) {
        return isset( $this->fonts[ $id ] );

    }

    /**
     * Adds a new font
     *
     * @param mixed $id
     * @param array $args
     */
    public function add_font( $id, $args = array() ) {
        if ( is_a( $id, 'G1_Font' ) ) {
            $font = $id;
        } else {
            $font = G1_Font_Factory::create( $id, $args );
        }

        if ( $font ) {
            $this->fonts[ $font->get_id() ] = $font;
        }
    }

    /**
     * Gets a font
     *
     * @return G1_Font
     */
    public function get_font( $id ) {
        if ( $this->has_font( $id ) ) {
            return $this->fonts[ $id ];
        }
    }

    /**
     * Removes a font
     *
     * @param string $id
     */
    public function remove_font( $id ) {
        if ( $this->has_font( $id ) ) {
            unset( $this->fonts[ $id ] );
        }
    }

    /**
     * Checks whether there are some registered fonts
     *
     * @return bool
     */
    public function has_fonts() {
        return (bool) count( $this->fonts );
    }

    /**
     * Gets all registered fonts
     *
     * @return array
     */
    public function get_fonts() {
        return $this->fonts;
    }

    /**
     * Get available font choices
     *
     * @return array
     */
    public function get_font_choices() {
        $result = array();

        foreach ( $this->get_fonts() as $id => $font ) {
            // Create proper structure if needed
            if ( !isset ( $result[ $font->get_engine() ] ) ) {
                $result[ $font->get_engine() ] =  array();
            }

            $result[ $font->get_engine() ][ $id ] = $font->get_name();
        }

        return $result;
    }

    /**
     * Get available system font choices
     *
     * @return array
     */
    public function get_system_font_choices() {
        $result = array();

        foreach ( $this->get_fonts() as $id => $font ) {
            if ($font->get_engine() !== G1_System_Font::ENGINE) {
                continue;
            }

            $result[ $id ] = $font->get_name();
        }

        return $result;
    }

    /**
     * Get available FontFace font choices
     *
     * @return array
     */
    public function get_fontface_font_choices() {
        $result = array();

        foreach ( $this->get_fonts() as $id => $font ) {
            if ($font->get_engine() !== G1_Font_Face_Font::ENGINE) {
                continue;
            }

            $result[ $id ] = $font->get_name();
        }

        return $result;
    }

    /**
     * Enables registration of fonts
     */
    public function do_register() {
        do_action( 'g1_font_manager_register', $this );
    }

    /**
     * Processes fonts
     */
    public function process() {
        $config = array(
            'important' => array(
                'selectors' => array(
                    'h1',
                    '.g1-h1',
                    'h2',
                    '.g1-h2',
                    'h3',
                    '.g1-h3',
                    '.g1-button--big',
                    '.g1-numbers__title',
                    '.g1-searchbox input',
                    '.g1-nav--collapsed #g1-primary-nav-menu .g1-type-tile .g1-submenus .g1-nav-item__title',
                )
            ),
            'regular' => array(
                'selectors' => array(
                    'body',
                    'input',
                    'select',
                    'textarea',
                )
            ),
            'meta' => array(
                'selectors' => array(
                    '.g1-meta',
                )
            ),
            'primary_nav' => array(
                'selectors' => array(
                    '#g1-primary-nav-menu > li > a > .g1-nav-item__title',
                    '#g1-header .g1-searchbox__switch',
                    '#g1-header .g1-cartbox__switch',
                )
            ),
        );

        // Apply custom filter
        $config = apply_filters( 'g1_fonts_config', $config );

        $to_process = array();
        $to_load = array();

        foreach ( $config as $id => $args ) {
            $type = g1_get_theme_option( 'style_fonts', $id . '_type' );

            switch ( $type ) {
                case 'system':
                    $font_id = g1_get_theme_option( 'style_fonts', $id . '_system_font' );

                    if ( $this->has_font( $font_id ) ) {
                        $to_process[ $id ] = $font_id;
                        $to_load[] = $font_id;
                    }

                    break;

                case 'font-face':
                    $font_id = g1_get_theme_option( 'style_fonts', $id . '_fontface_font' );

                    if ( $this->has_font( $font_id ) ) {
                        $to_process[ $id ] = $font_id;
                        $to_load[] = $font_id;
                    }

                    break;

                case 'google':
                    $font_id = g1_get_theme_option( 'style_fonts', $id . '_google_font' );

                    if ( !$this->has_font( 'google_' . $font_id ) ) {
                        $this->add_font( new G1_Google_API_Font( 'google_' . $font_id ,  array(
                            'name'	=> $font_id
                        )));
                    }

                    if ( $this->has_font( 'google_' . $font_id ) ) {
                        $to_process[ $id ] = 'google_' . $font_id;
                        $to_load[] = 'google_' . $font_id;
                    }

                    break;
            }
        }

        // Load resources
        foreach ( $to_load as $font_id ) {
            $font = $this->get_font( $font_id );
            $font->load_resources();
        }

        // Process each font
        foreach ( $to_process as $config_id => $font_id ) {
            $font = $this->get_font( $font_id );

            // Bind
            $font->add_config( $config[ $config_id ] );
            $font->process();
        }
    }
}


/**
 * Quasi-Singleton for our main font manager
 *
 * @return G1_Font_Manager
 */
function G1_Font_Manager() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Font_Manager();
    }

    return $instance;
}
// Fire in the hole :)
G1_Font_Manager();





/**
 * Abstract class for all fonts
 *
 * @package G1_Framework
 * @subpackage G1_Fonts
 */
abstract class G1_Font {
    /**
     * Unique identificator
     * @var string
     */
    protected $id;

    /**
     * Name
     * @var
     */
    protected $name;

    /**
     * Config
     * @var array
     */
    protected $config;



    /**
     * Constructor
     *
     * @param string $id
     * @param array $args
     */
    public function __construct( $id, $args ) {
        $this->set_id( $id );

        // name argument
        $this->set_name( isset( $args['name'] ) ? $args['name'] : '' );

        $this->config = array();
    }

    /**
     * Gets the id
     *
     * @return string
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * Sets the id
     *
     * @param string $val
     */
    public function set_id( $val ) {
        $this->id = $val;
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $val
     */
    public function set_name( $val ) {
        $this->name = $val;
    }

    /**
     * Gets the config
     *
     * @return array
     */
    public function get_config() {
        return $this->config;
    }

    /**
     * Sets the config
     *
     * @param array $val
     */
    public function add_config( $config ) {
        $this->config[] = $config;
    }

    /**
     * Gets the engine
     */
    abstract public function get_engine();

    /**
     * Loads required resources for our font
     */
    abstract public function load_resources();

    /**
     * Processes our font
     */
    abstract public function process();
}



/**
 * System Font
 *
 * @package G1_Framework
 * @subpackage G1_Fonts
 */
class G1_System_Font extends G1_Font {
    const ENGINE = 'System_Fonts';

    /**
     * Font stack
     * @var array
     */
    protected $stack;

    /**
     * Constructor
     *
     * @param string $id
     * @param array $args
     */
    public function __construct( $id, $args ) {
        parent::__construct( $id, $args );

        // stack argument
        $this->set_stack( isset( $args['stack'] ) ? $args['stack'] : array() );
    }

    public function set_stack( $arr ) {
        $arr = (array) $arr;

        $this->stack = $arr;
    }

    public function get_stack() {
        return $this->stack;
    }


    /**
     * Gets the engine
     *
     * @return string
     */
    public function get_engine() {
        return self::ENGINE;
    }


    /**
     * Loads required resources for our font
     */
    public function load_resources() {
        // Do nothing here, let OS load fonts :)
    }


    /**
     * Starts processing
     */
    public function process() {
        add_action( 'g1_dynamic_styles', array( $this, 'render_css_rules' ) );
    }


    /**
     * Captures CSS rules based on the config
     *
     * @return string
     */
    public function capture_css_rules() {
        $out = '';
        $config_array = $this->get_config();

        foreach ( $config_array as $config ) {
            $stack = $this->get_stack();
            array_unshift( $stack, $this->get_name() );

            foreach ( $stack as $index => $font ) {
                // Normalize the name
                $font = trim( $font, '"' );

                if ( preg_match( '/\s/', $font ) )
                    $font = '"' . $font . '"';

                $stack[ $index ] = $font;
            }

            $out .= implode( ', ', $config['selectors'] ) . ' {' . "\n" .
                        'font-family:' . implode( ',', $stack ) . ';' . "\n" .
                    '}' . "\n";
        }

        return $out;
    }
    public function render_css_rules() {
        echo $this->capture_css_rules();
    }
}



/**
 * Google API Font
 *
 * @package G1_Framework
 * @subpackage G1_Fonts
 */
class G1_Google_API_Font extends G1_Font {
    /**
     * Gets the engine
     *
     * @return string
     */
    public function get_engine() {
        return 'Google_API';
    }

    /**
     * Loads required resources for our font
     */
    public function load_resources() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    /**
     * Enqueues javascripts
     */
    public function enqueue_scripts() {
        $protocol = is_ssl() ? 'https' : 'http';
        $query_args = array(
            'family' => str_replace( ' ', '+', $this->get_name() ),
            'subset' => urlencode( $this->get_subsets() ),
        );

        $font_id = 'google_font_' . substr(md5($this->get_id()), 0, 8);

        wp_enqueue_style( $font_id, add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
    }

    public function get_subsets () {
        $subsets = 'latin,latin-ext';

        $subset = _x( 'no-subset', 'Google Font Subset (greek, cyrillic, vietnamese)', 'g1_theme' );
        $subset = apply_filters( 'g1_google_font_subset', $subset );

        if ( 'cyrillic' == $subset )
            $subsets .= ',cyrillic,cyrillic-ext';
        elseif ( 'greek' == $subset )
            $subsets .= ',greek,greek-ext';
        elseif ( 'vietnamese' == $subset )
            $subsets .= ',vietnamese';

        return $subsets;
    }

    /**
     * Starts processing
     */
    public function process() {

        add_action( 'g1_dynamic_styles', array( $this, 'render_css_rules' ) );
    }


    /**
     * Captures CSS rules
     *
     * @return string
     */
    public function capture_css_rules() {
        $out = '';
        $config_array = $this->get_config();

        $temp = explode( ':', $this->get_name() );

        $family = str_replace( '+', ' ', $temp[0] );
        $family = "font-family:\"$family\";";

        $weight = '';
        $style = '';

        if ( isset( $temp[1] )  ) {
            $count = 0;

            // italic
            $temp[1] = str_replace( 'italic', '', $temp[1], $count );
            if ( $count ) {
                $style = 'font-style:italic;';
            }

            // font-weight
            $temp[1] = trim( $temp[1], ', ');
            if ( is_numeric( $temp[1] ) ) {
                $weight = "font-weight:$temp[1];";
            }
        }

        foreach ( $config_array as $config ) {
            $out .= implode( ', ', $config['selectors'] ) . " { $family$style$weight }\n";
        }

        return $out;
    }
    public function render_css_rules() {
        echo $this->capture_css_rules();
    }
}



/**
 * font-face Font
 *
 * @package G1_Framework
 * @subpackage G1_Fonts
 */
class G1_Font_Face_Font extends G1_Font {
    const ENGINE = 'Fontface';

    /**
     * Embedded OpenType
     * @var string
     */
    protected $eot;

    /**
     * Web Open Font Format
     * @var string
     */
    protected $woff;

    /**
     * TrueType Font
     * @var string
     */
    protected $ttf;

    /**
     * Scalable Vector Graphics
     * @var string
     */
    protected $svg;



    /**
     * Constructor
     *
     * @param string $id
     * @param array $args
     */
    public function __construct( $id, $args ) {
        parent::__construct( $id, $args );

        // eot argument
        $this->set_eot( isset( $args['eot'] ) ? $args['eot'] : '' );

        // woff argument
        $this->set_woff( isset( $args['woff'] ) ? $args['woff'] : '' );

        // ttf argument
        $this->set_ttf( isset( $args['ttf'] ) ? $args['ttf'] : '' );

        // svg argument
        $this->set_svg( isset( $args['svg'] ) ? $args['svg'] : '' );
    }

    /**
     * Gets the engine
     *
     * @return string
     */
    public function get_engine() {
        return self::ENGINE;
    }

    /**
     * Gets the eot
     *
     * @return string
     */
    public function get_eot() {
        return $this->eot;
    }

    /**
     * Sets the eot
     *
     * @param string $val
     */
    public function set_eot( $val ) {
        $this->eot = $val;
    }

    /**
     * Gets the woff
     *
     * @return string
     */
    public function get_woff() {
        return $this->woff;
    }

    /**
     * Sets the woff
     *
     * @param string $val
     */
    public function set_woff( $val ) {
        $this->woff = $val;
    }

    /**
     * Gets the ttf
     *
     * @return string
     */
    public function get_ttf() {
        return $this->ttf;
    }

    /**
     * Sets the ttf
     *
     * @param string $val
     */
    public function set_ttf( $val ) {
        $this->ttf = $val;
    }

    /**
     * Gets the svg
     *
     * @return string
     */
    public function get_svg() {
        return $this->svg;
    }

    /**
     * Sets the svg
     *
     * @param string $val
     */
    public function set_svg( $val ) {
        $this->svg = $val;
    }

    /**
     * Loads required resources for our font
     */
    public function load_resources() {
        add_action( 'g1_dynamic_styles', array( $this, 'render_definition' ) );
    }

    /**
     * Captures a definition
     *
     * @return string
     */
    public function capture_definition() {
        $out =  '@font-face {' . "\n" .
            'font-family:"' . $this->get_name() . '";' . "\n" .
            'src: url(\'' . esc_url( $this->get_eot() ) . '\');' . "\n" .
            'src: url(\'' . esc_url( $this->get_eot() ) . '?#iefix\') format(\'embedded-opentype\'),' . "\n" .
            'url(\'' . esc_url( $this->get_woff() ) . '\') format(\'woff\'),' . "\n" .
            'url(\'' . esc_url( $this->get_ttf() ) . '\') format(\'truetype\'),' . "\n" .
            'url(\'' . esc_url( $this->get_svg() ) . '#' . $this->get_name() . '\') format(\'svg\');'. "\n" .
            '}' . "\n";

        return $out;
    }
    public function render_definition() {
        echo $this->capture_definition();
    }

    /**
     * Starts processing
     */
    public function process() {
        add_action( 'g1_dynamic_styles', array( $this, 'render_css_rules' ) );
    }

    /**
     * Captures CSS rules
     *
     * @return string
     */
    public function capture_css_rules() {
        $out = '';
        $config_array = $this->get_config();

        foreach ( $config_array as $config ) {
            $out .= implode( ', ', $config['selectors'] ) . ' {' . "\n" .
                'font-family:"' . $this->get_name() . '";' . "\n" .
                '}' . "\n";
        }

        return $out;
    }
    public function render_css_rules() {
        echo $this->capture_css_rules();
    }
}




/**
 * Factory (design pattern) of fonts
 *
 * Always use this factory to create new fonts
 *
 * @package G1_Framework
 * @subpackage G1_Fonts
 */
class G1_Font_Factory {
    const TYPE_GOOGLE_API = 'Google_API';
    const TYPE_FONT_FACE = 'Font_Face';
    const TYPE_SYSTEM = 'System';
    const TYPE_CUFON = 'Cufon';


    /**
     * Creates a new object representing a font
     *
     * @return G1_Font
     */
    static public function create( $id, $args, $type = self::TYPE_GOOGLE_API ) {
        $class_name = explode( '_', $type );

        // Capitalize first letter
        $class_name = array_map( 'ucfirst', $class_name );

        $class_name = implode( '_', $class_name );
        $class_name = 'G1_' . $class_name . '_Font';

        if ( class_exists( $class_name ) ) {
            $control = new $class_name( $id, $args );

            return $control;
        }
    }
}