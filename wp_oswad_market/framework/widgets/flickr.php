<?php 
/*---------------------------------------------------------------------------------*/
/* Flickr widget */
/*---------------------------------------------------------------------------------*/
if(!class_exists('WP_Widget_Flickr')){
	class WP_Widget_Flickr extends WP_Widget {

		function WP_Widget_Flickr() {
			$widget_ops = array('description' => 'This Flickr widget populates photos from a Flickr ID.' );

			parent::__construct('flickr', __('WD - Flickr','wpdance'), $widget_ops);
		}

		function to_good_name( $input_str ){
			if( is_string($input_str) )
				return str_replace(" ","",$input_str);
			return $input_str;
		}

		function widget($args, $instance) {
			extract( $args );
			$id 			= $instance['id'];
			$number 		= absint($instance['number']);
			$type 			= 'user';
			$sorting 		= esc_attr($instance['sorting']);
			$size 			= esc_attr($instance['size']);
			$column_count 	=  3;
			$wd_flick_column = (int)$column_count;
			$cache_subname 	= implode ( "_", array_map(array($this,"to_good_name"),$instance) );
			
			echo $before_widget;
			echo $before_title;
			_e('Flickr','wpdance');
			echo $after_title;
			if($id){
					$cache_file = get_template_directory().'/cache_theme/flickr_'.$cache_subname.'.txt';
					$cachetime = 60*60;
					// Time that the cache was last filled.
					$cache_file_created = ((@file_exists($cache_file))) ? @filemtime($cache_file) : 0;
					// Show file from cache if still valid.
					if (time() - $cachetime < $cache_file_created) {
						include($cache_file);	
					} else {
						try{
							//$ch = curl_init();
							$url = 'http://www.flickr.com/badge_code_v2.gne?source='.$type.'&'.$type.'='.$id.'&count='.$number.'&display='.$sorting.'&layout=x&size='.$size;
							/*curl_setopt($ch,CURLOPT_URL,$url);
							curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
							curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
							$statuses = curl_exec($ch);
							curl_close($ch);
							*/		
							$args = array(
								'method'      =>    'GET',
								'timeout'     =>    5,
								'redirection' =>    5,
								'httpversion' =>    '1.0',
								'blocking'    =>    true,
								'headers'     =>    array(),
								'body'        =>    null,
								'cookies'     =>    array()
							);
							$statuses = wp_remote_get( $url, $args );
							if( !is_wp_error( $statuses ) ) {
								$statuses =  $statuses['body'];
								
								$math = preg_match_all('/<a.*?href="(.*?)".*?src="(.*?)".*?<\/a>/ism',$statuses,$match);
								$li_class = "";					
								ob_start();
									?>
								<div class="wrap <?php echo $class;?>">
									<div class="fix"></div>
									<?php foreach($match[0] as $index => $image){?>
									<?php 
										if( $index % $wd_flick_column == 0){
											$li_class = ' start';
										}else if( $index % $wd_flick_column == ($wd_flick_column-1) ){
											$li_class =  ' end';
										}else{
											$li_class =  '';
										}
									?>
									<div class="flickr_badge_image<?php echo $li_class;?>"><?php echo $image;?></div>
									<?php }?>	
									<div class="fix"></div>
									<a class="see-more button" href="http://www.flickr.com/photos/<?php echo $id; ?>"><?php _e('See more','wpdance'); ?></a>
								</div>

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
							}
						}catch(Excetion $e){
							$result = new StdClass();
							$result->status = array();
							return $result;
						}
					}
				}
			?>
			
		   <?php
		   echo $after_widget;
	   }

	   function update($new_instance, $old_instance) {
			$cache_file = get_template_directory().'/cache_theme/flickr_'.$new_instance['id'].'.txt';
			if(file_exists($cache_file))
				unlink($cache_file);
		   return $new_instance;
	   }

	   function form($instance) {
			$instance = wp_parse_args( (array) $instance, array( 
																'id' 			=> '88351014@N05' 
																,'number' 		=> 9 
																,'type' 		=> 'user' 
																,'sorting' 		=> 'latest'
																,'size' 		=> 's'
																,'column_count' => 3 
														) );
			$id = isset($instance['id']) ? esc_attr($instance['id']) : '';
			$number = isset($instance['number']) ? absint($instance['number']) : '';
			$type = isset($instance['type']) ? esc_attr($instance['type']) : '';
			$sorting = isset($instance['sorting']) ? esc_attr($instance['sorting']) : '';
			$size = isset($instance['size']) ? esc_attr($instance['size']) : '';
			$column_count = isset($instance['column_count']) ? absint($instance['column_count']) : '';
			?>
			<p>
				<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID (<a href="'.'http://www.idgettr.com'.'">idGettr</a>):','wpdance'); ?></label>
				<input type="text" name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo $id; ?>" class="widefat" id="<?php echo $this->get_field_id('id'); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number:','wpdance'); ?></label>
				<select name="<?php echo $this->get_field_name('number'); ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>">
					<?php for ( $i = 1; $i <= 10; $i += 1) { ?>
					<option value="<?php echo $i; ?>" <?php if($number == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</p>
			<!--<p>
				<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Type:','wpdance'); ?></label>
				<select name="<?php echo $this->get_field_name('type'); ?>" class="widefat" id="<?php echo $this->get_field_id('type'); ?>">
					<option value="user" <?php if($type == "user"){ echo "selected='selected'";} ?>><?php _e('User', 'wpdance'); ?></option>
					<option value="group" <?php if($type == "group"){ echo "selected='selected'";} ?>><?php _e('Group', 'wpdance'); ?></option>
				</select>
			</p>-->
			<p>
				<label for="<?php echo $this->get_field_id('sorting'); ?>"><?php _e('Sorting:','wpdance'); ?></label>
				<select name="<?php echo $this->get_field_name('sorting'); ?>" class="widefat" id="<?php echo $this->get_field_id('sorting'); ?>">
					<option value="latest" <?php if($sorting == "latest"){ echo "selected='selected'";} ?>><?php _e('Latest', 'wpdance'); ?></option>
					<option value="random" <?php if($sorting == "random"){ echo "selected='selected'";} ?>><?php _e('Random', 'wpdance'); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Size:','wpdance'); ?></label>
				<select name="<?php echo $this->get_field_name('size'); ?>" class="widefat" id="<?php echo $this->get_field_id('size'); ?>">
					<option value="s" <?php if($size == "s"){ echo "selected='selected'";} ?>><?php _e('Square', 'wpdance'); ?></option>
					<option value="m" <?php if($size == "m"){ echo "selected='selected'";} ?>><?php _e('Medium', 'wpdance'); ?></option>
					<option value="t" <?php if($size == "t"){ echo "selected='selected'";} ?>><?php _e('Thumbnail', 'wpdance'); ?></option>
				</select>
			</p>
			<!--<p>
				<label for="<?php echo $this->get_field_id('column_count'); ?>"><?php _e('Numper of images per row','wpdance'); ?></label>
				<input type="text" name="<?php echo $this->get_field_name('column_count'); ?>" value="<?php echo $column_count; ?>" class="widefat" id="<?php echo $this->get_field_id('column_count'); ?>" />
			</p>-->
			<?php
		}
	}
}
?>