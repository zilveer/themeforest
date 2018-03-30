<?php



	$options = array(


	
	
			
array(
			"name" => "Front end editor",
			"id" 	 => "",
			"desc" => "",
			"type" => "subheading",
			"std" => ""
			
			),	
			


	array(
			"name" => "Disable the editor",
			"desc" => "Disable front end editor/admin system",
			"id" => $shortname."_disable_fee",
			"type" => "checkbox"
			),
			
	array(
			"name" => "Responsive settings",
			"id" 	 => "",
			"desc" => "Enable or disable responsive / adaptive layout for mobile devices",
			"type" => "subheading",
			"std" => ""
			
			),		
			
			
	array(
			"name" => "Tablet devices",
			"desc" => "Disable responsive layout on tablet devices (Max screen width 959px)",
			"id" => $shortname."_disable_responsive_tablet",
			"type" => "checkbox"
			),
			
	array(
			"name" => "Mobile phones",
			"desc" => "Disable responsive layout on mobile phones (Max screen width 767px)",
			"id" => $shortname."_disable_responsive_mobile",
			"type" => "checkbox"
			),
			

array(
			"name" => "Logo and favicon",
			"id" 	 => "",
			"desc" => "You can upload an image for logo. This image is not automatically resized, so you need to upload an image with correct dimensions. Max dimensions for the logo is 280px if you have enabled responsive layout for mobile platforms.",
			"type" => "subheading",
			"std" => ""
			
			),	
	



array("name" => "Site logo",
"desc" => "Upload logo as .png, .jpg or .gif",
"id" => $shortname."_logo_url",
"type" => "upload"),

array("name" => "Logo alt text ",
"desc" => "",
"id" => $shortname."_logo_alt",
"type" => "text",
"std" => ""
),

array(
			"name" => "Site favicon",
			"desc" => "Wordpress uploader does not support .ico files. If you are wanting to insert a .ico instead of a .png, upload via ftp and write the path to the file manually.",
			"id" => $shortname."_favicon",
			"type" => "upload",
			"std" => ""
			
			),	
			
array(
			"name" => "Comments",
			"id" 	 => "",
			"desc" => "",
			"type" => "subheading",
			"std" => ""
			
			),


	array(
			"name" => "Comments on blog posts",
			"desc" => "Disable comments on blog posts",
			"id" => $shortname."_disable_comments_posts",
			"type" => "checkbox"
			),
			
	array(
			"name" => "Comments on portfolio-posts",
			"desc" => "Disable comments on portfolio-posts",
			"id" => $shortname."_disable_comments_portfolio",
			"type" => "checkbox"
			),	
	
	array(
			"name" => "Comments on pages",
			"desc" => "Disable comments on pages",
			"id" => $shortname."_disable_comments_pages",
			"type" => "checkbox"
			),
			





			

			
			
			
	// Blog archives
	
	array( "name" => "Blog archives",
		   "type" => "subheading",
		   "id" 	 => "",
		   "desc" => "These settings are for category, archive, author and tag archives."
		),
		


array("name" => "Select sidebar",
"desc" => "Select which sidebar to appear on category, archive and tag-pages.",
"id" => $shortname."_sidebar_blog_pages",
"type" => "selectvalue",
"std" => "Select option:",
"options" =>  $allsidebars
),




array("name" => "Posts per page",
"desc" => "Enter the number of post you want to show per page on category, archive and tag-pages",
"id" => $shortname."_blog_perpage",
"type" => "text"
),


array("type" => "subclose", "id" => ""),		
	


// Portfolio archives

array(
			"name" => "Portfolio archives",
			"id" 	 => "",
			"desc" => "",
			"type" => "subheading",
			"std" => ""
			
			),
			
	array(
			"name" => "Posts per page",
			"desc" => "Enter the number of post you want to show per page in portfolio archives and category-pages",
			"id" => $shortname."_portfolio_perpage",
			"type" => "text_small",
			"std" => "9"
			
			),

	
	
	array(
			"name" => "Post order",
			"desc" => "Select if you want portfolio list to be ordered ascending or descending (Portfolio posts are ordered by date)",
			"id" => $shortname."_portfolio_order",
			"type" => "radiogroup",
			"std" => "DESC",
			"options" =>  array(
						'DESC' => "Descending",
						'ASC' => "Ascending"
						),
			),
			

			
		
	
	
	array(
			"name" => "Site background image",
			"id" 	 => "",
			"desc" => "You can select from a range of background textures in the front end admin system. If none of these textures suits your needs, you can upload an image here.",
			"type" => "subheading"
			
			),
			
	

	array(
			"name" => "Custom background image",
			"desc" => "Upload an image to use as background",
			"id" => $shortname."_custom_background_image",
			"type" => "upload"
			
			),

	array(
			"name" => "Background repeat",
			"desc" => "",
			"id" => $shortname."_body_background_repeat",
			"type" => "select",
			"std" => "",
			"options" =>  $epic_backgroundrepeat
			
			),

	array(
			"name" => "Background position",
			"desc" => "",
			"id" => $shortname."_body_background_position",
			"type" => "select",
			"size" => "_half",
			"std" => "center top",
			"options" =>  $epic_backgroundposition

			),
			
	
		
			
	array(
			"name" => "Misc settings",
			"id" 	 => "",
			"desc" => "",
			"type" => "subheading"
			
			),
			
	array(
			"name" => "Flickr API key",
			"desc" => "Enter your Flickr API key here. If you do not have a key, you can get one .",
			"id" => $shortname."_flickr_key",
			"type" => "text",
			"std" => ""
			
			),		


	array(
			"name" => "Contact Form E-mail",
			"desc" => "Enter an email-adress for contact form submissions.",
			"id" => $shortname."_form_mail",
			"type" => "text",
			"std" => ""
			
			),
			

	array(
			"name" => "Tracking Code",
			"desc" => "Enter javascript for tracking code. This is inserted in footer.php",
			"id" => $shortname."_analytics",
			"type" => "textarea",
			"std" => ""
			
			),

	
	


);

return apply_filters('epic_theme_global_options', $options);	





?>