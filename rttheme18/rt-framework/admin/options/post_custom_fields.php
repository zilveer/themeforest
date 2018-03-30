<?php
#-----------------------------------------
#	RT-Theme post_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Post Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/
 
$customFields = array(
				array(
					"title" 		=> __("Post Format",'rt_theme_admin'),  
					"description"	=> __('The Post Format Option : The Post item can be set to 6 different types : <br /></br />1) <strong>Standard</strong> : The attached featured image is shown,<br />2) <strong>Gallery</strong> : Display Image(s) as gallery or slider,<br /> 3) <strong>Link</strong> : Tell something about a subject of choice and add a (outside) link to the post,<br /> 4) <strong>Video</strong> : Show and Play a Video,<br />5) <strong>Audio</strong> : Show and Play a Audio file,<br />6) <strong>Aside</strong> : The Post item is listed in the blog list but cannot be opened in a single post.<br /><br /><strong>Note : </strong>A image can be attached for replacing the video and audio item in the Blog / Category Listing Pages.','rt_theme_admin'),									
					"name"			=> "_post_format",
					"clean_name"	=> "post_format",
					"options" 		=>  array(
											""        => "Standard",
											"gallery" => "Gallery",
											"link"    => "Link",
											"video"   => "Video", 
											"audio"   => "Audio",
											"aside"   => "Aside"  
									 ),

					"ids" 		=>  array(
										"post-format-0",
										"post-format-gallery",										
										"post-format-link",
										"post-format-video", 
										"post-format-audio", 
										"post-format-aside"
									 ),
					
					"type" 			=> "radio",
					"default"		=> ""
				), 
);

$settings  = array( 
	"name"		=> "Post Formats",
	"scope"		=> array('post'),
	"slug"		=> "post-formats-select",
	"capability"	=> "edit_page",
	"context"		=> "normal",
	"priority"	=> "high" 
);

$rt_post_custom_fields = new rt_meta_boxes($settings,$customFields);

 

$customFields = array(

	array(
		"description"	=> __("Note: Upload a Featured Image to use it as a placeholder/poster image for the video.",'rt_theme_admin'),					
		"type"			=> "info_text_only",
		"hr"			=> "true",
	),

	array(
		"name"			=> "_post_video_m4v",
		"title"			=> __("MP4 File URL",'rt_theme_admin'), 	
		"description"	=> __("Upload a mp4 video-file. For example: http://sample_url/sample_folder/sample.mp4",'rt_theme_admin'),							
		"type"			=> "upload", 
	),

	array(
		"name"			=> "_post_video_webm",
		"title"			=> __("WEBM File URL",'rt_theme_admin'),
		"description"	=> __("Upload a WEBM video-file as a fallback video when the mp4 video is not supported (some browsers can not display mp4). Note: <br /><br /><strong>1) The WEBM video file must be in the same folder as the MP4 video file</strong><br /><strong>2) The two video files MUST have the same name each with its own correct file extension.</strong><br /><strong>3) One cannot use a WEBM only. The mp4 is always needed.</strong><br /> <br />For example: <br /> http://sample_url/sample_folder/sample.mp4<br />http://sample-url/sample_folder/sample.webm ",'rt_theme_admin'),					
		"type"			=> "upload", 
	),

	array(
		"title"			 => __("OR USE A YOUTUBE OR VIMEO VIDEO",'rt_theme_admin'), 
		"type"			 => "heading"
	),

	array(
		"title" 		=> __("Video URL | YouTube or Vimeo",'rt_theme_admin'), 
		"name"			=> "video_url",
		"description" 	=> __("Provide and paste a correct url to the video at vimeo or youtube. <strong>Do not include the embed code as the theme will generate the embed code automatically.</strong>",'rt_theme_admin'),
		"type" 			=> "text"
	),

	array(
		"title"			 => __("BEHAVIOUR OF THE VIDEO IN LISTING PAGES",'rt_theme_admin'), 
		"type"			 => "heading"
	),

	array(
		"title"       => __("Usage of the Video in Listing Pages",'rt_theme_admin'), 
		"name"        => "_video_usage_listing",
		"description" => __('With the "Usage of the Video in Listing Pages" option one can set and alter the usage of the Video-file in the Blog Listing Page only. <strong>Available choices are :</strong><br /><br />1) <strong>Display the Video</strong> (the Blog Listing Page will show the Video-file),<br />2) <strong>Display the Featured Image</strong> (the Blog Listing Page will show the to the post attached Featured Image)<br />3) <strong>Do not display anything</strong> (the Blog Listing Page will not show any image or video-file).','rt_theme_admin'),						
		"options"     => array(							
							"same"                => "Display the Video", 							
							"only_featured_image" => "Display the Featured Image",
							"no_video"            => "Don't display anything", 
						 ),
		"type" 		 => "select"	
	),

	
 
);

$settings  = array( 
	"name"		=> __("Video Post Format Options",'rt_theme_admin'),
	"scope"		=> array('post'),
	"slug"		=> "rt_video_post_custom_fields",
	"capability"	=> "edit_page",
	"context"		=> "normal",
	"priority"	=> "high" 
);

$rt_post_custom_fields = new rt_meta_boxes($settings,$customFields);



$customFields = array(

	
	array(
		"description"	=> __("Upload a Featured Image to use it as a placeholder/poster image for the audio file.",'rt_theme_admin'),					
		"type"			=> "info_text_only",
		"hr"			=> "true",
	), 

	array(
		"name"			=> "_post_audio_mp3",
		"title"			=> __("MP3 File URL",'rt_theme_admin'), 	
		"description"	=> __("Upload a mp3 audio file. For example: http://sample_url/sample_folder/sample.mp3",'rt_theme_admin'),									
		"type"			=> "upload", 
	),

	array(
		"name"			=> "_post_audio_oga",
		"title"			=> __("OGG File URL ",'rt_theme_admin'),
		"description"	=> __("Upload a OGG audio file. For example: http://sample_url/sample_folder/sample.ogg",'rt_theme_admin'),											
		"type"			=> "upload", 
	),


	array(
		"title"			 => __("BEHAVIOUR OF THE AUDIO FILE IN LISTING PAGES",'rt_theme_admin'), 
		"type"			 => "heading"
	),

	array(
		"title"       => __("Usage of the Audio in Listing Pages",'rt_theme_admin'), 
		"name"        => "_audio_usage_listing",
		"description" => __('With the "Usage of the Audio in Listing Pages" option one can set and alter the usage of the Audio-file in the Blog Listing Page only. <strong>Available choices are :</strong><br /><br />1) <strong>Display the Audio</strong> (the Blog Listing Page will show the Audio-file),<br />2) <strong>Display the Featured Image</strong> (the Blog Listing Page will show the to the post attached Featured Image)<br />3) <strong>Do not display anything</strong> (the Blog Listing Page will not show any image or audio-file).','rt_theme_admin'),				
		"options"     => array(							
							"same"                => "Display the Audio", 							
							"only_featured_image" => "Display the Featured Image",
							"no_video"            => "Don't display anything", 
						 ),
		"type" 		 => "select"	
	),

 
);

$settings  = array( 
	"name"		=> __("Audio Post Format Options",'rt_theme_admin'),
	"scope"		=> array('post'),
	"slug"		=> "rt_audio_post_custom_fields",
	"capability"	=> "edit_page",
	"context"		=> "normal",
	"priority"	=> "high" 
);

$rt_post_custom_fields = new rt_meta_boxes($settings,$customFields);



$customFields = array(
	array(
		"description"	=> __("The gallery function is used to upload and attach multiple images to a post by the use of the <strong>Image Gallery</strong> box. ",'rt_theme_admin'),					
		"type"			=> "info_text_only",
		"hr"			=> "true",
	), 
  
	array(
		"title"       => __("Usage of Gallery Images",'rt_theme_admin'), 
		"description" => __('The "Usage of Gallery Images" option can be set to alter the behaviour of the Gallery in the Single Post or Listing Page. <strong>There are two choices:</strong><br /><br />1) <strong>Display Gallery as Slideshow</strong> <br />2) <strong>Display Gallery as Photo-Gallery</strong><br /><br /><strong>Note</strong> : In order to have the slider or gallery function to work there needs to be more then one (1) image attached to the "Image Gallery Box".','rt_theme_admin'),
		"name"        => "_gallery_usage",
		"options"     => array(
							"slider"  => "Display Gallery as Slideshow", 
							"gallery" => "Display Gallery as Photo-Gallery"
						 ),
		"type"        => "select",	 
	), 


	array(
		"title"   => __("Displaying Gallery Images in Listing Pages",'rt_theme_admin'), 
		"name"    => "_gallery_usage_listing",
		"description" => __('With the "Displaying Gallery Images in Listing Pages" option one can set and alter the usage of the gallery in the Blog Listing Page only. <strong>Available choices are :</strong><br /><br />1) <strong>Display the Gallery</strong> (the Blog Listing Page will show the gallery)<br />2) <strong>Display the Featured Image</strong> (the Blog Listing Page will show the to the post attached Featured Image)<br />3) <strong>Do not display anything</strong> (the Blog Listing Page will not show any image).','rt_theme_admin'),		
		"options" => array(							
							"same"                => "Display the Gallery", 							
							"only_featured_image" => "Display the Featured Image",
							"no_image"            => "Do not display anything", 
						 ),
		"type"    => "select"	
	),

	array(
		"title" => __("SLIDESHOW IMAGE OPTIONS",'rt_theme_admin'),
		"type"  => "heading"
	),

	array(
		"title"   => __("Crop Images in the Slideshow",'rt_theme_admin'),
		"name"    => "gallery_images_crop",
		"description" 	=> __('By turning <strong>"ON"</strong> the "Crop Images in the Slideshow" option the images in the gallery will be cropped to the theme defaults width and the height values. The maximum height can be set and controlled below in the next option setting called "Maximum Image Height".','rt_theme_admin'),		
		"default" => "",
		"hr"      => true,
		"type"    => "checkbox2"
	),
			
	array(
		"title"       => __("Maximum Image Height",'rt_theme_admin'),
		"name"        => "gallery_images_height",
		"description" => __('Set a maximum height for the gallery image between 300 and 1500px','rt_theme_admin'),
		"min"         => "0",
		"max"         => "1500",
		"default"     => "300",
		"type"        => "rangeinput"
	),  
 
);

$settings  = array( 
	"name"       => "Gallery Post Format Options",
	"scope"      => array('post'),
	"slug"       => "rt_gallery_post_custom_fields",
	"capability" => "edit_page",
	"context"    => "normal",
	"priority"   => "high" 
);

$rt_post_custom_fields = new rt_meta_boxes($settings,$customFields);
 


$customFields = array(

	array(
		"description"	=> __("Link the Post to any valid (external) URL.",'rt_theme_admin'),					
		"type"			=> "info_text_only",
		"hr"			=> "true",
	),
   
	
	array(
		"name"        => "post_format_link",
		"title"       => __("URL",'rt_theme_admin'),
		"description" => __(" Use a full and correct URL f.e.: (http://yourwebsite.com/yourlink) to where the post should link to. The link will be shown and added to the title of the post.",'rt_theme_admin'),
		"type"        => "text" 
	),	 

	 
);

$settings  = array( 
	"name"       => "Link Post Format Options",
	"scope"      => array('post'),
	"slug"       => "rt_link_post_custom_fields",
	"capability" => "edit_page",
	"context"    => "normal",
	"priority"   => "high" 
);

$rt_post_custom_fields = new rt_meta_boxes($settings,$customFields);

 

$customFields = array(

	array(
		"description"	=> __("Featured Image Options for the Blog Listing Page or Single Post Page.",'rt_theme_admin'),					
		"type"			=> "info_text_only",
		"hr"			=> "true",
	),

	array(
		"title"			=> __("Featured Image Position",'rt_theme_admin'), 
		"name"			=> "featured_image_position",
		"description"	=> __('The featured image can be positioned three ways: Centered (fullwidth), left or right aligned. Set the "Featured Image Position" to change/alter the size and location of the image in Blog Listing Page. This way one can control the image size and alter the look and feel of the website. Below in the next options one can override the default width and height used by the theme.','rt_theme_admin'),
		"options"		=>  array(
							"center" => "Centered", 
							"left"   => "Left aligned",
							"right"  => "Right aligned",
						 ),
		"default"		=> "center",
		"type"			=> "select"
	), 


	array(
		"title"			=> __("FEATURED IMAGE SIZE AND CROPPING",'rt_theme_admin'),
		"type"			=> "heading"
	),


	
	array(
		"title"			=> __("Featured Image Width",'rt_theme_admin'),
		"name"			=> "blog_image_width",
		"description"	=> __("The featured image will resize to fit the content area automatically. If you do not want to use the default settings then in here you can set a maximum width value to alter the look/size of the image in the Blog Listing Page or Single Post Page. <strong>Leave it set to \"0\" to use the theme default values.<strong>",'rt_theme_admin'),
		"min"			=> "0",
		"max"			=> "1080",
		"default"		=> "0",
		"type" 			=> "rangeinput"
	),

	array(
		"title" 		=> __("Featured Image Height",'rt_theme_admin'),
		"name" 			=> "blog_image_height",
		"description" 	=> __("The featured image will resize to fit the post content area automatically. If you do not want to use the default settings then in here you can set a maximum height for the featured image and alter the look/size of the image in the Blog Listing Page or Single Post Page. <strong>Leave it set to \"0\" to use the theme default scaling of the image which will keep the aspect ratio.</strong> ",'rt_theme_admin'),
		"min"			=> "0",
		"max"			=> "1200",
		"default"		=> "0",
		"type"			=> "rangeinput",
		"hr"			=> true,
	),
	 
	array(
		"title" 		=> __("Crop Featured Image.",'rt_theme_admin'),
		"name"			=> "blog_image_crop",
		"description" 	=> __('By turning <strong>"ON"</strong> the cropping option the featured image will be cropped to the theme default, or to the in the previous options set, width and the height values.','rt_theme_admin'),
		"default" 		=> "",
		"type" 			=> "checkbox2"
	),
 

  	array(
		"title" 		=> __("SHOW FEATURED IMAGE IN SINGLE POST",'rt_theme_admin'),
		"type" 			=> "heading"
	),


	array(
		"title" 		=> __("Display the Featured Image in the Single Post Page",'rt_theme_admin'),
		"name"			=> "featured_image_single_page",
		"description" 	=> __('By default the featured image will not show in a single post page. To show the featured image in the single post turn <strong>"ON"</strong> this option.','rt_theme_admin'),
		"default" 		=> "", 
		"type" 			=> "checkbox2"
	),


	array(
		"title" 		=> __("Use Same Settings for Single Post Page",'rt_theme_admin'),
		"name"			=> "featured_image_same_single_page",
		"description" 	=> __('If the option "Display the Featured Image in the Single Post Page" is enabled then by default the featured image will be displayed in <strong>FULLWIDTH</strong>. By turning <strong>"ON"</strong> on this option the featured image fill follow above <strong>Position</strong>, <strong>Width</strong> and <strong>Height</strong> settings.','rt_theme_admin'),
		"default" 		=> "", 
		"type" 			=> "checkbox2"
	),

	
	//hidden value
	array(
		"name"				=> "is_old_post",  
		"type"				=> "hidden",
		"statical_value"	=> "1"
	),		
	 
);

$settings  = array( 
	"name"		 => "Featured Image Options",
	"scope"		 => array('post'),
	"slug"		 => "rt_featured_image_custom_fields",
	"capability" => "edit_page",
	"context"	 => "normal",
	"priority"	 => "high" 
);

$rt_post_custom_fields = new rt_meta_boxes($settings,$customFields);


?>