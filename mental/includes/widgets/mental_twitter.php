<?php
/**
 * Mental Twitter Widget
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/**
 * Class Mental_Widget_Twitter
 */
class Mental_Widget_Twitter extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array( 'classname'   => 'mental-twitter-widget',
		                     'description' => __( "The most recent tweets from tweeter.", 'mental' )
		);
		parent::__construct( 'mental-twitter-widget', __( 'Mentas Twitter Widget', 'mental' ), $widget_ops );
		$this->alt_option_name = 'mental_twitter_widget';
	}

	function widget( $args, $instance )
	{

		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'mental_twitter_widget', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		$title               = empty( $instance['title'] ) ? '' : $instance['title'] ;
		$consumer_key        = empty( $instance['consumer_key'] ) ? '' : $instance['consumer_key'];
		$consumer_secret     = empty( $instance['consumer_secret'] ) ? '' : $instance['consumer_secret'];
		$access_token        = empty( $instance['access_token'] ) ? '' : $instance['access_token'];
		$access_token_secret = empty( $instance['access_token_secret'] ) ? '' : $instance['access_token_secret'];
		$count               = empty( $instance['count'] ) ? '' : $instance['count'];
		$username            = empty( $instance['username'] ) ? '' : $instance['username'];
		$exclude_replies     = empty( $instance['exclude_replies'] ) ? false : true;
		$time                = empty( $instance['time'] ) ? false : true;
		$display_avatar      = empty( $instance['display_avatar'] ) ? false : true;

		ob_start();

		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . "<a href='http://twitter.com/". esc_attr($username) . "/' title='" . esc_attr( strip_tags($title) ) . "'>" . strip_tags($title) . "</a>" . $args['after_title'];
		};

		if ( $username && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count ) {

			$transName = 'list_tweets';
			$cacheTime = 10;

			require_once 'twitteroauth/twitteroauth.php';
			$twitterConnection = new TwitterOAuth( $consumer_key, $consumer_secret, $access_token, $access_token_secret );
			$twitterData       = $twitterConnection->get( 'statuses/user_timeline', array(
				'screen_name'     => $username,
				'count'           => $count,
				'exclude_replies' => $exclude_replies
			) )
			;

			if ( $twitterConnection->http_code != 200 ) {
				$twitterData = get_transient( $transName );
			}

			set_transient( $transName, $twitterData, 60 * 10 );
			$twitter = get_transient( $transName );


			echo '<ul class="wg-popular-posts">';
			if ( $twitter && is_array( $twitter ) ) {
				foreach ( $twitter as $tweet ):

					$latestTweet = $tweet->text;
					$latestTweet = preg_replace( '/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet );
					$latestTweet = preg_replace( '/@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $latestTweet );

					$twitterTime = strtotime( $tweet->created_at );
					$twitterTime = ! empty( $tweet->utc_offset ) ? $twitterTime + ( $tweet->utc_offset ) : $twitterTime;
					$timeAgo     = date_i18n( get_option( 'date_format' ), $twitterTime );

					echo '<li class="tweet' . ( $display_avatar ? 'has-thumbnail' : '' ) . '">';

					if ( $display_avatar ) {
						echo '
                     <figure>
                        <a href="http://twitter.com/' . esc_html($username) . '" title="Test post 7">
                           <img src="' . esc_url($tweet->user->profile_image_url) . '" class="attachment-70x70 wp-post-image" alt="Profile image"></a>
                     </figure>
                  ';
					}

					echo '<div class="body">';

					echo '<p class="">' . wp_kses($latestTweet, mental_allowed_tags()) . '</p>';
					if ( $time ) {
						echo '<p class="wg-info"><time datetime="">' . esc_html($timeAgo) . '</time></p>';
					}
					echo '</div>';

					echo '</li>';

				endforeach;
			} else {
				echo '<li>' . __( 'No public Tweets found', 'mental' ) . '</li>';
			}
			echo "</ul>";
		}

		echo $args['after_widget'];

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'mental_twitter_widget', $cache, 'widget' );
		} else {
			ob_end_flush();
		}

	}

	function form( $instance )
	{
		$instance = wp_parse_args( (array) $instance, array(
			'title'               => __( 'Latest Tweets', 'mental' ),
			'count'               => '3',
			'username'            => 'azelabcom',
			'exclude_replies'     => '1',
			'time'                => '1',
			'display_avatar'      => '0',
			'consumer_key'        => 'zF7846Wy9xNXpBw7fZtS0OOg8',
			'consumer_secret'     => 'jnavJq6JIfg16IIxaDSsAeIQUATopBi5Kppr8lCejJTLnn8Jtl',
			'access_token'        => '201710325-LA0BpGnr35eDO8uZ03lpKtk5KS9wp64sXPkoQyPX',
			'access_token_secret' => 'WgwQYSiMwE0T0zke52m98en8fL2ixuY3QiSKt0OO9dnxn'
		) );

		$title               = empty( $instance['title'] ) ? '' : strip_tags( $instance['title'] );
		$consumer_key        = empty( $instance['consumer_key'] ) ? '' : strip_tags( $instance['consumer_key'] );
		$consumer_secret     = empty( $instance['consumer_secret'] ) ? '' : strip_tags( $instance['consumer_secret'] );
		$access_token        = empty( $instance['access_token'] ) ? '' : strip_tags( $instance['access_token'] );
		$access_token_secret = empty( $instance['access_token_secret'] ) ? '' : strip_tags( $instance['access_token_secret'] );
		$count               = empty( $instance['count'] ) ? '' : strip_tags( $instance['count'] );
		$username            = empty( $instance['username'] ) ? '' : strip_tags( $instance['username'] );
		$exclude_replies     = empty( $instance['exclude_replies'] ) ? 0 : 1;
		$time                = empty( $instance['time'] ) ? 0 : 1;
		$display_avatar      = empty( $instance['display_avatar'] ) ? 0 : 1;?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'mental' ); ?>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
				       name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"
				       type="text" value="<?php echo esc_attr( $title ); ?>"/>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'consumer_key' )); ?>"><?php _e( 'API Key:', 'mental' ); ?>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'consumer_key' )); ?>"
				       name="<?php echo esc_attr($this->get_field_name( 'consumer_key' )); ?>"
				       type="text" value="<?php echo esc_attr( $consumer_key ); ?>"/>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'consumer_secret' )); ?>"><?php _e( 'API Secret:', 'mental' ); ?>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'consumer_secret' )); ?>"
				       name="<?php echo esc_attr($this->get_field_name( 'consumer_secret' )); ?>"
				       type="text" value="<?php echo esc_attr( $consumer_secret ); ?>"/>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'access_token' )); ?>"><?php _e( 'Access Token:', 'mental' ); ?>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'access_token' )); ?>"
				       name="<?php echo esc_attr($this->get_field_name( 'access_token' )); ?>"
				       type="text" value="<?php echo esc_attr( $access_token ); ?>"/>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'access_token_secret' )); ?>"><?php _e( 'Access Token Secret:', 'mental' ); ?>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'access_token_secret' )); ?>"
				       name="<?php echo esc_attr($this->get_field_name( 'access_token_secret' )); ?>"
				       type="text" value="<?php echo esc_attr( $access_token_secret ); ?>"/>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'username' )); ?>"><?php _e( 'Enter your twitter username:', 'mental' ); ?>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'username' )); ?>"
				       name="<?php echo esc_attr($this->get_field_name( 'username' )); ?>"
				       type="text" value="<?php echo esc_attr( $username ); ?>"/>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php _e( 'How many entries do you want to show:', 'mental' ); ?>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"
				        name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>">
					<?php for ( $i = 1; $i <= 20; $i ++ ):
						$selected = ( $count == $i ) ? "selected='selected'" : "";?>
						<option <?php echo( $selected ); ?> value="<?php echo( $i ); ?>"><?php echo( $i ); ?></option>
					<?php endfor; ?>
				</select>
			</label>
		</p>
		<p>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'exclude_replies' )); ?>"
		          name="<?php echo esc_attr($this->get_field_name( 'exclude_replies' )); ?>"
				<?php checked( $exclude_replies ); ?> />
			<label for="<?php echo esc_attr($this->get_field_id( 'exclude_replies' )); ?>"><?php _e( 'Exclude @replies', 'mental' ); ?></label>
		</p>
		<p>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'time' )); ?>"
		          name="<?php echo esc_attr($this->get_field_name( 'time' )); ?>"
				<?php checked( $time ); ?> />
			<label for="<?php echo esc_attr($this->get_field_id( 'time' )); ?>"><?php _e( 'Show time of tweet', 'mental' ); ?></label>
		</p>
		<p>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'time' )); ?>"
		          name="<?php echo esc_attr($this->get_field_name( 'display_avatar' )); ?>"
				<?php checked( $display_avatar ); ?> />
			<label for="<?php echo esc_attr($this->get_field_id( 'display_avatar' )); ?>"><?php _e( 'Show user avatar', 'mental' ); ?></label>
		</p>
	<?php
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		$instance['title']               = strip_tags( $new_instance['title'] );
		$instance['consumer_key']        = strip_tags( $new_instance['consumer_key'] );
		$instance['consumer_secret']     = strip_tags( $new_instance['consumer_secret'] );
		$instance['access_token']        = strip_tags( $new_instance['access_token'] );
		$instance['access_token_secret'] = strip_tags( $new_instance['access_token_secret'] );
		$instance['count']               = strip_tags( $new_instance['count'] );
		$instance['username']            = strip_tags( $new_instance['username'] );
		$instance['exclude_replies']     = empty( $new_instance['exclude_replies'] ) ? 0 : 1;
		$instance['time']                = empty( $new_instance['time'] ) ? 0 : 1;
		$instance['display_avatar']      = empty( $new_instance['display_avatar'] ) ? 0 : 1;

		return $instance;
	}

}

// Init Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Mental_Widget_Twitter" );' ) );
