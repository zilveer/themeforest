<?php
/**
 * Twitter Widget Class
 */
if (!class_exists('Theme_Widget_Twitter')) {
class Theme_Widget_Twitter extends WP_Widget {

	public function __construct(){
		$widget_ops = array('classname' => 'widget_twitter', 'description' => __( 'Displays a list of twitter feeds', 'theme_admin' ) );
		parent::__construct('theme_twitter', THEME_SLUG.' - '.__('Twitter', 'theme_admin'), $widget_ops);
		
		if ( is_active_widget(false, false, $this->id_base) ){
			add_action( 'wp_print_scripts', array(&$this, 'add_tweet_script') );
		}
		
	}

	function add_tweet_script(){
		wp_enqueue_script('jquery-tweet');
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Tweets', 'striking-r') : $instance['title'], $instance, $this->id_base);
		$titlelink= $instance ['titlelink'];
		$username= $instance['username'];
		
		$user_array = explode(',',$username);
		foreach($user_array as $key => $user){
			$user_array[$key] = '"'.$user.'"';
		}
		
		$query= empty($instance['query'])?'null':'"'.$instance['query'].'"';
		$avatar_size = (int)$instance['avatar_size'];
		if(empty($avatar_size)){
			$avatar_size = 'null';
		}
		$count = (int)$instance['count'];
		if($count < 1){
			$count = 1;
		}
		
		if ( !empty( $user_array )|| $query!="null" ) {
			echo $before_widget;
			if ( $title)
			if (!$titlelink =='') { 
			     $title = '<a href="'. $titlelink . '" target="_blank" class="twitter-link-title">' .$title .'</a>';
			}
				echo $before_title . $title . $after_title;
				
		$id = rand(1,1000);
		$oauth_url = THEME_URI . '/includes/tweet/index.php';
		?>
		
		<script type="text/javascript">
				jQuery(document).ready(function($) {
					 jQuery("#twitter_wrap_<?php echo $id;?>").tweet({
					 	twitter_oauth_url: "<?php echo $oauth_url;?>",
						username: [<?php echo implode(',',$user_array);?>],
						count: <?php echo $count;?>,
						query: <?php echo $query;?>,
						avatar_size: <?php echo $avatar_size;?>,
						just_now_text: "<?php _e('just now','striking-r');?>",
						seconds_ago_text: "<?php _e('about %d seconds ago','striking-r');?>",
						a_minutes_ago_text: "<?php _e('about a minute ago','striking-r');?>",
						minutes_ago_text: "<?php _e('about %d minutes ago','striking-r');?>",
						a_hours_ago_text: "<?php _e('about an hour ago','striking-r');?>",
						hours_ago_text: "<?php _e('about %d hours ago','striking-r');?>",
						a_day_ago_text: "<?php _e('about a day ago','striking-r');?>",
						days_ago_text: "<?php _e('about %d days ago','striking-r');?>",
						view_text: "<?php _e('view tweet on twitter','striking-r');?>"
					 });
				});
		</script>
		<div id="twitter_wrap_<?php echo $id;?>"<?php if($avatar_size != 'null'):?> class="with_avatar"<?php endif;?>></div>
		<div class="clearboth"></div>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['titlelink'] = strip_tags($new_instance['titlelink']);		
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['avatar_size'] = $new_instance['avatar_size']?(int) $new_instance['avatar_size']:'';
		$instance['count'] = (int) $new_instance['count'];
		$instance['query'] = strip_tags($new_instance['query']);
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$titlelink = isset($instance['titlelink']) ? esc_attr($instance['titlelink']) : '';
		$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
		$avatar_size = isset($instance['avatar_size']) ? absint($instance['avatar_size']) : '';
		$query = isset($instance['query']) ? esc_attr($instance['query']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 3;
		$display = isset( $instance['display'] ) ? $instance['display'] : 'latest';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('titlelink'); ?>"><?php _e('Title Link:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('titlelink'); ?>" name="<?php echo $this->get_field_name('titlelink'); ?>" type="text" value="<?php echo $titlelink; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" /></p>
		
		<p>
			<?php _e("Note: Use ',' separate multi user.<br> (e.g <code>user1,user2</code>)", 'theme_admin');?>
		</p>
		
		<p><label for="<?php echo $this->get_field_id('avatar_size'); ?>"><?php _e('height and width of avatar if displayed (48px max)(Optional)&#x200E;', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('avatar_size'); ?>" name="<?php echo $this->get_field_name('avatar_size'); ?>" type="text" value="<?php echo $avatar_size; ?>" size="3" /></p>
		
		
		<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many tweets to display?', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>
		
		<p><label for="<?php echo $this->get_field_id('query'); ?>"><?php _e('Query (Optional)&#x200E;:', 'theme_admin'); ?></label>
		<textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('query'); ?>" name="<?php echo $this->get_field_name('query'); ?>"><?php echo $query; ?></textarea>
		
		<p>
			<?php _e("Query uses <a href='https://dev.twitter.com/docs/using-search' target='_blank'>Twitter's Search API</a>, so you can display any tweets you like.", 'theme_admin');?>
		</p>
<?php
	}
}
}