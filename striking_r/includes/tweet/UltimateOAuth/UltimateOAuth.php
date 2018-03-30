<?php

/**
 * UltimateOAuth
 * 
 * A highly advanced Twitter library in PHP.
 * 
 * @Version 5.3.4
 * @Author  CertaiN
 * @License BSD 2-Clause
 * @GitHub  http://github.com/certainist/UltimateOAuth
 */

/**
 * You have to configure these constants.
 * 
 * ****************************
 * ****************************
 * ****** VERY IMPORTANT ******
 * ****************************
 * ****************************
 *
 * @interface
 */
if (!interface_exists('UltimateOAuthConfig')) {
    
    interface UltimateOAuthConfig {
        
        /**
         * Multiple request settings.
         *  
         * @constant boolean USE_PROC_OPEN 
         *   TRUE  - use proc_open() - You should select TRUE as long as your server allows.
         *   FALSE - use stream_socket_client() - For the environment that proc_open()
         *                                        is disabled for security reasons. 
         */
        const USE_PROC_OPEN = true;
        
        /**
         * Used if USE_PROC_OPEN == TRUE.
         *
         * @constant string PHP_COMMAND
         *   proc_open() use this command for multiple processing.
         */
        const PHP_COMMAND = 'php';
        
        /**
         * Used if USE_PROC_OPEN == FALSE.
         * 
         * @constant string FULL_URL_TO_THIS_FILE
         *   stream_socket_client() use this URL for multiple processing.
         *   You have to put this file in the public_html.
         * @constant string MULTIPLE_REQUEST_KEY_NAME
         *   stream_socket_client() use this name as $_POST key name.
         */
        const FULL_URL_TO_THIS_FILE     = ''; /* You have to fill here! */
        const MULTIPLE_REQUEST_KEY_NAME = '____ULTIMATE_OAUTH_MULTIPLE_REQUEST_KEY____';
        
        /**
         * About request URL.
         * 
         * @constant string DEFAULT_SCHEME               This must be "https" now.
         * @constant string DEFAULT_HOST                 This must be "api.twitter.com" now.
         * @constant string DEFAULT_API_VERSION          This must be "1.1" now.
         * @constant string DEFAULT_ACTIVITY_API_VERSION This should be "1.1" now.
         * @constant string DEFAULT_GENERATE_API_VERSION This must be "1".
         */
        const DEFAULT_SCHEME               = 'https';
        const DEFAULT_HOST                 = 'api.twitter.com' ;
        const DEFAULT_API_VERSION          = '1.1';
        const DEFAULT_ACTIVITY_API_VERSION = '1.1';
        const DEFAULT_GENERATE_API_VERSION = '1';
        
        /**
         * User-Agent for requesting.
         * 
         * @constant string USER_AGENT
         */
        const USER_AGENT = 'UltimateOAuth';
        
    }
    
}

/**
 * UltimateOAuth
 *
 * A main class.
 * If you want to avoid API limits for GET endpoints,
 * use UltimateOAuthRotate class instead.
 */
if (!class_exists('UltimateOAuth')) {
    
    class UltimateOAuth {
        
        /********************/
        /**** Properties ****/
        /********************/
        
        private $consumer_key;
        private $consumer_secret;
        private $access_token;
        private $access_token_secret;
        private $request_token;
        private $request_token_secret;
        private $authenticity_token;
        private $oauth_verifier;
        private $cookie;
        private $last_http_status_code;
        private $last_called_endpoint;
        private $user_id;
        private $screen_name;
        
        /***************************/
        /**** Interface Methods ****/
        /***************************/
        
        /**
         * Create a new UltimateOAuth instance from an associative array.
         * 
         * @static
         * @access public 
         * @param  array  $params
         */
         public static function fromAssoc(array $params) {
            $default = array(
                'consumer_key'          => '',
                'consumer_secret'       => '',
                'access_token'          => '',
                'access_token_secret'   => '',
                'request_token'         => '',
                'request_token_secret'  => '',
                'oauth_verifier'        => '',
                'authenticity_token'    => '',
                'cookie'                => array(),
                'last_http_status_code' => 0,
                'last_called_endpoint'  => '',
                'user_id'               => '',
                'screen_name'           => '',
            );
            foreach ($default as $k => &$v) {
                if (isset($params[$k])) {
                    $v = $params[$k];
                }
            }
            $ref = new ReflectionClass(__CLASS__);
            return $ref->newInstanceArgs($default);
        }
        
        /**
         * Set properties from an associative array.
         * 
         * @access public 
         * @param  array  $params
         */
        public function setProperties(array $params) {
            foreach ($this as $k => $v) {
                if (isset($params[$k])) {
                    if ($k === 'cookie') {
                        $this->$k = UltimateOAuthModule::arrayfy($params[$k]);
                    } elseif ($k !== 'last_http_status_code') {
                        $this->$k = UltimateOAuthModule::stringify($params[$k]);
                    } else {
                        $this->$k = (int)$params[$k];
                    }
                }
            }
        }
        
        /**
         * Create a new UltimateOAuth instance.
         * 
         * @access public 
         * @param  string [$consumer_key]        A random official one is used when omitted. 
         * @param  string [$consumer_secret]     A random official one is used when omitted. 
         * @param  string [$access_token]        Necessary if you don't authenticate/authorize later.
         * @param  string [$access_token_secret] Necessary if you don't authenticate/authorize later.
         * 
         * Other arguments are only internally used.
         */
        public function __construct(
            $consumer_key          = '',
            $consumer_secret       = '',
            $access_token          = '',
            $access_token_secret   = '',
            $request_token         = '',
            $request_token_secret  = '',
            $oauth_verifier        = '',
            $authenticity_token    = '',
            $cookie                = array(),
            $last_http_status_code = 0,
            $last_called_endpoint  = '',
            $user_id               = '',
            $screen_name           = ''
        ) {
            if (func_num_args() < 2) {
                // use random official keys
                $key = array_rand($officials = UltimateOAuthModule::getOfficialKeys());
                $this->consumer_key    = $officials[$key]['consumer_key'];
                $this->consumer_secret = $officials[$key]['consumer_secret'];
            } else {
                // validate arguments and set them as properties
                $this->consumer_key          = UltimateOAuthModule::stringify($consumer_key);
                $this->consumer_secret       = UltimateOAuthModule::stringify($consumer_secret);
                $this->access_token          = UltimateOAuthModule::stringify($access_token);
                $this->access_token_secret   = UltimateOAuthModule::stringify($access_token_secret);
                $this->request_token         = UltimateOAuthModule::stringify($request_token);
                $this->request_token_secret  = UltimateOAuthModule::stringify($request_token_secret);
                $this->oauth_verifier        = UltimateOAuthModule::stringify($oauth_verifier);
                $this->authenticity_token    = UltimateOAuthModule::stringify($authenticity_token);
                $this->cookie                = UltimateOAuthModule::arrayfy($cookie);
                $this->last_http_status_code = (int)$last_http_status_code;
                $this->last_called_endpoint  = UltimateOAuthModule::stringify($last_called_endpoint);
                $this->user_id               = UltimateOAuthModule::stringify($user_id);
                $this->screen_name           = UltimateOAuthModule::stringify($screen_name);
            }
        }
        
        /**
         * A wrapper method for OAuthRequest().
         * 
         * @access public 
         * @param  string $endpoint Example: "users/show"
         * @param  mixed  [$params] An associative array or a urlencoded or non-urlencoded query string.
         * @return mixed            A response through json_deocde().
         *                          Generally returned as a stdClass object.
         *                          Some endpoints such as "statuses/home_timeline" returns an array if successful.
         * @see                     https://dev.twitter.com/docs/api/1.1
         */
        public function get($endpoint, $params = array()) {
            return $this->OAuthRequest($endpoint, 'GET', $params, true);
        }
        
        /**
         * A wrapper method for OAuthRequest().
         * 
         * @access public 
         * @param  string  $endpoint        Example: "statuses/update"
         * @param  mixed   [$params]        An associative array or a urlencoded or non-urlencoded query string.
         * @param  boolean [$wait_response] Whether synchronous or not. True as default.
         * @return mixed                    A response through json_deocde().
         *                                  Generlally returned as a stdClass object.
         *                                  The case $wait_response is disabled returns NULL. 
         * @see                             https://dev.twitter.com/docs/api/1.1
         */
        public function post($endpoint, $params = array(), $wait_response = true) {
            return $this->OAuthRequest($endpoint, 'POST', $params, $wait_response);
        }
        
        /**
         * Multipart post requests.
         * postMultipart() and OAuthRequestMultipart() are completely equal.
         * 
         * @access public 
         * @param  string  $endpoint        Example: "statuses/update_with_media"
         * @param  mixed   [$params]        An associative array or a urlencoded or non-urlencoded query string.
         * @param  boolean [$wait_response] Whether synchronous or not. True as default.
         * @return mixed                    A response through json_deocde().
         *                                  Generlally returned as a stdClass object.
         *                                  The case $wait_response is disabled returns NULL. 
         * @see                             https://dev.twitter.com/docs/api/1.1
         */
        public function postMultipart($endpoint, $params = array(), $wait_response = true) {
            // validate arguments
            self::modParameters($params);
            return $this->request($endpoint, 'POST', $params, true, $wait_response, false);
        }
        public function OAuthRequestMultipart($endpoint, $params = array(), $wait_response = true) {
            // validate arguments
            self::modParameters($params);
            return $this->request($endpoint, 'POST', $params, true, $wait_response, false);
        }
        
        /**
         * Used for requests mainly.
         * 
         * @access public 
         * @param  string  $endpoint        Example: "users/show"
         * @param  string  [$method]        "POST" or "GET". Case-insensitive. "GET" as default.
         * @param  mixed   [$params]        An associative array or a urlencoded or non-urlencoded query string.
         * @param  boolean [$wait_response] Whether synchronous or not. True as default.
         * @return mixed                    A response through json_deocde().
         *                                  Generlally returned as a stdClass object.
         *                                  Some endpoints such as "statuses/home_timeline" returns an array if successful.
         *                                  The case $wait_response is disabled returns NULL. 
         * @see                             https://dev.twitter.com/docs/api/1.1
         */
        public function OAuthRequest(
            $endpoint, $method = 'GET', $params = array(), $wait_response = true) {
            // validate arguments
            self::modParameters($params);
            return $this->request($endpoint, $method, $params, false, $wait_response, false);
        }
        
        /**
         * @access public 
         * @param  boolean [$force_login]
         * @return string                 URL for authorization.
         */
        public function getAuthorizeURL($force_login = false) {
            return sprintf('%s://%s/oauth/authorize?oauth_token=%s%s',
                UltimateOAuthConfig::DEFAULT_SCHEME,
                UltimateOAuthConfig::DEFAULT_HOST,
                $this->request_token,
                $force_login ? '&force_login=1' : ''
            );
        }
        
        /**
         * @access public 
         * @param  boolean [$force_login]
         * @return string                 URL for authentication.
         */
        public function getAuthenticateURL($force_login = false) {
            return sprintf('%s://%s/oauth/authenticate?oauth_token=%s%s',
                UltimateOAuthConfig::DEFAULT_SCHEME,
                UltimateOAuthConfig::DEFAULT_HOST,
                $this->request_token,
                $force_login ? '&force_login=1' : ''  
            );
        }
        
        /**
         * Para-xAuth authorization.
         * Don't use this method too much,
         * but reuse authorized UltimateOAuth objects by using serialize() and unserialize().
         * 
         * @access public 
         * @param  string   $username screen_name or E-mail address.
         * @param  string   $password 
         * @return stdClass           A stdClass object that has the following structure:
         *                             (string) $response->oauth_token
         *                             (string) $response->oauth_token_secret
         */
        public function directGetToken($username, $password) {
            
            try {
                
                // validate arguments
                $username = UltimateOAuthModule::stringify($username);
                $password = UltimateOAuthModule::stringify($password);
                // get request_token
                $res = $this->post('oauth/request_token');
                if (isset($res->errors)) {
                    return UltimateOAuthModule::createErrorObject(
                        $res->errors[0]->message,
                        $this->last_http_status_code
                    );
                }
                // get authorize URL
                $url = $this->getAuthorizeURL(true);
                // Get authenticity_token
                $res = $this->request($url, 'GET', array(), false, true, true);
                $pattern = '@<input name="authenticity_token" type="hidden" value="([^"]++)" />@';
                if (!preg_match($pattern, $res, $matches)) {
                    return UltimateOAuthModule::createErrorObject(
                        'Failed to fetch authenticity_token.',
                        -1
                    );
                }
                // get oauth_verifier
                $params = array(
                    'authenticity_token'         => $matches[1],
                    'oauth_token'                => $this->request_token,
                    'force_login'                => '1',
                    'session[username_or_email]' => $username,
                    'session[password]'          => $password,
                );
                $res = $this->request($url, 'POST', $params, false, true, true);
                $pattern = '@oauth_verifier=([^"]++)"|<code>([^<]++)</code>@';
                if (!preg_match($pattern, $res, $matches)) {
                    return UltimateOAuthModule::createErrorObject(
                        'Wrong username or password.',
                        -1
                    );
                }
                $this->oauth_verifier = !isset($matches[2]) ? $matches[1] : $matches[2];
                // get access_token
                $res = $this->post('oauth/access_token', array(
                    'oauth_verifier' => $this->oauth_verifier,
                ));
                if (isset($res->errors)) {
                    return UltimateOAuthModule::createErrorObject(
                        $res->errors[0]->message,
                        $this->last_http_status_code
                    );
                }
                // return an object
                return $res;
                
            } catch (Exception $e) {
                
                // return an error object
                return UltimateOAuthModule::createErrorObject(
                    $e->getMessage(),
                    $e->getCode()
                );
                
            }
        
        }
        
        /**************************/
        /**** Internal Methods ****/
        /**************************/
        
        /**
         * For read-only properties.
         * 
         * @magic
         * @access public 
         * @param  string $name
         * @return mixed
         */
        public function __get($name) {
            if (!isset($this->$name)) {
                throw new InvalidArgumentException("Undefined property: {$name}");
            }
            return $this->$name;
        }
        
        /**
         * Validate and modify parameters as appropriate formats.
         * 
         * @access private 
         * @static
         * @param  mixed   &$params
         */
        private static function modParameters(&$params) {
            if (is_string($params)) {
                // parse query string
                $new = array();
                $pairs = explode('&', $params);
                foreach ($pairs as $pair) {
                    list($k, $v) = explode('=', $pair, 2) + array(1 => '');
                    $new[urldecode($k)] = urldecode($v);
                }
            } elseif (!is_array($params) && is_object($params)) {
                // invalid params
                $new = array();
            } else {
                $new = $params;
            }
            $ret = array();
            foreach ($new as $key => $value) {
                // skip NULL
                if ($value === null) {
                    continue;
                }
                // convert FALSE to string "0"
                if ($value === false) {
                    $value = '0';
                }
                // stringification
                $ret[$key] = UltimateOAuthModule::stringify($value);
            }
            $params = $ret;
        }
        
        /**
         * Send a socket request.
         * 
         * @access private 
         * @param  string   $host
         * @param  string   $scheme
         * @param  string   $request
         * @param  boolean  $wait_response
         * @param  stdClass [$xauth_info]
         * @return mixed
         */
        private function connect($host, $scheme, $request, $wait_response, &$xauth_info) {
            // determine port
            if ($scheme === 'https') {
                $remote_socket = 'ssl://' . $host . ':' . 443;
            } else {
                $remote_socket = 'tcp://' . $host . ':' . 80;
            }
            // open socket
            $fp = @stream_socket_client($remote_socket, $errno, $errstr, 5, STREAM_CLIENT_CONNECT);
            if (!$fp) {
                throw new RuntimeException("Failed to connect to {$remote_socket}");
            }
            // set blocking mode
            if (!$wait_response) {
                stream_set_blocking($fp, 0);
            }
            // send request
            if (fwrite($fp, $request) === false) {
                fclose($fp);
                throw new RuntimeException('Failed to send request.');
            }
            // get response
            if ($wait_response) {
                $res = explode("\r\n\r\n", stream_get_contents($fp), 2) + array(1 => null);
                list(, $code) = explode(' ', $res[0], 3) + array(1 => '');
                if ($res[1] === null || !ctype_digit($code)) {
                    throw new RuntimeException('Invalid response.');
                }
                $this->last_http_status_code = (int)$code;
            }
            // close socket
            fclose($fp);
            // return NULL if response is not necessary
            if (!$wait_response) {
                return;
            }
            // set cookies and xAuth information
            $names = implode('|', array(
                '(set-cookie)',
                '(x-twitter-new-account-oauth-access-token)',
                '(x-twitter-new-account-oauth-secret)',
            ));
            $pattern = "/^(?:{$names}):(.+?)(?:;|$)/mi";
            if (preg_match_all($pattern, $res[0], $matches)) {
                foreach ($matches[1] as $i => $v) {
                    if ($v === '') {
                        continue;
                    }
                    $pair = explode('=', trim($matches[4][$i]), 2) + array(1 => '');
                    $this->cookie[$pair[0]] = $pair[1];
                }
                foreach ($matches[2] as $i => $v) {
                    if ($v === '') {
                        continue;
                    }
                    if (!is_object($xauth_info)) {
                        $xauth_info = new stdClass;
                    }
                    $xauth_info->access_token = trim($matches[4][$i]);
                }
                foreach ($matches[3] as $i => $v) {
                    if ($v === '') {
                        continue;
                    }
                    if (!is_object($xauth_info)) {
                        $xauth_info = new stdClass;
                    }
                    $xauth_info->access_token_secret = trim($matches[4][$i]);
                }
            }
            // return response body
            return $res[1];
        }
        
        /**
         * HTTP request.
         *
         * @access private 
         * @param  string  $uri
         * @param  string  $method
         * @param  string  $request
         * @param  boolean $wait_response
         * @return mixed
         */
        private function request($uri, $method, $params, $multipart, $wait_response, $scraping) {
            
            try {
                
                // initialize information of last API call
                $this->last_http_status_code = -1;
                $this->last_called_endpoint  = '';
                // validate arguments
                $uri    = UltimateOAuthModule::stringify($uri);
                $method = UltimateOAuthModule::stringify($method);
                $method = strtoupper($method);
                // parse uri
                $elements = UltimateOAuthModule::parseUri($uri);
                // combine parameters
                parse_str($elements['query'], $temp);
                $params += $temp;
                // set oauth_verifier
                if (
                    $elements['path'] === '/oauth/access_token' &&
                    isset($params['oauth_verifier'])
                ) {
                    $this->oauth_verifier = UltimateOAuthModule::stringify($params['oauth_verifier']);
                    unset($params['oauth_verifier']);
                }
                if (!$scraping) {
                    if (!$multipart) {
                        $_params = array();
                        foreach ($params as $key => $value) {
                            if (strpos($key, '@') === 0) {
                                // convert filenames to file binaries
                                $value = UltimateOAuthModule::stringify($value);
                                if ($value === '') {
                                    throw new InvalidArgumentException("Filename is empty.");
                                }
                                if (!is_file($value)) {
                                    throw new InvalidArgumentException("File \"{$value}\" not found.");
                                }
                                // set base64-encoded binaries
                                $_params[substr($key, 1)] = base64_encode(@file_get_contents($value));
                            } else {
                                $_params[$key] = $value;
                            }
                        }
                        $params = $_params;
                        unset($_params);
                    }
                    // get query string for OAuth authorization
                    $query = $this->getQueryString(
                        $elements['scheme'] . '://' . $elements['host'] . $elements['path'],
                        $elements['path'],
                        $method,
                        $params,
                        $multipart
                    );
                } else {
                    $query = http_build_query($params, '', '&');
                }
                // build path
                if ($method === 'GET') {
                    $path = $elements['path'] . '?' . $query;
                } else {
                    $path = $elements['path'];
                }
                // build header lines
                $ua = UltimateOAuthConfig::USER_AGENT;
                $lines = array(
                    "{$method} {$path} HTTP/1.0",
                    "Host: {$elements['host']}",
                    "User-Agent: {$ua}",
                    "Connection: Close",
                    "\r\n",
                );
                // add cookies
                if ($this->cookie) {
                    array_splice($lines, -1, 0, array(
                        'Cookie: ' . implode('; ', UltimateOAuthModule::pairize($this->cookie)),
                    ));
                }
                if ($multipart) {
                    // generate boundary
                    $boundary = '--------------' . sha1(microtime());
                    // build contents lines
                    $cts_lines = array();
                    foreach ($params as $key => $value) {
                        $cts_lines[] = '--' . $boundary;
                        // convert filenames to file binaries
                        if (strpos($key, '@') === 0) {
                            $value = UltimateOAuthModule::stringify($value);
                            if ($value === '') {
                                throw new InvalidArgumentException("Filename is empty.");
                            }
                            if (!is_file($value)) {
                                throw new InvalidArgumentException("File \"{$value}\" not found.");
                            }
                            $is_file = true;
                            $disposition = sprintf('form-data; name="%s"; filename="%s"',
                                substr($key, 1),
                                md5(mt_rand())
                            );
                        } else {
                            $is_file = false;
                            $disposition = sprintf('form-data; name="%s"', $key);
                        }
                        array_push($cts_lines,
                            "Content-Disposition: {$disposition}",
                            "Content-Type: application/octet-stream",
                            "",
                            $is_file ? @file_get_contents($value) : $value
                        );
                    }
                    $cts_lines[] = '--' . $boundary . '--';
                    // combine contents lines
                    $contents = implode("\r\n", $cts_lines);
                    // add header lines
                    $length = strlen($contents);
                    $adds = array(
                        "Authorization: OAuth {$query}",
                        "Content-Type: multipart/form-data; boundary={$boundary}",
                        "Content-Length: {$length}",
                    );
                    array_splice($lines, -1, 0, $adds);
                } elseif ($method === 'POST') {
                    // add header lines
                    $length = strlen($query);
                    $adds = array(
                        "Content-Type: application/x-www-form-urlencoded",
                        "Content-Length: {$length}",
                    );
                    array_splice($lines, -1, 0, $adds);
                }
                // combine header lines
                $request = implode("\r\n", $lines);
                if ($multipart) {
                    // add contents fields
                    $request .= $contents;
                } elseif ($method === 'POST') {
                    // add query to the post fields
                    $request .= $query;
                }
                // connect
                $res = $this->connect(
                    $elements['host'],
                    $elements['scheme'],
                    $request,
                    $wait_response,
                    $xauth_info
                );
                // update information of last API call
                $this->last_called_endpoint = $elements['path'];
                // return NULL or HTML
                if (!$wait_response || $scraping) {
                    return $res;
                }
                if (($json = json_decode($res)) === null) {
                    // check non-json_encoded error
                    if (stripos('Failed', $res) === 0) {
                        throw new RuntimeException($res);
                    }
                    // check endpoint
                    if (!preg_match('@^/oauth/((?:request|access)_token)$@', $elements['path'], $matches)) {
                        throw new RuntimeException('Failed to decode as JSON. There may be some errors on the request header.');
                    }
                    // parse OAuth query string
                    parse_str($res, $oauth_tokens);
                    if (!isset(
                        $oauth_tokens['oauth_token'],
                        $oauth_tokens['oauth_token_secret']
                    )) {
                        $xml = @simplexml_load_string($res);
                        if (isset($xml->error) && count($xml->error) === 1) {
                            throw new RuntimeException((string)$xml->error);
                        } else {
                            throw new RuntimeException('Failed to parse response that should contain oauth_token.');
                        }
                    }
                    // update properties
                    $b = ($a = $matches[1]) . '_secret';
                    $this->$a = $oauth_tokens['oauth_token'];
                    $this->$b = $oauth_tokens['oauth_token_secret'];
                    if (isset($oauth_tokens['user_id'], $oauth_tokens['screen_name'])) {
                        $this->user_id     = $oauth_tokens['user_id'];
                        $this->screen_name = $oauth_tokens['screen_name'];
                    }
                    // return object-converted response
                    return (object)$oauth_tokens;
                }
                // set additional xAuth information
                if (isset($xauth_info, $json->id)) {
                    $json->access_token        = $xauth_info->access_token;
                    $json->access_token_secret = $xauth_info->access_token_secret;
                }
                // modify deformed error response
                if (isset($json->error)) {
                    $json = (object)array(
                        'errors' => array(
                            (object)array(
                                'code'    => -1,
                                'message' => $json->error,
                            ),
                        ),
                    );
                } elseif (isset($json->errors) && !is_array($json->errors)) {
                    $json = (object)array(
                        'errors' => array(
                            (object)array(
                                'code'    => -1,
                                'message' => $json->errors,
                            ),
                        ),
                    );
                }
                // override error codes with HTTP status code
                if (isset($json->errors)) {
                    foreach ($json->errors as $error) {
                        $error->code = $this->last_http_status_code;
                    }
                }
                // return response
                return $json;
            
            } catch (Exception $e) {
                
                // return an error object
                return UltimateOAuthModule::createErrorObject(
                    $e->getMessage(),
                    $this->last_http_status_code
                );
            
            }
        
        }
        
        /**
         * Generate a query string for OAuth authorization.
         *
         * @access private 
         * @param  string  $uri
         * @param  string  $path
         * @param  string  $method
         * @param  array   $opt
         * @param  boolean $as_header
         * @return string
         */
        private function getQueryString($uri, $path, $method, $opt, $as_header) {
            // initialize parameters
            $parameters = array(
                'oauth_consumer_key'     => $this->consumer_key,
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_timestamp'        => time(),
                'oauth_nonce'            => md5(mt_rand()),
                'oauth_version'          => '1.0',
            );
            // add parameters
            if ($path === '/oauth/request_token') {
                $oauth_token_secret           = '';
            } elseif ($path === '/oauth/access_token') {
                $parameters['oauth_verifier'] = $this->oauth_verifier;
                $parameters['oauth_token']    = $this->request_token;
                $oauth_token_secret           = $this->request_token_secret;
            } else {
                $parameters['oauth_token']    = $this->access_token;
                $oauth_token_secret           = $this->access_token_secret;
            }
            if (!$as_header) {
                $parameters += $opt;
            }
            // build body for signature
            $body = implode(
                '&',
                array_map(
                    array(
                        'UltimateOAuthModule',
                        'enc',
                    ),
                    array(
                        $method,
                        $uri,
                        implode(
                            '&',
                            UltimateOAuthModule::pairize(
                                UltimateOAuthModule::nksort(
                                    array_map(
                                        array(
                                            'UltimateOAuthModule',
                                            'enc',
                                        ),
                                        $parameters
                                    )
                                )
                            )
                        ),
                    )
                )
            );
            // build key for signature
            $key = implode(
                '&',
                array_map(
                    array(
                        'UltimateOAuthModule',
                        'enc',
                    ),
                    array(
                        $this->consumer_secret,
                        $oauth_token_secret,
                    )
                )
            );
            // build signature
            $parameters['oauth_signature'] = base64_encode(hash_hmac('sha1', $body, $key, true));
            // return query string
            return implode(
                $as_header ?
                    ', ' :
                    '&'
                ,
                UltimateOAuthModule::pairize(
                    array_map(
                        array(
                            'UltimateOAuthModule',
                            'enc',
                        ),
                        $parameters
                    )
                )
            );
        }
        
    }
    
}

/**
 * UltimateOAuthMulti
 *
 * Multi request class.
 */
if (!class_exists('UltimateOAuthMulti')) {
    
    class UltimateOAuthMulti {
        
        /********************/
        /**** Properties ****/
        /********************/
        
        private $queues;
        private $filename;
        
        /***************************/
        /**** Interface Methods ****/
        /***************************/
        
        /**
         * Create a new UltimateOAuthMulti instance.
         * 
         * @access public 
         */
        public function __construct() {
            // initialize properties
            $this->queues   = array();
            $this->filename = str_replace('\\', '/', __FILE__);
        }
        
        /**
         * Enqueue a new request.
         * Note: Arguments containing binary data cannot be enqueued.
         *       You have to enqueue them with "@" prefix.
         *       e.x. "status=test&@media[]=test.jpg"
         * 
         * @access public
         * @param  UltimateOAuth $uo
         * @param  string        $method A method name. This meanas CLASS METHOD. Not a HTTP method.
         * @param  mixed         [...]   Additional arguments for the method.
         */
        public function enqueue(UltimateOAuth $uo, $method) {
            $this->queues[] = (object)array(
                'uo'     => $uo,
                'method' => UltimateOAuthModule::stringify($method),
                'args'   => array_slice(func_get_args(), 2),
            );
        }
        
        /**
         * Execute all requests.
         * 
         * @access public
         * @param  boolean [$wait_processes] Whether synchronous or not. True as default.
         * @param  boolean [$use_cwd]        Whether use current working directory,
         *                                   or use the directory this library exists in.
         *                                   False as default.
         *                                   This cannot be True when "USE_PROC_OPEN == False".
         * @return mixed                     An array contains responses or NULL.
         */
        public function execute($wait_processes = true, $use_cwd = false) {
            if (UltimateOAuthConfig::USE_PROC_OPEN) {
                $ret = $this->executeByProcOpen($wait_processes, $use_cwd);
            } elseif ($use_cwd) {
                throw new LogicException('$use_cwd cannot be True when "USE_PROC_OPEN == False".');
            } else {
                $ret = $this->executeByStreamSocketClient($wait_processes);
            }
            // clear queues
            $this->queues = array();
            return $ret;
        }
        
        /**************************/
        /**** Internal Methods ****/
        /**************************/
        
        /**
         * You can't serialize this object.
         * 
         * @magic 
         * @access public
         */
        public function __sleep() {
            throw BadMethodCallException('This object is not serializable.');
        }
        
        /**
         * Used if USE_PROC_OPEN == True.
         * 
         * @access private
         * @param  boolean $wait_processes
         * @param  boolean $use_cwd
         * @return mixed
         */
        private function executeByProcOpen($wait_processes, $use_cwd) {
            // prepare proc_open() arguments
            $descriptorspec = array(
                0 => array('pipe', 'r'),
                1 => array('pipe', 'w'),
                2 => array('pipe', 'w'),
            );
            $procs = $pipes = $res = $err_flags = array();
            // prepare PHP source
            $format = 
                '<?php ' . PHP_EOL . 
                'ob_start(); ' . PHP_EOL . 
                'require(\'%s\'); ' . PHP_EOL . 
                '$s = unserialize(\'%s\'); ' . PHP_EOL . 
                '$res = call_user_func_array(array($s->uo, $s->method), $s->args); ' . PHP_EOL . 
                '$res = serialize(array($s->uo, $res)); ' . PHP_EOL . 
                'ob_end_clean(); ' . PHP_EOL . 
                'echo $res; ' . PHP_EOL . 
                'exit();'
            ;
            // open processes
            foreach ($this->queues as $i => $queue) {
                $procs[$i] = @proc_open(
                    UltimateOAuthConfig::PHP_COMMAND,
                    $descriptorspec,
                    $pipes[$i],
                    $use_cwd ? dirname($_SERVER['SCRIPT_FILENAME']) : dirname(__FILE__),
                    null,
                    array(
                        'bypass_shell' => true,
                        'supress_errors' => true,
                    )
                );
                if (!$procs[$i]) {
                    continue;
                }
                // enable task to be executed parallelly
                stream_set_blocking($pipes[$i][0], 0);
                stream_set_blocking($pipes[$i][1], 0);
                stream_set_blocking($pipes[$i][2], 0);
                // bind values
                $adds = "\\'";
                $text = sprintf($format,
                    addcslashes($this->filename  , $adds),
                    addcslashes(serialize($queue), $adds)
                );
                // write PHP Source
                fwrite($pipes[$i][0], $text);
                fclose($pipes[$i][0]);
                // initialization
                $res[$i] = '';
                $err_flags[$i] = false;
            }
            // return if response is not necessary
            if (!$wait_processes) {
                return;
            } elseif (!$this->queues) {
                return array();
            }
            // get responses
            Do {
                $active = false;
                foreach ($pipes as $i => $pipe) {
                    if (!$procs[$i]) {
                        $res[$i] = 'Failed to start process.';
                        $err_flags[$i] = true;
                        unset($pipes[$i]);
                        continue;
                    }
                    while (!feof($pipe[1]) || !feof($pipe[2])) {
                        // select socket stream
                        $read = array($pipe[1], $pipe[2]);
                        $write = null;
                        $except = null;
                        if (!@stream_select($read, $write, $except, 5)) {
                            $res[$i] = 'Failed to select stream resource, or timeout.';
                            $err_flags[$i] = true;
                            fclose($pipe[1]);
                            fclose($pipe[2]);
                            proc_close($procs[$i]);
                            unset($pipes[$i]);
                            continue 2;
                        }
                        foreach ($read as $sock) {
                            // get data within 48000 bytes
                            $tmp = fread($sock, 48000);
                            if ($tmp === false) {
                                $res[$i] = 'Failed to read buffer.';
                                $err_flags[$i] = true;
                                fclose($pipe[1]);
                                fclose($pipe[2]);
                                proc_close($procs[$i]);
                                unset($pipes[$i]);
                                continue 3;
                            }
                            $active = true;
                            if ($sock === $pipe[2]) {
                                if (!$err_flags[$i] && $tmp !== '') {
                                    $err_flags[$i] = true;
                                    $res[$i] = '';
                                }
                                $res[$i] .= $tmp;
                                break;
                            }
                            if (!$err_flags[$i]) {
                                $res[$i] .= $tmp;
                            }
                        }
                    }
                }
            } while ($active);
            // free resources
            foreach ($pipes as $i => $pipe) {
                fclose($pipe[1]);
                fclose($pipe[2]);
                proc_close($procs[$i]);
            }
            // optimize responses
            $tmp = null;
            foreach ($res as $i => $r) {
                if ($err_flags[$i] || ($tmp = $i) === null || !is_array($r = @unserialize($r))) {
                    if ($tmp === $i) {
                        $r = 'Failed to get valid response.';
                    }
                    $res[$i] = UltimateOAuthModule::createErrorObject(strip_tags($r));
                    continue;
                }
                $res[$i] = $r[1];
                $this->queues[$i]->uo->setProperties(array(
                    'consumer_key'          => $r[0]->consumer_key,
                    'consumer_secret'       => $r[0]->consumer_secret,
                    'access_token'          => $r[0]->access_token,
                    'access_token_secret'   => $r[0]->access_token_secret,
                    'request_token'         => $r[0]->request_token,
                    'request_token_secret'  => $r[0]->request_token_secret,
                    'oauth_verifier'        => $r[0]->oauth_verifier,
                    'authenticity_token'    => $r[0]->authenticity_token,
                    'cookie'                => $r[0]->cookie,
                    'last_http_status_code' => $r[0]->last_http_status_code,
                    'last_called_endpoint'  => $r[0]->last_called_endpoint,
                    'user_id'               => $r[0]->user_id,
                    'screen_name'           => $r[0]->screen_name,
                ));
            }
            // return responses
            return $res;
        }
        
        /**
         * Used if USE_PROC_OPEN == False.
         * 
         * @access private
         * @param  boolean $wait_processes
         * @return mixed
         */
        private function executeByStreamSocketClient($wait_processes) {
            // prepare URI elements
            $uri = parse_url(UltimateOAuthConfig::FULL_URL_TO_THIS_FILE);
            if (!isset($uri['host'])) {
                $uri = false;
            } else {
                if (!isset($uri['path'])) {
                    $uri['path'] = '/';
                }
                if (!isset($uri['port'])) {
                    $uri['port'] = $uri['scheme'] === 'https' ? 443 : 80;
                }
                $protocol = $uri['scheme'] === 'https' ? 'ssl://' : 'tcp://';
                $remote_socket = $protocol . $uri['host'] . ':' . $uri['port'];
            }
            // open sockets
            $fps = $res = array();
            foreach ($this->queues as $i => $queue) {
                if ($uri === false) {
                    $fps[$i] = false;
                    continue;
                }
                $fps[$i] = @stream_socket_client(
                    $remote_socket,
                    $errno,
                    $errstr,
                    5,
                    STREAM_CLIENT_CONNECT
                );
                if (!$fps[$i]) {
                    continue;
                }
                // set blocking mode
                if (!$wait_processes) {
                    stream_set_blocking($fps[$i], 0);
                }
                stream_set_timeout($fps[$i], 60);
                $postfield = json_encode(array(
                    'uo' => array(
                        'consumer_key'          => $queue->uo->consumer_key,
                        'consumer_secret'       => $queue->uo->consumer_secret,
                        'access_token'          => $queue->uo->access_token,
                        'access_token_secret'   => $queue->uo->access_token_secret,
                        'request_token'         => $queue->uo->request_token,
                        'request_token_secret'  => $queue->uo->request_token_secret,
                        'oauth_verifier'        => $queue->uo->oauth_verifier,
                        'authenticity_token'    => $queue->uo->authenticity_token,
                        'cookie'                => $queue->uo->cookie,
                        'last_http_status_code' => $queue->uo->last_http_status_code,
                        'last_called_endpoint'  => $queue->uo->last_called_endpoint,
                        'user_id'               => $queue->uo->user_id,
                        'screen_name'           => $queue->uo->screen_name,
                    ),
                    'method' => $queue->method,
                    'args' => $queue->args,
                ));
                $postfield = http_build_query(array(
                    UltimateOAuthConfig::MULTIPLE_REQUEST_KEY_NAME => $postfield,
                ), '', '&');
                $length = strlen($postfield);
                $user_agent = UltimateOAuthConfig::USER_AGENT;
                $header = 
                    "POST {$uri['path']} HTTP/1.0\r\n".
                    "Host: {$uri['host']}\r\n".
                    "User-Agent: {$user_agent}\r\n".
                    "Connection: Close\r\n".
                    "Content-Type: application/x-www-form-urlencoded\r\n".
                    "Content-Length: {$length}\r\n".
                    "\r\n".
                    $postfield
                ;
                fwrite($fps[$i], $header);
                $res[$i] = '';
            }
            // return if response is not necessary
            if (!$wait_processes) {
                return;
            } elseif (!$this->queues) {
                return array();
            }
            // get responses
            Do {
                $active = false;
                foreach ($fps as $i => $fp) {
                    // Skip failed resourse
                    if (!$fp) {
                        $res[$i] = false;
                        unset($fps[$i]);
                        continue;
                    }
                    // skip failed result
                    if (($tmp = stream_get_contents($fp)) === false) {
                        $res[$i] = null;
                        fclose($fp);
                        unset($fps[$i]);
                        continue;
                    }
                    $res[$i] .= $tmp;
                    // check EOF
                    if (feof($fp)) {
                        fclose($fp);
                        unset($fps[$i]);
                        continue;
                    }
                    $active = true;
                }
            } while ($active);
            // check responses
            foreach ($res as $i => $r) {
                // invalid URI
                if ($uri === false) {
                    $res[$i] = UltimateOAuthModule::createErrorObject('invalid URI.');
                    continue;
                }
                // socket opening failure
                if ($r === false) {
                    $res[$i] = UltimateOAuthModule::createErrorObject("Failed to connect to {$remote_socket}");
                    continue;
                }
                // getting contents failure
                if ($r === null) {
                    $res[$i] = UltimateOAuthModule::createErrorObject('Failed to get stream contents.');
                    continue;
                }
                // empty string error
                if ($r === '') {
                    $res[$i] = UltimateOAuthModule::createErrorObject('Request to this file itself may be blocked.');
                    continue;
                }
                // invalid response
                $r = explode("\r\n\r\n", $r, 2) + array(1 => '');
                $r = json_decode($r[1]);
                if (!isset($r->result)) {
                    $res[$i] = UltimateOAuthModule::createErrorObject('Failed to get valid stream contents.');
                    continue;
                } 
                // get result
                $res[$i] = $r->result;
                // set properties
                if (isset(
                    $r->uo->consumer_key,
                    $r->uo->consumer_secret,
                    $r->uo->access_token,
                    $r->uo->access_token_secret,
                    $r->uo->request_token,
                    $r->uo->request_token_secret,
                    $r->uo->oauth_verifier,
                    $r->uo->authenticity_token,
                    $r->uo->cookie,
                    $r->uo->last_http_status_code,
                    $r->uo->last_called_endpoint,
                    $r->uo->uesr_id,
                    $r->uo->screen_name
                )) {
                    $this->queues[$i]->uo->setProperties((array)$r->uo);
                }
            }
            // return responses
            return $res;
        }
        
        /**
         * Output requested results.
         * 
         * @static
         * @access public
         */
        public static function checkRequest() {
            
            // check validity
            $key = UltimateOAuthConfig::MULTIPLE_REQUEST_KEY_NAME;
            if (UltimateOAuthConfig::USE_PROC_OPEN || !isset($_POST[$key])) {
                return;
            }
            
            try {
                
                // prepare error handler
                set_error_handler(array('UltimateOAuthModule', 'errorHandler'), E_ALL | E_STRICT);
                // check inputs
                $data = json_decode($_POST[$key]);
                if (!isset(
                    $data->uo->consumer_key,
                    $data->uo->consumer_secret,
                    $data->uo->access_token,
                    $data->uo->access_token_secret,
                    $data->uo->request_token,
                    $data->uo->request_token_secret,
                    $data->uo->oauth_verifier,
                    $data->uo->authenticity_token,
                    $data->uo->cookie,
                    $data->uo->last_http_status_code,
                    $data->uo->last_called_endpoint,
                    $data->uo->user_id,
                    $data->uo->screen_name,
                    $data->method,
                    $data->args
                )) {
                    throw new RuntimeException('Invalid POST data.');
                }
                // prepare for calling
                $uo = new UltimateOAuth(
                    $data->uo->consumer_key,
                    $data->uo->consumer_secret,
                    $data->uo->access_token,
                    $data->uo->access_token_secret,
                    $data->uo->request_token,
                    $data->uo->request_token_secret,
                    $data->uo->oauth_verifier,
                    $data->uo->authenticity_token,
                    $data->uo->cookie,
                    $data->uo->last_http_status_code,
                    $data->uo->last_called_endpoint,
                    $data->uo->user_id,
                    $data->uo->screen_name
                );
                $method = UltimateOAuthModule::stringify($data->method);
                $args   = UltimateOAuthModule::arrayfy($data->args);
                // check callability
                if (!is_callable(array($uo, $method))) {
                    throw new RuntimeException('Can\'t call "' . $method . '"');
                }
                // call
                $res = call_user_func_array(array($uo, $method), $args);
                // output result
                echo json_encode(array(
                    'result' => $res,
                    'uo'     => array(
                        'consumer_key'          => $data->uo->consumer_key,
                        'consumer_secret'       => $data->uo->consumer_secret,
                        'access_token'          => $data->uo->access_token,
                        'access_token_secret'   => $data->uo->access_token_secret,
                        'request_token'         => $data->uo->request_token,
                        'request_token_secret'  => $data->uo->request_token_secret,
                        'oauth_verifier'        => $data->uo->oauth_verifier,
                        'authenticity_token'    => $data->uo->authenticity_token,
                        'cookie'                => $data->uo->cookie,
                        'last_http_status_code' => $data->uo->last_http_status_code,
                        'last_called_endpoint'  => $data->uo->last_called_endpoint,
                        'user_id'               => $data->uo->user_id,
                        'screen_name'           => $data->uo->screen_name,
                    ),
                ));
                
            } catch (Exception $e) {
                
                echo json_encode(array(
                    'result' => $e->getMessage(),
                ));
                
            }
            
            exit();
            
        }
        
    }
    
}

/**
 * UltimateOAuthRotate
 *
 * Rotation managing class.
 * This enables you to avoid API limits easily.
 * Also you can use very useful secret endpoints.
 */
if (!class_exists('UltimateOAuthRotate')) {
    
    class UltimateOAuthRotate {
        
        /********************/
        /**** Properties ****/
        /********************/
        
        private $current;
        private $instances;
        
        /***************************/
        /**** Interface Methods ****/
        /***************************/
        
        /**
         * Create a new UltimateOAuthRotate instance.
         * 
         * @access public
         */
        public function __construct() {
            // initialize properties
            $this->current = array(
                'POST' => null,
                'GET'  => array(),
            );
            $this->instances = array(
                'original' => array(),
                'official' => array(),
                'signup'   => array(),
            );
            foreach ($tmp = UltimateOAuthModule::getOfficialKeys() as $name => $consumer) {
                $this->instances['official'][$name] = new UltimateOAuth(
                    $consumer['consumer_key'],
                    $consumer['consumer_secret']
                );
            }
            foreach (array_diff_key(UltimateOAuthModule::getOfficialKeys(true), $tmp) as $name => $consumer) {
                $this->instances['signup'][$name] = new UltimateOAuth(
                    $consumer['consumer_key'],
                    $consumer['consumer_secret']
                );
            }
        }
        
        /**
         * Select instance for POST request specified by name.
         * 
         * @access public
         * @param  string  $name The name you registered.
         * @return boolean       Whether configuration successful or not.
         */
        public function setCurrent($name) {
            foreach ($this->instances as $type => $keys) {
                foreach ($keys as $key => $instance) {
                    if ($key === $name) {
                        $this->current['POST'] = array($type, $name);
                        return true;
                    }
                }
            }
            return false;
        }
        
        /**
         * Register your original consumer_key.
         * Official ones cannot be overrided.
         * 
         * @access public
         * @param  string  $name            The unique application name.
         * @param  string  $consumer_key
         * @param  string  $consumer_secret
         * @return boolean                  Whether registeration successful or not.
         */
        public function register($name, $consumer_key, $consumer_secret) {
            if (isset($this->instances['official'][$name], $this->instances['signup'][$name])) {
                return false;
            }
            $this->instances['original'][$name] = new UltimateOAuth(
                $consumer_key,
                $consumer_secret
            );
            return true;
        }
        
        /**
         * Login.
         * This method can depends on UltimateOAuthMulti class.
         * 
         * @access public
         * @param  string  $username       screen_name or E-mail address.
         * @param  string  $password
         * @param  boolean [$return_array] Whether return responses as array,
         *                                 or if all successful as boolean.
         *                                 FALSE(Return Boolean) as default.
         * @param  boolean [$successively] Whether successively do all jobs,
         *                                 or parallelly do by UltimateOAuthMulti class.
         *                                 FALSE(By UltimateOAuthMulti) as default.
         * @return mixed
         */
        public function login($username, $password, $return_array = false, $successively = false) {
            if ($successively) {
                $keys = $this->instances['original'] + $this->instances['official'] + $this->instances['signup'];
                $res = array();
                foreach ($keys as $i => $uo) {
                    if (isset($fail)) {
                        $res[$i] = clone $fail;
                    } else {
                        $r = $uo->directGetToken($username, $password);
                        if (isset($r->errors) && $r->errors[0]->message === 'Wrong username or password.') {
                            $fail = $r;
                        }
                        $res[$i] = $r;
                    }
                }
            } else {
                $uom = new UltimateOAuthMulti;
                foreach ($this->instances as $keys) {
                    foreach ($keys as $instance) {
                        $uom->enqueue($instance, 'directGetToken', $username, $password);
                    }
                }
                $res = array_combine(
                    array_keys($this->instances['original'] + $this->instances['official'] + $this->instances['signup']),
                    $uom->execute()
                );
            }
            if (!$return_array) {
                foreach ($res as $r) {
                    if (isset($r->errors)) {
                        return false;
                    }
                }
                return true;
            } else {
                return $res;
            }
        }
        
        /**
         * @access public
         * @param  string $name  The name you registered.
         * @return mixed         Return the clone of instance specified by name or FALSE.
         */
        public function getInstance($name) {
            $arr = $this->instances['original'] + $this->instances['official'] + $this->instances['signup'];
            $count = count($arr);
            for ($i = 0; $i < $count; $i++) {
                $tmp = array_slice($arr, $i, 1, true);
                if (isset($tmp[$name])) {
                    return clone $tmp[$name];
                }
            }
            return false;
        }
        
        /*
         *  (array) getInstances() - Return the clones of all instances.
         *  
         *  $type  0 -> Return all instances
         *         1 -> Return official instances
         *         2 -> Return original instances
         *         3 -> Return sign-up  instances
         */
        public function getInstances($type = 0) {
            $type = abs((int)$type) % 4;
            $ret = array();
            foreach ($this->instances as $attr => $keys) {
                if (
                    $type === 0                         ||
                    $type === 1 && $attr === 'official' ||
                    $type === 2 && $attr === 'original' ||
                    $type === 3 && $attr === 'signup'
                ) {
                    foreach ($keys as $key => $instance) {
                        $ret[$key] = clone $instance;
                    }
                }
            }
            return $ret;
        }
        
        /**************************/
        /**** Internal Methods ****/
        /**************************/
        
        /**
         * You can call the methods in UltimateOAuth class.
         * 
         * @magic
         * @access public
         * @param  string $name
         * @param  array  $args
         * @return mixed
         */
        public function __call($name, $args) {
            
            try {
                
                // these endpoints require sign-up key
                $post_ex1 = array(
                    '/account/generate',
                );
                // these endpoints require official consumer_key
                $post_ex2 = array(
                    '/friendships/accept',
                    '/friendships/deny',
                    '/friendships/accept_all',
                );
                
                if (
                    !strcasecmp($name, 'get') ||
                    !strcasecmp($name, 'OAuthRequest') && (
                        isset($args[1]) && !strcasecmp($args[1], 'GET') ||
                        count($args) < 2
                    )
                ) {
                    /* GET request */
                    
                    // first argument is necessary
                    if (!isset($args[0])) {
                        throw new InvalidArgumentException('First argument is necessary.');
                    }
                    // get endpoint
                    $elements = UltimateOAuthModule::parseUri($args[0]);
                    $endpoint = $elements['path'];
                    // create table
                    $table = array_keys(UltimateOAuthModule::getOfficialKeys());
                    // count up
                    if (!isset($this->current['GET'][$endpoint])) {
                        $this->current['GET'][$endpoint] = 0;
                    } else {
                        $this->current['GET'][$endpoint]++;
                    }
                    // if the key doesn't exist, reset it to 0
                    if (!isset($table[$this->current['GET'][$endpoint]])) {
                        $this->current['GET'][$endpoint] = 0;
                    }
                    // select instance
                    $obj = $this->instances['official'][$table[$this->current['GET'][$endpoint]]];
                    // return result
                    return call_user_func_array(array($obj, $name), $args);
                    
                } elseif (
                    !strcasecmp($name, 'post') ||
                    !strcasecmp($name, 'OAuthRequest') && isset($args[1]) && !strcasecmp($args[1], 'POST') ||
                    !strcasecmp($name, 'OAuthRequestMultipart') ||
                    !strcasecmp($name, 'postMultipart')
                ) {
                    /* POST request */
                    
                    // get endpoint
                    $elements = UltimateOAuthModule::parseUri($args[0]);
                    $endpoint = $elements['path'];
                    // initialize if necessary
                    if ($this->current['POST'] === null) {
                        if ($this->instances['original']) {
                            $this->setCurrent(array_rand($this->instances['original']));
                        } else {
                            $this->setCurrent(array_rand($this->instances['official']));
                        }
                    }
                    // select instance
                    list($app_type, $app_name) = $this->current['POST'];
                    $obj = $this->instances[$app_type][$app_name];
                    do {
                        // judge if sign-up consumer_key necessary
                        foreach ($post_ex1 as $ex) {
                            if (strpos($endpoint, $ex) !== false) {
                                $obj = $this->instances['signup'][array_rand($this->instances['signup'])];
                                break 2;
                            }
                        }
                        // judge if official consumer_key necessary
                        foreach ($post_ex2 as $ex) {
                            if (strpos($endpoint, $ex) !== false) {
                                $obj = $this->instances['official'][array_rand($this->instances['official'])];
                                break 2;
                            }
                        }
                    } while (false);
                    // return result
                    return call_user_func_array(array($obj, $name), $args);
                    
                } else {
                    
                    throw new BadMethodCallException("Failed to call '{$name}'.");
                    
                }
                
            } catch (Exception $e) {
                
                // return an error object
                return UltimateOAuthModule::createErrorObject($e->getMessage());
                
            }
        
        }
        
    }
    
}

/**
 * UltimateOAuthModule
 *
 * Module static method class. 
 */
if (!class_exists('UltimateOAuthModule')) {
    
    class UltimateOAuthModule {
        
        /**
         * Natcasesort and return array.
         * 
         * @static
         * @access public
         * @param  array  $arr
         * @return array  Sorted array.
         */
        public static function nksort($arr) {
            uksort($arr, 'strnatcmp');
            return $arr;
        }
        
        /**
         * For PHP 5.2 bug.
         * 
         * @static
         * @access public
         * @param  string $str
         * @return string      Truely rawurlencoded string.
         */
        public static function enc($str) {
            return str_replace('%7E', '~', rawurlencode($str));
        }
        
        /**
         * Combine keys and values with "=".
         * 
         * @static
         * @access public
         * @param  array  $arr
         * @return array  Pairized array.
         */
        public static function pairize($arr) {
            $ret = array();
            foreach ($arr as $key => $value) {
                $ret[] = $key . '=' . $value;
            }
            return $ret;
        }
        
        /**
         * Safe casting to string.
         * 
         * @static
         * @access public
         * @param  array  $var
         * @return string      Casted value.
         */
        public static function stringify($var) {
            return
                (
                    !is_array($var) &&
                    !is_resource($var) &&
                    (!is_object($var) || method_exists($var, '__toString'))
                ) ? 
                (string) $var : 
                ''
            ;
        }
        
        /**
         * Safe casting to 1D array.
         * 
         * @static
         * @access public
         * @param  array  $var
         * @return string      Casted value.
         */
        public static function arrayfy($var) {
            $ret = array();
            if (is_array($var) || is_object($var)) {
                foreach ($var as $k => $v) {
                    $ret[$k] = self::stringify($v);
                }
            }
            return $ret;
        }
        
        /**
         * Create an error object.
         * 
         * @static
         * @access public
         * @param  string   $msg
         * @param  integer  [$code] -1 as default.
         * @return stdClass         An error object.
         */
        public static function createErrorObject($msg, $code = -1) {
            return (object)array(
                'errors' => array(
                    (object)array(
                        'code' => $code,
                        'message' => $msg,
                    ),
                ),
            );
        }
        
        /**
         * Convert errors to exceptions.
         * 
         * @static
         * @access public
         * @param  integer $errno
         * @param  integer $errstr
         * @param  integer $errfile
         * @param  integer $errline
         * @param  boolean          True for supressing native error handling.
         */
        public static function errorHandler($errno, $errstr, $errfile, $errline) {
            throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
            return false;
        }
        
        /**
         * A wrapper of parse_url().
         * 
         * @static
         * @access public
         * @param  string $uri
         * @return mixed       An array of parsed elements, or FALSE. 
         */
        public static function parseUri($uri) {
            $uri = self::stringify($uri);
            if ($uri === '' || ($elements = parse_url($uri)) === false) {
                throw new InvalidArgumentException('Invalid URI.');
            }
            if (!isset($elements['host'])) {
                $elements['host']   = UltimateOAuthConfig::DEFAULT_HOST;
                $elements['scheme'] = UltimateOAuthConfig::DEFAULT_SCHEME;
                $elements['path']   = preg_replace('@^/++@', '', $elements['path']);
                if (
                    strpos($elements['path'], '1/')   !== 0 &&
                    strpos($elements['path'], '1.1/') !== 0 &&
                    strpos($elements['path'], 'i/')   !== 0
                ) {
                    if (
                        strpos($elements['path'], 'activity/')  === 0 ||
                        strpos($elements['path'], '/activity/') !== false
                    ) {
                        $elements['path'] = '/' . UltimateOAuthConfig::DEFAULT_ACTIVITY_API_VERSION . '/' . $elements['path'];
                    } elseif (strpos($elements['path'], 'oauth2/') === 0) {
                        throw new LogicException('This library doesn\'t support OAuth 2 authentication flow.');
                    } elseif (strpos($elements['path'], 'oauth/') === 0) {
                        $elements['path'] = '/' . $elements['path'];
                        $is_oauth = true;
                    } elseif (strpos($elements['path'], 'account/generate') === 0) {
                        $elements['path'] = '/' . UltimateOAuthConfig::DEFAULT_GENERATE_API_VERSION . '/' . $elements['path'];
                    } else {
                        $elements['path'] = '/' . UltimateOAuthConfig::DEFAULT_API_VERSION . '/' . $elements['path'];
                    }
                } else {
                    $elements['path'] = '/'.$elements['path'];
                }
                if (!isset($is_oauth) && !preg_match('@\\.[^./]++$@', $elements['path'])) {
                    $elements['path'] .= '.json';
                }
            } elseif (!isset($elements['path'])) {
                $elements['path'] = '/';
            }
            if (!isset($elements['query'])) {
                $elements['query']  = '';
            }
            return $elements;
        }
        
        /**
         * Let's take advantage of leaked consumer_key.
         * 
         * @static
         * @access public
         * @param  boolean [$include_signup] Whether contains sign-up keys.
         *                                   (These doesn't have permisson to access direct messages.)
         *                                   FALSE as default.
         * @return array                     A 2D array of consumer_key information. 
         */
        public static function getOfficialKeys($include_signup = false) {
            $ret = array(
                'Twitter for iPhone' => array(
                    'consumer_key'    => 'IQKbtAYlXLripLGPWd0HUA',
                    'consumer_secret' => 'GgDYlkSvaPxGxC4X8liwpUoqKwwr3lCADbz8A7ADU',
                ),
                'Twitter for Android' => array(
                    'consumer_key'    => '3nVuSoBZnx6U4vzUxf5w',
                    'consumer_secret' => 'Bcs59EFbbsdF6Sl9Ng71smgStWEGwXXKSjYvPVt7qys',
                ),
                'Twitter for iPad' => array(
                    'consumer_key'    => 'CjulERsDeqhhjSme66ECg',
                    'consumer_secret' => 'IQWdVyqFxghAtURHGeGiWAsmCAGmdW3WmbEx6Hck',
                ),
                'Twitter for Mac' => array(
                    'consumer_key'    => '3rJOl1ODzm9yZy63FACdg',
                    'consumer_secret' => '5jPoQ5kQvMJFDYRNE8bQ4rHuds4xJqhvgNJM4awaE8',
                ),
                'Twitter for Windows Phone' => array(
                    'consumer_key'    => 'yN3DUNVO0Me63IAQdhTfCA',
                    'consumer_secret' => 'c768oTKdzAjIYCmpSNIdZbGaG0t6rOhSFQP0S5uC79g',
                ),
                'TweetDeck' => array(
                    'consumer_key'    => 'yT577ApRtZw51q4NPMPPOQ',
                    'consumer_secret' => '3neq3XqN5fO3obqwZoajavGFCUrC42ZfbrLXy5sCv8',
                ),
            );
            if ($include_signup) {
                $ret += array(
                    'Twitter for Android Sign-Up' => array(
                        'consumer_key'    => 'RwYLhxGZpMqsWZENFVw',
                        'consumer_secret' => 'Jk80YVGqc7Iz1IDEjCI6x3ExMSBnGjzBAH6qHcWJlo',
                    )
                );
            }
            return $ret;
        }
        
    }
    
}

// Check request to this file itself.
UltimateOAuthMulti::checkRequest();