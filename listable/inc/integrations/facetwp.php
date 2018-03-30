<?php
/**
* Custom functions that deal with various plugin integrations of WP Job Manager.
*
* @package Listable
*/

/**
 * ======  FacetWP - https://facetwp.com/  ======
 */

/** @var FacetWP $facetwp */
$facetwp = FWP();

/* ------- UTILITY FUNCTIONS --------- */

/*
 * Retrieve all defined facets in the the settings
 */
function listable_get_all_facets() {
	return FWP()->helper->get_facets();
}

function listable_get_facets_by_area( $area = 'front_page_hero' ) {
	$facets = array();

	$listable_facets = (array) json_decode( get_option( 'listable_facets_config' ), true ) ;

	if ( isset( $listable_facets[ $area ] ) ) {
		$facets = $listable_facets[ $area ];
	}

	return apply_filters( 'listable_get_facets_by_area', $facets, $area );
}

/*
 * Return the markup for facets
 *
 * @param array $facets
 */
function listable_get_display_facets( $facets ) {
	$output = '';
	if ( ! empty( $facets ) ) {
		foreach ( $facets as $facet ) {
			$output .= facetwp_display( 'facet', $facet['name'] );
		}
	}

	return $output;
}

/*
 * Echo the markup for the given facets
 *
 * @param array $facets
 */
function listable_display_facets( $facets ) {
	echo listable_get_display_facets( $facets );
}

/*
 * Filter the html of each facet and add labels in front
 */
function listable_facetwp_facet_html( $html, $params ) {
	if ( isset( $params['facet'] ) && isset( $params['facet']['label'] ) ) {
		$html = '<label class="facetwp-filter-title">' . $params['facet']['label'] . '</label><div class="facet-wrapper">' . $html . '</div>';
	}

	return $html;
}

add_filter( 'facetwp_facet_html', 'listable_facetwp_facet_html', 10, 2 );

/**
 * Automatically add a Listings template to FacetWP since we so desperately need it
 *
 * @param array $templates
 *
 * @return array
 */
function listable_register_listings_template( $templates ) {
	$templates[] = array(
		'label'     => 'Listings',
		'name'      => 'listings',
		'query'     => '',
		'template'  => ''
	);
	return $templates;
}
add_filter( 'facetwp_templates', 'listable_register_listings_template' );

/*
 * Enable WP archive detection for FacetWP templates
 * Requires FacetWP 2.4.1
 */
add_filter( 'facetwp_template_use_archive', '__return_true' );

/*
 * Filter the FacetWP query when using the "listings" template in FacetWP
 */
function listable_facetwp_query_args( $query_args, $facet ) {
	if ( 'listings' != $facet->template[ 'name' ] ) {
		return $query_args;
	}

	if ( '' == $query_args ) {
		$query_args = array();
	}

	// Prevent "Undefined index" error for search facets
	$search = '';
	if ( ! empty( $facet->http_params[ 'get' ][ 's' ] ) ) {
		$search = $facet->http_params[ 'get' ][ 's' ];
	}

	$defaults = array(
		'post_type' => 'job_listing',
		'post_status' => 'publish',
		's' => $search,
	);

	$query_args = wp_parse_args( $query_args, $defaults );

	return $query_args;
}
add_filter( 'facetwp_query_args', 'listable_facetwp_query_args', 10, 2 );

/*
 * Output the loop for the listings when using the "listings" template in FacetWP
 * This is used to load the listings via AJAX
 */
function listable_facetwp_template_html( $output, $class ) {
	if ( 'listings' != $class->template[ 'name' ] || '' == $class->http_params['uri'] || is_single() ) {
		return $output;
	}

	$query = $class->query;

	ob_start();

	echo '<div class="grid list job_listings">';
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'job_manager/content', 'job_listing' );
		}
		wp_reset_postdata();
	} else {
		get_template_part( 'job_manager/content', 'no-jobs-found' );
	}
	echo '</div>';
	$output = ob_get_clean();

	return $output;
}
add_filter( 'facetwp_template_html', 'listable_facetwp_template_html', 10, 2 );

function listable_fix_geolocation_indexing( $params, $class ) {
	//first the user must select as source the geolocation_lat
	if ( 'cf/geolocation_lat' == $params['facet_source'] ) {
		$lat = $params['facet_value'];

		if ( ! empty( $lat ) ) {
			$lat = get_post( $params[ 'post_id' ] )->geolocation_lat;
			$lng = get_post( $params[ 'post_id' ] )->geolocation_long;

			//save the latitude in the facet value
			$params['facet_value'] = $lat;
			//save the longitude in the facet display value
			$params['facet_display_value'] = $lng;
		}
	}

	return $params;
}
add_filter( 'facetwp_index_row', 'listable_fix_geolocation_indexing', 10, 2 );

function listable_fwp_index_wpjm_product_prices( $params, $class ) {
	if ( 'cf/_products' == $params['facet_source'] ) {
		$product_ids = (array) maybe_unserialize( $params['facet_value'] );
		foreach ( $product_ids as $id ) {
			$product = wc_get_product( $id );
			if ( is_object( $product ) ) {
				$price = $product->get_price();
				$params['facet_value'] = $price;
				$params['facet_display_value'] = $price;
				$class->insert( $params );
			}
		}
		return false; // skip default
	}
	return $params;
}
add_filter( 'facetwp_index_row', 'listable_fwp_index_wpjm_product_prices', 10, 2 );

/* ==== THE CUSTOM DRAG&DROP INTERFACE === */

function listable_fwp_admin_scripts() {

	if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'job-manager-settings') {
		return;
	}

	wp_enqueue_style( 'fwp_job_manager_admin_css', get_template_directory_uri() . '/assets/css/admin/fwp-settings.css', array( 'job_manager_admin_css' ) );

	wp_register_script( 'fwp_sortable_js',get_template_directory_uri() . '/assets/js/admin/facetwp/sortable.js', array(), null, true );
	wp_enqueue_script( 'fwp_job_manager_admin_js',get_template_directory_uri() . '/assets/js/admin/facetwp/fwp.js', array( 'job_manager_admin_js', 'fwp_sortable_js' ), null, true );
}

add_action( 'admin_enqueue_scripts', 'listable_fwp_admin_scripts', 11 );

function listable_wpjm_facets_drag_drop_interface ( $option, $attrs, $value, $placeholder ) {
	$current_values = json_decode( $value );

	$facetwp_settigns = json_decode( get_option( 'facetwp_settings' ) ); ?>

	<div class="available_block">

		<h2><?php esc_html_e( 'Facets Advanced Filtering', 'listable' ); ?></h2>
		<p><?php esc_html_e( 'Add filtering fields to your site and allow your visitors to better search through the listings', 'listable' ); ?></p>

		<div class="sortable_block">
			<h3><?php esc_html_e( 'Available Facets', 'listable' ); ?></h3>
			<p><em><?php esc_html_e( 'Drag and drop the facets you\'d like to add into the right side boxes', 'listable' ); ?></em></p>
			<ul id="facets_list" class="facets">
				<?php listable_admin_show_facets_items( $facetwp_settigns->facets ); ?>
			</ul>
		</div>
	</div>

	<div class="facets-config">
		<input type="hidden" id="setting-listable_facets_config" name="listable_facets_config" value='<?php echo json_encode( $current_values ); ?>'>
		<div class="sortable_block">
			<h3><?php esc_html_e( 'Listing Archive', 'listable' ); ?></h3>
			<p><em><?php esc_html_e( 'This area is where most of your facets should go (except the ones already shown in the Navigation Bar)', 'listable' ); ?></em></p>

			<ul id="listings_archive_visible" class="facets">
				<?php
				if ( isset( $current_values->listings_archive_visible ) && ! empty( $current_values->listings_archive_visible ) ) {
					listable_admin_show_facets_items( $current_values->listings_archive_visible );
				} ?>
			</ul>

			<div class="secondary_blocks">
				<p><em><?php esc_html_e( 'Facets dragged here will be hidden under an "More Filters" button', 'listable' ); ?></em></p>
				<ul id="listings_archive_hidden" class="facets">
					<?php
					if ( isset( $current_values->listings_archive_hidden ) && ! empty( $current_values->listings_archive_hidden ) ) {
						listable_admin_show_facets_items( $current_values->listings_archive_hidden );
					} ?>
				</ul>
			</div>
		</div>

		<div class="sortable_block">
			<h3><?php esc_html_e( 'Navigation Bar', 'listable' ); ?></h3>
			<p><em><?php esc_html_e( 'Site-wide available facets. Choose wisely a maximum of two of the most essential filters -- the rest of them go to the Listings Archive section.', 'listable' ); ?></em></p>

			<ul id="navigation_bar" class="facets">
				<?php
				if ( isset( $current_values->navigation_bar ) && ! empty( $current_values->navigation_bar ) ) {
					listable_admin_show_facets_items( $current_values->navigation_bar );
				} ?>
			</ul>
		</div>
		<div class="sortable_block">
			<h3><?php esc_html_e( 'Front Page Hero', 'listable' ); ?></h3>
			<p><em><?php esc_html_e( 'Considering that Navigation Bar facets will not be shown on the Front Pagem feel free to use a similar configuration.', 'listable' ); ?></em></p>

			<ul id="front_page_hero" class="facets">
				<?php
				if ( isset( $current_values->front_page_hero ) && ! empty( $current_values->front_page_hero ) ) {
					listable_admin_show_facets_items( $current_values->front_page_hero );
				} ?>
			</ul>
		</div>
	</div>
	<?php
}

add_action( 'wp_job_manager_admin_field_fwp_drag_and_drop', 'listable_wpjm_facets_drag_drop_interface', 10, 4 );

function listable_admin_show_facets_items( $facetwp_settigns = array() ) {

	if ( empty( $facetwp_settigns ) ) {
		return;
	}

	foreach ( $facetwp_settigns as $i => $facet ) {
		if ( empty( $facet ) ) {
			continue;
		}

		$title = '';
		if ( isset(  $facet->label ) ) {
			$title = $facet->label;
		}

		$type = 'dropdown';
		if ( isset( $facet ) ) {
			$type = $facet->type;
		} ?>
		<li data-facet='<?php echo json_encode( $facet ); ?>'>
			<span class="title"><?php echo $title; ?></span>
			<span class="type"><?php echo $type; ?></span>
			<span class="facet-remove">x</span>
		</li>
	<?php }
}

// disable google-maps api load in facetwp ... we will do in in theme
add_filter( 'facetwp_proximity_load_js', '__return_false' );


function listable_add_facet_redirects_on_non_listings_pages(){
	global $post;
	if ( ! has_shortcode( $post->post_content, 'jobs' ) ) { ?>
		<div class="hide">
			<script>
				(function($) {
					$(document).ready(function () {
						//prevent the facets from disappearing
						FWP.loading_handler = function() {}
					});

					$(document).on('keyup','.header-facet-wrapper input[type="text"]', function(e) {
						if (e.which === 13) {
							//if the user presses ENTER/RETURN in a text field then redirect
							facetwp_redirect_to_listings();
							return false;
						}
					});

					$(document).on('change','.header-facet-wrapper select, .header-facet-wrapper input[type="checkbox"]', function(ev, el) {
						if ($( this ).val() !== '') {
							facetwp_redirect_to_listings();
						}
					});
				})(jQuery);

				function facetwp_redirect_to_listings() {
					FWP.parse_facets();
					FWP.set_hash();

					var query_string = FWP.build_query_string();
					if ('' != query_string) {
						query_string = '?' + query_string;
					}
					var url = query_string;
					window.location.href = '<?php echo listable_get_listings_page_url(); ?>' + url;
				}
			</script>
			<?php echo facetwp_display( 'template', 'listings' ); ?>
		</div>
	<?php }
}

add_action( 'listable_before_page_content', 'listable_add_facet_redirects_on_non_listings_pages' );