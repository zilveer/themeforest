<?php
/**
 * Multimedia (Sermons) Functions
 *
 * Post type, taxonomy, meta boxes, admin colunms, widgets, etc.
 */

/**********************************
 * POST TYPE
 **********************************/

function risen_multimedia_post_type() {

	// register it
	register_post_type(
		'risen_multimedia',
		array(
			'labels' 	=> array(
				'name'					=> risen_option( 'multimedia_word_plural' ),
				'singular_name'			=> risen_option( 'multimedia_word_singular' ),
				'add_new' 				=> _x( 'Add New', 'multimedia', 'risen' ),
				'add_new_item' 			=> sprintf( __( 'Add %s', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
				'edit_item' 			=> sprintf( __( 'Edit %s', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
				'new_item' 				=> sprintf( __( 'New %s', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
				'all_items' 			=> _x( 'All Items', 'multimedia', 'risen' ),
				'view_item' 			=> sprintf( __( 'View %s', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
				'search_items' 			=> sprintf( __( 'Search %s', 'risen' ), risen_option( 'multimedia_word_plural' ) ),
				'not_found' 			=> __( 'No items found', 'risen' ),
				'not_found_in_trash' 	=> __( 'No items found in Trash', 'risen' )
			),
			'public' 			=> true,
			'has_archive' 		=> true,
			'show_in_nav_menus' => true,
			'rewrite'			=> array(
				'slug' 	=> 'multimedia-archive', // best to use slug different than page using Multimedia template or there WILL be conflicts; used for year/month/day archives and single post view
				'with_front' => false
			),
			'supports' 			=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'author', 'revisions' ), // 'editor' required for media upload button (see Meta Boxes note below about hiding)
			'taxonomies' 		=> array( 'risen_multimedia_category', 'risen_multimedia_tag', 'risen_multimedia_speaker' )
		)
	);

}

/**********************************
 * TAXONOMIES
 **********************************/

/**
 * Categories
 */

function risen_multimedia_category_taxonomy() {

	register_taxonomy(
		'risen_multimedia_category',
		'risen_multimedia',
		array(
			'labels' => array(
				'name' 						=> sprintf( _x( '%s Categories', 'taxonomy general name', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
				'singular_name'				=> sprintf( _x( '%s Category', 'taxonomy singular name', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
				'search_items' 				=> _x( 'Search Categories', 'multimedia', 'risen' ),
				'popular_items' 			=> _x( 'Popular Categories', 'multimedia', 'risen' ),
				'all_items' 				=> _x( 'All Categories', 'multimedia', 'risen' ),
				'parent_item' 				=> null,
				'parent_item_colon' 		=> null,
				'edit_item' 				=> _x( 'Edit Category', 'multimedia', 'risen' ),
				'update_item' 				=> _x( 'Update Category', 'multimedia', 'risen' ),
				'add_new_item' 				=> _x( 'Add Category', 'multimedia', 'risen' ),
				'new_item_name' 			=> _x( 'New Category', 'multimedia', 'risen' ),
				'separate_items_with_commas' => _x( 'Separate categories with commas', 'multimedia', 'risen' ),
				'add_or_remove_items' 		=> _x( 'Add or remove categories', 'multimedia', 'risen' ),
				'choose_from_most_used' 	=> _x( 'Choose from the most used categories', 'multimedia', 'risen' ),
				'menu_name' 				=> _x( 'Categories', 'multimedia menu name', 'risen' )
			),
			'hierarchical'			=> true, // category-style instead of tag-style
			'public' 				=> true,
			'rewrite' 				=> array(
										'slug' => 'multimedia-category',
										'with_front' => false,
										'hierarchical' => true
									)
		)
	);

}

/**
 * Tags
 */

function risen_multimedia_tag_taxonomy() {

	register_taxonomy(
		'risen_multimedia_tag',
		'risen_multimedia',
		array(
			'labels' => array(
				'name' 						=> sprintf( _x( '%s Tags', 'taxonomy general name', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
				'singular_name'				=> sprintf( _x( '%s Tag', 'taxonomy singular name', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
				'search_items' 				=> _x( 'Search Tags', 'multimedia', 'risen' ),
				'popular_items' 			=> _x( 'Popular Tags', 'multimedia', 'risen' ),
				'all_items' 				=> _x( 'All Tags', 'multimedia', 'risen' ),
				'parent_item' 				=> null,
				'parent_item_colon' 		=> null,
				'edit_item' 				=> _x( 'Edit Tag', 'multimedia', 'risen' ),
				'update_item' 				=> _x( 'Update Tag', 'multimedia', 'risen' ),
				'add_new_item' 				=> _x( 'Add Tag', 'multimedia', 'risen' ),
				'new_item_name' 			=> _x( 'New Tag', 'multimedia', 'risen' ),
				'separate_items_with_commas' => _x( 'Separate tags with commas', 'multimedia', 'risen' ),
				'add_or_remove_items' 		=> _x( 'Add or remove tags', 'multimedia', 'risen' ),
				'choose_from_most_used' 	=> _x( 'Choose from the most used tags', 'multimedia', 'risen' ),
				'menu_name' 				=> _x( 'Tags', 'multimedia menu name', 'risen' )
			),
			'hierarchical'			=> false, // tag style instead of category
			'public' 				=> true,
			'rewrite' 				=> array(
										'slug' => 'multimedia-tag',
										'with_front' => false,
										'hierarchical' => true
									)
		)
	);

}

/**
 * Speaker
 */

function risen_multimedia_speaker_taxonomy() {

	register_taxonomy(
		'risen_multimedia_speaker',
		'risen_multimedia',
		array(
			'labels' => array(
				'name' 						=> sprintf( _x( '%s Speakers', 'taxonomy general name', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
				'singular_name'				=> sprintf( _x( '%s Speaker', 'taxonomy singular name', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
				'search_items' 				=> _x( 'Search Speakers', 'multimedia', 'risen' ),
				'popular_items' 			=> _x( 'Popular Speakers', 'multimedia', 'risen' ),
				'all_items' 				=> _x( 'All Speakers', 'multimedia', 'risen' ),
				'parent_item' 				=> null,
				'parent_item_colon' 		=> null,
				'edit_item' 				=> _x( 'Edit Speaker', 'multimedia', 'risen' ),
				'update_item' 				=> _x( 'Update Speaker', 'multimedia', 'risen' ),
				'add_new_item' 				=> _x( 'Add Speaker', 'multimedia', 'risen' ),
				'new_item_name' 			=> _x( 'New Speaker', 'multimedia', 'risen' ),
				'separate_items_with_commas' => _x( 'Separate speakers with commas', 'multimedia', 'risen' ),
				'add_or_remove_items' 		=> _x( 'Add or remove speakers', 'multimedia', 'risen' ),
				'choose_from_most_used' 	=> _x( 'Choose from the most used speakers', 'multimedia', 'risen' ),
				'menu_name' 				=> _x( 'Speakers', 'multimedia menu name', 'risen' )
			),
			'hierarchical'			=> true, // category-style instead of tag-style
			'public' 				=> true,
			'rewrite' 				=> array(
										'slug' => 'multimedia-speaker',
										'with_front' => false,
										'hierarchical' => true
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

function risen_multimedia_meta_boxes_setup() {

	// This post type only
	$screen = get_current_screen();
	if ( 'risen_multimedia' == $screen->post_type ) {

		// Add Meta Boxes
		add_action( 'add_meta_boxes', 'risen_multimedia_meta_boxes_add' );

		// Save Meta Boxes
		add_action( 'save_post', 'risen_multimedia_meta_boxes_save', 10, 2 );

	}

}

/**
 * Add Meta Boxes
 */

function risen_multimedia_meta_boxes_add() {

	// Media Files
	add_meta_box(
		'risen_multimedia_options',					// Unique meta box ID
		__( 'Media', 'risen' ),				// Title of meta box
		'risen_multimedia_options_meta_box_html',	// Callback function to output HTML
		'risen_multimedia',							// Post Type
		'normal',									// Context - Where the meta box appear: normal (left above standard meta boxes), advanced (left below standard boxes), side
		'high'										// Priority - high, core, default or low (see this: http://www.wproots.com/ultimate-guide-to-meta-boxes-in-wordpress/)
	);

}

/**
 * Save Meta Boxes
 */

function risen_multimedia_meta_boxes_save( $post_id, $post ) {

	// Media Files
	$meta_box_id = 'risen_multimedia_options';
	$meta_keys = array( // fields to validate and save
		'_risen_multimedia_video_url',
		'_risen_multimedia_audio_url',
		'_risen_multimedia_pdf_url',
		'_risen_multimedia_text'
	);
	risen_meta_box_save( $meta_box_id, $meta_keys, $post_id, $post );

}

/**
 * Media Files Meta Box HTML
 */

function risen_multimedia_options_meta_box_html( $object, $box ) {

	?>

	<?php
	$nonce_params = risen_meta_box_nonce_params( $box['id'] );
	wp_nonce_field( $nonce_params['action'], $nonce_params['key'] );
	?>

	<?php $meta_key = '_risen_multimedia_video_url'; ?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'Video URL <span>(Optional)</span>', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
			<p class="description">
				<?php _e( 'Enter a YouTube or Vimeo video page URL. Examples:', 'risen' ); ?>
				<br />
				<br />http://www.youtube.com/watch?v=mmRPSoDrrFU
				<br />http://vimeo.com/28323716
			</p>
		</div>
	</p>

	<?php $meta_key = '_risen_multimedia_audio_url'; ?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'MP3 Audio File <span>(Optional)</span>', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
			<input type="button" value="<?php _e( 'Upload MP3', 'risen' ); ?>" class="upload_button button risen-upload-file" />
			<p class="description">
				<?php _e( 'Upload or provide the URL to an audio file in MP3 format. <b>File too big?</b> Refer to the documentation for help.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php $meta_key = '_risen_multimedia_pdf_url'; ?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'PDF File <span>(Optional)</span>', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<input type="text" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( get_post_meta( $object->ID, $meta_key, true ) ); ?>" size="30" />
			<input type="button" value="<?php _e( 'Upload PDF', 'risen' ); ?>" class="upload_button button risen-upload-file" />
			<p class="description">
				<?php _e( 'Upload or provide the URL to a PDF file.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php $meta_key = '_risen_multimedia_text'; ?>
	<p>
		<div class="risen-meta-name">
			<label for="<?php echo $meta_key; ?>"><?php _e( 'Show "Text" Icon', 'risen' ); ?></label>
		</div>
		<div class="risen-meta-value">
			<input type="checkbox" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="1"<?php if ( get_post_meta( $object->ID, $meta_key, true ) ) : ?> checked="checked"<?php endif; ?> />
			<?php _e( 'Show the "Text" Icon', 'risen' ); ?>
			<p class="description">
				<?php _e( 'If you provide a complete transcript in the content box above then you can check this box to cause a "Text" icon to show.', 'risen' ); ?>
			</p>
		</div>
	</p>

	<?php

}

/**********************************
 * ADMIN COLUMNS
 **********************************/

/**
 * Add/remove multimedia list columns
 * Add speaker, media, categories
 */

function risen_multimedia_columns( $columns ) {

	// insert media types, speakers, categories after title
	$insert_array = array(
		'risen_multimedia_types' => __( 'Media Types', 'risen' ),
		'risen_multimedia_speakers' => _x( 'Speakers', 'people', 'risen' ),
		'risen_multimedia_categories' => __( 'Categories', 'risen' )
	);
	$columns = risen_array_merge_after_key( $columns, $insert_array, 'title' );

	// remove author
	unset( $columns['author'] );

	return $columns;

}

/**
 * Change multimedia list column content
 * Add content to new columns
 */

function risen_multimedia_columns_content( $column ) {

	global $post;

	switch ( $column ) {

		// Media Types
		case 'risen_multimedia_types' :

			$media_types = array();

			if ( get_post_meta( $post->ID , '_risen_multimedia_video_url' , true ) ) {
				$media_types[] = _x( 'Video', 'media type', 'risen' );
			}

			if ( get_post_meta( $post->ID , '_risen_multimedia_audio_url' , true ) ) {
				$media_types[] = _x( 'Audio', 'media type', 'risen' );
			}

			if ( get_post_meta( $post->ID , '_risen_multimedia_pdf_url' , true ) ) {
				$media_types[] = _x( 'PDF', 'media type', 'risen' );
			}

			if ( get_post_meta( $post->ID , '_risen_multimedia_text' , true ) ) {
				$media_types[] = _x( 'Text', 'media type', 'risen' );
			}

			echo implode( ', ', $media_types );

			break;

		// Speakers
		case 'risen_multimedia_speakers' :

			// Get speakers and output a list
			$speakers = get_the_terms( $post->ID, 'risen_multimedia_speaker' );
			if ( $speakers && ! is_wp_error( $speakers ) ) {

				$speakers_array = array();

				foreach ( $speakers as $speaker ) {
					$speakers_array[] = $speaker->name;
				}

				echo implode( ', ', $speakers_array );

			}

			break;

		// Categories
		case 'risen_multimedia_categories' :

			// Get categories and output a list
			$categories = get_the_terms( $post->ID, 'risen_multimedia_category' );
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
 * ARCHIVES (Dates, Categories, Tags, Speakers)
 **********************************/

/**
 * Enable date archives for multimedia posts
 * At time of making, WordPress (3.3 and possibly later) does not support dated archives for custom post types as it does for standard posts
 * This injects rules so that URL's like /cpt/2012/05 can be used with the custom post type archive template
 * Refer to includes/posts.php:risen_cpt_date_archive_setup() for full details
 */

function risen_multimedia_date_archive( $wp_rewrite ) {

	// Post types to setup date archives for
	$post_types = array(
		'risen_multimedia'
	);

	// Do it
	risen_cpt_date_archive_setup( $post_types, $wp_rewrite );

}

/**
 * Filter the posts per page value for multimedia archives (dates, categories, tags, speakers)
 * This solves an issue with pagination not working correctly for custom post type archives and taxonomy templates
 * The solution is thanks to Justin Carroll in the fourth post here: http://wordpress.org/support/topic/custom-post-type-taxonomy-pagination
 */

function risen_multimedia_archive_posts_per_page( $value ) {

	// Don't let this mess with saving of default posts per page in admin
	if ( ! is_admin() ) {

		// Which post type archives should this affect?
		$post_type_slugs = array( 'risen_multimedia' );

		// Which taxonomies should this affect?
		$taxonomies = array( 'risen_multimedia_category', 'risen_multimedia_tag', 'risen_multimedia_speaker' );

		// Use the multimedia items per page value from Theme Options if there is a match
		if ( is_post_type_archive( $post_type_slugs ) || is_tax( $taxonomies ) ) {
			return risen_option( 'multimedia_per_page' ) ? risen_option( 'multimedia_per_page' ) : risen_option_default( 'multimedia_per_page' );
		}

	}

	// Otherwise let it behave normally
	return $value;

}

/**********************************
 * PODCASTING ENCLOSURE
 **********************************/

/**
 * Save enclosure for sermon podcasting
 *
 * When audio URL is provided, save its data to the 'enclosure' field.
 * WordPress automatically uses this data to make feeds useful for podcasting.
 *
 * @since 2.0
 * @param int $post_id ID of post being saved
 * @param object $post Post object being saved
 */
function risen_multimedia_save_audio_enclosure( $post_id, $post ) {

	// Stop if no post, auto-save (meta not submitted) or user lacks permission
	$post_type = get_post_type_object( $post->post_type );
	if ( empty( $_POST ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return false;
	}

	// Stop if PowerPress plugin is active
	// Solves conflict regarding enclosure field: http://wordpress.org/support/topic/breaks-blubrry-powerpress-plugin
	if ( defined( 'POWERPRESS_VERSION' ) ) {
		return false;
	}

	// Get audio URL
	$audio = risen_multimedia_url( $post_id, 'audio' );

	// Populate enclosure field with URL, length and format, if valid URL found
	do_enclose( $audio, $post_id );

}

add_action( 'save_post', 'risen_multimedia_save_audio_enclosure', 11, 2 ); // after 'save_post' saves meta fields on 10

/**********************************
 * CONTENT OUTPUT
 **********************************/

/*
 * Output featured image for multimedia archives or single post
 * If single post, uses featured image for that post
 * If no featured image or if is archive, uses featured image from page using Multimedia template
 */

if ( ! function_exists( 'risen_multimedia_header_image' ) ) {

	function risen_multimedia_header_image( $return = false ) {

		global $post;

		$use_template_image = false;

		// Single post
		if ( is_singular( 'risen_multimedia' ) ) {

			// Has its own featured image
			if ( ! empty( $post->ID ) && has_post_thumbnail() ) {
				$use_post_id = $post->ID;
			}

			// Use image from Multimedia template if Theme Options allows
			else if ( risen_option( 'multimedia_header_image_single' ) ) {
				$use_template_image = true;
			}

		}

		// Archive
		else if ( risen_option( 'multimedia_header_image_archives' ) ) {
			$use_template_image = true;
		}

		// Image from Multimedia template
		if ( $use_template_image ) {

			// get (newest) page using Multimedia template
			$page = risen_get_page_by_template( 'tpl-multimedia.php' );

			// show featured image from that page
			if ( ! empty( $page->ID ) ) {
				$use_post_id = $page->ID;
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
 * Recent Multimedia
 */

if ( ! class_exists( 'Risen_Multimedia_Widget' ) ) {

	class Risen_Multimedia_Widget extends WP_Widget {

		// Register widget with WordPress
		public function __construct() {

			parent::__construct(
				'risen-multimedia',
				sprintf( _x( 'Recent %s', 'multimedia widget', 'risen' ), risen_option( 'multimedia_word_plural' ) ),
				array(
					'description' => sprintf( _x( 'This widget shows recent %s items.', 'multimedia widget', 'risen' ), strtolower( risen_option( 'multimedia_word_singular' ) ) )
				)
			);

		}

		// Back-end widget form
		public function form( $instance ) {

			// Set defaults
			$instance = wp_parse_args( (array) $instance, array(
				'title' => sprintf( _x( 'Recent %s', 'multimedia widget', 'risen' ), risen_option( 'multimedia_word_plural' ) ),
				'limit' => '5', // also change in update(),
				'speaker' => '1',
				'date' => '1',
				'icons' => '1',
				'excerpt' => ''
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

				<?php $field = 'speaker'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show speaker', 'risen' ); ?>
				</label>

				<br />

				<?php $field = 'date'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show date', 'risen' ); ?>
				</label>

				<br />

				<?php $field = 'icons'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show media icons', 'risen' ); ?>
				</label>

				<br />

				<?php $field = 'excerpt'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show excerpt', 'risen' ); ?>
				</label>

				<br />

				<?php $field = 'image'; ?>
				<label for="<?php echo $this->get_field_id( $field ); ?>">
					<input type="checkbox" value="1" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>"<?php if ( ! empty( $instance[$field] ) ) : ?> checked="checked"<?php endif; ?> />
					<?php _e( 'Show image (homepage only)', 'risen' ); ?>
				</label>

			</p>

			<?php

		}

		// Sanitize widget form values as they are saved
		public function update( $new_instance, $old_instance ) {

			$instance = array();

			$instance['title'] = trim( strip_tags( $new_instance['title'] ) );
			$instance['limit'] = isset( $new_instance['limit'] ) && (int) $new_instance['limit'] > 0 ? (int) $new_instance['limit'] : 5; // default if not positive number
			$instance['speaker'] = ! empty( $new_instance['speaker'] ) ? '1' : '';
			$instance['date'] = ! empty( $new_instance['date'] ) ? '1' : '';
			$instance['icons'] = ! empty( $new_instance['icons'] ) ? '1' : '';
			$instance['excerpt'] = ! empty( $new_instance['excerpt'] ) ? '1' : '';
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
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			// Get Posts
			$posts = get_posts( array(
				'numberposts'     	=> $instance['limit'],
				'orderby'         	=> 'post_date', // newest first
				'order'           	=> 'DESC',
				'post_type'       	=> 'risen_multimedia',
				'suppress_filters'	=> false // help multilingual
			) );

			// Loop Posts
			$i = 0;
			foreach( $posts as $post ) : setup_postdata( $post ); $i++;
			?>

			<article class="multimedia-widget-item<?php if ( 1 == $i ) : ?> multimedia-widget-item-first<?php endif; ?>">

				<?php if ( is_home() && ! empty( $instance['image'] ) && has_post_thumbnail() ) : ?>
				<div class="image-frame multimedia-widget-item-thumb widget-thumb">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'risen-tiny-thumb', array( 'title' => '' ) ); ?></a>
				</div>
				<?php endif; ?>

				<header>

					<h1 class="multimedia-widget-item-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

					<?php
					/* translators: used between list items, there is a space after the comma */
					$speaker_list = get_the_term_list( $post->ID, 'risen_multimedia_speaker', '', __( ', ', 'risen' ) );
					if ( ! empty( $speaker_list ) && ! empty( $instance['speaker'] ) ) :
					?>
					<div class="multimedia-widget-item-speaker"><?php echo sprintf( _x( 'by %s', 'multimedia speaker', 'risen'), $speaker_list ); ?></div>
					<?php endif; ?>

					<div>

						<?php if ( ! empty( $instance['date'] ) ) : ?>
						<time class="multimedia-widget-item-date" datetime="<?php the_time( 'c' ); ?>"><?php echo risen_date_ago( get_the_time( 'U' ), 5 ); // show up to "5 days ago" but actual date if older ?></time>
						<?php endif; ?>

						<?php if ( ! empty( $instance['icons'] ) ) : ?>
						<ul class="multimedia-widget-item-icons risen-icon-list">

							<?php if ( risen_multimedia_url( $post->ID, 'video' ) ) : ?>
							<li><a href="<?php echo esc_url( add_query_arg( 'player', 'video', get_permalink() ) ); ?>" class="single-icon video-icon" title="<?php esc_attr_e( 'Video', 'risen' ); ?>"><?php _e( 'Video', 'risen' ); ?></a></li>
							<?php endif; ?>

							<?php if ( risen_multimedia_url( $post->ID, 'audio' ) ) : ?>
							<li><a href="<?php echo esc_url( add_query_arg( 'player', 'audio', get_permalink() ) ); ?>" class="single-icon audio-icon" title="<?php esc_attr_e( 'Audio', 'risen' ); ?>"><?php _e( 'Audio', 'risen' ); ?></a></li>
							<?php endif; ?>

							<?php if ( get_post_meta( $post->ID, '_risen_multimedia_text', true ) ) : ?>
							<li><a href="<?php the_permalink(); ?>" class="single-icon text-icon" title="<?php esc_attr_e( 'Read Online', 'risen' ); ?>"><?php _e( 'Read Online', 'risen' ); ?></a></li>
							<?php endif; ?>

							<?php if ( $pdf_url = risen_multimedia_url( $post->ID, 'pdf' ) ) : ?>
							<li><a href="<?php echo esc_url( risen_force_download_url( $pdf_url ) ); ?>" class="single-icon pdf-icon" title="<?php esc_attr_e( 'Download PDF', 'risen' ); ?>"><?php _e( 'Download PDF', 'risen' ); ?></a></li>
							<?php endif; ?>

						</ul>
						<?php endif; ?>

					</div>

				</header>

				<?php if ( get_the_excerpt() && ! empty( $instance['excerpt'] )): ?>
				<div class="multimedia-widget-item-excerpt">
					<?php the_excerpt(); ?>
				</div>
				<?php endif; ?>

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

/**
 * Multimedia Archives Widget
 *
 * This is based on WordPress wp_get_archives() but modified to allow for post type
 */

if ( ! class_exists( 'Risen_Multimedia_Archives_Widget' ) ) {

	class Risen_Multimedia_Archives_Widget extends WP_Widget {

		// Register widget with WordPress
		public function __construct() {

			parent::__construct(
				'risen-multimedia-archives',
				sprintf( _x( '%s Archives', 'multimedia archive widget', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
				array(
					'description' => sprintf( _x( 'Monthly %s archive links.', 'multimedia archive widget', 'risen' ), strtolower( risen_option( 'multimedia_word_singular' ) ) )
				)
			);

		}

		// Back-end widget form
		function form( $instance ) {

			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 0, 'dropdown' => 0 ) );

			$title = strip_tags( $instance['title'] );
			$count = $instance['count'] ? 'checked="checked"' : '';
			$dropdown = $instance['dropdown'] ? 'checked="checked"' : '';

			?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _ex( 'Title:', 'multimedia archive widget', 'risen'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>

				<input class="checkbox" type="checkbox" <?php echo $dropdown; ?> id="<?php echo $this->get_field_id( 'dropdown' ); ?>" name="<?php echo $this->get_field_name( 'dropdown' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'dropdown' ); ?>"><?php _ex( 'Display as dropdown', 'multimedia archive widget', 'risen' ); ?></label>

				<br />

				<input class="checkbox" type="checkbox" <?php echo $count; ?> id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _ex( 'Show post counts', 'multimedia archive widget', 'risen' ); ?></label>

			</p>

			<?php

		}

		// Sanitize widget form values as they are saved
		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'count' => 0, 'dropdown' => 0 ) );

			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['count'] = ! empty( $new_instance['count'] ) ? '1' : 0;
			$instance['dropdown'] = ! empty( $new_instance['dropdown'] ) ? '1' : 0;

			return $instance;

		}

		// Front-end display of widget
		function widget( $args, $instance ) {

			global $wpdb, $wp_locale;

			// HTML Before
			echo $args['before_widget'];

			// Title
			$title = empty( $instance['title'] ) ? sprintf( _x( '%s Archives', 'multimedia archive widget', 'risen' ), risen_option( 'multimedia_word_singular' ) ) : $instance['title'];
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			// Get archive months for post type
			$post_type = 'risen_multimedia';
			$results = (array) $wpdb->get_results( $wpdb->prepare(
				"
					SELECT
						YEAR(post_date) AS `year`,
						MONTH(post_date) AS `month`,
						count(ID) as posts
					FROM $wpdb->posts
					WHERE
						post_type = %s
						AND post_status = 'publish'
					GROUP BY
						YEAR(post_date),
						MONTH(post_date)
					ORDER BY post_date DESC
				",
				array(
					$post_type
				)
			) );

			// Output links
			if ( $results ) {

				// Get post type so have rewrite slug available for URL
				$pt_obj = get_post_type_object( $post_type );
				$slug = $pt_obj->rewrite['slug'];

				// Loop months
				$items = '';
				foreach ( (array) $results as $result ) {

					// Build URL
					$url = home_url( '/' . $slug . '/' . $result->year . '/' . str_pad( $result->month, 2, '0', STR_PAD_LEFT ) . '/' );

					// Format of link text
					/* translators: 1: month name, 2: 4-digit year */
					$text = sprintf( _x('%1$s %2$d', 'multimedia archive widget', 'risen'), $wp_locale->get_month( $result->month ), $result->year );

					// Show count after link?
					$after = '';
					if ( ! empty( $instance['count'] ) ) { // show count
						$after = '&nbsp;(' . $result->posts . ')';
					}

					// Month item
					$format = 'html'; // list link
					if ( ! empty( $instance['dropdown'] ) ) {
						$format = 'option'; // dropdown option
					}
					$items .= get_archives_link( $url, $text, $format, '', $after );

				}

				// Show as dropdown
				if ( ! empty( $instance['dropdown'] ) ) {
					echo '<form>';
					echo '	<select onchange="document.location.href=this.options[this.selectedIndex].value;">';
					echo '		<option value="">' . _x( 'Select Month', 'multimedia archive widget', 'risen' ) . '</option>';
					echo $items;
					echo '	</select>';
					echo '</form>';
				}

				// Show as list
				else {
					echo '<ul>';
					echo $items;
					echo '</ul>';
				}

			}

			// HTML After
			echo $args['after_widget'];

		}

	}

}

/**********************************
 * DATA
 **********************************/

/**
 * Get URL of MP3, PDF, etc. and return with [upload_url] replaced
 * (useful for imported sample content)
 */

if ( ! function_exists( 'risen_multimedia_url' ) ) {

	function risen_multimedia_url( $post_id, $media_type ) { // audio, video or pdf

		// Validate type
		$media_types = array( 'audio', 'video', 'pdf' );
		if ( ! in_array( $media_type, $media_types ) ) {
			return false;
		}

		// Get it
		$url = get_post_meta( $post_id, '_risen_multimedia_' . $media_type . '_url', true );

		// Replace [upload_url]
		$upload_dir = wp_upload_dir();
		$url = str_ireplace( '[upload_url]', $upload_dir['baseurl'], $url );

		return $url;

	}

}