<?php
    get_header();
    tfuse_category_on_front_page();
    
	global $is_tf_front_page;
	if(!$is_tf_front_page) include_once('archive.php');

    get_footer();
?>