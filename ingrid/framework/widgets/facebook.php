<?php

/* WIDGET - FACEBOOK LIKE BOX */


class tp_widget_fb_like extends WP_Widget {
	
	

	function tp_widget_fb_like() {
		$widget_ops = array('classname' => 'tp_widget_fb_like', 'description' => __('Display Facebook Like Box','ingrid') );
		parent::__construct('tp_widget_fb_like', '* Facebook Like Box', $widget_ops);
	}


	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		
		if(!empty($instance['tp_widget_fb_like_title'])){ print $before_title . $instance['tp_widget_fb_like_title'] . $after_title; }
		if(empty($instance['tp_widget_fb_like_page'])){ $instance['tp_widget_fb_like_page'] = 'http://www.facebook.com/envato'; }
		if(empty($instance['tp_widget_fb_like_faces'])){ $instance['tp_widget_fb_like_faces'] = 'true'; }
		if($instance['tp_widget_fb_like_faces'] == 'false'){ $ifheight = '60'; }else{ $ifheight = '258'; }
		
		// show box
		echo '
		<div class="fblikebox-frame">
			<iframe src="//www.facebook.com/plugins/likebox.php?href='.urlencode($instance['tp_widget_fb_like_page']).'&amp;width=&amp;height=&amp;show_faces='.$instance['tp_widget_fb_like_faces'].'&amp;colorscheme=light&amp;stream=false&amp;border_color=%23777&amp;header=false" scrolling="no" frameborder="0" style="height:'.$ifheight.'px;" allowTransparency="true"></iframe>
		</div>';
		
		echo $after_widget;
	}

	
	function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['tp_widget_fb_like_title'] = strip_tags($new_instance['tp_widget_fb_like_title']);						
		$instance['tp_widget_fb_like_page'] = strip_tags($new_instance['tp_widget_fb_like_page']);	
		$instance['tp_widget_fb_like_faces'] = strip_tags($new_instance['tp_widget_fb_like_faces']);	
		
		update_option('tp_widget_fb_like_title',$instance['tp_widget_fb_like_title']);
		update_option('tp_widget_fb_like_page',$instance['tp_widget_fb_like_page']);
		update_option('tp_widget_fb_like_faces',$instance['tp_widget_fb_like_faces']);
        return $instance;
    }

	
	function form($instance) {
		$defaults = array( 'tp_widget_fb_like_title' => '', 'tp_widget_fb_like_page' => 'http://facebook.com/envato', 'tp_widget_fb_like_faces' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
				
		echo '<p><label>'.__('Title','ingrid').':</label>
		<input id="'.$this->get_field_id('tp_widget_fb_like_title').'" type="text" name="'.$this->get_field_name('tp_widget_fb_like_title').'" value="'.esc_attr($instance['tp_widget_fb_like_title']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>
		<p><label>'.__('Page to like','ingrid').':</label>
		<input id="'.$this->get_field_id('tp_widget_fb_like_page').'" type="text" name="'.$this->get_field_name('tp_widget_fb_like_page').'" value="'.esc_attr($instance['tp_widget_fb_like_page']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>
		<p><label>'.__('Display faces','ingrid').':</label>
		<select id="'.$this->get_field_id('tp_widget_fb_like_faces').'" name="'.$this->get_field_name('tp_widget_fb_like_faces').'">
		<option value="true"'; if($instance['tp_widget_fb_like_faces'] == 'true'){print ' selected="selected"';} print '>Yes</option>
		<option value="false'; if($instance['tp_widget_fb_like_faces'] == 'false'){print ' selected="selected"';} print '">No</option>
		</select></p>';
	 }
}

register_widget('tp_widget_fb_like');
?>