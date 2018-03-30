<?php

/********* Starting Calories Widget for Sidebar *********/

class Calories_Widget extends WP_Widget {

	function Calories_Widget(){
  		$widget_ops = array( 'classname' => 'Calories_Widget', 'description' => __('Show List of Calories.', 'woothemes'));
		 WP_Widget::__construct( 'calories', __('Food & Cook: Calories', 'woothemes'), $widget_ops );
	}

/********* Starting Calories Widget Function *********/

	function widget($args, $instance) {
		extract($args);

		$option = '';
		$title 	= apply_filters('widget_title', $instance['title'] );
		$view 	= apply_filters('calories_dropdown', $instance['view'] );

		if ($view != '' ) {
			$args = array(
              	'hide_empty'        => 1,
              	'taxonomy'          => 'calories'
			);
		} else {
			$args = array(
			  'taxonomy'     		=> 'calories',
			  'title_li'     		=> ''
			);
		}

		echo $before_widget;

		if( $title ) {

			$temp_title 	= explode(' ',$title);
			$first_letter 	= $temp_title[0];

			unset($temp_title[0]);

			$title_new 		= implode(' ', $temp_title);
			$title 			= $first_letter.'  '.$title_new.' ';

			echo '<h3>'. $title .'</h3>';

		}

		if ($view != '' ) {
			echo '<select name="cal-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">';
			echo '<option value="">' .esc_attr(__('All Calories', 'woothemes')). '</option>';

			$categories = get_categories( $args );
			foreach ($categories as $category) {
				$option .= '<option value="'.esc_url( home_url() ).'/?calories='.$category->slug.'">';
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


/********* Starting Calories Widget Admin Form *********/

	function form($instance) {
		$instance 	= wp_parse_args( (array) $instance, array( 'title' => 'Calories' ) );
		$title 		= $instance['title'];
	    $view 		= isset($instance['view']) ? (bool) $instance['view'] : true;
		?>
			<p>
	            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'woothemes'); ?></label>
	            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	        </p>
	        <p>
	        	<input class="checkbox" type="checkbox" <?php checked($view); ?> id="<?php echo $this->get_field_id('view'); ?>" name="<?php echo $this->get_field_name('view'); ?>" />
	            <label for="<?php echo $this->get_field_id('view'); ?>"><?php _e('Display as dropdown ?', 'dahztheme'); ?></label>
	        </p>
		<?php
	}

/********* Starting Calories Widget Update Function *********/

	function update($new_instance, $old_instance) {
        $instance 			= $old_instance;
		$instance['title'] 	= strip_tags($new_instance['title']);
		$instance['view'] 	= strip_tags($new_instance['view']);

        return $instance;

    }

}
register_widget( 'Calories_Widget' );