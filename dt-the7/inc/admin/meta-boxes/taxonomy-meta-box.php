<?php
/**
 * Add taxonomies meta boxes.
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load main class.
require_once PRESSCORE_EXTENSIONS_DIR . '/Tax-meta-class/Tax-meta-class.php';

class The7_Taxonomy_Meta_Box {

	/**
	 * @var string
	 */
	protected $prefix = 'the7_';

	/**
	 * @var string
	 */
	protected $lib_uri = '';

	/**
	 * The7_Taxonomies_MetaBoxes constructor.
	 */
	public function __construct() {
		$this->lib_uri = PRESSCORE_EXTENSIONS_URI . '/Tax-meta-class';

		$this->add_tax_fancy_colors();
	}

	/**
	 * Add taxonomy fancy category bg and text color settings.
	 *
	 * @uses Tax_Meta_Class
	 */
	public function add_tax_fancy_colors() {
		$pages = apply_filters( 'the7_tax_with_common_meta_boxes', array( 'category' ) );

		// Configure meta boxes.
		$config = array(
			'id'             => 'the7_tax_fancy_colors',
			'pages'          => $pages,
			'context'        => 'normal',
			'fields'         => array(),
			'local_images'   => false,
			'use_with_theme' => $this->lib_uri,
		);

		// Init meta boxes.
		$meta_box = new Tax_Meta_Class( $config );

		$meta_box->addColor( $this->prefix . 'fancy_bg_color', array( 'name' => _x( 'Fancy category background', 'backend', 'the7mk2' ) ) );
		$meta_box->addColor( $this->prefix . 'fancy_text_color', array( 'name' => _x( 'Fancy category text color', 'backend', 'the7mk2' ) ) );

		// Finish meta mox declaration.
		$meta_box->Finish();
	}

}

new The7_Taxonomy_Meta_Box();
