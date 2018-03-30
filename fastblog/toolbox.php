<?php
/**
 * ToolBox
 *
 * Changelog:
 * 2.3.2:
 *   - increased minimal required WordPress version to 3.4
 *   - dropped tb_version_compare() function
 *   - minor fixes
 * 2.3.1:
 *   - theme options styles fixes for WP 3.8
 *   - theme update request include PHP version
 *   - dropped PHP4 support
 * 2.3:
 *   - added Twitter API 1.1 support
 *   - improved Flickr support
 *   - added tb_array_serialize() function
 *   - added tb_widgets_checkbox() function
 *   - used wp_remote_get() instead of file_get_content()
 * 2.2:
 *   - added OGP feature
 *   - added tb_cut_string() function
 * 2.1.8:
 *   - fixes for WP 3.4,
 *   - fixed Twitter widget,
 * 2.1.7:
 *   - theme options styles fixes for WP 3.3,
 * 2.1.6:
 *   - added TP_WP32 constant,
 *   - theme options styles fixes for WP 3.2,
 *   - new code style,
 *   - tb_version_compare() function is deprecated,
 *   - added TB_UPDATE_CHECK_INTERVAL constant,
 *   - decreased update check interval (5-7 days -> 3-5 days),
 *
 * @package    WordPress
 * @subpackage Tool_Box
 * @author     Bartlomiej Baron
 * @version    2.3.2
 */

// -----------------------------------------------------------------------------

define('TB_UPDATE_CHECK_INTERVAL', mt_rand(3, 5)*86400);
define('TB_TWITTER_API_URL', 'https://api.twitter.com/1.1/%s.%s');
define('TB_FLICKR_API_URL', 'http://api.flickr.com/services/rest/?%s');

// -----------------------------------------------------------------------------

/**
 * Boolean to string
 *
 * @param boolean $bool
 * @param boolean $uppercase
 * @return string
 */
if (!function_exists('tb_bool_to_string'))
{
	function tb_bool_to_string($bool, $uppercase = false)
	{
		$result = $bool ? 'true' : 'false';
		if ($uppercase) {
			$result = strtoupper($result);
		}
		return $result;
	}
}

// -----------------------------------------------------------------------------

/**
 * Trim only string varaible
 *
 * @param mixed $var
 * @return mixed
 */
if (!function_exists('tb_trim_string'))
{
	function tb_trim_string($var)
	{
		return is_string($var) ? trim($var) : $var;
	}
}

// -----------------------------------------------------------------------------

/**
 * Cut string to declared length
 *
 * @param string $s
 * @param int $maxlen
 * @param string $end
 * @param int $endlen
 * @return string
 */
if (!function_exists('tb_cut_string'))
{
	function tb_cut_string($s, $maxlen, $end = '...', $endlen = null)
	{
		if (is_null($endlen)) {
			$endlen = strlen($end);
		}
		return strlen($s) > $maxlen ? rtrim(mb_substr($s, 0, $maxlen-$endlen)).$end : $s;
	}
}

// -----------------------------------------------------------------------------

/**
 * Multibyte sub string replace
 *
 * @param string $str
 * @param string $replacement
 * @param int $start
 * @param int $length
 * @return string
 */
if (!function_exists('tb_mb_substr_replace'))
{
	function tb_mb_substr_replace($str, $replacement, $start, $length)
	{
		return mb_substr($str, 0, $start).$replacement.mb_substr($str, $start+$length);
	}
	}

// -----------------------------------------------------------------------------

/**
 * Implode pieces with container
 *
 * @param string $glue
 * @param string $container
 * @param array $pieces
 * @return array
 */
if (!function_exists('tb_implode_ex'))
{
	function tb_implode_ex($glue, $container, $pieces)
	{
		foreach ($pieces as $key => $value) {
			$pieces[$key] = $container.$value.$container;
		}
		return implode($glue, $pieces);
	}
}

// -----------------------------------------------------------------------------

/**
 * Extended array_map() function
 *
 * @param function $callback
 * @param array $haystack
 * @return array
 */
if (!function_exists('tb_array_map'))
{
	function tb_array_map($callback, $haystack)
	{
		foreach ($haystack as $key => $value) {
			$haystack[$key] = is_array($value) ? tb_array_map($callback, $value) : call_user_func($callback, $value);
		}
		return $haystack;
	}
}

// -----------------------------------------------------------------------------

/**
 * Non empty array elements
 *
 * @param array $haystack
 * @return array
 */
if (!function_exists('tb_array_content'))
{
	function tb_array_content($haystack)
	{
		foreach ($haystack as $key => $value) {
			if ($value == '') {
				unset($haystack[$key]);
			}
		}
		return $haystack;
	}
}

// -----------------------------------------------------------------------------

/**
 * Array serialization to specified format
 *
 * @param array
 * @param string
 * @return string
 */
if (!function_exists('tb_array_serialize'))
{
	function tb_array_serialize($haystack, $format = 'url')
	{
		if (empty($haystack)) {
			return '';
		}
		switch ($format) {
			case 'url':
				$func = create_function('&$val, $key', '$val = $key."=".urlencode($val);');
				$glue = '&';
				break;
			case 'html':
				$func = create_function('&$val, $key', '$val = $key."=\"".htmlspecialchars($val)."\"";');
				$glue = ' ';
				break;
			default:
				$func = create_function('&$val, $key', '$val = $key."=".$val;');
				$glue = "\n";
		}
		array_walk($haystack, $func);
		return implode($glue, $haystack);
	}
}

// -----------------------------------------------------------------------------

/**
 * Ranged value
 *
 * @param integer $val
 * @param integer $min
 * @param integer $max
 * @return integer
 */
if (!function_exists('tb_range'))
{
	function tb_range($val, $min = false, $max = false)
	{
		$val = intval($val);
		if ($min !== false) $val = max($val, $min);
		if ($max !== false) $val = min($val, $max);
		return $val;
	}
}

// -----------------------------------------------------------------------------

/**
 * Convert new lines to HTML
 *
 * @param string $text
 * @return string
 */
if (!function_exists('tb_newlines_html'))
{
	function tb_newlines_html($text)
	{
		return str_replace(array("\r", "\n"), array('', '<br />'), $text);
	}
}

// -----------------------------------------------------------------------------

/**
 * Code name
 *
 * @param string $name
 * @return string
 */
if (!function_exists('tb_code_name'))
{
	function tb_code_name($name)
	{
		return preg_replace('/[^_a-z0-9]/i', '', strtolower($name));
	}
}

// -----------------------------------------------------------------------------

/**
 * Read element from multidimensional array
 *
 * @param array $haystack
 * @param array|string $name
 * @param string $separator
 * @return mixed
 */
if (!function_exists('tb_array_option'))
{
	function tb_array_option($haystack, $name, $separator = '/')
	{
		if (!is_array($name)) {
			$name = explode($separator, $name);
		}
		foreach ($name as $subname) {
			if (isset($haystack[$subname])) {
				$haystack = $haystack[$subname];
			} else {
				return '';
			}
		}
		return $haystack;
	}
}

// -----------------------------------------------------------------------------

/**
 * Get directory files/folders list
 *
 * @param string $path
 * @param string $ext
 * @param boolean $cut_ext
 * @return array
 */
if (!function_exists('tb_get_directory'))
{
	function tb_get_directory($path, $ext = '', $cut_ext = false)
	{
		$ext = strtolower($ext);
		$ext_len = strlen($ext);
		$files = array();
		foreach (scandir($path) as $filename) {
			if (in_array($filename, array('.', '..'))) continue;
			if ($ext && (strtolower(substr($filename, -($ext_len+1))) != '.'.$ext)) continue;
			if ($cut_ext && (preg_match('/^(.+)\.[^\.]+$/i', $filename, $matches))) {
				$filename = $matches[1];
			}
			$files[] = $filename;
		}
		return $files;
	}
}

// -----------------------------------------------------------------------------

/**
 * Set default configuration values
 *
 * @param array $haystack
 * @param array $source_haystack
 * @param mixed $default
 * @return array
 */
if (!function_exists('tb_set_default'))
{
	function tb_set_default($haystack, $source_haystack, $default = 0)
	{
		foreach ($source_haystack as $name => $value) {
			if (is_array($value)) {
				$haystack[$name] = tb_set_default(isset($haystack[$name]) ? $haystack[$name] : array(), $source_haystack[$name], $default);
			} else if (!isset($haystack[$name])) {
				$haystack[$name] = $default;
			}
		}
		return $haystack;
	}
}

// -----------------------------------------------------------------------------

/**
 * Set defaults configuration values
 *
 * @param array $haystack
 * @param array $default_haystack
 * @return array
 */
if (!function_exists('tb_set_defaults'))
{
	function tb_set_defaults($haystack, $default_haystack)
	{
		foreach ($default_haystack as $name => $value) {
			if ((!isset($haystack[$name])) || ((is_array($value) && (!is_array($haystack[$name]))))) {
				$haystack[$name] = $value;
			} else if (is_array($value) && is_array($haystack[$name])) {
				$haystack[$name] = tb_set_defaults($haystack[$name], $default_haystack[$name]);
			}
		}
		return $haystack;
	}
}

// -----------------------------------------------------------------------------

/**
 * Minify CSS code
 *
 * @param string $style
 * @return string
 */
if (!function_exists('tb_style_minify'))
{
	function tb_style_minify($style)
	{
		$patterns = array('|/\*.*?\*/|s', '/[ \r\n]{2,}/s', '/ ?([,:;{}<>]) ?/');
		$replaces = array('', '', '\1');
		$style = preg_replace($patterns, $replaces, $style);
		return preg_match('/<style[^<>]*>.{3,}<\/style>/isu', $style) ? $style : '';
	}
}

// -----------------------------------------------------------------------------

/**
 * Minify JavaScript code
 *
 * @param string $script
 * @return string
 */
if (!function_exists('tb_script_minify'))
{
	function tb_script_minify($script)
	{
		$patterns = array('|^//.*$|m', '|/\*.*?\*/|s', '/[ \r\n]{2,}/s', '/ ?([,:;={}<>]) ?/');
		$replaces = array('', '', '', '\1');
		return preg_replace($patterns, $replaces, $script);
	}
}

// -----------------------------------------------------------------------------

/**
 * WordPress cookie name
 *
 * @param string $key
 * @return string
 */
if (!function_exists('tb_get_cookie_name'))
{
	function tb_get_cookie_name($key)
	{
		return 'wordpress_'.tb_code_name($key);
	}
}

// -----------------------------------------------------------------------------

/**
 * Parse shortcode content
 *
 * @param string $content
 * @return string
 */
if (!function_exists('tb_shortcode_content'))
{
	function tb_shortcode_content($content)
	{
		$content = preg_replace('/^(<br \/>|<\/p>)*(.*?)(<br \/>|<p>)*$/is', '\2', $content);
		if (version_compare(PHP_VERSION, '5.1.0') >= 0) {
			do {
				$content = preg_replace('/<p>(<(div|pre|blockquote|table) ?.*?>.*?<\/\2>)<\/p>/is', '\1', $content, -1, $count);
			} while ($count > 0);
		}
		return trim($content);
	}
}

// -----------------------------------------------------------------------------

/**
 * Get object size
 *
 * @param string $object_code
 * @return array|boolean
 */
if (!function_exists('tb_object_get_size'))
{
	function tb_object_get_size($object_code)
	{
		if (!preg_match_all('/(width|height)=["\']([0-9]+)["\']/i', $object_code, $matches) >= 2) {
			return false;
		}
		for ($i = 0; $i < 2; $i++) {
			$object[$matches[1][$i]] = intval($matches[2][$i]);
		}
		if (count($object) < 2) {
			return false;
		}
		$object['ratio'] = $object['height'] > 0 ? $object['width'] / $object['height'] : false;
		return $object;
	}
}

// -----------------------------------------------------------------------------

/**
 * Resize object
 *
 * @param string $object_code
 * @param integer|boolean $width
 * @param integer|boolean $height
 * @param boolean $keep_ratio
 * @param boolean $return_array
 * @return string|array
 */
if (!function_exists('tb_object_resize'))
{
	function tb_object_resize($object_code, $width, $height, $keep_ratio = false, $return_array = false)
	{
		if (($width === false) || ($height === false)) {
			if ((($object = tb_object_get_size($object_code)) === false) || ($object['ratio'] === false)) {
				$object['ratio'] = 1;
			}
			if ($width  === false) $width  = round($height * $object['ratio']);
			if ($height === false) $height = round($width / $object['ratio']);
		} else if ($keep_ratio && (($object = tb_object_get_size($object_code)) !== false)) {
			if ($object['ratio'] >= $width / $height) {
				$height = round($width / $object['ratio']);
			} else {
				$width = round($height * $object['ratio']);
			}
		}
		$regex = array(
			'/(width=["\'])[0-9]+(["\'])/i' => "\${1}{$width}\${2}",
			'/(height=["\'])[0-9]+(["\'])/i' => "\${1}{$height}\${2}"
		);
		$object_code = preg_replace(array_keys($regex), array_values($regex), $object_code);
		if ($return_array) {
			return array(
				'object_code' => $object_code,
				'width' => $width,
				'height' => $height
			);
		} else {
			return $object_code;
		}
	}
}

// -----------------------------------------------------------------------------

/**
 * Get Cufon font name
 *
 * @param string $filename
 * @return string|boolean
 */
if (!function_exists('tb_cufon_font_get_name'))
{
	function tb_cufon_font_get_name($filename)
	{
		if (($handle = @fopen($filename, 'r')) === false) {
			return false;
		}
		@flock($handle, LOCK_SH);
		if (($data = @fread($handle, 10*1024)) === false) {
			return false;
		}
		@flock($handle, LOCK_UN);
		@fclose($handle);
		return preg_match('/"font-family" *: *"(.+?)"/i', $data, $matches) ? $matches[1] : false;
	}
}

// -----------------------------------------------------------------------------

/**
 * Make request to twitter.com
 *
 * @link https://dev.twitter.com/docs/api/1.1
 *
 * @param array $oauth
 * @param string $resource
 * @param array $params
 * @return object|array|bool
 */
if (!function_exists('tb_twitter_request'))
{
	function tb_twitter_request($oauth, $resource, $params = array())
	{
		if (!isset($oauth['consumer_key']) || !isset($oauth['consumer_secret']) || !isset($oauth['access_token']) || !isset($oauth['access_token_secret'])) {
			return false;
		}
		require_once get_template_directory().'/oauth.php';
		$consumer = new __OAuthConsumer($oauth['consumer_key'], $oauth['consumer_secret']);
		$token    = new __OAuthConsumer($oauth['access_token'], $oauth['access_token_secret']);
		$request = __OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', sprintf(TB_TWITTER_API_URL, $resource, 'json'), $params);
		$request->sign_request(new __OAuthSignatureMethod_HMAC_SHA1(), $consumer, $token);
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
}

// -----------------------------------------------------------------------------

/**
 * Get tweets from twitter.com
 *
 * @param array $oauth
 * @param string $username
 * @param bool $include_retweets
 * @param bool $exclude_replies
 * @param int $count
 * @return array|bool
 */
if (!function_exists('tb_twitter_get_tweets'))
{
	function tb_twitter_get_tweets($oauth, $username, $include_retweets = true, $exclude_replies = false, $count = 20)
	{
		$params = array(
			'screen_name'      => $username,
			'include_rts'      => $include_retweets,
			'exclude_replies'  => $exclude_replies,
			'count'            => $include_retweets && !$exclude_replies ? min($count, 50) : 50,
			'trim_user'        => false
		);
		if (($response = tb_twitter_request($oauth, 'statuses/user_timeline', $params)) === false) {
			return false;
		}
		$tweets = array();
		foreach ($response as $data) {
			$entities = array();
			foreach ($data->entities->hashtags as $hashtag) {
				$entities[$hashtag->indices[0]] = array(
					'type'   => 'hashtag',
					'length' => $hashtag->indices[1]-$hashtag->indices[0],
					'text'   => $hashtag->text
				);
			}
			foreach ($data->entities->user_mentions as $user_mention) {
				$entities[$user_mention->indices[0]] = array(
					'type'        => 'user_mention',
					'length'      => $user_mention->indices[1]-$user_mention->indices[0],
					'screen_name' => $user_mention->screen_name
				);
			}
			foreach ($data->entities->urls as $url) {
				$entities[$url->indices[0]] = array(
					'type'         => 'url',
					'length'       => $url->indices[1]-$url->indices[0],
					'url'          => $url->url,
					'expanded_url' => $url->expanded_url,
					'display_url'  => $url->display_url
				);
			}
			krsort($entities);
			$html = $text = (string)$data->text;
			foreach ($entities as $pos => $entity) {
				$len = $entity['length'];
				switch ($entity['type']) {
					case 'hashtag':
						$html = tb_mb_substr_replace(
							$html,
							sprintf('<a href="http://twitter.com/#!/search?q=%%23%s" title="#%s">#%s</a>', $entity['text'], $entity['text'], $entity['text']),
							$pos, $len
						);
						break;
					case 'user_mention':
						$html = tb_mb_substr_replace(
							$html,
							sprintf('<a href="http://twitter.com/#!/%s">@%s</a>', $entity['screen_name'], $entity['screen_name']),
							$pos, $len
						);
						break;
					case 'url':
						$html = tb_mb_substr_replace(
							$html,
							sprintf('<a href="%s" title="%s">%s</a>', $entity['url'], $entity['expanded_url'], $entity['display_url']),
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
}

// -----------------------------------------------------------------------------

/**
 * Make request to flickr.com
 *
 * @param string $api_key
 * @param string $method
 * @param string $params
 * @return array|boolean
 */
if (!function_exists('tb_flickr_request'))
{
	function tb_flickr_request($api_key, $method, $params = '')
	{
		$params += array(
			'api_key' => $api_key,
			'method'  => $method,
			'format'  => 'php_serial'
		);
		$response = wp_remote_get(sprintf(TB_FLICKR_API_URL, tb_array_serialize($params, 'url')));
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
}

// -----------------------------------------------------------------------------

/**
 * Get user data from flickr.com
 *
 * @param string $api_key
 * @param string $username
 * @return array|string|boolean
 */
if (!function_exists('tb_flickr_get_userdata'))
{
	function tb_flickr_get_userdata($api_key, $username)
	{
		if (($response[0] = tb_flickr_request($api_key, 'flickr.people.findByUsername', array('username' => $username))) === false) {
			return false;
		}
		if (($response[1] = tb_flickr_request($api_key, 'flickr.urls.getUserPhotos', array('user_id' => $response[0]['user']['nsid']))) === false) {
			return false;
		}
		$userdata = array(
			'id'       => $response[0]['user']['nsid'],
			'username' => $response[0]['user']['username']['_content'],
			'url'      => $response[1]['user']['url']
		);
		return $userdata;
	}
}

// -----------------------------------------------------------------------------

/**
 * Get photos from flickr.com
 *
 * @link http://www.flickr.com/services/api/misc.urls.html
 *
 * @param string $user_id
 * @param integer $count
 * @return array|boolean
 */
if (!function_exists('tb_flickr_get_photos'))
{
	function tb_flickr_get_photos($api_key, $user_id, $count)
	{
		$params = array(
			'user_id'  => $user_id,
			'per_page' => $count
		);
		if (($response = tb_flickr_request($api_key, 'flickr.people.getPublicPhotos', $params)) === false) {
			return false;
		}
		$photos = array();
		foreach ($response['photos']['photo'] as $data) {
			$photos[] = array(
				'title' => $data['title'],
				'src'   => sprintf('http://farm%s.staticflickr.com/%s/%s_%s_%%s.jpg', $data['farm'], $data['server'], $data['id'], $data['secret']),
				'url'   => sprintf('http://www.flickr.com/photos/%s/%s', $data['owner'], $data['id'])
			);
		}
		return $photos;
	}
}

// -----------------------------------------------------------------------------

/**
 * Get theme data
 *
 * @return string
 */
if (!function_exists('tb_get_theme_data'))
{
	function tb_get_theme_data($name = '')
	{
		$theme = wp_get_theme();
		foreach (array(
			'name', 'title', 'version', 'parent_theme', 'template_dir', 'stylesheet_dir', 'template', 'stylesheet',
			'screenshot', 'description', 'author', 'tags', 'theme_root', 'theme_root_uri'
		) as $prop) {
			$theme_data[$prop] = $theme->{$prop};
		}
		$name = strtolower($name);
		return $name && isset($theme_data[$name]) ? $theme_data[$name] : $theme_data;
	}
}

// -----------------------------------------------------------------------------

/**
 * Get theme name
 *
 * @return string
 */
if (!function_exists('tb_get_theme_name'))
{
	function tb_get_theme_name()
	{
		return tb_get_theme_data('name');
	}
}

// -----------------------------------------------------------------------------

/**
 * Get theme version
 *
 * @return string
 */
if (!function_exists('tb_get_theme_version'))
{
	function tb_get_theme_version()
	{
		return tb_get_theme_data('version');
	}
}

// -----------------------------------------------------------------------------

/**
 * Get theme cookie name
 *
 * @param string $key
 * @return string
 */
if (!function_exists('tb_get_theme_cookie_name'))
{
	function tb_get_theme_cookie_name($key)
	{
		return tb_get_cookie_name(tb_get_theme_name().'_'.$key);
	}
}

// -----------------------------------------------------------------------------

/**
 * Get theme options
 *
 * @param string $name
 * @param array $default_options
 * @param function $compatibility_callback
 * @return array
 */
if (!function_exists('tb_get_theme_options'))
{
	function tb_get_theme_options($name, $default_options, $compatibility_callback = '')
	{
		if (!is_array($options = get_option($name))) {
			$options = $default_options;
		} else if ($compatibility_callback) {
			$options = call_user_func($compatibility_callback, $options);
		}
		return tb_set_defaults($options, $default_options);
	}
}

// -----------------------------------------------------------------------------

/**
 * Add theme feature
 *
 * @param string $name
 * @param mixed $param
 */
if (!function_exists('tb_add_theme_feature'))
{
	function tb_add_theme_feature($name, $param = null)
	{
		switch ($name) {
			case 'query_vars':
				if (!is_array($param)) {
					$param = array($param);
				}
				$param = tb_implode_ex(', ', "'", $param);
				add_action('query_vars', create_function('$qvars', "return array_merge(\$qvars, array({$param}));"));
				break;
			case 'admin_styles_and_scripts':
				if (is_string($param)) {
					add_action('admin_head-'.$param, 'tb_admin_styles_and_scripts');
				}
				break;
			case 'nav_menu_current_item':
				if (!is_admin()) {
					add_filter('wp_nav_menu_items',  'tb_nav_menu_current_item');
					add_filter('wp_list_pages',      'tb_nav_menu_current_item');
					add_filter('wp_list_categories', 'tb_nav_menu_current_item');
				}
				break;
			case 'img_caption_shortcode_fixed_width':
				if (!is_admin()) {
					add_filter('img_caption_shortcode', 'tb_img_caption_shortcode_fixed_width', 10, 3);
				}
				break;
			case 'ogp':
				if (!is_admin()) {
					add_action('wp_head', 'tb_ogp');
				}
		}
	}
}

// -----------------------------------------------------------------------------

/**
 * Admin page styles and scripts
 */
if (!function_exists('tb_admin_styles_and_scripts'))
{
	function tb_admin_styles_and_scripts()
	{
		ob_start();
		?>
		<style type="text/css">
			/* =Widefat table */
			table.widefat          { margin-top: 1em; }
			table.widefat thead th { padding: 7px 9px; }
			table.widefat tbody th { width: 200px; }
			table.widefat th       { padding: 10px; }
			table.widefat td       { padding: 8px 10px; }
			/* =Tab table */
			table.tab > thead th { cursor: pointer; }
			table.tab > tbody    { display: none; }
			/* =Clear table */
			table.clear         { border-collapse: collapse; }
			table.clear td      { border: 0; padding: 0 4px 1px 0; vertical-align: middle; }
			table.clear td.bold { font-weight: bold; }
			/* =Labels */
			label + label, span + label { margin-left: 15px; }
			/* =Inputs */
			input.regular-text { width: 25em; }
			input.large-text   { width: 99%; }
			input.short-text   { width: 50px; }
			input.medium-text  { width: 100px; }
			/* =Classes */
			.submit-fixed { position: fixed; right: 18px; top: 50px; }
			.indent-1     { margin-left: 20px; }
			.indent-2     { margin-left: 40px; }
			.indent-3     { margin-left: 60px; }
		</style>
		<?php
		echo tb_style_minify(ob_get_clean())."\n";
		$visible_tabs_cookie_name = tb_get_theme_cookie_name('admin_visible_tabs');
		?>
		<script type="text/javascript">
			// Cookies
			function tbCreateCookie(name, value, time) {
				var date = new Date();
				date.setTime(date.getTime()+time*1000);
				document.cookie = name+'='+value+'; expires='+date.toGMTString()+'; path=<?php echo COOKIEPATH; ?>';
			}
			function tbReadCookie(name) {
				var name = name+'=';
				var cookies = document.cookie.split(';');
				for (var i in cookies) {
					var c = cookies[i];
					while (c.charAt(0) == ' ') c = c.substring(1, c.length);
					if (c.indexOf(name) == 0) {
						return c.substring(name.length, c.length);
					}
				}
				return null;
			}
			function tbEraseCookie(name) {
				tbCreateCookie(name, '', -1);
			}
			// Tabs
			jQuery(document).ready(function() {
				var tabs = jQuery('table.tab');
				function saveTabs() {
					var visible_tabs = [];
					for (var i = 0; i < tabs.length; i++) {
						if (tabs.eq(i).find('> tbody').is(':visible')) visible_tabs.push(i);
					}
					tbCreateCookie('<?php echo $visible_tabs_cookie_name; ?>', visible_tabs.join(','), 365*24*60*60);
				}
				function loadTabs() {
					var visible_tabs = tbReadCookie('<?php echo $visible_tabs_cookie_name; ?>');
					if (visible_tabs) {
						visible_tabs = visible_tabs.split(',');
						for (var i in visible_tabs) tabs.eq(visible_tabs[i]).find('> tbody').show();
					}
				}
				jQuery('table.tab > thead th').click(function() {
					jQuery(this).parentsUntil('table').last().next('tbody').toggle();
					saveTabs();
				});
				jQuery('.button-secondary.button-tab').click(function() {
					var tbody = jQuery('> tbody', tabs);
					if (jQuery(this).index() == 0) tbody.show(); else tbody.hide();
					saveTabs();
				});
				loadTabs();
			});
		</script>
		<?php
	}
}

// -----------------------------------------------------------------------------

/**
 * Navigation menu items filter
 *
 * @param string $items
 * @return string
 */
if (!function_exists('tb_nav_menu_current_item'))
{
	function tb_nav_menu_current_item($items)
	{
		return preg_replace('/([ "\'])(current(-menu-item|-cat|_page_item))([ "\'])/i', '\1current \2\4', $items, 1);
	}
}

// -----------------------------------------------------------------------------

/**
 * Image caption shortcode filter
 *
 * @param string $tmp
 * @param array $atts
 * @param string $content
 * @return string
 */
if (!function_exists('tb_img_caption_shortcode_fixed_width'))
{
	function tb_img_caption_shortcode_fixed_width($tmp, $atts, $content = null)
	{
		extract(shortcode_atts(array(
			'id'  => '',
			'align' => 'alignnone',
			'width' => '',
			'caption' => ''
		), $atts));
		if (((integer)$width < 1) || empty($caption)) {
			return $content;
		}
		if ($id) {
			$id = ' id="'.esc_attr($id).'"';
		}
		return
			'<div'.$id.' class="wp-caption caption '.esc_attr($align).'" style="width: '.((integer)$width).'px">'.
				do_shortcode($content).
				'<div class="wp-caption-text caption-text">'.$caption.'</div>'.
			'</div>';
	}
}

// -----------------------------------------------------------------------------

/**
 * Open Graph Protocol
 */
if (!function_exists('tb_ogp'))
{
	function tb_ogp()
	{
		$ogp['site_name'] = get_bloginfo('name');
		$title = trim(wp_title('', false)) or $title = $ogp['site_name'];
		$ogp['title'] = $title;
		$ogp['locale'] = str_replace('-', '_', get_bloginfo('language'));
		if (is_singular() && !is_front_page()) {
			global $post;
			$_post = get_post($post->ID);
			$ogp['url'] = get_permalink($_post->ID);
			$description = $_post->post_excerpt ? $_post->post_excerpt : preg_replace('/\[\/?.+?\]/', '', $_post->post_content);
			$description = preg_replace('/<(style|script).*>.*<\/\1>/isU', '', $description);
			$description = trim(strip_tags(preg_replace('/\s+/', ' ', $description)));
			$description = tb_cut_string($description, 250, ' [...]');
			$ogp['description'] = $description;
			if (has_post_thumbnail($_post->ID)) {
				if (($img = wp_get_attachment_image_src(get_post_thumbnail_id($_post->ID))) !== false) {
					$ogp['image'] = $img[0];
				}
			}
		} else {
			$ogp['url'] = home_url();
			$ogp['description'] = get_bloginfo('description');
		}
		foreach ($ogp as $property => $content) {
			if ($content) {
				printf("<meta property=\"og:%s\" content=\"%s\" />\n", $property, esc_attr($content));
			}
		}
	}
}

// -----------------------------------------------------------------------------

/**
 * Update post meta
 *
 * @param intger $post_id
 * @param array $data
 * @param string $prefix
 * @return boolean
 */
if (!function_exists('tb_update_post_meta'))
{
	function tb_update_post_meta($post_id, $data, $prefix = '', $surfix = '')
	{
		foreach ($data as $name => $value) {
			$name = $prefix.$name.$surfix;
			if (!update_post_meta($post_id, $name, $value)) {
				if (!add_post_meta($post_id, $name, $value, true)) {
					//return false;
				}
			}
		}
		return true;
	}
}

// -----------------------------------------------------------------------------

/**
 * Get element ID from name
 *
 * @param string $name
 * @param string $option
 * @return string
 */
if (!function_exists('tb_options_name_to_id'))
{
	function tb_options_name_to_id($name, $option = '')
	{
		return str_replace(array('[', ']'), array('-', ''), $name).($option !== '' ? '-'.$option : '');
	}
}

// -----------------------------------------------------------------------------

/**
 * Get options description label
 *
 * @param string $label
 * @param boolean $new_line
 * @return string
 */
if (!function_exists('tb_options_get_description'))
{
	function tb_options_get_description($label, $new_line = false)
	{
		return (!empty($label)) ? ($new_line ? '<br />' : ' ').'<span class="description">'.$label.'</span>' : '';
	}
}

// -----------------------------------------------------------------------------

/**
 * Options description label
 *
 * @param string $label
 * @param boolean $new_line
 */
if (!function_exists('tb_options_description'))
{
	function tb_options_description($label, $new_line = false)
	{
		echo tb_options_get_description($label, $new_line);
	}
}

// -----------------------------------------------------------------------------

/**
 * Options section open
 *
 * @param string $caption
 */
if (!function_exists('tb_options_open_section'))
{
	function tb_options_open_section($caption)
	{
		echo
			'<table class="tab widefat">'.
				'<thead>'.
					'<tr><th colspan="2" scope="col">'.$caption.'</th></tr>'.
				'</thead>'.
			"<tbody>\n";
	}
}

// -----------------------------------------------------------------------------

/**
 * Options section close
 */
if (!function_exists('tb_options_close_section'))
{
	function tb_options_close_section()
	{
		echo "</tbody></table>\n";
	}
}

// -----------------------------------------------------------------------------

/**
 * Options field open
 *
 * @param string $caption
 * @param string $description
 */
if (!function_exists('tb_options_open_field'))
{
	function tb_options_open_field($caption, $description = '')
	{
		echo
			'<tr valign="top">'.
				'<th scope="row">'.$caption.tb_options_get_description($description, true).'</th>'.
				'<td>';
	}
}

// -----------------------------------------------------------------------------

/**
 * Options field close
 */
if (!function_exists('tb_options_close_field'))
{
	function tb_options_close_field()
	{
		echo "</td></tr>\n";
	}
}

// -----------------------------------------------------------------------------

/**
 * Options field
 *
 * @param string $caption
 * @param string $description
 * @param string $type
 */
if (!function_exists('tb_options_field'))
{
	function tb_options_field($caption, $description, $type)
	{
		if (empty($type) || (!function_exists($func_name = 'tb_options_'.$type))) {
			return;
		}
		$args = func_get_args();
		tb_options_open_field($caption, $description);
		call_user_func_array($func_name, array_slice($args, 3));
		tb_options_close_field();
	}
}

// -----------------------------------------------------------------------------

/**
 * Options hidden input
 *
 * @param string $name
 * @param string $value
 */
if (!function_exists('tb_options_hidden'))
{
	function tb_options_hidden($name, $value = '')
	{
		if (is_array($name)) {
			extract($name);
		}
		echo '<input id="'.tb_options_name_to_id($name).'" type="hidden" name="'.$name.'" value="'.$value.'" />';
	}
}

// -----------------------------------------------------------------------------

/**
 * Options text input
 *
 * @param string $name
 * @param string $value
 * @param string $description
 * @param string $class
 * @param integer $max_length
 */
if (!function_exists('tb_options_input'))
{
	function tb_options_input($name, $value = '', $description = '', $class = 'regular-text', $max_length = 0)
	{
		if (is_array($name)) {
			extract($name);
		}
		$max_length = $max_length ? ' maxlength="'.$max_length.'"' : '';
		echo '<input id="'.tb_options_name_to_id($name).'" type="text" name="'.$name.'" value="'.$value.'" class="'.$class.'"'.$max_length.' />';
		tb_options_description($description);
	}
}

// -----------------------------------------------------------------------------

/**
 * Options code text input
 *
 * @param string $name
 * @param string $value
 * @param string $description
 * @param string $class
 * @param integer $max_length
 */
if (!function_exists('tb_options_input_code'))
{
	function tb_options_input_code($name, $value = '', $description = '', $class = 'regular-text', $max_length = 0)
	{
		if (is_array($name)) {
			extract($name);
		}
		tb_options_input($name, htmlspecialchars($value), $description, trim($class.' code'), $max_length);
	}
}

// -----------------------------------------------------------------------------

/**
 * Options number text input
 *
 * @param string $name
 * @param string $value
 * @param string $description
 * @param integer $max_length
 */
if (!function_exists('tb_options_input_number'))
{
	function tb_options_input_number($name, $value = '', $description = '', $max_length = 0)
	{
		if (is_array($name)) {
			extract($name);
		}
		tb_options_input($name, intval($value), $description, 'short-text code', $max_length);
	}
}

// -----------------------------------------------------------------------------

/**
 * Options textarea input
 *
 * @param string $name
 * @param string $value
 * @param string $description
 * @param string $class
 * @param integer $cols
 * @param integer $rows
 */
if (!function_exists('tb_options_textarea'))
{
	function tb_options_textarea($name, $value = '', $description = '', $class = 'large-text', $cols = 50, $rows = 5)
	{
		if (is_array($name)) {
			extract($name);
		}
		echo '<textarea id="'.tb_options_name_to_id($name).'" name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'" class="'.$class.'" />'.$value.'</textarea>';
		tb_options_description($description, true);
	}
}

// -----------------------------------------------------------------------------

/**
 * Options code textarea input
 *
 * @param string $name
 * @param string $value
 * @param string $description
 * @param string $class
 */
if (!function_exists('tb_options_textarea_code'))
{
	function tb_options_textarea_code($name, $value = '', $description = '', $class = 'large-text')
	{
		if (is_array($name)) {
			extract($name);
		}
		tb_options_textarea($name, htmlspecialchars($value), $description, trim($class.' code'));
	}
}

// -----------------------------------------------------------------------------

/**
 * Options select input
 *
 * @param string $name
 * @param string $value
 * @param array $options
 * @param string $description
 */
if (!function_exists('tb_options_select'))
{
	function tb_options_select($name, $value = '', $options = array(), $description = '')
	{
		if (is_array($name)) {
			extract($name);
		}
		echo '<select id="'.tb_options_name_to_id($name).'" name="'.$name.'">';
		foreach ($options as $option_value => $option_label) {
			$selected = $option_value == $value ? ' selected="selected"' : '';
			echo '<option value="'.$option_value.'"'.$selected.'>'.$option_label.'</option>';
		}
		echo '</select>';
		tb_options_description($description);
	}
}

// -----------------------------------------------------------------------------

/**
 * Options checkbox input
 *
 * @param string $name
 * @param boolean $checked
 * @param string $label
 * @param string $description
 */
if (!function_exists('tb_options_checkbox'))
{
	function tb_options_checkbox($name = '', $checked = false, $label = '', $description = '')
	{
		if (is_array($name)) {
			extract($name);
		}
		$id = tb_options_name_to_id($name);
		$checked = $checked ? ' checked="checked"' : '';
		echo
			'<fieldset>'.
				'<label for="'.$id.'">'.
					'<input id="'.$id.'" type="checkbox" name="'.$name.'" value="1"'.$checked.' /> '.
					$label.tb_options_get_description($description).
				'</label>'.
			'</fieldset>';
	}
}

// -----------------------------------------------------------------------------

/**
 * Options checkbox group input
 *
 * @param string $name_prefix
 * @param array $values
 * @param array $options
 * @param boolean $options_assoc
 * @param string $type
 * @param string $horizontal_label
 */
if (!function_exists('tb_options_checkbox_group'))
{
	function tb_options_checkbox_group($name_prefix = '', $values = array(), $options = array(), $options_assoc = true, $type = 'vertical', $horizontal_label = '')
	{
		if (is_array($name_prefix)) {
			extract($name_prefix);
		}
		echo '<fieldset>';
		if (($type == 'horizontal') && $horizontal_label) {
			echo "<span>{$horizontal_label}</span> ";
		}
		foreach ($options as $option_name => $option_label) {
			if (is_array($option_label)) {
				list($option_label, $option_description) = $option_label;
			} else {
				$option_description = '';
			}
			$id = tb_options_name_to_id($name_prefix, $option_name);
			if ($options_assoc) {
				$name = $option_name;
				$value = '1';
				$checked = isset($values[$option_name]) && $values[$option_name];
			} else {
				$name = '';
				$value = $option_name;
				$checked = in_array($option_name, $values);
			}
			echo
				'<label for="'.$id.'">'.
					'<input id="'.$id.'" type="checkbox" name="'.$name_prefix.'['.$name.']" value="'.$value.'"'.($checked ? ' checked="checked"' : '').' /> '.
					$option_label.tb_options_get_description($option_description).
				'</label>';
			if ($type == 'vertical') {
				echo '<br />';
			}
		}
		echo '</fieldset>';
	}
}

// -----------------------------------------------------------------------------

/**
 * Options radio group input
 *
 * @param string $name
 * @param string $value
 * @param array $options
 * @param string $type
 * @param string $horizontal_label
 */
if (!function_exists('tb_options_radio_group'))
{
	function tb_options_radio_group($name, $value = '', $options = array(), $type = 'vertical', $horizontal_label = '')
	{
		if (is_array($name)) {
			extract($name);
		}
		echo '<fieldset>';
		if (($type == 'horizontal') && $horizontal_label) {
			echo "<span>{$horizontal_label}</span> ";
		}
		foreach ($options as $option_name => $option_label) {
			if (is_array($option_label)) {
				list($option_label, $option_description) = $option_label;
			} else {
				$option_description = '';
			}
			$id = tb_options_name_to_id($name, $option_name);
			$checked = $option_name == $value ? ' checked="checked"' : '';
			echo
				'<label for="'.$id.'">'.
					'<input id="'.$id.'" type="radio" name="'.$name.'" value="'.$option_name.'"'.$checked.' /> '.
					$option_label.tb_options_get_description($option_description).
				'</label>';
			if ($type == 'vertical') {
				echo '<br />';
			}
		}
		echo '</fieldset>';
	}
}

// -----------------------------------------------------------------------------

/**
 * Options button
 *
 * @param string $id
 * @param string $label
 * @param string $class
 */
if (!function_exists('tb_options_button'))
{
	function tb_options_button($id, $label = '', $class = 'button')
	{
		if (is_array($id)) {
			extract($id);
		}
		echo '<a id="'.$id.'" href="#null" class="'.$class.'">'.$label.'</a>';
	}
}

// -----------------------------------------------------------------------------

/**
 * Options update notification
 *
 * @param string $update_url
 * @param array $update_data
 * @param function $update_callback
 * @param string $text_domain
 * @result array|boolean
 */
if (!function_exists('tb_options_update'))
{
	function tb_options_update($update_url, $update_data, $update_callback, $text_domain)
	{
		global $wp_version;
		$theme_data = tb_get_theme_data();
		$theme_name = tb_code_name(strtolower($theme_data['name']));
		$cookie_name = "wordpress_{$theme_name}_update";
		if (!isset($update_data['expire']) || $update_data['expire'] <= time()) {
			$response = wp_remote_get(
				$update_url.'?name='.urlencode($theme_name).'&version='.urlencode($theme_data['version']),
				array('user-agent' => sprintf('WordPress/%s; PHP/%s; %s', $wp_version, PHP_VERSION, home_url()))
			);
			$body = wp_remote_retrieve_body($response);
			if (!empty($body) && $body && (($update_data = @base64_decode($body)) !== false)) {
				$update_data = unserialize($update_data);
			}
			$update_data['expire'] = time()+TB_UPDATE_CHECK_INTERVAL;
			if (function_exists($update_callback)) {
				call_user_func($update_callback, $update_data);
			}
		}
		if (!(isset($update_data['version']) && isset($update_data['download_page']))) {
			return false;
		}
		if (version_compare($update_data['version'], $theme_data['version']) > 0) {
			if (isset($_COOKIE[$cookie_name])) {
				$hide_version = $_COOKIE[$cookie_name];
			}
			if ((!isset($hide_version)) || (version_compare($update_data['version'], $hide_version) > 0)) {
				?>
				<script type="text/javascript">
					var tbUpdateData = <?php echo json_encode( $update_data ); ?>;
					jQuery(document).ready(function() {
						if (window.tbCreateCookie) {
							jQuery('#tb-update-hide, #tb-update-remind').click(function() {
								tbCreateCookie('<?php echo $cookie_name; ?>', tbUpdateData['version'], (jQuery(this).attr('id') == 'tb-update-hide' ? 90 : 5)*24*60*60);
								jQuery('#tb-update').fadeOut('normal');
							});
						} else {
							jQuery('#tb-update-hide, #tb-update-remind').parent().remove();
						}
					});
				</script>
				<div id="tb-update" class="<?php echo ( isset( $update_data['critical'] ) && $update_data['critical'] ) ? 'error' : 'updated'; ?>">
					<p><strong><?php printf( __( 'New version of %1$s is available!', $text_domain ), $theme_data['name'] ); ?></strong></p>
					<p><?php _e( 'Current version', $text_domain ); ?>: <strong><?php echo $theme_data['version']; ?></strong></p>
					<p><?php _e( 'Available version', $text_domain ); ?>: <strong><?php echo $update_data['version']; ?></strong></p>
					<?php if ( isset( $update_data['message'] ) && (!empty( $update_data['message'] ) ) ): ?>
						<p><strong><?php _e( 'Important', $text_domain ); ?>:</strong> <span><?php echo $update_data['message']; ?></span></p>
					<?php endif; ?>
					<p>
						<strong><a href="<?php echo $update_data['download_page']; ?>"><?php _e( 'Go to download page', $text_domain ); ?></a></strong>
						<span> | <a id="tb-update-remind" href="#null"><?php _e( 'Remind me in 5 days', $text_domain ); ?></a></span>
						<span> | <a id="tb-update-hide" href="#null"><?php _e( 'Hide this message', $text_domain ); ?></a></span>
					</p>
				</div>
				<?php
			}
		}
		return $update_data;
	}
}

// -----------------------------------------------------------------------------

/**
 * Get widgets description label
 *
 * @param string $label
 * @param boolean $new_line
 * @return string
 */
if (!function_exists('tb_widgets_get_description'))
{
	function tb_widgets_get_description($label, $new_line = false)
	{
		return (!empty($label)) ? ($new_line ? '<br />' : ' ').'<small>'.$label.'</small>' : '';
	}
}

// -----------------------------------------------------------------------------

/**
 * Widgets description label
 *
 * @param string $label
 * @param boolean $new_line
 */
if (!function_exists('tb_widgets_description'))
{
	function tb_widgets_description($label, $new_line = false)
	{
		echo tb_widgets_get_description($label, $new_line);
	}
}

// -----------------------------------------------------------------------------

/**
 * Widgets text input
 *
 * @param object $widget
 * @param string $name
 * @param string $value
 * @param string $label
 * @param string $description
 * @param string $class
 * @param integer $max_length
 */
if (!function_exists('tb_widgets_input'))
{
	function tb_widgets_input($widget, $name, $value = '', $label = '', $description = '', $class = 'widefat', $max_length = 0)
	{
		if (is_array($name)) {
			extract($name);
		}
		$max_length = $max_length ? ' maxlength="'.$max_length.'"' : '';
		if ($label) {
			echo '<label for="'.$widget->get_field_id($name).'">'.$label.':</label>';
		}
		echo '<input id="'.$widget->get_field_id($name).'" type="text" name="'.$widget->get_field_name($name).'" value="'.$value.'" class="'.$class.'"'.$max_length.' />';
		tb_widgets_description($description, true);
	}
}

// -----------------------------------------------------------------------------

/**
 * Widgets select input
 *
 * @param object $widget
 * @param string $name
 * @param string $value
 * @param array $options
 * @param string $label
 * @param string $description
 * @param string $class
 */
if (!function_exists('tb_widgets_select'))
{
	function tb_widgets_select($widget, $name, $value = '', $options = array(), $label = '', $description = '', $class = 'widefat')
	{
		if (is_array($name)) {
			extract($name);
		}
		if ($label) {
			echo '<label for="'.$widget->get_field_id($name).'">'.$label.':</label>';
		}
		echo '<select id="'.$widget->get_field_id($name).'" name="'.$widget->get_field_name($name).'" class="'.$class.'">';
		foreach ($options as $option_value => $option_label) {
			$selected = $option_value == $value ? ' selected="selected"' : '';
			echo '<option value="'.$option_value.'"'.$selected.'>'.$option_label.'</option>';
		}
		echo '</select>';
		tb_widgets_description($description, true);
	}
}

// -----------------------------------------------------------------------------

/**
 * Widgets checkbox input
 *
 * @param object $widget
 * @param string $name
 * @param boolean $checked
 * @param string $label
 * @param string $description
 */
if (!function_exists('tb_widgets_checkbox'))
{
	function tb_widgets_checkbox($widget, $name = '', $checked = false, $label = '', $description = '')
	{
		if (is_array($name)) {
			extract($name);
		}
		$id = $widget->get_field_id($name);
		$checked = $checked ? ' checked="checked"' : '';
		echo
			'<fieldset>'.
				'<label for="'.$id.'">'.
					'<input id="'.$id.'" type="checkbox" name="'.$widget->get_field_name($name).'" value="1"'.$checked.' /> '.
					$label.tb_widgets_get_description($description).
				'</label>'.
			'</fieldset>';
	}
}