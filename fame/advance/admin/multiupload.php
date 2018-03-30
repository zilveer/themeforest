<?php

/*
 * Multi upload in editing album
 */
function a13_multi_upload(){

    check_ajax_referer('photo-upload');

    $image_id = media_handle_upload('async-upload', $_REQUEST['post_id']);
    $src    = wp_get_attachment_image_src( $image_id, 'full' );
    $thumb  = wp_get_attachment_image_src( $image_id, 'thumbnail', false );
    $meta   = wp_get_attachment_metadata( $image_id);

    $params = array(
        'src'   => $src[0],
        'id'    => $image_id,
        'title' => $meta['image_meta']['title'],
        'thumb' => $thumb[0]
    );

    echo str_replace( '\/','/', json_encode($params));

//	    // you can use WP's wp_handle_upload() function:
//	    $file = $_FILES['async-upload'];
//	    $status = wp_handle_upload($file, array('test_form'=>false));
//

    exit;
}

//multi upload
add_action('wp_ajax_album_multi_upload', 'a13_multi_upload' );