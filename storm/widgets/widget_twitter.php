<?php
/**
 * Plugin Name: BK-Ninja: Twitter Widget
 * Plugin URI: http://bk-ninja.com/
 * Description: This widget displays the twitter widget with the stream in the sidebar.
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://bk-ninja.com/
 *
 */

require_once dirname(__FILE__) . '/lib/twitteroauth.php';


function bk_register_tw_widget() {
	register_widget('bk_Twitter');
}

add_action('widgets_init', 'bk_register_tw_widget');

class bk_Twitter extends WP_Widget {
	private $connection;

	private $consumer_key;
	private $consumer_secret;
	private $access_token;
	private $access_token_secret;
    
    private $uid;

	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-twitter', 'description' => __('[Sidebar widget] Displays latest tweets in sidebar',"bkninja") );


		/* Create the widget. */
		parent::__construct( 'bk-twitter', __('*BK: Widget Twitter', 'bkninja'), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
        global $bk_flex_el;
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$show_count = $instance['show_count'];
		$hide_timestamp = isset( $instance['hide_timestamp'] ) ? $instance['hide_timestamp'] : false;
		$linked = $instance['hide_url'] ? false : '#';

		$this->consumer_key = isset( $instance['consumer_key'] ) ? $instance['consumer_key'] : '';
		$this->consumer_secret = isset( $instance['consumer_secret'] ) ? $instance['consumer_secret'] : '';
		$this->access_token = isset( $instance['access_token'] ) ? $instance['access_token'] : '';
		$this->access_token_secret = isset( $instance['access_token_secret'] ) ? $instance['access_token_secret'] : '';

        $this->uid = uniqid('twitter-slider-');
        
        $bk_flex_el['twitter_slider'][$this->uid] = null;
        wp_localize_script( 'customjs', 'bk_flex_id', $bk_flex_el );

		echo $before_widget;

		if ( $title )
			echo $before_title .'<i class="fa fa-twitter"></i>'. $title. $after_title;

		if ($this->pre_validate_keys() === true) {
			$this->messages($username, $show_count, true, !$hide_timestamp, $linked);
		} else {
			echo '<p>Twitter Widget not configured</p>';
		}

		echo '<div class="clear"></div>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = $new_instance['username'];
		$instance['show_count'] = $new_instance['show_count'];
		$instance['hide_timestamp'] = $new_instance['hide_timestamp'];
		$instance['hide_url'] = $new_instance['hide_url'];
		$instance['consumer_key'] = $new_instance['consumer_key'];
		$instance['consumer_secret'] = $new_instance['consumer_secret'];
		$instance['access_token'] = $new_instance['access_token'];
		$instance['access_token_secret'] = $new_instance['access_token_secret'];

		delete_transient( 'bk_' . $new_instance['username'] );


		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Latest Tweets', 'username' => '', 'show_count' => 5, 'hide_timestamp' => false, 'hide_url' => false,
						   'consumer_key' => 'ET2rmjomH2qyy9qqTdxe3J7da', 'consumer_secret' => 'lFyZQXEkbvH97zbLrhZyObM5iD6uQbKGNWMX7o4u34JMHuKxj5', 
                           'access_token' => '2351267310-bUr3mIQX1aewijKiolYLpi59ZSyydbxlx7zbT8M', 'access_token_secret' => 'Rp88CSRezfH7v1xjCLKfLyk3Mf9aHjsMUP95FhdiOuBsn' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e('Title: ', 'bkninja'); ?></strong></label><br />
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><strong><?php _e('Twitter Username', 'bkninja'); ?></strong></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>"   />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'show_count' ); ?>"><?php _e('Show', 'bkninja'); ?></label>
		<input  type="text" id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" value="<?php echo $instance['show_count']; ?>" size="3" /><?php _e(' tweets', 'bkninja'); ?>
		</p>

		<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['hide_timestamp'], 'on' ); ?> id="<?php echo $this->get_field_id( 'hide_timestamp' ); ?>" name="<?php echo $this->get_field_name( 'hide_timestamp' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'hide_timestamp' ); ?>"><?php _e('Hide Timestamp', 'bkninja'); ?></label>
		</p>

		<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['hide_url'], 'on' ); ?> id="<?php echo $this->get_field_id( 'hide_url' ); ?>" name="<?php echo $this->get_field_name( 'hide_url' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'hide_url' ); ?>"><?php _e('Hide Tweet URL', 'bkninja'); ?></label>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"><strong><?php _e('Consumer key', 'bkninja'); ?></strong></label><br />
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" value="<?php echo $instance['consumer_key']; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"><strong><?php _e('Consumer secret', 'bkninja'); ?></strong></label><br />
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" value="<?php echo $instance['consumer_secret']; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'access_token' ); ?>"><strong><?php _e('Access token', 'bkninja'); ?></strong></label><br />
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" value="<?php echo $instance['access_token']; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'access_token_secret' ); ?>"><strong><?php _e('Access token secret', 'bkninja'); ?></strong></label><br />
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'access_token_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_token_secret' ); ?>" value="<?php echo $instance['access_token_secret']; ?>" />
		</p>

		<?php
	}

	function messages($username = '', $num = 1, $slider = false, $update = true, $linked  = '#') {
		$messages = get_transient( 'bk_' . $username );
		if ($messages === false) {
			$this->connection = new TwitterOAuth( $this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_token_secret );
			$this->connection->get('account/verify_credentials');

			if ( $this->connection->http_code !== 200 ) {
				echo "Can't query Twitter API. Wrong API credentials or Twitter API Limit exceeded.";
				set_transient( 'bk_' . $username, array(), 360 );
				return;
			}

			$params = array(
				'screen_name' => $username,
				'count' => $num,
				'trim_user' => true,
				'contributor_details' => false,
				'include_entities' => false
			);
			$messages = $this->connection->get( 'statuses/user_timeline', $params );

			set_transient( 'bk_' . $username, $messages, 360 );
		}

		if ($slider) echo '<div id="'.$this->uid.'" class="flex-slider"><ul class="twitter-list slides">';

		if ($username == '' || ( $this->connection && $this->connection->http_code == 404) ) {
			if ($slider) echo '<li>';
			echo 'Widget not configured or user does not exist.';
			if ($slider) echo '</li>';
		} else {
			if ( !$messages ) {
				if ($slider) echo '<li>';
				echo 'No Twitter messages.';
				if ($slider) echo '</li>';
			} else {
				$i = 0;
				foreach ( $messages as $message ) {
					$msg = $message->text;
					$link = 'http://twitter.com/'. $username .'/status/'. $message->id_str;

					if ($slider) echo '<li class="twitter-item">'; elseif ($num != 1) echo '<p class="twitter-message">';

					$msg = $this->hyperlinks($msg);
					$msg = $this->twitter_users($msg);

					echo $msg;

					if($update) {
						$time = strtotime($message->created_at);

						if ( ( abs( time() - $time) ) < 86400 )
							$h_time = sprintf( __('%s ago', 'bkninja'), human_time_diff( $time ) );
						else
							$h_time = date('M j, Y', $time);

						if ($linked != '' | $linked != false) {
							echo sprintf( __('%s', 'bkninja'),' <div class="clear"></div><a href="'.$link.'" class="twitter-link twitter-timestamp">' . $h_time . '</a>' );
						} else {
							echo sprintf( __('%s', 'bkninja'),' <div class="clear"></div><em class="twitter-timestamp">' . $h_time . '</em>' );
						}
					}

					if ($slider) echo '</li>'; elseif ($num != 1) echo '</p>';

					$i++;
					if ( $i >= $num ) break;
				}
			}
		}
		if ($slider) echo '</ul></div>';
	}

	function hyperlinks($text) {
		$text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
		$text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
		$text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
		$text = preg_replace('/([\.|\,|\:|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
		return $text;
	}

	function twitter_users($text) {
		$text = preg_replace('/([\.|\,|\:|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
		return $text;
	}

	function pre_validate_keys() {
		if ( ! $this->consumer_key        ) return false;
		if ( ! $this->consumer_secret     ) return false;
		if ( ! $this->access_token        ) return false;
		if ( ! $this->access_token_secret ) return false;

		return true;
	}
}
