<?php
/**
 * This file contains functions related to profile edit
 */


if ( ! function_exists( 'inspiry_profile_image_upload' ) ) {
	/**
	 * Ajax image upload for user profile page
	 */
	function inspiry_profile_image_upload() {

		// Verify Nonce
		$nonce = $_REQUEST[ 'nonce' ];
		if ( ! wp_verify_nonce( $nonce, 'inspiry_allow_upload' ) ) {
			$ajax_response = array(
				'success' => false,
				'reason' => 'Security check failed!',
			);
			echo json_encode( $ajax_response );
			die;
		}

		$submitted_file = $_FILES[ 'inspiry_upload_file' ];
		$uploaded_image = wp_handle_upload( $submitted_file, array( 'test_form' => false ) );   //Handle PHP uploads in WordPress, sanitizing file names, checking extensions for mime type, and moving the file to the appropriate directory within the uploads directory.

		if ( isset( $uploaded_image[ 'file' ] ) ) {
			$file_name = basename( $submitted_file[ 'name' ] );
			$file_type = wp_check_filetype( $uploaded_image[ 'file' ] );   //Retrieve the file type from the file name.

			// Prepare an array of post data for the attachment.
			$attachment_details = array(
				'guid' => $uploaded_image[ 'url' ],
				'post_mime_type' => $file_type[ 'type' ],
				'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
				'post_content' => '',
				'post_status' => 'inherit'
			);

			$attach_id = wp_insert_attachment( $attachment_details, $uploaded_image[ 'file' ] );       // This function inserts an attachment into the media library
			$attach_data = wp_generate_attachment_metadata( $attach_id, $uploaded_image[ 'file' ] );     // This function generates metadata for an image attachment. It also creates a thumbnail and other intermediate sizes of the image attachment based on the sizes defined
			wp_update_attachment_metadata( $attach_id, $attach_data );                                      // Update metadata for an attachment.

			$thumbnail_url = inspiry_get_profile_image_url( $attach_data );

			$ajax_response = array(
				'success' => true,
				'url' => $thumbnail_url,
				'attachment_id' => $attach_id
			);

			echo json_encode( $ajax_response );
			die;

		} else {
			$ajax_response = array( 'success' => false, 'reason' => 'Image upload failed!' );
			echo json_encode( $ajax_response );
			die;
		}

	}

	add_action( 'wp_ajax_profile_image_upload', 'inspiry_profile_image_upload' );    // only for logged in user
}


if ( ! function_exists( 'inspiry_get_profile_image_url' ) ) {
	/**
	 * Get thumbnail url based on attachment data
	 *
	 * @param $attach_data
	 * @return string
	 */
	function inspiry_get_profile_image_url( $attach_data ) {
		$upload_dir = wp_upload_dir();
		$image_path_array = explode( '/', $attach_data[ 'file' ] );
		$image_path_array = array_slice( $image_path_array, 0, count( $image_path_array ) - 1 );
		$image_path = implode( '/', $image_path_array );
		$thumbnail_name = null;
		if ( isset( $attach_data[ 'sizes' ][ 'agent-image' ] ) ) {
			$thumbnail_name = $attach_data[ 'sizes' ][ 'agent-image' ][ 'file' ];
		} else {
			$thumbnail_name = $attach_data[ 'sizes' ][ 'thumbnail' ][ 'file' ];
		}
		return $upload_dir[ 'baseurl' ] . '/' . $image_path . '/' . $thumbnail_name;
	}
}


if ( ! function_exists( 'inspiry_update_profile' ) ) {
	/**
	 * Edit Profile Form Submit Handler
	 */
	function inspiry_update_profile() {

		// Get user info
		global $current_user;
		get_currentuserinfo();

		// Array for errors
		$errors = array();

		if ( wp_verify_nonce( $_POST[ 'user_profile_nonce' ], 'update_user' ) ) {

			// profile-image-id
			// Update profile image
			if ( ! empty( $_POST[ 'profile-image-id' ] ) ) {
				$profile_image_id = intval( $_POST[ 'profile-image-id' ] );
				update_user_meta( $current_user->ID, 'profile_image_id', $profile_image_id );
			} else {
				delete_user_meta( $current_user->ID, 'profile_image_id' );
			}

			// Update first name
			if ( ! empty( $_POST[ 'first-name' ] ) ) {
				$user_first_name = sanitize_text_field( $_POST[ 'first-name' ] );
				update_user_meta( $current_user->ID, 'first_name', $user_first_name );
			} else {
				delete_user_meta( $current_user->ID, 'first_name' );
			}

			// Update last name
			if ( ! empty( $_POST[ 'last-name' ] ) ) {
				$user_last_name = sanitize_text_field( $_POST[ 'last-name' ] );
				update_user_meta( $current_user->ID, 'last_name', $user_last_name );
			} else {
				delete_user_meta( $current_user->ID, 'last_name' );
			}

			// Update display name
			if ( ! empty( $_POST[ 'display-name' ] ) ) {
				$user_display_name = sanitize_text_field( $_POST[ 'display-name' ] );
				$return = wp_update_user( array(
					'ID' => $current_user->ID,
					'display_name' => $user_display_name
				) );
				if ( is_wp_error( $return ) ) {
					$errors[] = $return->get_error_message();
				}
			}

			// Update user email
			if ( ! empty( $_POST[ 'email' ] ) ) {
				$user_email = is_email( sanitize_email( $_POST[ 'email' ] ) );
				if ( ! $user_email )
					$errors[] = __( 'The Email you entered is not valid. Please try again.', 'framework' );
				else {
					$email_exists = email_exists( $user_email );    // email_exists returns a user id if a user exists against it
					if ( $email_exists ) {
						if ( $email_exists != $current_user->ID ) {
							$errors[] = __( 'This Email is already used by another user. Please try a different one.', 'framework' );
						} else {
							// no need to update the email as it is already current user's
						}
					} else {
						$return = wp_update_user( array( 'ID' => $current_user->ID, 'user_email' => $user_email ) );
						if ( is_wp_error( $return ) ) {
							$errors[] = $return->get_error_message();
						}
					}
				}
			}

			// update user description
			if ( ! empty( $_POST[ 'description' ] ) ) {
				$user_description = sanitize_text_field( $_POST[ 'description' ] );
				update_user_meta( $current_user->ID, 'description', $user_description );
			} else {
				delete_user_meta( $current_user->ID, 'description' );
			}

			// Update mobile number
			if ( ! empty( $_POST[ 'mobile-number' ] ) ) {
				$user_mobile_number = sanitize_text_field( $_POST[ 'mobile-number' ] );
				update_user_meta( $current_user->ID, 'mobile_number', $user_mobile_number );
			} else {
				delete_user_meta( $current_user->ID, 'mobile_number' );
			}

			// Update office number
			if ( ! empty( $_POST[ 'office-number' ] ) ) {
				$user_office_number = sanitize_text_field( $_POST[ 'office-number' ] );
				update_user_meta( $current_user->ID, 'office_number', $user_office_number );
			} else {
				delete_user_meta( $current_user->ID, 'office_number' );
			}

			// Update fax number
			if ( ! empty( $_POST[ 'fax-number' ] ) ) {
				$user_fax_number = sanitize_text_field( $_POST[ 'fax-number' ] );
				update_user_meta( $current_user->ID, 'fax_number', $user_fax_number );
			} else {
				delete_user_meta( $current_user->ID, 'fax_number' );
			}

			// Update facebook url
			if ( ! empty( $_POST[ 'facebook-url' ] ) ) {
				$facebook_url = sanitize_text_field( $_POST[ 'facebook-url' ] );
				update_user_meta( $current_user->ID, 'facebook_url', $facebook_url );
			} else {
				delete_user_meta( $current_user->ID, 'facebook_url' );
			}

			// Update twitter url
			if ( ! empty( $_POST[ 'twitter-url' ] ) ) {
				$twitter_url = sanitize_text_field( $_POST[ 'twitter-url' ] );
				update_user_meta( $current_user->ID, 'twitter_url', $twitter_url );
			} else {
				delete_user_meta( $current_user->ID, 'twitter_url' );
			}

			// Update google plus url
			if ( ! empty( $_POST[ 'google-plus-url' ] ) ) {
				$google_plus_url = sanitize_text_field( $_POST[ 'google-plus-url' ] );
				update_user_meta( $current_user->ID, 'google_plus_url', $google_plus_url );
			} else {
				delete_user_meta( $current_user->ID, 'google_plus_url' );
			}

			// Update linkedIn url
			if ( ! empty( $_POST[ 'linkedin-url' ] ) ) {
				$linkedin_url = sanitize_text_field( $_POST[ 'linkedin-url' ] );
				update_user_meta( $current_user->ID, 'linkedin_url', $linkedin_url );
			} else {
				delete_user_meta( $current_user->ID, 'linkedin_url' );
			}

			// Update user password
			if ( ! empty( $_POST[ 'pass1' ] ) && ! empty( $_POST[ 'pass2' ] ) ) {
				if ( $_POST[ 'pass1' ] == $_POST[ 'pass2' ] ) {
					$return = wp_update_user( array(
						'ID' => $current_user->ID,
						'user_pass' => $_POST[ 'pass1' ]
					) );
					if ( is_wp_error( $return ) ) {
						$errors[] = $return->get_error_message();
					}
				} else {
					$errors[] = __( 'The passwords you entered do not match.  Your password was not updated.', 'framework' );
				}
			}

			// if everything is fine
			if ( count( $errors ) == 0 ) {

				//action hook for plugins and extra fields saving
				do_action( 'edit_user_profile_update', $current_user->ID );

				$response = array(
					'success' => true,
					'message' => __( 'Profile information is updated successfully!', 'framework' ),
				);
				echo json_encode( $response );
				die;
			}

		} else {
			$errors[] = __( 'Security check failed!', 'framework' );
		}

		// in case of errors
		$response = array(
			'success' => false,
			'errors' => $errors
		);
		echo json_encode( $response );
		die;

	}

	add_action( 'wp_ajax_inspiry_update_profile', 'inspiry_update_profile' );    // only for logged in user
}
