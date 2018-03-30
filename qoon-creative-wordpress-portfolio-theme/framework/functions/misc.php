<?php
function qoon_remove_parent_classes($class)
{
  // check for current page classes, return false if they exist.
	return ($class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor'  || $class == 'current-menu-item') ? FALSE : TRUE;
}

function qoon_add_class_to_wp_nav_menu($classes)
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
add_filter('nav_menu_css_class', 'qoon_add_class_to_wp_nav_menu');


add_filter('get_avatar','qoon_oi_change_avatar_css');
function qoon_oi_change_avatar_css($class) {
	$class = str_replace("class='avatar", "class='avatar img-responsive img-circle oi_avatar ", $class) ;
	return $class;
}

/**
* Custom widgets
**/
add_filter('wp_list_categories', 'qoon_add_span_cat_count');
function qoon_add_span_cat_count($links) {
	$links = str_replace('</a> (', '</a> <span class="oi_cat_count">', $links);
	$links = str_replace(')', '</span>', $links);
	return $links;
}

add_filter('wp_list_archive', 'qoon_add_spann_cat_count');
function qoon_add_spann_cat_count($links) {
$links = str_replace('</a> (', '</a> <span class="oi_cat_count">', $links);
$links = str_replace(')', '</span>', $links);
return $links;
}

function qoon_tag_cloud_filter($args = array()) {
    $args['smallest'] = 8;
    $args['largest'] = 14;
    $args['unit'] = 'pt';
    return $args;
}

add_filter('widget_tag_cloud_args', 'qoon_tag_cloud_filter', 90);

?>