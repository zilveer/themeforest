<?php
/**
 * EW Social Widget
 */
if(!class_exists('WP_Widget_Ew_social')){
	class WP_Widget_Ew_social extends WP_Widget {

		function WP_Widget_Ew_social() {
			$widgetOps = array('classname' => 'widget_social', 'description' => __('Display Social Profiles','wpdance'));
			$controlOps = array('width' => 400, 'height' => 350);
			parent::__construct('ew_social', __('WD - Social Profiles','wpdance'), $widgetOps, $controlOps);
		}

		function widget( $args, $instance ) {
			extract($args);
			$title = esc_attr(apply_filters( 'widget_title', $instance['title'] ));
			$feedburner_id = str_replace(" ","",esc_attr($instance['feedburner_id']));
			$twitter_id = str_replace(" ","",esc_attr($instance['twitter_id']));
			$facebook_id = str_replace(" ","",esc_attr($instance['facebook_id']));
			$google_plus_id = str_replace(" ","",esc_attr($instance['google_plus_id']));		
			$flickr_id = str_replace(" ","",esc_attr($instance['flickr_id']));
			$vimeo_id = str_replace(" ","",esc_attr($instance['vimeo_id']));
			$show_tooltip = ($instance['show_tooltip'])?true:false;
			
			$tooltip_class = ($show_tooltip)?'wd_tooltip':'';
			?>
			<?php echo $before_widget;?>
			<?php echo $before_title . $title . $after_title;?>
			<div class="social-icons">
				<div class="widget_desc social_desc">
					<?php echo $instance['desc']?>
				</div>
				<ul>
					<?php if( $facebook_id !== "" ): ?>
						<li class="icon-facebook"><a href="http://www.facebook.com/<?php echo $facebook_id; ?>" target="_blank" title="<?php echo (!$show_tooltip)?__('Become our fan', 'wpdance'):''; ?>" ><span class="<?php echo $tooltip_class; ?>"><?php _e('Facebook', 'wpdance'); ?></span></a><span><?php _e('Become our fan', 'wpdance'); ?></span></li>				
					<?php endif; ?>
					<?php if( $twitter_id !== "" ): ?>
						<li class="icon-twitter"><a href="http://twitter.com/<?php echo $twitter_id; ?>" target="_blank" title="<?php echo (!$show_tooltip)?__('Follow us', 'wpdance'):''; ?>" ><span class="<?php echo $tooltip_class; ?>"><?php _e('Twitter', 'wpdance'); ?></span></a><span><?php _e('Follow us', 'wpdance'); ?></span></li>
					<?php endif; ?>
					<?php if( $flickr_id !== "" ): ?>
						<li class="icon-flickr"><a href="http://www.flickr.com/photos/<?php echo $flickr_id;?>" target="_blank" title="<?php echo (!$show_tooltip)?__('See Us', 'wpdance'):''; ?>" ><span class="<?php echo $tooltip_class; ?>"><?php _e('Flickr', 'wpdance'); ?></span></a><span><?php _e('See Us', 'wpdance'); ?></span></li>
					<?php endif; ?>
					<?php if( $google_plus_id !== "" ): ?>
						<li class="icon-google"><a href="https://plus.google.com/<?php echo $google_plus_id; ?>" target="_blank" title="<?php echo (!$show_tooltip)?__('Join our circle', 'wpdance'):''; ?>"  ><span class="<?php echo $tooltip_class; ?>"><?php _e('Google Plus', 'wpdance'); ?></span></a><span><?php _e('Join our circle', 'wpdance'); ?></span></li>
					<?php endif; ?>
					<?php if( $feedburner_id !== "" ): ?>
						<li class="icon-rss"><a href="http://feeds.feedburner.com/<?php echo $feedburner_id; ?>" target="_blank" title="<?php echo (!$show_tooltip)?__('Get updates', 'wpdance'):''; ?>" ><span class="<?php echo $tooltip_class; ?>"><?php _e('RSS', 'wpdance'); ?></span></a><span><?php _e('Get updates', 'wpdance'); ?></span></li>
					<?php endif; ?>
					<?php if( $vimeo_id !== "" ): ?>
						<li class="icon-vimeo"><a href="http://vimeo.com/<?php echo $vimeo_id;?>" target="_blank" title="<?php echo (!$show_tooltip)?__('Watch Us', 'wpdance'):''; ?>" ><span class="<?php echo $tooltip_class; ?>"><?php _e('Vimeo', 'wpdance'); ?></span></a><span><?php _e('Watch Us', 'wpdance'); ?></span></li>
					<?php endif; ?>
				</ul>
				<div class="clear"></div>
			</div>

			<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['feedburner_id'] = $new_instance['feedburner_id'];
			$instance['twitter_id'] =  $new_instance['twitter_id'];
			$instance['facebook_id'] =  $new_instance['facebook_id'];
			$instance['google_plus_id'] =  $new_instance['google_plus_id'];		
			$instance['title'] =  $new_instance['title'];
			$instance['desc'] =  $new_instance['desc'];		
			$instance['flickr_id'] =  $new_instance['flickr_id'];			
			$instance['vimeo_id'] =  $new_instance['vimeo_id'];			
			$instance['show_tooltip'] =  $new_instance['show_tooltip'];			
			
			
			return $instance;
		}

		function form( $instance ) { 
			$instance = wp_parse_args( (array) $instance, array( 
									'title' => 'Find Us On'
									, 'desc' => 'Social Connection'
									, 'feedburner_id' => 'Feedburner ID'
									, 'twitter_id' => 'Twitter ID'
									, 'facebook_id' => 'Facebook ID'
									, 'google_plus_id' => 'Google Plus ID'
									, 'flickr_id' => 'Flickr Id'
									, 'vimeo_id'=>'Vimeo ID' 
									, 'show_tooltip'=> 1 
								) );
			$feedburner_id = esc_attr($instance['feedburner_id']);
			$twitter_id = esc_attr(format_to_edit($instance['twitter_id']));
			$facebook_id = esc_attr(format_to_edit($instance['facebook_id']));
			$google_plus_id = esc_attr(format_to_edit($instance['google_plus_id']));	
				
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Enter your title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Enter your description','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" type="text" value="<?php echo $instance['desc']; ?>" /></p>
			
			<p><label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e('Enter your Feedburner ID','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo $feedburner_id; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Enter your Twitter ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $twitter_id; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('facebook_id'); ?>"><?php _e('Enter your Facebook ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('facebook_id'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" value="<?php echo $facebook_id; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('google_plus_id'); ?>"><?php _e('Enter your Google Plus ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('google_plus_id'); ?>" name="<?php echo $this->get_field_name('google_plus_id'); ?>" value="<?php echo $google_plus_id; ?>" /></p>		
			<p><label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Enter your Flickr ID','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo format_to_edit($instance['flickr_id']); ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('vimeo_id'); ?>"><?php _e('Enter your Vimeo ID','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('vimeo_id'); ?>" name="<?php echo $this->get_field_name('vimeo_id'); ?>" type="text" value="<?php echo format_to_edit($instance['vimeo_id']); ?>" /></p>
			<p><input class="" value="1" type="checkbox" id="<?php echo $this->get_field_id('show_tooltip'); ?>" name="<?php echo $this->get_field_name('show_tooltip'); ?>" <?php echo ($instance['show_tooltip'])?'checked':''; ?> />
			<label for="<?php echo $this->get_field_id('show_tooltip'); ?>"><?php _e('Show tooltip','wpdance'); ?></label></p>
			<?php }
	}
}

