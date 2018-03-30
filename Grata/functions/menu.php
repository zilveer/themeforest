<?php

class Walker_Nav_Menu_us extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $level = ( $depth + 2); // because it counts the first submenu as 0
        $classes = array(
            'w-nav-list',
            'level_'.$level,
        );

        $class_names = implode( ' ', $classes );

        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $output .= "$indent</ul>\n";
    }

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        if ( !$element )
            return;

        $id_field = $this->db_fields['id'];

        if( ! empty( $children_elements[$element->$id_field] ) )
            array_push($element->classes,'has_sublevel');

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $level = ( $depth + 1); // because it counts the first submenu as 0

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'w-nav-item';
        $classes[] = 'level_'.$level;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a class="w-nav-anchor level_'.$level.'" '. $attributes .'>';
        $item_output .= $args->link_before.'<span class="w-nav-title">'. apply_filters( 'the_title', $item->title, $item->ID ) .'</span><span class="w-nav-arrow"></span>'. $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $output .= "$indent</li>\n";
    }

}

// Add Top Menu
function register_us_menu(){
	register_nav_menus(
		array(
			'grata-main-menu' => __('Main Menu', 'us')
		)
	);
}
add_action('init', 'register_us_menu');

function us_get_main_page_sections_order()
{
	if( ! has_nav_menu('grata-main-menu'))
	{
		return null;
	}

	$nav_menu_locations =get_nav_menu_locations();

	if (isset($nav_menu_locations['grata-main-menu']))
	{
		$nav_menu = wp_get_nav_menu_object($nav_menu_locations['grata-main-menu']);
		$items  = wp_get_nav_menu_items($nav_menu->term_id);
		$main_page_sections = array();

		foreach($items as $nav_menu_items)
		{
			if('us_main_page_section' == $nav_menu_items->object)
			{
				$main_page_sections[] = $nav_menu_items->object_id;

                $child_args = array(
                    'post_parent' => $nav_menu_items->object_id,
                    'post_type'   => 'us_main_page_section',
                    'order' => 'ASC',
                    'orderby' => 'menu_order',
                    'numberposts' => -1,
                    'post_status' => 'publish' );
                $children_array = get_children($child_args);
                if (count($children_array)) {
                    foreach($children_array as $child_id => $child) {
                        $main_page_sections[] = $child_id;
                    }
                }
			}
		}

		return $main_page_sections;

	}

	return null;
}

add_filter('wp_nav_menu_objects', 'single_page_nav_links');

function single_page_nav_links($items)
{
	foreach ($items as $item)
	{
		if('us_main_page_section' == $item->object)
		{
			$current_post = get_post($item->object_id);
			$menu_title = "#".$current_post->post_name;
			if(!(defined('ONE_PAGE_HOME') AND ONE_PAGE_HOME))
			{
				$item->url = home_url('/').$menu_title;
			}
			else
			{
				$item->url = $menu_title;
			}
		}
		elseif('custom' == $item->type && !(defined('ONE_PAGE_HOME') AND ONE_PAGE_HOME))
		{
			if(1 === preg_match('/^#([^\/]+)$/', $item->url , $matches))
			{
				$item->url = home_url('/').$item->url;
			}
		}

	}

	return $items;
}