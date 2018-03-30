<?php
class MthemeComments extends WP_Widget {

	//Widget Setup
	function __construct() {
		$widget_ops=array('classname' => 'widget_recent_comments', 'description' => __('The most recent comments', 'mtheme'));
		parent::__construct('recent-comments', __('Recent Comments', 'mtheme'), $widget_ops);
		$this->alt_option_name='widget_recent_comments';
	}
	
	//Get Comments
	function get_comments($number=0) {
		add_filter('comments_clauses', array($this, 'filter_comments'));
		return get_comments(apply_filters('widget_comments_args', array('number' => $number, 'status' => 'approve', 'post_status' => 'publish')));
	}
	
	//Filter Comments
	function filter_comments($query) {
        $query['where'].=" AND post_type='post'";
		remove_filter('comments_clauses', array($this, 'filter_comments'));
		return $query;
	}

	//Widget View
	function widget($args, $instance) {
		global $comments, $comment;

 		extract($args, EXTR_SKIP);
 		$out='';
		$title=apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments', 'mtheme') : $instance['title'], $instance, $this->id_base);

		if(empty($instance['number']) || ! $number=absint($instance['number'])) {
			$number=5;
		}			

		$comments=$this->get_comments($number);
		$out.=$before_widget;
		$out.=$before_title.$title.$after_title;

		$out .= '<ul class="styled-list style-2">';
		if(is_array($comments)) {
			foreach ($comments as $comment) {
				$out.='<li><a href="'.get_author_posts_url($comment->user_id).'">'.get_comment_author().'</a> '.__('on', 'mtheme').' <a href="'.esc_url(get_comment_link($comment->comment_ID)).'">'.get_the_title($comment->comment_post_ID).'</a></li>';
			}
 		}
		$out .= '</ul>';
		$out .= $after_widget;

		echo $out;
	}

	//Update Widget
	function update($new_instance, $old_instance) {
		$instance=$old_instance;
		$instance['title']=strip_tags($new_instance['title']);
		$instance['number']=absint($new_instance['number']);
		return $instance;
	}
	
	//Widget Form
	function form($instance) {
		$title=isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number=isset($instance['number']) ? absint($instance['number']) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'mtheme'); ?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show', 'mtheme'); ?>:</label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<?php
	}
}