<?php
/**
 * The `metaboxesRenderer` class help generate the html code for meta boxes.
 */
class Theme_Metabox {
	public $slug;
	public $config;
	public $generator;
	public $options;

	function __construct() {
		include_once (THEME_HELPERS . '/baseOptionsGenerator.php');
		$this->generator = new baseOptionsGenerator();

		$this->config = $this->config();
		$this->options = $this->options();

		add_action('save_post', array(&$this, '_save'));
		add_action('edit_attachment', array(&$this, '_save'));
		
		add_action('admin_menu', array(&$this, '_init'));
		if(is_array($this->config['post_types']) && !empty($this->config['post_types'])){
			foreach($this->config['post_types'] as $post_type){
				$id = $this->slug;
				add_filter( "postbox_classes_{$post_type}_{$id}", array(&$this, '_metabox_classes') );
			}
		}
	}

	function _metabox_classes($classes){
		$classes[] = 'theme_metabox';
		return $classes;
	}

	function _init() {
		if (function_exists('add_meta_box')) {
			if (! empty($this->config['callback']) && function_exists($this->config['callback'])) {
				$callback = $this->config['callback'];
			} else {
				$callback = array(&$this, '_render');
			}
			if(is_array($this->config['post_types'])){
				foreach($this->config['post_types'] as $post_type) {
					add_meta_box($this->slug, $this->config['title'], $callback, $post_type, $this->config['context'], $this->config['priority']);
				}
			}
		}
	}

	function options(){
		return array();
	}

	function config(){
		return array();
	}

	function slug(){
		return $this->slug;
	}

	function _render() {
		echo '<div class="theme-metabox">';
		echo '<ul class="theme-option-list">';
		foreach($this->options as $option) {
			$this->renderOption($option);
		}
		echo '</ul>';
		echo '<input type="hidden" name="' . $this->slug . '_noncename" id="' . $this->slug . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		echo '</div>';
	}
	
	function renderOption($option){
		global $post;
		if (isset($option['id'])) {
			$value = get_post_meta($post->ID, $option['id'], true);
			if ($value != "") {
				$option['value'] = $value;
			}else{
				$option['value'] = $option['default'];
			}
		}

		if (isset($option['prepare'])){
			if(method_exists($this, $option['prepare'])) {
				$option = $this->{$option['prepare']}($option);
			}elseif(function_exists($option['prepare'])){
				$option = $option['prepare']($option);
			}
		}
		if (method_exists($this, '_option_'.$option['type'])) {
			$method = '_option_'.$option['type'];
			$this->$method($option);
		}elseif (method_exists($this->generator, $option['type'])) { 
			echo '<li class="theme-option">';
			echo '<h4 class="theme-option-title"><label for="'.$option['id'].'">' . $option['name'] . '</label></h4>';
			if(!empty($option['desc'])){
				echo '<a class="theme-option-more" href=""><i></i></a>'.
					'<div class="theme-option-desc">' . $option['desc'] . '</div>';
			}
			echo '<div class="theme-option-content">';
			$this->generator->{$option['type']}($option);
			echo '</div>';
			echo '</li>';
		}
	}

	/**
	 * prints the title and desc
	 */
	function _option_title($item) {
		echo '<li class="theme-option">';
		echo '<h4 class="theme-option-title"><label for="'.$option['id'].'">' . $option['name'] . '</label></h4>';
		if(!empty($option['desc'])){
			echo '<a class="theme-option-more" href=""><i></i></a>'.
				'<div class="theme-option-desc">' . $option['desc'] . '</div>';
		}
		echo '</li>';
	}
	
	/**
	 * displays a custom field
	 */
	function _option_custom($item) {
		if(isset($item['layout']) && $item['layout']==false){
			if (isset($item['function'])) {
				if(function_exists($item['function'])){
					if(isset($item['default'])){
						$item['function']($item, $item['default']);
					}else{
						$item['function']($item);
					}
				}elseif(method_exists($this,$item['function'])){
					if(isset($item['default'])){
						$this->{$item['function']}($item, $item['default']);
					}else{
						$this->{$item['function']}($item);
					}
				}
			} else {
				echo $item['html'];
			}
		}else{
			echo '<li class="theme-option">';
			echo '<h4 class="theme-option-title"><label for="'.$option['id'].'">' . $option['name'] . '</label></h4>';
			if(!empty($option['desc'])){
				echo '<a class="theme-option-more" href=""><i></i></a>'.
					'<div class="theme-option-desc">' . $option['desc'] . '</div>';
			}
			echo '<div class="theme-option-content">';
			if (isset($item['function'])) {
				if(function_exists($item['function'])){
					if(isset($item['default'])){
						$item['function']($item, $item['default']);
					}else{
						$item['function']($item);
					}
				}elseif(method_exists($this,$item['function'])){
					if(isset($item['default'])){
						$this->{$item['function']}($item, $item['default']);
					}else{
						$this->{$item['function']}($item);
					}
				}
			}else{
				echo $item['html'];
			}
			echo '</div>';
			echo '</li>';
		}
	}


	function _save($post_id) {
		if (! isset($_POST[$this->slug . '_noncename'])) {
			return $post_id;
		}
		
		if (! wp_verify_nonce($_POST[$this->slug . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		
		if ('page' == $_POST['post_type']) {
			if (! current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} else {
			if (! current_user_can('edit_post', $post_id)) {
				return $post_id;
			}
		}
		
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		foreach($this->options as $option) {
			if (isset($option['id']) && ! empty($option['id'])) {
				
				if (isset($_POST[$option['id']])) {
					switch ($option['type']) {
						case 'multiselect':
							if(isset($option['chosen_order']) && $option['chosen_order']){
								if(empty($_POST['_'.$option['id']])){
									$value = array();
								}else{
									$value = explode(",",$_POST['_'.$option['id']]);
								}
							}else{
								if(empty($_POST[$option['id']])){
									$value = array();
								}else{
									$value = $_POST[$option['id']];
								}
							}							
							break;
						case 'color':
							// if(!empty($_POST[$option['id']]) && $_POST[$option['id']]=='transparent'){
							// 	$value = '';
							// }else{
								$value = $_POST[$option['id']];
							// }
							break;
						case 'multidropdown':
							$value = array_unique(explode(',', $_POST[$option['id']]));
							break;
						case 'tritoggle':
							switch($_POST[$option['id']]){
								case 'true':
									$value = 'true';
									break;
								case 'false':
									$value = 'false';
									break;
								case 'default':
									$value = '';
							}
							break;
						case 'toggle':
							$value = 'true';
							break;
						case 'upload':
							if(!empty($_POST[$option['id']])){
								$value = (array) json_decode(stripslashes($_POST[$option['id']]),true);
							}else{
								$value = array();
							}
							break;
						default:
							$value = $_POST[$option['id']];
					}
				} else if ($option['type'] == 'toggle') {
					$value = 'false';
				} else {
					$value = false;
				}
				
				if (isset($option['process'])){
					if(method_exists($this, $option['process'])) {
						$value = $this->{$option['process']}($option,$value);
					}elseif(function_exists($option['process'])){
						$value = $option['process']($option,$value);
					}
				}
				
				if (get_post_meta($post_id, $option['id']) == "") {
					add_post_meta($post_id, $option['id'], $value, true);
				} elseif ($value != get_post_meta($post_id, $option['id'], true)) {
					update_post_meta($post_id, $option['id'], $value);
				} elseif ($value == "") {
					delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true));
				}
			}
		}
	}
}
class Theme_Metabox_With_Tabs extends Theme_Metabox {
	public $tabs = array();

	function __construct() {
		parent::__construct();

		$this->tabs = $this->tabs();

		foreach($this->tabs as $tab){
			$this->options = array_merge($tab['options'], $this->options);
		}
	}

	function _render() {
		echo '<div class="theme-metabox with-tabs">';
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
				.'>'
				.$tab['name']
				.'</li>';
		}
		echo '</ul>';

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
		echo '</div>';
		echo '<input type="hidden" name="' . $this->slug . '_noncename" id="' . $this->slug . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
	}

	
	function renderOption($option){
		global $post;
		if (isset($option['id'])) {
			$value = get_post_meta($post->ID, $option['id'], true);
			if ($value != "") {
				$option['value'] = $value;
			}else{
				$option['value'] = $option['default'];
			}
		}

		if (isset($option['prepare'])){
			if(method_exists($this, $option['prepare'])) {
				$option = $this->{$option['prepare']}($option);
			}elseif(function_exists($option['prepare'])){
				$option = $option['prepare']($option);
			}
		}
		if (method_exists($this->generator, $option['type'])) { 
			echo '<li class="theme-option">';
			echo '<h4 class="theme-option-title"><label for="'.$option['id'].'">' . $option['name'] . '</label></h4>';
			if(!empty($option['desc'])){
				echo '<a class="theme-option-more" href=""><i></i></a>'.
					'<div class="theme-option-desc">' . $option['desc'] . '</div>';
			}
			echo '<div class="theme-option-content">';
			$this->generator->{$option['type']}($option);
			echo '</div>';
			echo '</li>';
		}elseif (method_exists($this, '_option_'.$option['type'])) {
			$method = '_option_'.$option['type'];
			$this->$method($option);
		}
	}

}
