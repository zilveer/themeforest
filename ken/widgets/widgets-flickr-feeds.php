<?php

/*
	FLICKR WIDGET
*/
class Artbees_Widget_Flickr_feeds extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_flickr', 'description' => 'Displays photos from a Flickr ID' );
		WP_Widget::__construct( 'flickr', THEME_SLUG.' - '.'Flickr', $widget_ops );

	}



	function widget( $args, $instance ) {
		extract( $args );
		global $mk_settings;
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$flickr_id = $instance['flickr_id'];
		$count = (int)$instance['count'];
		$display = empty( $instance['display'] ) ? 'latest' : $instance['display'];
		$column = empty( $instance['column'] ) ? 'four' : $instance['column'];
		$api_key = $mk_settings['flickr-api-key'];

		if ( $count < 1 ) {
			$count = 1;
		}

		if($column == 'one') {
			$size = 'm';
		} else if($column == 'two') {
			$size = 'l';
		} else {
			$size = 'sq';
		}

		if ( !empty( $flickr_id ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
		
		
			echo '<div data-count="'.$count.'" data-userid="'.$flickr_id.'" data-key="'.$api_key.'" class="mk-flickr-feeds '.$column.'-column"></div><div class="clearboth"></div>';
	

			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['count'] = (int) $new_instance['count'];
		$instance['column'] = $new_instance['column'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$flickr_id = isset( $instance['flickr_id'] ) ? esc_attr( $instance['flickr_id'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 3;
		$display = isset( $instance['display'] ) ? $instance['display'] : 'latest';
		$column = isset( $instance['column'] ) ? $instance['column'] : 'four';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title :</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>">Flickr User id : (<a href="http://idgettr.com/" target="_blank">Get Your ID</a>)</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" type="text" value="<?php echo $flickr_id; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>">Number of photo to show :</label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>
		<p><label for="<?php echo $this->get_field_id( 'column' ); ?>">How many images in one Row:</label>
		<select id="<?php echo $this->get_field_id( 'column' ); ?>" name="<?php echo $this->get_field_name( 'column' ); ?>">
			<option<?php if ( $column == "one" ) echo ' selected="selected"'?> value="one">1</option>
			<option<?php if ( $column == "two" ) echo ' selected="selected"'?> value="two">2</option>
			<option<?php if ( $column == "three" ) echo ' selected="selected"'?> value="three">3</option>
			<option<?php if ( $column == "four" ) echo ' selected="selected"'?> value="four">4</option>
			<option<?php if ( $column == "five" ) echo ' selected="selected"'?> value="five">5</option>
		</select>
		</p>

		<p><em>In order to use Flickr Widget you should first obtain an API key from <a href="http://www.flickr.com/services/api/misc.api_keys.html">Flickr The App Garden</a> and update the field in Theme settings => Third Party API => Flickr API Key.</em></p>
<?php
	}
}
/***************************************************/