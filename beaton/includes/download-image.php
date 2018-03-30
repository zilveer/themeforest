<?php
$imageurl           = filter_input(INPUT_GET, 'imageurl', FILTER_SANITIZE_URL);
$url_parsed         = parse_url($imageurl);
$file               = $_SERVER['DOCUMENT_ROOT'] . $url_parsed['path'];
$extension          = substr(strrchr($file, '.'), 1);
$allowed_extensions = array(
    'jpg',
    'jpeg',
    'png',
    'gif'
);
if (in_array(strtolower($extension), $allowed_extensions)) {
    if (file_exists($file)) {
        header('Content-type: octet/stream');
        header('Content-disposition: attachment; filename=' . basename($file) . ';');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
}
