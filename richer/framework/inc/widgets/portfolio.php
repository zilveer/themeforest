<?php


class widget_portfolio extends WP_Widget { 
	
	// Widget Settings
	function widget_portfolio() {
		$widget_ops = array('description' => __('Display your latest Portfolio', 'richer') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'portfolio' );
		$this->__construct( 'portfolio', __('richer-Portfolio', 'richer'), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$number = $instance['number'];
		
		echo $before_widget;

		if($title) {
			echo $before_title . $title . $after_title;
		}
		?>
		<div class="recent-works-items row">
		<?php
		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' => $number,
			'meta_key' => '_thumbnail_id'
		);
		$portfolio = new WP_Query($args);
		if($portfolio->have_posts()):
		?>
		<?php while($portfolio->have_posts()): $portfolio->the_post(); ?>
		<div class="portfolio-widget-item span4">
            <?php if (has_post_thumbnail()) { ?>
            	<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="portfolio-pic"><?php the_post_thumbnail( 'mini' ); ?></a>
            <?php } ?>
       </div>
		<?php endwhile; endif; wp_reset_postdata();?>
		</div>

		<?php echo $after_widget;
	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => 'Latest Project', 'number' => 1);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
			<input type="text" class="widefat" style="width: 216px;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>">Number of items to show:</label>
			<input type="text" class="widefat" style="width: 50px;" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
		</p>
	<?php
	}
}

// Add Widget
function widget_portfolio_init() {
	register_widget('widget_portfolio');
}
add_action('widgets_init', 'widget_portfolio_init');

?>