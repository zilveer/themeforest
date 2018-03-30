<?php

/**
 * WpvFormatFilter
 *
 * implement a custom query filter which supports filtering by "standard" post formats
 *
 * @package wpv
 */
/**
 * class WpvFormatFilter
 */
class WpvFormatFilter {
	/**
	 * add the necessary actions and filters
	 */
	public static function actions() {
		add_action( 'init', array( __CLASS__, 'init' ) );
		add_filter( 'body_class', array( __CLASS__, 'body_class' ) );
		add_action( 'wp', array( __CLASS__, 'query' ) );
	}

	/**
	 * register the custom rewrite query
	 */
	public static function init() {
		global $wp;
		$wp->add_query_var( 'format_filter' );
		add_rewrite_rule( 'format_filter/(\w+)$', 'index.php?format_filter=$matches[1]', 'top' );
	}

	/**
	 * add an archive class to <body>
	 *
	 * @param  array $classes
	 * @return array
	 */
	public static function body_class( $classes ) {
		if ( get_query_var( 'format_filter' ) )
			$classes[] = 'archive';
		return $classes;
	}

	/**
	 * the actual post query
	 */
	public static function query() {
		$format = get_query_var( 'format_filter' );

		if ( $format ) {
			global $wpv_post_formats;

			$post_formats_longname = array();

			$query = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
					),
				),
				'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 ),
				'format_filter' => $format,
			);

			if ( $format == 'standard' ) {
				foreach ( $wpv_post_formats as $f ) {
					$post_formats_longname[] = 'post-format-'.$f;
				}

				$query['tax_query'][0]['terms']    = $post_formats_longname;
				$query['tax_query'][0]['operator'] = 'NOT IN';
			} else {
				$query['tax_query'][0]['terms']    = array( 'post-format-'.$format );
				$query['tax_query'][0]['operator'] = 'IN';
			}

			query_posts( $query );
			unset( $GLOBALS['wp_the_query'] );
			$GLOBALS['wp_the_query'] =& $GLOBALS['wp_query'];

			if ( count( $GLOBALS['wp_query']->posts ) == 0 ) {
				$GLOBALS['wp_query']->set_404();
				header( 'HTTP/1.0 404 Not Found' );
			}
		}

		return;
	}
}
