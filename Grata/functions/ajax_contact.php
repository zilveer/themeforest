<?php

if ( ! function_exists('us_sendContact'))
{
	function us_sendContact()
	{
		global $smof_data;
		$errors = 0;

        if (@$smof_data['contact_form_mailchimp'] == 1 AND @$smof_data['contact_form_mailchimp_api_key'] != '' AND @$smof_data['contact_form_mailchimp_list_id'] != '')
        {
            if (empty($_POST['name']))
            {
                $errors++;
            }

            if (empty($_POST['email']))
            {
                $errors++;
            }

            if ($errors > 0)
            {
                $response = array ('success' => 0);
                echo json_encode($response);
                die();
            }

            require_once(get_template_directory().'/vendor/MCAPI.class.php');
            $api = new MCAPI($smof_data['contact_form_mailchimp_api_key']);

            if ($api->listSubscribe( $smof_data['contact_form_mailchimp_list_id'], $_POST['email'], array('FNAME' => $_POST['name'])) === TRUE)
            {
                // It worked!
                $response = array ('success' => 1);
                echo json_encode($response);
                die();
            }
            elseif ($api->errorCode == 214)
            {
                // Already signed up
                $response = array ('success' => 1);
                echo json_encode($response);
                die();
            }
            else
            {
                // An error ocurred, return error message
                $response = array ('success' => 0, error => $api->errorMessage);
                echo json_encode($response);
                die();
            }
        }
        else
        {
            if (in_array(@$smof_data['contact_form_name_field'], array('Shown, required')) AND empty($_POST['name']))
            {
                $errors++;
            }

            if (in_array(@$smof_data['contact_form_email_field'], array('Shown, required')) AND empty($_POST['email']))
            {
                $errors++;
            }

            if (in_array(@$smof_data['contact_form_phone_field'], array('Shown, required')) AND empty($_POST['phone']))
            {
                $errors++;
            }

            if (in_array(@$smof_data['contact_form_message_field'], array('Shown, required')) AND empty($_POST['message']))
            {
                $errors++;
            }

            if ($errors > 0)
            {
                $response = array ('success' => 0);
                echo json_encode($response);
                die();
            }

            $emailTo = (@$smof_data['contact_form_email'] != '')?$smof_data['contact_form_email']:get_option('admin_email');

            $body = '';

            if (in_array(@$smof_data['contact_form_name_field'], array('Shown, required', 'Shown, not required')))
            {
                $body .= __('Name', 'us').": ".$_POST['name']."\n";
            }

            if (in_array(@$smof_data['contact_form_email_field'], array('Shown, required', 'Shown, not required')))
            {
                $body .= __('Email', 'us').": ".$_POST['email']."\n";
            }

            if (in_array(@$smof_data['contact_form_phone_field'], array('Shown, required', 'Shown, not required')))
            {
                $body .= __('Phone', 'us').": ".$_POST['phone']."\n";
            }

            if (in_array(@$smof_data['contact_form_message_field'], array('Shown, required', 'Shown, not required')))
            {
                $body .= __('Message', 'us').": ".$_POST['message']."\n";
            }

            $headers = '';

            wp_mail($emailTo, __('Contact request from', 'us')." http://".$_SERVER['HTTP_HOST'].'/', $body, $headers);

            $response = array ('success' => 1);
            echo json_encode($response);
        }



		die();

	}

	add_action( 'wp_ajax_nopriv_sendContact', 'us_sendContact' );
	add_action( 'wp_ajax_sendContact', 'us_sendContact' );
}