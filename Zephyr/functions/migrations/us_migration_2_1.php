<?php

class us_migration_2_1 extends US_Migration_Translator {

	// Options
	public function translate_theme_options( &$options ) {

		$changed = FALSE;
		if ( isset( $options['blog_excerpt'] ) ) {
			$options['blog_content_type'] = $options['blog_excerpt'] ? 'excerpt' : 'none';
			$changed = TRUE;
		}
		if ( isset( $options['archive_excerpt'] ) ) {
			$options['archive_content_type'] = $options['archive_excerpt'] ? 'excerpt' : 'none';
			$changed = TRUE;
		}
		if ( isset( $options['search_excerpt'] ) ) {
			$options['search_content_type'] = $options['search_excerpt'] ? 'excerpt' : 'none';
			$changed = TRUE;
		}

		// Applying font weights
		$weights = array( 200, 300, 400, 600, 700 );
		foreach ( array( 'heading', 'body', 'menu' ) as $prefix ) {
			$has_italic = isset( $options[ $prefix . '_font_style_italic' ] ) ? ( ! ! $options[ $prefix . '_font_style_italic' ] ) : FALSE;
			$variants = array();
			foreach ( $weights as $weight ) {
				if ( isset( $options[ $prefix . '_font_weight_' . $weight ] ) ) {
					if ( $options[ $prefix . '_font_weight_' . $weight ] ) {
						$variants[] = $weight;
						if ( $has_italic ) {
							$variants[] = $weight . 'italic';
						}
					}
					unset( $options[ $prefix . '_font_weight_' . $weight ] );
				}
			}
			// Empty font or web safe combination selected
			if ( ! isset( $options[ $prefix . '_font_family' ] ) ) {
				$options[ $prefix . '_font_family' ] = 'none';
				$changed = TRUE;
			}
			if ( $options[ $prefix . '_font_family' ] == 'none' OR strpos( $options[ $prefix . '_font_family' ], ',' ) !== FALSE ) {
				continue;
			}
			if ( empty( $variants ) ) {
				$variants = array( 400, 700 );
			}
			$options[ $prefix . '_font_family' ] .= '|' . implode( ',', $variants );
			$changed = TRUE;
		}

		return $changed;
	}

	// Content
	public function translate_content( &$content ) {
		return $this->_translate_content( $content );
	}

	public function translate_vc_blog( &$name, &$params, &$content ) {
		$name = 'us_blog';

		if ( isset( $params['show_excerpt'] ) AND ! $params['show_excerpt'] ) {
			$params['content_type'] = 'none';
			unset( $params['show_excerpt'] );
		}

		return TRUE;
	}

}

