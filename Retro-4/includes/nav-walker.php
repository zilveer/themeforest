<?php
/* wp_nav_menu walker */
class retro_nav_walker extends Walker_Nav_Menu {

	function start_el( & $output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
		$output .= '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

		if( $item->object == 'custom' && substr($item->url, 0, 1) === '#' ) {
			$varpost = get_post($item->object_id);
			if(is_front_page()){
				$attributes .= ' href="#' . $varpost->post_name . '"';
			}else{
				$attributes .= ' href="'.home_url().'/#' . $varpost->post_name . '"';
			}
		}
		
		else {
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		}

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );

	}

}
?>