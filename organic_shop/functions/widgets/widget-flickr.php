<?php

// Widget Class
class qns_flickr_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function qns_flickr_widget() {
		$widget_ops = array( 'classname' => 'flickr_widget', 'description' => __('Display Your Flickr Photos', 'qns') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'flickr_widget' );
		parent::__construct( 'flickr_widget', __('Custom Flickr Widget', 'qns'), $widget_ops, $control_ops );
	}


/* ------------------------------------------------
	Display Widget
------------------------------------------------ */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$flickr_id = $instance['flickr_id'];	
		$flickr_count = $instance['flickr_count'];	
		$flickr_type = $instance['flickr_type'];
		
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		 } ?>
			
			<div class="flickr_badge_wrapper clearfix">
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $flickr_count ?>&amp;flickr_display=latest&amp;size=s&amp;layout=x&amp;source=<?php echo $flickr_type ?>&amp;<?php echo $flickr_type ?>=<?php echo $flickr_id ?>"></script>
				<div style="clear:both;"></div>
				<p class="flickr-more-photos"><a href="http://www.flickr.com/<?php echo ($flickr_type == 'user' ? 'photos' : 'groups') ?>/<?php echo $flickr_id ?>"><?php _e( 'View All', 'qns' ) ?> &rarr;</a></p>
			</div>
		<?php
		
		echo $after_widget;
	}	
	
	
/* ------------------------------------------------
	Update Widget
------------------------------------------------ */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['flickr_count'] = $new_instance['flickr_count'];
		$instance['flickr_type'] = $new_instance['flickr_type'];
		return $instance;
	}
	
	
/* ------------------------------------------------
	Widget Input Form
------------------------------------------------ */
	 
	function form( $instance ) {
		$defaults = array(
		'title' => 'Flickr Photostream',
		'flickr_id' => '',
		'flickr_count' => '4',
		'flickr_type' => 'user'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'qns'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e('Flickr ID:', 'qns') ?> (<a href="http://idgettr.com/" target="_blank">Find Flickr ID</a>)</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" value="<?php echo $instance['flickr_id']; ?>" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_count' ); ?>"><?php _e('How Many Photos:', 'qns') ?></label>
			<select id="<?php echo $this->get_field_id( 'flickr_count' ); ?>" name="<?php echo $this->get_field_name('flickr_count'); ?>" class="widefat">
			<?php for($i = 1; $i < 11; $i++) : ?>		
				<option <?php if ( $i == $instance['flickr_count'] ) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
			<?php endfor; ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_type' ); ?>"><?php _e('flickr_type (user or group):', 'qns') ?></label>
			<select id="<?php echo $this->get_field_id( 'flickr_type' ); ?>" name="<?php echo $this->get_field_name('flickr_type'); ?>" class="widefat">
				<option <?php if ( 'user' == $instance['flickr_type'] ) echo 'selected="selected"'; ?>>user</option>
				<option <?php if ( 'group' == $instance['flickr_type'] ) echo 'selected="selected"'; ?>>group</option>
			</select>
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'qns_flickr_widget' );

// Register Widget
function qns_flickr_widget() {
	register_widget( 'qns_flickr_widget' );
}