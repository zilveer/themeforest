<?php
/* Based on original Sharrre by Julien Hany 
 * by Brando Meniconi (b.meniconi@fuoricentrostudio.com)
 */
header('content-type: application/json');
$json = array(
	'url'=>filter_input(INPUT_GET, 'url', FILTER_VALIDATE_URL),
	'count'=>0
);
if(empty($json['url'])){
	return json_encode($json);
}
$context = stream_context_create(array(
	'http'=>array(
		//'proxy' => 'tcp://proxy.example.com:5100', //
		'max_redirects' => 5,
		'user_agent' => 'Sharrre',
		'timeout' => 5,
		'verify_peer' => false,
	)
));
switch(filter_input(INPUT_GET, 'type')){
	case 'googlePlus':

		$response = wp_remote_get( 'https://plusone.google.com/u/0/_/+1/fastbutton?url=' . urlencode($json['url']) . '&count=true', $context );
		$api_response = json_decode( wp_remote_retrieve_body( $response ), true );

		$matches = array();
		if(!empty($api_response) && preg_match( '/window\.__SSR = {c: ([\d]+)/', $api_response, $matches )){
			$json['count'] = $matches[1];
		}
		break;

	case 'stumbleupon':
		$response = wp_remote_get( "http://www.stumbleupon.com/services/1.01/badge.getinfo?url=".urlencode($json['url']), $context );
		$api_response = json_decode( wp_remote_retrieve_body( $response ), true );

		if (!empty($api_response) && ($result = json_decode($api_response)) && isset($result->result->views))
		{
			$json['count'] = (int)$result->result->views;
		}

		break;
}
echo json_encode($json);