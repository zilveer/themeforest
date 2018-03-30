<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolf_Admin_Welcome_Page' ) ) {
	/**
	 * Welcome Page Class
	 *
	 * Shows a feature overview for the new version (major).
	 *
	 *
	 * @author WolfThemes
	 * @category 	Admin
	 * @package 	wolf/Admin
	 * @version 1.0.0
	*/
	class Wolf_Admin_Welcome_Page {

		/**
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {

			add_action( 'admin_menu', array( $this, 'admin_menus') );
			add_action( 'admin_head', array( $this, 'admin_head' ) );
			add_action( 'admin_init', array( $this, 'welcome' ) );
		}

		/**
		 * Add admin menus/screens
		 *
		 * @access public
		 * @return void
		 */
		public function admin_menus() {
			// if ( empty( $_GET['page'] ) ) {
			// 	return;
			// }

			// $theme_name = WOLF_THEME_NAME;
			// $welcome_page_name  = sprintf( __( 'About %s', 'wolf' ), $theme_name );
			// $welcome_page_title = sprintf( __( 'Welcome to %s', 'wolf' ), $theme_name );

			// if ( 'wolf-about' == $_GET['page'] ) {
			// 	$page = add_dashboard_page( $welcome_page_title, $welcome_page_name,
			// 		'manage_options', 'wolf-about', array( $this, 'about_screen' ) );
			// }

			add_submenu_page( 'wolf-theme-options', __( 'About', 'wolf' ), __( 'About', 'wolf' ), 'manage_options', 'wolf-about', array( $this, 'about_screen' ) );
		}

		/**
		 * Add styles just for this page, and remove dashboard page links.
		 *
		 * @access public
		 * @return void
		 */
		public function admin_head() {
			//remove_submenu_page( 'index.php', 'wolf-about' );
			if ( isset( $_GET['page'] ) && 'wolf-about' == $_GET['page'] ) {
			?>
			<style type="text/css">
				/*<![CDATA[*/
				.wolf-admin-notice{
					display:none;
				}
				/*]]>*/
			</style>
			<?php
			}
		}

		/**
		 * Into text/links shown on all about pages.
		 *
		 * @access private
		 * @return void
		 */
		private function intro() {

			// force Welcome admin panel to show
			if ( isset( $_GET['wolf-theme-activated'] ) ) {
				update_user_meta( get_current_user_id(), 'show_welcome_panel', true );
			}

			$theme_name = WOLF_THEME_NAME;
			$theme_version = WOLF_THEME_VERSION;
			?>
			<h1><?php printf( __( 'Welcome to %s %s', 'wolf' ), $theme_name, $theme_version ); ?></h1>

			<div class="about-text wolf-about-text">
				<?php
					if ( isset( $_GET['wolf-theme-updated'] ) )
						$message = __( 'Thank you for updating to the latest version!', 'wolf' );
					else
						$message = sprintf( __( 'Thanks for installing %s!', 'wolf' ), $theme_name );

					if ( isset( $_GET['wolf-theme-activated'] ) ) {
						printf( __( '%s We hope you will enjoy using it.', 'wolf' ), $message );
					} elseif ( isset( $_GET['wolf-theme-updated'] ) ) {
						printf( __( '%s <br> %s is now more stable and secure than ever.<br>We hope you enjoy using it.', 'wolf' ), $message, $theme_name );
					} else {
						printf( __( '%s We hope you enjoy using it.', 'wolf' ), $message );
					}
				?>
			</div>
			<div class="wp-badge wolf-about-page-logo">
			Version <?php echo sanitize_text_field( $theme_version ); ?></div>
			<?php
		}

		/**
		 * Output the about screen.
		 *
		 * @access public
		 * @return void
		 */
		public function about_screen() {
			?>
			<div class="wrap about-wrap">
				<?php $this->intro(); ?>
				<?php $this->features(); ?>
				<?php $this->new_features(); ?>
			</div>
			<?php
		}

		/**
		 * Output the last new feature if set in the changelog XML
		 *
		 * @access public
		 * @return void
		 */
		public function features() {
			$theme_name = WOLF_THEME_NAME;
			$twitter_url = 'http://' . WOLF_DOMAIN . '/theme/' . wolf_get_theme_slug();
			$twitter_text = 'Make your website look awesome with ' . WOLF_THEME_NAME . ' #wordpress #theme by @wolf_themes';

			if ( wolf_get_theme_description_from_changelog() ) {
				$desc = wolf_sample( wolf_get_theme_description_from_changelog(), 50 );
				$twitter_text = "Check out '$theme_name &mdash; $desc' on #EnvatoMarket by @wolf_themes #themeforest";
			}

			if ( wolf_get_theme_short_link() ) {
				$twitter_url = wolf_get_theme_short_link();
			}
			?>
			<p class="wolf-about-actions">
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=wolf-theme-options' ) ); ?>" class="button button-primary"><?php _e( 'Settings', 'wolf' ); ?></a>
				<a
					style="margin-right:3px;margin-top:3px;vertical-align:middle"
					href="https://twitter.com/share"
					data-text="<?php echo sanitize_text_field( $twitter_text ); ?>"
					data-url="<?php echo esc_url( $twitter_url ); ?>"
					class="twitter-share-button"
					data-count="none"
					data-size="large">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</p>
			<?php
		}

		/**
		 * Output the last new feature if set in the changelog XML
		 *
		 * @access public
		 * @return void
		 */
		public function new_features() {

			//if ( isset( $_GET['wolf-theme-updated'] ) ) {

				if ( wolf_get_last_change_from_changelog() ) {
					?>
					<h2 style="text-align:left;"><?php printf( __( 'What\'s new in %s', 'wolf' ), WOLF_THEME_VERSION ); ?></h2>
					<?php
					echo wolf_get_last_change_from_changelog();
				}
			//}
		}

		/**
		 * Sends user to the welcome page on first activation
		 *
		 * @access public
		 * @return void
		 */
		public function welcome() {

			if ( isset( $_GET['page'] ) && 'install-required-plugins' == $_GET['page'] ) {
				// skip woocommerce setup if import option is set
				if ( get_option( '_wolf_do_import_' . wolf_get_theme_slug() ) ) {
					$this->skip_plugins_setups();
				}
			}

			if ( isset( $_GET['activated'] ) && 'true' == $_GET['activated'] ) {

				delete_option( '_wolf_do_import_' . wolf_get_theme_slug() );
				flush_rewrite_rules();
				wp_redirect( admin_url( 'admin.php?page=wolf-about&wolf-theme-activated' ) );
				exit;

			} elseif ( isset( $_GET['do-import'] ) && 'true' == $_GET['do-import'] ) {

				$this->skip_plugins_setups();

				// flag the do import option
				update_option( '_wolf_do_import_' . wolf_get_theme_slug(), true );
				wp_redirect( admin_url( '/' ) );
				exit;

			} elseif ( isset( $_GET['do-import'] ) && 'false' == $_GET['do-import'] ) {

				// remove do import option
				delete_option( '_wolf_do_import_' . wolf_get_theme_slug() );
				wp_redirect( admin_url( '/' ) );
				exit;
			}
		}

		/**
		 * Remove necessary option to avoid displaying plugin setup message
		 */
		private function skip_plugins_setups() {

			// wolf plugins skip set up
			delete_option( '_wolf_albums_needs_page' );
			delete_option( '_wolf_portfolio_needs_page' );
			delete_option( '_wolf_videos_needs_page' );
			delete_option( '_wolf_discography_needs_page' );

			add_option( '_wolf_albums_no_needs_page', true );
			add_option( '_wolf_portfolio_no_needs_page', true );
			add_option( '_wolf_videos_no_needs_page', true );
			add_option( '_wolf_discography_no_needs_page', true );

			// Woocommerce Skip setup
			delete_option( '_wc_needs_pages' );
			delete_transient( '_wc_activation_redirect' );
		}
	}

	if ( WOLF_ENABLE_ABOUT_MESSAGE )
		$wolf_do_admin_welcome_page = new Wolf_Admin_Welcome_Page();

} // end class exists check
