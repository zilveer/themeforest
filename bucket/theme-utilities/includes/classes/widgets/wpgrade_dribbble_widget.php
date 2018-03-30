<?php

class wpgrade_dribbble_widget extends WP_Widget {

	public function __construct()
	{
		parent::__construct( 'wpgrade_dribbble_widget', wpgrade::themename().' '.__('Dribbble Widget','bucket'), array('description' => __('Display Dribbble images in your sidebar or footer', 'bucket')) );
	}

	function widget($args, $instance) {
		extract( $args );
		$title 		= isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : "";
		$username 	= $instance['username'];

		require_once( wpgrade::themefilepath('theme-utilities/includes/vendor/dribbble/src/Dribbble/Dribbble.php') );
		require_once( wpgrade::themefilepath('theme-utilities/includes/vendor/dribbble/src/Dribbble/Exception.php') );
		$dribbble = new Dribbble();

		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;

		try {
			//limit the number of images
			$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 4;

			$my_shots = $dribbble->getPlayerShots($username, 0, $count);
			// $my_shots = array_slice( $my_shots, 0, $count );

			echo '<ul class="wpgrade-dribbble-items">';

			foreach ($my_shots->shots as $shot) {
				echo '<li class="wpgrade-dribbble-item"><a class="wpgrade-dribbble-link" href="' . $shot->url . '"><img src="' . $shot->image_teaser_url . '" alt="' . $shot->title . '"></a></li>';
			}

			echo '</ul>';
		}
		catch (DribbbleException $e) {
			echo 'Upss... Something is wrong. Check the widget settings.';
		}

		echo $after_widget;
	}

	/**
	 * Validate and update widget options.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['count'] = absint( $new_instance['count'] );
		return $instance;
	}

	function form($instance) {
		$title = isset( $instance['title'] ) ? $instance['title'] : __('Dribbble shots','bucket');
		$username = isset ($instance['username']) ? esc_attr($instance['username']) : '';
		//default to 8 images
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 4;
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bucket'); ?>:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Dribbble username', 'bucket'); ?>:</label>
			<input id="<?php echo $this->get_field_id('username'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $username; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of images','bucket'); ?>:</label><br />
			<input type="number" min="1" max="20" value="<?php echo esc_attr( $count ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
		</p>
	<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("wpgrade_dribbble_widget");'));
