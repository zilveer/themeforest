<?php 
add_filter('wp_title', 'vp_filter_wp_title', 9, 3);
function vp_filter_wp_title( $old_title, $sep, $sep_location ) {
	$ssep = ' ' . $sep . ' ';
	if (is_home() ) {
		return get_bloginfo('name');
	}
	elseif(is_single() || is_page() )
	{
		return get_the_title();
	}
	elseif( is_category() ) $output = $ssep . 'Category';
	elseif( is_tag() ) $output = $ssep . 'Tag';
	elseif( is_author() ) $output = $ssep . 'Author';
	elseif( is_year() || is_month() || is_day() ) $output = $ssep . 'Archives';
	else $output = NULL;
	 
	// get the page number we're on (index)
	if( get_query_var( 'paged' ) )
	$num = $ssep . 'page ' . get_query_var( 'paged' );
	 
	// get the page number we're on (multipage post)
	elseif( get_query_var( 'page' ) )
	$num = $ssep . 'page ' . get_query_var( 'page' );
		 
	// else
	else $num = NULL;
		 
	// concoct and return new title
	return get_bloginfo( 'name' ) . $output . $old_title . $num;
}

//This function shows the top menu if the user didn't create the menu in Appearance -> Menus.
if( !function_exists( 'show_top_menu') )
{
	function show_top_menu() {
		global $lb_opc;
		echo '<ul>';
		if(isset($lb_opc['pages_topmenu']) && $lb_opc['pages_topmenu'] != '' )
			$pages = get_pages( array('include' => $lb_opc['pages_topmenu'], 'sort_column' => 'menu_order', 'sort_order' => 'ASC') );
		else
			$pages = get_pages('number=4&sort_column=menu_order&sort_order=ASC');
		$count = count($pages);
		for($i = 0; $i < $count; $i++)
		{
			echo '<li><a href="' . get_home_url() . '/#' . $pages[$i]->post_name . '">' . $pages[$i]->post_title . '</a></li>' . PHP_EOL;
		}
		if(isset($lb_opc['blog_page']) && $lb_opc['blog_page'] != '')
			echo '<li><a href="' . get_permalink($lb_opc['blog_page'][0]) . '">Blog</a></li>';
		echo '<li><a href="' . get_home_url() . '/#contact">Contact</a></li>';
		echo '</ul>';
	}
}
?>