<?php










namespace Drone;








class Func
{

	

	const FILESLIST_DIR = -1;

	const MINIFY_EXPIRATION   = 1209600; 
	const MINIFY_BUFFER_COUNT = 32;

	const GOOGLE_API_URL  = 'https://www.googleapis.com/%s/v%d/%s?%s'; 
	const VIMEO_API_URL   = 'http://vimeo.com/api/v%d/%s/%s.%s'; 
	const TWITTER_API_URL = 'https://api.twitter.com/1.1/%s.%s'; 
	const FLICKR_API_URL  = 'https://api.flickr.com/services/rest/?%s'; 

	const GOOGLE_API_KEY = 'AIzaSyARAFF6E2rcXjEh-iDxt6o4K9U_SJaiEBI';
	const FLICKR_API_KEY = 'c27f067622def4f043a80cd7d9273033';

	

	







	public static function boolToString($bool)
	{
		if (is_string($bool)) {
			$bool = self::stringToBool($bool);
		}
		return (bool)$bool ? 'true' : 'false';
	}

	

	









	public static function intRange($val, $min = null, $max = null)
	{
		$val = intval($val);
		if ($min !== null) $val = max($val, $min);
		if ($max !== null) $val = min($val, $max);
		return $val;
	}

	

	








	public static function intRandJitter($val, $jitter = 0)
	{
		return mt_rand($val-$jitter, $val+$jitter);
	}

	

	







	public static function stringToBool($s)
	{
		if (is_bool($s)) {
			return $s;
		} else {
			$s = strtolower(trim((string)$s));
			return !in_array($s, array('', '0', '-1', 'false', 'f', 'no', 'n', 'null'), true);
		}
	}

	

	










	public static function stringMBSubstrReplace($str, $replacement, $start, $length)
	{
		return mb_substr($str, 0, $start).$replacement.mb_substr($str, $start+$length);
	}

	

	










	public static function stringCut($s, $maxlen, $end = '...', $endlen = null)
	{
		if ($endlen === null) {
			$endlen = strlen($end);
		}
		return strlen($s) > $maxlen ? rtrim(mb_substr($s, 0, $maxlen-$endlen)).$end : $s;
	}

	

	








	public static function stringID($s, $separator = '-')
	{

		
		$separators = '-_. \/|';
		$preg_separators = preg_quote($separators, '/');

		
		$s = str_replace(array('&amp;', '&'), $separator.'and'.$separator, $s);

		
		$s = preg_replace('/[^'.$preg_separators.'a-z0-9\[\]]/i', '', $s);

		
		static $arrays = array();
		$s = preg_replace_callback('/\[(?P<key>.*?)\]/', function($m) use ($s, &$arrays, $separator) {
			switch ($m['key']) {
				case '':
					$arrays[$s] = isset($arrays[$s]) ? $arrays[$s]+1 : 0;
					return $separator.$arrays[$s].$separator;
				case '__i__':
				case '__n__':
					return $separator.'$'.trim($m['key'], '_').$separator;
				default:
					return $separator.$m['key'].$separator;
			}
		}, $s);

		
		$s = preg_replace('/([^A-Z])([A-Z])|([^0-9])([0-9])/', "\\1\\3{$separator}\\2\\4", $s);
		$s = preg_replace('/['.$preg_separators.']+/', $separator, $s);

		
		$s = trim(strtolower($s), $separators);

		
		$s = str_replace(array('$i', '$n'), array('__i__', '__n__'), $s);

		
		return $s;

	}

	

	







	public static function stringPascalCase($s)
	{
		return preg_replace_callback('/(^|[-_\. ]+)([a-z])/i', function($m) { return strtoupper($m[2]); }, trim($s, '-_. '));
	}

	

	







	public static function stringCamelCase($s)
	{
		return lcfirst(self::stringPascalCase($s));
	}

	

	








	public static function stringToHTML($s, $surrounding_paragraph = true)
	{
		$s = str_replace("\r", '', $s);
		$s = preg_replace('/\n{3,}/', "\n\n", $s);
		$s = str_replace(array("\n\n", "\n"), array('</p><p>', '<br />'), $s);
		return $surrounding_paragraph ? '<p>'.$s.'</p>' : $s;
	}

	

	







	public static function stringExtractURL($s)
	{
		return $s && preg_match('#((https?://|mailto:).+)(\b|["\'])#i', $s, $m) ? $m[1] : false;
	}

	

	







	public static function arrayContent(array $haystack)
	{
		return array_filter($haystack, function($e) { return !empty($e); });
	}

	

	









	public static function arraySwap(array $haystack, $key1, $key2)
	{
		$temp = $haystack[$key1];
		$haystack[$key1] = $haystack[$key2];
		$haystack[$key2] = $temp;
		return $haystack;
	}

	

	









	public static function arrayInsert(array $haystack, array $array, $subsequent)
	{
		if (($pos = array_search($subsequent, array_keys($haystack))) !== false) {
			return array_slice($haystack, 0, $pos, true) + $array + array_slice($haystack, $pos, null, true);
		} else {
			return $haystack + $array;
		}
	}

	

	









	public static function arrayImplodeEx($glue, $container, array $pieces)
	{
		foreach ($pieces as &$value) {
			$value = $container.$value.$container;
		}
		unset($value);
		return implode($glue, $pieces);
	}

	

	









	public static function arrayMapRecursive($callback, array $haystack)
	{
		if (is_array($haystack)) {
			foreach ($haystack as &$value) {
				$value = self::arrayMapRecursive($callback, $value);
			}
			unset($value);
		} else {
			$haystack = call_user_func($callback, $haystack);
		}
		return $haystack;
	}

	

	









	public static function arrayKeysMap($callback, array $haystack) {
		$_haystack = array();
		foreach ($haystack as $key => $value) {
			$_haystack[call_user_func($callback, $key)] = $value;
		}
		return $_haystack;
	}

	

	







	public static function arrayKeysToCamelCase(array $haystack)
	{
		return self::arrayKeysMap('\Drone\Func::stringCamelCase', $haystack);
	}

	

	








	public static function arrayArrange(array $haystack, array $keys)
	{
		$_haystack = array();
		foreach ($keys as $key) {
			if (isset($haystack[$key])) {
				$_haystack[$key] = $haystack[$key];
			}
		}
		return $_haystack;
	}

	

	









	public static function arrayColumn(array $haystack, $key, $value)
	{
		$_haystack = array();
		foreach ($haystack as $row) {
			if (isset($row[$key], $row[$value])) {
				$_haystack[$row[$key]] = $row[$value];
			} else if (isset($row->{$key}, $row->{$value})) {
				$_haystack[$row->{$key}] = $row->{$value};
			}
		}
		return $_haystack;
	}

	

	













	public static function arraySerialize(array $haystack, $format = 'url')
	{
		if (empty($haystack)) {
			return '';
		}
		switch ($format) {
			case 'url':
				$func = function(&$val, $key) { $val = $key.'='.urlencode($val); };
				$glue = '&';
				break;
			case 'html':
				$func = function(&$val, $key) { $val = $key.'="'.esc_attr($val).'"'; };
				$glue = ' ';
				break;
			default:
				$func = function(&$val, $key) { $val = $key.'='.$val; };
				$glue = "\n";
		}
		array_walk($haystack, $func);
		return implode($glue, $haystack);
	}

	

	








	public static function functionGetOutputBuffer($function)
	{
		ob_start();
		call_user_func_array($function, array_slice(func_get_args(), 1));
		return ob_get_clean();
	}

	

	










	public static function functionSwitch(array $haystack, $needle = true, $strict = false, $fallback = null)
	{
		foreach ($haystack as $func => $value) {
			foreach (explode(',', $func) as $func) {
				if (!preg_match('/^([-_a-z0-9]+)(\(([^,\(\)]*)\))?$/i', $func, $matches)) {
					continue;
				}
				$name   = $matches[1];
				$params = isset($matches[3]) && $matches[3] ? explode(' ', $matches[3]) : array();
				if (!function_exists($name)) {
					continue;
				}
				$result = call_user_func_array($name, $params);
				if (
					(($strict === false) && $result == $needle) ||
					(($strict === true) && $result === $needle)
				) {
					return $value;
				}
			}
		}
		return $fallback;
	}

	

	







	public static function objectGetVars($object)
	{
		return get_object_vars($object);
	}

	

	








	public static function objectSetVars($object, array $vars)
	{
		foreach ($vars as $key => $value) {
			$object->{$key} = $value;
		}
		return $object;
	}

	

	











	public static function filesList($dir, $filter = '', $on_file = null)
	{

		$dir = rtrim($dir, '/\\');

		if (!is_dir($dir)) {
			return array();
		}

		if (is_array($filter)) {
			$filter = '/\.('.implode('|', $filter).')$/i';
		}

		$files = array();
		foreach (scandir($dir) as $basename) {
			if ($basename == '.' || $basename == '..') {
				continue;
			}
			if ($filter === self::FILESLIST_DIR) {
				if (!is_dir($dir.'/'.$basename)) {
					continue;
				}
			} else if ($filter) {
				if (!preg_match($filter, $basename)) {
					continue;
				}
			}
			$index = count($files);
			if (is_callable($on_file)) {
				$pathinfo = pathinfo($dir.'/'.$basename);
				call_user_func_array($on_file, array(&$index, &$basename, $pathinfo));
			}
			$files[$index] = $basename;
		}

		return $files;

	}

	

	









	public static function colorRGBToHSL($r, $g = 0, $b = 0)
	{

		if (is_array($r)) {
			list($r, $g, $b) = $r;
		} else if (is_string($r) && self::cssIsColor($r)) {
			list($r, $g, $b) = self::cssColorToDec($r);
		}

		$r /= 255;
		$g /= 255;
		$b /= 255;

		$max = max($r, $g, $b);
		$min = min($r, $g, $b);

		$l = ($max + $min) / 2;
		$d = $max - $min;

		if ($d == 0) {
			$h = $s = 0; 
		} else {
			$s = $d / (1 - abs(2*$l - 1));
			switch ($max) {
				case $r:
					$h = 60 * fmod((($g - $b) / $d), 6);
					if ($b > $g) {
						$h += 360;
					}
					break;
				case $g:
					$h = 60 * (($b - $r) / $d + 2);
					break;
				case $b:
					$h = 60 * (($r - $g) / $d + 4);
					break;
			}
		}

		return array((int)round($h), $s, $l);

	}

	

	









	public static function colorHSLToRGB($h, $s = 0, $l = 0)
	{

		if (is_array($h)) {
			list($h, $s, $l) = $h;
		}

		$c = (1 - abs(2*$l - 1)) * $s;
		$x = $c * (1 - abs(fmod(($h / 60), 2) - 1));
		$m = $l - ($c / 2);

		if ($h < 60) {
			$r = $c;
			$g = $x;
			$b = 0;
		} else if ($h < 120) {
			$r = $x;
			$g = $c;
			$b = 0;
		} else if ($h < 180) {
			$r = 0;
			$g = $c;
			$b = $x;
		} else if ($h < 240) {
			$r = 0;
			$g = $x;
			$b = $c;
		} else if ($h < 300) {
			$r = $x;
			$g = 0;
			$b = $c;
		} else {
			$r = $c;
			$g = 0;
			$b = $x;
		}

		$r = ($r + $m) * 255;
		$g = ($g + $m) * 255;
		$b = ($b + $m) * 255;

		return array((int)floor($r), (int)floor($g), (int)floor($b));

	}

	

	







	public static function cssIsColor($s)
	{
		return preg_match('/^#([0-9a-f]{3}|[0-9a-f]{6})|rgba?\([ ,\.0-9]+\)$/i', (string)$s);
	}

	

	







	public static function cssDecToColor($color)
	{
		if (func_num_args() > 1) {
			$color = func_get_args();
		} else {
			$color = (array)$color;
		}
		switch (count($color)) {
			case 1: return vsprintf('#%1$02x%1$02x%1$02x', $color);
			case 2: return vsprintf('rgba(%1$d, %1$d, %1$d, %2$.2f)', $color);
			case 3: return vsprintf('#%02x%02x%02x', $color);
			case 4: return vsprintf('rgba(%d, %d, %d, %.2f)', $color);
		}
	}

	

	







	public static function cssColorToDec($color)
	{
		if (preg_match('/^#?(?|([0-9a-f])([0-9a-f])([0-9a-f])|([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2}))$/i', $color, $matches)) {
			foreach (array_slice($matches, 1) as $match) {
				$hex = strlen($match) == 1 ? $match.$match : $match;
				$dec[] = hexdec($hex);
			}
			return $dec;
		} else if (preg_match('/rgba\((?P<r>[0-9]{1,3}), *(?P<g>[0-9]{1,3}), *(?P<b>[0-9]{1,3}), *(?P<a>[\.0-9]+)\)/i', $color, $matches)) {
			return array(
				(int)$matches['r'],
				(int)$matches['g'],
				(int)$matches['b'],
				(float)$matches['a']
			);
		} else {
			return false;
		}
	}

	

	








	public static function cssHexToRGBA($color, $alpha = 1)
	{
		$dec = self::cssColorToDec($color);
		$dec[] = $alpha;
		return self::cssDecToColor($dec);
	}

	

	










	public static function cssFontFace($dir, $uri, $filename, $family = null)
	{

		$exts = array('eot', 'woff', 'ttf', 'svg');

		$dir = rtrim($dir, '/\\');
		$uri = rtrim($uri, '/\\');

		if ($family === null) {
			$family = $filename;
		}

		
		$formats = self::filesList($dir, '/^'.preg_quote($filename, '/').'\.(?i:'.implode('|', $exts).')$/', function(&$index, &$basename, $pathinfo) use ($filename) {
			$index = strtolower($pathinfo['extension']);
		});

		if (count($formats) == 0) {
			return '';
		}

		$formats = array_merge(array_flip($exts), $formats);

		
		$src = array(array(), array());

		foreach ($formats as $ext => $basename) {

			switch ($ext) {

				case 'eot':
					$src[0][$ext] = sprintf('url("%s/%s")', $uri, $basename);
					$src[1][$ext] = sprintf('url("%s/%s?#iefix") format("embedded-opentype")', $uri, $basename);
					break;

				case 'woff':
					$src[1][$ext] = sprintf('url("%s/%s") format("woff")', $uri, $basename);
					break;

				case 'ttf':
					$src[1][$ext] = sprintf('url("%s/%s") format("truetype")', $uri, $basename);
					break;

				case 'svg':
					$id = $family;
					if (($svg = @file_get_contents($dir.'/'.$basename, false, null, -1, 4096)) !== false) {
						if (preg_match('/<font[^>]* id="([^"]+)"/i', $svg, $m)) {
							$id = $m[1];
						}
					}
					$src[1][$ext] = sprintf('url("%s/%s#%s") format("svg")', $uri, $basename, $id);
					break;

			}

		}

		foreach ($src as $i => $_src) {
			$src_string[$i] = count($_src) > 0 ? sprintf('src: %s;', implode(', ', $_src)) : '';
		}

		
		$css =
<<<"EOS"
			@font-face {
				font-family: "{$family}";
				font-weight: normal;
				font-style:  normal;
				{$src_string[0]}
				{$src_string[1]}
			}
EOS
		;

		if (isset($src[1]['svg'])) {
			$css .=
<<<"EOS"
				@media screen and (-webkit-min-device-pixel-ratio: 0) {
					@font-face {
						font-family: "{$family}";
						src: {$src[1]['svg']};
					}
				}
EOS
			;
		}

		return $css;

	}

	

	











	public static function minify($type, $source, $cache_transient = false)
	{

		
		if ($cache_transient !== false) {
			$checksum = md5($type.$source);
			if (($_source = get_transient($cache_transient)) !== false && isset($_source[$checksum])) {
				return $_source[$checksum];
			}
		}

		
		require_once get_template_directory().'/'.DIRECTORY.'/ext/minify/css_js.php';
		switch ($type) {
			case 'css':
				$source = str_replace("\n", ' ', Minify_CSS_Compressor::process($source));
				break;
			case 'js':
				$source = JSMin::minify($source);
				break;
		}

		
		if ($cache_transient !== false) {
			if ($_source === false) {
				$_source = array();
			}
			$_source[$checksum] = $source;
			while (count($_source) > self::MINIFY_BUFFER_COUNT) {
				array_shift($_source);
			}
			set_transient($cache_transient, $_source, self::MINIFY_EXPIRATION);
		}

		return $source;

	}

	

	







	public static function videoGetDetails($url)
	{

		
		if (preg_match('#^https?://(www\.)?youtube\.com/(embed/|watch\?v=)(?P<id>[-_a-z0-9]+)\b#i', $url, $matches)) {
			if (($video = self::googleGetVideoDetails(self::GOOGLE_API_KEY, $matches['id'])) === false) {
				return false;
			}
			try {
				$duration = new \DateInterval($video->contentDetails->duration);
				$duration = $duration->d*DAY_IN_SECONDS + $duration->h*HOUR_IN_SECONDS + $duration->i*MINUTE_IN_SECONDS + $duration->s;
			} catch (\Exception $e) {
				return false;
			}
			return array(
				'title'       => $video->snippet->title,
				'description' => $video->snippet->description,
				'duration'    => $duration
			);
		}

		
		else if (preg_match('#^https?://((www|player)\.)?vimeo\.com/(video/)?(?P<id>[0-9]+)\b#i', $url, $matches)) {
			if (($video = self::vimeoGetVideoDetails($matches['id'])) === false) {
				return false;
			}
			return array(
				'title'       => $video->title,
				'description' => str_replace('<br />', "\n", $video->description),
				'duration'    => $video->duration
			);
		}

		return false;

	}

	

	











	public static function googleRequest($api_key, $version, $resource, $subresource, array $params = array())
	{
		$params += array(
			'key' => $api_key
		);
		$url = sprintf(self::GOOGLE_API_URL, $resource, $version, $subresource, self::arraySerialize($params));
		$response = wp_remote_get($url, array('sslverify' => false));
		$body = wp_remote_retrieve_body($response);
		if (empty($body)) {
			return false;
		}
		if (($response = json_decode($body)) === null) {
			return false;
		}
		if (isset($response->error)) {
			return false;
		}
		return $response;
	}

	

	









	public static function googleGetFonts($api_key, $sort = 'alpha')
	{
		$params = array(
			'sort' => $sort
		);
		if (($response = self::googleRequest($api_key, 1, 'webfonts', 'webfonts', $params)) === false) {
			return false;
		}
		return $response->items;
	}

	

	









	public static function googleGetVideoDetails($api_key, $id)
	{
		$params = array(
			'part' => 'snippet,contentDetails',
			'id'   => $id
		);
		if (($response = self::googleRequest($api_key, 3, 'youtube', 'videos', $params)) === false) {
			return false;
		}
		return $response->items[0];
	}

	

	









	public static function vimeoRequest($version, $resource, $params = array())
	{
		$url = sprintf(self::VIMEO_API_URL, $version, $resource, implode('/', $params), 'json');
		$response = wp_remote_get($url, array('sslverify' => false));
		$body = wp_remote_retrieve_body($response);
		if (empty($body)) {
			return false;
		}
		if (($response = json_decode($body)) === null) {
			return false;
		}
		return $response;
	}

	

	







	public static function vimeoGetVideoDetails($id)
	{
		$params = array(
			$id
		);
		if (($response = self::vimeoRequest(2, 'video', $params)) === false) {
			return false;
		}
		if (!isset($response[0])) {
			return false;
		}
		return $response[0];
	}

	

	










	public static function twitterRequest($oauth, $resource, array $params = array())
	{

		require_once get_template_directory().'/'.DIRECTORY.'/ext/oauth/oauth.php';

		
		if (!isset($oauth['consumer_key'])        || !$oauth['consumer_key'] ||
			!isset($oauth['consumer_secret'])     || !$oauth['consumer_secret'] ||
			!isset($oauth['access_token'])        || !$oauth['access_token'] ||
			!isset($oauth['access_token_secret']) || !$oauth['access_token_secret']) {
			return false;
		}

		
		$consumer = new OAuthConsumer($oauth['consumer_key'], $oauth['consumer_secret']);
		$token    = new OAuthConsumer($oauth['access_token'], $oauth['access_token_secret']);

		
		$request = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', sprintf(self::TWITTER_API_URL, $resource, 'json'), $params);
		$request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, $token);

		
		$response = wp_remote_get($request->to_url(), array('sslverify' => false));
		$body = wp_remote_retrieve_body($response);

		
		if (empty($body)) {
			return false;
		}
		if (($response = json_decode($body)) === null) {
			return false;
		}
		if (isset($response->errors)) {
			return false;
		}
		return $response;

	}

	

	











	public static function twitterGetTweets($oauth, $username, $include_retweets = true, $exclude_replies = false, $count = 20)
	{

		
		$params = array(
			'screen_name'     => $username,
			'include_rts'     => $include_retweets,
			'exclude_replies' => $exclude_replies,
			'count'           => $include_retweets && !$exclude_replies ? min($count, 50) : 50, 
			'trim_user'       => false
		);
		if (($response = self::twitterRequest($oauth, 'statuses/user_timeline', $params)) === false) {
			return false;
		}

		
		$tweets = array();
		foreach ($response as $data) {

			
			$entities = array();
			foreach ($data->entities->hashtags as $hashtag) {
				$entities[$hashtag->indices[0]] = array(
					'__type' => 'hashtag',
					'length' => $hashtag->indices[1]-$hashtag->indices[0],
					'text'   => $hashtag->text
				);
			}
			foreach ($data->entities->user_mentions as $user_mention) {
				$entities[$user_mention->indices[0]] = array(
					'__type'      => 'user_mention',
					'length'      => $user_mention->indices[1]-$user_mention->indices[0],
					'screen_name' => $user_mention->screen_name
				);
			}
			foreach ($data->entities->urls as $url) {
				$entities[$url->indices[0]] = array(
					'__type'       => 'url',
					'length'       => $url->indices[1]-$url->indices[0],
					'url'          => $url->url,
					'expanded_url' => $url->expanded_url,
					'display_url'  => $url->display_url
				);
			}
			if (isset($data->entities->media)) {
				foreach ($data->entities->media as $media) {
					$entities[$media->indices[0]] = array(
						'__type'      => 'media',
						'length'      => $media->indices[1]-$media->indices[0],
						'type'        => $media->type,
						'media_url'   => is_ssl() ? $media->media_url_https : $media->media_url,
						'display_url' => $media->display_url
					);
				}
			}
			krsort($entities);
			$html = $text = (string)$data->text;
			foreach ($entities as $pos => $entity) {
				$len = $entity['length'];
				switch ($entity['__type']) {
					case 'hashtag':
						$html = self::stringMBSubstrReplace(
							$html,
							sprintf('<a href="http://twitter.com/#!/search?q=%%23%s" title="#%s">#%s</a>', $entity['text'], $entity['text'], $entity['text']),
							$pos, $len
						);
						break;
					case 'user_mention':
						$html = self::stringMBSubstrReplace(
							$html,
							sprintf('<a href="http://twitter.com/#!/%s">@%s</a>', $entity['screen_name'], $entity['screen_name']),
							$pos, $len
						);
						break;
					case 'url':
						$html = self::stringMBSubstrReplace(
							$html,
							sprintf('<a href="%s" title="%s">%s</a>', $entity['url'], $entity['expanded_url'], $entity['display_url']),
							$pos, $len
						);
						break;
					case 'media':
						$html = self::stringMBSubstrReplace(
							$html,
							sprintf('<a href="%s" data-type="%s">%s</a>', $entity['media_url'], $entity['type'], $entity['display_url']),
							$pos, $len
						);
						break;
				}
			}

			
			$tweets[] = array(
				'id'   => $data->id_str,
				'date' => strtotime($data->created_at),
				'url'  => sprintf('http://twitter.com/%s/status/%s', $data->user->screen_name, $data->id_str),
				'text' => $text,
				'html' => $html
			);

			
			if (count($tweets) >= $count) {
				break;
			}

		}

		
		return $tweets;

	}

	

	










	public static function flickrRequest($api_key, $method, array $params = array())
	{
		$params += array(
			'api_key' => $api_key,
			'method'  => $method,
			'format'  => 'php_serial'
		);
		$url = sprintf(self::FLICKR_API_URL, self::arraySerialize($params));
		$response = wp_remote_get($url, array('sslverify' => false));
		$body = wp_remote_retrieve_body($response);
		if (empty($body)) {
			return false;
		}
		if (($response = @unserialize($body)) === false) {
			return false;
		}
		if ($response['stat'] != 'ok') {
			return false;
		}
		return $response;
	}

	

	








	public static function flickrGetUserdata($api_key, $username)
	{
		if (($response[0] = self::flickrRequest($api_key, 'flickr.people.findByUsername', array('username' => $username))) === false) {
			return false;
		}
		if (($response[1] = self::flickrRequest($api_key, 'flickr.urls.getUserPhotos', array('user_id' => $response[0]['user']['nsid']))) === false) {
			return false;
		}
		$userdata = array(
			'id'       => $response[0]['user']['nsid'],
			'username' => $response[0]['user']['username']['_content'],
			'url'      => $response[1]['user']['url']
		);
		return $userdata;
	}

	

	










	public static function flickrGetPhotos($api_key, $user_id, $count = 100)
	{
		$params = array(
			'user_id'  => $user_id,
			'per_page' => $count
		);
		if (($response = self::flickrRequest($api_key, 'flickr.people.getPublicPhotos', $params)) === false) {
			return false;
		}
		$scheme = is_ssl() ? 'https' : 'http';
		$photos = array();
		foreach ($response['photos']['photo'] as $data) {
			$photos[] = array(
				'title' => $data['title'],
				'src'   => "{$scheme}://farm{$data['farm']}.staticflickr.com/{$data['server']}/{$data['id']}_{$data['secret']}_%s.jpg",
				'url'   => "{$scheme}://www.flickr.com/photos/{$data['owner']}/{$data['id']}"
			);
		}
		return $photos;
	}

	

	











	public static function wpPagesList(array $args = array(), $key = 'ID', $value = 'post_title', $indent_str = '&mdash; ') 
	{
		if (($_pages = get_pages($args)) === false) {
			return array();
		}
		$pages       = array();
		$pages_by_id = array();
		foreach ($_pages as $page) {
			$pages[$page->{$key}] = $value ? $page->{$value} : $page;
			$pages_by_id[$page->ID] = $page;
		}
		if ((!isset($args['hierarchical']) || $args['hierarchical']) && $key === 'ID' && $indent_str !== '') {
			$indents = array();
			foreach ($pages as $id => $page) {
				$indents[$id] = $pages_by_id[$id]->post_parent > 0 && isset($indents[$pages_by_id[$id]->post_parent]) ? $indents[$pages_by_id[$id]->post_parent]+1 : 0;
				$indent       = str_repeat($indent_str, $indents[$id]);
				if ($page instanceof \WP_Post) {
					$page->post_title = $indent.$page->post_title;
				} else {
					$pages[$id] = $indent.$pages[$id];
				}
			}
		}
		return $pages;
	}

	

	










	public static function wpPostsList(array $args = array(), $key = 'ID', $value = 'post_title')
	{
		$args['suppress_filters'] = false;
		if ($value) {
			$args['cache_results'] = false;
			add_filter('posts_fields', $pf_filter = function($fields) use ($key, $value) {
				return "{$GLOBALS['wpdb']->posts}.{$key}, {$GLOBALS['wpdb']->posts}.{$value}";
			});
		}
		$posts = array();
		foreach (get_posts($args) as $post) {
			$posts[$post->{$key}] = $value ? $post->{$value} : $post;
		}
		if (isset($pf_filter)) {
			remove_filter('posts_fields', $pf_filter);
		}
		return $posts;
	}

	

	











	public static function wpTermsList($taxonomies, array $args = array(), $key = 'term_id', $value = 'name')
	{
		$_terms = array();
		if (is_array($terms = get_terms($taxonomies, $args))) {
			foreach ($terms as $term) {
				$_terms[$term->{$key}] = $value ? $term->{$value} : $term;
			}
		}
		return $_terms;
	}

	

	











	public static function wpPostTermsList($post, $taxonomy, $key = 'term_id', $value = 'name')
	{
		$_terms = array();
		if (is_array($terms = get_the_terms($post, $taxonomy))) {
			foreach ($terms as $term) {
				$_terms[$term->{$key}] = $value ? $term->{$value} : $term;
			}
		}
		return $_terms;
	}

	

	










	public static function wpUsersList(array $args = array(), $key = 'ID', $value = 'display_name')
	{
		$args['fields'] = array($key, $value);
		$users = array();
		foreach (get_users($args) as $user) {
			$users[$user->{$key}] = $value ? $user->{$value} : $user;
		}
		return $users;
	}

	

	







	public static function wpGetCurrentTermID($taxonomy)
	{
		if (is_archive()) {
			$queried_object = get_queried_object();
			if (isset($queried_object->taxonomy) && $queried_object->taxonomy == $taxonomy) {
				return $queried_object->term_id;
			}
		} else if (is_singular()) {
			$terms = get_the_terms(false, $taxonomy);
			if (is_array($terms) && isset($terms[0])) {
				return $terms[0]->term_id;
			}
		}
		return 0;
	}

	

	







	public static function wpGetImageSizeName($html)
	{

		$image_sizes = $GLOBALS['_wp_additional_image_sizes'] + array(
			'thumbnail' => false,
			'medium'    => false,
			'large'     => false
		);

		
		if (preg_match('/\b(size|attachment)-(?P<size>[-_a-z0-9]+)\b/i', $html, $matches) && isset($image_sizes[$matches['size']])) {
			return $matches['size'];
		}

		
		if (preg_match('/.-(?P<width>[0-9]+)x(?P<height>[0-9]+)\.(jpe?g|png|gif)\b/i', $html, $matches)) {

			$image_sizes['thumbnail'] = array(
				'width'  => get_option('thumbnail_size_w'),
				'height' => get_option('thumbnail_size_h'),
				'crop'   => (bool)get_option('thumbnail_crop')
			);
			$image_sizes['medium'] = array(
				'width'  => get_option('medium_size_w'),
				'height' => get_option('medium_size_h'),
				'crop'   => false
			);
			$image_sizes['large'] = array(
				'width'  => get_option('large_size_w'),
				'height' => get_option('large_size_h'),
				'crop'   => false
			);
			if (version_compare($this->wp_version, '4.4') >= 0) { 
				$image_sizes['medium_large'] = array(
					'width'  => get_option('medium_large_size_w'),
					'height' => get_option('medium_large_size_h'),
					'crop'   => false
				);
			}

			foreach ($image_sizes as $_size => $size) {
				if (
					($size['crop'] && $size['width'] == $matches['width'] && $size['height'] == $matches['height']) ||
					(!$size['crop'] && (($size['width'] == $matches['width'] && $size['height'] >= $matches['height']) || ($size['width'] >= $matches['width'] && $size['height'] == $matches['height'])))
				) {
					return $_size;
				}
			}

		}

		return false;

	}

	

	







	public static function wpGetAttachmentID($src) {
		$id = $GLOBALS['wpdb']->get_var($GLOBALS['wpdb']->prepare("SELECT id FROM {$GLOBALS['wpdb']->posts} WHERE guid = %s", $src));
		return $id !== null ? (int)$id : false;
	}

	

	








	public static function wpRelativeImageSrc($src)
	{
		_deprecated_function(__METHOD__, '5.6.3');
		if (is_multisite()) {
			if ($GLOBALS['current_blog']->blog_id >= 2) { 
				$src_parts = explode('/files/', $src);
				if (isset($src_parts[1])) {
					return "wp-content/blogs.dir/{$GLOBALS['current_blog']->blog_id}/files/{$src_parts[1]}";
				}
			}
		}
		$src_parts = explode('/wp-content/', $src);
		if (isset($src_parts[1])) {
			return "wp-content/{$src_parts[1]}";
		}
		return $src;
	}

	

	









	public static function wpContitionTagSwitch(array $haystack, $fallback = null)
	{
		_deprecated_function(__METHOD__, '5.6.3');
		$_haystack = array();
		foreach ($haystack as $key => $value) {
			$_haystack['is_'.str_replace(',', ',is_', $key)] = $value;
		}
		return self::functionSwitch($_haystack, true, true, $fallback);
	}

	

	








	public static function wpProcessContent($content)
	{
		$content = \apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}

	

	








	public static function wpPaginateLinks(array $args = array(), $query = null)
	{

		
		if ($query === null) {
			$query = $GLOBALS['wp_query'];
		}
		$_args['total'] = $query->max_num_pages;

		
		if ($query === $GLOBALS['wp_query'] || is_front_page()) {

			$_args['base']    = str_replace('99999999', '%#%', get_pagenum_link(99999999));
			$_args['current'] = max(get_query_var('page'), get_query_var('paged'), 1);

		} else {

			if (get_option('permalink_structure')) {
				$_args['base'] = trailingslashit(get_permalink()).user_trailingslashit('%#%', 'single_paged');
			} else {
				$_args['base'] = esc_url_raw(add_query_arg('page', '%#%', get_permalink()));
			}
			$_args['current'] = max(get_query_var('page'), 1);

		}

		
		$paginate_links = paginate_links(array_merge($_args, $args));

		
		if (!get_option('permalink_structure')) {
			$callback = function($s) {
				return preg_replace('/(?!&)#038;/', '&\0', $s);
			};
			$paginate_links = is_array($paginate_links) ? array_map($callback, $paginate_links) : $callback($paginate_links);
		}

		return $paginate_links;

	}

	

	








	public static function wpShortcodeContent($content, $do_shortcode = true)
	{
		if (func_num_args() == 3) {
			$do_shortcode = (bool)func_get_arg(2);
		} else if (is_string($do_shortcode)) {
			$do_shortcode = true;
		}
		$content = shortcode_unautop($content);
		if ($do_shortcode) {
	    	$content = do_shortcode($content);
		}
	    $content = preg_replace('#^</p>|^<br ?/?>|<p>$#i', '', $content);
	    return $content;
	    
















	}

	

	









	public static function wpUpdatePostMeta($post_id, array $data, $return_on_false = false)
	{
		$result = true;
		foreach ($data as $key => $value) {
			$result = $result && update_post_meta($post_id, '_'.$key, $value);
			if ($return_on_false && !$result) {
				return false;
			}
		}
		return $result;
	}

	

	







	public static function wpAssignedMenu($theme_location)
	{
		$locations = get_nav_menu_locations();
		return isset($locations[$theme_location]) && $locations[$theme_location] > 0 ? $locations[$theme_location] : false;
	}

}