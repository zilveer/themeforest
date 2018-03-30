<?php

// MODIFY THESE CONFIGS
/*
define('CONSUMER_KEY', '');
define('CONSUMER_SECRET', '');
define('ACCESS_TOKEN', '');
define('ACCESS_SECRET', '');
*/

define('CONSUMER_KEY', 'EmCwYCHpEKPnLk10bwpmNQ');
define('CONSUMER_SECRET', '59vHK1IFcMh73dBLlWwNhE81dvrm2dULrBz4IQzLlE');
define('ACCESS_TOKEN', '1017913178-Z9p7BEWHSU0NZVNCJ9o5a1SX1I7rVUJWJQdSOG5');
define('ACCESS_SECRET', 'Ypjty1kwMjOepSs4Sgt0dTr4BgGlU9qUuWeq1aQ4A');

//--------------------------------------------

if(empty($_POST) || CONSUMER_KEY == '' || CONSUMER_SECRET == '' || ACCESS_TOKEN == '' || ACCESS_SECRET == '') { die(json_encode(array())); }

class ezTweet {
	/*************************************** config ***************************************/

   // Your Twitter App Consumer Key
	private $consumer_key = CONSUMER_KEY;

	// Your Twitter App Consumer Secret
	private $consumer_secret = CONSUMER_SECRET;

	// Your Twitter App Access Token
	private $user_token = ACCESS_TOKEN;

	// Your Twitter App Access Token Secret
	private $user_secret = ACCESS_SECRET;

	// Path to tmhOAuth libraries
	private $lib = './lib/';

	// Enable caching
	private $cache_enabled = true;

	// Cache interval (minutes)
	private $cache_interval = 15;

	// Path to writable cache directory
	private $cache_dir = './cache/';

	// Enable debugging
	private $debug = false;

	/**************************************************************************************/

	public function __construct() {
		// Initialize paths and etc.
		$this->pathify($this->cache_dir);
		$this->pathify($this->lib);
		$this->message = '';

	}

	public function fetch() {
		echo json_encode(
			array(
				'response' => json_decode($this->getJSON(), true),
				'message' => ($this->debug) ? $this->message : false
			)
		);
	}

	private function getJSON() {
		if($this->cache_enabled === true) {
			$CFID = $this->generateCFID();
			$cache_file = $this->cache_dir.$CFID;

			if(file_exists($cache_file) && (filemtime($cache_file) > (time() - 60 * intval($this->cache_interval)))) {
				return file_get_contents($cache_file, FILE_USE_INCLUDE_PATH);
			} else {

				$JSONraw = $this->getTwitterJSON();
				$JSON = $JSONraw['response'];

				// Don't write a bad cache file if there was a CURL error
				if($JSONraw['errno'] != 0) {
					$this->consoleDebug($JSONraw['error']);
					return $JSON;
				}

				if($this->debug === true) {
					// Check for twitter-side errors
					$pj = json_decode($JSON, true);
					if(isset($pj['errors'])) {
						foreach($pj['errors'] as $error) {
							$message = 'Twitter Error: "'.$error['message'].'", Error Code #'.$error['code'];
							$this->consoleDebug($message);
						}
						return false;
					}
				}

				if(is_writable($this->cache_dir) && $JSONraw) {
					if(file_put_contents($cache_file, $JSON, LOCK_EX) === false) {
						$this->consoleDebug("Error writing cache file");
					}
				} else {
					$this->consoleDebug("Cache directory is not writable");
				}
				return $JSON;
			}
		} else {
			$JSONraw = $this->getTwitterJSON();

			if($this->debug === true) {
				// Check for CURL errors
				if($JSONraw['errno'] != 0) {
					$this->consoleDebug($JSONraw['error']);
				}

				// Check for twitter-side errors
				$pj = json_decode($JSONraw['response'], true);
				if(isset($pj['errors'])) {
					foreach($pj['errors'] as $error) {
						$message = 'Twitter Error: "'.$error['message'].'", Error Code #'.$error['code'];
						$this->consoleDebug($message);
					}
					return false;
				}
			}
			return $JSONraw['response'];
		}
	}

	private function getTwitterJSON() {
		require $this->lib.'tmhOAuth.php';
		require $this->lib.'tmhUtilities.php';

		$tmhOAuth = new tmhOAuth(array(
			'host'                  => $_POST['request']['host'],
			'consumer_key'          => $this->consumer_key,
			'consumer_secret'       => $this->consumer_secret,
			'user_token'            => $this->user_token,
			'user_secret'           => $this->user_secret,
			'curl_ssl_verifypeer'   => false
		));

		$url = $_POST['request']['url'];
		$params = $_POST['request']['parameters'];

		$tmhOAuth->request('GET', $tmhOAuth->url($url), $params);
		return $tmhOAuth->response;
	}

	private function generateCFID() {
		// The unique cached filename ID
		return md5(serialize($_POST)).'.json';
	}

	private function pathify(&$path) {
		// Ensures our user-specified paths are up to snuff
		$path = realpath($path).'/';
	}

	private function consoleDebug($message) {
		if($this->debug === true) {
			$this->message .= 'tweet.js: '.$message."\n";
		}
	}
}

$ezTweet = new ezTweet;
$ezTweet->fetch();

?>
