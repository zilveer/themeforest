<?php
add_action('widgets_init', create_function('', 'return register_widget("adeodatus_social");'));

class adeodatus_social extends WP_Widget {
	function adeodatus_social() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Social Icons');	
	}

	function form($instance) {
		$socials = array('AddThis', 'Behance', 'Blogger', 'Delicious', 'Deviantart', 'Digg', 'Dopplr', 'Dribbble', 'Evernote', 'Facebook', 'Flickr', 'Forrst', 'Github', 'Google', 'Grooveshark', 'Instagram', 'Lastfm', 'Linkedin', 'Mail', 'Myspace', 'Paypal', 'Picasa', 'Pinterest', 'Posterous', 'Reddit', 'Rss', 'Sharethis', 'Skype', 'Soundcloud', 'Spotify', 'Stumbleupon', 'Tumblr', 'Viddler', 'Vimeo', 'Virb', 'Windows', 'Wordpress', 'Youtube', 'Twitter');
		$mainTitle = esc_attr($instance['mainTitle']);
		?>
			<p><label for="<?php echo $this->get_field_id('mainTitle'); ?>"><?php _e("Title:", THEME_NAME); ?> <input class="widefat" id="<?php echo $this->get_field_id('mainTitle'); ?>" name="<?php echo $this->get_field_name('mainTitle'); ?>" type="text" value="<?php echo $mainTitle; ?>" /></label></p>	

		
		<?php 
		
		foreach($socials as $social) {
			$title = esc_attr($instance[strtolower($social)]);
		

        ?>
            <p><label for="<?php echo $this->get_field_id(strtolower($social)); ?>"><?php _e("Account Url To ".$social.":", THEME_NAME); ?> <input class="widefat" id="<?php echo $this->get_field_id(strtolower($social)); ?>" name="<?php echo $this->get_field_name(strtolower($social)); ?>" type="text" value="<?php echo $title; ?>" /></label></p>	
        <?php 
		}
	}

	function update($new_instance, $old_instance) {
		$socials = array('AddThis', 'Behance', 'Blogger', 'Delicious', 'Deviantart', 'Digg', 'Dopplr', 'Dribbble', 'Evernote', 'Facebook', 'Flickr', 'Forrst', 'Github', 'Google', 'Grooveshark', 'Instagram', 'Lastfm', 'Linkedin', 'Mail', 'Myspace', 'Paypal', 'Picasa', 'Pinterest', 'Posterous', 'Reddit', 'Rss', 'Sharethis', 'Skype', 'Soundcloud', 'Spotify', 'Stumbleupon', 'Tumblr', 'Viddler', 'Vimeo', 'Virb', 'Windows', 'Wordpress', 'Youtube', 'Twitter');
		$instance = $old_instance;
		$instance['mainTitle'] = strip_tags($new_instance['mainTitle']);
		
		foreach($socials as $social) {
			$instance[strtolower($social)] = strip_tags($new_instance[strtolower($social)]);
			
		}

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$socials = array('AddThis', 'Behance', 'Blogger', 'Delicious', 'Deviantart', 'Digg', 'Dopplr', 'Dribbble', 'Evernote', 'Facebook', 'Flickr', 'Forrst', 'Github', 'Google', 'Grooveshark', 'Instagram', 'Lastfm', 'Linkedin', 'Mail', 'Myspace', 'Paypal', 'Picasa', 'Pinterest', 'Posterous', 'Reddit', 'Rss', 'Sharethis', 'Skype', 'Soundcloud', 'Spotify', 'Stumbleupon', 'Tumblr', 'Viddler', 'Vimeo', 'Virb', 'Windows', 'Wordpress', 'Youtube', 'Twitter');
		$mainTitle = apply_filters('widget_title', $instance['mainTitle']);
        ?>
	<?php //echo $before_widget; ?>
	<?php echo '<aside class="widget clearfix">'; ?>
		<?php if($mainTitle) echo $before_title.$mainTitle.$after_title; ?>
                <ul class="social-set">
					<?php
						foreach($socials as $social) {
							$title = apply_filters('widget_title', $instance[strtolower($social)]);
							if($title && $title!="") {
					?>
						<li><a href="<?php echo $title;?>" class="social-<?php echo strtolower($social);?>"></a></li>
						<?php } ?>
					<?php } ?>
                </ul>
	<?php echo $after_widget; ?>

        <?php
	}
}
?>