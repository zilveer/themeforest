<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_Admin_Welcome_Message' ) ) {
/**
 * Wolf_Admin_Welcome_Message class.
 */
class Wolf_Admin_Welcome_Message {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		if ( ! isset( $_GET['page'] ) ) {
			add_action( 'welcome_panel', array( $this, 'welcome_panel' ) );
			add_action( 'admin_head', array( $this, 'welcome_admin_head' ) );
		}
	}

	/**
	 * Hide default welcome dashboard message and and create a custom one
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	*/
	public function welcome_panel() {

		?>
<div class="welcome-panel-content wolf-welcome-panel-content">
	<h3><?php printf( __( 'Welcome to %s Wordpress Theme!', 'wolf' ), wp_get_theme()->Name ); ?></h3>

	<div class="welcome-panel-column-container">
		<div class="welcome-panel-column">
			<h4><?php _e( 'Let\'s Get Started', 'wolf' ); ?></h4>

				<a class="button button-primary button-hero" href="<?php echo esc_url( admin_url( 'admin.php?page=wolf-theme-options' ) ); ?>"><?php _e( 'Theme Settings', 'wolf' ); ?></a>
				<?php //printf( __( 'or, <a href="%s">creata a post</a>' ), esc_url( admin_url( '' ) ) ); ?>

		</div>
		<div class="welcome-panel-column">
			<h4><?php _e( 'Help', 'wolf' ); ?></h4>
			<ul>
				<li><i class="fa-fw fa fa-home"></i> <a target="_blank" href="http://docs.<?php echo WOLF_DOMAIN; ?>/documentation/themes/<?php echo esc_attr( wolf_get_theme_slug() ); ?>/#home"><?php _e( 'How to set up your home page', 'wolf' ); ?></a></li>
				<li><i class="fa-fw fa fa-bars"></i> <a target="_blank" href="http://docs.<?php echo WOLF_DOMAIN; ?>/documentation/themes/<?php echo esc_attr( wolf_get_theme_slug() ); ?>/#menus"><?php _e( 'How to set up your menus', 'wolf' ); ?></a></li>
				<li><i class="fa-fw fa fa-file-text-o"></i> <a target="_blank" href="http://docs.<?php echo WOLF_DOMAIN; ?>/documentation/themes/<?php echo wolf_get_theme_slug(); ?>"><?php _e( 'Documentation', 'wolf' ); ?></a></li>
				<li><i class="fa-fw fa fa-support"></i> <a target="_blank" href="http://help.<?php echo WOLF_DOMAIN; ?>/"><?php _e( 'Support forum', 'wolf' ); ?></a></li>
			</ul>
		</div>
		<div class="welcome-panel-column welcome-panel-last">
			<h4><?php _e( 'More plugins', 'wolf' ); ?></h4>
			<ul>
				<?php
					$plugin_dir = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR;
				?>
				<?php if ( ! is_dir( $plugin_dir. 'wolf-twitter' ) ) : ?>
					<li><i class="fa-fw fa fa-twitter"></i> <a target="_blank" href="http://<?php echo WOLF_DOMAIN; ?>/plugin/wolf-twitter/">Twitter Plugin</a></li>
				<?php endif; ?>

				<?php if ( ! is_dir( $plugin_dir. 'wolf-gram' ) ) : ?>
					<li><i class="fa-fw fa fa-instagram"></i> <a target="_blank" href="http://<?php echo WOLF_DOMAIN; ?>/plugin/wolf-gram/">Instagram Plugin</a></li>
				<?php endif; ?>

				<?php if ( ! is_dir( $plugin_dir. 'wolf-dribbble' ) ) : ?>
					<li><i class="fa-fw fa fa-dribbble"></i> <a target="_blank" href="http://<?php echo WOLF_DOMAIN; ?>/plugin/wolf-dribbble/">Dribbble Plugin</a></li>
				<?php endif; ?>

				<?php if ( ! is_dir( $plugin_dir. 'wolf-flickr' ) ) : ?>
					<li><i class="fa-fw fa ti-flickr"></i> <a target="_blank" href="http://<?php echo WOLF_DOMAIN; ?>/plugin/wolf-flickr/">Flickr Plugin</a></li>
				<?php endif; ?>

				<?php if ( ! is_dir( $plugin_dir. 'wolf-widgets-pack' ) ) : ?>
					<li><i class="fa-fw fa fa-cog"></i> <a target="_blank" href="http://<?php echo WOLF_DOMAIN; ?>/plugin/wolf-widgets-pack/">Widgets Pack</a></li>
				<?php endif; ?>

				<?php if ( ! is_dir( $plugin_dir. 'wolf-facebook-page-box' ) ) : ?>
					<li><i class="fa-fw fa fa-facebook"></i> <a target="_blank" href="http://<?php echo WOLF_DOMAIN; ?>/plugin/wolf-facebook-page-box/">Facebook Page Box</a></li>
				<?php endif; ?>

				<li><i class="fa-fw fa ti-wolf"></i> <a target="_blank" href="http://<?php echo WOLF_DOMAIN; ?>/plugins/"><?php _e( 'More plugins', 'wolf' ); ?></a></li>
			</ul>
		</div>
	</div>
</div>
		<?php
	}

	/**
	 *
	 *
	 * @param
	 * @return
	 */
	public function welcome_admin_head() {

		?>
		<style>
			.wolf-welcome-panel{
				padding: 23px 10px 23px;
			}

			.wolf-welcome-panel .fa{
				position: relative;
				top: 2px;
				margin-right: 10px;
			}

			.wolf-welcome-panel .fa:before{
				font-size: 20px;

			}

			.wolf-welcome-panel ul li{
				padding: 0 0 8px;
			}

			/* Hide default welcome message */
			.welcome-panel-content:not(.wolf-welcome-panel-content){
				display: none;
			}
		</style>
		<script type="text/javascript">
			jQuery( document ).ready( function() {
				jQuery( '.wolf-welcome-panel-content' ).parent().addClass( 'wolf-welcome-panel' );
			} );
		</script>
		<?php
	}

} // end class

	if ( WOLF_ENABLE_ABOUT_MESSAGE )
		$wolf_do_admin_welcome_message = new Wolf_Admin_Welcome_Message();

} // end class exists check



