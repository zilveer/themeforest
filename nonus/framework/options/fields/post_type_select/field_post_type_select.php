<?php
class NHP_Options_post_type_select extends NHP_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since NHP_Options 1.0.1
	*/
	function __construct($field = array(), $value ='', $parent){
		
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
	 * @since NHP_Options 1.0.1
	*/
	function render(){
		
		$class = (isset($this->field['class']))?'class="'.$this->field['class'].'" ':'';
		
		echo '<select id="'.esc_attr($this->field['id']).'" name="'.esc_attr($this->args['opt_name'].'['.$this->field['id'].']').'" '.$class.' >';
		
		if(!isset($this->field['args'])){$this->field['args'] = array();}
		$args = wp_parse_args($this->field['args'], array('public' => true));
			
		$post_types = get_post_types($args, 'object'); 
		foreach ( $post_types as $k => $post_type ) {
			echo '<option value="'.esc_attr($k).'"'.selected($this->value, $k, false).'>'.esc_html($post_type->labels->name).'</option>';
		}
		echo '</select>';
		//allow HTML here - added by devs
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function
	
}//class
?>