<?php

function grandportfolio_register_sidebars() 
{
	if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'page-sidebar', 'name' => 'Page Sidebar', 'description' => 'The default sidebar for every pages'));
	    
	if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'side-menu-sidebar', 'name' => 'Side Menu Sidebar', 'description' => 'The default sidebar for side menu'));

	if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'blog-sidebar', 'name' => 'Blog Sidebar', 'description' => 'The default sidebar for blog page templates'));

	if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'contact-sidebar', 'name' => 'Contact Sidebar', 'description' => 'The default sidebar for contact page template'));

	if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'single-post-sidebar', 'name' => 'Single Post Sidebar', 'description' => 'The default sidebar for single post page'));
	    
	if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'single-image-page-sidebar', 'name' => 'Single Image Page Sidebar', 'description' => 'The default sidebar for single attachment (image) page'));
	    
	if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'archives-sidebar', 'name' => 'Archives Sidebar', 'description' => 'The default sidebar for archive page'));
	    
	if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'category-sidebar', 'name' => 'Category Sidebar', 'description' => 'The default sidebar for post category page'));
	    
	if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'search-sidebar', 'name' => 'Search Sidebar', 'description' => 'The default sidebar for search result page'));
	    
	if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'tag-sidebar', 'name' => 'Tag Sidebar', 'description' => 'The default sidebar for tag post page'));
	    
	if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'footer-sidebar', 'name' => 'Footer Sidebar', 'description' => 'The default sidebar for footer area of every pages'));
	    
	//Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		if ( function_exists('register_sidebar') )
		    register_sidebar(array('id' => 'shop-sidebar', 'name' => 'Shop Sidebar', 'description' => 'The default sidebar for shop page'));
	}
	
	//Register dynamic sidebar
	$dynamic_sidebar = get_option('pp_sidebar');
	
	if(!empty($dynamic_sidebar))
	{
		foreach($dynamic_sidebar as $sidebar)
		{
			if ( function_exists('register_sidebar') )
		    register_sidebar(array('id' => sanitize_title($sidebar), 'name' => $sidebar));
		}
	}
}
add_action( 'widgets_init', 'grandportfolio_register_sidebars' );

?>