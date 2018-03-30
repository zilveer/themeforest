<?php 
	get_header();
	$post_type = get_post_type();


	if($post_type == "portfolio-item") {
		get_template_part(THEME_INCLUDES . 'top');
		get_template_part(THEME_INCLUDES.'portfolio-single');
	} else {
		get_template_part(THEME_INCLUDES . 'top');
		get_template_part(THEME_INCLUDES.'news','single');

		get_footer();
	}
	
	
?>