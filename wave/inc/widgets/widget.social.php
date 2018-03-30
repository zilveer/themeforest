<?php

add_action( 'widgets_init', create_function( '', 'register_widget( "dd_social_widget" );' ) );
class DD_Social_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'dd_social_widget', // Base ID
			'DD - Social', // Name
			array( 'description' => 'Show links to various social websites.' ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		$behance = $instance['behance'];
		$deviantart = $instance['deviantart'];
		$dribbble = $instance['dribbble'];
		$facebook = $instance['facebook'];
		$flickr = $instance['flickr'];
		$forrst = $instance['forrst'];
		$github = $instance['github'];
		$googleplus = $instance['googleplus'];
		$instagram = $instance['instagram'];
		$linkedin = $instance['linkedin'];
		$pinterest = $instance['pinterest'];
		$rss = $instance['rss'];
		$tumblr = $instance['tumblr'];
		$twitter = $instance['twitter'];
		$vimeo = $instance['vimeo'];

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		/* Start - Widget Content */

			echo '<ul class="social-icons">';

				if ( $behance != '' )
					echo '<li><a href="' . $behance . '"><img src="' . get_template_directory_uri() . '/images/icons/behance.png' .'" /></a></li>';

				if ( $deviantart != '' )
					echo '<li><a href="' . $deviantart . '"><img src="' . get_template_directory_uri() . '/images/icons/deviantart.png' .'" /></a></li>';

				if ( $dribbble != '' )
					echo '<li><a href="' . $dribbble . '"><img src="' . get_template_directory_uri() . '/images/icons/dribbble.png' .'" /></a></li>';

				if ( $facebook != '' )
					echo '<li><a href="' . $facebook . '"><img src="' . get_template_directory_uri() . '/images/icons/facebook.png' .'" /></a></li>';

				if ( $flickr != '' )
					echo '<li><a href="' . $flickr . '"><img src="' . get_template_directory_uri() . '/images/icons/flickr.png' .'" /></a></li>';

				if ( $forrst != '' )
					echo '<li><a href="' . $forrst . '"><img src="' . get_template_directory_uri() . '/images/icons/forrst.png' .'" /></a></li>';

				if ( $github != '' )
					echo '<li><a href="' . $github . '"><img src="' . get_template_directory_uri() . '/images/icons/github.png' .'" /></a></li>';

				if ( $googleplus != '' )
					echo '<li><a href="' . $googleplus . '"><img src="' . get_template_directory_uri() . '/images/icons/googleplus.png' .'" /></a></li>';

				if ( $instagram != '' )
					echo '<li><a href="' . $instagram . '"><img src="' . get_template_directory_uri() . '/images/icons/instagram.png' .'" /></a></li>';

				if ( $linkedin != '' )
					echo '<li><a href="' . $linkedin . '"><img src="' . get_template_directory_uri() . '/images/icons/linkedin.png' .'" /></a></li>';

				if ( $pinterest != '' )
					echo '<li><a href="' . $pinterest . '"><img src="' . get_template_directory_uri() . '/images/icons/pinterest.png' .'" /></a></li>';

				if ( $rss != '' )
					echo '<li><a href="' . $rss . '"><img src="' . get_template_directory_uri() . '/images/icons/rss.png' .'" /></a></li>';

				if ( $tumblr != '' )
					echo '<li><a href="' . $tumblr . '"><img src="' . get_template_directory_uri() . '/images/icons/tumblr.png' .'" /></a></li>';

				if ( $twitter != '' )
					echo '<li><a href="' . $twitter . '"><img src="' . get_template_directory_uri() . '/images/icons/twitter.png' .'" /></a></li>';

				if ( $vimeo != '' )
					echo '<li><a href="' . $vimeo . '"><img src="' . get_template_directory_uri() . '/images/icons/vimeo.png' .'" /></a></li>';
				

			echo '</ul>';

		/* End - Widget Content */

		echo $after_widget;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['behance'] = strip_tags( $new_instance['behance'] );
		$instance['deviantart'] = strip_tags( $new_instance['deviantart'] );
		$instance['dribbble'] = strip_tags( $new_instance['dribbble'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['flickr'] = strip_tags( $new_instance['flickr'] );
		$instance['forrst'] = strip_tags( $new_instance['forrst'] );
		$instance['github'] = strip_tags( $new_instance['github'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
		$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
		$instance['rss'] = strip_tags( $new_instance['rss'] );
		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
		
		return $instance;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		// Get values
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Get Social';

		if ( isset( $instance['behance'] ) ) $behance = $instance['behance' ]; else $behance = '';
		if ( isset( $instance['deviantart'] ) ) $deviantart = $instance['deviantart' ]; else $deviantart = '';
		if ( isset( $instance['dribbble'] ) ) $dribbble = $instance['dribbble' ]; else $dribbble = '';
		if ( isset( $instance['facebook'] ) ) $facebook = $instance['facebook' ]; else $facebook = '';
		if ( isset( $instance['flickr'] ) ) $flickr = $instance['flickr' ]; else $flickr = '';
		if ( isset( $instance['forrst'] ) ) $forrst = $instance['forrst' ]; else $forrst = '';
		if ( isset( $instance['github'] ) ) $github = $instance['github' ]; else $github = '';
		if ( isset( $instance['googleplus'] ) ) $googleplus = $instance['googleplus' ]; else $googleplus = '';
		if ( isset( $instance['instagram'] ) ) $instagram = $instance['instagram' ]; else $instagram = '';
		if ( isset( $instance['linkedin'] ) ) $linkedin = $instance['linkedin' ]; else $linkedin = '';
		if ( isset( $instance['pinterest'] ) ) $pinterest = $instance['pinterest' ]; else $pinterest = '';
		if ( isset( $instance['rss'] ) ) $rss = $instance['rss' ]; else $rss = '';
		if ( isset( $instance['tumblr'] ) ) $tumblr = $instance['tumblr' ]; else $tumblr = '';
		if ( isset( $instance['twitter'] ) ) $twitter = $instance['twitter' ]; else $twitter = '';
		if ( isset( $instance['vimeo'] ) ) $vimeo = $instance['vimeo' ]; else $vimeo = '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'behance' ); ?>"><?php _e( 'Behance:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" type="text" value="<?php echo esc_attr( $behance ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'deviantart' ); ?>"><?php _e( 'DeviantArt:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'deviantart' ); ?>" name="<?php echo $this->get_field_name( 'deviantart' ); ?>" type="text" value="<?php echo esc_attr( $deviantart ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><?php _e( 'Dribbble:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" type="text" value="<?php echo esc_attr( $dribbble ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e( 'Flickr:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" type="text" value="<?php echo esc_attr( $flickr ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'forrst' ); ?>"><?php _e( 'Forrst:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'forrst' ); ?>" name="<?php echo $this->get_field_name( 'forrst' ); ?>" type="text" value="<?php echo esc_attr( $forrst ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'github' ); ?>"><?php _e( 'GitHub:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'github' ); ?>" name="<?php echo $this->get_field_name( 'github' ); ?>" type="text" value="<?php echo esc_attr( $github ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e( 'GooglePlus:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" type="text" value="<?php echo esc_attr( $googleplus ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'LinkedIn:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="text" value="<?php echo esc_attr( $linkedin ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e( 'Pinterest:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" type="text" value="<?php echo esc_attr( $pinterest ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e( 'RSS:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" type="text" value="<?php echo esc_attr( $rss ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>"><?php _e( 'Tumblr:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" type="text" value="<?php echo esc_attr( $tumblr ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e( 'Vimeo:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" type="text" value="<?php echo esc_attr( $vimeo ); ?>" />
		</p>
		<?php 

	}

}