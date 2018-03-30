<?php 
if(!class_exists('WP_Widget_Twitterupdate')){
	/**
	 * Twitter Update Widget class
	 *
	 */
	class WP_Widget_Twitterupdate extends WP_Widget {

		function __construct() {
			$widget_ops = array('classname' => 'widget_twitterupdate', 'description' => __('Twitter Widget','wpdance'));
			parent::__construct('twitterupdate', __('WD - Twitter','wpdance'), $widget_ops);
		}
		
		function to_good_name( $input_str ){
			if( is_string($input_str) )
				return str_replace(" ","",$input_str);
			return $input_str;
		}
		
		function widget( $args, $instance ) {
			extract($args);
			$title = apply_filters( 'widget_title', empty($instance['title']) ? __('Twitter Update','wpdance') : $instance['title'], $instance, $this->id_base);
			$cache_subname = implode ( "_", array_map(array($this,"to_good_name"),$instance) );

			$instance['username'] = esc_attr($instance['username']);
			//change your own key here
			
			$_consumer_key 			= "diqJlQnUitiOrqoJTGOK8Q";
			$_consumer_secret 		= "RZ8U79iAAooscyd0fZjzAoqBfdrgLNehm0QJMabA";
			$_access_token 			= "859121024-nayLlfxEnETi0bbM1tPjrm3WWkrxHIk5a6WpppxJ";
			$_access_token_secret	= "9aEuTIDHnohxVcv7UFzctQYOwDSOgcx1GKq9ELAnI";

			//end key config
			
			echo $before_widget;
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
			if($instance['username']){
				$cache_file = get_template_directory().'/cache_theme/twitter_'.$cache_subname.'.txt';
				// Seconds to cache feed (1 hour).
				$cachetime = 60*60;
				// Time that the cache was last filled.
				$cache_file_created = ((@file_exists($cache_file))) ? @filemtime($cache_file) : 0;
				// Show file from cache if still valid.
				if ( (time() - $cachetime < $cache_file_created) ) {
					include($cache_file);	
				} else {
					try{
						if(!$limit = $instance['limit'])
							$limit = 5;
						$connection = new TwitterOAuth($_consumer_key, $_consumer_secret,$_access_token,$_access_token_secret);
						
						$statuses =  $connection->get('statuses/user_timeline', array(
							'screen_name' 	=> $instance['username']
							,'include_rts'	=>	1
							,'count'		=>	$limit
							));		
	
						ob_start();
						$_success = true;
						if( isset($statuses->errors) ){
							$_success = false;
						}
								?>
								<div id="twitter-box" style="overflow: hidden;">
									<?php if( !empty($statuses) && $_success ):?>
									<ul id="twitter-list">
										<?php 
										$i = 0 ;
										$class =  "";
										
										foreach($statuses as $status){
											$class = ($i == 0 ? 'first' : ($i==(count($statuses)-1) ? "last" : ''));
											$i++;
										?>
										<li class="status-item <?php echo $class;?>">
											<span class="tweet-content"><?php echo $status->text;?></span>
											<div class="name-time"></div>
											<div class="date-time">
												<a href="<?php echo 'http://twitter.com/'.$status->user->screen_name.'/statuses/'.$status->id; ?>"><?php echo $this->date_format($status->created_at); ?></a>
											</div>
											<div class="user">
												<span><?php _e(' by ','wpdance'); ?></span>
												<a href="<?php echo 'http://twitter.com/'.$status->user->screen_name; ?>" target="_blank"><?php echo $status->user->name; ?></a>
											</div>
											<div class="avatar"><img src="<?php echo $status->user->profile_image_url;?>" title="<?php echo $status->user->screen_name;?>" alt="<?php echo $status->user->screen_name;?>"></div>
										</li>
										<?php };?>
									</ul>
								<a href="http://twitter.com/<?php echo $instance['username']?>"><span class="twitter-follow"></span></a>
									<?php endif;?>				
								</div><!-- #ticker-wrapper -->
					<?php 
						// Save the contents of output buffer to the file, and flush the buffer. 
						global $wp_filesystem;
						if( empty( $wp_filesystem ) ) {
							require_once( ABSPATH .'/wp-admin/includes/file.php' );
							WP_Filesystem();
						}

						if( $wp_filesystem ) {
							$wp_filesystem->put_contents(
								$cache_file,
								ob_get_contents(),
								FS_CHMOD_FILE // predefined mode settings for WP files
							);
						}
						
						ob_end_flush();
					}catch(Excetion $e){
						$result = new StdClass();
						$result->status = array();
						return $result;
					}
				}
			}
			echo $after_widget;
		}
		
		function relativeTime($time)
		{
			//echo $time,'<br>';
			//echo $time = strtotime($time);
			$second = 1;
			$minute = 60 * $second;
			$hour = 60 * $minute;
			$day = 24 * $hour;
			$month = 30 * $day;

			$delta = strtotime('+0 hours') - strtotime($time);
			if ($delta < 2 * $minute) {
				return "1 min ago";
			}
			if ($delta < 45 * $minute) {
				return floor($delta / $minute) . " min ago";
			}
			if ($delta < 90 * $minute) {
				return "1 hour ago";
			}
			if ($delta < 24 * $hour) {
				return floor($delta / $hour) . " hours ago";
			}
			if ($delta < 48 * $hour) {
				return "yesterday";
			}
			if ($delta < 30 * $day) {
				return floor($delta / $day) . " days ago";
			}
			if ($delta < 12 * $month) {
				$months = floor($delta / $day / 30);
				return $months <= 1 ? "1 month ago" : $months . " months ago";
			} else {
				$years = floor($delta / $day / 365);
				return $years <= 1 ? "1 year ago" : $years . " years ago";
			}
		}
		
		function date_format($time){
			return mysql2date(get_option('date_format'),$time);
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = esc_attr($new_instance['title']);
			$instance['username'] = esc_attr($new_instance['username']);
			$instance['limit'] = absint($new_instance['limit']);
			$cache_file = get_template_directory().'/cache_theme/twitter_'.$instance['username'].'.txt';
			if(file_exists($cache_file))
				unlink($cache_file);
			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'Follow Us', 'limit' => 5 ,'username' => 'wpdance') );
			$title = esc_attr($instance['title']);
			$username = esc_attr($instance['username']);
			$limit = absint($instance['limit']);
	?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','wpdance'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username twitter:','wpdance'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:','wpdance'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr($limit); ?>" /></p>
	<?php
		}
	}
}
?>