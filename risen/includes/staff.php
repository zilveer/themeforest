<?php
/**
 * Staff Functions
 *
 * Post type, meta boxes, admin columns, widget, etc.
 */

/**********************************
 * POST TYPE
 **********************************/
 
function risen_staff_post_type() {

	register_post_type(
		'risen_staff',
		array(
			'labels' 	=> array(
				'name'					=> _x( 'Staff', 'post type general name', 'risen' ),
				'singular_name'			=> _x( 'Staff', 'post type singular name', 'risen' ),
				'add_new' 				=> _x( 'Add New', 'staff', 'risen' ),
				'add_new_item' 			=> __( 'Add Staff', 'risen' ),
				'edit_item' 			=> __( 'Edit Staff', 'risen' ),
				'new_item' 				=> __( 'New Staff', 'risen' ),
				'all_items' 			=> __( 'All Staff', 'risen' ),
				'view_item' 			=> __( 'View Staff', 'risen' ),
				'search_items' 			=> __( 'Search Staff', 'risen' ),
				'not_found' 			=> __( 'No staff found', 'risen' ),
				'not_found_in_trash' 	=> __( 'No staff found in Trash', 'risen' )
			),
			'public' 			=> true,
			'show_in_nav_menus' => false, // don't let use in menu
			'rewrite'			=> false,
			'supports' 			=> array( 'title', 'editor', 'page-attributes', 'thumbnail' )
		)
	);
	
}

/**********************************
 * META BOXES
 **********************************/

/*
UPLOAD BUTTONS NOTE
If you want to use media upload buttons, you MUST configure post type to support 'editor'. Otherwise, the "Insert into Post" button will not be available
If you don't want to show the editor, use a style like this in admin-style.css: .screen-post_type-risen_slide #postdivrich{ display: none } 
Use this HTML after an <input>" <input type="button" value="Upload" class="upload_button button risen-upload-file" />
*/

/**
 * Setup Meta Boxes
 */
 
function risen_staff_meta_boxes_setup() {

	// This post type only
	$screen = get_current_screen();
	if ( 'risen_staff' == $screen->post_type ) {

		// Add Meta Boxes
		add_action( 'add_meta_boxes', 'risen_staff_meta_boxes_add' );

		// Save Meta Boxes
		add_action( 'save_post', 'risen_staff_meta_boxes_save', 10, 2 );

	}
	
}

/**
 * Add Meta Boxes
 */
 
function risen_staff_meta_boxes_add() {

	// Details
	add_meta_box(
		'risen_staff_details',					// Unique meta box ID
		__( 'Details', 'risen' ),				// Title of meta box
		'risen_staff_options_meta_box_html',	// Callback function to output HTML
		'risen_staff',							// Post Type
		'normal',								// Context - Where the meta box appear: normal (left above standard meta boxes), advanced (left below standard boxes), side
		'high'									// Priority - high, core, default or low (see this: http://www.wproots.com/ultimate-guide-to-meta-boxes-in-wordpress/)
	);

}

/**
 * Save Meta Boxes
 */

function risen_staff_meta_boxes_save( $post_id, $post ) {

	$meta_box_id = 'risen_staff_details';
	$meta_keys = array( // fields to validate and save
		'_risen_staff_position',
		'_risen_staff_contact',
		'_risen_staff_contact_page'
	);
	risen_meta_box_save( $meta_box_id, $meta_keys, $post_id, $post );

}

/**
 * Media Files Meta Box HTML
 */

function risen_staff_options_meta_box_html( $object, $box ) {

	$screen = get_current_screen();
	
	$nonce_params = risen_meta_box_nonce_params( $box['id'] );
	wp_nonce_field( $nonce_params['action'], $nonce_params['key'] );
	
	?>
	
	<?php $meta_key = '_risen_staff_position'; ?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _ex( 'Position', 'staff position/title', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
			<p class="description">
				<?php _e( "Enter the staff member's position/title to show under their name.", 'risen' ); ?>
			</p>
		</div>
	</p>
	
	<p>
		<div class="risen-meta-name">
			<label><?php _e( 'E-mail Button', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			
			<?php
			$meta_key = '_risen_staff_contact';
			$meta_value = get_post_meta( $object->ID, $meta_key, true );
			?>
			<select name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>">
				<option value=""><?php echo _e( '- Select a Contact -', 'risen' ); ?></option>
				<?php echo risen_contact_options( $meta_value, 'show_email' ); ?>
			</select>
			
			<?php
			$meta_key = '_risen_staff_contact_page';
			$meta_value = get_post_meta( $object->ID, $meta_key, true );
			if ( 'post' == $screen->base && 'add' == $screen->action ) { // if this is first add, use a default value
				$meta_value = risen_get_page_id_by_template( 'tpl-contact.php' );
			}
			?>
			<br />
			<select name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>">
				<option value=""><?php echo _e( '- Contact Form Page -', 'risen' ); ?></option>
				<?php
				$page_options = risen_page_options( false );
				foreach ( $page_options as $page_id => $page_title ) :
				?>
				<option value="<?php echo esc_attr( $page_id ); ?>"<?php if ( $page_id == $meta_value ) : ?> selected="selected"<?php endif; ?>><?php echo esc_html( $page_title ); ?></option>';
				<?php endforeach; ?>
			</select>			
			
			<p class="description">
				<?php _e( "Choose a contact from Theme Options and a page that you have used the [contact_form] shortcode on if you want to show an e-mail button on this staff member's profile.", 'risen' ); ?>
			</p>
			
		</div>
	</p>

	<?php

}

/**
 * Add note below Featured Image
 */
 
function risen_staff_featured_image_note( $content ) {

	// only on this post type
	$screen = get_current_screen();
	if ( ! empty( $screen ) && 'risen_staff' == $screen->post_type ) {
		$content .= '<p class="description">' . esc_html__( 'Please provide an image that has a size of at least 180x180 pixels.', 'risen' ) . '</p>';
	}

	return $content;
	
}

/**********************************
 * ADMIN COLUMNS
 **********************************/
 
/**
 * Add/remove staff list columns
 * Add "Below Name", Order
 */

function risen_staff_columns( $columns ) {

	// insert thumbnail after checkbox (before title)
	$insert_array = array(
		'risen_staff_thumbnail' => __( 'Thumbnail', 'risen' )
	);
	$columns = risen_array_merge_after_key( $columns, $insert_array, 'cb' );

	// insert columns after title
	$insert_array = array(
		'risen_staff_position' => __( 'Position', 'risen' ),
		'risen_staff_order' => _x( 'Order', 'sorting', 'risen' ),
	);
	$columns = risen_array_merge_after_key( $columns, $insert_array, 'title' );
	
	//change "title" to "name"
	$columns['title'] = _x( 'Name', 'staff member', 'risen' );
	
	return $columns;

}

/**
 * Change staff list column content
 * Add "Below List" custom field value
 */

function risen_staff_columns_content( $column ) {

	global $post;
	
	switch ( $column ) {
			
		// Thumbnail
		case 'risen_staff_thumbnail' :

			if ( has_post_thumbnail() ) {
				echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, array( 80, 80 ) ) . '</a>';
			}

			break;
	
		// Under Name
		case 'risen_staff_position' :

			echo get_post_meta( $post->ID , '_risen_staff_position' , true );

			break;

		// Order
		case 'risen_staff_order' :

			echo isset( $post->menu_order ) ? $post->menu_order : '';			

			break;

	}

}

/**
 * Enable sorting for new columns
 */

function risen_staff_columns_sorting( $columns ) {

	$columns['risen_staff_position'] = '_risen_staff_position';
	$columns['risen_staff_order'] = 'menu_order';

	return $columns;

}

/**
 * Set how to sort columns (default sorting, custom fields)
 */
 
function risen_staff_columns_sorting_request( $args ) {

	// admin area only
	if ( is_admin() ) {
	
		$screen = get_current_screen();

		// only on this post type's list
		if ( 'risen_staff' == $screen->post_type && 'edit' == $screen->base ) {

			// orderby has been set, tell how to order
			if ( isset( $args['orderby'] ) ) {

				switch ( $args['orderby'] ) {
				
					// Under Name
					case '_risen_staff_position' :

						$args['meta_key'] = '_risen_staff_position';
						$args['orderby'] = 'meta_value'; // alphabetically (meta_value_num for numeric)
						
						break;

				}
				
			}
			
			// orderby not set, tell which column to sort by default
			else {
				$args['orderby'] = 'menu_order'; // sort by Order column by default
				$args['order'] = 'ASC';
			}
			
		}
		
	}
 
	return $args;

}

/**********************************
 * WIDGETS
 **********************************/

/**
 * Staff Widget
 */

if ( ! class_exists( 'Risen_Staff_Widget' ) ) {

	class Risen_Staff_Widget extends WP_Widget {

		// Register widget with WordPress
		public function __construct() {
		
			parent::__construct(
				'risen-staff',
				_x( 'Staff', 'staff widget', 'risen' ),
				array(
					'description' => _x( 'Shows staff members.', 'staff widget', 'risen' )
				)			
			);

		}

		// Back-end widget form
		public function form( $instance ) {

			// Set defaults
			$instance = wp_parse_args( (array) $instance, array(
				'title' => _x( 'Staff', 'staff widget', 'risen' ),
				'limit' => '5', // also change in update(),
				'position' => '1',
				'image' => '1'
			) );

			?>
			
			<?php $field = 'title'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Title:', 'risen' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" type="text" value="<?php echo esc_attr( $instance[$field] ); ?>" />
			</p>
			
			<?php $field = 'limit'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Number of items to show:', 'risen' ); ?></label> 
				<input style="width:40px;" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" type="text" value="<?php echo esc_attr( $instance[$field] ); ?>" />
			</p>
			
			<p>
				
				<?php $field = 'image'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show photo', 'risen' ); ?>
				</label>
				
				<br />
				
				<?php $field = 'position'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show position', 'risen' ); ?>
				</label>
				
			</p>
			
			<?php
			
		}

		// Sanitize widget form values as they are saved
		public function update( $new_instance, $old_instance ) {

			$instance = array();
			
			$instance['title'] = trim( strip_tags( $new_instance['title'] ) );
			$instance['limit'] = (int) $new_instance['limit'] > 0 ? (int) $new_instance['limit'] : 5; // default if not positive number
			$instance['position'] = ! empty( $new_instance['position'] ) ? '1' : '';
			$instance['image'] = ! empty( $new_instance['image'] ) ? '1' : '';

			return $instance;
			
		}
		
		// Front-end display of widget
		public function widget( $args, $instance ) {
		
			global $post;

			// HTML Before
			echo $args['before_widget'];
			
			// Title
			$title = apply_filters( 'widget_title', $instance['title'] );
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . $instance['title'] . $args['after_title'];
			}
			
			// Get Posts
			$posts = get_posts( array(
				'post_type'			=> 'risen_staff',
				'numberposts'		=> $instance['limit'],
				'orderby'			=> 'menu_order',
				'order'				=> 'ASC',
				'suppress_filters'	=> false // help multilingual
			) );
			
			// Loop Posts
			$i = 0;
			foreach( $posts as $post ) : setup_postdata( $post ); $i++;
			?>
			
			<article class="staff-widget-item<?php if ( 1 == $i ) : ?> staff-widget-item-first<?php endif; ?>">
			
				<?php if ( ! empty( $instance['image'] ) && has_post_thumbnail() ) : ?>
				<div class="image-frame staff-widget-item-thumb widget-thumb">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'risen-tiny-thumb', array( 'title' => '' ) ); ?></a>
				</div>
				<?php endif; ?>
				
				<header>

					<h1 class="staff-widget-item-title"><?php the_title(); ?></h1>
					
					<?php
					$position = get_post_meta( $post->ID, '_risen_staff_position', true );
					if ( $position && ! empty( $instance['position'] ) ) :
					?>
					<div class="staff-widget-item-position"><?php echo $position; ?></div>
					<?php endif; ?>
					
					<div class="staff-widget-item-link"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'Read Bio', 'risen' ); ?></a></div>
					
				</header>
				
				<div class="clear"></div>
				
			</article>
			
			<?php
			
			// End Loop
			endforeach;
			
			// HTML After
			echo $args['after_widget'];

		}

	}
	
}
