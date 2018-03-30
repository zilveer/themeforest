<?php 

add_action( 'widgets_init', 'multipurpose_categories_widgets_init' );
function multipurpose_categories_widgets_init() {
	register_widget( 'MultiPurpose_Categories_Widget' );
}
 
class MultiPurpose_Categories_Widget extends WP_Widget {

	/**
	 * Prefix for the widget.
	 * @since 1.0
	 */
	var $prefix;
	var $textdomain;

	
	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 * @since 1.0
	 */
	function MultiPurpose_Categories_Widget() {
	
		// Give your own prefix name eq. your-theme-name
		$this->prefix 		= 'multipurpose';
		
		// Set up the widget options
		$widget_options = array(
			'classname' => $this->prefix,
			'description' => esc_html__( 'Advanced categories widget that gives you total control over the output of your category links.', 'multipurpose' )
		);

		// Set up the widget control options
		$control_options = array(
			'id_base' => $this->prefix
		);

		// Create the widget
		parent::__construct( $this->prefix, esc_attr__( 'MultiPurpose Categories', 'multipurpose' ), $widget_options, $control_options );
		
		// Print the user costum style sheet
		if ( is_active_widget(false, false, $this->id_base, false ) && ! is_admin() ) {
			// Put some code here
		}
	}
	
	
	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 * @since 1.0
	 */
	function default_args() {
		return array( 
			'widget_id'			=> $this->number,
			'title'				=> esc_attr__( 'Custom Categories', 'multipurpose' ),
			
			'show_option_all'    => '',
			'orderby'            => 'name',
			'order'              => 'ASC',
			'style'              => 'list',
			'show_count'         => 0,
			'hide_empty'         => 1,
			'use_desc_for_title' => 1,
			'child_of'           => 0,
			'feed'               => '',
			'feed_type'          => '',
			'feed_image'         => '',
			'exclude'            => '',
			'exclude_tree'       => '',
			'include'            => '',
			'hierarchical'       => 1,
			'title_li'           => '',
			'show_option_none'   => esc_attr__( 'No categories', 'multipurpose' ),
			'number'             => null,
			'echo'               => 1,
			'depth'              => 0,
			'current_category'   => 0,
			'pad_counts'         => 0,
			'taxonomy'           => 'category',
			'echo'				 => false,
			
			'dropdown'			=> false,
			'remove_link'		=> true,
			'toggle_active'		=> array( 0 => true, 1 => false, 2 => false, 3 => false, 4 => false, 5 => false, 6 => false, 7 => false ),
			'intro_text'		=> '',
			'outro_text'		=> '',
			'cuscustomtylescript'	=> ''			
		);
	}
	
	
	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 * @since 1.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Set up the arguments for wp_list_categories().
		$args = wp_parse_args( (array) $instance, $this->default_args() );

		// Output the theme's widget wrapper
		echo $before_widget;
		
		// If a title was input by the user, display it
		if ( !empty( $instance['title'] ) )
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;

		// Print intro text if exist
		if ( !empty( $instance['intro_text'] ) )
			echo '<p class="'. $this->id . '-intro-text">' . $instance['intro_text'] . '</p>';
			
		// Get the categories list
		$categories = str_replace( array( "\r", "\n", "\t" ), '', $this->list_categories( $args ) );

		// Output the categories list
		echo $categories;
		
		// Print outro text if exist
		if ( !empty( $instance['outro_text'] ) )
			echo '<p class="'. $this->id . '-outro_text">' . $instance['outro_text'] . '</p>';

		// Close the theme's widget wrapper
		echo $after_widget;
	}
	

	
	/**
	 * Creates the end HTML for widget
	 * @since 1.0
	 */	
	function list_categories( $args = array() ) {
		if ( $args['dropdown'] ) {
			$args['show_option_none'] = esc_attr__( 'Select Category', 'multipurpose' );
			return wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $args ) );
		
		} else {
			$args['walker'] = new MultiPurpose_Category_Widget_Walker;			
			
			// List all parent categories
			if( $query_var = get_query_var('cat') ) {
				
				$parents = $childs = $excludes = $includes = array();
				
				if( $parents = get_categories( array( 'depth' => 1 ) ) )
					foreach( $parents as $parent )
						if( $childs = get_categories( array( 'child_of' => $parent->term_id ) ) )
							foreach( $childs as $child )
								$excludes[$child->term_id] = $child->term_id;		

				$current = get_category( $query_var );
				
				if( $current->category_parent ) {
					if( $childs = get_categories( array( 'child_of' => $current->category_parent ) ) )
						foreach( $childs as $child )
							unset( $excludes[$child->term_id] );			
				} else {
					if( $childs = get_categories( array( 'child_of' => $current->term_id ) ) )
						foreach( $childs as $child )
							unset( $excludes[$child->term_id] );
				}
				
				$args['depth'] = 0;
				$args['exclude'] = $excludes;
			} else {
				$args['depth'] = 1;
			}
							
			$output = wp_list_categories( $args );
			if ( $output )				
				return "<ul class='custom-categories custom-categories-widget'>$output</ul>";
		}
		return esc_attr__( 'Please check the advanced categories widget settings.', 'multipurpose' );
	}

	
	/**
	 * Updates the widget control options for the particular instance of the widget.
	 * @since 1.0
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Set the instance to the new instance.
		$instance = $new_instance;

		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['hierarchical'] 		= isset( $new_instance['hierarchical'] ) ? 1 : 0 ;
		$instance['show_count'] 		= isset( $new_instance['show_count'] ) ? 1 : 0 ;
		$instance['remove_link'] 		= isset( $new_instance['remove_link'] ) ? 1 : 0 ;
		$instance['dropdown'] 			= isset( $new_instance['dropdown'] ) ? 1 : 0;
		return $instance;
	}

	
	/**
	 * Displays the widget control options in the Widgets admin screen.
	 * @since 1.0
	 */
	function form( $instance ) {

		// Merge the user-selected arguments with the defaults
		$instance = wp_parse_args( (array) $instance, $this->default_args() );

		$order = array( 'ASC' => esc_attr__( 'Ascending', 'multipurpose' ), 'DESC' => esc_attr__( 'Descending', 'multipurpose' ) );
		$orderby = array( 'count' => esc_attr__( 'Count', 'multipurpose' ), 'ID' => esc_attr__( 'ID', 'multipurpose' ), 'name' => esc_attr__( 'Name', 'multipurpose' ), 'slug' => esc_attr__( 'Slug', 'multipurpose' ), 'term_group' => esc_attr__( 'Term Group', 'multipurpose' ) );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'multipurpose' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dropdown' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['dropdown'], true ); ?> id="<?php echo $this->get_field_id( 'dropdown' ); ?>" name="<?php echo $this->get_field_name( 'dropdown' ); ?>" /> <?php esc_attr_e( 'Display as dropdown', 'multipurpose' ); ?></label>			
			<br />
			<label for="<?php echo $this->get_field_id( 'show_count' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_count'], true ); ?> id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" /> <?php esc_attr_e( 'Show post counts', 'multipurpose' ); ?></label>			
			<br />
			<label for="<?php echo $this->get_field_id( 'hierarchical' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['hierarchical'], true ); ?> id="<?php echo $this->get_field_id( 'hierarchical' ); ?>" name="<?php echo $this->get_field_name( 'hierarchical' ); ?>" /> <?php esc_attr_e( 'Show hierarchy', 'multipurpose' ); ?></label>						
			<br />			
			<label for="<?php echo $this->get_field_id( 'remove_link' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['remove_link'], true ); ?> id="<?php echo $this->get_field_id( 'remove_link' ); ?>" name="<?php echo $this->get_field_name( 'remove_link' ); ?>" /> <?php esc_attr_e( 'Make current menu item not linked', 'multipurpose' ); ?></label>						
		</p>	

	<?php
	}
}


/**
 * Create HTML list of categories.
 *
 * @package WordPress
 * @since 2.1.0
 * @uses Walker
 */
class MultiPurpose_Category_Widget_Walker extends Walker_Category {

	/**
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $category Category data object.
	 * @param int $depth Depth of category in reference to parents.
	 * @param array $args
	 */
	function start_el(&$output, $category, $depth = 0, $args = array(), $current_object_id = 0) {
		extract($args);

		$cat_name = esc_attr( $category->name );

		/** This filter is documented in wp-includes/category-template.php */
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );

		// Check if current cat and remove link is enable
		if( $remove_link && get_query_var('cat') == $category->term_id ) {
			$link = $cat_name;
		} else {
			$link = '<a href="' . esc_url( get_term_link($category) ) . '" ';
			if ( $use_desc_for_title == 0 || empty($category->description) ) {
				$link .= 'title="' . esc_attr( sprintf(esc_attr__( 'View all posts filed under %s', 'multipurpose' ), $cat_name) ) . '"';
			} else {
				/**
				 * Filter the category description for display.
				 *
				 * @since 1.2.0
				 *
				 * @param string $description Category description.
				 * @param object $category    Category object.
				 */
				$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
			}

			$link .= '>';
			$link .= $cat_name . '</a>';
		}

		if ( !empty($feed_image) || !empty($feed) ) {
			$link .= ' ';

			if ( empty($feed_image) )
				$link .= '(';

			$link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $feed_type ) ) . '"';

			if ( empty($feed) ) {
				$alt = ' alt="' . sprintf(esc_attr__( 'Feed for all posts filed under %s', 'multipurpose' ), $cat_name ) . '"';
			} else {
				$title = ' title="' . $feed . '"';
				$alt = ' alt="' . $feed . '"';
				$name = $feed;
				$link .= $title;
			}

			$link .= '>';

			if ( empty($feed_image) )
				$link .= $name;
			else
				$link .= "<img src='$feed_image'$alt$title" . ' />';

			$link .= '</a>';

			if ( empty($feed_image) )
				$link .= ')';
		}

		if ( !empty($show_count) )
			$link .= ' (' . number_format_i18n( $category->count ) . ')';

		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$class = 'cat-item cat-item-' . $category->term_id;
			if ( !empty($current_category) ) {
				$_current_category = get_term( $current_category, $category->taxonomy );
				if ( $category->term_id == $current_category )
					$class .=  ' current-cat current-cat-item';
				elseif ( $category->term_id == $_current_category->parent )
					$class .=  ' current-cat-parent';
			}
			$output .=  ' class="' . $class . '"';
			$output .= ">$link\n";
		} else {
			$output .= "\t$link<br />\n";
		}
	}
}
?>