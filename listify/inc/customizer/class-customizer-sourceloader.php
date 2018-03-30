<?php
/**
 * Source loader
 *
 * Manage things that can contain multiple sources of data. This includes
 * things like fonts, icons, etc. 
 *
 * @since 1.5.0
 */
class 
	Listify_Customizer_SourceLoader 
implements 
	Listify_Customizer_SourceLoaderInterface {

	/**
	 * @var $files
	 * @access public
	 */
	public $files = array();

	/**
	 * @var $sources
	 * @access public
	 */
	public $sources = array();

	/**
	 * @since 1.5.0
	 * @return void
	 */
	public function __construct() {
		$this->includes();
	}

	/**
	 * Include needed files
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function includes() {
		foreach ( $this->files as $file ) {
			include_once( get_template_directory() . '/inc/customizer/'. $file );
		}
	}
	
	/**
	 * Add a font source as a special type of module.
	 *
	 * @since 1.5.0
	 * @param string $source_id
	 * @param Listify_Customizer_Font_Source $source
	 * @return bool
	 */
	public function add_source( $source_id, $source ) {
		$this->sources[ $source_id ] = $source;
	}

	/**
	 * Get a font source module.
	 *
	 * @since 1.5.0
	 * @param string $source_id
	 * @return Listify_Customize_Font_Source|null
	 */
	public function get_source( $source_id ) {
		if ( $this->has_source( $source_id ) ) {
			return $this->sources[ $source_id ];
		}

		return null;
	}

	/**
	 * Check if a particular font source exists, based on its ID.
	 *
	 * @since 1.5.0
	 * @param string $source_id
	 * @return bool
	 */
	public function has_source( $source_id ) {
		return isset( $this->sources[ $source_id ] );
	}

	/**
	 * Get all sources
	 *
	 * @since 1.5.0
	 * @return array $sources
	 */
	public function get_sources() {
		return $this->sources;
	}

	/**
	 * Check if this source has a particular item.
	 *
	 * @since 1.5.0
	 * @param string $item
	 * @return bool
	 */
	public function has_item( $item, $source_id = null ) {
		$data = $this->get_item_data( $item, $source_id );

		return ! empty( $data );
	}

	/**
	 * Get the source of a particular item, if it exists.
	 *
	 * Returns the source object, or just the source's ID.
	 *
	 * @since 1.5.0
	 * @param string $item
	 * @param string $return
	 * @return Listify_Customize_Font_Source|string|null
	 */
	public function get_item_source( $item, $return = 'object' ) {
		foreach ( $this->get_sources() as $source ) {
			if ( $this->has_item( $item, $source->get_id() ) ) {
				return ( 'id' === $return ) ? $source->get_id() : $source;
			}
		}
		return null;
	}

	/**
	 * Get the data for a particular item, if it exists.
	 *
	 * @since 1.5.0
	 * @param string $item
	 * @param string $source_id
	 * @return array
	 */
	public function get_item_data( $item, $source_id = null ) {
		$item_data = array();

		// Look for the font in a particular source.
		if ( ! is_null( $source_id ) && $this->has_source( $source_id ) ) {
			$item_data = $this->get_source( $source_id )->get_item_data( $item );

			if ( ! empty( $item_data ) ) {
				$item_data[ 'source' ] = $this->get_source( $source_id )->get_id();
			}
		}

		// Search all sources for the stack.
		else {
			$source = $this->get_item_source( $item );

			if ( ! is_null( $source ) ) {
				$item_data = $source->get_item_data( $item );
				if ( ! empty( $item_data ) ) {
					$item_data[ 'source' ] = $source->get_id();
				}
			}
		}

		return $item_data;
	}

	/**
	 * Get the array of all source choices, or for a particular source.
	 *
	 * If headings are set to true, extra array items will be added as separators between sources.
	 *
	 * @since 1.5.0
	 *
	 * @param string $source_id
	 * @param bool $headings
	 * @return array
	 */
	public function get_item_choices( $source_id = null, $headings = true ) {
		$heading_prefix = 'listify-choice-heading-';
		$choices = array();

		// Get choices from a single source
		if ( ! is_null( $source_id ) && $this->has_source( $source_id ) ) {
			$choices = $this->get_source( $source_id )->get_choices();

			if ( true === $headings ) {
				$label = $this->get_source( $source_id )->get_label();
				$choices = array_merge( array( $heading_prefix . $source_id => $label ), $choices );
			}

			return $choices;
		}

		// Get all choices
		foreach ( $this->get_sources() as $source_id => $source ) {
			$source_choices = $source->get_choices();

			if ( ! empty( $source_choices ) && true === $headings ) {
				$label = $source->get_label();
				$source_choices = array_merge( array( $heading_prefix . $source_id => $label ), $source_choices );
			}

			$choices = array_merge( $choices, $source_choices );
		}

		return $choices;
	}

}
