<?php
global $options_page_factory, $theme_options;


class Theme_Options_Page {
	public $name;
	public $slug;
	public $options = array();

	public $generator;
	public $saved_options;

	public function options(){
		return $this->options;
	}

	public function slug(){
		return $this->slug;
	}

	public function __construct() {
		add_action('admin_menu', array(&$this,'_add_menu_page'),10);
	}


	public function _add_menu_page(){
		global $options_page_factory;
		$page = current($options_page_factory->pages);
		if($page == $this->slug){
			add_menu_page(THEME_NAME, THEME_NAME, 'edit_theme_options', 'theme_'.$this->slug, array(&$this,'_render'),THEME_ADMIN_ASSETS_URI .'/images/theme_hover.png');
		}
		if(isset($this->menu_name)){
			$menu_name = $this->menu_name;
		}else{
			$menu_name = ucfirst($this->slug);
		}

		$page_id = add_submenu_page('theme_'.$page, $menu_name, $menu_name, 'edit_theme_options', 'theme_'.$this->slug, array(&$this,'_render'));
		if(is_file(THEME_ADMIN_OPTION_HELPS .'/'.$this->slug.'.php')){
			add_action('load-'.$page_id, array(&$this,'_load_help_tabs'));
		}
	}
	
	function _load_help_tabs () {
	    include(THEME_ADMIN_OPTION_HELPS .'/'.$this->slug.'.php');
	}

	function _render(){
		$this->_prepare_for_render();

		echo '<div class="wrap theme-page-container">';
		echo '<form method="post" action="">';

		foreach($this->options as $option) {
			$this->renderOption($option);
		}

		echo '<input type="hidden" name="' . $this->slug . '_noncename" id="' . $this->slug . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';

		echo '</form>';
		echo '</div>';
	}

	public function _prepare_for_render(){
		include_once (THEME_HELPERS . '/baseOptionsGenerator.php');
		$this->generator = new baseOptionsGenerator();
		$this->options = $this->options();

		$options = get_option('theme_' . $this->slug);
		$options = $this->_maybe_save_process($options);
		$this->saved_options = $options;
	}

	public function renderOption($item){
		global $post;
		if(isset($item['id'])){
			if (isset($this->saved_options[$item['id']])) {

				if( is_string($this->saved_options[$item['id']])){
					$item['value'] = stripslashes($this->saved_options[$item['id']]);
				}else{
					$item['value'] = $this->saved_options[$item['id']];
				}
			}else{
				if(isset($item['default'])){
					$item['value'] = $item['default'];
				}else{
					$item['value'] = '';
					$item['default'] = '';
				}
			}
		}

		if (isset($item['prepare'])) {
			if( function_exists($item['prepare'])){
				$item = $item['prepare']($item);
			}elseif(method_exists($this,$item['prepare'])){
				$item = $this->{$item['prepare']}($item);
			}
		}
		if (method_exists($this, '_option_'.$item['type'])) {
			$method = '_option_'.$item['type'];
			$this->$method($item);
		}elseif (method_exists($this->generator, $item['type'])) { 
			echo '<li class="theme-option">';
			echo '<h4 class="theme-option-title"><label for="'.$item['id'].'">' . $item['name'] . '</label></h4>';
			if(!empty($item['desc'])){
				echo '<a class="theme-option-more" href=""><i></i></a>'.
					'<div class="theme-option-desc">' . $item['desc'] . '</div>';
			}
			
			echo '<div class="theme-option-content">';
			$this->generator->{$item['type']}($item);
			echo '</div>';
			echo '</li>';
		}
	}

	function _option_fontchosen($item){
		$item['class'] = 'fontchosen';

		echo '<li class="theme-option">';
		echo '<h4 class="theme-option-title"><label for="'.$item['id'].'">' . $item['name'] . '</label></h4>';
		if(!empty($item['desc'])){
			echo '<a class="theme-option-more" href=""><i></i></a>'.
				'<div class="theme-option-desc">' . $item['desc'] . '</div>';
		}
		
		echo '<div class="theme-option-content theme-fontchosen-wrap">';
		$this->generator->multiselect($item);
		$callback = 'previewCallback_'.$item['id'];
		echo '<div class="theme-font-preview" data-callback="'.$callback.'">This is a preview of the <span class="theme-font-preview-name"></span> font. Some numbers: 0123456789 &amp; so on..</div>';
		if(isset($item['preview_callback'])){
			echo '<script>';
			echo 'var '.$callback.'='.$item['preview_callback'];
			echo '</script>';
		}

		echo '</div>';
		echo '</li>';
	}

	/**
	 * prints the options page title
	 */
	function _option_title($item) {
		echo '<h2>' . $item['name'] . '</h2>';
		if (isset($item['desc'])) {
			echo '<p>' . $item['desc'] . '</p>';
		}
	}
	
	/**
	 * begins the group section
	 */
	function _option_start($item) {
		echo '<div class="theme-options-group">';
		echo '<table class="widefat theme-options-table">';
		echo '<thead><tr>';
		echo '<th scope="row" colspan="2">' . $item['name'] . '</th>';
		echo '</tr></thead><tbody>';
	}
	
	function _option_desc($item) {
		echo '<tr><td scope="row" colspan="2">' . $item['desc'] . '</td></tr>';
	}

	/**
	 * displays a editor
	 */
	function _option_editor($item) {
		
		$rows = isset($item['rows']) ? $item['rows'] : '7';
		if (isset($this->saved_options[$item['id']])) {
			$item['default'] = stripslashes($this->saved_options[$item['id']]);
		}
		echo '<li class="theme-option">';
		echo '<h4 class="theme-option-title"><label for="'.$item['id'].'">' . $item['name'] . '</label></h4>';
		if(!empty($item['desc'])){
			echo '<a class="theme-option-more" href=""><i></i></a>'.
				'<div class="theme-option-desc">' . $item['desc'] . '</div>';
		}		
		echo '<div class="theme-option-content">';
		echo '<div id="poststuff"><div id="post-body"><div id="post-body-content"><div class="postarea" id="postdivrich">';
		
		wp_editor($item['value'],$item['id']);
		
		echo '<table id="post-status-info">';
		echo '<tbody><tr>';
		echo '<td>&nbsp;</td>';
		echo '<td>&nbsp;</td>';
		echo '</tr></tbody>';
		echo '</table>';
		echo '</div></div></div></div>';
		echo '</div>';
		echo '</li>';
	}

	/**
	 * displays a custom field
	 */
	function _option_custom($item) {
		if (isset($this->saved_options[$item['id']])) {
			$default = $this->saved_options[$item['id']];
		} else {
			$default = $item['default'];
		}
		if(isset($item['layout']) && $item['layout']==false){
			if (isset($item['function'])) {
				if(function_exists($item['function'])){
					$item['function']($item, $default);
				}elseif(method_exists($this,$item['function'])){
					$this->{$item['function']}($item, $default);
				}
			}else{
				echo $item['html'];
			}
		}else{
			echo '<li class="theme-option">';
			echo '<h4 class="theme-option-title"><label for="'.$item['id'].'">' . $item['name'] . '</label></h4>';
			if(!empty($item['desc'])){
				echo '<a class="theme-option-more" href=""><i></i></a>'.
					'<div class="theme-option-desc">' . $item['desc'] . '</div>';
			}
			if (isset($item['function'])) {
				if(function_exists($item['function'])){
					$item['function']($item, $default);
				}elseif(method_exists($this,$item['function'])){
					$this->{$item['function']}($item, $default);
				}
			}else{
				echo $item['html'];
			}
			echo '</li>';
		}
	}

	public function _maybe_save_process($options){
		if (isset($_POST['save_theme_options'])) {
			if (! isset($_POST[$this->slug . '_noncename'])) {
				return $options;
			}
			
			if (! wp_verify_nonce($_POST[$this->slug . '_noncename'], plugin_basename(__FILE__))) {
				return $options;
			}
			foreach($this->options as $value) {
				if (isset($value['id']) && ! empty($value['id'])) {
					if (isset($_POST[$value['id']])) {
						switch($value['type']){
							case 'color':
								// if(!empty($_POST[$value['id']]) && $_POST[$value['id']]=='transparent'){
								// 	$options[$value['id']] = '';
								// }else{
									$options[$value['id']] = $_POST[$value['id']];
								// }
								break;
							case 'multiselect':
								if(isset($value['chosen_order']) && $value['chosen_order']){
									if(empty($_POST['_'.$value['id']])){
										$options[$value['id']] = array();
									}else{
										$options[$value['id']] = explode(",",$_POST['_'.$value['id']]);
									}
								}else{
									if(empty($_POST[$value['id']])){
										$options[$value['id']] = array();
									}else{
										$options[$value['id']] = $_POST[$value['id']];
									}
								}							
								break;
							case 'ddmultiselect':
								if(empty($_POST[$value['id']])){
									$options[$value['id']] = array();
								}else{
									$options[$value['id']] = array_unique(explode(',', $_POST[$value['id']]));
								}
								break;
							case 'multidropdown':
								if(empty($_POST[$value['id']])){
									$options[$value['id']] = array();
								}else{
									$options[$value['id']] = array_unique(explode(',', $_POST[$value['id']]));
								}
								break;
							case 'toggle':
								if($_POST[$value['id']] == 'true'){
									$options[$value['id']] = true;
								}else{
									$options[$value['id']] = false;
								}
								break;
							case 'tritoggle':
								if($_POST[$value['id']] == 'true'){
									$options[$value['id']] = true;
								}elseif($_POST[$value['id']] == 'false'){
									$options[$value['id']] = false;
								}else{
									$options[$value['id']] = 'default';
								}
								break;
							case 'upload':
								if(!empty($_POST[$value['id']])){
									$options[$value['id']] = (array) json_decode(stripslashes($_POST[$value['id']]),true);
								}else{
									$options[$value['id']] = array();
								}
								break;
							default:
								$options[$value['id']] = $_POST[$value['id']];
						}
					} else {
						if ($value['type'] == 'multiselect') {
							$options[$value['id']] = array();
						} else {
							$options[$value['id']] = false;
						}
					}
				}
				if (isset($value['process'])) {
					if(function_exists($value['process'])){
						$options[$value['id']] = $value['process']($value,$options[$value['id']]);
					}elseif(method_exists($this,$value['process'])){
						$options[$value['id']] = $this->{$value['process']}($value,$options[$value['id']]);
					}
				}
			}
			
			if ($options != $this->options) {
				global $theme_options;
				if($this->slug == 'advanced' && isset($options['rest']) && $options['rest']){
					unset($theme_options['advanced']);
					$options = array();
				} else {
					update_option( 'theme_' . $this->slug, $options);
					$theme_options[$this->slug] = $options;
				}
				
				theme_save_skin_style();
			}
			echo '<div class="theme-message theme-message-info updated fade"><p><strong>Updated Successfully</strong></p></div>';
		
			$this->init();
		}
		
		return $options;
	}
}

class Theme_Options_Page_With_Tabs extends Theme_Options_Page {
	public $tabs = array();
	public $withType = 'tabs';
	function __construct() {
		parent::__construct();
		$this->init();
	}
	
	function init(){
		$this->tabs = $this->tabs();
		foreach($this->tabs as $tab){
			$this->options = array_merge($tab['options'], $this->options);
		}
	}

	function _render(){
		$this->_prepare_for_render();
		echo '<form class="theme-page" action="" method="post">';
			echo '<div class="theme-page-sidebar">';
				echo '<div class="theme-page-logo">';
					echo '<h1>';
						echo THEME_NAME;
					echo '</h1>';
					echo '<small>version '.THEME_VERSION.'</small>';
				echo '</div>';
				echo '<div class="theme-page-nav">';
				$this->printTabs();
				echo '</div>';
			echo '</div>';

			echo '<div class="theme-page-content">';
				echo '<div class="theme-page-header">';
					echo '<h2 class="theme-page-title">'.$this->name.'</h2>';
					echo '<div class="theme-submit">';
						echo '<button type="submit" class="theme-button" name="save_theme_options">Save changes</button>';
					echo '</div>';
				echo '</div>';

				$this->printTabContents();
				echo '<div class="theme-submit">';
					echo '<button type="submit" class="theme-button" name="save_theme_options">Save changes</button>';
				echo '</div>';
			echo '</div>';
			
		echo '<input type="hidden" name="' . $this->slug . '_noncename" id="' . $this->slug . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		echo '</form>';
	}

	function printTabs(){
		echo '<ul class="theme-tabs">';
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
				.' data-tab="'.$tab['slug'].'"'
				.'>'
				.$tab['name']
				.'</li>';
		}
		echo '</ul>';
	}
	function printTabContents(){

		echo '<ul class="theme-panes">';
		$first = true;
		foreach($this->tabs as $tab) {
			$classes = array('theme-pane');
			if($first){
				$classes[] = 'is-active';
				$first = false;
			}
			echo '<li'
				.(count($classes)>0?' class="'.implode(' ', $classes).'"':'')
				.'>';
			if(isset($tab['desc'])){
				echo '<div class="theme-pane-desc">';
				echo '<a class="theme-pane-desc-more" href="#">'.__('Help Information').'</a>';
				echo '<div class="theme-pane-desc-content">'.$tab['desc'].'</div>';
				echo '</div>';
			}
			echo '<ul class="theme-option-list">';

				foreach($tab['options'] as $option){
					$this->renderOption($option);
				}
			echo '</ul>';
			echo '</li>';
		}

		echo '</ul>';
	}
}

/**
 * 
 **/
class Theme_Options_Page_With_Sub_Tabs extends Theme_Options_Page_With_Tabs {
	public $tabs = array();
	public $withType = 'subtabs';
	function __construct(){
		parent::__construct();
	}

	function init(){
		$this->tabs = $this->tabs();
		foreach($this->tabs as $tab){
			if(isset($tab['hasChild']) && $tab['hasChild']){
				foreach ($tab['options'] as $child) {
					$this->options = array_merge($child['options'], $this->options);
				}
			}else{
				$this->options = array_merge($tab['options'], $this->options);
			}
		}	
	}

	function printTabContents(){
		echo '<ul class="theme-panes">';
		$first = true;

		foreach($this->tabs as $tab) {
			$classes = array('theme-pane');
			if($first){
				$classes[] = 'active';
				$first = false;
			}
			echo '<li'
				.(count($classes)>0?' class="'.implode(' ', $classes).'"':'')

				.'>';
			
			if(isset($tab['hasChild']) && $tab['hasChild']){
				echo '<ul class="theme-subtabs">';
				$first = true;
				foreach ($tab['options'] as $label=>$tabOptions) {
					$classes = array();
					if($first){
						$classes[] = 'is-active';
						$first = false;
					}

					echo '<li'
						.(count($classes)>0?' class="'.implode(' ', $classes).'"':'')
						.'><a href="#'.$label.'">'
						.$label
						.'</a></li>';
				}

				echo '</ul>';

				echo '<ul class="theme-subpanes">';
				$first = true;
				foreach ($tab['options'] as $label=>$tabOptions) {
					$classes = array('theme-subpane');
					if($first){
						$classes[] = 'is-active';
						$first = false;
					}
					echo '<li'
						.(count($classes)>0?' class="'.implode(' ', $classes).'"':'')
						.'>';
					echo '<ul class="theme-option-list">';
					foreach($tabOptions['options'] as $option){
						$this->renderOption($option);
					}
					echo '</ul>';
					echo '</li>';
				}
				echo '</ul>';
			}else{
				echo '<ul class="theme-option-list">';
				foreach($tab['options'] as $option){
					$this->renderOption($option);
				}
				echo '</ul>';
			}
			echo '</li>';
		}

		echo '</ul>';
	}
}
/**
 * Singleton that registers and instantiates Theme_Options_Page classes.
 */
class Theme_Options_Page_Factory {
	public $pages = array();

	function register($page_class) {
		$page = new $page_class();

		$this->pages[$page_class] = $page->slug;

		global $theme_options;

		if(!array_key_exists($page->slug, $theme_options)){

			$theme_options[$page->slug] = array();
			foreach($page->options() as $option) {
				if (isset($option['default'])) {
					$theme_options[$page->slug][$option['id']] = $option['default'];
				}
			}
			$saved_options = get_option('theme_'. $page->slug);
			if(is_array($saved_options)){
				$theme_options[$page->slug] = array_merge($theme_options[$page->slug], $saved_options );
			}
		}
	}

	function unregister($page_class) {
		if ( isset($this->pages[$page_class]) )
			unset($this->pages[$page_class]);
	}
}

/**
 * Private
 */
//function _get_widget_id_base($id) {
//	return preg_replace( '/-[0-9]+$/', '', $id );
//}