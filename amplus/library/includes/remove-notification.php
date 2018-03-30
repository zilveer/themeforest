<?php
/**
 * This file is called by the admin when removing a theme notification
 * this sets the notification ID in the database as 'hidden'.
 * The notification controller checks this value to decide whether
 * to show or hide the notification.
 */

// find wp-load.php
$wpLoad = 'wp-load.php';
for ($i = 0; $i < 8; $i++) {
    if (file_exists($wpLoad)) {
        require_once($wpLoad);
        break;
    }
    $wpLoad = '../'.$wpLoad;
}

if (!isset($_GET['hash'])) {
    header("HTTP/1.0 405 Missing hash argument");
    exit();
}

header("HTTP/1.0 200 OK");

if (!bfi_get_option('adminnotice_' . $_GET['hash'])) {
    bfi_update_option('adminnotice_' . $_GET['hash'], 'hide');
}
?>