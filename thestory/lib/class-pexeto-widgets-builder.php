<?php

/**
 * Contains all the main functionality to print different widgets,
 * such as text boxes, upload fields, multi check options, etc.
 *
 * @author Pexeto
 */
class PexetoWidgetsBuilder {

	public $option_class = "option";
	public $multi_class = "multi-option";
	public $title_tag = "h4";
	protected $data_obj = null;
	protected $resize_thumbnails = true;

	/**
	 * Default constructor.
	 *
	 * @param PexetoDataFields $data_obj object from the PexetoDataFields class
	 * that will be used to retrieve the field saved/default value.
	 */
	function __construct( $data_obj ) {
		$this->data_obj = $data_obj;
	}

	/**
	 * Prints a closing div tag.
	 */
	protected function print_close() {
		echo '</div>';
	}

	/**
	 * Pruints the markup before the field.
	 *
	 * @param array   $field array containing the field data
	 * @param boolean $multi should be set to true if it is a multi-option field
	 */
	protected function print_before_field( $field, $multi=false ) {
		$multiclass  = $multi ? ' '.$this->multi_class.' option-fields-'.sizeof( $field["fields"] ):'';
		$data = "";
		//add data attribute if it is set
		if ( isset( $field["data"] ) ) {
			foreach ( $field["data"] as $key=>$value ) {
				$data.=' data-'.$key.'="'.$value.'"';
			}
		}
		$additional_class = isset($field['suffix']) ? ' with-suffix':'';
		
		$field_class = isset($field['id'])? ' option-id-'.sanitize_html_class($field['id']):'';
		$html = '<div class="'.$this->option_class.$multiclass.' option-'.$field['type'].$additional_class.$field_class.'"'.$data.'>';
		if ( isset( $field['name'] ) ) $html.='<'.$this->title_tag.'>'.$field['name'].'</'.$this->title_tag.'>';
		if($field['type']!='documentation'){
			$html .= '<div class="option-input-wrap">';
		}
		echo $html;
	}

	/**
	 * Prints a field - calls the function that prints the field according to
	 * its type.
	 *
	 * @param array   $field array containing the field data
	 */
	public function print_field( $field, $saved = null ) {

		$saved_val = $saved!=null ? $saved : $this->data_obj->get_value( $field['id'] );


		switch ( $field['type'] ) {
		case 'text':
			$this->print_text_field( $field, $saved_val );
			break;
		case 'textarea':
			$this->print_textarea( $field, $saved_val );
			break;
		case 'select':
			$this->print_select( $field, $saved_val );
			break;
		case 'multicheck':
			$this->print_multicheck( $field, $saved_val );
			break;
		case 'color':
			$this->print_color( $field, $saved_val );
			break;
		case 'upload':
			$this->print_upload( $field, $saved_val );
			break;
		case 'checkbox':
			$this->print_checkbox( $field, $saved_val );
			break;
		case 'imageradio':
			$this->print_image_radio( $field, $saved_val );
			break;
		case 'pattern':
			$this->print_stylebox( $field, $saved_val, 'pattern' );
			break;
		case 'stylecolor':
			$this->print_stylebox( $field, $saved_val, 'color' );
			break;
		case 'multioption':
			$this->print_before_field( $field, true );
			foreach ( $field["fields"] as $sub_field ) {
				$new_field = $sub_field;
				$new_field['id']=$field['id'].'_'.$sub_field['id'];

				if(isset($saved_val[$sub_field['id']])){
					$field_val = $saved_val[$sub_field['id']];
				}else{
					//this is a newly added field that hasn't been saved, load the default value
					$field_val = $this->data_obj->get_default_value($sub_field);
				}
				$this->print_field( $new_field , $field_val );
			}
			$this->print_after_field( $field );
			break;
		}
	}

	/**
	 * Prints the code that goes after each option.
	 *
	 * @param unknown $field the array that contains all the data for the option
	 */
	protected function print_after_field( $field ) {
		if($field['type']!='documentation'){
			echo '</div>';
		}
		if ( isset( $field['desc'] ) ) {
			$title = isset($field['name']) ? $field['name'] : '';
			//print the help button
			echo '<span class="help-button icon-help" aria-hidden="true" title="'.$title.'"><div class="dialog-content"><p>'.$field['desc'].'</p></div></span>';
		}
		echo '</div>'; //close the main option div
	}

	/**
	 * Prints a standart text field.
	 *
	 * EXAMPLE $field:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 * "name" => "Text Field Title",
	 * "id" => "test_textfield",
	 * "type" => "text"
	 * )
	 * ------------------------------------------------------------------------------------------
	 *
	 * @param unknown $field     the array that contains all the data for the option
	 * @param unknown $saved_val the default value to set in the field
	 */
	public function print_text_field( $field, $saved_val ) {
		$this->print_before_field( $field );
		echo '<input class="option-input" name="'.$field['id'].'" id="'.$field['id'].'" type="'.$field['type'].'" value="'.htmlspecialchars( $saved_val ).'" />';
		if(isset($field['suffix'])){
			echo '<span class="option-suffix">'.$field['suffix'].'</span>';
		}
		$this->print_after_field( $field );
	}



	/**
	 * Prints a textarea.
	 *
	 * EXAMPLE $field:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 * "name" => "Textarea Name",
	 * "id" => "test_textarea",
	 * "type" => "textarea")
	 * ------------------------------------------------------------------------------------------
	 *
	 * @param unknown $field     the array that contains all the data for the option
	 * @param unknown $saved_val the default value to set in the field
	 */
	public function print_textarea( $field, $saved_val ) {
		$this->print_before_field( $field );
		$additional_class = isset( $field['large'] ) && $field['large']==true ? ' textarea-large':'';
		echo ' <textarea name="'.$field['id'].'" id="'.$field['id'].'" class="option-textarea'.$additional_class.'" cols="" rows="">'.$saved_val.'</textarea>';
		$this->print_after_field( $field );
	}

	/**
	 * Prints a select drop down menu.
	 *
	 * EXAMPLE $field:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 * "name" => "Featured Category",
	 * "id" => "featured_cat",
	 * "type" => "select",
	 * "options" => array(array("name"=>"Option one", "id"=>1), array("name"=>"Option two", "id"=>2))
	 * )
	 * ------------------------------------------------------------------------------------------
	 *
	 * @param unknown $field     the array that contains all the data for the option
	 * @param unknown $saved_val the default value to set in the field
	 */
	public function print_select( $field, $saved_val ) {
		$this->print_before_field( $field );

		echo '<select class="option-select" name="'.$field['id'].'" id="'.$field['id'].'">';

		foreach ( $field['options'] as $option ) {
			if(isset($option['type'])){
				if($option['type']=='group'){
					echo '<optgroup label="'.$option['label'].'">';
				}elseif($option['type']=='groupend'){
					echo '</optgroup>';
				}
			}else{
				$attr='';
				if ( $saved_val == $option['id'] ) {
					$attr = ' selected="selected"';
				}
				if ( $option['id'] == 'disabled' ) {
					$attr.= ' disabled="disabled"';
				}
				if ( isset( $option['class'] ) ) {
					$attr.=' class="'.$option['class'].'"';
				}
				echo '<option '.$attr.' value="'.$option['id'].'">'.stripcslashes($option['name']).'</option>';
			}
			
		}

		echo '</select>';
		$this->print_after_field( $field );
	}

	/**
	 * Prints a multicheck widget.
	 *
	 * EXAMPLE $field:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 * "name" => "Exclude categories",
	 * "id" => "exclude_cat",
	 * "type" => "multicheck",
	 *  "class" => "exclude", //exclude|include
	 * "options" => array(array("name"=>"Option one", "id"=>1), array("name"=>"Option two", "id"=>2))
	 * )
	 * ------------------------------------------------------------------------------------------
	 *
	 * @param unknown $field     the array that contains all the data for the option
	 * @param unknown $saved_val the default value to set in the field
	 */
	public function print_multicheck( $field, $saved_val ) {
		$this->print_before_field( $field );
		if ( is_string( $saved_val ) ) {
			$saved_val = explode( ',', $saved_val );
		}

		$checked_class=$field['class']==''?'include':$field['class'];
		echo '<div class="option-check '.$checked_class.'"  id="'.$field['id'].'">';

		foreach ( $field['options'] as $sub_option ) {
			$class='';
			if ( !empty( $saved_val ) && in_array( $sub_option['id'], $saved_val ) ) {
				$class = ' selected';
			}
			echo '<div class="check-holder '.$class.'" data-val="'.$sub_option['id'].'"><span class="check icon-checkmark" aria-hidden="true" ></span><span class="check-value">'.$sub_option['name'].'</span></div>';
		}
		echo '</div>';

		$this->print_after_field( $field );
	}



	/**
	 * Prints a text field with a color picker option.
	 *
	 * EXAMPLE $field:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 * "name" => "Headings color",
	 * "id" => "heading_color",
	 * "type" => "color"
	 * )
	 * ------------------------------------------------------------------------------------------
	 *
	 * @param unknown $field     the array that contains all the data for the option
	 * @param unknown $saved_val the default value to set in the field
	 */
	public function print_color( $field, $saved_val ) {
		$this->print_before_field( $field );
		echo '<span class="numbersign">&#35;</span><input class="option-input option-color" name="'.$field['id'].'" id="'.$field['id'].'" type="text" value="'.$saved_val.'" />';
		echo '<div class="color-preview" style="background-color:#'.$saved_val.'"></div>';
		$this->print_after_field( $field );
	}


	/**
	 * Prints a text field with an upload button.
	 *
	 * EXAMPLE $field:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 * "name" => "Logo image",
	 * "id" => "logo_image",
	 * "type" => "upload"
	 * )
	 * ------------------------------------------------------------------------------------------
	 *
	 * @param unknown $field     the array that contains all the data for the option
	 * @param unknown $saved_val the default value to set in the field
	 */
	public function print_upload( $field, $saved_val) {
		$this->print_before_field( $field );

		$data = ' data-fieldid="'.$field['id'].'"';
		if(!empty($saved_val)){
			$data.=' data-url="'.htmlspecialchars( $saved_val ).'"';
			$thumb = $this->resize_thumbnails ? pexeto_get_resized_image($saved_val, 150, 150) : $saved_val;
			$data.=' data-thumbnail="'.$thumb.'"';
		}
		echo '<div class="pexeto-upload"'.$data.'></div>';

		$this->print_after_field( $field );
	}

	/**
	 * Prints a checkbox - this is the ON/OFF widget with an animation.
	 *
	 * EXAMPLE $field:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 * "name" => "Checkbox Title",
	 * "id" => "test_check",
	 * "type" => "checkbox",
	 * "std" => "off"
	 * )
	 * ------------------------------------------------------------------------------------------
	 *
	 * @param unknown $field     the array that contains all the data for the option
	 * @param unknown $saved_val the default value to set in the field
	 */
	public function print_checkbox( $field, $saved_val ) {
		$this->print_before_field( $field );
		if ( $saved_val===true || $saved_val=="true" ) {
			$def_class='on';
		}else {
			$def_class='off';
		}
		echo '<div class="on-off '.$def_class.'" id="'.$field['id'].'"><em class="on-text">on</em><span class="handle">|||</span><em class="off-text">off</em></div>';
		$this->print_after_field( $field );
	}


	/**
	 * Prints a widget for selecting styles for the theme. Generally it prints different buttons with
	 * different styles set to them so that the user can select one of them. It can be mostly used for
	 * selecting a color or a pattern from a given range.
	 *
	 * EXAMPLE USAGE OF PATTERNS:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 * "name" => "Theme Pattern",
	 * "id" => "pattern",
	 * "type" => "pattern",
	 * "options" => $patterns
	 * )
	 * ------------------------------------------------------------------------------------------
	 *
	 * @param unknown $field     the array that contains all the data for the option
	 * @param unknown $saved_val the default value to set in the field
	 * @param unknown $type      the type of the buttons, so far the supported values are "color" and "pattern"
	 */
	public function print_stylebox( $field, $saved_val, $type ) {

		$this->print_before_field( $field );
		echo '<div class="button-option" id="'.$field['id'].'">';

		$counter=0;
		$style='';
		foreach ( $field['options'] as $sub_option ) {
			//set a style the option if this is an option for selecting a color or pattern
			if ( $type=='pattern' && $sub_option!='none' ) {
				//this is a pattern, set a background image to it
				$style='background-image:url('.PEXETO_PATTERNS_URL.$sub_option.');';
			}elseif ( $type=='color' ) {
				//this is a color, set background color to it
				$style='background-color:#'.$sub_option.';';
			}
			$class=$sub_option==$saved_val?'selected':'';

			echo '<li style="'.$style.'" class="'.$class.'"><a class="style-box" title="'.$sub_option.'" href=""></a></li>';
		}
		echo '</ul></div>';
		$this->print_after_field( $field );
	}

	/**
	 * Prints an image radio field (radio button with image preview).
	 *
	 * EXAMPLE $field:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 * "name" => "Layout",
	 * "id" => "layout",
	 * "type" => "imageradio",
	 * "options" => array(array("name"=>"Option one", "id"=>1, "img"=>"IMAGE-URL-HERE"), array("name"=>"Option two", "id"=>2, "img"=>"IMAGE-URL-HERE"))
	 * )
	 * ------------------------------------------------------------------------------------------
	 *
	 * @param unknown $field     the array that contains all the data for the option
	 * @param unknown $saved_val the default value to set in the field
	 */
	public function print_image_radio( $field, $saved_val ) {
		$this->print_before_field( $field );

		if ( sizeof( $field['options'] )>0 ) {
			foreach ( $field['options'] as $sub_option ) {
				$checked = $saved_val == $sub_option['id']?'checked="checked"':'';
				echo '<div class="option-image-radio"><input type="radio" name="'.$field['id'].'" value="'.$sub_option['id'].'" '.$checked.'/><img src="'.$sub_option['img'].'" title="'.$sub_option['title'].'"/>
				<span class="option-image-radio-label">'.$sub_option['title'].'</span>
				</div>';
			}
		}

		$this->print_after_field( $field );
	}

}
