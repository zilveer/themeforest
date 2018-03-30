<?php

class Shortcodes{
	
	function __construct(){
		add_action( 'init', array( $this, 'shortcode_buttons' ) );
		add_action('wp_ajax_shortcode_call', array( $this, 'shortcode_options' ) );
		add_action('wp_ajax_nopriv_shortcode_call', array( $this, 'shortcode_options' ) );
	}

	function shortcode_buttons(){
		add_filter( "mce_external_plugins", array( $this, "add_buttons" ) );
	    add_filter( 'mce_buttons', array( $this, 'register_buttons' ) );	
	}
	

	function add_buttons( $plugin_array ) {
	    $plugin_array['couponxl'] = get_template_directory_uri() . '/js/shortcodes.js';
	    return $plugin_array;
	}

	function register_buttons( $buttons ) {
	    array_push( $buttons, 'couponxlgrid', 'couponxlelements' ); 
	    return $buttons;
	}

	function shortcode_options(){
		$shortcode = $_POST['shortcode'];
		echo $this->$shortcode();
		die();
	}


	function render_options( $fields ){
		$fields_html = '';
		foreach( $fields as $field ){
			if( !in_array( $field['type'], array( 'css_editor', 'textarea_html' ) ) ){
				$fields_html .= '<div class="shortcode-option"><label>'.$field['heading'].'</label>';
				switch ( $field['type'] ){
					case 'textfield' : 
						$fields_html .= '<input type="text" class="shortcode-field" name="'.$field['param_name'].'" value="'.$field['value'].'">';
						break;
					case 'dropdown' :
						$options = '';
						if( !empty( $field['value'] ) ){
							foreach( $field['value'] as $option_name => $option_value ){
								$options .= '<option value="'.$option_value.'">'.$option_name.'</option>';
							}
						}
						$fields_html .= '<select name="'.$field['param_name'].'" class="shortcode-field">'.$options.'</select>';
						break;
					case 'multidropdown' :
						$options = '';
						if( !empty( $field['value'] ) ){
							foreach( $field['value'] as $option_name => $option_value ){
								$options .= '<option value="'.$option_value.'">'.$option_name.'</option>';
							}
						}
						$fields_html .= '<select name="'.$field['param_name'].'" class="shortcode-field" multiple>'.$options.'</select>';
						break;
					case 'colorpicker' :
						$fields_html .= '<input type="text" name="'.$field['param_name'].'" class="shortcode-field shortcode-colorpicker" value="'.$field['value'].'" />';
						break;
					case 'attach_image' :
						$fields_html .= '<div class="shortcode-image-holder"></div><div class="clearfix"></div>
										<a href="javascript:;" class="shortcode-add-image button">'.__( 'Add Image', 'couponxl' ).'</a>
										<input type="hidden" name="'.$field['param_name'].'" class="shortcode-field" valu="'.$field['value'].'">';
						break;	
					case 'attach_images' :
						$fields_html .= '<div class="shortcode-images-holder"></div><div class="clearfix"></div>
										<a href="javascript:;" class="shortcode-add-images button">'.__( 'Add Images', 'couponxl' ).'</a>
										<input type="hidden" name="'.$field['param_name'].'" class="shortcode-field" value="'.$field['value'].'">';
						break;
					case 'textarea' :					
						$fields_html .= '<textarea name="'.$field['param_name'].'" class="shortcode-field">'.$field['value'].'</textarea>';
						break;
					case 'textarea_raw_html' :					
						$fields_html .= '<textarea name="'.$field['param_name'].'" class="shortcode-field">'.$field['value'].'</textarea>';
						break;						
				}
				$fields_html .= '<div class="description">'.$field['description'].'</div></div>';
			}
		}


		echo $fields_html.'<a href="javascript:;" class="shortcode-save-options button">'.__( 'Insert', 'couponxl' ).'</a>';
		die();

	}
	/* FUNCTIONS FOR THE couponxl GRID */
	function row(){
		echo '';
		die();
	}
	function accordion(){
		$fields = $this->render_options( couponxl_accordion_params() );
	}	
	function column(){
		$fields = $this->render_options( couponxl_column_params() );
	}
	function button(){
		$fields = $this->render_options( couponxl_button_params() );
	}
	function coupons(){
		$fields = $this->render_options( couponxl_coupons_params() );
	}	
	function deals(){
		$fields = $this->render_options( couponxl_deals_params() );
	}
	function blogs(){
		$fields = $this->render_options( couponxl_blogs_params() );
	}
	function gmap(){
		$fields = $this->render_options( couponxl_gmap_params() );
	}	
	function slider(){
		echo '';
		die();
	}
	function content(){
		$fields = $this->render_options( couponxl_content_params() );
	}
	function sidebar(){
		$fields = $this->render_options( couponxl_sidebar_params() );
	}
	function featured_stores(){
		$fields = $this->render_options( couponxl_featured_stores_params() );
	}
}

if( is_admin() ){
	new Shortcodes();
}

?>