<?php

/*
*	Main Navigation Walker
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

if ( !class_exists('Blade_Grve_Main_Navigation_Walker') ) {

	class Blade_Grve_Main_Navigation_Walker extends Walker_Nav_Menu {

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			//Megamenu only on first level
			if ( '0' == $depth && isset( $item->grve_megamenu ) && !empty( $item->grve_megamenu ) ) {
				$classes[] = 'megamenu column-' . $item->grve_megamenu;
			}

			//Link Mode
			$link_mode = '';
			if ( isset( $item->grve_link_mode ) ) {
				$link_mode = $item->grve_link_mode;
			}

			if ( 'no-link' == $link_mode ) {
				$classes[] = 'grve-menu-no-link';
			} else if ( 'hidden' == $link_mode ) {
				$classes[] = 'grve-hidden-menu-item';
			}

			//Menu Item Style
			if ( isset( $item->grve_style ) && !empty( $item->grve_style ) ) {
				$menu_item_color = 'primary-1';
				$menu_item_hover_color = 'black';
				if ( 'button' == $item->grve_style ) {
					$classes[] = 'grve-menu-type-button';
				}
				if ( isset( $item->grve_color ) && !empty( $item->grve_color ) ) {
					$menu_item_color = $item->grve_color;
				}
				if ( isset( $item->grve_hover_color ) && !empty( $item->grve_hover_color ) ) {
					$menu_item_hover_color = $item->grve_hover_color;
				}

				$classes[] = 'grve-' . $menu_item_color;
				$classes[] = 'grve-hover-' . $menu_item_hover_color;

			}

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

			//Remove href if no-link mode
			if ( 'no-link' == $link_mode ) {
				$atts['href'] = '#';
			}

			//Add Link Class
			if ( isset( $item->grve_link_classes ) && !empty( $item->grve_link_classes ) ) {
				$atts['class'] = $item->grve_link_classes;
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before;

			//Add Menu icon
			if ( isset( $item->grve_icon_fontawesome ) && !empty( $item->grve_icon_fontawesome ) ) {
				$item_output .= '<i class="grve-menu-icon ' . esc_attr( $item->grve_icon_fontawesome ) . '"></i>';
			}
			$item_output .= apply_filters( 'the_title', $item->title, $item->ID );

			if ( isset( $item->description ) && !empty( $item->description ) ) {
				$item_output .= '<span class="grve-menu-description">' . esc_html( $item->description ) . '</span>';
			}

			//Add Label text
			if ( isset( $item->grve_label_text ) && !empty( $item->grve_label_text ) ) {
				$item_output .= '<span class="label">' . esc_html( $item->grve_label_text ) . '</span>';
			}
			$item_output .= $args->link_after;

			$item_output .= '</a>';

			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}


	}
}