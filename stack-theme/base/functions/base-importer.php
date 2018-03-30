<?php
class Base_Import extends WP_Import{
	public $file;
	
	public function process_attachment( $post, $url ) {
		$post_id = $post["import_id"];
		$xml = simplexml_load_file($this->file);
		$result = $xml->xpath("channel/wg_custom_attachment_url/attachment[post_id='$post_id']/custom_url");
		$custom_url = ($result!=false) ? $result[0] : '';

		if ($custom_url != '') {
			$url = THEME_CUSTOM_URI . "/demo/" . $custom_url;
		}
		
		$return = parent::process_attachment( $post, $url );
		return $return;
	}

	public function import($file) {
		$this->file = $file;
		return parent::import($file);
	}
}
class Base_Importer {
	protected $importer;
	protected $demo;
	protected $success;
	protected $messages;

	public function __construct() {
		if (!class_exists('WP_Import')) {
			if (!defined('WP_LOAD_IMPORTERS')) define('WP_LOAD_IMPORTERS',true);
			require_once(THEME_LIBS_DIR.'/wordpress-importer/wordpress-importer.php');
		}
		$this->importer = new Base_Import();
		$this->importer->fetch_attachments = true;
	}

	public function importWidgets($config) {
		if ( @$config['sidebar'] ) {
			update_option( 'sidebars_widgets', $config['sidebar'] );
		}

		if ( @$config['options'] ) {
			foreach ($config['options'] as $name => $value) {
				update_option( "widget_$name", maybe_unserialize($value) );
			}
		}
	}

	public function importThemeOptions($options) {
		update_option(THEME_SLUG . '_options', $options);
	}

	public function import($demo_file) {

		$this->demo = $demo_file;
		$this->success = false;
		$this->messages = '';

		set_time_limit(0);
		ob_start();

		add_action('import_end',array(&$this,'import_end'));
		$this->importer->import($this->demo);

		return $this->success;
	}

	// Hook the WP_Import when importing done
	public function import_end() {
		$this->messages = ob_get_contents();
		$this->success = true;
		ob_end_clean();

		// Exact the custom export string
		$raw = file_get_contents( $this->demo );
		$openTag = Base_Export::OPEN_TAG;
		$closeTag = Base_Export::CLOSE_TAG;
		$openTagLength = strlen( $openTag );
		$startIndex = strpos( $raw, $openTag );
		$endIndex = ( $startIndex !== false ) ? strpos( $raw, $closeTag, $startIndex ) : false;
		$customExportText = ( $endIndex !== false ) ? substr( $raw, $startIndex + $openTagLength, $endIndex - $startIndex - $openTagLength) : '';
		
		if ($customExportText) {
			$data =  @unserialize( base64_decode( $customExportText ) );
			
			// Import Demo Theme Options 
			if ( @$data['theme_options'] ) {
				$this->importThemeOptions($data['theme_options']);
			}

			// Import Demo Widgets
			if ( @is_array($data['widgets']) ) {
				$this->importWidgets($data['widgets']);
			}
			
			// Set navigation menu
			$this->autosetThemeLocation();

			// Set static home & blog
			update_option( 'show_on_front', 'page' );
			$home = get_page_by_title( 'Home' );
			update_option( 'page_on_front', $home->ID );
			$blog = get_page_by_title( 'Blogs' );
   			update_option( 'page_for_posts', $blog->ID );
		}
	}

	private function autosetThemeLocation() {
		global $theme_config;

		$menu_locations = array(); //get_theme_mod('nav_menu_locations');
		$nav_menus = get_terms('nav_menu');

		foreach($nav_menus as $menu) {
			if(isset($theme_config['theme_menus'][$menu->slug])) {
				$menu_locations[$menu->slug] = $menu->term_id;
			}
		}

		set_theme_mod('nav_menu_locations', $menu_locations);
	}
}
?>
