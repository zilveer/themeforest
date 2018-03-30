<?php

/**
 * Custom types name
 */
define('TYPE_TESTIMONIALS', 'bl_testimonials');
define('TYPE_FAQ', 'bl_faq');  

add_action( 'init', 'yiw_register_post_types', 0  );
add_action( 'init', 'yiw_register_taxonomies', 0  );
add_action( 'admin_init', 'flush_rewrite_rules' );

if( isset( $_GET['post_type'] ) )
{
	switch( $_GET['post_type'] )
	{
		case TYPE_TESTIMONIALS :
			add_action( 'manage_posts_custom_column',  'yiw_bl_testimonials_custom_columns');
			add_filter( 'manage_edit-'.TYPE_TESTIMONIALS.'_columns', 'yiw_bl_testimonials_edit_columns');
		break;           
			
		case TYPE_FAQ :
			add_action( 'manage_posts_custom_column',  'yiw_bl_faq_custom_columns');
			add_filter( 'manage_edit-'.TYPE_FAQ.'_columns', 'yiw_bl_faq_edit_columns'); 
		break;
	}
}

/**
 * Register post types for the theme
 *
 * @return void
 */
function yiw_register_post_types(){
  
	register_post_type(         
        TYPE_TESTIMONIALS,
        array(
		  'description' => __('Testimonals', 'yiw'),
		  'exclude_from_search' => false,
		  'show_ui' => true,
		  'labels' => yiw_label(__('Testimonial', 'yiw'), __('Testimonials', 'yiw')),
		  'supports' => array( 'title', 'editor', 'thumbnail' ),
		  'public' => true,
		  'capability_type' => 'post',
    	  'publicly_queryable' => true,
		  'rewrite' => array( 'slug' => TYPE_TESTIMONIALS, 'with_front' => true )
        )
    );         
  
	register_post_type(         
        TYPE_FAQ,
        array(
		  'description' => __('Faq', 'yiw'),
		  'exclude_from_search' => false,
		  'show_ui' => true,
		  'labels' => yiw_label(__('Faq', 'yiw'), __('Faqs', 'yiw')),
		  'supports' => array( 'title', 'editor', 'revisions' ),
		  'public' => true,
		  'capability_type' => 'page',
    	  'publicly_queryable' => true,
		  'rewrite' => array( 'slug' => TYPE_FAQ, 'with_front' => true )
        )
    );
}

/**
 * Registers taxonomies
 * 
 */
function yiw_register_taxonomies()
{}


         

/**
 * Create a custom fields for custom types
 */           
 
 
/**
 * testimonials
 */
function yiw_bl_testimonials_edit_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __( "Name", 'yiw' ),
		"image" => __( "Image", 'yiw' ),
		"story" => __( "Story", 'yiw' ),
		"website" => __( "Web Site", 'yiw' )
	);
	
	return $columns;
}

function yiw_bl_testimonials_custom_columns($column){
	global $post;
	                                      
	switch ($column) {
		case "story":                      
			add_filter('excerpt_length', 'yiw_new_excerpt_length_testimonial');
			add_filter('excerpt_more', 'yiw_new_excerpt_more_testimonial');
		  	
			the_excerpt();     
		  	break;
		case "image":
		  	the_post_thumbnail( 'thumb-testimonial' );
		  	break;
		case "website":
			$url = get_post_meta( $post->ID, '_testimonial_website', true );
  			echo "<a href=\"" . esc_url( $url ) . "\">$url</a>";
		  	break;
	}                                  

}	                  
	
function yiw_new_excerpt_length_testimonial($length) {
	return 20;
}                                
	
function yiw_new_excerpt_more_testimonial($more) {
	return '[...]';
}
 
 
/**
 * faq
 */
function yiw_bl_faq_edit_columns($columns){
	$columns = array(
	    'cb' => '<input type="checkbox" />',
	    'title' => __( 'Question', 'yiw' ),
	    'description' => __( 'Answer', 'yiw' )
	);

	
	return $columns;
}

function yiw_bl_faq_custom_columns($column){
	global $post;
	                                      
	switch ($column) {
	    case "description":
	      	add_filter('excerpt_length', 'yiw_new_excerpt_length_bl_faq');
			add_filter('excerpt_more', 'yiw_new_excerpt_more_bl_faq');
		  	
			the_excerpt();
	      	break;
	}                            

}	      	                  
	
function yiw_new_excerpt_length_bl_faq($length) {
	return 20;
}                                
	
function yiw_new_excerpt_more_bl_faq($more) {
	return '[...]';
}



/**
 * Return Labels Post
 *
 * @return array
 */
function yiw_label($singular_name, $name, $title = FALSE)
{
	if( !$title )
		$title = $name;
		
	return array(
      "name" => $title,
      "singular_name" => $singular_name,
      "add_new" => __("Add New", 'yiw'),
      "add_new_item" => sprintf( __( "Add New %s", 'yiw' ), $singular_name),
      "edit_item" => sprintf( __( "Edit %s", 'yiw' ), $singular_name),
      "new_item" => sprintf( __( "New %s", 'yiw'), $singular_name),
      "view_item" => sprintf( __( "View %s", 'yiw'), $name),
      "search_items" => sprintf( __( "Search %s", 'yiw'), $name),
      "not_found" => sprintf( __( "No %s found", 'yiw'), $name),
      "not_found_in_trash" => sprintf( __( "No %s found in Trash", 'yiw'), $name),
      "parent_item_colon" => ""
  );
}	 	     

/**
 * Return Labels Post
 *
 * @return array
 */
function yiw_label_tax($singular_name, $name)
{
	return array(
      	'name' => $name,
		'singular_name' => $singular_name,
		'search_items' => sprintf( __( 'Search %s', 'yiw' ), $name),
		'all_items' => sprintf( __( 'All %s', 'yiw' ), $name),
		'parent_item' => sprintf( __( 'Parent %s', 'yiw' ), $singular_name),
		'parent_item_colon' => sprintf( __( 'Parent %s:', 'yiw' ), $singular_name),
		'edit_item' => sprintf( __( 'Edit %', 'yiw' ), $singular_name), 
		'update_item' => sprintf( __( 'Update %s', 'yiw' ), $singular_name),
		'add_new_item' => sprintf( __( 'Add New %s', 'yiw' ), $singular_name),
		'new_item_name' => sprintf( __( 'New %s Name', 'yiw' ), $singular_name),
		'menu_name' => $name,
  );
}       