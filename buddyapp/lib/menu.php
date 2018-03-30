<?php

/***************************************************
:: Main menu Navigation Walker
 ***************************************************/

/**
 * Modify some elements for the menu
 */
if (!class_exists('kleo_walker_nav_menu')):

    class kleo_walker_nav_menu extends Walker_Nav_Menu {

        /**
         * @see Walker::start_lvl()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int $depth Depth of page. Used for padding.
         */
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat( "\t", $depth );
            $output .= "\n$indent<ul role=\"menu\" class=\"submenu\">\n";
        }

        /**
         * @see Walker::start_el()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param int $current_page Menu item ID.
         * @param object $args
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            // If item has_children
            if ( $args->has_children ) {
                $class_names .= ' has-submenu';
            }

            if ( in_array( 'current-menu-item', $classes ) )
                $class_names .= ' current';

            if( isset($item->extra) && $item->extra && $item->extra != ' ' ) {
                $class_names .= ' has-submenu';
            }

            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $data_li = $indent . '<li' . $id . $value . $class_names .'>';

            $atts = array();

            $atts['title'] = ! empty( $item->attr_title ) ? $item->attr_title : ( ! empty( $item->title ) ? esc_attr(wp_strip_all_tags($item->title)) : '' );
            $atts['target'] = ! empty( $item->target )        ? $item->target        : '';
            $atts['rel'] = ! empty( $item->xfn )                ? $item->xfn        : '';
            $atts['href'] = ! empty( $item->url ) ? $item->url : '';


            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';

            /* allow shortcodes in item title */
            $item->title = do_shortcode( $item->title );


            /* Menu icons */
            $title_icon = kleo_get_menu_icon( $item->icon, $depth, $args );
            if ( $title_icon ) {
                $item_output .= '<i class="icon-' . $title_icon . '" '.( $item->icon_color ? 'style="color:' . $item->icon_color . '"' : '' ).'></i> ';
            }

            if ( $args->theme_location == 'top-left' && $title_icon == '-none-' ) {
                $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
            } else {
                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            }

            /* allow placeholders after the title */
            if ( strpos($item->attr_title, '##' ) !== false) {
                $item_output .= $item->attr_title;
            }

            $item_output .= ( $args->has_children && $depth < 3 ) ? '</a> <span class="menu-arrow"></span>' : '</a>';
            $item_output .= $args->after;

            //custom filters
            $css_target = preg_match( '/\skleo-(.*)-nav/', implode( ' ', $item->classes), $matches );

            // If this isn't a KLEO menu item, we can stop here
            if ( ! empty( $matches[1] ) ) {
                $item_output = apply_filters( 'walker_nav_menu_start_el_' . $matches[1], $item_output, $item, $depth, $args );
                $data_li = apply_filters( 'walker_nav_menu_start_el_li_' . $matches[1], $data_li, $item, $depth, $args);
            }

            $output .= $data_li;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

            if( isset($item->extra) && $item->extra && $item->extra != ' ' ) {
                $output .= '<ul class="submenu"><li>' . do_shortcode($item->extra) . '</li></ul>';
            }

        }


        /**
         * Traverse elements to create list from elements.
         *
         * Display one element if the element doesn't have any children otherwise,
         * display the element and its children. Will only traverse up to the max
         * depth and no ignore elements under that depth.
         *
         * This method shouldn't be called directly, use the walk() method instead.
         *
         * @see Walker::start_el()
         * @since 2.5.0
         *
         * @param object $element Data object
         * @param array $children_elements List of elements to continue traversing.
         * @param int $max_depth Max depth to traverse.
         * @param int $depth Depth of current element.
         * @param array $args
         * @param string $output Passed by reference. Used to append additional content.
         * @return null Null on failure with no changes to parameters.
         */
        public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
            if ( ! $element )
                return;

            if ( $depth == 1) {
                if (isset($this->my_count)) {
                    $this->my_count++;
                } else {
                    $this->my_count = 1;
                }
            }

            $id_field = $this->db_fields['id'];

            // Display this element.
            if ( is_object( $args[0] ) ) {

                //hide if the menu arguments asks as to
                if( $depth == 1 && isset( $args[0]->max_elements) && $this->my_count > $args[0]->max_elements ) {
                    return;
                }

                $args[0]->has_children = !empty($children_elements[$element->$id_field]);
            }

            parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }

        /**
         * Menu Fallback
         * =============
         * If this function is assigned to the wp_nav_menu's fallback_cb variable
         * and a menu has not been assigned to the theme location in the WordPress
         * menu manager the function with display nothing to a non-logged in user,
         * and will add a link to the WordPress menu manager if logged in as an admin.
         *
         * @param array $args passed from the wp_nav_menu function.
         *
         */
        public static function fallback( $args ) {
            if ( current_user_can( 'manage_options' ) ) {

                extract( $args );

                $fb_output = null;

                if ( $container ) {
                    $fb_output = '<' . $container;

                    if ( $container_id )
                        $fb_output .= ' id="' . $container_id . '"';

                    if ( $container_class )
                        $fb_output .= ' class="' . $container_class . '"';

                    $fb_output .= '>';
                }

                $fb_output .= '<ul';

                if ( $menu_id )
                    $fb_output .= ' id="' . $menu_id . '"';

                if ( $menu_class )
                    $fb_output .= ' class="' . $menu_class . '"';

                $fb_output .= '>';
                $fb_output .= '<li><a title="' . esc_html__( "Add a menu", 'buddyapp' ) . '" href="' . admin_url( 'nav-menus.php' ) . '">' .
                    '<i class="icon-add-circle-outline"></i> <span>' . esc_html__( "Add a menu", 'buddyapp' ) . '</span>' .
                    '</a></li>';
                $fb_output .= '</ul>';

                if ( $container )
                    $fb_output .= '</' . $container . '>';

                return $fb_output;
            }
        }
    }

endif;
//------------------------------------------------------------------------------


if ( ! function_exists( 'kleo_side_pages_nav' ) ) {

    function kleo_side_pages_nav()
    {
        $pages_args = array(
            'depth' => 1,
            'echo' => false,
            'exclude' => '',
            'title_li' => '',
            'link_before' => '<i class="icon-'. Kleo::get_config('menu_icon_default') .'"></i> <span>',
            'link_after' => '</span>'
        );
        $menu = wp_page_menu($pages_args);
        $menu = str_replace(array('<div class="menu"><ul>', '</ul></div>'), array('<ul class="menu-list kleo-nav-menu">', '</ul>'), $menu);
        return $menu;
    }
}



/* helpers */

function kleo_get_menu_icon( $icon, $depth, $args, $default = false ) {

    $title_icon = '';
    if ( $default === false ) {
        $default_icon = Kleo::get_config('menu_icon_default');
        $default = sq_option( 'menu_icon', $default_icon ) ;
    }

    if (isset( $icon ) && $icon ) {
        $title_icon = $icon;
    }
    elseif ( $depth == 0 ) {
        $title_icon = $default;
    }

    if ( $args->theme_location == 'primary' && $title_icon == '-none-'  ) {
        $title_icon = $default;
    }

    return $title_icon;
}