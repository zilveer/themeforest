<?php
/*
Plugin Name: XMenu - The Ultimate WordPress Mega Menu
Plugin URI: http://www.g5plus.net
Description: Easily create beautiful, flexible, responsive mega menus
Author: G5Theme
Author URI: http://www.g5plus.net
Version: 1.0.0.0
*/
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'XMenu' ) ) :
final class XMenu {
	private static $instance;

	public static function init() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new XMenu;
			self::$instance->define_constants();
			self::$instance->includes();
			self::$instance->process_filter();
		}

		return self::$instance;
	}

	private function define_constants(){
		// Plugin version
		if( ! defined( 'G5PLUS_XMENU_VERSION' ) ) { define( 'G5PLUS_XMENU_VERSION', '1.0.0.0' ); }
		// Plugin prefix
		if( ! defined( 'G5PLUS_XMENU_PREFIX' ) ) { define( 'G5PLUS_XMENU_PREFIX', 'xmenu_' ); }
		// Plugin Folder URL
		if( ! defined( 'G5PLUS_XMENU_URL' ) ) {define( 'G5PLUS_XMENU_URL', G5PLUS_THEME_URL . 'g5plus-framework/xmenu/' );}
		if( ! defined( 'G5PLUS_XMENU_DIR' ) ){define( 'G5PLUS_XMENU_DIR', G5PLUS_THEME_DIR . 'g5plus-framework/xmenu/' );}
	}

	private function includes() {
		require_once G5PLUS_XMENU_DIR . 'inc/global.php';
		require_once G5PLUS_XMENU_DIR . 'inc/menu-item.php';
		require_once G5PLUS_XMENU_DIR . 'inc/functions.php';
		require_once G5PLUS_XMENU_DIR . 'inc/XMenuWalker.class.php';
		require_once G5PLUS_XMENU_DIR . 'admin/admin.php';
	}

	private function process_filter() {
		add_filter('wp_nav_menu_args',array($this, 'replace_walker_to_xmenu'));
		add_filter('xmenu_custom_content', 'do_shortcode');
	}

	function replace_walker_to_xmenu($args) {
		$is_xmenu = false;
		$menu_slug = '';

		if (isset($args['theme_location']) &&
			(($args['theme_location'] == 'primary') || ($args['theme_location'] == 'mobile') || ($args['theme_location'] == 'left_menu') || ($args['theme_location'] == 'right_menu'))) {
			if ($args['menu']) {
				if (is_object($args['menu'])) {
					$menu_slug = $args['menu']->slug;
					$is_xmenu = true;
				}
				else {
					$term = get_term($args['menu'], 'nav_menu');

					if (!$term) {
						$term = get_term_by('slug', $args['menu'], 'nav_menu');
					}
					if ($term) {
						$menu_slug = $term->slug;
						$is_xmenu = true;
					}
				}
			}
			else {
				$theme_locations = get_nav_menu_locations();
				if (isset($theme_locations[$args['theme_location']])) {
					$menu_obj = get_term( $theme_locations[$args['theme_location']], 'nav_menu' );
					if ($menu_obj) {
						$menu_slug = $menu_obj->slug;
						$is_xmenu = true;
					}
				}
			}

		}
		if ($is_xmenu) {
			$args['walker'] = new XMenuWalker();
			$args['menu_class'] .= ' x-nav-menu';
			$args['menu_class'] .= ' x-nav-menu' . (empty($menu_slug) ? '' : '_' . $menu_slug );
			$args['items_wrap'] =
				apply_filters('xmenu_nav_filter_before', '')
				. '<ul id="%1$s" class="%2$s">'
					.(!isset($args['is_mobile_menu']) ? apply_filters('xmenu_primary_filter_before','') : '')
					. apply_filters('xmenu_filter_before','') . '%3$s' . apply_filters('xmenu_filter_after','')
				. '</ul>'
				. apply_filters('xmenu_nav_filter_after', '');

			$menu_transition = G5Plus_Global::get_option('menu_transition', '');
			if ($menu_transition !== '') {
				$args['menu_class'] .= ' ' . $menu_transition;
			}
			$args['x-menu'] = true;
		}
		return $args;
	}
}
endif;

if( !function_exists( '_XMENU' ) ){
	function _XMENU() {
		return XMenu::init();
	}
	_XMENU();
}