<?php
/**
 * This file contain theme's real estate functions
 */


if ( ! function_exists( 'sort_properties' ) ) {
	/**
	 * This function add sorting parameters to given query arguments
	 *
	 * @param $property_query_args
	 * @return mixed
	 */
	function sort_properties( $property_query_args ) {

		if ( isset( $_GET[ 'sortby' ] ) ) {
			$sort_by = $_GET[ 'sortby' ];
		} else {
			if ( is_page_template( array(
				'template-property-listing.php',
				'template-property-grid-listing.php',
				'template-map-based-listing.php',
			) ) ) {
				$sort_by = get_post_meta( get_the_ID(), 'inspiry_properties_order', true );
			} else {
				$sort_by = get_option( 'theme_listing_default_sort' );
			}
		}

		if ( $sort_by == 'price-asc' ) {
			$property_query_args[ 'orderby' ] = 'meta_value_num';
			$property_query_args[ 'meta_key' ] = 'REAL_HOMES_property_price';
			$property_query_args[ 'order' ] = 'ASC';
		} else if ( $sort_by == 'price-desc' ) {
			$property_query_args[ 'orderby' ] = 'meta_value_num';
			$property_query_args[ 'meta_key' ] = 'REAL_HOMES_property_price';
			$property_query_args[ 'order' ] = 'DESC';
		} else if ( $sort_by == 'date-asc' ) {
			$property_query_args[ 'orderby' ] = 'date';
			$property_query_args[ 'order' ] = 'ASC';
		} else if ( $sort_by == 'date-desc' ) {
			$property_query_args[ 'orderby' ] = 'date';
			$property_query_args[ 'order' ] = 'DESC';
		}

		return $property_query_args;
	}
}


if ( ! function_exists( 'register_properties_payments_page' ) ) {
	/**
	 * Register Sub Menu - PayPal Payments List
	 *
	 * Now, It is only for backward compatibility as PayPal IPN plugin provides all this information.
	 */
	function register_properties_payments_page() {
		add_submenu_page(
			'edit.php?post_type=property',
			__( 'Property Payments', 'framework' ),
			__( 'Property Payments', 'framework' ),
			'manage_options',
			'properties-payments',
			'display_properties_payments'
		);
	}

	add_action( 'admin_menu', 'register_properties_payments_page' );
}


if ( ! function_exists( 'display_properties_payments' ) ) {
	/**
	 * PayPal Payments List - For backward compatibility
	 */
	function display_properties_payments() {
		?>
		<table id="payments-table" cellpadding="10px">
			<tr>
				<th><?php _e( 'Transaction ID', 'framework' ); ?></th>
				<th><?php _e( 'Payment Date', 'framework' ); ?></th>
				<th><?php _e( 'First Name', 'framework' ); ?></th>
				<th><?php _e( 'Last Name', 'framework' ); ?></th>
				<th><?php _e( 'Payer Email', 'framework' ); ?></th>
				<th><?php _e( 'Payment Status', 'framework' ); ?></th>
				<th><?php _e( 'Amount', 'framework' ); ?></th>
				<th><?php _e( 'Currency', 'framework' ); ?></th>
				<th><?php _e( 'Property ID', 'framework' ); ?></th>
				<th><?php _e( 'Property Status', 'framework' ); ?></th>
				<th><?php _e( 'Action', 'framework' ); ?></th>
			</tr>
			<?php
			// determine page (based on <_GET>)
			$page_number = isset( $_GET[ 'page_number' ] ) ? ( (int) $_GET[ 'page_number' ] ) : 1;
			$number_of_properties = 20;

			$paid_props_args = array(
				'post_type' => 'property',
				'posts_per_page' => $number_of_properties,
				'paged' => $page_number,
				'meta_query' => array(
					array(
						'key' => 'payment_status',
						'value' => 'Completed'
					)
				)
			);

			$paid_props_query = new WP_Query( $paid_props_args );

			if ( $paid_props_query->have_posts() ) {
				$total_found_posts = $paid_props_query->found_posts;
				while ( $paid_props_query->have_posts() ) {
					$paid_props_query->the_post();
					global $post;
					$values = get_post_custom( $post->ID );
					$not_available = __( 'Not Available', 'framework' );

					$txn_id = isset( $values[ 'txn_id' ] ) ? esc_attr( $values[ 'txn_id' ][ 0 ] ) : $not_available;
					$payment_date = isset( $values[ 'payment_date' ] ) ? esc_attr( $values[ 'payment_date' ][ 0 ] ) : $not_available;
					$payer_email = isset( $values[ 'payer_email' ] ) ? esc_attr( $values[ 'payer_email' ][ 0 ] ) : $not_available;
					$first_name = isset( $values[ 'first_name' ] ) ? esc_attr( $values[ 'first_name' ][ 0 ] ) : $not_available;
					$last_name = isset( $values[ 'last_name' ] ) ? esc_attr( $values[ 'last_name' ][ 0 ] ) : $not_available;
					$payment_status = isset( $values[ 'payment_status' ] ) ? esc_attr( $values[ 'payment_status' ][ 0 ] ) : $not_available;
					$payment_gross = isset( $values[ 'payment_gross' ] ) ? esc_attr( $values[ 'payment_gross' ][ 0 ] ) : $not_available;
					$payment_currency = isset( $values[ 'mc_currency' ] ) ? esc_attr( $values[ 'mc_currency' ][ 0 ] ) : $not_available;
					?>
					<tr>
						<td><?php echo $txn_id; ?></td>
						<td><?php echo $payment_date; ?></td>
						<td><?php echo $first_name; ?></td>
						<td><?php echo $last_name; ?></td>
						<td><?php echo $payer_email; ?></td>
						<td><?php echo $payment_status; ?></td>
						<td><?php echo $payment_gross; ?></td>
						<td><?php echo $payment_currency; ?></td>
						<td><?php echo $post->ID; ?></td>
						<td><?php echo $post->post_status; ?></td>
						<td>
							<a href="<?php echo get_edit_post_link( $post->ID ); ?>"><?php _e( 'Edit Property', 'framework' ); ?></a>
						</td>
					</tr>
					<?php
				}

				if ( $total_found_posts > $number_of_properties ) {
					?>
					<tr>
						<td colspan="11">
							<?php
							require_once( get_template_directory() . '/framework/functions/Pagination.class.php' );

							// instantiate; set current page; set number of records
							$pagination = ( new Pagination() );
							$pagination->setCurrent( $page_number );
							$pagination->setTotal( $total_found_posts );

							// grab rendered/parsed pagination markup
							echo $pagination->parse();
							?>
						</td>
					</tr>
					<?php
				}
				wp_reset_query();
			} else {
				?>
				<tr>
					<td colspan="11"><?php _e( 'No Completed Payment Found!', 'framework' ); ?></td>
				</tr>
				<?php
			}
			?>
		</table>
		<?php
	}
}


if ( ! function_exists( 'inspiry_completed_payment_handler' ) ) {
	/**
	 * IPN completed payment handler
	 *
	 * @param $posted
	 */
	function inspiry_completed_payment_handler( $posted ) {

		$paypal_merchant_id = get_option( 'theme_paypal_merchant_id' );
		$publish_on_payment = get_option( 'theme_publish_on_payment' );

		if ( $posted[ 'business' ] == $paypal_merchant_id ) {

			if ( isset( $posted[ 'item_number' ] ) && ( ! empty( $posted[ 'item_number' ] ) ) ) {

				$property_id = intval( $posted[ 'item_number' ] );
				$property = get_post( $property_id, 'ARRAY_A' );

				if ( $property ) {

					if ( isset( $posted[ 'txn_id' ] ) && ( ! empty( $posted[ 'txn_id' ] ) ) ) {
						update_post_meta( $property_id, 'txn_id', $posted[ 'txn_id' ] );
					}

					if ( isset( $posted[ 'payment_date' ] ) && ( ! empty( $posted[ 'payment_date' ] ) ) ) {
						update_post_meta( $property_id, 'payment_date', $posted[ 'payment_date' ] );
					}

					if ( isset( $posted[ 'payer_email' ] ) && ( ! empty( $posted[ 'payer_email' ] ) ) ) {
						update_post_meta( $property_id, 'payer_email', $posted[ 'payer_email' ] );
					}

					if ( isset( $posted[ 'first_name' ] ) && ( ! empty( $posted[ 'first_name' ] ) ) ) {
						update_post_meta( $property_id, 'first_name', $posted[ 'first_name' ] );
					}

					if ( isset( $posted[ 'last_name' ] ) && ( ! empty( $posted[ 'last_name' ] ) ) ) {
						update_post_meta( $property_id, 'last_name', $posted[ 'last_name' ] );
					}

					if ( isset( $posted[ 'payment_status' ] ) && ( ! empty( $posted[ 'payment_status' ] ) ) ) {
						update_post_meta( $property_id, 'payment_status', $posted[ 'payment_status' ] );
					}

					if ( isset( $posted[ 'payment_gross' ] ) && ( ! empty( $posted[ 'payment_gross' ] ) ) ) {
						update_post_meta( $property_id, 'payment_gross', $posted[ 'payment_gross' ] );
					}

					if ( isset( $posted[ 'mc_currency' ] ) && ( ! empty( $posted[ 'mc_currency' ] ) ) ) {
						update_post_meta( $property_id, 'mc_currency', $posted[ 'mc_currency' ] );
					}

					if ( $publish_on_payment == "true" ) {
						$property[ 'post_status' ] = 'publish';
						wp_update_post( $property );
					}

					/*
					 * Todo: Plan to implement in future updates
					if ( $payment_notification_email ) {
						$site_name = get_bloginfo( 'name' );
						$email_subject  = sprintf( __('Payment Received for a Property at %s', 'framework'), $site_name );
					}
					*/

				}
			}
		}
	}

	add_action( 'paypal_ipn_for_wordpress_payment_status_completed', 'inspiry_completed_payment_handler' );
}


if ( ! function_exists( 'realhomes_admin_styles' ) ) {
	/**
	 * Register and load admin styles
	 *
	 * @param $hook
	 */
	function realhomes_admin_styles( $hook ) {
		wp_register_style( 'realhomes-admin-styles', get_template_directory_uri() . '/css/realhomes-admin-styles.css' );
		wp_enqueue_style( 'realhomes-admin-styles' );
	}

	add_action( 'admin_enqueue_scripts', 'realhomes_admin_styles' );
}


if ( ! function_exists( 'inspiry_get_figure_caption' ) ) {
	/**
	 * Figure caption based on property statuses
	 *
	 * @param $post_id
	 * @return string
	 */
	function inspiry_get_figure_caption( $post_id ) {
		$status_terms = get_the_terms( $post_id, "property-status" );
		if ( ! empty( $status_terms ) ) {
			$status_classes = '';
			$status_names = '';
			$status_count = 0;
			foreach ( $status_terms as $term ) {
				if ( $status_count > 0 ) {
					$status_names .= ', ';  /* add comma before the term namee of 2nd and any later term */
					$status_classes .= ' ';
				}
				$status_names .= $term->name;
				$status_classes .= $term->slug;
				$status_count++;
			}

			if ( ! empty( $status_names ) ) {
				return '<figcaption class="' . $status_classes . '">' . $status_names . '</figcaption>';
			}

			return '';
		}
	}
}


if ( ! function_exists( 'display_figcaption' ) ) {
	/**
	 * Display figure caption for given property's post id
	 *
	 * @param $post_id
	 */
	function display_figcaption( $post_id ) {
		echo inspiry_get_figure_caption( $post_id );
	}
}


if ( ! function_exists( 'inspiry_get_property_types' ) ) {
	/**
	 * Get property types
	 *
	 * @param $property_post_id
	 * @return string
	 */
	function inspiry_get_property_types( $property_post_id ) {
		$type_terms = get_the_terms( $property_post_id, "property-type" );
		$type_count = count( $type_terms );
		if ( ! empty( $type_terms ) ) {
			$property_types_str = '<small> - ';
			$loop_count = 1;
			foreach ( $type_terms as $typ_trm ) {
				$property_types_str .= $typ_trm->name;
				if ( $loop_count < $type_count && $type_count > 1 ) {
					$property_types_str .= ', ';
				}
				$loop_count++;
			}
			$property_types_str .= '</small>';
		} else {
			$property_types_str = '&nbsp;';
		}
		return $property_types_str;
	}
}


if ( ! function_exists( 'inspiry_get_terms_array' ) ) {
	/**
	 * Returns terms array for a given taxonomy containing key(slug) value(name) pair
	 *
	 * @param $tax_name
	 * @param $terms_array
	 */
	function inspiry_get_terms_array( $tax_name, &$terms_array ) {
		$tax_terms = get_terms( $tax_name, array(
			'hide_empty' => false,
		) );
		inspiry_add_term_children( 0, $tax_terms, $terms_array );
	}
}


if ( ! function_exists( 'inspiry_add_term_children' ) ) :
	/**
	 * A recursive function to add children terms to given array
	 *
	 * @param $parent_id
	 * @param $tax_terms
	 * @param $terms_array
	 * @param string $prefix
	 */
	function inspiry_add_term_children( $parent_id, $tax_terms, &$terms_array, $prefix = '' ) {
		if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ) {
			foreach ( $tax_terms as $term ) {
				if ( $term->parent == $parent_id ) {
					$terms_array[ $term->slug ] = $prefix . $term->name;
					inspiry_add_term_children( $term->term_id, $tax_terms, $terms_array, $prefix . '- ' );
				}
			}
		}
	}
endif;


if ( ! function_exists( 'inspiry_properties_filter' ) ) {
	/**
	 * Add properties filter parameters to given query arguments
	 *
	 * @param $properties_query_args  Array   query arguments
	 * @return mixed    Array   modified query arguments
	 */
	function inspiry_properties_filter( $properties_query_args ) {

		$page_id = get_the_ID();
		$tax_query = array();
		$meta_query = array();

		/*
		 * number of properties on each page
		 */
		$number_of_properties = get_post_meta( $page_id, 'inspiry_posts_per_page', true );
		if ( $number_of_properties ) {
			$number_of_properties = intval( $number_of_properties );
			if ( $number_of_properties < 1 ) {
				$properties_query_args[ 'posts_per_page' ] = 6;
			} else {
				$properties_query_args[ 'posts_per_page' ] = $number_of_properties;
			}
		} else {
			$properties_query_args[ 'posts_per_page' ] = 6;
		}


		/*
		 * Locations
		 */
		$locations = get_post_meta( $page_id, 'inspiry_properties_locations', false );
		if ( ! empty( $locations ) && is_array( $locations ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-city',
				'field' => 'slug',
				'terms' => $locations
			);
		}

		/*
		 * Statuses
		 */
		$statuses = get_post_meta( $page_id, 'inspiry_properties_statuses', false );
		if ( ! empty( $statuses ) && is_array( $statuses ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-status',
				'field' => 'slug',
				'terms' => $statuses
			);
		}

		/*
		 * Types
		 */
		$types = get_post_meta( $page_id, 'inspiry_properties_types', false );
		if ( ! empty( $types ) && is_array( $types ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-type',
				'field' => 'slug',
				'terms' => $types
			);
		}

		/*
		 * Features
		 */
		$features = get_post_meta( $page_id, 'inspiry_properties_features', false );
		if ( ! empty( $features ) && is_array( $features ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-feature',
				'field' => 'slug',
				'terms' => $features
			);
		}

		// if more than one taxonomies exist then specify the relation
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query[ 'relation' ] = 'AND';
		}
		if ( $tax_count > 0 ) {
			$properties_query_args[ 'tax_query' ] = $tax_query;
		}

		/*
		 * Minimum Bedrooms
		 */
		$min_beds = get_post_meta( $page_id, 'inspiry_properties_min_beds', true );
		if ( ! empty( $min_beds ) ) {
			$min_beds = intval( $min_beds );
			if ( $min_beds > 0 ) {
				$meta_query[] = array(
					'key' => 'REAL_HOMES_property_bedrooms',
					'value' => $min_beds,
					'compare' => '>=',
					'type' => 'DECIMAL'
				);
			}
		}

		/*
		 * Minimum Bathrooms
		 */
		$min_baths = get_post_meta( $page_id, 'inspiry_properties_min_baths', true );
		if ( ! empty( $min_baths ) ) {
			$min_baths = intval( $min_baths );
			if ( $min_baths > 0 ) {
				$meta_query[] = array(
					'key' => 'REAL_HOMES_property_bathrooms',
					'value' => $min_baths,
					'compare' => '>=',
					'type' => 'DECIMAL'
				);
			}
		}

		/*
		 * Min & Max Price
		 */
		$min_price = get_post_meta( $page_id, 'inspiry_properties_min_price', true );
		$max_price = get_post_meta( $page_id, 'inspiry_properties_max_price', true );
		if ( ! empty( $min_price ) && ! empty( $max_price ) ) {
			$min_price = doubleval( $min_price );
			$max_price = doubleval( $max_price );
			if ( $min_price >= 0 && $max_price > $min_price ) {
				$meta_query[] = array(
					'key' => 'REAL_HOMES_property_price',
					'value' => array( $min_price, $max_price ),
					'type' => 'NUMERIC',
					'compare' => 'BETWEEN'
				);
			}
		} elseif ( ! empty( $min_price ) ) {
			$min_price = doubleval( $min_price );
			if ( $min_price > 0 ) {
				$meta_query[] = array(
					'key' => 'REAL_HOMES_property_price',
					'value' => $min_price,
					'type' => 'NUMERIC',
					'compare' => '>='
				);
			}
		} elseif ( ! empty( $max_price ) ) {
			$max_price = doubleval( $max_price );
			if ( $max_price > 0 ) {
				$meta_query[] = array(
					'key' => 'REAL_HOMES_property_price',
					'value' => $max_price,
					'type' => 'NUMERIC',
					'compare' => '<='
				);
			}
		}

		// if more than one meta query elements exist then specify the relation
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			$meta_query[ 'relation' ] = 'AND';
		}
		if ( $meta_count > 0 ) {
			$properties_query_args[ 'meta_query' ] = $meta_query;
		}

		return $properties_query_args;
	}

	add_filter( 'inspiry_properties_filter', 'inspiry_properties_filter' );
}
