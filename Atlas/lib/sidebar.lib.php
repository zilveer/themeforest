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