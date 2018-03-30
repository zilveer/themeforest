<?php if(! defined('ABSPATH')){ return; }


class ZnDummyDataManager{

	private $file_location;
	private $wp_import;
	private $posts_count;
	private $microtime;
	private $post_number = 0;
	private $step;

	/**
	 * Holds the wp_upload_dir() paths
	 * @var array
	 */
	var $upload_dir_config;

	/**
	 * Holds the uploads directory url
	 * @var string
	 */
	var $upload_dir_url;

	/**
	 * Holds the uploads directory url without WWW
	 * @var string
	 */
	var $upload_dir_url_no_www;

	/**
	 * Holds the uploads directory path
	 * @var string
	 */
	var $upload_dir_path;

	/**
	 * Holds the uploads placeholder used for replacing the uploads urls
	 * @var string
	 */
	var $site_url_placeholder = 'ZNBP_SITE_URL_PLACEHOLDER';

	/**
	 * Holds the allowed file types on export
	 * @var array
	 */
	var $allowed_file_types = array(
		'jpg',
		'png',
		'gif',
		'svg',
		'jpeg',
		'txt',
		'woff',
		'ttf',
		'eot',
	);

	/**
	 * Holds the list of errors during import
	 * @since v4.1.5
	 * @var array
	 */
	private $_errors = array();

	function __construct( $file_location, $options = null ){

		if( empty( $file_location ) ){
			return false;
		}

		$this->upload_dir_config = wp_upload_dir();
		$this->upload_dir_path = $this->upload_dir_config['basedir'];
		$this->upload_dir_url = $this->upload_dir_config['baseurl'];
		$this->upload_dir_url_no_www = str_replace('www.', '', $this->upload_dir_url );

		$this->file_location = $file_location;
		$this->load_importers();
		$this->do_import( $options );

	}

	function load_importers(){
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
		if ( ! class_exists('WP_Import') ) {
			require_once( dirname( __FILE__ ) . '/inc/dummy_install/wordpress-importer.php' );
		}
	}

	function do_import( $options = null ){

		$this->microtime = microtime( true );
		$result = '';

		// Check what we need to install
		// @since v4.1.5
		// If option: Install dependant plugins
		if(isset($options['demo_name']) && ! empty($options['demo_name'])) {
			// check to see if we didn't complete this step already
			$v = get_transient('zn_dummy_data_install_plugins');
			if(empty($v)) {
				if ( isset( $options['zn_dummy_data_install_plugins'] ) ) {
					$demoName = $options['demo_name'];
					// Get the list of demos
					$infoDummy = znkl_dummy_data_locations();
					// check if the provided demo exists
					if ( isset( $infoDummy[ $demoName ] ) ) {
						// Check if there are any dependencies
						if ( isset( $infoDummy[ $demoName ]['plugins'] ) && ! empty( $infoDummy[ $demoName ]['plugins'] )) {
							$plugins   = $infoDummy[ $demoName ]['plugins'];
							$installer = ZnAddonsManager::instance();
							foreach ( $plugins as $slug ) {
								// Check to see if the plugin is already installed
								if( $installer->is_plugin_installed( $slug ) ){
									if( ! $installer->is_plugin_active( $slug ) ){
										// try to activate the plugin
										$result = $installer->do_plugin_activate( $slug );
									}
								}
								else{
									// Insall the plugin and activate it
									$result = $installer->do_plugin_install( $slug );
								}

								// Log potential errors
								if ( is_array( $result ) && isset( $result['error'] ) ) {
									array_push( $this->_errors, '[{$slug}]'. $result['error'] );
								}
							}
							// save transient for 30 minutes
							set_transient('zn_dummy_data_install_plugins', true, 1800);
						}
					}
				}
			}
		}

		// Import theme options
		$v = get_transient('zn_dummy_data_import_theme_options');
		if(empty($v)) {
			if(isset($options['zn_dummy_data_import_theme_options'])){
				$this->import_theme_options();
				// save transient for 30 minutes
				set_transient('zn_dummy_data_import_theme_options', true, 1800);
			}
		}

		// Import widgets' settings
		$v = get_transient('zn_dummy_data_import_widgets');
		if(empty($v)) {
			if(isset($options['zn_dummy_data_import_widgets'])){
				$this->import_widgets();
				// save transient for 30 minutes
				set_transient('zn_dummy_data_import_widgets', true, 1800);
			}
		}

		// Import demo content
		$v = get_transient('zn_dummy_data_import_content');
		if(empty($v)) {
			if(isset($options['zn_dummy_data_import_content'])){

				//@since v4.1.5 - Check whether or not we need to import attachments
				$importAttachments = isset($options['zn_dummy_data_import_attachments']);

				$this->import_xml($importAttachments);
				$this->import_revolution_sliders();

				// save transient for 30 minutes
				set_transient('zn_dummy_data_import_content', true, 1800);
			}
		}

		// Import custom icons
		$v = get_transient('zn_dummy_data_import_custom_icons');
		if(empty($v)) {
			$this->import_custom_icons();
			// save transient for 30 minutes
			set_transient('zn_dummy_data_import_custom_icons', true, 1800);
		}

		// Load the export confiog file
		$v = get_transient('zn_dummy_data_export_config');
		if(empty($v)) {
			$this->do_export_config();
			// save transient for 30 minutes
			set_transient('zn_dummy_data_export_config', true, 1800);
		}

		// Finish import
		$this->finish_import();
	}

	/**
	 * Handles Revolution slider imports if the dummy folder contains such an export
	 * @return null
	 */
	function import_revolution_sliders(){

		// Don't run if Revolution slider doesn't exist
		if( ! class_exists('RevSlider') ) { return; }

		// Check to see if we need to import revolution slider
		$config_file = $this->file_location.'/revsliders/sliders_config.php';
		if( ! file_exists( $config_file ) ){
			return;
		}

		// Load the sliders export config file
		include( $config_file );

		if( isset( $revSlidersConfig ) && is_array( $revSlidersConfig ) ){
			foreach ($revSlidersConfig as $key => $slider_config) {

				$slider = new RevSlider();
				$filepath = trailingslashit( $this->file_location ) . 'revsliders/' . $slider_config['file'];
				$slider->importSliderFromPost(true, 'none', $filepath );

			}
		}

	}

	/**
	 * Import demo content +- attachments
	 * @param bool|true $importAttachments Whether or not to import file attachments. Defaults to true
	 * @since v4.1.5
	 */
	function import_xml( $importAttachments = true ){

		add_filter( 'wp_import_post_meta', array( &$this, 'fix_import_meta'), 10, 3  );
		add_filter( 'intermediate_image_sizes_advanced', array( &$this, 'disable_image_resize'), 999 );
		add_filter( 'wp_import_posts', array( &$this, 'process_posts_step') );
		add_filter( 'wp_import_post_data_raw', array( &$this, 'chek_single_post_import') );

		$this->wp_import = new WP_Import();

		// Get the data if we have some
		$this->zn_get_data();

		set_time_limit(0);

		$this->wp_import->fetch_attachments = (bool)$importAttachments;
		$this->wp_import->import( $this->file_location.'/dummy.xml' );
	}

	/**
	 * Send a json response that the theme can read
	 *
	 * @param $response
	 */
	function zn_send_json( $response ) {

		// Try to clean all bufffers
		while (ob_get_level()) {
			ob_end_clean();
		}

		// Fixes PHP Warning if headers already sent
		if(! headers_sent()) {
			header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
		}
		$response = json_encode( $response );
		echo '<div class="zn_json_response">';
			echo $response;
		echo '</div>';
		die();
	}


	function process_posts_step( $posts ){
		$this->posts_count = count( $posts );
		$posts = array_slice( $posts, $this->post_number );
		return $posts;
	}

	function chek_single_post_import( $post ){
		$time = microtime( true ) - $this->microtime;

		if ( $time > 15 ) {
			// We should make a new ajax call
			$this->step = 'process_posts';
			$this->set_data();
			$response = array(
				'status' => 'ok',
				'response_text' => 'Imported '.( $this->post_number - 1 ).' out of '.$this->posts_count
			);

			$this->zn_send_json( $response );

		}

		$this->post_number += 1;

		return $post;
	}


	/**
	 * Save the import data in DB
	 */
	function zn_get_data(){

		if( $data = get_transient( 'zn_dummy_install' ) ) {

			if( !empty($data['id']) ) { $this->wp_import->id = $data['id']; }
			if( !empty($data['processed_authors']) ) { $this->wp_import->processed_authors = $data['processed_authors']; }
			if( !empty($data['author_mapping']) ) { $this->wp_import->author_mapping = $data['author_mapping']; }
			if( !empty($data['processed_menu_items']) ) { $this->wp_import->processed_menu_items = $data['processed_menu_items']; }
			if( !empty($data['post_orphans']) ) { $this->wp_import->post_orphans = $data['post_orphans']; }
			if( !empty($data['processed_posts']) ) { $this->wp_import->processed_posts = $data['processed_posts']; }
			if( !empty($data['processed_terms']) ) { $this->wp_import->processed_terms = $data['processed_terms']; }
			if( !empty($data['url_remap']) ) { $this->wp_import->url_remap = $data['url_remap']; }
			if( !empty($data['missing_menu_items']) ) { $this->wp_import->missing_menu_items = $data['missing_menu_items']; }
			if( !empty($data['menu_item_orphans']) ) { $this->wp_import->menu_item_orphans = $data['menu_item_orphans']; }
			if( !empty($data['featured_images']) ) { $this->wp_import->featured_images = $data['featured_images']; }
			if( !empty($data['post_number']) ) { $this->post_number = $data['post_number']; }
			if( !empty($data['step']) ) { $this->step = $data['step']; }

		}

	}

	/**
	 * Set the data back to this class
	 */
	function set_data(){

		$data = array(
			'id' => $this->wp_import->id,
			'processed_authors' => $this->wp_import->processed_authors,
			'author_mapping' => $this->wp_import->author_mapping,
			'processed_menu_items' => $this->wp_import->processed_menu_items,
			'post_orphans' => $this->wp_import->post_orphans,
			'processed_posts' => $this->wp_import->processed_posts,
			'processed_terms' => $this->wp_import->processed_terms,
			'url_remap' => $this->wp_import->url_remap,
			'missing_menu_items' => $this->wp_import->missing_menu_items,
			'menu_item_orphans' => $this->wp_import->menu_item_orphans,
			'featured_images' => $this->wp_import->featured_images,
			'post_number' => $this->post_number,
			'step' => $this->step
		);

		set_transient( 'zn_dummy_install', $data, 12 * HOUR_IN_SECONDS );
	}

	/**
	 * Clear the saved data from the database
	 */
	function clear_data(){
		delete_transient( 'zn_dummy_install' );
	}


	/**
	 * Will prevent WordPress from resizing the images
	 * @return array empty array so the images are not resized
	 */
	public function disable_image_resize(){
		return array();
	}

	/**
	 * Callback for fix_import_meta function
	 */
	public function ext_fix_import_meta( $matches ){
		return 's:'.strlen($matches[2]).':"'.$matches[2].'";';
	}

	/**
	 * Will fix the pagebuilder meta value data
	 * @param  [type] $post_postmeta [description]
	 * @param  [type] $post_id       [description]
	 * @param  [type] $post          [description]
	 * @return [type]                [description]
	 */
	public function fix_import_meta( $post_postmeta, $post_id, $post ){

		foreach ( $post_postmeta as &$meta ) {
			if( $meta['key'] == 'zn_page_builder_els' ){
				$meta['value'] = preg_replace_callback(
					'!s:(\d+):"(.*?)";!s', array( $this, 'ext_fix_import_meta') ,
					$meta['value']
				);
			}
		}

		return $post_postmeta;
	}

	function import_theme_options(){

		$file =  $this->file_location."/theme_options.txt";

		// Fail early if this is not needed
		if( ! is_file( $file ) ) { return; }

		$data = file_get_contents( $file );
		$saved_values = json_decode( $data, true );
		$saved_values = $this->zpbp_parse_recursive_import( $saved_values );
		znklfw_save_theme_options( $saved_values );
	}



	function zpbp_parse_recursive_import( &$template ){

		if( empty( $template ) ) return $template;

		if ( is_array( $template ) ){
			foreach ($template as $key => &$value) {
				if ( empty( $value ) ) continue;

				if( is_array( $value ) ){
					$this->zpbp_parse_recursive_import( $value );
				}
				else{
					// Check if this is exportable media
					$value = $this->znpb_import_media( $value );
				}
			}
		}
		else{
			// This should be a string
			$template = $this->znpb_import_media( $template );
		}

		return $template;
	}

	/**
	 * This function checks to see if we have an exportable media and if so, it will add it to the zip file
	 * @param  [type] $url [description]
	 * @param  [type] $zip [description]
	 * @return [type]      [description]
	 */
	private function znpb_import_media( $url ){

		$file_types = implode('|', $this->allowed_file_types);
		$pattern = "#{$this->site_url_placeholder}\/\S+\.($file_types)#";
		$url = preg_replace_callback( $pattern, array( $this, 'media_import_callback' ), $url );

		return $url;
	}

	/**
	 * This function adds the media file to the zip archive and replaces the uploads directory path with a placeholder path that we cann replace on import
	 * @param  array $file The preg_replace match
	 * @return string The modified file url
	 */
	function media_import_callback($file){

		// Get the media file path relative to the uploads folder
		$file_path = str_replace($this->site_url_placeholder, '', $file[0]);
		// Upload the file
		return $this->upload_dir_url . $file_path;
	}



	function import_custom_icons(){
		$path = $this->file_location.'/custom_icons/';
		if( ! file_exists( $path ) ){
			return;
		}

		$files = array_diff(scandir($path), array('..', '.'));

		foreach( $files as $file ){
			ZN()->icon_manager->do_icon_install( $path.$file, 'dummy_title' );
		}
	}

	function import_widgets(){

		$file =  THEME_BASE."/template_helpers/dummy_content/widgets.txt";
		if( ! is_file( $file ) ) {
			return false;
		}

		global $wp_registered_sidebars;

		$data = file_get_contents( $file );
		//print_z($data); die();
		$data = json_decode( $data, true );

		// Return if we have no widgets
		if ( empty( $data ) ) { return false; }

		$available_widgets = $this->get_available_widgets();

		// Get all existing widget instances
		$widget_instances = array();
		foreach ( $available_widgets as $widget_data ) {
			$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
		}

		// Begin results
		$results = array();

		// Loop import data's sidebars
		foreach ( $data as $sidebar_id => $widgets ) {

			// Check if sidebar is available on this site
			// Otherwise add widgets to inactive, and say so
			if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
				$sidebar_available = true;
				$use_sidebar_id = $sidebar_id;
			} else {
				$sidebar_available = false;
				$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
			}


			// Loop widgets
			foreach ( $widgets as $widget_instance_id => $widget ) {

				$fail = false;

				// Get id_base (remove -# from end) and instance ID number
				$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
				$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

				// Does site support this widget?
				if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
					$fail = true;
				}

				// Does widget with identical settings already exist in same sidebar?
				if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

					// Get existing widgets in this sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' );
					$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

					// Loop widgets with ID base
					$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
					foreach ( $single_widget_instances as $check_id => $check_widget ) {

						// Is widget in same sidebar and has identical settings?
						if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {
							$fail = true;
							break;
						}
					}
				}

				// No failure
				if ( ! $fail ) {

					// Add widget instance
					$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
					$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
					$single_widget_instances[] = (array) $widget; // add it

						// Get the key it was given
						end( $single_widget_instances );
						$new_instance_id_number = key( $single_widget_instances );

						// If key is 0, make it 1
						// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
						if ( '0' === strval( $new_instance_id_number ) ) {
							$new_instance_id_number = 1;
							$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
							unset( $single_widget_instances[0] );
						}

						// Move _multiwidget to end of array for uniformity
						if ( isset( $single_widget_instances['_multiwidget'] ) ) {
							$multiwidget = $single_widget_instances['_multiwidget'];
							unset( $single_widget_instances['_multiwidget'] );
							$single_widget_instances['_multiwidget'] = $multiwidget;
						}

						// Update option with new widget
						update_option( 'widget_' . $id_base, $single_widget_instances );

					// Assign widget instance to sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
					$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
					$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
					update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

				}

			}
		}
	}

	/**
	 * Get available widgets
	 *
	 * @return array
	 */
	function get_available_widgets() {
		global $wp_registered_widget_controls;

		$widget_controls = $wp_registered_widget_controls;

		$available_widgets = array();

		foreach ( $widget_controls as $widget ) {

			if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

				$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
				$available_widgets[$widget['id_base']]['name'] = $widget['name'];

			}

		}

		return $available_widgets;
	}

	function do_export_config(){
		$file =  $this->file_location."/dummy_config.php";
		// Fail early if this is not needed
		if( ! is_file( $file ) ) { return; }

		include( $file );
	}

	function finish_import(){
		// Here we will add the proper menus
		// Menus to Import and assign - you can remove or add as many as you want
		$main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
		set_theme_mod( 'nav_menu_locations', array(
				'main_navigation' => $main_menu->term_id
			)
		);

		$this->clear_data();
		$response = array(
			'status' => 'done',
			'response_text' => 'Import finished'
		);

		//@since v4.1.5
		// Check if there are any errors
		if(! empty($this->_errors)){
			error_log('[Kallyas Demo Import] Import finished but there were some warnings: '.var_export($this->_errors,1));
		}

		// Delete cache
		delete_transient('zn_dummy_data_install_plugins');
		delete_transient('zn_dummy_data_import_theme_options');
		delete_transient('zn_dummy_data_import_widgets');
		delete_transient('zn_dummy_data_import_content');
		delete_transient('zn_dummy_data_import_custom_icons');
		delete_transient('zn_dummy_data_export_config');

		$this->zn_send_json( $response );
	}
}
