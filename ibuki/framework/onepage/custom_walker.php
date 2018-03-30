<?php
	
	/**
	 * Custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	
	class az_onepagemenu_walker extends Walker_Nav_Menu {
	      
		function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {

			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
			$class_names = $value = '';
			
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = 'class="menu-item-'. $item->ID . ' '. esc_attr( $class_names ) . '"';
			
			$output .= $indent . '<li ' . $value . $class_names .'>';
			
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			//$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) . esc_attr($item->custom_params) .'"' : '';
			//$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

			$menu_page = get_post($item->object_id);
			if($item->target_type == 'section' && $depth == 0){
				$attributes .= ! empty( $item->url )	? ' href="'.home_url().esc_attr( $item->url ).esc_attr($item->custom_params).'"' : '';
			} else {
				$attributes .= ! empty( $item->url )	? ' class="external" href="'.esc_attr( $item->url ).esc_attr($item->custom_params).'"' : '';
			}
						
			$item_output = '';
			$prepend = '';
			$append = '';
			
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';			
			
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $args->link_after;
				$item_output .= '</a>';

			
			if($item->html)
			$output .= $item->html;

			else if(!$item->hidden)
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args);
		}
	}

?>