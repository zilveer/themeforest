<?php
/**
 * File Name: Membership Functions
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 26/03/16
 * Time: 5:38 PM
 */

/*-----------------------------------------------------------------------------------*/
// Houzez Register user with membership
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_register_user_with_membership', 'houzez_register_user_with_membership' );
add_action( 'wp_ajax_houzez_register_user_with_membership', 'houzez_register_user_with_membership' );

if( !function_exists('houzez_register_user_with_membership') ) {
    function houzez_register_user_with_membership() {

        check_ajax_referer('houzez_register_nonce2', 'houzez_register_security2');

        $allowed_html = array();

        $username          = trim( sanitize_text_field( wp_kses( $_POST['username'], $allowed_html ) ));
        $email             = trim( sanitize_text_field( wp_kses( $_POST['useremail'], $allowed_html ) ));
        $first_name        = trim( sanitize_text_field( wp_kses( $_POST['first_name'], $allowed_html ) ));
        $last_name         = trim( sanitize_text_field( wp_kses( $_POST['last_name'], $allowed_html ) ));

        //$user_role = get_option( 'default_role' );
        $user_role = 'houzez_agent';

        if( empty( $username ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__(' The username field is empty.', 'houzez') ) );
            wp_die();
        }
        if (preg_match("/^[0-9A-Za-z_]+$/", $username) == 0) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('Invalid username (do not use special characters or spaces)!', 'houzez') ) );
            wp_die();
        }
        if( empty( $email ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('The email field is empty.', 'houzez') ) );
            wp_die();
        }
        if( username_exists( $username ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('This username is already registered.', 'houzez') ) );
            wp_die();
        }
        if( email_exists( $email ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('This email address is already registered.', 'houzez') ) );
            wp_die();
        }

        if( !is_email( $email ) ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('Invalid email address.', 'houzez') ) );
            wp_die();
        }

        $user_pass         = trim( sanitize_text_field(wp_kses( $_POST['register_pass'] ,$allowed_html) ) );
        $user_pass_retype  = trim( sanitize_text_field(wp_kses( $_POST['register_pass_retype'] ,$allowed_html) ) );

        if ($user_pass == '' || $user_pass_retype == '' ) {
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('One of the password field is empty!', 'houzez') ) );
            wp_die();
        }

        if ($user_pass !== $user_pass_retype ){
            echo json_encode( array( 'success' => false, 'msg' => esc_html__('Passwords do not match', 'houzez') ) );
            wp_die();
        }

        $user_id = wp_create_user( $username, $user_pass, $email );

        wp_update_user( array( 'ID' => $user_id, 'role' => $user_role ) );

        $user = get_user_by('login', $username );

        if( $user_id ) {
            update_user_meta( $user_id, 'first_name', $first_name );
            update_user_meta( $user_id, 'last_name', $last_name );
            houzez_update_profile( $user_id );
            houzez_wp_new_user_notification( $user_id, $user_pass );
            $user_as_agent = houzez_option('user_as_agent');
            if( $user_as_agent == 'yes' ) {
                houzez_register_as_agent ( $username, $email, $user_id );
            }

            if( !is_wp_error($user) ) {
                wp_clear_auth_cookie();
                wp_set_current_user($user->ID);
                wp_set_auth_cookie($user->ID);

                echo json_encode( array( 'success' => true, 'msg' => $user_id ) );
                wp_die();
            }
        }
        wp_die();

    }
}

/* -----------------------------------------------------------------------------------------------------------
 *  Set Listings as expire for per listing - keep
 -------------------------------------------------------------------------------------------------------------*/
if( !function_exists('houzez_listing_set_to_expire') ):
    function houzez_listing_set_to_expire($post_id){
        $prop = array(
            'ID'            => $post_id,
            'post_type'     => 'property',
            'post_status'   => 'expired'
        );

        wp_update_post($prop );

        $user_id    =   houzez_get_author_by_post_id( $post_id );
        $user       =   get_user_by('id', $user_id);
        $user_email =   $user->user_email;

        $args = array(
            'expired_listing_url'  => get_permalink($post_id),
            'expired_listing_name' => get_the_title($post_id)
        );
        houzez_email_type( $user_email, 'free_listing_expired', $args );


    }
endif;

/* -----------------------------------------------------------------------------------------------------------
*  Stripe Form for membership
-------------------------------------------------------------------------------------------------------------*/

if( !function_exists('houzez_stripe_payment_membership') ) {
    function houzez_stripe_payment_membership( $pack_id, $pack_price, $title ) {

        require_once( get_template_directory() . '/framework/stripe-php/init.php' );
        $stripe_secret_key = houzez_option('stripe_secret_key');
        $stripe_publishable_key = houzez_option('stripe_publishable_key');

        $current_user = wp_get_current_user();

        $userID = $current_user->ID;
        $user_login = $current_user->user_login;
        $user_email = get_the_author_meta('user_email', $userID);

        $stripe = array(
            "secret_key" => $stripe_secret_key,
            "publishable_key" => $stripe_publishable_key
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        $submission_currency = houzez_option('currency_paid_submission');
        $package_price_for_stripe = $pack_price * 100;

        print '
            <div class="houzez_stripe_membership " id="'.  sanitize_title($title).'">
                <script src="https://checkout.stripe.com/checkout.js" id="stripe_script"
                class="stripe-button"
                data-key="'. $stripe_publishable_key.'"
                data-amount="'.$package_price_for_stripe.'"
                data-email="'.$user_email.'"
                data-currency="'.$submission_currency.'"
                data-zip-code="true"
                data-billing-address="true"
                data-label="'.__('Pay with Credit Card','houzez').'"
                data-description="'.$title.' '.__('Package Payment','houzez').'">
                </script>
            </div>
            <input type="hidden" id="pack_id" name="pack_id" value="' . $pack_id . '">
            <input type="hidden" name="userID" value="' . $userID . '">
            <input type="hidden" id="pay_ammout" name="pay_ammout" value="' . $package_price_for_stripe . '">';
    }
}
/* -----------------------------------------------------------------------------------------------------------
*  Stripe Form Per Listing
-------------------------------------------------------------------------------------------------------------*/
if( !function_exists('houzez_stripe_payment_perlisting') ) {
    function houzez_stripe_payment_perlisting( $postID, $price_submission ) {

        require_once( get_template_directory() . '/framework/stripe-php/init.php' );
        $stripe_secret_key = houzez_option('stripe_secret_key');
        $stripe_publishable_key = houzez_option('stripe_publishable_key');

        $stripe = array(
            "secret_key" => $stripe_secret_key,
            "publishable_key" => $stripe_publishable_key
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $submission_currency = houzez_option('currency_paid_submission');
        $current_user = wp_get_current_user();
        $userID = $current_user->ID;
        $user_email = $current_user->user_email;

        $price_submission = $price_submission * 100;
        print '<div class="houzez_stripe_simple">
            <script src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="' . $stripe_publishable_key . '"
            data-amount="' . $price_submission . '"
            data-email="' . $user_email . '"
            data-zip-code="true"
            data-currency="' . $submission_currency . '"
            data-label="' . esc_html__('Pay with Credit Card', 'houzez') . '"
            data-description="' . esc_html__('Submission Payment', 'houzez') . '">
            </script>
        </div>
        <input type="hidden" id="propID" name="propID" value="' . $postID . '">
        <input type="hidden" id="submission_pay" name="submission_pay" value="1">
        <input type="hidden" name="userID" value="' . $userID . '">
        <input type="hidden" id="pay_ammout" name="pay_ammout" value="' . $price_submission . '">';
    }
}

if( !function_exists('houzez_show_stripe_form_per_listing') ) {
    function houzez_show_stripe_form_per_listing( $postID, $price_submission, $price_featured_submission ) {

        require_once( get_template_directory() . '/framework/stripe-php/init.php' );
        $stripe_secret_key = houzez_option('stripe_secret_key');
        $stripe_publishable_key = houzez_option('stripe_publishable_key');

        $stripe = array(
            "secret_key" => $stripe_secret_key,
            "publishable_key" => $stripe_publishable_key
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $processor_link = houzez_get_template_link('template/template-stripe-charge.php');
        $submission_currency = houzez_option('currency_paid_submission');
        $current_user = wp_get_current_user();
        $userID = $current_user->ID;
        $user_email = $current_user->user_email;

        $price_submission_total = $price_submission + $price_featured_submission;
        $price_submission_total = $price_submission_total * 100;
        $price_submission = $price_submission * 100;
        print '
    <form action="' . $processor_link . '" method="post" id="stripe_form_simple_listing">
        <div class="houzez_stripe_simple">
            <script src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="' . $stripe_publishable_key . '"
            data-amount="' . $price_submission . '"
            data-email="' . $user_email . '"
            data-zip-code="true"
            data-currency="' . $submission_currency . '"
            data-label="' . esc_html__('Pay with Credit Card', 'houzez') . '"
            data-description="' . esc_html__('Submission Payment', 'houzez') . '">
            </script>
        </div>
        <input type="hidden" id="propID" name="propID" value="' . $postID . '">
        <input type="hidden" id="submission_pay" name="submission_pay" value="1">
        <input type="hidden" name="userID" value="' . $userID . '">
        <input type="hidden" id="pay_ammout" name="pay_ammout" value="' . $price_submission . '">
    </form>

    <form action="' . $processor_link . '" method="post" id="stripe_form_featured_listing">
        <div class="houzez_stripe_simple">
            <script src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="' . $stripe_publishable_key . '"
            data-amount="' . $price_submission_total . '"
            data-email="' . $user_email . '"
            data-zip-code="true"
            data-currency="' . $submission_currency . '"
            data-label="' . esc_html__('Pay with Credit Card', 'houzez') . '"
            data-description="' . esc_html__('Submission & Featured Payment', 'houzez') . '">
            </script>
        </div>
        <input type="hidden" id="propID" name="propID" value="' . $postID . '">
        <input type="hidden" id="submission_pay" name="submission_pay" value="1">
        <input type="hidden" id="featured_pay" name="featured_pay" value="1">
        <input type="hidden" name="userID" value="' . $userID . '">
        <input type="hidden" id="pay_ammout" name="pay_ammout" value="' . $price_submission_total . '">
    </form>';
    }
}


/* -----------------------------------------------------------------------------------------------------------
*  Stripe Form Per Listing Upgrade
-------------------------------------------------------------------------------------------------------------*/
if( !function_exists('houzez_show_stripe_form_upgrade') ) {
    function houzez_show_stripe_form_upgrade( $postID, $price_featured_submission ) {

        require_once( get_template_directory() . '/framework/stripe-php/init.php' );
        $stripe_secret_key = houzez_option('stripe_secret_key');
        $stripe_publishable_key = houzez_option('stripe_publishable_key');

        $stripe = array(
            "secret_key" => $stripe_secret_key,
            "publishable_key" => $stripe_publishable_key
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $processor_link = houzez_get_template_link('template/template-stripe-charge.php');

        $current_user = wp_get_current_user();
        $userID = $current_user->ID;
        $user_email = $current_user->user_email;
        
        $submission_currency = houzez_option('currency_paid_submission');
        $price_featured_submission = $price_featured_submission * 100;

        print '
        <form action="' . $processor_link . '" method="post" >
        <div class="houzez_upgrade_stripe">
            <script src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="' . $stripe_publishable_key . '"
            data-amount="' . $price_featured_submission . '"
            data-zip-code="true"
            data-email="' . $user_email . '"
            data-currency="' . $submission_currency . '"
            data-panel-label="' . esc_html__('Upgrade to Featured', 'houzez') . '"
            data-label="' . __('Upgrade to Featured', 'houzez') . '"
            data-description="' . esc_html__(' Featured Payment', 'houzez') . '">
            </script>
        </div>
        <input type="hidden" id="propID" name="propID" value="' . $postID . '">
        <input type="hidden" id="submission_pay" name="submission_pay" value="1">
        <input type="hidden" id="is_upgrade" name="is_upgrade" value="1">
        <input type="hidden" name="userID" value="' . $userID . '">
        <input type="hidden" id="pay_ammout" name="pay_ammout" value="' . $price_featured_submission . '">
        </form>';
    }
}

add_action( 'wp_ajax_nopriv_houzez_paypal_package_payment', 'houzez_paypal_package_payment' );
add_action( 'wp_ajax_houzez_paypal_package_payment', 'houzez_paypal_package_payment' );

if( !function_exists('houzez_paypal_package_payment') ) {
    function houzez_paypal_package_payment() {
        global $current_user;
        wp_get_current_user();
        $userID = $current_user->ID;

        $allowed_html =   array();
        $blogInfo = esc_url( home_url() );
        $houzez_package_name    =   wp_kses($_POST['houzez_package_name'],$allowed_html);
        $houzez_package_price   =   $_POST['houzez_package_price'];
        $houzez_package_id      =   $_POST['houzez_package_id'];

        if( empty($houzez_package_price) && empty( $houzez_package_id ) ) {
            exit();
        }


        $currency            = houzez_option('currency_paid_submission');
        $payment_description = $houzez_package_name.' '.esc_html__('Membership payment on ','houzez').$blogInfo;

        $is_paypal_live      = houzez_option('paypal_api');
        $host                = 'https://api.sandbox.paypal.com';

        if( $is_paypal_live =='live'){
            $host = 'https://api.paypal.com';
        }

        $url             =   $host.'/v1/oauth2/token';
        $postArgs        =   'grant_type=client_credentials';
        $access_token    =   houzez_get_paypal_access_token( $url, $postArgs );
        $url             =   $host.'/v1/payments/payment';
        $return_url      = houzez_get_template_link('template/template-thankyou.php');
        $dash_profile_link   =  houzez_get_dashboard_profile_link();

        $payment = array(
            'intent' => 'sale',
            "redirect_urls" => array(
                "return_url" => $return_url,
                "cancel_url" => $dash_profile_link
            ),
            'payer' => array("payment_method" => "paypal"),
        );

        $payment['transactions'][0] = array(
            'amount' => array(
                'total' => $houzez_package_price,
                'currency' => $currency,
                'details' => array(
                    'subtotal' => $houzez_package_price,
                    'tax' => '0.00',
                    'shipping' => '0.00'
                )
            ),
            'description' => $payment_description
        );

        $payment['transactions'][0]['item_list']['items'][] = array(
            'quantity' => '1',
            'name' => esc_html__('Membership Payment','houzez'),
            'price' => $houzez_package_price,
            'currency' => $currency,
            'sku' => $houzez_package_name.' '.esc_html__('Membership Payment','houzez'),
        );

        // Convert PHP array into json format
        $jsonEncode = json_encode($payment);
        $json_response = houzez_execute_paypal_request( $url, $jsonEncode, $access_token );

        foreach ($json_response['links'] as $link) {
            if($link['rel'] == 'execute'){
                $payment_execute_url = $link['href'];
                $payment_execute_method = $link['method'];
            } else if($link['rel'] == 'approval_url'){
                $payment_approval_url = $link['href'];
                $payment_approval_method = $link['method'];
            }
        }

        // Save data in database for further use on processor page
        $output['payment_execute_url'] = $payment_execute_url;
        $output['access_token']        = $access_token;
        $output['package_id']          = $houzez_package_id;

        $save_output[$userID]   =   $output;
        update_option('houzez_paypal_package_transfer', $save_output);
        update_user_meta( $userID, 'houzez_paypal_package', $output);

        print $payment_approval_url;

        wp_die();

    }
}

/* -----------------------------------------------------------------------------------------------------------
 *  Check membership expire cron
 -------------------------------------------------------------------------------------------------------------*/
if( !function_exists('houzez_check_membership_expire_cron') ):
    function houzez_check_membership_expire_cron() {

        $houzezusers = get_users();

        foreach ( $houzezusers as $user ) {
            $user_id = $user->ID;

            $pack_id = get_user_meta ( $user_id, 'package_id', true );

            // Check if user has package
            if( $pack_id != '' ) {

                $date           =  strtotime ( get_user_meta( $user_id, 'package_activation',true) );
                $billingPeriod  =  get_post_meta( $pack_id, 'fave_billing_time_unit', true );
                $billingFreq    =  intval( get_post_meta( $pack_id, 'fave_billing_unit', true ) );
                $seconds = 0;

                switch ( $billingPeriod ){
                    case 'Day':
                        $seconds = 60*60*24;
                        break;
                    case 'Week':
                        $seconds = 60*60*24*7;
                        break;
                    case 'Month':
                        $seconds = 60*60*24*30;
                        break;
                    case 'Year':
                        $seconds = 60*60*24*365;
                        break;
                }
                $time_frame = $seconds*$billingFreq;
                $now = time();

                if( $now > $date + $time_frame ){
                    houzez_cancel_user_membership( $user_id );
                }

            } // endif if pack not free

        }// end foreach
    }
endif;

if( !function_exists('houzez_cancel_user_membership') ):
    function houzez_cancel_user_membership($user_id){
        global $post;

        update_user_meta( $user_id, 'package_id', '') ;
        update_user_meta( $user_id, 'package_listings', '' );
        update_user_meta( $user_id, 'package_featured_listings', '' );

        $args = array(
            'post_type'   => 'property',
            'author'      => $user_id,
            'post_status' => 'any'
        );

        $query = new WP_Query( $args );

        while( $query->have_posts()) {
            $query->the_post();

            $prop = array(
                'ID'            => $post->ID,
                'post_type'     => 'property',
                'post_status'   => 'expired'
            );

            wp_update_post($prop );
        }
        wp_reset_query();

        $user = get_user_by( 'id', $user_id );
        $user_email = $user->user_email;

        $args = array();

        houzez_email_type( $user_email, 'membership_cancelled', $args );
        wp_die();
    }
endif;

/* -----------------------------------------------------------------------------------------------------------
 *  Make Property Featured
 -------------------------------------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_make_prop_featured', 'houzez_make_prop_featured');
add_action( 'wp_ajax_houzez_make_prop_featured', 'houzez_make_prop_featured' );

if( !function_exists('houzez_make_prop_featured') ):
    function  houzez_make_prop_featured(){
        global $current_user;
        wp_get_current_user();
        $userID =   $current_user->ID;

        $prop_id = intval( $_POST['propid'] );
        $post = get_post( $prop_id );

        if( $post->post_author != $userID ) {
            wp_die();
        } else {
            if( houzez_get_featured_remaining_listings( $userID ) > 0 ) {
                houzez_update_package_featured_listings( $userID );
                update_post_meta( $prop_id, 'fave_featured', 1 );
                echo json_encode( array( 'success' => true, 'msg' => '' ) );
                wp_die();
            }else{
                echo json_encode( array( 'success' => false, 'msg' => '' ) );
                wp_die();
            }
        }

    }
endif; // end

if( ! function_exists( 'houzez_update_membership_package' ) ) {
    function houzez_update_membership_package( $user_id, $package_id ) {

        // Get selected package listings
        $pack_listings            =   get_post_meta( $package_id, 'fave_package_listings', true );
        $pack_featured_listings   =   get_post_meta( $package_id, 'fave_package_featured_listings', true );
        $pack_unlimited_listings  =   get_post_meta( $package_id, 'fave_unlimited_listings', true );

        $user_current_posted_listings           =   houzez_get_user_num_posted_listings ( $user_id ); // get user current number of posted listings ( no expired )
        $user_current_posted_featured_listings  =   houzez_get_user_num_posted_featured_listings( $user_id ); // get user number of posted featured listings ( no expired )


        if( houzez_check_user_existing_package_status( $user_id, $package_id ) ) {
            $new_pack_listings           =  $pack_listings;
            $new_pack_featured_listings  =  $pack_featured_listings;
        } else {
            $new_pack_listings           =  $pack_listings - $user_current_posted_listings ;
            $new_pack_featured_listings  =  $pack_featured_listings -  $user_current_posted_featured_listings ;
        }

        if( $new_pack_listings < 0 ) {
            $new_pack_listings = 0;
        }

        if( $new_pack_featured_listings < 0 ) {
            $new_pack_featured_listings = 0;
        }

        if ( $pack_unlimited_listings == 1 ) {
            $new_pack_listings = -1 ;
        }



        update_user_meta( $user_id, 'package_listings', $new_pack_listings) ;
        update_user_meta( $user_id, 'package_featured_listings', $new_pack_featured_listings);


        // Use for user who submit property without having account and membership
        $user_submit_has_no_membership = get_the_author_meta( 'user_submit_has_no_membership', $user_id );
        if( !empty( $user_submit_has_no_membership ) ) {
            houzez_update_package_listings( $user_id );
            houzez_update_property_from_draft( $user_submit_has_no_membership ); // change property status from draft to pending or publish
            delete_user_meta( $user_id, 'user_submit_has_no_membership' );
        }


        $time = time();
        $date = date('Y-m-d H:i:s',$time);
        update_user_meta( $user_id, 'package_activation', $date );
        update_user_meta( $user_id, 'package_id', $package_id );


        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        $message  = esc_html__('Hi there,','houzez') . "\r\n\r\n";
        $message .= sprintf( esc_html__("Your new membership on  %s is activated! You should go check it out.",'houzez'), get_option('blogname')) . "\r\n\r\n";

        $user = get_user_by( 'id', $user_id );
        $user_email = $user->user_email;
        wp_mail($user_email,
            sprintf(esc_html__('[%s] Membership Activated','houzez'), get_option('blogname')),
            $message,
            $headers);
    }
}

if( !function_exists('houzez_user_has_membership') ) {
    function houzez_user_has_membership( $user_id ) {
        $has_package = get_the_author_meta( 'package_id', $user_id );
        $has_listing = get_the_author_meta( 'package_listings', $user_id );
        if( !empty( $has_package ) && ( $has_listing != 0 || $has_listing != '' ) ) {
            return true;
        }
        return false;
    }
}

if( !function_exists('houzez_downgrade_package') ):
    function houzez_downgrade_package( $user_id, $pack_id ) {

        $pack_listings           =  get_post_meta( $pack_id, 'pack_listings', true );
        $pack_featured_listings  =  get_post_meta( $pack_id, 'pack_featured_listings', true );

        update_user_meta( $user_id, 'package_listings', $pack_listings );
        update_user_meta( $user_id, 'package_featured_listings', $pack_featured_listings );

        $args = array(
            'post_type'   => 'property',
            'author'      => $user_id,
            'post_status' => 'any'
        );

        $query = new WP_Query( $args );
        global $post;
        while( $query->have_posts()){
            $query->the_post();

            $property = array(
                'ID'          => $post->ID,
                'post_type'   => 'property',
                'post_status' => 'expired'
            );

            wp_update_post( $property );
            update_post_meta( $post->ID, 'fave_featured', 0 );
        }
        wp_reset_postdata();

        $user = get_user_by( 'id', $user_id );
        $user_email = $user->user_email;

        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        $message  = esc_html__('Account Downgraded,','houzez') . "\r\n\r\n";
        $message .= sprintf( esc_html__("Hello, You downgraded your subscription on  %s. Because your listings number was greater than what the actual package offers, we set the status of all your listings to \"expired\". You will need to choose which listings you want live and send them again for approval. Thank you!",'houzez'), get_option('blogname')) . "\r\n\r\n";

        wp_mail($user_email,
            sprintf(esc_html__('[%s] Account Downgraded','houzez'), get_option('blogname')),
            $message,
            $headers);
    }
endif;

/* -----------------------------------------------------------------------------------------------------------
 *  Save user package record in custom Post type
 -------------------------------------------------------------------------------------------------------------*/
if( !function_exists('houzez_save_user_packages_record') ) {

    function houzez_save_user_packages_record( $userID ) {
        // Create post object

        $args = array(
            'author'        =>  $userID,
            'post_type' => 'user_packages',
            'posts_per_page' => 1
        );
        $current_user_posts = get_posts( $args );

        if( !empty( $current_user_posts ) ) {
            foreach ($current_user_posts as $post) {
                $postID = $post->ID;
            }

            $args = array(
                'ID'           => $postID,
                'post_title' => 'Package ' . $userID,
                'post_type' => 'user_packages',
            );

            // Update the post into the database
            wp_update_post( $args );

        } else {

            $args = array(
                'post_title' => 'Package ' . $userID,
                'post_type' => 'user_packages',
                'post_status' => 'publish'
            );
            // Insert the post into the database
            $post_id = wp_insert_post($args);
            update_post_meta($post_id, 'user_packages_userID', $userID);
        }
    }
}

/* -----------------------------------------------------------------------------------------------------------
 *  Resend Property for Approval
 -------------------------------------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_resend_for_approval', 'houzez_resend_for_approval' );
add_action( 'wp_ajax_houzez_resend_for_approval', 'houzez_resend_for_approval' );

if( !function_exists('houzez_resend_for_approval') ) {

    function houzez_resend_for_approval()
    {

        global $current_user;
        $prop_id = intval($_POST['propid']);

        wp_get_current_user();
        $userID = $current_user->ID;
        $post = get_post($prop_id);

        if ($post->post_author != $userID) {
            wp_die('no kidding');
        }

        $available_listings = get_user_meta($userID, 'package_listings', true);

        if ($available_listings > 0 || $available_listings == -1) {
            $prop = array(
                'ID' => $prop_id,
                'post_type' => 'property',
                'post_status' => 'publish'
            );
            wp_update_post($prop);
            update_post_meta($prop_id, 'fave_featured', 0);

            if ($available_listings != -1) { // if !unlimited
                update_user_meta($userID, 'package_listings', $available_listings - 1);
            }
            echo json_encode(array('success' => true, 'msg' => esc_html__('Reactivated', 'houzez')));

            $submit_title = get_the_title($prop_id);

            $args = array(
                'submission_title' => $submit_title,
                'submission_url' => get_permalink($prop_id)
            );
            //houzez_email_type(get_option('admin_email'), 'admin_expired_listings', $args);


        } else {
            echo json_encode(array('success' => false, 'msg' => esc_html__('No listings available', 'houzez')));
            wp_die();
        }
        wp_die();

    }
}

if( !function_exists('houzez_get_user_current_package') ) {
    function houzez_get_user_current_package( $user_id ) {

        $remaining_listings = houzez_get_remaining_listings( $user_id );
        $pack_featured_remaining_listings = houzez_get_featured_remaining_listings( $user_id );
        $package_id = houzez_get_user_package_id( $user_id );

        if( $remaining_listings == -1 ) {
            $remaining_listings = esc_html__('Unlimited', 'houzez');
        }

        if( !empty( $package_id ) ) {

            $seconds = 0;
            $pack_title = get_the_title( $package_id );
            $pack_listings = get_post_meta( $package_id, 'fave_package_listings', true );
            $pack_unmilited_listings = get_post_meta( $package_id, 'fave_unlimited_listings', true );
            $pack_featured_listings = get_post_meta( $package_id, 'fave_package_featured_listings', true );
            $pack_billing_period = get_post_meta( $package_id, 'fave_billing_time_unit', true );
            $pack_billing_frequency = get_post_meta( $package_id, 'fave_billing_unit', true );
            $pack_date = strtotime ( get_user_meta( $user_id, 'package_activation',true ) );

            switch ( $pack_billing_period ) {
                case 'Day':
                    $seconds = 60*60*24;
                    break;
                case 'Week':
                    $seconds = 60*60*24*7;
                    break;
                case 'Month':
                    $seconds = 60*60*24*30;
                    break;
                case 'Year':
                    $seconds = 60*60*24*365;
                    break;
            }

            $pack_time_frame = $seconds * $pack_billing_frequency;
            $expired_date    = $pack_date + $pack_time_frame;
            $expired_date    = date( 'Y-m-d', $expired_date );

            echo '<div class="my-widget widget-current">';
            echo '<div class="my-title">'.esc_html__( 'Your Current Package', 'houzez' ).'</div>';
            echo '<div class="my-widget-body">';
            echo '<div class="body-inner">';
            echo '<ul>';
            echo '<li><strong>'.esc_attr( $pack_title ).'</strong></li>';

            if( $pack_unmilited_listings == 1 ) {
                echo '<li><span>'.esc_html__('Listings Included: ','houzez').'</span>'.esc_html__('unlimited listings ','houzez').'</li>';
                echo '<li><span>'.esc_html__('Listings Remaining: ','houzez').'</span>'.esc_html__('unlimited listings ','houzez').'</li>';
            } else {
                echo '<li><span>'.esc_html__('Listings Included: ','houzez').'</span>'.esc_attr( $pack_listings ).'</li>';
                echo '<li><span>'.esc_html__('Listings Remaining: ','houzez').'</span><span class="listings_remainings">'.esc_attr( $remaining_listings ).'</span></li>';
            }

            echo '<li><span>'.esc_html__('Featured Included: ','houzez').'</span>'.esc_attr( $pack_featured_listings ).'</li>';
            echo '<li><span>'.esc_html__('Featured Remaining: ','houzez').'</span><span class="featured_listings_remaining">'.esc_attr( $pack_featured_remaining_listings ).'</span></li>';
            echo '<li><span>'.esc_html__('Ends On','houzez').'</span>';
            echo ' '.esc_attr( $expired_date );
            echo '</li>';
            echo '</ul>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

        }
    }
}

/* -----------------------------------------------------------------------------------------------------------
*  Wire Transfer Per Listing
-------------------------------------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_direct_pay_per_listing', 'houzez_direct_pay_per_listing' );
add_action( 'wp_ajax_houzez_direct_pay_per_listing', 'houzez_direct_pay_per_listing' );

if( !function_exists('houzez_direct_pay_per_listing') ) {
    function houzez_direct_pay_per_listing() {
        $current_user = wp_get_current_user();
        if ( !is_user_logged_in() ) {
            exit('Are you kidding?');
        }

        $userID        = $current_user->ID;
        $user_email    = $current_user->user_email ;

        $price_listing_submission = houzez_option('price_listing_submission');
        $price_featured_listing_submission = houzez_option('price_featured_listing_submission');

        $listing_id                = intval($_POST['prop_id']);
        $is_featured               = intval($_POST['is_featured']);
        $is_upgrade                = intval($_POST['is_upgrade']);
        $payment_status            = get_post_meta($listing_id, 'fave_payment_status', true);
        $price_submission          = floatval( $price_listing_submission );
        $price_featured_submission = floatval( $price_featured_listing_submission );
        $currency                  = esc_html( houzez_option('currency_symbol') );
        $where_currency            = esc_html( houzez_option('currency_position') );
        $wire_payment_instruction  = houzez_option('direct_payment_instruction');
        $paymentMethod = 'Direct Bank Transfer';

        $total_price = 0;
        $time = time();
        $date = date('Y-m-d H:i:s', $time);

        $invoiceID = houzez_generate_invoice( 'Listing', 'one_time', $listing_id, $date, $userID, 0, 0, '', $paymentMethod );
        $total_price = $price_submission;

        if ( $total_price != 0 ) {

            if ($where_currency == 'before') {
                $total_price = $currency . ' ' . $total_price;
            } else {
                $total_price = $total_price . ' ' . $currency;
            }
        }

        if (function_exists('icl_translate') ){
            $mes_wire         =  strip_tags( $wire_payment_instruction );
            $payment_details  =  icl_translate('houzez','houzez_wire_payment_instruction_text', $mes_wire );
        }else{
            $payment_details =  strip_tags( $wire_payment_instruction );
        }

        $admin_email   =  get_bloginfo('admin_email');

        // Set Payment status Not Paid
        update_post_meta( $invoiceID, 'invoice_payment_status', 0 );

        $args = array(
            'invoice_no'      =>  $invoiceID,
            'total_price'     =>  $total_price,
            'payment_details' =>  $payment_details,
        );

        /*
         * Send email
         * */
        houzez_email_type( $user_email, 'new_wire_transfer', $args);
        houzez_email_type( $admin_email, 'admin_new_wire_transfer', $args);

        $thankyou_page_link = houzez_get_template_link('template/template-thankyou.php');

        if (!empty($thankyou_page_link)) {
            $separator = (parse_url($thankyou_page_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
            $parameter = 'directy_pay='.$invoiceID;
            print $thankyou_page_link . $separator . $parameter;
        }

        wp_die();
    }
}

/* -----------------------------------------------------------------------------------------------------------
 *  Wire Transfer Activate Purchase Listing
 -------------------------------------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_activate_purchase_listing', 'houzez_activate_purchase_listing' );
add_action( 'wp_ajax_houzez_activate_purchase_listing', 'houzez_activate_purchase_listing' );

if( !function_exists('houzez_activate_purchase_listing') ):
    function houzez_activate_purchase_listing(){
        if ( !is_user_logged_in() ) {
            exit('are you kidding?');
        }
        if ( ! is_admin() ) {
            exit('are you kidding?');
        }

        $itemID         =   intval($_POST['item_id']);
        $invoiceID      =   intval($_POST['invoice_id']);
        $purchase_type  =   intval($_POST['purchase_type']);
        $ownerID        =   get_post_meta($invoiceID, 'invoice_buyer_id', true);

        $user           =   get_user_by('id', $ownerID );
        $user_email     =   $user->user_email;

        if ( $purchase_type == 1 ) {
            update_post_meta( $itemID, 'fave_payment_status', 'paid' );

            $post_args = array(
                'ID'            => $itemID,
                'post_status'   => 'publish'
            );
            $postID =  wp_update_post( $post_args );

        } elseif ( $purchase_type == 2 ) {
            update_post_meta( $itemID, 'fave_featured', 1 );

        } elseif ( $purchase_type == 3 ) {
            update_post_meta( $itemID, 'fave_payment_status', 'paid' );
            update_post_meta( $itemID, 'fave_featured', 1 );

            $post_args = array(
                'ID'            => $itemID,
                'post_status'   => 'publish'
            );
            $postID =  wp_update_post( $post_args );

        }

        update_post_meta( $invoiceID, 'invoice_payment_status', 1 );
        $args = array();

        houzez_email_type( $user_email,'purchase_activated', $args );
        wp_die();
    }

endif;

// Inline
add_action( 'wp_ajax_nopriv_houzez_wire_transfer_per_listing', 'houzez_wire_transfer_per_listing' );
add_action( 'wp_ajax_houzez_wire_transfer_per_listing', 'houzez_wire_transfer_per_listing' );

if( !function_exists('houzez_wire_transfer_per_listing') ) {
    function houzez_wire_transfer_per_listing() {
        $current_user = wp_get_current_user();
        if ( !is_user_logged_in() ) {
            exit('Are you kidding?');
        }

        $userID                     = $current_user->ID;
        $user_email                 = $current_user->user_email ;

        $price_listing_submission = houzez_option('price_listing_submission');
        $price_featured_listing_submission = houzez_option('price_featured_listing_submission');

        $listing_id                 = intval($_POST['prop_id']);
        $is_featured                = intval($_POST['is_featured']);
        $payment_status             = get_post_meta($listing_id, 'fave_payment_status', true);
        $price_submission           = floatval( $price_listing_submission );
        $price_featured_submission  = floatval( $price_featured_listing_submission );
        $currency                   = esc_html( houzez_option('currency_symbol') );
        $where_currency             = esc_html( houzez_option('currency_position') );
        $wire_payment_instruction   = houzez_option('direct_payment_instruction');
        $paymentMethod = 'Direct Bank Transfer';

        $total_price = 0;
        $time = time();
        $date = date('Y-m-d H:i:s', $time);

        if($is_featured == 1 ) {
            if( $payment_status=='paid' ){
                $invoiceID = houzez_generate_invoice( 'Upgrade to Featured', 'one_time', $listing_id, $date, $userID, 0, 1, '', $paymentMethod );
                $total_price = $price_featured_submission;
                //houzez_email_to_admin('email_upgrade');

            }else{
                $invoiceID = houzez_generate_invoice( 'Publish Listing with Featured', 'one_time', $listing_id, $date, $userID, 1, 0, '', $paymentMethod );
                $total_price = $price_submission + $price_featured_submission;
                //houzez_email_to_admin('simple');
            }
        } else {
            $invoiceID = houzez_generate_invoice( 'Listing', 'one_time', $listing_id, $date, $userID, 0, 0, '', $paymentMethod );
            $total_price = $price_submission;
            //houzez_email_to_admin('simple');

        }

        if ( $total_price != 0 ) {

            if ($where_currency == 'before') {
                $total_price = $currency . ' ' . $total_price;
            } else {
                $total_price = $total_price . ' ' . $currency;
            }
        }

        if (function_exists('icl_translate') ){
            $mes_wire         =  strip_tags( $wire_payment_instruction );
            $payment_details  =  icl_translate('houzez','houzez_wire_payment_instruction_text', $mes_wire );
        }else{
            $payment_details =  strip_tags( $wire_payment_instruction );
        }

        $admin_email   =  get_bloginfo('admin_email');

        // Set Payment status Not Paid
        update_post_meta( $invoiceID, 'invoice_payment_status', 0 );

        $args = array(
            'invoice_no'      =>  $invoiceID,
            'total_price'     =>  $total_price,
            'payment_details' =>  $payment_details,
        );

        /*
         * Send email
         * */
        houzez_email_type( $user_email, 'new_wire_transfer', $args);
        houzez_email_type( $admin_email, 'admin_new_wire_transfer', $args);

        wp_die();
    }
}



/* -----------------------------------------------------------------------------------------------------------
*  Wire Transfer direct pay package
-------------------------------------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_direct_pay_package', 'houzez_direct_pay_package' );
add_action( 'wp_ajax_houzez_direct_pay_package', 'houzez_direct_pay_package' );

if( !function_exists('houzez_direct_pay_package') ) {

    function houzez_direct_pay_package() {
        global $current_user;

        $current_user = wp_get_current_user();

        if (!is_user_logged_in()) {
            exit('Are you kidding?');
        }

        $userID = $current_user->ID;
        $user_email = $current_user->user_email;
        $selected_pack = intval($_POST['selected_package']);
        $total_price = get_post_meta($selected_pack, 'fave_package_price', true);
        $currency = esc_html(houzez_option('currency_symbol'));
        $where_currency = esc_html(houzez_option('currency_position'));
        $wire_payment_instruction = houzez_option('direct_payment_instruction');
        $is_featured = 0;
        $is_upgrade = 0;
        $paypal_tax_id = '';
        $paymentMethod = 'Direct Bank Transfer';
        $time = time();
        $date = date('Y-m-d H:i:s', $time);

        if ($total_price != 0) {
            if ($where_currency == 'before') {
                $total_price = $currency . ' ' . $total_price;
            } else {
                $total_price = $total_price . ' ' . $currency;
            }
        }

        // insert invoice
        $invoiceID = houzez_generate_invoice('package', 'one_time', $selected_pack, $date, $userID, $is_featured, $is_upgrade, $paypal_tax_id, $paymentMethod);


        if (function_exists('icl_translate')) {
            $mes_wire = strip_tags($wire_payment_instruction);
            $payment_details = icl_translate('houzez', 'houzez_wire_payment_instruction_text', $mes_wire);
        } else {
            $payment_details = strip_tags($wire_payment_instruction);
        }

        update_post_meta($invoiceID, 'invoice_payment_status', 0);

        $admin_email      =  get_bloginfo('admin_email');

        $args = array(
            'invoice_no'      =>  $invoiceID,
            'total_price'     =>  $total_price,
            'payment_details' =>  $payment_details,
        );

        /*
         * Send email
         * */
        houzez_email_type( $user_email, 'new_wire_transfer', $args);
        houzez_email_type( $admin_email, 'admin_new_wire_transfer', $args);

        $thankyou_page_link = houzez_get_template_link('template/template-thankyou.php');

        if (!empty($thankyou_page_link)) {
            $separator = (parse_url($thankyou_page_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
            $parameter = 'directy_pay='.$invoiceID;
            print $thankyou_page_link . $separator . $parameter;
        }
        wp_die();
    }
}


/* -----------------------------------------------------------------------------------------------------------
*  Free Membership package
-------------------------------------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_free_membership_package', 'houzez_free_membership_package' );
add_action( 'wp_ajax_houzez_free_membership_package', 'houzez_free_membership_package' );

if( !function_exists('houzez_free_membership_package') ) {

    function houzez_free_membership_package() {

        global $current_user;
        $current_user = wp_get_current_user();

        if (!is_user_logged_in()) {
            exit('Are you kidding?');
        }

        $userID = $current_user->ID;
        $user_email = $current_user->user_email;
        $selected_pack = intval($_POST['selected_package']);
        $total_price = get_post_meta($selected_pack, 'fave_package_price', true);
        $currency = esc_html(houzez_option('currency_symbol'));
        $where_currency = esc_html(houzez_option('currency_position'));
        $wire_payment_instruction = houzez_option('direct_payment_instruction');
        $is_featured = 0;
        $is_upgrade = 0;
        $paypal_tax_id = '';
        $paymentMethod = '';
        $time = time();
        $date = date('Y-m-d H:i:s', $time);

        if ($total_price != 0) {
            if ($where_currency == 'before') {
                $total_price = $currency . ' ' . $total_price;
            } else {
                $total_price = $total_price . ' ' . $currency;
            }
        }

        // insert invoice
        $invoiceID = houzez_generate_invoice('package', 'one_time', $selected_pack, $date, $userID, $is_featured, $is_upgrade, $paypal_tax_id, $paymentMethod);

        houzez_save_user_packages_record($userID);
        houzez_update_membership_package($userID, $selected_pack);
        update_post_meta( $invoiceID, 'invoice_payment_status', 1 );
        update_user_meta( $userID, 'user_had_free_package', 'yes' );


        $admin_email      =  get_bloginfo('admin_email');

        $args = array(
            'invoice_no'      =>  $invoiceID,
            'total_price'     =>  $total_price,
        );

        /*
         * Send email
         * */
        //houzez_email_type( $user_email, 'new_wire_transfer', $args);
        //houzez_email_type( $admin_email, 'admin_new_wire_transfer', $args);

        $thankyou_page_link = houzez_get_template_link('template/template-thankyou.php');

        if (!empty($thankyou_page_link)) {
            $separator = (parse_url($thankyou_page_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
            $parameter = 'free_package='.$invoiceID;
            print $thankyou_page_link . $separator . $parameter;
        }
        wp_die();
    }
}


/* -----------------------------------------------------------------------------------------------------------
*  Recurring paypal payment
-------------------------------------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_recuring_paypal_package_payment', 'houzez_recuring_paypal_package_payment' );
add_action( 'wp_ajax_houzez_recuring_paypal_package_payment', 'houzez_recuring_paypal_package_payment' );

if( !function_exists('houzez_recuring_paypal_package_payment') ) {
    function houzez_recuring_paypal_package_payment(){
        global $current_user;

        $current_user = wp_get_current_user();
        $userID = $current_user->ID;

        if ( !is_user_logged_in() ) {
            wp_die('are you kidding?');
        }

        if( $userID === 0 ) {
            wp_die('are you kidding?');
        }

        $allowed_html=array();
        $houzez_package_name  = wp_kses($_POST['houzez_package_name'],$allowed_html);
        $houzez_package_id    = intval($_POST['houzez_package_id']);
        $is_package_exist     = get_posts('post_type=houzez_packages&p='.$houzez_package_id);
        $submission_curency   = houzez_option('currency_paid_submission');
        $dash_profile_link    = houzez_get_dashboard_profile_link();
        $thankyou_page_link = houzez_get_template_link('template/template-thankyou.php');

        $paypal_api_username = houzez_option('paypal_api_username');
        $paypal_api_password = houzez_option('paypal_api_password');
        $paypal_api_signature = houzez_option('paypal_api_signature');

        if( !empty ( $is_package_exist ) ) {

            require( get_template_directory() . '/framework/paypal-recurring/class.paypal.recurring.php' );
            global $current_user;

            $packPrice          =  get_post_meta( $houzez_package_id, 'fave_package_price', true );
            $billingPeriod      =  get_post_meta( $houzez_package_id, 'fave_billing_time_unit', true );
            $billingFreq        =  intval( get_post_meta( $houzez_package_id, 'fave_billing_unit', true ) );
            $submissionCurency  =  esc_html( $submission_curency );
            $environment        = houzez_option('paypal_api');

            $obj = new houzez_paypal_recurring;

            $obj->environment               =   esc_html( $environment );
            $obj->paymentType               =   urlencode('Sale');
            $obj->productDesc               =   urlencode( $houzez_package_name.__(' package on ','houzez').get_bloginfo('name') );
            $time                           =   time();
            $date                           =   date('Y-m-d H:i:s',$time);
            $obj->startDate                 =   urlencode($date);
            $obj->billingPeriod             =   urlencode($billingPeriod);
            $obj->billingFreq               =   urlencode($billingFreq);
            $obj->paymentAmount             =   urlencode($packPrice);
            $obj->currencyID                =   urlencode($submissionCurency);
            $obj->API_UserName              =   urlencode( $paypal_api_username );
            $obj->API_Password              =   urlencode( $paypal_api_password );
            $obj->API_Signature             =   urlencode( $paypal_api_signature );
            $obj->API_Endpoint              =   "https://api-3t.paypal.com/nvp";
            $obj->returnURL                 =   urlencode($thankyou_page_link);
            $obj->cancelURL                 =   urlencode($dash_profile_link);
            $executor['payment_execute_url'] =   '';
            $executor['access_token']       =   '';
            $executor['package_id']            =   $houzez_package_id;
            $executor['recursive']          =   1;
            $executor['date']               =   $date;
            $save_data[$current_user->ID ]  =   $executor;
            update_option('houzez_paypal_package_transfer', $save_data);
            update_user_meta($userID, 'houzez_paypal_package', $save_data);

            $obj->setExpressCheckout();
        }
    }
}

/* -----------------------------------------------------------------------------------------------------------
*  Active direct pay package
-------------------------------------------------------------------------------------------------------------*/
add_action( 'wp_ajax_nopriv_houzez_activate_pack_purchase', 'houzez_activate_pack_purchase' );
add_action( 'wp_ajax_houzez_activate_pack_purchase', 'houzez_activate_pack_purchase' );

if( !function_exists('houzez_activate_pack_purchase') ) {
    function houzez_activate_pack_purchase()
    {
        if (!is_user_logged_in()) {
            exit('are you kidding?');
        }
        if (!is_admin()) {
            exit('are you kidding?');
        }


        $packID = intval($_POST['item_id']);
        $invoiceID = intval($_POST['invoice_id']);
        $userID = get_post_meta($invoiceID, 'HOUZEZ_invoice_buyer', true);

        $ownerID        =   get_post_meta($invoiceID, 'invoice_buyer_id', true);

        $user           =   get_user_by('id', $ownerID );
        $user_email     =   $user->user_email;


        houzez_save_user_packages_record($userID);
        if( houzez_check_user_existing_package_status( $userID, $packID) ){
            houzez_downgrade_package( $userID, $packID );
            houzez_update_membership_package($userID, $packID);
        }else{
            houzez_update_membership_package($userID, $packID);
        }

        update_post_meta($invoiceID, 'invoice_payment_status', 1);

        $args = array();

        houzez_email_type( $user_email,'purchase_activated_pack', $args );
        wp_die();
    }
}

if( !function_exists('houzez_get_remaining_listings') ) {
    function houzez_get_remaining_listings($user_id) {
        return get_the_author_meta( 'package_listings' , $user_id );
    }
}

if( !function_exists('houzez_get_featured_remaining_listings') ) {
    function houzez_get_featured_remaining_listings($user_id) {
        return get_the_author_meta( 'package_featured_listings' , $user_id );
    }
}

if( !function_exists('houzez_get_user_package_id') ) {
    function houzez_get_user_package_id($user_id) {
        return get_the_author_meta( 'package_id', $user_id );
    }
}

if( !function_exists('houzez_update_package_listings') ) {
    function houzez_update_package_listings($user_id) {
        $package_listings = get_the_author_meta( 'package_listings' , $user_id );
        $user_submit_has_no_membership = get_the_author_meta( 'user_submit_has_no_membership', $user_id );

        if ( $package_listings-1 >= 0 ) {
            if( empty($user_submit_has_no_membership) ) {
                update_user_meta($user_id, 'package_listings', $package_listings - 1);
            } else {
                update_user_meta($user_id, 'package_listings', $package_listings );
            }
        } else if( $package_listings == 0 ) {
            update_user_meta( $user_id, 'package_listings', 0 ) ;
        }
    }
}

if( !function_exists('houzez_user_had_free_package') ) {
    function houzez_user_had_free_package($user_id) {
        $free_package = get_the_author_meta( 'user_had_free_package' , $user_id );

        if ( $free_package == 'yes' ) {
            return false;
        }
        return true;
    }
}

if( !function_exists('houzez_update_user_recuring_paypal_profile') ) {
    function houzez_update_user_recuring_paypal_profile( $profileID, $userID ) {
        $profileID = str_replace('-', 'xxx', $profileID);
        $profileID = str_replace('%2d', 'xxx', $profileID);

        update_user_meta( $userID, 'fave_paypal_profile', $profileID );

    }
}

if( !function_exists('houzez_update_package_featured_listings') ) {
    function houzez_update_package_featured_listings($user_id) {
        $package_featured_listings = get_the_author_meta( 'package_featured_listings' , $user_id );

        if ( $package_featured_listings-1 >= 0 ) {
            update_user_meta( $user_id, 'package_featured_listings', $package_featured_listings - 1 );
        } else if( $package_featured_listings == 0 ) {
            update_user_meta( $user_id, 'package_featured_listings', 0 ) ;
        }
    }
}


if( !function_exists('houzez_check_user_existing_package_status') ) {
    function  houzez_check_user_existing_package_status( $userID, $packID ) {

        $pack_listings            =  get_post_meta( $packID, 'fave_package_listings', true );
        $pack_featured_listings   =  get_post_meta( $packID, 'fave_package_featured_listings', true );
        $pack_unlimited_listings  =  get_post_meta( $packID, 'fave_unlimited_listings', true );

        $user_num_posted_listings = houzez_get_user_num_posted_listings( $userID );
        $user_num_posted_featured_listings = houzez_get_user_num_posted_featured_listings( $userID );

        $current_listings =  get_user_meta( $userID, 'package_listings', true ) ;

        if( $pack_unlimited_listings == 1 ) {
            return false;
        }

        // if is unlimited and go to non unlimited pack
        if ( $current_listings == -1 && $pack_unlimited_listings != 1 ) {
            return true;
        }

        if ( ( $user_num_posted_listings > $pack_listings ) || ( $user_num_posted_featured_listings > $pack_featured_listings ) ) {
            return true;
        } else {
            return false;
        }


    }
}

if( !function_exists('houzez_get_user_num_posted_listings') ):
    function houzez_get_user_num_posted_listings( $userID ) {
        $args = array(
            'post_type'   => 'property',
            'post_status' => 'any',
            'author'      => $userID,

        );
        $posts = new WP_Query( $args );
        return $posts->found_posts;
        wp_reset_postdata();
    }
endif;

/* -----------------------------------------------------------------------------------------------------------
 *  Get user current featured listings
 -------------------------------------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_user_num_posted_featured_listings') ):
    function houzez_get_user_num_posted_featured_listings( $userID ) {

        $args = array(
            'post_type'     =>  'property',
            'post_status'   =>  'any',
            'author'        =>  $userID,
            'meta_query'    =>  array(
                array(
                    'key'   => 'fave_featured',
                    'value' => 1,
                    'meta_compare '=>'='
                )
            )
        );
        $posts = new WP_Query( $args );
        return $posts->found_posts;
        wp_reset_postdata();

    }
endif;

if( !function_exists('houzez_retrive_user_by_profile') ) {
    function houzez_retrive_user_by_profile($recurring_payment_id)
    {
        if ($recurring_payment_id != '') {
            $recurring_payment_id = str_replace('-', 'xxx', $recurring_payment_id);
            $arg = array(
                'meta_key' => 'fave_paypal_profile',
                'meta_value' => $recurring_payment_id,
                'meta_compare' => '='
            );

            $userid = 0;
            $houzezusers = get_users($arg);
            foreach ($houzezusers as $user) {
                $userid = $user->ID;
            }
            return $userid;
        } else {
            return 0;
        }
    }
}

if( !function_exists('houzez_retrive_invoice_by_taxid') ) {
    function houzez_retrive_invoice_by_taxid($tax_id)
    {
        $args = array(
            'post_type' => 'houzez_invoice',
            'meta_query' => array(
                array(
                    'key' => 'HOUZEZ_paypal_txn_id',
                    'value' => $tax_id,
                    'compare' => '='
                )
            )
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            return true;
        } else {
            return false;
        }
    }
}