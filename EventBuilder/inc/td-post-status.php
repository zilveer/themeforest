<?php

function tdSubmitPostStatusForm() {

  	if ( isset( $_POST['tdSubmitPostStatus_nonce'] ) && wp_verify_nonce( $_POST['tdSubmitPostStatus_nonce'], 'tdSubmitPostStatus_html' ) ) {

  		$postStatus = $_POST['postStatus'];
        $post_id = $_POST['postId'];
        $td_slot_id = get_post_meta($post_id, 'item_package_id', true);

        global $current_user, $user_id, $user_info;
        get_currentuserinfo();
        $user_id = $current_user->ID;

        $package_items_expiration = get_post_meta($td_slot_id, 'package_items_expiration', true);
        $item_expiration_date = get_post_meta($post_id, 'item_expiration_date', true); 
        if(!empty($item_expiration_date)) {

            $start = current_time('timestamp'); 
            $end = $item_expiration_date; 
            $days_between = ceil(abs($end - $start) / 86400);
            update_post_meta($post_id, 'item_liftime', $days_between);

        } 

        $item_lifetime = get_post_meta($post_id, 'item_liftime', true);

        if(empty($item_lifetime)) {
            $item_lifetime = $package_items_expiration;
        }

        $post_author_id = get_post_field( 'post_author', $post_id );
        if($post_author_id == $user_id)  { 

            $response = 1;

            $data = 2;

        } else {

            $response = 2;

            $data = 3;

        }

        if($response == 1) {

            if($postStatus == 'publish') {

                $package_approve_item = get_post_meta($td_slot_id, 'package_approve_item', true);

                if(empty($package_approve_item)) {

                    $my_post = array(
                        'ID' => $post_id,
                        'post_status' => 'publish'
                    );

                    if(!empty($package_items_expiration)) {

                        $currentDate = current_time('timestamp');
                        $timestamp = strtotime('+'.$item_lifetime.' days', $currentDate);

                        update_post_meta($post_id, 'item_activation_date', $currentDate);
                        update_post_meta($post_id, 'item_expiration_date', $timestamp);

                    } else {

                        update_post_meta($post_id, 'item_activation_date', '');
                        update_post_meta($post_id, 'item_expiration_date', '');

                    }

                } else {
                    $my_post = array(
                        'ID' => $post_id,
                        'post_status' => 'pending'
                    );

                    update_post_meta($post_id, 'item_activation_date', '');
                    update_post_meta($post_id, 'item_expiration_date', '');
                }

                if(current_user_can('administrator')) {

                    $my_post = array(
                        'ID' => $post_id,
                        'post_status' => 'publish'
                    );

                    if(!empty($package_items_expiration)) {

                        $currentDate = current_time('timestamp');
                        $timestamp = strtotime('+'.$item_lifetime.' days', $currentDate);

                        update_post_meta($post_id, 'item_activation_date', $currentDate);
                        update_post_meta($post_id, 'item_expiration_date', $timestamp);

                    } else {

                        update_post_meta($post_id, 'item_activation_date', '');
                        update_post_meta($post_id, 'item_expiration_date', '');

                    }

                }

            } elseif($postStatus == 'unpublish') {

                $my_post = array(
                    'ID' => $post_id,
                    'post_status' => 'draft'
                );

                update_post_meta($post_id, 'item_activation_date', '');
                update_post_meta($post_id, 'item_expiration_date', '');

            }

            $data = 4;

        }

        wp_update_post( $my_post );


	} else {

		$data = 0;

  	}

    echo esc_attr($data);

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdSubmitPostStatusForm', 'tdSubmitPostStatusForm' );
add_action( 'wp_ajax_nopriv_tdSubmitPostStatusForm', 'tdSubmitPostStatusForm' );

