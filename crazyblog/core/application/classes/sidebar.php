<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Sidebars {

	static public function register() {
		$sidebars_ = array();
		$settings = crazyblog_opt();
		$footer_widget = $settings;
		$sidebars = array(
			'primary-widget-area' => array(
				'name' => esc_html__( 'Primary Widget Area', 'crazyblog' ),
				'desc' => esc_html__( 'The primary widget area', 'crazyblog' ),
				'before_widget' => '<div id="%1$s" class="%2$s widget">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-title"><h4>',
				'after_title' => '</h4></div>',
			),
			'footer-widget-area' => array(
				'name' => esc_html__( 'Footer Widget Area', 'crazyblog' ),
				'desc' => esc_html__( 'Footer widget area', 'crazyblog' ),
				'before_widget' => '<div id="%1$s" class="%2$s col-md-4"><div class="widget">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="widget-title"><h4>',
				'after_title' => '</h4></div>',
			),
		);


		if ( has_filter( 'crazyblog_Extends_Sidebars' ) ) {
			$sidebars = apply_filters( 'crazyblog_Extends_Sidebars', $sidebars );
		}

		foreach ( $sidebars as $type => $sidebar ) {
			$sidebars_[$type] = crazyblog_set( $sidebar, 'name' );
			if ( crazyblog_set( $sidebar, 'name' ) != '' ) {
				register_sidebar(
						array(
							'name' => crazyblog_set( $sidebar, 'name' ),
							'id' => $type,
							'description' => crazyblog_set( $sidebar, 'desc' ),
							'class' => '',
							'before_widget' => crazyblog_set( $sidebar, 'before_widget' ),
							'after_widget' => crazyblog_set( $sidebar, 'after_widget' ),
							'before_title' => crazyblog_set( $sidebar, 'before_title' ),
							'after_title' => crazyblog_set( $sidebar, 'after_title' ),
						)
				);
			}
		}

		$sidebars = crazyblog_set( crazyblog_set( crazyblog_opt(), 'footer_upper_section_sidebars_settings' ), 'footer_upper_section_sidebars_settings' );
		if ( $sidebars != '' ) {
			foreach ( $sidebars as $sidebar ) {
				$sidebars_[str_replace( ' ', '-', strtolower( crazyblog_set( $sidebar, 'sidebar_name' ) ) )] = crazyblog_set( $sidebar, 'sidebar_name' );
				if ( crazyblog_set( $sidebar, 'tocopy' ) )
					continue;
				if ( crazyblog_set( $sidebar, 'sidebar_name' ) != '' ) {
					register_sidebar(
							array(
								'name' => crazyblog_set( $sidebar, 'sidebar_name' ),
								'id' => str_replace( ' ', '-', strtolower( crazyblog_set( $sidebar, 'sidebar_name' ) ) ),
								'description' => esc_html__( 'This widget area is using for footer upper section', 'crazyblog' ),
								'class' => '',
								'before_widget' => '<div class="col-md-' . crazyblog_set( $sidebar, 'footer_sidebar_grid', 3 ) . '"><div id="%1$s" class="%2$s widget">',
								'after_widget' => "</div></div>",
								'before_title' => '<div class="widget-title"><h4>',
								'after_title' => '</h4></div>',
							)
					);
				}
			}
		}

		$sidebars = crazyblog_set( crazyblog_set( $settings, 'dynamic_sidebar' ), 'dynamic_sidebar' );
		if ( $sidebars ) {
			array_pop( $sidebars );
			if ( count( $sidebars ) > 0 ) {
				foreach ( $sidebars as $sidebar ) {
					$sidebars_[str_replace( ' ', '-', strtolower( crazyblog_set( $sidebar, 'sidebar_name' ) ) )] = crazyblog_set( $sidebar, 'footer_sidebar_name' );
					if ( crazyblog_set( $sidebar, 'sidebar_name' ) != '' ) {
						register_sidebar(
								array(
									'name' => crazyblog_set( $sidebar, 'sidebar_name' ),
									'id' => str_replace( ' ', '-', strtolower( crazyblog_set( $sidebar, 'sidebar_name' ) ) ),
									'description' => esc_html__( 'This widget area is using sidebar area', 'crazyblog' ),
									'class' => '',
									'before_widget' => '<div id="%1$s" class="%2$s"><div class="widget">',
									'after_widget' => '</div></div>',
									'before_title' => '<div class="widget-title"><h4>',
									'after_title' => '</h4></div>',
								)
						);
					}
				}
			}
		}

		$sidebars = crazyblog_set( crazyblog_set( $settings, 'footer_dynamic_sidebar' ), 'footer_dynamic_sidebar' );
		if ( $sidebars ) {
			array_pop( $sidebars );
			if ( count( $sidebars ) > 0 ) {
				foreach ( $sidebars as $sidebar ) {
					$sidebars_[str_replace( ' ', '-', strtolower( crazyblog_set( $sidebar, 'footer_sidebar_name' ) ) )] = crazyblog_set( $sidebar, 'footer_sidebar_name' );
					if ( crazyblog_set( $sidebar, 'footer_sidebar_name' ) != '' ) {
						register_sidebar(
								array(
									'name' => crazyblog_set( $sidebar, 'footer_sidebar_name' ),
									'id' => str_replace( ' ', '-', strtolower( crazyblog_set( $sidebar, 'footer_sidebar_name' ) ) ),
									'description' => esc_html__( 'This widget area is using sidebar area', 'crazyblog' ),
									'class' => '',
									'before_widget' => '<div class="col-md-' . crazyblog_set( $sidebar, 'footer_sidebar_grid' ) . '"><div id="%1$s" class="widget %2$s">',
									'after_widget' => '</div></div>',
									'before_title' => '<div class="widget-title"><h4>',
									'after_title' => '</h4></div>',
								)
						);
					}
				}
			}
		}

		update_option( 'wp_registered_sidebars', $sidebars_ );
	}

}
