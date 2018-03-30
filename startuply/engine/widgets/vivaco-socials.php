<?php

/** Vivaco Socials widget **/

class VSC_Widget_Socials extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'widget_socials', 'description' => __( 'Your site&#8217;s socials info.' , 'vivaco' ) );

		parent::__construct(
			'socials_sply_widget', // Base ID
			__('Socials' , 'vivaco'),
			$widget_ops // Args
		);

		$this->alt_option_name = 'widget_socials';
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

		echo $before_widget;
		if ( ! empty( $title ) )
			echo '<div class="footer-title">'.$before_title . $title . $after_title.'</div>';
		?>


		<ul class="list-inline socials">
			<?php
				if($class == 'fa') {
					$socials['fb'] = array('val' => $instance['fb_opt'], 'ico' => 'fa fa-facebook-official');
					$socials['twitter'] = array('val' => $instance['twitter_opt'], 'ico' => 'fa fa-twitter-square');
					$socials['gplus'] = array('val' => $instance['google_opt'], 'ico' => 'fa fa-google-plus-square');
					$socials['linkedin'] = array('val' => $instance['linkedin_opt'], 'ico' => 'fa fa-linkedin-square');
					$socials['instagram'] = array('val' => $instance['instagram_opt'], 'ico' => 'fa fa-instagram');
					$socials['skype'] = array('val' => $instance['skype_opt'], 'ico' => 'fa fa-skype');
					$socials['pinterest'] = array('val' => $instance['pinterest_opt'], 'ico' => 'fa fa-pinterest-square');
					$socials['youtube'] = array('val' => $instance['youtube_opt'], 'ico' => 'fa fa-youtube-square');
					$socials['soundcloud'] = array('val' => $instance['soundcloud_opt'], 'ico' => 'fa fa-soundcloud');
					$socials['rss'] = array('val' => $instance['rss_opt'], 'ico' => 'fa fa-rss-square');
				}
				else {
					$socials['fb'] = array('val' => $instance['fb_opt'], 'ico' => 'icon-socialmedia-08');
					$socials['twitter'] = array('val' => $instance['twitter_opt'], 'ico' => 'icon-socialmedia-07');
					$socials['gplus'] = array('val' => $instance['google_opt'], 'ico' => 'icon-socialmedia-16');
					$socials['linkedin'] = array('val' => $instance['linkedin_opt'], 'ico' => 'icon-socialmedia-05');
					$socials['instagram'] = array('val' => $instance['instagram_opt'], 'ico' => 'icon-socialmedia-26');
					$socials['skype'] = array('val' => $instance['skype_opt'], 'ico' => 'icon-socialmedia-09');
					$socials['pinterest'] = array('val' => $instance['pinterest_opt'], 'ico' => 'icon-socialmedia-04');
					$socials['youtube'] = array('val' => $instance['youtube_opt'], 'ico' => 'icon-socialmedia-29');
					$socials['soundcloud'] = array('val' => $instance['soundcloud_opt'], 'ico' => 'icon-socialmedia-10');
					$socials['rss'] = array('val' => $instance['rss_opt'], 'ico' => 'icon-socialmedia-20');
				}

				foreach ($socials as $k => $v) {
					if ($v['val'] != '') {
						if ( $k === 'skype')
							$v['val'] = 'skype:'.$v['val'];
						?>
						<li><a href="<?php echo $v['val']; ?>" target="_blank"><span class="icon <?php echo $v['ico']; ?>"></span></a></li>
				<?php }
				} ?>
		</ul>


		<?php
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

		if ( current_user_can('unfiltered_html') ) {
			$instance['fb_opt'] = $new_instance['fb_opt'];
			$instance['twitter_opt'] = $new_instance['twitter_opt'];
			$instance['google_opt'] = $new_instance['google_opt'];
			$instance['linkedin_opt'] = $new_instance['linkedin_opt'];
			$instance['instagram_opt'] = $new_instance['instagram_opt'];
			$instance['skype_opt'] = $new_instance['skype_opt'];
			$instance['pinterest_opt'] = $new_instance['pinterest_opt'];
			$instance['youtube_opt'] = $new_instance['youtube_opt'];
			$instance['soundcloud_opt'] = $new_instance['soundcloud_opt'];
			$instance['rss_opt'] = $new_instance['rss_opt'];
		} else {
			$instance['fb_opt'] = strip_tags( $new_instance['fb_opt'] );
			$instance['twitter_opt'] = strip_tags( $new_instance['twitter_opt'] );
			$instance['google_opt'] = strip_tags( $new_instance['google_opt'] );
			$instance['linkedin_opt'] = strip_tags( $new_instance['linkedin_opt'] );
			$instance['instagram_opt'] = strip_tags( $new_instance['instagram_opt'] );
			$instance['skype_opt'] = strip_tags( $new_instance['skype_opt'] );
			$instance['pinterest_opt'] = strip_tags( $new_instance['pinterest_opt'] );
			$instance['youtube_opt'] = strip_tags( $new_instance['youtube_opt'] );
			$instance['soundcloud_opt'] = strip_tags( $new_instance['soundcloud_opt'] );
			$instance['rss_opt'] = strip_tags( $new_instance['rss_opt'] );
		}

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
		$instance = wp_parse_args(
			(array)$instance,
			array(
				'title' => __( 'Social Networks', 'vivaco' ),
				'fb_opt' => 'http://your-social-link-here.com',
				'twitter_opt' => 'http://your-social-link-here.com',
				'google_opt' => 'http://your-social-link-here.com',
				'linkedin_opt' => 'http://your-social-link-here.com',
				'instagram_opt' => 'http://your-social-link-here.com',
				'skype_opt' => 'your-skype-here',
				'pinterest_opt' => 'http://your-social-link-here.com',
				'youtube_opt' => 'http://your-social-link-here.com',
				'soundcloud_opt' => '',
				'rss_opt' => '',
			)
		);

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Social Networks', 'vivaco' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'vivaco' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fb_opt' ); ?>"><?php _e( 'Facebook:', 'vivaco'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'fb_opt' ); ?>" name="<?php echo $this->get_field_name( 'fb_opt' ); ?>" type="text" value="<?php echo esc_attr( $instance['fb_opt'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_opt' ); ?>"><?php _e( 'Twitter:', 'vivaco'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter_opt' ); ?>" name="<?php echo $this->get_field_name( 'twitter_opt' ); ?>" type="text" value="<?php echo esc_attr( $instance['twitter_opt'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'google_opt' ); ?>"><?php _e( 'Google+:', 'vivaco'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'google_opt' ); ?>" name="<?php echo $this->get_field_name( 'google_opt' ); ?>" type="text" value="<?php echo esc_attr( $instance['google_opt'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin_opt' ); ?>"><?php _e( 'LinkedIn:', 'vivaco'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkedin_opt' ); ?>" name="<?php echo $this->get_field_name( 'linkedin_opt' ); ?>" type="text" value="<?php echo esc_attr( $instance['linkedin_opt'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram_opt' ); ?>"><?php _e( 'Instagram:', 'vivaco'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'instagram_opt' ); ?>" name="<?php echo $this->get_field_name( 'instagram_opt' ); ?>" type="text" value="<?php echo esc_attr( $instance['instagram_opt'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'skype_opt' ); ?>"><?php _e( 'Skype:', 'vivaco'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'skype_opt' ); ?>" name="<?php echo $this->get_field_name( 'skype_opt' ); ?>" type="text" value="<?php echo esc_attr( $instance['skype_opt'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest_opt' ); ?>"><?php _e( 'Pinterest:', 'vivaco'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'pinterest_opt' ); ?>" name="<?php echo $this->get_field_name( 'pinterest_opt' ); ?>" type="text" value="<?php echo esc_attr( $instance['pinterest_opt'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube_opt' ); ?>"><?php _e( 'YouTube:', 'vivaco'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'youtube_opt' ); ?>" name="<?php echo $this->get_field_name( 'youtube_opt' ); ?>" type="text" value="<?php echo esc_attr( $instance['youtube_opt'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'soundcloud_opt' ); ?>"><?php _e( 'SoundCloud:', 'vivaco'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'soundcloud_opt' ); ?>" name="<?php echo $this->get_field_name( 'soundcloud_opt' ); ?>" type="text" value="<?php echo esc_attr( $instance['soundcloud_opt'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'rss_opt' ); ?>"><?php _e( 'RSS:', 'vivaco'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'rss_opt' ); ?>" name="<?php echo $this->get_field_name( 'rss_opt' ); ?>" type="text" value="<?php echo esc_attr( $instance['rss_opt'] ); ?>" />
		</p>


		<?php
	}

} // class VSC_Widget_Socials
