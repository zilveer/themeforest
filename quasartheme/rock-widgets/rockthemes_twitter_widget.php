<?php
/**
 * Adds Rockthemes_Twitter_Widget.
 */
class Rockthemes_Twitter_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'rockthemes_twitter_widget', // Base ID
			'Rockthemes Twitter Widget', // Name
			array( 'description' => __( 'Rockthemes Twitter Widget', 'quasar' ), ) // Args
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
		
		if(!empty($instance['username'])):
			$username = ($instance['username']);
		else:
			return;
		endif;	
		
		if(!empty($instance['widget_id'])):
			$widget_id = ($instance['widget_id']);
		else:
			return;
		endif;	
		
		
		if(!empty($instance['total'])):
			$total = is_int(intval($instance['total'])) ? intval($instance['total']) : 3;
		else:
			$total = 3;
		endif;	
		
		$use_dark = checked('1', $instance['use_dark'], false) ? 'data-theme="dark"' : 'data-theme="light"';
		
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		?>
        
		<a class="twitter-timeline" data-dnt="true" <?php echo $use_dark; ?> data-widget-id="<?php echo $widget_id; ?>" width="200" height="180" data-tweet-limit="<?php echo $total; ?>" data-chrome="noheader nofooter transparent noscrollbar"><?php echo $username; ?></a>
		<script>
		jQuery(window).load(function(){
			!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		});
        </script>
        
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
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['widget_id'] = strip_tags( $new_instance['widget_id'] );
		$instance['total'] = strip_tags( intval($new_instance['total']) );
		$instance['use_dark'] = strip_tags($new_instance['use_dark']) ;
		
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
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'quasar' );
		}
		
		if ( isset( $instance[ 'username' ] ) ) {
			$username = $instance[ 'username' ];
		}
		else {
			$username = '';
		}
		
		if ( isset( $instance[ 'widget_id' ] ) ) {
			$widget_id = $instance[ 'widget_id' ];
		}
		else {
			$widget_id = '';
		}
		
		if ( isset( $instance[ 'total' ] ) ) {
			$total = $instance[ 'total' ];
		}
		else {
			$total = 3;
		}
		
				
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','quasar' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username:','quasar' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'widget_id' ); ?>"><?php _e( 'Twitter Widget ID:','quasar' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'widget_id' ); ?>" name="<?php echo $this->get_field_name( 'widget_id' ); ?>" type="text" value="<?php echo esc_attr( $widget_id ); ?>" />
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'total' ); ?>"><?php _e( 'Total Tweets:','quasar' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'total' ); ?>" name="<?php echo $this->get_field_name( 'total' ); ?>" type="text" value="<?php echo esc_attr( $total ); ?>" />
		</p>
        <p>
        <input id="<?php echo $this->get_field_id( 'use_dark' ); ?>" name="<?php echo $this->get_field_name('use_dark'); ?>" type="checkbox" value="1" <?php echo checked('1', (isset($instance['use_dark']) ? $instance['use_dark'] : false)); ?> />
		<label for="<?php echo $this->get_field_id( 'use_dark' ); ?>"><?php _e( ' Check this for light version','quasar' ); ?></label> 
        </p>
		<?php 
	}

} // class 

// register 
add_action( 'widgets_init', create_function( '', 'register_widget( "rockthemes_twitter_widget" );' ) );

?>