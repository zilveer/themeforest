<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 07/10/15
 * Time: 11:31 AM
 */

/*-----------------------------------------------------------------------------------*/
// Submit Property filter
/*-----------------------------------------------------------------------------------*/
add_filter('houzez_submit_listing', 'houzez_submit_listing');

if( !function_exists('houzez_submit_listing') ) {
    function houzez_submit_listing($new_property) {
        global $current_user;

        wp_get_current_user();
        $userID = $current_user->ID;
        $listings_admin_approved = houzez_option('listings_admin_approved');
        $enable_paid_submission = houzez_option('enable_paid_submission');

        // Title
        if( isset( $_POST['prop_title']) ) {
            $new_property['post_title'] = sanitize_text_field( $_POST['prop_title'] );
        }

        if( $enable_paid_submission == 'membership' ) {
            $user_submit_has_no_membership = isset($_POST['user_submit_has_no_membership']) ? $_POST['user_submit_has_no_membership'] : '';
        } else {
            $user_submit_has_no_membership = 'no';
        }

        // Description
        if( isset( $_POST['prop_des'] ) ) {
            $new_property['post_content'] = wp_kses_post( $_POST['prop_des'] );
        }

        $new_property['post_author'] = $userID;

        $submission_action = $_POST['action'];
        $prop_id = 0;

        if( $submission_action == 'add_property' ) {

            if( $listings_admin_approved != 'yes' && ( $enable_paid_submission == 'no' || $enable_paid_submission = 'membership' ) ) {
                if( $user_submit_has_no_membership == 'yes' ) {
                    $new_property['post_status'] = 'draft';
                } else {
                    $new_property['post_status'] = 'publish';
                }
            } else {
                if( $user_submit_has_no_membership == 'yes' && $enable_paid_submission = 'membership' ) {
                    $new_property['post_status'] = 'draft';
                } else {
                    $new_property['post_status'] = 'pending';
                }
            }

            $prop_id = wp_insert_post( $new_property );

            if( $prop_id > 0 ) {
                $submitted_successfully = true;
                if( $enable_paid_submission == 'membership'){ // update package status
                    houzez_update_package_listings( $userID );
                }
                do_action( 'wp_insert_post', 'wp_insert_post' ); // Post the Post
            }
        }else if( $submission_action == 'update_property' ) {
            $new_property['ID'] = intval( $_POST['prop_id'] );
            $prop_id = wp_update_post( $new_property );

            if( $prop_id > 0 ) {
                $updated_successfully = true;
            }
        }

        if( $prop_id > 0 ) {


            if( $user_submit_has_no_membership == 'yes' ) {
                update_user_meta( $userID, 'user_submit_has_no_membership', $prop_id );
            }

            // Add price post meta
            if( isset( $_POST['prop_price'] ) ) {
                update_post_meta( $prop_id, 'fave_property_price', sanitize_text_field( $_POST['prop_price'] ) );

                if( isset( $_POST['prop_label'] ) ) {
                    update_post_meta( $prop_id, 'fave_property_price_postfix', sanitize_text_field( $_POST['prop_label']) );
                }
            }

            //price prefix
            if( isset( $_POST['prop_price_prefix'] ) ) {
                update_post_meta( $prop_id, 'fave_property_price_prefix', sanitize_text_field( $_POST['prop_price_prefix']) );
            }

            // Second Price
            if( isset( $_POST['prop_sec_price'] ) ) {
                update_post_meta( $prop_id, 'fave_property_sec_price', sanitize_text_field( $_POST['prop_sec_price'] ) );
            }

            // Area Size
            if( isset( $_POST['prop_size'] ) ) {
                update_post_meta( $prop_id, 'fave_property_size', sanitize_text_field( $_POST['prop_size'] ) );
            }

            // Area Size Prefix
            if( isset( $_POST['prop_size_prefix'] ) ) {
                update_post_meta( $prop_id, 'fave_property_size_prefix', sanitize_text_field( $_POST['prop_size_prefix'] ) );
            }

            // Land Area Size
            if( isset( $_POST['prop_land_area'] ) ) {
                update_post_meta( $prop_id, 'fave_property_land', sanitize_text_field( $_POST['prop_land_area'] ) );
            }

            // Land Area Size Prefix
            if( isset( $_POST['prop_land_area_prefix'] ) ) {
                update_post_meta( $prop_id, 'fave_property_land_postfix', sanitize_text_field( $_POST['prop_land_area_prefix'] ) );
            }

            // Bedrooms
            if( isset( $_POST['prop_beds'] ) ) {
                update_post_meta( $prop_id, 'fave_property_bedrooms', sanitize_text_field( $_POST['prop_beds'] ) );
            }

            // Bathrooms
            if( isset( $_POST['prop_baths'] ) ) {
                update_post_meta( $prop_id, 'fave_property_bathrooms', sanitize_text_field( $_POST['prop_baths'] ) );
            }

            // Garages
            if( isset( $_POST['prop_garage'] ) ) {
                update_post_meta( $prop_id, 'fave_property_garage', sanitize_text_field( $_POST['prop_garage'] ) );
            }

            // Garages Size
            if( isset( $_POST['prop_garage_size'] ) ) {
                update_post_meta( $prop_id, 'fave_property_garage_size', sanitize_text_field( $_POST['prop_garage_size'] ) );
            }

            // Year Built
            if( isset( $_POST['prop_year_built'] ) ) {
                update_post_meta( $prop_id, 'fave_property_year', sanitize_text_field( $_POST['prop_year_built'] ) );
            }

            // Property ID
            $auto_property_id = houzez_option('auto_property_id');
            if( $auto_property_id != 1 ) {
                if (isset($_POST['property_id'])) {
                    update_post_meta($prop_id, 'fave_property_id', sanitize_text_field($_POST['property_id']));
                }
            } else {
                    update_post_meta($prop_id, 'fave_property_id', $prop_id );
            }

            // Property Video Url
            if( isset( $_POST['prop_video_url'] ) ) {
                update_post_meta( $prop_id, 'fave_video_url', sanitize_text_field( $_POST['prop_video_url'] ) );
            }

            // property video image - in case of update
            $property_video_image = "";
            $property_video_image_id = 0;
            if( $submission_action == "update_property" ) {
                $property_video_image_id = get_post_meta( $prop_id, 'fave_video_image', true );
                if ( ! empty ( $property_video_image_id ) ) {
                    $property_video_image_src = wp_get_attachment_image_src( $property_video_image_id, 'houzez-property-detail-gallery' );
                    $property_video_image = $property_video_image_src[0];
                }
            }

            // clean up the old meta information related to images when property update
            if( $submission_action == "update_property" ){
                delete_post_meta( $prop_id, 'fave_property_images' );
                delete_post_meta( $prop_id, '_thumbnail_id' );
            }

            // Property Images
            if( isset( $_POST['propperty_image_ids'] ) ) {
                if (!empty($_POST['propperty_image_ids']) && is_array($_POST['propperty_image_ids'])) {
                    $property_image_ids = array();
                    foreach ($_POST['propperty_image_ids'] as $prop_img_id ) {
                        $property_image_ids[] = intval( $prop_img_id );
                        add_post_meta($prop_id, 'fave_property_images', $prop_img_id);
                    }

                    // featured image
                    if( isset( $_POST['featured_image_id'] ) ) {
                        $featured_image_id = intval( $_POST['featured_image_id'] );
                        if( in_array( $featured_image_id, $property_image_ids ) ) {
                            update_post_meta( $prop_id, '_thumbnail_id', $featured_image_id );

                            /* if video url is provided but there is no video image then use featured image as video image */
                            if ( empty( $property_video_image ) && !empty( $_POST['prop_video_url'] ) ) {
                                update_post_meta( $prop_id, 'fave_video_image', $featured_image_id );
                            }
                        }
                    } elseif ( ! empty ( $property_image_ids ) ) {
                        update_post_meta( $prop_id, '_thumbnail_id', $property_image_ids[0] );
                    }
                }
            }

            // Add property type
            if( isset( $_POST['prop_type'] ) && ( $_POST['prop_type'] != '-1' ) ) {
                wp_set_object_terms( $prop_id, intval( $_POST['prop_type'] ), 'property_type' );
            }

            // Add property status
            if( isset( $_POST['prop_status'] ) && ( $_POST['prop_status'] != '-1' ) ) {
                wp_set_object_terms( $prop_id, intval( $_POST['prop_status'] ), 'property_status' );
            }

            // Add property status
            if( isset( $_POST['prop_labels'] ) && ( $_POST['prop_labels'] != '-1' ) ) {
                wp_set_object_terms( $prop_id, intval( $_POST['prop_labels'] ), 'property_label' );
            }

            // Add property city
            if( isset( $_POST['locality'] ) ) {
                $property_city = sanitize_text_field( $_POST['locality'] );
                $city_id = wp_set_object_terms( $prop_id, $property_city, 'property_city' );

                $houzez_meta = array();
                $houzez_meta['parent_state'] = isset( $_POST['administrative_area_level_1'] ) ? $_POST['administrative_area_level_1'] : '';
                if( !empty( $city_id) ) {
                    update_option('_houzez_property_city_' . $city_id[0], $houzez_meta);
                }
            }

            // Add property area
            if( isset( $_POST['neighborhood'] ) ) {
                $property_area = sanitize_text_field( $_POST['neighborhood'] );
                $area_id = wp_set_object_terms( $prop_id, $property_area, 'property_area' );

                $houzez_meta = array();
                $houzez_meta['parent_city'] = isset( $_POST['locality'] ) ? $_POST['locality'] : '';
                if( !empty( $area_id) ) {
                    update_option('_houzez_property_area_' . $area_id[0], $houzez_meta);
                }
            }

            // Add property state
            if( isset( $_POST['administrative_area_level_1'] ) ) {
                $property_state = sanitize_text_field( $_POST['administrative_area_level_1'] );
                $state_id = wp_set_object_terms( $prop_id, $property_state, 'property_state' );

                $houzez_meta = array();
                $houzez_meta['parent_country'] = isset( $_POST['country_short'] ) ? $_POST['country_short'] : '';
                if( !empty( $state_id) ) {
                    update_option('_houzez_property_state_' . $state_id[0], $houzez_meta);
                }
            }

            //echo $_POST['country_short'].' '.$_POST['administrative_area_level_1'].' '.$_POST['locality'].' '.$_POST['neighborhood']; die;
           
            // Add property features
            if( isset( $_POST['prop_features'] ) ) {
                $features_array = array();
                foreach( $_POST['prop_features'] as $feature_id ) {
                    $features_array[] = intval( $feature_id );
                }
                wp_set_object_terms( $prop_id, $features_array, 'property_feature' );
            }

            // additional details
            if( isset( $_POST['additional_features'] ) ) {
                $additional_features = $_POST['additional_features'];
                if( ! empty( $additional_features ) ) {
                    update_post_meta( $prop_id, 'additional_features', $additional_features );
                    update_post_meta( $prop_id, 'fave_additional_features_enable', 'enable' );
                }
            }

            //Floor Plans
            if( isset( $_POST['floorPlans_enable'] ) ) {
                $floorPlans_enable = $_POST['floorPlans_enable'];
                if( ! empty( $floorPlans_enable ) ) {
                    update_post_meta( $prop_id, 'fave_floor_plans_enable', $floorPlans_enable );
                }
            }

            if( isset( $_POST['floor_plans'] ) ) {
                $floor_plans_post = $_POST['floor_plans'];
                if( ! empty( $floor_plans_post ) ) {
                    update_post_meta( $prop_id, 'floor_plans', $floor_plans_post );
                }
            }

            //Multi-units / Sub-properties
            if( isset( $_POST['multiUnits'] ) ) {
                $multiUnits_enable = $_POST['multiUnits'];
                if( ! empty( $multiUnits_enable ) ) {
                    update_post_meta( $prop_id, 'fave_multiunit_plans_enable', $multiUnits_enable );
                }
            }

            if( isset( $_POST['fave_multi_units'] ) ) {
                $fave_multi_units = $_POST['fave_multi_units'];
                if( ! empty( $fave_multi_units ) ) {
                    update_post_meta( $prop_id, 'fave_multi_units', $fave_multi_units );
                }
            }

            // Make featured
            if( isset( $_POST['prop_featured'] ) ) {
                $featured = intval( $_POST['prop_featured'] );
                update_post_meta( $prop_id, 'fave_featured', $featured );
            }

            // Property Payment
            if( isset( $_POST['prop_payment'] ) ) {
                $prop_payment = sanitize_text_field( $_POST['prop_payment'] );
                update_post_meta( $prop_id, 'fave_payment_status', $prop_payment );
            }

            // Property Agent
            if( isset( $_POST['fave_agent_display_option'] ) ) {

                $prop_agent_display_option = sanitize_text_field( $_POST['fave_agent_display_option'] );
                if( $prop_agent_display_option == 'agent_info' ) {

                    $prop_agent = sanitize_text_field( $_POST['fave_agents'] );
                    update_post_meta( $prop_id, 'fave_agent_display_option', $prop_agent_display_option );
                    update_post_meta( $prop_id, 'fave_agents', $prop_agent );

                } else {
                    update_post_meta( $prop_id, 'fave_agent_display_option', $prop_agent_display_option );
                }

            } else {
                update_post_meta( $prop_id, 'fave_agent_display_option', 'author_info' );
            }

            // Address
            if( isset( $_POST['property_map_address'] ) ) {
                update_post_meta( $prop_id, 'fave_property_map_address', sanitize_text_field( $_POST['property_map_address'] ) );
                update_post_meta( $prop_id, 'fave_property_address', sanitize_text_field( $_POST['property_map_address'] ) );
            }

            if( ( isset($_POST['lat']) && !empty($_POST['lat']) ) && (  isset($_POST['lng']) && !empty($_POST['lng'])  ) ) {
                $lat = sanitize_text_field( $_POST['lat'] );
                $lng = sanitize_text_field( $_POST['lng'] );
                $streetView = sanitize_text_field( $_POST['prop_google_street_view'] );
                $lat_lng = $lat.','.$lng;

                update_post_meta( $prop_id, 'houzez_geolocation_lat', $lat );
                update_post_meta( $prop_id, 'houzez_geolocation_long', $lng );
                update_post_meta( $prop_id, 'fave_property_location', $lat_lng );
                update_post_meta( $prop_id, 'fave_property_map', '1' );
                update_post_meta( $prop_id, 'fave_property_map_street_view', $streetView );

            }
            // Country
            if( isset( $_POST['country_short'] ) ) {
                update_post_meta( $prop_id, 'fave_property_country', sanitize_text_field( $_POST['country_short'] ) );
            }
            // Postal Code
            if( isset( $_POST['postal_code'] ) ) {
                update_post_meta( $prop_id, 'fave_property_zip', sanitize_text_field( $_POST['postal_code'] ) );
            }

        return $prop_id;
        }
    }
}

if( !function_exists('houzez_update_property_from_draft') ) {
    function houzez_update_property_from_draft( $property_id ) {
        $listings_admin_approved = houzez_option('listings_admin_approved');

        if( $listings_admin_approved != 'yes' ) {
            $prop_status = 'publish';
        } else {
            $prop_status = 'pending';
        }

        $updated_property = array(
            'ID' => $property_id,
            'post_type'	=> 'property',
            'post_status' => $prop_status
        );
        $prop_id = wp_update_post( $updated_property );
    }
}

/*-----------------------------------------------------------------------------------*/
// validate Email
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_houzez_check_email', 'houzez_check_email');
add_action('wp_ajax_nopriv_houzez_check_email', 'houzez_check_email');

if( !function_exists('houzez_check_email') ) {
    function houzez_check_email() {
        $allowed_html = array();
        $email = wp_kses( $_POST['useremail'], $allowed_html );

        if( email_exists( $email ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('This email address is already registered.', 'houzez') ) );
            wp_die();
        
        } elseif( !is_email( $email ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('Invalid email address.', 'houzez') ) );
            wp_die();
        } else {
            echo json_encode( array( 'success' => true, 'msg' => esc_html__('Successfull', 'houzez') ) );
            wp_die();
        }

        wp_die();
    }
}

/*-----------------------------------------------------------------------------------*/
// Add custom post status Expired
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists('houzez_custom_post_status') ) {
    function houzez_custom_post_status() {

        $args = array(
            'label'                     => _x( 'Expired', 'Status General Name', 'houzez' ),
            'label_count'               => _n_noop( 'Expired (%s)',  'Expired (%s)', 'houzez' ),
            'public'                    => true,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
            'exclude_from_search'       => false,
        );
        register_post_status( 'expired', $args );

    }
    add_action( 'init', 'houzez_custom_post_status', 1 );
}

add_action( 'wp_ajax_houzez_save_search', 'houzez_save_search' );
if( !function_exists('houzez_save_search') ) {
    function houzez_save_search() {

        $nonce = $_REQUEST['houzez_save_search_ajax'];
        if( !wp_verify_nonce( $nonce, 'houzez-save-search-nounce' ) ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__( 'Unverified Nonce!', 'houzez')
            ));
            wp_die();
        }

        global $wpdb, $current_user;

        wp_get_current_user();
        $userID       =  $current_user->ID;
        $userEmail    =  $current_user->user_email;
        $search_args  =  $_REQUEST['search_args'];
        $table_name   = $wpdb->prefix . 'houzez_search';
        $request_url  = $_REQUEST['search_URI'];

        $wpdb->insert(
            $table_name,
            array(
                'auther_id' => $userID,
                'query'     => $search_args,
                'email'     => $userEmail,
                'url'       => $request_url,
                'time'      => current_time( 'mysql' )
            ),
            array(
                '%d',
                '%s',
                '%s',
                '%s',
                '%s'
            )
        );

        echo json_encode( array( 'success' => true, 'msg' => esc_html__('Search is saved. You will receive an email notification when new properties matching your search will be published', 'houzez') ) );
        wp_die();
    }
}

/*-----------------------------------------------------------------------------------*/
/*     Remove Search
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_houzez_delete_search', 'houzez_delete_search');
if(!function_exists('houzez_delete_search') ) {
    function houzez_delete_search () {
        global $current_user;
        wp_get_current_user();
        $userID = $current_user->ID;

        $property_id = intval( $_POST['property_id']);

        if( !is_numeric( $property_id ) ){
            echo json_encode( array(
                'success' => false,
                'msg' => esc_html__('you don\'t have the right to delete this', 'houzez')
            ));
            wp_die();
        }else{

            global $wpdb;

            $table_name     = $wpdb->prefix . 'houzez_search';
            $results        = $wpdb->get_row( 'SELECT * FROM ' . $table_name . ' WHERE id = ' . $property_id );
            if ( $userID != $results->auther_id ) :

                echo json_encode( array(
                    'success' => false,
                    'msg' => esc_html__('you don\'t have the right to delete this', 'houzez')
                ));

                wp_die();

            else :

                $wpdb->delete( $table_name, array( 'id' => $property_id ), array( '%d' ) );

                echo json_encode( array(
                    'success' => true,
                    'msg' => esc_html__('Deleted Successfully', 'houzez')
                ));

                wp_die();

            endif;
        }
    }
}


/*-----------------------------------------------------------------------------------*/
// Property paypal payment
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_houzez_property_paypal_payment', 'houzez_property_paypal_payment');
if( !function_exists('houzez_property_paypal_payment') ) {
    function houzez_property_paypal_payment() {
        global $current_user;
        $propID        =   intval($_POST['prop_id']);
        $is_prop_featured   =   intval($_POST['is_prop_featured']);
        $is_prop_upgrade    =   intval($_POST['is_prop_upgrade']);
        $price_per_submission = houzez_option('price_listing_submission');
        $price_featured_submission = houzez_option('price_featured_listing_submission');
        $currency = houzez_option('currency_paid_submission');

        $blogInfo = esc_url( home_url() );

        wp_get_current_user();
        $userID =   $current_user->ID;
        $post   =   get_post($propID);

        if( $post->post_author != $userID ){
            wp_die('Are you kidding?');
        }

        $is_paypal_live             =   houzez_option('paypal_api');
        $host                       =   'https://api.sandbox.paypal.com';
        $price_per_submission       =   floatval( $price_per_submission );
        $price_featured_submission  =   floatval( $price_featured_submission );
        $submission_curency         =   esc_html( $currency );
        $payment_description        =   esc_html__('Listing payment on ','houzez').$blogInfo;

        if( $is_prop_featured == 0 ) {
            $total_price =  number_format( $price_per_submission, 2, '.','' );
        } else {
            $total_price = $price_per_submission + $price_featured_submission;
            $total_price = number_format( $total_price, 2, '.','' );
        }

        if ( $is_prop_upgrade == 1 ) {
            $total_price     =  number_format($price_featured_submission, 2, '.','');
            $payment_description =   esc_html__('Upgrade to featured listing on ','houzez').$blogInfo;
        }

        // Check if payal live
        if( $is_paypal_live =='live'){
            $host='https://api.paypal.com';
        }

        $url             =   $host.'/v1/oauth2/token';
        $postArgs        =   'grant_type=client_credentials';

        // Get Access token
        $paypal_token    =   houzez_get_paypal_access_token( $url, $postArgs );
        $url             =   $host.'/v1/payments/payment';
        $cancel_link     =   houzez_dashboard_listings();
        $return_link     =   houzez_get_template_link('template/template-thankyou.php');

        $payment = array(
            'intent' => 'sale',
            "redirect_urls" => array(
                "return_url" => $return_link,
                "cancel_url" => $cancel_link
            ),
            'payer' => array("payment_method" => "paypal"),
        );

        /* Prepare basic payment details
        *--------------------------------------*/
        $payment['transactions'][0] = array(
            'amount' => array(
                'total' => $total_price,
                'currency' => $submission_curency,
                'details' => array(
                    'subtotal' => $total_price,
                    'tax' => '0.00',
                    'shipping' => '0.00'
                )
            ),
            'description' => $payment_description
        );


        /* Prepare individual items
        *--------------------------------------*/
        if( $is_prop_upgrade == 1 ) {

            $payment['transactions'][0]['item_list']['items'][] = array(
                'quantity' => '1',
                'name' => esc_html__('Upgrade to Featured Listing','houzez'),
                'price' => $total_price,
                'currency' => $submission_curency,
                'sku' => 'Upgrade Listing',
            );

        } else {
            if( $is_prop_featured == 1 ) {

                $payment['transactions'][0]['item_list']['items'][] = array(
                    'quantity' => '1',
                    'name' => esc_html__('Listing with Featured Payment option','houzez'),
                    'price' => $total_price,
                    'currency' => $submission_curency,
                    'sku' => 'Featured Paid Listing',
                );

            } else {
                $payment['transactions'][0]['item_list']['items'][] = array(
                    'quantity' => '1',
                    'name' => esc_html__('Listing Payment','houzez'),
                    'price' => $total_price,
                    'currency' => $submission_curency,
                    'sku' => 'Paid Listing',
                );
            }
        }

        /* Convert PHP array into json format
        *--------------------------------------*/
        $jsonEncode = json_encode($payment);
        $json_response = houzez_execute_paypal_request( $url, $jsonEncode, $paypal_token );

        //print_r($json_response);
        foreach ($json_response['links'] as $link) {
            if($link['rel'] == 'execute'){
                $payment_execute_url = $link['href'];
            } else  if($link['rel'] == 'approval_url'){
                $payment_approval_url = $link['href'];
            }
        }

        // Save data in database for further use on processor page
        $output['payment_execute_url'] = $payment_execute_url;
        $output['paypal_token']        = $paypal_token;
        $output['property_id']         = $propID;
        $output['is_prop_featured']    = $is_prop_featured;
        $output['is_prop_upgrade']     = $is_prop_upgrade;

        $save_output[$current_user->ID]   =   $output;
        update_option('houzez_paypal_transfer',$save_output);

        print $payment_approval_url;

        wp_die();

    }
}


/* -----------------------------------------------------------------------------------------------------------
 *  Resend Property for Approval per listing
 -------------------------------------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_resend_for_approval_perlisting', 'houzez_resend_for_approval_perlisting' );
add_action( 'wp_ajax_houzez_resend_for_approval_perlisting', 'houzez_resend_for_approval_perlisting' );

if( !function_exists('houzez_resend_for_approval_perlisting') ):

    function houzez_resend_for_approval_perlisting() {

        global $current_user;
        $prop_id = intval($_POST['propid']);

        wp_get_current_user();
        $userID = $current_user->ID;
        $post   = get_post($prop_id);

        if( $post->post_author != $userID){
            wp_die('get out of my cloud');
        }

        $prop = array(
            'ID'            => $prop_id,
            'post_type'     => 'property',
            'post_status'   => 'pending',
            'post_date'     => current_time( 'mysql' ),
            'post_date_gmt'     => current_time( 'mysql' ),
        );
        wp_update_post( $prop );
        update_post_meta( $prop_id, 'fave_featured', 0 );
        update_post_meta( $prop_id, 'fave_payment_status', 'not_paid' );

        echo json_encode( array( 'success' => true, 'msg' => esc_html__('Sent for approval','houzez') ) );

        $submit_title =   get_the_title( $prop_id) ;

        $args = array(
            'submission_title' =>  $submit_title,
            'submission_url'   =>  get_permalink( $prop_id )
        );
        houzez_email_type( get_option('admin_email'), 'admin_expired_listings', $args );

        wp_die();



    }

endif; // end

/*-----------------------------------------------------------------------------------*/
// Simple property filter
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_property_filter') ) {
    function houzez_property_filter( $property_query_args ) {
        global $paged;

        $page_id = get_the_ID();
        $fave_featured_listing = get_post_meta( $page_id, 'fave_featured_listing', true );
        $fave_prop_no = get_post_meta( $page_id, 'fave_prop_no', true );
        $fave_listings_tabs = get_post_meta( $page_id, 'fave_listings_tabs', true );

        $tax_query = array();
        $meta_query = array();

        if ( is_front_page()  ) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        if(!$fave_prop_no){
            $property_query_args[ 'posts_per_page' ]  = 9;
        } else {
            $property_query_args[ 'posts_per_page' ] = $fave_prop_no;
        }

        if (!empty($paged)) {
            $property_query_args['paged'] = $paged;
        } else {
            $property_query_args['paged'] = 1;
        }

        if( $fave_featured_listing != 'disable' ) {
            $meta_query[] = array(
                'key' => 'fave_featured',
                'value' => '0',
                'compare' => '='
            );
            $property_query_args['meta_query'] = $meta_query;
        }

        if ( isset( $_GET['tab'] ) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_status',
                'field' => 'slug',
                'terms' => $_GET['tab']
            );
        }

        $locations = get_post_meta( $page_id, 'fave_locations', false );
        if ( ! empty( $locations ) && is_array( $locations ) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_city',
                'field' => 'slug',
                'terms' => $locations
            );
        }

        $types = get_post_meta( $page_id, 'fave_types', false );
        if ( ! empty( $types ) && is_array( $types ) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_type',
                'field' => 'slug',
                'terms' => $types
            );
        }

        $features = get_post_meta( $page_id, 'fave_features', false );
        if ( ! empty( $features ) && is_array( $features ) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_feature',
                'field' => 'slug',
                'terms' => $features
            );
        }

        if( $fave_listings_tabs != 'enable' ) {
            $status = get_post_meta($page_id, 'fave_status', false);
            if (!empty($status) && is_array($status)) {
                $tax_query[] = array(
                    'taxonomy' => 'property_status',
                    'field' => 'slug',
                    'terms' => $status
                );
            }
        }


        $tax_count = count( $tax_query );
        if( $tax_count > 1 ) {
            $tax_query['relation'] = 'AND';
        }
        if( $tax_count > 0 ) {
            $property_query_args['tax_query'] = $tax_query;
        }

        return $property_query_args;
    }
}
add_filter('houzez_property_filter', 'houzez_property_filter');

/*-----------------------------------------------------------------------------------*/
// Featured property filter
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_featured_property_filter') ) {
    function houzez_featured_property_filter( $property_query_args ) {
        global $paged;

        $page_id = get_the_ID();
        $fave_featured_prop_no = get_post_meta( $page_id, 'fave_featured_prop_no', true );
        $fave_listings_tabs = get_post_meta( $page_id, 'fave_listings_tabs', true );

        $tax_query = array();

        if ( is_front_page()  ) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        if(!$fave_featured_prop_no){
            $property_query_args[ 'posts_per_page' ]  = 4;
        } else {
            $property_query_args[ 'posts_per_page' ] = $fave_featured_prop_no;
        }

        if (!empty($paged)) {
            $property_query_args['paged'] = $paged;
        } else {
            $property_query_args['paged'] = 1;
        }

        $featured_meta_query[] = array(
            'key' => 'fave_featured',
            'value' => '1',
            'compare' => '='
        );
        $property_query_args['meta_query'] = $featured_meta_query;

        if ( isset( $_GET['tab'] ) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_status',
                'field' => 'slug',
                'terms' => $_GET['tab']
            );
        }

        $locations = get_post_meta( $page_id, 'fave_locations', false );
        if ( ! empty( $locations ) && is_array( $locations ) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_city',
                'field' => 'slug',
                'terms' => $locations
            );
        }

        $types = get_post_meta( $page_id, 'fave_types', false );
        if ( ! empty( $types ) && is_array( $types ) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_type',
                'field' => 'slug',
                'terms' => $types
            );
        }

        $features = get_post_meta( $page_id, 'fave_features', false );
        if ( ! empty( $features ) && is_array( $features ) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_feature',
                'field' => 'slug',
                'terms' => $features
            );
        }

        if( $fave_listings_tabs != 'enable' ) {
            $status = get_post_meta($page_id, 'fave_status', false);
            if (!empty($status) && is_array($status)) {
                $tax_query[] = array(
                    'taxonomy' => 'property_status',
                    'field' => 'slug',
                    'terms' => $status
                );
            }
        }


        $tax_count = count( $tax_query );
        if( $tax_count > 1 ) {
            $tax_query['relation'] = 'AND';
        }
        if( $tax_count > 0 ) {
            $property_query_args['tax_query'] = $tax_query;
        }

        return $property_query_args;
    }
}
add_filter('houzez_featured_property_filter', 'houzez_featured_property_filter');


/*-----------------------------------------------------------------------------------*/
// Search Radius filter
/*-----------------------------------------------------------------------------------*/
add_filter('houzez_radius_filter', 'houzez_radius_filter_callback', 10, 6);
if( !function_exists('houzez_radius_filter_callback') ) {
    function houzez_radius_filter_callback( $query_args, $search_lat, $search_long, $search_radius, $use_radius, $location ) {

        global $wpdb;

        if ( ! ( $use_radius && $search_lat && $search_long && $search_radius ) || ! $location ) {
            return $query_args;
        }

        $radius_unit = houzez_option('radius_unit');
        if( $radius_unit == 'km' ) {
            $earth_radius = 6371;
        } elseif ( $radius_unit == 'mi' ) {
            $earth_radius = 3959;
        } else {
            $earth_radius = 6371;
        }

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
					AND latitude.meta_key='houzez_geolocation_lat'
					AND longitude.meta_key='houzez_geolocation_long'
				HAVING distance < %s
				ORDER BY $wpdb->posts.menu_order ASC, distance ASC",
            $earth_radius,
            $search_lat,
            $search_long,
            $search_lat,
            $search_radius
        );
        $post_ids = $wpdb->get_results( $sql, OBJECT_K );

        if ( empty( $post_ids ) || ! $post_ids ) {
            $post_ids = array(0);
        }

        $query_args[ 'post__in' ] = array_keys( (array) $post_ids );
        return $query_args;
    }
}

/*-----------------------------------------------------------------------------------*/
// Properties search 2
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_property_search_2') ) {
    function houzez_property_search_2( $search_query ) {

        $tax_query = array();
        $meta_query = array();
        $allowed_html = array();
        $keyword_array =  '';

        $keyword_field = houzez_option('keyword_field');

        $search_location = isset( $_GET[ 'search_location' ] ) ? esc_attr( $_GET[ 'search_location' ] ) : false;
        $use_radius = 'on';
        $search_lat = isset($_GET['lat']) ? (float) $_GET['lat'] : false;
        $search_long = isset($_GET['lng']) ? (float) $_GET['lng'] : false;
        $search_radius = isset($_GET['radius']) ? (int) $_GET['radius'] : false;

        $search_query = apply_filters( 'houzez_radius_filter', $search_query, $search_lat, $search_long, $search_radius, $use_radius, $search_location );

        if ( isset($_GET['keyword']) && $_GET['keyword']!='') {
            if( $keyword_field == 'prop_address' ) {
                $meta_keywork = esc_html(wp_kses($_GET['keyword'], $allowed_html));
                $address_array = array(
                    'key' => 'fave_property_map_address',
                    'value' => $meta_keywork,
                    'type' => 'CHAR',
                    'compare' => 'LIKE',
                );

                $street_array = array(
                    'key' => 'fave_property_address',
                    'value' => $meta_keywork,
                    'type' => 'CHAR',
                    'compare' => 'LIKE',
                );

                $zip_array = array(
                    'key' => 'fave_property_zip',
                    'value' => $meta_keywork,
                    'type' => 'CHAR',
                    'compare' => '=',
                );

                $propid_array = array(
                    'key' => 'fave_property_id',
                    'value' => $meta_keywork,
                    'type' => 'CHAR',
                    'compare' => '=',
                );

                $keyword_array = array(
                    'relation' => 'OR',
                    $address_array,
                    $street_array,
                    $propid_array,
                    $zip_array
                );

            } else if( $keyword_field == 'prop_city_state_county' ) {
                $taxlocation[] = sanitize_title (  esc_html( wp_kses($_GET['keyword'], $allowed_html) ) );
                $tax_query[] = array(
                    'taxonomy'     => 'property_area',
                    'field'        => 'slug',
                    'terms'        => $taxlocation
                );

                $tax_query[] = array(
                    'taxonomy'     => 'property_city',
                    'field'        => 'slug',
                    'terms'        => $taxlocation
                );

                $tax_query[] = array(
                    'taxonomy'      => 'property_state',
                    'field'         => 'slug',
                    'terms'         => $taxlocation
                );

            } else {
                $keyword = trim( $_GET['keyword'] );
                if ( ! empty( $keyword ) ) {
                    $search_query['s'] = $keyword;
                }
            }
        }

        // bedrooms logic
        if( isset( $_GET['bedrooms'] ) && !empty( $_GET['bedrooms'] ) && $_GET['bedrooms'] != 'any'  ) {
            $bedrooms = sanitize_text_field($_GET['bedrooms']);
            $meta_query[] = array(
                'key' => 'fave_property_bedrooms',
                'value'   => $bedrooms,
                'type'    => 'CHAR',
                'compare' => '=',
            );
        }

        // Property ID
        if( isset( $_GET['propid'] ) && !empty( $_GET['propid'] )  ) {
            $propid = sanitize_text_field($_GET['propid']);
            $meta_query[] = array(
                'key' => 'fave_property_id',
                'value'   => $propid,
                'type'    => 'char',
                'compare' => '=',
            );
        }

        // bathrooms logic
        if( isset( $_GET['bathrooms'] ) && !empty( $_GET['bathrooms'] ) && $_GET['bathrooms'] != 'any'  ) {
            $bathrooms = sanitize_text_field($_GET['bathrooms']);
            $meta_query[] = array(
                'key' => 'fave_property_bathrooms',
                'value'   => $bathrooms,
                'type'    => 'CHAR',
                'compare' => '=',
            );
        }

        // min and max price logic
        if( isset( $_GET['min-price'] ) && !empty( $_GET['min-price'] ) && $_GET['min-price'] != 'any' && isset( $_GET['max-price'] ) && !empty( $_GET['max-price'] ) && $_GET['max-price'] != 'any' ) {
            $min_price = doubleval( houzez_clean( $_GET['min-price'] ) );
            $max_price = doubleval( houzez_clean( $_GET['max-price'] ) );

            if( $min_price >= 0 && $max_price > $min_price ) {
                $meta_query[] = array(
                    'key' => 'fave_property_price',
                    'value' => array($min_price, $max_price),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            }
        } else if( isset( $_GET['min-price'] ) && !empty( $_GET['min-price'] ) && $_GET['min-price'] != 'any'  ) {
            $min_price = doubleval( houzez_clean( $_GET['min-price'] ) );
            if( $min_price >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_price',
                    'value' => $min_price,
                    'type' => 'NUMERIC',
                    'compare' => '>=',
                );
            }
        } else if( isset( $_GET['max-price'] ) && !empty( $_GET['max-price'] ) && $_GET['max-price'] != 'any'  ) {
            $max_price = doubleval( houzez_clean( $_GET['max-price'] ) );
            if( $max_price >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_price',
                    'value' => $max_price,
                    'type' => 'NUMERIC',
                    'compare' => '<=',
                );
            }
        }


        // min and max area logic
        if( isset( $_GET['min-area'] ) && !empty( $_GET['min-area'] ) && isset( $_GET['max-area'] ) && !empty( $_GET['max-area'] ) ) {
            $min_area = intval( $_GET['min-area'] );
            $max_area = intval( $_GET['max-area'] );

            if( $min_area >= 0 && $max_area > $min_area ) {
                $meta_query[] = array(
                    'key' => 'fave_property_size',
                    'value' => array($min_area, $max_area),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            }

        } else if( isset( $_GET['max-area'] ) && !empty( $_GET['max-area'] ) ) {
            $max_area = intval( $_GET['max-area'] );
            if( $max_area >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_size',
                    'value' => $max_area,
                    'type' => 'NUMERIC',
                    'compare' => '<=',
                );
            }
        } else if( isset( $_GET['min-area'] ) && !empty( $_GET['min-area'] ) ) {
            $min_area = intval( $_GET['min-area'] );
            if( $min_area >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_size',
                    'value' => $min_area,
                    'type' => 'NUMERIC',
                    'compare' => '>=',
                );
            }
        }

        //Date Query
        $publish_date = isset( $_GET['publish_date'] ) ? $_GET['publish_date'] : '';
        if( !empty($publish_date) ) {
            $publish_date = explode('-', $publish_date);
            $search_query['date_query'] = array(
                array(
                    'year' => $publish_date[0],
                    'compare'   => '=',
                ),
                array(
                    'month' => $publish_date[1],
                    'compare'   => '=',
                ),
                array(
                    'day' => $publish_date[2],
                    'compare'   => '>=',
                )
            );
        }


        // Taxonomies
        if( isset( $_GET['status'] ) && !empty( $_GET['status'] ) && $_GET['status'] != 'all' ) {
            $tax_query[] = array(
                'taxonomy' => 'property_status',
                'field'    => 'slug',
                'terms'     => $_GET['status']
            );
        }

        if( isset( $_GET['type'] ) && !empty( $_GET['type'] ) && $_GET['type'] != 'all'  ) {
            $tax_query[] = array(
                'taxonomy' => 'property_type',
                'field'    => 'slug',
                'terms'     => $_GET['type']
            );
        }

        if( isset( $_GET['country'] ) && !empty( $_GET['country'] ) && $_GET['country'] != 'all'  ) {
            $meta_query[] = array(
                'key' => 'fave_property_country',
                'value'   => $_GET['country'],
                'type'    => 'CHAR',
                'compare' => '=',
            );
        }

        if( isset( $_GET['state'] ) && !empty( $_GET['state'] ) && $_GET['state'] != 'all'  ) {
            $tax_query[] = array(
                'taxonomy' => 'property_state',
                'field'    => 'slug',
                'terms'     => $_GET['state']
            );
        }

        if( isset( $_GET['location'] ) && !empty( $_GET['location'] ) && $_GET['location'] != 'all'  ) {
            $tax_query[] = array(
                'taxonomy' => 'property_city',
                'field'    => 'slug',
                'terms'     => $_GET['location']
            );
        }

        if( isset( $_GET['area'] ) && !empty( $_GET['area'] ) && $_GET['area'] != 'all' ) {
            $tax_query[] = array(
                'taxonomy' => 'property_area',
                'field' => 'slug',
                'terms' => $_GET['area']
            );
        }

        if( isset( $_GET['feature'] ) && !empty( $_GET['feature'] ) ) {
            if( is_array( $_GET['feature'] ) ) {
                $features = $_GET['feature'];

                foreach( $features as $feature ):
                    $tax_query[] = array(
                        'taxonomy' => 'property_feature',
                        'field'    => 'slug',
                        'terms'     => $feature
                    );
                endforeach;
            }
        }

        $meta_count = count($meta_query);

        /*if( $meta_count > 1 ) {
            $meta_query['relation'] = 'AND';
        }*/

        /*if( $meta_count > 0 ) {
            $search_query['meta_query'] = $meta_query;
        }*/
        //if( $meta_count > 0 ) {
            //$search_query['meta_query'] = $keyword_array;
        //}

        if( $meta_count > 0 || !empty($keyword_array)) {
            $search_query['meta_query'] = array(
                'relation' => 'AND',
                $keyword_array,
                array(
                    'relation' => 'AND',
                    $meta_query
                ),
            );
        }

        $tax_count = count($tax_query);

        if( $keyword_field != 'prop_city_state_county' ) {
            if ($tax_count > 1) {
                $tax_query['relation'] = 'AND';
            }
        } else {
            $tax_query['relation'] = 'OR';
        }
        if( $tax_count > 0 ) {
            $search_query['tax_query']  = $tax_query;
        }
        //print_r($search_query);
        return $search_query;
    }
}
add_filter('houzez_search_parameters_2', 'houzez_property_search_2');


/*-----------------------------------------------------------------------------------*/
/*	Get Properties for Header Map
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_header_map_listings', 'houzez_header_map_listings' );
add_action( 'wp_ajax_houzez_header_map_listings', 'houzez_header_map_listings' );
if( !function_exists('houzez_header_map_listings') ) {
    function houzez_header_map_listings() {
        check_ajax_referer('houzez_header_map_ajax_nonce', 'security');

        $meta_query = array();
        $tax_query = array();
        $date_query = array();
        $allowed_html = array();
        $keyword_array =  '';

        $initial_city = isset($_POST['initial_city']) ? $_POST['initial_city'] : '';
        $features = isset($_POST['features']) ? $_POST['features'] : '';
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
        $country = isset($_POST['country']) ? sanitize_text_field($_POST['country']) : '';
        $state = isset($_POST['state']) ? sanitize_text_field($_POST['state']) : '';
        $location = isset($_POST['location']) ? sanitize_text_field($_POST['location']) : '';
        $area = isset($_POST['area']) ? sanitize_text_field($_POST['area']) : '';
        $status = isset($_POST['status']) ? sanitize_text_field($_POST['status']) : '';
        $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
        $bedrooms = isset($_POST['bedrooms']) ? sanitize_text_field($_POST['bedrooms']) : '';
        $bathrooms = isset($_POST['bathrooms']) ? sanitize_text_field($_POST['bathrooms']) : '';
        $min_price = isset($_POST['min_price']) ? sanitize_text_field($_POST['min_price']) : '';
        $max_price = isset($_POST['max_price']) ? sanitize_text_field($_POST['max_price']) : '';
        $min_area = isset($_POST['min_area']) ? sanitize_text_field($_POST['min_area']) : '';
        $max_area = isset($_POST['max_area']) ? sanitize_text_field($_POST['max_area']) : '';
        $publish_date = isset($_POST['publish_date']) ? sanitize_text_field($_POST['publish_date']) : '';

        $search_location = isset( $_POST[ 'search_location' ] ) ? esc_attr( $_POST[ 'search_location' ] ) : false;
        $use_radius = isset( $_POST[ 'use_radius' ] ) && 'on' == $_POST[ 'use_radius' ];
        $search_lat = isset($_POST['search_lat']) ? (float) $_POST['search_lat'] : false;
        $search_long = isset($_POST['search_long']) ? (float) $_POST['search_long'] : false;
        $search_radius = isset($_POST['search_radius']) ? (int) $_POST['search_radius'] : false;


        $prop_locations = array();
        houzez_get_terms_array( 'property_city', $prop_locations );

        $keyword_field = houzez_option('keyword_field');

        $query_args = array(
            'post_type' => 'property',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        );

        $query_args = apply_filters('houzez_radius_filter', $query_args, $search_lat, $search_long, $search_radius, $use_radius, $search_location );

        if ( $keyword != '') {

            if( $keyword_field == 'prop_address' ) {
                $meta_keywork = esc_html(wp_kses($keyword, $allowed_html));
                $address_array = array(
                    'key' => 'fave_property_map_address',
                    'value' => $meta_keywork,
                    'type' => 'CHAR',
                    'compare' => 'LIKE',
                );

                $street_array = array(
                    'key' => 'fave_property_address',
                    'value' => $meta_keywork,
                    'type' => 'CHAR',
                    'compare' => 'LIKE',
                );

                $zip_array = array(
                    'key' => 'fave_property_zip',
                    'value' => $meta_keywork,
                    'type' => 'CHAR',
                    'compare' => '=',
                );
                $propid_array = array(
                    'key' => 'fave_property_id',
                    'value' => $meta_keywork,
                    'type' => 'CHAR',
                    'compare' => '=',
                );

                $keyword_array = array(
                    'relation' => 'OR',
                    $address_array,
                    $street_array,
                    $propid_array,
                    $zip_array
                );
            } else if( $keyword_field == 'prop_city_state_county' ) {
                $taxlocation[] = sanitize_title (  esc_html( wp_kses($keyword, $allowed_html) ) );
                $tax_query[] = array(
                    'taxonomy'     => 'property_area',
                    'field'        => 'slug',
                    'terms'        => $taxlocation
                );

                $tax_query[] = array(
                    'taxonomy'     => 'property_city',
                    'field'        => 'slug',
                    'terms'        => $taxlocation
                );

                $tax_query[] = array(
                    'taxonomy'      => 'property_state',
                    'field'         => 'slug',
                    'terms'         => $taxlocation
                );

            } else {
                $keyword = trim( $keyword );
                if ( ! empty( $keyword ) ) {
                    $query_args['s'] = $keyword;
                }
            }
        }

        //Date Query
        if( !empty($publish_date) ) {
            $publish_date = explode('-', $publish_date);
            $query_args['date_query'] = array(
                array(
                    'year' => $publish_date[0],
                    'compare'   => '=',
                ),
                array(
                    'month' => $publish_date[1],
                    'compare'   => '=',
                ),
                array(
                    'day' => $publish_date[2],
                    'compare'   => '>=',
                )
            );
        }

        // Meta Queries
        $meta_query[] = array(
            'key' => 'fave_property_map_address',
            'compare' => 'EXISTS',
        );

        // Property ID
        /*if( isset( $_GET['propid'] ) && !empty( $_GET['propid'] )  ) {
            $propid = sanitize_text_field($_GET['propid']);
            $meta_query[] = array(
                'key' => 'fave_property_id',
                'value'   => $propid,
                'type'    => 'char',
                'compare' => '=',
            );
        }*/

        if( !empty($location) && $location != 'all' ) {
            $tax_query[] = array(
                'taxonomy' => 'property_city',
                'field' => 'slug',
                'terms' => $location
            );

        } else {
            if( $location == 'all' ) {
                /*$tax_query[] = array(
                    'taxonomy' => 'property_city',
                    'field' => 'slug',
                    'terms' => $prop_locations
                );*/
            } else {
                if (!empty($initial_city)) {
                    $tax_query[] = array(
                        'taxonomy' => 'property_city',
                        'field' => 'slug',
                        'terms' => $initial_city
                    );
                }
            }
        }

        if( !empty($area) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_area',
                'field' => 'slug',
                'terms' => $area
            );
        }
        if( !empty($state) ) {
            $tax_query[] = array(
                'taxonomy'      => 'property_state',
                'field'         => 'slug',
                'terms'         => $state
            );
        }

        if( !empty( $country ) ) {
            $meta_query[] = array(
                'key' => 'fave_property_country',
                'value'   => $country,
                'type'    => 'CHAR',
                'compare' => '=',
            );
        }

        if( !empty($status) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_status',
                'field' => 'slug',
                'terms' => $status
            );
        }
        if( !empty($type) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_type',
                'field' => 'slug',
                'terms' => $type
            );
        }

        if( !empty( $features ) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_feature',
                'field' => 'slug',
                'terms' => $features
            );
        }

        // bedrooms logic
        if( !empty( $bedrooms ) && $bedrooms != 'any'  ) {
            $bedrooms = sanitize_text_field($bedrooms);
            $meta_query[] = array(
                'key' => 'fave_property_bedrooms',
                'value'   => $bedrooms,
                'type'    => 'CHAR',
                'compare' => '=',
            );
        }

        // bathrooms logic
        if( !empty( $bathrooms ) && $bathrooms != 'any'  ) {
            $bathrooms = sanitize_text_field($bathrooms);
            $meta_query[] = array(
                'key' => 'fave_property_bathrooms',
                'value'   => $bathrooms,
                'type'    => 'CHAR',
                'compare' => '=',
            );
        }

        // min and max price logic
        if( !empty( $min_price ) && $min_price != 'any' && !empty( $max_price ) && $max_price != 'any' ) {
            $min_price = doubleval( houzez_clean( $min_price ) );
            $max_price = doubleval( houzez_clean( $max_price ) );

            if( $min_price >= 0 && $max_price > $min_price ) {
                $meta_query[] = array(
                    'key' => 'fave_property_price',
                    'value' => array($min_price, $max_price),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            }
        } else if( !empty( $min_price ) && $min_price != 'any'  ) {
            $min_price = doubleval( houzez_clean( $min_price ) );
            if( $min_price >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_price',
                    'value' => $min_price,
                    'type' => 'NUMERIC',
                    'compare' => '>=',
                );
            }
        } else if( !empty( $max_price ) && $max_price != 'any'  ) {
            $max_price = doubleval( houzez_clean( $max_price ) );
            if( $max_price >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_price',
                    'value' => $max_price,
                    'type' => 'NUMERIC',
                    'compare' => '<=',
                );
            }
        }

        // min and max area logic
        if( !empty( $min_area ) && !empty( $max_area ) ) {
            $min_area = intval( $min_area );
            $max_area = intval( $max_area );

            if( $min_area >= 0 && $max_area > $min_area ) {
                $meta_query[] = array(
                    'key' => 'fave_property_size',
                    'value' => array($min_area, $max_area),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            }

        } else if( !empty( $max_area ) ) {
            $max_area = intval( $max_area );
            if( $max_area >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_size',
                    'value' => $max_area,
                    'type' => 'NUMERIC',
                    'compare' => '<=',
                );
            }
        } else if( !empty( $min_area ) ) {
            $min_area = intval( $min_area );
            if( $min_area >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_size',
                    'value' => $min_area,
                    'type' => 'NUMERIC',
                    'compare' => '>=',
                );
            }
        }

        $meta_count = count($meta_query);

        /*if( $meta_count > 1 ) {
            $meta_query['relation'] = 'AND';
        }
        if( $meta_count > 0 ) {
            $query_args['meta_query'] = $meta_query;
        }*/

        if( $meta_count > 0 || !empty($keyword_array)) {
            $query_args['meta_query'] = array(
                'relation' => 'AND',
                $keyword_array,
                array(
                    'relation' => 'AND',
                    $meta_query
                ),
            );
        }

        $tax_count = count($tax_query);

        if( $keyword_field != 'prop_city_state_county' ) {
            if ($tax_count > 1) {
                $tax_query['relation'] = 'AND';
            }
        } else {
            $tax_query['relation'] = 'OR';
        }

        if( $tax_count > 0 ) {
            $query_args['tax_query']  = $tax_query;
        }

        $query_args = new WP_Query( $query_args );

        $properties = array();

        while( $query_args->have_posts() ): $query_args->the_post();

            $post_id = get_the_ID();
            $property_location = get_post_meta( get_the_ID(),'fave_property_location',true);
            $lat_lng = explode(',', $property_location);
            $prop_images        = get_post_meta( get_the_ID(), 'fave_property_images', false );
            $prop_featured       = get_post_meta( get_the_ID(), 'fave_featured', true );
            $prop_type = wp_get_post_terms( get_the_ID(), 'property_type', array("fields" => "ids") );

            $prop = new stdClass();

            $prop->id = $post_id;
            $prop->title = get_the_title();
            $prop->lat = $lat_lng[0];
            $prop->lng = $lat_lng[1];
            $prop->bedrooms = get_post_meta( get_the_ID(), 'fave_property_bedrooms', true );
            $prop->bathrooms = get_post_meta( get_the_ID(), 'fave_property_bathrooms', true );
            $prop->address = get_post_meta( get_the_ID(), 'fave_property_map_address', true );
            $prop->thumbnail = get_the_post_thumbnail( $post_id, 'houzez-property-thumb-image' );
            $prop->url = get_permalink();
            $prop->prop_meta = houzez_listing_meta_v1();
            $prop->type = houzez_taxonomy_simple('property_type');
            $prop->images_count = count( $prop_images );
            $prop->price = houzez_listing_price_v1();

            foreach( $prop_type as $term_id ) {
                $icon = get_tax_meta( $term_id, 'fave_prop_type_icon');
                $retinaIcon = get_tax_meta( $term_id, 'fave_prop_type_icon_retina');

                if( !empty($icon['src']) ) {
                    $prop->icon = $icon['src'];
                } else {
                    $prop->icon = get_template_directory_uri() . '/images/map/pin-single-family.png';
                }
                if( !empty($retinaIcon['src']) ) {
                    $prop->retinaIcon = $retinaIcon['src'];
                } else {
                    $prop->retinaIcon = get_template_directory_uri() . '/images/map/pin-single-family.png';
                }
            }

            array_push($properties, $prop);

        endwhile;

        wp_reset_postdata();

        if( count($properties) > 0 ) {
            echo json_encode( array( 'getProperties' => true, 'properties' => $properties ) );
            exit();
        } else {
            echo json_encode( array( 'getProperties' => false ) );
            exit();
        }
        die();
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Get Properties for Half Map listings
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_half_map_listings', 'houzez_half_map_listings' );
add_action( 'wp_ajax_houzez_half_map_listings', 'houzez_half_map_listings' );
if( !function_exists('houzez_half_map_listings') ) {
    function houzez_half_map_listings() {
        //check_ajax_referer('houzez_map_ajax_nonce', 'security');
        $meta_query = array();
        $tax_query = array();
        $date_query = array();
        $allowed_html = array();
        $keyword_array =  '';

        $initial_city = isset($_POST['initial_city']) ? $_POST['initial_city'] : '';
        $features = isset($_POST['features']) ? $_POST['features'] : '';
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
        $country = isset($_POST['country']) ? sanitize_text_field($_POST['country']) : '';
        $location = isset($_POST['location']) ? sanitize_text_field($_POST['location']) : '';
        $area = isset($_POST['area']) ? sanitize_text_field($_POST['area']) : '';
        $state = isset($_POST['state']) ? sanitize_text_field($_POST['state']) : '';
        $status = isset($_POST['status']) ? sanitize_text_field($_POST['status']) : '';
        $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
        $bedrooms = isset($_POST['bedrooms']) ? sanitize_text_field($_POST['bedrooms']) : '';
        $bathrooms = isset($_POST['bathrooms']) ? sanitize_text_field($_POST['bathrooms']) : '';
        $min_price = isset($_POST['min_price']) ? sanitize_text_field($_POST['min_price']) : '';
        $max_price = isset($_POST['max_price']) ? sanitize_text_field($_POST['max_price']) : '';
        $min_area = isset($_POST['min_area']) ? sanitize_text_field($_POST['min_area']) : '';
        $max_area = isset($_POST['max_area']) ? sanitize_text_field($_POST['max_area']) : '';
        $publish_date = isset($_POST['publish_date']) ? sanitize_text_field($_POST['publish_date']) : '';
        $keyword_field = houzez_option('keyword_field');

        $search_location = isset( $_POST[ 'search_location' ] ) ? esc_attr( $_POST[ 'search_location' ] ) : false;
        $use_radius = isset( $_POST[ 'use_radius' ] ) && 'on' == $_POST[ 'use_radius' ];
        $search_lat = isset($_POST['search_lat']) ? (float) $_POST['search_lat'] : false;
        $search_long = isset($_POST['search_long']) ? (float) $_POST['search_long'] : false;
        $search_radius = isset($_POST['search_radius']) ? (int) $_POST['search_radius'] : false;

        $prop_locations = array();
        houzez_get_terms_array( 'property_city', $prop_locations );

        $query_args = array(
            'post_type' => 'property',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        );

        $query_args = apply_filters( 'houzez_radius_filter', $query_args, $search_lat, $search_long, $search_radius, $use_radius, $search_location );

        if ( $keyword != '') {
            if( $keyword_field == 'prop_address' ) {
                $meta_keywork = esc_html(wp_kses($keyword, $allowed_html));
                $address_array = array(
                    'key' => 'fave_property_map_address',
                    'value' => $meta_keywork,
                    'type' => 'CHAR',
                    'compare' => 'LIKE',
                );

                $street_array = array(
                    'key' => 'fave_property_address',
                    'value' => $meta_keywork,
                    'type' => 'CHAR',
                    'compare' => 'LIKE',
                );

                $zip_array = array(
                    'key' => 'fave_property_zip',
                    'value' => $meta_keywork,
                    'type' => 'CHAR',
                    'compare' => '=',
                );

                $keyword_array = array(
                    'relation' => 'OR',
                    $address_array,
                    $street_array,
                    $zip_array
                );
            }  else if( $keyword_field == 'prop_city_state_county' ) {
                $taxlocation[] = sanitize_title (  esc_html( wp_kses($keyword, $allowed_html) ) );
                $tax_query[] = array(
                    'taxonomy'     => 'property_area',
                    'field'        => 'slug',
                    'terms'        => $taxlocation
                );

                $tax_query[] = array(
                    'taxonomy'     => 'property_city',
                    'field'        => 'slug',
                    'terms'        => $taxlocation
                );

                $tax_query[] = array(
                    'taxonomy'      => 'property_state',
                    'field'         => 'slug',
                    'terms'         => $taxlocation
                );

            } else {
                $keyword = trim( $keyword );
                if ( ! empty( $keyword ) ) {
                    $query_args['s'] = $keyword;
                }
            }
        }

        //Date Query
        if( !empty($publish_date) ) {
            $publish_date = explode('-', $publish_date);
            $query_args['date_query'] = array(
                array(
                    'year' => $publish_date[0],
                    'compare'   => '=',
                ),
                array(
                    'month' => $publish_date[1],
                    'compare'   => '=',
                ),
                array(
                    'day' => $publish_date[2],
                    'compare'   => '>=',
                )
            );
        }

        // Meta Queries
        $meta_query[] = array(
            'key' => 'fave_property_map_address',
            'compare' => 'EXISTS',
        );

        if( !empty($location) && $location != 'all' ) {
            $tax_query[] = array(
                'taxonomy' => 'property_city',
                'field' => 'slug',
                'terms' => $location
            );

        } else {
            if( $location == 'all' ) {
                /*$tax_query[] = array(
                    'taxonomy' => 'property_city',
                    'field' => 'slug',
                    'terms' => $prop_locations
                );*/
            } else {
                if (!empty($initial_city)) {
                    $tax_query[] = array(
                        'taxonomy' => 'property_city',
                        'field' => 'slug',
                        'terms' => $initial_city
                    );
                }
            }
        }

        // Property ID
        /*if( isset( $_GET['propid'] ) && !empty( $_GET['propid'] )  ) {
            $propid = sanitize_text_field($_GET['propid']);
            $meta_query[] = array(
                'key' => 'fave_property_id',
                'value'   => $propid,
                'type'    => 'char',
                'compare' => '=',
            );
        }*/

        if( !empty($area) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_area',
                'field' => 'slug',
                'terms' => $area
            );
        }

        if( !empty($state) ) {
            $tax_query[] = array(
                'taxonomy'      => 'property_state',
                'field'         => 'slug',
                'terms'         => $state
            );
        }

        if( !empty($status) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_status',
                'field' => 'slug',
                'terms' => $status
            );
        }
        if( !empty( $features ) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_feature',
                'field' => 'slug',
                'terms' => $features
            );
        }
        if( !empty($type) ) {
            $tax_query[] = array(
                'taxonomy' => 'property_type',
                'field' => 'slug',
                'terms' => $type
            );
        }

        if( !empty( $country ) ) {
            $meta_query[] = array(
                'key' => 'fave_property_country',
                'value'   => $country,
                'type'    => 'CHAR',
                'compare' => '=',
            );
        }

        // bedrooms logic
        if( !empty( $bedrooms ) && $bedrooms != 'any'  ) {
            $bedrooms = sanitize_text_field($bedrooms);
            $meta_query[] = array(
                'key' => 'fave_property_bedrooms',
                'value'   => $bedrooms,
                'type'    => 'CHAR',
                'compare' => '=',
            );
        }

        // bathrooms logic
        if( !empty( $bathrooms ) && $bathrooms != 'any'  ) {
            $bathrooms = sanitize_text_field($bathrooms);
            $meta_query[] = array(
                'key' => 'fave_property_bathrooms',
                'value'   => $bathrooms,
                'type'    => 'CHAR',
                'compare' => '=',
            );
        }

        // min and max price logic
        if( !empty( $min_price ) && $min_price != 'any' && !empty( $max_price ) && $max_price != 'any' ) {
            $min_price = doubleval( houzez_clean( $min_price ) );
            $max_price = doubleval( houzez_clean( $max_price ) );

            if( $min_price >= 0 && $max_price > $min_price ) {
                $meta_query[] = array(
                    'key' => 'fave_property_price',
                    'value' => array($min_price, $max_price),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            }
        } else if( !empty( $min_price ) && $min_price != 'any'  ) {
            $min_price = doubleval( houzez_clean( $min_price ) );
            if( $min_price >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_price',
                    'value' => $min_price,
                    'type' => 'NUMERIC',
                    'compare' => '>=',
                );
            }
        } else if( !empty( $max_price ) && $max_price != 'any'  ) {
            $max_price = doubleval( houzez_clean( $max_price ) );
            if( $max_price >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_price',
                    'value' => $max_price,
                    'type' => 'NUMERIC',
                    'compare' => '<=',
                );
            }
        }

        // min and max area logic
        if( !empty( $min_area ) && !empty( $max_area ) ) {
            $min_area = intval( $min_area );
            $max_area = intval( $max_area );

            if( $min_area >= 0 && $max_area > $min_area ) {
                $meta_query[] = array(
                    'key' => 'fave_property_size',
                    'value' => array($min_area, $max_area),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            }

        } else if( !empty( $max_area ) ) {
            $max_area = intval( $max_area );
            if( $max_area >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_size',
                    'value' => $max_area,
                    'type' => 'NUMERIC',
                    'compare' => '<=',
                );
            }
        } else if( !empty( $min_area ) ) {
            $min_area = intval( $min_area );
            if( $min_area >= 0 ) {
                $meta_query[] = array(
                    'key' => 'fave_property_size',
                    'value' => $min_area,
                    'type' => 'NUMERIC',
                    'compare' => '>=',
                );
            }
        }

        $meta_count = count($meta_query);

        /*if( $meta_count > 1 ) {
            $meta_query['relation'] = 'AND';
        }
        if( $meta_count > 0 ) {
            $query_args['meta_query'] = $meta_query;
        }*/

        if( $meta_count > 0 || !empty($keyword_array)) {
            $query_args['meta_query'] = array(
                'relation' => 'AND',
                $keyword_array,
                array(
                    'relation' => 'AND',
                    $meta_query
                ),
            );
        }

        $tax_count = count($tax_query);

        if( $keyword_field != 'prop_city_state_county' ) {
            if ($tax_count > 1) {
                $tax_query['relation'] = 'AND';
            }
        } else {
            $tax_query['relation'] = 'OR';
        }

        if( $tax_count > 0 ) {
            $query_args['tax_query']  = $tax_query;
        }

        $query_args = new WP_Query( $query_args );

        $properties = array();

        while( $query_args->have_posts() ): $query_args->the_post();

            get_template_part('template-parts/property-for-listing');

        endwhile;

        wp_reset_postdata();

        die();
    }
}


/*-----------------------------------------------------------------------------------*/
// Add to favorite
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_houzez_add_to_favorite', 'houzez_favorites' );
if( !function_exists( 'houzez_favorites' ) ) {
    // a:1:{i:0;i:543;}
    function houzez_favorites () {
        global $current_user;
        wp_get_current_user();
        $userID      =   $current_user->ID;
        $fav_option = 'houzez_favorites-'.$userID;
        $property_id = intval( $_POST['property_id'] );
        $current_prop_fav = get_option( 'houzez_favorites-'.$userID );

        // Check if empty or not
        if( empty( $current_prop_fav ) ) {
            $prop_fav = array();
            $prop_fav['1'] = $property_id;
            update_option( $fav_option, $prop_fav );
            $arr = array( 'added' => true, 'response' => esc_html__('Added', 'houzez') );
            echo json_encode($arr);
            wp_die();
        } else {
            if(  ! in_array ( $property_id, $current_prop_fav )  ) {
                $current_prop_fav[] = $property_id;
                update_option( $fav_option,  $current_prop_fav );
                $arr = array( 'added' => true, 'response' => esc_html__('Added', 'houzez') );
                echo json_encode($arr);
                wp_die();
            } else {
                $key = array_search( $property_id, $current_prop_fav );

                if( $key != false ) {
                    unset( $current_prop_fav[$key] );
                }

                update_option( $fav_option, $current_prop_fav );
                $arr = array( 'added' => false, 'response' => esc_html__('Removed', 'houzez') );
                echo json_encode($arr);
                wp_die();
            }
        }
        wp_die();
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Properties sorting
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'houzez_prop_sort' ) ){

    function houzez_prop_sort( $query_args ) {
        $sort_by = '';

        if ( isset( $_GET['sortby'] ) ) {
            $sort_by = $_GET['sortby'];
        } else {
            if ( is_page_template( array( 'template/property-listing-template.php','template/property-listing-template-style2.php', 'template/property-listing-fullwidth.php', 'template/property-listing-style2-fullwidth.php' ))) {
                $sort_by = get_post_meta( get_the_ID(), 'fave_properties_sort', true );

            } else if( is_page_template( array( 'template/template-search.php' )) ) {
                $sort_by = houzez_option('search_default_order');
            }
        }

        if ( $sort_by == 'a_price' ) {
            $query_args['orderby'] = 'meta_value_num';
            $query_args['meta_key'] = 'fave_property_price';
            $query_args['order'] = 'ASC';
        } else if ( $sort_by == 'd_price' ) {
            $query_args['orderby'] = 'meta_value_num';
            $query_args['meta_key'] = 'fave_property_price';
            $query_args['order'] = 'DESC';
        } else if ( $sort_by == 'featured' ) {
            $query_args['meta_key'] = 'fave_featured';
            $query_args['meta_value'] = '1';
        } else if ( $sort_by == 'a_date' ) {
            $query_args['orderby'] = 'date';
            $query_args['order'] = 'ASC';
        } else if ( $sort_by == 'd_date' ) {
            $query_args['orderby'] = 'date';
            $query_args['order'] = 'DESC';
        }

        return $query_args;
    }
}


/*-----------------------------------------------------------------------------------*/
// Remove property attachments
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_houzez_remove_property_thumbnail', 'houzez_remove_property_thumbnail' );
add_action( 'wp_ajax_nopriv_houzez_remove_property_thumbnail', 'houzez_remove_property_thumbnail' );
if( !function_exists('houzez_remove_property_thumbnail') ) {
    function houzez_remove_property_thumbnail() {

        $nonce = $_POST['removeNonce'];
        if (!wp_verify_nonce($nonce, 'prop_allow_upload')) {
            $json_response = array(
                'post_meta_removed' => false,
                'attachment_remove' => false,
                'reason' => esc_html__('Security Check Fails', 'houzez')
            );
            echo json_encode($json_response);
            wp_die();
        }

        $post_meta_removed = false;
        $attachment_removed = false;

        if (isset($_POST['property_id']) && isset($_POST['thumbnail_id'])) {
            $property_id = intval($_POST['property_id']);
            $attachment_id = intval($_POST['thumbnail_id']);

            if ($property_id > 0 && $attachment_id > 0) {
                $post_meta_removed = delete_post_meta($property_id, 'fave_property_images', $attachment_id);
                $attachment_removed = wp_delete_attachment($attachment_id);
            } elseif ($attachment_id > 0) {
                if( false == wp_delete_attachment( $attachment_id )) {
                    $attachment_removed = false;
                } else {
                    $attachment_removed = true;
                }
            }
        }

        $ajax_response = array(
            'post_meta_removed' => $post_meta_removed,
            'attachment_remove' => $attachment_removed,
        );
        echo json_encode($ajax_response);
        wp_die();

    }
}

/*-----------------------------------------------------------------------------------*/
/*	 Ajax image upload for user profile page
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_houzez_property_img_upload', 'houzez_property_img_upload' );    // only for logged in user
add_action( 'wp_ajax_nopriv_houzez_property_img_upload', 'houzez_property_img_upload' );
if( !function_exists( 'houzez_property_img_upload' ) ) {
    function houzez_property_img_upload( ) {

        // Verify Nonce
        $nonce = $_REQUEST['nonce'];
        if ( ! wp_verify_nonce( $nonce, 'prop_allow_upload' ) ) {
            $ajax_response = array( 'success' => false , 'reason' => 'Security check failed!' );
            echo json_encode( $ajax_response );
            die;
        }

        $submitted_file = $_FILES['property_upload_file'];
        $uploaded_image = wp_handle_upload( $submitted_file, array( 'test_form' => false ) );

        if ( isset( $uploaded_image['file'] ) ) {
            $file_name          =   basename( $submitted_file['name'] );
            $file_type          =   wp_check_filetype( $uploaded_image['file'] );

            // Prepare an array of post data for the attachment.
            $attachment_details = array(
                'guid'           => $uploaded_image['url'],
                'post_mime_type' => $file_type['type'],
                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );

            $attach_id      =   wp_insert_attachment( $attachment_details, $uploaded_image['file'] );
            $attach_data    =   wp_generate_attachment_metadata( $attach_id, $uploaded_image['file'] );
            wp_update_attachment_metadata( $attach_id, $attach_data );

            $thumbnail_url = houzez_get_profile_image_url( $attach_data );
            $fullimage_url  = wp_get_attachment_image_src( $attach_id, 'full' );

            $ajax_response = array(
                'success'   => true,
                'url' => $thumbnail_url,
                'attachment_id'    => $attach_id,
                'full_image'    => $fullimage_url[0]
            );

            echo json_encode( $ajax_response );
            die;

        } else {
            $ajax_response = array( 'success' => false, 'reason' => 'Image upload failed!' );
            echo json_encode( $ajax_response );
            die;
        }

    }
}




/*-----------------------------------------------------------------------------------*/
/*	Houzez get ajax single property
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_get_single_property', 'houzez_get_single_property' );
add_action( 'wp_ajax_houzez_get_single_property', 'houzez_get_single_property' );

if( !function_exists('houzez_get_single_property') ) {
    function houzez_get_single_property() {
        check_ajax_referer('houzez_map_ajax_nonce', 'security');

        $prop_id = isset($_POST['prop_id']) ? sanitize_text_field($_POST['prop_id']) : '';

        $args = array(
            'p' => $prop_id,
            'posts_per_page' => 1,
            'post_type' => 'property',
            'post_status' => 'publish'
        );


        $query = new WP_Query($args);
        $props = array();

        while( $query->have_posts() ) {
            $query->the_post();

            $post_id = get_the_ID();
            $property_location = get_post_meta( get_the_ID(),'fave_property_location',true);
            $lat_lng = explode(',', $property_location);
            $prop_images        = get_post_meta( get_the_ID(), 'fave_property_images', false );
            $prop_featured       = get_post_meta( get_the_ID(), 'fave_featured', true );
            $prop_type = wp_get_post_terms( get_the_ID(), 'property_type', array("fields" => "ids") );

            $prop = new stdClass();

            $prop->id = $post_id;
            $prop->title = get_the_title();
            $prop->lat = $lat_lng[0];
            $prop->lng = $lat_lng[1];
            $prop->bedrooms = get_post_meta( get_the_ID(), 'fave_property_bedrooms', true );
            $prop->bathrooms = get_post_meta( get_the_ID(), 'fave_property_bathrooms', true );
            $prop->address = get_post_meta( get_the_ID(), 'fave_property_map_address', true );
            $prop->thumbnail = get_the_post_thumbnail( $post_id, 'houzez-property-thumb-image' );
            $prop->url = get_permalink();
            $prop->prop_meta = houzez_listing_meta_v1();
            $prop->type = houzez_taxonomy_simple('property_type');
            $prop->images_count = count( $prop_images );
            $prop->price = houzez_listing_price_v1();

            foreach( $prop_type as $term_id ) {
                $icon = get_tax_meta( $term_id, 'fave_prop_type_icon');
                $retinaIcon = get_tax_meta( $term_id, 'fave_prop_type_icon_retina');

                if( !empty($icon['src']) ) {
                    $prop->icon = $icon['src'];
                } else {
                    $prop->icon = get_template_directory_uri() . '/images/map/pin-single-family.png';
                }
                if( !empty($retinaIcon['src']) ) {
                    $prop->retinaIcon = $retinaIcon['src'];
                } else {
                    $prop->retinaIcon = get_template_directory_uri() . '/images/map/pin-single-family.png';
                }
            }

            array_push($props, $prop);
        }

        wp_reset_postdata();

        if(count($props) > 0) {
            echo json_encode(array('getprops'=>true, 'props'=>$props));
            exit();
        } else {
            echo json_encode(array('getprops'=>false));
            exit();
        }

        die();

    }
}


/*-----------------------------------------------------------------------------------*/
/*	Houzez Print Property
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_create_print', 'houzez_create_print' );
add_action( 'wp_ajax_houzez_create_print', 'houzez_create_print' );

if( !function_exists('houzez_create_print')) {
    function houzez_create_print () {

        if(!isset($_POST['propid'])|| !is_numeric($_POST['propid'])){
            exit();
        }

        $property_id = intval($_POST['propid']);
        $the_post= get_post( $property_id );

        if( $the_post->post_type != 'property' || $the_post->post_status != 'publish' ) {
            exit();
        }

        print  '<html><head><link href="'.get_stylesheet_uri().'" rel="stylesheet" type="text/css" />';
        print  '<html><head><link href="'.get_template_directory_uri().'/css/bootstrap.css" rel="stylesheet" type="text/css" />';
        print  '<html><head><link href="'.get_template_directory_uri().'/css/main.css" rel="stylesheet" type="text/css" />';

        if( is_rtl() ) {
            print '<link href="'.get_template_directory_uri().'/css/rtl.css" rel="stylesheet" type="text/css" />';
            print '<link href="'.get_template_directory_uri().'/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />';
        }
        print '</head>';
        print  '<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script><script>$(window).load(function(){ print(); });</script>';
        print  '<body>';

        $print_logo = houzez_option( 'print_page_logo', false, 'url' );

        $image_id           = get_post_thumbnail_id( $property_id );
        $full_img           = wp_get_attachment_image_src($image_id, 'houzez-single-big-size');
        $full_img           = $full_img [0];

        $title              = get_the_title( $property_id );
        $page_object        = get_page( $property_id );
        $prop_excerpt       = $page_object->post_content;

        $prop_images          = get_post_meta( $property_id, 'fave_property_images', false );
        $prop_address         = get_post_meta( $property_id, 'fave_property_map_address', true );
        $prop_id = get_post_meta( $property_id, 'fave_property_id', true );
        $prop_price = get_post_meta( $property_id, 'fave_property_price', true );
        $prop_size = get_post_meta( $property_id, 'fave_property_size', true );
        $bedrooms = get_post_meta( $property_id, 'fave_property_bedrooms', true );
        $bathrooms = get_post_meta( $property_id, 'fave_property_bathrooms', true );
        $year_built = get_post_meta( $property_id, 'fave_property_year', true );
        $garage = get_post_meta( $property_id, 'fave_property_garage', true );
        $garage_size = get_post_meta( $property_id, 'fave_property_garage_size', true );
        $prop_floor_plan      = get_post_meta( $property_id, 'fave_floor_plans_enable', true );
        $floor_plans          = get_post_meta( $property_id, 'floor_plans', true );
        $additional_features_enable = get_post_meta( $property_id, 'fave_additional_features_enable', true );
        $additional_features = get_post_meta( $property_id, 'additional_features', true );

        $agent_display_option = get_post_meta( $property_id, 'fave_agent_display_option', true );
        $prop_agent_display = get_post_meta( $property_id, 'fave_agents', true );
        $prop_agent_num = $agent_num_call = $prop_agent_email = '';

        if( $prop_agent_display != '-1' && $agent_display_option == 'agent_info' ) {
            $prop_agent_id = get_post_meta( $property_id, 'fave_agents', true );
            $prop_agent_mobile = get_post_meta( $prop_agent_id, 'fave_agent_mobile', true );
            $prop_agent_phone = get_post_meta( $prop_agent_id, 'fave_agent_office_num', true );
            $prop_agent_skype = get_post_meta( $prop_agent_id, 'fave_agent_skype', true );
            $prop_agent_website = get_post_meta( $prop_agent_id, 'fave_agent_website', true );
            $prop_agent_email = get_post_meta( $prop_agent_id, 'fave_agent_email', true );
            $prop_agent = get_the_title( $prop_agent_id );
            $thumb_id = get_post_thumbnail_id( $prop_agent_id );
            $thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail', true );
            $prop_agent_photo_url = $thumb_url_array[0];

        } elseif ( $agent_display_option == 'author_info' ) {
            $author_id = get_post_field ('post_author', $property_id);
            $prop_agent = get_the_author_meta('display_name', $author_id );
            $prop_agent_mobile = get_the_author_meta( 'fave_author_mobile', $author_id );
            $prop_agent_phone = get_the_author_meta( 'fave_author_phone', $author_id );
            $prop_agent_skype = get_the_author_meta( 'fave_author_skype', $author_id );
            $prop_agent_website = get_the_author_meta( 'url', $author_id );
            $prop_agent_photo_url = get_the_author_meta( 'fave_author_custom_picture', $author_id );
            $prop_agent_email = get_the_author_meta( 'email', $author_id );
        }
        if( empty( $prop_agent_photo_url )) {
            $prop_agent_photo_url = get_template_directory_uri().'/images/profile-avatar.png';
        }

        $print_agent = houzez_option('print_agent');
        $print_description = houzez_option('print_description');
        $print_details = houzez_option('print_details');
        $print_details_additional = houzez_option('print_details_additional');
        $print_features = houzez_option('print_features');
        $print_floorplans = houzez_option('print_floorplans');
        $print_gallery = houzez_option('print_gallery');
        ?>

        <section id="section-body">
            <!--start detail content-->
            <section class="section-detail-content">
                <div class="detail-bar print-detail">
                    <div class="detail-block">
                        <div class="print-header">
                            <div class="print-header-left">
                                <a href="#" class="print-logo">

                                    <img src="<?php echo esc_url($print_logo); ?>" alt="logo">
                                    <span class="tag-line"><?php bloginfo( 'description' ); ?></span>

                                </a>
                            </div>
                        </div>
                        <div class="print-header-detail">
                            <div class="print-header-detail-left">
                                <h1><?php echo esc_attr( $title ); ?></h1>
                                <p><?php echo esc_attr( $prop_address ); ?></p>
                            </div>
                            <div class="print-header-detail-right">
                                <?php echo houzez_listing_price_for_print( $property_id ); ?>
                            </div>
                        </div>
                        <div class="print-banner">
                            <div class="print-main-image">
                                <?php if( !empty($full_img) ) { ?>
                                    <img src="<?php echo esc_url( $full_img ); ?>" alt="<?php echo esc_attr($title); ?>">
                                    <img class="qr-image" src="https://chart.googleapis.com/chart?chs=105x104&cht=qr&chl=<?php echo esc_url( get_permalink($property_id) ); ?>&choe=UTF-8" title="<?php echo esc_attr($title); ?>" />
                                <?php } ?>
                            </div>
                        </div>

                        <?php if( $print_agent != 0 ) { ?>
                        <div class="print-block">
                            <div class="media agent-media">
                                <div class="media-left">
                                    <a href="#">
                                        <img src="<?php echo esc_url( $prop_agent_photo_url ); ?>" class="media-object" alt="image" height="74" width="74">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php esc_html_e( 'Contact Agent', 'houzez' ); ?></h4>
                                    <ul>
                                        <li><strong><?php echo esc_attr($prop_agent); ?></strong></li>
                                        <li><strong><?php esc_html_e( 'Mobile:', 'houzez' ); ?></strong> <?php esc_attr_e($prop_agent_mobile); ?></li>
                                        <li><strong><?php esc_html_e( 'Email:', 'houzez' ); ?></strong> <?php esc_attr_e($prop_agent_email); ?></li>
                                        <li><strong><?php esc_html_e( 'Phone:', 'houzez' ); ?></strong> <?php esc_attr_e($prop_agent_phone); ?></li>
                                        <li><strong><?php esc_html_e( 'Skype:', 'houzez' ); ?></strong> <?php esc_attr_e($prop_agent_skype); ?></li>
                                        <li><strong><?php esc_html_e( 'Website:', 'houzez' ); ?></strong> <?php echo esc_url($prop_agent_website); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if( $print_description != 0 ) { ?>
                        <div class="print-block">
                            <div class="detail-title-inner">
                                <h4 class="title-inner"><?php esc_html_e('Property Description', 'houzez'); ?></h4>
                            </div>
                            <p><?php echo $prop_excerpt; ?></p>
                        </div>
                        <?php } ?>

                        <?php if( $print_details != 0 ) { ?>
                        <div class="print-block">
                            <div class="detail-title-inner">
                                <h4 class="title-inner"><?php esc_html_e('Property Details', 'houzez'); ?></h4>
                            </div>
                            <div class="alert">
                                <ul class="print-list-three-col">
                                    <?php
                                    if( !empty( $prop_id ) ) {
                                        echo '<li><strong>'.esc_html__( 'Property ID:', 'houzez').'</strong> '.esc_attr( $prop_id ).'</li>';
                                    }
                                    if( !empty( $prop_price ) ) {
                                        echo '<li><strong>'.esc_html__( 'Price:', 'houzez'). '</strong> '.houzez_listing_price_by_id($property_id).'</li>';
                                    }
                                    if( !empty( $prop_size ) ) {
                                        echo '<li><strong>'.esc_html__( 'Property Size:', 'houzez'). '</strong> '.houzez_property_size_by_id( $property_id, 'after' ).'</li>';
                                    }
                                    if( !empty( $bedrooms ) ) {
                                        echo '<li><strong>'.esc_html__( 'Bedrooms:', 'houzez').'</strong> '.esc_attr( $bedrooms ).'</li>';
                                    }
                                    if( !empty( $bathrooms ) ) {
                                        echo '<li><strong>'.esc_html__( 'Bathrooms:', 'houzez').'</strong> '.esc_attr( $bathrooms ).'</li>';
                                    }
                                    if( !empty( $garage ) ) {
                                        echo '<li><strong>'.esc_html__( 'Garage:', 'houzez').'</strong> '.esc_attr( $garage ).'</li>';
                                    }
                                    if( !empty( $garage_size ) ) {
                                        echo '<li><strong>'.esc_html__( 'Garage Size:', 'houzez').'</strong> '.esc_attr( $garage_size ).'</li>';
                                    }
                                    if( !empty( $year_built ) ) {
                                        echo '<li><strong>'.esc_html__( 'Year Built:', 'houzez').'</strong> '.esc_attr( $year_built ).'</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php } ?>

                            <?php if( $additional_features_enable != 'disable' && !empty( $additional_features_enable ) && $print_details_additional != 0 ) { ?>
                            <div class="detail-title-inner">
                                <h4 class="title-inner"><?php esc_html_e('Additional details', 'houzez'); ?></h4>
                            </div>
                            <ul class="print-list-three-col">
                                <?php
                                foreach( $additional_features as $ad_del ):
                                    echo '<li><strong>'.esc_attr( $ad_del['fave_additional_feature_title'] ).':</strong> '.esc_attr( $ad_del['fave_additional_feature_value'] ).'</li>';
                                endforeach;
                                ?>
                            </ul>
                            <?php } ?>

                        </div>

                        <?php if( $print_features != 0 ) { ?>
                        <div class="print-block">
                            <div class="detail-title-inner">
                                <h4 class="title-inner"><?php esc_html_e('Property Features', 'houzez'); ?></h4>
                            </div>
                            <ul class="print-list-three-col list-features">
                                <?php
                                $prop_features = wp_get_post_terms( $property_id, 'property_feature', array("fields" => "all"));
                                if (!empty($prop_features)):
                                    foreach ($prop_features as $term):
                                        $term_link = get_term_link($term, 'property_feature');
                                        if (is_wp_error($term_link))
                                            continue;
                                        echo '<li>' . esc_attr( $term->name ). '</li>';
                                    endforeach;
                                endif;
                                ?>
                            </ul>
                        </div>
                        <?php } ?>

                        <?php if( $prop_floor_plan != 'disable' && !empty( $prop_floor_plan ) && $print_floorplans != 0 ) { ?>
                        <div class="print-floor">
                            <div class="detail-title-inner">
                                <h4 class="title-inner"><?php esc_html_e('Floor Plans', 'houzez'); ?></h4>
                            </div>
                            <div class="accord-block">

                                <?php foreach( $floor_plans as $plan ): ?>
                                    <div class="accord-outer">
                                        <div class="accord-tab">
                                            <h3><?php echo esc_attr( $plan['fave_plan_title'] ); ?></h3>
                                            <ul>
                                                <?php if( !empty( $plan['fave_plan_size'] ) ) { ?>
                                                    <li><?php esc_html_e( 'Size:', 'houzez' ); ?> <strong><?php echo esc_attr( $plan['fave_plan_size'] ); ?></strong></li>
                                                <?php } ?>

                                                <?php if( !empty( $plan['fave_plan_rooms'] ) ) { ?>
                                                    <li><?php esc_html_e( 'Rooms:', 'houzez' ); ?> <strong><?php echo esc_attr( $plan['fave_plan_rooms'] ); ?></strong></li>
                                                <?php } ?>

                                                <?php if( !empty( $plan['fave_plan_bathrooms'] ) ) { ?>
                                                    <li><?php esc_html_e( 'Baths:', 'houzez' ); ?> <strong><?php echo esc_attr( $plan['fave_plan_bathrooms'] ); ?></strong></li>
                                                <?php } ?>

                                                <?php if( !empty( $plan['fave_plan_price'] ) ) { ?>
                                                    <li><?php esc_html_e( 'Price:', 'houzez' ); ?> <strong><?php echo esc_attr( $plan['fave_plan_price'] ); ?></strong></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <div class="accord-content" style="display: none">
                                            <?php if( !empty( $plan['fave_plan_image'] ) ) { ?>
                                                <img src="<?php echo esc_url( $plan['fave_plan_image'] ); ?>" alt="img" width="400" height="436">
                                            <?php } ?>

                                            <?php if( !empty( $plan['fave_plan_description'] ) ) { ?>
                                                <p><?php echo esc_attr( $plan['fave_plan_description'] ); ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if( !empty( $prop_images ) && $print_gallery != 0 ) { ?>
                        <div class="print-gallery">
                            <div class="detail-title-inner">
                                <h4 class="title-inner"><?php esc_html_e('Property images', 'houzez'); ?></h4>
                            </div>
                            <?php foreach( $prop_images as $img_id ): ?>
                                <div class="print-gallery-image"> <?php echo wp_get_attachment_image( $img_id, 'houzez-imageSize1170_738' ); ?> </div>
                            <?php endforeach; ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <!--end detail content-->

        </section>

<?php
        print '</body></html>';
        wp_die();
    }
}

/*-----------------------------------------------------------------------------------*/
// Get Current Area | @return mixed|string|void
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_get_current_area' ) ) {

    function houzez_get_current_area() {

        if ( isset( $_COOKIE[ "houzez_current_area" ] ) ) {
            $current_area = $_COOKIE[ "houzez_current_area" ];
        }

        if ( empty( $current_area ) ) {
            $current_area = houzez_option('houzez_base_area');
        }

        return $current_area;
    }
}

/*-----------------------------------------------------------------------------------*/
// Ajax Area Switch
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_switch_area' ) ) {

    function houzez_switch_area() {

        if ( isset( $_POST[ 'switch_to_area' ] ) ):

            $expiry_period = '';

            $nonce = $_POST[ 'security' ];
            if ( ! wp_verify_nonce( $nonce, 'houzez_switch_area_nonce' ) ) {
                echo json_encode( array(
                    'success' => false,
                    'message' => __( 'Unverified Nonce!', 'houzez' )
                ) );
                wp_die();
            }

            $switch_to_area = $_POST[ 'switch_to_area' ];

            // expiry time
            $expiry_period = intval( $expiry_period );
            if ( ! $expiry_period ) {
                $expiry_period = 60 * 60;   // one hour
            }
            $expiry = time() + $expiry_period;

            // save cookie
            if ( setcookie( 'houzez_current_area', $switch_to_area, $expiry, '/' ) ) {
                echo json_encode( array(
                    'success' => true
                ) );
            } else {
                echo json_encode( array(
                    'success' => false,
                    'message' => __( "Failed to updated cookie !", 'houzez' )
                ) );
            }

        else:
            echo json_encode( array(
                    'success' => false,
                    'message' => __( "Invalid Request !", 'houzez' )
                )
            );
        endif;

        die;

    }

    add_action( 'wp_ajax_nopriv_houzez_switch_area', 'houzez_switch_area' );
    add_action( 'wp_ajax_houzez_switch_area', 'houzez_switch_area' );
}


if( !function_exists('houzez_get_area_size ') ) {
    function houzez_get_area_size( $areaSize ) {
        $prop_size = $areaSize;
        $houzez_base_area = houzez_option('houzez_base_area');

        if( !empty( $prop_size ) ) {

            if( isset( $_COOKIE[ "houzez_current_area" ] ) ) {
                if( $_COOKIE[ "houzez_current_area" ] == 'sq_meter' && $houzez_base_area != 'sq_meter'  ) {
                    $prop_size = $prop_size * 0.09290304; //m2 = ft2 x 0.09290304

                } elseif( $_COOKIE[ "houzez_current_area" ] == 'sqft' && $houzez_base_area != 'sqft' ) {
                    $prop_size = $prop_size / 0.09290304; //ft2 = m2 ÷ 0.09290304
                }
            }

            $prop_area_size = esc_attr( round( $prop_size ) );

        }
        return $prop_area_size;

    }
}

if( !function_exists('houzez_get_size_unit ') ) {
    function houzez_get_size_unit( $areaUnit ) {
        $measurement_unit_global = houzez_option('measurement_unit_global');
        $area_switcher_enable = houzez_option('area_switcher_enable');

        if( $area_switcher_enable != 0 ) {
            $prop_size_prefix = houzez_option('houzez_base_area');

            if( isset( $_COOKIE[ "houzez_current_area" ] ) ) {
                $prop_size_prefix =$_COOKIE[ "houzez_current_area" ];
            }

            if( $prop_size_prefix == 'sqft' ) {
                $prop_size_prefix = houzez_option('measurement_unit_sqft_text');
            } elseif( $prop_size_prefix == 'sq_meter' ) {
                $prop_size_prefix = houzez_option('measurement_unit_square_meter_text');
            }

        } else {
            if ($measurement_unit_global == 1) {
                $prop_size_prefix = houzez_option('measurement_unit');

                if( $prop_size_prefix == 'sqft' ) {
                    $prop_size_prefix = houzez_option('measurement_unit_sqft_text');
                } elseif( $prop_size_prefix == 'sq_meter' ) {
                    $prop_size_prefix = houzez_option('measurement_unit_square_meter_text');
                }

            } else {
                $prop_size_prefix = $areaUnit;
            }
        }
        return $prop_size_prefix;
    }
}

if( !function_exists('houzez_autocomplete_search') ) {
    function houzez_autocomplete_search() {

        $keyword_field = houzez_option('keyword_field');
        $response = '';
        if( $keyword_field != 'prop_city_state_county' ) {
            $search_qry = array(
                'post_type' => 'property',
                'posts_per_page' => -1,
                'post_status' => 'publish'
            );

            $suggestions_title = array();
            $suggestions_address = array();

            $loop = new WP_Query($search_qry);

            while ($loop->have_posts()) {
                $loop->the_post();
                $suggestions_title[] = get_the_title();
                $suggestions_address[] = get_post_meta(get_the_ID(), 'fave_property_map_address', true);
                $suggestions_address[] = get_post_meta(get_the_ID(), 'fave_property_zip', true);
                $suggestions_address[] = get_post_meta(get_the_ID(), 'fave_property_address', true);
            }
            wp_reset_query();

            if ($keyword_field == "prop_title") {
                $suggestions_title = array_unique($suggestions_title);
                $suggestions_title = array_values($suggestions_title);
                $response = json_encode($suggestions_title);

            } else if ($keyword_field == "prop_address") {
                $suggestions_address = array_unique($suggestions_address);
                $suggestions_address = array_values($suggestions_address);
                $response = json_encode($suggestions_address);
            }
        } else {
            $suggestions_city_state = array();
            $args = array(
                'orderby' => 'count',
                'hide_empty' => 0,
            );

            $terms = get_terms( 'property_city', $args );
            foreach ( $terms as $term ) {
                $suggestions_city_state[].= $term->name;
            }

            $terms = get_terms( 'property_area', $args );

            foreach ( $terms as $term ) {
                $suggestions_city_state[].= $term->name;
            }

            $terms = get_terms( 'property_state', $args );
            foreach ( $terms as $term ) {
                $suggestions_city_state[].= $term->name;
            }

            $suggestions_city_state = array_unique($suggestions_city_state);
            $suggestions_city_state = array_values($suggestions_city_state);
            $response = json_encode($suggestions_city_state);
        }
        return $response;
    }
}

if( !function_exists('houzez_generate_invoice') ):
    function houzez_generate_invoice( $billingFor, $billionType, $packageID, $invoiceDate, $userID, $featured, $upgrade, $paypalTaxID, $paymentMethod ) {

        $price_per_submission = houzez_option('price_listing_submission');
        $price_featured_submission = houzez_option('price_featured_listing_submission');

        $price_per_submission      = floatval( $price_per_submission );
        $price_featured_submission = floatval( $price_featured_submission );

        $args = array(
            'post_title'	=> 'Invoice ',
            'post_status'	=> 'publish',
            'post_type'     => 'houzez_invoice'
        );
        $inserted_post_id =  wp_insert_post( $args );

        if( $billionType != 'one_time' ) {
            $billionType = __( 'Recurring', 'houzez' );
        } else {
            $billionType = __( 'One Time', 'houzez' );
        }

        if( $billingFor != 'package' ) {
            if( $upgrade == 1 ) {
                $total_price = $price_featured_submission;

            } else {
                if( $featured == 1 ) {
                    $total_price = $price_per_submission+$price_featured_submission;
                } else {
                    $total_price = $price_per_submission;
                }
            }
        } else {
            $total_price = get_post_meta( $packageID, 'fave_package_price', true);
        }

        $fave_meta = array();

        $fave_meta['invoice_billion_for'] = $billingFor;
        $fave_meta['invoice_billing_type'] = $billionType;
        $fave_meta['invoice_item_id'] = $packageID;
        $fave_meta['invoice_item_price'] = $total_price;
        $fave_meta['invoice_purchase_date'] = $invoiceDate;
        $fave_meta['invoice_buyer_id'] = $userID;
        $fave_meta['paypal_txn_id'] = $paypalTaxID;
        $fave_meta['invoice_payment_method'] = $paymentMethod;

        update_post_meta( $inserted_post_id, 'HOUZEZ_invoice_buyer', $userID );
        update_post_meta( $inserted_post_id, 'HOUZEZ_invoice_type', $billionType );
        update_post_meta( $inserted_post_id, 'HOUZEZ_invoice_for', $billingFor );
        update_post_meta( $inserted_post_id, 'HOUZEZ_invoice_item_id', $packageID );
        update_post_meta( $inserted_post_id, 'HOUZEZ_invoice_price', $total_price );
        update_post_meta( $inserted_post_id, 'HOUZEZ_invoice_date', $invoiceDate );
        update_post_meta( $inserted_post_id, 'HOUZEZ_paypal_txn_id', $paypalTaxID );
        update_post_meta( $inserted_post_id, 'HOUZEZ_invoice_payment_method', $paymentMethod );

        update_post_meta( $inserted_post_id, '_houzez_invoice_meta', $fave_meta );

        // Update post title
        $update_post = array(
            'ID'         => $inserted_post_id,
            'post_title' => 'Invoice '.$inserted_post_id,
        );
        wp_update_post( $update_post );
        return $inserted_post_id;
    }
endif;

/*-----------------------------------------------------------------------------------*/
/*	Houzez Invoice Filter
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_invoices_ajax_search', 'houzez_invoices_ajax_search' );
add_action( 'wp_ajax_houzez_invoices_ajax_search', 'houzez_invoices_ajax_search' );

if( !function_exists('houzez_invoices_ajax_search') ){
    function houzez_invoices_ajax_search() {
        global $current_user;
        wp_get_current_user();
        $userID = $current_user->ID;

        $meta_query = array();
        $date_query = array();

        if( isset($_POST['invoice_status']) &&  $_POST['invoice_status'] !='' ){
            $temp_array = array();
            $temp_array['key'] = 'invoice_payment_status';
            $temp_array['value'] = esc_html( $_POST['invoice_status'] );
            $temp_array['compare'] = '=';
            $temp_array['type'] = 'NUMERIC';
            $meta_query[] = $temp_array;
        }

        if( isset($_POST['invoice_type']) &&  $_POST['invoice_type'] !='' ){
            $temp_array = array();
            $temp_array['key'] = 'HOUZEZ_invoice_for';
            $temp_array['value'] = esc_html( $_POST['invoice_type'] );
            $temp_array['compare'] = 'LIKE';
            $temp_array['type'] = 'CHAR';
            $meta_query[] = $temp_array;
        }

        if( isset($_POST['startDate']) &&  $_POST['startDate'] !='' ){
            $temp_array = array();
            $temp_array['after'] = esc_html( $_POST['startDate'] );
            $date_query[] = $temp_array;
        }

        if( isset($_POST['endDate']) &&  $_POST['endDate'] !='' ){
            $temp_array = array();
            $temp_array['before'] = esc_html( $_POST['endDate'] );
            $date_query[] = $temp_array;
        }


        $invoices_args = array(
            'post_type' => 'houzez_invoice',
            'posts_per_page' => '-1',
            'meta_query' => $meta_query,
            'date_query' => $date_query,
            'author' => $userID
        );

        $invoices = new WP_Query( $invoices_args );
        $total_price = 0;

        ob_start();
        while ( $invoices->have_posts()): $invoices->the_post();
            $fave_meta = houzez_get_invoice_meta( get_the_ID() );
            get_template_part('template-parts/invoices');

            $total_price += $fave_meta['invoice_item_price'];
        endwhile;

        $result = ob_get_contents();
        ob_end_clean();

        echo json_encode( array( 'success' => true, 'result' => $result, 'total_price' => houzez_get_invoice_price( $total_price ) ) );
        wp_die();
    }
}