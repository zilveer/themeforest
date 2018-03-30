<?php
/**
 * Page Functions
 *
 * Manipulate and add onto the built-in page post type
 */ 

/**********************************
 * META BOXES
 **********************************/
 
/**
 * Add note below Featured Image for Header Image
 * This applied to Pages and Posts (blog)
 */
 
function risen_featured_image_note( $content ) {

	// only on this post type
	$screen = get_current_screen();
	if ( ! empty( $screen ) && in_array( $screen->post_type, array( 'post', 'page' ) ) ) {
		$content .= '<p class="description">' . esc_html__( 'Optionally provide a header image that is at least 960x250 (it will be cropped/resized). An image exactly this size is ideal.', 'risen' ) . '</p>';
	}

	return $content;
	
}

/*
UPLOAD BUTTONS NOTE
If you want to use media upload buttons, you MUST configure post type to support 'editor'. Otherwise, the "Insert into Post" button will not be available
If you don't want to show the editor, use a style like this in admin-style.css: .screen-post_type-risen_slide #postdivrich{ display: none } 
Use this HTML after an <input>" <input type="button" value="Upload" class="upload_button button risen-upload-file" />
*/

/**
 * Setup Meta Boxes
 */
 
function risen_page_meta_boxes_setup() {

	// This post type only
	$screen = get_current_screen();
	if ( 'page' == $screen->post_type ) {

		// Add Meta Boxes
		add_action( 'add_meta_boxes', 'risen_page_meta_boxes_add' );

		// Save Meta Boxes
		add_action( 'save_post', 'risen_page_meta_boxes_save', 10, 2 );

	}
	
}

/**
 * Add Meta Boxes
 */
 
function risen_page_meta_boxes_add() {

	// Header
	add_meta_box(
		'risen_page_header',					// Unique meta box ID
		__( 'Page Header Override', 'risen' ),	// Title of meta box
		'risen_page_header_meta_box_html',		// Callback function to output HTML
		'page',									// Post Type
		'side',									// Context - Where the meta box appear: normal (left above standard meta boxes), advanced (left below standard boxes), side
		'low'									// Priority - high, core, default or low (see this: http://www.wproots.com/ultimate-guide-to-meta-boxes-in-wordpress/)
	);

}

/**
 * Save Meta Boxes
 */

function risen_page_meta_boxes_save( $post_id, $post ) {

	// Header
	$meta_box_id = 'risen_page_header';
	$meta_keys = array( // fields to validate and save
		'_risen_page_header_page_id',
		'_risen_page_header_show_title'
	);
	risen_meta_box_save( $meta_box_id, $meta_keys, $post_id, $post );

}

/**
 * Media Files Meta Box HTML
 */

function risen_page_header_meta_box_html( $object, $box ) {

	$screen = get_current_screen();
	
	$nonce_params = risen_meta_box_nonce_params( $box['id'] );
	wp_nonce_field( $nonce_params['action'], $nonce_params['key'] );

	?>
	
	<?php
	$meta_key = '_risen_page_header_page_id';
	$meta_value = get_post_meta( $object->ID, $meta_key, true );
	?>
	<p>
		<div class="risen-meta-value">
			<select name="<?php echo $meta_key; ?>">
				<?php
				$page_options = risen_page_options();
				foreach ( $page_options as $page_id => $page_title ) :
				?>
				<option value="<?php echo esc_attr( $page_id ); ?>"<?php if ( $page_id == $meta_value ) : ?> selected="selected"<?php endif; ?>><?php echo esc_html( $page_title ); ?></option>';
				<?php endforeach; ?>
			</select>
			<p class="description" style="margin-top:12px">
				<?php _e( "If you want to use another page's title and featured image as a header, select it here (that page must have a featured image).", 'risen' ); ?>
			</p>
		</div>
	</p>
	
	<?php
	$meta_key = '_risen_page_header_show_title';
	$meta_value = get_post_meta( $object->ID, $meta_key, true ); // saved value
	if ( 'post' == $screen->base && 'add' == $screen->action ) { // if this is first add, use a default value
		$meta_value = '1';
	}
	?>
	<p>
		<label for="<?php echo $meta_key; ?>">
			<input type="checkbox" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="right"<?php if ( ! empty( $meta_value) ) : ?> checked="checked"<?php endif; ?> />
			<?php _e( "Show this page's title below header", 'risen' ); ?>
		</label>
	</p>

	<?php

} 

/**********************************
 * DATA
 **********************************/
 
/*
 * Get Page by Template
 * Get newest page using a specific template file name
 */
 
if ( ! function_exists( 'risen_get_page_by_template' ) ) {

	function risen_get_page_by_template( $template_file ) {

		/*

		// If more than one, gets the newest
		$pages = get_pages( array(
			'meta_key' => '_wp_page_template',
			'meta_value' => $template_file,
			'sort_column' => 'ID',
			'sort_order' => 'DESC',
			'number' => 1
		) );
		
		// Got one?
		if ( ! empty( $pages[0] ) ) {
			return $pages[0];
		}
		
		*/
		
		// Note: the method above fails for pages that have parent(s) so using WP_Query directly
		
		// If more than one, gets the newest
		$page_query = new WP_Query( array(
			'post_type'			=> 'page',
			'nopaging'			=> true,
			'posts_per_page'	=> 1,
			'meta_key' 			=> '_wp_page_template',
			'meta_value' 		=> $template_file,
			'orderby'			=> 'ID',
			'order'				=> 'DESC'
		) );
		
		// Got one?
		if ( ! empty( $page_query->post ) ) {
			return $page_query->post;
		}

		return false;	
	
	}

}

/*
 * Get Page ID by Template
 */
 
if ( ! function_exists( 'risen_get_page_id_by_template' ) ) {

	function risen_get_page_id_by_template( $template_file ) {
	
		$page = risen_get_page_by_template( $template_file );

		$page_id = ! empty( $page->ID ) ? $page->ID : '';
		
		return $page_id;	
	
	}

}

/*
 * Page Options
 * Handy for theme options
 */

if ( ! function_exists( 'risen_page_options' ) ) {

	function risen_page_options( $allow_none = true ) {
	
		$pages = get_pages( array(
			'hierarchical' => false,
		) );
		
		$page_options = array();
		
		if ( ! empty( $allow_none ) ) {
			$page_options[] = '';
		}
		
		foreach ( $pages as $page ) {
			$page_options[$page->ID] = $page->post_title;
		}
		
		return $page_options;
	
	}

}