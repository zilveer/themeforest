<?php

// both logged in and not logged in users can send this AJAX request
add_action( 'wp_ajax_nopriv_sleek-ajax-loops', 'sleek_ajax_loops' );
add_action( 'wp_ajax_sleek-ajax-loops', 'sleek_ajax_loops' );



function sleek_ajax_loops() {
	
    // get the needed loop query function name
	$loop = $_POST['loop'];

    $response = array();
    $response['post_obj'] 	= $_POST;
    $response['loop'] 		= $loop($_POST);

    // generate and output response
    $response = json_encode($response);
    header( "Content-Type: application/json" );
    echo $response;
 
    exit;
}



?>