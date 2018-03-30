<?php if(! defined('ABSPATH')){ return; }

// This will add the theme options panel if the theme has this support

/*
*	TO DO :
*	Separate theme page css from HTML class css
*
*/

class ZnAdmin{

	public 	$theme_pages = array();
	public 	$data  = array();

	private $is_setup = false;
	private $is_update = false;

	function __construct() {

		$this->theme_data = ZN()->theme_data;

		$this->load_files();

		add_action( 'admin_menu', 				array( &$this, 'zn_add_admin_pages'));
		add_action( 'admin_enqueue_scripts', 	array( &$this, 'zn_print_scripts') );
		add_action( 'admin_menu', 				array( &$this, 'edit_admin_menus' ) );
		add_action( 'current_screen', 			array( &$this, 'remove_actions' ) );

		add_action( 'admin_init', 				array( &$this, 'zn_permalink_settings_init') );
		add_action( 'admin_init', 				array( &$this, 'zn_permalink_settings_save') );

		// Check server connection
		add_action( 'admin_init', 				array( &$this, 'zn_check_server_connection') );

		// Redirect the user after theme install
		add_action( 'zn_theme_installed', 		array( &$this, 'redirect_theme_install' ) );

		$this->is_setup = get_option( 'zn_theme_first_install', false );
		delete_option( 'zn_theme_first_install' );
	}

	/**
	 * Load the necessarry extra files
	 * @return null Nothing
	 */
	function load_files(){
		// Included addons manager main class
		include( FW_PATH . '/admin/inc/addons_manager/class-addons-manager.php' );
		// Load theme Import/Export class
		include( FW_PATH . '/classes/ZnThemeImportExport.php' );
	}

	// Check a connection to the server
	function zn_check_server_connection(){

		if( ! isset( $_GET['check_connection'] ) ) { return false; }

		global $wp_version;

		$response = wp_remote_get(ZN()->theme_data['server_url']);
		$response_code = wp_remote_retrieve_response_code( $response );

		if ( $response_code != 200 ) {
			set_transient( 'zn_server_connection_check', 'notok', 172800 );
		}else{
			set_transient( 'zn_server_connection_check', 'ok', 172800 );
		}

	}

	function redirect_theme_install(){
		wp_redirect( admin_url( 'admin.php?page=zn-about' ) );
		update_option( 'zn_theme_first_install', true, false );
		exit;
	}

	/*--------------------------------------------------------------------------------------------------
		Save the permalinks options
	--------------------------------------------------------------------------------------------------*/
	function zn_permalink_settings_save() {
		if ( ! is_admin() )
			return;

		// We need to save the options ourselves; settings api does not trigger save for the permalinks page
		if ( isset( $_POST['zn_permalinks'] ) /*|| isset( $_POST['zn_portfolio_item_slug_input'] ) */ ) {
			$permalinks = $_POST['zn_permalinks'];
			update_option( 'zn_permalinks', $permalinks );
			flush_rewrite_rules();
		}
	}

	/*--------------------------------------------------------------------------------------------------
		Add options for the portfolio and Documentation
	--------------------------------------------------------------------------------------------------*/
	static public function permalink_callback( $field ) {

		$permalinks = get_option( 'zn_permalinks' );

		?>
			<input name="zn_permalinks[<?php echo $field['id']; ?>]" type="text" class="regular-text code" value="<?php if ( isset( $permalinks[$field['id']] ) ) echo esc_attr( $permalinks[$field['id']] ); ?>" placeholder="<?php echo $field['id']; ?>" />
		<?php
	}

	function zn_permalink_settings_init() {

		$post_types = array();
		$taxonomies = array();
		$this->zn_allowed_post_types = apply_filters( 'zn_allowed_post_types', $post_types );
		$this->zn_allowed_taxonomies = apply_filters( 'zn_allowed_taxonomies', $taxonomies );

		foreach ( $this->zn_allowed_post_types as $id => $name) {

			$post_type_section_id = 'zn-'.$id.'-permalink';

			// SECTION : UNIQUE ID, NAME, CALLBACK, SETTINGS PAGE
			add_settings_section( $post_type_section_id, $name.' Slugs', '', 'permalink' );

			$this->add_settings_field( $id, $name, $post_type_section_id );

			if ( !empty( $this->zn_allowed_taxonomies[$id] ) ) {

				$current_taxonomies = $this->zn_allowed_taxonomies[$id];
				foreach ( $current_taxonomies as $key => $taxonomy) {
					$this->add_settings_field( $taxonomy['id'], $taxonomy['name'], $post_type_section_id );
				}

			}

		}
	}

	function add_settings_field( $id, $name, $section ) {

		// Add Slug option
		add_settings_field(
			$id,      	// id
			$name .' item slug', 	// setting title
			array(&$this,'permalink_callback'),  // display callback
			'permalink',                 				// settings page
			$section,                 				// settings section
			array(
				'id'	=> $id
			)
		);
	}

	function get_theme_options_pages(){

		if ( !file_exists(THEME_BASE.'/template_helpers/options/theme-pages.php') ) { return array(); }
		include( THEME_BASE.'/template_helpers/options/theme-pages.php');
		return apply_filters( 'zn_theme_pages', $admin_pages );
	}

	function get_theme_options(){
		include( THEME_BASE.'/template_helpers/options/theme-options.php' );
		return apply_filters( 'zn_theme_options', $admin_options );
	}


	/**
	 * Add all framework admin pages
	 * @return null
	 */
	function zn_add_admin_pages(){

		// Add the main page
		$this->data['theme_pages'] = $this->get_theme_options_pages();
		$icon = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyB3aWR0aD0iNzhweCIgaGVpZ2h0PSI3OHB4IiB2aWV3Qm94PSIwIDAgNzggNzgiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiPiAgICAgICAgPHRpdGxlPmthbGx5YXNfbG9nbzwvdGl0bGU+ICAgIDxkZXNjPkNyZWF0ZWQgd2l0aCBTa2V0Y2guPC9kZXNjPiAgICA8ZGVmcz4gICAgICAgIDxsaW5lYXJHcmFkaWVudCB4MT0iNTAlIiB5MT0iMCUiIHgyPSI1MCUiIHkyPSI5Ny4wODAyNzc0JSIgaWQ9ImxpbmVhckdyYWRpZW50LTEiPiAgICAgICAgICAgIDxzdG9wIHN0b3AtY29sb3I9IiMzQzNDM0MiIG9mZnNldD0iMCUiPjwvc3RvcD4gICAgICAgICAgICA8c3RvcCBzdG9wLWNvbG9yPSIjODQyRTJGIiBvZmZzZXQ9IjQ5LjQ5NjY3NjUlIj48L3N0b3A+ICAgICAgICAgICAgPHN0b3Agc3RvcC1jb2xvcj0iI0NEMjEyMiIgb2Zmc2V0PSIxMDAlIj48L3N0b3A+ICAgICAgICA8L2xpbmVhckdyYWRpZW50PiAgICA8L2RlZnM+ICAgIDxnIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSIjOTk5IiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIHNrZXRjaDp0eXBlPSJNU1BhZ2UiPiAgICAgICAgPGcgaWQ9ImthbGx5YXNfbG9nbyIgc2tldGNoOnR5cGU9Ik1TQXJ0Ym9hcmRHcm91cCIgZmlsbD0iIzk5OSI+ICAgICAgICAgICAgPHBhdGggZD0iTTM5LDc2IEMxOC41NjYsNzYgMiw1OS40MzUgMiwzOSBDMiwxOC41NjUgMTguNTY2LDIgMzksMiBDNTkuNDM1LDIgNzYsMTguNTY1IDc2LDM5IEM3Niw1OS40MzUgNTkuNDM1LDc2IDM5LDc2IEwzOSw3NiBaIE02Ni43NSwzOSBDNjYuNzUsMzUuODQxIDY2LjE5NywzMi44MTcgNjUuMjI0LDI5Ljk4NyBMNTQuMjQ1LDQxLjk3NCBDNTMuNjY5LDQyLjYxNyA1My4wMzUsNDMuMTg2IDUyLjM0NCw0My42OCBDNTEuNjUyLDQ0LjE3NSA1MC45MzIsNDQuNjA3IDUwLjE4Myw0NC45NzggQzUwLjc4OCw0NS4zOTkgNTEuMzEzLDQ1Ljg4NyA1MS43Niw0Ni40NDMgQzUyLjIwNyw0Ni45OTkgNTIuNjAzLDQ3LjYzNiA1Mi45NDksNDguMzUzIEw1OC4xNjksNTkuMDM0IEM2My40NDcsNTMuOTgyIDY2Ljc1LDQ2Ljg4MyA2Ni43NSwzOSBMNjYuNzUsMzkgWiBNNDYuOTYxLDY1LjU3NyBDNDYuNzc2LDY1LjM1NyA0Ni42MDcsNjUuMTExIDQ2LjQ2Niw2NC44MTkgTDQwLjI0Miw1MS4yMDggQzM5LjkyNSw1MC41OTEgMzkuNTg3LDUwLjE4OSAzOS4yMjcsNTAuMDAzIEMzOC44NjYsNDkuODE4IDM4LjI4Myw0OS43MjUgMzcuNDc2LDQ5LjcyNSBMMzYuMDkzLDQ5LjcyNSBMMzMuNzQ2LDY2LjIzOCBDMzUuNDQ4LDY2LjU2NSAzNy4yMDIsNjYuNzUgMzksNjYuNzUgQzQxLjc2OSw2Ni43NSA0NC40MzgsNjYuMzMyIDQ2Ljk2MSw2NS41NzcgTDQ2Ljk2MSw2NS41NzcgWiBNMTEuMjUsMzkgQzExLjI1LDQ3LjYyNCAxNS4xODQsNTUuMzI4IDIxLjM1NSw2MC40MTggTDI4LjA3NywxMy40ODkgQzE4LjE4MywxNy43MzEgMTEuMjUsMjcuNTU0IDExLjI1LDM5IEwxMS4yNSwzOSBaIE00MS42MDQsMTEuMzgyIEwzNy4xNzQsNDIuMzQ1IEwzOC4wODEsNDIuMzQ1IEMzOC44Myw0Mi4zNDUgMzkuNDM1LDQyLjI0NiAzOS44OTcsNDIuMDQ4IEM0MC4zNTcsNDEuODUxIDQwLjgxOCw0MS40OTIgNDEuMjgsNDAuOTczIEw1MC41MjksMzAuMTQ0IEM1MS4wNzYsMjkuNTAxIDUxLjY4MSwyOS4wMzEgNTIuMzQ0LDI4LjczNSBDNTMuMDA2LDI4LjQzOCA1My44MTMsMjguMjg5IDU0Ljc2NCwyOC4yODkgTDY0LjYwMywyOC4yODkgQzYwLjczMSwxOS4wNDUgNTIsMTIuMzUgNDEuNjA0LDExLjM4MiBMNDEuNjA0LDExLjM4MiBaIiBpZD0iU2hhcGUiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgIDwvZz4gICAgPC9nPjwvc3ZnPg==";
		$page = add_menu_page( ZN()->theme_data['name'] .' Theme', ZN()->theme_data['name'] .' Theme', 'manage_options', 'zn-about', array(&$this, 'about_screen'), $icon );

		// Add all subpages
		foreach ( $this->data['theme_pages'] as $key => $value ) {

			/* CREATE THE SUBPAGES */
			$this->theme_pages[] = add_submenu_page(
				'zn-about',
				$value['title'],
				$value['title'],
				'manage_options',
				'zn_tp_'.$key,
				array(&$this, 'zn_render_page')
			);

		}
	}

	/**
	 * Replace the first menu title quick setup / update screen / dashboard
	 * @return [type] [description]
	 */
	function edit_admin_menus() {
		global $submenu;

		$menu_name = 'Dashboard';
		if ( $this->is_setup ){
			$menu_name = 'Quick setup';
		}

		if ( current_user_can( 'manage_options' ) ) {
			$submenu['zn-about'][0][0] = $menu_name;
		}
	}

	/**
	 * Removes all WP actions so we can have a clean page
	 * @return null
	 */
	function remove_actions(){

		$screen = get_current_screen();

		if ( in_array( $screen->id, $this->theme_pages ) ) {
			remove_all_actions( 'admin_notices' );
		}

		return false;
	}


	function zn_print_scripts( $hook ){

		/* Set default theme pages where the js and css should be loaded */
		$this->theme_pages[] = 'post.php';
		$this->theme_pages[] = 'post-new.php';
		$this->theme_pages[] = 'edit-tags.php';
		$this->theme_pages[] = 'term.php';
		$this->theme_pages[] = 'widgets.php';
		$this->theme_pages   = apply_filters( 'zn_theme_pages', $this->theme_pages );

		// Load about page scripts
		if( $hook === 'toplevel_page_zn-about' ) {

			wp_enqueue_style( 'zn_about_style', FW_URL .'/admin/assets/css/zn_about.css', array(), ZN()->version );
			wp_enqueue_style( 'zn_html_css', FW_URL .'/assets/css/zn_html_css.css' );

			wp_enqueue_script( 'jquery-ui-draggable' ); // PB
			wp_enqueue_script( 'zn_modal', FW_URL .'/assets/js/zn_modal.js',array( 'jquery' ),ZN_FW_VERSION,true );
			wp_enqueue_script( 'jquery-ui-tooltip');
			wp_enqueue_script( 'zn_about_script', FW_URL .'/admin/assets/js/zn_about.js', array('jquery'), ZN()->version );
		}

		if ( ! in_array( $hook, $this->theme_pages ) ) {
			return;
		}

		// LOAD CUSTOM SCRIPTS
		wp_enqueue_script( 'zn_theme_ajax_callback', FW_URL .'/assets/js/zn_theme_ajax_callback.js', 'jquery','',true );
		add_action('admin_print_styles', array( &$this, 'admin_css' ) );

		ZN()->load_html_scripts();
	}

	function admin_css(){
		echo '<!-- ICON FONTS CSS -->';
		echo '<style type="text/css">';
			echo ZN()->icon_manager->set_css( '' );
		echo '</style>';
	}

	function zn_render_page() {

		// Get the curent slug
		$slug = $_GET['page'];
		$slug = str_replace( 'zn_tp_', '', $slug );
		$this->data['slug'] = $slug;


		$this->data['theme_options'] = $this->get_theme_options();
		ZN()->html()->zn_set_data( $this->data );

		echo ZN()->html()->zn_page_start();
		echo ZN()->html()->zn_render_page_options();
		echo ZN()->html()->zn_page_end();
	}

	/**
	 * Renders the admin pages
	 * @return [type] [description]
	 */
	function about_screen(){
		include( dirname(__FILE__) .'/tmpl/header-tmpl.php' );
		include( dirname(__FILE__) .'/tmpl/content-tmpl.php' );
		include( dirname(__FILE__) .'/tmpl/footer-tmpl.php' );
	}

}


?>
