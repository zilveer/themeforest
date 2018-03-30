<?php
/**
 * Search for terms and associate data with them.
 *
 * @since Listify 1.5.0
 */
abstract class 
	Listify_Customize_Control_TermSearch
extends 
	WP_Customize_Control {

	/**
	 * @var $type
	 * @access public
	 */
	public $type;

	/**
	 * The taxonomy the terms are associated with
	 *
	 * @var $taxonomy
	 * @access public
	 */
	public $taxonomy;

	/**
	 * Existing terms that have information associated with them.
	 * 
	 * array(
	 *   'key' => 'marker-color-123',
	 *   'value' => '#ffffff'
	 *   'label' => 'Bars'
	 * )
	 *
	 * @var array $existing_terms An array of previously set theme mods and terms.
	 * @access public
	 */
	public $existing_terms;

	/**
	 * Set our custom arguments to class properties, and other things.
	 *
	 * @since 1.5.0
	 * @param oject $manager WP_Customize_Manager
	 * @param string $id
	 * @param array $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$defaults = array(
			'taxonomy' => 'job_listing_category',
			'existing_terms' => array(),
			'options' => 'id,name',
		);

		$args = wp_parse_args( $args, $defaults );

		$this->taxonomy = $args[ 'taxonomy' ];
		$this->existing_terms = $args[ 'existing_terms' ];
		$this->options = $args[ 'options' ];

		add_action( 'customize_controls_print_scripts', array( $this, 'edit_term_content_template' ) );

		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Add extra properties to JSON to pass to to the preview iframe.
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$this->json[ 'existing_terms' ] = $this->existing_terms;
		$this->json[ 'taxonomy' ] = $this->taxonomy;
		$this->json[ 'placeholder' ] = __( 'Search...', 'listify' );
		$this->json[ 'options' ] = $this->options;
	}

	/**
	 * Render custom control markup.
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function render_content() {}

	/**
	 * Custom term color JS underscore template.
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function edit_term_content_template() {}

	/**
	 * Enqueue custom scripts
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function enqueue() {
		parent::enqueue();

		wp_enqueue_script( 'listify-term-search', get_template_directory_uri() . '/inc/customizer/assets/js/controls/term-search.js', array( 'listify-bigchoices', 'jquery', 'customize-controls', 'listify-select2' ), false, true );

		wp_enqueue_style( 'listify-term-search', get_template_directory_uri() . '/inc/customizer/assets/css/term-search.css' , array( 'listify-select2-customizer' ), 20160811 );
	}

}
