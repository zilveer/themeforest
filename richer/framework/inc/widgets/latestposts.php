<?php


class widget_latestposts extends WP_Widget { 
	
	// Widget Settings
	function widget_latestposts() {
		$widget_ops = array('description' => __('Display your posts', 'richer') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'latestposts' );
		$this->__construct( 'latestposts', __('richer-Posts', 'richer'), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$number = $instance['number'];
		$order_by = $instance['order_by'];
		$order = $instance['order'];
		
		echo $before_widget;

		if($title) {
			echo $before_title . $title . $after_title;
		}
		?>
		<ul class="list-latestposts">
		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $number,
			'order' => $order,
			'orderby' => $order_by
		);
		$latestposts = new WP_Query($args);
		if($latestposts->have_posts()):
		?>
		<?php while($latestposts->have_posts()): $latestposts->the_post(); ?>
		<li class="post-item">
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
       </li>
		<?php endwhile; endif; wp_reset_postdata();?>
		</ul>

		<?php echo $after_widget;
	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['order_by'] = $new_instance['order_by'];
		$instance['order'] = $new_instance['order'];
		
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		$selected1 = '';
		$selected2 = '';
		$selected3 = '';
		$selected4 = '';
		$selected5 = '';
		
		$defaults = array('title' => 'Latest posts', 'number' => 3, 'order_by' => 'date', 'order'=>'DESC');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e("Title","richer-framework"); ?>:</label>
			<input type="text" class="widefat" style="width: 216px;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e("Number of items to show","richer-framework"); ?>:</label>
			<input type="text" class="widefat" style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
		</p>
		<p>
			<?php
			switch ($instance['order']) {
				case 'ASC':
					$selected1 = 'selected="selected"';
					break;
				case 'DESC':
					$selected2 = 'selected="selected"';
					break;
				default:
					$selected1 = '';
					$selected2 = '';
					break;
			}
			?>
			<label for="<?php echo esc_attr($this->get_field_id( 'order' )); ?>"><?php _e("Order","richer-framework"); ?>:</label>
			<select id="<?php echo esc_attr($this->get_field_id( 'order' )); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name( 'order' )); ?>">
			  <option value="ASC" <?php echo $selected1; ?>><?php _e("Lowest to highest values","richer-framework"); ?></option>
			  <option value="DESC" <?php echo $selected2; ?>><?php _e("Highest to lowest values","richer-framework"); ?></option>
			</select>
		</p>

		<p>
			<?php
			switch ($instance['order_by']) {
				case 'title':
					$selected1 = 'selected="selected"';
					break;
				case 'ID':
					$selected2 = 'selected="selected"';
					break;
				case 'date':
					$selected3 = 'selected="selected"';
					break;
				case 'modified':
					$selected4 = 'selected="selected"';
					break;
				case 'comment_count':
					$selected5 = 'selected="selected"';
					break;
				default:
					$selected1 = '';
					$selected2 = '';
					$selected3 = '';
					$selected4 = '';
					$selected5 = '';
					break;
			}
			?>
			<label for="<?php echo esc_attr($this->get_field_id( 'order_by' )); ?>"><?php _e("Order by","richer-framework"); ?>:</label>
			<select id="<?php echo esc_attr($this->get_field_id( 'order_by' )); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name( 'order_by' )); ?>">
			  <option value="title" <?php echo $selected1; ?>><?php _e("Title","richer-framework"); ?></option>
			  <option value="ID" <?php echo $selected2; ?>><?php _e("Post's ID","richer-framework"); ?></option>
			  <option value="date" <?php echo $selected3; ?>><?php _e("Date","richer-framework"); ?></option>
			  <option value="modified" <?php echo $selected4; ?>><?php _e("Modified date","richer-framework"); ?></option>
			  <option value="comment_count" <?php echo $selected5; ?>><?php _e("Popular","richer-framework"); ?></option>
			</select>
		</p>
	<?php
	}
}

// Add Widget
function widget_latestposts_init() {
	register_widget('widget_latestposts');
}
add_action('widgets_init', 'widget_latestposts_init');

?>