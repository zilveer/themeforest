<?php

// Recent Posts
// ----------------------------------------------------
class BoxyWidgetRecentPosts extends BoxyWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function BoxyWidgetRecentPosts() {
		$widget_opts = array(
			'classname' => 'theme-widget-recent-posts', // class of the <li> holder
			'description' => __( 'Displays recent posts in a custom style.','espresso' ) // description shown in the widget list
		);
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		parent::__construct('theme-widget-recent-posts', __('[ESPRESSO] Recent Posts','espresso'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>'Title', 
				'default'=>__('Recent Posts','espresso')
			),
			array(
				'name'=>'hide_thumbnails',
				'type'=>'set',
				'title'=>'Hide Thumbnails?', 
				'default'=>false,
				'options'=>array(true => 'Yes')
			),
			array(
				'name'=>'categories',
				'type'=>'multiCategories',
				'title'=>__('Select Categories','espresso'),
				'default'=>''
			),
			array(
				'name'=>'load',
				'type'=>'integer',
				'title'=>__('How many total items?','espresso'), 
				'default'=>'10'
			)
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
	
		extract($args);
		
		$limit = intval($instance['load']);
		$title = $instance['title'];
		global $hide_thumbnails, $thumbnail_type;
		$hide_thumbnails = $instance['hide_thumbnails'];
		$hide_thumbnails = $hide_thumbnails[0];
		$categories = $instance['categories'];
		if ($categories) { $categories = implode(",",$categories); }
		$thumbnail_type = 'recent-post-thumbnail';
		
		$current_sidebar = $args['id'];
		if ($current_sidebar == 'homepage-horizontal-blocks') { $is_horizontal = true; } else { $is_horizontal = false; }
		
		query_posts(array('posts_per_page'=>$limit, 'cat'=>$categories));
		if ( have_posts() ) : ?>
				
			<?php echo ($title ? $before_title.$title.$after_title : ''); ?>
			
			<?php $temp_counter = 0;
			while ( have_posts() ) : the_post(); global $post; $temp_counter++;
				
				get_template_part('singlerow','post');
							
			endwhile;
						
		endif; wp_reset_query();
		
	}
}

?>