<?php
/**
 * Custom functions that setup/change/alter the behaviour of WP Job Manager.
 * See: https://wpjobmanager.com/
 *
 * @package Listable
 */

/**
 * ======  Wp Jobs Manager Filters START  ======
 */
function listable_change_job_into_listing( $args ) {

	$singular = esc_html__( 'Listing', 'listable' );
	$plural   = esc_html__( 'Listings', 'listable' );

	$args['labels']      = array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'menu_name'          => $plural,
		'all_items'          => sprintf( esc_html__( 'All %s', 'listable' ), $plural ),
		'add_new'            => esc_html__( 'Add New', 'listable' ),
		'add_new_item'       => sprintf( esc_html__( 'Add %s', 'listable' ), $singular ),
		'edit'               => esc_html__( 'Edit', 'listable' ),
		'edit_item'          => sprintf( esc_html__( 'Edit %s', 'listable' ), $singular ),
		'new_item'           => sprintf( esc_html__( 'New %s', 'listable' ), $singular ),
		'view'               => sprintf( esc_html__( 'View %s', 'listable' ), $singular ),
		'view_item'          => sprintf( esc_html__( 'View %s', 'listable' ), $singular ),
		'search_items'       => sprintf( esc_html__( 'Search %s', 'listable' ), $plural ),
		'not_found'          => sprintf( esc_html__( 'No %s found', 'listable' ), $plural ),
		'not_found_in_trash' => sprintf( esc_html__( 'No %s found in trash', 'listable' ), $plural ),
		'parent'             => sprintf( esc_html__( 'Parent %s', 'listable' ), $singular )
	);
	$args['description'] = sprintf( esc_html__( 'This is where you can create and manage %s.', 'listable' ), $plural );
	$args['supports']    = array( 'title', 'editor', 'custom-fields', 'publicize', 'comments', 'thumbnail' );
	$args['rewrite']     = array( 'slug' => 'listings' );

	$permalinks = get_option( 'listable_permalinks_settings' );
	if ( isset( $permalinks['listing_base'] ) && ! empty( $permalinks['listing_base'] ) ) {
		$args['rewrite']['slug'] = $permalinks['listing_base'];
	}

	return $args;
}

add_filter( 'register_post_type_job_listing', 'listable_change_job_into_listing' );

function listable_change_taxonomy_job_listing_type_args( $args ) {
	$singular = esc_html__( 'Listing Type', 'listable' );
	$plural   = esc_html__( 'Listings Types', 'listable' );

	$args['label']  = $plural;
	$args['labels'] = array(
		'name'              => $plural,
		'singular_name'     => $singular,
		'menu_name'         => esc_html__( 'Types', 'listable' ),
		'search_items'      => sprintf( esc_html__( 'Search %s', 'listable' ), $plural ),
		'all_items'         => sprintf( esc_html__( 'All %s', 'listable' ), $plural ),
		'parent_item'       => sprintf( esc_html__( 'Parent %s', 'listable' ), $singular ),
		'parent_item_colon' => sprintf( esc_html__( 'Parent %s:', 'listable' ), $singular ),
		'edit_item'         => sprintf( esc_html__( 'Edit %s', 'listable' ), $singular ),
		'update_item'       => sprintf( esc_html__( 'Update %s', 'listable' ), $singular ),
		'add_new_item'      => sprintf( esc_html__( 'Add New %s', 'listable' ), $singular ),
		'new_item_name'     => sprintf( esc_html__( 'New %s Name', 'listable' ), $singular )
	);

	if ( isset( $args['rewrite'] ) && is_array( $args['rewrite'] ) ) {
		$args['rewrite']['slug'] = _x( 'listing-type', 'Listing type slug - resave permalinks after changing this', 'listable' );
	}

	return $args;
}

add_filter( 'register_taxonomy_job_listing_type_args', 'listable_change_taxonomy_job_listing_type_args' );

function listable_change_taxonomy_job_listing_category_args( $args ) {
	$singular = esc_html__( 'Listing Category', 'listable' );
	$plural   = esc_html__( 'Listings Categories', 'listable' );

	$args['label'] = $plural;

	$args['labels'] = array(
		'name'              => $plural,
		'singular_name'     => $singular,
		'menu_name'         => esc_html__( 'Categories', 'listable' ),
		'search_items'      => sprintf( esc_html__( 'Search %s', 'listable' ), $plural ),
		'all_items'         => sprintf( esc_html__( 'All %s', 'listable' ), $plural ),
		'parent_item'       => sprintf( esc_html__( 'Parent %s', 'listable' ), $singular ),
		'parent_item_colon' => sprintf( esc_html__( 'Parent %s:', 'listable' ), $singular ),
		'edit_item'         => sprintf( esc_html__( 'Edit %s', 'listable' ), $singular ),
		'update_item'       => sprintf( esc_html__( 'Update %s', 'listable' ), $singular ),
		'add_new_item'      => sprintf( esc_html__( 'Add New %s', 'listable' ), $singular ),
		'new_item_name'     => sprintf( esc_html__( 'New %s Name', 'listable' ), $singular )
	);

	if ( isset( $args['rewrite'] ) && is_array( $args['rewrite'] ) ) {
		$args['rewrite']['slug'] = _x( 'listing-category', 'Listing category slug - resave permalinks after changing this', 'listable' );
	}

	$permalinks = get_option( 'listable_permalinks_settings' );
	if ( isset( $permalinks['category_base'] ) && ! empty( $permalinks['category_base'] ) ) {
		$args['rewrite']['slug'] = $permalinks['category_base'];
	}

	return $args;
}

add_filter( 'register_taxonomy_job_listing_category_args', 'listable_change_taxonomy_job_listing_category_args' );

function listable_replace_listing_tags_object_label() {

	global $wp_taxonomies;

	if ( ! isset( $wp_taxonomies['job_listing_tag'] ) ) {
		return;
	}

	// get the arguments of the already-registered taxonomy
	$job_listing_tag_args = get_taxonomy( 'job_listing_tag' ); // returns an object

	$labels = &$job_listing_tag_args->labels;

	$labels->name                       = esc_html__( 'Listing Tags', 'listable' );
	$labels->singular_name              = esc_html__( 'Listing Tag', 'listable' );
	$labels->search_items               = esc_html__( 'Search Listing Tags', 'listable' );
	$labels->popular_items              = esc_html__( 'Popular Tags', 'listable' );
	$labels->all_items                  = esc_html__( 'All Listing Tags', 'listable' );
	$labels->parent_item                = esc_html__( 'Parent Listing Tag', 'listable' );
	$labels->parent_item_colon          = esc_html__( 'Parent Listing Tag:', 'listable' );
	$labels->edit_item                  = esc_html__( 'Edit Listing Tag', 'listable' );
	$labels->view_item                  = esc_html__( 'View Tag', 'listable' );
	$labels->update_item                = esc_html__( 'Update Listing Tag', 'listable' );
	$labels->add_new_item               = esc_html__( 'Add New Listing Tag', 'listable' );
	$labels->new_item_name              = esc_html__( 'New Listing Tag Name', 'listable' );
	$labels->separate_items_with_commas = esc_html__( 'Separate tags with commas', 'listable' );
	$labels->add_or_remove_items        = esc_html__( 'Add or remove tags', 'listable' );
	$labels->choose_from_most_used      = esc_html__( 'Choose from the most used tags', 'listable' );
	$labels->not_found                  = esc_html__( 'No tags found.', 'listable' );
	$labels->no_terms                   = esc_html__( 'No tags', 'listable' );
	$labels->menu_name                  = esc_html__( 'Listing Tags', 'listable' );
	$labels->name_admin_bar             = esc_html__( 'Listing Tag', 'listable' );

	$job_listing_tag_args->rewrite = array(
		'slug'         => _x( 'listing-tag', 'permalink', 'listable' ),
		'with_front'   => false,
		'ep_mask'      => 0,
		'hierarchical' => false
	);

	$permalinks = get_option( 'listable_permalinks_settings' );
	if ( isset( $permalinks['tag_base'] ) && ! empty( $permalinks['tag_base'] ) ) {
		$job_listing_tag_args->rewrite['slug'] = $permalinks['tag_base'];
	}


	// re-register the taxonomy
	register_taxonomy( 'job_listing_tag', array( 'job_listing' ), (array) $job_listing_tag_args );

	// also unregister listing type since we wont use it
	// @todo try another way another time
	//	unset( $wp_taxonomies['job_listing_type'] );
}

add_action( 'init', 'listable_replace_listing_tags_object_label' );

function listable_replace_listing_regions_object_label() {

	global $wp_taxonomies;

	if ( ! isset( $wp_taxonomies['job_listing_region'] ) ) {
		return;
	}

	// get the arguments of the already-registered taxonomy
	$job_listing_region_args = get_taxonomy( 'job_listing_region' ); // returns an object

	$labels = &$job_listing_region_args->labels;

	$labels->name                       = esc_html__( 'Listing Regions', 'listable' );
	$labels->singular_name              = esc_html__( 'Region', 'listable' );
	$labels->search_items               = esc_html__( 'Search Regions', 'listable' );
	$labels->popular_items              = esc_html__( 'Popular Regions', 'listable' );
	$labels->all_items                  = esc_html__( 'All Regions', 'listable' );
	$labels->parent_item                = esc_html__( 'Parent Region', 'listable' );
	$labels->parent_item_colon          = esc_html__( 'Parent Region:', 'listable' );
	$labels->edit_item                  = esc_html__( 'Edit Region', 'listable' );
	$labels->view_item                  = esc_html__( 'View Region', 'listable' );
	$labels->update_item                = esc_html__( 'Update Region', 'listable' );
	$labels->add_new_item               = esc_html__( 'Add New Region', 'listable' );
	$labels->new_item_name              = esc_html__( 'New Region Name', 'listable' );
	$labels->separate_items_with_commas = esc_html__( 'Separate regions with commas', 'listable' );
	$labels->add_or_remove_items        = esc_html__( 'Add or remove regions', 'listable' );
	$labels->choose_from_most_used      = esc_html__( 'Choose from the most used regions', 'listable' );
	$labels->not_found                  = esc_html__( 'No regions found.', 'listable' );
	$labels->no_terms                   = esc_html__( 'No regions', 'listable' );
	$labels->menu_name                  = esc_html__( 'Regions', 'listable' );
	$labels->name_admin_bar             = esc_html__( 'Listing Region', 'listable' );
	$job_listing_region_args->label     = esc_html__( 'Listing Regions', 'listable' );

	$job_listing_region_args->rewrite = array(
		'slug'         => _x( 'listing-region', 'permalink', 'listable' ),
		'with_front'   => false,
		'ep_mask'      => 0,
		'hierarchical' => true
	);

	// re-register the taxonomy
	register_taxonomy( 'job_listing_region', array( 'job_listing' ), (array) $job_listing_region_args );
}

add_action( 'init', 'listable_replace_listing_regions_object_label', 11 );

/**
 * Change "Job" into "Listing" on the wp-job-manager setup pages.
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function listable_change_comment_field_names( $translated_text, $text, $domain ) {

	switch ( $translated_text ) {
		case 'Post a Job' :
			$translated_text = __( 'Post a Listing', 'listable' );
			break;

		case 'Job Dashboard' :
			$translated_text = __( 'Listing Dashboard', 'listable' );
			break;

		case 'Jobs':
			$translated_text = __( 'Listings', 'listable' );
			break;

		default:
			break;
	}

	return $translated_text;
}

/**
 * Change "Job" into "Listing" only on the wp-job-manager setup pages.
 */
function listable_admin_head_thing( $thing ) {
	if ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] === 'job-manager-setup' ) {
		add_filter( 'gettext_with_context', 'listable_change_comment_field_names', 999999, 3 );
	}
}

add_action( 'admin_init', 'listable_admin_head_thing' );


function listabe_filter_wp_jobs_manager_settings( $args ) {
	/**
	 * Now we are gone replace in all settings descriptions the "Job" with "Listing"
	 */
	array_walk_recursive( $args, 'listable_replace_jobs_with_listings' );

	if ( listable_using_facetwp() ) {
		// add a facetwp options page
		$args['job_fwp'] = array(
			esc_html__( 'FacetWP', 'listable' ),
			array(
				array(
					'name'  => 'listable_facets_config',
					'label' => '',
					'type'  => 'fwp_drag_and_drop'
				),
			)
		);
	}

	/**
	 * we decide to remove this option here:
	 * https://github.com/pixelgrade/listable/issues/410
	 */
	if ( ! empty(  $args['job_listings'][1] ) ) {
		foreach( $args['job_listings'][1] as $key => $field ) {
			if ( 'job_manager_enable_default_category_multiselect' === $field['name'] ) {
				unset( $args['job_listings'][1][$key] );
				break;
			}
		}
	}

	return $args;
}

add_filter( 'job_manager_settings', 'listabe_filter_wp_jobs_manager_settings', 9999999 );

function listable_replace_jobs_with_listings( &$item, $key ) {

	if ( $item === 'Job Listings' ) {
		$item = esc_html__( 'Listing', 'listable' );
	}

	if ( $item === 'Job Submission' ) {
		$item = esc_html__( 'Submission', 'listable' );
	}

	if ( $key === 'desc' || $key === 'any' || $key === 'all' || $key === 'label' ) {
		if ( is_numeric( strpos( $item, 'Job' ) ) ) {
			$item = str_replace( 'Job', esc_html__( 'Listing', 'listable' ), $item );
		}
	}

	return $item;
}

/**
 * Add new fields
 * && remove some
 */

function listable_add_hours_field( $fields ) {

	// reorder fields
	$fields['_company_tagline']['priority'] = 2.1;
	$fields['_job_location']['priority']    = 2.2;
	$fields['_company_website']['priority'] = 2.5;
	$fields['_company_twitter']['priority'] = 2.6;

	$fields['_job_hours'] = array(
		'label'       => esc_html__( 'Hours', 'listable' ),
		'type'        => 'textarea',
		'placeholder' => esc_html__( "Mon - Fri: 09:00 - 23:00 \nSat - Sun: 17:00 - 23:00", 'listable' ),
//		'description' => '',
		'priority'    => 2.3
	);

	$fields['_company_phone'] = array(
		'label'       => esc_html__( 'Phone', 'listable' ),
//		'type'        => 'number',
		'placeholder' => esc_html__( 'e.g +42-898-4364', 'listable' ),
//		'description' => ''
		'priority'    => 2.4
	);

	unset( $fields['_company_logo'] );
	unset( $fields['_company_video'] );
	unset( $fields['_company_name'] );
	unset( $fields['_application'] );

	return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'listable_add_hours_field', 1 );

function listable_add_total_jobs_found_number_to_ajax_response( $results, $jobs ) {
	if ( true === $results['found_jobs'] ) {
		$results['total_found'] = $jobs->found_posts;
	} else {
		$results['total_found'] = 0;
	}

	return $results;
}

add_filter( 'job_manager_get_listings_result', 'listable_add_total_jobs_found_number_to_ajax_response', 10, 2 );

function custom_submit_job_form_fields( $fields ) {
	array_walk_recursive( $fields, 'listable_replace_jobs_with_listings' );

	//	$fields['company']['company_facebook'] = array(
	//		'label' => 'Facebook url',
	//		'type' => 'text',
	//		'required' => false,
	//		'placeholder' => 'http://facebook.com/yourusername',
	//		'priority' => 6
	//	);

	// uncomment here to see what you can do

	$fields['job']['job_title']['label']       = esc_html__( 'Listing Name', 'listable' );
	$fields['job']['job_title']['placeholder'] = esc_html__( 'Your listing name', 'listable' );

	$fields['company']['company_tagline']['priority']    = 2.1;
	$fields['company']['company_tagline']['placeholder'] = esc_html__( 'e.g Speciality Coffee Shop', 'listable' );
	$fields['company']['company_tagline']['description'] = sprintf( '<span class="description_tooltip left">%s</span>', esc_html__( 'Keep it short and descriptive as it will appear on search results instead of the link description', 'listable' ) );

	$fields['job']['job_description']['priority']    = 2.2;
//	$fields['job']['job_description']['type']        = 'textarea';
	$fields['job']['job_description']['placeholder'] = esc_html__( 'An overview of your listing and the things you love about it.', 'listable' );

	$fields['job']['job_category']['priority']    = 2.3;
	$fields['job']['job_category']['placeholder'] = esc_html__( 'Choose one or more categories', 'listable' );

	$fields['job']['job_category']['label'] = esc_html__( 'Listing category', 'listable' );
	$fields['job']['job_category']['description'] = sprintf( '<span class="description_tooltip right">%s</span>', esc_html__( 'Visitors can filter their search by the categories and amenities they want - so make sure you choose them wisely and include all the relevant ones', 'listable' ) );

	if ( class_exists( 'WP_Job_Manager_Job_Tags' ) ) {
		$fields['job']['job_tags']['priority']    = 2.4;
		$fields['job']['job_tags']['required']    = false;
		$fields['job']['job_tags']['placeholder'] = esc_html__( 'Add tags', 'listable' );
		$fields['job']['job_tags']['label']       = esc_html__( 'Listing tags', 'listable' );
		$fields['job']['job_tags']['description'] = esc_html__( 'Visitors can filter their search by the amenities too, so make sure you include all the relevant ones.', 'listable' );
	}

	$fields['job']['job_location']['priority']    = 2.5;
	$fields['job']['job_location']['placeholder'] = esc_html__( 'e.g 34 Wigmore Street, London', 'listable' );
	$fields['job']['job_location']['description'] = esc_html__( 'Leave this blank if the location is not important.', 'listable' );


	$fields['company']['main_image']['label']              = esc_html__( 'Gallery Images', 'listable' );
	$fields['company']['main_image']['priority']           = 2.6;
	$fields['company']['main_image']['required']           = false;
	$fields['company']['main_image']['type']               = 'file';
	$fields['company']['main_image']['ajax']               = true;
	$fields['company']['main_image']['placeholder']        = '';
	$fields['company']['main_image']['allowed_mime_types'] = $fields['company']['company_logo']['allowed_mime_types'];
	$fields['company']['main_image']['multiple']           = true;
	$fields['company']['main_image']['description']        = esc_html__( 'The first image will be shown on listing cards.', 'listable' );

	$fields['company']['company_logo']['label']       = esc_html__( 'Logo', 'listable' );
	$fields['company']['company_logo']['priority']    = 2.6;
	$fields['company']['company_logo']['multiple']    = false;
	$fields['company']['company_logo']['description'] = esc_html__( 'The first image will be shown on listing cards.', 'listable' );

	$fields['job']['job_hours'] = array(
		'label'       => esc_html__( 'Hours of Operation', 'listable' ),
		'type'        => 'textarea',
		'placeholder' => esc_html__( "Mon - Fri: 09:00 - 23:00 \nSat - Sun: 17:00 - 23:00", 'listable' ),
		'description' => sprintf( '<span class="description_tooltip right">%s</span>', esc_html__( 'Feel free to change the text format to fit your needs.', 'listable' ) ),
		'required'    => false,
		'priority'    => 2.7
	);

	$fields['company']['company_phone'] = array(
		'label'       => esc_html__( 'Phone', 'listable' ),
		'type'        => 'text',
		'placeholder' => esc_html__( 'e.g +42-898-4364', 'listable' ),
		'required'    => false,
		'priority'    => 2.8
	);

	$fields['company']['company_website']['priority']    = 2.9;
	$fields['company']['company_website']['placeholder'] = esc_html__( 'e.g yourwebsite.com, London', 'listable' );
	$fields['company']['company_website']['description'] = sprintf( '<span class="description_tooltip left">%s</span>', esc_html__( 'You can add more similar panels to better help the user fill the form', 'listable' ) );



	// temporary unsets
	unset( $fields['company']['company_video'] );
	unset( $fields['job']['job_type'] );
	unset( $fields['company']['company_name'] );
	unset( $fields['job']['application'] );

//	$fields['company']['company_name']['priority'] = 1.5;

	return $fields;
}
add_filter( 'submit_job_form_fields', 'custom_submit_job_form_fields' );

function listable_maybe_clean_main_images_on_submit( $job_data, $post_title, $post_content, $status, $values ) {
	if ( empty( $values['main_image'] ) ) {
		$listing = get_page_by_title( $post_title, null, 'job_listing' );
		if ( ! is_wp_error( $listing ) && isset( $listing->ID ) ) {
			update_post_meta( $listing->ID, 'main_image', '' );
		}
	}
	return $job_data;
}
add_filter( 'submit_job_form_save_job_data', 'listable_maybe_clean_main_images_on_submit', 10, 5);

add_action( 'job_manager_update_job_data', 'listable_on_listing_submit', 10, 2 );

function listable_on_listing_submit( $id, $values ) {

	$company_logo = $values['company']['main_image'];

	// turn company logo in featured image
	if ( isset( $company_logo ) && ! empty( $company_logo ) ) {

		$main_image_string = '';
		$main_image_array = array();

		// we may have a simple string(on image upload) or an array of images, so we need to treat them all
		if ( is_numeric( $company_logo ) ) {
			$attach_id = listable_get_attachment_id_from_url( $company_logo );
			if ( ! empty( $attach_id ) && is_numeric( $attach_id ) ) {
				$main_image_string = $attach_id;
				$main_image_array = $company_logo;
			}
		} elseif ( is_array( $company_logo ) && ! empty( $company_logo ) ) {

			foreach ( $company_logo as $key => $url ) {
				$attach_id = listable_get_attachment_id_from_url( $url );
				if ( ! empty( $attach_id ) && is_numeric( $attach_id ) ) {
					$main_image_string .= $attach_id;

					if ( $key < count( $company_logo ) ) {
						$main_image_string .= ',';
					}

					$main_image_array[] = $company_logo;
				}
			}
		}

		/**
		 * Short story:
		 * `main_image` holds a string of attachements ids separated with `,`
		 * `_ main_image` holds an array with every attachment url and we keep it for compatibility with other plugins
		 * Long story:
		 * We hold our images ids into our custom meta key `main_image` generated by PixTypes.
		 * Since we create a wpjm field with this key, there will be, automatically, a key with the `_` prefix
		 * There, wpjm holds the url of the image, not the attachemnts id so we need to offer a compatibility fallback
		 * for this key too.
		 */
		update_post_meta( $id, 'main_image', $main_image_string );
		update_post_meta( $id, '_main_image', $main_image_array );
	}
}

function listable_keep_gallery_images_synced_with_logo( $post_id ) {
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( ! empty( $_POST['main_image'] ) ) {
		$array = explode( ',', $_POST['main_image'] );

		foreach ( $array as $key => $id ) {
			$src = wp_get_attachment_image_src( $id );
			if ( ! is_wp_error( $src ) && ! empty( $src[0] ) ) {
				$array[$key] = $src[0];
			} else {
				unset( $array[$key] );
			}
		}

		update_post_meta( $post_id, '_main_image', $array );
	}
}
add_action( 'save_post', 'listable_keep_gallery_images_synced_with_logo' );

function listable_validate_job_submission_fields( $tru = true, $fields, $values ) {
	$company_logo = $values['company']['company_logo'];

	// turn company logo in featured image
	if ( isset( $company_logo ) && ! empty( $company_logo ) ) {

		$main_image_string = '';

		// we may have a simple string(on image upload) or an array of images, so we need to treat them all
		if ( is_numeric( $company_logo ) ) {
			$attach_id = listable_get_attachment_id_from_url( $company_logo );
			if ( ! empty( $attach_id ) && is_numeric( $attach_id ) ) {
				$main_image_string = $attach_id;
			}
		} elseif ( is_array( $company_logo ) && ! empty( $company_logo ) ) {

			foreach ( $company_logo as $key => $url ) {
				$attach_id = listable_get_attachment_id_from_url( $url );
				if ( ! empty( $attach_id ) && is_numeric( $attach_id ) ) {
					$main_image_string .= $attach_id;

					if ( $key < count( $company_logo ) ) {
						$main_image_string .= ',';
					}
				}
			}
		}
	}

	return $values;
}

add_filter( 'submit_job_form_validate_fields', 'listable_validate_job_submission_fields', 10, 3 );

function listable_job_listing_admin_columns( $columns ) {
	if ( ! is_array( $columns ) ) {
		$columns = array();
	}
	unset ( $columns["job_listing_type"] );
	unset ( $columns["job_position"] );
	// rearrange columns
	$columns = array_slice( $columns, 0, 2, true ) +
	           array( "listable_job_position" => esc_html__( "Position", 'listable' ) ) +
	           array_slice( $columns, 2, count( $columns ) - 1, true );


	$columns = array_slice( $columns, 0, 3, true ) +
	           array( "listable_job_image" => esc_html__( "Image", 'listable' ) ) +
	           array_slice( $columns, 3, count( $columns ) - 1, true );

	return $columns;
}

add_filter( 'manage_edit-job_listing_columns', 'listable_job_listing_admin_columns' );

function listable_job_listing_admin_custom_columns( $column ) {
	global $post;

	switch ( $column ) {
		case "listable_job_position" :
			echo '<div class="job_position">';
			echo '<a href="' . esc_url( admin_url( 'post.php?post=' . $post->ID . '&action=edit' ) ) . '" class="tips job_title" data-tip="' . sprintf( esc_html__( 'ID: %d', 'listable' ), $post->ID ) . '">' . $post->post_title . '</a>';

			echo '<div class="company">';
			$website = esc_url( get_the_company_website() );
			if ( $website ) {
				the_company_name( '<span class="tips" data-tip="' . esc_attr( $website ) . '"><a href="' . $website . '">', '</a></span>' );
			} else {
				the_company_name( '<span class="tips" data-tip="' . esc_attr( $website ) . '">', '</span>' );
			}

			echo '</div>';

			echo '</div>';
			break;

		case "listable_job_image":
			$company_logo_ID = listable_get_post_image_id( $post->ID );

			$company_logo = '';
			if ( ! empty( $company_logo_ID ) ) {
				$company_logo = wp_get_attachment_image_src( $company_logo_ID );
			}

			if ( ! empty( $company_logo ) && ( strstr( $company_logo[0], 'http' ) || file_exists( $company_logo[0] ) ) ) {
				$company_logo = $company_logo[0];
				$company_logo = job_manager_get_resized_image( $company_logo, 'thumbnail' );
				echo '<img class="company_logo" src="' . esc_attr( $company_logo ) . '" alt="' . esc_attr( get_the_company_name( $post ) ) . '" />';
			}
			break;
	}
}

add_action( 'manage_job_listing_posts_custom_column', 'listable_job_listing_admin_custom_columns', 15 );

/*
 * Make sure that comments are open for new listings - from the frontend
 */
function listable_activate_comments_upon_creation( $job_data, $post_title, $post_content, $status, $values ) {
	//modify the listing data on preview
	if ( 'preview' === $status ) {
		$job_data['comment_status'] = 'open';
	} else {
		// but in case this is an edit, just take the users decision to allow or not comments
		$listing = get_page_by_title( $post_title, null, 'job_listing' );
		if ( ! is_wp_error( $listing ) && isset( $listing->comment_status ) ) {
			$job_data['comment_status'] = $listing->comment_status;
		}
	}

	return $job_data;
}

add_filter( 'submit_job_form_save_job_data', 'listable_activate_comments_upon_creation', 10, 5 );

function listable_wrap_the_listings( $html ) {
	$output = '';

	$show_map = listable_jobs_shortcode_get_show_map_param();

	$classes = 'myflex';
	//we need to know a little more about the current page (that holds [jobs] the shortcode )

	if ( false === $show_map ) {
		$classes .= ' no-map';
	}

	$output .= '<div class="' . $classes . '">' . PHP_EOL;
	if ( true === $show_map ) {
		$output .= '<div class="myflex__left">' . $html . '	</div><!-- .myflex__left -->' . PHP_EOL;
		$output .= '<div id="map" class="map myflex__right"></div>' . PHP_EOL;
	} else {
		$output .= $html . PHP_EOL;
	}
	$output .= '</div><!-- .myflex -->' . PHP_EOL;

	return $output;
}

add_filter( 'job_manager_job_listings_output', 'listable_wrap_the_listings', 10, 1 );

function listable_listings_page_shortcode_get_show_map_param() {
	//if there is a page set in the Listings settings use that
	$listings_page_id = get_option( 'job_manager_jobs_page_id', false );
	if ( false !== $listings_page_id ) {
		$listings_page = get_post( $listings_page_id );
		if ( ! is_wp_error( $listings_page ) ) {
			return listable_jobs_shortcode_get_show_map_param( $listings_page->post_content );
		}
	}

	//by default we will show the map
	return true;
}

function listable_jobs_shortcode_get_show_map_param( $content = '' ) {
	global $post;
	if ( empty( $content ) && isset( $post->post_content ) ) {
		$content = get_the_content();
		//if we are on an archive (like category or tag) ignore the description (content)
		if ( is_archive() || empty( $content ) ) {
			//check to see if we have a global shortcode - probably coming from a archive template
			global $current_jobs_shortcode;
			if ( isset( $current_jobs_shortcode ) && ! empty( $current_jobs_shortcode ) ) {
				$content = $current_jobs_shortcode;
			} else {
				//if there is no content of the current page/post and no global shortcode
				return true;
			}
		}
	}
	//lets see if we have a show_map parameter
	$show_map = listable_get_shortcode_param_value( $content, 'jobs', 'show_map', true );
	//if it is a string like "true" we need to remove the "
	if ( is_string( $show_map ) ) {
		$show_map = str_replace( '"', '', $show_map );
	}

	//make sure that $show_map is actually bool
	return listable_string_to_bool( $show_map );
}

function listable_listings_page_shortcode_get_orderby_param() {
	//if there is a page set in the Listings settings use that
	$listings_page_id = get_option( 'job_manager_jobs_page_id', false );
	if ( false !== $listings_page_id ) {
		$listings_page = get_post( $listings_page_id );
		if ( ! is_wp_error( $listings_page ) ) {
			return listable_jobs_shortcode_get_orderby_param( $listings_page->post_content );
		}
	}

	//the default orderby
	return 'featured';
}

function listable_jobs_shortcode_get_orderby_param( $content = '' ) {
	if ( empty( $content ) ) {
		$content = get_the_content();
		if ( empty( $content ) ) {
			//check to see if we have a global shortcode - probably coming from a archive template
			global $current_jobs_shortcode;
			if ( isset( $current_jobs_shortcode ) && ! empty( $current_jobs_shortcode ) ) {
				$content = $current_jobs_shortcode;
			} else {
				//if there is no content of the current page/post and no global shortcode
				return true;
			}
		}
	}
	//lets see if we have a orderby parameter
	$orderby = listable_get_shortcode_param_value( $content, 'jobs', 'orderby', 'featured' );
	//if it is a string like "true" we need to remove the "
	if ( is_string( $orderby ) ) {
		$orderby = str_replace( '"', '', $orderby );
	}

	return $orderby;
}

function listable_listings_page_shortcode_get_order_param() {
	//if there is a page set in the Listings settings use that
	$listings_page_id = get_option( 'job_manager_jobs_page_id', false );
	if ( false !== $listings_page_id ) {
		$listings_page = get_post( $listings_page_id );
		if ( ! is_wp_error( $listings_page ) ) {
			return listable_jobs_shortcode_get_order_param( $listings_page->post_content );
		}
	}

	//the default order
	return 'DESC';
}

function listable_jobs_shortcode_get_order_param( $content = '' ) {
	if ( empty( $content ) ) {
		$content = get_the_content();
		if ( empty( $content ) ) {
			//check to see if we have a global shortcode - probably coming from a archive template
			global $current_jobs_shortcode;
			if ( isset( $current_jobs_shortcode ) && ! empty( $current_jobs_shortcode ) ) {
				$content = $current_jobs_shortcode;
			} else {
				//if there is no content of the current page/post and no global shortcode
				return true;
			}
		}
	}
	//lets see if we have a order parameter
	$order = listable_get_shortcode_param_value( $content, 'jobs', 'order', 'DESC' );
	//if it is a string like "true" we need to remove the "
	if ( is_string( $order ) ) {
		$order = str_replace( '"', '', $order );
	}

	return $order;
}

/*
 * By default WPJM saves the company details in the user meta on job submission so it can use them for future submissions
 * Well since we handle listings, we don't want that
 */
function listable_do_not_prefill_submit_form_fields( $fields, $user_ID ) {
	//make sure that the company fields have no value
	foreach ( $fields['company'] as $key => $field ) {
		unset( $fields['company'][ $key ]['value'] );
	}

	return $fields;
}

add_filter( 'submit_job_form_fields_get_user_data', 'listable_do_not_prefill_submit_form_fields', 10, 2 );

/**
 * ======  Wp Jobs Manager Filters END  ======
 */

/**
 * Output Preview Step for WP Job Manager Submit Form
 */
function listable_submit_form_preview() {
	global $post, $job_preview;

	$instance = WP_Job_Manager_Form_Submit_Job::instance();
	if ( $instance->get_job_id() ) {
		$job_preview = true;
		$action      = $instance->get_action();
		$post        = get_post( $instance->get_job_id() );
		setup_postdata( $post );
		$post->post_status = 'preview';
		?>
		<form method="post" id="job_preview" action="<?php echo esc_url( $action ); ?>">
			<div class="job_listing_preview_title">
				<input type="submit" name="continue" id="job_preview_submit_button" class="button job-manager-button-submit-listing" value="<?php echo apply_filters( 'submit_job_step_preview_submit_text', __( 'Submit Listing', 'listable' ) ); ?>"/>
				<input type="submit" name="edit_job" class="button job-manager-button-edit-listing" value="<?php _e( 'Edit listing', 'wp-job-manager' ); ?>"/>
				<input type="hidden" name="job_id" value="<?php echo esc_attr( $instance->get_job_id() ); ?>"/>
				<input type="hidden" name="step" value="<?php echo esc_attr( $instance->get_step() ); ?>"/>
				<input type="hidden" name="job_manager_form" value="<?php echo $instance->form_name; ?>"/>

				<h2>
					<?php _e( 'Preview', 'listable' ); ?>
				</h2>
			</div>
			<?php get_job_manager_template_part( 'content-single', 'job_listing-preview' ); ?>
		</form>
		<?php
		wp_reset_postdata();
	}
}

/**
 * Change the preview step view handler of the WP Job Manager Submit Form
 *
 * @param $settings
 *
 * @return mixed
 */
function listable_change_submit_preview_function( $settings ) {
	$settings['preview']['view'] = 'listable_submit_form_preview';

	return $settings;
}

add_filter( 'submit_job_steps', 'listable_change_submit_preview_function', 10, 1 );

/**
 * Force WPJM to fetch geolocation data based on current site language
 *
 * @param $url
 * @param $raw_address
 *
 * @return string
 */
function listable_add_google_language_param( $url, $raw_address ) {
	$url = add_query_arg( array( 'language' => get_locale() ), $url );

	return $url;
}

add_filter( 'job_manager_geolocation_endpoint', 'listable_add_google_language_param', 10, 2 );

//We need to add it to the defaults because otherwise it will be scrapped as an option that is not valid
function listable_default_for_show_map_option_jobs_shortcode( $atts ) {
	$atts['show_map'] = true;

	return $atts;
}

add_filter( 'job_manager_output_jobs_defaults', 'listable_default_for_show_map_option_jobs_shortcode' );

/*
 * If one asks for the permalink for listings, give it the listings page URL
 *
 * @param string $link
 * @param string $post_type
 *
 * @return string
 */
function listable_job_listing_post_type_archive_link( $link, $post_type ) {
	if ( 'job_listing' == $post_type ) {
		return listable_get_listings_page_url( $link );
	}

	return $link;
}

add_filter( 'post_type_archive_link', 'listable_job_listing_post_type_archive_link', 10, 2 );

/**
 * If the search_keywords param exists overwrite the s one
 *
 * @param string $query
 *
 * @return mixed
 */
function listable_wpjm_search_keywords_query( $query ) {
	if ( isset( $_REQUEST['search_keywords'] ) ) {
		$keyword = sanitize_text_field( stripslashes( $_REQUEST['search_keywords'] ) );
		if ( ! empty( $keyword ) ) {
			return $keyword;
		}
	}

	return $query;
}

add_filter( 'get_search_query', 'listable_wpjm_search_keywords_query' );

/**
 * Modify the job_dashboard columns
 *
 * @param $columns
 *
 * @return array
 */
function listable_customize_job_dashboard_columns( $columns ) {
	//for now we just don't want the filled column
	if ( isset( $columns['filled'] ) ) {
		unset( $columns['filled'] );
	}

	return $columns;
}

add_filter( 'job_manager_job_dashboard_columns', 'listable_customize_job_dashboard_columns', 10 );

function listable_customize_job_dashboard_actions( $actions, $job ) {
	//for now we just want to remove the filled actions
	if ( isset( $actions['mark_not_filled'] ) ) {
		unset( $actions['mark_not_filled'] );
	}

	if ( isset( $actions['mark_filled'] ) ) {
		unset( $actions['mark_filled'] );
	}

	return $actions;
}

add_filter( 'job_manager_my_job_actions', 'listable_customize_job_dashboard_actions', 10, 2 );

/**
 * Function borrowed from woocommerce
 * @param array $args
 *
 * @return mixed
 */
function listable_display_formatted_address( $args = array() ) {
	echo listable_get_formatted_address();
}

function listable_get_formatted_address ( $post = null, $args = array() ) {

	if ( $post === null ) {
		global $post;
	}

	$address = get_the_job_location();

	if ( empty( $address ) && isset( $post->_job_location ) ) {
		$address = $post->_job_location;
	}

	if ( empty( $address ) ) {
		return false;
	}
	
	if ( true == apply_filters( 'listable_skip_geolocation_formatted_address', false ) ) {
		//we will use the address inputed by the user
		return $address;
	}

	$default_args = array(
		'country'    => get_locale()
	);

	$args = array_map( 'trim', wp_parse_args( $args, $default_args ) );

	extract( $args );

	// Get all formats
	$formats = apply_filters( 'listable_localisation_address_formats', array(
		'default' => '<div itemprop="streetAddress">
			<span class="address__street">{geolocation_street}</span>
			<span class="address__street-no">{geolocation_street_number}</span>
		</div>
		<span class="address__city" itemprop="addressLocality">{geolocation_city}</span>
		<span class="address__postcode" itemprop="postalCode">{geolocation_postcode}</span>
		<span class="address__state-short" itemprop="addressRegion">{geolocation_state_short}</span>
		<span class="address__country-short" itemprop="addressCountry">{geolocation_country_short}</span>'
	));

	// Get format for the address' country
	$format = ( isset( $country ) && $country && isset( $formats[ $country ] ) ) ? $formats[ $country ] : $formats['default'];

	// Substitute address parts into the string
	$replace = array_map( 'esc_html', apply_filters( 'listable_formatted_address_replacements', array(
		'{geolocation_street}' => trim( get_post_meta( $post->ID, 'geolocation_street', true ), '' ),
		'{geolocation_street_number}' => trim( get_post_meta( $post->ID, 'geolocation_street_number', true ), '' ),
		'{geolocation_city}' => trim( get_post_meta( $post->ID, 'geolocation_city', true ), '' ),
		'{geolocation_postcode}' => trim( get_post_meta( $post->ID, 'geolocation_postcode', true ), '' ),
		'{geolocation_state_short}' => trim( get_post_meta( $post->ID, 'geolocation_state_short', true ), '' ),
		'{geolocation_country_short}' => trim( get_post_meta( $post->ID, 'geolocation_country_short', true ), '' ),
	), $args ) );

	$formatted_address = str_replace( array_keys( $replace ), $replace, $format );

	// Clean up white space
	$formatted_address = preg_replace( '/  +/', ' ', trim( $formatted_address ) );
	$formatted_address = preg_replace( '/\n\n+/', "\n", $formatted_address );

	// We're done!
	return $formatted_address;
}