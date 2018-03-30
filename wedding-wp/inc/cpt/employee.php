<?php




// function: FAQ CPT
function employee_post_type()
{
	// Create The Labels (Output) For The Post Type
	$labels = 
	array(
		// The plural form of the name of your post type.
		'name' => __( 'Employee',WEBNUS_TEXT_DOMAIN), 
		
		// The singular form of the name of your post type.
		'singular_name' => __('employee',WEBNUS_TEXT_DOMAIN),
		
		
		
		// The menu item for adding a new post.
		'add_new' => _x('Add Item', 'faq',WEBNUS_TEXT_DOMAIN), 
		
		// The header shown when editing a post.
		'edit_item' => __('Edit Employee',WEBNUS_TEXT_DOMAIN),
		
		// Shown in the favourites menu in the admin header.
		'new_item' => __('New Employee',WEBNUS_TEXT_DOMAIN), 
		
		// Shown alongside the permalink on the edit post screen.
		'view_item' => __('View Employee',WEBNUS_TEXT_DOMAIN),
		
		// Button text for the search box on the edit posts screen.
		'search_items' => __('Search Employee',WEBNUS_TEXT_DOMAIN), 
		
		// Text to display when no posts are found through search in the admin.
		'not_found' =>  __('No Employee Found',WEBNUS_TEXT_DOMAIN),
		
		// Text to display when no posts are in the trash.
		'not_found_in_trash' => __('No Employee Items Found In Trash',WEBNUS_TEXT_DOMAIN),
		 
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
		'menu_position' => 202, 
		
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
				'slug' => __( 'employee' ,WEBNUS_TEXT_DOMAIN) 
			),
	);
	
	// Register The Post Type
	register_post_type(__( 'employee' ,WEBNUS_TEXT_DOMAIN),$args);
	
	
} // function: post_type END


// function: portfolio_messages BEGIN
function employee_messages($messages)
{
global $post, $post_id;
	$messages[__( 'employee' )] = 
		array(
			// Unused. Messages start at index 1
			0 => '',
			
			// Change the message once updated
			1 => sprintf(__('Employee Updated. <a href="%s">View FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url(get_permalink($post_id))),
			
			// Change the message if custom field has been updated
			2 => __('Custom Field Updated.',WEBNUS_TEXT_DOMAIN),
			
			// Change the message if custom field has been deleted
			3 => __('Custom Field Deleted.',WEBNUS_TEXT_DOMAIN),
			
			// Change the message once portfolio been updated
			4 => __('Employee Updated.',WEBNUS_TEXT_DOMAIN),
			
			// Change the message during revisions
			5 => isset($_GET['revision']) ? sprintf( __('Employee Restored To Revision From %s',WEBNUS_TEXT_DOMAIN), wp_post_revision_title((int)$_GET['revision'],false)) : false,
			
			// Change the message once published
			6 => sprintf(__('Employee Published. <a href="%s">View FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url(get_permalink($post_id))),
			
			// Change the message when saved
			7 => __('Employee Saved.',WEBNUS_TEXT_DOMAIN),
			
			// Change the message when submitted item
			8 => sprintf(__('Employee Submitted. <a target="_blank" href="%s">Preview FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url( add_query_arg('preview','true',get_permalink($post_id)))),
			
			// Change the message when a scheduled preview has been made
			9 => sprintf(__('Employee Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>',WEBNUS_TEXT_DOMAIN),date_i18n( __( 'M j, Y @ G:i' ,WEBNUS_TEXT_DOMAIN),strtotime($post->post_date)), esc_url(get_permalink($post_id))),
			
			// Change the message when draft has been made
			10 => sprintf(__('Employee Draft Updated. <a target="_blank" href="%s">Preview FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url( add_query_arg('preview','true',get_permalink($post_id)))),
		);
	return $messages;	
	
} // function: portfolio_messages END

// function: portfolio_filter BEGIN



add_action('init', 'employee_post_type');
//add_action( 'init', 'faq_filter', 0 );
add_filter('post_updated_messages', 'employee_messages');




function change_default_title( $title ){
     $screen = get_current_screen();
 
     if  ( 'employee' == $screen->post_type ) {
          $title = __('Enter Employee name','WEBNUS_TEXT_DOMAIN');
     }
 
     return $title;
}
 
add_filter( 'enter_title_here', 'change_default_title' )

?>