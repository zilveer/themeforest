<?php 


/**************************************
FUNCTIONS

	function mb_get_google_webfonts_link ($font_array) {
	function mb_build_delim_string_from_array($array, $delim, $prefix, $postfix) {
	function mb_add_value_to_delim_string($string, $add_value, $delim, $add_if_duplicate) {
	function mb_del_value_from_delim_string($string, $del_value, $delim) {
	function mb_is_value_in_delim_string($string, $check_value, $delim) {
	function mb_cookie_get_key_value ($cookie_name, $key) {
	function mb_localize_datetime($datetime) {
	function mb_show_admin_notice ($message, $class) {
	function format_datetime_str ($format_str, $datetime_str)
	function mb_make_excerpt($string, $maxlen) 
	function mb_get_page_type () {
	function mb_get_latest_tweets ($twitter_screen_name) //returns an array of tweet objects. The content is in ->text or on error returns false with errorlog in transient
	function mb_filter_tweet ($tweet) {
	function mb_time_ago_tweet ($tweet_object) {
	function mb_get_twitter_count ($twitter_screen_name) {
	function mb_get_facebook_count ($facebook_page)
	function mb_get_rss_count ($feedburner_account) {
	function mb_update_post_views($post_id) {
	function mb_get_post_views($post_id) {
	function mb_update_post_views_single_check($post_id) {
	function mb_get_rating_percentage ($rating, $min_rating, $max_rating, $increment, $ignore_increment) {
	function mb_get_rating_color ($rating_percentage) {
	function mb_get_rating_label ($rating_percentage) {
	function mb_get_updated_order_array ($results_slider_posts) {

***************************************/


/****************************************************
mb_get_google_webfonts_link
****************************************************/

	function mb_get_google_webfonts_link ($font_array) {
		//build vars
		$font_family = $font_array[0];
		$font_family = preg_replace('/\s/', '+', $font_family);
		$font_variant = $font_array[1];
		$font_subset = $font_array[2];


		//build google webfonts url
			//<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		$google_webfonts_url = "<link href='http://fonts.googleapis.com/css?family=";
		$google_webfonts_url .= $font_family;

		if ($font_variant != "regular") {
			$google_webfonts_url .= ":";
			$google_webfonts_url .= $font_variant;
		}

		if ($font_subset != "latin") {
			$google_webfonts_url .= "&subset=";
			$google_webfonts_url .= $font_subset;
		}

		$google_webfonts_url .= "' rel='stylesheet' type='text/css'>";

		return $google_webfonts_url;
			
	}


/****************************************************
mb_build_delim_string_from_array
****************************************************/

	function mb_build_delim_string_from_array($array, $delim, $prefix, $postfix) {

		$return_string = "";
		foreach ($array as $key => $value) {
			$return_string .= $prefix . $key . $postfix . $delim;
		}
		$return_string = substr($return_string,0,strlen($return_string)-1);
		
		return $return_string;	
	}


/****************************************************
mb_add_value_to_delim_string
****************************************************/

	function mb_add_value_to_delim_string($string, $add_value, $delim, $add_if_duplicate) {
		$explode_arr = explode($delim, $string);	
		
		//check if duplicate
		$duplicate = false;
		foreach ($explode_arr as $key => $value) {
			if ($value == $add_value) $duplicate = true;			
		}

		//return $string untouched if not add on duplicate and duplicate found
		if ($add_if_duplicate == false && $duplicate == true) return $string;

		//in all other cases go ahead and update
		$string = $string . "," . $add_value;
		if (substr($string, 0, 1) == ",") $string = substr($string, 1, strlen($string)-1);

		return $string;
	}


/****************************************************
mb_del_value_to_delim_string
****************************************************/

	function mb_del_value_from_delim_string($string, $del_value, $delim) {
		$explode_arr = explode($delim, $string);
		$return_string = "";	
		
		//build return_string
		foreach ($explode_arr as $key => $value) {
			if ($value != $del_value) $return_string .= $value . ",";			
		}
		$return_string = substr($return_string, 0, strlen($return_string)-1);

		return $return_string;
	}


/****************************************************
mb_is_value_in_delim_string
****************************************************/

	function mb_is_value_in_delim_string($string, $check_value, $delim) {
		$explode_arr = explode($delim, $string);
		foreach ($explode_arr as $key => $value) {
			if ($value == $check_value) return true;	
		}
		return false;
	}


/****************************************************
mb_cookie_get_key_value
****************************************************/

	//this function assumes your cookiestring is ordered like f.x. "likes=1,2,3,4,5&hates=none"
	//using mb_cookie_get_key_value('cookiename', 'likes') will return "1,2,3,4,5"

	function mb_cookie_get_key_value ($cookie_name, $key) {
		if (!isset($_COOKIE[$cookie_name])) return false;

		$cookiestring = $_COOKIE[$cookie_name];
		$explode_arr = explode($key . "=", $cookiestring);
		$explode_arr = explode("&", $explode_arr[1]);

		return $explode_arr[0];
	}


/****************************************************
mb_localize_datetime
****************************************************/

	function mb_localize_datetime($datetime) {
		$datetime = str_replace('January', __('January', 'loc_inspire'), $datetime);
		$datetime = str_replace('February', __('February', 'loc_inspire'), $datetime);
		$datetime = str_replace('March', __('March', 'loc_inspire'), $datetime);
		$datetime = str_replace('April', __('April', 'loc_inspire'), $datetime);
		$datetime = str_replace('May', __('May', 'loc_inspire'), $datetime);
		$datetime = str_replace('June', __('June', 'loc_inspire'), $datetime);
		$datetime = str_replace('July', __('July', 'loc_inspire'), $datetime);
		$datetime = str_replace('August', __('August', 'loc_inspire'), $datetime);
		$datetime = str_replace('September', __('September', 'loc_inspire'), $datetime);
		$datetime = str_replace('October', __('October', 'loc_inspire'), $datetime);
		$datetime = str_replace('November', __('November', 'loc_inspire'), $datetime);
		$datetime = str_replace('December', __('December', 'loc_inspire'), $datetime);

		$datetime = str_replace('Jan', __('Jan', 'loc_inspire'), $datetime);
		$datetime = str_replace('Feb', __('Feb', 'loc_inspire'), $datetime);
		$datetime = str_replace('Mar', __('Mar', 'loc_inspire'), $datetime);
		$datetime = str_replace('Apr', __('Apr', 'loc_inspire'), $datetime);
		$datetime = str_replace('May', __('May', 'loc_inspire'), $datetime);
		$datetime = str_replace('Jun', __('Jun', 'loc_inspire'), $datetime);
		$datetime = str_replace('Jul', __('Jul', 'loc_inspire'), $datetime);
		$datetime = str_replace('Aug', __('Aug', 'loc_inspire'), $datetime);
		$datetime = str_replace('Sep', __('Sep', 'loc_inspire'), $datetime);
		$datetime = str_replace('Oct', __('Oct', 'loc_inspire'), $datetime);
		$datetime = str_replace('Nov', __('Nov', 'loc_inspire'), $datetime);
		$datetime = str_replace('Dec', __('Dec', 'loc_inspire'), $datetime);

		$datetime = str_replace('Monday', __('Monday', 'loc_inspire'), $datetime);
		$datetime = str_replace('Tuesday', __('Tuesday', 'loc_inspire'), $datetime);
		$datetime = str_replace('Wednesday', __('Wednesday', 'loc_inspire'), $datetime);
		$datetime = str_replace('Thursday', __('Thursday', 'loc_inspire'), $datetime);
		$datetime = str_replace('Friday', __('Friday', 'loc_inspire'), $datetime);
		$datetime = str_replace('Saturday', __('Saturday', 'loc_inspire'), $datetime);
		$datetime = str_replace('Sunday', __('Sunday', 'loc_inspire'), $datetime);

		$datetime = str_replace('Mon', __('Mon', 'loc_inspire'), $datetime);
		$datetime = str_replace('Tue', __('Tue', 'loc_inspire'), $datetime);
		$datetime = str_replace('Wed', __('Wed', 'loc_inspire'), $datetime);
		$datetime = str_replace('Thu', __('Thu', 'loc_inspire'), $datetime);
		$datetime = str_replace('Fri', __('Fri', 'loc_inspire'), $datetime);
		$datetime = str_replace('Sat', __('Sat', 'loc_inspire'), $datetime);
		$datetime = str_replace('Sun', __('Sun', 'loc_inspire'), $datetime);

		return $datetime;
			
	}
	


/****************************************************
mb_show_admin_notice
****************************************************/

	// show notice in the admin area. Classe: updated (yellow), error (red)
	function mb_show_admin_notice ($message, $class) {
		echo "<div class=$class>$message</div>";		
	}
	
/****************************************************
format_datetime_str
****************************************************/

	//format_str as shown in http://php.net/manual/en/function.date.php, datetime_str: mysql datetime like "2012-10-28 07:51:42", returns a formatted string.
	function format_datetime_str ($format_str, $datetime_str) {

		$timestamp = strtotime($datetime_str);
		$return_str = date($format_str, $timestamp);
		return $return_str;
	}

/****************************************************
mb_make_excerpt
****************************************************/

	//returns a string excerpt of length = $maxlen with "..." attached to the end if $by_word is set to true then will try to split by word looking back for a max of $search_len characters
	function mb_make_excerpt($string, $maxlen, $by_word) {

		$search_len = 10;

		$string = strip_shortcodes($string);
		$string = strip_tags($string);

		if (strlen($string)>$maxlen) {
			if ($by_word === true) {
				$string = substr($string, 0, $maxlen);
				for ($i = 1; $i < $search_len; $i++) {
					if (substr($string, $maxlen-$i, 1) == " ") {
						$string = substr($string, 0, $maxlen-$i) . " ...";
						return	$string;
					} 
				}
				//only gets here if a space haven't been found for during search_len
				$string = substr($string, 0, $maxlen-3) . "..."; 
			} else {
				$string = substr($string, 0, $maxlen-3) . "..."; 
			}
		}	

		return $string;
	}

/****************************************************
mb_get_page_type
****************************************************/

	//return the type of page/post/loop you're on. Returns false if called from environments with no type. Look here for more: http://codex.wordpress.org/Conditional_Tags
	function mb_get_page_type () {
		global $post;
		$type = false;	
		if (is_category()) { $type = 'category'; }
		if (is_date()) { $type = 'date'; }
		if (is_time() ) { $type = 'time'; }
		if (is_day()) { $type = 'day'; }
		if (is_month()) { $type = 'month'; }
		if (is_year()) { $type = 'year'; }
		if (is_author()) { $type = 'author'; }
		if (is_tag()) { $type = 'tag'; }
		if (is_home()) { $type = 'home'; }
		if (is_admin()) { $type = 'admin'; }
		if (is_single()) { $type = 'single'; }
		if (is_page()) { $type = 'page'; }
		if (is_tax()) { $type = 'tax'; }
		if (is_search()) { $type = 'search'; }
		if (is_404()) { $type = '404'; }

		return $type;
	}

/****************************************************
mb_get_latest_tweets
****************************************************/

	//return latest tweets
	function mb_get_latest_tweets ($twitter_screen_name) //returns an array of tweet objects. The content is in ->text or on error returns false with errorlog in transient
	{
		$latest_tweets_data = get_transient('latest_tweets_data');		//returns object

		if ($latest_tweets_data === false || $twitter_screen_name != $latest_tweets_data->screen_name) {			//runs the actual function if there is no cached data or the username has changed
			//echo "NEW RUN!<br>";
			$latest_tweets = wp_remote_get("http://api.twitter.com/1/statuses/user_timeline.json?screen_name=" . $twitter_screen_name);

			if ($latest_tweets['response']['code']  == '200') {
				$latest_tweets = json_decode($latest_tweets['body']);

				$latest_tweets_data = new stdClass();
				$latest_tweets_data->screen_name = $twitter_screen_name;
				$latest_tweets_data->tweets = $latest_tweets;

				set_transient('latest_tweets_data', $latest_tweets_data, 60*20);
					
			} else {
				$latest_tweets = json_decode($latest_tweets['body']);
				if (isset($latest_tweets->error)) {
					$latest_tweets_error = $latest_tweets->error;	
				} elseif (isset($latest_tweets->errors[0]->message)) {
					$latest_tweets_error = $latest_tweets->errors[0]->message;
				} else {
					$latest_tweets_error = "Unknown error";
				}

				delete_transient('latest_tweets_data');
				set_transient('latest_tweets_error', $latest_tweets_error, 60*20);
				return false;								
			}
					
		}

		return $latest_tweets_data->tweets;
	}

/****************************************************
mb_filter_tweet
****************************************************/

	//filter a tweet and replace links with working links
	function mb_filter_tweet ($tweet) {
		$tweet = preg_replace ('/(http[^\s]+)/im','<a href="$1" target="_blank">$1</a>', $tweet);
		$tweet = preg_replace ('/@([^\s]+)/i','<a href="http://twitter.com/$1" target="_blank">@$1</a>', $tweet);
		$tweet = preg_replace ('/#([^\s\.\!]+)/i','<a href="https://twitter.com/search?q=%23$1&src=hash" target="_blank">#$1</a>', $tweet);

		return $tweet;
	}

/****************************************************
mb_time_ago_tweet
****************************************************/

	function mb_time_ago_tweet ($tweet_object) {

		$twitter_date = $tweet_object->created_at;
		$twitter_date_pieces = explode(" ", $twitter_date);
		$twitter_date_parsable = $twitter_date_pieces[2] . " " . $twitter_date_pieces[1] . " " . $twitter_date_pieces[5] . " " . $twitter_date_pieces[3];
		$twitter_date_timestamp = strtotime($twitter_date_parsable);
		$readable_time_diff = human_time_diff($twitter_date_timestamp);

		return $readable_time_diff;
	}

/****************************************************
mb_get_twitter_count
****************************************************/

	//returns num of followers on twitter
	function mb_get_twitter_count ($twitter_screen_name) {
		
		$twitter_count = get_transient('twitter_count');

		if ($twitter_count === false) {
			//echo "NEW RUN!<br>";
			if (!empty($twitter_screen_name)) {
				$tweets = wp_remote_get("http://api.twitter.com/1/users/show.json?screen_name=" . $twitter_screen_name);
				if ($tweets['response']['code']  == '200') {
					$tweets = json_decode($tweets['body']);
					$twitter_count = $tweets->followers_count;
					set_transient('twitter_count', $twitter_count, 60*20);
				} else {
					$tweets = json_decode($tweets['body']);
					$tweets = $tweets->errors[0]->message;
					return $tweets;
				}
			} else {
				$twitter_count = 0;
				set_transient('twitter_count', $twitter_count, 60*20);
			}
		}
		return $twitter_count;
	}


/****************************************************
mb_get_facebook_count
****************************************************/

	//returns num of likes on facebook
	function mb_get_facebook_count ($facebook_page) {
		
		$facebook_count = get_transient('facebook_count');

		if (!$facebook_count) {
			if (!empty($facebook_page)) {
				$facebook_data = wp_remote_get("http://graph.facebook.com/" . $facebook_page);
				$facebook_data = json_decode($facebook_data['body']);

				if (isset($facebook_data->likes)) {
					$facebook_count = $facebook_data->likes;
					set_transient('facebook_count', $facebook_count, 60*20);
				} else {
					$facebook_count = false;
				}
			} else {
			    $facebook_count = 0;
				set_transient('facebook_count', $facebook_count, 60*20);
			}
		}

		return $facebook_count;
	}


/****************************************************
mb_get_rss_count
****************************************************/

	//returns num of subscribers to rss feed
	//WARNING: THE FEEDBURNER API IS DEFUNCT AS OF OCTOBER 2012. This means that the function is no longer working.	
	function mb_get_rss_count ($feedburner_account) {
		
		$rss_count = get_transient('rss_count');

		if (!$rss_count) {				//is local widget feedburner account set
			if(!empty($feedburner_account)) {
				$rss_data = wp_remote_get("http://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=" . $feedburner_account);
				$rss_data_body = simplexml_load_string($rss_data['body']);
				if ($rss_data_body->err || $rss_data['response']['code'] == '401' ) {			//notice feedburner returns (at least) two different kind of errors and does not have a general error handle
					$rss_count = false;
				} else {
					$rss_count = (int)$rss_data_body->feed->entry->attributes()->circulation;
					set_transient('rss_count', $rss_count, 60*20);
				}
			} else {
				$rss_count = 0;
				set_transient('rss_count', $rss_count, 60*20);
			}
		}
		return $rss_count;
	}


/****************************************************
mb_update_post_views
****************************************************/

	//update post views
	function mb_update_post_views($post_id) {
		$meta_key_views = 'post_views';
		$views = get_post_meta($post_id, $meta_key_views, true);
		if ($views == '') {
			$views = 1;
			delete_post_meta($post_id, $meta_key_views)	;
			update_post_meta($post_id, $meta_key_views, $views);
		} else {
			$views++;
			update_post_meta($post_id, $meta_key_views, $views);
		}

		return $views;
	}

/****************************************************
mb_get_post_views
****************************************************/

	//get post views
	function mb_get_post_views($post_id) {
		$meta_key_views = 'post_views';
		$views = get_post_meta($post_id, $meta_key_views, true);
		if ($views == '') {
			$views = 1;
			delete_post_meta($post_id, $meta_key_views);
			update_post_meta($post_id, $meta_key_views, $views);
		}
		return $views;
	}

/****************************************************
mb_update_post_views_single_check
****************************************************/

	//this function is included in all heads, check to see if page is single
	function mb_update_post_views_single_check($post_id) {
		if (!is_single()) return;
		if (empty($post_id)) {
			global $post;
			$post_id = 	$post->ID;
		}
		mb_update_post_views($post_id);
	}
	add_action('wp_head', 'mb_update_post_views_single_check' );


/****************************************************
mb_get_rating_percentage
****************************************************/

	function mb_get_rating_percentage ($rating, $min_rating, $max_rating, $increment, $ignore_increment) {
		//$ignore_increment (boolean) should usually be set to true. This is not mathematically correct when calculating rating %, but it is more easily understood by the end user.

		if ($ignore_increment === true) $increment = 1;
		$scale_resolution = ($max_rating - ($min_rating - $increment)) / $increment;
		$rel_rating = ($rating - ($min_rating - $increment)) / $increment;
		$rating_percentage = ($rel_rating / $scale_resolution) * 100;

		return $rating_percentage;
	}

/****************************************************
mb_get_rating_color
****************************************************/

	function mb_get_rating_color ($rating_percentage) {
		if ($rating_percentage >= 0) $rating_color = 'red';
		if ($rating_percentage >= 20) $rating_color = 'darkred';
		if ($rating_percentage >= 40) $rating_color = 'yellow';
		if ($rating_percentage >= 60) $rating_color = 'darkgreen';
		if ($rating_percentage >= 80) $rating_color = 'green';

		return $rating_color;
	}

/****************************************************
mb_get_rating_label
****************************************************/

	function mb_get_rating_label ($rating_percentage) {
		$megamag_options_post = get_option('megamag_options_post');
		$rating_label = 'n/a';

		for ($i = 0; $i < 101; $i=$i+10) {  
			$index = "review_label_" . $i;
			if ($rating_percentage >= $i) if (!empty($megamag_options_post[$index])) $rating_label = $megamag_options_post[$index];
		}
		return $rating_label;
	}

/****************************************************
mb_get_updated_order_array
****************************************************/

	/*************************************************
	This function updates the slider order
	It is called in these places:
	- options_homepage.php
	- template_slider.php

	it returns $order_array

	**************************************************/

	function mb_get_updated_order_array ($results_slider_posts) {

		$inspire_options_hp = get_option('inspire_options_hp');

		//update slider order so it matches cmb_slider_feature posts

		//init variables
		$slider_array = array();
		$order_array = array();

		//build our two arrays for comparison. First slider_array
		foreach ($results_slider_posts as $slider_post) $slider_array[] = $slider_post->ID;

		//the order_array
		if (!empty($inspire_options_hp['slider_order'])) {
			$order_array = explode (',', $inspire_options_hp['slider_order']);
		} else {
			for ($i = 0; $i < count($results_slider_posts); $i++) {  
				$order_array[$i] = $results_slider_posts[$i]->ID;
			}	
		}

		if (count($slider_array) != count($order_array)) {						//something is up, the two arrays are not same length
			if (count($slider_array) > count($order_array)) {					//posts have been added - update order
				$diff_array = array_diff($slider_array, $order_array);			//array diff nb: the sequence of arrays is important.
				$new_order_array = array_merge($order_array, $diff_array);
				$order_string = "";
				foreach ($new_order_array as $new) {
					$order_string .= $new . ",";
				}
				$order_string = substr($order_string, 0, strlen($order_string)-1);

			} elseif (count($slider_array) < count($order_array)) {				//posts have been removed - update order
				$diff_array = array_diff($order_array, $slider_array);
				$new_order_array = array_diff($order_array, $diff_array);
				$order_string = "";
				foreach ($new_order_array as $new) {
					$order_string .= $new . ",";
				}
				$order_string = substr($order_string, 0, strlen($order_string)-1);
			}	

			//save and update
			$inspire_options_hp['slider_order']	= $order_string;
			update_option('inspire_options_hp', $inspire_options_hp);
			$inspire_options_hp = get_option('inspire_options_hp'); 

			//and build new order array
			if (!empty($inspire_options_hp['slider_order'])) {
				$order_array = explode (',', $inspire_options_hp['slider_order']);
			} else {
				for ($i = 0; $i < count($results_slider_posts); $i++) {  
					$order_array[$i] = $results_slider_posts[$i]->ID;
				}	
			}
		}

		return $order_array;

	}		//end function