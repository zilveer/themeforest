<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Social Icons Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show counters for facebook/twitter/youtube/rss.
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','ct_social_icons_widget');

function ct_social_icons_widget() {
		register_widget("CT_Social_Icons");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Social_Icons extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_Social_Icons (){
		
		/* Widget settings. */	
		$widget_ops = array(	'classname'		=> 'ct-social-icons-widget',
								'description'	=> __( 'Social Icons Widget' , 'color-theme-framework' )
							);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 255,
								'height'	=> 350,
								'id_base'	=> 'ct-social-icons-widget'
							);
		
		/* Create the widget. */
		parent::__construct( 'ct-social-icons-widget', __( 'CT: Social Icons' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);

		/* Our variables from the widget settings. */
		$title = apply_filters ('widget_title', $instance ['title']);
		$twitter_url = $instance['twitter_url'];
		$facebook_url = $instance['facebook_url'];
		$youtube_url = $instance['youtube_url'];
		$linkedin_url = $instance['linkedin_url'];
		$android_url = $instance['android_url'];
		$apple_url = $instance['apple_url'];
		$dribbble_url = $instance['dribbble_url'];
		$github_url = $instance['github_url'];
		$flickr_url = $instance['flickr_url'];
		$instagram_url = $instance['instagram_url'];
		$skype_url = $instance['skype_url'];
		$pinterest_url = $instance['pinterest_url'];
		$google_url = $instance['google_url'];
		$rss_url = $instance['rss_url'];
		$background_title = $instance['background_title'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ){
			echo "\n<!-- START SOCIAL ICONS WIDGET -->\n";
			echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';
		} else {
			echo "\n<!-- START SOCIAL ICONS WIDGET -->\n";
		}
		?>

		<ul class="clearfix">
			<?php if ( !empty($twitter_url) ) : ?>
				<li>
					<a href="<?php echo $twitter_url; ?>" target="_blank" title="Twitter"><i class="icon-twitter ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($facebook_url) ) : ?>
				<li>
					<a href="<?php echo $facebook_url; ?>" target="_blank" title="Facebook"><i class="icon-facebook ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($youtube_url) ) : ?>
				<li>
					<a href="<?php echo $youtube_url; ?>" target="_blank" title="Youtube"><i class="icon-youtube ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($linkedin_url) ) : ?>
				<li>
					<a href="<?php echo $linkedin_url; ?>" target="_blank" title="Linkedin"><i class="icon-linkedin ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($android_url) ) : ?>
				<li>
					<a href="<?php echo $android_url; ?>" target="_blank" title="Android"><i class="icon-android ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($apple_url) ) : ?>
				<li>
					<a href="<?php echo $apple_url; ?>" target="_blank" title="Apple"><i class="icon-apple ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($dribbble_url) ) : ?>
				<li>
					<a href="<?php echo $dribbble_url; ?>" target="_blank" title="dribbble"><i class="icon-dribbble ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($github_url) ) : ?>
				<li>
					<a href="<?php echo $github_url; ?>" target="_blank" title="Github"><i class="icon-github-alt ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($flickr_url) ) : ?>
				<li>
					<a href="<?php echo $flickr_url; ?>" target="_blank" title="Flickr"><i class="icon-flickr ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($instagram_url) ) : ?>
				<li>
					<a href="<?php echo $instagram_url; ?>" target="_blank" title="Instagram"><i class="icon-instagram ct-transition"></i></a>
				</li>
			<?php endif; ?>
		
			<?php if ( !empty($skype_url) ) : ?>
				<li>
					<a href="<?php echo $skype_url; ?>" target="_blank" title="Skype"><i class="icon-skype ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($pinterest_url) ) : ?>
				<li>
					<a href="<?php echo $pinterest_url; ?>" target="_blank" title="Pinterest"><i class="icon-pinterest ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($google_url) ) : ?>
				<li>
					<a href="<?php echo $google_url; ?>" target="_blank" title="Google+"><i class="icon-google-plus ct-transition"></i></a>
				</li>
			<?php endif; ?>

			<?php if ( !empty($rss_url) ) : ?>
				<li>
					<a href="<?php echo $rss_url; ?>" target="_blank" title="RSS"><i class="icon-rss ct-transition"></i></a>
				</li>
			<?php endif; ?>
		</ul>

		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
		echo "\n<!-- END SOCIAL ICONS WIDGET -->\n";
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['twitter_url'] = $new_instance['twitter_url'];
		$instance['facebook_url'] = $new_instance['facebook_url'];
		$instance['youtube_url'] = $new_instance['youtube_url'];
		$instance['linkedin_url'] = $new_instance['linkedin_url'];
		$instance['android_url'] = $new_instance['android_url'];
		$instance['apple_url'] = $new_instance['apple_url'];
		$instance['dribbble_url'] = $new_instance['dribbble_url'];
		$instance['github_url'] = $new_instance['github_url'];
		$instance['flickr_url'] = $new_instance['flickr_url'];
		$instance['instagram_url'] = $new_instance['instagram_url'];
		$instance['skype_url'] = $new_instance['skype_url'];
		$instance['pinterest_url'] = $new_instance['pinterest_url'];
		$instance['google_url'] = $new_instance['google_url'];
		$instance['rss_url'] = $new_instance['rss_url'];
		$instance['background_title'] = strip_tags($new_instance['background_title']);
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array(	'title'				=> '', 
							'twitter_url'		=> 'http://twitter.com/zesky' , 
							'facebook_url'		=> 'https://www.facebook.com/colortheme', 
							'youtube_url'		=> '',
							'linkedin_url'		=> '',
							'android_url'		=> '',
							'apple_url'			=> '',
							'dribbble_url'		=> 'http://dribbble.com/zerge/',
							'github_url'		=> '',
							'flickr_url'		=> '',
							'instagram_url'		=> '',
							'skype_url'			=> '',
							'pinterest_url'		=> '',
							'google_url'		=> '',
							'rss_url'			=> '',
							'background_title'	=> '#ff0000'
						);
			
		$instance = wp_parse_args((array) $instance, $defaults); 
		$background_title = esc_attr($instance['background_title']); ?>

		<script type="text/javascript">
			//<![CDATA[
            jQuery(document).ready(function($) {  
                $('.ct-color-picker').wpColorPicker();  
            });  
			//]]>   
		</script>
		

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_url'); ?>"><?php _e( 'Twitter URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_url'); ?>" name="<?php echo $this->get_field_name('twitter_url'); ?>" value="<?php echo $instance['twitter_url']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('facebook_url'); ?>"><?php _e( 'Facebook URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('facebook_url'); ?>" name="<?php echo $this->get_field_name('facebook_url'); ?>" value="<?php echo $instance['facebook_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('youtube_url'); ?>"><?php _e( 'YouTube URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('youtube_url'); ?>" name="<?php echo $this->get_field_name('youtube_url'); ?>" value="<?php echo $instance['youtube_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('linkedin_url'); ?>"><?php _e( 'Linkedin URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('linkedin_url'); ?>" name="<?php echo $this->get_field_name('linkedin_url'); ?>" value="<?php echo $instance['linkedin_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('android_url'); ?>"><?php _e( 'Android URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('android_url'); ?>" name="<?php echo $this->get_field_name('android_url'); ?>" value="<?php echo $instance['android_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('apple_url'); ?>"><?php _e( 'Apple URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('apple_url'); ?>" name="<?php echo $this->get_field_name('apple_url'); ?>" value="<?php echo $instance['apple_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('dribbble_url'); ?>"><?php _e( 'dribbble URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('dribbble_url'); ?>" name="<?php echo $this->get_field_name('dribbble_url'); ?>" value="<?php echo $instance['dribbble_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('github_url'); ?>"><?php _e( 'Github URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('github_url'); ?>" name="<?php echo $this->get_field_name('github_url'); ?>" value="<?php echo $instance['github_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('flickr_url'); ?>"><?php _e( 'Flickr URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('flickr_url'); ?>" name="<?php echo $this->get_field_name('flickr_url'); ?>" value="<?php echo $instance['flickr_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('instagram_url'); ?>"><?php _e( 'Instagram URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('instagram_url'); ?>" name="<?php echo $this->get_field_name('instagram_url'); ?>" value="<?php echo $instance['instagram_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('skype_url'); ?>"><?php _e( 'Skype URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('skype_url'); ?>" name="<?php echo $this->get_field_name('skype_url'); ?>" value="<?php echo $instance['skype_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('pinterest_url'); ?>"><?php _e( 'Pinterest URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('pinterest_url'); ?>" name="<?php echo $this->get_field_name('pinterest_url'); ?>" value="<?php echo $instance['pinterest_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('google_url'); ?>"><?php _e( 'Google URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('google_url'); ?>" name="<?php echo $this->get_field_name('google_url'); ?>" value="<?php echo $instance['google_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('rss_url'); ?>"><?php _e( 'RSS URL:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('rss_url'); ?>" name="<?php echo $this->get_field_name('rss_url'); ?>" value="<?php echo $instance['rss_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" data-default-color="#72347d" />
		</p>

		<?php

	}
}
?>