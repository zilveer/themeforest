<?php
/**
 * WP Job Manager
 */

class Listify_WP_Job_Manager extends listify_Integration {

	public function __construct() {
		$this->includes = array(
			'class-wp-job-manager-gallery.php',
			'class-wp-job-manager-claim.php',
			'class-wp-job-manager-business-hours.php',
			'class-wp-job-manager-service.php',
			'class-wp-job-manager-services.php',
			'class-wp-job-manager-template.php',
			'class-wp-job-manager-submission.php',
			'class-wp-job-manager-categories.php',
			'class-wp-job-manager-writepanels.php',
			'class-wp-job-manager-taxonomies.php',
			'class-wp-job-manager-admin.php',

            'class-taxonomy-breadcrumbs.php',

			'map/class-wp-job-manager-map.php',
			'customizer/class-wp-job-manager-customizer.php',
		);

		$this->integration = 'wp-job-manager';

		parent::__construct();
	}

	public function setup_actions() {
		add_filter( 'job_manager_show_addons_page', '__return_false' );

		add_action( 'init', array( $this, 'init' ), 0 );

		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );

		add_filter( 'submit_job_form_fields', array( $this, 'submit_job_form_fields' ) );
		add_filter( 'register_post_type_job_listing', array( $this, 'register_post_type_job_listing' ) );

		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );

		add_filter( 'job_manager_output_jobs_defaults', array( $this, 'job_manager_output_jobs_defaults' ) );
		add_filter( 'get_job_listings_query_args', array( $this, 'get_job_listings_query_args' ), 10, 2 );

		add_filter( 'submit_job_form_login_url', array( $this, 'login_url' ) );

		add_filter( 'job_manager_job_dashboard_columns', array( $this, 'job_manager_job_dashboard_columns' ) );
		add_filter( 'job_manager_my_job_actions', array( $this, 'job_manager_my_job_actions' ) );

        add_filter( 'job_manager_get_listings_custom_filter_rss_args', array( $this, 'job_manager_get_listings_custom_filter_rss_args' ) );
	}

	function remove_translations() {
		global $job_manager;

		remove_action( 'plugins_loaded', array( $job_manager, 'load_plugin_textdomain' ) );
	}

	public function init() {
		$this->template = new Listify_WP_Job_Manager_Template;
		$this->map = new Listify_WP_Job_Manager_Map;
		$this->gallery = new Listify_WP_Job_Manager_Gallery;
		$this->claim = new Listify_WP_Job_Manager_Claim;
		$this->services = new Listify_WP_Job_Manager_Services;
		$this->submission = new Listify_WP_Job_Manager_Submission;
		$this->categories = new Listify_WP_Job_Manager_Categories;

		if ( is_admin() ) {
			$this->writepanels = new Listify_WP_Job_Manager_Writepanels;
			$this->taxonomies = new Listify_WP_Job_Manager_Taxonomies;
		}
	}

	public function after_setup_theme() {
		add_theme_support( 'job-manager-templates' );
	}

	public function wp_enqueue_scripts() {
		wp_dequeue_style( 'wp-job-manager-frontend' );
		wp_dequeue_style( 'chosen' );
	}

	public function submit_job_form_fields( $fields ) {
		return $fields;

		unset( $fields[ 'company' ][ 'company_name' ] );
		unset( $fields[ 'company' ][ 'company_tagline' ] );
		unset( $fields[ 'company' ][ 'company_logo' ] );

		return $fields;
	}

	public function register_post_type_job_listing( $args ) {
		$args[ 'supports' ][] = 'comments';
		$args[ 'supports' ][] = 'thumbnail';

		$args[ 'labels' ][ 'featured_image' ] = __( 'Featured image', 'listify' );
		$args[ 'labels' ][ 'set_featured_image' ] = __( 'Set featured image', 'listify' );
		$args[ 'labels' ][ 'remove_featured_image' ] = __( 'Remove featured image', 'listify' );
		$args[ 'labels' ][ 'use_featured_image' ] = __( 'Use featured image', 'listify' );

		if ( apply_filters( 'listify_override_job_manager_caps', true ) ) {
			unset( $args[ 'capabilities' ] );
		}

		return $args;
	}

	public function job_manager_output_jobs_defaults( $default ) {
		$type = get_queried_object();

		if ( is_tax( 'job_listing_type' ) ) {
			$default[ 'job_types' ] = $type->slug;
			$default[ 'selected_job_types' ] = $type->slug;
			$default[ 'show_categories' ] = true;
		} elseif ( is_tax( 'job_listing_category' ) ) {
			$default[ 'show_categories' ] = true;
			$default[ 'categories' ] = $type->slug;
			$default[ 'selected_category' ] = $type->slug;
		} elseif ( is_search() ) {
			$default[ 'keywords' ] = get_search_query();
			$default[ 'show_filters' ] = false;
		}

		if ( is_home() || listify_is_widgetized_page() ) {
			$default[ 'show_category_multiselect' ] = false;
		}

		if ( isset( $_GET[ 'search_categories' ] ) ) {
            $categories = array_filter( array_map( 'esc_attr', $_GET[ 'search_categories' ] ), 'listify_array_filter_deep' );

            if ( ! empty( $categories ) ) {
                $default[ 'selected_category' ] = $categories[0];
            }

			$default[ 'show_categories' ] = true;
			$default[ 'categories' ] = false;
		}

		return $default;
	}

	public function pre_get_posts( $query ) {
		if ( is_admin() ) {
			return;
		}

		if ( $query->is_author() && $query->is_main_query() ) {
			$query->set( 'posts_per_page', 3 );
			$query->set( 'post_type', array( 'job_listing' ) );
			$query->set( 'post_status', 'publish' );
		}
	}

	public function get_job_listings_query_args( $query_args, $args ) {
		if ( is_author() ) {
			$author = get_user_by( 'slug', get_query_var( 'author_name' ) );

			$query_args[ 'author' ] = $author->ID;
			$query_args[ 'posts_per_page' ] = 3;
			$query_args[ 'paged' ] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		}

		if ( isset( $args[ 'no_found_rows' ] ) ) {
			$query_args[ 'no_found_rows' ] = true;
			$query_args[ 'cache_results' ] = false;
		}

		if ( isset( $args[ 'post__in' ] ) ) {
			$query_args[ 'post__in' ] = $args[ 'post__in' ];
		}

		return $query_args;
	}

	public function login_url( $url ) {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return $url;
		}

		return get_permalink( wc_get_page_id( 'myaccount' ) );
	}

	public function job_manager_job_dashboard_columns( $columns ) {
		unset( $columns[ 'filled' ] );
	
		return $columns;
	}

	public function job_manager_my_job_actions( $actions ) {
		unset( $actions[ 'mark_not_filled' ] );
		unset( $actions[ 'mark_filled' ] );

		return $actions;
	}

    public function job_manager_get_listings_custom_filter_rss_args( $args ) { 
        if ( listify_theme_mod( 'categories-only', true ) ) {
            unset( $args[ 'job_types' ] );
        }

        return $args;
    }

}

$GLOBALS[ 'listify_job_manager' ] = new Listify_WP_Job_Manager();
