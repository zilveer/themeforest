<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_Custom_Fields_Nav_Walker' ) ) {

	class Wolf_Custom_Fields_Nav_Walker extends Walker_Nav_Menu {

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			if ( get_post_meta( $item->ID, '_mega-menu', true ) )
				$classes[] = 'mega-menu';

			//if ( get_post_meta( $item->ID, 'mega-menu-cols', true ) )
				//$classes[] = 'mega-menu-cols-' . get_post_meta( $item->ID, 'mega-menu-cols', true );

			if ( get_post_meta( $item->ID, '_menu-item-not-linked', true ) )
				$classes[] = 'not-linked';

			if ( get_post_meta( $item->ID, '_menu-item-hidden', true ) )
				$classes[] = 'hidden';

			if ( get_post_meta( $item->ID, '_menu-item-button-style', true ) )
				$classes[] = 'button-style';

			if ( get_post_meta( $item->ID, '_menu-item-external', true ) )
				$classes[] = 'external';

			// sub menu skin
			$sub_menu_skin = ( get_post_meta( $item->ID, '_sub-menu-skin', true ) ) ? get_post_meta( $item->ID, '_sub-menu-skin', true ) : 'sub-menu-dark';
			$classes[] = $sub_menu_skin;

			// background
			$img_id = get_post_meta( $item->ID, '_menu-item-background', true );
			$mega_menu_bg = ( $img_id ) ? esc_url( wolf_get_url_from_attachment_id( absint( $img_id ), 'extra-large' ) ) : '';
			$data_bg = ( $mega_menu_bg ) ? " data-mega-menu-bg='$mega_menu_bg'" : '';
			$bg_repeat = get_post_meta( $item->ID, '_menu-item-background-repeat', true );
			$data_bg_repeat = ( $bg_repeat ) ? " data-mega-menu-bg-repeat='$bg_repeat'" : '';

			// icon position
			$icon_position = ( get_post_meta( $item->ID, '_menu-item-icon-position', true ) ) ? get_post_meta( $item->ID, '_menu-item-icon-position', true ) : 'before';
			$classes[] = "menu-item-icon-$icon_position";

			// var_dump( $classes );

			/**
			 * Filter the CSS class(es) applied to a menu item's <li>.
			 *
			 * @since 3.0.0
			 *
			 * @see wp_nav_menu()
			 *
			 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of wp_nav_menu() arguments.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filter the ID applied to a menu item's <li>.
			 *
			 * @since 3.0.1
			 *
			 * @see wp_nav_menu()
			 *
			 * @param string $menu_id The ID that is applied to the menu item's <li>.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of wp_nav_menu() arguments.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';


			$output .= $indent . '<li' . $id . $class_names . $data_bg . $data_bg_repeat . '>';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

			/**
			 * Filter the HTML attributes applied to a menu item's <a>.
			 *
			 * @since 3.6.0
			 *
			 * @see wp_nav_menu()
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
			 *
			 *     @type string $title  Title attribute.
			 *     @type string $target Target attribute.
			 *     @type string $rel    The rel attribute.
			 *     @type string $href   The href attribute.
			 * }
			 * @param object $item The current menu item.
			 * @param array  $args An array of wp_nav_menu() arguments.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			if ( ! is_object( $args ) ) {
				$args = new stdClass();
				$args->before = '';
				$args->link_before = '';
				$args->link_after = '';
				$args->after = '';
			}

			$item_output = $args->before;

			if ( get_post_meta( $item->ID, '_menu-item-scroll', true ) )
				$item_output .= '<a'. $attributes .' class="scroll"><span>';
			else
				$item_output .= '<a'. $attributes .'><span>';

			/** This filter is documented in wp-includes/post-template.php */

			if ( get_post_meta( $item->ID, '_menu-item-icon', true ) && 'before' == $icon_position )   {
				$item_output .= '<i class="fa ' . get_post_meta( $item->ID, '_menu-item-icon', true ) . '"></i>';
			}

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

			if ( get_post_meta( $item->ID, '_menu-item-icon', true ) && 'after' == $icon_position )   {
				$item_output .= '<i class="fa ' . get_post_meta( $item->ID, '_menu-item-icon', true ) . '"></i>';
			}

			$item_output .= '</span></a>';
			$item_output .= $args->after;

			/**
			 * Filter a menu item's starting output.
			 *
			 * The menu item's starting output only includes $args->before, the opening <a>,
			 * the menu item's title, the closing </a>, and $args->after. Currently, there is
			 * no filter for modifying the opening and closing <li> for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @see wp_nav_menu()
			 *
			 * @param string $item_output The menu item's starting HTML output.
			 * @param object $item        Menu item data object.
			 * @param int    $depth       Depth of menu item. Used for padding.
			 * @param array  $args        An array of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}