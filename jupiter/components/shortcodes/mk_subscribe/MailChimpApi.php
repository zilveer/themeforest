<?php
/**
 * 
 * MailChimp API operations
 *
 * @copyright	ArtbeesLTD (c)
 * @link		http://artbees.net
 * @since		Version 5.0
 * @last_update Version 5.0.8
 * @package		artbees
 * @author		Mucahit Yilmaz & Ugur Mirza Zeyrek
 */

if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

class MailChimp
{
	private $api_key = "";
	private $datacenter = "";
	private $api_version = "";
	private $api_endpoint = "";
	private $format = "";
	private $verify_ssl = false;
	private $user_agent = "";
	private $debug = false;

	function __construct($api_key)
	{
		$this->api_key = $api_key;
		if ( strlen(substr( strrchr($api_key, '-'), 1 ))) {
		$this->datacenter = substr( strrchr($api_key, '-'), 1 );
		} else {
		$this->datacenter = "us1";
		}
		$this->api_version = "2.0";
		$this->api_endpoint = "https://".$this->datacenter.".api.mailchimp.com/".$this->api_version."/";
		$this->format = "json";
		$this->verify_ssl = false;
		$this->user_agent = "Jupiter-Mailing/1.0";
	}

	/**
	 *	
	 *	Runs API query
	 *
	 *	@param $query - string - endpoint and parameters. like "lists/subscribe"
	 *	@param $data - array - the data which'll be posted. must NOT be json decoded!
	 *	@param $data - array - optional - curl query timeout in seconds
	 *
	 *	@return array - API response
	 */
	private function rest($query, $data = array(), $timeout = 10)
	{
		$url = $this->api_endpoint.$query.".".$this->format;

		$data['apikey'] = $this->api_key;

		$header[] = "Content-type: application/json";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);

		$jsondata = json_encode($data);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->verify_ssl);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);

		$result = curl_exec($ch);

		if($this->debug){
			echo "<pre>result:<br>";
			print_r(json_decode($result,true));
			echo "<br>curlinfo:<br>";
			print_r(curl_getinfo($ch));
			echo "</pre>";
		}

		curl_close($ch);

		return json_decode($result,true);
	}

	/**
	 *
	 *	Subscribes the email address to the given list
	 *
	 *	@param	$email - string
	 *	@param	$list_id - string - sth like "6edd80a499"
	 *	@param	$first_name - string - optional
	 *	@param	$last_name - string - optional
	 *	@param	$optin - boolean - optional
	 *
	 *	@return	$result - array
	 */
	public function subscribe($email,$list_id, $optin = false)
	{
		$data = array(
			"id" => $list_id,
			"email" => array(
				"email" => $email
			),
			"merge_vars" => array(
				"FNAME" => "",
				"LNAME" => "",
			),
			"double_optin" => $optin,
			"send_welcome" => $optin
		);

		return $this->rest("lists/subscribe",$data,20);
	}

	/**
	 *
	 *	Unsubscribes the email address to the given list
	 *
	 *	@param	$email - string
	 *	@param	$list_id - string - sth like "6edd80a499"
	 *	@param	$optout - boolean - optional
	 *
	 *	@return	$result - array
	 */
	public function unsubscribe($email,$list_id,$optout = false)
	{
		$data = array(
			"id" => $list_id,
			"email" => array(
				"email" => $email
			),
			"send_goodbye" => $optout,
			"send_notify" => $optout
		);

		return $this->rest("lists/unsubscribe",$data);
	}

	/**
	 *
	 *	Lists lists o_O
	 *
	 *	@param	$list_id - string - sth like "6edd80a499"
	 *
	 *	@return	$result - array
	 */
	public function get_lists($list_id = "")
	{
		$data = array(
			"filters" => array(
				"list_id" => $list_id,
			),
		);

		return $this->rest("lists/list",$data,20);
	}
}