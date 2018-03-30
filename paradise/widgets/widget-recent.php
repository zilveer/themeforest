<?php class RecentPostsWidget extends WP_Widget
{
	var $excertp_length;

	function RecentPostsWidget(){
		$widget_opts = array('classname' => 'widget_recent_posts', 'description' => __('The most recent posts on your site with thumbnails', TEMPLATENAME));
		parent::WP_Widget(false, __('Recent Posts +', TEMPLATENAME), $widget_opts);
	}

  /* Displays the Widget in the front-end */
	function widget($args, $instance){
		extract($args);
		$title = strip_tags($instance['title']);
		$posts_count = $instance['posts_count'];
		$category = $instance['category'];
		$show_thumbnail = $instance['show_thumbnail'];
		$thumb_size = $instance['thumb_size'];
		$show_excerpt = $instance['show_excerpt'];
		$excerpt_length = $instance['excerpt_length'];
		$show_date = $instance['show_date'];

		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title;

		$loop_options = array(
			'posts_per_page' => $posts_count,
			'post_type' => 'post',
			'orderby' => 'post_date',
			'order' => 'DESC'
		);
		if (!empty($category)) {
			$loop_options['cat'] = $category;
		}
		if ($show_excerpt) {
			$this->excertp_length = $excerpt_length;
		}

		$loop = new WP_Query($loop_options);
		if($loop->have_posts()) :

		add_filter('excerpt_length', array(&$this, 'recent_excerpt_length'));
?>
			<ul>
			<?php while($loop->have_posts()) :
				$loop->the_post(); ?>
				<li>
					<a href="<?php the_permalink() ?>">
						<?php if ($show_thumbnail) the_post_thumbnail($thumb_size, array('class' => 'pic alignleft', 'title' => false)); ?>
						<h4><?php the_title(); ?></h4>
						<?php if ($show_excerpt): ?><div class="short"><?php echo get_the_excerpt(); ?></div><?php endif; ?>
						<?php if ($show_date): ?><span class="date"><?php echo get_the_date(); ?></span><?php endif; ?>
					</a>
				</li>
			<?php endwhile; ?>
			</ul>


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
		$categories = get_terms('category');
		foreach($categories as &$category) {
			$category = $category->term_id;
		}
		$instance['category'] = (in_array($new_instance['category'], $categories)) ? $new_instance['category'] : '';
		$instance['show_thumbnail'] = (bool) $new_instance['show_thumbnail'];
		$instance['thumb_size'] = (array_key_exists($new_instance['thumb_size'], $this->get_sizes())) ? $new_instance['thumb_size'] : '';
		$instance['show_excerpt'] = (bool) $new_instance['show_excerpt'];
		$instance['excerpt_length'] = (int) $new_instance['excerpt_length'];
		$instance['show_date'] = (bool) $new_instance['show_date'];

		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
	function form($instance){
		$instance = wp_parse_args((array) $instance, array(
			'title' => __('Recent Posts', TEMPLATENAME),
			'posts_count' => 3,
			'show_thumbnail' => true,
			'thumb_size' => 'thumbnail',
			'show_excerpt' => true,
			'excerpt_length' => 10,
			'show_date' => true,
		));

		$title = strip_tags($instance['title']);
		$posts_count = $instance['posts_count'];
		$category = $instance['category'];
		$show_thumbnail = $instance['show_thumbnail'];
		$thumb_size = $instance['thumb_size'];
		$show_excerpt = $instance['show_excerpt'];
		$excerpt_length = $instance['excerpt_length'];
		$show_date = $instance['show_date'];

		$cats = get_terms('category');

		$sizes = $this->get_sizes();
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', TEMPLATENAME) ?></label><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('posts_count'); ?>"><?php _e('Number of posts to show:', TEMPLATENAME) ?></label><input class="widefat" id="<?php echo $this->get_field_id('posts_count'); ?>" name="<?php echo $this->get_field_name('posts_count'); ?>" type="text" value="<?php echo $posts_count; ?>" /></p>
		<p>
		<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select posts category:', TEMPLATENAME); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
		<option value=""><?php _e('All Categolries', TEMPLATENAME); ?></option>
		<?php
		foreach ($cats as $cat) {
			echo '<option value="' . intval($cat->term_id) . '"'
				. ($cat->term_id == $instance['category'] ? ' selected="selected"' : '')
				. '>' . $cat->name . "</option>\n";
		}
		?>
		</select></p>
		<p>
			<input id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" type="checkbox" <?php checked($show_thumbnail); ?> />&nbsp;<label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e('Show post thumbnail?', TEMPLATENAME); ?></label>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('thumb_size'); ?>"><?php _e('Select thumbnail size:', TEMPLATENAME); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('thumb_size'); ?>" name="<?php echo $this->get_field_name('thumb_size'); ?>">
		<?php
		foreach ( $sizes as $key => $val ) {
			echo '<option value="' . $key . '"'
				. selected($instance['thumb_size'], $key)
				. '>' . $val . "</option>\n";
		}
		?>
		</select></p>
		<p>
			<input id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" type="checkbox" <?php checked($show_excerpt); ?> />&nbsp;<label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e('Show post excerpt?', TEMPLATENAME); ?></label>
		</p>
		<p><label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt length:', TEMPLATENAME) ?></label><input class="widefat" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" type="text" value="<?php echo $excerpt_length; ?>" /></p>
		<p>
			<input id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" type="checkbox" <?php checked($show_date); ?> />&nbsp;<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Show post date?', TEMPLATENAME); ?></label>
		</p>
		<?php
	}

	function get_sizes() {
		global $_wp_additional_image_sizes;
		$sizes = array();
		$default_sizes = array('large', 'medium', 'thumbnail');
		foreach($default_sizes as $size) {
			$sizes[$size] = array('width' => get_option("{$size}_size_w"), 'height' => get_option("{$size}_size_h"));
		}
		$sizes = array_merge($sizes, $_wp_additional_image_sizes);
		foreach($sizes as $name => &$data) {
			$data = "$name ({$data['width']}x{$data['height']})";
		}
		return $sizes;
	}

}// end RecentPostsWidget class

function RecentPostsWidgetInit() {
  register_widget('RecentPostsWidget');
}

add_action('widgets_init', 'RecentPostsWidgetInit');

?>