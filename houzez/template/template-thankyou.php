<?php
/**
 * Template Name: Thank You & Payment Process complete
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 06/09/16
 * Time: 5:50 PM
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

global $houzez_local, $current_user;
wp_get_current_user();
$userID = $current_user->ID;
$user_email = $current_user->user_email;
$admin_email      =  get_bloginfo('admin_email');

$allowed_html   =   array();
$listings_admin_approved = houzez_option('listings_admin_approved');
$enable_paid_submission = houzez_option('enable_paid_submission');
$dash_profile_link = houzez_get_dashboard_profile_link();


if( $enable_paid_submission == 'per_listing' ) {

    $price_per_submission = houzez_option('price_listing_submission');
    $price_featured_submission = houzez_option('price_featured_listing_submission');
    $currency = houzez_option('currency_paid_submission');

    $is_paypal_live  =   houzez_option('paypal_api');
    $host            =   'https://api.sandbox.paypal.com';

    if( $is_paypal_live == 'live' ){
        $host = 'https://api.paypal.com';
    }

    $return_link            =   houzez_get_template_link('template/template-thankyou.php');
    $clientId               =   houzez_option('paypal_client_id');
    $clientSecret           =   houzez_option('paypal_client_secret_key');
    $price_per_submission   =   floatval( $price_per_submission );
    $price_per_submission   =   number_format($price_per_submission, 2, '.', '');
    $submission_curency     =   esc_html( $currency );
    $headers                =   'From: My Name <myname@example.com>' . "\r\n";


    if ( isset($_GET['token']) && isset($_GET['PayerID']) ){
        $token    = wp_kses ( $_GET['token'], $allowed_html );
        $payerID  = wp_kses ( $_GET['PayerID'] ,$allowed_html);

        /* Get saved data in database during execution
         -----------------------------------------------*/
        $transfered_data = get_option('houzez_paypal_transfer');
        $prop_id             = $transfered_data[ $userID ]['property_id'];
        $payment_execute_url = $transfered_data[ $userID ]['payment_execute_url'];
        $token               = $transfered_data[ $userID ]['paypal_token'];
        $is_prop_featured    = $transfered_data[ $userID ]['is_prop_featured'];
        $is_prop_upgrade     = $transfered_data[ $userID ]['is_prop_upgrade'];

        $payment_execute = array(
            'payer_id' => $payerID
        );

        $json           = json_encode( $payment_execute );
        $json_response  = houzez_execute_paypal_request( $payment_execute_url, $json, $token );

        $transfered_data[$current_user->ID ]  =   array();
        update_option ('houzez_paypal_transfer',$transfered_data);
        $paymentMethod = 'Paypal';

        //print_r($json_response);
        if( $json_response['state']=='approved' ) {

            $time = time();
            $date = date( 'Y-m-d H:i:s', $time );

            if( $is_prop_upgrade == 1 ) {

                $invoiceID = houzez_generate_invoice( 'Upgrade to Featured','one_time', $prop_id, $date, $userID, 0, 1, '', $paymentMethod );
                update_post_meta( $invoiceID, 'invoice_payment_status', 1 );
                update_post_meta( $prop_id, 'fave_featured', 1 );
                //houzez_email_to_admin('email_upgrade');

                $args = array(
                    'listing_title'  =>  get_the_title($prop_id),
                    'listing_id'     =>  $prop_id,
                    'invoice_no' =>  $invoiceID,
                );

                /*
                 * Send email
                 * */
                houzez_email_type( $user_email, 'featured_submission_listing', $args);
                houzez_email_type( $admin_email, 'admin_featured_submission_listing', $args);

            } else {

                update_post_meta( $prop_id, 'fave_payment_status', 'paid' );

                if( $listings_admin_approved != 'yes'  && $paid_submission_status == 'per_listing' ){
                    $post = array(
                        'ID'            => $prop_id,
                        'post_status'   => 'publish'
                    );
                    $post_id =  wp_update_post($post );
                }  else {
                    $post = array(
                        'ID'            => $prop_id,
                        'post_status'   => 'pending'
                    );
                    $post_id =  wp_update_post($post );
                }

                if( $is_prop_featured == 1 ) {
                    update_post_meta( $prop_id, 'fave_featured', 1 );
                    $invoiceID = houzez_generate_invoice( 'Listing with Featured','one_time', $prop_id, $date, $userID, 1, 0, '', $paymentMethod );
                } else {
                    $invoiceID = houzez_generate_invoice( 'Listing','one_time', $prop_id, $date, $userID, 0, 0, '', $paymentMethod );
                }

                update_post_meta( $invoiceID, 'invoice_payment_status', 1 );

                $args = array(
                    'listing_title'  =>  get_the_title($prop_id),
                    'listing_id'     =>  $prop_id,
                    'invoice_no' =>  $invoiceID,
                );

                /*
                 * Send email
                 * */
                houzez_email_type( $user_email, 'paid_submission_listing', $args);
                houzez_email_type( $admin_email, 'admin_paid_submission_listing', $args);
            }

        }
    }

}  // end perlisting

else if( $enable_paid_submission == 'membership' ) {
    /*-----------------------------------------------------------------------------------*/
    // Paypal payments for membeship packages
    /*-----------------------------------------------------------------------------------*/
    if (isset($_GET['token'])) {
        $allowed_html = array();
        $token = wp_kses($_GET['token'], $allowed_html);
        $token_recursive = wp_kses($_GET['token'], $allowed_html);
        $paymentMethod = 'Paypal';
        $time = time();
        $date = date('Y-m-d H:i:s',$time);

        // get transfer data
        $save_data = get_option('houzez_paypal_package_transfer');
        $payment_execute_url = $save_data[$userID]['payment_execute_url'];
        $token = $save_data[$userID]['access_token'];
        $pack_id = $save_data[$userID]['package_id'];
        $recursive = 0;
        if (isset ($save_data[$userID]['recursive'])) {
            $recursive = $save_data[$userID]['recursive'];
        }

        if ($recursive != 1) {
            if (isset($_GET['PayerID'])) {
                $payerId = wp_kses($_GET['PayerID'], $allowed_html);

                $payment_execute = array(
                    'payer_id' => $payerId
                );
                $json = json_encode($payment_execute);
                $json_resp = houzez_execute_paypal_request($payment_execute_url, $json, $token);

                $save_data[$current_user->ID] = array();
                update_option('houzez_paypal_package_transfer', $save_data);
                update_user_meta($userID, 'houzez_paypal_package', $save_data);

                if ($json_resp['state'] == 'approved') {

                    houzez_save_user_packages_record($userID);
                    //houzez_update_membership_package($userID, $pack_id);
                    if( houzez_check_user_existing_package_status( $current_user->ID, $pack_id ) ){
                        houzez_downgrade_package( $current_user->ID, $pack_id );
                        houzez_update_membership_package( $userID, $pack_id);
                    }else{
                        houzez_update_membership_package($userID, $pack_id);
                    }

                    $invoiceID = houzez_generate_invoice( 'package', 'one_time', $pack_id, $date, $userID, 0, 0, '', $paymentMethod );
                    update_post_meta( $invoiceID, 'invoice_payment_status', 1 );

                    $args = array();

                    houzez_email_type( $user_email,'purchase_activated_pack', $args );

                }
            } //end if Get
         //end recursive if condition
        } else {

            require( get_template_directory() . '/framework/paypal-recurring/class.paypal.recurring.php' );

            $billingPeriod = get_post_meta( $pack_id, 'fave_billing_time_unit', true );
            $billingFreq   = intval( get_post_meta( $pack_id, 'fave_billing_unit', true ) );
            $packPrice     = get_post_meta( $pack_id, 'fave_package_price', true );
            $packName      = get_the_title($pack_id);
            $environment   = houzez_option('paypal_api');
            $thankyou_page_link = houzez_get_template_link('template/template-thankyou.php');

            $paypal_api_username  = houzez_option('paypal_api_username');
            $paypal_api_password  = houzez_option('paypal_api_password');
            $paypal_api_signature = houzez_option('paypal_api_signature');
            $submission_curency   = houzez_option('currency_paid_submission');

            $date                 = $save_data[$current_user->ID ]['date'];

            $obj = new houzez_paypal_recurring;

            $obj->environment   = esc_html( $environment );
            $obj->paymentType   = urlencode('Sale');          // or 'Sale' or 'Order'
            $obj->API_UserName  = urlencode( $paypal_api_username );
            $obj->API_Password  = urlencode( $paypal_api_password );
            $obj->API_Signature = urlencode( $paypal_api_signature );
            $obj->API_Endpoint  = "https://api-3t.paypal.com/nvp";
            $obj->paymentType   = urlencode('Sale');
            $obj->returnURL     = urlencode($thankyou_page_link);
            $obj->cancelURL     = urlencode($dash_profile_link);
            $obj->paymentAmount = $packPrice;
            $obj->currencyID    = $submission_curency;
            $obj->startDate     = urlencode($date);
            $obj->billingPeriod = urlencode($billingPeriod);
            $obj->billingFreq   = urlencode($billingFreq);
            $obj->productDesc   = urlencode($packName.__(' package on ','houzez').get_bloginfo('name') );
            $obj->userID       = $current_user->ID;
            $obj->packID       = $pack_id;

            if ( $obj->getExpressCheckout($token_recursive) ) {

                houzez_save_user_packages_record($userID);
                //houzez_update_membership_package($userID, $pack_id);
                if( houzez_check_user_existing_package_status( $current_user->ID, $pack_id ) ) {
                    houzez_downgrade_package( $current_user->ID, $pack_id );
                    houzez_update_membership_package( $userID, $pack_id );
                }else{
                    houzez_update_membership_package( $userID, $pack_id );
                }

                $invoiceID = houzez_generate_invoice( 'package', 'recurring', $pack_id, $date, $userID, 0, 0, '', $paymentMethod );
                update_post_meta( $invoiceID, 'invoice_payment_status', 1 );

                $args = array();

                houzez_email_type( $user_email,'purchase_activated_pack', $args );

                wp_redirect( $thankyou_page_link );
                exit;
            }

        } // End else

    }
}
get_header();
?>

<div class="membership-page-top">
    <?php get_template_part( 'template-parts/create-listing-top' ); ?>
</div>

<div class="membership-content-area">
    <div class="membership-done-block white-block">
        <div class="done-block-inner">
            <div class="done-icon"><i class="fa fa-check"></i></div>
            <?php
            if( isset( $_GET['directy_pay'] ) && $_GET['directy_pay'] != '' ) {
                $orderID = $_GET['directy_pay'];
                $invoice_meta = houzez_get_invoice_meta( $orderID );
                ?>
                <h2><?php echo houzez_option('thankyou_wire_title'); ?></h2>
                <ul style="text-align: left;">
                    <li><?php echo $houzez_local['order_number'].':'; ?> <strong><?php echo esc_attr($orderID); ?></strong> </li>
                    <li><?php echo $houzez_local['date'].':'; ?> <strong><?php echo get_the_date('', $orderID); ?></strong> </li>
                    <li><?php echo $houzez_local['total'].':'; ?> <strong><?php echo houzez_get_invoice_price( $invoice_meta['invoice_item_price'] );?></strong> </li>
                    <li><?php echo $houzez_local['payment_method'].':'; ?>
                        <strong>
                            <?php if( $invoice_meta['invoice_payment_method'] == 'Direct Bank Transfer' ) {
                                echo $houzez_local['bank_transfer'];
                            } else {
                                echo $invoice_meta['invoice_payment_method'];
                            } ?>
                        </strong>
                    </li>
                </ul>
                <p> <?php echo houzez_option('thankyou_wire_des'); ?></p>
            <?php
            } else {
                echo '<h2>';
                echo houzez_option('thankyou_title');
                echo '</h2>';
                echo '<p>';
                echo houzez_option('thankyou_des');
                echo '</p>';
            }
            ?>
            <a href="<?php echo esc_url( $dash_profile_link ); ?>" class="btn btn-primary btn-long"> <?php echo $houzez_local['goto_dash']; ?> </a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
