<?php
// find wp-load.php
$wpLoad = 'wp-load.php';
for ($i = 0; $i < 8; $i++) {
    if (file_exists($wpLoad)) {
        require_once($wpLoad);
        break;
    }
    $wpLoad = '../'.$wpLoad;
}

// var_dump($_POST);

// verify this came from the our screen and with proper authorization,
// because save_post can be triggered at other times
if (!array_key_exists('_wpnonce', $_GET)) {
    header("HTTP/1.0 400 Bad Request");
    exit();
}
if (!wp_verify_nonce($_GET['_wpnonce'], 'preview')) {
    header("HTTP/1.0 400 Bad Request");
    exit();
}

foreach ($_POST as $key => $val) {
    if (is_array($val)) {
        foreach ($val as $i => $v) {
            $val[$i] = str_replace("'", "&apos;", stripslashes($v));
        }
        $_POST[$key] = $val;
    } else {
        $_POST[$key] = str_replace("'", "&apos;", stripslashes($val));
    }
}
bfi_save_preview_data($_POST['post_ID'], $_POST);

?>