<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Newsletter {

	static public function crazyblog_subscribepopup_submit( $options ) {
		$opt = crazyblog_opt();
		$errors = '';
		$notify = '';
		$apikey = crazyblog_set( $opt, 'mail_chimp_api_key' );
		$list_id = crazyblog_set( $opt, 'mail_chimp_list_id' );
		$email = crazyblog_set( $options, 'email' );
		$before = '<div class="alert alert-warning">';
		$after = '</div>';
		if ( $apikey == '' ) {
			$errors .= $before . esc_html__( 'Please Enter MailChimp API Key in theme options', 'crazyblog' ) . $after;
		}

		if ( $list_id == '' ) {
			$errors.= $before . esc_html__( 'Please Enter MailChimp List ID in theme options', 'crazyblog' ) . $after;
		}

		if ( $email == '' ) {
			$errors .= $before . esc_html__( 'Please Enter Your Email Address', 'crazyblog' ) . $after;
		}

		if ( $email != '' && !is_email( $email ) ) {
			$errors .= $before . esc_html__( 'Please Enter Valid Email Address', 'crazyblog' ) . $after;
		}


		if ( empty( $errors ) ) {
			$dc = '';
			if ( strstr( $apikey, "-" ) ) {
				list($key, $dc) = explode( "-", $apikey, 2 );
				if ( !$dc ) {
					$dc = "us1";
				}
			}
			$auth = crazyblog_encrypt( 'user:' . $apikey );
			$get_name = explode( '@', $email );
			$data = array(
				'apikey' => $apikey,
				'email_address' => $email,
				'status' => 'subscribed',
				'merge_fields' => array(
					'FNAME' => crazyblog_set( $get_name, '0' )
				)
			);
			$json_data = json_encode( $data );
			$request = array(
				'headers' => array(
					'Authorization' => 'Basic ' . $auth,
					'Accept' => 'application/json',
					'Content-Type' => 'application/json',
					'Content-Length' => strlen( $json_data ),
				),
				'httpversion' => '1.0',
				'timeout' => 10,
				'method' => 'POST',
				'user-agent' => 'PHP-MCAPI/2.0',
				'sslverify' => false,
				'body' => $json_data,
			);

			$req = wp_remote_post( 'https://' . $dc . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/', $request );
			$r = json_decode( crazyblog_set( $req, 'body' ) );

			if ( preg_match( "/The requested resource could not be found./", crazyblog_set( $r, 'detail' ) ) == true ) {
				$notify .= '<div class="alert alert-warning"><strong>' . esc_html__( 'Invalid List ID', 'crazyblog' ) . '.</div>';
			} elseif ( preg_match( "/Use PUT to insert or update list members./", crazyblog_set( $r, 'detail' ) ) == true ) {
				$notify .= "<div class='alert alert-warning'><strong>{$email} " . esc_html__( 'is Already Exists', 'crazyblog' ) . ".</div>";
			} else {
				$notify .= '<div class="alert alert-success"><strong>' . esc_html__( 'Thank you for subscribing with us', 'crazyblog' ) . '.</div>';
			}
			echo json_encode( array( 'msg' => $notify ) );
		} else {
			echo json_encode( array( 'msg' => $errors ) );
		}
		exit;
	}

}
