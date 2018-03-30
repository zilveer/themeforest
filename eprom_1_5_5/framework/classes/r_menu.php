<?php

/* R-Menu Class
 ------------------------------------------------------------------------*/
class RMenu_Walker_Nav_Menu extends Walker_Nav_Menu {
	
   function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (!empty($children_elements[$element->$id_field])) { 
            $element->classes[] = 'has-submenu';
        }
        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query, $r_option;           

		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		$class_names = $value = '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'level'.$depth;
		
		$arrow = '';
		if ( is_woocommerce_activated() ) {
			$shop_page_id = get_option( 'woocommerce_shop_page_id' );
		}
		foreach($classes as $el){

			if ( is_woocommerce_activated() && isset( $shop_page_id ) && is_page( $shop_page_id ) ) {
				 if ( $shop_page_id == $item->object_id ) $classes[] = 'current-menu-item';
			} else if ('product' == get_post_type() || is_tax('product_cat')) {
				
			    /* Highlight events page */
			        if ($shop_page_id == $item->object_id) $classes[] = 'current-menu-item';

			} else if ('wp_releases' == get_post_type()) {
				
			    /* Highlight portfolio page */
			    if (isset($r_option['releases_page']) && $r_option['releases_page'] != 'none') {
			        if ($r_option['releases_page'] == $item->object_id) $classes[] = 'current-menu-item';
				}
			} else if ('wp_gallery' == get_post_type() || is_tax('wp_gallery_categories')) {
				
			    /* Highlight gallery page */
			    if (isset($r_option['gallery_page']) && $r_option['gallery_page'] != 'none') {
			        if ($r_option['gallery_page'] == $item->object_id) $classes[] = 'current-menu-item';
				}
			} else if ('wp_events_manager' == get_post_type() || is_tax('wp_event_categories')) {
				
			    /* Highlight events page */
			    if (isset($r_option['events_page']) && $r_option['events_page'] != 'none') {
			        if ($r_option['events_page'] == $item->object_id) $classes[] = 'current-menu-item';
				}
			} else if ('wp_artists' == get_post_type()) {
				
			    /* Highlight events page */
			    if (isset($r_option['artists_page']) && $r_option['artists_page'] != 'none') {
			        if ($r_option['artists_page'] == $item->object_id) $classes[] = 'current-menu-item';
				}
			} else if (is_single() || is_category() || is_tag()) {
				
			    /* Highlight blog page */
			    if (isset($r_option['blog_page']) && $r_option['blog_page'] != 'none') {
					if ($r_option['blog_page'] == $item->object_id) $classes[] = 'current-menu-item';
				}
			}
			if ($el == 'has-submenu'){ 
			    $arrow .= '<span class="menu-icon"></span>';
			}
		}

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		
		$class_names = ' class="' . esc_attr($class_names) . '"';

		$id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
		$attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target) .'"' : '';
		$attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) .'"' : '';
		$attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= $arrow;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id);
	}
}
?>