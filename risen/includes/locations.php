<?php
/**
 * Location Functions
 *
 * Post type, meta boxes, admin columns, widget, etc.
 */

/**********************************
 * POST TYPE
 **********************************/

function risen_location_post_type() {

	register_post_type(
		'risen_location',
		array(
			'labels' 	=> array(
				'name'					=> _x( 'Locations', 'post type general name', 'risen' ),
				'singular_name'			=> _x( 'Location', 'post type singular name', 'risen' ),
				'add_new' 				=> _x( 'Add New', 'location', 'risen' ),
				'add_new_item' 			=> __( 'Add Location', 'risen' ),
				'edit_item' 			=> __( 'Edit Location', 'risen' ),
				'new_item' 				=> __( 'New Location', 'risen' ),
				'all_items' 			=> __( 'All Locations', 'risen' ),
				'view_item' 			=> __( 'View Locations', 'risen' ),
				'search_items' 			=> __( 'Search Locations', 'risen' ),
				'not_found' 			=> __( 'No location found', 'risen' ),
				'not_found_in_trash' 	=> __( 'No location found in Trash', 'risen' )
			),
			'public' 			=> true,
			'show_in_nav_menus' => false, // don't let use in menu
			'rewrite'			=> false,
			'supports' 			=> array( 'title', 'editor', 'page-attributes' )
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

function risen_location_meta_boxes_setup() {

	// This post type only
	$screen = get_current_screen();
	if ( 'risen_location' == $screen->post_type ) {

		// Add Meta Boxes
		add_action( 'add_meta_boxes', 'risen_location_meta_boxes_add' );

		// Save Meta Boxes
		add_action( 'save_post', 'risen_location_meta_boxes_save', 10, 2 );

	}

}

/**
 * Add Meta Boxes
 */

function risen_location_meta_boxes_add() {

	// Location Details
	add_meta_box(
		'risen_location_details',					// Unique meta box ID
		__( 'Location Details', 'risen' ),			// Title of meta box
		'risen_location_details_meta_box_html',		// Callback function to output HTML
		'risen_location',							// Post Type
		'normal',									// Context - Where the meta box appear: normal (left above standard meta boxes), advanced (left below standard boxes), side
		'high'										// Priority - high, core, default or low (see this: http://www.wproots.com/ultimate-guide-to-meta-boxes-in-wordpress/)
	);

}

/**
 * Save Meta Boxes
 */

function risen_location_meta_boxes_save( $post_id, $post ) {

	// Location Details
	$meta_box_id = 'risen_location_details';
	$meta_keys = array( // fields to validate and save
		'_risen_location_address',
		'_risen_location_directions',
		'_risen_location_phone',
		'_risen_location_contact',
		'_risen_location_contact_page',
		'_risen_location_map_lat',
		'_risen_location_map_lng',
		'_risen_location_map_type',
		'_risen_location_map_zoom'
	);
	risen_meta_box_save( $meta_box_id, $meta_keys, $post_id, $post );

}

/**
 * Location Details Meta Box HTML
 */

function risen_location_details_meta_box_html( $object, $box ) {

	$screen = get_current_screen();

	$nonce_params = risen_meta_box_nonce_params( $box['id'] );
	wp_nonce_field( $nonce_params['action'], $nonce_params['key'] );

	?>

	<?php
	$meta_key = '_risen_location_address';
	$meta_value = get_post_meta( $object->ID, $meta_key, true );
	?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'Address <span>(Optional)</span>', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<textarea name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>"><?php echo esc_textarea( $meta_value ); ?></textarea>
			<?php
			$meta_key = '_risen_location_directions';
			$meta_value = get_post_meta( $object->ID, $meta_key, true );
			if ( 'post' == $screen->base && 'add' == $screen->action ) { // if this is first add, use a default value
				$meta_value = '1';
			}
			?>
			<div style="margin: 5px 0;">
				<label for="<?php echo $meta_key; ?>"><input type="checkbox" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="1"<?php if ( ! empty( $meta_value ) ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'Show "Get Directions" Button', 'risen' ); ?></label>
			</div>
			<p class="description">
				<?php _e( 'Enter an address that works with <a href="http://maps.google.com/" target="_blank">Google Maps</a> in order for the directions button to work.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php
	$meta_key = '_risen_location_phone';
	$meta_value = get_post_meta( $object->ID, $meta_key, true );
	?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'Phone Number(s) <span>(Optional)</span>', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<textarea name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>"><?php echo esc_textarea( $meta_value ); ?></textarea>
		</div>
	</p>

	<p>
		<div class="risen-meta-name">
			<label><?php _e( 'E-mail Button <span>(Optional)</span>', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">

			<?php
			$meta_key = '_risen_location_contact';
			$meta_value = get_post_meta( $object->ID, $meta_key, true );
			?>
			<select name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>">
				<option value=""><?php echo _e( '- Select a Contact -', 'risen' ); ?></option>
				<?php echo risen_contact_options( $meta_value, 'show_email' ); ?>
			</select>

			<?php
			$meta_key = '_risen_location_contact_page';
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
				<?php _e( "Choose a contact from Theme Options and a page that you have used the [contact_form] shortcode on if you want to show an e-mail button for this location.", 'risen' ); ?>
			</p>

		</div>
	</p>

	<p>
		<div class="risen-meta-name">
			<label><?php _ex( 'Google Map <span>(Optional)</span>', 'locations meta box', 'risen' ); ?></label>
		</div>
	</p>

	<p class="description">
		<?php _e( 'Provide the details below if you want to show a map for this location.', 'risen' ); ?>
	</p>

	<?php $meta_key = '_risen_location_map_lat'; ?>
	<p>
		<div class="risen-meta-name risen-meta-name-secondary">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'Latitude', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value risen-meta-medium">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
			<p class="description">
				<?php _e( 'You can <a href="https://churchthemes.com/get-latitude-longitude" target="_blank">use this</a> to convert an address into coordinates.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php $meta_key = '_risen_location_map_lng'; ?>
	<p>
		<div class="risen-meta-name risen-meta-name-secondary">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'Longitude', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value risen-meta-medium">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
		</div>
	</p>

	<?php
	$meta_key = '_risen_location_map_type';
	$meta_value = get_post_meta( $object->ID, $meta_key, true );
	if ( 'post' == $screen->base && 'add' == $screen->action ) { // if this is first add, use a default value
		$meta_value = 'HYBRID';
	}
	?>
	<p>
		<div class="risen-meta-name risen-meta-name-secondary">
			<label for="<?php echo $meta_key; ?>"><?php _ex( 'Type', 'map', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<select name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>">
				<?php echo risen_gmaps_type_options( $meta_value ); ?>
			</select>
			<p class="description">
				<?php _e( 'You can show a road map, satellite imagery, a combination of both or terrain.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php
	$meta_key = '_risen_location_map_zoom';
	$meta_value = get_post_meta( $object->ID, $meta_key, true );
	if ( 'post' == $screen->base && 'add' == $screen->action ) { // if this is first add, use a default value
		$meta_value = '14';
	}
	?>
	<p>
		<div class="risen-meta-name risen-meta-name-secondary">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'Zoom Level', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<select name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>">
				<?php echo risen_gmaps_zoom_level_options( $meta_value ); ?>
			</select>
			<p class="description">
				<?php _e( 'A lower number is more zoomed out while a higher number is more zoomed in.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php

}

/**********************************
 * ADMIN COLUMNS
 **********************************/

/**
 * Add/remove location list columns
 * Add "Below Name", Order
 */

function risen_location_columns( $columns ) {

	// insert address and order after location (title)
	$insert_array = array(
		'risen_location_address' => _x( 'Address', 'location admin column', 'risen' ),
		'risen_location_order' => _x( 'Order', 'sorting', 'risen' )
	);
	$columns = risen_array_merge_after_key( $columns, $insert_array, 'title' );

	//change "Location" to "Location"
	$columns['title'] = _x( 'Location', 'location admin column', 'risen' );

	return $columns;

}

/**
 * Change location list column content
 * Add "Below List" custom field value
 */

function risen_location_columns_content( $column ) {

	global $post;

	switch ( $column ) {

		// Address
		case 'risen_location_address' :

			echo nl2br( strip_tags( get_post_meta( $post->ID , '_risen_location_address' , true ) ) );

			break;

		// Order
		case 'risen_location_order' :

			echo isset( $post->menu_order ) ? $post->menu_order : '';

			break;

	}

}

/**
 * Enable sorting for new columns
 */

function risen_location_columns_sorting( $columns ) {

	$columns['risen_location_order'] = 'menu_order';

	return $columns;

}

/**
 * Set how to sort columns (default sorting, custom fields)
 */

function risen_location_columns_sorting_request( $args ) {

	// admin area only
	if ( is_admin() ) {

		$screen = get_current_screen();

		// only on this post type's list
		if ( 'risen_location' == $screen->post_type && 'edit' == $screen->base ) {

			// orderby has been set, tell how to order
			if ( isset( $args['orderby'] ) ) {

				switch ( $args['orderby'] ) {

					// Order
					case '_risen_location_order' :

						$args['meta_key'] = 'menu_order';
						$args['orderby'] = 'meta_value_num';

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
 * Locations Widget
 */

if ( ! class_exists( 'Risen_Locations_Widget' ) ) {

	class Risen_Locations_Widget extends WP_Widget {

		// Register widget with WordPress
		public function __construct() {

			parent::__construct(
				'risen-locations',
				_x( 'Locations', 'locations widget', 'risen' ),
				array(
					'description' => _x( 'This widget lists locations.', 'locations widget', 'risen' )
				)
			);

		}

		// Back-end widget form
		public function form( $instance ) {

			// Set defaults
			$instance = wp_parse_args( (array) $instance, array(
				'title' => _x( 'Locations', 'locations widget', 'risen' ),
				'limit' => '5', // also change in update(),
				'map' => '1',
				'address' => '1',
				'phone' => '1'
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

				<?php $field = 'map'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show map', 'risen' ); ?>
				</label>

				<br />

				<?php $field = 'address'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show address', 'risen' ); ?>
				</label>

				<br />

				<?php $field = 'phone'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show phone number', 'risen' ); ?>
				</label>

			</p>

			<?php

		}

		// Sanitize widget form values as they are saved
		public function update( $new_instance, $old_instance ) {

			$instance = array();

			$instance['title'] = trim( strip_tags( $new_instance['title'] ) );
			$instance['limit'] = (int) $new_instance['limit'] > 0 ? (int) $new_instance['limit'] : 5; // default if not positive number
			$instance['map'] = ! empty( $new_instance['map'] ) ? '1' : '';
			$instance['address'] = ! empty( $new_instance['address'] ) ? '1' : '';
			$instance['phone'] = ! empty( $new_instance['phone'] ) ? '1' : '';

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
				'post_type'			=> 'risen_location',
				'numberposts'		=> $instance['limit'],
				'orderby'			=> 'menu_order',
				'order'				=> 'ASC',
				'suppress_filters'	=> false // help multilingual
			) );

			// Loop Posts
			$i = 0;
			foreach( $posts as $post ) : setup_postdata( $post ); $i++;
			?>

			<article class="locations-widget-item<?php if ( 1 == $i ) : ?> locations-widget-item-first<?php endif; ?>">

				<header>
					<h1 class="locations-widget-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				</header>

				<?php
				$google_map = risen_google_map( array(
					'latitude'	=> get_post_meta( $post->ID , '_risen_location_map_lat' , true ),
					'longitude'	=> get_post_meta( $post->ID , '_risen_location_map_lng' , true ),
					'type'		=> get_post_meta( $post->ID , '_risen_location_map_type' , true ),
					'zoom'		=> get_post_meta( $post->ID , '_risen_location_map_zoom' , true )
				) );
				if ( $google_map && ! empty( $instance['map'] ) ) :
				?>
				<div class="locations-widget-item-map">
					<?php echo $google_map; ?>
				</div>
				<?php endif; ?>

				<?php
				$address = get_post_meta( $post->ID , '_risen_location_address' , true );
				if ( $address && ! empty( $instance['address'] ) ) :
				?>
				<div class="locations-widget-item-address">
					<?php echo nl2br( $address ); ?>
				</div>
				<?php endif; ?>

				<?php
				$phone = get_post_meta( $post->ID , '_risen_location_phone' , true );
				if ( $phone && ! empty( $instance['phone'] ) ) :
				?>
				<div class="locations-widget-item-phone">
					<?php echo nl2br( $phone ); ?>
				</div>
				<?php endif; ?>

			</article>

			<?php

			// End Loop
			endforeach;

			// HTML After
			echo $args['after_widget'];

		}

	}

}
