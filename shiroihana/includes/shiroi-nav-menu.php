<?php

/* ==========================================================================
	Nav Menus
============================================================================= */

if( ! function_exists( 'shiroi_register_nav_menus' ) ):

function shiroi_register_nav_menus() {

	$nav_menus = array(
		'primary-menu' => __( 'Primary Menu', 'shiroi' ), 
		'secondary-menu' => __( 'Secondary Menu', 'shiroi' )
	);
	register_nav_menus( $nav_menus );
}
endif;
add_action( 'init', 'shiroi_register_nav_menus' );

/* ==========================================================================
	Default Walker Class
============================================================================= */

if( ! class_exists( 'Shiroi_Walker_Nav_Menu' ) ):

class Shiroi_Walker_Nav_Menu extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '<span class="subnav-toggle"></span>';
		parent::start_lvl( $output, $depth, $args );
	}
}
endif;

/* ==========================================================================
	Primary Menu Fallback
============================================================================= */

if( ! function_exists( 'shiroi_fallback_menu_primary' ) ):

function shiroi_fallback_menu_primary() {

	?><div class="primary-nav-wrap">
		<ul class="menu">
			<li class="menu-item menu-item-home<?php if( is_front_page() ) echo esc_attr( ' current-menu-item' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Home', 'shiroi' ); ?></a>
			</li>
			<?php wp_list_pages( 'title_li=&sort_column=menu_order' ); ?>
		</ul>
	</div>
	<?php
}
endif;

/* ==========================================================================
	Secondary Menu Fallback
============================================================================= */

if( ! function_exists( 'shiroi_fallback_menu_secondary' ) ):

function shiroi_fallback_menu_secondary() {
	echo wpautop( Youxi()->option->get( 'top_bar_menu_fallback' ) );
}
endif;
