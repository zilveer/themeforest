<?php if(! defined('ABSPATH')){ return; }

class ZnMegaMenu{

	function __construct(){

		if( ZN()->is_request( 'admin' ) ){
			require(FW_PATH .'/classes/class-mega-menu-admin.php');
		}

		// ADD THE MEGA MENU WALKER AND CLASSES
		add_filter( 'wp_nav_menu_args', array( &$this, 'enable_custom_walker' ), 100);

	}



	/**
	 * Replaces the default arguments for the front end menu creation with new ones
	 */
	function enable_custom_walker( $arguments ) {

		if ( $arguments['walker'] == 'znmegamenu' )
		{
			$arguments['walker'] 				= new ZnWalkerNavMenu();
			$arguments['container_class'] 		= $arguments['container_class'] .= ' zn_mega_wrapper ';
			$arguments['menu_class']			= $arguments['menu_class'] .= ' zn_mega_menu ';
		}

		return $arguments;
	}


}

/**
 * Create HTML list of nav menu items. ( COPIED FROM DEFAULT WALKER )
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker
 */
class ZnWalkerNavMenu extends Walker {
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
	var $mm_active = false;
	var $max_columns = 4;
	var $columns = 0;
	var $childrens_count = 0;

	function __construct(){
		$this->max_columns = apply_filters( 'zn_mega_menu_columns', 4 );
	}


	/**
	 * Perform several checks and fill the class values
	 *
	 * @param string $element The current menu item
	 * @param int    $children_elements  The element childrens
	 * @param array  $max_depth
	 * @param array  $depth
	 * @param array  $args
	 * @param array  $output
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if( $depth === 0 )
		{
			// CHECK IF MENU IS ACTIVE
			$this->mm_active = get_post_meta( $element->ID, '_menu_item_zn_mega_menu_enable', true);

			// COUNT ALL MEGA MENU CHILDRENS
			if ( $this->mm_active && !empty( $children_elements[$element->ID] ) ) {

				$this->childrens_count = count( $children_elements[$element->ID] );

			}
		}

		// DO THE NORMAL display_element();
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

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

		// ADD THE MEGA MENU WRAPPER
		if ( $depth === 0 && $this->mm_active )
		{
			$output .= "\n$indent<div class='zn_mega_container container'><ul class=\"clearfix\">\n";

		}
		else {
			if( $this->mm_active ){
				$output .= "\n$indent<ul class=\"clearfix\">\n";
			}
			else{
				$output .= "\n$indent<ul class=\"sub-menu clearfix\">\n";
			}

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
		$output .= "$indent</ul>\n";

		if ( $depth === 0 ) {
			if ( $this->mm_active )
			{
				// RESET THE COUNTERS
				$output .= "</div>";
				$this->columns = 0;
			}
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

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item-top' : 'main-menu-item-sub' ),
			( $depth >=2 ? 'main-menu-item-sub-sub' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = ' '.esc_attr( implode( ' ', $depth_classes ) );

		$class_names = $value = $column_class = '';

		// ONLY CHECK ON LEVEL 1 SUBMENUS
		if ( $depth == 1 && $this->mm_active ) {

			$this->columns++;

			if ( $this->childrens_count > $this->max_columns )
			{
				// CHECK IF WE HAVE MORE COLUMNS THAN THE MAX COLUMNS
				if ( $this->columns > $this->max_columns )
				{

					$output .= "\n</ul><ul class=\"zn_mega_row_start\">\n";

					if ( $this->childrens_count - $this->max_columns < $this->childrens_count )
					{

						$column_class = zn_get_col_size( $this->max_columns );
					}
					else
					{
						$column_class = zn_get_col_size( $this->childrens_count - $this->max_columns );
					}
					$this->columns = 1;
				}
				else
				{
					$column_class = zn_get_col_size(  $this->max_columns );
				}
			}
			else
			{
				$column_class = zn_get_col_size(  $this->childrens_count );
			}
		}


		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Added mega menu class to parent li
		if ( $depth === 0 && $this->mm_active ){
			$classes[] = 'menu-item-mega-parent';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="main-menu-item ' . esc_attr( $class_names ) . ' ' .$column_class . $depth_class_names . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts['class']  = ! empty( $item->class )      ? $item->class      : '';
		$atts['class'] .= ' main-menu-link ' . ( $depth > 0 ? 'main-menu-link-sub' : 'main-menu-link-top' );

		// STYLE THE SUBMENU TITLES
		if ( $depth == 1 && $this->mm_active )
		{
			$atts['class']   .= ' zn_mega_title ';
		}

		if ( $depth == 1 && $this->mm_active && get_post_meta( $item->ID, '_menu_item_zn_mega_menu_headers', true) )
		{
			$atts['class']   .= ' zn_mega_title_hide ';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		// SHOW BADGE
		// LABEL
		$key = 'menu_item_zn_mega_menu_label';
		$badge_text = get_post_meta( $item->ID, '_'.$key, true);

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= !empty($badge_text) ? '<span class="zn-mega-new-item">'.$badge_text.'</span>' : '';
		$item_output .= '</a>';
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
		$output .= "</li>\n";
	}

} // Walker_Nav_Menu



?>
