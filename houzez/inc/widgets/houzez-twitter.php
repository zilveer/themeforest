<?php
/*
 * Plugin Name: Twitter Feeds
 * Plugin URI: http://favethemes.com/
 * Description: A widget that shows latest tweets from twitter profile
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */

class houzez_Twitter extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'houzez_twitter', // Base ID
			__( 'Houzez: Twitter Feeds', 'houzez' ), // Name
			array( 'description' => __( 'A widget that shows latest tweets from twitter profile', 'houzez' ), ) // Args
		);
		
	}

	
	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_tweets = $instance['no_of_tweets'];
		$widget_type = $instance['slide_list'];
	    $cacheTime = 20;
		$twitter_username 		= $instance['twitter_username'];
		$consumer_key 			= $instance['twitter_consumer_key'];
		$consumer_secret		= $instance['twitter_consumer_secret'];
		$access_token 			= $instance['twitter_access_token'];
		$access_token_secret 	= $instance['twitter_access_token_secret'];
		
	if( !empty($twitter_username) && !empty($consumer_key) && !empty($consumer_secret) && !empty($access_token) && !empty($access_token_secret)  ){
	    
		$twitterData = get_transient('list_tweets');
		if( empty( $twitterData ) ){
			$twitterConnection = new TwitterOAuth( $consumer_key , $consumer_secret , $access_token , $access_token_secret	);
			$twitterData = $twitterConnection->get(
					  'statuses/user_timeline',
					  array(
					    'screen_name'     => $twitter_username ,
					    'count'           => "5"
						)
					);
					
			$error = $twitterData->errors;
			
	        // Save our new transient.
			if( !isset( $error ))
				set_transient('list_tweets', $twitterData, 60 * $cacheTime);
	    }
		
		echo $before_widget;
			echo $before_title; ?>
			<a href="http://twitter.com/<?php echo $twitter_username  ?>"><?php echo $title ; ?></a>
		<?php echo $after_title; 
            	if( !isset( $error ) && is_array($twitterData)){
            		$i=0;
					$hyperlinks = true;
					$twitter_users = true;
					$update = true;
					echo '<div class="widget-body">';
					$encode_utf8="";

		            if( $widget_type == 'tweet_list' ) {
			            foreach ( $twitterData as $item ) {
				            $msg       = $item->text;
				            $permalink = 'http://twitter.com/#!/' . $twitter_username . '/status/' . $item->id_str;
				            if ( $encode_utf8 ) {
					            $msg = utf8_encode( $msg );
				            }
				            $link = $permalink;
				            echo '<div class="twitter-list"><div class="row">';
				            echo '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
										<div class="twitter-feed-icon text-center">
											<i class="fa fa-twitter fa-2x"></i>
										</div>
									</div>';
				            if ( $hyperlinks ) {
					            $msg = $this->hyperlinks( $msg );
				            }
				            if ( $twitter_users ) {
					            $msg = $this->twitter_users( $msg );
				            }
				            echo '<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">';
				            echo '<p>';
				            echo $msg;
				            echo '</p>';

				            if ( $update ) {
					            $time = strtotime( $item->created_at );
					            if ( ( abs( time() - $time ) ) < 1814400 ) {
						            $h_time = sprintf( esc_html__( '%s ago', 'houzez' ), human_time_diff( $time ) );
					            } else {
						            $h_time = date( esc_html( 'Y/m/d' ), $time );
					            }
					            echo sprintf( esc_html( '%s', 'twitter-for-wordpress' ), ' <ul class="list-inline post-meta twitter-meta"><li class="post-date"><abbr title="' . date( esc_html( 'Y/m/d H:i:s' ), $time ) . '">' . $h_time . '</abbr></li></ul>' );
				            }
				            echo '</div>';
				            echo '</div></div>';
				            $i ++;
				            if ( $i >= $no_of_tweets ) {
					            break;
				            }
			            }
		            } else {

			            $unique_key = houzez_unique_key();
					    if ( is_rtl() ) { $houzez_rtl = 'true'; } else { $houzez_rtl = 'false'; }
						?>

							<script type="text/javascript">
							jQuery(document).ready(function($) {

								$("#owl-twitter-<?php echo $unique_key; ?>").owlCarousel({
									rtl: <?php echo $houzez_rtl; ?>,
									loop: true,
									touchDrag: true,
									items : 1,

								    //Autoplay
								    autoplay : true,
									autoplayHoverPause : true,

								    // Navigation
									nav : true,
									navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
								    rewindNav : true,
								    dots:false,

								    // Responsive
									responsiveClass:true,
									responsiveRefreshRate : 200,
									responsiveBaseWidth: window,

								    //Lazy load
								    lazyLoad : true,
								    lazyFollow : true,
								    lazyEffect : "fade",
								});

							});
							</script>
						<?php
			            echo '<div id="owl-twitter-'.$unique_key.'" class="owl-carousel">';
			            foreach ( $twitterData as $item ) {
				            $msg       = $item->text;
				            $permalink = 'http://twitter.com/#!/' . $twitter_username . '/status/' . $item->id_str;
				            if ( $encode_utf8 ) {
					            $msg = utf8_encode( $msg );
				            }
				            $link = $permalink;
				            echo '<div class="slide"><div class="twitter-carousel">';
				            echo '<div class="twitter-feed-icon text-center">
										<i class="fa fa-twitter fa-2x"></i>
								  </div>';
				            if ( $hyperlinks ) {
					            $msg = $this->hyperlinks( $msg );
				            }
				            if ( $twitter_users ) {
					            $msg = $this->twitter_users( $msg );
				            }
				            echo '<div class="twitter-feed-copy text-center">';
				            echo '<p>';
				            echo $msg;
				            echo '</p>';

				            if ( $update ) {
					            $time = strtotime( $item->created_at );
					            if ( ( abs( time() - $time ) ) < 1814400 ) {
						            $h_time = sprintf( esc_html( '%s ago' ), human_time_diff( $time ) );
					            } else {
						            $h_time = date( esc_html( 'Y/m/d' ), $time );
					            }
					            echo sprintf( esc_html( '%s', 'twitter-for-wordpress' ), ' <ul class="list-inline post-meta twitter-meta"><li class="post-date"><abbr title="' . date( esc_html( 'Y/m/d H:i:s' ), $time ) . '">' . $h_time . '</abbr></li></ul>' );
				            }
				            echo '</div>';
				            echo '</div></div>';
				            $i ++;
				            if ( $i >= $no_of_tweets ) {
					            break;
				            }
			            }
			            echo '</div>';

		            }


					echo '</div>';
            	}
				else{ 
					?> <a href="http://twitter.com/<?php echo $twitter_username  ?>"><?php echo $title ; ?></a> 
<?php			}
            ?>
		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	else{
		echo $before_widget;
		echo $before_title; ?>
			<a href="http://twitter.com/<?php echo $twitter_username  ?>"><?php echo $title ; ?></a>
		<?php echo $after_title; 
		echo 'Setup Twitter API OAuth settings for widget ';
		echo $after_widget;
	}
}
	
	
	/**
	 * Sanitize widget form values as they are saved
	**/
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['slide_list'] = strip_tags( $new_instance['slide_list'] );
		$instance['no_of_tweets'] = strip_tags( $new_instance['no_of_tweets'] );
		$instance['twitter_username']			 = $new_instance['twitter_username'];
		$instance['twitter_consumer_key']		 = $new_instance['twitter_consumer_key'];
		$instance['twitter_consumer_secret'] 	 = $new_instance['twitter_consumer_secret'];
		$instance['twitter_access_token'] 		 = $new_instance['twitter_access_token'];
		$instance['twitter_access_token_secret'] = $new_instance['twitter_access_token_secret'];
		
		delete_transient('list_tweets');
		return $instance;
		
	}
	
	
	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {
		
		$defaults = array( 'title' =>__('Latest Tweets' , 'houzez') , 'slide_list' => 'tweet_slide', 'no_of_tweets' => '5' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		$widget_id = $this->id_base.'-'.$this->number;
		if ( is_active_widget( false, $widget_id , $this->id_base, true ) ) {
			$twitter_username 		= $instance['twitter_username'];
			$slide_list 		= $instance['slide_list'];
			$consumer_key 			= $instance['twitter_consumer_key'];
			$consumer_secret		= $instance['twitter_consumer_secret'];
			$access_token 			= $instance['twitter_access_token'];
			$access_token_secret 	= $instance['twitter_access_token_secret'];
			
			if( !empty($twitter_username) && !empty($consumer_key) && !empty($consumer_secret) && !empty($access_token) && !empty($access_token_secret)  ){
				$twitterConnection = new TwitterOAuth( $consumer_key , $consumer_secret , $access_token , $access_token_secret	);
					$twitterData = $twitterConnection->get(
						  'statuses/user_timeline',
						  array(
							'screen_name'    => $twitter_username ,
							'count'          => "5"
							)
						);				
				if(isset($twitterData->errors)){
					$error = $twitterData->errors;
					$error_msg = (array) $error[0];
					$error_msg = $error_msg['message'];
					echo '<p style="display:block; padding: 5px; font-weight:bold; clear:both; background: rgb(255, 157, 157);">Twiiter API ERROR : '.$error_msg.'</p>';
				}
			}else{echo '<p style="display:block; padding: 5px; font-weight:bold; clear:both; background: rgb(255, 157, 157);">Error : Setup Twitter API OAuth settings.You need to create <a target="_blank" href="https://dev.twitter.com/apps">Twitter APP</a> to get this info.</p>';}
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if(isset($instance['title'])){echo $instance['title'];} ?>" class="widefat" type="text" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>">Twitter Username: </label>
			<input id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" value="<?php if(isset($instance['twitter_username'])){echo $instance['twitter_username'];} ?>" class="widefat" type="text" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'twitter_consumer_key' ); ?>">Consumer key: </label>
			<input id="<?php echo $this->get_field_id( 'twitter_consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'twitter_consumer_key' ); ?>" value="<?php if(isset($instance['twitter_username'])){echo $instance['twitter_consumer_key'];} ?>" class="widefat" type="text" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'twitter_consumer_secret' ); ?>">Consumer secret: </label>
			<input id="<?php echo $this->get_field_id( 'twitter_consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'twitter_consumer_secret' ); ?>" value="<?php if(isset($instance['twitter_consumer_secret'])){echo $instance['twitter_consumer_secret'];} ?>" class="widefat" type="text" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'twitter_access_token' ); ?>">Access token: </label>
			<input id="<?php echo $this->get_field_id( 'twitter_access_token' ); ?>" name="<?php echo $this->get_field_name( 'twitter_access_token' ); ?>" value="<?php if(isset($instance['twitter_access_token'])){echo $instance['twitter_access_token'];} ?>" class="widefat" type="text" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'twitter_access_token_secret' ); ?>">Access token secret: </label>
			<input id="<?php echo $this->get_field_id( 'twitter_access_token_secret' ); ?>" name="<?php echo $this->get_field_name( 'twitter_access_token_secret' ); ?>" value="<?php if(isset($instance['twitter_access_token_secret'])){echo $instance['twitter_access_token_secret'];} ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'slide_list' ); ?>">Widget Type : </label>
			<select id="<?php echo $this->get_field_id( 'slide_list' ); ?>" name="<?php echo $this->get_field_name( 'slide_list' ); ?>">
				<option <?php if( $instance['slide_list'] == "tweet_slide" ){ echo "selected"; } ?> value="tweet_slide">Slide</option>
				<option <?php if( $instance['slide_list'] == "tweet_list" ){ echo "selected"; } ?> value="tweet_list">List</option>
			</select>

		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>">Number of Tweets to show : </label>
			<input id="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>" name="<?php echo $this->get_field_name( 'no_of_tweets' ); ?>" value="<?php if(isset($instance['no_of_tweets'])){echo $instance['no_of_tweets'];} ?>" type="text" size="3" />
		</p>
	<?php
	}
	
	/**
	 * Find links and create the hyperlinks
	 */
	private function hyperlinks($text) {
	    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
	    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
	    // match name@address
	    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
	        //mach #trendingtopics. Props to Michael Voigt
	    $text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
	    return $text;
	}
	/**
	 * Find twitter usernames and link to them
	 */
	private function twitter_users($text) {
	       $text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
	       return $text;
	}

}
if ( ! function_exists( 'houzez_Twitter_loader' ) ) {
	function houzez_Twitter_loader (){
		register_widget( 'houzez_Twitter' );
	}
	add_action( 'widgets_init', 'houzez_Twitter_loader' );
}