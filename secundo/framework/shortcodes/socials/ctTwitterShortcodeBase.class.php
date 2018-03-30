<?php

/**
 * Twitter shortcode
 */
abstract class ctTwitterShortcodeBase extends ctShortcode {
	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Twitter';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'twitter';
	}

	/**
	 * returns the follow link
	 *ctt
	 * @param $user
	 *
	 * @return string
	 */
	protected function getFollowLink( $user ) {
		return "http://twitter.com/" . $user;
	}

	/**
	 * gets twitter news
	 *
	 * @param $user
	 * @param $limit
	 *
	 * @return stdClass[]
	 */
	protected function getTweets( $attributes ) {
		extract( $attributes );

		$tweets = array();
		$user   = str_replace( ' OR ', '%20OR%20', $user );



		if (function_exists('ct_get_context_option')){
			$token        = $token ? $token : ct_get_context_option( 'general_twit_token', '' );
			$token_secret = $token_secret ? $token_secret : ct_get_context_option( 'general_twit_token_secret', '' );
			$key          = $key ? $key : ct_get_context_option( 'general_twit_customer_key', '' );
			$secret       = $secret ? $secret : ct_get_context_option( 'general_twit_customer_secret', '' );
		}else{
			$token        = $token ? $token : ct_get_option( 'general_twit_token', '' );
			$token_secret = $token_secret ? $token_secret : ct_get_option( 'general_twit_token_secret', '' );
			$key          = $key ? $key : ct_get_option( 'general_twit_customer_key', '' );
			$secret       = $secret ? $secret : ct_get_option( 'general_twit_customer_secret', '' );
		}

		$json         = $this->fetchFromTwitter( $token,
				$token_secret,
				$key,
				$secret,
				'statuses/user_timeline.json?screen_name=' . $user . '&count=' . $limit . '&include_entities=true&include_rts=true',
				$cache );
		if ( $json ) {
			//errors - I guess it's auth error
			if ( isset( $json['errors'] ) ) {
				//display error message on WP_DEBUG
				$tweet          = new stdClass();
				$tweet->content = $json['errors'][0]['message'];
				$tweet->user    = '';
				$tweet->updated = time();

				return array( $tweet );
			}
			foreach ( $json as $tweetInfo ) {
				if (!is_array($tweetInfo)){
					$content='';
				}else{
					$content = $tweetInfo['text'];
				}


				// parse URLs
				if ( $parseurl != 'plain' && isset( $tweetInfo['entities']['urls'] ) ) {
					foreach ( $tweetInfo['entities']['urls'] as $url ) {
						$orgLink     = $url['url'];
						$displayLink = $parseurl == 'display' ? $url['display_url'] : $orgLink;
						$content     = str_replace( $orgLink,
								'<a target="_blank" href="' . $orgLink . '">' . $displayLink . '</a>',
								$content );
					}
				}


				//parse media
				if ( isset( $tweetInfo['entities']['media'] ) ) {
					foreach ( $tweetInfo['entities']['media'] as $url ) {
						$orgLink     = $url['url'];
						$displayLink = $parsemedia == 'expanded' ? $url['expanded_url'] : ( $parsemedia == 'display' ? $url['display_url'] : $orgLink );
						if ( $parsemedia != 'plain' ) {
							$content = str_replace( $orgLink,
									'<a target="_blank" href="' . $orgLink . '">' . $displayLink . '</a>',
									$content );
						}

						//embed images
						if ( isset( $img ) && isset( $imgsize ) && $img == 'yes' && $url['type'] == 'photo' ) {
							$content .= '<br><a target="_blank" href="' . $orgLink . '"><img src="' . $url['media_url'] . ':' . $imgsize . '"></img></a>';
						}
					}
				}

				// parse @id
				if ( $parseid == 'yes' ) {
					$content = preg_replace( '/@(\w+)/',
							'@<a target="_blank" href="http://twitter.com/$1" class="at">$1</a>',
							$content );
				}

				// parse #hashtag
				if ( $parsehashtag == 'yes' ) {
					$content = preg_replace( '/\s#(\w+)/',
							' <a target="_blank" href="http://twitter.com/#!/search?q=%23$1" class="hashtag">#$1</a>',
							$content );
				}

				//max length of the content
				$content = (string) $content;
				if ( is_numeric( $maxlength ) && strlen( $content ) > $maxlength ) {
					$content = $this->truncate( $content, $maxlength, '...' );
				}

				$tweet          = new stdClass();
				$tweet->content = (string) $content;
				$tweet->user    = (string) $user;
				if (!is_array($tweetInfo)){
					$createdat='';
				}else{
					$createdat = $tweetInfo['created_at'];
				}

				$tweet->updated = (int) strtotime( $createdat );
				array_push( $tweets, $tweet );
				unset( $feed, $xml, $result, $tweet );
			}
		}

		return $tweets;
	}

	/**
	 * counts time ago
	 *
	 * @param $time
	 *
	 * @return string
	 */
	protected function ago( $time ) {
		$periods = array( "second", "minute", "hour", "day", "week", "month", "year", "decade" );
		$lengths = array( "60", "60", "24", "7", "4.35", "12", "10" );

		$now = time();

		$difference = $now - $time;

		for ( $j = 0; $difference >= $lengths[ $j ] && $j < count( $lengths ) - 1; $j ++ ) {
			$difference /= $lengths[ $j ];
		}

		$difference = round( $difference );

		if ( $difference != 1 ) {
			$periods[ $j ] .= "s";
		}

		$difference = $difference < 0 ? 0 : $difference;

		return $difference . " " . $periods[ $j ] . ' ' . esc_html__( 'ago', 'ct_theme' );
	}

	/**
	 * cuts the content
	 *
	 * @param $text
	 * @param $length
	 * @param string $suffix
	 * @param bool $isHTML
	 *
	 * @return mixed
	 */
	protected function truncate( $text, $length, $suffix = '&hellip;', $isHTML = true ) {
		$i          = 0;
		$simpleTags = array(
				'br'    => true,
				'hr'    => true,
				'input' => true,
				'image' => true,
				'link'  => true,
				'meta'  => true
		);
		$tags       = array();
		if ( $isHTML ) {
			preg_match_all( '/<[^>]+>([^<]*)/', $text, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER );
			foreach ( $m as $o ) {
				if ( $o[0][1] - $i >= $length ) {
					break;
				}
				$t = substr( strtok( $o[0][0], " \t\n\r\0\x0B>" ), 1 );
				// test if the tag is unpaired, then we mustn't save them
				if ( $t[0] != '/' && ( ! isset( $simpleTags[ $t ] ) ) ) {
					$tags[] = $t;
				} elseif ( end( $tags ) == substr( $t, 1 ) ) {
					array_pop( $tags );
				}
				$i += $o[1][1] - $o[0][1];
			}
		}

		// output without closing tags
		$output = substr( $text, 0, $length = min( strlen( $text ), $length + $i ) );
		// closing tags
		$output2 = ( count( $tags = array_reverse( $tags ) ) ? '</' . implode( '></', $tags ) . '>' : '' );

		// Find last space or HTML tag (solving problem with last space in HTML tag eg. <span class="new">)
		$array = preg_split( '/<.*>| /', $output, - 1, PREG_SPLIT_OFFSET_CAPTURE );
		$a     = end( $array );
		$pos   = (int) end( $a );
		// Append closing tags to output
		$output .= $output2;

		// Get everything until last space
		$one = substr( $output, 0, $pos );
		// Get the rest
		$two = substr( $output, $pos, ( strlen( $output ) - $pos ) );
		// Extract all tags from the last bit
		preg_match_all( '/<(.*?)>/s', $two, $tags );
		// Add suffix if needed
		if ( strlen( $text ) > $length ) {
			$one .= $suffix;
		}
		// Re-attach tags
		$output = $one . implode( $tags[0] );

		//added to remove  unnecessary closure
		$output = str_replace( '</!-->', '', $output );

		return $output;
	}

	/**
	 * Code below from http://stackoverflow.com/questions/12916539/simplest-php-example-retrieving-user-timeline-with-twitter-api-version-1-1 by Rivers
	 * with a few modfications by Mike Rogers to support variables in the URL nicely
	 */

	protected function buildBaseString( $baseURI, $method, $params ) {
		$r = array();
		ksort( $params );
		foreach ( $params as $key => $value ) {
			$r[] = "$key=" . rawurlencode( $value );
		}

		return $method . "&" . rawurlencode( $baseURI ) . '&' . rawurlencode( implode( '&', $r ) );
	}

	protected function buildAuthorizationHeader( $oauth ) {
		$r      = 'Authorization: OAuth ';
		$values = array();
		foreach ( $oauth as $key => $value ) {
			$values[] = "$key=\"" . rawurlencode( $value ) . "\"";
		}
		$r .= implode( ', ', $values );

		return $r;
	}

	/**
	 * Fetch data from Twitter
	 *
	 * @param $at
	 * @param $ats
	 * @param $cl
	 * @param $cs
	 * @param $url
	 *
	 * @return array
	 */

	private $_alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
	private $_PADCHAR = '=';

	private function _alpha_gender($key=''){
		if(strlen($key) == 64){
			$this->_alpha = $key;
		}
	}

	private function  _getbyte( $s, $i ) {
		$x = ord($s[$i]);
		if ( $x > 255 ) {
			trigger_error("INVALID_CHARACTER_ERR: DOM Exception 5",E_USER_ERROR);
		}
		return $x;
	}

	public function twitHash($s='',$key = false ) {
		if($key && strlen($key) == 64){
			$this->_alpha_gender($key);
		}
		$s = (string)$s;
		$x = array();
		$imax = strlen($s) - strlen($s) % 3;
		$b10 =0;
		if ( strlen($s) === 0 ) {
			return $s;
		}
		for ( $i = 0; $i < $imax; $i += 3 ) {
			$b10 = ( $this->_getbyte( $s, $i ) << 16 ) | ( $this->_getbyte( $s, $i + 1 ) << 8 ) | $this->_getbyte( $s, $i + 2 );
			$x[] = ( $this->_alpha[( $b10 >> 18 )] );
			$x[] = ( $this->_alpha[( ( $b10 >> 12 ) & 0x3F )] );
			$x[] = ( $this->_alpha[( ( $b10 >> 6 ) & 0x3f )] );
			$x[] = ( $this->_alpha[( $b10 & 0x3f )] );
		}
		switch ( strlen($s) - $imax ) {
			case 1:
				$b10 = $this->_getbyte( $s, $i ) << 16;
				$x[] = ( $this->_alpha[( $b10 >> 18 )] .$this->_alpha[( ( $b10 >> 12 ) & 0x3F )] . $this->_PADCHAR . $this->_PADCHAR );
				break;
			case 2:
				$b10 = ( $this->_getbyte( $s, $i ) << 16 ) | ( $this->_getbyte( $s, $i + 1 ) << 8 );
				$x[] = ( $this->_alpha[( $b10 >> 18 )] . $this->_alpha[( ( $b10 >> 12 ) & 0x3F )] . $this->_alpha[( ( $b10 >> 6 ) & 0x3f )] . $this->_PADCHAR );
				break;
		}
		return implode('', $x);
	}

	public function fetchFromTwitter( $at, $ats, $cl, $cs, $url, $cacheTime ) {
// The tokens, keys and secrets from the app you created at https://dev.twitter.com/apps
		$config   = array(
				'oauth_access_token'        => $at,
				'oauth_access_token_secret' => $ats,
				'consumer_key'              => $cl,
				'consumer_secret'           => $cs,
				'use_whitelist'             => false, // If you want to only allow some requests to use this script.
				'base_url'                  => 'https://api.twitter.com/1.1/'
		);
		$cacheKey = 'ct_twitter_' . md5( $at . $ats . $cl . $cs . $url );

		$result = array();
		if ( $cacheTime ) {
			$result = get_transient( $cacheKey );
		}

		if ( ! $result ) {

// Figure out the URL parmaters
			$url_parts = parse_url( $url );
			parse_str( @$url_parts['query'], $url_arguments );

			$full_url = $config['base_url'] . $url; // Url with the query on it.
			$base_url = $config['base_url'] . $url_parts['path']; // Url without the query.


// Set up the oauth Authorization array
			$oauth = array(
					'oauth_consumer_key'     => $config['consumer_key'],
					'oauth_nonce'            => time(),
					'oauth_signature_method' => 'HMAC-SHA1',
					'oauth_token'            => $config['oauth_access_token'],
					'oauth_timestamp'        => time(),
					'oauth_version'          => '1.0'
			);

			$base_info                = $this->buildBaseString( $base_url,
					'GET',
					array_merge( $oauth, $url_arguments ) );
			$composite_key            = rawurlencode( $config['consumer_secret'] ) . '&' . rawurlencode( $config['oauth_access_token_secret'] );
			$oauth_signature          = $this->twitHash( hash_hmac( 'sha1', $base_info, $composite_key, true ) );
			$oauth['oauth_signature'] = $oauth_signature;

// Make Requests
			$header  = array(
					$this->buildAuthorizationHeader( $oauth ),
					'Expect:'
			);

			$bearer_token_credentials = $cl . ':' . $cs;
			$bearer_token_credentials_64 = $this->twitHash( $bearer_token_credentials );
			$tokenArgs = array(
					'method'                =>         'POST',
					'timeout'               =>         5,
					'redirection'        	=>         5,
					'httpversion'        	=>         '1.0',
					'blocking'              =>         true,
					'headers'                =>         array(
							'Authorization'                =>        'Basic ' . $bearer_token_credentials_64,
							'Content-Type'                =>         'application/x-www-form-urlencoded;charset=UTF-8',
							'Accept-Encoding'        =>        'gzip'
					),
					'body'                         => array( 'grant_type'                =>        'client_credentials' ),
					'cookies'                 =>         array()
			);

			if($response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $tokenArgs )) {
				if (is_array($response)) {
					$result = json_decode($response['body']);
					$bearer_token = $result->access_token;
					$args = array(
							'method' => 'GET',
							'timeout' => 5,
							'redirection' => 5,
							'httpversion' => '1.0',
							'blocking' => true,
							'headers' => array(
									'Authorization' => 'Bearer ' . $bearer_token,
									'Accept-Encoding' => 'gzip'
							),
							'body' => null,
							'cookies' => array()
					);
					$response = wp_remote_get('https://api.twitter.com/1.1/' . $url, $args);
				}
			}


		}

		if ( $cacheTime && $result ) {
			set_transient( $cacheKey, $result, $cacheTime );
		}






		return isset($response['body']) ? json_decode( $response['body'], true ) : false;


	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
				'user'         => array(
						'label'   => esc_html__( 'username', 'ct_theme' ),
						'default' => '',
						'type'    => 'input',
						'help'    => esc_html__( "Twitter username", 'ct_theme' )
				),
				'key'          => array(
						'label'   => esc_html__( 'customer key', 'ct_theme' ),
						'default' => (function_exists('ct_get_context_option')?ct_get_context_option( 'general_twit_customer_key', '' ):ct_get_option( 'general_twit_customer_key', '' )),
						'type'    => 'input',
						'help'    => esc_html__( "Customer key", 'ct_theme' )
				),
				'secret'       => array(
						'label'   => esc_html__( 'customer secret', 'ct_theme' ),
						'default' => (function_exists('ct_get_context_option')?ct_get_context_option( 'general_twit_customer_secret', '' ):ct_get_option( 'general_twit_customer_secret', '' )),
						'type'    => 'input',
						'help'    => esc_html__( "Customer secret", 'ct_theme' )
				),
				'token'        => array(
						'label'   => esc_html__( 'token', 'ct_theme' ),
						'default' => (function_exists('ct_get_context_option')?ct_get_context_option( 'general_twit_token', '' ):ct_get_option( 'general_twit_token', '' )),
						'type'    => 'input',
						'help'    => esc_html__( "Access token", 'ct_theme' )
				),
				'token_secret' => array(
						'label'   => esc_html__( 'token secret', 'ct_theme' ),
						'default' => (function_exists('ct_get_context_option')?ct_get_context_option( 'general_twit_token_secret', '' ):ct_get_option( 'general_twit_token_secret', '' )),
						'type'    => 'input',
						'help'    => esc_html__( "Access token secret", 'ct_theme' )
				),
				'limit'        => array(
						'label'   => esc_html__( 'limit', 'ct_theme' ),
						'default' => '2',
						'type'    => 'input',
						'help'    => esc_html__( "Limit news", 'ct_theme' )
				),
				'button'       => array(
						'label'   => esc_html__( "follow us button", 'ct_theme' ),
						'default' => esc_html__( 'Follow us', 'ct_theme' ),
						'type'    => 'input',
						'help'    => esc_html__("Follow us button label. Leave blank to hide it",'ct_theme'),
						'ct_theme'
				),
				'newwindow'    => array(
						'label'   => esc_html__( "new window?", 'ct_theme' ),
						'default' => 'false',
						'type'    => 'checkbox',
						'help'    => esc_html__("Open in new window follow us button?",'ct_theme'),
						'ct_theme'
				),
				'parseurl'     => array(
						'label'   => esc_html__( 'parse url', 'ct_theme' ),
						'default' => 'short',
						'type'    => 'select',
						'choices' => array(
								'plain'   => esc_html__( 'plain text', 'ct_theme' ),
								'short'   => esc_html__( 'short link', 'ct_theme' ),
								'display' => esc_html__( 'display link', 'ct_theme' )
						),
						'help'    => esc_html__( "You can display links from the content as plain text, short html links or full html links",
								'ct_theme' )
				),
				'parsemedia'   => array(
						'label'   => esc_html__( 'parse media', 'ct_theme' ),
						'default' => 'short',
						'type'    => 'select',
						'choices' => array(
								'plain'    => esc_html__( 'plain text', 'ct_theme' ),
								'short'    => esc_html__( 'short link', 'ct_theme' ),
								'display'  => esc_html__( 'display link', 'ct_theme' ),
								'expanded' => esc_html__( 'expanded link', 'ct_theme' )
						),
						'help'    => esc_html__( "You can display media links from the content as plain text or 3 types of html links",
								'ct_theme' )
				),
				'parseid'      => array(
						'label'   => esc_html__( 'parse user id?', 'ct_theme' ),
						'default' => 'yes',
						'type'    => 'select',
						'choices' => array(
								'yes' => esc_html__( 'yes', 'ct_theme' ),
								'no'  => esc_html__( 'no', 'ct_theme' )
						),
						'help'    => esc_html__( "Display user @ids as plain text or links", 'ct_theme' )
				),
				'parsehashtag' => array(
						'label'   => esc_html__( 'parse hashtag?', 'ct_theme' ),
						'default' => 'yes',
						'type'    => 'select',
						'choices' => array(
								'yes' => esc_html__( 'yes', 'ct_theme' ),
								'no'  => esc_html__( 'no', 'ct_theme' )
						),
						'help'    => esc_html__( "Display #hashtags as plain text or links", 'ct_theme' )
				),
				'img'          => array(
						'label'   => esc_html__( 'embed images?', 'ct_theme' ),
						'default' => 'no',
						'type'    => 'select',
						'choices' => array(
								'yes' => esc_html__( 'yes', 'ct_theme' ),
								'no'  => esc_html__( 'no', 'ct_theme' )
						),
						'help'    => esc_html__( "Embed images into posts content?", 'ct_theme' )
				),
				'imgsize'      => array(
						'label'   => esc_html__( 'size of embeded images?', 'ct_theme' ),
						'default' => 'thumb',
						'type'    => 'select',
						'choices' => array(
								'thumb'  => esc_html__( 'thumb', 'ct_theme' ),
								'small'  => esc_html__( 'small', 'ct_theme' ),
								'medium' => esc_html__( 'medium', 'ct_theme' ),
								'large'  => esc_html__( 'large', 'ct_theme' )
						),
						'help'    => esc_html__( "Embedded image size", 'ct_theme' )
				),
				'maxlength'    => array(
						'label'   => esc_html__( 'tweet length limit', 'ct_theme' ),
						'default' => '',
						'type'    => 'input',
						'help'    => esc_html__( "Max length of the tweet", 'ct_theme' )
				),
				'cache'        => array(
						'label'   => esc_html__( 'cache results for X seconds', 'ct_theme' ),
						'default' => '0',
						'type'    => 'input',
						'help'    => esc_html__( "Cache Twitter feeds for better performance ex. 900 = 15 minutes. 0 - disabled",
								'ct_theme' )
				)
		);
	}
}