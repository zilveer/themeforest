<?php

add_action( 'widgets_init', 'my_widget' );

function my_widget() {
	register_widget( 'MY_Widget' );
}

class MY_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'the_retailer_connect', 'description' => __('A widget that displays customized social icons ', 'theretailer') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'the_retailer_connect' );
		
		parent::__construct( 'the_retailer_connect', __('Social Media Profiles', 'theretailer'), $widget_ops, $control_ops );
	}
	
	public function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$facebook = $instance['facebook'];
		$pinterest = $instance['pinterest'];
		$linkedin = $instance['linkedin'];
		$twitter = $instance['twitter'];
		$googleplus = $instance['googleplus'];
		$rss = $instance['rss'];
		$tumblr = $instance['tumblr'];
		$instagram = $instance['instagram'];
		$youtube = $instance['youtube'];
		$vimeo = $instance['vimeo'];
		$behance = $instance['behance'];
		$dribble = $instance['dribble'];
		$flickr = $instance['flickr'];
		$git = $instance['git'];
		$skype = $instance['skype'];
		$weibo = $instance['weibo'];
		$foursquare = $instance['foursquare'];
		$soundcloud = $instance['soundcloud'];
		$vk = $instance['vk'];
		$snapchat = $instance['snapchat'];
		$houzz = $instance['houzz'];
		
		echo $before_widget;

		// Display the widget title 
		if ( $title ) echo $before_title . $title . $after_title;

		//Display icons
		if ( $facebook ) echo('<a href="' . $facebook . '" target="_blank" class="widget_connect_facebook">Facebook</a>' );
		if ( $pinterest ) echo('<a href="' . $pinterest . '" target="_blank" class="widget_connect_pinterest">Pinterest</a>' );
		if ( $linkedin ) echo('<a href="' . $linkedin . '" target="_blank" class="widget_connect_linkedin">Linkedin</a>' );
		if ( $twitter ) echo('<a href="' . $twitter . '" target="_blank" class="widget_connect_twitter">Twitter</a>' );
		if ( $googleplus ) echo('<a href="' . $googleplus . '" target="_blank" class="widget_connect_googleplus">Google+</a>' );
		if ( $rss ) echo('<a href="' . $rss . '" target="_blank" class="widget_connect_rss">RSS</a>' );
		if ( $tumblr ) echo('<a href="' . $tumblr . '" target="_blank" class="widget_connect_tumblr">Tumblr</a>' );
		if ( $instagram ) echo('<a href="' . $instagram . '" target="_blank" class="widget_connect_instagram">Instagram</a>' );
		if ( $youtube ) echo('<a href="' . $youtube . '" target="_blank" class="widget_connect_youtube">Youtube</a>' );
		if ( $vimeo ) echo('<a href="' . $vimeo . '" target="_blank" class="widget_connect_vimeo">Vimeo</a>' );
		if ( $behance ) echo('<a href="' . $behance . '" target="_blank" class="widget_connect_behance">Behance</a>' );
		if ( $dribble ) echo('<a href="' . $dribble . '" target="_blank" class="widget_connect_dribble">Dribble</a>' );
		if ( $flickr ) echo('<a href="' . $flickr . '" target="_blank" class="widget_connect_flickr">Flickr</a>' );
		if ( $git ) echo('<a href="' . $git . '" target="_blank" class="widget_connect_git">Git</a>' );
		if ( $skype ) echo('<a href="' . $skype . '" target="_blank" class="widget_connect_skype">Skype</a>' );
		if ( $weibo ) echo('<a href="' . $weibo . '" target="_blank" class="widget_connect_weibo">Weibo</a>' );
		if ( $foursquare ) echo('<a href="' . $foursquare . '" target="_blank" class="widget_connect_foursquare">Foursquare</a>' );
		if ( $soundcloud ) echo('<a href="' . $soundcloud . '" target="_blank" class="widget_connect_soundcloud">Soundcloud</a>' );
		if ( $vk ) echo('<a href="' . $vk . '" target="_blank" class="widget_connect_vk">VK</a>' );
		if ( $snapchat ) echo('<a href="' . $snapchat . '" target="_blank" class="widget_connect_snapchat">Snapchat</a>' );
		if ( $houzz ) echo('<a href="' . $houzz . '" target="_blank" class="widget_connect_houzz">Houzz</a>' );
		
		echo $after_widget;
	}

	//Update the widget 
	 
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['rss'] = strip_tags( $new_instance['rss'] );
		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
		$instance['behance'] = strip_tags( $new_instance['behance'] );
		$instance['dribble'] = strip_tags( $new_instance['dribble'] );
		$instance['flickr'] = strip_tags( $new_instance['flickr'] );
		$instance['git'] = strip_tags( $new_instance['git'] );
		$instance['skype'] = strip_tags( $new_instance['skype'] );
		$instance['weibo'] = strip_tags( $new_instance['weibo'] );
		$instance['foursquare'] = strip_tags( $new_instance['foursquare'] );
		$instance['soundcloud'] = strip_tags( $new_instance['soundcloud'] );
		$instance['vk'] = strip_tags( $new_instance['vk'] );
		$instance['snapchat'] = strip_tags( $new_instance['snapchat'] );
		$instance['houzz'] = strip_tags( $new_instance['houzz'] );

		return $instance;
	}

	
	public function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 
			'title' => __('The Retailer Connect', 'theretailer'),
			'facebook' => '',
			'pinterest' => '',
			'linkedin' => '',
			'twitter' => '',
			'googleplus' => '',
			'rss' => '',
			'tumblr' => '',
			'instagram' => '',
			'youtube' => '',
			'vimeo' => '',
			'behance' => '',
			'dribble' => '',
			'flickr' => '',
			'git' => '',
			'skype' => '',
			'weibo' => '',
			'foursquare' => '',
			'soundcloud' => '',
			'vk' => '',
			'snapchat' => '',
			'houzz' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget title:', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('Pinterest URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('LinkedIn URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e('Google+ URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" value="<?php echo $instance['googleplus']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('RSS URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>"><?php _e('Tumblr URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" value="<?php echo $instance['tumblr']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e('Instagram URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo $instance['instagram']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('Youtube URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e('Vimeo URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'behance' ); ?>"><?php _e('Behance URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" value="<?php echo $instance['behance']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'dribble' ); ?>"><?php _e('Dribble URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'dribble' ); ?>" name="<?php echo $this->get_field_name( 'dribble' ); ?>" value="<?php echo $instance['dribble']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e('Flickr URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'git' ); ?>"><?php _e('Git URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'git' ); ?>" name="<?php echo $this->get_field_name( 'git' ); ?>" value="<?php echo $instance['git']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e('Skype URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" value="<?php echo $instance['skype']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'weibo' ); ?>"><?php _e('Weibo URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'weibo' ); ?>" name="<?php echo $this->get_field_name( 'weibo' ); ?>" value="<?php echo $instance['weibo']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'foursquare' ); ?>"><?php _e('Foursquare URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'foursquare' ); ?>" name="<?php echo $this->get_field_name( 'foursquare' ); ?>" value="<?php echo $instance['foursquare']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'soundcloud' ); ?>"><?php _e('Soundcloud URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'soundcloud' ); ?>" name="<?php echo $this->get_field_name( 'soundcloud' ); ?>" value="<?php echo $instance['soundcloud']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'vk' ); ?>"><?php _e('VK URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'vk' ); ?>" name="<?php echo $this->get_field_name( 'vk' ); ?>" value="<?php echo $instance['vk']; ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'snapchat' ); ?>"><?php _e('Snapchat URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'snapchat' ); ?>" name="<?php echo $this->get_field_name( 'snapchat' ); ?>" value="<?php echo $instance['snapchat']; ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'houzz' ); ?>"><?php _e('Houzz URL', 'theretailer'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'houzz' ); ?>" name="<?php echo $this->get_field_name( 'houzz' ); ?>" value="<?php echo $instance['houzz']; ?>" class="widefat" />
		</p>

	<?php
	}
}

?>