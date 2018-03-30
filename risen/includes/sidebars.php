<?php
/**
 * Sidebar Functions
 *
 * Register sidebars
 */

/**********************************
 * REGISTER SIDEBARS
 **********************************/

function risen_register_sidebars() {

	// Blog
	register_sidebar( array(	
		'id'			=> 'blog',
		'name'			=> __( 'Blog Sidebar', 'risen' ),
		'description' 	=> __( 'These widgets show on the side of blog content.', 'risen' ),
		'before_widget'	=> '<aside id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title' 	=> '<h1 class="sidebar-widget-title">',
		'after_title' 	=> '</h1>'
	) );
	
	// Primary (Pages)
	register_sidebar( array(
		'id'			=> 'primary',
		'name'			=> __( 'Page Sidebar', 'risen' ),
		'description' 	=> sprintf( __( 'These widgets show on the side of regular pages set to show widgets.', 'risen' ), strtolower( risen_option( 'multimedia_word_singular' ) ) ),
		'before_widget'	=> '<aside id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title' 	=> '<h1 class="sidebar-widget-title">',
		'after_title' 	=> '</h1>'
	) );
	
	// Home Column Left
	register_sidebar( array(	
		'id'			=> 'home-column-left',
		'name'			=> __( 'Home Bottom Left', 'risen' ),
		'description' 	=> __( 'These show in a left-hand column at the bottom of the homepage.', 'risen' ),
		'before_widget'	=> '<section id="%1$s" class="widget content-widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title' 	=> '<header><h1 class="home-column-widgets-title">',
		'after_title' 	=> '</h1></header>'
	) );
	
	// Home Column Right
	register_sidebar( array(	
		'id'			=> 'home-column-right',
		'name'			=> __( 'Home Bottom Right', 'risen' ),
		'description' 	=> __( 'These show in a right-hand column at the bottom of the homepage.', 'risen' ),
		'before_widget'	=> '<section id="%1$s" class="widget content-widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title' 	=> '<header><h1 class="home-column-widgets-title">',
		'after_title' 	=> '</h1></header>'
	) );

	// Multimedia
	register_sidebar(array(
		'id'			=> 'multimedia',
		'name'			=> sprintf( __( '%s Sidebar', 'risen' ), risen_option( 'multimedia_word_singular' ) ),
		'description' 	=> sprintf( __( 'These widgets show on the side of %s pages.', 'risen' ), strtolower( risen_option( 'multimedia_word_singular' ) ) ),
		'before_widget'	=> '<aside id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title' 	=> '<h1 class="sidebar-widget-title">',
		'after_title' 	=> '</h1>'
	));
	
	// Gallery
	register_sidebar(array(
		'id'			=> 'gallery',
		'name'			=> __( 'Gallery Sidebar', 'risen' ),
		'description' 	=> __( 'These widgets show on the side of gallery pages.', 'risen' ),
		'before_widget'	=> '<aside id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title' 	=> '<h1 class="sidebar-widget-title">',
		'after_title' 	=> '</h1>'
	));
	
	// Events
	register_sidebar(array(
		'id'			=> 'events',
		'name'			=> __( 'Events Sidebar', 'risen' ),
		'description' 	=> __( 'These widgets show on the side of event pages.', 'risen' ),
		'before_widget'	=> '<aside id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title' 	=> '<h1 class="sidebar-widget-title">',
		'after_title' 	=> '</h1>'
	));

	// Staff
	register_sidebar(array(
		'id'			=> 'staff',
		'name'			=> __( 'Staff Sidebar', 'risen' ),
		'description' 	=> __( 'These widgets show on the side of staff pages.', 'risen' ),
		'before_widget'	=> '<aside id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title' 	=> '<h1 class="sidebar-widget-title">',
		'after_title' 	=> '</h1>'
	));
	
	// Locations
	register_sidebar( array(	
		'id'			=> 'locations',
		'name'			=> __( 'Locations Sidebar', 'risen' ),
		'description' 	=> __( 'These widgets show on the side of locations content.', 'risen' ),
		'before_widget'	=> '<aside id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title' 	=> '<h1 class="sidebar-widget-title">',
		'after_title' 	=> '</h1>'
	) );
	
	// Contact
	register_sidebar( array(	
		'id'			=> 'contact',
		'name'			=> __( 'Contact Sidebar', 'risen' ),
		'description' 	=> __( 'These widgets show on the side of the contact page.', 'risen' ),
		'before_widget'	=> '<aside id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title' 	=> '<h1 class="sidebar-widget-title">',
		'after_title' 	=> '</h1>'
	) );
	
	// Search
	register_sidebar( array(	
		'id'			=> 'search',
		'name'			=> __( 'Search Sidebar', 'risen' ),
		'description' 	=> __( 'These widgets show on the side of search pages.', 'risen' ),
		'before_widget'	=> '<aside id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title' 	=> '<h1 class="sidebar-widget-title">',
		'after_title' 	=> '</h1>'
	) );

}

/**********************************
 * META BOXES
 **********************************/

/**
 * Post types that wil have a Sidebar meta box
 */

if ( ! function_exists( 'sidebar_post_types' ) ) {

	function risen_sidebar_meta_box_post_types() {

		$post_types = array(
			'page'				=> array( 'default' => '' ), // default is value preset when adding an item
			'post'				=> array( 'default' => 'right' ),
			'risen_multimedia'	=> array( 'default' => 'right' ),
			'risen_gallery'		=> array( 'default' => '' ),
			'risen_event'		=> array( 'default' => 'right' )
		);
		
		$post_types = apply_filters( 'risen_sidebar_meta_box_post_types', $post_types );
		
		return $post_types;
	
	}

}
	
/**
 * Setup Meta Boxes
 */
 
function risen_sidebar_meta_box_setup() {

	// This post type only
	$post_types = risen_sidebar_meta_box_post_types();
	$screen = get_current_screen();
	if ( isset( $post_types[$screen->post_type] ) ) {

		// Add Meta Boxes
		add_action( 'add_meta_boxes', 'risen_sidebar_meta_box_add' );

		// Save Meta Boxes
		add_action( 'save_post', 'risen_sidebar_meta_box_save', 10, 2 );

	}
	
}

/**
 * Add Meta Boxes
 */
 
function risen_sidebar_meta_box_add() {

	$post_types = risen_sidebar_meta_box_post_types();
	
	foreach( $post_types as $post_type => $options ) {
		
		add_meta_box(
			'risen_sidebar',						// Unique meta box ID
			__( 'Sidebar', 'risen' ),				// Title of meta box
			'risen_sidebar_meta_box_html',			// Callback function to output HTML
			$post_type,								// Post Type
			'side',									// Context - Where the meta box appear: normal (left above standard meta box), advanced (left below standard box), side
			'low'									// Priority - high, core, default or low (see this: http://www.wproots.com/ultimate-guide-to-meta-box-in-wordpress/)
		);
		
	}

}

/**
 * Save Meta Boxes
 */

function risen_sidebar_meta_box_save( $post_id, $post ) {

	// Media Files
	$meta_box_id = 'risen_sidebar';
	$meta_keys = array( // fields to validate and save
		'_risen_sidebar'
	);
	risen_meta_box_save( $meta_box_id, $meta_keys, $post_id, $post );

}

/**
 * Media Files Meta Box HTML
 */

function risen_sidebar_meta_box_html( $object, $box ) {

	$screen = get_current_screen();
	$post_types = risen_sidebar_meta_box_post_types();
	
	// security
	$nonce_params = risen_meta_box_nonce_params( $box['id'] );
	wp_nonce_field( $nonce_params['action'], $nonce_params['key'] );
	
	?>
	
	<?php
	$meta_key = '_risen_sidebar';
	$value = get_post_meta( $object->ID, $meta_key, true ); // saved value
	if ( 'post' == $screen->base && 'add' == $screen->action && isset( $post_types[$screen->post_type]['default'] ) ) { // if this is first add, use a default value
		$value = $post_types[$screen->post_type]['default'];
	}
	?>
	<p>
		<label for="<?php echo $meta_key; ?>">
			<input type="checkbox" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="right"<?php echo $value == 'right' ? ' checked="checked"' : ''; ?> />
			<?php printf( __( 'Show sidebar <a href="%s" target="_blank">widgets</a>', 'risen' ), admin_url( 'widgets.php' ) ); ?>
		</label>
	</p>

	<?php

}

/**********************************
 * CONTENT OUTPUT
 **********************************/

/**
 * Check if sidebar is enabled
 * This is not for Homepage "sidebars"
 */

if ( ! function_exists( 'risen_sidebar_enabled' ) ) {
	 
	function risen_sidebar_enabled( $sidebar, $post_id = false, $required_option = false ) {

		global $post;
		
		// Is a certain option set?
		if ( empty( $required_option ) || risen_option( $required_option ) ) {
		
			// Auto detect post/page ID if not given
			$post_id = ! empty ( $post_id ) ? $post_id : ( ! empty( $post->ID ) ? $post->ID : '' );

			// Post or page has sidebar enabled and it has widgets
			if ( ! empty( $post_id ) && is_active_sidebar( $sidebar ) && get_post_meta( $post_id, '_risen_sidebar', true ) ) {
				return true;
			}
			
		}
		
		return false;

	}
	
}

/**
 * Show sidebar if enabled
 * This is not for Homepage "sidebars"
 */
 
if ( ! function_exists( 'risen_show_sidebar' ) ) {
	 
	function risen_show_sidebar( $sidebar, $post_id = false, $required_option = false ) { // post or page has it enabled and it has widgets

		// Post or page has sidebar enabled and it has widgets?
		if ( risen_sidebar_enabled( $sidebar, $post_id, $required_option ) ) {
			get_sidebar( $sidebar );
		}
		
	}
	
}
