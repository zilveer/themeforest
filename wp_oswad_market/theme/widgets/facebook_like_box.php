<?php
/**
 * Facebook Like Box Widget
 */
if(!class_exists('WP_Widget_Facebook_Like_Box')){
	class WP_Widget_Facebook_Like_Box extends WP_Widget {

		function WP_Widget_Facebook_Like_Box() {
			$widgetOps = array('classname' => 'wd_widget_facebook_like_box', 'description' => __('Display the Facebook like box','wpdance'));
			parent::__construct('wd_facebook_like_box', __('WD - Facebook Like Box','wpdance'), $widgetOps);
		}

		function widget( $args, $instance ) {
			
			extract($args);
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Find us on Facebook','wpdance') : $instance['title']);
			if( strlen(trim($instance['url'])) == 0 && strlen(trim($instance['page_id'])) == 0 ){
				return;
			}
			
			$url 			= esc_attr($instance['url']);
			$page_id 		= esc_attr($instance['page_id']);
			$color_scheme 	= $instance['color_scheme'];
			$show_faces 	= ($instance['show_faces'] == 1)?'true':'false';
			$stream 		= ($instance['stream'] == 1)?'true':'false';
			$header 		= ($instance['header'] == 1)?'true':'false';
			$connections 	= (absint($instance['connections']) == 0)?6:absint($instance['connections']);
			
			$facebook_link = '';
			if( strlen($url) > 24 ){
				$facebook_link = 'https://www.facebook.com/plugins/likebox.php?href='.$url;
			}
			else{
				$facebook_link = 'https://www.facebook.com/plugins/likebox.php?id='.$page_id;
			}
			?>
			<?php echo $before_widget;?>
			<?php echo $before_title . $title . $after_title; ?>
			<div class="wd_facebook_like_box_wrapper">
				<iframe src="<?php echo $facebook_link;?>&amp;width=250&amp;height=250&amp;connections=<?php echo $connections;?>&amp;colorscheme=<?php echo $color_scheme;?>&amp;show_faces=<?php echo $show_faces;?>&amp;stream=<?php echo $stream;?>&amp;header=<?php echo $header;?>&amp;show_border=false" 
					scrolling="no" frameborder="0" style="border:0px solid #fff; overflow:hidden; width:100%; height:250px;" allowTransparency="true">
				</iframe>
			</div>
			
			<div class="clear"></div>
			<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;	
			$instance['title'] 					=  strip_tags($new_instance['title']);
			$instance['url'] 					=  $new_instance['url'];
			$instance['page_id'] 				=  $new_instance['page_id'];
			$instance['color_scheme'] 			=  $new_instance['color_scheme'];
			$instance['show_faces'] 			=  $new_instance['show_faces'];
			$instance['stream'] 				=  $new_instance['stream'];									
			$instance['header'] 				=  $new_instance['header'];																	
			$instance['connections'] 			=  $new_instance['connections'];																	
			return $instance;
		}

		function form( $instance ) {
			$array_default = array(
							'title'					=> 'Find us on Facebook'
							,'url'					=> ''
							,'page_id'				=> ''
							,'color_scheme'			=> 'light'
							,'show_faces'			=> 1
							,'stream'				=> 0
							,'header'				=> 0
							,'connections'			=> 8
							);
							
			$instance = wp_parse_args( (array) $instance, $array_default );
			$instance['title'] 				= esc_attr($instance['title']);
			$instance['url'] 				= esc_attr($instance['url']);
			$instance['page_id'] 			= esc_attr($instance['page_id']);
			$instance['connections'] 		= esc_attr(absint($instance['connections']));
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Enter your title','wpdance'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Facebook page URL','wpdance'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $instance['url']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('page_id'); ?>"><?php _e('Facebook page ID','wpdance'); ?> : </label>
				<input class="widefat" id="<?php echo $this->get_field_id('page_id'); ?>" name="<?php echo $this->get_field_name('page_id'); ?>" type="text" value="<?php echo $instance['page_id']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('color_scheme'); ?>"><?php _e('Color scheme', 'wpdance'); ?> </label>
				<select class="widefat" id="<?php echo $this->get_field_id('color_scheme'); ?>" name="<?php echo $this->get_field_name('color_scheme'); ?>" >
					<option value="light" <?php selected($instance['color_scheme'], 'light'); ?> >Light</option>
					<option value="dark" <?php selected($instance['color_scheme'], 'dark'); ?> >Dark</option>
				</select>
			</p>
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" <?php echo ($instance['show_faces'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_faces'); ?>"><?php _e('Show Faces', 'wpdance'); ?></label>
			</p>
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('stream'); ?>" name="<?php echo $this->get_field_name('stream'); ?>" <?php echo ($instance['stream'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('stream'); ?>"><?php _e('Streams', 'wpdance'); ?></label>
			</p>
			<p>
				<input value="1" class="" type="checkbox" id="<?php echo $this->get_field_id('header'); ?>" name="<?php echo $this->get_field_name('header'); ?>" <?php echo ($instance['header'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('header'); ?>"><?php _e('Show header', 'wpdance'); ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('connections'); ?>"><?php _e('Connections', 'wpdance'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('connections'); ?>" name="<?php echo $this->get_field_name('connections'); ?>" type="text" value="<?php echo $instance['connections']; ?>" />
			</p>
			
			<?php }
	}
}

