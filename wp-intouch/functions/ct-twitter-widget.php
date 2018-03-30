<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Twitter Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that displays messages from twitter.com
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/

// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'ct_twitter_widget' );

// Register widget
function ct_twitter_widget() {
	register_widget( 'CT_Twitter_Widget' );
}

// Widget class
class CT_Twitter_Widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function CT_Twitter_Widget() {

		/* Widget settings. */
		$widget_ops = array(	'classname'		=> 'ct-twitter-widget',
								'description'	=> __( 'Twitter Widget' , 'color-theme-framework' )
							);

		/* Widget control settings. */
		$control_ops = array(	'width' =>		255,
								'height' =>		350,
								'id_base' =>	'ct-twitter-widget'
							);
		
		/* Create the widget. */
		parent::__construct('ct-twitter-widget', __( 'CT: Twitter Widget' , 'color-theme-framework' ) , $widget_ops, $control_ops );
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$background_title = $instance['background_title'];
	$username = $instance['username'];
	$exclude_replies = isset($instance['exclude_replies']) ? 'true' : 'false';
	$show_avatar = isset($instance['show_avatar']) ? '1' : '0';

	global $ct_options;

	$consumer_key = $ct_options['ct_consumer_key'];
	$consumer_secret = $ct_options['ct_consumer_secret'];
	$user_token = $ct_options['ct_user_token'];
	$user_secret = $ct_options['ct_user_secret'];

	/* Before widget (defined by themes). */
	echo "\n<!-- START TWITTER WIDGET -->\n";
	echo $before_widget;

	/* Display the widget title if one was input (before and after defined by themes). */
	if ( $title ) :
		echo '<h3 class="widget-title" style="background:'.$background_title.';"><a target="_blank" title="'.__('Visit our Twitter Feed','color-theme-framework').'" href="http://www.twitter.com/'.$username.'">'.$title.'</a><span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
	endif;


	//check settings and die if not set
	if(empty($consumer_key) || empty($consumer_secret) || empty($user_token) || empty($user_secret) || empty($instance['cachetime']) || empty($instance['username'])){
		echo '<span class="tweet_info">' . __('Please fill all widget settings and Twitter Settings (menu Appearance -> Theme Options -> Twitter settings)','color-theme-framework') . '</span>' . $after_widget;
		return;
	}

	//check if cache needs update
	$ct_twitter_last_cache_time = get_option('ct_twitter_last_cache_time'.$username);
	$diff = time() - $ct_twitter_last_cache_time;
	$crt = $instance['cachetime'] * 60;

	// yes, it needs update
	if($diff >= $crt || empty($ct_twitter_last_cache_time)){

		if(!require_once('twitteroauth.php')){ 
			echo '<strong>Couldn\'t find twitteroauth.php!</strong>' . $after_widget;
			return;
		}

		$connection = ct_getConnectionWithAccessToken($consumer_key, $consumer_secret, $user_token, $user_secret);
		$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$username."&count=10&exclude_replies=".$exclude_replies) or die('Couldn\'t retrieve tweets! Wrong username?');

		if(!empty($tweets->errors)){
			if($tweets->errors[0]->message == 'Invalid or expired token'){
				echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
			}else{
				echo '<strong>'.$tweets->errors[0]->message.'</strong>' . $after_widget;
			}
			return;
		}

		for($i = 0;$i <= count($tweets); $i++){
			if(!empty($tweets[$i])){
				$tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
				$tweets_array[$i]['text'] = $tweets[$i]->text;
				$tweets_array[$i]['status_id'] = $tweets[$i]->id_str;
				$tweets_array[$i]['user'] = $tweets[$i]->user;
			}
		}

		$tweets_array_serial = serialize($tweets_array);
		$tweets_array_serial = utf8_encode($tweets_array_serial);

		//save tweets to wp option
		update_option('tp_twitter_plugin_tweets'.$username, $tweets_array_serial);
		update_option('ct_twitter_last_cache_time'.$username, time());

		echo '<!-- twitter cache has been updated! -->';
	}

	$tp_twitter_plugin_tweets = maybe_unserialize( utf8_decode ( get_option( 'tp_twitter_plugin_tweets'.$username ) ) );

	if(!empty($tp_twitter_plugin_tweets)) {
		echo "\n".'<ul>';
		$fctr = '1';
		foreach($tp_twitter_plugin_tweets as $tweet) {
			print '<li class="clearfix">';

			if ( $show_avatar ) :
				echo '<div class="twitter-logo"><a target="_blank" href="https://twitter.com/' . $username .'"><img src="'.$tweet['user']->profile_image_url.'" alt="" /></a></div><!-- .twitter-logo -->';
			else :
				echo '<div class="twitter-logo"><a target="_blank" href="https://twitter.com/' . $username .'"><i class="icon-twitter"></i></a></div><!-- .twitter-logo -->';
			endif;
			print '<div class="tweet-content"><span class="tweet-time ct-google-font"><a target="_blank" href="http://twitter.com/'.$username.'/statuses/'.$tweet['status_id'].'">'.ct_relative_time($tweet['created_at']).'</a></span><span class="tweet-text">'.ct_convert_links($tweet['text']).'</span></div></li>';
			if($fctr == $instance['tweetstoshow']){ break; }
			$fctr++;
		}
		echo "</ul>\n";
	} ?>

	<?php 
	// After widget (defined by theme functions file)
	echo $after_widget;
	echo "\n<!-- END TWITTER WIDGET -->\n";
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['cachetime'] = strip_tags( $new_instance['cachetime'] );
	$instance['username'] = strip_tags( $new_instance['username'] );
	$instance['tweetstoshow'] = strip_tags( $new_instance['tweetstoshow'] );
	$instance['exclude_replies'] = $new_instance['exclude_replies'];
	$instance['show_avatar'] = $new_instance['show_avatar'];
	$instance['background_title'] = strip_tags($new_instance['background_title']);	

	if($old_instance['username'] != $new_instance['username']){
		delete_option('ct_twitter_last_cache_time'.$username);
	}
				
	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(	'title'					=> __( 'Recent Tweets' , 'color-theme-framework' ),
						'username'				=> 'envato',
						'cachetime'				=> '60',
						'tweetstoshow'			=> '3',
						'exclude_replies'		=>	'on',
						'show_avatar'			=>	'off',
						'background_title'		=> '#00aced'
					);
	
	$instance = wp_parse_args((array) $instance, $defaults);
	$background_title = $instance['background_title'];
	?>

	<script type="text/javascript">
	//<![CDATA[
		jQuery(document).ready(function($) {
			$('.ct-color-picker').wpColorPicker();
		});
	//]]>
	</script>	

	<p style=" background: #fff2bf; padding: 7px; border: 1px solid #c0c0c0; font-size: 11px; ">
		<?php _e('Attention! Be sure that you filled the Twitter Settings (menu Appearance -> Theme Options -> Twitter settings)','color-theme-framework'); ?>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'color-theme-framework' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Twitter Username:' , 'color-theme-framework'); ?></label>
		<input type="text" style=" width: 96%; " class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['username'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked($instance['show_avatar'], 'on'); ?> id="<?php echo $this->get_field_id('show_avatar'); ?>" name="<?php echo $this->get_field_name('show_avatar'); ?>" /> 
		<label for="<?php echo $this->get_field_id('show_avatar'); ?>"><?php _e( 'Show profile photo:' , 'color-theme-framework' ); ?></label>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'tweetstoshow' ); ?>"><?php _e( 'Tweets to display (from 1 to 10):' , 'color-theme-framework' ); ?></label>
		<input type="number" min="1" max="10" class="widefat" id="<?php echo $this->get_field_id( 'tweetstoshow' ); ?>" name="<?php echo $this->get_field_name( 'tweetstoshow' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['tweetstoshow'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked($instance['exclude_replies'], 'on'); ?> id="<?php echo $this->get_field_id('exclude_replies'); ?>" name="<?php echo $this->get_field_name('exclude_replies'); ?>" /> 
		<label for="<?php echo $this->get_field_id('exclude_replies'); ?>"><?php _e( 'Exclude replies:' , 'color-theme-framework' ); ?></label>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'cachetime' ); ?>"><?php _e( 'Cache Tweets time (minutes):' , 'color-theme-framework' ); ?></label>
		<input type="number" min="1" max="1440" class="widefat" id="<?php echo $this->get_field_id( 'cachetime' ); ?>" name="<?php echo $this->get_field_name( 'cachetime' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['cachetime'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Title Background color:', 'color-theme-framework'); ?></label> 
		<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" data-default-color="#00aced" />
	</p>
	<?php
	}
}
?>