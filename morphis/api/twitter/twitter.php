<?php 

if ( !class_exists('PulpFramework_Twitter') ) {

	class PulpFramework_Twitter {
	
		public $ID;				// twitter user name
		public $TweetCount;			// tweets to fetch
		public $WidgetTemplate;	// widget template
		public $TweetTemplate;	// template for each tweet
		public $ParseLinks;		// parse links in Twitter status
		public $DateFormat;		// PHP or "friendly" dates
		public $CacheFor;		// number of seconds to cache feed
		private $cache;			// location of cache files
	
		// constructor
		public function __construct( $id = null, $count = 0, $widgetized = true, $app = null ) {
			// constants
			//$this->cache = get_template_directory()  . '/api/twitter/cache/';	// cache location
			$this->CacheFor = 1800;				// cache feed for 15 minutes
			$this->ID = $id;
			$this->TweetCount = $count;
			$this->ParseLinks = true;
			$this->DateFormat = 'friendly'; //'g:ia j F y';
			// default widget template
			$this->WidgetTemplate =
				//'<li class="jta-tweet-list-item"><div class="jta-tweet-body"><span class="jta-tweet-text">{text}</span></div>{created_at}</li>';
				'<ul class="jta-tweet-list">{TWEETS}</ul>';
			// default tweet template
			$default_tweet_template = '';
			if( true === $widgetized ) {
				$default_tweet_template = '<ul class="jta-tweet-list"><li class="jta-tweet-list-item"><div class="jta-tweet-body"><span class="jta-tweet-text">{text}</span></div><i>{created_at}</i></li></ul>';
			} else {
				$default_tweet_template = '<ul class="jta-tweet-list"><li class="jta-tweet-list-item"><div class="jta-tweet-body"><span class="jta-tweet-text">{text}</span></div></li></ul>';
			}
			$this->TweetTemplate = $default_tweet_template;
			$this->DisplayAsWidget = $widgetized;
			if( $app !== null ) {
				$this->consumer_key = $app['consumer_key'];
				$this->consumer_secret = $app['consumer_secret'];
				$this->access_token = $app['access_token'];
				$this->access_token_secret = $app['access_token_secret'];
			}
		} // end constructor
		
		function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
		  $connection = new Pulp_TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
		  return $connection;
		}
	
		public function FetchFeed() {
			$r = '';
			if ($this->ID != '' && $this->TweetCount > 0) {
		
				//$r = wp_remote_retrieve_body(wp_remote_get('https://api.twitter.com/1/statuses/user_timeline.json?screen_name=' . $this->ID . '&count=' . $this->TweetCount, 
				//		array ( 'sslverify' => false )));
				$connection = $this->getConnectionWithAccessToken($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_token_secret);
				$r = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$this->ID."&count=".$this->TweetCount) or die('Couldn\'t retrieve tweets! Wrong username?');
				
			}
			
			//$tweets_col = array();
			
			//foreach( $r as $tweet_obj) {
			//	$tweets_col[] = (array) $tweet_obj;
			//}
			
			//$arr_t = array($r);
			// return JSON as array
			return (!!$r ? $r : false); //(!!$r ? json_decode($r, true) : false);
		}
		
		// ______________________________________________
		// returns formatted feed widget
		public function Render() {
			
			//echo 'start render >> ';
			
			// returned HTML string
			$render = '';
			
			// the cache file
			$cache = $this->ID . '-' . $this->TweetCount;
			$transient_twitter = get_transient( $cache );
			
			// if cache file is non-existent OR cache file is already old, then fetch twitter feed
			if ( false === $transient_twitter || empty( $transient_twitter ) ) {
			
				// fetch feed
				$json = $this->FetchFeed();

				if ($json) {
				
					// to do: 	check if the $json has an 'error'.
					//			if it has, then don't update the file, retrieve and display it instead.
					if( !isset( $json['error'] ) ) {

						$widget = '';
						$status = '';
					
						// examine all tweets
						for ($t = 0, $tl = count($json); $t < $tl; $t++) {
							
							// parse widget template
							if ($t == 0 && $this->DisplayAsWidget ) {
								$widget .= $this->ParseStatus($json[$t], $this->WidgetTemplate);
							}
							
							// parse tweet
							$status .= $this->ParseStatus($json[$t], $this->TweetTemplate);
							
						}
					
						// parse Twitter links
						if ( !$this->DisplayAsWidget ) {
							$render = $status;
						} else {
							$tmpstatus1 = str_replace( '<ul class="jta-tweet-list">', '', $status );
							$status = str_replace( '</ul>', '', $tmpstatus1 );
							$render = str_replace('{TWEETS}', $status, $widget);
						}
						

						// update cache file
						$transient_twitter_set = set_transient( $cache, $render, $this->CacheFor );
						
					} else {
						//echo 'json has error >> ';
					}
				
				} else {
					//echo 'no feed fetched >> ';
				}
			
			} else {
				
				$render = $transient_twitter;
			}
			
			return $this->ParseDates($render);
		
		}
		
		
		// ______________________________________________
		// parses tweet data
		private function ParseStatus($data, $template) {
		
			// replace all {tags}
			preg_match_all('/{(.+)}/U', $template, $m);
			for ($i = 0, $il = count($m[0]); $i < $il; $i++) {
				
				$name = $m[1][$i];
			
				// Twitter value found?
				$d = false;
				if (isset($data->$name)) {
					$d = $data->$name;
				}
				else if (isset($data->user->$name)) {
					$d = $data->user->$name;
				}
				
				// replace data
				if ($d) {
				
					switch ($name) {
						
						// parse status links
						case 'text':
							if ($this->ParseLinks) {
								$d = $this->ParseTwitterLinks($d);
							}
							break;
							
						// tweet date
						case 'created_at':
							$d = "{DATE:$d}";
							break;
					
					}
				
					$template = str_replace($m[0][$i], $d, $template);

				}
			
			}
			
			return $template;
		
		}
		
		
		// ______________________________________________
		// parses Twitter links
		private function ParseTwitterLinks($str) {
		
			// parse URL
			$str = preg_replace('/(https{0,1}:\/\/[\w\-\.\/#?&=]*)/', '<a href="$1">$1</a>', $str);
		
			// parse @id
			$str = preg_replace('/@(\w+)/', '@<a href="http://twitter.com/$1" class="at">$1</a>', $str);
			
			// parse #hashtag
			$str = preg_replace('/\s#(\w+)/', ' <a href="http://twitter.com/#!/search?q=%23$1" class="hashtag">#$1</a>', $str);

			return $str;
		
		}
		
		// ______________________________________________
		// parses Tweet dates
		private function ParseDates($str) {
		
			// current datetime
			$now = new DateTime();
		
			preg_match_all('/{DATE:(.+)}/U', $str, $m);
			for ($i = 0, $il = count($m[0]); $i < $il; $i++) {
				
				$stime = new DateTime($m[1][$i]);
				
				if ($this->DateFormat == 'friendly') {

					// friendly date format
					$ival =  date_diff( $now, $stime );
					
					$yr = $ival->y;
					$mh = $ival->m + ($ival->d > 15);
					if ($mh > 11) $yr = 1;
					$dy = $ival->d + ($ival->h > 15);
					$hr = $ival->h;
					$mn = $ival->i + ($ival->s > 29);
					
					if ($yr > 0) {
						if ($yr == 1) $date = 'last year';
						else $date = $yr . ' years ago';
					}
					else if ($mh > 0) {
						if ($mh == 1) $date = 'last month';
						else $date = $mh . ' months ago';
					}
					else if ($dy > 0) {
						if ($dy == 1) $date = 'yesterday';
						else if ($dy < 8) $date = $dy . ' days ago';
						else if ($dy < 15) $date = 'last week';
						else $date = round($dy / 7) . ' weeks ago';
					}
					else if ($hr > 0) {
						$hr += ($ival->i > 29);
						$date = $hr . ' hour' . ($hr == 1 ? '' : 's') . ' ago';
					}
					else {
						if ($mn < 3) $date = 'just now';
						else $date = $mn . ' minutes ago';
					}

				}
				else {
					// standard PHP date format
					$date = $stime->format($this->DateFormat);
				}
				
				// replace date
				$str = str_replace($m[0][$i], $date, $str);
			
			}

			return $str;
		}
	
	}

}

/**
 * Workaround for PHP < 5.3.0
 */
if(!function_exists('date_diff')) {
    class DateInterval {
        public $y;
        public $m;
        public $d;
        public $h;
        public $i;
        public $s;
        public $invert;
        
        public function format($format) {
            $format = str_replace('%R%y', ($this->invert ? '-' : '+') . $this->y, $format);
            $format = str_replace('%R%m', ($this->invert ? '-' : '+') . $this->m, $format);
            $format = str_replace('%R%d', ($this->invert ? '-' : '+') . $this->d, $format);
            $format = str_replace('%R%h', ($this->invert ? '-' : '+') . $this->h, $format);
            $format = str_replace('%R%i', ($this->invert ? '-' : '+') . $this->i, $format);
            $format = str_replace('%R%s', ($this->invert ? '-' : '+') . $this->s, $format);
            
            $format = str_replace('%y', $this->y, $format);
            $format = str_replace('%m', $this->m, $format);
            $format = str_replace('%d', $this->d, $format);
            $format = str_replace('%h', $this->h, $format);
            $format = str_replace('%i', $this->i, $format);
            $format = str_replace('%s', $this->s, $format);
            
            return $format;
        }
    }

    function date_diff(DateTime $date1, DateTime $date2) {
        $diff = new DateInterval();
        if($date1 > $date2) {
            $tmp = $date1;
            $date1 = $date2;
            $date2 = $tmp;
            $diff->invert = true;
        }
        
        $diff->y = ((int) $date2->format('Y')) - ((int) $date1->format('Y'));
        $diff->m = ((int) $date2->format('n')) - ((int) $date1->format('n'));
        if($diff->m < 0) {
            $diff->y -= 1;
            $diff->m = $diff->m + 12;
        }
        $diff->d = ((int) $date2->format('j')) - ((int) $date1->format('j'));
        if($diff->d < 0) {
            $diff->m -= 1;
            $diff->d = $diff->d + ((int) $date1->format('t'));
        }
        $diff->h = ((int) $date2->format('G')) - ((int) $date1->format('G'));
        if($diff->h < 0) {
            $diff->d -= 1;
            $diff->h = $diff->h + 24;
        }
        $diff->i = ((int) $date2->format('i')) - ((int) $date1->format('i'));
        if($diff->i < 0) {
            $diff->h -= 1;
            $diff->i = $diff->i + 60;
        }
        $diff->s = ((int) $date2->format('s')) - ((int) $date1->format('s'));
        if($diff->s < 0) {
            $diff->i -= 1;
            $diff->s = $diff->s + 60;
        }
        
        return $diff;
    }
}
?>