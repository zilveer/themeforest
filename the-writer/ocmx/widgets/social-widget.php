<?php
class obox_social_widget extends WP_Widget {
	/** constructor */
	function obox_social_widget() {
		parent::WP_Widget(false, $name = '(Obox) Social Links', $widget_options = 'Link people up to your social Profiles.');

		$this->networks = array(
				'facebook' => 'Facebook',
				'googleplus' => 'Google+',
				'twitter' => 'Twitter',
				'youtube' => 'Youtube',
				'vimeo' => 'Vimeo',
				'skype' => 'Skype',
				'tumblr' => 'Tumblr',
				'linkedin' => 'LinkedIn',
				'fivehundredpx' => '500px',
				'aim' => 'Aim',
				'android' => 'Android',
				'badoo' => 'Badoo',
				'dailybooth' => 'Daily Booth',
				'dribbble' => 'Dribbble',
				'emailz' => 'Email',
				'envato' => 'Envato',
				'foursquare' => 'FourSquare',
				'flickr' => 'Flickr',
				'feedly' => 'Feedly',
				'github' => 'Github',
				'hipstamatic' => 'Hipstamatic',
				'icq' => 'ICQ',
				'instagram' => 'Instagram',
				'kiva' => 'Kiva',
				'kickstarter' => 'Kickstarter',
				'lastfm' => 'LastFM',
				'path' => 'Path',
				'pinterest' => 'Pinterest',
				'picasa' => 'Picasa',
				'quora' => 'Quora',
				'rdio' => 'Rdio',
				'reddit' => 'Reddit',
				'rss' => 'RSS',
				'spotify' => 'Spotify',
				'soundcloud' => 'Soundcloud',
				'thefancy' => 'The Fancy',
				'xbox' => 'Xbox',
				'zerply' => 'Zerply'
			);
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {		
		extract( $args );
		$instance_args = wp_parse_args( $instance, array() );
		extract( $instance_args, EXTR_SKIP ); 
		if(isset($instance["title"]))
			$title = esc_attr($instance["title"]);
		?>

		<?php echo $before_widget; ?>
			<?php echo $before_title;
				if(isset($title)) {echo $title;}
			echo $after_title; ?>

			<?php  $html = ''; 
			foreach( $this->networks as $network => $network_label){
				if($instance[ $network ]) :
					$html .= '<li><a target="_blank" class="' . $network . '" href="' . $instance["$network"]. '" title="' . $network_label . '"></a></li>';
				endif;
			}
			?>
			
			<?php if( $html != '' ) { ?>
				<ul class="social-icons clearfix">
					<?php echo $html; ?>
				</ul>
			<?php } // if html blank ?>
		<?php echo $after_widget;

	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {

		if(isset($instance["title"]))
			$title = esc_attr($instance["title"]);
		?>
			<h3 class="social-instruction">
				<?php _e("Enter the full URL to your profiles. Example: http://www.facebook.com/oboxthemes","ocmx"); ?>
			</h3>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset($title)) {echo $title;} ?>" />
				</label>
			</p>

			<?php foreach( $this->networks as $network => $network_label){ ?>
				<p>
					<label for="<?php echo $this->get_field_id( $network ); ?>">
						<?php echo $network_label; ?>
						<input class="widefat" id="<?php echo $this->get_field_id( $network ); ?>" name="<?php echo $this->get_field_name( $network ); ?>" type="text" value="<?php if(isset($instance[ $network ])) echo $instance[$network ]; ?>" />
					</label>
				</p>
			<?php } //endforeach; ?>
		<?php 
	}

} // class FooWidget

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("obox_social_widget");'));