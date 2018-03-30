<?php

// function: post_type BEGIN
function post_type()
{
	// Create The Labels (Output) For The Post Type
	$labels = 
	array(
		// The plural form of the name of your post type.
		'name' => __( 'Portfolio', 'arapah_wp'), 
		
		// The singular form of the name of your post type.
		'singular_name' => __('Portfolio', 'arapah_wp'),
		
		// The rewrite of the post type
		'rewrite' => 
			array(
				// prepends our post type with this slug
				'slug' => __( 'portfolio', 'arapah_wp' ) 
			),
			
		// The menu item for adding a new post.
		'add_new' => _x('Add Item', 'portfolio', 'arapah_wp'), 
		
		// The header shown when editing a post.
		'edit_item' => __('Edit Portfolio Item', 'arapah_wp'),
		
		// Shown in the favourites menu in the admin header.
		'new_item' => __('New Portfolio Item', 'arapah_wp'), 
		
		// Shown alongside the permalink on the edit post screen.
		'view_item' => __('View Portfolio', 'arapah_wp'),
		
		// Button text for the search box on the edit posts screen.
		'search_items' => __('Search Portfolio', 'arapah_wp'), 
		
		// Text to display when no posts are found through search in the admin.
		'not_found' =>  __('No Portfolio Items Found', 'arapah_wp'),
		
		// Text to display when no posts are in the trash.
		'not_found_in_trash' => __('No Portfolio Items Found In Trash', 'arapah_wp'),
		 
		// Used as a label for a parent post on the edit posts screen. Only useful for hierarchical post types.
		'parent_item_colon' => '' 
	);
	
	// Set Up The Arguements
	$args = 
	array(
		// Pass The Array Of Labels
		'labels' => $labels, 
		
		// Display The Post Type To Admin
		'public' => true, 
		
		// Allow Post Type To Be Queried 
		'publicly_queryable' => true, 
		
		// Build a UI for the Post Type
		'show_ui' => true, 
		
		// Use String for Query Post Type
		'query_var' => true, 
		
		// Rewrite the slug
		'rewrite' => true, 
		
		// Set type to construct arguements
		'capability_type' => 'post', 
		
		// Disable Hierachical - No Parent
		'hierarchical' => false, 
		
		// Set Menu Position for where it displays in the navigation bar
		'menu_position' => null, 
		
		// Allow the portfolio to support a Title, Editor, Thumbnail
		'supports' => 
			array(
				'title',
				'editor',
				'thumbnail'
			) 
	);
	
	// Register The Post Type
	register_post_type(__( 'portfolio', 'arapah_wp' ),$args);
	
	
} // function: post_type END


// function: portfolio_messages BEGIN
function portfolio_messages($messages) {
	global $post, $post_ID;
	$messages[__( 'portfolio', 'arapah_wp' )] = 
		array(
			// Unused. Messages start at index 1
			0 => '',
			
			// Change the message once updated
			1 => sprintf(__('Portfolio Updated. <a href="%s">View portfolio</a>', 'arapah_wp'), esc_url(get_permalink($post_ID))),
			
			// Change the message if custom field has been updated
			2 => __('Custom Field Updated.', 'arapah_wp'),
			
			// Change the message if custom field has been deleted
			3 => __('Custom Field Deleted.', 'arapah_wp'),
			
			// Change the message once portfolio been updated
			4 => __('Portfolio Updated.', 'arapah_wp'),
			
			// Change the message during revisions
			5 => isset($_GET['revision']) ? sprintf( __('Portfolio Restored To Revision From %s', 'arapah_wp'), wp_post_revision_title((int)$_GET['revision'],false)) : false,
			
			// Change the message once published
			6 => sprintf(__('Portfolio Published. <a href="%s">View Portfolio</a>', 'arapah_wp'), esc_url(get_permalink($post_ID))),
			
			// Change the message when saved
			7 => __('Portfolio Saved.', 'arapah_wp'),
			
			// Change the message when submitted item
			8 => sprintf(__('Portfolio Submitted. <a target="_blank" href="%s">Preview Portfolio</a>', 'arapah_wp'), esc_url( add_query_arg('preview','true',get_permalink($post_ID)))),
			
			// Change the message when a scheduled preview has been made
			9 => sprintf(__('Portfolio Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio</a>', 'arapah_wp'),date_i18n( __( 'M j, Y @ G:i', 'arapah_wp' ),strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			
			// Change the message when draft has been made
			10 => sprintf(__('Portfolio Draft Updated. <a target="_blank" href="%s">Preview Portfolio</a>', 'arapah_wp'), esc_url( add_query_arg('preview','true',get_permalink($post_ID)))),
		);
	return $messages;	
	
} // function: portfolio_messages END

// function: portfolio_filter BEGIN
function portfolio_filter()
{
	// Register the Taxonomy
	register_taxonomy(__( "filter", "arapah_wp" ), 
	
	// Assign the taxonomy to be part of the portfolio post type
	array(__( "portfolio", 'arapah_wp' )), 
	
	// Apply the settings for the taxonomy
	array(
		"hierarchical" => true, 
		"label" => __( "Filter", 'arapah_wp' ), 
		"singular_label" => __( "Filter", 'arapah_wp' ), 
		"rewrite" => array(
				'slug' => 'filter', 
				'hierarchical' => true
				)
		)
	); 
} // function: portfolio_filter END


add_action('init', 'post_type');
add_action( 'init', 'portfolio_filter', 0 );
add_filter('post_updated_messages', 'portfolio_messages');



?>