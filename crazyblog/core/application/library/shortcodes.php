<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Shortcodes {

	static protected $_shortcodes = array(
		'penta_overlay_post_carousel',
		'cats_posts_tabs',
		'author_posts_carousel',
		'blog_masonary_style',
		'simple_overlay_posts',
		'simple_blog_posts',
		'masonary_posts_with_tabs',
		'posts_with_small_thumb',
		'uneven_posts_list',
		'grid_posts_view',
		'one_feature_post',
		'google_ad',
		'gallery_carousel',
		'google_ad',
		'contact_form',
		'posts_with_ajax_nav',
		'blog_rules_toggle',
		'about_with_gallery',
		'space',
		'sponsers',
		'featured_posts',
		'weekly_featured_posts',
		'featured_posts_tabs_carousal',
		'weekly_posts',
		'big_search',
		'modern_blog_listing',
		'lightbox_gallery',
		'verticle_posts_for_fashion',
		'featured_text_full_width_parallax',
		'vendor_intro_and_products',
		'creative_grid_posts_full_width',
		'creative_posts_masonry_grid',
		'creative_full_width_carousel',
		'featured_posts_with_thumb_tabs',
		'simple_list_view_with_big_thumb',
		'grid_view_posts_tabs_category_based',
		'featured_area_recipes_carousel',
		'simple_recipe_grid',
		'featured_recipe_carousel',
		'category_base_carousel',
		'featured_recipe',
		'simple_post_by_category',
		'author_info_with_carousal',
		'author_info_with_carousal_block',
		'featured_posts_carousal',
	);

	static public function init() {
		define( 'crazyblog_JS_COMPOSER_PATH', crazyblog_ROOT . 'core/application/library/shortcodes' );
		require_once crazyblog_JS_COMPOSER_PATH . "/shortcode.php";
		self::_init_shortcodes();
		self::crazyblog_nested_shortcodes();
	}

	static protected function _init_shortcodes() {
		if ( function_exists( 'vc_map' ) && function_exists( 'crazyblog_shortcode_setup' ) ) {
			asort( self::$_shortcodes );
			require_once crazyblog_ROOT . 'core/application/library/shortcodes_default_attr.php';
			foreach ( self::$_shortcodes as $shortcodes ) {
				require_once crazyblog_JS_COMPOSER_PATH . '/' . $shortcodes . '.php';
				$class = 'crazyblog_' . ucfirst( $shortcodes ) . '_VC_ShortCode';
				$wst_name = strtolower( 'crazyblog_' . $shortcodes . '_vc' );
				$class_methods = get_class_methods( $class );
				if ( isset( $class_methods ) ) {
					foreach ( $class_methods as $shortcode ) {
						if ( $shortcode[0] != '_' && $shortcode != $wst_name ) {
							crazyblog_shortcode_setup( $shortcode, array( $class, $shortcode ) );
							if ( is_admin() ) {
								if ( function_exists( 'vc_map' ) ) {
									$vc_map_array = call_user_func( array( $class, '_options' ), $wst_name );
									$vc_map_array['params'] = array_merge( $vc_map_array['params'], $shortcode_section );
									vc_map( $vc_map_array );
								}
							}
						}
					}
				}
			}
		}
	}

	static public function crazyblog_nested_shortcodes() {
		require_once crazyblog_JS_COMPOSER_PATH . "/nested_shortcodes.php";
	}

}
