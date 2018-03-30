<?php
// // ----------------------------------------------------------------------------------------------------
// // - Display Errors
// // ----------------------------------------------------------------------------------------------------
ini_set('display_errors', 'On');
ini_set('html_errors', 0);

// // ----------------------------------------------------------------------------------------------------
// // - Error Reporting
// // ----------------------------------------------------------------------------------------------------
// error_reporting(-1);

function subscribe() {
    // Validation
    if (empty($_REQUEST['email'])) {
        return 'Error: No email address provided';
    }

    if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $_REQUEST['email'])) {
        return 'Error: Email address is invalid';
    }

    if (empty($_REQUEST['provider'])) {
        return 'Error: No any subscribe provider provided';
    }


    $provider = $_REQUEST['provider'];

    if (! empty($provider) ) {

        require_once dirname(__FILE__) . "/{$provider}/{$provider}.php";

        $process = "process_{$provider}";

        return $process();
    }

    error_log("Error: {$_REQUEST['provider']} provider not realised");
    return "Error: {$_REQUEST['provider']} provider not realised";
}

// If being called via ajax, autorun the function
if ( !empty($_REQUEST['ajax']) ) {

    echo subscribe();
}
?>
