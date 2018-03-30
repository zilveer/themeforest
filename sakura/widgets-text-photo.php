<?php


define('techno_SMW_PLUGINPATH',get_option('siteurl').'/wp-content/themes/techno/images/social/');
define('techno_SMW_PLUGINDIR', ABSPATH.'/wp-content/themes/techno/images/social/');


/* Register the widget */
function techno_textphoto_load_widgets() {
	register_widget( 'techno_Text_Photo' );
}

/* Begin Widget Class */
class techno_Text_Photo extends WP_Widget {

	/* Widget setup  */
	function techno_Text_Photo() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'techno_Text_Photo', 'description' => __('A widget with some text and photo', 'smw') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 250, 'id_base' => 'techno-text-photo-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'techno-text-photo-widget', __('Sakura Text & Photo', 'smw'), $widget_ops, $control_ops );
	}

	/* Display the widget  */
	function widget( $args, $instance ) {
		extract( $args );
	
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$text = apply_filters( 'widget_text', $instance['text'], $instance );
		
		echo $before_widget ;

		// start
		echo ''
              .$before_title.$instance['title'].$after_title;
		
		
		
		//if (!$instance['img']) $instance['img']=home_url("/").'wp-content/themes/techno/images/imggg.png';
		
		//print_r($instance);
			
		if ($instance['img']) echo '<img src="'.$instance['img'].'" width="60" height="60" class="alignleft" />';
		
		echo $instance['text'];
		

   echo $after_widget;

	}

	/* Update the widget settings  */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

      foreach (explode(" ", "text title photo img") as $k)
      {
         $instance[$k]=$new_instance[$k];
      }
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => __('Text & Photo', 'smw'),
			'text' => '',
			'img' => home_url('/').'wp-content/themes/sakura/usr/about.jpg'
			);
			
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<script src="<?php echo home_url('/').'wp-content/themes/techno/js/ajaxfileupload.js'; ?>" type="text/javascript" /></script>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'smw'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:85%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e('Text:', 'smw'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" style="width:85%;height: 100px;"><?php echo $instance['text']; ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'img' ); ?>"><?php _e('Image:', 'smw'); ?></label>
			<input id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php echo $instance['img']; ?>" style="width:85%;" />
		</p>
		
		<div style="clear: both;"></div>
		

	<?php
	}
}

/* Load the widget */
add_action( 'widgets_init', 'techno_textphoto_load_widgets' );

?>
