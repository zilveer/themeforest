<?php function ocmx_ajax_remove_image(){
	wp_delete_attachment( $_GET["attachid"]);
	die("");
}
?>