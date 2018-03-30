<?php

/**
 *
 */
class mysiteDescriptionWalker extends Walker_Nav_Menu {
	
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$prepend = '<span>';
		$append = '</span>';
		$description  = ! empty( $item->description ) ? '<small>'.esc_attr( $item->description ).'</small>' : '';

		if($depth != 0)
		{
			$description = $append = $prepend = "";
		}

		 $item_output = $args->before;
		 $item_output .= '<a'. $attributes .'>';
		 $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		 $item_output .= $description.$args->link_after;
		 $item_output .= '</a>';
		 $item_output .= $args->after;

		 $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
}


class mysiteResponsiveMenuWalker extends Walker_Nav_Menu {

	var $to_depth = -1;

	function start_lvl(&$output, $depth){
    	$output .= '</option>';
    }

    function end_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth); // don't output children closing tag
    }

    function start_el(&$output, $item, $depth, $args){
		$indent = ( $depth ) ? str_repeat( "&nbsp;", $depth * 4 ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$value = ' value="'. $item->url .'"';

		$output .= '<option'.$id.$value.$class_names. ( strpos( $class_names, 'current-menu-item' ) !== false ? ' selected="selected"' : '' ) . '>';

		$item_output = $args->before;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

		$output .= $indent.$item_output;
    }

    function end_el(&$output, $item, $depth){
		if(substr($output, -9) != '</option>')
      		$output .= "</option>"; // replace closing </li> with the option tag
    }

}

?>