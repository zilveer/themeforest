<?php
/**
 * Your Inspiration Themes 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if( !class_exists( 'login_register' ) ) :
/**
 * Search widget class
 *
 * @since 2.8.0
 */
class login_register extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'login_register', 'description' => __( "Login / Register links for your Header Sidebar", 'yit' ) );
		parent::__construct('login_register', __( 'Login / Register links', 'yit' ), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		echo $before_widget; 
		
		//wp_nav_menu(array('container_class' => 'menu-header','theme_location' => 'top'));
		
		$nav_args = array(
			'theme_location' => 'top',
			'container' => 'none',
			'menu_class' => 'level-1',
			'depth' => 3,   
			'fallback_cb' => false,
			//'walker' => new YIT_Walker_Nav_Menu()
		);
		
		if ( has_nav_menu( 'top' ) ) $nav_args[] = new YIT_Walker_Nav_Menu();
		
		wp_nav_menu( $nav_args ); 
		
		/*
		if( is_shop_installed() ) {
			$accountPage = get_permalink( get_option('woocommerce_myaccount_page_id') );
			if( is_user_logged_in() ) {
				$output  = '<a href="' . $accountPage . '">' . __('My Account', 'yit') . '</a> <span>|</span> ';
				$output .= '<a href="' . wp_logout_url( home_url() ) . '">' . __('Logout', 'yit') . '</a>';
			} else {
				$output  = '<a href="' . $accountPage . '">' . __('Login', 'yit') . ' <span>|</span> ' . __('Register', 'yit') . '</a>';
			}
		} else {
			if( is_user_logged_in() ) {
				$output = '<a href="' . wp_logout_url( home_url() ) . '">' . __('Logout', 'yit') . '</a>';
			} else {
				$output  = '<a href="' . wp_login_url() . '">' . __('Login', 'yit') . '</a>';
				$output .= wp_register(' <span>|</span> ','', false);
			}
		}

		echo $output;
		*/
		
		
		echo $after_widget;
	}
	
	

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array() );

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array());
		return $instance;
	}

}
endif;