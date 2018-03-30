<?php
/*

Plugin Name: Custom Latest Tweets
Plugin URI: http://www.themezilla.com
Description: A widget that displays your latest tweets
Version: 3.0
Author: Mark Southard - ThemeZilla
Author URI: http://www.themezilla.com
*/

require_once('oauth/twitteroauth.php');

class Zilla_Twitter_Widget extends WP_Widget {

	private $zilla_twitter_oauth = array();

	/* Constructor */
	public function __construct() {
		parent::__construct(
			'zilla-twitter-widget',
			__('Custom Latest Tweets', 'zilla'),
			array(
				'classname' => 'zilla-tweet-widget',
				'description' => __('A new widget that displays your latest tweets', 'zilla')
			)
		);
	} // end constructor

	/**
	 * Output widget content
	 * 
	 * @param array args Array of form elements
	 * @param array instance Current instance of the widget
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		echo $before_widget;

		$title = apply_filters('widget_title', $instance['title'] );
		if ( $title ) { echo $before_title . $title . $after_title; }

		$result = $this->getTweets($instance['username'], $instance['count']);

		echo '<ul>';

		if( $result && is_array($result) ) {
			foreach( $result as $tweet ) {
				$text = $this->linkify($tweet['text']);
				echo '<li>';
					echo $text;
					echo '<a class="twitter-time-stamp" href="http://twitter.com/' . $instance['username'] . '/status/' . $tweet['id'] . '">' . $tweet['timestamp'] . '</a>';
				echo '</li>';
			}
		} else {
			echo '<li>' . __('There was an error grabbing the Twitter feed', 'zilla') . '</li>';
		}

		echo '</ul>';

		if( !empty($instance['tweettext']) ) {
			echo '<a class="twitter-link" href="http://twitter.com/' . $instance['username'] . '">' . $instance['tweettext'] . '</a>';
		}

		echo $after_widget;
	} // end widget

	/**
	 * Process widget's options to be saved
	 *
	 * @param array new_instance New instance of values to be generated via the update
	 * @param array old_instance Previous instance of values before update
	 *
	 * @return array $instance Saved instance values.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['tweettext'] = strip_tags( $new_instance['tweettext'] );

		return $instance;
	} // end update

	/**
	 * Outputs admin form for widget
	 *
	 * @param array $instance Array of keys and values for the widget
	 */
	public function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance
		);

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => 'Latest Tweets',
			'username' => '',
			'count' => '5',
			'tweettext' => 'Follow on Twitter',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$access_token = get_option('ztw_access_token');
		$access_token_secret = get_option('ztw_access_token_secret');
		$consumer_key = get_option('ztw_consumer_key');
		$consumer_key_secret = get_option('ztw_consumer_secret');

		if( empty($access_token) || empty($access_token_secret) || empty($consumer_key) || empty($consumer_key_secret) ) {
			echo '<p><a href="options-general.php?page=zilla-twitter-widget-settings">Configure Twitter Widget</a></p>'; 
		} else {
		
			/* Build our form -----------------------------------------------------------*/
			?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'zilla') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username e.g. themezilla', 'zilla') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of tweets', 'zilla') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" />
				<small><?php _e('Feeds include replies and retweets', 'zilla'); ?></small>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'tweettext' ); ?>"><?php _e('Follow Text e.g. Follow me on Twitter', 'zilla') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tweettext' ); ?>" name="<?php echo $this->get_field_name( 'tweettext' ); ?>" value="<?php echo $instance['tweettext']; ?>" />
			</p>
			
			<p><em><?php _e('Tweets are cached for 5 minutes to improve performance', 'zilla'); ?></em></p>
<?php
		} // end if

	} // end form

	/**
	 * Returns tweets from a transient or calls our private oauth function to get the tweets, parses them,
	 * and sets a transient if needed.
	 * 
	 * @param string $username The username to be used
	 * @param string $count Number of tweets to be returned
	 * @return array of the tweets
	 */
	public function getTweets($username, $count) {
		$config = array();
		$config['username'] = $username;
		$config['count'] = $count;
		$config['access_token'] = get_option('ztw_access_token');
		$config['access_token_secret'] = get_option('ztw_access_token_secret');
		$config['consumer_key'] = get_option('ztw_consumer_key');
		$config['consumer_key_secret'] = get_option('ztw_consumer_secret');

		$transname = 'zilla_tw_' . $username . '_' . $count;

		$result = get_transient( $transname );
		if( !$result ) {
			$result = $this->oauthGetTweets($config);

			if( isset($result['errors']) ){
				$result = NULL; 
			} else {
				$result = $this->parseTweets( $result );
				set_transient( $transname, $result, 300 );
			}
		} else {
			if( is_string($result) )
				unserialize($result);
		}

		return $result;
	}

	/**
	 * Get the tweets feed from Twitter API 1.1
	 *
	 * @param array $config 
	 * @return array $results
	 */
	private function oauthGetTweets($config) {
		if( empty($config['access_token']) ) 
			return array('error' => __('Not properly configured, check settings', 'zilla'));		
		if( empty($config['access_token_secret']) ) 
			return array('error' => __('Not properly configured, check settings', 'zilla'));
		if( empty($config['consumer_key']) ) 
			return array('error' => __('Not properly configured, check settings', 'zilla'));		
		if( empty($config['consumer_key_secret']) ) 
			return array('error' => __('Not properly configured, check settings', 'zilla'));		

		$options = array(
			'trim_user' => true,
			'exclude_replies' => false,
			'include_rts' => true,
			'count' => $config['count'],
			'screen_name' => $config['username']
		);

		$connection = new TwitterOAuth($config['consumer_key'], $config['consumer_key_secret'], $config['access_token'], $config['access_token_secret']);
		$result = $connection->get('statuses/user_timeline', $options);

		return $result;
	}

	/**
	 * Parse the tweets to the needed information
	 *
	 * @param array $results of the tweets to be parsed
	 * @return array parsed tweets with timestamp, text, and id
	 */
	public function parseTweets($results = array()) {
		$tweets = array();
		foreach($results as $result) {
			$temp = explode(' ', $result['created_at']);
			$timestamp = $temp[2] . ' ' . $temp[1] . ' ' . $temp[5];

			$tweets[] = array(
				'timestamp' => $timestamp,
				'text' => filter_var($result['text'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
				'id' => $result['id_str']
			);
		}

		return $tweets;
	}

	/**
	 * Changes text to links
	 *
	 * @param string $text text to be linkified
	 * @return string linkified text 
	 */
	private function zilla_text_links($matches) {
		return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
	}

	/**
	 * Changes text to links
	 *
	 * @param string $text text to be linkified
	 * @return string linkified text 
	 */
	private function zilla_username_link($matches) {
		return '<a href="http://twitter.com/' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
	}
	/**
	 * Changes text to links
	 *
	 * @param string $text text to be linkified
	 * @return string linkified text 
	 */
	public function linkify($text) {
		// convert links
		$string = preg_replace_callback(
			"/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/",
			array(&$this, 'zilla_text_links'),
			$text
		);

		// convert @usernames
		$string = preg_replace_callback(
			'/@([A-Za-z0-9_]{1,15})/', 
			array(&$this, 'zilla_username_link'), 
			$string
		);

		return $string;
	}

} // end Zilla_Twitter_Widget class

add_action( 'widgets_init', create_function( '', 'register_widget("Zilla_Twitter_Widget");' ) );


/**
 * Twitter Widget Settings
 */
function zilla_twitter_widget_settings() {
	add_options_page(
		__('Twitter Widget Settings', 'zilla'),
		__('Twitter Widget Settings', 'zilla'),
		'manage_options',
		'zilla-twitter-widget-settings',
		'zilla_twitter_widget_render_admin_page'
	);
}

add_action( 'admin_menu', 'zilla_twitter_widget_settings' );

/**
 * Create settings for widget
 */
add_action('admin_init', 'zilla_tw_register_settings');

function zilla_tw_settings() {
	$ztw = array();
	$ztw[] = array('label' => 'Twitter Application Consumer Key', 'name' => 'ztw_consumer_key');
	$ztw[] = array('label' => 'Twitter Application Consumer Secret', 'name' => 'ztw_consumer_secret');
	$ztw[] = array('label' => 'Account Access Token', 'name' => 'ztw_access_token');
	$ztw[] = array('label' => 'Account Access Token Secret', 'name' => 'ztw_access_token_secret');

	return $ztw;
}

function zilla_tw_register_settings() {
	$settings = zilla_tw_settings();
	foreach($settings as $setting) {
		register_setting('zilla_tw_settings', $setting['name']);
	}
}

/**
 * Render Twitter widget settings page
 */
function zilla_twitter_widget_render_admin_page() {
	if( ! current_user_can('manage_options') ) {
		wp_die( __('Insufficient permissions', 'zilla') );
	}

	$settings = zilla_tw_settings();

	echo '<div class="wrap">';
	 	screen_icon();
		echo '<h2>Twitter Widget Settings</h2>';
		echo '<form method="post" action="options.php">';
			echo '<p><strong>' . __('Twitter requires that you register an application in order to utilize their API. Directions to get the Consumer Key, Consumer Secret, Access Token, and Access Token Secret.', 'zilla' ) . '</strong></p>';
			echo '<ol>';
				echo '<li><a href="https://dev.twitter.com/apps/new" target="_blank">' . __( 'Create a new Twitter application', 'zilla' ) . '</a></li>';
				echo '<li>' . __( 'Fill in all fields on the create application page.', 'zilla' ) . '</li>';
				echo '<li>' . __( 'Agree to rules, fill out captcha, and submit your application', 'zilla' ) . '</li>';
				echo '<li>' . __( 'Copy the Consumer Key, Consumer Secret, Access Token, and Access Token Secret into the fields below', 'zilla' ) . '</li>';
				echo '<li>' . __( "Click the Save Changes button at the bottom of this page" ) . '</li>';
			echo '</ol>';

			settings_fields('zilla_tw_settings');

			echo '<table>';
				foreach($settings as $setting) {
					echo '<tr>';
						echo '<td>' . $setting['label'] . '</td>';
						echo '<td><input type="text" style="width: 300px;" name="'.$setting['name'].'" value="'.get_option($setting['name']).'" /></td>';
					echo '</tr>';
				}
			echo '</table>';

			submit_button();

		echo '</form>';
	echo '</div>';

}

?>