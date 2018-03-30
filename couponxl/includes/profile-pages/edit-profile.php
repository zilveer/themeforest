<?php
$message = '';

if( isset( $_GET['scope'] ) && isset( $_GET['code'] ) ){
    $response = wp_remote_post( 'https://connect.stripe.com/oauth/token', array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'body' => array(
            'client_secret' => couponxl_get_option( 'sk_client_id' ),
            'code' => $_GET['code'],
            'grant_type' => 'authorization_code'
        ),
        'cookies' => array()
    ));

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        return array( 'error' => "Something went wrong: $error_message" );
    } 
    else{           
        $data = json_decode( $response['body'], true );
        if( empty( $data['error'] ) ){
            update_user_meta( $current_user->ID, 'seller_payout_method', 'stripe' );
            update_user_meta( $current_user->ID, 'seller_stripe_data', $data );
            $message = '<div class="alert alert-success">'.__( 'Your stripe account is connected.', 'couponxl' ).'</div>';
        }
        else{
            $message = '<div class="alert alert-danger">'.$data['error_description'].'</div>';
        }
    }    
}


if( isset( $_POST['update_profile'] ) ){
    global $blog_id, $wpdb;

	$first_name = isset( $_POST['first_name'] ) ? esc_sql( $_POST['first_name'] ) : '';
	$last_name = isset( $_POST['last_name'] ) ? esc_sql( $_POST['last_name'] ) : '';
	$email = isset( $_POST['email'] ) ? esc_sql( $_POST['email'] ) : '';
	$password = isset( $_POST['password'] ) ? esc_sql( $_POST['password'] ) : '';
    $repeat_password = isset( $_POST['repeat_password'] ) ? esc_sql( $_POST['repeat_password'] ) : '';
    $phone_number = isset( $_POST['phone_number'] ) ? esc_sql( $_POST['phone_number'] ) : '';
    $seller_payout_method = isset( $_POST['seller_payout_method'] ) ? esc_sql( $_POST['seller_payout_method'] ) : '';
    $seller_paypal_account = isset( $_POST['seller_paypal_account'] ) ? esc_sql( $_POST['seller_paypal_account'] ) : '';
    $seller_skrill_account = isset( $_POST['seller_skrill_account'] ) ? esc_sql( $_POST['seller_skrill_account'] ) : '';
	$description = isset( $_POST['description'] ) ? htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8') : '';

    $can_proceed = true; 

	if( !empty( $first_name ) && !empty( $last_name ) && !empty( $email ) ){
		if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ){

            if( !empty( $seller_payout_method ) ){
                if( $seller_payout_method == 'paypal' && !filter_var( $seller_paypal_account, FILTER_VALIDATE_EMAIL ) ){
                    $can_proceed = false;
                    $message .= '<div class="alert alert-danger">'.__( 'PayPal email address is invalid', 'couponxl' ).'</div>';
                }
                if( $seller_payout_method == 'skrill' && !filter_var( $seller_skrill_account, FILTER_VALIDATE_EMAIL ) ){
                    $can_proceed = false;
                    $message .= '<div class="alert alert-danger">'.__( 'Skrill email address is invalid', 'couponxl' ).'</div>';
                }                
            }
            if( $seller_payout_method !== 'stripe' ){
                delete_post_meta( $current_user->ID, 'seller_paypal_account', '' );
                $seller_stripe_data = get_user_meta( $current_user->ID, 'seller_stripe_data', true );
                if( !empty( $seller_stripe_data ) ){
                    $response = wp_remote_post( 'https://connect.stripe.com/oauth/deauthorize', array(
                        'method' => 'POST',
                        'timeout' => 45,
                        'redirection' => 5,
                        'httpversion' => '1.0',
                        'blocking' => true,
                        'headers' => array(),
                        'body' => array(
                            'client_secret' => couponxl_get_option( 'sk_client_id' ),
                            'client_id' => couponxl_get_option( 'ap_client_id' ),
                            'stripe_user_id' => $seller_stripe_data['stripe_user_id']
                        ),
                        'cookies' => array()
                    ));

                    if ( is_wp_error( $response ) ) {
                        $error_message = $response->get_error_message();
                        $message .= '<div class="alert alert-success">'.__( 'Something went wrong: ', 'couponxl' ).$error_message.'</div>';
                    } 
                    else{           
                        $data = json_decode( $response['body'], true );
                        if( empty( $data['error'] ) ){
                            delete_user_meta( $current_user->ID, 'seller_stripe_data' );
                            $message .= '<div class="alert alert-success">'.__( 'Your stripe account is disconnected.', 'couponxl' ).'</div>';
                        }
                        else{
                            $message .= '<div class="alert alert-danger">'.$data['error_description'].'</div>';
                        }
                    } 
                }              
            }

            if( $can_proceed ){
    			if( !empty( $password ) && !empty( $repeat_password ) ){
    				if( $password == $repeat_password ){
    					$pasword_changes = 'yes';
    				}
    				else{
    					$message .= '<div class="alert alert-danger">'.__( 'Provided passwords do not match', 'couponxl' ).'</div>';
    					$pasword_changes = 'no';
    				}
    			}

    			$update_fields = array(
    				'ID' 			=> $current_user->ID,
    				'user_email'	=> $email,
                    'display_name' => $first_name.' '.$last_name
    			);
    			if( isset( $pasword_changes ) && $pasword_changes == 'yes' ){
    				$update_fields['user_pass'] = $password;
    			}
                
    			wp_update_user( $update_fields );
                $current_user = wp_get_current_user();          

                update_user_meta( $current_user->ID, 'first_name', $first_name );
                update_user_meta( $current_user->ID, 'seller_paypal_account', $seller_paypal_account );
                update_user_meta( $current_user->ID, 'seller_skrill_account', $seller_skrill_account );
    			update_user_meta( $current_user->ID, 'seller_payout_method', $seller_payout_method );
                update_user_meta( $current_user->ID, 'last_name', $last_name );
    			update_user_meta( $current_user->ID, 'phone_number', $phone_number );
    			update_user_meta( $current_user->ID, 'description', $description );

    			$message .= '<div class="alert alert-success">'.__( 'Your profile is updated.', 'couponxl' ).'</div>';
            }
		}
		else{
			$message .= '<div class="alert alert-danger">'.__( 'Email address is not valid.', 'couponxl' ).'</div>';
		}
	}
	else{
		$message .= '<div class="alert alert-danger">'.__( 'First name, last name and email are required.', 'couponxl' ).'</div>';
	}
}
else{
	$first_name = $current_user->user_firstname;
	$last_name = $current_user->user_lastname;
	$email = $current_user->user_email;
    $description = get_user_meta ($current_user->ID, 'description', true );
	$phone_number = get_user_meta ($current_user->ID, 'phone_number', true );
    $seller_paypal_account = get_user_meta ($current_user->ID, 'seller_paypal_account', true );
    $seller_skrill_account = get_user_meta ($current_user->ID, 'seller_skrill_account', true );
    $seller_stripe_data = get_user_meta ($current_user->ID, 'seller_stripe_data', true );
    $seller_payout_method = get_user_meta ($current_user->ID, 'seller_payout_method', true );
}

if( !empty( $message ) ){
	echo $message;
}
?>

<form method="post" action="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'edit_profile' ), array( 'all' ) ) ) ?>" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
            <div class="input-group">
                <label for="avatar"><?php _e( 'AVATAR', 'couponxl' );?> </label>
                <input type="hidden" name="wp-user-avatar" id="avatar" value="">
                <a href="javascript:;" class="image-upload user-avatar"><?php _e( 'Change Avatar', 'couponxl' ); ?></a>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group">
                <label for="email"><?php _e( 'EMAIL', 'couponxl' ); ?> <span class="required">*</span></label>
                <input type="text" name="email" id="email" value="<?php echo esc_attr( $email ) ?>" class="form-control" data-validation="required|email"  data-error="<?php esc_attr_e( 'Email is empty or invalid', 'couponxl' ); ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="input-group">
                <label for="first_name"><?php _e( 'FIRST NAME', 'couponxl' ); ?> <span class="required">*</span></label>
                <input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $first_name ) ?>" class="form-control" data-validation="required"  data-error="<?php esc_attr_e( 'Please input your first name', 'couponxl' ); ?>">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group">
                <label for="last_name"><?php _e( 'LAST NAME', 'couponxl' ); ?> <span class="required">*</span></label>
                <input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $last_name ) ?>" class="form-control" data-validation="required"  data-error="<?php esc_attr_e( 'Please input your last name', 'couponxl' ); ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="input-group">
                <label for="password"><?php _e( 'PASSWORD', 'couponxl' ); ?> </label>
                <input type="password" name="password" id="password" value="" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group">
                <label for="repeat_password"><?php _e( 'REPEAT PASSWORD', 'couponxl' ); ?></label>
                <input type="password" name="repeat_password" id="repeat_password" value="" class="form-control">
            </div>
        </div>
    </div>
    <?php
    $ap_client_id = couponxl_get_option('ap_client_id');
    $paypal_username = couponxl_get_option('paypal_username');
    $skrill_api_mqi_password = couponxl_get_option('skrill_api_mqi_password');
    if( !empty( $ap_client_id ) || !empty( $paypal_username ) || !empty( $skrill_api_mqi_password ) ):
    ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="input-group">
                <label for="seller_payout_method"><?php _e( 'PAYOUT METHOD', 'couponxl' ); ?></label>
                <select name="seller_payout_method" id="seller_payout_method" class="form-control">
                <option value=""><?php _e( '-Select-', 'couponxl' ); ?></option>
                <?php
                /* check stripe */
                if( !empty( $ap_client_id ) ){
                    echo '<option value="stripe" '.( $seller_payout_method == 'stripe' ? 'selected="selected"' : '' ).'>'.__( 'Stripe', 'couponxl' ).'</option>';
                }

                /* check paypal */
                if( !empty( $paypal_username ) ){
                    echo '<option value="paypal" '.( $seller_payout_method == 'paypal' ? 'selected="selected"' : '' ).'>'.__( 'PayPal', 'couponxl' ).'</option>';
                }

                /* check skrill */
                
                if( !empty( $skrill_api_mqi_password ) ){
                    echo '<option value="skrill" '.( $seller_payout_method == 'skrill' ? 'selected="selected"' : '' ).'>'.__( 'Skrill', 'couponxl' ).'</option>';
                }
                ?>
                </select>
            </div>
        </div>    
        <div class="col-sm-6">
            <?php if( !empty( $paypal_username ) ): ?>
                <div class="input-group paypal" style="<?php echo $seller_payout_method == 'paypal' ? '' : 'display: none;'; ?>">
                    <label for="seller_paypal_account"><?php _e( 'PAYPAL EMAIL', 'couponxl' ); ?></label>
                    <input type="text" name="seller_paypal_account" id="seller_paypal_account" value="<?php echo esc_attr( $seller_paypal_account ) ?>" class="form-control">
                </div>
            <?php endif; ?>
            <?php if( !empty( $skrill_api_mqi_password ) ): ?>
                <div class="input-group skrill" style="<?php echo $seller_payout_method == 'skrill' ? '' : 'display: none;'; ?>">
                    <label for="seller_skrill_account"><?php _e( 'SKRILL EMAIL', 'couponxl' ); ?></label>
                    <input type="text" name="seller_skrill_account" id="seller_skrill_account" value="<?php echo esc_attr( $seller_skrill_account ) ?>" class="form-control">
                </div>
            <?php endif; ?>
            <?php if( !empty( $ap_client_id ) ): ?>
                <div class="input-group stripe" style="<?php echo $seller_payout_method == 'stripe' ? '' : 'display: none;'; ?>">
                    <label for="seller_paypal_account"><?php _e( 'CONNECT STRIPE', 'couponxl' ); ?></label><br />
                    <?php if( empty( $seller_stripe_data ) ): ?>
                        <a href="https://connect.stripe.com/oauth/authorize?response_type=code&amp;client_id=<?php echo esc_attr( $ap_client_id ); ?>&amp;scope=read_write&amp;redirect_uri=<?php echo urlencode( couponxl_append_query_string( couponxl_get_permalink_by_tpl( 'page-tpl_my_profile' ), array( 'subpage' => 'edit_profile' ), array( 'all' ) ) ); ?>" class="image-upload">
                            <?php _e( 'Connect', 'couponxl' ); ?>
                        </a>
                    <?php else: ?>
                        <?php _e( 'ACCOUNT IS CONNECTED', 'couponxl' ); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="input-group">
                <label for="phone_number"><?php _e( 'PHONE NUMBER', 'couponxl' ); ?> </label>
                <input type="phone_number" name="phone_number" id="phone_number" value="<?php echo esc_attr( $phone_number ); ?>" class="form-control">
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-sm-12">
            <div class="input-group">
                <label for="description"><?php _e( 'SOMETHING ABOUT YOU', 'couponxl' ); ?> </label>
                <textarea name="description" id="description"><?php echo htmlspecialchars_decode( $description ); ?></textarea>
            </div>        	

            <input type="hidden" value="1" name="update_profile" />
            <a href="javascript:;" class="btn submit-form">
                <?php _e( 'UPDATE PROFILE', 'couponxl' ); ?>
            </a>            
        </div>
    </div>
</form>