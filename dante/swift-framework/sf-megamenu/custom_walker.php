<?php
	
	/**
	 * Custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	
	class sf_mega_menu_walker extends Walker_Nav_Menu {
	      
		function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
			
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
			$class_names = $value = '';
			
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
			$natural_width = empty( $item->isnaturalwidth ) ? "" : "sf-mega-menu-natural-width";
			$alt_style = empty( $item->altstyle ) ? "" : "sf-mega-menu-alt";
			$hideheadings = empty( $item->hideheadings ) ? "" : "no-headings";
			$nocolumnspacing = empty( $item->nocolumnspacing ) ? "" : "no-column-spacing";
			$menu_width = empty( $item->menuwidth ) ? "" : 'style="width: '.$item->menuwidth.'px;"';
			$loggedinvis     = empty( $item->loggedinvis ) ? "" : "sf-menu-item-loggedin";
			$loggedoutvis    = empty( $item->loggedoutvis ) ? "" : "sf-menu-item-loggedout";
			$menuitembtn     = empty( $item->menuitembtn ) ? "" : "sf-menu-item-btn";
			
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="menu-item-'. $item->ID . ' '. esc_attr( $class_names ) . ' '.$natural_width.' '.$alt_style.' ' . $loggedinvis . ' ' . $loggedoutvis . ' ' . $menuitembtn . ' '.$hideheadings.' '.$nocolumnspacing.'" '.$menu_width;
			
			$output .= $indent . '<li ' . $value . $class_names .'>';
			
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			
			$prepend = '';
			$append = '<span class="nav-line"></span>';
			
			$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
			
			if ($depth != 0) {
			   $description = $append = $prepend = "";
			}	
				
			if (!empty( $item->megatitle )) {
				$item_output = $args->before;
				$item_output .= '<span class="title">';
				if (!empty( $item->menuicon )) {
					$item_output .= '<i class="'.$item->menuicon.'"></i>';
				}
				$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
				$item_output .= $args->link_after;
				$item_output .= '</span>';
				if (!empty( $item->htmlcontent )) {
					$item_output .= '<div class="mega-menu-widget">'.do_shortcode($item->htmlcontent).'</div>';
				}
				$item_output .= $args->after;
			} else {
				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				if (!empty( $item->menuicon )) {
					$item_output .= '<i class="'.$item->menuicon.'"></i>';
				}
				$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
				$item_output .= $args->link_after;
				//$item_output .= $description.$args->link_after;
				//$item_output .= ' '.$item->subtitle.'</a>';
				$item_output .= '</a>';
				if (!empty( $item->htmlcontent )) {
					$item_output .= '<div class="mega-menu-widget">'.do_shortcode($item->htmlcontent).'</div>';
				}
				$item_output .= $args->after;
			}
			
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			
		}
	}

?>