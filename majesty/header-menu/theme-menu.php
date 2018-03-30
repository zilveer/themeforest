<?php
	global $majesty_options;
	if( is_page_template( 'page-templates/page-builder.php' )  ) {
		$page_id 	= sama_get_current_page_id();
		$menu_type 	= get_post_meta( $page_id, '_sama_menu_type', true );
		if( empty( $menu_type ) || $menu_type == false ) {
			$menu_type = 'Light-default-transparent';
		}
		if( $menu_type == 'light-center-transparent' ) {
			$majesty_options['header_css'] 	= 'center-header';
			$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
			$majesty_options['logo-small']	= $majesty_options['logo-light-small'];
		} elseif( $menu_type == 'light-bottom-center' ) {
			$majesty_options['header_css'] 	= 'header-bottom no-logo header-center white-header solid clearfix';
			$majesty_options['logo-big']	 	= $majesty_options['logo-white-bg'];
			$majesty_options['logo-small']	= $majesty_options['logo-light-small'];
		} elseif( $menu_type == 'dark-default-transparent' ) {
			$majesty_options['header_css'] 	= 'dark-header';
			$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
			$majesty_options['logo-small']	= $majesty_options['logo-dark-small'];
		} elseif( $menu_type == 'dark-center-transparent' ) {
			$majesty_options['header_css'] 	= 'center-header dark-header';
			$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
			$majesty_options['logo-small']	= $majesty_options['logo-dark-small'];
		} elseif( $menu_type == 'dark-bottom-center' ) {
			$majesty_options['header_css'] 	= 'header-bottom no-logo header-center dark-header solid clearfix';
			$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
			$majesty_options['logo-small']	= $majesty_options['logo-dark-small'];
		} elseif( $menu_type == 'light-default-solid' ) {
			$majesty_options['header_css'] 	= 'header-transparent white-header solid';
			$majesty_options['logo-big']	 	= $majesty_options['logo-white-bg'];
			$majesty_options['logo-small']	= $majesty_options['logo-light-small'];
		} elseif( $menu_type == 'light-center-solid' ) {
			$majesty_options['header_css'] 	= 'center-header solid white-header';
			$majesty_options['logo-big']	 	= $majesty_options['logo-white-bg'];
			$majesty_options['logo-small']	= $majesty_options['logo-light-small'];
		} elseif( $menu_type == 'dark-default-solid' ) {
			$majesty_options['header_css'] 	= 'dark-header solid';
			$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
			$majesty_options['logo-small']	= $majesty_options['logo-dark-small'];
		} elseif( $menu_type == 'dark-center-solid' ) {
			$majesty_options['header_css'] 	= 'center-header solid dark-header';
			$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
			$majesty_options['logo-small']	= $majesty_options['logo-dark-small'];
		} else {
			$majesty_options['header_css'] 	= 'header-transparent';
			$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
			$majesty_options['logo-small']	= $majesty_options['logo-light-small'];
		}
		if( $menu_type == 'vertical-menu' ) {
			get_template_part('header-menu/menu-vertical');
		} else {
			get_template_part('header-menu/menu');
		}
	} else {
		$header_css = '';
		if( $majesty_options['menu_has_trans'] ) {
			// Transparent Header
			
			if( $majesty_options['menu_color'] == 'dark' && $majesty_options['logo_position'] == 'center' ) {
				$header_css = 'center-header dark-header header-with-bg';
				$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
				$majesty_options['logo-small']	= $majesty_options['logo-dark-small'];
			} elseif( $majesty_options['menu_color'] == 'dark') {
				$header_css = 'dark-header';
				$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
				$majesty_options['logo-small']	= $majesty_options['logo-dark-small'];
			} elseif( $majesty_options['menu_color'] == 'light' && $majesty_options['logo_position'] == 'center' ) {
				$header_css = 'center-header header-with-bg';
				$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
				$majesty_options['logo-small']	= $majesty_options['logo-light-small'];
			} else {
				$header_css = 'header-transparent';
				$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
				$majesty_options['logo-small']	= $majesty_options['logo-light-small'];
			}
		} else {
			// Solid Header
			if( $majesty_options['menu_color'] == 'dark' && $majesty_options['logo_position'] == 'center' ) {
				$header_css = 'center-header solid dark-header';
				$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
				$majesty_options['logo-small']	= $majesty_options['logo-dark-small'];
			} elseif( $majesty_options['menu_color'] == 'dark' ) {
				$header_css = 'dark-header solid';
				$majesty_options['logo-big']	 	= $majesty_options['logo-light-trans'];
				$majesty_options['logo-small']	= $majesty_options['logo-dark-small'];
			} elseif( $majesty_options['menu_color'] == 'light' && $majesty_options['logo_position'] == 'center' ) {
				$header_css = 'center-header solid white-header';
				$majesty_options['logo-big']	 	= $majesty_options['logo-white-bg'];
				$majesty_options['logo-small']	= $majesty_options['logo-light-small'];
			} else {
				$header_css = 'header-transparent white-header solid';
				$majesty_options['logo-big']	 	= $majesty_options['logo-white-bg'];
				$majesty_options['logo-small']	= $majesty_options['logo-light-small'];
			}
		}
		$majesty_options['header_css'] = $header_css;
		get_template_part('header-menu/menu');
	}
?>