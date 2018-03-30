<?php
class Dt_Walker_Nav_Menu extends Walker_Nav_Menu {
	private $dt_options = array();
	private $dt_menu_parents = array();
	private $dt_last_elem = 1;
	private $dt_count = 1;
	private $dt_is_first = true;

	function __construct( $options = array() ) {
		if( method_exists('Walker_Nav_Menu','__construct') ){
			parent::__construct();
		}
		
		if( is_array($options) ){
			$this->dt_options = $options;
		}
	}
	
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= $args->dt_submenu_wrap_start;
		$this->dt_is_first = true;
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= $args->dt_submenu_wrap_end;
	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {

			$this->dt_menu_extra_prepare();

			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$first_class = '';
			$act_class = '';

			// current element
			if( in_array( 'current-menu-item',  $classes) ||
				in_array( 'current-menu-parent',  $classes) ||
				in_array( 'current-menu-ancestor',  $classes)
			){
				$classes[] = $args->dt_act_class;
			}

			if( in_array( 'current-menu-item',  $classes) )
				$act_class = $args->dt_act_class;

			if( $this->dt_is_first ) {
				$classes[] = 'first';
				$first_class = 'class="first"';
			}

			$dt_is_parent = in_array( $item->ID, $this->dt_menu_parents );

			// nonclicable parent menu items
			$attributes = '';
			
			if( !$args->parent_clicable && $dt_is_parent ){
				$classes[] = 'click-auto';
				$attributes = '" onclick="JavaScript: return false;"';
				$attributes .= ' style="cursor: default;';
			}
			
			
			$attributes .= !empty( $item->target ) ? '" target="'. esc_attr( $item->target ) : '';
			$attributes .= !empty( $item->xfn ) ? '" rel="'. esc_attr( $item->xfn ) : '';
			
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$dt_title = apply_filters( 'the_title', $item->title, $item->ID ); 
			if( $dt_is_parent ) {
				$dt_title .= '<span></span>';
			}

			$output .= str_replace(
				array( '%ITEM_HREF%', '%ITEM_TITLE%', '%ESC_ITEM_TITLE%', '%ITEM_CLASS%', '%IS_FIRST%', '%DEPTH%', '%ACT_CLASS%' ),
				array(
					$item->url . $attributes,
					$args->link_before . $dt_title . $args->link_after,
					!empty($item->attr_title) ? ' title="'. esc_attr( $item->attr_title ). '"':'',
					$class_names,
					$first_class,
					$depth+1,
					$act_class
				),
				$args->dt_item_wrap_start
			);
			$this->dt_count++;
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= $args->dt_item_wrap_end;
		$this->dt_is_first = false;
	}

	function dt_menu_extra_prepare () {
		global $wp_object_cache;

		if ( $this->dt_menu_parents || empty( $wp_object_cache->cache['posts'] ) ) { return false; }

		// get menu items from cache
		$menu_items = array();
		foreach ( $wp_object_cache->cache['posts'] as $menu_item ) {
			if ( ! isset( $menu_item->post_type ) ) { continue; }
			if ( 'nav_menu_item' != $menu_item->post_type ) { continue; }
			$menu_items[ $menu_item->ID ] = $menu_item;
		}

		// form menu items parents array
		$prev = 0;
		foreach ( $menu_items as $menu_item ){
			
			// get menu item meta from cache
			$item_meta = wp_cache_get( $menu_item->ID, 'post_meta' );
			
			// get menu item parent
			$menu_item_parent = isset( $item_meta['_menu_item_menu_item_parent'] ) ? intval( $item_meta['_menu_item_menu_item_parent'][0] ) : 0;
			
			// nonclicable parent menu items
			if ( $prev != $menu_item_parent && $menu_item_parent ) {
				$this->dt_menu_parents[] = $menu_item_parent;
				$prev = $menu_item_parent;
			}
			
			// last menu item
			if ( ! $menu_item_parent ){
				$this->dt_last_elem = $menu_item->ID;
			}
		}
		$this->dt_menu_parents = array_unique( $this->dt_menu_parents );
	}
}
