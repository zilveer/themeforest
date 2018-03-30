<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.   
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* Function called by action/hook 'widgets_init' */
function btp_init_feeds_widget() {
	register_widget( 'BTP_Feeds_Widget' );
}
add_action( 'widgets_init', 'btp_init_feeds_widget' );

class BTP_Feeds_Widget extends WP_Widget {
	
	function BTP_Feeds_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_feeds', 'description' => __('Display feeds defined in theme options', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_feeds_widget' );

		/* Create the widget. */
		parent::__construct( 'btp_feeds_widget', __('BTP Feeds', 'btp_theme'), $widget_ops, $control_ops );
	}
	
	/* Display widget */
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );		
		
		/* Start composing output */
		$out = '';
				
		/* Before widget (defined by themes). */
		$out .= $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			$out .= $before_title . $title . $after_title;
		
		$shortcode = '[feeds ';
			$shortcode .= 'include="'.$instance['include'].'" ';
			$shortcode .= 'exclude="'.$instance['exclude'].'" ';	
			$shortcode .= 'template="'.$instance['template'].'" ';
			
			$hide = '';
			$hide .= $instance['hide_icon'] ? 'icon,' : '';
			$hide .= $instance['hide_label'] ? 'label,' : '';
			$hide .= $instance['hide_caption'] ? 'caption,' : '';
			$hide = trim($hide, ",");
			
			$shortcode .= 'hide="'.$hide.'" ';
		$shortcode .= ']';	
			
		$out .= do_shortcode( $shortcode );		
		
		/* After widget (defined by themes). */
		$out .= $after_widget;
						
		/* Render Widget */
		echo $out;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Filter input data */
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['include'] 			= strip_tags( $new_instance['include'] );
		$instance['exclude'] 			= strip_tags( $new_instance['exclude'] );
		$instance['template'] 			= strip_tags( $new_instance['template'] );
		$instance['hide_icon'] 			= btp_bool( $new_instance['hide_icon'] );
		$instance['hide_label'] 		= btp_bool( $new_instance['hide_label'] );
		$instance['hide_caption'] 		= btp_bool( $new_instance['hide_caption'] );
		
		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {

		$templates = btp_feeds_get_collection_templates();
		
		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 			=> __('Stay tuned', 'btp_theme'),
			'include'			=> '',
			'exclude'			=> '',
			'template'			=> key($templates),
			'hide_icon'			=> false,
			'hide_label'		=> false,
			'hide_caption'		=> false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'include' ); ?>"><?php _e('Include', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'include' ); ?>" name="<?php echo $this->get_field_name( 'include' ); ?>" value="<?php echo $instance['include']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>"><?php _e('Exclude', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" value="<?php echo $instance['exclude']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e('Template', 'btp_theme'); ?>:</label>			
			<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" style="width:100%;">
				<?php foreach($templates as $key => $value): ?>
					<?php if($key == $instance['template']): ?>
						<option selected="selected" value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php else: ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>	
			</select>			 
		</p>
		
		<p>
			<?php _e( 'Hide:', 'btp_theme' ); ?>
			<br />
			
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_icon' ); ?>" name="<?php echo $this->get_field_name( 'hide_icon' ); ?>" value="true" <?php if($instance['hide_icon']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_icon' ); ?>"><?php _e('Icon', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_label' ); ?>" name="<?php echo $this->get_field_name( 'hide_label' ); ?>" value="true" <?php if($instance['hide_label']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_label' ); ?>"><?php _e('Label', 'btp_theme'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_caption' ); ?>" name="<?php echo $this->get_field_name( 'hide_caption' ); ?>" value="true" <?php if($instance['hide_caption']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_caption' ); ?>"><?php _e('Caption', 'btp_theme'); ?></label>
			<br />
			
		</p>
		
	<?php
	}	
}
?>