<?php
class shortcodesGenerator {
	var $uri = '';
	var $dir = '';
	
	function __construct() {
		$this->uri = THEME_ADMIN_SHORTCODES_URI;
		$this->dir = THEME_ADMIN_SHORTCODES_DIR;
		$this->init();
	}
	
	// init process for button control
	function init() {
		// Don't bother doing this stuff if the current user lacks permissions
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;

		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
			add_filter('mce_buttons', array(&$this, 'register_tinymce_button'));
			//add_filter('mce_css', array(&$this, 'add_tinymce_css'));
			add_filter("mce_external_plugins", array(&$this, 'add_tinymce_plugin'));
			add_filter('mce_external_languages', array(&$this, 'add_tinymce_languages'));
		}
		// Add button to Fullscreen editor
		add_filter( 'wp_fullscreen_buttons', array(&$this, 'add_fullscreen_button') );

		if(theme_is_options() || theme_is_post_type()){
			//add scripts
			add_action('admin_init', array(&$this,'register_scripts'));
			add_action( 'admin_head', array(&$this,'print_scripts') );
		}
		
		add_action('wp_ajax_theme-shortcode-dialog', array(&$this,'dialog'));
		add_action('wp_ajax_theme-shortcode-menu', array(&$this,'menu'));
		add_action('wp_ajax_theme-shortcode-preview', array(&$this,'preview'));
	}
	
	// register scripts
	function register_scripts(){
		wp_register_script('theme-shortcode-menu',$this->uri . '/shortcode-menu.js',array('jquery'));
		wp_register_script('jquery-buttonMenu', $this->uri . '/buttonMenu.js',array('jquery'));
	}
	var $scripts_printed = false;
	// print scripts
	function print_scripts() {
		wp_print_scripts('theme-shortcode-menu');
		wp_print_scripts('jquery-buttonMenu');
		if($this->scripts_printed == true){
			return;
		}
		$this->scripts_printed = true;
		$shortcode_menu_data = $this->get_menu();
		?>
<script type="text/javascript">
// <![CDATA[
	var shortcode_menu_data = <?php echo $shortcode_menu_data;?>;
	(function ($) {
		$(document).ready(function(){
			shortcodeMenu.init({
				uri:'<?php echo $this->uri;?>',
				langs:{
					shortcodes:"<?php _e('Shortcodes','theme_admin');?>",
					insert_shortcodes:"<?php _e('Insert Shortcode','theme_admin');?>"
				}
			});
		});
	})(jQuery);
// ]]>
</script>
		<?php
	}
	
	// applied to the rows of buttons for the rich editor toolbar
	function register_tinymce_button($buttons) {
	   array_push($buttons, "shortcodeGenerator");
	   return $buttons;
	}
	 
	// applied to the array of external plugins to be loaded by the rich text editor.
	function add_tinymce_plugin($plugin_array) {
	   $plugin_array['shortcodeGenerator'] = THEME_URI . '/framework/admin/shortcodes/editor_plugin.js';
	   return $plugin_array;
	}
	
	// applied to the array of language files loaded by external plugins
	function add_tinymce_languages($langs){
		$langs[] = array('shortcodeGenerator' => THEME_ADMIN.'/shortcodes/langs/langs.php');
		return $langs;
	}
	
	// applied to the CSS file URL for the rich text editor
	function add_tinymce_css($mce_css) {
		//if (! empty($mce_css)) $mce_css .= ',';
		//$mce_css .= get_stylesheet_directory_uri() . '/editor.css';
		//return $mce_css;
	}
	
	// applied to the array of fullscreen butons
	function add_fullscreen_button($buttons){
		$buttons[] = 'separator';
		$buttons['shortcode'] = array(
			'title' => __('shortcodeGenerator','theme_admin'),
			'both' => true
		);
		return $buttons;
	}
	
	function dialog(){
		wp_enqueue_script('theme-shortcode-dialog',$this->uri . '/dialog.js',array('jquery','common','theme-base'));
		
		if(is_rtl()){
			wp_enqueue_style('theme-shortcode-dialog', THEME_ADMIN_ASSETS_URI . '/css/shortcode-dialog-rtl.css');
		} else {
			wp_enqueue_style('theme-shortcode-dialog', THEME_ADMIN_ASSETS_URI . '/css/shortcode-dialog.css');
		}
		
		wp_enqueue_style( 'global' );
		wp_enqueue_style( 'wp-admin' );
		wp_enqueue_style( 'colors' );
		wp_enqueue_style( 'ie' );
		
		global $wp_version;
		if(version_compare($wp_version, "3.5", '>=')){
			wp_enqueue_media();
		}else {
			add_thickbox();
		}
		
		if(defined('ICL_SITEPRESS_VERSION') && ICL_SITEPRESS_VERSION == '2.0.4.1'){
			wp_dequeue_script('sitepress-translation-management');
		}
		
		if(isset($_REQUEST['dialog'])){
			$array = include($this->dir.'/dialogs/'.$_REQUEST['dialog'].'.php');
		}
		include($this->dir.'/dialog.php');
		die (1);
	}
	
	function preview(){
		wp_enqueue_style('theme-shortcode-preview', THEME_ADMIN_ASSETS_URI . '/css/shortcode-preview.css');
		include($this->dir.'/preview.php');
		die (1);
	}
	
	function menu(){
		$menu = include($this->dir.'/menuData.php');
		echo json_encode($menu);
		die (1);
	}

	function get_menu(){
		$menu = include($this->dir.'/menuData.php');
		return json_encode($menu);
	}
}


class shortcodeOptionGenerator {
	public $generator;
	public $options = array();
	
	function __construct($shortcodes = null) {
		include_once (THEME_HELPERS . '/baseOptionsGenerator.php');
		$this->generator = new baseOptionsGenerator();

		if($shortcodes){
			$this->options = $shortcodes;
		}
	}
	
	function render() {
		foreach($this->options as $option) {
			$this->renderOption($option);
		}
	}
	
	function renderOption($option){
		global $post;
		
		$option['value'] = $option['default'];

		if (method_exists($this->generator, $option['type'])) {
			echo '<div class="shortcode-item" data-option="'.$option['id'].'" '.(isset($option['group'])?'data-group="'.$option['group'].'"':'').' data-type="'.$option['type'].'" data-default="'.(is_array($option['default'])?implode(',', $option['default']):(is_bool($option['default'])?($option['default']?'true':'false'):$option['default'])).'">';
			echo '<div class="shortcode-item-title"><h4>' . $option['name'] . '</h4>';
			if (isset($option['desc'])) {
				echo '<a href="" class="switch">[+] more info</a>';
			}
			echo '</div><div class="shortcode-item-content">';
			if (isset($option['desc'])) {
				echo '<p class="description">' . $option['desc'] . '</p>';
			}
			$this->generator->{$option['type']}($option);
			echo '</div>';
			echo '<div class="clear"></div>';
			echo '</div>';
		}elseif (method_exists($this, $option['type'])) {
			$this->{$option['type']}($option);
		}
	}
	
	function custom($option){
		if(isset($option['layout']) && $option['layout']==false){
			if (isset($option['function']) && function_exists($option['function'])) {
				$option['function']($option);
			} else {
				echo $option['html'];
			}
		}else{
			echo '<div class="shortcode-item" data-option="'.$option['id'].'" data-type="'.$option['type'].'" data-default="'.(is_array($option['default'])?implode(',', $option['default']):(is_bool($option['default'])?($option['default']?'true':'false'):$option['default'])).'">';
			echo '<div class="shortcode-item-title"><h4>' . $option['name'] . '</h4></div>';
			echo '<div class="shortcode-item-content">';
			if (isset($option['desc'])) {
				echo '<p class="description">' . $option['desc'] . '</p>';
			}
			if (isset($option['function']) && function_exists($option['function'])) {
				$option['function']($option);
			} else {
				echo $option['html'];
			}
			echo '</div>';
			echo '<div class="clear"></div>';
			echo '</div>';
		}
	}

	function hidden($option){
		echo '<div class="shortcode-item" data-option="'.$option['id'].'" data-type="'.$option['type'].'" data-default="'.(is_array($option['default'])?implode(',', $option['default']):(is_bool($option['default'])?($option['default']?'true':'false'):$option['default'])).'">';
		echo '<input type="hidden" value="'.$option['default'].'" name="'.$option['id'].'">';
		echo '</div>';
	}
}


class shortcodeTabOptionGenerator extends shortcodeOptionGenerator {
	public $tabs = array();
	
	function __construct($shortcodes) {
		parent::__construct();
		$this->tabs = $shortcodes;

		foreach($this->tabs as $key => $tab){
			if(is_array($tab)){
				$this->options = array_merge($tab['options'], $this->options);
			} else {
				unset($this->tabs[$key]);
			}
		}
	}
	
	function render() {
		echo '<ul class="theme-dialog-tabs">';
		$first = true;
		foreach($this->tabs as $tab) {
			$classes = array();
			if($first){
				$classes[] = 'is-active';
				$first = false;
			}

			echo '<li'
				.(isset($tab['id'])?' id="'.$tab['id'].'"':'')
				.(count($classes)>0?' class="'.implode(' ', $classes).'"':'')
				.'>'
				.$tab['name']
				.'</li>';
		}
		echo '</ul>';

		echo '<ul class="theme-dialog-panes">';
		$first = true;
		foreach($this->tabs as $tab) {
			$classes = array('theme-dialog-pane');
			if($first){
				$classes[] = 'is-active';
				$first = false;
			}
			echo '<li'
				.(count($classes)>0?' class="'.implode(' ', $classes).'"':'')
				.'>';
			
			foreach($tab['options'] as $option){
				$this->renderOption($option);
			}
			echo '</li>';
		}
		echo '</ul>';
	}
	
	function renderOption($option){
		global $post;
		
		$option['value'] = $option['default'];

		if (method_exists($this->generator, $option['type'])) {
			echo '<div class="shortcode-item" data-option="'.$option['id'].'" '.(isset($option['group'])?'data-group="'.$option['group'].'"':'').' data-type="'.$option['type'].'" data-default="'.(is_array($option['default'])?implode(',', $option['default']):(is_bool($option['default'])?($option['default']?'true':'false'):$option['default'])).'">';
			echo '<div class="shortcode-item-title"><h4>' . $option['name'] . '</h4>';
			if (isset($option['desc'])) {
				echo '<a href="" class="switch">[+] more info</a>';
			}
			echo '</div><div class="shortcode-item-content">';
			if (isset($option['desc'])) {
				echo '<p class="description">' . $option['desc'] . '</p>';
			}
			$this->generator->{$option['type']}($option);
			echo '</div>';
			echo '<div class="clear"></div>';
			echo '</div>';
		}elseif (method_exists($this, $option['type'])) {
			$this->{$option['type']}($option);
		}
	}
}