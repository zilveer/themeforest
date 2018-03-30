<?php
/*
Plugin Name: Categories Color
Description: Categories Color Plugin allow you to add an color to category or any custom term.
Author: Zerge
Version: 1.0
Author URI: http://color-theme.com/
*/
?>
<?php

/*
	===================================================================================================================================
	*
	*		Init Plugin
	*
	===================================================================================================================================	
*/

add_action('admin_head', 'ct_init');
function ct_init() {
	$ct_taxonomies = get_taxonomies();

	if ( is_array( $ct_taxonomies) ) {
	    foreach ($ct_taxonomies as $ct_taxonomy ) {
	        add_action( $ct_taxonomy . '_add_form_fields', 'ct_add_color_theme_field');
			add_action( $ct_taxonomy . '_edit_form_fields', 'ct_edit_color_theme_field');
	    }
	}
}

/*
	===================================================================================================================================
	*
	*		Include jQuery ColorPicker Scripts
	*
	===================================================================================================================================	
*/

function ct_admin_scripts() {
	if( is_admin() ) {

		wp_register_script('jquery-colorpicker-color',get_template_directory_uri().'/js/colorpicker-color.js',false, null , true);
		wp_enqueue_script('jquery-colorpicker-color',array('jquery'));	

		wp_register_script('jquery-colorpicker',get_template_directory_uri().'/js/colorpicker.js',false, null , true);
		wp_enqueue_script('jquery-colorpicker',array('jquery'));	
	
	} 
}
add_action('wp_enqueue_scripts', 'ct_admin_scripts');



/*
	===================================================================================================================================
	*
	*		Pick Category Color When Create New Category
	*
	===================================================================================================================================	
*/

function ct_add_color_theme_field() {
	wp_enqueue_style('thickbox');
	wp_enqueue_script('thickbox');
	
	wp_enqueue_style( 'style-colorpicker-js', get_template_directory_uri().'/css/colorpicker.css','','','all');	

	/* get colorpicker scripts */
	ct_admin_scripts();

	echo '<div class="form-field">
		<label for="taxonomy_color">Pick Category Color</label> 
		<input type="text" name="taxonomy_clr" id="taxonomy_clr" value="" />
	</div>'.ct_script();
	
}

/*
	===================================================================================================================================
	*
	*		Pick Category Color When Edit Category
	*
	===================================================================================================================================	
*/

function ct_edit_color_theme_field($taxonomy) {
	wp_enqueue_style('thickbox');
	wp_enqueue_script('thickbox');
	wp_enqueue_style( 'style-colorpicker-js', get_template_directory_uri().'/css/colorpicker.css','','','all');	
	
	/* get colorpicker scripts */
	ct_admin_scripts();
	
	echo '<tr class="form-field">
		<th scope="row" valign="top"><label for="taxonomy_color">Category Color</label></th>
		<td><input type="text" name="taxonomy_clr" id="taxonomy_clr" value="'.get_option('ct_taxonomy_color'.$taxonomy->term_id).'" /><br /></td>
		
	</tr>'.ct_script();
	
}

/*
	===================================================================================================================================
	*
	*		Script For ColorPicker
	*
	===================================================================================================================================	
*/

function ct_script() {
	return '<script type="text/javascript">
	jQuery.noConflict()(function($){
$("#taxonomy_clr").ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		$(el).val("#" + hex);
		$(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor( this.value);
	}
})
.bind("keyup", function(){
	$(this).ColorPickerSetColor( this.value);
});});
	</script>';
}

/*
	===================================================================================================================================
	*
	*		Save Category Color Options
	*
	===================================================================================================================================	
*/

add_action('edit_term','ct_save_color_theme_color');
add_action('create_term','ct_save_color_theme_color');
function ct_save_color_theme_color($term_id) {
    if(isset($_POST['taxonomy_clr']))
        update_option('ct_taxonomy_color'.$term_id, $_POST['taxonomy_clr']);
}


// output taxonomy image url for the given term_id (NULL by default)
function ct_get_color($term_id = NULL) {
	if (!$term_id) {
		if (is_category())
			$term_id = get_query_var('cat');
		elseif (is_tax()) {
			$current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			$term_id = $current_term->term_id;
		}
	}
    return get_option('ct_taxonomy_color'.$term_id);
}

?>