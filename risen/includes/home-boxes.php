<?php
/**
 * Homepage Image Box Functions
 *
 * Post type, meta boxes, etc.
 */

/**********************************
 * POST TYPE
 **********************************/

function risen_home_box_post_type() {

	// register it
	register_post_type(
		'risen_home_box',
		array(
			'labels' 	=> array(
				'name'					=> _x( 'Home Boxes', 'post type general name', 'risen' ),
				'singular_name'			=> _x( 'Home Box', 'post type singular name', 'risen' ),
				'add_new' 				=> _x( 'Add New', 'home box', 'risen' ),
				'add_new_item' 			=> __( 'Add Home Box', 'risen' ),
				'edit_item' 			=> __( 'Edit Home Box', 'risen' ),
				'new_item' 				=> __( 'New Home Box', 'risen' ),
				'all_items' 			=> __( 'All Boxes', 'risen' ),
				'view_item' 			=> __( 'View Home Box', 'risen' ),
				'search_items' 			=> __( 'Search Home Boxes', 'risen' ),
				'not_found' 			=> __( 'No image boxes found', 'risen' ),
				'not_found_in_trash' 	=> __( 'No image boxes found in Trash', 'risen' ),
				'menu_name'				=> __( 'Home Boxes', 'risen' )
			),
			'public' 			=> true,
			'show_in_nav_menus' => false, // don't let use in menu
			'rewrite'			=> array(
				'slug' 	=> 'home_box'
			),
			'supports' 			=> array( 'thumbnail', 'page-attributes' ) // 'editor' required for media upload button (see Meta Boxes note below about hiding)
		)
	);

}

/**********************************
 * META BOXES
 **********************************/

/*
UPLOAD BUTTONS NOTE
If you want to use media upload buttons, you MUSTconfigure post type to support 'editor'. Otherwise, the "Insert into Post" button will not be available
If you don't want to show the editor, use a style like this in admin-style.css: .screen-post_type-risen_home_box #postdivrich{ display: none }
Use this HTML after an <input>" <input type="button" value="Upload" class="upload_button button risen-upload-file" />
*/

/**
 * Setup Meta Boxes
 */

function risen_home_box_meta_boxes_setup() {

	// This post type only
	$screen = get_current_screen();
	if ( 'risen_home_box' == $screen->post_type ) {

		// Add Meta Boxes
		add_action( 'add_meta_boxes', 'risen_home_box_meta_boxes_add' );

		// Save Meta Boxes
		add_action( 'save_post', 'risen_home_box_meta_boxes_save', 10, 2 );

	}

}

/**
 * Add Meta Boxes
 */

function risen_home_box_meta_boxes_add() {

	// Home Box Options
	add_meta_box(
		'risen_home_box_options',					// Unique meta box ID
		__( 'Box Details', 'risen' ),				// Title of meta box
		'risen_home_box_options_meta_box_html',		// Callback function to output HTML
		'risen_home_box',							// Post Type
		'normal',									// Context - Where the meta box appear: normal (left above standard meta boxes), advanced (left below standard boxes), side
		'core'										// Priority - high, core, default or low (see this: http://www.wproots.com/ultimate-guide-to-meta-boxes-in-wordpress/)
	);

	// Another Here

}

/**
 * Save Meta Boxes
 */

function risen_home_box_meta_boxes_save( $post_id, $post ) {

	// Home Box Options
	$meta_box_id = 'risen_home_box_options';
	$meta_keys = array( // fields to validate and save
		'_risen_home_box_title',
		'_risen_home_box_click_url'
	);
	risen_meta_box_save( $meta_box_id, $meta_keys, $post_id, $post );

	// Another Here

}

/**
 * Options Meta Box HTML
 */

function risen_home_box_options_meta_box_html( $object, $box ) {

	?>

	<?php
	$nonce_params = risen_meta_box_nonce_params( $box['id'] );
	wp_nonce_field( $nonce_params['action'], $nonce_params['key'] );
	?>

	<?php $meta_key = '_risen_home_box_title'; ?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _ex( 'Title', 'home box', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
			<p class="description">
				<?php _e( 'This will appear on top of the image.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php $meta_key = '_risen_home_box_click_url'; ?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _ex( 'Click URL', 'home box', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
			<p class="description">
				<?php _e( 'Enter a URL to go to upon clicking the image box.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php

}

/**
 * Move "Featured Image" meta box below Editor
 */

function risen_home_box_image_box() {

	// remove it from side
	remove_meta_box( 'postimagediv', 'risen_home_box', 'side' );

	// move below editor with new name
	add_meta_box( 'postimagediv', __( 'Image (Required)', 'risen' ), 'post_thumbnail_meta_box', 'risen_home_box', 'normal', 'high' );

}

/**
 * Add note below Featured Image
 */

function risen_home_box_featured_image_note( $content ) {

	// only on this post type
	$screen = get_current_screen();
	if ( ! empty( $screen ) && 'risen_home_box' == $screen->post_type ) {
		$content .= '<p class="description">' . esc_html__( 'Provide an image that is at least 600x400 (it will be cropped/resized) in order for the best experience on mobile devices.', 'risen' ) . '</p>';
	}

	return $content;

}

/**********************************
 * ADMIN COLUMNS
 **********************************/

/**
 * Add/remove home_box list columns
 * Add thumbnail, type, order
 */

function risen_home_box_columns( $columns ) {

	// remove standard WP title column
	unset( $columns['title'] );

	// insert thumbnail, custom title field, order after checkbox
	$insert_array = array(
		'risen_home_box_thumbnail' => __( 'Image', 'risen' ),
		'risen_home_box_title' => _x( 'Title', 'home box', 'risen' ),
		'risen_home_box_order' => _x( 'Order', 'sorting', 'risen' )
	);
	$columns = risen_array_merge_after_key( $columns, $insert_array, 'cb' );

	return $columns;

}

/**
 * Change home_box list column content
 * Add content to new columns
 */

function risen_home_box_columns_content( $column ) {

	global $post;

	switch ( $column ) {

		// Thumbnail
		case 'risen_home_box_thumbnail' :

			if ( has_post_thumbnail() ) {
				echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, array( 80, 80 ) ) . '</a>';
			}

			break;

		// Title
		case 'risen_home_box_title' :

			$edit_url = get_edit_post_link( $post->ID );
			$trash_url = get_delete_post_link( $post->ID );

			$title = strip_tags( get_post_meta( $post->ID , '_risen_home_box_title' , true ), '<b><strong><i><em>' );

			if ( empty( $title ) ) {
				$title = __( 'No Title', 'risen' );
			}

			echo '<a class="row-title" href="' . $edit_url . '">' . strip_tags( $title ) . '</a>';

			echo '<div class="row-actions"><span class="edit"><a href="' . $edit_url . '">' . __( 'Edit', 'risen' ) . '</a> | </span><span class="trash"><a class="submitdelete" href="' . $trash_url . '">' . __( 'Trash', 'risen' ) . '</a></span></div>';

			break;

		// Order
		case 'risen_home_box_order' :

			echo isset( $post->menu_order ) ? $post->menu_order : '';

			break;

	}

}

/**
 * Enable sorting for new columns
 */

function risen_home_box_columns_sorting( $columns ) {

	$columns['risen_home_box_order'] = 'menu_order';

	return $columns;

}

/**
 * Set how to sort columns (default sorting, custom fields)
 */

function risen_home_box_columns_sorting_request( $args ) {

	// admin area only
	if ( is_admin() ) {

		$screen = get_current_screen();

		// only on this post type's list
		if ( 'risen_home_box' == $screen->post_type && 'edit' == $screen->base ) {

			// orderby has been set, tell how to order
			if ( isset( $args['orderby'] ) ) {

				switch ( $args['orderby'] ) {

					// can do sorting here

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
