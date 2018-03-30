<?php
/**
 * File Name: Email Functions
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 03/02/16
 * Time: 5:38 PM
 */

add_action( 'wp_ajax_nopriv_houzez_agent_send_message', 'houzez_agent_send_message' );
add_action( 'wp_ajax_houzez_agent_send_message', 'houzez_agent_send_message' );

if( !function_exists('houzez_agent_send_message') ) {
    function houzez_agent_send_message() {

        $nonce = $_POST['agent_contact_form_ajax'];
        if (!wp_verify_nonce( $nonce, 'agent-contact-form-nonce') ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Unverified Nonce!', 'houzez')
            ));
            wp_die();
        }

        $sender_phone = sanitize_text_field( $_POST['phone'] );
        $property_link = esc_url( $_POST['property_permalink'] );
        $property_title = sanitize_text_field( $_POST['property_title'] );

        $target_email = sanitize_email($_POST['target_email']);
        $target_email = is_email($target_email);
        if (!$target_email) {
            echo json_encode(array(
                'success' => false,
                'msg' => sprintf( esc_html__('%s Target Email address is not properly configured!', 'houzez'), $target_email )
            ));
            wp_die();
        }

        $sender_name = sanitize_text_field($_POST['name']);
        if ( empty($sender_name) ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Name field is empty!', 'houzez')
            ));
            wp_die();
        }

        $sender_email = sanitize_email($_POST['email']);
        $sender_email = is_email($sender_email);
        if (!$sender_email) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Provided Email address is invalid!', 'houzez')
            ));
            wp_die();
        }

        $sender_msg = wp_kses_post( $_POST['message'] );
        if ( empty($sender_msg) ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Your message is empty!', 'houzez')
            ));
            wp_die();
        }


        $subject = sprintf( esc_html__('New message sent by %s using agent contact form at %s', 'houzez'), $sender_name, get_bloginfo('name') );

        $body = esc_html__("You have received a message from: ", 'houzez') . $sender_name . " <br/>";

        if ( ! empty( $property_title ) ) {
            $body .= "<br/>" . esc_html__("Property Title : ", 'houzez') . $property_title . " <br/>";
        }

        if ( ! empty( $property_link ) ) {
            $body .= esc_html__("Property URL : ", 'houzez') . '<a href="'. $property_link. '">' . $property_link . "</a><br/>";
        }

        if (! empty($sender_phone)) {
            $body .= esc_html__("Phone Number : ", 'houzez') . $sender_phone . " <br/>";
        }

        $body .= "<br/>" . esc_html__("Additional message is as follows.", 'houzez') . " <br/>";
        $body .= wpautop( $sender_msg ) . " <br/>";
        $body .= sprintf( esc_html__( 'You can contact %s via email %s', 'houzez'), $sender_name, $sender_email );

        $header = 'Content-type: text/html; charset=utf-8' . "\r\n";
        $header = apply_filters("houzez_agent_mail_header", $header);
        $header .= 'From: ' . $sender_name . " <" . $sender_email . "> \r\n";

        /*
        // Send copy of message to admin if configured */
        $send_message_copy = houzez_option('send_agent_message_copy');
        if( $send_message_copy == '1' ){
            $cc_email = houzez_option( 'send_agent_message_email' );
            $cc_email = explode( ',', $cc_email );
            if( !empty( $cc_email ) ){
                foreach( $cc_email as $email ){
                    $email = sanitize_email( $email );
                    $email = is_email( $email );
                    if ( $email ) {
                        $header .= 'Cc: ' . $email . " \r\n";
                    }
                }
            }

        }

        if ( wp_mail( $target_email, $subject, $body, $header ) ) {
            echo json_encode( array(
                'success' => true,
                'msg' => esc_html__("Message Sent Successfully!", 'houzez')
            ));
            wp_die();
        } else {
            echo json_encode(array(
                    'success' => false,
                    'msg' => esc_html__("Server Error: WordPress mail function failed!", 'houzez')
                )
            );
            wp_die();
        }
        wp_die();

    }
}

if (!function_exists('houzez_email_type')) {
    function houzez_email_type( $email, $email_type, $args ) {

        $value_message = houzez_option('houzez_' . $email_type, '');
        $value_subject = houzez_option('houzez_subject_' . $email_type, '');

        if (function_exists('icl_translate')) {
            $value_message = icl_translate('houzez', 'houzez_email_' . $value_message, $value_message);
            $value_subject = icl_translate('houzez', 'houzez_email_subject_' . $value_subject, $value_subject);
        }

        houzez_emails_filter_replace( $email, $value_message, $value_subject, $args);
    }
}

if( !function_exists('houzez_emails_filter_replace')):
    function  houzez_emails_filter_replace( $email, $message, $subject, $args ) {
        $args ['website_url'] = get_option('siteurl');
        $args ['website_name'] = get_option('blogname');
        $args ['user_email'] = $email;
        $user = get_user_by( 'email',$email );
        $args ['username'] = $user->user_login;

        foreach( $args as $key => $val){
            $subject = str_replace( '%'.$key, $val, $subject );
            $message = str_replace( '%'.$key, $val, $message );
        }

        houzez_send_emails( $email, $subject, $message );
    }
endif;


if( !function_exists('houzez_send_emails') ):
    function houzez_send_emails( $user_email, $subject, $message ){
        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

        @wp_mail(
            $user_email,
            $subject,
            $message,
            $headers
        );
    };
endif;


if( !function_exists('houzez_email_to_admin') ) {
    function houzez_email_to_admin($email_type) {
        $admin_email = get_option('admin_email');

        if ($email_type == 'email_upgrade') {
            $args = array();
            houzez_email_type( $admin_email, 'featured_submission', $args );
        } else {
            $args = array();
            houzez_email_type( $admin_email, 'paid_submission', $args );
        }
    }
}


add_action( 'wp_ajax_nopriv_houzez_contact_agent', 'houzez_contact_agent' );
add_action( 'wp_ajax_houzez_contact_agent', 'houzez_contact_agent' );
if( !function_exists( 'houzez_contact_agent' ) ) {
    function houzez_contact_agent() {

        $nonce = $_POST['sender_nonce'];
        if (!wp_verify_nonce( $nonce, 'agent-contact-nonce') ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Unverified Nonce!', 'houzez')
            ));
            wp_die();
        }

        $sender_phone = sanitize_text_field( $_POST['sender_phone'] );

        $target_email = sanitize_email($_POST['target_email']);
        $target_email = is_email($target_email);
        if (!$target_email) {
            echo json_encode(array(
                'success' => false,
                'msg' => sprintf( esc_html__('%s Target Email address is not properly configured!', 'houzez'), $target_email )
            ));
            wp_die();
        }

        $sender_name = sanitize_text_field($_POST['sender_name']);
        if ( empty($sender_name) ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Name field is empty!', 'houzez')
            ));
            wp_die();
        }

        $sender_email = sanitize_email($_POST['sender_email']);
        $sender_email = is_email($sender_email);
        if (!$sender_email) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Provided Email address is invalid!', 'houzez')
            ));
            wp_die();
        }

        $sender_msg = wp_kses_post( $_POST['sender_msg'] );
        if ( empty($sender_msg) ) {
            echo json_encode(array(
                'success' => false,
                'msg' => esc_html__('Your message empty!', 'houzez')
            ));
            wp_die();
        }

        $email_subject = sprintf( esc_html__('New message sent by %s using contact form at %s', 'houzez'), $sender_name, get_bloginfo('name') );

        $email_body = esc_html__("You have received a message from: ", 'houzez') . $sender_name . " <br/>";
        if (!empty($sender_phone)) {
            $email_body .= esc_html__("Phone Number : ", 'houzez') . $sender_phone . " <br/>";
        }
        $email_body .= esc_html__("Additional message is as follows.", 'houzez') . " <br/>";
        $email_body .= wpautop( $sender_msg ) . " <br/>";
        $email_body .= sprintf( esc_html__( 'You can contact %s via email %s', 'houzez'), $sender_name, $sender_email );

        $header = 'Content-type: text/html; charset=utf-8' . "\r\n";
        $header = apply_filters("houzez_agent_contact_mail_header", $header);
        $header .= 'From: ' . $sender_name . " <" . $sender_email . "> \r\n";

        if (wp_mail( $target_email, $email_subject, $email_body, $header)) {
            echo json_encode( array(
                'success' => true,
                'msg' => esc_html__("Message Sent Successfully!", 'houzez')
            ));
            wp_die();
        } else {
            echo json_encode(array(
                    'success' => false,
                    'msg' => esc_html__("Server Error: WordPress mail function failed!", 'houzez')
                )
            );
            wp_die();
        }

        wp_die();
    }
}