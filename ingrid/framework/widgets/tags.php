<?php

/* WIDGET - CATS */


class tp_widget_tags_cats extends WP_Widget {
	
	

	function tp_widget_tags_cats() {
		$widget_ops = array('classname' => 'tp_widget_tags_cats', 'description' => __('Display Categories with tag graphic','ingrid') );
		parent::__construct('tp_widget_tags_cats', '* Categories', $widget_ops);
	}


	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		
		if(!empty($instance['tp_widget_tags_cats_title'])){ print $before_title . $instance['tp_widget_tags_cats_title'] . $after_title; }
		
		
			$instance['tp_widget_tags_cats_list'] = maybe_unserialize($instance['tp_widget_tags_cats_list']);
			
			//display category tags								
			if(empty($instance['tp_widget_tags_cats_list'])){ 
				//show all
				$cats = get_categories(array('type' => 'post'));
				print '<section class="widget_tag_cloud">';
				foreach($cats as $cat){
					$cat_link = get_category_link($cat->term_id);
					print '<a href="'.$cat_link.'">'.$cat->name.'</a>';
				}
				print '</section>';
			}else{
				print '<section class="widget_tag_cloud">';
				foreach($instance['tp_widget_tags_cats_list'] as $cat){					
					print '<a href="'.get_category_link($cat).'">'.get_cat_name($cat).'</a>';
				}
				print '</section>';
			}
		
		echo $after_widget;
	}

	
	function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['tp_widget_tags_cats_title'] = strip_tags($new_instance['tp_widget_tags_cats_title']);								
		$instance['tp_widget_tags_cats_list'] = $new_instance['tp_widget_tags_cats_list'];		
				
		update_option('tp_widget_tags_cats_title',$instance['tp_widget_tags_cats_title']);	
		update_option('tp_widget_tags_cats_list',$instance['tp_widget_tags_cats_list']);
        return $instance;
    }

	
	function form($instance) {
		$defaults = array( 'tp_widget_tags_cats_title' => '', 'tp_widget_tags_cats_list' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$instance['tp_widget_tags_cats_list'] = maybe_unserialize($instance['tp_widget_tags_cats_list']);
		
				
		echo '<p><label>'.__('Title','ingrid').':</label>
		<input id="'.$this->get_field_id('tp_widget_tags_cats_title').'" type="text" name="'.$this->get_field_name('tp_widget_tags_cats_title').'" value="'.esc_attr($instance['tp_widget_tags_cats_title']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>		
		<p><label><b>'.__('Select categories to display','ingrid').'</b></label></p>
		<p>'.__('If none is selected, all categories will be displayed.','ingrid').'</p>
		<p>';
			$categories =  get_categories();
			if(!empty($categories)){
			foreach ($categories as $cat){
			$option = '<input type="checkbox" id="'. $this->get_field_id( 'tp_widget_tags_cats_list' ) .'[]" name="'. $this->get_field_name( 'tp_widget_tags_cats_list' ) .'[]"';
				if (is_array($instance['tp_widget_tags_cats_list'])) {
					foreach ($instance['tp_widget_tags_cats_list'] as $cats) {
						if($cats==$cat->term_id) {
						$option = $option.' checked="checked"';
						}
					}
				}
				$option .= ' value="'.$cat->term_id.'" />';
                $option .= ' <label>'.$cat->cat_name.'</label>';    
                $option .= '<br />';
                echo $option;
            }
			}
		echo '
		</p>';
	 }
}

register_widget('tp_widget_tags_cats');
?>