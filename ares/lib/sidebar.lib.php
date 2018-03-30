<?php
/**
*	Setup Home side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('name' => 'Home Sidebar'));

/**
*	Setup Page side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('name' => 'Page Sidebar'));
    
/**
*	Setup Contact side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('name' => 'Contact Sidebar'));
    
/**
*	Setup Category side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('name' => 'Category Sidebar'));
    
/**
*	Setup Footer side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('name' => 'Footer Sidebar'));
    
/**
*	Setup Archive side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('name' => 'Archive Sidebar'));
    
/**
*	Setup Search side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('name' => 'Search Sidebar'));
    
/**
*	Setup Tag side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('name' => 'Tag Sidebar'));
    
/**
*	Setup Single Post side bar
**/
if ( function_exists('register_sidebar') )
    register_sidebar(array('name' => 'Single Post Sidebar'));
    
    
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