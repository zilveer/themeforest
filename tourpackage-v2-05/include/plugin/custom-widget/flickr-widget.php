<?php
/**
 * Plugin Name: Goodlayers Flickr Widget
 * Plugin URI: http://goodlayers.com/
 * Description: A widget that show photo from flickr
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */
 
add_action( 'widgets_init', 'flickr_widget' );
function flickr_widget() {
	register_widget( 'flickr' );
}

class flickr extends WP_Widget {
	
	// Initialize the widget
	function flickr() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'flickr-widget', 'description' => __('A widget that show last flickr photo streams', 'gdl_back_office') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'flickr-widget' );

		/* Create the widget. */
		parent::__construct( 'flickr-widget', __('Flickr (Goodlayers)', 'gdl_back_office'), $widget_ops, $control_ops );
	}

	// Output of the widget
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$id = $instance['id'];
		$how = $instance['how'];
		$show_num = $instance['show_num'];

		// Opening of widget
		echo $before_widget;
		
		// Open of title tag
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}
			
		// Widget Content
		echo '<div class="flickr-widget">';
		echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' . $show_num . '&amp;display=' . $how . '&amp;size=s&amp;layout=x&amp;source=user&amp;user=' . $id . '"></script>';
		echo '</div>';
		echo '<div class="clear"></div>';
		// Closing of widget
		echo $after_widget;
	}

	// Widget Form
	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$id = esc_attr( $instance[ 'id' ] );
			$show_num = esc_attr( $instance[ 'show_num' ] );
			$how = esc_attr( $instance[ 'how' ] );
		} else {
			$title = '';
			$id = '';
			$show_num = '6';
			$how = 'latest';
		}
		?>

		<!-- Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>	
		
		<!-- Flickr ID -->
		<p>
			<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e( 'ID :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" />
		</p>
		
		<!-- Show Count -->
		<p>
			<label for="<?php echo $this->get_field_id('show_num'); ?>"><?php _e( 'Show Count ( up to 10 )', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('show_num'); ?>" name="<?php echo $this->get_field_name('show_num'); ?>" type="text" value="<?php echo $show_num; ?>" />
		</p>		

		<!-- How -->
        <p>
			<label for="<?php echo $this->get_field_id( 'how' ); ?>"><?php _e('Order By','gdl_back_office'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'how' ); ?>" name="<?php echo $this->get_field_name( 'how' ); ?>">
				<option <?php if ( 'latest' == $how ) echo 'selected="selected"'; ?> value="latest">latest</option>            
				<option <?php if ( 'random' == $how ) echo 'selected="selected"'; ?> value="random">random</option>                  
			</select>
		</p>     

	<?php
	}
	
	// Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['id'] = strip_tags( $new_instance['id'] );
		$instance['show_num'] = strip_tags( $new_instance['show_num'] );
		$instance['how'] = strip_tags( $new_instance['how'] );

		return $instance;
	}	
}

?>