<?php

/* WIDGET - EMBED VIDEO */


class tp_widget_embed extends WP_Widget {
	
	

	function tp_widget_embed() {
		$widget_ops = array('classname' => 'tp_widget_embed', 'description' => __('Display Embedded Video','ingrid') );
		parent::__construct('tp_widget_embed', '* Embed Content', $widget_ops);
	}


	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		
		if(!empty($instance['tp_widget_embed_title'])){ print $before_title . $instance['tp_widget_embed_title'] . $after_title; }
		if(empty($instance['tp_widget_embed_code'])){ $instance['tp_widget_embed_code'] = '...'; }		
		
		// show box
		echo '
		<div class="embed_content">
			'.$instance['tp_widget_embed_code'];
			if (!empty($instance['tp_widget_embed_description'])) { echo '<p>' . $instance['tp_widget_embed_description'] . '</p>'; }
		echo '	
		</div>';
		
		echo $after_widget;
	}

	
	function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['tp_widget_embed_title'] = strip_tags($new_instance['tp_widget_embed_title']);						
		$instance['tp_widget_embed_code'] = $new_instance['tp_widget_embed_code'];			
		$instance['tp_widget_embed_description'] = strip_tags($new_instance['tp_widget_embed_description']);	
		
		update_option('tp_widget_embed_title',$instance['tp_widget_embed_title']);
		update_option('tp_widget_embed_code',$instance['tp_widget_embed_code']);
		update_option('tp_widget_embed_description',$instance['tp_widget_embed_description']);
        return $instance;
    }

	
	function form($instance) {
		$defaults = array( 'tp_widget_embed_title' => '', 'tp_widget_embed_code' => '', 'tp_widget_embed_description' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
				
		echo '<p><label>'.__('Title','ingrid').':</label>
		<input id="'.$this->get_field_id('tp_widget_embed_title').'" type="text" name="'.$this->get_field_name('tp_widget_embed_title').'" value="'.esc_attr($instance['tp_widget_embed_title']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>
		<p><label>'.__('Embed Code','ingrid').':</label>
		<textarea class="widefat" rows="4" cols="20" id="'.$this->get_field_id( 'tp_widget_embed_code' ).'" name="'.$this->get_field_name( 'tp_widget_embed_code' ).'">'.esc_attr($instance['tp_widget_embed_code']).'</textarea></p>
		<p><label>'.__('Description','ingrid').':</label>
		<textarea class="widefat" rows="2" cols="20" id="'.$this->get_field_id( 'tp_widget_embed_description' ).'" name="'.$this->get_field_name( 'tp_widget_embed_description' ).'">'.$instance['tp_widget_embed_description'].'</textarea></p>
		';
	 }
}

register_widget('tp_widget_embed');
?>