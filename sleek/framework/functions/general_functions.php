<?php

/*------------------------------------------------------------*/
/*	Get String Between
/*------------------------------------------------------------*/

function sleek_get_string_between($string, $start, $end){

	preg_match_all( '/' . preg_quote( $start, '/') . '(.*?)' . preg_quote( $end, '/') . '/', $string, $matches);
    return $matches[1];

}



/*------------------------------------------------------------*/
/*	Get String By Start and End
/*------------------------------------------------------------*/

function sleek_get_string_by_start_and_end($string, $start, $end){

	preg_match_all( '/' . preg_quote( $start, '/') . '(.*?)' . preg_quote( $end, '/') . '/', $string, $matches);
    return $matches[0];

}



/*------------------------------------------------------------*/
/*	Check if URL is external
/*------------------------------------------------------------*/

function sleek_url_is_external($url){
	if( !isset($url) ){
		return false;
	}

	$url_host = parse_url($url, PHP_URL_HOST);
	$home_url_host = parse_url(home_url(), PHP_URL_HOST);

	if( $url_host == $home_url_host || empty($url_host) ){
		return false;
	}else{
		return true;
	}

}



/*------------------------------------------------------------*/
/*	Check if URL is internal
/*------------------------------------------------------------*/

function sleek_url_is_internal($url){
	if( !isset($url) ){
		return false;
	}

	$url_host = parse_url($url, PHP_URL_HOST);
	$home_url_host = parse_url(home_url(), PHP_URL_HOST);

	if( $url_host != $home_url_host || empty($url_host) ){
		return false;
	}else{
		return true;
	}

}



/*------------------------------------------------------------*/
/*	Check if URL is audio file
/*------------------------------------------------------------*/

function sleek_url_is_audiofile($url){
	if( !isset($url) ){
		return false;
	}

	preg_match( '/\.(m4a|wav|ogg|mp3)($|\?.*$)/ui', $url, $matches );

	if( empty($matches) ){
		return false;
	}else{
		return true;
	}

}
