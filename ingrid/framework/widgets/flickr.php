<?php

/* WIDGET - FLICKR TWEETS */


class tp_widget_flickr extends WP_Widget {
	
	

	function tp_widget_flickr() {
		$widget_ops = array('classname' => 'tp_widget_flickr', 'description' => __('Display Flickr images','ingrid') );
		parent::__construct('tp_widget_flickr', '* Flickr', $widget_ops);
	}


	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['tp_w_flickr_title']) ? '&nbsp;' : apply_filters('widget_title', $instance['tp_w_flickr_title']);		
		if(empty($title)){$title = 'Flickr';}
		if(empty($instance['tp_w_flickr_rss_url'])){$instance['tp_w_flickr_rss_url'] = '21271581@N02';}
		if(empty($instance['tp_w_flickr_count'])){$items = '6';}else{$items = $instance['tp_w_flickr_count'];}
		print $before_title . $title . $after_title;
			
		print '<div id="flickr_feed"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$items.'&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$instance['tp_w_flickr_rss_url'].'"></script></div>';
		
		echo $after_widget;
	}

	
	function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['tp_w_flickr_title'] = strip_tags($new_instance['tp_w_flickr_title']);		
		$instance['tp_w_flickr_rss_url'] = strip_tags($new_instance['tp_w_flickr_rss_url']);				
		$instance['tp_w_flickr_count'] = strip_tags($new_instance['tp_w_flickr_count']);	
		
		update_option('tp_w_flickr_rss_url',$instance['tp_w_flickr_rss_url']);
		update_option('tp_w_flickr_count',$instance['tp_w_flickr_count']);
        return $instance;
    }

	
	function form($instance) {
		$defaults = array( 'tp_w_flickr_title' => '', 'tp_w_flickr_rss_url' => '', 'tp_w_flickr_count' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
				
		echo '<p><label>'.__('Title','ingrid').':</label>
		<input id="'.$this->get_field_id('tp_w_flickr_title').'" type="text" name="'.$this->get_field_name('tp_w_flickr_title').'" value="'.esc_attr($instance['tp_w_flickr_title']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>
		<p><label>'.__('Flickr User ID','ingrid').': (<a href="http://idgettr.com/" target="_blank">Get User ID</a>)</label>
		<input id="'.$this->get_field_id('tp_w_flickr_rss_url').'" type="text" name="'.$this->get_field_name('tp_w_flickr_rss_url').'" value="'.esc_attr($instance['tp_w_flickr_rss_url']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>
		<p><label>'.__('Number of images to display','ingrid').':</label>
		<input id="'.$this->get_field_id('tp_w_flickr_count').'" type="text" name="'.$this->get_field_name('tp_w_flickr_count').'" value="'.esc_attr($instance['tp_w_flickr_count']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>';		
	 }
}

register_widget('tp_widget_flickr');
?>