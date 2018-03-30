<?php

/********* Starting Ingredients Widget for Sidebar *********/

class Ingredients_Widget extends WP_Widget {

	function Ingredients_Widget(){
  		$widget_ops = array( 'classname' => 'Ingredients_Widget', 'description' => __('Show List of Ingredients.', 'woothemes'));
		 WP_Widget::__construct( 'ingredients', __('Food & Cook: Ingredients', 'woothemes'), $widget_ops );
	}

/********* Starting Ingredients Widget Function *********/

	function widget($args,  $instance) {
		extract($args);

		$option = '';
		$title 	= apply_filters('widget_title', $instance['title']);
		$view 	= apply_filters('ingredient_dropdown', $instance['view']);

		if ( empty($title) ) { $title = false; }

		if ($view != '' ) {
			$args = array(
              	'hide_empty'         => 1,
              	'taxonomy'           => 'ingredient'
			);
		} else {
			$args = array(
			  	'taxonomy'     		=> 'ingredient',
			  	'title_li'     		=> ''
			);
		}

		echo $before_widget;

		if($title) {

			$temp_title 	= explode(' ',$title);
			$first_letter 	= $temp_title[0];

			unset($temp_title[0]);

			$title_new 		= implode(' ', $temp_title);
			$title 			= $first_letter.' '.$title_new.' ';

			echo '<h3>'.$title.'</h3>';

		}

		if ($view != '' ) {
			echo '<select name="ing-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">';
			echo '<option value="">' .esc_attr(__('All Ingredients', 'woothemes')). '</option>';

			$categories = get_categories( $args );
			foreach ($categories as $category) {
				$option .= '<option value="'.esc_url( home_url() ).'/?ingredient='.$category->slug.'">';
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


/********* Starting Ingredients Widget Admin Form *********/

	function form($instance) {
		$instance 	= wp_parse_args( (array) $instance, array( 'title' => 'Ingredients' ) );
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

/********* Starting Ingredients Widget Update Function *********/

	function update($new_instance, $old_instance) {
        $instance 			= $old_instance;
		$instance['title'] 	= strip_tags($new_instance['title']);
		$instance['view'] 	= strip_tags($new_instance['view']);

        return $instance;

    }

}
register_widget( 'Ingredients_Widget' );