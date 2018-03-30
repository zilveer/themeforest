<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolf_Theme_Admin_Default_Pages' ) ) {
	/**
	 * Default pages Class
	 *
	 * @since 1.4.2
	 * @package WolfFramework
	 * @author WolfThemes
	 */
	class Wolf_Theme_Admin_Default_Pages {

		var $default_posts = array();

		/**
		 * Wolf_Theme_Admin_Default_Pages constructor
		 */
		public function __construct( $default_posts = array() ) {

			$this->default_posts = $default_posts + $this->default_posts;
			add_action( 'admin_notices', array( $this, 'display_notice' ) );
			//add_action( 'switch_theme ', array( $this, 'flush_option' ) );
			$this->do_create_pages();
		}

		/**
		 * Flush option
		 */
		public function flush_option( $newname, $newtheme ) {
			delete_option( '_wolf_' . wolf_get_theme_slug() . '_default_pages' );
		}

		/**
		 * Create page if user choose to do so
		 */
		public function do_create_pages() {

			if ( isset( $_GET['wolf-default-pages'] ) ) {

				if ( $_GET['wolf-default-pages'] == 'true' ) {

					$this->insert_posts();
					$this->wp_options();
					update_option( '_wolf_' . wolf_get_theme_slug() . '_default_pages', true );
					wp_redirect( esc_url( admin_url( 'edit.php?post_type=page' ) ) );
					exit;

				} elseif ( $_GET['wolf-default-pages'] == 'false' ) {
					update_option( '_wolf_' . wolf_get_theme_slug() . '_default_pages', true );
				}
			}
		}

		/**
	  	 * Display an admin notice to install the default pages if wanted
		 */
		public function display_notice() {

			// delete_option( '_wolf_' . wolf_get_theme_slug() . '_default_pages' );

			if ( ! get_option( '_wolf_' . wolf_get_theme_slug() . '_default_pages' ) && array() != $this->default_posts  ) {

				$default_pages_install_message = sprintf( __( 'You can install default pages to help you to get started with <strong>%s</strong> theme.', 'wolf' ), WOLF_THEME_NAME );

				if ( function_exists( 'wolf_theme_register_required_plugins' ) ) {

					$default_pages_install_message .= '<br>'  . __( '<strong>It is recommended to install and activate the plugins you need from the recommended plugins list first</strong>, in order to install the default pages accordingly.', 'wolf' ) .'<br>';
				}

				$default_pages_install_message .= '<br>' . sprintf(
					__( '<a href="%1$s" class="button-primary">Install default pages</a> <a href="%2$s" class="button">Dismiss this message</a>', 'wolf' ),
					esc_url( admin_url( 'index.php?wolf-default-pages=true' ) ),
					esc_url( admin_url( 'index.php?wolf-default-pages=false' ) )
				);

				wolf_admin_notice( $default_pages_install_message, 'updated', true );
				return false;
			}
		}

		/**
		 * Reading settings
		 */
		public function wp_options() {

			$home = get_page_by_title( 'Home' );
			$blog = get_page_by_title( 'Blog' );

			if ( ! $blog )
				$blog = get_page_by_title( 'News' );

			$o = array(
				'show_on_front' => 'page',
				'posts_per_page' => 8,
				'thread_comments' => 1,
				'thread_comments_depth ' => 2,
			);

			if ( $blog ) {
				$o['page_for_posts'] = $blog->ID;
			}

			if ( $home ) {
				$o['page_on_front'] = $home->ID;
			}

			foreach ( $o as $k => $v ){
				update_option( $k, $v );
			}
		}

		/**
		 * Insert posts
		 */
		public function insert_posts() {

			$default_posts = $this->default_posts;

			$hello_check = get_page_by_title( 'Sample Page' );

			if ( isset( $hello_check->ID ) ) {
				wp_delete_post( $hello_check->ID );
			}

			foreach ( $default_posts as $post ) {
				$type = 'page';

				if ( isset( $post['post_type'] ) )
					$type = $post['post_type'];

				$post_check = get_page_by_title( $post['title'] );
				$insert     = array(
					'post_type' => $type,
					'post_title' => $post['title'],
					'post_content' => $post['content'],
					'post_status' => 'publish',
					'post_author' => 1,
				);
				if ( ! isset( $post_check->ID ) ) {

					$post_id = wp_insert_post( $insert );
					if ( isset( $post['template'] ) ) {
						update_post_meta( $post_id, '_wp_page_template', $post['template'] );
					}
					if ( isset( $post['format'] ) && 'post' == $type ) {
						set_post_format( $post_id, $post['format'] );
					}
					if ( isset( $post['meta'] ) ) {
						foreach ( $post['meta'] as $id => $value ) {
							update_post_meta( $post_id, $id, $value );
						}
					}
				}
			}
		}

	} // end class

} // end class exists check