<?php
/* 
* rt-theme home page 
*/
get_header(); 
?> 

	<?php
	 
		if(is_front_page() && get_option('show_on_front')!="page"){
			$selectedTemplateID = "templateid_001";	 // Default Home Page Template
		}else{
			$selectedTemplateID = get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true);	
		}


		$sidebar=($selectedTemplateID) ? "" : $selectedTemplateID;				
	
		
		get_template_part( 'sub_page_header', 'sub_page_header_file' );	
		include_once( 'content_generator.php');	 
	?>


<?php get_footer();?>