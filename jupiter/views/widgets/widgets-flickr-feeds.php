<?php

class Artbees_Widget_Flickr_feeds extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_flickr', 'description' => 'Displays photos from a Flickr ID' );
		WP_Widget::__construct( 'flickr', THEME_SLUG.' - '.'Flickr', $widget_ops );

	}



	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Photos on flickr' : $instance['title'], $instance, $this->id_base );
		$flickr_id = $instance['flickr_id'];
		$api_key = $instance['api_key'];
		$count = (int)$instance['count'];
		$column = empty( $instance['column'] ) ? 6 : $instance['column'];

		if ( $count < 1 ) {
			$count = 1;
		}
		if ( $column > 12 ) {
			$column = 12;
		}

		if (empty($api_key)) {
		    echo '<p>Flickr API key is empty in the shortcode options.</p>';
		    return false;
		}

		if ( !empty( $flickr_id ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;

		Mk_Static_Files::addAssets('vc_flickr');	
			
?>

		<div class="mk-flickr-feeds <?php echo mk_get_column_class($column); ?>" data-count="<?php echo $count; ?>" data-userid="<?php echo $flickr_id; ?>" data-key="<?php echo $api_key; ?>"></div>
		
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['api_key'] = $new_instance['api_key'];
		$instance['count'] = (int) $new_instance['count'];
		$instance['column'] = (int) $new_instance['column'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$flickr_id = isset( $instance['flickr_id'] ) ? esc_attr( $instance['flickr_id'] ) : '';
		$api_key = isset( $instance['api_key'] ) ? esc_attr( $instance['api_key'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 3;
		$column = isset( $instance['column'] ) ? absint( $instance['column'] ) : 5;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'api_key' ); ?>">Flickr API Key</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'api_key' ); ?>" name="<?php echo $this->get_field_name( 'api_key' ); ?>" type="text" value="<?php echo $api_key; ?>" />
		<em>You can obtain your API key from <a href="http://www.flickr.com/services/api/misc.api_keys.html">Flickr The App Garden</a>.</em>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>">Flickr User id</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" type="text" value="<?php echo $flickr_id; ?>" />
		<em><a href="http://idgettr.com/" target="_blank">Get Your ID</a></em>
		</p>


		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of photo to show:', 'mk_framework'); ?></label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="number" value="<?php echo $count; ?>" size="3" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'column' ); ?>"><?php _e('Photos per each row:', 'mk_framework'); ?></label>
		<input id="<?php echo $this->get_field_id( 'column' ); ?>" name="<?php echo $this->get_field_name( 'column' ); ?>" type="number" value="<?php echo $column; ?>" size="3" /></p>

<?php
	}
}

 register_widget("Artbees_Widget_Flickr_feeds");