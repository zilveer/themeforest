<?php 
/*
 * OAuth and wp_TwitterOAuth libraries taken from Rotating Tweets (Twitter widget & shortcode) plugin, v1.3.13, http://wordpress.org/extend/plugins/rotatingtweets/
 */
if ( !class_exists( 'wp_TwitterOAuth' ) ) get_template_part( 'panel/libraries/wp_twitteroauth' );

if ( !class_exists( 'CI_Tweets' ) ):
class CI_Tweets extends WP_Widget {

	function __construct() {
		$widget_ops  = array( 'description' => __( 'Display your latest tweets', 'ci_theme' ) );
		$control_ops = array( /*'width' => 200, 'height' => 400*/ );
		parent::__construct( 'ci_twitter_widget', $name = __( '-= CI Tweets =-', 'ci_theme' ), $widget_ops, $control_ops );
	}


	// display in frontend
	function widget( $args, $instance ) {

		extract($args);
		$ci_title = apply_filters( 'widget_title', empty( $instance['ci_title'] ) ? '' : $instance['ci_title'], $instance, $this->id_base );
		$ci_title = ci_get_string_translation('Twitter - Title', $ci_title, 'Widgets');

		$ci_username  = $instance['ci_username'];
		$ci_number    = $instance['ci_number'];
		$callback     = str_replace( 'ci_twitter_widget-', '', $args['widget_id'] );
		$widget_class = preg_replace( '/[^a-zA-Z0-9]/', '', $args['widget_id'] );

		if( ci_setting('twitter_consumer_key') == '' ) return;
		if( ci_setting('twitter_consumer_secret') == '' ) return;
		if( ci_setting('twitter_access_token') == '' ) return;
		if( ci_setting('twitter_access_token_secret') == '' ) return;

		$connection = new wp_TwitterOAuth(
			trim( ci_setting( 'twitter_consumer_key' ) ),
			trim( ci_setting( 'twitter_consumer_secret' ) ),
			trim( ci_setting( 'twitter_access_token' ) ),
			trim( ci_setting( 'twitter_access_token_secret' ) )
		);

		$trans_name = sanitize_key( 'ci_widget_tweets_' . $ci_username . '_' . $ci_number );

		if ( false === ( $result = get_transient( $trans_name ) ) ) {
			$result = $connection->get( 'statuses/user_timeline', array(
				'screen_name' => $ci_username,
				'count'       => $ci_number,
				'include_rts' => 1
			) );

			$trans_time = ci_setting( 'twitter_caching_seconds' );
			if ( intval( $trans_time ) < 5 ) {
				$trans_time = 5;
			}
			set_transient( $trans_name, $result, $trans_time );
		}

		if ( is_wp_error( $result ) ) {
			return;
		}

		$data = json_decode( $result['body'], true );

		if ( $data === null ) {
			return;
		}

		echo $before_widget;

		if ( $ci_title ) {
			echo $before_title . $ci_title . $after_title;
		}

		echo '<div class="' . esc_attr( $widget_class ) . '  tul"><ul>';

		if ( ! empty( $data['errors'] ) && count( $data['errors'] ) > 0 ) {
			foreach ( $data['errors'] as $error ) {
				/* translators: %1$s is the error number, %2$s is the error message. */
				echo '<li>' . sprintf( __( 'Error %1$s: %2$s', 'ci_theme' ), $error['code'], $error['message'] ) . '</li>';
			}
		} else {
			foreach ( $data as $tweet ) {
				// URL regex taken from http://daringfireball.net/2010/07/improved_regex_for_matching_urls
				// Needed to wrap with # and escape the single quote character near the end, in order to work right.
				$url_regex = '#(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))#';

				$tweet_username = $tweet['user']['screen_name'];
				$tweet_text     = $tweet['text'];
				$tweet_text     = preg_replace_callback( $url_regex, array( $this, '_link_urls' ), $tweet_text );
				$tweet_text     = preg_replace_callback( '/\B@([_a-z0-9]+)/i', array( $this, '_link_usernames' ), $tweet_text );
				$tweet_time     = ci_human_time_diff( strtotime( $tweet['created_at'] ) );
				$tweet_id       = $tweet['id_str'];

				echo '<li><span>' . $tweet_text . '</span> <a class="twitter-time" href="https://twitter.com/' . esc_attr( $tweet_username ) . '/statuses/' . esc_attr( $tweet_id ) . '">' . $tweet_time . '</a></li>';
			}
		}

		echo '</ul></div>';
		
		echo $after_widget;
	}


	function _link_usernames( $matches ) {
		/* E.g.
		 * $matches[0] = '@cssigniter'
		 * $matches[1] = 'cssigniter'
		 */
		return '<a href="https://twitter.com/' . esc_attr( $matches[1] ) .'">' . $matches[0] . '</a>';
	}


	function _link_urls( $matches ) {
		return '<a href="' . esc_url( $matches[0] ) . '">' . $matches[0] . '</a>';
	}
	

	// update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['ci_title']    = sanitize_text_field( $new_instance['ci_title'] );
		$instance['ci_username'] = sanitize_text_field( $new_instance['ci_username'] );
		$instance['ci_number']   = absint( $new_instance['ci_number'] );

		$instance['ci_title'] = ci_register_string_translation( 'Twitter - Title', $instance['ci_title'], 'Widgets' );

		return $instance;
	}
	

	// widget form
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'ci_title'    => '',
			'ci_username' => '',
			'ci_number'   => ''
		) );

		if ( ci_setting( 'twitter_consumer_key' ) == '' or
			ci_setting( 'twitter_consumer_secret' ) == '' or
			ci_setting( 'twitter_access_token' ) == '' or
			ci_setting( 'twitter_access_token_secret' ) == ''
		) {
			echo '<p>' . __( "It looks like you haven't provided Twitter access details, in order for this widget to work. Unfortunately, this is needed. Please visit the theme's settings page and provide the required access details.", 'ci_theme' ) . '</p>';
		} else {
			$ci_title    = $instance['ci_title'];
			$ci_username = $instance['ci_username'];
			$ci_number   = $instance['ci_number'];
			echo '<p><label for="' . esc_attr( $this->get_field_id( 'ci_title' ) ) . '">' . __( 'Title:', 'ci_theme' ) . '</label><input id="' . esc_attr( $this->get_field_id( 'ci_title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_title' ) ) . '" type="text" value="' . esc_attr( $ci_title ) . '" class="widefat" /></p>';
			echo '<p><label for="' . esc_attr( $this->get_field_id( 'ci_username' ) ) . '">' . __( 'Username:', 'ci_theme' ) . '</label><input id="' . esc_attr( $this->get_field_id( 'ci_username' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_username' ) ) . '" type="text" value="' . esc_attr( $ci_username ) . '" class="widefat" /></p>';
			echo '<p><label for="' . esc_attr( $this->get_field_id( 'ci_number' ) ) . '">' . __( 'Number of tweets:', 'ci_theme' ) . '</label><input id="' . esc_attr( $this->get_field_id( 'ci_number' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_number' ) ) . '" type="text" value="' . esc_attr( $ci_number ) . '" class="widefat" /></p>';
		}
	
	} // form

} // class


// Check that the Twitter widget can be loaded.
// Support is added automatically upon the inclusion of the twitter_api panel snippet.
if ( get_ci_theme_support( 'twitter_widget' ) ) {
	register_widget( 'CI_Tweets' );
}

endif; // !class_exists
