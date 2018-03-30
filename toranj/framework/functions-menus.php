<?php
/**
 *  Register and config menus of the theme
 * 
 * @package toranj
 * @author owwwlab
 */

/**
 * ----------------------------------------------------------------------------------------
 * Set up register menus
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_toranj_menus_setup' ) ) {
	function owlab_toranj_menus_setup() {

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'toranj' ),
				'woocommerce-menu' => __( 'WooCommerce guest menu', 'toranj' ),
				'woocommerce-menu-logged-in' => __( 'WooCommerce members menu', 'toranj' ),
			)
		);

	}

	add_action( 'after_setup_theme', 'owlab_toranj_menus_setup' );
}


/**
 * ----------------------------------------------------------------------------------------
 * Overwrite wp_nav_menus, this is the core of our sidebar menu
 * ----------------------------------------------------------------------------------------
 */
class toranj_walker extends Walker_Nav_Menu {
	
	private $parent_title;

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n<li class=\"nav-prev\"><a href=\"#\"><i class=\"fa fa-angle-left\"></i>$this->parent_title</a></li>\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = '';
		if ( property_exists($args, 'before') )
			$item_output = $args->before;
		
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		if (property_exists($args, 'link_before'))
			$item_output .= $args->link_before;

		$item_output .= apply_filters( 'the_title', $item->title, $item->ID );

		if (property_exists($args, 'link_after'))
			$item_output .= $args->link_after;

		$item_output .= '</a>';
		if (property_exists($args, 'after'))
			$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		//if ($depth==0){
			$this->parent_title=($item->title);
		//}
	}
	

}