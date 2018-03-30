<?php

function om_widget_no_margins_init() {
	register_widget( 'om_widget_no_margins' );
}
add_action( 'widgets_init', 'om_widget_no_margins_init' );

/* Widget Class */

class om_widget_no_margins extends WP_Widget {

	function __construct() {
	
		parent::__construct(
			'om_widget_no_margins',
			__('No Margins','om_theme'),
			array(
				'classname' => 'om_widget_no_margins',
				'description' => __('Insert content into pane without margins. Useful for images, videos only in sidebar widgets areas.', 'om_theme')
			),
			array (
				'width' => 320,
				'height' => 380
			)
		);
	}

	/* Front-end display of widget. */
		
	function widget( $args, $instance ) {
		extract( $args );
		
		echo $before_widget;
		
		echo '<div class="widget-eat-margins eat-margins">';
		
		if($instance['video-inside'])
		{
			if(preg_match_all('#<iframe[^>]*src="(http://www\.youtube\.com[^"]+)"[^>]*>[\s\S]*?</iframe>#i',$instance['code'],$m)) {
				foreach($m[1] as $v) {
					if(strpos($v,'wmode=opaque') === false) {
						if(strpos($v,'?') === false)
							$instance['code']=str_replace($v,$v.'?wmode=opaque',$instance['code']);
						else
							$instance['code']=str_replace($v,$v.'&wmode=opaque',$instance['code']);
					}
				}
			}
			echo '<div class="video-embed">'.$instance['code'].'</div>';
		}
		else
			echo do_shortcode($instance['code']);
	
		echo '</div>';
		
		echo $after_widget;
	}


	/* Sanitize widget form values as they are saved. */
		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	
		$instance['code'] = stripslashes( $new_instance['code'] );
		$instance['video-inside'] = $new_instance['video-inside'] ;
	
		return $instance;
	}


	/* Back-end widget form. */
		 
	function form( $instance ) {
	
		// Set up some default widget settings
		$defaults = array(
			'code' => '',
			'video-inside' => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<!-- Code: Textarea -->
		<p>
			<label for="<?php echo $this->get_field_id( 'code' ); ?>"><?php _e('Embed code:', 'om_theme') ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'code' ); ?>" rows="12" name="<?php echo $this->get_field_name( 'code' ); ?>" ><?php echo stripslashes(htmlspecialchars($instance['code'], ENT_QUOTES)); ?></textarea>
		</p>

		<!-- Show Thumb: Check Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'video-inside' ); ?>"><?php _e('This code is Video Embed code', 'om_theme') ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'video-inside' ); ?>" name="<?php echo $this->get_field_name( 'video-inside' ); ?>" value="true" <?php if( $instance['video-inside'] == 'true') echo 'checked="checked"'; ?> />
		</p>
			
	<?php
	}
}
?>