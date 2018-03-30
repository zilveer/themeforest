<?php
class NHP_Options_google_webfonts extends NHP_Options{	
	
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
		$this->field['fonts'] = array();
		
		$fonts = get_transient('nhp-opts-google-webfonts');
		if(!is_array(json_decode($fonts))){

			$data= wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?key='.$this->args['google_api_key']);
			$fonts = wp_remote_retrieve_body($data);

			if(!$fonts){
				//WP_Filesystem();
				//global $wp_filesystem;
				//$fonts = @$wp_filesystem->get_contents(CT_THEME_LIB_DIR.'/options/fields/google_webfonts/webfonts.json');
				$fonts = @file_get_contents(CT_THEME_LIB_DIR.'/options/fields/google_webfonts/webfonts.json');
			}

			

			set_transient('nhp-opts-google-webfonts', $fonts, 60 * 60 * 24);
				
		}
		$this->field['fonts'] = json_decode($fonts);
		
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
		
		echo '<select id="'.esc_attr($this->field['id']).'" name="'.esc_attr($this->args['opt_name'].'['.$this->field['id'].']').'" '.$class.'rows="6" >';

		echo '<option value=""></option>';

		foreach($this->field['fonts']->items as $cut){
			foreach($cut->variants as $variant){
				
				echo '<option value="'.esc_attr($cut->family.':'.$variant).'" '.selected($this->value, $cut->family.':'.$variant, false).'>'.esc_html($cut->family.' - '.$variant).'</option>';
			}
		}
		echo '</select>';
			echo '<p class="description" style="color:red;">'.sprintf(wp_kses(__('The fonts provided below are free to use custom fonts from the <a href="%1$s" target="_blank">Google Web Fonts directory</a>.<br/>Please <a href="%1$s" target="_blank">browse the directory</a> to preview a font, then select your choice below.','ct_theme'),array('a'=>array(),'br'=>array())),'http://www.google.com/webfonts').'</p>';
//allow HTML here - added by devs
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
	}//function
	
}//class
?>