<?php
	//SOCIAL FORM WIDGET CLASS...
	class MY_SocialWidget extends WP_Widget
	{
		function __construct() {
			$widget_options = array("classname"=>'widget_social_profile', 'description'=>'To list social profile icons');
			parent::__construct(false,IAMD_THEME_NAME.__(' Social Widget','iamd_text_domain'),$widget_options);
		}

    	function form($instance)
		{ ?><p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'iamd_text_domain'); ?>:</label><input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if(isset($instance['title'])) echo $instance['title']; ?>" class="widefat"/></p><?php
	    }

	    function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title']);
			return $instance;
	    }

	    function widget($args, $instance)
		{
			extract($args);
			$title = empty($instance['title']) ?	'' : strip_tags($instance['title']);

			echo $before_widget;
			if ( !empty( $title ) ) echo $before_title.$title.$after_title;
				if(dt_theme_option('general', 'show-sociables')): ?>
					<ul class="dt-sc-social-icons"><?php
						$socials = dt_theme_option('social');
						if($socials != null):
							foreach($socials as $social):
								$link = esc_url($social['link']);
								$icon = esc_attr($social['icon']);
								echo "<li class='".substr($icon, 3)."'>";
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
			echo $after_widget;
	    }
	}

	add_action('widgets_init', 'custom_theme_load_widgets');
	function custom_theme_load_widgets()
	{
		register_widget('MY_SocialWidget');
	}	
?>