<?php
/**
 * Custom Sidebars
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Custom_Sidebars' ) ) {

	class WPEX_Custom_Sidebars {

		protected $widget_areas	= array();
		protected $orig			= array();

		/**
		 * Start things up
		 *
		 * @since 1.6.0
		 */
		public function __construct( $widget_areas = array() ) {
			add_action( 'init', array( $this, 'register_sidebars' ) , 1000 );
			add_action( 'admin_print_scripts-widgets.php', array( $this, 'add_widget_box' ) );
			add_action( 'load-widgets.php', array( $this, 'add_widget_area' ), 100 );
			add_action( 'load-widgets.php', array( $this, 'scripts' ), 100 );
			add_action( 'admin_print_styles-widgets.php', array( $this, 'inline_css' ) );
			add_action( 'wp_ajax_wpex_delete_widget_area', array( $this, 'wpex_delete_widget_area' ) ); 
		}

		/**
		 * Add the widget box inside a script
		 *
		 * @since 1.6.0
		 */
		public function add_widget_box() {
			$nonce = wp_create_nonce ( 'delete-wpex-widget_area-nonce' ); ?>
			  <script type="text/html" id="wpex-add-widget-template">
				<div id="wpex-add-widget" class="widgets-holder-wrap">
				 <div class="">
				  <input type="hidden" name="wpex-nonce" value="<?php echo esc_attr( $nonce ); ?>" />
				  <div class="sidebar-name">
				   <h3><?php esc_html_e( 'Create Widget Area', 'total' ); ?> <span class="spinner"></span></h3>
				  </div>
				  <div class="sidebar-description">
					<form id="addWidgetAreaForm" action="" method="post">
					  <div class="widget-content">
						<input id="wpex-add-widget-input" name="wpex-add-widget-input" type="text" class="regular-text" title="<?php esc_attr_e( 'Name', 'total' ); ?>" placeholder="<?php esc_attr_e( 'Name', 'total' ); ?>" />
					  </div>
					  <div class="widget-control-actions">
						<div class="aligncenter">
						  <input class="addWidgetArea-button button-primary" type="submit" value="<?php esc_attr_e( 'Create Widget Area', 'total' ); ?>" />
						</div>
						<br class="clear">
					  </div>
					</form>
				  </div>
				 </div>
				</div>
			  </script>
			<?php
		}        

		/**
		 * Create new Widget Area
		 *
		 * @since 1.6.0
		 */
		public function add_widget_area() {
			if ( ! empty( $_POST['wpex-add-widget-input'] ) ) {
				$this->widget_areas = $this->get_widget_areas();
				array_push( $this->widget_areas, $this->check_widget_area_name( $_POST['wpex-add-widget-input'] ) );
				$this->save_widget_areas();
				wp_redirect( admin_url( 'widgets.php' ) );
				die();
			}
		}

		/**
		 * Before we create a new widget_area, verify it doesn't already exist. If it does, append a number to the name.
		 *
		 * @since 1.6.0
		 */
		public function check_widget_area_name( $name ) {
			if ( empty( $GLOBALS['wp_registered_widget_areas'] ) ) {
				return $name;
			}

			$taken = array();
			foreach ( $GLOBALS['wp_registered_widget_areas'] as $widget_area ) {
				$taken[] = $widget_area['name'];
			}

			$taken = array_merge( $taken, $this->widget_areas );

			if ( in_array( $name, $taken ) ) {
				$counter  = substr( $name, -1 );  
				$new_name = "";
				  
				if ( ! is_numeric( $counter ) ) {
					$new_name = $name . " 1";
				} else {
					$new_name = substr( $name, 0, -1 ) . ((int) $counter + 1);
				}

				$name = $this->check_widget_area_name( $new_name );
			}
			echo esc_html( $name );
			exit();
		}

		public function save_widget_areas() {
			set_theme_mod( 'widget_areas', array_unique( $this->widget_areas ) );
		}

		/**
		 * Register and display the custom widget_area areas we have set.
		 *
		 * @since 1.6.0
		 */
		public function register_sidebars() {

			// Get widget areas
			if ( empty( $this->widget_areas ) ) {
				$this->widget_areas = $this->get_widget_areas();
			}

			// Original widget areas is empty
			$this->orig = array();

			// Save widget areas
			if ( ! empty( $this->orig ) && $this->orig != $this->widget_areas ) {
				$this->widget_areas = array_unique( array_merge( $this->widget_areas, $this->orig ) );
				$this->save_widget_areas();
			}

			// Get tag element from theme mod for the sidebar widget title
			$tag = wpex_get_mod( 'sidebar_headings', 'div' ) ? wpex_get_mod( 'sidebar_headings', 'div' ) : 'div';
				 
			// If widget areas are defined add a sidebar area for each
			if ( is_array( $this->widget_areas ) ) {
				foreach ( array_unique( $this->widget_areas ) as $widget_area ) {
					$args = array(
						'id'			=> sanitize_key( $widget_area ),
						'name'			=> $widget_area,
						'class'			=> 'wpex-custom',
						'before_widget'	=> '<div class="sidebar-box %2$s clr">',
						'after_widget'	=> '</div>',
						'before_title'	=> '<'. $tag .' class="widget-title">',
						'after_title'	=> '</'. $tag .'>',
					);
					register_sidebar( $args );
				}
			}
		}

		/**
		 * Return the widget_areas array.
		 *
		 * @since 1.6.0
		 */
		public function get_widget_areas() {

			// If the single instance hasn't been set, set it now.
			if ( ! empty( $this->widget_areas ) ) {
				return $this->widget_areas;
			}

			// Get widget areas saved in theem mod
			$widget_areas = wpex_get_mod( 'widget_areas' );

			// If theme mod isn't empty set to class widget area var
			if ( ! empty( $widget_areas ) && is_array( $widget_areas ) ) {
				$this->widget_areas = array_unique( array_merge( $this->widget_areas, $widget_areas ) );
			}

			// Return widget areas
			return $this->widget_areas;
		}

		/**
		 * Before we create a new widget_area, verify it doesn't already exist. If it does, append a number to the name.
		 *
		 * @since 1.6.0
		 */
		public function wpex_delete_widget_area() {
			// Check_ajax_referer('delete-wpex-widget_area-nonce');
			if ( ! empty( $_REQUEST['name'] ) ) {
				$name = strip_tags( ( stripslashes( $_REQUEST['name'] ) ) );
				$this->widget_areas = $this->get_widget_areas();
				$key = array_search($name, $this->widget_areas );
				if ( $key >= 0 ) {
					unset( $this->widget_areas[$key] );
					$this->save_widget_areas();
				}
				echo "widget_area-deleted";
			}
			die();
		}

		/**
		 * Enqueue JS for the customizer controls
		 *
		 * @since 1.6.0
		 */
		public function scripts() {

			// Load scripts
			wp_enqueue_style( 'dashicons' );
			wp_enqueue_script(
				'wpex-widget-areas',
				WPEX_FRAMEWORK_DIR_URI .'addons/assets/widget_areas.js', 
				array('jquery'),
				time(),
				true
			);

			// Get widgets
			$widgets = array();
			if ( ! empty( $this->widget_areas ) ) {
				foreach ( $this->widget_areas as $widget ) {
					$widgets[$widget] = 1;
				}
			}

			// Localize script
			wp_localize_script(
				'wpex-widget-areas',
				'wpexWidgetAreasLocalize',
				array(
					'count'   => count( $this->orig ),
					'delete'  => esc_html__( 'Delete', 'total' ),
					'confirm' => esc_html__( 'Confirm', 'total' ),
					'cancel'  => esc_html__( 'Cancel', 'total' ),
				)
			);
		}

		/**
		 * Adds inline CSS to style the widget form
		 *
		 * @since 1.6.0
		 */
		public function inline_css() { ?>

			<style type="text/css">
				body #wpex-add-widget h3 { text-align: center !important; padding: 15px 7px; font-size: 1.3em; margin-top: 5px; }
				body div#widgets-right .sidebar-wpex-custom .widgets-sortables { padding-bottom: 45px }
				body div#widgets-right .sidebar-wpex-custom.closed .widgets-sortables { padding-bottom: 0 }
				body .wpex-widget-area-footer { display: block; position: absolute; bottom: 0; left: 0; height: 40px; line-height: 40px; width: 100%; border-top: 1px solid #eee; }
				body .wpex-widget-area-footer > div { padding: 8px 8px 0 }
				body .wpex-widget-area-footer .wpex-widget-area-id { display: block; float: left; max-width: 48%; overflow: hidden; position: relative; top: -6px; }
				body .wpex-widget-area-footer .wpex-widget-area-buttons { float: right }
				body .wpex-widget-area-footer .description { padding: 0 !important; margin: 0 !important; }
				body div#widgets-right .sidebar-wpex-custom.closed .widgets-sortables .wpex-widget-area-footer { display: none }
				body .wpex-widget-area-footer .wpex-widget-area-delete { display: block; float: right; margin: 0; }
				body .wpex-widget-area-footer .wpex-widget-area-delete-confirm { display: none; float: right; margin: 0 5px 0 0; }
				body .wpex-widget-area-footer .wpex-widget-area-delete-cancel { display: none; float: right; margin: 0; }
				body .wpex-widget-area-delete-confirm:hover:before { color: red }
				body .wpex-widget-area-delete-confirm:hover { color: #000 }
				body .wpex-widget-area-delete:hover:before { color: #888 }
				body .activate_spinner { display: block !important; position: absolute; top: 10px; right: 4px; background-color: #ECECEC; }
				body #wpex-add-widget form { text-align: center }
				body #widget_area-wpex-custom,
				body #widget_area-wpex-custom h3 { position: relative }
				body #wpex-add-widget p { margin-top: 0 }
				body #wpex-add-widget { margin: 10px 0 0; position: relative; }
				body #wpex-add-widget-input { max-width: 95%; padding: 8px; margin-bottom: 14px; margin-top: 3px; text-align: center; }
			</style>

		<?php }
	
	}

	new WPEX_Custom_Sidebars();

}