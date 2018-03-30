<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_VP_options {

	public $title = '';
	public $logo = '';
	public $inner_menu;
	public $menu_name = array(
		'general_setting' => array(
			'theme_setting',
			'header_setting',
			'responsive_header_setting',
			'footer_setting'
		),
		'ads_setting' => array(
			'header_ads',
			'footer_ads',
			'before_title',
			'inline_ads',
			'after_title',
		),
		'woocommerce_setting' => array(
			'shop_setting',
			'shop_cat_setting',
			'shop_tag_setting'
		),
		'template_setting' => array(
			'blog_setting',
			'category_setting',
			'tag_setting',
			'author_setting',
			'archive_setting',
			'single_post_setting',
			'search_setting',
			'404_setting'
		),
		'social_icons' => array(),
		'social_share_setting' => array(),
		'under_construction_setting' => array(),
		'blog_rules' => array(),
		'sidebar_setting' => array(),
		'news_letter_setting' => array(),
		'typography_setting' => array(
			'heading_setting',
			'body_font_setting'
		),
	);

	public function __construct( $title, $logo ) {
		$files = glob( crazyblog_ROOT . "core/application/library/vp_options/*.php" );
		foreach ( $files as $file )
			if ( !is_dir( $file ) ) {
				require_once( $file );
			}

		$this->title = $title;
		$this->logo = $logo;
	}

	public function crazyblog_Main_menu() {
		$menues_ = array();

		foreach ( $this->menu_name as $key => $menu ) {
			$class = 'crazyblog_' . ucfirst( $key ) . '_menu';
			if ( class_exists( $class ) ) {
				$object = new $class;
				$get_vars = get_class_vars( get_class( $object ) );
				$class_methods = get_class_methods( $class );
				$parent_method = crazyblog_set( $class_methods, '0' );
				if ( is_array( $menu ) && !empty( $menu ) ) {
					foreach ( $menu as $m ) {
						$class_c = 'crazyblog_' . ucfirst( $m ) . '_menu';
						if ( class_exists( $class_c ) ) {
							$object_c = new $class_c;
							$get_vars_c = get_class_vars( get_class( $object_c ) );
							$class_methods_c = get_class_methods( $class_c );
							$get_method = crazyblog_set( $class_methods_c, '0' );
							$get_method_1 = crazyblog_set( $class_methods_c, '1' );
							$inner_menu[] = array(
								'title' => crazyblog_set( $get_vars_c, 'title' ),
								'name' => strtolower( 'crazyblog_' . str_replace( ' ', '_', crazyblog_set( $get_vars_c, 'title' ) ) ),
								'icon' => 'font-awesome:fa ' . crazyblog_set( $get_vars_c, 'icon' ),
								'controls' => $object_c->$get_method(),
							);
						}
					}
					$menues_[] = array(
						'title' => crazyblog_set( $get_vars, 'title' ),
						'name' => strtolower( 'crazyblog_' . str_replace( ' ', '_', crazyblog_set( $get_vars, 'title' ) ) ),
						'icon' => 'font-awesome:fa ' . crazyblog_set( $get_vars, 'icon' ),
						'menus' => $inner_menu,
					);
					unset( $inner_menu );
				} else {
					$menues_[] = array(
						'title' => crazyblog_set( $get_vars, 'title' ),
						'name' => strtolower( 'crazyblog_' . str_replace( ' ', '_', crazyblog_set( $get_vars, 'title' ) ) ),
						'icon' => 'font-awesome:fa ' . crazyblog_set( $get_vars, 'icon' ),
						'controls' => $object->$parent_method(),
					);
				}
			}
		}

		$menues_ = apply_filters( 'crazyblog_vp_menu_array_', $menues_ );

		$default = array(
			'title' => $this->title,
			'logo' => $this->logo,
			'menus' => $menues_,
		);
		return apply_filters( 'crazyblog_vp_main_menu_', $default );
	}

}
