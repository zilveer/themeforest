<?php
/*
* social media widget - links
*/

class SocialMediaWidget extends WP_Widget {

	function SocialMediaWidget() {
		$widget_ops = array(
			'classname'   => 'social_widget',
			'description' => __('Link to your RSS feed and social media accounts.', 'ch')
		);
		parent::__construct('social_networks', __('Believe - Social Network links', 'ch'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Social Media', 'ch') : $instance['title'], $instance, $this->id_base);

		$networks['RSS']        = $instance['rss'];
		$networks['Twitter']    = $instance['twitter'];
		$networks['Facebook']   = $instance['facebook'];
		$networks['Flickr']     = $instance['flickr'];
		$networks['YouTube']    = $instance['youtube'];
		$networks['LinkedIn']   = $instance['linkedin'];
		$networks['FourSquare'] = $instance['foursquare'];
		$networks['Delicious']  = $instance['delicious'];
		$networks['Digg']       = $instance['digg'];
		$networks['Skype']      = $instance['skype'];
		$networks['Tumblr']     = $instance['tumblr'];
		$networks['Vimeo']      = $instance['vimeo'];
		$networks['Instagram']  = $instance['instagram'];
		$networks['Pintrest']   = $instance['pintrest'];
		$networks['Google']     = $instance['google'];

		$display = $instance['display'];

		echo $before_widget;

		// Show title
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		}

		?>

		<ul class="social_links">
			<?php if (empty($networks['RSS'])) { ?>
				<li><a href="<?php bloginfo('rss2_url'); ?>" onclick="window.open(this.href); return false;" class="rss">RSS</a></li>
			<?php } else { ?>
				<li><a href="<?php echo $networks['RSS'] ?>" onclick="window.open(this.href); return false;" class="rss">RSS</a></li>
			<?php }
				foreach(array("Twitter", "Facebook", "Flickr", "YouTube", "LinkedIn", "FourSquare", "Delicious", "Digg", "Skype", "Tumblr", "Vimeo", "Instagram", "Pintrest", "Google") as $network) {
					if (!empty($networks[$network])) { ?>
					<li><a href="<?php echo addhttp($networks[$network]); ?>" class="<?php echo strtolower($network); ?>" onclick="window.open(this.href); return false;"><?php echo $network; ?></a></li>
				<?php }
				} ?>
		</ul>
		<div class="clearfix"></div>

		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance               = $old_instance;
		$instance['title']      = strip_tags($new_instance['title']);
		$instance['title_link'] = $new_instance['title_link'];
		$instance['rss']        = $new_instance['rss'];
		$instance['twitter']    = $new_instance['twitter'];
		$instance['facebook']   = $new_instance['facebook'];
		$instance['flickr']     = $new_instance['flickr'];
		$instance['youtube']    = $new_instance['youtube'];
		$instance['linkedin']   = $new_instance['linkedin'];
		$instance['foursquare'] = $new_instance['foursquare'];
		$instance['delicious']  = $new_instance['delicious'];
		$instance['digg']       = $new_instance['digg'];
		$instance['display']    = $new_instance['display'];
		$instance['skype']      = $new_instance['skype'];
		$instance['tumblr']     = $new_instance['tumblr'];
		$instance['vimeo']      = $new_instance['vimeo'];
		$instance['instagram']  = $new_instance['instagram'];
		$instance['pintrest']   = $new_instance['pintrest'];
		$instance['google']     = $new_instance['google'];

		return $instance;
	}

	function form($instance) {
		$instance   = wp_parse_args((array) $instance, array('title' => '', 'text' => '', 'title_link' => ''));
		$title      = strip_tags($instance['title']);
		$rss        = $instance['rss'];
		$twitter    = $instance['twitter'];
		$facebook   = $instance['facebook'];
		$flickr     = $instance['flickr'];
		$youtube    = $instance['youtube'];
		$linkedin   = $instance['linkedin'];
		$foursquare = $instance['foursquare'];
		$delicious  = $instance['delicious'];
		$digg       = $instance['digg'];
		$display    = $instance['display'];
		$skype      = $instance['skype'];
		$tumblr     = $instance['tumblr'];
		$vimeo      = $instance['vimeo'];
		$instagram  = $instance['instagram'];
		$pintrest   = $instance['pintrest'];
		$google     = $instance['google'];
		$text       = format_to_edit($instance['text']);
	?>
		<p style="color:#999;">
			<em>Enter the full URL to each of your social media accounts. Leave the field blank if you wish not to display social media link.</em>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS URL: (leave empty for default feed)', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo esc_attr($rss); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo esc_attr($flickr); ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('Youtube URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo esc_attr($youtube); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('LinkedIn URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('foursquare'); ?>"><?php _e('FourSquare URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('foursquare'); ?>" name="<?php echo $this->get_field_name('foursquare'); ?>" type="text" value="<?php echo esc_attr($foursquare); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('delicious'); ?>"><?php _e('Delicious URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('delicious'); ?>" name="<?php echo $this->get_field_name('delicious'); ?>" type="text" value="<?php echo esc_attr($delicious); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('digg'); ?>"><?php _e('Digg URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('digg'); ?>" name="<?php echo $this->get_field_name('digg'); ?>" type="text" value="<?php echo esc_attr($digg); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('skype'); ?>"><?php _e('Skype URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" type="text" value="<?php echo esc_attr($skype); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e('Tumblr URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" name="<?php echo $this->get_field_name('tumblr'); ?>" type="text" value="<?php echo esc_attr($tumblr); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo esc_attr($instagram); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('pintrest'); ?>"><?php _e('Pintrest URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('pintrest'); ?>" name="<?php echo $this->get_field_name('pintrest'); ?>" type="text" value="<?php echo esc_attr($pintrest); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('google'); ?>"><?php _e('Google+ URL:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" type="text" value="<?php echo esc_attr($google); ?>" />
		</p>
<?php
	}
}

register_widget('SocialMediaWidget');