<?php if(! defined('ABSPATH')){ return; }

// widget function
class tp_widget_recent_tweets extends WP_Widget
{

	public function __construct()
	{
		parent::__construct( 'tp_widget_recent_tweets', // Base ID
			__( '[ Kallyas ] Twitter Widget', 'zn_framework' ), // Name
			array ( 'description' => __( 'Display recent tweets', 'zn_framework' ), ) // Args
		);

		add_action('wp_enqueue_scripts', array($this, 'loadCarouFredSel'));
	}

	public function loadCarouFredSel(){
		if(wp_script_is('caroufredsel', 'registered')) {
			wp_enqueue_script( 'caroufredsel' );
		}
		else {
			wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
		}
	}

	//widget output
	public function widget( $args, $instance )
	{

		// Check if Curl is installed on the server and show an error message if it is not
		if( ! function_exists('curl_init') ){
			echo __('It seems that the curl is not activated on your hosting. This widget requires this function in order to work. Please contact your server administrator and ask them to enable curl for your account.', 'zn_framework');
			return;
		}

		$before_widget = $before_title = $after_title =  $after_widget = '';

		extract( $args );
		if ( ! empty( $instance['title'] ) ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
		}

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		// Use twitter helper class to get tweets
		$tp_twitter_plugin_tweets = Zn_Twitter_Helper::get_tweets( $instance );

		if( is_wp_error( $tp_twitter_plugin_tweets ) ){
			echo $tp_twitter_plugin_tweets->get_error_message();
			echo $after_widget;
			return;
		}

		if( is_array( $tp_twitter_plugin_tweets ) ){

				ZN()->add_inline_js( array ( 'twitter_script' => Zn_Twitter_Helper::get_twitter_script()) );

				echo   '<div class="twitter-feed">';
				$numTweets = intval($instance['tweetstoshow']);
				if(empty($numTweets)){
					$numTweets = 1;
				}
				echo '<div class="twitterFeed-wrapper twitter-feed-wrapper">';
					echo   '<div class="tweets twitterFeed twitter-feed-tweets" id="twitterFeed" data-entries="'.$numTweets.'">';
					$fctr = '1';
					if ( is_array( $tp_twitter_plugin_tweets ) ) {
						foreach ( $tp_twitter_plugin_tweets as $tweet ) {
							echo '<div class="kl-tweet twitter-feed-tweet">
									<a class="twTime twitter-feed-tweet-time" target="_blank" href="//twitter.com/' . $instance['username'] .
								 '/statuses/' . $tweet['status_id'] . '"><span>' . Zn_Twitter_Helper::relative_time($tweet['created_at'] ) .
								 '</span></a>' . Zn_Twitter_Helper::convert_links( $tweet['text'] ) . '</div>';
							if ( $fctr == $numTweets ) {
								break;
							}
							$fctr ++;
						}
					}

					echo '</div>';
				echo '</div>'; //.twitterFeed-wrapper

				echo '<a href="https://twitter.com/' . $instance['username'] .
					 '" class="twitter-follow-button" data-show-count="false">' . __( 'Follow', 'zn_framework' ) . ' @' .
					 $instance['username'] . '</a>';
				echo '</div><!-- end twitter-feed -->';
			}
			echo $after_widget;
		}

	//save widget settings
	public function update( $new_instance, $old_instance )
	{
		$instance = array (
			'title' => (isset($new_instance['title']) ? strip_tags( $new_instance['title'] ) : ''),
			'consumerkey' => (isset($new_instance['consumerkey']) ? strip_tags( $new_instance['consumerkey'] ) : ''),
			'consumersecret' => (isset($new_instance['consumersecret']) ? strip_tags($new_instance['consumersecret'] ) : ''),
			'accesstoken' => (isset($new_instance['accesstoken']) ? strip_tags( $new_instance['accesstoken'] ) : ''),
			'accesstokensecret' => (isset($new_instance['accesstokensecret']) ? strip_tags($new_instance['accesstokensecret'] ) : ''),
			'cachetime' => (isset($new_instance['cachetime']) ? strip_tags( $new_instance['cachetime'] ) : ''),
			'username' => (isset($new_instance['username']) ? strip_tags( $new_instance['username'] ) : ''),
			'tweetstoshow' => (isset($new_instance['tweetstoshow']) ? strip_tags( $new_instance['tweetstoshow'] ) : ''),
		);
		if (isset($old_instance['username']) && $old_instance['username'] != $new_instance['username'] ) {
			delete_option( 'tp_twitter_plugin_last_cache_time' );
		}

		return $instance;
	}

	//widget settings form
	public function form( $instance )
	{
		$defaults = array ( 'title'             => '',
							'consumerkey'       => '',
							'consumersecret'    => '',
							'accesstoken'       => '',
							'accesstokensecret' => '',
							'cachetime'         => '',
							'username'          => '',
							'tweetstoshow'      => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		echo '
			<p><label>' . __( 'Title:', 'zn_framework' ) . '</label>
				<input type="text" name="' . $this->get_field_name( 'title' ) . '" id="' . $this->get_field_id( 'title' ) . '" value="' . esc_attr( $instance['title'] ) . '" class="widefat" /></p>
			<p><label>' . __( 'Consumer Key:', 'zn_framework' ) . '</label>
				<input type="text" name="' . $this->get_field_name( 'consumerkey' ) . '" id="' . $this->get_field_id( 'consumerkey' ) . '" value="' . esc_attr( $instance['consumerkey'] ) . '" class="widefat" /></p>
			<p><label>' . __( 'Consumer Secret:', 'zn_framework' ) . '</label>
				<input type="text" name="' . $this->get_field_name( 'consumersecret' ) . '" id="' . $this->get_field_id( 'consumersecret' ) . '" value="' . esc_attr( $instance['consumersecret'] ) . '" class="widefat" /></p>
			<p><label>' . __( 'Access Token:', 'zn_framework' ) . '</label>
				<input type="text" name="' . $this->get_field_name( 'accesstoken' ) . '" id="' . $this->get_field_id( 'accesstoken' ) . '" value="' . esc_attr( $instance['accesstoken'] ) . '" class="widefat" /></p>
			<p><label>' . __( 'Access Token Secret:', 'zn_framework' ) . '</label>
				<input type="text" name="' . $this->get_field_name( 'accesstokensecret' ) . '" id="' . $this->get_field_id( 'accesstokensecret' ) . '" value="' . esc_attr( $instance['accesstokensecret'] ) . '" class="widefat" /></p>
			<p><label>' . __( 'Cache Tweets in every:', 'zn_framework' ) . '</label>
				<input type="text" name="' . $this->get_field_name( 'cachetime' ) . '" id="' . $this->get_field_id( 'cachetime' ) . '" value="' . esc_attr( $instance['cachetime'] ) . '" class="small-text" /> hours</p>
			<p><label>' . __( 'Twitter Username:', 'zn_framework' ) . '</label>
				<input type="text" name="' . $this->get_field_name( 'username' ) . '" id="' . $this->get_field_id( 'username' ) . '" value="' . esc_attr( $instance['username'] ) . '" class="widefat" /></p>
			<p><label>' . __( 'Tweets to display:', 'zn_framework' ) . '</label>
				<select type="text" name="' . $this->get_field_name( 'tweetstoshow' ) . '" id="' . $this->get_field_id( 'tweetstoshow' ) . '">';

		$num = intval($instance['tweetstoshow']);
		for ( $i = 1; $i <= 10; $i ++ ) {
			echo '<option value="' . $i . '"' . selected($num, $i) . '>' . $i . '</option>';
		}
		echo '</select></p>';
	}
}


// register	widget
function register_tp_twitter_widget() {
	register_widget( 'tp_widget_recent_tweets' );
}
add_action( 'widgets_init', 'register_tp_twitter_widget' );
