<?php
include_once str_replace("\\","/",get_template_directory()).'/inc/init.php';
class WebnusTwitterFeed extends WP_Widget{

	function __construct(){

		$params = array(
		'description'=> 'Twitter Feed',
		'name'=> 'Webnus-Twitter Feed'
		);

		parent::__construct('WebnusTwitterFeed', '', $params);

	}

	public function form($instance){


		extract($instance);
		?>

		<p>
		<label for="<?php echo $this->get_field_id('title') ?>">Title:</label>
		<input
		type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('title') ?>"
		name="<?php echo $this->get_field_name('title') ?>"
		value="<?php if( isset($title) )  echo esc_attr($title); ?>"
		/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('username') ?>">Twitter User Name:</label>
		<input
		type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('username') ?>"
		name="<?php echo $this->get_field_name('username') ?>"
		value="<?php if( isset($username) )  echo esc_attr($username); ?>"
		/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('count') ?>">Feed Count:</label>
		<input
		type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('count') ?>"
		name="<?php echo $this->get_field_name('count') ?>"
		value="<?php if( isset($count) )  echo esc_attr($count); ?>"
		/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('access_token') ?>">Access Token:</label>
		<input
		type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('access_token') ?>"
		name="<?php echo $this->get_field_name('access_token') ?>"
		value="<?php if( isset($access_token) )  echo esc_attr($access_token); ?>"
		/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('access_token_secret') ?>">Access Token Secret:</label>
		<input
		type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('access_token_secret') ?>"
		name="<?php echo $this->get_field_name('access_token_secret') ?>"
		value="<?php if( isset($access_token_secret) )  echo esc_attr($access_token_secret); ?>"
		/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('consumer_key') ?>">Consumer Key:</label>
		<input
		type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('consumer_key') ?>"
		name="<?php echo $this->get_field_name('consumer_key') ?>"
		value="<?php if( isset($consumer_key) )  echo esc_attr($consumer_key); ?>"
		/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('consumer_secret') ?>">Consumer Secret:</label>
		<input
		type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('consumer_secret') ?>"
		name="<?php echo $this->get_field_name('consumer_secret') ?>"
		value="<?php if( isset($consumer_secret) )  echo esc_attr($consumer_secret); ?>"
		/>
		</p>
		<?php 
	}
	
	
	public function widget($args, $instance){
		
		extract($args);
		extract($instance);
		?>
	
			<?php echo $before_widget; ?>
			<?php if(!empty($title)) echo $before_title.$title.$after_title; ?>
			
			
			
			<br />
			<div class="lts-tweets">
				<?php
				require_once get_template_directory() . '/inc/twitter/TwitterAPIExchange.php';

				/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
				$settings = array(
					'oauth_access_token' => $access_token,
					'oauth_access_token_secret' => $access_token_secret,
					'consumer_key' => $consumer_key,
					'consumer_secret' => $consumer_secret
				);

				$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
				$requestMethod = "GET";
				$user = $username;
				$getfield = "?screen_name=$user&count=$count";
				$twitter = new TwitterAPIExchange($settings);

				$string = json_decode($twitter->setGetfield($getfield)
				->buildOauth($url, $requestMethod)
				->performRequest(),$assoc = TRUE);
				if(isset($string["errors"][0]["message"])) {
					if($string["errors"][0]["message"] != "") {echo "<strong>Sorry, there was a problem.</strong><p>Twitter returned the following error message:</p><p><em>".$string["errors"][0]["message"]."</em></p>";}
				} else {
					echo '<ul class="tweets">';
						foreach($string as $items) {
							$items['text'] = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $items['text']);

							// Convert hashtags to twitter searches in <a> links
							$items['text'] = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $items['text']);

							// Convert attags to twitter profiles in <a> links
							$items['text'] = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $items['text']);

							// Formatting Twitter’s Date/Time
							$items['created_at'] = date("l M j \- g:ia",strtotime($items['created_at']));

							echo '<li class="tw-item"><i class="tw-icon fa-twitter"></i><div class="tw-content">' . $items['text'] . '<span class="tw-timestamp"><i class="fa-clock-o"></i> ' . $items['created_at'] . '</span></div></li>';
					    }
					echo '</ul>';
				} ?>
			</div>
			<?php 
				$o = new webnus_options();
				
			?>
			
				
			<?php echo $after_widget; ?><!-- end-follow2 -->

		<?php 
	} 
}

add_action('widgets_init', 'register_webnustwitterfeed'); 
function register_webnustwitterfeed(){
	
	register_widget('WebnusTwitterFeed');
	
}