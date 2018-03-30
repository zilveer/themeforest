<?php

class RecentComments_Widget extends WP_Widget {
	function RecentComments_Widget() {
		$widget_ops = array('classname' => 'recentComments_widget', 'description' => __('Show your recent blog comments on your site.','smartbox'));
		parent::__construct(false, 'DESIGNARE _ Recent Comments', $widget_ops);
	}
function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		
		if (isset($instance['title'])){
			$title = esc_attr($instance['title']);	
		} else $title = "";
		
		if (isset($instance['nposts'])){
			$nposts = esc_attr($instance['nposts']); 	
		} else $nposts = "";
		
		if (isset($instance['orderby'])){
			$orderby = esc_attr($instance['orderby']);	
		} else $orderby = "";
		
		if (isset($instance['order'])){
			$order = esc_attr($instance['order']);  	
		} else $order = "";
		
?>  
        <p><label for="<?php echo $this->get_field_id('title'); ?>">&#8212; <?php _e('Title','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p> 
        <p><label for="<?php echo $this->get_field_id('nposts'); ?>">&#8212; <?php _e('Number Posts to show','smartbox'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('nposts'); ?>" name="<?php echo $this->get_field_name('nposts'); ?>" type="text" value="<?php echo $nposts; ?>" /><br><span class="flickr-stuff">If 0 will show all posts.</span></label></p>
        		    <p><label>&#8212; <?php _e('Order by','smartbox'); ?> &#8212;<br>
		    		<input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="title" <?php if($orderby == 'title') echo 'checked'; ?>> <?php _e('Title','smartbox'); ?><br>
		    		<input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="date" <?php if($orderby == 'date') echo 'checked'; ?>> <?php _e('Date','smartbox'); ?><br>
		    		<input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="author" <?php if($orderby == 'author') echo 'checked'; ?>> <?php _e('Author','smartbox'); ?><br>
		    		<input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="comment_count" <?php if($orderby == 'comment_count') echo 'checked'; ?>> <?php _e('Number Comments','smartbox'); ?><br>
		    </label></p>
		    <p><label>&#8212; <?php _e('Order','smartbox'); ?> &#8212;<br>
		    		<input type="radio" name="<?php echo $this->get_field_name('order'); ?>" value="asc" <?php if($order == 'asc') echo 'checked'; ?>> <?php _e('Ascending','smartbox'); ?><br>
		    		<input type="radio" name="<?php echo $this->get_field_name('order'); ?>" value="desc" <?php if($order == 'desc') echo 'checked'; ?>> <?php _e('Descending','smartbox'); ?><br>
		    </label></p>
<?php
	}
function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['nposts'] = $new_instance['nposts'];
    $instance['orderby'] = $new_instance['orderby'];
    $instance['order'] = $new_instance['order'];
		return $instance;
	}
	
function widget($args, $instance) {
		
	extract($args);
    $title = apply_filters('widget_title', $instance['title'], $instance);
    $nposts = $instance['nposts'];
    $orderby = $instance['orderby'];
    $order = $instance['order'];
    	
	//query_posts( array( 'posts_per_page' => get_option('posts_per_page'), 'paged' => $pag ) );
    
    $args = array(
			'number' => $nposts,
			'orderby' => $orderby,
			'order' => $order,
			'status' => 'approve'
		);
		
	$comments = get_comments($args);
	
	if ($comments){ ?>
	
		<div class="recentcomments_widget widget">
		
			<h2><?php 
				if (!empty($title)) echo $title;
				else _e("Recent Posts",'smartbox'); ?>
			</h2>
		
			<ul class="recentcomments_listing">
			
			<?php 
				
				
				foreach($comments as $comment) :
					
					$source = get_avatar($comment->user_id, 60);
					
					if($comment->user_id == 0)
					 $current_link = "javascript:;";
					else 
					 $current_link = "?author=".$comment->user_id;
					
					//if (!function_exists('icl_object_id'))					
						echo('<li ><a class="the_title" href="'.home_url() . '/?p='.$comment->comment_post_ID.'">'.$source.'	</a><a class="the_title" href="'.home_url() . '/?p='.$comment->comment_post_ID.'">'.get_the_title($comment->comment_post_ID) . '</a><br><span class="blog-i">'. __(get_option(DESIGNARE_SHORTNAME."_by_text"), "smartbox"). ':&nbsp;</span><a class="the_author" href="' . $current_link.'">'.$comment->comment_author.'</a></li>');
					endforeach;
			
			?>
			
			</ul>
		</div>
<?php }

	 }
}
register_widget('RecentComments_Widget');

?>