<?php

/**
 * Create HTML list of nav menu items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker
 */
class ShiftNavWalker extends Walker_Nav_Menu {

	private $index = 0;
	protected $menuItemOptions;
	protected $noUberOps;


	/**
	 * What the class handles.
	 *
	 * @see Walker::$tree_type
	 * @since 3.0.0
	 * @var string
	 */
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

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
		$_depth = $depth+1;
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu sub-menu-$_depth\">\n";
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

		//Make Content Customizable
		$output.= '<li class="shiftnav-retract"><a class="shiftnav-target"><i class="fa fa-chevron-left"></i> Back</a></li>';
		//$output.= '<li class="shiftnav-retract">BACK</li>';
		
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
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
		//$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$data = shiftnav_get_menu_item_data( $item->ID );
		//shiftp( $data );
	
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/** ShiftNav Stuff **/
		$shiftnav_atts = array();
		
		//Submenus
		$has_sub = false;
		if( in_array( 'menu-item-has-children' , $classes ) ) $has_sub = true;
		$submenu_type = isset( $data['submenu_type'] ) ? $data['submenu_type'] : 'always';
		if( $has_sub ){
			$classes[] = 'shiftnav-sub-'.$submenu_type;
		}

		//Depth
		$classes[] = 'shiftnav-depth-'.$depth;
		

		//Highlight
		if( isset( $data['highlight'] ) && ( $data['highlight'] == 'on' ) ){
			$classes[] = 'shiftnav-highlight';
		}

		//ScrollTo
		if( isset( $data['scrollto'] ) && $data['scrollto'] != '' ){
			$classes[] = 'shiftnav-scrollto';
			$shiftnav_atts['data-shiftnav-scrolltarget'] = $data['scrollto'];
		}

		//Icon
		$icon = '';
		if( isset( $data['icon'] ) && $data['icon'] != '' ){
			$classes[] = 'shiftnav-has-icon';
			$icon = '<i class="shiftnav-icon '.$data['icon'].'"></i>';
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

		$output .= /* $indent . */ '<li' . $id . $value . $class_names .'>';

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

		//Merge ShiftNav atts
		$atts = array_merge( $atts , $shiftnav_atts );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a class="shiftnav-target" '. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		if( $icon ) $title = '<span class="shiftnav-target-text">'.$title.'</span>';
		$item_output .= $args->link_before . $icon . $title . $args->link_after;

		$item_output .= '</a>';

		if( $has_sub ){
			switch( $submenu_type ){
				case 'shift':
					$item_output.= '<span class="shiftnav-submenu-activation"><i class="fa fa-chevron-right"></i></span>';
					break;
				case 'accordion':
					$item_output.= '<span class="shiftnav-submenu-activation shiftnav-submenu-activation-open"><i class="fa fa-chevron-down"></i></span>';
					$item_output.= '<span class="shiftnav-submenu-activation shiftnav-submenu-activation-close"><i class="fa fa-chevron-up"></i></span>';
					break;
			}
		}
		
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
		$output .= "</li>";
	}



	/* Recursive function to remove all children */
	function clear_children( &$children_elements , $id ){

		if( empty( $children_elements[ $id ] ) ) return;

		foreach( $children_elements[ $id ] as $child ){
			$this->clear_children( $children_elements , $child->ID );
		}
		unset( $children_elements[ $id ] );
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Calls parent function in UberMenuWalker.class.php
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
			return;

		//UberMenu Conditionals
		if( shiftnav_op( 'inherit_ubermenu_conditionals' , 'general' ) == 'on' ){

			$id_field = $this->db_fields['id'];
			$id = $element->$id_field;

			$display_on = apply_filters( 'uberMenu_display_item' , true , $this , $element , $max_depth, $depth, $args );

			if( !$display_on ){
				$this->clear_children( $children_elements , $id );
				return;
			}
		}
		
		Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function getUberOption( $item_id , $id ){
		//get_post_meta or from uber_options, depending on whether uber_options is set

		$option_id = 'menu-item-'.$id;

		//Initialize array
		if( !is_array( $this->menuItemOptions ) ){
			$this->menuItemOptions = array();
			$this->noUberOps = array();
		}

		//We haven't investigated this item yet
		if( !isset( $this->menuItemOptions[ $item_id ] ) ){
			
			$uber_options = false;
			if( empty( $this->noUberOps[ $item_id ] ) ) {
				$uber_options = get_post_meta( $item_id , '_uber_options', true );	//TODO - wrap in API for UberMenu
				if( !$uber_options ) $this->noUberOps[ $item_id ] = true; //don't check again for this menu item
			}

			//If $uber_options are set, use them
			if( $uber_options ){
				$this->menuItemOptions[ $item_id ] = $uber_options;
			} 
			//Otherwise get the old meta
			else{
				$option_id = '_menu_item_'.$id; //UberMenu::convertToOldParameter( $id );
				return get_post_meta( $item_id, $option_id , true );
			}
		}
		return isset( $this->menuItemOptions[ $item_id ][ $option_id ] ) ? stripslashes( $this->menuItemOptions[ $item_id ][ $option_id ] ) : '';
	}

} // Walker_Nav_Menu