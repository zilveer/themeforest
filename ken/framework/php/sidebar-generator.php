<?php

class mkSidebarGenerator {
	var $sidebar_names = array();
	var $footer_sidebar_count = 0;
	var $footer_sidebar_names = array();

	function __construct() {

		$this->sidebar_names = array(
			'page'=>__( 'Pages', 'mk_framework' ),
			'single_post'=>__( 'Blog Single', 'mk_framework' ),
			'single_portfolio'=>__( 'Portfolio Single', 'mk_framework' ),
			'search'=>__( 'Search', 'mk_framework' ),
			'404'=>__( '404', 'mk_framework' ),
			'archive'=>__( 'Archive', 'mk_framework' ),
			'woocommerce'=>__( 'Woocommerce Shop', 'mk_framework' ),
			'woocommerce_single'=>__( 'Woocommerce Single', 'mk_framework' ),
			'bbpress'=>__( 'bbPress', 'mk_framework' ),
		);


		$this->footer_sidebar_names = array(
			__( 'Footer Column One', 'mk_framework' ),
			__( 'Footer Column Two', 'mk_framework' ),
			__( 'Footer Column Three', 'mk_framework' ),
			__( 'Footer Column Four', 'mk_framework' ),
			__( 'Footer Column Five', 'mk_framework' ),
			__( 'Footer Column Six', 'mk_framework' ),
		);

	}

	function register_sidebar() {

		$i = 1;

		foreach ( $this->sidebar_names as $name ) {
			register_sidebar( array(
					'name' => $name,
					'id' => 'sidebar-'.$i,
					'description' => $name,
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<div class="widgettitle">',
					'after_title' => '</div>',
				) );

			$i++;
		}
		foreach ( $this->footer_sidebar_names as $name ) {
			register_sidebar( array(
					'name' =>  $name,
					'id' => 'sidebar-'.$i,
					'description' => $name,
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<div class="widgettitle">',
					'after_title' => '</div>',
				) );
			$i++;
		}


		register_sidebar( array(
			'name' =>  'Side Dashboard',
			'id' => 'sidebar-'.$i,
			'description' => 'Side Dashboard',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<div class="widgettitle">',
			'after_title' => '</div>',
		) );

		$i++;

		$custom_sidebars = get_option( 'mk_settings' );
		$custom_sidebars_array = isset($custom_sidebars['custom-sidebar']) ? $custom_sidebars['custom-sidebar'] : null;
		if ( $custom_sidebars_array != null ) {
			foreach ( $custom_sidebars_array as $key => $value ) {
				register_sidebar( array(
						'name' =>  $value,
						'id' => 'sidebar-'.$i,
						'description' => $value,
						'before_widget' => '<section id="%1$s" class="widget %2$s">',
						'after_widget' => '</section>',
						'before_title' => '<div class="widgettitle">',
						'after_title' => '</div>',
					) );
				$i++;
			}
		}
	}

	function get_sidebar( $post_id = null ) {

		if ( is_page() || is_home() ) {
			$sidebar = $this->sidebar_names['page'];
		}
		if ( is_search() ) {
			$sidebar = $this->sidebar_names["search"];
		}
		if ( is_archive() ) {
			$sidebar = $this->sidebar_names["archive"];
		}
		if ( is_404() ) {
			$sidebar = $this->sidebar_names["404"];
		}
		if ( is_singular( 'post' ) ) {
			$sidebar = $this->sidebar_names['single_post'];
		}
		if ( is_singular( 'portfolio' ) ) {
			$sidebar = $this->sidebar_names['single_portfolio'];
		}
		if ( function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {
			$sidebar = $this->sidebar_names["woocommerce"];
		}
		if ( function_exists('is_woocommerce') && is_woocommerce() && is_single()) {
			$sidebar = $this->sidebar_names["woocommerce_single"];
		}
		if ( function_exists('is_bbpress') && is_bbpress()) {
			$sidebar = $this->sidebar_names['bbpress'];
		}


		if ( !empty( $post_id ) ) {
			$custom = get_post_meta( $post_id, '_sidebar', true );
			if ( !empty( $custom ) ) {
				$sidebar = $custom;
			}
		}
		if ( isset( $sidebar ) ) {
			dynamic_sidebar( $sidebar );
		}
	}
	/*function get_footer_sidebar() {
		dynamic_sidebar( $this->footer_sidebar_names[$this->footer_sidebar_count] );
		$this->footer_sidebar_count++;
	}*/

	function get_footer_sidebar(){
		$post_id = global_get_post_id();
		if($post_id) {
				if($this->footer_sidebar_count == 0) {
					$single_area = get_post_meta($post_id, '_widget_first_col', true);
					if(!empty($single_area)) {
						dynamic_sidebar($single_area);
					} else {
						dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
					}
				}
				if($this->footer_sidebar_count == 1) {
					$single_area = get_post_meta($post_id, '_widget_second_col', true);
					if(!empty($single_area)) {
						dynamic_sidebar($single_area);
					} else {
						dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
					}
				}
				if($this->footer_sidebar_count == 2) {
					$single_area = get_post_meta($post_id, '_widget_third_col', true);
					if(!empty($single_area)) {
						dynamic_sidebar($single_area);
					} else {
						dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
					}
				}
				if($this->footer_sidebar_count == 3) {
					$single_area = get_post_meta($post_id, '_widget_fourth_col', true);
					if(!empty($single_area)) {
						dynamic_sidebar($single_area);
					} else {
						dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
					}
				}
				if($this->footer_sidebar_count == 4) {
					$single_area = get_post_meta($post_id, '_widget_fifth_col', true);
					if(!empty($single_area)) {
						dynamic_sidebar($single_area);
					} else {
						dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
					}
				}
				if($this->footer_sidebar_count == 5) {
					$single_area = get_post_meta($post_id, '_widget_sixth_col', true);
					if(!empty($single_area)) {
						dynamic_sidebar($single_area);
					} else {
						dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
					}
				}
		} else {
			dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
		}
		$single_area = '';
		$this->footer_sidebar_count++;
	}

}
global $_mkSidebarGenerator;
$_mkSidebarGenerator = new mkSidebarGenerator;

add_action( 'widgets_init', array( $_mkSidebarGenerator, 'register_sidebar' ) );

function mk_sidebar_generator( $function ) {
	global $_mkSidebarGenerator;
	$args = array_slice( func_get_args(), 1 );
	return call_user_func_array( array( &$_mkSidebarGenerator, $function ), $args );
}
