<?php
function post_type_galleries() {
	$labels = array(
    	'name' => _x('Galleries', 'post type general name', THEMEDOMAIN),
    	'singular_name' => _x('Gallery', 'post type singular name', THEMEDOMAIN),
    	'add_new' => _x('Add New Gallery', 'book', THEMEDOMAIN),
    	'add_new_item' => __('Add New Gallery', THEMEDOMAIN),
    	'edit_item' => __('Edit Gallery', THEMEDOMAIN),
    	'new_item' => __('New Gallery', THEMEDOMAIN),
    	'view_item' => __('View Gallery', THEMEDOMAIN),
    	'search_items' => __('Search Gallery', THEMEDOMAIN),
    	'not_found' =>  __('No Gallery found', THEMEDOMAIN),
    	'not_found_in_trash' => __('No Gallery found in Trash', THEMEDOMAIN), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail', 'excerpt'),
    	'menu_icon' => get_stylesheet_directory_uri().'/functions/images/sign.png'
	); 		

	register_post_type( 'galleries', $args );
	
  	$labels = array(			  
  	  'name' => _x( 'Gallery Categories', 'taxonomy general name', THEMEDOMAIN ),
  	  'singular_name' => _x( 'Gallery Category', 'taxonomy singular name', THEMEDOMAIN ),
  	  'search_items' =>  __( 'Search Gallery Categories', THEMEDOMAIN ),
  	  'all_items' => __( 'All Gallery Categories', THEMEDOMAIN ),
  	  'parent_item' => __( 'Parent Gallery Category', THEMEDOMAIN ),
  	  'parent_item_colon' => __( 'Parent Gallery Category:', THEMEDOMAIN ),
  	  'edit_item' => __( 'Edit Gallery Category', THEMEDOMAIN ), 
  	  'update_item' => __( 'Update Gallery Category', THEMEDOMAIN ),
  	  'add_new_item' => __( 'Add New Gallery Category', THEMEDOMAIN ),
  	  'new_item_name' => __( 'New Gallery Category Name', THEMEDOMAIN ),
  	); 							  
  	
  	register_taxonomy(
		'gallerycat',
		'galleries',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'gallerycat',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'gallerycat', 'with_front' => false ),
		)
	);		  
} 
								  
add_action('init', 'post_type_galleries');


function post_type_portfolios() {
	$labels = array(
    	'name' => _x('Portfolios', 'post type general name', THEMEDOMAIN),
    	'singular_name' => _x('Portfolio', 'post type singular name', THEMEDOMAIN),
    	'add_new' => _x('Add New Portfolio', 'book', THEMEDOMAIN),
    	'add_new_item' => __('Add New Portfolio', THEMEDOMAIN),
    	'edit_item' => __('Edit Portfolio', THEMEDOMAIN),
    	'new_item' => __('New Portfolio', THEMEDOMAIN),
    	'view_item' => __('View Portfolio', THEMEDOMAIN),
    	'search_items' => __('Search Portfolios', THEMEDOMAIN),
    	'not_found' =>  __('No Portfolio found', THEMEDOMAIN),
    	'not_found_in_trash' => __('No Portfolio found in Trash', THEMEDOMAIN), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail', 'excerpt', 'revisions', 'comments'),
    	'menu_icon' => get_stylesheet_directory_uri().'/functions/images/sign.png'
	); 		

	register_post_type( 'portfolios', $args );
	
  	$labels = array(			  
  	  'name' => _x( 'Portfolio Categories', 'taxonomy general name', THEMEDOMAIN ),
  	  'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name', THEMEDOMAIN ),
  	  'search_items' =>  __( 'Search Portfolio Categories', THEMEDOMAIN ),
  	  'all_items' => __( 'All Portfolio Categories', THEMEDOMAIN ),
  	  'parent_item' => __( 'Parent Portfolio Category', THEMEDOMAIN ),
  	  'parent_item_colon' => __( 'Parent Portfolio Category:', THEMEDOMAIN ),
  	  'edit_item' => __( 'Edit Portfolio Category', THEMEDOMAIN ), 
  	  'update_item' => __( 'Update Portfolio Category', THEMEDOMAIN ),
  	  'add_new_item' => __( 'Add New Portfolio Category', THEMEDOMAIN ),
  	  'new_item_name' => __( 'New Portfolio Category Name', THEMEDOMAIN ),
  	); 							  
  	
  	register_taxonomy(
		'portfoliosets',
		'portfolios',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'portfoliosets',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'portfoliosets', 'with_front' => false ),
		)
	);		  
} 
								  
add_action('init', 'post_type_portfolios');


function post_type_services() {
	$labels = array(
    	'name' => _x('Services', 'post type general name', THEMEDOMAIN),
    	'singular_name' => _x('Service', 'post type singular name', THEMEDOMAIN),
    	'add_new' => _x('Add New Service', 'book', THEMEDOMAIN),
    	'add_new_item' => __('Add New Service', THEMEDOMAIN),
    	'edit_item' => __('Edit Service', THEMEDOMAIN),
    	'new_item' => __('New Service', THEMEDOMAIN),
    	'view_item' => __('View Service', THEMEDOMAIN),
    	'search_items' => __('Search Services', THEMEDOMAIN),
    	'not_found' =>  __('No Service found', THEMEDOMAIN),
    	'not_found_in_trash' => __('No Service found in Trash', THEMEDOMAIN), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title', 'editor', 'thumbnail'),
    	'menu_icon' => get_stylesheet_directory_uri().'/functions/images/sign.png'
	); 		

	register_post_type( 'services', $args );
	
	$labels = array(			  
  	  'name' => _x( 'Service Categories', 'taxonomy general name', THEMEDOMAIN ),
  	  'singular_name' => _x( 'Service Category', 'taxonomy singular name', THEMEDOMAIN ),
  	  'search_items' =>  __( 'Search Service Categories', THEMEDOMAIN ),
  	  'all_items' => __( 'All Service Categories', THEMEDOMAIN ),
  	  'parent_item' => __( 'Parent Service Category', THEMEDOMAIN ),
  	  'parent_item_colon' => __( 'Parent Service Category:', THEMEDOMAIN ),
  	  'edit_item' => __( 'Edit Service Category', THEMEDOMAIN ), 
  	  'update_item' => __( 'Update Service Category', THEMEDOMAIN ),
  	  'add_new_item' => __( 'Add New Service Category', THEMEDOMAIN ),
  	  'new_item_name' => __( 'New Service Category Name', THEMEDOMAIN ),
  	); 							  
  	
  	register_taxonomy(
		'servicecats',
		'services',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'servicecats',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'servicecats', 'with_front' => false ),
		)
	);		  
} 
								  
add_action('init', 'post_type_services');


/*function post_type_testimonials() {
	$labels = array(
    	'name' => _x('Testimonials', 'post type general name', THEMEDOMAIN),
    	'singular_name' => _x('Testimonial', 'post type singular name', THEMEDOMAIN),
    	'add_new' => _x('Add New Testimonial', 'book', THEMEDOMAIN),
    	'add_new_item' => __('Add New Testimonial', THEMEDOMAIN),
    	'edit_item' => __('Edit Testimonial', THEMEDOMAIN),
    	'new_item' => __('New Testimonial', THEMEDOMAIN),
    	'view_item' => __('View Testimonial', THEMEDOMAIN),
    	'search_items' => __('Search Testimonial', THEMEDOMAIN),
    	'not_found' =>  __('No Testimonial found', THEMEDOMAIN),
    	'not_found_in_trash' => __('No Testimonial found in Trash', THEMEDOMAIN), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title', 'editor', 'thumbnail'),
    	'menu_icon' => get_stylesheet_directory_uri().'/functions/images/sign.png'
	); 		

	register_post_type( 'testimonials', $args );
	
	$labels = array(			  
  	  'name' => _x( 'Testimonial Categories', 'taxonomy general name', THEMEDOMAIN ),
  	  'singular_name' => _x( 'Testimonial Category', 'taxonomy singular name', THEMEDOMAIN ),
  	  'search_items' =>  __( 'Search Testimonial Categories', THEMEDOMAIN ),
  	  'all_items' => __( 'All Testimonial Categories', THEMEDOMAIN ),
  	  'parent_item' => __( 'Parent Testimonial Category', THEMEDOMAIN ),
  	  'parent_item_colon' => __( 'Parent Testimonial Category:', THEMEDOMAIN ),
  	  'edit_item' => __( 'Edit Testimonial Category', THEMEDOMAIN ), 
  	  'update_item' => __( 'Update Testimonial Category', THEMEDOMAIN ),
  	  'add_new_item' => __( 'Add New Testimonial Category', THEMEDOMAIN ),
  	  'new_item_name' => __( 'New Testimonial Category Name', THEMEDOMAIN ),
  	); 							  
  	
  	register_taxonomy(
		'testimonialcats',
		'testimonials',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'testimonialcats',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'testimonialcats', 'with_front' => false ),
		)
	);		  
} 
								  
add_action('init', 'post_type_testimonials');*/


function post_type_clients() {
	$labels = array(
    	'name' => _x('Clients', 'post type general name', THEMEDOMAIN),
    	'singular_name' => _x('Client', 'post type singular name', THEMEDOMAIN),
    	'add_new' => _x('Add Client', 'book', THEMEDOMAIN),
    	'add_new_item' => __('Add New Client', THEMEDOMAIN),
    	'edit_item' => __('Edit Client', THEMEDOMAIN),
    	'new_item' => __('New Client', THEMEDOMAIN),
    	'view_item' => __('View Client', THEMEDOMAIN),
    	'search_items' => __('Search Client', THEMEDOMAIN),
    	'not_found' =>  __('No Client found', THEMEDOMAIN),
    	'not_found_in_trash' => __('No Client found in Trash', THEMEDOMAIN), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title', 'editor', 'thumbnail'),
    	'menu_icon' => get_stylesheet_directory_uri().'/functions/images/sign.png'
	); 		

	register_post_type( 'clients', $args );
	
	$labels = array(			  
  	  'name' => _x( 'Client Categories', 'taxonomy general name', THEMEDOMAIN ),
  	  'singular_name' => _x( 'Client Category', 'taxonomy singular name', THEMEDOMAIN ),
  	  'search_items' =>  __( 'Search Client Categories', THEMEDOMAIN ),
  	  'all_items' => __( 'All Client Categories', THEMEDOMAIN ),
  	  'parent_item' => __( 'Parent Client Category', THEMEDOMAIN ),
  	  'parent_item_colon' => __( 'Parent Client Category:', THEMEDOMAIN ),
  	  'edit_item' => __( 'Edit Client Category', THEMEDOMAIN ), 
  	  'update_item' => __( 'Update Client Category', THEMEDOMAIN ),
  	  'add_new_item' => __( 'Add New Client Category', THEMEDOMAIN ),
  	  'new_item_name' => __( 'New Client Category Name', THEMEDOMAIN ),
  	); 							  
  	
  	register_taxonomy(
		'clientcats',
		'clients',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'clientcats',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'clientcats', 'with_front' => false ),
		)
	);
}
add_action('init', 'post_type_clients');


function post_type_team() {
	$labels = array(
    	'name' => _x('Team Members', 'post type general name', THEMEDOMAIN),
    	'singular_name' => _x('Team Member', 'post type singular name', THEMEDOMAIN),
    	'add_new' => _x('Add New Team Member', 'book', THEMEDOMAIN),
    	'add_new_item' => __('Add New Team Member', THEMEDOMAIN),
    	'edit_item' => __('Edit Team Member', THEMEDOMAIN),
    	'new_item' => __('New Team Member', THEMEDOMAIN),
    	'view_item' => __('View Team Member', THEMEDOMAIN),
    	'search_items' => __('Search Team Members', THEMEDOMAIN),
    	'not_found' =>  __('No Team Member found', THEMEDOMAIN),
    	'not_found_in_trash' => __('No Team Member found in Trash', THEMEDOMAIN), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail'),
    	'menu_icon' => get_stylesheet_directory_uri().'/functions/images/sign.png'
	); 		

	register_post_type( 'team', $args );
	
	$labels = array(			  
  	  'name' => _x( 'Team Categories', 'taxonomy general name', THEMEDOMAIN ),
  	  'singular_name' => _x( 'Team Category', 'taxonomy singular name', THEMEDOMAIN ),
  	  'search_items' =>  __( 'Team Service Categories', THEMEDOMAIN ),
  	  'all_items' => __( 'All Team Categories', THEMEDOMAIN ),
  	  'parent_item' => __( 'Parent Team Category', THEMEDOMAIN ),
  	  'parent_item_colon' => __( 'Parent Team Category:', THEMEDOMAIN ),
  	  'edit_item' => __( 'Edit Team Category', THEMEDOMAIN ), 
  	  'update_item' => __( 'Update Team Category', THEMEDOMAIN ),
  	  'add_new_item' => __( 'Add New Team Category', THEMEDOMAIN ),
  	  'new_item_name' => __( 'New Team Category Name', THEMEDOMAIN ),
  	); 							  
  	
  	register_taxonomy(
		'teamcats',
		'team',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'teamcats',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'teamcats', 'with_front' => false ),
		)
	);
}
add_action('init', 'post_type_team');


function post_type_pricing() {
	$labels = array(
    	'name' => _x('Pricing', 'post type general name', THEMEDOMAIN),
    	'singular_name' => _x('Pricing', 'post type singular name', THEMEDOMAIN),
    	'add_new' => _x('Add New Pricing', 'book', THEMEDOMAIN),
    	'add_new_item' => __('Add New Pricing', THEMEDOMAIN),
    	'edit_item' => __('Edit Pricing', THEMEDOMAIN),
    	'new_item' => __('New Pricing', THEMEDOMAIN),
    	'view_item' => __('View Pricing', THEMEDOMAIN),
    	'search_items' => __('Search Pricings', THEMEDOMAIN),
    	'not_found' =>  __('No Pricing found', THEMEDOMAIN),
    	'not_found_in_trash' => __('No Pricing found in Trash', THEMEDOMAIN), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title'),
    	'menu_icon' => get_stylesheet_directory_uri().'/functions/images/sign.png'
	); 		

	register_post_type( 'pricing', $args );
	
	$labels = array(			  
  	  'name' => _x( 'Pricing Categories', 'taxonomy general name', THEMEDOMAIN ),
  	  'singular_name' => _x( 'Pricing Category', 'taxonomy singular name', THEMEDOMAIN ),
  	  'search_items' =>  __( 'Pricing Service Categories', THEMEDOMAIN ),
  	  'all_items' => __( 'All Pricing Categories', THEMEDOMAIN ),
  	  'parent_item' => __( 'Parent Pricing Category', THEMEDOMAIN ),
  	  'parent_item_colon' => __( 'Parent Pricing Category:', THEMEDOMAIN ),
  	  'edit_item' => __( 'Edit Pricing Category', THEMEDOMAIN ), 
  	  'update_item' => __( 'Update Pricing Category', THEMEDOMAIN ),
  	  'add_new_item' => __( 'Add New Pricing Category', THEMEDOMAIN ),
  	  'new_item_name' => __( 'New Pricing Category Name', THEMEDOMAIN ),
  	); 							  
  	
  	register_taxonomy(
		'pricingcats',
		'pricing',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'pricingcats',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'pricingcats', 'with_front' => false ),
		)
	);
}
add_action('init', 'post_type_pricing');


add_filter( 'manage_posts_columns', 'rt_add_gravatar_col');
function rt_add_gravatar_col($cols) {
	$cols['thumbnail'] = __('Thumbnail', THEMEDOMAIN);
	return $cols;
}

add_action( 'manage_posts_custom_column', 'rt_get_author_gravatar');
function rt_get_author_gravatar($column_name ) {
	if ( $column_name  == 'thumbnail'  ) {
		echo get_the_post_thumbnail(get_the_ID(), array(100, 100));
	}
}

/*
	Get gallery list
*/
$args = array(
    'numberposts' => -1,
    'post_type' => array('galleries'),
);

$galleries_arr = get_posts($args);
$galleries_select = array();
$galleries_select['(Display Post Featured Image)'] = '';
$galleries_select['(Hide Post Featured Image)'] = -1;

foreach($galleries_arr as $gallery)
{
	$galleries_select[$gallery->post_title] = $gallery->ID;
}

/*
	Get post layouts
*/
$post_layout_select = array();
$post_layout_select = array(
	'Fullwidth' => 'Fullwidth',
	'With Sidebar' => 'With Sidebar',
);

//Get all sidebars
$theme_sidebar = array(
	'' => '',
	'Page Sidebar' => 'Page Sidebar', 
	'Contact Sidebar' => 'Contact Sidebar', 
	'Blog Sidebar' => 'Blog Sidebar',
);

$dynamic_sidebar = get_option('pp_sidebar');

if(!empty($dynamic_sidebar))
{
	foreach($dynamic_sidebar as $sidebar)
	{
		$theme_sidebar[$sidebar] = $sidebar;
	}
}

/*
	Begin creating custom fields
*/

$postmetas = 
	array (
		'post' => array(
			array("section" => "Content Type", "id" => "post_layout", "type" => "select", "title" => "Post Layout", "description" => "You can select layout of this single post page.", "items" => $post_layout_select),
			array("section" => "Content Type", "id" => "post_gallery_id", "type" => "select", "title" => "Featured Image Gallery", "description" => "You can select image gallery to display on single post page.", "items" => $galleries_select),
		),
		
		'services' => array(
			array("section" => "Service Option", "id" => "service_font_awesome", "type" => "checkbox", "title" => "Use Font Awesome as Service Icon", "description" => "Check this option if you want to use Font Awesome HTML code to display service icon instead of featured image"),
			array("section" => "Service Option", "id" => "service_font_awesome_code", "type" => "textarea", "title" => "Font Awesome Code", "description" => "Enter Font Awesome HTML code ex. ".htmlentities('<i class="fa fa-camera-retro"></i>')." <a target=\"_blank\" href=\"http://fortawesome.github.io/Font-Awesome/cheatsheet/\">See full Font Awesome Cheat Sheet here</a>"),
		),
		
		'portfolios' => array(
			array("section" => "Content Type", "id" => "portfolio_type", "type" => "select", "title" => "Content Type", "description" => "Select content type for this portfolio item:", 
				"items" => array(
					"Image" => "Image",
					"Fullscreen Vimeo Video" => "Fullscreen Vimeo Video",
					"Fullscreen Youtube Video" => "Fullscreen Youtube Video",
					"Fullscreen Self-Hosted Video" => "Fullscreen Self-Hosted Video",
					"Vimeo Video" => "Vimeo Video",
					"Youtube Video" => "Youtube Video", 
					"Self-Hosted Video" => "Self-Hosted Video",
					"Portfolio Content" => "Portfolio Content",
					"External Link" => "External Link",
				)),
			array("section" => "Content Type", "id" => "portfolio_content_template", "type" => "select", "title" => "Template (Only if you selected portfolio content type)", "description" => "Select single portfolio item page template.", 
				"items" => array(
					"Fullwidth" => "Fullwidth",
					"With Sidebar" => "With Sidebar",
			)),
			array("section" => "Select Sidebar", "id" => "portfolio_sidebar", "type" => "select", "title" => "Portfolio Template Sidebar (Only if you selected sidebar in template option)", "description" => "Select this portfolio single page's sidebar to display", "items" => $theme_sidebar),
			array("section" => "Content Type", "id" => "portfolio_gallery_id", "type" => "select", "title" => "Featured Image Gallery (Only if you selected portfolio content type)", "description" => "If you select \"Portfolio Content\" then you can select image gallery to display on single portfolio page.", "items" => $galleries_select),
			array("section" => "Content Type", "id" => "portfolio_video_id", "title" => "Youtube or Vimeo Video ID (Only if you selected Youtube Video or Vimeo Video)", "description" => "Enter your video ID here:"),
			array("section" => "Content Type", "id" => "portfolio_mp4_url", "title" => "Video URL (Only if you selected Self-Hosted)", "description" => "Enter your video URL (.mp4 file format):"),
			array("section" => "Content Type", "id" => "portfolio_link_url", "title" => "Link URL (Only if you selected external link content type)", "description" => "Portfolio item will link to this URL"),
		),
		
		'galleries' => array(
			array("section" => "Gallery Template", "id" => "gallery_template", "type" => "select", "title" => "Gallery Template", "description" => "Select gallery template for this gallery", 
				"items" => array(
					"Gallery 2 Columns" => "Gallery 2 Columns",
					"Gallery 3 Columns" => "Gallery 3 Columns",
					"Gallery 4 Columns" => "Gallery 4 Columns",
					"Masonry Fullwidth" => "Masonry Fullwidth",
					"Masonry 2 Columns Right Sidebar" => "Masonry 2 Columns Right Sidebar",
					"Masonry 3 Columns Right Sidebar" => "Masonry 3 Columns Right Sidebar",
					"Masonry 4 Columns Right Sidebar" => "Masonry 4 Columns Right Sidebar",
					"Masonry 2 Columns Left Sidebar" => "Masonry 2 Columns Left Sidebar",
					"Masonry 3 Columns Left Sidebar" => "Masonry 3 Columns Left Sidebar",
					"Masonry 4 Columns Left Sidebar" => "Masonry 4 Columns Left Sidebar",
					"Gallery Fullscreen" => "Gallery Fullscreen",
					"Gallery Image Flow" => "Gallery Image Flow",
					"Gallery Flip" => "Gallery Flip",
					"Gallery Kenburns" => "Gallery Kenburns",
				)),
			array("section" => "Password Protect", "id" => "gallery_password", "title" => "Password", "description" => "Enter your password for this gallery"),
			array("section" => "Background Audio", "id" => "gallery_audio", "type" => "file", "title" => "Gallery Background Audio", "description" => "Support file types *.mp3, *.mp4"),
			array("section" => "Select Sidebar", "id" => "gallery_sidebar", "type" => "select", "title" => "Gallery Sidebar", "description" => "Select this page's sidebar to display (only gallery sidebar templates support)", "items" => $theme_sidebar),
		),
		
		'clients' => array(
			array("section" => "Client Option", "id" => "client_website_url", "type" => "text", "title" => "Client Website URL", "description" => "Enter client website URL here ex. http://google.com"),
		),
		
		'team' => array(
			array("section" => "Team Option", "id" => "team_position", "type" => "text", "title" => "Position and Role", "description" => "Enter team member position and role ex. Marketing Manager"),
			array("section" => "Facebook URL", "id" => "member_facebook", "type" => "text", "title" => "Facebook URL", "description" => "Enter team member Facebook URL"),
		    array("section" => "Twitter URL", "id" => "member_twitter", "type" => "text", "title" => "Twitter URL", "description" => "Enter team member Twitter URL"),
		    array("section" => "Google+ URL", "id" => "member_google", "type" => "text", "title" => "Google+ URL", "description" => "Enter team member Google+ URL"),
		    array("section" => "Linkedin URL", "id" => "member_linkedin", "type" => "text", "title" => "Linkedin URL", "description" => "Enter team member Linkedin URL"),
		),
		
		'pricing' => array(
			array("section" => "Pricing Option", "id" => "pricing_featured", "type" => "checkbox", "title" => "Make this pricing featured", "description" => "Check this option if you want to display this pricing as featured one."),
			array("section" => "Pricing Option", "id" => "pricing_plan_currency", "type" => "text", "title" => "Currency", "description" => "Enter currency", "sample" => "$"),
			array("section" => "Pricing Option", "id" => "pricing_plan_price", "type" => "text", "title" => "Exact Price", "description" => "Enter exact price", "sample" => "10"),
			array("section" => "Pricing Option", "id" => "pricing_plan_time", "type" => "text", "title" => "Time", "description" => "Enter price per time (optional)", "sample" => 'month'),
			array("section" => "Pricing Option", "id" => "pricing_plan_features", "type" => "textarea", "title" => "Plan Features", "description" => "Enter pricing plan features.", "sample" => "Unlimited Pages\nUnlimited Storage\nMobile Website\n24/7 Customer Support"),
			array("section" => "Pricing Option", "id" => "pricing_button_text", "type" => "text", "title" => "Button Text", "description" => "Enter pricing button text", "sample" => "Purchase Now"),
		    array("section" => "Pricing Option", "id" => "pricing_button_url", "type" => "text", "title" => "Button URL", "description" => "Enter pricing button  URL", "sample" => "http://themeforest.net"),
		),
		
		/*'testimonials' => array(
			array("section" => "Testimonial Option", "id" => "testimonial_position", "type" => "text", "title" => "Customer Position", "description" => "Enter customer position in company"),
			array("section" => "Testimonial Option", "id" => "testimonial_company_name", "type" => "text", "title" => "Company Name", "description" => "Enter customer company name"),
			array("section" => "Testimonial Option", "id" => "testimonial_company_website", "type" => "text", "title" => "Company Website URL", "description" => "Enter customer company website URL"),
		),*/
);

function create_meta_box() {

	global $postmetas;
	
	if(!isset($_GET['post_type']) OR empty($_GET['post_type']))
	{
		if(isset($_GET['post']) && !empty($_GET['post']))
		{
			$post_obj = get_post($_GET['post']);
			$_GET['post_type'] = $post_obj->post_type;
		}
		else
		{
			$_GET['post_type'] = 'post';
		}
	}
	
	if ( function_exists('add_meta_box') && isset($postmetas) && count($postmetas) > 0 ) {  
		foreach($postmetas as $key => $postmeta)
		{
			if($_GET['post_type']==$key && !empty($postmeta))
			{
				if($key != 'pricing')
				{
					add_meta_box( 'metabox', ucfirst($key).' Options', 'new_meta_box', $key, 'side', 'high' );
				}
				else
				{
					add_meta_box( 'metabox', ucfirst($key).' Options', 'new_meta_box', $key, 'normal', 'high' );
				}
			}
		}
	}

}  

function new_meta_box() {
	global $post, $postmetas;
	
	if(!isset($_GET['post_type']) OR empty($_GET['post_type']))
	{
		if(isset($_GET['post']) && !empty($_GET['post']))
		{
			$post_obj = get_post($_GET['post']);
			$_GET['post_type'] = $post_obj->post_type;
		}
		else
		{
			$_GET['post_type'] = 'post';
		}
	}

	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$meta_section = '';

	foreach ( $postmetas as $key => $postmeta ) {
	
		if($_GET['post_type'] == $key)
		{
		
			foreach ( $postmeta as $postmeta_key => $each_meta ) {
		
				$meta_id = $each_meta['id'];
				$meta_title = $each_meta['title'];
				$meta_description = $each_meta['description'];
				
				if(isset($postmeta['section']))
				{
					$meta_section = $postmeta['section'];
				}
				
				$meta_type = '';
				if(isset($each_meta['type']))
				{
					$meta_type = $each_meta['type'];
				}
				
				echo "<br/><strong>".$meta_title."</strong><hr class='pp_widget_hr'/>";
				echo "<div class='pp_widget_description'>$meta_description</div>";
				
				if ($meta_type == 'checkbox') {
					$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
					echo "<br style='clear:both'><input type='checkbox' name='$meta_id' id='$meta_id' class='iphone_checkboxes' value='1' $checked /><br style='clear:both'><br/><br/>";
				}
				else if ($meta_type == 'select') {
					echo "<p><select name='$meta_id' id='$meta_id'>";
					
					if(!empty($each_meta['items']))
					{
						foreach ($each_meta['items'] as $key => $item)
						{
							echo '<option value="'.$item.'"';
							
							if($item == get_post_meta($post->ID, $meta_id, true))
							{
								echo ' selected ';
							}
							
							echo '>'.$key.'</option>';
						}
					}
					
					echo "</select></p>";
				}
				else if ($meta_type == 'file') { 
				    echo "<p><input type='text' name='$meta_id' id='$meta_id' class='' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:89%' /><input id='".$meta_id."_button' name='".$meta_id."_button' type='button' value='Upload' class='metabox_upload_btn button' readonly='readonly' rel='".$meta_id."' style='margin:7px 0 0 5px' /></p>";
				}
				else if ($meta_type == 'textarea') {
					if(isset($postmeta[$postmeta_key]['sample']))
					{
						echo "<p><textarea name='$meta_id' id='$meta_id' class=' hint' style='width:100%' rows='7' title='".$postmeta[$postmeta_key]['sample']."'>".get_post_meta($post->ID, $meta_id, true)."</textarea></p>";
					}
					else
					{
						echo "<p><textarea name='$meta_id' id='$meta_id' class='' style='width:100%' rows='7'>".get_post_meta($post->ID, $meta_id, true)."</textarea></p>";
					}
				}			
				else {
					if(isset($postmeta[$postmeta_key]['sample']))
					{
						echo "<p><input type='text' name='$meta_id' id='$meta_id' class='' title='".$postmeta[$postmeta_key]['sample']."' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:99%' /></p>";
					}
					else
					{
						echo "<p><input type='text' name='$meta_id' id='$meta_id' class='' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:99%' /></p>";
					}
				}
			}
		}
	}
	
	echo '<br/>';

}

function save_postdata( $post_id ) {

	global $postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	// Check permissions

	if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}
	
	foreach ( $postmetas as $postmeta ) {
		foreach ( $postmeta as $each_meta ) {
	
			if (isset($_POST[$each_meta['id']]) && $_POST[$each_meta['id']]) {
				update_custom_meta($post_id, $_POST[$each_meta['id']], $each_meta['id']);
			}
			
			if (isset($_POST[$each_meta['id']]) && $_POST[$each_meta['id']] == "") {
				delete_post_meta($post_id, $each_meta['id']);
			}
			
			if (!isset($_POST[$each_meta['id']])) {
				delete_post_meta($post_id, $each_meta['id']);
			}
		
		}
	}

}

function update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}

//init

add_action('admin_menu', 'create_meta_box'); 
add_action('save_post', 'save_postdata');  

/*
	End creating custom fields
*/

?>