<?php
/**
* This class handles all functionality for the page builder
*
* @category   Pagebuilder
* @package    ZnFramework
* @author     Balasa Sorin Stefan ( Zauan )
* @copyright  Copyright (c) Balasa Sorin Stefan
* @link       http://themeforest.net/user/zauan
*/

define( 'PB_PATH', dirname(__FILE__) );

class ZnPageBuilder
{

	/**
	 * Contains the editor state ( true - the editor is enabled; false - the editor is disabled )
	 *
	 * @property $draft_layout_data
	 * @type bool
	 * @public
	 */
	public $is_active_editor = false;

	/**
	 * Holds a refference of all smart areas that needs to be rendered in the current page
	 * @var array
	 */
	public $registered_smart_areas = array();

	/**
	 * Contains the pagebuilder state ( true - the pagebuilder is enabled for this page; false - the editor is disabled for this page )
	 *
	 * @property $draft_layout_data
	 * @type bool
	 * @public
	 */
	public $is_active_pagebuilder = false;

	/**
	 * Contains the current page id or the id for the page we are editing
	 *
	 * @property $post_id
	 * @type bool || string
	 * @public
	 */
	static public $post_id = false;

	/**
	 * Contains the current page layout based on the saved values
	 *
	 * @property $post_id
	 * @type bool || string
	 * @public
	 */
	public $current_page_layout = array();

	/**
	 * Contains all available pagebuilder elements
	 *
	 * @property $all_available_elements
	 * @type array
	 * @public
	 */
	var $all_available_elements = array();

	/**
	 * Contains all instantiated elements
	 *
	 * @property $post_id
	 * @type array
	 * @public
	 */
	var $loaded_modules = array();

	/**
	 * Hold information about modules added on the fly
	 * @var array
	 */
	var $current_modules = array();

	/**
	 * Contains all instantiated modules with data
	 *
	 * @property $loaded_modules
	 * @type array()
	 * @protected
	 */
	public $instantiated_modules = array();

	public $editor;

	/**
	 * Constructor
	 *
	 * @access public
	 */
	function __construct()
	{

		// This is the backend templates system
		include( PB_PATH .'/class-templates.php' );
		$this->scripts_manager = include( PB_PATH .'/scripts-manager.php' );

		// This is the frontened templates system
		include( PB_PATH .'/class-page-builder-templates.php' );
		include( PB_PATH .'/class-page-builder-custom-code.php' );
		include( 'class-elements-render.php' );
		include( PB_PATH .'/class-page-builder-ajax.php' );
		include( FW_PATH .'/pagebuilder/class-page-builder-admin.php' );

		$this->templates = new ZnTemplateSystem();
		$this->codes = new ZnPbCustomCode();

		if( is_admin() ) {
			new ZnPageBuilderAdmin();
			add_action( 'activated_plugin', array(&$this, 'refresh_pb_data') );
			add_action( 'deactivated_plugin', array(&$this, 'zn_deactivate_plugin') );
			add_action( 'zn_theme_updated', array(&$this, 'refresh_pb_data') );
			add_action( 'init', array(&$this, 'check_plugin_deactivation') );
		}

		add_action( 'wp' , array(&$this, 'init') );
		// Add the "Edit with pagebuilder" to the admin bar
		add_action( 'admin_bar_menu', array(&$this, 'zn_add_admin_bar_edit'), 999 );

		// Check if this is a pagebuilder enabled page and load our editor/renderer
		add_action( 'template_include' , array(&$this, 'load_pb_template'), 999 );

		// Only if we have the pagebuilder enabled
		add_action( 'zn_pb_content', array(&$this, 'znpb_content') );
		add_action( 'wp_enqueue_scripts' , array(&$this, 'zn_load_styles'), 9 );

		/**
		 * Extend the search query to include the Page Builder elements
		 * @since v3.6.7
		 */
		add_filter('pre_get_posts', array(&$this, 'updateSearchQuery'));

		/**
		 * Save the PB data as a post revision
		 * @since v4.0.12
		 */
		add_action( 'znpb_save_page', array(&$this, 'save_post_revision') );
		add_action( 'wp_restore_post_revision', array(&$this, 'restore_post_revision'), 10, 2 );

	}

	/**
	 * Restorre the PB data as a post revision
	 * @since v4.0.12
	 */
	function restore_post_revision( $post_id, $revision_id ){
		$post     = get_post( $post_id );
		$revision = get_post( $revision_id );
		$pb_data  = get_metadata( 'post', $revision->ID, 'zn_page_builder_els', true );

		if ( false !== $pb_data )
			update_post_meta( $post_id, 'zn_page_builder_els', $pb_data );
		else
			delete_post_meta( $post_id, 'zn_page_builder_els' );
	}

	/**
	 * Save the PB data as a post revision
	 * @since v4.0.12
	 */
	public function save_post_revision(){
		add_action( 'save_post', array(&$this, 'update_post_revision'), 10, 2 );
		add_action( 'wp_revisions_to_keep', array(&$this, 'wp_revisions_to_keep'), 1, 2 );
		add_filter( 'wp_save_post_revision_check_for_changes', array ( &$this,  'force_save_revision' ) );
		wp_save_post_revision( zn_get_the_id() );
	}

	/**
	 * Limit the post revisions to 5 if they are enabled
	 * @since v4.0.12
	 */
	public function wp_revisions_to_keep( $num, $post ){
		if( $num === -1 ){
			$num = 5;
		}
		return $num;
	}

	/**
	 * Disable the revision change check for PB content page save
	 * @since v4.0.12
	 */
	public function force_save_revision(){
		return false;
	}

	/**
	 * Add the pagebuilder content to a post revision upon saving
	 * @since v4.0.12
	 */
	public function update_post_revision( $post_id, $post ) {

		$parent_id = wp_is_post_revision( $post_id );

		if ( $parent_id ) {

			$parent  = get_post( $parent_id );
			$pb_data = get_post_meta( $parent->ID, 'zn_page_builder_els', true );

			if ( false !== $pb_data ){
				add_metadata( 'post', $post_id, 'zn_page_builder_els', $pb_data );
			}

		}

	}

	/**
	 * Updates the search where query to include the meta fields
	 *
	 * @param $query
	 * @return mixed
	 */
	public function zn_search_pb_join( $join ) {
		global $wpdb;
		$join .= " LEFT JOIN $wpdb->postmeta AS pb_meta ON $wpdb->posts.ID = pb_meta.post_id ";
		remove_filter( 'posts_join', array(&$this, 'zn_search_pb_join'), 99 );
		return $join;
	}

	/**
	 * Updates the search SQL to include pagebuilder data
	 *
	 * @param $query
	 * @return mixed
	 */
	public function zn_search_pb( $search, $query ){

		global $wpdb, $wp;
		$search = preg_replace_callback(
			"/$wpdb->posts.post_title LIKE '%(.*?)%'/",
			array(&$this, 'zn_search_callback'),
			$search
		);

		remove_filter( 'posts_search', array(&$this, 'zn_search_pb'), 99 );
		return $search;
	}

	public function zn_search_callback( $matches ){
		global $wpdb, $wp;
		return "{$matches['0']}) OR (pb_meta.meta_value LIKE '%{$matches['1']}%'";
	}

	/**
	 * Updates the search query to include the Page Builder elements
	 *
	 * @param $query
	 * @return mixed
	 */
	public function updateSearchQuery($query){
		$canSearch = ( ! is_admin() && $query->is_main_query() && is_search() && !empty($query));
		if($canSearch){
			add_filter( 'posts_search', array(&$this, 'zn_search_pb'), 99, 2);
			add_filter( 'posts_join', array(&$this, 'zn_search_pb_join'), 99, 1);
			add_filter( 'posts_distinct_request', array(&$this, 'search_distinct'), 99, 1);
		}
		return $query;
	}

	/**
	 * Updates the search to return only distinct results
	 *
	 * @param $query
	 * @return mixed
	 */
	public function search_distinct( $distinct ) {
		remove_filter( 'posts_distinct_request', array(&$this, 'search_distinct'), 99);
		return "DISTINCT";
	}


	/**
	 * GETS current post id
	 * SETS : $is_active_editor , $is_active_pagebuilder , $current_post_id
	 *
	 * @access private
	 */
	public function get_post_id() {

		if( !empty( self::$post_id ) ) { return self::$post_id; }

		global $post;

		if(isset($_POST['post_id'])) {
			return self::$post_id = $_POST['post_id'];
		}
		elseif( is_singular() && !empty($post) ) {
			return self::$post_id = $post->ID;
		}
		elseif( is_archive() ){
			// Check woocommerce archive
			if( znfw_is_woocommerce_active() ){

				// Woocommerce archive pages
				if( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ){
					return wc_get_page_id( 'shop' );
				}

			}
			else{
				return false;
			}
		}
		elseif( is_home() ){
			// This is the Blog archive page. We need to check if a custom page is used or not
			return get_option( 'page_for_posts' );
		}
		else {
			return false;
		}
	}

	function init() {

		// CHECK IF WE ARE ON EDITOR SCREEN OR NOT
		$this->set_editor_state();

		if ( $this->is_active_pagebuilder ) {
			$this->set_page_layout();
			$this->get_all_modules();
			$this->load_page_modules();
		}

		// LOAD STUFF WHEN WE HAVE THE EDITOR ACTIVE
		if ( $this->is_active_editor ) {
			$this->activate_pagebuilder_editor();
		}

		if ( ZN()->is_debug() ){
			$this->refresh_pb_data();
		}

		do_action( 'znpb_init', $this );

	}

	/**
	 * Returns the pagebuilder content data as a string
	 *
	 * @access public
	 * @var $content string
	 * @return string
	 */
	public function get_pb_content_data( $content ){
		$flat = '';

		$skipped = array(
			'object',
			'uid',
			'width',
		);

		if ( empty( $content ) || ! is_array( $content ) ) {
			return $flat;
		}

		if ( is_array( $content ) ) {
			foreach ( $content as $key => $value ) {

				if( in_array( $key, $skipped, true ) ){
					continue;
				}

				if ( is_array( $value ) ) {
					$flat .= $this->get_pb_content_data( $value );
				}
				else {
					$flat .= ' ' . $value;
				}
			}
		}
		else {
			return ' ' . $content;
		}

		return $flat;
	}

	/**
	 * Check if the current page has the pageuilder editor enabled
	 *
	 * @access public
	 */
	private function set_editor_state() {

		$post_id = $this->get_post_id();

		// CHECKS IF THE PAGEBUILDER EDITOR IS ACTIVATED
		if ( current_user_can( 'edit_post' , $post_id ) && ( isset( $_GET['zn_pb_edit'] ) || defined( 'ZN_PB_AJAX' ) ) ) {
			if( isset( $_GET['zn_pb_edit'] ) ){
				update_post_meta( $post_id, 'zn_page_builder_status', 'enabled' );
			}

			$this->is_active_editor = true;
			$this->is_active_pagebuilder = true;

		}
		// CHECKS IF THE PAGEBUILDER IS ACTIVE FOR THIS PAGE
		elseif( get_post_meta( $post_id, 'zn_page_builder_status', true ) == 'enabled' ) {
			$this->is_active_pagebuilder = true;
		}

	}

	public function change_editor_state( $state = true ){
		$this->is_active_editor = $state;
	}

	function activate_pagebuilder_editor(){
		include( 'class-page-builder-editor.php' );
		$this->editor = new ZnPageBuilderEditor();
	}

	/**
	 * Add the edit with page builder button in the admin bar
	 *
	 * @param $wp_admin_bar object
	 * @access public
	 */
	function zn_add_admin_bar_edit( $wp_admin_bar ) {

		$post_id = $this->get_post_id();
		if ( ! empty( $post_id ) ) {

			if( ! current_user_can( 'edit_post' , $post_id ) ){
				return;
			}

			if ( $this->is_active_pagebuilder ) {

				if( $this->is_active_editor ){
					$args = array(
						'id'    => 'zn_preview_button',
						'title' => 'View page',
						'href'  => esc_url( get_permalink( $post_id ) ),
						'meta'  => array( 'class' => 'zn_preview_page_button' )
					);
					$wp_admin_bar->add_node( $args );
				}
				else{
					$args = array(
						'id'    => 'zn_edit_button',
						'title' => 'Edit with page builder',
						'href'  => $this->get_edit_url( $post_id ),
						'meta'  => array( 'class' => 'zn_edit_button' )
					);
					$wp_admin_bar->add_node( $args );
				}

			}

		}

	}

	/**
	 * Returns the edit post link
	 *
	 * @access public
	 * @param $post_id string
	 * @return string
	 */
	function get_edit_url( $post_id = '' ){
		$the_ID = ( strlen( $post_id ) > 0 ? $post_id : get_the_ID() );

		$preview_link = get_permalink( $the_ID );
		$preview_link = apply_filters('preview_post_link', $preview_link);
		// Adds the zn_pb_edit=true to the url
		return esc_url( add_query_arg( 'zn_pb_edit', 'true', $preview_link ));


	}

	/**
	 * Set a transient so we can refresh the PB data on the next page loading
	 * When a plugin is deactivated, it's classes are still availbale
	 *
	 * @access public
	 */
	function zn_deactivate_plugin(){
		set_transient( 'zn_plugin_deactivated', true, 12 * HOUR_IN_SECONDS );
	}

	/**
	 * Refresh pb data when a plugin is deactivated
	 *
	 * @access public
	 */
	function check_plugin_deactivation(){
		if( get_transient( 'zn_plugin_deactivated' ) ){
			$this->refresh_pb_data();
			delete_transient( 'zn_plugin_deactivated' );
		}
	}


	/**
	 * Refreshes the PB data and combined CSS files
	 *
	 * @access public
	 */
	function refresh_pb_data(){
		$this->get_all_modules(true);
		$this->compile_css(true);
		$this->scripts_manager->delete_all_cache();
	}

	function set_page_layout(){

		$post_id 		= $this->get_post_id();
//		delete_post_meta( $post_id, 'zn_page_builder_els' );
		$layout_data 	= get_metadata('post', $post_id, 'zn_page_builder_els', true);
		$post       	= get_post($post_id);

		if( ! is_array( $layout_data ) ) {

			if( ! $sections = apply_filters( 'znpb_empty_page_layout', $layout_data, $post, $post_id ) ){
				// We will add the new elements here
				$textbox    = $this->add_module_to_layout( 'ZnTextBox', array( 'title' => $post->post_title, 'desc' => $post->post_content ) );
				$column     = $this->add_module_to_layout( 'ZnColumn',  array() , array( $textbox ), 'col-sm-12' );
				$sections    = array( $this->add_module_to_layout( 'ZnSection', array() , array( $column ), 'col-sm-12' ) );
			}

			$this->current_page_layout = $sections;

		}
		else{
			$this->current_page_layout = $layout_data;
		}

	}

	/**
	 * Creates a module array
	 *
	 * @access public
	 * @param $module_object string
	 * @param $options array
	 * @param $content array
	 * @param $width string
	 * @return array
	 */
	function add_module_to_layout( $module_object = null, $options = array(), $content = array(), $width = null ){

		$module = array();
		$module['object'] = $module_object;
		$module['options'] = $options;
		$module['content'] = $content;
		$module['width'] = $width;
		$module['uid'] = zn_uid('eluid');

		$this->added_modules[] = $module;

		return $module;
	}

	/**
	 * POPULATES THE $current_elements & $elements variables
	 *
	 * @access public
	 * @return void
	 */
	function load_page_modules( $layout = false ) {
		$current_layout = $layout ? $layout : $this->current_page_layout;
		// FIRE UP ALL THE ELEMENTS
		if ( is_array( $current_layout ) ) {

			foreach ( $current_layout as $element ) {
				$this->load_element( $element );
			}

		}

	}

	/**
	 * LOADS A SINGLE PAGEBUILDER ELEMENT AND SET"S THE DEPENDENCIES
	 *
	 * @access public
	 * @param $element array
	 * @return array
	 */
	function load_element( $element ) {

		// Check to see if this is a valid module
		if ( ! empty( $element['object'] ) && empty( $this->all_available_elements[ $element['object'] ] ) ) { return false; }

		// Load the module file
		if ( file_exists( $this->all_available_elements[ $element['object'] ]['file'] ) ) {
			include_once( $this->all_available_elements[ $element['object'] ]['file'] );
			if ( class_exists($element['object']) ) {
				$element_class = new $element['object']();
				$this->loaded_modules[ $element['object'] ] = $element_class;
			}

			// ADD THE ELEMENT TO THE $current_elements VARIABLE
			$element_class->data = $element;

			// LOAD THE REQUIRED JS FILES
			if( method_exists( $element_class, 'scripts') ) {
				add_action( 'wp_enqueue_scripts' , array(&$element_class, 'scripts') );
			}

			// LOAD INLINE JS
			if ( $element_class->js() ) {
				ZN()->add_inline_js( $element_class->js() );
			}

			// LOAD INLINE CSS
			$css = $element_class->css();
			if ( $css ){
				ZN()->add_inline_css( $css );
			}

			//@wpk: Fixes Fatal error (Cannot unset string offsets) when $element['content'] = 'false'
			if( !empty( $element['content'] ) && ('false' != $element['content']) ) {

				if ( !empty( $element['content']['has_multiple'] ) ) {
					if(isset($element['content']['has_multiple'])){
						unset( $element['content']['has_multiple'] );
					}

					foreach ( $element['content'] as $actual_content ) {
						if( is_array( $actual_content ) ){
							foreach ( $actual_content as $value) {
								$this->load_element( $value );
							}
						}
					}

				}
				else {
					foreach ($element['content'] as $key => $value) {
						$this->load_element( $value );
					}
				}

			}

			// This is just for the Pagebuilder Template element
			if( $element['object'] === 'ZnPbCustomTempalte' ){
				$template = $element_class->opt( 'pb_template' );
				if( ! empty( $template ) ) {
					$pb_data = get_post_meta( $template, 'zn_page_builder_els', true );
					if( is_array( $pb_data ) ){
						foreach ( $pb_data as $key => $value ) {
							$this->load_element( $value );
						}
					}
				}
			}

			if ( empty( $element['uid'] ) ) { $element['uid'] = zn_uid('eluid'); }
			$this->instantiated_modules[ $element['uid'] ] = $element_class;

			return $element_class;
		}
		else{
			return false;
		}
	}

	/**
	 * HOOK INTO THE zn_pb_content ACTION FROM loop-page-builder.php
	 *
	 * @access public
	 * @return void
	 */
	function znpb_content() {

		// Render the layout.
		ob_start();
		$this->zn_render_elements( $this->current_page_layout );
		$html = ob_get_clean();

		// Process shortcodes.
		ob_start();
		echo do_shortcode($html);
		$html = ob_get_clean();

		echo '<div class="zn_pb_wrapper clearfix zn_sortable_content" data-droplevel="0">';
			echo  $html;
		echo '</div>';

	}


	/**
	 * CHECKS TO SEE IF WE NEED TO LOAD THE PAGE BUILDER TEMPLATE
	 *
	 * @access public
	 * @return void
	 * @param $template string
	 */
	function load_pb_template( $template ) {

		// CHECK IF WE HAVE A PAGEBUILDER ENABLED PAGE/POST
		if( $this->is_active_pagebuilder && ! post_password_required() ) {
			if ( ! $template = locate_template( array('template_helpers/loop-page_builder.php' ) ) ) {
				$template = dirname( __FILE__ ) .'/loop-page_builder.php';
			}
		}

		return $template;
	}

	/* LOADS THE COMPILED CSS */
	function zn_load_styles(){

		if( $this->is_active_editor ){

			$this->compile_css();

			global $wp_upload_dir;

			$zn_uploads_url = trailingslashit( $wp_upload_dir['baseurl'] );
			$url = $zn_uploads_url . 'zn_pb_css.css';
			$url = set_url_scheme( $url );
			wp_enqueue_style( 'zn_pb_css', $url );
		}
		else{
			$this->scripts_manager->enqueue_cached_assets();
		}

	}

	/* COMPILES THE CSS FROM ALL ELEMENTS */
	function compile_css( $recompile = false ) {

		if( false == get_option( 'zn_css_compiled' ) || $recompile ) {

			global $wp_upload_dir;

			$zn_uploads_path = trailingslashit( $wp_upload_dir['basedir'] );
			$css = false;

			foreach( $this->all_available_elements as $element ) {
				// Check if the style.css file exists
				if ( file_exists( $element['path'].'/style.css') ) {
					$css .= file_get_contents( $element['path'].'/style.css' );
				}

				// Check to see if we have an style.php file
				if( file_exists( $element['path'].'/style.php') ){
					ob_start();
						include( $element['path'].'/style.php' );
					$css .= ob_get_clean();
				}
			}

			$css_code = apply_filters( 'zn_css', zn_minimify( $css ) );

			file_put_contents( $zn_uploads_path . 'zn_pb_css.css', $css_code);
			add_option('zn_css_compiled',true);

		}

	}

	/**
	 * Returns an array containing all pagebuilder elements that are available
	 *
	 * @access public
	 * @param $reload_elements bool
	 * @return array
	 */
	public function get_all_modules( $reload_elements = false ) {

		// Check if a transient is set
		if ( false === $reload_elements ) {

			// Check to see if the elements were already loaded
			if( ! empty( $this->all_available_elements ) ) {
				return $this->all_available_elements;
			}
			elseif ( ( $elements = get_transient( 'zn_pb_elements' ) ) ) {
				return $this->all_available_elements = $elements;
			}
		}

		$dirs = $this->zn_get_elements_dirs();

		$elements = array();

		foreach( $dirs as $entry ) {

			if( ! file_exists( $entry['path'] ) ){
				continue;
			}

			$elements_files_obj = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator( $entry['path'],
				RecursiveIteratorIterator::CHILD_FIRST )
			);
			$elements_files_obj->setMaxDepth ( 2 );

			$default_headers = array(
				'name' => 'Name',
				'description' => 'Description',
				'class' => 'Class',
				'category' => 'Category', // Full width elements , Content , Media , WooCommerce
				'level' => 'Level',
				'keywords' => 'Keywords',
				'unlimited_styles' => 'Styles',
				'flexible' => 'Flexible',
				'dependency_class' => 'Dependency_class',
				'scripts' => 'Scripts',
				'style' => 'Style',
				'has_multiple' => 'Multiple',
				'legacy' => 'Legacy',
			);

			foreach( $elements_files_obj as $filename => $fileobject ) {

				if ( 'php' != pathinfo( $fileobject->getFilename(), PATHINFO_EXTENSION ) )
					continue;

				$headers = get_file_data( $filename, $default_headers );

				if ( !$headers['class'] )
					continue;

				// CHECK IF WE HAVE A DEPENDENCY NOT INSTALLED
				if ( !empty( $headers['dependency_class'] ) && !class_exists( $headers['dependency_class'] ) ) {
					continue;
				}

				$path = $fileobject->getPath();
				$filename = str_replace('\\', '/', $filename);
				$url = trailingslashit($entry['url']) .basename($path);

				$elements[ $headers['class'] ] = array (
						'name' => $headers['name'],
						'class' => $headers['class'],
						'category' => $headers['category'],
						'path' => $path,
						'scripts' => $headers['scripts'],
						'style' => $headers['style'],
						'url' => $url,
						'file' => $filename,
						'flexible' => $headers['flexible'],
						'level' => $headers['level'],
						'unlimited_styles' => $headers['unlimited_styles'],
						'dependency_class' => $headers['dependency_class'],
						'has_multiple' => $headers['has_multiple'],
						'legacy' => $headers['legacy'],
						'keywords' => $headers['keywords'],
						'description' => $headers['description'],
						'icon' => ( is_file ( $path .'/icon.png' ) ) ? $url.'/icon.png' : FW_URL .'/pagebuilder/assets/img/default_icon.png',
					);
			}

		}

		set_transient( 'zn_pb_elements', $elements, WEEK_IN_SECONDS );

		return $this->all_available_elements = $elements;

	}

	/**
	 * Returns an array containing WordPress widgets data.
	 *
	 * @since 1.0
	 * @return array
	 */
	function get_all_widgets(){
		global $wp_widget_factory;

		$widgets = array();

		foreach($wp_widget_factory->widgets as $class => $widget) {
			$widget->class = $class;
			$widgets[$widget->name] = $widget;
		}

		ksort($widgets);

		return $widgets;
	}

	/**
	 * Returns a filtered list of pagebuilder element locations
	 *
	 * Can be filtered by plugins to add new elements
	 */
	function zn_get_elements_dirs() {

		$dirs = array();

		//@since 4.0.12: Allow page builder elements to be added from plugins as well

		// theme
		$dirs[] = array(
			'url' => get_template_directory_uri() .'/pagebuilder/elements',
			'path' => get_template_directory() .'/pagebuilder/elements',
		);
		// child
		$dirs[] = array(
			'url' => get_stylesheet_directory_uri() .'/pagebuilder/elements',
			'path' => get_stylesheet_directory() .'/pagebuilder/elements',
		);
		return apply_filters( 'zn_pb_dirs', $dirs );
	}


	function zn_render_content( $elements ){

		if ( !empty( $elements['has_multiple'] ) ) {
			unset( $elements['has_multiple'] );
			foreach ( $elements as $key => $value ) {
				$this->zn_render_elements( $value );
			}
		}
		else {
			$this->zn_render_elements( $elements );
		}
	}

	/**
	 * This function will render the given content without the ability to edit it
	 * @return [type] [description]
	 */
	function zn_render_uneditable_content( $elements, $area_id = false ){
		$pbstate = $this->is_active_editor;
		$html = '';
		if( $pbstate ){
			// Set editor to disabled
			$this->is_active_editor = false;

			// Show an ediy smart area link
			if( $area_id ){
				$html .= '<div class="znhg-uneditable-area">';

				$edit_url = get_permalink( $area_id );
				$edit_url = apply_filters('preview_post_link', $edit_url);

				// Adds the zn_pb_edit=true to the url
				$edit_url = esc_url( add_query_arg( 'zn_pb_edit', 'true', $edit_url ));
				$html .= '<a class="znhg-uneditable-area-url" target="_blank" href="'.$edit_url.'">'.__( 'Edit smart area with pagebuilder', 'zn_framework' ).'<span class="dashicons dashicons-admin-generic"></span></a>';
			}

		}

		// Render the layout.
		ob_start();
		$this->zn_render_content( $elements );
		$html .= ob_get_clean();

		if( $pbstate && $area_id ){
			$html .= '</div>';
		}

		// Process shortcodes.
		echo do_shortcode($html);

		$this->is_active_editor = $pbstate;
	}

	function make_text_editable( $content = '', $option_id = '' ){

		if( ! $this->is_active_editor ){
			return $content;
		}

		$unique_id = zn_uid( 'zneda_' );
		$output = '<div id="'.$unique_id.'" class="znhg-editable-area" data-optionid="'.$option_id.'">';

		// Output the content
		$output .= $content;

		$output .= '</div>';

		return $output;
	}

	function wraper_end( $tag = 'div' ){
		return '</'.$tag.'>';
	}


	/**
	 * Render the page builder elements
	 *
	 * @access public
	 * @param $elements array
	 * @param $reload bool
	 */
	function zn_render_elements( $elements, $reload = false ) {

		if ( !is_array( $elements ) ) { return; }

		global $has_style , $zn_config;

		// CHECK IF THIS IS AN AJAX CALL ( DOING_AJAX )
		$echo = defined( 'ZN_PB_AJAX' )  ? true : false;

		foreach ( $elements as $element ) {

			// CHECK TO SEE IF THE ELEMENT WAS ALREADY INSTANTIATED
			if( !empty( $element['uid'] ) && !empty( $this->instantiated_modules[ $element['uid'] ] ) && !$reload ) {
				$el = $this->instantiated_modules[ $element['uid'] ];
			}
			else{
				// LOAD THE ELEMENT IN CASE IT IS NOT ALREADY LOADED
				$el = $this->load_element( $element );
			}

			// If the element was deleted or changed continue
			if ( empty( $this->all_available_elements[ $element['object'] ] ) ) { continue; }

			// Don't run the function multiple times
			$css = $el->css();

			// CHECK IF WE NEED TO RENDER THE EDITOR EXTRA CONTENT OR JUST THE ELEMENT
			if ( $this->is_active_editor ) {

				// Add the element to the elements array
				$this->current_modules[$element['uid']] = $element;

				// Put the element info - only needed in active editor
				$el->info = $this->all_available_elements[ $element['object'] ];

				$element_render_type = 'element';

				$this->editor->before_element( $el );

					if ( method_exists($el, 'element_edit') ) {
						$element_render_type = 'element_edit';
					}

					$el->$element_render_type();

				if ( $el->js() && $echo ) {
					if( $el->info['scripts'] ){
						$el->scripts();
					}
					ZN()->add_inline_js( $el->js() , $echo );
				}

				// Add inline CSS
				if ( $css && $echo ){
					ZN()->add_inline_css( $css, $echo );
				}

				$this->editor->after_element( $el );


			}
			else {

				// Check if we can display this element
				$display = $el->opt( 'znpb_hide_visitors', 'all' );
				if ( $display === 'loggedin' && ! is_user_logged_in() ){
					continue;
				}
				elseif ( $display === 'visitor' && is_user_logged_in() ){
					continue;
				}

				$el->element();

				if ( $el->js() && $echo ) {
					$el->scripts();
					ZN()->add_inline_js( $el->js() , $echo );
				}

				// Add inline CSS
				if ( $css && $echo ){
					ZN()->add_inline_css( $css , $echo );
				}

			}
		} // END FOREACH ELEMENT

	}


	/**
	 * Register a smart area id that is loaded on the current page
	 *
	 * @param  int $smart_area_id The smart area id that we need to register
	 */
	function register_smart_area( $smart_area_id ){
		$this->registered_smart_areas[$smart_area_id] = $smart_area_id;
	}

	function get_registered_smart_areas(){
		return $this->registered_smart_areas;
	}

}
