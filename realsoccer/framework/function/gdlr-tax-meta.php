<?php
	/*	
	*	Goodlayers Taxonomy meta box
	*	---------------------------------------------------------------------
	*	This file create the class which handled the metabox for 
	*	custom taxonomy
	*	---------------------------------------------------------------------
	*/

	if( !class_exists('gdlr_tax_meta') ){
		class gdlr_tax_meta{
			
			public $setting;
			public $option;
			
			function __construct($setting = array(), $option = array()){
			
				$default_setting = array( 
					'taxonomy' => 'category',
					'slug' => 'gdlr_category_meta'
				);
				
				$this->setting = wp_parse_args($setting, $default_setting);
				$this->option = $option;

				add_action('admin_enqueue_scripts',  array(&$this, 'include_script'));
				
				add_action($setting['taxonomy'] . '_add_form_fields', array(&$this, 'create_new_taxonomy_meta'));
				add_action($setting['taxonomy'] . '_edit_form_fields', array(&$this, 'create_edit_taxonomy_meta'));
				
				add_action('edited_' . $setting['taxonomy'], array(&$this, 'save_taxonomy_meta'));  
				add_action('create_' . $setting['taxonomy'], array(&$this, 'save_taxonomy_meta'));				
			}
			
			function include_script( $page ){
				if( $page = 'edit-tags.php' ){
					wp_enqueue_script('jquery');
					
					wp_enqueue_style('gdlr-tax-meta', GDLR_PATH . '/framework/stylesheet/gdlr-tax-meta.css');	
					wp_enqueue_style('gdlr-date-picker', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
					
					if(function_exists( 'wp_enqueue_media' )){
						wp_enqueue_media();
					}					
					wp_enqueue_script('jquery-ui-core');
					wp_enqueue_script('jquery-ui-datepicker');
					wp_enqueue_script('gdlr-tax-meta', GDLR_PATH . '/framework/javascript/gdlr-tax-meta.js');
				}
			}
			
			// create a meta field for new category 
			function create_new_taxonomy_meta(){
				$this->print_html('new');				
			}
			
			// create a meta field for category edit page
			function create_edit_taxonomy_meta( $term ){
				$this->print_html('edit', $term->slug);		
			}
			
			// save value for each taxonomy
			function save_taxonomy_meta( $term_id ){
				$term = get_term_by('id', $term_id, $this->setting['taxonomy']);
				if ( isset($_POST['term_meta']) ){
				
					$term_meta = get_option( $this->setting['slug'] );
					$cat_keys = array_keys( $_POST['term_meta'] );
					
					foreach( $cat_keys as $key ){
						if ( isset($_POST['term_meta'][$key]) ) {
							$term_meta[$term->slug][$key] = gdlr_stripslashes($_POST['term_meta'][$key]);
						}
					}
					// Save the option array.
					update_option( $this->setting['slug'], $term_meta );
				}			
			}
			
			///////////////// TAX META HTML SECTION ///////////////////
			function print_html( $page = 'edit', $id = '' ){
				if( empty($id) ){
					$tax_val = array();
				}else{
					$tax_val = get_option( $this->setting['slug'], array() );
					$tax_val = !empty($tax_val[$id])? $tax_val[$id]: array();
				}

				foreach( $this->option as $option_key => $option_value ){
					$option_value['slug'] = $option_key;
					$option_value['value'] = !empty($tax_val[$option_value['slug']])? $tax_val[$option_value['slug']]: '';
					
					// starting tag
					if( $page == 'edit' ){
						echo '<tr class="form-field">';
						echo '<th scope="row" valign="top">';
						echo '<label for="term_meta[' . $option_key . ']">' . $option_value['title'] . '</label>';
						echo '</th>';
						echo '<td>';
					}else{
						echo '<div class="form-field">';
						echo '<label for="term_meta[' . $option_key . ']">' . $option_value['title'] . '</label>';
					}
				
					switch($option_value['type']){
						case 'text': $this->text_input_box($option_value); break;
						case 'textarea': $this->textarea_box($option_value); break;
						case 'date-picker': $this->date_picker($option_value); break;
						case 'upload': $this->upload_media_box($option_value); break;
						case 'combobox': $this->combobox($option_value); break;
					}
				
					// field description
					if( !empty($option_value['description']) ){
						echo '<p class="description">' . $option_value['description'] . '</p>';
					}
					
					// ending tag
					if( $page == 'edit' ){
						echo '</td>';
						echo '</tr>';					
					}else{
						echo '</div>';
					}
				}
			}
			
			function text_input_box( $option ){
				echo '<input type="text" name="term_meta[' . $option['slug'] . ']" ';
				echo 'id="term_meta[' . $option['slug'] . ']" ';
				echo 'value="' . $option['value'] . '">';
			}

			function textarea_box( $option ){
				echo '<textarea type="text" class="gdlr-textarea" name="term_meta[' . $option['slug'] . ']" ';
				echo 'id="term_meta[' . $option['slug'] . ']" >' . $option['value'] . '</textarea>';
			}			
			
			function date_picker( $option ){
				echo '<input class="gdlr-date-picker" type="text" name="term_meta[' . $option['slug'] . ']" ';
				echo 'id="term_meta[' . $option['slug'] . ']" ';
				echo 'value="' . $option['value'] . '">';
			}			
			
			function combobox( $option ){
				echo '<select name="term_meta[' . $option['slug'] . ']" id="term_meta[' . $option['slug'] . ']" >';
				foreach( $option['options'] as $key => $value ){
					echo '<option value="' . $key . '" ';
					echo ($value == $option['value'])? 'selected ': '';
					echo '>' . $value . '</option>';	
				}
				echo '</select>';
			}			
			
			function upload_media_box( $option ){
				echo '<img class="gdlr-preview" ';
				if( !empty($option['value']) ){
					if( is_numeric($option['value']) ){
						$option['show_value'] = wp_get_attachment_url($option['value']);
						echo 'src="' . $option['show_value'] . '" ';
					}else{
						$option['show_value'] = $option['value'];
						echo 'src="' . $option['value'] . '" ';
					}
				}else{
					$option['show_value'] = '';
					echo 'style="display: none;" ';
				}
				echo '/>';
				
				echo '<div class="clear"></div>';
				
				echo '<input type="text" class="gdlr-half gdlr-upload-box-input" ';
				echo 'id="term_meta[' . $option['slug'] . ']" ';
				echo 'value="' . $option['show_value'] . '">';	

				echo '<input type="hidden" class="gdlr-upload-box-hidden" ';
				echo 'name="term_meta[' . $option['slug'] . ']" ';
				echo 'value="' . $option['value'] . '">';	
				
				echo '<input type="button" class="gdlr-upload-media" value="' . __('Upload', 'gdlr_translate') . '" >';
				
				echo '<div class="clear"></div>';
			}
		}
	}	
	
?>