<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class DT_Shortcode_With_Inline_Css
 */
abstract class DT_Shortcode_With_Inline_Css extends DT_Shortcode {

	/**
	 * Shortcode name.
	 *
	 * @var string
	 */
	protected $sc_name;

	/**
	 * Shortcode attributes.
	 *
	 * @var array
	 */
	protected $atts = array();

	/**
	 * Shortcode default attributes.
	 *
	 * @var array
	 */
	protected $default_atts = array();

	/**
	 * Shortcode unique id.
	 *
	 * @var int
	 */
	protected $sc_id = 1;

	/**
	 * Shortcode unique class base part.
	 *
	 * @var string
	 */
	protected $unique_class_base = '';

	/**
	 * Shortcode unique class. Generated with DT_Shortcode_With_Inline_Css::get_unique_class().
	 *
	 * @var string
	 */
	protected $unique_class = '';

	/**
	 * @var bool
	 */
	protected static $inline_css_printed = false;

	/**
	 * DT_Shortcode_With_Inline_Css constructor.
	 */
	public function __construct() {
		add_filter( "the7_generate_sc_{$this->sc_name}_css", array( $this, 'generate_inline_css' ), 10, 2 );
	}

	/**
	 * Base shortcode callback. Return shortcode HTML.
	 *
	 * @param array  $atts
	 * @param string $content
	 *
	 * @return string
	 */
	public function shortcode( $atts, $content = '' ) {
		$this->reset_shortcode();
		$this->sanitize_attributes( $atts );

		if ( presscore_vc_is_inline() ) {
			return $this->get_vc_inline_html();
		}

		$this->backup_post_object();
		$this->backup_theme_config();
		$this->setup_config();

		ob_start();
		$this->print_inline_css();
		$this->do_shortcode( $atts, $content = '' );
		$output = ob_get_clean();

		$this->restore_theme_config();
		$this->restore_post_object();

		return $output;
	}

	/**
	 * Generate shortcode inline css from provided less file.
	 *
	 * @param string $css
	 * @param array  $atts
	 *
	 * @return string
	 */
	public function generate_inline_css( $css = '', $atts = array() ) {
		if ( ! class_exists( 'lessc', false ) ) {
			return $css;
		}

		$this->reset_shortcode();
		$this->sanitize_attributes( $atts );

		$less_file_name = $this->get_less_file_name();

		try {
			$lessc = new lessc();

			// Include custom lessphp functions.
			require_once trailingslashit( PRESSCORE_EXTENSIONS_DIR ) . 'less-vars/class-lessphp-functions.php';

			DT_LessPHP_Functions::register_functions( $lessc );

			$lessc->setVariables( (array) $this->get_less_vars() );
			$css .= $lessc->compileFile( $less_file_name );
		} catch ( Exception $e ) {
			return $css;
		}

		return $css;
	}

	/**
	 * Register shortcode.
	 *
	 * @uses DT_Shortcode_With_Inline_Css::sc_name
	 */
	public function add_shortcode() {
		if ( $this->sc_name ) {
			add_shortcode( $this->sc_name, array( $this, 'shortcode' ) );
		}
	}

	/**
	 * Output shortcode HTML.
	 *
	 * @param array  $atts
	 * @param string $content
	 */
	abstract protected function do_shortcode( $atts, $content = '' );

	/**
	 * Setup theme config for shortcode.
	 */
	abstract protected function setup_config();

	/**
	 * Return array of prepared less vars to insert to less file.
	 *
	 * @return array
	 */
	abstract protected function get_less_vars();

	/**
	 * Return shortcode less file absolute path to output inline.
	 *
	 * @return string
	 */
	abstract protected function get_less_file_name();

	/**
	 * Return dummy html for VC inline editor.
	 *
	 * @return string
	 */
	abstract protected function get_vc_inline_html();

	/**
	 * Reset shortcode params. Used for unique class forming.
	 */
	protected function reset_shortcode() {
		$this->unique_class = '';
		$this->atts = array();
	}

	/**
	 * Sanitize shortcode attributes.
	 *
	 * @param array $atts
	 */
	protected function sanitize_attributes( $atts ) {
		$this->atts = shortcode_atts( $this->default_atts, $atts );
	}

	/**
	 * Return unique shortcode class like {$unique_class_base}-{$sc_id}.
	 *
	 * @return string
	 */
	protected function get_unique_class() {
		if ( ! $this->unique_class ) {
			$this->unique_class = $this->unique_class_base . '-' . $this->sc_id++;
		}

		return $this->unique_class;
	}

	/**
	 * Return $att_name attribute value or default one if empty.
	 *
	 * @param string $att_name
	 * @param string $default
	 *
	 * @return string
	 */
	protected function get_att( $att_name, $default = null ) {
		$val = $this->atts[ $att_name ];
		if ( '' !== $val ) {
			return $val;
		}

		if ( ! is_null( $default ) ) {
			return $default;
		}

		if ( array_key_exists( $att_name, $this->default_atts ) ) {
			return $this->default_atts[ $att_name ];
		}

		return $val;
	}

	/**
	 * Return sanitized boolean value.
	 *
	 * @param string $att_name
	 * @param string $default
	 *
	 * @return bool
	 */
	protected function get_flag( $att_name, $default = null ) {
		return apply_filters( 'dt_sanitize_flag', $this->get_att(  $att_name, $default ) );
	}

	/**
	 * Print inline css. It depends on self::$inline_css_printed and output only if it's false.
	 *
	 * @return bool
	 */
	protected function print_inline_css() {
		if ( self::$inline_css_printed ) {
			return false;
		}

		self::$inline_css_printed = true;

		$inline_css = get_post_meta( get_the_ID(), 'the7_shortcodes_inline_css', true );
		if ( $inline_css ) {
			echo '<style type="text/css" data-type="the7_shortcodes-inline-css">';
			echo $inline_css;
			echo '</style>';
		}

		return true;
	}

}