<?php 

//Continue the session
session_start();

/** Validate captcha */
if (!empty($_REQUEST['captcha'])) {
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
        $captcha_message = "Invalid captcha";
    } else {
        $captcha_message = "ok";
    }

    $request_captcha = htmlspecialchars($_REQUEST['captcha']);

    echo $captcha_message;

    unset($_SESSION['captcha']);
}

?>