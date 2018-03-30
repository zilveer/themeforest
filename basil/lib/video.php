<?php
/*
Video utility library. The aim of the library is to ease parsing of various
video inputs and to provide consistent interface to work with youtube and vimeo
videos that doesn’ t require understanding of all types of URL and embed formats
provided by video providers.

Documentation is available at wp-wiki. 

Usage

	<?php
	$youtube_link = "https://www.youtube.com/watch?v=n4RjJKxsamQ";

	$video = Carbon_Video::create($youtube_link);

	// Print HTML video embed code with specified dimensions
	echo $video->get_embed_code(640, 480);

	// Remove related videos and print embed code
	echo $video->set_param('rel', '0')->get_embed_code();

	// Print video thumbnail
	echo $video->get_thumbnail();
	?>
	*/

/**
 * Base class for video objects.
 * 
 * Defines the interface for working with video embeds and provides factory method for 
 * creating new objects(`create`).
 */
abstract class Carbon_Video {
	/**
	 * Width and height container
	 * @var array
	 */
	protected $dimensions = array(
		'width'=>null,
		'height'=>null
	);

	/**
	 * Caching object
	 * @var Carbon_Video_Cache
	 */
	public $cache;

	/**
	 * Http-related object
	 * @var Carbon_Video_Http
	 */
	public $http;

	/**
	 * The ID of the video in the site that hosts it
	 * @var string
	 */
	protected $video_id;

	/**
	 * URL GET params. 
	 * @var array
	 */
	protected $params = array();

	/**
	 * The time that video should start playback at
	 * @var boolean|integer
	 */
	protected $start_time = false;

	/**
	 * Commonly used fragments in the parsing regular expressions
	 * @var array
	 */
	protected $regex_fragments = array(
		// Describe "http://" or "https://" or "//"
		"protocol" => '(?:https?:)?//',

		// Describe GET args list
		"args" => '(?:\?(?P<params>.+?))?',
	);

	/**
	 * Parses embed code, url, or video ID and creates new object based on it. 
	 * 
	 * @param string $video embed code, url, or video ID
	 * @return object Carbon_Video
	 **/
	static function create($video_code) {
		$video_code = trim($video_code);

		$video = null;

		$video_providers = array("Youtube", "Vimeo");

		foreach ($video_providers as $video_provider) {
			$class_name = "Carbon_Video_$video_provider";

			if (call_user_func(array($class_name, 'test'), $video_code)) {
				$video = new $class_name();
				break;
			}
		}

		if (is_null($video)) {
			// No video provider recognized the video
			$video = new Carbon_Video_Broken();
		}

		$result = $video->parse($video_code);

		if (!$result) {
			// Couldn't parse the video code. 
			$video = new Carbon_Video_Broken();
		}

		return $video;
	}

	// Abstract methods implemented in each concrete class

	/**
	 * Handles the paring of all formats associated with the partuclar video provider
	 * 
	 * @param  string $video_code URL, embed code, etc.
	 * @return bool             whether the operations has succeeded
	 */
	abstract public function parse($video_code);
	
	/**
	 * Return link to the video page's at the provider site
	 * @return string
	 */
	abstract public function get_link();
	
	/**
	 * Returns short link for the video at the provider site
	 * @return string
	 */
	abstract public function get_share_link();
	
	/**
	 * Returns iframe-based embed code with the specified dimensions
	 * @param  int $width
	 * @param  int $height
	 * @return string
	 */
	abstract public function get_embed_code($width=null, $height=null);
	
	/**
	 * Return direct URL to the iframe embed(without the iframe tag HTML)
	 * @return string URL to youtube embed
	 */
	abstract public function get_embed_url();

	/**
	 * Return URL of image thumbnail for the current video
	 * @return string
	 */
	abstract public function get_thumbnail();

	/**
	 * Return URL of big image for the current video
	 * @return string
	 */
	abstract public function get_image();

	function __construct() {
		$this->cache = new Carbon_Video_Cache();
		$this->http = new Carbon_Video_Http();
	}

	public function is_broken() {
		return empty($this->video_id);
	}

	public function get_width() {
		return $this->dimensions['width'];
	}

	public function set_width($new_width) {
		$this->dimensions['width'] = $new_width;

		return $this;
	}

	public function get_height() {
		return $this->dimensions['height'];
	}

	public function set_height($new_height) {
		$this->dimensions['height'] = $new_height;
		
		return $this;
	}

	function get_param($arg) {
		if (isset($this->params[$arg])) {
			return $this->params[$arg];
		}
		return null;
	}

	function set_param($arg, $val) {
		$this->params[$arg] = $val;
		return $this;
	}
	
	function get_id() {
		return $this->video_id;
	}

	function get_start_time() {
		return $this->start_time;
	}

	/**
	 * Set multiple parameters in one call
	 * @param array $params associative array where keys are param
	 *                      names and values are param values
	 */
	public function set_params($params) {
		foreach ($params as $param_name=>$param_val) {
			$this->set_param($param_name, $param_val);
		}
		return $this;
	}

	// If width and height are not provided in the function parameters,
	// get them from the initial video code; if the object wasn't constructed
	// from an embed code(and doesn't have initial width and height), use 
	// the default, hard-coded dimensions. 

	protected function get_embed_width($user_supplied_width) {
		if (!is_null($user_supplied_width)) {
			return $user_supplied_width;
		}
		if (!empty($this->dimensions['width'])) {
			return $this->dimensions['width'];
		}
		return $this->default_width;
	}

	function get_embed_height($user_supplied_height) {
		if (!is_null($user_supplied_height)) {
			return $user_supplied_height;
		}
		if (!empty($this->dimensions['height'])) {
			return $this->dimensions['height'];
		}
		return $this->default_height;
	}
	
}

/**
 * Vimeo handling code
 */
class Carbon_Video_Vimeo extends Carbon_Video {
	protected $default_width  = '500';
	protected $default_height = '281';

	/**
	 * Check whether video code looks remotely like vimeo link or embed code. 
	 * Returning true here doesn't guarantee that the code will be actually paraseable. 
	 * 
	 * @param  string $video_code
	 * @return boolean
	 */
	static function test($video_code) {
		return preg_match('~(https?:)?//[\w.]*vimeo\.com~i', $video_code);
	}

	function __construct() {
		$this->regex_fragments = array_merge($this->regex_fragments, array(
			'video_id'=>'(?P<video_id>\d+)'
		));
		parent::__construct();
	}

	function parse($video_code) {
		$regexes = array(
			// Matches:
			//  - http://vimeo.com/2526536
			//  - http://vimeo.com/channels/staffpicks/98861259
			//  - http://vimeo.com/2526536#t=15s
			//  - http://vimeo.com/2526536#t=195s
			//  - https://vimeo.com/2526536/download?t=1430490026&v=8950830&s=49a858df9eb7f016593c63c60e66bd9f
			"url_regex" =>
				'~^' . 
					$this->regex_fragments['protocol'] . 
					'vimeo\.com/.*?/?' . 
					$this->regex_fragments['video_id'] .
					'(?:#t=(?P<start>\d+)s)?' .
					'.*?' .
				'$~i', 

			// Matches embed code direct link: http://player.vimeo.com/video/98861259
			"embed_direct_link_regex" =>
				'~^' . 
					$this->regex_fragments['protocol'] . 
					'player\.vimeo\.com/video/' . 
					$this->regex_fragments['video_id'] . 
					$this->regex_fragments['args'] . 
				'$~i',

			// Matches iframe based embed code
			"embed_code_regex" =>
				'~^' . 
					'<iframe.*?src=[\'"]' . 
					$this->regex_fragments['protocol'] . 
					'player\.vimeo\.com/video/' . 
					$this->regex_fragments['video_id'] . 
					$this->regex_fragments['args'] . 
				'[\'"]~i',

			// Matches old flash based embed code generated from vimeo
			"old_embed_code_regex" =>
				'~'.
					'<object.*?' .
					$this->regex_fragments['protocol'] . 
					'vimeo\.com/moogaloop\.swf' . 
					$this->regex_fragments['args'] .
				'[\'"]~i'
		);
		$video_input_type = false;
		foreach ($regexes as $regex_type => $regex) {
			if (preg_match($regex, $video_code, $matches)) {
				$video_input_type = $regex_type;

				// The video ID is in GET params when old embed code is used.
				if (isset($matches['video_id'])) {
					$this->video_id = $matches['video_id'];
				}

				// Start in vimeo is in the hash rather than in GET param, so
				// it's handled differently from youtube's start param. 
				if (!empty($matches['start'])) {
					$this->start_time = $matches['start'];
				}

				if (isset($matches['params'])) {
					// & in the URLs is encoded as &amp;, so fix that before parsing
					$args = htmlspecialchars_decode($matches['params']);
					parse_str($args, $params);

					if (isset($params['clip_id'])) {
						$this->video_id = $params['clip_id'];

						unset($matches['clip_id']);
					}

					// These params are presented in the old flash embed code, but
					// aren't used in HTTP
					$flash_specific_args = array(
						'force_embed', 'server', 'fullscreen'
					);

					// Some elements have slightly different names in the flash and HTML
					// embed code
					$flash_to_html5_args_map = array(
						'show_title' => 'title',
						'show_byline' => 'byline',
						'show_portrait' => 'portrait',
					);

					foreach ($params as $arg_name => $arg_val) {
						if (in_array($arg_name, $flash_specific_args)) {
							// Don't care about those ... 
							continue; 
						}

						if (isset($flash_to_html5_args_map[$arg_name])) {
							// save the HTML param name rather
							// than flash's param name
							$arg_name = $flash_to_html5_args_map[$arg_name];
						}

						$this->set_param($arg_name, $arg_val);
					}
				}

				break;
			}
		}

		// For embed codes, width and height should be extracted
		$is_embed_code = in_array($video_input_type, array(
			'embed_code_regex',
			'old_embed_code_regex'
		));

		if ($is_embed_code) {
			if (preg_match_all('~(?P<dimension>width|height)=[\'"](?P<val>\d+)[\'"]~', $video_code, $matches)) {
				$this->dimensions = array_combine(
					$matches['dimension'],
					$matches['val']
				);
			}
		}

		if (empty($this->video_id)) {
			return false;
		}
		return true;
	}
	
	private function get_video_data() {
		$transient_id = 'vimeo-thumbnail:' . $this->video_id;

		$video_data = $this->cache->get($transient_id);

		if ($video_data === false) {
			$api_url = 'http://vimeo.com/api/v2/video/' . $this->video_id . '.json';
			
			$json = $this->http->get($api_url);

			$video_data = json_decode($json);
			$video_data = $video_data[0];

			// Set the transient for 30 days. 
			$this->cache->set($transient_id, $video_data, 30 * 86400);
		}

		return $video_data;
	}

	function get_thumbnail() {
		$video_data = $this->get_video_data();

		return $video_data->thumbnail_medium;
	}
	function get_image() {
		$video_data = $this->get_video_data();

		return $video_data->thumbnail_large;
	}
	
	function get_share_link() {
		return $this->get_link();
	}

	function get_link() {
		$url = "//vimeo.com/" . $this->video_id;
		if (isset($this->start_time)) {
			$url .= "#" . $this->start_time . "s";
		}
		return $url;
	}
	function get_embed_url() {
		$url = '//player.vimeo.com/video/' . $this->video_id;

		if (!empty($this->params)) {
			$url .= '?' . htmlspecialchars(http_build_query($this->params));
		}

		return $url;
	}
	function get_embed_code($width=null, $height=null) {
		$width = $this->get_embed_width($width);
		$height = $this->get_embed_height($height);
		
		return '<iframe src="' . $this->get_embed_url() . '" width="' . $width . '" height="' . $height . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	}
}

/**
 * Youtube handling code. 
 */
class Carbon_Video_Youtube extends Carbon_Video {
	protected $default_width = '640';
	protected $default_height = '360';

	/**
	 * The default domain name for youtube videos
	 */
	const DEFAULT_DOMAIN = 'www.youtube.com';

	/**
	 * The original domain name of the video: either youtube.com or youtube-nocookies.com
	 * @var string
	 */
	public $domain = self::DEFAULT_DOMAIN;

	/**
	 * Check whether video code looks remotely like youtube link, short link or embed code. 
	 * Returning true here doesn't guarantee that the code will be actually paraseable. 
	 * 
	 * @param  string $video_code
	 * @return boolean
	 */
	static function test($video_code) {
		return preg_match('~(https?:)?//(www\.)?(youtube(-nocookie)?\.com|youtu\.be)~i', $video_code);
	}

	function __construct() {
		$this->regex_fragments = array_merge($this->regex_fragments, array(
			// Desribe youtube video ID 
			"video_id" => '(?P<video_id>[\w\-]+)',
		));
		parent::__construct();
	}

	/**
	 * Constructs new object from various video inputs. 
	 */
	function parse($video_code) {
		$regexes = array(
			// Something like: https://www.youtube.com/watch?v=lsSC2vx7zFQ
			"url_regex" =>
				'~^' . 
					$this->regex_fragments['protocol'] . 
					'(?P<domain>(?:www\.)?youtube\.com)/watch.*(?:\?|&(?:amp;)?)v=' . 
					$this->regex_fragments['video_id'] .
				'~i', 

			// Something like "http://youtu.be/lsSC2vx7zFQ" or "http://youtu.be/6jCNXASjzMY?t=3m11s"
			"share_url_regex" =>
				'~^' .
					$this->regex_fragments['protocol'] . 
					'youtu\.be/' .
					$this->regex_fragments['video_id'] .
					$this->regex_fragments['args'] .
				'$~i',

			// Youtube embed iframe code: 
			// //www.youtube.com/embed/LlhfzIQo-L8?rel=0
			"direct_embed_code_regex" =>
				'~^'.
					$this->regex_fragments['protocol'] . 
					'(?P<domain>(www\.)?youtube(?:-nocookie)?\.com)/(?:embed|v)/' . 
					$this->regex_fragments['video_id'] .
					$this->regex_fragments['args'] .
				'$~i',

			// Youtube embed iframe code: 
			// <iframe width="560" height="315" src="//www.youtube.com/embed/LlhfzIQo-L8?rel=0" frameborder="0" allowfullscreen></iframe>
			"embed_code_regex" =>
				'~'.
					'<iframe.*?src=[\'"]' .
					$this->regex_fragments['protocol'] . 
					'(?P<domain>(www\.)?youtube(?:-nocookie)?\.com)/(?:embed|v)/' . 
					$this->regex_fragments['video_id'] .
					$this->regex_fragments['args'] .
				'[\'"]~i',

			// Youtube old embed flash code:
			// <object width="234" height="132"><param name="movie" ....
			// .. type="application/x-shockwave-flash" width="234" heighGt="132" allowscriptaccess="always" allowfullscreen="true"></embed></object>
			"old_embed_code_regex" =>
				'~'.
					'<object.*?' .
					$this->regex_fragments['protocol'] . 
					'(?P<domain>(www\.)?youtube(?:-nocookie)?\.com)/v/' . 
					$this->regex_fragments['video_id'] .
					$this->regex_fragments['args'] .
				'[\'"]~i'
		);

		$args = array();
		$video_input_type = null;

		foreach ($regexes as $regex_type => $regex) {
			if (preg_match($regex, $video_code, $matches)) {
				$video_input_type = $regex_type;
				$this->video_id = $matches['video_id'];

				if (isset($matches['params'])) {
					// & in the URLs is encoded as &amp;, so fix that before parsing
					$args = htmlspecialchars_decode($matches['params']);
					parse_str($args, $params);

					if ($video_input_type === 'old_embed_code_regex') {
						// Those are legacy params for the flash player
						unset($params['hl'], $params['version']);
					}

					foreach ($params as $arg_name => $arg_val) {
						$this->set_param($arg_name, $arg_val);
					}
				}

				if (isset($matches['domain'])) {
					$this->domain = $matches['domain'];
				}

				// Stop after the first match
				break;
			}
		}

		// For embed codes, width and height should be extracted
		$is_embed_code = in_array($video_input_type, array(
			'embed_code_regex',
			'old_embed_code_regex'
		));

		if ($is_embed_code) {
			if (preg_match_all('~(?P<dimension>width|height)=[\'"](?P<val>\d+)[\'"]~', $video_code, $matches)) {
				$this->dimensions = array_combine(
					$matches['dimension'],
					$matches['val']
				);
			}
		}

		if (!isset($this->video_id)) {
			return false;
		}
		return true;
	}
	/**
	 * Override set_param in order to catch a special `t` and `start` params in youtube:
	 *   - `t` param is optional for share shortened links and is in format "3m2s" -- that is 
	 *     start playback 3 minutes and 2 seconds
	 *   - `start` is the same thing, but is used as embed code params
	 */
	function set_param($arg, $val) {
		// "t" param is special case since it's the only one in the share links
		// and it's translated differently to embed code params
		// (see https://developers.google.com/youtube/player_parameters#start)
		if ($arg === 't') {
			$this->start_time = $val;
			
			$arg = 'start';
			$val = $this->calc_time_in_seconds($val);

		} else if ($arg === 'start') {
			$this->start_time = $this->calc_shortlink_time($val);
		}

		return parent::set_param($arg, $val);
	}
	/**
	 * Returns share link for the video, e.g. http://youtu.be/6jCNXASjzMY?t=1s
	 */
	function get_share_link() {
		$url = '//youtu.be/' . $this->video_id;
		$time = $this->get_param('t');

		if ($this->start_time) {
			$url = add_query_arg('t', $this->start_time, $url);
		}

		return $url;
	}

	function get_link() {
		$url = '//' . self::DEFAULT_DOMAIN . '/watch?v=' . $this->video_id;
		$time = $this->get_param('t');

		if ($this->start_time) {
			$url = add_query_arg('t', $this->start_time, $url);
		}

		return $url;
	}
	function get_embed_url() {
		$url = '//' . $this->domain . '/embed/' . $this->video_id;

		if (!empty($this->params)) {
			$url .= '?' . htmlspecialchars(http_build_query($this->params));
		}

		return $url;
	}
	/**
	 * Returns iframe-based embed code.
	 */
	function get_embed_code($width=null, $height=null) {
		$width = $this->get_embed_width($width);
		$height = $this->get_embed_height($height);

		return '<iframe width="' . $width . '" height="' . $height . '" src="' . $this->get_embed_url() . '" frameborder="0" allowfullscreen></iframe>';
	}

	/**
	 * Returns image for the video
	 **/
	function get_image() {
		return '//img.youtube.com/vi/' . $this->video_id . '/0.jpg';
	}

	/**
	 * Returns thumbnail for the video
	 **/
	function get_thumbnail() {
		return '//img.youtube.com/vi/' . $this->video_id . '/default.jpg';
	}

	/**
	 * Calculates how many seconds are there in the string in format "3m2s". 
	 * @return int seconds
	 */
	private function calc_time_in_seconds($time) {
		if (preg_match('~(?:(?P<minutes>\d+)m)?(?:(?P<seconds>\d+)s)?~', $time, $matches)) {
			return $matches['minutes'] * 60 + $matches['seconds'];
		}
		// Doesn't match the format...
		return null;
	}

	/**
	 * Transforms seconds to string like "3m2s"
	 * @return int seconds
	 */
	private function calc_shortlink_time($seconds) {
		$result = '';
		if ($seconds > 60) {
			$result .= floor($seconds / 60) . "m";
		}
		return $result . ($seconds % 60) . "s";
	}

}


/**
 * Dummy class for broken videos.
 */
class Carbon_Video_Broken extends Carbon_Video {
	public function parse($video_code) {
		return true;
	}
	public function get_link() {
		return false;
	}
	public function get_share_link() {
		return false;
	}
	public function get_embed_url() {
		return false;
	}
	public function get_embed_code($width=null, $height=null) {
		return false;
	}
	public function get_thumbnail() {
		return false;
	}
	public function get_image() {
		return false;
	}
}

#############################################################
#### Carbon video helper classes
#############################################################
/**
 * Simple class that forwards requests to wp_remote_get.
 * Allows testing.
 */
class Carbon_Video_HTTP {
	function get($url) {
		$res = wp_remote_get($url);
		return $res['body'];
	}
}

/**
 * Simple cache object that forwards requests to 
 * WordPress transients. Allows testing
 */
class Carbon_Video_Cache {
	function set($name, $value, $expires) {
		return set_transient($name, $value, $expires);
	}
	function get($name) {
		return get_transient($name);
	}
}

#############################################################
#### Legacy video functions. 
#############################################################

/**
 * 
 * 
 * They're defined with function_exists checks since they didn't use prefix
 * and have rather general names that may conflict with future core WP functions.
 * 
 * These functions are here just to allow painless upgrade of core theme library. They will 
 * be moved from the trunk at some point in the future, so don't rely on them --
 * use Carbon_Video::create() directly instead. 
 * 
 * Note thta they have been rewritten to work with the new video handling code, so slight
 * changes in the results should be expected. For example you shouldn't expect 
 * flash output if you pass in flash input(since flash embed are deprecated).
 */

if (!function_exists('filter_video')) {
	/**
	 * Filters/resizes video embed codes.
	 * @param  string  embed code provided by video embedding service
	 * @param  boolean $wmode 
	 * @param  mixed $width
	 * @param  mixed $height
	 * @return string
	 */
	function filter_video($html, $wmode = false, $width = false, $height = false) {
		return Carbon_Video::create($html)
		    ->get_embed_code($width, $height);
	}	
}


if (!function_exists('get_video_thumb')) {
	/**
	 * Return the thumbnail src for Youtube and Vimeo videos
	 * @param  string $embed_code  the full video embed code ( or YouTube video url )
	 * @return string URL to the thumbnail
	 */
	function get_video_thumb($embed_code) {
		return Carbon_Video::create($embed_code)->get_thumbnail();
	}
}


if (!function_exists('get_vimeo_thumb')) {
	/**
	 * Return the thumbnail src for Vimeo videos
	 * @param  mixed Vimeo video id
	 * @return string URL to the thumbnail
	 */
	function get_vimeo_thumb($videoid) {
		return Carbon_Video::create($videoid)->get_thumbnail();
	}
}

if (!function_exists('get_youtube_video')) {
	/**
	 * Return a URL to an embedabble YouTube Video (the actual video file URL)
	 * @param  string $video_url
	 * @return string
	 */
	function get_youtube_video($video_url) {
		$video = Carbon_Video::create($video_url);

		return $video->get_embed_url();
	}
}

if (!function_exists('create_embedcode')) {
	/**
	 * Builds embed code from a video URL
	 * @param  string  $video_url
	 * @param  integer $width
	 * @param  integer $height
	 * @param  boolean $old_embed_code Whether to produce a mobile devices compitable, iframe-based, code(new code) or flash based embed code(old code)
	 * @param  boolean $autoplay
	 * @return [type]
	 */
	function create_embedcode($video_url, $width = 440, $height = 350, $old_embed_code = false, $autoplay = false) {
		$video = Carbon_Video::create($video_url);

		if ($autoplay) {
			$video->set_param('autoplay', 1);
		}

		return $video->get_embed_code($width, $height);
	}
}

if (!function_exists('create_youtube_embedcode')) {
	/**
	 * Generates an embedcode of a YouTube Video.
	 * @param  string  $video_url URL of the playable YouTube Video (for example: http://www.youtube.com/watch?v=emMDmRtdP7w0)
	 * @param  integer $width width of embedded video (optional)
	 * @param  integer $height height of embedded video (optional)
	 * @param  boolean $old_embed_code whether to use the old embedcode (optional). Uses @get_youtube_video to grab embeddable video URL
	 * @param  boolean $autoplay
	 * @return [type]
	 */
	function create_youtube_embedcode($video_url, $width = 440, $height = 350, $old_embed_code = false, $autoplay = false) {
		$video = Carbon_Video::create($video_url);

		if ($autoplay) {
			$video->set_param('autoplay', 1);
		}

		return $video->get_embed_code($width, $height);
	}
}

if (!function_exists('create_vimeo_embedcode')) {
	/**
	 * Return an embedcode of a Vimeo Video.
	 * @param  string  $video_url URL of the playable Vimeo Video (for example: http://vimeo.com/29081264)
	 * @param  integer $width width of embedded video (optional)
	 * @param  integer $height height of embedded video (optional)
	 * @param  boolean $autoplay
	 * @return [type]
	 */
	function create_vimeo_embedcode($video_url, $width=440, $height=350, $autoplay = false) {
		$video = Carbon_Video::create($video_url);

		if ($autoplay) {
			$video->set_param('autoplay', 1);
		}

		return $video->get_embed_code($width, $height);
	}
}