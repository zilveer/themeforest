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
					"description"	=> __('Portfolio options. A Portfolio item can have more then one image attached to it. Default the attached images will be shown in a slider. It can be changed to type gallery in which case a image gallery is shown.','rt_theme_admin'),					
					"type"			=> "info_text_only",
					"hr"			=> "true",
				), 

				array(
					"title" 			=> __("Portfolio Format",'rt_theme_admin'),  
					"description"	=> __('The Portfolio Format Option : The Portfolio item can be set to the type : <br /></br />1) <strong>Image</strong> : Display Image(s) as gallery or slider,<br />2) <strong>Video</strong> : Show and Play a Video,<br />3) <strong>Audio</strong> : Show and Play a Audio file.<br /><br /><strong>Note : </strong>A placeholder image can be attached for the video and audio item.','rt_theme_admin'),				
					"name"			=> "_portfolio_post_format",
					"options" 		=>  array(
										"image" 		=> "Image",
										"video" 		=> "Video",
										"audio" 		=> "Audio" 
									 ),
					"type" 			=> "radio" 
				), 


  				array(
					"name"				=> "_image_format_options",
					"type"				=> "group_start"
				),


					array(
						"title"			 => __("IMAGE FORMAT OPTIONS",'rt_theme_admin'), 
						"type"			 => "heading"
					),

 					
					array(
						"title"			=> __("Usage of Image Gallery",'rt_theme_admin'), 
						"description"	=> __('The "Usage of Image Gallery" option can be set to alter the behaviour of the Gallery in the Single Portfolio Item. <strong>There are two choices:</strong><br /><br />1) <strong>Display Gallery as Slideshow</strong> <br />2) <strong>Display Gallery as Photo-Gallery</strong><br /><br /><strong>Note</strong> : In order to have the slider or gallery function to work there needs to be more then one (1) image attached to the "Image Gallery Box".','rt_theme_admin'),
						"name"			=> "_featured_image_usage",
						"options"		=>  array(
											"slider"  => "Display the Gallery Images as a Slideshow", 
											"gallery"  => "Display the Gallery Images as a Photo Gallery"
										),
						"hr"			=> true,
						"type"			=> "select", 
					),

					array(
						"title" 		=> __("Display Captions",'rt_theme_admin'),
						"name"			=> "image_names",
						"description" 	=> __('Check to display image captions. You can change image captions via Media -> Library.','rt_theme_admin'),
						"default" 		=> "",
						"type" 			=> "checkbox2"
					),

					array(
						"title" 		=> __("Crop Images",'rt_theme_admin'),
						"name"			=> "image_crop",
						"description" 	=> __('Check to crop the images. If this option checked, Images will automatically cropped in the slideshow or the gallery to be displaying at the same height.','rt_theme_admin'),
						"default" 		=> "",
						"hr"			=> true,
						"type" 			=> "checkbox2"
					),					


					array(
						"title" 		=> __("Maximum Image Height (For Cropping)",'rt_theme_admin'),
						"description"	=> __('<strong>Maximum Image Height (px)</strong> : Set the maximum height in pixels for the portfolio images inside the gallery or slideshow. You can drag the horizontal (scroll) bar to the left or right to decrease or increase the height value or you can directly input the height value into the text field.<br /><br /><strong>Note</strong> : The &#39;Crop Images&#39; option must be enabled to use this option.','rt_theme_admin'),
						"name" 			=> "portfolio_max_image_height",
						"min"			=>"60",
						"max"			=>"800",
						"default"		=>"400",
						"type" 			=> "rangeinput"
					),


				array(
					"type"				=> "group_end"
				),


  				array(
					"name"				=> "_video_format_options",
					"type"				=> "group_start"
				),

					array(
						"title"			 => __("VIDEO FORMAT OPTIONS",'rt_theme_admin'), 
						"type"			 => "heading"
					),
	
					array(
						"description"		=> __("Attach a image to the <strong>Image Gallery </strong> box to act as a placeholder / poster image for this video item. Attach only ONE image.",'rt_theme_admin'),											
						"type"			=> "info_text_only",
						"hr"			=> "true",
					),

					array(
						"name"			=> "_portfolio_video_m4v",
						"title"			=> __("MP4 File URL",'rt_theme_admin'), 
						"description"	=> __("MP4 File URL : Supply a correct full URL to the mp4 video file. Example : http://yourwebsite.com/uploads/video/the-video-file.mp4",'rt_theme_admin'),											
						"type"			=> "upload", 
					),

					array(
						"name"			=> "_portfolio_video_webm",
						"title"			=> __("WEBM File URL",'rt_theme_admin'),
						"description"	=> __("WEBM File URL : Supply a correct full URL to the WEBM video file. Example : http://yourwebsite.com/uploads/video/the-video-file.webm<br /><br /><strong>Note :</strong>The WEBM file will act as a fallback video when the mp4 format is not supported, which can happen in some browsers. The file must be uploaded and located in the same folder with the same name as the mp4 file but with its own file extention (.webm).",'rt_theme_admin'),											
						"type"			=> "upload", 
					),

					array(
						"title"			 => __("OR",'rt_theme_admin'), 
						"type"			 => "heading"
					),

					array(
						"name"			=> "_portfolio_video",
						"title"			=> __("External Video URL | YouTube or Vimeo",'rt_theme_admin'),
						"description"	=> __("External Video URL | YouTube or Vimeo : Supply a correct full URL to the video file. Example : <br /><br />For <strong>Youtube</strong> use : http://www.youtube.com/watch?v=odBffheAoyc<br />For <strong>Vimeo</strong> use :  http://vimeo.com/50125675<br /><br /><strong>Note : </strong>Supply only the URL and do NOT include the embed code as these will be added automatically by the theme itself.",'rt_theme_admin'),																	
						"type"			=> "text", 
					),
	


  				array(
					"type"			 => "group_end"
				),

				array(
					"name"			=> "_audio_format_options",
					"type"			 => "group_start"
				),


					array(
						"title"			 => __("AUDIO FORMAT OPTIONS",'rt_theme_admin'), 
						"type"			 => "heading"
					),

	
					array(
						"description"		=> __("Attach a image to the <strong>Image Gallery </strong> box to act as a placeholder / poster image for this audio item. Attach only ONE image.",'rt_theme_admin'),					
						"type"			 => "info_text_only", 
					),
	
					array(
						"name"			=> "_portfolio_audio_mp3",
						"title"			=> __("MP3 File URL",'rt_theme_admin'),
						"description"		=> __("MP3 File URL : Supply a correct full URL to the mp3 audio file. Example : http://yourwebsite.com/uploads/mp3/the-mp3-audio-file.mp3",'rt_theme_admin'),					
						"type"			=> "upload", 
					),

					array(
						"name"			=> "_portfolio_audio_oga",
						"title"			=> __("OGG File URL ",'rt_theme_admin'),
						"description"		=> __("OGG File URL : Supply a correct full URL to the OGG audio file. Example : http://yourwebsite.com/uploads/ogg/the-ogg-audio-file.ogg",'rt_theme_admin'),											
						"type"			=> "upload", 
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
					"title"			=> __("Short Description",'rt_theme_admin'),
					"description"	=> "Enter a 'Short Description' for this portfolio item. The 'Short Description' will only be visible in the Portfolio Listing Pages and will replace the default excerpt which the theme creates about the portfolio post when no 'Short Description' has been supplied. This way you can control the content in the Portfolio Listing Pages and create you own so called 'Teasers'.", 
					"type"			=> "textarea"
				),

				array(
					"name"			=> "_portfolio_thumb_image",
					"title"			=> __("Alternate thumbnail image",'rt_theme_admin'),
					"description"	=> __(" A different thumbnail image can be set if you want to use another image as a thumbnail in the Portfolio Listing Page(s) for this Portfolio item.",'rt_theme_admin'), 
					"type"			=> "upload", 
					"hr"			=> "true"
				),

				array(
					"name"			=> "_portf_no_detail",
					"title"			=> __("Remove link(s) to Post Details",'rt_theme_admin'),
					"description"	=> __("Check this option to <strong>DISABLE</strong> the linking to the Single Portfolio Item in the Portfolio Listing Pages.",'rt_theme_admin'),
					"type"			=> "checkbox2",
				),

				array(
					"name"			=> "_disable_lightbox",
					"title"			=> __("Disable Lightbox in Listing Pages",'rt_theme_admin'),
					"description"	=> __("Check this option to 'DISABLE' the lightbox popup featured for the attached image in Portfolio Listing Pages and link the image directly to the Single Portfolio Page. <br /><br /><strong>Note : </strong>Make sure that 'Remove link(s) to Post Details' option is <strong>not enabled</strong> as that will block the working of this 'Disable Lightbox in Listing Pages' setting.",'rt_theme_admin'),
					"type"			=> "checkbox2",
					"hr"			=> "true"
				),

				array(
					"name"			=> "_external_link",
					"title"			=> __("External Link",'rt_theme_admin'),
					"description"	=> __("Set a (external) link in order to link the thumbnail image to that URL in the Portfolio Listing Pages.",'rt_theme_admin'),
					"hr"			=> "true",
					"type"			=> "text"
				),

				array(
					"name"			=> "_open_in_new_tab",
					"title"			=> __("Open External Link in a New Tab",'rt_theme_admin'),
					"description"	=> __("If this option is set, the (external) link (URL) as set in the previous option will open in a new browser tab.",'rt_theme_admin'),
					"type"			=> "checkbox2" 
				),


  				array(
					"title"			 => __("PROJECT NOTES",'rt_theme_admin'), 
					"type"			 => "heading"
				),
				
				array(
					"description"	=> __('Project Notes are shown in the single portfolio item in a on the right side located Project Information Box.','rt_theme_admin'),					
					"type"			=> "info_text_only",
					"hr"			=> "true",
				),				

				array(
					"name"			=> "_project_info_title",
					"title"			=> __("Project Info Box Title",'rt_theme_admin'),
					"description"	=> __('Project Info Box Title : Enter in here a title to show above the "Project Details" in the Project Information Box.','rt_theme_admin'),										
					"type"			=> "text",
					"defatult"		=> __("Project Notes",'rt_theme_admin'),
					"hr"				=> "true",
				),

				array(
					"name"			=> "_project_info",
					"title"			=> __("Project Details",'rt_theme_admin'),
					"description"	=> __("Project Details : Enter in here the extra information you want to display in the Project Information Box about this project. Any valid HTML is allowed.",'rt_theme_admin'),
					"type"			=> "textarea",
					"richeditor"		=> "true"
				) 


);

$settings  = array( 
	"name"		=> RT_THEMENAME ." Portfolio Options",
	"scope"		=> "portfolio",
	"slug"		=> "portfolio_cutom_fields",
	"capability"	=> "edit_post",
	"context"		=> "normal",
	"priority"	=> "high" 
);