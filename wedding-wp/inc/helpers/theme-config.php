<?php




//webnus_activate_theme_function('webnus_activate_hook');
//webnus_deactivate_theme_function('webnus_deactivate_hook');

function webnus_activate_hook()
{
	
	
	$home = get_page_by_title( 'Home 1 – Business' );
	if(!empty($home))
	{
		update_option( 'page_on_front', $home->ID );
		update_option( 'show_on_front', 'page' );
	}
// Set the blog page
	$blog   = get_page_by_title( 'Blog' );
	if(!empty($blog))
	{
		update_option( 'page_for_posts', $blog->ID );
	}
	
	
}
function webnus_deactivate_hook()
{
	
}


function webnus_activate_theme_function($func_name)
{
	$res = get_option('webnus_activate_theme_hook');
	
	if(empty($res))
	{
		$ret = add_option('webnus_activate_theme_hook','1');
		
		call_user_func($func_name);
		
	}
}

function webnus_deactivate_theme_function($func_name)
{
	$func = create_function(null, 'delete_option("webnus_activate_theme_hook");  call_user_func("'.$func_name.'");  ');
	
	add_action('switch_theme',$func);
	
}