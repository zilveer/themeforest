<?php
#-----------------------------------------
#	RT-Theme common_functions.php
#	version: 1.1
#-----------------------------------------

#
# find vimeo and youtube id from url
#
function find_tube_video_id($url){
	$tubeID="";


	if( strpos($url, 'youtube') || strpos($url, 'youtu.be')  ) {	
		$tubeID=parse_url($url);		

		isset( $tubeID['path'] ) && strpos($url, 'http://youtu.be') 
			and $tubeID=str_replace("/", "", $tubeID['path']);	

		isset( $tubeID['query'] ) 
			and parse_str($tubeID['query'], $url_parts);

		is_array( $url_parts ) 
			and $tubeID=$url_parts["v"];
 
	}
	
	if( strpos($url, 'vimeo')  ) {
		$tubeID=parse_url($url, PHP_URL_PATH);			
		$tubeID=str_replace("/", "", $tubeID);	
	}	


	if( is_string( $tubeID ) ) return $tubeID;
}