<?php




// function: FAQ CPT
function faq_post_type()
{
	// Create The Labels (Output) For The Post Type
	$labels = 
	array(
		// The plural form of the name of your post type.
		'name' => __( 'FAQ',WEBNUS_TEXT_DOMAIN), 
		
		// The singular form of the name of your post type.
		'singular_name' => __('FAQ',WEBNUS_TEXT_DOMAIN),
		
		
		
		// The menu item for adding a new post.
		'add_new' => _x('Add Item', 'faq',WEBNUS_TEXT_DOMAIN), 
		
		// The header shown when editing a post.
		'edit_item' => __('Edit FAQ Item',WEBNUS_TEXT_DOMAIN),
		
		// Shown in the favourites menu in the admin header.
		'new_item' => __('New FAQ Item',WEBNUS_TEXT_DOMAIN), 
		
		// Shown alongside the permalink on the edit post screen.
		'view_item' => __('View FAQ',WEBNUS_TEXT_DOMAIN),
		
		// Button text for the search box on the edit posts screen.
		'search_items' => __('Search FAQ',WEBNUS_TEXT_DOMAIN), 
		
		// Text to display when no posts are found through search in the admin.
		'not_found' =>  __('No FAQ Items Found',WEBNUS_TEXT_DOMAIN),
		
		// Text to display when no posts are in the trash.
		'not_found_in_trash' => __('No FAQ Items Found In Trash',WEBNUS_TEXT_DOMAIN),
		 
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
		'show_in_menu' => true,
		'menu_position' => 201, 
		
		// Allow the portfolio to support a Title, Editor, Thumbnail
		'supports' => 
			array(
				'title',
				'editor',
				'thumbnail'
			) ,
			'rewrite' => 
			array(
				// prepends our post type with this slug
				'slug' => __( 'faq' ,WEBNUS_TEXT_DOMAIN) 
			),
	);
	
	// Register The Post Type
	register_post_type(__( 'faq' ,WEBNUS_TEXT_DOMAIN),$args);
	
	
} // function: post_type END


// function: portfolio_messages BEGIN
function faq_messages($messages)
{
global $post, $post_id;
	$messages[__( 'faq' )] = 
		array(
			// Unused. Messages start at index 1
			0 => '',
			
			// Change the message once updated
			1 => sprintf(__('FAQ Updated. <a href="%s">View FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url(get_permalink($post_id))),
			
			// Change the message if custom field has been updated
			2 => __('Custom Field Updated.',WEBNUS_TEXT_DOMAIN),
			
			// Change the message if custom field has been deleted
			3 => __('Custom Field Deleted.',WEBNUS_TEXT_DOMAIN),
			
			// Change the message once portfolio been updated
			4 => __('FAQ Updated.',WEBNUS_TEXT_DOMAIN),
			
			// Change the message during revisions
			5 => isset($_GET['revision']) ? sprintf( __('FAQ Restored To Revision From %s',WEBNUS_TEXT_DOMAIN), wp_post_revision_title((int)$_GET['revision'],false)) : false,
			
			// Change the message once published
			6 => sprintf(__('FAQ Published. <a href="%s">View FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url(get_permalink($post_id))),
			
			// Change the message when saved
			7 => __('FAQ Saved.',WEBNUS_TEXT_DOMAIN),
			
			// Change the message when submitted item
			8 => sprintf(__('FAQ Submitted. <a target="_blank" href="%s">Preview FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url( add_query_arg('preview','true',get_permalink($post_id)))),
			
			// Change the message when a scheduled preview has been made
			9 => sprintf(__('FAQ Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>',WEBNUS_TEXT_DOMAIN),date_i18n( __( 'M j, Y @ G:i' ,WEBNUS_TEXT_DOMAIN),strtotime($post->post_date)), esc_url(get_permalink($post_id))),
			
			// Change the message when draft has been made
			10 => sprintf(__('FAQ Draft Updated. <a target="_blank" href="%s">Preview FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url( add_query_arg('preview','true',get_permalink($post_id)))),
		);
	return $messages;	
	
} // function: portfolio_messages END

// function: portfolio_filter BEGIN
function faq_filter()
{
	// Register the Taxonomy
	register_taxonomy(__( "filter" ,WEBNUS_TEXT_DOMAIN), 
	
	// Assign the taxonomy to be part of the portfolio post type
	array(__( "faq" ,WEBNUS_TEXT_DOMAIN)), 
	
	// Apply the settings for the taxonomy
	array(
		"hierarchical" => true, 
		"label" => __( "Categories" ,WEBNUS_TEXT_DOMAIN), 
		"singular_label" => __( "Categories" ,WEBNUS_TEXT_DOMAIN), 
		"rewrite" => array(
				'slug' => 'filter', 
				'hierarchical' => true
				)
		)
	); 
} // function: faq_filter END


add_action('init', 'faq_post_type');
//add_action( 'init', 'faq_filter', 0 );
add_filter('post_updated_messages', 'faq_messages');

?>