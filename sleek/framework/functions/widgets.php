<?php

/*------------------------------------------------------------
 * Widgets:
 *
 * Sleek Blog List
 * Sleek Blog Slider
 * Social Links
 *
 *------------------------------------------------------------*/





/*------------------------------------------------------------
 * Widget: Sleek Blog List
 *------------------------------------------------------------*/

add_action( 'widgets_init', 'register_widget_sleek_blog_list' );
function register_widget_sleek_blog_list() {
	register_widget( 'Sleek_Blog_List' );
}

class Sleek_Blog_List extends WP_Widget {



	/* Register widget with WordPress
	 *------------------------------------------------------------*/

	function __construct() {
		parent::__construct(
			'sleek_blog_list', // Base ID
			__( 'Sleek Blog List', 'sleek' ), // Name
			array( 'description' => __( 'Create Sleek Blog List', 'sleek' ), ) // Args
		);
	}



	/* Front-end display of widget
	 *------------------------------------------------------------*/

	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		if( !empty( $instance['title'] ) ){
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		echo do_shortcode('[blog posts="'.$instance['posts_num'].'" style="widget_list" category="'.$instance['category'].'" sort_by="'.$instance['order_by'].'" sort_order="'.$instance['order'].'"]');

		echo $args['after_widget'];
	}



	/* Back-end widget form
	 *------------------------------------------------------------*/

	public function form( $instance ){

		// Title
		$title = !empty( $instance['title'] ) ? $instance['title'] : '';
		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'title' ).'">'.__( 'Title:', 'sleek' ).'</label>';
		echo '<input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'">';
		echo '</p>';

		// Number of posts
		$posts_num = !empty( $instance['posts_num'] ) ? $instance['posts_num'] : '5';
		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'posts_num' ).'">'.__( 'Number of posts:', 'sleek' ).'</label>';
		echo '<input class="widefat" id="'.$this->get_field_id( 'posts_num' ).'" name="'.$this->get_field_name( 'posts_num' ).'" type="text" value="'.esc_attr( $posts_num ).'">';
		echo '</p>';

		// Category
		$category = !empty( $instance['category'] ) ? $instance['category'] : '';
		$category_list = get_categories();

		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'category' ).'">'.__( 'Category:', 'sleek' ).'</label>';
		echo '<select class="widefat" id="'.$this->get_field_id( 'category' ).'" name="'.$this->get_field_name( 'category' ).'">';
			echo '<option value="">'.__( 'All categories', 'sleek' ).'</option>';
			foreach( $category_list as $cat ){
				$selected = esc_attr( $category ) == $cat->slug ? 'selected' : '';
				echo '<option value="'.$cat->slug.'" '.$selected.'>'.$cat->name.'</option>';
			}
		echo '</select>';
		echo '</p>';

		// Order By
		$order_by = !empty( $instance['order_by'] ) ? $instance['order_by'] : 'date';
		$order_by_list = array(
			'date' => __('Date', 'sleek'),
			'modified' => __('Date modified', 'sleek'),
			'comment_count' => __('Comment count', 'sleek'),
			'title' => __('Title', 'sleek'),
			'rand' => __('Random', 'sleek'),
		);

		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'order_by' ).'">'.__( 'Order by:', 'sleek' ).'</label>';
		echo '<select class="widefat" id="'.$this->get_field_id( 'order_by' ).'" name="'.$this->get_field_name( 'order_by' ).'">';
			foreach( $order_by_list as $key => $val ){
				$selected = esc_attr( $order_by ) == $key ? 'selected' : '';
				echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
			}
		echo '</select>';
		echo '</p>';

		// Order
		$order = !empty( $instance['order'] ) ? $instance['order'] : 'DESC';
		$order_list = array(
			'DESC' => __('Descending', 'sleek'),
			'ASC' => __('Ascending', 'sleek'),
		);

		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'order' ).'">'.__( 'Order:', 'sleek' ).'</label>';
		echo '<select class="widefat" id="'.$this->get_field_id( 'order' ).'" name="'.$this->get_field_name( 'order' ).'">';
			foreach( $order_list as $key => $val ){
				$selected = esc_attr( $order ) == $key ? 'selected' : '';
				echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
			}
		echo '</select>';
		echo '</p>';
	}



	/* Sanitize widget form values as they are saved
	 *------------------------------------------------------------*/

	public function update( $new_instance, $old_instance ){

		$instance = array();
		$instance['title'] 		= !empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posts_num'] 	= !empty( $new_instance['posts_num'] ) ? strip_tags( $new_instance['posts_num'] ) : '5';
		$instance['category'] 	= !empty( $new_instance['category'] ) ? strip_tags( $new_instance['category'] ) : '';
		$instance['order_by'] 	= !empty( $new_instance['order_by'] ) ? strip_tags( $new_instance['order_by'] ) : 'date';
		$instance['order'] 		= !empty( $new_instance['order'] ) ? strip_tags( $new_instance['order'] ) : 'DESC';

		return $instance;
	}

} // class Sleek_Blog_List





/*------------------------------------------------------------
 * Widget: Sleek Blog Slider
 *------------------------------------------------------------*/

add_action( 'widgets_init', 'register_widget_sleek_blog_slider' );
function register_widget_sleek_blog_slider() {
	register_widget( 'Sleek_Blog_Slider' );
}

class Sleek_Blog_Slider extends WP_Widget {



	/* Register widget with WordPress
	 *------------------------------------------------------------*/

	function __construct() {
		parent::__construct(
			'sleek_blog_slider', // Base ID
			__( 'Sleek Blog Slider', 'sleek' ), // Name
			array( 'description' => __( 'Create Sleek Blog Slider', 'sleek' ), ) // Args
		);
	}



	/* Front-end display of widget
	 *------------------------------------------------------------*/

	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		if( !empty( $instance['title'] ) ){
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		echo do_shortcode('[blog posts="'.$instance['posts_num'].'" style="widget_slider" category="'.$instance['category'].'" sort_by="'.$instance['order_by'].'" sort_order="'.$instance['order'].'" interval="'.$instance['interval'].'" slider_effect="'.$instance['effect'].'" slider_control="'.$instance['control'].'"]');

		echo $args['after_widget'];
	}



	/* Back-end widget form
	 *------------------------------------------------------------*/

	public function form( $instance ){

		// Title
		$title = !empty( $instance['title'] ) ? $instance['title'] : '';
		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'title' ).'">'.__( 'Title:', 'sleek' ).'</label>';
		echo '<input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'">';
		echo '</p>';

		// Number of posts
		$posts_num = !empty( $instance['posts_num'] ) ? $instance['posts_num'] : '5';
		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'posts_num' ).'">'.__( 'Number of posts:', 'sleek' ).'</label>';
		echo '<input class="widefat" id="'.$this->get_field_id( 'posts_num' ).'" name="'.$this->get_field_name( 'posts_num' ).'" type="text" value="'.esc_attr( $posts_num ).'">';
		echo '</p>';

		// Category
		$category = !empty( $instance['category'] ) ? $instance['category'] : '';
		$category_list = get_categories();

		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'category' ).'">'.__( 'Category:', 'sleek' ).'</label>';
		echo '<select class="widefat" id="'.$this->get_field_id( 'category' ).'" name="'.$this->get_field_name( 'category' ).'">';
			echo '<option value="">'.__( 'All categories', 'sleek' ).'</option>';
			foreach( $category_list as $cat ){
				$selected = esc_attr( $category ) == $cat->slug ? 'selected' : '';
				echo '<option value="'.$cat->slug.'" '.$selected.'>'.$cat->name.'</option>';
			}
		echo '</select>';
		echo '</p>';

		// Order By
		$order_by = !empty( $instance['order_by'] ) ? $instance['order_by'] : 'date';
		$order_by_list = array(
			'date' => __('Date', 'sleek'),
			'modified' => __('Date modified', 'sleek'),
			'comment_count' => __('Comment count', 'sleek'),
			'title' => __('Title', 'sleek'),
			'rand' => __('Random', 'sleek'),
		);

		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'order_by' ).'">'.__( 'Order by:', 'sleek' ).'</label>';
		echo '<select class="widefat" id="'.$this->get_field_id( 'order_by' ).'" name="'.$this->get_field_name( 'order_by' ).'">';
			foreach( $order_by_list as $key => $val ){
				$selected = esc_attr( $order_by ) == $key ? 'selected' : '';
				echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
			}
		echo '</select>';
		echo '</p>';

		// Order
		$order = !empty( $instance['order'] ) ? $instance['order'] : 'DESC';
		$order_list = array(
			'DESC' => __('Descending', 'sleek'),
			'ASC' => __('Ascending', 'sleek'),
		);

		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'order' ).'">'.__( 'Order:', 'sleek' ).'</label>';
		echo '<select class="widefat" id="'.$this->get_field_id( 'order' ).'" name="'.$this->get_field_name( 'order' ).'">';
			foreach( $order_list as $key => $val ){
				$selected = esc_attr( $order ) == $key ? 'selected' : '';
				echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
			}
		echo '</select>';
		echo '</p>';

		// Interval
		$interval = !empty( $instance['interval'] ) ? $instance['interval'] : '4000';
		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'interval' ).'">'.__( 'Auto-slide interval in ms:', 'sleek' ).'</label>';
		echo '<input class="widefat" id="'.$this->get_field_id( 'interval' ).'" name="'.$this->get_field_name( 'interval' ).'" type="text" value="'.esc_attr( $interval ).'">';
		echo '</p>';

		// Slider Effect:
		$effect = !empty( $instance['effect'] ) ? $instance['effect'] : 'slide_x';
		$effect_list = array(
			'slide_x' => __('Slide X', 'sleek'),
			'fade' => __('Fade', 'sleek'),
			'pulse' => __('Pulse', 'sleek'),
			'slide_y' => __('Slide Y', 'sleek'),
		);

		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'effect' ).'">'.__( 'Slider Effect:', 'sleek' ).'</label>';
		echo '<select class="widefat" id="'.$this->get_field_id( 'effect' ).'" name="'.$this->get_field_name( 'effect' ).'">';
			foreach( $effect_list as $key => $val ){
				$selected = esc_attr( $effect ) == $key ? 'selected' : '';
				echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
			}
		echo '</select>';
		echo '</p>';

		// Slider Control:
		$control = !empty( $instance['control'] ) ? $instance['control'] : 'pager';
		$control_list = array(
			'false' => __('None', 'sleek'),
			'pager' => __('Pager (dots)', 'sleek'),
			'arrows' => __('Arrows', 'sleek'),
		);

		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'control' ).'">'.__( 'Slider Control:', 'sleek' ).'</label>';
		echo '<select class="widefat" id="'.$this->get_field_id( 'control' ).'" name="'.$this->get_field_name( 'control' ).'">';
			foreach( $control_list as $key => $val ){
				$selected = esc_attr( $control ) == $key ? 'selected' : '';
				echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
			}
		echo '</select>';
		echo '</p>';
	}



	/* Sanitize widget form values as they are saved
	 *------------------------------------------------------------*/

	public function update( $new_instance, $old_instance ){

		$instance = array();
		$instance['title'] 		= !empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posts_num'] 	= !empty( $new_instance['posts_num'] ) ? strip_tags( $new_instance['posts_num'] ) : '5';
		$instance['category'] 	= !empty( $new_instance['category'] ) ? strip_tags( $new_instance['category'] ) : '';
		$instance['order_by'] 	= !empty( $new_instance['order_by'] ) ? strip_tags( $new_instance['order_by'] ) : 'date';
		$instance['order'] 		= !empty( $new_instance['order'] ) ? strip_tags( $new_instance['order'] ) : 'DESC';
		$instance['interval'] 	= !empty( $new_instance['interval'] ) ? strip_tags( $new_instance['interval'] ) : '4000';
		$instance['effect'] 	= !empty( $new_instance['effect'] ) ? strip_tags( $new_instance['effect'] ) : 'slide_x';
		$instance['control'] 	= !empty( $new_instance['control'] ) ? strip_tags( $new_instance['control'] ) : 'pager';

		return $instance;
	}

} // class Sleek_Blog_Slider






/*------------------------------------------------------------
 * Widget: Social Links
 *------------------------------------------------------------*/

add_action( 'widgets_init', 'register_widget_sleek_social_links' );
function register_widget_sleek_social_links() {
	register_widget( 'Sleek_Social_Links' );
}

class Sleek_Social_Links extends WP_Widget {



	/* Register widget with WordPress
	 *------------------------------------------------------------*/

	function __construct() {
		parent::__construct(
			'sleek_social_icons', // Base ID
			__( 'Sleek Social Links', 'sleek' ), // Name
			array( 'description' => __( 'Add Social Links', 'sleek' ), ) // Args
		);
	}



	/* Front-end display of widget
	 *------------------------------------------------------------*/

	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		if( !empty( $instance['title'] ) ){
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		// Content
		$data = explode( ',', $instance['data'] );
		$socialString = '';

		foreach( $data as $social ){

			if( empty($social) ){
				return;
			}

			$social = explode( '|', $social );

			$icon = $social[0];
			if( substr( $icon, 0, 5 ) == 'icon-' ){
				$icon = substr( $icon, 5);
			}

			// Replace '-' with '_' to prevent shortcode breaking
			$icon = str_replace('-', '_', $icon);

			$url = $social[1];

			$socialString .= ' ' . $icon . '="' . $url . '"';
		}

		echo do_shortcode( '[social style_big="' . $instance['style'] . '" ' . $socialString . ']' );

		echo $args['after_widget'];
	}



	/* Back-end widget form
	 *------------------------------------------------------------*/

	public function form( $instance ){

		// Title
		$title = !empty( $instance['title'] ) ? $instance['title'] : '';
		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'title' ).'">'.__( 'Title:', 'sleek' ).'</label>';
		echo '<input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'">';
		echo '</p>';



		// Style:
		$style = !empty( $instance['style'] ) ? $instance['style'] : 'false';
		$style_list = array(
			'false' => __('Default', 'sleek'),
			'true' => __('Big Centered', 'sleek'),
		);

		echo '<p>';
		echo '<label for="'.$this->get_field_id( 'style' ).'">'.__( 'Style:', 'sleek' ).'</label>';
		echo '<select class="widefat" id="'.$this->get_field_id( 'style' ).'" name="'.$this->get_field_name( 'style' ).'">';
			foreach( $style_list as $key => $val ){
				$selected = esc_attr( $style ) == $key ? 'selected' : '';
				echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
			}
		echo '</select>';
		echo '</p>';



		// Social Picker Wrap Start
		echo '<label>'.__( 'Social Media Links:', 'sleek' ).'</label>';

		echo '<div class="sleek-widget-social-picker">';

		// Hidden field with serialized data
		$data = !empty( $instance['data'] ) ? $instance['data'] : '';
		echo '<input type="hidden" class="value-joined" id="'.$this->get_field_id( 'data' ).'" name="'.$this->get_field_name( 'data' ).'" value="'.esc_attr( $data ).'">';

		// Infinite form
		echo '<div class="form">';

			// Create fields from existing value
			$socialList = explode( ',', esc_attr( $data ) );

			if( !empty( $socialList[0] ) ){
				foreach( $socialList as $social ){

					$social = explode( '|', $social);

					if( !empty( $social[0] ) && !empty( $social[1] ) ){

						echo '<label>';
							echo '<div class="icon"><input type="hidden" name="icon" value="'.$social[0].'"><i class="'.$social[0].'"></i></div>';
							echo '<a class="remove js-remove"><i class="icon-close"></i></a>';
							echo '<div class="url"><input type="text" name="url" placeholder="'.__('http://', 'sleek').'" value="'.$social[1].'"></div>';
						echo '</label>';

					}
				}
			}

			// Default empty item
			echo '<label>';
				echo '<div class="icon"><input type="hidden" name="icon"><i></i></div>';
				echo '<a class="remove js-remove"><i class="icon-close"></i></a>';
				echo '<div class="url"><input type="text" name="url" placeholder="'.__('http://', 'sleek').'"></div>';
			echo '</label>';


		echo '</div>';

		echo '<a class="button right js-add-new-social">'.__( 'Add new social media', 'sleek' ).'</a>';

		// original empty social item used for copying
		echo '<label>';
			echo '<div class="icon"><input type="hidden" name="icon"><i></i></div>';
			echo '<a class="remove js-remove"><i class="icon-close"></i></a>';
			echo '<div class="url"><input type="text" name="url" placeholder="'.__('http://', 'sleek').'"></div>';
		echo '</label>';

		echo '</div>';
	}



	/* Sanitize widget form values as they are saved
	 *------------------------------------------------------------*/

	public function update( $new_instance, $old_instance ){

		$instance = array();
		$instance['title'] 	= !empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['style'] 	= !empty( $new_instance['style'] ) ? strip_tags( $new_instance['style'] ) : 'false';
		$instance['data'] 	= !empty( $new_instance['data'] ) ? strip_tags( $new_instance['data'] ) : '';

		return $instance;
	}

} // class Sleek_Social_Links


