<?php

/**
*	Setup Page side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-1', 'name' => 'Page Sidebar'));
    
/**
*	Setup Blog side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-2', 'name' => 'Blog Sidebar'));
    
/**
*	Setup Contact side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-3', 'name' => 'Contact Sidebar'));
    
/**
*	Setup Single Post side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-4', 'name' => 'Single Post Sidebar'));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-5', 'name' => 'Archives Sidebar'));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-6', 'name' => 'Category Sidebar'));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-7', 'name' => 'Search Sidebar'));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array('id' => 'sidebar-8', 'name' => 'Tag Sidebar'));


//Register dynamic sidebar
$dynamic_sidebar = get_option('pp_sidebar');

if(!empty($dynamic_sidebar))
{
	foreach($dynamic_sidebar as $sidebar)
	{
		if ( function_exists('register_sidebar') )
	    register_sidebar(array('name' => $sidebar));
	}
}

?>