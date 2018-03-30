<?php
#-----------------------------------------
#	RT-Theme staff_custom_fields.php
#-----------------------------------------

#
# 	Staff Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/ 
 
global $rt_social_media_icons;

$customFields = array(
		array(
			"description"	=> __("Team / Staff member items can be used to show your complete team or individual or selected member(s) and their complete details, including all their contact and social information, on any location within a page in your website. Attach a featured image to show a image of the member with his details. Team / Staff members can be listed and called : <br /><br />1) In the template builder by adding a Team/Staff box,<br />2) Directly in a page by the use of the Team/Staff shortcode.<br /><br /><strong>Note : </strong>The attached image can be shown in 3 different styles which can be set in the template builder module or shortcode when calling the team member(s).",'rt_theme_admin'),	
			"type"			=> "info_text_only",
		),
		array(
			"title" => __("Short Info",'rt_theme_admin'), 
			"type"  => "heading"
		),
		array(
			"title"       => __("Short Info",'rt_theme_admin'),
			"description" => __("Short info : Add a short information about this member. This information will show when the member is listed by the use of the template builder Team/Staff box or Team/Staff shortcode. The short info will not show when the Single Member Page is opened. In the Single Member Page the value entered above, in the default post body content textarea, is presented.",'rt_theme_admin'),
			"name"        => "_short_data",
			"type"        => "textarea",		
			"label_position"  => "block",		
		), 
);

	foreach($rt_social_media_icons as $key => $value){   
		$httpkeyurl='http://'.strtolower($key).__('.com/the-','rt_theme_admin').strtolower($key);
		if ($key=="Google +") $httpkeyurl=str_replace( ' +' , '' , $httpkeyurl);
		$msgdesc=__(" Link field : Enter a valid URL (http or https) to the members ",'rt_theme_admin').$key.__(" page . For example : ",'rt_theme_admin').$httpkeyurl.__("-userpath/ <br /><br /><strong>Note</strong> : Consult the <strong>",'rt_theme_admin').$key. __(" documentation</strong> for more information on the how to link to ",'rt_theme_admin').$key.'.';

		if ($key=="Email") {
			$msgdesc=__(" Link field : Enter a valid URL (http or https) to the members own contact page or email address. Note : Do not add 'mailto:' as the theme will add that automatically in case a valid emailaddress is used.",'rt_theme_admin');
		}
		
		if ($key=="Skype") $msgdesc=__(" Link field : Enter a valid skype address. Syntax : 'skype:skypeid?call' or 'skype:phonenumber?call'.<br /><br /><strong>Note</strong> : Consult the <strong>Skype documentation</strong> for more options and exact details.",'rt_theme_admin');

		if( $value != "rss" ){
			array_push($customFields, 

				array(
				"title" => $key,  
				"type" 	=> "heading"
				),

				array( "type" => "table_start" ),

				array(
				"title" => $key. __(" link",'rt_theme_admin'), 
				"description" => $key. __($msgdesc,'rt_theme_admin'),
				"name" 	=> "_".$value."",
				"type" 	=> "inline_text",
				),

				array( "type" => "td_col" ),

				array(
				"title" => $key. __(" Text",'rt_theme_admin'), 
				"description" => $key. __(" Text field : Enter a short text/title which will show on hovering the (social) icon.",'rt_theme_admin'),
				"name" 	=> "_".$value."_text",
				"type" 	=> "inline_text",
				),

				array( "type" => "table_end" )

					
			);  
		}
	}


$settings  = array( 
	"name"       => "Staff Options",
	"scope"      => "staff",
	"slug"       => "rt_staff_custom_fields",
	"capability" => "edit_post",
	"context"    => "normal",
	"priority"   => "high" 
);