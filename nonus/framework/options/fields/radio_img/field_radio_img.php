<?php
class NHP_Options_radio_img extends NHP_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since NHP_Options 1.0
	*/
	function __construct($field = array(), $value = '', $parent = ''){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		//$this->render();
		
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
		
		echo '<fieldset>';
			
			foreach($this->field['options'] as $k => $v){

				$selected = (checked($this->value, $k, false) != '')?' nhp-radio-img-selected':'';

				echo '<label class="nhp-radio-img'.$selected.' nhp-radio-img-'.$this->field['id'].'" for="'.esc_attr($this->field['id'].'_'.array_search($k,array_keys($this->field['options']))).'">';
				echo '<input type="radio" id="'.esc_attr($this->field['id'].'_'.array_search($k,array_keys($this->field['options']))).'" name="'.esc_attr($this->args['opt_name'].'['.$this->field['id'].']').'" '.$class.' value="'.esc_attr($k).'" '.checked($this->value, $k, false).'/>';
				echo '<img src="'.esc_url($v['img']).'" alt="'.esc_attr($v['title']).'" onclick="jQuery:nhp_radio_img_select(\''.$this->field['id'].'_'.array_search($k,array_keys($this->field['options'])).'\', \''.$this->field['id'].'\');" />';
				echo '<br/><span>'.esc_html($v['title']).'</span>';
				echo '</label>';
				
			}//foreach
		//allow HTML here - added by devs
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?'<br/><span class="description">'.$this->field['desc'].'</span>':'';
		
		echo '</fieldset>';
		
	}//function
	
	
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since NHP_Options 1.0
	*/
	function enqueue(){
		
		wp_enqueue_script(
			'nhp-opts-field-radio_img-js', 
			NHP_OPTIONS_URL.'fields/radio_img/field_radio_img.js', 
			array('jquery'),
			time(),
			true
		);
		
	}//function
	
}//class
?>