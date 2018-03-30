<?php

    /**
     * Custom Walker
     *
     * @access      public
     * @since       1.0
     * @return      void
     */
    class sf_alt_menu_walker extends Walker_Nav_Menu {

        function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {

            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $class_names = $value = $mega_menu_cols = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

            $loggedinvis    = empty( $item->loggedinvis ) ? "" : "sf-menu-item-loggedin";
            $loggedoutvis   = empty( $item->loggedoutvis ) ? "" : "sf-menu-item-loggedout";
            $hashtmlcontent = empty( $item->htmlcontent ) ? "" : "sf-menu-item-html";

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
            $class_names = ' class="menu-item-' . $item->ID . ' ' . esc_attr( $class_names ) . ' ' . $loggedinvis . ' ' . $loggedoutvis . ' ' . $hashtmlcontent . '"';

            $output .= $indent . '<li ' . $value . $class_names . '>';

            $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
            $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
            $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

            $prepend = '<span class="menu-item-text">';
            $append  = '</span>';
            $append = '<span class="nav-line"></span>';

            $description = ! empty( $item->description ) ? '<span class="menu-item-desc">' . esc_attr( $item->description ) . '</span>' : '';

            if ( $depth != 0 ) {
                $append = $prepend = "";
            }

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . $prepend;
            if ( ! empty( $item->menuicon ) ) {
                $item_output .= '<i class="' . $item->menuicon . '"></i>';
            }
            $item_output .= apply_filters( 'the_title', $item->title, $item->ID ) . $append;
            //$item_output .= $args->link_after;
            $item_output .= $description . $args->link_after;
            //$item_output .= ' '.$item->subtitle.'</a>';
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

?>