<?php 
	get_header();
	$post_type = get_post_type();
	$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
	$sidebarPositionCustom = get_post_meta ( $post->ID, THEME_NAME."_sidebar_position", true ); 


	if($post_type == "gallery") {
		get_template_part(THEME_INCLUDES . 'top');
		get_template_part(THEME_INCLUDES.'gallery-single','style-1');
	} else if($post_type == "events-item"){
		get_template_part(THEME_INCLUDES . 'top');
		get_template_part(THEME_INCLUDES.'events','single');
		get_footer();
	}  else if($post_type == "reviews-item"){
		get_template_part(THEME_INCLUDES . 'top');
		get_template_part(THEME_INCLUDES.'reviews','single');
		get_footer();
	} else {
		get_template_part(THEME_INCLUDES . 'top');
		get_template_part(THEME_INCLUDES.'news','single');


		get_footer();
	}
	
	
?>