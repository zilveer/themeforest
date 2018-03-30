<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Content Composer Template Operator
 * Created by CMSMasters
 * 
 */


require('../../../../../../../wp-load.php');


global $posts;


if (isset($_POST['type']) && $_POST['type'] == 'add') {
	$name = $_POST['name'];
	$content = stripslashes($_POST['content']);
	
	
	$ins_post_ID = wp_insert_post(array( 
		'post_title' => $name, 
		'post_name' => generateSlug($name, 30), 
		'post_content' => $content, 
		'post_status' => 'draft', 
		'post_type' => 'content_template' 
	));
	
	
	echo '<option value="cmsms_template_' . $ins_post_ID . '">' . $name . '</option>';
} else if (isset($_POST['type']) && $_POST['type'] == 'load') {
	$id = $_POST['id'];
	
	
	$template = get_post($id);
	
	
	echo $template->post_content;
} else if (isset($_POST['type']) && $_POST['type'] == 'del') {
	$id = $_POST['id'];
	
	
	$template = wp_delete_post($id, true);
	
	
	echo $template->ID;
}

