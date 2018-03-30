<?php
class thbdribbble {
	function do_thb_dribbble( $player, $shots ) {
		// check for cached version
		$key = 'thbdribbble_' . $player;
		$shots_cache = get_transient($key);

		if( $shots_cache === false ) {
			$url 		= 'http://api.dribbble.com/players/' . $player . '/shots/?per_page=15';
			$response 	= wp_remote_get( $url );

			if( is_wp_error( $response ) ) 
				return;

			$xml = wp_remote_retrieve_body( $response );

			if( is_wp_error( $xml ) )
				return;

			if( $response['headers']['status'] == 200 ) {

				$json = json_decode( $xml );
				$dribbble_shots = $json->shots;

				set_transient($key, $dribbble_shots, 60*5);
			}
		} else {
			$dribbble_shots = $shots_cache;
		}

		if( $dribbble_shots ) {
			$i = 0;
			$output = '';

			foreach( $dribbble_shots as $dribbble_shot ) {
				if( $i == $shots )
					break;
				$output .= '<div class="fresco">';
				$output .= '<a href="' . esc_attr($dribbble_shot->url) . '" title="' . esc_attr($dribbble_shot->title) . '" target="_blank"><img height="' . esc_attr($dribbble_shot->height) . '" width="' . esc_attr($dribbble_shots[$i]->width) . '" src="' . esc_attr($dribbble_shot->image_url) . '" alt="' . esc_attr($dribbble_shot->title) . '" /></a>';
				$output .= '</div>';
				$i++;
			}

		} else {
			$output = '<em>' . __('Error retrieving Dribbble shots','north') . '</em>';
		}

		return $output;
	}
}
global $thb_dribbble;
$thb_dribbble = new thbdribbble();

// thb Dribbble Widget
class widget_thbdribbble extends WP_Widget { 
	function __construct() {
		
		$widget_ops = array(
			'classname'   => 'widget_dribbble',
			'description' => __('Display Your Dribbble Shots','north')
		);

		parent::__construct(
			'thb_dribbble_widget',
			__( 'Fuel Themes - Dribbble' , 'north' ),
			$widget_ops
		);
		
		$this->defaults = array(
			'title' => '',
			'description' => '',
			'player' => 'anteksiler',
			'shots' => 2
		);
	}
	
	public function widget($args, $instance) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$desc = $instance['description'];
		$player = $instance['player'];
		$shots = $instance['shots'];

		echo $before_widget;
		if ( !empty( $title ) ) echo $before_title . $title . $after_title;

		if( $desc ) echo '<p>' . $desc . '</p>';

		global $thb_dribbble;
		echo $thb_dribbble->do_thb_dribbble($player, $shots);

		echo $after_widget;
	}
	public function update( $new_instance, $old_instance ) {  
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['description'] = strip_tags($new_instance['description'], '<a><b><strong><i><em>');
		$instance['player'] = trim($new_instance['player']);
		$instance['shots'] = trim($new_instance['shots']);
		return $instance;
	}
	// Settings form
	function form($instance) {
		
		$defaults = $this->defaults;
		$instance = wp_parse_args( $instance, $defaults );

		$title = $instance['title'];
		$desc = $instance['description'];
		$player = $instance['player'];
		$shots = $instance['shots'];

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>">Description:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text" value="<?php echo $desc; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('player'); ?>">Dribbble player:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('player'); ?>" name="<?php echo $this->get_field_name('player'); ?>" type="text" value="<?php echo $player; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('shots'); ?>">Number of shots to display:</label>
			<select name="<?php echo $this->get_field_name('shots'); ?>">
				<?php for( $i = 1; $i <= 15; $i++ ) { ?>
					<option value="<?php echo $i; ?>" <?php selected( $i, $shots ); ?>><?php echo $i; ?></option>
				<?php } ?>
			</select>
		</p>

		<?php

	}
}
function widget_thbdribbble_init()
{
	register_widget('widget_thbdribbble');
}
add_action('widgets_init', 'widget_thbdribbble_init');

?>