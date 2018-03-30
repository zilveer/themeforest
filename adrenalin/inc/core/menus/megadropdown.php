<?php

// **********************************************************************// 
// Primary Menu Walker
// **********************************************************************// 

class primary_cg_menu extends Walker_Nav_Menu {

    private $curItem;

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $display_depth = ($depth + 1);
        if ( $display_depth == '1' ) {
            $class_names = 'cg-submenu-ddown';
            $container = 'container';
        } else {
            $class_names = 'cg-submenu';
            $container = '';
        }

        $indent = str_repeat( "\t", $depth );

        $output .= "\n$indent<div class=" . $class_names . "><div class='" . $container . "'>\n";
        if ( $display_depth == '1' ) {
            $output .= "<div class=\"cg-menu-img\"><span class=\"cg-menu-title-wrap\"><span class=\"cg-menu-title\">" . $this->curItem->title . "</span></span></div><ul class=\"cg-menu-ul\">\n";
        } else {
            $output .= "<ul>";
        }
    }

    function end_lvl( &$output, $depth = 1, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "$indent</ul></div></div>\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $this->curItem = $item;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : ( array ) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .=!empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .=!empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        $attributes .=!empty( $item->url ) ? ' href="' . apply_filters( 'custom_menu_link', esc_attr( $item->url ) ) . '"' : '';

        $description = '';
        if ( strpos( $class_names, 'image-item' ) !== false ) {
            $description = '<img src="' . do_shortcode( $item->description ) . '" alt=" "/>';
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= $description;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}

// **********************************************************************// 
// http://codex.wordpress.org/Function_Reference/wp_nav_menu#How_to_add_a_parent_class_for_menu_item
// **********************************************************************// 

add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );

function add_menu_parent_class( $items ) {

    $parents = array();
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'menu-parent-item';
        }
    }

    return $items;
}

/* ----------------------------------------------------------------------------------- */
/*  Mobile menu walker
  /*----------------------------------------------------------------------------------- */

class mobile_cg_menu extends Walker_Nav_Menu {

    // easy way to check it's this walker we're using to mod the output
    function is_mainmenu() {
        return true;
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : ( array ) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $output .= $indent . '<li ' . $value . $class_names . '>';

        $attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .=!empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .=!empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        $attributes .=!empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

        $prepend = '';
        $append = '';
        $description = !empty( $item->description ) ? '<span>' . esc_attr( $item->description ) . '</span>' : '';

        if ( $depth != 0 ) {
            $description = $append = $prepend = "";
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '><span>';
        $item_output .= $args->link_before . $prepend . apply_filters( 'the_title', $item->title, $item->ID ) . $append;
        $item_output .= '</span></a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}
