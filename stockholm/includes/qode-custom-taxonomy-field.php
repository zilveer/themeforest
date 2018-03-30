<?php

function slides_category_taxonomy_custom_fields($tag) {  
    $t_id = $tag->term_id; // Get the ID of the term you're editing  
    $term_meta = get_option( "taxonomy_term_$t_id" );
?>  

<tr class="form-field">  
		<th scope="row" valign="top">  
				<label for="shortcode"><?php _e('Effect on header (dark/light style)', 'qode'); ?></label>  
		</th>  
		<td>
			<select name="term_meta[header_effect]" id="term_meta[header_effect]">
				<option <?php if( $term_meta['header_effect'] == 'no' ){ echo "selected='selected'"; } ?> value="no">No</option>
				<option <?php if( $term_meta['header_effect'] == 'yes' ){ echo "selected='selected'"; } ?> value="yes">Yes</option>
			</select>
		</td>  
</tr>
<tr class="form-field">
    <th scope="row" valign="top">
        <label for="shortcode"><?php _e('Parallax effect', 'qode'); ?></label>
    </th>
    <td>
        <select name="term_meta[slider_parallax_effect]" id="term_meta[slider_parallax_effect]">
            <option <?php if( isset($term_meta['slider_parallax_effect']) && $term_meta['slider_parallax_effect'] == 'yes' ){ echo "selected='selected'"; } ?> value="yes">Yes</option>
            <option <?php if( isset($term_meta['slider_parallax_effect']) && $term_meta['slider_parallax_effect'] == 'no' ){ echo "selected='selected'"; } ?> value="no">No</option>
        </select>
    </td>
</tr>
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="shortcode"><?php _e('Slider shortcode', 'qode'); ?></label>  
    </th>  
    <td>  
        <input type="text" name="term_meta[shortcode]" id="term_meta[shortcode]" size="25" style="width:60%;" value="<?php echo esc_attr($tag->slug) ? "[qode_slider slider='".$tag->slug."' auto_start='true' animation_type='slide' slide_animation='6000' height='' responsive_height='yes' background_color='' anchor='']" : ""; ?>" readonly><br />
        <span class="description"><?php _e('Use this shortcode to insert it on page', 'qode'); ?></span>  
    </td>  
</tr> 
  
<?php  
}  

function save_taxonomy_custom_fields( $term_id ) {  
    if ( isset( $_POST['term_meta'] ) ) {  
        $t_id = $term_id;  
        $term_meta = get_option( "taxonomy_term_$t_id" );  
        $cat_keys = array_keys( $_POST['term_meta'] );  
            foreach ( $cat_keys as $key ){  
            if ( isset( $_POST['term_meta'][$key] ) ){  
                $term_meta[$key] = $_POST['term_meta'][$key];  
            }  
        }  
        update_option( "taxonomy_term_$t_id", $term_meta );  
    }  
}

add_action( 'slides_category_edit_form_fields', 'slides_category_taxonomy_custom_fields', 10, 2 );    
add_action( 'edited_slides_category', 'save_taxonomy_custom_fields', 10, 2 );



add_filter("manage_edit-slides_category_columns", 'theme_columns'); 
function theme_columns($theme_columns) {
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'name' => __('Name', 'qode'),
        'shortcode' => __('Shortcode', 'qode'),
				//'description' => __('Description', 'qode'),
        'slug' => __('Slug', 'qode'),
        'posts' => __('Posts', 'qode')
        );
    return $new_columns;
}

add_filter("manage_slides_category_custom_column", 'manage_theme_columns', 10, 3);
function manage_theme_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'slides_category');
		switch ($column_name) {
        case 'shortcode':
            $data = maybe_unserialize($theme->description);
            $out .= "[qode_slider slider='".$theme->slug."' auto_start='true' animation_type='slide' slide_animation='6000' height='' responsive_height='yes' background_color='' anchor='' show_navigation='yes' show_control='yes']";
            break;
 
        default:
            break;
    }
    return $out;   
}

?>