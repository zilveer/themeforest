<?php

add_action( 'wp_ajax_theme_ajax_action', 'theme_ajax_action' );
function theme_ajax_action() {
	$method = $_REQUEST['method'];
	call_user_func($method);
	die();
}

function save_option() {
	wp_parse_str( stripslashes( $_REQUEST['options'] ), $options);

	// Save
	update_option(THEME_SLUG . '_options', $options);
	
	$result = array('result' => 'ok');
	echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
}

function remove_meta() {
	$meta_tag = $_REQUEST['meta_tag'];
	$meta_index = $_REQUEST['meta_index'];
	$post_id = $_REQUEST['post_id'];
	
	$meta = get_post_meta( $post_id, $meta_tag, true);
	unset($meta[$meta_index]);
	update_post_meta($post_id, $meta_tag, $meta);
	
	// Return result
	$result = array('result' => 'ok');
	echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
}

function update_post_order() {
	
	global $wpdb;
	
	wp_parse_str($_POST['post_order'], $data);
	
	if (is_array($data))
	foreach( $data['post'] as $position => $id ) 
	{
	    $wpdb->update( $wpdb->posts, array('menu_order' => $position), array('ID' => $id) );
	}
    
    // Return result
    $result = array('result' => 'ok', 'data' => $data);
    echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
}

function get_attachment_id_by_url() {
	$url = $_REQUEST['url'];

	global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$url'";
    $id = $wpdb->get_var($query);

    if($id != null) {
    	$result = array('result' => 'ok', 'data' => $id);
    } else {
    	$result = array('result' => 'ok', 'data' => $url);
    }

    // Return result
    echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
}

function get_resized_image_by_id() {
	$id = $_REQUEST['id'];
	$width = $_REQUEST['width'];
	$height = $_REQUEST['height'];
	
	$result = array('result' => 'ok', 'data' => theme_get_image($id, $width, $height, true));
	echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
}

function generate_stack_option() {
	$stack_option = json_decode(stripslashes($_POST['option']),true);
	$stack_config = json_decode(stripslashes($_POST['config']),true);
	$stack_subgroup = json_decode(stripslashes($_POST['subgroup']),true);
	if(!is_array($stack_subgroup)){
		$stack_subgroup = array();
	}
	$stack_subgroup[] = $_POST['stack_id'];

	// modify option id, toggle, toggle_group
	$extend = '-' . $_POST['stack_id'];
	$stack_config['stack_id'] = $_POST['stack_id'];
	$stack_config['subgroup'] = $stack_subgroup;

	// generate stack option
	$input_tool = new input_tool($stack_option, $stack_config);
	$input_tool->generate_stack_option();
}