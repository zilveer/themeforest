<?php
/**
 * This file is part of the BTP_FaderTheme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code. *
 * 
 * Table of contents: 
 *
 * 1. class BTP_Custom_Pages_Widget 
 * 2. class BTP_Related_Pages_Widget
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* Function called by action/hook 'widgets_init' */
function btp_page_init_custom_pages_widget() {
	register_widget( 'BTP_Custom_Pages_Widget' );
}
add_action( 'widgets_init', 'btp_page_init_custom_pages_widget' );



class BTP_Custom_Pages_Widget extends WP_Widget {
	
	function BTP_Custom_Pages_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_custom_pages', 'description' => __('Custom pages based on ids', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_custom_pages_widget' );

		/* Create the widget. */
		parent::__construct( 'btp_custom_pages_widget', __('BTP Custom Pages', 'btp_theme'), $widget_ops, $control_ops );
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
		
		$shortcode = '[custom_pages ';
			$shortcode .= 'entry_ids="'.$instance['entry_ids'].'" ';
			$shortcode .= 'template="'.$instance['template'].'" ';
			
			$hide = '';
			$hide .= $instance['hide_title'] ? 'title,' : '';
			$hide .= $instance['hide_featured_media'] ? 'featured_media,' : '';
			$hide .= $instance['hide_summary'] ? 'summary,' : '';
			$hide .= $instance['hide_button_1'] ? 'button_1,' : '';
			$hide = trim($hide, ",");
			
			$shortcode .= 'hide="'.$hide.'" ';
		$shortcode .= ']';	
			
		$out .= do_shortcode($shortcode);		
		
		/* After widget (defined by themes). */
		$out .= $after_widget;
						
		/* Render Widget */
		echo $out;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Filter input data */
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['entry_ids'] 			= strip_tags( $new_instance['entry_ids'] );
		$instance['template'] 			= strip_tags( $new_instance['template'] );		
		$instance['hide_title'] 		= btp_bool($new_instance['hide_title']);
		$instance['hide_featured_media']= btp_bool($new_instance['hide_featured_media']);
		$instance['hide_summary'] 		= btp_bool($new_instance['hide_summary']);
		$instance['hide_button_1'] 		= btp_bool($new_instance['hide_button_1']);
		
		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {
		
		$templates = btp_page_get_collection_templates();

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 				=> __('Featured pages', 'btp_theme'),
			'entry_ids'				=> '',
			'template'				=> key($templates),			
			'hide_title'			=> false,
			'hide_featured_media'	=> false,
			'hide_summary'			=> false,
			'hide_button_1'			=> false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'entry_ids' ); ?>"><?php _e('Entry IDs', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'entry_ids' ); ?>" name="<?php echo $this->get_field_name( 'entry_ids' ); ?>" value="<?php echo $instance['entry_ids']; ?>" style="width:100%;" /><br />
			<span class="description"><?php _e( 'Comma separated list of entry IDs', 'btp_theme' ); ?></span>
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
			<?php _e( 'Hide collection elements:', 'btp_theme' ); ?>
			<br />
		
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" value="true" <?php if($instance['hide_title']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php echo 'title'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>" name="<?php echo $this->get_field_name( 'hide_featured_media' ); ?>" value="true" <?php if($instance['hide_featured_media']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>"><?php echo 'featured_media'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_summary' ); ?>" name="<?php echo $this->get_field_name( 'hide_summary' ); ?>" value="true" <?php if($instance['hide_summary']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_summary' ); ?>"><?php echo 'summary'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_button_1' ); ?>" name="<?php echo $this->get_field_name( 'hide_button_1' ); ?>" value="true" <?php if($instance['hide_button_1']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_button_1' ); ?>"><?php echo 'button_1'; ?></label>
			<br />
		</p>
	<?php
	}
}



/* Function called by action/hook 'widgets_init' */
function btp_page_init_related_pages_widget() {
	register_widget( 'BTP_Related_Pages_Widget' );
}
add_action( 'widgets_init', 'btp_page_init_related_pages_widget' );



class BTP_Related_Pages_Widget extends WP_Widget {
	
	function BTP_Related_Pages_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_related_pages', 'description' => __('Related pages based on relation tags', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_related_pages_widget' );

		/* Create the widget. */
		parent::__construct( 'btp_related_pages_widget', __('BTP Related Pages', 'btp_theme'), $widget_ops, $control_ops );
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
		
		$shortcode = '[related_pages ';
			$shortcode .= 'entry_id="'.$instance['entry_id'].'" ';
			$shortcode .= 'max="'.$instance['max'].'" ';
			$shortcode .= 'template="'.$instance['template'].'" ';
			
			$hide = '';
			$hide .= $instance['hide_title'] ? 'title,' : '';
			$hide .= $instance['hide_featured_media'] ? 'featured_media,' : '';
			$hide .= $instance['hide_summary'] ? 'summary,' : '';
			$hide .= $instance['hide_button_1'] ? 'button_1,' : '';
			$hide = trim($hide, ",");
			
			$shortcode .= 'hide="'.$hide.'" ';
		$shortcode .= ']';	
			
		$out .= do_shortcode($shortcode);		
		
		/* After widget (defined by themes). */
		$out .= $after_widget;
						
		/* Render Widget */
		echo $out;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Filter input data */
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['entry_id'] 			= strip_tags( $new_instance['entry_id'] );
		$instance['max'] 				= absint( $new_instance['max'] );
		$instance['template'] 			= strip_tags( $new_instance['template'] );		
		$instance['hide_title'] 		= btp_bool($new_instance['hide_title']);
		$instance['hide_featured_media']= btp_bool($new_instance['hide_featured_media']);
		$instance['hide_summary'] 		= btp_bool($new_instance['hide_summary']);
		$instance['hide_button_1'] 		= btp_bool($new_instance['hide_button_1']);

		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {
		$templates = btp_page_get_collection_templates();
		
		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 				=> __('Related pages', 'btp_theme'),
			'entry_id'				=> '',
			'max'					=> 1,
			'template'				=> key($templates),			
			'hide_title'			=> false,
			'hide_featured_media'	=> false,			
			'hide_summary'			=> false,
			'hide_button_1'			=> false,		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'entry_id' ); ?>"><?php _e('Related entry ID (optional)', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'entry_id' ); ?>" name="<?php echo $this->get_field_name( 'entry_id' ); ?>" value="<?php echo $instance['entry_id']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max' ); ?>"><?php _e('Maximum entries to display', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max' ); ?>" name="<?php echo $this->get_field_name( 'max' ); ?>" value="<?php echo $instance['max']; ?>" style="width:100%;" />
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
			<?php _e( 'Hide collection elements:', 'btp_theme' ); ?>
			<br />
		
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" value="true" <?php if($instance['hide_title']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php echo 'title'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>" name="<?php echo $this->get_field_name( 'hide_featured_media' ); ?>" value="true" <?php if($instance['hide_featured_media']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>"><?php echo 'featured_media' ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_summary' ); ?>" name="<?php echo $this->get_field_name( 'hide_summary' ); ?>" value="true" <?php if($instance['hide_summary']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_summary' ); ?>"><?php echo 'summary'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_button_1' ); ?>" name="<?php echo $this->get_field_name( 'hide_button_1' ); ?>" value="true" <?php if($instance['hide_button_1']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_button_1' ); ?>"><?php echo 'button_1'; ?></label>
		</p>
	<?php
	}
}
?>