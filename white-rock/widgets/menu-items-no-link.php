<?php
add_action('widgets_init', 'menu_items_no_link_load_widgets');

function menu_items_no_link_load_widgets()
{
	register_widget('Menu_Items_No_link_Widget');
}

class Menu_Items_No_link_Widget extends WP_Widget {
	
	function Menu_Items_No_link_Widget()
	{
		$widget_ops = array('classname' => 'menu-items-no-link', 'description' => 'Menu Items Widget with NO link to items.');

		$control_ops = array('id_base' => 'menu-widget-no-link');

		parent::__construct('menu-widget-no-link', 'Progression: Menu Builder w/ no link', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		
		$menuname_category = $instance['menuname_category'];
		
		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		} ?>
			
			
			<?php global $post; ?>
			
			<ul class="menu-items">
				<?php
				$menuloop = new WP_Query(array(
					'posts_per_page' => -1,
				    'post_type'      => 'menu',
				    'tax_query'      => array(
				        // Note: tax_query expects an array of arrays!
				        array(
				            'taxonomy' => 'menu_type', // my guess
				            'field'    => 'slug',
				            'terms'    => $menuname_category
				        )
				    ),
				));
				
				?>
				<?php if ( have_posts() ) : while ( $menuloop->have_posts() ) : $menuloop->the_post(); ?>
				<li>
						<div class="grid2column"><?php the_title(); ?></div>
						<div class="grid2column lastcolumn"><?php if(get_post_meta($post->ID, 'menuoption_menu_pricing', true)): ?><?php echo get_post_meta($post->ID, 'menuoption_menu_pricing', true) ?><?php endif; ?></div>
						<div class="clearfix"></div>
						<div class="item-description-menu"><?php echo get_the_excerpt(); ?></div>
				</li>
				<?php endwhile; ?>
				<?php endif; ?>
			</ul>
			
			
		
	
		
		
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['menuname_category'] = $new_instance['menuname_category'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Menu Title', 'menuname_category' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('menuname_category'); ?>">Menu Category Slug (Use slug not name!):</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('menuname_category'); ?>" name="<?php echo $this->get_field_name('menuname_category'); ?>" value="<?php echo $instance['menuname_category']; ?>" />
		</p>

	<?php
	}
}
?>