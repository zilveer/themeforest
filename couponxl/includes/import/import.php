<?php
	add_action( 'admin_menu', 'coupon_import_page' );
	/* add link to the sidebar */
	function coupon_import_page() {
		add_menu_page(__( 'Import XML', 'couponxl' ), __( 'Import XML', 'couponxl' ), 'manage_options', 'import-coupons', 'couponxl_import_page', 'dashicons-upload');
	}	

	/* Show welcome screen and upload form */
	function couponxl_import_page(){
		if( isset( $_GET['parse'] ) ){
			couponxl_handle_upload();
		}
		else{
			echo '<div class="wrap">
	        		<h2>'.__( 'Import Coupons And/Or Deals' ).'</h2>
	    			<div class="narrow">
	    				<p>'.__( 'Hello and welcome to the coupon import tool. In order to be able to import coupons and deal properlly make sure you have created proper XML file', 'couponxl' ).'.</p>
	    				<p>'.__( 'More on how to create valid XML file you can find in the theme documentation', 'couponxl' ).'</p>';
	    				wp_import_upload_form( 'admin.php?page=import-coupons&parse=1' );
			echo 	'</div>
				</div>';
		}
	}

	/* Process upload of the file */
	function couponxl_handle_upload(){
		$file = wp_import_handle_upload();

		if ( isset( $file['error'] ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', 'couponxl' ) . '</strong><br />';
			echo esc_html( $file['error'] ) . '</p>';
			return false;
		} else if ( ! file_exists( $file['file'] ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', 'couponxl' ) . '</strong><br />';
			printf( __( 'The export file could not be found at <code>%s</code>. It is likely that this was caused by a permissions problem.', 'couponxl' ), esc_html( $file['file'] ) );
			echo '</p>';
			return false;
		}

		$id = (int) $file['id'];
		$import_data = couponxl_parse_and_import( $file['file'] );
		if ( is_wp_error( $import_data ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', 'couponxl' ) . '</strong><br />';
			echo esc_html( $import_data->get_error_message() ) . '</p>';
			return false;
		}

	}

	/* Display messages during import process */
	function couponxl_display_import_info( $message ){
		echo '<br/>'.$message;
	}

	/* Assign existing or create a new store for the offer */
	function couponxl_validate_store( $offer, $offer_id ){
		if( !empty( $offer->offer_store ) ){
			update_post_meta( $offer_id, 'offer_store', (string)$offer->offer_store );
		}
		else{
			$store = get_page_by_title( $offer->offer_title, OBJECT, 'post' );
			if( !empty( $store ) ){
				update_post_meta( $offer_id, 'offer_store', (string)$store->ID );
			}
			else{
				$store_id = wp_insert_post(array(
					'post_type' => 'store',
					'post_status' => 'publish',
					'post_title' => (string)$offer->store_title,
					'post_content' => (string)$offer->store_description,
				));

				$store_logo_id = couponxl_import_image( $offer->store_logo );
				set_post_thumbnail( $store_id, $store_logo_id );

				update_post_meta( $store_id, 'store_link', (string)$offer->store_link );
				if( !empty( $offer->store_facebook ) ){
					update_post_meta( $store_id, 'store_facebook', (string)$offer->store_facebook );
				}
				if( !empty( $offer->store_twitter ) ){
					update_post_meta( $store_id, 'store_twitter', (string)$offer->store_twitter );
				}
				if( !empty( $offer->store_google ) ){
					update_post_meta( $store_id, 'store_google', (string)$offer->store_google );
				}
				if( !empty( $offer->store_gmap_marker ) ){
					update_post_meta( $store_id, 'store_gmap_marker', (string)$offer->store_gmap_marker );
				}
				if( !empty( $offer->store_gmap_longiture ) ){
					update_post_meta( $store_id, 'store_gmap_longiture', (string)$offer->store_gmap_longiture );
				}
				if( !empty( $offer->store_gmap_latitude ) ){
					update_post_meta( $store_id, 'store_gmap_latitude', (string)$offer->store_gmap_latitude );
				}

				$store_letter = (string)$offer->store_letter;
				if( !empty( $store_letter ) ){
					$term = term_exists( $store_letter, 'letter');
					if( !$term ){
						$term = wp_insert_term( $store_letter, 'letter' );
					}		
					wp_set_post_terms( $store_id, $term['term_id'], 'letter', true );
				}

				update_post_meta( $offer_id, 'offer_store', (string)$store_id );
			}
		}
	}

	function couponxl_if_image_exists( $filename ){
		global $wpdb;
		$result = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT post_id FROM {$wpdb->postmeta} WHERE meta_value LIKE %s",
				'%'.$filename.'%'
			)
		);

		if( !empty( $result ) ){
			$result = array_shift( $result );
			return $result->post_id;
		}
		else{
			return false;
		}

	}

	/* This handles import of the images via URL */
	function couponxl_import_image( $image_url ){
		$basename = basename( $image_url );
		$image_id = couponxl_if_image_exists( $basename );
		if( !$image_id ){
			$tmp = download_url( (string)$image_url );

			couponxl_display_import_info( __( 'Downloading image: ', 'couponxl' ).$basename );

			$file_array = array();
			preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $image_url, $matches);
			$file_array['name'] = basename($matches[0]);
			$file_array['tmp_name'] = $tmp;
			// If error storing temporarily, unlink
			if ( is_wp_error( $tmp ) ) {
				@unlink($file_array['tmp_name']);
				couponxl_display_import_info( $tmp->get_error_message() );
				$file_array['tmp_name'] = '';
			}

			// do the validation and storage stuff
			$id = media_handle_sideload( $file_array, 0 );

			// If error storing permanently, unlink
			if ( is_wp_error($id) ) {
				couponxl_display_import_info( $id->get_error_message() );
				@unlink($file_array['tmp_name']);
				return $id;
			}

			return $id;
		}
		else{
			couponxl_display_import_info( __( 'Image ', 'couponxl' ).$basename.__( ' exists, skipping import and using existing one.', 'couponxl' ) );
			return $image_id;
		}
	}

	/*
	Assign to the existing or create other categories.
	Since it is nesting first it checks for the last category name in the array so if it exists add it to that category
	and skip checking others
	*/
	function couponxl_process_categories( $offer_cat, $offer_id ){
		$offer_cats = explode( ',', $offer_cat );
		$last_parent = 0;
		$category_hierarchicy = array();
		foreach( $offer_cats as $offer_cat ){				
			$term = term_exists( $offer_cat, 'offer_cat');
			if( !$term ){
				$term = wp_insert_term(
					$offer_cat,
					'offer_cat',
					array(
						'parent' => $last_parent
					)
				);
			}
			$last_parent = $term['term_id'];
			$category_hierarchicy[] = $term['term_id'];			
		}

		wp_set_post_terms( $offer_id, $category_hierarchicy, 'offer_cat', true );
	}

	/* handles adding locations in the same way as categories */
	function couponxl_process_locations( $location, $offer_id ){
		$locations = explode( ',', $location );
		$last_parent = 0;
		$location_hierarchicy = array();
		foreach( $locations as $location ){				
			$term = term_exists( $location, 'location');
			if ( !$term ) {
				$term = wp_insert_term(
					$location,
					'location',
					array(
						'parent' => $last_parent
					)
				);
			}
			$last_parent = $term['term_id'];
			$location_hierarchicy[] = $term['term_id'];			
		}

		wp_set_post_terms( $offer_id, $location_hierarchicy, 'location', true );
	}

	/* processing tags */
	function couponxl_process_tags( $offer_tag, $offer_id ){
		if( !empty( $offer_tag ) ){
			$offer_tags = explode( ',', $offer_tag );
			wp_set_post_terms( $offer_id, $offer_tags, 'offer_tag', true );
		}
	}

	/* Import common data for coupons and for deals */
	function couponxl_import_offer( $offer ){
		/* insert all common data */
		$insert_args = array(
			'post_type' => 'offer',
			'post_title' => (string)$offer->offer_title,
			'post_content' => (string)$offer->offer_description,
			'post_status' => 'publish',
		);

		if( $offer->offer_type == 'coupon' && !empty( $offer->coupon_excerpt ) ){
			$insert_args['post_excerpt'] = (string)$offer->coupon_excerpt;
		}

		$offer_id = wp_insert_post( $insert_args );

		/* insert featured image */
		$featured_image_id = couponxl_import_image( $offer->offer_featured_image );		
		set_post_thumbnail( $offer_id, $featured_image_id );		

		/* hadle categories */
		couponxl_process_categories( (string)$offer->offer_cat, $offer_id );
		couponxl_process_locations( (string)$offer->offer_location, $offer_id );
		couponxl_process_tags( (string)$offer->offer_tags, $offer_id );
			
		update_post_meta( $offer_id, 'offer_type', (string)$offer->offer_type );
		update_post_meta( $offer_id, 'offer_start', (string)$offer->offer_start );
		update_post_meta( $offer_id, 'offer_expire', (string)$offer->offer_expire );
		update_post_meta( $offer_id, 'offer_in_slider', 'no' );
		update_post_meta( $offer_id, 'offer_initial_payment', 'paid' );

		couponxl_validate_store( $offer, $offer_id );

		if( $offer->offer_type == 'coupon' ){
			couponxl_import_coupon( $offer, $offer_id );
		}
		else{
			couponxl_import_deal( $offer, $offer_id );
		}

		couponxl_display_import_info( '*******************' );

	}


	/* Import only coupon specific options */
	function couponxl_import_coupon( $offer, $offer_id ){
		update_post_meta( $offer_id, 'coupon_type', (string)$offer->coupon_type );
		switch( $offer->coupon_type ){
			case 'code':
				update_post_meta( $offer_id, 'coupon_code', (string)$offer->coupon_code );
				break;
			case 'sale':
				update_post_meta( $offer_id, 'coupon_sale', (string)$offer->coupon_sale );
				break;
			case 'printable':
				$coupon_image_id = couponxl_import_image( $offer->coupon_image );
				update_post_meta( $offer_id, 'coupon_image', (string)$coupon_image_id );
				break;				
		}
		if( !empty( $offer->coupon_link ) ){
			update_post_meta( $offer_id, 'coupon_link', (string)$offer->coupon_link );
		}
		update_post_meta( $offer_id, 'deal_status', 'has_items' );
	}

	/* import deal markers if there are any */
	function couponxl_process_deal_markers( $offer_id, $deal_markers ){
		if( !empty( $deal_markers->deal_marker ) ){
			foreach( $deal_markers->deal_marker as $marker_obj ){
				if( !empty( $marker_obj->deal_marker_longitude ) && !empty( $marker_obj->deal_marker_latitude ) ){
					add_post_meta( $offer_id, 'deal_markers', array(
						'deal_marker_longitude' => (string)$marker_obj->deal_marker_longitude,
						'deal_marker_latitude' => (string)$marker_obj->deal_marker_latitude
					) );
				}				
			}
		}
	}

	/* import deal images if there are any */
	function couponxl_process_deal_images( $offer_id, $deal_images ){
		$deal_images_array = array();
		$counter = 0;
		if( !empty( $deal_images->deal_image ) ){
			foreach( $deal_images->deal_image as $image_url ){
				$deal_images_array['sm-field-'.$counter] = couponxl_import_image( $image_url );
				$counter++;				
			}
		}
		$deal_images = array( serialize( $deal_images_array ) );
		update_post_meta( $offer_id, 'deal_images', implode( "", $deal_images ) );
	}

	/* import deal specific meta data */
	function couponxl_import_deal( $offer, $offer_id ){
		update_post_meta( $offer_id, 'deal_items', (string)$offer->deal_items );
		$vouchers = explode( "\n", (string)$offer->deal_item_vouchers );
		$vouchers = array_map( 'trim', $vouchers );
		update_post_meta( $offer_id, 'deal_item_vouchers', join( "\n", $vouchers ) );
		update_post_meta( $offer_id, 'deal_price', (string)$offer->deal_price );
		update_post_meta( $offer_id, 'deal_sale_price', (string)$offer->deal_sale_price );
		update_post_meta( $offer_id, 'deal_discount', (string)$offer->deal_discount );
		update_post_meta( $offer_id, 'deal_status', 'has_items' );
		if( !empty( $offer->deal_voucher_expire ) ){
			update_post_meta( $offer_id, 'deal_voucher_expire', (string)$offer->deal_voucher_expire );
		}
		update_post_meta( $offer_id, 'deal_in_short', (string)$offer->deal_in_short );
		update_post_meta( $offer_id, 'deal_type', (string)$offer->deal_type );
		
		couponxl_process_deal_markers( $offer_id, $offer->deal_markers );
		couponxl_process_deal_images( $offer_id, $offer->deal_images );
		if( !empty( $offer->deal_link ) ){
			update_post_meta( $offer_id, 'deal_link', (string)$offer->deal_link );
		}
	}	

	/* parse xml file and import offers */
	function couponxl_parse_and_import( $file ){
		$internal_errors = libxml_use_internal_errors(true);

		$dom = new DOMDocument;
		$old_value = null;
		if ( function_exists( 'libxml_disable_entity_loader' ) ) {
			$old_value = libxml_disable_entity_loader( true );
		}
		$success = $dom->loadXML( file_get_contents( $file ) );
		if ( ! is_null( $old_value ) ) {
			libxml_disable_entity_loader( $old_value );
		}

		if ( ! $success || isset( $dom->doctype ) ) {
			return new WP_Error( 'SimpleXML_parse_error', __( 'There was an error when reading this WXR file', 'couponxl' ), libxml_get_errors() );
		}

		$xml = simplexml_import_dom( $dom );
		unset( $dom );

		// halt if loading produces an error
		if ( ! $xml ){
			return new WP_Error( 'SimpleXML_parse_error', __( 'There was an error when reading this WXR file', 'couponxl' ), libxml_get_errors() );
		}
		set_time_limit(0);
		$counter = 0;
		foreach ( $xml->xpath('/offers/offer') as $offer ) {
			$counter++;
			$offer_identifier = !empty( $offer->offer_identifier ) ? $offer->offer_identifier : '#'.$counter;
			couponxl_display_import_info( '<br />'.__( 'Importing offer: ', 'couponxl' ).$offer_identifier );

			$offer_title = !empty( $offer->offer_title ) ? $offer->offer_title : '';
			$offer_description = !empty( $offer->offer_description ) ? $offer->offer_description : '';
			$offer_featured_image = !empty( $offer->offer_featured_image ) ? $offer->offer_featured_image : '';
			$offer_cat = !empty( $offer->offer_cat ) ? $offer->offer_cat : '';
			$offer_location = !empty( $offer->offer_location ) ? $offer->offer_location : '';
			$offer_tags = !empty( $offer->offer_tags ) ? $offer->offer_tags : '';
			$offer_type = !empty( $offer->offer_type ) ? $offer->offer_type : '';
			$offer_start = !empty( $offer->offer_start ) ? $offer->offer_start : '';
			$offer_expire = !empty( $offer->offer_expire ) ? $offer->offer_expire : '';
			$offer_store = !empty( $offer->offer_store ) ? $offer->offer_store : '';

			$store_title = !empty( $offer->store_title ) ? $offer->store_title : '';
			$store_letter = !empty( $offer->store_letter ) ? $offer->store_letter : '';
			$store_description = !empty( $offer->store_description ) ? $offer->store_description : '';
			$store_logo = !empty( $offer->store_logo ) ? $offer->store_logo : '';
			$store_link = !empty( $offer->store_link ) ? $offer->store_link : '';
			$store_facebook = !empty( $offer->store_facebook ) ? $offer->store_facebook : '';
			$store_twitter = !empty( $offer->store_twitter ) ? $offer->store_twitter : '';
			$store_google = !empty( $offer->store_google ) ? $offer->store_google : '';

			$coupon_excerpt = !empty( $offer->coupon_excerpt ) ? $offer->coupon_excerpt : '';
			$coupon_type = !empty( $offer->coupon_type ) ? $offer->coupon_type : '';
			$coupon_link = !empty( $offer->coupon_link ) ? $offer->coupon_link : '';
			$coupon_code = !empty( $offer->coupon_code ) ? $offer->coupon_code : '';
			$coupon_sale = !empty( $offer->coupon_sale ) ? $offer->coupon_sale : '';
			$coupon_image = !empty( $offer->coupon_image ) ? $offer->coupon_image : '';

			$deal_items = !empty( $offer->deal_items ) ? $offer->deal_items : '';
			$deal_price = !empty( $offer->deal_price ) ? $offer->deal_price : '';
			$deal_sale_price = !empty( $offer->deal_sale_price ) ? $offer->deal_sale_price : '';
			$deal_discount = !empty( $offer->deal_discount ) ? $offer->deal_discount : '';
			$deal_status = !empty( $offer->deal_status ) ? $offer->deal_status : '';
			$deal_voucher_expire = !empty( $offer->deal_voucher_expire ) ? $offer->deal_voucher_expire : '';
			$deal_in_short = !empty( $offer->deal_in_short ) ? $offer->deal_in_short : '';
			$deal_markers = !empty( $offer->deal_markers ) ? $offer->deal_markers : '';
			$deal_images = !empty( $offer->deal_images ) ? $offer->deal_images : '';
			$deal_type = !empty( $offer->deal_type ) ? $offer->deal_type : '';
			$deal_link = !empty( $offer->deal_link ) ? $offer->deal_link : '';

			if( !empty( $offer_title ) ){
				$offer_exists = get_page_by_title( $offer_title, OBJECT, 'offer' );
				if( $offer_exists ){
					couponxl_display_import_info( $offer_title.__( ' is already imported, skipping this offer', 'couponxl' ) );
				}
				else{
					if( !empty( $offer_description ) ){
						if( !empty( $offer_featured_image ) ){
							if( !empty( $offer_cat ) ){
								if( !empty( $offer_location ) ){
									if( !empty( $offer_expire ) ){
										if( !empty( $offer_store ) ){
											$has_store = true;
										}
										else{
											$has_store = true;
											if( empty( $store_title ) ){
												$has_store = false;
												couponxl_display_import_info( __( 'Store title is required, skipping this offer', 'couponxl' ) );
											}
											else if( empty( $store_letter ) ){
												$has_store = false;
												couponxl_display_import_info( __( 'Store letter is required, skipping this offer', 'couponxl' ) );
											}
											else if( empty( $store_description ) ){
												$has_store = false;
												couponxl_display_import_info( __( 'Store description is required, skipping this offer', 'couponxl' ) );
											}
											else if( empty( $store_logo ) ){
												$has_store = false;
												couponxl_display_import_info( __( 'Store logo is required, skipping this offer', 'couponxl' ) );
											}
											else if( empty( $store_link ) ){
												$has_store = false;
												couponxl_display_import_info( __( 'Store link is required, skipping this offer', 'couponxl' ) );
											}
										}

										if( $has_store ){
											if( empty( $offer_start ) ){
												$offer->offer_start = current_time( 'timestamp' );
											}
											if( empty( $offer_expire ) ){
												$offer->offer_expire = '99999999999';
											}
											if( $offer_type == 'coupon' || $offer_type == 'deal' ){
												if( $offer_type == 'coupon' ){
													if( $coupon_type == 'code' || $coupon_type == 'sale' || $coupon_type = 'printable' ){
														$check_coupon_type_value = true;
														switch( $coupon_type ){
															case 'code' : 
																if( empty( $coupon_code ) ){
																	$check_coupon_type_value = false;
																	couponxl_display_import_info( __( 'You need to input code value for the coupon type code, skipping this coupon', 'couponxl' ) );
																}
																break;
															case 'sale' : 
																if( empty( $coupon_sale ) ){
																	$check_coupon_type_value = false;
																	couponxl_display_import_info( __( 'You need to input sale link for the coupon type sale, skipping this coupon', 'couponxl' ) );
																}
																break;
															case 'printable' : 
																if( empty( $coupon_image ) ){
																	$check_coupon_type_value = false;
																	couponxl_display_import_info( __( 'You need to input URL to coupon image for the printable coupon type, skipping this coupon', 'couponxl' ) );
																}
																break;
															default: 
																$check_coupon_type_value = false;
																couponxl_display_import_info( __( 'You need to specify coupon data based on its type, skipping this coupon', 'couponxl' ) );
														}
														if( $check_coupon_type_value == true ){
															couponxl_import_offer( $offer );
														}
													}
													else{
														couponxl_display_import_info( __( 'Coupon type is required and can be only \'code\', \'sale\' or \'printable\', skipping this coupon', 'couponxl' ) );
													}
												}
												else{
													if( !empty( $deal_items ) ){
														if( !empty( $deal_price ) ){
															if( !empty( $deal_sale_price ) ){
																if( !empty( $deal_discount ) ){
																	if( !empty( $deal_in_short ) ){
																		if( $deal_type == 'shared' || $deal_type == 'not_shared' ){																			
																			couponxl_import_offer( $offer );
																		}
																		else{
																			couponxl_display_import_info( __( 'You need to input deal type which can be only \'shared\' or \'not_shared\', skipping this deal', 'couponxl' ) );
																		}
																	}
																	else{
																		couponxl_display_import_info( __( 'You need to input short description of the deal, skipping this deal', 'couponxl' ) );
																	}
																}
																else{
																	couponxl_display_import_info( __( 'You need to specify amount of the discount based on the real price and sale price ( SALE PRICE / REAL PRICE * 100 ), skipping this deal', 'couponxl' ) );
																}
															}
															else{
																couponxl_display_import_info( __( 'You need to specify sale price of the deal ( number only with max two decimal separated by . ), skipping this deal', 'couponxl' ) );
															}
														}
														else{
															couponxl_display_import_info( __( 'You need to specify real price of the deal ( number only with max two decimal separated by . ), skipping this deal', 'couponxl' ) );
														}
													}
													else{
														couponxl_display_import_info( __( 'You need to specify number of items you wish to sell, skipping this deal', 'couponxl' ) );
													}
												}
											}
											else{
												couponxl_display_import_info( __( 'Offer type is required and can be only \'coupon\' or \'deal\', skipping this offer', 'couponxl' ) );
											}										
										}
									}
									else{
										couponxl_display_import_info( __( 'Offer expire is required, skipping this offer', 'couponxl' ) );
									}
								}
								else{
									couponxl_display_import_info( __( 'Location is required, skipping this offer', 'couponxl' ) );
								}
							}
							else{
								couponxl_display_import_info( __( 'Category is required, skipping this offer', 'couponxl' ) );
							}
						}
						else{
							couponxl_display_import_info( __( 'Featured image is required, skipping this offer', 'couponxl' ) );
						}
					}
					else{
						couponxl_display_import_info( __( 'Description is required, skipping this offer', 'couponxl' ) );
					}
				}
			}
			else{
				couponxl_display_import_info( __( 'Title is required, skipping this offer', 'couponxl' ) );
			}
		}
		couponxl_display_import_info( '<br />*******************' );
		couponxl_display_import_info( __( 'Import process is completed', 'couponxl' ) );
	}
?>