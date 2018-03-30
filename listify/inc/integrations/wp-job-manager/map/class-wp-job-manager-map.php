<?php

class Listify_WP_Job_Manager_Map extends listify_Integration {

	public function __construct() {
		$this->includes = array(
			'map/class-wp-job-manager-map-template.php',
			'map/class-wp-job-manager-map-schemes.php',
		);

		$this->integration = 'wp-job-manager';

		parent::__construct();
	}

	public function setup_actions() {
		$this->template = new Listify_WP_Job_Manager_Map_Template();
		$this->schemes = new Listify_WP_Job_Manager_Map_Schemes();

		// send back info we can actually use to backbone
		add_filter( 'job_manager_get_listings_result', array( $this, 'json_results' ), 10, 2 );

		// backwards compat
		add_filter( 'job_manager_geolocation_region_cctld', array( $this->template, 'region_bias' ) );
		
		// handle the rest at once
		add_filter( 'job_manager_geolocation_endpoint', array( $this, 'geolocation_endpoint' ) );
		
		// if we are not sorting by a region we need to do more things
		if ( ! get_option( 'job_manager_regions_filter' ) ) {
			// find the listings
			add_filter( 'get_job_listings_query_args', array( $this, 'apply_proximity_filter' ), 10, 2 );

			// let wp job manager know we need to sort by the found posts
			add_filter( 'job_manager_get_listings', array( $this, 'job_manager_get_listings' ), 10, 2 );
			add_filter( 'job_manager_get_listings_args', array( $this, 'job_manager_get_listings_args' ) );
		}
	}

	/**
	 * Automatically add the site's language to the geocode endpoint to help
	 * return more relevant results.
	 *
	 * @since unknown
	 * @param string $url
	 * @return string $url The URl with the langauge attached to it
	 */
	public function geolocation_endpoint( $url ) {
		$args = array(
			'language' => get_locale() ? substr( get_locale(), 0, 2 ) : ''
		);

		$url = add_query_arg( $args, $url );

		return esc_url( $url );
	}

	public function json_results( $result, $jobs ) {
		global $listify_job_manager;

		$result[ 'page' ]   = isset( $jobs->query_vars[ 'paged' ] ) ? $jobs->query_vars[ 'paged' ] : 1;
		$result[ 'offset' ] = $jobs->query_vars[ 'offset' ];
		$result[ 'found' ] = $jobs->found_posts == 0 ? 0 : $jobs->found_posts;

		return $result;
	}

	/**
	 * If we are sorting by a location and radius then we need to query
	 * out listings based on that. Ordered by distance closest first
	 */
	public function apply_proximity_filter($query_args, $args) {
		$params = array();

		if ( ! isset( $_REQUEST[ 'form_data' ] ) ) {
			return $query_args;
		}

		global $wpdb, $wp_query;

		parse_str( $_REQUEST[ 'form_data' ], $params );

		$use_radius = isset( $params[ 'use_search_radius' ] ) && 'on' == $params[ 'use_search_radius' ];
		$lat = isset( $params[ 'search_lat' ] ) ? (float) $params[ 'search_lat' ] : false;
		$lng = isset( $params[ 'search_lng' ] ) ? (float) $params[ 'search_lng' ] : false;
		$radius = isset( $params[ 'search_radius' ] ) ? (int) $params[ 'search_radius' ] : false;
		$location = isset( $params[ 'search_location' ] ) ? esc_attr( $params[ 'search_location' ] ) : false;

		if ( ! ( $use_radius && $lat && $lng && $radius ) || ! $location ) {
			return $query_args;
		}

		if ( is_tax( 'job_listing_region' ) ) {
			return $query_args;
		}

		$earth_radius = $this->template->is_english() ? 3959 : 6371;

		$sql = $wpdb->prepare( "
			SELECT $wpdb->posts.ID, 
				( %s * acos( 
					cos( radians(%s) ) * 
					cos( radians( latitude.meta_value ) ) * 
					cos( radians( longitude.meta_value ) - radians(%s) ) + 
					sin( radians(%s) ) * 
					sin( radians( latitude.meta_value ) ) 
				) ) 
				AS distance, latitude.meta_value AS latitude, longitude.meta_value AS longitude
				FROM $wpdb->posts
				INNER JOIN $wpdb->postmeta 
					AS latitude 
					ON $wpdb->posts.ID = latitude.post_id
				INNER JOIN $wpdb->postmeta 
					AS longitude 
					ON $wpdb->posts.ID = longitude.post_id
				WHERE 1=1
					AND ($wpdb->posts.post_status = 'publish' ) 
					AND latitude.meta_key='geolocation_lat'
					AND longitude.meta_key='geolocation_long'
				HAVING distance < %s
				ORDER BY $wpdb->posts.menu_order ASC, distance ASC",
			$earth_radius,
			$lat,
			$lng,
			$lat,
			$radius
		);

		$post_ids = $wpdb->get_results( $sql, OBJECT_K );

		if ( empty( $post_ids ) || ! $post_ids ) {
            $post_ids = array(0);
		}

		if ( $wp_query ) {
			$wp_query->locations = $post_ids;
		}

		$query_args[ 'post__in' ] = array_keys( (array) $post_ids );

		$query_args = $this->remove_location_meta_query( $query_args );

		return $query_args;
	}

	private function remove_location_meta_query( $query_args ) {
		$found = false;

		if ( ! isset( $query_args[ 'meta_query' ] ) ) {
			return $query_args;
		}

		foreach ( $query_args[ 'meta_query' ] as $query_key => $meta ) {
			foreach ( $meta as $key => $args ) {
				if ( ! is_int( $key ) ) {
					continue;
				}

				if ( 'geolocation_formatted_address' == $args[ 'key' ] ) {
					$found = true;
					unset( $query_args[ 'meta_query' ][ $query_key ] );
					break;
				}
			}

			if ( $found ) {
				break;
			}
		}

		return $query_args;
	}

	/**
	 * If we are querying a geocoded location we should order by
	 * 'distance' (which is really just a way to not order by 'featured'
	 */
	public function job_manager_get_listings_args( $args ) {
		if ( ! isset( $_REQUEST[ 'form_data' ] ) ) {
			return $args;
		}

		parse_str( $_REQUEST[ 'form_data' ], $params );

		$use_radius = isset( $params[ 'use_search_radius' ] ) && 'on' == $params[ 'use_search_radius' ];
		$lat = isset( $params[ 'search_lat' ] ) && 0 != $params[ 'search_lat' ];

		if ( ! ( $use_radius && $lat ) || '' == $params[ 'search_location' ] ) {
			return $args;
		}

		$args[ 'orderby' ] = 'distance';
		$args[ 'order' ] = 'asc';

		return $args;
	}

	/**
	 * If we are (fake) ordering by 'distance' then we should really
	 * be ordering by the found post IDs.
	 */
	public function job_manager_get_listings( $query_args, $args ) {
		if ( 'distance' == $args[ 'orderby' ] ) {
			$query_args[ 'orderby' ] = 'post__in';
			$query_args[ 'order' ] = 'asc';
		}

		return $query_args;
	}

}
