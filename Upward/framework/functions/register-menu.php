<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - REGISTRATION

	2 - WALKERS

		2.1 - Walker
		2.2 - Walker Drop-Down

	3 - FALLBACKS

		3.1 - Primary
		3.2 - Primary drop-down
		3.3 - Secondary

	4 - DISPLAY

		4.1 - Primary
		4.2 - Secondary
		4.3 - Drop-Down

*/

/*= 1 ===========================================

	R E G I S T R A T I O N
	Register menu

===============================================*/

	function st_register_menu() {

		global
			$st_Options;

			$menus = array();
	
			if ( $st_Options['menu']['primary'] ) {
				$menus['menu-1'] = __( 'Primary Menu', 'strictthemes' ); }
	
			if ( $st_Options['menu']['secondary'] ) {
				$menus['menu-2'] = __( 'Secondary Menu', 'strictthemes' ); }
	
			register_nav_menus( $menus );

	}

	add_action( 'init', 'st_register_menu' );



/*= 2 ===========================================

	W A L K E R S
	Menu walkers

===============================================*/

	/*-------------------------------------------
		2.1 - Walker
	-------------------------------------------*/

	class Walker_Nav_Menu_Main extends Walker_Nav_Menu {

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			global
				$wp_query;

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
				$class_names = $value = '';
		
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
				$class_names = ' class="' . esc_attr( $class_names ) . '"';
	
				// Prepare LI
				$output .= $indent . '<li' . $value . $class_names .'>';
	
				// Attributes	
				$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
				$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
				$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
	
				// Prepare A
				$item_output = '<a ' . $attributes . '>';
				$subline = $item->attr_title ? '<span class="subline">' . $item->attr_title . '</span>' : '';
				$item_output .= apply_filters( 'the_title', $item->title, $item->ID ) . $subline;
				$item_output .= '</a>';
	
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}

	}


	/*-------------------------------------------
		2.2 - Walker Drop-Down
	-------------------------------------------*/

	class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{

		function start_lvl( &$output, $depth = 0, $args = array() ) {
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){
	
			global $wp_query;

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$classes[] = 'menu-item-' . $item->ID;

			$selected = '';

			foreach ( $classes as &$class ) {
				if ( $class == 'current-menu-item' ) {
					$selected = ' selected';
				}
			}

			$output .= '<option value="' . $item->url . '"' . $selected . '>';
	
			$item->title = str_repeat("-&nbsp;", $depth * 1) . $item->title;
	
			$item_output = apply_filters( 'the_title', $item->title, $item->ID ) . "</option>\n";
	
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	
		}

		function end_el( &$output, $item, $depth = 0, $args = array() ) {
		}

	}



/*= 3 ===========================================

	F A L L B A C K S
	Menu fallbacks

===============================================*/

	/*-------------------------------------------
		3.1 - Primary
	-------------------------------------------*/

	function primary_fallback_menu() {

		$current = '';

		if (is_front_page()) {
			$current = ' class="current-menu-ancestor"'; }

		echo '<div id="menu-box"><ul class="menu" id="menu-by-default">';
			wp_list_pages('title_li=&sort_column=menu_order');
		echo '</ul></div>';

	}


	/*-------------------------------------------
		3.2 - Primary drop-down
	-------------------------------------------*/

	function dropdown_fallback_menu() {

		echo '<div id="menu-select">';
			echo '<form action="' . home_url() . '" method="get">';
					wp_dropdown_pages();
			echo '</form>';
		echo '</div>';

	}


	/*-------------------------------------------
		3.3 - Secondary
	-------------------------------------------*/

	function secondary_fallback_menu() {

		return;

	}



/*= 4 ===========================================

	D I S P L A Y
	Display menu

===============================================*/

	/*-------------------------------------------
		4.1 - Primary
	-------------------------------------------*/

	function st_menu_primary() {

		wp_nav_menu( array(
			'theme_location'	=> 'menu-1',
			'sort_column'		=> 'menu_order',
			'container_class'	=> '',
			'container_id'		=> 'menu-box',
			'echo'				=> true,
			'depth'				=> 0,
			'fallback_cb'		=> 'primary_fallback_menu',
			'context'			=> 'frontend',
			'items_wrap'		=> '<nav><ul class="menu">%3$s</ul></nav>',
			'walker'			=> new Walker_Nav_Menu_Main()
			)
		);

	}


	/*-------------------------------------------
		4.2 - Secondary
	-------------------------------------------*/

	function st_menu_secondary() {

		wp_nav_menu( array(
			'theme_location'	=> 'menu-2',
			'sort_column'		=> 'menu_order',
			'container_class'	=> ' ',
			'container_id'		=> 'menu-2',
			'echo'				=> true,
			'depth'				=> 0,
			'fallback_cb'		=> 'secondary_fallback_menu',
			'context'			=> 'frontend',
			'items_wrap'		=> '<nav><ul class="menu-2"><li><a href="' . home_url() . '">' . __( 'Home', 'strictthemes' ) . '</a></li>%3$s</ul></nav>'
			)
		);

	}


	/*-------------------------------------------
		4.3 - Drop-Down
	-------------------------------------------*/

	function st_menu_drop_down() {

		wp_nav_menu( array(
			'theme_location' 	=> 'menu-1',
			'echo'				=> true,
			'container_class'	=> '',
			'container_id'		=> 'menu-select',
			'menu_class'		=> 'dropdown-menu',
			'depth'				=> 0,
			'fallback_cb'		=> 'dropdown_fallback_menu',
			'items_wrap'     	=> '<select id="selectElement"><option value="#">' . __( 'Select a page &crarr;', 'strictthemes' ) . '</option>%3$s</select>',
			'walker'        	=> new Walker_Nav_Menu_Dropdown()
			)
		);

	}


?>