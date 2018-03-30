<?php
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	return $connection;
}


class Flickr_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'met_flickr_widget',
			':MET Flickr Widget'
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$flickr_username = $instance['flickr_username'];

		wp_enqueue_script('metcreative-jflickrfeed');
		wp_enqueue_script('metcreative-magnific-popup');
		wp_enqueue_style('metcreative-magnific-popup');

		$widget_id = uniqid('metFlickrWidget_');

?>
		<div id="<?php echo $widget_id ?>" class="row-fluid sidebar-widget">
			<div class="span12">
				<div class="met_flickr_widget clearfix">
					<div class="met_flickr_widget_title met_color2 met_bgcolor3">
						<div><?php echo $before_title. $title. $after_title ?></div>
					</div>
					<div class="met_flickr_widget_list clearfix"></div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('#<?php echo $widget_id ?> .met_flickr_widget_list').jflickrfeed({
						limit: 10,
						qstrings: {
							id: '<?php echo $flickr_username ?>'
						},
						itemTemplate: '<a href="{{image_b}}" rel="lb_<?php $widget_id; ?>"><img src="{{image_s}}" alt="{{title}}" /></a>'
					}, function(data){
						jQuery('[rel*="lb"]').each(function(){
							jQuery('[rel="'+jQuery(this).attr('rel')+'"]').magnificPopup({
								type: 'image',
								gallery:{
									enabled: true
								}
							});
						});
					});
				});
		</script>
		<div class="clearfix"></div>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickr_username'] = strip_tags( trim($new_instance['flickr_username']));

		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else{$title = 'Flickr Photos';}

		if ( isset( $instance[ 'flickr_username' ] ) ) {
			$flickr_username = $instance[ 'flickr_username' ];
		}else{
			$flickr_username = '36621592@N06';
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_username' ); ?>"><?php _e( 'User ID:' ); ?> [idgettr.com]</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'flickr_username' ); ?>" name="<?php echo $this->get_field_name( 'flickr_username' ); ?>" type="text" value="<?php echo esc_attr( $flickr_username ); ?>" />
		</p>
	<?php
	}

}register_widget( 'Flickr_Widget' );


class Twitter_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'Twitter_Widget',
			':MET Twitter Widget'
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$twitter_username = $instance['username'];
		$username = $instance['username'];

		$instance['cachetime'] = 2;

		if(empty($instance['consumerkey']) || empty($instance['consumersecret']) || empty($instance['accesstoken']) || empty($instance['accesstokensecret']) || empty($instance['cachetime']) || empty($instance['username'])){
			echo '<div>Please fill all widget settings!</div>';
		}else{

			if($username != get_option('tp_twitter_plugin_username')){
				delete_option('tp_twitter_plugin_last_cache_time');
			}

			//check if cache needs update
			$tp_twitter_plugin_last_cache_time = get_option('tp_twitter_plugin_last_cache_time');
			$diff = time() - $tp_twitter_plugin_last_cache_time;
			$crt = $instance['cachetime'] * 3600;

			//	yes, it needs update
			if($diff >= $crt || empty($tp_twitter_plugin_last_cache_time)){

				if(!class_exists('TwitterOAuth')){
					if(!require_once(get_template_directory() . '/inc/twitteroauth.php')){
						echo '<div><strong>Couldn\'t find twitteroauth.php!</strong></div>';
					}
				}


				$connection = getConnectionWithAccessToken($instance['consumerkey'], $instance['consumersecret'], $instance['accesstoken'], $instance['accesstokensecret']);
				$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$instance['username']."&count=10") or die('Couldn\'t retrieve tweets! Wrong username?');


				if(!empty($tweets->errors)){
					if($tweets->errors[0]->message == 'Invalid or expired token'){
						echo '<div><strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!</div>';
					}else{
						echo '<div><strong>'.$tweets->errors[0]->message.'</strong></div>';
					}
					return;
				}

				for($i = 0;$i <= count($tweets); $i++){
					if(!empty($tweets[$i])){
						$tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
						$tweets_array[$i]['text'] = $tweets[$i]->text;
						$tweets_array[$i]['status_id'] = $tweets[$i]->id_str;
					}
				}

				//save tweets to wp option
				update_option('tp_twitter_plugin_tweets',serialize($tweets_array));
				update_option('tp_twitter_plugin_last_cache_time',time());
				update_option('tp_twitter_plugin_username',$username);

				echo '<!-- twitter cache has been updated! -->';
			}
		}


		wp_enqueue_script('metcreative-caroufredsel');
		wp_enqueue_style('metcreative-caroufredsel');

		$widget_id = uniqid('met_widget_twitter_');

		$tp_twitter_plugin_tweets = maybe_unserialize(get_option('tp_twitter_plugin_tweets'));

?>
		<div class="row-fluid">
			<div class="span12">
				<div class="met_twitter_widget met_color2 met_bgcolor clearfix">
					<?php echo $before_title. $title. $after_title ?>

					<div id="<?php echo $widget_id ?>" class="met_twitter_wrapper">
						<?php if(!empty($tp_twitter_plugin_tweets)): ?>
						<?php $fctr = 1; foreach($tp_twitter_plugin_tweets as $tweet): ?>
							<div class="met_twitter_item clearfix">
								<i class="icon-twitter"></i>
								<p><?php echo convert_links($tweet['text']) ?></p>
							</div>
							<?php if($fctr == 10){ break; } $fctr++; endforeach; endif; ?>
					</div>

				</div>
			</div>
		</div><!-- Twitter Ticker Ends -->
		<script>
			jQuery(document).ready(function(){
				jQuery("#<?php echo $widget_id ?>").carouFredSel({
					responsive: true,
					circular: true,
					infinite: true,
					auto: {
						play : true,
						pauseDuration: 0,
						duration: 3000
					},
					scroll: {
						duration: 400,
						wipe: true,
						pauseOnHover: true
					},
					items: {
						visible: {
							min: 3,
							max: 3},
						height: 'auto'
					},
					direction: 'up',
					onCreate: function(){
						jQuery(window).trigger('resize');
					}
				});
			})
		</script>

	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( trim($new_instance['username']));

		$instance['consumerkey'] = strip_tags( trim($new_instance['consumerkey']));
		$instance['consumersecret'] = strip_tags( trim($new_instance['consumersecret']));
		$instance['accesstoken'] = strip_tags( trim($new_instance['accesstoken']));
		$instance['accesstokensecret'] = strip_tags( trim($new_instance['accesstokensecret']));

		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else{$title = '';}

		if ( isset( $instance[ 'username' ] ) ) {
			$username = $instance[ 'username' ];
		}else{
			$username = 'envato';
		}

		if ( isset( $instance[ 'consumerkey' ] ) ) { $consumerkey = $instance[ 'consumerkey' ]; }else{ $consumerkey = ''; }
		if ( isset( $instance[ 'consumersecret' ] ) ) { $consumersecret = $instance[ 'consumersecret' ]; }else{ $consumersecret = ''; }
		if ( isset( $instance[ 'accesstoken' ] ) ) { $accesstoken = $instance[ 'accesstoken' ]; }else{ $accesstoken = ''; }
		if ( isset( $instance[ 'accesstokensecret' ] ) ) { $accesstokensecret = $instance[ 'accesstokensecret' ]; }else{ $accesstokensecret = ''; }

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'consumerkey' ); ?>"><?php _e( 'Consumer Key:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'consumerkey' ); ?>" name="<?php echo $this->get_field_name( 'consumerkey' ); ?>" type="text" value="<?php echo esc_attr( $consumerkey ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'consumersecret' ); ?>"><?php _e( 'Consumer Secret:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'consumersecret' ); ?>" name="<?php echo $this->get_field_name( 'consumersecret' ); ?>" type="text" value="<?php echo esc_attr( $consumersecret ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'accesstoken' ); ?>"><?php _e( 'Access Token:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'accesstoken' ); ?>" name="<?php echo $this->get_field_name( 'accesstoken' ); ?>" type="text" value="<?php echo esc_attr( $accesstoken ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'accesstokensecret' ); ?>"><?php _e( 'Access Token Secret:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'accesstokensecret' ); ?>" name="<?php echo $this->get_field_name( 'accesstokensecret' ); ?>" type="text" value="<?php echo esc_attr( $accesstokensecret ); ?>" />
		</p>
	<?php
	}

}register_widget( 'Twitter_Widget' );


class METRecentPost_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'METRecentPost_Widget',
			':MET Recent Posts'
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$post_count = $instance['post_count'];
		echo $before_widget;
		?>

		<div class="row-fluid met_small_block">
			<div class="span12">
				<?php echo $before_title ?>
				<?php echo $title ?>
				<?php echo $after_title ?>
				<ul class="met_recent_posts scrolled">
					<?php
					query_posts("posts_per_page=$post_count");
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full');
						$postThumbnail = aq_resize( $img_url, 84, 60, true );
						$excerpt_limit = ((empty($postThumbnail))  ? 10 : 6);

						echo '
						<li class="scrolled__item">
							<a href="' . get_permalink(get_the_ID()) . '" class="clearfix">
								'.((!empty($postThumbnail))  ? '<img src="'.$postThumbnail.'" alt="'.esc_attr(get_the_title()).'">' : '').'
								<h4 '.((empty($postThumbnail))  ? 'style="margin-left:0"' : '').'>'.get_the_title().'</h4>
								<p '.((empty($postThumbnail))  ? 'style="margin-left:0"' : '').'>'.wp_trim_words(get_the_excerpt(),$excerpt_limit).'</p>
							</a>
						</li>';
					endwhile;
					endif;
					wp_reset_query();
					?>
				</ul>
			</div>
		</div>

		<?php
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_count'] = strip_tags( $new_instance['post_count'] );

		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Recent Posts', 'metcreative' );
		}

		if ( isset( $instance[ 'post_count' ] ) ) {
			$post_count = $instance[ 'post_count' ];
		}else{
			$post_count = 5;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_count' ); ?>"><?php _e( 'Post Count:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" type="text" value="<?php echo esc_attr( $post_count ); ?>" />
		</p>
	<?php
	}

}register_widget( 'METRecentPost_Widget' );