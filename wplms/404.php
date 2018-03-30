<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if(is_404()){
	$error404 = vibe_get_option('error404');
    if(isset($error404)){
        $page_id=  intval($error404);
        wp_redirect( get_permalink( $page_id ),301); 
        exit;
    }
    
}
