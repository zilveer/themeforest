<?php
// thb latest Posts w/ Images
class widget_latestimages extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_latestimages',
			'description' => __('Display latest posts with images','north')
		);
	
		parent::__construct(
			'thb_latestimages_widget',
			__( 'Fuel Themes - Latest Posts with Images' , 'north' ),
			$widget_ops
		);
				
		$this->defaults = array( 'title' => 'Latest Posts', 'show' => '3' );
	}

	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$show = $instance['show'];
		global $post, $wpdb;
		$themePath = THB_THEME_ROOT;
		$pop = new WP_Query();
		$pop->query('showposts='.$show.'');
		
		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;
		echo '<ul>';
		while  ($pop->have_posts()) : $pop->the_post(); ?>
		<li>
		   <figure>
		 <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
		 <?php the_post_thumbnail(); ?>
		 </a>
		 </figure>
		 <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="postlink"><?php the_title(); ?></a>
		</li>
		<?php endwhile;
		echo '</ul>';
		echo $after_widget;
		
		wp_reset_query();
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = $new_instance['title'];
		$instance['show'] = $new_instance['show'];
		
		return $instance;
	}
	public function form($instance) {
	       
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
		       <label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
		       <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
		       <label for="<?php echo $this->get_field_id( 'name' ); ?>">Number of Posts:</label>
		       <input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" value="<?php echo $instance['show']; ?>" style="width:100%;" />
		</p>
		<?php
	}
}
function widget_latestimages_init()
{
       register_widget('widget_latestimages');
}
add_action('widgets_init', 'widget_latestimages_init');

?>