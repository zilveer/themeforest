<?php
	//KIDSZONE FOOTER FORM WIDGET CLASS...
	class MY_SocialWidget extends WP_Widget
	{
		function __construct() {
			parent::__construct(false, $name = IAMD_THEME_NAME.__(' Footer Social Widget', 'iamd_text_domain'), array( 'description' => __('Social Profile Widget.', 'iamd_text_domain') ) );
		}
		
	    function widget($args, $instance)
		{
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);

			echo '<div class="widget widget_social_profile">';
				echo '<h3 class="widgettitle">'.$title.'<span></span></h3>';
				if(dt_theme_option('general', 'show-sociables')): ?>                
					<ul class="social-media"><?php
						$socials = dt_theme_option('social');
						if($socials != null):
							foreach($socials as $social):
								$link = $social['link'];
								$icon = $social['icon'];
								echo "<li>";
								echo "<a class='fa {$icon}' href='{$link}'></a>";
								echo "</li>";
							endforeach;
						else:
							echo "<div class='error message'><span class='icon'></span>".__('Please add social icons in general settings.', 'iamd_text_domain')."</div>";
						endif; ?>
					</ul><?php
				else:
					echo "<div class='error message'><span class='icon'></span>".__('Please enable social icons in general settings.', 'iamd_text_domain')."</div>";
				endif;
			echo '</div>';
	    }	

	    function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title']);
			return $instance;
	    }

    	function form($instance)
		{ ?><p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label><input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if(isset($instance['title'])) echo $instance['title']; ?>" class="widefat"/></p><?php
	    }
	}

	add_action('widgets_init', 'custom_theme_load_widgets');
	function custom_theme_load_widgets()
	{
		register_widget('MY_SocialWidget');
	}	
?>