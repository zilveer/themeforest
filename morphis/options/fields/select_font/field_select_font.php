<?php
class NHP_Options_select_font extends NHP_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since NHP_Options 1.0
	*/
	function __construct($field = array(), $value ='', $parent){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		//$this->render();
		
		// load css
		wp_register_style('field_select_font_css', get_template_directory_uri() . '/options/fields/select_font/field_select_font.css', false, '1.0.0', 'all');	
		wp_enqueue_style('field_select_font_css');
		
		// google web fonts
		// load font preview
		wp_register_script ( 'field_select_font_js', get_template_directory_uri() . '/options/fields/select_font/field_select_font.js', array('jquery'), '1.0.0' );
		wp_enqueue_script ( 'field_select_font_js' );
	
		$google_api_key_localize = array(
					'key' => GOOGLE_API_KEY,
					'id' => $this->field['id'],
					'path' => get_template_directory_uri() . '/fonts/',
					'path_child' => get_stylesheet_directory_uri() . '/fonts/',
		);
		
		wp_localize_script( 'field_select_font_js', 'google_api_key_localize', $google_api_key_localize );		
		
	}//function
	


	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since NHP_Options 1.0
	*/
	function render(){
		
		$class = (isset($this->field['class']))?'class="'.$this->field['class'].'" ':'';
		
		echo '<select id="'.$this->field['id'].'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" '.$class.'rows="6" >';
			
			foreach($this->field['options'] as $k => $v){
				
				echo '<option value="'.$k.'" '.selected($this->value, $k, false).'>'.$v.'</option>';
				
			}//foreach

		echo '</select>';
		echo '<div id="'.$this->field['id'].'-previewer" class="google-font-previewer" width="300px" height="100px">';
		echo '<h1 class="preview-text">The quick brown fox jumps over the lazy dog</h1>';
		echo '<div class="loading"></div>';
		echo '</div>';
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function
	
}//class
?>