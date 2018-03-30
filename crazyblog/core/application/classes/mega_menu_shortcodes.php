<?php

class crazyblog_Mega_Menu_Shortcodes {

	protected $keys;

	function __construct() {

		$this->add();
	}

	function add() {



		$options = array( 'megamenu_container_shortcode', 'custom_menu_shortcode' );



		$this->keys = $options;

		foreach ( $this->keys as $k ) {

			if ( method_exists( $this, $k ) && function_exists( 'crazyblog_shortcode_setup' ) )
				crazyblog_shortcode_setup( $k, array( $this, $k ) );
		}
	}

	function megamenu_container_shortcode( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'width' => '1060',
			'mega_menu_bg' => '',
			'position' => '',
						), $atts ) );



		$output = '';

		if ( $position == 'left' )
			$menu_position = ' right';

		elseif ( $position == 'center' )
			$menu_position = ' center';
		else
			$menu_position = '';

		$menu_bg = ($mega_menu_bg != '') ? 'background-image:url(' . $mega_menu_bg . ');' : '';

		$width = ($width) ? "width:" . $width . "px;" : '';



		$style = ($menu_bg || $width) ? ' style="' . $menu_bg . $width . '"' : '';

		$output .='<div class="mega-menu' . $menu_position . '"' . $style . '>

                               <div class="menu-menu-sec">

                                       <div class="row">';

		$output .= do_shortcode( $content );

		$output .= '</div></div></div>';



		return $output;
	}

	function custom_menu_shortcode( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title' => '',
			'cols' => '3',
			'menu' => '',
						), $atts ) );



		$output = '';

		$output .= '<div class="col-md-' . $cols . '">';



		$output .= ($title) ? '<div class="menu-ttile"><h3>' . $title . '</h3></div>' : '';

		$menu_items = wp_get_nav_menu_items( $menu );



		$output .= '<ul>';



		foreach ( (array) $menu_items as $key => $menu_item ) {

			$title = $menu_item->title;

			$url = $menu_item->url;

			$output .= '<li><a href="' . esc_url( $url ) . '">' . $title . '</a></li>';
		}

		$output .= '</ul>';

		$output .= '</div>';



		return $output;
	}

}

new crazyblog_Mega_Menu_Shortcodes;
?>