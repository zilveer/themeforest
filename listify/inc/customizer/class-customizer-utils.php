<?php
/**
 * Customizer Utilities
 *
 * @since 1.5.0
 */
class Listify_Customizer_Utils {

	/**
	 * Fuzzy search for a term
	 *
	 * @todo Check AJAX referrer
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public static function search_terms() {
		// check ajax referrer

		$taxonomy = isset( $_POST[ 'taxonomy' ] ) ? esc_attr( $_POST[ 'taxonomy' ] ) : false;
		$options = isset( $_POST[ 'options' ] ) ? esc_attr( $_POST[ 'options' ] ) : 'id,name';
		$t = isset( $_POST[ 'q' ] ) && isset( $_POST[ 'q' ][ 'term' ] ) ? esc_attr( $_POST[ 'q' ][ 'term' ] ) : false;
		$terms = $output = array();

		if ( ! $taxonomy ) {
			wp_send_json_error($terms);
		}

		if ( 'id,name' == $options ) {
			$fields = array( 'term_id', 'name' );
		} else {
			$fields = array( 'slug', 'name' );
		}

		global $wpdb;

		$like = '%' . $wpdb->esc_like( $t ) . '%';
		$sql = $wpdb->prepare( "SELECT DISTINCT t.term_id, t.name, t.slug FROM {$wpdb->terms} AS t INNER JOIN {$wpdb->term_taxonomy} AS tt ON tt.term_id = t.term_id WHERE tt.taxonomy = '%s' AND t.name LIKE %s", $taxonomy, $like );
		$terms = $wpdb->get_results( $sql );

		add_filter( 'sanitize_key', array( 'Listify_Customizer_Utils', 'remove_dashes_from_keys' ) );

		if ( empty( $terms ) ) {
			$terms = listify_get_terms( array(
				'taxonomy' => $taxonomy,
				'orderby' => 'count',
				'order' => 'desc',
				'hide_empty' => false,
				'number' => 20
			) );
		}

		foreach ( $terms as $term ) {
			$output[] = array(
				'id' => 'term_id' == $fields[0] ? absint( $term->{$fields[0]} ) : sanitize_key( $term->{$fields[0]} ),
				'text' => esc_html( $term->{$fields[1]} )
			);
		}

		remove_filter( 'sanitize_key', array( 'Listify_Customizer_Utils', 'remove_dashes_from_keys' ) );

		wp_send_json_success( $output );
	}

	/**
	 * Get all saved/set theme mods based on a regex pattern.
	 *
	 * @since 1.5.0
	 * @param string $property
	 * @return array $keys
	 */
	public static function get_regex_theme_mods( $property ) {
		$mods = get_theme_mods();
		$found = array();

		if ( ! $mods ) {
			return $found;
		}

		foreach ( $mods as $key => $value ) {
			if ( preg_match( "/{$property}/", $key ) ) {
				$found[ $key ] = $value;
			}
		}

		return $found;
	}

	/**
	 * Create an array of numbers
	 *
	 * @since 1.5.0
	 * @param int $start
	 * @param int $end
	 * @return array $numbers
	 */
	public static function array_of_numbers( $start = 1, $end = 20 ) {
		$numbers = array();

		for ( $i = $start; $i <= $end; $i++ ) {
			$numbers[ $i ] = $i;
		}

		return $numbers;
	}

	/**
	 * Remove dashes from keys
	 *
	 * sanitize_key() does not remove dashes by default which can mess up
	 * some regex paterns.
	 *
	 * @since 1.5.0
	 * @param string $key
	 * @return string $key
	 */
	public static function remove_dashes_from_keys( $key ) {
		return preg_replace( '/-/s', '_', $key );
	}

	/**
	 * Get an array of available taxonomies choices.
	 *
	 * @since 1.5.0
	 * @return array $_taxonomies
	 */
	public static function get_taxonomy_choices() {
		$taxonomies = get_taxonomies( array( 'public' => true ), array( 'output' => 'objects' ) );
        $_taxonomies = array();

		if ( empty( $taxonomies ) ) {
			return $_taxonomies;
		}

        foreach ( $taxonomies as $taxonomy ) {
            $_taxonomies[ $taxonomy->name ] = $taxonomy->labels->name;
        }

        return $_taxonomies;
	}

}
