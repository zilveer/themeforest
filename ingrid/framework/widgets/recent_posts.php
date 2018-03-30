<?php
/* WIDGET - RECENT POSTS */

class tp_widget_recent_posts extends WP_Widget {
	function tp_widget_recent_posts() {
		$widget_ops = array('classname' => 'tp_widget_recent_posts', 'description' => __('Display recent posts with featured image','ingrid') );
		parent::__construct('tp_widget_recent_posts', '* Recent Posts', $widget_ops);
	}


	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['tp_w_recent_posts_title']) ? '&nbsp;' : apply_filters('widget_title', $instance['tp_w_recent_posts_title']);		
		if(empty($title)){$title = 'Recent Posts';}
		if(empty($instance['tp_w_recent_posts_count'])){$instance['tp_w_recent_posts_count'] = '3';}
		print $before_title . $title . $after_title;
		
		//print recent posts
		echo '<ul class="widget_post_list">';	 
		global $post;		
		
		$instance['tp_w_recent_posts_display_cats'] = maybe_unserialize($instance['tp_w_recent_posts_display_cats']);
			
		if(!empty($instance['tp_w_recent_posts_display_cats'])){
			$myposts = get_posts('posts_per_page=' . $instance['tp_w_recent_posts_count'] . '&category=' . implode(',',$instance['tp_w_recent_posts_display_cats']));
		}else{			
			$myposts = get_posts('posts_per_page=' . $instance['tp_w_recent_posts_count']);
		}
		
		$fctr = '1';
		foreach($myposts as $post) {
			setup_postdata($post);	
			
			echo '	<li>';	
			
			
			$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(80,55), false, '' );

			//if has thumb			
			if($src[0] != ''){
				echo '
				<p>
					<a href="'.get_permalink().'"><img class="tn" src="'.$src[0].'" alt="post thumbnail" />';
			}else{
				echo '
				<p>
					<a href="'.get_permalink().'">';
			}			
						
			echo get_the_title().'</a><br />';
			
			if($instance['tp_w_recent_posts_display'] == '' OR $instance['tp_w_recent_posts_display'] == 'time'){
				echo '<span>'.get_the_date().'</span>';
				
			}else{						
				$myexc = get_the_excerpt();
				$myexc = strip_tags($myexc);
				
				echo '<span>'.substr($myexc,0,90) . '...</span>
				</p>';			
			}
			print '</li>';
			
			$fctr++;
		}		 
		
		wp_reset_query();
		
		echo '</ul>';

		echo $after_widget;
	}

	
	function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['tp_w_recent_posts_title'] = strip_tags($new_instance['tp_w_recent_posts_title']);		
		$instance['tp_w_recent_posts_display'] = strip_tags($new_instance['tp_w_recent_posts_display']);		
		$instance['tp_w_recent_posts_count'] = strip_tags($new_instance['tp_w_recent_posts_count']);		
		$instance['tp_w_recent_posts_display_cats'] = $new_instance['tp_w_recent_posts_display_cats'];	
        return $instance;
    }

	
	function form($instance) {
		$defaults = array( 'tp_w_recent_posts_title' => '', 'tp_w_recent_posts_display' => '', 'tp_w_recent_posts_count' => '', 'tp_w_recent_posts_display_cats' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
				
		echo '<p><label>'.__('Title','ingrid').':</label>
		<input type="text" name="'.$this->get_field_name('tp_w_recent_posts_title').'" value="'.esc_attr($instance['tp_w_recent_posts_title']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>
		<p><label>'.__('Display also the','ingrid').':</label>
		<select name="'.$this->get_field_name('tp_w_recent_posts_display').'">
		<option value="time"'; if($instance['tp_w_recent_posts_display'] == 'time'){print ' selected="selected"';} print '>'.__('Date','ingrid').'</option>
		<option value="excerpt"'; if($instance['tp_w_recent_posts_display'] == 'excerpt'){print ' selected="selected"';} print '>'.__('Excerpt','ingrid').'</option>
		</select></p>
		<p><label>'.__('Number of posts to display','ingrid').':</label>
		<input type="text" name="'.$this->get_field_name('tp_w_recent_posts_count').'" value="'.esc_attr($instance['tp_w_recent_posts_count']).'" style="font-size: 11px; width: 30px;" /></p>
		<p><label><b>'.__('Post category(s) to display','ingrid').'</b></label></p>
		<p>'.__('If none is selected, all categories will be displayed.','ingrid').'</p>
		<p>';
			$instance['tp_w_recent_posts_display_cats'] = maybe_unserialize($instance['tp_w_recent_posts_display_cats']);
			$categories =  get_categories();
			if(!empty($categories)){
			foreach ($categories as $cat){
			$option = '<input type="checkbox" id="'. $this->get_field_id( 'tp_w_recent_posts_display_cats' ) .'[]" name="'. $this->get_field_name( 'tp_w_recent_posts_display_cats' ) .'[]"';
				if (is_array($instance['tp_w_recent_posts_display_cats'])) {
					foreach ($instance['tp_w_recent_posts_display_cats'] as $cats) {
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
		</p>
		';
	 }
}

register_widget('tp_widget_recent_posts');
?>