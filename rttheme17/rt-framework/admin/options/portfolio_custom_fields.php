<?php
#-----------------------------------------
#	RT-Theme portfolio_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Portfolio Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/

$customFields = array(




				array(
					"title" 			=> __("Portfolio Format",'rt_theme_admin'),  
					"name"			=> "_portfolio_post_format",
					"options" 		=>  array(
										"image" 		=> "Image",
										"video" 		=> "Video",
										"audio" 		=> "Audio" 
									 ),
					"type" 			=> "radio" 
				), 


	

  				array(
					"name"			=> "_image_format_options",
					"type"			 => "group_start"
				),


					array(
						"title"			 => __("IMAGE FORMAT OPTIOINS",'rt_theme_admin'), 
						"type"			 => "heading"
					),

					array(
						"title" 			=> __("Usage of Featured Images",'rt_theme_admin'), 
						"description"		=> __("You can upload unlimited images for each portfolio item by using <strong>\"".THEMENAME." Featured Images\"</strong> and decide how show to display them in single portfolio pages.",'rt_theme_admin'),
						"name"			=> "_featured_image_usage",
						"options" 		=>  array(
											"slider" 		=> "Display the featured images as a slide show", 
											"gallery" 	=> "Display the featured images as a photo gallery"
										 ),
						"type" 			=> "select",				
						"hr"				=> "true"
					),

  				array(
					"type"			 => "group_end"
				),


  				array(
					"name"			=> "_video_format_options",
					"type"			 => "group_start"
				),

					array(
						"title"			 => __("VIDEO FORMAT OPTIOINS",'rt_theme_admin'), 
						"type"			 => "heading"
					),
	
					array(
						"description"		=> __("Use \"".THEMENAME." Featured Images\" to upload a poster image for this video",'rt_theme_admin'),					
						"type"			 => "info_text_only",
						"hr"				=> "true",
					),

					array(
						"name"			=> "_portfolio_video_m4v",
						"title"			=> __("M4V File URL",'rt_theme_admin'), 				
						"type"			=> "text",
						"hr"				=> "true",
					),

					array(
						"name"			=> "_portfolio_video_ogv",
						"title"			=> __("OGV File URL",'rt_theme_admin'), 			
						"type"			=> "text", 
					),

					array(
						"title"			 => __("OR",'rt_theme_admin'), 
						"type"			 => "heading"
					),

					array(
						"name"			=> "_portfolio_video",
						"title"			=> __("External Video URL | YouTube or Vimeo",'rt_theme_admin'),
						"description"		=> __("Paste the url of a video from vimeo or youtube. Embed code will be generated automatically.",'rt_theme_admin'),					
						"type"			=> "text",
						"hr"				=> "true",
					),
	


  				array(
					"type"			 => "group_end"
				),




				array(
					"name"			=> "_audio_format_options",
					"type"			 => "group_start"
				),

					array(
						"title"			 => __("AUDIO FORMAT OPTIOINS",'rt_theme_admin'), 
						"type"			 => "heading"
					),

	
					array(
						"description"		=> __("Use \"".THEMENAME." Featured Images\" to upload a poster image for this audio",'rt_theme_admin'),					
						"type"			 => "info_text_only",
						"hr"				=> "true",
					),
	
					array(
						"name"			=> "_portfolio_audio_mp3",
						"title"			=> __("MP3 File URL",'rt_theme_admin'), 			
						"type"			=> "text",
						"hr"				=> "true",
					),

					array(
						"name"			=> "_portfolio_audio_oga",
						"title"			=> __("OGA/OGG File URL ",'rt_theme_admin'),
						"type"			=> "text", 
					), 

  				array(
					"type"			 => "group_end"
				),


  				array(
					"title"			 => __("MISCELLANEOUS OPTIONS",'rt_theme_admin'), 
					"type"			 => "heading"
				),

				array(
					"name"			=> "_portfolio_desc",
					"title"			=> __("Short description",'rt_theme_admin'),
					"description"		=> "",
					"hr"				=> "true",
					"type"			=> "textarea"
				),

				array(
					"name"			=> "_portfolio_thumb_image",
					"title"			=> __("Alternate thumbnail image for the portfolio item",'rt_theme_admin'),
					"description"		=> __("If you want to use another image file for the thumbnails, you can use this field.",'rt_theme_admin'),
					"hr"				=> "true",
					"type"			=> "upload"
				),

				array(
					"name"			=> "_portf_no_detail",
					"title"			=> __("Remove links to post details",'rt_theme_admin'),
					"description"		=> __("You can remove the links to the detail page if you would like to use this item only in listing pages.",'rt_theme_admin'),
					"type"			=> "checkbox",
					"hr"				=> "true"
				),

				array(
					"name"			=> "_disable_lightbox",
					"title"			=> __("Disable lightbox in listing pages",'rt_theme_admin'),
					"description"		=> __("You can disable the lightbox for the media in portfolio listing pages and link it to the post detail page. Make sure that 'Remove links to post details' option is not active.",'rt_theme_admin'),
					"type"			=> "checkbox",
					"hr"				=> "true"
				),

				array(
					"name"			=> "_external_link",
					"title"			=> __("External Link",'rt_theme_admin'),
					"description"		=> __("If you would like to set an external link to the thumbnail image in the listing pages, you can use this field.",'rt_theme_admin'),
					"hr"				=> "true",
					"type"			=> "text"
				),

				array(
					"name"			=> "_open_in_new_tab",
					"title"			=> __("Open External Link in a New Tab",'rt_theme_admin'),
					"description"		=> __("If this option is ON, the external link will be opened in a new tab.",'rt_theme_admin'),
					"type"			=> "checkbox" 
				),


  				array(
					"title"			 => __("PROJECT NOTES",'rt_theme_admin'), 
					"type"			 => "heading"
				),

				array(
					"name"			=> "_project_info_title",
					"title"			=> __("Project Info Box Title",'rt_theme_admin'), 				
					"type"			=> "text",
					"defatult"		=> __("Project Notes",'rt_theme_admin'),
					"hr"				=> "true",
				),

				array(
					"name"			=> "_project_info",
					"title"			=> __("Key details about this project",'rt_theme_admin'),
					"description"		=> "",
					"type"			=> "textarea",
					"richeditor"		=> "true"
				) 


);

$settings  = array( 
	"name"		=> THEMENAME ." Portfolio Options",
	"scope"		=> "portfolio",
	"slug"		=> "portfolio_cutom_fields",
	"capability"	=> "edit_post",
	"context"		=> "normal",
	"priority"	=> "high" 
);