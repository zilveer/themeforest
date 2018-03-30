<?php

/**
 * This is the main class for managing options. Its purpose is to build an options page by a predefined
 * set of options. This class contains the functionality for printing the whole options page - its header,
 * footer and all the options inside.
 * @author Pexeto
 * http://pexeto.com
 */
class PexetoOptionsManager{

	public $options=array();
	public $before_option_title='<div class="option"><h4>';
	public $after_option_title='</h4>';
	public $before_option='<div class="option">';
	public $after_option='</div>';
	public $pexeto_images_url='';
	public $pexeto_utils_url='';
	public $pexeto_uploads_url='';
	public $pexeto_version='';
	public $themename='';
	
	/**
	 * The main constructor for the PexetoOptionsManager class
	 * @param $themename the name of the the theme
	 * @param $options_url the URL of the options directory
	 * @param $images_url the URL of the functions directory
	 * @param $uploads_url the URL of the uploads directory
	 */
	public function PexetoOptionsManager($themename, $images_url, $utils_url, $uploads_url, $version){
		$this->themename=$themename;
		$this->pexeto_images_url=$images_url;
		$this->pexeto_utils_url=$utils_url;
		$this->pexeto_uploads_url=$uploads_url;
		$this->pexeto_version=$version;
	}

	/**
	 * Returns the options array.
	 */
	public function get_options(){
		return $this->options;
	}
	
	/**
	 * Sets the options array.
	 */
	public function set_options($options){
		$this->options=$options;
	}

	/**
	 * Adds an array of options to the current options array.
	 * @param $option_arr the array of options to be added
	 */
	public function add_options($option_arr){
		foreach($option_arr as $option){
			$this->options[]=$option;
		}
	}

	/**
	 * Prints the heading of the options panel.
	 * @param $heading_text the welcoming heading text
	 */
	public function print_heading($heading_text){
		
		echo '<div id="pexeto-content-container"><form method="post" id="pexeto-options">';
		if ( function_exists('wp_nonce_field') ){
			wp_nonce_field('pexeto-theme-update-options','pexeto-theme-options');
		}
		echo '<div id="sidebar"><div id="logo"></div><div id="navigation"><ul>';

		$i=1;
		foreach ($this->options as $value) {

			if($value['type']=='title'){
				echo '<li><span><a href="#navigation-'.$i.'"><img src="'.$value['img'].'" />'.$value['name'].'</a></span></li>';
				$i++;
			}
		}

		echo '</ul></div></div><div id="content"><div id="header"><h3 id="theme_name">'.$this->themename.' v.'.$this->pexeto_version.'</h3><a class="more-button" href="http://themeforest.net/user/pexeto/portfolio"></a></div><div id="options_container">';
	}
	
	/**
	 * Prints the footer of the options panel.
	 */
	public function print_footer(){
		echo '</div></div><div id="pexeto-footer"><div id="follow-pexeto"> 
			 <p>Follow Pexeto on:</p><ul>
			 <li><a href="http://twitter.com/pexeto" title="Pexeto on Twitter"><img src="'.$this->pexeto_images_url.'twitter.png" /></a></li>
			 <li><a href="http://themeforest.net/user/pexeto/follow" title="Follow my work on ThemeForest"><img src="'.$this->pexeto_images_url.'tf.png" /></a></li>
			 <li><a href="http://pexeto.com"><img src="'.$this->pexeto_images_url.'pex.png" title="Visit my website" /></a></li>
			 </ul></div><input type="hidden" name="action" value="save" />
			 <input type="submit" value="Save Changes" class="save-button" />
			 </div>	
			</form></div>';
	}

	/**
	 * Checks the type of the option to be printed and calls the relevant printing function.
	 */
	public function print_options(){
		$i=0;
		foreach ($this->options as $value) {
			switch ( $value['type'] ) {
				case 'open':
					$this->print_subnavigation($value, $i);
				break;
				case 'subtitle':
					$this->print_subtitle($value, $i);
				break;
				case 'close':
					$this->print_close();
				break;
				case 'title':
					$i++;
				break;
				case 'text':
					$this->print_text_field($value);
				break;	
				case 'textarea':
					$this->print_textarea($value);
				break;
				case 'select':
					$this->print_select($value);
				break;
				case 'multicheck':
					$this->print_multicheck($value);
				break;
				case 'color':
					$this->print_color($value);
				break;
				case 'upload':
					$this->print_upload($value);
				break;
				case 'checkbox':
					$this->print_checkbox($value);
				break;
				case 'custom':
					$this->print_custom($value);
				break;
				case 'pattern':
					$this->print_stylebox($value, 'pattern');
				break;
				case 'stylecolor':
					$this->print_stylebox($value, 'color');
				break;
				case 'documentation':
					$this->print_text($value);	
				break;
			}
		}
	}

	/**
	 * Prints the subnavigation tabs for each of the main navigation blocks.
	 * @param $value the option that contains the data that needs to be printed
	 * @param $i the index of the main navigation block to which the subnavigation belongs to
	 */
	public function print_subnavigation($value, $i){
		echo '<div id="navigation-'.$i.'" class="main-navigation-container">';
		if($value['subtitles']){
			echo '<div id="tab_navigation-'.$i.'" class="tab_navigation"><ul>';
			foreach($value['subtitles'] as $subtitle){
				echo '<li><a href="#tab_navigation-'.$i.'-'.$subtitle['id'].'" class="tab"><span>'.$subtitle['name'].'</span></a></li>';
			}
			echo '</ul></div>';
	 	}
	}
	
	/**
	 * Prints a subtitle - a single tab title
	 * @param $value the option array that contains the data to be printed
	 * @param $i the index of the content block that will be opened when the tab is clicked
	 */
	public function print_subtitle($value, $i){
		echo '<div id="tab_navigation-'.$i.'-'.$value['id'].'" class="sub-navigation-container">';
	}
	
	/**
	 * Prints a closing div tag.
	 */
	public function print_close(){
		echo '</div>';
	}
	
	/**
	 * Prints the code that goes after each option.
	 * @param $value the array that contains all the data for the option
	 */
	public function close_option($value){
		if($value['desc']){
			echo '<a href="" class="help-button"><div class="help-dialog" title="'.$value['name'].'"><p>'.$value['desc'].'</p></div></a>';
		}
		echo $this->after_option;
	}

	/**
	 * Prints a standart text field.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Text Field Title",
	 *	"id" => $shortname."_test_textfield",
	 *	"type" => "text"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	public function print_text_field($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<input class="option-input" name="'.$value['id'].'" id="'.$value['id'].'" type="'.$value['type'].'" value="'.$input_value.'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a textarea.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Textarea Name",
	 *	"id" => $shortname."_test_textarea",
	 *	"type" => "textarea")
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	public function print_textarea($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo ' <textarea name="'.$value['id'].'" class="option-textarea" cols="" rows="">'.$input_value.'</textarea>';
		$this->close_option($value);
	}
	
	/**
	 * Prints a select drop down menu.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Featured Category",
	 *	"id" => $shortname."_featured_cat",
	 *	"type" => "select",
	 *	"options" => array(array("name"=>"Option one", "id"=>1), array("name"=>"Option two", "id"=>2))
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	public function print_select($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
			
		echo '<select class="option-select" name="'.$value['id'].'" id="'.$value['id'].'">';
		
		foreach ($value['options'] as $option) {
			$attr='';	
			 if ( get_option( $value['id'] ) == $option['id']) {
				$attr = ' selected="selected"';
			 }
		 	 if ( $option['id'] == 'disabled') {
				$attr.= ' disabled="disabled"';
			 }
			 if($option['class']){
				$attr.=' class="'.$option['class'].'"';			 	
			 }
			echo '<option '.$attr.' value="'.$option['id'].'">'.$option['name'].'</option>'; 
		} 
	
		echo '</select>';
		$this->close_option($value);
	}	
	
	
	/**
	 * Prints a multicheck widget.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Exclude categories",
	 *	"id" => $shortname."_exclude_cat",
	 *	"type" => "multicheck",
	 *  "class" => "exclude", //exclude|include
	 *	"options" => array(array("name"=>"Option one", "id"=>1), array("name"=>"Option two", "id"=>2))
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	public function print_multicheck($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
		
		$checked_class=$value['class']==''?'include':$value['class'];
		echo '<input  name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$input_value.'" class="hidden-value" /><div class="option-check '.$checked_class.'">';
		
		$input_array=explode(',',$input_value);
		foreach ($value['options'] as $option) {
			$class='';	
			 if (in_array($option['id'], $input_array)) {
				$class = ' selected-check';
			 }
			echo '<div class="check-holder"><a href="" class="check'.$class.'" title="'.$option['id'].'"></a><span class="check-value">'.$option['name'].'</span></div>'; 
		} 
		echo '</div>';
	
		$this->close_option($value);
	}	
	
	/**
	 * Prints a text field with a color picker option.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Headings color",
	 *	"id" => $shortname."_heading_color",
	 *	"type" => "color"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	public function print_color($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<span class="numbersign">&#35;</span><input class="option-input color" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="'.$input_value.'" />';
		echo '<div class="color-preview" style="background-color:#'.$input_value.'"></div>';
		$this->close_option($value);
	}
	
	/**
	 * Prints a text field with an upload button.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Logo image",
	 *	"id" => $shortname."_logo_image",
	 *	"type" => "upload"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	public function print_upload($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<input class="option-input upload" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="'.$input_value.'" />';
		echo '<div id="'.$value['id'].'_button" class="upload-button upload-logo" ><a class="pex-button alignright"><span>Upload</span></a></div><br/>';
		
		
		$uploader_url = pexeto_generate_uploads_url($value['id']);
		//call the script for this upload button particularly
		echo '<script type="text/javascript">jQuery(document).ready(function($){
			pexetoOptions.loadUploader(jQuery("div#'.$value['id'].'_button"), "'.$uploader_url.'", "'.$this->pexeto_uploads_url.'");
		});</script>'; 
		
		$this->close_option($value);
	}
	
	/**
	 * Prints a checkbox - this is the ON/OFF widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "checkbox",
	 *	"std" => "off"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	public function print_checkbox($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="on-off"><span></span></div>';
		if($input_value=='true'){
			$input_value='on';
		}
		if($input_value=='false'){
			$input_value='off';
		}
		echo '<input  name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$input_value.'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a widget for selecting styles for the theme. Generally it prints different buttons with
	 * different styles set to them so that the user can select one of them. It can be mostly used for 
	 * selecting a color or a pattern from a given range.
	 * 
	 * EXAMPLE USAGE OF PATTERNS:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 *	"name" => "Theme Pattern",
	 *	"id" => $shortname."_pattern",
	 *	"type" => "pattern",
	 *	"options" => $patterns
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 * @param $type the type of the buttons, so far the supported values are "color" and "pattern"
	 */
	public function print_stylebox($value, $type){
		
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="styles-holder">';
		echo '<input  name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$input_value.'" /><ul>';
		
		$counter=0;
		foreach ($value['options'] as $option) {
			//set a style the option if this is an option for selecting a color or pattern 
			if($type=='pattern') {
				//this is a pattern, set a background image to it
				$style='background-image:url('.PEXETO_PATTERNS_URL.$option.');';
			}elseif($type=='color'){
				//this is a color, set background color to it
				$style='background-color:#'.$option.';';
			}
			$class=$option==$input_value?'selected-style':'';
			
			echo '<li style="'.$style.'" class="'.$class.'"><a class="style-box" title="'.$option.'" href=""></a></li>';
		} 
		echo '</ul></div>';
		$this->close_option($value);
	}
	
	/**
	 * Prints a custom set of fields with an Add button - this field will be mostly used when 
	 * several items that share the same data structure needs to be added. For example, this can be very
	 * useful for adding images to the slider with different options- title, link, etc.
	 * So far the fields that are supported by this function are text field, text field with upload button and a 
	 * textarea.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 *	"name"=>"Add Slider Image",
	 *	"id"=>'thumbnail_slider',
	 *	"type"=>"custom",
	 *	"button_text"=>'Add image',
	 *	"preview"=>"thumbnail_image_name",
	 *		"fields"=>array(
	 *			array('id'=>'thumbnail_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	 *			array('id'=>'thumbnail_image_title', 'type'=>'text', 'name'=>'Image Title'),
	 *			array('id'=>'thumbnail_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
	 *		)
	 *	)
     * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	public function print_custom($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title.'<br/><br/><br/>';
		
		$field_ids=array();
		$field_names=array();
		$is_textarea=array();
		
		foreach($value['fields'] as $field){
			echo '<div class="custom-option"><span class="custom-heading">'.$field['name'].'</span>';
			switch($field['type']){
				case 'text':
					//print a standart text field
					echo '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'"/>';
					$is_textarea[]="false";
				break;
				case 'upload':
					//print a field with an upload button
					echo '<input class="option-input upload" name="'.$field['id'].'" id="'.$field['id'].'" type="text" />';
					echo '<div id="'.$field['id'].'_button" class="upload-button upload-logo" ><a class="pex-button alignright"><span>Upload</span></a></div><br/>';
					$uploader_url = pexeto_generate_uploads_url($value['id'].$field['id']);
					echo '<script type="text/javascript">jQuery(document).ready(function($){
								pexetoOptions.loadUploader(jQuery("div#'.$field['id'].'_button"), "'.$uploader_url.'", "'.$this->pexeto_uploads_url.'");
						});</script>';
					$preview=$field['id'];
					$is_textarea[]="false";
				break;
				case 'textarea':
					//print a textarea
					echo '<textarea id="'.$field['id'].'" name="'.$field['id'].'"></textarea>';
					$is_textarea[]="true";
				break;
			}
			$saved_value=get_option( $field['id'].'s' );
			
			//get the older value if the panel has been updated from the older version
			if($saved_value=='' && get_option('pexeto_first_save')==''){
				$saved_value=get_option( $field['id'] );
			}
			$saved_value=stripslashes($saved_value);
			//echo '<input type="hidden" name="'.$field['id'].'s" id="'.$field['id'].'s" value="'.$saved_value.'" /></div>';
			echo '<textarea style="display:none;" name="'.$field['id'].'s" id="'.$field['id'].'s">'.$saved_value.'</textarea></div>';
			$field_ids[]=$field['id'];
			$field_names[]=$field['name'];
		}
		
		//print the add button
		echo '<a class="pex-button custom-option-button" id="'.$value['id'].'_button"><span>'.$value['button_text'].'</span></a>';
		
		//print the list that will contain the added items
		echo '<ul id="'.$value['id'].'_list" class="sortable"></ul>';
		
		$idsString=implode('","', $field_ids);
		$namesString=implode('","', $field_names);
		$textareaString=implode(',', $is_textarea);
		
		//call the script that enables the functionality for adding custom fields
		echo '<script type="text/javascript">
			jQuery(document).ready(function($){
				pexetoOptions.setCustomFieldsFunc("'.$value['id'].'", ["'.$idsString.'"], ["'.$namesString.'"], ['.$textareaString.'] , "'.$value['preview'].'",  "'.PEXETO_TIMTHUMB_URL.'");
			});
		</script>';
		
		$this->close_option($value);
	}
	
	/**
	 * Gets the saved value for a field
	 * @param $id the ID of the field
	 * @param $std the default value for the field
	 * @return string if there is a saved value, it returns the saved value,
	 * if not - it returns the default value
	 */
	public function get_field_value($id, $std){
		if ( get_option( $id ) != "" || get_option(PEXETO_SHORTNAME.'_first_save')) { 
			return stripslashes(get_option( $id )); 
		} else { 
			return stripslashes($std); 
		}
	}
	
	public function print_text($value){
		echo $this->before_option;
		echo $value['text'];
		$this->close_option($value);
	}
	
	/**
	 * Prints the message that is displayed when the options have been saved
	 */
	public function print_saved_message(){
		echo '<div class="note_box" id="saved_box">'.$this->themename.' settings saved.</div>';	
	}
	
	/**
	 * Prints the message that is displayed when the options have been reset
	 */
	public function print_reset_message(){
		echo '<div><p>'.$this->themename.' settings reset.</p></div>';	
	}
	
}