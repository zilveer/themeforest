<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Panel {

	static public function register() {
		require_once( crazyblog_ROOT . 'core/duffers_panel/panel/bootstrap.php' );
		include_once( crazyblog_ROOT . 'core/duffers_panel/extend/loader.php' );
		require_once( crazyblog_ROOT . 'core/duffers_panel/panel/admin/data_sources.php' );
		require_once( crazyblog_ROOT . 'core/application/library/vp_options.php' );
		$options = new crazyblog_VP_options( 'Webinane Theme Options', 'logo.png' );
		$theme_options = new VP_Option(
				array(
			'is_dev_mode' => false,
			'option_key' => 'wp_crazyblog_theme_options',
			'page_slug' => 'crazyblog' . '_option',
			'template' => $options->crazyblog_Main_menu(),
			'menu_page' => 'themes.php',
			'use_auto_group_naming' => true,
			'use_util_menu' => true,
			'minimum_role' => 'edit_theme_options',
			'layout' => 'fluid',
			'page_title' => esc_html__( 'Theme Options', 'crazyblog' ),
			'menu_label' => esc_html__( 'Theme Options', 'crazyblog' ),
				)
		);
	}

}
