<?php

/**
 * This is the main class for managing options. Its purpose is to build an options page by a predefined
 * set of options. This class contains the functionality for printing the whole options page - its header,
 * footer and all the options inside.
 */
class DesignareOptionsManager{

	var $options=array();
	var $before_option_title='<div class="option"><h4>';
	var $after_option_title='</h4>';
	var $before_option='<div class="option">';
	var $after_option='</div>';
	var $designare_images_url='';
	var $designare_utils_url='';
	var $designare_uploads_url='';
	var $designare_version='';
	var $themename='';
	var $first_save='';
	
	/**
	 * The main constructor for the DesignareOptionsManager class
	 * @param $themename the name of the the theme
	 * @param $options_url the URL of the options directory
	 * @param $images_url the URL of the functions directory
	 * @param $uploads_url the URL of the uploads directory
	 */
	function DesignareOptionsManager($themename, $images_url, $utils_url, $uploads_url, $version){
		$this->themename=$themename;
		$this->designare_images_url=$images_url;
		$this->designare_utils_url=$utils_url;
		$this->designare_uploads_url=$uploads_url;
		$this->designare_version=$version;
		$this->first_save=get_option(DESIGNARE_SHORTNAME.'_first_save');
	}

	/**
	 * Returns the options array.
	 */
	function get_options(){
		return $this->options;
	}
	
	/**
	 * Sets the options array.
	 */
	function set_options($options){
		$this->options=$options;
	}

	/**
	 * Adds an array of options to the current options array.
	 * @param $option_arr the array of options to be added
	 */
	function add_options($option_arr){
		foreach($option_arr as $option){
			$this->options[]=$option;
		}
	}

	/**
	 * Prints the heading of the options panel.
	 * @param $heading_text the welcoming heading text
	 */
	function print_heading($heading_text){
		echo "<div id='templatepath' style='display:none;'>".get_template_directory_uri()."</div>";
		if(isset($_GET['activated'])&&$_GET['activated']=='true'){
			echo '<div class="note_box">Welcome to '.$this->themename.' theme! On this page you can set the main options
			of the theme. For more information about the theme setup, please refer to the documentation included, which
			is located within the "documentation" folder of the downloaded zip file. We hope you will enjoy working with the theme!</div>';
			
			//echo '<div class="warning_box">To get the most of this theme it requires the following plugins: <br/><strong>Revolution Slider Plugin</strong><br/><strong>Thumbnail Gallery Plugin</strong><br/><strong>CSS3 Web Pricing Tables Grids</strong><br/>They are all included in the Purchased Zip file, on the "plugins" folder.</div>';
		}
		echo '<div id="designare-content-container"><form method="post" id="designare-options">';
		if ( function_exists('wp_nonce_field') ){
			wp_nonce_field('designare-theme-update-options','designare-theme-options');
		}
		echo '<div id="sidebar"><div id="logo"></div><div id="navigation"><ul>';

		$i=1;
		foreach ($this->options as $value) {

			if($value['type']=='title'){
				$namestr = str_replace(" ", "_", $value['name']);
				$namestr = str_replace("_/", "", $namestr);
				echo '<li><span><a href="#navigation-'.$i.'"><div class="'.strtolower(str_replace(" ", "_", $value['name'])).'"></div><i class="icon-'.strtolower($namestr).'-painel" style="position:relative;float:left;line-height:47px;margin-left:20px;margin-right:5px;font-size: 15px;"></i><span>'.$value['name'].'</span></a></span></li>';
				$i++;
			}
		}

		echo '</ul></div></div><div id="content"><div id="header"><h3 id="theme_name">'.$this->themename.' <span>v.'.$this->designare_version.'</span></h3><a class="online-doc" href="http://designarethemes.net/docs/smartbox/" target="_blank"><i class="icon-file-alt"></i> Online Documentation</a><a class="support" target="_blank" href="http://support.designarethemes.net"><i class="icon-comments-alt"></i> Help & Support Forum</a></div><input type="submit" value="Save Changes" class="save-button" /><div id="options_container">';
	}
	
	/**
	 * Prints the footer of the options panel.
	 */
	function print_footer(){
		echo '</div></div><div id="designare-footer"><div id="follow-designare"> 
			 <p>Follow us</p><ul>
			 <li><a href="http://facebook.com/DesignareThemes" title="Designare on Facebook"><img src="'.$this->designare_images_url.'facebook.png" /></a></li>
			 <li><a href="http://twitter.com/DesignareThemes" title="Designare on Twitter"><img src="'.$this->designare_images_url.'twitter.png" /></a></li>
			 <li><a href="http://themeforest.net/user/designare/follow" title="Follow our work on ThemeForest"><img src="'.$this->designare_images_url.'ThemeForest.png" /></a></li>
			 
			 </ul></div><input type="hidden" name="action" value="save" />
			 <input type="submit" value="Save Changes" class="save-button" />
			 </div>	
			</form></div>';
	}

	/**
	 * Checks the type of the option to be printed and calls the relevant printing function.
	 */
	function print_options(){
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
				case 'slider':
					$this->print_slider_field($value);
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
				case 'checkbox-text-image':
					$this->print_checkbox_text_image($value);
				break;
				case 'checkbox-left-right':
					$this->print_checkbox_left_right($value);
				break;
				case 'checkbox-light-dark':
					$this->print_checkbox_light_dark($value);
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
				case 'mediaupload':
					$this->print_mediaupload($value);
				break;
				case 'designareTemplater':
					$this->print_designare_templater($value);
				break;
			}
		}
	}

	/**
	 * Prints the subnavigation tabs for each of the main navigation blocks.
	 * @param $value the option that contains the data that needs to be printed
	 * @param $i the index of the main navigation block to which the subnavigation belongs to
	 */
	function print_subnavigation($value, $i){
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
	function print_subtitle($value, $i){
		echo '<div id="tab_navigation-'.$i.'-'.$value['id'].'" class="sub-navigation-container">';
	}
	
	/**
	 * Prints a closing div tag.
	 */
	function print_close(){
		echo '</div>';
	}
	
	/**
	 * Prints the code that goes after each option.
	 * @param $value the array that contains all the data for the option
	 */
	function close_option($value){
		if(isset($value['desc'])){
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
	function print_text_field($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo '<input class="option-input" name="'.$value['id'].'" id="'.$value['id'].'" type="'.$value['type'].'" value="'.$input_value.'" />';
		$this->close_option($value);
	}
	
	function print_slider_field($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="slider" title="'.$value['id'].'"></div><input class="option-input slider-input" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="'.$input_value.'" style="text-align: center; border: 0; background: none; color: #314572; width: 201px; padding: 5px 0 0 0; margin: 0; font-style: italic;" />';
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
	function print_textarea($value){
		if (isset($value['name']))
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
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
	function print_select($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
			
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
	function print_multicheck($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		
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
	function print_color($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
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
	function print_upload($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo '<input class="option-input upload" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="'.$input_value.'" />';
		echo '<div id="'.$value['id'].'_button" class="upload-button upload-logo" ><a class="des-button alignright"><span class="upload-panel">Upload</span></a></div><br/>';
		
		//call the script for this upload button particularly
		echo '<script type="text/javascript">jQuery(document).ready(function($){
			designareOptions.loadUploader(jQuery("div#'.$value['id'].'_button"), "'.$this->designare_utils_url.'upload-handler.php", "'.$this->designare_uploads_url.'");
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
	function print_checkbox($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		if (isset($value['std']))
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="on-off"><span></span></div>';
		if(isset($input_value) && $input_value=='true'){
			$input_value='on';
		}
		if(isset($input_value) && $input_value=='false'){
			$input_value='off';
		}
		if (isset($input_value))
		echo '<input  name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$input_value.'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a checkbox - this is the TEXT/IMAGE widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "checkbox-text-image",
	 *	"std" => "text"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_checkbox_text_image($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="text-image"><span></span></div>';
		if($input_value=='true'){
			$input_value='text';
		}
		if($input_value=='false'){
			$input_value='image';
		}
		echo '<input  name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$input_value.'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a checkbox - this is the LEFT/RIGHT widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "checkbox-left-right",
	 *	"std" => "text"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_checkbox_left_right($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="left-right"><span></span></div>';
		if($input_value=='true'){
			$input_value='right';
		}
		if($input_value=='false'){
			$input_value='left';
		}
		echo '<input  name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$input_value.'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a checkbox with images - this is the LIGHT/DARK widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "images",
	 *	"std" => "light"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_checkbox_light_dark($value){
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="light-dark"><span></span></div>';
		if($input_value=='true'){
			$input_value='light';
		}
		if($input_value=='false'){
			$input_value='dark';
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
	function print_stylebox($value, $type){
		
		echo $this->before_option_title.$value['name'].$this->after_option_title;
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo '<div class="styles-holder">';
		echo '<input  name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$input_value.'" /><ul>';
		
		$counter=0;
		foreach ($value['options'] as $option) {
			//set a style the option if this is an option for selecting a color or pattern 
			if($type=='pattern') {
				//this is a pattern, set a background image to it
				if($option != "none")
					$style='background-image:url('.DESIGNARE_PATTERNS_URL.$option.');';
				else
					$style='background-image:none;';
			}elseif($type=='color'){
				//this is a color, set background color to it
				$style='background-color:#'.$option.';';
			}
			$class=$option==$input_value?'selected-style':'';
			
			echo '<li onclick="jQuery(this).parents(\'#tab_navigation-2-general\').find(\'#'.DESIGNARE_SHORTNAME.'_style_color\').attr(\'value\',\''.$option.'\'); jQuery(this).parents(\'#tab_navigation-2-general\').find(\'.color-preview\').css(\'background-color\',\'#'.$option.'\');" style="'.$style.'" class="'.$class.'"><a class="style-box" title="'.$option.'" href=""></a></li>';
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
	function print_custom($value){
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
					echo '<div id="'.$field['id'].'_button" class="upload-button upload-logo" ><a class="des-button alignright"><span>Upload</span></a></div><br/>';
					echo '<script type="text/javascript">jQuery(document).ready(function($){
								designareOptions.loadUploader(jQuery("div#'.$field['id'].'_button"), "'.$this->designare_utils_url.'upload-handler.php", "'.$this->designare_uploads_url.'");
						});</script>';
					$preview=$field['id'];
					$is_textarea[]="false";
				break;
				case 'textarea':
					//print a textarea
					echo '<textarea id="'.$field['id'].'" name="'.$field['id'].'"></textarea>';
					$is_textarea[]="true";
				break;
				case 'select':
					if (isset($value['std'])) $std = $field['std']; 
					else $std = "";
					$input_value = $this->get_field_value($field['id'], $std);
					
					echo '<select class="option-select" name="'.$field['id'].'" id="'.$field['id'].'">';

					foreach ($field['options'] as $option) {
						$attr='';	
						 if ( get_option( $field['id'] ) == $option['id']) {
							$attr = ' selected="selected"';
						 }
					 	 if ( $field['id'] == 'disabled') {
							$attr.= ' disabled="disabled"';
						 }
						 if($option['class']){
							$attr.=' class="'.$option['class'].'"';			 	
						 }
						echo '<option '.$attr.' value="http://fonts.googleapis.com/css?family='.$option['id'].'">'.$option['name'].'</option>'; 
					} 

					echo '</select><div>';
					$this->close_option($value);
					$is_textarea[]="true";
				break;
				
				case 'slider':
					$_id = strip_tags( strtolower($value['id']) );
					$int = '';
					$int = optionsframework_mlu_get_silentpost( $_id );
					$output .= '<div class="slider"><ul id="'.$value['id'].'" rel="'.$int.'">';
					$slides = $data[$value['id']];
					$count = count($slides);
					if ($count < 2) {
						$oldorder = 1;
						$order = 1;
						$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order,$int);
					} else {
						$i = 0;
						foreach ($slides as $slide) {
							$oldorder = $slide['order'];
							$i++;
							$order = $i;
							$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order,$int);
						}
					}			
					$output .= '</ul>';
					$output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';
					
				break;
				
				//drag & drop block manager
				case 'sorter':
				
					$sortlists = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : $value['std'];
					
					$output .= '<div id="'.$value['id'].'" class="sorter">';
					
					
					if ($sortlists) {
					
						foreach ($sortlists as $group=>$sortlist) {
						
							$output .= '<ul id="'.$value['id'].'_'.$group.'" class="sortlist_'.$value['id'].'">';
							$output .= '<h3>'.$group.'</h3>';
							
							foreach ($sortlist as $key => $list) {
							
								$output .= '<input class="sorter-placebo" type="hidden" name="'.$value['id'].'['.$group.'][placebo]" value="placebo">';
									
								if ($key != "placebo") {
								
									$output .= '<li id="'.$key.'" class="sortee">';
									$output .= '<input class="position" type="hidden" name="'.$value['id'].'['.$group.']['.$key.']" value="'.$list.'">';
									$output .= $list;
									$output .= '</li>';
									
								}
								
							}
							
							$output .= '</ul>';
						}
					}
					
					$output .= '</div>';
				break;
			}
			if (isset($value['std'])) $std = $value['std']; 
			else $std = "";
			$saved_value=$this->get_field_value( $field['id'].'s',$std );
						
			$saved_value=stripslashes($saved_value);
			echo '<input type="hidden" name="'.$field['id'].'s" id="'.$field['id'].'s" value="'.$saved_value.'" />';
			echo '<textarea style="display:none;" name="'.$field['id'].'" id="'.$field['id'].'">'.$saved_value.'</textarea></div>';
			$field_ids[]=$field['id'];
			$field_names[]=$field['name'];
			
			if ($field['id'] == "des_google_fonts_name"){
				$fonts = explode("|*|",$saved_value);
				if (count($fonts) > 1){
					echo '<script type="text/javascript">
					jQuery(document).ready(function(){';
					foreach($fonts as $f){
						if ($f != "")
							echo 'jQuery(\'#add_google_font_list\').append(\'<li><b>Font URL: </b><span class="des_google_fonts_name_span">'.$f.'</span><br><div class="editButton hover"></div><div class="deleteButton hover"></div></li>\');';
					}
					echo '});
					</script>';	
				}
			}
			
			
			if ($field['id'] == "des_sidebar_name_name"){
				$sidebars = explode("|*|",$saved_value);
				
				if (count($sidebars) > 0){
					echo '<script type="text/javascript">
					jQuery(document).ready(function(){';
						
					foreach($sidebars as $s){
						if ($s != ""){
							echo 'jQuery(\'#sidebar_name_list\').append(\'<li><b>Name: </b><span class="des_sidebar_name_span">'.$s.'</span><br><div class="editButton hover"></div><div class="deleteButton hover"></div></li>\');';	
						}
					}
					echo '});
					</script>';	
				}
			}
		}
		
		//print the add button
		echo '<a class="des-button custom-option-button" id="'.$value['id'].'_button"><span>'.$value['button_text'].'</span></a>';
		
		//print the list that will contain the added items
		//if ($value['id'] != 'smartbox_reset_options_button')
		echo '<ul id="'.$value['id'].'_list" class="sortable"></ul>';
		
		$idsString=implode('","', $field_ids);
		$namesString=implode('","', $field_names);
		$textareaString=implode(',', $is_textarea);
		
		if (isset($value['preview'])) $prv = $value['preview']; 
		else $prv = "";
		
		//call the script that enables the functionality for adding custom fields
		$updir = wp_upload_dir();
		$optsxml = $updir['baseurl']."/options.xml";
		$urlassign = get_template_directory_uri()."/lib/functions/getXML.php";
		
		echo '<script type="text/javascript">
			jQuery(document).ready(function($){
				designareOptions.setCustomFieldsFunc("'.$value['id'].'", ["'.$idsString.'"], ["'.$namesString.'"], ['.$textareaString.'] , "'.$prv.'",  "");
				jQuery(\'#smartbox_export_options_button\').css({\'position\':\'relative\',\'float\':\'left\'}).attr(\'target\',\'_blank\').unbind().click(function(){
					window.open("'.$urlassign.'");
				});
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
	function get_field_value($id, $std){
		if ( get_option( $id ) != "" || $this->first_save) {
			if (is_array(get_option($id)))
				return "";
			else 
				return stripslashes((string)get_option($id)); 
		} else {
			return stripslashes($std); 
		}
	}
	
	function print_text($value){
		echo $this->before_option;
		echo $value['text'];
		$this->close_option($value);
	}
	
	/**
	 * Prints the message that is displayed when the options have been saved
	 */
	function print_saved_message(){
		echo '<div class="note_box" id="saved_box">'.$this->themename.' settings saved.</div>';	
	}
	
	/**
	 * Prints the message that is displayed when the options have been reset
	 */
	function print_reset_message(){
		echo '<div><p>'.$this->themename.' settings reset.</p></div>';	
	}
	
	function print_mediauploader($value){
		dump($value);
		$modal_update_href = esc_url( add_query_arg( array(
		    'page' => 'des_gallery',
		    '_wpnonce' => wp_create_nonce('des_gallery_options'),
		), admin_url('upload.php') ) );

		echo $modal_update_href;
		
	}
	
	function print_designare_templater($value){
		?>
		<div id="des_templater_<?php echo $value["value"]; ?>">
			<div class="msg_new_save">New Template Saved</div>
			<div class="msg_save_success">Current Template Saved</div>
			<div class="msg_deleted">Template Deleted</div>
			<div class="msg_loaded">Template Loaded</div>
		<?php
		$tabName = "";
		switch($value["value"]){
			case "body": $tabName = "Body"; break;
			case "header": $tabName = "Header & Top Contents"; break;
			case "menu" : $tabName = "Menu"; break;
			case "pagetitle": $tabName = "Page Title"; break;
			case "footer": $tabName = "Footer"; break;
			case "text": $tabName = "Typography"; break;
		}
		$templates = get_option("des_styletemplates");
		if (gettype($templates) === "string"){
			$templates = unserialize(trim(get_option("des_styletemplates")));
			if (gettype($templates) === "string") unserialize($templates);
		}
		
		if (!empty($templates)){ 
			$found = false;
			$output = "";
			
			foreach ($templates as $t){
				if (strstr($t, $value["value"])){
					$found = true;
					$temp = get_option($t);
					while(gettype($temp) === "string"){
						$temp = unserialize(trim($temp));
					}
					if (!empty($temp)){
						if ($t == get_option("des_current_".$value["value"]."_template")){
							$output .= "<option selected='selected' value='".$t."'>".$temp['des_template_tab']['nicename']."</option>";
						} else $output .= "<option value='".$t."'>".$temp['des_template_tab']['nicename']."</option>";
						echo $output;
					}
				}
			}
			if ($found) { 
				?>
				<h4>Selected Template:</h4>
				<select id="des_style_template_chooser_<?php echo $value["value"]; ?>" onchange="jQuery('#des_current_<?php echo $value["value"]; ?>_template').val(jQuery(this).val());"><?php echo $output; ?></select>
				<div class="warning" style="display:none;"><p>There are no saved templates for the <?php echo $tabName; ?> Options.</p></div>
				<?php
			} else { ?>
				<h4 style="display:none;">Selected Template:</h4>
				<select id="des_style_template_chooser_<?php echo $value["value"]; ?>" onchange="jQuery('#des_current_<?php echo $value["value"]; ?>_template').val(jQuery(this).val());" style="display:none;"></select>
				<div class="warning"><p>There are no saved templates for the <?php echo $tabName; ?> Options.</p></div>
			<?php
			} 
		} else { ?>
			<h4 style="display:none;">Selected Template:</h4>
			<select id="des_style_template_chooser_<?php echo $value["value"]; ?>" onchange="jQuery('#des_current_<?php echo $value["value"]; ?>_template').val(jQuery(this).val());" style="display:none;"></select>
			<div class="warning"><p>There are no saved templates for the <?php echo $tabName; ?> Options.</p></div>
			<?php
		}
		
		?>
			
			<div class="des_templater_buttons">
				<div class="des_load_template" title="Load the Selected Template Options!" onclick="des_templater_actions_handler('load_template','<?php echo $value["value"]; ?>','<?php echo DESIGNARE_SHORTNAME; ?>');">Load Template</div>
				<div class="des_save_new_template" title="Save Current Options in a New Template!" onclick="des_templater_actions_handler('save_new','<?php echo $value["value"]; ?>','<?php echo DESIGNARE_SHORTNAME; ?>');">Save New Template</div>
				<div class="des_save_current_template" title="Save the Current Options on the Selected Template!" onclick="des_templater_actions_handler('save_current','<?php echo $value["value"]; ?>','<?php echo DESIGNARE_SHORTNAME; ?>');">Save Current</div>
				<div class="des_delete_current_template" title="Remove the Selected Template." onclick="des_templater_actions_handler('delete_current','<?php echo $value["value"]; ?>','<?php echo DESIGNARE_SHORTNAME; ?>');">Delete Current</div>
				<div style="display:none;" class="newnamebox" id="namebox-<?php echo $value['value']; ?>">
					<label for="save_new">Save template as...<br/>
					<input name="save_new" class="save_new" type="text" />
				</div>
			</div>
		
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('#des_current_<?php echo $value["value"]; ?>_template').closest('.option').css('display','none');
					jQuery('#des_templater_<?php echo $value["value"]; ?>').css({
						'min-height': '35px',
						'padding': '20px 0 20px 0',
						'background-image': 'url(<?php echo get_template_directory_uri(); ?>/lib/images/option_bg.png)',
						'background-repeat': 'repeat-x',
						'background-position': 'bottom',
						'height': 'auto',
						'overflow': 'hidden',
						'position': 'relative',
						'margin': '0 32px 15px 32px',
						'z-index': '10'
					})
					.find('.warning').css({'width':'282px','position':'relative','float':'left'})
					.find('p').css({'margin-top':'0px', 'margin-bottom':'0px'});
					jQuery('#des_templater_<?php echo $value["value"]; ?>').find('h4').css('float','none');
				});
			</script>
		
		</div>
		<?php
		
	}
	
}