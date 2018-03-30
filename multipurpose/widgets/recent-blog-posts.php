<?php
add_action('widgets_init', 'recent_blog_posts_widget_register');

function recent_blog_posts_widget_register() {
	register_widget('RecentBlogPosts_Widget');
}

class RecentBlogPosts_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'recent_blog_posts_widget',
			__('MultiPurpose Recent Blog Posts', 'multipurpose'),
			array('description' => esc_attr__('Shows recent posts on your blog', 'multipurpose'))
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters('widget_title', $instance['title']); 
	    $limit = is_numeric($instance['limit']) ? $instance['limit'] : 10;

	    echo $args['before_widget'];  
	    if (!empty($title)) {
	    	echo $args['before_title'] . $title . $args['after_title'];  
	    }  

	    $options = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $limit,
			'ignore_sticky_posts' => true,
			'orderby' => 'date',
			'order' => 'desc'
		);
		$posts_query = new WP_Query($options);
		if($posts_query->have_posts()) {
			?>
			<ul class="recent-posts">
			<?php
			while($posts_query->have_posts()) {
				$posts_query->the_post(); ?>
					<li><span><?php the_time(get_option('date_format')) ?></span><br><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php
			}
			?>
			</ul>
			<?php
		}
	    echo $args['after_widget'];  
	}

	public function form($instance) {
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_attr_e('Title:', 'multipurpose'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<?php 
		if (isset($instance['limit'])) {
			$limit = $instance['limit'];
		} else {
			$limit = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('limit'); ?>"><?php esc_attr_e('Number of posts:', 'multipurpose'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr($limit); ?>" />
		</p>
		<?php
	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : 0;
		$instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : 10;
		return $instance;
	}	
}
?>