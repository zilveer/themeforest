<?php 

/**
 * Controls the one-click demo import functionality - creates a page for the
 * demo import and initializes the importer.
 */
class PexetoImportManager{

	private $menu_parent;
	private $demo_folder_path;
	private $demo_folder_url;
	private $demos;
	private $options_key;
	private $map_widgets;

	/**
	 * Default constructor.
	 * @param array $demos            an array with the demo data to be imported
	 * @param string $demo_folder_path the path to the demo folder
	 * @param string $demo_folder_url  the URL of the demo folder
	 * @param string $menu_parent      the ID of the menu parent
	 * @param string $options_key      the options key that the theme uses to
	 * save the options in the database
	 * @param array  $map_widgets      an array with the widget names to be mapped
	 * with the new categories
	 */
	public function __construct($demos, $demo_folder_path, $demo_folder_url, $menu_parent, $options_key, $map_widgets=array()){
		$this->demos = $demos;
		$this->demo_folder_path = $demo_folder_path;
		$this->demo_folder_url = $demo_folder_url;
		$this->menu_parent = $menu_parent;
		$this->options_key=$options_key;
		$this->map_widgets=$map_widgets;

		$this->init();
	}

	/**
	 * Inits the importer functionality.
	 */
	public function init(){
		add_action( 'admin_menu', array($this, 'register_menu' ));
		add_action('wp_ajax_pexeto_import_demo', array($this, 'import'));
	}

	/**
	 * Registers a menu for the Demo Import functionality.
	 */
	public function register_menu(){
		add_submenu_page(
			$this->menu_parent,
			'Demo Import',
			'Demo Import',
			'edit_theme_options',
			'pexeto_import',
			array( $this, 'print_ui' ),
			'none' );
	}

	/**
	 * Prints the content of the Demo Import page.
	 */
	public function print_ui(){
		echo '<div class="pexeto-import-wrap">';
		if(!empty($this->demos)){
			$this->print_heading();

			foreach ($this->demos as $demo) {
				$this->print_demo_element($demo);
			}
		}
		echo '</div>';
	}

	/**
	 * Imports a demo content after an AJAX request, prints the result
	 * of the import in a JSON format.
	 */
	public function import(){
		ob_start();
		//check the nonce
		$res = array('success'=>false);
		$demo = $_POST['demo'];

		//validate the nonce
		$nonce_valid = check_ajax_referer( 'pexetoimport', 'nonce', false);
		if(!$nonce_valid){
			$res['success']=false;
			$res['message']='<br/>Error: The nonce did not verify.';
			echo json_encode($res);
			exit;
		}

		$demo_path = $this->demo_folder_path.'/'.$demo;  
		$demo_data_path = $demo_path.'/data.xml';

		if(!isset($this->demos[$demo]) || !file_exists($demo_data_path)){
			$res['success']=false;
			$res['message']='<br/>Error: This demo XML file does not exist';
		}else{
			$demo_el = $this->demos[$demo];
			$this->load_importer();


			$importer = new PexetoImport();
			$importer->fetch_attachments = true;

			//import the main demo data
			$importer->import($demo_data_path);
			
			$options_imported = $importer->import_options($demo_path.'/options.txt', $this->options_key);
			$colors_imported = $importer->import_colors($demo_path.'/colors.txt');
			$widgets_imported = $importer->import_widgets($demo_path.'/widgets.txt');
			
			$importer->set_term_mapping($this->map_widgets);

			//set the front page
			$importer->set_front_page($demo_el['frontpage']);

			//set the menus
			$importer->set_menus($demo_el['menus']);

			$success = $options_imported && $colors_imported && $widgets_imported ? true : false;


			$res['success']=$success;

			if(!$success){
				$res['message']='';

				if($data_imported || $options_imported || $colors_imported || $widgets_imported){
					//at least one of the options has been imported
					$res['message'].='<br/>Options imported: '.$this->get_yes_no($options_imported).
					'<br/>Colors imported: '.$this->get_yes_no($colors_imported).
					'<br/>Widgets imported: '.$this->get_yes_no($widgets_imported);
				}
			}
		}

		ob_end_clean();

		echo json_encode($res);
		exit;
		
	}

	/**
	 * Returns yes/no representation of a boolean.
	 * @param  bool $val the boolean value
	 * @return string      YES if the value is true and NO if the value is false
	 */
	private function get_yes_no($val){
		return $val ? 'YES' : 'NO';
	}

	/**
	 * Loads the WordPress importer and the theme importer.
	 */
	private function load_importer(){
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

		if ( !class_exists( 'WP_Import' ) ) {
			require_once 'wordpress-importer.php';
		}
		require_once 'class-pexeto-importer.php';
	}

	/**
	 * Prints the heading of the Demo Import page.
	 */
	private function print_heading(){
		?>
		<h2>One-click demo import</h2>
		<div class="updated"><p>In this section you can import one of the theme's demos.</p>
			<b>Please note</b>:
			<ul>
			<li>- Random dummy images will be imported instead of the original images for copyright reasons</li>
			<li>- This will import all of the demo settings and <b>will overwrite your current settings</b>, such as theme options and color settings</li>
			<li>- Please <a href="<?php echo admin_url('themes.php?page=install-required-plugins');  ?>">install all the bundled plugins</a> that you are going to use (such as WooCommerce, Recent Posts widget, Portfolio Items widget, etc.) <b>before</b> importing the demo data so that all the data for these plugins can be imported.</li>
		</ul></div>
		<?php
	}

	/**
	 * Prints a single demo import element - an image of the demo and an
	 * import button.
	 * @param  array $demo the demo data
	 */
	private function print_demo_element($demo){
		$ajax_nonce = wp_create_nonce( "pexetoimport" );

		echo '<div class="pex-demo-el">
			<h3>'.$demo['title'].'</h3>
			<img src="'.$this->demo_folder_url.'/'.$demo['id'].'/preview.png" />
			<a href="#" class="pexeto-import-btn button button-primary" data-demo="'.$demo['id'].'" data-nonce="'.$ajax_nonce.'">Import Demo</a></div>';
	}

	
}


 ?>