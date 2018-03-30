<?php



$options = array(


	
array( "name" => "Blog ",
		"type" => "section",
		"desc" => "Settings for single posts, blog page, archive, category, tags etc.",
		"id" 	 => ""
		),
array( 	"type" => "open",
		"id" 	 => ""

),






array( 
			"type" => "close",
			"id" 	 => ""

			),

);

return apply_filters('epic_theme_blog_options', $options);	



?>