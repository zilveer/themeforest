<?php

add_action( 'widgets_init', 'register_social_media_widget' );

function register_social_media_widget() {
	register_widget( 'Social_Media_Widget' );
}

class Social_Media_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'shopkeeper_social_media', // Base ID
			__('Shopkeeper Social Media Profiles', 'shopkeeper'), // Name
			array( 'description' => __( 'A widget that displays Social Media Profiles', 'shopkeeper' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		
		global $shopkeeper_theme_options;
		
		$facebook = "";
		$pinterest = "";
		$linkedin = "";
		$twitter = "";
		$googleplus = "";
		$rss = "";
		$tumblr = "";
		$instagram = "";
		$youtube = "";
		$vimeo = "";
		$behance = "";
		$dribble = "";
		$flickr = "";
		$git = "";
		$skype = "";
		$weibo = "";
		$foursquare = "";
		$soundcloud = "";
		$vk = "";
		
		if ( isset ($shopkeeper_theme_options['facebook_link']) ) $facebook = esc_url($shopkeeper_theme_options['facebook_link']);
		if ( isset ($shopkeeper_theme_options['pinterest_link']) ) $pinterest = esc_url($shopkeeper_theme_options['pinterest_link']);
		if ( isset ($shopkeeper_theme_options['linkedin_link']) ) $linkedin = esc_url($shopkeeper_theme_options['linkedin_link']);
		if ( isset ($shopkeeper_theme_options['twitter_link']) ) $twitter = esc_url($shopkeeper_theme_options['twitter_link']);
		if ( isset ($shopkeeper_theme_options['googleplus_link']) ) $googleplus = esc_url($shopkeeper_theme_options['googleplus_link']);
		if ( isset ($shopkeeper_theme_options['rss_link']) ) $rss = esc_url($shopkeeper_theme_options['rss_link']);
		if ( isset ($shopkeeper_theme_options['tumblr_link']) ) $tumblr = esc_url($shopkeeper_theme_options['tumblr_link']);
		if ( isset ($shopkeeper_theme_options['instagram_link']) ) $instagram = esc_url($shopkeeper_theme_options['instagram_link']);
		if ( isset ($shopkeeper_theme_options['youtube_link']) ) $youtube = esc_url($shopkeeper_theme_options['youtube_link']);
		if ( isset ($shopkeeper_theme_options['vimeo_link']) ) $vimeo = esc_url($shopkeeper_theme_options['vimeo_link']);
		if ( isset ($shopkeeper_theme_options['behance_link']) ) $behance = esc_url($shopkeeper_theme_options['behance_link']);
		if ( isset ($shopkeeper_theme_options['dribble_link']) ) $dribble = esc_url($shopkeeper_theme_options['dribble_link']);
		if ( isset ($shopkeeper_theme_options['flickr_link']) ) $flickr = esc_url($shopkeeper_theme_options['flickr_link']);
		if ( isset ($shopkeeper_theme_options['git_link']) ) $git = esc_url($shopkeeper_theme_options['git_link']);
		if ( isset ($shopkeeper_theme_options['skype_link']) ) $skype = esc_url($shopkeeper_theme_options['skype_link']);
		if ( isset ($shopkeeper_theme_options['weibo_link']) ) $weibo = esc_url($shopkeeper_theme_options['weibo_link']);
		if ( isset ($shopkeeper_theme_options['foursquare_link']) ) $foursquare = esc_url($shopkeeper_theme_options['foursquare_link']);
		if ( isset ($shopkeeper_theme_options['soundcloud_link']) ) $soundcloud = esc_url($shopkeeper_theme_options['soundcloud_link']);
		if ( isset ($shopkeeper_theme_options['vk_link']) ) $vk = esc_url($shopkeeper_theme_options['vk_link']);
		
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
		
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Get Connected', 'shopkeeper' );
		}
		?>
		
        <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'shopkeeper' ); ?></label> 
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