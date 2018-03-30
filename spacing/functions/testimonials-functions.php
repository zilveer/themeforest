<?php

//
// New Post Type
//


add_action('init', 'testimonial_register');  

function testimonial_register() {
    $args = array(
        'label' => __('Testimonials', 'spacing_backend'),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => true,
        'supports' => array('title')
       );  

    register_post_type( 'testimonials' , $args );
}


//
// Thumbnail column
//

add_filter( 'manage_edit-testimonial_columns', 'testimonial_columns_settings' ) ;

function testimonial_columns_settings( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __('Title', 'spacing_backend'),
		'date' => __('Date', 'spacing_backend'),
		'slider-thumbnail' => ''	
	);

	return $columns;
}

add_action( 'manage_testimonial_posts_custom_column', 'testimonial_columns_content', 10, 2 );

function testimonial_columns_content( $column, $post_id ) {
	global $post;
	the_post_thumbnail('slider-thumbnail', array('class' => 'slider-column-img'));
}

//
// Testimonial Title and Caption
//

add_action("admin_init", "testimonial_title_settings");   

function testimonial_title_settings(){
    add_meta_box("testimonial_title_settings", "Testimonial", "testimonial_title_config", "testimonials", "normal", "high");
}   

function testimonial_title_config(){
        global $post;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
		$testimonial_content = $custom["testimonial_content"][0];
		$testimonial_author = $custom["testimonial_author"][0];
		$company_name = $custom["company_name"][0];
		$company_url = $custom["company_url"][0];

?>
    <table class="form-table custom-table">
        <tr>
        	<td class="title-column">Content:<br /><span class="custom-subtitle">(Supports HTML)</span></td>
            <td class="description-textarea">
            	<textarea name="testimonial_content" rows="5" /><?php echo $testimonial_content; ?></textarea>
            </td>
        </tr>  
        <tr>
        	<td class="title-column">Author:</td>
            <td class="description-textarea">
            	<input type="text" name="testimonial_author" value="<?php echo $testimonial_author; ?>" />
            </td>
        </tr>  
        <tr>
        	<td class="title-column">Company Name:<br /><span class="custom-subtitle">(Leave blank to disable)</span></td>
            <td class="description-textarea">
            	<input type="text" name="company_name" value="<?php echo $company_name; ?>" />
            </td>
        </tr> 
        <tr>
        	<td class="title-column">Company URL:</td>
            <td class="description-textarea">
            	<input type="text" name="company_url" value="<?php echo $company_url; ?>" />
            </td>
        </tr>     
    </table>
<?php
    }	
	
	
// Save Slide
	
add_action('save_post', 'save_testimonial_meta'); 

function save_testimonial_meta(){
    global $post;  	
	
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	}else{
		update_post_meta($post->ID, "testimonial_content", $_POST["testimonial_content"]);
		update_post_meta($post->ID, "testimonial_author", $_POST["testimonial_author"]);
		update_post_meta($post->ID, "company_name", $_POST["company_name"]);
		update_post_meta($post->ID, "company_url", $_POST["company_url"]);
    }

}