<?php

/**
 * This class contains some templating functions - for building HTML code.
 *
 * @author Pexeto
 *
 */
class PexetoCustomPageBuilder {

	protected $default_term = '';

	function __construct( $default_term ) {
		$this->default_term = $default_term;
	}

	protected function get_resized_img($img_url){
		if(PEXETO_CP_THUMB_RESIZE){
			return pexeto_get_resized_image($img_url, 150, 150);
		}else{
			return $img_url;
		}
	}

	/**
	 * Builds a template for a single custom page list item.
	 *
	 * @param $post        the post object that represents the item
	 * @param $custom_page a custom page object that represents tha custom page
	 * @param $prefix      the prefix of the fields in the form
	 */
	public function get_custom_page_list_template( $post, $custom_page, $prefix ) {
		$add_class = $custom_page->minimizable ? ' class="minimized"':'class="non-minimizable"';

		$preview_data = null;
		if(isset($custom_page->preview_data) && $custom_page->preview_data!='none'){
			if(isset($custom_page->preview_data['condition'])){
				$field_val = get_post_meta($post->ID, $prefix.$custom_page->preview_data['condition'], true);
				if(isset($custom_page->preview_data[$field_val])){
					$preview_data=$custom_page->preview_data[$field_val];
				}
			}else{
				$preview_data=$custom_page->preview_data;
			}
		}


		$html='<li id="'.$post->ID.'"'.$add_class.'>';
		if ( !empty($preview_data) ) {
			$preview_img='';
			$html_data='';

			foreach ($preview_data as $key => $preview_el) {
				$field = $custom_page->get_field_by_id($preview_el);
				if(empty($field)){
					continue;
				}
				
				if(isset($field['video']) && $field['video']=='true'){
					$field_type = 'video';
				}else{
					$field_type = $field['type'];
				}

				switch ($field_type) {
					case 'upload':
						if(empty($preview_img)){
							$preview_img = get_post_meta( $post->ID, $prefix.$preview_el, true);
						}
						break;
					case 'video':
						if(empty($preview_img)){
							$video_url =  get_post_meta( $post->ID, $prefix.$preview_el, true);
							if(!empty($video_url)){
								$preview_img = 'http://img.youtube.com/vi/'.pexeto_get_youtube_video_id($video_url).'/2.jpg';
							}
						}
						break;
					case 'multiupload':
						$val = get_post_meta( $post->ID, $prefix.$preview_el, true);
						if(!empty($val)){
							$html_data.='<div class="custom-multiupload-preview">';
							$image_ids = explode(',', $val);

							foreach ($image_ids as $key => $imgid) {
								$thumbnail = wp_get_attachment_image_src( intval($imgid), 'thumbnail');
								$html_data.='<img src="'.$thumbnail[0].'" />';

								if($key==4 && sizeof($image_ids>5)){
									$html_data.='[...]';
									break;
								}
							}

							$html_data.='</div>';
						}
						break;
					default:
						$val = get_post_meta( $post->ID, $prefix.$preview_el, true);
						if($field_type=='select'){
							foreach ($field['options'] as $option) {
								if($option['id']==$val){
									$val=$option['name'];
									break;
								}
							}
						}
						$html_data.='<div class="custom-preview-data"><label>'.$field['name'].'</label><span class="custom-preview-val">'.htmlspecialchars($val).'</span></div>';
						break;
				}

			}

			$wrap_add_class='';
			if(!empty($preview_img)){
				$html.= '<img src="'.$this->get_resized_img($preview_img).'" class="custom-preview-img"/>';
				$wrap_add_class.=' custom-with-preview';
			}

			if(!empty($html_data)){
				$html.='<div class="custom-preview-wrap'.$wrap_add_class.'">'.$html_data.'</div>';
			}

			
		}
		$html.='<input type="hidden" value="'.$post->ID.'" id="itemid" name="itemid" /><div class="edit-button hover" title="Edit"></div><div class="delete-button hover" title="Delete"></div><div class="loading"></div></li>';

		return $html;
	}


	private function generate_upload_data($field, $val){
		$data_arr = array();

		$data='data-fieldid="'.$field['id'].'" data-fieldname="custom_'.$field['id'].'"';

		if(!empty($val)){
			if($field['type']=='upload'){
				$data.=' data-url="'.$val.'" data-thumbnail="'.$this->get_resized_img($val).'"';
			}else{
				$images = explode(',', $val);
				$img_data=array();
				$content = '';

				if(sizeof($images)){
					foreach ($images as $imgid) {
						$thumbnail = wp_get_attachment_image_src( intval($imgid), 'thumbnail');
						$img_data[]=array('id'=>$imgid, 'thumbnail'=>$thumbnail[0]);
						$content.='<img src="'.$thumbnail[0].'" />';
					}
					$data.=' data-images="'.esc_attr(json_encode($img_data)).'"';
					
				}

				$data_arr['content']=$content;
			}
		}

		$data_arr['data']=$data;

		return $data_arr;
	}

	/**
	 * Returns the HTML that is before each item custom section.
	 *
	 * @param $title the title of the item
	 */
	public function get_before_custom_section( $title ) {
		$html= '<div class="custom-item-wrapper"><div class="ui-icon ui-icon-triangle-1-e arrow"></div><h3>'.$title.'</h3>';
		if ( $title!=$this->default_term ) {
			$html.='<div class="delete-slider-button hover"></div>';
		}
		$html.='<div class="custom-section">';
		return $html;
	}

	/**
	 * Returns the HTML that is after each item custom section.
	 */
	public function get_after_custom_section() {
		return '</div></div>';
	}

	/**
	 * Checks if a field is at a selected position in a row, e.g. first or last
	 * @param  string  $position first|second|last
	 * @param  array  $field    field data
	 * @return boolean           true if the field is at the selected position
	 */
	protected function is_field_position_in_a_row($position, $field){
		$is_columns_layout = false;

		if(isset( $field['two-column'] )){
			$columns_key = 'two-column';
			$is_columns_layout = true;
		}elseif(isset( $field['three-column'] )){
			$columns_key = 'three-column';
			$is_columns_layout = true;
		}

		if(!$is_columns_layout || ($is_columns_layout && $field[$columns_key]==$position)){
			return true;
		}
		return false;
	}


	/**
	 * Builds the template for a custom page form with all the input fields needed.
	 *
	 * @param $title       the title of the form
	 * @param $category    the category that corresponds to the current instance (each instance represents a different category)
	 * @param $custom_page a custom page object that represents the custom page
	 * @param $prefix      the prefix of the fields in the form
	 */
	public function get_custom_page_form_template( $title, $category, $custom_page, $prefix, $post_id = null ) {
		$add_mode = empty($post_id);

		$html='<div class="custom-container"><form class="custom-page-form">';

		foreach ( $custom_page->fields as $field ) {
			$field_id = $prefix.$field['id'];
			$add_class = '';

			//get saved value
			$saved_val = '';
			if(!empty($post_id)){
				$saved_val = get_post_meta( $post_id, $field_id, true);
			}
			if(empty($saved_val) && isset($field['default']) && $add_mode){
				$saved_val = $field['default'];
			}


			if ( $this->is_field_position_in_a_row( 'first', $field ) ) {
				$html.='<div class="custom-page-row">';
			}

			if(isset( $field['two-column'] )){
				$add_class = ' custom-two-column custom-two-column-'.$field['two-column'];
			}elseif(isset( $field['three-column'] )){
				$add_class = ' custom-three-column custom-three-column-'.$field['three-column'];
			}


			if(isset( $field['required'] )){
				$add_class.= ' required';
			}
			$html.= '<div class="custom-page-field'.$add_class.'"><h4 class="custom-heading">'.$field['name'].'</h4>';
			if(isset($field['desc'])){
				$html.='<span class="custom-desc">'.$field['desc'].'</span>';
			}

			switch ( $field['type'] ) {
			case 'text':
				//print a standart text field
				$html.= '<input type="text" id="'.$field['id'].'" name="'.$field_id.'" class="option-input" value="'.esc_attr($saved_val).'"/>';
				if(isset($field['suffix'])){
					$html.='<span class="custom-suffix">'.$field['suffix'].'</span>';
				}
				break;
			case 'upload':
			case 'videoupload':
				
				$button_id='upload_button'.$category;

				$data = 'data-fieldid="'.$field['id'].'" data-fieldname="custom_'.$field['id'].'"';
				if(!empty($saved_val)){
					$data.=' data-url="'.$saved_val.'" data-thumbnail="'.$this->get_resized_img($saved_val).'"';
				}
				if( $field['type']=='videoupload'){
					$data.=' data-video="true"';
				}
				$html.= '<div class="pexeto-upload" '.$data.'></div>';
				//print a field with an upload button
				break;
			case 'multiupload':
				$button_id='multi_upload_button'.$category;

				// $data = 'data-fieldid="'.$field['id'].'" data-fieldname="custom_'.$field['id'].'"';
				$data = $this->generate_upload_data($field, $saved_val);
				$html.= '<div class="pexeto-multiupload"'.$data['data'].'></div>';
				break;
			case 'textarea':
				//print a textarea
				$html.= '<textarea id="'.$field['id'].'" name="'.$field_id.'" rows="4" class="option-input">'.$saved_val.'</textarea>';
				break;
			case 'select':
				//print a select field
				$html.='<select id="'.$field['id'].'" name="'.$field_id.'">';
				foreach ($field['options'] as $option ) {
					//set the fields to hide when this option is selected
					$data_hide = isset($option['hide']) ? ' data-hide="'.$option['hide'].'"' : '';
					$selected = $saved_val==$option['id']?' selected="selected"':'';
					$html.='<option value="'.$option['id'].'"'.$data_hide.$selected.'>'.$option['name'].'</option>';
				}
				$html.='</select>';
				break;
			case 'colorpick':
				//print a standart text field
				$html.= '<span class="custom-prefix">#</span><input type="text" id="'.$field['id'].'" name="'.$field_id.'" value="'.$saved_val.'" class="option-input option-color"/>';
				$html.='<div class="color-preview" ></div>';
				break;
			case 'checkbox':
				$saved_val = explode(',', $saved_val);

				$html.='<div class="checkbox-wrapper" id="'.$field_id.'">';
				foreach ( $field['options'] as $sub_option ) {
					$checked='';
					if(in_array( $sub_option['id'], $saved_val ) ) {
						$checked = 'checked="checked"';
					}
					$html.= '<input type="checkbox" name="'.$field_id.'[]" value="'.$sub_option['id'].'" '.$checked.'/><span class="check-name">'.$sub_option['name'].'</span>';
				}
				$html.='<div class="clear"></div></div>';
				break;

			}
			$html.='</div>';

			if ( $this->is_field_position_in_a_row( 'last', $field ) ) {
				$html.='<div class="clear"></div></div>';
			}
		}


		$html.='<div>';
		//display some hidden inputs with the main item data that may be used in AJAX requests later
		$html.='<input type="hidden" name="category" value="'.$category.'" class="category" />';
		$html.='<input type="hidden" name="default_title" value="'.$title.'" />';
		$html.='<input type="hidden" name="post_type" value="'.$custom_page->post_type.'" />';

		$html.='<div class="add-button-container"><div class="loading"></div>';
		//print the add button
		$btnText = $add_mode ? 'Add Item' : 'Update Item';
		$btnClass = $add_mode ? 'custom-option-add-button' : 'custom-option-edit-button';

		$html.= '<a class="custom-option-button pex-button '.$btnClass.'" ><span><i aria-hidden="true" class="icon-plus"></i>'.$btnText.'</span></a>';

		$html.='</div><div class="clear"></div></div>';

		$html.='</form></div>';
		return $html;

	}
}
