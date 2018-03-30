<?php
/**
 * This file contains functions related to submit property template
 */

if ( ! function_exists( 'inspiry_image_upload' ) ) {
	/**
	 * Ajax image upload for property submit and update
	 */
	function inspiry_image_upload() {

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

			$thumbnail_url = inspiry_get_thumbnail_url( $attach_data );

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

	add_action( 'wp_ajax_ajax_img_upload', 'inspiry_image_upload' );    // only for logged in user
}


if ( ! function_exists( 'inspiry_get_thumbnail_url' ) ) {
	/**
	 * Get thumbnail url based on attachment data
	 *
	 * @param $attach_data
	 * @return string
	 */
	function inspiry_get_thumbnail_url( $attach_data ) {
		$upload_dir = wp_upload_dir();
		$image_path_array = explode( '/', $attach_data[ 'file' ] );
		$image_path_array = array_slice( $image_path_array, 0, count( $image_path_array ) - 1 );
		$image_path = implode( '/', $image_path_array );
		$thumbnail_name = $attach_data[ 'sizes' ][ 'thumbnail' ][ 'file' ];
		return $upload_dir[ 'baseurl' ] . '/' . $image_path . '/' . $thumbnail_name;
	}
}


if ( ! function_exists( 'inspiry_remove_gallery_image' ) ) {
	/**
	 * Property Submit Form - Gallery Image Removal
	 */
	function inspiry_remove_gallery_image() {

		// Verify Nonce
		$nonce = $_POST[ 'nonce' ];
		if ( ! wp_verify_nonce( $nonce, 'inspiry_allow_upload' ) ) {
			$ajax_response = array(
				'post_meta_removed' => false,
				'attachment_removed' => false,
				'reason' => 'Security check failed!'
			);
			echo json_encode( $ajax_response );
			die;
		}

		$post_meta_removed = false;
		$attachment_removed = false;

		if ( isset( $_POST[ 'property_id' ] ) && isset( $_POST[ 'attachment_id' ] ) ) {
			$property_id = intval( $_POST[ 'property_id' ] );
			$attachment_id = intval( $_POST[ 'attachment_id' ] );
			if ( $property_id > 0 && $attachment_id > 0 ) {
				$post_meta_removed = delete_post_meta( $property_id, 'REAL_HOMES_property_images', $attachment_id );
				$attachment_removed = wp_delete_attachment( $attachment_id );
			} else if ( $attachment_id > 0 ) {
				if ( false === wp_delete_attachment( $attachment_id ) ) {
					$attachment_removed = false;
				} else {
					$attachment_removed = true;
				}
			}
		}

		$ajax_response = array(
			'post_meta_removed' => $post_meta_removed,
			'attachment_removed' => $attachment_removed,
		);

		echo json_encode( $ajax_response );
		die;

	}

	add_action( 'wp_ajax_remove_gallery_image', 'inspiry_remove_gallery_image' );
}


if ( ! function_exists( 'inspiry_submit_notice' ) ) {
	/**
	 * Property Submit Notice Email
	 *
	 * @param $property_id
	 */
	function inspiry_submit_notice( $property_id ) {

		// get and sanitize target email
		$target_email = sanitize_email( get_option( 'theme_submit_notice_email' ) );
		$target_email = is_email( $target_email );
		if ( $target_email ) {

			// current user ( submitter ) information
			$current_user = wp_get_current_user();
			$submitter_name = $current_user->display_name;
			$submitter_email = $current_user->user_email;
			$site_name = get_bloginfo( 'name' );

			// email subject
			$email_subject = sprintf( __( 'A new property is submitted by %s at %s', 'framework' ), $submitter_name, $site_name );

			// start of email body
			$email_body = $email_subject . "<br/><br/>";

			// preview link
			$preview_link = set_url_scheme( get_permalink( $property_id ) );
			$preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) ) );
			if ( ! empty( $preview_link ) ) {
				$email_body .= __( 'You can preview it here : ', 'framework' );
				$email_body .= '<a target="_blank" href="' . $preview_link . '">' . sanitize_text_field( $_POST[ 'inspiry_property_title' ] ) . '</a>';
				$email_body .= "<br/><br/>";
			}

			// message to reviewer
			if ( isset( $_POST[ 'message_to_reviewer' ] ) ) {
				$message_to_reviewer = stripslashes( $_POST[ 'message_to_reviewer' ] );
				if ( ! empty( $message_to_reviewer ) ) {
					$email_body .= sprintf( __( 'Message to the Reviewer : %s', 'framework' ), $message_to_reviewer ) . "<br/><br/>";
				}
			}

			// end of message body
			$email_body .= sprintf( __( 'You can contact the submitter "%s" via email %s', 'framework' ), $submitter_name, $submitter_email ) . "<br/>";

			// email header
			$header = 'Content-type: text/html; charset=utf-8' . "\r\n";
			$header = apply_filters( "inspiry_property_submit_mail_header", $header );
			$header .= 'From: ' . $submitter_name . " <" . $submitter_email . "> \r\n";

			// Send Email
			if ( ! wp_mail( $target_email, $email_subject, $email_body, $header ) ) {
				inspiry_log( 'Failed: To send property submit notice' );
			}

		}

	}

	add_action( 'inspiry_after_property_submit', 'inspiry_submit_notice' );
}


if ( ! function_exists( 'insert_attachment' ) ) {
	/**
	 * Insert Attachment Method for Property Submit Template
	 *
	 * @param $file_handler
	 * @param $post_id
	 * @param bool|false $setthumb
	 * @return int|WP_Error
	 */
	function insert_attachment( $file_handler, $post_id, $setthumb = false ) {

		// check to make sure its a successful upload
		if ( $_FILES[ $file_handler ][ 'error' ] !== UPLOAD_ERR_OK )
			__return_false();

		require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
		require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
		require_once( ABSPATH . "wp-admin" . '/includes/media.php' );

		$attach_id = media_handle_upload( $file_handler, $post_id );

		if ( $setthumb ) {
			update_post_meta( $post_id, '_thumbnail_id', $attach_id );
		}

		return $attach_id;
	}
}


if ( ! function_exists( 'edit_form_taxonomy_options' ) ) {
	/**
	 * Property Edit Form Taxonomy Options
	 *
	 * @param $property_id
	 * @param $taxonomy_name
	 */
	function edit_form_taxonomy_options( $property_id, $taxonomy_name ) {

		$existing_term_id = 0;
		$tax_terms = get_the_terms( $property_id, $taxonomy_name );
		if ( ! empty( $tax_terms ) ) {
			foreach ( $tax_terms as $tax_term ) {
				$existing_term_id = $tax_term->term_id;
				break;
			}
		}

		$existing_term_id = intval( $existing_term_id );

		if ( $existing_term_id == 0 || empty( $existing_term_id ) ) {
			echo '<option value="-1" selected="selected">' . __( 'None', 'framework' ) . '</option>';
		} else {
			echo '<option value="-1">' . __( 'None', 'framework' ) . '</option>';
		}

		$taxonomy_terms = get_terms( array(
			$taxonomy_name
		),
			array(
				'orderby' => 'name',
				'order' => 'ASC',
				'hide_empty' => false
			) );

		if ( ! empty( $taxonomy_terms ) ) {
			foreach ( $taxonomy_terms as $term ) {
				if ( $existing_term_id == intval( $term->term_id ) ) {
					echo '<option value="' . $term->term_id . '" selected="selected">' . $term->name . '</option>';
				} else {
					echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
				}
			}
		}
	}
}


if ( ! function_exists( 'edit_form_hierarchical_options' ) ) {
	/**
	 * Property Edit Form Hierarchical Taxonomy Options
	 *
	 * @param $property_id
	 * @param $taxonomy_name
	 */
	function edit_form_hierarchical_options( $property_id, $taxonomy_name ) {

		$existing_term_id = 0;
		$tax_terms = get_the_terms( $property_id, $taxonomy_name );
		if ( ! empty( $tax_terms ) ) {
			foreach ( $tax_terms as $tax_term ) {
				$existing_term_id = $tax_term->term_id;
				break;
			}
		}

		$existing_term_id = intval( $existing_term_id );
		if ( $existing_term_id == 0 || empty( $existing_term_id ) ) {
			echo '<option value="-1" selected="selected">' . __( 'None', 'framework' ) . '</option>';
		} else {
			echo '<option value="-1">' . __( 'None', 'framework' ) . '</option>';
		}

		$top_level_terms = get_terms(
			array(
				$taxonomy_name
			),
			array(
				'orderby' => 'name',
				'order' => 'ASC',
				'hide_empty' => false,
				'parent' => 0
			)
		);
		generate_id_based_hirarchical_options( $taxonomy_name, $top_level_terms, $existing_term_id );

	}
}