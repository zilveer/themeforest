<?php

function tdSubmitReviewStat() {

  	if ( isset( $_POST['tdSubmitReviewStat_nonce'] ) && wp_verify_nonce( $_POST['tdSubmitReviewStat_nonce'], 'tdSubmitReviewStat_html' ) ) {

  		$review_post_status = $_POST['review_post_status'];
  		$id = $_POST['review_post_current_id'];
  		$td_slot_id = get_post_meta($id, 'item_package_id', true);

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

  		if($review_post_status == "reject") { 

  		global $redux_demo; 
			$contact_email = $redux_demo['contact-email'];
  		$email = $contact_email;
  		$blog_title = get_bloginfo('name');

  		$post_type_id = get_post_type($id);

      if($post_type_id == "item") {

    		global $redux_demo;
        $message = $redux_demo['listing-reject-message'];
        $the_title = get_the_title( $id );

  			$emailTo = get_post_meta($id, 'item_email', true);
  			$subject = "Message from ".$blog_title; 
  			$body =  $message."\r\n\r\n".$the_title;
  			$headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

      }

      if($post_type_id == "event") {

        global $redux_demo;
        $message = $redux_demo['event-reject-message'];
        $the_title = get_the_title( $id );

        $emailTo = get_post_meta($id, 'event_email', true);
        $subject = "Message from ".$blog_title; 
        $body =  $message."\r\n\r\n".$the_title;
        $headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

      }
			  
			wp_mail($emailTo, $subject, $body, $headers);

			wp_delete_post( $id, true );

			$response = $id; echo esc_attr($response);

			$response = ob_get_contents();
			ob_end_clean();

		} elseif($review_post_status == "approve") {

		  global $redux_demo; 
			$contact_email = $redux_demo['contact-email'];
  		$email = $contact_email;
  		$blog_title = get_bloginfo('name');

  		$post_type_id = get_post_type($id);

  		$my_post = array(
				'ID' => $id,
				'post_status' => 'publish'
			);

		  wp_update_post( $my_post );

		  if(!empty($package_items_expiration)) {

                $currentDate = current_time('timestamp');
                $timestamp = strtotime('+'.$item_lifetime.' days', $currentDate);

                update_post_meta($id, 'item_activation_date', $currentDate);
                update_post_meta($id, 'item_expiration_date', $timestamp);

      } else {

                update_post_meta($id, 'item_activation_date', '');
                update_post_meta($id, 'item_expiration_date', '');

      }

      if($post_type_id == "item") {

        global $redux_demo;
        $message = $redux_demo['listing-approve-message'];
        $the_title = get_the_title( $id );

  			$emailTo = get_post_meta($id, 'item_email', true);
  			$subject = "Message from ".$blog_title; 
  			$body = $message."\r\n\r\n".$the_title;
  			$headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

      }

      if($post_type_id == "event") {

        global $redux_demo;
        $message = $redux_demo['event-approve-message'];
        $the_title = get_the_title( $id );

        $emailTo = get_post_meta($id, 'event_email', true);
        $subject = "Message from ".$blog_title; 
        $body = $message."\r\n\r\n".$the_title;
        $headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

      }
			  
			wp_mail($emailTo, $subject, $body, $headers);

			$response = $id; echo esc_attr($response);

			$response = ob_get_contents();
			ob_end_clean();

		}


	} else {

		$response = 0;

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdSubmitReviewStat', 'tdSubmitReviewStat' );
add_action( 'wp_ajax_nopriv_tdSubmitReviewStat', 'tdSubmitReviewStat' );

