<?php
/* Register Custom Post Type for Portfolio */
add_action('init', 'portfolio_post_type_init');
function portfolio_post_type_init() {
  $labels = array(
    'name' => __('Portfolio', 'vulcan'),
    'singular_name' => __('portfolio', 'vulcan'),
    'add_new' => __('Add New','vulcan'),
    'add_new_item' => __('Add New portfolio','vulcan'),
    'edit_item' => __('Edit portfolio','vulcan'),
    'new_item' => __('New portfolio','vulcan'),
    'view_item' => __('View portfolio','vulcan'),
    'search_items' => __('Search portfolio','vulcan'),
    'not_found' =>  __('No portfolio found','vulcan'),
    'not_found_in_trash' => __('No portfolio found in Trash','vulcan'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 1000,
    'rewrite' => array(
      'slug' => 'portfolio_item',
      'with_front' => FALSE,
    ),           
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'excerpt'
    )
  );

  register_post_type('portfolio',$args);

	register_taxonomy("portfolio_category", 
				    	array("portfolio"), 
  			    	array( "hierarchical" => true, 
  			    			"label" => __("Portfolio Categories",'vulcan'), 
  			    			"singular_label" => __("Portfolio Categories",'vulcan'), 
  			    			"rewrite" => true,
  			    			"query_var" => true,
                  "rewrite" => array(
                    "slug" => "portfolio_category"
                  )
  			    		));   
  
}


/* Register Custom Post Type for Slideshow */
add_action('init', 'slideshow_post_type_init');
function slideshow_post_type_init() {
  $labels = array(
    'name' => __('Slideshow','vulcan'),
    'singular_name' => __('slideshow' ,'vulcan'),
    'add_new' => __('Add New', 'vulcan'),
    'add_new_item' => __('Add New slideshow','vulcan'),
    'edit_item' => __('Edit slideshow','vulcan'),
    'new_item' => __('New slideshow','vulcan'),
    'view_item' => __('View slideshow','vulcan'),
    'search_items' => __('Search slideshow','vulcan'),
    'not_found' =>  __('No slideshow found','vulcan'),
    'not_found_in_trash' => __('No slideshow found in Trash','vulcan'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'rewrite' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 1000,
    'supports' => array(
      'title',
      'editor',
      'thumbnail' 
    )
  );
  register_post_type('slideshow',$args);
}

/* Register Custom Post Type for Client */
add_action('init', 'client_post_type_init');
function client_post_type_init() {
  $labels = array(
    'name' => __('Client','vulcan'),
    'singular_name' => __('Client' ,'vulcan'),
    'add_new' => __('Add New', 'vulcan'),
    'add_new_item' => __('Add New Client','vulcan'),
    'edit_item' => __('Edit Client','vulcan'),
    'new_item' => __('New Client','vulcan'),
    'view_item' => __('View Client','vulcan'),
    'search_items' => __('Search Client','vulcan'),
    'not_found' =>  __('No Client found','vulcan'),
    'not_found_in_trash' => __('No Client found in Trash','vulcan'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 1000,
    'rewrite' => array(
      'slug' => 'client_item',
      'with_front' => FALSE,
    ),         
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'excerpt'
    )
  );
  register_post_type('client',$args);
}

/* Register Custom Post Type for Testimonial */
add_action('init', 'testimonial_post_type_init');
function testimonial_post_type_init() {
  $labels = array(
    'name' => __('Testimonial','vulcan'),
    'singular_name' => __('Testimonial' ,'vulcan'),
    'add_new' => __('Add New', 'vulcan'),
    'add_new_item' => __('Add New Testimonial','vulcan'),
    'edit_item' => __('Edit Testimonial','vulcan'),
    'new_item' => __('New Testimonial','vulcan'),
    'view_item' => __('View Testimonial','vulcan'),
    'search_items' => __('Search Testimonial','vulcan'),
    'not_found' =>  __('No Testimonial found','vulcan'),
    'not_found_in_trash' => __('No Testimonial found in Trash','vulcan'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 1000,
    'rewrite' => array(
      'slug' => 'testimonial_item',
      'with_front' => FALSE,
    ),         
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'thumbnail',
    )
  );
  register_post_type('testimonial',$args);
}

/* Register Custom Post Type for Testimonial */
add_action('init', 'staff_post_type_init');
function staff_post_type_init() {
  $labels = array(
    'name' => __('Staff','vulcan'),
    'singular_name' => __('Staff' ,'vulcan'),
    'add_new' => __('Add New', 'vulcan'),
    'add_new_item' => __('Add New Staff','vulcan'),
    'edit_item' => __('Edit Staff','vulcan'),
    'new_item' => __('New Staff','vulcan'),
    'view_item' => __('View Staff','vulcan'),
    'search_items' => __('Search Staff','vulcan'),
    'not_found' =>  __('No Staff found','vulcan'),
    'not_found_in_trash' => __('No Staff found in Trash','vulcan'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 1000,
    'rewrite' => array(
      'slug' => 'staff_item',
      'with_front' => FALSE,
    ),         
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'excerpt',
    )
  );
  register_post_type('staff',$args);
}
?>