<?php
/*
Plugin Name: Twitter Widget
Description: Adds a widget to display Twitter updates.
Version: 10.0
*/

function widget_Twidget_init() {

	if ( !function_exists('wp_register_sidebar_widget') )
		return;

	function widget_Twidget($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_Twidget');
		$account = $options['account'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget
		$show = $options['show'];  // # of Updates to show
		$consumer_key = $options['consumer_key'];
		$consumer_key_secret = $options['consumer_key_secret'];
		$consumer_token = $options['consumer_token'];
		$consumer_token_secret = $options['consumer_token_secret'];
		
		// new API 1.1
		if ( !class_exists('TwitterOAuth')) {
			require_once ('twitteroauth.php');
		}
		$connection = new TwitterOAuth($consumer_key, $consumer_key_secret, $consumer_token, $consumer_token_secret);

        // Output
		echo $before_widget ;

		// start
		echo '<div id="twitter_div">'
              .$before_title.$title.$after_title;
		echo '<ul id="twitter_update_list">';
		
		$twitter_json_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$account.'&amp;include_rts=true&amp;count='.$show;
		$api_1_1_content = $connection->get($twitter_json_url);
		
		if ( is_array( $api_1_1_content ) AND isset( $api_1_1_content[0] -> id ) ) {
			$tweets = $api_1_1_content;
			$author = $tweets[0] -> user -> screen_name;
		}
		
		function time_since( $original, $do_more = 0 ) {
		// array of time period chunks
		$chunks = array(
			array(60 * 60 * 24 * 365 , 'year'),
			array(60 * 60 * 24 * 30 , 'month'),
			array(60 * 60 * 24 * 7, 'week'),
			array(60 * 60 * 24 , 'day'),
			array(60 * 60 , 'hour'),
			array(60 , 'minute'),
		);

		$today = time();
		$since = $today - $original;

		for ($i = 0, $j = count($chunks); $i < $j; $i++) {
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];

			if (($count = floor($since / $seconds)) != 0)
				break;
		}
		
		if ( !function_exists('jltw_format_tweettext')) {
			function jltw_format_tweettext($raw_tweet, $username) {

				$target4a = '_blank';

				$i_text = $raw_tweet;			
				//$i_text = htmlspecialchars_decode($raw_tweet);
				//$i_text = preg_replace('#(([a-zA-Z0-9_-]{1,130})\.([a-z]{2,4})(/[a-zA-Z0-9_-]+)?((\#)([a-zA-Z0-9_-]+))?)#','<a href="//$1">$1</a>',$i_text); 
				// replace tag
				$i_text = preg_replace('#\<([a-zA-Z])\>#','&lt;$1&gt;',$i_text);
				// replace ending tag
				$i_text = preg_replace('#\<\/([a-zA-Z])\>#','&lt;/$1&gt;',$i_text);
				// replace classic url
				$i_text = preg_replace('#(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4})(/[a-zA-Z0-9_\?\=-]+)?)#',' <a href="$1" rel="nofollow" class="juiz_last_tweet_url" target="'.$target4a.'">$5.$6$7</a>',$i_text);
				// replace user link
				$i_text = preg_replace('#@([a-zA-z0-9_]+)#i','<a href="http://twitter.com/$1" class="juiz_last_tweet_tweetos" rel="nofollow" target="'.$target4a.'">@$1</a>',$i_text);
				// replace hash tag search link ([a-zA-z0-9_] recently replaced by \S)
				$i_text = preg_replace('#[^&]\#(\S+)#i',' <a href="http://twitter.com/search/?src=hash&amp;q=%23$1" class="juiz_last_tweet_hastag" rel="nofollow" target="'.$target4a.'">#$1</a>',$i_text); // old url was : /search/%23$1
				// remove start username
				$i_text = preg_replace( '#^'.$username.': #i', '', $i_text );
				
				return $i_text;
			
			}
		}

		$print = ($count == 1) ? '1 '.$name : "$count {$name}s";

		if ($i + 1 < $j) {
			$seconds2 = $chunks[$i + 1][0];
			$name2 = $chunks[$i + 1][1];

			// add second item if it's greater than 0
			if ( (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) && $do_more )
				$print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
		}
		return $print;
	}


		$tw_counter = 0;
		foreach( (array) $tweets as $tweet ) {
			if ( $tw_counter <= $show ) {

			if ( empty( $tweet -> text ) )
				continue;
		
		$tweet_createdat = $tweet -> created_at;
		$tweet_link	= "http://twitter.com/".$tweet -> user -> screen_name."/status/".$tweet -> id_str;
		$tweet_text = $tweet -> text;
		$tweet_text = esc_html( $tweet_text ); // escape here so that Twitter handles in Tweets don't get mangled
		$tweet_text = make_clickable( $tweet_text ); 
		?>
		
		<li>
				<?php echo $tweet_text; ?>
				<a href="<?php echo esc_url($tweet_link); ?>" class="timesince" target="_blank"><?php echo esc_html( str_replace( ' ', '&nbsp;', time_since( strtotime( $tweet_createdat ) ) ) ); ?>&nbsp;ago</a>
		</li>
		<?php
		$tw_counter = $tw_counter + 1;
		}
	}
		
		
		echo '</ul></div>';
		
		// echo widget closing tag
		echo $after_widget;
	}



	// Settings form
	function widget_Twidget_control() {

		// Get options
		$options = get_option('widget_Twidget');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('consumer_key'=>'','consumer_key_secret'=>'','consumer_token'=>'','consumer_token_secret'=>'','account'=>'seanys', 'title'=>'Twitter Updates', 'show'=>'5');

        // form posted?
		if (isset($_POST['Twitter-submit'])) {
		if ( $_POST['Twitter-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['account'] = strip_tags(stripslashes($_POST['Twitter-account']));
			$options['title'] = strip_tags(stripslashes($_POST['Twitter-title']));
			$options['show'] = strip_tags(stripslashes($_POST['Twitter-show']));
			$options['consumer_key'] = strip_tags(stripslashes($_POST['Twitter-consumer-key']));
			$options['consumer_key_secret'] = strip_tags(stripslashes($_POST['Twitter-consumer-secret']));
			$options['consumer_token'] = strip_tags(stripslashes($_POST['Twitter-access-token']));
			$options['consumer_token_secret'] = strip_tags(stripslashes($_POST['Twitter-access-token-secret']));
			update_option('widget_Twidget', $options);
		}
		}

		// Get options for form fields to show
		$account = htmlspecialchars($options['account'], ENT_QUOTES);
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$show = htmlspecialchars($options['show'], ENT_QUOTES);
		$consumer_key = htmlspecialchars($options['consumer_key'], ENT_QUOTES);
		$consumer_key_secret = htmlspecialchars($options['consumer_key_secret'], ENT_QUOTES);
		$consumer_token = htmlspecialchars($options['consumer_token'], ENT_QUOTES);
		$consumer_token_secret = htmlspecialchars($options['consumer_token_secret'], ENT_QUOTES);

		// The form fields
		echo 'You need to create a Twitter plugin to use Juiz Last Tweet Widget because of new API 1.1 rules of Twitter:<br>
		1. Go to the <a href="https://dev.twitter.com/apps/new" target="_blank">Twitter Developer Center</a> to create an app.<br>
		2. Give it a name, description and website, at least, and validate<br>
		3. In the next page, open the "OAuth Tool" tab and find the 4 data points (should look like long strings of random characters) to insert into the fields below.';
		echo '<p style="text-align:right;">
				<label for="Twitter-consumer-key">' . __('Consumer Key:','satori') . '
				<input style="width: 200px;" id="Twitter-consumer-key" name="Twitter-consumer-key" type="text" value="'.$consumer_key.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="Twitter-consumer-secret">' . __('Consumer secret:','satori') . '
				<input style="width: 200px;" id="Twitter-consumer-secret" name="Twitter-consumer-secret" type="text" value="'.$consumer_key_secret.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="Twitter-access-token">' . __('Access token:','satori') . '
				<input style="width: 200px;" id="Twitter-access-token" name="Twitter-access-token" type="text" value="'.$consumer_token.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="Twitter-access-token-secret">' . __('Access token secret:','satori') . '
				<input style="width: 200px;" id="Twitter-access-token-secret" name="Twitter-access-token-secret" type="text" value="'.$consumer_token_secret.'" />
				</label></p>';				
		echo '<p style="text-align:right;">
				<label for="Twitter-account">' . __('Account:','satori') . '
				<input style="width: 200px;" id="Twitter-account" name="Twitter-account" type="text" value="'.$account.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="Twitter-title">' . __('Title:','satori') . '
				<input style="width: 200px;" id="Twitter-title" name="Twitter-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="Twitter-show">' . __('Show:','satori') . '
				<input style="width: 200px;" id="Twitter-show" name="Twitter-show" type="text" value="'.$show.'" />
				</label></p>';
		echo '<input type="hidden" id="Twitter-submit" name="Twitter-submit" value="1" />';
	}
	
	
	
	function twitter_widget_script() {
		if ( ! wp_script_is( 'twitter-widgets', 'registered' ) ) {
			if ( is_ssl() )
				$twitter_widget_js = 'https://platform.twitter.com/widgets.js';
			else
				$twitter_widget_js = 'http://platform.twitter.com/widgets.js';
			wp_register_script( 'twitter-widgets', $twitter_widget_js,  array(), '20111117', true );
			wp_print_scripts( 'twitter-widgets' );
		}
	}
	
	// Register widget for use
	wp_register_sidebar_widget('twitter_widget', 'Twitter Widget', 'widget_Twidget');

	// Register settings for use, 300x200 pixel form
	 wp_register_widget_control('twitter_widget', 'Twitter Widget', 'widget_Twidget_control', 300, 200);
}

// Run code and init
add_action('widgets_init', 'widget_Twidget_init');

?>
