<?php
/**
 * Instagram Widget
 */
if(!class_exists('WP_Widget_Instagram')){
	class WP_Widget_Instagram extends WP_Widget {

		function WP_Widget_Instagram() {
			$widgetOps = array('classname' => 'wd_widget_instagram', 'description' => __('Displays your latest Instagram photos','wpdance'));
			parent::__construct('wd_instagram', __('WD - Instagram','wpdance'), $widgetOps);
		}

		function widget( $args, $instance ) {
			
			extract($args);
			$title 		= apply_filters('widget_title', empty($instance['title']) ? __('Instagram', 'wpdance') : $instance['title']);
			$username 	= $instance['username'];
			$number 	= absint($instance['number']);
			$size 		= $instance['size'];
			$target 	= $instance['target'];

			echo $before_widget;
			echo $before_title . $title . $after_title;
			
			if( $username != '' ){
				$media_array = $this->scrape_instagram($username, $number);

				if ( is_wp_error($media_array) ) {

				   echo $media_array->get_error_message();

				} else {

					// filter for images only?
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );

					?>
					<div class="wd-instagram-wrapper">
						<div class="items">
						<?php						
						foreach ($media_array as $item) {
							echo '<div class="item">
								<a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'">
									<img src="'. esc_url($item[$size]['url']) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"/>
								</a>
							</div>';
						}
						?>
						</div>
						<a class="see-more button" href="//instagram.com/<?php echo trim($username); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>"><?php _e('View More', 'wpdance'); ?></a>
					</div>
					<?php
				}
			}
			?>
			<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;	
			$instance['title'] 					=  strip_tags($new_instance['title']);
			$instance['username'] 				=  $new_instance['username'];
			$instance['number'] 				=  $new_instance['number'];
			$instance['size'] 					=  $new_instance['size'];
			$instance['target'] 				=  $new_instance['target'];
																				
			return $instance;
		}

		function form( $instance ) {
			$array_default = array(
							'title'					=> 'Instagram'
							,'username'				=> ''
							,'number'				=> 9
							,'size'					=> 'thumbnail'
							,'target'				=> '_self'
							);
							
			$instance = wp_parse_args( (array) $instance, $array_default );
			$instance['title'] 			= esc_attr($instance['title']);
			$instance['username'] 		= esc_attr($instance['username']);
			$instance['number'] 		= esc_attr($instance['number']);
			$instance['size'] 			= esc_attr($instance['size']);
			$instance['target'] 		= esc_attr($instance['target']);
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Enter your title','wpdance'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username','wpdance'); ?> : </label>
				<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $instance['username']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos', 'wpdance'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo $instance['number']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Image size', 'wpdance'); ?> </label>
				<select class="widefat" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" >
					<option value="thumbnail" <?php selected($instance['size'], 'thumbnail'); ?> >Thumbnail</option>
					<option value="large" <?php selected($instance['size'], 'large'); ?> >Large</option>
				</select>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Target', 'wpdance'); ?> </label>
				<select class="widefat" id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" >
					<option value="_self" <?php selected($instance['target'], '_self'); ?> >Current window</option>
					<option value="_blank" <?php selected($instance['target'], '_blank'); ?> >New window</option>
				</select>
			</p>
			
			<?php 
		}
		
		function scrape_instagram($username, $slice = 9) {

			$username = strtolower($username);

			if (false === ($instagram = get_transient('wd-instagram-media-'.sanitize_title_with_dashes($username)))) {

				$remote = wp_remote_get('http://instagram.com/'.trim($username));

				if (is_wp_error($remote))
					return new WP_Error('site_down', __('Unable to communicate with Instagram.', 'wpdance'));

				if ( 200 != wp_remote_retrieve_response_code( $remote ) )
					return new WP_Error('invalid_response', __('Instagram did not return a 200.', 'wpdance'));

				$shards = explode('window._sharedData = ', $remote['body']);
				$insta_json = explode(';</script>', $shards[1]);
				$insta_array = json_decode($insta_json[0], TRUE);

				if (!$insta_array)
					return new WP_Error('bad_json', __('Instagram has returned invalid data.', 'wpdance'));

				$images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];

				$instagram = array();

				foreach ($images as $image) {

					if ($image['user']['username'] == $username) {

						$image['link']                          = preg_replace( "/^http:/i", "", $image['link'] );
						$image['images']['thumbnail']           = preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
						$image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );

						$instagram[] = array(
							'description'   => $image['caption']['text'],
							'link'          => $image['link'],
							'time'          => $image['created_time'],
							'comments'      => $image['comments']['count'],
							'likes'         => $image['likes']['count'],
							'thumbnail'     => $image['images']['thumbnail'],
							'large'         => $image['images']['standard_resolution'],
							'type'          => $image['type']
						);
					}
				}

				$instagram = base64_encode( serialize( $instagram ) );
				set_transient('wd-instagram-media-'.sanitize_title_with_dashes($username), $instagram, HOUR_IN_SECONDS*2);
			}

			$instagram = unserialize( base64_decode( $instagram ) );

			return array_slice($instagram, 0, $slice);
		}
		
		function images_only($media_item){
			if( $media_item['type'] == 'image' ){
				return true;
			}
			return false;
		}
	}
}

