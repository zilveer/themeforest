<?php

/**
 * Custom WP_NAV_MENU function for top navigation
 */
if (!class_exists('HashmagMikadoTopNavigationWalker')) {
	class HashmagMikadoTopNavigationWalker extends Walker_Nav_Menu {

		// add classes to ul sub-menus
		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
		{
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		function start_lvl( &$output, $depth = 0, $args = array() ) {

			$indent = str_repeat("\t", $depth);
			if($depth == 0){
				$out_div = '<div class="mkdf-menu-second"><div class="mkdf-menu-inner">';
			}else{
				$out_div = '';
			}

			// build html
			$output .= "\n" . $indent . $out_div  .'<ul>' . "\n";
		}
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);

			if($depth == 0){
				$out_div_close = '</div></div>';
			}else{
				$out_div_close = '';
			}

			$output .= "$indent</ul>". $out_div_close ."\n";
		}

		// add main/sub classes to li's and links
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$sub = "";
			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
			if($depth==0 && $args->has_children) :
				$sub = ' mkdf-menu-has-sub';
			endif;
			if($depth==1 && $args->has_children) :
				$sub = 'mkdf-menu-sub';
			endif;

			// passed classes
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

			//menu type class
			$menu_type = "";
			if($depth==0){
				if($item->type_menu == "wide") {
					if($item->icon != "" && $item->icon != 'null'){ 
						$menu_type = " mkdf-menu-wide mkdf-menu-wide-with-icons";
					} else { 
						$menu_type = " mkdf-menu-wide";
					}
				} elseif ($item->type_menu == "wide_custom_widget"){
					$menu_type = " mkdf-menu-wide mkdf-menu-custom-widget";
				} else {
					$menu_type = " mkdf-menu-narrow";
				}
			}

			//wide menu position class
			$wide_menu_position = "";
			if($depth==0 && $item->type_menu != "wide_custom_widget"){
				if($item->wide_position == "right"){
					$wide_menu_position = " mkdf-menu-right-position";
				}elseif($item->wide_position == "left"){
					$wide_menu_position = " mkdf-menu-left-position";
				}else{
					$wide_menu_position = "";
				}
			}

			$anchor = '';
			if($item->anchor != ""){
				$anchor = '#'.esc_attr($item->anchor);
				$class_names .= ' anchor-item';
			}

			$wide_background_image = "";
			if($depth==0 && ($item->type_menu == "wide" || $item->type_menu == "wide_custom_widget") && $item->background_image != "" && $item->background_image != 'null' && $item->background_image != 'undefined'){
				$wide_background_image = 'data-wide_background_image="'.$item->background_image.'"';
			}
			
			$active = "";
			// depth dependent classes
			if ($item->anchor == "" && (($item->current && $depth == 0) || ($item->current_item_ancestor && $depth == 0))):
				$active = 'mkdf-active-item';
			endif;

			// build html
			$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' '. $active . $sub . $menu_type . $wide_menu_position .'" '.$wide_background_image.'>';

			$current_a = "";
			// link attributes
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ' href="'   . esc_attr( $item->url        ) .$anchor.'"';
			if (($item->current && $depth == 0) ||  ($item->current_item_ancestor && $depth == 0) ):
				$current_a .= ' current ';
			endif;

			$no_link_class = '';
			if($item->nolink != '') {
				$no_link_class = ' no_link';
			}

			if($item->icon != "" && $item->icon != 'null'){ 
				$icon_class = ' menu_item_has_icon'; 
			} else { 
				$icon_class = ''; 
			}

			$attributes .= ' class="'.$current_a.$no_link_class.$icon_class.'"';
			$item_output = $args->before;
			if($item->hide == ""){
				if($item->nolink == ""){
					$item_output .= '<a'. $attributes .'><span class="item_outer">';
				} else{
					$item_output .= '<a'. $attributes .' style="cursor: default;" onclick="JavaScript: return false;"><span class="item_outer">';
				}
				if($item->icon != "" && $item->icon != 'null'){$icon = $item->icon; } else{ $icon = "blank"; }

				$angle_icon   = '';
				if($depth !== 0) {
					$angle_icon = '<i class="mkdf_menu_arrow arrow_carrot-right"></i>';
				}

				$item_output .= '<span class="item_inner">';

				$icon_pack = 'font_awesome';

				if(empty($this->icon_pack)) {
					$item->icon_pack = $icon_pack;
				}

				if($item->icon_pack == 'font_awesome') {
					$icon .= ' fa';
				}

				$item_output .= '<span class="menu_icon_wrapper"><i class="menu_icon '.$icon.'"></i></span>';
				$item_output .= '<span class="item_text">';
				$item_output .= apply_filters('the_title', $item->title, $item->ID);
				$item_output .= '</span>'; //close span.item_text
				if($args->has_children && $depth == 0) {
					$item_output .= '<span class="mkdf_menu_arrow ion-chevron-down"></span>';
				}
				$item_output .= '</span>'; //close span.item_inner

				//append arrow for dropdown

				if($args->has_children && $angle_icon != "") {
					$item_output .= $angle_icon;
				}

				$item_output .= '</span></a>';
			}

			if($item->sidebar != "" && $depth > 0){
				ob_start();
				dynamic_sidebar($item->sidebar);
				$sidebar_content = ob_get_contents();
				ob_end_clean();
				$item_output .= $sidebar_content;
			}

			$item_output .= $args->after;

			// build html
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}