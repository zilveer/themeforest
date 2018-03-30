<?php

//
// New Post Type
//


add_action('init', 'client_register');  

function client_register() {
    $args = array(
        'label' => __('Clients', 'spacing_backend'),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => true,
        'supports' => array('title', 'thumbnail')
       );  

    register_post_type( 'clients' , $args );
}


//
// Thumbnail column
//

add_filter( 'manage_edit-clients_columns', 'clients_columns_settings' ) ;

function clients_columns_settings( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __('Title', 'spacing_backend'),
		'date' => __('Date', 'spacing_backend'),
		'clients-thumbnail' => __('Client Logo', 'spacing_backend')	
	);

	return $columns;
}

add_action( 'manage_clients_posts_custom_column', 'clients_columns_content', 10, 2 );

function clients_columns_content( $column, $post_id ) {
	global $post;
	the_post_thumbnail('clients-thumbnail', array('class' => 'slider-column-img'));
}


//
// client Title and Caption
//

add_action("admin_init", "client_title_settings");   

function client_title_settings(){
    add_meta_box("client_title_settings", "Client", "client_title_config", "clients", "normal", "high");
}   

function client_title_config(){
        global $post;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
		$client_url = $custom["client_url"][0];

?>
    <table class="form-table custom-table">
        <tr>
        	<td class="title-column">URL:<br /><span class="custom-subtitle">(i.e. Portfolio Post URL)</span></td>
            <td class="description-textarea">
            	<input type="text" name="client_url" value="<?php echo $client_url; ?>" />
            </td>
        </tr>  
    </table>
<?php
    }	
	

	
// Save Slide
	
add_action('save_post', 'save_client_meta'); 

function save_client_meta(){
    global $post;  	
	
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	}else{
		update_post_meta($post->ID, "client_url", $_POST["client_url"]);
    }

}

//
// Move Featured Image metabox to the main column
//

add_action('do_meta_boxes', 'client_image_box');

function client_image_box() {
	remove_meta_box( 'postimagediv', 'clients', 'side' );
	add_meta_box('postimagediv', __('Client Logo', 'spacing_backend'), 'post_thumbnail_meta_box', 'clients', 'normal', 'high');
}