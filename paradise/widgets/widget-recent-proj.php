<?php
class RecentProjWidget extends WP_Widget
{
	var $excertp_length;

	function RecentProjWidget(){
		$widget_opts = array('classname' => 'widget_recent_projects', 'description' => __('The most recent projects on your site with slider (for sustom post type "Portfolio")', TEMPLATENAME));
		$control_ops = array('id_base' => 'widget_recent_projects');
		parent::WP_Widget('widget_recent_projects', __('Recent Projects +', TEMPLATENAME), $widget_opts, $control_ops);
		add_action('wp_enqueue_scripts', array($this, 'widget_scripts'));

		add_image_size('widget_recent_proj', 260, 125, true);
	}

	function widget_scripts() {
		if (is_active_widget(false, false, 'widget_recent_projects')){
			wp_enqueue_script('js_cycle', get_bloginfo('template_directory') . '/js/jquery.cycle.all.min.js', array('jquery'), '1.2.6', true);
			wp_enqueue_script('js_cycle_common', get_bloginfo('template_directory') . '/js/common_cycle.js', array('jquery'), '1.2.6', true);
		}
	}

  /* Displays the Widget in the front-end */
	function widget($args, $instance){
		extract($args);
		$title = strip_tags($instance['title']);
		$posts_count = $instance['posts_count'];
		$category = $instance['category'];
		$show_title = $instance['show_title'];
		$show_excerpt = $instance['show_excerpt'];
		$excerpt_length = $instance['excerpt_length'];

		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title;

		$loop_options = array(
			'posts_per_page' => $posts_count,
			'post_type' => 'portfolio',
			'orderby' => 'post_date',
			'order' => 'DESC'
		);
		if (!empty($category)) {
			$loop_options['tax_query'] = array(
				array(
					'taxonomy' => 'projects',
					'field' => 'id',
					'terms' => $category,
				),
			);
		}
		if ($show_excerpt) {
			$this->excertp_length = $excerpt_length;
		}

		$loop = new WP_Query($loop_options);
		if($loop->have_posts()) :

		add_filter('excerpt_length', array(&$this, 'recent_excerpt_length'));
?>
		<div class="recent_proj">
		<?php while($loop->have_posts()): $loop->the_post(); ?>
			<div style="padding: 0 10px 0 0;">
				<div class="thumb"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('widget_recent_proj', array('title' => false, 'class' => 'pic')); ?></a></div>
				<?php if ($show_title): ?><h5><?php the_title(); ?></h5><?php endif; ?>
				<?php if ($show_excerpt): ?><p><?php echo get_the_excerpt(); ?></p><?php endif; ?>
			</div>
		<?php endwhile; ?>
		</div>
		<div class="clear"></div>

		<?php endif;

		remove_filter('excerpt_length', array(&$this, 'recent_excerpt_length'));

		echo $after_widget;
	}

	function recent_excerpt_length($length) {
		return $this->excertp_length;
	}

  /*Saves the settings. */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['posts_count'] = (int) $new_instance['posts_count'];
		$categories = get_terms('projects');
		foreach($categories as &$category) {
			$category = $category->term_id;
		}
		$instance['category'] = (in_array($new_instance['category'], $categories)) ? $new_instance['category'] : '';
		$instance['show_title'] = (bool) $new_instance['show_title'];
		$instance['show_excerpt'] = (bool) $new_instance['show_excerpt'];
		$instance['excerpt_length'] = (int) $new_instance['excerpt_length'];

		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
	function form($instance){
		$instance = wp_parse_args((array) $instance, array(
			'title' => __('Recent Projects', TEMPLATENAME),
			'posts_count' => 3,
			'show_title' => true,
			'show_excerpt' => true,
			'excerpt_length' => 15,
		));

		$title = strip_tags($instance['title']);
		$posts_count = $instance['posts_count'];
		$category = $instance['category'];
		$show_title = $instance['show_title'];
		$show_excerpt = $instance['show_excerpt'];
		$excerpt_length = $instance['excerpt_length'];

		$cats = get_terms('projects');

	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', TEMPLATENAME) ?></label><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('posts_count'); ?>"><?php _e('Number of posts to show:', TEMPLATENAME) ?></label><input class="widefat" id="<?php echo $this->get_field_id('posts_count'); ?>" name="<?php echo $this->get_field_name('posts_count'); ?>" type="text" value="<?php echo $posts_count; ?>" /></p>
		<p>
		<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select projects category:', TEMPLATENAME); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
		<option value=""><?php _e('All Categolries', TEMPLATENAME); ?></option>
		<?php
		foreach ($cats as $cat) {
			echo "<option value=\"{$cat->term_id}\"".selected($cat->term_id, $category).">{$cat->name}</option>\n";
		}
		?>
		</select></p>
		<p>
			<input id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" type="checkbox" <?php checked($show_title); ?> />&nbsp;<label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Show post title?', TEMPLATENAME); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" type="checkbox" <?php checked($show_excerpt); ?> />&nbsp;<label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e('Show post excerpt?', TEMPLATENAME); ?></label>
		</p>
		<p><label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt length:', TEMPLATENAME) ?></label><input class="widefat" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" type="text" value="<?php echo $excerpt_length; ?>" /></p>
		<?php
	}

}// end RecentProjWidget class

function RecentProjWidgetInit() {
  register_widget('RecentProjWidget');
}

add_action('widgets_init', 'RecentProjWidgetInit');

?>