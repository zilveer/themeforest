<?php 
/*
	Get feedburner count
	Input :
		- string $uri : your feedburner account.
	Output :
		The feedburner count.
*/
if(!function_exists('get_count_feed_burner')){
	function get_count_feed_burner($uri){
		$whaturl="https://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=$uri";
		/*
		//Initialize the Curl session
		$ch = curl_init();

		//Set curl to return the data instead of printing it to the browser.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//Set the URL
		curl_setopt($ch, CURLOPT_URL, $whaturl);

		//Execute the fetch
		$data = curl_exec($ch);
		//Close the connection
		curl_close($ch);
		*/
		
		$fb = '';
		$args = array(
			'method'      =>    'GET',
			'timeout'     =>    5,
			'redirection' =>    5,
			'httpversion' =>    '1.0',
			'blocking'    =>    true,
			'headers'     =>    array(),
			'body'        =>    null,
			'cookies'     =>    array()
		);
		$data = wp_remote_get( $whaturl, $args );
		if( !is_wp_error( $data ) ) {
			$data =  $data['body'];
			$xml = new SimpleXMLElement($data);
			$fb = $xml->feed->entry['circulation'];
			//end get cool feedburner count
		}
		//echo the subscriber count
		return $fb;
	}
}	
?>