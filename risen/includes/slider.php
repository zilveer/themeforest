<?php
/**
 * Homepage Slider Functions
 *
 * Post type, meta boxes, etc.
 */

/**********************************
 * POST TYPE
 **********************************/

function risen_slide_post_type() {

	// register it
	register_post_type(
		'risen_slide',
		array(
			'labels' 	=> array(
				'name'					=> _x( 'Slides', 'post type general name', 'risen' ),
				'singular_name'			=> _x( 'Slide', 'post type singular name', 'risen' ),
				'add_new' 				=> _x( 'Add New', 'slider', 'risen' ),
				'add_new_item' 			=> __( 'Add Slide', 'risen' ),
				'edit_item' 			=> __( 'Edit Slide', 'risen' ),
				'new_item' 				=> __( 'New Slide', 'risen' ),
				'all_items' 			=> __( 'All Slides', 'risen' ),
				'view_item' 			=> __( 'View Slide', 'risen' ),
				'search_items' 			=> __( 'Search Slides', 'risen' ),
				'not_found' 			=> __( 'No slides found', 'risen' ),
				'not_found_in_trash' 	=> __( 'No slides found in Trash', 'risen' ),
				'menu_name'				=> __( 'Home Slider', 'risen' )
			),
			'public' 			=> true,
			'show_in_nav_menus' => false, // don't let use in menu
			'rewrite'			=> array(
				'slug' 	=> 'slide'
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
If you don't want to show the editor, use a style like this in admin-style.css: .screen-post_type-risen_slide #postdivrich{ display: none }
Use this HTML after an <input>" <input type="button" value="Upload" class="upload_button button risen-upload-file" />
*/

/**
 * Setup Meta Boxes
 */

function risen_slide_meta_boxes_setup() {

	// This post type only
	$screen = get_current_screen();
	if ( 'risen_slide' == $screen->post_type ) {

		// Add Meta Boxes
		add_action( 'add_meta_boxes', 'risen_slide_meta_boxes_add' );

		// Save Meta Boxes
		add_action( 'save_post', 'risen_slide_meta_boxes_save', 10, 2 );

	}

}

/**
 * Add Meta Boxes
 */

function risen_slide_meta_boxes_add() {

	// Slide Options
	add_meta_box(
		'risen_slide_options',					// Unique meta box ID
		__( 'Slide Options', 'risen' ),			// Title of meta box
		'risen_slide_options_meta_box_html',	// Callback function to output HTML
		'risen_slide',							// Post Type
		'normal',								// Context - Where the meta box appear: normal (left above standard meta boxes), advanced (left below standard boxes), side
		'core'									// Priority - high, core, default or low (see this: http://www.wproots.com/ultimate-guide-to-meta-boxes-in-wordpress/)
	);

	// Another Here

}

/**
 * Save Meta Boxes
 */

function risen_slide_meta_boxes_save( $post_id, $post ) {

	// Slide Options
	$meta_box_id = 'risen_slide_options';
	$meta_keys = array( // fields to validate and save
		'_risen_slide_caption',
		'_risen_slide_click_url',
		'_risen_slide_video_url'
	);
	risen_meta_box_save( $meta_box_id, $meta_keys, $post_id, $post );

	// Another Here

}

/**
 * Options Meta Box HTML
 */

function risen_slide_options_meta_box_html( $object, $box ) {

	?>

	<?php
	$nonce_params = risen_meta_box_nonce_params( $box['id'] );
	wp_nonce_field( $nonce_params['action'], $nonce_params['key'] );
	?>

	<?php $meta_key = '_risen_slide_caption'; ?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'Caption <span>(Optional)</span>', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
			<p class="description">
				<?php _e( '<b>Tip:</b> Make part of your caption bold with HTML (e.g. "&lt;b&gt;First Time?&lt;/b&gt; Watch Our Welcome Video")', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php $meta_key = '_risen_slide_click_url'; ?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'Click URL <span>(Optional)</span>', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
			<p class="description">
				<?php _e( 'Enter a URL to go to upon clicking the slide image or caption.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php $meta_key = '_risen_slide_video_url'; ?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'Video URL <span>(Optional)</span>', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
			<p class="description">
				<?php _e( 'To make this a video slide, enter a YouTube or Vimeo video page URL. Examples:', 'risen' ); ?>
				<br />
				<br />http://www.youtube.com/watch?v=mmRPSoDrrFU
				<br />http://vimeo.com/28323716
				<br />
				<br />
				<?php _e( '<b>Note:</b> You must provide an image above to represent this video in the slider.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php

}

/**
 * Move "Featured Image" meta box below Editor
 */

function risen_slide_image_box() {

	// remove it from side
	remove_meta_box( 'postimagediv', 'risen_slide', 'side' );

	// move below editor with new name
	add_meta_box( 'postimagediv', __( 'Image (Required)', 'risen' ), 'post_thumbnail_meta_box', 'risen_slide', 'normal', 'high' );

}

/**
 * Add note below Featured Image
 */

function risen_slide_featured_image_note( $content ) {

	// only on this post type
	$screen = get_current_screen();
	if ( ! empty( $screen ) && 'risen_slide' == $screen->post_type ) {
		$content .= '<p class="description">' . esc_html__( 'Provide an image that is at least 960x350 (it will be cropped/resized). Ideally, provide an image that is exactly this size. An image is required even for video slides.', 'risen' ) . '</p>';
	}

	return $content;

}

/**********************************
 * ADMIN COLUMNS
 **********************************/

/**
 * Add/remove slide list columns
 * Add thumbnail, type, order
 */

function risen_slide_columns( $columns ) {

	// remove title column
	unset( $columns['title'] );

	// insert thumbnail, caption, type, order after checkbox
	$insert_array = array(
		'risen_slide_thumbnail' => __( 'Image', 'risen' ),
		'risen_slide_caption' => __( 'Caption', 'risen' ),
		'risen_slide_type' => _x( 'Type', 'slider', 'risen' ),
		'risen_slide_order' => _x( 'Order', 'sorting', 'risen' )
	);
	$columns = risen_array_merge_after_key( $columns, $insert_array, 'cb' );

	return $columns;

}

/**
 * Change slide list column content
 * Add content to new columns
 */

function risen_slide_columns_content( $column ) {

	global $post;

	switch ( $column ) {

		// Thumbnail
		case 'risen_slide_thumbnail' :

			if ( has_post_thumbnail() ) {
				echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, 'risen-slider', array( 'style' => 'width: 240px; height: auto;' ) ) . '</a>';
			}

			break;

		// Caption
		case 'risen_slide_caption' :

			$edit_url = get_edit_post_link( $post->ID );
			$trash_url = get_delete_post_link( $post->ID );

			$caption = strip_tags( get_post_meta( $post->ID , '_risen_slide_caption' , true ), '<b><strong><i><em>' );

			if ( empty( $caption ) ) {
				$caption = __( 'No Caption', 'risen' );
			}

			echo '<a class="row-title" style="font-weight:normal" href="' . $edit_url . '">' . $caption . '</a>';

			echo '<div class="row-actions"><span class="edit"><a href="' . $edit_url . '">' . __( 'Edit', 'risen' ) . '</a> | </span><span class="trash"><a class="submitdelete" href="' . $trash_url . '">' . __( 'Trash', 'risen' ) . '</a></span></div>';

			break;

		// Type
		case 'risen_slide_type' :

			$video_page_url = get_post_meta( $post->ID , '_risen_slide_video_url' , true );

			$type = ''; // if no img or video
			if ( has_post_thumbnail() ) { // image provided?
				$type = ! empty( $video_page_url ) ? 'Video' : 'Image'; // if no video URL, it's image
			}

			echo $type;

			break;

		// Order
		case 'risen_slide_order' :

			echo isset( $post->menu_order ) ? $post->menu_order : '';

			break;

	}

}

/**
 * Enable sorting for new columns
 */

function risen_slide_columns_sorting( $columns ) {

	$columns['risen_slide_order'] = 'menu_order';
	//$columns['risen_slide_caption'] = '_risen_slide_caption';

	return $columns;

}

/**
 * Set how to sort columns (default sorting, custom fields)
 */

function risen_slide_columns_sorting_request( $args ) {

	// admin area only
	if ( is_admin() ) {

		$screen = get_current_screen();

		// only on this post type's list
		if ( 'risen_slide' == $screen->post_type && 'edit' == $screen->base ) {

			// orderby has been set, tell how to order
			if ( isset( $args['orderby'] ) ) {

				switch ( $args['orderby'] ) {

					// Caption
					/*
					case '_risen_slide_caption' :

						$args['meta_key'] = '_risen_slide_caption';
						$args['orderby'] = 'meta_value'; // alphabetically (meta_value_num for numeric)

						break;
					*/

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
