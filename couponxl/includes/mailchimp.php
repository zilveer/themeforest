<?php
/**
 * Super-simple, minimum abstraction MailChimp API v2 wrapper
 * 
 * Uses curl if available, falls back to file_get_contents and HTTP stream.
 * This probably has more comments than code.
 *
 * Contributors:
 * Michael Minor <me@pixelbacon.com>
 * Lorna Jane Mitchell, github.com/lornajane
 * 
 * @author Drew McLellan <drew.mclellan@gmail.com> 
 * @version 1.1.1
 */
class MailChimp
{
    private $api_key;
    private $api_endpoint = 'https://<dc>.api.mailchimp.com/2.0';
    private $verify_ssl   = false;

    /**
     * Create a new instance
     * @param string $api_key Your MailChimp API key
     */
    function __construct($api_key)
    {
        $this->api_key = $api_key;
        list(, $datacentre) = explode('-', $this->api_key);
        $this->api_endpoint = str_replace('<dc>', $datacentre, $this->api_endpoint);
    }

    /**
     * Call an API method. Every request needs the API key, so that is added automatically -- you don't need to pass it in.
     * @param  string $method The API method to call, e.g. 'lists/list'
     * @param  array  $args   An array of arguments to pass to the method. Will be json-encoded for you.
     * @return array          Associative array of json decoded API response.
     */
    public function call($method, $args=array(), $timeout = 10)
    {
        return $this->makeRequest($method, $args, $timeout);
    }

    /**
     * Performs the underlying HTTP request. Not very exciting
     * @param  string $method The API method to be called
     * @param  array  $args   Assoc array of parameters to be passed
     * @return array          Assoc array of decoded result
     */
    private function makeRequest($method, $args=array(), $timeout = 10)
    {      
        $args['apikey'] = $this->api_key;

        $url = $this->api_endpoint.'/'.$method.'.json';
		if( function_exists('wp_remote_post') ){

		$response = wp_remote_post($url, array( 
			'body' => $args,
			'timeout' => 20,
			'headers' => array('Accept-Encoding' => ''),
			'sslverify' => false
		) ); 

		if( is_wp_error($response) ) {
			return false;
		}else{
			$result = wp_remote_retrieve_body($response);
		} 	

		}
        return $result ? json_decode($result, true) : false;
    }
}
?>