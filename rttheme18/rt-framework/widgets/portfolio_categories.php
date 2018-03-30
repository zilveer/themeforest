<?php
#
# RT-Theme Portfolio Categories
#

class RT_Portfolio_Categories extends WP_Widget {

	function __construct() {
		$opts =array(
					'classname' 	=> 'widget_rt_categories',
					'description' 	=> __( 'The most recent posts on your site with post thumbnails.', 'rt_theme_admin' )
				);

		parent::__construct('rt_portfolio_categories', '['. RT_THEMENAME.']   '.__('Portfolio Categories ', 'rt_theme_admin'), $opts);
	}
	

	function widget( $args, $instance ) {
		
		extract( $args ); 

		$title          		= apply_filters('widget_title', $instance['title']) ;		 
		$show_hierarchy			= $instance['show_hierarchy'];
		$show_counts			= $instance['show_counts']; 
		$hide_empty				= $instance['hide_empty'];
		$show_child_only		= $instance['show_child_only'];						
 
		if ( is_tax() && $show_child_only ){
			$term = get_queried_object();
			$term_id = $term->term_id;
			$taxonomy = $term->taxonomy;
			
			if( $taxonomy == "product_categories" ){
				$show_child_only = $term_id;
			}else{
				$show_child_only = "";
			}

		}else{
			$show_child_only = "";
		}
  
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;

				echo '<ul class="menu">';

				$args = array(
					'show_option_all'    => '',
					'orderby'            => 'name',
					'order'              => 'ASC',
					'style'              => 'list',
					'show_count'         => $show_counts,
					'hide_empty'         => $hide_empty,
					'use_desc_for_title' => 1,
					'child_of'           => $show_child_only,
					'feed'               => '',
					'feed_type'          => '',
					'feed_image'         => '',
					'exclude'            => '',
					'exclude_tree'       => '',
					'include'            => '',
					'hierarchical'       => $show_hierarchy,
					'title_li'           => "", 
					'number'             => null,
					'echo'               => 1,
					'depth'              => 10,
					'current_category'   => 0,
					'pad_counts'         => 0,
					'taxonomy'           => 'portfolio_categories',
					'walker'             => null
				);

				wp_list_categories( $args );

				echo '</ul>'; 
 
				echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		 
		$instance                     = $old_instance;
		$instance['title']            = strip_tags($new_instance['title']); 
		$instance['show_hierarchy']   = isset( $new_instance['show_hierarchy'] ) && ! empty( $new_instance['show_hierarchy'] ) ? 1 : 0;		
		$instance['show_counts']   = isset( $new_instance['show_counts'] ) && ! empty( $new_instance['show_counts'] ) ? 1 : 0; 
		$instance['hide_empty']   = isset( $new_instance['hide_empty'] ) && ! empty( $new_instance['hide_empty'] ) ? 1 : 0;
		$instance['show_child_only']   = isset( $new_instance['show_child_only'] ) && ! empty( $new_instance['show_child_only'] ) ? 1 : 0;						
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : ''; 
 		$show_hierarchy    = isset($instance['show_hierarchy']) ? $instance['show_hierarchy']: "";
 		$show_counts    = isset($instance['show_counts']) ? $instance['show_counts']: ""; 
 		$hide_empty    = isset($instance['hide_empty']) ? $instance['hide_empty']: "";
 		$show_child_only    = isset($instance['show_child_only']) ? $instance['show_child_only']: ""; 		 		 		

?>
		<p>	
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'rt_theme_admin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title ?>" />			
		</p>
		
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_hierarchy'); ?>" name="<?php echo $this->get_field_name('show_hierarchy'); ?>" <?php checked( $show_hierarchy ); ?> />
			<label for="<?php echo $this->get_field_id('show_hierarchy'); ?>"> <?php _e( 'Show hierarchy', 'rt_theme_admin' ); ?> </label>

			<br />

			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_counts'); ?>" name="<?php echo $this->get_field_name('show_counts'); ?>" <?php checked( $show_counts ); ?> />
			<label for="<?php echo $this->get_field_id('show_counts'); ?>"> <?php _e( 'Show item counts', 'rt_theme_admin' ); ?> </label>

			<br />

			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hide_empty'); ?>" name="<?php echo $this->get_field_name('hide_empty'); ?>" <?php checked( $hide_empty ); ?> />
			<label for="<?php echo $this->get_field_id('hide_empty'); ?>"> <?php _e( 'Hide empty categories', 'rt_theme_admin' ); ?> </label>

			<br />

			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_child_only'); ?>" name="<?php echo $this->get_field_name('show_child_only'); ?>" <?php checked( $show_child_only ); ?> />
			<label for="<?php echo $this->get_field_id('show_child_only'); ?>"> <?php _e( 'Only show children of the current category', 'rt_theme_admin' ); ?> </label>			
		</p>

<?php } } ?>