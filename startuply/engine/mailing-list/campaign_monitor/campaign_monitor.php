<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function process_campaign_monitor($args = array()) {

    // require_once dirname(__FILE__) . '/inc/csrest_general.php';
    require_once dirname(__FILE__) . '/inc/csrest_subscribers.php';

    $api_key = $args['akey'];
    $list_id = empty($args['lid']) ? '' : $args['lid'];

    $auth = array('api_key' => $api_key);

    //$wrap = new CS_REST_General($auth);

    $wrap = new CS_REST_Subscribers($list_id, $auth);

    $result = $wrap->add(array(
        'EmailAddress' => $args['email'],
        'Name' => implode(' ', array($args['fname'], $args['lname']) ),
        // 'CustomFields' => array(
        //     array(
        //         'Key' => 'Field 1 Key',
        //         'Value' => 'Field Value'
        //     ),
        //     array(
        //         'Key' => 'Field 2 Key',
        //         'Value' => 'Field Value'
        //     ),
        //     array(
        //         'Key' => 'Multi Option Field 1',
        //         'Value' => 'Option 1'
        //     ),
        //     array(
        //         'Key' => 'Multi Option Field 1',
        //         'Value' => 'Option 2'
        //     )
        // ),
        'Resubscribe' => true
    ));


    if($result->was_successful()) {
        return "Success: Code - {$result->http_status_code}; Message - {$result->response}";
    } else {

        error_log("Error: Code - {$result->http_status_code}; Message - {$result->response->Message}");
        return "Error: Code - {$result->http_status_code}; Message - {$result->response->Message}";
    }
}


?>