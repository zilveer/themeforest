<?php

function  st_reservation_send(){
     // Site Info
    $errors = array();
    $site_name  = get_bloginfo('name');
    
    $to_email = isset($_POST['to_email']) ?  $_POST['to_email'] :  get_option('admin_email');
    if(!is_email($to_email)){
          $errors[] = __('Invalid Recipients','smooththemes');
    }
    
    if(!isset($_POST['reservation_email']) || !is_email($_POST['reservation_email'])){
          $errors[] = __('Invalid your Email','smooththemes');
    }
    
    if(empty($errors)){
        $reservation_name   = $from_name      = isset($_POST['reservation_name'])   ? esc_html($_POST['reservation_name'])          : '';
        $reservation_address      = isset($_POST['reservation_address'])       ? esc_html($_POST['reservation_address'])       : '';
        $reservation_email     = $from_email    = isset($_POST['reservation_email'])         ? $_POST['reservation_email']         : '';
        $reservation_type         = isset($_POST['reservation_type'])          ? esc_html($_POST['reservation_type'])          : '';
        $reservation_adults       = isset($_POST['reservation_adults'])        ? esc_html($_POST['reservation_adults'])        : '';
        $reservation_children     = isset($_POST['reservation_children'])      ? esc_html($_POST['reservation_children'])      : '';
        $reservation_arrival      = isset($_POST['reservation_arrival'])       ? esc_html($_POST['reservation_arrival'])       : '';
        $reservation_departure    = isset($_POST['reservation_departure'])     ? esc_html($_POST['reservation_departure'])     : '';
        $reservation_phone        = isset($_POST['reservation_phone'])         ? esc_html($_POST['reservation_phone'])         : '';
        $reservation_requirements = isset($_POST['reservation_requirements'])  ? esc_html($_POST['reservation_requirements'])  : '';

        $reservation_name         = sprintf(__('Name: %s','smooththemes') ,$reservation_name)." <br />";
        $reservation_address      = sprintf(__('Address: %s','smooththemes' ), $reservation_address)." <br />";
        $reservation_email        = sprintf(__('Email: %s','smooththemes'),$reservation_email)."<br />";
        $reservation_type         = sprintf(__('Reservation Room Type: %s','smooththemes'), $reservation_type )."<br />";
        $reservation_adults       = sprintf(__('No. of adults: %s','smooththemes'), $reservation_adults)."<br />";
        $reservation_children     = sprintf(__('No. of children: %s','smooththemes'),$reservation_children)."<br />";
        $reservation_arrival      = sprintf(__('Arrival Date: %s','smooththemes'),$reservation_arrival)." <br />";
        $reservation_departure    = sprintf(__('Departure Date: %s','smooththemes'),$reservation_departure)."  <br />";
        $reservation_phone        = sprintf(__('Phone Number: %s','smooththemes'),$reservation_phone)."  $reservation_phone <br />";
        $reservation_requirements = sprintf(__('Special Requirements: <br /> %s ','smooththemes'),$reservation_requirements)."  <br />";


        $subject =  sprintf(__('You have a new reservation from %s','smooththemes'), $site_name);
        $header  = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $header .= 'From: '.$from_name.'<'.$from_email. "> \r\n";

        $message = __( 'You have a new reservation request!', 'smooththemes' )."
             <br />
            $reservation_name
            $reservation_address
            $reservation_email
            $reservation_type
            $reservation_adults
            $reservation_children
            $reservation_arrival
            $reservation_departure
            $reservation_phone
            $reservation_requirements
        ";

        // use HTML for email
        add_filter( 'wp_mail_content_type', 'st_set_html_content_type' );
        // Send Mail
        if(wp_mail($to_email,$subject,$message,$header)) {

            $send = true;
        } else {
            $errors[] =_('Can not send mail.','smooththemes');
            $send = false;
        }
   
    	if(isset($_POST['ajax'])){
    		if($send)
    			echo 'success';
    		else
    			echo 'error';
    	}
    }/// end if no errros
    die();
}


function  st_contact_send(){
     // Site Info
    $errors = array();
    $site_name  = get_bloginfo('name');
    
    $to_email = isset($_POST['to_email']) ?  $_POST['to_email'] :  get_option('admin_email');
    if(!is_email($to_email)){
          $errors[] = __('Invalid Recipients','smooththemes');
    }
    
    if(!isset($_POST['contact_email']) || !is_email($_POST['contact_email'])){
          $errors[] = __('Invalid your Email','smooththemes');
    }
    
    if (empty( $errors ) ){
        $contact_name = $from_name    = isset($_POST['contact_name']) ?  esc_html($_POST['contact_name'])  : '';
        $contact_phone   = isset($_POST['contact_phone']) ?  esc_html($_POST['contact_phone']) : '';
        $contact_email   = $from_email = isset($_POST['contact_email']) ?  $_POST['contact_email'] : '';
        $contact_subject = isset($_POST['contact_subject']) ? esc_html($_POST['contact_subject']) : '';
        $contact_message = isset($_POST['contact_message']) ?  esc_html($_POST['contact_message']) : '';

        $contact_name         =  sprintf(__('Name: %s','smooththemes'), $contact_name)."<br />";
        $contact_email        =  sprintf(__('Email:  %s', 'smooththemes'),$contact_email)."<br />";
        $contact_phone         = sprintf(__('Phone Number: %s','smooththemes') ,$contact_phone )." <br />";
        $contact_subject       = sprintf(__('Subject: %s','smooththemes'),  $contact_subject )."<br />";
        $contact_message       = sprintf(__('Message: %s','smooththemes'),$contact_message )."<br />";


        $subject = sprintf( __('You have a new email from %s','smooththemes'), $site_name );
        $header  = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $header .= 'From: '.$from_name.' <'.$from_email. "> \r\n";
        $message = __('You have a new message!','smooththemes')."
            <br />
            $contact_name
            $contact_email
            $contact_phone
            $contact_subject
            $contact_message
        ";

        // use HTML for email
        add_filter( 'wp_mail_content_type', 'st_set_html_content_type' );
        // Send Mail
        if( wp_mail( $to_email, $subject, $message, $header ) ) {
            $send = true;
        } else {
            $errors[] =_('Can not send mail.','smooththemes');
            $send = false;
        }

        if( isset($_POST['ajax']) ){
            if($send)
                echo 'success';
            else
                echo 'error';
        }
    }/// end if no errors
    die();
}

function st_ajax_events_calendar(){
     $calendar = new STEventsCalendar();
     echo  $calendar->show();
     die();
}


add_action('wp_ajax_reservation_send', 'st_reservation_send');
add_action('wp_ajax_nopriv_reservation_send', 'st_reservation_send');

add_action('wp_ajax_contact_send', 'st_contact_send');
add_action('wp_ajax_nopriv_contact_send', 'st_contact_send');

add_action('wp_ajax_ajax_events_calendar', 'st_ajax_events_calendar');
add_action('wp_ajax_nopriv_ajax_events_calendar', 'st_ajax_events_calendar');
