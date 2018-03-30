<?php
/**
 * General Widgets
 *
 * These are general-use widgets. Widgets specific to a post type are in their own file.
 * For example, widgets for showing Multimedia items are in multimedia.php
 * All widgets are registered here, however. See risen_register_widgets() below.
 */

/**********************************
 * REGISTER WIDGETS
 **********************************/

/**
 * Load Widgets
 */
 
function risen_register_widgets() {

	// Add widgets
	register_widget( 'Risen_Categories_Widget' );
	register_widget( 'Risen_Posts_Widget' );
	register_widget( 'Risen_Multimedia_Widget' );
	register_widget( 'Risen_Multimedia_Archives_Widget' );
	register_widget( 'Risen_Events_Widget' );
	register_widget( 'Risen_Staff_Widget' );
	register_widget( 'Risen_Locations_Widget' );
	register_widget( 'Risen_Gallery_Widget' );
	register_widget( 'Risen_Donation_Widget' );

}


/**
 * Remove Widgets
 */
 
function risen_unregister_widgets() {

	// Remove default widgets
	unregister_widget( 'WP_Widget_Categories' ); // replaced with modified version allowing Taxonomy selection like Tag Cloud
	unregister_widget( 'WP_Widget_Recent_Posts' ); // replaced with modified version allowing author, date, excerpt and thumbnail
	
}

/**
 * Categories Widget (Enhanced)
 *
 * Based on default WordPress 3.4 categories widget but adds support for taxonomy selection like Tag Cloud
 */

// Widget
if ( ! class_exists( 'Risen_Categories_Widget' ) ) {

	class Risen_Categories_Widget extends WP_Widget {

		// Register widget with WordPress
		public function __construct() {
		
			parent::__construct(
				'risen-categories',
				_x( 'Categories (Enhanced)', 'widget', 'risen' ),
				array(
					'description' => __( 'This widget shows categories of various types.', 'risen' )
				)			
			);

		}
		
		// Get current taxonomy
		function _get_current_taxonomy($instance) {
		
			if ( ! empty( $instance['taxonomy'] ) && taxonomy_exists( $instance['taxonomy'] ) ) {
				return $instance['taxonomy'];
			}

			return 'category';

		}

		// Sanitize widget form values as they are saved
		public function update( $new_instance, $old_instance ) {
		
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['taxonomy'] = $new_instance['taxonomy'];
			$instance['count'] = ! empty( $new_instance['count'] ) ? 1 : 0;
			$instance['hierarchical'] = ! empty( $new_instance['hierarchical'] ) ? 1 : 0;
			$instance['dropdown'] = ! empty( $new_instance['dropdown'] ) ? 1 : 0;

			return $instance;

		}

		// Back-end widget form
		public function form( $instance ) {
		
			// Defaults
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
			$title = esc_attr( $instance['title'] );
			$count = isset( $instance['count'] ) ? (bool) $instance['count'] : false;
			$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
			$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;

			// Taxonomy
			$current_taxonomy = $this->_get_current_taxonomy( $instance );
			
			?>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'risen' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _ex( 'Type:', 'categories widget', 'risen' ) ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>">
				<?php
				$taxonomies = array(
					'category' => _x( 'Blog Categories', 'categories widget', 'risen' ),
					'post_tag' => _x( 'Blog Tags', 'categories widget', 'risen' ),
					'risen_multimedia_category' => sprintf( _x( '%s Categories', 'multimedia categories widget', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
					'risen_multimedia_tag' => sprintf( _x( '%s Tags', 'multimedia categories widget', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
					'risen_multimedia_speaker' => sprintf( __( '%s Speakers', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
					'risen_gallery_category' => _x( 'Gallery Categories', 'multimedia categories widget', 'risen' )
				);
				foreach ( $taxonomies as $taxonomy => $taxonomy_name ) :
				?>
					<option value="<?php echo esc_attr( $taxonomy ) ?>" <?php selected( $taxonomy, $current_taxonomy ) ?>><?php echo $taxonomy_name; ?></option>
				<?php endforeach; ?>
				</select>
			</p>
			
			<p>
			
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'dropdown' ); ?>" name="<?php echo $this->get_field_name( 'dropdown' ); ?>"<?php checked( $dropdown ); ?> />
				<label for="<?php echo $this->get_field_id( 'dropdown' ); ?>"><?php _e( 'Display as dropdown', 'risen' ); ?></label>
				
				<br />

				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>"<?php checked( $count ); ?> />
				<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Show post counts', 'risen' ); ?></label>
				
				<br />

				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'hierarchical' ); ?>" name="<?php echo $this->get_field_name( 'hierarchical' ); ?>"<?php checked( $hierarchical ); ?> />
				<label for="<?php echo $this->get_field_id( 'hierarchical' ); ?>"><?php _e( 'Show hierarchy', 'risen' ); ?></label>
				
			</p>
			
			<?php
			
		}
		
		// Front-end display of widget
		public function widget( $args, $instance ) {

			extract( $args );

			$current_taxonomy = $this->_get_current_taxonomy($instance);
			
			$title = empty( $instance['title'] ) ? _x( 'Categories', 'widget', 'risen' ) : $instance['title'];
			$c = ! empty( $instance['count'] ) ? '1' : '0';
			$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
			$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

			echo $before_widget;

			if ( $title ) {
				echo $before_title . $title . $after_title;
			}

			$cat_args = array(
				'taxonomy' => $current_taxonomy,
				'orderby' => 'name',
				'show_count' => $c,
				'hierarchical' => $h
			);

			if ( $d ) {
			
				$cat_args['show_option_none'] = _x( 'Select One', 'categories dropdown', 'risen' );
				$cat_args['id'] = 'dropdown_taxonomy_id-' . rand( 10000, 99999 );
				$cat_args['name'] = $cat_args['id'];
				$cat_args['class'] = 'dropdown-taxonomy-redirect';
				
				?>
				<form>
				<input type="hidden" name="taxonomy" value="<?php echo esc_attr( $current_taxonomy ); ?>">
				<?php wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args ) ); ?>
				</form>
				<?php

			} else {

				?>
				<ul>
				<?php
				
				$cat_args['taxonomy'] = $current_taxonomy;
				$cat_args['title_li'] = '';
				$cat_args['show_option_none'] = '';
				wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );

				?>
				</ul>
				<?php
			
			}

			echo $after_widget;

		}

	}
	
}

// Redirect Dropdown URL
// Dropdown selection results in URL like http://risen.dev/?redirect_taxonomy=risen_multimedia_category&id=14
// This uses that query string to get permalink for that taxonomy and term
if ( ! function_exists( 'risen_redirect_taxonomy' ) ) {

	function risen_redirect_taxonomy() {
	
		$id = isset( $_GET['id'] ) ? (int) $_GET['id'] : '';
	
		if ( is_front_page() && ! empty( $_GET['redirect_taxonomy'] ) && taxonomy_exists( $_GET['redirect_taxonomy'] ) && ! empty( $id ) ) {
		
			$taxonomy = $_GET['redirect_taxonomy'];
		
			$term_url = get_term_link( $id, $taxonomy );		
			
			// Send to pretty URL
			wp_redirect( $term_url, 301 );
			
		}
	
	}

}

/**
 * Donation Widget
 */

// Widget
if ( ! class_exists( 'Risen_Donation_Widget' ) ) {

	class Risen_Donation_Widget extends WP_Widget {

		// Register widget with WordPress
		public function __construct() {
		
			parent::__construct(
				'risen-donation',
				_x( 'Donation', 'widget', 'risen' ),
				array(
					'description' => __( 'This widget shows a donation message and button.', 'risen' ),
				),
				array(
					'width' => 300,
					'height' => 350
				)			
			);

		}

		// Sanitize widget form values as they are saved
		public function update( $new_instance, $old_instance ) {
		
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['text'] = trim( $new_instance['text'] );
			$instance['button_text'] = trim( strip_tags( $new_instance['button_text'] ) );
			$instance['button_url'] = trim( strip_tags( $new_instance['button_url'] ) );

			return $instance;

		}

		// Back-end widget form
		public function form( $instance ) {

			// Set defaults
			$instance = wp_parse_args( (array) $instance, array(
				'title' => _x( 'Donation', 'widget', 'risen' ),
				'text' => 'Please make a donation by clicking below.',
				'button_text' => 'Make Donation',
				'button_url' => 'http://'
			) );

			?>
			
			<?php $field = 'title'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Title:', 'risen' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" type="text" value="<?php echo esc_attr( $instance[$field] ); ?>" />
			</p>
			
			<?php $field = 'text'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Message:', 'risen' ); ?></label> 
				<textarea class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" rows="8" cols="20"><?php echo esc_textarea( $instance[$field] ); ?></textarea>
			</p>

			<?php $field = 'button_text'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Button Text:', 'risen' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" type="text" value="<?php echo esc_attr( $instance[$field] ); ?>" />
			</p>
			
			<?php $field = 'button_url'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Button URL:', 'risen' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" type="text" value="<?php echo esc_attr( $instance[$field] ); ?>" />
			</p>

			<?php
			
		}
		
		// Front-end display of widget
		public function widget( $args, $instance ) {

			// HTML Before
			echo $args['before_widget'];
			
			// Title
			$title = apply_filters( 'widget_title', $instance['title'] );
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			
			?>
			
			<div class="donation-widget">

				<?php if ( ! empty( $instance['text'] ) ) :	?>
				<div class="donation-widget-text">
					<?php echo wpautop( $instance['text'] ); ?>
				</div>
				<?php endif; ?>
				
				<?php
				$button_url = ! empty( $instance['button_url'] ) && 'http://' != $instance['button_url'] ? $instance['button_url'] : '';
				if ( $button_url && ! empty( $instance['button_text'] ) ) :
				?>
				<div class="donation-widget-button">
					<a href="<?php echo esc_url( $button_url ); ?>" target="_blank" class="button"><?php echo esc_html( $instance['button_text'] ); ?></a>
				</div>
				<?php endif; ?>

			</div>
			
			<?php
			
			// HTML After
			echo $args['after_widget'];

		}

	}
	
}
