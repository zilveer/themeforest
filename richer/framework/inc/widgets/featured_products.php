<?php


class widget_featured_products extends WP_Widget { 
	
	// Widget Settings
	function widget_featured_products() {
		$widget_ops = array('description' => __('Display your featured products', 'richer') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'featured_products' );
		$this->__construct( 'featured_products', __('richer-Featured products', 'richer'), $widget_ops, $control_ops );
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
		<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => $number,
			'meta_key' => '_featured',
			'meta_value' => 'yes',
		);

		$products = new WP_Query($args);
		if($products->have_posts()):
		?>
		<script type="text/javascript">
            jQuery(window).load(function() {
              jQuery(".products-slider").flexslider({
                animation: "slide",
                smoothHeight : true,
                directionNav: true,
                controlNav: false,
                itemMargin: 0,
                minItems: 1,
                maxItems: 1
              });
            });
        </script>
		<div class="products-slider flexslider">
			<ul class="slides">
				<?php while($products->have_posts()): $products->the_post(); ?>
				<li class="featured-products-item">
		            <?php if (has_post_thumbnail()) { ?>
		            	<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="products-pic"><?php the_post_thumbnail( 'span4-square' ); ?></a>
		            <?php } ?>
		       </li>
				<?php endwhile;?> 
			</ul>	
		</div>
		<?php endif; ?>

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
		
		$defaults = array('title' => 'Featured products', 'number' => 1);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
			<input type="text" class="widefat" style="width: 216px;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>">Number of items to show:</label>
			<input type="text" class="widefat" style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
		</p>
	<?php
	}
}

// Add Widget
function widget_featured_products_init() {
	register_widget('widget_featured_products');
}
add_action('widgets_init', 'widget_featured_products_init');

?>