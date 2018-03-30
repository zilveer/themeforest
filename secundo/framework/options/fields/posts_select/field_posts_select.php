<?php
class NHP_Options_posts_select extends NHP_Options{	
	
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
		
		$args = wp_parse_args($this->field['args'], array('numberposts' => '-1'));

		if($this->field['empty_label'] != '') {
			$emptyValue = isset($this->field['empty_value'])?$this->field['empty_value']:'';

			echo '<option value="'.esc_attr($emptyValue).'"' . selected($this->value, $emptyValue, false) . '>' . esc_html($this->field['empty_label']) . '</option>';
		}
		$posts = get_posts($args); 
		foreach ( $posts as $post ) {
			echo '<option value="'.$post->ID.'"'.selected($this->value, $post->ID, false).'>'.esc_html($post->post_title).'</option>';
		}

		echo '</select>';
		//allow HTML here - added by devs
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function
	
}//class
?>