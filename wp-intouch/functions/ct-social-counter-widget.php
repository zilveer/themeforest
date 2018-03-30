<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Social Counter Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show counters for facebook/twitter/youtube/rss.
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','ct_social_counter_widget');

function ct_social_counter_widget() {
		register_widget("CT_Social_Counter");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Social_Counter extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_Social_Counter(){
		
		/* Widget settings. */	
		$widget_ops = array(	'classname'		=> 'ct-social-counter-widget',
								'description'	=> __( 'Social Counter Widget' , 'color-theme-framework' )
							);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 255,
								'height'	=> 350,
								'id_base'	=> 'ct-social-counter-widget'
							);
		
		/* Create the widget. */
		parent::__construct( 'ct-social-counter-widget', __( 'CT: Social Counter' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);

		/* Our variables from the widget settings. */
		$title = apply_filters ('widget_title', $instance ['title']);
		$twitter_ID = $instance['twitter_ID'];
		$facebook_id = isset( $instance['facebook_id'] ) ? $instance['facebook_id'] : '';
		/*$facebook_app_id = isset( $instance['facebook_app_id'] ) ? $instance['facebook_app_id'] : '';
		$facebook_app_secret = isset( $instance['facebook_app_secret'] ) ? $instance['facebook_app_secret'] : '';*/
		$youtube_id = isset( $instance['youtube_id'] ) ? $instance['youtube_id'] : '';
		$youtube_url = isset( $instance['youtube_url'] ) ? $instance['youtube_url'] : '';
		$youtube_api = isset( $instance['youtube_api'] ) ? $instance['youtube_api'] : '';
		$rss_ID = $instance['rss_ID'];

		$show_twitter = isset($instance['show_twitter']) ? 'true' : 'false';
		$show_facebook = isset($instance['show_facebook']) ? 'true' : 'false';
		$show_youtube = isset($instance['show_youtube']) ? 'true' : 'false';
		$show_rss = isset($instance['show_rss']) ? 'true' : 'false';
		$background_title = $instance['background_title'];

		if ( empty( $facebook_id ) /*or empty( $facebook_app_id ) or empty( $facebook_app_secret )*/ ) {
			$facebook_settings = 0;
		} else {
			$facebook_settings = 1;
		}

		if ( empty( $youtube_id ) or empty( $youtube_url ) or empty( $youtube_api ) ) {
			$youtube_settings = 0;
		} else {
			$youtube_settings = 1;
		}

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ){
			echo "\n<!-- START SOCIAL COUNTER WIDGET -->\n";
			echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
		} else {
			echo "\n<!-- START SOCIAL COUNTER WIDGET -->\n";
		}
		?>
	
		<?php		
			function ct_get_fb_access_token(){
				$api_url = 'https://graph.facebook.com/';
				$url = sprintf(
					'%s/oauth/access_token?client_id=%s&client_secret=%s&grant_type=client_credentials',
					$api_url,
					$facebook_app_id,
					$facebook_app_secret
				);
				$access_token = wp_remote_get( $url, array( 'timeout' => 60 ) );

				if ( is_wp_error( $access_token ) || ( isset( $access_token['response']['code'] ) && 200 != $access_token['response']['code'] ) ) {
					return '';
				} else {
					return sanitize_text_field( $access_token['body'] );
				}
			}


			function ct_facebook_count( $url ){
 				// Query in FQL
				$fql  = "SELECT like_count ";
				$fql .= " FROM link_stat WHERE url = '$url'";

				$fqlURL = "https://api.facebook.com/method/fql.query?format=json&query=" . urlencode ( $fql );

				// Facebook Response is in JSON
				$response = file_get_contents($fqlURL);
				$response = json_decode($response);
				return $response[0]->like_count;      
			}


			if( !empty( $facebook_settings ) ) {

				$fans = get_transient('social_subscribers_counter_facebook4');

				if( false === $fans ) {

					$fans = ct_facebook_count( 'https://www.facebook.com/' . $facebook_id );
					if( $fans != 0 ) {
						set_transient('social_subscribers_counter_facebook4', $fans, 3600);
					}
				}

				/*if( false === $fans ) {
	            	$api_url = 'https://graph.facebook.com/';
	            	$url = sprintf(
	        			'%s/oauth/access_token?client_id=%s&client_secret=%s&grant_type=client_credentials',
	        			$api_url,
	        			$facebook_app_id,
	        			$facebook_app_secret
	        		);
	        		echo $url;
	        		$access_token = wp_remote_get( $url, array( 'timeout' => 60 ) );
	        
	        		if ( is_wp_error( $access_token ) || ( isset( $access_token['response']['code'] ) && 200 != $access_token['response']['code'] ) ) {
	        			$fb_access_token = '';
	        		} else {
	        			$fb_access_token = sanitize_text_field( $access_token['body'] );
	        		}

	               	$access_token = $fb_access_token;
	                $api_url = 'https://graph.facebook.com/';
	    			$url = sprintf(
	    				'%s%s?fields=likes&%s',
	    				$api_url,
	    				$facebook_id ,
	    				$access_token
	    			);
	    			echo "\n";
	    			echo $url;
	    
	    			$connection = wp_remote_get( $url, array( 'timeout' => 60 ) );
	    
	    			if ( is_wp_error( $connection ) || ( isset( $connection['response']['code'] ) && 200 != $connection['response']['code'] ) ) {
	    				$fans = 0;
	    				echo "error";
	    			} else {
	    				$_data = json_decode( $connection['body'], true );
	    
	    				if ( isset( $_data['likes'] ) ) {
	    					$count = intval( $_data['likes'] );
	    
	    					$fans = $count;
	    				} else {
	    					$fans = 0;
	    				}
	    			}

	    			set_transient('social_subscribers_counter_facebook4', $fans, 3);
				}	*/
			} else {
				echo '<p class="counters_info" style="font-size: 12px;">' . __( '- Please fill all Facebook settings','color-theme-framework') . '</p>';
			}

		/* ============ YOUTUBE ============ */

			if( !empty( $youtube_settings ) ) {

				$yt_subscribers = get_transient('social_subscribers_counter_youtube2');

				if( false === $yt_subscribers ) {

					$api_key = $youtube_api;
					$channel_id = $youtube_id;
					$api_url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&id=' . $channel_id . '&key=' . $api_key;
					$connection = wp_remote_get( $api_url, array( 'timeout' => 60 ) );

					if ( !is_wp_error( $connection ) ) {
					    $response = json_decode( $connection['body'], true );
					    if ( isset( $response['items'][0]['statistics']['subscriberCount'] ) ) {
					        $yt_subscribers = $response['items'][0]['statistics']['subscriberCount'];
					        set_transient( 'social_subscribers_counter_youtube2', $yt_subscribers, 3600 );
					    }
					} else {
					   $error_string = $connection->get_error_message();
					   echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
					}
				}	
			} else {
				echo '<p class="counters_info" style="font-size: 12px;">' . __( '- Please fill all Youtube settings','color-theme-framework') . '</p>';
			}

		/* ============ TWITTER ============ */

		ob_start();
		
		if( !empty( $twitter_ID ) and ($show_twitter == 'true') ) { 

			$followers = get_transient('social_subscribers_counter_twitter_ct');

			if( false === $followers ) {	
			
				require_once("TwitterAPIExchange.php");

				/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
				global $ct_options;
				$oauth_access_token = $ct_options['ct_user_token'];
				$oauth_access_token_secret = $ct_options['ct_user_secret'];
				$consumer_key = $ct_options['ct_consumer_key'];
				$consumer_secret = $ct_options['ct_consumer_secret'];

				$settings = array(
    				'oauth_access_token' => $oauth_access_token,
    				'oauth_access_token_secret' => $oauth_access_token_secret,
    				'consumer_key' => $consumer_key,
    				'consumer_secret' => $consumer_secret
				);

				if ( ( empty($consumer_key) or empty($consumer_secret) or empty($oauth_access_token) or empty($oauth_access_token_secret) ) and ( $show_twitter == 'true' ) ) {
					echo '<span class="counters_info" style="font-size: 12px;">' . __('Please fill all Twitter Settings (menu Appearance -> Theme Options -> Twitter settings)','color-theme-framework') . '</span>';
					//return;
				}

				if ( ( !empty($consumer_key) and !empty($consumer_secret) and !empty($oauth_access_token) and !empty($oauth_access_token_secret) ) and ( $show_twitter == 'true' ) ) {
					$url = 'https://api.twitter.com/1.1/users/show.json';
					$getfield = '?screen_name=' . $twitter_ID;
					$requestMethod = 'GET';
					$twitter = new TwitterAPIExchange($settings);
					$response = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();

					$followers_decode = json_decode($response);
					$followers = $followers_decode->followers_count;

					if ( $followers != 0 ) {
						set_transient('social_subscribers_counter_twitter_ct', $followers, 3600);
					}
				}
			}
		}
		?>


		<ul class="clearfix">
			<?php if ( ( $show_facebook == 'true') and !empty( $facebook_settings ) ) : $facebook_english_format = number_format( $fans ); ?>
				<li class="facebook-social">
		  			<a class="ct-transition" target="_blank" href="https://www.facebook.com/<?php echo $facebook_id ?>"></a>
		  			<span class="ct-counter" title="<?php _e('Fans','color-theme-framework'); ?>"><?php echo  $facebook_english_format; ?></span>
				</li>
			<?php endif; ?>

			<?php if ( $show_twitter == 'true') : $twitter_english_format = number_format($followers); ?>
				<li class="twitter-social">
		  			<a class="ct-transition" target="_blank" href="http://twitter.com/<?php echo $twitter_ID ?>"></a>
		  			<span class="ct-counter" title="<?php _e('Followers','color-theme-framework'); ?>"><?php echo $twitter_english_format; ?></span>
				</li>
			<?php endif; ?>

			<?php if ( ( $show_youtube == 'true') and !empty( $youtube_settings ) ) :
				$youtube_english_format = number_format($yt_subscribers); ?>
				<li class="youtube-social">
		  			<a class="ct-transition" target="_blank" href="<?php echo esc_url( $youtube_url ); ?>"></a>
		  			<span class="ct-counter" title="<?php _e('Subscribers','color-theme-framework'); ?>"><?php echo $youtube_english_format; ?></span>
				</li>
			<?php endif; ?>

			<?php if ( $show_rss == 'true') : ?>
				<li class="rss-social">
		  			<a class="ct-transition" target="_blank" href="<?php echo $rss_ID ?>"></a>
		  			<span class="ct-counter" title="<?php _e('RSS Feed','color-theme-framework'); ?>"><?php _e('RSS','color-theme-framework'); ?></span>
				</li>
			<?php endif; ?>
		</ul>

		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
		echo "\n<!-- END SOCIAL COUNTER WIDGET -->\n";
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['twitter_ID'] = $new_instance['twitter_ID'];
		$instance['facebook_id'] = $new_instance['facebook_id'];
		/*$instance['facebook_app_id'] = $new_instance['facebook_app_id'];
		$instance['facebook_app_secret'] = $new_instance['facebook_app_secret'];*/
		$instance['youtube_id'] = $new_instance['youtube_id'];
		$instance['youtube_url'] = $new_instance['youtube_url'];
		$instance['youtube_api'] = $new_instance['youtube_api'];
		$instance['rss_ID'] = $new_instance['rss_ID'];
		$instance['show_twitter'] = $new_instance['show_twitter'];
		$instance['show_facebook'] = $new_instance['show_facebook'];
		$instance['show_youtube'] = $new_instance['show_youtube'];
		$instance['show_rss'] = $new_instance['show_rss'];

		$instance['background_title'] = strip_tags($new_instance['background_title']);
		
		delete_transient('social_subscribers_counter_twitter_ct');
		delete_transient('social_subscribers_counter_facebook');
		delete_transient('social_subscribers_counter_youtube');

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance)
		{
		/* Set up some default widget settings. */
		$defaults = array(	'title'					=> '', 
							'twitter_ID'			=> 'zesky' , 
							'facebook_id'			=> '', 
							/*'facebook_app_id'		=> '',
							'facebook_app_secret'	=> '',*/
							'youtube_id'			=> '',
							'youtube_url'			=> '',
							'youtube_api'			=> '',
							'rss_ID'				=> 'http://themeforest.net/page/file_updates#rss',
							'show_twitter'			=> 'on',
							'show_facebook'			=> 'on',
							'show_youtube'			=> 'on',
							'show_rss'				=> 'off',
							'background_title'		=> '#ff0000'
						);
			
		$instance = wp_parse_args((array) $instance, $defaults); 
		$background_title = esc_attr($instance['background_title']); ?>

		<script type="text/javascript">
			//<![CDATA[
            jQuery(document).ready(function($) {  
                $('.ct-color-picker').wpColorPicker();  
            });  
			//]]>   
		</script>
		

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_ID'); ?>"><?php _e( 'Twitter ID:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_ID'); ?>" name="<?php echo $this->get_field_name('twitter_ID'); ?>" value="<?php echo $instance['twitter_ID']; ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_id' ) ); ?>"><?php esc_html_e( 'Facebook Page ID:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'facebook_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook_id' ) ); ?>" value="<?php echo esc_attr( $instance[ 'facebook_id' ] ); ?>" />
			<small><?php _e( "Please enter the page ID or page name. For example: If your page url is https://www.facebook.com/colorthemes then your page ID is \"colorthemes\".", "color-theme-framework"); ?></small>
		</p>

<?php /*
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_app_id' ) ); ?>"><?php esc_html_e( 'Facebook App ID:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'facebook_app_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook_app_id' ) ); ?>" value="<?php echo esc_attr( $instance[ 'facebook_app_id' ] ); ?>" />
			<small><?php _e( "Please go to <a target=\"_blank\" href=\"https://developers.facebook.com/\">https://developers.facebook.com</a> and create an app and get the App ID", "color-theme-framework"); ?></small>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_app_secret' ) ); ?>"><?php esc_html_e( 'Facebook App Secret:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'facebook_app_secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook_app_secret' ) ); ?>" value="<?php echo esc_attr( $instance[ 'facebook_app_secret' ] ); ?>" />
			<small><?php _e( "Please go to <a target=\"_blank\" href=\"https://developers.facebook.com/\">https://developers.facebook.com</a> and create an app and get the App Secret", "color-theme-framework"); ?></small>
		</p>
*/ ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube_id' ) ); ?>"><?php esc_html_e( 'Youtube Channel ID:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'youtube_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube_id' ) ); ?>" value="<?php echo esc_attr( $instance[ 'youtube_id' ] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube_url' ) ); ?>"><?php esc_html_e( 'Youtube Channel URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'youtube_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube_url' ) ); ?>" value="<?php echo esc_attr( $instance[ 'youtube_url' ] ); ?>" />
			<small><?php _e( "Please enter the Youtube channel URL. For example: https://www.youtube.com/user/envato", "color-theme-framework"); ?></small>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube_api' ) ); ?>"><?php esc_html_e( 'Youtube API Key:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'youtube_api' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube_api' ) ); ?>" value="<?php echo esc_attr( $instance[ 'youtube_api' ] ); ?>" />
			<small><?php _e( "To get your API Key, first create a project/app in <a target=\"_blank\" href=\"https://console.developers.google.com/project\">https://console.developers.google.com/project</a> and then turn on both Youtube Data and Analytics API from \"APIs & auth >APIs inside your project. Then again go to \"APIs & auth > APIs > Credentials > Public API access\" and then click \"CREATE A NEW KEY\" button, select the \"Browser key\" option and click in the \"CREATE\" button, and then copy your API key and paste in above field.", "color-theme-framework"); ?></small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('rss_ID'); ?>"><?php _e( 'RSS Feed URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('rss_ID'); ?>" name="<?php echo $this->get_field_name('rss_ID'); ?>" value="<?php echo $instance['rss_ID']; ?>" />
		</p>

		<p style="display:block; margin-bottom:5px;">
			<label for="Show counters" style="display:block;"><?php _e( 'Show counters:' , 'color-theme-framework' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_twitter'], 'on'); ?> id="<?php echo $this->get_field_id('show_twitter'); ?>" name="<?php echo $this->get_field_name('show_twitter'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_twitter'); ?>"><?php _e( 'Twitter' , 'color-theme-framework' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_facebook'], 'on'); ?> id="<?php echo $this->get_field_id('show_facebook'); ?>" name="<?php echo $this->get_field_name('show_facebook'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_facebook'); ?>"><?php _e( 'Facebook' , 'color-theme-framework' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_youtube'], 'on'); ?> id="<?php echo $this->get_field_id('show_youtube'); ?>" name="<?php echo $this->get_field_name('show_youtube'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_youtube'); ?>"><?php _e( 'Youtube' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_rss'], 'on'); ?> id="<?php echo $this->get_field_id('show_rss'); ?>" name="<?php echo $this->get_field_name('show_rss'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_rss'); ?>"><?php _e( 'RSS Feed' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" data-default-color="#72347d" />
		</p>

		<?php

	}
}
?>