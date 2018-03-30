<?php

class Layout_Manager_Object extends Runway_Object {
	public $option_key, $layouts_manager_options, $layouts_path;

	function __construct($settings) {

		$this->option_key = $settings['option_key'];
		$this->layouts_manager_options = get_option( $this->option_key );
		$this->layouts_path = get_stylesheet_directory().'/data/layouts/';

		add_action('wp_ajax_get_layout_data', array($this, 'ajax_get_layout_data'));
		add_action('wp_ajax_save_layout', array($this, 'ajax_save_layout'));		
		add_action('wp_ajax_get_content_elements', array($this, 'ajax_get_content_elements'));

		add_action('wp_ajax_update_header', array($this, 'ajax_update_header'));
		add_action('wp_ajax_get_headers', array($this, 'ajax_get_headers'));		

		add_action('wp_ajax_update_footer', array($this, 'ajax_update_footer'));
		add_action('wp_ajax_get_footers', array($this, 'ajax_get_footers'));		

		add_action('wp_ajax_save_options_headers', array($this, 'save_options_headers'));		
		add_action('wp_ajax_save_options_footers', array($this, 'save_options_footers'));		
		add_action('wp_ajax_save_options_other_options', array($this, 'save_options_other_options'));

		add_action('wp_ajax_get_header_settings_form', array($this, 'get_header_settings_form'));		
		add_action('wp_ajax_get_footer_settings_form', array($this, 'get_footer_settings_form'));		

		add_action('wp_ajax_sanitize_title', array($this, 'sanitize_title'));

		add_action('after_setup_theme', array($this, 'backward_compatibility'), 99);

	}

	public function check_is_header_footer_rendered(){
		$path_to_theme = get_stylesheet_directory();
		$header_func = "do_action('output_layout','start')";
		$footer_func = "do_action('output_layout','end')";
		$this->header_err = $this->footer_err = false;

		if(file_exists($path_to_theme . '/header.php' ) ) {
			$header_data = file_get_contents($path_to_theme . '/header.php');
			$this->header_err = (strstr($header_data, $header_func) == false)? true : false;
		} 
		if(file_exists($path_to_theme . '/footer.php' ) ) {
			$footer_data = file_get_contents($path_to_theme . '/footer.php');
			$this->footer_err = (strstr($footer_data, $footer_func) == false)? true : false;
		} 		
	}

	public function get_header_settings_form(){
		$alias = isset($_REQUEST['alias'])? $_REQUEST['alias'] : '';
		if(isset($alias) && $alias != ''){
			$header = isset($this->layouts_manager_options['headers'][$alias])? stripslashes_deep($this->layouts_manager_options['headers'][$alias]) : '';
			if(empty($header)){
				$header['alias'] = $alias;
			}
		}
		require_once('views/header-form.php');
		die();
	}

	public function get_footer_settings_form(){
		$alias = isset($_REQUEST['alias'])? $_REQUEST['alias'] : '';
		if(isset($alias) && $alias != ''){
			$footer = isset($this->layouts_manager_options['footers'][$alias])? stripslashes_deep($this->layouts_manager_options['footers'][$alias]) : '';
			if(empty($footer)){
				$footer['alias'] = $alias;
			}
		}
		require_once('views/footer-form.php');
		die();
	}	

	public function update_layout_settings($options){
		if(!empty($options)){
			$this->layouts_manager_options['settings'] = $options;
			update_option($this->option_key, $this->layouts_manager_options);
			return true;
		}
		return false;		
	}	

	public function validate_layout_settings($options){

		$this->layouts_manager_options['settings'] = $options;
		switch ($options['grid-structure']) {
			case 'bootstrap':
				$this->layouts_manager_options['settings']['row-class'] = in_array($options['row-class'], array('row','row-fluid') )? $options['row-class'] : 'row';
				$this->layouts_manager_options['settings']['column-class-format'] = 'span#';
				break;
			case '960':
				$this->layouts_manager_options['settings']['row-class'] = 'container_'.$options['columns'];
				$this->layouts_manager_options['settings']['column-class-format'] = 'grid_#';
				break;
			case 'unsemantic':
				$this->layouts_manager_options['settings']['row-class'] = $options['row-class'];
				$this->layouts_manager_options['settings']['column-class-format'] = 'grid-%';
				break;
			case 'custom':
				// TODO nothing
				break;
			default:
				// TODO nothing
				break;
		}
		return true;		
	}	

	// dual save
	private function save_layout($layout_alias = null){
		update_option($this->option_key, $this->layouts_manager_options);
		if($layout_alias != null){
			$file_name = $this->layouts_manager_options['layouts'][$layout_alias]['alias'].'.json';
			if(file_put_contents($this->layouts_path.$file_name, json_encode($this->layouts_manager_options['layouts'][$layout_alias]))){
				return true;
			} else {
				return false;
			}			
		}

	}


	/* ----Work with contexts---- */
	// Add or update context
	public function update_contexts($options = array()){	
		if(!empty($options)){
			$this->layouts_manager_options['contexts'] = $options;
			update_option($this->option_key, $this->layouts_manager_options);
			return true;
		}
		return false;	
	}
	// Get alias by context
	public function get_alias($context){
		if(isset($this->layouts_manager_options['contexts'][$context])){			
			return $this->layouts_manager_options['contexts'][$context];
		}
		else{
			return false;
		}
	}
	// Get all contexts
	public function get_contexts() {		
		return isset($this->layouts_manager_options['contexts']) ? $this->layouts_manager_options['contexts'] : false;
	}


	/* ----Work with layouts---- */
	// Add or update layout
	public function update_layout($options = array()){	
		if(!empty($options)){
			$this->layouts_manager_options['layouts'][$options['alias']] = $options;
			update_option($this->option_key, $this->layouts_manager_options);
			return true;
		}
		return false;	
	}
	// Delete layout
	public function delete_layout($alias){
		if($alias != ''){
			if(isset($this->layouts_manager_options['layouts'][$alias])){
				unset($this->layouts_manager_options['layouts'][$alias]);
				update_option($this->option_key, $this->layouts_manager_options);
				return true;
			}
		}
		return false;
	}

	// Get layout by alias
	public function get_layout($alias) {
		return (!empty($alias) && isset($this->layouts_manager_options['layouts'][$alias])) ? stripslashes_deep($this->layouts_manager_options['layouts'][$alias]) : false;
	}
	// Get all layouts
	public function get_layouts(){
		if(isset($this->layouts_manager_options['layouts'])){
			return stripslashes_deep($this->layouts_manager_options['layouts']);
		}
		else{
			return false;
		}
	}

	function ajax_get_content_elements() {

		$source = isset($_REQUEST['source']) ? $_REQUEST['source'] : '';
		$return_value = array();

		switch ($source) {

			case 'post':{
				$args = array(
					'posts_per_page' => -1
				);
				$posts = get_posts($args);

				foreach ($posts as $key => $value) {
					$return_value[$key]['alias'] = $value->ID;
					$return_value[$key]['title'] = $value->post_title;
				}	
			} break;
			
			case 'page':{
				$pages = get_pages(array());
				$pages_forum = get_pages(array('post_type' => 'forum'));
				if(!empty($pages_forum) )
					$pages =  array_merge($pages, $pages_forum);
				foreach ($pages as $key => $value) {
					$return_value[$key]['alias'] = $value->ID;
					$return_value[$key]['title'] = $value->post_title;
				}	
			} break;
			
			case 'static_block':{
				$args = array(
					'posts_per_page' => -1,
					'post_type' => 'static_block'
				);
				$posts = get_posts($args);

				foreach ($posts as $key => $value) {
					$return_value[$key]['alias'] = $value->ID;
					$return_value[$key]['title'] = $value->post_title;
				}
			} break;

			case 'sidebar':{
				$sidebars = $GLOBALS['wp_registered_sidebars'];				
				// $return_value = wp_get_sidebars_widgets();				
				foreach ( $sidebars as $key => $value ) { 
					$return_value[$key]['alias'] = $value['id'];
					$return_value[$key]['title'] = $value['name'];
				}
			} break;

			default:{ } break;
		}

		die(trim(json_encode($return_value)));		
	}

	function ajax_get_layout_data(){
		echo json_encode($this->get_layout($_REQUEST['alias']));
		die();
	}

	function ajax_save_layout(){
		$options = $_REQUEST;
		
		if($_REQUEST['alias'] == ''){			
			$options['alias'] = sanitize_title($_REQUEST['title']);
		}
		// out($options);
		$this->update_layout($options);
		die();
	}

	/* ----Work with header---- */
	// Add or update header
	public function update_header($options = array()){
		if(!empty($options)){
			$this->layouts_manager_options['headers'][$options['alias']] = $options;
			update_option($this->option_key, $this->layouts_manager_options);
			return true;			
		}
		return false;
	}	
	// Delete header
	public function delete_header($alias){
		if($alias != '' && isset($this->layouts_manager_options['headers'])){
			unset($this->layouts_manager_options['headers'][$alias]);
			foreach($this->layouts_manager_options['layouts'] as $key => $value) {
				foreach($value as $layout_key => $layout_value) {
					if($layout_key == 'header' && $layout_value == $alias)
						$this->layouts_manager_options['layouts'][$key][$layout_key] = '';
				}
			}
			update_option($this->option_key, $this->layouts_manager_options);
			return true;
		}
		return false;
	}
	// Get header by alias
	public function get_header($alias=false) {
		global $form_builder;
		$header = ($alias && isset($this->layouts_manager_options['headers'][$alias])) ? 
			stripslashes_deep($this->layouts_manager_options['headers'][$alias]) : false;
		
		if($header){
			$header['custom_options'] = $form_builder->get_custom_options_vals('layout_header_'.$alias, true);
		}

		return $header;
	}
	// Get all headers
	public function get_headers(){ 
		if(isset($this->layouts_manager_options['headers'])){
			return stripslashes_deep($this->layouts_manager_options['headers']);
		}
		else{
			return false;
		}
	}
	// Add or update header by ajax request
	function ajax_update_header(){		
		$alias = isset($_REQUEST['alias']) ? $_REQUEST['alias'] : sanitize_title( $_REQUEST['title'] );

		$options = array(
			'alias' => $alias,
			'title' => $_REQUEST['title'],
		);

		$this->update_header($options);
		die();
	}
	
	function ajax_get_headers(){
		echo json_encode($this->get_headers());
		die();
	}

	/* ----Work with footers---- */
	// Add or update footer
	public function update_footer($options = array()){
		if(!empty($options)){
			$this->layouts_manager_options['footers'][$options['alias']] = $options;
			update_option($this->option_key, $this->layouts_manager_options);
			return true;
		}
		return false;
	}
	// Delete footer
	public function delete_footer($alias){
		if($alias != ''){
			unset($this->layouts_manager_options['footers'][$alias]);
			foreach($this->layouts_manager_options['layouts'] as $key => $value) {
				foreach($value as $layout_key => $layout_value) {
					if($layout_key == 'footer' && $layout_value == $alias)
						$this->layouts_manager_options['layouts'][$key][$layout_key] = '';
				}
			}			
			update_option($this->option_key, $this->layouts_manager_options);
			return true;
		}
		return false;
	}
	// Get footer by alias
	public function get_footer($alias=''){
		global $form_builder;		
		$footer = ($alias && isset($this->layouts_manager_options['footers'][$alias])) ? 
			stripslashes_deep($this->layouts_manager_options['footers'][$alias]) : false;

		if($footer){
			$footer['custom_options'] = $form_builder->get_custom_options_vals('layout_footer_'.$alias, true);
		}

		return $footer;
	}
	// Get all footers
	public function get_footers(){
		if(isset($this->layouts_manager_options['footers'])){
			return stripslashes_deep($this->layouts_manager_options['footers']);
		}
		else{
			return false;
		}
	}

	/* ---- Work with "Other Options" ---- */
	// Get "other options" by alias
	/*public function get_other_options($alias=false) {
		return get_options_data('other_options_'.$alias);
	}*/

	// Add or update header by ajax request
	public function ajax_update_footer(){
		global $form_builder;
		$alias = isset($_REQUEST['alias']) ? $_REQUEST['alias'] : sanitize_title( $_REQUEST['title'] );

		$options = array(
			'alias' => $alias,
			'title' => $_REQUEST['title'],
		);

		$this->update_footer($options);
		die();

	}

	function ajax_get_footers(){
		echo json_encode($this->get_footers());
		die();
	}

	public function save_options_headers(){
		$json_form = isset($_REQUEST['json_form']) ? $_REQUEST['json_form'] : '';
		$message = '';
		$page_id = '';
		if($json_form != ''){
			$this->layouts_manager_options['headers-options'] = json_decode(stripslashes($json_form), true);
			// out(json_decode(stripslashes($json_form))); die();
			update_option($this->option_key, $this->layouts_manager_options);

			$link = home_url().'/wp-admin/themes.php?page=layout-manager&navigation=edit-options&option=headers';

			$return = array(
				'message' => $message,
				'page_id' => $page_id,
				'reload_url' => $link,
			);

			echo json_encode($return);
		} die();
	}

	public function save_options_footers(){
		$json_form = isset($_REQUEST['json_form']) ? $_REQUEST['json_form'] : '';
		$message = '';
		$page_id = '';		
		if($json_form != ''){
			$this->layouts_manager_options['footers-options'] = json_decode(stripslashes($json_form), true);
			update_option($this->option_key, $this->layouts_manager_options);

			$link = home_url().'/wp-admin/themes.php?page=layout-manager&navigation=edit-options&option=footers';

			$return = array(
				'message' => $message,
				'page_id' => $page_id,
				'reload_url' => $link,
			);

			echo json_encode($return);
		} die();
	}

	public function save_options_other_options(){
		// TODO: ajax save other options
		$json_form = isset($_REQUEST['json_form']) ? $_REQUEST['json_form'] : '';
		$message = '';
		$page_id = '';		
		if($json_form != ''){
			$this->layouts_manager_options['other-options'] = json_decode(stripslashes($json_form), true);
			update_option($this->option_key, $this->layouts_manager_options);

			$link = home_url().'/wp-admin/themes.php?page=layout-manager&navigation=edit-options&option=other-options';

			$return = array(
				'message' => $message,
				'page_id' => $page_id,
				'reload_url' => $link,
			);

			echo json_encode($return);
		} die();
	}
	
	public function sanitize_title(){
		$string = $_REQUEST['string'];
		if($string != ''){
			echo sanitize_title($string);
		}
		die();
	}

	public function get_layout_other_options($layout_alias = null){
		if($layout_alias != null){
			global $form_builder;			
			$alias = 'other_options_'.$layout_alias;
			$other_options = $form_builder->get_custom_options_vals($alias, true);
			if(is_array($other_options)) 
				return $other_options;
			else return false;
		}
	}

	function backward_compatibility(){
		if(isset($this->layouts_manager_options['headers-options']) && 
			$this->is_json($this->layouts_manager_options['headers-options'])){
			$this->layouts_manager_options['headers-options'] = json_decode(
				stripslashes( $this->layouts_manager_options['headers-options'] ), true);
			update_option($this->option_key, $this->layouts_manager_options);
		}
		
		if(isset($this->layouts_manager_options['footers-options']) && 
			$this->is_json($this->layouts_manager_options['footers-options'])){
			$this->layouts_manager_options['footers-options'] = json_decode(
				stripslashes( $this->layouts_manager_options['footers-options'] ), true);
			update_option($this->option_key, $this->layouts_manager_options);	
		}
		
		if(isset($this->layouts_manager_options['other-options']) && 
			$this->is_json($this->layouts_manager_options['other-options'])){
			$this->layouts_manager_options['other-options'] = json_decode(
				stripslashes($this->layouts_manager_options['other-options']), true);		
			update_option($this->option_key, $this->layouts_manager_options);
		}

		/* DISABLED - This was causing the demo-data.php layouts_manager key not to import in new installs.
		if(!isset($this->layouts_manager_options['settings'])){
			$default = json_decode(base64_decode('eyJncmlkLXN0cnVjdHVyZSI6ImJvb3RzdHJhcCIsImRlc2lnbi13aWR0aCI6IjEyMDAiLCJjb2x1bW5zIjoiMTIiLCJtYXJnaW5zIjoiNTAiLCJyb3ctY2xhc3MiOiJyb3ctZmx1aWQiLCJjb2x1bW4tY2xhc3MtZm9ybWF0Ijoic3BhbiMiLCJtaW4tY29sdW1uLXNpemUiOiIxIn0'), true);
			$this->layouts_manager_options['settings'] = $default;
			update_option($this->option_key, $this->layouts_manager_options);
		} */
	}

	public function is_json($string){			
		if(is_string($string)){
			return is_array(json_decode(stripslashes($string), true));			
		}
		else{
			return false;
		}
	}
} ?>