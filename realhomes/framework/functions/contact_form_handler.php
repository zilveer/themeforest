<?php
/**
 * File Name: contact_form_handler.php
 *
 * Send message function to process contact form submission
 *
 */

add_action( 'wp_ajax_nopriv_send_message', 'send_message' );
add_action( 'wp_ajax_send_message', 'send_message' );

if( !function_exists( 'send_message' ) ){
    function send_message()
    {
        if(isset($_POST['email'])):

            $nonce = $_POST['nonce'];

            if (!wp_verify_nonce($nonce, 'send_message_nonce')) {
                echo json_encode(array(
                    'success' => false,
                    'message' => __('Unverified Nonce!', 'framework')
                ));
                die;
            }

            $show_reCAPTCHA = get_option('theme_show_reCAPTCHA');
            $reCAPTCHA_public_key = get_option('theme_recaptcha_public_key');
            $reCAPTCHA_private_key = get_option('theme_recaptcha_private_key');

            if(!empty($reCAPTCHA_public_key) && !empty($reCAPTCHA_private_key) && $show_reCAPTCHA == 'true' ){
                /* Include recaptcha library */
                require_once( get_template_directory().'/recaptcha/recaptchalib.php' );
                $resp = recaptcha_check_answer ($reCAPTCHA_private_key,
                                                $_SERVER["REMOTE_ADDR"],
                                                $_POST["recaptcha_challenge_field"],
                                                $_POST["recaptcha_response_field"]);

                if (!$resp->is_valid){
                    /* What happens when the CAPTCHA was entered incorrectly */
                    echo json_encode(array(
                        'success' => false,
                        'message' => __('The reCAPTCHA is not correct. Please try again.', 'framework')
                    ));
                    die;
                }
            }

            /* Sanitize and Validate Target email address that will be configured from theme options */
            $to_email = sanitize_email( get_option('theme_contact_email') );
            $to_email = is_email($to_email);
            if (!$to_email) {
                echo json_encode( array(
                    'success' => false,
                    'message' => __( 'Target Email address is not properly configured!', 'framework' )
                ));
                die;
            }

            /* Sanitize and Validate contact form input data */
            $from_name = sanitize_text_field($_POST['name']);
            $phone_number = sanitize_text_field($_POST['number']);
            $message = stripslashes( $_POST['message'] );
            $from_email = sanitize_email($_POST['email']);
            $from_email = is_email($from_email);
            if (!$from_email) {
                echo json_encode(array(
                    'success' => false,
                    'message' => __('Provided Email address is invalid!', 'framework')
                ));
                die;
            }

            $email_subject = __('New message sent by', 'framework') . ' ' . $from_name . ' ' . __('using contact form at', 'framework') . ' ' . get_bloginfo('name');

            $email_body = __("You have received a message from: ", 'framework') . $from_name . " <br/>";

            if (!empty($phone_number)) {
                $email_body .= __("Phone Number : ", 'framework') . $phone_number . " <br/>";
            }

            $email_body .= __("Their additional message is as follows.", 'framework') . " <br/>";
            $email_body .= wpautop( $message ) . " <br/>";
            $email_body .= __("You can contact ", 'framework') . $from_name . __(" via email, ", 'framework') . $from_email;

            $header = 'Content-type: text/html; charset=utf-8' . "\r\n";
            $header = apply_filters("inspiry_contact_mail_header", $header);
            $header .= 'From: ' . $from_name . " <" . $from_email . "> \r\n";

            if (wp_mail($to_email, $email_subject, $email_body, $header)) {
                echo json_encode( array(
                    'success' => true,
                    'message' => __("Message Sent Successfully!", 'framework')
                ));
            } else {
                echo json_encode(array(
                        'success' => false,
                        'message' => __("Server Error: WordPress mail function failed!", 'framework')
                    )
                );
            }

        else:
            echo json_encode(array(
                    'success' => false,
                    'message' => __("Invalid Request !", 'framework')
                )
            );
        endif;

        die;

    }
}

add_action( 'wp_ajax_nopriv_send_message_to_agent', 'send_message_to_agent' );
add_action( 'wp_ajax_send_message_to_agent', 'send_message_to_agent' );

if( !function_exists( 'send_message_to_agent' ) ){
    function send_message_to_agent(){
        if(isset($_POST['email'])):

            $nonce = $_POST['nonce'];

            if (!wp_verify_nonce($nonce, 'agent_message_nonce')) {
                echo json_encode(array(
                    'success' => false,
                    'message' => __('Unverified Nonce!', 'framework')
                ));
                die;
            }

            $show_reCAPTCHA = get_option('theme_show_reCAPTCHA');
            $reCAPTCHA_public_key = get_option('theme_recaptcha_public_key');
            $reCAPTCHA_private_key = get_option('theme_recaptcha_private_key');

            if(!empty($reCAPTCHA_public_key) && !empty($reCAPTCHA_private_key) && $show_reCAPTCHA == 'true' ){
                /* Include recaptcha library */
                require_once( get_template_directory().'/recaptcha/recaptchalib.php' );
                $resp = recaptcha_check_answer ($reCAPTCHA_private_key,
                                                $_SERVER["REMOTE_ADDR"],
                                                $_POST["recaptcha_challenge_field"],
                                                $_POST["recaptcha_response_field"]);

                if (!$resp->is_valid){
                    /* What happens when the CAPTCHA was entered incorrectly */
                    echo json_encode(array(
                        'success' => false,
                        'message' => __('The reCAPTCHA is not correct. Please try again.', 'framework')
                    ));
                    die;
                }
            }

            /* Sanitize and Validate Target email address that is coming from agent form */
            $to_email = sanitize_email( $_POST['target'] );
            $to_email = is_email($to_email);
            if (!$to_email) {
                echo json_encode( array(
                    'success' => false,
                    'message' => __( 'Target Email address is not properly configured!', 'framework' )
                ));
                die;
            }


            /* Sanitize and Validate contact form input data */
            $from_name = sanitize_text_field($_POST['name']);
            $message = stripslashes( $_POST['message'] );

            if( isset( $_POST['property_title'] ) ) {
                $property_title = sanitize_text_field( $_POST['property_title'] );
            }

            if( isset( $_POST['property_permalink'] ) ) {
                $property_permalink = esc_url($_POST['property_permalink']);
            }

            $from_email = sanitize_email($_POST['email']);
            $from_email = is_email($from_email);
            if (!$from_email) {
                echo json_encode(array(
                    'success' => false,
                    'message' => __('Provided Email address is invalid!', 'framework')
                ));
                die;
            }

            $email_subject = __('New message sent by', 'framework') . ' ' . $from_name . ' ' . __('using agent contact form at', 'framework') . ' ' . get_bloginfo('name');

            $email_body = __("You have received a message from: ", 'framework') . $from_name . " <br/>";

            if ( ! empty( $property_title ) ) {
                $email_body .= "<br/>" . __("Property Title : ", 'framework') . $property_title . " <br/>";
            }

            if ( ! empty( $property_permalink ) ) {
                $email_body .= __("Property URL : ", 'framework') . '<a href="'. $property_permalink. '">' . $property_permalink . "</a><br/>";
            }

            $email_body .= "<br/>" . __("Their additional message is as follows.", 'framework') . " <br/>";
            $email_body .= wpautop( $message ) . " <br/>";
            $email_body .= __("You can contact ", 'framework') . $from_name . __(" via email, ", 'framework') . $from_email;

            $header = 'Content-type: text/html; charset=utf-8' . "\r\n";
            $header = apply_filters("inspiry_agent_mail_header", $header);
            $header .= 'From: ' . $from_name . " <" . $from_email . "> \r\n";

            /* Send copy of message to admin if configured */
            $theme_send_message_copy = get_option('theme_send_message_copy');
            if( $theme_send_message_copy == 'true' ){
                $cc_email = get_option( 'theme_message_copy_email' );
                $cc_email = explode( ',', $cc_email );
                if( !empty( $cc_email ) ){
                    foreach( $cc_email as $ind_email ){
                        $ind_email = sanitize_email( $ind_email );
                        $ind_email = is_email( $ind_email );
                        if ( $ind_email ) {
                            $header .= 'Cc: ' . $ind_email . " \r\n";
                        }
                    }
                }

            }

            if ( wp_mail( $to_email, $email_subject, $email_body, $header ) ) {
                echo json_encode( array(
                    'success' => true,
                    'message' => __("Message Sent Successfully!", 'framework')
                ));
            } else {
                echo json_encode(array(
                        'success' => false,
                        'message' => __("Server Error: WordPress mail function failed!", 'framework')
                    )
                );
            }

        else:
            echo json_encode(array(
                    'success' => false,
                    'message' => __("Invalid Request !", 'framework')
                )
            );
        endif;
        die;
    }
}

?>