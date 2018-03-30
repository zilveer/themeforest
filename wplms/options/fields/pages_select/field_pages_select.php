<?php
class VIBE_Options_pages_select extends VIBE_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since VIBE_Options 1.0.1
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
	 * @since VIBE_Options 1.0.1
	*/
	function render(){
		
		$class = (isset($this->field['class']))?'class="chosen '.$this->field['class'].'" ':'class="chosen "';
		
		echo '<select id="'.$this->field['id'].'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" '.$class.'rows="6" >';
		
		if(isset($this->field['args'])){
			$args = wp_parse_args($this->field['args'], array());
			$pages = get_pages($args); 
		}else{
			$pages = get_pages(); 
		}
			

			echo '<option value="">'.__('None','vibe').'</option>';

		if(is_array($pages)){
			foreach ( $pages as $page ) {
				echo '<option value="'.$page->ID.'"'.selected($this->value, $page->ID, false).'>'.$page->post_title.'</option>';
			}
		}
		echo '</select>';

		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function
	
}//class
?>