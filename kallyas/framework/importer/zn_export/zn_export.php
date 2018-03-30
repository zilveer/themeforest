<?php if(! defined('ABSPATH')){ return; }
/*
Plugin Name: Zn Export
Plugin URI: http://themefuzz.com/
Description: Custom export functions from Themefuzz
Version: 1.0
Author: Balasa Sorin Stefan
Author URI: http://themefuzz.com/

*/

define( 'EXPORTER_URL', FW_URL.'/importer/zn_export' );
// define( EXPORTER_PATH, '' );

if(!defined('ABSPATH')) {
	die("Don't call this file directly.");
}

if ( ! class_exists( 'ZnExporter' ) ) {
	class ZnExporter
	{

		private $includes;
		private $classes = array();
		private $plugin_page;
		private $action;

		public function __construct()
		{
			/* ADD ADMIN PAGES */
			$this->setup_includes();
			$this->setup_action();

			// ADD our pages
			add_action( 'admin_menu', array( $this, 'zn_add_pages' ) );
			add_action( 'network_admin_menu', array( $this, 'zn_add_pages' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );

			if ( isset($_POST['page']) && $_POST['page'] == 'zn-exporter' && isset( $_POST['deploy_all'] ) ) {
				add_action( 'admin_init', array( $this, 'deploy_all' ), 11 );
			}

			if ( isset($_POST['page']) && $_POST['page'] == 'zn-exporter' && isset( $_POST['download'] ) ) {
				add_action( 'admin_init', array( $this->classes[$this->action], 'do_export' ), 11 ); // Set priority to 11 so all themes and plugins can add their post types
			}

			if ( isset($_POST['page']) && $_POST['page'] == 'zn-exporter' && isset( $_POST['deploy'] ) ) {
				add_action( 'admin_init', array( $this->classes[$this->action], 'do_deploy' ), 11 ); // Set priority to 11 so all themes and plugins can add their post types
			}

		}

		private function setup_includes(){
			$this->includes = array(
					'content' => array(
								'file' => 'inc/export_content.php',
								'name'	=> 'Content export',
								'class'	=> 'ZnContentExporter',
							),
					'media' => array(
								'file' => 'inc/export_media.php',
								'name'	=> 'Media export',
								'class'	=> 'ZnMediaExporter',
							),
					'widgets' => array(
								'file' => 'inc/export_widgets.php',
								'name'	=> 'Widgets export',
								'class'	=> 'ZnWidgetsExporter',
							),
					'themeoptions' => array(
								'file' => 'inc/export_theme_options.php',
								'name'	=> 'Theme options export',
								'class'	=> 'ZnThemeOptionsExport',
							),
					'custom_icons' => array(
						'file' => 'inc/export_custom_icons.php',
						'name'	=> 'Custom icons export',
						'class'	=> 'ZnCustomIconsExport',
					),
				);

			foreach ( $this->includes as $key => $value) {

				include( $value['file'] );
				$this->classes[$key] = new $value['class'];

			}

		}

		public function zn_add_pages() {

			// ADD the main plugin page
			$this->plugin_page = add_menu_page( 'Zn Exporter', 'Zn Exporter', 'install_plugins', 'zn-exporter', array( $this, 'render_page' ));
		}

		public function render_page(){

			if ( ! current_user_can( 'install_plugins' ) )
				die( 'You don\'t have permissions to use this page.' );

			?>

			<div class="wrap znexp-wrapper">
				<div class="wp-filter">
					<div class="actions">
						<h4>Select action : </h4>
						<?php

							echo '<a class="button action" href="'. admin_url( 'admin.php' ). '?page=zn-exporter" title="Home">Home</a>';

							foreach ( $this->includes as $key => $value ) {
								echo '<a class="button action" href="'. admin_url( 'admin.php' ). '?page=zn-exporter&action='.$key.'" title="'.$value['name'].'">'.$value['name'].'</a>';
							}
						?>
					</div>
				</div>
				<?php

					if ( ! empty( $this->action ) && array_key_exists($this->action, $this->includes) ) {

						if ( ! empty( $this->classes[ $this->action ] ) && method_exists( $this->classes[$this->action], 'render_page' ) ) {
							$this->form_start( $this->action );
								call_user_func( array ( $this->classes[$this->action], 'render_page' ) );
							$this->form_end( $this->action );
						}
					}
					else {
						$this->show_info();
					}

				?>
			</div>

			<?php
		}

		public function deploy_all(){

			foreach ( $this->includes as $key => $value ) {
				if ( method_exists( $this->classes[$key], 'do_deploy') ) {
					$this->classes[$key]->do_deploy();
				}
			}

		}

		private function setup_action(){
			if( isset ( $_GET['action'] ) ) {
				$this->action = $_GET['action'];
			}
			elseif( isset ( $_POST['action'] ) ) {
				$this->action = $_POST['action'];
			}
			else {
				$this->action = false;
			}

			// $this->action = isset ( $_GET['action'] ) ? $_GET['action'] : isset ( $_POST['action'] ) ? $_POST['action'] : false;
		}

		private function form_start( $action ){
			echo '<form action="'. admin_url( 'admin.php' ). '" method="post">';
		}

		private function form_end( $action ){

				echo '<input type="hidden" name="page" value="zn-exporter" />';
				echo '<input type="hidden" name="action" value="'.$action.'" />';
				if ( method_exists( $this->classes[$action], 'do_export') ) {
					echo '<input type="submit" name="download" class="button" value="Download Export" />';
				}

				if ( method_exists( $this->classes[$action], 'do_deploy') ) {
					echo '<input type="submit" name="deploy" class="button" value="Deploy Export" />';
				}

			echo '</form>';
		}

		private function show_info(){
			echo '<a class="button action" href="'. admin_url( 'admin.php' ). '?page=zn-exporter&deploy_all=true" title="Deploy all">Deploy all</a>';
		}

		public function load_scripts( $hook ){

			if ( $hook != $this->plugin_page)  return;

		   	/* Register our stylesheet. */
			wp_enqueue_style( 'zn_export', EXPORTER_URL.'/assets/css/style.css' );

			/* LOAD JAVASCRIPT */
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script( 'zn_export', EXPORTER_URL.'/assets/js/zn_script.js' );

		}
	}
	new ZnExporter;
}

