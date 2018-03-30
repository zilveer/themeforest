<?php

/**
 * PayPal API
 */
if ( ! class_exists('WPCAds_PayPalAPI') ) {

    class WPCAds_PayPalAPI {
  
        /**
         * Start express checkout
         */
        function StartExpressCheckout() {

            global $redux_demo; 
            $paypal_api_environment = $redux_demo['paypal_api_environment'];
            $paypal_success = $redux_demo['paypal_success'];
            $paypal_fail = $redux_demo['paypal_fail'];
            $paypal_api_username = $redux_demo['paypal_api_username'];
            $paypal_api_password = $redux_demo['paypal_api_password'];
            $paypal_api_signature = $redux_demo['paypal_api_signature'];
          
            if ( $paypal_api_environment != '1' && $paypal_api_environment != '2' )
                trigger_error('Environment does not defined! Please define it at the plugin configuration page!', E_USER_ERROR);
          
            /*if ( $paypal_fail === FALSE || ! is_numeric($paypal_fail) )
                trigger_error('Cancel page not defined! Please define it at the plugin configuration page!', E_USER_ERROR);
          
            if ( $paypal_success === FALSE || ! is_numeric($paypal_success) )
                trigger_error('Success page not defined! Please define it at the plugin configuration page!', E_USER_ERROR);*/

            global $wpdb;
            $result = $wpdb->get_results( "SELECT * FROM td_url" );

            foreach ( $result as $info ) {
                $url = $info->url;
            }

            global $redux_demo;
            $currency_code = $redux_demo['currency-code'];

            $planID        = $_POST['paypal-payment-package'];
            $planPACKAGE = get_the_title( $planID );
            $package_price = get_post_meta($planID, 'package_price', true);
          
            // FIELDS
            $fields = array(
                'USER' => urlencode($paypal_api_username),
                'PWD' => urlencode($paypal_api_password),
                'SIGNATURE' => urlencode($paypal_api_signature),
                'VERSION' => urlencode('72.0'),
                'PAYMENTREQUEST_0_PAYMENTACTION' => urlencode('Sale'),
                'PAYMENTREQUEST_0_AMT0' => $package_price,
                'PAYMENTREQUEST_0_CUSTOM' => $_POST['PAYMENTREQUEST_0_CUSTOM'],
                'PAYMENTREQUEST_0_AMT' => $package_price,
                'PAYMENTREQUEST_0_ITEMAMT' => $package_price,
                'ITEMAMT' => $package_price,
                'PAYMENTREQUEST_0_CURRENCYCODE' => $currency_code,
                'RETURNURL' => urlencode( $url.'/inc/payments/paypal/form-handler.php?func=confirm'),
                'CANCELURL' => urlencode(get_permalink($paypal_fail)),
                'METHOD' => urlencode('SetExpressCheckout')
            );

            $fields['PAYMENTREQUEST_0_CUSTOM'] = $_POST['PAYMENTREQUEST_0_CUSTOM'];
          
            if ( isset($_POST['PAYMENTREQUEST_0_DESC']) )
                $fields['PAYMENTREQUEST_0_DESC'] = $planPACKAGE;
          
            if ( isset($_POST['RETURN_URL']) )
                $_SESSION['RETURN_URL'] = $_POST['RETURN_URL'];
          
            if ( isset($_POST['CANCEL_URL']) )
                $fields['CANCELURL'] = $_POST['CANCEL_URL'];
          
            $fields['PAYMENTREQUEST_0_QTY0'] = 1;
            $fields['PAYMENTREQUEST_0_AMT'] = $package_price;
          
          
            if ( isset($_POST['TAXAMT']) ) {
                $fields['PAYMENTREQUEST_0_TAXAMT'] = $_POST['TAXAMT'];
                $fields['PAYMENTREQUEST_0_AMT'] += $_POST['TAXAMT'];
            }
          
                
            if ( isset($_POST['HANDLINGAMT']) ) {
                $fields['PAYMENTREQUEST_0_HANDLINGAMT'] = $_POST['HANDLINGAMT'];
                $fields['PAYMENTREQUEST_0_AMT'] += $_POST['HANDLINGAMT'];
            }
                
            if ( isset($_POST['SHIPPINGAMT']) ) {
                $fields['PAYMENTREQUEST_0_SHIPPINGAMT'] = $_POST['SHIPPINGAMT'];
                $fields['PAYMENTREQUEST_0_AMT'] += $_POST['SHIPPINGAMT'];
            }
          
            $fields_string = '';

            foreach ( $fields as $key => $value ) 
                $fields_string .= $key.'='.$value.'&';
            
            rtrim($fields_string,'&');
          
            // CURL
            $ch = curl_init();
          
            if ( $paypal_api_environment == '1' )
                curl_setopt($ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
            elseif ( $paypal_api_environment == '2' )
                curl_setopt($ch, CURLOPT_URL, 'https://api-3t.paypal.com/nvp');
            
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          
            //execute post
            $result = curl_exec($ch);
          
            //close connection
            curl_close($ch);
          
            parse_str($result, $result);
          
            if ( $result['ACK'] == 'Success' ) {
            
                if ( $paypal_api_environment == '1' )
                    header('Location: https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token='.$result['TOKEN']);
                elseif ( $paypal_api_environment == '2' )
                    header('Location: https://www.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token='.$result['TOKEN']);
                exit;
            
            } else {
                print_r($result);
            }
          
        }
        
        /**
         * Validate payment
         */
        function ConfirmExpressCheckout() {
        
            global $redux_demo; 
            $paypal_api_environment = $redux_demo['paypal_api_environment'];
            $paypal_success = $redux_demo['paypal_success'];
            $paypal_fail = $redux_demo['paypal_fail'];
            $paypal_api_username = $redux_demo['paypal_api_username'];
            $paypal_api_password = $redux_demo['paypal_api_password'];
            $paypal_api_signature = $redux_demo['paypal_api_signature'];
          
            // FIELDS
            $fields = array(
                'USER' => urlencode($paypal_api_username),
                'PWD' => urlencode($paypal_api_password),
                'SIGNATURE' => urlencode($paypal_api_signature),
                'VERSION' => urlencode('72.0'),
                'TOKEN' => urlencode($_GET['token']),
                'METHOD' => urlencode('GetExpressCheckoutDetails')
            );
          
            $fields_string = '';
            foreach ( $fields as $key => $value )
                $fields_string .= $key.'='.$value.'&';
            rtrim($fields_string,'&');
          
            // CURL
            $ch = curl_init();
          
            if ( $paypal_api_environment == '1' )
                curl_setopt($ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
            elseif ( $paypal_api_environment == '2' )
                curl_setopt($ch, CURLOPT_URL, 'https://api-3t.paypal.com/nvp');
            
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
          
            parse_str($result, $result);
          
            if ( $result['ACK'] == 'Success' ) {
                WPCAds_PayPalAPI::SavePayment($result, 'pending');
                WPCAds_PayPalAPI::DoExpressCheckout($result);
            } else {
                WPCAds_PayPalAPI::SavePayment($result, 'failed');
            }
        }
        
        /**
         * Close transaction
         */
        function DoExpressCheckout($result) {
        
            global $redux_demo; 
            $paypal_api_environment = $redux_demo['paypal_api_environment'];
            $paypal_success = $redux_demo['paypal_success'];
            $paypal_fail = $redux_demo['paypal_fail'];
            $paypal_api_username = $redux_demo['paypal_api_username'];
            $paypal_api_password = $redux_demo['paypal_api_password'];
            $paypal_api_signature = $redux_demo['paypal_api_signature'];
        
            // FIELDS
            $fields = array(
                'USER' => urlencode($paypal_api_username),
                'PWD' => urlencode($paypal_api_password),
                'SIGNATURE' => urlencode($paypal_api_signature),
                'VERSION' => urlencode('72.0'),
                'PAYMENTREQUEST_0_PAYMENTACTION' => urlencode('Sale'),
                'PAYERID' => urlencode($result['PAYERID']),
                'TOKEN' => urlencode($result['TOKEN']),
                'PAYMENTREQUEST_0_AMT' => urlencode($result['AMT']),
                'METHOD' => urlencode('DoExpressCheckoutPayment')
            );
          
            $fields_string = '';
            foreach ( $fields as $key => $value)
                $fields_string .= $key.'='.$value.'&';
            rtrim($fields_string,'&');
          
            // CURL
            $ch = curl_init();
          
            if ( $paypal_api_environment == '1' )
                curl_setopt($ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
            elseif ( $paypal_api_environment == '2' )
                curl_setopt($ch, CURLOPT_URL, 'https://api-3t.paypal.com/nvp');
          
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
          
            parse_str($result, $result);
          
            if ( $result['ACK'] == 'Success' ) {
                WPCAds_PayPalAPI::UpdatePayment($result, 'success');
            } else {
                WPCAds_PayPalAPI::UpdatePayment($result, 'failed');
            }
        }
        
        /**
         * Save payment result into database
         */
        function SavePayment($result, $status) {

            global $wpdb;

            $update_data = array('token' => $result['TOKEN'], 'status' => 'pending');

            $where = array('custom_id' => $result['PAYMENTREQUEST_0_CUSTOM']);
          
            $update_format = array('%s', '%s');

            $wpdb->update('td_payments', $update_data, $where, $update_format);

        }
        
        /**
         * Update payment
         */
        function UpdatePayment($result, $status) {

            global $wpdb;

            $update_data = array('transaction_id' => $result['PAYMENTINFO_0_TRANSACTIONID'],
                               'status' => $status);
          
            $where = array('token' => $result['TOKEN']);
          
            $update_format = array('%s', '%s');

            $wpdb->update('td_payments', $update_data, $where, $update_format);

            $transactionToken = $result['TOKEN'];

            global $wpdb;
            $payments = $wpdb->get_results( "SELECT * FROM `td_payments` where token = '".$transactionToken."'");

            $planNAME = $payments[0]->name;
            $planEMAIL = $payments[0]->email;
            $planPACKAGE = $payments[0]->package;
            $planPRICE = $payments[0]->price;
            $planCURRENCY = $payments[0]->currency;
            $planTYPE = $payments[0]->payment_type;
            $planPHONE = $payments[0]->phone;

            //=========================================
            // Send email to admin ====================
            //=========================================

            global $redux_demo;
            $admin_email = $redux_demo['admin-email'];
            $admin_email_title = $redux_demo['payment-admin-title'];
            $admin_email_message = $redux_demo['payment-admin-message'];


            if(empty($admin_email)) {
                $admin_email = "test@mail.com";
            }

            if(empty($admin_email_title)) {
                $admin_email_title = "New payment!";
            }

            if(empty($admin_email_message)) {
                $admin_email_message = "Master, you have a new payment: ";
            }

            $blog_title = get_bloginfo('name');

            $emailTo = $admin_email;
            $subject = $admin_email_title; 
            $body = $admin_email_message. "\r\n\r\n" .$planNAME. "\r\n" .$planEMAIL. "\r\n" .$planPACKAGE. "\r\n" .$planPRICE."".$planCURRENCY. "\r\n" .$planTYPE;
            $headers = 'From website' . "\r\n" . 'Reply-To: ' . $email;
                          
            wp_mail($emailTo, $subject, $body, $headers);

            //=========================================

            //=========================================
            // Send email to subscriber ===============
            //=========================================

            global $redux_demo;
            $admin_email = $redux_demo['admin-email'];
            $user_email_title = $redux_demo['payment-user-title'];
            $user_email_message = $redux_demo['payment-user-message'];

            if(empty($admin_email)) {
                $admin_email = "test@mail.com";
            }

            if(empty($user_email_title)) {
                $user_email_title = "Payment notification!";
            }

            if(empty($user_email_message)) {
                $user_email_message = "Congratulations. Your payment went through!";
            }

            $blog_title = get_bloginfo('name');

            $from  = $admin_email;
            $headers = 'From: '.$from . "\r\n";
            $subject = $user_email_title; 
            $body = $user_email_message. "\r\n\r\n" .$planNAME. "\r\n" .$planEMAIL. "\r\n" .$planPHONE. "\r\n" .$planPACKAGE. "\r\n" .$planPRICE."".$planCURRENCY. "\r\n" .$planTYPE;
                          
            wp_mail($planEMAIL, $subject, $body, $headers);

            //=========================================
        }
    
    }
  
}