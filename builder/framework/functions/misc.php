<?php
function remove_parent_classes($class)
{
  // check for current page classes, return false if they exist.
	return ($class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor'  || $class == 'current-menu-item') ? FALSE : TRUE;
}

function add_class_to_wp_nav_menu($classes)
{
     switch (get_post_type())
     {
     	case 'motion':
     		// we're viewing a custom post type, so remove the 'current_page_xxx and current-menu-item' from all menu items.
     		$classes = array_filter($classes, "remove_parent_classes");

     		// add the current page class to a specific menu item (replace ###).
     		if (in_array('menu-item-302', $classes))
     		{
     		   $classes[] = 'current_page_parent';
         }
     		break;

     	case 'still':
     		// we're viewing a custom post type, so remove the 'current_page_xxx and current-menu-item' from all menu items.
     		$classes = array_filter($classes, "remove_parent_classes");

     		// add the current page class to a specific menu item (replace ###).
     		if (in_array('menu-item-302', $classes))
     		{
     		   $classes[] = 'current_page_parent';
               }
     		break;

      // add more cases if necessary and/or a default
     }
	return $classes;
}
add_filter('nav_menu_css_class', 'add_class_to_wp_nav_menu');

add_filter( 'widget_title', 'do_shortcode' );
add_shortcode( 'fa', 'so_shortcode_fa' );
function so_shortcode_fa( $attr, $content ) {
    return '<i class="fa fa-'. $content . '"></i>';
};

add_filter('get_avatar','oi_change_avatar_css');
function oi_change_avatar_css($class) {
	$class = str_replace("class='avatar", "class='avatar img-responsive img-circle oi_avatar ", $class) ;
	return $class;
}

/**
* Custom widgets
**/
add_filter('wp_list_categories', 'oi_add_span_cat_count');
function oi_add_span_cat_count($links) {
	$links = str_replace('</a> (', '</a> <span class="oi_cat_count">', $links);
	$links = str_replace(')', '</span>', $links);
	return $links;
}

add_filter('wp_list_archive', 'add_spann_cat_count');
function add_spann_cat_count($links) {
$links = str_replace('</a> (', '</a> <span class="oi_cat_count">', $links);
$links = str_replace(')', '</span>', $links);
return $links;
}

function oi_tag_cloud_filter($args = array()) {
    $args['smallest'] = 8;
    $args['largest'] = 14;
    $args['unit'] = 'pt';
    return $args;
}

add_filter('widget_tag_cloud_args', 'oi_tag_cloud_filter', 90);


//PAGINATION
function wp_corenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  $a = array();
  if (!$current = get_query_var('paged')) $current = 1;
  
  if( !empty($wp_query->query_vars['s']) ) {
	   $a['add_args'] = array( 's' => str_replace(" ","+",get_query_var('s')), 'post_type' => get_query_var('post_type'));
  }
  
  if($wp_rewrite->using_permalinks()){
	$a['base'] = ''. add_query_arg('paged','%#%');
  }else{
  	$a['base'] = add_query_arg('paged','%#%');
  }
  
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 1; 
  $a['mid_size'] = '3'; 
  $a['end_size'] = '1'; 
  $a['prev_text'] = '←'; 
  $a['next_text'] = '→'; 
  $a['total'] = $wp_query->max_num_pages;
  echo  paginate_links($a);
}

?>