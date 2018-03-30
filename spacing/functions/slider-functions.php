<?php

//
// New Post Type
//


add_action('init', 'slider_register');  

function slider_register() {
    $args = array(
        'label' => __('Slider', 'spacing_backend'),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => true,
        'supports' => array('title', 'thumbnail')
       );  

    register_post_type( 'slider' , $args );
}


//
// Thumbnail column
//

add_filter( 'manage_edit-slider_columns', 'slider_columns_settings' ) ;

function slider_columns_settings( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __('Title', 'spacing_backend'),
		'date' => __('Date', 'spacing_backend'),
		'slider-thumbnail' => ''	
	);

	return $columns;
}

add_action( 'manage_slider_posts_custom_column', 'slider_columns_content', 10, 2 );

function slider_columns_content( $column, $post_id ) {
	global $post;
	the_post_thumbnail('slider-thumbnail', array('class' => 'slider-column-img'));
}

//
// Disable Permalink Area
//

function my_remove_meta_boxes() {
    remove_meta_box('slugdiv', 'slider', 'core');
	remove_meta_box('slugdiv', 'testimonials', 'core');
}
add_action( 'admin_menu', 'my_remove_meta_boxes' );

// Load the css file is Slider post type

function slider_custom_css() {
	$dir = get_stylesheet_directory_uri();
	global $post_type;
	if (($post_type == 'slider' || $post_type == 'testimonials')) :
		echo "<link type='text/css' rel='stylesheet' href='" . $dir . "/admin/assets/css/hide-permalink.css' />";
	endif;
}
add_action('admin_head', 'slider_custom_css');

//
// Slide Title and Caption
//

add_action("admin_init", "slide_title_settings");   

function slide_title_settings(){
    add_meta_box("slide_title_settings", "Slide Title and Caption", "slide_title_config", "slider", "normal", "high");
}   

function slide_title_config(){
        global $post;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
		$slide_caption = $custom["slide_caption"][0];
		$slide_link = $custom["slide_link"][0];

?>
    <table class="form-table custom-table">
        <tr>
        	<td class="title-column">Slide Caption:<br /><span class="custom-subtitle">(Supports HTML)</span></td>
            <td class="description-textarea">
            	<textarea name="slide_caption" rows="5" /><?php echo $slide_caption; ?></textarea>
            </td>
        </tr>  
        <tr>
        	<td class="title-column">Slide Link:<br /><span class="custom-subtitle">(Leave blank to disable)</span></td>
            <td class="description-textarea">
            	<input type="text" name="slide_link" value="<?php echo $slide_link; ?>" />
            </td>
        </tr>      
    </table>
<?php
    }	
	
	
// Save Slide
	
add_action('save_post', 'save_slider_meta'); 

function save_slider_meta(){
    global $post;  
	
	$slug = 'slider';
	
	$_POST += array("{$slug}_edit_nonce" => '');
    if ( $slug != $_POST['post_type'] ) {
        return;
    }
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	}else{
		update_post_meta($post->ID, "slide_caption", $_POST["slide_caption"]);
		update_post_meta($post->ID, "slide_link", $_POST["slide_link"]);
    }

}


//
// Move Featured Image metabox to the main column
//

add_action('do_meta_boxes', 'slider_image_box');

function slider_image_box() {
	remove_meta_box( 'postimagediv', 'slider', 'side' );
	add_meta_box('postimagediv', 'Slide Image', 'post_thumbnail_meta_box', 'slider', 'normal', 'high');
}