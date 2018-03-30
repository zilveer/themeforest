<?php
/**
 * FacetWP
 */

class Listify_FacetWP extends listify_Integration {

    public $facets;
    public $template;

    public function __construct() {
        $this->includes = array(
            'class-facetwp-template.php'
        );

        $this->integration = 'facetwp';

        parent::__construct();
    }

    public function setup_actions() {
		add_filter( 'facetwp_gmaps_api_key', array( $this, 'gmaps_api_key' ) );

		// a few things need to run late
        add_action( 'init', array( $this, 'init' ), 12 );

		// register default template and facets
        add_filter( 'facetwp_templates', array( $this, 'register_listings_template' ) );
        add_filter( 'facetwp_facets', array( $this, 'register_facets' ) );

		// proximity filter
        add_filter( 'facetwp_index_row', array( $this, 'index_listify_latlng' ), 10, 2 );
    }

	/**
	 * Filter FacetWP's Google Maps key.
	 *
	 * @see https://facetwp.com/documentation/proximity/
	 *
	 * @since 1.7.0
	 * @param string $url
	 * @return string $url
	 */
	public function gmaps_api_key( $key ) {
		if ( '' != $key ) {
			return $key;
		}

		return get_theme_mod( 'map-behavior-api-key', '' );
	}

    public function init() {
        $this->template = new Listify_FacetWP_Template;

		add_filter( 'facetwp_template_html', array( $this, 'facetwp_template_html' ), 10, 2 );
		add_filter( 'facetwp_query_args', array( $this, 'facetwp_query_args' ), 10, 2 );
	}

	/**
	 * Register default facet template to allow users to get started more easil.y
	 *
	 * @since unknown
	 * @param array $templates
	 * @return array $templates
	 */
    public function register_listings_template( $templates ) {
        $templates[] = array(
            'label'     => 'Listings',
            'name'      => 'listings',
			'query'     => "<?php
return array(
	'post_type' => 'job_listing',
	'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	'order' => 'asc'
);",
            'template'  => ''
        );

        return $templates;
    }

	/**
	 * Register default facets to allow users to get started more easily.
	 *
	 * @since 1.5.0
	 * @param array $facets
	 * @return array $facets
	 */
	public function register_facets( $facets ) {
		$facets[] = array(
            'label' => 'Keywords',
            'name' => 'keyword',
            'type' => 'search',
            'search_engine' => '',
            'placeholder' => 'What are you looking for?',
        );

		$facets[] = array(
            'label' => 'Location',
            'name' => 'location',
            'type' => 'proximity',
            'placeholder' => 'Location',
            'source' => 'cf/geolocation_lat',
        );

		$facets[] = array(
            'label' => 'Category',
            'name' => 'category',
            'type' => 'dropdown',
			'source' => 'tax/job_listing_category'
        );

		return $facets;
	}

	/**
	 * Get the available facets to be used in a multiselect.
	 *
	 * @since 1.5.0
	 * @return array $facets
	 */
	public function get_facet_choices( $blacklist = array() ) {
		$facets = FWP()->helper->get_facets();
		$_facets = array();

		if ( empty( $facets ) ) {
			return $_facets;
		}

		foreach ( $facets as $facet ) {
			if ( in_array( $facet[ 'type' ], $blacklist ) ) {
				continue;
			}

			$_facets[ $facet[ 'name' ] ] = $facet[ 'label' ];
		}

		return $_facets;
	}

    public function index_listify_latlng( $params, $class ) {
        if ( 'cf/geolocation_lat' == $params['facet_source'] ) {
            $lat = $params['facet_value'];
            if ( ! empty( $lat ) ) {
                $lat = get_post( $params[ 'post_id' ] )->geolocation_lat;
                $lng = get_post( $params[ 'post_id' ] )->geolocation_long;
                $params['facet_value'] = $lat;
                $params['facet_display_value'] = $lng;
            }
        }
        return $params;
    }

    public function facetwp_template_html( $output, $class ) {
		$front_is_listings = job_manager_get_page_id( 'jobs' ) === get_option( 'page_on_front' );

        if ( 'listings' != $class->template[ 'name' ] || ( '' == $class->http_params[ 'uri' ] && ! $front_is_listings ) ) {
            return $output;
        }

        $query = $class->query;

        ob_start();

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                get_template_part( 'content', 'job_listing' );
            }
        } else {
            echo '<li class="col-xs-12">';
            get_template_part( 'content', 'no-jobs-found' );
            echo '</li>';
        }

        $output = ob_get_clean();

        return $output;
    }

	/**
	 * Suppliment the default query arguments with the same per_page setting
	 * that can be set in "Listings > Settings"
	 *
	 * @since 1.5.0
	 * @param array $query_args
	 * @param object $facet
	 * @return array $query_args
	 */
    public function facetwp_query_args( $query_args, $facet ) {
        if ( 'listings' != $facet->template[ 'name' ] ) {
            return $query_args;
        }

        if ( '' == $query_args ) {
            $query_args = array();
        }

        $defaults = array(
            'posts_per_page' => get_option( 'job_manager_per_page' ),
        );

        $query_args = wp_parse_args( $query_args, $defaults );

        return $query_args;
    }

	/**
	 * Get facets
	 *
	 * Using an array of facet slugs gather the entire facet object
	 *
	 * @since unknown
	 * @return array $_facets
	 */
    public function get_facets( $facets = array() ) {
		if ( empty( $facets ) ) {
			return $facets;
		}

        $_facets = array();

        if ( ! is_array( $facets ) ) {
            $facets = array_map( 'trim', explode( ',', $facets ) );
        }

        foreach ( $facets as $key => $facet_name ) {
            $facet = FWP()->helper->get_facet_by_name( $facet_name );

            if ( ! $facet ) {
                continue;
            }

            $_facets[] = $facet;
        }

        return $_facets;
    }

    public function get_homepage_facets( $facets ) {
		return $this->get_facets( listify_theme_mod( 'listing-archive-facetwp-home', array( 'keyword', 'location', 'category' ) ) );
    }

}

$GLOBALS[ 'listify_facetwp' ] = new Listify_FacetWP();
