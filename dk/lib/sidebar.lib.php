<?php

/**
*	Setup Page side bar
**/
if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'page-sidebar', 'name' => 'Page Sidebar', 'description' => 'The default sidebar for every pages'));
    
if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'blog-sidebar', 'name' => 'Blog Sidebar', 'description' => 'The default sidebar for blog page templates'));

if ( function_exists('register_sidebar') )
	    register_sidebar(array('id' => 'contact-sidebar', 'name' => 'Contact Sidebar', 'description' => 'The default sidebar for contact page template'));


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

?>