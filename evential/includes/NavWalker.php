<?php
/**
 * Evential Wordpress Theme functions and definitions
 *
 * @package Evential
 * @subpackage Evential
 * @since Evential 1.0
 */

add_filter( 'wp_setup_nav_menu_item', 'mp_add_custom_nav_fields' );

// save menu custom fields
add_action( 'wp_update_nav_menu_item', 'mp_update_custom_nav_fields', 10, 3 );

// edit menu walker
add_filter( 'wp_edit_nav_menu_walker', 'mp_edit_walker', 10, 2 );


function mp_add_custom_nav_fields( $menu_item ) {

    $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
    $menu_item->color = get_post_meta( $menu_item->ID, '_menu_item_color', true );
    $menu_item->colors = get_post_meta( $menu_item->ID, '_menu_item_colors', true );
    $menu_item->subtitle = get_post_meta( $menu_item->ID, '_menu_item_subtitle', true );
    $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
    $menu_item->column_title = get_post_meta( $menu_item->ID, '_menu_item_column_title', true );
    return $menu_item;

}

function mp_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

    $check = array('icon', 'color', 'colors', 'subtitle', 'megamenu', 'column_title');

    foreach ( $check as $key )
    {
        if(!isset($_POST['menu-item-'.$key][$menu_item_db_id]))
        {
            $_POST['menu-item-'.$key][$menu_item_db_id] = "";
        }

        $value = $_POST['menu-item-'.$key][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_'.$key, $value );
    }

}

function mp_edit_walker( $walker, $menu_id ) {

    return 'Walker_Nav_Menu_Edit_Custom';

}
require dirname(__FILE__) . '/edit_custom_walker.php';


class eventialControllerExtensionNavWalker extends Walker_Nav_Menu {

    /**
     * What the class handles.
     *
     * @see Walker::$tree_type
     * @since 3.0.0
     * @var string
     */
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

    var $zen_megamenu = false;

    /**
     * Database fields to use.
     *
     * @see Walker::$db_fields
     * @since 3.0.0
     * @todo Decouple this.
     * @var array
     */
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

    /**
     * Starts the list before the elements are added.
     *
     * @see Walker::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);

        if($depth == 0) {
            if( !$this->zen_megamenu ) {
                $output .= "\n$indent<ul class=\"sub-menu\">\n";
            } else {
                $output .= "\n$indent<ul class=\"big-sub-menu\">\n";
                $output .= "\n$indent<ul class=\"clearfix\">\n";
            }
        } else {
            $output .= "\n$indent<ul class=\"sub-menu\">\n";
        }


    }

    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker::end_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);

        if($depth == 0) {
            if( !$this->zen_megamenu ) {
                $output .= "$indent</ul>\n";
            } else {
                $output .= "$indent</ul></ul>\n";
            }
        } else {
            $output .= "$indent</ul>\n";
        }
    }

    /**
     * Start the element output.
     *
     * @see Walker::start_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        /**
         * Test if Mega Menu is activated for the first parent
         *
         * @since 1.2.0
         * @author StylishThemes
         */
        if( $depth == 0 ) {
            if( $item->megamenu == 'on' ) {
                $this->zen_megamenu = true;
            } else {
                $this->zen_megamenu = false;
            }
        }

        /**
         * Filter the CSS class(es) applied to a menu item's <li>.
         *
         * @since 3.0.0
         *
         * @param array  $classes The CSS classes that are applied to the menu item's <li>.
         * @param object $item    The current menu item.
         * @param array  $args    An array of arguments. @see wp_nav_menu()
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        /**
         * Filter the ID applied to a menu item's <li>.
         *
         * @since 3.0.1
         *
         * @param string The ID that is applied to the menu item's <li>.
         * @param object $item The current menu item.
         * @param array $args An array of arguments. @see wp_nav_menu()
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .' style="background:'.$item->color.'">';

        if($this->zen_megamenu && $depth == 1) {
            $output .= $indent . '<ul><li>';
        }

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
         * @param array $atts {
         *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
         *
         *     @type string $title  The title attribute.
         *     @type string $target The target attribute.
         *     @type string $rel    The rel attribute.
         *     @type string $href   The href attribute.
         * }
         * @param object $item The current menu item.
         * @param array  $args An array of arguments. @see wp_nav_menu()
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        if ($depth == 1 && $item->column_title == 'on') {

            $item_output = $args->before;

            $item_output .= $args->after;

        } else {

            $item_output = '';
            if($depth == 1 && $this->zen_megamenu) {
                $item_output .= '<a>';
            } else {
                $item_output .= '<a data-scroll '. $attributes .'>'.$item->title.'';
            }

            if($depth == 0 && $item->icon != '') { $item_output .= '<span class="'.$item->icon.'"></span>';}
            // if($depth == 0) { $item_output .= '<section><h1>'; }
            // /** This filter is documented in wp-includes/post-template.php */
            // $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            // if($depth == 0) { $item_output .= '</h1>'; }
            // if($item->subtitle != '' && $depth == 0) { $item_output .= '<h2>' . $item->subtitle . '</h2>'; }
            $item_output .= '</a>';

        }

        /**
         * Filter a menu item's starting output.
         *
         * The menu item's starting output only includes $args->before, the opening <a>,
         * the menu item's title, the closing </a>, and $args->after. Currently, there is
         * no filter for modifying the opening and closing <li> for a menu item.
         *
         * @since 3.0.0
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param object $item        Menu item data object.
         * @param int    $depth       Depth of menu item. Used for padding.
         * @param array  $args        An array of arguments. @see wp_nav_menu()
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    /**
     * Ends the element output, if needed.
     *
     * @see Walker::end_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Page data object. Not used.
     * @param int    $depth  Depth of page. Not Used.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function end_el( &$output, $item, $depth = 0, $args = array() ) {

        if($this->zen_megamenu && $depth == 1) {
            $output .= '</li></ul>';
        }

        $output .= "</li>\n";
    }

}