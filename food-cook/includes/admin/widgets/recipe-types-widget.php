<?php

/********* Starting Recipe Types Widget for Sidebar *********/

class Recipe_Types_Widget extends WP_Widget {

	function Recipe_Types_Widget(){
  		$widget_ops = array( 'classname' => 'Recipe_Types_Widget', 'description' => __('Show List of Recipe Types.', 'woothemes'));
		 WP_Widget::__construct( 'recipe_types', __('Food & Cook: Recipe Types', 'woothemes'), $widget_ops );
	}

/********* Starting Recipe Types Widget Function *********/

	function widget($args,  $instance) {
		extract($args);

		$option = $view = $title = '';

		$title 	= apply_filters( 'widget_title', $instance['title'] );
		$view 	= apply_filters( 'skill_level_dropdown', $instance['view'] );

		if ( empty($title) ) { $title = false; }

		if ($view == 'on' ) {
			$args = array(
              	'taxonomy'          => 'recipe_type',
              	'hide_empty'		=> 1
			);
		} else {
			$args = array(
			  	'taxonomy'     		=> 'recipe_type',
			  	'title_li'     		=> ''
			);
		}

		echo $before_widget;

		if($title) {

			$temp_title 	= explode(' ',$title);
			$first_letter 	= $temp_title[0];

			unset( $temp_title[0] );

			$title_new 		= implode(' ', $temp_title);
			$title 			= $first_letter.' '.$title_new.' ';

			echo '<h3>'.$title.'</h3>';

		}

		if ($view == 'on' ) {
			echo '<select name="rt-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">';
			echo '<option value="">' .esc_attr(__('All Recipe Type', 'woothemes')). '</option>';

			$categories = get_categories( $args );
			foreach ($categories as $category) {
				$option .= '<option value="'.esc_url( home_url() ).'/?recipe_type='.$category->slug.'">';
				$option .= $category->cat_name;
				$option .= ' ('.$category->category_count.')';
				$option .= '</option>';
			}
			echo $option;
			echo '</select>';
		} else {
			echo '<ul>';
				wp_list_categories( $args );
			echo '</ul>';
		}

		echo $after_widget;
	}


/********* Starting Recipe Types Widget Admin Form *********/

	function form($instance) {
		$instance 	= wp_parse_args( (array) $instance, array( 'title' => 'Recipe Types' ) );
		$title 		= esc_attr($instance['title']);
        $view 		= isset($instance['view']) ? (bool) $instance['view'] : true;

		?>
			<p>
	            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'woothemes'); ?></label>
	            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	        </p>
	        <p>
	        	<input class="checkbox" type="checkbox" <?php checked($view); ?> id="<?php echo $this->get_field_id('view'); ?>" name="<?php echo $this->get_field_name('view'); ?>" />
	            <label for="<?php echo $this->get_field_id('view'); ?>"><?php _e('Display as dropdown ?', 'dahztheme'); ?></label>
	        </p>
		<?php
	}

/********* Starting Recipe Types Widget Update Function *********/

	function update($new_instance, $old_instance) {
        $instance 			= $old_instance;
		$instance['title'] 	= strip_tags($new_instance['title']);
		$instance['view'] 	= strip_tags($new_instance['view']);

        return $instance;

    }

}
register_widget( 'Recipe_Types_Widget' );