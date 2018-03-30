<?php

class Listify_WP_Job_Manager_Map_Template extends listify_Integration {

	public function __construct() {
		$this->includes = array();
		$this->integration = 'wp-job-manager';

		parent::__construct();
	}

	public function setup_actions() {
		add_filter( 'body_class', array( $this, 'body_class' ) );

		add_action( 'job_manager_job_filters_before', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 5 );
		
		// send back info we can actually use to backbone
		add_action( 'wp_footer', array( $this, 'pin_template' ) );
		add_action( 'wp_footer', array( $this, 'infobubble_template' ) );

		// if we are not sorting by a region we need to do more things
		if ( ! ( get_option( 'job_manager_regions_filter', true ) && listify_has_integration( 'wp-job-manager-regions' ) ) ) {
			// output the labels of how we are sorting
			add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			add_filter( 'job_manager_get_listings_custom_filter_text', array( $this, 'job_manager_get_listings_custom_filter_text' ) );

			// add the hidden fields to send to send over
			add_action( 'job_manager_job_filters_search_jobs_end', array( $this, 'job_manager_job_filters_distance' ), 0 );
		}

		// add the view switcher
		add_action( 'listify_map_before', array( $this, 'view_switcher' ) );

		// output the map
		add_action( 'listify_output_map', array( $this, 'output_map' ) );

		// add map specific listing data
		add_filter( 'listify_listing_data', array( $this, 'listing_data' ) );
	}

	/**
	 * Does the map need to appear on this page?
	 *
	 * @since unknown
	 * @return bool
	 */
	public function display() {
		$display = get_theme_mod( 'listing-archive-output', 'map-results' );
		$api = get_theme_mod( 'map-behavior-api-key', false );

		return apply_filters( 'listify_display_map', in_array( $display, array( 'map', 'map-results' ) ) && $api );
	}

	/**
	 * Where is the map appearing on this page?
	 */
	public function position() {
		return get_theme_mod( 'listing-archive-map-position', 'side' );
	}

	/**
	 * Set the default region bias
	 */
	public function region_bias() {
		return listify_theme_mod( 'region-bias', false );
	}

	/**
	 * Get the unit
	 */
	public function unit() {
		return $this->is_english() ? 'mi' : 'km';
	}

	/**
	 * Get location
	 */
	public function is_english() {
		$english = apply_filters( 'listify_map_english_units', array( 'US', 'GB', 'LR', 'MM' ) );

		if ( in_array( $this->region_bias(), $english ) ) {
			return true;
		}

		return false;
	}
	
	private function get_average_radius() {
		$default = isset( $_GET[ 'search_radius' ] ) ? absint( $_GET[ 'search_radius' ] ) : listify_theme_mod( 'map-behavior-search-default', 50 );

		return $default;
	}

	public function listing_data( $data ) {
		if ( ! ( defined( 'DOING_AJAX' ) || ( listify_has_integration( 'facetwp' ) && did_action( 'listify_facetwp_sort' ) ) ) ) {
			return $data;
		}

		$post = get_post();

		$data[ 'id' ] = $post->ID;
		$data[ 'link' ] = get_permalink( $post->ID );

		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );

		if ( ! $image && apply_filters( 'listify_listing_cover_use_gallery_images', '__return_false' ) ) {
			$image = listify_get_cover_from_group( array( 'object_ids' => array( $post->ID ), 'size' => 'thumbnail' ) );
		}

		if ( is_array( $image ) && isset( $image[0] ) ) {
			$data[ 'thumb' ] = $image[0];
		}

		$data[ 'title' ] = the_title_attribute( array( 'post' => $post, 'echo' => false ) );
		$data[ 'address' ] = get_the_job_location( $post->ID );

		/** Longitude */
		$long = esc_attr( $post->geolocation_long );

		if ( $long ) {
			$data[ 'longitude' ] = $long;
		}

		/** Latitude */
		$lat = esc_attr( $post->geolocation_lat );

		if ( $lat ) {
			$data[ 'latitude' ] = $lat;
		}

		$term = $this->get_marker_term( $post );

		$data[ 'icon' ] = $this->get_marker_term_icon( $post, $term );

		if ( $term ) {
			$data[ 'term' ] = $term->term_id;
		} else {
			$data[ 'term' ] = 0;
		}

		/** Featured */
		$data[ 'featured' ] = $post->_featured ? 'featured' : '';

		foreach ( $data as $key => $value ) {
			$data[ $key ] = esc_attr( strip_tags( $value ) );
		}

		return $data;
	}

	public function pin_template() {
		locate_template( array( 'templates/tmpl-map-pin.php' ), true );
	}

	public function infobubble_template() {
		locate_template( array( 'templates/tmpl-map-popup.php' ), true );
	}

	/**
	 * Figure out if this page needs a map or not.
	 * 
	 * This is based on output, widgets, if the scripts are needed, etc.
	 */
	public function page_needs_map( $force = false ) {
		if ( $force ) {
			return $force;
		}

		$needs = false;

		if ( listify_is_job_manager_archive() ) {
			$needs = true;
		}

		if ( is_singular( 'job_listing' ) ) {
			$needs = true;
		}
		
		// always load when relisting/previewing just in case
		if ( ( isset( $_GET[ 'step' ] ) && 'preview' == $_GET[ 'step' ] ) || isset( $_REQUEST[ 'job_manager_form' ] ) ) {
			$needs = true;
		}

		if ( listify_is_widgetized_page() ) {
			$needs = true;
		}

		if ( apply_filters( 'listify_page_needs_map', false ) ) {
			$needs = true;
		}

		if ( ! $this->display() ) {
			$needs = false;
		}

		return $needs;
	}

	/**
	 * Enqueue scripts via the job_manager_job_filters_before action in the 
	 * [jobs] shortcode output. All instances of the results in Listify are called
	 * via the [jobs] shortcode, so this will only be added on pages that is used.
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function enqueue_scripts( $atts ) {
		wp_enqueue_script( 'listify-app-map' );

		$api_key = get_theme_mod( 'map-behavior-api-key', false );

		$settings = array(
			'api' => $api_key,
			'displayMap' => (bool) $this->display() && $api_key,
			'facetwp' => listify_has_integration( 'facetwp' ),
			'useClusters' => (bool) listify_theme_mod( 'map-behavior-clusters', true ),
			'autoFit' => (bool) listify_theme_mod( 'map-behavior-autofit', true ),
			'autoPan' => listify_theme_mod( 'map-behavior-autopan', true ) ? 1 : 0,
			'trigger' => listify_theme_mod( 'map-behavior-trigger', 'mouseover' ),
			'defaultMobileView' => 'results' == get_theme_mod( 'listing-archive-mobile-view-default', 'results' ) ? 'content-area' : 'job_listings-map-wrapper',
			'useAutoComplete' => (bool) get_theme_mod( 'search-filters-autocomplete', true ),
			'mapOptions' => array(
				'zoom' => listify_theme_mod( 'map-behavior-zoom', 3 ),
				'maxZoom' => listify_theme_mod( 'map-behavior-max-zoom', 17 ),
				'maxZoomOut' => listify_theme_mod( 'map-behavior-max-zoom-out', 3 ),
                'gridSize' => listify_theme_mod( 'map-behavior-grid-size', 60 ),
                'scrollwheel' => listify_theme_mod( 'map-behavior-scrollwheel', 'on' ) == 'on' ? true : false
			),
			'searchRadius' => array(
				'min' => listify_theme_mod( 'map-behavior-search-min', 0 ),
				'max' => listify_theme_mod( 'map-behavior-search-max', 100 ),
				'default' => $this->get_average_radius()
			)
		);

		if ( '' != ( $center = listify_theme_mod( 'map-behavior-center', '' ) ) ) {
			$settings[ 'mapOptions'][ 'center' ] = array_map( 'trim', explode( ',', $center ) );
		}

		if ( has_filter( 'job_manager_geolocation_region_cctld' ) ) {
			$settings[ 'autoComplete' ][ 'componentRestrictions' ] = array(
				'country' => strtolower( get_theme_mod( 'region-bias', '' ) )
			);
		}

		$settings = apply_filters( 'listify_map_settings', $settings );

		wp_localize_script( 'listify-app-map', 'listifyMapSettings', apply_filters( 'listify_map_settings', $settings ) );
	}
	
	/**
	 * Register scripts for enqueuing later.
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function register_scripts() {
		$deps = array(
			'jquery',
			'jquery-ui-slider',
			'google-maps',
			'wp-backbone',
			'wp-job-manager-ajax-filters',
		);

		$deps[] = 'listify';

		$google_maps = listify_get_google_maps_api_url();

		wp_register_script( 'google-maps', $google_maps, array(), null, false );
		wp_register_script( 'listify-app-map', Listify_Integration::get_url() . 'js/map/app.min.js', $deps, '20150213', true );
	}
	
	/**
	 * Set the body class based on how the map is being output
	 */
	public function body_class( $classes ) {
		global $post;

		if (
			listify_is_job_manager_archive() &&
			in_array( $this->position(), array( 'side', 'right' ) ) &&
			$this->display() &&
			! ( listify_is_widgetized_page() )
		) {
			$classes[] = 'fixed-map';
			$classes[] = 'fixed-map--' . $this->position();
		}
		
		return $classes;
	}

	/**
	 * Display the map
	 */
	public function output_map() {
		if ( ! $this->page_needs_map() ) {
			return;
		}

		locate_template( array( 'content-job_listing-map.php' ), true );
	}
	
	/**
	 * Display the grid/list switcher
	 */
	public function view_switcher() {
	?>
		<div class="archive-job_listing-toggle-wrapper container">
			<div class="archive-job_listing-toggle-inner views">
				<a href="#" class="archive-job_listing-toggle active" data-toggle=".content-area"><?php _e( 'Results', 'listify' ); ?></a><a href="#" class="archive-job_listing-toggle" data-toggle=".job_listings-map-wrapper"><?php _e( 'Map', 'listify' ); ?></a>
			</div>
		</div>
	<?php
	}

	
	/**
	 * Add the hidden fields and radius slider
	 */
	public function job_manager_job_filters_distance() {
		$checked = true;

		if ( is_tax( 'job_listing_region' ) ) {
			return;
		}
	?>
		<div class="search-radius-wrapper in-use">
			<div class="search-radius-label">
				<label for="use_search_radius">
					<input type="checkbox" name="use_search_radius" id="use_search_radius" <?php checked( true, $checked ); ?>/>
					<?php printf( __( 'Radius: <span class="radi">%s</span> %s', 'listify' ), $this->get_average_radius(), $this->unit() ); ?>
				</label>
			</div>
			<div class="search-radius-slider">
				<div id="search-radius"></div>
			</div>

			<input type="hidden" id="search_radius" name="search_radius" value="<?php echo isset( $_GET[ 'search_radius'
			] ) ? absint( $_GET[ 'search_radius' ] ) : $this->get_average_radius(); ?>" />
		</div>

		<input type="hidden" id="search_lat" name="search_lat" value="<?php echo isset( $_GET[ 'search_lat' ] ) ? esc_attr(
		$_GET[ 'search_lat' ] ) : 0; ?>" />
  		<input type="hidden" id="search_lng" name="search_lng" value="<?php echo isset( $_GET[ 'search_lng' ] ) ?
  		esc_attr( $_GET[ 'search_lng' ] ) : 0; ?>" />
	<?php
	}

	/**
	 * Add some text so we know what we are searching for
	 */
	public function job_manager_get_listings_custom_filter_text( $text ) {
		$params = array();

		parse_str( $_REQUEST[ 'form_data' ], $params );

		$use_radius = isset( $params[ 'use_search_radius' ] ) && 'on' == $params[ 'use_search_radius' ];

		if ( ! $use_radius ) {
			return $text;
		}

		if ( 
			! isset( $params[ 'search_lat' ] ) ||
			'' == $params[ 'search_lat' ] || 
			'' == $params[ 'search_location' ]
		) {
			return $text;
		}

		$text .= ' ' . sprintf( __( 'within a %d %s radius', 'listify' ), $params[ 'search_radius' ], $this->unit() );

		return $text;
	}

    public function get_marker_term( $post ) {
        $tax = listify_get_top_level_taxonomy();
		$terms = wp_get_post_terms( $post->ID, $tax );
		$term = false;

		if ( $terms ) {
			return current( $terms );
		}

		return $term;
    }

    public function get_marker_term_icon( $post, $term = false ) {
        $default_icon = get_theme_mod( 'default-marker-icon', 'information-circled' );
        $tax = listify_get_top_level_taxonomy();

		if ( ! $term ) {
			$term = $this->get_marker_term( $post );
		}

		if ( ! $term ) {
			return 'ion-' . $default_icon;
		}

		$icon = false;

		// @since Listify 1.5.0
		$try = get_theme_mod( 'listings-' . $tax . '-' . $term->term_id . '-icon' );

        // @since Listify 1.3.0
		if ( ! $try ) {
			// clean up slug
			add_filter( 'sanitize_key', array( 'Listify_Customizer_Utils', 'remove_dashes_from_keys' ) );

			$term->slug = sanitize_key( $term->slug );

			remove_filter( 'sanitize_key', array( 'Listify_Customizer_Utils', 'remove_dashes_from_keys' ) );

			$try = get_theme_mod( 'listings-' . $tax . '-' . $term->slug . '-icon' );
		}

		// @since Listify 1.0.0
        if ( ! $try ) {
			$try = str_replace( 'ion-', '', get_theme_mod( 'marker-icon-' . $term->term_id ) );
        }

		if ( $try ) {
			$icon = 'ion-' . $try;
		}

        $icon = $icon ? $icon : 'ion-' . $default_icon;

        return $icon;
    }

}
