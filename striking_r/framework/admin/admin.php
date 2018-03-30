<?php
class Theme_admin {
	function init(){
		/* Load functions for admin. */
		$this->functions();
		
		add_action('admin_notices',  array(&$this,'warnings'));
		
		/* Manage custom post type */
		$this->types();

		$this->init_caps();

		/* Create post type meta box. */
		$this->metaboxes();
		
		add_action('wp_ajax_theme-flush-rewrite-rules', array(&$this,'flush_rewrite_rules'));
		
		require_once (THEME_HELPERS . '/shortcodesGenerator.php');
		new shortcodesGenerator();

		require_once (THEME_ADMIN_FUNCTIONS . '/upgrade.php');
		new upgradeHelper();
		
		$this->update();

		add_action('admin_init', array(&$this,'after_theme_activated'));
		add_action('admin_init', array(&$this,'after_theme_update'));
	}
	
	function init_caps() {
		$capabilities = array();

		$capability_types = array( 'portfolio', 'slideshow' );

		foreach( $capability_types as $capability_type ) {
			$capabilities[ $capability_type ] = array(

				// Post type
				"theme_edit_{$capability_type}",
				"theme_edit_{$capability_type}s",
				"theme_edit_others_{$capability_type}s",
				"theme_edit_private_{$capability_type}s",
				"theme_edit_published_{$capability_type}s",

				"theme_read_{$capability_type}",
				"theme_read_private_{$capability_type}s",

				"theme_delete_{$capability_type}",
				"theme_delete_{$capability_type}s",
				"theme_delete_private_{$capability_type}s",
				"theme_delete_published_{$capability_type}s",
				"theme_delete_others_{$capability_type}s",

				"theme_publish_{$capability_type}s",
				
				// Terms
				"theme_manage_{$capability_type}_terms",
				"theme_edit_{$capability_type}_terms",
				"theme_delete_{$capability_type}_terms",
				"theme_assign_{$capability_type}_terms"
			);
		}

		$role = get_role('administrator');
		if (!empty($role)) {
			foreach( $capabilities as $cap_group ) {
				foreach( $cap_group as $cap ) {
					$role->add_cap( $cap );
				}
			}
		}
	}
	
	/**
	 * Check Whether the current environment is support for the theme.
	 * 
	 * The message will display in admin option page.
	 */
	function warnings(){
		global $wp_version;

		$try = false;

		$errors = array();
		if(!theme_check_wp_version()){
			$errors[] = sprintf(__('Wordpress version(%1$s) is too low. Please upgrade to 4.0','theme_admin'), $wp_version);
		}
		if(!function_exists("imagecreatetruecolor")){
			$errors[] = __('GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library','theme_admin');
		}
		if(!wp_is_writable(THEME_CACHE_DIR)){
			$errors[] = sprintf(__('The cache folder (%1$s) is not writeable.','theme_admin'), str_replace( WP_CONTENT_DIR, '', THEME_CACHE_DIR ));
			$try = true;
		}
		if(!wp_is_writable(THEME_CACHE_IMAGES_DIR)){
			$errors[] = sprintf(__('The image folder (%1$s) is not writeable.','theme_admin'), str_replace( WP_CONTENT_DIR, '', THEME_CACHE_IMAGES_DIR ));
			
			$try = true;
		}
		if((int)ini_get('max_input_vars') < 1000){
			@ini_set('max_input_vars', 3000);
			$errors[] = __('Please increase max_input_vars to greater than 1000 in php.ini file.','theme_admin');
		}

		if(!is_multisite()){
			if(!wp_is_writable(THEME_CACHE_DIR.DIRECTORY_SEPARATOR.'skin.css')){
				$errors[] = sprintf(__('The skin style file (%1$s) is not writeable.','theme_admin'), str_replace( WP_CONTENT_DIR, '', THEME_CACHE_DIR ).'/skin.css');
				$try = true;
			}
		}
		if($try){
			theme_create_cache_files();
		}
		
		$str = '';
		if(!empty($errors)){
			$str = '<ul>';
			foreach($errors as $error){
				$str .= '<li>'.$error.'</li>';
			}
			$str .= '</ul>';
			echo "
				<div id='theme-warning' class='error fade'><p><strong>".sprintf(__('%1$s Error Messages','theme_admin'), THEME_NAME)."</strong><br/>".$str."</p></div>
			";
		}
		
	}
	
	function functions(){
		require_once(THEME_ADMIN_FUNCTIONS .'/common.php');
		require_once(THEME_ADMIN_FUNCTIONS .'/head.php');
		//enable option image uploader support
		require_once(THEME_ADMIN_FUNCTIONS .'/option-media-upload.php');
	}
	
	/**
	 * Manage custom post type.
	 */
	function types(){
		require_once (THEME_TYPES . '/portfolio.php');
		require_once (THEME_TYPES . '/slideshow.php');

		$this->_register_type('Theme_Post_Type_Portfolio');
		$this->_register_type('Theme_Post_Type_Slideshow');
	}

	function _register_type($type_class){
		$type = new $type_class;
		$type->admin_init();
	}

	/**
	 * Create post type metabox.
	 */
	function metaboxes(){
		require_once (THEME_HELPERS . '/metaboxes.php');

		$files = array(
			'page_general' => 'Theme_Metabox_PageGeneral',
			'slideshow' => 'Theme_Metabox_Slideshow',
			'portfolio' => 'Theme_Metabox_Portfolio',
			'ken_slider' => 'Theme_Metabox_KenSlider',	
			'single' => 'Theme_Metabox_Single',
			'product' => 'Theme_Metabox_Product',
		);

		foreach($files as $file => $metabox_class){
			include_once (THEME_ADMIN_METABOXES . "/" . $file.'.php');
			$metabox = new $metabox_class;
		}
	}
	
	function flush_rewrite_rules(){
		flush_rewrite_rules();
		die (1);
	}
	
	function after_theme_activated(){
		if ('themes.php' !== basename($_SERVER['PHP_SELF']) || !isset($_GET['activated']) || $_GET['activated']!=='true' ) {
			return;
		}

		if(is_multisite()){
			theme_check_image_folder();
		}
		update_option(THEME_SLUG.'_version', THEME_VERSION);
		theme_save_skin_style();


		wp_redirect( admin_url('admin.php?page=theme_general') );

		do_action('theme_activation');
	}
	
	function after_theme_update(){
		if(version_compare(THEME_VERSION, get_option(THEME_SLUG.'_version'), '!=')){
			update_option(THEME_SLUG.'_version', THEME_VERSION);
			theme_save_skin_style();
		}
		// wait to do mu 
		// http://codex.wordpress.org/Category:WPMU_Functions
	}

	function update(){
		require_once(THEME_ADMIN .'/updates/striking.php');
		require_once(THEME_ADMIN .'/updates/sidebar.php');

		if(!get_option(THEME_SLUG.'_cache_updated')){
			theme_create_cache_files();

			update_option(THEME_SLUG.'_cache_updated', true);
		}
	}
}