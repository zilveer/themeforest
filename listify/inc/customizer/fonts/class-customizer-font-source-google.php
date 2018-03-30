<?php
/**
 * Google fonts
 *
 * @since 1.5.0
 * @package Listify
 * @category Customizer
 */
class 
	Listify_Customizer_Font_Source_Google 
extends 
	Listify_Customizer_Font_Source {

	/**
	 * Google fonts
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function __construct() {
		$this->stacks = array(
			'serif' => 'Georgia,Times,"Times New Roman",serif',
			'sans-serif' => '"Helvetica Neue",Helvetica,Arial,sans-serif',
			'display' => 'Copperplate,Copperplate Gothic Light,fantasy',
			'handwriting' => 'Brush Script MT,cursive',
			'monospace' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',
		);

		parent::__construct( 'google', __( 'Google Fonts', 'listify' ) );
	}

	/**
	 * Get the data for a particular font, or all of the source's font data.
	 *
	 * @since 1.5.0
	 * @param string|null $font
	 * @return array
	 */
	public function get_item_data( $font = null ) {
		if ( empty( $this->data ) ) {
			$this->load_data();
		}

		// Return data for a specific font.
		if ( ! is_null( $font ) ) {
			$data = array();

			if ( isset( $this->data[ $font ] ) ) {
				$data = $this->data[ $font ];
			}

			return $data;
		}

		return $this->data;
	}

	/**
	 * Append a CSS font stack to a font, based on its category. Return a default stack if the font doesn't exist.
	 *
	 * @since 1.5.0
	 * @param string $font
	 * @param string $default_stack
	 * @return string
	 */
	public function get_font_stack( $font, $default_stack = 'sans-serif' ) {
		$data = $this->get_item_data( $font );
		$stack = '';

		// Use stack for font's category
		if ( isset( $data[ 'category' ] ) && $category_stack = $this->get_category_stack( $data[ 'category' ] ) ) {
			$stack = "\"$font\"," . $category_stack;
		}

		// No available category, use default stack
		else if ( is_string( $default_stack ) ) {
			$stack = "\"$font\"," . $default_stack;
		}

		return $stack;
	}

	/**
	 * Retrieve the CSS font stack for a particular font category.
	 *
	 * @since 1.5.0
	 * @param $category
	 * @return mixed|void
	 */
	public function get_category_stack( $category ) {
		$stack = '';

		if ( isset( $this->stacks[ $category ] ) ) {
			$stack = $this->stacks[ $category ];
		}

		return $stack;
	}

	/**
	 * Build the URL for loading Google fonts, given an array of fonts used in the theme and an array of subsets.
	 *
	 * @since 1.5.0
	 */
	public function get_url() {
		$keys = array(
			'typography-body-font-family',
			'typography-page-headings-font-family',
			'typography-content-headings-font-family',
			'typography-home-headings-font-family',
			'typography-home-description-font-family',
			'typography-button-font-family'
		);

		$fonts = array();

		if ( empty( $keys ) ) {
			return false;
		}

		foreach ( $keys as $mod ) {
			$mod = listify_theme_font( $mod );

			if ( $mod ) {
				$fonts[] = $mod;
			}
		}

		$subsets = get_theme_mod( 'typography-font-subset', 'latin' );

		$url = $this->build_url( $fonts, array( $subsets ) );

		if ( '' != $url ) {
			return $url;
		}

		return false;
	}

	/**
	 * Build the URL for loading Google fonts, given an array of fonts used in the theme and an array of subsets.
	 *
	 * @since 1.5.0
	 * @param array $fonts
	 * @param array $subsets
	 * @return mixed|string|void
	 */
	public function build_url( $fonts, $subsets = array() ) {
		$url = '';
		$fonts = array_unique( $fonts );
		$family = array();

		foreach ( $fonts as $font ) {
			$font_data = $this->get_item_data( $font );

			if ( empty( $font_data ) ) {
				continue;
			}

			$font_variants = ( isset( $font_data['variants'] ) ) ? $font_data['variants'] : array();
			// Build the family name and variant string (e.g., "Open+Sans:regular,italic,700")
			$family[] = urlencode( $font . ':' . join( ',', $this->choose_font_variants( $font, $font_variants ) ) );
		}

		if ( ! empty( $family ) ) {
			// Start building the URL.
			$base_url = '//fonts.googleapis.com/css';

			// Add families
			$url = add_query_arg( 'family', implode( '|', $family ), $base_url );

			// Add subsets, if specified.
			if ( ! empty( $subsets ) ) {
				$subsets = array_map( 'sanitize_key', $subsets );
				$url = add_query_arg( 'subset', join( ',', $subsets ), $url );
			}
		}

		return $url;
	}

	/**
	 * Build an array of data that can be converted to JSON and fed into the WebFont
	 *
	 * @since 1.7.0
	 * @param array $fonts
	 * @param string $subset
	 * @return array
	 */
	public function get_webfont_json( $fonts, $subset ) {
		$data = array();
		$families = array();
		$fonts = array_unique( $fonts );

		foreach ( $fonts as $font ) {
			$font_data = $this->get_item_data( $font );

			if ( empty( $font_data ) ) {
				continue;
			}

			$font_data = $this->get_item_data( $font );
			$font_variants = ( isset( $font_data[ 'variants' ] ) ) ? $font_data[ 'variants' ] : array();

			// Build the family name, variant, and subset string (e.g., "Open+Sans:regular,italic,700:latin")
			$families[] = urlencode( $font ) . ':' . join( ',', $this->choose_font_variants( $font, $font_variants ) ) . ':' . $subset;
		}

		if ( ! empty( $families ) ) {
			$data[ 'google' ] = array(
				'families' => $families
			);
		}

		return $data;
	}

	/**
	 * Choose font variants to load for a given font, based on what's available.
	 *
	 * @since 1.5.0
	 *
	 * @param string $font
	 * @param array  $available_variants
	 * @return array
	 */
	public function choose_font_variants( $font, array $available_variants ) {
		$chosen_variants = array();

		// If a "regular" variant is not found, get the first variant.
		if ( ! in_array( 'regular', $available_variants ) && count( $available_variants ) >= 1 ) {
			$chosen_variants[] = $available_variants[0];
		} else {
			$chosen_variants[] = 'regular';
		}
		
		// Only add "italic" if it exists.
		if ( in_array( 'italic', $available_variants ) ) {
			$chosen_variants[] = 'italic';
		}

		// Only add "700" if it exists.
		if ( in_array( '700', $available_variants ) ) {
			$chosen_variants[] = '700';
		}

		// De-dupe.
		$chosen_variants = array_unique( $chosen_variants );

		return $chosen_variants;
	}

	/**
	 * Iterate through all the Google font data and build a list of unique subset options.
	 *
	 * @since 1.5.0
	 * @param array $font_data
	 * @return array
	 */
	public function collect_subsets( $font_data ) {
		$subsets = array();

		foreach ( $font_data as $font => $data ) {
			if ( isset( $data[ 'subsets' ] ) ) {
				foreach ( $data[ 'subsets' ] as $subset ) {
					$subsets[ $subset ] = $subset;
				}
			}
		}

		$subsets = array_unique( $subsets );

		asort( $subsets );

		return $subsets;
	}

	/**
	 * Getter for the $subsets property.
	 *
	 * @since 1.5.0
	 * @return array
	 */
	public function get_subsets() {
		if ( empty( $this->subsets ) ) {
			$this->subsets = $this->collect_subsets( $this->get_item_data() );
		}

		return $this->subsets;
	}

}
