<?php

class avia_description_walker extends Walker_Nav_Menu 
{
	/**
	 * @see Walker::start_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	 function start_el(&$output, $item, $depth, $args) 
	 {
	     global $wp_query;
	     
	     //maximum length of description: increase if you want to allow longer description texts
	     $maxlength = 60;
	     
	     $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	     $class_names = $value = '';
	
	     $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	
	     $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	     $class_names = ' class="' . esc_attr( $class_names ) . '"';
	
	     $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
	
	     $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	     $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	     $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	     $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	     
	     
	     $prepend = '<strong>';
	     $append = '</strong>';
	     $description  = "";
	     if(! empty( $item->description ) )
	     {
	     	if(strlen($item->description) < $maxlength)
	     	{
	     		$description  = '<span class="main-menu-description">'.esc_attr( $item->description ).'</span>';
	     	}
	     }
	     
	     
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