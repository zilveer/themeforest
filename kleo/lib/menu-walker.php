<?php
/**
 * Menu Walker for KLEO theme
 * @author: SeventhQueen
 *
 */


/**
 * Modify some elements for the menu
 */
if ( ! class_exists( 'kleo_walker_nav_menu' ) ) {

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
			$output .= "\n$indent<ul role=\"menu\" class=\"dropdown-menu sub-menu".($depth ===0?" pull-left":"")."\">\n";
		}

		/**
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param array $args
		 * @param int $id Menu item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			/**
			 * Dividers, Headers or Disabled
			 * =============================
			 * Determine whether the item is a Divider, Header, Disabled or regular
			 * menu item. To prevent errors we use the strcasecmp() function to so a
			 * comparison that is not case sensitive. The strcasecmp() function returns
			 * a 0 if the strings are equal.
			 */
			if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
			} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
				$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
			} else {

				$class_names = $value = '';

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = 'menu-item-' . $item->ID;

				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

				if ( $args->has_children && $depth === 1 ) {
					$class_names .= ' dropdown-submenu';
				}
				elseif($args->has_children) {
					$class_names .= ' dropdown';
					if ($item->mega == 'yes') {
						$class_names .= ' kleo-megamenu';
					}
					$submenus = $depth == 0 ? get_posts( array( 'post_type' => 'nav_menu_item', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'meta_query' => array( array( 'key' => '_menu_item_menu_item_parent', 'value' => $item->ID ) ) ) ) : false;
					$count = $submenus ? count( $submenus ) : 'no';

					$class_names .= ' mega-' . $count . '-cols';
				}

				if ( in_array( 'current-menu-item', $classes ) ) {
					$class_names .= ' active';
				}

				if ( $depth === 0 && isset( $item->istyle ) && $item->istyle == 'border' ) {
					$class_names .= ' has-btn-see-through';
				}
				
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

				$data_li = $indent . '<li' . $id . $value . $class_names .'>';

				$atts = array();
				if (strpos($item->attr_title,'class=') !== false) {
					$atts['class'] = (isset($atts['class']) ? $atts['class']." " : '') . str_replace('class=', '', $item->attr_title);
				}else {
					$atts['title'] = ! empty( $item->attr_title ) ? $item->attr_title : ( ! empty( $item->title ) ? esc_attr(wp_strip_all_tags($item->title)) : '' );
				}
				$atts['target'] = ! empty( $item->target )        ? $item->target        : '';
				$atts['rel'] = ! empty( $item->xfn )                ? $item->xfn        : '';

				// If item has_children add atts to a.
				if ( $args->has_children && $depth === 0 ) {
					//$atts['href']				= '#';
					$atts['href']					= ! empty( $item->url ) ? $item->url : '';
					//$atts['data-toggle']	= 'dropdown';
					$atts['class']				= 'js-activated';
				} else {
					$atts['href'] = ! empty( $item->url ) ? $item->url : '';
				}

				if ( $depth === 0 && isset( $item->istyle ) ) {
					if ( $item->istyle == 'buy' ) {
						$atts['class'] = (isset($atts['class']) ? $atts['class'] : '' ) . ' btn-buy';
					} elseif( $item->istyle == 'border' ) {
						$atts['class'] =  (isset($atts['class']) ? $atts['class'] : '' ) . ' btn btn-see-through';
					} elseif( $item->istyle == 'highlight' ) {
						$atts['class'] =  (isset($atts['class']) ? $atts['class'] : '' ) . ' btn btn-highlight';
					}
				}



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
				if (isset( $item->icon ) && $item->icon != '') {
					$title_icon = '<i class="icon-' . $item->icon . '"></i>';

					if ( $item->iconpos == 'after' ) {
						$title = $item->title . ' ' . $title_icon;
					}
					elseif ( $item->iconpos == 'icon' ) {
						$title = $title_icon;
					}
					else {
						$title = $title_icon . ' ' . $item->title;
					}
				}
				else {
					$title = $item->title;
				}

				$item_output .= $args->link_before . apply_filters( 'the_title', $title, $item->ID ) . $args->link_after;

				$item_output .= ( $args->has_children && in_array($depth, array(0,1))) ? ' <span class="caret"></span></a>' : '</a>';
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

			$id_field = $this->db_fields['id'];

			// Display this element.
			if ( is_object( $args[0] ) )
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

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
				$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
				$fb_output .= '</ul>';

				if ( $container )
					$fb_output .= '</' . $container . '>';

				echo $fb_output;
			}
		}
	}

}

