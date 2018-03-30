<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'restricted access' );

class crazyblog_import_export {

	private $path = '';
	private $file_system = '';
	private $demo = '';

	function __construct( $demo = '' ) {
		$this->demo = $demo;
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once(ABSPATH . '/wp-admin/includes/file.php');
			WP_Filesystem();
		}
		$this->file_system = $wp_filesystem;

		if ( !is_dir( ABSPATH . 'wp-content/webinane' ) ) {
			$this->file_system->mkdir( str_replace( '\\', '/', ABSPATH ) . 'wp-content/webinane' );
		}
		$this->path = ABSPATH . 'wp-content/webinane/';
	}

	function export() {
		$this->sidebar_export();
		$this->theme_options_export();
		if ( function_exists( 'vc_map' ) ) {
			$this->vc_template_export();
		}
		if ( function_exists( 'rev_slider_shortcode' ) )
			$this->revslider_export();
	}

	function import() {
		$this->sidebar_import();
		$this->theme_options_import();
		if ( function_exists( 'layerslider' ) ) {
			$this->layerslider_import();
		}
		if ( function_exists( 'vc_map' ) ) {
			$this->vc_template_import();
		}
		if ( function_exists( 'rev_slider_shortcode' ) )
			$this->revslider_import();
	}

	function vc_template_export( $file = '' ) {
		global $wpdb;
		$file = ($file) ? $file : 'default_settings';
		$data = array();
		$settings = get_option( 'wpb_js_templates' );
		$dir = $this->path . 'vc_options';
		$this->newdir( $dir );
		$w_file = $dir . '/' . $file;
		$this->file_system->put_contents( $w_file, $this->encrypt( $settings ), 0777 );
	}

	function vc_template_import( $file = '' ) {
		global $wpdb;
		$file = ($file) ? $file : 'default_settings';
		$settings = $this->read_file( $this->newdir( $this->path . 'vc_options' ) . DIRECTORY_SEPARATOR . $file );
		update_option( 'wpb_js_templates', $settings );
	}

	function layerslider_export( $file = '' ) {
		global $wpdb;
		$file = ($file) ? $file : 'default_settings';
		$data = array();
		$sliders = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "layerslider", ARRAY_A );
		$data = array();
		$data['slider'] = $sliders;
		$dir = $this->path . 'layerslider_options';
		$this->newdir( $dir );
		$w_file = $dir . '/' . $file;

		$this->file_system->put_contents( $w_file, $this->encrypt( $data ), 0777 );
	}

	function layerslider_import( $file = '' ) {
		global $wpdb;
		$file = ($file) ? $file : 'default_settings';
		$settings = $this->read_file( $this->path . 'layerslider_options' . DIRECTORY_SEPARATOR . $file );
		foreach ( (array) $settings['slider'] as $v ) {
			$res = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `" . $wpdb->prefix . "layerslider` WHERE `name` LIKE %s", '%' . $v['name'] . '%' ) );
			if ( $res )
				continue;

			$data = $v;
			$wpdb->insert( $wpdb->prefix . "layerslider", array(
				'id' => $data['id'],
				'author' => $data['author'],
				'name' => $data['name'],
				'slug' => $data['slug'],
				'data' => $data['data'],
				'date_c' => $data['date_c'],
				'date_m' => $data['date_m']
					), array(
				'%d', '%d', '%s', '%s', '%s', '%d', '%d'
			) );
		}
	}

	function theme_options_import( $file = '' ) {

		global $wpdb;

		$file = ($file) ? $file : 'default_settings';
		$data = $this->read_file( $this->path . 'theme_options/' . $file );
		$v = $this->replace_pseudo( $data );
		update_option( 'wp_crazyblog_theme_options', $v );
		$front_page = get_page_by_title( 'Home' );
		$blog_page = get_page_by_title( 'Blog' );
		if ( $front_page ) {
			if ( get_option( 'show_on_front' ) != 'page' && !get_option( 'page_on_front' ) ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $front_page->ID );
				update_option( 'page_for_posts', $blog_page->ID );
			}
		}
		update_option( 'posts_per_page', 6 );
		$nav_menu = array( '' );
		if ( $this->demo == 'crazyblog' || $this->demo == 'cars' || $this->demo == 'cars-new' ) {
			$res = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "terms WHERE " . $wpdb->prefix . "terms.slug = 'main-menu' OR " . $wpdb->prefix . "terms.slug = 'footer-menu' OR " . $wpdb->prefix . "terms.slug = 'top-menu'" );
			if ( $res ) {
				$nav_menu['nav_menu_locations']['footer-menu'] = $res[0]->term_id;
				$nav_menu['nav_menu_locations']['primary-menu'] = $res[1]->term_id;
				$nav_menu['nav_menu_locations']['topbar-menu'] = $res[2]->term_id;
			}
		} elseif ( $this->demo == 'creative' || $this->demo == 'magazine' || $this->demo == 'personal-store' ) {
			$res = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "terms WHERE " . $wpdb->prefix . "terms.slug = 'main-menu' OR " . $wpdb->prefix . "terms.slug = 'footer-menu'" );
			if ( $res ) {
				$nav_menu['nav_menu_locations']['footer-menu'] = $res[0]->term_id;
				$nav_menu['nav_menu_locations']['primary-menu'] = $res[1]->term_id;
			}
		} elseif ( $this->demo == 'recipes' ) {
			$res = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "terms WHERE " . $wpdb->prefix . "terms.slug = 'menu' OR " . $wpdb->prefix . "terms.slug = 'footer'" );
			if ( $res ) {
				$nav_menu['nav_menu_locations']['footer-menu'] = $res[0]->term_id;
				$nav_menu['nav_menu_locations']['primary-menu'] = $res[1]->term_id;
			}
		} elseif ( $this->demo == 'travel' ) {
			$res = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "terms WHERE " . $wpdb->prefix . "terms.slug = 'main-menu' OR " . $wpdb->prefix . "terms.slug = 'footer-menu' OR " . $wpdb->prefix . "terms.slug = 'top-menu' OR " . $wpdb->prefix . "terms.slug = 'right-menu'" );

			if ( $res ) {
				$nav_menu['nav_menu_locations']['footer-menu'] = $res[0]->term_id;
				$nav_menu['nav_menu_locations']['left-menu'] = $res[1]->term_id;
				$nav_menu['nav_menu_locations']['right-menu'] = $res[2]->term_id;
				$nav_menu['nav_menu_locations']['topbar-menu'] = $res[3]->term_id;
			}
		} else {
			$res = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "terms WHERE " . $wpdb->prefix . "terms.slug = 'main-menu'" );
			if ( $res ) {
				$nav_menu['nav_menu_locations']['primary-menu'] = $res[0]->term_id;
			}
		}
		$info = pathinfo( get_template_directory() );
		update_option( 'theme_mods_' . crazyblog_set( $info, 'basename' ), $nav_menu );
	}

	function revslider_export( $file = '' ) {

		global $wpdb;

		$file = ($file) ? $file : 'default_settings';



		$data = array();



		$sliders = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "revslider_sliders", ARRAY_A );

		$slides = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "revslider_slides", ARRAY_A );

		foreach ( $sliders as $k => $s ) {

			$slider_id = crazyblog_set( $s, 'id' );

			if ( isset( $s['id'] ) )
				unset( $s['id'] );

			$data['slider'][$k] = $s;

			foreach ( $slides as $ss ) {

				if ( isset( $ss['id'] ) )
					unset( $ss['id'] );



				if ( $slider_id == crazyblog_set( $ss, 'slider_id' ) )
					$data['slider'][$k]['slides'][] = $ss;
			}
		}

		$dir = $this->path . 'revslider_options';
		$this->newdir( $dir );
		$w_file = $dir . '/' . $file;

		$this->file_system->put_contents( $w_file, $this->encrypt( $data ), 0777 );
	}

	function revslider_import( $file = '' ) {
		global $wpdb;
		$file = ($file) ? $file : 'default_settings';
		$settings = $this->read_file( $this->path . 'revslider_options' . DIRECTORY_SEPARATOR . $file );

		if ( $settings ) {
			foreach ( (array) $settings['slider'] as $v ) {
				$slider_id = '';
				$res = $wpdb->get_results( "SELECT * FROM `" . $wpdb->prefix . "revslider_sliders` WHERE `title` LIKE '%" . $v['title'] . "%'" );
				if ( $res )
					continue;
				$slides = crazyblog_set( $v, 'slides' );

				if ( $slides )
					unset( $v['slides'] );
				$wpdb->insert( $wpdb->prefix . "revslider_sliders", $v );

				$slider_id = $wpdb->insert_id;
				if ( $slider_id ) {
					foreach ( $slides as $key => $val ) {
						if ( $val ) {
							$val['slider_id'] = $slider_id;
							$wpdb->insert( $wpdb->prefix . "revslider_slides", $val );
						}
					}
				}
			}
		}
	}

	function theme_options_export( $file = '' ) {
		$file = ($file) ? $file : 'default_settings';
		$options = crazyblog_opt();
		$data = $this->pseudo( $options );
		$dir = $this->path . 'theme_options';
		$this->newdir( $dir );
		$w_file = $dir . '/' . $file;

		$this->file_system->put_contents( $w_file, $this->encrypt( $data ), 0777 );
	}

	function sidebar_import( $file = '' ) {
		$file = ($file) ? $file : 'default_settings';
		$data = $this->read_file( $this->path . 'widgets' . DIRECTORY_SEPARATOR . $file );

		if ( !isset( $data['settings'] ) || !isset( $data['sidebars'] ) )
			return;

		foreach ( $data['settings'] as $k => $v ) {
			update_option( 'widget_' . $k, $this->replace_pseudo( $v ) );
		}
		update_option( 'sidebars_widgets', $data['sidebars'] );
	}

	function sidebar_export( $file = '' ) {
		$file = ($file) ? $file : 'default_settings';
		$settings = array();
		$sidebars = wp_get_sidebars_widgets();
		if ( isset( $sidebars['wp_inactive_widgets'] ) )
			unset( $sidebars['wp_inactive_widgets'] );

		foreach ( $sidebars as $name => $widgets ) {
			if ( !count( $widgets ) || $name == 'orphaned_widgets' )
				continue;

			foreach ( $widgets as $widget ) {
				if ( preg_match( '#(.*?)-(\d+)$#', $widget, $matches ) ) {
					$type = $matches[1];
					$id = $matches[2];
					if ( $widget_settings = get_option( 'widget_' . $type ) ) {
						$settings[$type][$id] = $this->pseudo( $widget_settings[$id] );
					}
				}
			}
		}
		$dir = $this->path . 'widgets';
		$this->newdir( $dir );
		$w_file = $dir . '/' . $file;
		$this->file_system->put_contents( $w_file, $this->encrypt( array( 'settings' => $settings, 'sidebars' => $sidebars ) ), 0777 );
	}

	function encrypt( $data ) {
		if ( is_array( $data ) )
			return crazyblog_encrypt( serialize( $data ) );
		else
			return $data;
	}

	function decrypt( $data ) {
		$data = crazyblog_decrypt( $data );
		if ( is_serialized( $data ) )
			return unserialize( $data );
		else
			return $data;
	}

	function newdir( $path ) {
		if ( !$this->file_system->is_dir( $path ) ) {
			$this->file_system->mkdir( $path );
		}
	}

	function read_file( $file ) {
		if ( !file_exists( $file ) )
			return FALSE;

		$data = '';
		$data .= $this->file_system->get_contents( $file );
		return $this->decrypt( $data );
	}

	function pseudo( $options = array() ) {
		foreach ( $options as $k => $v ) {
			if ( is_array( $v ) )
				$options[$k] = $this->pseudo( $v );
			elseif ( preg_match( "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $v ) ) {
				$options[$k] = '{ADMIN_EMAIL}';
			} else {
				$options[$k] = str_replace( array( get_template_directory_uri(), home_url( '/' ), get_option( 'admin_email' ) ), array( '{THEME_URL}', '{HOME_URL}', '{ADMIN_EMAIL}' ), $v );
			}
		}
		return $options;
	}

	function replace_pseudo( $options = array() ) {
		foreach ( (array) $options as $k => $v ) {
			if ( is_array( $v ) )
				$options[$k] = $this->replace_pseudo( $v );
			else {
				$options[$k] = str_replace( array( '{THEME_URL}', '{HOME_URL}', '{ADMIN_EMAIL}' ), array( get_template_directory_uri(), home_url( '/' ), get_option( 'admin_email' ) ), $v );
			}
		}
		return $options;
	}

}
