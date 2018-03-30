<?php
/**
 * Gallery Functions
 *
 * Post type, taxonomy, meta boxes, admin colunms, widget, etc.
 */

/**********************************
 * POST TYPE
 **********************************/
 
function risen_gallery_post_type() {

	// register it
	register_post_type(
		'risen_gallery',
		array(
			'labels' 	=> array(
				'name'					=> _x( 'Gallery', 'post type general name', 'risen' ),
				'singular_name'			=> _x( 'Gallery Item', 'post type singular name', 'risen' ),
				'add_new' 				=> _x( 'Add Photo or Video', 'gallery', 'risen' ),
				'add_new_item' 			=> __( 'Add Photo or Video', 'risen' ),
				'edit_item' 			=> __( 'Edit Gallery Item', 'risen' ),
				'new_item' 				=> __( 'New Gallery Item', 'risen' ),
				'all_items' 			=> _x( 'All Photos & Videos', 'gallery', 'risen' ),
				'view_item' 			=> __( 'View Item', 'risen' ),
				'search_items' 			=> __( 'Search Gallery', 'risen' ),
				'not_found' 			=> __( 'No gallery photos or videos found', 'risen' ),
				'not_found_in_trash' 	=> __( 'No gallery photos or videos found in Trash', 'risen' )
			),
			'public' 			=> true,
			'has_archive' 		=> false,
			'show_in_nav_menus' => true,
			'rewrite'			=> array(
				'slug' 	=> 'gallery-items', // best not to use slug likely to be used by a Page (such as gallery) to avoid URL rewrite conflicts
				'with_front' => false
			),
			'supports' 			=> array( 'title', 'editor', 'thumbnail', 'comments', 'author', 'revisions' ),
			'taxonomies' 		=> array( 'risen_gallery_category' )
		)
	);

}

/**********************************
 * TAXONOMY (CATEGORIES)
 **********************************/

function risen_gallery_taxonomy() {

	register_taxonomy(
		'risen_gallery_category',
		'risen_gallery',
		array(
			'labels' => array(
				'name' 						=> _x( 'Gallery Categories', 'taxonomy general name', 'risen' ),
				'singular_name'				=> _x( 'Gallery Category', 'taxonomy singular name', 'risen' ),
				'search_items' 				=> _x( 'Search Categories', 'gallery', 'risen' ),
				'popular_items' 			=> _x( 'Popular Categories', 'gallery', 'risen' ),
				'all_items' 				=> _x( 'All Categories', 'gallery', 'risen' ),
				'parent_item' 				=> null,
				'parent_item_colon' 		=> null,
				'edit_item' 				=> _x( 'Edit Category', 'gallery', 'risen' ), 
				'update_item' 				=> _x( 'Update Category', 'gallery', 'risen' ),
				'add_new_item' 				=> _x( 'Add Category', 'gallery', 'risen' ),
				'new_item_name' 			=> _x( 'New Category', 'gallery', 'risen' ),
				'separate_items_with_commas' => _x( 'Separate categories with commas', 'gallery', 'risen' ),
				'add_or_remove_items' 		=> _x( 'Add or remove categories', 'gallery', 'risen' ),
				'choose_from_most_used' 	=> _x( 'Choose from the most used categories', 'gallery', 'risen' ),
				'menu_name' 				=> _x( 'Categories', 'gallery menu name', 'risen' )
			),
			'hierarchical'			=> true, // category-style instead of tag-style
			'public' 				=> true,
			'rewrite' 				=> array(
				'slug' 			=> 'gallery-category',
				'with_front' 	=> false,
				'hierarchical' 	=> true
			)
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
 
function risen_gallery_meta_boxes_setup() {

	// This post type only
	$screen = get_current_screen();
	if ( 'risen_gallery' == $screen->post_type ) {

		// Add Meta Boxes
		add_action( 'add_meta_boxes', 'risen_gallery_meta_boxes_add' );

		// Save Meta Boxes
		add_action( 'save_post', 'risen_gallery_meta_boxes_save', 10, 2 );

	}
	
}

/**
 * Add Meta Boxes
 */
 
function risen_gallery_meta_boxes_add() {

	// Move and rename "Featured Image"
	remove_meta_box( 'postimagediv', 'risen_gallery', 'side' ); // remove it first
	add_meta_box( 'postimagediv', __( 'Image (Required)', 'risen' ), 'post_thumbnail_meta_box', 'risen_gallery', 'normal', 'high' );
	
	// Media Files
	add_meta_box(
		'risen_gallery_options',					// Unique meta box ID
		_x( 'Video (Optional)', 'gallery metabox', 'risen' ), // Title of meta box
		'risen_gallery_options_meta_box_html',		// Callback function to output HTML
		'risen_gallery',							// Post Type
		'normal',									// Context - Where the meta box appear: normal (left above standard meta boxes), advanced (left below standard boxes), side
		'high'										// Priority - high, core, default or low (see this: http://www.wproots.com/ultimate-guide-to-meta-boxes-in-wordpress/)
	);

}

/**
 * Save Meta Boxes
 */

function risen_gallery_meta_boxes_save( $post_id, $post ) {

	// Trim video URL
	$_POST['_risen_gallery_video_url'] = isset( $_POST['_risen_gallery_video_url'] ) ? trim( $_POST['_risen_gallery_video_url'] ) : '';

	// Determine media type
	// Saving this helps filter by meta value on image only and video only
	$_POST['_risen_gallery_type'] = ! empty( $_POST['_risen_gallery_video_url'] ) ? 'video' : 'image';
	
	// Save meta values for Media meta box
	$meta_box_id = 'risen_gallery_options';
	$meta_keys = array( // fields to validate and save
		'_risen_gallery_video_url',
		'_risen_gallery_type'
	);
	risen_meta_box_save( $meta_box_id, $meta_keys, $post_id, $post );

}

/**
 * Media Files Meta Box HTML
 */

function risen_gallery_options_meta_box_html( $object, $box ) {

	?>

	<?php
	$nonce_params = risen_meta_box_nonce_params( $box['id'] );
	wp_nonce_field( $nonce_params['action'], $nonce_params['key'] );
	?>
	
	<?php $meta_key = '_risen_gallery_video_url'; ?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'Video URL', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
			<p class="description">
				<?php _e( 'Enter a YouTube or Vimeo video page URL. Examples:', 'risen' ); ?>
				<br />
				<br />http://www.youtube.com/watch?v=mmRPSoDrrFU
				<br />http://vimeo.com/28323716
				<br />
				<br />
				<?php _e( '<b>Note:</b> You must provide a thumbnail image to represent this video.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php

}

/**
 * Add note below Featured Image
 */
 
function risen_gallery_featured_image_note( $content ) {

	// only on this post type
	$screen = get_current_screen();
	if ( ! empty( $screen ) && 'risen_gallery' == $screen->post_type ) {
		$content .= '<p class="description">' . esc_html__( 'Please provide an image that is at least 600x400.', 'risen' ) . '</p>';
	}

	return $content;
	
}

/**********************************
 * ADMIN COLUMNS
 **********************************/

/**
 * Add/remove gallery list columns
 * Add thumbnail, media type, categories
 */

function risen_gallery_columns( $columns ) {

	// insert thumbnail after checkbox (before title)
	$insert_array = array(
		'risen_gallery_thumbnail' => __( 'Thumbnail', 'risen' )
	);
	$columns = risen_array_merge_after_key( $columns, $insert_array, 'cb' );
	
	// insert media type, categories after title
	$insert_array = array(
		'risen_gallery_type' => __( 'Type', 'risen' ),
		'risen_gallery_categories' => __( 'Categories', 'risen' )
	);
	$columns = risen_array_merge_after_key( $columns, $insert_array, 'title' );
	
	return $columns;

}

/**
 * Change gallery list column content
 * Add content to new columns
 */

function risen_gallery_columns_content( $column ) {

	global $post;
	
	switch ( $column ) {

		// Thumbnail
		case 'risen_gallery_thumbnail' :

			if ( has_post_thumbnail() ) {
				echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, array( 80, 80) ) . '</a>';
			}

			break;

		// Media Type
		case 'risen_gallery_type' :

			$type = get_post_meta( $post->ID , '_risen_gallery_type' , true );

			echo ucfirst( $type );

			break;
			
		// Categories
		case 'risen_gallery_categories' :

			// Get categories and output a list
			$categories = get_the_terms( $post->ID, 'risen_gallery_category' );
			if ( $categories && ! is_wp_error( $categories ) ) {
			
				$categories_array = array();
				
				foreach ( $categories as $category ) {
					$categories_array[] = $category->name;
				}	
				
				echo implode( ', ', $categories_array );
				
			}

			break;

	}

}

/**********************************
 * ARCHIVES (Categories)
 **********************************/

/**
 * Filter the posts per page value for gallery archives (categories)
 * This solves an issue with pagination not working correctly for custom post type archives and taxonomy templates
 * The solution is thanks to Justin Carroll in the fourth post here: http://wordpress.org/support/topic/custom-post-type-taxonomy-pagination
 */

function risen_gallery_archive_posts_per_page( $value ) {

	// Don't let this mess with saving of default posts per page in admin
	if ( ! is_admin() ) {
		
		// Which post type archives should this affect?
		$post_type_slugs = array( 'risen_gallery' );
		
		// Which taxonomies should this affect?
		$taxonomies = array( 'risen_gallery_category' );

		// Use the gallery items per page value from Theme Options if there is a match
		if ( is_post_type_archive( $post_type_slugs ) || is_tax( $taxonomies ) ) {
			return risen_option( 'gallery_per_page' ) ? risen_option( 'gallery_per_page' ) : risen_option_default( 'gallery_per_page' );
		}
		
	}

	// Otherwise let it behave normally
	return $value;

}



/**********************************
 * CONTENT OUTPUT
 **********************************/

/*
 * Output featured image for gallery archives or single post
 */
 
if ( ! function_exists( 'risen_gallery_header_image' ) ) {

	function risen_gallery_header_image( $return = false ) {

		$use_template_image = false;

		// Single post
		if ( is_singular( 'risen_gallery' ) ) {

			// Use image from Gallery template if Theme Options allows
			if ( risen_option( 'gallery_page_inherit_single' ) ) {
				$use_template_image = true;
			}
		
		}
		
		// Archive
		else if ( risen_option( 'gallery_page_inherit_archives' ) ) {
			$use_template_image = true;
		}
		
		// Image from page specified in Theme Options
		if ( $use_template_image ) {

			// Get ID of page to inherit header image / sidebar setup from
			$gallery_page_id = risen_option( 'gallery_page_id' );

			// show featured image from that page
			if ( ! empty( $gallery_page_id ) ) {
				$use_post_id = $gallery_page_id;
			}
		
		}
		
		// Return image HTML
		if ( ! empty( $use_post_id ) ) {
		
			$thumbnail = get_the_post_thumbnail( $use_post_id, 'risen-header', array ( 'class' => 'page-header-image', 'title' => '' ) );
			
			if ( $return ) {
				return $thumbnail;
			} else {
				echo $thumbnail;
			}
			
		}
		
	}
	
}

/**********************************
 * WIDGETS
 **********************************/

/**
 * Upcoming Events
 */

if ( ! class_exists( 'Risen_Gallery_Widget' ) ) {

	class Risen_Gallery_Widget extends WP_Widget {

		// Register widget with WordPress
		public function __construct() {
		
			parent::__construct(
				'risen-gallery',
				_x( 'Recent Gallery Items', 'gallery widget', 'risen' ),
				array(
					'description' => _x( 'Shows recent gallery images and videos.', 'gallery widget', 'risen' )
				)			
			);

		}

		// Back-end widget form
		public function form( $instance ) {

			// Set defaults
			$instance = wp_parse_args( (array) $instance, array(
				'title' => _x( 'Gallery', 'gallery widget', 'risen' ),
				'per_row' => '3', // also change in update(),
				'rows' => '3',
				'images' => '1',
				'videos' => '1',
				'category' => ''
			) );

			?>
			
			<?php $field = 'title'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Title:', 'risen' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" type="text" value="<?php echo esc_attr( $instance[$field] ); ?>" />
			</p>
			
			<?php $field = 'per_row'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Number of items per row:', 'risen' ); ?></label>
				<select id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>">
					<?php
					$per_row_options = array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5 (Homepage Only)',
					);
					foreach( $per_row_options as $per_row_option => $per_row_option_name ) :
					?>
						<option value="<?php echo esc_attr( $per_row_option ); ?>"<?php if ( $instance[$field] == $per_row_option ) : ?> selected="selected"<?php endif; ?>><?php echo esc_html( $per_row_option_name ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			
			<?php $field = 'rows'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Number of rows:', 'risen' ); ?></label> 
				<input style="width:40px;" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" type="text" value="<?php echo esc_attr( $instance[$field] ); ?>" />
			</p>
			
			<?php $field = 'category'; ?>
			<p>
				<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e( 'Category:', 'risen' ); ?></label> 
				<select id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>">
					<option value="">All</option>
					<?php
					$categories = get_terms( 'risen_gallery_category', array(
						'hide_empty' => false,
						'hierarchical ' => false
					) );
					foreach ( $categories as $category ) :
					?>
						<option value="<?php echo esc_attr( $category->term_id ); ?>"<?php if ( $instance[$field] == $category->term_id ) : ?> selected="selected"<?php endif; ?>><?php echo esc_html( $category->name ); ?> (<?php echo esc_html( $category->count ); ?>)</option>
					<?php endforeach; ?>
				</select>
			</p>
			
			<p>
				
				<?php $field = 'images'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show images', 'risen' ); ?>
				</label>
				
				<br />
				
				<?php $field = 'videos'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show videos', 'risen' ); ?>
				</label>
				
			</p>
			
			<?php
			
		}

		// Sanitize widget form values as they are saved
		public function update( $new_instance, $old_instance ) {

			$instance = array();
			
			$instance['title'] = trim( strip_tags( $new_instance['title'] ) );
			$instance['per_row'] = (int) $new_instance['per_row'] > 0 ? (int) $new_instance['per_row'] : 3; // default if not positive number
			$instance['rows'] = (int) $new_instance['rows'] > 0 ? (int) $new_instance['rows'] : 3; // default if not positive number
			$instance['category'] = (int) $new_instance['category'] > 0 ? (int) $new_instance['category'] : '';
			$instance['images'] = ! empty( $new_instance['images'] ) ? '1' : '';
			$instance['videos'] = ! empty( $new_instance['videos'] ) ? '1' : '';

			return $instance;
			
		}
		
		// Front-end display of widget
		public function widget( $args, $instance ) {
		
			global $post;

			// HTML Before
			echo $args['before_widget'];
			
			// Title
			$title = apply_filters( 'widget_title', $instance['title'] );
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			
			// Base post arguments
			$limit = $instance['per_row'] * $instance['rows'];
			$post_args = array(
				'post_type'		=> 'risen_gallery',
				'numberposts'	=> $limit,
				'risen_gallery_category' => isset( $category_term->slug ) ? $category_term->slug : '', // filter by category term if specified
				'suppress_filters'	=> false // help multilingual
			);
			$posts = get_posts( $post_args );
			
			// Filter by category
			if ( ! empty( $instance['category'] ) ) { // get term slug from term ID
				$category_term = get_term( $instance['category'], 'risen_gallery_category' );
				if ( ! empty( $category_term->slug ) ) {
					$post_args['risen_gallery_category'] = $category_term->slug;
				}
			}
			
			// Filter by image only
			if ( $instance['images'] && ! $instance['videos'] ) {
				$post_args['meta_query'] = array(
					array(
						'key'		=> '_risen_gallery_type',
						'value'		=> 'image',
						'compare'	=> '='
					)
				);
			}
			
			// Filter by video only
			else if ( $instance['videos'] && ! $instance['images'] ) {
				$post_args['meta_query'] = array(
					array(
						'key'		=> '_risen_gallery_type',
						'value'		=> 'video',
						'compare'	=> '='
					)
				);
			}

			// Get posts
			$posts = get_posts( $post_args );
			
			?>
			
			<?php if ( ! empty( $posts ) && is_home() || $instance['per_row'] < 5 ) : $i = 0; ?>
			<ul class="gallery-widget-items per-row-<?php echo esc_attr( $instance['per_row'] ); ?>">

				<?php foreach( $posts as $post ) : ?>
				
					<?php if ( has_post_thumbnail( $post->ID ) ) : $i++; ?>							
					<li>
						<div class="image-frame">
							<a href="<?php echo get_permalink( $post->ID ); ?>">
								<?php echo get_the_post_thumbnail( $post->ID, 'risen-square-thumb', array( 'title' => $post->post_title ) ); ?> 
							</a>
						</div>
					</li>
					<?php endif; ?>
				
				<?php endforeach; ?>
			
			</ul>
			<?php endif; ?>
			
			<?php
			
			// 5 or more used in sidebar - does not fit
			if ( ! is_home() && $instance['per_row'] >= 5 ) {
				_e( '<b>Widget Notice:</b> More than 4 items per row will only fit on the homepage.', 'risen' );
			}
			
			// No items found
			else if ( empty( $i ) ) {
				_e( 'No gallery items found.', 'risen' );
			}
			
			// HTML After
			echo $args['after_widget'];

		}

	}
	
}
