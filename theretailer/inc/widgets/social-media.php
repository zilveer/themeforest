<?php

add_action( 'widgets_init', 'register_social_media_widget' );

function register_social_media_widget() {
	register_widget( 'Social_Media_Widget' );
}

class Social_Media_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'the_retailer_social_media', // Base ID
			__('The Retailer Social Media Profiles', 'theretailer'), // Name
			array( 'description' => __( 'A widget that displays Social Media Profiles', 'theretailer' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		
		global $theretailer_theme_options;
		
		$facebook = $theretailer_theme_options['social_media_facebook'];
		$pinterest = $theretailer_theme_options['social_media_pinterest'];
		$linkedin = $theretailer_theme_options['social_media_linkedin'];
		$twitter = $theretailer_theme_options['social_media_twitter'];
		$googleplus = $theretailer_theme_options['social_media_googleplus'];
		$rss = $theretailer_theme_options['social_media_rss'];
		$tumblr = $theretailer_theme_options['social_media_tumblr'];
		$instagram = $theretailer_theme_options['social_media_instagram'];
		$youtube = $theretailer_theme_options['social_media_youtube'];
		$vimeo = $theretailer_theme_options['social_media_vimeo'];
		$behance = $theretailer_theme_options['social_media_behance'];
		$dribble = $theretailer_theme_options['social_media_dribble'];
		$flickr = $theretailer_theme_options['social_media_flickr'];
		$git = $theretailer_theme_options['social_media_git'];
		$skype = $theretailer_theme_options['social_media_skype'];
		$weibo = $theretailer_theme_options['social_media_weibo'];
		$foursquare = $theretailer_theme_options['social_media_foursquare'];
		$soundcloud = $theretailer_theme_options['social_media_soundcloud'];
		$vk = $theretailer_theme_options['social_media_vk'];
		$snapchat = $theretailer_theme_options['social_media_snapchat'];
		$houzz = $theretailer_theme_options['social_media_houzz'];
		
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
		
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Get Connected', 'theretailer' );
		}
		?>
		
        <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'theretailer' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}