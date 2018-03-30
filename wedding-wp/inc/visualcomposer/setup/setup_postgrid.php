<?php


if ( class_exists( 'WPBakeryVisualComposerAbstract' ,true) ) {
	
	if(!function_exists('webnus_setup_vc_posts_grid')){
		
		function webnus_setup_vc_posts_grid(){
			
			
			vc_remove_param('vc_posts_grid', 'grid_layout');
			
			$vc_layout_sub_controls = array(
				array('link_post', __("Link to post", "js_composer")),
				array("no_link", __("No link", "js_composer")),
				array("link_image", __("Link to bigger image", "js_composer"))
			);			
			
			
			$attributes = array(
									"type" => "sorted_list",
									"heading" => __("Teaser layout", "js_composer"),
									"param_name" => "grid_layout",
									"description" => __("Control teasers look. Enable blocks and place them in desired order. Note: This setting can be overrriden on post to post basis.", "js_composer"),
									"value" => "title,image,text",
									"options" => array(
										array('image', __('Thumbnail', "js_composer"), $vc_layout_sub_controls),
										array( 'title', __('Title', "js_composer"), $vc_layout_sub_controls),
										array('text', __('Text', "js_composer"), array(
											array('excerpt', __('Teaser/Excerpt', "js_composer")),
											array('text', __('Full content', "js_composer"))
										)),
										//array('link', __('Read more link', "js_composer")),
										array('meta_author', __('Metadata Author', "js_composer")),
										array('meta_category', __('Metadata Category', "js_composer")),
										array('meta_date', __('Metadata Date', "js_composer")),
										array('meta_comments', __('Metadata Comments', "js_composer"))

									)
								);
		
			vc_add_param('vc_posts_grid',$attributes);
			
		
			
						
		}// END OF FUNCTION
		
	}
	
	add_action('admin_init', 'webnus_setup_vc_posts_grid');
	
} // End of if statement


?>